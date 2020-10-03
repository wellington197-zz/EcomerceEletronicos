<div class="panel panel-default">
          <!-- Heading -->
          <div class="panel-heading" role="tab" id="headingOne">
             <!-- Title -->
             <h4 class="panel-title">
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <i class="more-less glyphicon glyphicon-plus"></i>
                <?php echo esc_html( $instance['title'] ); ?>
                </a>
             </h4>
             <!-- Title End -->
          </div>
          <?php 
		  	if( isset( $instance['open_widget'] ) && $instance['open_widget']== '1' )
			{
				$expand	=	'in';	
			}
		  ?>
          <!-- Content -->
<form method="get" id="search_cats_w" action="<?php echo get_the_permalink( $adforest_theme['sb_search_page'] ); ?>">
          <div id="collapseOne" class="panel-collapse collapse <?php echo esc_attr( $expand ); ?>" role="tabpanel" aria-labelledby="headingOne">
          
          <?php
		  $ad_cats	=	adforest_get_cats('ad_cats' , 0 );
		  if( count( $ad_cats ) > 0 )
		  {
		  ?>
             <div class="panel-body categories">
             	<?php 
				if( isset( $_GET['cat_id'] ) && $_GET['cat_id'] != "" )
				{
					$selected_cats	=	adforest_get_taxonomy_parents( $_GET['cat_id'], 'ad_cats', false);
					$find = '&raquo;';
					$replace = '';
					$selected_cats = preg_replace("/$find/",$replace,$selected_cats,1);
					echo adforest_returnEcho($selected_cats);
					//echo adforest_get_taxonomy_parents( $_GET['cat_id'], 'ad_cats', false);
				}
				?>
                <ul>
                <?php
					foreach( $ad_cats as $ad_cat )
					{
						$category = get_term($ad_cat->term_id);
						$count = $category->count;
						$cat_meta	=	 get_option( "taxonomy_term_$ad_cat->term_id" );
						$icon	=	 $cat_meta['ad_cat_icon'];
				?>
                   <li> 
                   	<a href="javascript:void(0);" data-cat-id="<?php echo esc_attr( $ad_cat->term_id ); ?>">
                    <i class="<?php echo esc_attr( $icon ); ?>"></i>
					<?php echo esc_html( $ad_cat->name ); ?> 
                    <span>(<?php echo esc_html( $count ); ?>)</span>
                    </a>
                   </li>
                <?php
					}
				?>
                </ul>	
             </div>
          <?php
		  }
		  ?>
          </div>
    <input type="hidden" name="cat_id" id="cat_id" value="" />
    <?php echo adforest_search_params( 'cat_id' ); ?>
  </form>
       </div>