<?php
/**
 * Header Style Four
 *
 * @package Allo
 * @since 1.0
 */
?>

<!-- Header
================================================== -->
<header class="header-four-content">
    <div class="main-header-fore">
        <div id="topo">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 col-ms-6 col-xs-6" id="logo-topo">
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

                    <div class="col-md-6 col-ms-6 col-xs-6 header-top-four" id="abre-menu-topo">
                        <?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
                        <div class="higlight">
                            <ul class="list-inline">
                                <?php if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) { ?>
                                    <li class="cart cart-area">
                                        <div class="hove">
                                            <i class="fa fa-shopping-cart"></i>
                                            <?php 
                                            if(!is_page( 'checkout' )) { ?>
                                            <p class="be"><span><?php /* translators: number of  cart, count. */ ?><?php echo wp_kses_post( sprintf( _n( ' %s ', ' %s ', WC()->cart->get_cart_contents_count(), 'allo' ), WC()->cart->get_cart_contents_count())); ?></span></p>
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
                                <?php } ?>
                                <li data-toggle="modal" data-target=".bs-example-modal-lg">
                                    <i class="fa fa-search"></i>
                                </li>
                            </ul>

                            <div class="search-box">
                                <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content popup-search">
                                            <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times" aria-hidden="true"></i></button>
                                            <div class="modal-body">
                                                <?php get_search_form(); ?>
                                            </div>
                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div>
                            </div>
                        </div> 
                        <?php } ?>
                        
                        <a href="#" class="btn-collapse">
                            <div class="lista-collapse"></div>
                            <div class="lista-collapse"></div>
                            <div class="lista-collapse"></div>
                        </a>
                    </div>
                </div><!--Fim da Row1 -->

                <div class="row">
                    <div id="menu-topo" class="menu-style-four">
                        <?php 
                            wp_nav_menu ( array(
                                'menu_class' => 'mainmenu',
                                'container'=> 'ul',
                                'theme_location' => 'main-menu', 
                                'walker'    => new TL_ALLO_Walker_Nav_Menu(), 
                                'fallback_cb'    => 'TL_ALLO_Walker_Nav_Menu::menu_callback' 
                            ));  
                        ?>
                    </div>
                </div>
            </div><!--Fim da coontainer -->
        </div><!--Fim do topo -->
    </div>

    <div class="mobile-menu-area">
        <input type="hidden" class="header-mobile-logo-url" value="<?php echo esc_url( home_url( '/' ) ); ?>" />
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="mobile-menu">
                        <nav id="dropdown"></nav>
                    </div>          
                </div>
            </div>
        </div>
    </div> 
</header>