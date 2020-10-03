<?php 
if ( ! defined( 'ABSPATH' ) ) die( esc_html__('Direct access forbidden.', 'allo') );

/**
 * Protocol
 *
 * @package Allo
 * @since 1.0
 */
$protocol = is_ssl() ? 'https' : 'http';

/**
 * Enqueue Style/CSS
 *
 * @package Allo
 * @since 1.0
 */
wp_enqueue_style('bootstrap', TL_ALLO_TEMPLATE_DIR_URL . "/css/bootstrap.min.css");
wp_enqueue_style('animate', TL_ALLO_TEMPLATE_DIR_URL . "/css/animate.css");
wp_enqueue_style( 'jquery-ui' );
wp_enqueue_style('allo-menamenu', TL_ALLO_TEMPLATE_DIR_URL . "/css/meanmenu.min.css");
wp_enqueue_style('owl-carousel', TL_ALLO_TEMPLATE_DIR_URL . "/css/owl.carousel.min.css");
wp_enqueue_style('slick', TL_ALLO_TEMPLATE_DIR_URL . "/css/slick.css");
wp_enqueue_style('magnific-popup', TL_ALLO_TEMPLATE_DIR_URL . "/css/magnific-popup.css");
wp_enqueue_style('font-awesome', TL_ALLO_TEMPLATE_DIR_URL . "/css/font-awesome.min.css");
wp_enqueue_style( 'allo-style', get_stylesheet_uri() ); 
wp_enqueue_style('allo-responsive', TL_ALLO_TEMPLATE_DIR_URL . "/css/responsive.css");

/**
 * Enqueue Script
 *
 * @package Allo
 * @since 1.0
 */
wp_enqueue_script('modernizr-js', TL_ALLO_TEMPLATE_DIR_URL . '/js/vendor/modernizr-2.8.3.min.js', array("jquery"), false, true);
wp_enqueue_script('bootstrap-js', TL_ALLO_TEMPLATE_DIR_URL . '/js/bootstrap.min.js', array("jquery"), false, true);
wp_enqueue_script('owl-carousel-js', TL_ALLO_TEMPLATE_DIR_URL . '/js/owl.carousel.min.js', array("jquery"), false, true);
wp_enqueue_script('jquery-isotope', TL_ALLO_TEMPLATE_DIR_URL . '/js/isotope.pkgd.min.js', array("jquery"), false, true);
wp_enqueue_script('magnific-popup-js', TL_ALLO_TEMPLATE_DIR_URL . '/js/jquery.magnific-popup.min.js', array("jquery"), false, true);
wp_enqueue_script('meanmenu-js', TL_ALLO_TEMPLATE_DIR_URL . '/js/jquery.meanmenu.js', array("jquery"), false, true);
wp_enqueue_script('jarallax', TL_ALLO_TEMPLATE_DIR_URL . '/js/jarallax.min.js', array("jquery"), false, true);
wp_enqueue_script("jquery-ui");
wp_enqueue_script('wow-js', TL_ALLO_TEMPLATE_DIR_URL . '/js/wow.min.js', array("jquery"), false, true);
wp_enqueue_script('touchslider-js', TL_ALLO_TEMPLATE_DIR_URL . '/js/touchslider.js', array("jquery"), false, true);
wp_enqueue_script('slick-js', TL_ALLO_TEMPLATE_DIR_URL . '/js/slick.min.js', array("jquery"), false, true);
wp_enqueue_script('downCount-js', TL_ALLO_TEMPLATE_DIR_URL . '/js/jquery.downCount.js', array("jquery"), false, true);
wp_enqueue_script('mouse-scroll-plugin', TL_ALLO_TEMPLATE_DIR_URL . '/js/scrollup.js', array("jquery"), false, true);
wp_enqueue_script('fitvids', TL_ALLO_TEMPLATE_DIR_URL . '/js/jquery.fitvids.js', array("jquery"), false, true);
wp_enqueue_script('allo-main-function-js', TL_ALLO_TEMPLATE_DIR_URL . '/js/main.js', array("jquery"), false, true);
wp_enqueue_script('allo-custom-js', TL_ALLO_TEMPLATE_DIR_URL . '/assets/custom/custom.js', array("jquery"), false, true);
wp_localize_script("allo-custom-js", "allo", array (
        'ajaxurl' => admin_url( "admin-ajax.php" ), 
    )
);

if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
}