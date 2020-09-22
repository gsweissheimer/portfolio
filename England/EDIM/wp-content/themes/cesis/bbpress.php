<?php
/**
 * The template for displaying bbpress pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Cesis
 */

global $cesis_data;
global $cesis_post;


get_header();
$sidebar_expand = $generate_sidebar = '';
$custom_banner = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_banner');
$custom_banner_pos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_banner_pos');

if($custom_banner !== 'inherit'){
	$banner_type = $custom_banner;
	$blockid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_block_content');
	$sliderid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_rev_slider');
	$layersliderid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_layer_slider');
	if($custom_banner_pos !== 'inherit'){
		$banner_pos = $custom_banner_pos;
	}else {
		$banner_pos = $cesis_data['cesis_bbpress_banner_pos'];
	}
}else {
	$banner_type = $cesis_data['cesis_bbpress_banner'];
	$banner_pos = $cesis_data['cesis_bbpress_banner_pos'];
	if(isset($cesis_data['cesis_bbpress_block_content'])){
	$blockid = $cesis_data['cesis_bbpress_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_bbpress_rev_slider'])){
	$sliderid = $cesis_data['cesis_bbpress_rev_slider'];
	}
	if(isset($cesis_data['cesis_bbpress_layer_slider'])){
	$layersliderid = $cesis_data['cesis_bbpress_layer_slider'];
	}
}

if($banner_type == 'content' && $blockid !== "" && $banner_pos == 'under'){
$cp_content = get_post_field('post_content', $blockid);
visual_composer()->addPageCustomCss( $blockid );
visual_composer()->addShortcodesCustomCss( $blockid );

$post_custom_css = get_post_meta( $blockid, '_wpb_post_custom_css', true );
$post_content_custom_css = get_post_meta( $blockid, '_wpb_shortcodes_custom_css', true );
echo "<style>". $post_custom_css . $post_content_custom_css . "</style>";
echo '<div class="cesis_top_banner"><div class="cesis_container">'.do_shortcode($cp_content).'</div></div>';
}elseif($banner_type == 'slider' && $sliderid !== "" && $banner_pos == 'under'){
	echo '<div class="cesis_slider_rev_ctn">'.do_shortcode('[rev_slider alias="'.$sliderid.'"]').'</div>';
}
elseif($banner_type == 'layerslider' && $layersliderid !== "" && $banner_pos == 'under'){
	echo '<div class="cesis_slider_rev_ctn">'.do_shortcode('[layerslider id="'.$layersliderid.'"]').'</div>';
}

$use_title = $cesis_data['cesis_bbpress_title'];

if($use_title == 'yes') {
	echo cesis_title();
}

$page_layout = $cesis_data['cesis_bbpress_layout'];

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

<main id="cesis_main" class="site-main vc_full_width_row_container" role="main">
  <div class="cesis_container">
    <?php while ( have_posts() ) : the_post(); ?>

    <div class="article_ctn <?php if($page_layout !== 'no_sidebar' && $generate_sidebar == 'yes') { echo esc_attr($page_layout.' has_sidebar');} ?>">


	<?php get_template_part( 'template-parts/content', 'page' ); ?>
	<?php endwhile; // End of the loop.  ?>

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
