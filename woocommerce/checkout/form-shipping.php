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
?>
<script>
jQuery(document).ready(function() {
    jQuery('#wooaddresslist').select2();
});
</script>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

add_filter('woocommerce_states','custom_province', 10, 1);

function custom_province($states){
		$states = array(
				'AB' => __( 'Alberta', permaslug() ),
				'BC' => __( 'British Columbia', permaslug() ),
				'MB' => __( 'Manitoba', permaslug() ),
				'NB' => __( 'New Brunswick', permaslug() ),
				'NL' => __( 'Newfoundland and Labrador', permaslug() ),
				'NT' => __( 'Northwest Territories', permaslug() ),
				'NS' => __( 'Nova Scotia', permaslug() ),
				'NU' => __( 'Nunavut', permaslug() ),
				'ON' => __( 'Ontario', permaslug() ),
				'PE' => __( 'Prince Edward Island', permaslug() ),
				'QC' => __( 'Quebec', permaslug() ),
				'SK' => __( 'Saskatchewan', permaslug() ),
				'YT' => __( 'Yukon', permaslug() )
		);
		return $states;
}

?>
<div class="woocommerce-shipping-fields">
	<?php if ( true === WC()->cart->needs_shipping_address() ) : ?>

		<div class="shipping_address">

			<?php do_action('woocommerce_before_checkout_shipping_form', $checkout ); ?>

			<div class="woocommerce-shipping-fields__field-wrapper">

				<h3 id="ship-to-different-address">Shipping details
					<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox" style="float: right">
						<input id="ship-to-different-address-checkbox" class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" <?php checked( apply_filters( 'woocommerce_ship_to_different_address_checked', 'shipping' === get_option( 'woocommerce_ship_to_destination' ) ? 1 : 0 ), 1 ); ?> type="checkbox" name="ship_to_different_address" value="1" /> <span><?php _e( 'Ship to a different address?', permaslug() ); ?></span>
					</label>
				</h3>


				<label style="width: 100%;">Pick a rep from the list or enter information below<span id="clearfields" name="clearfields" style="float: right;" class="btn btn-info">Clear Fields</span></label>
				<select id="wooaddresslist" name="wooaddresslist" class="form-control form-control-sm">
				<option>Please select an option</option>
				    <?php
								$entries = array();
				        $args = ['post_type'=>'addressbook', 'orderby'=>'title','posts_per_page'=>1000000];
				        $address_book_query = New WP_query($args);
				        if($address_book_query->have_posts()) : while($address_book_query->have_posts()) : $address_book_query->the_post();

				                $entries['id'] = get_the_id();
				                $entries['fname'] = get_field('fname');
				                $entries['lname'] = get_field('lname');
				                $entries['custid'] = get_field('customer_id');
												$entries['company'] = get_field('company');
				                $entries['country'] = get_field('country');
				                $entries['addr1'] = get_field('address_line_1');
				                $entries['addr2'] = get_field('address_line_2');
				                $entries['city'] = get_field('city');
												$entries['state'] = get_field('state');
				                $entries['province'] = get_field('province');
												$entries['zip'] = get_field('zip');

												$fieldsarray = json_encode($entries);

				    ?>
				        <option value="<?php echo $entries['id'];?>">#<?php echo $entries['custid'];?>, <?php echo $entries['company'];?>, <?php echo $entries['lname'];?>, <?php echo $entries['fname'];?>, <?php echo $entries['addr1'];?></option>
				    <?php
				        endwhile;
				        endif;
				        wp_reset_query();
				    ?>
				</select>



				<script>
					jQuery(document).ready(function(){
						//if option value is equal to ID, echo fields that match ID

						var select = document.getElementById('wooaddresslist');

						var shpFName = document.getElementById('shipping_first_name');
						var shpLName = document.getElementById('shipping_last_name');
						var shpCompany = document.getElementById('shipping_company');
						var shpCountry = document.getElementById('shipping_country');
						var shpADDR1 = document.getElementById('shipping_address_1');
						var shpADDR2 = document.getElementById('shipping_address_2');
						var shpCity = document.getElementById('shipping_city');
						var shpState = document.getElementById('shipping_state');
						var shpZIP = document.getElementById('shipping_postcode');
						jQuery("#wooaddresslist").change(function(){
							<?php
							$args = ['post_type'=>'addressbook','posts_per_page'=>1000000];
							$address_book_query = New WP_query($args);
							if($address_book_query->have_posts()) : while($address_book_query->have_posts()) : $address_book_query->the_post();
							$entries['id'] = get_the_id();
							$entries['fname'] = get_field('fname');
							$entries['lname'] = get_field('lname');
							$entries['custid'] = get_field('customer_id');
							$entries['company'] = get_field('company');
							$entries['country'] = get_field('country');
							$entries['addr1'] = get_field('address_line_1');
							$entries['addr2'] = get_field('address_line_2');
							$entries['city'] = get_field('city');
							$entries['state'] = get_field('state');
							$entries['province'] = get_field('province');
							$entries['zip'] = get_field('zip');
							?>
							if(select.value == "<?php echo $entries['id']; ?>"){
								jQuery('#shipping_first_name').val('<?php echo $entries['fname'];?>');
								jQuery('#customer_number').val('<?php echo $entries['custid'];?>');
								jQuery('#shipping_last_name').val('<?php echo $entries['lname'];?>');
								jQuery('#shipping_company').val('<?php echo $entries['company'];?>');
								jQuery('#shipping_address_1').val('<?php echo $entries['addr1'];?>');
								jQuery('#shipping_address_2').val('<?php echo $entries['addr2'];?>');
								jQuery('#shipping_country').val('<?php echo $entries['country'];?>');
								jQuery('#shipping_city').val('<?php echo $entries['city'];?>');
								jQuery('#shipping_state').val('<?php echo $entries['state'];?>');
								jQuery('#shipping_postcode').val('<?php echo $entries['zip'];?>');
							}
							<?php
							endwhile;endif;wp_reset_postdata();
							?>
						});
						jQuery('#clearfields').click(function(){
							jQuery('#shipping_first_name').val(' ');
							jQuery('#customer_number').val(' ');
							jQuery('#shipping_last_name').val(' ');
							jQuery('#shipping_company').val(' ');
							jQuery('#shipping_address_1').val(' ');
							jQuery('#shipping_address_2').val(' ');
							jQuery('#shipping_country').val('');
							jQuery('#shipping_city').val(' ');
							jQuery('#shipping_state').val('');
							jQuery('#shipping_postcode').val(' ');
						});
					});
				</script>
<?php //}
				/**
				 * Add the field to the checkout
				 **/
				add_action('woocommerce_before_order_notes', 'my_custom_checkout_field',30);

				function my_custom_checkout_field( $checkout ) {
					//Creates custom field
					woocommerce_form_field( 'customer_number', array(
						'type' 			=> 'text',
						'key'				=> 'Customer Number',
						'class' 		=> array('form-row-wide'),
						'label' 		=> __('Customer Number'),
						'placeholder' 	=> __('Enter a number'),
						'required'			=> false,
						), $checkout->get_value( 'customer_number' ));
					}

					add_filter("woocommerce_checkout_fields", "order_shipping_fields");

					function order_shipping_fields($fields) {

					$order = array(
						 "customer_number",
						 "shipping_first_name",
						 "shipping_last_name",
						 "shipping_location_type",
						 "shipping_address_1",
						 "shipping_address_2",
						 "shipping_city",
						 "shipping_state",
						 "shipping_postcode",
						 "shipping_country",
						 "shipping_email",
						 "shipping_phone"
					);
					foreach ($order as $field) {
						 $ordered_fields[$field] = $fields["shipping"][$field];
					}

					$fields["shipping"] = $ordered_fields;
					unset($fields['order']['order_comments']);
					return $fields;
					}

					add_action('woocommerce_checkout_process', 'my_custom_checkout_field_process');

					function my_custom_checkout_field_process() {
					    // Check if set, if its not set add an error.
					    if ( ! $_POST['customer_number'] )
					        wc_add_notice( __( 'Please enter a customer number.' ), 'error' );
					}
					//Adds custom field to the order meta
					add_action( 'woocommerce_checkout_update_order_meta', 'my_custom_checkout_field_update_order_meta' );

					function my_custom_checkout_field_update_order_meta( $order_id ) {
					    if ( ! empty( $_POST['customer_number'] ) ) {
					        update_post_meta( $order_id, 'Customer Number', sanitize_text_field( $_POST['customer_number'] ) );
					    }
					}
					//Displays custom field in the order area through the meta data
					add_action( 'woocommerce_admin_order_data_after_billing_address', 'my_custom_checkout_field_display_admin_order_meta', 10, 1 );

					function my_custom_checkout_field_display_admin_order_meta($order){
						echo '<p><strong>'.__('Customer Number').':</strong> ' . get_post_meta( $order->id(), '_customer_number', true ) . '</p>';
					}
					//Adds the custom field to the email when the customer places their order
					add_filter('woocommerce_email_order_meta_keys', 'my_custom_order_meta_keys');

					function my_custom_order_meta_keys( $keys ) {
					     $keys[] = 'Customer Number'; // This will look for a custom field called 'Customer Number' and add it to emails
					     return $keys;
					}
/* .............................................................. DONT REMOVE .............................................................. */

					$fields = $checkout->get_checkout_fields( 'shipping' );
					foreach ( $fields as $key => $field ) {

						if ( isset( $field['country_field'], $fields[ $field['country_field'] ] ) ) {
							$field['country'] = $checkout->get_value( $field['country_field'] );
						}
						woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
					}
/* .............................................................. DONT REMOVE .............................................................. */
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
