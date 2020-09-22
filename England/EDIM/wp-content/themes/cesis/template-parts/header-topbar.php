<?php
/**
 * Template part for displaying header top bar.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cesis
 */


global $cesis_data;
$type = 'cesis_simple';


$custom_top_bar = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_topbar');
if($custom_top_bar == 'yes'){

  $tbarray = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_top_bar_sorter_meta');
  $left_layout = $tbarray['left'];
  $right_layout = $tbarray['right'];

  $n_type = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_top_bar_notifications_style');

  $phone = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_top_bar_phone');
  $email = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_top_bar_email');
  $text = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_top_bar_text');
}else {
  $left_layout = $cesis_data['cesis_top_bar_sorter']['left'];
  $right_layout = $cesis_data['cesis_top_bar_sorter']['right'];

  $n_type = $cesis_data['cesis_top_bar_notifications_style'];

  $phone = $cesis_data['cesis_top_bar_phone'];
  $email = $cesis_data['cesis_top_bar_email'];
  $text = $cesis_data['cesis_top_bar_text'];
}
$email = '<a href="mailto:'.$email.'">'.$email.'</a>';
$page_custom_topbar_menu = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_page_menu');

if( cesis_check_woo_status() == true){
  $cart = '<div class="top_bar_cart">'.cesis_cart('mobile').'</div>';
}else {
  $cart = '';
}

if( cesis_check_bp_status() == true){
  $notifications = '<div class="top_bar_notifications">'.cesis_bp_notifications($n_type, '').'</div>';
}else {
  $notifications = '';
}



?>
<div class="header_top_bar">
  <div class="cesis_container">
    <div class="top_bar_left">
    <?php




  if ($left_layout): foreach ($left_layout as $key=>$value) {

      switch($key) {

          case 'tb_phone': echo '<div class="top_bar_phone">'.$phone.'</div>';
  		break;

  		case 'tb_mail': echo '<div class="top_bar_email">'.$email.'</div>';
          break;

  		case 'tb_text': echo '<div class="top_bar_text">'.$text.'</div>';
          break;

          case 'tb_social_icons': echo '<div class="top_bar_si">'.cesis_socials($type).'</div>';
          break;

          case 'tb_search':  echo '<div class="top_bar_search">'.cesis_search($type).'</div>';
          break;

          case 'tb_menu': echo '<div class="top_bar_menu">'.wp_nav_menu( array( 'theme_location' => 'top-bar-menu', 'menu' => $page_custom_topbar_menu, 'container_class' => 'menu-top-bar-ct' , 'menu_id' => 'top-bar-menu', 'menu_class' => 'top-bar-menu ', 'fallback_cb' => 'please_set_menu' ) ).'</div>';
          break;

          case 'tb_cart': echo $cart;
          break;

          case 'tb_notifications': echo $notifications;
          break;

      }

  }

  endif;


  ?>


    </div>
    <div class="top_bar_right">

      <?php


      if ($right_layout): foreach ($right_layout as $key=>$value) {

        switch($key) {

                    case 'tb_phone': echo '<div class="top_bar_phone">'.$phone.'</div>';
            		break;

            		case 'tb_mail': echo '<div class="top_bar_email">'.$email.'</div>';
                    break;

            		case 'tb_text': echo '<div class="top_bar_text">'.$text.'</div>';
                    break;

                    case 'tb_social_icons': echo '<div class="top_bar_si">'.cesis_socials($type).'</div>';
                    break;

                    case 'tb_search':  echo '<div class="top_bar_search">'.cesis_search($type).'</div>';
                    break;

                    case 'tb_menu': echo '<div class="top_bar_menu">'.wp_nav_menu( array( 'theme_location' => 'top-bar-menu', 'menu' => $page_custom_topbar_menu, 'container_class' => 'menu-top-bar-ct' , 'menu_id' => 'top-bar-menu', 'menu_class' => 'top-bar-menu', 'fallback_cb' => 'please_set_menu' ) ).'</div>';
                    break;

                    case 'tb_cart': echo $cart;
                    break;

                    case 'tb_notifications': echo $notifications;
                    break;

        }

      }

      endif;


      ?>

     </div>
  </div>
  <!-- .cesis_container -->
</div>
<!-- .header_top_bar -->
