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
                $harga = velocity_spa_service_price($current_service_id);
                $fasilitas = velocity_spa_service_facilities($current_service_id);
                ?>
                <article <?php post_class('mb-5'); ?> id="post-<?php the_ID(); ?>">

                    <div class="row g-4 align-items-start">
                        <div class="col-lg-5">
                            <div class="overflow-hidden rounded-4 shadow-sm"><?php velocity_spa_post_thumbnail($current_service_id, 'ratio-4x3', '', true); ?></div>
                        </div>
                        <div class="col-lg-7 d-flex flex-column align-items-start gap-3">
                            <h1 class="velocity-page-title mb-0"><?php the_title(); ?></h1>
                            <?php if ($harga) : ?>
                                <p class="h4 fw-bold text-colortheme mb-0"><?php echo esc_html($harga); ?></p>
                            <?php endif; ?>
                            <div class="entry-content w-100"><?php the_content(); ?></div>
                            <?php if ($fasilitas) : ?>
                                <div class="w-100 mb-3">
                                    <h2 class="h5 fw-bold mb-3"><?php esc_html_e('Fasilitas', 'justg'); ?></h2>
                                    <ul class="spa-service-features list-unstyled d-grid gap-2 text-body-secondary mb-0">
                                        <?php foreach ($fasilitas as $item) : ?>
                                            <li class="d-flex align-items-start gap-2 border-0 p-0 m-0 lh-sm">
                                                <svg class="text-primary flex-shrink-0" aria-hidden="true" viewBox="0 0 16 16" width="16" height="16" fill="currentColor"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.02L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>
                                                <span><?php echo esc_html($item); ?></span>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>
                            <a href="<?php echo esc_url(velocity_spa_booking_url($current_service_id)); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary rounded-pill px-4 py-2 text-uppercase fw-bold">
                                <svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true"><path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/></svg>
                                <?php esc_html_e('Booking', 'justg'); ?>
                            </a>
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
                        <h2 class="h3 fw-bold mb-4"><?php esc_html_e('Layanan Terkait', 'justg'); ?></h2>
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
