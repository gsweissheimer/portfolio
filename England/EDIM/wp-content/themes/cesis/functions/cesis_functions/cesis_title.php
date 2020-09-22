<?php


if(!function_exists('cesis_head_title'))
{
	function cesis_head_title(){
		echo '<title>';
		wp_title( '' );
		echo '</title>';
	}
if ( ! function_exists( '_wp_render_title_tag' ) ) {
	add_action( 'wp_head','cesis_head_title');
}
}

//advanced title + breadcrumb function
if(!function_exists('cesis_title'))
{
	function cesis_title($args = false, $id = false){
		global $cesis_data;
		global $post;
		if(!$id) $id = get_the_ID();
		$wrapper_attributes = array();

		/* check if the page has settings that overwrite the theme options settings */



		if(cesis_check_bp_status() == true && cesis_is_buddypress()){
			if(isset($cesis_data['cesis_buddypress_title_overlay_color']['rgba'])){
				$title_overlay_color = $cesis_data['cesis_buddypress_title_overlay_color']['rgba'];
			}else{
				$title_overlay_color = 'rgba(0,0,0,0)';
			}
			$title_overlay = $cesis_data['cesis_buddypress_title_overlay'];
			$title_display = $cesis_data['cesis_buddypress_title_display'];
			$breadcrumbs_display = $cesis_data['cesis_buddypress_breadcrumbs_display'];
			$title_layout = $cesis_data['cesis_buddypress_title_layout'];
			$title_alignment = $cesis_data['cesis_buddypress_title_alignment'];
		}elseif(cesis_check_bbp_status() == true &&  cesis_is_bbpress() == true){
			if(isset($cesis_data['cesis_bbpress_title_overlay_color']['rgba'])){
				$title_overlay_color = $cesis_data['cesis_bbpress_title_overlay_color']['rgba'];
			}else{
				$title_overlay_color = 'rgba(0,0,0,0)';
			}
			$title_overlay = $cesis_data['cesis_bbpress_title_overlay'];
			$title_display = $cesis_data['cesis_bbpress_title_display'];
			$breadcrumbs_display = $cesis_data['cesis_bbpress_breadcrumbs_display'];
			$title_layout = $cesis_data['cesis_bbpress_title_layout'];
			$title_alignment = $cesis_data['cesis_bbpress_title_alignment'];
		}elseif(cesis_check_woo_status() == true && is_shop()){
			if(isset($cesis_data['cesis_shop_title_overlay_color']['rgba'])){
				$title_overlay_color = $cesis_data['cesis_shop_title_overlay_color']['rgba'];
			}else{
				$title_overlay_color = 'rgba(0,0,0,0)';
			}
			$title_overlay = $cesis_data['cesis_shop_title_overlay'];
			$title_display = $cesis_data['cesis_shop_title_display'];
			$breadcrumbs_display = $cesis_data['cesis_shop_breadcrumbs_display'];
			$title_layout = $cesis_data['cesis_shop_title_layout'];
			$title_alignment = $cesis_data['cesis_shop_title_alignment'];
		}elseif(redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_title') == 'yes' && !is_archive()){
			$overlay_array = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title_overlay_color');
			$title_overlay_color = $overlay_array['rgba'];
			$title_overlay = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title_overlay');
			$title_display = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title_display');
			$breadcrumbs_display = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_breadcrumbs_display');
			$title_layout = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title_layout');
			$title_alignment = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_title_alignment');
		}elseif(cesis_check_woo_status() == true && is_product()){
			if(isset($cesis_data['cesis_shop_title_overlay_color']['rgba'])){
				$title_overlay_color = $cesis_data['cesis_shop_title_overlay_color']['rgba'];
			}else{
				$title_overlay_color = 'rgba(0,0,0,0)';
			}
			$title_overlay = $cesis_data['cesis_shop_title_overlay'];
			$title_display = $cesis_data['cesis_shop_title_display'];
			$breadcrumbs_display = $cesis_data['cesis_shop_breadcrumbs_display'];
			$title_layout = $cesis_data['cesis_shop_title_layout'];
			$title_alignment = $cesis_data['cesis_shop_title_alignment'];
		}elseif(get_post_type() == 'post'){
			if(isset($cesis_data['cesis_post_title_overlay_color']['rgba'])){
				$title_overlay_color = $cesis_data['cesis_post_title_overlay_color']['rgba'];
			}else{
				$title_overlay_color = 'rgba(0,0,0,0)';
			}
			$title_overlay = $cesis_data['cesis_post_title_overlay'];
			$title_display = $cesis_data['cesis_post_title_display'];
			$breadcrumbs_display = $cesis_data['cesis_post_breadcrumbs_display'];
			$title_layout = $cesis_data['cesis_post_title_layout'];
			$title_alignment = $cesis_data['cesis_post_title_alignment'];
		}elseif(get_post_type() == 'portfolio'){
			if(isset($cesis_data['cesis_portfolio_title_overlay_color']['rgba'])){
				$title_overlay_color = $cesis_data['cesis_portfolio_title_overlay_color']['rgba'];
			}else{
				$title_overlay_color = 'rgba(0,0,0,0)';
			}
			$title_overlay = $cesis_data['cesis_portfolio_title_overlay'];
			$title_display = $cesis_data['cesis_portfolio_title_display'];
			$breadcrumbs_display = $cesis_data['cesis_portfolio_breadcrumbs_display'];
			$title_layout = $cesis_data['cesis_portfolio_title_layout'];
			$title_alignment = $cesis_data['cesis_portfolio_title_alignment'];
		}elseif(get_post_type() == 'staff'){
			if(isset($cesis_data['cesis_staff_title_overlay_color']['rgba'])){
				$title_overlay_color = $cesis_data['cesis_staff_title_overlay_color']['rgba'];
			}else{
				$title_overlay_color = 'rgba(0,0,0,0)';
			}
			$title_overlay = $cesis_data['cesis_staff_title_overlay'];
			$title_display = $cesis_data['cesis_staff_title_display'];
			$breadcrumbs_display = $cesis_data['cesis_staff_breadcrumbs_display'];
			$title_layout = $cesis_data['cesis_staff_title_layout'];
			$title_alignment = $cesis_data['cesis_staff_title_alignment'];
		}else{
			if(isset($cesis_data['cesis_page_title_overlay_color']['rgba'])){
				$title_overlay_color = $cesis_data['cesis_page_title_overlay_color']['rgba'];
			}else{
				$title_overlay_color = 'rgba(0,0,0,0)';
			}
			$title_overlay = $cesis_data['cesis_page_title_overlay'];
			$title_display = $cesis_data['cesis_page_title_display'];
			$breadcrumbs_display = $cesis_data['cesis_page_breadcrumbs_display'];
			$title_layout = $cesis_data['cesis_page_title_layout'];
			$title_alignment = $cesis_data['cesis_page_title_alignment'];
		}


		/* load default value */
		$class = "";


		$defaults 	 = array(

			'title' 		=> get_the_title($id),
			'link'			=> get_permalink($id),
			'html'			=> "<div class='{class} page_title_container' {wrapper_attributes}>{overlay}<div class='cesis_container'><div class='title_ctn'><h1 class='main-title entry-title'>{title}</h1>{additions}</div>{information}{breadcrumb}</div></div>",
			'class'			=> 'stretch_full container_wrap alternate_color',
			'breadcrumb'	=> true,
			'wrapper_attributes' 		=> "",
			'overlay'		=> "",
			'additions'		=> "",
			'information'		=> "",
			'title_alignment'	=> "",
			'navigation'	=> "",
			'post_background'	=> "",
		);

		if(is_search()){
			$current_query = sanitize_text_field(get_query_var('s'));
			if(empty($current_query))
				{
					$defaults['title'] = __('Search results for:', 'cesis');
				}
			else
				{
					$defaults['title'] = __('Search results for:', 'cesis').' '.$current_query;
				}
		}
		if ( is_tax() || is_category() || is_tag() )
		{
			global $wp_query;
			$defaults['title'] = __('Archives', 'cesis');
			$term = $wp_query->get_queried_object();
			$defaults['link'] = get_term_link( $term );
		}
		else if(is_archive())
		{
			$defaults['title'] = __('Archives', 'cesis');
			$defaults['link'] = "";
		}




		// Parse incomming $args into an array and merge it with $defaults
		$args = wp_parse_args( $args, $defaults );

		//disable breadcrumb if requested
		if($breadcrumbs_display == 'no') $args['breadcrumb'] = false;

		//disable title if requested
		if($title_display == 'no') $args['title'] = '';


		// OPTIONAL: Declare each item in $args as its own variable i.e. $type, $before.
		extract( $args, EXTR_SKIP );

		if ($post_background !== "") {

			$wrapper_attributes[] = 'style="background-image:url(\''.$post_background.'\')"';
		}




		if (empty($overlay)) {
			if(  $title_overlay == 'yes' ){
				$overlay = '<div class="title_overlay" style="background-color:'.$title_overlay_color.';"></div>';
			}
		}

		if(empty($title)){ $class .= " empty_title "; }
		if(!empty($link) && !empty($title)){ $title = "<a href='".$link."' rel='bookmark' title='".__('Permanent Link:', 'cesis')." ".esc_attr( $title )."' >".$title."</a>";}
		if(!empty($title_layout)){ $class .= " ".$title_layout;}
		if(!empty($title_alignment)){ $class .= " ".$title_alignment;}
		if($breadcrumb == true && cesis_check_ccp_status() == true){$breadcrumb = do_shortcode( '[breadcrumb]' ); }else{$breadcrumb = "";}





		/* fill the title with the values */

		$html = str_replace('{class}', $class, $html);
		$html = str_replace('{title}', $title, $html);
		$html = str_replace('{overlay}', $overlay, $html);
		$html = str_replace('{additions}', $additions, $html);
		$html = str_replace('{information}', $information, $html);
		$html = str_replace('{breadcrumb}', $breadcrumb, $html);


			return $html;

	}
}
