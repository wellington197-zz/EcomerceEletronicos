<?php 
/**
 * Admin Script/Styles
 *
 * @package Allo
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) die( esc_html__('Direct access forbidden.', 'allo') );

wp_enqueue_style('allo-admin-css', TL_ALLO_TEMPLATE_DIR_URL . "/assets/custom/admin.css");

// enqueue scripts
wp_enqueue_script('allo-backend-js', TL_ALLO_TEMPLATE_DIR_URL . '/assets/custom/admin.js', array("jquery"), false, true);

wp_localize_script("allo-backend-js", "allo", array (
        'ajaxurl' => admin_url( "admin-ajax.php" ),
        'root' => esc_url_raw( rest_url() ),
        'home_uri' => esc_url( home_url( '/' ) ), 
    )
);