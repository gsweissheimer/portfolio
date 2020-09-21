<?php

if (!class_exists('WPBakeryShortCode_cesis_icon')) {
class WPBakeryShortCode_cesis_icon extends WPBakeryShortCode {



protected function content( $atts, $content = null ) {

global $cesis_data;

	extract(shortcode_atts(array(
		'icon' => '',
		'i_size'   => '40',
		'use_gradient' => '',
		'use_shape' => '',
		'shape' => 'rounded',
		'position'   => 'i_float_none',
		'link'   => '',
		'target'   => '_self',
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
		'i_bg_size' => '110',
		'i_b_size' => '0',
		'i_radius'   => '100',
		'css'   => '',
 		'css_animation' => '',
 		'delay' => '0',
    'margin_left' => '0',
    'margin_right' => '0',
    'margin_top' => '0',
    'margin_bottom' => '0',
		'hide_lg' => '',
		'hide_md' => '',
		'hide_sm' => '',
		'el_class' => ''

    ), $atts));

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

ob_start();

$output = $additional_class = $gradient = $leave_shadow = $enter_shadow = $shadow_style = $hover_ctn = '';
$id = RandomString(20);


if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
$msie = true;
}else{
$msie = false;
}


/* Space settings */

$margin = 'padding-top:'.$margin_top.'px; ';
$margin .= 'padding-bottom:'.$margin_bottom.'px; ';
if($position == 'i_float_left' || $position == 'i_float_right'){
	$margin .= 'margin-right:'.$margin_right.'px; ';
	$margin .= 'margin-left:'.$margin_left.'px; ';
}


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




$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$class_to_filter = 'cesis_icon_ctn cesis_custom_lg '.$position.' '.$gradient.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.' ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output .= '<div id="cesis_icon_'.$id.'" class="' . esc_attr( $css_class ) . '" data-delay="'.$delay.'" style="'.$margin.'">';

if($link !== ''){
	if($target !=='cesis_lightbox'){
		$output .= '<a href="'.$link.'" target="'.$target.'">';
	}
	else{
		$output .= '<a href="'.$link.'" data-src="'.$link.'" class="cesis_lightbox_el">';
	}
}

$output .= '<div class="cesis_icon_shape '.$additional_class.'" '.$shape.' '.$hv_style.'>'.$hover_ctn.'<i class="cesis_icon_inner '.$icon.'" style="'.$i_style.'"></i></div>';


if($link !== ''){
$output .= '</a>';
}

$output .= '</div>';


echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;


}
}

}
