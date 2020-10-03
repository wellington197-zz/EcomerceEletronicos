<?php
/**
 * The template for displaying all single posts.
 *
 * @package Allo
 * @since 1.0
 */

get_header(); 
allo_page_header( esc_html__('Read Our Full Stories', 'allo') ); ?>

<!-- Blog Page Content
================================================== -->
<section class="single-blog-area section">
    <div class="container">
        <div class="row">
            <?php while ( have_posts() ) : the_post(); ?>
            <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
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
                                <div class="heading">
                                    <h2 title="<?php the_title_attribute(); ?>"><?php the_title(); ?></h2>
                                    <ul class="list-inline single-blog-meta">
                                        <li><?php esc_html_e('By:', 'allo'); ?><?php echo wp_kses_post( allo_post_autor() ); ?></li>
                                        <li><?php echo wp_kses_post( get_comments_number() ); ?> <?php echo esc_html__('comments','allo'); ?></li>
                                        <li><?php esc_html_e('Category:','allo'); ?> <?php the_category(', ' ); ?></li>
                                        <li><?php esc_html_e('Tags:','allo'); ?> <?php the_tags('',', ',''); ?></li>
                                    </ul>
                                </div>

                                <div class="post-content allo-blog-single-post">
                                    <?php 
                                        the_content(); 
                                        allo_wp_link_pages(); 
                                    ?>
                                </div>

                                <div class="social-share">
                                   <?php if ( function_exists( 'allo_social_share_link' ) ) {
                                       allo_social_share_link( esc_html__('Did You Like This Post? Share it :', 'allo') );
                                   } ?>
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
            <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                <div class="sidbar-area">
                    <?php get_sidebar(); ?>
                </div><!--  /.sidbar-area -->
            </div><!--  /.col-lg-3 -->
        </div><!--  /.row -->
    </div><!--  /.container -->
</section><!--  /.blog-section-content -->
<?php get_footer(); ?>