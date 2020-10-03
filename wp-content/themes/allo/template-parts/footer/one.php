<?php
/**
 *  This template for displaying footer part
 *
 * @package Allo
 * @since 1.0
 */
?>
<!-- Footer
================================================== -->
<footer  class="footer-one">
    <div class="footer-top pd-t80 pd-b80">
        <div class="container">
            <div class="row">
                <?php
                $getFooterCol = get_theme_mod('allo_footer_widget','4'); 
                $columns = intval( $getFooterCol );
                $col_class = 12 / max( 1, $columns );
                $col_class_sm = 12 / max( 1, $columns );
                if ( $columns == 4 ) {
                    $col_class_sm = 6;
                } 
                $col_class = "col-sm-$col_class_sm col-md-$col_class";
                for ( $i = 1; $i <= $columns ; $i++ ) {
                    if ( $columns == 3 ) :
                        if ( $i == 3 ) {
                            $col_class = "col-sm-12 col-md-$col_class";
                        } else {
                            $col_class = "col-sm-6 col-md-$col_class";
                        } 
                    endif;
                    ?>
                    <div class="widget-area sidebar-footer-<?php echo esc_attr($i) ?> <?php echo esc_attr( $col_class ) ?>">
                        <?php if ( is_active_sidebar( 'sidebar-footer-'.$i ) ) { ?>
                        <?php dynamic_sidebar( 'sidebar-footer-'.$i ); ?>
                        <?php } ?>
                    </div>
                <?php } ?> 
            </div><!--  /.row -->
        </div> 
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="copyright">
                        <p class="copyright-text">
                        <?php echo wp_kses( get_theme_mod('footer_copyright_info', __('&copy; 2018 Allo. All Rights Reserved.', 'allo')), TL_ALLO_Static::html_allow() ); ?>
                        </p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                    <div class="pay-option text-right">
                        <?php 
                            $imageSrc = get_theme_mod('allo_footer_payment_image', TL_ALLO_TEMPLATE_DIR_URL . '/assets/images/pay.png' );
                            if($imageSrc !== "" ) {?>
                                <img src="<?php echo esc_url($imageSrc);?>" alt="<?php esc_html_e('payment','allo') ?>" />
                            <?php }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>