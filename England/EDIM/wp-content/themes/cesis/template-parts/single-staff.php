<?php
/**
 * The template for displaying Staff single post.
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
			$banner_pos = $cesis_data['cesis_staff_banner_pos'];
		}
}else {
	$banner_type = $cesis_data['cesis_staff_banner'];
	$banner_pos = $cesis_data['cesis_staff_banner_pos'];
	if(isset($cesis_data['cesis_staff_block_content'])){
	$blockid = $cesis_data['cesis_staff_block_content'];
	}else{
		$blockid = "";
	}

	if(isset($cesis_data['cesis_staff_rev_slider'])){
	$sliderid = $cesis_data['cesis_staff_rev_slider'];
	}
	if(isset($cesis_data['cesis_staff_layer_slider'])){
	$layersliderid = $cesis_data['cesis_staff_layer_slider'];
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
$main_staff_url = $cesis_data['cesis_staff_main_url'];
$custom_title = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_title');
$custom_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_staff_custom_layout');
$member_position = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_member_position" );
$member_description = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_member_description" );
$socials = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_staff_social" );
$thumb = get_the_post_thumbnail( get_the_ID(), 'tn_squared');




if($custom_title  == 'yes'){
	$use_title = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title');
}
else{
	$use_title = $cesis_data['cesis_staff_title'];
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
	$post_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_staff_sp_layout');
	$staff_agc = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_staff_agc');
	$staff_agc_style = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_staff_style');
	if($staff_agc_style  == 'inherit'){	$staff_agc_style = $cesis_data['cesis_staff_style'];	}
	$post_navigation = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_staff_sp_navigation');
	if($post_navigation == 'inherit'){ $post_navigation = $cesis_data['cesis_staff_sp_navigation'];	}
	$nav_type = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_staff_sp_navigation_style');
	if($nav_type == 'inherit'){	$nav_type = $cesis_data['cesis_staff_sp_navigation_style'];	}
}else{
	$post_layout = $cesis_data['cesis_staff_sp_layout'];
	$staff_agc = $cesis_data['cesis_staff_agc'];
	$staff_agc_style = $cesis_data['cesis_staff_style'];
	$post_navigation = $cesis_data['cesis_staff_sp_navigation'];
	$nav_type = $cesis_data['cesis_staff_sp_navigation_style'];
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

<main id="cesis_main" class="site-main vc_full_width_row_container" role="main">
  <div class="cesis_container staff_container">
    <?php

	while ( have_posts() ) : the_post(); ?>
    <div class="article_ctn <?php if($post_layout !== 'no_sidebar' && $generate_sidebar == 'yes') { echo esc_attr($post_layout.' has_sidebar');} ?>">
    <?php if($staff_agc == 'yes'){ ?>
			<div class="cesis_staff_sp_agc <?php echo esc_attr($staff_agc_style); ?>">
				<div class="cesis_staff_sp_thumbnail">
					<?php echo $thumb; ?>
				</div>
				<div class="cesis_staff_sp_info">
					<?php the_title( '<h2 class="staff-title">', '</h2>' ); ?>
					<div class="cesis_staff_sp_position">
						<?php echo $member_position; ?>
					</div>
				<?php
				if(!empty($socials)){
				echo '<div class="cesis_staff_social"><span>';
					foreach($socials as $key => $icon){
						echo '<a href="'.$icon["font-url"].'" class="'.$icon["font-suffix"].' '.$icon["font-icon"].'" target="_blank"></a>';
					}
			 	echo '</span></div>';
				} ?>
				<div class="cesis_staff_sp_description">
					<?php echo do_shortcode($member_description); ?>
				</div>
    		</div>
			</div>
		<?php }

		get_template_part( 'template-parts/content', 'single' );
			if($post_navigation == 'yes' && $prev_post && $nav_pos == 'in' || $post_navigation == 'yes' && $next_post && $nav_pos == 'in') { ?>
					<div class="<?php echo esc_attr($nav_type);?>_navigation">
							<?php if ($main_staff_url !== '' && $nav_type == 'agency') { ?>
								<a href="<?php echo esc_url($main_staff_url);?>" class="main_posts_page_icon"></a>
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
			<?php if ($main_staff_url !== '' && $nav_type == 'agency') { ?>
			<a href="<?php echo esc_url($main_staff_url);?>" class="main_posts_page_icon"></a>
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
