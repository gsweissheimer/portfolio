<?php
//video file related functions
if(!function_exists('cesis_video_file'))
{


	function cesis_video_file($file_mp4,$file_m4v,$file_webm,$file_ogv,$file_wmv,$file_flv,$loop,$autoplay,$preload){
		$video_data = '';
		if(strpos($file_mp4, '.mp4') !== false){
			$video_data .= ' mp4="'.$file_mp4.'"';
		}if(strpos($file_m4v, '.m4v') !== false){
			$video_data .= ' m4v="'.$file_m4v.'"';
		}if(strpos($file_webm, '.webm') !== false){
			$video_data .= ' webm="'.$file_webm.'"';
		}if(strpos($file_ogv, '.ogv') !== false){
			$video_data .= ' ogv="'.$file_ogv.'"';
		}if(strpos($file_wmv, '.wmv') !== false){
			$video_data .= ' wmv="'.$file_wmv.'"';
		}if(strpos($file_flv, '.flv') !== false){
			$video_data .= ' flv="'.$file_flv.'"';
		}
		if($loop == 'yes'){
			$video_data .= ' loop="on"';
		}
		if($autoplay == 'yes'){
			$video_data .= ' loop="1"';
		}
		if($preload == 'yes'){
			$video_data .= ' preload="auto"';
		}
		$output = '[video '.$video_data.'][/video]';
		echo do_shortcode($output);

	}

}
