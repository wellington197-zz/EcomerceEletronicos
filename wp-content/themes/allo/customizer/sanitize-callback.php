<?php
/**
 * Render the site title for the selective refresh partial.
 *
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_customize_partial_blogdescription() {
    bloginfo( 'description' );
}

/**
 * Return whether we're previewing the front page and it's a static page.
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_is_static_front_page() {
    return ( is_front_page() && ! is_home() );
}

/**
 * Render the color.
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_sanitize_hex_color( $hex_color, $setting ) {

  $hex_color = sanitize_hex_color( $hex_color );

  return ( ! null( $hex_color ) ? $hex_color : $setting->default );
}

/**
 * Return Header Variations
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_header_varaitions( $input ) {
    $valid = array(
        'one'  => esc_html__( 'Header One', 'allo' ),
        'two'   => esc_html__( 'Header Two', 'allo' ),
        'three' => esc_html__( 'Header Three', 'allo' ),
        'four' => esc_html__( 'Header Four', 'allo' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }

    return 'one';
}
/**
 * Return Footer Widget Columns
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_footer_widget_callback( $input ) {
    $valid = array(
        '1'  => esc_html__( 'One', 'allo' ),
        '2'   => esc_html__( 'Two', 'allo' ),
        '3' => esc_html__( 'Three', 'allo' ),
        '4' => esc_html__( 'Four', 'allo' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }
    return 'four';
}
/**
 * Return Container Callback
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_container_callback( $input ) {
    $valid = array(
        'container'  => esc_html__( 'Default', 'allo' ),
        'container_full'   => esc_html__( 'Full Width', 'allo' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }
    return 'container_full';
}
/**
 * Return Blog Style
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_blog_style_callback( $input ) {
    $valid = array(
        'style_one'  => esc_html__( 'Style One', 'allo' ),
        'style_two'   => esc_html__( 'Style Two', 'allo' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }
    return 'style_one';
}
/**
 * Return Blog Sidebar
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_blog_sidebar_callback( $input ) {
    $valid = array(
        'left_side'  => esc_html__( 'Left Sidebar', 'allo' ),
        'right_side'   => esc_html__( 'Right Sidebar', 'allo' ),
        'no_side'   => esc_html__( 'No Sidebar', 'allo' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }
    return 'right_side';
}

/**
 * Return Woo Single Page Style
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_woo_single_style_callback( $input ) {
    $valid = array(
        'style_one'  => esc_html__( 'Style One', 'allo' ),
        'style_two'   => esc_html__( 'Style Two', 'allo' ),
        'style_three'   => esc_html__( 'Style Three', 'allo' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }
    return 'style_one';
}
/**
 * Return Woo Single Page Related Query
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_woo_related_query_callback( $input ) {
    $valid = array(
        'category'  => esc_html__( 'Category', 'allo' ),
        'tag'   => esc_html__( 'Tags', 'allo' ),
        'author'   => esc_html__( 'Author', 'allo' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }
    return 'category';
}

function allo_woo_related_products_show_callback( $input ) {
    $valid = array(
        'on'  => esc_html__( 'Enable', 'allo' ),
        'off'   => esc_html__( 'Disable', 'allo' ),
    );

    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    }
    return 'on';
}

/**
 * Return Check box
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_sanitize_checkbox( $checked ) {
	// Boolean check.
	return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * CSS Sanitation
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_sanitize_css( $css ) {
	return wp_strip_all_tags( $css );
}

/**
 * Dropdown Pages Sanitization
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_sanitize_dropdown_pages( $page_id, $setting ) {
	// Ensure $input is an absolute integer.
	$page_id = absint( $page_id );
	
	// If $page_id is an ID of a published page, return it; otherwise, return the default.
	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

/**
 * Email Sanitization
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_sanitize_email( $email, $setting ) {
	// Strips out all characters that are not allowable in an email address.
	$email = sanitize_email( $email );
	
	// If $email is a valid email, return it; otherwise, return the default.
	return ( ! is_null( $email ) ? $email : $setting->default );
}

/**
 * HTML Sanitaization Callback
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_sanitize_html( $html ) {
	return wp_filter_post_kses( $html );
}

/**
 * Image Sanitization Callback
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_sanitize_image( $image, $setting ) {
	/*
	 * Array of valid image file types.
	 *
	 * The array includes image mime types that are included in wp_get_mime_types()
	 */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
	// Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
	// If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : $setting->default );
}

/**
 * No HTML Sanitization
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_sanitize_nohtml( $nohtml ) {
	return wp_filter_nohtml_kses( $nohtml );
}

/**
 * Number Sanitization
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_sanitize_number_absint( $number, $setting ) {
	// Ensure $number is an absolute integer (whole number, zero or greater).
	$number = absint( $number );
	
	// If the input is an absolute integer, return it; otherwise, return the default
	return ( $number ? $number : $setting->default );
}
/**
 * Number Range sanitization callback example.
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_sanitize_number_range( $number, $setting ) {
	
	// Ensure input is an absolute integer.
	$number = absint( $number );
	
	// Get the input attributes associated with the setting.
	$atts = $setting->manager->get_control( $setting->id )->input_attrs;
	
	// Get minimum number in the range.
	$min = ( isset( $atts['min'] ) ? $atts['min'] : $number );
	
	// Get maximum number in the range.
	$max = ( isset( $atts['max'] ) ? $atts['max'] : $number );
	
	// Get step.
	$step = ( isset( $atts['step'] ) ? $atts['step'] : 1 );
	
	// If the number is within the valid range, return it; otherwise, return the default
	return ( $min <= $number && $number <= $max && is_int( $number / $step ) ? $number : $setting->default );
}
/**
 * Select sanitization callbacke.
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_sanitize_select( $input, $setting ) {
	
	// Ensure input is a slug.
	$input = sanitize_key( $input );
	
	// Get list of choices from the control associated with the setting.
	$choices = $setting->manager->get_control( $setting->id )->choices;
	
	// If the input is a valid key, return it; otherwise, return the default.
	return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
}

/**
 * URL sanitization
 * @since Allo 1.0
 * @see allo_customize_register()
 *
 * @return void
 */
function allo_sanitize_url( $url ) {
	return esc_url_raw( $url );
}

/**
 * Multiselect sanitize functions.
 *
 * @since Allo 1.0
 */
if ( ! function_exists( 'allo_sanitize_multiselect' ) ) :
    /**
     * Sanitize multi select output.
     *
     * @since Allo 1.0
     */
    function allo_sanitize_multiselect( $input ) {
        if ( ! is_array( $input ) ) {
            $output = explode( ',', $input );
        } else {
            $output = $input;
        }
        if ( ! empty( $output ) ) {
            return array_map( 'sanitize_text_field', $output );
        } else {
            return array();
        }
    }
endif;