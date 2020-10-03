<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package Allo
 * @since 1.0
 */
?>
<div class="shop-sidebar sidbar-area">
    <?php $sidebar_id = "sidebar-shop"; 
    if ( is_active_sidebar( $sidebar_id ) ) : 
        dynamic_sidebar( $sidebar_id ); 
    else :
        the_widget('WP_Widget_Categories', '', 'before_widget=<div class="widget widget_categories clearfix">&before_title=<h3 class="widget-title" >&after_title=</h3>&after_widget=</div>'); 

        the_widget('WP_Widget_Archives', '', 'before_widget=<div class="widget widget_archive clearfix">&before_title=<h3 class="widget-title" >&after_title=</h3>&after_widget=</div>'); 

        the_widget('WP_Widget_Tag_Cloud', '', 'before_widget=<div class="widget widget_tag_cloud clearfix">&before_title=<h3 class="widget-title" >&after_title=</h3>&after_widget=</div>');
        echo "string2";
    endif; ?>
</div><!--  /.shop-sidebar -->
 