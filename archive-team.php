<?php

/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package velocity
 */

// Exit if accessed directly.
defined('ABSPATH') || exit;

get_header();

$container = velocity_spa_get_option('justg_container_type', 'container');
?>

<div class="wrapper archive-shell" id="archive-wrapper">

    <div class="<?php echo esc_attr($container); ?>" id="content" tabindex="-1">

        <div class="row">
            <!-- Do the left sidebar check -->
            <?php //do_action('justg_before_content'); ?>

            <main class="site-main archive-main" id="main">

                <?php

                if (have_posts()) {
                ?>
                    <header class="page-header archive-hero">
                        <?php
						the_archive_title( '<h1 class="page-title velocity-page-title">', '</h1>' );
						the_archive_description( '<div class="taxonomy-description">', '</div>' );
						?>
                    </header><!-- .page-header -->

                    <div class="row">
                    <?php
                    // Start the loop.
                    while (have_posts()) { the_post();
                        get_template_part( 'loop-templates/content', 'team');
                    }?>
                    </div>
                
                <?php
                } else {
                    get_template_part('loop-templates/content', 'none');
                }
                ?>
                <!-- Display the pagination component. -->
                <?php if (function_exists('justg_pagination')) { justg_pagination(); } else { the_posts_pagination(); } ?>

            </main><!-- #main -->

            <!-- Do the right sidebar check. -->
            <?php //do_action('justg_after_content'); ?>

        </div><!-- .row -->

    </div><!-- #content -->

</div><!-- #archive-wrapper -->

<?php
get_footer();
