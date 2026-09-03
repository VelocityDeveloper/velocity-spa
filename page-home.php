<?php
/* Template Name: Home Template */ 

get_header();
$container = velocity_spa_get_option('justg_container_type', 'container');
$sliders = velocity_spa_get_sliders();
?>

<div class="wrapper p-0" id="index-wrapper">
    <?php if ($sliders) : ?>
    <div id="carouselExampleInterval" class="carousel slide carousel-fade mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
        <?php $i = 0;
            foreach ($sliders as $slider_url) : $i++;
            $active = $i==1 ? 'active' : '';?>
                <div class="carousel-item <?php echo $active;?>" data-bs-interval="3000">
                    <div class="ratio ratio-16x9">
                        <img class="w-100 h-100 object-fit-cover" src="<?php echo esc_url($slider_url); ?>" alt="<?php echo esc_attr(sprintf(__('Slider %d', 'justg'), $i)); ?>">
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev w-auto px-4" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next w-auto px-4" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <?php endif; ?>

    <div class="" id="content" tabindex="-1">
        <main class="site-main col order-2" id="main">
            <?php if(velocity_spa_get_option('layanan_home', 'on') === 'on') :?>
            <div class="<?php echo esc_attr($container); ?> bg-transparent py-5">
                <?php
                $args = [
                    'post_type' => 'layanan', // Ganti 'layanan' dengan nama post type custom Anda
                    'posts_per_page' => 6, // Jumlah post yang ingin ditampilkan
                    'order' => 'DESC',
                    'orderby' => 'date',
                ];
                
                // Membuat instance WP_Query
                $layanan_query = new WP_Query($args);
                
                // Loop untuk menampilkan post
                if ($layanan_query->have_posts()) : ?>
                    <h3 class="titleLayanan text-light text-center h4"><span><?php echo esc_html(velocity_spa_get_option('title_layanan', __('Layanan Kami', 'justg'))); ?></span></h3>
                    <div class="row mt-5">
                    <?php
                        // Start the loop.
                        while ($layanan_query->have_posts()) : $layanan_query->the_post();
                            get_template_part('loop-templates/content', 'layanan');
                        endwhile;
                    ?>
                    </div>
                <?php endif; ?>
                <?php wp_reset_postdata(); ?>
            </div>
            <?php endif; ?>

            <?php if(velocity_spa_get_option('team_home', 'on') === 'on') :?>
            <div class="<?php echo esc_attr($container); ?> my-5">
                <div class="produk-content">
                <?php
                    $args = [
                        'post_type' => 'team',
                        'posts_per_page' => 4,
                        'order' => 'DESC',
                        'orderby' => 'date',
                    ];
                    $product_query = new WP_Query($args);
                    if ($product_query->have_posts()) { ?>
                    <h3 class="titleLayanan text-light text-center h4"><span><?php echo esc_html(velocity_spa_get_option('title_team', __('Terapis Profesional', 'justg'))); ?></span></h3>
                        <div class="splide team-splide mt-4">
                            <div class="splide__track">
                                <ul class="splide__list">
                            <?php while ($product_query->have_posts()) : $product_query->the_post();?>
                                <article <?php post_class('splide__slide team-item px-2'); ?> id="post-<?php the_ID(); ?>">
                                    <div class="card h-100 border-0 rounded-4 shadow-sm p-2">
                                        <div class="overflow-hidden rounded-4"><?php velocity_spa_post_thumbnail(get_the_ID(), 'ratio-1x1'); ?></div>
                                        <?php the_title( sprintf( '<h2 class="h5 fw-bold text-center p-3 mb-0"><a class="text-dark" href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
                                            '</a></h2>' ); ?>
                                    </div>
                                </article><!-- #post-## -->
                            <?php endwhile;?>
                                </ul>
                            </div>
                        </div>
                <?php } else {
                        the_content();
                    }?>
                    <?php wp_reset_postdata(); ?>
                </div>
            </div>
            <?php endif; ?>
        </main><!-- #main -->
    </div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();
