<?php

/**
 * Kumpulan shortcode yang digunakan di theme ini.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

//[excerpt count="150"]
if (!function_exists('vd_getexcerpt')) {
function vd_getexcerpt($atts) {
    ob_start();
    global $post;
    $atribut = shortcode_atts(array(
        'count'    => '150', /// count character
    ), $atts);

    $count        = $atribut['count'];
    $excerpt    = get_the_content();
    $excerpt     = strip_tags($excerpt);
    $excerpt     = substr($excerpt, 0, $count);
    $excerpt     = substr($excerpt, 0, strripos($excerpt, " "));
    $excerpt     = '' . $excerpt . '...';

    echo $excerpt;

    return ob_get_clean();
}
}
add_shortcode('excerpt', 'vd_getexcerpt');

if (!function_exists('velocity_spa_services_list_shortcode')) {
    /**
     * Display services as a linked list.
     *
     * Usage: [daftar-layanan jumlah="5" harga="true"]
     * Use jumlah="-1" to display all services.
     *
     * @param array<string, mixed> $atts Shortcode attributes.
     * @return string
     */
    function velocity_spa_services_list_shortcode($atts)
    {
        $atts = shortcode_atts(
            array(
                'jumlah' => 5,
                'harga'  => 'yes',
            ),
            $atts,
            'daftar-layanan'
        );

        $jumlah = (int) $atts['jumlah'];
        if (-1 !== $jumlah) {
            $jumlah = max(1, min(100, $jumlah));
        }
        $show_price = in_array(strtolower((string) $atts['harga']), array('1', 'true', 'yes', 'on'), true);

        $services = new WP_Query(
            array(
                'post_type'           => 'layanan',
                'post_status'         => 'publish',
                'posts_per_page'      => $jumlah,
                'orderby'             => 'date',
                'order'               => 'DESC',
                'no_found_rows'       => true,
                'ignore_sticky_posts' => true,
            )
        );

        if (!$services->have_posts()) {
            return '';
        }

        ob_start();
        ?>
        <ul class="velocity-service-list">
            <?php while ($services->have_posts()) : $services->the_post(); ?>
                <li>
                    <a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_html(get_the_title()); ?></a>
                    <?php $service_price = velocity_spa_service_price(get_the_ID()); ?>
                    <?php if ($show_price && $service_price) : ?>
                        <span class="d-block small fw-semibold text-colortheme"><?php echo esc_html($service_price); ?></span>
                    <?php endif; ?>
                </li>
            <?php endwhile; ?>
        </ul>
        <?php
        wp_reset_postdata();

        return ob_get_clean();
    }
}
add_shortcode('daftar-layanan', 'velocity_spa_services_list_shortcode');
