<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Cesis
 */

global $cesis_data;


$body_class = $blockid = '';


$custom_general_settings = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_general_settings');

if($custom_general_settings == 'yes'){
	$body_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_body_type');
	$body_shadow = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_body_shadow');
}else{
	$body_layout = $cesis_data['cesis_body_type'];
	$body_shadow = $cesis_data['cesis_body_shadow'];
}

// top banner
$custom_banner = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_banner');
$custom_banner_pos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_banner_pos');
if(is_404()){
$banner_type = $cesis_data['cesis_404_banner'];
if(isset($cesis_data['cesis_404_block_content'])){
$blockid = $cesis_data['cesis_404_block_content'];
}else{
	$blockid = "";
}
if(isset($cesis_data['cesis_404_rev_slider'])){
$sliderid = $cesis_data['cesis_404_rev_slider'];
}
if(isset($cesis_data['cesis_404_layer_slider'])){
$layersliderid = $cesis_data['cesis_404_layer_slider'];
}
}elseif( is_search()){
	$banner_type = $cesis_data['cesis_search_banner'];
  if(isset($cesis_data['cesis_search_block_content'])){
    $blockid = $cesis_data['cesis_search_block_content'];
  }else{
    $blockid = "";
  }

	if(isset($cesis_data['cesis_search_rev_slider'])){
	$sliderid = $cesis_data['cesis_search_rev_slider'];
	}
	if(isset($cesis_data['cesis_search_layer_slider'])){
	$layersliderid = $cesis_data['cesis_search_layer_slider'];
	}
}elseif(is_archive() && get_post_type() == 'post' || is_home() ){
	$banner_type = $cesis_data['cesis_post_a_banner'];
  if(isset($cesis_data['cesis_post_a_block_content'])){
    $blockid = $cesis_data['cesis_post_a_block_content'];
  }else{
    $blockid = "";
  }

	if(isset($cesis_data['cesis_post_a_rev_slider'])){
	$sliderid = $cesis_data['cesis_post_a_rev_slider'];
	}
	if(isset($cesis_data['cesis_post_a_layer_slider'])){
	$layersliderid = $cesis_data['cesis_post_a_layer_slider'];
	}
}elseif(is_archive() && get_post_type() == 'portfolio'){
	$banner_type = $cesis_data['cesis_portfolio_a_banner'];
	if(isset($cesis_data['cesis_portfolio_a_block_content'])){
	$blockid = $cesis_data['cesis_portfolio_a_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_portfolio_a_rev_slider'])){
	$sliderid = $cesis_data['cesis_portfolio_a_rev_slider'];
	}
	if(isset($cesis_data['cesis_portfolio_a_layer_slider'])){
	$layersliderid = $cesis_data['cesis_portfolio_a_layer_slider'];
	}
}elseif(is_archive() && get_post_type() == 'staff'){
	$banner_type = $cesis_data['cesis_staff_a_banner'];
	if(isset($cesis_data['cesis_staff_a_block_content'])){
	$blockid = $cesis_data['cesis_staff_a_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_staff_a_rev_slider'])){
	$sliderid = $cesis_data['cesis_staff_a_rev_slider'];
	}
	if(isset($cesis_data['cesis_staff_a_layer_slider'])){
	$layersliderid = $cesis_data['cesis_staff_a_layer_slider'];
	}
}elseif(is_archive() && get_post_type() == 'careers'){
	$banner_type = $cesis_data['cesis_career_a_banner'];
	if(isset($cesis_data['cesis_career_a_block_content'])){
	$blockid = $cesis_data['cesis_career_a_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_career_a_rev_slider'])){
	$sliderid = $cesis_data['cesis_career_a_rev_slider'];
	}
	if(isset($cesis_data['cesis_career_a_layer_slider'])){
	$layersliderid = $cesis_data['cesis_career_a_layer_slider'];
	}
}elseif(cesis_check_bbp_status() == true && cesis_is_bbpress() == true){
	$banner_type = $cesis_data['cesis_bbpress_banner'];
	if(isset($cesis_data['cesis_bbpress_block_content'])){
	$blockid = $cesis_data['cesis_bbpress_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_bbpress_rev_slider'])){
	$sliderid = $cesis_data['cesis_bbpress_rev_slider'];
	}
	if(isset($cesis_data['cesis_bbpress_layer_slider'])){
	$layersliderid = $cesis_data['cesis_bbpress_layer_slider'];
	}
}elseif(cesis_check_bp_status() == true && cesis_is_buddypress()){
	$banner_type = $cesis_data['cesis_buddypress_banner'];
	if(isset($cesis_data['cesis_buddypress_block_content'])){
	$blockid = $cesis_data['cesis_buddypress_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_buddypress_rev_slider'])){
	$sliderid = $cesis_data['cesis_buddypress_rev_slider'];
	}
	if(isset($cesis_data['cesis_buddypress_layer_slider'])){
	$layersliderid = $cesis_data['cesis_buddypress_layer_slider'];
	}
}elseif(cesis_check_woo_status() == true && is_shop() || cesis_check_woo_status() == true && is_product_category() || cesis_check_woo_status() == true && is_product_tag()){
	$banner_type = $cesis_data['cesis_product_archive_banner'];
	if(isset($cesis_data['cesis_product_archive_block_content'])){
	$blockid = $cesis_data['cesis_product_archive_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_product_archive_rev_slider'])){
	$sliderid = $cesis_data['cesis_product_archive_rev_slider'];
	}
	if(isset($cesis_data['cesis_product_archive_layer_slider'])){
	$layersliderid = $cesis_data['cesis_product_archive_layer_slider'];
	}
}elseif(is_singular() && !is_page()  && get_post_type() !== 'post' && get_post_type() !== 'portfolio' && get_post_type() !== 'staff' && get_post_type() !== 'careers' && get_post_type() !== 'product'){
	$banner_type = $cesis_data['cesis_page_banner'];
	if(isset($cesis_data['cesis_page_block_content'])){
	$blockid = $cesis_data['cesis_page_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_page_rev_slider'])){
	$sliderid = $cesis_data['cesis_page_rev_slider'];
	}
	if(isset($cesis_data['cesis_page_layer_slider'])){
	$layersliderid = $cesis_data['cesis_page_layer_slider'];
	}
}elseif($custom_banner !== 'inherit'){
	$banner_type = $custom_banner;
	$blockid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_block_content');
	$sliderid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_rev_slider');
	$layersliderid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_layer_slider');
}elseif(cesis_check_woo_status() == true && is_product()){
	$banner_type = $cesis_data['cesis_shop_banner'];
	if(isset($cesis_data['cesis_shop_block_content'])){
	$blockid = $cesis_data['cesis_shop_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_shop_rev_slider'])){
	$sliderid = $cesis_data['cesis_shop_rev_slider'];
	}
	if(isset($cesis_data['cesis_shop_layer_slider'])){
	$layersliderid = $cesis_data['cesis_shop_layer_slider'];
	}
}elseif(get_post_type() == 'post'){
	$banner_type = $cesis_data['cesis_post_banner'];
  if(isset($cesis_data['cesis_post_block_content'])){
    $blockid = $cesis_data['cesis_post_block_content'];
  }else{
    $blockid = "";
  }
	if(isset($cesis_data['cesis_post_rev_slider'])){
		$sliderid = $cesis_data['cesis_post_rev_slider'];
	}
	if(isset($cesis_data['cesis_post_layer_slider'])){
		$layersliderid = $cesis_data['cesis_post_layer_slider'];
	}
}elseif(get_post_type() == 'portfolio'){
	$banner_type = $cesis_data['cesis_portfolio_banner'];
	if(isset($cesis_data['cesis_portfolio_block_content'])){
	$blockid = $cesis_data['cesis_portfolio_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_portfolio_rev_slider'])){
	$sliderid = $cesis_data['cesis_portfolio_rev_slider'];
	}
	if(isset($cesis_data['cesis_portfolio_layer_slider'])){
	$layersliderid = $cesis_data['cesis_portfolio_layer_slider'];
	}
}elseif(get_post_type() == 'staff'){
	$banner_type = $cesis_data['cesis_staff_banner'];
	if(isset($cesis_data['cesis_staff_block_content'])){
	$blockid = $cesis_data['cesis_staff_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_staff_rev_slider'])){
	$sliderid = $cesis_data['cesis_staff_rev_slider'];
	}
	if(isset($cesis_data['cesis_staff_layer_slider'])){
	$layersliderid = $cesis_data['cesis_staff_layer_slider'];
	}
}elseif(get_post_type() == 'careers'){
	$banner_type = $cesis_data['cesis_career_banner'];
	if(isset($cesis_data['cesis_career_block_content'])){
	$blockid = $cesis_data['cesis_career_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_career_rev_slider'])){
	$sliderid = $cesis_data['cesis_career_rev_slider'];
	}
	if(isset($cesis_data['cesis_career_layer_slider'])){
	$layersliderid = $cesis_data['cesis_career_layer_slider'];
	}
}else {
	$banner_type = $cesis_data['cesis_page_banner'];
	if(isset($cesis_data['cesis_page_block_content'])){
	$blockid = $cesis_data['cesis_page_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_page_rev_slider'])){
	$sliderid = $cesis_data['cesis_page_rev_slider'];
	}
	if(isset($cesis_data['cesis_page_layer_slider'])){
	$layersliderid = $cesis_data['cesis_page_layer_slider'];
	}
}

if(is_404()){
	$banner_pos = $cesis_data['cesis_404_banner_pos'];
}elseif(is_search()){
	$banner_pos = $cesis_data['cesis_search_banner_pos'];
}elseif(is_archive() && get_post_type() == 'post' || is_home() ){
	$banner_pos = $cesis_data['cesis_post_a_banner_pos'];
}elseif(is_archive() && get_post_type() == 'portfolio'){
	$banner_pos = $cesis_data['cesis_portfolio_a_banner_pos'];
}elseif(is_archive() && get_post_type() == 'staff'){
	$banner_pos = $cesis_data['cesis_staff_a_banner_pos'];
}elseif(is_archive() && get_post_type() == 'careers'){
	$banner_pos = $cesis_data['cesis_career_a_banner_pos'];
}elseif(cesis_check_bbp_status() == true && cesis_is_bbpress() == true){
	$banner_pos = $cesis_data['cesis_bbpress_banner_pos'];
}elseif(cesis_check_bp_status() == true && cesis_is_buddypress()){
	$banner_pos = $cesis_data['cesis_buddypress_banner_pos'];
}elseif(cesis_check_woo_status() == true && is_shop() || cesis_check_woo_status() == true && is_product_category() || cesis_check_woo_status() == true && is_product_tag()){
	$banner_pos = $cesis_data['cesis_product_archive_banner_pos'];
}elseif(is_singular() && !is_page()  && get_post_type() !== 'post' && get_post_type() !== 'portfolio' && get_post_type() !== 'staff' && get_post_type() !== 'careers' && get_post_type() !== 'product'){
$banner_pos = $cesis_data['cesis_page_banner_pos'];
}elseif($custom_banner_pos !== 'inherit'){
	$banner_pos = $custom_banner_pos;
}elseif(cesis_check_woo_status() == true && is_product()){
	$banner_pos = $cesis_data['cesis_shop_banner_pos'];
}elseif(get_post_type() == 'post'){
	$banner_pos = $cesis_data['cesis_post_banner_pos'];
}elseif(get_post_type() == 'portfolio'){
	$banner_pos = $cesis_data['cesis_portfolio_banner_pos'];
}elseif(get_post_type() == 'staff'){
	$banner_pos = $cesis_data['cesis_staff_banner_pos'];
}elseif(get_post_type() == 'careers'){
	$banner_pos = $cesis_data['cesis_career_banner_pos'];
}else {
	$banner_pos = $cesis_data['cesis_page_banner_pos'];
}

$custom_general_header = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_general_header');
$meta_header_sticky = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_sticky');
$meta_header_sticky_hiding = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_sticky_hiding');
$meta_header_state = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_transparent');
$meta_header_shadow = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_shadow');
$meta_header_shrink = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_shrink');

$custom_top_bar = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_topbar');

$custom_top_bar_breakpoint = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_top_bar_breakpoint');
$top_bar_breakpoint = $cesis_data['cesis_top_bar_breakpoint'];

$meta_top_bar = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_topbar');

$custom_header = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_header');
$meta_header = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header');

$custom_breakpoint = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_breakpoint');

// header layout

if(is_404() || is_search()){
	$header_layout = $cesis_data['cesis_header_layout'];
	$v_header_pos = $cesis_data['cesis_header_v_pos'];
}
elseif($custom_header == 'yes' && !is_archive() && !cesis_is_buddypress() && cesis_is_bbpress() !== true ){
	$header_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_layout');
	$v_header_pos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_v_pos');
	$dda = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_menu_dda');
}else {
	$header_layout = $cesis_data['cesis_header_layout'];
	$v_header_pos = $cesis_data['cesis_header_v_pos'];
	$dda = $cesis_data['cesis_menu_dda'];
}


// sticky header
if($header_layout !== 'vertical_header'){
	if($custom_general_header == 'yes' && $meta_header_sticky !== 'inherit' && !is_archive() && $header_layout !== 'vertical_header'){
		$header_sticky = $meta_header_sticky;
		($header_sticky !== 'no_sticky' ?	$is_sticky = 'cesis_sticky' : $is_sticky = '');
	}else{
		$header_sticky = $cesis_data['cesis_header_sticky'];
		($header_sticky !== 'no_sticky' ?	$is_sticky = 'cesis_sticky' : $is_sticky = '');
	}
}else {
	$header_sticky = $cesis_data['cesis_header_sticky'];
	$is_sticky = '';
}
$body_class .= ' '.$header_sticky.' ';

// sticky header hiding
if($header_layout !== 'vertical_header'){
	if($custom_general_header == 'yes' && $meta_header_sticky_hiding !== 'inherit' && !is_archive()){
		($meta_header_sticky_hiding == 'cesis_header_hiding' ?	$is_hiding = $meta_header_sticky_hiding : $is_hiding = '');
	}else{
		($cesis_data['cesis_header_sticky_hiding'] == 'cesis_header_hiding' ? $is_hiding = $cesis_data['cesis_header_sticky_hiding'] : $is_hiding = '');
	}
}else {
	$is_hiding = '';
}

// header shrink
if($header_layout !== 'vertical_header'){
	if($custom_general_header == 'yes' && $meta_header_shrink !== 'inherit' && !is_archive()){
		($meta_header_shrink == 'cesis_header_shrink' ?	$is_shrinking = $meta_header_shrink : $is_shrinking = '');
	}else{
		($cesis_data['cesis_header_shrink'] == 'cesis_header_shrink' ?$is_shrinking = $cesis_data['cesis_header_shrink'] : $is_shrinking = '');
	}
}else {
	$is_shrinking = '';
}

// header shadow

if(is_404() || is_search()){
	$header_shadow = $cesis_data['cesis_header_shadow'];
}elseif($custom_general_header == 'yes' && $meta_header_shadow !== 'inherit' && !is_archive()){
	$header_shadow = $meta_header_shadow;
}else{
	$header_shadow = $cesis_data['cesis_header_shadow'];
}

// transparent header

if(is_404()){
$header_state = $cesis_data['cesis_404_header_transparent'];
}elseif (is_search()) {
$header_state = $cesis_data['cesis_search_header_transparent'];
}elseif(is_archive() && get_post_type() == 'post' || is_home() ){
$header_state = $cesis_data['cesis_post_a_header_transparent'];
}elseif(is_archive() && get_post_type() == 'portfolio'){
$header_state = $cesis_data['cesis_portfolio_a_header_transparent'];
}elseif(is_archive() && get_post_type() == 'staff'){
$header_state = $cesis_data['cesis_staff_a_header_transparent'];
}elseif(is_archive() && get_post_type() == 'careers'){
$header_state = $cesis_data['cesis_career_a_header_transparent'];
}elseif(cesis_check_bp_status() == true && cesis_is_buddypress()){
$header_state = $cesis_data['cesis_buddypress_header_transparent'];
}elseif(cesis_check_bbp_status() == true &&  cesis_is_bbpress() == true){
$header_state = $cesis_data['cesis_bbpress_header_transparent'];
}elseif(cesis_check_woo_status() == true && is_shop() || cesis_check_woo_status() == true && is_product_category() || cesis_check_woo_status() == true && is_product_tag()){
$header_state = $cesis_data['cesis_product_archive_header_transparent'];
}elseif(is_singular() && !is_page()  && get_post_type() !== 'post' && get_post_type() !== 'portfolio' && get_post_type() !== 'staff' && get_post_type() !== 'careers' && get_post_type() !== 'product'){
$header_state = $cesis_data['cesis_page_header_transparent'];
}elseif($custom_general_header == 'yes' && $meta_header_state !== 'inherit' && !is_archive()){
$header_state = $meta_header_state;
}elseif(cesis_check_woo_status() == true && is_product()){
$header_state = $cesis_data['cesis_shop_header_transparent'];
}elseif(get_post_type() == 'post'){
$header_state = $cesis_data['cesis_post_header_transparent'];
}elseif(get_post_type() == 'portfolio'){
$header_state = $cesis_data['cesis_portfolio_header_transparent'];
}elseif(get_post_type() == 'staff'){
$header_state = $cesis_data['cesis_staff_header_transparent'];
}elseif(get_post_type() == 'careers'){
$header_state = $cesis_data['cesis_career_header_transparent'];
}else{
$header_state = $cesis_data['cesis_page_header_transparent'];
}

// top bar

if(is_404()){
$top_bar = $cesis_data['cesis_404_topbar'];
}elseif(is_search()){
$top_bar = $cesis_data['cesis_search_topbar'];
}elseif(is_archive() && get_post_type() == 'post' || !is_front_page() && is_home() ){
$top_bar = $cesis_data['cesis_post_a_topbar'];
}elseif(is_archive() && get_post_type() == 'portfolio'){
$top_bar = $cesis_data['cesis_portfolio_a_topbar'];
}elseif(is_archive() && get_post_type() == 'staff'){
$top_bar = $cesis_data['cesis_staff_a_topbar'];
}elseif(is_archive() && get_post_type() == 'careers'){
$top_bar = $cesis_data['cesis_career_a_topbar'];
}elseif(cesis_check_bp_status() == true && is_buddypress()){
$top_bar = $cesis_data['cesis_buddypress_topbar'];
}elseif(cesis_check_bbp_status() == true && cesis_is_bbpress() == true){
$top_bar = $cesis_data['cesis_bbpress_topbar'];
}elseif(cesis_check_woo_status() == true && is_shop() || cesis_check_woo_status() == true && is_product_category() || cesis_check_woo_status() == true && is_product_tag()){
$top_bar = $cesis_data['cesis_product_archive_topbar'];
}elseif(is_singular() && !is_page()  && get_post_type() !== 'post' && get_post_type() !== 'portfolio' && get_post_type() !== 'staff' && get_post_type() !== 'careers' && get_post_type() !== 'product'){
$top_bar = $cesis_data['cesis_page_topbar'];
}elseif($meta_top_bar !== 'inherit' && !is_archive()){
$top_bar = $meta_top_bar;
}elseif(cesis_check_woo_status() == true && is_product()){
$top_bar = $cesis_data['cesis_shop_topbar'];
}elseif(get_post_type() == 'post'){
$top_bar = $cesis_data['cesis_post_topbar'];
}elseif(get_post_type() == 'portfolio'){
$top_bar = $cesis_data['cesis_portfolio_topbar'];
}elseif(get_post_type() == 'staff'){
$top_bar = $cesis_data['cesis_staff_topbar'];
}elseif(get_post_type() == 'careers'){
$top_bar = $cesis_data['cesis_career_topbar'];
}else{
$top_bar = $cesis_data['cesis_page_topbar'];
}

// header
if(is_404()){
$header = $cesis_data['cesis_404_header'];
}elseif(is_search()){
$header = $cesis_data['cesis_search_header'];
}elseif(is_archive() && get_post_type() == 'post' || is_home() ){
$header = $cesis_data['cesis_post_a_header'];
}elseif(is_archive() && get_post_type() == 'portfolio'){
$header = $cesis_data['cesis_portfolio_a_header'];
}elseif(is_archive() && get_post_type() == 'staff'){
$header = $cesis_data['cesis_staff_a_header'];
}elseif(is_archive() && get_post_type() == 'careers'){
$header = $cesis_data['cesis_career_a_header'];
}elseif(cesis_check_bp_status() == true && is_buddypress()){
$header = $cesis_data['cesis_buddypress_header'];
}elseif(cesis_check_bbp_status() == true && cesis_is_bbpress() == true){
$header = $cesis_data['cesis_bbpress_header'];
}elseif(cesis_check_woo_status() == true && is_shop() || cesis_check_woo_status() == true && is_product_category() || cesis_check_woo_status() == true && is_product_tag()){
$header = $cesis_data['cesis_product_archive_header'];
}elseif(is_singular() && !is_page()  && get_post_type() !== 'post' && get_post_type() !== 'portfolio' && get_post_type() !== 'staff' && get_post_type() !== 'careers' && get_post_type() !== 'product'){
$header = $cesis_data['cesis_page_header'];
}elseif($meta_header !== 'inherit' && !is_archive()){
$header = $meta_header;
}elseif(cesis_check_woo_status() == true && is_product()){
$header = $cesis_data['cesis_shop_header'];
}elseif(get_post_type() == 'post'){
$header = $cesis_data['cesis_post_header'];
}elseif(get_post_type() == 'portfolio'){
$header = $cesis_data['cesis_portfolio_header'];
}elseif(get_post_type() == 'staff'){
$header = $cesis_data['cesis_staff_header'];
}elseif(get_post_type() == 'careers'){
$header = $cesis_data['cesis_career_header'];
}else{
$header = $cesis_data['cesis_page_header'];
}

if($header_layout == 'vertical_header' ){
	$body_class .= ' cesis_vertical_header '.$v_header_pos;
	($header_sticky == "full_header_sticky" && $top_bar == "yes") ?  : $is_sticky = '';
}
if($header_layout == 'vertical_offcanvas_header_b' ){
	$body_class .= ' cesis_offcanvas_header '.$v_header_pos;
}
if($header_layout == 'overlay_header_b' ){
	$body_class .= ' cesis_overlay_header';
}
if($custom_breakpoint == 'yes' ){
	$body_class .= ' cesis_custom_breakpoint';
}
if($custom_top_bar == 'yes' && $custom_top_bar_breakpoint !== $top_bar_breakpoint ){
	$body_class .= ' cesis_custom_topbar';
}
if($dda == 'yes' ){
	$body_class .= ' cesis_menu_use_dda';
}


if (wp_is_mobile()) $body_class .= ' touch';
else $body_class .= ' no-touch';


if($cesis_data['cesis_current_menu_parent'] == 'yes' ){
	$body_class .= ' cesis_parent_highlight';
}

if($body_layout == 'cesis_body_boxed' ){
	$body_class .= ' cesis_body_boxed';
}

$body_class .= ' cesis_lightbox_lg';

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<?php if ($cesis_data['cesis_responsive'] == true){ ?>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php }
if ($cesis_data['cesis_custom_favicon']['url'] !== '') {
	$protocol = is_ssl() ? 'https:' : 'http:';
	$favicon = $cesis_data['cesis_custom_favicon']['url'];
	$favicon = preg_replace("/^http:/i", $protocol, $favicon); ?>

<link rel="shortcut icon" href="<?php echo esc_url($favicon) ?>"/>
<?php } ?>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php
wp_head(); ?>
	
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-87134556-9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-87134556-9');
</script>	
	
</head>

<body <?php body_class( $body_class ); ?>>
<div id="wrap_all">

<?php
if($banner_type == 'content' && $blockid !== "" && $banner_pos == 'above'){
$cp_content = get_post_field('post_content', $blockid);
$post_custom_css = get_post_meta( $blockid, '_wpb_post_custom_css', true );
$post_content_custom_css = get_post_meta( $blockid, '_wpb_shortcodes_custom_css', true );
echo "<style>". $post_custom_css . $post_content_custom_css . "</style>";
echo '<div class="cesis_top_banner"><div class="cesis_container">'.do_shortcode($cp_content).'</div></div>';
}
if($banner_type == 'slider' && $sliderid !== "" && $banner_pos == 'above'){
	echo '<div class="cesis_slider_rev_ctn">'.do_shortcode('[rev_slider alias="'.$sliderid.'"]').'</div>';
}
if($banner_type == 'layerslider' && $layersliderid !== "" && $banner_pos == 'above'){
	echo '<div class="cesis_slider_rev_ctn">'.do_shortcode('[layerslider id="'.$layersliderid.'"]').'</div>';
}

?>

<div id="header_container" class="<?php echo esc_attr($header_state);?>" >
<?php if ($header_sticky !== "full_header_sticky" && $top_bar == "yes"  && $header_layout !== 'vertical_header'){
	get_template_part( 'template-parts/header', 'topbar' );
}
?>

<header id="cesis_header" class="top-header <?php echo esc_attr($is_sticky.' '.$is_hiding.' '.$is_shrinking.' '.$header_shadow);?>">

<?php if ($header_sticky == "full_header_sticky" && $top_bar == "yes"  && $header_layout !== 'vertical_header' ){
	get_template_part( 'template-parts/header', 'topbar' );
}

if($header_layout == "one_line_header" && $header == "yes" ){
	get_template_part( 'template-parts/header', 'main-one' );
}
elseif($header_layout == "two_line_header" && $header == "yes" ){
	get_template_part( 'template-parts/header', 'main-two' );
}
elseif($header_layout == "vertical_header" && $header == "yes" ){
	get_template_part( 'template-parts/header', 'vertical' );
}
elseif($header_layout == "vertical_offcanvas_header_b" && $header == "yes" ){
	get_template_part( 'template-parts/header', 'offcanvas' );
}
elseif($header_layout == "overlay_header_b" && $header == "yes" ){
	get_template_part( 'template-parts/header', 'overlay' );
}
get_template_part( 'template-parts/header', 'mobile' );

?>

</header>
<!-- #cesis_header -->
</div>
<!-- #header_container -->
<div id="main-content" class="main-container">
