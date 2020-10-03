<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Allo
 * @since 1.0
 */

if( get_theme_mod( 'allo_blog_per_row' ) ) {
    $postShowInRow = get_theme_mod( 'allo_blog_per_row','3' );
    $moveonInteger = intval(str_replace(" ", "",$postShowInRow));
    $newCol = ( 12 / $moveonInteger);
    $col_class = 'col-md-'.$newCol;
} else {
    $col_class = 'col-md-4';
}

$blog_url = (isset($_GET["blog_style"])) ? sanitize_text_field( wp_unslash( $_GET["blog_style"] ) ) : '';
$blogStyle = get_theme_mod('allo_blog_style','style_one');

if($blog_url) {
    $blogStyle = $blog_url;
}
$post_type = get_post_type( get_the_ID() );
if($post_type != 'product') { 
    if($blogStyle == 'style_two') { ?>
        <div class="item <?php echo esc_attr($col_class); ?>">
            <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                <div class="single-blog mr-b30 text-center post-list-item">
                    <figure>
                        <?php if ( has_post_thumbnail() ) { ?>
                            <?php allo_post_featured_image(499, 315, true); ?>
                        <div class="blog-con">
                        <?php } else { ?> 
                        <div class="blog-con without-post-thumb">
                        <?php } ?>
                            <div class="bg-pos">
                                <h2 class="entry-title" title="<?php the_title_attribute(); ?>"><a href="<?php echo esc_url( get_permalink() )?>"><?php echo wp_kses_post(allo_custom_post_excerpt( esc_html(get_the_title()), 30, '&hellip;')); ?></a></h2>
                                <ul class="list-inline blog-meta-field">
                                    <?php if( get_the_post_thumbnail() == "" && get_the_title() == ""): ?>
                                    <li class="entry-date no-title"><a href="<?php the_permalink(); ?>"><?php the_date( get_option( 'date_format' ) ); ?></a></li>
                                    <?php else: ?>
                                    <li class="entry-date"><?php the_date( 'Y-m-d' ); ?></li>
                                    <?php endif; ?> 
                                    <li><i class="fa fa-comment-o"></i><span><?php echo wp_kses_post(get_comments_number()); ?></span></li>
                                    <li><i class="fa fa-eye"></i><span><?php echo wp_kses_post(allo_get_post_views( get_the_ID() )); ?></span></li>
                                </ul>
                            </div>
                        </div>
                    </figure>
                </div>
            </article><!--  /.post -->
        </div>  
    <?php } else { ?>
        <div class="item <?php echo esc_attr($col_class); ?>">
            <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
                <div class="single-blog post-list-item">
                    <?php if ( has_post_thumbnail() ) { ?>
                    <figure>
                        <?php allo_post_featured_image(499, 315, true); ?>
                        <div class="date">
                            <span><?php echo get_the_date('M'); ?></span>
                            <span><?php echo get_the_date('d'); ?></span>
                        </div>
                    </figure>
                    <?php } ?> 
                    <?php if( get_the_post_thumbnail() == "" && get_the_title() == ""): ?>
                    <h5 class="entry-date no-title"><a href="<?php the_permalink(); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></h5>
                    <?php else: ?>
                    <?php the_title( sprintf( '<h2 class="entry-title" title="'. the_title_attribute() .'"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                    <?php endif; ?>
                </div>
                <div class="article-content">
                    <?php  the_excerpt(); ?>
                </div><!--  /.article-content -->
            </article><!--  /.post -->
        </div><!--  /.col-md-6 -->
    <?php } 
} else { global $product; ?>
<div class="item <?php echo esc_attr($col_class); ?>">
    <div class="product-page-one search-result">
        <div class="item <?php echo esc_attr($col_class); ?>">
            <div class="single-product post hentry">
                <figure>
                    <?php if ( has_post_thumbnail() ) { ?>                             
                    <figure class="menu-thumbnail"> 
                        <?php allo_post_featured_image(365, 477); ?>  
                    </figure>
                    <?php } ?>
                    <?php
                        if( $product->is_on_sale() ) {
                            $badge_class = 'color2';
                        } else {
                            $badge_class = 'color1';
                        }
                    ?>
                    <span class="product-position <?php echo esc_attr($badge_class); ?>">
                    <?php 
                        if( $product->is_on_sale() ) {
                            echo wp_kses_post('-'.round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 ).'%');
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
                </div>
            </div>
        </div>
    </div><!--  /.product-page-one -->
</div>
<?php } ?>