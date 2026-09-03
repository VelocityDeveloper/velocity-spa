<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package velocity
 */
?>
<article <?php post_class('col-md-3 col-6 container border-0 mb-3 px-2'); ?> id="post-<?php the_ID(); ?>">
    <div class="card p-0 border-0 shadow rounded-2">
	<?php velocity_spa_post_thumbnail(get_the_ID(), 'ratio-1x1'); ?>
		<h2 class="entry-title bg-light text-center h5 fw-bold p-2 m-0"><a class="text-dark" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo wp_trim_words(get_the_title(), 5); ?></a></h2>
    </div>
</article><!-- #post-## -->
