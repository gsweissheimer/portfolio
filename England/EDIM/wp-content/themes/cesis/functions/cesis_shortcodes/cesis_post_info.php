<?php

if (!class_exists('WPBakeryShortCode_cesis_post_info')) {
class WPBakeryShortCode_cesis_post_info extends WPBakeryShortCode {



protected function content( $atts, $content = null ) {

global $cesis_data;
global $post;
	extract(shortcode_atts(array(
		'pos'   => 'cesis_pi_left',
		'i_author' => 'no',
		'i_date' => 'no',
		'i_category' => 'no',
		'i_tag' => 'no',
		'i_comment' => 'no',
		'i_like' => 'no',
		'i_sep' => 'no',
		'i_space' => 'no',
		'i_space_val' => '30',
		'pi_color' => '',
		'pi_hover_color' => '',
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
	$additional_class .= ' pi_custom_font';
}else{
	$style .= 'font-size:'.$f_size.'; font-weight:'.$f_weight.'; text-transform:'.$t_transform.'; letter-spacing:'.$l_spacing.'px;';
	$additional_class .= ' pi_custom_font';
}
}else{
	$font = '';
}
if($pi_color !== '' || $pi_hover_color !== '' || $i_space == 'yes'){
	$output .= '<style>';
	if($pi_color !== ''){
		$output .= '#cesis_pi_'.$id.' a,#cesis_pi_'.$id.' {color:'.$pi_color.';}';
	}
	if($pi_color !== ''){
		$output .= '#cesis_pi_'.$id.' a:hover {color:'.$pi_hover_color.';}';
	}
	$output .= '</style>';
}
if($i_sep == 'yes'){
	$additional_class .= ' pi_has_sep';
}


$el_class = $this->getExtraClass( $el_class );
$class_to_filter = 'cesis_post_info_sc_ctn  '.$font.' '.$pos.''.$additional_class.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.' ';
$class_to_filter .= $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
$author_id = $post->post_author;
$author_name = get_the_author_meta('display_name', $author_id);
$author = '<span class="cesis_blog_m_author">'. $author_name.'</span>';
$date = '<span class="cesis_blog_m_date">'.get_the_time(get_option('date_format')).'</span>';
if(get_post_type() == 'post'){
	$cat_list = '<span class="cesis_blog_m_category">'.get_the_category_list(', ').'</span>';
	$tag_list = '<span class="cesis_blog_m_tag">'.get_the_tag_list('',', ').'</span>';
}elseif(get_post_type() == 'portfolio'){
	$cat_list = '<span class="cesis_portfolio_m_category">'.get_the_term_list('','portfolio_category', '',' ','').'</span>';
	$tag_list = '<span class="cesis_portfolio_m_tag">'.get_the_term_list('','portfolio_tag', '',' ','').'</span>';
}else{
	$cat_list =	$tag_list ='';
}
$comments = '<span class="cesis_blog_m_comment">'.cesis_get_comments().'</span>';

$output .= '<div id="cesis_pi_'.$id.'" class="'.$css_class.'" style="'.$style.'">';


if($i_author == 'yes' ){$output .= $author;}
if($i_date == 'yes' ){$output .= $date;}
if($i_category == 'yes'){$output .= $cat_list;}
if($i_tag == 'yes'){$output .= $tag_list;}
if($i_comment == 'yes'){$output .= $comments;}
if($i_like == 'yes' && function_exists('zilla_likes') ){	$output .= do_shortcode('[zilla_likes]');}

$output .= '</div>';




echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;


}
}

}
