<?php
function pt_get_gallery_image_html( $attachment_id, $main_image = false ) {
	$flexslider        = (bool) apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) );
	$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
	$thumbnail_src     = wp_get_attachment_image_src( $attachment_id, $thumbnail_size );
	$full_src          = wp_get_attachment_image_src( $attachment_id, $full_size );
	$image             = wp_get_attachment_image( $attachment_id, $image_size, false, array(
		'title'                   => get_post_field( 'post_title', $attachment_id ),
		'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
		'data-src'                => $full_src[0],
		'data-large_image'        => $full_src[0],
		'data-large_image_width'  => $full_src[1],
		'data-large_image_height' => $full_src[2],
		'class'                   => $main_image ? 'pt-product-thumbnail' : '',
    'style'                   => 'max-width: 440px; width: 100%; height: auto;'
	) );

	return '<div data-thumb="' . esc_url( $thumbnail_src[0] ) . '" class="woocommerce-product-gallery__image">' . $image . '</div>';
}
add_filter( 'woo-init', 'pt_get_gallery_image_html' );
function product_sidebar(){
	wp_nav_menu( array(
		'theme_location'  => 'primary',
		'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
		'container'       => 'div',
		'container_class' => null,
		'menu_class'			=> 'list-unstyled',
		'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
		'walker'          => new WP_Bootstrap_Navwalker(),
	) );
	get_search_form();

}
add_filter( 'woo-init', 'product_sidebar' );
// Ensure cart contents update when products are added to the cart via AJAX (place the following in functions.php).
// Used in conjunction with https://gist.github.com/woogists/9a16fd2d0c982e780a5de89c30cbbd25
// Compatible with WooCommerce 3.0+. Thanks to Alex for assisting with an update!

function portal_cart_link($url) {
	?>
		<a class="cart-contents" href="/cart" title="<?php esc_attr_e( 'View your shopping cart', permaslug() ); ?>">
			<span class="cart-contents-count"><?php echo WC()->cart->get_cart_contents_count();?></span>
		</a>
	<?php
}
add_filter( 'woo-init', 'portal_cart_link' );
function product_query() {

	        $args = array(
	            'post_type' => 'product',
	        );

	        $loop = new WP_Query( $args );

	        if($loop->have_posts()):while ( $loop->have_posts() ) : $loop->the_post();
	            global $product;
	            echo '<div class="col-md-3 product"><a href="'.get_permalink().'"><img class="img-responsive" src="' . get_the_post_thumbnail_url( $post->ID) .'"  /><br /><p class="text-center">' . get_the_title() . '</p></a></div>';
	        endwhile;endif;

	        wp_reset_postdata();
}

function sp_custom_low_stock_notification_product_30( $order ) {
	/**
	 * Set a different treshold per product ID
	 * The Product ID is set in the 'key' and the stock threshold the 'value'.
	 */
	$stock_thresholds_products = array(
		152 => 500,
		149 => 500
	);
	foreach ( $order->get_items() as $item ) {
		if ( $item->is_type( 'line_item' ) && ( $product = $item->get_product() ) && $product->managing_stock() ) {
			$new_stock = $item->get_quantity();
			// Loop through stock threshold products
			foreach ( $stock_thresholds_products as $product_id => $threshold ) {
				if ( $product->get_id() == $product_id && $new_stock < $threshold ) {
					do_action( 'woocommerce_low_stock', $product );
				}
			}
		}
	}
}
add_action( 'woocommerce_reduce_order_stock', 'sp_custom_low_stock_notification_product_30', 10, 3 );

?>
