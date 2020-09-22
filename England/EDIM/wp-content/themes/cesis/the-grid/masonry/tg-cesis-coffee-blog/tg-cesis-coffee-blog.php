<?php
/**
* @package   The_Grid
* @author    Themeone <themeone.master@gmail.com>
* @copyright 2015 Themeone
*
* Skin Name: Cesis Coffee Blog
* Skin Slug: tg-cesis-coffee-blog
* Date: 07/25/18 - 01:06:28PM
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

$media = $tg_el->get_media();

// if there is a media
if ($media) {

	// Media wrapper start
	$output .= $tg_el->get_media_wrapper_start();

	// Media content (image, gallery, audio, video)
	$output .= $media;

	// if there is an image
	if ($image || in_array($format, array('gallery', 'video'))) {

		// Media content holder start
		$output .= $tg_el->get_media_content_start();




		// Top wrapper start
		$output .= '<div class="tg-top-holder">';
			$output .= $tg_el->get_the_terms(array('taxonomy' => 'post_tag', 'link' => true, 'color' => 'background', 'separator' => '', 'override' => true), 'tg-element-3 main_font');
		$output .= '</div>';
		// Top wrapper end

		// Media content holder end
		$output .= $tg_el->get_media_content_end();

	}

	$output .= $tg_el->get_media_wrapper_end();
	// Media wrapper end

}

// Bottom content wrapper start
$output .= $tg_el->get_content_wrapper_start('', 'bottom');
	$output .= $tg_el->get_the_title(array('link' => false, 'action' => array('type' => 'link', 'link_target' => '_self', 'link_url' => 'post_url', 'custom_url' => '', 'meta_data_url' => '')), 'tg-element-1 alt_font');
	$output .= $tg_el->get_the_excerpt(array('length' => '115', 'suffix' => '...'), 'tg-element-2 main_font');
	$output .= $tg_el->get_html_element(array('html' => 'Read More', 'action' => array('type' => 'link', 'link_target' => '_self', 'link_url' => 'post_url', 'custom_url' => '', 'meta_data_url' => '')), 'tg-element-4 cesis_alt_btn');
	$output .= $tg_el->get_content_clear();
$output .= $tg_el->get_content_wrapper_end();
// Bottom content wrapper end

return $output;