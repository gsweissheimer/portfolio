<?php

if (!class_exists('WPBakeryShortCode_cesis_icon_paragraph')) {
class WPBakeryShortCode_cesis_icon_paragraph extends WPBakeryShortCode {



protected function content( $atts, $content = null ) {

global $cesis_data;

	extract(shortcode_atts(array(

		/* icon settings */
		'i_choice' => 'icon',
		'icon' => '',
		'image' => '',
		'image_size' => '100',
		'i_size'   => '40',
		'i_use_gradient' => '',
		'use_shape' => '',
		'shape' => 'rounded',
		'position'   => 'i_left',
		'i_hover' => 'none',
		'i_shadow_type' => 'none',
		'i_shadow_hover' => 'always',
		'icon_color' => '',
		'icon_bg_color' => '',
		'icon_alt_bg_color' => '',
		'icon_border_color' => '',
		'h_icon_color' => '',
		'h_icon_bg_color' => '',
		'h_icon_alt_bg_color' => '',
		'h_icon_border_color' => '',
		'i_shadow_color' => '',
		'i_space' => '20',
		'i_bg_size' => '110',
		'i_b_size' => '0',
		'i_radius'   => '100',

		/* heading settings */
		'heading' => 'Great title',
		'heading_space' => '20',
		'heading_color' => '',
		'heading_h_color' => '',
		'heading_f_size' => '14px',
		'heading_l_height' => '24px',
		'heading_f_weight' => '700',
		'heading_t_transform' => 'uppercase',
		'heading_l_spacing' => '0',
		'heading_font' => 'alt_font',
		'heading_google_fonts' => '',

		/* text settings */

		'use_editor' => 'no',
		'text' => 'Cesis is a great theme and this is a great dummy text filler',
		'text_space' => '20',
		'text_color' => '',
		'text_h_color' => '',
		'text_f_size' => '14px',
		'text_l_height' => '24px',
		'text_f_weight' => '400',
		'text_t_transform' => 'none',
		'text_l_spacing' => '0',
		'text_font' => 'main_font',
		'text_google_fonts' => '',

		/* button settings */
		'use_button' => '',
		'button_type' => 'f_button',
		'button_text' => 'button',
		'button_size'   => 'cesis_button_small',
		'button_width'   => '180px',
		'button_height'   => '45px',
		'button_border' => '0',
		'button_radius' => '0',
		'b_use_gradient' => '',
		'b_hover' => 'none',
		'b_shadow_type' => 'none',
		'b_shadow_hover' => 'always',
		'button_text_color' => '',
		'button_bg_color' => '',
		'button_alt_bg_color' => '',
		'button_border_color' => '',
		'h_button_text_color' => '',
		'h_button_bg_color' => '',
		'h_button_alt_bg_color' => '',
		'h_button_border_color' => '',
		'b_shadow_color' => '',
		'button_f_size' => '14px',
		'button_f_weight' => '700',
		'button_t_transform' => 'uppercase',
		'button_l_spacing' => '0',
		'button_font' => 'main_font',
		'button_google_fonts' => '',

		/* general settings */
		'link'   => '',
		'target'   => '_self',
		'css'   => '',
 		'css_animation' => '',
 		'delay' => '0',
    'margin_top' => '0',
    'margin_bottom' => '0',
		'hide_lg' => '',
		'hide_md' => '',
		'hide_sm' => '',
		'el_class' => ''

    ), $atts));



if($use_editor == "yes"){
$text = $content;
}

/* default color settings from theme options */

/* icon */
if($icon_color == '' && $use_shape !== ''){
	$icon_color = "#ffffff";
}elseif ($icon_color == '') {
	$icon_color = $cesis_data["cesis_main_content_accent_one"];
}
if($icon_bg_color == ''){
	$icon_bg_color = $cesis_data["cesis_main_content_accent_one"];
}
if($icon_border_color == ''){
	$icon_border_color = $cesis_data["cesis_main_content_accent_one"];
}
if($h_icon_color == '' && $use_shape !== ''){
	$h_icon_color = "#ffffff";
}elseif($h_icon_color == ''){
	$h_icon_color = $cesis_data["cesis_main_content_accent_two"];
}
if($h_icon_bg_color == ''){
	$h_icon_bg_color = $cesis_data["cesis_main_content_accent_two"];
}
if($h_icon_border_color == ''){
	$h_icon_border_color = $cesis_data["cesis_main_content_accent_two"];
}

/* heading */
if($heading_color == ''){
	$heading_color = $cesis_data["cesis_main_content_heading"];
}
if($heading_h_color == ''){
	$heading_h_color = $cesis_data["cesis_main_content_heading"];
}

/* text */
if($text_color == ''){
	$text_color = $cesis_data["cesis_main_content_color"];
}
if($text_h_color == ''){
	$text_h_color = $cesis_data["cesis_main_content_color"];
}

/* button */
if($button_text_color == '' && $button_type == 'f_button'){
	$button_text_color = "#ffffff";
}elseif($button_text_color == '') {
	$button_text_color = $cesis_data["cesis_main_content_heading"];
}
if($button_bg_color == ''){
	$button_bg_color = $cesis_data["cesis_main_content_accent_one"];
}
if($button_border_color == ''){
	$button_border_color = $cesis_data["cesis_main_content_accent_one"];
}
if($h_button_text_color == '' && $button_type == 'f_button'){
	$h_button_text_color = "#ffffff";
}elseif($h_button_text_color == '') {
	$h_button_text_color = $cesis_data["cesis_main_content_accent_one"];
}
if($h_button_bg_color == ''){
	$h_button_bg_color = $cesis_data["cesis_main_content_accent_two"];
}
if($h_button_border_color == ''){
	$h_button_border_color = $cesis_data["cesis_main_content_accent_two"];
}

ob_start();

$output = $additional_class = $i_additional_class = $i_gradient = $i_leave_shadow = $i_enter_shadow = $i_shadow_style = $i_hover_ctn = $i_margin = $ip_hv_leave_style = $ip_hv_enter_style =
$headind_style = $text_style = $lb_add = $lb_add_class = $lb_add_src =
$b_additional_class = $b_gradient = $b_leave_shadow = $b_enter_shadow = $b_shadow_style = $b_shadow_style_hover = $b_hover_ctn = $btn_content = $button_style = $i_class = '';
$id = RandomString(20);



if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
$msie = true;
}else{
$msie = false;
}

if($target == 'cesis_lightbox'){
	$lb_add = ' data-src="'.$link.'" class="cesis_lightbox_el" ';
	$lb_add_src = ' data-src="'.$link.'" ';
	$lb_add_class = ' cesis_lightbox_el ';
}

$margin = 'padding-top:'.$margin_top.'px; ';
$margin .= 'padding-bottom:'.$margin_bottom.'px; ';

/*--------------------------/
    Icon / Image settings  /
-------------------------*/

/* Space settings */


if($position == 'i_left'){
	$i_margin .= 'margin-right:'.$i_space.'px; ';
}
if($position == 'i_right'){
	$i_margin .= 'margin-left:'.$i_space.'px; ';
}
if($position == 'i_top'){
	$i_margin .= 'margin-bottom:'.$i_space.'px; ';
}

/* Image settings */

if($image !== ''){
		$img_id = preg_replace( '/[^\d]/', '', $image );
		$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => 'full'  ) );
		$img = '<div class="cesis_icon_paragraph_image"  style="'.$i_margin.' width:'.$image_size.'px;">'.$img['thumbnail'].'</div>';
}


if($i_choice == 'icon'){
/* Gradient settings */

if($i_use_gradient !== '' && $icon_alt_bg_color !== ''){
	if($use_shape !== ''){
		$i_gradient .= 'cesis_icon_gradient cesis_use_shape';
	}else{
		$i_gradient .= ' cesis_icon_gradient';
	}
}
if($i_use_gradient !== '' && $h_icon_alt_bg_color !== ''){
	if($use_shape !== ''){
		$i_gradient .= 'cesis_h_icon_gradient cesis_use_shape ';
	}else{
		$i_gradient .= ' cesis_h_icon_gradient';
	}
}


/* Shadow settings */

if($i_shadow_type !== 'none'){
	if($i_shadow_color !== ''){
		if($i_shadow_type == 'dropdown'){
			if($shape == 'diamond'){
				$i_shadow_config = "7px 7px 28px ".$i_shadow_color.", 5px 5px 10px ".$i_shadow_color."";
			}else{
				$i_shadow_config = "0 14px 28px ".$i_shadow_color.", 0 10px 10px ".$i_shadow_color."";
			}
		}elseif($i_shadow_type == 'blur'){
			$i_shadow_config = "0 0 15px ".$i_shadow_color."";
		}elseif($i_shadow_type == 'solid'){
			if($shape == 'diamond'){
				$i_shadow_config = "5px -5px 0 0 ".$i_shadow_color."";
			}else{
				$i_shadow_config = "5px 5px 0 0 ".$i_shadow_color."";
			}
		}
	}else{
		if($i_shadow_type == 'dropdown'){
			if($shape == 'diamond'){
				$i_shadow_config = "7px 7px 28px rgba(0,0,0,0.25), 5px 5px 10px rgba(0,0,0,0.22)";
			}else{
				$i_shadow_config = "0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22)";
			}
		}elseif($i_shadow_type == 'blur'){
			$i_shadow_config = "0 0 15px rgba(0,0,0,0.25)";
		}elseif($i_shadow_type == 'solid'){
			if($shape == 'diamond'){
				$i_shadow_config = "5px -5px 0 0 rgba(0, 0, 0, 0.30)";
			}else{
				$i_shadow_config = "5px 5px 0 0 rgba(0, 0, 0, 0.30)";
			}
		}
	}

	if($icon !== ''){
		$i_enter_shadow = $i_leave_shadow = 'this.getElementsByClassName(\'cesis_icon_shape\')[0].style.boxShadow=\''.$i_shadow_config.'\';';
	}
	if($i_shadow_hover == 'hover'){
		$i_leave_shadow = 'this.getElementsByClassName(\'cesis_icon_shape\')[0].style.boxShadow=\'none\';';
		$i_shadow_style = "box-shadow:none;";
	}elseif($i_shadow_hover == 'off_hover'){
		$i_enter_shadow = 'this.getElementsByClassName(\'cesis_icon_shape\')[0].style.boxShadow=\'none\';';
	}
	if($i_shadow_hover == 'always' || $i_shadow_hover == 'off_hover' ){
				$i_shadow_style = "box-shadow:".$i_shadow_config.";";
	}
}else{
	$i_leave_shadow = $i_enter_shadow = $i_shadow_style = '';
}



/* Style & Hover settings */

$i_style = 'font-size:'.$i_size.'px; ';
$padding = ($i_bg_size-($i_b_size*2)-$i_size)/2;
$hexa_padding = (($i_bg_size/sqrt(3))-$i_size)/2;
$hexa_ba_size = ($i_bg_size/sqrt(12));
$hexa_ba_t_border = $i_bg_size/2;
$hexa_ba_wh = ($i_bg_size/sqrt(2));
$hexa_left_pos = ($i_bg_size/sqrt(46.627))-$i_b_size;
$hexa_b_size = ($i_b_size*sqrt(2));

if($use_shape !== ''){

	if($i_use_gradient !== '' && $icon_alt_bg_color !== ''){
		$i_new_bg = 'linear-gradient('.$icon_bg_color.','.$icon_alt_bg_color.')';
	}else{
		$i_new_bg = $icon_bg_color;
	}
	if($i_use_gradient !== '' && $h_icon_alt_bg_color !== ''){
		$i_new_h_bg = 'linear-gradient('.$h_icon_bg_color.','.$h_icon_alt_bg_color.')';
	}else{
		$i_new_h_bg = $h_icon_bg_color;
	}

	if($icon !== ''){
		$ip_hv_leave_style .= $i_leave_shadow.' this.getElementsByClassName(\'cesis_icon_shape\')[0].style.borderColor=\''.$icon_border_color.'\';
	this.getElementsByClassName(\'cesis_icon_shape\')[0].style.background=\''.$i_new_bg.'\'; this.getElementsByClassName(\'cesis_icon_shape\')[0].style.color=\''.$icon_color.'\';';
		$ip_hv_enter_style .= $i_enter_shadow.' this.getElementsByClassName(\'cesis_icon_shape\')[0].style.borderColor=\''.$h_icon_border_color.'\';
	this.getElementsByClassName(\'cesis_icon_shape\')[0].style.background=\''.$i_new_h_bg.'\'; this.getElementsByClassName(\'cesis_icon_shape\')[0].style.color=\''.$h_icon_color.'\';';
	}
		if($i_hover !== 'none' && $i_hover !== 'grow' && $i_hover !== 'shrink' && $i_hover !== 'shine' && $shape !== 'hexagon'){
			$i_additional_class .= 'cesis_has_hover';
			$additional_class .= 'cesis_ip_has_hover';
			if($i_hover == 'trim'){
				$h_border_color = $h_icon_color;
			}else{
				$h_border_color = $h_icon_border_color;
			}
			if($i_b_size == '0' || $i_b_size == '' ){ $h_i_b_size = '2';}else{ $h_i_b_size = $i_b_size;}
			$i_hover_ctn = '<span class="cesis_h_'.$i_hover.'" style="border-color:'.$h_border_color.'; border-radius:'.$i_radius.'px; border-width:'.$h_i_b_size.'px;"></span>';
		}elseif($i_hover == 'shine' && $shape !== 'hexagon'){
			$i_additional_class .= 'cesis_has_hover cesis_overflow_hidden ';
			$additional_class .= 'cesis_ip_has_hover';
			$i_hover_ctn = '<span class="cesis_h_'.$i_hover.'"></span>';
		}elseif($i_hover !== 'none' && $shape !== 'hexagon'){
			$i_additional_class .= 'cesis_has_hover cesis_h_'.$i_hover.' ';
			$additional_class .= 'cesis_ip_has_hover';
		}



	if($shape == 'hexagon'){
		$i_hv_style = '';
		$i_additional_class .= 'cesis_icon_hexagon ';
		$shape = 'style="width:'.$i_bg_size.'px; line-height:0; padding:'.$hexa_padding.'px 0; margin:'.$hexa_ba_size.'px 0; "';

		$output .= '<style>';
		if($i_b_size == '0'){
			$output .= '
			#cesis_icon_'.$id.' .cesis_icon_shape{
				background:'.$icon_bg_color.';
				color:'.$icon_color.';
			}
			#cesis_icon_'.$id.' .cesis_icon_shape:before,#cesis_icon_'.$id.' .cesis_icon_shape:after {
  			content: "";
  			position: absolute;
  			width: 0;
				left:0;
  			border-left: '.$hexa_ba_t_border.'px solid transparent;
  			border-right: '.$hexa_ba_t_border.'px solid transparent;
			}
			#cesis_icon_'.$id.' .cesis_icon_shape:before{
				bottom: 100%;
  			border-bottom: '.$hexa_ba_size.'px solid '.$icon_bg_color.';
			}
			#cesis_icon_'.$id.' .cesis_icon_shape:after{
  			top: 100%;
  			width: 0;
  			border-top: '.$hexa_ba_size.'px solid '.$icon_bg_color.';
			}
			#cesis_icon_'.$id.':hover .cesis_icon_shape{
				background:'.$h_icon_bg_color.';
				color:'.$h_icon_color.';
			}
			.cesis_icon_paragraph_ctn:hover #cesis_icon_'.$id.' .cesis_icon_shape:before{
  			border-bottom: '.$hexa_ba_size.'px solid '.$h_icon_bg_color.';
			}
			.cesis_icon_paragraph_ctn:hover #cesis_icon_'.$id.' .cesis_icon_shape:after{
  			border-top: '.$hexa_ba_size.'px solid '.$h_icon_bg_color.';
			}';
		}else{
			$output .= '
			#cesis_icon_'.$id.' .cesis_icon_shape{
				border-left:'.$i_b_size.'px solid '.$icon_border_color.';
				border-right:'.$i_b_size.'px solid '.$icon_border_color.';
				background:'.$icon_bg_color.';
				color:'.$icon_color.';
			}
			#cesis_icon_'.$id.' .cesis_icon_shape:before,#cesis_icon_'.$id.' .cesis_icon_shape:after {
  			content: "";
  			position: absolute;
  			z-index: 1;
  			width: '.$hexa_ba_wh.'px;
  			height: '.$hexa_ba_wh.'px;
  			-webkit-transform: scaleY(0.5774) rotate(-45deg);
  			-ms-transform: scaleY(0.5774) rotate(-45deg);
  			transform: scaleY(0.5774) rotate(-45deg);
  			background-color: inherit;
				left:'.$hexa_left_pos.'px;
			}
			#cesis_icon_'.$id.' .cesis_icon_shape:before{
				top:-'.($hexa_ba_wh/2).'px;
  			border-top: '.$hexa_b_size.'px solid '.$icon_border_color.';
  			border-right: '.$hexa_b_size.'px solid '.$icon_border_color.';
			}
			#cesis_icon_'.$id.' .cesis_icon_shape:after{
				bottom:-'.($hexa_ba_wh/2).'px;
  			border-bottom: '.$hexa_b_size.'px solid '.$icon_border_color.';
  			border-left: '.$hexa_b_size.'px solid '.$icon_border_color.';
			}
			.cesis_icon_paragraph_ctn:hover #cesis_icon_'.$id.' .cesis_icon_shape{
				background:'.$h_icon_bg_color.';
				color:'.$h_icon_color.';
				border-color:'.$h_icon_border_color.';
			}
			.cesis_icon_paragraph_ctn:hover #cesis_icon_'.$id.' .cesis_icon_shape:before{
  			border-top: '.$hexa_b_size.'px solid '.$h_icon_border_color.';
	  		border-right: '.$hexa_b_size.'px solid '.$h_icon_border_color.';
			}
			.cesis_icon_paragraph_ctn:hover #cesis_icon_'.$id.' .cesis_icon_shape:after{
			border-bottom: '.$hexa_b_size.'px solid '.$h_icon_border_color.';
			border-left: '.$hexa_b_size.'px solid '.$h_icon_border_color.';
			}';
		}

		$output .= '</style>';

	}
	elseif($shape == 'rounded'){
		$shape = 'style="'.$i_shadow_style.' border:'.$i_b_size.'px solid '.$icon_border_color.'; background:'.$i_new_bg.'; color:'.$icon_color.'; border-radius:'.$i_radius.'px;
		width:'.$i_bg_size.'px; height:'.$i_bg_size.'px; line-height:0; padding:'.$padding.'px 0; "';
	}
	elseif($shape == 'diamond'){
		$shape = 'style="'.$i_shadow_style.' border:'.$i_b_size.'px solid '.$icon_border_color.'; background:'.$i_new_bg.'; color:'.$icon_color.';
		width:'.$i_bg_size.'px; height:'.$i_bg_size.'px; line-height:0; padding:'.$padding.'px 0; "';
		$i_radius = '0';
		$i_additional_class .= 'cesis_icon_diamond ';

	}else{
		$shape = 'style="'.$i_shadow_style.' border:'.$i_b_size.'px solid '.$icon_border_color.'; background:'.$i_new_bg.'; color:'.$icon_color.';
		width:'.$i_bg_size.'px; height:'.$i_bg_size.'px; line-height:0; padding:'.$padding.'px 0; "';
		$i_radius = '0';
	}

}else{

	if($icon !== ''){
		if($i_use_gradient !== '' && $icon_alt_bg_color !== '' &&  $h_icon_alt_bg_color == '' && !$msie){
			$i_style .= ' color:'.$icon_color.'; background: -webkit-linear-gradient('.$icon_color.','.$icon_alt_bg_color.');';
			$ip_hv_leave_style .= 'this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'linear-gradient('.$icon_color.','.$icon_alt_bg_color.')\';';
			$ip_hv_enter_style .= 'this.getElementsByClassName(\'cesis_icon_inner\')[0].style.color=\''.$h_icon_color.'\'; this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'none\';';
		}elseif($i_use_gradient !== '' && $icon_alt_bg_color !== '' &&  $h_icon_alt_bg_color !== '' && !$msie){
			$i_style .= ' color:'.$icon_color.'; background: -webkit-linear-gradient('.$icon_color.','.$icon_alt_bg_color.');';
			$ip_hv_leave_style .= 'this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'linear-gradient('.$icon_color.','.$icon_alt_bg_color.')\';';
			$ip_hv_enter_style .= 'this.getElementsByClassName(\'cesis_icon_inner\')[0].style.color=\''.$h_icon_color.'\'; this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'linear-gradient('.$h_icon_color.','.$h_icon_alt_bg_color.')\';';
		}elseif($i_use_gradient !== '' &&  $h_icon_alt_bg_color !== '' && !$msie){
			$i_style .= ' color:'.$icon_color.'; background:none;';
			$ip_hv_leave_style .= 'this.getElementsByClassName(\'cesis_icon_inner\')[0].style.color=\''.$icon_color.'\'; this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'none\';';
			$ip_hv_enter_style .= 'this.getElementsByClassName(\'cesis_icon_inner\')[0].style.color=\''.$h_icon_color.'\'; this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'linear-gradient('.$h_icon_color.','.$h_icon_alt_bg_color.')\';';
		}else{
			$shape = 'style="color:'.$icon_color.'; "';
			$ip_hv_leave_style .= 'this.getElementsByClassName(\'cesis_icon_shape\')[0].style.color=\''.$icon_color.'\';';
			$ip_hv_enter_style .= 'this.getElementsByClassName(\'cesis_icon_shape\')[0].style.color=\''.$h_icon_color.'\';';
		}
	}

}
}

/*-------------------/
  Heading settings  /
------------------*/

	$settings = get_option( 'wpb_js_google_fonts_subsets' );
	if ( is_array( $settings ) && ! empty( $settings ) ) {
		$subsets = '&subset=' . implode( ',', $settings );
	} else {
		$subsets = '';
	}

	$heading_google_fonts_field_settings = isset( $heading_google_fonts_field['settings'], $heading_google_fonts_field['settings']['fields'] ) ? $heading_google_fonts_field['settings']['fields'] : array();
	$heading_google_fonts_obj = new Vc_Google_Fonts();
	$heading_google_fonts_data = strlen( $heading_google_fonts ) > 0 ? $heading_google_fonts_obj->_vc_google_fonts_parse_attributes( $heading_google_fonts_field_settings, $heading_google_fonts ) : '';

	$heading_style = 'font-size:'.$heading_f_size.'; ';
	$heading_style .= 'letter-spacing:'.$heading_l_spacing.'px; ';
	$heading_style .= 'line-height:'.$heading_l_height.'; ';
	$heading_style .= 'text-transform:'.$heading_t_transform.'; ';

	if ( isset( $heading_google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $heading_google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $heading_google_fonts_data['values']['font_family'] . $subsets );
	}

	if ( $heading_font == 'custom' && ! empty( $heading_google_fonts_data ) && isset( $heading_google_fonts_data['values'], $heading_google_fonts_data['values']['font_family'], $heading_google_fonts_data['values']['font_style'] ) ) {
		$heading_google_fonts_family = explode( ':', $heading_google_fonts_data['values']['font_family'] );
		$heading_style .= 'font-family:' . $heading_google_fonts_family[0].'; ';
		$heading_google_fonts_styles = explode( ':', $heading_google_fonts_data['values']['font_style'] );
		$heading_style .= 'font-weight:' . $heading_google_fonts_styles[1].'; ';
		$heading_style .= 'font-style:' . $heading_google_fonts_styles[2].';';
	}else{
		$heading_style .= 'font-weight:' .$heading_f_weight.'; ';
	}

	$heading_style .= ' color:'.$heading_color.'; ';

	if($heading !== ''){
		$ip_hv_leave_style .= 'this.getElementsByClassName(\'cesis_icon_paragraph_heading\')[0].style.color=\''.$heading_color.'\';';
		$ip_hv_enter_style .= 'this.getElementsByClassName(\'cesis_icon_paragraph_heading\')[0].style.color=\''.$heading_h_color.'\';';
	}
/*-------------------/
    Text settings   /
------------------*/

	$text_google_fonts_field_settings = isset( $text_google_fonts_field['settings'], $text_google_fonts_field['settings']['fields'] ) ? $text_google_fonts_field['settings']['fields'] : array();
	$text_google_fonts_obj = new Vc_Google_Fonts();
	$text_google_fonts_data = strlen( $text_google_fonts ) > 0 ? $text_google_fonts_obj->_vc_google_fonts_parse_attributes( $text_google_fonts_field_settings, $text_google_fonts ) : '';

	$text_style = 'font-size:'.$text_f_size.'; ';
	$text_style .= 'letter-spacing:'.$text_l_spacing.'px; ';
	$text_style .= 'line-height:'.$text_l_height.'; ';
	$text_style .= 'text-transform:'.$text_t_transform.'; ';

	if ( isset( $text_google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $text_google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $text_google_fonts_data['values']['font_family'] . $subsets );
	}

	if ( $text_font == 'custom' && ! empty( $text_google_fonts_data ) && isset( $text_google_fonts_data['values'], $text_google_fonts_data['values']['font_family'], $text_google_fonts_data['values']['font_style'] ) ) {
		$text_google_fonts_family = explode( ':', $text_google_fonts_data['values']['font_family'] );
		$text_style .= 'font-family:' . $text_google_fonts_family[0].'; ';
		$text_google_fonts_styles = explode( ':', $text_google_fonts_data['values']['font_style'] );
		$text_style .= 'font-weight:' . $text_google_fonts_styles[1].'; ';
		$text_style .= 'font-style:' . $text_google_fonts_styles[2].';';
	}else{
		$text_style .= 'font-weight:' .$text_f_weight.'; ';
	}

	$text_style .= ' color:'.$text_color.';';
	if($text !== ''){
		$ip_hv_leave_style .= 'this.getElementsByClassName(\'cesis_icon_paragraph_text\')[0].style.color=\''.$text_color.'\';';
		$ip_hv_enter_style .= 'this.getElementsByClassName(\'cesis_icon_paragraph_text\')[0].style.color=\''.$text_h_color.'\';';
	}
/*------------------/
  Button settings  /
-----------------*/

/* Font settings */

$b_google_fonts_field_settings = isset( $b_google_fonts_field['settings'], $b_google_fonts_field['settings']['fields'] ) ? $b_google_fonts_field['settings']['fields'] : array();
$b_google_fonts_obj = new Vc_Google_Fonts();
$b_google_fonts_data = strlen( $button_google_fonts ) > 0 ? $b_google_fonts_obj->_vc_google_fonts_parse_attributes( $b_google_fonts_field_settings, $button_google_fonts ) : '';
if ( isset( $b_google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $b_google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $b_google_fonts_data['values']['font_family'] . $subsets );
}
if ( $button_font == 'custom' && ! empty( $b_google_fonts_data ) && isset( $b_google_fonts_data['values'], $b_google_fonts_data['values']['font_family'], $b_google_fonts_data['values']['font_style'] ) ) {
	$b_google_fonts_family = explode( ':', $b_google_fonts_data['values']['font_family'] );
	$button_style .= 'font-family:' . $b_google_fonts_family[0].'; ';
	$b_google_fonts_styles = explode( ':', $b_google_fonts_data['values']['font_style'] );
	$button_f_weight = $b_google_fonts_styles[1];
	$button_style .= 'font-style:' . $b_google_fonts_styles[2].';';
	$button_font = '';
}

/* Gradient settings */

if($b_use_gradient !== '' && $button_alt_bg_color !== ''){
	if($b_hover !== '3d'){
		$b_gradient .= 'cesis_icon_gradient cesis_use_shape';
	}else{
		$b_gradient .= 'cesis_icon_gradient';
	}
}
if($b_use_gradient !== '' && $h_button_alt_bg_color !== ''){
	if($b_hover !== '3d'){
		$b_gradient .= 'cesis_h_icon_gradient cesis_use_shape';
	}else{
		$b_gradient .= 'cesis_h_icon_gradient';
	}
}
/* Shadow settings */

if($b_shadow_type !== 'none'){
	if($b_shadow_color !== ''){
		if($b_shadow_type == 'dropdown'){
			$shadow_config = "0 14px 28px ".$b_shadow_color.", 0 10px 10px ".$b_shadow_color."";
		}elseif($b_shadow_type == 'blur'){
			$shadow_config = "0 0 15px ".$b_shadow_color."";
		}elseif($b_shadow_type == 'solid'){
			$shadow_config = "5px 5px 0 0 ".$b_shadow_color."";
		}
	}else{
		if($b_shadow_type == 'dropdown'){
			$shadow_config = "0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22)";
		}elseif($b_shadow_type == 'blur'){
			$shadow_config = "0 0 15px rgba(0,0,0,0.25)";
		}elseif($b_shadow_type == 'solid'){
			$shadow_config = "5px 5px 0 0 rgba(0, 0, 0, 0.30)";
		}
	}

	$b_enter_shadow = $b_leave_shadow = "this.style.boxShadow='".$shadow_config."';";
	if($b_shadow_hover == 'hover'){
		$b_leave_shadow = "this.style.boxShadow='none';";
		$b_shadow_style = "box-shadow:none;";
		$b_shadow_style_hover = "box-shadow:".$shadow_config.";";
	}elseif($b_shadow_hover == 'off_hover'){
		$b_enter_shadow = "this.style.boxShadow='none';";
	}
	if($b_shadow_hover == 'always' || $b_shadow_hover == 'off_hover' ){
		$b_shadow_style = "box-shadow:".$shadow_config.";";
		$b_shadow_style_hover = "box-shadow:".$shadow_config.";";
	}
}else{
	$b_leave_shadow = $b_enter_shadow = $b_shadow_style = '';
}


/* Style & Hover settings */


if($button_size == 'cesis_button_custom'){
 $button_height = str_replace("px","", $button_height);
 $button_style .= 'height:'.$button_height.'px; min-width:'.$button_width.';';
}elseif($button_size == 'cesis_button_small'){
 $button_height = '40';
}elseif($button_size == 'cesis_button_medium'){
 $button_height = '48';
}elseif($button_size == 'cesis_button_large'){
 $button_height = '64';
}
$button_3d_height = $button_height/2;
$button_l_height = $button_height-($button_border*2).'px';

	if($b_use_gradient !== '' && $button_alt_bg_color !== ''){
		$b_new_bg = 'linear-gradient('.$button_bg_color.','.$button_alt_bg_color.')';
	}else{
		$b_new_bg = $button_bg_color;
	}
	if($b_use_gradient !== '' && $h_button_alt_bg_color !== ''){
		$b_new_h_bg = 'linear-gradient('.$h_button_bg_color.','.$h_button_alt_bg_color.')';
	}else{
		$b_new_h_bg = $h_button_bg_color;
	}

	if($use_button !== ''){
		$b_hv_style='onmouseleave="'.$b_leave_shadow.' this.style.borderColor=\''.$button_border_color.'\'; this.style.background=\''.$b_new_bg.'\'; this.style.color=\''.$button_text_color.'\';"
		onmouseenter="'.$b_enter_shadow.' this.style.borderColor=\''.$h_button_border_color.'\'; this.style.background=\''.$b_new_h_bg.'\'; this.style.color=\''.$h_button_text_color.'\';"';
	}
	if($b_hover !== 'none' && $b_hover !== 'grow' && $b_hover !== 'shrink' && $b_hover !== 'shine' && $b_hover !== '3d'){
		$b_additional_class .= 'cesis_has_hover';
		if($b_hover == 'trim'){
			$h_border_color = $h_button_text_color;
		}else{
			$h_border_color = $h_button_border_color;
		}
		if($button_border == '0' || $button_border == '0' ){ $button_n_border = '2';}else{$button_n_border = $button_border;}
		$b_hover_ctn = '<span class="cesis_h_'.$b_hover.' cesis_h_direct" style="border-color:'.$h_border_color.'; border-radius:'.$button_radius.'px; border-width:'.$button_n_border.'px;"></span>';
		$btn_content .= $b_hover_ctn ;
	}elseif($b_hover == 'shine' ){
		$b_additional_class .= 'cesis_has_hover cesis_overflow_hidden ';
		$b_hover_ctn = '<span class="cesis_h_'.$b_hover.' cesis_h_direct"></span>';
		$btn_content .= $b_hover_ctn ;
	}elseif($b_hover !== 'none'){
		$b_additional_class .= 'cesis_has_hover cesis_h_'.$b_hover.' ';
	}


	if($b_hover == '3d'){
		$b_hv_style = '';
		$button_style .= 'font-size:'.$button_f_size.'; font-weight:'.$button_f_weight.'; line-height:'.$button_l_height.'; text-transform:'.$button_t_transform.'; letter-spacing:'.$button_l_spacing.'px;';
		$btn_content = '<span class="cesis_button_heads" style="transform: translate3d(0, 0, '.$button_3d_height.'px); -webkit-transform: translate3d(0, 0, '.$button_3d_height.'px);
		'.$b_shadow_style.' border:'.$button_border.'px solid '.$button_border_color.'; border-radius:'.$button_radius.'px; background:'.$b_new_bg.'; color:'.$button_text_color.';">'.$button_text.'</span>';
		$btn_content .= '<span class="cesis_button_tails" style="transform: rotateX(90deg) translate3d(0, 0, '.$button_3d_height.'px); -webkit-transform: rotateX(90deg) translate3d(0, 0, '.$button_3d_height.'px);
		 '.$b_shadow_style_hover.' border:'.$button_border.'px solid '.$h_button_border_color.';  border-radius:'.$button_radius.'px; background:'.$b_new_h_bg.'; color:'.$h_button_text_color.';">'.$button_text.'</span>';
	}else{

		$button_style .= 'font-size:'.$button_f_size.'; font-weight:'.$button_f_weight.'; line-height:'.$button_l_height.'; text-transform:'.$button_t_transform.'; letter-spacing:'.$button_l_spacing.'px;
		border:'.$button_border.'px solid '.$button_border_color.'; border-radius:'.$button_radius.'px;  background:'.$b_new_bg.'; color:'.$button_text_color.';';


		$btn_content .= '<span class="cesis_button_sub_ctn '.$i_class.'">';


		$btn_content .= '<span class="cesis_button_text">'.$button_text.'</span>';

		$btn_content .= '</span>';
	}

/*---------------------/
  Shortcode settings  /
--------------------*/

/* Generate Shortcode */
$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$class_to_filter = 'cesis_icon_paragraph_ctn '.$position.' '.$additional_class.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.' ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );


$output .= '<div id="cesis_icon_paragraph_'.$id.'" class="' . esc_attr( $css_class ) . '" data-delay="'.$delay.'" style="'.$margin.'" onmouseleave="'.$ip_hv_leave_style.'"; onmouseenter="'.$ip_hv_enter_style.'";>';





/* icon */
if($i_choice == 'icon'){
	if($link !== ''){
		$output .= '<a href="'.$link.'" target="'.$target.'" '.$lb_add.'>';
	}
	$output .= '<div id="cesis_icon_'.$id.'" class="cesis_icon_ctn '.$i_gradient.' " style="'.$i_margin.'">';
	$output .= '<div class="cesis_icon_shape '.$i_additional_class.'" '.$shape.'>'.$i_hover_ctn.'<i class="cesis_icon_inner '.$icon.'" style="'.$i_style.'"></i></div>';
	$output .= '</div>';
	if($link !== ''){
		$output .= '</a>';
	}
}

/* image */

if($i_choice == 'image' && $image !== ''){
	if($link !== ''){
		$output .= '<a href="'.$link.'" target="'.$target.'" '.$lb_add.'>';
	}
	$output .= $img;
	if($link !== ''){
		$output .= '</a>';
	}
}

/* text & button container */
$output .= '<div class="cesis_icon_paragraph_text_ctn">';
if($link !== ''){
	$output .= '<a href="'.$link.'" target="'.$target.'" '.$lb_add.'>';
}
/* heading */
if($heading !== ''){
	$output .= '<span class="cesis_icon_paragraph_heading '.$heading_font.'" style="margin-bottom:'.$heading_space.'px; '.$heading_style.'">'.$heading.'</span>';
}

/* text */
if($text !== ''){
	$output .= '<span class="cesis_icon_paragraph_text '.$text_font.'" style="margin-bottom:'.$text_space.'px; '.$text_style.'">'.$text.'</span>';
}
if($link !== ''){
	$output .= '</a>';
}

/* button */
if($use_button !== ''){
	if($button_type == "f_button"){
		if($b_hover == '3d'){
			$output .= '<div class="cesis_3d_hover_ctn">';
		}

		$output .= '<a href="'.$link.'" target="'.$target.'" '.$lb_add_src.' id="cesis_button_'.$id.'" class="cesis_button_ctn '.$lb_add_class.' '.$button_font.' '.$button_size.' '.$b_gradient.' '.$b_additional_class.' "
		style="'.$b_shadow_style.' '.$button_style.'" '.$b_hv_style.'>';

		$output .= $btn_content;

		$output .= '</a>';

		if($b_hover == '3d'){
			$output .= '</div>';
		}
	}else{
		$output .= '<a href="'.$link.'" target="'.$target.'" '.$lb_add_src.' id="cesis_button_'.$id.'" class="cesis_button_ctn cesis_button_text_only  '.$lb_add_class.' '.$button_font.'"
		style="'.$button_style.' background:none!important; border:none!important;" '.$b_hv_style.'>';

		$output .= $btn_content;

		$output .= '</a>';
	}
}



$output .= '</div>';

$output .= '</div>';


echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;


}
}

}
