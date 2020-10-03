<?php 
/**
 *  Allo Page Header
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_page_header' ) ) :
function allo_page_header( $title = '') { ?>
    <section class="page-header-content breadcumb-area af jarallax">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <div class="breadcumb-content">
                        <div class="breadcumb-title">
                            <?php if ( is_archive() ) {
                                allo_archive_title( '<h1 class="section-title">', '</h1>' ); ?>
                                <?php if(!is_front_page()) { ?>
                                    <?php if(function_exists('allo_breadcums_function')): 
                                        echo wp_kses_post( allo_breadcums_function() );
                                    endif; ?>
                                <?php } ?>
                            <?php } elseif ( is_search() ) { ?>
                                <h1 class="section-title"><?php printf( '<span>'.esc_html__( 'Search Results for: ', 'allo' ).'</span>%s', get_search_query() ); ?></h1>
                                <?php if(!is_front_page()) { ?>
                                    <?php if(function_exists('allo_breadcums_function')): 
                                        echo wp_kses_post( allo_breadcums_function() );
                                    endif; ?>
                                <?php } ?>
                            <?php } else { ?>   
                                <h1 class="section-title"><?php echo esc_html($title); ?></h1>
                                <?php if(!is_front_page()) { ?>
                                    <?php if(function_exists('allo_breadcums_function')):
                                        echo wp_kses_post( allo_breadcums_function() );
                                    endif; ?>
                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php }
endif;

/**
 *  Allo Get Pages ID
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_page_id_by_tem_name' ) ) {
    function allo_page_id_by_tem_name( $template_name = null ) {
        $template_page_id = null;
        $template_array = get_pages( array (
            'meta_key'   => '_wp_page_template',
            'meta_value' => $template_name
        ) );
        if ( $template_array ) {
            $template_page_id = $template_array[0]->ID;
        }
        return $template_page_id;
    }
}
/**
 * Allo Author Name
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_author_name' ) ) :
    function allo_author_name() {
        global $current_user;
        $name = get_user_meta( get_current_user_id(), 'first_name', true )." ".get_user_meta( get_current_user_id(), 'last_name', true ); 
        if (get_user_meta( get_current_user_id(), 'first_name', true )) {
            echo esc_html($name);  
        } else {
            echo esc_html($current_user->display_name);
        }
    }
endif;

/**
 * Allo Template Part Functions
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_get_template_part' ) ) :
    function allo_get_template_part($part_name = "") {
        $part_style_url = (isset($_GET["{$part_name}_style"])) ? sanitize_text_field( wp_unslash( $_GET["{$part_name}_style"] ) ) : '';

        $part_style = ($part_name == 'header') ? get_theme_mod('allo_header_variation') : ''; 

        if($part_style_url) {
            $part_style = $part_style_url;
        }

        switch($part_style) { 
            case 'one': 
            case 'two': 
            case 'three': 
            case 'four': 
                $part_style = $part_style; break;
            default: $part_style = "one"; break;
        }  
        return get_template_part( "template-parts/$part_name/$part_style" );
    }
endif;

/**
 * Allo Get Social Link
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_social_link' ) ) :
    function allo_social_link($social_link = "", $li_tag = false) { 
        if ( $social_link != "" ) {
            if($li_tag != false ) echo '<li class="social-icon">';
            foreach ( $social_link as $value ) { 
                if ($value['icon']['type'] == "icon-font") { ?>
                    <a target="_blank" href="<?php echo esc_url($value['url']); ?>"><i class="<?php echo esc_attr($value['icon']['icon-class']);?>"></i></a>
                    <?php
                } else { ?>
                    <a target="_blank" href="<?php echo esc_url($value['url']); ?>"><img src="<?php  echo esc_url($value['icon']['url']); ?>" alt="<?php esc_attr_e('img icon','allo' ); ?>" /></a>
                <?php } 
            }
            if($li_tag != false ) echo '</li>';
        } 
    }
endif;

/**
 * Allo Excerpt Length
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_excerpt_length' ) ) :
function allo_excerpt_length($limit) {
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}
endif;

/**
 *  Allo String To Excerpt
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_string_to_excerpt' ) ) :
function allo_string_to_excerpt($text = "", $limit = null) {
    $excerpt = explode(' ', $text, $limit);
    if (count($excerpt)>=$limit) {
        array_pop($excerpt);
        $excerpt = implode(" ",$excerpt).'...';
    } else {
        $excerpt = implode(" ",$excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    return $excerpt;
}
endif;

/**
 * /**
 * Include Conditional Tags, 
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_custom_post_excerpt' ) ) :
function allo_custom_post_excerpt($string, $length, $dots = "&hellip;") {
    return (strlen($string) > $length) ? substr($string, 0, $length - strlen($dots)) . $dots : $string;
}
endif;

/**
 *  Allo Custom Post Excerpt With Words
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_custom_string_limit_words' ) ) :
function allo_custom_string_limit_words($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));
    if(count($words) > $word_limit)
    array_pop($words);
    return implode(' ', $words);
}
endif;

/**
 *  Allo Custom Search
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_custom_product_search' ) ) :
    function allo_custom_product_search() { ?>
        <?php if ( class_exists('WooCommerce') ) : ?>
        <form role="search" method="get" class="woocommerce-product-search searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
            <div class="search-box af">
                <div class="input-group">
                    <div class="input-group-btn search-panel">
                        <?php if( isset( $_REQUEST['product_cat'] ) && !empty( $_REQUEST['product_cat'] )) {
                            $optsetlect = sanitize_text_field( wp_unslash( $_REQUEST['product_cat'] ) );
                        } else { $optsetlect = 0;  }
                            $args = array(
                                'show_option_all' => esc_html__( 'All', 'allo' ),
                                'hierarchical' => 1,
                                'class' => 'cat',
                                'echo' => 1,
                                'value_field' => 'slug',
                                'selected' => $optsetlect
                            );
                            $args['taxonomy'] = 'product_cat';
                            $args['name'] = 'product_cat';              
                            $args['class'] = 'cate-dropdown hidden-xs';
                            wp_dropdown_categories( $args );
                        ?>
                    </div>

                    <input type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field form-control" placeholder="<?php echo esc_attr__( 'Search here&hellip;', 'allo' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />     
                    <input type="hidden" name="post_type" value="product" />
                    <span class="input-group-btn">
                        <button class="btn btn-default search-btn" type="submit"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </div>
        </form>
        <?php endif; ?>
    <?php }
endif;