<?php
// don't load directly
if( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}

class cesis_wbpb_ext_tools
{
	public $paths = array();

	private static $_instance;

	public static
	function getInstance()
	{
		if( !( self::$_instance instanceof self ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	function __construct(  )
	{
		$this->paths = include __DIR__ . '/../config/settings/paths.php';
	}

	public
	function path( $name, $file = '' )
	{
		$path = $this->paths[ $name ] . ( strlen( $file ) > 0 ? '/' . preg_replace( '/^\//', '', $file ) : '' );

		return $path;
	}

	public
	function array_to_object($array) {
		if (!is_array($array)) {
			return $array;
		}

		if (is_array($array) && count($array) > 0) {
			return json_decode(json_encode($array), FALSE);
		} else {
			return false;
		}
	}


	function get__postParam( $param, $default = null ) {
		return isset( $_POST[ $param ] ) ? $_POST[ $param ] : $default;
	}


	function get__string_between($string, $start, $end){
		$string = ' ' . $string;
		$ini = strpos($string, $start);
		if ($ini == 0) return '';
		$ini += strlen($start);
		$len = strpos($string, $end, $ini) - $ini;
		return substr($string, $ini, $len);
	}


	public function getPostType() {
		$post_type = false;

		if ( isset( $_GET['post'] ) ) {
			$post_type = get_post_type( $_GET['post'] );
		} else if ( isset( $_GET['post_type'] ) ) {
			$post_type = $_GET['post_type'];
		}

		return $post_type;
	}
}

if( !function_exists( 'cesis_wbpb_ext_tools' ) ) {
	function cesis_wbpb_ext_tools()
	{
		return cesis_wbpb_ext_tools::getInstance();
	}
}
