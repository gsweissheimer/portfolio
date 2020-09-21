<?php
/**
 * Template part for displaying Footer sub bar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cesis
 */


global $cesis_data;

 $page_custom_footer_menu = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_page_menu');
$custom_footer_bar = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_footer_bar');
if( cesis_check_bbp_status() == true && cesis_is_bbpress() == true || cesis_check_bp_status() == true && cesis_is_buddypress() || is_404() || is_archive() ){

  $left_layout = $cesis_data['cesis_footer_bar_sorter']['left'];
  $center_layout = $cesis_data['cesis_footer_bar_sorter']['center'];
  $right_layout = $cesis_data['cesis_footer_bar_sorter']['right'];

  $text_one = $cesis_data['cesis_footer_text_one'];
  $text_two = $cesis_data['cesis_footer_text_two'];
  $text_three = $cesis_data['cesis_footer_text_three'];
  $type = 'cesis_simple';
}elseif($custom_footer_bar == 'yes'){

  $sbarray = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_footer_bar_sorter_meta');
  $left_layout = $sbarray['left'];
  $center_layout = $sbarray['center'];
  $right_layout = $sbarray['right'];

$text_one = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_text_one');
$text_two = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_text_two');
$text_three = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_footer_text_three');
$type = 'cesis_simple';
 }else{
   $left_layout = $cesis_data['cesis_footer_bar_sorter']['left'];
   $center_layout = $cesis_data['cesis_footer_bar_sorter']['center'];
   $right_layout = $cesis_data['cesis_footer_bar_sorter']['right'];

   $text_one = $cesis_data['cesis_footer_text_one'];
   $text_two = $cesis_data['cesis_footer_text_two'];
   $text_three = $cesis_data['cesis_footer_text_three'];
   $type = 'cesis_simple';
 }
?>

<div class="footer_sub">
  <div class="cesis_container">
  <div class="footer_sub_left">

  <?php

  if ( cesis_check_ccp_status() == false && !$left_layout) {
		echo '<div class="f_text_one"><span>©2015 - 2018 All Rights Reserved Tranmautritam - Envato Pty Ltd.</span></div>';
	}

if ($left_layout): foreach ($left_layout as $key=>$value) {

    switch($key) {

        case 'f_text_one': echo '<div class="f_text_one"><span>'.do_shortcode($text_one).'</span></div>';
		break;

		case 'f_text_two': echo '<div class="f_text_two"><span>'.do_shortcode($text_two).'</span></div>';
        break;

		case 'f_text_three': echo '<div class="f_text_three"><span>'.do_shortcode($text_three).'</span></div>';
        break;

        case 'f_social_icons': echo '<div class="f_si">'.cesis_socials($type).'</div>';
        break;

        case 'f_back_to_top': get_template_part( 'templates/content', 'services' );
        break;

        case 'f_menu': echo wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu' => $page_custom_footer_menu, 'container_class' => 'menu-footer-ct' , 'menu_id' => 'footer-menu', 'menu_class' => 'footer-menu ', 'fallback_cb' => 'please_set_menu' ) );
        break;

    }

}

endif;


?>


  </div>
  <div class="footer_sub_center">

    <?php


    if ($center_layout): foreach ($center_layout as $key=>$value) {

      switch($key) {

          case 'f_text_one': echo '<div class="f_text_one"><span>'.do_shortcode($text_one).'</span></div>';
          break;

          case 'f_text_two': echo '<div class="f_text_two"><span>'.do_shortcode($text_two).'</span></div>';
          break;

          case 'f_text_three': echo '<div class="f_text_three"><span>'.do_shortcode($text_three).'</span></div>';
          break;

          case 'f_social_icons': echo '<div class="f_si">'.cesis_socials($type).'</div>';
          break;

          case 'f_back_to_top': get_template_part( 'templates/content', 'services' );
          break;

          case 'f_menu': echo wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu' => $page_custom_footer_menu, 'container_class' => 'menu-footer-ct' , 'menu_id' => 'footer-menu', 'menu_class' => 'footer-menu ', 'fallback_cb' => 'please_set_menu' ) );
          break;

      }

    }

    endif;


    ?>

   </div>
  <div class="footer_sub_right">


        <?php


        if ($right_layout): foreach ($right_layout as $key=>$value) {

          switch($key) {

              case 'f_text_one': echo '<div class="f_text_one"><span>'.do_shortcode($text_one).'</span></div>';
          break;

          case 'f_text_two': echo '<div class="f_text_two"><span>'.do_shortcode($text_two).'</span></div>';
              break;

          case 'f_text_three': echo '<div class="f_text_three"><span>'.do_shortcode($text_three).'</span></div>';
              break;

              case 'f_social_icons': echo '<div class="f_si">'.cesis_socials($type).'</div>';
              break;

              case 'f_back_to_top': get_template_part( 'templates/content', 'services' );
              break;

              case 'f_menu': echo wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu' => $page_custom_footer_menu, 'container_class' => 'menu-footer-ct' , 'menu_id' => 'footer-menu', 'menu_class' => 'footer-menu ', 'fallback_cb' => 'please_set_menu' ) );
              break;

          }

        }

        endif;


        ?>

   </div>


  </div>
  <!-- .container -->
</div>
<!-- .footer_sub -->
