<?php
/**
 * The template for displaying all single posts.
 *
 * @package just-f
 */

get_header();
$nowa = velocity_spa_normalize_phone(velocity_spa_get_option('nowa'));
$harga = get_post_meta($post->ID, 'harga',true); ?>

<div class="container p-3 bg-white" id="single-wrapper">
    <div class="row m-0">
    <!-- Do the left sidebar check -->
    <?php do_action('justg_before_content'); ?>

	<main class="site-main" id="main">
		<?php while ( have_posts() ) : the_post(); ?>
            <div class="row mb-2">
                <div class="col-md-5 col-12">
                    <?php velocity_spa_post_thumbnail(get_the_ID(), 'ratio-4x3', 'rounded-2 shadow', true); ?>
                    
                </div>
                <div class="col-md-7 col-12 mt-4 mt-md-0">
                    <h3 class="fw-bold"><?php echo get_the_title(); ?></h3>
                    <?php if($harga) :?>
                        <h3 class="fw-bold text-colortheme"><?php echo velocity_number_money($harga);?></h3>
                    <?php endif;?>
                    <a href="<?php echo esc_url('https://api.whatsapp.com/send?phone=' . $nowa . '&text=' . rawurlencode('Hallo saya mau pesan layanan ini: ' . get_the_title() . ' dari ' . get_site_url())); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-success text-uppercase fw-bold text-light p-2 my-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                            <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                        </svg> Booking Now
                    </a>
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
        <h4 class="text-dark card-header">Layanan Terkait</h4>
        <div class="row card-body">
            <?php 
            $the_query = new WP_Query( ['post_type' => 'layanan', 'posts_per_page' => 4 ] );
            if ( $the_query->have_posts() ) :
            	while ( $the_query->have_posts() ) :
            		$the_query->the_post();?>
                    <article <?php post_class('col-md-3 col-6 px-2 container border-0 mb-3'); ?> id="post-<?php the_ID(); ?>">
                        <div class="card h-100 p-0 border-0">
                            <?php velocity_spa_post_thumbnail(get_the_ID(), 'ratio-4x3'); ?>
                            <h6 class="bg-light text-center fw-bold p-2 m-0"><a class="text-dark" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo wp_trim_words(get_the_title(), 5); ?></a></h6>
                            <div class="halCircles bg-colortheme text-white">
                                <a href="<?php echo esc_url('https://api.whatsapp.com/send?phone=' . $nowa . '&text=' . rawurlencode('Hallo saya mau pesan layanan ini: ' . get_the_title() . ' dari ' . get_site_url())); ?>" target="_blank" rel="noopener noreferrer" class="btn w-100 text-uppercase fw-bold text-light p-2">Booking</a>
                            </div>
                        </div>
                    </article><!-- #post-## -->
            	<?php endwhile;?>
            <?php endif;?>
            <?php wp_reset_postdata(); ?>
        </div>
    </div>

    <!-- Do the right sidebar check. -->
    <?php do_action('justg_after_content'); ?>

    </div><!-- .row -->
</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
