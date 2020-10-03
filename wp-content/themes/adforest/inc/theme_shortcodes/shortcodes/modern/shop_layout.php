<?php
/* ------------------------------------------------ */
/* Pricing Modern */
/* ------------------------------------------------ */

if (!function_exists('shop_layout_data_shortcode')) {
function shop_layout_data_shortcode( $term_type = 'ad_country' ) {
 $terms = get_terms( $term_type, array( 'hide_empty' => false, ) );
 $result = array();
 if( count($terms) > 0 )
 {	
 	foreach ( $terms as $term ) 
	{ 
		$result[] = array
			( 
				'value' => $term->slug, 
				'label' => $term->name, 
			); 
	}
 }
 	return $result;
}
}



if ( !function_exists ( 'shop_layout_modern_short' ) ) {
function shop_layout_modern_short()
{
	vc_map(array(
		"name" => __("Shop Layout - Modern", 'adforest') ,
		"base" => "shop_layout_modern_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('shop-screenshot.png') . __( 'Ouput of the shortcode will be look like this.', 'adforest' ),
		  ),	
		array(
			"group" => __("Basic", "adforest"),
			"type" => "dropdown",
			"heading" => __("Background Color", 'adforest') ,
			"param_name" => "section_bg",
			"admin_label" => true,
			"value" => array(
				__('Select Background Color', 'adforest') => '',
				__('White', 'adforest') => '',
				__('Gray', 'adforest') => 'gray',
				__('Image', 'adforest') => 'img'
			) ,
			'edit_field_class' => 'vc_col-sm-12 vc_column',
			"std" => '',
			"description" => __("Select background color.", 'adforest'),
		),
		
		array(
			"group" => __("Basic", "adforest"),
			"type" => "attach_image",
			"holder" => "bg_img",
			"class" => "",
			"heading" => __( "Background Image", 'adforest' ),
			"param_name" => "bg_img",
			'dependency' => array(
			'element' => 'section_bg',
			'value' => array('img'),
			) ,
		),
		
			array(
				"group" => __("Basic", "adforest"),
				"type" => "dropdown",
				"heading" => __("Header Style", 'adforest') ,
				"param_name" => "header_style",
				"admin_label" => true,
				"value" => array(
				__('Section Header Style', 'adforest') => '',
				__('No Header', 'adforest') => '',
				__('Classic', 'adforest') => 'classic',
				__('Regular', 'adforest') => 'regular'
				) ,
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				"std" => '',
				"description" => __("Chose header style.", 'adforest'),
			),
			array(
				"group" => __("Basic", "adforest"),
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Section Title", 'adforest' ),
				"param_name" => "section_title",
				"description" =>  __('For color ', 'adforest') . '<strong>' . esc_html('{color}') . '</strong>' . __('warp text within this tag', 'adforest') . '<strong>' . esc_html('{/color}') . '</strong>',
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'dependency' => array(
					'element' => 'header_style',
					'value' => array('classic'),
				),
			),	
			array(
				"group" => __("Basic", "adforest"),
				"type" => "textfield",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Section Title", 'adforest' ),
				"param_name" => "section_title_regular",
				"value" => "",
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'dependency' => array(
				'element' => 'header_style',
				'value' => array('regular'),
				) ,
			),	
			array(
				"group" => __("Basic", "adforest"),
				"type" => "textarea",
				"holder" => "div",
				"class" => "",
				"heading" => __( "Section Description", 'adforest' ),
				"param_name" => "section_description",
				"value" => "",
				'edit_field_class' => 'vc_col-sm-12 vc_column',
				'dependency' => array(
				'element' => 'header_style',
				'value' => array('classic'),
				) ,
			),
			
		
			array(
				"group" => __("Products Setting", "adforest"),
				"type" => "dropdown",
				"heading" => __("Select Number of Product", 'adforest') ,
				"param_name" => "max_limit",
				"value" => range(1, 100),
			),
						
			array(
				"group" => __("Products Setting", "adforest"),
				"type" => "dropdown",
				"heading" => __("Column", 'adforest') ,
				"param_name" => "p_cols",
				"value" => array(
				__('Select Col ', 'adforest') => '',
				__('3 Col', 'adforest') => '4',
				__('4 Col', 'adforest') => '3',
				__('6 Col', 'adforest') => '2'
				) ,
			),
			
			array(
				"group" => __("Products Setting", "adforest"),
				"type" => "vc_link",
				"heading" => __( "View All Link", 'adforest' ),
				"param_name" => "main_link",
				"description" => __("Read more Link if any.", "adforest"),
			),			
			
		array(
			'group' => __( 'Products', 'adforest' ),
			"type" => "dropdown",
			"heading" => __("Select Products", 'adforest') ,
			"param_name" => "all_products",
			"value" => array(
			__('Select Option', 'adforest') => '',
			__('All Categories', 'adforest') => 'all',
			__('Selective Categories', 'adforest') => 'selective',
			) ,
		),			
		array
		(
			'dependency' => array(
				'element' => 'all_products',
				'value' => array('selective'),
			),		
			'group' => __( 'Products', 'adforest' ),
			'type' => 'param_group',
			'heading' => __( 'Select Category', 'adforest' ),
			'param_name' => 'woo_products',
			'value' => '',
			'params' => array
			(					
				array(
					"type" => "dropdown",
					"heading" => __("Select Product Categories", 'adforest') ,
					"param_name" => "product",
					"admin_label" => true,
					"value" => shop_layout_data_shortcode('product_cat'),
					"description" => __("Remove All categories to show products from all categories.", "adforest"),
					
				),

			)
		),
								
		),
	));
}
}

add_action('vc_before_init', 'shop_layout_modern_short');
if ( !function_exists ( 'shop_layout_modern_short_base_func' ) ) {
function shop_layout_modern_short_base_func($atts, $content = '')
{
require trailingslashit( get_template_directory () ) . "inc/theme_shortcodes/shortcodes/layouts/header_layout.php";
	
	$html	=	'';
	
	$rows = vc_param_group_parse_atts( $woo_products );
	$categories_html	=	'';
	
	$product_cats = array();


	$max_limit = (isset($max_limit) ) ? $max_limit : 4;
	
	if( $all_products == "selective" )
	{
		
		if( count( $rows ) > 0 )
		{
			foreach($rows as $row )
			{
				if( isset( $row['product'] ) )
				{
						$product_cats[]	=	$row['product'];	
				}
			}
		}
		$loop_args = array( 
		'post_type' => 'product',
		'posts_per_page' => $max_limit,
		'order'=> 'DESC',
		'tax_query' => array(				
				array(
					'taxonomy' => 'product_cat',
					'field' => 'slug',
					'terms' => $product_cats
				)				
			)
		);		
		
	}
	else
	{
		$loop_args = array( 
		'post_type' => 'product',
		'posts_per_page' => $max_limit,
		'order'=> 'DESC',
		);		
	
	}
	

	$product_loop = new WP_Query( $loop_args );	
	if ( $product_loop->have_posts() )	
	{	
		while( $product_loop->have_posts() ) 
		{
			$product_loop->the_post();
			$product_id	=	get_the_ID();
			global $product;
			$currency = get_woocommerce_currency_symbol();
			$price = get_post_meta( $product_id, '_regular_price', true);
			$sale = get_post_meta( $product_id, '_sale_price', true);
			
			$sale_html = ($sale) ? '<div class="on-sale"><span>'.__("Sale", "adforest").'</span></div>' : "";
			
			$shop_thumb = '<a href="'.esc_url(get_the_permalink($product_id)).'"><img class="img-responsive" alt="'.get_the_title($product_id).'" src="'.esc_url( wc_placeholder_img_src() ).'"></a>';
			
			if( get_the_post_thumbnail($product_id)){ 
			$shop_thumb = '<a href="'.esc_url(get_the_permalink($product_id)).'">'.get_the_post_thumbnail(get_the_ID(), 'adforest-shop-home').'</a>';
			}
		 
		 $average_rating = $product->get_average_rating(false);
		
		$sale_price = ($sale) ?  '<p>'.esc_html(adforest_shopPriceDirection($sale, $currency )).'&nbsp;</p>' : '';
		
		$regular_price  = ($price) ? '<strike>'.esc_html( adforest_shopPriceDirection($price, $currency)).'</strike>' : '';
									
		$html .= '<div class="col-sm-6 col-lg-'.esc_attr( $p_cols ).' col-md-'.esc_attr( $p_cols ).'">
			<div class="product-description-about">
			  <div class="shop-box">
			   '.$sale_html.$shop_thumb.'
				<div class="shop-overlay-box">
				  <div class="shop-icon">
					<a href="'.esc_url(get_the_permalink($product_id)).'" title="'.get_the_title($product_id).'">'.__("Add to Cart", "adforest").'</a>
				  </div>
				</div>
			  </div>
			  <div class="product-description">
				<div class="product-category">'.adforest_get_woo_categories( $product_id ).'</div>
				<div class="product-description-heading">
				  <h3><a href="'.get_the_permalink($product_id).'" title="'.get_the_title($product_id).'">'.get_the_title($product_id).'</a></h3>
				</div>
				<div class="product-description-icons">
				<ul class="on-product-custom-stars">
					<li>'.adforest_get_woo_stars( $average_rating ).'</li>
					<li>'.$product->get_review_count(false) .' '. __("Review", "adforest").'</li>
			   </ul>                    
					</div>
				<div class="product-description-text"> 
					'.$sale_price.$regular_price.'
				</div>
				
			  </div>
			</div>
		  </div>';
		}
	}
	wp_reset_postdata(); 	

	
	
	$parallex	=	'';
	if( $section_bg == 'img' )
	{
		$parallex	=	'parallex';
	}
	
	return '<section class="custom-padding '.$parallex.' '.$bg_color.'" ' . $style .'>
            <div class="container">
               <div class="row">
			   '.$header.'
                  <div class="col-md-12 col-xs-12 col-sm-12">
                     <div class="row style-3">
					 '.$html.'
                     </div>
					 <div class="text-center">
					 '.adforest_ThemeBtn($main_link, "btn btn-theme text-center", false).'
					 </div>
                  </div>
               </div>
            </div>
         </section>';
	
}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('shop_layout_modern_short_base', 'shop_layout_modern_short_base_func');
}