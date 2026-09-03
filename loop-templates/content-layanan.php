<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package velocity
 */
$fasilitas_layanan = get_post_meta($post->ID, 'fasilitas', true);
$fasilitas_layanan = is_array($fasilitas_layanan) ? $fasilitas_layanan : array();
$harga_layanan = velocity_spa_service_price(get_the_ID());
?>
<article <?php post_class('col-lg-4 col-md-6 col-12 mb-4'); ?> id="post-<?php the_ID(); ?>">
    <div class="card h-100 border-0 rounded-4 shadow-sm overflow-hidden">
        <div class="overflow-hidden">
            <?php velocity_spa_post_thumbnail(get_the_ID(), 'ratio-4x3'); ?>
        </div>
        <div class="card-body d-flex flex-column gap-3 p-4">
            <h2 class="h5 fw-bold text-center m-0"><a class="text-dark" href="<?php echo esc_url(get_permalink()); ?>" rel="bookmark"><?php echo esc_html(wp_trim_words(get_the_title(), 5)); ?></a></h2>
            <?php if ($harga_layanan) : ?>
                <p class="h5 fw-bold text-colortheme text-center mb-0"><?php echo esc_html($harga_layanan); ?></p>
            <?php endif; ?>
            <ul class="spa-service-features list-unstyled d-grid gap-2 text-body-secondary m-0">
            <?php foreach($fasilitas_layanan as $fasilitas): ?>
                <li class="d-flex align-items-start gap-2 border-0 p-0 m-0 lh-sm">
                    <svg class="text-primary flex-shrink-0" aria-hidden="true" viewBox="0 0 16 16" width="16" height="16" fill="currentColor"><path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.02L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/></svg>
                    <span><?php echo esc_html($fasilitas); ?></span>
                </li>
            <?php endforeach; ?>
            </ul>
        </div>
        <div class="px-4 pb-4 mt-auto">
            <a href="<?php echo esc_url(velocity_spa_booking_url(get_the_ID())); ?>" target="_blank" rel="noopener noreferrer" class="btn btn-primary rounded-pill w-100 py-2 text-uppercase fw-bold">Booking</a>
        </div>
    </div>
</article><!-- #post-## -->
