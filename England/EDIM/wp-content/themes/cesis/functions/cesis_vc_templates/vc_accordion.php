<?php
$output = $title = $interval = $el_class = $collapsible = $active_tab = $style_output = '';

extract(shortcode_atts(array(
	'title' => '',
	'interval' => 0,
	'style' => 'cesis_acc_1',
	'at_t_color'   => '',
    'at_p_color'   => '',
	'at_bg_color'   => '',
    'at_b_color'   => '',
	'at_ct_color'   => '',
    'at_cbg_color'   => '',
    'it_t_color'   => '',
    'it_p_color'   => '',
    'it_bg_color'   => '',
    'it_b_color'   => '',
	'el_class' => '',
	'hide_lg' => '',
	'hide_md' => '',
	'hide_sm' => '',
	'mt' => '0',
	'mb' => '0',
	'collapsible' => 'no',
	'active_tab' => '1'
) , $atts));

$el_id = 'cesis_accordion_' . rand();
preg_match_all('/vc_accordion_tab([^\]]+)/i', $content, $matches, PREG_OFFSET_CAPTURE);
$accordion_tab = array();
if (isset($matches[0]))
{
	$accordion_tab = $matches[0];
}
$counter = 1;
foreach ($accordion_tab as $tab)
{
	if ($counter == $active_tab) $content = str_replace($tab[0], $tab[0] . ' id="' . $el_id . '" active="1"', $content);
	else
	{
		$content = str_replace($tab[0], $tab[0] . ' id="' . $el_id . '"', $content);
	}
	$counter++;
}

$el_class = $this->getExtraClass($el_class);

if($at_t_color !== ''){
	$style_output .= '#'.$el_id.' .panel-title.active a{ color:'.$at_t_color.';}';
}
if($at_p_color !== '' ){
	$style_output .= '#'.$el_id.' .panel-title.active .plus-minus-toggle:before,#'.$el_id.' .panel-title.active .plus-minus-toggle:after{ background:'.$at_p_color.';}';
}
if($at_bg_color !== '' ){
	$style_output .= '#'.$el_id.' .panel-title.active { background:'.$at_bg_color.';}';
}
if($at_b_color !== '' ){
	$style_output .= '#'.$el_id.' .panel-title.active { border-color:'.$at_b_color.';}';
}
if($it_t_color !== ''){
	$style_output .= '#'.$el_id.' .panel-title a{ color:'.$it_t_color.';}';
}
if($it_p_color !== ''){
	$style_output .= '#'.$el_id.' .panel-title .plus-minus-toggle:before,#'.$el_id.' .panel-title .plus-minus-toggle:after{ background:'.$it_p_color.';}';
}
if($it_bg_color !== ''){
	$style_output .= '#'.$el_id.' .panel-title{ background:'.$it_bg_color.';}';
}
if($it_b_color !== ''){
	$style_output .= '#'.$el_id.' .panel-title{ border-color:'.$it_b_color.';}';
}

if($style_output !== ''){
	$output .= '<style>'.$style_output.'</style>';
}

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'cesis_accordion' . $hide_lg  .' '. $hide_md .' '. $hide_sm .' '.$style.' '. $el_class, $this->settings['base'], $atts);

$output.= '<div class="' . esc_attr(trim($css_class)) . '" data-collapsible="' . esc_attr($collapsible) . '" data-active-tab="' . esc_attr($active_tab) . '" style="margin-top:'.$mt.'px; margin-bottom:'.$mb.'px;">';
$output.= '<div class="panel-group" id="' . $el_id . '" role="tablist" aria-multiselectable="true">';
$output.= wpb_widget_title(array(
	'title' => $title,
	'extraclass' => 'wpb_accordion_heading'
));
$output.= wpb_js_remove_wpautop($content);
$output.= '</div>';
$output.= '</div>';

echo wpb_js_remove_wpautop($output);
