<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Cesis
 */

global $cesis_data;

get_header();

$allsearch = new WP_Query("s=$s&posts_per_page=-1");
$key = esc_html($s, 1);
$count = $allsearch->post_count;
$sidebar_expand = $generate_sidebar = '';

$page_layout = $cesis_data['cesis_search_layout'];
$nav_style = $cesis_data['cesis_search_archive_navigation_style'];
$nav_pos = $cesis_data['cesis_search_archive_navigation_pos'];
$nav_top_space = $cesis_data['cesis_search_archive_navigation_space']["height"];

$result_text = $cesis_data['cesis_search_results_text'];
$search_form = $cesis_data['cesis_search_form'];

$type = $cesis_data['cesis_search_archive_type'];
$col = $cesis_data['cesis_search_archive_col'];
$padding = $cesis_data['cesis_search_archive_padding'];
$new_padding = ($padding / 2);



	$banner_type = $cesis_data['cesis_search_banner'];
	$banner_pos = $cesis_data['cesis_search_banner_pos'];

	if(isset($cesis_data['cesis_search_block_content'])){
		$blockid = $cesis_data['cesis_search_block_content'];
	}else{
		$blockid = "";
	}
	if(isset($cesis_data['cesis_search_rev_slider'])){
		$sliderid = $cesis_data['cesis_search_rev_slider'];
	}
	if(isset($cesis_data['cesis_search_layer_slider'])){
		$layersliderid = $cesis_data['cesis_search_layer_slider'];
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
elseif($banner_type == 'layerslider' && $layersliderid !== "" && $banner_pos == 'under'){
	echo '<div class="cesis_slider_rev_ctn">'.do_shortcode('[layerslider id="'.$layersliderid.'"]').'</div>';
}

$use_title = $cesis_data['cesis_search_title'];

if($use_title == 'yes') {
	echo cesis_title();
}

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
  if ( cesis_check_ccp_status() == false ) {
$page_layout = 'r_sidebar';
$search_form = 'no';
	}

do_action( 'cesis_after_main_title' );

?>




<main id="cesis_main" class="site-main vc_full_width_row_container" role="main">
  <div class="cesis_container">
    <div class="article_ctn <?php if($page_layout !== 'no_sidebar' && $generate_sidebar == 'yes') { echo esc_attr($page_layout.' has_sidebar');} ?>">

			<?php if($result_text == 'yes'){
				if($count == "1"){?>
	    <h2 class="cesis_search_results_text"><?php echo esc_html($count).' '.__('result for', 'cesis').' "<strong>'.$key.'</strong>"'; ?></h1>
			<?php }else{?>
	    <h2 class="cesis_search_results_text"><?php echo esc_html($count).' '.__('results for', 'cesis').' "<strong>'.$key.'</strong>"'; ?></h1>
			<?php }
			} ?>
				<?php if ( have_posts() ) : ?>
					<?php if($search_form == 'yes'){  ?>
			   <div class="no-results"> <p><?php echo __('If you didn\'t find what you were looking for, try again!', 'cesis'); ?></p>

				<?php get_search_form();?>
				</div>
				<?php } ?>
					<div id="cesis_search_container" class="cesis_isotope_container">
						<div class="cesis_search_ctn cesis_isotope col_<?php  echo esc_attr($col) ?> <?php  echo esc_attr($type) ?>" style="margin-left:-<?php echo esc_attr($new_padding) ?>px; margin-right:-<?php echo esc_attr($new_padding) ?>px;" data-layout="fitRows" >

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>


				<?php
				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );
				?>

				<?php endwhile; ?>


						<?php else : ?>

	<div id="cesis_search_container" class="cesis_isotope_container">
		<div>
							<?php get_template_part( 'template-parts/content', 'none' ); ?>

						<?php endif; ?>
</div>
</div>

<?php echo '<div class="cesis_navigation_ctn cesis_classic_navigation '.$nav_pos.' '.$nav_style.'" style="margin-top:'.$nav_top_space.';">';
echo cesis_classic_navigation();
echo '</div>'; ?>

    </div>

    <?php if($page_layout !== 'no_sidebar' && $generate_sidebar == 'yes'){ ?>
    <div class="sidebar_ctn <?php echo esc_attr($page_layout); ?>  <?php echo esc_attr($sidebar_expand); ?>">
    <?php get_sidebar(); ?>
    </div>
    <?php } ?>


   </div>
   <!-- .container -->
 </main>
 <!-- #main -->
<?php get_footer(); ?>
