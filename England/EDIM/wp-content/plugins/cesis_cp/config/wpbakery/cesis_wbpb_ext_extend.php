<?php


require_once cesis_wbpb_ext_tools()->path( 'CONFIG_DIR', 'wpbakery/cesis_wbpb_ext_VC_Api.php' );
require_once cesis_wbpb_ext_tools()->path( 'CONFIG_DIR', 'wpbakery/cesis_wbpb_ext_VC_Layout.php' );

class cesis_wbpb_ext_extend {
	/**
	 * Page Now
	 *
	 * @since 1.1.0
	 * @var string
	 */
	public $pagenow = '';

	/**
	 * Visual Composer Layout Functions
	 *
	 * @since 1.0.0
	 * @var cesis_wbpb_ext_VC_Layout
	 */
	public $layout = array();

	/**
	 * Visual Composer Api Functions
	 *
	 * @since 1.0.0
	 * @var cesis_wbpb_ext_VC_Api
	 */
	public $api = array();

	/**
	 * Visual_Composer_Extend constructor.
	 *
	 * @param $parent
	 */
	function __construct() {
		$this->layout  = new cesis_wbpb_ext_VC_Layout();
		$this->api     = new cesis_wbpb_ext_VC_Api();
		$this->pagenow = $GLOBALS['pagenow'];

		/**
		 * Init After VC
		 *
		 * @since 1.0.0
		 */
		add_action( 'vc_after_init', array( $this, 'vc_after_init' ), 10 );
	}

	/**
	 * Load Mode
	 *
	 * @since       1.1.0
	 *
	 * @return      void
	 */
	public
	function vc_after_init() {

		# Check if the user is on post page
		if ( $this->pagenow != 'post-new.php' && $this->pagenow != 'post.php' )
			return;

		# Templatera Block
		if( cesis_wbpb_ext_tools()->getPostType() == 'templatera' || cesis_wbpb_ext_tools()->getPostType() == 'vc_grid_item')
			return;

		# Choose the mode
		if ( vc_mode() == 'admin_frontend_editor' ) {
			$this->init__frontend();
		}
		if ( vc_mode() == 'admin_page' ) {
			$this->init__backend();
		}
	}

	/**
	 * Init Frontend Options
	 *
	 * @since       1.0.0
	 *
	 * @return      void
	 */
	public
	function init__frontend() {
		/**
		 * Add custom class to body
		 *
		 * @since 1.0.0
		 */
		add_filter( 'admin_body_class', function ( $classes ) {
			$classes .= ' cesis_TM--admin-inline-editor-page ';

			return $classes;
		} );

		/**
		 * Build Navigation
		 */
		add_action( 'vc_frontend_editor_render', function () {
			add_filter( 'admin_title', array(
				                         vc_frontend_editor(),
				                         'setEditorTitle',
			                         ) );

			include __DIR__ . '/editor-layout/frontend_editor.tpl.php';

			die(); // must die otherwise will be conflict.
		} );
	}

	/**
	 * Init Backend Options
	 *
	 * @since       1.0.0
	 *
	 * @return      void
	 */
	public
	function init__backend() {
		add_filter( 'vc_nav_controls', function ( $buttons ) {
			$new_buttons   = array();


			# List Buttons
			foreach ( $buttons as $button ) {
				$new_buttons[] = $button;

				/**
				 * Add Block Button
				 *
				 * @since       1.0.0
				 */
				if ( $button[0] == 'templates' ) {
					$title = __( 'Show Blocks', 'cesis_cp' );
					$icon  = '<img class="cesis_TM--icon" src="'.cesis_wbpb_ext_tools()->path( 'ASSETS_IMG_URI', 'c_templates.png' ).'" />';

					$new_buttons[] = array(
						'cesis_wbpb_ext_blocks',
						'<li class="vc_show-mobile cesis_TM--blocks-btn-wrap">
					       <a   href="javascript:;"
					            class="-loading vc_icon-btn"
					            id="cesis_TM-button--show-blocks-categories"
					            title="'.$title.'"
					            >
					            '.$icon.'
					       </a>
						</li>'
					);
				}
			}

			return $new_buttons;
		}, 9 );
	}

}
