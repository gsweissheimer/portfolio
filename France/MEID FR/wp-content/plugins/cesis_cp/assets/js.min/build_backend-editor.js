;(function( cesis_TM, $ ) {

	Model = (function() {

		var _addButton = function() {

			var $wrap = $('#vc_no-content-helper' ),
			    $templateButton = $wrap.find('#vc_templates-more-layouts' ),
			    $openBlocksCatButton = $('#cesis_TM-button--show-blocks-categories' ),
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
