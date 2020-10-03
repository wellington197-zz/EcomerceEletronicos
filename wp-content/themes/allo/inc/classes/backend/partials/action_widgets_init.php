<?php 
/**
 * Resisted Widget 
 *
 * @package Allo
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) die( esc_html__('Direct access forbidden.', 'allo') );

/**
 * Sidebar Widget
 *
 * @package Allo
 * @since 1.0
 */
register_sidebar(  array(
    'name'          => esc_html__( 'Sidebar Blog', 'allo' ),
    'description'   => esc_html__( 'This sidebar will show in blog page', 'allo' ),
    'id'            => 'sidebar-blog',
    'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<div class="widget-title"><h3 class="widget-heading">',
    'after_title'   => '</h3></div>',
) );

/**
 * Footer Widget
 *
 * @package Allo
 * @since 1.0
 */
$footer_widget_col = get_theme_mod('allo_footer_widget','4');
if(isset($footer_widget_col)) {
    $widget_col = $footer_widget_col;
} else {
    $widget_col = '4';
}
for ($i=1; $i <= $widget_col; $i++) { 
	register_sidebar(  
		array(
			'name'          => esc_html__( 'Footer Widget ', 'allo' ).$i,
			'id'            => 'sidebar-footer-'.$i,
			'description'   => esc_html__( 'This sidebar will show in Footer', 'allo' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		) 
	);
}
 
/**
 * Shop Widget 
 *
 * @package Allo
 * @since 1.0
 */
register_sidebar(  array(
    'name'          => esc_html__( 'Sidebar Shop', 'allo' ),
    'description'   => esc_html__( 'This sidebar will show in WooCommerce Page', 'allo' ),
    'id'            => 'sidebar-shop',
    'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<div class="widget-title"><h3 class="widget-heading">',
    'after_title'   => '</h3></div>',
) );