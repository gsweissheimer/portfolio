<?php

if (!class_exists('WPBakeryShortCode_cesis_icon_list')) {
class WPBakeryShortCode_cesis_icon_list extends WPBakeryShortCode {



protected function content( $atts, $content = null ) {

global $cesis_data;

	extract(shortcode_atts(array(
		'style' => 'cesis_il_1',
		'values'   => '',
		'shadow'   => '',
		'target'   => '_self',
		'space'   => '20',
		'heading_color' => '',
		'h_heading_color' => '',
		'text_color' => '',
		'border_color' => '',
		'icon_color' => '',
		'icon_bg_color' => '',
		'icon_border_color' => '',
		'h_icon_color' => '',
		'h_icon_bg_color' => '',
		'h_icon_border_color' => '',
		'h_f_size' => '14px',
		'h_f_weight' => '700',
		'h_l_height' => '24px',
		'h_t_transform' => 'uppercase',
		'h_l_spacing' => '0',
		'heading_font' => 'alt_font',
		'h_google_fonts' => '',
		't_f_size' => '14px',
		't_f_weight' => '400',
		't_l_height' => '24px',
		't_t_transform' => 'none',
		't_l_spacing' => '0',
		'text_font' => 'main_font',
		'google_fonts' => '',
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


ob_start();


		$margin = 'margin-top:'.$margin_top.'px; ';
		$margin .= 'margin-bottom:'.$margin_bottom.'px; ';

		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}
		$h_google_fonts_field_settings = isset( $h_google_fonts_field['settings'], $h_google_fonts_field['settings']['fields'] ) ? $h_google_fonts_field['settings']['fields'] : array();
		$h_google_fonts_obj = new Vc_Google_Fonts();

		$h_google_fonts_data = strlen( $h_google_fonts ) > 0 ? $h_google_fonts_obj->_vc_google_fonts_parse_attributes( $h_google_fonts_field_settings, $h_google_fonts ) : '';

		$h_styles = 'font-size:'.$h_f_size.'; ';
		$h_styles .= 'letter-spacing:'.$h_l_spacing.'px; ';
		$h_styles .= 'line-height:'.$h_l_height.'; ';
		$h_styles .= 'text-transform:'.$h_t_transform.'; ';

		if($heading_color !== '') {
		$h_styles .= 'color:'.$heading_color.'; ';
	}if($heading_color !== '' && $h_heading_color !== ''){
		$h_hover='onmouseleave="this.style.color=\''.$heading_color.'\';"
		onmouseenter="this.style.color=\''.$h_heading_color.'\';"';
	}else{
		$h_hover = '';
	}

if ( isset( $h_google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $h_google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $h_google_fonts_data['values']['font_family'] . $subsets );
}

if ( $heading_font == 'custom' && ! empty( $h_google_fonts_data ) && isset( $h_google_fonts_data['values'], $h_google_fonts_data['values']['font_family'], $h_google_fonts_data['values']['font_style'] ) ) {
			$h_google_fonts_family = explode( ':', $h_google_fonts_data['values']['font_family'] );
			$h_styles .= 'font-family:' . $h_google_fonts_family[0].'; ';
			$h_google_fonts_styles = explode( ':', $h_google_fonts_data['values']['font_style'] );
			$h_styles .= 'font-weight:' . $h_google_fonts_styles[1].'; ';
			$h_styles .= 'font-style:' . $h_google_fonts_styles[2].';';
		}else{
			$h_styles .= 'font-weight:' .$h_f_weight.'; ';
		}

		$google_fonts_field_settings = isset( $google_fonts_field['settings'], $google_fonts_field['settings']['fields'] ) ? $google_fonts_field['settings']['fields'] : array();
		$google_fonts_obj = new Vc_Google_Fonts();

		$t_google_fonts_data = strlen( $google_fonts ) > 0 ? $google_fonts_obj->_vc_google_fonts_parse_attributes( $google_fonts_field_settings, $google_fonts ) : '';

		$t_styles = 'font-size:'.$t_f_size.'; ';
		$t_styles .= 'letter-spacing:'.$t_l_spacing.'px; ';
		$t_styles .= 'line-height:'.$t_l_height.'; ';
		$t_styles .= 'text-transform:'.$t_t_transform.'; ';

		if($text_color !== '') {
		$t_styles .= 'color:'.$text_color.'; ';
		}

if ( isset( $t_google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $t_google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $t_google_fonts_data['values']['font_family'] . $subsets );
}

if ( $text_font == 'custom' && ! empty( $t_google_fonts_data ) && isset( $t_google_fonts_data['values'], $t_google_fonts_data['values']['font_family'], $t_google_fonts_data['values']['font_style'] ) ) {
			$t_google_fonts_family = explode( ':', $t_google_fonts_data['values']['font_family'] );
			$t_styles .= 'font-family:' . $t_google_fonts_family[0].'; ';
			$t_google_fonts_styles = explode( ':', $t_google_fonts_data['values']['font_style'] );
			$t_styles .= 'font-weight:' . $t_google_fonts_styles[1].'; ';
			$t_styles .= 'font-style:' . $t_google_fonts_styles[2].';';
		}else{
			$t_styles .= 'font-weight:' .$t_f_weight.'; ';
		}

$el_class = $this->getExtraClass( $el_class );
$animation = $this->getCSSAnimation( $css_animation );



$class_to_filter = 'cesis_icon_list '.$style.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.' ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '<div class="' . esc_attr( $css_class ) . '"  data-delay="'.$delay.'" style="'.$margin.'">';

$hv_style='onmouseleave="this.getElementsByClassName(\'cesis_list_icon\')[0].style.borderColor=\''.$icon_border_color.'\'; this.getElementsByClassName(\'cesis_list_icon\')[0].style.backgroundColor=\''.$icon_bg_color.'\'; this.getElementsByClassName(\'cesis_list_icon\')[0].style.color=\''.$icon_color.'\';"
onmouseenter="this.getElementsByClassName(\'cesis_list_icon\')[0].style.borderColor=\''.$h_icon_border_color.'\'; this.getElementsByClassName(\'cesis_list_icon\')[0].style.backgroundColor=\''.$h_icon_bg_color.'\'; this.getElementsByClassName(\'cesis_list_icon\')[0].style.color=\''.$h_icon_color.'\';"';

$values = (array) vc_param_group_parse_atts( $values );
$graph_lists_data = array();
foreach ( $values as $data ) {
	$new_list = $data;
	$new_list['icon'] = isset( $data['icon'] ) ? $data['icon'] : '';
	$new_list['heading'] = isset( $data['heading'] ) ? $data['heading'] : '';
	$new_list['text'] = isset( $data['text'] ) ? $data['text'] : '';
	$new_list['link'] = isset( $data['link'] ) ? $data['link'] : '';

	$graph_lists_data[] = $new_list;
}
if($style == 'cesis_il_1' || $style == 'cesis_il_3' || $style == 'cesis_il_5'){
	$i_styles = 'color:'.$icon_color.';' ;
}
if($style == 'cesis_il_2' || $style == 'cesis_il_4' || $style == 'cesis_il_6'){
	$i_styles = 'color:'.$icon_color.'; background:'.$icon_bg_color.';  border-color:'.$icon_border_color.'; ';
}


if($border_color !== ''){
	$list_style = 'margin-bottom:'.$space.'px; border-color:'.$border_color.';';
	$ctn_list_style = 'padding-bottom:'.$space.'px;';
}
else {
	$list_style = 'margin-bottom:'.$space.'px;';
	$ctn_list_style = '';
}

foreach ( $graph_lists_data as $list ) {
	$list_title = $list_id = "";

	$output .= '<div class="cesis_single_list '.$animation.'" style="'.$list_style.'" data-delay="'.$delay.'">';
		if($list['heading'] !== ''){
			$i_styles .= 'line-height:'.$h_l_height.'; ';
		}
		if($list['heading'] == '' && $list['text'] !== ''){
			$i_styles .= 'line-height:'.$t_l_height.'; ';
		}
		if($list['icon'] !== '' && $style == 'cesis_il_6'){
			$list_icon = '<div class="cesis_list_icon_wrapper"><span class="cesis_list_icon_line" style="background-color:'.$icon_border_color.'"></span><span class="cesis_list_icon_bg" style="background-color:'.$icon_bg_color.'; border-color:'.$icon_border_color.'"></span><i class="cesis_list_icon ' . $list['icon'] .' '.$shadow.'" style="'.$i_styles.'"></i></div>';
		}
		elseif($list['icon'] !== ''){
			$list_icon = '<i class="cesis_list_icon ' . $list['icon'] .' '.$shadow.'" style="'.$i_styles.'"></i>';
		}
		else {
			$list_icon = '';
		}
		if($list['heading'] !== ''){
			$list_title = '<h4 class="cesis_list_heading '.$heading_font.' " style="'.$h_styles.'" '.$h_hover.'>' . $list['heading'] .'</h4>';
		}
		else {
			$list_title = '';
		}
		if($list['text'] !== ''){
			$list_text = '<p class="cesis_list_text '.$text_font.'" style="'.$t_styles.'">' . $list['text'] .'</p>';
		}
		else {
			$list_text = '';
		}
	if($list['link'] !== ''){
		if($target !== 'cesis_lightbox'){
			$output .= '<div class="cesis_icon_list_ctn" '.$hv_style.' style="'.$ctn_list_style.'"><a href="'.$list['link'].'" target="'.$target.'">'.$list_icon.'<span class="cesis_icon_list_txt_ctn">'.$list_title.' '.$list_text.'</span></a></div>';
		}else{
			$output .= '<div class="cesis_icon_list_ctn" '.$hv_style.' style="'.$ctn_list_style.'"><a href="'.$list['link'].'" data-src="'.$list['link'].'" class="cesis_lightbox_el">'.$list_icon.'<span class="cesis_icon_list_txt_ctn">'.$list_title.' '.$list_text.'</span></a></div>';
		}
	}else{
			$output .= '<div class="cesis_icon_list_ctn" '.$hv_style.' style="'.$ctn_list_style.'">'.$list_icon.'<span class="cesis_icon_list_txt_ctn">'.$list_title.' '.$list_text.'</span></div>';
	}

	$output .= '</div>';
}

$output .= '</div>';

echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;


}
}

}
