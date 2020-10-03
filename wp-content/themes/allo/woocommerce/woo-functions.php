<?php 
/**
 * All WooCommerce Custom Functions Goes Here
 *
 * @package Allo
 * @since 1.0
 */

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	/* Declare WooCommerce support */
	add_action( 'after_setup_theme', 'woocommerce_support' );
	function woocommerce_support() {
	    add_theme_support( 'woocommerce' );
	}
    
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );

	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 11 );

	
    /* Trim zeros in price decimals */
    function allo_product_price() { 
    	global $product; 
    	echo wp_kses( $product->get_price_html(), TL_ALLO_Static::html_allow() ); 
    }
}