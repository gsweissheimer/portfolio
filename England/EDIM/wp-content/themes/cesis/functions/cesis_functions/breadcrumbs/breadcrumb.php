<?php
/*
Plugin Name: Breadcrumb
Plugin URI: http://pickplugins.com
Description: Awesome simple Breadcrumb for wordpress ( modified by Tranmautritam team. )
Version: 1.0
Author: pickplugins ( modified by Tranmautritam team. )
Author URI: http://pickplugins.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access


class cesis_BreadcrumbMain{

	public function __construct(){


		define('breadcrumb_dir', get_template_directory_uri());


		require_once( 'includes/functions.php');

		require_once( 'includes/class-breadcrumb.php');


		}




	}

new cesis_BreadcrumbMain();
