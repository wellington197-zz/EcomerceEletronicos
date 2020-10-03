<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); 
$containerType = get_theme_mod( 'allo_woo_container_dispay', 'container' );
if( $containerType == 'container' ) {
    $containerClass = 'container';
    $colmainClass = 'col-md-9';
    $colsideClass = 'col-md-3';
} else {
    $containerClass = 'container-fluid';
    $colmainClass = 'col-md-10';
    $colsideClass = 'col-md-2';
}

$sidebarType = get_theme_mod( 'allo_woo_sidebar_dispay','no_side' );
if($sidebarType == 'left_side') {
    $sidebarClass = $colsideClass .' col-md-pull-9';
    $wrapperClass = $colmainClass .' col-md-push-3';
} elseif ($sidebarType == 'no_side') {
    $sidebarClass = '';
    $wrapperClass = 'col-md-12';
} else {
    $sidebarClass = $colsideClass;
    $wrapperClass = $colmainClass;
} ?>

<!-- Page Header
================================================== -->
<?php allo_page_header( esc_html( get_the_title() ) ); ?>

<!-- Our Menu Block
================================================== -->
<section class="product-page-one section">
    <div class="<?php echo esc_attr( $containerClass); ?>">
        <div class="row product-filters">
            <div class="col-lg-11 col-md-10 col-sm-10 col-xs-12">
                <div class="show-product">
                    <?php do_action( 'woocommerce_before_shop_loop' ); ?>
                </div>
            </div>

            <div class="col-lg-1 col-md-2 col-sm-2 col-xs-12">
                <div class="product-filter text-right">
                    <ul class="filter-con">
                        <li><a href="#" id="grid"><span class="glyphicon glyphicon-th"></span></a></li>
                        <li><a href="#" id="list"><span class="glyphicon glyphicon-th-list"></span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row" id="products"> 
            <div class="<?php echo esc_attr($wrapperClass); ?> ">
                <?php if ( have_posts() ) { ?>
                <?php 
                    woocommerce_product_loop_start();

                    woocommerce_product_loop_end();
                    /**
                     * Hook: woocommerce_after_shop_loop.
                     *
                     * @hooked woocommerce_pagination - 10
                     */
                    do_action( 'woocommerce_after_shop_loop' );
                ?>
                <?php 
                    $postShowInRow = get_option( 'woocommerce_catalog_rows', 4);
                    if($postShowInRow !== "") { ?>
                        <div class="item-<?php echo esc_attr($postShowInRow); ?> row">
                    <?php } else { ?>
                        <div class="item-3 row">
                    <?php } ?> 
					<?php 
						if ( have_posts() ) :
						    while ( have_posts() ) : the_post(); 
                                get_template_part('woocommerce/template-parts/content-product');
						    endwhile;  						     
						endif; 
					?> 
                </div><!--  /.row -->
                
                <div class="menu-pagination-block">
                    <div class="row">
                        <div class="col-lg-12 text-left"> 
                            <?php allo_posts_pagination_nav(); ?>
                        </div><!--  /.col-lg-6 -->
                    </div><!--  /.row -->
                </div><!--  /.menu-pagination-block -->
                <?php } else { 
                    get_template_part( 'template-parts/post/content', 'none' );
                } ?>
            </div>
            <?php if($sidebarType !== 'no_side'): ?>
            <div class="<?php echo esc_attr($sidebarClass); ?> shop-sidbar-area">
                <?php get_sidebar('shop'); ?>
            </div><!--  /.col-lg-3 -->
            <?php endif ?>
        </div><!--  /.row -->
    </div><!--  /.container -->
</section><!--  /.our-menu-block -->
<?php get_footer(); ?>