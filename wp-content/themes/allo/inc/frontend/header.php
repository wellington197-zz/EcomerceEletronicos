<?php
/**
 * Hooks for template header
 * Add Favicon
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ) {
	function allo_header_icons() {
		$allowed_html_array = array(
	        'link' => array(
	            'rel' => array(),
	            'sizes' => array(),
	            'href' => array(),
	        ),
	    );
	    
	    if ( isset ( $header_icons ) ) echo wp_kses( $header_icons, $allowed_html_array );
	}
	add_action( 'wp_head', 'allo_header_icons' );
}

/**
 * Style for header
 *
 * @package Allo
 * @since 1.0
 */
function allo_header_scripts_css() {	
	// Custom CSS
	ob_start();
	get_template_part('inc/frontend/color-schemer');
	$custom_css_code = ob_get_clean();
	wp_add_inline_style( 'allo-style', $custom_css_code );
}
add_action( 'wp_enqueue_scripts', 'allo_header_scripts_css', 300 );