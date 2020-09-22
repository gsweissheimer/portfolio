<?php
//Social Icons related functions
if(!function_exists('cesis_socials'))
{


	function cesis_socials($type){
		global $cesis_data;

		$social_content = '<span class="cesis_social_icons '.$type.'">';
	  if(!empty($cesis_data['cesis_social_icons']) && is_array($cesis_data['cesis_social_icons'])){
	     foreach($cesis_data['cesis_social_icons'] as $key => $icon){
	        $social_content .= '<a href="'.$icon["font-url"].'" target="'.$cesis_data['cesis_social_icons_target'].'" class="'.$icon["font-suffix"].' '.$icon["font-icon"].'"></a>';
	     }
	  }
	  $social_content .= '</span>';

		return $social_content;

	}

}
