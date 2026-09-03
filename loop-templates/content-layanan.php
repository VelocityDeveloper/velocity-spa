<?php
/**
 * Post rendering content according to caller of get_template_part.
 *
 * @package velocity
 */
$pesan  = velocitytheme_option('pesan');
$nowa   = velocitytheme_option('nowa');
if (substr($nowa, 0, 1) === '0') {
    $nowa    = '62' . substr($nowa, 1);
} else if (substr($nowa, 0, 1) === '+') {
    $nowa    = '' . substr($nowa, 1);
}
$fasilitas_layanan = get_post_meta($post->ID, 'fasilitas', true);
?>
<article <?php post_class('col-md-4 col-12 container border-0 mb-3'); ?> id="post-<?php the_ID(); ?>">
    <div class="card p-0 border-0">
    	<a href="<?php echo get_permalink();?>">
    	    <img src="<?php echo aq_resize( get_the_post_thumbnail_url(), 350, 250, true, true, true ); ?>" class="w-100" alt="<?php echo get_the_title(); ?>"/>
    	</a>
        <h2 class="entry-title bg-light text-center h5 fw-bold p-2 m-0"><a class="text-dark" href="<?php echo esc_url( get_permalink() ); ?>" rel="bookmark"><?php echo wp_trim_words(get_the_title(), 5); ?></a></h2>
        <div class="bg-colortheme text-white p-2">
            <ul>
            <?php foreach($fasilitas_layanan as $fasilitas): ?>
                <li class="unlist-style"><?php echo $fasilitas; ?></li>
            <?php endforeach; ?>
            </ul>
        </div>
        <div class="halCircles bg-colortheme text-white">
            <a href="https://api.whatsapp.com/send?phone=<?php echo $nowa; ?>&text=<?php echo urlencode($pesan); ?>" target="_blank" class="btn w-100 text-uppercase fw-bold text-light p-4">Booking</a>
        </div>
    </div>
</article><!-- #post-## -->