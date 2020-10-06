<aside class="widget-area">
    <div class="sidebar">
        <?php if ( is_active_sidebar( 'sidebar' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar' ); ?>
        <?php endif; ?>
    </div>

    <div class="sidebar2">
        <?php if ( is_active_sidebar( 'sidebar2' ) ) : ?>
        <?php dynamic_sidebar( 'sidebar2' ); ?>
        <?php endif; ?>
    </div>
</aside>