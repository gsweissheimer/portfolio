;(function($, window, document, _){
	"use strict";

	var BaseIconSelect = $('.dev-selecticon-extension');

	var IconSelect = {
		init: function(){

			IconSelect.setup(BaseIconSelect);

			// $(document).ajaxComplete(function(){
			// 	IconSelect.setup(BaseIconSelect);
			// });
		},

		setup: function(base){
			base.each(function(){
				var $this = $(this);

				IconSelect.spectrum($this);
				IconSelect.sortable($this);
				IconSelect.searchIcon($this);
				IconSelect.insertIcon($this);
				IconSelect.removeButton($this);
				IconSelect.changeUrl($this);
				IconSelect.status($this);
			});
		},

		spectrum: function(parent){
			if($.fn.spectrum){
				// Colors
				$(parent).find('.dev-iconselect.dev-iconselect-colors').each(function(){
					var $this = $(this),
						defaultColor = $this.data('dev-default') == 'undefined' ? '#000000' : $this.data('dev-default');

					$this.spectrum({
						showInput: true,
						showPaletteOnly: true,
					    togglePaletteOnly: true,
					    togglePaletteMoreText: 'more',
					    togglePaletteLessText: 'less',
					    color: defaultColor,
					    palette: [
					        ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
					        ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
					        ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
					        ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
					        ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
					        ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
					        ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
					        ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
					    ],
						change: function(color){
							if($.type(color) !== "null"){
								$this.closest('li').find('input#font-color').val(color.toHexString());
							}else{
								$this.closest('li').find('input#font-color').val('transparent');
							}
						}
					});
				});

				// Hover
				$(parent).find('.dev-iconselect.dev-iconselect-hover').each(function(){
					var $this = $(this),
						defaultColor = $this.data('dev-default') == 'undefined' ? '#000000' : $this.data('dev-default');

					$this.spectrum({
						showInput: true,
						showPaletteOnly: true,
					    togglePaletteOnly: true,
					    togglePaletteMoreText: 'more',
					    togglePaletteLessText: 'less',
					    color: defaultColor,
					    palette: [
					        ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
					        ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
					        ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
					        ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
					        ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
					        ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
					        ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
					        ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
					    ],
						change: function(color){
							if($.type(color) !== "null"){
								$this.closest('li').find('input#font-hover').val(color.toHexString());
							}else{
								$this.closest('li').find('input#font-hover').val('transparent');
							}
						}
					});
				});

				// Background Color
				$(parent).find('.dev-iconselect.dev-iconselect-background').each(function(){
					var $this = $(this),
						defaultColor = $this.data('dev-default') == 'undefined' ? 'transparent' : $this.data('dev-default');

					$this.spectrum({
						showInput: true,
						showPaletteOnly: true,
					    togglePaletteOnly: true,
					    togglePaletteMoreText: 'more',
					    togglePaletteLessText: 'less',
					    allowEmpty:true,
					    color: defaultColor,
					    palette: [
					        ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
					        ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
					        ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
					        ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
					        ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
					        ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
					        ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
					        ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
					    ],
						change: function(color){
							if($.type(color) !== "null"){
								$this.closest('li').find('input#font-background').val(color.toHexString());
							}else{
								$this.closest('li').find('input#font-background').val('transparent');
							}
						}
					});
				});

				// Background Hover Color
				$(parent).find('.dev-iconselect.dev-iconselect-background-hover').each(function(){
					var $this = $(this),
						defaultColor = $this.data('dev-default') == 'undefined' ? 'transparent' : $this.data('dev-default');

					$this.spectrum({
						showInput: true,
						showPaletteOnly: true,
					    togglePaletteOnly: true,
					    togglePaletteMoreText: 'more',
					    togglePaletteLessText: 'less',
					    allowEmpty:true,
					    color: defaultColor,
					    palette: [
					        ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
					        ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
					        ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
					        ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
					        ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
					        ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
					        ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
					        ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
					    ],
						change: function(color){
							if($.type(color) !== "null"){
								$this.closest('li').find('input#font-background-hover').val(color.toHexString());
							}else{
								$this.closest('li').find('input#font-background-hover').val('transparent');
							}
						}
					});
				});
			}
		},

		sortable: function(parent){
			$(parent).find('.dev-selecticon-details').sortable({
				placeholder: "ui-state-highlight",
				handle: '.dev-icon-preview'
			});
		},

		changeUrl: function(parent){
			$(parent).find('.dev-icon-link-url input[type="text"]').live('keyup', function(){
				var $this = $(this),
					value = $this.val();

					$this.closest('li').find('input#font-url').val(value);
			});
		},

		status: function(parent){
			$(parent).find('.dev-icon-enabled input[type="checkbox"]').live('change', function(){
				var $this = $(this);
					if($this.prop('checked')){
						$this.closest('li').find('input#font-enable').val("true");
					}else{
						$this.closest('li').find('input#font-enable').val("false");
					}
			});
		},

		list: function(parent, Hclass = false){
			if(Hclass === false){
				return $(parent).find('#dev-list-icons-preview > ul > li');
			}else{
				return $(parent).find('#dev-list-icons-preview > ul > li'+Hclass);
			}
		},

		templateData: function(parent){
			var html = parent.find('#dev-icon-box-template').first().html();
			var tmp  = _.template(html);

			return tmp;
		},

		searchIcon: function(parent){
			var lists = this.list(parent),
				searchInput = $(parent).find('#filter').first();

			this.filter(searchInput, lists);
		},

		filter: function(searchInput, lists){

			searchInput.keyup(function () {
			    var value = this.value;

			    lists.each(function () {
			        if ($(this).data('name').search(value.toLowerCase()) > -1) {
			            $(this).show();
			        } else {
			            $(this).hide();
			        }
			    });
			});
		},

		insertIcon: function(parent){
			var lists 				= this.list(parent);
			var template_generate 	= this.templateData(parent);

			lists.on('click', function(event){
				event.preventDefault();
				var $this 		= $(this),
					hidden      = $this.data('container-name') !== 'undefined' ? $this.data('container-name') : false,
					title 		= $this.data('title') !== 'undefined' ? $this.data('title') : false,
					name  		= $this.data('name') !== 'undefined' ? $this.data('name') : false,
					id 	  		= $this.data('id') !== 'undefined' ? $this.data('id') : false,
					class_name 	= $this.data('class-name') !== 'undefined' ? $this.data('class-name') : false,
					suffix 	  	= $this.data('suffix') !== 'undefined' ? $this.data('suffix') : false,
					url 	  	= $this.data('url') !== 'undefined' ? $this.data('url') : false,
					color 	  	= $this.data('color') !== 'undefined' ? $this.data('color') : false,
					hover 	  	= $this.data('hover') !== 'undefined' ? $this.data('hover') : false,
					background 	= $this.data('background') !== 'undefined' ? $this.data('background') : false,
					backgroundHover 	= $this.data('background-hover') !== 'undefined' ? $this.data('background-hover') : false;

					if(hidden && title && name && id && suffix && url ){
						if(IconSelect.checkId(id, parent)){
							$(parent).find('.dev-selecticon-details').first().append(template_generate({
								id: id,
								classn: class_name,
								hidden: hidden,
								suffix: suffix,
								name: name,
								title: title,
								url: url,
								color: color,
								hover: hover,
								background: background,
								bhover: backgroundHover,
								enable: true
							}));

							$this.addClass('active');

							var icon = $(parent).find('.dev-selecticon-details').find('li#social-'+id);

							// ReCall Spectrum
							IconSelect.spectrum(icon);
							// ReCall Sortable
							IconSelect.sortable($this);
						}else{
							if(confirm("Are you sure!!")){
								IconSelect.removeIcon(id, parent);
								$this.removeClass('active');
							}
						}
					}else{
						alert("Something is wrong please contact developer of theme");
					}
			});
		},

		removeButton: function(parent){

			$(parent).find('.dev-icon-reset').live('click', function(event){
				event.preventDefault();
				if(confirm("Are you sure!!")){
					var id = $(this).closest('li').attr('id').split('-');
					var list = IconSelect.list(parent, '.dev-'+id[1]);

					IconSelect.removeIcon(id[1], parent);
					list.removeClass('active');
				}
			});
		},

		checkId: function(id, parent){
			var icon = $(parent).find('.dev-selecticon-details').find('li#social-'+id);
			if(icon.length > 0){
				return false;
			}else{
				return true;
			}
		},

		removeIcon: function(id,parent){
			var icon = $(parent).find('.dev-selecticon-details').find('li#social-'+id);
				if(icon.length > 0){
					icon.remove();
				}
		}
	}

	IconSelect.init();

})( jQuery, window, document, _);
