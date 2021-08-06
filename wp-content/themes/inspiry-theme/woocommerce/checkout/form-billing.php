<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined( 'ABSPATH' ) || exit;
?>
<div class="woocommerce-billing-fields">
	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>

		<h3><?php esc_html_e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h3>

	<?php else : ?>

		<h3 class="roboto-font medium"><?php esc_html_e( 'Billing details', 'woocommerce' ); ?></h3>

	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<div class="woocommerce-billing-fields__field-wrapper">
		<?php
		$fields = $checkout->get_checkout_fields( 'billing' );

		foreach ( $fields as $key => $field ) {
			woocommerce_form_field( $key, $field, $checkout->get_value( $key ) );
		}
		?>
	</div>

	<?php do_action( 'woocommerce_after_checkout_billing_form', $checkout ); ?>
</div>

<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
	<div class="woocommerce-account-fields">
		<?php if ( ! $checkout->is_registration_required() ) : ?>

			<p class="form-row form-row-wide create-account">
				<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e( 'Create an account?', 'woocommerce' ); ?></span>
				</label>
			</p>

		<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
				<?php foreach ( $checkout->get_checkout_fields( 'account' ) as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
				<div class="clear"></div>
			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
	</div>
<?php endif; ?>

<!-- custom code --------------------------------------- -->
		<!-- <div class="payment-gateway-container" >
			<img src="http://localhost/inspiry/wp-content/uploads/2021/05/Inspiry_Logo-transparent-1-300x55-1.png" />
				<div id="payment-iframe-container"> 
				<div class="button-container" >
					<button class="windcave-submit-button" >Submit</button> 
					<div class="cancel-payment" >Cancel Payment</div> 
				</div>

			</div> 
		</div>  -->
<!-- <?php 
		// checkout page - add windcave iframe
// 		add_action('woocommerce_after_checkout_billing_form', 'windcave_iframe'); 

// 		function windcave_iframe(){ 
// 		echo '
// 		<div class="payment-gateway-container" >
// 		<img src='; 
// 		echo  "http://localhost/inspiry/wp-content/uploads/2021/05/Inspiry_Logo-transparent-1-300x55-1.png";
// 		echo' />
// 		<div id="payment-iframe-container"> 
// 		<div class="button-container" >
// 		<button class="windcave-submit-button" >Submit</button> 
// 		<div class="cancel-payment" >Cancel Payment</div> 
// 		</div>

// 		</div> 
// 		</div> 
// 		';
// }


?> -->
<!-- <?php 
	// // https request to windcave to create a session 
	// $ch = curl_init();
	// curl_setopt($ch, CURLOPT_URL, "https://uat.windcave.com/api/v1/sessions");
	// curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
	// curl_setopt($ch, CURLOPT_HEADER, FALSE);

	// curl_setopt($ch, CURLOPT_POST, TRUE);

	// curl_setopt($ch, CURLOPT_POSTFIELDS, "{
	// \"type\": \"purchase\",
	// \"methods\": [
	// 	\"card\"
	// ],
	// \"amount\": \"1.03\",
	// \"currency\": \"NZD\",
	// \"callbackUrls\": {
	// 	\"approved\": \"https://localhost/success\",
	// 	\"declined\": \"https://localhost/failure\"
	// }
	// }");

	// curl_setopt($ch, CURLOPT_HTTPHEADER, array(
	// "Content-Type: application/json",
	// "Authorization: Basic SW5zcGlyeV9SZXN0OmI0NGFiMjZmOWFkNzIwNDQ4OTc0MGQ1YWM3NmE5YzE2ZDgzNDJmODUwYTRlYjQ1NTc1NmRiNDgyYjFiYWVjMjk="
	// ));

	// $response = curl_exec($ch);
	// $obj = json_decode($response);

	// curl_close($ch);
	// $seamlessHpp = '';
	// // for each loop to get seamless_hpp url 
	// foreach ($obj->links as $obj) {
	// 	if($obj->rel=== "seamless_hpp"){
	// 	$seamlessHpp =  $obj->href;
	// 	}
	// }
?>

<script>
	let $= jQuery;
	WindcavePayments.Seamless.prepareIframe({
		url: "<?php echo $seamlessHpp; ?>",
		containerId: "payment-iframe-container",
		loadTimeout: 30,
		width: 400,
		height: 500,
		onProcessed: function () { console.log('iframes is loaded properly ') },
		onError: function (error) {
			console.log(error)
			console.log('this is and error event after loading ')
		}
	});

			$(document).on('click', '.windcave-submit-button', (e) => {
					//  e.preventDefault();
			console.log('windcave submit button');
			WindcavePayments.Seamless.validate({
				onProcessed: function (isValid) { 
					console.log(isValid)
					console.log('Card is valid')
					WindcavePayments.Seamless.submit({
						showSpinner: true,
						onProcessed: function() { console.log('submitted') },
						onError: function(error) { console.log('submission error') }
					});
					
				},
				onError: function (error) {
					console.log('this is an error')
					console.log(error) 
				}
			});

			})
</script>  -->