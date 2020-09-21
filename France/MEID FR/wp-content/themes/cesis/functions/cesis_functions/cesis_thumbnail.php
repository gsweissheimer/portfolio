<?php
//thumbnail related functions
if(!function_exists('cesis_thumbnail_size'))
{

global $thumb_config;

	function cesis_thumbnail_size(&$thumb_config)
	{
		if (function_exists('add_theme_support'))
		{
			foreach ($thumb_config['imgSize'] as $sizeName => $size)
			{
				if($sizeName == 'base')
				{
					set_post_thumbnail_size($thumb_config['imgSize'][$sizeName]['width'], $thumb_config[$sizeName]['height'], true);
				}
				else
				{
					if(!isset($thumb_config['imgSize'][$sizeName]['crop'])) $thumb_config['imgSize'][$sizeName]['crop'] = true;

					add_image_size(
						$sizeName,
						$thumb_config['imgSize'][$sizeName]['width'],
						$thumb_config['imgSize'][$sizeName]['height'],
						$thumb_config['imgSize'][$sizeName]['crop']);
				}
			}
		}
	}




// Register additional image thumbnail sizes
// The thumbnails are generated on image upload!

// If the size of an array was changed after an image was uploaded you either need to re-upload the image
// or use the thumbnail regeneration plugin: http://wordpress.org/extend/plugins/regenerate-thumbnails/


$thumb_config['imgSize']['tnwidget'] 			 	= array('width'=>180,  'height'=>180);						// small preview pics eg sidebar news


$thumb_config['selectableImgSizes'] = array(
	'square' 				=> __('Square', 'cesis'),
	'featured'  			=> __('Featured Thin', 'cesis'),
	'featured_large'  		=> __('Featured Large', 'cesis'),
	'portfolio' 			=> __('Portfolio', 'cesis'),
	'gallery' 				=> __('Gallery', 'cesis'),
	'entry_with_sidebar' 	=> __('Entry with Sidebar', 'cesis'),
	'entry_without_sidebar'	=> __('Entry without Sidebar', 'cesis'),
	'extra_large' 			=> __('Fullscreen Sections/Sliders', 'cesis'),

);


cesis_thumbnail_size($thumb_config);



function cesis_select_image_sizes($sizes){
	return array_merge( $sizes, array(
	'square' 				=> __('Square', 'cesis'),
	'featured'  			=> __('Featured Thin', 'cesis'),
	'featured_large'  		=> __('Featured Large', 'cesis'),
	'portfolio' 			=> __('Portfolio', 'cesis'),
	'gallery' 				=> __('Gallery', 'cesis'),
	'entry_with_sidebar' 	=> __('Entry with Sidebar', 'cesis'),
	'entry_without_sidebar'	=> __('Entry without Sidebar', 'cesis'),
	'extra_large' 			=> __('Fullscreen Sections/Sliders', 'cesis'),
    ) );
}

add_filter( 'image_size_names_choose', 'cesis_select_image_sizes');




function cesis_image_ratio($img_url, $size){


if($size == 'tnwidget'){  return aq_resize( $img_url, 180, 180, true, true, true);		}				// small preview pics eg sidebar news
if($size == 'tn_squared'){ return aq_resize( $img_url, 1200, 1200, true, true, true);		}                 // small image for blogs
if($size == 'tn_rectangle_4_3'){  return aq_resize( $img_url, 1200, 900, true, true, true);	}					// images for fullsize pages and fullsize slider
if($size == 'tn_rectangle_3_2'){  return aq_resize( $img_url, 1200, 800 , true, true, true);}                 // small image for blogs
if($size == 'tn_landscape_16_9'){ return  aq_resize( $img_url, 1200, 675, true, true, true);}	// images for fullscrren slider
if($size == 'tn_landscape_4_2'){ return aq_resize( $img_url, 1200, 600, true, true, true);	}				// images for fullsize pages and fullsize slider
if($size == 'tn_landscape_21_9'){ return aq_resize( $img_url, 1200, 514, true, true, true);	}	// images for fullsize pages and fullsize slider
if($size == 'tn_landscape_8_3'){ return aq_resize( $img_url, 1200, 450, true, true, true);		}			// images for portfolio entries (2,3 column)
if($size == 'tn_portrait_3_4'){ return aq_resize( $img_url, 900, 1200, true, true, true);		}				// images for portfolio 4 columns
if($size == 'tn_portrait_2_3'){ return aq_resize( $img_url, 800, 1200, true, true, true);		}				// images for portfolio entries (2,3 column)
if($size == 'tn_portrait_9_16'){ return aq_resize( $img_url, 675, 1200, true, true, true);		}				// images for portfolio entries (2,3 column)
if($size == 'tn_portrait_2_4'){ return aq_resize( $img_url, 600, 1200, true, true, true);}				// images for magazines
if($size == 'cesis_full'){ return aq_resize( $img_url, 1200, 9999, false, true, true);		}				// images for masonry
if($size == 'tn_demo'){  return aq_resize( $img_url, 261, 174 , true, true, true);}                 // small image for blogs

}

}





if(!function_exists('cesis_gallery_block')){


	function cesis_gallery_block($array, $type, $size){

		$thumb_number = sizeof($array);
		$thumb_size = array();
		$thumb_ctn = array();

		if($thumb_number >= 6 ){
			$thumb_size[1] = 'tn_rectangle_3_2';
			$thumb_size[2] = 'tn_squared';
			$thumb_size[3] = 'tn_squared';
			$thumb_size[4] = 'tn_squared';
			$thumb_size[5] = 'tn_landscape_4_2';
			$thumb_size[6] = 'tn_squared';

			$thumb_ctn[1] = 'full';
			$thumb_ctn[2] = 'one_third';
			$thumb_ctn[3] = 'one_third';
			$thumb_ctn[4] = 'one_third';
			$thumb_ctn[5] = 'two_third';
			$thumb_ctn[6] = 'one_third';
		}elseif($thumb_number >= 5 ){
			$thumb_size[1] = 'tn_rectangle_3_2';
			$thumb_size[2] = 'tn_landscape_4_2';
			$thumb_size[3] = 'tn_squared';
			$thumb_size[4] = 'tn_squared';
			$thumb_size[5] = 'tn_landscape_4_2';

			$thumb_ctn[1] = 'full';
			$thumb_ctn[2] = 'two_third';
			$thumb_ctn[3] = 'one_third';
			$thumb_ctn[4] = 'one_third';
			$thumb_ctn[5] = 'two_third';
		}elseif($thumb_number >= 4 ){
			$thumb_size[1] = 'tn_rectangle_3_2';
			$thumb_size[2] = 'tn_squared';
			$thumb_size[3] = 'tn_squared';
			$thumb_size[4] = 'tn_squared';

			$thumb_ctn[1] = 'full';
			$thumb_ctn[2] = 'one_third';
			$thumb_ctn[3] = 'one_third';
			$thumb_ctn[4] = 'one_third';
		}elseif($thumb_number >= 3 ){
			$thumb_size[1] = 'tn_rectangle_3_2';
			$thumb_size[2] = 'tn_landscape_4_2';
			$thumb_size[3] = 'tn_squared';

			$thumb_ctn[1] = 'full';
			$thumb_ctn[2] = 'two_third';
			$thumb_ctn[3] = 'one_third';
		}elseif($thumb_number >= 2 ){
			$thumb_size[1] = 'tn_rectangle_4_2';
			$thumb_size[2] = 'tn_squared';

			$thumb_ctn[1] = 'two_third';
			$thumb_ctn[2] = 'one_third';
		}elseif($thumb_number >= 1 ){
			$thumb_size[1] = 'cesis_full';


			$thumb_ctn[1] = 'full';
		}
		$i = 1;
		$autoheight = 'no';
		if($size == 'full'){
			$autoheight = 'yes';
			$size = 'cesis_full';
		}
		if($type == 'carousel'){
			echo '<div class="cesis_owl_carousel cesis_iso_check" data-col="1" data-col_tablet="1" data-scroll="yes" data-col_mobile="1" data-margin="0" data-loop="yes" data-scroll="yes" data-autoheight="'.$autoheight.'">';
			while($i <= $thumb_number) {
		    	echo '<span class="cesis_gallery_img" data-src="'.wp_get_attachment_image_url( $array[$i-1], '' ).'"><img src="'.cesis_image_ratio( wp_get_attachment_image_url( $array[$i-1], '' ), $size ).'"/></span>';
			    $i++;
			}
			echo '</div>';
		}elseif($type == 'stacked'){
			while($i <= $thumb_number) {
		    	echo '<span class="cesis_gallery_img full" data-src="'.wp_get_attachment_image_url( $array[$i-1], '' ).'"><img src="'.cesis_image_ratio( wp_get_attachment_image_url( $array[$i-1], '' ), $size  ).'"/></span>';
			    $i++;
			}
		}else{
			while($i <= $thumb_number) {
		    	echo '<span class="cesis_gallery_img '.$thumb_ctn[$i].'" data-src="'.wp_get_attachment_image_url( $array[$i-1], '' ).'"><img src="'.cesis_image_ratio( wp_get_attachment_image_url( $array[$i-1], '' ), $thumb_size[$i] ).'"/></span>';
			    $i++;
				if($i == 7){
					$i = 1000;
				}
			}
		}
	}
}
