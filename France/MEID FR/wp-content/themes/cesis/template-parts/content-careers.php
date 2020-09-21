<?php
/**
 * Template part for displaying career post.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cesis
 */

 global $cesis_data;



 $type = 'isotope_grid';
 $style = $cesis_data['cesis_career_archive_style'];
 $hover = $cesis_data['cesis_career_archive_hover'];
 $hover_color = $cesis_data['cesis_career_archive_hover_color']['rgba'];
 $effect = $cesis_data['cesis_career_archive_effect'];
 $force_font = $cesis_data['cesis_career_archive_force_font'];
 $thumbnail_size = $cesis_data['cesis_career_archive_thumbnail_size'];
 $padding = $cesis_data['cesis_career_archive_padding'];
 $target = $cesis_data['cesis_career_archive_target'];
 $i_location = $cesis_data['cesis_career_archive_i_location'];
 $i_date = $cesis_data['cesis_career_archive_i_date'];
 $i_category = $cesis_data['cesis_career_archive_i_category'];
 $i_text = $cesis_data['cesis_career_archive_i_text'];
 $text_source = $cesis_data['cesis_career_archive_text_source'];
 $char_length = $cesis_data['cesis_career_archive_char_length'];
 $read_more = $cesis_data['cesis_career_archive_read_more'];
 $read_more_style = $cesis_data['cesis_career_archive_read_more_style'];
 $read_more_button_style = $cesis_data['cesis_career_archive_read_more_button_style'];
 $rm_t_font = $cesis_data['cesis_career_archive_rm_t_font'];
 $rm_t_f_weight = $cesis_data['cesis_career_archive_rm_t_f_weight'];
 $rm_t_t_transform = $cesis_data['cesis_career_archive_rm_t_t_transform'];
 $rm_t_l_spacing = $cesis_data['cesis_career_archive_rm_t_l_spacing'];
 $rm_font = $cesis_data['cesis_career_archive_rm_font'];
 $rm_f_size = $cesis_data['cesis_career_archive_rm_f_size'];
 $rm_f_weight = $cesis_data['cesis_career_archive_rm_f_weight'];
 $rm_t_transform = $cesis_data['cesis_career_archive_rm_t_transform'];
 $rm_l_spacing = $cesis_data['cesis_career_archive_rm_l_spacing'];
 $rm_b_size = $cesis_data['cesis_career_archive_rm_b_size'];
 $rm_b_radius = $cesis_data['cesis_career_archive_rm_b_radius'];
 $rm_b_shape = $cesis_data['cesis_career_archive_rm_shape'];
 $rm_t_color = $cesis_data['cesis_career_archive_rm_t_color'];
 $rm_bg_color = $cesis_data['cesis_career_archive_rm_bg_color'];
 $rm_b_color = $cesis_data['cesis_career_archive_rm_b_color'];
 $rm_ht_color = $cesis_data['cesis_career_archive_rm_ht_color'];
 $rm_hbg_color = $cesis_data['cesis_career_archive_rm_hbg_color'];
 $rm_hb_color = $cesis_data['cesis_career_archive_rm_hb_color'];
 $padding = $cesis_data['cesis_career_archive_padding'];
 $new_padding = ($padding / 2);
 $effect = $cesis_data['cesis_career_archive_effect'];
 $animation = $cesis_data['cesis_career_archive_animation'];

$h_f_size = $cesis_data["cesis_career_archive_heading_font"]['font-size'];
$h_l_spacing = $cesis_data["cesis_career_archive_heading_font"]['letter-spacing'];
$h_l_height = $cesis_data["cesis_career_archive_heading_font"]['line-height'];
$h_t_transform = $cesis_data["cesis_career_archive_heading_font"]['text-transform'];
$h_f_family = $cesis_data["cesis_career_archive_heading_font"]['font-family'];
$h_f_weight = $cesis_data["cesis_career_archive_heading_font"]['font-weight'];


 if ($animation !== 'none'){
   $animation = 'wpb_animate_when_almost_visible wpb_' . $animation . ' ' . $animation;
 }


			// Font settings
			if($force_font == 'custom'){

			$h_styles = 'font-size:'.$h_f_size.'; ';
			$h_styles .= 'letter-spacing:'.$h_l_spacing.'px; ';
			$h_styles .= 'line-height:'.$h_l_height.'; ';
			$h_styles .= 'text-transform:'.$h_t_transform.'; ';
			$h_styles .= 'font-family:' . $h_f_family.'; ';
			$h_styles .= 'font-weight:' .$h_f_weight.'; ';


		}else{
			$h_styles = '';
		}


   $layout = 'fitRows';

// other options settings

if($style == 'cesis_career_style_9' || $style == 'cesis_career_style_10' || $style == 'cesis_career_style_11' || $style == 'cesis_career_style_12' || $style == 'cesis_career_style_13' ){
  $content_style = 'style=padding:'.$inner_padding.';';
}
else{
  $content_style = '';
}
if($effect == 'cesis_effect_frame' && $type == 'isotope_packery' && $padding !== '0'){
$padding = $padding + 20;
}
$new_padding = ($padding / 2);

if($read_more_style == 'text'){

  $rm_style = 'style="font-weight:'.$rm_t_f_weight.'; letter-spacing:'.$rm_t_l_spacing.'px; text-transform:'.$rm_t_t_transform.';';
  $rm_class = $rm_t_font.' ';

}
if($read_more_style == 'button_rm' && $read_more_button_style == 'custom'){

  $rm_style = 'onmouseleave="this.style.borderColor=\''.$rm_b_color.'\'; this.style.backgroundColor=\''.$rm_bg_color.'\'; this.style.color=\''.$rm_t_color.'\';" onmouseenter="this.style.borderColor=\''.$rm_hb_color.'\'; this.style.backgroundColor=\''.$rm_hbg_color.'\'; this.style.color=\''.$rm_ht_color.'\';" style="font-size:'.$rm_f_size.'px; font-weight:'.$rm_f_weight.'; letter-spacing:'.$rm_l_spacing.'px; text-transform:'.$rm_t_transform.'; color:'.$rm_t_color.'; background:'.$rm_bg_color.'; border-color:'.$rm_b_color.'; border-radius:'.$rm_b_radius.'px"';
  $rm_style_default = 'font-size:'.$rm_f_size.'px; font-weight:'.$rm_f_weight.'; letter-spacing:'.$rm_l_spacing.'px; text-transform:'.$rm_t_transform.'; color:'.$rm_t_color.'; background:'.$rm_bg_color.'; border-color:'.$rm_b_color.'; border-radius:'.$rm_b_radius.'px';
  $rm_class = $rm_b_size.' '.$rm_font.' ';
}elseif($read_more_style == 'button_rm'){
  $rm_style_default = $rm_style = '';
  $rm_class = $read_more_button_style.' '.$rm_b_size.' '.$rm_b_shape.' ';
}

  						$post_format = get_post_format();
    					$custom_link = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_link" );
    					$thumb = get_post_thumbnail_id();
    					$img_url = wp_get_attachment_url( $thumb,'full' );
    					$career_date = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_career_date" );
    					$career_location = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_career_location" );
    					$career_description = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_career_description" );
    					if($custom_link !== ''){
    						$link = $custom_link;
    					}else{
    						$link = get_permalink();
    					}
  					$u_color = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_unique_color" );
  					// gallery information
  					$gallery_data = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_gallery" );
  					$gallery_type = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_gallery_type" );
  					$gallery_size = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_gallery_size" );
  					$gallery_array = explode(',', $gallery_data);
  					// audio information
  					$audio_file = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_file" );
  					$audio_loop = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_loop" );
  					$audio_autoplay = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_autoplay" );
  					$audio_preload = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_preload" );
  					$audio_iframe = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_iframe" );
  					// video information
  					$video_data = "";
  					$video_mp4 = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_mp4" );
  					$video_m4v = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_m4v" );
  					$video_webm = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_webm" );
  					$video_ogv = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_ogv" );
  					$video_wmv = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_wmv" );
  					$video_flv = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_flv" );
  					$video_loop = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_loop" );
  					$video_autoplay = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_autoplay" );
  					$video_preload = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_preload" );
  					$video_iframe = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_iframe" );
  					if($video_mp4 !== '' || $video_m4v !== '' || $video_webm !== '' || $video_ogv !== '' || $video_wmv !== '' || $video_flv !== '' || $video_iframe !== ''){
  						$video_data = 'yes';
  					}
  					// hover settings
            if($hover == 'cesis_hover_overlay' ){
              $hover_ctn = '<div class="cesis_overlay_ctn"></div>';
		        }else{
              $hover_ctn = '';
					  }
  					// ohter settings
            $thumb = '<img src="'.cesis_image_ratio( $img_url, $thumbnail_size).'"/>';

  					$excerpt = get_the_excerpt();
  					$cat_filter = "" ;
  					$item_cat = "" ;
  					$item_tag = "" ;
  					$cat_list = get_the_terms(get_the_ID(),  'career_category');
  					if(is_array($cat_list) || is_object($cat_list)){
  						foreach($cat_list as $cat_single) {
  							$item_cat .= 'f_'.$cat_single->term_id.' ';
  						}
  				  }
  					if($excerpt == ''){ $excerpt = cesis_content();}

  				?>
  						<div class="cesis_iso_item <?php echo esc_attr($item_cat)?>" style="padding:<?php echo esc_attr($new_padding) ?>px;">
  						<div class="cesis_isotope_filter_data"><span class="isotope_filter_name"><?php echo the_title(); ?></span><span class="isotope_filter_date"><?php echo the_time('YmdHis'); ?></span></div>
  						<div class="inside_e <?php echo esc_attr($animation)?>">
  								<div class="cesis_career_m_thumbnail">
  									<a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
  									<?php echo $hover_ctn.' '.$thumb;
  									?>

  									</a>
  									<?php
  									if($i_date !== '' || $i_location !== '' || $i_category !== '' ){
  										echo '<div class="cesis_career_m_info">';
  										if($i_location !== 'no' && $career_location !== '' ){
  											echo '<span class="cesis_career_m_location">'.$career_location.'</span>';
  										}
  										if($i_category !== 'no' && $cat_list !== '' ){
  											echo '<span class="cesis_career_m_categories">'.get_the_term_list('','career_category', '',' ','').'</span>';
  										}
  										if($i_date !== 'no' && $career_date !== ''){
  											echo '<span class="cesis_career_m_date">'.$career_date.'</span>';
  										}
  									 echo '</div>';
  								 	} ?>
  								</div>

                    <div class="cesis_career_m_content">
                		<h2 class="cesis_career_m_title  <?php echo esc_attr($heading_font)?>"><a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>"><?php echo the_title(); ?></a></h2>
  									<?php
  									if($i_text !== 'no' ){?>
                		<?php if($i_text == 'yes'){ ?>
                    	<div class="cesis_career_m_entry">
                  	<?php if($text_source == 'content' && $char_length !== '' ){ echo cesis_text_truncate(cesis_content(), $char_length); }
  							   	elseif($text_source == 'description' && $char_length !== '' ){  echo cesis_text_truncate($career_description, $char_length); }
  							   	elseif($text_source == 'content'){ echo the_content(); }
  									elseif($text_source == 'description'){echo $career_description;}?>
  		              	</div>
  		               <?php }
  									 if($read_more == 'yes'){ ?>
  										 <div class="cesis_m_more_link">
  										 <?php
  					 				 		echo '<a href="'.$link.'" class="'.$rm_class.'" '.$rm_style.' target="'.$target.'">'.__('Read more', 'cesis').'</a>';
  					 						?>
  										 </div>
  									 <?php } ?>
  								<?php } ?>
                    </div>
 							</div>
 						</div>
