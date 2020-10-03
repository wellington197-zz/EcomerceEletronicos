<?php 
if ( ! defined( 'ABSPATH' ) ) die( esc_html__('Direct access forbidden.', 'allo') );

/*
 * Make theme available for translation.
 * Translations can be filed in the /languages/ directory.
 * If you're building a theme based on Allo, use a find and replace
 * to change 'allo' to the name of your theme in all the template files
 *  @since Allo 1.0
 */
load_theme_textdomain( 'allo', get_template_directory() . '/languages' );

// Add default posts and comments RSS feed links to head.
add_theme_support( 'automatic-feed-links' );

/*
 * Let WordPress manage the document title.
 * By adding theme support, we declare that this theme does not use a
 * hard-coded <title> tag in the document head, and expect WordPress to
 * provide it for us.
 *  @since Allo 1.0
 */
add_theme_support( 'title-tag' );

/*
 * Enable support for Post Thumbnails on posts and pages.
 *
 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
 *  @since Allo 1.0
 */
add_theme_support( 'post-thumbnails' );
/*
 * This theme uses wp_nav_menu() in one location.
 *
 *  @since Allo 1.0
 */
register_nav_menus( array(
    'main-menu' => esc_html__( 'Main Menu', 'allo' ),  
) );

/*
 * Switch default core markup for search form, comment form, and comments
 * to output valid HTML5.
 *  @since Allo 1.0
 */
add_theme_support( 'html5', array(
    'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
    ) 
);

/*
 * Set up the WordPress core custom background feature.
 *
 *  @since Allo 1.0
 */
add_theme_support( 'custom-background', apply_filters( 'allo_custom_background_args', array (
    'default-color' => 'ffffff',
    'default-image' => '',
) ) );

// Add theme support for selective refresh for widgets.
add_theme_support( 'customize-selective-refresh-widgets' );

/*
 * Enable support for custom Header Image.
 *
 *  @since Allo 1.0
 */
$args = array(
    'default-image' => TL_ALLO_TEMPLATE_DIR_URL . '/assets/images/banner.jpg',
	'flex-width'    => true,
	'width'         => 980,
	'flex-height'    => true,
	'height'        => 200,
);
add_theme_support( 'custom-header', $args );

/*
 * Enable support for custom Logo Image.
 *
 *  @since Allo 1.0
 */
$allo_cutom_logo = array(
    'height'      => 30,
    'width'       => 130,
    'flex-height' => true,
    'flex-width'  => true,
    'header-text' => array( 'site-title', 'site-description' ),
);
add_theme_support( 'custom-logo', $allo_cutom_logo );

/*
 * Enable support for custom Editor Style.
 *
 *  @since Allo 1.0
 */
add_editor_style( 'assets/css/custom-editor-style.css' );
