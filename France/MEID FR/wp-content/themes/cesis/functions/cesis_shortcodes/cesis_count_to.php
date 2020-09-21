<?php

if (!class_exists('WPBakeryShortCode_cesis_count_to')) {
class WPBakeryShortCode_cesis_count_to extends WPBakeryShortCode {



protected function content( $atts, $content = null ) {

global $cesis_data;

	extract(shortcode_atts(array(

		'number'   => '1000',
		'd'   => '',
		'd_number'   => '',
		'd_separator'   => '.',
		'use_separator'   => '',
		'separator'   => ',',
		'speed'   => '2',
		'prefix'   => '',
		'suffix'   => '',
		'number_size'   => '30px',
		'number_weight'   => '400',
		'number_spacing'   => '0',
		'number_color'   => '',
		'count_font'   => 'main_font',
		'google_fonts' => '',
    'margin_top' => '0',
    'margin_bottom' => '0',
		'hide_lg' => '',
		'hide_md' => '',
		'hide_sm' => '',
		'el_class' => ''

    ), $atts));

		if($use_separator !== 'yes'){
			$separator = '';
		}
		$settings = get_option( 'wpb_js_google_fonts_subsets' );
		if ( is_array( $settings ) && ! empty( $settings ) ) {
			$subsets = '&subset=' . implode( ',', $settings );
		} else {
			$subsets = '';
		}
		$google_fonts_field_settings = isset( $google_fonts_field['settings'], $google_fonts_field['settings']['fields'] ) ? $google_fonts_field['settings']['fields'] : array();
		$google_fonts_obj = new Vc_Google_Fonts();
		$google_fonts_data = strlen( $google_fonts ) > 0 ? $google_fonts_obj->_vc_google_fonts_parse_attributes( $google_fonts_field_settings, $google_fonts ) : '';

		$styles = 'font-size:'.$number_size.'; ';
		$styles .= 'line-height:'.$number_size.'; ';
		$styles .= 'letter-spacing:'.$number_spacing.'px; ';
		$styles .= 'margin-top:'.$margin_top.'px; ';
		$styles .= 'margin-bottom:'.$margin_bottom.'px; ';

		if($number_color !== '') {
		$styles .= 'color:'.$number_color.'; ';
		}

if ( isset( $google_fonts_data['values']['font_family'] ) ) {
	wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $google_fonts_data['values']['font_family'] . $subsets );
}

if ( $count_font == 'custom' && ! empty( $google_fonts_data ) && isset( $google_fonts_data['values'], $google_fonts_data['values']['font_family'], $google_fonts_data['values']['font_style'] ) ) {
			$google_fonts_family = explode( ':', $google_fonts_data['values']['font_family'] );
			$styles .= 'font-family:' . $google_fonts_family[0].'; ';
			$google_fonts_styles = explode( ':', $google_fonts_data['values']['font_style'] );
			$styles .= 'font-weight:' . $google_fonts_styles[1].'; ';
			$styles .= 'font-style:' . $google_fonts_styles[2].';';
			$count_font = '';
}else{
	$styles .= 'font-weight:' . $number_weight.'; ';
}

$id = 'cesis_count_to_'.RandomString(10);

$output = '<div class="cesis_count_to_ctn '.$el_class.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.'">';

$output .= '<span class="cesis_count_to '.$count_font.'" id="'.$id.'" style="'.$styles.'" data-number="'.$number.'" data-speed="'.$speed.'" data-separator="'.$separator.'" data-decimal="'.$d_number.'" data-d_separator="'.$d_separator.'" data-prefix="'.$prefix.'" data-suffix="'.$suffix.'"  >0</span>';


$output .= '</div>';

return $output;



}


}

}
