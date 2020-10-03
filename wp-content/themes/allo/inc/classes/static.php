<?php 
if ( ! defined( 'ABSPATH' ) ) die( esc_html__('Direct access forbidden.', 'allo') );

class TL_ALLO_Static {
    /**
     * Allow HTML tag from escaping HTML 
     * 
     * @return void
     * @since v1.0
     * @package Allo
     * @since 1.0
     */
    public static function html_allow() {
        return array(
            'a' => array(
                'href' => array(),
                'title' => array()
            ),
            'br' => array(),
            'del' => array(),
            'span' => array(
                'class' => array(),
            ),
            'em' => array(),
            'strong' => array(),
            'h1' => array(
                'class' => array(),
            ),            
            'h2' => array(
                'class' => array(),
            ),            
            'h3' => array(
                'class' => array(),
            ),           
            'h4' => array(
                'class' => array(),
            ),          
            'h5' => array(
                'class' => array(),
            ),         
            'h6' => array(
                'class' => array(),
            ),     
            'div' => array(
                'class' => array(),
                'id' => array(),
            ),          
            'aside' => array(
                'class' => array(),
                'id' => array(),
            ),
            'p' => array(),
            'img' => array(
                'alt'    => array(),
                'class'  => array(),
                'height' => array(),
                'src'    => array(),
                'width'  => array(),
            ),
        );
    }

    /**
     * Total Grid 
     *
     * @package Allo
     * @since 1.0
     */
    public static function total_grid() {
        return array(
            '1' => esc_html__( '1 Grid', 'allo' ),
            '2' => esc_html__( '2 Grid', 'allo' ),
            '3' => esc_html__( '3 Grid', 'allo' ),
            '4' => esc_html__( '4 Grid', 'allo' ),
            '5' => esc_html__( '5 Grid', 'allo' ),
            '6' => esc_html__( '6 Grid', 'allo' ),
            '7' => esc_html__( '7 Grid', 'allo' ),
            '8' => esc_html__( '8 Grid', 'allo' ),
            '9' => esc_html__( '9 Grid', 'allo' ),
            '10' => esc_html__( '10 Grid', 'allo' ),
            '11' => esc_html__( '11 Grid', 'allo' ),
            '12' => esc_html__( '12 Grid', 'allo' ),
        );
    }

    /**
     * Total Items
     *
     * @package Allo
     * @since 1.0
     */
    public static function total_items() {
        return array(
            '2' => esc_html__( 'Two', 'allo' ),
            '3' => esc_html__( 'Three', 'allo' ),
            '4' => esc_html__( 'Four', 'allo' ),
            '5' => esc_html__( 'Five', 'allo' ),
            '6' => esc_html__( 'Six', 'allo' ),
            '7' => esc_html__( 'Seven', 'allo' ),
        );
    }

    /**
     * Star Rating
     *
     * @package Allo
     * @since 1.0
     */
    public static function star_option() {
        return array(
            '1' => '1',
            '1.5' => '1.5',
            '2' => '2',
            '2.5' => '2.5',
            '3' => '3',
            '3.5' => '3.5',
            '4' => '4',
            '4.5' => '4.5',
            '5' => '5',
        );
    }

    /**
     * Function Number To Star
     *
     * @package Allo
     * @since 1.0
     */
    public static function num_to_star($total_stars) { 
        $star_integer = intval($total_stars); 
        $total_star = ''; 

        /**
         * This are full Star
         *
         * @package Allo
         * @since 1.0
         */
        for ($i = 0; $i < $star_integer; $i++) {
            $total_star .= '<i class="fa fa-star"></i>';
        }

        $star_rest = $total_stars - $star_integer;

        /**
         * this echo full star or half or empty star
         *
         * @package Allo
         * @since 1.0
         */

        if ($star_rest >= 0.25 and $star_rest < 0.75) {
            $total_star .= '<i class="fa fa-star-half-o"></i>';
        } else if ($star_rest >= 0.75) {
            $total_star .= '<i class="fa fa-star"></i>';
        } else if ($total_stars != 5) {
            $total_star .= '<i class="fa fa-star-o"></i>';
        }

        /**
         *  this echo empty star
         *
         * @package Allo
         * @since 1.0
         */
        for ($i = 0; $i < 4-$star_integer; $i++) {
            $total_star .= '<i class="fa fa-star-o"></i>';
        } 
        return $total_star;
    }

}
new TL_ALLO_Static;