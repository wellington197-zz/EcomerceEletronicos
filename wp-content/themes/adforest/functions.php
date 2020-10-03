<?php
/**
 * adforest functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package adforest
 */

add_action( 'after_setup_theme', 'adforest_setup' );
if ( ! function_exists( 'adforest_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function adforest_setup() {
	
	/* ------------------------------------------------ */
	/* Theme Utilities */ 
	/* ------------------------------------------------ */
	require trailingslashit( get_template_directory () ) . 'inc/utilities.php';					
	/* ------------------------------------------------ */
	/* Theme Settings */
	/* ------------------------------------------------ */
	require trailingslashit( get_template_directory () ) . 'inc/theme_settings.php';
	/* ------------------------------------------------ */
	/* TGM */ 
	/* ------------------------------------------------ */
	require trailingslashit( get_template_directory () ) . 'tgm/tgm-init.php';					
	/* ------------------------------------------------ */
	/* Theme Options */ 
	/* ------------------------------------------------ */
	require trailingslashit( get_template_directory () ) . 'inc/options-init.php';
	/* ------------------------------------------------ */
	/* Theme Shortcodes */ 
	/* ------------------------------------------------ */
	require trailingslashit( get_template_directory () ) . 'inc/theme_shortcodes/shortcodes.php';
	/* ------------------------------------------------ */
	/* Theme Nav */ 
	/* ------------------------------------------------ */
	require trailingslashit( get_template_directory () ) . 'inc/nav.php';
	/* ------------------------------------------------ */
	/* Shop Settings */
	/* ------------------------------------------------ */
	require trailingslashit( get_template_directory () ) . 'inc/shop-func.php';
	/* ------------------------------------------------ */
	/* Search Widgets */
	/* ------------------------------------------------ */	
	require trailingslashit( get_template_directory () ) . 'inc/ads-widgets.php';
}
endif;


/* ------------------------------------------------ */
/* Enqueue google fonts . */
/* ------------------------------------------------ */

function adforest_google_fonts_service()
{
	
	global $adforest_theme;

	if(is_rtl())
	{
		$query_args = array( 'family' => '', 'subset' => '', );
		wp_register_style( 'adforest-arabic-naskh', add_query_arg( $query_args, "//fontlibrary.org/face/droid-arabic-naskh" ), array(), null );	
		wp_enqueue_style( 'adforest-arabic-naskh');	
	}
	else
	{

		if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
		{
			$query_args = array( 'family' => 'Source+Sans+Pro:400,400italic,600|Quicksand:400,500', 'subset' => '', );
		}
		else
		{
			$query_args = array( 'family' => 'Source+Sans+Pro:400,400italic,600,600italic,700,700italic,900italic,900,300,300italic|Merriweather:400,300,300italic,400italic,700,700italic', 'subset' => '', );
		}		
		
		wp_register_style( 'adforest-google_fonts', add_query_arg( $query_args, "//fonts.googleapis.com/css" ), array(), null );
		wp_enqueue_style( 'adforest-google_fonts');
	}
	
}          
add_action('wp_enqueue_scripts', 'adforest_google_fonts_service');

/* ------------------------------------------------ */
/* Enqueue scripts and styles. */
/* ------------------------------------------------ */
add_action( 'wp_enqueue_scripts', 'adforest_scripts' );
function adforest_scripts()
{
	global $adforest_theme;
/* Register scripts. */
wp_register_script( 'bootstrap', trailingslashit( get_template_directory_uri () ) . 'js/bootstrap.min.js', false, false, true );
wp_register_script( 'adforest-custom', trailingslashit( get_template_directory_uri () ) . 'js/custom.js', array('jquery', 'adforest-dt','typeahead'), false, true );
wp_register_script( 'adforest-custom-coming-soon', trailingslashit( get_template_directory_uri () ) . 'js/custom-coming-soon.js', array('jquery'), false, true );


wp_register_script( 'adforest-dt', trailingslashit( get_template_directory_uri () ) . 'js/datepicker.min.js', false, false, true );
wp_register_script( 'animate-number', trailingslashit( get_template_directory_uri () ) . 'js/animateNumber.min.js', false, false, true );
wp_register_script( 'carousel', trailingslashit( get_template_directory_uri () ) . 'js/carousel.min.js', false, false, true );
wp_register_script( 'coundown-timer', trailingslashit( get_template_directory_uri () ) . 'js/coundown-timer.js', false, false, true );
wp_register_script( 'dropzone', trailingslashit( get_template_directory_uri () ) . 'js/dropzone.js', false, false, true );
wp_register_script( 'isotope', trailingslashit( get_template_directory_uri () ) . 'js/isotope.min.js', false, false, true );
wp_register_script( 'easing', trailingslashit( get_template_directory_uri () ) . 'js/easing.js', false, false, true );
wp_register_script( 'file-input', trailingslashit( get_template_directory_uri () ) . 'js/fileinput.js', false, false, true );
wp_register_script( 'forest-megamenu', trailingslashit( get_template_directory_uri () ) . 'js/forest-megamenu.js', false, false, true );
wp_register_script( 'form-dropzone', trailingslashit( get_template_directory_uri () ) . 'js/form-dropzone.js', false, false, true );
wp_register_script( 'hover', trailingslashit( get_template_directory_uri () ) . 'js/hover.min.js', false, false, true );
wp_register_script( 'icheck', trailingslashit( get_template_directory_uri () ) . 'js/icheck.min.js', false, false, true );
wp_register_script( 'modernizr', trailingslashit( get_template_directory_uri () ) . 'js/modernizr.js', false, false, true );
wp_register_script( 'toastr', trailingslashit( get_template_directory_uri () ) . 'js/toastr.min.js', false, false, true );
wp_register_script( 'search-map', trailingslashit( get_template_directory_uri () ) . 'js/map.js', false, false, true );
wp_register_script( 'popup-video-iframe', trailingslashit( get_template_directory_uri () ) . 'js/YouTubePopUp.jquery.js', false, false, true );
wp_register_script( 'jquery-appear', trailingslashit( get_template_directory_uri () ) . 'js/jquery.appear.min.js', false, false, true );
wp_register_script( 'jquery-countTo', trailingslashit( get_template_directory_uri () ) . 'js/jquery.countTo.js', false, false, true );
wp_register_script( 'jquery-inview', trailingslashit( get_template_directory_uri () ) . 'js/jquery.inview.min.js', false, false, true );
wp_register_script( 'nouislider-all', trailingslashit( get_template_directory_uri () ) . 'js/nouislider.all.min.js', false, false, true );
wp_register_script( 'perfect-scrollbar', trailingslashit( get_template_directory_uri () ) . 'js/perfect-scrollbar.min.js', false, false, true );
wp_register_script( 'select-2', trailingslashit( get_template_directory_uri () ) . 'js/select2.min.js', false, false, true ); 
wp_register_script( 'slide', trailingslashit( get_template_directory_uri () ) . 'js/slide.js', false, false, true );
wp_register_script( 'color-switcher', trailingslashit( get_template_directory_uri () ) . 'js/color-switcher.js', false, false, true );
wp_register_script( 'parsley', trailingslashit( get_template_directory_uri () ) . 'js/parsley.min.js', false, false, true );
wp_register_script( 'recaptcha', '//www.google.com/recaptcha/api.js', false, false, true );
wp_register_script( 'hello', trailingslashit( get_template_directory_uri () ) . 'js/hello.js', false, false, true );
wp_register_script( 'jquery-te', trailingslashit( get_template_directory_uri () ) . 'js/jquery-te.min.js', false, false, true );
wp_register_script( 'tagsinput', trailingslashit( get_template_directory_uri () ) . 'js/jquery.tagsinput.min.js', false, false, true );
wp_register_script( 'theia-sticky-sidebar', trailingslashit( get_template_directory_uri () ) . 'js/theia-sticky-sidebar.js', false, false, true );
wp_register_script( 'bootstrap-confirmation', trailingslashit( get_template_directory_uri () ) . 'js/bootstrap-confirmation.min.js', false, false, true );

wp_register_script( 'fancybox', trailingslashit( get_template_directory_uri () ) . 'js/jquery.fancybox.min.js', false, false, true );

wp_register_script( 'adforest-search', trailingslashit( get_template_directory_uri () ) . 'js/search.js', false, false, true );
wp_register_script( 'jquery-smartWizard', trailingslashit( get_template_directory_uri () ) . 'js/jquery.smartWizard.min.js', false, false, true );
wp_register_script( 'adforest-ad-wizard', trailingslashit( get_template_directory_uri () ) . 'js/ad_post_wizard.js', false, false, true );
wp_register_script( 'oms', trailingslashit( get_template_directory_uri () ) . 'js/oms.min.js', false, false, true );
wp_register_script( 'adforest-timer', trailingslashit( get_template_directory_uri () ) . 'js/timer.js', false, false, true );
wp_register_script( 'jquery-ui-all', trailingslashit( get_template_directory_uri () ) . 'js/jquery-ui.min.js', false, false, true );
wp_register_script( 'adforest-jquery-touch-punch', trailingslashit( get_template_directory_uri () ) . 'js/jquery.ui.touch-punch.min.js', false, false, true );

wp_register_script( 'moment', trailingslashit( get_template_directory_uri () ) . 'js/moment.js', false, false, true );
wp_register_script( 'moment-timezone-with-data', trailingslashit( get_template_directory_uri () ) . 'js/moment-timezone-with-data.js', false, false, true );
wp_register_script( 'typeahead', trailingslashit( get_template_directory_uri () ) . 'js/typeahead.min.js', false, false, true );

/*Map Settings For The Theme. Default we have google map so if there is nothing selected the else statement will wors */
	$mapType = adforest_mapType();
	if( $mapType == 'leafletjs_map'  )
	{
		/*Open Street Map In The API*/
		if(!is_rtl())
		{
			wp_enqueue_style( 'leaflet', trailingslashit( get_template_directory_uri () )  . 'assets/leaflet/leaflet.css' );
		}
		else
		{
			wp_enqueue_style( 'leaflet', trailingslashit( get_template_directory_uri () )  . 'assets/leaflet/leaflet-rtl.css' );
		}
		wp_enqueue_style( 'leaflet-search', trailingslashit( get_template_directory_uri () )  . 'assets/leaflet/leaflet-search.min.css' );
		wp_register_script( 'leaflet', trailingslashit( get_template_directory_uri () ) . 'assets/leaflet/leaflet.js', false, false, false );
		wp_register_script( 'leaflet-markercluster', trailingslashit( get_template_directory_uri () ) . 'assets/leaflet/leaflet.markercluster.js', false, false, false );
		
		wp_register_script( 'leaflet-search', trailingslashit( get_template_directory_uri () ) . 'assets/leaflet/leaflet-search.min.js', false, false, false );
		
		wp_enqueue_script( 'leaflet');
		wp_enqueue_script( 'leaflet-markercluster');
		wp_enqueue_script( 'leaflet-search');
			
	}
	else if( $mapType == 'no_map'  )
	{
		/*No Mapp In The Theme*/		
	}
	else
	{
		/* Default is google map */
		if( isset( $adforest_theme['gmap_api_key'] ) && $adforest_theme['gmap_api_key'] != ""  )
		{
			$map_lang	= 'fr';
			if( isset( $adforest_theme['gmap_lang'] ) && $adforest_theme['gmap_lang'] != ""  ){
				$map_lang	= $adforest_theme['gmap_lang'];
			}
			wp_register_script( 'google-map', '//maps.googleapis.com/maps/api/js?key='.$adforest_theme['gmap_api_key'] .'&language='.$map_lang, false, false, true );
			wp_register_script( 'google-map-callback', '//maps.googleapis.com/maps/api/js?key=' . $adforest_theme['gmap_api_key'] . '&libraries=geometry,places&language='.$map_lang.'&callback=' . 'adforest_location' , false, false, true );
		}
	}
/* Load the custom scripts. */
wp_enqueue_script( 'adforest-maxcdn1', trailingslashit( get_template_directory_uri () ) . 'js/html5shiv.min.js' , array(), '3.7.2', false);
wp_script_add_data( 'adforest-maxcdn1', 'conditional', 'lt IE 9' );
wp_enqueue_script( 'adforest-maxcdn2', trailingslashit( get_template_directory_uri () ) . 'js/respond.min.js' , array(), '1.4.2', false);
wp_script_add_data( 'adforest-maxcdn2', 'conditional', 'lt IE 9' );
if ( is_singular() )
{ 
	wp_enqueue_script( "comment-reply" , '' , true ); 
}
wp_enqueue_script( 'bootstrap');
wp_enqueue_script( 'toastr');
wp_enqueue_script( 'imagesloaded');
$is_live = true;
if( isset($adforest_theme['sb_comming_soon_mode']) && $adforest_theme['sb_comming_soon_mode'] )
{
	$is_live = false;
	
	if ( is_super_admin( get_current_user_id() ) )
	{
		if( !$is_live )
		{
			$is_live = true;	
		}
	}
}

if( $is_live )
{
	wp_enqueue_script( 'animate-number');
	wp_enqueue_script( 'easing');
	wp_enqueue_script( 'isotope');
	wp_enqueue_script( 'carousel');
	wp_enqueue_script( 'file-input');
	wp_enqueue_script( 'forest-megamenu');
	wp_enqueue_script( 'select-2' );
	wp_enqueue_script( 'hover');
	wp_enqueue_script( 'modernizr');
	wp_enqueue_script( 'icheck');
	wp_enqueue_script( 'jquery-appear');
	wp_enqueue_script( 'jquery-countTo');
	wp_enqueue_script( 'jquery-inview');
	wp_enqueue_script( 'nouislider-all');
	wp_enqueue_script( 'slide');
	wp_enqueue_script( 'theia-sticky-sidebar');
	if( isset( $adforest_theme['sb_color_plate'] ) && $adforest_theme['sb_color_plate'] )
	{
		wp_enqueue_script( 'color-switcher'); 
	}
	wp_enqueue_script( 'parsley');
	wp_enqueue_script( 'dropzone');
	wp_enqueue_script( 'tagsinput');
	wp_enqueue_script( 'form-dropzone');
	wp_enqueue_script( 'jquery-te');
	wp_enqueue_script( 'perfect-scrollbar');
	wp_enqueue_script( 'bootstrap-confirmation');
	wp_enqueue_script( 'hello');
	wp_enqueue_script( 'recaptcha');	
	wp_enqueue_script( 'g-spider');
	wp_enqueue_script( 'moment');
	wp_enqueue_script( 'moment-timezone-with-data');
	wp_enqueue_script( 'adforest-timer');


	if( is_singular( 'ad_post' ) )
	{
		wp_enqueue_script( 'fancybox');
		wp_enqueue_script( 'google-map');
		wp_enqueue_script( 'jquery-ui-all');
		wp_enqueue_script( 'adforest-jquery-touch-punch');
	}
	
	if( isset( $adforest_theme['sb_video_icon'] ) && $adforest_theme['sb_video_icon'] )
	{
		wp_enqueue_script( 'popup-video-iframe');
	}
	wp_enqueue_script( 'coundown-timer');
	wp_enqueue_script( 'adforest-custom');
	if( is_singular( 'ad_post' ) )
	{
		
	}
}
else
{
	wp_enqueue_script( 'coundown-timer');
	wp_enqueue_script( 'adforest-custom-coming-soon');
}
/* Load the stylesheets. */
wp_enqueue_style( 'adforest-style', get_stylesheet_uri() );
wp_enqueue_style( 'bootstrap', trailingslashit( get_template_directory_uri () )  . 'css/bootstrap.css' );

wp_enqueue_style( 'et-line-fonts', trailingslashit( get_template_directory_uri () )  . 'css/et-line-fonts.css' );
wp_enqueue_style( 'font-awesome', trailingslashit( get_template_directory_uri () )  . 'css/font-awesome.css' );
wp_enqueue_style( 'animate', trailingslashit( get_template_directory_uri () )  . 'css/animate.min.css' );
wp_enqueue_style( 'file-input', trailingslashit( get_template_directory_uri () )  . 'css/fileinput.css' );
wp_enqueue_style( 'flaticon', trailingslashit( get_template_directory_uri () )  . 'css/flaticon.css' );
wp_enqueue_style( 'adforest-select2', trailingslashit( get_template_directory_uri () )  . 'css/select2.min.css' );
wp_enqueue_style( 'nouislider', trailingslashit( get_template_directory_uri () )  . 'css/nouislider.min.css' );
wp_enqueue_style( 'owl-carousel', trailingslashit( get_template_directory_uri () )  . 'css/owl.carousel.css' );
wp_enqueue_style( 'owl-theme', trailingslashit( get_template_directory_uri () )  . 'css/owl.theme.css' );

wp_enqueue_style( 'toastr', trailingslashit( get_template_directory_uri () )  . 'css/toastr.min.css' );
wp_enqueue_style( 'minimal', trailingslashit( get_template_directory_uri () )  . 'skins/minimal/minimal.css' );
wp_enqueue_style( 'bootstrap-social', trailingslashit( get_template_directory_uri () )  . 'css/bootstrap-social.css' );
if( is_singular( 'ad_post' ) )
{
	wp_enqueue_style( 'fancybox', trailingslashit( get_template_directory_uri () )  . 'css/jquery.fancybox.min.css' );
}
if( isset( $adforest_theme['sb_video_icon'] ) && $adforest_theme['sb_video_icon'] )
{
	wp_enqueue_style( 'popup-video-iframe', trailingslashit( get_template_directory_uri () )  . 'css/YouTubePopUp.css' );
}

if ( is_rtl() ) 
{
	if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
	{
		wp_enqueue_style( 'adforest-theme', trailingslashit( get_template_directory_uri () )  . 'css/modern-rtl.css' );
		wp_enqueue_style( 'responsive-media-modern', trailingslashit( get_template_directory_uri () )  . 'css/responsive-media-modern-rtl.css' );
		wp_enqueue_style( 'adforest-custom-modern', trailingslashit( get_template_directory_uri () )  . 'css/custom-modern.css' );

	}
	else
	{
		wp_enqueue_style( 'adforest-theme', trailingslashit( get_template_directory_uri () )  . 'css/style-rtl.css' );
		wp_enqueue_style( 'responsive-media', trailingslashit( get_template_directory_uri () )  . 'css/responsive-media.css' );
		wp_enqueue_style( 'adforest-custom', trailingslashit( get_template_directory_uri () )  . 'css/custom.css' );
	}
	wp_enqueue_style( 'adforest-woo', trailingslashit( get_template_directory_uri () )  . 'css/woocommerce-rtl.css' );
	wp_enqueue_style( 'bootstrap-rtl', trailingslashit( get_template_directory_uri () )  . 'css/bootstrap-rtl.css' );
	wp_enqueue_style( 'forest-menu', trailingslashit( get_template_directory_uri () )  . 'css/forest-menu-rtl.css' );
	wp_enqueue_style( 'slider', trailingslashit( get_template_directory_uri () )  . 'css/rtl-single-slider.css' );
}
else
{
	if( isset( $adforest_theme['design_type'] ) && $adforest_theme['design_type'] == 'modern' )
	{
		wp_enqueue_style( 'adforest-theme-modern', trailingslashit( get_template_directory_uri () )  . 'css/modern.css' );
		wp_enqueue_style( 'responsive-media-modern', trailingslashit( get_template_directory_uri () )  . 'css/responsive-media-modern.css' );
		wp_enqueue_style( 'adforest-custom-modern', trailingslashit( get_template_directory_uri () )  . 'css/custom-modern.css' );
	
	}
	else
	{
		wp_enqueue_style( 'adforest-theme', trailingslashit( get_template_directory_uri () )  . 'css/style.css' );
		wp_enqueue_style( 'responsive-media', trailingslashit( get_template_directory_uri () )  . 'css/responsive-media.css' );
		wp_enqueue_style( 'adforest-custom', trailingslashit( get_template_directory_uri () )  . 'css/custom.css' );
	}
	wp_enqueue_style( 'adforest-woo', trailingslashit( get_template_directory_uri () )  . 'css/woocommerce.css' );
	wp_enqueue_style( 'forest-menu', trailingslashit( get_template_directory_uri () )  . 'css/forest-menu.css' );
	wp_enqueue_style( 'slider', trailingslashit( get_template_directory_uri () )  . 'css/slider.css' );
}
/*New Css For Shop*/
wp_enqueue_style( 'shop-theme', trailingslashit( get_template_directory_uri () )  . 'css/theme.css' );

$css_color	=	'defualt';
if( isset( $adforest_theme['theme_color']) && $adforest_theme['theme_color'] != "" )
{
	$css_color	=	$adforest_theme['theme_color'];
}
wp_enqueue_style( 'defualt-color', trailingslashit( get_template_directory_uri () )  . 'css/colors/' .$css_color.  '.css', array(), null  );

}

add_action( 'admin_enqueue_scripts', 'adforest_load_admin_js' );
function adforest_load_admin_js()
{
	wp_register_script( 'adforest-admin', trailingslashit( get_template_directory_uri () ) . 'js/admin.js', false, false, true );
	wp_enqueue_script( 'adforest-admin');
}

function adforest_set_ad_featured_img($single_template) {
     global $post;

     if ($post->post_type == 'ad_post')
	 {
		$media	=	 adforest_get_ad_images($post->ID);	
		$img_ids	=	'';
		if( is_array( $media ) &&  count( $media ) > 0 )
		{
		foreach( $media as $m )
		{
			$mid	=	'';
			if ( isset( $m->ID ) )
				$mid	= 	$m->ID;
			else
				$mid	=	$m;
				
				if( $mid != get_post_thumbnail_id( $post->ID ) )
				{
					set_post_thumbnail( $post->ID, $mid );
					break;
				}
				
			}
		}
     }
     return $single_template;
}
add_filter( 'single_template', 'adforest_set_ad_featured_img' );

function adforest_custom_styles()
{
	global $adforest_theme;
	if( ( basename( get_page_template() ) == 'page-home.php' || is_singular( 'ad_post' ) ) &&  isset( $adforest_theme['sb_menu_color'] ) )
	{
		$color = is_singular( 'ad_post' ) ? $adforest_theme['sb_menu_color_single'] : $adforest_theme['sb_menu_color'];
		wp_enqueue_style(
			'acustom-modern',
			get_template_directory_uri() . '/css/custom-modern.css'
		);
			//$color = $adforest_theme['sb_menu_color'];
			$custom_css = "
					.mega-menu .menu-links > li > a {
							color: {$color};
					}";
		wp_add_inline_style( 'acustom-modern', $custom_css );
	}
}
add_action( 'wp_enqueue_scripts', 'adforest_custom_styles', 99 );		