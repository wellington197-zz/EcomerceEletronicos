<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package Allo
 * @since 1.0
 */
get_header(); 

if( function_exists( 'kc_is_using' ) && kc_is_using() ) : 
    if ( have_posts() ) : 
        while ( have_posts() ) : the_post(); ?> 
        <div class="sh-kc-content clearfix">
            <?php the_content(); ?>
        </div>
        <?php 
        endwhile; 
    endif; 
else : ?>
<!-- Page Header
================================================== -->
<?php allo_page_header( esc_html( get_the_title() ) ); ?>

<!-- Blog Page Content
================================================== -->
<section class="single-blog-area section">
    <div class="container">
        <div class="row">
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="blog-single-page">
                    <div class="row post">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <?php if ( has_post_thumbnail() ) { ?>
                            <div class="blog-photo">
                                <figure>
                                    <?php allo_post_featured_image(850, 500, true); ?> 
                                    <div class="date">
                                        <span><?php echo get_the_date('M'); ?></span>
                                        <span><?php echo get_the_date('d'); ?></span>
                                    </div>
                                </figure>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="blog-content">
     
                                <div class="post-content">
                                    <?php 
                                        the_content(); 
                                        allo_wp_link_pages(); 
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <?php
                            // If comments are open or we have at least one comment, load up the comment template
                            if ( comments_open() || get_comments_number() ) :
                              comments_template();
                            endif;
                        ?> 
                        </div><!--  /.col-md-12 -->
                    </div><!--  /.row -->
                </div><!--  /.list-of-blog -->
            </div><!--  /.col-lg-9 -->
            <?php endwhile; ?>
        </div><!--  /.row -->
    </div><!--  /.container -->
</section><!--  /.blog-section-content -->
<?php endif; ?>
<?php get_footer(); ?>