<?php
/**
 * Allo Theme Customizer
 *
 * @package Allo
 */
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function allo_customize_register( $wp_customize ) {
    //Basic Post Message Settings
    $wp_customize->get_setting( 'blogname' )->transport          = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport   = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'custom_logo' )->transport     = 'postMessage';


    // Changing for site Identity
    $wp_customize->selective_refresh->add_partial( 'blogname', array(
        'selector' => '.site-title a',
        'render_callback' => 'allo_customize_partial_blogname',
    ));
    $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
        'selector' => '.site-description',
        'render_callback' => 'allo_customize_partial_blogdescription',
    ));

    $wp_customize->add_setting( 'allo_mobile_logo' , array(
       'default'     => TL_ALLO_TEMPLATE_DIR_URL . '/assets/images/logo/logo2.png',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'allo_sanitize_url',
       'type'      =>  'theme_mod',
       'transport'   => 'postMessage',
    ));    


    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 
        'allo_mobile_logo', array(
            'label'   => esc_html__('Mobile Logo:','allo'),
            'section' => 'title_tagline',
    ) ) );

    $wp_customize->add_setting( 'allo_theme_color' , array(
       'default'   => '#2962ff',
       'capability' => 'edit_theme_options',
       'sanitize_callback' => 'sanitize_hex_color',
       'type'      =>  'theme_mod',
       'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'allo_theme_color', array(
           'label'    => esc_html__( 'Theme Color', 'allo' ),
           'section'  => 'colors',
        ) 
    ));

    /**
     * End Allo WordPress Theme Footer Control Panel  section-colors
     */
    $wp_customize->add_section( 'allo_header' , array(
        'title'      => esc_html__( 'Header Settings', 'allo' ),
        'priority'   => 60,   
    ));

    $wp_customize->add_setting( 'allo_header_variation' , array(
        'sanitize_callback' => 'allo_header_varaitions',
        'capability' => 'edit_theme_options',
        'type'      =>  'theme_mod',
        'default' => 'one',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 'allo_header_variation', array(
        'label' => esc_html__( 'Header Display', 'allo' ),
        'description' => esc_html__( 'For changing header style.', 'allo' ),
        'section' => 'allo_header',
        'type' => 'radio',
        'choices' => array(
            'one'  => esc_html__( 'Header One', 'allo' ),
            'two'   => esc_html__( 'Header Two', 'allo' ),
            'three' => esc_html__( 'Header Three', 'allo' ),
            'four' => esc_html__( 'Header Four', 'allo' ),
        ),
    ));

    $wp_customize->add_setting(
        'header_top_left_info', array(
            'sanitize_callback' => 'sanitize_text_field',
            'capability' => 'edit_theme_options',
            'type'      =>  'theme_mod',
            'transport'   => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'header_top_left_info', array(
            'label' => esc_html__( 'Heard Info', 'allo' ),
            'type' => 'text',
            'section' => 'allo_header',
            'description' => esc_html__( 'Add your location info at here.', 'allo' ),
        )
    );

    //Header Location
    $wp_customize->add_setting(
        'header_location_icon', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'type'      =>  'theme_mod',
            'transport'   => 'postMessage',
            'default' => 'fa-map-marker',
        )
    );

    //Header Location
    $wp_customize->add_control(
        'header_location_icon', array(
            'label' => esc_html__( 'Header Location Icon Code', 'allo' ),
            'type' => 'text',
            'section' => 'allo_header',
            'description' => esc_html__( 'Add your location icon at here. Ex.(fa-map-marker)', 'allo' ),
        )
    );
    $wp_customize->add_setting(
        'header_location_text', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'type'      =>  'theme_mod',
            'transport'   => 'postMessage',
            'default' => '68 house, Melborne, Australia',
        )
    );

    $wp_customize->add_control(
        'header_location_text', array(
            'label' => esc_html__( 'Header Location Info', 'allo' ),
            'type' => 'text',
            'section' => 'allo_header',
            'description' => esc_html__( 'Add your location info at here.', 'allo' ),
        )
    );

    //Header Phone
    $wp_customize->add_setting(
        'header_phone_icon', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'type'      =>  'theme_mod',
            'transport'   => 'postMessage',
            'default' => 'fa-phone',
        )
    );
    $wp_customize->add_control(
        'header_phone_icon', array(
            'label' => esc_html__( 'Header Phone Icon Code', 'allo' ),
            'type' => 'text',
            'section' => 'allo_header',
            'description' => esc_html__( 'Add your phone icon at here. Ex.(fa-phone)', 'allo' ),
        )
    );
    $wp_customize->add_setting(
        'header_phone_text', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'sanitize_text_field',
            'type'      =>  'theme_mod',
            'transport'   => 'postMessage',
            'default' => 'Hot Line: + 0568 099 99',
        )
    );

    $wp_customize->add_control(
        'header_phone_text', array(
            'label' => esc_html__( 'Header Phone Info', 'allo' ),
            'type' => 'text',
            'section' => 'allo_header',
            'description' => esc_html__( 'Add your phone info at here.', 'allo' ),
        )
    );
    /**
     * End Allo WordPress Theme Heading Control Panel
     */   

    /**
     * End Allo WordPress Theme Page Header
     */  

    $wp_customize->add_setting( 'allo_blog_text' , array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
        'type'      =>  'theme_mod',
        'default' => 'Our Latest Blog',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control(
        'allo_blog_text', array(
            'label' => esc_html__( 'Added Blog Page Heading:', 'allo' ),
            'type' => 'text',
            'section' => 'header_image',
        )
    );

    /**
     * End Allo WordPress Theme Page Header
     */   

    /**
     * Allo WordPress Theme Blog Settings
     */ 
    $wp_customize->add_section( 'allo_blog_settings' , array(
        'title'      => esc_html__( 'Blog Settings', 'allo' ),
        'priority'   => 90,   
    ));

    $wp_customize->add_setting( 'allo_blog_container_dispay' , array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'allo_container_callback',
        'type' =>  'theme_mod',
        'default' => 'container_full',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 'allo_blog_container_dispay', array(
        'label' => esc_html__( 'Container Display: ', 'allo' ),
        'description' => esc_html__( 'How Container you want to show.', 'allo' ),
        'section' => 'allo_blog_settings',
        'type' => 'radio',
        'choices' => array(
            'container'  => esc_html__( 'Default', 'allo' ),
            'container_full'   => esc_html__( 'Full Width', 'allo' ),
        ),
    ));

    $wp_customize->add_setting( 'allo_blog_style' , array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'allo_blog_style_callback',
        'type'      =>  'theme_mod',
        'default' => 'style_one',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 'allo_blog_style', array(
        'label' => esc_html__( 'Blog Style: ', 'allo' ),
        'description' => esc_html__( 'Choose a blog layout.', 'allo' ),
        'section' => 'allo_blog_settings',
        'type' => 'radio',
        'choices' => array(
            'style_one'  => esc_html__( 'Style One', 'allo' ),
            'style_two'   => esc_html__( 'Style Two', 'allo' ),
        ),
    ));

    $wp_customize->add_setting( 'allo_blog_sidebar_dispay' , array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'allo_blog_sidebar_callback',
        'type'      =>  'theme_mod',
        'default' => 'right_side',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 'allo_blog_sidebar_dispay', array(
        'label' => esc_html__( 'Sidebar Display: ', 'allo' ),
        'description' => esc_html__( 'How you want to show widget.', 'allo' ),
        'section' => 'allo_blog_settings',
        'type' => 'radio',
        'choices' => array(
            'left_side'  => esc_html__( 'Left Sidebar', 'allo' ),
            'right_side'   => esc_html__( 'Right Sidebar', 'allo' ),
            'no_side'   => esc_html__( 'No Sidebar', 'allo' ),
        ),
    ));

    $wp_customize->add_setting( 'allo_blog_exert_length' , array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        'type'      =>  'theme_mod',
        'default' => 25,
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 'allo_blog_exert_length', array(
        'label' => esc_html__( 'Blog excerpt length: ', 'allo' ),
        'description' => esc_html__( 'How many words you want to display in blog posts.', 'allo' ),
        'section' => 'allo_blog_settings',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 0,
            'max'   => 50,
            'step' => 1,
        ),
    ));

    $wp_customize->add_setting( 'allo_blog_per_row' , array(
        'capability' => 'edit_theme_options',
        'sanitize_callback'    => 'absint',
        'type'      =>  'theme_mod',
        'default' => '3',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 'allo_blog_per_row', array(
        'label' => esc_html__( 'Posts per row: ', 'allo' ),
        'description' => esc_html__( 'How many posts should be shown per row?', 'allo' ),
        'section' => 'allo_blog_settings',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'   => 4,
            'step' => 1,
        ),
    ));

    $wp_customize->add_setting( 'allo_blog_row_per_page' , array(
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'absint',
        'type'      =>  'theme_mod',
        'default' => '3',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 'allo_blog_row_per_page', array(
        'label' => esc_html__( 'Row per page: ', 'allo' ),
        'description' => esc_html__( 'How many rows of posts should be shown per page?', 'allo' ),
        'section' => 'allo_blog_settings',
        'type'        => 'number',
        'input_attrs' => array(
            'min'  => 1,
            'max'   => 4,
            'step' => 1,
        ),
    ));


    /**
     * End Allo WordPress Theme Footer Control Panel
     */
    $wp_customize->add_section( 'allo_footer' , array(
        'title'      => esc_html__( 'Footer Settings', 'allo' ),
        'priority'   => 100,   
    ));

    $wp_customize->add_setting( 'allo_footer_widget' , array(
        'sanitize_callback' => 'allo_footer_widget_callback',
        'capability' => 'edit_theme_options',
        'type'      =>  'theme_mod',
        'default' => '4',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 'allo_footer_widget', array(
        'label' => esc_html__( 'Widget Display: ', 'allo' ),
        'description' => esc_html__( 'How many widget you want to show.', 'allo' ),
        'section' => 'allo_footer',
        'type' => 'radio',
        'choices' => array(
            '1'  => esc_html__( 'One', 'allo' ),
            '2'   => esc_html__( 'Two', 'allo' ),
            '3' => esc_html__( 'Three', 'allo' ),
            '4' => esc_html__( 'Four', 'allo' ),
        ),
    ));

    $wp_customize->add_setting( 'allo_footer_background' , array(
        'default'     => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability' => 'edit_theme_options',
        'type'      =>  'theme_mod',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'allo_footer_background', array(
           'label'    => esc_html__( 'Footer Background Color: ', 'allo' ),
           'section'  => 'allo_footer',
        ) 
    ));

    $wp_customize->add_setting( 'allo_footer_color' , array(
        'default'     => '#646464',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability' => 'edit_theme_options',
        'type'      =>  'theme_mod',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'allo_footer_color', array(
           'label'    => esc_html__( 'Footer Text Color: ', 'allo' ),
           'section'  => 'allo_footer',
        ) 
    ));    

    $wp_customize->add_setting( 'allo_footer_heading_color' , array(
        'default'     => '#222222',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability' => 'edit_theme_options',
        'type'      =>  'theme_mod',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'allo_footer_heading_color', array(
           'label'    => esc_html__( 'Footer Heading Color: ', 'allo' ),
           'section'  => 'allo_footer',
        ) 
    ));

    $wp_customize->add_setting( 'allo_footer_link_color' , array(
        'default'     => '#222222',
        'sanitize_callback' => 'sanitize_hex_color',
        'capability' => 'edit_theme_options',
        'type'      =>  'theme_mod',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( $wp_customize, 'allo_footer_link_color', array(
           'label'    => esc_html__( 'Footer Link Color: ', 'allo' ),
           'section'  => 'allo_footer',
        ) 
    ));

    $wp_customize->add_setting(
        'footer_copyright_info', array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'allo_sanitize_html',
            'type'      =>  'theme_mod',
            'transport'   => 'postMessage',
        )
    );

    $wp_customize->add_control(
        'footer_copyright_info', array(
            'label' => esc_html__( 'Footer Copyright Text:', 'allo' ),
            'type' => 'text',
            'section' => 'allo_footer',
        )
    );

    $wp_customize->add_setting( 'allo_footer_payment_image' , array(
        'default'     => TL_ALLO_TEMPLATE_DIR_URL . '/assets/images/pay.png',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'allo_sanitize_url',
        'type'      =>  'theme_mod',
        'transport'   => 'postMessage',
    ));

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 
        'allo_footer_payment_image', array(
            'label'   => esc_html__('Footer Payment Info:','allo'),
            'section' => 'allo_footer',
    ) ) );
    /**
     * End Allo WordPress Theme Footer Control Panel
     */    

    /**
     * Allo WordPress Theme WooCommerce Control Panel
     */
    if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {  
        $wp_customize->add_section( 'allo_woo_settings' , array(
            'title'      => esc_html__( 'WooCommerce Layout', 'allo' ),
            'priority'   => 40,
            'panel'    => 'woocommerce',   
        ));

        $wp_customize->add_setting( 'allo_woo_container_dispay' , array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'allo_container_callback',
            'type' =>  'theme_mod',
            'default' => 'container_full',
            'transport'   => 'postMessage',
        ));

        $wp_customize->add_control( 'allo_woo_container_dispay', array(
            'label' => esc_html__( 'Container Display: ', 'allo' ),
            'description' => esc_html__( 'How Container you want to show.', 'allo' ),
            'section' => 'allo_woo_settings',
            'type' => 'radio',
            'choices' => array(
                'container'  => esc_html__( 'Default', 'allo' ),
                'container_full'   => esc_html__( 'Full Width', 'allo' ),
            ),
        ));

        $wp_customize->add_setting( 'allo_woo_sidebar_dispay' , array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'allo_blog_sidebar_callback',
            'type'      =>  'theme_mod',
            'default' => 'no_side',
            'transport'   => 'postMessage',
        ));

        $wp_customize->add_control( 'allo_woo_sidebar_dispay', array(
            'label' => esc_html__( 'Sidebar Display: ', 'allo' ),
            'description' => esc_html__( 'How you want to show widget.', 'allo' ),
            'section' => 'allo_woo_settings',
            'type' => 'radio',
            'choices' => array(
                'left_side'  => esc_html__( 'Left Sidebar', 'allo' ),
                'right_side'   => esc_html__( 'Right Sidebar', 'allo' ),
                'no_side'   => esc_html__( 'No Sidebar', 'allo' ),
            ),
        ));

        $wp_customize->add_setting( 'allo_woo_single_dispay' , array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'allo_woo_single_style_callback',
            'type'      =>  'theme_mod',
            'default' => 'style_one',
            'transport'   => 'postMessage',
        ));

        $wp_customize->add_control( 'allo_woo_single_dispay', array(
            'label' => esc_html__( 'Shop Single Page Display: ', 'allo' ),
            'description' => esc_html__( 'How you want to show shop single page.', 'allo' ),
            'section' => 'allo_woo_settings',
            'type' => 'radio',
            'choices' => array(
                'style_one'  => esc_html__( 'Style One', 'allo' ),
                'style_two'   => esc_html__( 'Style Two', 'allo' ),
                'style_three'   => esc_html__( 'Style Three', 'allo' ),
            ),
        ));

        $wp_customize->add_setting( 'allo_woo_related_dispay' , array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'allo_woo_related_products_show_callback',
            'type'      =>  'theme_mod',
            'default' => 'off',
            'transport'   => 'postMessage',
        ));

        $wp_customize->add_control( 'allo_woo_related_dispay', array(
            'label' => esc_html__( 'Related Product Display: ', 'allo' ),
            'description' => esc_html__( 'How you want to show Related Post in single page.', 'allo' ),
            'section' => 'allo_woo_settings',
            'type' => 'radio',
            'choices' => array(
                'on'  => esc_html__( 'Enable', 'allo' ),
                'off'   => esc_html__( 'Disable', 'allo' ),
            ),
        ));

        $wp_customize->add_setting( 'allo_woo_related_query' , array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'allo_woo_related_query_callback',
            'type'      =>  'theme_mod',
            'default' => 'category',
            'transport'   => 'postMessage',
        ));

        $wp_customize->add_control( 'allo_woo_related_query', array(
            'label' => esc_html__( 'Related Products Query: ', 'allo' ),
            'description' => esc_html__( 'How you want to show related products shop single page.', 'allo' ),
            'section' => 'allo_woo_settings',
            'type' => 'radio',
            'choices' => array(
                'category'  => esc_html__( 'Category', 'allo' ),
                'tag'   => esc_html__( 'Tags', 'allo' ),
                'best_saller'   => esc_html__( 'Best Sale', 'allo' ),
            ),
        ));
        $wp_customize->add_setting( 'allo_woo_related_post_no' , array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'type'      =>  'theme_mod',
            'default' => 4,
            'transport'   => 'postMessage',
        ));

        $wp_customize->add_control( 'allo_woo_related_post_no', array(
            'label' => esc_html__( 'Related Products Numbers: ', 'allo' ),
            'description' => esc_html__( 'How many related products on shop single page.', 'allo' ),
            'section' => 'allo_woo_settings',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 1,
                'max'   => 20,
                'step' => 1,
            ),
        ));
        $wp_customize->add_setting( 'allo_woo_new_product_base_day' , array(
            'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
            'type'      =>  'theme_mod',
            'default' => 15,
            'transport'   => 'postMessage',
        ));

        $wp_customize->add_control( 'allo_woo_new_product_base_day', array(
            'label' => esc_html__( 'New Product Badge: ', 'allo' ),
            'description' => esc_html__( 'How many days you declare for showing the new badge.', 'allo' ),
            'section' => 'allo_woo_settings',
            'type'        => 'number',
            'input_attrs' => array(
                'min'  => 1,
                'max'   => 100,
                'step' => 1,
            ),
        ));
    }
    /**
     * End Allo WordPress Theme WooCommerce Control Panel
     */
}
add_action( 'customize_register', 'allo_customize_register' );
/**
 * Bind JS handlers to instantly live-preview changes.
 */
function allo_customize_preview_js() {
    wp_enqueue_script('allo-customize-preview', TL_ALLO_TEMPLATE_DIR_URL . '/assets/js/customizer/customize-preview.js', array("jquery"), TL_ALLO_VERSION, true);
}
add_action( 'customize_preview_init', 'allo_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function allo_panels_js() {
    wp_enqueue_script('allo-customize-controls', TL_ALLO_TEMPLATE_DIR_URL . '/assets/js/customizer/customize-controls.js', array("jquery"), TL_ALLO_VERSION, true);
}
add_action( 'customize_controls_enqueue_scripts', 'allo_panels_js' );
