<?php
/* Template Name: Home Template */ 

get_header();
$container = velocitytheme_option('justg_container_type', 'container');
$sliders = velocitytheme_option('slider_repeat');
?>

<div class="wrapper p-0" id="index-wrapper">
    <div id="carouselExampleInterval" class="carousel slide carousel-fade mb-4" data-bs-ride="carousel">
        <div class="carousel-inner">
        <?php $i = 0;
            foreach ($sliders as $slider) : $i++;
            $active = $i==1 ? 'active' : '';?>
                <div class="carousel-item <?php echo $active;?>" data-bs-interval="3000">
                    <img class="ratio ratio-16x9" src="<?php echo $slider['imgslider']; ?>" alt="...">
                </div>
            <?php endforeach; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="" id="content" tabindex="-1">
        <main class="site-main col order-2" id="main">
            <?php if(velocitytheme_option('team_home') == 'on') :?>
            <div class="<?php echo esc_attr($container); ?> my-5">
                <div class="produk-content">
                <?php
                    $args = [
                        'post_type' => 'team', // Ganti 'produk' dengan nama post type custom Anda
                        'posts_per_page' => 4, // Jumlah post yang ingin ditampilkan
                        'order' => 'DESC',
                        'orderby' => 'date',
                    ];
                    
                    // Membuat instance WP_Query
                    $product_query = new WP_Query($args);
                    
                    // Loop untuk menampilkan post
                    if ($product_query->have_posts()) { ?>
                
                    <h3 class="titleLayanan text-light text-center h4"><span><?php echo velocitytheme_option('title_team');?></span></h3>
                        <div class="splide mt-5">
                            <div class="splide__track">
                                <ul class="splide__list">
                            <?php while ($product_query->have_posts()) : $product_query->the_post();?>
                                <article <?php post_class('splide__slide team-item'); ?> id="post-<?php the_ID(); ?>">
                                    <div class="card bg-light p-3 border-0 rounded-3 shadow">
                                        <a href="<?php echo get_permalink();?>">
                                            <img src="<?php echo aq_resize( get_the_post_thumbnail_url(), 300, 350, true, true, true ); ?>" class="w-100" alt="<?php echo get_the_title(); ?>"/>
                                        </a>
                                        <?php the_title( sprintf( '<h2 class="entry-title text-center h4 fw-bold p-2 m-0"><a class="text-dark" href="%s" rel="bookmark">', esc_url( get_permalink() ) ),
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
                </div>
            </div>
            <?php endif; ?>
            
            <?php if(velocitytheme_option('layanan_home') == 'on') :?>
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
                    <h3 class="titleLayanan text-light text-center h4"><span><?php echo velocitytheme_option('title_layanan');?></span></h3>
                    <div class="row mt-5">
                    <?php
                        // Start the loop.
                        while ($layanan_query->have_posts()) : $layanan_query->the_post();
                            get_template_part('loop-templates/content', 'layanan');
                        endwhile;
                    ?>
                    </div>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </main><!-- #main -->
    </div><!-- #content -->

</div><!-- #index-wrapper -->

<?php
get_footer();