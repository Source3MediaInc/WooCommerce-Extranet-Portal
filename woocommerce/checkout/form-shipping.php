<?php
/**
 * Checkout shipping information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-shipping.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.9
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="woocommerce-shipping-fields">
	<?php if ( true === WC()->cart->needs_shipping_address() ) : ?>

		<h3 id="ship-to-different-address">
			<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
				<input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" /> <span><?php _e( 'Ship to a different address?', permaslug() ); ?></span>
			</label>
		</h3>

		<div class="shipping_address">

			<?php do_action('woocommerce_before_checkout_shipping_form', $checkout ); ?>

			<div class="woocommerce-shipping-fields__field-wrapper">
				<label>Pick a rep from the list or enter information below</label>
				<select id="wooaddresslist" name="wooaddresslist" class="form-control form-control-sm">
					<option>Please select an option</option>
					<?php
						$posts = array();
						$args = array('post_type'=>'addressbook');
						$query = New WP_query($args);

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

							if(!empty($posts)){
								foreach($posts as $post){?>
									<option value="<?php echo $id;?>"><span id="<?php echo $id . 'fname';?>"><?php echo $fname;?></span></option>
								<?php }
							}
						endwhile;endif;wp_reset_postdata();
					?>
				</select>

					<?php
					$fields = $checkout->get_checkout_fields( 'shipping' );
					add_addressbook_checkout_field( $fields );
					foreach ( $fields as $key => $field ) {

						if ( isset( $field['country_field'], $fields[ $field['country_field'] ] ) ) {
							$field['country'] = $checkout->get_value( $field['country_field'] );
						}
						woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
					}
				?>
			</div>

			<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

		</div>

	<?php endif; ?>
</div>
<div class="woocommerce-additional-fields">
	<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

	<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

		<?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>

			<h3><?php _e( 'Additional information', permaslug() ); ?></h3>

		<?php endif; ?>

		<div class="woocommerce-additional-fields__field-wrapper">
			<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
				<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
			<?php endforeach; ?>
		</div>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
</div>
