<?php
/**
 * Product Title
 *
 * @package Bigcommerce
 *
 * @var Product $product
 * @var string  $title           The product title
 * @var string  $permalink       The link to the single product page.
 * @var string  $condition       The rendered product condition
 * @var string  $inventory       The rendered product inventory level
 * @var bool    $use_permalink   Wrap the title in an anchor tag linked to the product single page.
 * @var string  $link_attributes Sanitized attributes save to add to the permalink anchor tag
 * @var string  $header_tag      The header tag to use to wrap the title
 * @version 1.0.0
 */

use \BigCommerce\Post_Types\Product\Product;

?>


<<?php echo $header_tag; ?> class="bc-product__title board-heading-post-id" <?php echo $link_attributes; ?>>
	<?php if ( $use_permalink ) { ?>
	<a href="<?php echo esc_url( $permalink ); ?>" class="bc-product__title-link"   <?php echo $link_attributes; ?>>
		<?php } ?>

		<?php echo esc_html( $title ); ?>
		<?php echo $condition; ?>
		<?php echo $inventory; ?>

		<?php if ( $use_permalink ) { ?>
	</a>
	<div class="design-board-save-btn-container" <?php echo $link_attributes; ?>>
		<i data-exists='<?php echo $existStatus?>' class="fal fa-plus open-board-container" ></i>
	</div>
<?php } ?>
</<?php echo $header_tag; ?>>


