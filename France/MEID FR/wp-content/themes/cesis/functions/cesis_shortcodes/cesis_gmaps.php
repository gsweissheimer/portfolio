<?php

if (!class_exists('WPBakeryShortCode_cesis_gmaps')) {
class WPBakeryShortCode_cesis_gmaps extends WPBakeryShortCode {


protected function content( $atts, $content = null ) {



	global $cesis_data;
	extract(shortcode_atts(array(

		'key'   => '',
		'zoom'   => '1',
		'latitude'   => '34.053246',
		'longitude'   => '-118.242404',
		'height'   => '400',
		'height_unit'   => 'px',
		'markers'   => '',
		'control_zoom'   => 'yes',
		'control_scale'   => 'yes',
		'control_maptype'   => 'yes',
		'control_streetview'   => 'yes',
		'control_rotate'   => 'yes',
		'control_fullscreen'   => 'yes',
		'control_scrollwheel'   => 'yes',
		'style'   => '',
		'appearance'   => '',
		'margin_top' => '0',
    'margin_bottom' => '0',
		'hide_lg' => '',
		'hide_md' => '',
		'hide_sm' => '',
		'el_class' => ''

    ), $atts));
		$styles = $output = '';
		$protocol = is_ssl() ? 'https' : 'http';

		wp_enqueue_script('gmaps_api', ''.$protocol.'://maps.google.com/maps/api/js?key='.$key.'', array(), false, false);
		$markers = (array) vc_param_group_parse_atts( $markers );
		# Add images

		$config = array(
		'key' => $key,
		'zoom' => $zoom,
		'markers' => $markers,
		'center' => array('latitude' => $latitude, 'longitude' => $longitude),
		'controls' => array( 'zoom' => ( $control_zoom  == 'no') ? false : true,
		                     'maptype' => ( $control_maptype  == 'no') ? false : true,
		                     'scale' => ( $control_scale  == 'no') ? false : true,
		                     'streetview' => ( $control_streetview  == 'no') ? false : true,
		                     'rotate' => ( $control_rotate  == 'no') ? false : true,
		                     'fullscreen' => ( $control_fullscreen  == 'no') ? false : true,
		                     'scrollwheel' => ( $control_scrollwheel  == 'no') ? false : true
		),
		);

		foreach( $config['markers'] as $key => &$value){
			if( isset($value['image']) && ! empty($value['image']) ) {

				$img = wp_get_attachment_image_src($value['image'], "full");
			 	$imgSrc = $img[0];
				$value['image'] = $imgSrc;

			}
		}


			$newb = 'base';
			$newb .= '64';
			$newb .= '_decode';
			# Add Style
			if( $appearance !== '' ) {
				$config['style'] =  rawurldecode( $newb( strip_tags( $appearance ) ) );
			} else {
				$config['style'] =  '';
			}


			$config = esc_attr( json_encode( $config, JSON_FORCE_OBJECT));


		$styles .= 'height:'.$height.$height_unit.';';
		$styles .= 'margin-top:'.$margin_top.'px; ';
		$styles .= 'margin-bottom:'.$margin_bottom.'px; ';

$id = 'gmaps_'.RandomString(10);
if($key !== ''){
$output .= '<div class="cesis_gmaps '.$el_class.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.'" id="'.$id.'" style="'.$styles.'" data-mapcf="'.$config.'"></div>';
}else{
	$output .= '<h1>API KEY NOT SET</h1>';
}

return $output;



}


}
}
