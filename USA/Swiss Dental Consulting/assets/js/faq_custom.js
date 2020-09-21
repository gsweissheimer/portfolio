(function($) { "use strict";


	//Preloader

	Royal_Preloader.config({
        mode:        'scale_text',
        text:        'Swiss Dental Consulting',
        text_colour: '#f8f8f8',
		background:  '#091f40'
	});
	
	
	//Navigation	

	$('ul.slimmenu').on('click',function(){
			var width = $(window).width(); 
			if ((width <= 1200)){ 
			$(this).slideToggle(); 
		}	
	});				
	$('ul.slimmenu').slimmenu(
			{
			resizeWidth: '1200',
			collapserTitle: '',
			easingEffect:'easeInOutQuint',
			animSpeed:'medium',
			indentChildren: true,
			childrenIndenter: '&raquo;'
	});


	
	/* Scroll animation */
	
      window.scrollReveal = new scrollReveal();
	
	
	//Home text fade on scroll	
	
	$(window).scroll(function () { 
        var $Fade = $('.fade-elements');
        //Get scroll position of window 
        var windowScroll = $(this).scrollTop();
        //Slow scroll and fade it out 
        $Fade.css({
            'margin-top': -(windowScroll / 0) + "px",
            'opacity': 1 - (windowScroll / 400)
        });
    });	
	
	/* Scroll Too */
	
			$(window).load(function(){"use strict";
				
				/* Page Scroll to id fn call */
				$("ul.slimmenu li a,a[href='#top'],a[data-gal='m_PageScroll2id']").mPageScroll2id({
					highlightSelector:"ul.slimmenu li a",
					offset: 78,
					scrollSpeed:800,
					scrollEasing: "easeInOutCubic"
				});
				
				/* demo functions */
				$("a[rel='next']").click(function(e){
					e.preventDefault();
					var to=$(this).parent().parent("section").next().attr("id");
					$.mPageScroll2id("scrollTo",to);
				});
				
			});	
			
			
	/* Icons Animation */

	var options = {
	  duration: 200, 
	  type: 'oneByOne',
	  animTimingFunction: Vivus.EASE
	};

	function onComplete() {}	

	
	$(document).ready(function() {

		//Tooltip

		$(".tipped").tipper();
	
		/* Separate Carousels */
	 
	 
		/* Logos Carousel 		
		
		$("#owl-logos").owlCarousel({
			items : 5,
			itemsDesktop : [1000,4], 
			itemsDesktopSmall : [900,3],
			itemsTablet: [600,2], 
			itemsMobile : false, 
			navigation: false,
			pagination : true,
			autoPlay : 3000,
			slideSpeed : 300
		});*/
	
		//Parallax
		
		$('.parallax-1').parallax("50%", 0.2);

		
		//Facts Counter 
	
        $('.counter-numb').counterUp({
            delay: 100,
            time: 2000
        });


	/* Portfolio Sorting */

		(function ($) { 
		
		
			var container = $('#projects-grid');
			
			
			function getNumbColumns() { 
				var winWidth = $(window).width(), 
					columnNumb = 1;
				
				
				if (winWidth > 1500) {
					columnNumb = 4;
				} else if (winWidth > 1200) {
					columnNumb = 3;
				} else if (winWidth > 900) {
					columnNumb = 2;
				} else if (winWidth > 600) {
					columnNumb = 2;
				} else if (winWidth > 300) {
					columnNumb = 1;
				}
				
				return columnNumb;
			}
			
			
			function setColumnWidth() { 
				var winWidth = $(window).width(), 
					columnNumb = getNumbColumns(), 
					postWidth = Math.floor(winWidth / columnNumb);

			}
			
			$('#portfolio-filter #filter a').click(function () { 
				var selector = $(this).attr('data-filter');
				
				$(this).parent().parent().find('a').removeClass('current');
				$(this).addClass('current');
				
				container.isotope( { 
					filter : selector 
				});
				
				setTimeout(function () { 
					reArrangeProjects();
				}, 300);
				
				
				return false;
			});
			
			function reArrangeProjects() { 
				setColumnWidth();
				container.isotope('reLayout');
			}
			
			
			container.imagesLoaded(function () { 
				setColumnWidth();
				
				
				container.isotope( { 
					itemSelector : '.portfolio-box-1', 
					layoutMode : 'masonry', 
					resizable : false 
				} );
			} );
			
			
		
			
		
			$(window).on('debouncedresize', function () { 
				reArrangeProjects();
				
			} );
			
		
		} )(jQuery);

});	
	
 
 
	/* DebouncedResize Function */
		(function ($) { 
			var $event = $.event, 
				$special, 
				resizeTimeout;
			
			
			$special = $event.special.debouncedresize = { 
				setup : function () { 
					$(this).on('resize', $special.handler);
				}, 
				teardown : function () { 
					$(this).off('resize', $special.handler);
				}, 
				handler : function (event, execAsap) { 
					var context = this, 
						args = arguments, 
						dispatch = function () { 
							event.type = 'debouncedresize';
							
							$event.dispatch.apply(context, args);
						};
					
					
					if (resizeTimeout) {
						clearTimeout(resizeTimeout);
					}
					
					
					execAsap ? dispatch() : resizeTimeout = setTimeout(dispatch, $special.threshold);
				}, 
				threshold : 150 
			};
		} )(jQuery);






	
	
	 // Portfolio Ajax
	 
			$(window).load(function() {
			'use strict';		  
			  var loader = $('.expander-wrap');
			if(typeof loader.html() == 'undefined'){
				$('<div class="expander-wrap"><div id="expander-wrap" class="container clearfix relative"><p class="cls-btn"><a class="close">X</a></p><div/></div></div>').css({opacity:0}).hide().insertAfter('.portfolio');
				loader = $('.expander-wrap');
			}
			$('.expander').on('click', function(e){
				e.preventDefault();
				e.stopPropagation();
				var url = $(this).attr('href');



				loader.slideUp(function(){
					$.get(url, function(data){
						var portfolioContainer = $('.portfolio');
						var topPosition = portfolioContainer.offset().top;
						var bottomPosition = topPosition + portfolioContainer.height();
						$('html,body').delay(600).animate({ scrollTop: bottomPosition - 70}, 800);
						var container = $('#expander-wrap>div', loader);
						
						container.html(data);
						
						$("#owl-portfolio-slider").owlCarousel({
							  
							pagination:true,
							slideSpeed : 300,
							autoPlay : 5000,
							singleItem:true							
						 
						});
						
						$(".container").fitVids();
						
						$('.vimeo a,.youtube a').click(function (e) {
							e.preventDefault();
							var videoLink = $(this).attr('href');
							var classeV = $(this).parent();
							var PlaceV = $(this).parent();
							if ($(this).parent().hasClass('youtube')) {
								$(this).parent().wrapAll('<div class="video-wrapper">');
								$(PlaceV).html('<iframe frameborder="0" height="333" src="' + videoLink + '?autoplay=1&showinfo=0" title="YouTube video player" width="547"></iframe>');
							} else {
								$(this).parent().wrapAll('<div class="video-wrapper">');
								$(PlaceV).html('<iframe src="' + videoLink + '?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1&amp;color=cfa144" width="500" height="281" frameborder="0"></iframe>');
							}
						});	
						
						loader.slideDown(function(){
							if(typeof keepVideoRatio == 'function'){
								keepVideoRatio('.container > iframe');
							}
						}).delay(1000).animate({opacity:1}, 200);
					});
				});
			});
			
			$('.close', loader).on('click', function(){
				loader.delay(300).slideUp(function(){
					var container = $('#expander-wrap>div', loader);
					container.html('');
					$(this).css({opacity:0});
					
				});
				var portfolioContainer = $('.portfolio');
					var topPosition = portfolioContainer.offset().top;
					$('html,body').delay(0).animate({ scrollTop: topPosition - 70}, 500);
			});
			
	});		
	
  })(jQuery); 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 
 





		

/**
 * SMK Accordion jQuery Plugin v1.3
 * ----------------------------------------------------
 * Author: Smartik
 * Author URL: http://smartik.ws/
 * License: MIT
 */
;(function ( $ ) {

    $.fn.smk_Accordion = function( options ) {
        
        if (this.length > 1){
            this.each(function() { 
                $(this).smk_Accordion(options);
            });
            return this;
        }
        
        // Defaults
        var settings = $.extend({
            animation:  true,
            showIcon:   true,
            closeAble:  false,
            closeOther: true,
            slideSpeed: 150,
            activeIndex: false
        }, options );
    
        if( $(this).data('close-able') )    settings.closeAble = $(this).data('close-able');
        if( $(this).data('animation') )     settings.animation = $(this).data('animation');
        if( $(this).data('show-icon') )     settings.showIcon = $(this).data('show-icon');
        if( $(this).data('close-other') )   settings.closeOther = $(this).data('close-other');
        if( $(this).data('slide-speed') )   settings.slideSpeed = $(this).data('slide-speed');
        if( $(this).data('active-index') )  settings.activeIndex = $(this).data('active-index');
    
        // Cache current instance
        // To avoid scope issues, use 'plugin' instead of 'this'
        // to reference this class from internal events and functions.
        var plugin = this;
    
        //"Constructor"
        var init = function() {
            plugin.createStructure();
            plugin.clickHead();
        }
    
        // Add .smk_accordion class
        this.createStructure = function() {
    
            //Add Class
            plugin.addClass('smk_accordion');
            if( settings.showIcon ){
                plugin.addClass('acc_with_icon');
            }
    
            //Create sections if they were not created already
            if( plugin.find('.accordion_in').length < 1 ){
                plugin.children().addClass('accordion_in');
            }
    
            //Add classes to accordion head and content for each section
            plugin.find('.accordion_in').each(function(index, elem){
                var childs = $(elem).children();
                $(childs[0]).addClass('acc_head');
                $(childs[1]).addClass('acc_content');
            });
            
            //Append icon
            if( settings.showIcon ){
                plugin.find('.acc_head').prepend('<div class="acc_icon_expand"></div>');
            }
    
            //Hide inactive
            plugin.find('.accordion_in .acc_content').not('.acc_active .acc_content').hide();
    
            //Active index
            if( settings.activeIndex === parseInt(settings.activeIndex) ){
                if(settings.activeIndex === 0){
                    plugin.find('.accordion_in').addClass('acc_active').show();
                    plugin.find('.accordion_in .acc_content').addClass('acc_active').show();
                }
                else{
                    plugin.find('.accordion_in').eq(settings.activeIndex - 1).addClass('acc_active').show();
                    plugin.find('.accordion_in .acc_content').eq(settings.activeIndex - 1).addClass('acc_active').show();
                }
            }
            
        }
    
        // Action when the user click accordion head
        this.clickHead = function() {
    
            plugin.on('click', '.acc_head', function(){
                
                var s_parent = $(this).parent();
                
                if( s_parent.hasClass('acc_active') == false ){
                    if( settings.closeOther ){
                        plugin.find('.acc_content').slideUp(settings.slideSpeed);
                        plugin.find('.accordion_in').removeClass('acc_active');
                    }	
                }
    
                if( s_parent.hasClass('acc_active') ){
                    if( false !== settings.closeAble ){
                        s_parent.children('.acc_content').slideUp(settings.slideSpeed);
                        s_parent.removeClass('acc_active');
                    }
                }
                else{
                    $(this).next('.acc_content').slideDown(settings.slideSpeed);
                    s_parent.addClass('acc_active');
                }
    
            });
    
        }
    
        //"Constructor" init
        init();
        return this;
    
    };
    
    
    }( jQuery ));

    
	
		$(".accordion").smk_Accordion({
			closeAble: true 
		});