<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_cart' ); ?>

<form class="woocommerce-cart-form" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">
	<?php do_action( 'woocommerce_before_cart_table' ); ?>
	<div class="cart-labels">
		<h6 class="medium-font-size medium roboto-font">Item</h6>
		<h6 class="medium-font-size medium roboto-font">Quantity</h6>
		<h6 class="medium-font-size medium roboto-font">Price</h6>

	</div>
	<table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
		<thead>
			<tr>
				<th class="product-remove">&nbsp;</th>
				<th class="product-thumbnail"> </th>
				<th class="product-name"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-price"><?php esc_html_e( 'Price', 'woocommerce' ); ?></th>
				<th class="product-subtotal"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php do_action( 'woocommerce_before_cart_contents' ); ?>

			<?php
			$showLeForgeModal = false; 
			foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
				$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
				$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );
				$skuCode = $_product->get_sku();

				// check if the sku code include Le Forge
				if(substr($skuCode, 0, 3) === 'LEF'){
					$showLeForgeModal = true;
				}
				
				if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
					$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

					?>
					<tr class="woocommerce-cart-form__cart-item <?php echo esc_attr( apply_filters( 'woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key ) ); ?>">

						<td class="product-remove">
							<?php
								echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
									'woocommerce_cart_item_remove_link',
									sprintf(
										'<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">&times;</a>',
										esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
										esc_html__( 'Remove this item', 'woocommerce' ),
										esc_attr( $product_id ),
										esc_attr( $_product->get_sku() )
									),
									$cart_item_key
								);
							?>
						</td>

					
						
						<td class="product-name cart-row" >
							
							<div class="cart-name-image">
								<?php
								$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

								if (  ! $product_permalink ) {
									echo $thumbnail; // PHPCS: XSS ok.
								
								} else {
									printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $thumbnail ); // PHPCS: XSS ok.
									
								}
								?>
								<?php
									if ( ! $product_permalink ) {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
									} else {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
									}

									do_action( 'woocommerce_after_cart_item_name', $cart_item, $cart_item_key );

									// Meta data.
									echo wc_get_formatted_cart_item_data( $cart_item ); // PHPCS: XSS ok.

									// Backorder notification.
									if ( $_product->backorders_require_notification() && $_product->is_on_backorder( $cart_item['quantity'] ) ) {
										echo wp_kses_post( apply_filters( 'woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__( 'Available on backorder', 'woocommerce' ) . '</p>', $product_id ) );
									}
								?>
							</div>
							<div>
								<?php
									if ( $_product->is_sold_individually() ) {
										$product_quantity = sprintf( '1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key );
									} else {
										$product_quantity = woocommerce_quantity_input(
											array(
												'input_name'   => "cart[{$cart_item_key}][qty]",
												'input_value'  => $cart_item['quantity'],
												'max_value'    => $_product->get_max_purchase_quantity(),
												'min_value'    => '0',
												'product_name' => $_product->get_name(),
											),
											$_product,
											false
										);
									}

									echo apply_filters( 'woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item ); // PHPCS: XSS ok.
								?>
							</div>
							<div>
								<?php
										echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); // PHPCS: XSS ok.
								?>
							</div>
							
							
						
							
						</td>


						

						
					</tr>
					<?php
				}
			}
			?>

			<?php do_action( 'woocommerce_cart_contents' ); ?>

			<tr>
				<td colspan="6" class="actions">

					<?php if ( wc_coupons_enabled() ) { ?>
						<div class="coupon">
							<label for="coupon_code"><?php esc_html_e( 'Coupon:', 'woocommerce' ); ?></label> <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="<?php esc_attr_e( 'Coupon code', 'woocommerce' ); ?>" /> <button type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?></button>
							<?php do_action( 'woocommerce_cart_coupon' ); ?>
						</div>
					<?php } ?>

					<button type="submit" class="button btn-dk-green-border" name="update_cart" value="<?php esc_attr_e( 'Update cart', 'woocommerce' ); ?>"><?php esc_html_e( 'Update cart', 'woocommerce' ); ?></button>

					<?php do_action( 'woocommerce_cart_actions' ); ?>

					<?php wp_nonce_field( 'woocommerce-cart', 'woocommerce-cart-nonce' ); ?>
				</td>
			</tr>

			<?php do_action( 'woocommerce_after_cart_contents' ); ?>
		</tbody>
	</table>
	<?php do_action( 'woocommerce_after_cart_table' ); ?>
</form>

<?php do_action( 'woocommerce_before_cart_collaterals' ); ?>

<div class="cart-collaterals">
	<?php
		/**
		 * Cart collaterals hook.
		 *
		 * @hooked woocommerce_cross_sell_display
		 * @hooked woocommerce_cart_totals - 10
		 */
		do_action( 'woocommerce_cart_collaterals' );
	?>
	
</div>

<?php do_action( 'woocommerce_after_cart' ); ?>
<?php 
// show a modal if the cart item includes le forge products 
if($showLeForgeModal){ 
	 do_action( 'cart_modal' );
}

?>

<script type="text/javascript">

	var products = {};
			<?php 
					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						
						$product = wc_get_product( $cart_item['data']->get_id()); 
						$term_list = get_the_terms( $product->get_id(), 'product_cat' );
	    				$term = $term_list[0];
	    				$variation_id = "No Variation";
	    				$qty = $cart_item['quantity'];

	    				
						?>	var thisProduct = {
								'name': '<?php echo $product -> get_name()?>',   
	       						'id': '<?php echo $product -> get_id()?>',
	       						'price': '<?php echo $product -> get_price()?>',
	     			       		'brand': '<?php echo  $product->get_attribute('pa_brands')?>',
	                        	'category': '<?php echo $term -> name ?>',
	       						'variant': '<?php echo $variation_id ?>',
	       						'list': '<?php woocommerce_page_title(); ?>',
	       						'quantity': '<?php echo $qty; ?>'
							}

							products['<?php echo $product -> get_id()?>'] = thisProduct;

							
						<?php
						
					}
			 ?>

	var removeBtns = document.getElementsByClassName("remove");

	for(var i = 0; i < removeBtns.length; i++) {

		removeBtns[i].addEventListener("click", function(event) {

			var productId = event.currentTarget.getAttribute("data-product_id");
			var removedProduct = products[productId];

			dataLayer.push({
					    'event': 'removeFromCart',
					    'ecommerce': {
					      'remove': {
					        'products': [{
					          'name': removedProduct.name,                  
					          'id': removedProduct.id,
					          'price': removedProduct.price,
					          'brand': removedProduct.brand,
					          'category': removedProduct.category,
					          'variant': removedProduct.variant,
					          'quantity': removedProduct.quantity   
					         }]
					       }
			   		  	}
			 		 });

			window.location.reload(false); 
		}); 

	}

</script>

<script type="text/javascript">

			 var placeOrderBtn = document.getElementsByClassName("woo-btn-dk-green")[0];

			 placeOrderBtn.addEventListener("click", function(event) {

			 	dataLayer.push({
					    'event': 'checkout',
					    'ecommerce': {
					      'checkout': {
					      	'actionField': {'step': 1},

					        'products': [

					        <?php 
									foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

										$product = wc_get_product( $cart_item['data']->get_id()); 
										$term_list = get_the_terms( $product->get_id(), 'product_cat' );
					    				$term = $term_list[0];
					    				$variation_id = "No Variation";
					    				$qty = $cart_item['quantity'];

					    			

							?>
,
					        {
					          'name': '<?php echo $product -> get_name()?>',                  
					          'id': '<?php echo $product -> get_id()?>',
					          'price': '<?php echo $product -> get_price()?>',
					          'brand': '<?php echo  $product->get_attribute('pa_brands')?>	',
					          'category': '<?php echo $term -> name ?>',
					          'variant': '<?php echo $variation_id ?>',
					          'quantity': '<?php echo $qty ?>'  
					         },

							<?php
						
								}
							 ?>


					         ]
					       }
			   		  	}
			 		 });
			 });

</script>	