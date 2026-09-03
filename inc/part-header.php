<?php 
$email = velocitytheme_option('email');
$nowa = velocitytheme_option('nowa');
if (substr($nowa, 0, 1) === '0') {
    $nowa    = '62' . substr($nowa, 1);
} else if (substr($nowa, 0, 1) === '+') {
    $nowa    = '' . substr($nowa, 1);
}
?>
<div class="bg-colortheme">
    <div class="container d-flex justify-content-start align-items-center bg-transparent py-md-0 p-1">
        <div class="px-2 my-2"><a class="text-white" href="https://wa.me/<?php echo $nowa;?>">
            <div class="d-flex justify-content-start align-items-center">
                <span><i class="bg-light rounded-5 fa fa-whatsapp text-dark" aria-hidden="true" style="padding: 5px;"></i></span>
                <span class="ps-2">+<?php echo $nowa;?></span>
            </div>
        </a></div>
        <div class="px-2 my-2"><a class="text-white" href="mailto:<?php echo $email;?>" target="_blank">
            <div class="d-flex justify-content-start align-items-center">
                <span><i class="bg-light rounded-5 fa fa-envelope text-dark" aria-hidden="true" style="padding: 5px;"></i></span>
                <span class="ps-2"><?php echo $email;?></span>
            </div>
        </a></div>
    </div>
</div>

<div class="container px-0">
<nav id="main-navi" class="navbar navbar-expand-md d-block navbar-light pb-0 px-0 pt-0" aria-labelledby="main-nav-label">

    <h2 id="main-nav-label" class="screen-reader-text">
        <?php esc_html_e('Main Navigation', 'justg'); ?>
    </h2>

    <div class="row align-items-center m-0 py-2">
        <div class="col-9 col-md-3 px-md-0">
            <?php if (has_custom_logo()) {
                echo '<a href="'.get_home_url().'">';
                    echo get_custom_logo();
                echo '</a>';
            } ?>
        </div>
        <div class="col-3 col-md-9 px-md-0">

            <div class="offcanvas offcanvas-start" tabindex="-1" id="navbarNavOffcanvas">

                <div class="offcanvas-header justify-content-end">
                    <button type="button" class="btn-close btn-close-dark text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div><!-- .offcancas-header -->

                <!-- The WordPress Menu goes here -->
                <?php
                wp_nav_menu(
                    array(
                        'theme_location'  => 'primary',
                        'container_class' => 'offcanvas-body',
                        'container_id'    => '',
                        'menu_class'      => 'navbar-nav navbar-light justify-content-end flex-md-wrap flex-grow-1',
                        'fallback_cb'     => '',
                        'menu_id'         => 'primary-menu',
                        'depth'           => 4,
                        'walker'          => new justg_WP_Bootstrap_Navwalker(),
                    )
                ); ?>

            </div><!-- .offcanvas -->

            <div class="menu-header d-md-none position-relative text-end" data-bs-theme="dark">
                <button class="navbar-toggler bg-colortheme" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarNavOffcanvas" aria-controls="navbarNavOffcanvas" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'justg'); ?>">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </div>
    </div>

</nav><!-- .site-navigation -->
</div>