(function ($) {
 "use strict";
	/*----------------------------
	jQuery MeanMenu
	------------------------------ */
	//Clone Mobile Menu
	function cloneMobileMenu($cloneItem, $mobileLoc) {
		var $combinedmenu = $($cloneItem).clone();
		$combinedmenu.appendTo($mobileLoc);
	}

	cloneMobileMenu(".main-header .main-menu .mainmenu", ".mobile-menu-area .mobile-menu #dropdown");

	jQuery('nav#dropdown').meanmenu();

	var $submenuIndicator = $('.main-header ul > li > .dropdown-menu, .main-header-two ul > li > .dropdown-menu');
	$submenuIndicator.prev().append('<span class="caret"></span>');

	function debouncer(func, timeout) {
	    var timeoutID, timeout = timeout || 500;
	    return function () {
	        var scope = this,
	            args = arguments;
	        clearTimeout(timeoutID);
	        timeoutID = setTimeout(function () {
	            func.apply(scope, Array.prototype.slice.call(args));
	        }, timeout);
	    }
	}
	function resized() {
	    if ($(window).width() <= 991) {
	    	$("li.dropdown").on('mouseenter', function() {
	    		$(this).children('.dropdown-menu').stop();
	    		$(this).addClass('not-open'); 
	    	}); 	

	    	$("li.dropdown").on('mouseleave', function() {
	    		$(this).children('.dropdown-menu').stop();
	    		$(this).removeClass('not-open'); 
	    	});
	    } else {
	    	$("li.dropdown").on('mouseenter', function() {
	    		$(this).children('.dropdown-menu').slideDown("400");
	    		$(this).addClass('open'); 
	    	}); 	

	    	$("li.dropdown").on('mouseleave', function() {
	    		$(this).children('.dropdown-menu').slideUp("400");
	    		$(this).removeClass('open'); 
	    	});
	    };
	}
	resized();

	var prevW = window.innerWidth || $(window).width();
	$(window).resize(debouncer(function (e) {
	    var currentW = window.innerWidth || $(window).width();
	    if (currentW != prevW) {
	        resized();
	    }
	    prevW = window.innerWidth || $(window).width();
	}));	

	$('#menu-topo').hide();   	


	var menuaberto = false;
  	$('.btn-collapse').click(function(event) {
    	event.preventDefault();
    	$('#menu-topo').toggle('');
	    if(menuaberto == true){
	    	menuaberto = false;
	    	$(".lista-collapse:nth-child(1)").removeClass('botao-lista-cima');
	    	$(".lista-collapse:nth-child(2)").removeClass('hidden');
	    	$(".lista-collapse:nth-child(3)").removeClass('botao-lista-baixo');
	    } else {
	      	menuaberto = true;
	      	$(".lista-collapse:nth-child(1)").addClass('botao-lista-cima');
	       	$(".lista-collapse:nth-child(2)").addClass('hidden');
	      	$(".lista-collapse:nth-child(3)").addClass('botao-lista-baixo');
	    }
  	});
	/*----------------------------
	Post Video
	------------------------------ */
    var $postVideo = $('.blog-single-page');
    $postVideo.fitVids();

    /*----------------------------
    Tooltips
    ------------------------------ */
	$('i.property-favorites').tooltip();


	/*----------------------------
	Bootstrap Touch Slider
	------------------------------ */
	if($('#bootstrap-touch-slider').length) {
		$('#bootstrap-touch-slider').bsTouchSlider();
	}

	/*----------------------------
	wow js active
	------------------------------ */
	new WOW().init();

	/*----------------------------
	Click on QUANTITY
	------------------------------ */
	$(".btn-minus").on("click",function(){
		var now = $(".section > div > input").val();
		if ($.isNumeric(now)){
		if (parseInt(now) -1 > 0){ now--;}
		$(".pro-button > ul > li > input").val(now);
		} else{
			$(".pro-button > ul > li > input").val("1");
		}
	});            

	$(".btn-plus").on("click",function(){
		var now = $(".pro-button > ul > li > input").val();
		if ($.isNumeric(now)){
		$(".pro-button > ul > li > input").val(parseInt(now)+1);
		} else{
			$(".pro-button > ul > li > input").val("1");
		}
	});

	$(".minus1").on("click",function(){
		var now = $(".section > div > input").val();
		if ($.isNumeric(now)){
		if (parseInt(now) -1 > 0){ now--;}
		$(".order1 >  input").val(now);

		} else{
			$(".order1 >  input").val("1");
		}
	});            

	$(".plus1").on("click",function(){
		var now = $(".order1 >  input").val();
		if ($.isNumeric(now)){
			$(".order1 > input").val(parseInt(now)+1);
		} else{
			$(".order1 >  input").val("1");
		}
	});

	$(".minus2").on("click",function(){
		var now = $(".section > div > input").val();
		if ($.isNumeric(now)){
		if (parseInt(now) -1 > 0){ now--;}
			$(".order2 >  input").val(now);
		} else{
			$(".order2 >  input").val("1");
		}
	});            

	$(".plus2").on("click",function(){
		var now = $(".order2 >  input").val();
		if ($.isNumeric(now)){
			$(".order2 > input").val(parseInt(now)+1);
		} else{
			$(".order2 >  input").val("1");
		}
	});

	$(".minus3").on("click",function(){
		var now = $(".section > div > input").val();
		if ($.isNumeric(now)){
		if (parseInt(now) -1 > 0){ now--;}
			$(".order3 >  input").val(now);
		} else{
			$(".order3 >  input").val("1");
		}
	});            

	$(".plus3").on("click",function(){
		var now = $(".order3 >  input").val();
		if ($.isNumeric(now)){
		 $(".order3 > input").val(parseInt(now)+1);
		} else{
			$(".order3 >  input").val("1");
		}
	});

	/*----------------------------
	Slider Two owl active
	------------------------------ */  
	$(".slider-two").owlCarousel({
		autoPlay: true, 
		slideSpeed:2000,
		pagination:true,
		navigation:false,	  
		items : 1,
		navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		itemsDesktop : [1199,1],
		itemsDesktopSmall : [980,1],
		itemsTablet: [768,1],
		itemsMobile : [479,1],
	});

	/*----------------------------
	Client Slider
	------------------------------ */
	$(".client-slider").owlCarousel({
		autoPlay: true, 
		slideSpeed:2000,
		pagination:false,
		navigation:false,	  
		items : 10,
		navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		itemsDesktop : [1199,5],
		itemsDesktopSmall : [980,3],
		itemsTablet: [768,2],
		itemsMobile : [479,2],
	});

	/*----------------------------
	Product Banner Slider
	------------------------------ */
	$(".product-banner-slider").owlCarousel({
		autoPlay: true, 
		slideSpeed:2000,
		pagination:true,
		navigation:false,	  
		items : 1,
		navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		itemsDesktop : [1199,1],
		itemsDesktopSmall : [980,1],
		itemsTablet: [768,1],
		itemsMobile : [479,1],
	});

	/*----------------------------
	Blog Three Slider
	------------------------------ */
	$(".blog-slider-three").owlCarousel({
		autoPlay: true, 
		slideSpeed:2000,
		pagination:false,
		navigation:false,	  
		items : 3,
		navigationText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		itemsDesktop : [1199,3],
		itemsDesktopSmall : [980,3],
		itemsTablet: [768,2],
		itemsMobile : [479,1],
	});

	/*--------------------------
	Jarallax active
	---------------------------- */
	$('.jarallax').jarallax({
		speed: 0.5
	});

	/*----------------------------
	slick active
	------------------------------*/
	$('.blog-two-slider').slick({
	  centerMode: true,
	  slidesToShow: 3,
	  responsive: [
	    {
	      breakpoint: 768,
	      settings: {
	        arrows: false,
	        centerMode: true,
	        slidesToShow: 2
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        arrows: false,
	        centerMode: true,
	        slidesToShow: 1
	      }
	    }
	  ]
	});

	/*----------------------------
	isotope active
	------------------------------*/     
	$(window).on('load', function() {
		var $grid = $('.grid').isotope({
		    itemSelector: '.grid-item',
		    stagger: 30
		});
	});
	$('.product-menu').on( 'click', '.button', function() {
		var filterValue = $(this).attr('data-filter');
		var $grid2 = $('.grid');
		$grid2.isotope({ filter: filterValue });
	});

	// change is-checked class on buttons
	$('.filter').each( function( i, buttonGroup ) {
		var $buttonGroup = $( buttonGroup );
			$buttonGroup.on( 'click', '.button', function() {
			$buttonGroup.find('.is-checked').removeClass('is-checked');
			$( this ).addClass('is-checked');
		});
	});
	/*--------------------------
	 List-Grid view
	---------------------------- */
	$('#list').on('click',function(event){
		event.preventDefault();
		$('#products .item').addClass('page-single-product');
	});

	$('#grid').on('click',function(event){
		event.preventDefault();
		$('#products .item').removeClass('page-single-product');
		$('#products .item').addClass('grid-group-item');
	});

	/*--------------------------
	 countdown
	---------------------------- */
	if($('.count-list').length) {
		var getDate = $('.bestdeal-date').val();
		var getZone = $('.bestdeal-timezone').val();
		$('.count-list').downCount({
			date: ''+getDate+' '+ getZone+'',
		    offset: 16
		});
	}

	/*----------------------------
	Magnific Popup
	------------------------------ */
	$('.gallery').magnificPopup({
		delegate: 'a',
		type: 'image',
		closeOnContentClick: false,
		closeBtnInside: false,
		mainClass: 'mfp-with-zoom mfp-img-mobile',
		image: {
			verticalFit: true,
			titleSrc: function(item) {
				return item.el.attr('title') + ' &middot; <a class="image-source-link" href="'+item.el.attr('data-source')+'" target="_blank">image source</a>';
			}
		},
		gallery: {
			enabled: true
		},
		zoom: {
			enabled: true,
			duration: 300, // don't foget to change the duration also in CSS
			opener: function(element) {
				return element.find('img');
			}
		}
	});

	$('.view-item').each(function () {
	    $(this).magnificPopup({
	        delegate: 'a',
	        gallery: {
	            enabled: true
	        },
	        type: 'image'
	    });
	});

	/*----------------------------
	range-slider active
	------------------------------ */  
	if($( "#range-price" ).length) {	
		$( "#range-price" ).slider({
			range: true,
			min: 40,
			max: 600,
			values: [ 120, 420 ],
			slide: function( event, ui ) {
				$( "#price" ).val( "$" + ui.values[ 0 ] );
				$( "#price2" ).val( "$" + ui.values[ 1 ] );
			}
		});
		$( "#price" ).val( "$" + $( "#range-price" ).slider( "values", 0 ));  
		$( "#price2" ).val( "$" + $( "#range-price" ).slider( "values", 1 ));  
	}

	/*--------------------------
	scrollUp
	---------------------------- */	
	$.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    }); 

    var $brandSlider = $(".best-seller-carousel");
    $brandSlider.owlCarousel({
    	items: 4,
    	itemsDesktop : [1199, 4],
    	itemsDesktopSmall : [980,3],
    	itemsTablet: [768,2],
    	itemsMobile : [479,1]
    });
    $brandSlider.each(function() {
        var $this = $(this),
            $next_element = $('.best-seller-navigation .fa-chevron-left'),
            $previous_element = $('.best-seller-navigation .fa-chevron-right');

        $next_element.on('click', function(e) {
        	e.preventDefault();
            $brandSlider.trigger('owl.next');
        });
        $previous_element.on('click', function(e) {
        	e.preventDefault();
            // With optional speed parameter
            // Parameters has to be in square bracket '[]'
            $brandSlider.trigger('owl.prev');
            
        });
    });	  

    /*----------------------------
    Featured Products
    ------------------------------ */
    var $brandSlider2 = $(".featured-products-carousel");
    $brandSlider2.owlCarousel({
    	items: 4,
    	itemsDesktop : [1199, 4],
    	itemsDesktopSmall : [980,3],
    	itemsTablet: [768,2],
    	itemsMobile : [479,1]
    });
    $brandSlider2.each(function() {
        var $this = $(this),
            $next_element = $('.fet-seller-navigation .fa-chevron-left'),
            $previous_element = $('.fet-seller-navigation .fa-chevron-right');

        $next_element.on('click', function(e) {
        	e.preventDefault();
            $brandSlider2.trigger('owl.next');
        });
        $previous_element.on('click', function(e) {
        	e.preventDefault();
            // With optional speed parameter
            // Parameters has to be in square bracket '[]'
            $brandSlider2.trigger('owl.prev');
            
        });
    });	    

    /*----------------------------
    New Products Carousel
    ------------------------------ */
    var $brandSlider3 = $(".new-products-carousel");
    $brandSlider3.owlCarousel({
    	items: 4,
    	itemsDesktop : [1199, 4],
    	itemsDesktopSmall : [980,3],
    	itemsTablet: [768,2],
    	itemsMobile : [479,1]
    });
    $brandSlider3.each(function() {
        var $this = $(this),
            $next_element = $('.new-seller-navigation .fa-chevron-left'),
            $previous_element = $('.new-seller-navigation .fa-chevron-right');

        $next_element.on('click', function(e) {
        	e.preventDefault();
            $brandSlider3.trigger('owl.next');
        });
        $previous_element.on('click', function(e) {
        	e.preventDefault();
            // With optional speed parameter
            // Parameters has to be in square bracket '[]'
            $brandSlider3.trigger('owl.prev');
            
        });
    });	  
})(jQuery); 