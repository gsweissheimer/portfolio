;(function( cesis_TM, $ ) {

	Model = (function() {

		var init = function() {
			// Elements
			var $body = $('body');
			var $wpbody = $('#wpbody-content');
			var $blocksContainer = $('#cesis_templates');
			var $blocksCategorieBTN = $blocksContainer.find('.-main-nav' ).find('a');
			var $blocksBTN  = $('#cesis_TM-button--show-blocks-categories');

			var $backToMenuBTN = $blocksContainer.find('#cesis_TM--go-back-to-nav');
			var $blocksListContainer = $blocksContainer.find('.cesis_templates_container' );
			var $blocksListWrap = $blocksListContainer.find('.cesis_templates_list_wrapper' );


			var _show_blocks_categories_nav = function( event ) {
				event.preventDefault();

				if( $blocksBTN.hasClass('-loading') )
					return;

				$blocksBTN.addClass('-loading');

				if( ! $body.hasClass('cesis_TM--show-block-categories') ) {
					$body.addClass('cesis_TM--show-block-categories');
					setTimeout(function(){
						$blocksBTN.removeClass('-loading');
					}, 400);
				} else {
					if( $body.hasClass('-show-categories') ) {

						$body.addClass('-without-animation');
						$body.addClass('-hide-blocks-nav');

						setTimeout(function(){
							$blocksListWrap.find('.cesis_templates_list').removeClass('-show-me');
							$body.removeClass('-show-categories');
							$body.removeClass('cesis_TM--show-block-categories');
						}, 100);

						setTimeout(function(){
							$body.removeClass('-hide-blocks-nav');
							$body.removeClass('-without-animation');
							$blocksBTN.removeClass('-loading');
						}, 200);

					} else {
						$body.removeClass('cesis_TM--show-block-categories');
						setTimeout(function(){
							$blocksBTN.removeClass('-loading');
						}, 400);
					}
				}
			};


			var _show_block_selected_category = function( event ) {
				event.preventDefault();

				var $button = $(event.currentTarget ),
				    category = $button.data('group-target');

				$body.addClass('-show-categories');
				$blocksListWrap
					.find('.cesis_templates_list.-'+category)
					.addClass('-show-me');
			};


			var _show_block_menu = function( event ) {
				event.preventDefault();
				$body.removeClass('-show-categories');
				setTimeout(function(){
					$blocksListWrap
						.find('.cesis_templates_list')
						.removeClass('-show-me');

				}, 600);
			};




			$blocksBTN.bind( "click", _show_blocks_categories_nav);

			$blocksCategorieBTN.bind( "click", _show_block_selected_category);

			$backToMenuBTN.bind( "click", _show_block_menu);

		};


		return {
			init:init
		};

	})();

	cesis_TM.back.editor.blocks = Model;

})( cesis_TM, jQuery);

;(function( cesis_TM, $ ) {

	Model = (function() {
		var ajax             = {
			    action__load_all_blocks: 'cesis_TM__get_backend__blocks_list_buttons',
			    action__render_block: 'cesis_TM__load_backend__block',
			    url: window.ajaxurl
		    },
		    $block_container = $( '#adminmenumain' ),
			$blocksBTN  = $('#cesis_TM-button--show-blocks-categories');



		var load = function() {

			var jqxhr = $.ajax( {
					type: 'POST',
					url: ajax.url,
					data: {
						action: ajax.action__load_all_blocks
					}
				} )
				.success( function( response ) {
					$block_container.append( '<div id="cesis_templates">'+ response.data.html +'</div>' );
					$block_container.find('#cesis_TM-cesis_templates_list_wrapper' ).find( 'a' ).bind( "click", _render_block );
					$blocksBTN.removeClass('-loading' );

					cesis_TM.back.editor.blocks.init();
				} )
				.error( function() {
					console.log( "Error loading blocks" );
				} );
		};

		/**
		 * Show Blocks Categroies Menu
		 *
		 * @since   1.0.0
		 * @version 1.0.0
		 */
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

					if( html != "erro" ) {
						vc.TemplateWindowUIPanelBackendEditor.prototype.renderTemplate( html.data.block );
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
