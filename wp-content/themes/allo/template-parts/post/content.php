<?php
/**
 * The default template for displaying content
 *
 * Used for both single and index/archive/search.
 *
 * @package Allo
 * @since 1.0
 */
if( get_theme_mod( 'allo_blog_per_row' ) ) {
    $postShowInRow = get_theme_mod( 'allo_blog_per_row','3' );
    $moveonInteger = intval(str_replace(" ", "",$postShowInRow));
    $newCol = ( 12 / $moveonInteger);
    $col_class = 'col-md-'.$newCol;
} else {
    $col_class = 'col-md-4';
}

$blog_url = (isset($_GET["blog_style"])) ? sanitize_text_field( wp_unslash( $_GET["blog_style"] ) ) : '';
$blogStyle = get_theme_mod('allo_blog_style','style_one');

if($blog_url) {
    $blogStyle = $blog_url;
}

if($blogStyle == 'style_two') { ?>
    <div class="item <?php echo esc_attr($col_class); ?>">
        <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
            <div class="single-blog mr-b30 text-center post-list-item">
                <figure>
                    <?php if ( has_post_thumbnail() ) { ?>
                        <?php allo_post_featured_image(499, 315, true); ?>
                    <div class="blog-con">
                    <?php } else { ?> 
                    <div class="blog-con without-post-thumb">
                    <?php } ?>
                        <div class="bg-pos">
                            <h2 class="entry-title" title="<?php the_title_attribute(); ?>"><a href="<?php echo esc_url( get_permalink() )?>"><?php echo wp_kses_post(allo_custom_post_excerpt( esc_html( get_the_title() ), 30, '&hellip;')); ?></a></h2>
                            <ul class="list-inline blog-meta-field">
                                <?php if( get_the_post_thumbnail() == "" && get_the_title() == ""): ?>
                                <li class="entry-date no-title"><a href="<?php the_permalink(); ?>"><?php the_date( get_option( 'date_format' ) ); ?></a></li>
                                <?php else: ?>
                                <li class="entry-date"><?php the_date( 'Y-m-d' ); ?></li>
                                <?php endif; ?> 
                                <li><i class="fa fa-comment-o"></i><span><?php echo wp_kses_post( get_comments_number() ); ?></span></li>
                                <li><i class="fa fa-eye"></i><span><?php echo wp_kses_post(allo_get_post_views( get_the_ID() )); ?></span></li>
                            </ul>
                        </div>
                    </div>
                </figure>
            </div>
        </article><!--  /.post -->
    </div>  
<?php } else { ?>
    <div class="item <?php echo esc_attr($col_class); ?>">
        <article id="post-<?php the_ID(); ?>" <?php post_class('post'); ?>>
            <div class="single-blog post-list-item">
                <?php if ( has_post_thumbnail() ) { ?>
                <figure>
                    <?php allo_post_featured_image(499, 315, true); ?>
                    <div class="date">
                        <span><?php echo get_the_date('M'); ?></span>
                        <span><?php echo get_the_date('d'); ?></span>
                    </div>
                </figure>
                <?php } ?> 
                <?php if( get_the_post_thumbnail() == "" && get_the_title() == ""): ?>
                <h5 class="entry-date no-title"><a href="<?php esc_url(the_permalink()); ?>"><?php the_time( get_option( 'date_format' ) ); ?></a></h5>
                <?php else: ?>
                <?php the_title( sprintf( '<h2 class="entry-title" title="'. esc_html( get_the_title() ) .'"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
                <?php endif; ?>
            </div>
            <div class="article-content">
                <?php the_excerpt(); ?>
            </div><!--  /.article-content -->
        </article><!--  /.post -->
    </div><!--  /.col-md-6 -->
<?php } ?>
 