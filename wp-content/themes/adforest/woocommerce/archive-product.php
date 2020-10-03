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
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */
if ( ! defined( 'ABSPATH' ) ) { exit; }

global $adforest_theme;
if(isset($adforest_theme['shop-turn-on']) && $adforest_theme['shop-turn-on'])
{
get_header(); 
?>
<div class="main-content-area clearfix"> 
  <section class="section-padding modern-version"> 
    <div class="container"> 
 
      <div class="row"> 
        <div class="col-md-8 col-xs-12 col-sm-12"> 
        	<div class="row-class">
         
		<?php  if( have_posts() ) { ?>
        		<div class="row">
                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <?php do_action( 'woocommerce_before_shop_loop' ); ?>
                    </div>
                </div>
                
        <?php
				echo '<div class="row clear-custom">';
				  while ( have_posts() )
				  {
					the_post();
					$product_id	=	get_the_ID();
					$product_type	=	wc_get_product( $product_id);
					
					$currency = get_woocommerce_currency_symbol();
					$price = get_post_meta( get_the_ID(), '_regular_price', true);
					$sale = get_post_meta( get_the_ID(), '_sale_price', true);
					
					?>
                    <div class="col-lg-4 col-md-4 col-xs-6 col-sm-12">
                    <div class="product-description-about">
                      <div class="shop-box">
                      	<?php if($sale){?>
                      	<div class="on-sale"><span><?php echo __("Sale", "adforest");?></span></div>
                        <?php } ?>
                      	<?php if( get_the_post_thumbnail(get_the_ID())){ ?>
                        	<a href="<?php echo esc_url(get_the_permalink());?>"><?php  echo get_the_post_thumbnail(get_the_ID(), 'adforest-shop-thumbnail'); ?></a>
                        <?php }else{ ?>
                        <a href="<?php echo esc_url(get_the_permalink());?>"><img class="img-responsive" alt="<?php echo get_the_title();?>" src="<?php echo esc_url( wc_placeholder_img_src() ); ?>"></a>
                        <?php } ?>
                        <div class="shop-overlay-box">
                          <div class="shop-icon">
                          	<a href="<?php echo esc_url(get_the_permalink());?>" title="<?php echo get_the_title();?>"> <?php echo __("Add to Cart", "adforest");?> </a>
                          </div>
                        </div>
                      </div>
                      <div class="product-description">
                      	<div class="product-category"><?php echo  adforest_get_woo_categories( get_the_ID() );?></div>
                        <div class="product-description-heading">
                          <h3><a href="<?php echo get_the_permalink();?>" title="<?php echo get_the_title();?>"><?php echo get_the_title();?></a></h3>
                        </div>
                        <div class="product-description-icons">
                        
                        <ul class="on-product-custom-stars">
                            <li>
                            	<?php 
										$average_rating = $product_type->get_average_rating(false);
										echo adforest_get_woo_stars( $average_rating ); 
								?>
                            </li>
                            <li>
                            <?php echo " ".$product_type->get_review_count(false) .' '. __("Review", "adforest");?>
                            </li>
                       </ul>                    
                            </div>
                        <div class="product-description-text"> 
                          <?php if($sale){ ?> <p><?php echo esc_html(adforest_shopPriceDirection($sale, $currency )); ?>&nbsp;</p><?php } ?>
                        	<?php if($price){?>
                            	<?php if($sale){ ?>
                        		<strike><?php echo esc_html( adforest_shopPriceDirection($price, $currency)); ?></strike>
                                <?php }else{ ?>
                                <?php echo "<p>".esc_html( adforest_shopPriceDirection($price, $currency))."</p>"; ?>
                                <?php } ?>
                            <?php }?>
                        </div>
                      </div>
                    </div>
                  </div>
                    <?php
				  }
				  echo '<div class="clearfix"></div>';
				  adforest_pagination();	
				}
				else
				{
					echo __('No Product Found', 'adforest');	
				}
				echo '</div>';
        ?>
       
        </div>
        </div>
        <div class="col-md-4 col-xs-12 col-sm-12"> 
          <div class="sidebar">
			<?php if ( is_active_sidebar( 'adforest_woocommerce_widget' ) ) : ?>
            	<?php dynamic_sidebar( 'adforest_woocommerce_widget' ); ?>
            <?php endif; ?>                   
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
<?php get_footer(); 
}else
{
	wp_redirect( get_the_permalink( $adforest_theme['sb_packages_page'] ) );
	exit;
}