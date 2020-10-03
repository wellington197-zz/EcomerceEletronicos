<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Allo
 */
if(isset($only_item_class) && $only_item_class == true){
    $col_class = '';
} else {
    if(get_option( 'woocommerce_catalog_columns', 4)) {    
        $postShowInRow = get_option( 'woocommerce_catalog_columns', 4);
        $moveonInteger = intval(str_replace(" ", "",$postShowInRow));
        $newCol = ( 12 / $moveonInteger);

        $col_class = 'col-md-'.$newCol;
    } else {
        $col_class = 'col-md-4';
    }
} ?> 
<div class="item <?php echo esc_attr($col_class); ?> grid-group-item">
    <div class="single-product post hentry">
        <?php if ( has_post_thumbnail() ) { ?>                             
        <figure>
            <div class="menu-thumbnail"> 
                <?php if ( function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
                    echo wp_kses_post( woocommerce_get_product_thumbnail() ); 
                } ?>
            </div>
            <?php
                global $product;
                if( $product->is_on_sale() ) {
                    $badge_class = 'color2';
                } else {
                    $badge_class = 'color1';
                }
            ?>
            <span class="product-position <?php echo esc_attr($badge_class); ?>">
            <?php 
                if( $product->is_on_sale() ) {
                    if (is_numeric( $product->get_regular_price() )) {
                        echo wp_kses_post( '-'.round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 ).'%');
                    }
                } else {
                    $postdate       = get_the_time( 'Y-m-d' );          // Post date
                    $postdatestamp  = strtotime( $postdate );           // Timestamped post date
                    $newness        = get_theme_mod('allo_woo_new_product_base_day', 15);
                    if ( ( time() - ( 60 * 60 * 24 * $newness ) ) < $postdatestamp ) {
                        esc_html_e( 'New', 'allo' );
                    }
                }
            ?>
            </span> 
            <ul class="list-none">
                <li><a rel="nofollow" href="#" data-quantity="1" data-product_id="<?php echo esc_attr( get_the_ID() ); ?>" data-product_sku="" class="add-cart order-btn button product_type_simple add_to_cart_button ajax_add_to_cart"><i class="fa fa-shopping-cart"></i></a></li>
                <li class="view-item"><a href="<?php echo esc_url(allo_get_image_crop_size_by_id(get_the_ID(), 1200, 550, false)); ?>"><i class="fa fa-eye"></i></a></li>
            </ul>
        </figure>
        <?php } ?>

        <div class="product-content">
            <h4 class="product-title" title="<?php the_title_attribute(); ?>"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <h5>
                <?php 
                $product_cats = get_the_terms( get_the_ID(), 'product_cat' );
                if(!empty($product_cats)) { ?>
                <a href="<?php echo esc_url(get_term_link($product_cats[0]->slug, 'product_cat')); ?>" rel="category tag"><?php echo esc_html($product_cats[0]->name); ?></a>
                <?php } ?> 
            </h5>
            <span class="price"><?php allo_product_price(); ?></span>
            <?php  the_excerpt(); ?>
        </div>
    </div>
</div>
 