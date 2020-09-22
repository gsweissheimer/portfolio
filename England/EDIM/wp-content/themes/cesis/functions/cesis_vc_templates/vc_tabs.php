<?php
$output = $title = $interval = $el_class = $tabs_style = '';
extract( shortcode_atts( array(
	'title' => '',
	'interval' => 0,
    'style'   => 'cesis_tab_1',
    'pos'   => 'cesis_tab_left',
    'at_t_color'   => '',
    'at_a_color'   => '',
    'it_t_color'   => '',
    'it_a_color'   => '',
    'it_bg_color'   => '',
    'border_color'   => '',
    'custom_color'   => '',
    'background_color'   => '',
    'text_color'   => '',
    'heading_color'   => '',
    'accent_color'   => '',
    'mt'   => '0',
    'mb'   => '0',
	'hide_lg' => '',
	'hide_md' => '',
	'hide_sm' => '',
	'el_class' => ''
), $atts ) );

$el_class = $this->getExtraClass( $el_class );

$element = 'horizontal';
if ( 'vc_tour' == $this->shortcode ) $element = 'vertical';


$tabs_id = 'tabs_id_'.RandomString(10);


if($pos == 'cesis_tab_left'){
	$b_pos = "left";
}else{
	$b_pos = "right";
}

if($at_t_color !== ''){
	$at_t_color = 'color:'.$at_t_color.';';
}
if($at_a_color !== '' && $style !== 'cesis_tab_3'){
	$at_a_color = 'background:'.$at_a_color.';';
}
if($it_t_color !== ''){
	$it_t_color = 'color:'.$it_t_color.';';
}
if($it_a_color !== ''){
	$it_a_color = 'color:'.$it_a_color.';';
}
if($it_bg_color !== ''){
	$it_bg_color = 'background:'.$it_bg_color.';';
}
if($border_color !== ''){


	$border_gradient = '
    background-image: -webkit-linear-gradient('.$b_pos.', transparent, '.$border_color.');
    background-image: -moz-linear-gradient('.$b_pos.', transparent, '.$border_color.');
    background-image: -o-linear-gradient('.$b_pos.', transparent, '.$border_color.');
	';

	$border_color = 'border-color:'.$border_color.';';

}



if(
    $at_t_color   !== ''||
    $at_a_color   !== ''||
    $it_t_color   !== ''||
    $it_a_color   !== ''||
    $it_bg_color   !== ''||
    $border_color   !== ''||
    $custom_color   !== ''||
    $background_color   !== ''||
    $text_color   !== ''||
    $heading_color   !== ''||
    $accent_color   !== ''
	){
	$tabs_style = '<style type="text/css">';

		if($element == 'horizontal'){

			if($at_a_color !== '' && $style == 'cesis_tab_1'){
			$tabs_style .= '#'.$tabs_id.' .tabs > li.active{ '.$at_a_color.' }';
			}
			elseif($at_a_color !== '' && $style == 'cesis_tab_2'){
			$tabs_style .= '#'.$tabs_id.' .tabs > li.active:before{ '.$at_a_color.' }';
			}
			elseif($at_a_color !== '' && $style == 'cesis_tab_4'){
			$tabs_style .= '#'.$tabs_id.' .tab_moving_line{ '.$at_a_color.' }';
			}
			if($at_t_color !== ''){
			$tabs_style .= '#'.$tabs_id.' .tabs > li.active a{ '.$at_t_color.'}';
			}

   			if($it_t_color   !== '' ){
			$tabs_style .= '#'.$tabs_id.' .tabs > li a{ '.$it_t_color.' }';
			}
	   		if( $it_a_color !== '' ){
			$tabs_style .= '#'.$tabs_id.' .tabs > li:hover:not(.active) a{ '.$it_a_color.' }';
			}
	   		if( $it_bg_color !== '' && $style !== 'cesis_tab_4'){
			$tabs_style .= '#'.$tabs_id.' .tabs > li:not(.active){ '.$it_bg_color.' }';
			}
	   		if( $border_color !== '' && $style !== 'cesis_tab_4'){
			$tabs_style .= '#'.$tabs_id.' .tabs > li,#'.$tabs_id.'.'.$style.' .tabs > li:first-child,#'.$tabs_id.'.'.$style.' .tabs-container{ '.$border_color.' }';
			}
			elseif( $border_color !== '' && $style == 'cesis_tab_4'){
			$tabs_style .= '#'.$tabs_id.' .tabs	{ '.$border_color.' }';
			}


		}elseif($element == 'vertical'){
			if($at_t_color !== ''){
			$tabs_style .= '#'.$tabs_id.' .tabs > li.active a{ '.$at_t_color.'}';
			}
			if($at_a_color !== '' && $style == 'cesis_tab_2'){
			$tabs_style .= '#'.$tabs_id.' .tabs > li.active a:after{ '.$at_a_color.' }';
			}
			if($it_t_color   !== '' ){
			$tabs_style .= '#'.$tabs_id.' .tabs > li a{ '.$it_t_color.' }';
			}
	   		if( $it_a_color !== '' ){
			$tabs_style .= '#'.$tabs_id.' .tabs > li:hover:not(.active) a{ '.$it_a_color.' }';
			}
			if( $border_color !== '' && $style == 'cesis_tab_1'){
			$tabs_style .= '#'.$tabs_id.' .tabs,#'.$tabs_id.'.'.$style.' .tabs-container{ '.$border_color.' }';
			$tabs_style .= '#'.$tabs_id.' .tabs li:after{ '.$border_gradient.' }';
			}

		}

		if($custom_color !== '') {
			if($background_color !== '' && $style !== 'cesis_tab_4' && $element !== 'vertical'){
			$tabs_style .= '#'.$tabs_id.' .tabs-container{ background:'.$background_color.'; }';
			}
			if($text_color !== ''){
			$tabs_style .= '#'.$tabs_id.' .tabs-container{ color:'.$text_color.'; }';
			}
			if($heading_color !== '' ){
			$tabs_style .= '#'.$tabs_id.' .tabs-container h1,#'.$tabs_id.' .tabs-container h2,#'.$tabs_id.' .tabs-container h3,#'.$tabs_id.' .tabs-container h4,#'.$tabs_id.' .tabs-container h5,#'.$tabs_id.' .tabs-container h6,#'.$tabs_id.' .tabs-container h1 a,#'.$tabs_id.' .tabs-container h2 a,#'.$tabs_id.' .tabs-container h3 a,#'.$tabs_id.' .tabs-container h4 a,#'.$tabs_id.' .tabs-container h5 a,#'.$tabs_id.' .tabs-container h6 a{ color:'.$heading_color.'; }';
			}
			if($accent_color !== ''){
			$tabs_style .= '#'.$tabs_id.' .tabs-container a{ color:'.$accent_color.'; }';
			}

		}

	$tabs_style .= '</style>';

	}

$output .= $tabs_style;


// Extract tab titles
preg_match_all( '/vc_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE );
$tab_titles = array();
/**
 * vc_tabs
 *
 */
if ( isset( $matches[1] ) ) {
	$tab_titles = $matches[1];
}
$tabs_nav = '';
$tabs_nav .= '<div id="'.$tabs_id.'" class="tab-holder cesis_tabs '.$element.' '.$style.' '.$pos.' ' . $hide_lg  .' '. $hide_md .' '. $hide_sm .'" style="margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;"><div class="tab-hold tabs-wrapper"><ul class="tabs">';
foreach ( $tab_titles as $tab ) {
	$tab_atts = shortcode_parse_atts($tab[0]);
	if(isset($tab_atts['title'])) {

		$tabs_nav .= '<li class="tabli"><a href="#tab-' . ( isset( $tab_atts['tab_id'] ) ? $tab_atts['tab_id'] : sanitize_title( $tab_atts['title'] ) ) . '">' . $tab_atts['title'] . '</a></li>';

	}
}
$tabs_nav .= '</ul>' . "\n";

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim( $element . ' wpb_content_element ' . $el_class ), $this->settings['base'], $atts );

$output .= wpb_widget_title( array( 'title' => $title, 'extraclass' => $element . '_heading' ) );
$output .= "\n\t\t\t" . $tabs_nav;
$output .= "<div class='tab-box tabs-container'>";
$output .= "\n\t\t\t" . wpb_js_remove_wpautop( $content );
$output .= "</div></div></div>";

echo !empty( $output ) ? $output : '';
