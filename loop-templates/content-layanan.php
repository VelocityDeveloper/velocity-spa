<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package velocity
 */
$pesan  = velocity_spa_get_option('pesan', 'Halo, saya ingin menanyakan tentang layanan.');
$nowa   = velocity_spa_normalize_phone(velocity_spa_get_option('nowa'));
$fasilitas_layanan = get_post_meta($post->ID, 'fasilitas', true);
$fasilitas_layanan = is_array($fasilitas_layanan) ? $fasilitas_layanan : array();
?>
<article <?php post_class('col-md-4 col-12 container border-0 mb-3'); ?> id="post-<?php the_ID(); ?>">
    <div class="card p-0 border-0">
	<?php velocity_spa_post_thumbnail(get_the_ID(), 'ratio-4x3'); ?>
        <h2 class="entry-title bg-light text-center h5 fw-bold p-2 m-0"><a class="text-dark" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo wp_trim_words(get_the_title(), 5); ?></a></h2>
        <div class="bg-colortheme text-white p-2">
            <ul>
            <?php foreach($fasilitas_layanan as $fasilitas): ?>
                <li class="unlist-style"><?php echo esc_html($fasilitas); ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
        <div class="halCircles bg-colortheme text-white">
            <a href="<?php echo esc_url('https://api.whatsapp.com/send?phone=' . $nowa . '&text=' . rawurlencode($pesan)); ?>" target="_blank" rel="noopener noreferrer" class="btn w-100 text-uppercase fw-bold text-light p-4">Booking</a>
        </div>
    </div>
</article><!-- #post-## -->
