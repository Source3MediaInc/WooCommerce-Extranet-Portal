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

		<div class="shipping_address">

			<?php do_action('woocommerce_before_checkout_shipping_form', $checkout ); ?>

			<div class="woocommerce-shipping-fields__field-wrapper">
				<h3>Shipping details</h3>
				<label>Pick a rep from the list or enter information below</label>
				<select data-live-search="true"  id="wooaddresslist" name="wooaddresslist" class="form-control form-control-sm">
				<option>Please select an option</option>
				    <?php
								$entries = array();
				        $args = ['post_type'=>'addressbook'];
				        $address_book_query = New WP_query($args);
				        if($address_book_query->have_posts()) : while($address_book_query->have_posts()) : $address_book_query->the_post();

				                $entries['id'] = get_the_id();
				                $entries['fname'] = get_field('fname');
				                $entries['lname'] = get_field('lname');
				                $entries['custid'] = get_field('customer_id');
				                $entries['company'] = get_field('company');
				                $entries['addr1'] = get_field('address_line_1');
				                $entries['addr2'] = get_field('address_line_2');
				                $entries['city'] = get_field('city');
				                $entries['state'] = get_field('state');
												$entries['zip'] = get_field('zip');

												$fieldsarray = json_encode($entries);

				    ?>
				        <option data-tokens="<?php echo $entries['id'];?>" value="<?php echo $entries['id'];?>"><?php echo $entries['company'];?> <?php echo $entries['custid'];?> <?php echo $entries['lname'];?>, <?php echo $entries['fname'];?>, <?php echo $entries['addr1'];?></option>
				    <?php
				        endwhile;
				        endif;
				        wp_reset_query();
				    ?>
				</select>
<?php if(count($entries) > 0) { ?>
				<script>
					function populateFields() {
						alert('Gathering representatives...')
						$.ajax({
							type: "POST",
							url: "form-shipping.php",
							data:
								{<?php $i=0; foreach($entries as $entry) { extract($entries); ?>
									"id": <?php echo $id;?>,
									"fname": <?php echo $fname;?>,
									"lname": <?php echo $lname;?>,
									"custid": <?php echo $custid;?>,
									"company": <?php echo $company;?>,
									"addr1": <?php echo $addr1;?>,
									"addr2": <?php echo $addr2;?>,
									"city": <?php echo $city;?>,
									"state": <?php echo $state;?>,
									"zip": <?php echo $zip;?>,
								} ,
								<?php $i++; } ?>

							dataType: 'text';
							success function (){

							}
						});
						//if option value is equal to $ID, echo fields that match $ID

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
						if(select.value = "<?php echo $entries['id'];?>" ){
							shpFName.innerHTML('<?php echo $entries['fname'];?>');
							shpLName.innerHTML('<?php echo $entries['lname'];?>');
						}
					}
				</script>
<?php }
					$fields = $checkout->get_checkout_fields( 'shipping' );
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
