<?php

if (!class_exists('WPBakeryShortCode_cesis_line_divider')) {
class WPBakeryShortCode_cesis_line_divider extends WPBakeryShortCode {



protected function content( $atts, $content = null ) {

global $cesis_data;

	extract(shortcode_atts(array(

		'type'   => 'cesis_line_normal',
		'pos'   => 'cesis_line_d_center',
		'width' => '150',
		'height' => '2',
		'color'   => '',
		'icon' => '',
		'i_size'   => '40',
		'i_color'   => '',
 		'css_animation' => '',
 		'delay' => '0',
    'margin_top' => '0',
    'margin_bottom' => '0',
		'hide_lg' => '',
		'hide_md' => '',
		'hide_sm' => '',
		'el_class' => ''

    ), $atts));

if($color == ""){
	$color = $cesis_data['cesis_main_content_accent_one'];
}
if($i_color == ""){
	$i_color = $cesis_data['cesis_main_content_accent_one'];
}

if($width == ''){
	$width = '100%';
}else{
	$width = $width.'px';
}

if( $icon !== ''){
	$ctn_size = $i_size+$height;
	$top_m = $i_size/2;
	$m = $top_m +10;
	$lr_m = $i_size+10;
	$padding = $height/2;

}else{
	$ctn_size = $height;
}
$animation = $this->getCSSAnimation( $css_animation );
$id = 'cesis_count_to_'.RandomString(10);

$output = '<div class="cesis_line_divider_ctn '.$el_class.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.' '.$pos.' '.$animation.'" style="width:'.$width.'; height:'.$ctn_size.'px; margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;" data-delay="'.$delay.'">';

if($icon !== ''){
	$output .= '<span class="cesis_line_icon '.$pos.'" style=" padding:'.$padding.'px 0; font-size:'.$i_size.'px;">
	<i class="'.$icon.'" style="color:'.$i_color.'"></i>
	</span>';
	if($pos == 'cesis_line_d_center'){
		$output .= '<span class="cesis_line_divider_left" style="margin:'.$top_m.'px 0 0 0; width: calc(50% - '.$m.'px); height:'.$height.'px; background:'.$color.'"></span>';
		$output .= '<span class="cesis_line_divider_right" style="margin:'.$top_m.'px 0 0 0; width: calc(50% - '.$m.'px); height:'.$height.'px; background:'.$color.'"></span>';
	}elseif($pos == 'cesis_line_d_right' ){
		$output .= '<span class="cesis_line_divider '.$pos.'" style="margin:'.$top_m.'px '.$lr_m.'px 0 0; height:'.$height.'px; background:'.$color.'"></span>';
	}elseif($pos == 'cesis_line_d_left' ){
		$output .= '<span class="cesis_line_divider '.$pos.'" style="margin:'.$top_m.'px 0 0 '.$lr_m.'px; height:'.$height.'px; background:'.$color.'"></span>';
	}
}else{
	$output .= '<span class="cesis_line_divider" style="width:100%; height:'.$height.'px; background:'.$color.'"></span>';
}

$output .= '</div>';

return $output;



}


}

}
