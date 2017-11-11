<?php
/**
 * Simple product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/simple.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! $product->is_purchasable() ) {
	return;
}

/*** Our code modification inside Woo template - begin ***/

global $qode_options_proya;

$button_classes = 'single_add_to_cart_button qbutton button alt';
if (isset($qode_options_proya['woo_products_add_to_cart_hover_type']) && $qode_options_proya['woo_products_add_to_cart_hover_type'] !== ''){
	$button_classes .= ' '.$qode_options_proya['woo_products_add_to_cart_hover_type'];
}

// WooCommerce plugin changed hooks in 3.0 version and because of that we have this condition
if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
	echo wc_get_stock_html( $product );
} else {
	// Availability
	$availability      = $product->get_availability();
	$availability_html = empty( $availability['availability'] ) ? '' : '<p class="stock ' . esc_attr( $availability['class'] ) . '">' . esc_html( $availability['availability'] ) . '</p>';
	
	echo apply_filters( 'woocommerce_stock_html', $availability_html, $availability['availability'], $product );
}
/*** Our code modification inside Woo template - end ***/

if ( $product->is_in_stock() ) : ?>
	
	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>
	
	<form class="cart" method="post" enctype='multipart/form-data'>
		<?php
		/**
		 * @since 2.1.0.
		 */
		do_action( 'woocommerce_before_add_to_cart_button' );
		
		/**
		 * @since 3.0.0.
		 */
		do_action( 'woocommerce_before_add_to_cart_quantity' );
		
		/*** Our code modification inside Woo template - begin ***/
		
		if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
			woocommerce_quantity_input( array(
				'min_value'   => apply_filters( 'woocommerce_quantity_input_min', $product->get_min_purchase_quantity(), $product ),
				'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->get_max_purchase_quantity(), $product ),
				'input_value' => isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : $product->get_min_purchase_quantity(),
			) );
		} else {
			if ( ! $product->is_sold_individually() ) {
				woocommerce_quantity_input( array(
					'min_value'   => apply_filters( 'woocommerce_quantity_input_min', 1, $product ),
					'max_value'   => apply_filters( 'woocommerce_quantity_input_max', $product->backorders_allowed() ? '' : $product->get_stock_quantity(), $product ),
					'input_value' => ( isset( $_POST['quantity'] ) ? wc_stock_amount( $_POST['quantity'] ) : 1 )
				) );
			}
		}
		
		/*** Our code modification inside Woo template - end ***/
		
		/**
		 * @since 3.0.0.
		 */
		do_action( 'woocommerce_after_add_to_cart_quantity' );
		?>
		
		<?php /*** Our code modification inside Woo template - begin ***/ ?>
		<button type="submit" name="add-to-cart" value="<?php echo esc_attr( $product->get_id() ); ?>" class="single_add_to_cart_button button alt <?php echo esc_attr($button_classes); ?>"><?php echo esc_html( $product->single_add_to_cart_text() ); ?></button>
		<?php /*** Our code modification inside Woo template - end ***/ ?>
		
		<?php
		/**
		 * @since 2.1.0.
		 */
		do_action( 'woocommerce_after_add_to_cart_button' );
		?>
	</form>
	
	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>

<?php endif; ?>
