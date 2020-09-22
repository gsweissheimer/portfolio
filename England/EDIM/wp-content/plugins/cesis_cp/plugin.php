<?php
/*
Plugin Name: Cesis Custom Posts
Plugin URI: http://cesis.co/
Description: Plugin that will create a custom post type Portfolio / Staff / Partners / Career / Contnet Block for Cesis WordPress Theme.
Version: 1.3
Text Domain: cesis_cp
Author: Tranmautritam's Team
Author URI: http://themeforest.net/user/tranmautritam
License: GPLv2
*/

# Don't load directly
if( !defined( 'ABSPATH' ) ) {
	die( '-1' );
}


if( !defined( 'CP_PLUGIN_URL' ) ) {
	define( 'CP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if( !defined( 'CP_PLUGIN_BASENAME' ) ) {
	define( 'CP_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

if( !defined( 'CP_PLUGIN_DIR' ) ) {
	define( 'CP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
}

require_once( __DIR__ . '/include/cesis_cp.php' );
require_once( __DIR__ . '/include/cesis_wbpb_ext_tools.php' );
require_once( __DIR__ . '/include/simple-page-ordering.php' );

require_once( 'config/core_init.php' );

cesis_wbpb_ext();
