<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Cesis
 */

global $cesis_data;
$post =$wp_query->post;

get_header();



$custom_layout = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_blog_custom_layout" );

if($custom_layout == "yes"){
$blog_post_style = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_blog_sp_style" );
}else{
$blog_post_style = $cesis_data["cesis_blog_sp_style"];
}


if(get_post_type() == 'portfolio'){
	include(TEMPLATEPATH.'/template-parts/single-portfolio.php');
}elseif(get_post_type() == 'staff'){
	include(TEMPLATEPATH.'/template-parts/single-staff.php');
}elseif(get_post_type() == 'content_block'){
	include(TEMPLATEPATH.'/template-parts/single-cb.php');
}elseif(get_post_type() == 'careers'){
	include(TEMPLATEPATH.'/template-parts/single-position.php');
}
elseif($blog_post_style == "single_post_layout_two"){
	include(TEMPLATEPATH.'/template-parts/single-writer.php');
}
elseif($blog_post_style == "single_post_layout_three"){
	include(TEMPLATEPATH.'/template-parts/single-boxes.php');
}
elseif($blog_post_style == "single_post_layout_four"){
	include(TEMPLATEPATH.'/template-parts/single-agency.php');
}
elseif($blog_post_style == "single_post_layout_six"){
	include(TEMPLATEPATH.'/template-parts/single-career.php');
}
elseif($blog_post_style == "single_post_layout_seven"){
	include(TEMPLATEPATH.'/template-parts/single-lifestyle.php');
}
elseif($blog_post_style == "single_post_layout_eight"){
	include(TEMPLATEPATH.'/template-parts/single-classic.php');
}
elseif($blog_post_style == "single_post_layout_nine"){
	include(TEMPLATEPATH.'/template-parts/single-classic-boxed.php');
}
else{
	include(TEMPLATEPATH.'/template-parts/single-default.php');
} ?>
