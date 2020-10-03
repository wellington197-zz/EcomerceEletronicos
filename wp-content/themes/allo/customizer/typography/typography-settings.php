<?php
/**
 * Typography settings for both Allo
 *
 * @package Allo
 * @since 1.0
 */

/**
 * Include functions file for Font Family controls.
 */
get_template_part('customizer/customizer-font-selector/font-functions');
get_template_part('customizer/customizer-font-selector/class/class-allo-font-selector');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @since 1.0
 */
function allo_customize_preview() {
	wp_enqueue_script( 'allo-customizer', get_template_directory_uri() . '/customizer/typography/js/customizer.js', array( 'customize-preview' ), TL_ALLO_VERSION, true );
}

add_action( 'customize_preview_init', 'allo_customize_preview' );

/**
 * Customizer controls for typography settings.
 *
 * @param WP_Customize_Manager $wp_customize Customize manager.
 *
 * @since 1.0
 */
function allo_typography_settings( $wp_customize ) {
	/**
	 * Main typography panel
	 */
	$wp_customize->add_section(
		'allo_typography', array(
			'title'    => esc_html__( 'Font Family', 'allo' ),
			'panel'    => 'allo_typography_settings',
			'priority' => 25,
		)
	);	

	/**
	 * Main typography Colors
	 */
	$wp_customize->add_section(
		'allo_typography_color', array(
			'title'    => esc_html__( 'Font Color', 'allo' ),
			'panel'    => 'allo_typography_settings',
			'priority' => 25,
		)
	);

	$wp_customize->add_setting(
	    'allo_body_font_color', array(
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'sanitize_hex_color',
	        'type'      =>  'theme_mod',
	        'transport'   => 'postMessage',
	        'default' => '#222222',
	    )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control( $wp_customize, 'allo_body_font_color', array(
	        	'label' => esc_html__('Body Font Color','allo'), 
	            'section' => 'allo_typography_color',
	        )
	    )
	);	
	$wp_customize->add_setting(
	    'allo_heading_font_color', array(
	        'capability' => 'edit_theme_options',
	        'sanitize_callback' => 'sanitize_hex_color',
	        'type'      =>  'theme_mod',
	        'transport'   => 'postMessage',
	        'default' => '#303030',
	    )
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control( $wp_customize, 'allo_heading_font_color', array(
	        	'label' => esc_html__('Headings Font Color','allo'), 
	            'section' => 'allo_typography_color',
	        )
	    )
	);

	/**
	 * ------------------
	 * 1. Font Family tab
	 * ------------------
	 */
	if ( class_exists( 'Allo_Font_Selector' ) ) {
		/**
		 * ---------------------------------
		 * 1.a. Headings font family control
		 * This control allows the user to choose a font family for all Headings used in the theme ( h1 - h6 )
		 * --------------------------------
		 */

		$wp_customize->add_setting(
			'allo_headings_font', array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'default' => 'Rubik',
			)
		);

		$wp_customize->add_control(
			new Allo_Font_Selector(
				$wp_customize, 'allo_headings_font', array(
					'label'    => esc_html__( 'Headings', 'allo' ) . ' ' . esc_html__( 'font family', 'allo' ),
					'section'  => 'allo_typography',
					'priority' => 5,
					'type'     => 'select',
				)
			)
		);

		/**
		 * ---------------------------------
		 * 1.b. Body font family control
		 * This control allows the user to choose a font family for all elements in the body tag
		 * --------------------------------
		 */

		$wp_customize->add_setting(
			'allo_body_font', array(
				'type'              => 'theme_mod',
				'sanitize_callback' => 'sanitize_text_field',
				'default' => 'Lato',
			)
		);

		$wp_customize->add_control(
			new Allo_Font_Selector(
				$wp_customize, 'allo_body_font', array(
					'label'    => esc_html__( 'Body', 'allo' ) . ' ' . esc_html__( 'font family', 'allo' ),
					'section'  => 'allo_typography',
					'priority' => 10,
					'type'     => 'select',
				)
			)
		);
	} // End if().

	if ( class_exists( 'Allo_Select_Multiple' ) ) {

		/**
		 * --------------------
		 * 1.c. Font Subsets control
		 * This control allows the user to choose a subset for the font family ( for e.g. lating, cyrillic etc )
		 * --------------------
		 */
		$wp_customize->add_setting(
			'allo_font_subsets', array(
				'sanitize_callback' => 'allo_sanitize_array',
				'default'           => array( 'latin' ),
			)
		);

		$wp_customize->add_control(
			new Allo_Select_Multiple(
				$wp_customize, 'allo_font_subsets', array(
					'section'  => 'allo_typography',
					'label'    => esc_html__( 'Font Subsets', 'allo' ),
					'choices'  => array(
						'latin'        => 'latin',
						'latin-ext'    => 'latin-ext',
						'cyrillic'     => 'cyrillic',
						'cyrillic-ext' => 'cyrillic-ext',
						'greek'        => 'greek',
						'greek-ext'    => 'greek-ext',
						'vietnamese'   => 'vietnamese',
					),
					'priority' => 45,
				)
			)
		);
	} // End if().

	/**
	 * ------------------
	 * 2. Font Size tab
	 * ------------------
	 */
	if ( class_exists( 'Allo_Customizer_Range_Value_Control' ) ) {
		/**
		 * --------------------------------------------------------------------------
		 * 2.b. Font size controls for Posts & Pages
		 * --------------------------------------------------------------------------
		 *
		 * Title control [Posts & Pages]
		 * This control allows the user to choose a font size for the main titles
		 * that appear in the header for pages and posts.
		 *
		 * The values area between 0 and 60 px.
		 * --------------------------------------------------------------------------
		 */
		$wp_customize->add_setting(
			'allo_body_font_size', array(
				'sanitize_callback' => 'allo_sanitize_range_value',
				'default'           => 14,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Allo_Customizer_Range_Value_Control(
				$wp_customize, 'allo_body_font_size', array(
					'label'       => esc_html__( 'Body Font Size:', 'allo' ),
					'section'     => 'allo_typography',
					'type'        => 'range-value',
					'input_attr'  => array(
						'min'  => 0,
						'max'  => 60,
						'step' => 1,
					),
					'priority'    => 110,
					'sum_type'    => true,
				)
			)
		);

		/**
		 * --------------------------------------------------------------------------
		 * Headings control [Posts & Pages]
		 *
		 * This control allows the user to choose a font size for all headings
		 * ( h1 - h6 ) from pages and posts.
		 *
		 * The values area between 0 and 60 px.
		 * --------------------------------------------------------------------------
		 */
		$wp_customize->add_setting(
			'allo_menu_font_size', array(
				'sanitize_callback' => 'allo_sanitize_range_value',
				'default'           => 14,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Allo_Customizer_Range_Value_Control(
				$wp_customize, 'allo_menu_font_size', array(
					'label'      => esc_html__( 'Menu Font Size:', 'allo' ),
					'section'    => 'allo_typography',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 60,
						'step' => 1,
					),
					'priority'   => 115,
					'sum_type'   => true,
				)
			)
		);

		/**
		 * --------------------------------------------------------------------------
		 * Content control [Posts & Pages]
		 *
		 * This control allows the user to choose a font size for the main content
		 * area in pages and posts.
		 *
		 * The values area between 0 and +90 px.
		 * --------------------------------------------------------------------------
		 */
		$wp_customize->add_setting(
			'allo_post_blockquote_content', array(
				'sanitize_callback' => 'allo_sanitize_range_value',
				'default'           => 18,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Allo_Customizer_Range_Value_Control(
				$wp_customize, 'allo_post_blockquote_content', array(
					'label'      => esc_html__( 'Block-Quote Font Size:', 'allo' ),
					'section'    => 'allo_typography',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 90,
						'step' => 1,
					),
					'priority'   => 120,
					'sum_type'   => true,
				)
			)
		);

		/**
		 * --------------------------------------------------------------------------
		 * Content control [Posts & Pages]
		 *
		 * This control allows the user to choose a font size for the main content
		 * area in pages and posts.
		 *
		 * The values area between -25 and +25 px.
		 * --------------------------------------------------------------------------
		 */
		$wp_customize->add_setting(
			'allo_post_post_title_content', array(
				'sanitize_callback' => 'allo_sanitize_range_value',
				'default'           => 24,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Allo_Customizer_Range_Value_Control(
				$wp_customize, 'allo_post_post_title_content', array(
					'label'      => esc_html__( 'Post Title Font Size:', 'allo' ),
					'section'    => 'allo_typography',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 90,
						'step' => 1,
					),
					'priority'   => 120,
					'sum_type'   => true,
				)
			)
		);

		/**
		 * --------------------------------------------------------------------------
		 * 2.c. Font size controls for Frontpage
		 * --------------------------------------------------------------------------
		 * Big Title Section / Header Slider font size control. [Frontpage Sections]
		 *
		 * This is changing the big title/slider titles, the
		 * subtitle and the button in the big title section.
		 *
		 * The values are between 0 and 120 px.
		 * --------------------------------------------------------------------------
		 */
		$wp_customize->add_setting(
			'allo_heading_one_content', array(
				'sanitize_callback' => 'allo_sanitize_range_value',
				'default'           => 36,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Allo_Customizer_Range_Value_Control(
				$wp_customize, 'allo_heading_one_content', array(
					'label'      =>  esc_html__( 'H1:', 'allo' ),
					'section'    => 'allo_typography',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 120,
						'step' => 1,
					),
					'priority'   => 210,
					'sum_type'   => true,
				)
			)
		);

		/**
		 * --------------------------------------------------------------------------
		 * Section Title [Frontpage Sections]
		 *
		 * This control is changing sections titles and card titles
		 * The values are between 0 and 120 px.
		 * --------------------------------------------------------------------------
		 */
		$wp_customize->add_setting(
			'allo_heading_two_content', array(
				'sanitize_callback' => 'allo_sanitize_range_value',
				'default'           => 30,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Allo_Customizer_Range_Value_Control(
				$wp_customize, 'allo_heading_two_content', array(
					'label'      => esc_html__( 'H2:', 'allo' ),
					'section'    => 'allo_typography',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 120,
						'step' => 1,
					),
					'priority'   => 215,
					'sum_type'   => true,
				)
			)
		);

		/**
		 * -----------------------------------------------------
		 * Subtitles control [Frontpage Sections]
		 * This control allows the user to choose a font size
		 * for all Subtitles on Frontpage sections.
		 * The values area between 0 and 105 px.
		 * -----------------------------------------------------
		 */
		$wp_customize->add_setting(
			'allo_heading_three_content', array(
				'sanitize_callback' => 'allo_sanitize_range_value',
				'default'           => 24,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Allo_Customizer_Range_Value_Control(
				$wp_customize, 'allo_heading_three_content', array(
					'label'      => esc_html__( 'H3:', 'allo' ),
					'section'    => 'allo_typography',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 105,
						'step' => 1,
					),
					'priority'   => 220,
					'sum_type'   => true,
				)
			)
		);

		/**
		 * -----------------------------------------------------
		 * Content control [Frontpage Sections]
		 * This control allows the user to choose a font size
		 * for the Main content for Frontpage Sections
		 * The values area between 0 and 90 px.
		 * -----------------------------------------------------
		 */
		$wp_customize->add_setting(
			'allo_heading_four_content', array(
				'sanitize_callback' => 'allo_sanitize_range_value',
				'default'           => 18,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Allo_Customizer_Range_Value_Control(
				$wp_customize, 'allo_heading_four_content', array(
					'label'      => esc_html__( 'H4:', 'allo' ),
					'section'    => 'allo_typography',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 90,
						'step' => 1,
					),
					'priority'   => 225,
					'sum_type'   => true,
				)
			)
		);

		$wp_customize->add_setting(
			'allo_heading_five_content', array(
				'sanitize_callback' => 'allo_sanitize_range_value',
				'default'           => 14,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Allo_Customizer_Range_Value_Control(
				$wp_customize, 'allo_heading_five_content', array(
					'label'      => esc_html__( 'H5:', 'allo' ),
					'section'    => 'allo_typography',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 75,
						'step' => 1,
					),
					'priority'   => 226,
					'sum_type'   => true,
				)
			)
		);

		$wp_customize->add_setting(
			'allo_heading_six_content', array(
				'sanitize_callback' => 'allo_sanitize_range_value',
				'default'           => 12,
				'transport'         => 'postMessage',
			)
		);

		$wp_customize->add_control(
			new Allo_Customizer_Range_Value_Control(
				$wp_customize, 'allo_heading_six_content', array(
					'label'      => esc_html__( 'H6:', 'allo' ),
					'section'    => 'allo_typography',
					'type'       => 'range-value',
					'input_attr' => array(
						'min'  => 0,
						'max'  => 60,
						'step' => 1,
					),
					'priority'   => 227,
					'sum_type'   => true,
				)
			)
		);
	} // End if().
}

add_action( 'customize_register', 'allo_typography_settings', 20 );

if ( ! function_exists( 'allo_fonts_inline_style' ) ) {
	/**
	 * Add inline style for custom fonts.
	 *
	 * @since 1.0
	 */

	function sh_all_typo_header_scripts_css() {	
		// Custom CSS
		$custom_css = '';
		/**
		 * Body font family.
		 */
		$allo_body_font = get_theme_mod( 'allo_body_font', 'Lato' );
		$allo_body_font_color = get_theme_mod( 'allo_body_font_color', '#222222' );

		if ( ! empty( $allo_body_font ) ) {
			allo_enqueue_google_font( $allo_body_font );
			$custom_css .= 'body {font-family: ' . $allo_body_font . '; color: '.$allo_body_font_color.'; }';
		}

		/**
		 * Heading font family.
		 * All Font Size
		 */
		$allo_headings_font = get_theme_mod( 'allo_headings_font', 'Rubik' );

		$allo_headings_font_color = get_theme_mod( 'allo_heading_font_color', '#303030' );

		if ( ! empty( $allo_headings_font ) ) {
			allo_enqueue_google_font( $allo_headings_font );
			$custom_css .= 'h1, h2, h3, h4, h5, h6 { font-family: ' . $allo_headings_font . '; color: '. $allo_headings_font_color .';}';

			$custom_css .= 'body { font-size: ' . get_theme_mod( 'allo_body_font_size', 14 ) .'px;}';
			$custom_css .= 'header .main-header nav ul li a { font-size: ' . get_theme_mod( 'allo_menu_font_size', 14 ) . 'px;}';
			$custom_css .= 'blockquote { font-size: ' . get_theme_mod( 'allo_post_blockquote_content', 18 ) . 'px;}';
			$custom_css .= '.post .entry-title { font-size: ' . get_theme_mod( 'allo_post_post_title_content', 24 ) . 'px;}';
			$custom_css .= 'h1 { font-size: ' . get_theme_mod( 'allo_heading_one_content', 36 ) . 'px;}';
			$custom_css .= 'h2 { font-size: ' . get_theme_mod( 'allo_heading_two_content', 30 ) . 'px;}';
			$custom_css .= 'h3 { font-size: ' . get_theme_mod( 'allo_heading_three_content', 24 ) . 'px;}';
			$custom_css .= 'h4 { font-size: ' . get_theme_mod( 'allo_heading_four_content', 18 ) . 'px;}';
			$custom_css .= 'h5 { font-size: ' . get_theme_mod( 'allo_heading_five_content', 14 ) . 'px;}';
			$custom_css .= 'h6 { font-size: ' . get_theme_mod( 'allo_heading_six_content', 12 ) . 'px;}';
		}

		wp_add_inline_style( 'allo-style', $custom_css );
	}
	add_action( 'wp_enqueue_scripts', 'sh_all_typo_header_scripts_css', 300 );
}