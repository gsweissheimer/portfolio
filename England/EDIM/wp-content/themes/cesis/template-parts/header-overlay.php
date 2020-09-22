<?php
/**
 * Template part for displaying header main area.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cesis
 */

global $cesis_data;
global $cesis_post;

$page_custom_menu = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_menu');
$custom_header = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_header');

if($custom_header == 'yes'  && !is_archive()){

$logo_pos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_logo_pos');
$menu_pos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_menu_pos');
$menu_type = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_menu_type');
$v_header_pos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_v_pos');
$v_content_pos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_v_content');
$v_content_ypos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_v_content_ypos');
if($menu_type == 'nav_bottom_borderx' || $menu_type == 'nav_top_borderx' ){
    $menu_border_pos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_menu_border_pos');
}else{ $menu_border_pos = '';}
$header_additional_style = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_additional_style');
$header_social = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_additional_social');
$header_search = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_additional_search');
$header_cart = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_additional_cart');
$header_notifications = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_additional_buddypress');
$type = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_additional_type');
}else{
$logo_pos = $cesis_data["cesis_logo_pos"];
$menu_pos = $cesis_data["cesis_menu_pos"];
$menu_type = $cesis_data["cesis_menu_type"];
$v_header_pos = $cesis_data['cesis_header_v_pos'];
$v_content_pos = $cesis_data['cesis_header_v_content'];
$v_content_ypos = $cesis_data['cesis_header_v_content_ypos'];

  if($menu_type == 'nav_bottom_borderx' || $menu_type == 'nav_top_borderx' ){
    $menu_border_pos = $cesis_data["cesis_menu_border_pos"];
}else{ $menu_border_pos = '';}
$header_additional_style = $cesis_data["cesis_header_additional_style"];
$header_social = $cesis_data["cesis_header_additional_social"];
$header_search = $cesis_data["cesis_header_additional_search"];
$header_cart = $cesis_data["cesis_header_additional_cart"];
$header_notifications = $cesis_data["cesis_header_additional_buddypress"];
$type = $cesis_data["cesis_header_additional_type"];
}
$header_social_content = $header_search_content = $header_cart_content = $header_notifications_content = $has_cart = "";


if($header_search == 'yes'){
  $header_search_content = cesis_search('cesis_search_dropdown');
}

if($header_social == 'yes'){
  $header_social_content = cesis_socials($type);
}
if($header_cart == 'yes'){
  $header_cart_content = cesis_cart('');
  $has_cart = 'has_cart';
}
if($header_notifications == 'yes' && cesis_check_bp_status() == true){
  $header_notifications_content = cesis_bp_notifications('i','');
}

?>
<div class="header_main">
  <div class="cesis_container">
    <div class="header_logo <?php echo esc_attr($logo_pos); ?>">
      <?php echo cesis_generate_logo(); ?>
    </div>
    <!-- .header_logo -->
    <div class="cesis_menu_button cesis_menu_overlay <?php echo esc_attr($logo_pos); ?>"><span class="lines"></span></div>
    <?php if($header_cart == 'yes'){ ?>
    <div class="cesis_overlay_cart  <?php echo esc_attr($logo_pos); ?>"><?php echo $header_cart_content;?></div>
    <?php }  if($header_notifications == 'yes'){ ?>
    <div class="cesis_overlay_notifications <?php echo esc_attr($has_cart.' '.$logo_pos); ?>"><?php echo $header_notifications_content ?></div>
    <?php }  ?>
  </div>
  <!-- .cesis_container -->
</div>
<!-- .header_main -->

<div class="header_overlay">
  <div class="cesis_menu_button cesis_menu_overlay_close"><span class="lines"></span></div>
  <div class="cesis_container">
    <nav id="site-navigation" class="tt-main-navigation tt-vertical-navigation">

      <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu' => $page_custom_menu, 'container_class' => 'menu-main-ct' , 'menu_id' => 'main-menu', 'menu_class' => 'vertical-main-menu sm smart_menu', 'fallback_cb' => 'please_set_menu', 'walker' => new cesis_megamenu_walker ) ); ?>
    </nav>
    <!-- #site-navigation -->

    <?php if($header_social !== 'no' || $header_search !== 'no'  ){?>
      <div class="tt-header-additional tt-main-additional vertical_additional <?php echo esc_attr($header_additional_style); ?>"><?php echo $header_search_content.''.$header_social_content;?></div>
    <?php } ?>

    </div>
    <!-- .cesis_container -->
  </div>
<!-- .header_offcanvas -->
