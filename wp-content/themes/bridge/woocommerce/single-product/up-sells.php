<?php
/**
 * Single Product Up-Sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/up-sells.php.
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

/*** Our code modification inside Woo template - begin ***/
$title_tag = 'h4';
$title_tag_options = qode_options()->getOptionValue('woo_product_single_related_post_tag');
if($title_tag_options != '') {
	$title_tag = $title_tag_options;
}

if ( version_compare( WOOCOMMERCE_VERSION, '3.0' ) >= 0 ) {
	if ( $upsells ) : ?>
		
		<div class="up-sells upsells products">
		
			<<?php esc_attr_e($title_tag); ?> class="qode-related-upsells-title"><?php esc_html_e( 'You may also like&hellip;', 'woocommerce' ) ?></<?php esc_attr_e($title_tag); ?>>
			
			<?php woocommerce_product_loop_start(); ?>
			
			<?php foreach ( $upsells as $upsell ) : ?>
				
				<?php
				$post_object = get_post( $upsell->get_id() );
				
				setup_postdata( $GLOBALS['post'] =& $post_object );
				
				wc_get_template_part( 'content', 'product' ); ?>
			
			<?php endforeach; ?>
			
			<?php woocommerce_product_loop_end(); ?>
		
		</div>
	
	<?php endif;
	
	wp_reset_postdata();
} else {
	global $woocommerce_loop;
	
	if ( ! $upsells = $product->get_upsells() ) {
		return;
	}
	
	$args = array(
		'post_type'           => 'product',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => 1,
		'posts_per_page'      => $posts_per_page,
		'orderby'             => $orderby,
		'post__in'            => $upsells,
		'post__not_in'        => array( $product->get_id() ),
		'meta_query'          => WC()->query->get_meta_query()
	);
	
	$products                    = new WP_Query( $args );
	$woocommerce_loop['name']    = 'up-sells';
	$woocommerce_loop['columns'] = apply_filters( 'woocommerce_up_sells_columns', $columns );
	
	if ( $products->have_posts() ) : ?>
		
		<div class="up-sells upsells products">
		
			<<?php esc_attr_e($title_tag); ?> class="qode-related-upsells-title"><?php esc_html_e( 'You may also like&hellip;', 'woocommerce' ) ?></<?php esc_attr_e($title_tag); ?>>
			
			<?php woocommerce_product_loop_start(); ?>
			
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>
				
				<?php wc_get_template_part( 'content', 'product' ); ?>
			
			<?php endwhile; // end of the loop. ?>
			
			<?php woocommerce_product_loop_end(); ?>
		
		</div>
	
	<?php endif;
	
	wp_reset_postdata();
}

/*** Our code modification inside Woo template - end ***/
