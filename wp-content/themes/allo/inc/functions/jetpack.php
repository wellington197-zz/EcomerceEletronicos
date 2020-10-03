<?php
/** 
* Jetpack Compatibility File
 * See: https://jetpack.me/
 * @package Allo
 * @since 1.0
 */

/**
 * Add theme support for Infinite Scroll.
 * See: https://jetpack.me/support/infinite-scroll/
 *
 * @package Allo
 * @since 1.0
 */
function allo_jetpack_setup() {
	add_theme_support( 'infinite-scroll', array(
		'container' => 'main',
		'render'    => 'allo_infinite_scroll_render',
		'footer'    => 'page',
	) );
} // end function allo_jetpack_setup
add_action( 'after_setup_theme', 'allo_jetpack_setup' );

/**
 * Allo Infinite Scroll Render
 *
 * @package Allo
 * @since 1.0
 */

function allo_infinite_scroll_render() {
	while ( have_posts() ) {
		the_post();
		get_template_part( 'template-parts/post/content', get_post_format() );
	}
} // end function allo_infinite_scroll_render