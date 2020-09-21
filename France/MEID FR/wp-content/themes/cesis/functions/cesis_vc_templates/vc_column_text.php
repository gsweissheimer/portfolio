<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $el_id
 * @var $css_animation
 * @var $css
 * @var $content - shortcode content
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Column_text
 */
$el_class = $el_id = $css = $css_animation = $text_transform = $font_size = $line_height = $letter_spacing = $delay = $font_color = $text_resize = $text_minimum = $max_width = $text_ctn_pos = '';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$class_to_filter = 'wpb_text_column wpb_content_element ' . $this->getCSSAnimation( $css_animation ) . ' ' . $text_transform. ' ' . $text_ctn_pos;
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );
$wrapper_attributes = array();
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $delay ) ) {
	$wrapper_attributes[] = 'data-delay="' . esc_attr( $delay ) . '"';
}
if ( $letter_spacing !== '0' || $line_height !== ''  || $font_size !== '' || $font_color !== '' || $max_width !== '' ) {
	$wrapper_attributes[] = 'style="';
	if ( $font_color !== ''){
		$wrapper_attributes[] = 'color:' . esc_attr( $font_color ) . '; ';
	}
	if ( $font_size !== ''){
		$wrapper_attributes[] = 'font-size:' . esc_attr( $font_size ) . '; ';
	}
	if ( $letter_spacing !== '0'){
		$wrapper_attributes[] = 'letter-spacing:' . esc_attr( $letter_spacing ) . 'px; ';
	}
	if($line_height !== '' ) {
		$wrapper_attributes[] = 'line-height:' . esc_attr( $line_height ) . '; ';
	}
	if($max_width !== '' ) {
		$wrapper_attributes[] = 'max-width:' . esc_attr( $max_width ) . '; ';
	}
	$wrapper_attributes[] = '"';
}
if ( $text_resize == 'yes' ) {
	if($font_size == ""){ $font_size = "14";}
	$wrapper_attributes[] = 'data-max_size="' . esc_attr( $font_size ) . '" data-min_size="' . esc_attr( $text_minimum ) . '" ';
	$css_class .= ' cesis_ar_text ';
}
$output = '
	<div class="' . esc_attr( $css_class ) . '" ' . implode( ' ', $wrapper_attributes ) . '>
		<div class="wpb_wrapper">
			' . wpb_js_remove_wpautop( $content, true ) . '
		</div>
	</div>
';

echo $output;
