<?php

/**
 * Enqueue child theme styles and scripts.
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Load the parent style.css file
 *
 * @link http://codex.wordpress.org/Child_Themes
 */
if (!function_exists('justg_child_enqueue_parent_style')) {
    function justg_child_enqueue_parent_style()
    {
        // Dynamically get version number of the parent stylesheet (lets browsers re-cache your stylesheet when you update your theme)
        $parenthandle = 'parent-style';
        $theme = wp_get_theme();

        // CC
        wp_enqueue_style($parenthandle, get_template_directory_uri() . '/style.css', array(), $theme->parent()->get('Version'));
        // $css_version = $theme->parent()->get('Version') . '.' . filemtime( get_stylesheet_directory() . '/css/custom.css' );
        $css_version = $theme->parent()->get('Version');
        wp_enqueue_style( 'splide-css', 'https://cdn.jsdelivr.net/npm/@splidejs/splide/dist/css/splide.min.css', array(), $css_version);
        wp_enqueue_style('custom-style', get_stylesheet_directory_uri() . '/css/custom.css', array(), $css_version);
        wp_enqueue_style('velocity-google-fonts','https://fonts.googleapis.com/css?family=Playfair+Display|Space+Mono|Stint+Ultra+Expanded&display=swap', false);
        wp_enqueue_style('child-style', get_stylesheet_uri(), array($parenthandle), $theme->get('Version'));

        //JS
        $js_version = $theme->parent()->get('Version') . '.' . filemtime(get_stylesheet_directory() . '/js/custom.js');
        wp_enqueue_script('splide-js', 'https://cdn.jsdelivr.net/npm/@splidejs/splide/dist/js/splide.min.js', array(), $js_version, true);
        wp_enqueue_script('justg-custom-scripts', get_stylesheet_directory_uri() . '/js/custom.js', array(), $js_version, true);
    }
}

// admin enqueue
add_action('admin_enqueue_scripts','custom_enqueue_admin');
function custom_enqueue_admin() {
    $theme = wp_get_theme();
    wp_enqueue_style('admincustom-style', get_stylesheet_directory_uri() . '/css/admin.css', array(), $theme->get('Version'));
    wp_enqueue_script('admincustom-scripts', get_stylesheet_directory_uri() . '/js/admin.js', array(), $theme->get('Version'), true);
}
