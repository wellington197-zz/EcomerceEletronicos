<?php
/**
 * Header Style One
 *
 * @package Allo
 * @since 1.0
 */
?>
<!-- Header
================================================== --> 
<header>
    <div class="topbar">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="top-contact">
                       <ul>
                            <li class="header-top-location"><i class="fa <?php echo esc_attr(get_theme_mod('header_location_icon', 'fa-map-marker')); ?>"></i> <span class="location-text"><?php echo esc_html(get_theme_mod('header_location_text', esc_html__('68 house, Melborne, Australia','allo'))); ?></span></li>
                            <li class="header-top-phone"><i class="fa <?php echo esc_attr(get_theme_mod('header_phone_icon', 'fa-phone')); ?>"></i> <span class="phone-text"><?php echo esc_html(get_theme_mod('header_phone_text', esc_html__('Hot Line: + 0568 099 99','allo'))); ?></span></li>
                       </ul> 
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
                        <div class="heiglight text-right">
                            <ul>
                                <?php if ( is_user_logged_in() ) { ?>
                                    <li>
                                        <a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>" title="<?php esc_attr_e('My Account','allo'); ?>"><i class="fa fa-user"></i> <?php esc_html_e('My Account','allo'); ?></a>
                                    </li>
                                 <?php } 
                                 else { ?>
                                    <li>
                                        <a href="<?php echo esc_url(get_permalink( get_option('woocommerce_myaccount_page_id') )); ?>" title="<?php esc_attr_e('Login / Register','allo'); ?>"><i class="fa fa-user"></i> <?php esc_html_e('Login / Register','allo'); ?></a>
                                    </li>
                                 <?php } ?>
                                
                                <li class="cart cart-area">
                                    <div class="hove">
                                        <i class="fa fa-shopping-cart"></i>
                                        <?php 
                                        if(!is_page( 'checkout' )) { ?>
                                        <p class="be"><span><?php /* translators: number of  cart, count. */ ?><?php echo wp_kses_post( sprintf( _n( ' %s ', ' %s ', WC()->cart->get_cart_contents_count(), 'allo' ), WC()->cart->get_cart_contents_count())); ?></p>
                                        <div class="cart-list">
                                            <?php 
                                                if ( !is_page( 'cart' ) || !is_cart() ) {
                                                   the_widget('WC_Widget_Cart', array('title' => '')); 
                                                } else { ?>
                                                    <div class="alert alert-info">
                                                        <?php echo esc_html('You are on cart page, check cart item on below','allo'); ?>
                                                    </div><!--  /.alert -->
                                                    <?php
                                                }
                                            ?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </li>
                            </ul>
                        </div> 
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <div class="main-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12">
                    <div class="logo">
                        <?php if ( function_exists( 'the_custom_logo' ) && has_custom_logo() ) {
                            the_custom_logo();
                        } ?>
                        <?php if ( function_exists( 'display_header_text' ) ) { 
                            if(display_header_text() == true) { ?>
                            <div class="site-branding-text">
                                <?php if ( is_front_page() ) : ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php else : ?>
                                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                                <?php endif; ?>

                                <?php $description = get_bloginfo( 'description', 'display' );
                                if ( $description || is_customize_preview() ) : ?>
                                <p class="site-description"><?php echo esc_html($description); ?></p>
                                <?php endif; ?>
                            </div><!-- .site-branding-text -->
                            <?php }
                        } ?>
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-9 col-xs-12">
                    <div class="main-menu">
                        <nav>
                            <?php 
                                wp_nav_menu ( array(
                                    'menu_class' => 'mainmenu',
                                    'container'=> 'ul',
                                    'theme_location' => 'main-menu', 
                                    'walker'    => new TL_ALLO_Walker_Nav_Menu(), 
                                    'fallback_cb'    => 'TL_ALLO_Walker_Nav_Menu::menu_callback' 
                                ));  
                            ?>
                        </nav>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="mobile-menu-area">
        <input type="hidden" class="header-mobile-logo-url" value="<?php echo esc_url( home_url( '/' ) ); ?>" />
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mobile-menu">
                        <nav id="dropdown">
                        <!-- At here clone main menu with javascript --> 
                        </nav>
                    </div>          
                </div>
            </div>
        </div>
    </div> 
</header>