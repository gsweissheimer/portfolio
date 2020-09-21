<?php
if( !defined( 'ABSPATH' ) )
	die( '-1' );

require_once cesis_wbpb_ext_tools()->path( 'BLOCKS_DIR', 'config/wp-ajax/cesis_wbpb_ext_blocks_wp_ajax.php' );

/**
 * Class cesis_wbpb_extension__blocks_manager
 */
class cesis_wbpb_ext_blocks_manager
{
	/**
	 * Page Now
	 *
	 * @since 1.1.0
	 * @var string
	 */
	public $pagenow = '';
	/**
	 * Active Blocks
	 *
	 * @since   1.0.0
	 * @return  array
	 */
	public $autoload_blocks = array();
	/**
	 * Blocks
	 *
	 * @since 1.0.0
	 * @var array
	 */
	public $blocksList = array();

	public
	function __construct( )
	{
		$this->pagenow = $GLOBALS['pagenow'];

		/**
		 * Autoload Blocks
		 *
		 * @since 1.0.0
		 */
		$this->autoload_blocks = cesis_wbpb_ext_tools()->array_to_object( include __DIR__ . '/config/autoload.blocks.php' );
		foreach ( $this->autoload_blocks as $key => $val ) {
			require_once( __DIR__ . "/config/available-blocks/{$val->id}.list.php" );
		}

		/**
		 * Load WP Ajax Calls
		 *
		 * @since 1.0.0
		 */
		new cesis_wbpb_ext_blocks_wp_ajax();

		/**
		 * Init After VC
		 *
		 * @since 1.0.0
		 */
		add_action( 'vc_after_init', array( $this, 'vc_after_init' ), 10 );
	}

	/**
	 * Init Plugin Settings
	 *
	 * @since       1.0.0
	 *
	 * @return      void
	 */
	public
	function vc_after_init() {

	}

	/**
	 *  Add custom template to PT templates list
	 *  $data = array( 'name'=>'', 'image'=>'', 'content'=>'' )
	 *
	 * @since  1
	 *
	 * @param  $data
	 *
	 * @return boolean true if added, false if failed
	 */
	public
	function add__block( $data )
	{
		if( is_array( $data ) && !empty( $data ) && isset( $data['id'], $data['content'] ) ) {
			if( !is_array( $this->blocksList ) ) {
				$this->blocksList = array();
			}

			$this->blocksList[ $data['group'] ][] = $data;

			return true;
		}

		return false;
	}


} // End Class
