<?php
if (!function_exists('cesis_ajax_load')) {

add_action('wp_ajax_nopriv_cesis_ajax_load', 'cesis_ajax_load');
add_action('wp_ajax_cesis_ajax_load', 'cesis_ajax_load');


	function cesis_ajax_load(){
	if ( class_exists("Vc_base") ) {
  WPBMap::addAllMappedShortcodes();
	}

			global $cesis_data;
	    $post_type     = (isset($_POST['post_type'])) ? $_POST['post_type'] : 0;
	    $style     = (isset($_POST['style'])) ? $_POST['style'] : 0;
	    $type     = (isset($_POST['type'])) ? $_POST['type'] : 0;
	    $packery_type     = (isset($_POST['packery_type'])) ? $_POST['packery_type'] : 0;
	    $load     = (isset($_POST['to_load'])) ? $_POST['to_load'] : 1;
	    $category     = (isset($_POST['cat'])) ? $_POST['cat'] : 0;
	    $tag     = (isset($_POST['tag'])) ? $_POST['tag'] : 0;
	    $offset  = (isset($_POST['offset'])) ? $_POST['offset'] : 0;
	    $order  = (isset($_POST['order'])) ? $_POST['order'] : 0;
			$thumbnail_size = (isset($_POST['thumbnail'])) ? $_POST['thumbnail'] : 0;
	    $target  = (isset($_POST['target'])) ? $_POST['target'] : 0;
	    $heading_font  = (isset($_POST['heading'])) ? $_POST['heading'] : 0;
	    $i_author  = (isset($_POST['i_author'])) ? $_POST['i_author'] : 0;
	    $i_date  = (isset($_POST['i_date'])) ? $_POST['i_date'] : 0;
	    $i_location  = (isset($_POST['i_location'])) ? $_POST['i_location'] : 0;
	    $i_category  = (isset($_POST['i_category'])) ? $_POST['i_category'] : 0;
	    $i_tag  = (isset($_POST['i_tag'])) ? $_POST['i_tag'] : 0;
	    $i_comment  = (isset($_POST['i_comment'])) ? $_POST['i_comment'] : 0;
	    $i_addtocart  = (isset($_POST['i_addtocart'])) ? $_POST['i_addtocart'] : 0;
	    $i_rating  = (isset($_POST['i_rating'])) ? $_POST['i_rating'] : 0;
	    $i_price  = (isset($_POST['i_price'])) ? $_POST['i_price'] : 0;
	    $i_like  = (isset($_POST['i_like'])) ? $_POST['i_like'] : 0;
	    $i_text  = (isset($_POST['i_text'])) ? $_POST['i_text'] : 0;
	    $i_social  = (isset($_POST['i_social'])) ? $_POST['i_social'] : 0;
	    $text_source  = (isset($_POST['text_source'])) ? $_POST['text_source'] : 0;
	    $char_length = (isset($_POST['char_length'])) ? $_POST['char_length'] : 0;
	    $read_more = (isset($_POST['read_more'])) ? $_POST['read_more'] : 0;
			$rm_b_color = (isset($_POST['read_more_lb'])) ? $_POST['read_more_lb'] : 0;
			$rm_bg_color = (isset($_POST['read_more_lbg'])) ? $_POST['read_more_lbg'] : 0;
			$rm_t_color = (isset($_POST['read_more_lc'])) ? $_POST['read_more_lc'] : 0;
			$rm_hb_color = (isset($_POST['read_more_lb'])) ? $_POST['read_more_eb'] : 0;
			$rm_hbg_color = (isset($_POST['read_more_lbg'])) ? $_POST['read_more_ebg'] : 0;
			$rm_ht_color = (isset($_POST['read_more_lc'])) ? $_POST['read_more_ec'] : 0;
			$rm_style_default = (isset($_POST['read_more_default'])) ? $_POST['read_more_default'] : 0;
	    $rm_class = (isset($_POST['read_more_class'])) ? $_POST['read_more_class'] : 0;
	    $new_padding = (isset($_POST['padding'])) ? $_POST['padding'] : 0;
	    $inner_padding = (isset($_POST['inner_padding'])) ? $_POST['inner_padding'] : 0;
	    $animation  = (isset($_POST['animation'])) ? $_POST['animation'] : 0;
	    $hover  = (isset($_POST['hover'])) ? $_POST['hover'] : 0;
			$cp = ($offset + $load ) / $load;

			$rm_style = 'onmouseleave="this.style.borderColor=\''.$rm_b_color.'\'; this.style.backgroundColor=\''.$rm_bg_color.'\'; this.style.color=\''.$rm_t_color.'\';" onmouseenter="this.style.borderColor=\''.$rm_hb_color.'\'; this.style.backgroundColor=\''.$rm_hbg_color.'\'; this.style.color=\''.$rm_ht_color.'\';" style="'.$rm_style_default.'"';

if($post_type == "partners"){
	$cat_array = explode( ',', $category );
// Partners posts
if ($category!=="all" && $category!=="" && $Category!=="undefined") {
	$args = array(
		'post_type' => "partners",
		'order' => $order,
		'orderby' => $orderby,
    'offset' => $offset,
	  "posts_per_page" => $load,
		'post__not_in' => array( get_the_ID() ),
		'tax_query' => array(
      array(
      'taxonomy' => 'groups',
      'field' => 'term_id',
      'post_status' => 'publish',
      'terms' => $cat_array
      ),
		),
	);
}
else{
	$args = array(
        'post_type' => "partners",
		'order' => $order,
		'orderby' => $orderby,
        'offset' => $offset,
       	'post_status' => 'publish',
        'posts_per_page' => $load,
	);
}

	    $loop = new WP_Query($args);

		$output = '';
	    if ($loop -> have_posts()) :
	    	while ($loop -> have_posts()) :
	    		$loop -> the_post();

	ob_start();

	$link = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_partner_link" );
	$thumb = get_the_post_thumbnail( $loop->ID, 'full');
	if($link !== ''){
	$output .='
	<div class="cesis_iso_item">
	<div class="inside_e '.$animation.'">
    <a href="'.$link.'" target="'.$target.'">
    '.$thumb.'
    </a>
	</div>
    </div>';
	}else{
	$output .='
	<div class="cesis_iso_item">
	<div class="inside_e '.$animation.'">
    '.$thumb.'
	</div>
    </div>';
	}

	    	endwhile;
	    endif;

echo '<div id="cp">'.$cp.'</div>';
echo '<div id="mp">'.$loop->max_num_pages.'</div>';
echo $output;
$output_string = ob_get_contents();

ob_end_clean();

wp_reset_postdata();


}
if( $post_type == "blog" ){
	if($type == 'isotope_packery'){
		$new_padding = '0';
	}

			$cat_array = explode( ',', $category );
			$tag_array = explode( ',', $tag );
	$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
		'order' => $order,
		'orderby' => $orderby,
		'offset' => $offset,
				'posts_per_page' => $load,
    		'post__not_in' => array( get_the_ID() ),
		);
		if ($category !== '' && $category !== "all" && $tag !== '' && $tag !== "all") {
		$args['tax_query']=array(
				array(
					'taxonomy' => 'category',
					'field' => 'term_id',
						'terms' => $cat_array
				),
		array(
					'taxonomy' => 'post_tag',
					'field' => 'term_id',
						'terms' => $tag_array
				));
	}elseif ($category !== '' && $category !== "all") {
		$args['tax_query']=array(
				array(
					'taxonomy' => 'category',
						'field' => 'term_id',
						'terms' => $cat_array
				));
		}elseif ($tag !== '' && $tag !== "all") {
		$args['tax_query']=array(
				array(
					'taxonomy' => 'post_tag',
					'field' => 'term_id',
						'terms' => $tag_array
				));
		}

	$blog_query = new WP_Query($args);
	// other options settings

	if($style == 'cesis_blog_style_9' || $style == 'cesis_blog_style_10' || $style == 'cesis_blog_style_11' || $style == 'cesis_blog_style_12' || $style == 'cesis_blog_style_13' ){
		$content_style = 'style=padding:'.$inner_padding.';';
	}
	else{
		$content_style = '';
	}

		if ($blog_query->have_posts()) : while ($blog_query->have_posts()) : $blog_query->the_post();

			ob_start();

			$custom_link = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_link" );
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' );
			if($custom_link !== ''){
				$link = $custom_link;
			}else{
				$link = get_permalink();
			}
			$u_color = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_unique_color" );
			$post_format = get_post_format();
			// gallery information
			$gallery_data = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_gallery" );
			if($carousel_type == 'all' && $type == 'carousel'){
				$gallery_type = 'packery';
			}else{
				$gallery_type = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_gallery_type" );
				if($gallery_type == ""){ $gallery_type = 'carousel';}
			}
			$gallery_size = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_gallery_size" );
			if($gallery_size == ""){ $gallery_size = 'tn_rectangle_3_2';}
			$gallery_array = explode(',', $gallery_data);
			// audio information
			$audio_file = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_file" );
			$audio_loop = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_loop" );
			if($audio_loop == ""){ $audio_loop = 'off';}
			$audio_autoplay = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_autoplay" );
			if($audio_autoplay == ""){ $audio_autoplay = '0';}
			$audio_preload = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_preload" );
			if($audio_preload == ""){ $audio_preload = 'none';}
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
			if($video_loop == ""){ $video_loop = 'off';}
			$video_autoplay = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_autoplay" );
			if($video_autoplay == ""){ $video_autoplay = '0';}
			$video_preload = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_preload" );
			if($video_preload == ""){ $video_preload = 'none';}
			$video_iframe = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_iframe" );
			if($video_mp4 !== '' || $video_m4v !== '' || $video_webm !== '' || $video_ogv !== '' || $video_wmv !== '' || $video_flv !== '' || $video_iframe !== ''){
				$video_data = 'yes';
			}
			// hover settings
			if($hover == 'cesis_hover_overlay'){
				$hover_ctn = '<div class="cesis_overlay_ctn"></div>';
			}
			elseif($hover == 'cesis_hover_icon'){
				$test = wp_get_attachment_image_url( $blog_query->ID, '' );
				$hover_ctn = '<div class="cesis_overlay_ctn"><span class="cesis_hover_zoom" data-src="'.wp_get_attachment_image_url(  get_post_thumbnail_id($blog_query->ID), '' ).'"><span class="cesis_eye_icon"></span></span>
				<span class="cesis_hover_link"><span class="cesis_dots_icon"></span></span>
				</div>';
			}
			else{
				$hover_ctn = '';
			}
			// ohter settings
			if($type == 'isotope_packery'){
				$packery_class = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_packery_size" );
				if($packery_class == ''){
					$packery_class = 'cesis_packery_squared';
				}
				$new_padding = '0';
				if($packery_type == "squared"){
					if($packery_class == 'cesis_packery_squared' || $packery_class == 'cesis_packery_big_squared'){
						$thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_squared').'"/>';
					}
					if($packery_class == 'cesis_packery_landscape'){
						$thumb = '<img src="'.cesis_image_ratio($img_url, 'tn_landscape_4_2').'"/>';
					}
					if($packery_class == 'cesis_packery_portrait'){
						$thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_portrait_2_4').'"/>';
					}
				}else{
					if($packery_class == 'cesis_packery_squared' || $packery_class == 'cesis_packery_big_squared'){
						$thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_rectangle_4_3').'"/>';
					}
					if($packery_class == 'cesis_packery_landscape'){
						$thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_landscape_8_3').'"/>';
					}
					if($packery_class == 'cesis_packery_portrait'){
						$thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_portrait_2_3').'"/>';
					}
				}
			}else{
				$thumb = '<img src="'.cesis_image_ratio( $img_url, $thumbnail_size).'"/>';
				$packery_class = "";
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
				<div class="cesis_iso_item <?php echo esc_attr($item_cat).' '.esc_attr($item_tag).' '.esc_attr($packery_class) ?>" style="padding:<?php echo esc_attr($new_padding) ?>px;">
				<div class="cesis_isotope_filter_data"><span class="isotope_filter_name"><?php echo the_title(); ?></span><span class="isotope_filter_date"><?php echo the_time('YmdHis'); ?></span></div>

				<div class="inside_e <?php echo esc_attr($animation) ?>">

				<?php if($style !== 'cesis_blog_style_9' && $style !== 'cesis_blog_style_10' && $style !== 'cesis_blog_style_11' && $style !== 'cesis_blog_style_12' && $style !== 'cesis_blog_style_13'  ){


					if($type !== 'carousel' && $type !== 'isotope_grid' || $carousel_type == 'all' ){
					if($thumb !== '' && $post_format == '' || $thumb !== '' && $post_format == 'image' ){ ?>
							<div class="cesis_blog_m_thumbnail">
								<a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
								<?php echo $hover_ctn.' '.$thumb?>
								</a>
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
				}else{?>
						<div class="cesis_blog_m_thumbnail">
							<a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
							<?php echo $hover_ctn.' '.$thumb?>
							</a>
						</div>
				<?php }	 ?>



							<div class="cesis_blog_m_content">

							<?php if($blog_layout == 'alt'){ ?>
											<div class="cesis_blog_m_bt_info">
											<?php
						if($i_category == 'yes' && has_category() ){echo $cat_list;}
						if($i_tag == 'yes' && has_tag()){echo $tag_list;}
						?>
											</div>
											<?php } ?>

										<h2 class="cesis_blog_m_title <?php echo esc_attr($heading_font)?>"><a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>"><?php echo the_title(); ?></a></h2>
					<?php if($i_author == 'yes' || $i_date == 'yes' || $i_category == 'yes' || $i_tag == 'yes' || $i_comment == 'yes' || $i_like == 'yes'  ){ ?>
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
				<?php } //start on image style
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

										<h2 class="cesis_blog_m_title title_filter  <?php echo esc_attr($heading_font)?>"><a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>"><?php echo the_title(); ?></a></h2>
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
									</div>

			<?php endwhile; endif;
		echo '<div id="cp">'.$cp.'</div>';
		echo '<div id="mp">'.$blog_query->max_num_pages.'</div>';

    wp_reset_postdata();

	$output_string = ob_get_contents();
	ob_end_clean();

}

if( $post_type == "portfolio" ){


			$cat_array = explode( ',', $category );
			$tag_array = explode( ',', $tag );
	$args = array(
				'post_type' => 'portfolio',
				'post_status' => 'publish',
		'order' => $order,
		'orderby' => $orderby,
		'offset' => $offset,
				'posts_per_page' => $load,
    		'post__not_in' => array( get_the_ID() ),
		);
		if ($category !== '' && $category !== "all" && $tag !== '' && $tag !== "all") {
		$args['tax_query']=array(
				array(
					'taxonomy' => 'portfolio_category',
					'field' => 'term_id',
						'terms' => $cat_array
				),
		array(
					'taxonomy' => 'portfolio_tag',
					'field' => 'term_id',
						'terms' => $tag_array
				));
	}elseif ($category !== '' && $category !== "all") {
		$args['tax_query']=array(
				array(
					'taxonomy' => 'portfolio_category',
						'field' => 'term_id',
						'terms' => $cat_array
				));
		}elseif ($tag !== '' && $tag !== "all") {
		$args['tax_query']=array(
				array(
					'taxonomy' => 'portfolio_tag',
					'field' => 'term_id',
						'terms' => $tag_array
				));
		}


			ob_start();
	$portfolio_query = new WP_Query($args);
	if($effect == 'cesis_effect_frame' && $type == 'isotope_packery' && $padding !== '0'){
		$new_padding = $new_padding - 10;
	}
  	if ($portfolio_query->have_posts()) : while ($portfolio_query->have_posts()) : $portfolio_query->the_post();


			$post_format = get_post_format();
			$custom_link = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_link" );
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' );
			$project_description = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_description" );
			if($custom_link !== ''){
				$link = $custom_link;
			}else{
				$link = get_permalink();
			}
			$u_color = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_unique_color" );
			if($style == 'cesis_portfolio_style_7' || $style == 'cesis_portfolio_style_8' || $style == 'cesis_portfolio_style_9' || $style == 'cesis_portfolio_style_10' || $style == 'cesis_portfolio_style_11' ){
				$content_style = 'style=padding:'.$inner_padding.';';
			}
			else{
				$content_style = '';
			}
			// gallery information
			$gallery_data = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_gallery" );
			if($carousel_type == 'all' && $type == 'carousel'){
				$gallery_type = 'packery';
			}else{
				$gallery_type = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_gallery_type" );
				if($gallery_type == ""){ $gallery_type = 'carousel';}
			}

			$gallery_size = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_gallery_size" );
			if($gallery_size == ""){ $gallery_size = 'tn_rectangle_3_2';}
			$gallery_array = explode(',', $gallery_data);
			// audio information
			$audio_file = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_file" );
			$audio_loop = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_loop" );
			if($audio_loop == ""){ $audio_loop = 'off';}
			$audio_autoplay = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_autoplay" );
			if($audio_autoplay == ""){ $audio_autoplay = '0';}
			$audio_preload = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_audio_preload" );
			if($audio_preload == ""){ $audio_preload = 'none';}
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
			if($video_loop == ""){ $video_loop = 'off';}
			$video_autoplay = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_autoplay" );
			if($video_autoplay == ""){ $video_autoplay = '0';}
			$video_preload = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_preload" );
			if($video_preload == ""){ $video_preload = 'none';}
			$video_iframe = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_video_iframe" );
			if($video_mp4 !== '' || $video_m4v !== '' || $video_webm !== '' || $video_ogv !== '' || $video_wmv !== '' || $video_flv !== '' || $video_iframe !== ''){
				$video_data = 'yes';
			}


			// hover settings
			if($hover == 'cesis_hover_overlay'){
				$hover_ctn = '<div class="cesis_overlay_ctn"></div>';
			}
			elseif($hover == 'cesis_hover_icon'){
				$hover_ctn = '<div class="cesis_overlay_ctn"><span class="cesis_hover_zoom" data-src="'.wp_get_attachment_image_url(  get_post_thumbnail_id($portfolio_query->ID), '' ).'"><span class="cesis_eye_icon"></span></span>
				<span class="cesis_hover_link"><span class="cesis_dots_icon"></span></span>
				</div>';
			}
			else{
				$hover_ctn = '';
			}
			// ohter settings
			if($type == 'isotope_packery'){
				$packery_class = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_packery_size" );
				if($packery_class == ''){
					$packery_class = 'cesis_packery_squared';
				}
				$new_padding = '0';
				if($packery_type == "squared"){
					if($packery_class == 'cesis_packery_squared' || $packery_class == 'cesis_packery_big_squared'){
						$thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_squared').'"/>';
					}
					if($packery_class == 'cesis_packery_landscape'){
						$thumb = '<img src="'.cesis_image_ratio($img_url, 'tn_landscape_4_2').'"/>';
					}
					if($packery_class == 'cesis_packery_portrait'){
						$thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_portrait_2_4').'"/>';
					}
				}else{
					if($packery_class == 'cesis_packery_squared' || $packery_class == 'cesis_packery_big_squared'){
						$thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_rectangle_4_3').'"/>';
					}
					if($packery_class == 'cesis_packery_landscape'){
						$thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_landscape_8_3').'"/>';
					}
					if($packery_class == 'cesis_packery_portrait'){
						$thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_portrait_2_3').'"/>';
					}
				}
			}else{

				$thumb = '<img src="'.cesis_image_ratio( $img_url, $thumbnail_size).'"/>';
				$packery_class = "";
			}
			$cat_filter = "" ;
			$item_cat = "" ;
			$item_tag = "" ;
			$cat_list = get_the_terms($portfolio_query->ID, 'portfolio_category');
			if(is_array($cat_list) || is_object($cat_list)){
				foreach($cat_list as $cat_single) {
					$item_cat .= 'f_'.$cat_single->term_id.' ';
				}
			}
			$tag_list = get_the_terms($portfolio_query->ID, 'portfolio_tag');
			if(is_array($tag_list) || is_object($tag_list)){
				foreach($tag_list as $tag_single) {
					$item_tag .= 'f_'.$tag_single->term_id.' ';
				}
			}

			if($style == 'cesis_portfolio_style_2' || $style == 'cesis_portfolio_style_5' || $style == 'cesis_portfolio_style_3' || $style == 'cesis_portfolio_style_6' || $style == 'cesis_portfolio_style_9' || $style == 'cesis_portfolio_style_10'  || $style == 'cesis_portfolio_style_11' ){
				$cat_list = '<span class="cesis_portfolio_m_category">'.get_the_term_list('','portfolio_category', '',', ','').'</span>';
				$tag_list = '<span class="cesis_portfolio_m_tag">'.get_the_term_list('','portfolio_tag', '',', ','').'</span>';
			}else{
				$cat_list = '<span class="cesis_portfolio_m_category">'.get_the_term_list('','portfolio_category', '',' ','').'</span>';
				$tag_list = '<span class="cesis_portfolio_m_tag">'.get_the_term_list('','portfolio_tag', '',' ','').'</span>';
			}

			$author = '<span class="cesis_portfolio_m_author">'.get_the_author_link().'</span>';
			$date = '<span class="cesis_portfolio_m_date">'.get_the_time(get_option('date_format')).'</span>';
			$comments = '<span class="cesis_portfolio_m_comment">'.cesis_get_comments().'</span>';
			$like = '<span class="cesis_portfolio_m_author">'.get_the_author_link().'</span>';

		?>
				<div class="cesis_iso_item <?php echo esc_attr($item_cat).' '.esc_attr($item_tag).' '.esc_attr($packery_class) ?>" style="padding:<?php echo esc_attr($new_padding) ?>px;">
				<div class="cesis_isotope_filter_data"><span class="isotope_filter_name"><?php echo the_title(); ?></span><span class="isotope_filter_date"><?php echo the_time('YmdHis'); ?></span></div>
				<div class="inside_e <?php echo esc_attr($animation) ?>">

				<?php if($style !== 'cesis_portfolio_style_7' && $style !== 'cesis_portfolio_style_8' && $style !== 'cesis_portfolio_style_9' && $style !== 'cesis_portfolio_style_10' && $style !== 'cesis_portfolio_style_11'  ){


				if($type !== 'carousel' && $type !== 'isotope_grid' || $carousel_type == 'all' ){
					if($thumb !== '' && $post_format == '' || $thumb !== '' && $post_format == 'image' ){ ?>
							<div class="cesis_portfolio_m_thumbnail">
								<a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
								<?php echo $hover_ctn.' '.$thumb?>
								</a>
							</div>
						<?php }elseif($gallery_data !== '' && $post_format == 'gallery' ){ ?>
							<div class="cesis_portfolio_m_thumbnail cesis_portfolio_gallery_<?php echo esc_attr($gallery_type); ?>">
								<?php cesis_gallery_block($gallery_array, $gallery_type, $gallery_size); ?>
							</div>
						<?php }elseif($audio_file !== ''|| $audio_iframe !== '' && $post_format == 'audio' ){ ?>
							<div class="cesis_audio_ctn <?php echo esc_attr($audio_type) ?>">
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
				}else{?>
						<div class="cesis_portfolio_m_thumbnail">
							<a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
							<?php echo $hover_ctn.' '.$thumb?>
							</a>
						</div>
				<?php }	 ?>

							<div class="cesis_portfolio_m_content">
<?php if(  $i_category == 'yes' && $style == 'cesis_portfolio_style_1' || $i_tag == 'yes' && $style == 'cesis_portfolio_style_1' || $i_category == 'yes' && $style == 'cesis_portfolio_style_4' || $i_tag == 'yes' && $style == 'cesis_portfolio_style_4'){ ?>
											<div class="cesis_portfolio_m_bt_info">
											<?php

						if($i_category == 'yes'  ){echo $cat_list;}
						if($i_tag == 'yes' ){echo $tag_list;}
						?>
											</div>
										<?php } ?>
							<h2 class="cesis_portfolio_m_title <?php echo esc_attr($heading_font)?>"><a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>"><?php echo the_title(); ?></a></h2>
<?php if( $i_date == 'yes' || $i_category == 'yes' && $style !== 'cesis_portfolio_style_1' && $style !== 'cesis_portfolio_style_4' || $i_tag == 'yes' && $style !== 'cesis_portfolio_style_1' && $style !== 'cesis_portfolio_style_4' || $i_comment == 'yes' || $i_like == 'yes'){ ?>
											<div class="cesis_portfolio_m_top_info">
											<?php

						if($i_category == 'yes' && $style !== 'cesis_portfolio_style_1' && $style !== 'cesis_portfolio_style_4'){echo $cat_list;}
						if($i_tag == 'yes' && $style !== 'cesis_portfolio_style_1' && $style !== 'cesis_portfolio_style_4'){echo $tag_list;}
						if($i_date == 'yes' ){echo $date;}
						if($i_comment == 'yes' && $style !== 'cesis_portfolio_style_1' && $style !== 'cesis_portfolio_style_4'){echo $comments;}
						if($i_like == 'yes' && function_exists('zilla_likes') && $style !== 'cesis_portfolio_style_1' && $style !== 'cesis_portfolio_style_4'){	echo do_shortcode('[zilla_likes]');}
						?>
											</div>
										<?php } ?>
										<?php if($i_text == 'yes'){ ?>
											<div class="cesis_portfolio_m_entry">
											<?php if($text_source == 'content' && $char_length !== '' ){ echo cesis_text_truncate(cesis_content(), $char_length); }
							elseif($text_source == 'description' && $char_length !== '' ){  echo cesis_text_truncate($project_description, $char_length); }
							elseif($text_source == 'content'){ echo the_content(); }
							elseif($text_source == 'description'){echo $project_description;}?>
											</div>
										<?php } ?>
										<?php if($read_more == 'yes'){ ?>
											<div class="cesis_m_more_link">
											<?php
						echo '<a href="'.$link.'" class="'.$rm_class.'" '.$rm_style.' target="'.$target.'">'.__('Read more', 'cesis').'</a>';
						?>
											</div>
										<?php } ?>
										<?php if($style == 'cesis_portfolio_style_1' || $style == 'cesis_portfolio_style_4' ){
						if($i_comment == 'yes' || $i_like == 'yes'){  ?>
												<div class="cesis_portfolio_m_bottom_info">
												<?php
							if($i_comment == 'yes'){echo $comments;}
							if($i_like == 'yes' && function_exists('zilla_likes') ){	echo do_shortcode('[zilla_likes]');}
							?>
												</div>
										<?php }
					}
										?>
										</div>
				<?php } //start on image style
				else{
					if($thumb == ''){ $thumb = '<div class="no_img_placeholder"></div>'; } ?>
					<div class="cesis_portfolio_m_thumbnail">
									<a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
					<?php echo $thumb?>
					</a>
										<div class="cesis_portfolio_m_content on_image_style" <?php echo esc_attr($content_style) ?>>

												<div class="cesis_portfolio_m_inner_content">


										<h2 class="cesis_portfolio_m_title title_filter  <?php echo esc_attr($heading_font)?>"><a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>"><?php echo the_title(); ?></a></h2>
					<?php if( $i_date == 'yes' || $i_category == 'yes' || $i_tag == 'yes' || $i_comment == 'yes' || $i_like == 'yes' ){ ?>
											<div class="cesis_portfolio_m_top_info">
											<?php
						if($i_category == 'yes'){echo $cat_list;}
						if($i_tag == 'yes'){echo $tag_list;}
						if($i_date == 'yes' ){echo $date;}
						if($i_comment == 'yes'){echo $comments;}
						if($i_like == 'yes' && function_exists('zilla_likes') ){	echo do_shortcode('[zilla_likes]');}
						?>
											</div>
										<?php } ?>
										<?php if($i_text == 'yes'){ ?>
											<div class="cesis_portfolio_m_entry">
											<?php if($text_source == 'content' && $char_length !== '' ){ echo cesis_text_truncate(cesis_content(), $char_length); }
							elseif($text_source == 'description' && $char_length !== '' ){  echo cesis_text_truncate($project_description, $char_length); }
							elseif($text_source == 'content'){ echo the_content(); }
							elseif($text_source == 'description'){echo $project_description;}?>
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
									</div>

			<?php
		endwhile; endif;

		echo '<div id="cp">'.$cp.'</div>';
		echo '<div id="mp">'.$portfolio_query->max_num_pages.'</div>';



				wp_reset_postdata();


}

if( $post_type == "staff" ){

			$cat_array = explode( ',', $category );
			$tag_array = explode( ',', $tag );
	$args = array(
				'post_type' => 'staff',
				'post_status' => 'publish',
		'order' => $order,
		'orderby' => $orderby,
		'offset' => $offset,
				'posts_per_page' => $load,
    		'post__not_in' => array( get_the_ID() ),
		);
		if ($category !== '' && $category !== "all" && $tag !== '' && $tag !== "all") {
		$args['tax_query']=array(
				array(
					'taxonomy' => 'staff_group',
					'field' => 'term_id',
						'terms' => $cat_array
				),
		array(
					'taxonomy' => 'staff_tag',
					'field' => 'term_id',
						'terms' => $tag_array
				));
	}elseif ($category !== '' && $category !== "all") {
		$args['tax_query']=array(
				array(
					'taxonomy' => 'staff_group',
						'field' => 'term_id',
						'terms' => $cat_array
				));
		}elseif ($tag !== '' && $tag !== "all") {
		$args['tax_query']=array(
				array(
					'taxonomy' => 'staff_tag',
					'field' => 'term_id',
						'terms' => $tag_array
				));
		}


	ob_start();
	$staff_query = new WP_Query($args);

	if($effect == 'cesis_effect_frame' && $type == 'isotope_packery' && $padding !== '0'){
		$new_padding = $new_padding - 10;
	}
	if($style == 'cesis_staff_style_5' || $style == 'cesis_staff_style_6' || $style == 'cesis_staff_style_7'){
		$content_style = 'style=padding:'.$inner_padding.';';
	}
	else{
		$content_style = '';
	}




		if ($staff_query->have_posts()) : while ($staff_query->have_posts()) : $staff_query->the_post();


			$post_format = get_post_format();
			$custom_link = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_link" );
			$thumb = get_post_thumbnail_id();
			$img_url = wp_get_attachment_url( $thumb,'full' );
			$member_position = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_member_position" );
			$member_description = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_member_description" );
			if($custom_link !== ''){
				$link = $custom_link;
			}else{
				$link = get_permalink();
			}
			$socials = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_staff_social" );

			// hover settings
			if($hover == 'cesis_hover_overlay' || $hover == 'cesis_hover_overlay_social'){
				$hover_ctn = '<div class="cesis_overlay_ctn"></div>';
			}
			else{
				$hover_ctn = '';
			}
			// ohter settings

			if($type == 'isotope_packery'){
				$new_padding = '0';
				$packery_class = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_packery_size" );
				if($packery_class == ''){
					$packery_class = 'cesis_packery_squared';
				}
				$thumb = '<img src="'.cesis_image_ratio( $img_url, 'tn_squared').'"/>';
			}else{
				$thumb = '<img src="'.cesis_image_ratio( $img_url, $thumbnail_size).'"/>';
				$packery_class = "";
			}
			$cat_filter = "" ;
			$item_cat = "" ;
			$item_tag = "" ;
			$cat_list = get_the_terms($staff_query->ID, 'staff_group');
			if(is_array($cat_list) || is_object($cat_list)){
				foreach($cat_list as $cat_single) {
					$item_cat .= 'f_'.$cat_single->term_id.' ';
				}
			}
			$tag_list = get_the_terms($staff_query->ID, 'staff_tag');
			if(is_array($tag_list) || is_object($tag_list)){
				foreach($tag_list as $tag_single) {
					$item_tag .= 'f_'.$tag_single->term_id.' ';
				}
			}





		?>
				<div class="cesis_iso_item <?php echo esc_attr($item_cat).' '.esc_attr($item_tag).' '.esc_attr($packery_class) ?>" style="padding:<?php echo esc_attr($new_padding) ?>px;">
				<div class="cesis_isotope_filter_data"><span class="isotope_filter_name"><?php echo the_title(); ?></span><span class="isotope_filter_date"><?php echo the_time('YmdHis'); ?></span></div>

				<div class="inside_e <?php echo esc_attr($animation) ?>">

				<?php if($style !== 'cesis_staff_style_5' && $style !== 'cesis_staff_style_6' && $style !== 'cesis_staff_style_7'){



						?>
						<div class="cesis_staff_m_thumbnail">
							<a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
							<?php echo $hover_ctn.' '.$thumb;
							?>

							</a>
							<?php

							if($hover == 'cesis_hover_overlay_social' && !empty($socials) ){
								echo '<div class="cesis_staff_social"><span>';
							foreach($socials as $key => $icon){

							echo '<a href="'.$icon["font-url"].'" class="'.$icon["font-suffix"].' '.$icon["font-icon"].'" target="'.$target.'"></a>';

							}
							 echo '</span></div>';
							} ?>
						</div>

							<div class="cesis_staff_m_content">
							<h2 class="cesis_staff_m_title  <?php echo esc_attr($heading_font)?>"><a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>"><?php echo the_title(); ?></a></h2>
							<?php if($i_author == 'yes'){ ?>
							<div class="cesis_staff_m_position">
							<?php echo $member_position; ?>
							</div>
							<?php }
							if($i_text !== 'no' || $i_social !== 'no'){?>
							<div class="cesis_staff_m_info">
							<?php if($i_text == 'yes'){ ?>
								<div class="cesis_staff_m_entry">
							<?php if($text_source == 'content' && $char_length !== '' ){ echo cesis_text_truncate(cesis_content(), $char_length); }
							elseif($text_source == 'description' && $char_length !== '' ){  echo cesis_text_truncate($member_description, $char_length); }
							elseif($text_source == 'content'){ echo the_content(); }
							elseif($text_source == 'description'){echo $member_description;}?>
								</div>
							 <?php }

							 if($i_social == 'social_c' && !empty($socials)){
								 echo '<div class="cesis_staff_social">';
							 foreach($socials as $key => $icon){
								 if($icon["font-suffix"] !== ''){
									echo '<a href="'.$icon["font-url"].'" class="'.$icon["font-suffix"].' '.$icon["font-icon"].'" target="'.$target.'"></a>';
								 }
							 }
								echo '</div>';
							 }


								?>
							</div>
							<?php } ?>
							</div>
				<?php } //start on image style
				else{
					if($thumb == ''){ $thumb = '<div class="no_img_placeholder"></div>'; } ?>
					<div class="cesis_staff_m_thumbnail">
									<a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
					<?php echo $thumb?>
					</a>
										<div class="cesis_staff_m_content on_image_style" <?php echo esc_attr($content_style) ?>>

												<div class="cesis_staff_m_inner_content">


										<h2 class="cesis_staff_m_title title_filter  <?php echo esc_attr($heading_font)?>"><a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>"><?php echo the_title(); ?></a></h2>
										<?php if($i_author == 'yes'){ ?>
										<div class="cesis_staff_m_position">
										<?php echo $member_position; ?>
										</div>
										<?php }
										if($i_text !== 'no' || $i_social !== 'no'){?>

										<div class="cesis_staff_m_info">
										<?php if($i_text == 'yes'){ ?>
											<div class="cesis_staff_m_entry">
											<?php if($text_source == 'content' && $char_length !== '' ){ echo cesis_text_truncate(cesis_content(), $char_length); }
							elseif($text_source == 'content'){ echo the_content(); }
							elseif($text_source == 'description'){echo $member_description;}?>
											</div>
										<?php }

										if($i_social == 'social_c'  && !empty($socials) ){
											echo '<div class="cesis_staff_social">';
										foreach($socials as $key => $icon){
											if($icon["font-suffix"] !== ''){
											echo '<a href="'.$icon["font-url"].'" class="'.$icon["font-suffix"].' '.$icon["font-icon"].'" target="'.$target.'"></a>';
											}
										}
										 echo '</div>';
										}

									 ?>
											</div>

										<?php } ?>
										</div>
											</div>

										</div>






										<?php } ?>
										</div>

									</div>


			<?php

			endwhile; endif;

			echo '<div id="cp">'.$cp.'</div>';
			echo '<div id="mp">'.$staff_query->max_num_pages.'</div>';



					wp_reset_postdata();

}

if( $post_type == "careers" ){

			$cat_array = explode( ',', $category );

	$args = array(
				'post_type' => 'careers',
				'post_status' => 'publish',
		'order' => $order,
		'orderby' => $orderby,
		'offset' => $offset,
				'posts_per_page' => $load,
    		'post__not_in' => array( get_the_ID() ),
		);
		if ($category !== '' && $category !== "all") {
		$args['tax_query']=array(
				array(
					'taxonomy' => 'portfolio_category',
						'field' => 'term_id',
						'terms' => $cat_array
				));
		}


			ob_start();
			$career_query = new WP_Query($args);
	if($effect == 'cesis_effect_frame' && $type == 'isotope_packery' && $padding !== '0'){
		$new_padding = $new_padding - 10;
	}

				if ($career_query->have_posts()) : while ($career_query->have_posts()) : $career_query->the_post();


					$post_format = get_post_format();
					$custom_link = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_post_link" );
					$thumb = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url( $thumb,'full' );
					$career_date = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_career_date" );
					$career_location = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_career_location" );
					$career_description = redux_post_meta( 'cesis_data', get_the_ID(), "cesis_career_description" );
					if($custom_link !== ''){
						$link = $custom_link;
					}else{
						$link = get_permalink();
					}

					// hover settings
					if($hover == 'cesis_hover_overlay' || $hover == 'cesis_hover_overlay_social'){
						$hover_ctn = '<div class="cesis_overlay_ctn"></div>';
					}
					else{
						$hover_ctn = '';
					}
					// ohter settings

					$thumb = '<img src="'.cesis_image_ratio( $img_url, $thumbnail_size).'"/>';

					$cat_filter = "" ;
					$item_cat = "" ;
					$cat_list = get_the_terms($career_query->ID, 'career_category');
					if(is_array($cat_list) || is_object($cat_list)){
						foreach($cat_list as $cat_single) {
							$item_cat .= 'f_'.$cat_single->term_id.' ';
						}
					}





				?>
					<?php if($type !== 'carousel'){?>
						<div class="cesis_iso_item <?php echo esc_attr($item_cat) ?>" style="padding:<?php echo esc_attr($new_padding) ?>px;">
						<div class="cesis_isotope_filter_data"><span class="isotope_filter_name"><?php echo the_title(); ?></span><span class="isotope_filter_date"><?php echo the_time('YmdHis'); ?></span></div>
                    <?php } ?>
						<div class="inside_e <?php echo esc_attr($animation) ?>">
								<div class="cesis_career_m_thumbnail">
									<a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>">
									<?php echo $hover_ctn.' '.$thumb;
									?>

									</a>
									<?php
									if($i_date !== '' || $i_location !== '' || $i_category !== '' ){
										echo '<div class="cesis_career_m_info">';
										if($i_location !== 'no' && $career_location !== '' ){
											echo '<span class="cesis_career_m_location">'.$career_location.'</span>';
										}
										if($i_category !== 'no' && $cat_list !== '' ){
											echo '<span class="cesis_career_m_categories">'.get_the_term_list('','career_category', '',' ','').'</span>';
										}
										if($i_date !== 'no' && $career_date !== ''){
											echo '<span class="cesis_career_m_date">'.$career_date.'</span>';
										}
									 echo '</div>';
								 	} ?>
								</div>

                  <div class="cesis_career_m_content">
              		<h2 class="cesis_career_m_title  <?php echo esc_attr($heading_font)?>"><a href="<?php echo esc_url($link) ?>" target="<?php echo esc_attr($target) ?>"><?php echo the_title(); ?></a></h2>
									<?php
									if($i_text !== 'no' ){?>
              		<?php if($i_text == 'yes'){ ?>
                  	<div class="cesis_career_m_entry">
                	<?php if($text_source == 'content' && $char_length !== '' ){ echo cesis_text_truncate(cesis_content(), $char_length); }
							   	elseif($text_source == 'description' && $char_length !== '' ){  echo cesis_text_truncate($career_description, $char_length); }
							   	elseif($text_source == 'content'){ echo the_content(); }
									elseif($text_source == 'description'){echo $career_description;}?>
		              	</div>
		               <?php }
									 if($read_more == 'yes'){ ?>
										 <div class="cesis_m_more_link">
										 <?php
					 				 		echo '<a href="'.$link.'" class="'.$rm_class.'" '.$rm_style.' target="'.$target.'">'.__('Read more', 'cesis').'</a>';
					 						?>
										 </div>
									 <?php } ?>
								<?php } ?>
                  </div>
              </div>
					<?php if($type !== 'carousel'){?>
            	</div>
          <?php } ?>

	    		<?php
		endwhile; endif;

		echo '<div id="cp">'.$cp.'</div>';
		echo '<div id="mp">'.$career_query->max_num_pages.'</div>';



				wp_reset_postdata();


}

if( $post_type == "product" ){

			ob_start();

			if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
			elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
			else { $paged = 1; }
			if($orderby == "_price"){
				$args = array(
		    	'post_type' => 'product',
		      'post_status' => 'publish',
					'order' => $order,
					'offset' => $offset,
					'meta_key' => '_price',
					'orderby' => 'meta_value_num',
				  "posts_per_page" => $load,
	    		'post__not_in' => array( get_the_ID() ),
		   	);
			}elseif($orderby == "total_sales"){
				$args = array(
		    	'post_type' => 'product',
		      'post_status' => 'publish',
					'order' => $order,
					'offset' => $offset,
					'meta_key' => 'total_sales',
					'orderby' => 'meta_value_num',
		    	'posts_per_page' => $load,
		   	);
			}elseif($orderby == "_wc_average_rating"){
				$args = array(
		    	'post_type' => 'product',
		      'post_status' => 'publish',
					'order' => $order,
					'offset' => $offset,
					'meta_key' => '_wc_average_rating',
					'orderby' => 'meta_value_num',
		    	'posts_per_page' => $load,
		   	);
			}else{
				$args = array(
 		    	'post_type' => 'product',
 		     	'post_status' => 'publish',
 					'order' => $order,
 					'orderby' => $orderby,
					'offset' => $offset,
 		    	'posts_per_page' => $load,
 		   	);
			}
			if($type == "featured"){
				$args['tax_query']= array(
                 array(
                     'taxonomy' => 'product_visibility',
                     'field'    => 'name',
                     'terms'    => 'featured',
                     'operator' => 'IN'
                 )
							 );
			}
			if($type == "sale"){
				$args['meta_query']= WC()->query->get_meta_query();
				$args['post__in']= array_merge( array( 0 ), wc_get_product_ids_on_sale() );
			}

			$cat_array = explode( ',', $category );
			$tag_array = explode( ',', $tag );
	    if ($category !== '' && $category !== "all" && $tag !== '' && $tag !== "all") {
				$args['tax_query']=array(
		    	array(
		      	'taxonomy' => 'product_cat',
		    	  'field' => 'term_id',
		        'terms' => $cat_array
		     ),
					array(
		       	'taxonomy' => 'product_tag',
			      'field' => 'term_id',
		        'terms' => $tag_array
		     ));
			}elseif ($category !== '' && $category !== "all") {
				$args['tax_query']=array(
		        array(
		        	'taxonomy' => 'product_cat',
		            'field' => 'term_id',
		            'terms' => $cat_array
		        ));
		    }elseif ($tag !== '' && $tag !== "all") {
				$args['tax_query']=array(
		        array(
		        	'taxonomy' => 'product_tag',
			        'field' => 'term_id',
        		    'terms' => $tag_array
		        ));
		    }


			$product_query = new WP_Query($args);




				if ($product_query->have_posts()) : while ($product_query->have_posts()) : $product_query->the_post();

				global $post, $product;

					$thumbnail_size = "woocommerce_thumbnail";
					$post_format = get_post_format();
					$link = get_permalink();

					// ohter settings

					$thumb = get_the_post_thumbnail( $product_query->ID, $thumbnail_size);
					$packery_class = "";
					$cat_filter = "" ;
					$item_cat = "" ;
					$item_tag = "" ;
					$cat_list = get_the_terms($product_query->ID, 'product_cat');
					if(is_array($cat_list) || is_object($cat_list)){
						foreach($cat_list as $cat_single) {
							$item_cat .= 'f_'.$cat_single->term_id.' ';
						}
					}
					$tag_list = get_the_terms($product_query->ID, 'product_tag');
					if(is_array($tag_list) || is_object($tag_list)){
						foreach($tag_list as $tag_single) {
							$item_tag .= 'f_'.$tag_single->term_id.' ';
						}
					}




		?>
				<div class="cesis_iso_item <?php echo esc_attr($item_cat).' '.esc_attr($item_tag).' '.esc_attr($packery_class) ?>" style="padding:<?php echo esc_attr($new_padding) ?>px;">
				<div class="cesis_isotope_filter_data"><span class="isotope_filter_name"><?php echo the_title(); ?></span><span class="isotope_filter_date"><?php echo the_time('YmdHis'); ?></span></div>

					<div class="inside_e product <?php echo esc_attr($animation) ?>">

				<?php if($style == 'cesis_product_style_1'){
					if ( $product->is_on_sale() ){
						echo '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>';
					}
					echo "<div class='cesis_product_thumbnail_container'>";
					echo woocommerce_template_loop_product_link_open();
					echo cesis_woo_gallery_first_thumb( $product_query->ID , $thumbnail_size);
					echo get_the_post_thumbnail( $product_query->ID , $thumbnail_size );
					echo woocommerce_template_loop_product_link_close();
					if($i_addtocart == 'yes'){
						echo '<div class="cesis_add_to_cart">';
						echo woocommerce_template_loop_add_to_cart();
						echo '</div>';
					}
					if($product->get_type() == 'simple') echo "<div class='item_current_status'><span class='icon_status_inner'></span></div>";
					echo "</div>";
					echo woocommerce_template_loop_product_link_open();
					echo woocommerce_template_loop_product_title();
					if($i_rating == 'yes'){
						echo woocommerce_template_loop_rating();
					}
					if($i_price == 'yes'){
						echo woocommerce_template_loop_price();
					}
					echo woocommerce_template_loop_product_link_close();


					?>


				<?php } //start on image style
				else{
					if ( $product->is_on_sale() ){
						echo '<span class="onsale">' . esc_html__( 'Sale!', 'woocommerce' ) . '</span>';
					}
					echo "<div class='cesis_product_thumbnail_container'>";
					echo woocommerce_template_loop_product_link_open();
					echo cesis_woo_gallery_first_thumb( $product_query->ID , $thumbnail_size);
					echo get_the_post_thumbnail( $product_query->ID , $thumbnail_size );
					echo '<div class="cesis_product_overlay"></div>';
					echo '<div class="cesis_product_info">';
					echo woocommerce_template_loop_product_title();
					if($i_rating == 'yes'){
						echo woocommerce_template_loop_rating();
					}
					if($i_price == 'yes'){
						echo woocommerce_template_loop_price();
					}
					echo '</div>';
					echo woocommerce_template_loop_product_link_close();
					if($i_addtocart == 'yes'){
						echo '<div class="cesis_add_to_cart">';
						echo woocommerce_template_loop_add_to_cart();
						echo '</div>';
					}
					if($product->get_type() == 'simple') echo "<div class='item_current_status'><span class='icon_status_inner'></span></div>";
					echo "</div>";



					} ?>
										</div>

									</div>


			<?php

			endwhile; endif;

			echo '<div id="cp">'.$cp.'</div>';
			echo '<div id="mp">'.$product_query->max_num_pages.'</div>';



					wp_reset_postdata();

}


	    wp_die($output_string);


	}
}
