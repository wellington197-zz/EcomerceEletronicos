<?php

/**
 * Enqueue CSS & JS
 */

function virtue_admin_scripts( $hook ) {

	wp_enqueue_style('virtue_admin_styles', get_template_directory_uri() . '/assets/css/kad_adminstyles.css', false, VIRTUE_VERSION);

	if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' && $hook != 'widgets.php') {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_script('virtue_admin_script', get_template_directory_uri() . '/assets/js/virtue_admin.js', false, VIRTUE_VERSION);

}

add_action( 'admin_enqueue_scripts', 'virtue_admin_scripts' );
