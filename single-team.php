<?php
/**
 * The template for displaying all single posts.
 *
 * @package just-f
 */

get_header();
?>

<div class="container p-3 bg-white" id="single-wrapper">

    <div class="row m-0">
        <!-- Do the left sidebar check -->
        <?php do_action('justg_before_content'); ?>

	<main class="site-main" id="main">
		<?php while ( have_posts() ) : the_post(); ?>
            <div class="row mb-2">
                <div class="col-md-4">
                    <img class="rounded-2 shadow w-100" src="<?php echo aq_resize( get_the_post_thumbnail_url(), 300, 330, true, true, true ); ?>" alt="<?php echo get_the_title(); ?>"/>
                </div>
                <div class="col-md-8 mt-md-0 mt-3">
                    <h3 class="fw-bold"><?php echo get_the_title(); ?></h3>
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
    <div class="mt-3 card">
        <h4 class="text-dark card-header">Team Terkait</h4>
        <div class="row card-body">
            <?php 
            $the_query = new WP_Query( ['post_type' => 'team', 'posts_per_page' => 4 ] );
            if ( $the_query->have_posts() ) :
            	while ( $the_query->have_posts() ) :
            		$the_query->the_post();?>
                <article <?php post_class('col-md-3 col-6 container border-0 mb-3 px-2'); ?> id="post-<?php the_ID(); ?>">
                    <div class="card p-0 border-0 shadow rounded-2">
                        <a href="<?php echo get_permalink();?>">
                            <img src="<?php echo aq_resize( get_the_post_thumbnail_url(), 300, 330, true, true, true ); ?>" class="w-100" alt="<?php echo get_the_title(); ?>"/>
                        </a>
                        <?php the_title( sprintf( '<h4 class="text-center fw-bold bg-light p-2 m-0"><a class="text-dark" href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
                            '</a></h4>' ); ?>
                    </div>
                </article><!-- #post-## -->
            	<?php endwhile;
            endif;
            ?>
        </div>
    </div>

    <!-- Do the right sidebar check. -->
        <?php do_action('justg_after_content'); ?>

    </div><!-- .row -->
</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>