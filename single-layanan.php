<?php
/**
 * Single Layanan template.
 *
 * @package just-f
 */

defined('ABSPATH') || exit;

get_header();
$container = velocity_spa_get_option('justg_container_type', 'container');
?>

<div class="wrapper" id="single-wrapper">
    <div class="<?php echo esc_attr($container); ?>" id="content">
        <main class="site-main" id="main">
            <?php while (have_posts()) : the_post();
                $current_service_id = get_the_ID();
                $harga = get_post_meta($current_service_id, 'harga', true);
                ?>
                <article <?php post_class('mb-5'); ?> id="post-<?php the_ID(); ?>">
                    <header class="entry-header mb-3">
                        <h1 class="velocity-page-title"><?php the_title(); ?></h1>
                    </header>

                    <div class="card border-0 rounded-4 shadow-sm overflow-hidden">
                        <div class="row g-0">
                            <div class="col-lg-5">
                                <?php velocity_spa_post_thumbnail($current_service_id, 'ratio-4x3', '', true); ?>
                            </div>
                            <div class="col-lg-7">
                                <div class="card-body d-flex flex-column align-items-start gap-3 p-4 p-lg-5 h-100">
                                    <?php if ($harga) : ?>
                                        <p class="h4 fw-bold text-colortheme mb-0"><?php echo esc_html(velocity_number_money($harga)); ?></p>
                                    <?php endif; ?>
                                    <div class="entry-content w-100"><?php the_content(); ?></div>
                                    <a href="<?php echo esc_url(velocity_spa_booking_url($current_service_id)); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary rounded-pill px-4 py-2 text-uppercase fw-bold mt-auto">
                                        <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true"><path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/></svg>
                                        <?php esc_html_e('Booking', 'justg'); ?>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>

                <?php
                $related_services = new WP_Query(array(
                    'post_type'      => 'layanan',
                    'posts_per_page' => 3,
                    'post__not_in'   => array($current_service_id),
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                ));
                if ($related_services->have_posts()) : ?>
                    <section class="related-services">
                        <h2 class="velocity-page-title mb-4"><?php esc_html_e('Layanan Terkait', 'justg'); ?></h2>
                        <div class="row">
                            <?php while ($related_services->have_posts()) : $related_services->the_post();
                                get_template_part('loop-templates/content', 'layanan');
                            endwhile; ?>
                        </div>
                    </section>
                <?php endif;
                wp_reset_postdata();
            endwhile; ?>
        </main>
    </div>
</div>

<?php get_footer();
