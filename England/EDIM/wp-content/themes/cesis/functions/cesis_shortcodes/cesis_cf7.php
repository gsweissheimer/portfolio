<?php

if (!class_exists('WPBakeryShortCode_cesis_cf7')) {
class WPBakeryShortCode_cesis_cf7 extends WPBakeryShortCode {



protected function content( $atts, $content = null ) {

global $cesis_data;

	extract(shortcode_atts(array(
		'contact_id' => '',
		'type' => 'cesis_cf7_vertical',
		'horizontal_number' => '2',
		'f_space' => 'cesis_cf7_medium',
		'f_custom_space' => '20',
		'height' => '200',
		'f_radius' => '0',
		'button_type' => 'cesis_cf7_btn',
		'btn_size' => 'cesis_cf7_small_btn',
		'btn_width' => '',
		'btn_radius' => '0',
		'btn_top_space' => '0',
		'f_style' => '',
		'f_text_color' => '0',
		'f_place_holder' => '',
		'f_text_transform' => 'cesis_cf7_none',
		'f_font_weight' => 'cesis_cf7_400',
		'f_bg_color' => '',
		'f_b_color' => '',
		'button_text_color' => '',
		'button_bg_color' => '',
		'button_border_color' => '',
		'button_h_text_color' => '',
		'button_h_bg_color' => '',
		'button_h_border_color' => '',
		'font_weight' => '400',
		'button_google_fonts'   => '',
		'button_f_size'   => '14px',
		'button_t_transform'   => 'uppercase',
		'button_l_spacing'   => '0',
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

/* default color settings from theme options */


ob_start();

$output = $style = $custom_style = $button_style = '';
$id = RandomString(20);


if($type == 'cesis_cf7_horizontal'){
	if($f_space == 'custom'){
		if($horizontal_number == 4){
			$custom_style .= '#cesis_cf7_'.$id.' p:nth-of-type(1),
			#cesis_cf7_'.$id.' p:nth-of-type(2),
			#cesis_cf7_'.$id.' p:nth-of-type(3)
			{	margin-right:'.$f_custom_space.'px; }';
			$custom_style .= '#cesis_cf7_'.$id.' p:nth-of-type(1),
			#cesis_cf7_'.$id.' p:nth-of-type(2),
			#cesis_cf7_'.$id.' p:nth-of-type(3),
			#cesis_cf7_'.$id.' p:nth-of-type(4){	width:calc((100%/'.$horizontal_number.') - ('.($f_custom_space*3).'px/'.$horizontal_number.')); }';
		}elseif($horizontal_number == 3){
			$custom_style .= '#cesis_cf7_'.$id.' p:nth-of-type(1),
			#cesis_cf7_'.$id.' p:nth-of-type(2)
			{	margin-right:'.$f_custom_space.'px; }';
			$custom_style .= '#cesis_cf7_'.$id.' p:nth-of-type(1),
			#cesis_cf7_'.$id.' p:nth-of-type(2),
			#cesis_cf7_'.$id.' p:nth-of-type(3){	width:calc((100%/'.$horizontal_number.') - ('.($f_custom_space*2).'px/'.$horizontal_number.')); }';
		}elseif($horizontal_number == 2){
			$custom_style .= '#cesis_cf7_'.$id.' p:nth-of-type(1)
			{	margin-right:'.$f_custom_space.'px; }';
			$custom_style .= '#cesis_cf7_'.$id.' p:nth-of-type(1),
			#cesis_cf7_'.$id.' p:nth-of-type(2){	width:calc((100%/'.$horizontal_number.') - ('.$f_custom_space.'px/'.$horizontal_number.')); }';
		}
	}
	$horizontal_number = '_'.$horizontal_number;
}else{
	$horizontal_number = '';
}
if($f_space == 'custom'){
	$custom_style .= '#cesis_cf7_'.$id.' p {margin:0 0 '.$f_custom_space.'px 0;}#cesis_cf7_'.$id.' label input,#cesis_cf7_'.$id.' label textarea{margin-top:'.($f_custom_space/2).'px;}';
}
if($f_radius !== '0'){
	$custom_style .= '#cesis_cf7_'.$id.' input:not([type="submit"]):not([type="checkbox"]):not([type="radio"]):not([type="file"]),
	#cesis_cf7_'.$id.' textarea,#cesis_cf7_'.$id.' select{border-radius:'.$f_radius.'px;}';
}
if($height !== '200'){
	$custom_style .= '#cesis_cf7_'.$id.' textarea{height:'.$height.'px;}';
}
if($btn_radius !== '0'){
	$custom_style .= '#cesis_cf7_'.$id.' input[type="submit"]{border-radius:'.$btn_radius.'px;}';
}
if($f_style == 'custom'){
	$custom_style .= '#cesis_cf7_'.$id.' input:not([type="submit"]):not([type="checkbox"]):not([type="radio"]):not([type="file"]),
	#cesis_cf7_'.$id.' textarea,#cesis_cf7_'.$id.' select,#cesis_cf7_'.$id.' label{color:'.$f_text_color.'; background:'.$f_bg_color.'; border-color:'.$f_b_color.';}';
	$custom_style .= '#cesis_cf7_'.$id.' textarea::-webkit-input-placeholder,#cesis_cf7_'.$id.' input::-webkit-input-placeholder{	color:'.$f_place_holder.'; 	}';
}
if($button_type == 'custom'){
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
	if ( $button_type == 'custom' && ! empty( $b_google_fonts_data ) && isset( $b_google_fonts_data['values'], $b_google_fonts_data['values']['font_family'], $b_google_fonts_data['values']['font_style'] ) ) {
		$b_google_fonts_family = explode( ':', $b_google_fonts_data['values']['font_family'] );
		$button_style .= 'font-family:' . $b_google_fonts_family[0].'; ';
		$b_google_fonts_styles = explode( ':', $b_google_fonts_data['values']['font_style'] );
		$button_style .= 'font-weight:' . $b_google_fonts_styles[1].'; ';
		$button_style .= 'font-style:' . $b_google_fonts_styles[2].'; ';
	}
	$custom_style .= '#cesis_cf7_'.$id.' input[type="submit"]{'.$button_style.' color:'.$button_text_color.'; background:'.$button_bg_color.'; border:1px solid '.$button_border_color.'; font-size:'.$button_f_size.'; text-transform:'.$button_t_transform.'; letter-spacing:'.$button_l_spacing.'px;}';
	$custom_style .= '#cesis_cf7_'.$id.' input:hover[type="submit"]{color:'.$button_h_text_color.'; background:'.$button_h_bg_color.'; border:1px solid '.$button_h_border_color.';}';
}
if($btn_top_space !== '0'){
$custom_style .= '#cesis_cf7_'.$id.' input[type="submit"]{margin-top:'.$btn_top_space.'px;}';
}
if($custom_style !== ''){
	$output .= '<style>'.$custom_style.'</style>';
}

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$class_to_filter = 'cesis_cf7_ctn '.$type.$horizontal_number.' '.$f_space.' '.$f_style.' '.$button_type.' '.$btn_size.' '.$btn_width.' '.$el_class.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.' '.$f_font_weight.' '.$f_text_transform.' ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output .= '<div id="cesis_cf7_'.$id.'" class="' . esc_attr( $css_class ) . '" data-delay="'.$delay.'" style="font-weight:'.$font_weight.'; margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;">';
$output .= do_shortcode('[contact-form-7 id="'.$contact_id.'" ]');
$output .='</div>';


echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;


}
}

}
