<?php
/**
 * Hooks for template footer
 * Custom scripts  on footer
 * @package Allo
 * @since  1.0
 */
function allo_footer_scripts() {
	// Custom javascript
    ob_start(); ?>
    function allo_PopupWindow(url, title, w, h) {
        var left = (screen.width/2)-(w/2);
        var top = (screen.height/2)-(h/2);
        return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
    }  
    <?php $custom_code = ob_get_clean();
    $custom_code .= allo_fw_post_meta('custom_js');
    $custom_code .= allo_get_customizer_field('custom_js');
	wp_add_inline_script( 'allo-custom-js', $custom_code );
}
add_action( 'wp_enqueue_scripts', 'allo_footer_scripts', 200 );
