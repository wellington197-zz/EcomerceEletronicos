<?php
/**
 * Allo Hexa 2 RGB Code
 *
 * @package Allo
 * @since 1.0
 */
function allo_hex_2_rgba($color, $opacity = false) {
    $default = 'rgb(0,0,0)';
    //Return default if no color provided
    if(empty($color))
        return $default; 
 
    //Sanitize $color if "#" is provided 
    if ($color[0] == '#' ) {
        $color = substr( $color, 1 );
    }
 
    //Check if color has 6 or 3 characters and get values
    if (strlen($color) == 6) {
        $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
    } elseif ( strlen( $color ) == 3 ) {
        $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
    } else {
        return $default;
    }
 
    //Convert hexadec to rgb
    $rgb =  array_map('hexdec', $hex);
 
    //Check if opacity is set(rgba or rgb)
    if($opacity){
        if(abs($opacity) > 1)
            $opacity = 1.0;
        $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
    } else {
        $output = 'rgb('.implode(",",$rgb).')';
    }
 
    //Return rgb(a) color string
    return $output;
}
/**
 * Allo color's
 *
 * @package Allo
 * @since 1.0
 */
function allo_color() {  
    $setting_color = get_theme_mod('allo_theme_color');

    switch( $setting_color ) {
        case '1':  
            // add a condition to show demo color scheme by url
            ( isset($_GET["color_scheme_color"]) ) ? $color_scheme_color = sanitize_text_field( wp_unslash( $_GET["color_scheme_color"] ) )  : $color_scheme_color = "" ;
            if (preg_match('/^[A-Z0-9]{6}$/i', $color_scheme_color)) {
              $demo_color_scheme = sanitize_text_field( wp_unslash( $_GET["color_scheme_color"] ) );
            }
            else {
               $demo_color_scheme = "03dedf";
            }
            $allo_color = "#".$demo_color_scheme; 
            break;
        case '2': 
            $allo_color = "#d12a5c";
            break;
        case '3': 
            $allo_color = "#49ca9f";
            break;
        case '4': 
            $allo_color = "#1f1f1f";
            break;
        case '5': 
            $allo_color = "#808080";
            break;
        case '6': 
            $allo_color = "#ebebeb";
            break;
        default: 
            $allo_color = get_theme_mod('allo_theme_color', '#2962ff'); 
    }
    //rgba color
    $allo_rgba_color = allo_hex_2_rgba($allo_color, 0.8);
?>
::selection {background: <?php echo esc_attr($allo_color); ?> none repeat scroll 0 0; } *::-moz-selection {background: <?php echo esc_attr($allo_color); ?> none repeat scroll 0 0; } a:hover, a:focus, a:active {color: <?php echo esc_attr($allo_color); ?>; } label a {color: <?php echo esc_attr($allo_color); ?>; } .post-content a {color: <?php echo esc_attr($allo_color); ?>; } .post-password-form input[type="submit"] { background: <?php echo esc_attr($allo_color); ?>; border: 1px solid <?php echo esc_attr($allo_color); ?>; } h1 a:hover, h2 a:hover, h3 a:hover, h4 a:hover, h5 a:hover, h6 a:hover { color: <?php echo esc_attr($allo_color); ?> !important; } .single-blog-area .blog-content .post-content blockquote {border-left-color: <?php echo esc_attr($allo_color); ?>; } .comment-con a:not(.comment-reply-link) {color: <?php echo esc_attr($allo_color); ?>;} .widget_categories ul li:before, .widget_archive ul li:before, .widget_layered_nav ul li:before, .widget_links ul li:before,.widget_meta ul li:before,.widget_nav_menu ul li:before,.widget_pages ul li:before,.widget_recent_comments ul li:before,.widget_recent_entries ul li:before,
.widget_product_categories ul li:before { color: <?php echo esc_attr($allo_color); ?>; }
.woo-menu-item.woo-list form.cart .single_add_to_cart_button { border-color: <?php echo esc_attr($allo_color); ?> !important; color: <?php echo esc_attr($allo_color); ?> !important; } .menu-style-four .dropdown .dropdown-menu  li a:hover {color: <?php echo esc_attr($allo_color); ?> !important;} header .header-top-four .higlight .search-box button[type="submit"] {background: <?php echo esc_attr($allo_color); ?>} .tagcloud a:hover{ border-color: <?php echo esc_attr($allo_color); ?> !important; background: <?php echo esc_attr($allo_color); ?> !important; } .woocommerce-tabs .wc-tabs li.active a { color: <?php echo esc_attr($allo_color); ?>; } .widget table a { color: <?php echo esc_attr($allo_color); ?>; } .woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover,.woocommerce #review_form #respond .form-submit input[type="submit"]:hover {background-color: <?php echo esc_attr($allo_color); ?> !important;} .woocommerce form.woocommerce-form-login button[name="login"]:hover,.woocommerce form.checkout_coupon button[name="apply_coupon"]:hover,.woocommerce-EditAccountForm .woocommerce-Button:hover {background: <?php echo esc_attr($allo_color); ?> !important;}
.woocommerce-MyAccount-navigation li.is-active a {background-color: <?php echo esc_attr($allo_color); ?>} .woo-menu-item.woo-list form.cart .new-arrival-item .wishlist-btn:hover { border-color: <?php echo esc_attr($allo_color); ?> !important; background: <?php echo esc_attr($allo_color); ?> !important; } form.cart .single_add_to_cart_button { border-color: <?php echo esc_attr($allo_color); ?> !important; color: <?php echo esc_attr($allo_color); ?> !important; }
.user-cart .budge { background: <?php echo esc_attr($allo_color); ?> !important; } .posts-sorting .bsm-dropdown-content li > a, .posts-sorting .bsm-select-wrapper input.select-dropdown, .posts-sorting .bsm-dropdown-content li > span { color: <?php echo esc_attr($allo_color); ?>; } .woocommerce .return-to-shop .wc-backward  {    background-color: <?php echo esc_attr($allo_color); ?> !important; } .widget_allo_newsletter .newsletter-area .mc-embedded-subscribe-form .mc-embedded-subscribe { background-color: <?php echo esc_attr($allo_color); ?>; } .entry-title a:hover, .reset_variations { color: <?php echo esc_attr($allo_color); ?>; } .breadcumb-area .breadcumb-content .breadcumb-link ul li span a { color: <?php echo esc_attr($allo_color); ?>; } .logged-in-as a { color: <?php echo esc_attr($allo_color); ?>; } .comment-navigation .nav-links a, .single-blog-area .comment-respond form.comment-form input[type="submit"] { background-color: <?php echo esc_attr($allo_color); ?>; } .woocommerce .register .woocommerce-Button:hover {background: <?php echo esc_attr($allo_color); ?>;} .woocommerce .widget_price_filter .ui-slider .ui-slider-range {background-color: <?php echo esc_attr($allo_color); ?> !important;} .widget_price_filter .price_slider_amount .button:hover {background: <?php echo esc_attr($allo_color); ?> !important;} .footer-top a:hover {color: <?php echo esc_attr($allo_color); ?> !important;} .woocommerce-message .wc-forward {background: <?php echo esc_attr($allo_color); ?> !important;}
<?php
} // end allo_color function
allo_color(); // here print the function

/**
 * All Page Heading Style 
 *
 * @package Allo
 * @since 1.0
 */
function allo_backgound_image_cover_bg() { ?>
.page-header-content { background-image: url(<?php header_image(); ?>); } .mean-container .mean-bar .mobile-logo { background: transparent url(<?php echo esc_url(get_theme_mod('allo_mobile_logo', TL_ALLO_TEMPLATE_DIR_URL . '/assets/images/logo/logo2.png')); ?>) no-repeat scroll 0 0; 
}
<?php }
allo_backgound_image_cover_bg();

/**
 * Extra Inline Code
 *
 * @package Allo
 * @since 1.0
 */
function allo_customizer_css_color() {
    $footerBg = get_theme_mod('allo_footer_background','#ffffff');
    $footerColor = get_theme_mod('allo_footer_color','#646464');
    $footerHeadingColor = get_theme_mod('allo_footer_heading_color','#222222');
    $footerlinkColor = get_theme_mod('allo_footer_link_color','#646464');
    ?>
.footer-one .footer-top {background: <?php echo esc_attr($footerBg); ?>; color: <?php echo esc_attr($footerColor); ?>;} footer h1, footer h2, footer h3, footer h4, footer h5, footer h6 {color: <?php echo esc_attr($footerHeadingColor); ?>;} .footer-top a {color: <?php echo esc_attr($footerlinkColor); ?> !important;}
    <?php
}
allo_customizer_css_color();