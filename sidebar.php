<?php

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary" aria-label="<?php esc_attr_e( 'Blog Sidebar', permaslug() ); ?>">
	<?php product_sidebar(); ?>
</aside><!-- #secondary -->
