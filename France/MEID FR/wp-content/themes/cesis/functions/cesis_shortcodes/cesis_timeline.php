<?php

if (!class_exists('WPBakeryShortCode_cesis_timeline')) {
class WPBakeryShortCode_cesis_timeline extends WPBakeryShortCode {

protected function content( $atts, $content = null ) {

extract( shortcode_atts( array(
        'line_color' => '',
        'f_point_color' => '',
        'point_color' => '',
        'bg_color' => '',


    		'heading_f_size' => '18px',
    		'heading_l_height' => '27px',
    		'heading_f_weight' => '700',
    		'heading_t_transform' => 'none',
    		'heading_l_spacing' => '0',
    		'heading_font' => 'main_font',
    		'heading_google_fonts' => '',


    		'text_f_size' => '15px',
    		'text_l_height' => '24px',
    		'text_f_weight' => '400',
    		'text_t_transform' => 'none',
    		'text_l_spacing' => '0',
    		'text_font' => 'main_font',
    		'text_google_fonts' => '',

        'margin_top' => '0',
        'margin_bottom' => '0',
		    'scroll' => '',
		    'speed' => '800',
		    'css_animation' => '',
		    'events'   => '',
		    'hide_lg' => '',
		    'hide_md' => '',
		    'hide_sm' => '',
		    'el_class' => ''
), $atts ) );


	global $cesis_data;

	$animation = $this->getCSSAnimation( $css_animation );
if($line_color == ""){
  $line_color = $cesis_data["cesis_main_content_accent_one"];
}
if($f_point_color == ""){
  $f_point_color = $cesis_data["cesis_main_content_heading"];
}
if($point_color == ""){
  $point_color = $cesis_data["cesis_main_content_accent_one"];
}
if($bg_color == ""){
  $bg_color = $cesis_data["cesis_main_content_bg"];
}



	ob_start();

	$id = RandomString(20);
	$output = $additional_class = $i_additional_class = $i_gradient = $i_leave_shadow = $i_enter_shadow = $i_shadow_style = $i_hover_ctn = $i_margin = $ip_hv_leave_style = $ip_hv_enter_style =
  $headind_style = $text_style = $i_class = $add = '';


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


$output .='<div class="cesis_timeline_ctn '.$el_class.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.'" id="cesis_timeline_'.$id.'" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;">';

$output .='<div class="cesis_timeline_start" style="border-color:'.$line_color.';"></div>';
$output .='<div class="cesis_timeline_line" style="background:'.$line_color.'; color:'.$f_point_color.';"></div>';

$values = (array) vc_param_group_parse_atts( $events );


$events_data = array();
foreach ( $values as $data ) {
	$new_event = $data;

	 $new_event['type'] = isset( $data['type'] ) ? $data['type'] : '';
 	 $new_event['link'] = isset( $data['link'] ) ? $data['link'] : '';
 	 $new_event['target'] = isset( $data['target'] ) ? $data['target'] : '';
 	 $new_event['i_choice'] = isset( $data['i_choice'] ) ? $data['i_choice'] : '';
 	 $new_event['image'] = isset( $data['image'] ) ? $data['image'] : '';
	 $new_event['image_size'] = isset( $data['image_size'] ) ? $data['image_size'] : '';
 	 $new_event['icon'] = isset( $data['icon'] ) ? $data['icon'] : '';
 	 $new_event['i_size'] = isset( $data['i_size'] ) ? $data['i_size'] : '';
 	 $new_event['i_use_gradient'] = isset( $data['i_use_gradient'] ) ? $data['i_use_gradient'] : '';
 	 $new_event['use_shape'] = isset( $data['use_shape'] ) ? $data['use_shape'] : '';
	 $new_event['shape'] = isset( $data['shape'] ) ? $data['shape'] : '';
 	 $new_event['i_radius'] = isset( $data['i_radius'] ) ? $data['i_radius'] : '';
 	 $new_event['i_bg_size'] = isset( $data['i_bg_size'] ) ? $data['i_bg_size'] : '';
 	 $new_event['i_b_size'] = isset( $data['i_b_size'] ) ? $data['i_b_size'] : '';
 	 $new_event['i_hover'] = isset( $data['i_hover'] ) ? $data['i_hover'] : '';
 	 $new_event['i_shadow_type'] = isset( $data['i_shadow_type'] ) ? $data['i_shadow_type'] : '';
 	 $new_event['i_shadow_hover'] = isset( $data['i_shadow_hover'] ) ? $data['i_shadow_hover'] : '';
 	 $new_event['position'] = isset( $data['position'] ) ? $data['position'] : '';
	 $new_event['i_space'] = isset( $data['i_space'] ) ? $data['i_space'] : '';
 	 $new_event['icon_color'] = isset( $data['icon_color'] ) ? $data['icon_color'] : '';
 	 $new_event['icon_bg_color'] = isset( $data['icon_bg_color'] ) ? $data['icon_bg_color'] : '';
 	 $new_event['icon_alt_bg_color'] = isset( $data['icon_alt_bg_color'] ) ? $data['icon_alt_bg_color'] : '';
 	 $new_event['icon_border_color'] = isset( $data['icon_border_color'] ) ? $data['icon_border_color'] : '';
 	 $new_event['h_icon_color'] = isset( $data['h_icon_color'] ) ? $data['h_icon_color'] : '';
 	 $new_event['h_icon_bg_color'] = isset( $data['h_icon_bg_color'] ) ? $data['h_icon_bg_color'] : '';
 	 $new_event['h_icon_alt_bg_color'] = isset( $data['h_icon_alt_bg_color'] ) ? $data['h_icon_alt_bg_color'] : '';
 	 $new_event['h_icon_border_color'] = isset( $data['h_icon_border_color'] ) ? $data['h_icon_border_color'] : '';
 	 $new_event['i_shadow_color'] = isset( $data['i_shadow_color'] ) ? $data['i_shadow_color'] : '';
	 $new_event['heading'] = isset( $data['heading'] ) ? $data['heading'] : '';
 	 $new_event['heading_space'] = isset( $data['heading_space'] ) ? $data['heading_space'] : '';
 	 $new_event['heading_color'] = isset( $data['heading_color'] ) ? $data['heading_color'] : $cesis_data["cesis_main_content_heading"];
 	 $new_event['heading_h_color'] = isset( $data['heading_h_color'] ) ? $data['heading_h_color'] : $cesis_data["cesis_main_content_heading"];
 	 $new_event['text'] = isset( $data['text'] ) ? $data['text'] : '';
 	 $new_event['text_color'] = isset( $data['text_color'] ) ? $data['text_color'] : $cesis_data["cesis_main_content_color"];
 	 $new_event['text_h_color'] = isset( $data['text_h_color'] ) ? $data['text_h_color'] : $cesis_data["cesis_main_content_color"];


 	 $new_event['date'] = isset( $data['date'] ) ? $data['date'] : $cesis_data["cesis_main_content_color"];
 	 $new_event['date_color'] = isset( $data['date_color'] ) ? $data['date_color'] : $cesis_data["cesis_main_content_heading"];
 	 $new_event['date_bg_color'] = isset( $data['date_bg_color'] ) ? $data['date_bg_color'] : $cesis_data["cesis_main_content_accent_one"];

   $events_data[] = $new_event;
}


$count = 0;

foreach ( $events_data as $event ) {


/*--------------------------/
    Icon / Image settings  /
-------------------------*/

/* Space settings */


if($event['position'] == 'timeline_i_next'){
	$i_margin .= 'margin:0 '.$event['i_space'].'px; ';
}
if($event['position'] == 'timeline_i_top'){
	$i_margin .= 'margin-bottom:'.$event['i_space'].'px; ';
}

/* Image settings */

if($event['image'] !== ''){
    $img_id = preg_replace( '/[^\d]/', '', $event['image'] );
		$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => 'full'  ) );
		$img = '<div class="cesis_icon_paragraph_image"  style="'.$i_margin.' width:'.$event['image_size'].'px;">'.$img['thumbnail'].'</div>';
}


if($event['i_choice'] == 'icon'){
/* Gradient settings */

if($event['i_use_gradient'] !== '' && $event['icon_alt_bg_color'] !== ''){
	if($event['use_shape'] !== ''){
		$i_gradient .= 'cesis_icon_gradient cesis_use_shape';
	}else{
		$i_gradient .= ' cesis_icon_gradient';
	}
}
if($event['i_use_gradient'] !== '' && $event['h_icon_alt_bg_color'] !== ''){
	if($event['use_shape'] !== ''){
		$i_gradient .= 'cesis_h_icon_gradient cesis_use_shape ';
	}else{
		$i_gradient .= ' cesis_h_icon_gradient';
	}
}


/* Shadow settings */

if($event['i_shadow_type'] !== 'none'){
	if($event['i_shadow_color'] !== ''){
		if($event['i_shadow_type'] == 'dropdown'){
			if($event['shape'] == 'diamond'){
				$i_shadow_config = "7px 7px 28px ".$event['i_shadow_color'].", 5px 5px 10px ".$event['i_shadow_color']."";
			}else{
				$i_shadow_config = "0 14px 28px ".$event['i_shadow_color'].", 0 10px 10px ".$event['i_shadow_color']."";
			}
		}elseif($event['i_shadow_type'] == 'blur'){
			$i_shadow_config = "0 0 15px ".$event['i_shadow_color']."";
		}elseif($event['i_shadow_type'] == 'solid'){
			if($event['shape'] == 'diamond'){
				$i_shadow_config = "5px -5px 0 0 ".$event['i_shadow_color']."";
			}else{
				$i_shadow_config = "5px 5px 0 0 ".$event['i_shadow_color']."";
			}
		}
	}else{
		if($event['i_shadow_type'] == 'dropdown'){
			if($event['shape'] == 'diamond'){
				$i_shadow_config = "7px 7px 28px rgba(0,0,0,0.25), 5px 5px 10px rgba(0,0,0,0.22)";
			}else{
				$i_shadow_config = "0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22)";
			}
		}elseif($event['i_shadow_type'] == 'blur'){
			$i_shadow_config = "0 0 15px rgba(0,0,0,0.25)";
		}elseif($event['i_shadow_type'] == 'solid'){
			if($event['shape'] == 'diamond'){
				$i_shadow_config = "5px -5px 0 0 rgba(0, 0, 0, 0.30)";
			}else{
				$i_shadow_config = "5px 5px 0 0 rgba(0, 0, 0, 0.30)";
			}
		}
	}
	$i_enter_shadow = $i_leave_shadow = 'this.getElementsByClassName(\'cesis_icon_shape\')[0].style.boxShadow=\''.$i_shadow_config.'\';';

	if($event['i_shadow_hover'] == 'hover'){
		$i_leave_shadow = 'this.getElementsByClassName(\'cesis_icon_shape\')[0].style.boxShadow=\'none\';';
		$i_shadow_style = "box-shadow:none;";
	}elseif($event['i_shadow_hover'] == 'off_hover'){
		$i_enter_shadow = 'this.getElementsByClassName(\'cesis_icon_shape\')[0].style.boxShadow=\'none\';';
	}
	if($event['i_shadow_hover'] == 'always' || $event['i_shadow_hover'] == 'off_hover' ){
				$i_shadow_style = "box-shadow:".$i_shadow_config.";";
	}
}else{
	$i_leave_shadow = $i_enter_shadow = $i_shadow_style = '';
}



/* Style & Hover settings */

$i_style = 'font-size:'.$event['i_size'].'px; ';
$padding = ($event['i_bg_size']-($event['i_b_size']*2)-$event['i_size'])/2;
$hexa_padding = (($event['i_bg_size']/sqrt(3))-$event['i_size'])/2;
$hexa_ba_size = ($event['i_bg_size']/sqrt(12));
$hexa_ba_t_border = $event['i_bg_size']/2;
$hexa_ba_wh = ($event['i_bg_size']/sqrt(2));
$hexa_left_pos = ($event['i_bg_size']/sqrt(46.627))-$event['i_b_size'];
$hexa_b_size = ($event['i_b_size']*sqrt(2));

if($event['use_shape'] !== ''){

	if($event['i_use_gradient'] !== '' && $event['icon_alt_bg_color'] !== ''){
		$i_new_bg = 'linear-gradient('.$event['icon_bg_color'].','.$event['icon_alt_bg_color'].')';
	}else{
		$i_new_bg = $event['icon_bg_color'];
	}
	if($event['i_use_gradient'] !== '' && $event['h_icon_alt_bg_color'] !== ''){
		$i_new_h_bg = 'linear-gradient('.$event['h_icon_bg_color'].','.$event['h_icon_alt_bg_color'].')';
	}else{
		$i_new_h_bg = $event['h_icon_bg_color'];
	}
	$ip_hv_leave_style .= $i_leave_shadow.' this.getElementsByClassName(\'cesis_icon_shape\')[0].style.borderColor=\''.$event['icon_border_color'].'\';
	this.getElementsByClassName(\'cesis_icon_shape\')[0].style.background=\''.$i_new_bg.'\'; this.getElementsByClassName(\'cesis_icon_shape\')[0].style.color=\''.$event['icon_color'].'\';';
	$ip_hv_enter_style .= $i_enter_shadow.' this.getElementsByClassName(\'cesis_icon_shape\')[0].style.borderColor=\''.$event['h_icon_border_color'].'\';
	this.getElementsByClassName(\'cesis_icon_shape\')[0].style.background=\''.$i_new_h_bg.'\'; this.getElementsByClassName(\'cesis_icon_shape\')[0].style.color=\''.$event['h_icon_color'].'\';';

		if($event['i_hover'] !== 'none' && $event['i_hover'] !== 'grow' && $event['i_hover'] !== 'shrink' && $event['i_hover'] !== 'shine' && $event['shape'] !== 'hexagon'){
			$i_additional_class .= 'cesis_has_hover';
			$additional_class .= 'cesis_ip_has_hover';
			if($event['i_hover'] == 'trim'){
				$h_border_color = $event['h_icon_color'];
			}else{
				$h_border_color = $event['h_icon_border_color'];
			}
			if($event['i_b_size'] == '0' || $event['i_b_size'] == '' ){ $h_i_b_size = '2';}else{ $h_i_b_size = $event['i_b_size'];}
			$i_hover_ctn = '<span class="cesis_h_'.$event['i_hover'].'" style="border-color:'.$h_border_color.'; border-radius:'.$event['i_radius'].'px; border-width:'.$h_i_b_size.'px;"></span>';
		}elseif($event['i_hover'] == 'shine' && $event['shape'] !== 'hexagon'){
			$i_additional_class .= 'cesis_has_hover cesis_overflow_hidden ';
			$additional_class .= 'cesis_ip_has_hover';
			$i_hover_ctn = '<span class="cesis_h_'.$event['i_hover'].'"></span>';
		}elseif($event['i_hover'] !== 'none' && $event['shape'] !== 'hexagon'){
			$i_additional_class .= 'cesis_has_hover cesis_h_'.$event['i_hover'].' ';
			$additional_class .= 'cesis_ip_has_hover';
		}



	if($event['shape'] == 'hexagon'){
		$i_hv_style = '';
		$i_additional_class .= 'cesis_icon_hexagon ';
		$event['shape'] = 'style="width:'.$event['i_bg_size'].'px; line-height:0; padding:'.$hexa_padding.'px 0; margin:'.$hexa_ba_size.'px 0; "';

		$output .= '<style>';
		if($event['i_b_size'] == '0'){
			$output .= '
			#cesis_icon_'.$id.' .cesis_icon_shape{
				background:'.$event['icon_bg_color'].';
				color:'.$event['icon_color'].';
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
  			border-bottom: '.$hexa_ba_size.'px solid '.$event['icon_bg_color'].';
			}
			#cesis_icon_'.$id.' .cesis_icon_shape:after{
  			top: 100%;
  			width: 0;
  			border-top: '.$hexa_ba_size.'px solid '.$event['icon_bg_color'].';
			}
			#cesis_icon_'.$id.':hover .cesis_icon_shape{
				background:'.$event['h_icon_bg_color'].';
				color:'.$event['h_icon_color'].';
			}
			.cesis_icon_paragraph_ctn:hover #cesis_icon_'.$id.' .cesis_icon_shape:before{
  			border-bottom: '.$hexa_ba_size.'px solid '.$event['h_icon_bg_color'].';
			}
			.cesis_icon_paragraph_ctn:hover #cesis_icon_'.$id.' .cesis_icon_shape:after{
  			border-top: '.$hexa_ba_size.'px solid '.$event['h_icon_bg_color'].';
			}';
		}else{
			$output .= '
			#cesis_icon_'.$id.' .cesis_icon_shape{
				border-left:'.$event['i_b_size'].'px solid '.$event['icon_border_color'].';
				border-right:'.$event['i_b_size'].'px solid '.$event['icon_border_color'].';
				background:'.$event['icon_bg_color'].';
				color:'.$event['icon_color'].';
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
  			border-top: '.$hexa_b_size.'px solid '.$event['icon_border_color'].';
  			border-right: '.$hexa_b_size.'px solid '.$event['icon_border_color'].';
			}
			#cesis_icon_'.$id.' .cesis_icon_shape:after{
				bottom:-'.($hexa_ba_wh/2).'px;
  			border-bottom: '.$hexa_b_size.'px solid '.$event['icon_border_color'].';
  			border-left: '.$hexa_b_size.'px solid '.$event['icon_border_color'].';
			}
			.cesis_icon_paragraph_ctn:hover #cesis_icon_'.$id.' .cesis_icon_shape{
				background:'.$event['h_icon_bg_color'].';
				color:'.$event['h_icon_color'].';
				border-color:'.$event['h_icon_border_color'].';
			}
			.cesis_icon_paragraph_ctn:hover #cesis_icon_'.$id.' .cesis_icon_shape:before{
  			border-top: '.$hexa_b_size.'px solid '.$event['h_icon_border_color'].';
	  		border-right: '.$hexa_b_size.'px solid '.$event['h_icon_border_color'].';
			}
			.cesis_icon_paragraph_ctn:hover #cesis_icon_'.$id.' .cesis_icon_shape:after{
			border-bottom: '.$hexa_b_size.'px solid '.$event['h_icon_border_color'].';
			border-left: '.$hexa_b_size.'px solid '.$event['h_icon_border_color'].';
			}';
		}

		$output .= '</style>';

	}
	elseif($event['shape'] == 'rounded'){
		$event['shape'] = 'style="'.$i_shadow_style.' border:'.$event['i_b_size'].'px solid '.$event['icon_border_color'].'; background:'.$i_new_bg.'; color:'.$event['icon_color'].'; border-radius:'.$event['i_radius'].'px;
		width:'.$event['i_bg_size'].'px; height:'.$event['i_bg_size'].'px; line-height:0; padding:'.$padding.'px 0; "';
	}
	elseif($event['shape'] == 'diamond'){
		$event['shape'] = 'style="'.$i_shadow_style.' border:'.$event['i_b_size'].'px solid '.$event['icon_border_color'].'; background:'.$i_new_bg.'; color:'.$event['icon_color'].';
		width:'.$event['i_bg_size'].'px; height:'.$event['i_bg_size'].'px; line-height:0; padding:'.$padding.'px 0; "';
		$event['i_radius'] = '0';
		$i_additional_class .= 'cesis_icon_diamond ';

	}else{
		$event['shape'] = 'style="'.$i_shadow_style.' border:'.$event['i_b_size'].'px solid '.$event['icon_border_color'].'; background:'.$i_new_bg.'; color:'.$event['icon_color'].';
		width:'.$event['i_bg_size'].'px; height:'.$event['i_bg_size'].'px; line-height:0; padding:'.$padding.'px 0; "';
		$event['i_radius'] = '0';
	}

}else{
	if($event['i_use_gradient'] !== '' && $event['icon_alt_bg_color'] !== '' &&  $event['h_icon_alt_bg_color'] == '' && !$msie){
		$i_style .= ' color:'.$event['icon_color'].'; background: -webkit-linear-gradient('.$event['icon_color'].','.$event['icon_alt_bg_color'].');';
		$ip_hv_leave_style .= 'this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'linear-gradient('.$event['icon_color'].','.$event['icon_alt_bg_color'].')\';';
		$ip_hv_enter_style .= 'this.getElementsByClassName(\'cesis_icon_inner\')[0].style.color=\''.$event['h_icon_color'].'\'; this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'none\';';
	}elseif($event['i_use_gradient'] !== '' && $event['icon_alt_bg_color'] !== '' &&  $event['h_icon_alt_bg_color'] !== '' && !$msie){
		$i_style .= ' color:'.$event['icon_color'].'; background: -webkit-linear-gradient('.$event['icon_color'].','.$event['icon_alt_bg_color'].');';
		$ip_hv_leave_style .= 'this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'linear-gradient('.$event['icon_color'].','.$event['icon_alt_bg_color'].')\';';
		$ip_hv_enter_style .= 'this.getElementsByClassName(\'cesis_icon_inner\')[0].style.color=\''.$event['h_icon_color'].'\'; this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'linear-gradient('.$event['h_icon_color'].','.$event['h_icon_alt_bg_color'].')\';';
	}elseif($event['i_use_gradient'] !== '' &&  $event['h_icon_alt_bg_color'] !== '' && !$msie){
		$i_style .= ' color:'.$event['icon_color'].'; background:none;';
		$ip_hv_leave_style .= 'this.getElementsByClassName(\'cesis_icon_inner\')[0].style.color=\''.$event['icon_color'].'\'; this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'none\';';
		$ip_hv_enter_style .= 'this.getElementsByClassName(\'cesis_icon_inner\')[0].style.color=\''.$event['h_icon_color'].'\'; this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'linear-gradient('.$event['h_icon_color'].','.$event['h_icon_alt_bg_color'].')\';';
	}else{
		$event['shape'] = 'style="color:'.$event['icon_color'].'; "';
		$ip_hv_leave_style .= 'this.getElementsByClassName(\'cesis_icon_shape\')[0].style.color=\''.$event['icon_color'].'\';';
		$ip_hv_enter_style .= 'this.getElementsByClassName(\'cesis_icon_shape\')[0].style.color=\''.$event['h_icon_color'].'\';';
	}

}
}

/*-------------------/
  Heading settings  /
------------------*/

	$heading_style .= ' color:'.$event['heading_color'].'; ';
	$ip_hv_leave_style .= 'this.getElementsByClassName(\'cesis_icon_paragraph_heading\')[0].style.color=\''.$event['heading_color'].'\';';
	$ip_hv_enter_style .= 'this.getElementsByClassName(\'cesis_icon_paragraph_heading\')[0].style.color=\''.$event['heading_h_color'].'\';';


/*-------------------/
    Text settings   /
------------------*/


	$text_style .= ' color:'.$event['text_color'].';';
	$ip_hv_leave_style .= 'this.getElementsByClassName(\'cesis_icon_paragraph_text\')[0].style.color=\''.$event['text_color'].'\';';
	$ip_hv_enter_style .= 'this.getElementsByClassName(\'cesis_icon_paragraph_text\')[0].style.color=\''.$event['text_h_color'].'\';';


if($event['type'] == "date"){


$output .= '<div class="cesis_timeline_date"><span style="color:'.$event['date_color'].'; background:'.$event['date_bg_color'].';">'.$event['date'].'</span></div>';

}else{


$count++;

$add = ( $count % 2 ) ? ' cesis_event_even' : ' cesis_event_odd';


$output .= '<div class="cesis_timeline_event cesis_icon_paragraph_ctn '.$event['position'].' '.$animation.' '.$additional_class.' '.$add.'" onmouseleave="'.$ip_hv_leave_style.'"; onmouseenter="'.$ip_hv_enter_style.'"; style="color:'.$point_color.'; background:'.$bg_color.';">';

/* icon */
if($event['i_choice'] == 'icon'){
	$output .= '<a href="'.$event['link'].'" target="'.$event['target'].'">';
	$output .= '<div id="cesis_icon_'.$id.'" class="cesis_icon_ctn '.$i_gradient.' " style="'.$i_margin.'">';
	$output .= '<div class="cesis_icon_shape '.$i_additional_class.'" '.$event['shape'].'>'.$i_hover_ctn.'<i class="cesis_icon_inner '.$event['icon'].'" style="'.$i_style.'"></i></div>';
	$output .= '</div>';
	$output .= '</a>';
}

/* image */

if($event['i_choice'] == 'image' && $event['image'] !== ''){
	$output .= '<a href="'.$event['link'].'" target="'.$event['target'].'">';
	$output .= $img;
	$output .= '</a>';
}

/* text & button container */
$output .= '<div class="cesis_icon_paragraph_text_ctn">';
$output .= '<a href="'.$event['link'].'" target="'.$event['target'].'">';

/* heading */
if($event['heading'] !== ''){
	$output .= '<span class="cesis_icon_paragraph_heading '.$heading_font.'" style="margin-bottom:'.$event['heading_space'].'px; '.$heading_style.'">'.$event['heading'].'</span>';
}

/* text */
if($event['text'] !== ''){
	$output .= '<span class="cesis_icon_paragraph_text '.$text_font.'" style=" '.$text_style.'">'.$event['text'].'</span>';
}
$output .= '</a>';

$output .= '</div>';

$output .= '</div>';

}


$ip_hv_leave_style = $ip_hv_enter_style = $i_additional_class = $i_gradient = $i_leave_shadow = $i_enter_shadow = $i_shadow_style = $i_hover_ctn = $i_margin = $ip_hv_leave_style = $ip_hv_enter_style =
$headind_style = $text_style = $i_class = '';
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

}






$output .='</div>';





echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;

}

  }
}





?>
