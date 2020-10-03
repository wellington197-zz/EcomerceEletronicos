<?php
global $adforest_theme;
?>

<div class="colors-combination-c1">
  <div class="colored-header"> 
    <!-- Top Bar --> 
    
    <!-- Top Bar End --> 
    <!-- Navigation Menu -->
    <?php
		$pg_class	=	'header-position';
		
		if( basename( get_page_template() ) == 'page-home.php' || is_singular( 'ad_post' ) )
		{
			$pg_class	=	'';
		}
	?>
    <div class="top-header top-header-h1 <?php echo esc_attr( $pg_class ) ; ?>">
      <nav id="menu-1" class="mega-menu menu-2"> 
        <!-- menu list items container -->
        <section class="menu-list-items menu-list-items-h2">
          <div class="container-fluaid">
            <div class="row">
              <div class="col-lg-12 col-md-12"> 
                <!-- menu logo -->
                <ul class="menu-logo">
                  <li> <?php get_template_part( 'template-parts/layouts/site','logo' ); ?></li>
                </ul>
                <!-- menu links -->
                
                <?php get_template_part( 'template-parts/layouts/main','nav' ); ?>
                <div class="header-social-h2">
                  <ul class="list-inline">
			  <?php
				  $user_id	=	get_current_user_id();
					if( is_user_logged_in() )
					{
					global $wpdb;
					$unread_msgs = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->commentmeta WHERE comment_id = '$user_id' AND meta_value = '0' " );
						$user_info	=	get_userdata( $user_id );
						if( isset( $adforest_theme['communication_mode'] ) && ( $adforest_theme['communication_mode'] == 'both' || $adforest_theme['communication_mode'] == 'message' ) )
						{
						?>
						<li> 
						<a href="<?php echo get_the_permalink( $adforest_theme['sb_notification_page'] ); ?>"><i class="icon-envelope"></i>
							<div class="notify">
							<?php
								global $wpdb;
								$unread_msgs = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->commentmeta WHERE comment_id = '$user_id' AND meta_value = '0' " );
								if( $unread_msgs > 0 )
								{
									$msg_count	=	$unread_msgs;
							?>
							<span class="heartbit"></span><span class="point"></span>
							</div>
						<?php
								}
						?>
                          </a>
						</li>
						<li class="new-sea-green nav-table dropdown"> 
						
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                        <i class="fa fa-user"></i>
                        </a>
                        <ul class="dropdown-menu">
          <li>
            <a href="<?php echo get_the_permalink( $adforest_theme['sb_profile_page'] ); ?>">
              <?php echo __ ( "Profile", "adforest" ); ?></a>
          </li>
          <?php
			if ( isset($adforest_theme['sb_cart_in_menu'] ) && $adforest_theme['sb_cart_in_menu'] && in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) )
			{
				global $woocommerce;
			?>
          <li>
            <a href="<?php echo wc_get_cart_url(); ?>">
              <?php echo __('Cart', 'adforest' ); ?> <span class="badge"><?php echo adforest_returnEcho($woocommerce->cart->cart_contents_count); ?></span></a> 
          </li>
            <?php
			}
			?>
          <li role="separator" class="divider"></li>
          <li>
            <a href="<?php echo wp_logout_url( get_the_permalink( $adforest_theme['sb_sign_in_page'] ) ); ?>">
              <?php echo __ ( "Logout", "adforest" ); ?></a>
          </li>
        </ul>
                        </li>

                        <?php
						}
					}
					else
					{
						if( isset( $adforest_theme['sb_sign_up_page'] ) && $adforest_theme['sb_sign_up_page'] != "" )
						{
				?>
                  
                            <li><a href="<?php echo get_the_permalink( $adforest_theme['sb_sign_up_page'] ); ?>"><i class="fa fa-unlock"></i></a></li>
				<?php
						}
						if( isset( $adforest_theme['sb_sign_in_page'] ) && $adforest_theme['sb_sign_in_page'] != "" )
						{
				?>
                  
                            <li class="new-sea-green"><a href="<?php echo get_the_permalink( $adforest_theme['sb_sign_in_page'] ); ?>"><i class="fa fa-sign-in"></i></a></li>
				<?php
						}
					}
				?>
					<?php
                    if( isset($adforest_theme['ad_in_menu'])  && $adforest_theme['ad_in_menu'] )
                    {
						$btn_text	=	__( 'Post Free Ad','adforest' );
                    if( isset( $adforest_theme['ad_in_menu_text'] ) &&  $adforest_theme['ad_in_menu_text'] != "" )
                    {
						$btn_text	=	$adforest_theme['ad_in_menu_text'];
                    }
                    ?>
						<li>
                        <a href="<?php echo get_the_permalink( $adforest_theme['sb_post_ad_page'] ); ?>" class="btn btn-primary"><i class="custom fa fa-plus"></i><?php echo esc_html($btn_text ); ?></a>
                        </li>
                    <?php
                    }
                    ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </section>
      </nav>
    </div>
  </div>
</div>