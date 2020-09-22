<?php
/**
 * The template for displaying Business classic single post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Cesis
 */

global $cesis_data;
global $post;
get_header();

$custom_banner = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_banner');
$custom_banner_pos = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_banner_pos');
$sidebar_expand = $generate_sidebar = '';

if($custom_banner !== 'inherit'){
	$banner_type = $custom_banner;
	$blockid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_block_content');
	$sliderid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_rev_slider');
	$layersliderid = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_layer_slider');
	if($custom_banner_pos !== 'inherit'){
		$banner_pos = $custom_banner_pos;
	}else {
		$banner_pos = $cesis_data['cesis_career_banner_pos'];
	}
}else {
	$banner_type = $cesis_data['cesis_career_banner'];
	$banner_pos = $cesis_data['cesis_career_banner_pos'];
	if(isset($cesis_data['cesis_career_block_content'])){
	$blockid = $cesis_data['cesis_career_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_career_rev_slider'])){
	$sliderid = $cesis_data['cesis_career_rev_slider'];
	}
	if(isset($cesis_data['cesis_career_layer_slider'])){
	$layersliderid = $cesis_data['cesis_career_layer_slider'];
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

$prev_post = get_previous_post();
$next_post = get_next_post();
$main_career_url = $cesis_data['cesis_career_main_url'];
$custom_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_career_custom_layout');
$custom_title = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_title');
if($custom_title  == 'yes'){
	$use_title = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title');
}
else{
	$use_title = $cesis_data['cesis_career_title'];
}


$custom_sidebar = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_sidebar');
if($custom_sidebar == 'yes'){
	$sidebar_expanded = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_sidebar_expand');
	iF($sidebar_expanded == "yes"){
		$sidebar_expand = "sidebar_expanded";
	}else{ $sidebar_expand = "";}
}else{
	$sidebar_expanded = $cesis_data["cesis_sidebar_expand"] ;
	iF($sidebar_expanded == "yes"){
		$sidebar_expand = "sidebar_expanded";
	}else{ $sidebar_expand = "";}
}

if($cesis_data['cesis_sidebar_mobile'] == 'no' && wp_is_mobile()){
	$generate_sidebar = 'no';
}else{
	$generate_sidebar = 'yes';
}

if($custom_layout  == 'yes'){
	$post_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_career_sp_layout');
	$post_navigation = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_career_sp_navigation');
	if($post_navigation == 'inherit'){ $post_navigation = $cesis_data['cesis_blog_sp_navigation']; }
	$nav_type = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_career_sp_navigation_style');
	if($nav_type == 'inherit'){	$nav_type = $cesis_data['cesis_career_sp_navigation_style'];	}
}else{
	$post_layout = $cesis_data['cesis_career_sp_layout'];
	$post_navigation = $cesis_data['cesis_career_sp_navigation'];
	$nav_type = $cesis_data['cesis_career_sp_navigation_style'];
}


if($nav_type == 'business' || $nav_type == 'careers'){
	$nav_pos = 'in';
}else{
	$nav_pos = 'out';
}





if($use_title == 'yes') {
	echo cesis_title();
}



do_action( 'cesis_after_main_title' );
?>

<main id="cesis_main" class="site-main vc_full_width_row_container " role="main">
  <div class="cesis_container career_position_container">
    <?php

	while ( have_posts() ) : the_post(); ?>

    <div class="article_ctn <?php if($post_layout !== 'no_sidebar' && $generate_sidebar == 'yes') { echo esc_attr($post_layout.' has_sidebar');} ?>">
			<?php

		get_template_part( 'template-parts/content', 'page' );
			if($post_navigation == 'yes' && $prev_post && $nav_pos == 'in' || $post_navigation == 'yes' && $next_post && $nav_pos == 'in') { ?>
					<div class="<?php echo esc_attr($nav_type);?>_navigation">
							<?php if ($main_career_url !== '' && $nav_type == 'agency') { ?>
								<a href="<?php echo esc_url($main_career_url);?>" class="main_posts_page_icon"></a>
							<?php } ?>
							<?php the_post_navigation( array(
								'prev_text'                  => __( 'Previous', 'cesis' ),
								'next_text'                  => __( 'Next', 'cesis' ),
							)
							); 			 ?>
					</div>
		 		<?php } ?>
    </div>
    <?php if($post_layout !== 'no_sidebar' && $generate_sidebar == 'yes') { ?>
    <div class="sidebar_ctn <?php echo esc_attr($post_layout); ?>  <?php echo esc_attr($sidebar_expand); ?>">
    <?php get_sidebar(); ?>
    </div>
    <?php } ?>
  </div>
  <!-- .cesis_container -->
	<?php if($post_navigation == 'yes' && $prev_post && $nav_pos !== 'in'|| $post_navigation == 'yes' && $next_post && $nav_pos !== 'in') { ?>
	<div class="<?php echo esc_attr($nav_type);?>_navigation">
		<div class="cesis_container">
			<?php if ($main_career_url !== '' && $nav_type == 'agency') { ?>
			<a href="<?php echo esc_url($main_career_url);?>" class="main_posts_page_icon"></a>
			<?php } ?>
			<?php the_post_navigation( array(
						'prev_text'                  => __( 'Previous', 'cesis' ),
						'next_text'                  => __( 'Next', 'cesis' ),
			)
			); 			 ?>
		</div>
	</div>
	 <?php } endwhile; // End of the loop. ?>
</main>
<!-- #cesis_main -->
<?php get_footer(); ?>
