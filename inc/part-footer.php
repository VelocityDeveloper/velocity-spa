<footer class="site-footer p-0" id="colophon">
    <div class="card m-0 bg-colortheme rounded-0 border-0 py-3">
        <div class="container bg-transparent">
        <?php if (is_active_sidebar('footer-widget-1')) : ?>
            <div class="velocity-footer">
                <div class="row footer-widget text-start mx-auto px-2 pt-4">
                    <?php for ($x = 1; $x <= 4; $x++) {
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

    <div class="site-info bg-secondary text-center text-dark p-2 bg-opacity-25">
        <div class="container bg-transparent">
            <small>Copyright © <?php echo date("Y"); ?> <?php echo get_bloginfo('name'); ?>. All Rights Reserved.</small><br/>
            <small class="opacity-50">Design by <a class="text-dark" href="https://velocitydeveloper.com" target="_blank" rel="noopener noreferrer"> Velocity Developer </a></small>
        </div>
    </div>
    <!-- .site-info -->
</footer>