<?php
/**
* @package   The_Grid
* @author    Themeone <themeone.master@gmail.com>
* @copyright 2015 Themeone
*
* Skin Name: Cesis Coffee On Image Blog
* Skin Slug: tg-cesis-coffee-on-image-blog
* Date: 07/25/18 - 04:29:01PM
*
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

// Init The Grid Elements instance
$tg_el = The_Grid_Elements();

// Prepare main data for futur conditions
$image  = $tg_el->get_attachment_url();
$format = $tg_el->get_item_format();

$output = null;

	// Media wrapper start
	$output .= $tg_el->get_media_wrapper_start();

	// Media content (image, gallery, audio, video)
	$output .= $tg_el->get_media();

		// Media content holder start
		$output .= $tg_el->get_media_content_start();

		// Overlay
		$output .= $tg_el->get_overlay();

		// Bottom wrapper start
		$output .= '<div class="tg-bottom-holder">';
			$output .= $tg_el->get_the_terms(array('taxonomy' => 'category', 'link' => true, 'color' => 'background', 'separator' => '', 'override' => true), 'tg-element-1 cesis_gridb_coffee_date main_font');
			$output .= $tg_el->get_the_title(array('link' => false, 'action' => array('type' => 'link', 'link_target' => '_self', 'link_url' => 'post_url', 'custom_url' => '', 'meta_data_url' => '')), 'tg-element-2 alt_font');
			$output .= $tg_el->get_html_element(array('html' => ''), 'tg-element-4');
			$output .= $tg_el->get_the_excerpt(array('length' => '160', 'suffix' => '...'), 'tg-element-3 main_font');
		$output .= '</div>';
		// Bottom wrapper end

		// Media content holder end
		$output .= $tg_el->get_media_content_end();

	$output .= $tg_el->get_media_wrapper_end();
	// Media wrapper end


return $output;