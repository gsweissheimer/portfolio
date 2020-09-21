<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cesis
 */

 global $cesis_data;
 global $cesis_post;
 $output = $t_styles = '';
 $id = RandomString(20);

 get_header();
$sidebar_expand = $generate_sidebar = '';

if(get_post_type() == 'post'){
  $banner_type = $cesis_data['cesis_post_a_banner'];
  $banner_pos = $cesis_data['cesis_post_a_banner_pos'];
  $blockid = $cesis_data['cesis_post_a_block_content'];
  $sliderid = $cesis_data['cesis_post_a_rev_slider'];
	$layersliderid = $cesis_data['cesis_post_a_layer_slider'];
 	$use_title = $cesis_data['cesis_post_a_title'];
  $page_layout = $cesis_data['cesis_blog_archive_layout'];
  $nav_style = $cesis_data['cesis_blog_archive_navigation_style'];
  $nav_pos = $cesis_data['cesis_blog_archive_navigation_pos'];
  $nav_top_space = $cesis_data['cesis_blog_archive_navigation_space']["height"];

  /* Archive options */

  $type = $cesis_data['cesis_blog_archive_type'];
  $col = $cesis_data['cesis_blog_archive_col'];
  $style_ig = $cesis_data['cesis_blog_archive_style_ig'];
  $style_im = $cesis_data['cesis_blog_archive_style_im'];
  $style_ip = $cesis_data['cesis_blog_archive_style_ip'];
  $hover = $cesis_data['cesis_blog_archive_hover'];
  $hover_color = $cesis_data['cesis_blog_archive_hover_color']['rgba'];
  $effect = $cesis_data['cesis_blog_archive_effect'];
  $force_font = $cesis_data['cesis_blog_archive_force_font'];
  $thumbnail_size = $cesis_data['cesis_blog_archive_thumbnail_size'];
  $packery_type = $cesis_data['cesis_blog_archive_packery_type'];
  $padding = $cesis_data['cesis_blog_archive_padding'];
  $inner_padding_ig = $cesis_data['cesis_blog_archive_inner_padding_ig'];
  $inner_padding_ip = $cesis_data['cesis_blog_archive_inner_padding_ip'];
  $target = $cesis_data['cesis_blog_archive_target'];
  $i_author = $cesis_data['cesis_blog_archive_i_author'];
  $i_date = $cesis_data['cesis_blog_archive_i_date'];
  $i_category = $cesis_data['cesis_blog_archive_i_category'];
  $i_tag = $cesis_data['cesis_blog_archive_i_tag'];
  $i_comment = $cesis_data['cesis_blog_archive_i_comment'];
  $i_like = $cesis_data['cesis_blog_archive_i_like'];
  $i_text = $cesis_data['cesis_blog_archive_i_text'];
  $text_source = $cesis_data['cesis_blog_archive_text_source'];
  $char_length = $cesis_data['cesis_blog_archive_char_length'];
  $m_bg_color = $cesis_data['cesis_main_content_bg'];
  $background_setting = '';
  $m_mbg_color = $cesis_data['cesis_main_content_bg'];


$t_f_size = $cesis_data["cesis_blog_archive_text_font"]['font-size'];
$t_l_spacing = $cesis_data["cesis_blog_archive_text_font"]['letter-spacing'];
$t_l_height = $cesis_data["cesis_blog_archive_text_font"]['line-height'];
$t_t_transform = $cesis_data["cesis_blog_archive_text_font"]['text-transform'];
$t_f_family = $cesis_data["cesis_blog_archive_text_font"]['font-family'];
$t_f_weight = $cesis_data["cesis_blog_archive_text_font"]['font-weight'];

	// Font settings
  if($force_font == 'custom'){

  $t_styles = 'font-size:'.$t_f_size.'; ';
  $t_styles .= 'letter-spacing:'.$t_l_spacing.'px; ';
  $t_styles .= 'line-height:'.$t_l_height.'; ';
  $t_styles .= 'text-transform:'.$t_t_transform.'; ';
  $t_styles .= 'font-family:' . $t_f_family.'; ';
  $t_styles .= 'font-weight:' .$t_f_weight.'; ';
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

}

elseif(get_post_type() == 'portfolio'){
  $banner_type = $cesis_data['cesis_portfolio_a_banner'];
  $banner_pos = $cesis_data['cesis_portfolio_a_banner_pos'];
  $blockid = $cesis_data['cesis_portfolio_a_block_content'];
  $sliderid = $cesis_data['cesis_portfolio_a_rev_slider'];
  $layersliderid = $cesis_data['cesis_portfolio_a_layer_slider'];
  $use_title = $cesis_data['cesis_portfolio_a_title'];
  $page_layout = $cesis_data['cesis_portfolio_archive_layout'];
  $nav_style = $cesis_data['cesis_portfolio_archive_navigation_style'];
  $nav_pos = $cesis_data['cesis_portfolio_archive_navigation_pos'];
  $nav_top_space = $cesis_data['cesis_portfolio_archive_navigation_space']["height"];

  /* Archive options */

  $type = $cesis_data['cesis_portfolio_archive_type'];
  $col = $cesis_data['cesis_portfolio_archive_col'];
  $style_ig = $cesis_data['cesis_portfolio_archive_style_ig'];
  $style_im = $cesis_data['cesis_portfolio_archive_style_im'];
  $style_ip = $cesis_data['cesis_portfolio_archive_style_ip'];
  $hover = $cesis_data['cesis_portfolio_archive_hover'];
  $hover_color = $cesis_data['cesis_portfolio_archive_hover_color']['rgba'];
  $effect = $cesis_data['cesis_portfolio_archive_effect'];
  $force_font = $cesis_data['cesis_portfolio_archive_force_font'];
  $thumbnail_size = $cesis_data['cesis_portfolio_archive_thumbnail_size'];
  $packery_type = $cesis_data['cesis_portfolio_archive_packery_type'];
  $padding = $cesis_data['cesis_portfolio_archive_padding'];
  $inner_padding_ig = $cesis_data['cesis_portfolio_archive_inner_padding_ig'];
  $inner_padding_ip = $cesis_data['cesis_portfolio_archive_inner_padding_ip'];
  $target = $cesis_data['cesis_portfolio_archive_target'];
  $i_date = $cesis_data['cesis_portfolio_archive_i_date'];
  $i_category = $cesis_data['cesis_portfolio_archive_i_category'];
  $i_tag = $cesis_data['cesis_portfolio_archive_i_tag'];
  $i_comment = $cesis_data['cesis_portfolio_archive_i_comment'];
  $i_like = $cesis_data['cesis_portfolio_archive_i_like'];
  $i_text = $cesis_data['cesis_portfolio_archive_i_text'];
  $text_source = $cesis_data['cesis_portfolio_archive_text_source'];
  $char_length = $cesis_data['cesis_portfolio_archive_char_length'];
  $m_bg_color = $cesis_data['cesis_main_content_bg'];
  $background_setting = '';
  $m_mbg_color = $cesis_data['cesis_main_content_bg'];



$t_f_size = $cesis_data["cesis_portfolio_archive_text_font"]['font-size'];
$t_l_spacing = $cesis_data["cesis_portfolio_archive_text_font"]['letter-spacing'];
$t_l_height = $cesis_data["cesis_portfolio_archive_text_font"]['line-height'];
$t_t_transform = $cesis_data["cesis_portfolio_archive_text_font"]['text-transform'];
$t_f_family = $cesis_data["cesis_portfolio_archive_text_font"]['font-family'];
$t_f_weight = $cesis_data["cesis_portfolio_archive_text_font"]['font-weight'];

	// Font settings
  if($force_font == 'custom'){

  $t_styles = 'font-size:'.$t_f_size.'; ';
  $t_styles .= 'letter-spacing:'.$t_l_spacing.'px; ';
  $t_styles .= 'line-height:'.$t_l_height.'; ';
  $t_styles .= 'text-transform:'.$t_t_transform.'; ';
  $t_styles .= 'font-family:' . $t_f_family.'; ';
  $t_styles .= 'font-weight:' .$t_f_weight.'; ';
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

}

elseif(get_post_type() == 'staff'){
$banner_type = $cesis_data['cesis_staff_a_banner'];
$banner_pos = $cesis_data['cesis_staff_a_banner_pos'];
$blockid = $cesis_data['cesis_staff_a_block_content'];
$sliderid = $cesis_data['cesis_staff_a_rev_slider'];
$layersliderid = $cesis_data['cesis_staff_a_layer_slider'];
  $use_title = $cesis_data['cesis_staff_a_title'];
  $page_layout = $cesis_data['cesis_staff_archive_layout'];
  $nav_style = $cesis_data['cesis_staff_archive_navigation_style'];
  $nav_pos = $cesis_data['cesis_staff_archive_navigation_pos'];
  $nav_top_space = $cesis_data['cesis_staff_archive_navigation_space']["height"];
  $type = $cesis_data['cesis_staff_archive_type'];
  $col = $cesis_data['cesis_staff_archive_col'];
  $style_ig = $cesis_data['cesis_staff_archive_style_ig'];
  $style_ip = $cesis_data['cesis_staff_archive_style_ip'];
  $hover = $cesis_data['cesis_staff_archive_hover'];
  $hover_color = $cesis_data['cesis_staff_archive_hover_color']['rgba'];
  $hover_social_bg_color = $cesis_data['cesis_staff_archive_hover_social_bg_color']['rgba'];
  $effect = $cesis_data['cesis_staff_archive_effect'];
  $force_font = $cesis_data['cesis_staff_archive_force_font'];
  $thumbnail_size = $cesis_data['cesis_staff_archive_thumbnail_size'];
  $padding = $cesis_data['cesis_staff_archive_padding'];
  $inner_padding_ig = $cesis_data['cesis_staff_archive_inner_padding_ig'];
  $inner_padding_ip = $cesis_data['cesis_staff_archive_inner_padding_ip'];
  $target = $cesis_data['cesis_staff_archive_target'];
  $i_author = $cesis_data['cesis_staff_archive_i_author'];
  $i_social = $cesis_data['cesis_staff_archive_i_social'];
  $i_text = $cesis_data['cesis_staff_archive_i_text'];
  $text_source = $cesis_data['cesis_staff_archive_text_source'];
  $char_length = $cesis_data['cesis_staff_archive_char_length'];
  $m_bg_color = $cesis_data['cesis_main_content_bg'];
  $background_setting = '';
  $m_mbg_color = $cesis_data['cesis_main_content_bg'];


$t_f_size = $cesis_data["cesis_staff_archive_text_font"]['font-size'];
$t_l_spacing = $cesis_data["cesis_staff_archive_text_font"]['letter-spacing'];
$t_l_height = $cesis_data["cesis_staff_archive_text_font"]['line-height'];
$t_t_transform = $cesis_data["cesis_staff_archive_text_font"]['text-transform'];
$t_f_family = $cesis_data["cesis_staff_archive_text_font"]['font-family'];
$t_f_weight = $cesis_data["cesis_staff_archive_text_font"]['font-weight'];

	// Font settings
  if($force_font == 'custom'){

  $t_styles = 'font-size:'.$t_f_size.'; ';
  $t_styles .= 'letter-spacing:'.$t_l_spacing.'px; ';
  $t_styles .= 'line-height:'.$t_l_height.'; ';
  $t_styles .= 'text-transform:'.$t_t_transform.'; ';
  $t_styles .= 'font-family:' . $t_f_family.'; ';
  $t_styles .= 'font-weight:' .$t_f_weight.'; ';
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
}

elseif(get_post_type() == 'careers'){

  $banner_type = $cesis_data['cesis_career_a_banner'];
  $banner_pos = $cesis_data['cesis_career_a_banner_pos'];
  $blockid = $cesis_data['cesis_career_a_block_content'];
  $sliderid = $cesis_data['cesis_career_a_rev_slider'];
	$layersliderid = $cesis_data['cesis_career_a_layer_slider'];
 	$use_title = $cesis_data['cesis_career_a_title'];
  $page_layout = $cesis_data['cesis_career_archive_layout'];
  $nav_style = $cesis_data['cesis_career_archive_navigation_style'];
  $nav_pos = $cesis_data['cesis_career_archive_navigation_pos'];
  $nav_top_space = $cesis_data['cesis_career_archive_navigation_space']["height"];

  /* Archive options */

  $type = 'isotope_grid';
  $col = $cesis_data['cesis_career_archive_col'];
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
  $m_bg_color = $cesis_data['cesis_main_content_bg'];
  $background_setting = '';
  $m_mbg_color = $cesis_data['cesis_main_content_bg'];


$t_f_size = $cesis_data["cesis_career_archive_text_font"]['font-size'];
$t_l_spacing = $cesis_data["cesis_career_archive_text_font"]['letter-spacing'];
$t_l_height = $cesis_data["cesis_career_archive_text_font"]['line-height'];
$t_t_transform = $cesis_data["cesis_career_archive_text_font"]['text-transform'];
$t_f_family = $cesis_data["cesis_career_archive_text_font"]['font-family'];
$t_f_weight = $cesis_data["cesis_career_archive_text_font"]['font-weight'];

	// Font settings
  if($force_font == 'custom'){

  $t_styles = 'font-size:'.$t_f_size.'; ';
  $t_styles .= 'letter-spacing:'.$t_l_spacing.'px; ';
  $t_styles .= 'line-height:'.$t_l_height.'; ';
  $t_styles .= 'text-transform:'.$t_t_transform.'; ';
  $t_styles .= 'font-family:' . $t_f_family.'; ';
  $t_styles .= 'font-weight:' .$t_f_weight.'; ';
}

    $layout = 'fitRows';

}


if($banner_type == 'content' && $blockid !== "" && $banner_pos == 'under'){
$cp_content = get_post_field('post_content', $blockid);
visual_composer()->addPageCustomCss( $blockid );
visual_composer()->addShortcodesCustomCss( $blockid );
$post_custom_css = get_post_meta( $blockid, '_wpb_post_custom_css', true );
$post_content_custom_css = get_post_meta( $blockid, '_wpb_shortcodes_custom_css', true );
echo "<style>". $post_custom_css . $post_content_custom_css . "</style>";
echo '<div class="cesis_top_banner"><div class="cesis_container">'.do_shortcode($cp_content).'</div></div>';
}
if($banner_type == 'slider' && $sliderid !== "" && $banner_pos == 'under'){
	echo '<div class="cesis_slider_rev_ctn">'.do_shortcode('[rev_slider alias="'.$sliderid.'"]').'</div>';
}
if($banner_type == 'layerslider' && $layersliderid !== "" && $banner_pos == 'under'){
	echo '<div class="cesis_slider_rev_ctn">'.do_shortcode('[layerslider id="'.$layersliderid.'"]').'</div>';
}

 if($use_title == 'yes') {
 	echo cesis_title();
 }



$sidebar_expanded = $cesis_data["cesis_sidebar_expand"] ;
iF($sidebar_expanded == "yes"){
	$sidebar_expand = "sidebar_expanded";
}
else{ $sidebar_expand = "";}


if($cesis_data['cesis_sidebar_mobile'] == 'no' && wp_is_mobile()){
	$generate_sidebar = 'no';
}else{
	$generate_sidebar = 'yes';
}

 do_action( 'cesis_after_main_title' );

?>

<main id="main" class="site-main vc_full_width_row_container" role="main">
  <div class="cesis_container">
    <div class="article_ctn <?php if($page_layout !== 'no_sidebar' && $generate_sidebar == 'yes') { echo esc_attr($page_layout.' has_sidebar');} ?>">
		<?php if ( have_posts() ) : ?>
			<?php /* Start the Loop */
          /* Blog */
        if(get_post_type() == 'post'){
          if($effect == 'cesis_effect_frame' && $type == 'isotope_packery' && $padding !== '0'){
            $padding = $padding + 20;
          }
          $new_padding = ($padding / 2);
          if($type == 'isotope_packery' && $padding !== '0'){
            $output .= '#cesis_blog_'.$id.' .cesis_blog_m_thumbnail > a:before {
            							content: "";
            							position: absolute;
            							width: 100%;
            							height: 100%;
          								z-index:1;
            							box-shadow: inset 0 0 0 '.$new_padding.'px '.$m_mbg_color.', 0 0 0 1px '.$m_mbg_color.';
          							  }';
          	if($effect == 'cesis_effect_frame'){
          	   $output .= '#cesis_blog_'.$id.' .cesis_blog_m_thumbnail > a:after {
          								  top: '.(($padding - 20) / 2).'px;
          									left: '.(($padding - 20) / 2).'px;
          									width: calc(100% - '.($padding - 20).'px );
          									height: calc(100% - '.($padding - 20).'px );
          									}';
          	}elseif($effect == 'cesis_effect_shadow'){
          	   $output .= '#cesis_blog_'.$id.' .cesis_blog_m_thumbnail > a:after {
          								  top: '.$new_padding.'px;
          									left: '.$new_padding.'px;
          									width: calc(100% - '.$padding.'px );
          									height: calc(100% - '.$padding.'px );
          									}';
          	}
          				if($hover == 'cesis_hover_slide'){
          					if($style == 'cesis_blog_style_9'){
          						$output .= '#cesis_blog_'.$id.' .cesis_blog_m_content { width: calc(100% - '.$padding.'px); left:'.$new_padding.'px; }
          						#cesis_blog_'.$id.' .cesis_blog_m_thumbnail:hover .cesis_blog_m_content{ bottom: '.$new_padding.'px; }';
          					}elseif($style == 'cesis_blog_style_10' || $style == 'cesis_blog_style_11' || $style == 'cesis_blog_style_12' ){
          						$output .= '#cesis_blog_'.$id.' .cesis_blog_m_content{ width: calc(100% - '.$padding.'px); left:'.$new_padding.'px; }
          						#cesis_blog_'.$id.' .cesis_blog_m_thumbnail:hover .cesis_blog_m_content{ bottom: '.$new_padding.'px; }
          						#cesis_blog_'.$id.' .cesis_blog_m_thumbnail:after{height: calc(100% - '.$padding.'px); width: calc(100% - '.$padding.'px); left:'.$new_padding.'px;}
          						#cesis_blog_'.$id.' .cesis_blog_m_thumbnail:hover::after{ top: '.$new_padding.'px;}';
          					}elseif($style == 'cesis_blog_style_13'){
          						$output .= '#cesis_blog_'.$id.' .cesis_blog_m_content{ width: calc(100% - '.$padding.'px); height: calc(100% - '.$padding.'px); left:'.$new_padding.'px; }
          						#cesis_blog_'.$id.' .cesis_blog_m_thumbnail:hover .cesis_blog_m_content{ bottom: '.$new_padding.'px; }';
          					}
          				}else{
          					if($style == 'cesis_blog_style_9'){
          						$output .= '#cesis_blog_'.$id.' .cesis_blog_m_content { width: calc(100% - '.$padding.'px); bottom: '.$new_padding.'px; left:'.$new_padding.'px; }';
          					}elseif($style == 'cesis_blog_style_10' || $style == 'cesis_blog_style_11' || $style == 'cesis_blog_style_12' || $style == 'cesis_blog_style_13'){
          						$output .= '#cesis_blog_'.$id.' .cesis_blog_m_content { width: calc(100% - '.$padding.'px); height: calc(100% - '.$padding.'px); bottom: '.$new_padding.'px; left:'.$new_padding.'px; }';
          					}
          				}

          			}
          			if($hover_color !== ''){
          				if($hover == 'cesis_hover_overlay' || $hover == 'cesis_hover_icon'){
          					if($style !== 'cesis_blog_style_9' && $style !== 'cesis_blog_style_10' && $style !== 'cesis_blog_style_11' && $style !== 'cesis_blog_style_12' && $style !== 'cesis_blog_style_13'  ){
          						$output .= '#cesis_blog_'.$id.' .cesis_overlay_ctn,#cesis_blog_'.$id.' .cesis_hover_overlay .cesis_gallery_img:after{background:'.$hover_color.'}';
          					}elseif($style == 'cesis_blog_style_9' || $style == 'cesis_blog_style_10' || $style == 'cesis_blog_style_13'){
          						$output .= '#cesis_blog_'.$id.' .inside_e:hover .cesis_blog_m_content{background:'.$hover_color.'}';
          					}elseif($style == 'cesis_blog_style_11' || $style == 'cesis_blog_style_12'){
          						$output .= '#cesis_blog_'.$id.' .inside_e:hover .cesis_blog_m_content{
          							background: -webkit-linear-gradient(top, rgba(0,0,0,0) 0%,'.$hover_color.' 100%);
          							background: linear-gradient(to bottom, rgba(0,0,0,0) 0%,'.$hover_color.' 100%);
          							filter: progid:DXImageTransform.Microsoft.gradient( startColorstr="'.$hover_color.'", endColorstr="#4d000000",GradientType=0 );
          							}';
          					}
          				}
          			}
                if($effect == 'cesis_effect_frame' && $type == 'isotope_packery' && $padding !== '0'){
          				$new_padding = $new_padding - 10;
          			}

                  if($output !== ''){
                    echo '<style>'.$output.'</style>';
                  }
              ?>
                <div id="cesis_blog_<?php  echo esc_attr($id) ?>" class="cesis_isotope_container" style="<?php  echo esc_attr($t_styles) ?>">
                <div class="cesis_blog_ctn <?php echo esc_attr($style).' '.esc_attr($force_font).' '.esc_attr($hover).' '.esc_attr($effect) ?> cesis_isotope col_<?php  echo esc_attr($col) ?>" style="margin-left:-<?php echo esc_attr($new_padding) ?>px; margin-right:-<?php echo esc_attr($new_padding) ?>px; <?php echo esc_attr($background_setting) ?>" data-layout="<?php echo esc_attr($layout) ?>" >
              <?php }

              /* Portfolio */

              if(get_post_type() == 'portfolio'){
                if($effect == 'cesis_effect_frame' && $type == 'isotope_packery' && $padding !== '0'){
          			$padding = $padding + 20;
          			}
          			$new_padding = ($padding / 2);
                if($type == 'isotope_packery' && $padding !== '0'){
        				$output .= '#cesis_portfolio_'.$id.' .cesis_portfolio_m_thumbnail > a:before {
            								content: "";
            								position: absolute;
            								width: 100%;
            								height: 100%;
        										z-index:1;
            								box-shadow: inset 0 0 0 '.$new_padding.'px '.$m_mbg_color.', 0 0 0 1px '.$m_mbg_color.';
        									  }';

        				if($effect == 'cesis_effect_frame'){
        					$output .= '#cesis_portfolio_'.$id.' .cesis_portfolio_m_thumbnail > a:after {
        											top: '.(($padding - 20) / 2).'px;
        											left: '.(($padding - 20) / 2).'px;
        									    width: calc(100% - '.($padding - 20).'px );
        									    height: calc(100% - '.($padding - 20).'px );
        										}';
        				}elseif($effect == 'cesis_effect_shadow'){
        					$output .= '#cesis_portfolio_'.$id.' .cesis_portfolio_m_thumbnail > a:after {
        											top: '.$new_padding.'px;
        											left: '.$new_padding.'px;
        									    width: calc(100% - '.$padding.'px );
        									    height: calc(100% - '.$padding.'px );
        										}';
        				}
        				if($hover == 'cesis_hover_slide'){
        					if($style == 'cesis_portfolio_style_11'){
        						$output .= '#cesis_portfolio_'.$id.' .cesis_portfolio_m_content { width: calc(100% - '.$padding.'px); left:'.$new_padding.'px; }
        						#cesis_portfolio_'.$id.' .cesis_portfolio_m_thumbnail:hover .cesis_portfolio_m_content{ bottom: '.$new_padding.'px; }';
        					}elseif($style == 'cesis_portfolio_style_7' || $style == 'cesis_portfolio_style_8' || $style == 'cesis_portfolio_style_9' || $style == 'cesis_portfolio_style_10' ){
        						$output .= '#cesis_portfolio_'.$id.' .cesis_portfolio_m_content{ width: calc(100% - '.$padding.'px); height: calc(100% - '.$padding.'px); left:'.$new_padding.'px; }
        						#cesis_portfolio_'.$id.' .cesis_portfolio_m_thumbnail:hover .cesis_portfolio_m_content{ bottom: '.$new_padding.'px; }';
        					}
        				}else{
        					if($style == 'cesis_portfolio_style_7' || $style == 'cesis_portfolio_style_8' || $style == 'cesis_portfolio_style_9' || $style == 'cesis_portfolio_style_10'){
        						$output .= '#cesis_portfolio_'.$id.' .cesis_portfolio_m_content { width: calc(100% - '.$padding.'px); height: calc(100% - '.$padding.'px); bottom: '.$new_padding.'px; left:'.$new_padding.'px; }';
        					}elseif($style == 'cesis_portfolio_style_11' ){
        						$output .= '#cesis_portfolio_'.$id.' .cesis_portfolio_m_content { width: calc(100% - '.$padding.'px); bottom: '.$new_padding.'px; left:'.$new_padding.'px; }
        						#cesis_portfolio_'.$id.' .cesis_portfolio_m_thumbnail:after{height: calc(100% - '.$padding.'px); width: calc(100% - '.$padding.'px); top: '.$new_padding.'px; left:'.$new_padding.'px;}';
        					}
        				}

        			}
        			if($hover_color !== ''){
        				if($hover == 'cesis_hover_overlay' || $hover == 'cesis_hover_icon'){
        					if($style !== 'cesis_portfolio_style_7' && $style !== 'cesis_portfolio_style_8' && $style !== 'cesis_portfolio_style_9' && $style !== 'cesis_portfolio_style_10' && $style !== 'cesis_portfolio_style_11'  ){
        						$output .= '#cesis_portfolio_'.$id.' .cesis_overlay_ctn,#cesis_portfolio_'.$id.' .cesis_hover_overlay .cesis_gallery_img:after{background:'.$hover_color.'}';
        					}elseif($style == 'cesis_portfolio_style_7' || $style == 'cesis_portfolio_style_8' || $style == 'cesis_portfolio_style_9' || $style == 'cesis_portfolio_style_10' || $style == 'cesis_portfolio_style_11' ){
        						$output .= '#cesis_portfolio_'.$id.' .inside_e:hover .cesis_portfolio_m_content{background:'.$hover_color.'}';
        					}
        				}
        			}


              if($effect == 'cesis_effect_frame' && $type == 'isotope_packery' && $padding !== '0'){
                $new_padding = $new_padding - 10;
              }

                if($output !== ''){
                  echo '<style>'.$output.'</style>';
                }
              ?>

                <div id="cesis_portfolio_<?php  echo esc_attr($id) ?>" class="cesis_isotope_container"  style="<?php  echo esc_attr($t_styles) ?>">
                  <div class="cesis_portfolio_ctn <?php echo esc_attr($style).' '.esc_attr($force_font).' '.esc_attr($hover).' '.esc_attr($effect) ?> cesis_isotope col_<?php  echo esc_attr($col) ?>" style="margin-left:-<?php echo esc_attr($new_padding) ?>px; margin-right:-<?php echo esc_attr($new_padding) ?>px;" data-layout="<?php echo esc_attr($layout) ?>" >
              <?php }

              /* Staff */

              if(get_post_type() == 'staff'){
                if($style == 'cesis_staff_style_5' || $style == 'cesis_staff_style_6' || $style == 'cesis_staff_style_7'){
          				$content_style = 'style=padding:'.$inner_padding.';';
          			}
          			else{
          				$content_style = '';
          			}
          			if($effect == 'cesis_effect_frame' && $type == 'isotope_packery' && $padding !== '0'){
          			$padding = $padding + 20;
          			}
          			$new_padding = ($padding / 2);
                if($type == 'isotope_packery' && $padding !== '0'){
          				$output .= '#cesis_staff_'.$id.' .cesis_staff_m_thumbnail > a:before {
          										content: "";
          										position: absolute;
          										width: 100%;
          										height: 100%;
          										z-index:1;
          										box-shadow: inset 0 0 0 '.$new_padding.'px '.$m_mbg_color.', 0 0 0 1px '.$m_mbg_color.';
          										}';

          				if($effect == 'cesis_effect_frame'){
          					$output .= '#cesis_staff_'.$id.' .cesis_staff_m_thumbnail > a:after {
          											top: '.(($padding - 20) / 2).'px;
          											left: '.(($padding - 20) / 2).'px;
          											width: calc(100% - '.($padding - 20).'px );
          											height: calc(100% - '.($padding - 20).'px );
          										}';
          				}elseif($effect == 'cesis_effect_shadow'){
          					$output .= '#cesis_staff_'.$id.' .cesis_staff_m_thumbnail > a:after {
          											top: '.$new_padding.'px;
          											left: '.$new_padding.'px;
          											width: calc(100% - '.$padding.'px );
          											height: calc(100% - '.$padding.'px );
          										}';
          				}
          				if($hover == 'cesis_hover_slide'){
          					if($style == 'cesis_staff_style_5' || $style == 'cesis_staff_style_6' || $style == 'cesis_staff_style_7'){
          						$output .= '#cesis_staff_'.$id.' .cesis_staff_m_content{ width: calc(100% - '.$padding.'px); height: calc(100% - '.$padding.'px); left:'.$new_padding.'px; }
          						#cesis_staff_'.$id.' .cesis_staff_m_thumbnail:hover .cesis_staff_m_content{ bottom: '.$new_padding.'px; }';
          					}
          				}else{
          					if($style == 'cesis_staff_style_5' || $style == 'cesis_staff_style_6' || $style == 'cesis_staff_style_7' ){
          						$output .= '#cesis_staff_'.$id.' .cesis_staff_m_content { width: calc(100% - '.$padding.'px); height: calc(100% - '.$padding.'px); bottom: '.$new_padding.'px; left:'.$new_padding.'px; }';
          					}
          				}

          			}
          			if($hover_color !== ''){
          				if($hover == 'cesis_hover_overlay' || $hover == 'cesis_hover_overlay_social'){
          					if($style !== 'cesis_staff_style_5' && $style !== 'cesis_staff_style_6' && $style !== 'cesis_staff_style_7' ){
          						$output .= '#cesis_staff_'.$id.' .cesis_overlay_ctn{background:'.$hover_color.'}';
          						if($hover_social_bg_color !== ''){
          							$output .= '#cesis_staff_'.$id.' .cesis_staff_ctn:not(.cesis_staff_style_5):not(.cesis_staff_style_6):not(.cesis_staff_style_7) .cesis_staff_m_thumbnail .cesis_staff_social a:hover{background:'.$hover_social_bg_color.'}';
          						}

          					}else{
          						$output .= '#cesis_staff_'.$id.' .inside_e:hover .cesis_staff_m_content{background:'.$hover_color.'}';
          					}
          				}
          			}
        			  if($effect == 'cesis_effect_frame' && $type == 'isotope_packery' && $padding !== '0'){
                  $new_padding = $new_padding - 10;
                }
          		  if($output !== ''){
          				echo '<style>'.$output.'</style>';
          			} ?>
                <div id="cesis_staff_<?php  echo esc_attr($id) ?>" class="cesis_isotope_container"  style="<?php  echo esc_attr($t_styles) ?>">
                  <div class="cesis_staff_ctn <?php echo esc_attr($style).' '.esc_attr($force_font).' '.esc_attr($hover).' '.esc_attr($effect) ?> cesis_isotope col_<?php  echo esc_attr($col) ?>" style="margin-left:-<?php echo esc_attr($new_padding) ?>px; margin-right:-<?php echo esc_attr($new_padding) ?>px;" data-layout="<?php echo esc_attr($layout) ?>" >

              <?php }

              /* Career */

              if(get_post_type() == 'careers'){
                $new_padding = ($padding / 2);
                if($hover_color !== ''){
                  if($hover == 'cesis_hover_overlay' ){
                	   $output .= '#cesis_career_'.$id.' .cesis_overlay_ctn{background:'.$hover_color.'}';
                   }
                }
          		  if($output !== ''){
          				echo '<style>'.$output.'</style>';
          			}
                 ?>
                <div id="cesis_career_<?php  echo esc_attr($id) ?>" class="cesis_isotope_container"  style="<?php  echo esc_attr($t_styles) ?>">
                  <div class="cesis_career_ctn <?php echo esc_attr($style).' '.esc_attr($force_font).' '.esc_attr($hover).' '.esc_attr($effect) ?> cesis_isotope col_<?php  echo esc_attr($col) ?>" style="margin-left:-<?php echo esc_attr($new_padding) ?>px; margin-right:-<?php echo esc_attr($new_padding) ?>px;" data-layout="<?php echo esc_attr($layout) ?>" >

              <?php } ?>

			<?php while ( have_posts() ) : the_post();?>
				<?php


					/*
					 * Include the Post-type-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post type name) and that will be used instead.
					 */
					get_template_part( 'template-parts/content', get_post_type() );
				?>

			<?php endwhile; ?>
      </div>
    </div>
			<?php echo '<div class="cesis_navigation_ctn cesis_classic_navigation '.$nav_pos.' '.$nav_style.'" style="margin-top:'.$nav_top_space.';">';
			echo cesis_classic_navigation();
			echo '</div>'; ?>

		<?php else : ?>

			<?php get_template_part( 'template-parts/content', 'none' ); ?>

		    <?php endif;?>
		    </div>

		    <?php if($page_layout !== 'no_sidebar' && $generate_sidebar == 'yes'){ ?>
		    <div class="sidebar_ctn <?php echo esc_attr($page_layout); ?>  <?php echo esc_attr($sidebar_expand); ?>">
		    <?php get_sidebar(); ?>
		    </div>
		    <?php }


			 ?>

		  </div>
		  <!-- .container -->
		</main>
		<!-- #main -->
<?php get_footer(); ?>
