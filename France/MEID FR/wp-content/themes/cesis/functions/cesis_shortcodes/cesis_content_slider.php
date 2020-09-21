<?php


if (!class_exists('WPBakeryShortCode_cesis_content_slider')) {
class WPBakeryShortCode_cesis_content_slider extends WPBakeryShortCode {

protected $controls_css_settings = 'out-tc vc_controls-content-widget';


protected function content( $atts, $content = null ) {

global $cesis_data;

	extract(shortcode_atts(array(
				    'loop' => 'yes',
					  'center' => 'no',
				    'nav' => 'no',
		        'nav_tablet' => '',
				    'nav_mobile' => '',
				    'pag' => 'no',
						'pag_type' =>  'cesis_owl_pag_1',
		        'pag_pos' => '',
		        'pag_tablet' => '',
				    'pag_mobile' => '',
				    'pag_color' => '',
				    'pag_active_color' => '',
				    'margin_top' => '0',
				    'margin_bottom' => '0',
						'scroll' => '',
						'speed' => '800',
    'margin_top' => '0',
    'margin_bottom' => '0',
		'hide_lg' => '',
		'hide_md' => '',
		'hide_sm' => '',
		'el_class' => ''

    ), $atts));

/* default color settings from theme options */


ob_start();

$output = $s_output = $style = '';
$id = RandomString(20);
$responsive_options = $hide_lg.' '.$hide_md.' '.$hide_sm.' ';
$margin_settings = ' margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px; ';

			if($nav_tablet == ''){
				$nav_tablet = $nav;
			}
			if($nav_mobile == ''){
				$nav_mobile = $nav;
			}
			if($pag_tablet == ''){
				$pag_tablet = $pag;
			}
			if($pag_mobile == ''){
				$pag_mobile = $pag;
			}
			if($pag == 'yes' || $pag_mobile == 'yes'  || $pag_tablet == 'yes' ){
				if($pag_type == 'cesis_owl_pag_1' && $pag_color !== '' && $pag_active_color !== '' || $pag_type == 'cesis_owl_pag_3' && $pag_color !== '' && $pag_active_color !== ''){
					$s_output .= '#cesis_content_slider_'.$id.' .owl-dot span{background:'.$pag_color.'}#cesis_content_slider_'.$id.' .owl-dot.active  span{background:'.$pag_active_color.'} ';
				}elseif($pag_type == 'cesis_owl_pag_2' && $pag_color !== '' && $pag_active_color !== ''){
					$s_output .= '#cesis_content_slider_'.$id.' .owl-dot span{background:'.$pag_color.'; border-color:'.$pag_color.'}#cesis_content_slider_'.$id.' .owl-dot.active span{background:none; border-color:'.$pag_active_color.'} ';
				}
			}

if($s_output !== ''){
	echo '<style>'.$s_output.'</style>';
}

$carousel_data = ' data-nav='.$nav.' data-nav_tablet='.$nav_tablet.' data-nav_mobile='.$nav_mobile.' data-pag='.$pag.' data-pag_tablet='.$pag_tablet.' data-pag_mobile='.$pag_mobile.' data-loop='.$loop.' data-scroll='.$scroll.' data-speed='.$speed.' ';
?>

<div id="cesis_content_slider_<?php  echo esc_attr($id) ?>" class="cesis_content_slider_ctn cesis_owl_carousel <?php echo esc_attr($pag_type).' '.esc_attr($pag_pos).' '.esc_attr($el_class).' '.esc_attr($responsive_options) ?>"
	 style=" <?php  echo esc_attr($margin_settings) ?>" data-col="1" data-col_tablet="1" data-col_mobile="1" data-center="no" <?php echo esc_attr($carousel_data) ?> >
	 <?php echo do_shortcode($content) ?>
</div>
<?php
echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;


}
}

}
