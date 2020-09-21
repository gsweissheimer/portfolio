<?php
/**
 * The template for displaying Boxes single post.
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
		$banner_pos = $cesis_data['cesis_post_banner_pos'];
	}
}else {
	$banner_type = $cesis_data['cesis_post_banner'];
	$banner_pos = $cesis_data['cesis_post_banner_pos'];
	if(isset($cesis_data['cesis_post_block_content'])){
		$blockid = $cesis_data['cesis_post_block_content'];
	}else{
		$blockid = "";
	}
	if(isset($cesis_data['cesis_post_rev_slider'])){
		$sliderid = $cesis_data['cesis_post_rev_slider'];
	}
	if(isset($cesis_data['cesis_post_layer_slider'])){
		$layersliderid = $cesis_data['cesis_post_layer_slider'];
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
$main_blog_url = $cesis_data['cesis_blog_main_url'];

$featured_img_url = get_the_post_thumbnail_url(get_the_ID(), "full");
$custom_title = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title_option');
$custom_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_custom_layout');
// gallery information
$gallery_data = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_gallery" );
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

$custom_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_custom_layout');

$custom_title = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_title');
if($custom_title  == 'yes'){
	$use_title = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title');
}
else{
	$use_title = $cesis_data['cesis_post_title'];
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
	$post_media = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_media');
	if($post_media == 'inherit'){ $post_media = $cesis_data['cesis_blog_media']; }
	$post_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_sp_layout');
	$post_author = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_sp_author');
	if($post_author == 'inherit'){ $post_author = $cesis_data['cesis_blog_sp_author']; }
	$post_navigation = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_sp_navigation');
	if($post_navigation == 'inherit'){ $post_navigation = $cesis_data['cesis_blog_sp_navigation']; }
	$gallery_type = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_gallery_type');
	if($gallery_type == 'inherit'){ $gallery_type = $cesis_data['cesis_blog_gallery_type']; }
	$gallery_size = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_blog_gallery_size');
	if($gallery_size == 'inherit'){ $gallery_size =  $cesis_data['cesis_blog_gallery_size']; }
}else{
	$post_media = $cesis_data['cesis_blog_media'];
	$post_layout = $cesis_data['cesis_blog_sp_layout'];
	$post_author = $cesis_data['cesis_blog_sp_author'];
	$post_navigation = $cesis_data['cesis_blog_sp_navigation'];
	$gallery_type = $cesis_data['cesis_blog_gallery_type'];
	$gallery_size = $cesis_data['cesis_blog_gallery_size'];
}




$thumb_id = get_post_thumbnail_id();
$img_url = wp_get_attachment_url( $thumb_id,'full' );
$thumb = '<img src="'.cesis_image_ratio( $img_url, $gallery_size).'"/>';




if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
	ob_start();
	$post_featured_image = ob_get_contents();
	ob_end_clean();
}
else {
	$post_featured_image = "";

}
	$args = array ('post_background' => $post_featured_image);

if($use_title == 'yes') {
	echo cesis_title($args);
}


do_action( 'cesis_after_main_title' );
?>

<main id="cesis_main" class="site-main vc_full_width_row_container" role="main">
  <div class="cesis_container boxes_container">
    <?php while ( have_posts() ) : the_post(); ?>
    <div class="article_ctn <?php if($post_layout !== 'no_sidebar' && $generate_sidebar == 'yes') { echo esc_attr($post_layout.' has_sidebar');} ?>">
    <?php if($post_media == 'yes'){
		if($thumb !== '' && $post_format == '' || $thumb !== '' && $post_format == 'image' ){ ?>
				<div class="cesis_blog_m_thumbnail">
					<div class="cesis_gallery_img" data-src="<?php echo esc_url($featured_img_url) ?>">
					<?php echo $thumb?>
					</div>
				</div>
			<?php }elseif($gallery_data !== '' && $post_format == 'gallery' ){ ?>
				<div class="cesis_blog_m_thumbnail cesis_blog_gallery_<?php echo esc_attr($gallery_type); ?>">

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
			<?php }
		}
		get_template_part( 'template-parts/content', 'single' );
	if($post_navigation == 'yes' && get_adjacent_post(false, '', true) || $post_navigation == 'yes' && get_adjacent_post(false, '', false) ) { ?>

    <div class="writer_navigation"> <?php if ($main_blog_url !== '' ) { ?>
    <a href="<?php echo esc_url($main_blog_url);?>" class="main_posts_page_icon"></a>
    <?php } ?>
      <?php the_post_navigation( array(
            'prev_text'                  => __( 'Previous', 'cesis' ),
            'next_text'                  => __( 'Next', 'cesis' ),
			)
			); 			 ?>
    </div>

    <?php } $authordesc = get_the_author_meta( 'description' );
		if(!empty($authordesc) && $post_author == 'yes') { ?>
    <div class="author_bio_ctn">
		<?php echo '<a href="'. get_author_posts_url(get_the_author_meta( 'ID' )).'" class="author_posts_link"></a>'; ?>
	<?php if (function_exists('get_avatar')) {

		echo '<div class="avatar">'.get_avatar( get_the_author_meta('email'), 200 ).'</div>';
	}?>
		<div class="author-info">
			<h3><?php the_author(); ?></h3>
			<p><?php the_author_meta('description'); ?></p>
		</div>
	</div>
	<?php } ?>



    <?php
				// If comments are open or we have at least one comment, load up the comment template.
				if ( comments_open() || get_comments_number() ) :
					comments_template();
				endif;
			?>
    </div>
    <?php if($post_layout !== 'no_sidebar' && $generate_sidebar == 'yes') { ?>
    <div class="sidebar_ctn <?php echo esc_attr($post_layout); ?>  <?php echo esc_attr($sidebar_expand); ?>">
    <?php get_sidebar(); ?>
    </div>
    <?php } ?>
    <?php endwhile; // End of the loop. ?>
  </div>
  <!-- .cesis_container -->
</main>
<!-- #cesis_main -->
<?php get_footer(); ?>
