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
$header_block = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_content_block');
$header_block_id = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_content_block_id');
if(isset($header_block_id)){
  $header_blockid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_content_block_id');
}else{
	$header_blockid = "";
}
$header_blockpos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_header_content_block_position');
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
$header_block = $cesis_data["cesis_header_content_block"];
if(isset($cesis_data['cesis_header_content_block_id'])){
  $header_blockid = $cesis_data['cesis_header_content_block_id'];
}else{
	$header_blockid = "";
}
$header_blockpos = $cesis_data["cesis_header_content_block_position"];
$type = $cesis_data["cesis_header_additional_type"];
}
$header_social_content = $header_search_content = $header_cart_content = $header_notifications_content = "";


if($header_search == 'yes'){
  $header_search_content = cesis_search('cesis_search_dropdown');
}

if($header_social == 'yes'){
  $header_social_content = cesis_socials($type);
}

if($header_cart == 'yes'){
  $header_cart_content = cesis_cart('vertical');
}
if($header_notifications == 'yes' && cesis_check_bp_status() == true){
  $header_notifications_content = cesis_bp_notifications('v','');
}

if($header_block == 'yes'){
$cp_content = get_post_field('post_content', $header_blockid);
$post_custom_css = get_post_meta( $header_blockid, '_wpb_post_custom_css', true );
$post_content_custom_css = get_post_meta( $header_blockid, '_wpb_shortcodes_custom_css', true );
}

?>
<div class="header_main header_vertical  <?php echo esc_attr($v_header_pos.' '.$v_content_pos.' '.$v_content_ypos ); ?>">
  <div class="cesis_container">
    <div class="header_logo vertical_logo">
      <?php echo cesis_generate_logo(); ?>
    </div>
    <!-- .header_logo -->

    <nav id="site-navigation" class="tt-main-navigation tt-vertical-navigation">

      <?php wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu' => $page_custom_menu, 'container_class' => 'menu-main-ct' , 'menu_id' => 'main-menu', 'menu_class' => 'vertical-main-menu sm smart_menu', 'fallback_cb' => 'please_set_menu', 'walker' => new cesis_megamenu_walker ) ); ?>
    </nav>
    <!-- #site-navigation -->

    <?php if($header_social !== 'no' || $header_search !== 'no' || $header_cart !== 'no' || $header_notifications !== 'no' || $header_block == 'yes'){?>
      <div class="tt-header-additional tt-main-additional vertical_additional <?php echo esc_attr($header_additional_style); ?>">
        <?php if($header_block == 'yes' && $header_blockpos == 'before'){
          echo "<style>". $post_custom_css . $post_content_custom_css . "</style>";
          echo '<div class="cesis_header_content_block">'.do_shortcode($cp_content).'</div>';
        } ?>
        <?php echo $header_notifications_content.''.$header_cart_content.''.$header_search_content.''.$header_social_content;?>
        <?php if($header_block == 'yes' && $header_blockpos == 'after'){
          echo "<style>". $post_custom_css . $post_content_custom_css . "</style>";
          echo '<div class="cesis_header_content_block">'.do_shortcode($cp_content).'</div>';
        } ?>
      </div>
    <?php } ?>


  </div>
  <!-- .cesis_container -->
</div>
<!-- .header_main -->
