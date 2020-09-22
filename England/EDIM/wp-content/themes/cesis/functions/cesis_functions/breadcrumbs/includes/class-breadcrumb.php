<?php

if ( ! defined('ABSPATH')) exit;  // if direct access



class cesis_breadcrumb
	{

		public function cesis_breadcrumb_get_option($option_name)
			{
				return get_option($option_name);
			}

		public function cesis_breadcrumb_get_page_childs()
			{
				global $cesis_data;
				if(cesis_check_bp_status() == true && cesis_is_buddypress()){
					$breadcrumb_separator = $cesis_data["cesis_buddypress_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_buddypress_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_buddypress_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_buddypress_breadcrumbs_word_char_end"];
				}elseif(cesis_check_bbp_status() == true &&  cesis_is_bbpress() == true){
					$breadcrumb_separator = $cesis_data["cesis_bbpress_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_bbpress_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_bbpress_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_bbpress_breadcrumbs_word_char_end"];
				}elseif(cesis_check_woo_status() == true && is_woocommerce()){
					$breadcrumb_separator = $cesis_data["cesis_shop_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_shop_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_shop_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_shop_breadcrumbs_word_char_end"];
				}elseif(redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_title') == 'yes' &&  !is_archive()){
					$breadcrumb_separator = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_breadcrumbs_sep');
					$breadcrumb_word_char = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_breadcrumbs_word_char');
					$breadcrumb_word_char_count = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_metat_breadcrumbs_word_char_count');
					$breadcrumb_word_char_end = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_breadcrumbs_word_char_end');
				}elseif(get_post_type() == 'post'){
					$breadcrumb_separator = $cesis_data["cesis_post_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_post_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_post_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_post_breadcrumbs_word_char_end"];
				}elseif(get_post_type() == 'portfolio'){
					$breadcrumb_separator = $cesis_data["cesis_portfolio_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_portfolio_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_portfolio_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_portfolio_breadcrumbs_word_char_end"];
				}elseif(get_post_type() == 'staff'){
					$breadcrumb_separator = $cesis_data["cesis_staff_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_staff_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_staff_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_staff_breadcrumbs_word_char_end"];
				}elseif(get_post_type() == 'careers'){
					$breadcrumb_separator = $cesis_data["cesis_career_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_career_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_career_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_career_breadcrumbs_word_char_end"];
				}else{
					$breadcrumb_separator = $cesis_data["cesis_page_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_page_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_page_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_page_breadcrumbs_word_char_end"];
				}



				global $post;
				$home = get_page(get_option('page_on_front'));

				$html = '';

				for ($i = count($post->ancestors)-1; $i >= 0; $i--) {
					if (($home->ID) != ($post->ancestors[$i]))
						{
							$html.= '<li><span  class="bc_separator">'.$breadcrumb_separator.'</span>';
							$html.= '<a href="';
							$html.= get_permalink($post->ancestors[$i]);
							$html.= '">';
							$html.= get_the_title($post->ancestors[$i]);
							$html.= '</a></li>';
						}
				}

				$html.= '<li><span class="bc_separator">'.$breadcrumb_separator.'</span><a title="'.get_the_title().'" href="#">'.cesis_breadcrumb_shorten_string(get_the_title(),$breadcrumb_word_char, $breadcrumb_word_char_count, $breadcrumb_word_char_end).'</a><span class="bc_separator">'.$breadcrumb_separator.'</span></li>';

				return $html;
			}


		public function cesis_breadcrumb_html($themes)
			{
				global $post;
				global $cesis_data;

				if(cesis_check_bp_status() == true && cesis_is_buddypress()){
					$breadcrumb_text = $cesis_data["cesis_buddypress_breadcrumbs_front"];
					$breadcrumb_separator = $cesis_data["cesis_buddypress_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_buddypress_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_buddypress_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_buddypress_breadcrumbs_word_char_end"];

					$breadcrumb_display_home = $cesis_data["cesis_buddypress_breadcrumbs_display_home"];
				}elseif(cesis_check_bbp_status() == true &&  cesis_is_bbpress() == true){
					$breadcrumb_text = $cesis_data["cesis_bbpress_breadcrumbs_front"];
					$breadcrumb_separator = $cesis_data["cesis_bbpress_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_bbpress_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_bbpress_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_bbpress_breadcrumbs_word_char_end"];

					$breadcrumb_display_home = $cesis_data["cesis_bbpress_breadcrumbs_display_home"];
				}elseif(cesis_check_woo_status() == true && is_woocommerce()){
					$breadcrumb_text = $cesis_data["cesis_shop_breadcrumbs_front"];
					$breadcrumb_separator = $cesis_data["cesis_shop_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_shop_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_shop_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_shop_breadcrumbs_word_char_end"];

					$breadcrumb_display_home = $cesis_data["cesis_shop_breadcrumbs_display_home"];
				}elseif(redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_custom_title') == 'yes' &&   !is_archive()){
					$breadcrumb_text = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_page_breadcrumbs_front');
					$breadcrumb_separator = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_breadcrumbs_sep');
					$breadcrumb_word_char = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_breadcrumbs_word_char');
					$breadcrumb_word_char_count = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_breadcrumbs_word_char_count');
					$breadcrumb_word_char_end = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_breadcrumbs_word_char_end');

					$breadcrumb_display_home = redux_post_meta( 'cesis_data', get_the_ID(), 'cesis_meta_breadcrumbs_display_home');
				}elseif(get_post_type() == 'post'){
					$breadcrumb_text = $cesis_data["cesis_post_breadcrumbs_front"];
					$breadcrumb_separator = $cesis_data["cesis_post_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_post_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_post_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_post_breadcrumbs_word_char_end"];

					$breadcrumb_display_home = $cesis_data["cesis_post_breadcrumbs_display_home"];
				}elseif(get_post_type() == 'portfolio'){
					$breadcrumb_text = $cesis_data["cesis_portfolio_breadcrumbs_front"];
					$breadcrumb_separator = $cesis_data["cesis_portfolio_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_portfolio_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_portfolio_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_portfolio_breadcrumbs_word_char_end"];

					$breadcrumb_display_home = $cesis_data["cesis_portfolio_breadcrumbs_display_home"];
				}elseif(get_post_type() == 'staff'){
					$breadcrumb_text = $cesis_data["cesis_staff_breadcrumbs_front"];
					$breadcrumb_separator = $cesis_data["cesis_staff_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_staff_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_staff_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_staff_breadcrumbs_word_char_end"];

					$breadcrumb_display_home = $cesis_data["cesis_staff_breadcrumbs_display_home"];
				}elseif(get_post_type() == 'careers'){
					$breadcrumb_text = $cesis_data["cesis_career_breadcrumbs_front"];
					$breadcrumb_separator = $cesis_data["cesis_career_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_career_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_career_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_career_breadcrumbs_word_char_end"];

					$breadcrumb_display_home = $cesis_data["cesis_career_breadcrumbs_display_home"];
				}else{
					$breadcrumb_text = $cesis_data["cesis_page_breadcrumbs_front"];
					$breadcrumb_separator = $cesis_data["cesis_page_breadcrumbs_sep"];
					$breadcrumb_word_char = $cesis_data["cesis_page_breadcrumbs_word_char"];
					$breadcrumb_word_char_count = $cesis_data["cesis_page_breadcrumbs_word_char_count"];
					$breadcrumb_word_char_end = $cesis_data["cesis_page_breadcrumbs_word_char_end"];

					$breadcrumb_display_home = $cesis_data["cesis_page_breadcrumbs_display_home"];
				}

				if(!empty($themes)){
					$breadcrumb_themes =$themes;
					}




				$html= '';



				$html.= '<div class="breadcrumb_container" itemprop="breadcrumb" itemscope itemtype="http://schema.org/BreadcrumbList">';

				$html.= '<ul itemtype="http://schema.org/BreadcrumbList" itemscope="">';

				if(!empty($breadcrumb_text)){
					$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.__('Home', 'cesis').'" href="#"><span class="bc_pre_txt">'.$breadcrumb_text.'</span></a></li>';
					}


				if(is_front_page() && is_home())
					{



					}

				elseif( is_front_page())
					{

					}

				elseif( is_home())
					{



					}




				else if(is_attachment())
					{
						$current_attachment_id = get_query_var('attachment_id');
						$current_attachment_link = get_attachment_link($current_attachment_id);


						if($breadcrumb_display_home == 'yes')
							{
							$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.__('Home', 'cesis').'" href="'.esc_url( home_url() ).'">'.__('Home', 'cesis').'</a></li>';
							}



						$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" href="'.$current_attachment_link.'">'.get_the_title().'</a><span class="bc_separator">'.$breadcrumb_separator.'</span></li>';





					}

				else if(is_singular())
					{

						$post_parent_id = wp_get_post_parent_id(get_the_ID());
						$parent_title = get_the_title($post_parent_id);
						$paren_get_permalink = get_permalink($post_parent_id);


						if($breadcrumb_display_home == 'yes')
							{
							$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.__('Home', 'cesis').'" href="'.esc_url( home_url() ).'">'.__('Home', 'cesis').'</a></li>';
							}




						if(is_page() && $post->post_parent)
							{
								$html.= $this->cesis_breadcrumb_get_page_childs(); // return array



							}

						else
							{

								$permalink_structure = get_option('permalink_structure',true);
								$permalink_structure = str_replace('%postname%','',$permalink_structure);
								$permalink_structure = str_replace('%post_id%','',$permalink_structure);

								$permalink_items = array_filter(explode('/',$permalink_structure));

								global $post;
								$author_id = $post->post_author;
								$author_posts_url = get_author_posts_url($author_id);
								$author_name = get_the_author_meta('display_name', $author_id);

								$post_date_year = get_the_time('Y');
								$post_date_month = get_the_time('m');
								$post_date_day = get_the_time('d');

								$get_month_link = get_month_link($post_date_year,$post_date_month);
								$get_year_link = get_year_link($post_date_year);
								$get_day_link = get_day_link($post_date_year, $post_date_month, $post_date_day);


								$html_permalink = '';


								if(!empty($permalink_structure) && get_post_type()=='post' || !empty($permalink_structure) && get_post_type()=='staff' || !empty($permalink_structure) && get_post_type()=='careers' || !empty($permalink_structure) && get_post_type()=='portfolio'  || !empty($permalink_structure) && get_post_type()=='product' ){
									if(get_post_type()=='post'){
										$taxonomy = 'category';
									}
									if(get_post_type()=='portfolio'){
										$taxonomy = 'portfolio_category';
									}
									if(get_post_type()=='staff'){
										$taxonomy = 'staff_group';
									}
									if(get_post_type()=='careers'){
										$taxonomy = 'career_category';
									}
									if(get_post_type()=='product'){
										$taxonomy = 'product_cat';
									}
									if(in_array('%year%',$permalink_items)){
										$html_permalink .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span  class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" title="'.get_the_title().'" href="'.$get_year_link.'">'.cesis_breadcrumb_shorten_string($post_date_year,$breadcrumb_word_char, $breadcrumb_word_char_count, $breadcrumb_word_char_end).'</a></li>';

										}

									if(in_array('%monthnum%',$permalink_items)){
										$html_permalink .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span  class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" title="'.get_the_title().'" href="'.$get_month_link.'">'.cesis_breadcrumb_shorten_string($post_date_month, $breadcrumb_word_char, $breadcrumb_word_char_count, $breadcrumb_word_char_end).'</a></li>';

										}

									if(in_array('%author%',$permalink_items)){
										$html_permalink .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span  class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" title="'.get_the_title().'" href="'.$author_posts_url.'">'.cesis_breadcrumb_shorten_string($author_name, $breadcrumb_word_char, $breadcrumb_word_char_count, $breadcrumb_word_char_end).'</a></li>';

										}


									if(in_array('%day%',$permalink_items)){
										$html_permalink .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span  class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" title="'.get_the_title().'" href="'.$get_day_link.'">'.cesis_breadcrumb_shorten_string($post_date_day, $breadcrumb_word_char, $breadcrumb_word_char_count, $breadcrumb_word_char_end).'</a></li>';

										}

										$terms = get_the_terms( $post->id , $taxonomy);
										$trail = "";
											    if($terms) {
										        foreach( $terms as $term ) {
																$my_term_id = get_term( $term->term_id, $taxonomy);
																$my_term = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span><a href="'.get_term_link($term->term_id, $taxonomy).'">';
																$my_term .= $my_term_id->name;
																$my_term .= '</a></li>';
										            $term = get_term_by("id", $term->parent, $taxonomy);
																if (!empty($term->term_id)) {
 																$my_term_id = get_term($term->term_id, $taxonomy);

																$my_term = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span><a href="'.get_term_link($term->term_id, $taxonomy).'">'.$my_term_id->name.'</a></li>'.$my_term;
										            if ($term->parent > 0) {
										                $term = get_term_by("id", $term->parent, $taxonomy);
																		$my_term_id = get_term($term->term_id, $taxonomy);

																		$my_term = '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span><a href="'.get_term_link($term->term_id, $taxonomy).'">'.$my_term_id->name.'</a></li>'.$my_term;

										            }
										            $cat_obj = get_term($term->term_id, $taxonomy);
																}
																if(strlen($my_term) > strlen($trail) ){
																	$trail = $my_term;
																}
										        }
										    }
												if($trail !== ''){
													$html_permalink .= $trail;
												}





									$html.= $html_permalink;
									}

								$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span  class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" title="'.get_the_title().'" href="#"  class="bc_current_page">'.cesis_breadcrumb_shorten_string(get_the_title(),$breadcrumb_word_char, $breadcrumb_word_char_count, $breadcrumb_word_char_end).'</a><span class="bc_separator">'.$breadcrumb_separator.'</span></li>';






							}



					}

				else if(is_category())
					{

						$current_cat_id = get_query_var('cat');
						$parent_cat_links = get_category_parents( $current_cat_id, true, ',' );

						$parent_cat_links = explode(",",$parent_cat_links);

						if($breadcrumb_display_home == 'yes')
							{
							$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.__('Home', 'cesis').'" href="'.esc_url( home_url() ).'">'.__('Home', 'cesis').'</a></li>';
							}


						foreach($parent_cat_links as $link)
							{
							$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span>'.$link.'</li>';
							}


					}
				else if(is_tag())
					{

						$current_tag_id = get_query_var('tag_id');
						$current_tag = get_tag($current_tag_id);
						$current_tag_name = $current_tag->name;

						$current_tag_link = get_tag_link($current_tag_id);

						if($breadcrumb_display_home == 'yes')
							{
							$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.__('Home', 'cesis').'" href="'.esc_url( home_url() ).'">'.__('Home', 'cesis').'</a><span class="bc_separator">'.$breadcrumb_separator.'</span></li>';
							}

						$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.$current_tag_name.'" href="'.$current_tag_link.'">'.$current_tag_name.'</a><span class="bc_separator">'.$breadcrumb_separator.'</span></li>';



					}
					else if( is_archive() && !is_tax() && !is_category() && !is_tag() ) {

										if($breadcrumb_display_home == 'yes')
										{
											$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.__('Home', 'cesis').'" href="'.esc_url( home_url() ).'">'.__('Home', 'cesis').'</a></li>';
										}
										 $html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item">' . post_type_archive_title("", false) . '</a><span class="bc_separator">'.$breadcrumb_separator.'</span></li>';

					} else if ( is_archive() && is_tax() && !is_category() && !is_tag() ) {

											if($breadcrumb_display_home == 'yes')
											{
												$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.__('Home', 'cesis').'" href="'.esc_url( home_url() ).'">'.__('Home', 'cesis').'</a></li>';
											}
										 // If post is a custom post type
										 $post_type = get_post_type();

										 // If it is a custom post type display name and link
										 if($post_type !== 'post' && $post_type !== 'portfolio' && $post_type !== 'staff' && $post_type !== 'careers') {

												 $post_type_object = get_post_type_object($post_type);
												 $post_type_archive = get_post_type_archive_link($post_type);

												 $html .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a><span class="bc_separator">'.$breadcrumb_separator.'</span></li>';


										 }
										 elseif($post_type == 'portfolio') {

												 $post_type_object = get_post_type_object($post_type);
												 $post_type_archive = $cesis_data['cesis_portfolio_main_url'];

												 $html .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a><span class="bc_separator">'.$breadcrumb_separator.'</span></li>';


										 }
										 elseif($post_type == 'staff') {

												 $post_type_object = get_post_type_object($post_type);
												 $post_type_archive = $cesis_data['cesis_staff_main_url'];

												 $html .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a><span class="bc_separator">'.$breadcrumb_separator.'</span></li>';


										 }
										 elseif($post_type == 'careers') {

												 $post_type_object = get_post_type_object($post_type);
												 $post_type_archive = $cesis_data['cesis_career_main_url'];

												 $html .= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a><span class="bc_separator">'.$breadcrumb_separator.'</span></li>';


										 }

										 $custom_tax_name = get_queried_object()->name;
										 $html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" >'.$custom_tax_name.'</a><span class="bc_separator">'.$breadcrumb_separator.'</span></li>';


								 }
				else if(is_author())
					{

						if($breadcrumb_display_home == 'yes')
							{
							$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.__('Home', 'cesis').'" href="'.esc_url( home_url() ).'">'.__('Home', 'cesis').'</a></li>';
							}

						$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" href="'.esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ).'">'.get_the_author().'</a></li>';



					}

				else if(is_search())
					{

						$current_query = sanitize_text_field(get_query_var('s'));

						if($breadcrumb_display_home == 'yes')
							{
							$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.__('Home', 'cesis').'" href="'.esc_url( home_url() ).'">'.__('Home', 'cesis').'</a></li>';
							}


						if(empty($current_query))
							{
								$current_query = __('Search:', 'cesis');
							}
						else
							{
								$current_query = __('Search:', 'cesis').' '.$current_query;
							}
						$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" href="#">'.$current_query.'</a><span class="bc_separator">'.$breadcrumb_separator.'</span></li>';


					}


				else if(is_year())
					{

						if($breadcrumb_display_home == 'yes')
							{
							$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.__('Home', 'cesis').'" href="'.esc_url( home_url() ).'">'.__('Home', 'cesis').'</a></li>';
							}

						$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" href="#">'.get_the_date('Y').'</a></li>';

					}

				else if(is_month())
					{

						if($breadcrumb_display_home == 'yes')
							{
							$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.__('Home', 'cesis').'" href="'.esc_url( home_url() ).'">'.__('Home', 'cesis').'</a></li>';
							}

						$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" href="#">'.get_the_date('F').'</a></li>';

					}


				else if(is_date())
					{

						if($breadcrumb_display_home == 'yes')
							{
							$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.__('Home', 'cesis').'" href="'.esc_url( home_url() ).'">'.__('Home', 'cesis').'</a></li>';
							}

						$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" href="#">'.get_the_date().'</a></li>';

					}

				elseif(is_404())
					{


						if($breadcrumb_display_home == 'yes')
							{
							$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><a itemprop="item" title="'.__('Home', 'cesis').'" href="'.esc_url( home_url() ).'">'.__('Home', 'cesis').'</a></li>';
							}

						$html.= '<li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem"><span class="bc_separator">'.$breadcrumb_separator.'</span><a itemprop="item" href="#">404</a></li>';

					}

				else
					{
						$html.= '';
					}




				$html.= '</ul>';

				$html.= '</div>';

				return $html;


			}



	}
