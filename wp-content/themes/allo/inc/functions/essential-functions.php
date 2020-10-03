<?php 
/**
 * Allo Essential functions and definitions
 *
 * @package Allo
 * @since 1.0
 */

/**
 * Allo FW post Meta
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_fw_post_meta' ) ) :
    function allo_fw_post_meta() {
        $result = get_post_meta( get_the_ID(), 'fw_options', true); 
        foreach (func_get_args() as $arg) {
            if(is_array($arg)) {
                if (!empty($result[$arg[0]])) {
                    $result = $result[$arg[0]];
                } else {  
                  $result = $arg[1];
                }
            } else {
                if (!empty($result[$arg])) {
                    $result = $result[$arg];
                } else { 
                    $result = null;
                }
            }
        }
        return $result;
    }
endif;

/**
 * Allo Theme Return Function
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_return' ) ) :
    function allo_return($value) {
       return $value;
    }
endif;

/**
 * Allo FW Customizer Fields
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_get_customizer_field' ) ) :
    function allo_get_customizer_field() {
        $result = get_theme_mod('fw_options');
        foreach (func_get_args() as $arg) {
            if(is_array($arg)) {
                if (!empty($result[$arg[0]])) {
                    $result = $result[$arg[0]];
                } else {  
                  $result = $arg[1];
                }
            } else {
                if (!empty($result[$arg])) {
                    $result = $result[$arg];
                } else { 
                    $result = null;
                }
            }
        }
        return $result;
    }
endif;

/**
 * Allo Theme Builder
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_builder_field' ) ) :
    function allo_builder_field($value) {
        if(isset($value)) {
            return $value;
        }
    }
endif;