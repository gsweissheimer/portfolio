<?php
/**
 * The template for displaying Staff single post.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Cesis
 */

get_header();
global $cesis_data;

$row_custom = '';
$sidebar_expand = $generate_sidebar = '';
$row_custom .= ' '.redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_portfolio_swipe');
$row_custom .= ' '.redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_portfolio_onepage');
$row_custom .= ' '.redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_portfolio_onepage_nav');
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
		$banner_pos = $cesis_data['cesis_portfolio_banner_pos'];
	}
}else {
	$banner_type = $cesis_data['cesis_portfolio_banner'];
	$banner_pos = $cesis_data['cesis_portfolio_banner_pos'];
	if(isset($cesis_data['cesis_portfolio_block_content'])){
	$blockid = $cesis_data['cesis_portfolio_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_portfolio_rev_slider'])){
	$sliderid = $cesis_data['cesis_portfolio_rev_slider'];
	}
	if(isset($cesis_data['cesis_portfolio_layer_slider'])){
	$layersliderid = $cesis_data['cesis_portfolio_layer_slider'];
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

$post_format = get_post_format();
$prev_post = get_previous_post();
$next_post = get_next_post();
$main_portfolio_url = $cesis_data['cesis_portfolio_main_url'];
$custom_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_portfolio_custom_layout');
$project_description = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_description" );
$gallery_data = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_gallery" );
$gallery_size = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_gallery_size" );
$gallery_array = explode(',', $gallery_data);
// audio information
$audio_file = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_file" );
$audio_loop = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_loop" );
$audio_autoplay = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_autoplay" );
$audio_preload = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_preload" );
$audio_iframe = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_iframe" );
if($audio_file == "" && $audio_iframe !== ""){
	$audio_type = "cesis_audio_iframe";
}else{
	$audio_type = "";
}
// video information
$video_data = "";
$video_mp4 = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_mp4" );
$video_m4v = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_m4v" );
$video_webm = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_webm" );
$video_ogv = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_ogv" );
$video_wmv = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_wmv" );
$video_flv = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_flv" );
$video_loop = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_loop" );
$video_autoplay = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_autoplay" );
$video_preload = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_preload" );
$video_iframe = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_iframe" );
if($video_mp4 !== '' || $video_m4v !== '' || $video_webm !== '' || $video_ogv !== '' || $video_wmv !== '' || $video_flv !== '' || $video_iframe !== ''){
	$video_data = 'yes';
}



$custom_title = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_title');
if($custom_title  == 'yes'){
	$use_title = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title');
}
else{
	$use_title = $cesis_data['cesis_portfolio_title'];
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
	$post_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_portfolio_sp_layout');
	$portfolio_agc = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_portfolio_agc');
	$portfolio_agc_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_portfolio_agc_layout');
	$portfolio_agc_style = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_portfolio_style');
	if($portfolio_agc_style == 'inherit'){ $portfolio_agc_style = $cesis_data['cesis_portfolio_style']; }
	$post_navigation = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_portfolio_sp_navigation');
	if($post_navigation == 'inherit'){ $post_navigation = $cesis_data['cesis_portfolio_sp_navigation'];}
	$nav_type = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_portfolio_sp_navigation_style');
	if($nav_type == 'inherit'){$nav_type = $cesis_data['cesis_portfolio_sp_navigation_style'];}
	$gallery_type = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_portfolio_gallery_type');
	if($gallery_type == 'inherit'){ $cesis_data['cesis_portfolio_gallery_type']; }
	$gallery_size = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_portfolio_gallery_size');
	if($gallery_size == 'inherit'){ $gallery_size = $cesis_data['cesis_portfolio_gallery_size']; }
	$share = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_portfolio_sp_share');
	if($share == 'inherit'){ $share = $cesis_data['cesis_portfolio_sp_share']; }
}
else{
	$post_layout = $cesis_data['cesis_portfolio_sp_layout'];
	$portfolio_agc = $cesis_data['cesis_portfolio_agc'];
	$portfolio_agc_layout = $cesis_data['cesis_portfolio_agc_layout'];
	$portfolio_agc_style = $cesis_data['cesis_portfolio_style'];
	$post_navigation = $cesis_data['cesis_portfolio_sp_navigation'];
	$share = $cesis_data['cesis_portfolio_sp_share'];
	$nav_type = $cesis_data['cesis_portfolio_sp_navigation_style'];
	$gallery_type = $cesis_data['cesis_portfolio_gallery_type'];
	$gallery_size = $cesis_data['cesis_portfolio_gallery_size'];

}

$thumb_id = get_post_thumbnail_id();
$img_url = wp_get_attachment_url( $thumb_id,'full' );
$thumb = '<img src="'.cesis_image_ratio( $img_url, $gallery_size).'"/>';

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

<main id="cesis_main" class="site-main vc_full_width_row_container <?php echo esc_attr($row_custom); ?>" role="main">
  <div class="cesis_container portfolio_container">
    <?php

	while ( have_posts() ) : the_post();
	global $post;
	 ?>
    <div class="article_ctn <?php if($post_layout !== 'no_sidebar' && $generate_sidebar == 'yes') { echo esc_attr($post_layout.' has_sidebar');} ?>">
    <?php if($portfolio_agc == 'yes'){ ?>
			<div class="cesis_portfolio_sp_agc <?php echo esc_attr($portfolio_agc_style.' '.$portfolio_agc_layout); ?>">
				<?php if($thumb !== '' && $post_format == '' || $thumb !== '' && $post_format == 'image' ){ ?>
					<div class="cesis_portfolio_m_thumbnail">
					<?php echo $thumb; ?>
					</div>
				<?php }elseif($gallery_data !== '' && $post_format == 'gallery' ){ ?>
					<div class="cesis_portfolio_m_thumbnail cesis_portfolio_gallery_<?php echo esc_attr($gallery_type); ?>">
						<?php cesis_gallery_block($gallery_array, $gallery_type, $gallery_size); ?>
					</div>
				<?php }elseif($audio_file !== ''|| $audio_iframe !== '' && $post_format == 'audio' ){ ?>
					<div class="cesis_audio_ctn  <?php echo esc_attr($audio_type) ?>">
						<?php if($audio_iframe == ''){
										cesis_audio_file($audio_file,$audio_loop,$audio_autoplay,$audio_preload);
									}else{
										echo $audio_iframe;
									} ?>
					</div>
				<?php }elseif($video_data == 'yes' && $post_format == 'video' ){ ?>
					<?php if($video_iframe == ''){
						echo '<div class="cesis_video_ctn">';
						cesis_video_file($video_mp4,$video_m4v,$video_webm,$video_ogv,$video_wmv,$video_flv,$video_loop,$video_autoplay,$video_preload);
					}else{
						echo '<div class="cesis_video_ctn framed">';
						echo $video_iframe;
					} ?>
					</div>
				<?php } ?>
				<div class="cesis_portfolio_sp_info">
					<?php the_title( '<h2 class="portfolio-title">', '</h2>' ); ?>

				<div class="cesis_portfolio_sp_description">
					<?php echo $project_description; ?>
				</div>
				<?php if($share == 'yes'){?>
				<div class="cesis_portfolio_sp_share">
					<?php echo cesis_share('simple'); ?>
				</div>
				<?php } ?>
    		</div>
			</div>
		<?php }

		get_template_part( 'template-parts/content', 'single' );
		if($post_navigation == 'yes' && $prev_post && $nav_pos == 'in' || $post_navigation == 'yes' && $next_post && $nav_pos == 'in') { ?>
			<div class="<?php echo esc_attr($nav_type);?>_navigation">
					<?php if ($main_portfolio_url !== '' && $nav_type == 'agency') { ?>
						<a href="<?php echo esc_url($main_portfolio_url);?>" class="main_posts_page_icon"></a>
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
	<?php if($post_navigation == 'yes' && $prev_post && $nav_pos !== 'in' || $post_navigation == 'yes' && $next_post  && $nav_pos !== 'in') { ?>
	<div class="<?php echo esc_attr($nav_type);?>_navigation">
		<div class="cesis_container">
			<?php if ($main_portfolio_url !== '' && $nav_type == 'agency') { ?>
			<a href="<?php echo esc_url($main_portfolio_url);?>" class="main_posts_page_icon"></a>
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
