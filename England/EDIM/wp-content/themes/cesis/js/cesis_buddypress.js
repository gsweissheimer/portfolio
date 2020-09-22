/**
 * cesis_custom.js
 *
 **/

var jc = jQuery;

jc.noConflict();

'use strict';


jc(document).ready(function() {
    cesis_bp_banner();
});


//////////////////////////////////////////////////
//***    Banner adjust for the buddypress   ***//
////////////////////////////////////////////////

if ('function' !== typeof(window['cesis_bp_banner'])) {
    window.cesis_bp_banner = function() {
      jc('.bp-user #item-header').detach().appendTo('.cesis_bp_top_container');
      jc('.bp-user #item-nav').detach().appendTo('.cesis_bp_top_container');
      jc('.buddypress.groups #item-header').detach().appendTo('.cesis_bp_top_container');
      jc('.buddypress.groups #item-nav').detach().appendTo('.cesis_bp_top_container');
      jc('.cesis_bp_top_container').css('opacity','1');
      jc('#buddypress').css('opacity','1');
      jc('.sidebar_ctn').css('opacity','1');
    }
}
