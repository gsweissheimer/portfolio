<?php

if (!class_exists('WPBakeryShortCode_cesis_price_tables')) {
class WPBakeryShortCode_cesis_price_tables extends WPBakeryShortCode {



protected function content( $atts, $content = null ) {

global $cesis_data;

	extract(shortcode_atts(array(
		'style' => 'cesis_pt_1',
		'type' => 'cesis_pt_sticked',
		'space' => '30',
		'force_font' => '',
		'values'   => '',
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

$space = ($space / 2);
if($type == "cesis_pt_spaced"){
 $margin_settings = 'margin-left:-'.$space.'px; margin-right:-'.$space.'px;';
 $padding_settings = 'padding-left:'.$space.'px; padding-right:'.$space.'px;';
}
else{
 $margin_settings = "";
 $padding_settings = "";
}


$el_class = $this->getExtraClass( $el_class ) . $this->getCSSAnimation( $css_animation );
$class_to_filter = 'cesis_price_tables_ctn '.$style.' '.$type.' '.$force_font.' '.$el_class.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.' ';
$class_to_filter .= $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output = '<div class="' . esc_attr( $css_class ) . '" data-delay="'.$delay.'" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px; '.$margin_settings.'">';

$values = (array) vc_param_group_parse_atts( $values );

$tables_data = array();
foreach ( $values as $data ) {
	$new_table = $data;
	$new_table['featured'] = isset( $data['featured'] ) ? $data['featured'] : '';
	$new_table['image'] = isset( $data['image'] ) ? $data['image'] : '';
	$new_table['title'] = isset( $data['title'] ) ? $data['title'] : 'title';
	$new_table['table_b_color'] = isset( $data['table_b_color'] ) ? $data['table_b_color'] : $cesis_data["cesis_main_content_border"];
	$new_table['table_bg_color'] = isset( $data['table_bg_color'] ) ? $data['table_bg_color'] : $cesis_data["cesis_main_content_bg"];
	$new_table['fb_bg_color'] = isset( $data['fb_bg_color'] ) ? $data['fb_bg_color'] : $cesis_data["cesis_main_content_bg"];
	$new_table['sb_bg_color'] = isset( $data['sb_bg_color'] ) ? $data['sb_bg_color'] : $cesis_data["cesis_main_content_alt_bg"];
	$new_table['title_color'] = isset( $data['title_color'] ) ? $data['title_color'] : $cesis_data["cesis_main_content_heading"];
	$new_table['table_f_color'] = isset( $data['table_f_color'] ) ? $data['table_f_color'] : $cesis_data["cesis_main_content_accent_one"];
	$new_table['title_b_color'] = isset( $data['title_b_color'] ) ? $data['title_b_color'] : $cesis_data["cesis_main_content_accent_one"];
	$new_table['description'] = isset( $data['description'] ) ? $data['description'] : '';
	$new_table['description_color'] = isset( $data['description_color'] ) ? $data['description_color'] : $cesis_data["cesis_main_content_alt_light_color"];
	$new_table['price'] = isset( $data['price'] ) ? $data['price'] : '24.99';
	$new_table['price_color'] = isset( $data['price_color'] ) ? $data['price_color'] : $cesis_data["cesis_main_content_alt_accent_one"];
	$new_table['currency'] = isset( $data['currency'] ) ? $data['currency'] : '';
	$new_table['currency_color'] = isset( $data['currency_color'] ) ? $data['currency_color'] : $cesis_data["cesis_main_content_alt_color"];
	$new_table['table_description'] = isset( $data['table_description'] ) ? $data['table_description'] : '';
	$new_table['table_description_color'] = isset( $data['table_description_color'] ) ? $data['table_description_color'] : $cesis_data["cesis_main_content_alt_light_color"];
	$new_table['features'] = isset( $data['features'] ) ? $data['features'] : 0;
	$new_table['features_t_color'] = isset( $data['features_t_color'] ) ? $data['features_t_color'] : $cesis_data["cesis_main_content_heading"];
	$new_table['features_d_color'] = isset( $data['features_d_color'] ) ? $data['features_d_color'] : $cesis_data["cesis_main_content_color"];
	$new_table['features_b_color'] = isset( $data['features_b_color'] ) ? $data['features_b_color'] : $cesis_data["cesis_main_content_border"];
	$new_table['features_bg_color'] = isset( $data['features_bg_color'] ) ? $data['features_bg_color'] : $cesis_data["cesis_main_content_bg"];
	$new_table['bb_bg_color'] = isset( $data['bb_bg_color'] ) ? $data['bb_bg_color'] : $cesis_data["cesis_main_content_bg"];
	$new_table['btn_text'] = isset( $data['btn_text'] ) ? $data['btn_text'] : '';
	$new_table['btn_link'] = isset( $data['btn_link'] ) ? $data['btn_link'] : '#';
	$new_table['btn_t_color'] = isset( $data['btn_t_color'] ) ? $data['btn_t_color'] : '#ffffff';
	$new_table['btn_b_color'] = isset( $data['btn_b_color'] ) ? $data['btn_b_color'] : $cesis_data["cesis_main_content_accent_one"];
	$new_table['btn_bg_color'] = isset( $data['btn_bg_color'] ) ? $data['btn_bg_color'] : $cesis_data["cesis_main_content_accent_one"];
	$new_table['btn_ht_color'] = isset( $data['btn_ht_color'] ) ? $data['btn_ht_color'] : $cesis_data["cesis_main_content_heading"];
	$new_table['btn_hb_color'] = isset( $data['btn_hb_color'] ) ? $data['btn_hb_color'] : $cesis_data["cesis_main_content_heading"];
	$new_table['btn_hbg_color'] = isset( $data['btn_hbg_color'] ) ? $data['btn_hbg_color'] : 'rgba(0,0,0,0)';


	$new_table['btn_style']='onmouseleave="this.style.borderColor=\''.$new_table['btn_b_color'].'\'; this.style.backgroundColor=\''.$new_table['btn_bg_color'].'\'; this.style.color=\''.$new_table['btn_t_color'].'\';" onmouseenter="this.style.borderColor=\''.$new_table['btn_hb_color'].'\'; this.style.backgroundColor=\''.$new_table['btn_hbg_color'].'\'; this.style.color=\''.$new_table['btn_ht_color'].'\';" style="color:'.$new_table['btn_t_color'].'; background:'.$new_table['btn_bg_color'].'; border-color:'.$new_table['btn_b_color'].';"';

	$tables_data[] = $new_table;
}

$i = 0;
$c = 1;

foreach ( $tables_data as $table ) {
	$i++;
}

foreach ( $tables_data as $table ) {

	$features_data = array();
	$features = (array) vc_param_group_parse_atts( $table['features'] );
	foreach ($features as $data) {
		$new_feature = $data;
		$new_feature['f_title'] = isset( $data['f_title'] ) ? $data['f_title'] : 0;
		$new_feature['f_desc'] = isset( $data['f_desc'] ) ? $data['f_desc'] : 0;

		$features_data[] = $new_feature;
	}
	if($table['title'] !== ''){
	$title = '<span class="cesis_price_table_title" style="color:'.$table['title_color'].'">'.$table['title'].'</span>';
}else{
	$title = '';
}

	if($table['title'] !== ''){
	$price_description = '<span class="cesis_price_table_pd" style="color:'.$table['description_color'].'">'.$table['description'].'</span>';
}else {
	$price_description = '';
}


	if($table['price'] !== ''){
	$price = '<span class="cesis_price_table_price" style="color:'.$table['price_color'].'">'.$table['price'].'</span>';
}else {
	$price = '';
}

	if($table['currency'] !== ''){
	$currency = '<span class="cesis_price_table_currency" style="color:'.$table['currency_color'].'">'.$table['currency'].'</span>';
}else {
	$currency = '';
}


	if($table['table_description'] !== ''){
	$table_description = '<span class="cesis_price_table_td" style="color:'.$table['table_description_color'].'">'.$table['table_description'].'</span>';
}else{
	$table_description = '';
}

	if($table['btn_text'] !== ''){
		$button = '<a href="'.$table['btn_link'].'" '.$table['btn_style'].'>'.$table['btn_text'].'</a>';
	}else{
		$button = '';
	}



	if($table['image'] !== ''){
		$img_id = preg_replace( '/[^\d]/', '', $table['image'] );
		$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => 'full'  ) );
		$img = '<div class="cesis_price_table_image">'.$img['thumbnail'].'</div>';
}else {
	$img = '';
}

$features_style = 'style="border-color:'.$table['features_b_color'].'"';

	if($table['featured'] !== ''){
		$featured = 'cesis_price_table_featured';
	}
	else{
		$featured = '';
	}



	if($c == '1'){
		$position = "cesis_first_table";
	}elseif($c == $i){
		$position = "cesis_last_table";
	}else{
		$position = "";
	}

	if($style == 'cesis_pt_1' && $position !== '' && $featured !== ''){
		 $size_adjust = "+ 14px";
	}elseif($style == 'cesis_pt_1' && $position !== ''){
		$size_adjust = "+ 10px";
	}elseif($style == 'cesis_pt_1' && $position == '' && $featured !== ''){
		$size_adjust = '+ 4px';
	}elseif($style == 'cesis_pt_3' && $featured !== ''){
		$size_adjust = '+ 24px';
	}else{
		$size_adjust = '';
	}


	if($style == 'cesis_pt_1'){
		if($featured == ''){
		$output .= '<div class="cesis_price_table  '.$featured.'  '.$position.'" style="width:calc(100% / '.$i.' '.$size_adjust.');  '.$padding_settings.'"><div class="cesis_price_table_inner" style=" border-color:'.$table['table_b_color'].'; background-color:'.$table['table_bg_color'].';">';
	}else{
	$output .= '<div class="cesis_price_table  '.$featured.'  '.$position.'" style="width:calc(100% / '.$i.' '.$size_adjust.');  '.$padding_settings.'"><div class="cesis_price_table_inner" style=" border-color:'.$table['table_f_color'].'; background-color:'.$table['table_bg_color'].';">';
	}
		$output .= '<div class="cesis_price_table_top" style="background:'.$table['fb_bg_color'].';">'.$img.$title.'</div>';
		$output .= '<div class="cesis_price_table_sub" style="background:'.$table['sb_bg_color'].'; border-color:'.$table['table_b_color'].';">'.$currency.$price.$price_description.$table_description.'</div>';
	}

		if($style == 'cesis_pt_2'){
			if($featured == ''){
			$output .= '<div class="cesis_price_table  '.$featured.'  '.$position.'" style="width:calc(100% / '.$i.' '.$size_adjust.');  '.$padding_settings.'"><div class="cesis_price_table_inner" style=" border-color:'.$table['table_b_color'].'; background-color:'.$table['table_bg_color'].';">';
		}else{
		$output .= '<div class="cesis_price_table  '.$featured.'  '.$position.'" style="width:calc(100% / '.$i.' '.$size_adjust.');  '.$padding_settings.'"><div class="cesis_price_table_inner" style=" border-color:'.$table['table_b_color'].'; background-color:'.$table['table_bg_color'].';">';
		}
			$output .= '<div class="cesis_price_table_top" style="background:'.$table['fb_bg_color'].';">'.$title.'</div>';
			$output .= '<div class="cesis_price_table_sub" style="background:'.$table['sb_bg_color'].'; border-color:'.$table['table_b_color'].';">'.$img.$currency.$price.$price_description.$table_description.'<span class="cesis_price_table_arrow" style="background:'.$table['sb_bg_color'].';"></span></div>';
		}


		if($style == 'cesis_pt_3'){
			if($featured == ''){
			$output .= '<div class="cesis_price_table  '.$featured.'  '.$position.'" style="width:calc(100% / '.$i.' '.$size_adjust.');  '.$padding_settings.'"><div class="cesis_price_table_inner" style=" border-color:'.$table['table_b_color'].'; background-color:'.$table['table_bg_color'].';">';
		}else{
		$output .= '<div class="cesis_price_table  '.$featured.'  '.$position.'" style="width:calc(100% / '.$i.' '.$size_adjust.');  '.$padding_settings.'"><div class="cesis_price_table_inner" style=" border-color:'.$table['table_b_color'].'; background-color:'.$table['table_bg_color'].';">';
		}
			$output .= '<div class="cesis_price_table_top" style="background:'.$table['fb_bg_color'].';">'.$currency.$price.'<span class="cesis_price_table_arrow" style="background:'.$table['fb_bg_color'].';"></span></div>';
			$output .= '<div class="cesis_price_table_sub" style="background:'.$table['sb_bg_color'].';">'.$img.$title.$price_description.$table_description.'</div>';
		}

	if($style == 'cesis_pt_4' ){

			if($featured == ''){
			$output .= '<div class="cesis_price_table  '.$featured.'  '.$position.'" style="width:calc(100% / '.$i.' '.$size_adjust.'); '.$padding_settings.'"><div class="cesis_price_table_inner" style="border-color:'.$table['table_b_color'].'; background-color:'.$table['table_bg_color'].';">';
			}else{
			$output .= '<div class="cesis_price_table  '.$featured.'  '.$position.'" style="width:calc(100% / '.$i.' '.$size_adjust.'); '.$padding_settings.'"><div class="cesis_price_table_inner" style=" border-color:'.$table['table_f_color'].'; background-color:'.$table['table_bg_color'].';">';
			}
			$output .= '<div class="cesis_price_table_top" style="background:'.$table['fb_bg_color'].';">'.$img.$title.'<span class="cesis_price_table_sep" style="background:'.$table['title_b_color'].'"></span>'.$currency.$price.' '.$price_description.$table_description.'</div>';


		}

		if($style == 'cesis_pt_5'){

				if($featured == ''){
				$output .= '<div class="cesis_price_table  '.$featured.'  '.$position.'" style="width:calc(100% / '.$i.' '.$size_adjust.'); '.$padding_settings.'"><div class="cesis_price_table_inner" style="background:'.$table['fb_bg_color'].'; border-color:'.$table['table_b_color'].';">';
				}else{
				$output .= '<div class="cesis_price_table  '.$featured.'  '.$position.'" style="width:calc(100% / '.$i.' '.$size_adjust.'); '.$padding_settings.'"><div class="cesis_price_table_inner"><div class="cesis_price_table_bg_layer" style="background:'.$table['fb_bg_color'].'; border-color:'.$table['table_f_color'].';"></div>';
				}
				$output .= '<div class="cesis_price_table_top" style="background:'.$table['fb_bg_color'].';">'.$img.$title.'<span class="cesis_price_table_sep" style="background:'.$table['title_b_color'].'"></span>'.$currency.$price.' '.$price_description.$table_description.'</div>';


	}

	if($style == 'cesis_pt_6'  || $style == 'cesis_pt_8'){
			if($featured == ''){
				$output .= '<div class="cesis_price_table  '.$featured.'  '.$position.'" style="width:calc(100% / '.$i.' '.$size_adjust.'); '.$padding_settings.'"><div class="cesis_price_table_inner" style="background:'.$table['fb_bg_color'].'; border-color:'.$table['table_b_color'].';"><div class="cesis_price_table_sub_ctn"  style="border-color:'.$table['table_b_color'].';">';
			}else{
				$output .= '<div class="cesis_price_table  '.$featured.'  '.$position.'" style="width:calc(100% / '.$i.' '.$size_adjust.'); '.$padding_settings.'"><div class="cesis_price_table_inner" style="background:'.$table['fb_bg_color'].'; border-color:'.$table['table_b_color'].';"><div class="cesis_price_table_sub_ctn"  style="border-color:'.$table['table_b_color'].';"><div class="cesis_price_table_arrow" style="border-color:'.$table['table_f_color'].';"></div>';
			}
				$output .= '<div class="cesis_price_table_top">'.$img.$title.'<span class="cesis_price_table_sep" style="background:'.$table['title_b_color'].'"></span>'.$currency.$price.' '.$price_description.$table_description.'</div>';
			}


if($style == 'cesis_pt_7'){
			$output .= '<div class="cesis_price_table  '.$featured.'  '.$position.'" style="width:calc(100% / '.$i.' '.$size_adjust.'); '.$padding_settings.'"><div class="cesis_price_table_inner" style="border-color:'.$table['table_b_color'].'; background-color:'.$table['table_bg_color'].';">';
			$output .= '<div class="cesis_price_table_top" style="background:'.$table['fb_bg_color'].'; border-color:'.$table['title_b_color'].';" ><div class="cesis_price_table_sep" style="border-color:'.$table['title_b_color'].';">'.$img.$title.'</div><div class="cesis_price_table_sub" style="background:'.$table['sb_bg_color'].';">'.$currency.$price.' '.$price_description.'</div>'.$table_description.'</div>';
			}

	// generate features
	$output .= '<div class="cesis_price_table_features" style="background:'.$table['features_bg_color'].'; border-color:'.$table['features_b_color'].';">';
	if(isset($features_data) && $features_data !== ''){
	foreach ( $features_data as $feature ) {
		$output .= '<div class="cesis_price_feature" '.$features_style.'>';
		if($feature['f_title'] == '0'){
			$feature['f_title'] = "";
		}
		if($feature['f_title'] !== '' && $feature['f_title'] !== '0'){
			$output .= '<span class="cesis_price_feature_title" style="color:'.$table['features_t_color'].';">'.$feature['f_title'].'</span>';
		}
		if($feature['f_desc'] == '0'){
			$feature['f_desc'] = "";
		}
		if($feature['f_desc'] !== '' && $feature['f_desc'] !== '0'){
			$output .= '<span class="cesis_price_feature_desc" style="color:'.$table['features_d_color'].';">'.$feature['f_desc'].'</span>';
		}
		$output .= '</div>';
	}
	}
	$output .= '</div>';

	$output .= '<div class="cesis_price_table_bottom" style="background-color:'.$table['bb_bg_color'].';">'.$button.'</div>';
	if($style == 'cesis_pt_6' || $style == 'cesis_pt_8'){
		$output .= '</div>';
	}
	$output .= '</div></div>';
	$features_data = '';
	$c++;

}

$output .= '</div>';

echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;


}
}

}
