
var cesis_TM                       = ( typeof cesis_TM != 'undefined' && cesis_TM	instanceof Array ) ? cesis_TM : {};
cesis_TM.front                     = ( typeof cesis_TM.front != 'undefined' && cesis_TM.front instanceof Array ) ? cesis_TM.front : {};
cesis_TM.front.shortcode           = ( typeof cesis_TM.front.shortcode != 'undefined' && cesis_TM.front.shortcode instanceof Array ) ? cesis_TM.front.shortcode : {};

cesis_TM.atts                      = ( typeof cesis_TM.atts != 'undefined' && cesis_TM.atts instanceof Array ) ? cesis_TM.atts : {};
cesis_TM.back                      = ( typeof cesis_TM.back != 'undefined' && cesis_TM.back instanceof Array ) ? cesis_TM.back : {};
cesis_TM.back.mix                  = ( typeof cesis_TM.back.mix != 'undefined' && cesis_TM.back.mix instanceof Array ) ? cesis_TM.back.mix : {};
cesis_TM.back.editor               = ( typeof cesis_TM.back.editor != 'undefined' && cesis_TM.back.editor instanceof Array ) ? cesis_TM.back.editor : {};
cesis_TM.back.shortcode            = ( typeof cesis_TM.back.shortcode != 'undefined' && cesis_TM.back.shortcode instanceof Array ) ? cesis_TM.back.shortcode : {};
cesis_TM.back.params               = ( typeof cesis_TM.back.params != 'undefined' && cesis_TM.back.params instanceof Array ) ? cesis_TM.back.params : {};
cesis_TM.front.shortcode.vc_editor = ( typeof cesis_TM.front.shortcode.vc_editor != 'undefined' && cesis_TM.front.shortcode.vc_editor instanceof Array ) ? cesis_TM.front.shortcode.vc_editor : {};

/**
 * Plugin Config */
cesis_TM.tools = {};
cesis_TM.vendor = {};
cesis_TM.config = {};
cesis_TM.events = jQuery('body');



(function( $, cesis_TM, window, document, undefined ) {
	'use strict';

	var functions = {
		html_parseJSON: html_parseJSON,
		parse__stringToObject: parse__stringToObject
	};

	cesis_TM.tools = functions;

	/**
	 * @name html_parseJSON
	 * @desc parseJSON and replace ' before
	 * @returns {object}
	 * @memberOf window.pt_ext.tools.html_parseJSON
	 */
	function html_parseJSON(_string) {
		return $.parseJSON( _string.replace(/\'/g, '"') );
	}

	/**
	 * Parse a string with options
	 * @private
	 * @param {String} str
	 * @returns {Object|String}
	 */
	function parse__stringToObject(str) {
		var obj = {};
		var delimiterIndex;
		var option;
		var prop;
		var val;
		var arr;
		var len;
		var i;

		// Remove spaces around delimiters and split
		arr = str.replace(/\s*:\s*/g, ':').replace(/\s*,\s*/g, ',').split(',');

		// Parse a string
		for (i = 0, len = arr.length; i < len; i++) {
			option = arr[i];

			// Ignore urls and a string without colon delimiters
			if (
				option.search(/^(http|https|ftp):\/\//) !== -1 ||
				option.search(':') === -1
			) {
				break;
			}

			delimiterIndex = option.indexOf(':');
			prop = option.substring(0, delimiterIndex);
			val = option.substring(delimiterIndex + 1);

			// If val is an empty string, make it undefined
			if (!val) {
				val = undefined;
			}

			// Convert a string value if it is like a boolean
			if (typeof val === 'string') {
				val = val === 'true' || (val === 'false' ? false : val);
			}

			// Convert a string value if it is like a number
			if (typeof val === 'string') {
				val = !isNaN(val) ? +val : val;
			}

			obj[prop] = val;
		}

		// If nothing is parsed
		if (prop == null && val == null) {
			return str;
		}

		return obj;
	}

})( jQuery, cesis_TM, window, document );


(function( $, cesis_TM, window, document, undefined ) {
	'use strict';

	var functions = {
		vcIframe: vcIframe,
		is_frontend: is_frontend
	};


	cesis_TM.api = functions;
	/**
	 * @name vcIframe
	 * @desc Get vc iframe window object
	 * @returns {object}
	 * @memberOf window._pt_ext.api.vcIframe
	 */
	function vcIframe(_type) {
		_type = _type || 'window';
		if(jQuery( '#vc_inline-frame' ).length) {
			if(_type == 'window') {
				return $( '#vc_inline-frame' )[0].contentWindow.window.window.cesis_TM;
			} else if (_type == 'document') {
				return $('body').find('#vc_inline-frame').contents();
			}
		} else {
			return false;
		}
	}

	/**
	 * @name is_frontend
	 * @desc Check if is frontend mode
	 * @returns {bollen}
	 * @memberOf window._pt_ext.api
	 */
	function is_frontend() {
		if( vc_mode == 'admin_frontend_editor')
			return true;
		else
			return false
	}




})( jQuery, cesis_TM, window, document );
