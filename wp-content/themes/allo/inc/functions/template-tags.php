<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 */

/**
 * Allo Post Pagination
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_posts_pagination_nav' ) ) :
function allo_posts_pagination_nav($wp_query = '', $custom_class = '', $page_url = false) {

    if(!$wp_query) {
        $wp_query = $GLOBALS['wp_query'];
    }

    /** Stop execution if there's only 1 page */
    if( $wp_query->max_num_pages <= 1 )
        return;

    if($page_url == false) {
        $paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
    } else {
        $paged = ( isset($_GET['paged']) ? sanitize_text_field( wp_unslash( $_GET['paged'] ) ) : 1 );
    }
    
    $max   = intval( $wp_query->max_num_pages );

    /** Add current page to the array */
    if ( $paged >= 1 )
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ( $paged >= 3 ) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if ( ( $paged + 2 ) <= $max ) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }
    $div_class = ($custom_class != "") ? $custom_class : "";

    echo '<div class="clearfix"></div><div class="col-md-12 text-center"><div class="pagination '.esc_attr( $div_class ).' "><ul class="list-inline">' . "\n";

    /** Previous Post Link */
    if ( get_previous_posts_link() ) {
        printf( '<li class="nav-previous">%s</li>' . "\n", wp_kses_post( get_previous_posts_link('<i class="fa fa-angle-left"></i>' )));
    } 
    
    /** Link to first page, plus ellipses if necessary */
    if ( ! in_array( 1, $links ) ) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf( '<li%s><a class="page-numbers" href="%s">%s</a></li>' . "\n", wp_kses_post( $class ), esc_url( get_pagenum_link( 1 ) ), '1' );

        if ( ! in_array( 2, $links ) )
            echo '<li><span class="page-numbers dots">&hellip;</span></li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort( $links );
    foreach ( (array) $links as $link ) {
        $class = $paged == $link ? ' class="active"' : '';
        printf( '<li%s><a class="page-numbers" href="%s">%s</a></li>' . "\n", wp_kses_post( $class ), esc_url( get_pagenum_link( $link ) ), wp_kses_post( $link ) );
    }

    /** Link to last page, plus ellipses if necessary */
    if ( ! in_array( $max, $links ) ) {
        if ( ! in_array( $max - 1, $links ) )
            echo '<li><span class="page-numbers dots">&hellip;</span></li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf( '<li%s><a class="page-numbers curent" href="%s">%s</a></li>' . "\n", wp_kses_post( $class ), esc_url( get_pagenum_link( $max ) ), wp_kses_post( $max ) );
    }


    /** Next Post Link */
    if ( get_next_posts_link() ) {
        printf( '<li class="nav-next">%s</li>' . "\n", wp_kses_post( get_next_posts_link( '<i class="fa fa-angle-right"></i>') ) );
    } 
    echo '</ul></div></div>' . "\n";
}
endif;

/**
 *  Allo Pagination Text
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_pagination_text' ) ) :
function allo_pagination_text() {
    global $wp_query;
    $curent = (get_query_var('paged')) ? get_query_var('paged') : 1;
    $total = $wp_query->max_num_pages;
    /* translators: 1: Current Page, 2: Second Pages */
    printf( esc_html__( 'Showing page %1$u out of %2$u pages', 'allo' ), wp_kses_post( $curent ), wp_kses_post($total) );
    
}
endif;

/**
 * Allo WP Link Pages
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_wp_link_pages' ) ) :
function allo_wp_link_pages() {
    wp_link_pages( array(
        'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'allo' ),
        'after'  => '</div>',
        'link_before' => '<span>',
        'link_after'  => '</span>',
    ) );
}
endif;

/**
 *  Allo Archive Title Function
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_archive_title' ) ) :
/**
 * Shim for `allo_archive_title()`.
 *
 * Display the archive title based on the queried object.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the title. Default empty.
 * @param string $after  Optional. Content to append to the title. Default empty.
 */
function allo_archive_title( $before = '', $after = '' ) {
    $allowed_html_array = array(
        'span' => array()
    );
    if ( is_category() ) {
        /* translators: Archive Category */
        $title = sprintf( wp_kses( __( '<span>Browsing Category: </span>', 'allo' ), $allowed_html_array ).esc_html__( ' %s ', 'allo' ), single_cat_title( '', false ) );
    } elseif ( is_tag() ) {
        /* translators: Archive Tag */
        $title = sprintf( wp_kses( __( '<span>Browsing Tag: </span>', 'allo' ), $allowed_html_array ).esc_html__( ' %s ', 'allo' ), single_tag_title( '', false ) );
    } elseif ( is_author() ) {
        /* translators: Archive Author */
        $title = sprintf( wp_kses( __( '<span>Browsing Author: </span>', 'allo' ), $allowed_html_array ).esc_html__( ' %s ', 'allo' ), get_the_author() );
    } elseif ( is_year() ) {
        /* translators: Archive Year */
        $title = sprintf( wp_kses( __( '<span>Browsing Year: </span>', 'allo' ), $allowed_html_array ).esc_html__( ' %s ', 'allo' ), get_the_date( esc_html_x( 'Y', 'yearly archives date format', 'allo' ) ) );
    } elseif ( is_month() ) {
        /* translators: Archive Month */
        $title = sprintf( wp_kses( __( '<span>Browsing Month: </span>', 'allo' ), $allowed_html_array ).esc_html__( ' %s ', 'allo' ), get_the_date( esc_html_x( 'F Y', 'monthly archives date format', 'allo' ) ) );
    } elseif ( is_day() ) {
        /* translators: Archive Date */
        $title = sprintf( wp_kses( __( '<span>Browsing Day: </span>', 'allo' ), $allowed_html_array ).esc_html__( ' %s ', 'allo' ), get_the_date( esc_html_x( 'F j, Y', 'daily archives date format', 'allo' ) ) );
    } elseif ( is_tax( 'post_format' ) ) {
        if ( is_tax( 'post_format', 'post-format-aside' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format: </span>', 'allo' ), $allowed_html_array ).esc_html_x( 'Aside', 'post format archive title', 'allo' );
        } elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format: </span>', 'allo' ), $allowed_html_array ).esc_html_x( 'Gallery', 'post format archive title', 'allo' );
        } elseif ( is_tax( 'post_format', 'post-format-image' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format: </span>', 'allo' ), $allowed_html_array ).esc_html_x( 'Image', 'post format archive title', 'allo' );
        } elseif ( is_tax( 'post_format', 'post-format-video' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format: </span>', 'allo' ), $allowed_html_array ).esc_html_x( 'Video', 'post format archive title', 'allo' );
        } elseif ( is_tax( 'post_format', 'post-format-quote' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format: </span>', 'allo' ), $allowed_html_array ).esc_html_x( 'Quote', 'post format archive title', 'allo' );
        } elseif ( is_tax( 'post_format', 'post-format-link' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format: </span>', 'allo' ), $allowed_html_array ).esc_html_x( 'Link', 'post format archive title', 'allo' );
        } elseif ( is_tax( 'post_format', 'post-format-status' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format: </span>', 'allo' ), $allowed_html_array ).esc_html_x( 'Status', 'post format archive title', 'allo' );
        } elseif ( is_tax( 'post_format', 'post-format-audio' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format: </span>', 'allo' ), $allowed_html_array ).esc_html_x( 'Audio', 'post format archive title', 'allo' );
        } elseif ( is_tax( 'post_format', 'post-format-chat' ) ) {
            $title = wp_kses( __( '<span>Browsing Post Format: </span>', 'allo' ), $allowed_html_array ).esc_html_x( 'Chat', 'post format archive title', 'allo' );
        }
    } elseif ( is_post_type_archive() ) {
        /* translators: Archive Pages */
        $title = sprintf( __( '<span>Browsing Archives: </span>', 'allo' ).esc_html__( ' %s ', 'allo' ), post_type_archive_title( '', false ) );
    } elseif ( is_tax() ) {
        $tax = get_taxonomy( get_queried_object()->taxonomy );
        /* translators: 1: Taxonomy singular name, 2: Current taxonomy term */
        $title = sprintf( esc_html__( '%1$s: %2$s', 'allo' ), $tax->labels->singular_name, single_term_title( '', false ) );
    } else {
        $title = esc_html__( 'Browsing Archives: ', 'allo' );
    }

    /**
     * Filter the archive title.
     *
     * @param string $title Archive title to be displayed.
     */
    $title = apply_filters( 'get_the_archive_title', $title );
    if ( ! empty( $title ) ) {
        echo wp_kses( $before, TL_ALLO_Static::html_allow()) . wp_kses( $title, TL_ALLO_Static::html_allow()) . wp_kses( $after, TL_ALLO_Static::html_allow());
    }
}
endif;

/**
 * Allo Archive Description
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_the_archive_description' ) ) :
/**
 * Shim for `the_archive_description()`.
 *
 * Display category, tag, or term description.
 *
 * @todo Remove this function when WordPress 4.3 is released.
 *
 * @param string $before Optional. Content to prepend to the description. Default empty.
 * @param string $after  Optional. Content to append to the description. Default empty.
 */
function allo_the_archive_description( $before = '', $after = '' ) {
    $description = apply_filters( 'get_the_archive_description', term_description() );

    if ( ! empty( $description ) ) {
        /**
         * Filter the archive description.
         *
         * @see term_description()
         *
         * @param string $description Archive description to be displayed.
         */
        echo wp_kses( $before, TL_ALLO_Static::html_allow()) . wp_kses( $description, TL_ALLO_Static::html_allow()) . wp_kses( $after, TL_ALLO_Static::html_allow());
    }
}
endif;

/**
 * Allo Categorized Blog
 *
 * @package Allo
 * @since 1.0
 */
function allo_categorized_blog() {
    if ( false === ( $all_the_cool_cats = get_transient( 'allo_categories' ) ) ) {
        // Create an array of all the categories that are attached to posts.
        $all_the_cool_cats = get_categories( array(
            'fields'     => 'ids',
            'hide_empty' => 1,

            // We only need to know if there is more than one category.
            'number'     => 2,
        ) );

        // Count the number of categories that are attached to the posts.
        $all_the_cool_cats = count( $all_the_cool_cats );

        set_transient( 'allo_categories', $all_the_cool_cats );
    }

    if ( $all_the_cool_cats > 1 ) {
        // This blog has more than 1 category so allo_categorized_blog should return true.
        return true;
    } else {
        // This blog has only 1 category so allo_categorized_blog should return false.
        return false;
    }
}
/**
 * Allo Flush out the transients used in allo_categorized_blog.
 *
 * @package Allo
 * @since 1.0
 */
function allo_category_transient_flusher() {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    // Like, beat it. Dig?
    delete_transient( 'allo_categories' );
}
add_action( 'edit_category', 'allo_category_transient_flusher' );
add_action( 'save_post',     'allo_category_transient_flusher' );

/**
 * Allo Breadcrumbs Function
 *
 * @package Allo
 * @since 1.0
 */
if ( ! function_exists( 'allo_breadcums_function' ) ) :
    function allo_breadcums_function() {
        $home_link        = esc_url( home_url('/') );
        $home_text        = esc_html__( 'Home', 'allo' );
        $link_before      = '<li><span typeof="v:Breadcrumb">';
        $link_after       = '</span></li>';
        $link_attr        = ' rel="v:url" property="v:title"';
        $link             = $link_before . '<a' . $link_attr . ' href="%1$s">%2$s</a>' . $link_after;
        $delimiter        = '-';
        $before           = '<li><span class="current">'; // Tag before the current crumb
        $after            = '</span></li>';                // Tag after the current crumb
        $page_addon       = '';                       // Adds the page number if the query is paged
        $breadcrumb_trail = '';
        $category_links   = '';

        /** 
         * Set our own $wp_the_query variable. Do not use the global variable version due to 
         * reliability
         */
        $wp_the_query   = $GLOBALS['wp_the_query'];
        $queried_object = $wp_the_query->get_queried_object();
        $page_ID = $wp_the_query->get_queried_object_id();
        // Handle single post requests which includes single pages, posts and attatchments
        if ( is_singular() ) {
            /** 
             * Set our own $post variable. Do not use the global variable version due to 
             * reliability. We will set $post_object variable to $GLOBALS['wp_the_query']
             */
            $post_object = sanitize_post( $queried_object );

            // Set variables 
            $title          = apply_filters( 'the_title', $post_object->post_title );
            $parent         = $post_object->post_parent;
            $post_type      = $post_object->post_type;
            $post_id        = $post_object->ID;
            $post_link      = $before . $title . $after;
            $parent_string  = '';
            $post_type_link = '';

            if ( 'post' === $post_type ) {
                // Get the post categories
                $categories = get_the_category( $post_id );
                if ( $categories ) {
                    // Lets grab the first category
                    $category  = $categories[0];

                    $category_links = get_category_parents( $category, true, $delimiter );
                    $category_links = str_replace( '<a',  $link_before . '<a' . $link_attr, $category_links );
                    $category_links = str_replace( '</a>', '</a>' . $link_after, $category_links );
                }
            }

            if ( !in_array( $post_type, array('post', 'page', 'attachment') ) ) {
                $post_type_object = get_post_type_object( $post_type );
                $archive_link     = esc_url( get_post_type_archive_link( $post_type ) );
                $post_type_link   = sprintf( $link, $archive_link, $post_type_object->labels->singular_name );
            }

            // Get post parents if $parent !== 0
            if ( 0 !== $parent ) {
                $parent_links = array();
                while ( $parent ) {
                    $post_parent = get_post( $parent );

                    $parent_links[] = sprintf( $link, esc_url( get_permalink( $post_parent->ID ) ), get_the_title( $post_parent->ID ) );

                    $parent = $post_parent->post_parent;
                }

                $parent_links = array_reverse( $parent_links );

                $parent_string = implode( $delimiter, $parent_links );
            }

            // Lets build the breadcrumb trail
            if ( $parent_string ) {
                $breadcrumb_trail = $parent_string . $delimiter . $post_link;
            } else {
                $breadcrumb_trail = $post_link;
            }

            if ( $post_type_link )
                $breadcrumb_trail = $post_type_link . $delimiter . $breadcrumb_trail;

            if ( $category_links )
                $breadcrumb_trail = $category_links . $breadcrumb_trail;
        }

        // Handle archives which includes category-, tag-, taxonomy-, date-, custom post type archives and author archives
        if( is_archive() ) {
            if ( is_category() || is_tag() || is_tax() ) {
                // Set the variables for this section
                $term_object        = get_term( $queried_object );
                $taxonomy           = $term_object->taxonomy;
                $term_id            = $term_object->term_id;
                $term_name          = $term_object->name;
                $term_parent        = $term_object->parent;
                $taxonomy_object    = get_taxonomy( $taxonomy );
                $current_term_link  = $before . $taxonomy_object->labels->singular_name . ': ' . $term_name . $after;
                $parent_term_string = '';

                if ( 0 !== $term_parent )  {
                    // Get all the current term ancestors
                    $parent_term_links = array();
                    while ( $term_parent ) {
                        $term = get_term( $term_parent, $taxonomy );

                        $parent_term_links[] = sprintf( $link, esc_url( get_term_link( $term ) ), $term->name );

                        $term_parent = $term->parent;
                    }

                    $parent_term_links  = array_reverse( $parent_term_links );
                    $parent_term_string = implode( $delimiter, $parent_term_links );
                }

                if ( $parent_term_string ) {
                    $breadcrumb_trail = $parent_term_string . $delimiter . $current_term_link;
                } else {
                    $breadcrumb_trail = $current_term_link;
                }

            } elseif ( is_author() ) {
                $breadcrumb_trail = esc_html__( 'Author archive for', 'allo') .  $before . $queried_object->data->display_name . $after;

            } elseif ( is_date() ) {
                // Set default variables
                $year     = $wp_the_query->query_vars['year'];
                $monthnum = $wp_the_query->query_vars['monthnum'];
                $day      = $wp_the_query->query_vars['day'];

                // Get the month name if $monthnum has a value
                if ( $monthnum ) {
                    $date_time  = DateTime::createFromFormat( '!m', $monthnum );
                    $month_name = $date_time->format( 'F' );
                }

                if ( is_year() ) {
                    $breadcrumb_trail = $before . $year . $after;
                } elseif( is_month() ) {
                    $year_link        = sprintf( $link, esc_url( get_year_link( $year ) ), $year );
                    $breadcrumb_trail = $year_link . $delimiter . $before . $month_name . $after;

                } elseif( is_day() ) {
                    $year_link   = sprintf( $link, esc_url( get_year_link( $year ) ), $year );
                    $month_link  = sprintf( $link, esc_url( get_month_link( $year, $monthnum ) ), $month_name );

                    $breadcrumb_trail = $year_link . $delimiter . $month_link . $delimiter . $before . $day . $after;
                }

            } elseif ( is_post_type_archive() ) {
                $post_type        = $wp_the_query->query_vars['post_type'];
                $post_type_object = get_post_type_object( $post_type );
                $breadcrumb_trail = $before . $post_type_object->labels->singular_name . $after;
            }
        }   

        // Handle the search page
        if ( is_search() ) {
            $breadcrumb_trail = esc_html__( 'Search query for: ', 'allo') . $before . get_search_query() . $after;
        }

        // Handle 404's
        if ( is_404() ) {
            $breadcrumb_trail = $before . esc_html__( 'Error 404', 'allo' ) . $after;
        }

        // Handle paged pages
        if ( is_paged() ) {
            $current_page = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : get_query_var( 'page' );
            /* translators: Page No */
            $page_addon   = $before . sprintf( __( ' ( Page %s )', 'allo' ), number_format_i18n( $current_page ) ) . $after;
        }
        if(!is_front_page()) {
            $breadcrumb_output_link  = '';
            $breadcrumb_output_link .= '<div class="breadcumb-link"><ul>';
            if ( is_home() || is_front_page() ) {
                // Do not show breadcrumbs on page one of home and frontpage
                if ( is_paged() ) {
                    $breadcrumb_output_link .= '<li><a href="' . esc_url($home_link) . '">' . $home_text . '</a></li>';
                    $breadcrumb_output_link .= $page_addon;
                } else {
                    $breadcrumb_output_link .= '<li><a href="' . esc_url($home_link) . '">' . $home_text . '</a></li>';
                    $breadcrumb_output_link .= '<li>-</li>';
                    $breadcrumb_output_link .= '<li>'. get_the_title($page_ID) .'</li>';
                }
            } else {
                $breadcrumb_output_link .= '<li><a href="' . esc_url($home_link) . '" rel="v:url" property="v:title">' . esc_html($home_text) . '</a></li>';
                $breadcrumb_output_link .= '<li>'. esc_html($delimiter) .'</li>';
                $breadcrumb_output_link .= '<li>'. $breadcrumb_trail .'</li>';
                $breadcrumb_output_link .= $page_addon;
            }
            $breadcrumb_output_link .= '</ul></div>';
        }
        return $breadcrumb_output_link;
    }
endif;