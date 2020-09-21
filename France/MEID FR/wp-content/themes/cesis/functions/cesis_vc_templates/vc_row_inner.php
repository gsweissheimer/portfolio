<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $css
 * @var $el_id
 * @var $equal_height
 * @var $content_placement
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row_Inner
 */
$el_class = $equal_height = $content_placement = $css = $el_id = $parallax = $parallax_image  = $overlay = $cesis_parallax_speed = $min_height = $min_height_units = $cesis_content_effect = $cesis_content_effect_depth = '';
$disable_element = $use_i_c = '';
$output = $after_output = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
$msie = true;
}else{
$msie = false;
}

$wrapper_attributes = array();
// build attributes for wrapper

$el_class = $this->getExtraClass( $el_class );
$css_classes = array(
	'vc_row',
	'wpb_row',
	//deprecated
	'vc_inner',
	'vc_row-fluid',
	$el_class,
	vc_shortcode_custom_css_class( $css ),
);
if ( 'yes' === $disable_element ) {
	if ( vc_is_page_editable() ) {
		$css_classes[] = 'vc_hidden-lg vc_hidden-xs vc_hidden-sm vc_hidden-md';
	} else {
		return '';
	}
}

if ( vc_shortcode_custom_css_has_property( $css, array(
	'border',
	'background',
) ) ) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

if ( ! empty( $equal_height ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-equal-height';
}

if ( ! empty( $content_placement ) ) {
	$flex_row = true;
	$css_classes[] = 'vc_row-o-content-' . $content_placement;
}

if ( ! empty( $flex_row ) ) {
	$css_classes[] = 'vc_row-flex';
}

if ( ! empty( $cesis_content_effect ) && $cesis_content_effect !== '') {
		$css_classes[] = 'cesis_row_content_effect';
		$wrapper_attributes[] = ' data-effect="' . esc_attr( $cesis_content_effect ) . '"  data-effect_depth="' . esc_attr( $cesis_content_effect_depth ) . '" '; // parallax speed
}
if ( ! empty( $parallax ) ) {
	if($parallax == 'cesis_parallax'){
		$css_classes[] = 'cesis_row_has_parallax';
		$wrapper_attributes[] = ' data-parallax_speed="' . esc_attr( $cesis_parallax_speed ) . '" '; // parallax speed
	}
}

if ( ! empty( $parallax_image ) ) {
	$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
	$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
	if ( ! empty( $parallax_image_src[0] ) ) {
		$parallax_image_src = $parallax_image_src[0];
	}
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}

if ( ! empty( $overlay ) ) {
	$css_classes[] = 'cesis_row_has_overlay';
	$wrapper_attributes[] = 'data-overlay="true" data-overlay-color="' . esc_attr( $overlay ) . '" ';
}

if ( ! empty( $min_height ) ) {
	if($msie == true){
		$wrapper_attributes[] = 'style="min-height:' . esc_attr( $min_height ) . esc_attr( $min_height_units ) . ' ; height:' . esc_attr( $min_height ) . esc_attr( $min_height_units ) . ' ;" ';
	}else{
		$wrapper_attributes[] = 'style="min-height:' . esc_attr( $min_height ) . esc_attr( $min_height_units ) . ' ;" ';
	}
}

if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';
if($use_i_c == 'yes'){
$output .= '<div class="cesis_container cesis_inner_row_ctn cesis_inner_row_'.$content_placement.'">';
}
$output .= wpb_js_remove_wpautop( $content );
if($use_i_c == 'yes'){
$output .= '</div>';
}
$output .= '</div>';
$output .= $after_output;

echo $output;
