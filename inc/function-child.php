<?php

/**
 * Fuction yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

add_action('after_setup_theme', 'velocitychild_theme_setup', 9);

function velocitychild_theme_setup()
{
	// Load justg_child_enqueue_parent_style after theme setup
	add_action('wp_enqueue_scripts', 'justg_child_enqueue_parent_style', 20);

	if (class_exists('Kirki')) :

		Kirki::add_panel('panel_velocity', [
			'priority'    => 10,
			'title'       => esc_html__('Velocity Theme', 'justg'),
			'description' => esc_html__('', 'justg'),
		]);

		// section title_tagline
		Kirki::add_section('title_tagline', [
			'panel'    => 'panel_velocity',
			'title'    => __('Site Identity', 'justg'),
			'priority' => 10,
		]);
		///Section Color
		Kirki::add_section('section_colorvelocity', [
			'panel'    => 'panel_velocity',
			'title'    => __('Color & Background', 'justg'),
			'priority' => 10,
		]);
		Kirki::add_field('justg_config', [
			'type'        => 'color',
			'settings'    => 'color_theme',
			'label'       => __('Theme Color', 'kirki'),
			'description' => esc_html__('', 'kirki'),
			'section'     => 'section_colorvelocity',
			'default'     => '#b85e6d',
			'transport'   => 'auto',
			'output'      => [
				[
					'element'   => ':root',
					'property'  => '--color-theme',
				],
                [
                    'element'   => '.text-colortheme, .text-colortheme i, .page-link',
                    'property'  => 'color',
                ],
                [
                    'element'   => '.bg-primary, .bg-colortheme, .page-item.active .page-link',
                    'property'  => 'background-color',
                ],
                [
                    'element'   => '.bg-colortheme, .page-item.active .page-link',
                    'property'  => 'border-color',
                ],
				[
					'element'   => ':root',
					'property'  => '--bs-primary',
				],
				[
					'element'   => '.border-color-theme',
					'property'  => '--bs-border-color',
				]
			],
		]);
		Kirki::add_field('justg_config', [
			'type'        => 'background',
			'settings'    => 'background_themewebsite',
			'label'       => __('Website Background', 'kirki'),
			'description' => esc_html__('', 'kirki'),
			'section'     => 'section_colorvelocity',
			'default'     => [
				'background-color'      => '#ffffff',
				'background-image'      => '',
				'background-repeat'     => 'repeat',
				'background-position'   => 'center center',
				'background-size'       => 'cover',
				'background-attachment' => 'scroll',
			],
			'transport'   => 'auto',
			'output'      => [
				[
					'element'   => ':root[data-bs-theme=light] body',
				],
				[
					'element'   => 'body',
				],
			],
		]);

		Kirki::add_panel('panel_spa', [
			'priority'    => 10,
			'title'       => esc_html__('Setting SPA', 'justg'),
			'description' => esc_html__('', 'justg'),
		]);

        ///Section Slider Home
		Kirki::add_section('section_slider', [
			'panel'    => 'panel_spa',
			'title'    => __('Slider Home', 'justg'),
			'priority' => 10,
		]);
        // field section
        new \Kirki\Field\Repeater([
			'settings' => 'slider_repeat',
			'label'    => esc_html__('Slider Home', 'justg'),
			'section'  => 'section_slider',
			'priority' => 10,
			'row_label'    => [
				'type'  => 'field',
				'value' => esc_html__('Slider', 'justg'),
			],
			'button_label' => esc_html__('"Add Slider" ', 'justg'),
			'fields'   => [
				'imgslider'   => [
					'type'        => 'image',
					'label'       => esc_html__('Slider', 'justg'),
					'description' => esc_html__('', 'justg'),
					'default'     => '',
				],
			],
		]);

		///Section Team Home
		Kirki::add_section('section_team', [
			'panel'    => 'panel_spa',
			'title'    => __('Team Home', 'justg'),
			'priority' => 10,
		]);

		// field section 
		new \Kirki\Field\Checkbox_Switch(
            [
                'settings'    => 'team_home',
                'label'       => esc_html__( 'Team Home', 'justg' ),
                'description' => esc_html__( 'Tampilkan team di halaman home', 'justg' ),
                'section'     => 'section_team',
                'default'     => 'on',
                'choices'     => [
                    'on'  => esc_html__( 'On', 'justg' ),
                    'off' => esc_html__( 'Off', 'justg' ),
                ],
            ]
        );
        new \Kirki\Field\Text([
			'settings' => 'title_team',
			'label'    => esc_html__( 'Title Team', 'justg' ),
			'section'  => 'section_team',
			'default'  => esc_html__( 'Terapis Profesional', 'justg' ),
			'description' => esc_html__( 'Contoh. Terapis Profesional', 'justg' ),
			'priority' => 10,
		]);

		///Section Layanan Home
		Kirki::add_section('section_layanan', [
			'panel'    => 'panel_spa',
			'title'    => __('Layanan Home', 'justg'),
			'priority' => 10,
		]);

		// field section 
		new \Kirki\Field\Checkbox_Switch(
            [
                'settings'    => 'layanan_home',
                'label'       => esc_html__( 'Layanan Home', 'justg' ),
                'description' => esc_html__( 'Tampilkan layanan di halaman home', 'justg' ),
                'section'     => 'section_layanan',
                'default'     => 'on',
                'choices'     => [
                    'on'  => esc_html__( 'On', 'justg' ),
                    'off' => esc_html__( 'Off', 'justg' ),
                ],
            ]
        );
        new \Kirki\Field\Text([
			'settings' => 'title_layanan',
			'label'    => esc_html__( 'Title Layanan', 'justg' ),
			'section'  => 'section_layanan',
			'default'  => esc_html__( 'Layanan Kami', 'justg' ),
			'description' => esc_html__( 'Contoh. Layanan Kami', 'justg' ),
			'priority' => 10,
		]);


		///Section Kontak
		Kirki::add_section('section_kontak', [
			'panel'    => 'panel_spa',
			'title'    => __('Kontak Website', 'justg'),
			'priority' => 10,
		]);

        // field section 
        new \Kirki\Field\Text([
			'settings' => 'nowa',
			'label'    => esc_html__( 'No Whatsapp', 'justg' ),
			'section'  => 'section_kontak',
			'default'  => esc_html__( '', 'justg' ),
			'description' => esc_html__( 'Contoh. 085123456789', 'justg' ),
			'priority' => 10,
		]);
        new \Kirki\Field\Text([
			'settings' => 'email',
			'label'    => esc_html__( 'Email', 'justg' ),
			'section'  => 'section_kontak',
			'default'  => esc_html__( '', 'justg' ),
			'description' => esc_html__( 'Contoh. info@velocitydeveloper.com', 'justg' ),
			'priority' => 10,
		]);
		new \Kirki\Field\Editor([
			'settings'    => 'pesan',
			'label'       => esc_html__( 'Pesan', 'justg' ),
			'description' => esc_html__( '', 'justg' ),
			'section'     => 'section_kontak',
			'default'     => 'Halo, saya ingin menanyakan tentang layanan.',
		]);

		// remove panel in customizer 
		Kirki::remove_panel('global_panel');
		Kirki::remove_panel('panel_header');
		Kirki::remove_panel('panel_footer');
		Kirki::remove_panel('panel_antispam');
		Kirki::remove_control('display_header_text');

	endif;

	//remove action from Parent Theme
	remove_action('justg_header', 'justg_header_menu');
	remove_action('justg_do_footer', 'justg_the_footer_open');
	remove_action('justg_do_footer', 'justg_the_footer_content');
	remove_action('justg_do_footer', 'justg_the_footer_close');
	remove_theme_support('widgets-block-editor');
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
function justg_header_berita()
{
	require_once(get_stylesheet_directory() . '/inc/part-header.php');
}
add_action('justg_do_footer', 'justg_footer_berita');
function justg_footer_berita()
{
	require_once(get_stylesheet_directory() . '/inc/part-footer.php');
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

add_action('wp_footer', 'velocity_spa_footer');
function velocity_spa_footer()
{ ?>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
<?php
}


// excerpt more
if ( ! function_exists( 'velocity_custom_excerpt_more' ) ) {
	function velocity_custom_excerpt_more( $more ) {
		return '...';
	}
}
add_filter( 'excerpt_more', 'velocity_custom_excerpt_more' );

// excerpt length
function velocity_excerpt_length($length){
	return 40;
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

function velocity_number_money($number = null) {
    if(empty($number))
    return false;

    return 'Rp '.number_format((float)$number,0,',','.');    
}