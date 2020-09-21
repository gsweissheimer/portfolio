<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.3.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $wp_query;
global $cesis_data;
$page_layout = $cesis_data['cesis_product_archive_layout'];
$nav_style = $cesis_data['cesis_product_archive_navigation_style'];
$nav_pos = $cesis_data['cesis_product_archive_navigation_pos'];
$nav_top_space = $cesis_data['cesis_product_archive_navigation_space']["height"];
if ( $wp_query->max_num_pages <= 1 ) {
	return;
}


echo '<div class="cesis_navigation_ctn '.$nav_pos.' '.$nav_style.'" style="margin-top:'.$nav_top_space.';">';
echo cesis_classic_navigation();
echo '</div>';
