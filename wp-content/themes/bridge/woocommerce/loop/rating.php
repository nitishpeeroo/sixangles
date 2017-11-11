<?php
/**
 * Loop Rating
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/rating.php.
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

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' )
	return;

// WooCommerce plugin changed hooks in 3.0 version and because of that we have this condition
if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
	echo wc_get_rating_html( $product->get_average_rating() );
} else {
	if ( $rating_html = $product->get_rating_html() ) :
		echo $rating_html;
	else: ?>
		<div class="star-rating">
			<span style="width: 0%"></span>
		</div>
	<?php endif;
}
