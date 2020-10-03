<?php
/**
 * Allo functions and definitions
 *
 * @package Allo
 * @since 1.0
 *
 * Here is TL mean Themelocation and Allo is theme name
 */
if ( ! defined( 'TL_ALLO_VERSION' ) ) {
	define( 'TL_ALLO_VERSION', '1.0' );
}
if ( ! defined( 'TL_ALLO_TEMPLATE_DIR' ) ) {
	define( 'TL_ALLO_TEMPLATE_DIR', get_template_directory() );
}
if ( ! defined( 'TL_ALLO_TEMPLATE_DIR_URL' ) ) {
    define( 'TL_ALLO_TEMPLATE_DIR_URL', get_template_directory_uri() );
}

/**
 * Include Conditional Tags, 
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/functions/conditional-tags.php';

/**
 * Include Front end Master Class 
 *
 * @package Allo
 * @since 1.0
 */

require TL_ALLO_TEMPLATE_DIR . '/inc/classes/frontend/master.php';

/**
 * Include Backend Master Class, 
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/classes/backend/backend_master.php';

/**
 * Include Static Resource Class, 
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/classes/static.php';

/**
 * Include Essential Functions
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/functions/essential-functions.php';

/**
 * Some Important Theme Function 
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/functions/theme-functions.php';

/**
 * Include Theme Template Tags, 
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/functions/template-tags.php';

/**
 * Include Customizer Basic Settings 
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/customizer/basic-settings.php';

/**
 * Include Sanitization Callback, 
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/customizer/sanitize-callback.php';

/**
 * Include Basic Function of customizer, 
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/customizer/customizer.php';

/**
 * Include Custom Nav Walker, 
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/mega-menu/menu.php';

/**
 * Include jetpack Compatibility 
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/functions/jetpack.php';

/**
 * Include TGM plugin activation script 
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/libs/tgm-plugin-activation/tgm-admin-config.php';

/**
 * Include WordPress Comments, 
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/functions/wp-comment-section-override.php';

/**
 * Include Functions for posts, 
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/functions/function-for-post.php';

/**
 * Include Front end header. This result execute on <head> tag
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/frontend/header.php';

/**
 * Include Footer Script, 
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/frontend/footer.php';

/**
 * Include WordPress Overwrite Functions
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/functions/wordpress-override.php';

/**
 * Include AJAX Functions
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/functions/ajax-functions.php';

/**
 * Include Aqua Resizer for Image resize Script
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/libs/aqua-resizer-master/aq_resizer.php';

/**
 * Include WooCommerce Template Overwrite function
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/woocommerce/woo-functions.php';

/**
 * Include Custom Widget 
 *
 * @package Allo
 * @since 1.0
 */
require TL_ALLO_TEMPLATE_DIR . '/inc/widgets/widgets.php';