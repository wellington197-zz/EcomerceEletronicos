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
 * @version     3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header(); ?>

<!-- Page Header
================================================== -->
<?php allo_page_header( esc_html__('Product Detail','allo') ); ?>

<?php 
$shop_single_url = (isset($_GET["shop_single"])) ? sanitize_text_field( wp_unslash( $_GET["shop_single"] ) ) : '';

$shop_single_page_style = get_theme_mod('allo_woo_single_dispay', 'style_one');

if($shop_single_url) { $shop_single_page_style = $shop_single_url; }

//Start Shop Single
if($shop_single_page_style == "style_three") { ?>
<section class="product-single section">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-10 col-md-10 col-sm-12 col-xs-12 floatright">
            	<?php
            		/**
            		 * woocommerce_before_single_product hook.
            		 *
            		 * @hooked wc_print_notices - 10
            		 */
            		do_action( 'woocommerce_before_single_product' );
            		if ( post_password_required() ) {
            		 	echo wp_kses_post( get_the_password_form() );
            		 	return;
            		}
            	?>
            	<?php while ( have_posts() ) : the_post();  ?>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="product-photo">
                        	<?php $attachment_ids = $product->get_gallery_image_ids(); ?>
                            <div class="preview-pic tab-content">
                            	<?php if ( $attachment_ids && has_post_thumbnail() ) {
                    			$i = 1;
                    			foreach ( $attachment_ids as $attachment_id ) { 
                    				if($i == 1) { $active = 'active'; } else { $active = ''; }
                    			?>
                    			<div class="tab-pane <?php echo esc_attr($active); ?>" id="pic-<?php echo esc_attr($i); ?>"><img src="<?php echo esc_url(allo_get_image_crop_size($attachment_id, 470, 470)); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></div>
                        		<?php $i++; }
                        		} elseif( has_post_thumbnail() ) { ?>
									<div class="tab-pane active"><img src="<?php echo esc_url(allo_get_image_crop_size(get_post_thumbnail_id( get_the_ID() ), 470, 470)); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></div>
                        		<?php  } ?> 
                            </div>

                            <ul class="preview-thumbnail nav nav-tabs mr-l5">
								<?php 
									if ( $attachment_ids && has_post_thumbnail() ) {
										$i = 1;
										foreach ( $attachment_ids as $attachment_id ) { 
										if($i == 1) { $active = 'active'; } else { $active = ''; }
										?>
										<li class="<?php echo esc_attr($active); ?>">
											<a data-target="#pic-<?php echo esc_attr($i); ?>" data-toggle="tab"><img src="<?php echo esc_url(allo_get_image_crop_size($attachment_id, 98, 88)); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></a>
										</li> 
										<?php $i++; }
									} elseif( has_post_thumbnail() ) { ?>
										<li class="active">
										    <a href="#pic-1"><?php allo_post_featured_image(98, 88, true); ?></a>
										</li> 
										<?php  
									} 
								?>
                            </ul>       
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                        <div class="product-con">
                            <?php
                            	/**
                            	 * woocommerce_single_product_summary hook.
                            	 *
                            	 * @hooked woocommerce_template_single_title - 5
                            	 * @hooked woocommerce_template_single_rating - 10
                            	 * @hooked woocommerce_template_single_price - 10
                            	 * @hooked woocommerce_template_single_excerpt - 20
                            	 * @hooked woocommerce_template_single_add_to_cart - 30
                            	 * @hooked woocommerce_template_single_meta - 40
                            	 * @hooked woocommerce_template_single_sharing - 50
                            	 * @hooked WC_Structured_Data::generate_product_data() - 60
                            	 */

                            	do_action( 'woocommerce_single_product_summary' );
                            ?> 
                        </div>
                    </div>
                </div>

                <!--Product Description area start here-->
                <div class="row product-description section">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <?php
                        	/**
                        	 * woocommerce_after_single_product_summary hook.
                        	 *
                        	 * @hooked woocommerce_output_product_data_tabs - 10
                        	 * @hooked woocommerce_upsell_display - 15
                        	 * @hooked woocommerce_output_related_products - 20
                        	 */
                        	do_action( 'woocommerce_after_single_product_summary' );
                        ?> 
                    </div>
                </div>

                <?php endwhile; // end of the loop. ?>

                <!--Product Description area end here-->

                <!--New product area start here-->
                <?php 
                	$relatedDisplay = get_theme_mod('allo_woo_related_dispay','on');
                	if($relatedDisplay == 'on') { ?>
		                <div class="new-product-three">
		                    <div class="row mr-b20">
		                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		                            <div class="product-heading">
		                               <h2><?php esc_html_e('You May Also Like','allo'); ?></h2> 
		                            </div>
		                        </div>

		                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		                            <div class="controls pull-right">
		                                <a class="left fa fa-chevron-left btn" href="#new-product" data-slide="prev"></a>
		                                <a class="right fa fa-chevron-right btn" href="#new-product" data-slide="next"></a>
		                            </div>
		                        </div>
		                    </div>

		                    <div class="row">
		                        <div id="new-product" class="carousel slide" data-ride="carousel">
		                            <!-- Wrapper for slides -->
		                            <div class="carousel-inner">
		    	                	<?php   
		    	                	$query_type = get_theme_mod('allo_woo_related_query', 'category');
		    	                	$related_no = get_theme_mod('allo_woo_related_post_no', 8); 
		    	                	if ( $query_type == 'author' ) {
		    	                	    $args = array(
		    	                	    	'post_type' => 'product',
		    	                	    	'post__not_in' => array(get_the_ID()),
		    	                	    	'posts_per_page'=> $related_no,  
		    	                	    	'author'=> get_the_author_meta( 'ID' )
		    	                	    );
		    	                	} elseif ( $query_type == 'tag' ) {
		    	                	    $tags = get_the_terms( get_the_ID(), 'product_tag' );
		    	                	    $tags_ids = array();
		    	                	    foreach($tags as $tag) $tags_ids[] = $tag->term_id;
		    	                	    $args = array(
		    	                	    	'post_type' => 'product',
		    	                	    	'post__not_in' => array(get_the_ID()),
		    	                	    	'posts_per_page'=> $related_no,  
		    	                	    	'tax_query' => array(
		    	                	    	    array (
		    	                	    	        'taxonomy' => 'product_tag',
		    	                	    	        'field' => 'id',
		    	                	    	        'terms' => $tags_ids,
		    	                	    	    )
		    	                	    	), 
		    	                	    );
		    	                	} elseif ( $query_type == 'best_saller' ) { 
		    	                	    $args = array(
		    	                	        'post_type' => 'product', 
		    	                	        'meta_key' => 'total_sales',
		    	                	        'orderby' => 'meta_value_num',
		    	                	        'post__not_in' => array(get_the_ID()), 
		    	                	        'posts_per_page' => $related_no,   
		    	                	    );
		    	                	} else {
		    	                	    $cats = get_the_terms( get_the_ID(), 'product_cat' );
		    	                	    $cats_ids = array();
		    	                	    foreach($cats as $cat) $cats_ids[] = $cat->term_id;
		    	                	    $args = array(
		    	                	    	'post_type' => 'product',
		    	                	    	'post__not_in' => array(get_the_ID()),
		    	                	    	'posts_per_page'=> $related_no,  
		    	                	    	'tax_query' => array(
		    	                	    	    array (
		    	                	    	        'taxonomy' => 'product_cat',
		    	                	    	        'field' => 'id',
		    	                	    	        'terms' => $cats_ids,
		    	                	    	    )
		    	                	    	), 
		    	                	    );
		    	                	}         
		    	                	$posts = get_posts( $args ); 
		    	                	$i = 0; ?>
		    						<?php foreach (array_chunk($posts, 4, true) as $posts) :  ?>
		    							<?php if($i == 0) { $active = 'active'; } else { $active = ''; } ?>
		    						    <div class="item  <?php echo esc_attr($active); ?>">
		    						        <?php foreach( $posts as $post ) : setup_postdata($post); ?>
		    						            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								            		<div class="single-product">
								            		    <?php if ( has_post_thumbnail() ) { ?>
								            		    <figure>
								            		        <figure class="menu-thumbnail"> 
								            		            <?php if ( function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
								            		                echo wp_kses_post( woocommerce_get_product_thumbnail() ); 
								            		            } ?>
								            		        </figure>
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
								            		                if (is_numeric( $product->get_regular_price() )) {
								            		                    echo wp_kses_post( '-'.round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 ).'%' );
								            		                }
								            		            } else {
								            		                esc_html_e( 'New', 'allo' );
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
								            		        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
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
		    						        <?php endforeach; ?>
		    						    </div>
		    						<?php endforeach; ?>
		    						<?php wp_reset_postdata(); ?>
		                            </div>
		                        </div>
		                    </div>
		                </div>
                	<?php } 
                ?>
                <!--New product area end here-->
            </div>

            <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12">
                <div class="sidbar-area">
                	<?php
                		/**
                		 * woocommerce_sidebar hook.
                		 *
                		 * @hooked woocommerce_get_sidebar - 10
                		 */
                		do_action( 'woocommerce_sidebar' );
                	?>
                    <?php get_sidebar('shop'); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php } elseif($shop_single_page_style == "style_two") { ?>
<section class="product-single section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-10 col-sm-12 col-xs-12 floatright">
            	<?php
            		/**
            		 * woocommerce_before_single_product hook.
            		 *
            		 * @hooked wc_print_notices - 10
            		 */
            		do_action( 'woocommerce_before_single_product' );
            		if ( post_password_required() ) {
            		 	echo wp_kses_post( get_the_password_form() );
            		 	return;
            		}
            	?>
            	<?php while ( have_posts() ) : the_post();  ?>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 col-md-push-4">
                        <div class="product-photo">
                        	<?php $attachment_ids = $product->get_gallery_image_ids(); ?>
                            <div class="preview-pic tab-content">
                            	<?php if ( $attachment_ids && has_post_thumbnail() ) {
                    			$i = 1;
                    			foreach ( $attachment_ids as $attachment_id ) { 
                    				if($i == 1) { $active = 'active'; } else { $active = ''; }
                    			?>
                    			<div class="tab-pane <?php echo esc_attr($active); ?>" id="pic-<?php echo esc_attr($i); ?>"><img src="<?php echo esc_url(allo_get_image_crop_size($attachment_id, 470, 470)); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></div>
                        		<?php $i++; }
                        		} elseif( has_post_thumbnail() ) { ?>
									<div class="tab-pane active"><img src="<?php echo esc_url(allo_get_image_crop_size(get_post_thumbnail_id( get_the_ID() ), 470, 470)); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></div>
                        		<?php  } ?> 
                            </div>

                            <ul class="preview-thumbnail nav nav-tabs mr-l5">
								<?php 
									if ( $attachment_ids && has_post_thumbnail() ) {
										$i = 1;
										foreach ( $attachment_ids as $attachment_id ) { 
										if($i == 1) { $active = 'active'; } else { $active = ''; }
										?>
										<li class="<?php echo esc_attr($active); ?>">
											<a data-target="#pic-<?php echo esc_attr($i); ?>" data-toggle="tab"><img src="<?php echo esc_url(allo_get_image_crop_size($attachment_id, 98, 88)); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></a>
										</li> 
										<?php $i++; }
									} elseif( has_post_thumbnail() ) { ?>
										<li class="active">
										    <a href="#pic-1"><?php allo_post_featured_image(98, 88, true); ?></a>
										</li> 
										<?php  
									} 
								?>
                            </ul>       
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-md-pull-8">

                        <div class="product-con">
                            <?php
                            	/**
                            	 * woocommerce_single_product_summary hook.
                            	 *
                            	 * @hooked woocommerce_template_single_title - 5
                            	 * @hooked woocommerce_template_single_rating - 10
                            	 * @hooked woocommerce_template_single_price - 10
                            	 * @hooked woocommerce_template_single_excerpt - 20
                            	 * @hooked woocommerce_template_single_add_to_cart - 30
                            	 * @hooked woocommerce_template_single_meta - 40
                            	 * @hooked woocommerce_template_single_sharing - 50
                            	 * @hooked WC_Structured_Data::generate_product_data() - 60
                            	 */

                            	do_action( 'woocommerce_single_product_summary' );
                            ?> 
                        </div>
                    </div>
                </div>

                <!--Product Description area start here-->
                <div class="row product-description section">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <?php
                        	/**
                        	 * woocommerce_after_single_product_summary hook.
                        	 *
                        	 * @hooked woocommerce_output_product_data_tabs - 10
                        	 * @hooked woocommerce_upsell_display - 15
                        	 * @hooked woocommerce_output_related_products - 20
                        	 */
                        	do_action( 'woocommerce_after_single_product_summary' );
                        ?> 
                    </div>
                </div>

                <?php endwhile; // end of the loop. ?>

                <!--Product Description area end here-->

                <!--New product area start here-->
                <?php 
                	$relatedDisplay = get_theme_mod('allo_woo_related_dispay','on');
                	if($relatedDisplay == 'on') { ?>
		                <div class="new-product-three">
		                    <div class="row mr-b20">
		                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		                            <div class="product-heading">
		                               <h2><?php esc_html_e('You May Also Like','allo'); ?></h2> 
		                            </div>
		                        </div>

		                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		                            <div class="controls pull-right">
		                                <a class="left fa fa-chevron-left btn" href="#new-product" data-slide="prev"></a>
		                                <a class="right fa fa-chevron-right btn" href="#new-product" data-slide="next"></a>
		                            </div>
		                        </div>
		                    </div>

		                    <div class="row">
		                        <div id="new-product" class="carousel slide" data-ride="carousel">
		                            <!-- Wrapper for slides -->
		                            <div class="carousel-inner">
		    	                	<?php   
		    	                	$query_type = get_theme_mod('allo_woo_related_query', 'category');
		    	                	$related_no = get_theme_mod('allo_woo_related_post_no', 8); 
		    	                	if ( $query_type == 'author' ) {
		    	                	    $args = array(
		    	                	    	'post_type' => 'product',
		    	                	    	'post__not_in' => array(get_the_ID()),
		    	                	    	'posts_per_page'=> $related_no,  
		    	                	    	'author'=> get_the_author_meta( 'ID' )
		    	                	    );
		    	                	} elseif ( $query_type == 'tag' ) {
		    	                	    $tags = get_the_terms( get_the_ID(), 'product_tag' );
		    	                	    $tags_ids = array();
		    	                	    foreach($tags as $tag) $tags_ids[] = $tag->term_id;
		    	                	    $args = array(
		    	                	    	'post_type' => 'product',
		    	                	    	'post__not_in' => array(get_the_ID()),
		    	                	    	'posts_per_page'=> $related_no,  
		    	                	    	'tax_query' => array(
		    	                	    	    array (
		    	                	    	        'taxonomy' => 'product_tag',
		    	                	    	        'field' => 'id',
		    	                	    	        'terms' => $tags_ids,
		    	                	    	    )
		    	                	    	), 
		    	                	    );
		    	                	} elseif ( $query_type == 'best_saller' ) { 
		    	                	    $args = array(
		    	                	        'post_type' => 'product', 
		    	                	        'meta_key' => 'total_sales',
		    	                	        'orderby' => 'meta_value_num',
		    	                	        'post__not_in' => array(get_the_ID()), 
		    	                	        'posts_per_page' => $related_no,   
		    	                	    );
		    	                	} else {
		    	                	    $cats = get_the_terms( get_the_ID(), 'product_cat' );
		    	                	    $cats_ids = array();
		    	                	    foreach($cats as $cat) $cats_ids[] = $cat->term_id;
		    	                	    $args = array(
		    	                	    	'post_type' => 'product',
		    	                	    	'post__not_in' => array(get_the_ID()),
		    	                	    	'posts_per_page'=> $related_no,  
		    	                	    	'tax_query' => array(
		    	                	    	    array (
		    	                	    	        'taxonomy' => 'product_cat',
		    	                	    	        'field' => 'id',
		    	                	    	        'terms' => $cats_ids,
		    	                	    	    )
		    	                	    	), 
		    	                	    );
		    	                	}         
		    	                	$posts = get_posts( $args ); 
		    	                	$i = 0; ?>
		    						<?php foreach (array_chunk($posts, 4, true) as $posts) :  ?>
		    							<?php if($i == 0) { $active = 'active'; } else { $active = ''; } ?>
		    						    <div class="item  <?php echo esc_attr($active); ?>">
		    						        <?php foreach( $posts as $post ) : setup_postdata($post); ?>
		    						            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								            		<div class="single-product">
								            		    <?php if ( has_post_thumbnail() ) { ?>
								            		    <figure>
								            		        <figure class="menu-thumbnail"> 
								            		            <?php if ( function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
								            		                echo wp_kses_post( woocommerce_get_product_thumbnail() ); 
								            		            } ?>
								            		        </figure>
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
								            		                if (is_numeric( $product->get_regular_price() )) {
								            		                    echo wp_kses_post('-'.round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 ).'%');
								            		                }
								            		            } else {
								            		                esc_html_e( 'New', 'allo' );
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
								            		        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
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
		    						        <?php endforeach; ?>
		    						    </div>
		    						<?php endforeach; ?>
		                            </div>
		                        </div>
		                    </div>
		                </div>
                	<?php } 
                ?>
                <!--New product area end here-->
            </div>
        </div>
    </div>
</section>
<?php } else { ?>
<section class="product-single section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-10 col-sm-12 col-xs-12 floatright">
            	<?php
            		/**
            		 * woocommerce_before_single_product hook.
            		 *
            		 * @hooked wc_print_notices - 10
            		 */
            		do_action( 'woocommerce_before_single_product' );
            		if ( post_password_required() ) {
            		 	echo wp_kses_post( get_the_password_form() );
            		 	return;
            		}
            	?>
            	<?php while ( have_posts() ) : the_post();  ?>
                <div class="row">
                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="product-photo">
                        	<?php $attachment_ids = $product->get_gallery_image_ids(); ?>
                        	<ul class="preview-thumbnail nav nav-tabs mr-r5">
								<?php 
									if ( $attachment_ids && has_post_thumbnail() ) {
										$i = 1;
										foreach ( $attachment_ids as $attachment_id ) { 
										if($i == 1) { $active = 'active'; } else { $active = ''; }
										?>
										<li class="<?php echo esc_attr($active); ?>">
											<a data-target="#pic-<?php echo esc_attr($i); ?>" data-toggle="tab"><img src="<?php echo esc_url(allo_get_image_crop_size($attachment_id, 98, 88)); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></a>
										</li> 
										<?php $i++; }
									} elseif( has_post_thumbnail() ) { ?>
										<li class="active">
										    <a href="#pic-1"><?php allo_post_featured_image(98, 88, true); ?></a>
										</li> 
										<?php  
									} 
								?>
                            </ul> 
                            <div class="preview-pic tab-content">
                            	<?php if ( $attachment_ids && has_post_thumbnail() ) {
                    			$i = 1;
                    			foreach ( $attachment_ids as $attachment_id ) { 
                    				if($i == 1) { $active = 'active'; } else { $active = ''; }
                    			?>
                    			<div class="tab-pane <?php echo esc_attr($active); ?>" id="pic-<?php echo esc_attr($i); ?>"><img src="<?php echo esc_url(allo_get_image_crop_size($attachment_id, 470, 470)); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></div>
                        		<?php $i++; }
                        		} elseif( has_post_thumbnail() ) { ?>
									<div class="tab-pane active"><img src="<?php echo esc_url(allo_get_image_crop_size(get_post_thumbnail_id( get_the_ID() ), 470, 470)); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>" /></div>
                        		<?php  } ?> 
                            </div>      
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">

                        <div class="product-con">
                            <?php
                            	/**
                            	 * woocommerce_single_product_summary hook.
                            	 *
                            	 * @hooked woocommerce_template_single_title - 5
                            	 * @hooked woocommerce_template_single_rating - 10
                            	 * @hooked woocommerce_template_single_price - 10
                            	 * @hooked woocommerce_template_single_excerpt - 20
                            	 * @hooked woocommerce_template_single_add_to_cart - 30
                            	 * @hooked woocommerce_template_single_meta - 40
                            	 * @hooked woocommerce_template_single_sharing - 50
                            	 * @hooked WC_Structured_Data::generate_product_data() - 60
                            	 */

                            	do_action( 'woocommerce_single_product_summary' );
                            ?> 
                        </div>
                    </div>
                </div>

                <!--Product Description area start here-->
                <div class="row product-description section">
                    <div class="col-lg-12 col-md-12 col-xs-12">
                        <?php
                        	/**
                        	 * woocommerce_after_single_product_summary hook.
                        	 *
                        	 * @hooked woocommerce_output_product_data_tabs - 10
                        	 * @hooked woocommerce_upsell_display - 15
                        	 * @hooked woocommerce_output_related_products - 20
                        	 */
                        	do_action( 'woocommerce_after_single_product_summary' );
                        ?> 
                    </div>
                </div>

                <?php endwhile; // end of the loop. ?>

                <!--Product Description area end here-->

                <!--New product area start here-->
                <?php 
                	$relatedDisplay = get_theme_mod('allo_woo_related_dispay','off');
                	if($relatedDisplay == 'on') { ?>
		                <div class="new-product-three">
		                    <div class="row mr-b20">
		                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
		                            <div class="product-heading">
		                               <h2><?php esc_html_e('You May Also Like','allo'); ?></h2> 
		                            </div>
		                        </div>

		                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
		                            <div class="controls pull-right">
		                                <a class="left fa fa-chevron-left btn" href="#new-product" data-slide="prev"></a>
		                                <a class="right fa fa-chevron-right btn" href="#new-product" data-slide="next"></a>
		                            </div>
		                        </div>
		                    </div>

		                    <div class="row">
		                        <div id="new-product" class="carousel slide" data-ride="carousel">
		                            <!-- Wrapper for slides -->
		                            <div class="carousel-inner">
		    	                	<?php   
		    	                	$query_type = get_theme_mod('allo_woo_related_query', 'category');
		    	                	$related_no = get_theme_mod('allo_woo_related_post_no', 8); 
		    	                	if ( $query_type == 'author' ) {
		    	                	    $args = array(
		    	                	    	'post_type' => 'product',
		    	                	    	'post__not_in' => array(get_the_ID()),
		    	                	    	'posts_per_page'=> $related_no,  
		    	                	    	'author'=> get_the_author_meta( 'ID' )
		    	                	    );
		    	                	} elseif ( $query_type == 'tag' ) {
		    	                	    $tags = get_the_terms( get_the_ID(), 'product_tag' );
		    	                	    $tags_ids = array();
		    	                	    foreach($tags as $tag) $tags_ids[] = $tag->term_id;
		    	                	    $args = array(
		    	                	    	'post_type' => 'product',
		    	                	    	'post__not_in' => array(get_the_ID()),
		    	                	    	'posts_per_page'=> $related_no,  
		    	                	    	'tax_query' => array(
		    	                	    	    array (
		    	                	    	        'taxonomy' => 'product_tag',
		    	                	    	        'field' => 'id',
		    	                	    	        'terms' => $tags_ids,
		    	                	    	    )
		    	                	    	), 
		    	                	    );
		    	                	} elseif ( $query_type == 'best_saller' ) { 
		    	                	    $args = array(
		    	                	        'post_type' => 'product', 
		    	                	        'meta_key' => 'total_sales',
		    	                	        'orderby' => 'meta_value_num',
		    	                	        'post__not_in' => array(get_the_ID()), 
		    	                	        'posts_per_page' => $related_no,   
		    	                	    );
		    	                	} else {
		    	                	    $cats = get_the_terms( get_the_ID(), 'product_cat' );
		    	                	    $cats_ids = array();
		    	                	    foreach($cats as $cat) $cats_ids[] = $cat->term_id;
		    	                	    $args = array(
		    	                	    	'post_type' => 'product',
		    	                	    	'post__not_in' => array(get_the_ID()),
		    	                	    	'posts_per_page'=> $related_no,  
		    	                	    	'tax_query' => array(
		    	                	    	    array (
		    	                	    	        'taxonomy' => 'product_cat',
		    	                	    	        'field' => 'id',
		    	                	    	        'terms' => $cats_ids,
		    	                	    	    )
		    	                	    	), 
		    	                	    );
		    	                	}         
		    	                	$posts = get_posts( $args ); 
		    	                	$i = 0; ?>
		    						<?php foreach (array_chunk($posts, 4, true) as $posts) :  ?>
		    							<?php if($i == 0) { $active = 'active'; } else { $active = ''; } ?>
		    						    <div class="item  <?php echo esc_attr($active); ?>">
		    						        <?php foreach( $posts as $post ) : setup_postdata($post); ?>
		    						            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
								            		<div class="single-product">
								            		    <?php if ( has_post_thumbnail() ) { ?>
								            		    <figure>
								            		        <figure class="menu-thumbnail"> 
								            		            <?php if ( function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
								            		                echo wp_kses_post( woocommerce_get_product_thumbnail() ); 
								            		            } ?>
								            		        </figure>
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
								            		                if (is_numeric( $product->get_regular_price() )) {
								            		                    echo wp_kses_post('-'.round( ( ( $product->get_regular_price() - $product->get_sale_price() ) / $product->get_regular_price() ) * 100 ).'%');
								            		                }
								            		            } else {
								            		                esc_html_e( 'New', 'allo' );
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
								            		        <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
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
		    						        <?php endforeach; ?>
		    						    </div>
		    						<?php endforeach; ?>
		                            </div>
		                        </div>
		                    </div>
		                </div>
                	<?php } 
                ?>
                <!--New product area end here-->
            </div>
        </div>
    </div>
</section>
<?php } ?>

<?php get_footer();
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */
