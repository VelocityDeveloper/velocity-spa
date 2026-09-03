<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

add_action('after_setup_theme', 'velocitychild_theme_setup', 9);
add_action('customize_controls_enqueue_scripts', 'velocity_spa_customize_assets');

if (!function_exists('velocity_spa_customize_assets')) {
	function velocity_spa_customize_assets()
	{
		wp_enqueue_media();
		$css_file = get_stylesheet_directory() . '/css/customizer-repeater.css';
		$js_file = get_stylesheet_directory() . '/js/customizer-repeater.js';
		wp_enqueue_style('velocity-spa-customizer-repeater', get_stylesheet_directory_uri() . '/css/customizer-repeater.css', array(), file_exists($css_file) ? filemtime($css_file) : null);
		wp_enqueue_script('velocity-spa-customizer-repeater', get_stylesheet_directory_uri() . '/js/customizer-repeater.js', array('jquery', 'customize-controls', 'media-views'), file_exists($js_file) ? filemtime($js_file) : null, true);
	}
}

if (!function_exists('velocitychild_theme_setup')) {
	function velocitychild_theme_setup()
	{
		add_action('wp_enqueue_scripts', 'justg_child_enqueue_parent_style', 20);

	//remove action from Parent Theme
	remove_action('justg_header', 'justg_header_menu');
	remove_action('justg_do_footer', 'justg_the_footer_open');
	remove_action('justg_do_footer', 'justg_the_footer_content');
	remove_action('justg_do_footer', 'justg_the_footer_close');
	remove_theme_support('widgets-block-editor');
	}
}

if (!function_exists('velocity_spa_sanitize_switch')) {
	function velocity_spa_sanitize_switch($value)
	{
		return in_array($value, array(true, 1, '1', 'on'), true) ? 'on' : 'off';
	}
}

if (!function_exists('velocity_spa_legacy_slider_items')) {
	function velocity_spa_legacy_slider_items()
	{
		$legacy = get_theme_mod('slider_repeat', array());
		$items = array();
		foreach ((array) $legacy as $item) {
			$value = isset($item['imgslider']) ? $item['imgslider'] : '';
			$image_id = absint($value);
			if (!$image_id && $value) {
				$image_id = attachment_url_to_postid($value);
			}
			if ($image_id) {
				$items[] = array('image_id' => $image_id);
			}
		}
		return $items;
	}
}

if (!function_exists('velocity_spa_sanitize_slider_repeater')) {
	function velocity_spa_sanitize_slider_repeater($value)
	{
		if (is_string($value)) {
			$value = json_decode($value, true);
		}
		$clean = array();
		foreach ((array) $value as $item) {
			$image_id = isset($item['image_id']) ? absint($item['image_id']) : 0;
			if ($image_id) {
				$clean[] = array('image_id' => $image_id);
			}
		}
		return $clean;
	}
}

if (!function_exists('velocity_spa_customize_register')) {
	function velocity_spa_customize_register($wp_customize)
	{
		$theme = wp_get_theme();
		$panel = 'velocity_spa_settings';
		$wp_customize->remove_section('header_image');
		$wp_customize->add_panel($panel, array(
			'title'       => $theme->get('Name'),
			'description' => __('Pengaturan khusus child theme.', 'justg'),
			'priority'    => 30,
		));

		$sections = array(
			'velocity_spa_slider' => array('title' => __('Slider Home', 'justg')),
			'velocity_spa_team' => array('title' => __('Team Home', 'justg')),
			'velocity_spa_layanan' => array('title' => __('Layanan Home', 'justg')),
			'velocity_spa_kontak' => array(
				'title' => __('Kontak Website', 'justg'),
				'description' => __('Nomor WhatsApp dan email pada bagian ini ditampilkan di header website.', 'justg'),
			),
		);
		foreach ($sections as $section_id => $section_args) {
			$wp_customize->add_section($section_id, array_merge($section_args, array('panel' => $panel)));
		}

		$wp_customize->add_setting('spa_slider_repeater', array(
			'default' => velocity_spa_legacy_slider_items(),
			'sanitize_callback' => 'velocity_spa_sanitize_slider_repeater',
		));
		if (!class_exists('Velocity_Spa_Repeater_Control') && class_exists('WP_Customize_Control')) {
			require_once get_stylesheet_directory() . '/inc/class-customizer-repeater-control.php';
		}
		$wp_customize->add_control(new Velocity_Spa_Repeater_Control($wp_customize, 'spa_slider_repeater', array(
			'label' => __('Daftar Slider', 'justg'),
			'description' => __('Tambah, clone, atau hapus gambar slider.', 'justg'),
			'section' => 'velocity_spa_slider',
		)));

		$fields = array(
			'team_home' => array('section' => 'velocity_spa_team', 'type' => 'checkbox', 'label' => __('Tampilkan Team di Home', 'justg'), 'default' => 'on', 'sanitize' => 'velocity_spa_sanitize_switch'),
			'title_team' => array('section' => 'velocity_spa_team', 'type' => 'text', 'label' => __('Judul Team', 'justg'), 'default' => __('Terapis Profesional', 'justg'), 'sanitize' => 'sanitize_text_field'),
			'layanan_home' => array('section' => 'velocity_spa_layanan', 'type' => 'checkbox', 'label' => __('Tampilkan Layanan di Home', 'justg'), 'default' => 'on', 'sanitize' => 'velocity_spa_sanitize_switch'),
			'title_layanan' => array('section' => 'velocity_spa_layanan', 'type' => 'text', 'label' => __('Judul Layanan', 'justg'), 'default' => __('Layanan Kami', 'justg'), 'sanitize' => 'sanitize_text_field'),
			'nowa' => array('section' => 'velocity_spa_kontak', 'type' => 'text', 'label' => __('Nomor WhatsApp', 'justg'), 'default' => '', 'sanitize' => 'sanitize_text_field'),
			'email' => array('section' => 'velocity_spa_kontak', 'type' => 'email', 'label' => __('Email', 'justg'), 'default' => '', 'sanitize' => 'sanitize_email'),
			'pesan' => array('section' => 'velocity_spa_kontak', 'type' => 'textarea', 'label' => __('Pesan WhatsApp', 'justg'), 'default' => __('Halo, saya ingin menanyakan tentang layanan.', 'justg'), 'sanitize' => 'sanitize_textarea_field'),
		);

		foreach ($fields as $setting_id => $field) {
			$wp_customize->add_setting($setting_id, array(
				'default'           => $field['default'],
				'sanitize_callback' => $field['sanitize'],
			));
			$wp_customize->add_control($setting_id, array(
				'label'   => $field['label'],
				'section' => $field['section'],
				'type'    => $field['type'],
			));
		}
	}
}
add_action('customize_register', 'velocity_spa_customize_register', 20);

if (!function_exists('velocity_spa_archive_title')) {
	function velocity_spa_archive_title($title)
	{
		if (is_category()) {
			return single_cat_title('', false);
		}
		if (is_tag()) {
			return single_tag_title('', false);
		}
		if (is_author()) {
			return get_the_author();
		}
		if (is_post_type_archive()) {
			return post_type_archive_title('', false);
		}
		if (is_tax()) {
			return single_term_title('', false);
		}
		if (is_year()) {
			return get_the_date(_x('Y', 'yearly archives date format', 'justg'));
		}
		if (is_month()) {
			return get_the_date(_x('F Y', 'monthly archives date format', 'justg'));
		}
		if (is_day()) {
			return get_the_date(_x('F j, Y', 'daily archives date format', 'justg'));
		}

		return $title;
	}
}
add_filter('get_the_archive_title', 'velocity_spa_archive_title');

if (!function_exists('velocity_spa_unregister_fourth_footer_sidebar')) {
	function velocity_spa_unregister_fourth_footer_sidebar()
	{
		unregister_sidebar('footer-widget-4');
	}
}
add_action('widgets_init', 'velocity_spa_unregister_fourth_footer_sidebar', 100);

if (!function_exists('velocity_spa_get_option')) {
	function velocity_spa_get_option($setting, $default = '')
	{
		if (function_exists('velocitytheme_option')) {
			return velocitytheme_option($setting, $default);
		}

		return get_theme_mod($setting, $default);
	}
}

if (!function_exists('velocity_spa_get_sliders')) {
	function velocity_spa_get_sliders()
	{
		$items = get_theme_mod('spa_slider_repeater', null);
		if (null === $items) {
			$items = velocity_spa_legacy_slider_items();
		} else {
			$items = velocity_spa_sanitize_slider_repeater($items);
		}
		$sliders = array();
		foreach ($items as $item) {
			$image_url = wp_get_attachment_image_url($item['image_id'], 'full');
			if ($image_url) {
				$sliders[] = $image_url;
			}
		}

		return $sliders;
	}
}

if (!function_exists('velocity_spa_normalize_phone')) {
	function velocity_spa_normalize_phone($phone)
	{
		$phone = preg_replace('/[^0-9+]/', '', (string) $phone);
		if (strpos($phone, '0') === 0) {
			return '62' . substr($phone, 1);
		}

		return ltrim($phone, '+');
	}
}

if (!function_exists('velocity_spa_get_post_image')) {
	function velocity_spa_get_post_image($post_id = null)
	{
		$post_id = $post_id ? absint($post_id) : get_the_ID();
		$thumbnail_id = get_post_thumbnail_id($post_id);

		if ($thumbnail_id) {
			return array(
				'url'     => wp_get_attachment_image_url($thumbnail_id, 'full'),
				'alt'     => get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true) ?: get_the_title($post_id),
				'caption' => wp_get_attachment_caption($thumbnail_id),
			);
		}

		$content = (string) get_post_field('post_content', $post_id);
		$attachment_id = 0;
		if (preg_match('/wp-image-([0-9]+)/i', $content, $matches)) {
			$attachment_id = absint($matches[1]);
		}

		if ($attachment_id && wp_get_attachment_image_url($attachment_id, 'full')) {
			return array(
				'url'     => wp_get_attachment_image_url($attachment_id, 'full'),
				'alt'     => get_post_meta($attachment_id, '_wp_attachment_image_alt', true) ?: get_the_title($post_id),
				'caption' => wp_get_attachment_caption($attachment_id),
			);
		}

		if (preg_match('/<img[^>]+src=["\']([^"\']+)["\'][^>]*>/i', $content, $matches)) {
			$image_tag = $matches[0];
			$alt = '';
			if (preg_match('/\salt=["\']([^"\']*)["\']/i', $image_tag, $alt_matches)) {
				$alt = $alt_matches[1];
			}

			return array(
				'url'     => $matches[1],
				'alt'     => $alt ?: get_the_title($post_id),
				'caption' => '',
			);
		}

		return array(
			'url'     => get_stylesheet_directory_uri() . '/img/no-image.webp',
			'alt'     => sprintf(__('Gambar untuk %s', 'justg'), get_the_title($post_id)),
			'caption' => '',
		);
	}
}

if (!function_exists('velocity_spa_post_thumbnail')) {
	function velocity_spa_post_thumbnail($post_id = null, $ratio = 'ratio-4x3', $image_classes = '', $show_caption = false)
	{
		$post_id = $post_id ? absint($post_id) : get_the_ID();
		$allowed_ratios = array('ratio-1x1', 'ratio-4x3', 'ratio-16x9', 'ratio-21x9');
		$ratio = in_array($ratio, $allowed_ratios, true) ? $ratio : 'ratio-4x3';
		$image = velocity_spa_get_post_image($post_id);
		$classes = trim('w-100 h-100 object-fit-cover ' . $image_classes);
		?>
		<figure class="m-0">
			<a class="d-block ratio <?php echo esc_attr($ratio); ?>" href="<?php echo esc_url(get_permalink($post_id)); ?>">
				<img src="<?php echo esc_url($image['url']); ?>" class="<?php echo esc_attr($classes); ?>" alt="<?php echo esc_attr($image['alt']); ?>" loading="lazy">
			</a>
			<?php if ($show_caption && $image['caption']) : ?>
				<figcaption class="figure-caption mt-2"><?php echo wp_kses_post($image['caption']); ?></figcaption>
			<?php endif; ?>
		</figure>
		<?php
	}
}


///remove breadcrumbs
add_action('wp_head', function () {
	if (!is_single()) {
		remove_action('justg_before_title', 'justg_breadcrumb');
	}
});

if (!function_exists('justg_header_open')) {
	function justg_header_open()
	{
		echo '<header id="wrapper-header">';
		echo '<div id="wrapper-navbar" itemscope itemtype="http://schema.org/WebSite">';
	}
}
if (!function_exists('justg_header_close')) {
	function justg_header_close()
	{
		echo '</div>';
		echo '</header>';
	}
}


///add action builder part
add_action('justg_header', 'justg_header_berita');
if (!function_exists('justg_header_berita')) {
function justg_header_berita() {
	require_once(get_stylesheet_directory() . '/inc/part-header.php');
}
}
add_action('justg_do_footer', 'justg_footer_berita');
if (!function_exists('justg_footer_berita')) {
function justg_footer_berita() {
	require_once(get_stylesheet_directory() . '/inc/part-footer.php');
}
}
// add_action('justg_before_wrapper_content', 'justg_before_wrapper_content');
// function justg_before_wrapper_content()
// {
	// echo '<div class="px-2">';
	// echo '<div class="card rounded-top rounded-0 border-light border-top-0 border-bottom-0 shadow px-2 container">';
// }
// add_action('justg_after_wrapper_content', 'justg_after_wrapper_content');
// function justg_after_wrapper_content()
// {
// 	echo '</div>';
// 	echo '</div>';
// }

// excerpt more
if ( ! function_exists( 'velocity_custom_excerpt_more' ) ) {
	function velocity_custom_excerpt_more( $more ) {
		return '...';
	}
}
add_filter( 'excerpt_more', 'velocity_custom_excerpt_more' );

// excerpt length
if (!function_exists('velocity_excerpt_length')) {
function velocity_excerpt_length($length){
	return 40;
}
}
add_filter('excerpt_length','velocity_excerpt_length');

if (!function_exists('justg_right_sidebar_check')) {
	function justg_right_sidebar_check()
	{
		if (is_singular('fl-builder-template')) {
			return;
		}
		if (!is_active_sidebar('main-sidebar')) {
			return;
		}
		echo '<div class="widget-area right-sidebar pt-3 pt-md-0 ps-md-3 ps-0 pe-0 col-md-4 order-3" id="right-sidebar" role="complementary">';
		do_action('justg_before_main_sidebar');
		dynamic_sidebar('main-sidebar');
		do_action('justg_after_main_sidebar');
		echo '</div>';
	}
}

if (!function_exists('velocity_number_money')) {
function velocity_number_money($number = null) {
    if(empty($number))
    return false;

    return 'Rp '.number_format((float)$number,0,',','.');    
}
}
