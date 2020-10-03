<?php 
/**
 * All Backend After Theme Setup
 *
 * @package Allo
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) die( esc_html__('Direct access forbidden.', 'allo') );

class TL_ALLO_Backend_Master {

    public function __construct() {  
        /**
         * Add after_setup_theme() for specific functions.
         *
         * @package Allo
         * @since 1.0
         */ 
        add_action( 'after_setup_theme', array( $this, 'theme_setup_core' ) );

        /**
         * Register all admin scripts and styles
         *
         * @package Allo
         * @since 1.0
         */
        add_action( 'admin_enqueue_scripts', array($this, 'scripts_and_styles') );

        /**
         * Register our Widgets
         *
         * @package Allo
         * @since 1.0
         */
        add_action( 'widgets_init', array( $this, 'widgets_init' ) );
    }

    /**
     * After Theme Setup functions, 
     *
     * @package Allo
     * @since 1.0
     */
    public function theme_setup_core() {
        get_template_part('/inc/classes/backend/partials/action_after_setup_theme'); 
    }

    /**
     * Admin Script and Style
     *
     * @package Allo
     * @since 1.0
     */
    public function scripts_and_styles($hook) {
        get_template_part('/inc/classes/backend/partials/action_admin_enqueue_scripts');
    }

    /**
     * Widget include
     *
     * @package Allo
     * @since 1.0
     */
    public function widgets_init() {
        get_template_part('/inc/classes/backend/partials/action_widgets_init');
    }

}

new TL_ALLO_Backend_Master; 