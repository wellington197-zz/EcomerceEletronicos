<?php
/* ------------------------------------------------ */
/* Search Simple */
/* ------------------------------------------------ */
if ( !function_exists ( 'search_hero4_short' ) ) {
function search_hero4_short()
{
	vc_map(array(
		"name" => __("Search - Hero 4", 'adforest') ,
		"base" => "search_hero4_short_base",
		"category" => __("Theme Shortcodes", 'adforest') ,
		"params" => array(
		array(
		   'group' => __( 'Shortcode Output', 'adforest' ),  
		   'type' => 'custom_markup',
		   'heading' => __( 'Shortcode Output', 'adforest' ),
		   'param_name' => 'order_field_key',
		   'description' => adforest_VCImage('hero4.png').__( 'Ouput of the shortcode will be look like this.', 'adforest' ),
		  ),	
		array(
			"group" => __("Basic", "adforest"),
			"type" => "attach_image",
			"holder" => "bg_img",
			"class" => "",
			"heading" => __( "Background Image", 'adforest' ),
			"param_name" => "bg_img",
			"description" => __("1920x750", 'adforest'),
		),
		array(
			"group" => __("Basic", "adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Section Title", 'adforest' ),
			"description" => __( "%count% for total ads.", 'adforest' ),
			"param_name" => "section_title",
		),	
		array(
			"group" => __("Basic", "adforest"),
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __( "Main Title", 'adforest' ),
			"param_name" => "sub_title",
		),	
		
		array(
			"group" => __("Location type", "adforest"),
			"type" => "dropdown",
			"heading" => __("Location type", 'adforest') ,
			"param_name" => "location_type",
			"admin_label" => true,
			"value" => array(
			__('Google', 'adforest') => 'g_locations',
			__('Custom Location', 'adforest') => 'custom_locations',
			) ,
			'edit_field_class' => 'vc_col-sm-12 vc_column',
		),

		
		array
		(
			'group' => __( 'Categories', 'adforest' ),
			'type' => 'param_group',
			'heading' => __( 'Select Category ( All or Selective )', 'adforest' ),
			'param_name' => 'cats',
			'value' => '',
			'params' => array
			(
				array(
					"type" => "dropdown",
					"heading" => __("Category", 'adforest') ,
					"param_name" => "cat",
					"admin_label" => true,
					"value" => adforest_cats(),
				),

			)
		),
		
		array
		(
			'group' => __( 'Custom Loctions', 'adforest' ),
			'type' => 'param_group',
			'heading' => __( 'Location', 'adforest' ),
			'param_name' => 'locations',
			'value' => '',
			'params' => array
			(
				array(
					"type" => "dropdown",
					"heading" => __("Location", 'adforest') ,
					"param_name" => "location",
					"admin_label" => true,
					"value" => adforest_cats( 'ad_country' , 'no' ),
				),

			)
		),
		
		),
	));
}
}

add_action('vc_before_init', 'search_hero4_short');
if ( !function_exists ( 'search_hero4_short_base_func' ) ) {
function search_hero4_short_base_func($atts, $content = '')
{
	extract(shortcode_atts(array(
		'bg_img' => '',
		'section_title' => '',
		'sub_title' => '',
		'location_type' => '',
		'cats' => '',
		'locations' => '',
		
	) , $atts));
	global $adforest_theme;

		$rows = vc_param_group_parse_atts( $atts['cats'] );
		$cats	=	false;
		$cats_html	=	'';
		if( count( $rows ) > 0 )
		{
			$cats_html .= '';
			foreach($rows as $row )
			{
				if( isset( $row['cat'] )  )
				{
					if($row['cat'] == 'all' )
					{
						$cats = true;
						$cats_html = '';
						break;
					}
					$term = get_term( $row['cat'], 'ad_cats' );
					$cats_html .= '<option value="'.$row['cat'].'">'.$term->name.'</option>';
				}
			}
			
			if( $cats )
			{
				$ad_cats = get_terms( 'ad_cats', array( 'hide_empty' => 0 ) );
				foreach( $ad_cats as $cat )
				{
					$cats_html .= '<option value="'.$cat->term_id.'">'.$cat->name.'</option>';
				}
			}
		}
		
		// For custom locations
		$locations_html	=	'';
		if( isset( $atts['locations'] ) )
		{
		$rows = vc_param_group_parse_atts( $atts['locations'] );
		if( count( (array)$rows ) > 0 )
		{
			$cats_html .= '';
			foreach($rows as $row )
			{
				if( isset( $row['location'] )  )
				{
					$term = get_term( $row['location'], 'ad_country' );
					$locations_html .= '<option value="'.$row['location'].'">'.$term->name.'</option>';
				}
			}
		}
		}



$style = '';
if( $bg_img != "" )
{
$bgImageURL	=	adforest_returnImgSrc( $bg_img );


$style = ( $bgImageURL != "" ) ? ' style="background: url('.$bgImageURL.'); height: 750px;background-repeat: no-repeat;background-position: center;width: 100%;position: relative;padding: 230px 0;"' : "";




}
$location_type_html	=	'';
if( $location_type == 'custom_locations' )
{
	$location_type_html = '<select class="category form-control" name="country_id" data-placeholder="'.__('Location','adforest').'">
               <option label="'.__('Select Location','adforest').'" value="">'.__('Select Location','adforest').'</option>
			   '.$locations_html.'
			   </select>';
}
else
{
	adforest_load_search_countries();
	wp_enqueue_script( 'google-map-callback');
	wp_enqueue_script( 'typeahead');
	$location_type_html = '<input class="form-control" name="location" id="sb_user_address" placeholder="'.__('Location...','adforest').'"  type="text">';
}
$count_posts = wp_count_posts('ad_post');
$main_title = str_replace( '%count%', '<b>' .  $count_posts->publish . '</b>', $section_title);



return '<section class="background-section" '.$style.'>
  <div class="container">
  <form action="'.get_the_permalink($adforest_theme['sb_search_page']).'">
    <div class="col-lg-12 col-xs-12 col-md-12">
      <div class="list-description-text">
        <p>'.$main_title.'</p>
        <h3>'.$sub_title.'</h3>
      </div>
      <div class="col-lg-12 col-lg-offset-1 col-xs-12 col-md-12 col-md-offset-1 col-sm-12">
        <div class="col-lg-3 col-xs-12 col-md-3 col-sm-4">
          <div class="row">
            <div class="new-main-container">
              <div class="serach-bar">
                <div class="form-group">
                  <input class="form-control" autocomplete="off" name="ad_title" placeholder="'.__('What Are You Looking For...','adforest').'" type="text"> 
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-12 col-md-3 col-sm-3">
          <div class="row">
            <div class="new-select-categories">
              <select class="category form-control" name="cat_id" data-placeholder="'.__('Category','adforest').'">
               <option label="'.__('Select Category','adforest').'" value="">'.__('Select Category','adforest').'</option>
               '.$cats_html.'
            </select>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-xs-12 col-md-3 col-sm-3">
          <div class="row">
            <div class="new-select-categories">
             '.$location_type_html.'
            </div>
          </div>
        </div>
        <div class="col-lg-2 col-xs-12 col-md-2 col-sm-2">
          <div class="new-featured-list-2">
            <button class="btn btn-primary" type="submit">'.__('Search','adforest').'</button>
          </div>
        </div>
      </div>
    </div>
	</form>
  </div>
</section>';



}
}

if (function_exists('adforest_add_code'))
{
	adforest_add_code('search_hero4_short_base', 'search_hero4_short_base_func');
}