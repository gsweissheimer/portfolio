<?php

if (!class_exists('WPBakeryShortCode_cesis_breadcrumb')) {
class WPBakeryShortCode_cesis_breadcrumb extends WPBakeryShortCode {



protected function content( $atts, $content = null ) {

global $cesis_data;

	extract(shortcode_atts(array(
		'pos'   => 'cesis_breadcrumb_left',
		'bread_color' => '',
		'bread_hover_color' => '',
		'force_font' => '',
		'font' => 'main_font',
		'f_size' => '14px',
		'f_weight' => '400',
		't_transform' => 'none',
		'l_spacing' => '0',
		'google_fonts' => '',
    'margin_top' => '0',
    'margin_bottom' => '0',
		'hide_lg' => '',
		'hide_md' => '',
		'hide_sm' => '',
		'el_class' => ''

    ), $atts));


/* default color settings from theme options */

if($bread_color !== '' ){
	$button_text_color = "#ffffff";
}
if($bread_hover_color !== ''){
}

ob_start();


$output = $additional_class = $style = '';
$id = RandomString(20);


$style = 'margin-top:'.$margin_top.'px; ';
$style .= 'margin-bottom:'.$margin_bottom.'px; ';

/* Font settings */
if($force_font !== ''){
$settings = get_option( 'wpb_js_google_fonts_subsets' );
if ( is_array( $settings ) && ! empty( $settings ) ) {
	$subsets = '&subset=' . implode( ',', $settings );
} else {
	$subsets = '';
}
$google_fonts_field_settings = isset( $google_fonts_field['settings'], $google_fonts_field['settings']['fields'] ) ? $google_fonts_field['settings']['fields'] : array();
$google_fonts_obj = new Vc_Google_Fonts();
$google_fonts_data = strlen( $google_fonts ) > 0 ? $google_fonts_obj->_vc_google_fonts_parse_attributes( $google_fonts_field_settings, $google_fonts ) : '';
if ( isset( $google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}
if ( $font == 'custom' && ! empty( $google_fonts_data ) && isset( $google_fonts_data['values'], $google_fonts_data['values']['font_family'], $google_fonts_data['values']['font_style'] ) ) {
	$google_fonts_family = explode( ':', $google_fonts_data['values']['font_family'] );
	$style .= 'font-family:' . $google_fonts_family[0].'; ';
	$google_fonts_styles = explode( ':', $google_fonts_data['values']['font_style'] );
	$f_weight = $google_fonts_styles[1];
	$style .= 'font-style:' . $google_fonts_styles[2].';';
	$style .= 'font-size:'.$f_size.'; font-weight:'.$f_weight.'; text-transform:'.$t_transform.'; letter-spacing:'.$l_spacing.'px;';
	$font = '';
	$additional_class .= ' bread_custom_font';
}else{
	$style .= 'font-size:'.$f_size.'; font-weight:'.$f_weight.'; text-transform:'.$t_transform.'; letter-spacing:'.$l_spacing.'px;';
	$additional_class .= ' bread_custom_font';
}
}else{
	$font = '';
}
if($bread_color !== '' || $bread_hover_color !== ''){
	$output .= '<style>';
	if($bread_color !== ''){
		$output .= '#cesis_bread_'.$id.' .breadcrumb_container a,#cesis_bread_'.$id.' .bc_separator {color:'.$bread_color.';}';
	}
	if($bread_color !== ''){
		$output .= '#cesis_bread_'.$id.' .breadcrumb_container a:hover {color:'.$bread_hover_color.';}';
	}
	$output .= '</style>';
}


$el_class = $this->getExtraClass( $el_class );
$class_to_filter = 'cesis_breadcrumb_sc_ctn  '.$font.' '.$pos.''.$additional_class.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.' ';
$class_to_filter .= $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );


$output .= '<div id="cesis_bread_'.$id.'" class="'.$css_class.'" style="'.$style.'">';
$output .= do_shortcode('[breadcrumb]');
$output .= '</div>';




echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;


}
}

}
