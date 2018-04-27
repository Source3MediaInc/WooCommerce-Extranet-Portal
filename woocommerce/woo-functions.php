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
		<a class="cart-contents" href="<?php echo $url; ?>" title="<?php esc_attr_e( 'View your shopping cart', permaslug() ); ?>">
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
	            echo '<div class="col-md-3 product"><a href="'.get_permalink().'"><img class="img-responsive" src="' . get_the_post_thumbnail_url( $post->ID) .'"  /><br /><h3 class="text-center">' . get_the_title() . '</h3></a></div>';
	        endwhile;endif;

	        wp_reset_postdata();
}
	add_filter( 'woocommerce_checkout_fields' , 'add_addressbook_checkout_field', 20, 1 );
	function add_addressbook_checkout_field( $fields ) {

		$options = array();

		// First option
		$options[0] = 'Please select something…';

		// Get 'addressbook' posts
		$posts = array();
		$args = array('post_type'=>'addressbook', 'posts_per_page'=>-1,'order'=>'asc');
		$query = New WP_Query($args);
		if($query->have_posts()):while($query->have_posts()):$query->the_post();

			$temp = array();
			$temp['id'] = get_the_id();
			$temp['fname'] = get_field('fname');
			$temp['lname'] = get_field('lname');
			$temp['company'] = get_field('company');
			$temp['addr1'] = get_field('address_line_1');
			$temp['addr2'] = get_field('address_line_2');
			$temp['city'] = get_field('city');
			$temp['state'] = get_field('state');
			$temp['zip'] = get_field('zip');
			$posts = $temp;

			$id 			=	$posts['id'];
			$fname 		= $posts['fname'];
			$lname 		= $posts['lname'];
			$company 	= $posts['company'];
			$addr1 		= $posts['addr1'];
			$addr2 		= $posts['addr2'];
			$city 		= $posts['city'];
			$state 		= $posts['state'];
			$zip 			= $posts['zip'];
			// Loop through 'addressbook' posts (to set all other select options)
			foreach( $posts as $post ){
					// Set each complete name as an option (Where key is the post ID)
					$options[$id] = $company  . ', '. $fname  . ' '. $lname . ', ' . $addr1 . '....';
			}

		endwhile;endif;wp_reset_postdata();
		$fields['shipping']['addressbook'] = array(
				'type'          => 'select',
				'label'         => __('Pick a rep from the list or enter information below', $permaslug),
				'placeholder'   => _x('Pick an address', 'placeholder', $permaslug),
				'options'       =>  $options, // Here we set the options
				'required'      => false,
				'priority'      => 1,
				'class'         => array('form-row-wide'),
				'clear'         => true
		);

		return $fields;

	}

	// process custom checkout field
	add_action('woocommerce_checkout_process', 'check_addressbook_checkout_field', 20 );
	function check_addressbook_checkout_field( $order, $data ) {
		if ( isset($_POST['addressbook']) && empty($_POST['addressbook']) )
				wc_add_notice( __("Please pick an address from the Address Book"), 'error' );
	}
?>
