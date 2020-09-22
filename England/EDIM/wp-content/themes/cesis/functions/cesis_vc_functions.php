<?php
add_action('vc_before_init', 'cesis_SetAsTheme');

function cesis_SetAsTheme()
	{
	vc_set_as_theme();
	}

/* set vc for all post types*/
add_action( 'vc_before_init', 'cesis_vc_posttypes' );
function cesis_vc_posttypes() {
  $vc_list = array('page','post','portfolio','staff','careers','content_block','product');
  vc_set_default_editor_post_types($vc_list);
  vc_editor_set_post_types($vc_list);
}

/* new template folder */
$dir = get_template_directory() . '/functions/cesis_vc_templates';
vc_set_shortcodes_templates_dir($dir);

/* new params style */

function cesis_get_dropdown_option($param, $value)
	{
	if (is_array($value))
		{
		$value = implode(',', $value);
		}

	return ('' !== $value ? $value : '');
	}

function vc_dropdown_multi_form_field($settings, $value)
	{
	$output = '';
	$css_option = str_replace('#', 'hash-', cesis_get_dropdown_option($settings, $value));
	$output.= '<select name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-input wpb-select ' . $settings['param_name'] . ' ' . $settings['type'] . ' ' . $css_option . '" data-option="' . $css_option . '" multiple="multiple">';
	$array_test = explode(',', $css_option);
	if (is_array($value))
		{
		$value = isset($value['value']) ? $value['value'] : array_shift($value);
		}

	if (!empty($settings['value']))
		{
		foreach($settings['value'] as $index => $data)
			{
			if (is_numeric($index) && (is_string($data) || is_numeric($data)))
				{
				$option_label = $data;
				$option_value = $data;
				}
			elseif (is_numeric($index) && is_array($data))
				{
				$option_label = isset($data['label']) ? $data['label'] : array_pop($data);
				$option_value = isset($data['value']) ? $data['value'] : array_pop($data);
				}
			  else
				{
				$option_value = $data;
				$option_label = $index;
				}

			$selected = '';
			$option_value_string = (string)$option_value;
			$value_string = (string)$value;
			if ('' !== $value && $option_value_string === $value_string)
				{
				$selected = ' selected="selected"';
				}

			if (in_array($option_value_string, $array_test))
				{
				$selected = ' selected="selected"';
				}

			$option_class = str_replace('#', 'hash-', $option_value);
			$output.= '<option class="' . esc_attr($option_class) . '" value="' . esc_attr($option_value) . '"' . $selected . '>' . htmlspecialchars($option_label) . '</option>';
			}
		}

	$output.= '</select>';
	return $output;
	}
$vcsp = 'vc_add_';
$vcsp .= 'shortcode_param';

$vcsp('dropdown_multi', 'vc_dropdown_multi_form_field');

function cesis_vc_separator($settings, $value)
	{
	$output.= '';
	return $output;
	}

$vcsp('separator', 'cesis_vc_separator');

function cesis_vc_icon($settings, $value)
	{
	$output.= '<input name="' . $settings['param_name'] . '" class="wpb_vc_param_value wpb-textinput form-control ' . $settings['param_name'] . ' ' . $settings['type'] . '" type="text"	value="' . $value . '">';
	return $output;
	}

$vcsp('cesis_icon', 'cesis_vc_icon');

function buildColStyle($font_color = '')
	{
	$style = '';
	if ('' !== $font_color)
		{
		$style.= vc_get_css_color('color', $font_color);
		}

	return empty($style) ? '' : ' style="' . esc_attr($style) . '"';
	}

// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                            List of template files that I've modified      /////
// //templates/shortcodes/vc_tabs.php
// //templates/shortcodes/vc_tab.php
// /                                                                         /////
//                                                                         /////
// /////////////////////////////////////////////////////////////////////////////


$settings = array(
	'weight' => '96',
);
vc_map_update('vc_empty_space', $settings);

$settings = array(
	'weight' => '94',
	"icon"		=> get_template_directory_uri() . "/includes/images/single_image.svg",
);
vc_map_update('vc_single_image', $settings);

$settings = array(
	'weight' => '81',
	'deprecated' => false,
	'content_element' => true,
	'category' => "Content",
	"icon"		=> get_template_directory_uri() . "/includes/images/tabs.svg",
	'name' => __('Cesis Tabs', 'cesis') ,
);
vc_map_update('vc_tabs', $settings);
$settings = array(
	'weight' => '80',
	'deprecated' => false,
	'content_element' => true,
	'category' => "Content",
	"icon"		=> get_template_directory_uri() . "/includes/images/tours.svg",
	'name' => __('Cesis Tour', 'cesis') ,
);
vc_map_update('vc_tour', $settings);
$settings = array(
	'weight' => '79',
	'deprecated' => false,
	'content_element' => true,
	'category' => "Content",
	"icon"		=> get_template_directory_uri() . "/includes/images/accordion.svg",
	'name' => __('Cesis Accordion', 'cesis') ,
);
vc_map_update('vc_accordion', $settings);
$settings = array(
	'deprecated' => false,
	'content_element' => true,
	'category' => "Content",
	'name' => __('Tab', 'cesis') ,
);
vc_map_update('vc_tab', $settings);
$settings = array(
	'deprecated' => false,
	'content_element' => true,
	'category' => "Content",
	'name' => __('Section', 'cesis') ,
);
vc_map_update('vc_accordion_tab', $settings);


// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                            ROW module modifications                       /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////



$settings = array (
  'weight' => '100',
);

vc_map_update( 'vc_row', $settings );


$attributes = array(
	'type' => 'textfield',
	'heading' => __('Parallax speed', 'cesis') ,
	'param_name' => 'cesis_parallax_speed',
	'weight' => '3',
	'value' => '1.5',
	'dependency' => array(
		'element' => 'parallax',
		'value' => array(
			'cesis_parallax',
		)
	) ,
	'description' => __('Enter parallax speed ratio (Note: Default value is 1.5, min value is 0)', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);

$attributes = array(
	'type' => 'dropdown',
	'heading' => __('Use Featured image as background?', 'cesis') ,
	'param_name' => 'use_fi',
	'weight' => '3',
	'value' => array(
		__( 'No', 'cesis' ) => '',
		__( 'Yes', 'cesis' ) => 'yes',
	),
	'dependency' => array(
		'element' => 'parallax',
		'value' => array(
			'cesis_parallax',
		)
	) ,
	'description' => __('Set to yes to use the page / post featured image as background', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);

$attributes = array(
	'type' => 'dropdown',
	'heading' => __('Content effect', 'cesis') ,
	'param_name' => 'cesis_content_effect',
	'weight' => '3',
	'value' => array(
		__( 'None', 'cesis' ) => '',
		__( 'Sticky', 'cesis' ) => 'cesis_row_e_stick',
		__( 'Fade out', 'cesis' ) => 'cesis_row_e_fade_out',
		__( 'Fade out and sticky', 'cesis' ) => 'cesis_row_e_fade_stick',
	),
	'description' => __('Select the effect to apply to the row content ( optional )', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);


$attributes = array(
	'type' => 'textfield',
	'heading' => __('Effect depth', 'cesis') ,
	'param_name' => 'cesis_content_effect_depth',
	'weight' => '3',
	'value' => '1.5',
	'dependency' => array(
		'element' => 'cesis_content_effect',
		'value' => array(
			'cesis_row_e_stick',
			'cesis_row_e_fade_out',
			'cesis_row_e_fade_stick',
		)
	) ,
	'description' => __('Enter effect depth ratio (Note: Default value is 1.5, min value is 0)', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);

$attributes = array(
	'type' => 'colorpicker',
	'heading' => __('Overlay ( optional )', 'cesis') ,
	'param_name' => 'overlay',
	'weight' => '3',
	'description' => __('Set an overlay color ( optional )', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);


$attributes = array(
	'type' => 'dropdown',
	'heading' => __('Top shape divider', 'cesis') ,
	'param_name' => 'cesis_top_shape',
	'weight' => '3',
	'value' => array(
		__( 'None', 'cesis' ) => 'none',
		__( 'Mountains', 'cesis' ) => 'mountains',
		__( 'Drops', 'cesis' ) => 'drops',
		__( 'Zigzag', 'cesis' ) => 'zigzag',
		__( 'Pyramids', 'cesis' ) => 'pyramids',
		__( 'Triangle', 'cesis' ) => 'triangle',
		__( 'Triangle Asymmetrical', 'cesis' ) => 'triangle-asymmetrical',
		__( 'Tilt', 'cesis' ) => 'tilt',
		__( 'Opacity Tilt', 'cesis' ) => 'opacity-tilt',
		__( 'Opacity Fan', 'cesis' ) => 'opacity-fan',
		__( 'Curve', 'cesis' ) => 'curve',
		__( 'Curve Asymmetrical', 'cesis' ) => 'curve-asymmetrical',
		__( 'Waves', 'cesis' ) => 'waves',
		__( 'Wave Brush', 'cesis' ) => 'wave-brush',
		__( 'Waves Pattern', 'cesis' ) => 'waves-pattern',
		__( 'Arrow', 'cesis' ) => 'arrow',
		__( 'Split', 'cesis' ) => 'split',
		__( 'Book', 'cesis' ) => 'book',
	),
	'description' => __('Select the row top shape divider ( optional )', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);


$attributes = array(
	'type' => 'colorpicker',
	'heading' => __('Top shape color', 'cesis') ,
	'param_name' => 'cesis_top_shape_color',
	'dependency' => array(
		'element' => 'cesis_top_shape',
		'value' => array(
			'mountains',
			'drops',
			'clouds',
			'zigzag',
			'pyramids',
			'triangle',
			'triangle-asymmetrical',
			'tilt',
			'opacity-tilt',
			'opacity-fan',
			'curve',
			'curve-asymmetrical',
			'waves',
			'wave-brush',
			'waves-pattern',
			'arrow',
			'split',
			'book',
		)
	) ,
	'weight' => '3',
	'description' => __('Top shape divider color', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);



$attributes = array(
	'type' => 'textfield',
	'heading' => __('Top shape width ', 'cesis') ,
	'param_name' => 'cesis_top_shape_width',
	'dependency' => array(
		'element' => 'cesis_top_shape',
		'value' => array(
			'mountains',
			'zigzag',
			'pyramids',
			'triangle',
			'triangle-asymmetrical',
			'opacity-tilt',
			'opacity-fan',
			'curve',
			'curve-asymmetrical',
			'waves',
			'wave-brush',
			'waves-pattern',
			'arrow',
			'split',
			'book',
		)
	) ,
	'weight' => '3',
	'value' => '100',
	'description' => __('Set from 100 to 300', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);

$attributes = array(
	'type' => 'textfield',
	'heading' => __('Top shape height', 'cesis') ,
	'param_name' => 'cesis_top_shape_height',
	'dependency' => array(
		'element' => 'cesis_top_shape',
		'value' => array(
			'mountains',
			'drops',
			'clouds',
			'zigzag',
			'pyramids',
			'triangle',
			'triangle-asymmetrical',
			'tilt',
			'opacity-tilt',
			'opacity-fan',
			'curve',
			'curve-asymmetrical',
			'waves',
			'wave-brush',
			'waves-pattern',
			'arrow',
			'split',
			'book',
		)
	) ,
	'weight' => '3',
	'value' => '100',
	'description' => __('Set from 0 to 500', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);


$attributes = array(
	'type' => 'dropdown',
	'heading' => __('Flip the top shape?', 'cesis') ,
	'param_name' => 'cesis_top_shape_flip',
	'weight' => '3',
	'value' => array(
		__( 'No', 'cesis' ) => '',
		__( 'Yes', 'cesis' ) => 'tt-shape-flip',
	),
	'dependency' => array(
		'element' => 'cesis_top_shape',
		'value' => array(
			'mountains',
			'drops',
			'clouds',
			'pyramids',
			'triangle-asymmetrical',
			'tilt',
			'opacity-tilt',
			'opacity-fan',
			'curve-asymmetrical',
			'waves',
			'wave-brush',
			'waves-pattern',
		)
	) ,
	'description' => __('Flip the top shape?', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);

$attributes = array(
	'type' => 'dropdown',
	'heading' => __('Invert the top shape?', 'cesis') ,
	'param_name' => 'cesis_top_shape_invert',
	'weight' => '3',
	'value' => array(
		__( 'No', 'cesis' ) => 'false',
		__( 'Yes', 'cesis' ) => 'true',
	),
	'dependency' => array(
		'element' => 'cesis_top_shape',
		'value' => array(
			'drops',
			'clouds',
			'pyramids',
			'triangle',
			'triangle-asymmetrical',
			'curve',
			'curve-asymmetrical',
			'waves',
			'arrow',
			'split',
			'book',
		)
	) ,
	'description' => __('Invert the top shape?', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);



$attributes = array(
	'type' => 'dropdown',
	'heading' => __('Bottom shape divider', 'cesis') ,
	'param_name' => 'cesis_bottom_shape',
	'weight' => '3',
	'value' => array(
		__( 'None', 'cesis' ) => 'none',
		__( 'Mountains', 'cesis' ) => 'mountains',
		__( 'Drops', 'cesis' ) => 'drops',
		__( 'Zigzag', 'cesis' ) => 'zigzag',
		__( 'Pyramids', 'cesis' ) => 'pyramids',
		__( 'Triangle', 'cesis' ) => 'triangle',
		__( 'Triangle Asymmetrical', 'cesis' ) => 'triangle-asymmetrical',
		__( 'Tilt', 'cesis' ) => 'tilt',
		__( 'Opacity Tilt', 'cesis' ) => 'opacity-tilt',
		__( 'Opacity Fan', 'cesis' ) => 'opacity-fan',
		__( 'Curve', 'cesis' ) => 'curve',
		__( 'Curve Asymmetrical', 'cesis' ) => 'curve-asymmetrical',
		__( 'Waves', 'cesis' ) => 'waves',
		__( 'Wave Brush', 'cesis' ) => 'wave-brush',
		__( 'Waves Pattern', 'cesis' ) => 'waves-pattern',
		__( 'Arrow', 'cesis' ) => 'arrow',
		__( 'Split', 'cesis' ) => 'split',
		__( 'Book', 'cesis' ) => 'book',
	),
	'description' => __('Select the row bottom shape divider ( optional )', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);


$attributes = array(
	'type' => 'colorpicker',
	'heading' => __('Bottom shape color', 'cesis') ,
	'param_name' => 'cesis_bottom_shape_color',
	'dependency' => array(
		'element' => 'cesis_bottom_shape',
		'value' => array(
			'mountains',
			'drops',
			'clouds',
			'zigzag',
			'pyramids',
			'triangle',
			'triangle-asymmetrical',
			'tilt',
			'opacity-tilt',
			'opacity-fan',
			'curve',
			'curve-asymmetrical',
			'waves',
			'wave-brush',
			'waves-pattern',
			'arrow',
			'split',
			'book',
		)
	) ,
	'weight' => '3',
	'description' => __('bottom shape divider color', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);



$attributes = array(
	'type' => 'textfield',
	'heading' => __('Bottom shape width ', 'cesis') ,
	'param_name' => 'cesis_bottom_shape_width',
	'dependency' => array(
		'element' => 'cesis_bottom_shape',
		'value' => array(
			'mountains',
			'zigzag',
			'pyramids',
			'triangle',
			'triangle-asymmetrical',
			'opacity-tilt',
			'opacity-fan',
			'curve',
			'curve-asymmetrical',
			'waves',
			'wave-brush',
			'waves-pattern',
			'arrow',
			'split',
			'book',
		)
	) ,
	'weight' => '3',
	'value' => '100',
	'description' => __('Set from 100 to 300', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);

$attributes = array(
	'type' => 'textfield',
	'heading' => __('Bottom shape height', 'cesis') ,
	'param_name' => 'cesis_bottom_shape_height',
	'dependency' => array(
		'element' => 'cesis_bottom_shape',
		'value' => array(
			'mountains',
			'drops',
			'clouds',
			'zigzag',
			'pyramids',
			'triangle',
			'triangle-asymmetrical',
			'tilt',
			'opacity-tilt',
			'opacity-fan',
			'curve',
			'curve-asymmetrical',
			'waves',
			'wave-brush',
			'waves-pattern',
			'arrow',
			'split',
			'book',
		)
	) ,
	'weight' => '3',
	'value' => '100',
	'description' => __('Set from 0 to 500', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);


$attributes = array(
	'type' => 'dropdown',
	'heading' => __('Flip the bottom shape?', 'cesis') ,
	'param_name' => 'cesis_bottom_shape_flip',
	'weight' => '3',
	'value' => array(
		__( 'No', 'cesis' ) => '',
		__( 'Yes', 'cesis' ) => 'tt-shape-flip',
	),
	'dependency' => array(
		'element' => 'cesis_bottom_shape',
		'value' => array(
			'mountains',
			'drops',
			'clouds',
			'pyramids',
			'triangle-asymmetrical',
			'tilt',
			'opacity-tilt',
			'opacity-fan',
			'curve-asymmetrical',
			'waves',
			'wave-brush',
			'waves-pattern',
		)
	) ,
	'description' => __('Flip the bottom shape?', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);

$attributes = array(
	'type' => 'dropdown',
	'heading' => __('Invert the bottom shape?', 'cesis') ,
	'param_name' => 'cesis_bottom_shape_invert',
	'weight' => '3',
	'value' => array(
		__( 'No', 'cesis' ) => 'false',
		__( 'Yes', 'cesis' ) => 'true',
	),
	'dependency' => array(
		'element' => 'cesis_bottom_shape',
		'value' => array(
			'drops',
			'clouds',
			'pyramids',
			'triangle',
			'triangle-asymmetrical',
			'curve',
			'curve-asymmetrical',
			'waves',
			'arrow',
			'split',
			'book',
		)
	) ,
	'description' => __('Invert the bottom shape?', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row', $attributes);

$attributes = array(
	'type' => 'textfield',
	'heading' => __('Row custom z-index', 'cesis') ,
	'param_name' => 'zindex',
	'weight' => '3',
	'value' => '',
	'description' => __('Set a custom z-index if needed, leave blank to use default', 'cesis') ,
);
vc_add_param('vc_row', $attributes);

$attributes = array(
	'type' => 'checkbox',
	'heading' => __("Allow Overflow?", 'cesis') ,
	'param_name' => 'oflow',
	'weight' => '3',
	'value' => array(
		'Yes' => 'yes'
	) ,
	'description' => __("Select if you want to allow content to overflow.", 'cesis')
);
vc_add_param('vc_row', $attributes);

$attributes = array(
	'param_name' => 'full_width',
	'weight' => '4',
);
vc_update_shortcode_param('vc_row', $attributes);
$attributes = array(
	'param_name' => 'gap',
	'weight' => '4',
);
vc_update_shortcode_param('vc_row', $attributes);
$attributes = array(
	'param_name' => 'full_height',
	'weight' => '4',
);
vc_update_shortcode_param('vc_row', $attributes);
$attributes = array(
	'param_name' => 'columns_placement',
	'weight' => '4',
);
vc_update_shortcode_param('vc_row', $attributes);
$attributes = array(
	'param_name' => 'equal_height',
	'weight' => '4',
);
vc_update_shortcode_param('vc_row', $attributes);
$attributes = array(
	'param_name' => 'content_placement',
	'weight' => '4',
);

$attributes = array(
	'type' => 'textfield',
	'heading' => __('Min-height', 'cesis') ,
	'param_name' => 'min_height',
	'weight' => '4',
	'value' => '',
	'edit_field_class' => 'vc_col-md-6 vc_column',
	'description' => __('Set a min height for the row ( optional )', 'cesis') ,
);
vc_add_param('vc_row', $attributes);
$attributes = array(
	'type' => 'dropdown',
	'heading' => __('Min-height units', 'cesis') ,
	'param_name' => 'min_height_units',
	'weight' => '4',
	'edit_field_class' => 'vc_col-md-6 vc_column',
	'value' => array(
		__( 'px', 'cesis' ) => 'px',
		__( '%', 'cesis' ) => 'vh',
	),
	'description' => __('Select the min height units', 'cesis') ,
);
vc_add_param('vc_row', $attributes);
vc_update_shortcode_param('vc_row', $attributes);
$attributes = array(
	'param_name' => 'video_bg',
	'weight' => '4',
);
vc_update_shortcode_param('vc_row', $attributes);
$attributes = array(
	'param_name' => 'video_bg_url',
	'weight' => '4',
);
vc_update_shortcode_param('vc_row', $attributes);
$attributes = array(
	'type' => 'textfield',
	'heading' => __( 'Vimeo link', 'cesis' ),
	'param_name' => 'vimeo_bg_url',
	'value' => 'https://vimeo.com/101427555',
	// default video url
	'description' => __( 'Add Vimeo link.', 'cesis' ),
	'weight' => '4',
	'dependency' => array(
		'element' => 'video_bg',
		'not_empty' => true,
	),
);
vc_add_param('vc_row', $attributes);
$attributes = array(
	'type' => 'textfield',
	'heading' => __( 'Self hosted video link', 'cesis' ),
	'weight' => '4',
	'param_name' => 'sh_video_bg_url',
	'value' => '',
	// default video url
	'description' => __( 'Add a video link ( mp4,ogg etc ).', 'cesis' ),
	'dependency' => array(
		'element' => 'video_bg',
		'not_empty' => true,
	),
);
vc_add_param('vc_row', $attributes);

$attributes = array(
	'param_name' => 'video_bg_parallax',
	'weight' => '4',
);
vc_update_shortcode_param('vc_row', $attributes);
$attributes = array(
	'param_name' => 'parallax',
	'weight' => '4',
	'value' => array(
		__( 'None', 'cesis' ) => '',
		__( 'Cesis Parallax', 'cesis' ) => 'cesis_parallax',
		__( 'Simple', 'cesis' ) => 'content-moving',
		__( 'With fade', 'cesis' ) => 'content-moving-fade',
	),
);
vc_update_shortcode_param('vc_row', $attributes);
$attributes = array(
	'param_name' => 'parallax_image',
	'weight' => '4',
);
vc_update_shortcode_param('vc_row', $attributes);
$attributes = array(
	'param_name' => 'parallax_speed_video',
	'weight' => '4',
);
vc_update_shortcode_param('vc_row', $attributes);
$attributes = array(
	'param_name' => 'parallax_speed_bg',
	'weight' => '4',
	'dependency' => array(
	'element' => 'parallax',
				'value' => array(
					'content-moving',
					'content-moving-fade'
				),
	),
);
vc_update_shortcode_param('vc_row', $attributes);
$attributes = array(
	'param_name' => 'css_animation',
	'weight' => '2',
);
vc_update_shortcode_param('vc_row', $attributes);

//////////////////////////////////////////////////


$attributes = array(
	'param_name' => 'el_id',
	'weight' => '5',
);
vc_update_shortcode_param('vc_row_inner', $attributes);
$attributes = array(
	'param_name' => 'equal_height',
	'weight' => '5',
);
vc_update_shortcode_param('vc_row_inner', $attributes);
$attributes = array(
	'param_name' => 'content_placement',
	'weight' => '5',
);
vc_update_shortcode_param('vc_row_inner', $attributes);

$attributes = array(
	'type' => 'textfield',
	'heading' => __('Min-height', 'cesis') ,
	'param_name' => 'min_height',
	'weight' => '4',
	'value' => '',
	'edit_field_class' => 'vc_col-md-6 vc_column',
	'description' => __('Set a min height for the row ( optional )', 'cesis') ,
);
vc_add_param('vc_row_inner', $attributes);
$attributes = array(
	'type' => 'dropdown',
	'heading' => __('Min-height units', 'cesis') ,
	'param_name' => 'min_height_units',
	'weight' => '4',
	'edit_field_class' => 'vc_col-md-6 vc_column',
	'value' => array(
		__( 'px', 'cesis' ) => 'px',
		__( '%', 'cesis' ) => 'vh',
	),
	'description' => __('Select the min height units', 'cesis') ,
);
vc_add_param('vc_row_inner', $attributes);

$attributes = array(
	'type' => 'dropdown',
	'heading' => __('Parallax', 'cesis') ,
	'param_name' => 'parallax',
	'weight' => '4',
	'description' => __('Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'cesis') ,
	'value' => array(
		__( 'None', 'cesis' ) => '',
		__( 'Cesis Parallax', 'cesis' ) => 'cesis_parallax',
	),
);
vc_add_param('vc_row_inner', $attributes);
$attributes = array(
	'type' => 'attach_image',
	'param_name' => 'parallax_image',
	'weight' => '4',
	'dependency' => array(
		'element' => 'parallax',
		'value' => array(
			'cesis_parallax',
		)
	) ,
	'description' => __('Select image from media library.', 'cesis') ,
);
vc_add_param('vc_row_inner', $attributes);
$attributes = array(
	'type' => 'textfield',
	'heading' => __('Parallax speed', 'cesis') ,
	'param_name' => 'cesis_parallax_speed',
	'weight' => '3',
	'value' => '1.5',
	'dependency' => array(
		'element' => 'parallax',
		'value' => array(
			'cesis_parallax',
		)
	) ,
	'description' => __('Enter parallax speed ratio (Note: Default value is 1.5, min value is 0)', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row_inner', $attributes);

$attributes = array(
	'type' => 'dropdown',
	'heading' => __('Content effect', 'cesis') ,
	'param_name' => 'cesis_content_effect',
	'weight' => '3',
	'value' => array(
		__( 'None', 'cesis' ) => '',
		__( 'Sticky', 'cesis' ) => 'cesis_row_e_stick',
		__( 'Fade out', 'cesis' ) => 'cesis_row_e_fade_out',
		__( 'Fade out and sticky', 'cesis' ) => 'cesis_row_e_fade_stick',
	),
	'description' => __('Select the effect to apply to the row content ( optional )', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row_inner', $attributes);


$attributes = array(
	'type' => 'textfield',
	'heading' => __('Effect depth', 'cesis') ,
	'param_name' => 'cesis_content_effect_depth',
	'weight' => '3',
	'value' => '1.5',
	'dependency' => array(
		'element' => 'cesis_content_effect',
		'value' => array(
			'cesis_row_e_stick',
			'cesis_row_e_fade_out',
			'cesis_row_e_fade_stick',
		)
	) ,
	'description' => __('Enter effect depth ratio (Note: Default value is 1.5, min value is 0)', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row_inner', $attributes);

$attributes = array(
	'type' => 'dropdown',
	'heading' => __('Add inner container', 'cesis') ,
	'param_name' => 'use_i_c',
	'weight' => '3',
	'std' => 'no',
	'value' => array(
		__( 'yes', 'cesis' ) => 'yes',
		__( 'no', 'cesis' ) => 'no',
	),
	'description' => __('Use if you want to have full widht background but restrained content', 'cesis') ,
);
vc_add_param('vc_row_inner', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __('Overlay ( optional )', 'cesis') ,
	'param_name' => 'overlay',
	'weight' => '3',
	'description' => __('Set an overlay color ( optional )', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_row_inner', $attributes);




// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                            COLUMN module modifications                    /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

$attributes = array(
	'type' => 'colorpicker',
	'heading' => __('Overlay ( optional )', 'cesis') ,
	'param_name' => 'overlay',
	'description' => __('Set an overlay color ( optional )', 'cesis') ,
	'edit_field_class' => 'vc_col-md-6 vc_column'
);
vc_add_param('vc_column', $attributes);


// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                       COLUMN TEXT module modifications                    /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////


$settings = array (
  'weight' => '99',
);

vc_map_update( 'vc_column_text', $settings );

$attributes = array(
	'type' => 'colorpicker',
	'heading' => __('Font Color ( optional )', 'cesis') ,
	'param_name' => 'font_color',
	'weight' => '3',
	'description' => __('Select font color', 'cesis') ,
);
vc_add_param('vc_column_text', $attributes);
$attributes = array(
	'type' => 'textfield',
	'heading' => __("Font size ( optional )", 'cesis' ),
	'param_name' => 'font_size',
	'weight' => '3',
	'value' => '',
	'description' => __("Enter font size ( e.g 18px / 1.2em ) | Leave Blank to use default font size", 'cesis' ),
);
vc_add_param('vc_column_text', $attributes);


$attributes = array(
	'type' => 'checkbox',
	'heading' => __("Resize automatically?", 'cesis') ,
	'param_name' => 'text_resize',
	'weight' => '3',
	'value' => array(
		'Yes' => 'yes'
	) ,
	'description' => __("Select if you want the text to resize automatically.", 'cesis')
);
vc_add_param('vc_column_text', $attributes);


$attributes = array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Font minimum size", 'cesis') ,
	"edit_field_class" => 'vc_col-sm-6 vc_column',
	"param_name" => "text_minimum",
	'weight' => '3',
	"value" => "12",
	"description" => __("Set the minimum size the text will be reduced too", 'cesis'),
	'dependency' => array(
		'element' => 'text_resize',
		'not_empty' => true
	)
);
vc_add_param('vc_column_text', $attributes);

$attributes = array(
	'type' => 'textfield',
	'heading' => __("Line height ( optional )", 'cesis' ),
	'param_name' => 'line_height',
	'weight' => '3',
	'value' => '',
	'description' => __("Enter Line height ( e.g 30px / 1.5em ) | Leave Blank to use default Line height", 'cesis' ),
);
vc_add_param('vc_column_text', $attributes);


$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Text capitalization.", 'cesis') ,
	'param_name' => 'text_transform',
	'weight' => '3',
	'value' => array(
		__("None", 'cesis') => "cesis_text_transform_none",
		__("Uppercase", 'cesis') => "cesis_text_transform_uppercase",
		__("Lowercase", 'cesis') => "cesis_text_transform_lowercase",
	) ,
	'description' => __("Select the text capitalization.", 'cesis')
);
vc_add_param('vc_column_text', $attributes);

$attributes = array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Letter spacing ( optional )", 'cesis') ,
	"param_name" => "letter_spacing",
	'weight' => '3',
	"value" => "0",
	"description" => __("Select the letter spacing ( 0 is the default space )", 'cesis')
);
vc_add_param('vc_column_text', $attributes);

$attributes = array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Max width ( optional )", 'cesis') ,
	"param_name" => "max_width",
	'weight' => '3',
	"value" => "",
	"description" => __("Select the max width of the text container ( px or % / optional )", 'cesis')
);
vc_add_param('vc_column_text', $attributes);


$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Text block position.", 'cesis') ,
	'param_name' => 'text_ctn_pos',
	'weight' => '3',
	'value' => array(
		__("Default", 'cesis') => "",
		__("Center", 'cesis') => "cesis_line_d_center",
		__("Left", 'cesis') => "cesis_line_d_left",
		__("Right", 'cesis') => "cesis_line_d_right",
	) ,
	'dependency' => array(
		'element' => 'max_width',
		'not_empty' => true
	),
	'description' => __("Select text block position.", 'cesis')
);
vc_add_param('vc_column_text', $attributes);

$attributes = array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Animation delay ( optional )", 'cesis') ,
	"param_name" => "delay",
	'weight' => '1',
	"value" => "0",
	"description" => __("Set the animation delay ( e.g 200 )", 'cesis')
);
vc_add_param('vc_column_text', $attributes);


$attributes = array(
	'param_name' => 'content',
	'weight' => '4',
);
vc_update_shortcode_param('vc_column_text', $attributes);
$attributes = array(
	'param_name' => 'css_animation',
	'weight' => '2',
);
vc_update_shortcode_param('vc_column_text', $attributes);



// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                    SINGLE IMAGE module modifications                      /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////



$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Overflow image?", 'cesis') ,
	'param_name' => 'overflow',
	'weight' => '3',
	'value' => array(
		__("Yes", 'cesis') => "yes",
		__("No", 'cesis') => "no",
	) ,
	'std' => 'no',
	'description' => __("Select if you want the image to overflow the container.", 'cesis')
);
vc_add_param('vc_single_image', $attributes);
$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Overflow image?", 'cesis') ,
	'param_name' => 'overflow_pos',
	'weight' => '3',
	'value' => array(
		__("Left", 'cesis') => "cesis_overflow_img_left",
		__("Right", 'cesis') => "cesis_overflow_img_right",
	) ,
	'dependency' => array(
		'element' => 'overflow',
		'value' => array(
			'yes',
		)
	) ,
	'description' => __("Select the direction the image should overflow.", 'cesis')
);
vc_add_param('vc_single_image', $attributes);
$attributes = array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("overflow image width", 'cesis') ,
	"param_name" => "max_width",
	'weight' => '3',
	"value" => "",
	'dependency' => array(
		'element' => 'overflow',
		'value' => array(
			'yes',
		)
	) ,
	"description" => __("Set the image width you want to use for overflow", 'cesis')
);
vc_add_param('vc_single_image', $attributes);
$attributes = array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("overflow image height", 'cesis') ,
	"param_name" => "max_height",
	'weight' => '3',
	"value" => "",
	'dependency' => array(
		'element' => 'overflow',
		'value' => array(
			'yes',
		)
	) ,
	"description" => __("Set the image height you want to use for overflow", 'cesis')
);
vc_add_param('vc_single_image', $attributes);
$attributes = array(
	'param_name' => 'title',
	'weight' => '4',
);
vc_update_shortcode_param('vc_single_image', $attributes);
$attributes = array(
	'param_name' => 'source',
	'weight' => '4',
);
vc_update_shortcode_param('vc_single_image', $attributes);
$attributes = array(
	'param_name' => 'image',
	'weight' => '4',
);
vc_update_shortcode_param('vc_single_image', $attributes);
$attributes = array(
	'param_name' => 'custom_src',
	'weight' => '4',
);
vc_update_shortcode_param('vc_single_image', $attributes);
$attributes = array(
	'param_name' => 'img_size',
	'weight' => '4',
);
vc_update_shortcode_param('vc_single_image', $attributes);
$attributes = array(
	'param_name' => 'external_img_size',
	'weight' => '4',
);
vc_update_shortcode_param('vc_single_image', $attributes);

$attributes = array(
	'param_name' => 'caption',
	'weight' => '2',
);
vc_update_shortcode_param('vc_single_image', $attributes);

$attributes = array(
	'param_name' => 'alignment',
	'weight' => '2',
);
vc_update_shortcode_param('vc_single_image', $attributes);

$attributes = array(
	'param_name' => 'style',
	'weight' => '2',
);
vc_update_shortcode_param('vc_single_image', $attributes);

$attributes = array(
	'param_name' => 'external_style',
	'weight' => '2',
);
vc_update_shortcode_param('vc_single_image', $attributes);

$attributes = array(
	'param_name' => 'border_color',
	'weight' => '2',
);
vc_update_shortcode_param('vc_single_image', $attributes);

$attributes = array(
	'param_name' => 'external_border_color',
	'weight' => '2',
);
vc_update_shortcode_param('vc_single_image', $attributes);

$attributes = array(
	'param_name' => 'onclick',
	'value' => array(
		__( 'None', 'cesis' ) => '',
		__( 'Link to large image', 'cesis' ) => 'img_link_large',
		__( 'Open Lightbox ( cesis )', 'cesis' ) => 'cesis_lightbox',
		__( 'Open prettyPhoto', 'cesis' ) => 'link_image',
		__( 'Open custom link', 'cesis' ) => 'custom_link',
		__( 'Open youtube / vimeo video', 'cesis' ) => 'cesis_video',
		__( 'Zoom', 'cesis' ) => 'zoom',
	),
	'weight' => '2',
);
vc_update_shortcode_param('vc_single_image', $attributes);

$attributes = array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Youtube or Vimeo video link", 'cesis') ,
	"param_name" => "video_link",
	'weight' => '2',
	"value" => "",
	'dependency' => array(
		'element' => 'onclick',
		'value' => array(
			'cesis_video',
		)
	) ,
	"description" => __("Set youtube or vimeo video URL", 'cesis')
);
vc_add_param('vc_single_image', $attributes);

$attributes = array(
	'param_name' => 'link',
	'weight' => '2',
);
vc_update_shortcode_param('vc_single_image', $attributes);

$attributes = array(
	'param_name' => 'img_link_target',
	'weight' => '2',
);
vc_update_shortcode_param('vc_single_image', $attributes);



$attributes = array(
	'type' => 'checkbox',
	"group" => __("Responsive Options", 'cesis') ,
	'heading' => __("Hide on Desktop?", 'cesis') ,
	'param_name' => 'hide_lg',
	'value' => array(
		'Yes' => 'cesis_hidden-lg'
	) ,
	'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
);
vc_add_param('vc_single_image', $attributes);
$attributes = array(
	'type' => 'checkbox',
	"group" => __("Responsive Options", 'cesis') ,
	'heading' => __("Hide on Tablet devices?", 'cesis') ,
	'param_name' => 'hide_md',
	'value' => array(
		'Yes' => 'cesis_hidden-md'
	) ,
	'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
);
vc_add_param('vc_single_image', $attributes);
$attributes = array(
	'type' => 'checkbox',
	"group" => __("Responsive Options", 'cesis') ,
	'heading' => __("Hide on Mobile devices?", 'cesis') ,
	'param_name' => 'hide_sm',
	'value' => array(
		'Yes' => 'cesis_hidden-sm'
	) ,
	'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
);
vc_add_param('vc_single_image', $attributes);

// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                    CUSTOM HEADING module modifications                    /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////


$settings = array (
  'weight' => '98',
);
vc_map_update( 'vc_custom_heading', $settings );



$attributes = array(
	'type' => 'checkbox',
	'heading' => __("Resize automatically?", 'cesis') ,
	'param_name' => 'text_resize',
	'weight' => '3',
	'value' => array(
		'Yes' => 'yes'
	) ,
	'description' => __("Select if you want the text to resize automatically.", 'cesis')
);
vc_add_param('vc_custom_heading', $attributes);


$attributes = array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Font minimum size", 'cesis') ,
	"edit_field_class" => 'vc_col-sm-6 vc_column',
	"param_name" => "text_minimum",
	'weight' => '3',
	"value" => "16",
	"description" => __("Set the minimum size the text will be reduced too", 'cesis'),
	'dependency' => array(
		'element' => 'text_resize',
		'not_empty' => true
	)
);
vc_add_param('vc_custom_heading', $attributes);


$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Text capitalization.", 'cesis') ,
	'param_name' => 'text_transform',
	'weight' => '3',
	'value' => array(
		__("None", 'cesis') => "cesis_text_transform_none",
		__("Uppercase", 'cesis') => "cesis_text_transform_uppercase",
		__("Lowercase", 'cesis') => "cesis_text_transform_lowercase",
	) ,
	'description' => __("Select the text capitalization.", 'cesis')
);
vc_add_param('vc_custom_heading', $attributes);

$attributes = array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Letter spacing ( optional )", 'cesis') ,
	"param_name" => "letter_spacing",
	'weight' => '3',
	"value" => "0",
	"description" => __("Select the letter spacing ( 0 is the default space )", 'cesis')
);
vc_add_param('vc_custom_heading', $attributes);

$attributes = array(
	"type" => "textfield",
	"class" => "",
	"heading" => __("Animation delay ( optional )", 'cesis') ,
	"edit_field_class" => 'vc_col-sm-6 vc_column',
	"param_name" => "delay",
	'weight' => '1',
	"value" => "0",
	"description" => __("Set the animation delay ( e.g 200 )", 'cesis')
);
vc_add_param('vc_custom_heading', $attributes);

$attributes = array(
	'param_name' => 'source',
	'weight' => '4',
);
vc_update_shortcode_param('vc_custom_heading', $attributes);
$attributes = array(
	'param_name' => 'text',
	'weight' => '4',
);
vc_update_shortcode_param('vc_custom_heading', $attributes);
$attributes = array(
	'param_name' => 'link',
	'weight' => '4',
);
vc_update_shortcode_param('vc_custom_heading', $attributes);
$attributes = array(
	'param_name' => 'font_container',
	'weight' => '4',
);
vc_update_shortcode_param('vc_custom_heading', $attributes);
$attributes = array(
	'param_name' => 'use_theme_fonts',
	'weight' => '2',
);
vc_update_shortcode_param('vc_custom_heading', $attributes);
$attributes = array(
	'param_name' => 'google_fonts',
	'weight' => '2',
);
vc_update_shortcode_param('vc_custom_heading', $attributes);
$attributes = array(
	'param_name' => 'css_animation',
	'weight' => '2',
);
vc_update_shortcode_param('vc_custom_heading', $attributes);

$attributes = array(
	'type' => 'checkbox',
	"group" => __("Responsive Options", 'cesis') ,
	'heading' => __("Hide on Desktop?", 'cesis') ,
	'param_name' => 'hide_lg',
	'value' => array(
		'Yes' => 'cesis_hidden-lg'
	) ,
	'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
);
vc_add_param('vc_custom_heading', $attributes);
$attributes = array(
	'type' => 'checkbox',
	"group" => __("Responsive Options", 'cesis') ,
	'heading' => __("Hide on Tablet devices?", 'cesis') ,
	'param_name' => 'hide_md',
	'value' => array(
		'Yes' => 'cesis_hidden-md'
	) ,
	'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
);
vc_add_param('vc_custom_heading', $attributes);
$attributes = array(
	'type' => 'checkbox',
	"group" => __("Responsive Options", 'cesis') ,
	'heading' => __("Hide on Mobile devices?", 'cesis') ,
	'param_name' => 'hide_sm',
	'value' => array(
		'Yes' => 'cesis_hidden-sm'
	) ,
	'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
);
vc_add_param('vc_custom_heading', $attributes);



// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                     TABS / TOUR module modifications                      /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Tabs style", 'cesis') ,
	'param_name' => 'style',
	'value' => array(
		__("Style 1", 'cesis') => "cesis_tab_1",
		__("Style 2", 'cesis') => "cesis_tab_2",
		__("Style 3", 'cesis') => "cesis_tab_3",
		__("Style 4", 'cesis') => 'cesis_tab_4',
		__("Style 5", 'cesis') => 'cesis_tab_5',
	) ,
	'description' => __("Select the Tabs style ( check style design <a href='https://cesis.co/tabs-tour/' target='_blank'>here</a>)", 'cesis')
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Tabs position", 'cesis') ,
	'param_name' => 'pos',
	'value' => array(
		__("Left", 'cesis') => "cesis_tab_left",
		__("Center", 'cesis') => "cesis_tab_center",
		__("Right", 'cesis') => "cesis_tab_right"
	) ,
	'description' => __("Select the Tabs position", 'cesis')
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Active Tab Text color", 'cesis') ,
	'param_name' => 'at_t_color',
	'description' => __("Select the Active Tab text color", 'cesis')
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Active Tab Accent color", 'cesis') ,
	'param_name' => 'at_a_color',
	'description' => __("Select the Active Tab text color", 'cesis') ,
	'dependency' => array(
		'element' => 'style',
		'value' => array(
			'cesis_tab_1',
			'cesis_tab_2',
			'cesis_tab_4',
			'cesis_tab_5',
		)
	) ,
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Inactive Tab Text color", 'cesis') ,
	'param_name' => 'it_t_color',
	'description' => __("Select the Inactive Tab text color", 'cesis')
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Inactive Tab Hover color", 'cesis') ,
	'param_name' => 'it_a_color',
	'description' => __("Select the Inactive Tab hover text color", 'cesis')
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Inactive Tab Background color", 'cesis') ,
	'param_name' => 'it_bg_color',
	'description' => __("Select the Inactive Tab backgro color", 'cesis') ,
	'dependency' => array(
		'element' => 'style',
		'value' => array(
			'cesis_tab_1',
			'cesis_tab_2',
			'cesis_tab_3',
			'cesis_tab_5',
		)
	) ,
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Tabs Border color", 'cesis') ,
	'param_name' => 'border_color',
	'description' => __("Select the Border color", 'cesis')
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'checkbox',
	'heading' => __("Use Custom colors for the tabs content?", 'cesis') ,
	'param_name' => 'custom_color',
	'value' => array(
		'Yes' => 'yes'
	) ,
	'description' => __("Select if you want to use custom colors for the tabs content, if not the theme options color will be used", 'cesis')
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Tabs Content background color", 'cesis') ,
	'param_name' => 'background_color',
	'description' => __("Select the Tabs content background color", 'cesis') ,
	'dependency' => array(
		'element' => 'custom_color',
		'not_empty' => true
	)
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Tabs Content text color", 'cesis') ,
	'param_name' => 'text_color',
	'description' => __("Select the Tabs content text color", 'cesis') ,
	'dependency' => array(
		'element' => 'custom_color',
		'not_empty' => true
	)
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Tabs Content heading color", 'cesis') ,
	'param_name' => 'heading_color',
	'description' => __("Select the Tabs content heading color", 'cesis') ,
	'dependency' => array(
		'element' => 'custom_color',
		'not_empty' => true
	)
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Tabs Content accent color", 'cesis') ,
	'param_name' => 'accent_color',
	'description' => __("Select the Tabs content accent color", 'cesis') ,
	'dependency' => array(
		'element' => 'custom_color',
		'not_empty' => true
	)
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'textfield',
	'heading' => __("Module Top Space", 'cesis') ,
	'param_name' => 'mt',
	"edit_field_class" => 'vc_col-sm-6 vc_column',
	'value' => '0',
	'description' => __("Top margin for the module container ( e.g 30 )", 'cesis') ,
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'textfield',
	'heading' => __("Module Bottom Space", 'cesis') ,
	'param_name' => 'mb',
	"edit_field_class" => 'vc_col-sm-6 vc_column',
	'value' => '0',
	'description' => __("Bottom margin for the module container ( e.g 30 )", 'cesis') ,
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'checkbox',
	"group" => __("Responsive Options", 'cesis') ,
	'heading' => __("Hide on Desktop?", 'cesis') ,
	'param_name' => 'hide_lg',
	'value' => array(
		'Yes' => 'cesis_hidden-lg'
	) ,
	'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'checkbox',
	"group" => __("Responsive Options", 'cesis') ,
	'heading' => __("Hide on Tablet devices?", 'cesis') ,
	'param_name' => 'hide_md',
	'value' => array(
		'Yes' => 'cesis_hidden-md'
	) ,
	'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
);
vc_add_param('vc_tabs', $attributes);
$attributes = array(
	'type' => 'checkbox',
	"group" => __("Responsive Options", 'cesis') ,
	'heading' => __("Hide on Mobile devices?", 'cesis') ,
	'param_name' => 'hide_sm',
	'value' => array(
		'Yes' => 'cesis_hidden-sm'
	) ,
	'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
);
vc_add_param('vc_tabs', $attributes);

// Tour settings

$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Tabs style", 'cesis') ,
	'param_name' => 'style',
	'value' => array(
		__("Style 1", 'cesis') => "cesis_tab_1",
		__("Style 2", 'cesis') => 'cesis_tab_2'
	) ,
	'description' => __("Select the Tabs Style", 'cesis')
);
vc_add_param('vc_tour', $attributes);
$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Tabs position", 'cesis') ,
	'param_name' => 'pos',
	'value' => array(
		__("Left", 'cesis') => "cesis_tab_left",
		__("Right", 'cesis') => "cesis_tab_right"
	) ,
	'description' => __("Select the Tabs position", 'cesis')
);
vc_add_param('vc_tour', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Active Tab Text color", 'cesis') ,
	'param_name' => 'at_t_color',
	'description' => __("Select the Active Tab text color", 'cesis')
);
vc_add_param('vc_tour', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Active Tab Accent color", 'cesis') ,
	'param_name' => 'at_a_color',
	'description' => __("Select the Active Tab text color", 'cesis') ,
	'dependency' => array(
		'element' => 'style',
		'value' => array(
			'cesis_tab_2'
		)
	) ,
);
vc_add_param('vc_tour', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Inactive Tab Text color", 'cesis') ,
	'param_name' => 'it_t_color',
	'description' => __("Select the Inactive Tab text color", 'cesis')
);
vc_add_param('vc_tour', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Inactive Tab Accent color", 'cesis') ,
	'param_name' => 'it_a_color',
	'description' => __("Select the Inactive Tab text color", 'cesis')
);
vc_add_param('vc_tour', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Tabs Border color", 'cesis') ,
	'param_name' => 'border_color',
	'description' => __("Select the Border color", 'cesis') ,
	'dependency' => array(
		'element' => 'style',
		'value' => array(
			'cesis_tab_1'
		)
	) ,
);
vc_add_param('vc_tour', $attributes);
$attributes = array(
	'type' => 'checkbox',
	'heading' => __("Use Custom colors for the tabs content?", 'cesis') ,
	'param_name' => 'custom_color',
	'value' => array(
		'Yes' => 'yes'
	) ,
	'description' => __("Select if you want to use custom colors for the tabs content, if not the theme options color will be used", 'cesis')
);
vc_add_param('vc_tour', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Tabs Content text color", 'cesis') ,
	'param_name' => 'text_color',
	'description' => __("Select the Tabs content text color", 'cesis') ,
	'dependency' => array(
		'element' => 'custom_color',
		'not_empty' => true
	)
);
vc_add_param('vc_tour', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Tabs Content heading color", 'cesis') ,
	'param_name' => 'heading_color',
	'description' => __("Select the Tabs content heading color", 'cesis') ,
	'dependency' => array(
		'element' => 'custom_color',
		'not_empty' => true
	)
);
vc_add_param('vc_tour', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Tabs Content accent color", 'cesis') ,
	'param_name' => 'accent_color',
	'description' => __("Select the Tabs content accent color", 'cesis') ,
	'dependency' => array(
		'element' => 'custom_color',
		'not_empty' => true
	)
);
vc_add_param('vc_tour', $attributes);
$attributes = array(
	'type' => 'textfield',
	'heading' => __("Margin top", 'cesis') ,
	'param_name' => 'mt',
	"edit_field_class" => 'vc_col-sm-6 vc_column',
	'value' => '0',
	'description' => __("Top margin for the module container ( e.g 30 )", 'cesis') ,
);
vc_add_param('vc_tour', $attributes);
$attributes = array(
	'type' => 'textfield',
	'heading' => __("Margin bottom", 'cesis') ,
	'param_name' => 'mb',
	"edit_field_class" => 'vc_col-sm-6 vc_column',
	'value' => '0',
	'description' => __("Bottom margin for the module container ( e.g 30 )", 'cesis') ,
);
vc_add_param('vc_tour', $attributes);
$attributes = array(
	'type' => 'checkbox',
	"group" => __("Responsive Options", 'cesis') ,
	'heading' => __("Hide on Desktop?", 'cesis') ,
	'param_name' => 'hide_lg',
	'value' => array(
		'Yes' => 'cesis_hidden-lg'
	) ,
	'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
);
vc_add_param('vc_tour', $attributes);
$attributes = array(
	'type' => 'checkbox',
	"group" => __("Responsive Options", 'cesis') ,
	'heading' => __("Hide on Tablet devices?", 'cesis') ,
	'param_name' => 'hide_md',
	'value' => array(
		'Yes' => 'cesis_hidden-md'
	) ,
	'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
);
vc_add_param('vc_tour', $attributes);
$attributes = array(
	'type' => 'checkbox',
	"group" => __("Responsive Options", 'cesis') ,
	'heading' => __("Hide on Mobile devices?", 'cesis') ,
	'param_name' => 'hide_sm',
	'value' => array(
		'Yes' => 'cesis_hidden-sm'
	) ,
	'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
);
vc_add_param('vc_tour', $attributes);

// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                            ACCORDION module modifications                 /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

$attributes = array(
	'type' => 'dropdown',
	'heading' => __("Accordion style", 'cesis') ,
	'param_name' => 'style',
	'value' => array(
		__("Style 1", 'cesis') => "cesis_acc_1",
		__("Style 2", 'cesis') => "cesis_acc_2",
		__("Style 3", 'cesis') => "cesis_acc_3",
		__("Style 4", 'cesis') => "cesis_acc_4",
		__("Style 5", 'cesis') => "cesis_acc_5"
	) ,
	'description' => __("Select the Accordion Style ( check style design <a href='https://cesis.co/accordion/' target='_blank'>here</a> )", 'cesis')
);
vc_add_param('vc_accordion', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Active Accordion Title color", 'cesis') ,
	'param_name' => 'at_t_color',
	'description' => __("Select the Active Accordion Title color", 'cesis') ,
);
vc_add_param('vc_accordion', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Active Accordion close button color", 'cesis') ,
	'param_name' => 'at_p_color',
	'description' => __("Select the Active Accordion close button color", 'cesis') ,
);
vc_add_param('vc_accordion', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Active Accordion background color", 'cesis') ,
	'param_name' => 'at_bg_color',
	'description' => __("Select the Active Accordion background color", 'cesis') ,
);
vc_add_param('vc_accordion', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Active Accordion Border color", 'cesis') ,
	'param_name' => 'at_b_color',
	'description' => __("Select the Active Accordion Border color", 'cesis') ,
);
vc_add_param('vc_accordion', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Active Accordion Content text color", 'cesis') ,
	'param_name' => 'at_ct_color',
	'description' => __("Select the Active Accordion Content text color", 'cesis') ,
	'dependency' => array(
		'element' => 'style',
		'value' => array(
			'cesis_acc_1'
		)
	) ,
);
vc_add_param('vc_accordion', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Active Accordion Content background color", 'cesis') ,
	'param_name' => 'at_cbg_color',
	'description' => __("Select the Active Accordion Content background color", 'cesis') ,
	'dependency' => array(
		'element' => 'style',
		'value' => array(
			'cesis_acc_1'
		)
	) ,
);
vc_add_param('vc_accordion', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Inactive Accordion Title color", 'cesis') ,
	'param_name' => 'it_t_color',
	'description' => __("Select the inactive Accordion Title color", 'cesis') ,
);
vc_add_param('vc_accordion', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Inactive Accordion open button color", 'cesis') ,
	'param_name' => 'it_p_color',
	'description' => __("Select the Inactive Accordion open button color", 'cesis') ,
);
vc_add_param('vc_accordion', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Inactive Accordion background color", 'cesis') ,
	'param_name' => 'it_bg_color',
	'description' => __("Select the Inactive Accordion background color", 'cesis') ,
);
vc_add_param('vc_accordion', $attributes);
$attributes = array(
	'type' => 'colorpicker',
	'heading' => __("Inactive Accordion Border color", 'cesis') ,
	'param_name' => 'it_b_color',
	'description' => __("Select the Inactive Accordion Border color", 'cesis') ,
);
vc_add_param('vc_accordion', $attributes);
$attributes = array(
	'type' => 'textfield',
	'heading' => __("Module Top Space", 'cesis') ,
	'param_name' => 'mt',
	"edit_field_class" => 'vc_col-sm-6 vc_column',
	'value' => '0',
	'description' => __("Top margin for the module container ( e.g 30 )", 'cesis') ,
);
vc_add_param('vc_accordion', $attributes);
$attributes = array(
	'type' => 'textfield',
	'heading' => __("Module Bottom Space", 'cesis') ,
	'param_name' => 'mb',
	"edit_field_class" => 'vc_col-sm-6 vc_column',
	'value' => '0',
	'description' => __("Bottom margin for the module container ( e.g 30 )", 'cesis') ,
);
vc_add_param('vc_accordion', $attributes);
$attributes = array(
	'type' => 'checkbox',
	"group" => __("Responsive Options", 'cesis') ,
	'heading' => __("Hide on Desktop?", 'cesis') ,
	'param_name' => 'hide_lg',
	'value' => array(
		'Yes' => 'cesis_hidden-lg'
	) ,
	'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
);
vc_add_param('vc_accordion', $attributes);
$attributes = array(
	'type' => 'checkbox',
	"group" => __("Responsive Options", 'cesis') ,
	'heading' => __("Hide on Tablet devices?", 'cesis') ,
	'param_name' => 'hide_md',
	'value' => array(
		'Yes' => 'cesis_hidden-md'
	) ,
	'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
);
vc_add_param('vc_accordion', $attributes);
$attributes = array(
	'type' => 'checkbox',
	"group" => __("Responsive Options", 'cesis') ,
	'heading' => __("Hide on Mobile devices?", 'cesis') ,
	'param_name' => 'hide_sm',
	'value' => array(
		'Yes' => 'cesis_hidden-sm'
	) ,
	'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
);
vc_add_param('vc_accordion', $attributes);



// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                                 ADD CF7      		                         /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

// Contact form 7 plugin
if (class_exists('WPCF7')) {

add_action('vc_before_init', 'cesis_cf7_sc');

function cesis_cf7_sc()
	{

	global $wpdb;
	$cf7 = $wpdb->get_results(
		"
  SELECT ID, post_title
  FROM $wpdb->posts
  WHERE post_type = 'wpcf7_contact_form'
  "
	);
	$contact_forms = array();
	$contact_forms['Select your form'] = '';
	if ( $cf7 ) {
		foreach ( $cf7 as $cform ) {
			$contact_forms[$cform->post_title] = $cform->ID;
		}
	} else {
		$contact_forms[__( 'No contact forms found', 'cesis' )] = 0;
	}
	vc_map( array(
		'base' => 'cesis_cf7',
		'name' => __( 'Contact Form 7', 'cesis' ),
		"icon"		=> get_template_directory_uri() . "/includes/images/cf7.svg",
		"weight" => "74",
		'category' => __( 'Content', 'cesis' ),
		'description' => __( 'Place Contact Form 7', 'cesis' ),
		'params' => array(
			array(
				'type' => 'dropdown',
				'heading' => __( 'Select contact form', 'cesis' ),
				'param_name' => 'contact_id',
				'value' => $contact_forms,
				'description' => __( 'Choose previously created contact form from the drop down list.', 'cesis' )
			),
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Fields settings', 'cesis') ,
				'param_name' => 'g_field_separator',
				'tag' => 'title'
			) ,
	array(
		'type' => 'dropdown',
		'heading' => __( 'Fields position', 'cesis' ),
		'param_name' => 'type',
		'value' => array(
			__( 'Vertical', 'cesis' ) => 'cesis_cf7_vertical',
			__( 'Horizontal', 'cesis' ) => 'cesis_cf7_horizontal'),
		'description' => __( 'Choose the fields position.', 'cesis' )
	),
 array(
	"type" => "dropdown",
		"class" => "",
		"heading" => __("Number of field in line", 'cesis'),
		"param_name" => "horizontal_number",
		"value" => array(
			__( '2', 'cesis' ) => '2',
			__( '3', 'cesis' ) => '3',
			__( '4', 'cesis' ) => '4',
		),
		'dependency' => array(
			'element' => 'type',
			'value' => array(
				'cesis_cf7_horizontal',
			)
		) ,
		"description" => __("Set the number of field to use in one line", 'cesis'),
	),
	array(
		'type' => 'dropdown',
		'heading' => __( 'Field space', 'cesis' ),
		'param_name' => 'f_space',
		'value' => array(
			__( 'Small', 'cesis' ) => 'cesis_cf7_small',
			__( 'Medium', 'cesis' ) => 'cesis_cf7_medium',
			__( 'Big', 'cesis' ) => 'cesis_cf7_big',
			__( 'Custom', 'cesis' ) => 'custom',
		),
		'std' => 'cesis_cf7_medium',
		'description' => __( 'Choose the size of the space between fields.', 'cesis' )
	),
 array(
	"type" => "textfield",
		"class" => "",
		"heading" => __("Field custom space", 'cesis'),
		"param_name" => "f_custom_space",
		"value" => "20",
		'dependency' => array(
			'element' => 'f_space',
			'value' => array(
				'custom',
			)
		) ,
		"description" => __("Set the space you want to use ( e.g. 30 )", 'cesis'),
	),
 array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Textarea height", 'cesis'),
				"param_name" => "height",
				"value" => "200",
				"description" => __("e.g. 200 (optional)", 'cesis'),
),
 array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Field Border Radius", 'cesis'),
				"param_name" => "f_radius",
				"value" => "0",
				"description" => __("If you want to make the fields rounded ( e.g. 10 (optional) )", 'cesis'),
		 ),
		 array(
			 'type' => 'cesis_vc_separator',
			 'heading' => __('Button settings', 'cesis') ,
			 'param_name' => 'g_button_separator',
			 'tag' => 'title'
		 ) ,
		array(
			'type' => 'dropdown',
			'heading' => __("Button style", 'cesis') ,
			'param_name' => 'button_type',
			'value' => array(
				__("Cesis First button color settings", 'cesis') => "cesis_cf7_btn",
				__("Cesis Second button color settings", 'cesis') => "cesis_cf7_alt_btn",
				__("Cesis Third button color settings", 'cesis') => "cesis_cf7_sub_btn",
				__("Custom colors and font", 'cesis') => "custom"
			) ,
			'description' => __("Select the button style", 'cesis')
		) ,

		 array(
			 'type' => 'dropdown',
			 'heading' => __( 'Button size', 'cesis' ),
			 'param_name' => 'btn_size',
			 'value' => array(
	 			__( 'Small', 'cesis' ) => 'cesis_cf7_small_btn',
	 			__( 'Medium', 'cesis' ) => 'cesis_cf7_medium_btn',
	 			__( 'Big', 'cesis' ) => 'cesis_cf7_big_btn',
				),
			 'description' => __( 'Choose the button size.', 'cesis' )
		 ),

		 array(
			 'type' => 'dropdown',
			 'heading' => __( 'Button size', 'cesis' ),
			 'param_name' => 'btn_width',
			 'value' => array(
	 			__( 'default', 'cesis' ) => '',
	 			__( 'Full width', 'cesis' ) => 'cesis_cf7_fw_btn',
				),
			 'description' => __( 'Choose the button width.', 'cesis' )
		 ),
		  array(
		 				"type" => "textfield",
		 				"class" => "",
		 				"heading" => __("Button Border Radius", 'cesis'),
		 				"param_name" => "btn_radius",
		 				"value" => "0",
		 				"description" => __("If you want to make the button rounded ( e.g. 10 (optional) )", 'cesis'),
		  ),
 		  array(
 		 				"type" => "textfield",
 		 				"class" => "",
 		 				"heading" => __("Button additional Top space", 'cesis'),
 		 				"param_name" => "btn_top_space",
 		 				"value" => "0",
 		 				"description" => __("If you want to add additional space between form and button (optional)", 'cesis'),
 		  ),
		 array(
			 'type' => 'cesis_vc_separator',
			 "group" => __('Colors', 'cesis'),
			 'heading' => __('Fields colors settings', 'cesis') ,
			 'param_name' => 'c_field_separator',
			 'tag' => 'title'
		 ) ,
		array(
			'type' => 'dropdown',
			"group" => __('Colors', 'cesis'),
			'heading' => __("Fields style", 'cesis') ,
			'param_name' => 'f_style',
			'value' => array(
				__("Default", 'cesis') => "",
				__("Transparent ( Dark )", 'cesis') => "cesis_cf7_transparent_dark",
				__("Transparent ( Light )", 'cesis') => "cesis_cf7_transparent",
				__("Custom colors", 'cesis') => "custom"
			) ,
			'description' => __("Select the fields color scheme you want to use", 'cesis')
		) ,
		 	array(
            	"type" => "colorpicker",
							"group" => __('Colors', 'cesis'),
            	"class" => "",
            	"heading" => __("Text color", 'cesis'),
            	"param_name" => "f_text_color",
            	"value" => '', //Default Red color
			 				'dependency' => array(
			 					'element' => 'f_style',
			 					'value' => array(
			 						'custom'
			 					)
			 				) ,
            	"description" => __("Choose the Text color", 'cesis'),
        	),
		 	array(
            	"type" => "colorpicker",
							"group" => __('Colors', 'cesis'),
            	"class" => "",
            	"heading" => __("Place holder", 'cesis'),
            	"param_name" => "f_place_holder",
            	"value" => '', //Default Red color
			 				'dependency' => array(
			 					'element' => 'f_style',
			 					'value' => array(
			 						'custom'
			 					)
			 				) ,
            	"description" => __("Choose the Place holder color", 'cesis'),
        	),
						array(
							"type" => "colorpicker",
							"group" => __('Colors', 'cesis'),
							"class" => "",
							"heading" => __("Field Background color", 'cesis'),
							"param_name" => "f_bg_color",
							"value" => '', //Default Red color
			 				'dependency' => array(
			 					'element' => 'f_style',
			 					'value' => array(
			 						'custom'
			 					)
			 				) ,
							"description" => __("Choose the fields background color", 'cesis'),
						),
	         array(
            	"type" => "colorpicker",
							"group" => __('Colors', 'cesis'),
            	"class" => "",
            	"heading" => __("Field Border color", 'cesis'),
            	"param_name" => "f_b_color",
            	"value" => '', //Default Red color
			 				'dependency' => array(
			 					'element' => 'f_style',
			 					'value' => array(
			 						'custom'
			 					)
			 				) ,
            	"description" => __("Choose the fields color", 'cesis'),
						),
			 		 array(
			 			 'type' => 'cesis_vc_separator',
						 "group" => __('Colors', 'cesis'),
			 			 'heading' => __('Button colors settings', 'cesis') ,
			 			 'param_name' => 'c_button_separator',
			 			 'tag' => 'title'
			 		 ) ,
	         array(
            	"type" => "colorpicker",
							"group" => __('Colors', 'cesis'),
            	"class" => "",
            	"heading" => __("Button text color", 'cesis'),
            	"param_name" => "button_text_color",
			 				"edit_field_class" => 'vc_col-sm-6 vc_column',
            	"value" => '', //Default Red color
			 				'dependency' => array(
			 					'element' => 'button_type',
			 					'value' => array(
			 						'custom'
			 					)
			 				) ,
            	"description" => __("Choose the button text color", 'cesis'),
        	),
	         array(
            	"type" => "colorpicker",
							"group" => __('Colors', 'cesis'),
            	"class" => "",
            	"heading" => __("Button background color", 'cesis'),
            	"param_name" => "button_bg_color",
			 				"edit_field_class" => 'vc_col-sm-6 vc_column',
            	"value" => '', //Default Red color
			 				'dependency' => array(
			 					'element' => 'button_type',
			 					'value' => array(
			 						'custom'
			 					)
			 				) ,
            	"description" => __("Choose the button background color", 'cesis'),
        	),
	         array(
            	"type" => "colorpicker",
							"group" => __('Colors', 'cesis'),
            	"class" => "",
            	"heading" => __("Button border color", 'cesis'),
            	"param_name" => "button_border_color",
			 				"edit_field_class" => 'vc_col-sm-6 vc_column',
            	"value" => '', //Default Red color
			 				'dependency' => array(
			 					'element' => 'button_type',
			 					'value' => array(
			 						'custom'
			 					)
			 				) ,
            	"description" => __("Choose the button background color", 'cesis'),
        	),
	         array(
            	"type" => "colorpicker",
							"group" => __('Colors', 'cesis'),
            	"class" => "",
            	"heading" => __("Button hover text color", 'cesis'),
            	"param_name" => "button_h_text_color",
			 				"edit_field_class" => 'vc_col-sm-6 vc_column',
            	"value" => '', //Default Red color
			 				'dependency' => array(
			 					'element' => 'button_type',
			 					'value' => array(
			 						'custom'
			 					)
			 				) ,
            	"description" => __("Choose the button hover text color", 'cesis'),
        	),
	         array(
            	"type" => "colorpicker",
							"group" => __('Colors', 'cesis'),
            	"class" => "",
            	"heading" => __("Button hover background color", 'cesis'),
            	"param_name" => "button_h_bg_color",
			 				"edit_field_class" => 'vc_col-sm-6 vc_column',
            	"value" => '', //Default Red color
			 				'dependency' => array(
			 					'element' => 'button_type',
			 					'value' => array(
			 						'custom'
			 					)
			 				) ,
            	"description" => __("Choose the button hover tbackground color", 'cesis'),
        	),
	         array(
            	"type" => "colorpicker",
							"group" => __('Colors', 'cesis'),
            	"class" => "",
            	"heading" => __("Button hover border color", 'cesis'),
            	"param_name" => "button_h_border_color",
			 				"edit_field_class" => 'vc_col-sm-6 vc_column',
            	"value" => '', //Default Red color
			 				'dependency' => array(
			 					'element' => 'button_type',
			 					'value' => array(
			 						'custom'
			 					)
			 				) ,
            	"description" => __("Choose the button hover border color", 'cesis'),
        	),
				 	array(
					 'type' => 'cesis_vc_separator',
					 "group" => __('Typography', 'cesis'),
					 'heading' => __('Label settings', 'cesis') ,
					 'param_name' => 't_field_separator',
					 'tag' => 'title'
				 	) ,
					array(
						"type" => "dropdown",
						"group" => __("Typography", 'cesis') ,
						"class" => "",
						"heading" => __("Font weight", 'cesis') ,
						"param_name" => "font_weight",
						"edit_field_class" => 'vc_col-sm-6 vc_column',
						'value' => array(
							__("100 ( thin )", 'cesis') => "100",
							__("300 ( light )", 'cesis') => "300",
							__("400 ( normal )", 'cesis') => "400",
							__("500 ( normal bold )", 'cesis') => "500",
							__("600 ( semi bold )", 'cesis') => "600",
							__("700 ( bold )", 'cesis') => "700",
							__("900 ( extra bold )", 'cesis') => "900",
						) ,
						"std" => "400",
						"description" => __("Select the text / heading font weight.", 'cesis') ,
					) ,
				 	array(
					 'type' => 'cesis_vc_separator',
					 "group" => __('Typography', 'cesis'),
					 'heading' => __('Field settings', 'cesis') ,
					 'param_name' => 'f_field_separator',
					 'tag' => 'title'
				 	) ,
					array(
						"type" => "dropdown",
						"group" => __("Typography", 'cesis') ,
						"class" => "",
						"heading" => __("Font weight", 'cesis') ,
						"param_name" => "f_font_weight",
						"edit_field_class" => 'vc_col-sm-6 vc_column',
						'value' => array(
							__("100 ( thin )", 'cesis') => "cesis_cf7_100",
							__("300 ( light )", 'cesis') => "cesis_cf7_300",
							__("400 ( normal )", 'cesis') => "cesis_cf7_400",
							__("500 ( normal bold )", 'cesis') => "cesis_cf7_500",
							__("600 ( semi bold )", 'cesis') => "cesis_cf7_600",
							__("700 ( bold )", 'cesis') => "cesis_cf7_700",
							__("900 ( extra bold )", 'cesis') => "cesis_cf7_900",
						) ,
						"std" => "cesis_cf7_400",
						"description" => __("Select the field text font weight.", 'cesis') ,
					) ,
					array(
						"type" => "dropdown",
						"group" => __("Typography", 'cesis') ,
						"class" => "",
						"heading" => __("Text capitalization", 'cesis') ,
						"param_name" => "f_text_transform",
						"edit_field_class" => 'vc_col-sm-6 vc_column',
						'value' => array(
							__("None", 'cesis') => "cesis_cf7_none",
							__("Uppercase", 'cesis') => "cesis_cf7_uppercase",
							__("Lowercase", 'cesis') => "cesis_cf7_lowercase",
							__("Capitalize", 'cesis') => "cesis_cf7_capitalize",
						) ,
						"std" => "cesis_cf7_none",
						"description" => __("Select the field text capitalization.", 'cesis') ,
					) ,
				 	array(
					 'type' => 'cesis_vc_separator',
					 "group" => __('Typography', 'cesis'),
					 'heading' => __('Button settings', 'cesis') ,
					 'param_name' => 't_button_separator',
					 'tag' => 'title'
				 	) ,
					array(
						'type' => 'google_fonts',
						"group" => __("Typography", 'cesis') ,
						'param_name' => 'button_google_fonts',
						'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
						'settings' => array(
							'fields' => array(
								'font_family_description' => __('Select font family.', 'cesis') ,
								'font_style_description' => __('Select font styling.', 'cesis') ,
							) ,
						) ,
						'dependency' => array(
							'element' => 'button_type',
							'value' => array(
								'custom'
							)
						) ,
					) ,
					array(
						"type" => "textfield",
						"class" => "",
						"group" => __("Typography", 'cesis') ,
						"heading" => __("Button font size", 'cesis') ,
						"edit_field_class" => 'vc_col-sm-6 vc_column',
						"param_name" => "button_f_size",
						"value" => __("14px", 'cesis') ,
						'dependency' => array(
							'element' => 'button_type',
							'value' => array(
								'custom'
							)
						) ,
						"description" => __("Select the font size, for example 30px / 2em", 'cesis')
					) ,
					array(
						"type" => "dropdown",
						"class" => "",
						"group" => __("Typography", 'cesis') ,
						"heading" => __("Button capitalization", 'cesis') ,
						"param_name" => "button_t_transform",
						"edit_field_class" => 'vc_col-sm-6 vc_column',
						'value' => array(
							__("None", 'cesis') => "none",
							__("Uppercase", 'cesis') => "uppercase",
							__("Lowercase", 'cesis') => "lowercase",
						) ,
						"std" => "uppercase",
						'dependency' => array(
							'element' => 'button_type',
							'value' => array(
								'custom'
							)
						) ,
						"description" => __("Select the button capitalization.", 'cesis') ,
					) ,
					array(
						"type" => "textfield",
						"class" => "",
						"group" => __("Typography", 'cesis') ,
						"heading" => __("Button Letter Spacing", 'cesis') ,
						"edit_field_class" => 'vc_col-sm-6 vc_column',
						"param_name" => "button_l_spacing",
						"value" => __("0", 'cesis') ,
						'dependency' => array(
							'element' => 'button_type',
							'value' => array(
								'custom'
							)
						) ,
						"description" => __("Select the button letter spacing ( 0 is the default space )", 'cesis')
					) ,

			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Module general settings', 'cesis') ,
				'param_name' => 'g_module_separator',
				'tag' => 'title'
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay ( optional )", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "delay",
				"value" => "0",
				"description" => __("Set the animation delay ( e.g 200 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'cesis') ,
				'param_name' => 'el_class',
				'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	) );
}
} // if contact form7 plugin active


// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                            ADD IMAGES GALLERY 		                         /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

add_action('vc_before_init', 'cesis_gallery_sc');

function cesis_gallery_sc()
	{
	vc_map(array(
		"name" => __("Images Gallery", 'cesis') ,
		"base" => "cesis_gallery",
		"icon"		=> get_template_directory_uri() . "/includes/images/images_gallery.svg",
		"class" => "",
		"weight" => "93",
		"category" => __('Content', 'cesis') ,
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Gallery type", 'cesis') ,
				"param_name" => "type",
				'value' => array(
					__("Isotope Grid", 'cesis') => "isotope_grid",
					__("Isotope Masonry", 'cesis') => "isotope_masonry",
					__("Carousel", 'cesis') => "carousel",
				) ,
				"description" => __("Select the Gallery type.", 'cesis')
			) ,
			array(
 				'type' => 'attach_images',
 				'heading' => __( 'Images', 'cesis' ),
 				'param_name' => 'images',
 				'value' => '',
 				'description' => __( 'Select images from media library.', 'cesis' )
			),
		array(
			'type' => 'textfield',
			'heading' => __( 'Image size', 'cesis' ),
			'param_name' => 'img_size',
			'value' => 'thumbnail',
			'description' => __( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size.', 'cesis' ),

		),

		array(
			'type' => 'dropdown',
			'heading' => __( 'On click action', 'cesis' ),
			'param_name' => 'onclick',
			'value' => array(
				__( 'None', 'cesis' ) => '',
				__( 'Link to large image', 'cesis' ) => 'img_link_large',
				__( 'Open in lightbox', 'cesis' ) => 'link_image',
				__( 'Open custom link', 'cesis' ) => 'custom_link',
			),
			'description' => __( 'Select action for click action.', 'cesis' ),
			'std' => 'link_image',
		),
		array(
			'type' => 'exploded_textarea_safe',
			'heading' => __( 'Custom links', 'cesis' ),
			'param_name' => 'custom_links',
			'description' => __( 'Enter links for each slide (Note: divide links with linebreaks (Enter)).', 'cesis' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array( 'custom_link' ),
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Custom link target', 'cesis' ),
			'param_name' => 'custom_links_target',
			'description' => __( 'Select where to open custom links.', 'cesis' ),
			'dependency' => array(
				'element' => 'onclick',
				'value' => array(
					'custom_link',
					'img_link_large',
				),
			),
				'value' => array(
					__("Same window", 'cesis') => "_self",
					__("New window", 'cesis') => "_blank",
				) ,
		),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Additional effect", 'cesis') ,
				"param_name" => "effect",
				'value' => array(
					__("None", 'cesis') => "",
					__("Shadow", 'cesis') => "cesis_effect_shadow",
					__("Image Zoom In", 'cesis') => "cesis_effect_zoomIn",
					__("Image Zoom Out", 'cesis') => "cesis_effect_zoomOut",
					__("Add Color", 'cesis') => "cesis_effect_color",
					__("Remove Color", 'cesis') => "cesis_effect_decolor",
					__("White frame ( On image style only )", 'cesis') => "cesis_effect_frame",
				) ,
				"description" => __("Select the additional effect you want to use.", 'cesis')
			) ,
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Number of images per line?", 'cesis') ,
			"param_name" => "col",
			"edit_field_class" => 'vc_col-sm-6 vc_column',
			'value' => array(
				"1" => "1",
				"2" => "2",
				"3" => "3",
				"4" => "4",
				"5" => "5",
				"6" => "6",
				"7" => "7",
				"8" => "8",
			) ,
			"description" => __("Select the number of images to show per line.", 'cesis')
		) ,
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Choose the space between the items", 'cesis') ,
			"param_name" => "padding",
			"edit_field_class" => 'vc_col-sm-6 vc_column',
			'value' => "30",
			"description" => __("Select the space between the items, default 30.", 'cesis')
		) ,
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Infinite loop?", 'cesis') ,
			"param_name" => "loop",
			'value' => array(
				__("Yes", 'cesis') => "yes",
				__("No", 'cesis') => "no"
			) ,
			'dependency' => array(
				'element' => 'type',
				'value' => array(
					'carousel'
				)
			) ,
			"description" => __("Select if you want to duplicate last and first items to get loop illusion.", 'cesis')
		) ,
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Center the active item", 'cesis') ,
			"param_name" => "center",
			'value' => array(
				__("No", 'cesis') => "no",
				__("Yes", 'cesis') => "yes"
			) ,
			'dependency' => array(
				'element' => 'type',
				'value' => array(
					'carousel'
				)
			) ,
			"description" => __("Select if you want to active item to be in the Center of the carousel container.", 'cesis')
		) ,
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Auto Rotate?", 'cesis') ,
			"param_name" => "scroll",
			'value' => array(
				__("No", 'cesis') => "no",
				__("Yes", 'cesis') => "yes",
			) ,
			'dependency' => array(
				'element' => 'type',
				'value' => array(
					'carousel'
				)
			) ,
			"description" => __("Select if you want the carousel to rotate automatically.", 'cesis')
		) ,
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Rotation speed", 'cesis') ,
			"param_name" => "speed",
			"value" => "800",
			"description" => __("Select the rotation speed in milliseconds ( example 2000 for 2 seconds )", 'cesis') ,
			'dependency' => array(
				'element' => 'scroll',
				'value' => array(
					'yes'
				)
			)
		) ,
		vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Extra class name", 'cesis') ,
				"param_name" => "el_class",
				"value" => "",
				"description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Show navigation?", 'cesis') ,
				"param_name" => "nav",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation for the carousel.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Show pagination ( dots )?", 'cesis') ,
				"param_name" => "pag",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use pagination for the carousel.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots style", 'cesis') ,
				"param_name" => "pag_type",
				'value' => array(
					__("Grey dots", 'cesis') => 'cesis_owl_pag_1',
					__("White with shadow dots", 'cesis') => "cesis_owl_pag_3",
					__("Outline dots", 'cesis') => "cesis_owl_pag_2",
				) ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the pagination dots design you want to use.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots position", 'cesis') ,
				"param_name" => "pag_pos",
				'value' => array(
					__("Under content", 'cesis') => '',
					__("Over content", 'cesis') => "cesis_owl_pag_over",
				) ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the pagination dots position.", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination color", 'cesis') ,
				"param_name" => "pag_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the navigation color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination active color", 'cesis') ,
				"param_name" => "pag_active_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active pagination color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for big display / devices?", 'cesis') ,
				"param_name" => "col_big",
				'value' => array(
					"inherit " => "inherit",
					"1 " => "1",
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5"
				) ,
				"std" => "inherit",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of item to show per line for big display / devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for tablet devices?", 'cesis') ,
				"param_name" => "col_tablet",
				'value' => array(
					"1 " => "1",
					"2" => "2",
					"3" => "3"
				) ,
				"std" => "2",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of items to show per line for tablet devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show navigation on tablet devices?", 'cesis') ,
				"param_name" => "nav_tablet",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on tablet devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show pagination on tablet devices?", 'cesis') ,
				"param_name" => "pag_tablet",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use pagination on tablet devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for mobile devices?", 'cesis') ,
				"param_name" => "col_mobile",
				'value' => array(
					"1 " => "1",
					"2" => "2",
					"3" => "3"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of items to show per line for mobile devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show navigation on mobile devices?", 'cesis') ,
				"param_name" => "nav_mobile",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show pagination on mobile devices?", 'cesis') ,
				"param_name" => "pag_mobile",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	));
	}


// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                            ADD SHARE ICONS    		                         /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////



add_action('vc_before_init', 'cesis_share_sc');

function cesis_share_sc()
	{


	vc_map( array(
		'base' => 'cesis_share_shortcode',
		'name' => __( 'Share icons', 'cesis' ),
		"icon"		=> get_template_directory_uri() . "/includes/images/share_icons.svg",
		"weight" => "82",
		'category' => __( 'Content', 'cesis' ),
		'description' => __( 'Display share icons', 'cesis' ),
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Link to share', 'cesis' ),
				'param_name' => 'link',
				'value' => 'http://google.com',
				'description' => __( 'Set the link to share ( use http )', 'cesis' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Title to share', 'cesis' ),
				'param_name' => 'title',
				'value' => 'Cesis awesome page',
				'description' => __( 'Set the title to share', 'cesis' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Icons type', 'cesis' ),
				'param_name' => 'type',
				'value' => array(
					__( 'Simple', 'cesis' ) => 'cesis_share_io',
					__( 'Rounded', 'cesis' ) => 'cesis_share_rounded',
					__( 'Squared', 'cesis' ) => 'cesis_share_squared',
					__( 'Rounded corner', 'cesis' ) => 'cesis_share_rounded_c',
				),
				'description' => __( 'Choose the icons type.', 'cesis' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Icons size', 'cesis' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Small', 'cesis' ) => 'cesis_share_small',
					__( 'Big', 'cesis' ) => 'cesis_share_big',
				),
				'description' => __( 'Choose the icons size.', 'cesis' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Icons position', 'cesis' ),
				'param_name' => 'position',
				'value' => array(
					__( 'Left', 'cesis' ) => 'cesis_share_left',
					__( 'Right', 'cesis' ) => 'cesis_share_right',
					__( 'Center', 'cesis' ) => 'cesis_share_center',
					__( 'Justified', 'cesis' ) => 'cesis_share_justify',
				),
				'description' => __( 'Choose the icons position.', 'cesis' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Space', 'cesis' ),
				'param_name' => 'space',
				'value' => '20',
				'description' => __( 'Set the space between the icons.', 'cesis' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __("Icon colors", 'cesis') ,
				'param_name' => 'color_type',
				'value' => array(
					__("Colorized ( will use default social icon color )", 'cesis') => "cesis_share_colorized",
					__("Grey", 'cesis') => "cesis_share_grey",
					__("Transparent", 'cesis') => "cesis_share_transparent",
					__("Custom", 'cesis') => "custom"
				) ,
				'description' => __("Select the icons color style", 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Facebook", 'cesis') ,
				'param_name' => 'facebook',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to show facebook share icon", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Twitter", 'cesis') ,
				'param_name' => 'twitter',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to show twitter share icon", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Google", 'cesis') ,
				'param_name' => 'google',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to show google share icon", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Pinterest", 'cesis') ,
				'param_name' => 'pinterest',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to show pinterest share icon", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Linkedin", 'cesis') ,
				'param_name' => 'linkedin',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to show linkedin share icon", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Reddit", 'cesis') ,
				'param_name' => 'reddit',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to show reddit share icon", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Tumblr", 'cesis') ,
				'param_name' => 'tumblr',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to show tumblr share icon", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Xing", 'cesis') ,
				'param_name' => 'xing',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to show xing share icon", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("VK", 'cesis') ,
				'param_name' => 'vk',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to show vk share icon", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Mail", 'cesis') ,
				'param_name' => 'mail',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to show mail share icon", 'cesis') ,
			) ,
		 array(
			 "type" => "colorpicker",
				"group" => __('Colors', 'cesis'),
        "class" => "",
        "heading" => __("Icon color", 'cesis'),
        "param_name" => "icon_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
        "value" => '', //Default Red color
			 	'dependency' => array(
			 		'element' => 'color_type',
			 			'value' => array(
			 				'custom'
			 			)
			 		) ,
        "description" => __("Choose the Icon color", 'cesis'),
      ),
		 array(
			 "type" => "colorpicker",
				"group" => __('Colors', 'cesis'),
        "class" => "",
        "heading" => __("Icon background color", 'cesis'),
        "param_name" => "icon_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
        "value" => '', //Default Red color
			 	'dependency' => array(
			 	'element' => 'color_type',
			 		'value' => array(
			 			'custom'
			 		)
			 	) ,
        "description" => __("Choose the Icon background color", 'cesis'),
      ),
		 array(
			 "type" => "colorpicker",
				"group" => __('Colors', 'cesis'),
        "class" => "",
        "heading" => __("Icon border color", 'cesis'),
        "param_name" => "icon_b_color",
        "value" => '', //Default Red color
			 	'dependency' => array(
			 	'element' => 'color_type',
			 		'value' => array(
			 			'custom'
			 		)
			 	) ,
        "description" => __("Choose the Icon border color", 'cesis'),
      ),
		 array(
			 "type" => "colorpicker",
				"group" => __('Colors', 'cesis'),
        "class" => "",
        "heading" => __("Icon hover color", 'cesis'),
        "param_name" => "icon_h_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
        "value" => '', //Default Red color
			 	'dependency' => array(
			 		'element' => 'color_type',
			 			'value' => array(
			 				'custom'
			 			)
			 		) ,
        "description" => __("Choose the Icon hover color", 'cesis'),
      ),
		 array(
			 "type" => "colorpicker",
				"group" => __('Colors', 'cesis'),
        "class" => "",
        "heading" => __("Icon hover background color", 'cesis'),
        "param_name" => "icon_h_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
        "value" => '', //Default Red color
			 	'dependency' => array(
			 	'element' => 'color_type',
			 		'value' => array(
			 			'custom'
			 		)
			 	) ,
        "description" => __("Choose the Icon hover background color", 'cesis'),
      ),
		 array(
			 "type" => "colorpicker",
				"group" => __('Colors', 'cesis'),
        "class" => "",
        "heading" => __("Icon hover border color", 'cesis'),
        "param_name" => "icon_h_b_color",
        "value" => '', //Default Red color
			 	'dependency' => array(
			 	'element' => 'color_type',
			 		'value' => array(
			 			'custom'
			 		)
			 	) ,
        "description" => __("Choose the Icon hover border color", 'cesis'),
      ),
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay ( optional )", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "delay",
				"value" => "0",
				"description" => __("Set the animation delay ( e.g 200 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'cesis') ,
				'param_name' => 'el_class',
				'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	) );
}



// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                              ADD COUNT TO    		                         /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

add_action('vc_before_init', 'cesis_count_to_sc');

function cesis_count_to_sc()
	{
	vc_map(array(
		"name" => __("Count to", 'cesis') ,
		"base" => "cesis_count_to",
		"icon"		=> get_template_directory_uri() . "/includes/images/count_to.svg",
		"class" => "",
		"weight" => "76",
		"category" => __('Content', 'cesis') ,
		"params" => array(
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Number", 'cesis') ,
				"param_name" => "number",
				"value" => "1000",
				"description" => __("Put the number to count to, if you use number with decimal example 1234.01 then set the decimal to 2", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Use Decimal?", 'cesis') ,
				"param_name" => "d",
				"value" => array(
					__("No ", 'cesis') => "",
					__("Yes ", 'cesis') => "yes"
				) ,
				"description" => __("Decimal ", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Number of Decimals", 'cesis') ,
				"param_name" => "d_number",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "",
				"description" => __("Put the number of decimals of your number, example : 1234.0 = 1, 1234.01 = 2, 1234.012 = 3", 'cesis') ,
				'dependency' => array(
					'element' => 'd',
					'value' => 'yes'
				)
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Decimal Seperator", 'cesis') ,
				"param_name" => "d_separator",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => ".",
				"description" => __("Choose the Decimal Separator, example : , . | -", 'cesis') ,
				'dependency' => array(
					'element' => 'd',
					'value' => 'yes'
				)
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Use Separator?", 'cesis') ,
				"param_name" => "use_separator",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => array(
					__("No ", 'cesis') => "",
					__("Yes ", 'cesis') => "yes"
				) ,
				"description" => __("Will add a separator every 3 number, example 1234 will change to 1.234", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Seperator", 'cesis') ,
				"param_name" => "separator",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => ",",
				"description" => __("Choose Separator, example : , . | -", 'cesis') ,
				'dependency' => array(
					'element' => 'use_separator',
					'value' => 'yes'
				)
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Speed", 'cesis') ,
				"param_name" => "speed",
				"value" => __("2", 'cesis') ,
				"description" => __("Speed in Second, example : 0.1 = super fast ( 0,1 second ) , 2 = default ( two seconds ) , 5 = slow ( five seconds )", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Number color ( Optional )", 'cesis') ,
				"param_name" => "number_color",
				"value" => '',
				"description" => __("Choose a number color, if not color choosen the theme will use the theme panel color settings", 'cesis') ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Font family', 'cesis') ,
				'param_name' => 'count_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'google_fonts',
				'value' => 'font_family:Abril%20Fatface%3Aregular|font_style:400%20regular%3A400%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'count_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "number_size",
				"value" => __("30px", 'cesis') ,
				"description" => __("Select the number font size, for example 30px", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Font weight", 'cesis') ,
				"param_name" => "number_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				"description" => __("Select the button font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'count_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "number_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the number font letter spacing ( 0 is the default space )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Prefix ( Optional )", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "prefix",
				"value" => "",
				"description" => __("If you want to use a Prefix, example $", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Suffix ( Optional )", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "suffix",
				"value" => "",
				"description" => __("If you want to use a Suffix, example K, €", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Extra class name", 'cesis') ,
				"param_name" => "el_class",
				"value" => "",
				"description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	));
	}

// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                         ADD CIRCULAR PROGRESS BAR                         /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

add_action('vc_before_init', 'cesis_circular_progress_bar_sc');

function cesis_circular_progress_bar_sc()
	{
	vc_map(array(
		"name" => __("Circular progress bar", 'cesis') ,
		"base" => "cesis_circular_progress_bar",
		"icon"		=> get_template_directory_uri() . "/includes/images/circular_progress_bar.svg",
		"class" => "",
		"weight" => "77",
		"category" => __('Content', 'cesis') ,
		"params" => array(
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Progress bar settings', 'cesis') ,
				'param_name' => 'g_cpb',
				'tag' => 'title'
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Percentage", 'cesis') ,
				"param_name" => "percentage",
				"value" => "80",
				"description" => __("Put progress number from 0 to 100", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Circular chart size", 'cesis') ,
				"param_name" => "canvas_size",
				"value" => "180",
				"description" => __("Select the size of the module", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Bar size", 'cesis') ,
				"param_name" => "bar_size",
				"value" => "8",
				"description" => __("Select the size of the bar", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Track size", 'cesis') ,
				"param_name" => "track_size",
				"value" => "10",
				"description" => __("Select the size of the track ( bar background )", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Bar stlye", 'cesis') ,
				"param_name" => "linecap",
				"value" => array(
					__("Squared", 'cesis') => "butt",
					__("Rounded", 'cesis') => "round",
				) ,
				"description" => __("Select the bar edge style", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation speed", 'cesis') ,
				"param_name" => "speed",
				"value" => "10",
				"description" => __("Select the animation speed ( 1 = really slow, 30 = really fast )", 'cesis')
			) ,
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Content settings', 'cesis') ,
				'param_name' => 'g_content',
				'tag' => 'title'
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Content", 'cesis') ,
				"param_name" => "content_type",
				"value" => array(
					__("Show percentage", 'cesis') => "percentage",
					__("Show custom text", 'cesis') => "text",
					__("Show Icon", 'cesis') => "icon",
				) ,
				"description" => __("Select what to show in the center of the progress bar", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Content text", 'cesis') ,
				"param_name" => "custom_text",
				"value" => "Heading",
				'dependency' => array(
					'element' => 'content_type',
					'value' => array(
						'text'
					)
				) ,
				"description" => __("Select the text to use", 'cesis')
			) ,
			array(
				'type' => 'cesis_icon',
				'heading' => __('Icon', 'cesis') ,
				'param_name' => 'icon',
				'dependency' => array(
					'element' => 'content_type',
					'value' => array(
						'icon'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Icon size', 'cesis') ,
				'param_name' => 'i_size',
				'description' => __('Set the icon size', 'cesis') ,
				'value' => "40",
				'dependency' => array(
					'element' => 'content_type',
					'value' => array(
						'icon'
					)
				) ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Use Gradient?", 'cesis') ,
				'param_name' => 'use_gradient',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'dependency' => array(
					'element' => 'content_type',
					'value' => array(
						'icon'
					)
				) ,
				'description' => __("Select if you want to use gradient", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Add Background for the icon?", 'cesis') ,
				'param_name' => 'use_shape',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'dependency' => array(
					'element' => 'content_type',
					'value' => array(
						'icon'
					)
				) ,
				'description' => __("Select if you want to use background and border for the icon", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Background shape", 'cesis') ,
				"param_name" => "shape",
				"value" => array(
					__("Rounded", 'cesis') => "rounded",
					__("Squared", 'cesis') => "squared",
					__("Diamond", 'cesis') => "diamond",
					__("Hexagon", 'cesis') => "hexagon",
				) ,
				"description" => __("Select icon background shape", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Background border radius', 'cesis') ,
				'param_name' => 'i_radius',
				'description' => __('Set the border radius 0~100 ( 100 for perfect circle, 0 for squared )', 'cesis') ,
				'value' => "100",
				'dependency' => array(
					'element' => 'shape',
					'value' => array(
						'rounded'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Background size', 'cesis') ,
				'param_name' => 'i_bg_size',
				'description' => __('Set the icon background size', 'cesis') ,
				'value' => "110",
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Background border size', 'cesis') ,
				'param_name' => 'i_b_size',
				'description' => __('Set the icon border size ( set to 0 if border not needed)', 'cesis') ,
				'value' => "0",
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Hover effect", 'cesis') ,
				"param_name" => "hover",
				"value" => array(
					__("None", 'cesis') => "none",
					__("Shine", 'cesis') => "shine",
					__("Grow", 'cesis') => "grow",
					__("Shrink", 'cesis') => "shrink",
					__("Outline outward", 'cesis') => "outline_o",
					__("Outline inline", 'cesis') => "outline_i",
					__("Trim", 'cesis') => "trim",
				) ,
				"description" => __("Select hover effect", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Shadow type", 'cesis') ,
				"param_name" => "shadow_type",
				"value" => array(
					__("None", 'cesis') => "none",
					__("Dropdown", 'cesis') => "dropdown",
					__("Blur", 'cesis') => "blur",
					__("Solid", 'cesis') => "solid",
				) ,
				"description" => __("Select shadow type", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Shadow hover effect", 'cesis') ,
				"param_name" => "shadow_hover",
				"value" => array(
					__("Always on", 'cesis') => "always",
					__("Show on hover", 'cesis') => "hover",
					__("Hide on hover", 'cesis') => "off_hover",
				) ,
				"description" => __("Select hover effect", 'cesis') ,
				'dependency' => array(
					'element' => 'shadow_type',
					'value' => array(
						'blur',
						'solid',
						'dropdown',
					)
				) ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Bar color settings', 'cesis') ,
				'param_name' => 'c_content',
				'tag' => 'title'
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Bar color", 'cesis') ,
				"param_name" => "bar_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '',
				"description" => __("Set the bar color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Bar alternative color ( for gradient / optional )", 'cesis') ,
				"param_name" => "bar_alt_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '',
				"description" => __("Set the bar alternative color if you want to create a gradient effect (optional)", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Track color", 'cesis') ,
				"param_name" => "track_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '',
				"description" => __("Set the track color ( path color )", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Content color settings', 'cesis') ,
				'param_name' => 'c_icon',
				'tag' => 'title'
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Content text color", 'cesis') ,
				"param_name" => "content_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '',
				'dependency' => array(
					'element' => 'content_type',
					'value' => array(
						'percentage',
						'text',
					)
				) ,
				"description" => __("Set the percentage / text color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Color", 'cesis') ,
				"param_name" => "icon_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				'dependency' => array(
					'element' => 'content_type',
					'value' => array(
						'icon'
					)
				) ,
				"description" => __("Choose the icon color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon background Color", 'cesis') ,
				"param_name" => "icon_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon background color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon second Color ( used for gradient )", 'cesis') ,
				"param_name" => "icon_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon gradient color  ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon border Color", 'cesis') ,
				"param_name" => "icon_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon border color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover Icon Color", 'cesis') ,
				"param_name" => "h_icon_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				'dependency' => array(
					'element' => 'content_type',
					'value' => array(
						'icon'
					)
				) ,
				"description" => __("Choose the icon hover color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Hover background Color", 'cesis') ,
				"param_name" => "h_icon_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon hover gradient Color", 'cesis') ,
				"param_name" => "h_icon_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Icon hover gradient Color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon hover border Color", 'cesis') ,
				"param_name" => "h_icon_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Icon hover border Color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Shadow Color", 'cesis') ,
				"param_name" => "shadow_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the shadow color", 'cesis') ,
				'dependency' => array(
					'element' => 'shadow_type',
					'value' => array(
						'dropdown',
						'blur',
						'solid',
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Text font family', 'cesis') ,
				'param_name' => 'text_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'dependency' => array(
					'element' => 'content_type',
					'value' => array(
						'percentage',
						'text',
					)
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'text_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "text_f_size",
				"value" => __("18px", 'cesis') ,
				'dependency' => array(
					'element' => 'content_type',
					'value' => array(
						'percentage',
						'text',
					)
				) ,
				"description" => __("Select the text font size, for example 30px / 2em", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Text font weight", 'cesis') ,
				"param_name" => "text_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				"description" => __("Select the text font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "text_l_height",
				"value" => __("24px", 'cesis') ,
				'dependency' => array(
					'element' => 'content_type',
					'value' => array(
						'percentage',
						'text',
					)
				) ,
				"description" => __("Select the text line height", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text capitalization", 'cesis') ,
				"param_name" => "text_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				'dependency' => array(
					'element' => 'content_type',
					'value' => array(
						'percentage',
						'text',
					)
				) ,
				"description" => __("Select text capitalization.", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "text_l_spacing",
				"value" => __("0", 'cesis') ,
				'dependency' => array(
					'element' => 'content_type',
					'value' => array(
						'percentage',
						'text',
					)
				) ,
				"description" => __("Select the text font letter spacing ( 0 is the default space )", 'cesis')
			) ,
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('General settings', 'cesis') ,
				'param_name' => 'g_general',
				'tag' => 'title'
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Extra class name", 'cesis') ,
				"param_name" => "el_class",
				"value" => "",
				"description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	));
	}



// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                            ADD GOOGLE MAP                                 /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

add_action('vc_before_init', 'cesis_gmaps_sc');

function cesis_gmaps_sc()
	{
	vc_map(array(
		'name' => __('Google Map', 'cesis') ,
		'base' => 'cesis_gmaps',
		"icon"		=> get_template_directory_uri() . "/includes/images/google_map.svg",
		'weight' => '73',
		'category' => __('Map', 'cesis') ,
		'description' => __('Custom Google map', 'cesis') ,
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __('Google Map Key', 'cesis') ,
				'param_name' => 'key',
				'value' => '',
				"description" => 'All JavaScript API applications require authentication using an API key.<br />For more info please go to  <a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank" >Google Maps JavaScript API developers website.</a>',
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Center Latitude', 'cesis') ,
				'param_name' => 'latitude',
				'value' => '34.053246',
				"edit_field_class" => 'vc_col-sm-4 vc_column',
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Center Longitude', 'cesis') ,
				'param_name' => 'longitude',
				'value' => '-118.242404',
				"edit_field_class" => 'vc_col-sm-4 vc_column',
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Zoom", 'cesis') ,
				"param_name" => "zoom",
				"edit_field_class" => 'vc_col-sm-3 vc_column',
				"value" => array(
					'0' => '0',
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
					'7' => '7',
					'8' => '8',
					'9' => '9',
					'10' => '10',
					'11' => '11',
					'12' => '12',
					'13' => '13',
					'14' => '14',
					'15' => '15',
					'16' => '16',
					'17' => '17',
					'18' => '18',
					'19' => '19',
					'20' => '20',
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Map height', 'cesis') ,
				'param_name' => 'height',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '400',
			) ,
			array(
				"type" => "dropdown",
				'heading' => __('Map height unit', 'cesis') ,
				'param_name' => 'height_unit',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => array(
					'px' => 'px',
					'vh' => 'vh',
				) ,
			) ,
			array(
				'type' => 'param_group',
				"group" => __("Markers", 'cesis') ,
				'heading' => __('Markers', 'cesis') ,
				'param_name' => 'markers',
				'description' => __('Create markers for the map', 'cesis') ,
				'value' => urlencode(json_encode(array(
					array(
						'label' => __('Development', 'cesis') ,
						'value' => '90',
					) ,
				))) ,
				'params' => array(
					array(
						'type' => 'attach_image',
						'heading' => __('Image', 'cesis') ,
						'param_name' => 'image',
						'description' => __('To replace the default pin icon ( optional ).', 'cesis') ,
					) ,
					array(
						'type' => 'textfield',
						'heading' => __('Latitude', 'cesis') ,
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'param_name' => 'marker_latitude',
					) ,
					array(
						'type' => 'textfield',
						'heading' => __('Longitude', 'cesis') ,
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'param_name' => 'marker_longitude',
					) ,
					array(
						'type' => 'textfield',
						'heading' => __('Title', 'cesis') ,
						'param_name' => 'marker_title',
						'description' => __('optional.', 'cesis') ,
					) ,
					array(
						'type' => 'textarea',
						'heading' => __('Description', 'cesis') ,
						'param_name' => 'marker_description',
						'description' => __('optional.', 'cesis') ,
					) ,
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Controls", 'cesis') ,
				'heading' => __('Zoom control', 'cesis') ,
				'param_name' => 'control_zoom',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no",
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Controls", 'cesis') ,
				'heading' => __('Scale', 'cesis') ,
				'param_name' => 'control_scale',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no",
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Controls", 'cesis') ,
				'heading' => __('Map type', 'cesis') ,
				'param_name' => 'control_maptype',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no",
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Controls", 'cesis') ,
				'heading' => __('Street view', 'cesis') ,
				'param_name' => 'control_streetview',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no",
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Controls", 'cesis') ,
				'heading' => __('Rotate', 'cesis') ,
				'param_name' => 'control_rotate',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no",
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Controls", 'cesis') ,
				'heading' => __('Fullscreen', 'cesis') ,
				'param_name' => 'control_fullscreen',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no",
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Controls", 'cesis') ,
				'heading' => __('Scroll Wheel', 'cesis') ,
				'param_name' => 'control_scrollwheel',
				'edit_field_class' => 'vc_col-sm-4 vc_column',
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no",
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Appearance", 'cesis') ,
				'heading' => __('Map Style', 'cesis') ,
				'param_name' => 'style',
				'value' => array(
					__("Default", 'cesis') => "",
					__("Custom", 'cesis') => "custom",
				) ,
			) ,
			array(
				'type' => 'textarea_raw_html',
				"group" => __("Appearance", 'cesis') ,
				'heading' => __('Javascript style array', 'cesis') ,
				'param_name' => 'appearance',
				'edit_field_class' => 'vc_col-sm-12 -height-150px vc_column',
				'description' => '<a href="http://snazzymaps.com/?TB_iframe=true&width=1200&height=950" class="thickbox">' . __('Pick a style from Snazzy Maps repository</a> and paste the <b>Javascript style array</b> here or just make your own.', 'cesis') ,
				'dependency' => array(
					'element' => 'style',
					'value' => 'custom',
				) ,
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay ( optional )", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "delay",
				"value" => "0",
				"description" => __("Set the animation delay ( e.g 200 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'cesis') ,
				'param_name' => 'el_class',
				'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	));
	}

// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                               ADD BUTTON                                  /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

if (get_option( 'enable_full_version' )) {
add_action('vc_before_init', 'cesis_button_sc');

function cesis_button_sc()
	{
	vc_map(array(
		'name' => __('Button', 'cesis') ,
		'base' => 'cesis_button',
		"icon"		=> get_template_directory_uri() . "/includes/images/button.svg",
		'weight' => '76',
		'category' => __('Content', 'cesis') ,
		'description' => __('Awesome button', 'cesis') ,
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __('Button text', 'cesis') ,
				'param_name' => 'button_text',
				'description' => __('Set the button text', 'cesis') ,
				'value' => "Button",
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Link', 'cesis') ,
				'param_name' => 'link',
				'description' => __('Fill this field if you want to add a link ( use http:// )', 'cesis') ,
				'value' => "",
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Open link in a new page?", 'cesis') ,
				"param_name" => "target",
				"value" => array(
					__("No", 'cesis') => "_self",
					__("Yes", 'cesis') => "_blank",
					__("Open in lightbox", 'cesis') => "cesis_lightbox",
				) ,
				'dependency' => array(
					'element' => 'link',
					'not_empty' => true
				) ,
				"description" => __("Select if you want the link to open in a new page.", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __('Add rel="nofollow" to the link ?', 'cesis') ,
				"param_name" => "no_follow",
				"value" => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				'dependency' => array(
					'element' => 'link',
					'not_empty' => true
				) ,
				"description" => __('Select if you want to add rel="nofollow" to the link ?.', 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button position", 'cesis') ,
				"param_name" => "button_pos",
				"value" => array(
					__("Left", 'cesis') => "cesis_button_left",
					__("Right", 'cesis') => "cesis_button_right",
					__("Center", 'cesis') => "center",
				) ,
				"description" => __("Select the button position", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button size", 'cesis') ,
				"param_name" => "button_size",
				"value" => array(
					__("Small", 'cesis') => "cesis_button_small",
					__("Medium", 'cesis') => "cesis_button_medium",
					__("Large", 'cesis') => "cesis_button_large",
					__("Custom size", 'cesis') => "cesis_button_custom",
				) ,
				"description" => __("Select the button size", 'cesis') ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Button width', 'cesis') ,
				'param_name' => 'button_width',
				'description' => __('Set the button width (px or %)', 'cesis') ,
				'value' => "180px",
				'dependency' => array(
					'element' => 'button_size',
					'value' => array(
						'cesis_button_custom'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Button height', 'cesis') ,
				'param_name' => 'button_height',
				'description' => __('Set the button height (px)', 'cesis') ,
				'value' => "45px",
				'dependency' => array(
					'element' => 'button_size',
					'value' => array(
						'cesis_button_custom'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Border size', 'cesis') ,
				'param_name' => 'button_border',
				'description' => __('Set the button border size ( set to 0 if border not needed)', 'cesis') ,
				'value' => "0",
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Border radius', 'cesis') ,
				'param_name' => 'button_radius',
				'description' => __('Set the border radius 0~100', 'cesis') ,
				'value' => "0",
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Use Gradient?", 'cesis') ,
				'param_name' => 'use_gradient',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to use gradient", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Use Icon?", 'cesis') ,
				'param_name' => 'use_icon',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to use an icon", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_icon',
				'heading' => __('Icon', 'cesis') ,
				'param_name' => 'icon',
				'dependency' => array(
					'element' => 'use_icon',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Icon position", 'cesis') ,
				"param_name" => "icon_pos",
				"value" => array(
					__("Left", 'cesis') => "cesis_button_icon_left",
					__("Right", 'cesis') => "cesis_button_icon_right",
				) ,
				"description" => __("Select the icon position", 'cesis') ,
				'dependency' => array(
					'element' => 'use_icon',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Icon style", 'cesis') ,
				"param_name" => "icon_style",
				"value" => array(
					__("Icon only", 'cesis') => "normal",
					__("In a Box", 'cesis') => "boxed",
				) ,
				"description" => __("Select the icon style", 'cesis') ,
				'dependency' => array(
					'element' => 'use_icon',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Icon animation", 'cesis') ,
				"param_name" => "icon_animation",
				"value" => array(
					__("None", 'cesis') => "none",
					__("Show on hover", 'cesis') => "hover",
				) ,
				"description" => __("Select the icon animation", 'cesis') ,
				'dependency' => array(
					'element' => 'use_icon',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Hover effect", 'cesis') ,
				"param_name" => "hover",
				"value" => array(
					__("None", 'cesis') => "none",
					__("3D", 'cesis') => "3d",
					__("Shine", 'cesis') => "shine",
					__("Grow", 'cesis') => "grow",
					__("Shrink", 'cesis') => "shrink",
					__("Outline outward", 'cesis') => "outline_o",
					__("Outline inline", 'cesis') => "outline_i",
					__("Trim", 'cesis') => "trim",
				) ,
				"description" => __("Select hover effect", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Shadow type", 'cesis') ,
				"param_name" => "shadow_type",
				"value" => array(
					__("None", 'cesis') => "none",
					__("Dropdown", 'cesis') => "dropdown",
					__("Blur", 'cesis') => "blur",
					__("Solid", 'cesis') => "solid",
				) ,
				"description" => __("Select shadow type", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Shadow hover type", 'cesis') ,
				"param_name" => "shadow_hover",
				"value" => array(
					__("Always on", 'cesis') => "always",
					__("Show on hover", 'cesis') => "hover",
					__("Hide on hover", 'cesis') => "off_hover",
				) ,
				"description" => __("Select shadow hover effect", 'cesis') ,
				'dependency' => array(
					'element' => 'shadow_type',
					'value' => array(
						'blur',
						'solid',
						'dropdown',
					)
				) ,
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay ( optional )", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "delay",
				"value" => "0",
				"description" => __("Set the animation delay ( e.g 200 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Module Left Space', 'cesis') ,
				'param_name' => 'margin_left',
				'description' => __('Left margin for the module container (e.g 20 )', 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => "0",
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Module Right Space', 'cesis') ,
				'param_name' => 'margin_right',
				'description' => __('Right margin for the module container (e.g 20 )', 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => "0",
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'cesis') ,
				'param_name' => 'el_class',
				'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Text Color", 'cesis') ,
				"param_name" => "button_text_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the text color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Background Color", 'cesis') ,
				"param_name" => "button_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the background color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon second Color ( used for gradient )", 'cesis') ,
				"param_name" => "button_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the second background color ( for gradient )", 'cesis') ,
				'dependency' => array(
					'element' => 'use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Border Color", 'cesis') ,
				"param_name" => "button_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the border color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover text Color", 'cesis') ,
				"param_name" => "h_button_text_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover text color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover background Color", 'cesis') ,
				"param_name" => "h_button_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover background color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover background gradient Color", 'cesis') ,
				"param_name" => "h_button_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover gradient color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover border Color", 'cesis') ,
				"param_name" => "h_button_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover border color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Shadow Color", 'cesis') ,
				"param_name" => "shadow_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the shadow color", 'cesis') ,
				'dependency' => array(
					'element' => 'shadow_type',
					'value' => array(
						'dropdown',
						'blur',
						'solid',
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Button font family', 'cesis') ,
				'param_name' => 'button_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'button_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'button_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Button font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "button_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the font size, for example 30px / 2em", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Button font weight", 'cesis') ,
				"param_name" => "button_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				"description" => __("Select the button font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'button_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Button capitalization", 'cesis') ,
				"param_name" => "button_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				"description" => __("Select the button capitalization.", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Button Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "button_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the button letter spacing ( 0 is the default space )", 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	));
	}
}


// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                               ADD BREADCRUMBS                             /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

add_action('vc_before_init', 'cesis_breadcrumb_sc');

function cesis_breadcrumb_sc()
	{
	vc_map(array(
		'name' => __('Breadcrumb', 'cesis') ,
		'base' => 'cesis_breadcrumb',
		"icon"		=> get_template_directory_uri() . "/includes/images/breadcrumb.svg",
		'weight' => '95',
		'category' => __('Content', 'cesis') ,
		'description' => __('Breadcrumb', 'cesis') ,
		'params' => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Breadcrumb Position", 'cesis') ,
				"param_name" => "pos",
				"value" => array(
					__("Left", 'cesis') => "cesis_breadcrumb_left",
					__("Center", 'cesis') => "cesis_breadcrumb_center",
					__("Right", 'cesis') => "cesis_breadcrumb_right",
				) ,
				"std" => 'cesis_breadcrumb_left',
				"description" => __("Select the breadcrumb position.", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Font style", 'cesis') ,
				"param_name" => "force_font",
				'value' => array(
					__("Theme Default", 'cesis') => "",
					__("Custom", 'cesis') => "custom"
				) ,
				"description" => __("Select the breadcrumb font style to use.", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Breadcrumb text Color", 'cesis') ,
				"param_name" => "bread_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the breadcrumb color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Breadcrumb hover Color", 'cesis') ,
				"param_name" => "bread_hover_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the breadcrumb hover color", 'cesis') ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Breadcrumb font family', 'cesis') ,
				'param_name' => 'font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array( 'element' => 'font',	'value' => array('custom')) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Breadcrumb font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "f_size",
				"value" => __("14px", 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the font size, for example 30px / 2em", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Breadcrumb font weight", 'cesis') ,
				"param_name" => "f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				"description" => __("Select the breadcrumb font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Breadcrumb capitalization", 'cesis') ,
				"param_name" => "t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
				"std" => "none",
				"description" => __("Select the breadcrumb capitalization.", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Breadcrumb Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "l_spacing",
				"value" => __("0", 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the breadcrumb letter spacing ( 0 is the default space )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'cesis') ,
				'param_name' => 'el_class',
				'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	));
	}




// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                               ADD POST INFOS                              /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

add_action('vc_before_init', 'cesis_postinfo_sc');

function cesis_postinfo_sc()
	{
	vc_map(array(
		'name' => __('Post information', 'cesis') ,
		'base' => 'cesis_post_info',
		"icon"		=> get_template_directory_uri() . "/includes/images/pi.svg",
		'weight' => '95',
		'category' => __('Content', 'cesis') ,
		'description' => __('Show post information', 'cesis') ,
		'params' => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Post information Position", 'cesis') ,
				"param_name" => "pos",
				"value" => array(
					__("Left", 'cesis') => "cesis_pi_left",
					__("Center", 'cesis') => "cesis_pi_center",
					__("Right", 'cesis') => "cesis_pi_right",
				) ,
				"std" => 'cesis_pi_left',
				"description" => __("Select the Post information position.", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Font style", 'cesis') ,
				"param_name" => "force_font",
				'value' => array(
					__("Theme Default", 'cesis') => "",
					__("Custom", 'cesis') => "custom"
				) ,
				"description" => __("Select the Post information font style to use.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show author name?", 'cesis') ,
				"param_name" => "i_author",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the author name.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show date?", 'cesis') ,
				"param_name" => "i_date",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the date.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show categories?", 'cesis') ,
				"param_name" => "i_category",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the categories.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show tags?", 'cesis') ,
				"param_name" => "i_tag",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the tags.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show comment number?", 'cesis') ,
				"param_name" => "i_comment",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the comment number.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show like icon?", 'cesis') ,
				"param_name" => "i_like",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the like icon.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Add seperator between information?", 'cesis') ,
				"param_name" => "i_sep",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to add a seperator between each information.", 'cesis')
			) ,
			/*
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Use custom space between the information?", 'cesis') ,
				"param_name" => "i_space",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to choose the space between each information.", 'cesis')
			) ,
 		  array(
 		 				"type" => "textfield",
 		 				"class" => "",
 		 				"heading" => __("Set the space to use between each information", 'cesis'),
 		 				"param_name" => "i_space_val",
 		 				"value" => "30",
						'dependency' => array(
							'element' => 'i_space',
							'value' => array(
								'yes'
							)
						) ,
 		 				"description" => __("Set the space to use between each information ( e.g. 30 (optional) )", 'cesis'),
 		  ),
			*/
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Post information text Color", 'cesis') ,
				"param_name" => "pi_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Post information color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Post information hover Color", 'cesis') ,
				"param_name" => "pi_hover_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Post information hover color", 'cesis') ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Post information font family', 'cesis') ,
				'param_name' => 'font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array( 'element' => 'font',	'value' => array('custom')) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Post information font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "f_size",
				"value" => __("14px", 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the font size, for example 30px / 2em", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Post information font weight", 'cesis') ,
				"param_name" => "f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				"description" => __("Select the Post information font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Post information capitalization", 'cesis') ,
				"param_name" => "t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
				"std" => "none",
				"description" => __("Select the Post information capitalization.", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Post information Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "l_spacing",
				"value" => __("0", 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the Post information letter spacing ( 0 is the default space )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'cesis') ,
				'param_name' => 'el_class',
				'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	));
	}


// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                               ADD LINE DIVIDER                            /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

add_action('vc_before_init', 'cesis_line_divider_sc');

function cesis_line_divider_sc()
	{
	vc_map(array(
		'name' => __('Line divider', 'cesis') ,
		'base' => 'cesis_line_divider',
		"icon"		=> get_template_directory_uri() . "/includes/images/divider.svg",
		'weight' => '95',
		'category' => __('Content', 'cesis') ,
		'description' => __('Simple Line divider', 'cesis') ,
		'params' => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Line Position", 'cesis') ,
				"param_name" => "pos",
				"value" => array(
					__("Left", 'cesis') => "cesis_line_d_left",
					__("Center", 'cesis') => "cesis_line_d_center",
					__("Right", 'cesis') => "cesis_line_d_right",
				) ,
				"std" => 'cesis_line_d_center',
				"description" => __("Select the line divider position.", 'cesis') ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Line height', 'cesis') ,
				'param_name' => 'height',
				'description' => __('Set the line height', 'cesis') ,
				'value' => "2",
			) ,
			array(
					'type' => 'textfield',
					'heading' => __('Line width', 'cesis') ,
					'param_name' => 'width',
					'description' => __('Set the line width ( leave blank for full width )', 'cesis') ,
					'value' => "150",
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Line divider Color", 'cesis') ,
				"param_name" => "color",
				"value" => '', //Default Red color
				"description" => __("Choose the line divider color", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Use Icon?", 'cesis') ,
				'param_name' => 'use_icon',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to use an icon", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_icon',
				'heading' => __('Icon', 'cesis') ,
				'param_name' => 'icon',
				'value' => "",
				'dependency' => array(
					'element' => 'use_icon',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Icon size', 'cesis') ,
				'param_name' => 'i_size',
				'description' => __('Set the icon size', 'cesis') ,
				'value' => "40",
				'dependency' => array(
					'element' => 'use_icon',
					'value' => array(
						'yes'
					)
				) ,
			) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __("Icon Color", 'cesis') ,
					"param_name" => "i_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the icon color", 'cesis') ,
					'dependency' => array(
						'element' => 'use_icon',
						'value' => array(
							'yes'
						)
					) ,
				) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay ( optional )", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "delay",
				"value" => "0",
				"description" => __("Set the animation delay ( e.g 200 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'cesis') ,
				'param_name' => 'el_class',
				'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	));
	}


// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                               ADD ICON                                    /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

if (get_option( 'enable_full_version' )) {
add_action('vc_before_init', 'cesis_icon_sc');

function cesis_icon_sc()
	{
	vc_map(array(
		'name' => __('Icon', 'cesis') ,
		'base' => 'cesis_icon',
		"icon"		=> get_template_directory_uri() . "/includes/images/icon.svg",
		'weight' => '86',
		'category' => __('Content', 'cesis') ,
		'description' => __('Simple stylable icon', 'cesis') ,
		'params' => array(
			array(
				'type' => 'cesis_icon',
				'heading' => __('Icon', 'cesis') ,
				'param_name' => 'icon',
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Icon size', 'cesis') ,
				'param_name' => 'i_size',
				'description' => __('Set the icon size', 'cesis') ,
				'value' => "40",
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Use Gradient?", 'cesis') ,
				'param_name' => 'use_gradient',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to use gradient", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Add Background for the icon?", 'cesis') ,
				'param_name' => 'use_shape',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to use background and border for the icon", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Background shape", 'cesis') ,
				"param_name" => "shape",
				"value" => array(
					__("Rounded", 'cesis') => "rounded",
					__("Squared", 'cesis') => "squared",
					__("Diamond", 'cesis') => "diamond",
					__("Hexagon", 'cesis') => "hexagon",
				) ,
				"description" => __("Select icon background shape", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Background border radius', 'cesis') ,
				'param_name' => 'i_radius',
				'description' => __('Set the border radius 0~100 ( 100 for perfect circle, 0 for squared )', 'cesis') ,
				'value' => "100",
				'dependency' => array(
					'element' => 'shape',
					'value' => array(
						'rounded'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Background size', 'cesis') ,
				'param_name' => 'i_bg_size',
				'description' => __('Set the icon background size', 'cesis') ,
				'value' => "110",
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Background border size', 'cesis') ,
				'param_name' => 'i_b_size',
				'description' => __('Set the icon border size ( set to 0 if border not needed)', 'cesis') ,
				'value' => "0",
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Hover effect", 'cesis') ,
				"param_name" => "hover",
				"value" => array(
					__("None", 'cesis') => "none",
					__("Shine", 'cesis') => "shine",
					__("Grow", 'cesis') => "grow",
					__("Shrink", 'cesis') => "shrink",
					__("Outline outward", 'cesis') => "outline_o",
					__("Outline inline", 'cesis') => "outline_i",
					__("Trim", 'cesis') => "trim",
				) ,
				"description" => __("Select hover effect", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Shadow type", 'cesis') ,
				"param_name" => "shadow_type",
				"value" => array(
					__("None", 'cesis') => "none",
					__("Dropdown", 'cesis') => "dropdown",
					__("Blur", 'cesis') => "blur",
					__("Solid", 'cesis') => "solid",
				) ,
				"description" => __("Select shadow type", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Shadow hover effect", 'cesis') ,
				"param_name" => "shadow_hover",
				"value" => array(
					__("Always on", 'cesis') => "always",
					__("Show on hover", 'cesis') => "hover",
					__("Hide on hover", 'cesis') => "off_hover",
				) ,
				"description" => __("Select hover effect", 'cesis') ,
				'dependency' => array(
					'element' => 'shadow_type',
					'value' => array(
						'blur',
						'solid',
						'dropdown',
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Icon position", 'cesis') ,
				"param_name" => "position",
				"value" => array(
					__("Center", 'cesis') => "i_float_none",
					__("Left", 'cesis') => "i_float_left",
					__("Right", 'cesis') => "i_float_right",
				) ,
				"description" => __("Select the icon position", 'cesis') ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Module Left Space', 'cesis') ,
				'param_name' => 'margin_left',
				'description' => __('Left margin for the module container (e.g 20 )', 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => "0",
				'dependency' => array(
					'element' => 'position',
					'value' => array(
						'i_float_left',
						'i_float_right'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Module Right Space', 'cesis') ,
				'param_name' => 'margin_right',
				'description' => __('Right margin for the module container (e.g 20 )', 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => "0",
				'dependency' => array(
					'element' => 'position',
					'value' => array(
						'i_float_left',
						'i_float_right'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Link', 'cesis') ,
				'param_name' => 'link',
				'description' => __('Fill this field if you want to add a link ( use http:// )', 'cesis') ,
				'value' => "",
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Open link in a new page?", 'cesis') ,
				"param_name" => "target",
				"value" => array(
					__("No", 'cesis') => "_self",
					__("Yes", 'cesis') => "_blank",
					__("Open in lightbox", 'cesis') => "cesis_lightbox",
				) ,
				'dependency' => array(
					'element' => 'link',
					'not_empty' => true
				) ,
				"description" => __("Select if you want the link to open in a new page.", 'cesis') ,
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay ( optional )", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "delay",
				"value" => "0",
				"description" => __("Set the animation delay ( e.g 200 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'cesis') ,
				'param_name' => 'el_class',
				'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Color", 'cesis') ,
				"param_name" => "icon_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon background Color", 'cesis') ,
				"param_name" => "icon_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon background color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon second Color ( used for gradient )", 'cesis') ,
				"param_name" => "icon_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon gradient color  ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon border Color", 'cesis') ,
				"param_name" => "icon_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon border color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover Icon Color", 'cesis') ,
				"param_name" => "h_icon_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon hover color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Hover background Color", 'cesis') ,
				"param_name" => "h_icon_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon hover gradient Color", 'cesis') ,
				"param_name" => "h_icon_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Icon hover gradient Color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon hover border Color", 'cesis') ,
				"param_name" => "h_icon_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Icon hover border Color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Shadow Color", 'cesis') ,
				"param_name" => "shadow_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the shadow color", 'cesis') ,
				'dependency' => array(
					'element' => 'shadow_type',
					'value' => array(
						'dropdown',
						'blur',
						'solid',
					)
				) ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	));
	}
}


// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                              ADD ICON LIST 		                           /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

add_action('vc_before_init', 'cesis_icon_list_sc');

function cesis_icon_list_sc()
	{
	vc_map(array(
		'name' => __('List', 'cesis') ,
		'base' => 'cesis_icon_list',
		"icon"		=> get_template_directory_uri() . "/includes/images/list.svg",
		'weight' => '75',
		'category' => __('Content', 'cesis') ,
		'description' => __('List with icon', 'cesis') ,
		'params' => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("List Style", 'cesis') ,
				"param_name" => "style",
				"value" => array(
					__("Small icon", 'cesis') => "cesis_il_1",
					__("Small rounded icon", 'cesis') => "cesis_il_2",
					__("Medium icon", 'cesis') => "cesis_il_3",
					__("Medium rounded icon", 'cesis') => "cesis_il_4",
					__("Big icon", 'cesis') => "cesis_il_5",
					__("Big rounded icon", 'cesis') => "cesis_il_6",
				) ,
				"description" => __("Select the List Style ( design )", 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Use shadow?", 'cesis') ,
				'param_name' => 'shadow',
				'value' => array(
					'Yes' => 'cesis_list_shadow'
				) ,
				'description' => __("Select if you want to use shadow for the rounded icon", 'cesis') ,
				'dependency' => array(
					'element' => 'style',
					'value' => array(
						'cesis_il_2',
						'cesis_il_4',
						'cesis_il_6'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Space ', 'cesis') ,
				'param_name' => 'space',
				'description' => __('Set the space you want to have between each list items, default 20', 'cesis') ,
				'value' => "20",
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Open link in a new page?", 'cesis') ,
				"param_name" => "target",
				"value" => array(
					__("No", 'cesis') => "_self",
					__("Yes", 'cesis') => "_blank",
					__("Open in lightbox", 'cesis') => "cesis_lightbox",
				) ,
				"description" => __("Select if you want the link to open in a new page.", 'cesis') ,
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay ( optional )", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "delay",
				"value" => "0",
				"description" => __("Set the animation delay ( e.g 200 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'cesis') ,
				'param_name' => 'el_class',
				'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Heading Color", 'cesis') ,
				"param_name" => "heading_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the list heading color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Heading hover Color", 'cesis') ,
				"param_name" => "h_heading_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the list heading hover color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Text Color", 'cesis') ,
				"param_name" => "text_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the list text color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Border Color", 'cesis') ,
				"param_name" => "border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the list border color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Color", 'cesis') ,
				"param_name" => "icon_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the list icon color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon background Color", 'cesis') ,
				"param_name" => "icon_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the list icon background color", 'cesis') ,
				'dependency' => array(
					'element' => 'style',
					'value' => array(
						'cesis_il_2',
						'cesis_il_4',
						'cesis_il_6'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon border Color", 'cesis') ,
				"param_name" => "icon_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the list icon border color", 'cesis') ,
				'dependency' => array(
					'element' => 'style',
					'value' => array(
						'cesis_il_2',
						'cesis_il_4',
						'cesis_il_6'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Hover Color", 'cesis') ,
				"param_name" => "h_icon_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon hover color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Hover background Color", 'cesis') ,
				"param_name" => "h_icon_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'style',
					'value' => array(
						'cesis_il_2',
						'cesis_il_4',
						'cesis_il_6'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Hover border Color", 'cesis') ,
				"param_name" => "h_icon_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon hover border color", 'cesis') ,
				'dependency' => array(
					'element' => 'style',
					'value' => array(
						'cesis_il_2',
						'cesis_il_4',
						'cesis_il_6'
					)
				) ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Heading settings', 'cesis') ,
				'param_name' => 't_heading_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Heading font family', 'cesis') ,
				'param_name' => 'heading_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				"std" => "alt_font",
				'description' => __('Select the font to use.', 'cesis') ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'h_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "h_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the heading font size, for example 30", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Heading font weight", 'cesis') ,
				"param_name" => "h_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				"description" => __("Select the heading font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "h_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the heading line height", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading capitalization", 'cesis') ,
				"param_name" => "h_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				"description" => __("Select text capitalization.", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "h_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the heading font letter spacing ( 0 is the default space )", 'cesis')
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Text settings', 'cesis') ,
				'param_name' => 't_text_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Text font family', 'cesis') ,
				'param_name' => 'text_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'google_fonts',
				'value' => 'font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:300%20light%20regular%3A300%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "t_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the heading font size, for example 14", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Text font weight", 'cesis') ,
				"param_name" => "t_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				"description" => __("Select the text font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "t_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the text line height", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text capitalization", 'cesis') ,
				"param_name" => "t_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"description" => __("Select text capitalization.", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "t_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the text letter spacing ( 0 is the default space )", 'cesis')
			) ,
			array(
				'type' => 'param_group',
				"group" => __("List items", 'cesis') ,
				'heading' => __('Values', 'cesis') ,
				'param_name' => 'values',
				'description' => __('Enter values for graph - value, title and color.', 'cesis') ,
				'value' => urlencode(json_encode(array(
					array(
						'icon' => 'fa-check2',
						'heading' => 'List heading',
						'text' => 'List main text, you need to fill the heading or the text or both',
					) ,
				))) ,
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => __('Link ( optional )', 'cesis') ,
						'param_name' => 'link',
					) ,
					array(
						'type' => 'cesis_icon',
						'heading' => __('Icon ( optional )', 'cesis') ,
						'param_name' => 'icon',
					) ,
					array(
						'type' => 'textfield',
						'heading' => __('Heading ( optional )', 'cesis') ,
						'param_name' => 'heading',
						'admin_label' => true,
					) ,
					array(
						'type' => 'textfield',
						'heading' => __('Text ( optional )', 'cesis') ,
						'param_name' => 'text',
						'description' => __('Text.', 'cesis') ,
					) ,
				) ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	));
	}



// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                           ADD PARAGRAPH & ICON                            /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

if (get_option( 'enable_full_version' )) {
add_action('vc_before_init', 'cesis_icon_paragraph_sc');

function cesis_icon_paragraph_sc()
	{
	vc_map(array(
		'name' => __('Paragraph & Icon', 'cesis') ,
		'base' => 'cesis_icon_paragraph',
		"icon"		=> get_template_directory_uri() . "/includes/images/paragraph.svg",
		'weight' => '85',
		'category' => __('Content', 'cesis') ,
		'description' => __('Paragraph with Icon', 'cesis') ,
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __('Link', 'cesis') ,
				'param_name' => 'link',
				'description' => __('Fill this field if you want to add a link ( use http:// )', 'cesis') ,
				'value' => "",
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Open link in a new page?", 'cesis') ,
				"param_name" => "target",
				"value" => array(
					__("No", 'cesis') => "_self",
					__("Yes", 'cesis') => "_blank",
					__("Open in lightbox", 'cesis') => "cesis_lightbox",
				) ,
				'dependency' => array(
					'element' => 'link',
					'not_empty' => true
				) ,
				"description" => __("Select if you want the link to open in a new page.", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Icon settings', 'cesis') ,
				'param_name' => 'g_icon_separator',
				'tag' => 'title'
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Use Icon or Image?", 'cesis') ,
				"param_name" => "i_choice",
				"value" => array(
					__("Icon", 'cesis') => "icon",
					__("Image", 'cesis') => "image",
				) ,
				"description" => __("Select if you want to use an image instead of the icon", 'cesis') ,
			) ,
			array(
				'type' => 'attach_image',
				'heading' => __('Image', 'cesis') ,
				'param_name' => 'image',
				'value' => '',
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'image'
					)
				) ,
				'description' => __('Select the image.', 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Image width', 'cesis') ,
				'param_name' => 'image_size',
				'value' => '100',
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'image'
					)
				) ,
				'description' => __('Set the image width ( the height will be calculated automatically ).', 'cesis')
			) ,
			array(
				'type' => 'cesis_icon',
				'heading' => __('Icon', 'cesis') ,
				'param_name' => 'icon',
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Icon size', 'cesis') ,
				'param_name' => 'i_size',
				'description' => __('Set the icon size', 'cesis') ,
				'value' => "40",
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Use Gradient for the icon?", 'cesis') ,
				'param_name' => 'i_use_gradient',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
				'description' => __("Select if you want to use gradient for the icon", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Add Background for the icon?", 'cesis') ,
				'param_name' => 'use_shape',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
				'description' => __("Select if you want to use background and border for the icon", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Background shape", 'cesis') ,
				"param_name" => "shape",
				"value" => array(
					__("Rounded", 'cesis') => "rounded",
					__("Squared", 'cesis') => "squared",
					__("Diamond", 'cesis') => "diamond",
					__("Hexagon", 'cesis') => "hexagon",
				) ,
				"description" => __("Select icon background shape", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Background border radius', 'cesis') ,
				'param_name' => 'i_radius',
				'description' => __('Set the border radius 0~100 ( 100 for perfect circle, 0 for squared )', 'cesis') ,
				'value' => "100",
				'dependency' => array(
					'element' => 'shape',
					'value' => array(
						'rounded'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Background size', 'cesis') ,
				'param_name' => 'i_bg_size',
				'description' => __('Set the icon background size', 'cesis') ,
				'value' => "110",
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Background border size', 'cesis') ,
				'param_name' => 'i_b_size',
				'description' => __('Set the icon border size ( set to 0 if border not needed)', 'cesis') ,
				'value' => "0",
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Icon Hover effect", 'cesis') ,
				"param_name" => "i_hover",
				"value" => array(
					__("None", 'cesis') => "none",
					__("Shine", 'cesis') => "shine",
					__("Grow", 'cesis') => "grow",
					__("Shrink", 'cesis') => "shrink",
					__("Outline outward", 'cesis') => "outline_o",
					__("Outline inline", 'cesis') => "outline_i",
					__("Trim", 'cesis') => "trim",
				) ,
				"description" => __("Select hover effect", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Icon Shadow type", 'cesis') ,
				"param_name" => "i_shadow_type",
				"value" => array(
					__("None", 'cesis') => "none",
					__("Dropdown", 'cesis') => "dropdown",
					__("Blur", 'cesis') => "blur",
					__("Solid", 'cesis') => "solid",
				) ,
				"description" => __("Select shadow type", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Icon Shadow hover effect", 'cesis') ,
				"param_name" => "i_shadow_hover",
				"value" => array(
					__("Always on", 'cesis') => "always",
					__("Show on hover", 'cesis') => "hover",
					__("Hide on hover", 'cesis') => "off_hover",
				) ,
				"description" => __("Select hover effect", 'cesis') ,
				'dependency' => array(
					'element' => 'i_shadow_type',
					'value' => array(
						'blur',
						'solid',
						'dropdown',
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Icon position", 'cesis') ,
				"param_name" => "position",
				"value" => array(
					__("Left", 'cesis') => "i_left",
					__("Right", 'cesis') => "i_right",
          __("Top", 'cesis') => "i_top",
				) ,
				"description" => __("Select the icon position", 'cesis') ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Space between icon and text', 'cesis') ,
				'param_name' => 'i_space',
				'description' => __('Set the space between the icon and content ( eg 20 )', 'cesis') ,
				'value' => "20",
			) ,
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Heading settings', 'cesis') ,
				'param_name' => 'g_heading_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Heading', 'cesis') ,
				'param_name' => 'heading',
				'description' => __('Set the heading ( optional )', 'cesis') ,
				'value' => "Great title",
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Heading bottom space', 'cesis') ,
				'param_name' => 'heading_space',
				'description' => __('Set the heading bottom space ( eg 20 )', 'cesis') ,
				'value' => "20",
			) ,
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Text settings', 'cesis') ,
				'param_name' => 'g_text_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'dropdown',
				'heading' => __("Use WYSIWYG Editor for the text content?", 'cesis') ,
				'param_name' => 'use_editor',
				"value" => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				'description' => __("Select if you want to use the WYSIWYG editor instead of the simple textarea", 'cesis') ,
			) ,
			array(
				'type' => 'textarea',
				'heading' => __('Text', 'cesis') ,
				'param_name' => 'text',
				'description' => __('Set the text', 'cesis') ,
				'value' => "Cesis is a great theme and this is a great dummy text filler",
				'dependency' => array(
					'element' => 'use_editor',
					'value' => array(
						'no'
					)
				) ,
			) ,
			array(
				'type' => 'textarea_html',
				'heading' => __('Text', 'cesis') ,
				'param_name' => 'content',
				'description' => __('Set the text', 'cesis') ,
				'dependency' => array(
					'element' => 'use_editor',
					'value' => array(
						'yes'
					)
				) ,
				'value' => "",
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Text bottom space', 'cesis') ,
				'param_name' => 'text_space',
				'description' => __('Set the text bottom space ( eg 20 )', 'cesis') ,
				'value' => "20",
			) ,
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Button settings', 'cesis') ,
				'param_name' => 'g_button_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Use button?", 'cesis') ,
				'param_name' => 'use_button',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to add a button after the text", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button type", 'cesis') ,
				"param_name" => "button_type",
				"value" => array(
					__("Button", 'cesis') => "f_button",
					__("Text only", 'cesis') => "text",
				) ,
				"description" => __("Select the button type", 'cesis') ,
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Button text', 'cesis') ,
				'param_name' => 'button_text',
				'description' => __('Set the button text', 'cesis') ,
				'value' => "Button",
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button size", 'cesis') ,
				"param_name" => "button_size",
				"value" => array(
					__("Small", 'cesis') => "cesis_button_small",
					__("Medium", 'cesis') => "cesis_button_medium",
					__("Large", 'cesis') => "cesis_button_large",
					__("Custom size", 'cesis') => "cesis_button_custom",
				) ,
				"description" => __("Select the button size", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Button width', 'cesis') ,
				'param_name' => 'button_width',
				'description' => __('Set the button width (px or %)', 'cesis') ,
				'value' => "180px",
				'dependency' => array(
					'element' => 'button_size',
					'value' => array(
						'cesis_button_custom'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Button height', 'cesis') ,
				'param_name' => 'button_height',
				'description' => __('Set the button height (px)', 'cesis') ,
				'value' => "45px",
				'dependency' => array(
					'element' => 'button_size',
					'value' => array(
						'cesis_button_custom'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Border size', 'cesis') ,
				'param_name' => 'button_border',
				'description' => __('Set the button border size ( set to 0 if border not needed)', 'cesis') ,
				'value' => "0",
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Border radius', 'cesis') ,
				'param_name' => 'button_radius',
				'description' => __('Set the border radius 0~100', 'cesis') ,
				'value' => "0",
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Use Gradient for the button?", 'cesis') ,
				'param_name' => 'b_use_gradient',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to use gradient for the button", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button Hover effect", 'cesis') ,
				"param_name" => "b_hover",
				"value" => array(
					__("None", 'cesis') => "none",
					__("3D", 'cesis') => "3d",
					__("Shine", 'cesis') => "shine",
					__("Grow", 'cesis') => "grow",
					__("Shrink", 'cesis') => "shrink",
					__("Outline outward", 'cesis') => "outline_o",
					__("Outline inline", 'cesis') => "outline_i",
					__("Trim", 'cesis') => "trim",
				) ,
				"description" => __("Select button hover effect", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button Shadow type", 'cesis') ,
				"param_name" => "b_shadow_type",
				"value" => array(
					__("None", 'cesis') => "none",
					__("Dropdown", 'cesis') => "dropdown",
					__("Blur", 'cesis') => "blur",
					__("Solid", 'cesis') => "solid",
				) ,
				"description" => __("Select button shadow type", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button Shadow hover type", 'cesis') ,
				"param_name" => "b_shadow_hover",
				"value" => array(
					__("Always on", 'cesis') => "always",
					__("Show on hover", 'cesis') => "hover",
					__("Hide on hover", 'cesis') => "off_hover",
				) ,
				"description" => __("Select button shadow hover effect", 'cesis') ,
				'dependency' => array(
					'element' => 'b_shadow_type',
					'value' => array(
						'blur',
						'solid',
						'dropdown',
					)
				) ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Module general settings', 'cesis') ,
				'param_name' => 'g_module_separator',
				'tag' => 'title'
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay ( optional )", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "delay",
				"value" => "0",
				"description" => __("Set the animation delay ( e.g 200 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'cesis') ,
				'param_name' => 'el_class',
				'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Icon Colors settings', 'cesis') ,
				'param_name' => 'c_icon_separator',
				'tag' => 'title'
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Color", 'cesis') ,
				"param_name" => "icon_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon color", 'cesis') ,
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon background Color", 'cesis') ,
				"param_name" => "icon_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon background color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon second Color ( used for gradient )", 'cesis') ,
				"param_name" => "icon_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon gradient color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'i_use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon border Color", 'cesis') ,
				"param_name" => "icon_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon border color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Hover Color", 'cesis') ,
				"param_name" => "h_icon_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon hover color", 'cesis') ,
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Hover background Color", 'cesis') ,
				"param_name" => "h_icon_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon hover gradient Color", 'cesis') ,
				"param_name" => "h_icon_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Icon hover gradient Color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'i_use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon hover border Color", 'cesis') ,
				"param_name" => "h_icon_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Icon hover border Color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Shadow Color", 'cesis') ,
				"param_name" => "i_shadow_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the shadow color", 'cesis') ,
				'dependency' => array(
					'element' => 'i_shadow_type',
					'value' => array(
						'dropdown',
						'blur',
						'solid',
					)
				) ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Heading Colors settings', 'cesis') ,
				'param_name' => 'c_heading_separator',
				'tag' => 'title'
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Heading Color", 'cesis') ,
				"param_name" => "heading_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the heading color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Heading hover Color", 'cesis') ,
				"param_name" => "heading_h_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the heading hover color", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Text Colors settings', 'cesis') ,
				'param_name' => 'c_text_separator',
				'tag' => 'title'
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Text Color", 'cesis') ,
				"param_name" => "text_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the text color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Text hover Color", 'cesis') ,
				"param_name" => "text_h_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the text hover color", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Button Colors settings', 'cesis') ,
				'param_name' => 'c_button_separator',
				'tag' => 'title',
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Text Color", 'cesis') ,
				"param_name" => "button_text_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the text color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Background Color", 'cesis') ,
				"param_name" => "button_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the background color", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon second Color ( used for gradient )", 'cesis') ,
				"param_name" => "button_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the second background color ( for gradient )", 'cesis') ,
				'dependency' => array(
					'element' => 'b_use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Border Color", 'cesis') ,
				"param_name" => "button_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the border color", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover text Color", 'cesis') ,
				"param_name" => "h_button_text_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover text color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover background Color", 'cesis') ,
				"param_name" => "h_button_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover background gradient Color", 'cesis') ,
				"param_name" => "h_button_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover gradient color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'b_use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover border Color", 'cesis') ,
				"param_name" => "h_button_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover border color", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Shadow Color", 'cesis') ,
				"param_name" => "b_shadow_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the shadow color", 'cesis') ,
				'dependency' => array(
					'element' => 'b_shadow_type',
					'value' => array(
						'dropdown',
						'blur',
						'solid',
					)
				) ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Heading font settings', 'cesis') ,
				'param_name' => 't_heading_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Heading font family', 'cesis') ,
				'param_name' => 'heading_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				"std" => "alt_font",
				'description' => __('Select the font to use.', 'cesis') ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'heading_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "heading_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the heading font size, for example 30px / 2em", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Heading font weight", 'cesis') ,
				"param_name" => "heading_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				"description" => __("Select the heading font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "heading_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the heading line height", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading capitalization", 'cesis') ,
				"param_name" => "heading_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				"description" => __("Select heading capitalization.", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "heading_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the heading letter spacing ( 0 is the default space )", 'cesis')
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Text font settings', 'cesis') ,
				'param_name' => 't_text_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Text font family', 'cesis') ,
				'param_name' => 'text_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'text_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "text_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the text font size, for example 30px / 2em", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Text font weight", 'cesis') ,
				"param_name" => "text_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				"description" => __("Select the text font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "text_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the text line height", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text capitalization", 'cesis') ,
				"param_name" => "text_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"description" => __("Select text capitalization.", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "text_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the text font letter spacing ( 0 is the default space )", 'cesis')
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Button font settings', 'cesis') ,
				'param_name' => 't_button_separator',
				'tag' => 'title',
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Button font family', 'cesis') ,
				'param_name' => 'button_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'button_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'button_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Button font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "button_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the button font size, for example 30px / 2em", 'cesis'),
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Button font weight", 'cesis') ,
				"param_name" => "button_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				"description" => __("Select the button font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'button_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Button capitalization", 'cesis') ,
				"param_name" => "button_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				"description" => __("Select button text capitalization.", 'cesis') ,
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Button Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "button_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the button letter spacing ( 0 is the default space )", 'cesis'),
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	));
	}

}

// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                               ADD BOX ICON                                /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

if (get_option( 'enable_full_version' )) {
add_action('vc_before_init', 'cesis_icon_box_sc');

function cesis_icon_box_sc()
	{
	vc_map(array(
		'name' => __('Icon Box', 'cesis') ,
		'base' => 'cesis_icon_box',
		"icon"		=> get_template_directory_uri() . "/includes/images/icon_box.svg",
		'weight' => '84',
		'category' => __('Content', 'cesis') ,
		'description' => __('Nice Icon box', 'cesis') ,
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __('Link', 'cesis') ,
				'param_name' => 'link',
				'description' => __('Fill this field if you want to add a link ( use http:// )', 'cesis') ,
				'value' => "",
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Open link in a new page?", 'cesis') ,
				"param_name" => "target",
				"value" => array(
					__("No", 'cesis') => "_self",
					__("Yes", 'cesis') => "_blank",
					__("Open in lightbox", 'cesis') => "cesis_lightbox",
				) ,
				'dependency' => array(
					'element' => 'link',
					'not_empty' => true
				) ,
				"description" => __("Select if you want the link to open in a new page.", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Box settings', 'cesis') ,
				'param_name' => 'g_box_separator',
				'tag' => 'title'
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Box style?", 'cesis') ,
				"param_name" => "box_type",
				"value" => array(
					__("Normal", 'cesis') => "normal",
					__("With double bottom", 'cesis') => "cesis_icon_box_d_bottom",
					__("With Highlight top border", 'cesis') => "cesis_icon_box_h_top",
				) ,
				"description" => __("Select the box style", 'cesis') ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Box border size', 'cesis') ,
				'param_name' => 'box_border_size',
				'description' => __('Set the box border size ( set to 0 if not needed )', 'cesis') ,
				'value' => "1",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Box border radius', 'cesis') ,
				'param_name' => 'box_border_radius',
				'description' => __('Set the box border radius', 'cesis') ,
				'value' => "0",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Box top padding ( px or % )', 'cesis') ,
				'param_name' => 'box_top',
				'description' => __('Set the box top padding', 'cesis') ,
				'value' => "40px",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Box bottom padding ( px or % )', 'cesis') ,
				'param_name' => 'box_bottom',
				'description' => __('Set the box bottom padding', 'cesis') ,
				'value' => "40px",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Box left padding ( px or % )', 'cesis') ,
				'param_name' => 'box_left',
				'description' => __('Set the box left padding', 'cesis') ,
				'value' => "30px",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Box right padding ( px or % )', 'cesis') ,
				'param_name' => 'box_right',
				'description' => __('Set the box right padding', 'cesis') ,
				'value' => "30px",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Box Shadow type", 'cesis') ,
				"param_name" => "box_shadow_type",
				"value" => array(
					__("None", 'cesis') => "none",
					__("Dropdown", 'cesis') => "dropdown",
					__("Blur", 'cesis') => "blur",
					__("Solid", 'cesis') => "solid",
				) ,
				"description" => __("Select shadow type", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Box Shadow hover effect", 'cesis') ,
				"param_name" => "box_shadow_hover",
				"value" => array(
					__("Always on", 'cesis') => "always",
					__("Show on hover", 'cesis') => "hover",
					__("Hide on hover", 'cesis') => "off_hover",
				) ,
				'dependency' => array(
					'element' => 'box_shadow_type',
					'value' => array(
						'blur',
						'solid',
						'dropdown',
					)
				) ,
				"description" => __("Select hover effect", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Icon settings', 'cesis') ,
				'param_name' => 'g_icon_separator',
				'tag' => 'title'
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Icon position", 'cesis') ,
				"param_name" => "position",
				"value" => array(
					__("Top", 'cesis') => "i_top",
					__("Left", 'cesis') => "i_left",
					__("Right", 'cesis') => "i_right",
					__("Top on border line", 'cesis') => "i_top_on_border",
					__("Left on border line", 'cesis') => "i_left_on_border",
					__("Right on border line", 'cesis') => "i_right_on_border",
				) ,
				"description" => __("Select the icon position", 'cesis') ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Space between icon and text', 'cesis') ,
				'param_name' => 'i_space',
				'description' => __('Set the space between the icon and content ( eg 20 )', 'cesis') ,
				'value' => "20",
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Use Icon or Image?", 'cesis') ,
				"param_name" => "i_choice",
				"value" => array(
					__("Icon", 'cesis') => "icon",
					__("Image", 'cesis') => "image",
				) ,
				"description" => __("Select if you want to use an image instead of the icon", 'cesis') ,
			) ,
			array(
				'type' => 'attach_image',
				'heading' => __('Image', 'cesis') ,
				'param_name' => 'image',
				'value' => '',
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'image'
					)
				) ,
				'description' => __('Select the image.', 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Image width', 'cesis') ,
				'param_name' => 'image_size',
				'value' => '100',
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'image'
					)
				) ,
				'description' => __('Set the image width ( the height will be calculated automatically ).', 'cesis')
			) ,
			array(
				'type' => 'cesis_icon',
				'heading' => __('Icon', 'cesis') ,
				'param_name' => 'icon',
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Icon size', 'cesis') ,
				'param_name' => 'i_size',
				'description' => __('Set the icon size', 'cesis') ,
				'value' => "40",
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Use Gradient for the icon?", 'cesis') ,
				'param_name' => 'i_use_gradient',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
				'description' => __("Select if you want to use gradient for the icon", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Add Background for the icon?", 'cesis') ,
				'param_name' => 'use_shape',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
				'description' => __("Select if you want to use background and border for the icon", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Background shape", 'cesis') ,
				"param_name" => "shape",
				"value" => array(
					__("Rounded", 'cesis') => "rounded",
					__("Squared", 'cesis') => "squared",
					__("Diamond", 'cesis') => "diamond",
					__("Hexagon", 'cesis') => "hexagon",
				) ,
				"description" => __("Select icon background shape", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Background border radius', 'cesis') ,
				'param_name' => 'i_radius',
				'description' => __('Set the border radius 0~100 ( 100 for perfect circle, 0 for squared )', 'cesis') ,
				'value' => "100",
				'dependency' => array(
					'element' => 'shape',
					'value' => array(
						'rounded'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Background size', 'cesis') ,
				'param_name' => 'i_bg_size',
				'description' => __('Set the icon background size', 'cesis') ,
				'value' => "110",
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Background border size', 'cesis') ,
				'param_name' => 'i_b_size',
				'description' => __('Set the icon border size ( set to 0 if border not needed)', 'cesis') ,
				'value' => "0",
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Icon Hover effect", 'cesis') ,
				"param_name" => "i_hover",
				"value" => array(
					__("None", 'cesis') => "none",
					__("Shine", 'cesis') => "shine",
					__("Grow", 'cesis') => "grow",
					__("Shrink", 'cesis') => "shrink",
					__("Outline outward", 'cesis') => "outline_o",
					__("Outline inline", 'cesis') => "outline_i",
					__("Trim", 'cesis') => "trim",
				) ,
				"description" => __("Select hover effect", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Icon Shadow type", 'cesis') ,
				"param_name" => "i_shadow_type",
				"value" => array(
					__("None", 'cesis') => "none",
					__("Dropdown", 'cesis') => "dropdown",
					__("Blur", 'cesis') => "blur",
					__("Solid", 'cesis') => "solid",
				) ,
				"description" => __("Select shadow type", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Icon Shadow hover effect", 'cesis') ,
				"param_name" => "i_shadow_hover",
				"value" => array(
					__("Always on", 'cesis') => "always",
					__("Show on hover", 'cesis') => "hover",
					__("Hide on hover", 'cesis') => "off_hover",
				) ,
				"description" => __("Select hover effect", 'cesis') ,
				'dependency' => array(
					'element' => 'i_shadow_type',
					'value' => array(
						'blur',
						'solid',
						'dropdown',
					)
				) ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Heading settings', 'cesis') ,
				'param_name' => 'g_heading_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Heading', 'cesis') ,
				'param_name' => 'heading',
				'description' => __('Set the heading ( optional )', 'cesis') ,
				'value' => "Great title",
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Heading bottom space', 'cesis') ,
				'param_name' => 'heading_space',
				'description' => __('Set the heading bottom space ( eg 20 )', 'cesis') ,
				'value' => "20",
			) ,
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Text settings', 'cesis') ,
				'param_name' => 'g_text_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'dropdown',
				'heading' => __("Use WYSIWYG Editor for the text content?", 'cesis') ,
				'param_name' => 'use_editor',
				"value" => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				'description' => __("Select if you want to use the WYSIWYG editor instead of the simple textarea", 'cesis') ,
			) ,
			array(
				'type' => 'textarea',
				'heading' => __('Text', 'cesis') ,
				'param_name' => 'text',
				'description' => __('Set the text', 'cesis') ,
				'value' => "Cesis is a great theme and this is a great dummy text filler",
				'dependency' => array(
					'element' => 'use_editor',
					'value' => array(
						'no'
					)
				) ,
			) ,
			array(
				'type' => 'textarea_html',
				'heading' => __('Text', 'cesis') ,
				'param_name' => 'content',
				'description' => __('Set the text', 'cesis') ,
				'dependency' => array(
					'element' => 'use_editor',
					'value' => array(
						'yes'
					)
				) ,
				'value' => "",
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Text bottom space', 'cesis') ,
				'param_name' => 'text_space',
				'description' => __('Set the text bottom space ( eg 20 )', 'cesis') ,
				'value' => "20",
			) ,
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Button settings', 'cesis') ,
				'param_name' => 'g_button_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Use button?", 'cesis') ,
				'param_name' => 'use_button',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to add a button after the text", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button type", 'cesis') ,
				"param_name" => "button_type",
				"value" => array(
					__("Button", 'cesis') => "f_button",
					__("Text only", 'cesis') => "text",
				) ,
				"description" => __("Select the button type", 'cesis') ,
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Button text', 'cesis') ,
				'param_name' => 'button_text',
				'description' => __('Set the button text', 'cesis') ,
				'value' => "Button",
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button size", 'cesis') ,
				"param_name" => "button_size",
				"value" => array(
					__("Small", 'cesis') => "cesis_button_small",
					__("Medium", 'cesis') => "cesis_button_medium",
					__("Large", 'cesis') => "cesis_button_large",
					__("Custom size", 'cesis') => "cesis_button_custom",
				) ,
				"description" => __("Select the button size", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Button width', 'cesis') ,
				'param_name' => 'button_width',
				'description' => __('Set the button width (px or %)', 'cesis') ,
				'value' => "180px",
				'dependency' => array(
					'element' => 'button_size',
					'value' => array(
						'cesis_button_custom'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Button height', 'cesis') ,
				'param_name' => 'button_height',
				'description' => __('Set the button height (px)', 'cesis') ,
				'value' => "45px",
				'dependency' => array(
					'element' => 'button_size',
					'value' => array(
						'cesis_button_custom'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Border size', 'cesis') ,
				'param_name' => 'button_border',
				'description' => __('Set the button border size ( set to 0 if border not needed)', 'cesis') ,
				'value' => "0",
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Border radius', 'cesis') ,
				'param_name' => 'button_radius',
				'description' => __('Set the border radius 0~100', 'cesis') ,
				'value' => "0",
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __("Use Gradient for the button?", 'cesis') ,
				'param_name' => 'b_use_gradient',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to use gradient for the button", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button Hover effect", 'cesis') ,
				"param_name" => "b_hover",
				"value" => array(
					__("None", 'cesis') => "none",
					__("3D", 'cesis') => "3d",
					__("Shine", 'cesis') => "shine",
					__("Grow", 'cesis') => "grow",
					__("Shrink", 'cesis') => "shrink",
					__("Outline outward", 'cesis') => "outline_o",
					__("Outline inline", 'cesis') => "outline_i",
					__("Trim", 'cesis') => "trim",
				) ,
				"description" => __("Select button hover effect", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button Shadow type", 'cesis') ,
				"param_name" => "b_shadow_type",
				"value" => array(
					__("None", 'cesis') => "none",
					__("Dropdown", 'cesis') => "dropdown",
					__("Blur", 'cesis') => "blur",
					__("Solid", 'cesis') => "solid",
				) ,
				"description" => __("Select button shadow type", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button Shadow hover type", 'cesis') ,
				"param_name" => "b_shadow_hover",
				"value" => array(
					__("Always on", 'cesis') => "always",
					__("Show on hover", 'cesis') => "hover",
					__("Hide on hover", 'cesis') => "off_hover",
				) ,
				"description" => __("Select button shadow hover effect", 'cesis') ,
				'dependency' => array(
					'element' => 'b_shadow_type',
					'value' => array(
						'blur',
						'solid',
						'dropdown',
					)
				) ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Module general settings', 'cesis') ,
				'param_name' => 'g_module_separator',
				'tag' => 'title'
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay ( optional )", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "delay",
				"value" => "0",
				"description" => __("Set the animation delay ( e.g 200 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'cesis') ,
				'param_name' => 'el_class',
				'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Box Colors settings', 'cesis') ,
				'param_name' => 'c_box_separator',
				'tag' => 'title'
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Box background Color", 'cesis') ,
				"param_name" => "box_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the box background color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Box border Color", 'cesis') ,
				"param_name" => "box_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the box border color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover Box background Color", 'cesis') ,
				"param_name" => "h_box_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the box hover background color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover Box border Color", 'cesis') ,
				"param_name" => "h_box_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the box hover border color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Box highlight Color", 'cesis') ,
				"param_name" => "box_highlight_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the box highlight color", 'cesis') ,
				'dependency' => array(
					'element' => 'box_type',
					'value' => array(
						'cesis_icon_box_h_top',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Box Shadow Color", 'cesis') ,
				"param_name" => "box_shadow_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the shadow color", 'cesis') ,
				'dependency' => array(
					'element' => 'box_shadow_type',
					'value' => array(
						'dropdown',
						'blur',
						'solid',
					)
				) ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Icon Colors settings', 'cesis') ,
				'param_name' => 'c_icon_separator',
				'tag' => 'title'
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Color", 'cesis') ,
				"param_name" => "icon_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon color", 'cesis') ,
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon background Color", 'cesis') ,
				"param_name" => "icon_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon background color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon second Color ( used for gradient )", 'cesis') ,
				"param_name" => "icon_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon gradient color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'i_use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon border Color", 'cesis') ,
				"param_name" => "icon_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon border color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover Icon Color", 'cesis') ,
				"param_name" => "h_icon_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon hover color", 'cesis') ,
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Hover background Color", 'cesis') ,
				"param_name" => "h_icon_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon hover gradient Color", 'cesis') ,
				"param_name" => "h_icon_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Icon hover gradient Color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'i_use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon hover border Color", 'cesis') ,
				"param_name" => "h_icon_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Icon hover border Color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Shadow Color", 'cesis') ,
				"param_name" => "i_shadow_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the shadow color", 'cesis') ,
				'dependency' => array(
					'element' => 'i_shadow_type',
					'value' => array(
						'dropdown',
						'blur',
						'solid',
					)
				) ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Heading Colors settings', 'cesis') ,
				'param_name' => 'c_heading_separator',
				'tag' => 'title'
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Heading Color", 'cesis') ,
				"param_name" => "heading_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the heading color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Heading hover Color", 'cesis') ,
				"param_name" => "heading_h_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the heading hover color", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Text Colors settings', 'cesis') ,
				'param_name' => 'c_text_separator',
				'tag' => 'title'
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Text Color", 'cesis') ,
				"param_name" => "text_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the text color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Text hover Color", 'cesis') ,
				"param_name" => "text_h_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the text hover color", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Button Colors settings', 'cesis') ,
				'param_name' => 'c_button_separator',
				'tag' => 'title',
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Text Color", 'cesis') ,
				"param_name" => "button_text_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the text color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Background Color", 'cesis') ,
				"param_name" => "button_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the background color", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon second Color ( used for gradient )", 'cesis') ,
				"param_name" => "button_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the second background color ( for gradient )", 'cesis') ,
				'dependency' => array(
					'element' => 'b_use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Border Color", 'cesis') ,
				"param_name" => "button_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the border color", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover text Color", 'cesis') ,
				"param_name" => "h_button_text_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover text color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover background Color", 'cesis') ,
				"param_name" => "h_button_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover background gradient Color", 'cesis') ,
				"param_name" => "h_button_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover gradient color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'b_use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover border Color", 'cesis') ,
				"param_name" => "h_button_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover border color", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Shadow Color", 'cesis') ,
				"param_name" => "b_shadow_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the shadow color", 'cesis') ,
				'dependency' => array(
					'element' => 'b_shadow_type',
					'value' => array(
						'dropdown',
						'blur',
						'solid',
					)
				) ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Heading font settings', 'cesis') ,
				'param_name' => 't_heading_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Heading font family', 'cesis') ,
				'param_name' => 'heading_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				"std" => "alt_font",
				'description' => __('Select the font to use.', 'cesis') ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'heading_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "heading_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the heading font size, for example 30px / 2em", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Heading font weight", 'cesis') ,
				"param_name" => "heading_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				"description" => __("Select the heading font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "heading_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the heading line height", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading capitalization", 'cesis') ,
				"param_name" => "heading_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				"description" => __("Select heading capitalization.", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "heading_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the heading letter spacing ( 0 is the default space )", 'cesis')
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Text font settings', 'cesis') ,
				'param_name' => 't_text_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Text font family', 'cesis') ,
				'param_name' => 'text_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'text_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "text_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the text font size, for example 30px / 2em", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Text font weight", 'cesis') ,
				"param_name" => "text_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				"description" => __("Select the text font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "text_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the text line height", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text capitalization", 'cesis') ,
				"param_name" => "text_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"description" => __("Select text capitalization.", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "text_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the text font letter spacing ( 0 is the default space )", 'cesis')
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Button font settings', 'cesis') ,
				'param_name' => 't_button_separator',
				'tag' => 'title',
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Button font family', 'cesis') ,
				'param_name' => 'button_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'button_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'button_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Button font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "button_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the button font size, for example 30px / 2em", 'cesis'),
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Button font weight", 'cesis') ,
				"param_name" => "button_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				"description" => __("Select the button font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'button_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Button capitalization", 'cesis') ,
				"param_name" => "button_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				"description" => __("Select button text capitalization.", 'cesis') ,
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Button Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "button_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the button letter spacing ( 0 is the default space )", 'cesis'),
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	));
	}
}

// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                            ADD PROGRESS BAR 		                        /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

add_action('vc_before_init', 'cesis_progress_bar_sc');

function cesis_progress_bar_sc()
	{
	vc_map(array(
		'name' => __('Progress Bar cesis', 'cesis') ,
		'base' => 'cesis_progress_bar',
		"icon"		=> get_template_directory_uri() . "/includes/images/progress_bar.svg",
		'weight' => '78',
		'category' => __('Content', 'cesis') ,
		'description' => __('Animated progress bar', 'cesis') ,
		'params' => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Progress Bar Style", 'cesis') ,
				"param_name" => "style",
				"value" => array(
					__("Title in Bar ( 1 )", 'cesis') => "cesis_pb_1",
					__("Title in Bar ( 2 )", 'cesis') => "cesis_pb_2",
					__("Title in Bar ( 3 )", 'cesis') => "cesis_pb_3",
					__("Thin Bar ( 1 )", 'cesis') => "cesis_pb_4",
					__("Thin Bar ( 2 )", 'cesis') => "cesis_pb_5",
					__("Thin Bar ( 3 )", 'cesis') => "cesis_pb_6",
					__("Thin Bar ( 4 )", 'cesis') => "cesis_pb_7",
					__("Thin Bar ( 5 )", 'cesis') => "cesis_pb_8",
					__("Thick Bar ( 1 )", 'cesis') => "cesis_pb_9",
					__("Thick Bar ( 2 )", 'cesis') => "cesis_pb_10",
					__("Thick Bar ( 3 )", 'cesis') => "cesis_pb_11",
				) ,
				"description" => __("Select the Progress bar Style ( check style design <a href='http://cesis.co/progress-bars/' target='_blank'>here</a> )", 'cesis')
			) ,
			array(
				'type' => 'param_group',
				"group" => __("Bars", 'cesis') ,
				'heading' => __('Bars', 'cesis') ,
				'param_name' => 'values',
				'description' => __('Enter values for the bars.', 'cesis') ,
				'value' => urlencode(json_encode(array(
					array(
						'label' => __('Development', 'cesis') ,
						'value' => '90',
					) ,
					array(
						'label' => __('Design', 'cesis') ,
						'value' => '80',
					) ,
					array(
						'label' => __('Marketing', 'cesis') ,
						'value' => '70',
					) ,
				))) ,
				'params' => array(
					array(
						'type' => 'textfield',
						'heading' => __('Label', 'cesis') ,
						'param_name' => 'label',
						'description' => __('Enter text used as title of bar.', 'cesis') ,
						'admin_label' => true,
					) ,
					array(
						'type' => 'textfield',
						'heading' => __('Value', 'cesis') ,
						'param_name' => 'value',
						'description' => __('Enter value of bar.', 'cesis') ,
						'admin_label' => true,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Bar Color', 'cesis') ,
						'param_name' => 'color',
						'value' => '#69d2e7',
						'description' => __('Select the bar color.', 'cesis') ,
						'admin_label' => true,
						'param_holder_class' => 'vc_colored-dropdown',
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Bar second Color ( optional )', 'cesis') ,
						'param_name' => 'color_two',
						'value' => '#69d2e7',
						'description' => __('Select the bar second color in order to create a gradient ( optional )', 'cesis') ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Bar Container Background color', 'cesis') ,
						'param_name' => 'ctn_color',
						'value' => '#ffffff',
						'description' => __('Select the bar container background color.', 'cesis') ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Bar Container Border color', 'cesis') ,
						'param_name' => 'ctn_b_color',
						'value' => '#e7e7e7',
						'description' => __('Select the bar container border color.', 'cesis') ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Bar Text color', 'cesis') ,
						'param_name' => 'txtcolor',
						'value' => '#ffffff',
						'description' => __('Select the single bar text color.', 'cesis') ,
					) ,
				) ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Units', 'cesis') ,
				'param_name' => 'units',
				'value' => '%',
				'description' => __('Enter measurement units (Example: %, px, points, etc. Note: graph value and units will be appended to graph title).', 'cesis') ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Space ', 'cesis') ,
				'param_name' => 'space',
				'description' => __('Set the space you want to have between each bar, default 10', 'cesis') ,
				'value' => "10",
			) ,
			array(
				'type' => 'checkbox',
				'heading' => __('Options', 'cesis') ,
				'param_name' => 'options',
				'value' => array(
					__('Add stripes', 'cesis') => 'striped',
					__('Add animation (Note: visible only with striped bar).', 'cesis') => 'animated',
				) ,
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'cesis') ,
				'param_name' => 'el_class',
				'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	));
	}



// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                               ADD FLIP BOX                                /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

if (get_option( 'enable_full_version' )) {
add_action('vc_before_init', 'cesis_flip_box_sc');

function cesis_flip_box_sc()
	{
	vc_map(array(
		'name' => __('Flip Box', 'cesis') ,
		'base' => 'cesis_flip_box',
		"icon"		=> get_template_directory_uri() . "/includes/images/flip_box.svg",
		'weight' => '82',
		'category' => __('Content', 'cesis') ,
		'description' => __('Nice Flip box', 'cesis') ,
		'params' => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Flip style", 'cesis') ,
				"param_name" => "flip_type",
				"value" => array(
					__("Horizontal to left", 'cesis') => "horizontal_to_left",
          __("Horizontal to right", 'cesis') => "horizontal_to_right",
          __("Vertical to bottom", 'cesis') => "vertical_to_bottom",
          __("Vertical to top", 'cesis') => "vertical_to_top",
				) ,
				"description" => __("Select the box style", 'cesis') ,
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Box padding ( px or % )', 'cesis') ,
				'param_name' => 'box_padding',
				'description' => __('Set the box padding', 'cesis') ,
				'value' => "40px",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Box min-height', 'cesis') ,
				'param_name' => 'box_height',
				'description' => __('Set the box minimum height', 'cesis') ,
				'value' => "300",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Box border size', 'cesis') ,
				'param_name' => 'box_border_size',
				'description' => __('Set the box border size ( set to 0 if not needed )', 'cesis') ,
				'value' => "0",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Box border radius', 'cesis') ,
				'param_name' => 'box_border_radius',
				'description' => __('Set the box border radius', 'cesis') ,
				'value' => "0",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Content position", 'cesis') ,
				"param_name" => "content_pos",
				"value" => array(
					__("Middle", 'cesis') => "middle",
					__("Top", 'cesis') => "top",
					__("Bottom", 'cesis') => "bottom",
				) ,
				"description" => __("Select the box content position", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Text align", 'cesis') ,
				"param_name" => "text_align",
				"value" => array(
					__("Center", 'cesis') => "center",
					__("Left", 'cesis') => "left",
					__("Right", 'cesis') => "right",
				) ,
				"description" => __("Select box text alignment", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Box settings', 'cesis') ,
				'param_name' => 'g_box_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'attach_image',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Front background image ( optional )', 'cesis') ,
				'param_name' => 'front_image',
				'value' => '',
				'description' => __('Select the image for the front part.', 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Front", 'cesis') ,
				'heading' => __("Use background color as overlay?", 'cesis') ,
				'param_name' => 'use_front_overlay',
				'value' => array(
					'Yes' => 'front_has_overlay'
				) ,
				'dependency' => array(
					'element' => 'front_image',
					'not_empty' => true
				) ,
				'description' => __("Select if you want to use the background color as overlay", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Icon settings', 'cesis') ,
				'param_name' => 'g_icon_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Front", 'cesis') ,
				'heading' => __("Use Icon?", 'cesis') ,
				'param_name' => 'use_icon',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to add a button after the text", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Front", 'cesis') ,
				"class" => "",
				"heading" => __("Icon position", 'cesis') ,
				"param_name" => "position",
				"value" => array(
					__("Top", 'cesis') => "i_top",
					__("Left", 'cesis') => "i_left",
					__("Right", 'cesis') => "i_right",
				) ,
				'dependency' => array(
					'element' => 'use_icon',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the icon position", 'cesis') ,
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Space between icon and text', 'cesis') ,
				'param_name' => 'i_space',
				'dependency' => array(
					'element' => 'use_icon',
					'value' => array(
						'yes'
					)
				) ,
				'description' => __('Set the space between the icon and content ( eg 20 )', 'cesis') ,
				'value' => "20",
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Front", 'cesis') ,
				"class" => "",
				"heading" => __("Use Icon or Image?", 'cesis') ,
				"param_name" => "i_choice",
				"value" => array(
					__("Icon", 'cesis') => "icon",
					__("Image", 'cesis') => "image",
				) ,
				'dependency' => array(
					'element' => 'use_icon',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select if you want to use an image instead of the icon", 'cesis') ,
			) ,
			array(
				'type' => 'attach_image',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Image', 'cesis') ,
				'param_name' => 'image',
				'value' => '',
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'image'
					)
				) ,
				'description' => __('Select the image.', 'cesis')
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Image width', 'cesis') ,
				'param_name' => 'image_size',
				'value' => '100',
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'image'
					)
				) ,
				'description' => __('Set the image width ( the height will be calculated automatically ).', 'cesis')
			) ,
			array(
				'type' => 'cesis_icon',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Icon', 'cesis') ,
				'param_name' => 'icon',
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Icon size', 'cesis') ,
				'param_name' => 'i_size',
				'description' => __('Set the icon size', 'cesis') ,
				'value' => "40",
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Front", 'cesis') ,
				'heading' => __("Use Gradient for the icon?", 'cesis') ,
				'param_name' => 'i_use_gradient',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
				'description' => __("Select if you want to use gradient for the icon", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Front", 'cesis') ,
				'heading' => __("Add Background for the icon?", 'cesis') ,
				'param_name' => 'use_shape',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
				'description' => __("Select if you want to use background and border for the icon", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Front", 'cesis') ,
				"class" => "",
				"heading" => __("Background shape", 'cesis') ,
				"param_name" => "shape",
				"value" => array(
					__("Rounded", 'cesis') => "rounded",
					__("Squared", 'cesis') => "squared",
					__("Diamond", 'cesis') => "diamond",
					__("Hexagon", 'cesis') => "hexagon",
				) ,
				"description" => __("Select icon background shape", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Background border radius', 'cesis') ,
				'param_name' => 'i_radius',
				'description' => __('Set the border radius 0~100 ( 100 for perfect circle, 0 for squared )', 'cesis') ,
				'value' => "100",
				'dependency' => array(
					'element' => 'shape',
					'value' => array(
						'rounded'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Background size', 'cesis') ,
				'param_name' => 'i_bg_size',
				'description' => __('Set the icon background size', 'cesis') ,
				'value' => "110",
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Background border size', 'cesis') ,
				'param_name' => 'i_b_size',
				'description' => __('Set the icon border size ( set to 0 if border not needed)', 'cesis') ,
				'value' => "0",
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Front", 'cesis') ,
				"class" => "",
				"heading" => __("Icon Shadow type", 'cesis') ,
				"param_name" => "i_shadow_type",
				"value" => array(
					__("None", 'cesis') => "none",
					__("Dropdown", 'cesis') => "dropdown",
					__("Blur", 'cesis') => "blur",
					__("Solid", 'cesis') => "solid",
				) ,
				"description" => __("Select shadow type", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Heading settings', 'cesis') ,
				'param_name' => 'g_heading_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Heading', 'cesis') ,
				'param_name' => 'heading',
				'description' => __('Set the heading ( optional )', 'cesis') ,
				'value' => "Front Heading",
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Heading bottom space', 'cesis') ,
				'param_name' => 'heading_space',
				'description' => __('Set the heading bottom space ( eg 20 )', 'cesis') ,
				'value' => "20",
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Text settings', 'cesis') ,
				'param_name' => 'g_text_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'textarea',
				"group" => __("Front", 'cesis') ,
				'heading' => __('Text', 'cesis') ,
				'param_name' => 'text',
				'description' => __('Set the text', 'cesis') ,
				'value' => "This is the text showing on the front part of the box",
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Back", 'cesis') ,
				'heading' => __('Link', 'cesis') ,
				'param_name' => 'link',
				'description' => __('Fill this field if you want to add a link ( use http:// )', 'cesis') ,
				'value' => "",
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Back", 'cesis') ,
				"class" => "",
				"heading" => __("Open link in a new page?", 'cesis') ,
				"param_name" => "target",
				"value" => array(
					__("No", 'cesis') => "_self",
					__("Yes", 'cesis') => "_blank",
					__("Open in lightbox", 'cesis') => "cesis_lightbox",
				) ,
				'dependency' => array(
					'element' => 'link',
					'not_empty' => true
				) ,
				"description" => __("Select if you want the link to open in a new page.", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Back", 'cesis') ,
				'heading' => __('Box settings', 'cesis') ,
				'param_name' => 'back_box_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'attach_image',
				"group" => __("Back", 'cesis') ,
				'heading' => __('Back background image ( optional )', 'cesis') ,
				'param_name' => 'back_image',
				'value' => '',
				'description' => __('Select the background image for the back part.', 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Back", 'cesis') ,
				'heading' => __("Use background color as overlay?", 'cesis') ,
				'param_name' => 'use_back_overlay',
				'value' => array(
					'Yes' => 'back_has_overlay'
				) ,
				'dependency' => array(
					'element' => 'back_image',
					'not_empty' => true
				) ,
				'description' => __("Select if you want to use the background color as overlay", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Back", 'cesis') ,
				'heading' => __('Heading settings', 'cesis') ,
				'param_name' => 'back_heading_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Back", 'cesis') ,
				'heading' => __('Heading', 'cesis') ,
				'param_name' => 'back_heading',
				'description' => __('Set the heading ( optional )', 'cesis') ,
				'value' => "Back Heading",
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Back", 'cesis') ,
				'heading' => __('Heading bottom space', 'cesis') ,
				'param_name' => 'back_heading_space',
				'description' => __('Set the heading bottom space ( eg 20 )', 'cesis') ,
				'value' => "20",
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Back", 'cesis') ,
				'heading' => __('Text settings', 'cesis') ,
				'param_name' => 'back_text_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'textarea',
				"group" => __("Back", 'cesis') ,
				'heading' => __('Text', 'cesis') ,
				'param_name' => 'back_text',
				'description' => __('Set the text', 'cesis') ,
				'value' => "This is the text showing on the back part of the box",
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Back", 'cesis') ,
				'heading' => __('Text bottom space', 'cesis') ,
				'param_name' => 'back_text_space',
				'description' => __('Set the text bottom space ( eg 20 )', 'cesis') ,
				'value' => "20",
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Back", 'cesis') ,
				'heading' => __('Button settings', 'cesis') ,
				'param_name' => 'g_button_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Back", 'cesis') ,
				'heading' => __("Use button?", 'cesis') ,
				'param_name' => 'use_button',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'std' => 'yes',
				'description' => __("Select if you want to add a button after the text", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Back", 'cesis') ,
				"class" => "",
				"heading" => __("Button type", 'cesis') ,
				"param_name" => "button_type",
				"value" => array(
					__("Button", 'cesis') => "f_button",
					__("Text only", 'cesis') => "text",
				) ,
				"description" => __("Select the button type", 'cesis') ,
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Back", 'cesis') ,
				'heading' => __('Button text', 'cesis') ,
				'param_name' => 'button_text',
				'description' => __('Set the button text', 'cesis') ,
				'value' => "Button",
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Back", 'cesis') ,
				"class" => "",
				"heading" => __("Button size", 'cesis') ,
				"param_name" => "button_size",
				"value" => array(
					__("Small", 'cesis') => "cesis_button_small",
					__("Medium", 'cesis') => "cesis_button_medium",
					__("Large", 'cesis') => "cesis_button_large",
					__("Custom size", 'cesis') => "cesis_button_custom",
				) ,
				"description" => __("Select the button size", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Back", 'cesis') ,
				'heading' => __('Button width', 'cesis') ,
				'param_name' => 'button_width',
				'description' => __('Set the button width (px or %)', 'cesis') ,
				'value' => "180px",
				'dependency' => array(
					'element' => 'button_size',
					'value' => array(
						'cesis_button_custom'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Back", 'cesis') ,
				'heading' => __('Button height', 'cesis') ,
				'param_name' => 'button_height',
				'description' => __('Set the button height (px)', 'cesis') ,
				'value' => "45px",
				'dependency' => array(
					'element' => 'button_size',
					'value' => array(
						'cesis_button_custom'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Back", 'cesis') ,
				'heading' => __('Border size', 'cesis') ,
				'param_name' => 'button_border',
				'description' => __('Set the button border size ( set to 0 if border not needed)', 'cesis') ,
				'value' => "0",
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				'type' => 'textfield',
				"group" => __("Back", 'cesis') ,
				'heading' => __('Border radius', 'cesis') ,
				'param_name' => 'button_radius',
				'description' => __('Set the border radius 0~100', 'cesis') ,
				'value' => "0",
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Back", 'cesis') ,
				'heading' => __("Use Gradient for the button?", 'cesis') ,
				'param_name' => 'b_use_gradient',
				'value' => array(
					'Yes' => 'yes'
				) ,
				'description' => __("Select if you want to use gradient for the button", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Back", 'cesis') ,
				"class" => "",
				"heading" => __("Button Hover effect", 'cesis') ,
				"param_name" => "b_hover",
				"value" => array(
					__("None", 'cesis') => "none",
					__("3D", 'cesis') => "3d",
					__("Shine", 'cesis') => "shine",
					__("Grow", 'cesis') => "grow",
					__("Shrink", 'cesis') => "shrink",
					__("Outline outward", 'cesis') => "outline_o",
					__("Outline inline", 'cesis') => "outline_i",
					__("Trim", 'cesis') => "trim",
				) ,
				"description" => __("Select button hover effect", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Back", 'cesis') ,
				"class" => "",
				"heading" => __("Button Shadow type", 'cesis') ,
				"param_name" => "b_shadow_type",
				"value" => array(
					__("None", 'cesis') => "none",
					__("Dropdown", 'cesis') => "dropdown",
					__("Blur", 'cesis') => "blur",
					__("Solid", 'cesis') => "solid",
				) ,
				"description" => __("Select button shadow type", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Back", 'cesis') ,
				"class" => "",
				"heading" => __("Button Shadow hover type", 'cesis') ,
				"param_name" => "b_shadow_hover",
				"value" => array(
					__("Always on", 'cesis') => "always",
					__("Show on hover", 'cesis') => "hover",
					__("Hide on hover", 'cesis') => "off_hover",
				) ,
				"description" => __("Select button shadow hover effect", 'cesis') ,
				'dependency' => array(
					'element' => 'b_shadow_type',
					'value' => array(
						'blur',
						'solid',
						'dropdown',
					)
				) ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				'heading' => __('Module general settings', 'cesis') ,
				'param_name' => 'g_module_separator',
				'tag' => 'title'
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay ( optional )", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "delay",
				"value" => "0",
				"description" => __("Set the animation delay ( e.g 200 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'cesis') ,
				'param_name' => 'el_class',
				'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Box Colors settings', 'cesis') ,
				'param_name' => 'c_box_separator',
				'tag' => 'title'
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Box Front background Color", 'cesis') ,
				"param_name" => "box_front_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the box front background color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Box Back background Color", 'cesis') ,
				"param_name" => "box_back_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the box back background color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Box Front border Color", 'cesis') ,
				"param_name" => "box_front_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the box front border color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Box Back border Color", 'cesis') ,
				"param_name" => "box_back_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the box back border color", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Icon Colors settings', 'cesis') ,
				'param_name' => 'c_icon_separator',
				'tag' => 'title'
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Color", 'cesis') ,
				"param_name" => "icon_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon color", 'cesis') ,
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon background Color", 'cesis') ,
				"param_name" => "icon_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon background color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon second Color ( used for gradient )", 'cesis') ,
				"param_name" => "icon_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon gradient color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'i_use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon border Color", 'cesis') ,
				"param_name" => "icon_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon border color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon Shadow Color", 'cesis') ,
				"param_name" => "i_shadow_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the shadow color", 'cesis') ,
				'dependency' => array(
					'element' => 'i_shadow_type',
					'value' => array(
						'dropdown',
						'blur',
						'solid',
					)
				) ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Heading Colors settings', 'cesis') ,
				'param_name' => 'c_heading_separator',
				'tag' => 'title'
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Front Heading Color", 'cesis') ,
				"param_name" => "heading_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Front heading color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Back Heading Color", 'cesis') ,
				"param_name" => "back_heading_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Back heading color", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Text Colors settings', 'cesis') ,
				'param_name' => 'c_text_separator',
				'tag' => 'title'
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Front Text Color", 'cesis') ,
				"param_name" => "text_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Front text color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Back Text Color", 'cesis') ,
				"param_name" => "back_text_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Back text color", 'cesis') ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Colors", 'cesis') ,
				'heading' => __('Button Colors settings', 'cesis') ,
				'param_name' => 'c_button_separator',
				'tag' => 'title',
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Text Color", 'cesis') ,
				"param_name" => "button_text_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the text color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Background Color", 'cesis') ,
				"param_name" => "button_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the background color", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Icon second Color ( used for gradient )", 'cesis') ,
				"param_name" => "button_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the second background color ( for gradient )", 'cesis') ,
				'dependency' => array(
					'element' => 'b_use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Border Color", 'cesis') ,
				"param_name" => "button_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the border color", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover text Color", 'cesis') ,
				"param_name" => "h_button_text_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover text color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover background Color", 'cesis') ,
				"param_name" => "h_button_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover background gradient Color", 'cesis') ,
				"param_name" => "h_button_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover gradient color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'b_use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Hover border Color", 'cesis') ,
				"param_name" => "h_button_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the hover border color", 'cesis') ,
				'dependency' => array(
					'element' => 'button_type',
					'value' => array(
						'f_button'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Shadow Color", 'cesis') ,
				"param_name" => "b_shadow_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the shadow color", 'cesis') ,
				'dependency' => array(
					'element' => 'b_shadow_type',
					'value' => array(
						'dropdown',
						'blur',
						'solid',
					)
				) ,
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Front Heading font settings', 'cesis') ,
				'param_name' => 't_heading_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Heading font family', 'cesis') ,
				'param_name' => 'heading_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				"std" => "alt_font",
				'description' => __('Select the font to use.', 'cesis') ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'heading_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "heading_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the heading font size, for example 30px / 2em", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Heading font weight", 'cesis') ,
				"param_name" => "heading_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				"description" => __("Select the heading font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "heading_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the heading line height", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading capitalization", 'cesis') ,
				"param_name" => "heading_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				"description" => __("Select heading capitalization.", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "heading_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the heading letter spacing ( 0 is the default space )", 'cesis')
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Front Text font settings', 'cesis') ,
				'param_name' => 't_text_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Text font family', 'cesis') ,
				'param_name' => 'text_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'text_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "text_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the text font size, for example 30px / 2em", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Text font weight", 'cesis') ,
				"param_name" => "text_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				"description" => __("Select the text font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "text_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the text line height", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text capitalization", 'cesis') ,
				"param_name" => "text_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"description" => __("Select text capitalization.", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "text_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the text font letter spacing ( 0 is the default space )", 'cesis')
			) ,




			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Back Heading font settings', 'cesis') ,
				'param_name' => 'b_t_heading_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Heading font family', 'cesis') ,
				'param_name' => 'b_heading_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				"std" => "alt_font",
				'description' => __('Select the font to use.', 'cesis') ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'b_heading_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'b_heading_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "b_heading_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the heading font size, for example 30px / 2em", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Heading font weight", 'cesis') ,
				"param_name" => "b_heading_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				"description" => __("Select the heading font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'b_heading_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "b_heading_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the heading line height", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading capitalization", 'cesis') ,
				"param_name" => "b_heading_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				"description" => __("Select heading capitalization.", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "b_heading_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the heading letter spacing ( 0 is the default space )", 'cesis')
			) ,
			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Back Text font settings', 'cesis') ,
				'param_name' => 'b_t_text_separator',
				'tag' => 'title'
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Back Text font family', 'cesis') ,
				'param_name' => 'b_text_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'b_text_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'b_text_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "b_text_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the text font size, for example 30px / 2em", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Text font weight", 'cesis') ,
				"param_name" => "b_text_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				"description" => __("Select the text font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'b_text_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "b_text_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the text line height", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text capitalization", 'cesis') ,
				"param_name" => "b_text_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"description" => __("Select text capitalization.", 'cesis') ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "b_text_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the text font letter spacing ( 0 is the default space )", 'cesis')
			) ,

			array(
				'type' => 'cesis_vc_separator',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Button font settings', 'cesis') ,
				'param_name' => 't_button_separator',
				'tag' => 'title',
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Button font family', 'cesis') ,
				'param_name' => 'button_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'button_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'button_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Button font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "button_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the button font size, for example 30px / 2em", 'cesis'),
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Button font weight", 'cesis') ,
				"param_name" => "button_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				"description" => __("Select the button font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'button_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Button capitalization", 'cesis') ,
				"param_name" => "button_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				"description" => __("Select button text capitalization.", 'cesis') ,
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Button Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "button_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the button letter spacing ( 0 is the default space )", 'cesis'),
				'dependency' => array(
					'element' => 'use_button',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	));
	}

}


// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                            ADD PRICING TABLES                               /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

add_action('vc_before_init', 'cesis_price_tables_sc');

function cesis_price_tables_sc()
	{
	vc_map(array(
		'name' => __('Pricing Tables', 'cesis') ,
		'base' => 'cesis_price_tables',
		"icon"		=> get_template_directory_uri() . "/includes/images/pricing_table.svg",
		'weight' => '74',
		'category' => __('Content', 'cesis') ,
		'description' => __('Stylish pricing tables', 'cesis') ,
		'params' => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Pricing tables Style", 'cesis') ,
				"param_name" => "style",
				"value" => array(
					__("Style 1", 'cesis') => "cesis_pt_1",
					__("Style 2", 'cesis') => "cesis_pt_2",
					__("Style 3", 'cesis') => "cesis_pt_3",
					__("Style 4", 'cesis') => "cesis_pt_4",
					__("Style 5", 'cesis') => "cesis_pt_5",
					__("Style 6", 'cesis') => "cesis_pt_6",
					__("Style 7", 'cesis') => "cesis_pt_7",
					__("Style 8", 'cesis') => "cesis_pt_8",
				) ,
				"description" => __("Select the Pricing tables Style ( design )", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"heading" => __("Pricing tables Type", 'cesis') ,
				"param_name" => "type",
				"value" => array(
					__("Tables stick together", 'cesis') => "cesis_pt_sticked",
					__("Space between tables", 'cesis') => "cesis_pt_spaced",
				) ,
				"description" => __("Select the type", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Choose the space between the tables', 'cesis') ,
				'param_name' => 'space',
				'description' => __('Select the space between the tables, default 30.', 'cesis') ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'cesis_pt_spaced',
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Force font?", 'cesis') ,
				"param_name" => "force_font",
				'value' => array(
					__("No", 'cesis') => "",
					__("Yes", 'cesis') => "force_font"
				) ,
				"description" => __("Select if you want the Pricing tables to ignore your font settings and use the one used in the demo.", 'cesis')
			) ,
			array(
				'type' => 'param_group',
				'heading' => __('Values', 'cesis') ,
				'param_name' => 'values',
				'group' => 'Tables',
				'description' => __('Enter values for graph - value, title and color.', 'cesis') ,
				'value' => urlencode(json_encode(array(
					array(
						'label' => __('Development', 'cesis') ,
						'value' => '90',
					) ,
					array(
						'label' => __('Design', 'cesis') ,
						'value' => '80',
					) ,
					array(
						'label' => __('Marketing', 'cesis') ,
						'value' => '70',
					) ,
				))) ,
				'params' => array(
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => __("Featured table?", 'cesis') ,
						"param_name" => "featured",
						"value" => array(
							__("No", 'cesis') => "",
							__("Yes", 'cesis') => "yes",
						) ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Table featured Color', 'cesis') ,
						'param_name' => 'table_f_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
						'dependency' => array(
							'element' => 'featured',
							'value' => array(
								'yes',
							)
						) ,
					) ,
					array(
						'type' => 'attach_image',
						'heading' => __('Image', 'cesis') ,
						'param_name' => 'image',
						'value' => '',
						'description' => __('Select the image for table (optional).', 'cesis')
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Table Background Color', 'cesis') ,
						'param_name' => 'table_bg_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
						'dependency' => array(
							'element' => 'style',
							'value' => array(
								'cesis_pt_5',
								'cesis_pt_6',
								'cesis_pt_7',
								'cesis_pt_8',
							)
						) ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Table Border Color', 'cesis') ,
						'param_name' => 'table_b_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
						'dependency' => array(
							'element' => 'style',
							'value' => array(
								'cesis_pt_5',
								'cesis_pt_6',
								'cesis_pt_7',
								'cesis_pt_8',
							)
						) ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Top box Background Color', 'cesis') ,
						'param_name' => 'fb_bg_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
						'dependency' => array(
							'element' => 'style',
							'value' => array(
								'cesis_pt_1',
								'cesis_pt_4',
								'cesis_pt_6',
								'cesis_pt_7',
								'cesis_pt_8',
							)
						) ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Second box Background Color', 'cesis') ,
						'param_name' => 'sb_bg_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
						'dependency' => array(
							'element' => 'style',
							'value' => array(
								'cesis_pt_1',
								'cesis_pt_4',
								'cesis_pt_6',
								'cesis_pt_7',
								'cesis_pt_8',
							)
						) ,
					) ,
					array(
						'type' => 'textfield',
						'heading' => __('Title', 'cesis') ,
						'param_name' => 'title',
						'description' => __('Price table title', 'cesis') ,
						'admin_label' => true,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Title Color', 'cesis') ,
						'param_name' => 'title_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Title Border Color', 'cesis') ,
						'param_name' => 'title_b_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'textfield',
						'heading' => __('Price Description', 'cesis') ,
						'param_name' => 'description',
						'value' => '/month',
						'edit_field_class' => 'vc_col-sm-8 vc_column',
					) ,
					array(
						"type" => "textfield",
						"heading" => __("Price", 'cesis') ,
						"param_name" => "price",
						"value" => "24.99",
						'edit_field_class' => 'vc_col-sm-2 padding-right-0px vc_column',
					) ,
					array(
						'type' => 'textfield',
						'heading' => __('currecny', 'cesis') ,
						'param_name' => 'currency',
						'value' => '$',
						'edit_field_class' => 'vc_col-sm-2 vc_column',
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Description Color', 'cesis') ,
						'param_name' => 'description_color',
						'edit_field_class' => 'vc_col-sm-4 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Price Color', 'cesis') ,
						'param_name' => 'price_color',
						'edit_field_class' => 'vc_col-sm-4 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Currency Color', 'cesis') ,
						'param_name' => 'currency_color',
						'edit_field_class' => 'vc_col-sm-4 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'textarea',
						'heading' => __('Table Description', 'cesis') ,
						'param_name' => 'table_description',
						'description' => __('Optional', 'cesis') ,
						'value' => '',
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Table Description Color', 'cesis') ,
						'param_name' => 'table_description_color',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'param_group',
						'heading' => __('Features', 'cesis') ,
						'param_name' => 'features',
						'description' => __('Enter table features.', 'cesis') ,
						'value' => urlencode(json_encode(array(
							array(
								'f_title' => __('Space', 'cesis') ,
								'f_desc' => '10GB',
							) ,
							array(
								'f_title' => __('Design', 'cesis') ,
								'f_desc' => '80GB',
							) ,
							array(
								'f_title' => __('Marketing', 'cesis') ,
								'f_desc' => '70',
							) ,
						))) ,
						'params' => array(
							array(
								'type' => 'textfield',
								'heading' => __('Feature Name', 'cesis') ,
								'param_name' => 'f_title',
								'admin_label' => true,
								'description' => __('Optional', 'cesis') ,
							) ,
							array(
								'type' => 'textfield',
								'heading' => __('Feature description', 'cesis') ,
								'param_name' => 'f_desc',
								'description' => __('Optional', 'cesis') ,
							) ,
						) ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Features Background Color', 'cesis') ,
						'param_name' => 'features_bg_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Features Border Color', 'cesis') ,
						'param_name' => 'features_b_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Features Title Color', 'cesis') ,
						'param_name' => 'features_t_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Features Description Color', 'cesis') ,
						'param_name' => 'features_d_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Bottom box Background Color', 'cesis') ,
						'param_name' => 'bb_bg_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'textfield',
						'heading' => __('Button Text', 'cesis') ,
						'param_name' => 'btn_text',
						'value' => 'Buy now',
					) ,
					array(
						'type' => 'textfield',
						'heading' => __('Button Link', 'cesis') ,
						'param_name' => 'btn_link',
						'value' => 'http://google.com',
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Button Text Color', 'cesis') ,
						'param_name' => 'btn_t_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Button Background Color', 'cesis') ,
						'param_name' => 'btn_bg_color',
						'edit_field_class' => 'vc_col-sm-4 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Button Border Color', 'cesis') ,
						'param_name' => 'btn_b_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Hover Button Text Color', 'cesis') ,
						'param_name' => 'btn_ht_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Hover Button Background Color', 'cesis') ,
						'param_name' => 'btn_hbg_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
					array(
						'type' => 'colorpicker',
						'heading' => __('Hover Button Border Color', 'cesis') ,
						'param_name' => 'btn_hb_color',
						'edit_field_class' => 'vc_col-sm-6 vc_column',
						'description' => __('Optional', 'cesis') ,
					) ,
				) ,
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay ( optional )", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "delay",
				"value" => "0",
				"description" => __("Set the animation delay ( e.g 200 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_top",
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "margin_bottom",
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Extra class name', 'cesis') ,
				'param_name' => 'el_class',
				'description' => __('Style particular content element differently - add a class name and refer to it in custom CSS.', 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		)
	));
	}


// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                       ADD WOOCOMMERCE SHORTCODES                          /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

if( cesis_check_woo_status() == true) {

add_action('vc_before_init', 'cesis_woocommerce_sc');

function cesis_woocommerce_sc()
	{
	$args = array(
		'taxonomy' => 'product_cat',
		'hide_empty' => '0'
	);
	$variable = get_terms('product_cat', $args);
	$product_get_cat = array();
	$product_get_cat[] = array(
		'label' => 'all',
		'value' => 'all',
	);
	foreach($variable as $key => $value)
		{
		$product_get_cat[] = array(
			'label' => $value->name,
			'value' => $value->term_id
		);
		}

	$args = array(
		'taxonomy' => 'product_tag',
		'hide_empty' => '0'
	);
	$variable = get_terms('product_tag', $args);
	$product_get_tag = array();
	$product_get_tag[] = array(
		'label' => 'all',
		'value' => 'all',
	);
	foreach($variable as $key => $value)
		{
		$product_get_tag[] = array(
			'label' => $value->name,
			'value' => $value->term_id
		);
		}

	vc_map(array(
		"name" => __("Products", 'cesis') ,
		"base" => "cesis_woocommerce",
		"weight" => "87",
		"icon"		=> get_template_directory_uri() . "/includes/images/product.svg",
		'category' => __('Content', 'cesis') ,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Product layout", 'cesis') ,
				"param_name" => "type",
				'value' => array(
					__("Isotope", 'cesis') => "isotope_grid",
					__("Carousel", 'cesis') => "carousel",
				) ,
				"description" => __("Select the Product layout.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Product Style", 'cesis') ,
				"param_name" => "style",
				"value" => array(
					__("Standard", 'cesis') => "cesis_product_style_1",
					__("On Image", 'cesis') => "cesis_product_style_2",
				) ,
				"description" => __("Select Product Style ( design )", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Product Type", 'cesis') ,
				"param_name" => "product_type",
				"value" => array(
					__("All", 'cesis') => "all",
					__("On sale", 'cesis') => "sale",
					__("Featured", 'cesis') => "featured",
				) ,
				"description" => __("Select Product Style ( design )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Number of Posts to load", 'cesis') ,
				"param_name" => "to_show",
				"value" => __("5", 'cesis') ,
				"description" => __("Number of posts to load", 'cesis')
			) ,
			array(
				"type" => "dropdown_multi",
				"class" => "",
				"admin_label" => true,
				"heading" => __("Categories", 'cesis') ,
				"param_name" => "category",
				"value" => $product_get_cat,
				"description" => __("Choose the category to filter the product posts to show (optional)", 'cesis')
			) ,
			array(
				"type" => "dropdown_multi",
				"class" => "",
				"admin_label" => true,
				"heading" => __("Tags", 'cesis') ,
				"param_name" => "tag",
				"value" => $product_get_tag,
				"description" => __("Choose the tag to filter the product posts to show (optional)", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order", 'cesis') ,
				"param_name" => "order",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => array(
					"Descending" => "DESC",
					"Ascending" => 'ASC'
				) ,
				"description" => __("Choose the Order ( default Descending )", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order By", 'cesis') ,
				"param_name" => "orderby",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => array(
					"Date" => "date",
					"Order" => "menu_order",
					"Title" => 'title',
					"Random" => 'rand',
					"Author" => 'author',
					"ID" => 'ID',
					"Modified" => 'modified',
					"Price" => '_price',
					"Sales number" => 'total_sales',
					"Rating" => '_wc_average_rating',
				) ,
				"description" => __("Choose by which parameter you want to order the posts ( default date )", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Number of items per line?", 'cesis') ,
				"param_name" => "col",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					"1" => "1",
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5",
					"6" => "6",
					"7" => "7",
					"8" => "8",
				) ,
				"description" => __("Select the number of items to show per line.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Choose the space between the items", 'cesis') ,
				"param_name" => "padding",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => "30",
				"description" => __("Select the space between the items, default 30.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show price?", 'cesis') ,
				"param_name" => "i_price",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no",
				) ,
				"description" => __("Select if you want to show the price.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show rating?", 'cesis') ,
				"param_name" => "i_rating",
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no",
				) ,
				"description" => __("Select if you want to show the rating.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show add to cart button?", 'cesis') ,
				"param_name" => "i_addtocart",
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no",
				) ,
				"description" => __("Select if you want to show the add to cart button.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Infinite loop?", 'cesis') ,
				"param_name" => "loop",
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to duplicate last and first items to get loop illusion.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Center the active item", 'cesis') ,
				"param_name" => "center",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to active item to be in the Center of the carousel container.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Auto Rotate?", 'cesis') ,
				"param_name" => "scroll",
				'value' => array(
					__("No", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want the carousel to rotate automatically.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Rotation speed", 'cesis') ,
				"param_name" => "speed",
				"value" => "800",
				"description" => __("Select the rotation speed in milliseconds ( example 2000 for 2 seconds )", 'cesis') ,
				'dependency' => array(
					'element' => 'scroll',
					'value' => array(
						'yes'
					)
				)
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"param_name" => "margin_top",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"param_name" => "margin_bottom",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Extra class name", 'cesis') ,
				"param_name" => "el_class",
				"value" => "",
				"description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", 'cesis')
			) ,

			// Colors

			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Title Color", 'cesis') ,
				"param_name" => "m_t_color",
				"value" => '', //Default Red color
				"description" => __("Product title color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Price Color", 'cesis') ,
				"param_name" => "m_price_color",
				"value" => '', //Default Red color
				"description" => __("Product price color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Old Price Color", 'cesis') ,
				"param_name" => "m_old_price_color",
				"value" => '', //Default Red color
				"description" => __("Product old price color ( used for on sale product / optional )", 'cesis') ,
			) ,

			// Filter Options

			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Use a filter?", 'cesis') ,
				"param_name" => "filter",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_grid',
					)
				) ,
				"description" => __("Select if you want to use a filter for the Staff.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Isotope or Ajax filter", 'cesis') ,
				"param_name" => "filter_type",
				'value' => array(
					__("Isotope", 'cesis') => "isotope_filter",
					__("Ajax", 'cesis') => "ajax_filter"
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Isotope filter will filter the posts currently loaded, Ajax filter will re-load post to match selected filter.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter using :", 'cesis') ,
				"param_name" => "filter_base",
				'value' => array(
					__("Tags", 'cesis') => "tag",
					__("Categories", 'cesis') => "category",
					__("Tags & Categories", 'cesis') => "cat_tag"
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Choose if you want to use tag, group or both to filter the posts.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter style", 'cesis') ,
				"param_name" => "filter_style",
				'value' => array(
					__("Text only", 'cesis') => "cesis_filter_style_1",
					__("Top border", 'cesis') => "cesis_filter_style_2",
					__("Bottom border", 'cesis') => "cesis_filter_style_3",
					__("Squared", 'cesis') => "cesis_filter_style_4",
					__("Rounded", 'cesis') => "cesis_filter_style_5",
					__("Small Rounded", 'cesis') => "cesis_filter_style_6",
					__("Rounded Square", 'cesis') => "cesis_filter_style_7",
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Choose filter style ( design ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter position", 'cesis') ,
				"param_name" => "filter_pos",
				'value' => array(
					__("Left", 'cesis') => "left",
					__("Center", 'cesis') => "center",
					__("Right", 'cesis') => "right",
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Choose filter position.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Use Sorter ?", 'cesis') ,
				"param_name" => "sorter",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "cesis_sorter",
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Add a sorter to the filter? ( let the user re-sort the item by name, date etc ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Sorter position", 'cesis') ,
				"param_name" => "sorter_pos",
				'value' => array(
					__("Same as filter", 'cesis') => "same",
					__("Opposite to filter", 'cesis') => "opposite",
				) ,
				'dependency' => array(
					'element' => 'sorter',
					'value' => array(
						'cesis_sorter'
					)
				) ,
				"description" => __("Select the sorter position.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Space between each Filter", 'cesis') ,
				"param_name" => "filter_space",
				"value" => "30",
				"description" => __("Select the space between each filter", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter bottom space", 'cesis') ,
				"param_name" => "filter_b_margin",
				"value" => "0",
				"description" => __("Select the space between the filter and the products", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter font family", 'cesis') ,
				"param_name" => "filter_font",
				'value' => array(
					__("Alternative font", 'cesis') => "alt_font",
					__("Main font", 'cesis') => "main_font",
				) ,
				"description" => __("Select the filter font family ( from the one set in the theme option ).", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter font size", 'cesis') ,
				"param_name" => "filter_f_size",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "14",
				"description" => __("Select the filter font size", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter font weight", 'cesis') ,
				"param_name" => "filter_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the filter font weight.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter capitalization", 'cesis') ,
				"param_name" => "filter_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the filter text capitalization.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter letter spacing", 'cesis') ,
				"param_name" => "filter_l_spacing",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "",
				"description" => __("Select the filter text letter spacing ( optional ) eg : 1", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter color", 'cesis') ,
				"param_name" => "filter_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter text color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter border color", 'cesis') ,
				"param_name" => "filter_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter border color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter background color", 'cesis') ,
				"param_name" => "filter_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter background color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Active Filter color", 'cesis') ,
				"param_name" => "filter_a_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active filter text color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Active Filter border color", 'cesis') ,
				"param_name" => "filter_a_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active filter border color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Active Filter background color", 'cesis') ,
				"param_name" => "filter_a_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active filter background color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter Hover color", 'cesis') ,
				"param_name" => "filter_h_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter hover color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,

			// Pagination Options

			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Show navigation?", 'cesis') ,
				"param_name" => "nav",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation for the carousel.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Show pagination ( dots )?", 'cesis') ,
				"param_name" => "pag",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use pagination for the carousel.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots style", 'cesis') ,
				"param_name" => "pag_type",
				'value' => array(
					__("Grey dots", 'cesis') => 'cesis_owl_pag_1',
					__("White with shadow dots", 'cesis') => "cesis_owl_pag_3",
					__("Outline dots", 'cesis') => "cesis_owl_pag_2",
				) ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the pagination dots design you want to use.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots position", 'cesis') ,
				"param_name" => "pag_pos",
				'value' => array(
					__("Under content", 'cesis') => '',
					__("Over content", 'cesis') => "cesis_owl_pag_over",
				) ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the pagination dots position.", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination color", 'cesis') ,
				"param_name" => "pag_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the navigation color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination active color", 'cesis') ,
				"param_name" => "pag_active_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active pagination color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Choose the navigation type", 'cesis') ,
				"param_name" => "iso_nav",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_grid',
						'isotope_masonry',
						'isotope_packery'
					)
				) ,
				'value' => array(
					__("None", 'cesis') => "none",
					__("Classic navigation", 'cesis') => "classic_nav",
					__("Load more button", 'cesis') => "load_more",
					__("Infinite Scroll", 'cesis') => "infinite_scroll"
				) ,
				"description" => __("Select the Product navigation type.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Choose the navigation position", 'cesis') ,
				"param_name" => "nav_pos",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Justify", 'cesis') => "cesis_nav_justify",
					__("Left", 'cesis') => "cesis_nav_left",
					__("Center", 'cesis') => "cesis_nav_center",
					__("Right", 'cesis') => "cesis_nav_right"
				) ,
				"description" => __("Choose navigation position", 'cesis') ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'classic_nav'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Choose the navigation style", 'cesis') ,
				"param_name" => "nav_style",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Small rounded square", 'cesis') => "cesis_nav_style_0",
					__("Small squared", 'cesis') => "cesis_nav_style_1",
					__("Big squared", 'cesis') => "cesis_nav_style_2",
					__("Rounded", 'cesis') => "cesis_nav_style_3",
					__("Text only", 'cesis') => "cesis_nav_style_4",
				) ,
				"description" => __("Choose navigation position", 'cesis') ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'classic_nav'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation top space", 'cesis') ,
				"param_name" => "nav_top_space",
				"value" => "50",
				"description" => __("Select the space between the content and navigation", 'cesis') ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'classic_nav',
						'load_more'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation Color", 'cesis') ,
				"param_name" => "classic_nav_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Navigation text color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
						'cesis_nav_style_4'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation border Color", 'cesis') ,
				"param_name" => "classic_nav_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Navigation bo color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation background Color", 'cesis') ,
				"param_name" => "classic_nav_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Navigation background color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Current Navigation text Color", 'cesis') ,
				"param_name" => "classic_nav_a_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Current Navigation text color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
						'cesis_nav_style_4',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Current Navigation border Color", 'cesis') ,
				"param_name" => "classic_nav_a_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Current Navigation border color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Current Navigation background Color", 'cesis') ,
				"param_name" => "classic_nav_a_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Current Navigation background color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the color for the Load more button", 'cesis') ,
				'param_name' => 'custom_color',
				'value' => array(
					__("Cesis First button color settings", 'cesis') => "cesis_btn",
					__("Cesis Second button color settings", 'cesis') => "cesis_alt_btn",
					__("Cesis Third button color settings", 'cesis') => "cesis_sub_btn",
					__("Custom colors", 'cesis') => "custom"
				) ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'load_more'
					)
				) ,
				'description' => __("Select the color scheme you want to use for the button", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button Text Color", 'cesis') ,
				"param_name" => "lb_t_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button text color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button Background Color", 'cesis') ,
				"param_name" => "lb_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button background color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button Border Color", 'cesis') ,
				"param_name" => "lb_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button border color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button hover Text Color", 'cesis') ,
				"param_name" => "lb_ht_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover text color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button hover Background Color", 'cesis') ,
				"param_name" => "lb_hbg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button hover Border Color", 'cesis') ,
				"param_name" => "lb_hb_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover border color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button font size", 'cesis') ,
				"param_name" => "lb_f_size",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "14",
				"description" => __("Select the button font size", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button font weight", 'cesis') ,
				"param_name" => "lb_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the button font weight.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button letter spacing", 'cesis') ,
				"param_name" => "lb_l_spacing",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "",
				"description" => __("Select the button text letter spacing ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button text capitalization", 'cesis') ,
				"param_name" => "lb_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the button text capitalization.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Border Radius (optional)", 'cesis') ,
				"param_name" => "lb_b_radius",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Select the button border radius ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Add shadow to button?", 'cesis') ,
				"param_name" => "lb_shadow",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "",
					__("Yes", 'cesis') => "cesis_btn_shadow"
				) ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select if you want to use shadow for the button.", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the size of the Load more button", 'cesis') ,
				'param_name' => 'load_more_size',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Small", 'cesis') => "lb_small",
					__("Medium", 'cesis') => "lb_medium",
					__("Large", 'cesis') => "lb_large",
				) ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'load_more'
					)
				) ,
				'description' => __("Select the button size", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the shape of the Load more button", 'cesis') ,
				'param_name' => 'load_more_shape',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Squared", 'cesis') => "",
					__("Rounded", 'cesis') => "cesis_btn_rounded",
				) ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'cesis_btn',
						'cesis_alt_btn',
						'cesis_sub_btn'
					)
				) ,
				'description' => __("Select the button shape", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the position of the Load more button", 'cesis') ,
				'param_name' => 'load_more_pos',
				'value' => array(
					__("Center", 'cesis') => "lb_center",
					__("Left", 'cesis') => "lb_left",
					__("Right", 'cesis') => "lb_right",
					__("Full Width", 'cesis') => "lb_fw",
				) ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'load_more'
					)
				) ,
				'description' => __("Select the button position", 'cesis')
			) ,

			// Responsive Options

			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for big display / devices?", 'cesis') ,
				"param_name" => "col_big",
				'value' => array(
					"inherit " => "inherit",
					"1 " => "1",
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5"
				) ,
				"std" => "inherit",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of item to show per line for big display / devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for tablet devices?", 'cesis') ,
				"param_name" => "col_tablet",
				'value' => array(
					"1 " => "1",
					"2" => "2",
					"3" => "3"
				) ,
				"std" => "2",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of items to show per line for tablet devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show navigation on tablet devices?", 'cesis') ,
				"param_name" => "nav_tablet",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on tablet devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show pagination on tablet devices?", 'cesis') ,
				"param_name" => "pag_tablet",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use pagination on tablet devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for mobile devices?", 'cesis') ,
				"param_name" => "col_mobile",
				'value' => array(
					"1 " => "1",
					"2" => "2",
					"3" => "3"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of items to show per line for mobile devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show navigation on mobile devices?", 'cesis') ,
				"param_name" => "nav_mobile",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show pagination on mobile devices?", 'cesis') ,
				"param_name" => "pag_mobile",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		) ,
	));
	}

}

// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                            ADD BLOG SHORTCODES                            /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

if (get_option( 'enable_full_version' )) {
add_action('vc_before_init', 'cesis_blog_sc');

function cesis_blog_sc()
	{
	$args = array(
		'taxonomy' => 'category',
		'hide_empty' => '0'
	);
	$variable = get_terms('category', $args);
	$blog_get_cat = array();
	$blog_get_cat[] = array(
		'label' => 'all',
		'value' => 'all',
	);
	foreach($variable as $key => $value)
		{
		$blog_get_cat[] = array(
			'label' => $value->name,
			'value' => $value->term_id
		);
		}

	$args = array(
		'taxonomy' => 'post_tag',
		'hide_empty' => '0'
	);
	$variable = get_terms('post_tag', $args);
	$blog_get_tag = array();
	$blog_get_tag[] = array(
		'label' => 'all',
		'value' => 'all',
	);
	foreach($variable as $key => $value)
		{
		$blog_get_tag[] = array(
			'label' => $value->name,
			'value' => $value->term_id
		);
		}

	vc_map(array(
		"name" => __("Blog", 'cesis') ,
		"base" => "cesis_blog",
		"weight" => "92",
		"icon"		=> get_template_directory_uri() . "/includes/images/blog.svg",
		'front_enqueue_js' => array(
			get_template_directory_uri() . '/js/cesis_custom.js'
		) ,
		'category' => __('Content', 'cesis') ,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Blog type", 'cesis') ,
				"param_name" => "type",
				'value' => array(
					__("Isotope Grid", 'cesis') => "isotope_grid",
					__("Isotope Masonry", 'cesis') => "isotope_masonry",
					__("Isotope Packery", 'cesis') => "isotope_packery",
					__("Carousel", 'cesis') => "carousel",
				) ,
				"description" => __("Select the blog type.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Blog Style", 'cesis') ,
				"param_name" => "style_ig",
				"value" => array(
					__("Standard 1", 'cesis') => "cesis_blog_style_1",
					__("Standard 2", 'cesis') => "cesis_blog_style_2",
					__("Standard 3", 'cesis') => "cesis_blog_style_3",
					__("Standard 4", 'cesis') => "cesis_blog_style_4",
					__("Standard 5", 'cesis') => "cesis_blog_style_5",
					__("Standard 6", 'cesis') => "cesis_blog_style_14",
					__("Boxed 1", 'cesis') => "cesis_blog_style_6",
					__("Boxed 2", 'cesis') => "cesis_blog_style_7",
					__("Boxed 3", 'cesis') => "cesis_blog_style_8",
					__("Boxed 4 ( centered )", 'cesis') => "cesis_blog_style_15",
					__("On image 1", 'cesis') => "cesis_blog_style_9",
					__("On image 2", 'cesis') => "cesis_blog_style_10",
					__("On image 3", 'cesis') => "cesis_blog_style_11",
					__("On image 4", 'cesis') => "cesis_blog_style_12",
					__("On image 5", 'cesis') => "cesis_blog_style_13",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_grid',
						'carousel'
					)
				) ,
				"description" => __("Select Blog Style ( design )", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Blog Style", 'cesis') ,
				"param_name" => "style_im",
				"value" => array(
					__("Standard 1", 'cesis') => "cesis_blog_style_1",
					__("Standard 2", 'cesis') => "cesis_blog_style_2",
					__("Standard 3", 'cesis') => "cesis_blog_style_3",
					__("Standard 4", 'cesis') => "cesis_blog_style_4",
					__("Standard 5", 'cesis') => "cesis_blog_style_5",
					__("Standard 6", 'cesis') => "cesis_blog_style_14",
					__("Boxed 1", 'cesis') => "cesis_blog_style_6",
					__("Boxed 2", 'cesis') => "cesis_blog_style_7",
					__("Boxed 3", 'cesis') => "cesis_blog_style_8",
					__("Boxed 4 ( centered )", 'cesis') => "cesis_blog_style_15",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_masonry'
					)
				) ,
				"description" => __("Select Blog Style ( design )", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Blog Style", 'cesis') ,
				"param_name" => "style_ip",
				"value" => array(
					__("On image 1", 'cesis') => "cesis_blog_style_9",
					__("On image 2", 'cesis') => "cesis_blog_style_10",
					__("On image 3", 'cesis') => "cesis_blog_style_11",
					__("On image 4", 'cesis') => "cesis_blog_style_12",
					__("On image 5", 'cesis') => "cesis_blog_style_13",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_packery'
					)
				) ,
				"description" => __("Select Blog Style ( design )", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Hover effect", 'cesis') ,
				"param_name" => "hover",
				'value' => array(
					__("None", 'cesis') => "",
					__("Colored Overlay", 'cesis') => "cesis_hover_overlay",
					__("Zoom and Link icon", 'cesis') => "cesis_hover_icon",
					__("Content Fade in ( On image style only )", 'cesis') => "cesis_hover_fade",
					__("Content Fade Out ( On image style only )", 'cesis') => "cesis_hover_fade_out",
					__("Content Slide in ( On image style only )", 'cesis') => "cesis_hover_slide",
					__("Content Slide Out ( On image style only )", 'cesis') => "cesis_hover_slide_out",
				) ,
				"description" => __("Select the hover effect you want to use.", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Hover Color", 'cesis') ,
				"param_name" => "hover_color",
				"value" => '', //Default Red color
				"description" => __("Choose the hover color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'hover',
					'value' => array(
						'cesis_hover_overlay',
						'cesis_hover_icon'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Additional effect", 'cesis') ,
				"param_name" => "effect",
				'value' => array(
					__("None", 'cesis') => "",
					__("Shadow", 'cesis') => "cesis_effect_shadow",
					__("Image Zoom In", 'cesis') => "cesis_effect_zoomIn",
					__("Image Zoom Out", 'cesis') => "cesis_effect_zoomOut",
					__("Add Color", 'cesis') => "cesis_effect_color",
					__("Remove Color", 'cesis') => "cesis_effect_decolor",
					__("White frame ( On image style only )", 'cesis') => "cesis_effect_frame",
				) ,
				"description" => __("Select the additional effect you want to use.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Font style", 'cesis') ,
				"param_name" => "force_font",
				'value' => array(
					__("Theme Default", 'cesis') => "",
					__("Demo Pre-set", 'cesis') => "force_font",
					__("Custom", 'cesis') => "custom"
				) ,
				"description" => __("Select the blog font style to use.", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Heading font family', 'cesis') ,
				'param_name' => 'heading_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				"std" => "alt_font",
				'description' => __('Select the font to use.', 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'h_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "h_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the heading font size, for example 30", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Heading font weight", 'cesis') ,
				"param_name" => "h_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				"description" => __("Select the heading font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "h_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the heading line height", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading capitalization", 'cesis') ,
				"param_name" => "h_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				"description" => __("Select text capitalization.", 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "h_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the heading font letter spacing ( 0 is the default space )", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Text font family', 'cesis') ,
				'param_name' => 'text_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'google_fonts',
				'value' => 'font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:300%20light%20regular%3A300%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "t_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the heading font size, for example 14", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Text font weight", 'cesis') ,
				"param_name" => "t_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				"description" => __("Select the text font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "t_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the text line height", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text capitalization", 'cesis') ,
				"param_name" => "t_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"description" => __("Select text capitalization.", 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "t_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the text letter spacing ( 0 is the default space )", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Carousel type", 'cesis') ,
				"param_name" => "carousel_type",
				"value" => array(
					__("Featured image only", 'cesis') => "thumb_only",
					__("All post types", 'cesis') => "all"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want the carousel to use only featured image or all post type ( video, audio etc )", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Thumbnail size", 'cesis') ,
				"param_name" => "thumbnail_size",
				"value" => array(
					__("1:1 ( squared )", 'cesis') => "tn_squared",
					__("4:3  ( rectangle )", 'cesis') => "tn_rectangle_4_3",
					__("3:2  ( rectangle )", 'cesis') => "tn_rectangle_3_2",
					__("16:9 ( landscape )", 'cesis') => "tn_landscape_16_9",
					__("21:9 ( landscape )", 'cesis') => "tn_landscape_21_9",
					__("3:4 ( portrait )", 'cesis') => "tn_portrait_3_4",
					__("2:3 ( portrait )", 'cesis') => "tn_portrait_2_3",
					__("9:16 ( portrait )", 'cesis') => "tn_portrait_9_16",
					__("No thumbnail", 'cesis') => "no_thumb",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_grid',
						'carousel'
					)
				) ,
				"description" => __("Select the posts thumbnail size", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Packery Type", 'cesis') ,
				"param_name" => "packery_type",
				"value" => array(
					__("Squared", 'cesis') => "squared",
					__("Rectangle", 'cesis') => "rectangle"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_packery',
					)
				) ,
				"description" => __("Select the packery image ratio", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Number of Posts to load", 'cesis') ,
				"param_name" => "to_show",
				"value" => __("5", 'cesis') ,
				"description" => __("Number of posts to load", 'cesis')
			) ,
			array(
				"type" => "dropdown_multi",
				"class" => "",
				"admin_label" => true,
				"heading" => __("Category", 'cesis') ,
				"param_name" => "category",
				"value" => $blog_get_cat,
				"description" => __("Choose the category to filter the blog posts to show (optional)", 'cesis')
			) ,
			array(
				"type" => "dropdown_multi",
				"class" => "",
				"admin_label" => true,
				"heading" => __("Tags", 'cesis') ,
				"param_name" => "tag",
				"value" => $blog_get_tag,
				"description" => __("Choose the tag to filter the blog posts to show (optional)", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order", 'cesis') ,
				"param_name" => "order",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => array(
					"Descending" => "DESC",
					"Ascending" => 'ASC'
				) ,
				"description" => __("Choose the Order ( default Descending )", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order By", 'cesis') ,
				"param_name" => "orderby",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => array(
					"Date" => "date",
					"Order" => "menu_order",
					"Title" => 'title',
					"Random" => 'rand',
					"Author" => 'author',
					"ID" => 'ID',
					"Modified" => 'modified',
				) ,
				"description" => __("Choose by which parameter you want to order the posts ( default date )", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Number of items per line?", 'cesis') ,
				"param_name" => "col",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					"1" => "1",
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5",
					"6" => "6",
					"7" => "7",
					"8" => "8"
				) ,
				"description" => __("Select the number of posts to show per line.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Choose the space between the items", 'cesis') ,
				"param_name" => "padding",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => "30",
				"description" => __("Select the space between the items, default 30.", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Box border radius', 'cesis') ,
				'param_name' => 'border_radius_im',
				'description' => __('Set the box border radius', 'cesis') ,
				'value' => "0",
				'dependency' => array(
					'element' => 'style_im',
					'value' => array(
						'cesis_blog_style_6',
						'cesis_blog_style_7',
						'cesis_blog_style_8',
						'cesis_blog_style_15',
					)
				) ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Box border radius', 'cesis') ,
				'param_name' => 'border_radius_ig',
				'description' => __('Set the box border radius', 'cesis') ,
				'value' => "0",
				'dependency' => array(
					'element' => 'style_ig',
					'value' => array(
						'cesis_blog_style_6',
						'cesis_blog_style_7',
						'cesis_blog_style_8',
						'cesis_blog_style_15',
					)
				) ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Choose the inner space, use % or px", 'cesis') ,
				"param_name" => "inner_padding_ig",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => "10%",
				'dependency' => array(
					'element' => 'style_ig',
					'value' => array(
						'cesis_blog_style_9',
						'cesis_blog_style_10',
						'cesis_blog_style_11',
						'cesis_blog_style_12',
						'cesis_blog_style_13'
					)
				) ,
				"description" => __("Select the inner space, default 10%.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Choose the inner space, use % or px", 'cesis') ,
				"param_name" => "inner_padding_ip",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => "10%",
				'dependency' => array(
					'element' => 'style_ip',
					'value' => array(
						'cesis_blog_style_9',
						'cesis_blog_style_10',
						'cesis_blog_style_11',
						'cesis_blog_style_12',
						'cesis_blog_style_13'
					)
				) ,
				"description" => __("Select the inner space, default 10%.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show author name?", 'cesis') ,
				"param_name" => "i_author",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the author name.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show date?", 'cesis') ,
				"param_name" => "i_date",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the date.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show categories?", 'cesis') ,
				"param_name" => "i_category",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the categories.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show tags?", 'cesis') ,
				"param_name" => "i_tag",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the tags.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show comment number?", 'cesis') ,
				"param_name" => "i_comment",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the comment number.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show like icon?", 'cesis') ,
				"param_name" => "i_like",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the like icon.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show text?", 'cesis') ,
				"param_name" => "i_text",
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no",
				) ,
				"description" => __("Select if you want to show the blog post text.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Select text source", 'cesis') ,
				"param_name" => "text_source",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Excerpt", 'cesis') => "excerpt",
					__("Content", 'cesis') => "content",
				) ,
				"description" => __("Select the text source.", 'cesis') ,
				'dependency' => array(
					'element' => 'i_text',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Number of Characters to show", 'cesis') ,
				"param_name" => "char_length",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "125",
				"description" => __("Select the number of charachters to show ( leave blank to show full post content )", 'cesis') ,
				'dependency' => array(
					'element' => 'i_text',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show read more link?", 'cesis') ,
				"param_name" => "read_more",
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no",
				) ,
				"description" => __("Select if you want to show the read more link.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Read more link style", 'cesis') ,
				"param_name" => "read_more_style",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Text only", 'cesis') => "text",
					__("Button", 'cesis') => "button_rm",
				) ,
				"description" => __("Select the read more link style.", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Read more text font family", 'cesis') ,
				"param_name" => "rm_t_font",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Main font", 'cesis') => "main_font",
					__("Alternative font", 'cesis') => "alt_font",
				) ,
				"description" => __("Select the read more font family ( from the one set in the theme option ).", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_style',
					'value' => array(
						'text'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Read more text font weight", 'cesis') ,
				"param_name" => "rm_t_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"description" => __("Select the read more text font weight.", 'cesis') ,
				"std" => "400",
				'dependency' => array(
					'element' => 'read_more_style',
					'value' => array(
						'text'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Read more text capitalization", 'cesis') ,
				"param_name" => "rm_t_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"description" => __("Select the read more text capitalization.", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_style',
					'value' => array(
						'text'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Read more text letter spacing", 'cesis') ,
				"param_name" => "rm_t_l_spacing",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Select the read more text letter spacing ( optional ) eg : 1", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_style',
					'value' => array(
						'text'
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				'heading' => __("Read more button style", 'cesis') ,
				'param_name' => 'read_more_button_style',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Cesis First button color settings", 'cesis') => "cesis_btn",
					__("Cesis Second button color settings", 'cesis') => "cesis_alt_btn",
					__("Cesis Third button color settings", 'cesis') => "cesis_sub_btn",
					__("Custom colors", 'cesis') => "custom"
				) ,
				'dependency' => array(
					'element' => 'read_more_style',
					'value' => array(
						'button_rm'
					)
				) ,
				'description' => __("Select the color scheme you want to use for the read more button", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button Text Color", 'cesis') ,
				"param_name" => "rm_t_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button text color", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button Background Color", 'cesis') ,
				"param_name" => "rm_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button background color", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button Border Color", 'cesis') ,
				"param_name" => "rm_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button border color", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button hover Text Color", 'cesis') ,
				"param_name" => "rm_ht_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover text color", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button hover Background Color", 'cesis') ,
				"param_name" => "rm_hbg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button hover Border Color", 'cesis') ,
				"param_name" => "rm_hb_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover border color", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button font family", 'cesis') ,
				"param_name" => "rm_font",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Main font", 'cesis') => "main_font",
					__("Alternative font", 'cesis') => "alt_font",
				) ,
				"description" => __("Select the read more font family ( from the one set in the theme option ).", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Button font size", 'cesis') ,
				"param_name" => "rm_f_size",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "14",
				"description" => __("Select the button font size", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button font weight", 'cesis') ,
				"param_name" => "rm_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the button font weight.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button text capitalization", 'cesis') ,
				"param_name" => "rm_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the button text capitalization.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Button letter spacing", 'cesis') ,
				"param_name" => "rm_l_spacing",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "",
				"description" => __("Select the button text letter spacing ( optional ) eg : 1", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				'heading' => __("Read more button size", 'cesis') ,
				'param_name' => 'rm_b_size',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Small", 'cesis') => "read_more_small",
					__("Medium", 'cesis') => "read_more_medium",
					__("Large", 'cesis') => "read_more_large",
				) ,
				'dependency' => array(
					'element' => 'read_more_style',
					'value' => array(
						'button_rm'
					)
				) ,
				'description' => __("Select the read more button size", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Border Radius (optional)", 'cesis') ,
				"param_name" => "rm_b_radius",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Select the button border radius ( optional ) eg : 10", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				'heading' => __("Read more button shape", 'cesis') ,
				'param_name' => 'rm_b_shape',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Squared", 'cesis') => "",
					__("Rounded", 'cesis') => "cesis_btn_rounded",
				) ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'cesis_btn',
						'cesis_alt_btn',
						'cesis_sub_btn'
					)
				) ,
				'description' => __("Select the button shape", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Open link in a new page?", 'cesis') ,
				"param_name" => "target",
				'value' => array(
					__("No", 'cesis') => "_self",
					__("Yes", 'cesis') => "_blank",
				) ,
				"description" => __("Select if you want the posts link to open in a new page.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Infinite loop?", 'cesis') ,
				"param_name" => "loop",
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to duplicate last and first items to get loop illusion.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Center the active item", 'cesis') ,
				"param_name" => "center",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to active item to be in the Center of the carousel container.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Auto Rotate?", 'cesis') ,
				"param_name" => "scroll",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want the carousel to rotate automatically.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Rotation speed", 'cesis') ,
				"param_name" => "speed",
				"value" => "800",
				"description" => __("Select the rotation speed in milliseconds ( example 2000 for 2 seconds )", 'cesis') ,
				'dependency' => array(
					'element' => 'scroll',
					'value' => array(
						'yes'
					)
				)
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"param_name" => "margin_top",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Top margin for the Module (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"param_name" => "margin_bottom",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Bottom margin for the Module (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Extra class name", 'cesis') ,
				"param_name" => "el_class",
				"value" => "",
				"description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", 'cesis')
			) ,

			// Colors

			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Blog module background Color", 'cesis') ,
				"param_name" => "m_mbg_color",
				"value" => '', //Default Red color
				"description" => __("Blog module background color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Heading Color", 'cesis') ,
				"param_name" => "m_h_color",
				"value" => '', //Default Red color
				"description" => __("Heading text color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Text Color", 'cesis') ,
				"param_name" => "m_t_color",
				"value" => '', //Default Red color
				"description" => __("Text color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Light Text Color", 'cesis') ,
				"param_name" => "m_lt_color",
				"value" => '', //Default Red color
				"description" => __("Light Text color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Accent Color", 'cesis') ,
				"param_name" => "m_a_color",
				"value" => '', //Default Red color
				"description" => __("Accent color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Border Color", 'cesis') ,
				"param_name" => "m_b_color",
				"value" => '', //Default Red color
				"description" => __("Border color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Background Color", 'cesis') ,
				"param_name" => "m_bg_color",
				"value" => '', //Default Red color
				"description" => __("Background color ( optional & available for box type )", 'cesis') ,
			) ,

			// Filter Options

			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Use a filter?", 'cesis') ,
				"param_name" => "filter",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_grid',
						'isotope_masonry',
						'isotope_packery',
					)
				) ,
				"description" => __("Select if you want to use a filter for the blog.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Isotope or Ajax filter", 'cesis') ,
				"param_name" => "filter_type",
				'value' => array(
					__("Isotope", 'cesis') => "isotope_filter",
					__("Ajax", 'cesis') => "ajax_filter"
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Isotope filter will filter the posts currently loaded, Ajax filter will re-load post to match selected filter.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter using :", 'cesis') ,
				"param_name" => "filter_base",
				'value' => array(
					__("Tags", 'cesis') => "tag",
					__("Categories", 'cesis') => "category",
					__("Tags & Categories", 'cesis') => "cat_tag"
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Choose if you want to use tag, category or both to filter the posts.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter style", 'cesis') ,
				"param_name" => "filter_style",
				'value' => array(
					__("Text only", 'cesis') => "cesis_filter_style_1",
					__("Top border", 'cesis') => "cesis_filter_style_2",
					__("Bottom border", 'cesis') => "cesis_filter_style_3",
					__("Squared", 'cesis') => "cesis_filter_style_4",
					__("Rounded", 'cesis') => "cesis_filter_style_5",
					__("Small Rounded", 'cesis') => "cesis_filter_style_6",
					__("Rounded Square", 'cesis') => "cesis_filter_style_7",
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Choose filter style ( design ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter position", 'cesis') ,
				"param_name" => "filter_pos",
				'value' => array(
					__("Left", 'cesis') => "left",
					__("Center", 'cesis') => "center",
					__("Right", 'cesis') => "right",
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Choose filter position.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Use Sorter ?", 'cesis') ,
				"param_name" => "sorter",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "cesis_sorter",
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Add a sorter to the filter? ( let the user re-sort the item by name, date etc ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Sorter position", 'cesis') ,
				"param_name" => "sorter_pos",
				'value' => array(
					__("Same as filter", 'cesis') => "same",
					__("Opposite to filter", 'cesis') => "opposite",
				) ,
				'dependency' => array(
					'element' => 'sorter',
					'value' => array(
						'cesis_sorter'
					)
				) ,
				"description" => __("Select the sorter position.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Space between each Filter", 'cesis') ,
				"param_name" => "filter_space",
				"value" => "30",
				"description" => __("Select the space between each filter", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter bottom space", 'cesis') ,
				"param_name" => "filter_b_margin",
				"value" => "0",
				"description" => __("Select the space between the filter and the blog", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter font family", 'cesis') ,
				"param_name" => "filter_font",
				'value' => array(
					__("Alternative font", 'cesis') => "alt_font",
					__("Main font", 'cesis') => "main_font",
				) ,
				"description" => __("Select the filter font family ( from the one set in the theme option ).", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter font size", 'cesis') ,
				"param_name" => "filter_f_size",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "14",
				"description" => __("Select the filter font size", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter font weight", 'cesis') ,
				"param_name" => "filter_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the filter font weight.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter capitalization", 'cesis') ,
				"param_name" => "filter_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the filter text capitalization.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter letter spacing", 'cesis') ,
				"param_name" => "filter_l_spacing",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "",
				"description" => __("Select the filter text letter spacing ( optional ) eg : 1", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter color", 'cesis') ,
				"param_name" => "filter_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter text color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter border color", 'cesis') ,
				"param_name" => "filter_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter border color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter background color", 'cesis') ,
				"param_name" => "filter_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter background color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Active Filter color", 'cesis') ,
				"param_name" => "filter_a_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active filter text color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Active Filter border color", 'cesis') ,
				"param_name" => "filter_a_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active filter border color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Active Filter background color", 'cesis') ,
				"param_name" => "filter_a_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active filter background color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter Hover color", 'cesis') ,
				"param_name" => "filter_h_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter hover color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,

			// Pagination Options

			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Show navigation?", 'cesis') ,
				"param_name" => "nav",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation for the carousel.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Show pagination ( dots )?", 'cesis') ,
				"param_name" => "pag",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use pagination for the carousel.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots style", 'cesis') ,
				"param_name" => "pag_type",
				'value' => array(
					__("Grey dots", 'cesis') => 'cesis_owl_pag_1',
					__("White with shadow dots", 'cesis') => "cesis_owl_pag_3",
					__("Outline dots", 'cesis') => "cesis_owl_pag_2",
				) ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the pagination dots design you want to use.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots position", 'cesis') ,
				"param_name" => "pag_pos",
				'value' => array(
					__("Under content", 'cesis') => '',
					__("Over content", 'cesis') => "cesis_owl_pag_over",
				) ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the pagination dots position.", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination color", 'cesis') ,
				"param_name" => "pag_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the navigation color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination active color", 'cesis') ,
				"param_name" => "pag_active_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active pagination color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Choose the navigation type", 'cesis') ,
				"param_name" => "iso_nav",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_grid',
						'isotope_masonry',
						'isotope_packery'
					)
				) ,
				'value' => array(
					__("None", 'cesis') => "none",
					__("Classic navigation", 'cesis') => "classic_nav",
					__("Load more button", 'cesis') => "load_more",
					__("Infinite Scroll", 'cesis') => "infinite_scroll"
				) ,
				"description" => __("Select the blog navigation type.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Choose the navigation position", 'cesis') ,
				"param_name" => "nav_pos",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Justify", 'cesis') => "cesis_nav_justify",
					__("Left", 'cesis') => "cesis_nav_left",
					__("Center", 'cesis') => "cesis_nav_center",
					__("Right", 'cesis') => "cesis_nav_right"
				) ,
				"description" => __("Choose navigation position", 'cesis') ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'classic_nav'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Choose the navigation style", 'cesis') ,
				"param_name" => "nav_style",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Small rounded square", 'cesis') => "cesis_nav_style_0",
					__("Small squared", 'cesis') => "cesis_nav_style_1",
					__("Big squared", 'cesis') => "cesis_nav_style_2",
					__("Rounded", 'cesis') => "cesis_nav_style_3",
					__("Text only", 'cesis') => "cesis_nav_style_4",
				) ,
				"description" => __("Choose navigation position", 'cesis') ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'classic_nav'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation top space", 'cesis') ,
				"param_name" => "nav_top_space",
				"value" => "50",
				"description" => __("Select the space between the content and navigation", 'cesis') ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'classic_nav',
						'load_more'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation Color", 'cesis') ,
				"param_name" => "classic_nav_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Navigation text color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
						'cesis_nav_style_4'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation border Color", 'cesis') ,
				"param_name" => "classic_nav_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Navigation bo color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation background Color", 'cesis') ,
				"param_name" => "classic_nav_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Navigation background color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Current Navigation text Color", 'cesis') ,
				"param_name" => "classic_nav_a_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Current Navigation text color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
						'cesis_nav_style_4',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Current Navigation border Color", 'cesis') ,
				"param_name" => "classic_nav_a_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Current Navigation border color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Current Navigation background Color", 'cesis') ,
				"param_name" => "classic_nav_a_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Current Navigation background color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the color for the Load more button", 'cesis') ,
				'param_name' => 'custom_color',
				'value' => array(
					__("Cesis First button color settings", 'cesis') => "cesis_btn",
					__("Cesis Second button color settings", 'cesis') => "cesis_alt_btn",
					__("Cesis Third button color settings", 'cesis') => "cesis_sub_btn",
					__("Custom colors", 'cesis') => "custom"
				) ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'load_more'
					)
				) ,
				'description' => __("Select the color scheme you want to use for the button", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button Text Color", 'cesis') ,
				"param_name" => "lb_t_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button text color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button Background Color", 'cesis') ,
				"param_name" => "lb_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button background color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button Border Color", 'cesis') ,
				"param_name" => "lb_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button border color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button hover Text Color", 'cesis') ,
				"param_name" => "lb_ht_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover text color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button hover Background Color", 'cesis') ,
				"param_name" => "lb_hbg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button hover Border Color", 'cesis') ,
				"param_name" => "lb_hb_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover border color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button font size", 'cesis') ,
				"param_name" => "lb_f_size",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "14",
				"description" => __("Select the button font size", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button font weight", 'cesis') ,
				"param_name" => "lb_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the button font weight.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button letter spacing", 'cesis') ,
				"param_name" => "lb_l_spacing",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "",
				"description" => __("Select the button text letter spacing ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button text capitalization", 'cesis') ,
				"param_name" => "lb_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the button text capitalization.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Border Radius (optional)", 'cesis') ,
				"param_name" => "lb_b_radius",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Select the button border radius ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Add shadow to button?", 'cesis') ,
				"param_name" => "lb_shadow",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "",
					__("Yes", 'cesis') => "cesis_btn_shadow"
				) ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select if you want to use shadow for the button.", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the size of the Load more button", 'cesis') ,
				'param_name' => 'load_more_size',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Small", 'cesis') => "lb_small",
					__("Medium", 'cesis') => "lb_medium",
					__("Large", 'cesis') => "lb_large",
				) ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'load_more'
					)
				) ,
				'description' => __("Select the button size", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the shape of the Load more button", 'cesis') ,
				'param_name' => 'load_more_shape',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Squared", 'cesis') => "",
					__("Rounded", 'cesis') => "cesis_btn_rounded",
				) ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'cesis_btn',
						'cesis_alt_btn',
						'cesis_sub_btn'
					)
				) ,
				'description' => __("Select the button shape", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the position of the Load more button", 'cesis') ,
				'param_name' => 'load_more_pos',
				'value' => array(
					__("Center", 'cesis') => "lb_center",
					__("Left", 'cesis') => "lb_left",
					__("Right", 'cesis') => "lb_right",
					__("Full Width", 'cesis') => "lb_fw",
				) ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'load_more'
					)
				) ,
				'description' => __("Select the button position", 'cesis')
			) ,

			// Responsive Options

			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for big display / devices?", 'cesis') ,
				"param_name" => "col_big",
				'value' => array(
					"inherit " => "inherit",
					"1 " => "1",
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5"
				) ,
				"std" => "inherit",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of item to show per line for big display / devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for tablet devices?", 'cesis') ,
				"param_name" => "col_tablet",
				'value' => array(
					"1 " => "1",
					"2" => "2",
					"3" => "3"
				) ,
				"std" => "2",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of items to show per line for tablet devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show navigation on tablet devices?", 'cesis') ,
				"param_name" => "nav_tablet",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on tablet devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show pagination on tablet devices?", 'cesis') ,
				"param_name" => "pag_tablet",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use pagination on tablet devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for mobile devices?", 'cesis') ,
				"param_name" => "col_mobile",
				'value' => array(
					"1 " => "1",
					"2" => "2",
					"3" => "3"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of items to show per line for mobile devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show navigation on mobile devices?", 'cesis') ,
				"param_name" => "nav_mobile",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show pagination on mobile devices?", 'cesis') ,
				"param_name" => "pag_mobile",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		) ,
	));
	}
}


// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                       ADD PORTFOLIO SHORTCODES                            /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////


if (get_option( 'enable_full_version' )) {
if( cesis_check_ccp_status() == true) {

add_action('vc_before_init', 'cesis_portfolio_sc');

function cesis_portfolio_sc()
	{
	$args = array(
		'taxonomy' => 'portfolio_category',
		'hide_empty' => '0'
	);
	$variable = get_terms('portfolio_category', $args);
	$portfolio_get_cat = array();
	$portfolio_get_cat[] = array(
		'label' => 'all',
		'value' => 'all',
	);
	foreach($variable as $key => $value)
		{
		$portfolio_get_cat[] = array(
			'label' => $value->name,
			'value' => $value->term_id
		);
		}

	$args = array(
		'taxonomy' => 'portfolio_tag',
		'hide_empty' => '0'
	);
	$variable = get_terms('portfolio_tag', $args);
	$portfolio_get_tag = array();
	$portfolio_get_tag[] = array(
		'label' => 'all',
		'value' => 'all',
	);
	foreach($variable as $key => $value)
		{
		$portfolio_get_tag[] = array(
			'label' => $value->name,
			'value' => $value->term_id
		);
		}

	vc_map(array(
		"name" => __("Portfolio", 'cesis') ,
		"base" => "cesis_portfolio",
		"weight" => "91",
		"icon"		=> get_template_directory_uri() . "/includes/images/portfolio.svg",
		'front_enqueue_js' => array(
			get_template_directory_uri() . '/js/cesis_plugins.js'
		) ,
		'category' => __('Content', 'cesis') ,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Portfolio layout", 'cesis') ,
				"param_name" => "type",
				'value' => array(
					__("Isotope Grid", 'cesis') => "isotope_grid",
					__("Isotope Masonry", 'cesis') => "isotope_masonry",
					__("Isotope Packery", 'cesis') => "isotope_packery",
					__("Carousel", 'cesis') => "carousel",
				) ,
				"description" => __("Select if you want to Portfolio layout.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Portfolio Style", 'cesis') ,
				"param_name" => "style_ig",
				"value" => array(
					__("Standard 1", 'cesis') => "cesis_portfolio_style_1",
					__("Standard 2", 'cesis') => "cesis_portfolio_style_2",
					__("Standard 3 ( centered text )", 'cesis') => "cesis_portfolio_style_3",
					__("Boxed 1", 'cesis') => "cesis_portfolio_style_4",
					__("Boxed 2", 'cesis') => "cesis_portfolio_style_5",
					__("Boxed 3 ( centered text )", 'cesis') => "cesis_portfolio_style_6",
					__("Boxed 4 ( Lateral )", 'cesis') => "cesis_portfolio_style_12",
					__("Boxed 5 ( Lateral Odd and Even )", 'cesis') => "cesis_portfolio_style_13",
					__("On image 1", 'cesis') => "cesis_portfolio_style_7",
					__("On image 2", 'cesis') => "cesis_portfolio_style_8",
					__("On image 3", 'cesis') => "cesis_portfolio_style_9",
					__("On image 4", 'cesis') => "cesis_portfolio_style_10",
					__("On image 5", 'cesis') => "cesis_portfolio_style_11",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_grid',
						'carousel'
					)
				) ,
				"description" => __("Select Portfolio Style ( design )", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Portfolio Style", 'cesis') ,
				"param_name" => "style_im",
				"value" => array(
					__("Standard 1", 'cesis') => "cesis_portfolio_style_1",
					__("Standard 2", 'cesis') => "cesis_portfolio_style_2",
					__("Standard 3 ( centered text )", 'cesis') => "cesis_portfolio_style_3",
					__("Boxed 1", 'cesis') => "cesis_portfolio_style_4",
					__("Boxed 2", 'cesis') => "cesis_portfolio_style_5",
					__("Boxed 3 ( centered text )", 'cesis') => "cesis_portfolio_style_6",
					__("Boxed 4 ( Lateral )", 'cesis') => "cesis_portfolio_style_12",
					__("Boxed 5 ( Lateral Odd and Even )", 'cesis') => "cesis_portfolio_style_13",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_masonry'
					)
				) ,
				"description" => __("Select Portfolio Style ( design )", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Portfolio Style", 'cesis') ,
				"param_name" => "style_ip",
				"value" => array(
					__("On image 1", 'cesis') => "cesis_portfolio_style_7",
					__("On image 2", 'cesis') => "cesis_portfolio_style_8",
					__("On image 3", 'cesis') => "cesis_portfolio_style_9",
					__("On image 4", 'cesis') => "cesis_portfolio_style_10",
					__("On image 5", 'cesis') => "cesis_portfolio_style_11",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_packery'
					)
				) ,
				"description" => __("Select Portfolio Style ( design )", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Hover effect", 'cesis') ,
				"param_name" => "hover",
				'value' => array(
					__("None", 'cesis') => "",
					__("Colored Overlay", 'cesis') => "cesis_hover_overlay",
					__("Zoom and Link icon", 'cesis') => "cesis_hover_icon",
					__("Content Fade in ( On image style only )", 'cesis') => "cesis_hover_fade",
					__("Content Fade Out ( On image style only )", 'cesis') => "cesis_hover_fade_out",
					__("Content Slide in ( On image style only )", 'cesis') => "cesis_hover_slide",
					__("Content Slide Out ( On image style only )", 'cesis') => "cesis_hover_slide_out",
				) ,
				"description" => __("Select the hover effect you want to use.", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Hover Color", 'cesis') ,
				"param_name" => "hover_color",
				"value" => '', //Default Red color
				"description" => __("Choose the hover color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'hover',
					'value' => array(
						'cesis_hover_overlay',
						'cesis_hover_icon'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Additional effect", 'cesis') ,
				"param_name" => "effect",
				'value' => array(
					__("None", 'cesis') => "",
					__("Shadow", 'cesis') => "cesis_effect_shadow",
					__("Image Zoom In", 'cesis') => "cesis_effect_zoomIn",
					__("Image Zoom Out", 'cesis') => "cesis_effect_zoomOut",
					__("Add Color", 'cesis') => "cesis_effect_color",
					__("Remove Color", 'cesis') => "cesis_effect_decolor",
					__("White frame ( On image style only )", 'cesis') => "cesis_effect_frame",
				) ,
				"description" => __("Select the additional effect you want to use.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Font style", 'cesis') ,
				"param_name" => "force_font",
				'value' => array(
					__("Theme Default", 'cesis') => "",
					__("Demo Pre-set", 'cesis') => "force_font",
					__("Custom", 'cesis') => "custom"
				) ,
				"description" => __("Select the portfolio font style to use.", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Heading font family', 'cesis') ,
				'param_name' => 'heading_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				"std" => "alt_font",
				'description' => __('Select the font to use.', 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'h_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "h_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the heading font size, for example 30", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Heading font weight", 'cesis') ,
				"param_name" => "h_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				"description" => __("Select the heading font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "h_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the heading line height", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading capitalization", 'cesis') ,
				"param_name" => "h_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				"description" => __("Select text capitalization.", 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "h_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the heading font letter spacing ( 0 is the default space )", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Text font family', 'cesis') ,
				'param_name' => 'text_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'google_fonts',
				'value' => 'font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:300%20light%20regular%3A300%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "t_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the heading font size, for example 14", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Text font weight", 'cesis') ,
				"param_name" => "t_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				"description" => __("Select the text font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "t_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the text line height", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text capitalization", 'cesis') ,
				"param_name" => "t_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"description" => __("Select text capitalization.", 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "t_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the text letter spacing ( 0 is the default space )", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Carousel type", 'cesis') ,
				"param_name" => "carousel_type",
				"value" => array(
					__("Featured image only", 'cesis') => "thumb_only",
					__("All post types", 'cesis') => "all"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want the carousel to use only featured image or all post type ( video, audio etc )", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Thumbnail size", 'cesis') ,
				"param_name" => "thumbnail_size",
				"value" => array(
					__("1:1 ( squared )", 'cesis') => "tn_squared",
					__("4:3  ( rectangle )", 'cesis') => "tn_rectangle_4_3",
					__("3:2  ( rectangle )", 'cesis') => "tn_rectangle_3_2",
					__("16:9 ( landscape )", 'cesis') => "tn_landscape_16_9",
					__("21:9 ( landscape )", 'cesis') => "tn_landscape_21_9",
					__("3:4 ( portrait )", 'cesis') => "tn_portrait_3_4",
					__("2:3 ( portrait )", 'cesis') => "tn_portrait_2_3",
					__("9:16 ( portrait )", 'cesis') => "tn_portrait_9_16",
					__("No thumbnail", 'cesis') => "no_thumb",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_grid',
						'carousel'
					)
				) ,
				"description" => __("Select the posts thumbnail size", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Packery Type", 'cesis') ,
				"param_name" => "packery_type",
				"value" => array(
					__("Squared", 'cesis') => "squared",
					__("Rectangle", 'cesis') => "rectangle"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_packery',
					)
				) ,
				"description" => __("Select the posts thumbnail size", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Number of Posts to load", 'cesis') ,
				"param_name" => "to_show",
				"value" => __("5", 'cesis') ,
				"description" => __("Number of posts to load", 'cesis')
			) ,
			array(
				"type" => "dropdown_multi",
				"class" => "",
				"admin_label" => true,
				"heading" => __("Category", 'cesis') ,
				"param_name" => "category",
				"value" => $portfolio_get_cat,
				"description" => __("Choose the category to filter the Portfolio posts to show (optional)", 'cesis')
			) ,
			array(
				"type" => "dropdown_multi",
				"class" => "",
				"admin_label" => true,
				"heading" => __("Tags", 'cesis') ,
				"param_name" => "tag",
				"value" => $portfolio_get_tag,
				"description" => __("Choose the tag to filter the Portfolio posts to show (optional)", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order", 'cesis') ,
				"param_name" => "order",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => array(
					"Descending" => "DESC",
					"Ascending" => 'ASC'
				) ,
				"description" => __("Choose the Order ( default Descending )", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order By", 'cesis') ,
				"param_name" => "orderby",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => array(
					"Date" => "date",
					"Order" => "menu_order",
					"Title" => 'title',
					"Random" => 'rand',
					"Author" => 'author',
					"ID" => 'ID',
					"Modified" => 'modified',
				) ,
				"description" => __("Choose by which parameter you want to order the posts ( default date )", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Number of items per line?", 'cesis') ,
				"param_name" => "col",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					"1" => "1",
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5",
					"6" => "6",
				) ,
				"description" => __("Select the number of logos to show per line.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Choose the space between the items", 'cesis') ,
				"param_name" => "padding",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => "30",
				"description" => __("Select the space between the items, default 30.", 'cesis')
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Box border radius', 'cesis') ,
				'param_name' => 'border_radius_im',
				'description' => __('Set the box border radius', 'cesis') ,
				'value' => "0",
				'dependency' => array(
					'element' => 'style_im',
					'value' => array(
						'cesis_portfolio_style_4',
						'cesis_portfolio_style_5',
						'cesis_portfolio_style_6',
					)
				) ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
			) ,
			array(
				'type' => 'textfield',
				'heading' => __('Box border radius', 'cesis') ,
				'param_name' => 'border_radius_ig',
				'description' => __('Set the box border radius', 'cesis') ,
				'value' => "0",
				'dependency' => array(
					'element' => 'style_ig',
					'value' => array(
						'cesis_portfolio_style_4',
						'cesis_portfolio_style_5',
						'cesis_portfolio_style_6',
					)
				) ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Choose the inner space, use % or px", 'cesis') ,
				"param_name" => "inner_padding_ig",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => "10%",
				'dependency' => array(
					'element' => 'style_ig',
					'value' => array(
						'cesis_portfolio_style_7',
						'cesis_portfolio_style_8',
						'cesis_portfolio_style_9',
						'cesis_portfolio_style_10',
						'cesis_portfolio_style_11',
					)
				) ,
				"description" => __("Select the inner space, default 10%.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Choose the inner space, use % or px", 'cesis') ,
				"param_name" => "inner_padding_ip",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => "10%",
				'dependency' => array(
					'element' => 'style_ip',
					'value' => array(
						'cesis_portfolio_style_7',
						'cesis_portfolio_style_8',
						'cesis_portfolio_style_9',
						'cesis_portfolio_style_10',
						'cesis_portfolio_style_11',
					)
				) ,
				"description" => __("Select the inner space, default 10%.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show date?", 'cesis') ,
				"param_name" => "i_date",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the date.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show categories?", 'cesis') ,
				"param_name" => "i_category",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the categories.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show tags?", 'cesis') ,
				"param_name" => "i_tag",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the tags.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show comment number?", 'cesis') ,
				"param_name" => "i_comment",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the comment number.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show like icon?", 'cesis') ,
				"param_name" => "i_like",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the like icon.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show text?", 'cesis') ,
				"param_name" => "i_text",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the Portfolio post text.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Select text source?", 'cesis') ,
				"param_name" => "text_source",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Project description", 'cesis') => "description",
					__("Content", 'cesis') => "content",
				) ,
				"description" => __("Select the text source.", 'cesis') ,
				'dependency' => array(
					'element' => 'i_text',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Number of Characters to show", 'cesis') ,
				"param_name" => "char_length",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "125",
				"description" => __("Select the number of charachters to show ( leave blank to show full post content )", 'cesis') ,
				'dependency' => array(
					'element' => 'i_text',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show read more link?", 'cesis') ,
				"param_name" => "read_more",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the read more link.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Read more link style", 'cesis') ,
				"param_name" => "read_more_style",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Text only", 'cesis') => "text",
					__("Button", 'cesis') => "button_rm",
				) ,
				"description" => __("Select if you want to show the read more link.", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Read more text font family", 'cesis') ,
				"param_name" => "rm_t_font",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Main font", 'cesis') => "main_font",
					__("Alternative font", 'cesis') => "alt_font",
				) ,
				"description" => __("Select the read more font family ( from the one set in the theme option ).", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_style',
					'value' => array(
						'text'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Read more text font weight", 'cesis') ,
				"param_name" => "rm_t_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				"description" => __("Select the read more text font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_style',
					'value' => array(
						'text'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Read more text capitalization", 'cesis') ,
				"param_name" => "rm_t_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"description" => __("Select the read more text capitalization.", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_style',
					'value' => array(
						'text'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Read more text letter spacing", 'cesis') ,
				"param_name" => "rm_t_l_spacing",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Select the read more text letter spacing ( optional ) eg : 1", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_style',
					'value' => array(
						'text'
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				'heading' => __("Read more button style", 'cesis') ,
				'param_name' => 'read_more_button_style',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Cesis First button color settings", 'cesis') => "cesis_btn",
					__("Cesis Second button color settings", 'cesis') => "cesis_alt_btn",
					__("Cesis Third button color settings", 'cesis') => "cesis_sub_btn",
					__("Custom colors ( set it from Colors tabs )", 'cesis') => "custom"
				) ,
				'dependency' => array(
					'element' => 'read_more_style',
					'value' => array(
						'button_rm'
					)
				) ,
				'description' => __("Select the color scheme you want to use for the read more button", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button Text Color", 'cesis') ,
				"param_name" => "rm_t_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button text color", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button Background Color", 'cesis') ,
				"param_name" => "rm_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button background color", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button Border Color", 'cesis') ,
				"param_name" => "rm_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button border color", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button hover Text Color", 'cesis') ,
				"param_name" => "rm_ht_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover text color", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button hover Background Color", 'cesis') ,
				"param_name" => "rm_hbg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Button hover Border Color", 'cesis') ,
				"param_name" => "rm_hb_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover border color", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button font family", 'cesis') ,
				"param_name" => "rm_font",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Main font", 'cesis') => "main_font",
					__("Alternative font", 'cesis') => "alt_font",
				) ,
				"description" => __("Select the read more font family ( from the one set in the theme option ).", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Button font size", 'cesis') ,
				"param_name" => "rm_f_size",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "14",
				"description" => __("Select the button font size", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button font weight", 'cesis') ,
				"param_name" => "rm_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the button font weight.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Button text capitalization", 'cesis') ,
				"param_name" => "rm_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the button text capitalization.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Button letter spacing", 'cesis') ,
				"param_name" => "rm_l_spacing",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "",
				"description" => __("Select the button text letter spacing ( optional ) eg : 1", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				'heading' => __("Read more button size", 'cesis') ,
				'param_name' => 'rm_b_size',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Small", 'cesis') => "read_more_small",
					__("Medium", 'cesis') => "read_more_medium",
					__("Large", 'cesis') => "read_more_large",
				) ,
				'dependency' => array(
					'element' => 'read_more_style',
					'value' => array(
						'button_rm'
					)
				) ,
				'description' => __("Select the read more button size", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Border Radius (optional)", 'cesis') ,
				"param_name" => "rm_b_radius",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Select the button border radius ( optional ) eg : 10", 'cesis') ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				'heading' => __("Read more button shape", 'cesis') ,
				'param_name' => 'rm_b_shape',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Squared", 'cesis') => "",
					__("Rounded", 'cesis') => "cesis_btn_rounded",
				) ,
				'dependency' => array(
					'element' => 'read_more_button_style',
					'value' => array(
						'cesis_btn',
						'cesis_alt_btn',
						'cesis_sub_btn'
					)
				) ,
				'description' => __("Select the button shape", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Open link in a new page?", 'cesis') ,
				"param_name" => "target",
				'value' => array(
					__("No", 'cesis') => "_self",
					__("Yes", 'cesis') => "_blank",
				) ,
				"description" => __("Select if you want the posts link to open in a new page.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Infinite loop?", 'cesis') ,
				"param_name" => "loop",
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to duplicate last and first items to get loop illusion.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Center the active item", 'cesis') ,
				"param_name" => "center",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to active item to be in the Center of the carousel container.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Auto Rotate?", 'cesis') ,
				"param_name" => "scroll",
				'value' => array(
					__("No", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want the carousel to rotate automatically.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Rotation speed", 'cesis') ,
				"param_name" => "speed",
				"value" => "800",
				"description" => __("Select the rotation speed in milliseconds ( example 2000 for 2 seconds )", 'cesis') ,
				'dependency' => array(
					'element' => 'scroll',
					'value' => array(
						'yes'
					)
				)
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"param_name" => "margin_top",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Top margin for the Module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"param_name" => "margin_bottom",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Bottom margin for the Module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Extra class name", 'cesis') ,
				"param_name" => "el_class",
				"value" => "",
				"description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", 'cesis')
			) ,

			// Colors

			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Portfolio module background Color", 'cesis') ,
				"param_name" => "m_mbg_color",
				"value" => '', //Default Red color
				"description" => __("Portfolio module background color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Heading Color", 'cesis') ,
				"param_name" => "m_h_color",
				"value" => '', //Default Red color
				"description" => __("Heading text color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Text Color", 'cesis') ,
				"param_name" => "m_t_color",
				"value" => '', //Default Red color
				"description" => __("Text color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Light Text Color", 'cesis') ,
				"param_name" => "m_lt_color",
				"value" => '', //Default Red color
				"description" => __("Light Text color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Accent Color", 'cesis') ,
				"param_name" => "m_a_color",
				"value" => '', //Default Red color
				"description" => __("Accent color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Border Color", 'cesis') ,
				"param_name" => "m_b_color",
				"value" => '', //Default Red color
				"description" => __("Border color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Background Color", 'cesis') ,
				"param_name" => "m_bg_color",
				"value" => '', //Default Red color
				"description" => __("Background color ( optional & available for box type )", 'cesis') ,
			) ,

			// Filter Options

			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Use a filter?", 'cesis') ,
				"param_name" => "filter",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_grid',
						'isotope_masonry',
						'isotope_packery',
					)
				) ,
				"description" => __("Select if you want to use a filter for the Portfolio.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Isotope or Ajax filter", 'cesis') ,
				"param_name" => "filter_type",
				'value' => array(
					__("Isotope", 'cesis') => "isotope_filter",
					__("Ajax", 'cesis') => "ajax_filter"
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Isotope filter will filter the posts currently loaded, Ajax filter will re-load post to match selected filter.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter using :", 'cesis') ,
				"param_name" => "filter_base",
				'value' => array(
					__("Tags", 'cesis') => "tag",
					__("Categories", 'cesis') => "category",
					__("Tags & Categories", 'cesis') => "cat_tag"
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Choose if you want to use tag, category or both to filter the posts.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter style", 'cesis') ,
				"param_name" => "filter_style",
				'value' => array(
					__("Text only", 'cesis') => "cesis_filter_style_1",
					__("Top border", 'cesis') => "cesis_filter_style_2",
					__("Bottom border", 'cesis') => "cesis_filter_style_3",
					__("Squared", 'cesis') => "cesis_filter_style_4",
					__("Rounded", 'cesis') => "cesis_filter_style_5",
					__("Small Rounded", 'cesis') => "cesis_filter_style_6",
					__("Rounded Square", 'cesis') => "cesis_filter_style_7",
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Choose filter style ( design ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter position", 'cesis') ,
				"param_name" => "filter_pos",
				'value' => array(
					__("Left", 'cesis') => "left",
					__("Center", 'cesis') => "center",
					__("Right", 'cesis') => "right",
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Choose filter position.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Use Sorter ?", 'cesis') ,
				"param_name" => "sorter",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "cesis_sorter",
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Add a sorter to the filter? ( let the user re-sort the item by name, date etc ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Sorter position", 'cesis') ,
				"param_name" => "sorter_pos",
				'value' => array(
					__("Same as filter", 'cesis') => "same",
					__("Opposite to filter", 'cesis') => "opposite",
				) ,
				'dependency' => array(
					'element' => 'sorter',
					'value' => array(
						'cesis_sorter'
					)
				) ,
				"description" => __("Select the sorter position.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Space between each Filter", 'cesis') ,
				"param_name" => "filter_space",
				"value" => "30",
				"description" => __("Select the space between each filter", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter bottom space", 'cesis') ,
				"param_name" => "filter_b_margin",
				"value" => "0",
				"description" => __("Select the space between the filter and the portfolio", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter font family", 'cesis') ,
				"param_name" => "filter_font",
				'value' => array(
					__("Alternative font", 'cesis') => "alt_font",
					__("Main font", 'cesis') => "main_font",
				) ,
				"description" => __("Select the filter font family ( from the one set in the theme option ).", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter font size", 'cesis') ,
				"param_name" => "filter_f_size",
				"value" => "14",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"description" => __("Select the filter font size", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter font weight", 'cesis') ,
				"param_name" => "filter_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the filter font weight.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter capitalization", 'cesis') ,
				"param_name" => "filter_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the filter text capitalization.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter letter spacing", 'cesis') ,
				"param_name" => "filter_l_spacing",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "",
				"description" => __("Select the filter text letter spacing ( optional ) eg : 1", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter color", 'cesis') ,
				"param_name" => "filter_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter text color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter border color", 'cesis') ,
				"param_name" => "filter_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter border color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter background color", 'cesis') ,
				"param_name" => "filter_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter background color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Active Filter color", 'cesis') ,
				"param_name" => "filter_a_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active filter text color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Active Filter border color", 'cesis') ,
				"param_name" => "filter_a_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active filter border color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Active Filter background color", 'cesis') ,
				"param_name" => "filter_a_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active filter background color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter Hover color", 'cesis') ,
				"param_name" => "filter_h_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter hover color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,

			// Pagination Options

			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Show navigation?", 'cesis') ,
				"param_name" => "nav",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation for the carousel.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Show pagination ( dots )?", 'cesis') ,
				"param_name" => "pag",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use pagination for the carousel.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots style", 'cesis') ,
				"param_name" => "pag_type",
				'value' => array(
					__("Grey dots", 'cesis') => 'cesis_owl_pag_1',
					__("White with shadow dots", 'cesis') => "cesis_owl_pag_3",
					__("Outline dots", 'cesis') => "cesis_owl_pag_2",
				) ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the pagination dots design you want to use.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots position", 'cesis') ,
				"param_name" => "pag_pos",
				'value' => array(
					__("Under content", 'cesis') => '',
					__("Over content", 'cesis') => "cesis_owl_pag_over",
				) ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the pagination dots position.", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination color", 'cesis') ,
				"param_name" => "pag_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the navigation color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination active color", 'cesis') ,
				"param_name" => "pag_active_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active pagination color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Choose the navigation type", 'cesis') ,
				"param_name" => "iso_nav",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_grid',
						'isotope_masonry',
						'isotope_packery'
					)
				) ,
				'value' => array(
					__("None", 'cesis') => "none",
					__("Classic navigation", 'cesis') => "classic_nav",
					__("Load more button", 'cesis') => "load_more",
					__("Infinite Scroll", 'cesis') => "infinite_scroll"
				) ,
				"description" => __("Select the Portfolio navigation type.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Choose the navigation position", 'cesis') ,
				"param_name" => "nav_pos",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Justify", 'cesis') => "cesis_nav_justify",
					__("Left", 'cesis') => "cesis_nav_left",
					__("Center", 'cesis') => "cesis_nav_center",
					__("Right", 'cesis') => "cesis_nav_right"
				) ,
				"description" => __("Choose navigation position", 'cesis') ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'classic_nav'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Choose the navigation style", 'cesis') ,
				"param_name" => "nav_style",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Small rounded square", 'cesis') => "cesis_nav_style_0",
					__("Small squared", 'cesis') => "cesis_nav_style_1",
					__("Big squared", 'cesis') => "cesis_nav_style_2",
					__("Rounded", 'cesis') => "cesis_nav_style_3",
					__("Text only", 'cesis') => "cesis_nav_style_4",
				) ,
				"description" => __("Choose navigation position", 'cesis') ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'classic_nav'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation top space", 'cesis') ,
				"param_name" => "nav_top_space",
				"value" => "50",
				"description" => __("Select the space between the content and navigation", 'cesis') ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'classic_nav',
						'load_more'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation Color", 'cesis') ,
				"param_name" => "classic_nav_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Navigation text color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
						'cesis_nav_style_4'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation border Color", 'cesis') ,
				"param_name" => "classic_nav_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Navigation bo color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation background Color", 'cesis') ,
				"param_name" => "classic_nav_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Navigation background color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Current Navigation text Color", 'cesis') ,
				"param_name" => "classic_nav_a_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Current Navigation text color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
						'cesis_nav_style_4',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Current Navigation border Color", 'cesis') ,
				"param_name" => "classic_nav_a_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Current Navigation border color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Current Navigation background Color", 'cesis') ,
				"param_name" => "classic_nav_a_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Current Navigation background color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the color for the Load more button", 'cesis') ,
				'param_name' => 'custom_color',
				'value' => array(
					__("Cesis First button color settings", 'cesis') => "cesis_btn",
					__("Cesis Second button color settings", 'cesis') => "cesis_alt_btn",
					__("Cesis Third button color settings", 'cesis') => "cesis_sub_btn",
					__("Custom colors", 'cesis') => "custom"
				) ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'load_more'
					)
				) ,
				'description' => __("Select the color scheme you want to use for the button", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button Text Color", 'cesis') ,
				"param_name" => "lb_t_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button text color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button Background Color", 'cesis') ,
				"param_name" => "lb_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button background color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button Border Color", 'cesis') ,
				"param_name" => "lb_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button border color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button hover Text Color", 'cesis') ,
				"param_name" => "lb_ht_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover text color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button hover Background Color", 'cesis') ,
				"param_name" => "lb_hbg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button hover Border Color", 'cesis') ,
				"param_name" => "lb_hb_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover border color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button font size", 'cesis') ,
				"param_name" => "lb_f_size",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "14",
				"description" => __("Select the button font size", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button font weight", 'cesis') ,
				"param_name" => "lb_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the button font weight.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button letter spacing", 'cesis') ,
				"param_name" => "lb_l_spacing",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "",
				"description" => __("Select the button text letter spacing ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button text capitalization", 'cesis') ,
				"param_name" => "lb_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the button text capitalization.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Border Radius (optional)", 'cesis') ,
				"param_name" => "lb_b_radius",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Select the button border radius ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Add shadow to button?", 'cesis') ,
				"param_name" => "lb_shadow",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "",
					__("Yes", 'cesis') => "cesis_btn_shadow"
				) ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select if you want to use shadow for the button.", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the size of the Load more button", 'cesis') ,
				'param_name' => 'load_more_size',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Small", 'cesis') => "lb_small",
					__("Medium", 'cesis') => "lb_medium",
					__("Large", 'cesis') => "lb_large",
				) ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'load_more'
					)
				) ,
				'description' => __("Select the button size", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the shape of the Load more button", 'cesis') ,
				'param_name' => 'load_more_shape',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Squared", 'cesis') => "",
					__("Rounded", 'cesis') => "cesis_btn_rounded",
				) ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'cesis_btn',
						'cesis_alt_btn',
						'cesis_sub_btn'
					)
				) ,
				'description' => __("Select the button shape", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the position of the Load more button", 'cesis') ,
				'param_name' => 'load_more_pos',
				'value' => array(
					__("Center", 'cesis') => "lb_center",
					__("Left", 'cesis') => "lb_left",
					__("Right", 'cesis') => "lb_right",
					__("Full Width", 'cesis') => "lb_fw",
				) ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'load_more'
					)
				) ,
				'description' => __("Select the button position", 'cesis')
			) ,

			// Responsive Options

			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for big display / devices?", 'cesis') ,
				"param_name" => "col_big",
				'value' => array(
					"inherit " => "inherit",
					"1 " => "1",
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5"
				) ,
				"std" => "inherit",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of item to show per line for big display / devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for tablet devices?", 'cesis') ,
				"param_name" => "col_tablet",
				'value' => array(
					"1 " => "1",
					"2" => "2",
					"3" => "3"
				) ,
				"std" => "2",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of items to show per line for tablet devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show navigation on tablet devices?", 'cesis') ,
				"param_name" => "nav_tablet",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on tablet devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show pagination on tablet devices?", 'cesis') ,
				"param_name" => "pag_tablet",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use pagination on tablet devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for mobile devices?", 'cesis') ,
				"param_name" => "col_mobile",
				'value' => array(
					"1 " => "1",
					"2" => "2",
					"3" => "3"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of items to show per line for mobile devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show navigation on mobile devices?", 'cesis') ,
				"param_name" => "nav_mobile",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show pagination on mobile devices?", 'cesis') ,
				"param_name" => "pag_mobile",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		) ,
	));
	}
}
}
// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                           ADD STAFF SHORTCODES                            /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////


if( cesis_check_ccp_status() == true) {

add_action('vc_before_init', 'cesis_staff_sc');

function cesis_staff_sc()
	{
	$args = array(
		'taxonomy' => 'staff_group',
		'hide_empty' => '0'
	);
	$variable = get_terms('staff_group', $args);
	$staff_get_cat = array();
	$staff_get_cat[] = array(
		'label' => 'all',
		'value' => 'all',
	);
	foreach($variable as $key => $value)
		{
		$staff_get_cat[] = array(
			'label' => $value->name,
			'value' => $value->term_id
		);
		}

	$args = array(
		'taxonomy' => 'staff_tag',
		'hide_empty' => '0'
	);
	$variable = get_terms('staff_tag', $args);
	$staff_get_tag = array();
	$staff_get_tag[] = array(
		'label' => 'all',
		'value' => 'all',
	);
	foreach($variable as $key => $value)
		{
		$staff_get_tag[] = array(
			'label' => $value->name,
			'value' => $value->term_id
		);
		}

	vc_map(array(
		"name" => __("Staff", 'cesis') ,
		"base" => "cesis_staff",
		"weight" => "90",
		"icon"		=> get_template_directory_uri() . "/includes/images/staff.svg",
		'category' => __('Content', 'cesis') ,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Staff layout", 'cesis') ,
				"param_name" => "type",
				'value' => array(
					__("Isotope", 'cesis') => "isotope_grid",
					__("Isotope packery", 'cesis') => "isotope_packery",
					__("Carousel", 'cesis') => "carousel",
				) ,
				"description" => __("Select the Staff layout.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Staff Style", 'cesis') ,
				"param_name" => "style_ig",
				"value" => array(
					__("Standard 1", 'cesis') => "cesis_staff_style_1",
					__("Standard 2 ( centered text )", 'cesis') => "cesis_staff_style_2",
					__("Boxed 1", 'cesis') => "cesis_staff_style_3",
					__("Boxed 2 ( centered text )", 'cesis') => "cesis_staff_style_4",
					__("Lateral", 'cesis') => "cesis_staff_style_8",
					__("On image 1", 'cesis') => "cesis_staff_style_5",
					__("On image 2", 'cesis') => "cesis_staff_style_6",
					__("On image 3", 'cesis') => "cesis_staff_style_7",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_grid',
						'carousel'
					)
				) ,
				"description" => __("Select Staff Style ( design )", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Staff Style", 'cesis') ,
				"param_name" => "style_ip",
				"value" => array(
					__("On image 1", 'cesis') => "cesis_staff_style_5",
					__("On image 2", 'cesis') => "cesis_staff_style_6",
					__("On image 3", 'cesis') => "cesis_staff_style_7",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_packery',
					)
				) ,
				"description" => __("Select Staff Style ( design )", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Hover effect", 'cesis') ,
				"param_name" => "hover",
				'value' => array(
					__("None", 'cesis') => "",
					__("Colored Overlay", 'cesis') => "cesis_hover_overlay",
					__("Colored Overlay and Social Icons", 'cesis') => "cesis_hover_overlay_social",
					__("Content Fade in ( On image style only )", 'cesis') => "cesis_hover_fade",
					__("Content Fade Out ( On image style only )", 'cesis') => "cesis_hover_fade_out",
					__("Content Slide in ( On image style only )", 'cesis') => "cesis_hover_slide",
					__("Content Slide Out ( On image style only )", 'cesis') => "cesis_hover_slide_out",
				) ,
				"description" => __("Select the hover effect you want to use.", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Hover Color", 'cesis') ,
				"param_name" => "hover_color",
				"value" => '', //Default Red color
				"description" => __("Choose the hover color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'hover',
					'value' => array(
						'cesis_hover_overlay',
						'cesis_hover_overlay_social'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Social Icon background color", 'cesis') ,
				"param_name" => "hover_social_bg_color",
				"value" => '', //Default Red color
				"description" => __("Choose the icon background color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'hover',
					'value' => array(
						'cesis_hover_overlay_social'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Additional effect", 'cesis') ,
				"param_name" => "effect",
				'value' => array(
					__("None", 'cesis') => "",
					__("Shadow", 'cesis') => "cesis_effect_shadow",
					__("Image Zoom In", 'cesis') => "cesis_effect_zoomIn",
					__("Image Zoom Out", 'cesis') => "cesis_effect_zoomOut",
					__("Add Color", 'cesis') => "cesis_effect_color",
					__("Remove Color", 'cesis') => "cesis_effect_decolor",
					__("White frame ( On image style only )", 'cesis') => "cesis_effect_frame",
				) ,
				"description" => __("Select the additional effect you want to use.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Font style", 'cesis') ,
				"param_name" => "force_font",
				'value' => array(
					__("Theme Default", 'cesis') => "",
					__("Demo Pre-set", 'cesis') => "force_font",
					__("Custom", 'cesis') => "custom"
				) ,
				"description" => __("Select the staff font style to use.", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Heading font family', 'cesis') ,
				'param_name' => 'heading_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				"std" => "alt_font",
				'description' => __('Select the font to use.', 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'h_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "h_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the heading font size, for example 30", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Heading font weight", 'cesis') ,
				"param_name" => "h_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				"description" => __("Select the heading font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "h_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the heading line height", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading capitalization", 'cesis') ,
				"param_name" => "h_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				"description" => __("Select text capitalization.", 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Heading Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "h_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the heading font letter spacing ( 0 is the default space )", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Text font family', 'cesis') ,
				'param_name' => 'text_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'google_fonts',
				'value' => 'font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:300%20light%20regular%3A300%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "t_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the heading font size, for example 14", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Text font weight", 'cesis') ,
				"param_name" => "t_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				"description" => __("Select the text font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "t_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the text line height", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text capitalization", 'cesis') ,
				"param_name" => "t_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"description" => __("Select text capitalization.", 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "t_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the text letter spacing ( 0 is the default space )", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Thumbnail size", 'cesis') ,
				"param_name" => "thumbnail_size",
				"value" => array(
					__("1:1 ( squared )", 'cesis') => "tn_squared",
					__("4:3  ( rectangle )", 'cesis') => "tn_rectangle_4_3",
					__("3:2  ( rectangle )", 'cesis') => "tn_rectangle_3_2",
					__("16:9 ( landscape )", 'cesis') => "tn_landscape_16_9",
					__("21:9 ( landscape )", 'cesis') => "tn_landscape_21_9",
					__("3:4 ( portrait )", 'cesis') => "tn_portrait_3_4",
					__("2:3 ( portrait )", 'cesis') => "tn_portrait_2_3",
					__("9:16 ( portrait )", 'cesis') => "tn_portrait_9_16",
					__("No thumbnail", 'cesis') => "no_thumb",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_grid',
						'carousel'
					)
				) ,
				"description" => __("Select the posts thumbnail size", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Number of Posts to load", 'cesis') ,
				"param_name" => "to_show",
				"value" => __("5", 'cesis') ,
				"description" => __("Number of posts to load", 'cesis')
			) ,
			array(
				"type" => "dropdown_multi",
				"class" => "",
				"admin_label" => true,
				"heading" => __("Groups", 'cesis') ,
				"param_name" => "category",
				"value" => $staff_get_cat,
				"description" => __("Choose the group to filter the Staff posts to show (optional)", 'cesis')
			) ,
			array(
				"type" => "dropdown_multi",
				"class" => "",
				"admin_label" => true,
				"heading" => __("Tags", 'cesis') ,
				"param_name" => "tag",
				"value" => $staff_get_tag,
				"description" => __("Choose the tag to filter the Staff posts to show (optional)", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order", 'cesis') ,
				"param_name" => "order",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => array(
					"Descending" => "DESC",
					"Ascending" => 'ASC'
				) ,
				"description" => __("Choose the Order ( default Descending )", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order By", 'cesis') ,
				"param_name" => "orderby",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => array(
					"Date" => "date",
					"Order" => "menu_order",
					"Title" => 'title',
					"Random" => 'rand',
					"Author" => 'author',
					"ID" => 'ID',
					"Modified" => 'modified',
				) ,
				"description" => __("Choose by which parameter you want to order the posts ( default date )", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Number of items per line?", 'cesis') ,
				"param_name" => "col",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					"1" => "1",
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5",
					"6" => "6",
				) ,
				"description" => __("Select the number of logos to show per line.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Choose the space between the items", 'cesis') ,
				"param_name" => "padding",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => "30",
				"description" => __("Select the space between the items, default 30.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Choose the border radius ( optional )", 'cesis') ,
				"param_name" => "border_radius",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => "0",
				"description" => __("Set the border radius if needed.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Choose the inner space, use % or px", 'cesis') ,
				"param_name" => "inner_padding_ig",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => "10%",
				'dependency' => array(
					'element' => 'style_ig',
					'value' => array(
						'cesis_staff_style_5',
						'cesis_staff_style_6',
						'cesis_staff_style_7',
					)
				) ,
				"description" => __("Select the inner space, default 10%.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Choose the inner space, use % or px", 'cesis') ,
				"param_name" => "inner_padding_ip",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => "10%",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_packery',
					)
				) ,
				"description" => __("Select the inner space, default 10%.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Member position?", 'cesis') ,
				"param_name" => "i_author",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no",
				) ,
				"description" => __("Select if you want to show the Member position.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show text?", 'cesis') ,
				"param_name" => "i_text",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want to show the Staff post text.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Select text source?", 'cesis') ,
				"param_name" => "text_source",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Content", 'cesis') => "content",
					__("Member description", 'cesis') => "description",
				) ,
				"std" => "description",
				"description" => __("Select the text source.", 'cesis') ,
				'dependency' => array(
					'element' => 'i_text',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Number of Characters to show", 'cesis') ,
				"param_name" => "char_length",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "125",
				"description" => __("Select the number of charachters to show ( leave blank to show full post content )", 'cesis') ,
				'dependency' => array(
					'element' => 'i_text',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show Social Icons?", 'cesis') ,
				"param_name" => "i_social",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "social_c",
				) ,
				"description" => __("Select if you want to show the Member social icons.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Open link in a new page?", 'cesis') ,
				"param_name" => "target",
				'value' => array(
					__("No", 'cesis') => "_self",
					__("Yes", 'cesis') => "_blank",
					__("Don't link to the single post page", 'cesis') => "no_link",
				) ,
				"description" => __("Select if you want the posts link to open in a new page.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Infinite loop?", 'cesis') ,
				"param_name" => "loop",
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to duplicate last and first items to get loop illusion.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Center the active item", 'cesis') ,
				"param_name" => "center",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to active item to be in the Center of the carousel container.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Auto Rotate?", 'cesis') ,
				"param_name" => "scroll",
				'value' => array(
					__("No", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want the carousel to rotate automatically.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Rotation speed", 'cesis') ,
				"param_name" => "speed",
				"value" => "800",
				"description" => __("Select the rotation speed in milliseconds ( example 2000 for 2 seconds )", 'cesis') ,
				'dependency' => array(
					'element' => 'scroll',
					'value' => array(
						'yes'
					)
				)
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"param_name" => "margin_top",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"param_name" => "margin_bottom",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Extra class name", 'cesis') ,
				"param_name" => "el_class",
				"value" => "",
				"description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", 'cesis')
			) ,

			// Colors

			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Staff module background Color", 'cesis') ,
				"param_name" => "m_mbg_color",
				"value" => '', //Default Red color
				"description" => __("Staff module background color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Heading Color", 'cesis') ,
				"param_name" => "m_h_color",
				"value" => '', //Default Red color
				"description" => __("Heading text color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Text Color", 'cesis') ,
				"param_name" => "m_t_color",
				"value" => '', //Default Red color
				"description" => __("Text color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Light Text Color", 'cesis') ,
				"param_name" => "m_lt_color",
				"value" => '', //Default Red color
				"description" => __("Light Text color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Accent Color", 'cesis') ,
				"param_name" => "m_a_color",
				"value" => '', //Default Red color
				"description" => __("Accent color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Border Color", 'cesis') ,
				"param_name" => "m_b_color",
				"value" => '', //Default Red color
				"description" => __("Border color ( optional )", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Colors", 'cesis') ,
				"heading" => __("Background Color", 'cesis') ,
				"param_name" => "m_bg_color",
				"value" => '', //Default Red color
				"description" => __("Background color ( optional & available for box type )", 'cesis') ,
			) ,

			// Filter Options

			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Use a filter?", 'cesis') ,
				"param_name" => "filter",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_grid',
						'isotope_packery',
					)
				) ,
				"description" => __("Select if you want to use a filter for the Staff.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Isotope or Ajax filter", 'cesis') ,
				"param_name" => "filter_type",
				'value' => array(
					__("Isotope", 'cesis') => "isotope_filter",
					__("Ajax", 'cesis') => "ajax_filter"
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Isotope filter will filter the posts currently loaded, Ajax filter will re-load post to match selected filter.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter using :", 'cesis') ,
				"param_name" => "filter_base",
				'value' => array(
					__("Tags", 'cesis') => "tag",
					__("Groups", 'cesis') => "category",
					__("Tags & Groups", 'cesis') => "cat_tag"
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Choose if you want to use tag, group or both to filter the posts.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter style", 'cesis') ,
				"param_name" => "filter_style",
				'value' => array(
					__("Text only", 'cesis') => "cesis_filter_style_1",
					__("Top border", 'cesis') => "cesis_filter_style_2",
					__("Bottom border", 'cesis') => "cesis_filter_style_3",
					__("Squared", 'cesis') => "cesis_filter_style_4",
					__("Rounded", 'cesis') => "cesis_filter_style_5",
					__("Small Rounded", 'cesis') => "cesis_filter_style_6",
					__("Rounded Square", 'cesis') => "cesis_filter_style_7",
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Choose filter style ( design ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter position", 'cesis') ,
				"param_name" => "filter_pos",
				'value' => array(
					__("Left", 'cesis') => "left",
					__("Center", 'cesis') => "center",
					__("Right", 'cesis') => "right",
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Choose filter position.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Use Sorter ?", 'cesis') ,
				"param_name" => "sorter",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "cesis_sorter",
				) ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Add a sorter to the filter? ( let the user re-sort the item by name, date etc ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Sorter position", 'cesis') ,
				"param_name" => "sorter_pos",
				'value' => array(
					__("Same as filter", 'cesis') => "same",
					__("Opposite to filter", 'cesis') => "opposite",
				) ,
				'dependency' => array(
					'element' => 'sorter',
					'value' => array(
						'cesis_sorter'
					)
				) ,
				"description" => __("Select the sorter position.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Space between each Filter", 'cesis') ,
				"param_name" => "filter_space",
				"value" => "30",
				"description" => __("Select the space between each filter", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter bottom space", 'cesis') ,
				"param_name" => "filter_b_margin",
				"value" => "0",
				"description" => __("Select the space between the filter and the staff", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter font family", 'cesis') ,
				"param_name" => "filter_font",
				'value' => array(
					__("Alternative font", 'cesis') => "alt_font",
					__("Main font", 'cesis') => "main_font",
				) ,
				"description" => __("Select the filter font family ( from the one set in the theme option ).", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter font size", 'cesis') ,
				"param_name" => "filter_f_size",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "14",
				"description" => __("Select the filter font size", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter font weight", 'cesis') ,
				"param_name" => "filter_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the filter font weight.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter capitalization", 'cesis') ,
				"param_name" => "filter_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the filter text capitalization.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter letter spacing", 'cesis') ,
				"param_name" => "filter_l_spacing",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "",
				"description" => __("Select the filter text letter spacing ( optional ) eg : 1", 'cesis') ,
				'dependency' => array(
					'element' => 'filter',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter color", 'cesis') ,
				"param_name" => "filter_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter text color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter border color", 'cesis') ,
				"param_name" => "filter_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter border color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter background color", 'cesis') ,
				"param_name" => "filter_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter background color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Active Filter color", 'cesis') ,
				"param_name" => "filter_a_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active filter text color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Active Filter border color", 'cesis') ,
				"param_name" => "filter_a_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active filter border color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Active Filter background color", 'cesis') ,
				"param_name" => "filter_a_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active filter background color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Filter", 'cesis') ,
				"heading" => __("Filter Hover color", 'cesis') ,
				"param_name" => "filter_h_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the filter hover color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'filter_style',
					'value' => array(
						'cesis_filter_style_1',
						'cesis_filter_style_2',
						'cesis_filter_style_3',
						'cesis_filter_style_4',
						'cesis_filter_style_5',
						'cesis_filter_style_6',
						'cesis_filter_style_7',
					)
				) ,
			) ,

			// Pagination Options

			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Show navigation?", 'cesis') ,
				"param_name" => "nav",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation for the carousel.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Show pagination ( dots )?", 'cesis') ,
				"param_name" => "pag",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use pagination for the carousel.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots style", 'cesis') ,
				"param_name" => "pag_type",
				'value' => array(
					__("Grey dots", 'cesis') => 'cesis_owl_pag_1',
					__("White with shadow dots", 'cesis') => "cesis_owl_pag_3",
					__("Outline dots", 'cesis') => "cesis_owl_pag_2",
				) ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the pagination dots design you want to use.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots position", 'cesis') ,
				"param_name" => "pag_pos",
				'value' => array(
					__("Under content", 'cesis') => '',
					__("Over content", 'cesis') => "cesis_owl_pag_over",
				) ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the pagination dots position.", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination color", 'cesis') ,
				"param_name" => "pag_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the navigation color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination active color", 'cesis') ,
				"param_name" => "pag_active_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active pagination color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Choose the navigation type", 'cesis') ,
				"param_name" => "iso_nav",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope_grid',
						'isotope_masonry',
						'isotope_packery'
					)
				) ,
				'value' => array(
					__("None", 'cesis') => "none",
					__("Classic navigation", 'cesis') => "classic_nav",
					__("Load more button", 'cesis') => "load_more",
					__("Infinite Scroll", 'cesis') => "infinite_scroll"
				) ,
				"description" => __("Select the Staff navigation type.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Choose the navigation position", 'cesis') ,
				"param_name" => "nav_pos",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Justify", 'cesis') => "cesis_nav_justify",
					__("Left", 'cesis') => "cesis_nav_left",
					__("Center", 'cesis') => "cesis_nav_center",
					__("Right", 'cesis') => "cesis_nav_right"
				) ,
				"description" => __("Choose navigation position", 'cesis') ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'classic_nav'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Choose the navigation style", 'cesis') ,
				"param_name" => "nav_style",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Small rounded square", 'cesis') => "cesis_nav_style_0",
					__("Small squared", 'cesis') => "cesis_nav_style_1",
					__("Big squared", 'cesis') => "cesis_nav_style_2",
					__("Rounded", 'cesis') => "cesis_nav_style_3",
					__("Text only", 'cesis') => "cesis_nav_style_4",
				) ,
				"description" => __("Choose navigation position", 'cesis') ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'classic_nav'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation top space", 'cesis') ,
				"param_name" => "nav_top_space",
				"value" => "50",
				"description" => __("Select the space between the content and navigation", 'cesis') ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'classic_nav',
						'load_more'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation Color", 'cesis') ,
				"param_name" => "classic_nav_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Navigation text color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
						'cesis_nav_style_4'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation border Color", 'cesis') ,
				"param_name" => "classic_nav_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Navigation bo color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Navigation background Color", 'cesis') ,
				"param_name" => "classic_nav_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Navigation background color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Current Navigation text Color", 'cesis') ,
				"param_name" => "classic_nav_a_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Current Navigation text color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
						'cesis_nav_style_4',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Current Navigation border Color", 'cesis') ,
				"param_name" => "classic_nav_a_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Current Navigation border color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Current Navigation background Color", 'cesis') ,
				"param_name" => "classic_nav_a_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Current Navigation background color", 'cesis') ,
				'dependency' => array(
					'element' => 'nav_style',
					'value' => array(
						'cesis_nav_style_0',
						'cesis_nav_style_1',
						'cesis_nav_style_2',
						'cesis_nav_style_3',
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the color for the Load more button", 'cesis') ,
				'param_name' => 'custom_color',
				'value' => array(
					__("Cesis First button color settings", 'cesis') => "cesis_btn",
					__("Cesis Second button color settings", 'cesis') => "cesis_alt_btn",
					__("Cesis Third button color settings", 'cesis') => "cesis_sub_btn",
					__("Custom colors", 'cesis') => "custom"
				) ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'load_more'
					)
				) ,
				'description' => __("Select the color scheme you want to use for the button", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button Text Color", 'cesis') ,
				"param_name" => "lb_t_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button text color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button Background Color", 'cesis') ,
				"param_name" => "lb_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button background color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button Border Color", 'cesis') ,
				"param_name" => "lb_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button border color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button hover Text Color", 'cesis') ,
				"param_name" => "lb_ht_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover text color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button hover Background Color", 'cesis') ,
				"param_name" => "lb_hbg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button hover Border Color", 'cesis') ,
				"param_name" => "lb_hb_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover border color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button font size", 'cesis') ,
				"param_name" => "lb_f_size",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "14",
				"description" => __("Select the button font size", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button font weight", 'cesis') ,
				"param_name" => "lb_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the button font weight.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button letter spacing", 'cesis') ,
				"param_name" => "lb_l_spacing",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "",
				"description" => __("Select the button text letter spacing ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button text capitalization", 'cesis') ,
				"param_name" => "lb_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the button text capitalization.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Border Radius (optional)", 'cesis') ,
				"param_name" => "lb_b_radius",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Select the button border radius ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Add shadow to button?", 'cesis') ,
				"param_name" => "lb_shadow",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "",
					__("Yes", 'cesis') => "cesis_btn_shadow"
				) ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select if you want to use shadow for the button.", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the size of the Load more button", 'cesis') ,
				'param_name' => 'load_more_size',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Small", 'cesis') => "lb_small",
					__("Medium", 'cesis') => "lb_medium",
					__("Large", 'cesis') => "lb_large",
				) ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'load_more'
					)
				) ,
				'description' => __("Select the button size", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the shape of the Load more button", 'cesis') ,
				'param_name' => 'load_more_shape',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Squared", 'cesis') => "",
					__("Rounded", 'cesis') => "cesis_btn_rounded",
				) ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'cesis_btn',
						'cesis_alt_btn',
						'cesis_sub_btn'
					)
				) ,
				'description' => __("Select the button shape", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the position of the Load more button", 'cesis') ,
				'param_name' => 'load_more_pos',
				'value' => array(
					__("Center", 'cesis') => "lb_center",
					__("Left", 'cesis') => "lb_left",
					__("Right", 'cesis') => "lb_right",
					__("Full Width", 'cesis') => "lb_fw",
				) ,
				'dependency' => array(
					'element' => 'iso_nav',
					'value' => array(
						'load_more'
					)
				) ,
				'description' => __("Select the button position", 'cesis')
			) ,

			// Responsive Options

			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for big display / devices?", 'cesis') ,
				"param_name" => "col_big",
				'value' => array(
					"inherit " => "inherit",
					"1 " => "1",
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5"
				) ,
				"std" => "inherit",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of item to show per line for big display / devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for tablet devices?", 'cesis') ,
				"param_name" => "col_tablet",
				'value' => array(
					"1 " => "1",
					"2" => "2",
					"3" => "3"
				) ,
				"std" => "2",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of items to show per line for tablet devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show navigation on tablet devices?", 'cesis') ,
				"param_name" => "nav_tablet",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on tablet devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show pagination on tablet devices?", 'cesis') ,
				"param_name" => "pag_tablet",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use pagination on tablet devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for mobile devices?", 'cesis') ,
				"param_name" => "col_mobile",
				'value' => array(
					"1 " => "1",
					"2" => "2",
					"3" => "3"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of items to show per line for mobile devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show navigation on mobile devices?", 'cesis') ,
				"param_name" => "nav_mobile",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show pagination on mobile devices?", 'cesis') ,
				"param_name" => "pag_mobile",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		) ,
	));
	}

}

// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                            ADD PARTNERS SHORTCODES                        /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

if( cesis_check_ccp_status() == true) {

add_action('vc_before_init', 'cesis_partners_sc');

function cesis_partners_sc()
	{
	$args = array(
		'taxonomy' => 'groups',
		'hide_empty' => '0'
	);
	$variable = get_terms('groups', $args);
	$part_get_terms = array();
	$part_get_terms[] = 'all';
	foreach($variable as $key => $value)
		{
		$part_get_terms[] = array(
			'label' => $value->name,
			'value' => $value->term_id
		);
		}

	vc_map(array(
		"name" => __("Partners / Sponsors", 'cesis') ,
		"base" => "cesis_partners",
		"weight" => "89",
		"icon"		=> get_template_directory_uri() . "/includes/images/partners.svg",
		'category' => __('Content', 'cesis') ,
		'front_enqueue_js' => array(
			get_template_directory_uri() . '/js/cesis_frontend-editor.js'
		) ,
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Partners / Sponsors layout", 'cesis') ,
				"param_name" => "type",
				'value' => array(
					__("Carousel", 'cesis') => "carousel",
					__("Isotope", 'cesis') => "isotope"
				) ,
				"description" => __("Select if you want to show the Logos in a Carousel or Isotope layout.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Partners / Sponsors Style", 'cesis') ,
				"param_name" => "style",
				"value" => array(
					__("Without Separator", 'cesis') => "cesis_partners_1",
					__("With Separator", 'cesis') => "cesis_partners_2",
				) ,
				"description" => __("Select the Partners / Sponsors Style ( design )", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Separator Border Color", 'cesis') ,
				"param_name" => "sep_b_color",
				"value" => '', //Default Red color
				"description" => __("Choose the border color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'style',
					'value' => array(
						'cesis_partners_2'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Partners / Sponsors hover effect", 'cesis') ,
				"param_name" => "hover",
				"value" => array(
					__("None", 'cesis') => "",
					__("Add opacity", 'cesis') => "cesis_partners_opacity",
					__("Colorize ( need to use colored image )", 'cesis') => "cesis_partners_colorize",
				) ,
				"description" => __("Select the image hover effect", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Number of Partners to load", 'cesis') ,
				"param_name" => "to_show",
				"value" => __("5", 'cesis') ,
				"description" => __("Number of posts to load", 'cesis')
			) ,
			array(
				"type" => "dropdown_multi",
				"class" => "",
				"admin_label" => true,
				"heading" => __("Group", 'cesis') ,
				"param_name" => "category",
				"value" => $part_get_terms,
				"description" => __("Choose the group of partners to show (optional)", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order", 'cesis') ,
				"param_name" => "order",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => array(
					"Descending" => "DESC",
					"Ascending" => 'ASC'
				) ,
				"description" => __("Choose the Order ( default Descending )", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order By", 'cesis') ,
				"param_name" => "orderby",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => array(
					"Date" => "date",
					"Order" => "menu_order",
					"Title" => 'title',
					"Random" => 'rand',
					"Author" => 'author',
					"ID" => 'ID',
					"Modified" => 'modified',
				) ,
				"description" => __("Choose by which parameter you want to order the posts ( default date )", 'cesis') ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Number of items per line?", 'cesis') ,
				"param_name" => "col",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					"1" => "1",
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5",
					"6" => "6",
					"7" => "7",
					"8" => "8",
					"9" => "9",
					"10" => "10"
				) ,
				"description" => __("Select the number of logos to show per line.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Number of row?", 'cesis') ,
				"param_name" => "row",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					"1 " => "",
					"2 " => "2",
					"3 " => "3"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of row for the carousel.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Open link in a new page?", 'cesis') ,
				"param_name" => "target",
				'value' => array(
					__("Yes", 'cesis') => "_blank",
					__("No", 'cesis') => "_self",
				) ,
				"description" => __("Select if you want the logo's link to open in a new page.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Infinite loop?", 'cesis') ,
				"param_name" => "loop",
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to duplicate last and first items to get loop illusion.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Center the active item", 'cesis') ,
				"param_name" => "center",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to active item to be in the Center of the carousel container.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Auto Rotate?", 'cesis') ,
				"param_name" => "scroll",
				'value' => array(
					__("No", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want the carousel to rotate automatically.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Rotation speed", 'cesis') ,
				"param_name" => "speed",
				"value" => "800",
				"description" => __("Select the rotation speed in milliseconds ( example 2000 for 2 seconds )", 'cesis') ,
				'dependency' => array(
					'element' => 'scroll',
					'value' => array(
						'yes'
					)
				)
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Show pagination?", 'cesis') ,
				"param_name" => "nav",
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use pagination for the carousel.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots style", 'cesis') ,
				"param_name" => "nav_type",
				'value' => array(
					__("Grey dots", 'cesis') => 'cesis_owl_pag_1',
					__("White with shadow dots", 'cesis') => "cesis_owl_pag_3",
					__("Outline dots", 'cesis') => "cesis_owl_pag_2",
				) ,
				'dependency' => array(
					'element' => 'nav',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the pagination dots design you want to use.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots position", 'cesis') ,
				"param_name" => "nav_pos",
				'value' => array(
					__("Under content", 'cesis') => '',
					__("Over content", 'cesis') => "cesis_owl_pag_over",
				) ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the pagination dots position.", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination color", 'cesis') ,
				"param_name" => "nav_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the pagination color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'nav',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination active color", 'cesis') ,
				"param_name" => "nav_active_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active pagination color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'nav',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Use Load more button?", 'cesis') ,
				"param_name" => "load_more_nav",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope'
					)
				) ,
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				"description" => __("Select if you want to use load more button under the isotope container.", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the color for the Load more button", 'cesis') ,
				'param_name' => 'custom_color',
				'value' => array(
					__("Cesis First button color settings", 'cesis') => "cesis_btn",
					__("Cesis Second button color settings", 'cesis') => "cesis_alt_btn",
					__("Cesis Third button color settings", 'cesis') => "cesis_sub_btn",
					__("Custom colors", 'cesis') => "custom"
				) ,
				'dependency' => array(
					'element' => 'load_more_nav',
					'value' => array(
						'yes'
					)
				) ,
				'description' => __("Select the color scheme you want to use for the button", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button Text Color", 'cesis') ,
				"param_name" => "lb_t_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button text color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button Background Color", 'cesis') ,
				"param_name" => "lb_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button background color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button Border Color", 'cesis') ,
				"param_name" => "lb_b_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button border color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button hover Text Color", 'cesis') ,
				"param_name" => "lb_ht_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover text color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button hover Background Color", 'cesis') ,
				"param_name" => "lb_hbg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button hover Border Color", 'cesis') ,
				"param_name" => "lb_hb_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the button hover border color", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button font family", 'cesis') ,
				"param_name" => "load_more_ff",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Main font", 'cesis') => "main_font",
					__("Alternative font", 'cesis') => "alt_font",
				) ,
				"description" => __("Select the button font family ( from the one set in the theme option ).", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button font size", 'cesis') ,
				"param_name" => "lb_f_size",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "14",
				"description" => __("Select the button font size", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button font weight", 'cesis') ,
				"param_name" => "lb_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the button font weight.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button letter spacing", 'cesis') ,
				"param_name" => "lb_l_spacing",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "",
				"description" => __("Select the button text letter spacing ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Button text capitalization", 'cesis') ,
				"param_name" => "lb_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select the button text capitalization.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Border Radius (optional)", 'cesis') ,
				"param_name" => "lb_b_radius",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Select the button border radius ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Add shadow to button?", 'cesis') ,
				"param_name" => "lb_shadow",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("No", 'cesis') => "",
					__("Yes", 'cesis') => "cesis_btn_shadow"
				) ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'custom'
					)
				) ,
				"description" => __("Select if you want to use shadow for the button.", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the size of the Load more button", 'cesis') ,
				'param_name' => 'load_more_size',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Small", 'cesis') => "lb_small",
					__("Medium", 'cesis') => "lb_medium",
					__("Large", 'cesis') => "lb_large",
				) ,
				'dependency' => array(
					'element' => 'load_more_nav',
					'value' => array(
						'yes'
					)
				) ,
				'description' => __("Select the button size", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the shape of the Load more button", 'cesis') ,
				'param_name' => 'load_more_shape',
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("Squared", 'cesis') => "",
					__("Rounded", 'cesis') => "cesis_btn_rounded",
				) ,
				'dependency' => array(
					'element' => 'custom_color',
					'value' => array(
						'cesis_btn',
						'cesis_alt_btn',
						'cesis_sub_btn'
					)
				) ,
				'description' => __("Select the button shape", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Pagination / Navigation", 'cesis') ,
				'heading' => __("Choose the position of the Load more button", 'cesis') ,
				'param_name' => 'load_more_pos',
				'value' => array(
					__("Center", 'cesis') => "lb_center",
					__("Left", 'cesis') => "lb_left",
					__("Right", 'cesis') => "lb_right",
					__("Full Width", 'cesis') => "lb_fw",
				) ,
				'dependency' => array(
					'element' => 'load_more_nav',
					'value' => array(
						'yes'
					)
				) ,
				'description' => __("Select the button position", 'cesis')
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"param_name" => "margin_top",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Top margin for the module (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"param_name" => "margin_bottom",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Bottom margin for the module (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Extra class name", 'cesis') ,
				"param_name" => "el_class",
				"value" => "",
				"description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for big display / devices?", 'cesis') ,
				"param_name" => "col_big",
				'value' => array(
					"inherit " => "inherit",
					"1 " => "1",
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5"
				) ,
				"std" => "inherit",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of item to show per line for big display / devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for tablet devices?", 'cesis') ,
				"param_name" => "col_tablet",
				'value' => array(
					"1 " => "1",
					"2" => "2",
					"3" => "3"
				) ,
				"std" => "2",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of items to show per line for tablet devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show navigation on tablet devices?", 'cesis') ,
				"param_name" => "nav-tablet",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on tablet devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for mobile devices?", 'cesis') ,
				"param_name" => "col_mobile",
				'value' => array(
					"1 " => "1",
					"2" => "2",
					"3" => "3"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of items to show per line for mobile devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show navigation on mobile devices?", 'cesis') ,
				"param_name" => "nav-mobile",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		) ,
	));
	}
}

// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                          ADD CAREER SHORTCODES                            /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

if( cesis_check_ccp_status() == true) {

add_action('vc_before_init', 'cesis_career_sc');

function cesis_career_sc()
	{
	$args = array(
		'taxonomy' => 'career_category',
		'hide_empty' => '0'
	);
	$variable = get_terms('career_category', $args);
	$career_get_cat = array();
	$career_get_cat[] = array(
		'label' => 'all',
		'value' => 'all',
	);
	foreach($variable as $key => $value)
		{
		$career_get_cat[] = array(
			'label' => $value->name,
			'value' => $value->term_id
		);
		}




	vc_map(array(
		"name" => __("Career Positions", 'cesis') ,
		"base" => "cesis_career",
		"weight" => "88",
		"icon"		=> get_template_directory_uri() . "/includes/images/career.svg",
		'front_enqueue_js' => array(
			get_template_directory_uri() . '/js/cesis_plugins.js'
		) ,
		'category' => __('Content', 'cesis') ,
		"show_settings_on_create" => true,
		"params" => array(
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Career layout", 'cesis') ,
					"param_name" => "type",
					'value' => array(
						__("Isotope Grid", 'cesis') => "isotope_grid",
						__("Carousel", 'cesis') => "carousel",
					) ,
					"description" => __("Select the Career layout.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Career Style", 'cesis') ,
					"param_name" => "style",
					"value" => array(
						__("Standard", 'cesis') => "cesis_career_style_1",
						__("Boxed", 'cesis') => "cesis_career_style_2",
					) ,
					"description" => __("Select the career positions style ( design )", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Hover effect", 'cesis') ,
					"param_name" => "hover",
					'value' => array(
						__("None", 'cesis') => "",
						__("Colored Overlay", 'cesis') => "cesis_hover_overlay",
						__("Zoom and Link icon", 'cesis') => "cesis_hover_icon",
					) ,
					"description" => __("Select the hover effect you want to use.", 'cesis')
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __("Hover Color", 'cesis') ,
					"param_name" => "hover_color",
					"value" => '', //Default Red color
					"description" => __("Choose the hover color ( optional )", 'cesis') ,
					'dependency' => array(
						'element' => 'hover',
						'value' => array(
							'cesis_hover_overlay',
							'cesis_hover_icon'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Additional effect", 'cesis') ,
					"param_name" => "effect",
					'value' => array(
						__("None", 'cesis') => "",
						__("Shadow", 'cesis') => "cesis_effect_shadow",
						__("Image Zoom In", 'cesis') => "cesis_effect_zoomIn",
						__("Image Zoom Out", 'cesis') => "cesis_effect_zoomOut",
						__("Add Color", 'cesis') => "cesis_effect_color",
						__("Remove Color", 'cesis') => "cesis_effect_decolor",
					) ,
					"description" => __("Select the additional effect you want to use.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Font style", 'cesis') ,
					"param_name" => "force_font",
					'value' => array(
						__("Theme Default", 'cesis') => "",
						__("Demo Pre-set", 'cesis') => "force_font",
						__("Custom", 'cesis') => "custom"
					) ,
					"description" => __("Select the career positions font style to use.", 'cesis')
				) ,
				array(
					'type' => 'dropdown',
					"group" => __("Typography", 'cesis') ,
					'heading' => __('Heading font family', 'cesis') ,
					'param_name' => 'heading_font',
					'value' => array(
						__('Main font', 'cesis') => 'main_font',
						__('Alternative font', 'cesis') => 'alt_font',
						__('Custom font', 'cesis') => 'custom',
					) ,
					"std" => "alt_font",
					'description' => __('Select the font to use.', 'cesis') ,
					'dependency' => array(
						'element' => 'force_font',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					'type' => 'google_fonts',
					"group" => __("Typography", 'cesis') ,
					'param_name' => 'h_google_fonts',
					'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
					'settings' => array(
						'fields' => array(
							'font_family_description' => __('Select font family.', 'cesis') ,
							'font_style_description' => __('Select font styling.', 'cesis') ,
						) ,
					) ,
					'dependency' => array(
						'element' => 'heading_font',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"group" => __("Typography", 'cesis') ,
					"heading" => __("Heading font size", 'cesis') ,
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"param_name" => "h_f_size",
					"value" => __("14px", 'cesis') ,
					"description" => __("Select the heading font size, for example 30", 'cesis'),
					'dependency' => array(
						'element' => 'force_font',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"group" => __("Typography", 'cesis') ,
					"class" => "",
					"heading" => __("Heading font weight", 'cesis') ,
					"param_name" => "h_f_weight",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("100 ( thin )", 'cesis') => "100",
						__("300 ( light )", 'cesis') => "300",
						__("400 ( normal )", 'cesis') => "400",
						__("500 ( normal bold )", 'cesis') => "500",
						__("600 ( semi bold )", 'cesis') => "600",
						__("700 ( bold )", 'cesis') => "700",
						__("900 ( extra bold )", 'cesis') => "900",
					) ,
					"std" => "700",
					"description" => __("Select the heading font weight.", 'cesis') ,
					'dependency' => array(
						'element' => 'heading_font',
						'value' => array(
							'main_font',
							'alt_font'
						)
					) ,
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"group" => __("Typography", 'cesis') ,
					"heading" => __("Heading Line height", 'cesis') ,
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"param_name" => "h_l_height",
					"value" => __("24px", 'cesis') ,
					"description" => __("Select the heading line height", 'cesis'),
					'dependency' => array(
						'element' => 'force_font',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Typography", 'cesis') ,
					"heading" => __("Heading capitalization", 'cesis') ,
					"param_name" => "h_t_transform",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("None", 'cesis') => "none",
						__("Uppercase", 'cesis') => "uppercase",
						__("Lowercase", 'cesis') => "lowercase",
					) ,
					"std" => "uppercase",
					"description" => __("Select text capitalization.", 'cesis') ,
					'dependency' => array(
						'element' => 'force_font',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"group" => __("Typography", 'cesis') ,
					"heading" => __("Heading Letter Spacing", 'cesis') ,
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"param_name" => "h_l_spacing",
					"value" => __("0", 'cesis') ,
					"description" => __("Select the heading font letter spacing ( 0 is the default space )", 'cesis'),
					'dependency' => array(
						'element' => 'force_font',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					'type' => 'dropdown',
					"group" => __("Typography", 'cesis') ,
					'heading' => __('Text font family', 'cesis') ,
					'param_name' => 'text_font',
					'value' => array(
						__('Main font', 'cesis') => 'main_font',
						__('Alternative font', 'cesis') => 'alt_font',
						__('Custom font', 'cesis') => 'custom',
					) ,
					'description' => __('Select the font to use.', 'cesis') ,
					'dependency' => array(
						'element' => 'force_font',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					'type' => 'google_fonts',
					"group" => __("Typography", 'cesis') ,
					'param_name' => 'google_fonts',
					'value' => 'font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:300%20light%20regular%3A300%3Anormal',
					'settings' => array(
						'fields' => array(
							'font_family_description' => __('Select font family.', 'cesis') ,
							'font_style_description' => __('Select font styling.', 'cesis') ,
						) ,
					) ,
					'dependency' => array(
						'element' => 'text_font',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"group" => __("Typography", 'cesis') ,
					"heading" => __("Text font size", 'cesis') ,
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"param_name" => "t_f_size",
					"value" => __("14px", 'cesis') ,
					"description" => __("Select the heading font size, for example 14", 'cesis'),
					'dependency' => array(
						'element' => 'force_font',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"group" => __("Typography", 'cesis') ,
					"class" => "",
					"heading" => __("Text font weight", 'cesis') ,
					"param_name" => "t_f_weight",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("100 ( thin )", 'cesis') => "100",
						__("300 ( light )", 'cesis') => "300",
						__("400 ( normal )", 'cesis') => "400",
						__("500 ( normal bold )", 'cesis') => "500",
						__("600 ( semi bold )", 'cesis') => "600",
						__("700 ( bold )", 'cesis') => "700",
						__("900 ( extra bold )", 'cesis') => "900",
					) ,
					"std" => "400",
					"description" => __("Select the text font weight.", 'cesis') ,
					'dependency' => array(
						'element' => 'text_font',
						'value' => array(
							'main_font',
							'alt_font'
						)
					) ,
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"group" => __("Typography", 'cesis') ,
					"heading" => __("Text Line height", 'cesis') ,
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"param_name" => "t_l_height",
					"value" => __("24px", 'cesis') ,
					"description" => __("Select the text line height", 'cesis'),
					'dependency' => array(
						'element' => 'force_font',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Typography", 'cesis') ,
					"heading" => __("Text capitalization", 'cesis') ,
					"param_name" => "t_t_transform",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("None", 'cesis') => "none",
						__("Uppercase", 'cesis') => "uppercase",
						__("Lowercase", 'cesis') => "lowercase",
					) ,
					"description" => __("Select text capitalization.", 'cesis') ,
					'dependency' => array(
						'element' => 'force_font',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"group" => __("Typography", 'cesis') ,
					"heading" => __("Text Letter Spacing", 'cesis') ,
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"param_name" => "t_l_spacing",
					"value" => __("0", 'cesis') ,
					"description" => __("Select the text letter spacing ( 0 is the default space )", 'cesis'),
					'dependency' => array(
						'element' => 'force_font',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Thumbnail size", 'cesis') ,
					"param_name" => "thumbnail_size",
					"value" => array(
						__("1:1 ( squared )", 'cesis') => "tn_squared",
						__("4:3  ( rectangle )", 'cesis') => "tn_rectangle_4_3",
						__("3:2  ( rectangle )", 'cesis') => "tn_rectangle_3_2",
						__("16:9 ( landscape )", 'cesis') => "tn_landscape_16_9",
						__("21:9 ( landscape )", 'cesis') => "tn_landscape_21_9",
						__("3:4 ( portrait )", 'cesis') => "tn_portrait_3_4",
						__("2:3 ( portrait )", 'cesis') => "tn_portrait_2_3",
						__("9:16 ( portrait )", 'cesis') => "tn_portrait_9_16",
						__("No thumbnail", 'cesis') => "no_thumb",
					) ,
					"description" => __("Select the posts thumbnail size", 'cesis')
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Number of Posts to load", 'cesis') ,
					"param_name" => "to_show",
					"value" => __("5", 'cesis') ,
					"description" => __("Number of posts to load", 'cesis')
				) ,
				array(
					"type" => "dropdown_multi",
					"class" => "",
					"admin_label" => true,
					"heading" => __("Category", 'cesis') ,
					"param_name" => "category",
					"value" => $career_get_cat,
					"description" => __("Choose the category to filter the career positions posts to show (optional)", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Order", 'cesis') ,
					"param_name" => "order",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => array(
						"Descending" => "DESC",
						"Ascending" => 'ASC'
					) ,
					"description" => __("Choose the Order ( default Descending )", 'cesis') ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Order By", 'cesis') ,
					"param_name" => "orderby",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => array(
						"Date" => "date",
						"Order" => "menu_order",
						"Title" => 'title',
						"Random" => 'rand',
						"Author" => 'author',
						"ID" => 'ID',
						"Modified" => 'modified',
					) ,
					"description" => __("Choose by which parameter you want to order the posts ( default date )", 'cesis') ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Number of items per line?", 'cesis') ,
					"param_name" => "col",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						"1" => "1",
						"2" => "2",
						"3" => "3",
						"4" => "4",
						"5" => "5",
						"6" => "6",
						"7" => "7",
						"8" => "8"
					) ,
					"description" => __("Select the number of logos to show per line.", 'cesis')
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Choose the space between the items", 'cesis') ,
					"param_name" => "padding",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => "30",
					"description" => __("Select the space between the items, default 30.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Show location?", 'cesis') ,
					"param_name" => "i_location",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("No", 'cesis') => "no",
						__("Yes", 'cesis') => "yes",
					) ,
					'std' => 'yes',
					"description" => __("Select if you want to show the location.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Show categories?", 'cesis') ,
					"param_name" => "i_category",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("No", 'cesis') => "no",
						__("Yes", 'cesis') => "yes",
					) ,
					'std' => 'no',
					"description" => __("Select if you want to show the categories.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Show date?", 'cesis') ,
					"param_name" => "i_date",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("No", 'cesis') => "no",
						__("Yes", 'cesis') => "yes",
					) ,
					'std' => 'yes',
					"description" => __("Select if you want to show the date.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Show text?", 'cesis') ,
					"param_name" => "i_text",
					'value' => array(
						__("No", 'cesis') => "no",
						__("Yes", 'cesis') => "yes",
					) ,
					'std' => 'yes',
					"description" => __("Select if you want to show the career position description.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Select text source?", 'cesis') ,
					"param_name" => "text_source",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("Description", 'cesis') => "description",
						__("Content", 'cesis') => "content",
					) ,
					"description" => __("Select the text source.", 'cesis') ,
					'dependency' => array(
						'element' => 'i_text',
						'value' => array(
							'yes'
						)
					) ,
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Number of Characters to show", 'cesis') ,
					"param_name" => "char_length",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => "125",
					"description" => __("Select the number of charachters to show ( leave blank to show full post content )", 'cesis') ,
					'dependency' => array(
						'element' => 'i_text',
						'value' => array(
							'yes'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Show read more link?", 'cesis') ,
					"param_name" => "read_more",
					'value' => array(
						__("No", 'cesis') => "no",
						__("Yes", 'cesis') => "yes",
					) ,
					'std' => 'yes',
					"description" => __("Select if you want to show the read more link.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Read more link style", 'cesis') ,
					"param_name" => "read_more_style",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("Text only", 'cesis') => "text",
						__("Button", 'cesis') => "button_rm",
					) ,
					"description" => __("Select if you want to show the read more link.", 'cesis') ,
					'dependency' => array(
						'element' => 'read_more',
						'value' => array(
							'yes'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Read more text font family", 'cesis') ,
					"param_name" => "rm_t_font",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("Main font", 'cesis') => "main_font",
						__("Alternative font", 'cesis') => "alt_font",
					) ,
					"description" => __("Select the read more font family ( from the one set in the theme option ).", 'cesis') ,
					'dependency' => array(
						'element' => 'read_more_style',
						'value' => array(
							'text'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Read more text font weight", 'cesis') ,
					"param_name" => "rm_t_f_weight",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("100 ( thin )", 'cesis') => "100",
						__("300 ( light )", 'cesis') => "300",
						__("400 ( normal )", 'cesis') => "400",
						__("500 ( normal bold )", 'cesis') => "500",
						__("600 ( semi bold )", 'cesis') => "600",
						__("700 ( bold )", 'cesis') => "700",
						__("900 ( extra bold )", 'cesis') => "900",
					) ,
					"std" => "400",
					"description" => __("Select the read more text font weight.", 'cesis') ,
					'dependency' => array(
						'element' => 'read_more_style',
						'value' => array(
							'text'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Read more text capitalization", 'cesis') ,
					"param_name" => "rm_t_t_transform",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("None", 'cesis') => "",
						__("Uppercase", 'cesis') => "uppercase",
						__("Lowercase", 'cesis') => "lowercase",
					) ,
					"description" => __("Select the read more text capitalization.", 'cesis') ,
					'dependency' => array(
						'element' => 'read_more_style',
						'value' => array(
							'text'
						)
					) ,
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Read more text letter spacing", 'cesis') ,
					"param_name" => "rm_t_l_spacing",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => "0",
					"description" => __("Select the read more text letter spacing ( optional ) eg : 1", 'cesis') ,
					'dependency' => array(
						'element' => 'read_more_style',
						'value' => array(
							'text'
						)
					) ,
				) ,
				array(
					'type' => 'dropdown',
					'heading' => __("Read more button style", 'cesis') ,
					'param_name' => 'read_more_button_style',
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("Cesis First button color settings", 'cesis') => "cesis_btn",
						__("Cesis Second button color settings", 'cesis') => "cesis_alt_btn",
						__("Cesis Third button color settings", 'cesis') => "cesis_sub_btn",
						__("Custom colors ( set it from Colors tabs )", 'cesis') => "custom"
					) ,
					'dependency' => array(
						'element' => 'read_more_style',
						'value' => array(
							'button_rm'
						)
					) ,
					'description' => __("Select the color scheme you want to use for the read more button", 'cesis')
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __("Button Text Color", 'cesis') ,
					"param_name" => "rm_t_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the button text color", 'cesis') ,
					'dependency' => array(
						'element' => 'read_more_button_style',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __("Button Background Color", 'cesis') ,
					"param_name" => "rm_bg_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the button background color", 'cesis') ,
					'dependency' => array(
						'element' => 'read_more_button_style',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __("Button Border Color", 'cesis') ,
					"param_name" => "rm_b_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the button border color", 'cesis') ,
					'dependency' => array(
						'element' => 'read_more_button_style',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __("Button hover Text Color", 'cesis') ,
					"param_name" => "rm_ht_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the button hover text color", 'cesis') ,
					'dependency' => array(
						'element' => 'read_more_button_style',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __("Button hover Background Color", 'cesis') ,
					"param_name" => "rm_hbg_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the button hover background color", 'cesis') ,
					'dependency' => array(
						'element' => 'read_more_button_style',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"heading" => __("Button hover Border Color", 'cesis') ,
					"param_name" => "rm_hb_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the button hover border color", 'cesis') ,
					'dependency' => array(
						'element' => 'read_more_button_style',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Button font family", 'cesis') ,
					"param_name" => "rm_font",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("Main font", 'cesis') => "main_font",
						__("Alternative font", 'cesis') => "alt_font",
					) ,
					"description" => __("Select the read more font family ( from the one set in the theme option ).", 'cesis') ,
					'dependency' => array(
						'element' => 'read_more_button_style',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Button font size", 'cesis') ,
					"param_name" => "rm_f_size",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => "14",
					"description" => __("Select the button font size", 'cesis') ,
					'dependency' => array(
						'element' => 'read_more_button_style',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Button font weight", 'cesis') ,
					"param_name" => "rm_f_weight",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("100 ( thin )", 'cesis') => "100",
						__("300 ( light )", 'cesis') => "300",
						__("400 ( normal )", 'cesis') => "400",
						__("500 ( normal bold )", 'cesis') => "500",
						__("600 ( semi bold )", 'cesis') => "600",
						__("700 ( bold )", 'cesis') => "700",
						__("900 ( extra bold )", 'cesis') => "900",
					) ,
					"std" => "400",
					'dependency' => array(
						'element' => 'read_more_button_style',
						'value' => array(
							'custom'
						)
					) ,
					"description" => __("Select the button font weight.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Button text capitalization", 'cesis') ,
					"param_name" => "rm_t_transform",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("None", 'cesis') => "none",
						__("Uppercase", 'cesis') => "uppercase",
						__("Lowercase", 'cesis') => "lowercase",
					) ,
					"std" => "uppercase",
					'dependency' => array(
						'element' => 'read_more_button_style',
						'value' => array(
							'custom'
						)
					) ,
					"description" => __("Select the button text capitalization.", 'cesis')
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Button letter spacing", 'cesis') ,
					"param_name" => "rm_l_spacing",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => "",
					"description" => __("Select the button text letter spacing ( optional ) eg : 1", 'cesis') ,
					'dependency' => array(
						'element' => 'read_more_button_style',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					'type' => 'dropdown',
					'heading' => __("Read more button size", 'cesis') ,
					'param_name' => 'rm_b_size',
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("Small", 'cesis') => "read_more_small",
						__("Medium", 'cesis') => "read_more_medium",
						__("Large", 'cesis') => "read_more_large",
					) ,
					'dependency' => array(
						'element' => 'read_more_style',
						'value' => array(
							'button_rm'
						)
					) ,
					'description' => __("Select the read more button size", 'cesis')
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Border Radius (optional)", 'cesis') ,
					"param_name" => "rm_b_radius",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => "0",
					"description" => __("Select the button border radius ( optional ) eg : 10", 'cesis') ,
					'dependency' => array(
						'element' => 'read_more_button_style',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					'type' => 'dropdown',
					'heading' => __("Read more button shape", 'cesis') ,
					'param_name' => 'rm_b_shape',
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("Squared", 'cesis') => "",
						__("Rounded", 'cesis') => "cesis_btn_rounded",
					) ,
					'dependency' => array(
						'element' => 'read_more_button_style',
						'value' => array(
							'cesis_btn',
							'cesis_alt_btn',
							'cesis_sub_btn'
						)
					) ,
					'description' => __("Select the button shape", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Open link in a new page?", 'cesis') ,
					"param_name" => "target",
					'value' => array(
						__("No", 'cesis') => "_self",
						__("Yes", 'cesis') => "_blank",
					) ,
					"description" => __("Select if you want the posts link to open in a new page.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Infinite loop?", 'cesis') ,
					"param_name" => "loop",
					'value' => array(
						__("Yes", 'cesis') => "yes",
						__("No", 'cesis') => "no"
					) ,
					'dependency' => array(
						'element' => 'type',
						'value' => array(
							'carousel'
						)
					) ,
					"description" => __("Select if you want to duplicate last and first items to get loop illusion.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Center the active item", 'cesis') ,
					"param_name" => "center",
					'value' => array(
						__("No", 'cesis') => "no",
						__("Yes", 'cesis') => "yes"
					) ,
					'dependency' => array(
						'element' => 'type',
						'value' => array(
							'carousel'
						)
					) ,
					"description" => __("Select if you want to active item to be in the Center of the carousel container.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Auto Rotate?", 'cesis') ,
					"param_name" => "scroll",
					'value' => array(
						__("No", 'cesis') => "",
						__("Yes", 'cesis') => "yes",
					) ,
					'dependency' => array(
						'element' => 'type',
						'value' => array(
							'carousel'
						)
					) ,
					"description" => __("Select if you want the carousel to rotate automatically.", 'cesis')
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Rotation speed", 'cesis') ,
					"param_name" => "speed",
					"value" => "800",
					"description" => __("Select the rotation speed in milliseconds ( example 2000 for 2 seconds )", 'cesis') ,
					'dependency' => array(
						'element' => 'scroll',
						'value' => array(
							'yes'
						)
					)
				) ,
				vc_map_add_css_animation() ,
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Module Top Space", 'cesis') ,
					"param_name" => "margin_top",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => "0",
					"description" => __("Top margin for the Module container (e.g 20 )", 'cesis')
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Module Bottom Space", 'cesis') ,
					"param_name" => "margin_bottom",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => "0",
					"description" => __("Bottom margin for the Module container (e.g 20 )", 'cesis')
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Extra class name", 'cesis') ,
					"param_name" => "el_class",
					"value" => "",
					"description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", 'cesis')
				) ,

				// Colors

				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Colors", 'cesis') ,
					"heading" => __("Career module background Color", 'cesis') ,
					"param_name" => "m_mbg_color",
					"value" => '', //Default Red color
					"description" => __("Portfolio module background color ( optional )", 'cesis') ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Colors", 'cesis') ,
					"heading" => __("Heading Color", 'cesis') ,
					"param_name" => "m_h_color",
					"value" => '', //Default Red color
					"description" => __("Heading text color ( optional )", 'cesis') ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Colors", 'cesis') ,
					"heading" => __("Text Color", 'cesis') ,
					"param_name" => "m_t_color",
					"value" => '', //Default Red color
					"description" => __("Text color ( optional )", 'cesis') ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Colors", 'cesis') ,
					"heading" => __("Light Text Color", 'cesis') ,
					"param_name" => "m_lt_color",
					"value" => '', //Default Red color
					"description" => __("Light Text color ( optional )", 'cesis') ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Colors", 'cesis') ,
					"heading" => __("Accent Color", 'cesis') ,
					"param_name" => "m_a_color",
					"value" => '', //Default Red color
					"description" => __("Accent color ( optional )", 'cesis') ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Colors", 'cesis') ,
					"heading" => __("Border Color", 'cesis') ,
					"param_name" => "m_b_color",
					"value" => '', //Default Red color
					"description" => __("Border color ( optional )", 'cesis') ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Colors", 'cesis') ,
					"heading" => __("Background Color", 'cesis') ,
					"param_name" => "m_bg_color",
					"value" => '', //Default Red color
					"description" => __("Background color ( optional & available for box type )", 'cesis') ,
				) ,

				// Filter Options

				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Use a filter?", 'cesis') ,
					"param_name" => "filter",
					'value' => array(
						__("No", 'cesis') => "no",
						__("Yes", 'cesis') => "yes"
					) ,
					'dependency' => array(
						'element' => 'type',
						'value' => array(
							'isotope_grid',
						)
					) ,
					"description" => __("Select if you want to use a filter for the Career positions.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Isotope or Ajax filter", 'cesis') ,
					"param_name" => "filter_type",
					'value' => array(
						__("Isotope", 'cesis') => "isotope_filter",
						__("Ajax", 'cesis') => "ajax_filter"
					) ,
					'dependency' => array(
						'element' => 'filter',
						'value' => array(
							'yes'
						)
					) ,
					"description" => __("Isotope filter will filter the posts currently loaded, Ajax filter will re-load post to match selected filter.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Filter style", 'cesis') ,
					"param_name" => "filter_style",
					'value' => array(
						__("Text only", 'cesis') => "cesis_filter_style_1",
						__("Top border", 'cesis') => "cesis_filter_style_2",
						__("Bottom border", 'cesis') => "cesis_filter_style_3",
						__("Squared", 'cesis') => "cesis_filter_style_4",
						__("Rounded", 'cesis') => "cesis_filter_style_5",
						__("Small Rounded", 'cesis') => "cesis_filter_style_6",
						__("Rounded Square", 'cesis') => "cesis_filter_style_7",
					) ,
					'dependency' => array(
						'element' => 'filter',
						'value' => array(
							'yes'
						)
					) ,
					"description" => __("Choose filter style ( design ).", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Filter position", 'cesis') ,
					"param_name" => "filter_pos",
					'value' => array(
						__("Left", 'cesis') => "left",
						__("Center", 'cesis') => "center",
						__("Right", 'cesis') => "right",
					) ,
					'dependency' => array(
						'element' => 'filter',
						'value' => array(
							'yes'
						)
					) ,
					"description" => __("Choose filter position.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Use Sorter ?", 'cesis') ,
					"param_name" => "sorter",
					'value' => array(
						__("No", 'cesis') => "no",
						__("Yes", 'cesis') => "cesis_sorter",
					) ,
					'dependency' => array(
						'element' => 'filter',
						'value' => array(
							'yes'
						)
					) ,
					"description" => __("Add a sorter to the filter? ( let the user re-sort the item by name, date etc ).", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Sorter position", 'cesis') ,
					"param_name" => "sorter_pos",
					'value' => array(
						__("Same as filter", 'cesis') => "same",
						__("Opposite to filter", 'cesis') => "opposite",
					) ,
					'dependency' => array(
						'element' => 'sorter',
						'value' => array(
							'cesis_sorter'
						)
					) ,
					"description" => __("Select the sorter position.", 'cesis')
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Space between each Filter", 'cesis') ,
					"param_name" => "filter_space",
					"value" => "30",
					"description" => __("Select the space between each filter", 'cesis') ,
					'dependency' => array(
						'element' => 'filter',
						'value' => array(
							'yes'
						)
					) ,
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Filter bottom space", 'cesis') ,
					"param_name" => "filter_b_margin",
					"value" => "0",
					"description" => __("Select the space between the filter and the portfolio", 'cesis') ,
					'dependency' => array(
						'element' => 'filter',
						'value' => array(
							'yes'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Filter font family", 'cesis') ,
					"param_name" => "filter_font",
					'value' => array(
						__("Alternative font", 'cesis') => "alt_font",
						__("Main font", 'cesis') => "main_font",
					) ,
					"description" => __("Select the filter font family ( from the one set in the theme option ).", 'cesis') ,
					'dependency' => array(
						'element' => 'filter',
						'value' => array(
							'yes'
						)
					) ,
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Filter font size", 'cesis') ,
					"param_name" => "filter_f_size",
					"value" => "14",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"description" => __("Select the filter font size", 'cesis') ,
					'dependency' => array(
						'element' => 'filter',
						'value' => array(
							'yes'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Filter font weight", 'cesis') ,
					"param_name" => "filter_f_weight",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("100 ( thin )", 'cesis') => "100",
						__("300 ( light )", 'cesis') => "300",
						__("400 ( normal )", 'cesis') => "400",
						__("500 ( normal bold )", 'cesis') => "500",
						__("600 ( semi bold )", 'cesis') => "600",
						__("700 ( bold )", 'cesis') => "700",
						__("900 ( extra bold )", 'cesis') => "900",
					) ,
					"std" => "700",
					'dependency' => array(
						'element' => 'filter',
						'value' => array(
							'yes'
						)
					) ,
					"description" => __("Select the filter font weight.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Filter capitalization", 'cesis') ,
					"param_name" => "filter_t_transform",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("None", 'cesis') => "none",
						__("Uppercase", 'cesis') => "uppercase",
						__("Lowercase", 'cesis') => "lowercase",
					) ,
					"std" => "uppercase",
					'dependency' => array(
						'element' => 'filter',
						'value' => array(
							'yes'
						)
					) ,
					"description" => __("Select the filter text capitalization.", 'cesis')
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Filter letter spacing", 'cesis') ,
					"param_name" => "filter_l_spacing",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => "",
					"description" => __("Select the filter text letter spacing ( optional ) eg : 1", 'cesis') ,
					'dependency' => array(
						'element' => 'filter',
						'value' => array(
							'yes'
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Filter color", 'cesis') ,
					"param_name" => "filter_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the filter text color (optional)", 'cesis') ,
					'dependency' => array(
						'element' => 'filter_style',
						'value' => array(
							'cesis_filter_style_1',
							'cesis_filter_style_2',
							'cesis_filter_style_3',
							'cesis_filter_style_4',
							'cesis_filter_style_5',
							'cesis_filter_style_6',
							'cesis_filter_style_7',
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Filter border color", 'cesis') ,
					"param_name" => "filter_b_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the filter border color (optional)", 'cesis') ,
					'dependency' => array(
						'element' => 'filter_style',
						'value' => array(
							'cesis_filter_style_1',
							'cesis_filter_style_2',
							'cesis_filter_style_3',
							'cesis_filter_style_4',
							'cesis_filter_style_5',
							'cesis_filter_style_6',
							'cesis_filter_style_7',
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Filter background color", 'cesis') ,
					"param_name" => "filter_bg_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the filter background color (optional)", 'cesis') ,
					'dependency' => array(
						'element' => 'filter_style',
						'value' => array(
							'cesis_filter_style_1',
							'cesis_filter_style_2',
							'cesis_filter_style_3',
							'cesis_filter_style_4',
							'cesis_filter_style_5',
							'cesis_filter_style_6',
							'cesis_filter_style_7',
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Active Filter color", 'cesis') ,
					"param_name" => "filter_a_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the active filter text color (optional)", 'cesis') ,
					'dependency' => array(
						'element' => 'filter_style',
						'value' => array(
							'cesis_filter_style_1',
							'cesis_filter_style_2',
							'cesis_filter_style_3',
							'cesis_filter_style_4',
							'cesis_filter_style_5',
							'cesis_filter_style_6',
							'cesis_filter_style_7',
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Active Filter border color", 'cesis') ,
					"param_name" => "filter_a_b_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the active filter border color (optional)", 'cesis') ,
					'dependency' => array(
						'element' => 'filter_style',
						'value' => array(
							'cesis_filter_style_2',
							'cesis_filter_style_3',
							'cesis_filter_style_4',
							'cesis_filter_style_5',
							'cesis_filter_style_6',
							'cesis_filter_style_7',
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Active Filter background color", 'cesis') ,
					"param_name" => "filter_a_bg_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the active filter background color (optional)", 'cesis') ,
					'dependency' => array(
						'element' => 'filter_style',
						'value' => array(
							'cesis_filter_style_4',
							'cesis_filter_style_5',
							'cesis_filter_style_6',
							'cesis_filter_style_7',
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Filter", 'cesis') ,
					"heading" => __("Filter Hover color", 'cesis') ,
					"param_name" => "filter_h_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the filter hover color (optional)", 'cesis') ,
					'dependency' => array(
						'element' => 'filter_style',
						'value' => array(
							'cesis_filter_style_1',
							'cesis_filter_style_2',
							'cesis_filter_style_3',
							'cesis_filter_style_4',
							'cesis_filter_style_5',
							'cesis_filter_style_6',
							'cesis_filter_style_7',
						)
					) ,
				) ,

				// Pagination Options

				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Show navigation?", 'cesis') ,
					"param_name" => "nav",
					'value' => array(
						__("No", 'cesis') => "no",
						__("Yes", 'cesis') => "yes"
					) ,
					'dependency' => array(
						'element' => 'type',
						'value' => array(
							'carousel'
						)
					) ,
					"description" => __("Select if you want to use navigation for the carousel.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Show pagination ( dots )?", 'cesis') ,
					"param_name" => "pag",
					'value' => array(
						__("No", 'cesis') => "no",
						__("Yes", 'cesis') => "yes"
					) ,
					'dependency' => array(
						'element' => 'type',
						'value' => array(
							'carousel'
						)
					) ,
					"description" => __("Select if you want to use pagination for the carousel.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Pagination dots style", 'cesis') ,
					"param_name" => "pag_type",
					'value' => array(
						__("Grey dots", 'cesis') => 'cesis_owl_pag_1',
						__("White with shadow dots", 'cesis') => "cesis_owl_pag_3",
						__("Outline dots", 'cesis') => "cesis_owl_pag_2",
					) ,
					'dependency' => array(
						'element' => 'pag',
						'value' => array(
							'yes'
						)
					) ,
					"description" => __("Select the pagination dots design you want to use.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Pagination dots position", 'cesis') ,
					"param_name" => "pag_pos",
					'value' => array(
						__("Under content", 'cesis') => '',
						__("Over content", 'cesis') => "cesis_owl_pag_over",
					) ,
					'dependency' => array(
						'element' => 'pag',
						'value' => array(
							'yes'
						)
					) ,
					"description" => __("Select the pagination dots position.", 'cesis')
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Pagination color", 'cesis') ,
					"param_name" => "pag_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the navigation color (optional)", 'cesis') ,
					'dependency' => array(
						'element' => 'pag',
						'value' => array(
							'yes'
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Pagination active color", 'cesis') ,
					"param_name" => "pag_active_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the active pagination color (optional)", 'cesis') ,
					'dependency' => array(
						'element' => 'pag',
						'value' => array(
							'yes'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Choose the navigation type", 'cesis') ,
					"param_name" => "iso_nav",
					'dependency' => array(
						'element' => 'type',
						'value' => array(
							'isotope_grid',
						)
					) ,
					'value' => array(
						__("None", 'cesis') => "none",
						__("Classic navigation", 'cesis') => "classic_nav",
						__("Load more button", 'cesis') => "load_more",
						__("Infinite Scroll", 'cesis') => "infinite_scroll"
					) ,
					"description" => __("Select the Portfolio navigation type.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Choose the navigation position", 'cesis') ,
					"param_name" => "nav_pos",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("Justify", 'cesis') => "cesis_nav_justify",
						__("Left", 'cesis') => "cesis_nav_left",
						__("Center", 'cesis') => "cesis_nav_center",
						__("Right", 'cesis') => "cesis_nav_right"
					) ,
					"description" => __("Choose navigation position", 'cesis') ,
					'dependency' => array(
						'element' => 'iso_nav',
						'value' => array(
							'classic_nav'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Choose the navigation style", 'cesis') ,
					"param_name" => "nav_style",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("Small rounded square", 'cesis') => "cesis_nav_style_0",
						__("Small squared", 'cesis') => "cesis_nav_style_1",
						__("Big squared", 'cesis') => "cesis_nav_style_2",
						__("Rounded", 'cesis') => "cesis_nav_style_3",
						__("Text only", 'cesis') => "cesis_nav_style_4",
					) ,
					"description" => __("Choose navigation position", 'cesis') ,
					'dependency' => array(
						'element' => 'iso_nav',
						'value' => array(
							'classic_nav'
						)
					) ,
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Navigation top space", 'cesis') ,
					"param_name" => "nav_top_space",
					"value" => "50",
					"description" => __("Select the space between the content and navigation", 'cesis') ,
					'dependency' => array(
						'element' => 'iso_nav',
						'value' => array(
							'classic_nav',
							'load_more'
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Navigation Color", 'cesis') ,
					"param_name" => "classic_nav_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the Navigation text color", 'cesis') ,
					'dependency' => array(
						'element' => 'nav_style',
						'value' => array(
							'cesis_nav_style_0',
							'cesis_nav_style_1',
							'cesis_nav_style_2',
							'cesis_nav_style_3',
							'cesis_nav_style_4'
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Navigation border Color", 'cesis') ,
					"param_name" => "classic_nav_b_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the Navigation bo color", 'cesis') ,
					'dependency' => array(
						'element' => 'nav_style',
						'value' => array(
							'cesis_nav_style_0',
							'cesis_nav_style_1',
							'cesis_nav_style_2',
							'cesis_nav_style_3',
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Navigation background Color", 'cesis') ,
					"param_name" => "classic_nav_bg_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the Navigation background color", 'cesis') ,
					'dependency' => array(
						'element' => 'nav_style',
						'value' => array(
							'cesis_nav_style_0',
							'cesis_nav_style_1',
							'cesis_nav_style_2',
							'cesis_nav_style_3',
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Current Navigation text Color", 'cesis') ,
					"param_name" => "classic_nav_a_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the Current Navigation text color", 'cesis') ,
					'dependency' => array(
						'element' => 'nav_style',
						'value' => array(
							'cesis_nav_style_0',
							'cesis_nav_style_1',
							'cesis_nav_style_2',
							'cesis_nav_style_3',
							'cesis_nav_style_4',
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Current Navigation border Color", 'cesis') ,
					"param_name" => "classic_nav_a_b_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the Current Navigation border color", 'cesis') ,
					'dependency' => array(
						'element' => 'nav_style',
						'value' => array(
							'cesis_nav_style_0',
							'cesis_nav_style_1',
							'cesis_nav_style_2',
							'cesis_nav_style_3',
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Current Navigation background Color", 'cesis') ,
					"param_name" => "classic_nav_a_bg_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the Current Navigation background color", 'cesis') ,
					'dependency' => array(
						'element' => 'nav_style',
						'value' => array(
							'cesis_nav_style_0',
							'cesis_nav_style_1',
							'cesis_nav_style_2',
							'cesis_nav_style_3',
						)
					) ,
				) ,
				array(
					'type' => 'dropdown',
					"group" => __("Pagination / Navigation", 'cesis') ,
					'heading' => __("Choose the color for the Load more button", 'cesis') ,
					'param_name' => 'custom_color',
					'value' => array(
						__("Cesis First button color settings", 'cesis') => "cesis_btn",
						__("Cesis Second button color settings", 'cesis') => "cesis_alt_btn",
						__("Cesis Third button color settings", 'cesis') => "cesis_sub_btn",
						__("Custom colors", 'cesis') => "custom"
					) ,
					'dependency' => array(
						'element' => 'iso_nav',
						'value' => array(
							'load_more'
						)
					) ,
					'description' => __("Select the color scheme you want to use for the button", 'cesis')
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Button Text Color", 'cesis') ,
					"param_name" => "lb_t_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the button text color", 'cesis') ,
					'dependency' => array(
						'element' => 'custom_color',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Button Background Color", 'cesis') ,
					"param_name" => "lb_bg_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the button background color", 'cesis') ,
					'dependency' => array(
						'element' => 'custom_color',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Button Border Color", 'cesis') ,
					"param_name" => "lb_b_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the button border color", 'cesis') ,
					'dependency' => array(
						'element' => 'custom_color',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Button hover Text Color", 'cesis') ,
					"param_name" => "lb_ht_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the button hover text color", 'cesis') ,
					'dependency' => array(
						'element' => 'custom_color',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Button hover Background Color", 'cesis') ,
					"param_name" => "lb_hbg_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the button hover background color", 'cesis') ,
					'dependency' => array(
						'element' => 'custom_color',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "colorpicker",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Button hover Border Color", 'cesis') ,
					"param_name" => "lb_hb_color",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => '', //Default Red color
					"description" => __("Choose the button hover border color", 'cesis') ,
					'dependency' => array(
						'element' => 'custom_color',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Button font size", 'cesis') ,
					"param_name" => "lb_f_size",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => "14",
					"description" => __("Select the button font size", 'cesis') ,
					'dependency' => array(
						'element' => 'custom_color',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Button font weight", 'cesis') ,
					"param_name" => "lb_f_weight",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("100 ( thin )", 'cesis') => "100",
						__("300 ( light )", 'cesis') => "300",
						__("400 ( normal )", 'cesis') => "400",
						__("500 ( normal bold )", 'cesis') => "500",
						__("600 ( semi bold )", 'cesis') => "600",
						__("700 ( bold )", 'cesis') => "700",
						__("900 ( extra bold )", 'cesis') => "900",
					) ,
					"std" => "400",
					'dependency' => array(
						'element' => 'custom_color',
						'value' => array(
							'custom'
						)
					) ,
					"description" => __("Select the button font weight.", 'cesis')
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Button letter spacing", 'cesis') ,
					"param_name" => "lb_l_spacing",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => "",
					"description" => __("Select the button text letter spacing ( optional )", 'cesis') ,
					'dependency' => array(
						'element' => 'custom_color',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Button text capitalization", 'cesis') ,
					"param_name" => "lb_t_transform",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("None", 'cesis') => "none",
						__("Uppercase", 'cesis') => "uppercase",
						__("Lowercase", 'cesis') => "lowercase",
					) ,
					"std" => "uppercase",
					'dependency' => array(
						'element' => 'custom_color',
						'value' => array(
							'custom'
						)
					) ,
					"description" => __("Select the button text capitalization.", 'cesis')
				) ,
				array(
					"type" => "textfield",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Border Radius (optional)", 'cesis') ,
					"param_name" => "lb_b_radius",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					"value" => "0",
					"description" => __("Select the button border radius ( optional )", 'cesis') ,
					'dependency' => array(
						'element' => 'custom_color',
						'value' => array(
							'custom'
						)
					) ,
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Pagination / Navigation", 'cesis') ,
					"heading" => __("Add shadow to button?", 'cesis') ,
					"param_name" => "lb_shadow",
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("No", 'cesis') => "",
						__("Yes", 'cesis') => "cesis_btn_shadow"
					) ,
					'dependency' => array(
						'element' => 'custom_color',
						'value' => array(
							'custom'
						)
					) ,
					"description" => __("Select if you want to use shadow for the button.", 'cesis')
				) ,
				array(
					'type' => 'dropdown',
					"group" => __("Pagination / Navigation", 'cesis') ,
					'heading' => __("Choose the size of the Load more button", 'cesis') ,
					'param_name' => 'load_more_size',
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("Small", 'cesis') => "lb_small",
						__("Medium", 'cesis') => "lb_medium",
						__("Large", 'cesis') => "lb_large",
					) ,
					'dependency' => array(
						'element' => 'iso_nav',
						'value' => array(
							'load_more'
						)
					) ,
					'description' => __("Select the button size", 'cesis')
				) ,
				array(
					'type' => 'dropdown',
					"group" => __("Pagination / Navigation", 'cesis') ,
					'heading' => __("Choose the shape of the Load more button", 'cesis') ,
					'param_name' => 'load_more_shape',
					"edit_field_class" => 'vc_col-sm-6 vc_column',
					'value' => array(
						__("Squared", 'cesis') => "",
						__("Rounded", 'cesis') => "cesis_btn_rounded",
					) ,
					'dependency' => array(
						'element' => 'custom_color',
						'value' => array(
							'cesis_btn',
							'cesis_alt_btn',
							'cesis_sub_btn'
						)
					) ,
					'description' => __("Select the button shape", 'cesis')
				) ,
				array(
					'type' => 'dropdown',
					"group" => __("Pagination / Navigation", 'cesis') ,
					'heading' => __("Choose the position of the Load more button", 'cesis') ,
					'param_name' => 'load_more_pos',
					'value' => array(
						__("Center", 'cesis') => "lb_center",
						__("Left", 'cesis') => "lb_left",
						__("Right", 'cesis') => "lb_right",
						__("Full Width", 'cesis') => "lb_fw",
					) ,
					'dependency' => array(
						'element' => 'iso_nav',
						'value' => array(
							'load_more'
						)
					) ,
					'description' => __("Select the button position", 'cesis')
				) ,

				// Responsive Options

				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Responsive Options", 'cesis') ,
					"heading" => __("Number of items per line for big display / devices?", 'cesis') ,
					"param_name" => "col_big",
					'value' => array(
						"inherit " => "inherit",
						"1 " => "1",
						"2" => "2",
						"3" => "3",
						"4" => "4",
						"5" => "5"
					) ,
					"std" => "inherit",
					'dependency' => array(
						'element' => 'type',
						'value' => array(
							'carousel'
						)
					) ,
					"description" => __("Select the number of item to show per line for big display / devices ( optional ).", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Responsive Options", 'cesis') ,
					"heading" => __("Number of items per line for tablet devices?", 'cesis') ,
					"param_name" => "col_tablet",
					'value' => array(
						"1 " => "1",
						"2" => "2",
						"3" => "3"
					) ,
					"std" => "2",
					'dependency' => array(
						'element' => 'type',
						'value' => array(
							'carousel'
						)
					) ,
					"description" => __("Select the number of items to show per line for tablet devices ( optional ).", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Responsive Options", 'cesis') ,
					"heading" => __("Show navigation on tablet devices?", 'cesis') ,
					"param_name" => "nav_tablet",
					'value' => array(
						__("Default", 'cesis') => "",
						__("Yes", 'cesis') => "yes",
						__("No", 'cesis') => "no"
					) ,
					'dependency' => array(
						'element' => 'type',
						'value' => array(
							'carousel'
						)
					) ,
					"description" => __("Select if you want to use navigation on tablet devices.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Responsive Options", 'cesis') ,
					"heading" => __("Show pagination on tablet devices?", 'cesis') ,
					"param_name" => "pag_tablet",
					'value' => array(
						__("Default", 'cesis') => "",
						__("Yes", 'cesis') => "yes",
						__("No", 'cesis') => "no"
					) ,
					'dependency' => array(
						'element' => 'type',
						'value' => array(
							'carousel'
						)
					) ,
					"description" => __("Select if you want to use pagination on tablet devices.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Responsive Options", 'cesis') ,
					"heading" => __("Number of items per line for mobile devices?", 'cesis') ,
					"param_name" => "col_mobile",
					'value' => array(
						"1 " => "1",
						"2" => "2",
						"3" => "3"
					) ,
					'dependency' => array(
						'element' => 'type',
						'value' => array(
							'carousel'
						)
					) ,
					"description" => __("Select the number of items to show per line for mobile devices ( optional ).", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Responsive Options", 'cesis') ,
					"heading" => __("Show navigation on mobile devices?", 'cesis') ,
					"param_name" => "nav_mobile",
					'value' => array(
						__("Default", 'cesis') => "",
						__("Yes", 'cesis') => "yes",
						__("No", 'cesis') => "no"
					) ,
					'dependency' => array(
						'element' => 'type',
						'value' => array(
							'carousel'
						)
					) ,
					"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
				) ,
				array(
					"type" => "dropdown",
					"class" => "",
					"group" => __("Responsive Options", 'cesis') ,
					"heading" => __("Show pagination on mobile devices?", 'cesis') ,
					"param_name" => "pag_mobile",
					'value' => array(
						__("Default", 'cesis') => "",
						__("Yes", 'cesis') => "yes",
						__("No", 'cesis') => "no"
					) ,
					'dependency' => array(
						'element' => 'type',
						'value' => array(
							'carousel'
						)
					) ,
					"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
				) ,
				array(
					'type' => 'checkbox',
					"group" => __("Responsive Options", 'cesis') ,
					'heading' => __("Hide on Desktop?", 'cesis') ,
					'param_name' => 'hide_lg',
					'value' => array(
						'Yes' => 'cesis_hidden-lg'
					) ,
					'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
				) ,
				array(
					'type' => 'checkbox',
					"group" => __("Responsive Options", 'cesis') ,
					'heading' => __("Hide on Tablet devices?", 'cesis') ,
					'param_name' => 'hide_md',
					'value' => array(
						'Yes' => 'cesis_hidden-md'
					) ,
					'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
				),
				array(
					'type' => 'checkbox',
					"group" => __("Responsive Options", 'cesis') ,
					'heading' => __("Hide on Mobile devices?", 'cesis') ,
					'param_name' => 'hide_sm',
					'value' => array(
						'Yes' => 'cesis_hidden-sm'
					) ,
					'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
				),
			) ,
	));
	}

}

// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                            ADD TESTIMONIALS SHORTCODES                    /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

add_action('vc_before_init', 'cesis_testimonials_sc');

function cesis_testimonials_sc()
	{
	vc_map(array(
		"name" => __("Testimonials", 'cesis') ,
		"base" => "cesis_testimonials",
		"weight" => "87",
		"icon"		=> get_template_directory_uri() . "/includes/images/testimonial.svg",
		"show_settings_on_create" => true,
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Testionials Style", 'cesis') ,
				"param_name" => "style",
				"value" => array(
					__("Boxed Style ( 1 )", 'cesis') => "cesis_tm_1",
					__("Boxed Style ( 2 )", 'cesis') => "cesis_tm_2",
					__("Boxed Style ( 3 )", 'cesis') => "cesis_tm_3",
					__("Boxed Style ( 4 )", 'cesis') => "cesis_tm_4",
					__("Boxed Style ( 5 )", 'cesis') => "cesis_tm_5",
					__("Boxed Style ( 6 )", 'cesis') => "cesis_tm_20",
					__("Text and Image ( 1 )", 'cesis') => "cesis_tm_6",
					__("Text and Image ( 2 )", 'cesis') => "cesis_tm_7",
					__("Text and Image ( 3 )", 'cesis') => "cesis_tm_8",
					__("Text and Image ( 4 )", 'cesis') => "cesis_tm_9",
					__("Text only ( 1 )", 'cesis') => "cesis_tm_10",
					__("Text only ( 2 )", 'cesis') => "cesis_tm_11",
					__("Text only ( 3 )", 'cesis') => "cesis_tm_12",
					__("Text only ( 4 )", 'cesis') => "cesis_tm_13",
					__("Text only ( 5 )", 'cesis') => "cesis_tm_14",
					__("Text only ( 6 )", 'cesis') => "cesis_tm_15",
					__("Text only ( 7 )", 'cesis') => "cesis_tm_16",
					__("Text only ( 8 )", 'cesis') => "cesis_tm_17",
					__("Text only ( 9 )", 'cesis') => "cesis_tm_18",
					__("Text only ( 10 )", 'cesis') => "cesis_tm_19"
				) ,
				"description" => __("Select the Testimonials Style ( check style design <a href='https://cesis.co/testimonials/' target='_blank'>here</a>)", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Font style", 'cesis') ,
				"param_name" => "force_font",
				'value' => array(
					__("Theme Default", 'cesis') => "",
					__("Demo Pre-set", 'cesis') => "force_font",
					__("Custom", 'cesis') => "custom"
				) ,
				"description" => __("Select the testimonials font style to use.", 'cesis')
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Author font family', 'cesis') ,
				'param_name' => 'heading_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				"std" => "alt_font",
				'description' => __('Select the font to use.', 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'h_google_fonts',
				'value' => 'font_family:Montserrat%3Aregular,700|font_style:400%20regular%3A400%3Anormal,700%20bold%20regular%3A700%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Author font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "h_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the Author font size, for example 30", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Author font weight", 'cesis') ,
				"param_name" => "h_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "700",
				"description" => __("Select the Author font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'heading_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Author Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "h_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the Author line height", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Author capitalization", 'cesis') ,
				"param_name" => "h_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"std" => "uppercase",
				"description" => __("Select text capitalization.", 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Author Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "h_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the Author font letter spacing ( 0 is the default space )", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Text font family', 'cesis') ,
				'param_name' => 'text_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'google_fonts',
				'value' => 'font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:300%20light%20regular%3A300%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "t_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the heading font size, for example 14", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Text font weight", 'cesis') ,
				"param_name" => "t_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				"description" => __("Select the text font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'text_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "t_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the text line height", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text capitalization", 'cesis') ,
				"param_name" => "t_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"description" => __("Select text capitalization.", 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Text Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "t_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the text letter spacing ( 0 is the default space )", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'dropdown',
				"group" => __("Typography", 'cesis') ,
				'heading' => __('Author information font family', 'cesis') ,
				'param_name' => 'a_font',
				'value' => array(
					__('Main font', 'cesis') => 'main_font',
					__('Alternative font', 'cesis') => 'alt_font',
					__('Custom font', 'cesis') => 'custom',
				) ,
				'description' => __('Select the font to use.', 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				'type' => 'google_fonts',
				"group" => __("Typography", 'cesis') ,
				'param_name' => 'a_google_fonts',
				'value' => 'font_family:Open%20Sans%3A300%2C300italic%2Cregular%2Citalic%2C600%2C600italic%2C700%2C700italic%2C800%2C800italic|font_style:300%20light%20regular%3A300%3Anormal',
				'settings' => array(
					'fields' => array(
						'font_family_description' => __('Select font family.', 'cesis') ,
						'font_style_description' => __('Select font styling.', 'cesis') ,
					) ,
				) ,
				'dependency' => array(
					'element' => 'a_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Author information font size", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "a_f_size",
				"value" => __("14px", 'cesis') ,
				"description" => __("Select the Author information font size, for example 14", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"group" => __("Typography", 'cesis') ,
				"class" => "",
				"heading" => __("Author information font weight", 'cesis') ,
				"param_name" => "a_f_weight",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("100 ( thin )", 'cesis') => "100",
					__("300 ( light )", 'cesis') => "300",
					__("400 ( normal )", 'cesis') => "400",
					__("500 ( normal bold )", 'cesis') => "500",
					__("600 ( semi bold )", 'cesis') => "600",
					__("700 ( bold )", 'cesis') => "700",
					__("900 ( extra bold )", 'cesis') => "900",
				) ,
				"std" => "400",
				"description" => __("Select the Author information font weight.", 'cesis') ,
				'dependency' => array(
					'element' => 'a_font',
					'value' => array(
						'main_font',
						'alt_font'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Author information Line height", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "a_l_height",
				"value" => __("24px", 'cesis') ,
				"description" => __("Select the Author information line height", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Author information capitalization", 'cesis') ,
				"param_name" => "a_t_transform",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					__("None", 'cesis') => "none",
					__("Uppercase", 'cesis') => "uppercase",
					__("Lowercase", 'cesis') => "lowercase",
				) ,
				"description" => __("Select Author information capitalization.", 'cesis') ,
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"group" => __("Typography", 'cesis') ,
				"heading" => __("Author information Letter Spacing", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "a_l_spacing",
				"value" => __("0", 'cesis') ,
				"description" => __("Select the Author information letter spacing ( 0 is the default space )", 'cesis'),
				'dependency' => array(
					'element' => 'force_font',
					'value' => array(
						'custom'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Testimonial layout", 'cesis') ,
				"param_name" => "type",
				'value' => array(
					__("Carousel", 'cesis') => "carousel",
					__("Isotope", 'cesis') => "isotope"
				) ,
				"description" => __("Select if you want to show the Testimonials in a Carousel or Isotope layout.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Choose the space between the items", 'cesis') ,
				"param_name" => "padding",
				'value' => "30",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'isotope'
					)
				) ,
				"description" => __("Select the space between the items, default 30.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Number of items per line?", 'cesis') ,
				"param_name" => "col",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					"1" => "1",
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of testimonials to show per line.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Number of row?", 'cesis') ,
				"param_name" => "row",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				'value' => array(
					"1 " => "",
					"2 " => "2",
					"3 " => "3"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of row for the carousel.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Choose the space between the items", 'cesis') ,
				"param_name" => "margin",
				"value" => "30",
				"description" => __("Select the space between the items, default 30", 'cesis') ,
				'dependency' => array(
					'element' => 'col',
					'value' => array(
						'2',
						'3',
						'4',
						'5'
					)
				)
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Infinite loop?", 'cesis') ,
				"param_name" => "loop",
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to duplicate last and first items to get loop illusion.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Center the active item", 'cesis') ,
				"param_name" => "center",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to active item to be in the Center of the carousel container.", 'cesis')
			) ,

			array(
						'type' => 'param_group',
						"group" => __("Testimonials", 'cesis') ,
						'heading' => __('Testimonials', 'cesis') ,
						'param_name' => 'testimonials',
						'description' => __('Enter table features.', 'cesis') ,
						'value' => urlencode(json_encode(array(
							array(
								'author' => __('First Author name', 'cesis') ,
								'a_info' => __('Author information', 'cesis') ,
							) ,
							array(
								'author' => __('Second Author name', 'cesis') ,
								'a_info' => __('Author information', 'cesis') ,
							) ,
							array(
								'author' => __('Third Author name', 'cesis') ,
								'a_info' => __('Author information', 'cesis') ,
							) ,
						))) ,
						'params' => array(
							array(
								'type' => 'attach_image',
								'heading' => __('Author image', 'cesis') ,
								'param_name' => 'image',
								'value' => '',
								'description' => __('Select the image for the author (optional).', 'cesis')
							) ,
							array(
								'type' => 'textfield',
								'heading' => __('Author name', 'cesis') ,
								'param_name' => 'author',
								'admin_label' => true,
								'description' => __('Enter Author name.', 'cesis')
							) ,
							array(
								'type' => 'textfield',
								'heading' => __('Author information', 'cesis') ,
								'param_name' => 'a_info',
								'description' => __('Enter author information.', 'cesis')
							) ,
							array(
								'type' => 'textarea',

								// holder' => 'div',
								// 'admin_label' => true,

								'heading' => __('Quote from author', 'cesis') ,
								'param_name' => 't_content',
								'value' => __('I am promo text. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.', 'cesis')
							) ,
							array(
								"type" => "dropdown",
								"class" => "",
								"heading" => __("Testimonial Layout ( only needed when using Isotope )", 'cesis') ,
								"param_name" => "layout",
								'value' => array(
									"1/1 ( 100% )" => "full",
									"3/4 ( 75% )" => "three_fourth",
									"2/3 ( 66.6% )" => "two_third",
									"1/2 ( 50% )" => "half",
									"1/3 ( 33.3% )" => "one_third",
									"1/4 ( 25% )" => "one_fourth",
								) ,
								"description" => __("Select the item layout, one row will be fill with 100%.", 'cesis')
							) ,
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Testimonial Text color", 'cesis') ,
								"param_name" => "t_color",
								"value" => '', //Default Red color
								"description" => __("Choose the text color (optional)", 'cesis')
							) ,
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Testimonial Heading color", 'cesis') ,
								"param_name" => "h_color",
								"value" => '', //Default Red color
								"description" => __("Choose the heading color (optional)", 'cesis')
							) ,
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Testimonial Highlight color", 'cesis') ,
								"param_name" => "hl_color",
								"value" => '', //Default Red color
								"description" => __("Choose the high light color (optional)", 'cesis')
							) ,
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Testimonial background color", 'cesis') ,
								"param_name" => "bg_color",
								"value" => '', //Default Red color
								"description" => __("Choose the background color (optional)", 'cesis')
							) ,
							array(
								"type" => "colorpicker",
								"class" => "",
								"heading" => __("Testionials border color", 'cesis') ,
								"param_name" => "b_color",
								"value" => '', //Default Red color
								"description" => __("Choose the border color (optional)", 'cesis')
							) ,
							array(
								'type' => 'textfield',
								'heading' => __('Extra class name', 'cesis') ,
								'param_name' => 'class',
								"description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", 'cesis')
							) ,

						),
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Show pagination?", 'cesis') ,
				"param_name" => "nav",
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use pagination for the carousel.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots style", 'cesis') ,
				"param_name" => "nav_type",
				'value' => array(
					__("Grey dots", 'cesis') => 'cesis_owl_pag_1',
					__("White with shadow dots", 'cesis') => "cesis_owl_pag_3",
					__("Outline dots", 'cesis') => "cesis_owl_pag_2",
				) ,
				'dependency' => array(
					'element' => 'nav',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the pagination dots design you want to use.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots alignment", 'cesis') ,
				"param_name" => "nav_align",
				'value' => array(
					__("Center", 'cesis') => 'cesis_owl_nav_center',
					__("Left", 'cesis') => 'cesis_owl_nav_left',
					__("Right", 'cesis') => 'cesis_owl_nav_right',
				) ,
				'std' => 'cesis_owl_page_center',
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the pagination dots position.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots position", 'cesis') ,
				"param_name" => "nav_pos",
				'value' => array(
					__("Under content", 'cesis') => '',
					__("Over content", 'cesis') => "cesis_owl_pag_over",
				) ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
				"description" => __("Select the pagination dots position.", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination color", 'cesis') ,
				"param_name" => "nav_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the pagination color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'nav',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination active color", 'cesis') ,
				"param_name" => "nav_active_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active pagination color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'nav',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Auto Rotate?", 'cesis') ,
				"param_name" => "scroll",
				'value' => array(
					__("No", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want the carousel to rotate automatically.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Rotation speed", 'cesis') ,
				"param_name" => "speed",
				"value" => "800",
				"description" => __("Select the rotation speed in milliseconds ( example 2000 for 2 seconds )", 'cesis') ,
				'dependency' => array(
					'element' => 'scroll',
					'value' => array(
						'yes'
					)
				)
			) ,
			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Animation delay ( optional )", 'cesis') ,
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"param_name" => "delay",
				"value" => "0",
				"description" => __("Set the animation delay ( e.g 200 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"param_name" => "margin_top",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"param_name" => "margin_bottom",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Extra class name", 'cesis') ,
				"param_name" => "el_class",
				"value" => "",
				"description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for big display / devices?", 'cesis') ,
				"param_name" => "col_big",
				'value' => array(
					"inherit " => "inherit",
					"1 " => "1",
					"2" => "2",
					"3" => "3",
					"4" => "4",
					"5" => "5"
				) ,
				"std" => "inherit",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of item to show per line for big display / devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for tablet devices?", 'cesis') ,
				"param_name" => "col_tablet",
				'value' => array(
					"1 " => "1",
					"2" => "2",
					"3" => "3"
				) ,
				"std" => "1",
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of items to show per line for tablet devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show Pagination on tablet devices?", 'cesis') ,
				"param_name" => "nav_tablet",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on tablet devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Number of items per line for mobile devices?", 'cesis') ,
				"param_name" => "col_mobile",
				'value' => array(
					"1 " => "1",
					"2" => "2",
					"3" => "3"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select the number of items to show per line for mobile devices ( optional ).", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show Pagination on mobile devices?", 'cesis') ,
				"param_name" => "nav_mobile",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'carousel'
					)
				) ,
				"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		) ,
	));
	}



// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                            ADD TIMELINE SHORTCODES                        /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

add_action('vc_before_init', 'cesis_timeline_sc');

function cesis_timeline_sc()
	{
	vc_map(array(
		"name" => __("Timeline", 'cesis') ,
		"base" => "cesis_timeline",
		"weight" => "75",
		"icon"		=> get_template_directory_uri() . "/includes/images/timeline.svg",
		"show_settings_on_create" => true,
		"params" => array(

			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Timeline Line Color", 'cesis') ,
				"param_name" => "line_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the line color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Timeline Start Point Color", 'cesis') ,
				"param_name" => "f_point_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the top point color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Timeline Point Color", 'cesis') ,
				"param_name" => "point_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the event point color", 'cesis') ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Timeline background color", 'cesis') ,
				"param_name" => "bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the event background color", 'cesis') ,
			) ,


			array(
						'type' => 'param_group',
						"group" => __("Events", 'cesis') ,
						'heading' => __('Events', 'cesis') ,
						'param_name' => 'events',
						'description' => __('Create the event for the timelime.', 'cesis') ,
						'value' => urlencode(json_encode(array(
							array(
								'icon' => 'fa-clock' ,
								'heading' => __('First Event', 'cesis') ,
							) ,
							array(
								'icon' => 'fa-clock' ,
								'heading' => __('Second Event', 'cesis') ,
							) ,
							array(
								'icon' => 'fa-clock' ,
								'heading' => __('Third Event', 'cesis') ,
							) ,
						))) ,
						'params' => array(

array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Type", 'cesis') ,
	"param_name" => "type",
	"value" => array(
		__("Event", 'cesis') => "event",
		__("Date", 'cesis') => "date",
	) ,
	"description" => __("Select if you want to create an event or date.", 'cesis') ,
) ,
array(
	'type' => 'textfield',
	'heading' => __('Link', 'cesis') ,
	'param_name' => 'link',
	'description' => __('Fill this field if you want to add a link ( use http:// )', 'cesis') ,
	'value' => "",
	'dependency' => array(
		'element' => 'type',
		'value' => array(
			'event'
		)
	),
	) ,
array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Open link in a new page?", 'cesis') ,
	"param_name" => "target",
	"value" => array(
		__("No", 'cesis') => "_self",
		__("Yes", 'cesis') => "_blank",
	) ,
	'dependency' => array(
		'element' => 'link',
		'not_empty' => true
	) ,
	"description" => __("Select if you want the link to open in a new page.", 'cesis') ,
) ,
array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Use Icon or Image?", 'cesis') ,
	"param_name" => "i_choice",
	"value" => array(
		__("Icon", 'cesis') => "icon",
		__("Image", 'cesis') => "image",
	) ,
	'dependency' => array(
		'element' => 'type',
		'value' => array(
			'event'
		)
	),
	"description" => __("Select if you want to use an image instead of the icon", 'cesis') ,
) ,
array(
	'type' => 'attach_image',
	'heading' => __('Image', 'cesis') ,
	'param_name' => 'image',
	'value' => '',
	'dependency' => array(
		'element' => 'i_choice',
		'value' => array(
			'image'
		)
	) ,
	'description' => __('Select the image.', 'cesis')
) ,
array(
	'type' => 'textfield',
	'heading' => __('Image width', 'cesis') ,
	'param_name' => 'image_size',
	'value' => '100',
	'dependency' => array(
		'element' => 'i_choice',
		'value' => array(
			'image'
		)
	) ,
	'description' => __('Set the image width ( the height will be calculated automatically ).', 'cesis')
) ,
array(
	'type' => 'cesis_icon',
	'heading' => __('Icon', 'cesis') ,
	'param_name' => 'icon',
	'value' => 'fa-clock',
	'dependency' => array(
		'element' => 'i_choice',
		'value' => array(
			'icon'
		)
	) ,
) ,
array(
	'type' => 'textfield',
	'heading' => __('Icon size', 'cesis') ,
	'param_name' => 'i_size',
	'description' => __('Set the icon size', 'cesis') ,
	'value' => "40",
	'dependency' => array(
		'element' => 'i_choice',
		'value' => array(
			'icon'
		)
	) ,
) ,
array(
	'type' => 'checkbox',
	'heading' => __("Use Gradient for the icon?", 'cesis') ,
	'param_name' => 'i_use_gradient',
	'value' => array(
		'Yes' => 'yes'
	) ,
	'dependency' => array(
		'element' => 'i_choice',
		'value' => array(
			'icon'
		)
	) ,
	'description' => __("Select if you want to use gradient for the icon", 'cesis') ,
) ,
array(
	'type' => 'checkbox',
	'heading' => __("Add Background for the icon?", 'cesis') ,
	'param_name' => 'use_shape',
	'value' => array(
		'Yes' => 'yes'
	) ,
	'dependency' => array(
		'element' => 'i_choice',
		'value' => array(
			'icon'
		)
	) ,
	'description' => __("Select if you want to use background and border for the icon", 'cesis') ,
) ,
array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Background shape", 'cesis') ,
	"param_name" => "shape",
	"value" => array(
		__("Rounded", 'cesis') => "rounded",
		__("Squared", 'cesis') => "squared",
		__("Diamond", 'cesis') => "diamond",
		__("Hexagon", 'cesis') => "hexagon",
	) ,
	"description" => __("Select icon background shape", 'cesis') ,
	'dependency' => array(
		'element' => 'use_shape',
		'value' => array(
			'yes'
		)
	) ,
) ,
array(
	'type' => 'textfield',
	'heading' => __('Background border radius', 'cesis') ,
	'param_name' => 'i_radius',
	'description' => __('Set the border radius 0~100 ( 100 for perfect circle, 0 for squared )', 'cesis') ,
	'value' => "100",
	'dependency' => array(
		'element' => 'shape',
		'value' => array(
			'rounded'
		)
	) ,
) ,
array(
	'type' => 'textfield',
	'heading' => __('Background size', 'cesis') ,
	'param_name' => 'i_bg_size',
	'description' => __('Set the icon background size', 'cesis') ,
	'value' => "110",
	'dependency' => array(
		'element' => 'use_shape',
		'value' => array(
			'yes'
		)
	) ,
) ,
array(
	'type' => 'textfield',
	'heading' => __('Background border size', 'cesis') ,
	'param_name' => 'i_b_size',
	'description' => __('Set the icon border size ( set to 0 if border not needed)', 'cesis') ,
	'value' => "0",
	'dependency' => array(
		'element' => 'use_shape',
		'value' => array(
			'yes'
		)
	) ,
) ,
array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Icon Hover effect", 'cesis') ,
	"param_name" => "i_hover",
	"value" => array(
		__("None", 'cesis') => "none",
		__("Shine", 'cesis') => "shine",
		__("Grow", 'cesis') => "grow",
		__("Shrink", 'cesis') => "shrink",
		__("Outline outward", 'cesis') => "outline_o",
		__("Outline inline", 'cesis') => "outline_i",
		__("Trim", 'cesis') => "trim",
	) ,
	"description" => __("Select hover effect", 'cesis') ,
	'dependency' => array(
		'element' => 'use_shape',
		'value' => array(
			'yes'
		)
	) ,
) ,
array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Icon Shadow type", 'cesis') ,
	"param_name" => "i_shadow_type",
	"value" => array(
		__("None", 'cesis') => "none",
		__("Dropdown", 'cesis') => "dropdown",
		__("Blur", 'cesis') => "blur",
		__("Solid", 'cesis') => "solid",
	) ,
	"description" => __("Select shadow type", 'cesis') ,
	'dependency' => array(
		'element' => 'use_shape',
		'value' => array(
			'yes'
		)
	) ,
) ,
array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Icon Shadow hover effect", 'cesis') ,
	"param_name" => "i_shadow_hover",
	"value" => array(
		__("Always on", 'cesis') => "always",
		__("Show on hover", 'cesis') => "hover",
		__("Hide on hover", 'cesis') => "off_hover",
	) ,
	"description" => __("Select hover effect", 'cesis') ,
	'dependency' => array(
		'element' => 'i_shadow_type',
		'value' => array(
			'blur',
			'solid',
			'dropdown',
		)
	) ,
) ,
array(
	"type" => "dropdown",
	"class" => "",
	"heading" => __("Icon position", 'cesis') ,
	"param_name" => "position",
	"value" => array(
		__("Top", 'cesis') => "timeline_i_top",
		__("Next to Text", 'cesis') => "timeline_i_next",
	) ,
	'dependency' => array(
		'element' => 'type',
		'value' => array(
			'event'
		)
	),
	"description" => __("Select the icon position", 'cesis') ,
) ,
array(
	'type' => 'textfield',
	'heading' => __('Space between icon and text', 'cesis') ,
	'param_name' => 'i_space',
	'description' => __('Set the space between the icon and content ( eg 20 )', 'cesis') ,
	'value' => "20",
	'dependency' => array(
		'element' => 'type',
		'value' => array(
			'event'
		)
	),
) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Icon Color", 'cesis') ,
				"param_name" => "icon_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon color", 'cesis') ,
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Icon background Color", 'cesis') ,
				"param_name" => "icon_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon background color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Icon second Color ( used for gradient )", 'cesis') ,
				"param_name" => "icon_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon gradient color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'i_use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Icon border Color", 'cesis') ,
				"param_name" => "icon_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon border color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Hover Icon Color", 'cesis') ,
				"param_name" => "h_icon_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon hover color", 'cesis') ,
				'dependency' => array(
					'element' => 'i_choice',
					'value' => array(
						'icon'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Icon Hover background Color", 'cesis') ,
				"param_name" => "h_icon_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the icon hover background color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Icon hover gradient Color", 'cesis') ,
				"param_name" => "h_icon_alt_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Icon hover gradient Color ( optional )", 'cesis') ,
				'dependency' => array(
					'element' => 'i_use_gradient',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Icon hover border Color", 'cesis') ,
				"param_name" => "h_icon_border_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Icon hover border Color", 'cesis') ,
				'dependency' => array(
					'element' => 'use_shape',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Icon Shadow Color", 'cesis') ,
				"param_name" => "i_shadow_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the shadow color", 'cesis') ,
				'dependency' => array(
					'element' => 'i_shadow_type',
					'value' => array(
						'dropdown',
						'blur',
						'solid',
					)
				) ,
			) ,
array(
	'type' => 'textfield',
	'heading' => __('Heading', 'cesis') ,
	'param_name' => 'heading',
	'description' => __('Set the heading ( optional )', 'cesis') ,
	'value' => "Great title",
	'admin_label' => true,
	'dependency' => array(
		'element' => 'type',
		'value' => array(
			'event'
		)
	),
) ,
array(
	'type' => 'textfield',
	'heading' => __('Heading bottom space', 'cesis') ,
	'param_name' => 'heading_space',
	'description' => __('Set the heading bottom space ( eg 20 )', 'cesis') ,
	'value' => "20",
	'dependency' => array(
		'element' => 'type',
		'value' => array(
			'event'
		)
	),
) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Heading Color", 'cesis') ,
				"param_name" => "heading_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the heading color", 'cesis') ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'event'
					)
				),
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Heading hover Color", 'cesis') ,
				"param_name" => "heading_h_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the heading hover color", 'cesis') ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'event'
					)
				),
			) ,
array(
	'type' => 'textarea',
	'heading' => __('Text', 'cesis') ,
	'param_name' => 'text',
	'description' => __('Set the text', 'cesis') ,
	'value' => "Cesis is a great theme and this is a great dummy text filler",
	'dependency' => array(
		'element' => 'type',
		'value' => array(
			'event'
		)
	),
) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Text Color", 'cesis') ,
				"param_name" => "text_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the text color", 'cesis') ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'event'
					)
				),
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Text hover Color", 'cesis') ,
				"param_name" => "text_h_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the text hover color", 'cesis') ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'event'
					)
				),
			) ,
array(
	'type' => 'textfield',
	'heading' => __('Date', 'cesis') ,
	'param_name' => 'date',
	'description' => __('Set the date to show', 'cesis') ,
	'value' => "2017",
	'dependency' => array(
		'element' => 'type',
		'value' => array(
			'date'
		)
	),
) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Date text Color", 'cesis') ,
				"param_name" => "date_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Date text color", 'cesis') ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'date'
					)
				),
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"heading" => __("Date background Color", 'cesis') ,
				"param_name" => "date_bg_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the Date background color", 'cesis') ,
				'dependency' => array(
					'element' => 'type',
					'value' => array(
						'date'
					)
				),
			) ,


						),
			),

			vc_map_add_css_animation() ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"param_name" => "margin_top",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Top margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"param_name" => "margin_bottom",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Bottom margin for the module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Extra class name", 'cesis') ,
				"param_name" => "el_class",
				"value" => "",
				"description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,
		) ,
	));
	}



// /////////////////////////////////////////////////////////////////////////////////////
// ////                                                                           /////
// ///                            ADD CONTAINER    SHORTCODES                    /////
// //                                                                           /////
// /////////////////////////////////////////////////////////////////////////////////

add_action('vc_before_init', 'cesis_content_slider_sc');

function cesis_content_slider_sc()
	{
	vc_map(array(
		"name" => __("Content Slider", 'cesis') ,
		"base" => "cesis_content_slider",
		"weight" => "82",
		"icon"		=> get_template_directory_uri() . "/includes/images/content_slider.svg",
		'is_container' => true,
		'as_parent' => array(
			'only' => 'vc_tta_section',
		) ,
		'category' => __('Content', 'cesis') ,
		'description' => __('Pageable content container', 'cesis') ,
		"params" => array(
			array(
				'type' => 'hidden',
				'param_name' => 'no_fill_content_area',
				'std' => true,
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Infinite loop?", 'cesis') ,
				"param_name" => "loop",
				'value' => array(
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				"description" => __("Select if you want to duplicate last and first items to get loop illusion.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Auto Rotate?", 'cesis') ,
				"param_name" => "scroll",
				'value' => array(
					__("No", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
				) ,
				"description" => __("Select if you want the carousel to rotate automatically.", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Rotation speed", 'cesis') ,
				"param_name" => "speed",
				"value" => "800",
				"description" => __("Select the rotation speed in milliseconds ( example 2000 for 2 seconds )", 'cesis') ,
				'dependency' => array(
					'element' => 'scroll',
					'value' => array(
						'yes'
					)
				)
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Top Space", 'cesis') ,
				"param_name" => "margin_top",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Top margin for the Module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Module Bottom Space", 'cesis') ,
				"param_name" => "margin_bottom",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => "0",
				"description" => __("Bottom margin for the Module container (e.g 20 )", 'cesis')
			) ,
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Extra class name", 'cesis') ,
				"param_name" => "el_class",
				"value" => "",
				"description" => __("Style particular content element differently - add a class name and refer to it in custom CSS.", 'cesis')
			) ,

			// Pagination Options

			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Show navigation?", 'cesis') ,
				"param_name" => "nav",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				"description" => __("Select if you want to use navigation for the carousel.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Show pagination ( dots )?", 'cesis') ,
				"param_name" => "pag",
				'value' => array(
					__("No", 'cesis') => "no",
					__("Yes", 'cesis') => "yes"
				) ,
				"description" => __("Select if you want to use pagination for the carousel.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots style", 'cesis') ,
				"param_name" => "pag_type",
				'value' => array(
					__("Grey dots", 'cesis') => 'cesis_owl_pag_1',
					__("White with shadow dots", 'cesis') => "cesis_owl_pag_3",
					__("Outline dots", 'cesis') => "cesis_owl_pag_2",
				) ,
				"description" => __("Select the pagination dots design you want to use.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination dots position", 'cesis') ,
				"param_name" => "pag_pos",
				'value' => array(
					__("Under content", 'cesis') => '',
					__("Over content", 'cesis') => "cesis_owl_pag_over",
				) ,
				"description" => __("Select the pagination dots position.", 'cesis')
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination color", 'cesis') ,
				"param_name" => "pag_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the navigation color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
			) ,
			array(
				"type" => "colorpicker",
				"class" => "",
				"group" => __("Pagination / Navigation", 'cesis') ,
				"heading" => __("Pagination active color", 'cesis') ,
				"param_name" => "pag_active_color",
				"edit_field_class" => 'vc_col-sm-6 vc_column',
				"value" => '', //Default Red color
				"description" => __("Choose the active pagination color (optional)", 'cesis') ,
				'dependency' => array(
					'element' => 'pag',
					'value' => array(
						'yes'
					)
				) ,
			) ,

			// Responsive Options
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show navigation on tablet devices?", 'cesis') ,
				"param_name" => "nav_tablet",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				"description" => __("Select if you want to use navigation on tablet devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show pagination on tablet devices?", 'cesis') ,
				"param_name" => "pag_tablet",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				"description" => __("Select if you want to use pagination on tablet devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show navigation on mobile devices?", 'cesis') ,
				"param_name" => "nav_mobile",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
			) ,
			array(
				"type" => "dropdown",
				"class" => "",
				"group" => __("Responsive Options", 'cesis') ,
				"heading" => __("Show pagination on mobile devices?", 'cesis') ,
				"param_name" => "pag_mobile",
				'value' => array(
					__("Default", 'cesis') => "",
					__("Yes", 'cesis') => "yes",
					__("No", 'cesis') => "no"
				) ,
				"description" => __("Select if you want to use navigation on mobile devices.", 'cesis')
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Desktop?", 'cesis') ,
				'param_name' => 'hide_lg',
				'value' => array(
					'Yes' => 'cesis_hidden-lg'
				) ,
				'description' => __("Select if you want to hide the module on desktop", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Tablet devices?", 'cesis') ,
				'param_name' => 'hide_md',
				'value' => array(
					'Yes' => 'cesis_hidden-md'
				) ,
				'description' => __("Select if you want to hide the module on tablet devices", 'cesis') ,
			) ,
			array(
				'type' => 'checkbox',
				"group" => __("Responsive Options", 'cesis') ,
				'heading' => __("Hide on Mobile devices?", 'cesis') ,
				'param_name' => 'hide_sm',
				'value' => array(
					'Yes' => 'cesis_hidden-sm'
				) ,
				'description' => __("Select if you want to hide the module on mobile devices", 'cesis') ,
			) ,

		) ,
		'js_view' => 'VcBackendTtaPageableView',
		'custom_markup' => '
<div class="vc_tta-container vc_tta-o-non-responsive" data-vc-action="collapse">
	<div class="vc_general vc_tta vc_tta-tabs vc_tta-pageable vc_tta-color-backend-tabs-white vc_tta-style-flat vc_tta-shape-rounded vc_tta-spacing-1 vc_tta-tabs-position-top vc_tta-controls-align-left">
		<div class="vc_tta-tabs-container">'
	                   . '<ul class="vc_tta-tabs-list">'
	                   . '<li class="vc_tta-tab" data-vc-tab data-vc-target-model-id="{{ model_id }}" data-element_type="vc_tta_section"><a href="javascript:;" data-vc-tabs data-vc-container=".vc_tta" data-vc-target="[data-model-id=\'{{ model_id }}\']" data-vc-target-model-id="{{ model_id }}"><span class="vc_tta-title-text">{{ section_title }}</span></a></li>'
	                   . '</ul>
		</div>
		<div class="vc_tta-panels vc_clearfix {{container-class}}">
		  {{ content }}
		</div>
	</div>
</div>',
		'default_content' => '
[vc_tta_section title="' . sprintf('%s %d', __('Section', 'cesis') , 1) . '"][/vc_tta_section]
[vc_tta_section title="' . sprintf('%s %d', __('Section', 'cesis') , 2) . '"][/vc_tta_section]
	',
	));
	}

/***************************************************

 Start Templates

 **************************************************/


 add_action( 'vc_load_default_templates_action','cesis_staff_01' ); // Hook in

function cesis_staff_01() {
    $data               = array(); // Create new array
    $data['name']       = __( 'Staff full width', 'cesis' ); // Assign name for your custom template
    $data['weight']     = 0; // Weight of your template in the template list
    $data['image_path'] = get_template_directory_uri(). '/includes/images/404_default.png'; // Always use preg replace to be sure that "space" will not break logic. Thumbnail should have this dimensions: 114x154px
    $data['custom_class'] = 'cesis_staff_01'; // CSS class name
    $data['content']    = <<<CONTENT
        [vc_row full_width="stretch_row_content_no_spaces" css=".vc_custom_1508666679419{padding-top: 80px !important;padding-bottom: 0px !important;background-color: #f4f4f4 !important;}"][vc_column][vc_custom_heading text="Meet our team" font_container="tag:h2|font_size:28|text_align:center|line_height:1.2em" text_resize="yes" text_minimum="24" text_transform="cesis_text_transform_uppercase" google_fonts="font_family:Roboto%3A100%2C100italic%2C300%2C300italic%2Cregular%2Citalic%2C500%2C500italic%2C700%2C700italic%2C900%2C900italic|font_style:700%20bold%20regular%3A700%3Anormal" css=".vc_custom_1525629877875{margin-bottom: 25px !important;}"][vc_column_text max_width="780px" text_ctn_pos="cesis_line_d_center" css=".vc_custom_1508666781951{margin-bottom: 70px !important;}"]</p>
<p style="text-align: center;">Cesis will provide you support if you have any problems, our support team will reply within a day and we also have detailed documentation.</p>
<p>[/vc_column_text][cesis_staff style_ig="cesis_staff_style_6" hover="cesis_hover_fade" to_show="8" category="all,261,259" tag="" col="4" padding="0" i_social="social_c" css_animation="fadeInUp"][/vc_column][/vc_row]
CONTENT;

    vc_add_default_templates( $data );
}

?>
