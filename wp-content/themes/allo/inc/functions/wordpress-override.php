<?php
/**
 * Allo WordPress Overwrite Functions 
 *
 * @package Allo
 * @since 1.0
 */
if ( ! defined( 'ABSPATH' ) ) die( esc_html__('Direct access forbidden.', 'allo') );

class TL_ALLO_WP_Override {
 
    public function __construct() {  
        /**
         * Read More Filter
         *
         * @package Allo
         * @since 1.0
         */
        add_filter( 'the_content_more_link', array($this, 'content_more') ); 

        /**
         * Overwrite Bracket From Category
         *
         * @package Allo
         * @since 1.0
         */
        add_filter( 'wp_list_categories', array($this, 'cats_postcount_filter') ); 

        /**
         * Overwrite archive bracket link
         *
         * @package Allo
         * @since 1.0
         */
        add_filter( 'get_archives_link', array($this, 'archive_postcount_filter') ); 

        /**
         * Remove unnecessary tag from shortcode
         *
         * @package Allo
         * @since 1.0
         */
        add_filter( 'the_content', array($this, 'remove_p_n_br_tag') ); 

    }

    /**
     * Content More
     *
     * @package Allo
     * @since 1.0
     */
    public function content_more() {
        return esc_html__( '&hellip; ', 'allo');
    }

    /**
     * Categories Bracket, 
     *
     * @package Allo
     * @since 1.0
     */
    public function cats_postcount_filter($args) {
        $args = str_replace('(', '<span class="count"> ', $args);
        return str_replace(')', ' </span>', $args); 
    }

    /**
     * Archive Brackets
     *
     * @package Allo
     * @since 1.0
     */
    public function archive_postcount_filter($args) {
        $args = str_replace('</a>&nbsp;(', '</a> <span class="count">', $args);
        return str_replace(')', ' </span>', $args); 
    }

    /**
     * Remove Paragraph and Br Tag
     *
     * @package Allo
     * @since 1.0
     */
    public function remove_p_n_br_tag($content) {
        $array = array (
            '<p>[' => '[',
            ']</p>' => ']',
            ']<br />' => ']'
        );
        $content = strtr($content, $array);
        return $content;   
    } 

    /**
     * Add property
     *
     * @package Allo
     * @since 1.0
     */
    public function add_property_attribute( $tag, $handle ) {
        if ( strpos( $tag, 'mediaelement' ) !== FALSE ) {
            $tag = str_replace( "/>", "property='stylesheet' />", $tag );
        }
        return $tag;
    }

    /**
     * De Register  Contact form 7
     *
     * @package Allo
     * @since 1.0
     */
    public function cf7_dequeue_scripts() {
        $load_scripts = false;
        $post = get_post();
        if( is_singular() ) {
            if( has_shortcode($post->post_content, 'contact-form-7') ) {
                $load_scripts = true;
            }
        }

        if( ! $load_scripts ) {
            wp_dequeue_script( 'contact-form-7' );
            wp_dequeue_style( 'contact-form-7' );
        }
    }
} 
new TL_ALLO_WP_Override; 