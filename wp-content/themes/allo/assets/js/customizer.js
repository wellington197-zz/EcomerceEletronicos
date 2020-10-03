/**
 * Main customize js file
 *
 * @package Allo
 */

/* global initializeAllElements */
/* exported alloGetCss */

( function( $ ) {
	'use strict';
    /**
     * Live refresh for container width
     */
    wp.customize(
        'allo_container_width', function( value ) {
            'use strict';
            value.bind(
                function( to ) {
                    if ( to ) {
                        var values = JSON.parse( to );
                        if ( values ) {
                            if ( values.mobile ) {
                                var settings = {
                                    selectors: 'div.container',
                                    cssProperty: 'width',
                                    propertyUnit: 'px',
                                    styleClass: 'allo-container-width-css'
                                }, val;
                                val          = JSON.parse( to );
                                alloSetCss( settings, val );
                            }
                        }
                    }
                }
            );
        }
    );

	// Site Identity > Site Title
	wp.customize(
		'blogname', function( value ) {
			value.bind(
				function( newval ) {
					$( '.navbar .navbar-brand p' ).text( newval );
				}
			);
		}
	);

	// Site Identity > Site Description
	wp.customize(
		'blogdescription', function( value ) {
			value.bind(
				function( newval ) {
					$( '.blog .page-header .title' ).text( newval );
				}
			);
		}
	);

	// Appearance Settings > General Settings > Boxed Layout
	wp.customize(
		'allo_general_layout', function( value ) {
			value.bind(
				function() {
					var navbar_height = $( '.navbar-fixed-top' ).outerHeight();
					if ( $( '.main' ).hasClass( 'main-raised' ) ) {
						$( '.main' ).removeClass( 'main-raised' );
                        $( '.main.classic-blog' ).css( 'margin-top', navbar_height );
					} else {
						$( '.main' ).addClass( 'main-raised' );
						$('.main.classic-blog').css('margin-top', navbar_height);
					}
				}
			);
		}
	);

	// Appearance Settings > General Settings > Footer Credits
	wp.customize(
		'allo_general_credits', function( value ) {
			value.bind(
				function( newval ) {
					$( '.footer-black .copyright' ).html( newval );
				}
			);
		}
	);

	// Footer Options > Alternative Footer Style
	wp.customize(
		'allo_alternative_footer_style', function( value ) {
			value.bind(
				function() {
					var footer = $( '.footer.footer-big' );
					if ( footer.hasClass( 'footer-black' ) ) {
						footer.removeClass( 'footer-black' );
					} else {
						footer.addClass( 'footer-black' );
					}
				}
			);
		}
	);

	// Appearance Settings > Appearance Settings > General Settings > Sidebar Width
	wp.customize(
		'allo_sidebar_width', function( value ) {
			value.bind(
				function( newval ) {
					if ( $( 'body > .wrapper' ).width() > 991 ) {
						var layout = wp.customize._value.allo_page_sidebar_layout(), allo_content_width, content_width;
						if (layout !== 'full-width' && layout !== '') {
							allo_content_width = 100 - newval;

							if (newval <= 3 || newval >= 80) {
								allo_content_width = 100;
								newval               = 100;
							}
							content_width = allo_content_width - 8.33333333;

							$( '.content-sidebar-left, .content-sidebar-right, .page-content-wrap' ).css( 'width', allo_content_width + '%' );
							$( '.blog-sidebar-wrapper:not(.no-variable-width), .shop-sidebar.col-md-3' ).css( 'width', newval + '%' );
						}

						layout = wp.customize._value.allo_blog_sidebar_layout();
						if (layout !== 'full-width' && layout !== '') {
							allo_content_width = 100 - newval;

							if (newval <= 3 || newval >= 80) {
								allo_content_width = 100;
								newval               = 100;
								if (layout === 'sidebar-left') {
									$( '.blog-posts-wrap, .archive-post-wrap' ).removeClass( 'col-md-offset-1' );
								} else {
									$( 'body:not(.page) .blog-sidebar-wrapper:not(.no-variable-width)' ).removeClass( 'col-md-offset-1' );
								}
							} else {
								if (layout === 'sidebar-left') {
									$( '.blog-posts-wrap, .archive-post-wrap' ).addClass( 'col-md-offset-1' );
								} else {
									$( 'body:not(.page) .blog-sidebar-wrapper:not(.no-variable-width)' ).addClass( 'col-md-offset-1' );
								}
							}
							content_width = allo_content_width - 8.33333333;

							$( '.blog-posts-wrap, .archive-post-wrap, .single-post-wrap' ).css( 'width', content_width + '%' );
							$( '.blog-sidebar-wrapper:not(.no-variable-width), .shop-sidebar-wrapper' ).css( 'width', newval + '%' );
						}
					}
				}
			);
		}
	);

	// Frontpage Sections > Features  > Title
	wp.customize(
		'allo_features_title', function( value ) {
			value.bind(
				function( newval ) {
					$( '.allo-features .title' ).text( newval );
				}
			);
		}
	);

	// Frontpage Sections > Features  > Subtitle
	wp.customize(
		'allo_features_subtitle', function( value ) {
			value.bind(
				function( newval ) {
					$( '.allo-features .description' ).text( newval );
				}
			);
		}
	);

	// Blog Settiungs > Subscribe Section > Subtitle
	wp.customize(
		'allo_blog_subscribe_subtitle', function( value ) {
			value.bind(
				function( newval ) {
					$( '#subscribe-on-blog .description' ).text( newval );
				}
			);
		}
	);

	// Colors > Header/Slider Text Color
	wp.customize(
		'header_text_color', function( value ) {
			value.bind(
				function( newval ) {
					$( '.page-header, .page-header .allo-title, .page-header .sub-title' ).css( 'color', newval );
				}
			);
		}
	);

	// Header options > Top Bar > Text color
	wp.customize(
		'allo_top_bar_text_color', function( value ) {
			value.bind(
				function( newval ) {
					$( '.allo-top-bar' ).css( 'color', newval );
				}
			);
		}
	);


	// Header options > Top Bar > Link color on hover
	wp.customize(
		'allo_top_bar_link_color_hover', function( value ) {
			value.bind(
				function( newval ) {
					$( '.allo-top-bar a' ).hover(
						function(){
							$( this ).css( 'color', newval );
						}, function(){
							var initial = wp.customize._value.allo_top_bar_link_color();
							$( this ).css( 'color', initial );
						}
					);
				}
			);
		}
	);

	if ( 'undefined' !== typeof wp && 'undefined' !== typeof wp.customize && 'undefined' !== typeof wp.customize.selectiveRefresh ) {
		wp.customize.selectiveRefresh.bind(
			'partial-content-rendered', function( placement ) {
				initializeAllElements( $( placement.container ) );
			}
		);
	}

	wp.customize(
		'header_video', function( value ) {
			value.bind(
				function( newval ) {
					var linkedControl = wp.customize._value.external_header_video();
					trigger_slider_selective( newval, linkedControl );
				}
			);
		}
	);

	wp.customize(
		'external_header_video', function( value ) {
			value.bind(
				function( newval ) {
					var linkedControl = wp.customize._value.header_video();
					trigger_slider_selective( newval, linkedControl );
				}
			);
		}
	);

} )( jQuery );
/**
 * This function builds two arrays of settings for each value from arraySizes. Those two arrays are parameters for
 * alloSetCss function. Those parameters are:
 * 	data: an object with desktop, tablet and mobile value
 * 	settings: an object with class of the style tag and the selectors on witch the style will be applied
 *
 *
 * @param arraySizes
 * An object with multiple sizes. Foreach size you have to specify:
 * 	selectors on which to apply sizes
 * 	list of values on mobile, tablet and desktop
 *
 * @param settings
 * An object with the following components:
 * cssProperty: what css property is changed (ex: font-size, width etc. )
 * propertyUnit: unit (ex: px, em etc.)
 * styleClass: the class of the temporary style tag that is added while changing the control.
 *
 * @param to
 * Current value of the control
 */
function alloGetCss( arraySizes, settings, to ) {
    'use strict';
    var data, desktopVal, tabletVal, mobileVal,
        className = settings.styleClass, i = 1;

    var val = JSON.parse( to );
    if ( typeof( val ) === 'object' && val !== null ) {
        if ('desktop' in val) {
            desktopVal = val.desktop;
        }
        if ('tablet' in val) {
            tabletVal = val.tablet;
        }
        if ('mobile' in val) {
            mobileVal = val.mobile;
        }
    }

    for ( var key in arraySizes ) {
        // skip loop if the property is from prototype
        if ( ! arraySizes.hasOwnProperty( key )) {
            continue;
        }
        var obj = arraySizes[key];
        var limit = 0;
        var correlation = [1,1,1];
        if ( typeof( val ) === 'object' && val !== null ) {

            if( typeof obj.limit !== 'undefined'){
                limit = obj.limit;
            }

            if( typeof obj.correlation !== 'undefined'){
                correlation = obj.correlation;
            }

            data = {
                desktop: ( parseInt(parseFloat( desktopVal ) / correlation[0]) + obj.values[0]) > limit ? ( parseInt(parseFloat( desktopVal ) / correlation[0]) + obj.values[0] ) : limit,
                tablet: ( parseInt(parseFloat( tabletVal ) / correlation[1]) + obj.values[1] ) > limit ? ( parseInt(parseFloat( tabletVal ) / correlation[1]) + obj.values[1] ) : limit,
                mobile: ( parseInt(parseFloat( mobileVal ) / correlation[2]) + obj.values[2] ) > limit ? ( parseInt(parseFloat( mobileVal ) / correlation[2]) + obj.values[2] ) : limit
            };
        } else {
            if( typeof obj.limit !== 'undefined'){
                limit = obj.limit;
            }

            if( typeof obj.correlation !== 'undefined'){
                correlation = obj.correlation;
            }
            data =( parseInt( parseFloat( to ) / correlation[0] ) ) + obj.values[0] > limit ? ( parseInt( parseFloat( to ) / correlation[0] ) ) + obj.values[0] : limit;
        }
        settings.styleClass = className + '-' + i;
        settings.selectors  = obj.selectors;

        alloSetCss( settings, data );
        i++;
    }
}

/**
 * Add media query on settings from setStyle function.
 *
 * @param settings
 * An object with the following components:
 * 	styleClass class that will be on style tag
 * 	selectors specified selectors
 *
 * @param to
 * Current value of the control
 */
function alloSetCss( settings, to ){
    'use strict';
    var result     = '';
    var styleClass = jQuery( '.' + settings.styleClass );
    if ( to !== null && typeof to === 'object' ) {
        jQuery.each(
            to, function ( key, value ) {
                var style_to_add;
                if ( settings.selectors === '.container' ) {
                    style_to_add = settings.selectors + '{ ' + settings.cssProperty + ':' + value + settings.propertyUnit + '; max-width: 100%; }';
                } else {
                    style_to_add = settings.selectors + '{ ' + settings.cssProperty + ':' + value + settings.propertyUnit + '}';
                }
                switch ( key ) {
                    case 'desktop':
                        result += style_to_add;
                        break;
                    case 'tablet':
                        result += '@media (max-width: 767px){' + style_to_add + '}';
                        break;
                    case 'mobile':
                        result += '@media (max-width: 480px){' + style_to_add + '}';
                        break;
                }
            }
        );
        if ( styleClass.length > 0 ) {
            styleClass.text( result );
        } else {
            jQuery( 'head' ).append( '<style type="text/css" class="' + settings.styleClass + '">' + result + '</style>' );
        }
    } else {
        jQuery( settings.selectors ).css( settings.cssProperty, to + 'px' );
    }
}

