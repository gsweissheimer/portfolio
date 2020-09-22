<?php

if (!class_exists('WPBakeryShortCode_cesis_share_shortcode')) {
class WPBakeryShortCode_cesis_share_shortcode extends WPBakeryShortCode {



protected function content( $atts, $content = null ) {

global $cesis_data;

	extract(shortcode_atts(array(
		'link' => 'http://google.com',
		'title' => 'Cesis awesome page',
		'type' => 'cesis_share_io',
		'position' => 'cesis_share_left',
		'size' => 'cesis_share_small',
		'space' => '20',
		'facebook' => 'no',
		'twitter' => 'no',
		'google' => 'no',
		'pinterest' => 'no',
		'linkedin' => 'no',
		'reddit' => 'no',
		'tumblr' => 'no',
		'xing' => 'no',
		'vk' => 'no',
		'mail' => 'no',
		'color_type' => 'cesis_share_colorized',
		'icon_color' => '',
		'icon_bg_color' => '',
		'icon_b_color' => '',
		'icon_h_color' => '',
		'icon_h_bg_color' => '',
		'icon_h_b_color' => '',
		'css'   => '',
 		'css_animation' => '',
 		'delay' => '0',
    'margin_top' => '0',
    'margin_bottom' => '0',
		'hide_lg' => '',
		'hide_md' => '',
		'hide_sm' => '',
		'el_class' => ''

    ), $atts));

/* default color settings from theme options */

$output = $style = $custom_style = $a_style = $hv = '';

$i = 0;
if($facebook !== 'no'){ $i ++;}
if($twitter !== 'no'){ $i ++;}
if($google !== 'no'){ $i ++;}
if($pinterest !== 'no'){ $i ++;}
if($linkedin !== 'no'){ $i ++;}
if($reddit !== 'no'){ $i ++;}
if($tumblr !== 'no'){ $i ++;}
if($xing !== 'no'){ $i ++;}
if($vk !== 'no'){ $i ++;}
if($mail !== 'no'){ $i ++;}

if($color_type == 'custom'){

}
ob_start();


$share_style = 'style="';

if($color_type == 'custom'){
	$a_style .= 'style="color:'.$icon_color.'; background:'.$icon_bg_color.'; border-color:'.$icon_b_color.';"';
	$hv = 'onmouseleave="this.style.borderColor=\''.$icon_b_color.'\'; this.style.background=\''.$icon_bg_color.'\'; this.style.color=\''.$icon_color.'\';"
	onmouseenter="this.style.borderColor=\''.$icon_h_b_color.'\'; this.style.background=\''.$icon_h_bg_color.'\'; this.style.color=\''.$icon_h_color.'\';"';
}


if($position == 'cesis_share_justify'){
	$share_style .= 'width:calc((100%/'.($i).') - ('.($space*($i - 1)/$i).'px));';
}elseif($position == 'cesis_share_left'){
	$share_style .= 'margin-right:'.$space.'px;';
}elseif($position == 'cesis_share_right'){
$share_style .= 'margin-left:'.$space.'px;';
}elseif($position == 'cesis_share_center'){
$share_style .= 'margin:0 '.$space.'px;';
}
$share_style .= '"';

$animation = $this->getCSSAnimation( $css_animation );
$id = RandomString(20);
$el_class = $this->getExtraClass( $el_class ) ;
$class_to_filter = 'cesis_share_ctn '.$type.' '.$size.' '.$position.' '.$color_type.' '.$el_class.' '.$hide_lg.' '.$hide_md.' '.$hide_sm.' ';
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

$output .= '<div id="cesis_share_ctn_'.$id.'" class="' . esc_attr( $css_class ) . '" style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;">';
if($facebook !== 'no'){
			$output .= '<span class="cesis_share_facebook '.$animation.'" '.$share_style.'  data-delay="'.$delay.'"> <a '.$hv.' '.$a_style.' target="_blank" onClick="popup = window.open(\'http://www.facebook.com/sharer.php?u='.urlencode($link).'&amp;t='. $title.'\', \'PopupPage\', \'height=450,width=500,scrollbars=yes,resizable=yes\'); return false" href="#"><i class="fa fa-facebook"></i></a>
			 </span>';
			 $delay = $delay + 200;
		 }
 if($twitter !== 'no'){
			$output .= '<span class="cesis_share_twitter '.$animation.'" '.$share_style.'  data-delay="'.$delay.'"> <a '.$hv.' '.$a_style.' target="_blank" onClick="popup = window.open(\'http://twitter.com/home?status='.$title.' '.urlencode($link).'\', \'PopupPage\', \'height=450,width=500,scrollbars=yes,resizable=yes\'); return false" href="#"><i class="fa fa-twitter"></i></a>
			 </span>';
			 $delay = $delay + 200;
		 }
 if($google !== 'no'){
			$output .= '<span class="cesis_share_google '.$animation.'" '.$share_style.'  data-delay="'.$delay.'"> <a '.$hv.' '.$a_style.' target="_blank" onClick="popup = window.open(\'https://plus.google.com/share?url='. urlencode($link).'&amp;title='. $title.'\', \'PopupPage\', \'height=450,width=500,scrollbars=yes,resizable=yes\'); return false" href="#"><i class="fa fa-google-plus"></i></a>
			 </span>';
			 $delay = $delay + 200;
		 }
if($pinterest !== 'no'){
			$output .= '<span class="cesis_share_pinterest '.$animation.'" '.$share_style.'  data-delay="'.$delay.'"> <a '.$hv.' '.$a_style.' target="_blank" onClick="popup = window.open(\'https://pinterest.com/pin/create/bookmarklet/?url='.urlencode($link).'&amp;title='. $title.'\', \'PopupPage\', \'height=450,width=500,scrollbars=yes,resizable=yes\'); return false" href="#"><i class="fa fa-pinterest"></i></a>
			 </span>';
			 $delay = $delay + 200;
		 }
 if($linkedin !== 'no'){
			$output .= '<span class="cesis_share_linkedin '.$animation.'" '.$share_style.'  data-delay="'.$delay.'"> <a '.$hv.' '.$a_style.' target="_blank" onClick="popup = window.open(\'http://linkedin.com/shareArticle?mini=true&amp;url='.urlencode($link).'&amp;title='. $title.'\', \'PopupPage\', \'height=450,width=500,scrollbars=yes,resizable=yes\'); return false" href="#"><i class="fa fa-linkedin"></i></a>
			 </span>';
			 $delay = $delay + 200;
		 }
if($reddit !== 'no'){
			$output .= '<span class="cesis_share_reddit '.$animation.'" '.$share_style.'  data-delay="'.$delay.'"> <a '.$hv.' '.$a_style.' target="_blank" onClick="popup = window.open(\'http://reddit.com/submit?url='.urlencode($link).'&amp;title='. $title.'\', \'PopupPage\', \'height=450,width=500,scrollbars=yes,resizable=yes\'); return false" href="#"><i class="fa fa-reddit"></i></a>
			 </span>';
			 $delay = $delay + 200;
		 }
if($tumblr !== 'no'){
			$output .= '<span class="cesis_share_tumblr '.$animation.'" '.$share_style.'  data-delay="'.$delay.'"> <a '.$hv.' '.$a_style.' target="_blank" onClick="popup = window.open(\'http://www.tumblr.com/share/link?url='.urlencode($link).'&amp;name='. $title.'\', \'PopupPage\', \'height=450,width=500,scrollbars=yes,resizable=yes\'); return false" href="#"><i class="fa fa-tumblr"></i></a>
			 </span>';
			 $delay = $delay + 200;
		 }
if($xing !== 'no'){
			$output .= '<span class="cesis_share_xing '.$animation.'" '.$share_style.'  data-delay="'.$delay.'"> <a '.$hv.' '.$a_style.' target="_blank" onClick="popup = window.open(\'https://www.xing.com/app/user?op=share&url='.urlencode($link).'\', \'PopupPage\', \'height=450,width=500,scrollbars=yes,resizable=yes\'); return false" href="#"><i class="fa fa-xing"></i></a>
			 </span>';
			 $delay = $delay + 200;
		 }
if($vk !== 'no'){
			$output .= '<span class="cesis_share_vk '.$animation.'" '.$share_style.'  data-delay="'.$delay.'"> <a '.$hv.' '.$a_style.' target="_blank" onClick="popup = window.open(\'http://vk.com/share.php?url='.urlencode($link).'\', \'PopupPage\', \'height=450,width=500,scrollbars=yes,resizable=yes\'); return false" href="#"><i class="fa fa-vk"></i></a>
			 </span>';
			 $delay = $delay + 200;
		 }
if($mail !== 'no'){
			$output .= '<span class="cesis_share_mail '.$animation.'" '.$share_style.'  data-delay="'.$delay.'"> <a '.$hv.' '.$a_style.' target="_blank" onClick="popup = window.open(\'mailto:?subject='. $title.'&amp;body='. urlencode($link).'\', \'PopupPage\', \'height=450,width=500,scrollbars=yes,resizable=yes\'); return false" href="#"><i class="fa fa-paper-plane-o"></i></a>
			</span>';
			$delay = $delay + 200;
 }
$output .='</div>';


echo !empty( $output ) ? $output : '';

$output_string = ob_get_contents();
ob_end_clean();
return $output_string;


}
}

}
