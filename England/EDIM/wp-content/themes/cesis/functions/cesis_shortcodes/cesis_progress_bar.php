<?php

if (!class_exists('WPBakeryShortCode_cesis_progress_bar')) {
class WPBakeryShortCode_cesis_progress_bar extends WPBakeryShortCode {



protected function content( $atts, $content = null ) {

global $cesis_data;

	extract(shortcode_atts(array(
		'style' => 'cesis_pb_1',
		'values'   => '',
		'units'   => '%',
		'space'   => '10',
		'options'   => '',
		'css'   => '',
		'css_animation' => '',
    'margin_top' => '0',
    'margin_bottom' => '0',
		'hide_lg' => '',
		'hide_md' => '',
		'hide_sm' => '',
		'el_class' => ''

    ), $atts));


ob_start();

if($style == 'cesis_pb_1' || $style == 'cesis_pb_2' || $style == 'cesis_pb_3'){
$label_outside = 'no';
}
else{
$label_outside = 'yes';
}


if($style == 'cesis_pb_1' || $style == 'cesis_pb_2' || $style == 'cesis_pb_3' || $style == 'cesis_pb_4' || $style == 'cesis_pb_8' || $style == 'cesis_pb_9' ){
$got_border = 'yes';
}
else{
$got_border = 'no';
}


if($style == 'cesis_pb_4' || $style == 'cesis_pb_7' ){
$unit_type = 'brackets';
}
elseif($style == 'cesis_pb_6' || $style == 'cesis_pb_10' || $style == 'cesis_pb_11' ){
$unit_type = 'default';
}
else{
$unit_type = 'p_position';
}


$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );


$bar_options = array();
$options = explode( ',', $options );
if ( in_array( 'animated', $options ) ) {
	$bar_options[] = 'animated';
}
if ( in_array( 'striped', $options ) ) {
	$bar_options[] = 'striped';
}


$class_to_filter = 'vc_progress_bar cesis_progress_bar '.$style.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.' ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '<div class="' . esc_attr( $css_class ) . '" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;">';


$values = (array) vc_param_group_parse_atts( $values );
$max_value = 0.0;
$graph_lines_data = array();
foreach ( $values as $data ) {
	$new_line = $data;
	$new_line['value'] = isset( $data['value'] ) ? $data['value'] : 0;
	$new_line['label'] = isset( $data['label'] ) ? $data['label'] : '';
	$new_line['bgcolor'] = isset( $data['color'] ) && '' !== $data['color'] ? '' : $color;
	$new_line['bgcolor_two'] = isset( $data['color_two'] ) && '' !== $data['color_two'] ? '' : $color_two;
	$new_line['ctnbg_color'] = isset( $data['ctn_color'] ) && '' !== $data['ctn_color'] ? '' : $ctn_color;
	$new_line['ctnborder_color'] = isset( $data['ctn_b_color'] ) && '' !== $data['ctn_b_color'] ? '' : $ctn_b_color;
	$new_line['txtcolor'] = isset( $data['txtcolor'] ) && '' !== $data['txtcolor'] ? '' : $txtcolor;
	if ( isset( $data['color'] )  && '' == $data['color_two'] ) {
		$new_line['bgcolor'] = ' style="background-color: ' . esc_attr( $data['color'] ) . ';"';
	}
	elseif ( isset( $data['color_two'] ) && isset( $data['color'] ) && '' !== $data['color_two'] ) {
		$new_line['bgcolor'] = ' style="background:linear-gradient(90deg,' . esc_attr( $data['color'] ) . ' ,' . esc_attr( $data['color_two'] ) . ');"';
	}
	if ( isset( $data['txtcolor'] ) ) {
		$new_line['txtcolor'] = ' style="color: ' . esc_attr( $data['txtcolor'] ) . ';"';
	}
	if ( isset( $data['ctn_color'] ) && $got_border == 'yes') {
		$new_line['ctnstyle'] = ' style="background: ' . esc_attr( $data['ctn_color'] ) . '; border:1px solid ' . esc_attr( $data['ctn_b_color'] ) . ';"';
	}elseif ( isset( $data['ctn_color'] ) && $got_border == 'no') {
		$new_line['ctnstyle'] = ' style="background: ' . esc_attr( $data['ctn_color'] ) . ';"';
	}
	if($style == 'cesis_pb_8' ){
		$new_line['circlestyle'] = 'background: ' . esc_attr( $data['color'] ) . '; border:8px solid ' . esc_attr( $data['ctn_color'] ) . ';';
	}

	if ( $max_value < (float) $new_line['value'] ) {
		$max_value = $new_line['value'];
	}
	$graph_lines_data[] = $new_line;
}

foreach ( $graph_lines_data as $line ) {
	$bar_title = $bar_id = "";
	if( '' !== $units && $unit_type == 'default'){
	$unit = '<span class="vc_label_units">' . $line['value'] . $units . '</span>';
	$pp_unit = '';
	}
	elseif( '' !== $units && $unit_type == 'p_position'){
	$unit = '';
	$pp_unit = '<span class="vc_label_units">' . $line['value'] . $units . '</span>';
	}
	elseif( '' !== $units && $unit_type == 'brackets'){
	$unit = '<span class="vc_label_units"> - (' . $line['value'] . $units . ')</span>';
	$pp_unit = '';
	}
	elseif(	'' !== $units ){
	$unit = '';
	$pp_unit = '';
	}
	if($label_outside == 'yes'){
	$output .= '<span class="cesis_progress_bar_label"' . $line['txtcolor'] . '>' . $line['label'] . $unit . '</span>';
	}
	$output .= '<div class="vc_general vc_single_bar" style="margin-bottom:'.$space.'px;">';
	if ( $max_value > 100.00 ) {
		$percentage_value = (float) $line['value'] > 0 && $max_value > 100.00 ? round( (float) $line['value'] / $max_value * 100, 4 ) : 0;
	} else {
		$percentage_value = $line['value'];
	}
	if($label_outside == 'no'){
	$bar_title = '<h3 class="cesis_progress_bar_label"' . $line['txtcolor'] . '>' . $line['label'] . $unit . '</h3>';
	}
	if($style == "cesis_pb_8"){
	$bar_id = 'bar_id_'.RandomString(10);
	$output .= '<style type="text/css">#'.$bar_id.' .vc_bar:after { '. $line['circlestyle'].' }</style>';
	}
	$output .= '<div id="'.$bar_id.'" class="cesis_progress_bar_ctn" ' . $line['ctnstyle'] . ' ><div class="cesis_progress_bar_wrapper">'.$bar_title.'<span class="vc_bar " data-percentage-value="' . esc_attr( $percentage_value ) . '" data-value="' . esc_attr( $line['value'] ) . '"' . $line['bgcolor'] . '>'. $pp_unit .'</span><span class="cesis_progress_bar_effect ' . esc_attr( implode( ' ', $bar_options ) ) . '"></span></div></div>';
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
