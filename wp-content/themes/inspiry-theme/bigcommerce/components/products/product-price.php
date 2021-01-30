<?php
/**
 * Component: Product Price
 *
 * @description Display the price for a product
 *
 * @var Product $product
 * @var string  $visible HTML class name to indicate if default pricing should be visible
 * @var string  $price_range
 * @var string  $calculated_price_range
 * @var string  $retail_price
 * @version 1.0.0
 */

use BigCommerce\Post_Types\Product\Product;



?>
<!-- data-js="bc-cached-product-pricing" is required. -->
<p class="bc-product__pricing--cached <?php echo sanitize_html_class( $visible ); ?>" data-js="bc-cached-product-pricing">
<?php if ( $retail_price ) { ?>
	<!-- class="bc-product__retail-price" is required --><!-- class="bc-product__retail-price-value" is required -->
	<span class="bc-product__retail-price"><?php esc_html_e( 'MSRP:', 'bigcommerce' ); ?> <span class="bc-product__retail-price-value"><?php echo esc_html( $retail_price ); 
		//$priceValue = $retail_price; 
	?></span>
	</span>
<?php } ?>
<?php if ( $product->on_sale() ) { ?>
	<!-- class="bc-product__original-price" is required. -->
	<span class="bc-product__original-price"><?php echo esc_html( $price_range ) ?></span>
	<!-- class="bc-product__price" is required. -->
	<span class="bc-product__price bc-product__price--sale">
		<?php echo esc_html( $calculated_price_range ); 
			$priceValue = $calculated_price_range; 
		?>
		<h4> <?php 
/*coverting $calculated_price_range into integer*/
	$priceStringValue = array('$', ',');
	$value = str_replace($priceStringValue, '', $priceValue);
	$price = intval($value);
		
?> 
					<span class="lay-buy roboto-font">or 6 weekly interest-free payments from sale<?php 
					 echo  number_format ( $price/6, 2 ); 
						 
					 ?></span> 
					<span class="lay-buy lay-buy-open information-overlay"> <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/08/ico-laybuy.png"> What's this?</span>
	</h4>	
		
	</span>
	
<?php } else { ?>
	<!-- class="bc-product__price" is required. -->
	<span class="bc-product__price">
	<?php echo esc_html( $calculated_price_range ); 
				$priceValue = $calculated_price_range; 
				

	?>
		
		<h4> <?php 
/*coverting $calculated_price_range into integer*/
	$priceStringValue = array('$', ',');
	$value = str_replace($priceStringValue, '', $priceValue);
	$price = intval($value);
		
?> 
					<span class="lay-buy roboto-font">or 6 weekly interest-free payments from <?php 
					 echo  number_format ( $price/6, 2 ); 
						 
					 ?></span> 
					<span class="lay-buy lay-buy-open information-overlay"> <img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/08/ico-laybuy.png"> What's this?</span>
	</h4>	
	</span>
	
<?php } ?>
</p>

<!-- data-pricing-api-product-id & data-js="bc-api-product-pricing" is required. -->
<p class="bc-product__pricing--api roboto-font" data-js="bc-api-product-pricing" data-pricing-api-product-id="<?php echo esc_attr( $product->bc_id() ); ?>">
	<!-- class="bc-product__retail-price" is required --><!-- class="bc-product__retail-price-value" is required -->
	<span class="bc-product__retail-price"><?php esc_html_e( 'MSRP:', 'bigcommerce' ); ?> <span class="bc-product__retail-price-value"></span></span>
	<!-- class="bc-product-price bc-product__price--base" is required -->
	<span class="bc-product-price bc-product__price--base"></span>
	<!-- class="bc-product__original-price" is required -->
	<span class="bc-product__original-price"></span>
	<!-- class="bc-product-price bc-product__price--sale" is required -->
	<span class="bc-product__price bc-product__price--sale"> </span>
		
</p>








<section id="laybuy-popup">
	<div class="laybuy-popup-content box-shadow">
	<span class="dashicons dashicons-no-alt close-laybuy"></span>		
   
	<div class="popLogo">
		<svg id="Layer_1" class="laybuy-logo-overlay" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="100%" height="100%" viewBox="0 0 433.65 97.39">
			<defs>
				<style>
					.cls-2 {
						fill: #000;
					}
				</style>
			</defs>
			<title>consumer-logo</title>
			<path fill="#786DFF" d="M129,472.24,81.35,424.63a11.53,11.53,0,0,1,0-16.26h0a11.53,11.53,0,0,1,16.26,0l38.19,38.19a1.45,1.45,0,0,0,2.11,0L173,411.43l3.48-3.51a5.72,5.72,0,0,0,.05-8.21,5.94,5.94,0,0,0-8.4,0l-3.39,3.48-19.33,19.33a11.53,11.53,0,0,1-16.26,0h0l-23.1-23.1a11.53,11.53,0,0,1,0-16.26h0a11.53,11.53,0,0,1,16.26,0l13.92,14.17s1.06.78,1.84,0L149,386.45a28.83,28.83,0,1,1,40.78,40.78l-.47.47L145,472a11.53,11.53,0,0,1-16.26,0h0" transform="translate(-78 -377.99)"></path>
			<path class="cls-2" d="M231.76,415.23a1.69,1.69,0,0,1,3.38,0v41h25.42a1.56,1.56,0,1,1,0,3.12H233.45a1.72,1.72,0,0,1-1.69-1.69Z" transform="translate(-78 -377.99)"></path>
			<path class="cls-2" d="M272.38,457.09,291.82,415a2.38,2.38,0,0,1,2.27-1.62h.13A2.38,2.38,0,0,1,296.5,415l19.37,42a2.22,2.22,0,0,1,.26,1,1.6,1.6,0,0,1-1.62,1.56,2,2,0,0,1-1.69-1.3l-5.33-11.7H280.64l-5.33,11.77a1.72,1.72,0,0,1-1.62,1.23,1.52,1.52,0,0,1-1.56-1.43A2.42,2.42,0,0,1,272.38,457.09Zm33.67-13.59-12-26.33-12,26.33Z" transform="translate(-78 -377.99)"></path>
			<path class="cls-2" d="M337.52,441.3l-17.75-25a2.16,2.16,0,0,1-.33-1,1.78,1.78,0,0,1,1.76-1.69,1.81,1.81,0,0,1,1.56,1l16.51,23.73,16.58-23.73a1.85,1.85,0,0,1,1.5-1,1.76,1.76,0,0,1,1.69,1.63,2.51,2.51,0,0,1-.52,1.3L340.9,441.23v16.64a1.69,1.69,0,0,1-3.38,0Z" transform="translate(-78 -377.99)"></path>
			<path class="cls-2" d="M371.18,418.81a5,5,0,0,1,5-5h16.12c5.2,0,9.3,1.43,11.9,4a10.44,10.44,0,0,1,3.12,7.74v.13c0,5.14-2.73,8-6,9.82,5.27,2,8.52,5.07,8.52,11.18v.13c0,8.32-6.76,12.48-17,12.48H376.19a5,5,0,0,1-5-5Zm19,13.39c4.42,0,7.22-1.43,7.22-4.81v-.13c0-3-2.34-4.68-6.57-4.68h-9.88v9.62Zm2.67,18.33c4.42,0,7.08-1.56,7.08-4.94v-.13c0-3.05-2.28-4.94-7.41-4.94H380.93v10Z" transform="translate(-78 -377.99)"></path>
			<path class="cls-2" d="M420.65,439.8V418.42a5,5,0,0,1,10,0v21.13c0,7.41,3.71,11.25,9.82,11.25s9.82-3.71,9.82-10.92V418.42a5,5,0,0,1,10,0v21.06c0,13.78-7.74,20.54-20,20.54S420.65,453.19,420.65,439.8Z" transform="translate(-78 -377.99)"></path>
			<path class="cls-2" d="M485.65,441.75,471,421.8a5.93,5.93,0,0,1-1.24-3.58,4.89,4.89,0,0,1,5-4.81c2.27,0,3.71,1.23,4.94,3.06l11.05,15.93L502,416.34c1.24-1.82,2.73-3,4.81-3a4.64,4.64,0,0,1,4.88,4.88,6.22,6.22,0,0,1-1.3,3.51l-14.69,19.83v13.13a5,5,0,0,1-10,0Z" transform="translate(-78 -377.99)"></path>
			<path fill="#786DFF" d="M129,472.24,81.35,424.63a11.53,11.53,0,0,1,0-16.26h0a11.53,11.53,0,0,1,16.26,0l38.19,38.19a1.45,1.45,0,0,0,2.11,0L173,411.43l3.48-3.51a5.72,5.72,0,0,0,.05-8.21,5.94,5.94,0,0,0-8.4,0l-3.39,3.48-19.33,19.33a11.53,11.53,0,0,1-16.26,0h0l-23.1-23.1a11.53,11.53,0,0,1,0-16.26h0a11.53,11.53,0,0,1,16.26,0l13.92,14.17s1.06.78,1.84,0L149,386.45a28.83,28.83,0,1,1,40.78,40.78l-.47.47L145,472a11.53,11.53,0,0,1-16.26,0h0" transform="translate(-78 -377.99)"></path>
		</svg>
	</div>

   
	<h2 class="g-heading2 playfair-fonts">Receive your purchase now, spread the total cost over 6 weekly automatic payments. Interest free!</h2>
	<ul class="laybuySteps roboto-font">
		<li>
			<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/laybuy-cart.png" alt="">
			<div class="desc">
				Simply select <strong>Laybuy</strong> as your payment method at checkout
			</div>
		</li>
		<li>
			<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/laybuy-login.png" alt="">
			<div class="desc">
				Login or Register for Laybuy and complete your order in seconds
			</div>
		</li>
		<li>
			<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/laybuy-mobile.png" alt="">
			<div class="desc">
				Complete your purchase using an existing debit or credit card
			</div>
		</li>
		<li>
			<img src="<?php echo get_site_url(); ?>/wp-content/uploads/2020/09/download.png" alt="">
			<div class="desc">
				Pay over 6 weeks and receive your purchase now
			</div>
		</li>
	</ul>


			</div>
		</section>