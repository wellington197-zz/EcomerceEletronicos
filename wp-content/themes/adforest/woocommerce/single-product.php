<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
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
 * @version     1.6.4
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
} 

global $adforest_theme;
if(isset($adforest_theme['shop-turn-on']) && $adforest_theme['shop-turn-on'])
{
get_header(); 
while ( have_posts() ) : the_post();

global $product;
?>
<section class="section-padding modern-version description-product"> 
  <div class="container"> 
    <div class="row"> 
      <div class="col-md-8 col-xs-12 col-sm-12">
          <div class="row"> 
              <div class="col-md-5 col-xs-12 col-sm-5">
                <?php get_template_part( 'woocommerce/product-detail/gallery'); ?>
              </div>
              <div class="col-md-7 col-xs-12 col-sm-7">
                <div class="description-right-area">
                  <div class="description-text">
                  <?php if(get_the_title() != '') { ?>
                    <h2><?php echo get_the_title(); ?></h2>
                  <?php } ?>          
                  </div>
                  <?php get_template_part( 'woocommerce/product-detail/total_reviews'); ?>
                  <div class="clearfix"></div>
                   <?php 
                            $currency = get_woocommerce_currency_symbol();
                            $price = get_post_meta( get_the_ID(), '_regular_price', true);
                            $sale = get_post_meta( get_the_ID(), '_sale_price', true);
                   ?>
                   <?php if($price){?>
                  <div class="description-prices"> 
                  	
                  		<?php if($sale){?>
                        <strike><?php echo esc_html( adforest_shopPriceDirection($price, $currency)); ?></strike>
                        <?php }else{?>
                        <?php echo "<span class='description-new-prices'>".esc_html( adforest_shopPriceDirection($price, $currency))."</span>"; ?>
                        <?php } ?>
                      <span class="description-new-prices"><?php if($sale){ echo esc_html(adforest_shopPriceDirection($sale, $currency )); }?>&nbsp;</span> 
                  </div>
                  <?php }?>
                    <div class="clearfix"></div>
                    <?php get_template_part( 'woocommerce/product-detail/product_info'); ?>
                    <?php get_template_part( 'woocommerce/product-detail/desc'); ?>
                 
                  <div class="description-number">
                      <?php              
                            if($product->get_type() == 'external' )
                            {
                                get_template_part( 'woocommerce/product-type/external');
                            }
                            if($product->get_type() == 'grouped' )
                            {
                                do_action( 'woocommerce_before_single_product' );
                                get_template_part( 'woocommerce/product-type/grouped');
                            }
                            if($product->get_type() == 'variable' )
                            {
                                do_action( 'woocommerce_before_single_product' );
                                get_template_part( 'woocommerce/product-type/variable');
                            }
                            if($product->get_type() == 'simple' )
                            {
                                do_action( 'woocommerce_before_single_product' );
                                get_template_part( 'woocommerce/product-type/add_cart_btn');
                            }
                        ?>
                  </div>
                </div>
              </div>
          </div>
          <div class="row">
          <div class="col-md-12">
            <div class="tab-description"> 
              <!-- Nav tabs -->
              <div class="card">
                <ul class="nav nav-tabs" role="tablist">
                  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo esc_html__( 'Description', 'adforest' ); ?></a></li>
                  <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
				  <?php echo esc_html__( 'Reviews', 'adforest' )." (" . $product->get_review_count(false).")"; ?></a></li>
    <?php
    $product	=	 wc_get_product( get_the_ID() );
    $attributes = $product->get_attributes();
    if(is_array($attributes) && count($attributes) > 0 )
    {
    ?>
                  <li role="presentation"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab"><?php echo esc_html__( 'Additional Information', 'adforest' ); ?></a></li>
    <?php
    }
    ?>
                </ul>
                
                <!-- Tab panes -->
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="home"> <?php the_content(); ?></div>
                  <div role="tabpanel" class="tab-pane" id="profile">
                      <div class="comments">
                            <?php comments_template('', true); ?>
                     </div>
                  </div>
                  <div role="tabpanel" class="tab-pane" id="settings"><?php do_action( 'woocommerce_product_additional_information', $product ); ?></div>
                </div>
              </div>
            </div>
          </div>

		<?php if(isset($adforest_theme['shop-related-single-on']) && $adforest_theme['shop-related-single-on']) { ?>
        <?php
        $cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
        if(!empty($cats))
        {
            $countRelated = (isset($adforest_theme['shop-number-of-related-products-single'])) ? $adforest_theme['shop-number-of-related-products-single'] : 4;
            $relatedTitle = (isset($adforest_theme['shop-related-single-title'])) ? $adforest_theme['shop-related-single-title'] : __("Related Products", "adforest");
            $categories	=	array();
            foreach( $cats as $cat )
            {
              $categories[]	=	$cat->term_id;
            }
            $loop_args = array( 
                'post_type' => 'product',
                'posts_per_page' => $countRelated,
                'order'=> 'DESC',
                'post__not_in'	=> array( get_the_ID() ),
                'tax_query' => array(
                 array(
                    'taxonomy' => 'product_cat',
                    'field' => 'id',
                    'terms' => $categories
                )));
                $related_products = new WP_Query( $loop_args );	
                if ( $related_products->have_posts() )	
                {
                    ?>
                          <div class="clearfix"></div>
                        <div class="heading-panel">
                         <div class="col-xs-12 col-md-12 col-sm-12">
                            <h3 class="main-title text-left"><?php echo esc_html($relatedTitle);?></h3>
                         </div>
                        </div>                
                          <div class="related-product-animate1">
                            <?php
                            while( $related_products->have_posts() ) 
                            {
                                $related_products->the_post();
                                $product_id	=	get_the_ID();
								global $product;

        
                                $currency = get_woocommerce_currency_symbol();
                                $price = get_post_meta( get_the_ID(), '_regular_price', true);
                                $sale = get_post_meta( get_the_ID(), '_sale_price', true);
                                
                            ?>                  
                            <div class="col-lg-4">
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
                                                $average_rating = $product->get_average_rating(false);
                                                echo adforest_get_woo_stars( $average_rating ); 
                                        ?>
                                    </li>
                                    <li>
                                    <?php echo " ".$product->get_review_count(false) .' '. __("Review", "adforest");?>
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
                            <?php } ?>
                          </div>
                      
        <?php } wp_reset_postdata(); }}?>          
          
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
<?php
endwhile; // end of the loop.        
get_footer();
}else {
		wp_redirect( get_the_permalink( $adforest_theme['sb_packages_page'] ) );
	exit;
}

