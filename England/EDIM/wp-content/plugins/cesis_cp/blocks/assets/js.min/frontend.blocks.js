;(function( cesis_TM, $ ) {

	Model = (function() {

		// Elements
		var $wpbody = $('#wpbody-content');
		var $blocksContainer = $('.cesis_templates');
		var $browser    = $('#cesis_vc_inlineframe_overwrap');
		var $blocksBTN  = $('#cesis_TM-button--show-blocks-list');
		var $backToMenuBTN = $blocksContainer.find('#cesis_TM--go-back-to-nav');
		var $closeBlocksViewBTN_Overlayer = $wpbody.find('.cesis_TM--close-block-overlayer');
		var $blocksCategorieBTN = $blocksContainer.find('.-main-nav' ).find('a');
		var $blocksListContainer = $blocksContainer.find('.cesis_templates_container' );
		var $blocksListWrap = $blocksListContainer.find('.cesis_templates_list_wrapper' );


		/**
		 * Show Blocks Categroies Menu
		 *
		 * @since   1.0.0
		 * @version 1.0.0
		 */
		var _show_blocks_categories_nav = function( event ) {
			event.preventDefault();

			if( $browser.hasClass('-loading') )
				return;


			if( $browser.hasClass('-reveals-blocks-list-nav') ) {
				// # Close
				$browser.removeClass('-reveals-blocks-list-nav');
				$blocksContainer.removeClass('-show-me');
				$closeBlocksViewBTN_Overlayer.removeClass('-show-me');

				setTimeout(function(){
					$blocksListContainer.removeClass('-show-me');
				}, 900);

			} else {
				// # Open
				$browser.addClass('-reveals-blocks-list-nav');
				$blocksContainer.addClass('-show-me');
				$closeBlocksViewBTN_Overlayer.addClass('-show-me');

				// Se já foi aberto antes entao:
				if( $blocksContainer.hasClass('-show-categories') ) {
					$blocksListContainer.addClass('-show-me');
				}
			}
		};

		/**
		 * Show Blocks
		 *
		 * @since   1.0.0
		 * @version 1.0.0
		 */
		var _show_block_selected_category = function( event ) {
			event.preventDefault();

			var $button = $(event.currentTarget ),
			    category = $button.data('group-target');

			$browser.addClass('-reveals-blocks-list-group');
			$blocksContainer.addClass('-show-categories');
			$blocksListContainer.addClass('-show-me');
			$blocksListWrap
				.find('.cesis_templates_list.-'+category)
				.addClass('-show-me');
		};

		/**
		 * Show Blocks
		 *
		 * @since   1.0.0
		 * @version 1.0.0
		 */
		var _show_block_menu = function( event ) {
			event.preventDefault();
			$blocksContainer.removeClass('-show-categories');
			$browser.removeClass('-reveals-blocks-list-group');

			setTimeout(function(){
				$blocksContainer.removeClass('-show-categories');
				$blocksListContainer.removeClass('-show-me');
				$blocksListWrap
					.find('.cesis_templates_list')
					.removeClass('-show-me');

			}, 600);

		};




		// Add show categories button effect
		$blocksBTN.bind( "click", _show_blocks_categories_nav);
		$closeBlocksViewBTN_Overlayer.bind( "click", _show_blocks_categories_nav);

		// Add show category blocks
		$blocksCategorieBTN.bind( "click", _show_block_selected_category);
		// Add show category blocks
		$backToMenuBTN.bind( "click", _show_block_menu);



		return {};

	})();


	cesis_TM.back.editor.blocks = Model;


})( cesis_TM, jQuery);

;(function( cesis_TM, $ ) {

	Model = (function() {
		var ajax             = {
			    action__load_all_blocks: 'cesis_TM__get_frontend__blocks_list_buttons',
			    action__render_block: 'cesis_TM__load_frontend__block',
			    url: window.ajaxurl
		    },
		    $block_container = $( '#cesis_TM-cesis_templates_list_wrapper' ),
			$blocksBTN  = $('#cesis_TM-button--show-blocks-list');


		var load = function() {

			var jqxhr = $.ajax( {
					type: 'POST',
					url: ajax.url,
					data: {
						action: ajax.action__load_all_blocks
					}
				} )
				.success( function( response ) {
					$block_container.html( response.data.html );
					$block_container.find( 'a' ).bind( "click", _render_block );
					$blocksBTN.find('.-loading' ).remove();
				} )
				.error( function() {
					console.log( "Error loading blocks" );
				} );
		};

		var _render_block = function( event ) {
			event.preventDefault();

			var $button = $( event.currentTarget ),
			    data    = {
				    id: $button.data( 'id' ),
				    key: $button.data( 'key' ),
				    group: $button.data( 'group' )
			    };

			if( $button.hasClass( '-loading' ) )
				return;

			$button.addClass( '-loading' );

			var jqxhr = $.ajax( {
					type: 'POST',
					url: ajax.url,
					data: {
						action: ajax.action__render_block,
						template_unique_id: data.id,
						template_unique_key: data.key,
						template_unique_group: data.group,
						vc_inline: true
					}
				} )
				.success( function( html ) {

					$button.addClass( '-added' );

					setTimeout(function(){
						$button
							.removeClass( '-loading' )
							.removeClass( '-added' );
					}, 4000);

					if( html != "error" ) {
						vc.TemplatesPanelViewFrontend.prototype.renderTemplate( html );

						setTimeout(function(){
							window.vc.$frame_body
								.animate({
									scrollTop: window.vc.$frame_body.find("#vc_no-content-helper").prev().offset().top
								}, {
									duration:1000
								});
						}, 600);


					}

				} )
				.error( function() {
					console.log( "Error rendering block" );
				} );

		};

		return {
			load: load
		};

	})();

	window.vc.events.on( "app.render", Model.load() );

})( cesis_TM, jQuery );
