<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
} 
/** 
 * Checks if Elementor is enabled
 */
class Virtue_Elementor_Plugin_Check {

	private static $active_plugins;

	public static function init() {

	self::$active_plugins = (array) get_option( 'active_plugins', array() );

	if ( is_multisite() )
		self::$active_plugins = array_merge( self::$active_plugins, get_site_option( 'active_sitewide_plugins', array() ) );
	}

	public static function active_check_ele() {

		if ( ! self::$active_plugins ) {
			self::init();
		}
		return in_array( 'elementor/elementor.php', self::$active_plugins ) || array_key_exists( 'elementor/elementor.php', self::$active_plugins );
	}

}