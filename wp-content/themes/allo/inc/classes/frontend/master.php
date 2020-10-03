<?php 
/**
 * Allo Front End Master
 *
 * @package Allo
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) die( esc_html__('Direct access forbidden.', 'allo') );
 
class TL_ALLO_Master {

    public function __construct() {  

        /**
         * Set content width for custom media information
         *
         * @package Allo
         * @since 1.0
         */
        global $content_width;
        if ( ! isset( $content_width ) ) $content_width = 1020;

        /**
         * Register all wp scripts and styles
         *
         * @package Allo
         * @since 1.0
         */
        add_action( 'wp_enqueue_scripts', array($this, 'scripts_and_styles') );

        /**
         * WordPress title filter.
         *
         * @package Allo
         * @since 1.0
         */
        add_filter( "wp_title", array( $this, "page_title" ) );

        /**
         * Excerpt Length
         *
         * @package Allo
         * @since 1.0
         */
        add_filter( 'excerpt_length', array( $this, 'excerpt_length' ), 10 );

        /**
         *  Add read more link instead of [...]
         *
         * @package Allo
         * @since 1.0
         */
        add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
    }
 
    /**
     * All Script and Style Enqueue
     *
     * @package Allo
     * @since 1.0
     */
    public function scripts_and_styles() {
        get_template_part('/inc/classes/frontend/partials/action_wp_enqueue_scripts'); 
    } 

    /**
     * Write the theme title. It doesnt return anything.
     * The simple name comes, because its very natural when call it:
     * Header::title();
     * 
     * @uses get_bloginfo()
     * @uses wp_title()
     * @uses is_home()
     * @uses is_front_page();
     * @package Allo
     * @since  1.0
     */
    public function page_title( $title, $sep = ' | ' ) {
        global $page, $paged;

        if ( is_feed() )
            return $title;

        $site_description = get_bloginfo( 'description' );

        $filtered_title = $title . get_bloginfo( 'name' );
        $filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? $sep . $site_description: '';
        /* translators: Page No */
        $filtered_title .= ( 2 <= $paged || 2 <= $page ) ? $sep . sprintf( __( 'Page %s', 'allo' ), max( $paged, $page ) ) : '';

        return $filtered_title;
    }
    /**
     * Excerpt Length
     *
     * @package Allo
     * @since 1.0
     */
    public function excerpt_length( $length ) {
    	if ( is_admin() ) {
            return $length;
        }
        return get_theme_mod('allo_blog_exert_length', 25);
    }

    /**
     * Excerpt More 
     *
     * @package Allo
     * @since 1.0
     */
    public function excerpt_more( $more ) {
		if ( is_admin() ) {
	        return $more;
	    }
        return '';
    }

} 
new TL_ALLO_Master; 