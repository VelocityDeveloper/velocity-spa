<?php
/**
 * The template for displaying all single posts.
 *
 * @package just-f
 */

get_header();
?>

<div class="wrapper" id="single-wrapper">

    <div class="container">

    <div class="row m-0">
        <!-- Do the left sidebar check -->
        <?php do_action('justg_before_content'); ?>

	<main class="site-main" id="main">
		<?php while ( have_posts() ) : the_post(); ?>
            <div class="row mb-2">
                <div class="col-md-4">
                    <?php velocity_spa_post_thumbnail(get_the_ID(), 'ratio-1x1', 'rounded-2 shadow', true); ?>
                </div>
                <div class="col-md-8 mt-md-0 mt-3">
                    <h1 class="velocity-page-title"><?php the_title(); ?></h1>
                    <?php echo apply_filters('the_content', get_the_content()); ?>
                </div>
            </div>
			<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
		// 		comments_template();
			endif;
			?>

		<?php endwhile; // end of the loop. ?>
	</main><!-- #main -->

    <!-- Do the right sidebar check. -->
        <?php do_action('justg_after_content'); ?>

    </div><!-- .row -->
</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
