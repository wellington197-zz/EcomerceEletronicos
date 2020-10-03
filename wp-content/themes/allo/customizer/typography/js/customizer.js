/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 *
 * @package allo
 * @since 1.0
 */

/* global wp*/
/* global alloGetCss */

/**
 * -------------------
 * Posts & Pages
 * -------------------
 */

/**
 * Live refresh for font size for:
 * pages/posts titles
 */
wp.customize(
    'allo_body_font_size', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'body'
                };

                var arraySizes = {
                    size: { selectors: 'body', values: [14] }
                };
                alloGetCss( arraySizes, settings, to );
            }
        );
    }
);

/**
 * Live refresh for font size for:
 * headings ( h1 - h6 ) on pages and single post pages
 */
wp.customize(
	'allo_post_page_headings_fs', function (value) {
		'use strict';
		value.bind(
			function( to ) {
				var settings = {
					cssProperty: 'font-size',
					propertyUnit: 'px',
					styleClass: 'allo-post-page-headings-fs'
				};

				var arraySizes = {
					size1: { selectors: '.single-post-wrap article h1:not(.title-in-content), .page-content-wrap h1:not(.title-in-content), .page-template-template-fullwidth article h1:not(.title-in-content)', values: [42,36,36] },
					size2: { selectors: '.single-post-wrap article h2, .page-content-wrap h2, .page-template-template-fullwidth article h2', values: [37,32,32] },
					size3: { selectors: '.single-post-wrap article h3, .page-content-wrap h3, .page-template-template-fullwidth article h3', values: [32,28,28] },
					size4: { selectors: '.single-post-wrap article h4, .page-content-wrap h4, .page-template-template-fullwidth article h4', values: [27,24,24] },
					size5: { selectors: '.single-post-wrap article h5, .page-content-wrap h5, .page-template-template-fullwidth article h5', values: [23,21,21] },
					size6: { selectors: '.single-post-wrap article h6, .page-content-wrap h6, .page-template-template-fullwidth article h6', values: [18,18,18] }
				};

                alloGetCss( arraySizes, settings, to );
			}
		);
	}
);

/**
 * Live refresh for font size for:
 * content ( p ) on pages
 * single post pages
 */
wp.customize(
	'allo_post_page_content_fs', function (value) {
		'use strict';
		value.bind(
			function( to ) {
				var settings = {
					cssProperty: 'font-size',
					propertyUnit: 'px',
					styleClass: 'allo-post-page-content-fs'
				};

				var arraySizes = {
					size1: { selectors: '.single-post-wrap article p:not(.meta-in-content), .page-content-wrap p, .single-post-wrap article ul, .page-content-wrap ul, .single-post-wrap article ol, .page-content-wrap ol, .single-post-wrap article dl, .page-content-wrap dl, .single-post-wrap article table, .page-content-wrap table, .page-template-template-fullwidth article p, .page-template-template-fullwidth article ol, .page-template-template-fullwidth article ul, .page-template-template-fullwidth article dl, .page-template-template-fullwidth article table', values: [18,18,18] },
				};

                alloGetCss( arraySizes, settings, to );
			}
		);
	}
);


/**
 * -------------------
 * Frontpage Sections
 * -------------------
 */
/**
 * Big Title Section / Header Slider
 * Controls all elements from the big title section.
 */
wp.customize(
    'allo_big_title_fs', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'allo-big-title-fs'
                };

                var arraySizes = {
                    size1: { selectors: '#carousel-allo-generic .allo-title', values: [67,36,36], correlation: [1,4,4] },
					size2: { selectors: '#carousel-allo-generic span.sub-title', values: [18,18,18], correlation: [8,4,4] },
					size3: { selectors: '#carousel-allo-generic .btn', values: [14,14,14], correlation: [12,6,6] },
                };

                alloGetCss( arraySizes, settings, to );
            }
        );
    }
);

/**
 * Live refresh for font size for:
 * all frontpage sections titles and small headings ( Feature box title, Shop box title, Team box title, Testimonial box title, Blog box title )
 */
wp.customize(
    'allo_section_primary_headings_fs', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'allo-section-primary-headings-fs'
                };

                var arraySizes = {
                    size1: { selectors: 'section.allo-features .allo-title, section.allo-shop .allo-title, section.allo-work .allo-title, section.allo-team .allo-title, section.allo-pricing .allo-title, section.allo-ribbon .allo-title, section.allo-testimonials .allo-title, section.allo-subscribe h2.title, section.allo-blogs .allo-title, section.allo-contact .allo-title', values: [37,24,24], limit: 18 },
                    size2: { selectors: 'section.allo-features .allo-info h4.info-title, section.allo-shop h4.card-title, section.allo-team h4.card-title, section.allo-testimonials h4.card-title, section.allo-blogs h4.card-title, section.allo-contact h4.card-title, section.allo-contact .allo-description h6', values: [18,18,18], correlation: [3,3,3], limit: 14},
                    size3: { selectors: 'section.allo-work h4.card-title, section.allo-contact .allo-description h5', values: [23,23,23], correlation: [3,3,3] },
                    size4: { selectors: 'section.allo-contact .allo-description h1', values: [42,42,42], correlation: [3,3,3] },
                    size5: { selectors: 'section.allo-contact .allo-description h2', values: [37,24,24], correlation: [3,3,3] },
                    size6: { selectors: 'section.allo-contact .allo-description h3', values: [32,32,32], correlation: [3,3,3] },
                    size7: { selectors: 'section.allo-contact .allo-description h4', values: [27,27,27], correlation: [3,3,3] },
                };

                alloGetCss( arraySizes, settings, to );
            }
        );
    }
);
/**
 * Live refresh for font size for:
 * all frontpage sections subtitles
 * WooCommerce pages subtitles ( Single product page price, Cart and Checkout pages subtitles )
 */
wp.customize(
    'allo_section_secondary_headings_fs', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'allo-section-secondary-headings-fs'
                };

                var arraySizes = {
                    size1: { selectors: 'section.allo-features h5.description, section.allo-shop h5.description, section.allo-work h5.description, section.allo-team h5.description, section.allo-testimonials h5.description, section.allo-subscribe h5.subscribe-description, section.allo-blogs h5.description, section.allo-contact h5.description', values: [18,18,18], limit: 12, correlation: [3,3,3] },
                };

                alloGetCss( arraySizes, settings, to );
            }
        );
    }
);

/**
 * Live refresh for font size for:
 * all frontpage sections box content
 */
wp.customize(
    'allo_section_content_fs', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'allo-section-content-fs'
                };

                var arraySizes = {
                    size3: { selectors: 'section.allo-features .allo-info p, section.allo-shop .card-description p', values: [16,16,16], limit: 12, correlation: [3,3,3] },
                    size2: { selectors: 'section.allo-team p.card-description, section.allo-pricing p.text-gray, section.allo-testimonials p.card-description, section.allo-blogs p.card-description, .allo-contact p', values: [14,14,14], limit: 12, correlation: [3,3,3] },
                    size1: { selectors: 'section.allo-shop h6.category, section.allo-work .label-primary, section.allo-team h6.category, section.allo-pricing .card-pricing h6.category, section.allo-testimonials h6.category, section.allo-blogs h6.category', values: [12,12,12], limit: 12, correlation: [3,3,3] },
                };

                alloGetCss( arraySizes, settings, to );
            }
        );
    }
);

/**
 * -------------------
 * Generic options
 * -------------------
 */

/**
 * Live refresh for font size for:
 * Primary menu
 * Footer menu
 */
wp.customize(
    'allo_menu_fs', function (value) {
        'use strict';
        value.bind(
            function( to ) {
                var settings = {
                    cssProperty: 'font-size',
                    propertyUnit: 'px',
                    styleClass: 'allo-menu-fs'
                };

                var arraySizes = {
                    size1: { selectors: '.navbar #main-navigation a, .footer .footer-menu li a', values: [12,12,12], limit: 10 }
                };

                alloGetCss( arraySizes, settings, to );
            }
        );
    }
);