<?php
/**
 * Template part for displaying Portfolio posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cesis
 */

 global $cesis_data;


 $type = $cesis_data['cesis_portfolio_archive_type'];
 $style_ig = $cesis_data['cesis_portfolio_archive_style_ig'];
 $style_im = $cesis_data['cesis_portfolio_archive_style_im'];
 $style_ip = $cesis_data['cesis_portfolio_archive_style_ip'];
 $hover = $cesis_data['cesis_portfolio_archive_hover'];
 $target = $cesis_data['cesis_portfolio_archive_target'];
 $i_date = $cesis_data['cesis_portfolio_archive_i_date'];
 $i_category = $cesis_data['cesis_portfolio_archive_i_category'];
 $i_tag = $cesis_data['cesis_portfolio_archive_i_tag'];
 $i_comment = $cesis_data['cesis_portfolio_archive_i_comment'];
 $i_like = $cesis_data['cesis_portfolio_archive_i_like'];
 $i_text = $cesis_data['cesis_portfolio_archive_i_text'];
 $force_font = $cesis_data['cesis_portfolio_archive_force_font'];
 $text_source = $cesis_data['cesis_portfolio_archive_text_source'];
 $char_length = $cesis_data['cesis_portfolio_archive_char_length'];
 $thumbnail_size = $cesis_data['cesis_portfolio_archive_thumbnail_size'];
 $packery_type = $cesis_data['cesis_portfolio_archive_packery_type'];
 $read_more = $cesis_data['cesis_portfolio_archive_read_more'];
 $read_more_style = $cesis_data['cesis_portfolio_archive_read_more_style'];
 $read_more_button_style = $cesis_data['cesis_portfolio_archive_read_more_button_style'];
 $rm_t_font = $cesis_data['cesis_portfolio_archive_rm_t_font'];
 $rm_t_f_weight = $cesis_data['cesis_portfolio_archive_rm_t_f_weight'];
 $rm_t_t_transform = $cesis_data['cesis_portfolio_archive_rm_t_t_transform'];
 $rm_t_l_spacing = $cesis_data['cesis_portfolio_archive_rm_t_l_spacing'];
 $rm_font = $cesis_data['cesis_portfolio_archive_rm_font'];
 $rm_f_size = $cesis_data['cesis_portfolio_archive_rm_f_size'];
 $rm_f_weight = $cesis_data['cesis_portfolio_archive_rm_f_weight'];
 $rm_t_transform = $cesis_data['cesis_portfolio_archive_rm_t_transform'];
 $rm_l_spacing = $cesis_data['cesis_portfolio_archive_rm_l_spacing'];
 $rm_b_size = $cesis_data['cesis_portfolio_archive_rm_b_size'];
 $rm_b_radius = $cesis_data['cesis_portfolio_archive_rm_b_radius'];
 $rm_b_shape = $cesis_data['cesis_portfolio_archive_rm_shape'];
 $rm_t_color = $cesis_data['cesis_portfolio_archive_rm_t_color'];
 $rm_bg_color = $cesis_data['cesis_portfolio_archive_rm_bg_color'];
 $rm_b_color = $cesis_data['cesis_portfolio_archive_rm_b_color'];
 $rm_ht_color = $cesis_data['cesis_portfolio_archive_rm_ht_color'];
 $rm_hbg_color = $cesis_data['cesis_portfolio_archive_rm_hbg_color'];
 $rm_hb_color = $cesis_data['cesis_portfolio_archive_rm_hb_color'];
 $padding = $cesis_data['cesis_portfolio_archive_padding'];
 $new_padding = ($padding / 2);
 $inner_padding_ig = $cesis_data['cesis_portfolio_archive_inner_padding_ig'];
 $inner_padding_ip = $cesis_data['cesis_portfolio_archive_inner_padding_ip'];
 $effect = $cesis_data['cesis_portfolio_archive_effect'];


$h_f_size = $cesis_data["cesis_portfolio_archive_heading_font"]['font-size'];
$h_l_spacing = $cesis_data["cesis_portfolio_archive_heading_font"]['letter-spacing'];
$h_l_height = $cesis_data["cesis_portfolio_archive_heading_font"]['line-height'];
$h_t_transform = $cesis_data["cesis_portfolio_archive_heading_font"]['text-transform'];
$h_f_family = $cesis_data["cesis_portfolio_archive_heading_font"]['font-family'];
$h_f_weight = $cesis_data["cesis_portfolio_archive_heading_font"]['font-weight'];


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


 $animation = $cesis_data['cesis_portfolio_archive_animation'];
 if ($animation !== 'none'){
   $animation = 'wpb_animate_when_almost_visible wpb_' . $animation . ' ' . $animation;
 }
 if($type == 'isotope_grid'){
   $style = $style_ig;
   $layout = 'fitRows';
   $inner_padding = $inner_padding_ig;
 }elseif($type == 'isotope_masonry'){
   $style = $style_im;
   $layout = 'packery';
   $thumbnail_size = 'cesis_full';
   $inner_padding = "";
 }elseif($type == 'isotope_packery'){
   $style = $style_ip;
   $layout = 'packery';
   $inner_padding = $inner_padding_ip;
 }else{
   $style = $style_ig;
   $inner_padding = $inner_padding_ig;
 }
 if($read_more_style == 'text'){
 	$rm_style = 'style="font-weight:'.$rm_t_f_weight.'; letter-spacing:'.$rm_t_l_spacing.'px; text-transform:'.$rm_t_t_transform.';';
 	$rm_class = $rm_t_font.' ';
 }
 if($read_more_style == 'button_rm' && $read_more_button_style == 'custom'){
	$rm_style = 'onmouseleave="this.style.borderColor=\''.$rm_b_color.'\'; this.style.backgroundColor=\''.$rm_bg_color.'\'; this.style.color=\''.$rm_t_color.'\';" onmouseenter="this.style.borderColor=\''.$rm_hb_color.'\'; this.style.backgroundColor=\''.$rm_hbg_color.'\'; this.style.color=\''.$rm_ht_color.'\';" style="font-size:'.$rm_f_size.'px; font-weight:'.$rm_f_weight.'; letter-spacing:'.$rm_l_spacing.'px; text-transform:'.$rm_t_transform.'; color:'.$rm_t_color.'; background:'.$rm_bg_color.'; border-color:'.$rm_b_color.'; border-radius:'.$rm_b_radius.'px"';
 	$rm_class = $rm_b_size.' '.$rm_font.' ';
 }elseif($read_more_style == 'button_rm'){
	$rm_style = '';
 	$rm_class = $read_more_button_style.' '.$rm_b_size.' '.$rm_b_shape.' ';
 }

 					$post_format = get_post_format();
 					$custom_link = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_link" );
          $thumb = get_post_thumbnail_id();
          $img_url = wp_get_attachment_url( $thumb,'full' );
					$project_description = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_description" );
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
 					if($hover == 'cesis_hover_overlay'){
 						$hover_ctn = '<div class="cesis_overlay_ctn"></div>';
 					}
 					elseif($hover == 'cesis_hover_icon'){
 						$hover_ctn = '<div class="cesis_overlay_ctn"><span class="cesis_hover_zoom" data-src="'.wp_get_attachment_image_url(  get_post_thumbnail_id(get_the_ID()), '' ).'"><span class="cesis_eye_icon"></span></span>
 						<span class="cesis_hover_link"><span class="cesis_dots_icon"></span></span>
 						</div>';
 					}
 					else{
 						$hover_ctn = '';
 					}

          // ohter settings
           if($effect == 'cesis_effect_frame' && $type == 'isotope_packery' && $padding !== '0'){
           $padding = $padding + 20;
           }
           if($style == 'cesis_portfolio_style_7' || $style == 'cesis_portfolio_style_8' || $style == 'cesis_portfolio_style_9' || $style == 'cesis_portfolio_style_10' || $style == 'cesis_portfolio_style_11' ){
             $content_style = 'style=padding:'.$inner_padding.';';
           }
           else{
          	 $content_style = '';
           }
          if($type == 'isotope_packery'){
            $packery_class = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_packery_size" );
            $new_padding = '0';
            if($packery_type == "squared"){
              if($packery_class == 'cesis_packery_squared' || $packery_class == 'cesis_packery_big_squared'){
                $thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_squared').'"/>';
              }
              if($packery_class == 'cesis_packery_landscape'){
                $thumb = '<img src="'.cesis_image_ratio($img_url, 'tn_landscape_4_2').'"/>';
              }
              if($packery_class == 'cesis_packery_portrait'){
                $thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_portrait_2_4').'"/>';
              }
            }else{
              if($packery_class == 'cesis_packery_squared' || $packery_class == 'cesis_packery_big_squared'){
                $thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_rectangle_4_3').'"/>';
              }
              if($packery_class == 'cesis_packery_landscape'){
                $thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_landscape_8_3').'"/>';
              }
              if($packery_class == 'cesis_packery_portrait'){
                $thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_portrait_2_3').'"/>';
              }
            }
          }else{

            $thumb = '<img src="'.cesis_image_ratio( $img_url, $thumbnail_size).'"/>';
            $packery_class = "";
          }
 					$excerpt = get_the_excerpt();
 					$cat_filter = "" ;
 					$item_cat = "" ;
 					$item_tag = "" ;
 					$cat_list = get_the_terms(get_the_ID(), 'portfolio_category');
 					if(is_array($cat_list) || is_object($cat_list)){
 						foreach($cat_list as $cat_single) {
 							$item_cat .= 'f_'.$cat_single->term_id.' ';
 						}
 				  }
 					$tag_list = get_the_terms(get_the_ID(), 'portfolio_tag');
 					if(is_array($tag_list) || is_object($tag_list)){
 						foreach($tag_list as $tag_single) {
 							$item_tag .= 'f_'.$tag_single->term_id.' ';
 						}
 				  }
 					if($excerpt == ''){ $excerpt = cesis_content();}

 					if($style == 'cesis_portfolio_style_2' || $style == 'cesis_portfolio_style_5' || $style == 'cesis_portfolio_style_3' || $style == 'cesis_portfolio_style_6' || $style == 'cesis_portfolio_style_9' || $style == 'cesis_portfolio_style_10'  || $style == 'cesis_portfolio_style_11' ){
 						$cat_list = '<span class="cesis_portfolio_m_category">'.get_the_term_list('','portfolio_category', '',', ','').'</span>';
 						$tag_list = '<span class="cesis_portfolio_m_tag">'.get_the_term_list('','portfolio_tag', '',', ','').'</span>';
 					}else{
 						$cat_list = '<span class="cesis_portfolio_m_category">'.get_the_term_list('','portfolio_category', '',' ','').'</span>';
 						$tag_list = '<span class="cesis_portfolio_m_tag">'.get_the_term_list('','portfolio_tag', '',' ','').'</span>';
 					}

 					$author = '<span class="cesis_portfolio_m_author">'.get_the_author_link().'</span>';
 					$date = '<span class="cesis_portfolio_m_date">'.get_the_time(get_option('date_format')).'</span>';
 					$comments = '<span class="cesis_portfolio_m_comment">'.cesis_get_comments().'</span>';
 					$like = '<span class="cesis_portfolio_m_author">'.get_the_author_link().'</span>';

 				?>
   <div class="cesis_iso_item <?php echo esc_attr($item_cat).' '.esc_attr($item_tag).' '.esc_attr($packery_class) ?>" style="padding:<?php echo esc_attr($new_padding) ?>px;">
   <div class="cesis_isotope_filter_data"><span class="isotope_filter_name"><?php echo the_title(); ?></span><span class="isotope_filter_date"><?php echo the_time('YmdHis'); ?></span></div>
   <div class="inside_e <?php echo esc_attr($animation) ?>">

   <?php if($style !== 'cesis_portfolio_style_7' && $style !== 'cesis_portfolio_style_8' && $style !== 'cesis_portfolio_style_9' && $style !== 'cesis_portfolio_style_10' && $style !== 'cesis_portfolio_style_11'  ){


   if($type !== 'isotope_grid'){
     if($thumb !== '' && $post_format == '' || $thumb !== '' && $post_format == 'image' ){ ?>
         <div class="cesis_portfolio_m_thumbnail">
           <a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
           <?php echo $hover_ctn.' '.$thumb?>
           </a>
         </div>
       <?php }elseif($gallery_data !== '' && $post_format == 'gallery' ){ ?>
         <div class="cesis_portfolio_m_thumbnail cesis_portfolio_gallery_<?php echo esc_attr($gallery_type); ?>">
           <?php cesis_gallery_block($gallery_array, $gallery_type, $gallery_size); ?>
         </div>
       <?php }elseif($audio_file !== '' && $post_format == 'audio' ){ ?>
         <div class="cesis_audio_ctn">
           <?php if($audio_iframe == ''){
                   cesis_audio_file($audio_file,$audio_loop,$audio_autoplay,$audio_preload);
                 }else{
                   echo $audio_iframe;
                 } ?>
         </div>
       <?php }elseif($video_data == 'yes' && $post_format == 'video' ){ ?>
         <?php if($video_iframe == ''){
           echo '<div class="cesis_video_ctn">';
           cesis_video_file($video_mp4,$video_m4v,$video_webm,$video_ogv,$video_wmv,$video_flv,$video_loop,$video_autoplay,$video_preload);
         }else{
           echo '<div class="cesis_video_ctn framed">';
           echo $video_iframe;
         } ?>
         </div>
       <?php }
   }else{?>
       <div class="cesis_portfolio_m_thumbnail">
         <a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
         <?php echo $hover_ctn.' '.$thumb?>
         </a>
       </div>
   <?php }	 ?>

         <div class="cesis_portfolio_m_content">
<?php if(  $i_category == 'yes' && $style == 'cesis_portfolio_style_1' || $i_tag == 'yes' && $style == 'cesis_portfolio_style_1' || $i_category == 'yes' && $style == 'cesis_portfolio_style_4' || $i_tag == 'yes' && $style == 'cesis_portfolio_style_4'){ ?>
                 <div class="cesis_portfolio_m_bt_info">
                 <?php

       if($i_category == 'yes'  ){echo $cat_list;}
       if($i_tag == 'yes' ){echo $tag_list;}
       ?>
                 </div>
               <?php } ?>
         <h2 class="cesis_portfolio_m_title <?php echo esc_attr($heading_font)?>"><a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>"><?php echo the_title(); ?></a></h2>
<?php if( $i_date == 'yes' || $i_category == 'yes' && $style !== 'cesis_portfolio_style_1' && $style !== 'cesis_portfolio_style_4' || $i_tag == 'yes' && $style !== 'cesis_portfolio_style_1' && $style !== 'cesis_portfolio_style_4' || $i_comment == 'yes' || $i_like == 'yes'){ ?>
                 <div class="cesis_portfolio_m_top_info">
                 <?php

       if($i_category == 'yes' && $style !== 'cesis_portfolio_style_1' && $style !== 'cesis_portfolio_style_4'){echo $cat_list;}
       if($i_tag == 'yes' && $style !== 'cesis_portfolio_style_1' && $style !== 'cesis_portfolio_style_4'){echo $tag_list;}
       if($i_date == 'yes' ){echo $date;}
       if($i_comment == 'yes' && $style !== 'cesis_portfolio_style_1' && $style !== 'cesis_portfolio_style_4'){echo $comments;}
       if($i_like == 'yes' && function_exists('zilla_likes') && $style !== 'cesis_portfolio_style_1' && $style !== 'cesis_portfolio_style_4'){	echo do_shortcode('[zilla_likes]');}
       ?>
                 </div>
               <?php } ?>
               <?php if($i_text == 'yes'){ ?>
                 <div class="cesis_portfolio_m_entry">
                 <?php if($text_source == 'content' && $char_length !== '' ){ echo cesis_text_truncate(cesis_content(), $char_length); }
         elseif($text_source == 'description' && $char_length !== '' ){  echo cesis_text_truncate($project_description, $char_length); }
         elseif($text_source == 'content'){ echo the_content(); }
         elseif($text_source == 'description'){echo $project_description;}?>
                 </div>
               <?php } ?>
               <?php if($read_more == 'yes'){ ?>
                 <div class="cesis_m_more_link">
                 <?php
       echo '<a href="'.$link.'" class="'.$rm_class.'" '.$rm_style.' target="'.$target.'">'.__('Read more', 'cesis').'</a>';
       ?>
                 </div>
               <?php } ?>
               <?php if($style == 'cesis_portfolio_style_1' || $style == 'cesis_portfolio_style_4' ){
       if($i_comment == 'yes' || $i_like == 'yes'){  ?>
                   <div class="cesis_portfolio_m_bottom_info">
                   <?php
         if($i_comment == 'yes'){echo $comments;}
         if($i_like == 'yes' && function_exists('zilla_likes') ){	echo do_shortcode('[zilla_likes]');}
         ?>
                   </div>
               <?php }
     }
               ?>
               </div>
   <?php } //start on image style
   else{
     if($thumb == ''){ $thumb = '<div class="no_img_placeholder"></div>'; } ?>
     <div class="cesis_portfolio_m_thumbnail">
             <a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
     <?php echo $thumb?>
     </a>
               <div class="cesis_portfolio_m_content on_image_style" <?php echo esc_attr($content_style) ?>>

                   <div class="cesis_portfolio_m_inner_content">


               <h2 class="cesis_portfolio_m_title title_filter" style="<?php echo esc_attr($h_styles)?>"><a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>"><?php echo the_title(); ?></a></h2>
     <?php if( $i_date == 'yes' || $i_category == 'yes' || $i_tag == 'yes' || $i_comment == 'yes' || $i_like == 'yes' ){ ?>
                 <div class="cesis_portfolio_m_top_info">
                 <?php
       if($i_category == 'yes'){echo $cat_list;}
       if($i_tag == 'yes'){echo $tag_list;}
       if($i_date == 'yes' ){echo $date;}
       if($i_comment == 'yes'){echo $comments;}
       if($i_like == 'yes' && function_exists('zilla_likes') ){	echo do_shortcode('[zilla_likes]');}
       ?>
                 </div>
               <?php } ?>
               <?php if($i_text == 'yes'){ ?>
                 <div class="cesis_portfolio_m_entry">
                 <?php if($text_source == 'content' && $char_length !== '' ){ echo cesis_text_truncate(cesis_content(), $char_length); }
         elseif($text_source == 'description' && $char_length !== '' ){  echo cesis_text_truncate($project_description, $char_length); }
         elseif($text_source == 'content'){ echo the_content(); }
         elseif($text_source == 'description'){echo $project_description;}?>
                 </div>
               <?php } ?>
               <?php if($read_more == 'yes'){ ?>
                 <div class="cesis_m_more_link">
                 <?php
       echo '<a href="'.$link.'" class="'.$rm_class.'" '.$rm_style.' target="'.$target.'">'.__('Read more', 'cesis').'</a>';
       ?>
                 </div>
               <?php } ?>
                   </div>
               </div>
                   </div>







               <?php } ?>
               </div>
             </div>
