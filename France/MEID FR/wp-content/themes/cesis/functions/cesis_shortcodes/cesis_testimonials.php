<?php



if (!class_exists('WPBakeryShortCode_cesis_testimonials')) {
class WPBakeryShortCode_cesis_testimonials extends WPBakeryShortCode {

protected function content( $atts, $content = null ) {

extract( shortcode_atts( array(
        'style' => 'cesis_tm_1',
        'type' => 'carousel',
        'force_font' => '',
        'col' => '1',
        'col_big' => 'inherit',
        'col_tablet' => '1',
        'col_mobile' => '1',
        'row' => '',

				'h_f_size' => '14px',
				'h_f_weight' => '700',
				'h_l_height' => '24px',
				'h_t_transform' => 'uppercase',
				'h_l_spacing' => '0',
				'heading_font' => 'alt_font',
				'h_google_fonts' => '',
				't_f_size' => '14px',
				't_f_weight' => '400',
				't_l_height' => '24px',
				't_t_transform' => 'none',
				't_l_spacing' => '0',
				'text_font' => 'main_font',
				'google_fonts' => '',
				'a_f_size' => '14px',
				'a_f_weight' => '400',
				'a_l_height' => '24px',
				'a_t_transform' => 'none',
				'a_l_spacing' => '0',
				'a_font' => 'main_font',
				'a_google_fonts' => '',


        'margin' => '30',
        'padding' => '30',
        'loop' => 'yes',
        'center' => 'no',
        'nav' => 'yes',
        'nav_tablet' => '',
        'nav_mobile' => '',
        'nav_color' => '',
        'nav_active_color' => '',
        'nav_type' => 'cesis_owl_pag_1',
        'nav_align' => 'cesis_owl_nav_center',
        'nav_pos' => '',
        'margin_top' => '0',
        'margin_bottom' => '0',
		    'scroll' => '',
		    'speed' => '8000',
		    'css_animation' => '',


		'testimonials'   => '',



		'hide_lg' => '',
		'hide_md' => '',
		'hide_sm' => '',
		'el_class' => ''
), $atts ) );


	global $cesis_data;
  $row_start = '';
	$new_padding = ($padding / 2);
	$animation = $this->getCSSAnimation( $css_animation );
	$page_custom_content = 'no';

	ob_start();




	$id = RandomString(20);
	$output = '';


			// Font settings
			if($force_font == 'custom'){
			$settings = get_option( 'wpb_js_google_fonts_subsets' );
			if ( is_array( $settings ) && ! empty( $settings ) ) {
				$subsets = '&subset=' . implode( ',', $settings );
			} else {
				$subsets = '';
			}
			$h_google_fonts_field_settings = isset( $h_google_fonts_field['settings'], $h_google_fonts_field['settings']['fields'] ) ? $h_google_fonts_field['settings']['fields'] : array();
			$h_google_fonts_obj = new Vc_Google_Fonts();

			$h_google_fonts_data = strlen( $h_google_fonts ) > 0 ? $h_google_fonts_obj->_vc_google_fonts_parse_attributes( $h_google_fonts_field_settings, $h_google_fonts ) : '';

			$h_styles = 'font-size:'.$h_f_size.'; ';
			$h_styles .= 'letter-spacing:'.$h_l_spacing.'px; ';
			$h_styles .= 'line-height:'.$h_l_height.'; ';
			$h_styles .= 'text-transform:'.$h_t_transform.'; ';



	if ( isset( $h_google_fonts_data['values']['font_family'] ) ) {
		wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $h_google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $h_google_fonts_data['values']['font_family'] . $subsets );
	}

	if ( $heading_font == 'custom' && ! empty( $h_google_fonts_data ) && isset( $h_google_fonts_data['values'], $h_google_fonts_data['values']['font_family'], $h_google_fonts_data['values']['font_style'] ) ) {
				$h_google_fonts_family = explode( ':', $h_google_fonts_data['values']['font_family'] );
				$h_styles .= 'font-family:' . $h_google_fonts_family[0].'; ';
				$h_google_fonts_styles = explode( ':', $h_google_fonts_data['values']['font_style'] );
				$h_styles .= 'font-weight:' . $h_google_fonts_styles[1].'; ';
				$h_styles .= 'font-style:' . $h_google_fonts_styles[2].';';
			}else{
				$h_styles .= 'font-weight:' .$h_f_weight.'; ';
			}

      $a_google_fonts_field_settings = isset( $a_google_fonts_field['settings'], $a_google_fonts_field['settings']['fields'] ) ? $a_google_fonts_field['settings']['fields'] : array();
			$a_google_fonts_obj = new Vc_Google_Fonts();

			$a_google_fonts_data = strlen( $a_google_fonts ) > 0 ? $a_google_fonts_obj->_vc_google_fonts_parse_attributes( $a_google_fonts_field_settings, $a_google_fonts ) : '';

			$a_styles = 'font-size:'.$a_f_size.'; ';
			$a_styles .= 'letter-spacing:'.$a_l_spacing.'px; ';
			$a_styles .= 'line-height:'.$a_l_height.'; ';
			$a_styles .= 'text-transform:'.$a_t_transform.'; ';



	if ( isset( $a_google_fonts_data['values']['font_family'] ) ) {
		wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $a_google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $a_google_fonts_data['values']['font_family'] . $subsets );
	}

	if ( $heading_font == 'custom' && ! empty( $a_google_fonts_data ) && isset( $a_google_fonts_data['values'], $a_google_fonts_data['values']['font_family'], $a_google_fonts_data['values']['font_style'] ) ) {
				$a_google_fonts_family = explode( ':', $a_google_fonts_data['values']['font_family'] );
				$a_styles .= 'font-family:' . $a_google_fonts_family[0].'; ';
				$a_google_fonts_styles = explode( ':', $a_google_fonts_data['values']['font_style'] );
				$a_styles .= 'font-weight:' . $a_google_fonts_styles[1].'; ';
				$a_styles .= 'font-style:' . $a_google_fonts_styles[2].';';
			}else{
				$a_styles .= 'font-weight:' .$a_f_weight.'; ';
			}

			$google_fonts_field_settings = isset( $google_fonts_field['settings'], $google_fonts_field['settings']['fields'] ) ? $google_fonts_field['settings']['fields'] : array();
			$google_fonts_obj = new Vc_Google_Fonts();

			$t_google_fonts_data = strlen( $google_fonts ) > 0 ? $google_fonts_obj->_vc_google_fonts_parse_attributes( $google_fonts_field_settings, $google_fonts ) : '';

			$t_styles = 'font-size:'.$t_f_size.'; ';
			$t_styles .= 'letter-spacing:'.$t_l_spacing.'px; ';
			$t_styles .= 'line-height:'.$t_l_height.'; ';
			$t_styles .= 'text-transform:'.$t_t_transform.'; ';


	if ( isset( $t_google_fonts_data['values']['font_family'] ) ) {
		wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $t_google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $t_google_fonts_data['values']['font_family'] . $subsets );
	}

	if ( $text_font == 'custom' && ! empty( $t_google_fonts_data ) && isset( $t_google_fonts_data['values'], $t_google_fonts_data['values']['font_family'], $t_google_fonts_data['values']['font_style'] ) ) {
				$t_google_fonts_family = explode( ':', $t_google_fonts_data['values']['font_family'] );
				$t_styles .= 'font-family:' . $t_google_fonts_family[0].'; ';
				$t_google_fonts_styles = explode( ':', $t_google_fonts_data['values']['font_style'] );
				$t_styles .= 'font-weight:' . $t_google_fonts_styles[1].'; ';
				$t_styles .= 'font-style:' . $t_google_fonts_styles[2].';';
			}else{
				$t_styles .= 'font-weight:' .$t_f_weight.'; ';
			}
		}else{
			$h_styles = $t_styles = $a_styles = $heading_font = $text_font = $a_font = '';
		}




if($nav_tablet == ''){
	$nav_tablet = $nav;
}

if($nav_mobile == ''){
	$nav_mobile = $nav;
}
if($nav == 'yes' || $nav_mobile == 'yes'  || $nav_tablet == 'yes' ){



if($nav_type == 'cesis_owl_pag_1' && $nav_color !== '' && $nav_active_color !== '' || $nav_type == 'cesis_owl_pag_3' && $nav_color !== '' && $nav_active_color !== ''){
$output .= '<style type="text/css">#cesis_testimonial_'.$id.' .owl-dot span{background:'.$nav_color.'}#cesis_testimonial_'.$id.' .owl-dot.active span{background:'.$nav_active_color.'}</style>';
}elseif($nav_type == 'cesis_owl_pag_2' && $nav_color !== '' && $nav_active_color !== ''){
$output .= '<style type="text/css">#cesis_testimonial_'.$id.' .owl-dot span{background:'.$nav_color.'; border-color:'.$nav_color.'}#cesis_testimonial_'.$id.' .owl-dot.active span{background:none; border-color:'.$nav_active_color.'}</style>';
}


}

if($type == 'carousel'){

$output .='<div id="cesis_testimonial_'.$id.'" class="cesis_testimonials_ctn '.$style.' cesis_owl_'.$type.' '.$nav_type.' '.$nav_align.' '.$force_font.' col_'.$col.' '.$el_class.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.'" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;" data-col="'.$col.'" data-col_big="'.$col_big.'" data-col_tablet="'.$col_tablet.'" data-col_mobile="'.$col_mobile.'" data-scroll="'.$scroll.'" data-speed="'.$speed.'" data-pag="'.$nav.'" data-pag_tablet="'.$nav_tablet.'" data-pag_mobile="'.$nav_mobile.'" data-nav="no" data-nav_tablet="no" data-nav_mobile="no" data-loop="'.$loop.'" data-center="'.$center.'" data-margin="'.$margin.'">';

}else{

$output .='<div id="cesis_testimonial_'.$id.'" class="cesis_testimonials_ctn '.$style.' cesis_'.$type.' '.$force_font.' '.$el_class.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.'" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px; margin-left:-'.$new_padding.'px; margin-right:-'.$new_padding.'px;">';

}


$values = (array) vc_param_group_parse_atts( $testimonials );


$testimonials_data = array();
foreach ( $values as $data ) {
	$new_testimonial = $data;

	 $new_testimonial['image'] = isset( $data['image'] ) ? $data['image'] : '';
 	 $new_testimonial['author'] = isset( $data['author'] ) ? $data['author'] : '';
 	 $new_testimonial['a_info'] = isset( $data['a_info'] ) ? $data['a_info'] : '';
 	 $new_testimonial['layout'] = isset( $data['layout'] ) ? $data['layout'] : '';
 	 $new_testimonial['class'] = isset( $data['class'] ) ? $data['class'] : '';
 	 $new_testimonial['t_content'] = isset( $data['t_content'] ) ? $data['t_content'] : '';
 	 $new_testimonial['t_color'] = isset( $data['t_color'] ) ? $data['t_color'] : $cesis_data["cesis_main_content_color"];
 	 $new_testimonial['h_color'] = isset( $data['h_color'] ) ? $data['h_color'] : $cesis_data["cesis_main_content_heading"];
 	 $new_testimonial['hl_color'] = isset( $data['hl_color'] ) ? $data['hl_color'] : $cesis_data["cesis_main_content_accent_one"];
 	 $new_testimonial['bg_color'] = isset( $data['bg_color'] ) ? $data['bg_color'] : $cesis_data["cesis_main_content_bg"];
 	 $new_testimonial['b_color'] = isset( $data['b_color'] ) ? $data['b_color'] : $cesis_data["cesis_main_content_border"];

   $testimonials_data[] = $new_testimonial;
}

if($row !== '' && $row_start == ''){
	$row_start = $row;
}

foreach ( $testimonials_data as $testimomial ) {
$img_id = preg_replace( '/[^\d]/', '', $testimomial['image'] );

if($style == "cesis_tm_5"){
$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => array('250','200')  ) );
}else{
$img = wpb_getImageBySize( array( 'attach_id' => $img_id, 'thumb_size' => '250'  ) );
}
if($row == $row_start ){

if($row !== '' ){
	$output .= '<div class="cesis_testimonial_row">';
}
}

if($row !== '' ){
	$row = $row-1;
}


if($type == 'isotope'){

$output .= '<div class="cesis_iso_item '.$testimomial['layout'].'" style="padding:'.$new_padding.'px">';

}

// Start Block 1
if($style == "cesis_tm_1"){

if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.'  '.$testimomial['class'].'" style="border-color:'.$testimomial['b_color'].'; background:'.$testimomial['bg_color'].'; -webkit-box-shadow: 0px -3px 0px 0px '.$testimomial['hl_color'].'; -moz-box-shadow: 0px -3px 0px 0px  '.$testimomial['hl_color'].'; box-shadow: 0px -3px 0px 0px  '.$testimomial['hl_color'].'; ">';

}else{

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.'  '.$testimomial['class'].'" style="border-color:'.$testimomial['b_color'].'; background:'.$testimomial['bg_color'].'; margin-bottom:'.$margin.'px; -webkit-box-shadow: 0px -3px 0px 0px '.$testimomial['hl_color'].'; -moz-box-shadow: 0px -3px 0px 0px  '.$testimomial['hl_color'].'; box-shadow: 0px -3px 0px 0px  '.$testimomial['hl_color'].';">';

}

$output .= '

	<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'</div>
   	<div class="tm_author_info">';

if(!empty($img['thumbnail'])){
$output .= '
		<div class="tm_image">'.$img['thumbnail'].'</div>';
}



if($testimomial['author'] !== '' ){
$output .= '<div class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; '.$h_styles.'">'.$testimomial['author'].'</div>';
}
if($testimomial['a_info'] !== '' ){
$output .= '<div class="tm_info '.$a_font.'" style="color:'.$testimomial['t_color'].';">'.$testimomial['a_info'].'</div>';
}
$output .= '</div>
	</div>';

}
// End Block 1



// Start Block 2
if($style == "cesis_tm_2"){


if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' " style="background:'.$testimomial['bg_color'].';">';

}else{

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' " style="background:'.$testimomial['bg_color'].'; margin-bottom:'.$margin.'px;">';

}

$output .= '

   	<div class="tm_author_info">';

if(!empty($img['thumbnail'])){
$output .= '
		<div class="tm_image">'.$img['thumbnail'].'</div>';
}

if($testimomial['author'] !== '' ){
$output .= '		<div class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; '.$h_styles.'">'.$testimomial['author'].'</div>';
}
if($testimomial['a_info'] !== '' ){
$output .= '		<div class="tm_info '.$a_font.'" style="color:'.$testimomial['hl_color'].'; '.$a_styles.'">'.$testimomial['a_info'].'</div>';
}
$output .= '	</div>
	<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'</div>
	</div>';

}
// End Block 2

// Start Block 3
if($style == "cesis_tm_3"){


if(!empty($img['thumbnail'])){
	$has_thumb = "has_thumbnail";
}else{
	$has_thumb = "";
}

if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$has_thumb.'  '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' " style="background:'.$testimomial['bg_color'].';">';

}else{

$output .= '<div class="cesis_testimonial '.$has_thumb.'  '.$el_class.' inside_e '.$animation.'  '.$testimomial['class'].'" style="background:'.$testimomial['bg_color'].'; margin-bottom:'.$margin.'px;">';

}
if(!empty($img['thumbnail'])){
$output .= '
		<div class="tm_image">'.$img['thumbnail'].'</div>';
}
$output .= '

	<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'</div>
   	<div class="tm_author_info">';

if(!empty($img['thumbnail'])){
$output .= '
		<div class="tm_image" style="background:'.$testimomial['bg_color'].'; border-color:'.$testimomial['hl_color'].';">'.$img['thumbnail'].'</div>';
}


if($testimomial['author'] !== '' ){
$output .= '		<div class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; '.$h_styles.'">'.$testimomial['author'].'</div>';
}
if($testimomial['a_info'] !== '' ){
$output .= '		<div class="tm_info '.$a_font.'" style="color:'.$testimomial['t_color'].'; '.$a_styles.'">'.$testimomial['a_info'].'</div>';
}
$output .= '	</div>
	</div>';

}
// End Block 3


// Start Block 20
if($style == "cesis_tm_20"){


if(!empty($img['thumbnail'])){
	$has_thumb = "has_thumbnail";
}else{
	$has_thumb = "";
}

if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$has_thumb.'  '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' " style="background:'.$testimomial['bg_color'].'; border-color:'.$testimomial['b_color'].';">';

}else{

$output .= '<div class="cesis_testimonial '.$has_thumb.'  '.$el_class.' inside_e '.$animation.'  '.$testimomial['class'].'" style="background:'.$testimomial['bg_color'].'; border-color:'.$testimomial['b_color'].'; margin-bottom:'.$margin.'px;">';

}
if(!empty($img['thumbnail'])){
$output .= '
		<div class="tm_image">'.$img['thumbnail'].'</div>';
}
$output .= '

	<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'</div>
   	<div class="tm_author_info">';

if(!empty($img['thumbnail'])){
$output .= '
		<div class="tm_image">'.$img['thumbnail'].'</div>';
}


if($testimomial['author'] !== '' ){
$output .= '		<div class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; '.$h_styles.'">'.$testimomial['author'].'</div>';
}
if($testimomial['a_info'] !== '' ){
$output .= '		<div class="tm_info '.$a_font.'" style="color:'.$testimomial['t_color'].'; '.$a_styles.'">'.$testimomial['a_info'].'</div>';
}
$output .= '	</div>
	</div>';

}
// End Block 20

// Start Block 4
if($style == "cesis_tm_4"){


if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.'  '.$testimomial['class'].'">';

}else{

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.'  '.$testimomial['class'].'" style="margin-bottom:'.$margin.'px;">';

}

$output .= '

	<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; background:'.$testimomial['bg_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'<span class="tm_arrow" style="color:'.$testimomial['bg_color'].';"></span></div>
   	<div class="tm_author_info">';

if(!empty($img['thumbnail'])){
$output .= '
		<div class="tm_image">'.$img['thumbnail'].'</div>';
}
if($testimomial['author'] !== '' ){
$output .= '<div class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; '.$h_styles.'">'.$testimomial['author'].'</div>';
}
if($testimomial['a_info'] !== ""){
$output .= '<span>/</span><div class="tm_info '.$a_font.'" style="color:'.$testimomial['hl_color'].'; '.$a_styles.'">'.$testimomial['a_info'].'</div>';
}

$output .= '
		</div>
	</div>';

}
// End Block 4


// Start Block 5
if($style == "cesis_tm_5"){


if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.'  '.$testimomial['class'].'" style="background:'.$testimomial['bg_color'].';">';

}else{

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' " style="background:'.$testimomial['bg_color'].'; margin-bottom:'.$margin.'px;">';

}

$output .= '

	<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; border-bottom:1px solid '.$testimomial['b_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'</div>
   	<div class="tm_author_info">';

if(!empty($img['thumbnail'])){
$output .= '
		<div class="tm_image">'.$img['thumbnail'].'</div>';
}

$output .= '<div class="tm_author_container">';
if($testimomial['author'] !== '' ){
$output .= '		<div class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; '.$h_styles.'">'.$testimomial['author'].'</div>';
}
if($testimomial['a_info'] !== '' ){
$output .= '		<div class="tm_info '.$a_font.'" style="color:'.$testimomial['t_color'].'; '.$a_styles.'">'.$testimomial['a_info'].'</div>';
}
$output .= '	</div>
	</div>
	</div>';

}
// End Block 5


// Start Block 6
if($style == "cesis_tm_6"){


if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' ">';

}else{

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.'  '.$testimomial['class'].'" style="margin-bottom:'.$margin.'px;">';

}


if(!empty($img['thumbnail'])){
$output .= '
		<div class="tm_image" style="border-color:'.$testimomial['b_color'].';">'.$img['thumbnail'].'</div>';
}

$output .= '
   	<div class="tm_main_info">
	<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'</div>
	';



if($testimomial['author'] !== '' ){
$output .= '		<div class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; '.$h_styles.'">'.$testimomial['author'].'</div>';
}
if($testimomial['a_info'] !== '' ){
$output .= '<div class="tm_info '.$a_font.'" style="color:'.$testimomial['t_color'].'; '.$a_styles.'">'.$testimomial['a_info'].'</div>';
}
$output .= '</div>
	</div>';

}
// End Block 6

// Start Block 7 | 8
if($style == "cesis_tm_7" || $style == "cesis_tm_8"){


if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.'  '.$testimomial['class'].'">';

}else{

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' " style="margin-bottom:'.$margin.'px;">';

}



$output .= '
		<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'</div>';


if(!empty($img['thumbnail'])){
$output .= '
		<div class="tm_image">'.$img['thumbnail'].'</div>';
}


if($testimomial['author'] !== '' ){
$output .= '<div class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; '.$h_styles.'">'.$testimomial['author'].'</div>';
}
if($testimomial['a_info'] !== '' ){
$output .= '<div class="tm_info '.$a_font.'" style="color:'.$testimomial['t_color'].'; '.$a_styles.'">'.$testimomial['a_info'].'</div>';
}
$output .= '</div>';

}
// End Block 7 | 8


// Start Block 9
if($style == "cesis_tm_9"){

if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' " style="border-color:'.$testimomial['b_color'].'; background:'.$testimomial['bg_color'].';">';

}else{

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].'" style="border-color:'.$testimomial['b_color'].'; background:'.$testimomial['bg_color'].'; margin-bottom:'.$margin.'px; -webkit-box-shadow: 0px -3px 0px 0px '.$testimomial['hl_color'].'; -moz-box-shadow: 0px -3px 0px 0px  '.$testimomial['hl_color'].'; box-shadow: 0px -3px 0px 0px  '.$testimomial['hl_color'].';">';

}

$output .= '
 <div class="tm_rate"><div class="tm_stars"><i class="cesis_icon_inner fa-star"></i><i class="cesis_icon_inner fa-star"></i><i class="cesis_icon_inner fa-star"></i><i class="cesis_icon_inner fa-star"></i><i class="cesis_icon_inner fa-star"></i></div></div>
	<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'</div>
   	<div class="tm_author_info">';

if(!empty($img['thumbnail'])){
$output .= '
		<div class="tm_image">'.$img['thumbnail'].'</div>';
}



if($testimomial['author'] !== '' ){
$output .= '<div class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; '.$h_styles.'">'.$testimomial['author'].'</div>';
}
if($testimomial['a_info'] !== '' ){
$output .= '<div class="tm_info '.$a_font.'" style="color:'.$testimomial['t_color'].';">'.$testimomial['a_info'].'</div>';
}
$output .= '</div>
	</div>';

}
// End Block 9


// Start Block 10
if($style == "cesis_tm_10"){


if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' ">';

}else{

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' " style="margin-bottom:'.$margin.'px;">';

}



$output .= '
		<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'</div>
	   	<div class="tm_author_info" style="color:'.$testimomial['hl_color'].';">';



if($testimomial['author'] !== '' ){
$output .= '<span class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; '.$h_styles.'">'.$testimomial['author'].'</span>';
}
if($testimomial['a_info'] !== '' ){
$output .= '<span class="tm_info '.$a_font.'" style="color:'.$testimomial['t_color'].'; '.$a_styles.'">'.$testimomial['a_info'].'</span>';
}
$output .= '</div>
			</div>';

}
// End Block 10

// Start Block 11
if($style == "cesis_tm_11"){


if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.'  '.$testimomial['class'].'" style="color:'.$testimomial['t_color'].';">';

}else{

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' " style="margin-bottom:'.$margin.'px; color:'.$testimomial['t_color'].';">';

}



$output .= '
		<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'</div>
	   	<div class="tm_author_info" style="color:'.$testimomial['hl_color'].';">';



if($testimomial['author'] !== '' ){
$output .= '<span class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; '.$h_styles.'">'.$testimomial['author'].'</span>';
}
if($testimomial['a_info'] !== '' ){
$output .= '<span class="tm_info '.$a_font.'" style=" '.$a_styles.'">'.$testimomial['a_info'].'</span>';
}
$output .= '</div>
			</div>';

}
// End Block 11


// Start Block 12
if($style == "cesis_tm_12"){


if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' " style="color:'.$testimomial['t_color'].';">';

}else{

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.'  '.$testimomial['class'].'" style="margin-bottom:'.$margin.'px; color:'.$testimomial['t_color'].';">';

}



$output .= '
		<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'</div>
	   	<div class="tm_author_info" style="color:'.$testimomial['hl_color'].';">';



if($testimomial['author'] !== '' ){
$output .= '<span class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; '.$h_styles.'">'.$testimomial['author'].'</span>';
}
if($testimomial['a_info'] !== '' ){
$output .= '<span class="tm_info '.$a_font.'" style="color:'.$testimomial['h_color'].'; '.$a_styles.'">'.$testimomial['a_info'].'</span>';
}
$output .= '</div>
			</div>';

}
// End Block 12


// Start Block 13
if($style == "cesis_tm_13"){


if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' " style="color:'.$testimomial['hl_color'].';">';

}else{

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' " style="margin-bottom:'.$margin.'px; color:'.$testimomial['t_color'].';">';

}



$output .= '
		<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'</div>
	   	<div class="tm_author_info" style="color:'.$testimomial['b_color'].';">';



if($testimomial['author'] !== '' ){
$output .= '<div class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; '.$h_styles.'">'.$testimomial['author'].'</div>';
}
if($testimomial['a_info'] !== '' ){
$output .= '<div class="tm_info '.$a_font.'" style="color:'.$testimomial['t_color'].'; '.$a_styles.'">'.$testimomial['a_info'].'</div>';
}
$output .= '</div>
			</div>';

}
// End Block 13


// Start Block 14 || 17 || 18
if($style == "cesis_tm_14" || $style == "cesis_tm_17" || $style == "cesis_tm_18"  ){


if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' ">';

}else{

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' " style="margin-bottom:'.$margin.'px; color:'.$testimomial['t_color'].';">';

}



$output .= '
		<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'</div>
	   	<div class="tm_author_info">';



if($testimomial['author'] !== '' ){
$output .= '<span class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; '.$h_styles.'">'.$testimomial['author'].'</span>';
}
if($testimomial['a_info'] !== '' ){
$output .= '<span class="tm_info '.$a_font.'" style="color:'.$testimomial['t_color'].'; '.$a_styles.'">'.$testimomial['a_info'].'</span>';
}
$output .= '</div>
			</div>';

}
// End Block 14 || 17 || 18


// Start Block 15 || 16
if($style == "cesis_tm_15" || $style == "cesis_tm_16" ){


if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' ">';

}else{

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' " style="margin-bottom:'.$margin.'px; color:'.$testimomial['t_color'].';">';

}



$output .= '
		<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'</div>';



if($testimomial['author'] !== '' ){
$output .= '<div class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; '.$h_styles.'">'.$testimomial['author'].'</div>';
}
if($testimomial['a_info'] !== '' ){
$output .= '<div class="tm_info '.$a_font.'" style="color:'.$testimomial['t_color'].'; '.$a_styles.'">'.$testimomial['a_info'].'</div>';
}
$output .= '
			</div>';

}
// End Block 15 || 16

// Start Block 19
if($style == "cesis_tm_19"  ){


if($row == '0' || $row == ''  ){

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' ">';

}else{

$output .= '<div class="cesis_testimonial '.$el_class.' inside_e '.$animation.' '.$testimomial['class'].' " style="margin-bottom:'.$margin.'px; color:'.$testimomial['t_color'].';">';

}



$output .= '
		<div class="tm_text '.$text_font.'" style="color:'.$testimomial['t_color'].'; '.$t_styles.'">'.$testimomial['t_content'].'</div>
	   	<div class="tm_author_info">';



if($testimomial['author'] !== '' ){
$output .= '<span class="tm_author '.$heading_font.'" style="color:'.$testimomial['h_color'].'; background-color:'.$testimomial['bg_color'].'; '.$h_styles.'">'.$testimomial['author'].'</span>';
}
if($testimomial['a_info'] !== '' ){
$output .= '<span class="tm_info '.$a_font.'" style="color:'.$testimomial['h_color'].'; background-color:'.$testimomial['bg_color'].'; '.$a_styles.'">'.$testimomial['a_info'].'</span>';
}
$output .= '</div>
			</div>';

}
// End Block 19



if($row == '0' ){

	$output .= '</div>';
	$row = $row_start;

}


if($type == 'isotope'){

$output .= '</div>';
}

}

$output .='</div>';





echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;

}

  }
}





?>
