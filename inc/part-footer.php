<footer class="site-footer p-0" id="colophon">
    <div class="card m-0 bg-colortheme rounded-0 border-0 py-3">
        <div class="container bg-transparent px-0">
        <?php if (is_active_sidebar('footer-widget-1')) : ?>
            <div class="velocity-footer">
                <div class="row footer-widget text-start py-5">
                    <?php for ($x = 1; $x <= 3; $x++) {
                        if (is_active_sidebar('footer-widget-' . $x)) : ?>
                            <div class="col-md mb-2">
                                <div class="card border-0 h-100">
                                    <?php dynamic_sidebar('footer-widget-' . $x); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php } ?>
                </div>
            </div>
        <?php endif; ?>
        </div>
    </div>

    <div class="site-info bg-light text-center text-dark py-4 bg-opacity-25">
        <div class="container bg-transparent">
            <small>Copyright © <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.</small><br/>
            <small class="opacity-50">Design by <a class="text-dark" href="https://velocitydeveloper.com" target="_blank" rel="noopener noreferrer">Velocity Developer</a>.</small>
        </div>
    </div>
    <!-- .site-info -->
</footer>
