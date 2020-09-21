<?php
$output = $title = $id = $active = '';

extract(shortcode_atts(array(
	'title' => esc_html__("Section", 'cesis'),
	'el_id' => '',
	'id' => '',
	'active' => ''
), $atts));

if($el_id == ''){
$title_id = preg_replace('/[^A-Za-z0-9\-]/', '', sanitize_title($title));
$el_id = 'cesis_'.$title_id.'_'.rand();
}
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'panel panel-default', $this->settings['base'], $atts );
$output .= '<div class="'.esc_attr(trim($css_class)).'">';
$output .= '<div class="panel-heading" role="tab">';
$output .= '<p class="panel-title'.($active ? ' active' : '').'"><a data-toggle="collapse" data-parent="#'.$id.'" href="#'.$el_id.'"><span>'.$title.'</span><span class="plus-minus-toggle '.($active ? '' : ' collapsed').'"></span></a></p>';
$output .= '</div>';
$output .= '<div id="'.$el_id.'" class="panel-collapse collapse'.($active ? ' in' : '').'" role="tabpanel">';
$output .= '<div class="panel-body">';
$output .= ($content=='' || $content==' ') ? esc_html__("Empty section. Edit page to add content here.", 'cesis') : "\n\t\t\t\t\t\t" . $content;
$output .= '</div>';
$output .= '</div>';
$output .= '</div>';

echo wpb_js_remove_wpautop($output);
