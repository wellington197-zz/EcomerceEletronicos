<?php
/**
 * Customizer functionality for the theme.
 *
 * @package Allo
 * @since 1.0
 */
/**
 * Filter The customizer Panel.
 * @since 1.0
 */
function allo_filter_features( $array ) {
	$files_to_load = array(
		'features/feature-navigation-tabs',
		'typography/typography-settings',
		'customizer-radio-image/class/class-allo-customize-control-radio-image',
		'customizer-alpha-color-picker/class-allo-customize-alpha-color-control',
	);
	
	return array_merge(
		$array, $files_to_load
	);
}
add_filter( 'allo_filter_features', 'allo_filter_features' );

/**
 * Include All files.
 *
 * @since Allo 1.0
 */
function allo_include_features() {
	$allo_allowed_phps = array();
	$allo_allowed_phps = apply_filters( 'allo_filter_features', $allo_allowed_phps );
	foreach ( $allo_allowed_phps as $file ) {
		$allo_file_to_include = get_template_part('customizer/'. $file );
	}
}
add_action( 'after_setup_theme', 'allo_include_features', 0 );


/**
 * Register panels for Customizer.
 *
 * @since Allo 1.0
 */
function allo_typography_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'allo_typography_settings', array(
			'priority' => 25,
			'title'    => esc_html__( 'Typography Settings', 'allo' ),
		)
	);
}
add_action( 'customize_register', 'allo_typography_customize_register' );

/**
 * Register JS control types.
 *
 * @since  1.0
 * @access public
 * @return void
 */
function allo_register_control_types( $wp_customize ) {
	get_template_part('customizer/customizer-range-value/class/class-allo-customizer-range-value-control');
	get_template_part('customizer/customizer-select-multiple/class/class-allo-select-multiple');

	// Register JS control types.
	$wp_customize->register_control_type( 'Allo_Select_Multiple' );
	$wp_customize->register_control_type( 'Allo_Customizer_Range_Value_Control' );
}

add_action( 'customize_register', 'allo_register_control_types', 0 );