/**
 * cesis_custom.js
 *
 **/

var jc = jQuery;

jc.noConflict();

'use strict';


jc(document).ready(function() {
    vc_rowBehaviour();
    cesis_initVideoBackgrounds();
    cesis_owl_carousel();
    cesis_row();
    cesis_text_resize();
    set_center_logo();
    cesis_section_swipe();
    cesis_scroll_fn();
    cesis_to_top();
    cesis_tabs();
    vc_progress_bar();
    vc_waypoints();
    cesis_circular_progress_bar();
    cesis_animated_number();
    cesis_accordion();
    cesis_video();
    cesis_lightbox();
    cesis_like();
    cesis_menu();
    cesis_gmaps();
    cesis_isotope();
    cesis_fixed_footer();
    cesis_sticky();
    window.setTimeout(vc_waypoints, 500);
    cesis_resize();



});

if ('function' !== typeof(window['cesis_resize'])) {

window.cesis_resize = function() {
    jc(window).resize(function () {
            setTimeout(function () {
              vc_rowBehaviour();
              cesis_text_resize();
            }, 500);
    });
    document.addEventListener("visibilitychange", function() {
            setTimeout(function () {
              vc_rowBehaviour();
              cesis_text_resize();
            }, 500);
    });
  }
}

if ('function' !== typeof(window['cesis_initVideoBackgrounds'])) {

window.cesis_initVideoBackgrounds = function() {
    jc("[data-vc-vimeo-video-bg]").each(function() {
        var vimeoUrl, vimeoId, $element = jc(this);
        $element.data("vc-vimeo-video-bg") ? (vimeoUrl = $element.data("vc-vimeo-video-bg"), vimeoId = ttExtractVimeoId(vimeoUrl), vimeoId && ($element.find(".vc_video-bg").remove(), insertVimeoVideoAsBackground($element, vimeoId)), jc(window).on("grid:items:added", function(event, $grid) {
            $element.has($grid).length && vcResizeVideoBackground($element)
        })) : $element.find(".vc_video-bg").remove()
    })
    jc("[data-vc-sh-video-bg]").each(function() {
        var $element = jc(this);
        var videoUrl = $element.data("vc-sh-video-bg");
         $element.find(".vc_video-bg").remove();
         $element.prepend('<video playsinline class="cesis_sh_video_bg" preload="auto" autoplay="true" loop="loop" muted="muted" data-top-default="0" style="top: 0px;"><source src="'+videoUrl+'"></video>');
    })

  }
}



function insertVimeoVideoAsBackground($element, vimeoId, counter) {
    if ("undefined" == typeof YT || void 0 === YT.Player) return 100 < (counter = void 0 === counter ? 0 : counter) ? void console.warn("Too many attempts to load Vimeo api") : void setTimeout(function() {
        insertVimeoVideoAsBackground($element, vimeoId, counter++)
    }, 100);
    var $container = $element.prepend('<div class="vc_video-bg vc_hidden-xs"><div class="inner"><iframe frameborder="0" src="//player.vimeo.com/video/'+vimeoId+'?background=1&amp;api=1&amp;title=0&amp;byline=0&amp;portrait=0&amp;playbar=0&amp;loop=1&amp;autoplay=1"></iframe></div></div>').find(".inner");
    vcResizeVideoBackground($element), jc(window).on('resize', function() {
        vcResizeVideoBackground($element)
    })
}


function vcResizeVideoBackground($element) {
    var iframeW, iframeH, marginLeft, marginTop, containerW = $element.innerWidth(),
        containerH = $element.innerHeight();
    containerW / containerH < 16 / 9 ? (iframeW = containerH * (16 / 9), iframeH = containerH, marginLeft = -Math.round((iframeW - containerW) / 2) + "px", marginTop = -Math.round((iframeH - containerH) / 2) + "px", iframeW += "px", iframeH += "px") : (iframeW = containerW, iframeH = containerW * (9 / 16), marginTop = -Math.round((iframeH - containerH) / 2) + "px", marginLeft = -Math.round((iframeW - containerW) / 2) + "px", iframeW += "px", iframeH += "px"), $element.find(".vc_video-bg iframe").css({
        maxWidth: "1000%",
        marginLeft: marginLeft,
        marginTop: marginTop,
        width: iframeW,
        height: iframeH
    })
}

function ttExtractVimeoId(url) {
    if (void 0 === url) return !1;
    var id = url.match(/(https?:\/\/)?(www\.)?(player\.)?vimeo\.com\/([a-z]*\/)*([‌​0-9]{6,11})[?]?.*/);
    return null !== id && id[5]

}


//////////////////////////
//***      Menu     ***//
////////////////////////


if ('function' !== typeof(window['cesis_menu'])) {
  window.cesis_menu = function() {
    var isMobile = jc('body').hasClass('touch') ? true : false;
    if(jc('.admin-bar').length && jc('.header_vertical').length){
        jc('.header_vertical').css('top', '32px')
    }
    if(jc('.cesis_menu_overlay').length || jc('.cesis_offcanvas_switch').length || jc('.header_vertical').length  ){
      jc('.cesis_megamenu').removeClass('cesis_megamenu');
      jc('.mega_no_heading').removeClass('mega_no_heading');

    }
    if(jc('.cesis_megamenu').length){
      jc('.tt-main-navigation .cesis_megamenu > ul').addClass('mega-menu');
    }
		if (jc('[class*="smart_menu"]').length > 0) {
			jc('[class*="smart_menu"]').smartmenus({
        mainMenuSubOffsetX: -1,
		    subMenusSubOffsetX: 0,
		    subMenusSubOffsetY: 0,
        subMenusMaxWidth:'200px',
        subMenusMinWidth:'13em',
        subIndicators:false,
        hideFunction:null,
        hideDuration:0,
        hideTimeout:400,
        showFunction:null,
        showDuration:0,
        showTimeout:0,
      });

      jc('.mobile-menu').smartmenus({
        mainMenuSubOffsetX: -1,
		    subMenusSubOffsetX: 0,
		    subMenusSubOffsetY: 0,
        subMenusMaxWidth:'200px',
        subMenusMinWidth:'13em',
        subIndicators:true,
        hideFunction:null,
        hideDuration:0,
        hideTimeout:400,
        showFunction:null,
        showDuration:0,
        showTimeout:0,
      });

		}
    if (jc('.menu_fill').length > 0) {
      var total_menu_items = jc('nav.menu_fill .menu-main-ct > ul > li').length;
      if (jc('.header_sub').length) {
        var logo_size = 0;
        if(jc('.tt-sub-additional').length){
          var add_size = jc('.tt-sub-additional .tt-left-additional').outerWidth()+jc('.tt-sub-additional .tt-right-additional').outerWidth();
        }else {
          var add_size = 0;
        }
      }else{
        if (jc('.header_logo').length) {
        var logo_size = jc('.header_logo').width();
        }else {
        var logo_size = 0;
        }
        if(jc('.tt-main-additional').length){
          var add_size = jc('.tt-main-additional').outerWidth();
        }else {
          var add_size = 0;
        }
      }
      jc('nav.menu_fill .menu-main-ct > ul').css('width','calc(100% - '+(logo_size+add_size+80)+'px)');
      jc('nav.menu_fill .menu-main-ct > ul > li').css('width','calc((100% - 1px) / '+total_menu_items+')');
    }
    if (jc('.search-menu a').length > 0) {

      jc('.search-menu:not(.cesis_search_dropdown) a').on('click', function(e){
        e.preventDefault()
        jc('.cesis_search_overlay').addClass('overlay_on');
        setTimeout(function() {
          jc( ".search-field" ).focus();
        }, 400);

      })
    }
    if (jc('.cesis_search_close').length > 0) {
      jc('.cesis_search_close').on('click', function(e){
        e.preventDefault()
        jc('.cesis_search_overlay').removeClass('overlay_on');
      })
    }
    if (jc('.cesis_menu_button').length > 0) {
      jc('.cesis_mobile_menu_switch').on('click', function(){
      var admin_bar;
      if(jc('.admin-bar').length && !window.matchMedia('(max-width: 600px)').matches){
        admin_bar = jc('#wpadminbar').outerHeight();
      }else if(document.body.scrollTop === 0 && jc('.admin-bar').length && window.matchMedia('(max-width: 600px)').matches){
        admin_bar = jc('#wpadminbar').outerHeight();
      }else{
        admin_bar = 0;
      }
      var differencial_height = jc('#cesis_header').outerHeight() + admin_bar;
      var mobile_height = 'calc( 100vh - '+differencial_height+'px)';
      jc('.header_mobile').css('max-height', mobile_height);
      if(isMobile == true){ jc('.header_mobile').css('height', mobile_height); }
      if (jc(this).hasClass('open')) {
        jc(this).removeClass('open');
        jc(this).addClass('closing');
        jc('.header_mobile').slideToggle(400);
        setTimeout(function() {
          jc('.closing').removeClass('closing');
        }, 400);
      } else{
        jc(this).addClass('open');
        jc('.header_mobile').slideToggle(400);
      }
      })

      jc('.cesis_offcanvas_switch').on('click', function(){
        var oc_ctn =  jc('body.cesis_offcanvas_header .header_top_bar,body.cesis_offcanvas_header .header_main,body.cesis_offcanvas_header .header_offcanvas,body.cesis_offcanvas_header #main-content,body.cesis_offcanvas_header #cesis_colophon');
        oc_ctn.addClass('cesis_offcanvas_opened');
        if (jc(this).hasClass('open')) {
					jc(this).removeClass('open');
					jc(this).addClass('closing');
          oc_ctn.removeClass('cesis_offcanvas_opened');
					setTimeout(function() {
						jc('.closing').removeClass('closing');
					}, 400);
				} else jc(this).addClass('open');
      })

      jc('.cesis_menu_overlay').on('click', function(){
        if (jc(this).hasClass('open')) {
					jc(this).removeClass('open');
          jc('.cesis_menu_overlay_close').removeClass('open');
          jc('.header_overlay').removeClass('overlay_on');
					jc(this).addClass('closing');
					setTimeout(function() {
						jc('.closing').removeClass('closing');
          }, 400);
          setTimeout(function() {
            jc('#cesis_header').removeClass('overlay_menu_on');
          }, 600);
				} else{
         jc('#cesis_header').addClass('overlay_menu_on');
         jc(this).addClass('open');
         var pos_top   = jc(this)[0].getBoundingClientRect().top;
         var pos_right = (jc(window).width() - (jc(this).offset().left + jc(this).outerWidth()));
         jc('.cesis_menu_overlay_close').css('top', pos_top);
         if(jc('.logo_left').length > 0){
          jc('.cesis_menu_overlay_close').css('right',pos_right);
        }else jc('.cesis_menu_overlay_close').css('left',jc(this).offset().left);
         jc('.cesis_menu_overlay_close').addClass('open');
         jc('.header_overlay').addClass('overlay_on');
        }
      })
      jc('.cesis_menu_overlay_close').on('click', function(){
        if (jc(this).hasClass('open')) {
					jc(this).removeClass('open');
          jc('.cesis_menu_overlay').removeClass('open');
          jc('.header_overlay').removeClass('overlay_on');
					jc(this).addClass('closing');
          jc('.cesis_search_overlay').removeClass('overlay_on');
					setTimeout(function() {
						jc('.closing').removeClass('closing');
					}, 400);
          setTimeout(function() {
            jc('#cesis_header').removeClass('overlay_menu_on');
          }, 600);

				}else{
          jc('#cesis_header').addClass('overlay_menu_on');
          jc(this).addClass('open');
          jc('.cesis_menu_overlay').addClass('open');
          jc('.header_overlay').addClass('overlay_on');
        }
      })
	   };
	 };
}



////////////////////////////////
//***    Sticky  footer   ***//
//////////////////////////////



if ('function' !== typeof(window['cesis_fixed_footer'])) {
      window.cesis_fixed_footer = function() {
        if(jc('.cesis_fixed_footer').length){
          var footer_height = jc('.site-footer').outerHeight();
          jc('#wrap_all').css('margin-bottom', footer_height );
          jc( window ).resize(function () {
            var footer_height = jc('.site-footer').outerHeight();
            jc('#wrap_all').css('margin-bottom', footer_height );
          })
        }
      };
}

//////////////////////////
//***    Sticky     ***//
////////////////////////



if ('function' !== typeof(window['cesis_sticky'])) {
      window.cesis_sticky = function() {
        var isMobile = jc('body').hasClass('touch') ? true : false;
        if(jc('.cesis_sticky').length){
          var menuposition;
          var menu_content_offset = jc('#header_container').outerHeight() - jc('.cesis_sticky').outerHeight();
          jc('#header_container').css('min-height', jc('#header_container').outerHeight() );
          if(jc('.admin-bar').length && !window.matchMedia('(max-width: 600px)').matches){
            menuposition = jc('#header_container').offset().top - jc('#wpadminbar').outerHeight() + menu_content_offset;
          }else{
            menuposition = jc('#header_container').offset().top + menu_content_offset;
          }
          jc( window ).resize(function () {
  					setTimeout(function() {
              jc('#header_container').css('min-height', jc('.cesis_sticky').outerHeight() );
            }, 500);
            if(jc('.admin-bar').length && !window.matchMedia('(max-width: 600px)').matches){
              menuposition = jc('#header_container').offset().top - jc('#wpadminbar').outerHeight() + menu_content_offset;
            }else{
              menuposition = jc('#header_container').offset().top + menu_content_offset;
            }
          })
          jc( window ).scroll(function(event) {
            if (jc(window).scrollTop() > menuposition) {
              jc('.cesis_sticky').addClass('cesis_stuck');
            } else {
              jc('.cesis_sticky').removeClass('cesis_stuck');
            }
          });
        }
        if(jc('.cesis_header_hiding').length && isMobile == false){
          // Hide Header on on scroll down
          var didScroll;
          var delta = 5;
          var navbarHeight = jc('#header_container').outerHeight() + jc('.cesis_header_hiding').outerHeight();
          var lastScrollTop = jc('#header_container').offset().top + jc('.cesis_header_hiding').outerHeight();
          var firstTop = jc('#header_container').offset().top + jc('.cesis_sticky').outerHeight();
          /* var lastScrollTop = 0; */

          jc(window).scroll(function(event){
            if (jc(window).scrollTop() > menuposition) {
              didScroll = true;
              hasScrolled();
            }
          });

          function hasScrolled() {
              var st = jc(window).scrollTop();
              // Make sure they scroll more than delta
              if(Math.abs(lastScrollTop - st) <= delta){
                  return;
                }

              // If they scrolled down and are past the navbar, add class .nav-up.
              // This is necessary so you never see what is "behind" the navbar.
              if (st > lastScrollTop && st > navbarHeight){
                  // Scroll Down
                  jc('.cesis_header_hiding').css('margin-top', -jc('.cesis_header_hiding').outerHeight());
                  jc('.cesis_header_hiding').addClass('.cesis_header_hidden');
              } else {
                  // Scroll Up
                  if(st + jc(window).height() < jc(document).height()) {
                  jc('.cesis_header_hiding').removeClass('.cesis_header_hidden');
                  jc('.cesis_header_hiding').css('margin-top', '0');
                  }
              }
              if (st > firstTop){
                lastScrollTop = st;
              }else{
                lastScrollTop = firstTop;
              }
          }
        }

      };
}

//////////////////////////
//***   Google map  ***//
////////////////////////





if ('function' !== typeof(window['cesis_gmaps'])) {
      window.cesis_gmaps = function() {

        buildMap = function(e, config) {
          e.addClass('-map-was-initiated');

          var mapOptions = {
            zoom: Number(config.zoom),
            center: new google.maps.LatLng(Number(config.center.latitude), Number(config.center.longitude)),

            zoomControl: config.controls.zoom,
            mapTypeControl: config.controls.maptype,
            scaleControl: config.controls.scale,
            streetViewControl: config.controls.streetview,
            rotateControl: config.controls.rotate,
            fullscreenControl: config.controls.fullscreen,
            scrollwheel: config.controls.scrollwheel
          };

          if( config.style != '' ) {  mapOptions.styles = JSON.parse(config.style) }

          var mapElement = e.get(0);
          var map = new google.maps.Map(mapElement, mapOptions);

          // Add Markers
          if ( config.markers != '' ) {
            var infowindow = [];
            var eee =  config.markers;
            jc.each(eee, function( index, value ) {
              var _marker = {
                position: new google.maps.LatLng(value.marker_latitude, value.marker_longitude),
                map: map,
                animation: google.maps.Animation.DROP
              };

              // Add Image
              if( value.image != '' ) {
                console.log(value.image);
                _marker.icon = value.image; }

              // Add Title
              if( value.marker_title != '' ) { _marker.title = value.marker_title; }

              // Add Description
              if( value.description != '' ) {
                var infoWindow_Object = {
                  content: '<div><strong>' + value.marker_title + '</strong><br>' + value.marker_description + '</div>'
                };

                // Add Max Width
                if( value.maxwidth ) { infoWindow_Object.maxWidth = value.maxwidth; }

                infowindow[index] = new google.maps.InfoWindow(infoWindow_Object);
              }

              // Add Maker
              var marker = new google.maps.Marker(_marker);

              // Bind Click
              if( value.description != '' ) {
                marker.addListener( 'click', function() {
                  infowindow[index].open( map, marker );
                } );
              }
            });
          }

                        // FullScreen Button
                        e.find('.-fullscreen').on('click', function(){
                          $el.toggleClass('-fullscreen-mode');
                          google.maps.event.trigger(map, 'resize');
                          map.setCenter(mapOptions.center);
                          return false;
                        });
                      };

          jc('.cesis_gmaps').each(function() {




            var e = jc(this);
              var config = e.data('mapcf' );
              buildMap(e, config);

              if( e.hasClass('-map-was-initiated') )
                return;

              if(typeof config == 'undefined')
                return;

              if(typeof google == 'undefined')
                return;

              config.center.latitude = config.center.latitude.replace(/[^\d.-]/g, '');
              config.center.longitude = config.center.longitude.replace(/[^\d.-]/g, '');

              // Start Map






          });
      }
}

//////////////////////////
//***   Ajax posts  ***//
////////////////////////



var aloader = jc('.load_more_btn');
aloader.on('click', load_ajax_posts);

// navigation function


jc('.cesis_navigation_ctn:not(.cesis_classic_navigation)').on('click', 'span', function() {
  var e = jc(this);
  var p = parseInt(e.attr('data-page_to_load'));
  var ctn = e.parents('.cesis_isotope_container')
  var iso_ctn = ctn.find('.cesis_isotope');
  if( e.hasClass('cesis_nav_active') || e.hasClass('cesis_nav_off') ){
    return
  }
  else{
    if(e.hasClass('cesis_nav_number')){
      ctn.find('.cesis_nav_active').removeClass('cesis_nav_active');
      e.addClass('cesis_nav_active');
      if(e.hasClass('cesis_nav_last')){
        ctn.find('.cesis_nav_next').addClass('cesis_nav_off');
        ctn.find('.cesis_nav_prev').removeClass('cesis_nav_off').attr('data-page_to_load', (p-1)) ;
      }else if(e.hasClass('cesis_nav_first')){
        ctn.find('.cesis_nav_prev').addClass('cesis_nav_off');
        ctn.find('.cesis_nav_next').removeClass('cesis_nav_off').attr('data-page_to_load', (p+1)) ;
      }else{
        ctn.find('.cesis_nav_prev').removeClass('cesis_nav_off').attr('data-page_to_load', (p-1)) ;
        ctn.find('.cesis_nav_next').removeClass('cesis_nav_off').attr('data-page_to_load', (p+1)) ;
      }
    }else{
      var cp = parseInt(ctn.find('.cesis_nav_active').attr('data-page_to_load'));
      var lp = parseInt(ctn.find('.cesis_nav_last').attr('data-page_to_load'));
      if(e.hasClass('cesis_nav_prev')){
       if(cp == 1){
         e.addClass('cesis_nav_off');
         ctn.find('.cesis_nav_active').removeClass('cesis_nav_active');
         ctn.find('.cesis_nav_first').addClass('cesis_nav_active');
         ctn.find('.cesis_nav_next').removeClass('cesis_nav_off').attr('data-page_to_load', (cp));
       }
       else{
         ctn.find('.cesis_nav_active').removeClass('cesis_nav_active').prev('.cesis_nav_number').addClass('cesis_nav_active');
         e.attr('data-page_to_load', (cp-2));
         ctn.find('.cesis_nav_next').removeClass('cesis_nav_off').attr('data-page_to_load', (cp));
       }
     }else if(e.hasClass('cesis_nav_next')){
      if(cp == (lp-1)){
        e.addClass('cesis_nav_off');
        ctn.find('.cesis_nav_active').removeClass('cesis_nav_active');
        ctn.find('.cesis_nav_last').addClass('cesis_nav_active');
        ctn.find('.cesis_nav_prev').removeClass('cesis_nav_off').attr('data-page_to_load', (cp));
      }
      else{
        e.attr('data-page_to_load', (cp+2));
        ctn.find('.cesis_nav_active').removeClass('cesis_nav_active').next('.cesis_nav_number').addClass('cesis_nav_active');
        ctn.find('.cesis_nav_prev').removeClass('cesis_nav_off').attr('data-page_to_load', (cp));
      }
     }
    }

    iso_ctn.isotope( 'remove',  iso_ctn.isotope('getItemElements'));
    ctn.find('.load_more_btn').removeClass('post_no_more_posts').attr('data-page_to_load', p ).addClass('nav_load').click().removeClass('nav_load');
  }

});

// loading function

function load_ajax_posts() {

    var lb_btn = jc(this);
    var main_ctn = jc(this).parent('.cesis_isotope_container');
    var acontent = main_ctn.children('.cesis_isotope');
    var post_type = main_ctn.attr('data-post_type');
    var style = main_ctn.attr('data-style');
    var type = main_ctn.attr('data-type');
    var packery_type = main_ctn.attr('data-packery_type');
    var to_load = main_ctn.attr('data-load');
    var cat = main_ctn.attr('data-cat');
    var tag = main_ctn.attr('data-tag');
    var order = main_ctn.attr('data-order');
    var orderby = main_ctn.attr('data-orderby');
    var target = main_ctn.attr('data-target');
    var thumbnail = main_ctn.attr('data-thumbnail');
    var animation = main_ctn.attr('data-animation');
    if(lb_btn.hasClass('post_reset')){
    var offset = 0;
    lb_btn.removeClass('post_reset');
    }
    if(lb_btn.hasClass('nav_load')){
      var page = lb_btn.attr('data-page_to_load');
      var offset = to_load*page;
    lb_btn.removeClass('post_reset');
    }
    else{
    var offset = acontent.children('.cesis_iso_item').length;
    }
    var heading = main_ctn.attr('data-heading');
    var i_author = main_ctn.attr('data-i_author');
    var i_date = main_ctn.attr('data-i_date');
    var i_location = main_ctn.attr('data-i_location');
    var i_category = main_ctn.attr('data-i_category');
    var i_tag = main_ctn.attr('data-i_tag');
    var i_comment = main_ctn.attr('data-i_comment');
    var i_rating = main_ctn.attr('data-i_ratingt');
    var i_price = main_ctn.attr('data-i_price');
    var i_addtocart = main_ctn.attr('data-i_addtocart');
    var i_like = main_ctn.attr('data-i_like');
    var i_text = main_ctn.attr('data-i_text');
    var i_social = main_ctn.attr('data-i_social');
    var text_source = main_ctn.attr('data-text_source');
    var char_length = main_ctn.attr('data-char_length');
    var read_more = main_ctn.attr('data-read_more');
    var read_more_lb = main_ctn.attr('data-read_more_lb');
    var read_more_lbg = main_ctn.attr('data-read_more_lbg');
    var read_more_lc = main_ctn.attr('data-read_more_lc');
    var read_more_ebg = main_ctn.attr('data-read_more_ebg');
    var read_more_eb = main_ctn.attr('data-read_more_eb');
    var read_more_ec = main_ctn.attr('data-read_more_ec');
    var read_more_default = main_ctn.attr('data-read_more_default');
    var read_more_class = main_ctn.attr('data-read_more_class');
    var padding = main_ctn.attr('data-padding');
    var inner_padding = main_ctn.attr('data-inner_padding');
    var hover = main_ctn.attr('data-hover');


    if (!(lb_btn.hasClass('post_loading_loader') || lb_btn.hasClass('post_no_more_posts'))) {

        jc.ajax({
            type: 'POST',
            dataType: 'html',
            url: cesis_ajax_val.ajaxurl,
            data: {
                'post_type': post_type,
                'style': style,
                'type': type,
                'packery_type': packery_type,
                'to_load': to_load,
                'offset': offset,
                'cat': cat,
                'tag': tag,
                'order': order,
                'orderby': orderby,
                'target': target,
                'thumbnail': thumbnail,
                'heading': heading,
                'i_author': i_author,
                'i_date': i_date,
                'i_location': i_location,
                'i_category': i_category,
                'i_tag': i_tag,
                'i_comment': i_comment,
                'i_rating': i_rating,
                'i_price': i_price,
                'i_addtocart': i_addtocart,
                'i_like': i_like,
                'i_text': i_text,
                'i_social': i_social,
                'text_source': text_source,
                'char_length': char_length,
                'read_more': read_more,
                'read_more_lb': read_more_lb,
                'read_more_lbg': read_more_lbg,
                'read_more_lc': read_more_lc,
                'read_more_eb': read_more_eb,
                'read_more_ebg': read_more_ebg,
                'read_more_ec': read_more_ec,
                'read_more_default': read_more_default,
                'read_more_class': read_more_class,
                'padding': padding,
                'inner_padding': inner_padding,
                'animation': animation,
                'hover': hover,
                'action': 'cesis_ajax_load'
            },
            beforeSend: function() {
                lb_btn.addClass('post_loading_loader').html(cesis_ajax_val.loading);
            },
            success: function(data) {
                var adata = jc(data);

                current_page = adata.filter('#cp').text();
                max_pages = adata.filter('#mp').text();
                if (adata.length) {
                    var anewElements = adata.css({
                        opacity: 0
                    });
                    jc('.wp-audio-shortcode').addClass('media_adjusted');
                    jc('.wp-video-shortcode').addClass('media_adjusted');
                    var iso_ctn = acontent.isotope('insert', anewElements);
                    var iso = iso_ctn.data('isotope');
                    imagesLoaded(acontent, function() {
                        iso.layout();
                    });
                    main_ctn.find('.cesis_isotope_filter .cesis_filter li a').each(function() {
                  	   var filter_class = jc(this).attr('data-filter');
                  		 if (main_ctn.find(filter_class).length){ // implies *not* zero
                  		     jc(this).parent('li').show();
                  				 }else{
                  				jc(this).parent('li').hide();
                  				 }
                  	});
                    iso_ctn.on('layoutComplete', iso.layout());
                    iso_ctn.on('layoutComplete', isoLoaded(acontent, to_load));
                    jc('.cesis_video_ctn').fitVids();
                    cesis_like();
                    setTimeout(function() {
                      jc('.cesis_video_ctn:not(.video_adjusted)').find('.mejs-video .mejs-controls').wrap('<div class="cesis_inner_video_ctn"></div>');
                    }, 400);
                    cesis_owl_carousel();
                    jc('.cesis_blog_m_thumbnail').lightGallery({
                      selector:'.cesis_gallery_img',
                    });
                    jc('.cesis_overlay_ctn').lightGallery({
                      selector:'.cesis_hover_zoom',
                    });
                    if(jc('.wp-audio-shortcode:not(.media_adjusted)').length || jc('.wp-video-shortcode:not(.media_adjusted)').length ){
	                     mejs.plugins.silverlight[0].types.push('video/x-ms-wmv');
	                     mejs.plugins.silverlight[0].types.push('audio/x-ms-wma');
	                     jc(function () {
                         var settings = {};
		                     if ( typeof _wpmejsSettings !== 'undefined' ) {
			                     settings = _wpmejsSettings;
		                     }
                         settings.success = function (mejs) {
                           var autoplay, loop;
                           if ( 'flash' === mejs.pluginType ) {
			                       autoplay = mejs.attributes.autoplay && 'false' !== mejs.attributes.autoplay;
	                           loop = mejs.attributes.loop && 'false' !== mejs.attributes.loop;
				                     autoplay && mejs.addEventListener( 'canplay', function () {
					                     mejs.play();
				                     }, false );
				                     loop && mejs.addEventListener( 'ended', function () {
					                   mejs.play();
				                     }, false );
			                    }
		                    };
                        jc('.wp-audio-shortcode:not(.media_adjusted), .wp-video-shortcode:not(.media_adjusted)').mediaelementplayer( settings );
	                    });
                    }
                    anewElements.animate({
                        opacity: 1
                    });
                    lb_btn.removeClass('post_loading_loader').html(cesis_ajax_val.loadmore);
                    if (current_page == max_pages) {
                        lb_btn.removeClass('post_loading_loader').addClass('post_no_more_posts').html(cesis_ajax_val.noposts);
                    }
                    // check if navigation
                    if(main_ctn.find('.cesis_navigation_ctn').length){
                      // check if new navigation need to be created

                      if(parseInt(max_pages) !== (parseInt(main_ctn.find('.cesis_nav_last').attr('data-page_to_load'))+1)){
                        var i = 0;
                        var n = 1;
                        var nav = '';
                        while (i < max_pages) {
                          if(i == 0){
                            nav = '<span data-page_to_load="'+i+'" class="cesis_nav_number cesis_nav_first cesis_nav_active">'+n+'</span>';
                          }else if(n == max_pages){
                            nav = nav+'<span data-page_to_load="'+i+'" class="cesis_nav_number cesis_nav_last">'+n+'</span>';
                          }else{
                            nav = nav+'<span data-page_to_load="'+i+'" class="cesis_nav_number">'+n+'</span>';
                          }
                          i ++;
                          n ++;

                        }
                        main_ctn.find('.cesis_nav_numbers').replaceWith( '<div class="cesis_nav_numbers">'+nav+'</div>' );


                      }
                    }
                }
                else{
                      lb_btn.removeClass('post_loading_loader').addClass('post_no_more_posts').html(cesis_ajax_val.noposts);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                lb_btn.html(jc.parseJSON(jqXHR.responseText) + ' :: ' + textStatus + ' :: ' + errorThrown);
                console.log(jqXHR);
            },
        });
    }
    return false;
}



////////////////////////
//*** Zilla likes ***//
//////////////////////


if ('function' !== typeof(window['cesis_like'])) {
    window.cesis_like = function() {


      jc('.zilla-likes').unbind().on('click', function() {
        var link = jc(this);
        if (link.hasClass('active')) return false;

        var id = jc(this).attr('id'),
            postfix = link.find('.zilla-likes-postfix').text();

        jc.ajax({
          type: 'POST',
          url: cesis_ajax_val.ajaxurl,
          data: {
            action: 'zilla-likes',
            likes_id: id,
            postfix: postfix,
          },
          xhrFields: {
            withCredentials: true,
          },
          success: function(data) {
            link.html(data).addClass('active').attr('title','You already like this');
          },
        });

        return false;
      });

      if (jc('body.ajax-zilla-likes').length) {
        jc('.zilla-likes').each(function() {
          var id = jc(this).attr('id');
          jc(this).load(cesis_ajax_val.ajaxurl, {
            action: 'zilla-likes',
            post_id: id,
          });
        });
      }

}
}


//////////////////////////
//*** Centered Logo ***//
////////////////////////


function set_center_logo() {
    if (jc('.header_logo.logo_center .site-title').length) {
        var logo_size = jc('.header_logo.logo_center .site-title').width();
        if (logo_size > 0) {
            var logo_size_s = logo_size / 2;
            var logo_size_m = (logo_size + 60) / 2;
            jc('.header_logo').css('margin-left', -logo_size_s);
        }
    } else {
        var logo_size = jc('.header_logo.logo_center h1').width();
        if (logo_size > 0) {
            var logo_size_s = logo_size / 2;
            var logo_size_m = (logo_size + 60) / 2;
            jc('.header_logo').css('margin-left', -logo_size_s);
        }
    }
    var total_menu_items = jc('nav.logo_center .menu-main-ct > ul > li').length;
    var half_position_even = total_menu_items / 2;
    var half_position_odd = (total_menu_items + 1) / 2;
    var ex = /^\d+$/;
    if (ex.test(total_menu_items / 2)) {
        //When the total number of the menu items is even
        jc('nav.logo_center .menu-main-ct > ul > li:nth-child(' + half_position_even + ')').addClass('cl_before_logo');
        jc('nav.logo_center .menu-main-ct > ul > li:nth-child(' + (half_position_even + 1) + ')').addClass('cl_after_logo');
    } else {
        //When the total number of the menu items is odd
        jc('nav.logo_center .menu-main-ct > ul > li:nth-child(' + half_position_odd + ')').addClass('cl_before_logo');
        jc('nav.logo_center .menu-main-ct > ul > li:nth-child(' + (half_position_odd + 1) + ')').addClass('cl_after_logo');
    }

    jc('.cl_before_logo').css('margin-right', logo_size_m);
    jc('.cl_after_logo').css('margin-left', logo_size_m);

    var li_width = 0;
    jc('nav.logo_center .menu-main-ct > ul > li').each(function() {
        current_li_width = jc(this).outerWidth();
        if (current_li_width > li_width) {
            li_width = current_li_width;
            jc('nav.logo_center .menu-main-ct > ul > li').css('min-width', li_width);
        }

    })
}


//////////////////////////
//***  Text Resize  ***//
////////////////////////


if ('function' !== typeof(window['cesis_text_resize'])) {
  window.cesis_text_resize = function() {
    var ar_text = jc('.cesis_ar_text');
    jc.each(ar_text, function() {
      var el = jc(this);
      var max = jc(this).attr('data-max_size');
      var min = jc(this).attr('data-min_size');
      el.fitText(1.2, { minFontSize: min+'px', maxFontSize: max+'px' });
    })
  }
}


//////////////////////////
//*** Section swipe ***//
////////////////////////


if ('function' !== typeof(window['cesis_section_swipe'])) {
    window.cesis_section_swipe = function() {
      // init

      if(!jc('.touch').length){
      if (jc('.cesis_section_swipe').length) {
        var controller = new ScrollMagic.Controller({
          globalSceneOptions: {
            triggerHook: 'onLeave'
          }
        }
      );
		// get all slides
		var slides = document.querySelectorAll(".vc_section");

		// create scene for every slide
		for (var i=0; i<slides.length; i++) {
			new ScrollMagic.Scene({
					triggerElement: slides[i]
				})
				.setPin(slides[i])
				.addTo(controller);
		}

jc(document).ready(function () {
var sectionR;
var divs = jc('.scrollmagic-pin-spacer');
var dir = 'up'; // wheel scroll direction
var div = 0; // current div
jc(document.body).on('DOMMouseScroll mousewheel', function (e) {
  if(sectionR !== "sliding"){
    sectionR = "sliding";
    if (e.originalEvent.detail > 0 || e.originalEvent.wheelDelta < 0) {
        dir = 'down';
    } else {
        dir = 'up';
    }
    // find currently visible div :
    div = -1;
    divs.each(function(i){
        if (div<0 && (jc(this).offset().top >= jc(window).scrollTop())) {
            div = i;
        }
    });
    if (dir == 'up' && div > 0) {
        div--;
        console.log(div);
    }
    if (dir == 'down' && div < divs.length-1) {
        div++;
        console.log(div);
    }
    //console.log(div, dir, divs.length);
    setTimeout(function() {
      sectionR = "stopped";
    }, 700 )
    jc('html,body').stop().animate({
        scrollTop: divs.eq(div).offset().top

    }, 700);
    return false;
  }
});
jc(window).resize(function () {
    jc('html,body').scrollTop(divs.eq(div).offset().top);
});
});

}

}

}
}

///////////////////////////////////////
//***          To Top            ***//
/////////////////////////////////////


if ('function' !== typeof(window['cesis_to_top'])) {
  window.cesis_to_top = function() {
    if (jc('#cesis_to_top').length > 0 ){
    var scrollTop = jc(window).scrollTop();

    if (jc('#cesis_to_top').length > 0 && jc(window).width() > 420) {

        if (scrollTop > 350) {
            jc(window).on('scroll', hideToTop);
        }
        else {
            jc(window).on('scroll', showToTop);
        }
    }

function showToTop() {

    var scrollTop = jc(window).scrollTop();
    if (scrollTop > 350) {

        jc('#cesis_to_top').stop(true, true).animate({
            'bottom': '30px'
        }, 350, 'easeInOutCubic');

        jc(window).off('scroll', showToTop);
        jc(window).on('scroll', hideToTop);
    }

}

function hideToTop() {

    var scrollTop = jc(window).scrollTop();
    if (scrollTop < 350) {

        jc('#cesis_to_top').stop(true, true).animate({
            'bottom': '-30px'
        }, 350, 'easeInOutCubic');

        jc(window).off('scroll', hideToTop);
        jc(window).on('scroll', showToTop);

    }
}

    jc('body').on('click', '#cesis_to_top, a[href="#top"]', function () {
        jc('body,html').stop().animate({
            scrollTop: 0
        }, 800, 'easeOutQuad')
        return false;
    });

}
  }
}

///////////////////////////////////////
//*** One page / scroll function ***//
/////////////////////////////////////


if ('function' !== typeof(window['cesis_scroll_fn'])) {
  window.cesis_scroll_fn = function() {
    if(!jc('body').hasClass('single-product') ) {
     if(jc('.cesis_onepage_page').length) {

       if(jc('.cesis_onepage_right_nav').length || jc('.cesis_onepage_left_nav').length) {
         if(jc('.cesis_onepage_right_nav').length) {
           jc('body').prepend('<div id="cesis_one_page_navigation" style="right:25px;"></div>')
         }else{
           jc('body').prepend('<div id="cesis_one_page_navigation" style="left:25px;"></div>')
         }
         jc('.vc_section').each(function() {
           var id = jc(this).attr('id');
           jc('#cesis_one_page_navigation').append('<a href="#'+id+'"><span></span></a>');
         })
       }


     jc(window).scroll(function() {
       if (jc('.cesis_section_swipe').length) {
         var section_selector = '.scrollmagic-pin-spacer';
       }else{
         var section_selector = '.vc_section';
       }
       var windscroll = jc(window).scrollTop();
       if(jc('.cesis_sticky').length) {
        if(jc('.cesis_header_hiding').length) {
         var h_height = 0;
        }
        else if(jc('.cesis_transparent_header').length && !jc('.cesis_stuck').length) {
          var h_height = 0;
        }else{
         var h_height = jc(".cesis_sticky").height();
        }
       }else{
         var h_height = 0;
       }
        jc(section_selector).each(function(i) {
          if (jc(this).offset().top <= windscroll + h_height) {
            jc('#cesis_one_page_navigation a.current').removeClass('current');
            jc('#site-navigation li.current-menu-item').removeClass('current-menu-item');
            jc('#cesis_one_page_navigation a').eq(i).addClass('current');
            jc('#site-navigation a').eq(i).parent('li').addClass('current-menu-item');
          }
          if( windscroll === 0) {
            jc('#cesis_one_page_navigation a.current').removeClass('current');
            jc('#site-navigation li.current-menu-item').removeClass('current-menu-item');
            jc('#cesis_one_page_navigation a').eq(0).addClass('current');
            jc('#site-navigation a').eq(0).parent('li').addClass('current-menu-item');

          }
        });
    }).scroll();
      jc('.header_mobile a[href*=#]:not([href=#]):not([href="#lifestyle_container"]):not(.cesis_open_s_overlay):not([data-toggle="collapse"]):not([data-vc-container=".vc_tta-container"]):not([data-vc-container=".vc_tta"])').on('click', function () {
        if (jc('.cesis_mobile_menu_switch').hasClass('open')) {
          jc('.cesis_mobile_menu_switch').removeClass('open');
          jc('.cesis_mobile_menu_switch').addClass('closing');
          jc('.header_mobile').slideToggle(400);
          setTimeout(function() {
            jc('.closing').removeClass('closing');
          }, 400);
        } else{
          jc('.cesis_mobile_menu_switch').addClass('open');
          jc('.header_mobile').slideToggle(400);
        }
      });
    }

      jc('a[href*=#]:not([href=#]):not([href="#lifestyle_container"]):not(.cesis_open_s_overlay):not([data-toggle="collapse"]):not([data-vc-container=".vc_tta-container"]):not([data-vc-container=".vc_tta"])').on('click', function () {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
          var target = jc(this.hash);
          if(jc('.cesis_sticky').length) {
           if(jc('.cesis_header_hiding').length) {
					  var h_height = 0;
           }else{
            var h_height = jc(".cesis_sticky").height();
           }
          }else{
            var h_height = 0;
          }

			    target = target.length ? target : jc('[name=' + this.hash.slice(1) + ']');
          if (target.length) {
            if (jc('.cesis_section_swipe').length) {
            jc('html,body').animate({
              scrollTop: target.parent('.scrollmagic-pin-spacer').offset().top-h_height+1
            }, 1000);
            return false;
            }
            else{
            jc('html,body').animate({
              scrollTop: target.offset().top-h_height+1
            }, 1000);
            return false;
            }
          }
        }
      });

	   }


  }
}

//////////////////////////////////
//*** Row related functions ***//
////////////////////////////////


if ('function' !== typeof(window['cesis_row'])) {
    window.cesis_row = function() {
      // init
      var $overlays = jc('[data-overlay="true"]');
      jc.each($overlays, function() {
        var el = jc(this);
        var overlay_color = jc(this).attr('data-overlay-color');

        var already_set = el.find('.cesis_row_overlay');
        if(!already_set.length){

        if(el.hasClass('wpb_column')){
          setTimeout(function() {
              el.children('.vc_column-inner').append('<div class="cesis_row_overlay" style="background:'+overlay_color+';"></div>')
          }, 100 )
        }else{
          setTimeout(function() {
              el.append('<div class="cesis_row_overlay" style="background:'+overlay_color+';"></div>')
          }, 100 )
        }
      }else {
        el.find('.cesis_row_overlay').remove();
        if(el.hasClass('wpb_column')){
          setTimeout(function() {
              el.children('.vc_column-inner').append('<div class="cesis_row_overlay" style="background:'+overlay_color+';"></div>')
          }, 100 )
        }else{
          setTimeout(function() {
              el.append('<div class="cesis_row_overlay" style="background:'+overlay_color+';"></div>')
          }, 100 )
        }
      }

      });

      var controller = new ScrollMagic.Controller();
      jc('.cesis_row_has_parallax').each(function() {
      var el = jc(this);
      var speed = el.attr('data-parallax_speed');
      if(speed.indexOf('.') > -1){
        speed = speed.replace('.','');
        if(speed.length < 3){
          speed = speed+'0';
        }
      }
      else if(speed.length < 2){
        speed = speed+'00';
      }
      var img_url = el.attr('data-vc-parallax-image');
      var time = jc(window).height()+el.outerHeight();
      var durationValueCache;

      function getDuration () {
        return durationValueCache;
      }
      function updateDuration (e) {
        durationValueCache = jc(window).height()+el.outerHeight();
      }

      jc(window).on("resize", updateDuration); // update the duration when the window size changes
      jc(window).triggerHandler("resize"); // set to initial value

      var parallaxTL = new TimelineMax();
      var already_set = el.find('.cesis_row_parallax');
      if ( el.parents(".cesis_content_slider_ctn").length == 1 ) {
        var t_hook = 0;
        if(!already_set.length){
          el.prepend('<div class="cesis_parallax_ctn"><div class="cesis_row_parallax"></div></div>');
        }
        if(img_url !== undefined){
          el.find('.cesis_row_parallax').css('background-image','url('+img_url+')');
        }
        parallaxTL.staggerFromTo(el.find('.cesis_row_parallax'), 1, {
          transform:"translate3d(0px, 0px, 0px)"
        }, {
          transform:"translate3d(0px, "+speed+"px, 0px)"
        });

      }else{
        var t_hook = 1;
        if(!already_set.length){
          el.prepend('<div class="cesis_parallax_ctn"><div class="cesis_row_parallax"></div></div>');
        }
        if(img_url !== undefined){
          el.find('.cesis_row_parallax').css('background-image','url('+img_url+')');
        }
        parallaxTL.staggerFromTo(el.find('.cesis_row_parallax'), 1, {
          backgroundPosition: "50% "+speed+"px"
        }, {
          backgroundPosition: "50% -"+speed+"px"
        });
      }
      var slideParallaxScene = new ScrollMagic.Scene({
        triggerElement: this,
        triggerHook:t_hook,
        duration:durationValueCache
      })
      .setTween(parallaxTL)
      .addTo(controller);


      slideParallaxScene.duration(getDuration);

    });

      jc('.cesis_row_content_effect').each(function() {
      var el = jc(this);

      var effect = el.attr('data-effect');
      var effect_depth = el.attr('data-effect_depth');
      if(effect_depth.indexOf('.') > -1){
        effect_depth = effect_depth.replace('.','');
        if(effect_depth.length < 3){
          effect_depth = effect_depth+'0';
        }
      }
      else if(effect_depth.length < 2){
        effect_depth = effect_depth+'00';
      }
      var offset_value;
      var durationValueCache;
      function getDuration () {
        return durationValueCache;
      }
      function updateDuration (e) {
        durationValueCache = el.outerHeight();
      }
      jc(window).on("resize", updateDuration); // update the duration when the window size changes
      function getOffset () {
        return offset_value;
      }
      function updateOffset (e) {
        offset_value = el.outerHeight();
      }
      jc(window).on("resize", updateOffset); // update the duration when the window size changes
      jc(window).triggerHandler("resize"); // set to initial value
      var effectTL = new TimelineMax();
      if(effect == 'cesis_row_e_stick' || effect == 'cesis_row_e_fade_stick'){
        effectTL.to(el.children('.wpb_column,.cesis_inner_row_ctn'),3,{ y:''+effect_depth+'%' },0.15);
      }
      if(effect == 'cesis_row_e_fade_out' || effect == 'cesis_row_e_fade_stick'){
        effectTL.to(el.children('.wpb_column,.cesis_inner_row_ctn'), 2.5,{ opacity: 0 },0.1);
      }
      var fadein_scene = new ScrollMagic.Scene({
        triggerElement: this,
        duration: durationValueCache,
        triggerHook:0,
        reverse: true
      })
      .setTween(effectTL)
      //.addIndicators()
      .addTo(controller);
            fadein_scene.duration(getDuration);

    });

    jc('.cesis_content_slider_ctn').each(function() {

if (navigator.userAgent.indexOf('MSIE') !== -1 || navigator.appVersion.indexOf('Trident/') > 0) {
     var evt = document.createEvent('UIEvents');
     evt.initUIEvent('resize', true, false, window, 0);
     window.dispatchEvent(evt);
    setTimeout(function() {
    window.dispatchEvent(evt);
    }, 1);
    setTimeout(function() {
    window.dispatchEvent(evt);
    }, 5);
    setTimeout(function() {
    window.dispatchEvent(evt);
    }, 10);
    setTimeout(function() {
    window.dispatchEvent(evt);
    }, 100);
    setTimeout(function() {
    window.dispatchEvent(evt);
    jc('.cesis_content_slider_ctn').addClass('cesis_content_slider_loaded');
    }, 500);
  } else {
    setTimeout(function() {
    window.dispatchEvent(new Event('resize'));
    }, 1);
    setTimeout(function() {
    window.dispatchEvent(new Event('resize'));
    }, 5);
    setTimeout(function() {
    window.dispatchEvent(new Event('resize'));
    }, 10);
    setTimeout(function() {
    window.dispatchEvent(new Event('resize'));
    }, 100);
    setTimeout(function() {
    window.dispatchEvent(new Event('resize'));
    jc('.cesis_content_slider_ctn').addClass('cesis_content_slider_loaded');
    }, 500);

    }





    });

}
}

/////////////////////////////////
//***    Full width row    ***//
///////////////////////////////


if ('function' !== typeof(window['vc_rowBehaviour'])) {

window.vc_rowBehaviour = function() {
    function fullWidthRow() {
      var $elements = jc('[data-vc-full-width="true"]');
      jc.each($elements, function(key, item) {
          var $el = jc(this);
          $el.addClass('vc_hidden');
          var $el_full = $el.next('.vc_row-full-width');
          if ($el_full.length || ($el_full = $el.parent().next('.vc_row-full-width')), $el_full.length) {


              var el_margin_left = parseInt($el.css('margin-left'), 10),
                  el_margin_right = parseInt($el.css('margin-right'), 10);

              if (jc('.vc_full_width_row_container').length) {
                  var custom_container = jc('.vc_full_width_row_container'), // Set the Custom container
                  container_offset = custom_container.offset(); // Set the offset attribute
                  var offset = 0 - $el_full.offset().left - el_margin_left + container_offset.left;

              } else {
                  var custom_container = jc(window);
                  var offset = 0 - $el_full.offset().left - el_margin_left;
              }

              var width = jc(custom_container).width();
              if(jc('body').hasClass('rtl')){
                if ($el.css({
                        position: 'relative',
                        right: offset,
                        'box-sizing': 'border-box',
                        width: width,
                    }), !$el.data('vcStretchContent')) {
                    var padding = -1 * offset;
                    0 > padding && (padding = 0);
                    var paddingRight = width - padding - $el_full.width() + el_margin_left + el_margin_right;
                    0 > paddingRight && (paddingRight = 0), $el.css({
                        'padding-left': padding + 'px',
                        'padding-right': paddingRight + 'px'
                    })
                }
              }else{
                if ($el.css({
                        position: 'relative',
                        left : offset,
                        'box-sizing': 'border-box',
                        width: width,
                    }), !$el.data('vcStretchContent')) {
                    var padding = -1 * offset;
                    0 > padding && (padding = 0);
                    var paddingRight = width - padding - $el_full.width() + el_margin_left + el_margin_right;
                    0 > paddingRight && (paddingRight = 0), $el.css({
                        'padding-left': padding + 'px',
                        'padding-right': paddingRight + 'px'
                    })
                }
              }
              $el.attr('data-vc-full-width-init', 'true'), $el.removeClass('vc_hidden')
          }
      }), jc(document).trigger('vc-full-width-row', $elements)
    }

    function parallaxRow() {
        var vcSkrollrOptions, callSkrollInit = !1;
        return window.vcParallaxSkroll && window.vcParallaxSkroll.destroy(), jc(".vc_parallax-inner").remove(), jc("[data-5p-top-bottom]").removeAttr("data-5p-top-bottom data-30p-top-bottom"), jc("[data-vc-parallax]").each(function() {
            var skrollrSpeed, skrollrSize, skrollrStart, skrollrEnd, $parallaxElement, parallaxImage, youtubeId;
            callSkrollInit = !0, "on" === jc(this).data("vcParallaxOFade") && jc(this).children().attr("data-5p-top-bottom", "opacity:0;").attr("data-30p-top-bottom", "opacity:1;"), skrollrSize = 100 * jc(this).data("vcParallax"), $parallaxElement = jc("<div />").addClass("vc_parallax-inner").appendTo(jc(this)), $parallaxElement.height(skrollrSize + "%"), parallaxImage = jc(this).data("vcParallaxImage"), youtubeId = vcExtractYoutubeId(parallaxImage), youtubeId ? insertYoutubeVideoAsBackground($parallaxElement, youtubeId) : "undefined" != typeof parallaxImage && $parallaxElement.css("background-image", "url(" + parallaxImage + ")"), skrollrSpeed = skrollrSize - 100, skrollrStart = -skrollrSpeed, skrollrEnd = 0, $parallaxElement.attr("data-bottom-top", "top: " + skrollrStart + "%;").attr("data-top-bottom", "top: " + skrollrEnd + "%;")
        }), !(!callSkrollInit || !window.skrollr) && (vcSkrollrOptions = {
            forceHeight: !1,
            smoothScrolling: !1,
            mobileCheck: function() {
                return !1
            }
        }, window.vcParallaxSkroll = skrollr.init(vcSkrollrOptions), window.vcParallaxSkroll)
    }
    function vc_initVideoBackgrounds() {
      jc("[data-vc-video-bg]").each(function() {
            var youtubeUrl, youtubeId, $element = jc(this);
            $element.data("vcVideoBg") ? (youtubeUrl = $element.data("vcVideoBg"), youtubeId = vcExtractYoutubeId(youtubeUrl), youtubeId && ($element.find(".vc_video-bg").remove(), insertYoutubeVideoAsBackground($element, youtubeId)), jc(window).on("grid:items:added", function(event, $grid) {
                $element.has($grid).length && vcResizeVideoBackground($element)
            })) : $element.find(".vc_video-bg").remove()
        })
    }
    function fullHeightRow() {
        var $element = jc(".vc_row-o-full-height:first");
        if ($element.length) {
            var $window, windowHeight, offsetTop, fullHeight;
            $window = jc(window), windowHeight = $window.height(), offsetTop = $element.offset().top, offsetTop < windowHeight && (fullHeight = 100 - offsetTop / (windowHeight / 100), $element.css("min-height", fullHeight + "vh"))
        }
        jc(document).trigger("vc-full-height-row", $element)
    }

    function fixIeFlexbox() {
        var ua = window.navigator.userAgent,
            msie = ua.indexOf("MSIE ");
        (msie > 0 || navigator.userAgent.match(/Trident.*rv\:11\./)) && jc(".vc_row-o-full-height").each(function() {
            "flex" === jc(this).css("display") && jc(this).wrap('<div class="vc_ie-flexbox-fixer"></div>')
        })
    }
    function vcExtractYoutubeId(url) {
      if ("undefined" == typeof url) return !1;
      var id = url.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
      return null !== id && id[1]
    }
    jc(window).off("resize.vcRowBehaviour").on("resize.vcRowBehaviour", fullWidthRow).on("resize.vcRowBehaviour", fullHeightRow), fullWidthRow(), fullHeightRow(), fixIeFlexbox(), vc_initVideoBackgrounds(), parallaxRow();



    }
}


////////////////////////////
//***    Animation    ***//
//////////////////////////




if ('function' !== typeof(window['cesis_animations'])) {
    window.cesis_animations = function() {
        jc.each(jc('.animate_when_almost_visible:not(.start_animation)'), function(index, val) {
            var run = true;
            if (jc(val).closest('.owl-carousel').length > 0) run = false;
            if (run) {
                new cWaypoint({
                    element: val,
                    handler: function() {
                        var element = jc(this.element),
                            delayAttr = element.attr('data-delay');
                        if (delayAttr == undefined) delayAttr = 200;
                        setTimeout(function() {
                            element.addClass('start_animation');
                        }, (delayAttr * index));
                        this.destroy();
                    },
                    offset: '90%'
                });
            }
        });
    }
}



////////////////////////////
//***      Video      ***//
//////////////////////////




if ('function' !== typeof(window['cesis_video'])) {
    window.cesis_video = function() {
      jc('.cesis_video_ctn').fitVids();
      setTimeout(function() {
        jc('.cesis_video_ctn').find('.mejs-video .mejs-controls').wrap('<div class="cesis_inner_video_ctn"></div>');
        jc('.cesis_video_ctn').addClass('video_adjusted');
      }, 400);
      jc(window).resize(checkResize);
      function checkResize(){
        if (
          document.fullscreenElement ||
          document.webkitFullscreenElement ||
          document.mozFullScreenElement ||
          document.msFullscreenElement
        ){
        jc('.inside_e').addClass('fullscreen_activated adjusted_inside_e').removeClass('animated');
    }else{
        jc('.fullscreen_activated').removeClass('fullscreen_activated');
        setTimeout(function() {
          jc('.adjusted_inside_e').addClass('animated');
        }, 1000);
    }
}

    }
}



////////////////////////////
//***     Isotope     ***//
//////////////////////////


if ('function' !== typeof(window['cesis_isotope'])) {
    window.cesis_isotope = function() {

      // filter function

      jc('.cesis_filter').on('click', 'a', function() {
        var e = jc(this);
        var f = e.attr('data-filter');
        var type = e.attr('data-type');
        var ctn = e.parents('.cesis_isotope_container')
        var iso_ctn = ctn.find('.cesis_isotope');
        var filter_ctn = ctn.find('.cesis_filter_ctn');
				filterItems = [];
        if(e.parents('li').hasClass('selected')){
            return
        }
        else{
          iso_ctn.find('.inside_e').addClass('iso_fading').removeClass('wpb_start_animation');

          e.parents('.cesis_isotope_container').find('.selected').removeClass('selected');
          e.parents('li').addClass('selected');
          if(filter_ctn.hasClass("cesis_isotope_filter")){

            setTimeout(function() {
              iso_ctn.isotope({
                filter: f
            	});
      				filterItems.push(e);
              jc('.inside_e.iso_fading', iso_ctn).removeClass('iso_fading');
            }, 400);

						iso_ctn.isotope('once', 'arrangeComplete', function() {
							setTimeout(function() {
								isoAnimation(jc('.cesis_iso_item:not([style*="display: none"])', iso_ctn), 0, false, iso_ctn);
							}, 50);
						});

          }else{
            iso_ctn.find('.inside_e').addClass('iso_fading').removeClass('wpb_start_animation');
            var new_val = f.replace(/^.f_+/i, '');
            if(type == 'post_tag' || type == 'portfolio_tag' || type == 'staff_tag' || type == 'product_tag' ){
              ctn.attr("data-tag", new_val);
              ctn.attr("data-cat", 'all');
            }
            if(type == 'category'  || type == 'portfolio_category' || type == 'staff_group' || type == 'product_cat' ){
              ctn.attr("data-cat", new_val);
              ctn.attr("data-tag", 'all');
            }
            if(type == 'all'){
              ctn.attr("data-cat", 'all');
              ctn.attr("data-tag", 'all');
            }
            setTimeout(function() {
              iso_ctn.isotope( 'remove',  iso_ctn.isotope('getItemElements'));
              ctn.find('.load_more_btn').removeClass('post_no_more_posts').addClass('post_reset').click();
              jc('.inside_e.iso_fading', iso_ctn).removeClass('iso_fading');
            }, 100);
          }
          filter_linemove();
        }
      })

      // filter Line moving effect

      jc('.cesis_filter_ctn').each(function() {
        var current_width = jc(this).find('li.selected a');
        jc('<span class="filter_moving_line"></span>').insertAfter(jc(this).find('.cesis_filter > li:first-child'));
        var Line = jc(this).find('.filter_moving_line');
        Line.width(current_width.width())
        Line.css('left', jc(this).find('li.selected').position().left);
        Line.css('opacity', '1');
      });

      function filter_linemove() {
        var filter = jc('.cesis_filter_ctn');
        filter.each(function() {
          var el, leftPos, newWidth;
          var Line = jc(this).find('.filter_moving_line');
          Line.width(jc(this).find('li.selected a').width())
          .css('left', jc(this).find('li.selected a').position().left)
          .data('origLeft', Line.position().left)
          .data('origWidth', Line.width());

          jc('.cesis_filter li a').on('click', function() {
            el = jc(this);
            leftPos = el.position().left;
            newWidth = el.parent().width();
            });
        });
      }




      // sorter function

      jc('.cesis_sorter').on('click','li', function(e) {
        var ctn = jc(this).parents('.cesis_isotope_container').find('.cesis_isotope')
        var s = jc(this).attr('data-sort');
        var o = jc(this).attr('data-order');
        jc(this).parents('.cesis_sorter').find('.sort_selected').removeClass('sort_selected');
        jc(this).addClass('sort_selected');

        if(o !== undefined){
          ctn.isotope({
            sortAscending: (o == 'true') ? true : false,
          })
        }
        if(s !== undefined){
          ctn.isotope({
            sortBy: s
          })
        }
      })




        isoLoaded = function(isotopeCtn, startIndex) {
                isotopeCtn.css('opacity', 1);
                setTimeout(function() {
                    isoAnimation(jc('.cesis_iso_item', isotopeCtn), startIndex, true, isotopeCtn);
                }, 100);
            },
            isoAnimation = function(items, startIndex, sequential, container) {
                var allItems = items.length - startIndex,
                    showed = 0,
                    index = 0;
                if (container.closest('.owl-item').length == 1) return false;
                jc.each(items, function(index, val) {
                    var elInner = jc('> .inside_e', val); // maybe need to add not animated
                    if (val[0]) val = val[0];
                    if (elInner.hasClass('wpb_animate_when_almost_visible')) {

                        new cWaypoint({
                            element: val,
                            handler: function() {
                                var element = jc('> .inside_e', this.element),
                                    parent = jc(this.element),
                                    currentIndex = parent.index();
                                var delay = (!sequential) ? index : ((startIndex !== 0) ? currentIndex - allItems : currentIndex),
                                    delayAttr = parseInt(element.attr('data-delay'));
                                if (isNaN(delayAttr)) delayAttr = 100;
                                delay -= showed;
                                var objTimeout = setTimeout(function() {
                                    element.removeClass('iso_fading').addClass('wpb_start_animation  animated');
                                    showed = parent.index();
                                }, delay * delayAttr)
                                parent.data('objTimeout', objTimeout);
                                this.destroy();
                            },
                            offset: '90%'
                        })
                    } else {
                        if (elInner.hasClass('force-anim')) {
                            elInner.addClass('start_animation');
                        } else {
                            elInner.css('opacity', 1);
                        }
                    }
                    index++;
                });
            };



        var iso_ctn = jc('.cesis_isotope');
        if (iso_ctn.length) {
            jc(iso_ctn).each(function() {


                var container = jc(this);
                var m_container = jc(this).parents('.cesis_isotope_container').attr('id');
                var layout = container.attr('data-layout');
                if (layout == null) {
                    var layout = 'packery';
                }
                var iso_ctn = container.isotope({
                    itemSelector: '.cesis_iso_item',
                    layoutMode: layout,
                    percentPosition: true,
                    stagger: 40,
                    originLeft: jc('body').hasClass('rtl') ? false : true,
                    hiddenStyle: {  opacity: 0 },
                    visibleStyle: { opacity: 1 },
                    transitionDuration: 0,
                    transformsEnabled : false,
                    getSortData: {
                      title: '.isotope_filter_name',
                      date: '.isotope_filter_date parseInt',
                      price: '.isotope_filter_price parseInt',
                    },
                    sortBy : 'original-order'
                });
                var iso = iso_ctn.data('isotope');

                imagesLoaded(container, function() {
                    iso.layout();
                });

                iso_ctn.on('layoutComplete', iso.layout());
                jc('#'+m_container+' .cesis_isotope_filter .cesis_filter li a').each(function() {
              	   var filter_class = jc(this).attr('data-filter');
              		 if (jc('#'+m_container).find(filter_class).length){ // implies *not* zero
              		     jc(this).parent('li').show();
              				 }else{
              				jc(this).parent('li').hide();
              				 }
              	});
              	jc('#'+m_container).find('.cesis_filter').css('opacity','1');

                setTimeout(function() {
                    iso_ctn.on('layoutComplete', isoLoaded(container, 0));
                }, 200);

            });
        }
    }
};




////////////////////////////
//***   OwlCarousel   ***//
//////////////////////////

function owl_adjustment(){
  jc('.cesis_content_slider_ctn').trigger('destroy.owl.carousel').removeClass('owl-carousel owl-loaded');
  jc('.cesis_content_slider_ctn').find('.cloned').remove();
  jc('.cesis_content_slider_ctn').find('.owl-prev').remove();
  jc('.cesis_content_slider_ctn').find('.owl-next').remove();
  jc('.cesis_content_slider_ctn').find('.owl-controls').remove();
  jc('.cesis_content_slider_ctn').find('.owl-stage').unwrap();
  jc('.cesis_content_slider_ctn').find('.owl-item').unwrap();
  jc('.cesis_content_slider_ctn').find('.owl-item > .vc_element').unwrap();
  jc('.cesis_content_slider_ctn').find('.owl-stage-outer > .vc_element').unwrap();
}

if ('function' !== typeof(window['cesis_owl_carousel'])) {
    window.cesis_owl_carousel = function() {



        jc('.cesis_owl_carousel').on('initialized.owl.carousel change.owl.carousel changed.owl.carousel', function(e) {

            if (!e.namespace || e.type != 'initialized' && e.property.name != 'position') return;
            var current = e.relatedTarget.current()
            var items = jc(this).find('.owl-stage').children()
            var a_items = jc(this).find('.owl-stage').children('.active').length;
            var add = e.type == 'changed' || e.type == 'initialized'
            items.eq(e.relatedTarget.normalize(current)).toggleClass('current', add)
            items.eq(e.relatedTarget.normalize(current)).find('.wpb_animate_when_almost_visible').addClass('wpb_start_animation animated');


            function items_animation(i) {
                if (a_items > 5) {
                    var speed = 150;
                } else if (a_items < 3) {
                    var speed = 300;
                } else {
                    var speed = 200;
                }
                if (i == 1) {
                    var delay = 0
                } else {
                    var delay = (i - 1) * speed;
                }
                setTimeout(function() {
                    items.eq(e.relatedTarget.normalize(current + i)).find('.wpb_animate_when_almost_visible').addClass('wpb_start_animation animated');
                }, delay);
            }
            for (var i = 1; i < a_items; i++) {
                items_animation(i);
            }



        });

        jc('.cesis_content_slider_ctn').on('initialized.owl.carousel change.owl.carousel changed.owl.carousel', function(e) {
          if (!e.namespace || e.type != 'initialized' && e.property.name != 'position') return;
          var current = e.relatedTarget.current()
          var items = jc(this).find('.owl-stage').children()
          var a_items = jc(this).find('.owl-stage').children('.active').length;
          var add = e.type == 'changed' || e.type == 'initialized'
          items.eq(e.relatedTarget.normalize(current)).find('.wpb_animate_when_almost_visible').removeClass('wpb_start_animation animated');
          setTimeout(function() {
            items.eq(e.relatedTarget.normalize(current)).find('.wpb_animate_when_almost_visible').each(function () {
              var element = jc(this),
              delayAttr = element.attr('data-delay');
              if (delayAttr == undefined) delayAttr = 0;
              setTimeout(function() {
                element.addClass('wpb_start_animation animated');
              }, (delayAttr));
            });
          }, 200);
        });

        jc('.cesis_owl_carousel').on('resize.owl.carousel change.owl.carousel changed.owl.carousel', function() {
            var iso_check = jc(this).closest('.cesis_isotope')
            var owl_stage = jc(this).find('.owl-stage-outer');
            var owl_height = jc(this);

            setTimeout(function() {
                iso_check.isotope('layout');
            }, 10);

            setTimeout(function() {
                var caca = owl_height.find('.owl-height');
                var test = caca.find('.active');
                var prout = test.outerHeight();
                owl_stage.height(prout);
                iso_check.isotope('layout');
            }, 200);

            setTimeout(function() {
                iso_check.isotope('layout');
            }, 400);
        });


        jc('.cesis_owl_carousel').each(function() {




            var id = jc(this).attr('id');
            var cesis_col = jc(this).data('col');
            var cesis_col_big = jc(this).data('col_big');
            var cesis_col_tablet = jc(this).data('col_tablet');
            var cesis_col_mobile = jc(this).data('col_mobile');
            var cesis_scroll = jc(this).data('scroll');
            var cesis_speed = jc(this).data('speed');
            var cesis_pag = jc(this).data('pag');
            var cesis_pag_tablet = jc(this).data('pag_tablet');
            var cesis_pag_mobile = jc(this).data('pag_mobile');
            var cesis_nav = jc(this).data('nav');
            var cesis_nav_tablet = jc(this).data('nav_tablet');
            var cesis_nav_mobile = jc(this).data('nav_mobile');
            var cesis_loop = jc(this).data('loop');
            var cesis_center = jc(this).data('center');
            var cesis_margin = jc(this).data('margin');
            var cesis_autoheight = jc(this).data('autoheight');


            if (cesis_col_big == null || cesis_col_big == "inherit"){
              cesis_col_big = cesis_col;
            }

            jc(this).owlCarousel({
                rtl: jc('body').hasClass('rtl') ? true : false,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: cesis_col_mobile,
                        dots: (cesis_pag_mobile == 'yes') ? true : false,
                        nav: (cesis_nav_mobile == 'yes') ? true : false,
                    },
                    780: {
                        items: cesis_col_tablet,
                        dots: (cesis_pag_tablet == 'yes') ? true : false,
                        nav: (cesis_nav_tablet == 'yes') ? true : false,
                    },
                    1000: {
                        items: cesis_col,
                        dots: (cesis_pag == 'yes') ? true : false,
                        nav: (cesis_nav == 'yes') ? true : false,
                    },
                    1600: {
                        items: cesis_col_big,
                        dots: (cesis_pag == 'yes') ? true : false,
                        nav: (cesis_nav == 'yes') ? true : false,
                    },
                },

                navContainer: jc(this),
                navText: ['<div class="owl-nav-container"><i class="fa fa-fw fa-angle-left"></i></div>', '<div class="owl-nav-container"><i class="fa fa-fw fa-angle-right"></i></div>'],

                autoplayTimeout: cesis_speed,
                autoplaySpeed: 800,
                autoplay: (cesis_scroll == 'yes') ? true : false,
                center: (cesis_center == 'yes') ? true : false,
                loop: (cesis_loop == 'yes') ? true : false,
                autoHeight: (cesis_autoheight == 'yes') ? true : false,
                margin: (cesis_margin !== '0' && cesis_col !== '1') ? cesis_margin : 0,

            });



        });



    }
};




////////////////////////////
//*** Animated Number ***//
//////////////////////////


if ('function' !== typeof(window['cesis_animated_number'])) {
    window.cesis_animated_number = function() {

        jc('.cesis_count_to').each(function() {


            var id = jc(this).attr('id');
            var cesis_number = jc(this).data('number');
            var cesis_separator = jc(this).data('separator');
            var cesis_decimal = jc(this).data('decimal');
            var cesis_d_separator = jc(this).data('d_separator');
            var cesis_prefix = jc(this).data('prefix');
            var cesis_suffix = jc(this).data('suffix');
            var cesis_speed = jc(this).data('speed');


            jc(this).cwaypoint(function() {
                var easingFn = function(t, b, c, d) {
                    var ts = (t /= d) * t;
                    var tc = ts * t;
                    return b + c * (tc * ts + -5 * ts * ts + 10 * tc + -10 * ts + 5 * t);
                }
                var options = {  
                    useEasing: true,
                      easingFn: easingFn,
                      useGrouping: true,
                      separator: cesis_separator,
                      decimal: cesis_d_separator,
                      prefix: cesis_prefix,
                      suffix: cesis_suffix,
                };
                var count_to = new CountUp(id, 0, cesis_number, cesis_decimal, cesis_speed, options);
                count_to.start();
                this.destroy();
            }, {
                offset: '85%'
            });


        })
    }
};


//////////////////////////////////
//*** Circular Progress Bar ***//
////////////////////////////////


if ('function' !== typeof(window['cesis_circular_progress_bar'])) {
    window.cesis_circular_progress_bar = function() {

        jc('.cesis_circular_pb_ctn').each(function() {


            var SET_PERCENTAGE = jc(this).children('.cesis_circular_pb_canvas').data('percentage-value');
            var status = jc(this).find('.cesis_cbp_percentage');
            console.log("cestlestatus"+status);
            var speed = jc(this).children('.cesis_circular_pb_canvas').data('speed');
            var linecap_style = jc(this).children('.cesis_circular_pb_canvas').data('linecap');
            var bar_color = jc(this).children('.cesis_circular_pb_canvas').data('bar-color');
            var alt_color = jc(this).children('.cesis_circular_pb_canvas').data('bar-alt-color');
            var track_color = jc(this).children('.cesis_circular_pb_canvas').data('track-color');
            var bar_size = jc(this).children('.cesis_circular_pb_canvas').data('bar-size');
            var track_size = jc(this).children('.cesis_circular_pb_canvas').data('track-size');
            var canvas_size = jc(this).children('.cesis_circular_pb_canvas').data('canvas-size');
            var radius = jc(this).children('.cesis_circular_pb_canvas').data('radius');
            var canvasid = jc(this).children('.cesis_circular_pb_canvas').attr('id');


            jc(this).cwaypoint(function() {


                        var requestAnimationFrame =
                                window.requestAnimationFrame ||       // According to the standard
                                window.mozRequestAnimationFrame ||    // For mozilla
                                window.webkitRequestAnimationFrame || // For webkit
                                window.msRequestAnimationFrame ||     // For ie
                                function (f) { window.setTimeout(function () { f(Date.now()); }, 1000/300); }; // If everthing else fails

                        var cancelAnimationFrame =
                                window.cancelAnimationFrame ||
                                window.mozCancelAnimationFrame ||
                                window.webkitCancelAnimationFrame ||
                                window.msCancelAnimationFrame;
                        var x = canvas_size;//set the x - center here
                        var y = canvas_size;//set the y - center here
                        var r = radius;//set the radius here
                        var linewidth = bar_size;//set the line width here

                //========

                        var c =  document.getElementById(canvasid);
                        var loaded = false;

                        window.onload = function () {

                            loaded = true;
                        }


                        var ROTATION = 0;

                        function setcanvas() {
                            var ctx = c.getContext("2d");

                            ctx.translate(x, y);
                            ctx.rotate((Math.PI / 180) * (-ROTATION));
                            ctx.translate(-x, -y);
                            ctx.clearRect(0, 0, c.width, c.height);

                            ctx.beginPath();
                            ctx.lineWidth = track_size;
                            ctx.strokeStyle = track_color;
                            ctx.arc(x, y, r, 0, 2 * Math.PI);
                            ctx.stroke();


                        }

                        function getPoint(c1, c2, radius, angle) {
                            return [c1 + Math.cos(angle) * radius, c2 + Math.sin(angle) * radius];
                        }

                        function setPercent(uplimit) {
                            var ctx = c.getContext("2d");
                            ctx.beginPath();
                            ctx.translate(x, y);
                            ROTATION = 270;
                            ctx.rotate((Math.PI / 180) * ROTATION);
                            ctx.translate(-x, -y);
                            ctx.lineWidth = linewidth;//40
                            ctx.lineCap = linecap_style;
                            var my_gradient = ctx.createLinearGradient(-0, 0, 0, 520);
                            my_gradient.addColorStop(0, bar_color);
                            my_gradient.addColorStop(1, alt_color);

                            ctx.strokeStyle = my_gradient;
                            ctx.arc(x, y, r, 0, (Math.PI / 180) * (-uplimit), false);
                            ctx.globalAlpha = 1;
                            ctx.stroke();


                        }
                        function callcanvas(degree) {
                            setcanvas();
                            setPercent(360 - degree);
                        }

                        var degree = parseInt((SET_PERCENTAGE * 360) / 100);
                        var start = 0;


                        function animatebar() {

                              start = start + speed;
                              if (start > degree) {

                                if(degree == 360 || degree == -360){
                                  status.html('100%');
                                  degree = -360;
                                }else{
                                  status.html(Math.round((degree * 100) / 360) + '%');
                                }
                                callcanvas(degree);
                                var BarAnimation = requestAnimationFrame(animatebar);
                              }else if(start == degree) {
                                start = degree;
                                if(degree == 360 || degree == -360){
                                    status.html('100%');
                                    degree = -360;
                                }else{
                                  status.html(Math.round((degree * 100) / 360) + '%');
                                }
                                callcanvas(degree);
                                var BarAnimation = requestAnimationFrame(animatebar);
                              }else {
                                callcanvas(start);
                                status.html(parseInt((start * 100) / 360) + '%');
                                var BarAnimation = requestAnimationFrame(animatebar);
                              }
                        }
                        animatebar();



                this.destroy();
            }, {
                offset: '85%'
            });


        })
    }
};


////////////////////////////
//***  Progress Bar   ***//
//////////////////////////

if ('function' !== typeof(window['vc_progress_bar'])) {
    window.vc_progress_bar = function() {

        if ('undefined' !== typeof(jQuery.fn.cwaypoint)) {
            jc('.vc_progress_bar').cwaypoint(function() {
                var pb_this = jc(this.element);
                jc(pb_this).find('.vc_single_bar').each(function(index) {
                    var $this = jc(this),
                        bar = $this.find('.vc_bar'),
                        stripe = $this.find('.cesis_progress_bar_effect'),
                        val = bar.data('percentage-value');



                    setTimeout(function() {
                        bar.css({
                            'width': val + '%'
                        });
                        stripe.css({
                            'width': val + '%'
                        });
                    }, index * 200);
                });
                this.destroy();
            }, {
                offset: '85%'
            });

        }
    }
}

//////////////////////////////////////////
//***  Visual Composer animations   ***//
////////////////////////////////////////

if ('function' !== typeof(window['vc_waypoints'])) {
    window.vc_waypoints = function() {
      if ('undefined' !== typeof(jc.fn.cwaypoint)) {
        jc('.wpb_animate_when_almost_visible:not(.wpb_start_animation):not(.inside_e)').cwaypoint(function() {
          var element = jc(this.element),
          delayAttr = element.attr('data-delay');
          if (delayAttr == undefined) delayAttr = 0;
          setTimeout(function() {
            element.addClass('wpb_start_animation animated');
          }, (delayAttr));
            this.destroy();
          }, {
            offset: '90%'
          });
        }
    }
}



//////////////////////////////////////////
//***          Accordion            ***//
////////////////////////////////////////

function cesis_accordion() {

    jc(document).on('click', '[data-toggle="tab"]', function(e) {
        e.preventDefault()
        jc(this).tab('show');
    });
    jc(document).on('click', '[data-toggle="collapse"]', function(e) {
        var $this = jc(this),
            href
        var target = $this.attr('data-target') || e.preventDefault() || (href = $this.attr('href')) && href.replace(/.*(?=#[^\s]+$)/, '')
        var $target = jc(target)
        var data = $target.data('bs.collapse')
        var option = data ? 'toggle' : $this.data()
        var parent = $this.attr('data-parent')
        var $parent = parent && jc(parent)
        var owl = jc($target).find('.owl-carousel');
        if (owl.data('owlCarousel')) {
            owl.data('owlCarousel').onThrottledResize();
        }
        var $title = jc(this).parent()
        if ($parent) {
            $parent.find('[data-toggle="collapse"][data-parent="' + parent + '"]').not($this).addClass('collapsed')
            if ($title.hasClass('active')) {
                $title.removeClass('active');
            } else {
                $parent.find('.panel-title').removeClass('active')
                $title[!$target.hasClass('in') ? 'addClass' : 'removeClass']('active')
            }
        }
        $this[$target.hasClass('in') ? 'addClass' : 'removeClass']('collapsed')
    });


}



//////////////////////////////////////////
//***          Tabs / Tour          ***//
////////////////////////////////////////

if ('function' !== typeof(window['cesis_tabs'])) {
    window.cesis_tabs = function() {
        var strHash = document.location.hash;

        jc('.tabs-wrapper').each(function() {
            var t = 1;

            jc(this).find('.tabli').each(function() {
                jc(this).parents('.tabs-wrapper').find('.tabs').append(this);
                t++;
            });
            /* GET ALL BODY */
            var t = 1;
            jc(this).find('.tab_content').each(function() {

                jc(this).parents('.tabs-wrapper').find('.tabs-container').append(this);
                t++;
            });
            jc(this).find('.tab_content').hide(); //Hide all content

            jc(this).find('ul.tabs li:first').addClass('active').show(); //Activate first tab

            jc(this).find('.tab_content:first').show(); //Show first tab content

        });

        var Tabs = jc('.cesis_tab_4');
        Tabs.each(function() {

            var current_width = jc(this).find('li.active a');
            jc('<span class="tab_moving_line"></span>').insertAfter(jc(this).find('.tabs li:first-child'));
            var Line = jc(this).find('.tab_moving_line');

            Line.width(current_width.width())
            Line.css('left', jc(this).find('li.active').position().left)
        });


        // Line moving effect
        function linemove() {
            var Tabs = jc('.cesis_tab_4');
            Tabs.each(function() {
                var el, leftPos, newWidth;

                var Line = jc(this).find('.tab_moving_line');

                Line.width(jc(this).find('li.active a').width())
                    .css('left', jc(this).find('li.active').position().left)
                    .data('origLeft', Line.position().left)
                    .data('origWidth', Line.width());

                jc('.cesis_tab_4 ul.tabs li a').on('click', function() {
                    el = jc(this);
                    leftPos = el.position().left;
                    newWidth = el.parent().width();
                });
            });
        }
        //On Click Event

        jc('.tabs-wrapper ul.tabs li').on('click', function(e) {

            jc(this).parents('.tabs-wrapper').find('ul.tabs li').removeClass('active'); //Remove any 'active' class
            jc(this).addClass('active'); //Add 'active' class to selected tab
            jc(this).parents('.tabs-wrapper').find('.tab_content').hide(); //Hide all tab content
            var activeTab = jc(this).find('a').attr('href'); //Find the href attribute value to identify the active tab + content
            jc(this).parents('.tabs-wrapper').find(activeTab).fadeIn(); //Fade in the active ID content
            jc('ul').trigger('updateSizes');
            linemove();
            var owl = jc(activeTab).find('.owl-carousel');
            if (owl.data('owlCarousel')) {
                owl.data('owlCarousel').onThrottledResize();
            }
            var iso_check = jc('.cesis_isotope')
            iso_check.isotope('layout');
            e.preventDefault();

        });

        jc('ul.wc-tabs li').on('click', function(e) {
          setTimeout(function() {
              linemove()
          }, 20);
        });

        jc('.tabs-wrapper ul.tabs > li > a').on('click', function(e) {
            e.preventDefault();


        });



        if (strHash) jc('.tabli a[href$="' + strHash + '"]').parent().trigger('click');


    }
}

//////////////////////////////////////////
//***            Lightbox           ***//
////////////////////////////////////////

if ('function' !== typeof(window['cesis_lightbox'])) {
    window.cesis_lightbox = function() {
        jc('.cesis_lightbox_si').lightGallery();
        jc('.cesis_lightbox_lg').lightGallery({
          selector:'.cesis_lightbox_el',
        });
        jc('.cesis_blog_m_thumbnail').lightGallery({
          selector:'.cesis_gallery_img',
        });
        jc('.cesis_portfolio_m_thumbnail').lightGallery({
          selector:'.cesis_gallery_img',
        });
        jc('.cesis_overlay_ctn').lightGallery({
          selector:'.cesis_hover_zoom',
        });
        jc('.cesis_gallery_ctn').lightGallery({
          selector:'.cesis_gallery_lightbox',
        });
        jc('.woocommerce-product-gallery__wrapper').lightGallery({
          selector:'.woocommerce-product-gallery__image',
        });

        // 1) ASSIGN EACH 'DOT' A NUMBER
        dotcount = 1;

        jQuery('.woocommerce-product-gallery__wrapper .owl-dot').each(function() {
          jQuery( this ).addClass( 'dotnumber' + dotcount);
          jQuery( this ).attr('data-info', dotcount);
          dotcount=dotcount+1;
        });

        // 2) ASSIGN EACH 'SLIDE' A NUMBER
        slidecount = 1;

        jQuery('.woocommerce-product-gallery__wrapper .owl-item').not('.cloned').each(function() {
          jQuery( this ).addClass( 'slidenumber' + slidecount);
          slidecount=slidecount+1;
        });

        // SYNC THE SLIDE NUMBER IMG TO ITS DOT COUNTERPART (E.G SLIDE 1 IMG TO DOT 1 BACKGROUND-IMAGE)
        jQuery('.woocommerce-product-gallery__wrapper .owl-dot').each(function() {

          grab = jQuery(this).data('info');

          slidegrab = jQuery('.slidenumber'+ grab +' img').attr('src');

          jQuery(this).css("background-image", "url("+slidegrab+")");

        });

        // THIS FINAL BIT CAN BE REMOVED AND OVERRIDEN WITH YOUR OWN CSS OR FUNCTION, I JUST HAVE IT
        // TO MAKE IT ALL NEAT
        amount = jQuery('.woocommerce-product-gallery__wrapper .owl-dot').length;
        gotowidth = 100/amount;

        jQuery('.woocommerce-product-gallery__wrapper .owl-dot').css("width", gotowidth+"%");
        newwidth = jQuery('.woocommerce-product-gallery__wrapper .owl-dot').width();
        jQuery('.woocommerce-product-gallery__wrapper .owl-dot').css("height", newwidth+"px");
        jQuery('body').on('change', '.variations select', function() {
        var mysrcset = jQuery('.slidenumber1 .woocommerce-product-gallery__image a img').attr('srcset');
        if (typeof mysrcset !== 'undefined'){ //checking if the srcset attribute is defined
        lastsrcset = mysrcset.split(',');
        lastsrc = lastsrcset[(lastsrcset.length - 1)];
        lastpuresrc = lastsrc.split(' ');
        mysrc = lastpuresrc[1];
        }
        // display or use src of biggest image src
        jQuery('.slidenumber1 .woocommerce-product-gallery__image').attr('data-src', mysrc);
        jQuery('.dotnumber1').css('background-image', 'url('+mysrc+')');

        // Action goes here.
        });


    }
}
