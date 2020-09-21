<?php


class cesis_wbpb_ext_blocks_wp_ajax {

	function __construct() {

		add_action( 'wp_ajax_cesis_TM__load_frontend__block', array( &$this, 'render_block__frontend' ) );
		add_action( 'wp_ajax_cesis_TM__load_backend__block', array( &$this, 'render_block__backend' ) );

		add_action( 'wp_ajax_cesis_TM__get_frontend__blocks_list_buttons', array( &$this, 'get_frontend__blocks_list_buttons' ) );
		add_action( 'wp_ajax_cesis_TM__get_backend__blocks_list_buttons', array( &$this, 'get_backend__blocks_list_buttons' ) );

	}


	public
	function render_block__frontend() {

		$id    = cesis_wbpb_ext_tools()->get__postParam( 'template_unique_id' );
		$key   = cesis_wbpb_ext_tools()->get__postParam( 'template_unique_key' );
		$group = cesis_wbpb_ext_tools()->get__postParam( 'template_unique_group' );

		if ( ! isset( $key ) || $group == "" ) {

			die( 'erro' );
		}

		add_filter( 'vc_frontend_template_the_content', function ( $content ) {
			return do_shortcode( $content );
		} );

		# Get Content
		$template = cesis_wbpb_ext()->blocks->blocksList[ $group ][ $key ]['content'];

		# Search for cdn alias
		if (strpos($template, cesis_wbpb_ext()->info->cdn->alias) !== false) {

			# Search for all
			do {
				$get_name = cesis_wbpb_ext()->info->cdn->alias . cesis_wbpb_ext_tools()->get__string_between(  $template,
				                                                                                                        cesis_wbpb_ext()->info->cdn->alias,
				                                                                                                        '"'
																													);

				# Upload Media
				$id = cesis_wbpb_ext()->shortcodes->tools->upload_media( $get_name );
				$template = str_replace($get_name, $id, $template);

				# No more? Break it!!
				if (strpos($template, cesis_wbpb_ext()->info->cdn->alias) === false)
					break;

			} while (true);

		}

		# Search for cdn url
		if (strpos($template, cesis_wbpb_ext()->info->cdn->url) !== false) {

			# Search for all
			do {
				$get_full_name = cesis_wbpb_ext_tools()->get__string_between(  $template, cesis_wbpb_ext()->info->cdn->url, ')' );
				$get_name = str_replace(cesis_wbpb_ext()->info->cdn->url, "", $get_full_name);
				$get_name = substr($get_name, 1);
				$get_name = str_replace('/', '-', $get_name);
				$get_name = cesis_wbpb_ext()->info->cdn->alias . $get_name;

				# Upload Media
				$id = cesis_wbpb_ext()->shortcodes->tools->upload_media( $get_name );
				$mediaURL = wp_get_attachment_url($id);
				$toReplace = $mediaURL . '?id=' . $id;

				$template = str_replace(cesis_wbpb_ext()->info->cdn->url.$get_full_name, $toReplace, $template);

				# No more? Break it!!
				if (strpos($template, cesis_wbpb_ext()->info->cdn->alias) === false)
					break;

			} while (true);

		}

		vc_frontend_editor()->setTemplateContent( trim( $template ) );
		vc_frontend_editor()->enqueueRequired();
		vc_include_template( 'editors/frontend_template.tpl.php', array(
			'editor' => vc_frontend_editor(),
		) );

		die();
	}

	public
	function render_block__backend() {
		$id    = cesis_wbpb_ext_tools()->get__postParam( 'template_unique_id' );
		$key   = cesis_wbpb_ext_tools()->get__postParam( 'template_unique_key' );
		$group = cesis_wbpb_ext_tools()->get__postParam( 'template_unique_group' );

		if ( ! isset( $key ) || $group == "" ) {

			die( 'erro' );
		}

		$template = cesis_wbpb_ext()->blocks->blocksList[ $group ][ $key ]['content'];

		$return = array(
			'block' => $template
		);

		wp_send_json_success( $return );
		die();
	}

	/**
	 * Load blocks buttons on frontend
	 *
	 * @since 1
	 */
	public
	function get_frontend__blocks_list_buttons() {

		# Image Base Path
		$imgPath = cesis_wbpb_ext_tools()->path( 'BLOCKS_IMG_ASSETS_URL', '/blocks' );

		# Start html build
		$html = '';
		foreach ( cesis_wbpb_ext()->blocks->autoload_blocks as $key => $val ) {
			$group      = ( isset( cesis_wbpb_ext()->blocks->blocksList[ $val->id ] ) ) ? cesis_wbpb_ext()->blocks->blocksList[ $val->id ] : false;
			$group_html = '';

			if( $group ) {
				# Load Blocks
				foreach ( $group as $group_key => $group_val ) {

					$group_html .=
<<<HTML
					<a  href="#"
						data-id="{$group_val['id']}"
						data-key="{$group_key}"
						data-group="{$group_val['group']}"
						>
						<i class="fa-downarrow-tail -add-block"></i>
						<i class="-spinner"></i>
						<i class="-added"></i>
						<img src="{$imgPath}/{$group_val['group']}/{$group_val['img']}">
					</a>
HTML;
				}
			}

			# Wrap Blocks
			$html .=
<<<HTML

	<div class="cesis_templates_list -{$val->id}">
		<p>{$val->name}</p>
		<span></span>

		$group_html
	</div>

HTML;
		}


		$return = array(
			'html' => $html
		);

		wp_send_json_success( $return );
		die();
	}

	/**
	 * Load blocks buttons on backend
	 *
	 * @since 1
	 */
	public
	function get_backend__blocks_list_buttons() {

		# Image Base Path
		$imgPath = cesis_wbpb_ext_tools()->path( 'BLOCKS_IMG_ASSETS_URL', '/blocks' );

		# Start html build
		$html = '';
		foreach ( cesis_wbpb_ext()->blocks->autoload_blocks as $key => $val ) {
			$group      = ( isset( cesis_wbpb_ext()->blocks->blocksList[ $val->id ] ) ) ? cesis_wbpb_ext()->blocks->blocksList[ $val->id ] : false;
			$group_html = '';

			if( $group ) {
				# Load Blocks
				foreach ( $group as $group_key => $group_val ) {

					$group_html .=
<<<HTML
					<a  href="#"
						data-id="{$group_val['id']}"
						data-key="{$group_key}"
						data-group="{$group_val['group']}"
						>
						<i class="fa-downarrow-tail -add-block"></i>
						<i class="-spinner"></i>
						<i class="-added"></i>
						<img src="{$imgPath}/{$group_val['group']}/{$group_val['img']}">
					</a>
HTML;
				}
			}

			# Wrap Blocks
			$html .=
				<<<HTML

	<div class="cesis_templates_list -{$val->id}">
		<p>{$val->name}</p>
		<span></span>

		$group_html
	</div>

HTML;
		}

		$return = array(
			'html' => include cesis_wbpb_ext_tools()->path( 'BLOCKS_DIR', 'config/editor-layout/blocks-nav-backend.tpl.php' )
		);

		wp_send_json_success( $return );
		die();
	}
}
