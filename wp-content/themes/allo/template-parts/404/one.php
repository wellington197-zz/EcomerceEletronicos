<?php
/**
 * This template for displaying 404 page part
 *
 * @package Allo
 * @since 1.0
 */
?>
<?php allo_page_header( esc_html__('Error', 'allo') );  ?>

<!-- 404 Page Content
================================================== -->
<section class="error-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="error-content text-center">
                    <h1><?php esc_html_e('404','allo'); ?></h1>
                    <h2><?php esc_html_e('Sorry Page Was Not Found','allo'); ?></h2>
                    <p><?php esc_html_e('The page you are looking is not available or has been removed. Try going to Home Page by using the button below.','allo'); ?></p>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn1"><?php esc_html_e('Go To Home Page', 'allo'); ?></a>
                </div>
            </div>
        </div>
    </div>
</section>