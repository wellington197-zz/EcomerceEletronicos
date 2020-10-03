<?php
/**
 * Custom conditional tags for this theme.
 *
 * @package Allo
 * @since 1.0
 */

if ( ! defined( 'TL_ALLO_IS_ACTIVE_CF7' ) ) {
    define( 'TL_ALLO_IS_ACTIVE_CF7', in_array( 'contact-form-7/wp-contact-form-7.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );
}

if ( ! defined( 'TL_ALLO_IS_ACTIVE_WC' ) ) {
    define( 'TL_ALLO_IS_ACTIVE_WC', in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );
}