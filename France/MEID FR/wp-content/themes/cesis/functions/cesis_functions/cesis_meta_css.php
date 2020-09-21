<?php
//inline css generated when page has meta option value that overwrite the theme options.
if(!function_exists('cesis_meta_css')){
	function cesis_meta_css($id = false){
		Redux::init( 'cesis_data' );
		global $cesis_data;
		global $post;
		if(!$id) $id = get_the_ID();
		$meta_css = "";




		if(!is_archive() && !cesis_is_buddypress() && cesis_is_bbpress() !== true && !is_404() && !is_search()  ){




//////////////////////////////////////////////////////////////////
////                                                         ////
///                 HEADER SETTINGS START                   ////
//                                                         ////
//////////////////////////////////////////////////////////////

	$custom_general_header = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_general_header');

	if($custom_general_header == 'yes'){
	  $m_header_width = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_width');
	  $header_width = $m_header_width["width"];
	  $header_units = $m_header_width["units"];

		if($header_units !== '%'){
		$header_width = ((int)$m_header_width["width"] + 80).$header_units;
		}else{
		$header_width = $m_header_width["width"];
		}

		$meta_header_state = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_transparent');

		$meta_css .= ".header_top_bar .cesis_container,.header_main .cesis_container,.header_sub .cesis_container { max-width:".esc_attr($header_width).";}";
	}

//////////////////////////////////////////////////////////////////
////                                                         ////
///                TOP BAR SETTINGS START                   ////
//                                                         ////
//////////////////////////////////////////////////////////////

$custom_top_bar = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_topbar');
if($custom_top_bar == 'yes'){



	$d_top_bar_breakpoint = $cesis_data['cesis_top_bar_breakpoint'];

  $d_top_bar_height = $cesis_data['cesis_top_bar_height'];
  $d_top_bar_bg = $cesis_data['cesis_top_bar_bg_color'];
  $d_top_bar_border = $cesis_data['cesis_top_bar_border_color'];
  $d_top_bar_color = $cesis_data['cesis_top_bar_text_color'];
  $d_top_bar_hl = $cesis_data['cesis_top_bar_hl_color'];
  $d_top_bar_hover = $cesis_data['cesis_top_bar_hover_color'];

  $d_top_bar_menu_font = $cesis_data["cesis_top_bar_menu_font"]['font-family'];
  $d_top_bar_menu_font_size = $cesis_data["cesis_top_bar_menu_font"]['font-size'];
  $d_top_bar_menu_font_weight = $cesis_data["cesis_top_bar_menu_font"]['font-weight'];
  $d_top_bar_menu_font_ls = $cesis_data["cesis_top_bar_menu_font"]['letter-spacing'];
  $d_top_bar_menu_font_tt = $cesis_data["cesis_top_bar_menu_font"]['text-transform'];

  $d_top_bar_menu_space = $cesis_data['cesis_top_bar_menu_space'];
	$top_bar_breakpoint = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_top_bar_breakpoint');
	$top_bar_height = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_top_bar_height');
	$top_bar_bg = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_top_bar_bg_color');
	$top_bar_border = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_top_bar_border_color');
	$top_bar_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_top_bar_text_color');
	$top_bar_hl = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_top_bar_hl_color');
	$top_bar_hover = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_top_bar_hover_color');

	$top_bar_font_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_top_bar_menu_font');
	$top_bar_menu_font = $top_bar_font_array['font-family'];
	$top_bar_menu_font_size = $top_bar_font_array['font-size'];
	$top_bar_menu_font_weight = $top_bar_font_array['font-weight'];
	$top_bar_menu_font_ls = $top_bar_font_array['letter-spacing'];
	$top_bar_menu_font_tt = $top_bar_font_array['text-transform'];

  $top_bar_menu_space = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_top_bar_menu_space');


$d_top_bar_text_size = $cesis_data['cesis_top_bar_text_size'];
$top_bar_text_size = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_top_bar_text_size');



	if($d_top_bar_text_size !== $top_bar_text_size){
		$meta_css .= '.top_bar_phone,.top_bar_email,.top_bar_text{ font-size:'.esc_attr($top_bar_text_size).'px;}';
	}

	if($d_top_bar_height !== $top_bar_height){
		$meta_css .= '.header_top_bar,.header_top_bar .cesis_social_icons a{ min-height:'.esc_attr($top_bar_height).'px; line-height:'.esc_attr($top_bar_height).'px;}';
	}

	if($d_top_bar_bg !== $top_bar_bg || $d_top_bar_border !== $top_bar_border  || $d_top_bar_color !== $top_bar_color ){
		$meta_css .= '.header_top_bar { background:'.esc_attr($top_bar_bg).'; border-color:'.esc_attr($top_bar_border).'; color:'.esc_attr($top_bar_color).'}';
	}

	if($d_top_bar_hl !== $top_bar_hl){
		$meta_css .= '.header_top_bar a{ color:'.esc_attr($top_bar_hl).';}';
	}
	if($d_top_bar_hover !== $top_bar_hover){
		$meta_css .= '.header_top_bar a:hover{ color:'.esc_attr($top_bar_hover).';}';
		$meta_css .= '.top_bar_cart .cesis_cart_icon .current_item_number{background:'.esc_attr($top_bar_hover).';}';
	 	if( cesis_check_bp_status() == true) {
			$meta_css .= '.top_bar_notifications .cesis_bp_notifications_count{background:'.esc_attr($top_bar_hover).';}';
		}
	}



	$meta_css .= '.header_top_bar .menu-top-bar-ct li,
	.top_bar_notifications .cesis_bp_notifications > span
	{ font-family:'.esc_attr($top_bar_menu_font).'; font-size:'.esc_attr($top_bar_menu_font_size).'; letter-spacing:'.esc_attr($top_bar_menu_font_ls).'; text-transform:'.esc_attr($top_bar_menu_font_tt).';  padding:0 '.esc_attr($top_bar_menu_space).'px;}{background:'.esc_attr($top_bar_hover).';}';

	if($d_top_bar_breakpoint !== $top_bar_breakpoint){
		$meta_css .= '@media only screen and (max-width: '.esc_attr($top_bar_breakpoint).'px) {
		body.cesis_custom_topbar .header_top_bar { display:none;}
		}	';
	}

}


//////////////////////////////////////////////////////////////////
////                                                         ////
///               HEADER MAIN SETTINGS START                ////
//                                                         ////
//////////////////////////////////////////////////////////////



$custom_breakpoint = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_breakpoint');
$custom_mobile = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_mobile');

if($custom_breakpoint == 'yes'){
	$header_breakpoint = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_breakpoint');
	$mobile_status = '.cesis_custom_breakpoint';
}else{
	$header_breakpoint = $cesis_data["cesis_header_breakpoint"];
	$mobile_status = ':not(.cesis_custom_breakpoint)';
}



$custom_general_settings = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_general_settings');

if($custom_general_settings == 'yes'){
	$logo_width = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_logo_width');
	$mobile_logo_width = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_mobile_logo_width');
	$body_bg_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_body_background');
	if(isset($title_bg_array['background-color'])){
		$body_bg_color = $body_bg_array['background-color'];
	}
	if(isset($body_bg_array['background-image'])){
		// Background image.
		$body_bg_image = $body_bg_array['background-image'];
		$body_bg_repeat = $body_bg_array['background-repeat'];
		$body_bg_position = $body_bg_array['background-position'];
		$body_bg_size = $body_bg_array['background-size'];
		$body_bg_attachement = $body_bg_array['background-attachment'];
	}
	  if($body_bg_image !== '') {
	  $meta_css .= 'body {
	  	background-image:url('.esc_attr($body_bg_image).');
	  	background-repeat:'.esc_attr($body_bg_repeat).';
	  	background-position:'.esc_attr($body_bg_position).';
	  	background-size:'.esc_attr($body_bg_size).';
	  	background-attachment:'.esc_attr($body_bg_attachement).';
	  	background-color:'.esc_attr($body_bg_color).';
		}';
	}else{
	  $meta_css .= '.body{ background-color:'.esc_attr($body_bg_color).' }';
	}
	$body_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_body_type');
	$d_body_width = $cesis_data['cesis_body_width'];
	$body_width = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_body_width');
	if($logo_width !== ""){
		$meta_css .= '.header_logo,.header_logo #logo_img,.header_logo #logo_img img{  max-width:'.esc_attr($logo_width).'px; }';
	}
	if($mobile_logo_width !== ""){
		$meta_css .= '.header_logo #logo_img,.header_logo #logo_img .mobile_logo{  max-width:'.esc_attr($mobile_logo_width).'px; }';
	}
	if($body_layout == "cesis_body_boxed"){
		$meta_css .= '
	  body.cesis_body_boxed,body.cesis_body_boxed .cesis_sticky { max-width:'.esc_attr($body_width).'px; }';
	}

}else{
	$logo_width = $cesis_data["cesis_logo_width"];
	$mobile_logo_width = $cesis_data["cesis_mobile_logo_width"];
}

$custom_header = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_header');
if($custom_general_header == 'yes'){

$d_header_shrink_status = $cesis_data["cesis_header_shrink"];
$header_shrink_status =  redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_shrink');
if($header_shrink_status == 'inherit'){
	$header_shrink_status =  $d_header_shrink_status;
}

$header_shrinked_height = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_shrink_height');
$header_shrinked_logo = (int)$header_shrinked_height-15;

$header_transparent_bg_color_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_transparent_header_bg_color');
$header_transparent_bg_color = $header_transparent_bg_color_array['rgba'];
$header_transparent_color_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_transparent_header_color');
$header_transparent_color = $header_transparent_color_array['rgba'];
$header_transparent_border_color_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_transparent_header_border_color');
$header_transparent_border_color = $header_transparent_border_color_array['rgba'];
$header_transparent_active_color_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_transparent_header_active_color');
$header_transparent_active_color = $header_transparent_active_color_array['rgba'];

}else{
	$header_shrink_status = $cesis_data["cesis_header_shrink"];
	$header_shrinked_height = $cesis_data["cesis_header_shrink_height"];
	$header_shrinked_logo = (int)$header_shrinked_height-15;
}

$custom_header = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_header');
if($custom_header == 'yes'){

 $d_header_height = $cesis_data["cesis_header_height"];
 $header_height = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_height');

 $d_header_layout = $cesis_data['cesis_header_layout'];
 $header_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_layout');
 $d_header_bg = $cesis_data["cesis_header_bg_color"];
 $header_bg = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_bg_color');

 $d_header_border = $cesis_data["cesis_header_border_color"]['rgba'];
 $header_border_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_border_color');
 $header_border = $header_border_array['rgba'];

 $d_header_layout = $cesis_data['cesis_header_layout'];
 $d_header_v_width = $cesis_data["cesis_header_v_width"];
 $d_header_v_pos = $cesis_data["cesis_header_v_pos"];
 $d_header_oc_bg = $cesis_data["cesis_header_offcanvas_bg_color"];
 $d_header_menu_btn = $cesis_data["cesis_header_openmenu_color"];
 $header_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_layout');
 $header_v_width = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_v_width');
 $header_v_pos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_v_pos');
 $header_oc_bg = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_offcanvas_bg_color');
 $header_menu_btn = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_openmenu_color');



($header_v_pos == 'header_v_pos_left') ? $v_pos = 'left' : $v_pos = 'right';
($header_v_pos == 'header_v_pos_left') ? $oc_pos = '' : $oc_pos = '-';

 $d_header_sub_height = $cesis_data["cesis_header_sub_height"];
 $d_header_sub_bg = $cesis_data["cesis_header_sub_bg_color"];
 $d_header_sub_border = $cesis_data["cesis_header_sub_border_color"]['rgba'];
 $header_sub_height = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_sub_height');
 $header_sub_bg = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_sub_bg_color');
 $header_sub_border_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_sub_border_color');
 $header_sub_border = $header_sub_border_array['rgba'];


 $d_header_overlay_bg = $cesis_data["cesis_overlay_bg_color"]['rgba'];
 $header_overlay_bg_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_overlay_bg_color');
 $header_overlay_bg = $header_overlay_bg_array['rgba'];


 $d_menu_space = ((int)$cesis_data["cesis_menu_space"] / 2);
 $menu_type = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_menu_type');
 $menu_space = ((int)redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_menu_space') / 2);
 $menu_pos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_menu_pos');

 $d_menu_border_pos = $cesis_data["cesis_menu_border_pos"];
 $d_menu_border_size = $cesis_data["cesis_menu_border_size"];
 $d_menu_border_radius = $cesis_data["cesis_menu_border_radius"];
 $d_menu_sep = $cesis_data["cesis_menu_sep_color"];
 $d_menu_color = $cesis_data["cesis_menu_font"]['color'];
 $d_menu_font = $cesis_data["cesis_menu_font"]['font-family'];
 $d_menu_size = $cesis_data["cesis_menu_font"]['font-size'];
 $d_menu_weight = $cesis_data["cesis_menu_font"]['font-weight'];
 $d_menu_tt = $cesis_data["cesis_menu_font"]['text-transform'];
 $d_menu_ls = $cesis_data["cesis_menu_font"]['letter-spacing'];
 $d_menu_active_color = $cesis_data["cesis_current_menu_color"];
 $d_menu_active_bg = $cesis_data["cesis_current_menu_bg_color"];
 $d_menu_border = $cesis_data["cesis_menu_border_color"];
 $menu_border_pos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_menu_border_pos');
 $menu_border_size = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_menu_border_size');
 $menu_border_radius = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_menu_border_radius');
 $menu_sep = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_menu_sep_color');
 $meta_menu_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_menu_font');
 $menu_color = $meta_menu_array['color'];
 $menu_font = $meta_menu_array['font-family'];
 $menu_size = $meta_menu_array['font-size'];
 $menu_weight = $meta_menu_array['font-weight'];
 $menu_tt = $meta_menu_array['text-transform'];
 $menu_ls = $meta_menu_array['letter-spacing'];
 $menu_active_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_current_menu_color');
 $menu_active_bg = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_current_menu_bg_color');
 $menu_border = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_menu_border_color');



 $d_logo_pos = $cesis_data["cesis_logo_pos"];
 $logo_pos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_logo_pos');
 $logo_margin = (int)$logo_width/2;
 $logo_padding = ((int)$logo_width+60)/2;

 $d_header_additional_style = $cesis_data["cesis_header_additional_style"];
 $d_header_a_space = ( (int)$cesis_data["cesis_header_additional_space"] / 2 );
 $d_header_a_ctn_border = $cesis_data["cesis_header_a_ctn_border"];
 $d_header_a_color = $cesis_data["cesis_header_a_color"];
 $d_header_a_border_color = $cesis_data["cesis_header_a_border_color"];
 $d_header_a_bg_color = $cesis_data["cesis_header_a_bg_color"];
 $d_header_a_hover_color = $cesis_data["cesis_header_a_hover_color"];
 $d_header_a_hover_border_color = $cesis_data["cesis_header_a_hover_border_color"];
 $d_header_a_hover_bg_color = $cesis_data["cesis_header_a_hover_bg_color"];
 $d_header_sa_ctn_border = $cesis_data["cesis_header_sa_ctn_border"];
 $d_header_sa_color = $cesis_data["cesis_header_sa_color"];
 $d_header_sa_border_color = $cesis_data["cesis_header_sa_border_color"];
 $d_header_sa_bg_color = $cesis_data["cesis_header_sa_bg_color"];
 $d_header_sa_hover_color = $cesis_data["cesis_header_sa_hover_color"];
 $d_header_sa_hover_border_color = $cesis_data["cesis_header_sa_hover_border_color"];
 $d_header_sa_hover_bg_color = $cesis_data["cesis_header_sa_hover_bg_color"];
 $header_additional_style = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_additional_style');
 $header_a_space = ( (int)redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_additional_space') / 2 );
 $header_a_ctn_border = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_ctn_border');
 $header_a_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_color');
 $header_a_border_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_border_color');
 $header_a_bg_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_bg_color');
 $header_a_hover_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_hover_color');
 $header_a_hover_border_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_hover_border_color');
 $header_a_hover_bg_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_hover_bg_color');
 $header_sa_ctn_border = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_sa_ctn_border');
 $header_sa_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_sa_color');
 $header_sa_border_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_sa_border_color');
 $header_sa_bg_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_sa_bg_color');
 $header_sa_hover_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_sa_hover_color');
 $header_sa_hover_border_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_sa_hover_border_color');
 $header_sa_hover_bg_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_sa_hover_bg_color');



$header_a_btn_font_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_btn_font');

$header_a_btn_color = $header_a_btn_font_array['color'];
$header_a_btn_font = $header_a_btn_font_array['font-family'];
$header_a_btn_size = $header_a_btn_font_array['font-size'];
$header_a_btn_weight = $header_a_btn_font_array['font-weight'];
$header_a_btn_tt = $header_a_btn_font_array['text-transform'];
$header_a_btn_ls = $header_a_btn_font_array['letter-spacing'];
$header_a_btn_bg = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_btn_bg_color');
$header_a_btn_border = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_btn_border_color');
$header_a_btn_h_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_btn_hover_color');
$header_a_btn_h_bg = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_btn_hover_bg_color');
$header_a_btn_h_border = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_btn_hover_border_color');
$header_a_btn_h_border = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_btn_hover_border_color');
$header_a_btn_width = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_btn_width');
$header_a_btn_height = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_btn_height');
$header_a_btn_border_size = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_btn_border');
$header_a_btn_border_radius = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_a_btn_radius');

$header_a_btn_height = $header_a_btn_height-($header_a_btn_border_size*2);


 $m_menu_span_padding = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_menu_span_padding');

 if(!isset($m_menu_span_padding['padding-top'])){
 }else{
 $menu_span_t = $m_menu_span_padding['padding-top'];
 }
  if(!isset($m_menu_span_padding['padding-left'])){
 }else{
 $menu_span_l = $m_menu_span_padding['padding-left'];
 }
 if(!isset($m_menu_span_padding['padding-bottom'])){
 }else{
 $menu_span_b = $m_menu_span_padding['padding-bottom'];
 }
 if(!isset($m_menu_span_padding['padding-right'])){
 }else{
 $menu_span_r = $m_menu_span_padding['padding-right'];
 }




 if($header_layout  !== 'vertical_header'){

 	$meta_css .= '.header_main { background:'.esc_attr($header_bg).'; height:'.esc_attr($header_height).'px; border-color:'.esc_attr($header_border).';}';

  }else{

 	$meta_css .= '.header_main.header_vertical { background:'.esc_attr($header_bg).'; width:'.esc_attr($header_v_width).'px;  border-color:'.esc_attr($header_border).';}';

  }

 if($header_layout == 'vertical_header' ){
 	$meta_css .= 'body.cesis_vertical_header #header_container,body.cesis_vertical_header #main-content,
 body.cesis_vertical_header #cesis_colophon {margin-'.esc_attr($v_pos).':'.esc_attr($header_v_width).'px;}';
  }

 if($header_layout == 'vertical_offcanvas_header_b'){
 	$meta_css .= 'body.cesis_offcanvas_header .header_logo a,.cesis_offcanvas_cart .cart-menu > li > a,
 .header_main .cesis_offcanvas_notifications a{ color:'.esc_attr($header_menu_btn).'}
 .header_main .lines,.header_main .lines:after,.header_main .lines:before { background:'.esc_attr($header_menu_btn).'}
 .header_main:not(.header_vertical) .header_logo,.header_main:not(.header_vertical) .cesis_menu_button.cesis_offcanvas_switch,
 .header_main:not(.header_vertical) .cesis_offcanvas_cart,.header_main:not(.header_vertical) .cesis_offcanvas_notifications a,
 .header_main:not(.header_vertical) .cesis_offcanvas_notifications i,
 .header_main:not(.header_vertical) .cesis_offcanvas_notifications > span{ line-height:'.esc_attr($header_height).'px; height:'.esc_attr($header_height).'px;}
 .header_offcanvas { background:'.esc_attr($header_oc_bg).'; width:'.esc_attr($header_v_width).'px;}

 .cesis_offcanvas_opened {-webkit-transform: translateX('.esc_attr($oc_pos.$header_v_width).'px); transform: translateX('.esc_attr($oc_pos.$header_v_width).'px);}';


if($header_shrink_status !== 'no'){
$meta_css .= '.cesis_header_shrink.cesis_stuck .header_logo,
.cesis_header_shrink.cesis_stuck .cesis_menu_button.cesis_offcanvas_switch,
.cesis_header_shrink.cesis_stuck .cesis_offcanvas_cart,
.cesis_header_shrink.cesis_stuck .header_main .cesis_offcanvas_notifications a,
.cesis_header_shrink.cesis_stuck .header_main .cesis_offcanvas_notifications i,
.cesis_header_shrink.cesis_stuck .header_main .cesis_offcanvas_notifications > span
{ line-height:'.esc_attr($header_shrinked_height).'px; height:'.esc_attr($header_shrinked_height).'px;}
.cesis_header_shrink.cesis_stuck .header_main
{height:'.esc_attr($header_shrinked_height).'px;}
.cesis_header_shrink.cesis_stuck .header_logo #logo_img img
{ max-height:'.esc_attr($header_shrinked_logo).'px;}';
 }

  }
 if($header_layout == 'overlay_header_b'){
 $meta_css .= '.header_overlay { background:'.esc_attr($header_overlay_bg).'}
 body.cesis_overlay_header .header_logo a,.cesis_overlay_cart .cart-menu > li > a,
 .header_main .cesis_overlay_notifications a{ color:'.esc_attr($header_menu_btn).'}
 .header_main:not(.header_vertical) .lines,
 .header_main:not(.header_vertical) .lines:after,
 .header_main:not(.header_vertical) .lines:before { background:'.esc_attr($header_menu_btn).'}
 .header_main:not(.header_vertical) .header_logo,
 .cesis_menu_button.cesis_menu_overlay ,
 .cesis_menu_overlay_close,.cesis_overlay_cart,
 .header_main:not(.header_vertical) .cesis_overlay_notifications a,
 .header_main:not(.header_vertical) .cesis_overlay_notifications i,
 .header_main:not(.header_vertical) .cesis_overlay_notifications > span{ line-height:'.esc_attr($header_height).'px; height:'.esc_attr($header_height).'px;}';


if($header_shrink_status !== 'no'){
 $meta_css .= '.cesis_header_shrink.cesis_stuck .header_logo,
.cesis_header_shrink.cesis_stuck .cesis_menu_button.cesis_menu_overlay ,
.cesis_header_shrink.cesis_stuck .cesis_menu_overlay_close,
.cesis_header_shrink.cesis_stuck .cesis_overlay_cart,
.cesis_header_shrink.cesis_stuck .header_main .cesis_overlay_notifications a,
.cesis_header_shrink.cesis_stuck .header_main .cesis_overlay_notifications i,
.cesis_header_shrink.cesis_stuck .header_main .cesis_overlay_notifications > span
{ line-height:'.esc_attr($header_shrinked_height).'px; height:'.esc_attr($header_shrinked_height).'px;}
.cesis_header_shrink.cesis_stuck .header_main
{height:'.esc_attr($header_shrinked_height).'px;}
.cesis_header_shrink.cesis_stuck .header_logo #logo_img img
{ max-height:'.esc_attr($header_shrinked_logo).'px;}';


}
if($header_width !== '' && $header_units == '%' ){
       $meta_css .= '.header_main .cesis_container{ padding:0 40px; }';
}



 }

 if($header_layout == 'one_line_header'){

 $meta_css .= '.header_main:not(.header_vertical) .tt-main-navigation > div > ul > li > a,
 .header_main:not(.header_vertical) .header_logo,
 .header_main:not(.header_vertical)  .menu_sep,
 .header_main:not(.header_vertical) .tt-main-additional .cesis_social_icons,
 .header_main:not(.header_vertical) .tt-main-additional .cesis_social_icons a,
 .header_main:not(.header_vertical) .tt-main-additional .cesis_search_icon i,
 .header_main:not(.header_vertical) .tt-main-additional .cesis_cart_icon i,
 .header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications a,
 .header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications.only_icons i,
 .header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications.only_icons > span
 { line-height:'.esc_attr($header_height).'px; height:'.esc_attr($header_height).'px;}';


 $meta_css .= '.header_main:not(.header_vertical) .tt-main-additional .cesis_menu_btn a span
{ font-size:'.esc_attr($header_a_btn_size).';
 font-family:'.esc_attr($header_a_btn_font).';
font-weight:'.esc_attr($header_a_btn_weight).';
text-transform:'.esc_attr($header_a_btn_tt).';
letter-spacing:'.esc_attr($header_a_btn_ls).';
color:'.esc_attr($header_a_btn_color).';
background:'.esc_attr($header_a_btn_bg).';
border-color:'.esc_attr($header_a_btn_border).';
border-radius:'.esc_attr($header_a_btn_border_radius).'px;
border-width:'.esc_attr($header_a_btn_border_size).'px;
line-height:'.esc_attr($header_a_btn_height).'px;
width:'.esc_attr($header_a_btn_width).'px;

}
.header_main:not(.header_vertical) .tt-main-additional .cesis_menu_btn a span:hover{
color:'.esc_attr($header_a_btn_h_color).';
background:'.esc_attr($header_a_btn_h_bg).';
border-color:'.esc_attr($header_a_btn_h_border).';
}';

if($header_shrink_status !== 'no'){
 $meta_css .= '.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-navigation > div > ul > li > a,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .header_logo,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .menu_sep,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_social_icons,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_social_icons a,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_search_icon i,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_cart_icon i,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications a,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications.only_icons i,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications.only_icons > span
{ line-height:'.esc_attr($header_shrinked_height).'px; height:'.esc_attr($header_shrinked_height).'px;}
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical)
{ height:'.esc_attr($header_shrinked_height).'px;}
.cesis_header_shrink.cesis_stuck .header_logo #logo_img img
{ max-height:'.esc_attr($header_shrinked_logo).'px;}';

 }

  } elseif($header_layout == 'two_line_header'){

 $meta_css .= '.header_main:not(.header_vertical) .header_logo,
 .header_main:not(.header_vertical) .tt-main-additional .cesis_social_icons,
 .header_main:not(.header_vertical) .tt-main-additional .cesis_social_icons a,
 .header_main:not(.header_vertical) .tt-main-additional .cesis_search_icon i,
 .header_main:not(.header_vertical) .tt-main-additional .cesis_cart_icon i,
 .header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications a,
 .header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications.only_icons i,
 .header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications.only_icons > span,
 .header_main:not(.header_vertical) .tt-main-additional .cesis_menu_btn a  { line-height:'.esc_attr($header_height).'px; height:'.esc_attr($header_height).'px;}
 .header_sub .tt-main-navigation  > div > ul > li > a,.header_sub .menu_sep,
 .tt-sub-additional .cesis_social_icons,
 .tt-sub-additional .cesis_social_icons a,
 .tt-sub-additional .cesis_search_icon i,
 .tt-sub-additional .cesis_cart_icon i,
 .tt-sub-additional .cesis_bp_notifications a,
 .tt-sub-additional .cesis_bp_notifications.only_icons i,
 .tt-sub-additional .cesis_bp_notifications.only_icons > span{ line-height:'.esc_attr($header_sub_height).'px; height:'.esc_attr($header_sub_height).'px; }
 .header_sub {height:'.esc_attr($header_sub_height).'px; background:'.esc_attr($header_sub_bg).'; border-color:'.esc_attr($header_sub_border).';}';


 $meta_css .= '.header_main:not(.header_vertical) .tt-main-additional .cesis_menu_btn a span
{ font-size:'.esc_attr($header_a_btn_size).';
 font-family:'.esc_attr($header_a_btn_font).';
font-weight:'.esc_attr($header_a_btn_weight).';
text-transform:'.esc_attr($header_a_btn_tt).';
letter-spacing:'.esc_attr($header_a_btn_ls).';
color:'.esc_attr($header_a_btn_color).';
background:'.esc_attr($header_a_btn_bg).';
border-color:'.esc_attr($header_a_btn_border).';
border-radius:'.esc_attr($header_a_btn_border_radius).'px;
border-width:'.esc_attr($header_a_btn_border_size).'px;
line-height:'.esc_attr($header_a_btn_height).'px;
width:'.esc_attr($header_a_btn_width).'px;

}
.header_main:not(.header_vertical) .tt-main-additional .cesis_menu_btn a span:hover{
color:'.esc_attr($header_a_btn_h_color).';
background:'.esc_attr($header_a_btn_h_bg).';
border-color:'.esc_attr($header_a_btn_h_border).';
}';

if($header_shrink_status !== 'no'){
 $meta_css .= '.cesis_header_shrink.cesis_stuck .header_sub .tt-main-navigation  > div > ul > li > a,.header_sub .menu_sep,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_social_icons,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_social_icons a,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_search_icon i,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_cart_icon i,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_bp_notifications a,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_bp_notifications.only_icons i,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_bp_notifications.only_icons > span
{ line-height:'.esc_attr($header_shrinked_height).'px; height:'.esc_attr($header_shrinked_height).'px; }
.cesis_header_shrink.cesis_stuck .header_sub
{height:'.esc_attr($header_shrinked_height).'px;}';
 }

  $meta_css .= '.tt-sub-additional .cesis_social_icons a,
 .tt-sub-additional .cesis_search_icon a,
 .tt-sub-additional .cesis_cart_icon > ul > li > a,
 .tt-sub-additional .cesis_bp_notifications a
 { color:'.esc_attr($header_sa_color).';}
 .tt-sub-additional .cesis_social_icons a:after,
 .tt-sub-additional .cesis_search_icon a i:after,
 .tt-sub-additional .cesis_cart_icon > ul > li > a:after,
 .tt-sub-additional .cesis_bp_notifications a:after {
   background-color:'.esc_attr($header_sa_bg_color).';
   border-color:'.esc_attr($header_sa_border_color).';
 }
 .tt-sub-additional .cesis_social_icons a:hover,
 .tt-sub-additional .cesis_search_icon a:hover,
 .tt-sub-additional .cesis_bp_notifications a:hover{ color:'.esc_attr($header_sa_hover_color).';}
 .tt-sub-additional .cesis_social_icons a:hover::after,
 .tt-sub-additional .cesis_search_icon a:hover i:after,
 .tt-sub-additional .cesis_cart_icon > ul > li > a:hover::after,
 .tt-sub-additional .cesis_bp_notifications a:hover::after {
   background-color:'.esc_attr($header_sa_hover_bg_color).';
   border-color:'.esc_attr($header_sa_hover_border_color).';
 }

 .tt-sub-additional .cesis_cart_icon .current_item_number,
 .tt-sub-additional .cesis_bp_notifications_count
 { background:'.esc_attr($header_sa_hover_color).';}';


  }

 if($header_layout == 'two_line_header' || $header_layout  == 'one_line_header'){
 $meta_css .= '.tt-main-navigation  > div > ul > li > a { padding:0 '.esc_attr($menu_space).'px; }
 .tt-main-additional.logo_left,.tt-sub-additional.menu_left{ padding-left:'.esc_attr($menu_space).'px; }
 .tt-main-additional.logo_left:not(.edge_border):not(.nav_line_separator),.tt-sub-additional.menu_left:not(.edge_border):not(.nav_line_separator)
 { padding-left:'.esc_attr(2*$menu_space).'px; }
 .tt-main-additional.logo_right,.tt-sub-additional.menu_right{ padding-right:'.esc_attr($menu_space).'px; }
 .tt-main-additional.logo_right:not(.edge_border):not(.nav_line_separator),.tt-sub-additional.menu_right:not(.edge_border):not(.nav_line_separator)
 { padding-right:'.esc_attr(2*$menu_space).'px; }';

  if($menu_pos == 'menu_fill' ){
		$meta_css .= '.tt-main-additional.menu_fill,.tt-sub-additional.menu_fill{padding:0 !important;}';
	}
    if($header_additional_style == 'additional_border' && $menu_type !== 'nav_line_separator'){
   $meta_css .= '.tt-main-additional.logo_left,.tt-sub-additional.menu_left{ margin-left:'.esc_attr(2*$menu_space).'px; }
   .tt-main-additional.logo_right,.tt-sub-additional.menu_right{ margin-right:'.esc_attr(2*$menu_space).'px}
     .tt-main-additional.logo_left.edge_border.additional_border,.tt-sub-additional.menu_left.edge_border.additional_border{ padding-left:'.esc_attr(2*$menu_space).'px; }
     .tt-main-additional.logo_left.edge_border,.tt-sub-additional.menu_left.edge_border{ margin-left:'.esc_attr($menu_space).'px;}
     .tt-main-additional.logo_right.edge_border,.tt-sub-additional.menu_right.edge_border{ margin-right:'.esc_attr($menu_space).'px;}
     .tt-main-additional.logo_right.edge_border.additional_border,.tt-sub-additional.menu_right.edge_border.additional_border{ padding-right:'.esc_attr(2*$menu_space).'px; }
     .tt-main-additional.logo_left,.tt-main-additional.logo_right,.tt-main-additional.logo_left.edge_border.additional_border,.tt-main-additional.logo_right.edge_border,
     .tt-main-additional.logo_center.additional_border .tt-left-additional,.tt-main-additional.logo_center.additional_border .tt-right-additional
     {border-color:'.esc_attr($header_a_ctn_border).'}
     .tt-sub-additional.menu_left,.tt-sub-additional.menu_right,.tt-sub-additional.menu_left.edge_border.additional_border,.tt-sub-additional.menu_right.edge_border,
     .tt-sub-additional.menu_center.additional_border .cesis_social_icons,.tt-sub-additional.menu_center.additional_border .cesis_search_icon,
     .tt-sub-additional.menu_center.additional_border .tt-left-additional,.tt-sub-additional.menu_center.additional_border .tt-right-additional
     {border-color:'.esc_attr($header_sa_ctn_border).'}';


      }
 }else{
 $meta_css .= '.tt-main-navigation.tt-vertical-navigation a,.tt-main-additional.vertical_additional > span,
 .tt-main-additional .cesis_bp_notifications.vertical > span{ padding:'.esc_attr($menu_space).'px 0; }';
 }
 if($menu_type == 'nav_line_separator' ){

 $meta_css .= '.nav_line_separator  > div > ul > li { border-left:1px solid '.esc_attr($menu_sep).' }
 .nav_line_separator > div > ul,.nav_line_separator.logo_center > div > ul .cl_before_logo{ border-right:1px solid '.esc_attr($menu_sep).' }
 .cesis_parent_highlight .tt-main-navigation  > div > ul > li.current_page_parent > a,.tt-main-navigation  > div > ul > li.current-menu-item > a,.tt-main-navigation  > div > ul > li > a:hover { background-color:'.esc_attr($menu_active_bg).';}';

  }elseif($menu_type == 'nav_top_borderx' && $menu_border_pos == 'edge_border' ){

 $meta_css .= '.cesis_parent_highlight .nav_top_borderx.edge_border  > div > ul > li.current_page_parent > a,.nav_top_borderx.edge_border  > div > ul > li.current-menu-item > a,.nav_top_borderx.edge_border  > div > ul > li > a:hover {
     box-shadow: inset 0px '.esc_attr($menu_border_size).'px '.esc_attr($menu_border).';}';

  }elseif($menu_type == 'nav_top_borderx' && $menu_border_pos == 'text_border' ){

 $meta_css .= '.cesis_parent_highlight .nav_top_borderx.text_border  > div > ul > li.current_page_parent > a span,.nav_top_borderx.text_border  > div > ul > li.current-menu-item > a span,.nav_top_borderx.text_border  > div > ul > li > a:hover span {box-shadow: inset 0px '.esc_attr($menu_border_size).'px '.esc_attr($menu_border).'; }
 .nav_top_borderx.text_border  > div > ul > li > a span{padding-top:10px;}';

  }elseif($menu_type == 'nav_bottom_borderx' && $menu_border_pos == 'edge_border' ){

 $meta_css .= '.cesis_parent_highlight .nav_bottom_borderx.edge_border  > div > ul > li.current_page_parent > a,.nav_bottom_borderx.edge_border  > div > ul > li.current-menu-item > a,.nav_bottom_borderx.edge_border  > div > ul > li > a:hover
 {  box-shadow: inset 0px -'.esc_attr($menu_border_size).'px '.esc_attr($menu_border).';}';

  }elseif($menu_type == 'nav_bottom_borderx' && $menu_border_pos == 'text_border' ){

 $meta_css .= '.cesis_parent_highlight .nav_bottom_borderx.text_border > div > ul > li.current_page_parent > a span,.nav_bottom_borderx.text_border  > div > ul > li.current-menu-item > a span,.nav_bottom_borderx.text_border  > div > ul > li > a:hover span {box-shadow: inset 0px -'.esc_attr($menu_border_size).'px '.esc_attr($menu_border).'; }
 .header_main .nav_bottom_borderx.text_border  > div > ul > li > a span{padding-bottom:10px;}
 .header_sub .nav_bottom_borderx.text_border  > div > ul > li > a span{padding-bottom:'.esc_attr(5+(int)$menu_border_size).'px;}';

  }elseif($menu_type == 'nav_boxed_border'){

 $meta_css .= '.cesis_parent_highlight .nav_boxed_border  > div > ul > li.current_page_parent > a span,.nav_boxed_border  > div > ul > li.current-menu-item > a span,.nav_boxed_border  > div > ul > li > a:hover span {border:'.esc_attr($menu_border_size).'px solid '.esc_attr($menu_border).'; }
 .nav_boxed_border  > div > ul > li > a span{padding:'.esc_attr($cesis_data['cesis_menu_span_padding']['padding-top'].' '.$cesis_data['cesis_menu_span_padding']['padding-right'].' '.$cesis_data['cesis_menu_span_padding']['padding-bottom'].' '.$cesis_data['cesis_menu_span_padding']['padding-left']).';  border:'.esc_attr($menu_border_size).'px solid rgba(0,0,0,0); border-radius:'.esc_attr($menu_border_radius).'px;}';

  }


  if($cesis_data['cesis_logo']['url'] !== '' ){
 $meta_css .= '.header_logo #logo_img,.header_logo #logo_img img{  max-width:'.esc_attr($logo_width).'px;  max-height:'.esc_attr($header_height).'px;}
 .header_logo.logo_center{ width:'.esc_attr($logo_width).'px; margin-left:-'.esc_attr($logo_margin).'px; }
 .sm .cl_before_logo{ margin-right:'.esc_attr($logo_margin).'px; }.sm .cl_after_logo{ margin-left:'.esc_attr($logo_padding).'px; }
 body.rtl .sm .cl_before_logo{ margin-left:'.esc_attr($logo_margin).'px; margin-right:0; }body.rtl .sm .cl_after_logo{ margin-right:'.esc_attr($logo_padding).'px; margin-left:0; }';
  }

 $meta_css .= '.tt-main-navigation  > div > ul > li > a span,.tt-main-navigation.tt-vertical-navigation span,
 .tt-main-additional .cesis_search_icon span,.tt-main-additional .cesis_search_icon input,
 .tt-main-additional .cesis_cart_icon.vertical, .tt-main-additional .cesis_cart_icon.vertical a,
 .tt-main-additional .cesis_bp_notifications.vertical a
 { color:'.esc_attr($menu_color).'; font-family:'.esc_attr($menu_font).'; font-size:'.esc_attr($menu_size).'; font-weight:'.esc_attr($menu_weight).'; text-transform:'.esc_attr($menu_tt).'; letter-spacing:'.esc_attr($menu_ls).';}
 .cesis_parent_highlight .tt-main-navigation > div > ul > li.current_page_parent > a span,.tt-main-navigation > div > ul > li.current-menu-item > a span,.tt-main-navigation  > div > ul > li > a:hover span,
 .tt-main-navigation.tt-vertical-navigation li.current-menu-item > a span,.tt-main-navigation.tt-vertical-navigation a:hover span,
 .tt-main-additional .cesis_cart_icon.vertical a:hover,
 .tt-main-additional .cesis_search_icon span:hover
 { color:'.esc_attr($menu_active_color).';}
 .header_logo a,.cesis_mobile_cart .cesis_cart_icon a,
 .cesis_mobile_notifications a{ color:'.esc_attr($menu_color).'; }
 .cesis_menu_overlay_close .lines,.cesis_menu_overlay_close .lines:after,.cesis_menu_overlay_close .lines:before,
 .cesis_mobile_menu_switch .lines, .cesis_mobile_menu_switch .lines:before, .cesis_mobile_menu_switch .lines:after{ background:'.esc_attr($menu_color).';}


 .header_vertical .tt-main-additional .cesis_search_icon input { border-color:'.esc_attr($header_border).';}
 .tt-main-additional	.cesis_search_icon	input::-webkit-input-placeholder { color:'.esc_attr($menu_color).';}

 .tt-main-additional .cesis_social_icons a,
 .tt-main-additional .cesis_search_icon a,
 .tt-main-additional .cesis_cart_icon > ul > li > a,
 .tt-main-additional .cesis_bp_notifications a { color:'.esc_attr($header_a_color).';}
 .tt-main-additional .cesis_social_icons a:after,
 .tt-main-additional .cesis_search_icon a i:after,
 .tt-main-additional .cesis_cart_icon > ul > li > a:after,
 .tt-main-additional .cesis_bp_notifications a:after{
     background-color:'.esc_attr($header_a_bg_color).';
     border-color:'.esc_attr($header_a_border_color).';
 }


 .tt-main-additional .cesis_social_icons a:hover,
 .tt-main-additional .cesis_search_icon a:hover,
 .tt-main-additional .cesis_cart_icon > ul > li > a:hover,
 .tt-main-additional .cesis_bp_notifications a:hover
 { color:'.esc_attr($header_a_hover_color).';}

 .tt-main-additional .cesis_cart_icon .current_item_number,
 .cesis_offcanvas_cart .cesis_cart_icon .current_item_number,
 .cesis_overlay_cart .cesis_cart_icon .current_item_number,
 .cesis_mobile_cart .cesis_cart_icon .current_item_number
 { background:'.esc_attr($header_a_hover_color).';}';
  if( cesis_check_bp_status() == true) {
  $meta_css .= '.tt-main-additional .cesis_bp_notifications_count,
 .cesis_offcanvas_notifications .cesis_bp_notifications_count,
 .cesis_overlay_notifications .cesis_bp_notifications_count,
 .cesis_mobile_notifications .cesis_bp_notifications_count
 { background:'.esc_attr($header_a_hover_color).';}';
  }


  $meta_css .= '.tt-main-additional .cesis_social_icons a:hover::after,
 .tt-main-additional .cesis_search_icon a:hover i:after,
 .tt-main-additional .cesis_cart_icon > ul > li > a:hover::after,
 .tt-main-additional .cesis_bp_notifications a:hover::after{
   background-color:'.esc_attr($header_a_hover_bg_color).';
   border-color:'.esc_attr($header_a_hover_border_color).';
 }


 .tt-header-additional .cesis_social_icons a,.tt-header-additional .cesis_search_icon,.tt-header-additional .cesis_cart_icon,
 .tt-header-additional > span,.tt-header-additional .cesis_bp_notifications > span { margin:0 '.esc_attr($header_a_space).'px;}
 bodynot(.rtl) .tt-header-additional .cesis_social_icons a:first-child,bodynot(.rtl) .tt-header-additional > span:first-child,bodynot(.rtl) .tt-header-additional .cesis_bp_notifications > span:first-child{ margin:0 '.esc_attr($header_a_space).'px 0 0;}
 bodynot(.rtl) .tt-header-additional .cesis_social_icons a:last-child,bodynot(.rtl) .tt-header-additional > span:last-child,bodynot(.rtl) .tt-header-additional .cesis_bp_notifications > span:last-child { margin:0 0 0 '.esc_attr($header_a_space).'px;}
 body.rtl .tt-header-additional .cesis_social_icons a:first-child,body.rtl .tt-header-additional > span:first-child,body.rtl .tt-header-additional .cesis_bp_notifications > span:first-child { margin:0 0 0 '.esc_attr($header_a_space).'px;}
 body.rtl .tt-header-additional .cesis_social_icons a:last-child,body.rtl .tt-header-additional > span:last-child,body.rtl .tt-header-additional .cesis_bp_notifications > span:last-child { margin:0 '.esc_attr($header_a_space).'px 0 0;}

 .menu_sep{ font-family:'.esc_attr($menu_font).'; font-size:'.esc_attr($menu_size).'; color:'.esc_attr($menu_sep).'; }';

}else {
	$header_layout = $cesis_data['cesis_header_layout'];
	$menu_type = $cesis_data["cesis_menu_type"];
}


/* Transparent header settings */
if($custom_general_header == 'yes' && $meta_header_state !== 'no'){

	if($custom_header !== "yes"){
		$menu_border_pos = $cesis_data['cesis_menu_border_pos'];
		$menu_border_size = $cesis_data['cesis_menu_border_size'];
	}

 if($header_layout == 'vertical_offcanvas_header_b'){
if($header_shrink_status !== 'no'){
$meta_css .= '.cesis_header_shrink.cesis_stuck .header_logo,
.cesis_header_shrink.cesis_stuck .cesis_menu_button.cesis_offcanvas_switch,
.cesis_header_shrink.cesis_stuck .cesis_offcanvas_cart,
.cesis_header_shrink.cesis_stuck .header_main .cesis_offcanvas_notifications a,
.cesis_header_shrink.cesis_stuck .header_main .cesis_offcanvas_notifications i,
.cesis_header_shrink.cesis_stuck .header_main .cesis_offcanvas_notifications > span
{ line-height:'.esc_attr($header_shrinked_height).'px; height:'.esc_attr($header_shrinked_height).'px;}
.cesis_header_shrink.cesis_stuck .header_main
{height:'.esc_attr($header_shrinked_height).'px;}
.cesis_header_shrink.cesis_stuck .header_logo #logo_img img
{ max-height:'.esc_attr($header_shrinked_logo).'px;}';
 }
 }

if($header_layout == 'overlay_header_b'){
if($header_shrink_status !== 'no'){
 $meta_css .= '.cesis_header_shrink.cesis_stuck .header_logo,
.cesis_header_shrink.cesis_stuck .cesis_menu_button.cesis_menu_overlay ,
.cesis_header_shrink.cesis_stuck .cesis_menu_overlay_close,
.cesis_header_shrink.cesis_stuck .cesis_overlay_cart,
.cesis_header_shrink.cesis_stuck .header_main .cesis_overlay_notifications a,
.cesis_header_shrink.cesis_stuck .header_main .cesis_overlay_notifications i,
.cesis_header_shrink.cesis_stuck .header_main .cesis_overlay_notifications > span
{ line-height:'.esc_attr($header_shrinked_height).'px; height:'.esc_attr($header_shrinked_height).'px;}
.cesis_header_shrink.cesis_stuck .header_main
{height:'.esc_attr($header_shrinked_height).'px;}
.cesis_header_shrink.cesis_stuck .header_logo #logo_img img
{ max-height:'.esc_attr($header_shrinked_logo).'px;}';


}
}
 if($header_layout == 'one_line_header'){
if($header_shrink_status !== 'no'){
 $meta_css .= '.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-navigation > div > ul > li > a,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .header_logo,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .menu_sep,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_social_icons,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_social_icons a,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_search_icon i,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_cart_icon i,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications a,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications.only_icons i,
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical) .tt-main-additional .cesis_bp_notifications.only_icons > span
{ line-height:'.esc_attr($header_shrinked_height).'px; height:'.esc_attr($header_shrinked_height).'px;}
.cesis_header_shrink.cesis_stuck .header_main:not(.header_vertical)
{ height:'.esc_attr($header_shrinked_height).'px;}
.cesis_header_shrink.cesis_stuck .header_logo #logo_img img
{ max-height:'.esc_attr($header_shrinked_logo).'px;}';

 }
 }

if($header_layout == 'two_line_header'){
if($header_shrink_status !== 'no'){
$meta_css .= '.cesis_header_shrink.cesis_stuck .header_sub .tt-main-navigation  > div > ul > li > a,.header_sub .menu_sep,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_social_icons,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_social_icons a,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_search_icon i,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_cart_icon i,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_bp_notifications a,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_bp_notifications.only_icons i,
.cesis_header_shrink.cesis_stuck .tt-sub-additional .cesis_bp_notifications.only_icons > span
{ line-height:'.esc_attr($header_shrinked_height).'px; height:'.esc_attr($header_shrinked_height).'px; }
.cesis_header_shrink.cesis_stuck .header_sub
{height:'.esc_attr($header_shrinked_height).'px;}';
}
}

$meta_css .= '@media only screen and (min-width: '.esc_attr($header_breakpoint).'px) {';


$meta_css .= '  body'.esc_attr($mobile_status).' .overlay_menu_on {transform: none !important; transition:all 0s; webkit-transition:all 0s;}
	body'.esc_attr($mobile_status).'.cesis_vertical_header .cesis_sticky {transform: none; }';

 if($menu_type == 'nav_line_separator' ){
$meta_css .= '  body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-navigation  > div > ul > li.current-menu-item > a,
	body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-navigation  > div > ul > li > a:hover{ background-color:'.esc_attr($header_transparent_bg_color).';}';
 }

 if($menu_type == 'nav_top_borderx' && $menu_border_pos == 'edge_border' ){
$meta_css .= '  body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_top_borderx.edge_border  > div > ul > li.current-menu-item > a,
	body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_top_borderx.edge_border  > div > ul > li > a:hover
	{ box-shadow: inset 0px '.esc_attr($menu_border_size).'px '.esc_attr($header_transparent_active_color).';}';
 }

 if($menu_type == 'nav_top_borderx' && $menu_border_pos == 'text_border' ){
$meta_css .= '  body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_top_borderx.text_border  > div > ul > li.current-menu-item > a span,
	body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_top_borderx.text_border  > div > ul > li > a:hover span {box-shadow: inset 0px '.esc_attr($menu_border_size).'px '.esc_attr($header_transparent_active_color).'; }';
 }

 if($menu_type == 'nav_bottom_borderx' && $menu_border_pos == 'edge_border' ){
$meta_css .= '  body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_bottom_borderx.edge_border  > div > ul > li.current-menu-item > a,
	body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_bottom_borderx.edge_border  > div > ul > li > a:hover
	{ box-shadow: inset 0px -'.esc_attr($menu_border_size).'px '.esc_attr($header_transparent_active_color).';}';
 }

 if($menu_type == 'nav_bottom_borderx' && $menu_border_pos == 'text_border' ){
$meta_css .= 'body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_bottom_borderx.text_border  > div > ul > li.current-menu-item > a span,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_bottom_borderx.text_border  > div > ul > li > a:hover span {box-shadow: inset 0px -'.esc_attr($menu_border_size).'px '.esc_attr($header_transparent_active_color).'; }';
 }

 if($menu_type == 'nav_boxed_border'){
$meta_css .= 'body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_boxed_border  > div > ul > li.current-menu-item > a span,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_boxed_border  > div > ul > li > a:hover span {border:'.esc_attr($menu_border_size).'px solid '.esc_attr($header_transparent_active_color).'; }';
 }

$meta_css .= 'body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_main:not(.header_vertical),
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_sub,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar,
body'.esc_attr($mobile_status).':not(.full_header_sticky) .cesis_transparent_header .header_top_bar
{background-color:'.esc_attr($header_transparent_bg_color).'; border-color:'.esc_attr($header_transparent_border_color).'}
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_logo:not(.vertical_logo) a,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-navigation:not(.tt-vertical-navigation)  > div > ul > li > a span,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .menu_sep,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-header-additional:not(.vertical_additional) .cesis_social_icons a,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-header-additional:not(.vertical_additional) .cesis_search_icon a,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-header-additional:not(.vertical_additional) .cesis_bp_notifications a,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-header-additional:not(.vertical_additional) .cesis_cart_icon i,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar a,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar .cesis_social_icons a,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar .cesis_cart_icon a,
body'.esc_attr($mobile_status).':not(.full_header_sticky) .cesis_transparent_header .header_top_bar,
body'.esc_attr($mobile_status).':not(.full_header_sticky) .cesis_transparent_header .header_top_bar a,
body'.esc_attr($mobile_status).':not(.full_header_sticky) .cesis_transparent_header .header_top_bar .cesis_social_icons a,
body'.esc_attr($mobile_status).':not(.full_header_sticky) .cesis_transparent_header .header_top_bar .cesis_cart_icon a,
body.cesis_offcanvas_header'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_logo a,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .cesis_offcanvas_cart .cart-menu > li > a,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_main .cesis_offcanvas_notifications a
{color:'.esc_attr($header_transparent_color).'}
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_line_separator  > div > ul > li,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_line_separator > div > ul,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .nav_line_separator.logo_center > div > ul .cl_before_logo,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck),
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-additional,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-sub-additional,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-additional.logo_center.additional_border .cesis_social_icons,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-additional .cesis_social_icons a:after,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-additional.logo_center.additional_border .cesis_search_icon,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-additional .cesis_search_icon a i:after,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-sub-additional.menu_center.additional_border .cesis_social_icons,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-sub-additional .cesis_social_icons a:after,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-sub-additional.menu_center.additional_border .cesis_search_icon,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-sub-additional .cesis_search_icon a i:after
{border-color:'.esc_attr($header_transparent_border_color).'}
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-navigation:not(.tt-vertical-navigation)  > div > ul > li.current-menu-item > a span,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-main-navigation:not(.tt-vertical-navigation)  > div > ul > li > a:hover span,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-header-additional:not(.vertical_additional) .cesis_social_icons a:hover,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-header-additional:not(.vertical_additional) .cesis_search_icon:hover a,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .tt-header-additional:not(.vertical_additional) .cesis_bp_notifications a:hover,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar a:hover,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar .cesis_social_icons a:hover,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_top_bar .cesis_cart_icon a:hover,
body'.esc_attr($mobile_status).':not(.full_header_sticky) .cesis_transparent_header .header_top_bar a:hover,
body'.esc_attr($mobile_status).':not(.full_header_sticky) .cesis_transparent_header .header_top_bar .cesis_social_icons a:hover,
body'.esc_attr($mobile_status).':not(.full_header_sticky) .cesis_transparent_header .header_top_bar .cesis_cart_icon a:hover
{color:'.esc_attr($header_transparent_active_color).'}
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_main .lines,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_main .lines:after,
body'.esc_attr($mobile_status).' .cesis_transparent_header .top-header:not(.cesis_stuck) .header_main .lines:before
{background-color:'.esc_attr($header_transparent_color).'}';

$meta_css .= '}';

}


  $mobile_menu_height = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_mobile_menu_height');
  $mobile_menu_bg = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_mobile_menu_bg');
  $mobile_menu_border = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_mobile_menu_border');
  $mobile_menu_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_mobile_menu_font');
	if(isset($mobile_menu_array) && !empty($mobile_menu_array)) {
  $mobile_menu_color = $mobile_menu_array['color'];
  $mobile_menu_font = $mobile_menu_array['font-family'];
  $mobile_menu_size = $mobile_menu_array['font-size'];
  $mobile_menu_weight = $mobile_menu_array['font-weight'];
  $mobile_menu_tt = $mobile_menu_array['text-transform'];
  $mobile_menu_ls = $mobile_menu_array['letter-spacing'];
  $mobile_menu_lh = $mobile_menu_array['line-height'];
	}
  $mobile_submenu_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_mobile_sub_menu_font');
	if(isset($mobile_submenu_array) && !empty($mobile_submenu_array)) {
  $mobile_submenu_color = $mobile_submenu_array['color'];
  $mobile_submenu_font = $mobile_submenu_array['font-family'];
  $mobile_submenu_size = $mobile_submenu_array['font-size'];
  $mobile_submenu_weight = $mobile_submenu_array['font-weight'];
  $mobile_submenu_tt = $mobile_submenu_array['text-transform'];
  $mobile_submenu_ls = $mobile_submenu_array['letter-spacing'];
  $mobile_submenu_lh = $mobile_submenu_array['line-height'];
	}
  $mobile_open_menu = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_mobile_open_menu');
  $mobile_current_menu = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_mobile_current_menu');

if($custom_mobile == 'yes'){

/* Mobile menu settings */

 $meta_css .= '.header_mobile{ background:'.esc_attr($mobile_menu_bg).'; }
.header_mobile span {font-family:'.esc_attr($mobile_menu_font).'; color:'.esc_attr($mobile_menu_color).';
font-size:'.esc_attr($mobile_menu_size).'; font-weight:'.esc_attr($mobile_menu_weight).';
text-transform:'.esc_attr($mobile_menu_tt).'; letter-spacing:'.esc_attr($mobile_menu_ls).';
 line-height:'.esc_attr($mobile_menu_lh).';}
.tt-mobile-additional .cesis_social_icons a { color:'.esc_attr($mobile_menu_color).'; line-height:'.esc_attr($mobile_menu_lh).';}

.header_mobile li span,.tt-mobile-additional .cesis_search_icon a,.tt-mobile-additional .cesis_social_icons,
.tt-mobile-additional .cesis_search_icon input[type="search"] { border-color:'.esc_attr($mobile_menu_border).'; }
.header_mobile .has-submenu > span:after,.header_mobile .has-submenu > span:before,
.header_mobile li span:after,.header_mobile li span:before{background:'.esc_attr($mobile_menu_color).';}
.header_mobile .highlighted > span{color:'.esc_attr($mobile_open_menu).';}
.header_mobile .highlighted > span:after,.header_mobile .highlighted > span:before{background:'.esc_attr($mobile_open_menu).';}


.header_mobile .current-menu-item > a > span {color:'.esc_attr($mobile_current_menu).';}
.header_mobile .current-menu-item { border-color:'.esc_attr($mobile_current_menu).';}';
}


if($custom_breakpoint == 'yes' || $custom_mobile == 'yes'){
/* mobile breakpoint */
 $meta_css .= '@media only screen and (min-width: '.esc_attr((int)$header_breakpoint+1).'px) {
body'.esc_attr($mobile_status).' .header_mobile { display:none!important;}
body'.esc_attr($mobile_status).' .mega_no_heading > ul > li > a:first-child { display: none; }
}
@media only screen and (max-width: '.esc_attr($header_breakpoint).'px) {
body'.esc_attr($mobile_status).' .cesis_transparent_header { position:static;}
body'.esc_attr($mobile_status).' .desktop_logo { display:none !important;}
body'.esc_attr($mobile_status).' .mobile_logo { display:inline-block !important; max-height:'.esc_attr($mobile_menu_height).'px !important;}
body'.esc_attr($mobile_status).' .header_logo { width:100%; max-width:none;}
body'.esc_attr($mobile_status).' .header_main,body'.esc_attr($mobile_status).' .header_logo,
body'.esc_attr($mobile_status).' .cesis_mobile_notifications .cesis_bp_notifications,
body'.esc_attr($mobile_status).' .cesis_mobile_notifications .cesis_bp_notifications > span,
body'.esc_attr($mobile_status).' .cesis_mobile_notifications a,
body'.esc_attr($mobile_status).' .cesis_mobile_notifications i
{height:'.esc_attr($mobile_menu_height).'px !important; min-height: auto !important; line-height:'.esc_attr($mobile_menu_height).'px !important}
body'.esc_attr($mobile_status).' #header_container.cesis_opaque_header {min-height:'.esc_attr($mobile_menu_height).'px !important;}

body'.esc_attr($mobile_status).' .cesis_mobile_menu_switch,
body'.esc_attr($mobile_status).' .cesis_mobile_btn{ display:flex;}
body'.esc_attr($mobile_status).' .cesis_mobile_cart,
body'.esc_attr($mobile_status).' .cesis_mobile_notifications{display:block;}
body'.esc_attr($mobile_status).' .tt-main-additional,body'.esc_attr($mobile_status).' .tt-main-navigation,
body'.esc_attr($mobile_status).' .header_sub,body'.esc_attr($mobile_status).' .header_offcanvas,
body'.esc_attr($mobile_status).' .cesis_offcanvas_switch,body'.esc_attr($mobile_status).' .header_overlay,
body'.esc_attr($mobile_status).' .header_overlay,body'.esc_attr($mobile_status).' .cesis_menu_overlay,
body'.esc_attr($mobile_status).' .header_overlay,body'.esc_attr($mobile_status).' .cesis_offcanvas_cart,
body'.esc_attr($mobile_status).' .cesis_offcanvas_notifications,body'.esc_attr($mobile_status).' .cesis_overlay_cart,
body'.esc_attr($mobile_status).' .cesis_overlay_notifications{ display:none}

body'.esc_attr($mobile_status).' .logo_center .cesis_mobile_menu_switch,
body'.esc_attr($mobile_status).' .logo_center .cesis_mobile_btn,
body'.esc_attr($mobile_status).' .logo_left .cesis_mobile_menu_switch,
body'.esc_attr($mobile_status).' .logo_left .cesis_mobile_btn,
body'.esc_attr($mobile_status).' .logo_center .cesis_mobile_cart,
body'.esc_attr($mobile_status).' .logo_center .cesis_mobile_notifications,
body'.esc_attr($mobile_status).' .logo_left .cesis_mobile_cart,
body'.esc_attr($mobile_status).' .logo_left .cesis_mobile_notifications,
body'.esc_attr($mobile_status).' .logo_right .site-title,
body'.esc_attr($mobile_status).' .logo_right #logo_img,
body'.esc_attr($mobile_status).' .header_v_pos_right .cesis_mobile_menu_switch,
body'.esc_attr($mobile_status).' .header_v_pos_right .cesis_mobile_btn,
body'.esc_attr($mobile_status).' .header_v_pos_left .site-title,
body'.esc_attr($mobile_status).' .header_v_pos_left #logo_img,
body'.esc_attr($mobile_status).' .header_v_pos_right .cesis_mobile_cart{float:right;}

body'.esc_attr($mobile_status).' .logo_center,
body'.esc_attr($mobile_status).' .logo_center #logo_img,
body'.esc_attr($mobile_status).' .logo_right .cesis_mobile_menu_switch,
body'.esc_attr($mobile_status).' .logo_right .cesis_mobile_btn,
body'.esc_attr($mobile_status).' .logo_right .cesis_mobile_cart,
body'.esc_attr($mobile_status).' .logo_right .cesis_mobile_notifications,
body'.esc_attr($mobile_status).' .logo_left .site-title,
body'.esc_attr($mobile_status).' .logo_left #logo_img,
body'.esc_attr($mobile_status).' .header_v_pos_left .cesis_mobile_menu_switch,
body'.esc_attr($mobile_status).' .header_v_pos_left .cesis_mobile_btn,
body'.esc_attr($mobile_status).' .header_v_pos_right .site-title,
body'.esc_attr($mobile_status).' .header_v_pos_right #logo_img,
body'.esc_attr($mobile_status).' .header_v_pos_left .cesis_mobile_cart{float:left;}

body'.esc_attr($mobile_status).' .header_vertical.header_v_cy_justify .cesis_container { overflow:visible;}

body'.esc_attr($mobile_status).' .cesis_top_banner,body'.esc_attr($mobile_status).' #header_container,body'.esc_attr($mobile_status).' #main-content,
body'.esc_attr($mobile_status).' #cesis_colophon{margin-right:0; margin-left:0;}
body'.esc_attr($mobile_status).' .header_main.header_vertical .cesis_container,body'.esc_attr($mobile_status).'  .header_offcanvas .cesis_container {padding:0 40px;}
body'.esc_attr($mobile_status).' .header_main.header_vertical {width:100%; position:relative; top:auto!important;}

body'.esc_attr($mobile_status).' .header_logo.logo_center { margin:0 !important; position:static!important;}

}';
/* end mobile breakpoint */

}


	$custom_dropdown = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_dropdown');

	if($custom_dropdown == 'yes'){

  $d_dropdown_bg = $cesis_data["cesis_dropdown_bg"]['rgba'];
  $d_dropdown_border = $cesis_data["cesis_dropdown_border"]['rgba'];
  $d_dropdown_color = $cesis_data["cesis_dropdown_font"]['color'];
  $d_dropdown_font = $cesis_data["cesis_dropdown_font"]['font-family'];
  $d_dropdown_size = $cesis_data["cesis_dropdown_font"]['font-size'];
  $d_dropdown_weight = $cesis_data["cesis_dropdown_font"]['font-weight'];
  $d_dropdown_tt = $cesis_data["cesis_dropdown_font"]['text-transform'];
  $d_dropdown_ls = $cesis_data["cesis_dropdown_font"]['letter-spacing'];
  $d_dropdown_lh = $cesis_data["cesis_dropdown_font"]['line-height'];
  $d_dropdown_hover_color = $cesis_data["cesis_dropdown_hover_color"];
  $d_dropdown_hover_bg_color = $cesis_data["cesis_dropdown_hover_bg_color"];
  $d_dropdown_active = $cesis_data["cesis_dropdown_active"];
  $d_dropdown_heading_color = $cesis_data["cesis_dropdown_heading"]['color'];
  $d_dropdown_heading_font = $cesis_data["cesis_dropdown_heading"]['font-family'];
  $d_dropdown_heading_size = $cesis_data["cesis_dropdown_heading"]['font-size'];
  $d_dropdown_heading_weight = $cesis_data["cesis_dropdown_heading"]['font-weight'];
  $d_dropdown_heading_tt = $cesis_data["cesis_dropdown_heading"]['text-transform'];
  $d_dropdown_heading_ls = $cesis_data["cesis_dropdown_heading"]['letter-spacing'];
  $d_dropdown_heading_lh = $cesis_data["cesis_dropdown_heading"]['line-height'];

	$dropdown_bg_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_dropdown_bg');
  $dropdown_bg = $dropdown_bg_array['rgba'];
  $dropdown_border_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_dropdown_border');
  $dropdown_border = $dropdown_border_array['rgba'];
  $dropdown_font_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_dropdown_font');
  $dropdown_color = $dropdown_font_array['color'];
  $dropdown_font = $dropdown_font_array['font-family'];
  $dropdown_size = $dropdown_font_array['font-size'];
  $dropdown_weight = $dropdown_font_array['font-weight'];
  $dropdown_tt = $dropdown_font_array['text-transform'];
  $dropdown_ls = $dropdown_font_array['letter-spacing'];
  $dropdown_lh = $dropdown_font_array['line-height'];
  $dropdown_hover_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_dropdown_hover_color');
  $dropdown_hover_bg_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_dropdown_hover_bg_color');
  $dropdown_active = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_dropdown_active');
  $dropdown_heading_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_dropdown_heading');
  $dropdown_heading_color = $dropdown_heading_array['color'];
  $dropdown_heading_font = $dropdown_heading_array['font-family'];
  $dropdown_heading_size = $dropdown_heading_array['font-size'];
  $dropdown_heading_weight = $dropdown_heading_array['font-weight'];
  $dropdown_heading_tt = $dropdown_heading_array['text-transform'];
  $dropdown_heading_ls = $dropdown_heading_array['letter-spacing'];
  $dropdown_heading_lh = $dropdown_heading_array['line-height'];

	/* Dropdown settings */


	$meta_css .= '.tt-main-navigation:not(.tt-vertical-navigation) .sub-menu,.cesis_cart_icon .cesis_dropdown{ background:'.esc_attr($dropdown_bg).'; color:'.esc_attr($dropdown_color).';
		 font-family:'.esc_attr($dropdown_font).'; font-size:'.esc_attr($dropdown_size).'; font-weight:'.esc_attr($dropdown_weight).';
		text-transform:'.esc_attr($dropdown_tt).'; letter-spacing:'.esc_attr($dropdown_ls).'; line-height:'.esc_attr($dropdown_lh).'; }

	.cesis_cart_icon .product_list_widget span.woocommerce-Price-amount.amount,.sm .cesis_megamenu_widget_area a{ font-family:'.esc_attr($dropdown_font).' }

	.sm .cesis_megamenu_widget_area a,
	.cesis_dropdown ul.product_list_widget li.mini_cart_item a{ color:'.esc_attr($dropdown_color).'; }

	.tt-main-navigation:not(.tt-vertical-navigation) .sub-menu li > a > span,
	.cesis_cart_icon .cesis_dropdown,
	.cesis_cart_icon a.remove:after,
	.cesis_cart_icon .product_list_widget span.woocommerce-Price-amount.amount{color:'.esc_attr($dropdown_color).';}';

	if($dropdown_hover_color !== $d_dropdown_hover_color || $dropdown_hover_bg_color !== $d_dropdown_hover_bg_color ){
	$meta_css .= '.tt-main-navigation:not(.tt-vertical-navigation) .sub-menu li > a > span:hover
	{color:'.esc_attr($dropdown_hover_color).'; Background:'.esc_attr($dropdown_hover_bg_color).';}';
	}

	if($dropdown_active !== $d_dropdown_active){
	$meta_css .= '.tt-main-navigation:not(.tt-vertical-navigation) > div > ul > li .sub-menu li.current-menu-item > a > span,
	.cesis_cart_icon a.remove:hover:after {color:'.esc_attr($dropdown_active).';}
	body:not(.rtl) .tt-main-navigation:not(.tt-vertical-navigation) > div > ul > li:not(.cesis_megamenu) .sub-menu li.current-menu-item > a > span {
			box-shadow: inset 5px 0 0 0 '.esc_attr($dropdown_active).'; }
	body.rtl .tt-main-navigation:not(.tt-vertical-navigation) > div > ul > li:not(.cesis_megamenu) .sub-menu li.current-menu-item > a > span {
			box-shadow: inset -5px 0 0 0 '.esc_attr($dropdown_active).'; }
	.cesis_cart_icon .buttons a.button:last-child{ background:'.esc_attr($dropdown_active).'; }';
	}

	if($dropdown_border !== $d_dropdown_border){
	$meta_css .= '.tt-main-navigation:not(.tt-vertical-navigation) .cesis_megamenu > .sub-menu > li,
	.cesis_cart_icon ul.product_list_widget li.mini_cart_item,
	.cesis_cart_icon .buttons a.button:first-child,
	.cesis_cart_icon .widget_shopping_cart_content .total,
	.cesis_megamenu_widget_area section.widget_meta li,
	.cesis_megamenu_widget_area section.widget_archive li,
	.cesis_megamenu_widget_area section.widget_categories li,
	.cesis_megamenu_widget_area section.widget_pages li a,
	.cesis_megamenu_widget_area section.widget_recent_comments li,
	.cesis_megamenu_widget_area section.widget_recent_entries li,
	.cesis_megamenu_widget_area input,
	.cesis_megamenu_widget_area ul.product_list_widget li.mini_cart_item,
	.cesis_megamenu_widget_area .woocommerce-product-search input[type="search"]
	{ border-color:'.esc_attr($dropdown_border).'}';
	}
	$meta_css .= '.tt-main-navigation:not(.tt-vertical-navigation) .cesis_megamenu > .sub-menu > li > a > span,
	.cesis_megamenu_widget_area section h2
	{ color:'.esc_attr($dropdown_heading_color).';
	font-family:'.esc_attr($dropdown_heading_font).'; font-size:'.esc_attr($dropdown_heading_size).'; font-weight:'.esc_attr($dropdown_heading_weight).';
	text-transform:'.esc_attr($dropdown_heading_tt).'; letter-spacing:'.esc_attr($dropdown_heading_ls).'; line-height:'.esc_attr($dropdown_heading_lh).'; }
	.sub-menu .cesis_cart_icon a,.sub-menu .cesis_cart_icon span.woocommerce-Price-amount.amount,
	.sub-menu .cesis_cart_icon .buttons a.button:first-child{ color:'.esc_attr($dropdown_heading_color).'; }
	.tt-main-navigation:not(.tt-vertical-navigation) .cesis_megamenu > .sub-menu > li > a > span:after,
	.tt-main-navigation:not(.tt-vertical-navigation) > div > ul > li.cesis_megamenu .sub-menu li.current-menu-item > a > span:after,
	.cesis_megamenu_widget_area section h2:after { background:'.esc_attr($dropdown_active).';}';


}

//////////////////////////////////////////////////////////////////
////                                                         ////
///                 TITLE SETTINGS START                    ////
//                                                         ////
//////////////////////////////////////////////////////////////

$custom_title = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_title');

$title_bg_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title_background');
if(isset($title_bg_array['background-color'])){
$title_bg_color = $title_bg_array['background-color'];
}
if(isset($title_bg_array['background-image'])){
// Background image.
$title_bg_image = $title_bg_array['background-image'];
$title_bg_repeat = $title_bg_array['background-repeat'];
$title_bg_position = $title_bg_array['background-position'];
$title_bg_size = $title_bg_array['background-size'];
$title_bg_attachement = $title_bg_array['background-attachment'];
}
// Background image options


$title_width_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title_width');
if(isset($title_width_array) && $title_width_array!==""){
$title_width_units = $title_width_array["units"];
if($title_width_units !== '%'){
  $title_width = ((int)$title_width_array["width"] + 80).$title_width_units;
}else{
  $title_width = $title_width_array["width"];
}
}

$title_height_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title_height');
if(isset($title_height_array) && $title_height_array!==""){
$title_height = $title_height_array["height"];
$title_height_units = $title_height_array["units"];
}
$title_min_height_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title_minheight');
if(isset($title_min_height_array) && $title_min_height_array!==""){
$title_min_height = $title_min_height_array["height"];
}

$title_font_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title_font');
if(isset($title_font_array) && $title_font_array!==""){
$title_color = $title_font_array['color'];
$title_font = $title_font_array['font-family'];
$title_size = $title_font_array['font-size'];
$title_weight = $title_font_array['font-weight'];
$title_tt = $title_font_array['text-transform'];
$title_ls = $title_font_array['letter-spacing'];
}
$title_border = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title_border');

$bread_font_array = redux_post_meta(  'cesis_data', get_the_ID(), 'cesis_meta_breadcrumbs_font');
if(isset($bread_font_array) && $bread_font_array!==""){
$bread_color = $bread_font_array['color'];
$bread_font = $bread_font_array['font-family'];
$bread_size = $bread_font_array['font-size'];
$bread_weight = $bread_font_array['font-weight'];
$bread_tt = $bread_font_array['text-transform'];
$bread_ls = $bread_font_array['letter-spacing'];
}
$bread_active_color = redux_post_meta(  'cesis_data', get_the_ID(), 'cesis_meta_current_breadcrumbs_color');
$bread_bg_array = redux_post_meta(  'cesis_data', get_the_ID(), 'cesis_meta_breadcrumbs_bg_color');
if(isset($bread_bg_array['rgba'])){
$bread_bg_color = $bread_bg_array['rgba'];
}else{
	$bread_bg_color = 'rgba(0,0,0,0.15)';
}

if($custom_title == 'yes'){

if(isset($title_bg_array['background-image'])){
 if($title_bg_image !== '') {
	$meta_css .= '.page_title_container,
	body.woocommerce .page_title_container,
	body.bbpress:not(.buddypress) .page_title_container,
	body.single-post .page_title_container,
	body.single-portfolio .page_title_container,
	body.single-staff .page_title_container{
background-image:url('.esc_attr($title_bg_image).');
background-repeat:'.esc_attr($title_bg_repeat).';
background-position:'.esc_attr($title_bg_position).';
background-size:'.esc_attr($title_bg_size).';
background-attachment:'.esc_attr($title_bg_attachement).';
background-color:'.esc_attr($title_bg_color).';
}';
}
}
	if(isset($title_bg_array['background-color'])){
	$meta_css .= '.page_title_container,
	body.woocommerce .page_title_container,
	body.bbpress:not(.buddypress) .page_title_container,
	body.single-post .page_title_container,
	body.single-portfolio .page_title_container,
	body.single-staff .page_title_container{ background-color:'.esc_attr($title_bg_color).';}';
 }
  if($title_border !== ''){
	$meta_css .= '.page_title_container,
	body.woocommerce .page_title_container,
	body.bbpress:not(.buddypress) .page_title_container,
	body.single-post .page_title_container,
	body.single-portfolio .page_title_container,
	body.single-staff .page_title_container{  border-bottom:1px solid '.esc_attr($title_border).';}';
 } if($title_min_height !== ''){
	$meta_css .= '.page_title_container,
	body.woocommerce .page_title_container,
	body.bbpress:not(.buddypress) .page_title_container,
	body.single-post .page_title_container,
	body.single-portfolio .page_title_container,
	body.single-staff .page_title_container{ min-height:'.esc_attr($title_min_height).'; }';
 } if($title_width !== '' ){
	$meta_css .= '.page_title_container .cesis_container,.title_layout_three .breadcrumb_container ul,
	body.woocommerce .page_title_container .cesis_container,body.woocommerce .title_layout_three .breadcrumb_container ul,
	body.bbpress:not(.buddypress) .page_title_container .cesis_container,body.bbpress:not(.buddypress) .title_layout_three .breadcrumb_container ul,
	body.single-post .page_title_container .cesis_container,body.single-post .title_layout_three .breadcrumb_container ul,
	body.single-portfolio .page_title_container .cesis_container,body.single-portfolio .title_layout_three .breadcrumb_container ul,
	body.single-staff .page_title_container .cesis_container,body.single-staff .title_layout_three .breadcrumb_container ul{ max-width:'.esc_attr($title_width).'; }';
 }if( $title_height_units == 'px'){
	$meta_css .= '.page_title_container,
	body.woocommerce .page_title_container,
	body.bbpress:not(.buddypress) .page_title_container,
	body.single-post .page_title_container,
	body.single-portfolio .page_title_container,
	body.single-staff .page_title_container{ height:'.esc_attr($title_height).'; }';
 }elseif( $title_height_units !== 'px'){
  $title_height = str_replace('%','vh', $title_height);
	$meta_css .= '.page_title_container,
	body.woocommerce .page_title_container,
	body.bbpress:not(.buddypress) .page_title_container,
	body.single-post .page_title_container,
	body.single-portfolio .page_title_container,
	body.single-staff .page_title_container{ height:'.esc_attr($title_height).'; }';
 }

/* title */
	$meta_css .= '.main-title,
	body.woocommerce .main-title,
	body.bbpress:not(.buddypress) .main-title,
	body.single-post .main-title,
	body.single-portfolio .main-title,
	body.single-staff .main-title{ color:'.esc_attr($title_color).'; font-family:'.esc_attr($title_font).'; font-size:'.esc_attr($title_size).'; text-transform:'.esc_attr($title_tt).'; letter-spacing:'.esc_attr($title_ls).';  font-weight:'.esc_attr($title_weight).'; }
	.main-title a,
	body.woocommerce .main-title a,
	body.bbpress:not(.buddypress) .main-title a,
	body.single-post .main-title a,
	body.single-portfolio .main-title a,
	body.single-staff .main-title a{ color:'.esc_attr($title_color).'; }';

/* breadcrumb */

	$meta_css .= '.breadcrumb_container,
	body.woocommerce .breadcrumb_container,
	body.bbpress:not(.buddypress) .breadcrumb_container,
	body.single-post .breadcrumb_container,
	body.single-portfolio .breadcrumb_container,
	body.single-staff .breadcrumb_container{ font-family:'.esc_attr($bread_font).'; font-size:'.esc_attr($bread_size).'; text-transform:'.esc_attr($bread_tt).'; letter-spacing:'.esc_attr($bread_ls).'; font-weight:'.esc_attr($bread_weight).';}
	.breadcrumb_container,.breadcrumb_container a,
	body.woocommerce .breadcrumb_container,body.woocommerce .breadcrumb_container a,
	body.bbpress:not(.buddypress) .breadcrumb_container,body.bbpress:not(.buddypress) .breadcrumb_container a,
	body.single-post .breadcrumb_container,body.single-post .breadcrumb_container a,
	body.single-portfolio .breadcrumb_container,body.single-portfolio .breadcrumb_container a,
	body.single-staff .breadcrumb_container,body.single-staff .breadcrumb_container a{ color:'.esc_attr($bread_color).' }
	.breadcrumb_container a:hover,
	body.woocommerce .breadcrumb_container a:hover,
	body.bbpress:not(.buddypress) .breadcrumb_container a:hover,
	body.single-post .breadcrumb_container a:hover,
	body.single-portfolio .breadcrumb_container a:hover,
	body.single-staff .breadcrumb_container a:hover{ color:'.esc_attr($bread_active_color).' }
	.title_layout_three .breadcrumb_container,
	body.woocommerce .title_layout_three .breadcrumb_container,
	body.bbpress:not(.buddypress) .title_layout_three .breadcrumb_container,
	body.single-post .title_layout_three .breadcrumb_container,
	body.single-portfolio .title_layout_three .breadcrumb_container,
	body.single-staff .title_layout_three .breadcrumb_container{ background:'.esc_attr($bread_bg_color).' }';



/* Title settings End */

}



//////////////////////////////////////////////////////////////////
////                                                         ////
///                      MAIN CONTENT                       ////
//                                                         ////
//////////////////////////////////////////////////////////////

$custom_colors = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_custom_color');

if($custom_colors == 'yes'){

$d_main_area_bg = $cesis_data["cesis_main_content_bg"];
$d_main_area_border = $cesis_data["cesis_main_content_border"];
$d_main_area_heading = $cesis_data["cesis_main_content_heading"];
$d_main_area_color = $cesis_data["cesis_main_content_color"];
$d_main_area_light_color = $cesis_data["cesis_main_content_light_color"];
$d_main_area_one_acolor = $cesis_data["cesis_main_content_accent_one"];
$d_main_area_two_acolor = $cesis_data["cesis_main_content_accent_two"];
$d_main_area_three_acolor = $cesis_data["cesis_main_content_accent_three"];


$main_area_bg = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_bg');
$main_area_border = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_border');
$main_area_heading = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_heading');
$main_area_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_color');
$main_area_light_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_light_color');
$main_area_one_acolor = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_accent_one');
$main_area_two_acolor = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_accent_two');
$main_area_three_acolor = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_accent_three');


$d_main_area_alt_bg = $cesis_data["cesis_main_content_alt_bg"];
$d_main_area_alt_border = $cesis_data["cesis_main_content_alt_border"];
$d_main_area_alt_heading = $cesis_data["cesis_main_content_alt_heading"];
$d_main_area_alt_color = $cesis_data["cesis_main_content_alt_color"];
$d_main_area_alt_light_color = $cesis_data["cesis_main_content_alt_light_color"];
$d_main_area_alt_one_acolor = $cesis_data["cesis_main_content_alt_accent_one"];
$d_main_area_alt_two_acolor = $cesis_data["cesis_main_content_alt_accent_two"];
$d_main_area_alt_three_acolor = $cesis_data["cesis_main_content_alt_accent_three"];


$main_area_alt_bg = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_alt_bg');
$main_area_alt_border = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_alt_border');
$main_area_alt_heading = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_alt_heading');
$main_area_alt_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_alt_color');
$main_area_alt_light_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_alt_light_color');
$main_area_alt_one_acolor = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_alt_accent_one');
$main_area_alt_two_acolor = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_alt_accent_two');
$main_area_alt_three_acolor = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_content_alt_accent_three');



/* background */
if($d_main_area_bg !== $main_area_bg){
$meta_css .= '.site-main input[type="text"],.site-main input[type="email"],.site-main input[type="url"],
.site-main input[type="password"],.site-main input[type="search"],.site-main input[type="number"],.site-main textarea,
.site-main select,

.main-container,.comments-layout-two textarea,.comments-layout-two .single_post_author, .comments-layout-two .single_post_email, .comments-layout-two .single_post_url,.comments-layout-three,.comments-layout-three textarea,.comments-layout-three .single_post_author, .comments-layout-three .single_post_email, .comments-layout-three .single_post_url,.boxes_container article,.boxes_container .author_bio_ctn,.boxes_container .writer_navigation,.writer_container .author_bio_ctn,.comments-layout-four div.avatar,.comments-layout-one input, .comments-layout-one textarea,.comments-layout-two textarea, .comments-layout-two .single_post_author, .comments-layout-two .single_post_email, .comments-layout-two .single_post_url,.comments-layout-three textarea, .comments-layout-three .single_post_author, .comments-layout-three .single_post_email, .comments-layout-three .single_post_url,.comments-layout-four .single_post_author, .comments-layout-four .single_post_email, .comments-layout-four .single_post_url,.comments-layout-six input,.comments-layout-six textarea,.comments-layout-seven .comment_ctn,.comments-layout-seven input,.comments-layout-seven textarea,.lifestyle_container .author_bio_ctn,
.cesis_tabs.horizontal.cesis_tab_1 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_1 .tabs-container,
.cesis_tabs.horizontal.cesis_tab_2 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_2 .tabs-container,
.cesis_tabs.horizontal.cesis_tab_3 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_3 .tabs-container,
.cesis_tabs.horizontal.cesis_tab_5 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_5 .tabs-container,

.cesis_acc_1 .panel-title.active,
.cesis_acc_1 .panel-collapse.collapse.in,
.cesis_acc_3 .panel-title.active,
.cesis_acc_4 .panel-title.active,
.cesis_acc_5 .panel-title.active,

.cesis_blog_style_6 .cesis_blog_m_content,
.cesis_blog_style_7 .cesis_blog_m_content,
.cesis_blog_style_8 .cesis_blog_m_content,
.cesis_blog_style_15 .cesis_blog_m_content,
.cesis_sorter ul,
.cesis_filter_style_4 .cesis_sorter,
.cesis_filter_style_5 .cesis_sorter,
.cesis_filter_style_6 .cesis_sorter,
.cesis_filter_style_7 .cesis_sorter,
.cesis_filter_style_4 .cesis_filter > li a,
.cesis_filter_style_5 .cesis_filter > li a,
.cesis_filter_style_6 .cesis_filter > li a,
.cesis_filter_style_7 .cesis_filter > li a,

.cesis_nav_style_0 span,
.cesis_nav_style_1 span,
.cesis_nav_style_3 span,

.cesis_blog_style_6 .inside_e,
.cesis_blog_style_7 .inside_e,
.cesis_blog_style_8 .inside_e,
.cesis_blog_style_15 .inside_e,

.cesis_portfolio_style_4 .inside_e,
.cesis_portfolio_style_5 .inside_e,
.cesis_portfolio_style_6 .inside_e,
.cesis_portfolio_style_12 .inside_e,
.cesis_portfolio_style_13 .inside_e,
.classic_container_boxed
{ background-color:'.esc_attr($main_area_bg).'; }';

if( cesis_check_woo_status() == true) {
$meta_css .= '.select2-container--default .select2-selection,
.woocommerce-checkout #payment ul.payment_methods,
.cesis_product_thumbnail_container .cesis_add_to_cart a.button,
.cesis_product_thumbnail_container .added_to_cart,
.item_current_status,.woocommerce div.product .woocommerce-tabs .panel
{ background-color:'.esc_attr($main_area_bg).'; }';
}


if( cesis_check_bbp_status() == true) {
$meta_css .= '#bbpress-forums #new-post fieldset.bbp-form,
div.bbp-template-notice, div.indicator-hint,
#bbpress-forums ul.bbp-lead-topic,
#bbpress-forums ul.bbp-topics,
#bbpress-forums ul.bbp-forums,
#bbpress-forums ul.bbp-replies,
#bbpress-forums ul.bbp-search-results,
#bbp-search-form #bbp_search
{ background-color:'.esc_attr($main_area_bg).'; }';
}


if( cesis_check_bp_status() == true) {
$meta_css .= '#buddypress .activity-list .activity-avatar,
div#item-nav,
#buddypress #item-body form#whats-new-form,
#buddypress ul.item-list li,
#buddypress .profile,
body.activity #buddypress #whats-new-form,
#buddypress div.item-list-tabs,
#buddypress table.notifications,
#buddypress table.notifications-settings,
#buddypress table.profile-settings,
#buddypress table.profile-fields,
#buddypress table.wp-profile-fields,
#buddypress table.messages-notices,
#buddypress table.forum,
#buddypress .messages-options-nav,
#buddypress .notifications-options-nav,
body.settings:not(.profile) #settings-form,
#group-settings-form,
#buddypress div#message p, #sitewide-notice p,
#buddypress div.bp-avatar-status p.success,
#buddypress div.bp-cover-image-status p.success,
#buddypress p.warning,
body.profile_page_bp-profile-edit.modal-open #buddypress #TB_ajaxContent p.warning,
body.users_page_bp-profile-edit.modal-open #buddypress #TB_ajaxContent p.warning,
#buddypress div#invite-list
{ background-color:'.esc_attr($main_area_bg).'; }';
}


$meta_css .= '.cesis_blog_style_6 .cesis_blog_gallery_packery span
{ box-shadow: inset 0 0 0 3px '.esc_attr($main_area_bg).'; }';

}

/* border */
if($d_main_area_border !== $main_area_border){
$meta_css .= 'fieldset,.site-main input[type="checkbox"],.site-main input[type="radio"],.site-main select,.site-main input[type="text"],.site-main input[type="email"],.site-main input[type="url"],.site-main input[type="password"],.site-main input[type="search"],.site-main input[type="number"],.site-main input[type="tel"],.site-main input[type="date"],.site-main textarea,

.site-main,.comments-layout-one .comment.depth-1,.comments-layout-one .comment_ctn,.comments-layout-one .comment_option_bar,.comments-layout-one input,.comments-layout-one textarea,.writer_navigation,.comments-layout-three,.comments-layout-three .comments-title,.comments-layout-three .comment_ctn,.comments-layout-three textarea, .comments-layout-three .single_post_author, .comments-layout-three .single_post_email, .comments-layout-three .single_post_url,
.boxes_container article,.boxes_container .author_bio_ctn,.boxes_container .writer_navigation,.boxes_container .entry-header .entry-meta,.writer_container .has_sidebar .author_bio_ctn,.business_container .author_bio_ctn,.business_navigation,.business_container article,.agency_navigation,.comments-layout-six .comment_ctn,.comments-layout-six,.comments-layout-six input,.comments-layout-six textarea,

.cesis_container:not(.business_container) .entry-footer .sp_categories_ctn a,
.cesis_container:not(.business_container) .entry-footer .sp_tags_ctn a,

.cesis_tabs.horizontal.cesis_tab_1 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_1 .tabs > li:first-child,
.cesis_tabs.horizontal.cesis_tab_2 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_2 .tabs > li:first-child,
.cesis_tabs.horizontal.cesis_tab_3 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_3 .tabs > li:first-child,
.cesis_tabs.horizontal.cesis_tab_5 .tabs > li,
.cesis_tabs.horizontal.cesis_tab_5 .tabs > li:first-child,
.cesis_tabs.horizontal .tabs-container,
.cesis_tabs.horizontal.cesis_tab_4 .tabs,
.tab-holder.cesis_tabs.vertical.cesis_tab_1 .tabs-container,
.tab-holder.cesis_tabs.vertical.cesis_tab_1 .tabs,
.cesis_acc_3 .panel-title,
.cesis_acc_4 .panel-title,
.cesis_acc_5 .panel-title,
.cesis_acc_5.cesis_accordion .plus-minus-toggle,
.cesis_partners_ctn.cesis_partners_2 .owl-item,
.cesis_partners_2 .cesis_partners_col_ctn div,
.cesis_partners_2 .cesis_iso_item,
.cesis_blog_style_1 .cesis_blog_m_top_info .cesis_blog_m_author,
.cesis_blog_style_1 .inside_e,
.cesis_blog_style_3 .cesis_blog_m_top_info,
.cesis_blog_style_4 .cesis_blog_m_top_info,
.cesis_blog_style_6 .inside_e,
.cesis_blog_style_6 .cesis_blog_m_bottom_info,
.cesis_blog_style_7 .cesis_blog_m_content,
.cesis_blog_style_8 .cesis_blog_m_content,
.cesis_blog_style_15 .cesis_blog_m_content,
.cesis_sorter ul,
.cesis_filter_style_3 .cesis_filter,
.cesis_filter_style_4 .cesis_filter > li a,
.cesis_filter_style_4 .cesis_sorter,
.cesis_filter_style_5 .cesis_filter > li a,
.cesis_filter_style_5 .cesis_sorter,
.cesis_filter_style_6 .cesis_filter > li a,
.cesis_filter_style_6 .cesis_sorter,
.cesis_filter_style_7 .cesis_filter > li a,
.cesis_filter_style_7 .cesis_sorter,

.cesis_navigation_ctn.cesis_nav_style_0 span,
.cesis_navigation_ctn.cesis_nav_style_1 span,

.cesis_career_style_2 .cesis_career_m_content,


.cesis_portfolio_style_1 .cesis_portfolio_m_bottom_info,
.cesis_portfolio_style_4 .inside_e,
.cesis_portfolio_style_4 .cesis_portfolio_m_bottom_info,
.cesis_portfolio_style_5 .cesis_portfolio_m_content,
.cesis_portfolio_style_6 .cesis_portfolio_m_content,
.cesis_portfolio_style_12 .inside_e,
.cesis_portfolio_style_13 .inside_e,

.cesis_staff_ctn:not(.cesis_staff_style_5):not(.cesis_staff_style_6):not(.cesis_staff_style_7) .cesis_staff_m_info,
.cesis_staff_style_3 .cesis_staff_m_content,.cesis_staff_style_4 .cesis_staff_m_content,

.boxes_container .entry-footer,
.agency_container .entry-footer,

.cesis_share_ctn.cesis_share_transparent span a,
.cesis_career_style_2 .cesis_career_m_content,
.cesis_search_style_2 .inside_e,
.comments-layout-eight .comment_ctn,
.classic_container .author_bio_ctn,
.classic_navigation,
.classic_container .entry-content,
.classic_navigation a:not(.main_posts_page_icon),
.comments-layout-eight textarea,
.comments-layout-eight .single_post_author input,
.comments-layout-eight .single_post_email input,
.comments-layout-eight .single_post_url input,
.classic_container_boxed
{ border-color:'.esc_attr($main_area_border).'; }';


if( cesis_check_woo_status() == true) {
$meta_css .= '.woocommerce .quantity .qty,
.woocommerce div.product .woocommerce-tabs ul.tabs::before,
section.related.products,
section.upsells.products,
.woocommerce table.shop_table td,
.woocommerce-cart table.cart td.actions .coupon .input-text,
.select2-container--default .select2-selection,
.woocommerce-checkout #payment ul.payment_methods,
.woocommerce-checkout #payment div.form-row,
.woocommerce table.shop_table.woocommerce-checkout-review-order-table,
.woocommerce table.shop_table tbody th, .woocommerce table.shop_table tfoot td,
.woocommerce table.shop_table tfoot th,
.woocommerce form.checkout_coupon, .woocommerce form.login, .woocommerce form.register,
.woocommerce table.shop_table.order_details,.woocommerce table.shop_table.customer_details,
.woocommerce-page .woocommerce ul.order_details li,
.woocommerce-page.woocommerce-account .woocommerce-MyAccount-navigation ul,
.woocommerce-account .woocommerce-MyAccount-navigation ul li,
.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,
.site-main .widget_product_categories li a,
.site-main .woocommerce ul.product_list_widget li.mini_cart_item,
.site-main ul.product_list_widget li.mini_cart_item,
.product_meta
{ border-color:'.esc_attr($main_area_border).'; }';
}

if( cesis_check_bbp_status() == true) {
$meta_css .= '#bbpress-forums fieldset.bbp-form,
#bbpress-forums li.bbp-body ul.forum,
#bbpress-forums li.bbp-body ul.topic,
#bbpress-forums ul.bbp-lead-topic,
#bbpress-forums ul.bbp-topics,
#bbpress-forums ul.bbp-forums,
#bbpress-forums ul.bbp-replies,
#bbpress-forums ul.bbp-search-results,
div.bbp-forum-header,
div.bbp-topic-header,
div.bbp-reply-header
{ border-color:'.esc_attr($main_area_border).'; }';
}


if( cesis_check_bp_status() == true) {
$meta_css .= '#buddypress div.activity-comments ul li,
#buddypress div.activity-comments ul,
.bp-avatar-nav ul,
.bp-avatar-nav ul.avatar-nav-items li.current,
#drag-drop-area,
#buddypress form fieldset,
div#item-nav,
#buddypress #item-body form#whats-new-form,
#buddypress ul.item-list li,
#buddypress div.activity-comments form .ac-textarea,
#buddypress .activity-meta,
#buddypress .profile,
body.activity #buddypress #whats-new-form,
#buddypress div.item-list-tabs,
#buddypress table.notifications,
#buddypress table.notifications-settings,
#buddypress table.profile-settings,
#buddypress table.profile-fields,
#buddypress table.wp-profile-fields,
#buddypress table.messages-notices,
#buddypress table.forum,
div.item-list-tabs#subnav ul li.last,
div.item-list-tabs#subnav  div.message-search form,
#buddypress .messages-options-nav,
#buddypress .notifications-options-nav,
#buddypress table.profile-settings,
body.settings:not(.profile) #settings-form,
#group-settings-form,
#buddypress div#invite-list
{ border-color:'.esc_attr($main_area_border).'; }';
}



$meta_css .= '.comments-layout-one .comment_ctn:after{ background:'.esc_attr($main_area_border).'; }';


$meta_css .= '.cesis_tabs.horizontal.cesis_tab_2 .tabs > li.active,
.cesis_tabs.horizontal.cesis_tab_3 .tabs > li.active

{ border-bottom-color:'.esc_attr($main_area_bg).'!important; }';


$meta_css .= '.cesis_tabs.vertical.cesis_tab_1.cesis_tab_left .tabs > li:after

{ background-image: -webkit-linear-gradient(left, transparent, '.esc_attr($main_area_border).');
    background-image: -moz-linear-gradient(left, transparent, '.esc_attr($main_area_border).');
    background-image: -o-linear-gradient(left, transparent, '.esc_attr($main_area_border).');

}';

$meta_css .= '.cesis_tabs.vertical.cesis_tab_1.cesis_tab_right .tabs > li:after

{ background-image: -webkit-linear-gradient(right, transparent, '.esc_attr($main_area_border).');
    background-image: -moz-linear-gradient(right, transparent, '.esc_attr($main_area_border).');
    background-image: -o-linear-gradient(right, transparent, '.esc_attr($main_area_border).');

}';


}


/* heading */
if($d_main_area_heading !== $main_area_heading){

$meta_css .= 'h1,h2,h3,h4,h5,h6,h1 a,h2 a,h3 a,h4 a,h5 a,h6 a,legend,.comments-layout-one .author,.comments-layout-one .author a,.writer_navigation a:hover,.comments-layout-three .author a,.comments-layout-three .comment-navigation .nav-previous a,.comments-layout-three .comment-navigation .nav-next a,.agency_navigation a,.agency_container .author_bio_ctn .author_posts_link,.comments-layout-six .author a,.comments-layout-seven .author a,.comments-layout-seven .comment_buttons a,
.cesis_tabs.horizontal.cesis_tab_1 .tabs > li a,
.cesis_tabs.horizontal.cesis_tab_3 .tabs > li:hover:not(.active) a,
.cesis_tabs.horizontal.cesis_tab_5 .tabs > li a,
.cesis_tabs.vertical.cesis_tab_2 .tabs > li.active a,

.cesis_acc_1 .panel-title.active a,
.cesis_acc_2 .panel-title.active a,
.cesis_acc_3 .panel-title a,
.cesis_acc_4 .panel-title a,
.cesis_acc_5 .panel-title a,
.cesis_m_more_link a:not(.cesis_btn):not(.cesis_alt_btn):not(.cesis_sub_btn),

.cesis_nav_style_2 span,
.cesis_nav_style_3 span,

.cesis_share_box.simple span a,
.cesis_share_ctn.cesis_share_transparent span a,
.comments-layout-eight .author,.comments-layout-eight .author a,
.classic_navigation a,
.site-main .comments-layout-eight textarea,
.site-main .comments-layout-eight .single_post_author,
.site-main .comments-layout-eight .single_post_email,
.site-main .comments-layout-eight .single_post_url,
.comments-layout-eight label
{ color:'.esc_attr($main_area_heading).'; }';

if( cesis_check_woo_status() == true) {
$meta_css .= '.woocommerce .woocommerce-product-rating .star-rating,
.woocommerce div.product form.cart .reset_variations,
.meta_container .meta_label,
.woocommerce #reviews #comments ol.commentlist li .comment-text .woocommerce-review__author,
.woocommerce div.product form.cart .variations label,
.woocommerce table.shop_attributes th,
.woocommerce div.product form.cart .group_table td.label a,
.woocommerce-thankyou-order-received,
.woocommerce-checkout .woocommerce-form-login a,
.woocommerce-lost-password .lost_reset_password p:first-child,
.woocommerce-account .woocommerce-MyAccount-navigation ul li a,
.woocommerce-account .woocommerce-MyAccount-content a,
p.woocommerce-LostPassword.lost_password a,
.cesis_product_thumbnail_container .cesis_add_to_cart a.button,
.cesis_product_thumbnail_container .added_to_cart,
.item_current_status,
.woocommerce-error a.button,
.woocommerce-info a.button,
.woocommerce-message a.button
{ color:'.esc_attr($main_area_heading).'; }';

}

if( cesis_check_bbp_status() == true) {
$meta_css .= '#cesis_main a.bbp-forum-title,
#cesis_main #bbpress-forums li.bbp-header ul,
#cesis_main a.bbp-topic-permalink,
#cesis_main .bbp-template-notice a.bbp-author-name,
#cesis_main #bbpress-forums div.bbp-reply-author a.bbp-author-name,
#cesis_main #bbpress-forums #bbp-single-user-details #bbp-user-navigation a,
#cesis_main .bbp-topic-title-meta a,
#cesis_main #bbpress-forums div.bbp-topic-author a.bbp-author-name,
#cesis_main #bbpress-forums div.bbp-reply-author a.bbp-author-name
{ color:'.esc_attr($main_area_heading).'; }';
}


if( cesis_check_bp_status() == true) {
$meta_css .= '#buddypress a:not(.button):not(.add):not(.remove):not(.requested):not(.group-button),
#buddypress .standard-form label, #buddypress .standard-form span.label,
div#item-nav div.item-list-tabs ul li.selected a,
div#item-nav div.item-list-tabs ul li.current a,
#item-nav div.item-list-tabs ul li a:hover,
#buddypress div.activity-meta a:hover,
#buddypress .activity-comments .acomment-options a:hover
{ color:'.esc_attr($main_area_heading).'; }';

}


$meta_css .= '.cesis_acc_1 .panel-title.active .plus-minus-toggle:after,.cesis_acc_1 .panel-title.active .plus-minus-toggle:before,
.cesis_acc_2 .panel-title.active .plus-minus-toggle:after,.cesis_acc_2 .panel-title.active .plus-minus-toggle:before


{ background:'.esc_attr($main_area_heading).'; }';
}

/* text color */
if($d_main_area_color !== $main_area_color){

$meta_css .= 'body,
.site-main input[type="checkbox"],.site-main input[type="radio"],.site-main select,.site-main input[type="text"],
.site-main input[type="email"],.site-main input[type="url"],.site-main input[type="password"],.site-main input[type="search"],
.site-main input[type="number"],.site-main input[type="tel"],.site-main input[type="date"],.site-main textarea,
.writer_navigation a,.comments-layout-three .comment_buttons span,.comments-layout-three .comment_buttons a,
.comments-layout-three .to_comment_button,.boxes_container .author_bio_ctn .author_posts_link,
.boxes_container .entry-meta .single_post_title_author a,.boxes_container .entry-meta .single_post_title_comment a,
.writer_container .author_bio_ctn .author_posts_link,.comments-layout-one input, .comments-layout-one textarea,
.comments-layout-seven .date a,.comments-layout-seven .comment_ctn,.cesis_tabs.horizontal.cesis_tab_3 .tabs > li a,
.cesis_tabs.horizontal.cesis_tab_4 .tabs > li:hover:not(.active) a,.cesis_tabs.vertical.cesis_tab_2 .tabs > li:hover:not(.active) a,
.cesis_filter li a,.cesis_nav_style_4 .cesis_nav_active.cesis_nav_number:after,.cesis_nav_style_4 .cesis_nav_number:hover::after,
.cesis_staff_sp_info .cesis_staff_social a,
.cesis_nav_number a,
.cesis_nav_prev a,
.cesis_nav_next a,
.cesis_share_ctn.cesis_share_grey span a,
.cesis_link_ctn a,
.sp_info_ctn a
{ color:'.esc_attr($main_area_color).'; }';


if( cesis_check_woo_status() == true) {
$meta_css .= '.meta_container a,.woocommerce p.stars.selected a,
.woocommerce table.shop_table td,
.woocommerce table.shop_table td a,
table.shop_table span.woocommerce-Price-amount.amount,
.select2-container--default .select2-selection--single .select2-selection__rendered,
.woocommerce-error a, .woocommerce-info a, .woocommerce-message a,
.about_paypal,
.products span.woocommerce-Price-amount.amount,
.woocommerce div.product span.price del,
.woocommerce .products li.product span.price,
.woocommerce-product-search label:after,
.woocommerce a.remove:after
{ color:'.esc_attr($main_area_color).'; }';
}

if( cesis_check_bbp_status() == true) {
$meta_css .= 'li.bbp-forum-freshness a,
li.bbp-topic-freshness a,
div.bbp-breadcrumb a,
.bbp-template-notice a,
#subscription-toggle a,
#bbpress-forums div.bbp-topic-content a,
#bbpress-forums div.bbp-reply-content a,
.bbp-pagination-links a
{ color:'.esc_attr($main_area_color).'; }';
}


if( cesis_check_bp_status() == true) {
$meta_css .= '#item-nav div.item-list-tabs ul li a,
#buddypress .activity-comments .acomment-options a
{ color:'.esc_attr($main_area_color).'; }';
}


$meta_css .= '.site-main textarea::-webkit-input-placeholder,.site-main input::-webkit-input-placeholder

{ color:'.esc_attr($main_area_color).'; }';

$meta_css .= '.main_posts_page_icon:before,.main_posts_page_icon:after


{ background:'.esc_attr($main_area_color).'; }';
}




/* light text color */
if($d_main_area_light_color !== $main_area_light_color){

$meta_css .= '.cesis_not_found_sub,.comments-layout-one .date a,.comments-layout-three .date a,.comments-layout-one a.comments-link,.comments-layout-one #reply-title,.agency_container .author_bio_ctn h4,.comments-layout-three textarea, .comments-layout-three .single_post_author, .comments-layout-three .single_post_email, .comments-layout-three .single_post_url,.comments-layout-six .date a,.comments-layout-six input,.comments-layout-six textarea,
.cesis_tabs.horizontal.cesis_tab_2 .tabs > li a,.cesis_tabs.horizontal.cesis_tab_4 .tabs > li a,.cesis_tabs.vertical.cesis_tab_2 .tabs > li a,
.cesis_blog_m_bt_info,
.cesis_blog_m_bt_info a,
.cesis_blog_m_top_info,
.cesis_blog_m_top_info a,
.cesis_blog_m_bottom_info,
.cesis_blog_m_bottom_info a,
.cesis_portfolio_m_top_info,
.cesis_portfolio_m_top_info a,
.cesis_portfolio_m_bottom_info,
.cesis_portfolio_m_bottom_info a,

.cesis_container:not(.business_container) .entry-footer .sp_categories_ctn a,
.cesis_container:not(.business_container) .entry-footer .sp_tags_ctn a,

.cesis_staff_ctn .cesis_staff_m_content .cesis_staff_social a,

.cesis_staff_sp_info .cesis_staff_sp_position,

.agency_container .share_ctn h3,
.cesis_search_result_type,
.comments-layout-eight .date a,
.comments-layout-eight .comment_buttons .reply a,
.comments-layout-eight .comment_buttons .edit a,
.cesis_portfolio_m_bt_info a
{ color:'.esc_attr($main_area_light_color).'; }';

if( cesis_check_woo_status() == true) {
$meta_css .= '.cesis_widget span.woocommerce-Price-amount.amount
{ color:'.esc_attr($main_area_light_color).'; }';
}


if( cesis_check_bbp_status() == true) {
$meta_css .= '.bbp-pagination-links span.current
{ color:'.esc_attr($main_area_light_color).'; }';
}

if( cesis_check_bp_status() == true) {
$meta_css .= '#buddypress a.activity-time-since,
#buddypress .time-since,
#buddypress div.activity-meta a,
#buddypress .activity-comments .acomment-options a
{ color:'.esc_attr($main_area_light_color).'; }';
}



$meta_css .= '.comments-layout-six input::-webkit-input-placeholder,.comments-layout-six textarea::-webkit-input-placeholder

{ color:'.esc_attr($main_area_light_color).'; }';


$meta_css .= '.cesis_acc_3 .panel-title .plus-minus-toggle:after,.cesis_acc_3 .panel-title .plus-minus-toggle:before,
.cesis_acc_4 .panel-title .plus-minus-toggle:after,.cesis_acc_4 .panel-title .plus-minus-toggle:before,
.cesis_acc_5 .panel-title .plus-minus-toggle:after,.cesis_acc_5 .panel-title .plus-minus-toggle:before

{ background:'.esc_attr($main_area_light_color).'; }';
}

/* accent color one */
if($d_main_area_one_acolor !== $main_area_one_acolor){
$meta_css .= 'a,.site-main input[type="checkbox"]:checked:before,.comments-layout-one .author a:hover,.comments-layout-one .date a:hover,.sidebar_layout_one .widget_archive li:before, .sidebar_layout_one .widget_meta li:before, .sidebar_layout_one .widget_categories li:before, .sidebar_layout_one .widget_pages li a:before, .sidebar_layout_one .widget_recent_comments li:before, .sidebar_layout_one .widget_recent_entries li:before,.boxes_container .entry-meta .single_post_title_author a:hover,.boxes_container .entry-meta .single_post_title_comment a:hover,
.comments-layout-three .comment-navigation .nav-previous a:hover,.comments-layout-three .comment-navigation .nav-next a:hover,.comments-layout-two .author a:hover,.comments-layout-three .comment_buttons span:hover,.comments-layout-three .comment_buttons span:hover a,.comments-layout-three .author a:hover,.comments-layout-six .author a:hover,.comments-layout-six .date a:hover,.comments-layout-six .comment_buttons,.comments-layout-six .comment_buttons a,.careers_container .author_bio_ctn .author-info h3 a:hover,.comments-layout-seven .author a:hover,.comments-layout-seven .comment_buttons a:hover,.comments-layout-seven .date a:hover,.lifestyle_container .author_bio_ctn .author-info h3 a:hover,
.cesis_tabs.horizontal.cesis_tab_2 .tabs > li.active a,
.cesis_tabs.horizontal.cesis_tab_3 .tabs > li.active a,
.cesis_tabs.horizontal.cesis_tab_4 .tabs > li.active a,
.cesis_acc_3 .panel-title.active a,
.cesis_acc_4 .panel-title.active a,
.cesis_acc_5 .panel-title.active a,
.cesis_blog_m_title a:hover,
.cesis_blog_m_bt_info a:hover,
.cesis_blog_m_top_info a:hover,
.cesis_blog_m_bottom_info a:hover,
.cesis_portfolio_m_title a:hover,
.cesis_portfolio_m_top_info a:hover,
.cesis_portfolio_m_bottom_info a:hover,
.cesis_m_more_link a:not(.cesis_btn):not(.cesis_alt_btn):not(.cesis_sub_btn):hover,
.cesis_filter_style_1 .cesis_filter li.selected a,.cesis_filter_style_1 .cesis_filter li a:hover,
.cesis_filter_style_1 .cesis_sorter li:hover,.cesis_filter_style_1 .sort_selected,
.cesis_filter_style_2 .cesis_filter li.selected a,.cesis_filter_style_2 .cesis_filter li a:hover,
.cesis_filter_style_2 .cesis_sorter li:hover,.cesis_filter_style_2 .sort_selected,
.cesis_filter_style_3 .cesis_filter li.selected a,.cesis_filter_style_3 .cesis_filter li a:hover,
.cesis_filter_style_3 .cesis_sorter li:hover,.cesis_filter_style_3 .sort_selected,
.cesis_filter_style_4 .cesis_filter li a:hover,
.cesis_filter_style_4 .cesis_sorter li:hover,
.cesis_filter_style_5 .cesis_filter li a:hover,
.cesis_filter_style_5 .cesis_sorter li:hover,
.cesis_filter_style_6 .cesis_filter li a:hover,
.cesis_filter_style_6 .cesis_sorter li:hover,
.cesis_filter_style_7 .cesis_filter li a:hover,
.cesis_filter_style_7 .cesis_sorter li:hover,

.cesis_nav_style_4 span:hover,.cesis_nav_style_4 span.cesis_nav_active,
.cesis_nav_style_4 .current,.cesis_nav_style_4 span:hover a,


.cesis_staff_sp_info .cesis_staff_social a:hover,
.cesis_share_ctn.cesis_share_grey.cesis_share_io span a:hover,
.cesis_share_ctn.cesis_share_transparent.cesis_share_io span a:hover,
.comments-layout-eight .date a:hover,
.comments-layout-eight .comment_buttons .reply a:hover,
.comments-layout-eight .comment_buttons .edit a:hover,
.comments-layout-eight .author:hover,
.comments-layout-eight .author a:hover,
.classic_container .author_bio_ctn .author-info a:hover,
.sp_info_ctn a:hover,
.classic_navigation .main_posts_page_icon:hover
{ color:'.esc_attr($main_area_one_acolor).'; }';


$meta_css .= '.tg-cesis-coffee-products .tg-element-3.tg-item-rating .star-rating span:before
{ color:'.esc_attr($main_area_one_acolor).'; }';

if( cesis_check_woo_status() == true) {
$meta_css .= '.woocommerce div.product p.price, .woocommerce div.product span.price,
.meta_container a:hover,
.woocommerce div.product form.cart .reset_variations:hover,
.woocommerce div.product form.cart .group_table td.label a:hover,
span.woocommerce-Price-amount.amount,
.woocommerce table.shop_table td a:hover,
.woocommerce-account .woocommerce-MyAccount-navigation ul li a:hover,
.woocommerce-account .woocommerce-MyAccount-content a:hover,
p.woocommerce-LostPassword.lost_password a:hover,
.site-main .woocommerce a.remove:hover:after
{ color:'.esc_attr($main_area_one_acolor).'; }';
}


if( cesis_check_bbp_status() == true) {
$meta_css .= 'a.bbp-forum-title:hover,
li.bbp-forum-freshness a:hover,
a.bbp-topic-permalink:hover,
li.bbp-topic-freshness a:hover,
div.bbp-breadcrumb a:hover,
.bbp-template-notice a:hover,
#subscription-toggle a:hover,
#bbpress-forums div.bbp-reply-author a.bbp-author-name:hover,
#bbpress-forums div.bbp-topic-content a:hover,
#bbpress-forums div.bbp-reply-content a:hover,
.bbp-pagination-links a:hover,
.bbp-template-notice a.bbp-author-name:hover,
#bbpress-forums #bbp-single-user-details #bbp-user-navigation a:hover,
#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a,
.bbp-topic-title-meta a:hover,
#bbpress-forums div.bbp-topic-author a.bbp-author-name:hover,
#bbpress-forums div.bbp-reply-author a.bbp-author-name:hover
{ color:'.esc_attr($main_area_one_acolor).'; }';
}

if( cesis_check_bp_status() == true) {
$meta_css .= '#buddypress a:not(.button):not(.add):not(.remove):not(.requested):not(.group-button):hover
{ color:'.esc_attr($main_area_one_acolor).'; }';
}



$meta_css .= '.site-main input[type=radio]:checked:before,.comments-layout-three .comments-title span:before,.writer_container .author_bio_ctn .author-info h3:after,.boxes_container .author_bio_ctn .author-info h3:after,.agency_container .author_bio_ctn .author-info h3:after,.comments-layout-seven .author:after,.lifestyle_container .author_bio_ctn .author-info h3:after,
.cesis_tabs.horizontal.cesis_tab_1 .tabs > li.active,
.cesis_tabs.horizontal.cesis_tab_2 .tabs > li.active:before,
.cesis_tabs.horizontal.cesis_tab_5 .tabs > li.active,
.cesis_tabs.cesis_tab_4 .tab_moving_line,
.cesis_tabs.vertical.cesis_tab_2 .tabs > li a:after,
.cesis_acc_3 .panel-title.active .plus-minus-toggle:after,.cesis_acc_3 .panel-title.active .plus-minus-toggle:before,
.cesis_acc_4 .panel-title.active .plus-minus-toggle:after,.cesis_acc_4 .panel-title.active .plus-minus-toggle:before,
.cesis_acc_5 .panel-title.active .plus-minus-toggle:after,.cesis_acc_5 .panel-title.active .plus-minus-toggle:before,
.cesis_audio_ctn .mejs-controls .mejs-time-rail .mejs-time-handle,
.cesis_container .mejs-controls .mejs-time-rail .mejs-time-current,
.cesis_container .mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
.filter_moving_line,
.cesis_filter_style_4 .cesis_filter > li.selected a,
.cesis_filter_style_4 .sort_selected,
.cesis_filter_style_5 .cesis_filter > li.selected a,
.cesis_filter_style_5 .sort_selected,
.cesis_filter_style_6 .cesis_filter > li.selected a,
.cesis_filter_style_6 .sort_selected,
.cesis_filter_style_7 .cesis_filter > li.selected a,
.cesis_filter_style_7 .sort_selected,
.cesis_nav_style_0 > span:hover,.cesis_nav_style_0 .cesis_nav_numbers > span:hover,.cesis_nav_style_0 span.cesis_nav_active,.cesis_nav_style_0 .cesis_nav_number .current,
.cesis_nav_style_1 > span:hover,.cesis_nav_style_1 .cesis_nav_numbers > span:hover,.cesis_nav_style_1 span.cesis_nav_active,.cesis_nav_style_1 .cesis_nav_number .current,
.cesis_nav_style_2 > span:hover,.cesis_nav_style_2 .cesis_nav_numbers > span:hover,.cesis_nav_style_2 span.cesis_nav_active,.cesis_nav_style_2 .cesis_nav_number .current,
.cesis_nav_style_3 > span:hover,.cesis_nav_style_3 .cesis_nav_numbers > span:hover,.cesis_nav_style_3 span.cesis_nav_active,.cesis_nav_style_3 .cesis_nav_number .current,

.cesis_share_box.grey span a:hover,
.cesis_share_ctn.cesis_share_grey:not(.cesis_share_io) span a:hover,
.cesis_share_ctn.cesis_share_transparent:not(.cesis_share_io) span a:hover,
.cesis_quote_icon,
.cesis_link_icon,
.cesis_container:not(.business_container) .entry-footer .sp_categories_ctn a:hover,
.cesis_container:not(.business_container) .entry-footer .sp_tags_ctn a:hover,
.classic_navigation a:not(.main_posts_page_icon):hover
{ background:'.esc_attr($main_area_one_acolor).'; }';


if( cesis_check_woo_status() == true) {
$meta_css .= '.wc-tabs .tab_moving_line,
.article_ctn span.onsale,
.woocommerce li.product span.onsale,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range
{ background:'.esc_attr($main_area_one_acolor).'; }';
}

if( cesis_check_bp_status() == true) {
$meta_css .= 'div.item-list-tabs ul li a span,
#buddypress a.bp-primary-action span,
#buddypress #reply-title small a span
{ background:'.esc_attr($main_area_one_acolor).'; }';
}



$meta_css .= '::selection{ background:'.esc_attr($main_area_one_acolor).'; color:white; }';


$meta_css .= 'input[type="text"]:focus, input[type="email"]:focus, input[type="url"]:focus,
input[type="password"]:focus, input[type="search"]:focus, input[type="number"]:focus,
input[type="tel"]:focus,input[type="date"]:focus, textarea:focus,
.cesis_filter_style_4 .cesis_filter > li.selected a,
.cesis_filter_style_5 .cesis_filter > li.selected a,
.cesis_filter_style_6 .cesis_filter > li.selected a,
.cesis_filter_style_7 .cesis_filter > li.selected a,

.cesis_nav_style_1 > span:hover,.cesis_nav_style_1 .cesis_nav_numbers > span:hover,.cesis_nav_style_1 span.cesis_nav_active,
.cesis_nav_style_2 > span:hover,.cesis_nav_style_2 .cesis_nav_numbers > span:hover,.cesis_nav_style_2 span.cesis_nav_active,
.cesis_nav_style_3 > span:hover,.cesis_nav_style_3 .cesis_nav_numbers > span:hover,.cesis_nav_style_3 span.cesis_nav_active,
blockquote,.cesis_quote_ctn,
.classic_navigation a:not(.main_posts_page_icon):hover
{ border-color:'.esc_attr($main_area_one_acolor).' !important; }';


if( cesis_check_bp_status() == true) {
$meta_css .= 'div#subnav.item-list-tabs ul li.selected a,
div#subnav.item-list-tabs ul li.current a
{ border-color:'.esc_attr($main_area_one_acolor).' !important; }';
}

}



/* accent color two */
if($d_main_area_two_acolor !== $main_area_two_acolor){
$meta_css .= 'a:hover,.comments-layout-six .comment_buttons span:hover,.comments-layout-six .comment_buttons span:hover a
{ color:'.esc_attr($main_area_two_acolor).'; }';

}



/* alternative background */
if($d_main_area_alt_bg !== $main_area_alt_bg){
$meta_css .= '.comments-layout-one .comment_option_bar,.writer_comments_ctn,.agency_comments_ctn,.lifestyle_comments_ctn,

.cesis_acc_1 .panel-title,.cesis_acc_2 .panel-title,


.cesis_nav_style_2 .cesis_nav_prev,.cesis_nav_style_2 .cesis_nav_next,
#cesis_main .quicktags-toolbar,

.cesis_share_box.grey span a,
.cesis_share_ctn.cesis_share_grey:not(.cesis_share_io) span a
{ background:'.esc_attr($main_area_alt_bg).'; }';

if( cesis_check_woo_status() == true) {
$meta_css .= '.woocommerce-checkout #payment div.payment_box,
.woocommerce-checkout #payment div.form-row,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle
{ background:'.esc_attr($main_area_alt_bg).'; }';
}

if( cesis_check_bbp_status() == true) {
$meta_css .= 'div.bbp-forum-header, div.bbp-topic-header, div.bbp-reply-header
{ background:'.esc_attr($main_area_alt_bg).'; }';
if($cesis_data["cesis_bbpress_bg_style"] == 'yes'){
$meta_css .= 'body.bbpress #cesis_main
{ background:'.esc_attr($main_area_alt_bg).'; }';
} }


if( cesis_check_bp_status() == true) {
$meta_css .= '#buddypress table.notifications thead tr, #buddypress table.notifications-settings thead tr,
#buddypress table.profile-settings thead tr, #buddypress table.profile-fields thead tr,
#buddypress table.wp-profile-fields thead tr, #buddypress table.messages-notices thead tr,
#buddypress table.forum thead tr
{ background:'.esc_attr($main_area_alt_bg).'; }';
if($cesis_data["cesis_buddypress_bg_style"] == 'yes'){
$meta_css .= 'body.buddypress #cesis_main
{ background:'.esc_attr($main_area_alt_bg).'; }';
} }


if( cesis_check_woo_status() == true) {
$meta_css .= '.woocommerce-page .cart-collaterals .cart_totals,
#add_payment_method #payment div.payment_box:before, .woocommerce-cart #payment div.payment_box:before, .woocommerce-checkout #payment div.payment_box:before,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle
{ border-color:'.esc_attr($main_area_alt_bg).'; }';
}

}


/* alternative border */
if($d_main_area_alt_border !== $main_area_alt_border){
$meta_css .= '.comments-layout-two .comment_ctn,.comments-layout-two textarea,.comments-layout-two .single_post_author, .comments-layout-two .single_post_email, .comments-layout-two .single_post_url,.comments-layout-four .comment_ctn,.comments-layout-four textarea,

.cesis_acc_1 .panel-title,
.cesis_acc_1 .panel-collapse,
.cesis_acc_2 .panel-title,

.cesis_nav_style_2 .cesis_nav_prev,.cesis_nav_style_2 .cesis_nav_next,

#cesis_main .quicktags-toolbar,


.cesis_share_box.grey span a,
.cesis_share_ctn.cesis_share_grey:not(.cesis_share_io) span a


 { border-color:'.esc_attr($main_area_alt_border).'; }';

}




/* alternative heading */
if($d_main_area_alt_heading !== $main_area_alt_heading){
$meta_css .= '.comments-layout-two .author a,.comments-layout-two .to_comment_button:hover,.comments-layout-two .comment-navigation a:hover,.comments-layout-two .logged-in-as a,.writer_comments_ctn .comments-title a, .writer_comments_ctn #reply-title,.comments-layout-four .author a,.comments-layout-four .comment_buttons a,.comments-layout-four .comment-navigation a,.comments-layout-four .logged-in-as a,.agency_comments_ctn .comments-title a, .agency_comments_ctn #reply-title,.comments-layout-seven .comments-title a, .comments-layout-seven #reply-title
{ color:'.esc_attr($main_area_alt_heading).'; }';
}




/* alternative text */
if($d_main_area_alt_color !== $main_area_alt_color){
$meta_css .= '.writer_comments_ctn,.agency_comments_ctn,.lifestyle_comments_ctn,.comments-layout-seven input,.comments-layout-seven textarea,

.cesis_share_box.grey span a,
.cesis_share_ctn.cesis_share_grey:not(.cesis_share_io) span a
{ color:'.esc_attr($main_area_alt_color).'; }';

if( cesis_check_woo_status() == true) {
$meta_css .= '.woocommerce-checkout #payment div.payment_box
{ color:'.esc_attr($main_area_alt_color).'; }';
}

if( cesis_check_bbp_status() == true) {
$meta_css .= 'div.bbp-forum-header, div.bbp-topic-header, div.bbp-reply-header,
span.bbp-admin-links a,
.bbp-forum-header a.bbp-forum-permalink, .bbp-topic-header a.bbp-topic-permalink, .bbp-reply-header a.bbp-reply-permalink
{ color:'.esc_attr($main_area_alt_color).'; }';
}

}






/* alternative light text color */
if($d_main_area_alt_light_color !== $main_area_alt_light_color){
$meta_css .= '.comments-layout-one .comment_option_bar a,.comments-layout-two .comment-navigation a,.comments-layout-one .comment_option_bar .reply:before,.comments-layout-one .comment_buttons .edit:before,.comments-layout-two .date a,.comments-layout-two .comment_buttons .reply a,.comments-layout-two .comment_buttons .edit a,.comments-layout-two .comment_buttons .edit:before,.comments-layout-two .comment_buttons .reply:before,.comments-layout-two .to_comment_button,.comments-layout-four .date a,.comments-layout-two textarea,.comments-layout-two .single_post_author, .comments-layout-two .single_post_email, .comments-layout-two .single_post_url,.comments-layout-four .single_post_author, .comments-layout-four .single_post_email, .comments-layout-four .single_post_url,.comments-layout-four textarea,.comments-layout-seven .logged-in-as a,

.cesis_acc_1 .panel-title a,
.cesis_acc_2 .panel-title a

{ color:'.esc_attr($main_area_alt_light_color).'; }';


$meta_css .= '.comments-layout-two textarea::-webkit-input-placeholder,.comments-layout-two input::-webkit-input-placeholder,
.comments-layout-four textarea::-webkit-input-placeholder,.comments-layout-four input::-webkit-input-placeholder,
.comments-layout-seven input::-webkit-input-placeholder,.comments-layout-seven textarea::-webkit-input-placeholder

{ color:'.esc_attr($main_area_alt_light_color).'; }';


$meta_css .= '.cesis_acc_1 .panel-title .plus-minus-toggle:after,.cesis_acc_1 .panel-title .plus-minus-toggle:before,
.cesis_acc_2 .panel-title .plus-minus-toggle:after,.cesis_acc_2 .panel-title .plus-minus-toggle:before

{ background:'.esc_attr($main_area_alt_light_color).'; }';

}

/* alternative accent color */
if($d_main_area_alt_one_acolor !== $main_area_alt_one_acolor){
$meta_css .= '.comments-layout-one .comment_option_bar .reply:hover a,.comments-layout-one .comment_option_bar .reply:hover::before,
.comments-layout-one .comment_option_bar .edit:hover a,.comments-layout-one .comment_option_bar .edit:hover::before,
.comments-layout-two .comment_buttons .reply:hover a,.comments-layout-two .comment_buttons .reply:hover::before,
.comments-layout-two .comment_buttons .edit:hover a,.comments-layout-two .comment_buttons .edit:hover::before,
.comments-layout-two .author a:hover,.comments-layout-two .logged-in-as a:hover,
.comments-layout-four .author a:hover,.comments-layout-four .logged-in-as a:hover,.comments-layout-four .comment_buttons a:hover,.comments-layout-four .comment-navigation a:hover,.comments-layout-seven .logged-in-as a:hover
{ color:'.esc_attr($main_area_alt_one_acolor).'; }';

$meta_css .= '.comments-layout-two .comments-title span:before,.comments-layout-four .date:after
{ background:'.esc_attr($main_area_alt_one_acolor).'; }';
}

}


$custom_buttons = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_main_custom_button');

if($custom_buttons == 'yes'){


$main_button_shadow = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_button_shadow');
$main_button_text = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_button_text');
$main_button_bg_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_button_background');
if(isset($main_button_bg_array['rgba'])){
$main_button_bg = $main_button_bg_array["rgba"];
}
$main_button_border_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_button_border');
if(isset($main_button_bg_array['rgba'])){
$main_button_border = $main_button_border_array["rgba"];
}
$main_button_hover_text = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_button_hover_text');
$main_button_hover_bg_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_button_hover_background');
if(isset($main_button_bg_array['rgba'])){
$main_button_hover_bg = $main_button_hover_bg_array["rgba"];
}
$main_button_hover_border_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_button_hover_border');
if(isset($main_button_bg_array['rgba'])){
$main_button_hover_border = $main_button_hover_border_array["rgba"];
}

$main_alt_button_shadow = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_alt_button_shadow');
$main_alt_button_text = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_alt_button_text');
$main_alt_button_bg_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_alt_button_background');
if(isset($main_button_bg_array['rgba'])){
$main_alt_button_bg = $main_alt_button_bg_array["rgba"];
}
$main_alt_button_border_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_alt_button_border');
if(isset($main_button_bg_array['rgba'])){
$main_alt_button_border = $main_alt_button_border_array["rgba"];
}
$main_alt_button_hover_text = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_alt_button_hover_text');
$main_alt_button_hover_bg_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_alt_button_hover_background');
if(isset($main_button_bg_array['rgba'])){
$main_alt_button_hover_bg = $main_alt_button_hover_bg_array["rgba"];
}
$main_alt_button_hover_border_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_alt_button_hover_border');
if(isset($main_button_bg_array['rgba'])){
$main_alt_button_hover_border = $main_alt_button_hover_border_array["rgba"];
}

$main_sub_button_shadow = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_sub_button_shadow');
$main_sub_button_text = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_sub_button_text');
$main_sub_button_bg_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_sub_button_background');
if(isset($main_button_bg_array['rgba'])){
$main_sub_button_bg = $main_sub_button_bg_array["rgba"];
}
$main_sub_button_border = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_sub_button_border');
if(isset($main_button_bg_array['rgba'])){
$main_sub_button_border = $main_sub_button_border_array["rgba"];
}
$main_sub_button_hover_text = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_sub_button_hover_text');
$main_sub_button_hover_bg_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_sub_button_hover_background');
if(isset($main_button_bg_array['rgba'])){
$main_sub_button_hover_bg = $main_sub_button_hover_bg_array["rgba"];
}
$main_sub_button_hover_border_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_main_content_sub_button_hover_border');
if(isset($main_button_bg_array['rgba'])){
$main_sub_button_hover_border = $main_sub_button_hover_border_array["rgba"];
}




/* buttons settings */

$meta_css .= '.comments-layout-one input[type="submit"].cesis_btn,.cesis_btn,.comments-layout-three input[type="submit"].cesis_btn,
.boxes_container .category_ctn a,.comments-layout-six input[type="submit"].cesis_btn,.comments-layout-seven input[type="submit"].cesis_btn,
.comments-layout-seven .comment-navigation .nav-previous a, .comments-layout-seven .comment-navigation .nav-next a,.lifestyle_container .to_comments_button,
.cesis_cf7_btn input[type="submit"]
{color:'.esc_attr($main_button_text).'; background:'.esc_attr($main_button_bg).'; border-color:'.esc_attr($main_button_border).';   }';

 if( cesis_check_woo_status() == true) {
$meta_css .= '.woocommerce button.button.alt,
.woocommerce #review_form #respond .form-submit input,
.woocommerce-cart .wc-proceed-to-checkout a.checkout-button,
.woocommerce #payment #place_order, .woocommerce-page #payment #place_order,
.site-main .woocommerce.widget_shopping_cart .buttons a:last-child,
.cesis_cart_icon a.button
{color:'.esc_attr($main_button_text).'; background:'.esc_attr($main_button_bg).'; border-color:'.esc_attr($main_button_border).'; }';
 }


 if( cesis_check_bbp_status() == true) {
$meta_css .= '.bbp-submit-wrapper button,
#bbpress-forums #bbp-your-profile fieldset.submit button
{color:'.esc_attr($main_button_text).'; background:'.esc_attr($main_button_bg).'; border-color:'.esc_attr($main_button_border).';   }';
 }

 if( cesis_check_bp_status() == true) {
$meta_css .= '.generic-button .friendship-button.add,
 .standard-form button,
 #buddypress a.button:not(.acomment-reply):not(.view):not(.fav):not(.delete-activity):not(.unfav):not(.delete-activity-single),
 input[type=submit],
 input[type=button],
 input[type=reset],
 #buddypress ul.button-nav li a,
 .generic-button a,
 #buddypress .comment-reply-link,
a.bp-title-button
{color:'.esc_attr($main_button_text).'; background:'.esc_attr($main_button_bg).'; border-color:'.esc_attr($main_button_border).';    }';
 }



$meta_css .= '.comments-layout-one input[type="submit"].cesis_btn:hover,.cesis_btn:hover,.comments-layout-three input[type="submit"].cesis_btn:hover,
.boxes_container .category_ctn a:hover,.comments-layout-six input[type="submit"].cesis_btn:hover,.comments-layout-seven input[type="submit"].cesis_btn:hover,
.comments-layout-seven .comment-navigation .nav-previous a:hover, .comments-layout-seven .comment-navigation .nav-next a:hover,.lifestyle_container .to_comments_button:hover,
.cesis_cf7_btn input[type="submit"]:hover
{ color:'.esc_attr($main_button_hover_text).'; background:'.esc_attr($main_button_hover_bg).'; border-color:'.esc_attr($main_button_hover_border).';}';

 if( cesis_check_woo_status() == true) {
$meta_css .= '.woocommerce button.button.alt:hover,
.woocommerce #review_form #respond .form-submit input:hover,
.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover,
.woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover,
.site-main .woocommerce.widget_shopping_cart .buttons a:last-child:hover,
.cesis_cart_icon .buttons a.button:last-child:hover
{ color:'.esc_attr($main_button_hover_text).'; background:'.esc_attr($main_button_hover_bg).'; border-color:'.esc_attr($main_button_hover_border).';}';
 }

 if( cesis_check_bbp_status() == true) {
$meta_css .= '.bbp-submit-wrapper button:hover,
#bbpress-forums #bbp-your-profile fieldset.submit button:hover
{ color:'.esc_attr($main_button_hover_text).'; background:'.esc_attr($main_button_hover_bg).'; border-color:'.esc_attr($main_button_hover_border).';}';
 }


 if( cesis_check_bp_status() == true) {
$meta_css .= '.generic-button .friendship-button.add:hover,
 .standard-form button:hover,
 #buddypress a.button:hover,
 #buddypress a.button:focus,
 input[type=submit]:hover,
 input[type=button]:hover,
 input[type=reset]:hover,
 #buddypress ul.button-nav li a:hover,
 #buddypress  ul.button-nav li.current a,
 div.generic-button a:hover,
 #buddypress .comment-reply-link:hover
 { color:'.esc_attr($main_button_hover_text).'; background:'.esc_attr($main_button_hover_bg).'; border-color:'.esc_attr($main_button_hover_border).';}';
 }



 if ($main_button_shadow == "yes" ) {
$meta_css .= '.cesis_btn {
	-webkit-box-shadow: 0 0 20px rgba(46,47,57,.25);
	-moz-box-shadow: 0 0 20px rgba(46,47,57,.25);
	box-shadow: 0 0 20px rgba(46,47,57,.25);
}';
 }

$meta_css .= '.cesis_alt_btn,.comments-layout-one .comment-navigation .nav-previous a,.comments-layout-one .comment-navigation .nav-next a,
.business_navigation .nav-previous a,.business_navigation .nav-next a,.comments-layout-six .comment-navigation .nav-previous a,
.comments-layout-six .comment-navigation .nav-next a,.careers_navigation a,
.cesis_cf7_alt_btn input[type="submit"]
{color:'.esc_attr($main_alt_button_text).'; background:'.esc_attr($main_alt_button_bg).'; border-color:'.esc_attr($main_alt_button_border).'; }';

 if( cesis_check_woo_status() == true) {
$meta_css .= '.woocommerce input.button,
.woocommerce .cart .button, .woocommerce .cart input.button,
section.shipping-calculator-form button.button,
p.return-to-shop .wc-backward,
.woocommerce form.checkout_coupon input.button,
.woocommerce-checkout .woocommerce-form-login input[type="submit"],
.woocommerce-lost-password .woocommerce form .form-row input[type="submit"],
.woocommerce .woocommerce-MyAccount-content table.my_account_orders .button,
.woocommerce .woocommerce-MyAccount-content input.button,
.woocommerce .order-again .button,
.woocommerce .widget_price_filter .price_slider_amount .button,
.site-main .woocommerce.widget_shopping_cart .buttons a:first-child
{color:'.esc_attr($main_alt_button_text).'; background:'.esc_attr($main_alt_button_bg).'; border-color:'.esc_attr($main_alt_button_border).';}';
 }


 if( cesis_check_bp_status() == true) {
$meta_css .= '.generic-button .friendship-button.remove,
#profile-edit-form.standard-form button,
.generic-button .leave-group
{color:'.esc_attr($main_alt_button_text).'; background:'.esc_attr($main_alt_button_bg).'; border-color:'.esc_attr($main_alt_button_border).'; }';
 }


$meta_css .= '.cesis_alt_btn[class*="tg-"]
{color:'.esc_attr($main_alt_button_text).' !important; background:'.esc_attr($main_alt_button_bg).' !important; border-color:'.esc_attr($main_alt_button_border).' !important; }';

$meta_css .= '.cesis_alt_btn:hover,.comments-layout-one .comment-navigation .nav-previous a:hover,.comments-layout-one .comment-navigation .nav-next a:hover,.business_navigation .nav-previous a:hover,.business_navigation .nav-next a:hover,
.comments-layout-two input[type="submit"].cesis_sub_btn:hover,.comments-layout-six .comment-navigation .nav-previous a:hover, .comments-layout-six .comment-navigation .nav-next a:hover,.careers_navigation a:hover,
.cesis_cf7_alt_btn input[type="submit"]:hover
{ color:'.esc_attr($main_alt_button_hover_text).'; background:'.esc_attr($main_alt_button_hover_bg).'; border-color: '.esc_attr($main_alt_button_hover_border).';}';

$meta_css .= '.cesis_alt_btn[class*="tg-"]:hover
{ color:'.esc_attr($main_alt_button_hover_text).'; background:'.esc_attr($main_alt_button_hover_bg).'; border-color: '.esc_attr($main_alt_button_hover_border).';}';

 if( cesis_check_woo_status() == true) {
$meta_css .= '.woocommerce input.button:hover,.woocommerce .cart .button:hover
, .woocommerce .cart input.button:hover,
section.shipping-calculator-form button.button:hover,
p.return-to-shop .wc-backward:hover,
.woocommerce form.checkout_coupon input.button:hover,
.woocommerce-checkout .woocommerce-form-login input[type="submit"]:hover,
.woocommerce-lost-password .woocommerce form .form-row input[type="submit"]:hover,
.woocommerce .woocommerce-MyAccount-content table.my_account_orders .button:hover,
.woocommerce .woocommerce-MyAccount-content input.button:hover,
.woocommerce .order-again .button:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.site-main .woocommerce.widget_shopping_cart .buttons a:first-child:hover
{ color:'.esc_attr($main_alt_button_hover_text).'; background:'.esc_attr($main_alt_button_hover_bg).'; border-color: '.esc_attr($main_alt_button_hover_border).';}';
 }


 if( cesis_check_bp_status() == true) {
$meta_css .= '.generic-button .friendship-button.remove:hover,
#profile-edit-form.standard-form button:hover,
.generic-button .leave-group:hover
{ color:'.esc_attr($main_alt_button_hover_text).'; background:'.esc_attr($main_alt_button_hover_bg).'; border-color: '.esc_attr($main_alt_button_hover_border).';}';
 }


 if ($main_alt_button_shadow == "yes" ) {
$meta_css .= '.cesis_alt_btn {
	-webkit-box-shadow: 0 0 20px rgba(46,47,57,.25);
	-moz-box-shadow: 0 0 20px rgba(46,47,57,.25);
	box-shadow: 0 0 20px rgba(46,47,57,.25);
}';
 }


$meta_css .= '.cesis_sub_btn,.comments-layout-two input[type="submit"].cesis_sub_btn,.comments-layout-four input[type="submit"].cesis_sub_btn,
.cesis_cf7_sub_btn input[type="submit"]
{color:'.esc_attr($main_sub_button_text).'; background:'.esc_attr($main_sub_button_bg).'; border-color:'.esc_attr($main_sub_button_border).'; }';

$meta_css .= '.cesis_sub_btn:hover,.comments-layout-two input[type="submit"].cesis_sub_btn:hover,.comments-layout-four input[type="submit"].cesis_sub_btn:hover,
.cesis_cf7_sub_btn input[type="submit"]:hover
{ color:'.esc_attr($main_sub_button_hover_text).'; background:'.esc_attr($main_sub_button_hover_bg).'; border-color:'.esc_attr($main_sub_button_hover_border).';}';


 if ($main_sub_button_shadow == "yes" ) {
$meta_css .= '.cesis_sub_btn,.comments-layout-two .cesis_sub_btn,.comments-layout-four .cesis_sub_btn{
	-webkit-box-shadow: 0 0 20px rgba(46,47,57,.25);
	-moz-box-shadow: 0 0 20px rgba(46,47,57,.25);
	box-shadow: 0 0 20px rgba(46,47,57,.25);
}';
 }

}


//////////////////////////////////////////////////////////////////
////                                                         ////
///               SIDEBAR SETTINGS START                    ////
//                                                         ////
//////////////////////////////////////////////////////////////


$custom_sidebar = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_custom_sidebar");

$d_sidebar_width = $cesis_data["cesis_sidebar_size"];

$sidebar_width = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_sidebar_size");
$content_width = 100 - (int)redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_sidebar_size");

$d_sidebar_space = (int)$cesis_data["cesis_sidebar_space"] / 2;
$sidebar_space = (int)redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_sidebar_space") / 2;



$d_sidebar_bottom_padding = $cesis_data["cesis_sidebar_bottom_padding"]["height"];
$d_sidebar_heading_space = $cesis_data["cesis_sidebar_heading_space"]["height"];

$meta_sidebar_bottom_padding = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_sidebar_bottom_padding");
if(isset($meta_sidebar_bottom_padding)&& $meta_sidebar_bottom_padding!==""){
$sidebar_bottom_padding = $meta_sidebar_bottom_padding["height"];
}
$meta_sidebar_heading_space = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_sidebar_heading_space");
if(isset($meta_sidebar_heading_space)&& $meta_sidebar_heading_space!==""){
$sidebar_heading_space = $meta_sidebar_heading_space["height"];
}



$d_sidebar_expand_background = $cesis_data["cesis_sidebar_expand_bg_color"];
$sidebar_expand_background = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_sidebar_expand_bg_color");

$d_sidebar_heading_font = $cesis_data["cesis_sidebar_widget_font"]['font-family'];
$d_sidebar_heading_font_size = $cesis_data["cesis_sidebar_widget_font"]['font-size'];
$d_sidebar_heading_font_weight = $cesis_data["cesis_sidebar_widget_font"]['font-weight'];
$d_sidebar_heading_font_ls = $cesis_data["cesis_sidebar_widget_font"]['letter-spacing'];
$d_sidebar_heading_font_tt = $cesis_data["cesis_sidebar_widget_font"]['text-transform'];


$meta_sidebar_widget_font = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_sidebar_widget_font");
if(isset($meta_sidebar_widget_font)&& $meta_sidebar_widget_font!==""){
$sidebar_heading_font = $meta_sidebar_widget_font['font-family'];
$sidebar_heading_font_size = $meta_sidebar_widget_font['font-size'];
$sidebar_heading_font_weight = $meta_sidebar_widget_font['font-weight'];
$sidebar_heading_font_ls = $meta_sidebar_widget_font['letter-spacing'];
$sidebar_heading_font_tt = $meta_sidebar_widget_font['text-transform'];
}

$d_sidebar_heading = $cesis_data["cesis_sidebar_heading_color"];
$d_sidebar_text = $cesis_data["cesis_sidebar_text_color"];

$sidebar_heading = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_sidebar_heading_color");
$sidebar_text = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_sidebar_text_color");

$d_sidebar_background = $cesis_data["cesis_sidebar_bg_color"];

$sidebar_background = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_sidebar_bg_color");



if($custom_sidebar == "yes" ){

if($d_sidebar_width !== $sidebar_width || $d_sidebar_space !== $sidebar_space ){

$meta_css .= ".sidebar_ctn { width:calc( ".esc_attr($sidebar_width)."% - ".esc_attr($sidebar_space)."px ); }";

$meta_css .= ".article_ctn.has_sidebar { width:calc( ".esc_attr($content_width)."% - ".esc_attr($sidebar_space)."px ); }";

}


if($d_sidebar_expand_background !== $sidebar_expand_background ){

$meta_css .= ".sidebar_expanded:after{  background:".esc_attr($sidebar_expand_background)."; }";

}

if($d_sidebar_space !== $sidebar_space ){

$meta_css .= ".sidebar_expanded.r_sidebar:after{  left:-".esc_attr($sidebar_space)."px; }
.sidebar_expanded.l_sidebar:after{  right:-".esc_attr($sidebar_space)."px; }";

}



if($d_sidebar_text !== $sidebar_text ){

$meta_css .= "aside.main-sidebar section,.wpb_widgetised_column section,
.sidebar_layout_two section a,.sidebar_layout_three section a { color: ".esc_attr($sidebar_text)."}";

}


if($d_sidebar_heading !== $sidebar_heading ){

$meta_css .= "aside.main-sidebar h1,.wpb_widgetised_column h1,aside.main-sidebar h2,.wpb_widgetised_column h2,
aside.main-sidebar h3,.wpb_widgetised_column h3,aside.main-sidebar h4,.wpb_widgetised_column h4,aside.main-sidebar h5,
.wpb_widgetised_column h5,aside.main-sidebar h6,.wpb_widgetised_column h6 { color: ".esc_attr($sidebar_heading)."}";

}

if($d_sidebar_background !== $sidebar_background ){

$meta_css .= ".sidebar_layout_two section{  background:".esc_attr($sidebar_background)."; }";

}

if($d_sidebar_bottom_padding !== $sidebar_bottom_padding ){

$meta_css .= "aside.main-sidebar section,.wpb_widgetised_column section{ margin-bottom:".esc_attr($sidebar_bottom_padding)."; }";

}


if($d_sidebar_heading_font !== $sidebar_heading_font || $d_sidebar_heading_font_size !== $sidebar_heading_font_size || $d_sidebar_heading_font_ls !== $sidebar_heading_font_ls || $d_sidebar_heading_font_tt !== $sidebar_heading_font_tt || $d_sidebar_heading_space !== $sidebar_heading_space  ){

$meta_css .= "aside.main-sidebar section > h2,.wpb_widgetised_column section > h2{ font-family:".esc_attr($sidebar_heading_font)."; font-size:".esc_attr($sidebar_heading_font_size)."; letter-spacing:".esc_attr($sidebar_heading_font_ls)."; text-transform:".esc_attr($sidebar_heading_font_tt)."; margin-bottom:".esc_attr($sidebar_heading_space)."; }";

}



}

/* Sidebar settings End */



//////////////////////////////////////////////////////////////////
////                                                         ////
///                  PAGE SETTINGS START                    ////
//                                                         ////
//////////////////////////////////////////////////////////////

if(is_page()){

$custom_page = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_page_custom_layout" );

$d_page_area_top_padding = $cesis_data["cesis_page_content_top_padding"]["height"];
$d_page_area_bottom_padding = $cesis_data["cesis_page_content_bottom_padding"]["height"];



$meta_page_content_width = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_page_content_width" );
$page_content_width_units = $meta_page_content_width["units"];
if($page_content_width_units !== '%'){
$page_area_width = ((int)$meta_page_content_width["width"] + 80).$page_content_width_units;
}else{
$page_area_width = $meta_page_content_width["width"];
}




$meta_page_content_top_padding = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_page_content_top_padding" );
$page_area_top_padding = $meta_page_content_top_padding["height"];

$meta_page_content_bottom_padding = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_page_content_bottom_padding" );
$page_area_bottom_padding = $meta_page_content_bottom_padding["height"];

if($custom_page == 'yes'){
	$meta_css .= ".page .site-main .cesis_container,.page .cesis_top_banner .cesis_container { max-width:".esc_attr($page_area_width)."; }";

	if($d_page_area_top_padding !== $page_area_top_padding || $d_page_area_bottom_padding !== $page_area_bottom_padding ){
		$meta_css .= ".page .article_ctn,.page .sidebar_ctn { padding-top:".esc_attr($page_area_top_padding)."; padding-bottom:".esc_attr($page_area_bottom_padding)."; }";
	}
}

}

/* Page settings End */



//////////////////////////////////////////////////////////////////
////                                                         ////
///             SINGLE BLOG POST SETTINGS START             ////
//                                                         ////
//////////////////////////////////////////////////////////////


if(is_single() && get_post_type() == 'post'){

$custom_blog_page = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_blog_custom_layout" );

$d_blog_area_top_padding = $cesis_data["cesis_blog_content_top_padding"]["height"];
$d_blog_area_bottom_padding = $cesis_data["cesis_blog_content_bottom_padding"]["height"];

$bcw = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_blog_content_width" );
$blog_content_width_units = $bcw["units"];
$bctp = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_blog_content_top_padding" );
$blog_area_top_padding = $bctp["height"];
$bcbp = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_blog_content_bottom_padding" );
$blog_area_bottom_padding = $bcbp["height"];

if($blog_content_width_units !== '%'){
$blog_area_width = ((int)$bcw["width"] + 80).$blog_content_width_units;
}else{
$blog_area_width = $bcw["width"];
}

$d_blog_gallery_space = $cesis_data["cesis_blog_gallery_space"];
$blog_gallery_space = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_blog_gallery_space" );

if($custom_blog_page == 'yes'){

/* width settings */
$meta_css .= '.single-post .site-main .cesis_container,.single-post .cesis_top_banner .cesis_container { max-width:'.esc_attr($blog_area_width).'; }';


if($d_blog_area_top_padding !== $blog_area_top_padding || $d_blog_area_bottom_padding !== $blog_area_bottom_padding ){
	/* top and bottom padding settings */
	$meta_css .= '.single-post .article_ctn,.single-post .sidebar_ctn { padding-top:'.esc_attr($blog_area_top_padding).'; padding-bottom:'.esc_attr($blog_area_bottom_padding).'; }';
}

if($d_blog_gallery_space !== $blog_gallery_space ){
/* stacked gallery */
	$meta_css .= '.single-post .cesis_blog_gallery_stacked .cesis_gallery_img img { margin-bottom:'.esc_attr($blog_gallery_space).'px;}';
}
}
/* Single blog post settings End */

}


//////////////////////////////////////////////////////////////////
////                                                         ////
///        SINGLE PORTFOLIO POST SETTINGS START             ////
//                                                         ////
//////////////////////////////////////////////////////////////


if(is_single() && get_post_type() == 'portfolio'){

$custom_portfolio_page = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_portfolio_custom_layout" );
$pcw = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_portfolio_content_width' );
$portfolio_content_width_units = $pcw["units"];
if($portfolio_content_width_units !== '%'){
$portfolio_area_width = ((int)$pcw["width"] + 80).$portfolio_content_width_units;
}else{
$portfolio_area_width = $pcw["width"];
}

$d_portfolio_area_top_padding = $cesis_data["cesis_portfolio_content_top_padding"]["height"];
$d_portfolio_area_bottom_padding = $cesis_data["cesis_portfolio_content_bottom_padding"]["height"];
$d_portfolio_gallery_space = $cesis_data["cesis_portfolio_gallery_space"];


$pctp = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_portfolio_content_top_padding" );
$portfolio_area_top_padding = $pctp["height"];
$pcbp = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_portfolio_content_bottom_padding" );
$portfolio_area_bottom_padding = $pcbp["height"];
$portfolio_gallery_space = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_portfolio_gallery_space" );


if($custom_portfolio_page == 'yes'){

/* width settings */
$meta_css .= '.single-portfolio .site-main .cesis_container,.single-portfolio .cesis_top_banner .cesis_container { max-width:'.esc_attr($portfolio_area_width).'; }';

if($d_portfolio_area_top_padding !== $portfolio_area_top_padding || $d_portfolio_area_bottom_padding !== $portfolio_area_bottom_padding ){
/* top and bottom padding settings */
$meta_css .= '.single-portfolio .article_ctn,.single-portfolio .sidebar_ctn
{ padding-top:'.esc_attr($portfolio_area_top_padding).'; padding-bottom:'.esc_attr($portfolio_area_bottom_padding).'; }';
}

if($d_portfolio_gallery_space !== $portfolio_gallery_space  ){
	/* stacked gallery */
	$meta_css .= '.single-portfolio .cesis_portfolio_gallery_stacked .cesis_gallery_img img { margin-bottom:'.esc_attr($portfolio_gallery_space).'px;}';
}

}


}


//////////////////////////////////////////////////////////////////
////                                                         ////
///            SINGLE STAFF POST SETTINGS START             ////
//                                                         ////
//////////////////////////////////////////////////////////////

if(is_single() && get_post_type() == 'staff'){

$custom_staff_page = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_staff_custom_layout" );
  $scw = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_staff_content_width' );
  $staff_content_width_units = $scw["units"];
  if($staff_content_width_units !== '%'){
  $staff_area_width = ((int)$scw["width"] + 80).$staff_content_width_units;
  }else{
  $staff_area_width = $scw["width"];
  }

  $d_staff_area_top_padding = $cesis_data["cesis_staff_content_top_padding"]["height"];
  $d_staff_area_bottom_padding = $cesis_data["cesis_staff_content_bottom_padding"]["height"];


  $sctp = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_staff_content_top_padding" );
  $staff_area_top_padding = $sctp["height"];

  $scbp = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_staff_content_bottom_padding" );
  $staff_area_bottom_padding = $scbp["height"];


if($custom_staff_page == 'yes'){
  /* width settings */
  $meta_css .= '.single-staff .site-main .cesis_container,.single-staff .cesis_top_banner .cesis_container{ max-width:'.esc_attr($staff_area_width).'; }';


  if($d_staff_area_top_padding !== $staff_area_top_padding || $d_staff_area_bottom_padding !== $staff_area_bottom_padding ){
  /* top and bottom padding settings */
  $meta_css .= '.single-staff .article_ctn,.single-staff .sidebar_ctn { padding-top:'.esc_attr($staff_area_top_padding).'; padding-bottom:'.esc_attr($staff_area_bottom_padding).'; }';
  }
}




}

//////////////////////////////////////////////////////////////////
////                                                         ////
///            SINGLE CAREER POST SETTINGS START            ////
//                                                         ////
//////////////////////////////////////////////////////////////

if(is_single() && get_post_type() == 'careers'){

$custom_career_page = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_career_custom_layout" );
  $ccw = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_career_content_width' );
  $career_content_width_units = $ccw["units"];
  if($career_content_width_units !== '%'){
  $career_area_width = ((int)$ccw["width"] + 80).$career_content_width_units;
  }else{
  $career_area_width = $ccw["width"];
  }

  $d_career_area_top_padding = $cesis_data["cesis_career_content_top_padding"]["height"];
  $d_career_area_bottom_padding = $cesis_data["cesis_career_content_bottom_padding"]["height"];


  $cctp = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_career_content_top_padding" );
  $career_area_top_padding = $cctp["height"];

  $ccbp = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_meta_career_content_bottom_padding" );
  $career_area_bottom_padding = $ccbp["height"];


if($custom_career_page == 'yes'){
  /* width settings */
  $meta_css .= '.single-careers .site-main .cesis_container,.single-careers .cesis_top_banner .cesis_container  { max-width:'.esc_attr($career_area_width).'; }';


  if($d_career_area_top_padding !== $career_area_top_padding || $d_career_area_bottom_padding !== $career_area_bottom_padding ){
  /* top and bottom padding settings */
  $meta_css .= '.single-careers .article_ctn,.single-careers .sidebar_ctn { padding-top:'.esc_attr($career_area_top_padding).'; padding-bottom:'.esc_attr($career_area_bottom_padding).'; }';
  }

}



}


//////////////////////////////////////////////////////////////////
////                                                         ////
///                   FOOTER SETTINGS START                 ////
//                                                         ////
//////////////////////////////////////////////////////////////


$custom_footer = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_footer');

if($custom_footer == 'yes'){

$d_footer_main_width_units = $cesis_data["cesis_footer_width"]["units"];

if($d_footer_main_width_units !== '%'){
$d_footer_main_width = ((int)$cesis_data["cesis_footer_width"]["width"] + 80).$d_footer_main_width_units;
}else{
$d_footer_main_width = $cesis_data["cesis_footer_width"]["width"];
}

$d_footer_top_padding = $cesis_data["cesis_footer_top_padding"]["height"];
$d_footer_bottom_padding = $cesis_data["cesis_footer_bottom_padding"]["height"];
$d_footer_widget_padding = $cesis_data["cesis_footer_widget_padding"]["height"];
$d_footer_heading_space = $cesis_data["cesis_footer_heading_space"]["height"];
$d_footer_main_bg = $cesis_data["cesis_footer_bg_color"];
$d_footer_main_border = $cesis_data["cesis_footer_border_color"];
$d_footer_main_heading = $cesis_data["cesis_footer_heading_color"];
$d_footer_main_color = $cesis_data["cesis_footer_text_color"];
$d_footer_main_acolor = $cesis_data["cesis_footer_hl_color"];
$d_footer_main_hover_color = $cesis_data["cesis_footer_hover_color"];

$d_footer_heading_font = $cesis_data["cesis_footer_widget_font"]['font-family'];
$d_footer_heading_font_size = $cesis_data["cesis_footer_widget_font"]['font-size'];
$d_footer_heading_font_weight = $cesis_data["cesis_footer_widget_font"]['font-weight'];
$d_footer_heading_font_ls = $cesis_data["cesis_footer_widget_font"]['letter-spacing'];
$d_footer_heading_font_tt = $cesis_data["cesis_footer_widget_font"]['text-transform'];

$footer_main_width = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_width');
$footer_main_width_units = $footer_main_width["units"];

if($footer_main_width_units !== '%'){
$footer_main_width = ((int)$footer_main_width["width"] + 80).$footer_main_width_units;
}else{
$footer_main_width = $footer_main_width["width"];
}

$footer_top_padding_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_top_padding');
$footer_top_padding = $footer_top_padding_array["height"];
$footer_bottom_padding_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_bottom_padding');
$footer_bottom_padding = $footer_bottom_padding_array["height"];
$footer_widget_padding_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_widget_padding');
$footer_widget_padding = $footer_widget_padding_array["height"];
$footer_heading_space_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_heading_space');
$footer_heading_space = $footer_heading_space_array["height"];
$footer_main_bg = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_bg_color');
$footer_main_border = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_border_color');
$footer_main_heading = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_heading_color');
$footer_main_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_text_color');
$footer_main_acolor = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_hl_color');
$footer_main_hover_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_hover_color');


$footer_heading = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_widget_font');

$footer_heading_font = $footer_heading['font-family'];
$footer_heading_font_size = $footer_heading['font-size'];
$footer_heading_font_weight = $footer_heading['font-weight'];
$footer_heading_font_ls = $footer_heading['letter-spacing'];
$footer_heading_font_tt = $footer_heading['text-transform'];

/*--------
  MAIN
-------*/


/* container settings */
$meta_css .= '.footer_main .cesis_container { max-width:'.esc_attr($footer_main_width).'; padding-top:'.esc_attr($footer_top_padding).'; padding-bottom:'.esc_attr($footer_top_padding).'; }';

/* Footer main settings */
$meta_css .= '.footer_main,
.footer_main input[type="checkbox"],.footer_main input[type="radio"],.footer_main select,.footer_main input[type="text"],
.footer_main input[type="email"],.footer_main input[type="url"],.footer_main input[type="password"],.footer_main input[type="search"],.footer_main input[type="tel"],.footer_main input[type="date"]
,.footer_main textarea,.footer_main select,.footer_main #bbp-search-form #bbp_search
{ background-color:'.esc_attr($footer_main_bg).'; color:'.esc_attr($footer_main_color).';}';


if( $d_footer_main_color !== $footer_main_color) {
$meta_css .= '.footer_main .product_list_widget span.woocommerce-Price-amount.amount,
.footer_main .woocommerce.widget_shopping_cart .total .amount
 { color:'.esc_attr($footer_main_color).';}';
}

/* heading */
if( $d_footer_main_heading !== $footer_main_heading) {
$meta_css .= '.footer_main h1,.footer_main h2,.footer_main h3,.footer_main h4,.footer_main h5,.footer_main h6,.footer_main h1 a,.footer_main h2 a,.footer_main h3 a,.footer_main h4 a,.footer_main h5 a,.footer_main h6 a,
.footer_main .widget_search .cesis_search_widget input[type="search"],
.footer_main .cesis_search_widget label:after
{ color:'.esc_attr($footer_main_heading).'; }';

$meta_css .= '.footer_main input::-webkit-input-placeholder,.footer_main textarea::-webkit-input-placeholder
{ color:'.esc_attr($footer_main_heading).'; }';

if( cesis_check_woo_status() == true) {
$meta_css .= '.footer_main .woocommerce ul.product_list_widget li .star-rating, .footer_main .woocommerce ul.product_list_widget li .star-rating:before,
.footer_main .woocommerce-product-search label:after,
.footer_main .woocommerce-product-search input[type="search"],
.footer_main .woocommerce.widget_shopping_cart .total,
.footer_main .woocommerce a.remove:after
{ color:'.esc_attr($footer_main_heading).'; }';
}
}

$meta_css .= '.cesis_f_widget_title { font-family:'.esc_attr($footer_heading_font).'; font-size:'.esc_attr($footer_heading_font_size).'; letter-spacing:'.esc_attr($footer_heading_font_ls).'; text-transform:'.esc_attr($footer_heading_font_tt).'; margin-bottom:'.esc_attr($footer_heading_space).'; }';
$meta_css .= '.footer_widget .tagcloud a { font-family:'.esc_attr($footer_heading_font).';}';

/* widget space */
if( $d_footer_widget_padding !== $footer_widget_padding) {
$meta_css .= '.cesis_f_widget { padding-bottom:'.esc_attr($footer_widget_padding).'; }';
}
/* accent color */

if( $d_footer_main_acolor !== $footer_main_acolor) {
$meta_css .= '.footer_main a,.footer_widget .tagcloud a:hover{ color:'.esc_attr($footer_main_acolor).'; }';

if( cesis_check_woo_status() == true) {
$meta_css .= '.footer-main .woocommerce a.remove:hover:after
{ color:'.esc_attr($footer_main_acolor).'; }';
 }

$meta_css .= '.footer-main input[type=radio]:checked:before,.footer_main input[type="checkbox"]:checked:before
{ background:'.esc_attr($footer_main_acolor).'; }';
}
/* hover color */
if( $d_footer_main_hover_color !== $footer_main_hover_color) {
$meta_css .= '.footer_main a:hover,.footer_main h1 a:hover,.footer_main h2 a:hover,.footer_main h3 a:hover,.footer_main h4 a:hover,.footer_main h5 a:hover,.footer_main h6 a:hover{ color:'.esc_attr($footer_main_hover_color).'; }
.footer_widget .tagcloud a:hover{ background:'.esc_attr($footer_main_hover_color).'; }.footer_widget .tagcloud a:hover{ border-color:'.esc_attr($footer_main_hover_color).'; }';
}
/* border color */
if( $d_footer_main_border !== $footer_main_border) {
$meta_css .= '.footer_main input[type="checkbox"],.footer_main input[type="radio"],.footer_main select,.footer_main input[type="text"],.footer_main input[type="email"],.footer_main input[type="url"],.footer_main input[type="password"],.footer_main input[type="search"],.footer_main input[type="tel"],.footer_main textarea,
.footer_widget .widget_meta li,.footer_widget .widget_archive li,.footer_widget .widget_categories li,.footer_widget .widget_pages li a,.footer_widget .widget_recent_comments li,.footer_widget .widget_recent_entries li,
.footer_widget .tagcloud a
{ border-color:'.esc_attr($footer_main_border).'; }';

if( cesis_check_woo_status() == true) {
$meta_css .= '.woocommerce .footer_main  .widget_price_filter .price_slider_wrapper .ui-widget-content,
.footer_main .widget_search .cesis_search_widget input[type="search"],
.footer_main .woocommerce ul.product_list_widget li.mini_cart_item, .footer_main ul.product_list_widget li.mini_cart_item
{ border-color:'.esc_attr($footer_main_border).'; }';
}


if( cesis_check_bbp_status() == true) {
$meta_css .= '.footer_widget .widget_display_forums li a,.footer_widget .widget_display_topics li a,
.footer_widget .widget_display_replies li a,.footer_widget .widget_display_views li a
{ border-color:'.esc_attr($footer_main_border).'; }';
 }
}

}


/*--------
   SUB
-------*/


$custom_footer_bar = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_footer_bar');

if($custom_footer_bar == 'yes'){


$d_footer_sub_width_units = $cesis_data["cesis_footer_bar_width"]["units"];

if($d_footer_sub_width_units !== '%'){
$d_footer_sub_width = ((int)$cesis_data["cesis_footer_bar_width"]["width"] + 80).$d_footer_sub_width_units;
}else{
$d_footer_sub_width = $cesis_data["cesis_footer_bar_width"]["width"];
}

$d_footer_sub_height = $cesis_data["cesis_footer_bar_height"]["height"];
$d_footer_sub_bg = $cesis_data["cesis_footer_bar_bg_color"];
$d_footer_sub_color = $cesis_data["cesis_footer_bar_text_color"];
$d_footer_sub_acolor = $cesis_data["cesis_footer_bar_hl_color"];
$d_footer_sub_hover_color = $cesis_data["cesis_footer_bar_hover_color"];


$footer_sub_width = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_bar_width');
$footer_sub_width_units = $footer_sub_width["units"];

if($footer_sub_width_units !== '%'){
$footer_sub_width = ((int)$footer_sub_width["width"] + 80).$footer_sub_width_units;
}else{
$footer_sub_width = $footer_sub_width["width"];
}

$footer_sub_height_content = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_bar_height');
$footer_sub_height = $footer_sub_height_content["height"];
$footer_sub_bg = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_bar_bg_color');
$footer_sub_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_bar_text_color');
$footer_sub_acolor = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_bar_hl_color');
$footer_sub_hover_color = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_bar_hover_color');


$footer_sub_menu_font_content = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_menu_font');

$footer_sub_menu_font = $footer_sub_menu_font_content['font-family'];
$footer_sub_menu_font_size = $footer_sub_menu_font_content['font-size'];
$footer_sub_menu_font_weight = $footer_sub_menu_font_content['font-weight'];
$footer_sub_menu_font_ls = $footer_sub_menu_font_content['letter-spacing'];
$footer_sub_menu_font_tt = $footer_sub_menu_font_content['text-transform'];

$footer_sub_menu_space = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_menu_space');


$d_footer_sub_font_size = $cesis_data['cesis_footer_text_size'];
$footer_sub_font_size = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_text_size');


/* container settings */

$meta_css .= '.footer_sub .cesis_container { max-width:'.esc_attr($footer_sub_width).';  }';

if( $d_footer_sub_height !== $footer_sub_height) {
$meta_css .= '.footer_sub { min-height:'.esc_attr($footer_sub_height).'; }';
}

/* Footer sub main settings */

$meta_css .= '.footer_sub {  background:'.esc_attr($footer_sub_bg).'; color:'.esc_attr($footer_sub_color).'; }';

/* accent color */

if( $d_footer_sub_acolor !== $footer_sub_acolor) {
$meta_css .= '.footer_sub a{ color:'.esc_attr($footer_sub_acolor).'; }';
}
/* hover color */

if( $d_footer_sub_hover_color !== $footer_sub_hover_color) {
$meta_css .= '.footer_sub a:hover{ color:'.esc_attr($footer_sub_hover_color).'; }';
}
/* footer menu settings */
$meta_css .= '.footer_sub .menu-footer-ct li { font-family:'.esc_attr($footer_sub_menu_font).'; font-size:'.esc_attr($footer_sub_menu_font_size).'; letter-spacing:'.esc_attr($footer_sub_menu_font_ls).'; font-weight:'.esc_attr($footer_sub_menu_font_weight).'; text-transform:'.esc_attr($footer_sub_menu_font_tt).';  padding:0 '.esc_attr($footer_sub_menu_space).'px;}';


if( $d_footer_sub_font_size !== $footer_sub_font_size) {
$meta_css .= '.f_text_one, .f_text_two, .f_text_three{font-size:'.esc_attr($footer_sub_font_size).'px; }';
}

}

}
/* close if archive */

if ($meta_css <> '') {
	$output = "<!-- Custom Styling -->\n<style type=\"text/css\">" . $meta_css . "</style>\n";
	echo !empty( $output ) ? $output : '';
}


}

add_action('wp_head', 'cesis_meta_css');
}
