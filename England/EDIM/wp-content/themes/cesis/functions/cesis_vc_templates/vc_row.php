<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

/**
 * Shortcode attributes
 * @var $atts
 * @var $el_class
 * @var $full_width
 * @var $full_height
 * @var $equal_height
 * @var $columns_placement
 * @var $content_placement
 * @var $parallax
 * @var $parallax_image
 * @var $css
 * @var $el_id
 * @var $video_bg
 * @var $video_bg_url
 * @var $video_bg_parallax
 * @var $parallax_speed_bg
 * @var $parallax_speed_video
 * @var $content - shortcode content
 * @var $css_animation
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Row
 */
$el_class = $full_height = $parallax_speed_bg = $parallax_speed_video = $full_width = $equal_height = $flex_row = $columns_placement = $content_placement = $parallax = $parallax_image =
$css = $el_id = $video_bg = $video_bg_url = $video_bg_parallax = $css_animation = $overlay = $min_height = $min_height_units = $cesis_parallax_speed = $cesis_content_effect = $cesis_content_effect_depth = '';
$disable_element = $use_fi = $additional = $sh_video_bg_url = $vimeo_bg_url = '';
$cesis_top_shape = $cesis_top_shape_color = $cesis_top_shape_width = $cesis_top_shape_height = $cesis_top_shape_flip = $cesis_top_shape_invert = '';
$cesis_bottom_shape = $cesis_bottom_shape_color = $cesis_bottom_shape_width = $cesis_bottom_shape_height = $cesis_bottom_shape_flip = $cesis_bottom_shape_invert = '';
$output = $after_output = $zindex ='';
$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

wp_enqueue_script( 'wpb_composer_front_js' );


if (preg_match('~MSIE|Internet Explorer~i', $_SERVER['HTTP_USER_AGENT']) || (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/7.0; rv:11.0') !== false)) {
$msie = true;
}else{
$msie = false;
}

$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );

$css_classes = array(
	'vc_row',
	'wpb_row',
	//deprecated
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
	) ) || $video_bg || $parallax
) {
	$css_classes[] = 'vc_row-has-fill';
}

if ( ! empty( $atts['gap'] ) ) {
	$css_classes[] = 'vc_column-gap-' . $atts['gap'];
}

$wrapper_attributes = array();
// build attributes for wrapper
if ( ! empty( $el_id ) ) {
	$wrapper_attributes[] = 'id="' . esc_attr( $el_id ) . '"';
}
if ( ! empty( $full_width ) ) {
	$wrapper_attributes[] = 'data-vc-full-width="true"';
	$wrapper_attributes[] = 'data-vc-full-width-init="false"';
	if ( 'stretch_row_content' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
	} elseif ( 'stretch_row_content_no_spaces' === $full_width ) {
		$wrapper_attributes[] = 'data-vc-stretch-content="true"';
		$css_classes[] = 'vc_row-no-padding';
	}
	$after_output .= '<div class="vc_row-full-width vc_clearfix"></div>';
}

if ( ! empty( $full_height ) ) {
	$css_classes[] = 'vc_row-o-full-height';
	if ( ! empty( $columns_placement ) ) {
		$flex_row = true;
		$css_classes[] = 'vc_row-o-columns-' . $columns_placement;
		if ( 'stretch' === $columns_placement ) {
			$css_classes[] = 'vc_row-o-equal-height';
		}
	}
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

$has_video_bg = ( ! empty( $video_bg ) && ! empty( $video_bg_url ) && vc_extract_youtube_id( $video_bg_url ) );
$has_custom_video_bg = ( ! empty( $video_bg ) );
$parallax_speed = $parallax_speed_bg;
if ( $has_video_bg || $has_custom_video_bg) {
	$parallax = $video_bg_parallax;
	$parallax_speed = $parallax_speed_video;
	$parallax_image = $video_bg_url;
	$css_classes[] = 'vc_video-bg-container';
	wp_enqueue_script( 'vc_youtube_iframe_api_js' );
}

if ( ! empty( $cesis_content_effect ) && $cesis_content_effect !== '') {
		$css_classes[] = 'cesis_row_content_effect';
		$wrapper_attributes[] = ' data-effect="' . esc_attr( $cesis_content_effect ) . '"  data-effect_depth="' . esc_attr( $cesis_content_effect_depth ) . '" '; // parallax speed
}
if ( ! empty( $parallax ) ) {
	if($parallax == 'cesis_parallax'){
		$css_classes[] = 'cesis_row_has_parallax';
		$wrapper_attributes[] = ' data-parallax_speed="' . esc_attr( $cesis_parallax_speed ) . '" '; // parallax speed
	}else{
		wp_enqueue_script( 'vc_jquery_skrollr_js' );
		$wrapper_attributes[] = 'data-vc-parallax="' . esc_attr( $parallax_speed ) . '"'; // parallax speed
		$css_classes[] = 'vc_general vc_parallax vc_parallax-' . $parallax;
		if ( false !== strpos( $parallax, 'fade' ) ) {
			$css_classes[] = 'js-vc_parallax-o-fade';
			$wrapper_attributes[] = 'data-vc-parallax-o-fade="on"';
		} elseif ( false !== strpos( $parallax, 'fixed' ) ) {
			$css_classes[] = 'js-vc_parallax-o-fixed';
		}
	}
}

if ( ! empty( $parallax_image ) ) {
	if ( $has_video_bg ) {
		$parallax_image_src = $parallax_image;
	} else {
		$parallax_image_id = preg_replace( '/[^\d]/', '', $parallax_image );
		$parallax_image_src = wp_get_attachment_image_src( $parallax_image_id, 'full' );
		if ( ! empty( $parallax_image_src[0] ) ) {
			$parallax_image_src = $parallax_image_src[0];
		}
	}
  $wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}



if($use_fi == 'yes'){
	$parallax_image_src = get_the_post_thumbnail_url(get_the_ID(), "full");
	$wrapper_attributes[] = 'data-vc-parallax-image="' . esc_attr( $parallax_image_src ) . '"';
}



if ( ! $parallax && $has_video_bg ) {
	$wrapper_attributes[] = 'data-vc-video-bg="' . esc_attr( $video_bg_url ) . '"';
}



if ($vimeo_bg_url !== '' && $has_custom_video_bg) {
	$wrapper_attributes[] = 'data-vc-vimeo-video-bg="' . esc_attr( $vimeo_bg_url ) . '"';
}


if ( $has_custom_video_bg && $sh_video_bg_url !== '' ) {
	$wrapper_attributes[] = 'data-vc-sh-video-bg="' . esc_attr( $sh_video_bg_url ) . '"';
}


if ( ! empty( $overlay ) ) {
	$css_classes[] = 'cesis_row_has_overlay';
	$wrapper_attributes[] = 'data-overlay="true" data-overlay-color="' . esc_attr( $overlay ) . '" ';
}

if ( ! empty( $min_height ) && ! empty( $zindex ) && empty( $oflow ) ) {
	if($msie == true){
		$wrapper_attributes[] = 'style="min-height:' . esc_attr( $min_height ) . esc_attr( $min_height_units ) . ' ; height:' . esc_attr( $min_height ) . esc_attr( $min_height_units ) . ' ; z-index:' . esc_attr( $zindex ) . ' ; position:relative;" ';
	}else{
		$wrapper_attributes[] = 'style="min-height:' . esc_attr( $min_height ) . esc_attr( $min_height_units ) . ' ; z-index:' . esc_attr( $zindex ) . ' ; position:relative;" ';
	}
}
elseif ( ! empty( $min_height ) && empty( $zindex ) && empty( $oflow ) ) {
	if($msie == true){
		$wrapper_attributes[] = 'style="min-height:' . esc_attr( $min_height ) . esc_attr( $min_height_units ) . ' ; height:' . esc_attr( $min_height ) . esc_attr( $min_height_units ) . ' ;" ';
	}else{
		$wrapper_attributes[] = 'style="min-height:' . esc_attr( $min_height ) . esc_attr( $min_height_units ) . ' ;" ';
	}
}
elseif ( empty( $min_height ) && !empty( $zindex ) && empty( $oflow ) ) {
		$wrapper_attributes[] = ' style="z-index:' . esc_attr( $zindex ) . ' ; position:relative;" ';
}elseif ( ! empty( $min_height ) && ! empty( $zindex ) && !empty( $oflow ) ) {
	if($msie == true){
		$wrapper_attributes[] = 'style="overflow:visible; min-height:' . esc_attr( $min_height ) . esc_attr( $min_height_units ) . ' ; height:' . esc_attr( $min_height ) . esc_attr( $min_height_units ) . ' ; z-index:' . esc_attr( $zindex ) . ' ; position:relative;" ';
	}else{
		$wrapper_attributes[] = 'style="overflow:visible; min-height:' . esc_attr( $min_height ) . esc_attr( $min_height_units ) . ' ; z-index:' . esc_attr( $zindex ) . ' ; position:relative;" ';
	}
}
elseif ( ! empty( $min_height ) && empty( $zindex ) && !empty( $oflow )  ) {
	if($msie == true){
		$wrapper_attributes[] = 'style="overflow:visible; min-height:' . esc_attr( $min_height ) . esc_attr( $min_height_units ) . ' ; height:' . esc_attr( $min_height ) . esc_attr( $min_height_units ) . ' ;" ';
	}else{
		$wrapper_attributes[] = 'style="overflow:visible; min-height:' . esc_attr( $min_height ) . esc_attr( $min_height_units ) . ' ;" ';
	}
}
elseif ( empty( $min_height ) && !empty( $zindex ) && !empty( $oflow ) ) {
		$wrapper_attributes[] = ' style="overflow:visible; z-index:' . esc_attr( $zindex ) . ' ; position:relative;" ';
}
elseif ( empty( $min_height ) && empty( $zindex ) && !empty( $oflow ) ) {
		$wrapper_attributes[] = ' style="overflow:visible;" ';
}

$css_class = preg_replace( '/\s+/', ' ', apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, implode( ' ', array_filter( array_unique( $css_classes ) ) ), $this->settings['base'], $atts ) );
$wrapper_attributes[] = 'class="' . esc_attr( trim( $css_class ) ) . '"';

if($cesis_top_shape !== ''){
$additional .= cesis_shapes($cesis_top_shape,$cesis_top_shape_color,$cesis_top_shape_height,$cesis_top_shape_width,$cesis_top_shape_flip,$cesis_top_shape_invert,'top');
}
if($cesis_bottom_shape !== ''){
$additional .= cesis_shapes($cesis_bottom_shape,$cesis_bottom_shape_color,$cesis_bottom_shape_height,$cesis_bottom_shape_width,$cesis_bottom_shape_flip,$cesis_bottom_shape_invert,'bottom');
}

$output .= '<div ' . implode( ' ', $wrapper_attributes ) . '>';

$output .= wpb_js_remove_wpautop( $content );
$output .= $additional;
$output .= '</div>';
$output .= $after_output;

echo $output;
