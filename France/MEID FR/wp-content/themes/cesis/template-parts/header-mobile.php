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

$mobile_social_content = $mobile_search_content = $mobile_cart_content = "";
$page_custom_menu = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_mobile_menu');
$custom_mobile = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_mobile');

if($custom_mobile == 'yes' && !is_archive()){
  $mobile_social = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_mobile_social');
  $mobile_search = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_mobile_search');
  $mobile_style = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_mobile_design');
}else{
  $mobile_social = $cesis_data["cesis_mobile_social"];
  $mobile_search = $cesis_data["cesis_mobile_search"];
  $mobile_style = $cesis_data["cesis_mobile_design"];
}
$type = 'cesis_simple';
if($mobile_social == 'yes'){
  $mobile_social_content = cesis_socials($type);
}

if($mobile_search == 'yes'){
  $mobile_search_content = cesis_search('cesis_search_dropdown');
}

if($mobile_style == 'yes'){
  $mobile_style = 'cesis_centered_mobile';
}else {
  $mobile_style = '';
}
?>
<div class="header_mobile <?php echo esc_attr($mobile_style);?>">
  <nav id="mobile-navigation" class="tt-mobile-navigation">
    <?php wp_nav_menu( array( 'theme_location' => 'mobile-menu', 'menu' => $page_custom_menu, 'container_class' => 'menu-mobile-ct' , 'menu_id' => 'mobile-menu', 'menu_class' => 'mobile-menu sm smart_menu', 'fallback_cb' => 'please_set_menu', 'walker' => new cesis_megamenu_walker ) ); ?>
  </nav>
  <!-- #site-navigation -->

<?php if($mobile_social !== 'no' || $mobile_search !== 'no'){?>
  <div class="tt-mobile-additional"><?php echo $mobile_search_content.''.$mobile_social_content;?></div>
<?php } ?>

  <!-- .tt-mmobile-additional -->

</div>
<!-- .header_mobile -->
