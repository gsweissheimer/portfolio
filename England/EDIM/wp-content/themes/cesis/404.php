<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Cesis
 */

global $cesis_data;

get_header();

$sidebar_expand = $generate_sidebar = '';
$page_layout = $cesis_data['cesis_404_layout'];


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

$error_text = $cesis_data['cesis_404_text'];
$error_subtext = $cesis_data['cesis_404_subtext'];
if($cesis_data['cesis_404_image']['url'] !== ''){
  $error_image = $cesis_data['cesis_404_image']['url'];
}else{
  $error_image = '';
}


  if ( cesis_check_ccp_status() == false ) {
		$error_image = get_template_directory_uri(). '/includes/images/404_default.png';
	}

$banner_type = $cesis_data['cesis_404_banner'];
$banner_pos = $cesis_data['cesis_404_banner_pos'];
if(isset($cesis_data['cesis_404_block_content'])){
$blockid = $cesis_data['cesis_404_block_content'];
}else{
	$blockid = "";
}

if(isset($cesis_data['cesis_404_rev_slider'])){
$sliderid = $cesis_data['cesis_404_rev_slider'];
}
if(isset($cesis_data['cesis_404_layer_slider'])){
$layersliderid = $cesis_data['cesis_404_layer_slider'];
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

do_action( 'cesis_after_main_title' );


 ?>

<main id="cesis_main" class="site-main vc_full_width_row_container" role="main">
  <div class="cesis_container">

    <div class="article_ctn <?php if($page_layout !== 'no_sidebar' && $generate_sidebar == 'yes') { echo esc_attr($page_layout.' has_sidebar');} ?>">

<?php if($error_text !== ''){
  echo '<h2 class="cesis_not_found_main">'.esc_attr($error_text).'</h2>';
}
if($error_subtext !== ''){
  echo '<p class="cesis_not_found_sub">'.esc_attr($error_subtext).'</p>';
}
if($error_image !== ''){
  echo '<img class="cesis_not_found_img" src="'.esc_url($error_image).'" />';
} ?>

    </div>

    <?php if($page_layout !== 'no_sidebar' && $generate_sidebar == 'yes'){ ?>
    <div class="sidebar_ctn <?php echo esc_attr($page_layout); ?> <?php echo esc_attr($sidebar_expand); ?>">
    <?php get_sidebar(); ?>
    </div>
    <?php }


	 ?>

  </div>
  <!-- .container -->
</main>
<!-- #main -->

<?php get_footer(); ?>
