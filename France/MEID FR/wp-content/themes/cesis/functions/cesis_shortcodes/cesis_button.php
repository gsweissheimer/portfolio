<?php

if (!class_exists('WPBakeryShortCode_cesis_button')) {
class WPBakeryShortCode_cesis_button extends WPBakeryShortCode {



protected function content( $atts, $content = null ) {

global $cesis_data;

	extract(shortcode_atts(array(
		'button_text' => 'button',
		'link'   => '',
		'target'   => '_self',
		'button_pos'   => 'cesis_button_left',
		'button_size'   => 'cesis_button_small',
		'button_width'   => '180px',
		'button_height'   => '45px',
		'button_border' => '0',
		'button_radius' => '0',
		'use_gradient' => '',
		'use_icon' => '',
		'icon' => '',
		'icon_pos' => 'cesis_button_icon_left',
		'icon_style' => 'normal',
		'icon_animation' => 'none',
		'hover' => 'none',
		'shadow_type' => 'none',
		'shadow_hover' => 'always',
		'button_text_color' => '',
		'button_bg_color' => '',
		'button_alt_bg_color' => '',
		'button_border_color' => '',
		'h_button_text_color' => '',
		'h_button_bg_color' => '',
		'h_button_alt_bg_color' => '',
		'h_button_border_color' => '',
		'shadow_color' => '',
		'button_f_size' => '14px',
		'button_f_weight' => '700',
		'button_t_transform' => 'uppercase',
		'button_l_spacing' => '0',
		'button_font' => 'main_font',
		'button_google_fonts' => '',
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
		'no_follow' => 'no',
		'el_class' => ''

    ), $atts));


/* default color settings from theme options */

if($button_text_color == '' ){
	$button_text_color = "#ffffff";
}
if($button_bg_color == ''){
	$button_bg_color = $cesis_data["cesis_main_content_accent_one"];
}
if($button_border_color == ''){
	$button_border_color = $cesis_data["cesis_main_content_accent_one"];
}
if($h_button_text_color == ''){
	$h_button_text_color = "#ffffff";
}
if($h_button_bg_color == ''){
	$h_button_bg_color = $cesis_data["cesis_main_content_accent_two"];
}
if($h_button_border_color == ''){
	$h_button_border_color = $cesis_data["cesis_main_content_accent_two"];
}

ob_start();


$output = $additional_class = $gradient = $leave_shadow = $enter_shadow = $shadow_style = $shadow_style_hover = $hover_ctn = $btn_content = $button_style = $i_class = '';
$id = RandomString(20);

if($no_follow !== "no"){
	$no_follow = 'rel="nofollow"';
}else{
	$no_follow = '';
}

$margin = 'margin-top:'.$margin_top.'px; ';
$margin .= 'margin-bottom:'.$margin_bottom.'px; ';
$margin .= 'margin-right:'.$margin_right.'px; ';
$margin .= 'margin-left:'.$margin_left.'px; ';

/* Font settings */

$settings = get_option( 'wpb_js_google_fonts_subsets' );
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
} else {
	$subsets = '';
}
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

if($use_gradient !== '' && $button_alt_bg_color !== ''){
	if($hover !== '3d'){
		$gradient .= 'cesis_icon_gradient cesis_use_shape';
	}else{
		$gradient .= 'cesis_icon_gradient';
	}
}
if($use_gradient !== '' && $h_button_alt_bg_color !== ''){
	if($hover !== '3d'){
		$gradient .= 'cesis_h_icon_gradient cesis_use_shape';
	}else{
		$gradient .= 'cesis_h_icon_gradient';
	}
}

/* Shadow settings */

if($shadow_type !== 'none'){
	if($shadow_color !== ''){
		if($shadow_type == 'dropdown'){
			$shadow_config = "0 14px 28px ".$shadow_color.", 0 10px 10px ".$shadow_color."";
		}elseif($shadow_type == 'blur'){
			$shadow_config = "0 0 15px ".$shadow_color."";
		}elseif($shadow_type == 'solid'){
			$shadow_config = "5px 5px 0 0 ".$shadow_color."";
		}
	}else{
		if($shadow_type == 'dropdown'){
			$shadow_config = "0 14px 28px rgba(0,0,0,0.25), 0 10px 10px rgba(0,0,0,0.22)";
		}elseif($shadow_type == 'blur'){
			$shadow_config = "0 0 15px rgba(0,0,0,0.25)";
		}elseif($shadow_type == 'solid'){
			$shadow_config = "5px 5px 0 0 rgba(0, 0, 0, 0.30)";
		}
	}

	$enter_shadow = $leave_shadow = "this.style.boxShadow='".$shadow_config."';";
	if($shadow_hover == 'hover'){
		$leave_shadow = "this.style.boxShadow='none';";
		$shadow_style = "box-shadow:none;";
		$shadow_style_hover = "box-shadow:".$shadow_config.";";
	}elseif($shadow_hover == 'off_hover'){
		$enter_shadow = "this.style.boxShadow='none';";
	}
	if($shadow_hover == 'always' || $shadow_hover == 'off_hover' ){
		$shadow_style = "box-shadow:".$shadow_config.";";
		$shadow_style_hover = "box-shadow:".$shadow_config.";";
	}
}else{
	$leave_shadow = $enter_shadow = $shadow_style = '';
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

	if($use_gradient !== '' && $button_alt_bg_color !== ''){
		$new_bg = 'linear-gradient('.$button_bg_color.','.$button_alt_bg_color.')';
	}else{
		$new_bg = $button_bg_color;
	}
	if($use_gradient !== '' && $h_button_alt_bg_color !== ''){
		$new_h_bg = 'linear-gradient('.$h_button_bg_color.','.$h_button_alt_bg_color.')';
	}else{
		$new_h_bg = $h_button_bg_color;
	}
	$hv_style='onmouseleave="'.$leave_shadow.' this.style.borderColor=\''.$button_border_color.'\'; this.style.background=\''.$new_bg.'\'; this.style.color=\''.$button_text_color.'\';"
	onmouseenter="'.$enter_shadow.' this.style.borderColor=\''.$h_button_border_color.'\'; this.style.background=\''.$new_h_bg.'\'; this.style.color=\''.$h_button_text_color.'\';"';

	if($hover !== 'none' && $hover !== 'grow' && $hover !== 'shrink' && $hover !== 'shine' && $hover !== '3d'){
		$additional_class .= 'cesis_has_hover';
		if($hover == 'trim'){
			$h_border_color = $h_button_text_color;
		}else{
			$h_border_color = $h_button_border_color;
		}
		if($button_border == '0' || $button_border == '0' ){ $button_n_border = '2';}else{$button_n_border = $button_border;}
		$hover_ctn = '<span class="cesis_h_'.$hover.'" style="border-color:'.$h_border_color.'; border-radius:'.$button_radius.'px; border-width:'.$button_n_border.'px;"></span>';
		$btn_content .= $hover_ctn ;
	}elseif($hover == 'shine' ){
		$additional_class .= 'cesis_has_hover cesis_overflow_hidden ';
		$hover_ctn = '<span class="cesis_h_'.$hover.'"></span>';
		$btn_content .= $hover_ctn ;
	}elseif($hover !== 'none'){
		$additional_class .= 'cesis_has_hover cesis_h_'.$hover.' ';
	}


	if($hover == '3d'){
		$hv_style = '';
		$button_style .= 'font-size:'.$button_f_size.'; font-weight:'.$button_f_weight.'; line-height:'.$button_l_height.'; text-transform:'.$button_t_transform.'; letter-spacing:'.$button_l_spacing.'px;';
		$btn_content = '<span class="cesis_button_heads" style="transform: translate3d(0, 0, '.$button_3d_height.'px); -webkit-transform: translate3d(0, 0, '.$button_3d_height.'px);
		'.$shadow_style.' border:'.$button_border.'px solid '.$button_border_color.'; border-radius:'.$button_radius.'px; background:'.$new_bg.'; color:'.$button_text_color.';">'.$button_text.'</span>';
		if($use_icon !== '' && $icon !== '' ){
			$btn_content .= '<span class="cesis_button_tails '.$icon.'" style="transform: rotateX(90deg) translate3d(0, 0, '.$button_3d_height.'px); -webkit-transform: rotateX(90deg) translate3d(0, 0, '.$button_3d_height.'px);
			 '.$shadow_style_hover.' border:'.$button_border.'px solid '.$h_button_border_color.';  border-radius:'.$button_radius.'px; background:'.$new_h_bg.'; color:'.$h_button_text_color.'; line-height:'.$button_l_height.'; "></span>';
		}else{
			$btn_content .= '<span class="cesis_button_tails" style="transform: rotateX(90deg) translate3d(0, 0, '.$button_3d_height.'px); -webkit-transform: rotateX(90deg) translate3d(0, 0, '.$button_3d_height.'px);
			 '.$shadow_style_hover.' border:'.$button_border.'px solid '.$h_button_border_color.';  border-radius:'.$button_radius.'px; background:'.$new_h_bg.'; color:'.$h_button_text_color.';">'.$button_text.'</span>';
		}
	}else{

		$button_style .= 'font-size:'.$button_f_size.'; font-weight:'.$button_f_weight.'; line-height:'.$button_l_height.'; text-transform:'.$button_t_transform.'; letter-spacing:'.$button_l_spacing.'px;
		border:'.$button_border.'px solid '.$button_border_color.'; border-radius:'.$button_radius.'px;  background:'.$new_bg.'; color:'.$button_text_color.';';

		if($use_icon !== '' && $icon !== ''){
			if($icon_style == 'boxed'){
				$i_class .= 'cesis_button_icon_boxed ';
			}
			if($icon_animation == 'hover'){
				$i_class .= 'cesis_button_icon_hover ';
			}elseif($icon_animation == 'grow_hover'){
				$i_class .= 'cesis_button_icon_grow_hover ';
			}elseif($icon_animation == 'none'){
				$i_class .= 'cesis_button_icon_always ';
			}
			$i_class .= $icon_pos;
		}

		$btn_content .= '<span class="cesis_button_sub_ctn '.$i_class.'">';
		if($use_icon !== '' && $icon !== '' && $icon_pos == 'cesis_button_icon_left'){
			$btn_content .= '<i class="cesis_icon_inner '.$icon.'" style="line-height:'.$button_l_height.';"></i>';
		}

		$btn_content .= '<span class="cesis_button_text">'.$button_text.'</span>';

		if($use_icon !== '' && $icon !== '' && $icon_pos == 'cesis_button_icon_right'){
			$btn_content .= '<i class="cesis_icon_inner '.$icon.'"  style="line-height:'.$button_l_height.';"></i>';
		}
		$btn_content .= '</span>';
	}









if($button_pos == 'center' && $hover !== '3d'){
	$output .= '<div class="cesis_button_center">';
}

if($hover == '3d'){
	$output .= '<div class="cesis_3d_hover_ctn '.$button_pos.'">';
	$button_pos = '';
}

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$class_to_filter = 'cesis_button_ctn '.$button_font.' '.$button_size.' '.$button_pos.' '.$gradient.' '.$additional_class.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.' ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

if($target !== 'cesis_lightbox'){
	$output .= '<a href="'.$link.'" target="'.$target.'" '.$no_follow.' id="cesis_button_'.$id.'" class="' . esc_attr( $css_class ) . '" data-delay="'.$delay.'" style="'.$margin.' '.$shadow_style.' '.$button_style.'" '.$hv_style.'>';
}else{
	$output .= '<a href="'.$link.'" data-src="'.$link.'" id="cesis_button_'.$id.'" class="' . esc_attr( $css_class ) . ' cesis_lightbox_el" data-delay="'.$delay.'" style="'.$margin.' '.$shadow_style.' '.$button_style.'" '.$hv_style.'>';
}

$output .= $btn_content;

$output .= '</a>';

if($hover == '3d'){
	$output .= '</div>';
}
if($button_pos == 'center' && $hover !== '3d'){
	$output .= '</div>';
}




echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;


}
}

}
