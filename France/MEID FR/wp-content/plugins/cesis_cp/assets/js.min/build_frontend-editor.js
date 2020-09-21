
;(function( cesis_TM, $ ) {

	Model = (function() {

		var $headerContainer = $('#vc_navbar' ),
			$fullscreen_button = $headerContainer.find('.-fullscreen-mode');

		var _fullscreen_toggle = function( event ) {
			event.preventDefault();

			var $button = $(event.currentTarget );

			if( !$button.hasClass('-active') ) {
				$button.addClass('-active');
				window.vc.$frame_body.removeClass('compose-mode');

			} else {
				$button.removeClass('-active');
				window.vc.$frame_body.addClass('compose-mode');
			}
		};

		$fullscreen_button.bind( "click", _fullscreen_toggle);

		return {};

	})();

})( cesis_TM, jQuery);

;(function( cesis_TM, $ ) {

	Model = (function() {

		var _addButton = function() {
			var $wrap = cesis_TM.api.vcIframe('document').find('#vc_no-content-helper' ),
			    $templateButton = $wrap.find('#vc_templates-more-layouts' ),
			    $openBlocksCatButton = $('#cesis_TM-button--show-blocks-list' ),
			    buttonHtml = '';

			buttonHtml += '<a class="vc_general vc_ui-button vc_ui-button-shape-rounded cesis_TM--add-first-block" href="#" target="_blank">';
			buttonHtml += 'Cesis Studio</a>';

			$templateButton.after( buttonHtml );

			$wrap.find('.cesis_TM--add-first-block').bind( "click", function(event) {
				event.preventDefault();
				$openBlocksCatButton.trigger( "click" );
			} );

		};

		$( document ).ready(function() {
			if(typeof window.vc != 'undefined') {
				window.vc.events.on( 'app.render', function() {
					_addButton();
				} );
			}
		});


		return {};

	})();

})( cesis_TM, jQuery);
