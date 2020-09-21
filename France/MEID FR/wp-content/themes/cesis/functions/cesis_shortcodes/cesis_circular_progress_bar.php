<?php

if (!class_exists('WPBakeryShortCode_cesis_circular_progress_bar')) {
class WPBakeryShortCode_cesis_circular_progress_bar extends WPBakeryShortCode {



protected function content( $atts, $content = null ) {

global $cesis_data;

	extract(shortcode_atts(array(

		'content_type' => 'percentage',
		'percentage'   => '80',
		'content_color' => '',
		'bar_color' => '',
		'bar_alt_color' => '',
		'track_color' => '',
		'bar_size' => '8',
		'track_size' => '10',
		'canvas_size' => '180',
		'link'   => '',
		'target'   => '_self',
		'speed'   => '10',
		'linecap'   => 'butt',


		'custom_text' => 'Heading',
		'text_f_size' => '18px',
		'text_l_height' => '24px',
		'text_f_weight' => '400',
		'text_t_transform' => 'none',
		'text_l_spacing' => '0',
		'text_font' => 'main_font',
		'text_google_fonts' => '',

		'icon' => '',
		'i_size'   => '22',
		'use_gradient' => '',
		'use_shape' => '',
		'shape' => 'rounded',
		'position'   => 'i_float_none',
		'hover' => 'none',
		'shadow_type' => 'none',
		'shadow_hover' => 'always',
		'icon_color' => '',
		'icon_bg_color' => '',
		'icon_alt_bg_color' => '',
		'icon_border_color' => '',
		'h_icon_color' => '',
		'h_icon_bg_color' => '',
		'h_icon_alt_bg_color' => '',
		'h_icon_border_color' => '',
		'shadow_color' => '',
		'i_bg_size' => '50',
		'i_b_size' => '0',
		'i_radius'   => '100',

    'margin_top' => '0',
    'margin_bottom' => '0',
		'hide_lg' => '',
		'hide_md' => '',
		'hide_sm' => '',
		'el_class' => ''

    ), $atts));


ob_start();

/* default color settings from theme options */

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
if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
$msie = true;
}else{
$msie = false;
}


$output = $style = $content_style = $hover_ctn = $gradient = $additional_class = '';


$style .= 'margin-top:'.$margin_top.'px; ';
$style .= 'margin-bottom:'.$margin_bottom.'px; ';

$content_style = 'style="margin:-'.($canvas_size/2).'px 0 0 -'.($canvas_size/2).'px; width:'.$canvas_size.'px; height:'.$canvas_size.'px;"';

	$settings = get_option( 'wpb_js_google_fonts_subsets' );
	if ( is_array( $settings ) && ! empty( $settings ) ) {
		$subsets = '&subset=' . implode( ',', $settings );
	} else {
		$subsets = '';
	}

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

	$text_style .= ' color:'.$content_color.';';



		if($bar_size > $track_size){
			$radius_adjust = $bar_size;
		}else{
			$radius_adjust = $track_size;
		}
		$radius = $canvas_size-$radius_adjust;
		$n_canvas_size = $canvas_size*2;
		$bar_size = $bar_size*2;
		$track_size = $track_size*2;


		if($content_color !== '') {
		$style .= 'color:'.$content_color.'; ';
		}

$id = RandomString(20);

if($bar_alt_color == ''){
	$bar_alt_color = $bar_color ;
}

	$output .='<div id="cesis_circular_pb_'.$id.'" class="cesis_circular_pb_ctn" style="'.$style.'" >';
	if($content_type == "percentage"){
		$output .='<div class="cesis_circular_pb_status" '.$content_style.'><span class="cesis_cbp_percentage '.$text_font.'" data-number="'.$percentage.'"   style="'.$text_style.'">0</span></div>';
	}
	elseif($content_type == "text"){
		$output .='<div class="cesis_circular_pb_status"  '.$content_style.'><span class="'.$text_font.'" style="'.$text_style.'">'.$custom_text.'</span></div>';
	}
	elseif($content_type == "icon"){

		$output .= '<div class="cesis_circular_pb_status"  '.$content_style.'>';

		/* Gradient settings */

		if($use_gradient !== '' && $icon_alt_bg_color !== ''){
			if($use_shape !== ''){
				$gradient .= 'cesis_icon_gradient cesis_use_shape';
			}else{
				$gradient .= ' cesis_icon_gradient';
			}
		}
		if($use_gradient !== '' && $h_icon_alt_bg_color !== ''){
			if($use_shape !== ''){
				$gradient .= 'cesis_h_icon_gradient cesis_use_shape ';
			}else{
				$gradient .= ' cesis_h_icon_gradient';
			}
		}


		/* Shadow settings */

		if($shadow_type !== 'none'){
			if($shadow_color !== ''){
				if($shadow_type == 'dropdown'){
					if($shape == 'diamond'){
						$shadow_config = "7px 7px 28px ".$shadow_color.", 5px 5px 10px ".$shadow_color."";
					}else{
						$shadow_config = "0 14px 28px ".$shadow_color.", 0 10px 10px ".$shadow_color."";
					}
				}elseif($shadow_type == 'blur'){
					$shadow_config = "0 0 15px ".$shadow_color."";
				}elseif($shadow_type == 'solid'){
					if($shape == 'diamond'){
						$shadow_config = "5px -5px 0 0 ".$shadow_color."";
					}else{
						$shadow_config = "5px 5px 0 0 ".$shadow_color."";
					}
				}
			}else{
				if($shadow_type == 'dropdown'){
					if($shape == 'diamond'){
						$shadow_config = "7px 7px 28px rgba(0,0,0,0.25), 5px 5px 10px rgba(0,0,0,0.22)";
					}else{
						$shadow_config = "0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22)";
					}
				}elseif($shadow_type == 'blur'){
					$shadow_config = "0 0 15px rgba(0,0,0,0.25)";
				}elseif($shadow_type == 'solid'){
					if($shape == 'diamond'){
						$shadow_config = "5px -5px 0 0 rgba(0, 0, 0, 0.30)";
					}else{
						$shadow_config = "5px 5px 0 0 rgba(0, 0, 0, 0.30)";
					}
				}
			}
			$enter_shadow = $leave_shadow = "this.style.boxShadow='".$shadow_config."';";

			if($shadow_hover == 'hover'){
				$leave_shadow = "this.style.boxShadow='none';";
				$shadow_style = "box-shadow:none;";
			}elseif($shadow_hover == 'off_hover'){
				$enter_shadow = "this.style.boxShadow='none';";
			}
			if($shadow_hover == 'always' || $shadow_hover == 'off_hover' ){
						$shadow_style = "box-shadow:".$shadow_config.";";
			}
		}else{
			$leave_shadow = $enter_shadow = $shadow_style = '';
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

			if($use_gradient !== '' && $icon_alt_bg_color !== ''){
				$new_bg = 'linear-gradient('.$icon_bg_color.','.$icon_alt_bg_color.')';
			}else{
				$new_bg = $icon_bg_color;
			}
			if($use_gradient !== '' && $h_icon_alt_bg_color !== ''){
				$new_h_bg = 'linear-gradient('.$h_icon_bg_color.','.$h_icon_alt_bg_color.')';
			}else{
				$new_h_bg = $h_icon_bg_color;
			}
			$hv_style='onmouseleave="'.$leave_shadow.' this.style.borderColor=\''.$icon_border_color.'\'; this.style.background=\''.$new_bg.'\'; this.style.color=\''.$icon_color.'\';"
			onmouseenter="'.$enter_shadow.' this.style.borderColor=\''.$h_icon_border_color.'\'; this.style.background=\''.$new_h_bg.'\'; this.style.color=\''.$h_icon_color.'\';"';


				if($hover !== 'none' && $hover !== 'grow' && $hover !== 'shrink' && $hover !== 'shine' && $shape !== 'hexagon'){
					$additional_class .= 'cesis_has_hover';
					if($hover == 'trim'){
						$h_border_color = $h_icon_color;
					}else{
						$h_border_color = $h_icon_border_color;
					}
					if($i_b_size == '0' || $i_b_size == '' ){ $h_i_b_size = '2';}else{ $h_i_b_size = $i_b_size;}
					$hover_ctn = '<span class="cesis_h_'.$hover.'" style="border-color:'.$h_border_color.'; border-radius:'.$i_radius.'px; border-width:'.$h_i_b_size.'px;"></span>';
				}elseif($hover == 'shine' && $shape !== 'hexagon'){
					$additional_class .= 'cesis_has_hover cesis_overflow_hidden ';
					$hover_ctn = '<span class="cesis_h_'.$hover.'"></span>';
				}elseif($hover !== 'none' && $shape !== 'hexagon'){
					$additional_class .= 'cesis_has_hover cesis_h_'.$hover.' ';
				}



			if($shape == 'hexagon'){
				$hv_style = '';
				$additional_class .= 'cesis_icon_hexagon ';
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
					#cesis_icon_'.$id.':hover .cesis_icon_shape:before{
		  			border-bottom: '.$hexa_ba_size.'px solid '.$h_icon_bg_color.';
					}
					#cesis_icon_'.$id.':hover .cesis_icon_shape:after{
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
					#cesis_icon_'.$id.':hover .cesis_icon_shape{
						background:'.$h_icon_bg_color.';
						color:'.$h_icon_color.';
						border-color:'.$h_icon_border_color.';
					}
					#cesis_icon_'.$id.':hover .cesis_icon_shape:before{
		  			border-top: '.$hexa_b_size.'px solid '.$h_icon_border_color.';
			  		border-right: '.$hexa_b_size.'px solid '.$h_icon_border_color.';
					}
					#cesis_icon_'.$id.':hover .cesis_icon_shape:after{
					border-bottom: '.$hexa_b_size.'px solid '.$h_icon_border_color.';
					border-left: '.$hexa_b_size.'px solid '.$h_icon_border_color.';
					}';
				}

				$output .= '</style>';

			}
			elseif($shape == 'rounded'){
				$shape = 'style="'.$shadow_style.' border:'.$i_b_size.'px solid '.$icon_border_color.'; background:'.$new_bg.'; color:'.$icon_color.'; border-radius:'.$i_radius.'px;
				width:'.$i_bg_size.'px; height:'.$i_bg_size.'px; line-height:0; padding:'.$padding.'px 0; "';
			}
			elseif($shape == 'diamond'){
				$shape = 'style="'.$shadow_style.' border:'.$i_b_size.'px solid '.$icon_border_color.'; background:'.$new_bg.'; color:'.$icon_color.';
				width:'.$i_bg_size.'px; height:'.$i_bg_size.'px; line-height:0; padding:'.$padding.'px 0; "';
				$i_radius = '0';
				$additional_class .= 'cesis_icon_diamond ';

			}else{
				$shape = 'style="'.$shadow_style.' border:'.$i_b_size.'px solid '.$icon_border_color.'; background:'.$new_bg.'; color:'.$icon_color.';
				width:'.$i_bg_size.'px; height:'.$i_bg_size.'px; line-height:0; padding:'.$padding.'px 0; "';
				$i_radius = '0';
			}

		}else{
			if($use_gradient !== '' && $icon_alt_bg_color !== '' &&  $h_icon_alt_bg_color == '' && !$msie){
				$i_style .= ' color:'.$icon_color.'; background: -webkit-linear-gradient('.$icon_color.','.$icon_alt_bg_color.');';
				$hv_style = 'onmouseleave="this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'linear-gradient('.$icon_color.','.$icon_alt_bg_color.')\';"
					onmouseenter="this.getElementsByClassName(\'cesis_icon_inner\')[0].style.color=\''.$h_icon_color.'\'; this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'none\';"';
			}elseif($use_gradient !== '' && $icon_alt_bg_color !== '' &&  $h_icon_alt_bg_color !== '' && !$msie){
				$i_style .= ' color:'.$icon_color.'; background: -webkit-linear-gradient('.$icon_color.','.$icon_alt_bg_color.');';
				$hv_style = 'onmouseleave="this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'linear-gradient('.$icon_color.','.$icon_alt_bg_color.')\';"
				onmouseenter="this.getElementsByClassName(\'cesis_icon_inner\')[0].style.color=\''.$h_icon_color.'\'; this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'linear-gradient('.$h_icon_color.','.$h_icon_alt_bg_color.')\';"';
			}elseif($use_gradient !== '' &&  $h_icon_alt_bg_color !== '' && !$msie){
				$i_style .= ' color:'.$icon_color.'; background:none;';
				$hv_style = 'onmouseleave="this.getElementsByClassName(\'cesis_icon_inner\')[0].style.color=\''.$icon_color.'\'; this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'none\';"
				onmouseenter="this.getElementsByClassName(\'cesis_icon_inner\')[0].style.color=\''.$h_icon_color.'\'; this.getElementsByClassName(\'cesis_icon_inner\')[0].style.background=\'linear-gradient('.$h_icon_color.','.$h_icon_alt_bg_color.')\';"';
			}else{
				$shape = 'style="color:'.$icon_color.'; "';
				$hv_style = 'onmouseleave="this.style.color=\''.$icon_color.'\';"	onmouseenter="this.style.color=\''.$h_icon_color.'\';"';
			}

		}




		$icon_extra_class = 'cesis_icon_ctn '.$position.' '.$gradient.'';

		$output .= '<div id="cesis_icon_'.$id.'" class="' .$icon_extra_class. '">';
		$output .= '<div class="cesis_icon_shape '.$additional_class.'" '.$shape.' '.$hv_style.'>'.$hover_ctn.'<i class="cesis_icon_inner '.$icon.'" style="'.$i_style.'"></i></div>';
		$output .= '</div>';
		$output .='</div>';


	}
	$output .='<canvas class="cesis_circular_pb_canvas" id="cesis_cpb_canvas_'.$id.'" style="width:'.$canvas_size.'px;" width="'.$n_canvas_size.'" height="'.$n_canvas_size.'"
	 data-speed="'.$speed.'" data-linecap="'.$linecap.'" data-bar-size="'.$bar_size.'" data-track-size="'.$track_size.'" data-canvas-size="'.$canvas_size.'" data-radius="'.$radius.'" data-percentage-value="'.$percentage.'" data-track-color="'.$track_color.'" data-bar-color="'.$bar_color.'" data-bar-alt-color="'.$bar_alt_color.'" >Your browser does not support the HTML5 canvas tag.</canvas>';



$output .='</div>';


echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;



}



}
}
