<?php
/**
 *  Allo Featured Image
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_post_featured_image' ) ) :
function allo_post_featured_image($width = 900, $height = 600, $crop = false) {
    if ( wp_is_mobile() ) {
        $featured_image = allo_aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ,'full' ), 400, 300, false );
        if( $featured_image == false ) {
            the_post_thumbnail( 'full', array( 'alt' => esc_attr(get_the_title()) ));
        } else { ?>
        <img src="<?php echo esc_url($featured_image); ?>" alt="<?php esc_attr( get_the_title() ); ?>" />
        <?php }
    } else {
        $featured_image = allo_aq_resize( wp_get_attachment_url( get_post_thumbnail_id() ,'full' ), $width, $height, $crop );
        if( get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true) ) {
            $image_alt = get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
        } else {
            $image_alt = get_the_title();
        }
        $img_meta = wp_prepare_attachment_for_js( get_post_thumbnail_id() );
        
        if($img_meta['title'] !== "") {
            $imgtitle = 'title=" '. $img_meta['title'] .' "';
        } else {
            $imgtitle = '';
        }
        if( $featured_image == false ) {
            the_post_thumbnail( 'full', array( 'alt' => esc_attr( $image_alt ), 'title' => esc_attr( $img_meta['title'] ) ));
        } else { ?>
            <img src="<?php echo esc_url($featured_image); ?>" alt="<?php echo esc_attr( $image_alt ); ?>" <?php echo esc_attr( $imgtitle ); ?> />
        <?php }
    }
}
endif;

/**
 * Allo Get Image Croping Size By Image ID
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_get_image_crop_size' ) ) :
function allo_get_image_crop_size($img_id = false, $width = 900, $height = 600, $crop = false) {
    $url = wp_get_attachment_url( $img_id ,'full' );
    if ( wp_is_mobile() ) {
        $crop_image = allo_aq_resize( $url, 305, 175, false ); 
        if( $crop_image == false ) {
            return $url;
        } else { 
            return $crop_image;
        }
    } else {
        $crop_image = allo_aq_resize( $url, $width, $height, $crop ); 
        if( $crop_image == false ) {
            return $url;
        } else { 
            return $crop_image;
        }
    }
}
endif;

/**
 *  Allo Croping Size by post id
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_get_image_crop_size_by_id' ) ) :
function allo_get_image_crop_size_by_id($post_id = false, $width = 900, $height = 600, $crop = false) {
    $url = get_the_post_thumbnail_url($post_id, 'full');
    if ( wp_is_mobile() ) { 
        $crop_image = allo_aq_resize( $url, 400, 300, false ); 
        if( $crop_image == false ) {
            return $url;
        } else { 
            return $crop_image;
        }
    } else {
        $crop_image = allo_aq_resize( $url, $width, $height, $crop ); 
        if( $crop_image == false ) {
            return $url;
        } else { 
            return $crop_image;
        }
    }
}
endif;
/**
 *  Allo Generate Custom Link
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_theme_kc_custom_link' ) ) :
function allo_theme_kc_custom_link( $link, $default = array( 'url' => '', 'title' => '', 'target' => '' ) ) {
    $result = $default;
    $params_link = explode('|', $link);

    if( !empty($params_link) ){
        $result['url'] = rawurldecode(isset($params_link[0])?$params_link[0]:'#');
        $result['title'] = isset($params_link[1])?$params_link[1]:'';
        $result['target'] = isset($params_link[2])?$params_link[2]:'';
    }

    return $result;
}
endif;
/**
 *  Allo Adding WPML language Var
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_km_wpml_custom_language_var' ) ) :
function allo_km_wpml_custom_language_var() {
    $languages = icl_get_languages('skip_missing=0&orderby=code');
    if(!empty($languages)) { ?> 
        <ul class="language-submeu">
        <?php foreach($languages as $lang) { ?>
            <li class="menu-item menu-item-language">
                <a href="<?php echo esc_attr($lang['url']);?>">
                    <img src="<?php echo esc_attr($lang['country_flag_url']); ?>" alt="<?php echo esc_html($lang['native_name']); ?>" />
                    <?php echo esc_html($lang['native_name']); ?>
                </a>
            </li>;
        <?php } ?>
        </ul>
    <?php }
}
endif;

/**
 * Allo Return Post Author
 *
 * @package Allo
 * @since 1.0
 */
if( ! function_exists( 'allo_post_autor' ) ) {
  function allo_post_autor(){
    $author = '';
    $author .= get_the_author();
    return $author; 
  }
}

/**
 * Allo Static Counter
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_theme_counter_inside_function' ) ) :
function allo_theme_counter_inside_function() {
    static $counter = 0;
    ++$counter;
    return $counter;
}
endif;