<?php
/**
 * This template for displaying default layout
 *
 * @package Allo
 * @since 1.0
 */
$pageHeader = get_theme_mod('allo_blog_text', esc_html__('Our Latest Story', 'allo'));
if($pageHeader !== "") {
    allo_page_header( $pageHeader ); 
}

$containerType = get_theme_mod( 'allo_blog_container_dispay', 'container_full' );
if( $containerType == 'container' ) {
    $containerClass = 'container';
    $colmainClass = 'col-md-9';
    $colsideClass = 'col-md-3';
} else {
    $containerClass = 'container-fluid pd-lr-45';
    $colmainClass = 'col-md-10';
    $colsideClass = 'col-md-2';
}

$sidebarType = get_theme_mod( 'allo_blog_sidebar_dispay','right_side' );
if($sidebarType == 'left_side') {
    $sidebarClass = $colsideClass .' col-md-pull-9';
    $wrapperClass = $colmainClass .' col-md-push-3';
} elseif ($sidebarType == 'no_side') {
    $sidebarClass = '';
    $wrapperClass = 'col-md-12';
} else {
    $sidebarClass = $colsideClass;
    $wrapperClass = $colmainClass;
}

$blog_url = (isset($_GET["blog_style"])) ? sanitize_text_field( wp_unslash( $_GET["blog_style"] ) ) : '';
$blogStyle = get_theme_mod('allo_blog_style','style_one');
if($blog_url) { $blogStyle = $blog_url; }

if($blogStyle == 'style_two') {
    $blog_content = 'blog-page-area';
} else {
    $blog_content = 'blog-page2-area';
}
?>
<!-- Blog Page Content
================================================== -->
<section class="blog-section-content <?php echo esc_attr($blog_content); ?> section">
    <div class="<?php echo esc_attr( $containerClass); ?>">
        <div class="row">
            <div class="<?php echo esc_attr($wrapperClass); ?> blog-post-ctn-area">
                <div id="blog-style-grid">
                    <div class="grid-of-blog"> 
                        <?php 
                        $postShowInRow = get_theme_mod( 'allo_blog_row_per_page','3');
                        if($postShowInRow !== "") { ?>
                            <div class="item-<?php echo esc_attr($postShowInRow); ?> row">
                        <?php } else { ?>
                            <div class="item-2 row">
                        <?php } ?>                 
                            <?php 
                            $archive = $cat_id = false;
                            if($archive) {
                                $the_query = new WP_Query( $args ); 
                                if ( $the_query->have_posts() ) :
                                    while ( $the_query->have_posts() ) : $the_query->the_post(); 
                                        get_template_part( 'template-parts/post/content', get_post_format() );
                                    endwhile;  
                                else :  
                                    get_template_part( 'template-parts/post/content', 'none' ); 
                                endif; 
                            } else { 
                                if ( have_posts() ) :
                                    if (is_search() && get_search_query() == '') {
                                        get_template_part( 'template-parts/post/content', 'none' ); 
                                    } elseif( is_search() ) {
                                        while ( have_posts() ) : the_post(); 
                                        get_template_part( 'template-parts/post/content', 'search' );
                                        endwhile; 
                                    } else {
                                        while ( have_posts() ) : the_post(); 
                                            get_template_part( 'template-parts/post/content', get_post_format() );
                                        endwhile; 
                                    }
                                else :  
                                    get_template_part( 'template-parts/post/content', 'none' ); 
                                endif; 
                            } 
                            
                            if ( !is_search() || get_search_query() != '') { allo_posts_pagination_nav(); } ?>

                        </div><!--  /.row -->
                    </div><!--  /.grid-of-blog -->
                </div>
                
            </div><!--  /.col-lg-9 -->
            <div class="<?php echo esc_attr($sidebarClass); ?> sidbar-area">
                <?php if($sidebarType !== 'no_side'): ?>
                    <?php get_sidebar(); ?>
                <?php endif ?>
            </div><!--  /.col-lg-3 -->
        </div><!--  /.row -->
    </div><!--  /.container -->
</section><!--  /.blog-section-content -->