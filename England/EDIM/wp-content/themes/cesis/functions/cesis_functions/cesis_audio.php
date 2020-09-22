<?php
//audio file related functions
if(!function_exists('cesis_audio_file'))
{


	function cesis_audio_file($file,$loop,$autoplay,$preload){
		$audio_data = '';
		if(strpos($file, '.mp3') !== false){
			$audio_data .= ' mp3="'.$file.'"';
		}elseif(strpos($file, '.ogg') !== false){
			$audio_data .= ' ogg="'.$file.'"';
		}elseif(strpos($file, '.wav') !== false){
			$audio_data .= ' wav="'.$file.'"';
		}elseif(strpos($file, '.m4a') !== false){
			$audio_data .= ' m4a="'.$file.'"';
		}elseif(strpos($file, '.wma') !== false){
			$audio_data .= ' wma="'.$file.'"';
		}
		if($loop == 'yes'){
			$audio_data .= ' loop="on"';
		}
		if($autoplay == 'yes'){
			$audio_data .= ' loop="1"';
		}
		if($preload == 'yes'){
			$audio_data .= ' preload="auto"';
		}
		$output = '[audio '.$audio_data.'][/audio]';
		echo do_shortcode($output);

	}

}
