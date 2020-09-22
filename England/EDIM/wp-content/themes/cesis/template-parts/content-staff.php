<?php
/**
 * Template part for displaying staff posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cesis
 */

 global $cesis_data;


 $type = $cesis_data['cesis_staff_archive_type'];
 $style_ig = $cesis_data['cesis_staff_archive_style_ig'];
 $style_ip = $cesis_data['cesis_staff_archive_style_ip'];
 $hover = $cesis_data['cesis_staff_archive_hover'];
 $target = $cesis_data['cesis_staff_archive_target'];
 $i_author = $cesis_data['cesis_staff_archive_i_author'];
 $i_social = $cesis_data['cesis_staff_archive_i_social'];
 $i_text = $cesis_data['cesis_staff_archive_i_text'];
 $force_font = $cesis_data['cesis_staff_archive_force_font'];
 $text_source = $cesis_data['cesis_staff_archive_text_source'];
 $char_length = $cesis_data['cesis_staff_archive_char_length'];
 $thumbnail_size = $cesis_data['cesis_staff_archive_thumbnail_size'];
 $padding = $cesis_data['cesis_staff_archive_padding'];
 $new_padding = ($padding / 2);
 $inner_padding_ig = $cesis_data['cesis_staff_archive_inner_padding_ig'];
 $inner_padding_ip = $cesis_data['cesis_staff_archive_inner_padding_ip'];
 $effect = $cesis_data['cesis_staff_archive_effect'];


$h_f_size = $cesis_data["cesis_staff_archive_heading_font"]['font-size'];
$h_l_spacing = $cesis_data["cesis_staff_archive_heading_font"]['letter-spacing'];
$h_l_height = $cesis_data["cesis_staff_archive_heading_font"]['line-height'];
$h_t_transform = $cesis_data["cesis_staff_archive_heading_font"]['text-transform'];
$h_f_family = $cesis_data["cesis_staff_archive_heading_font"]['font-family'];
$h_f_weight = $cesis_data["cesis_staff_archive_heading_font"]['font-weight'];


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



 $animation = $cesis_data['cesis_staff_archive_animation'];
 if ($animation !== 'none'){
   $animation = 'wpb_animate_when_almost_visible wpb_' . $animation . ' ' . $animation;
 }
 if($type == 'isotope_grid'){
   $style = $style_ig;
   $layout = 'fitRows';
   $inner_padding = $inner_padding_ig;
   $iso_class = '';
 }elseif($type == 'isotope_packery'){
   $style = $style_ip;
   $layout = 'packery';
   $inner_padding = $inner_padding_ip;
 }


 $post_format = get_post_format();
 $custom_link = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_link" );
 $member_position = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_member_position" );
 $member_description = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_member_description" );
 if($custom_link !== ''){
   $link = $custom_link;
 }else{
   $link = get_permalink();
 }
 $socials = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_staff_social" );
 // hover settings
 if($hover == 'cesis_hover_overlay' || $hover == 'cesis_hover_overlay_social'){
   $hover_ctn = '<div class="cesis_overlay_ctn"></div>';
 }
 else{
   $hover_ctn = '';
 }
 // ohter settings
 if($style == 'cesis_staff_style_5' || $style == 'cesis_staff_style_6' || $style == 'cesis_staff_style_7'){
   $content_style = 'style=padding:'.$inner_padding.';';
 }
 else{
   $content_style = '';
 }
 if($effect == 'cesis_effect_frame' && $type == 'isotope_packery' && $padding !== '0'){
 $padding = $padding + 20;
 }

 if($type == 'isotope_packery'){
   $new_padding = '0';
   $packery_class = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_packery_size" );
   $thumb = get_the_post_thumbnail( get_the_ID(), 'tn_squared');
 }else{
   $thumb = get_the_post_thumbnail( get_the_ID(), $thumbnail_size);
   $packery_class = "";
 }
 $excerpt = get_the_excerpt();
 $cat_filter = "" ;
 $item_cat = "" ;
 $item_tag = "" ;
 $cat_list = get_the_terms(get_the_ID(), 'staff_group');
 if(is_array($cat_list) || is_object($cat_list)){
   foreach($cat_list as $cat_single) {
     $item_cat .= 'f_'.$cat_single->term_id.' ';
   }
 }
 $tag_list = get_the_terms(get_the_ID(), 'staff_tag');
 if(is_array($tag_list) || is_object($tag_list)){
   foreach($tag_list as $tag_single) {
     $item_tag .= 'f_'.$tag_single->term_id.' ';
   }
 }

 if($excerpt == ''){ $excerpt = cesis_content();}

?>

 <div class="cesis_iso_item <?php echo esc_attr($item_cat).' '.esc_attr($item_tag).' '.esc_attr($packery_class) ?>" style="padding:<?php echo esc_attr($new_padding) ?>px;">
 <div class="cesis_isotope_filter_data"><span class="isotope_filter_name"><?php echo the_title(); ?></span><span class="isotope_filter_date"><?php echo the_time('YmdHis'); ?></span></div>
 <div class="inside_e <?php echo esc_attr($animation)?>">

   <?php if($style !== 'cesis_staff_style_5' && $style !== 'cesis_staff_style_6' && $style !== 'cesis_staff_style_7'){
       ?>
       <div class="cesis_staff_m_thumbnail">
         <a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
         <?php echo $hover_ctn.' '.$thumb; ?>
         </a>
         <?php

         if($hover == 'cesis_hover_overlay_social' && !empty($socials)){
           echo '<div class="cesis_staff_social"><span>';
         foreach($socials as $key => $icon){

         echo '<a href="'.$icon["font-url"].'" class="'.$icon["font-suffix"].' '.$icon["font-icon"].'" target="'.$target.'"></a>';

         }
          echo '</span></div>';
         } ?>
       </div>

         <div class="cesis_staff_m_content">
         <h2 class="cesis_staff_m_title" style="<?php echo esc_attr($h_styles)?>"><a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>"><?php echo the_title(); ?></a></h2>
         <?php if($i_author == 'yes'){ ?>
         <div class="cesis_staff_m_position">
         <?php echo $member_position; ?>
         </div>
         <?php }
         if($i_text !== 'no' || $i_social !== 'no'){?>
         <div class="cesis_staff_m_info">
         <?php if($i_text == 'yes'){ ?>
           <div class="cesis_staff_m_entry">
         <?php if($text_source == 'content' && $char_length !== '' ){ echo cesis_text_truncate(cesis_content(), $char_length); }
         elseif($text_source == 'excerpt' && $char_length !== '' ){  echo cesis_text_truncate($excerpt, $char_length); }
         elseif($text_source == 'description' && $char_length !== '' ){  echo cesis_text_truncate($member_description, $char_length); }
         elseif($text_source == 'content'){ echo the_content(); }
         elseif($text_source == 'excerpt'){ echo $excerpt; }
         elseif($text_source == 'description'){echo $member_description;}?>
           </div>
          <?php }

          if($i_social == 'social_c' && !empty($socials)){
            echo '<div class="cesis_staff_social">';
          foreach($socials as $key => $icon){
            if($icon["font-suffix"] !== ''){
             echo '<a href="'.$icon["font-url"].'" class="'.$icon["font-suffix"].' '.$icon["font-icon"].'" target="'.$target.'"></a>';
            }
          }
           echo '</div>';
          }


           ?>
         </div>
         <?php } ?>
         </div>
   <?php } //start on image style
   else{
     if($thumb == ''){ $thumb = '<div class="no_img_placeholder"></div>'; } ?>
     <div class="cesis_staff_m_thumbnail">
             <a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
     <?php echo $thumb?>
     </a>
               <div class="cesis_staff_m_content on_image_style" <?php echo esc_attr($content_style) ?>>

                   <div class="cesis_staff_m_inner_content">


               <h2 class="cesis_staff_m_title title_filter" style="<?php echo esc_attr($h_styles)?>"><a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>"><?php echo the_title(); ?></a></h2>
               <?php if($i_author == 'yes'){ ?>
               <div class="cesis_staff_m_position">
               <?php echo $member_position; ?>
               </div>
               <?php }
               if($i_text !== 'no' || $i_social !== 'no'){?>

               <div class="cesis_staff_m_info">
               <?php if($i_text == 'yes'){ ?>
                 <div class="cesis_staff_m_entry">
                 <?php if($text_source == 'content' && $char_length !== '' ){ echo cesis_text_truncate(cesis_content(), $char_length); }
         elseif($text_source == 'description' && $char_length !== '' ){  echo cesis_text_truncate($member_description, $char_length); }
         elseif($text_source == 'content'){ echo the_content(); }
         elseif($text_source == 'description'){echo $member_description;}?>
                 </div>
               <?php }

               if($i_social == 'social_c' && !empty($socials) ){
                 echo '<div class="cesis_staff_social">';
               foreach($socials as $key => $icon){
                 if($icon["font-suffix"] !== ''){
                 echo '<a href="'.$icon["font-url"].'" class="'.$icon["font-suffix"].' '.$icon["font-icon"].'" target="'.$target.'"></a>';
                 }
               }
                echo '</div>';
               }

              ?>
                 </div>

               <?php } ?>
               </div>
                 </div>

               </div>
               <?php } ?>
             </div>
           </div>
