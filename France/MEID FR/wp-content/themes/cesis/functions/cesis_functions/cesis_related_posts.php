<?php
//related blog posts
if(!function_exists('cesis_related_posts'))
{
	function cesis_related_posts($args = false, $id = false){
		global $cesis_data;
		global $post;
		$id = RandomString(20);
		$carousel_data = 'data-col='.$col.' data-col_tablet='.$col_tablet.' data-col_mobile='.$col_mobile.' data-nav='.$nav.' data-nav_tablet='.$nav_tablet.'
		data-nav_mobile='.$nav_mobile.' data-pag='.$pag.' data-pag_tablet='.$pag_tablet.'
		data-pag_mobile='.$pag_mobile.' data-loop='.$loop.' data-center='.$center.' data-margin='.$padding.' data-scroll='.$scroll.' data-speed='.$speed.' '; ?>

		<div id="cesis_blog_<?php  echo esc_attr($id) ?> cesis_blog_related_posts" class="cesis_blog_related_posts cesis_blog_ctn cesis_owl_carousel owl-carousel
		<?php echo esc_attr($style).' '.esc_attr($pag_type).' '.esc_attr($force_font).' '.esc_attr($el_class).' '.esc_attr($responsive_options).' '.esc_attr($hover).' '.esc_attr($effect) ?>"
		 style=" <?php  echo esc_attr($margin_settings) ?>" <?php echo esc_attr($carousel_data) ?> >


<?php

if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post();


	$post_format = get_post_format();
	$custom_link = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_link" );
	if($custom_link !== ''){
		$link = $custom_link;
	}else{
		$link = get_permalink();
	}
	$u_color = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_unique_color" );
	// gallery information
	$gallery_data = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_gallery" );
	if($carousel_type == 'all' && $type == 'carousel'){
		$gallery_type = 'packery';
	}else{
		$gallery_type = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_gallery_type" );
	}
	$gallery_size = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_gallery_size" );
	$gallery_array = explode(',', $gallery_data);
	// audio information
	$audio_file = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_file" );
	$audio_loop = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_loop" );
	$audio_autoplay = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_autoplay" );
	$audio_preload = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_preload" );
	$audio_iframe = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_iframe" );
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
	// hover settings
	if($hover == 'cesis_hover_overlay'){
		$hover_ctn = '<div class="cesis_overlay_ctn"></div>';
	}
	elseif($hover == 'cesis_hover_icon'){
		$hover_ctn = '<div class="cesis_overlay_ctn"><span class="cesis_hover_zoom" data-src="'.wp_get_attachment_image_url(  get_post_thumbnail_id($blog_query->ID), '' ).'"><span class="cesis_eye_icon"></span></span>
		<span class="cesis_hover_link"><span class="cesis_dots_icon"></span></span>
		</div>';
	}
	else{
		$hover_ctn = '';
	}
	$excerpt = get_the_excerpt();
	$cat_filter = "" ;
	$item_cat = "" ;
	$item_tag = "" ;
	$cat_list = get_the_terms($blog_query->ID, 'category');
	if(is_array($cat_list) || is_object($cat_list)){
		foreach($cat_list as $cat_single) {
			$item_cat .= 'f_'.$cat_single->term_id.' ';
		}
	}
	$tag_list = get_the_terms($blog_query->ID, 'post_tag');
	if(is_array($tag_list) || is_object($tag_list)){
		foreach($tag_list as $tag_single) {
			$item_tag .= 'f_'.$tag_single->term_id.' ';
		}
	}
	if($excerpt == ''){ $excerpt = cesis_content();}
	if($style == 'cesis_blog_style_5' || $style == 'cesis_blog_style_6' ){
		$blog_layout = 'alt';
		$cat_list = '<span class="cesis_blog_m_category">'.get_the_category_list(' ').'</span>';
		$tag_list = '<span class="cesis_blog_m_tag">'.get_the_tag_list('',' ').'</span>';
	}elseif($style == 'cesis_blog_style_10'){
		$blog_layout = 'altsec';
		$cat_list = '<span class="cesis_blog_m_category">'.get_the_category_list(', ').'</span>';
		$tag_list = '<span class="cesis_blog_m_tag">'.get_the_tag_list('',', ').'</span>';
	}elseif($style == 'cesis_blog_style_11'){
		$blog_layout = 'alt';
		$cat_list = '<span class="cesis_blog_m_category">'.get_the_term_list('','category','<span style="background:'.$u_color.'">','</span><span style="background:'.$u_color.'">','</span>').'</span>';
		$tag_list = '<span class="cesis_blog_m_tag">'.get_the_tag_list('<span style="background:'.$u_color.'">','</span><span style="background:'.$u_color.'">','</span>').'</span>';
	}else{
		$blog_layout = '';
		$cat_list = '<span class="cesis_blog_m_category">'.get_the_category_list(', ').'</span>';
		$tag_list = '<span class="cesis_blog_m_tag">'.get_the_tag_list('',', ').'</span>';
	}

	$author = '<span class="cesis_blog_m_author">'.get_the_author_link().'</span>';
	$date = '<span class="cesis_blog_m_date">'.get_the_time(get_option('date_format')).'</span>';
	$comments = '<span class="cesis_blog_m_comment">'.cesis_get_comments().'</span>';
	$like = '<span class="cesis_blog_m_author">'.get_the_author_link().'</span>';

?>
<div class="inside_e <?php echo esc_attr($animation)?>">

<?php if($style !== 'cesis_blog_style_9' && $style !== 'cesis_blog_style_10' && $style !== 'cesis_blog_style_11' && $style !== 'cesis_blog_style_12' && $style !== 'cesis_blog_style_13'  ){
?>

			<div class="cesis_blog_m_thumbnail">
				<a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
				<?php echo $hover_ctn.' '.$thumb?>
				</a>
			</div>
			<div class="cesis_blog_m_content">

			<?php if($blog_layout == 'alt'){ ?>
							<div class="cesis_blog_m_bt_info">
							<?php
		if($i_category == 'yes' && has_category() ){echo $cat_list;}
		if($i_tag == 'yes' && has_tag()){echo $tag_list;}
		?>
							</div>
							<?php } ?>

						<h2 class="cesis_blog_m_title"><a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>"><?php echo the_title(); ?></a></h2>
	<?php if($i_author == 'yes' || $i_date == 'yes' || $i_category == 'yes' || $i_tag == 'yes' || $i_comment == 'yes' || $i_like == 'yes' ){ ?>
							<div class="cesis_blog_m_top_info">
							<?php
		if($i_author == 'yes' ){echo $author;}
		if($i_date == 'yes' ){echo $date;}
		if($i_category == 'yes' && has_category() && $blog_layout !== 'alt' ){echo $cat_list;}
		if($i_tag == 'yes' && has_tag() && $blog_layout !== 'alt'){echo $tag_list;}
		if($i_comment == 'yes' && $style !== 'cesis_blog_style_6' && $style !== 'cesis_blog_style_8'){echo $comments;}
		if($i_like == 'yes' && function_exists('zilla_likes') && $style !== 'cesis_blog_style_6' && $style !== 'cesis_blog_style_8' ){	echo do_shortcode('[zilla_likes]');}
		?>
							</div>
						<?php } ?>
						<?php if($i_text == 'yes'){ ?>
							<div class="cesis_blog_m_entry">
							<?php if($text_source == 'content' && $char_length !== '' ){ echo cesis_text_truncate(cesis_content(), $char_length); }
			elseif($text_source == 'excerpt' && $char_length !== '' ){  echo cesis_text_truncate($excerpt, $char_length); }
			elseif($text_source == 'content'){ echo the_content(); }elseif($text_source == 'excerpt'){ echo $excerpt; }?>
							</div>
						<?php } ?>
						<?php if($read_more == 'yes'){ ?>
							<div class="cesis_m_more_link">
							<?php
		echo '<a href="'.$link.'" class="'.$rm_class.'" '.$rm_style.' target="'.$target.'">'.__('Read more', 'cesis').'</a>';
		?>
							</div>
						<?php } ?>
						<?php if($style == 'cesis_blog_style_6' || $style == 'cesis_blog_style_8' ){
		if($i_comment == 'yes' || $i_like == 'yes'){  ?>
								<div class="cesis_blog_m_bottom_info">
								<?php
			if($i_comment == 'yes'){echo $comments;}
			if($i_like == 'yes' && function_exists('zilla_likes') ){	echo do_shortcode('[zilla_likes]');}
			?>
								</div>
						<?php }
	}
						?>
						</div>
			<?php
} // start on image style
else{
	if($thumb == ''){ $thumb = '<div class="no_img_placeholder"></div>'; } ?>
	<div class="cesis_blog_m_thumbnail">
					<a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
	<?php echo $thumb?>
	</a>
						<div class="cesis_blog_m_content on_image_style" <?php echo esc_attr($content_style) ?>>

								<div class="cesis_blog_m_inner_content">

								<?php if($blog_layout == 'alt' || $blog_layout == 'altsec' ){ ?>
							<div class="cesis_blog_m_bt_info">
							<?php
		if($i_author == 'yes' && $blog_layout == 'altsec' ){echo $author;}
		if($i_date == 'yes' && $blog_layout == 'altsec' ){echo $date;}
		if($i_category == 'yes' && has_category() && $blog_layout == 'alt' ){echo $cat_list;}
		if($i_tag == 'yes' && has_tag()  && $blog_layout == 'alt'){echo $tag_list;}
		?>
							</div>
							<?php } ?>

						<h2 class="cesis_blog_m_title title_filter"><a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>"><?php echo the_title(); ?></a></h2>
	<?php if($i_author == 'yes' || $i_date == 'yes' || $i_category == 'yes' || $i_tag == 'yes' || $i_comment == 'yes' || $i_like == 'yes' ){ ?>
							<div class="cesis_blog_m_top_info">
							<?php
		if($i_author == 'yes' && $blog_layout !== 'altsec'){echo $author;}
		if($i_date == 'yes' && $blog_layout !== 'altsec'){echo $date;}
		if($i_category == 'yes' && has_category() && $blog_layout !== 'alt' ){echo $cat_list;}
		if($i_tag == 'yes' && has_tag() && $blog_layout !== 'alt'){echo $tag_list;}
		if($i_comment == 'yes'){echo $comments;}
		if($i_like == 'yes' && function_exists('zilla_likes') ){	echo do_shortcode('[zilla_likes]');}
		?>
							</div>
						<?php } ?>
						<?php if($i_text == 'yes'){ ?>
							<div class="cesis_blog_m_entry">
							<?php if($text_source == 'content' && $char_length !== '' ){ echo cesis_text_truncate(cesis_content(), $char_length); }
			elseif($text_source == 'excerpt' && $char_length !== '' ){  echo cesis_text_truncate($excerpt, $char_length); }
			elseif($text_source == 'content'){ echo the_content(); }elseif($text_source == 'excerpt'){ echo $excerpt; }?>
							</div>
						<?php } ?>
						<?php if($read_more == 'yes'){ ?>
							<div class="cesis_m_more_link">
							<?php
		echo '<a href="'.$link.'" class="'.$rm_class.'" '.$rm_style.' target="'.$target.'">'.__('Read more', 'cesis').'</a>';
		?>
							</div>
						<?php } ?>
								</div>
						</div>
								</div>








						<?php } ?>
						</div>
						<?php
						endwhile; endif;

						echo '</div>';
						wp_reset_postdata();

						$output_string = ob_get_contents();
						ob_end_clean();
						return $output_string;
	}
}
