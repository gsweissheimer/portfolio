/**
 * cesis_custom.js
 *
 **/

var jc = jQuery;

jc.noConflict();

'use strict';


jc(document).ready(function() {
    cesis_woo_thumbnail();
    cesis_woo_add_to_cart();
    cesis_woo_dropdown();



});




//////////////////////////////////////////
//***    Single product thumbnail   ***//
////////////////////////////////////////

if ('function' !== typeof(window['cesis_woo_thumbnail'])) {
    window.cesis_woo_thumbnail = function() {

        dotcount = 1;

        jc('.woocommerce-product-gallery__wrapper .owl-dot').each(function() {
          jc( this ).addClass( 'dotnumber' + dotcount);
          jc( this ).attr('data-info', dotcount);
          dotcount=dotcount+1;
        });

        slidecount = 1;

        jc('.woocommerce-product-gallery__wrapper .owl-item').not('.cloned').each(function() {
          jc( this ).addClass( 'slidenumber' + slidecount);
          slidecount=slidecount+1;
        });

        jc('.woocommerce-product-gallery__wrapper .owl-dot').each(function() {

          grab = jc(this).data('info');

          slidegrab = jc('.slidenumber'+ grab +' img').attr('src');
          console.log(slidegrab);

          jc(this).css("background-image", "url("+slidegrab+")");

        });

        amount = jc('.woocommerce-product-gallery__wrapper .owl-dot').length;
        gotowidth = 100/amount;

        jc('.woocommerce-product-gallery__wrapper .owl-dot').css("width", gotowidth+"%");
        newwidth = jc('.woocommerce-product-gallery__wrapper .owl-dot').width();
        jc('.woocommerce-product-gallery__wrapper .owl-dot').css("height", newwidth+"px");
        jc('body').on('change', '.variations select', function() {
        var mysrcset = jc('.slidenumber1 .woocommerce-product-gallery__image a img').attr('srcset');
        if (typeof mysrcset !== 'undefined'){
        lastsrcset = mysrcset.split(',');
        lastsrc = lastsrcset[(lastsrcset.length - 1)];
        lastpuresrc = lastsrc.split(' ');
        mysrc = lastpuresrc[1];
        }
        jc('.slidenumber1 .woocommerce-product-gallery__image').attr('data-src', mysrc);
        jc('.dotnumber1').css('background-image', 'url('+mysrc+')');

        });


    }
}


if ('function' !== typeof(window['cesis_woo_add_to_cart'])) {
    window.cesis_woo_add_to_cart = function() {
      jc('body').on('click', '.cesis_add_to_cart .add_to_cart_button', function() {
		      var product = jc(this).parents('.product:eq(0)').addClass('adding_to_cart_working').removeClass('adding_to_cart_completed');
	    })
	    jc('body').bind('added_to_cart', function() {
        jc('.adding_to_cart_working').removeClass('adding_to_cart_working').addClass('adding_to_cart_completed');
	    });
    }
}

if ('function' !== typeof(window['cesis_woo_dropdown'])) {
  window.cesis_woo_dropdown = function() {
    jc('.cart-menu').smartmenus({

      		mainMenuSubOffsetX: -1,
      		subMenusSubOffsetX: 0,
      		subMenusSubOffsetY: 0,
          subMenusMaxWidth:'300px',
          subMenusMinWidth:'300px',
          subIndicators:false,
          hideFunction:null,
          hideDuration:0,
          hideTimeout:400,
          showFunction:null,
          showDuration:0,
          showTimeout:0,
          keepInViewport:true,
          rightToLeftSubMenus:true,
  });
  }
}
