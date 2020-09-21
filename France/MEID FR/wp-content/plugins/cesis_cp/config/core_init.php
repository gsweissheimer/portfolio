<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

require_once cesis_wbpb_ext_tools()->path( 'CONFIG_DIR', 'wpbakery/cesis_wbpb_ext_extend.php' );

require_once cesis_wbpb_ext_tools()->path( 'BLOCKS_DIR', 'cesis_wbpb_ext_blocks_manager.php' );

class cesis_wbpb_extension__Manager {

	const  PLUGIN_NAME = "Cesis Custom Posts";
	public $info = array();
	public $theme_info = array();
	private static $_instance;
	private $paths = array();
	public $vc = array();
	public $blocks = array();

	/**
	 * Get current screen
	 *
	 * @since   1.0.0
	 * @var     object
	 */
	public $current_screen = null;


	public static
	function getInstance() {
		if ( ! ( self::$_instance instanceof self ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	function __construct() {
		add_action( 'plugins_loaded', array( $this, 'plugins_loaded' ) );
	}

	function plugins_loaded() {

		$this->paths = include __DIR__ . '/settings/paths.php';

		$wp_get_theme = wp_get_theme();
		$this->theme_info =  (object) array(
			'name' =>  strtolower( $wp_get_theme->get( 'Name' ) ),
			'version' => $wp_get_theme->get( 'Version' ),
		);

		$this->vc = new cesis_wbpb_ext_extend();
		$this->blocks = new cesis_wbpb_ext_blocks_manager();

		add_action( 'vc_after_init', array( $this, 'vc_after_init' ), 10 );
	}

	public
	function vc_after_init() {

		if ( is_admin() ) {
			add_action( 'admin_enqueue_scripts', array( $this, 'editor__backend__enqueue_scripts' ), 10 );
			add_action( 'admin_enqueue_scripts', array( $this, 'backend__enqueue_scripts' ) );
		} else {
			add_action( 'wp_enqueue_scripts', array( $this, 'frontend__enqueue_scripts' ) );
		}
	}

	public
	function path( $name, $file = '' ) {
		$path = $this->paths[ $name ] . ( strlen( $file ) > 0 ? '/' . preg_replace( '/^\//', '', $file ) : '' );
		return $path;
	}


	public
	function backend__enqueue_scripts() {

		wp_register_style( 'cesis_wbpb_ext_backend', $this->path( 'ASSETS_URI', 'css.min/backend.css'), null );
		wp_enqueue_style( 'cesis_wbpb_ext_backend' );
	}


	public
	function editor__backend__enqueue_scripts() {
		$allowed_pages = array('page',
		                       'post',
		                       'portfolio',
		                       'staff',
		                       'product',
		                       'content_block'
							);

		if( ! cesis_wbpb_ext_tools()->getPostType() )
			return;

		if( ! in_array(cesis_wbpb_ext_tools()->getPostType(), $allowed_pages) )
			return;


		wp_register_style( 'cesis_wbpb_ext_backend', $this->path( 'ASSETS_URI', 'css.min/backend.css'), null );
		wp_enqueue_style( 'cesis_wbpb_ext_backend' );


		if( vc_mode() == 'admin_frontend_editor'  ) {
			wp_register_style( 'cesis_wbpb_ext_frontend_editor', $this->path( 'ASSETS_URI', 'css.min/backend.frontend.editor.css'), null );
			wp_enqueue_style( 'cesis_wbpb_ext_frontend_editor' );
		}
		if( vc_mode() == 'admin_page'  ) {
			wp_register_style( 'cesis_wbpb_ext_backend_editor', $this->path( 'ASSETS_URI', 'css.min/backend.editor.css'), null );
			wp_enqueue_style( 'cesis_wbpb_ext_backend_editor' );
		}

		wp_register_script( 'cesis_wbpb_ext_vender-backend', $this->path( 'ASSETS_URI', 'js.min/vendor-backend.js'), array( 'jquery' ), null, true );
		wp_enqueue_script( 'cesis_wbpb_ext_vender-backend' );

		wp_register_script( 'cesis_wbpb_ext_core_backend', $this->path( 'ASSETS_URI', 'js.min/backend.js'), array( 'jquery', 'cesis_wbpb_ext_vender-backend' ), null, true );

		wp_enqueue_script( 'cesis_wbpb_ext_core_backend' );

		if( vc_mode() == 'admin_frontend_editor'  ) {
			wp_register_script( 'cesis_wbpb_ext_build_frontend-editor', $this->path( 'ASSETS_URI', 'js.min/build_frontend-editor.js' ), array( 'cesis_wbpb_ext_core_backend' ), null, true );
			wp_enqueue_script( 'cesis_wbpb_ext_build_frontend-editor' );

			wp_register_script( 'cesis_wbpb_ext_blocks', cesis_wbpb_ext_tools()->path( 'BLOCKS_URI', 'assets/js.min/frontend.blocks.js' ), array( 'cesis_wbpb_ext_core_backend' ), null, true );
			wp_enqueue_script( 'cesis_wbpb_ext_blocks' );
		}
		if( vc_mode() == 'admin_page'  ) {
			wp_register_script( 'cesis_wbpb_ext_build_backend-editor', $this->path( 'ASSETS_URI', 'js.min/build_backend-editor.js' ), array( 'cesis_wbpb_ext_core_backend' ), null, true );
			wp_enqueue_script( 'cesis_wbpb_ext_build_backend-editor' );

			wp_register_script( 'cesis_wbpb_ext_blocks', cesis_wbpb_ext_tools()->path( 'BLOCKS_URI', 'assets/js.min/backend.blocks.js' ), array( 'cesis_wbpb_ext_core_backend', 'vc-backend-actions-js' ), null, true );
			wp_enqueue_script( 'cesis_wbpb_ext_blocks' );
		}
	}

	public
	function frontend__enqueue_scripts() {

		if( cesis_wbpb_ext()->vc->api->in_frontend_editor() )
			$this->editor__backend__enqueue_scripts();


		if( cesis_wbpb_ext()->vc->api->in_frontend_editor() ) {

			wp_register_style( 'cesis_wbpb_ext_compose-mode', $this->path( 'ASSETS_URI', 'css.min/backend.frontend.compose-mode.css'), null );
			wp_enqueue_style( 'cesis_wbpb_ext_compose-mode' );
		}

	}


	public
	function install() {
	}

	private
	function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'No no' ) );
	}

	private
	function __sleep() {
		_doing_it_wrong( __FUNCTION__, __( 'No no' ) );
	}

	/**
	 * De-serialization disabled
	 */
	private
	function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'No no' ) );
	}



}


if ( ! function_exists( 'cesis_wbpb_ext' ) ) {
	function cesis_wbpb_ext() {
		return cesis_wbpb_extension__Manager::getInstance();
	}
}
