/**
 * File customizer-controls.js
 *
 * The file for generic customizer controls.
 *
 * @package Allo
 */

jQuery( document ).ready(function () {
	'use strict';

	/* Move controls to Widgets sections. Used for sidebar placeholders */
	if ( typeof wp.customize.control( 'allo_placeholder_sidebar_1' ) !== 'undefined' ) {
		wp.customize.control( 'allo_placeholder_sidebar_1' ).section( 'sidebar-widgets-sidebar-1' );
	}
	if ( typeof wp.customize.control( 'allo_placeholder_sidebar_woocommerce' ) !== 'undefined' ) {
		wp.customize.control( 'allo_placeholder_sidebar_woocommerce' ).section( 'sidebar-widgets-sidebar-woocommerce' );
	}

});
