<?php


if (!class_exists('WPBakeryShortCode_cesis_woocommerce')) {
	class WPBakeryShortCode_cesis_woocommerce extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			global $cesis_data;
			extract( shortcode_atts( array(
			  'type' => 'isotope_grid',
		    'style' => 'cesis_product_style_1',
				'product_type' => 'all',
		    'to_show' => '5',
		    'padding' => '30',
		    'category' => 'all',
		    'tag' => 'all',
				'order' => 'DESC',
				'orderby' => 'date',
				'target' => '_self',
				'i_price' => 'yes',
				'i_rating' => 'yes',
				'i_addtocart' => 'yes',

 				'filter' => 'no',
				'filter_type' => 'isotope_filter',
				'filter_base' => 'tag',
				'filter_style' => 'cesis_filter_style_1',
				'filter_pos' => 'left',
				'sorter' => 'no',
				'sorter_pos' => 'same',

				'filter_font' => 'alt_font',
				'filter_f_size' => '14',
				'filter_f_weight' => '700',
				'filter_t_transform' => 'uppercase',
				'filter_l_spacing' => '0',
				'filter_space' => '30',
				'filter_b_margin' => '0',


				'filter_color' => '',
				'filter_b_color' => '',
				'filter_bg_color' => '',
				'filter_a_color' => '',
				'filter_a_b_color' => '',
				'filter_a_bg_color' => '',
				'filter_h_color' => '',

		    'col' => '1',
        'col_big' => 'inherit',
		    'col_tablet' => '2',
		    'col_mobile' => '1',
		    'loop' => 'yes',
		    'center' => 'no',
		    'nav' => 'no',
        'nav_tablet' => '',
		    'nav_mobile' => '',
		    'pag' => 'no',
				'pag_type' =>  'cesis_owl_pag_1',
        'pag_pos' => '',
        'pag_tablet' => '',
		    'pag_mobile' => '',
		    'pag_color' => '',
		    'pag_active_color' => '',
		    'margin_top' => '0',
		    'margin_bottom' => '0',
				'scroll' => '',
				'speed' => '800',
				'iso_nav' => 'none',
				'nav_pos' => 'cesis_nav_justify',
				'nav_style' => 'cesis_nav_style_0',
				'nav_top_space' => '50',
				'classic_nav_color' => '',
				'classic_nav_b_color' => '',
				'classic_nav_bg_color' => '',
				'classic_nav_a_color' => '',
				'classic_nav_a_b_color' => '',
				'classic_nav_a_bg_color' => '',
				'load_more_size' => 'lb_small',
				'load_more_pos' => 'lb_center',
				'load_more_ff' => 'main_font',
				'load_more_shape' => '',
				'custom_color' => 'cesis_btn',
				'lb_t_color' => '',
				'lb_bg_color' => '',
				'lb_b_color' => '',
				'lb_ht_color' => '',
				'lb_hbg_color' => '',
				'lb_hb_color' => '',
				'lb_b_radius' => '0',
				'lb_l_spacing' => '0',
				'lb_f_size' => '14',
				'lb_f_weight' => '400',
				'lb_t_transform' => 'uppercase',
				'lb_shadow' => '',
				'm_mbg_color' => '',
				'm_t_color' => '',
				'm_price_color' => '',
				'm_old_price_color' => '',
				'css_animation' => '',
				'hide_lg' => '',
				'hide_md' => '',
				'hide_sm' => '',
				'el_class' => ''
			), $atts ) );

			$output = '';
			$id = RandomString(20);
			$page_custom_content = "no";
			$thumbnail_size = "woocommerce_thumbnail";
			$filter_b_margin = $filter_b_margin - $filter_space;
			// Style settings
			if($type == 'isotope_grid'){
				$layout = 'fitRows';
				$iso_class = '';
			}

			// Custom color settings

			// Pagination / Navigation settings

			// carousel
			if($nav_tablet == ''){
				$nav_tablet = $nav;
			}
			if($nav_mobile == ''){
				$nav_mobile = $nav;
			}
			if($pag_tablet == ''){
				$pag_tablet = $pag;
			}
			if($pag_mobile == ''){
				$pag_mobile = $pag;
			}
			if($pag == 'yes' || $pag_mobile == 'yes'  || $pag_tablet == 'yes' ){

				if($pag_type == 'cesis_owl_pag_1' && $pag_color !== '' && $pag_active_color !== '' || $pag_type == 'cesis_owl_pag_3' && $pag_color !== '' && $pag_active_color !== ''){
					$output .= '#cesis_woocommerce_'.$id.' .owl-dot span{background:'.$pag_color.'}#cesis_woocommerce_'.$id.' .owl-dot.active span{background:'.$pag_active_color.'} ';
				}elseif($pag_type == 'cesis_owl_pag_2' && $pag_color !== '' && $pag_active_color !== ''){
					$output .= '#cesis_woocommerce_'.$id.' .owl-dot span{background:'.$pag_color.'; border-color:'.$pag_color.'}#cesis_woocommerce_'.$id.' .owl-dot.active span{background:none; border-color:'.$pag_active_color.'} ';
				}
			}

			// isotope


			if($iso_nav == 'classic_nav'){
				if($classic_nav_color !== ''){
					$output .= '#cesis_woocommerce_'.$id.' .cesis_navigation_ctn span{color:'.$classic_nav_color.'}';
					if($nav_style == 'cesis_nav_style_4'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_nav_style_4 .cesis_nav_active.cesis_nav_number:after,
						#cesis_woocommerce_'.$id.' .cesis_nav_style_4 .cesis_nav_active.cesis_nav_number:after,
						#cesis_woocommerce_'.$id.' .cesis_nav_style_4 .cesis_nav_number:hover::after{color:'.$classic_nav_color.'}';
					}
				}
				if($classic_nav_b_color !== ''){
					if($nav_style == 'cesis_nav_style_1'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_navigation_ctn.cesis_nav_style_1 span{border-color:'.$classic_nav_b_color.'}';
					}
					if($nav_style == 'cesis_nav_style_2'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_nav_style_2 .cesis_nav_prev,#cesis_woocommerce_'.$id.' .cesis_nav_style_2 .cesis_nav_next{border-color:'.$classic_nav_b_color.'}';
					}
					if($nav_style == 'cesis_nav_style_3'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_navigation_ctn.cesis_nav_style_3 span{border-color:'.$classic_nav_b_color.'}';
					}

				}
				if($classic_nav_bg_color !== ''){
					if($nav_style == 'cesis_nav_style_1'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_nav_style_1 span{background:'.$classic_nav_bg_color.'}';
					}
					if($nav_style == 'cesis_nav_style_2'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_nav_style_2 .cesis_nav_prev,#cesis_woocommerce_'.$id.' .cesis_nav_style_2 .cesis_nav_next{background:'.$classic_nav_bg_color.'}';
					}
					if($nav_style == 'cesis_nav_style_3'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_nav_style_3 span{background:'.$classic_nav_bg_color.'}';
					}
				}
				if($classic_nav_a_color !== ''){
					if($nav_style == 'cesis_nav_style_1'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_nav_style_1 span:hover,#cesis_woocommerce_'.$id.' .cesis_nav_style_1 span.cesis_nav_active{color:'.$classic_nav_a_color.'}';
					}
					if($nav_style == 'cesis_nav_style_2'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_nav_style_2 span:hover,#cesis_woocommerce_'.$id.' .cesis_nav_style_2 span.cesis_nav_active{color:'.$classic_nav_a_color.'}';
					}
					if($nav_style == 'cesis_nav_style_3'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_nav_style_3 span:hover,#cesis_woocommerce_'.$id.' .cesis_nav_style_3 span.cesis_nav_active{color:'.$classic_nav_a_color.'}';
					}
					if($nav_style == 'cesis_nav_style_4'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_nav_style_4 span:hover,#cesis_woocommerce_'.$id.' .cesis_nav_style_4 span.cesis_nav_active{color:'.$classic_nav_a_color.'}';
					}
				}
				if($classic_nav_a_b_color !== ''){
					if($nav_style == 'cesis_nav_style_1'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_nav_style_1 span:hover,#cesis_woocommerce_'.$id.' .cesis_nav_style_1 span.cesis_nav_active{border-color:'.$classic_nav_a_b_color.' !important}';
					}
					if($nav_style == 'cesis_nav_style_2'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_nav_style_2 span:hover,#cesis_woocommerce_'.$id.' .cesis_nav_style_2 span.cesis_nav_active{border-color:'.$classic_nav_a_b_color.' !important}';
					}
					if($nav_style == 'cesis_nav_style_3'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_nav_style_3 span:hover,#cesis_woocommerce_'.$id.' .cesis_nav_style_3 span.cesis_nav_active{border-color:'.$classic_nav_a_b_color.' !important}';
					}
				}
				if($classic_nav_a_bg_color !== ''){
					if($nav_style == 'cesis_nav_style_1'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_nav_style_1 span:hover,#cesis_woocommerce_'.$id.' .cesis_nav_style_1 span.cesis_nav_active{background:'.$classic_nav_a_bg_color.'}';
					}
					if($nav_style == 'cesis_nav_style_2'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_nav_style_2 span:hover,#cesis_woocommerce_'.$id.' .cesis_nav_style_2 span.cesis_nav_active{background:'.$classic_nav_a_bg_color.'}';
					}
					if($nav_style == 'cesis_nav_style_3'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_nav_style_3 span:hover,#cesis_woocommerce_'.$id.' .cesis_nav_style_3 span.cesis_nav_active{background:'.$classic_nav_a_bg_color.'}';
					}
				}

			}
			if($iso_nav == 'load_more'){
				if($custom_color == 'custom'){
					if($lb_t_color == '') {
						if($cesis_data["cesis_main_content_accent_one"] !== '#ffffff'){
							$lb_t_color = "#ffffff";
						}else{
							$lb_t_color = "#ffffff";
						}
					}
					if($lb_bg_color == '') {
						$lb_t_color = $cesis_data["cesis_main_content_accent_one"];
					}
					if($lb_b_color == '') {
						$lb_t_color = $cesis_data["cesis_main_content_accent_one"];
					}
					if($lb_ht_color == '') {
						if($cesis_data["cesis_main_content_accent_one"] !== '#ffffff'){
							$lb_t_color = "#ffffff";
						}else{
							$lb_t_color = "#ffffff";
						}
					}
					if($lb_hbg_color == '') {
						$lb_t_color = $cesis_data["cesis_main_content_accent_two"];
					}
					if($lb_hb_color == '') {
						$lb_t_color = $cesis_data["cesis_main_content_accent_two"];
					}
					$btn_style='onmouseleave="this.style.borderColor=\''.$lb_b_color.'\'; this.style.backgroundColor=\''.$lb_bg_color.'\'; this.style.color=\''.$lb_t_color.'\';" onmouseenter="this.style.borderColor=\''.$lb_hb_color.'\'; this.style.backgroundColor=\''.$lb_hbg_color.'\'; this.style.color=\''.$lb_ht_color.'\';" style="margin-top:'.$nav_top_space.'px; font-size:'.$lb_f_size.'px; font-weight:'.$lb_f_weight.'; letter-spacing:'.$lb_l_spacing.'px; text-transform:'.$lb_t_transform.'; color:'.$lb_t_color.'; background:'.$lb_bg_color.'; border-color:'.$lb_b_color.'; border-radius:'.$lb_b_radius.'px"';
					$btn_class= $load_more_size.' '.$load_more_pos.' '.$load_more_ff.' '.$lb_shadow.' ';
				}else{
					$btn_style='style="margin-top:'.$nav_top_space.'px;"';
					$btn_class= $custom_color.' '.$load_more_size.' '.$load_more_pos.' '.$load_more_shape.'  ';
				}
			}
			if($iso_nav !== 'load_more' && $filter_type == 'ajax_filter' || $iso_nav == 'classic_nav'){
				$btn_style = 'style="display:none"';
				$btn_class= '';
			}


			// Filter settings

			if($filter == 'yes'){
				if($filter_color !== ''){
					$output .= '#cesis_woocommerce_'.$id.' .cesis_filter li a,#cesis_woocommerce_'.$id.' .cesis_sorter {color:'.$filter_color.'}';
				}
				if($filter_b_color !== ''){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_sorter ul{border-color:'.$filter_b_color.'}';
						if($filter_style == 'cesis_filter_style_3'){
							$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_3 .cesis_filter{border-color:'.$filter_b_color.'}';
						}
						if($filter_style == 'cesis_filter_style_4'){
							$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_4 .cesis_filter > li a,#cesis_woocommerce_'.$id.' .cesis_filter_style_4 .cesis_sorter{border-color:'.$filter_b_color.'}';
						}
						if($filter_style == 'cesis_filter_style_5'){
							$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_5 .cesis_filter > li a,#cesis_woocommerce_'.$id.' .cesis_filter_style_5 .cesis_sorter{border-color:'.$filter_b_color.'}';
						}
						if($filter_style == 'cesis_filter_style_6'){
							$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_6 .cesis_filter > li a,#cesis_woocommerce_'.$id.' .cesis_filter_style_6 .cesis_sorter{border-color:'.$filter_b_color.'}';
						}
						if($filter_style == 'cesis_filter_style_7'){
							$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_7 .cesis_filter > li a,#cesis_woocommerce_'.$id.' .cesis_filter_style_7 .cesis_sorter{border-color:'.$filter_b_color.'}';
						}
				}
				if($filter_bg_color !== ''){
						if($filter_style == 'cesis_filter_style_4'){
							$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_4 .cesis_sorter,#cesis_woocommerce_'.$id.' .cesis_filter_style_4 .cesis_filter > li a{background:'.$filter_bg_color.'}';
						}
						if($filter_style == 'cesis_filter_style_5'){
							$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_5 .cesis_sorter,#cesis_woocommerce_'.$id.' .cesis_filter_style_5 .cesis_filter > li a{background:'.$filter_bg_color.'}';
						}
						if($filter_style == 'cesis_filter_style_6'){
							$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_6 .cesis_sorter,#cesis_woocommerce_'.$id.' .cesis_filter_style_6 .cesis_filter > li a{background:'.$filter_bg_color.'}';
						}
						if($filter_style == 'cesis_filter_style_7'){
							$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_7 .cesis_sorter,#cesis_woocommerce_'.$id.' .cesis_filter_style_7 .cesis_filter > li a{background:'.$filter_bg_color.'}';
						}
				}
				if($filter_a_color !== ''){
					if($filter_style == 'cesis_filter_style_1'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_1 .cesis_filter li.selected a,#cesis_woocommerce_'.$id.' .cesis_filter_style_1 .sort_selected{color:'.$filter_a_color.' !important }';
					}if($filter_style == 'cesis_filter_style_2'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_2 .cesis_filter li.selected a,#cesis_woocommerce_'.$id.' .cesis_filter_style_2 .sort_selected{color:'.$filter_a_color.' !important }';
					}
					if($filter_style == 'cesis_filter_style_3'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_3 .cesis_filter li.selected a,#cesis_woocommerce_'.$id.' .cesis_filter_style_3 .sort_selected{color:'.$filter_a_color.' !important }';
					}
					if($filter_style == 'cesis_filter_style_4'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_4 .cesis_filter li.selected a,#cesis_woocommerce_'.$id.' .cesis_filter_style_4 .cesis_filter li.selected a:hover,
						#cesis_woocommerce_'.$id.' .cesis_filter_style_4 .sort_selected,#cesis_woocommerce_'.$id.' .cesis_filter_style_4 .cesis_sorter ul li.sort_selected,
						#cesis_woocommerce_'.$id.' .cesis_filter_style_4 .sort_selected:hover{color:'.$filter_a_color.' !important }';
					}
					if($filter_style == 'cesis_filter_style_5'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_5 .cesis_filter li.selected a,#cesis_woocommerce_'.$id.' .cesis_filter_style_5 .cesis_filter li.selected a:hover,
						#cesis_woocommerce_'.$id.' .cesis_filter_style_5 .sort_selected,#cesis_woocommerce_'.$id.' .cesis_filter_style_5 .cesis_sorter ul li.sort_selected,
						#cesis_woocommerce_'.$id.' .cesis_filter_style_5 .sort_selected:hover{color:'.$filter_a_color.' !important }';
					}
					if($filter_style == 'cesis_filter_style_6'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_6 .cesis_filter li.selected a,#cesis_woocommerce_'.$id.' .cesis_filter_style_6 .cesis_filter li.selected a:hover,
						#cesis_woocommerce_'.$id.' .cesis_filter_style_6 .sort_selected,#cesis_woocommerce_'.$id.' .cesis_filter_style_6 .cesis_sorter ul li.sort_selected,
						#cesis_woocommerce_'.$id.' .cesis_filter_style_6 .sort_selected:hover{color:'.$filter_a_color.' !important }';
					}
					if($filter_style == 'cesis_filter_style_7'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_7 .cesis_filter li.selected a,#cesis_woocommerce_'.$id.' .cesis_filter_style_7 .cesis_filter li.selected a:hover,
						#cesis_woocommerce_'.$id.' .cesis_filter_style_7 .sort_selected,#cesis_woocommerce_'.$id.' .cesis_filter_style_7 .cesis_sorter ul li.sort_selected,
						#cesis_woocommerce_'.$id.' .cesis_filter_style_7 .sort_selected:hover{color:'.$filter_a_color.' !important }';
					}
				}
				if($filter_a_b_color !== ''){
					if($filter_style == 'cesis_filter_style_4'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_4 .cesis_filter > li.selected a{border-color:'.$filter_a_b_color.'}';
					}
					if($filter_style == 'cesis_filter_style_5'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_5 .cesis_filter > li.selected a{border-color:'.$filter_a_b_color.'}';
					}
					if($filter_style == 'cesis_filter_style_6'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_6 .cesis_filter > li.selected a{border-color:'.$filter_a_b_color.'}';
					}
					if($filter_style == 'cesis_filter_style_7'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_7 .cesis_filter > li.selected a{border-color:'.$filter_a_b_color.'}';
					}
					$output .= '#cesis_woocommerce_'.$id.' .filter_moving_line{background-color:'.$filter_a_b_color.'}';
				}
				if($filter_a_bg_color !== ''){
					if($filter_style == 'cesis_filter_style_4'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_4 .cesis_filter > li.selected a,	#cesis_woocommerce_'.$id.' .cesis_filter_style_4 .sort_selected{background:'.$filter_a_bg_color.'}';
					}
					if($filter_style == 'cesis_filter_style_5'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_5 .cesis_filter > li.selected a,	#cesis_woocommerce_'.$id.' .cesis_filter_style_5 .sort_selected{background:'.$filter_a_bg_color.'}';
					}
					if($filter_style == 'cesis_filter_style_6'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_6 .cesis_filter > li.selected a,	#cesis_woocommerce_'.$id.' .cesis_filter_style_6 .sort_selected{background:'.$filter_a_bg_color.'}';
					}
					if($filter_style == 'cesis_filter_style_7'){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter_style_7 .cesis_filter > li.selected a,	#cesis_woocommerce_'.$id.' .cesis_filter_style_7 .sort_selected{background:'.$filter_a_bg_color.'}';
					}
				}
				if($filter_h_color !== ''){
						$output .= '#cesis_woocommerce_'.$id.' .cesis_filter li a:hover,#cesis_woocommerce_'.$id.' .cesis_sorter li:hover{color:'.$filter_h_color.'}';
				}

			}



			// other options settings

			$new_padding = ($padding / 2);
			$animation = $this->getCSSAnimation( $css_animation );
			$page_custom_content = 'no';
			$margin_settings = ' margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px; ';
			$responsive_options = $hide_lg.' '.$hide_md.' '.$hide_sm.' ';

			$carousel_data = 'data-col='.$col.'  data-col_big='.$col_big.' data-col_tablet='.$col_tablet.' data-col_mobile='.$col_mobile.' data-nav='.$nav.' data-nav_tablet='.$nav_tablet.' data-nav_mobile='.$nav_mobile.' data-pag='.$pag.' data-pag_tablet='.$pag_tablet.' data-pag_mobile='.$pag_mobile.' data-loop='.$loop.' data-center='.$center.' data-margin='.$padding.' data-scroll='.$scroll.' data-speed='.$speed.' ';
			$ajax_data = ' data-post_type="product" data-style="'.$style.'" data-type="'.$product_type.'" data-padding="'.$new_padding.'" data-load="'.$to_show.'" data-order="'.$order.'" data-orderby="'.$orderby.'" data-cat="'.$category.'" data-tag="'.$tag.'"  data-i_rating="'.$i_rating.'"  data-i_price="'.$i_price.'"  data-i_addtocart="'.$i_addtocart.'"  data-animation="'.$animation.'"  ';
			ob_start();
		  if($output !== ''){
				echo '<style>'.$output.'</style>';
			}
			if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
			elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
			else { $paged = 1; }
			if($orderby == "_price"){
				$args = array(
		    	'post_type' => 'product',
		      'post_status' => 'publish',
					'paged' => $paged,
					'order' => $order,
					'meta_key' => '_price',
					'orderby' => 'meta_value_num',
		    	'posts_per_page' => $to_show,
	    		'post__not_in' => array( get_the_ID() ),
		   	);
			}elseif($orderby == "total_sales"){
				$args = array(
		    	'post_type' => 'product',
		      'post_status' => 'publish',
					'paged' => $paged,
					'order' => $order,
					'meta_key' => 'total_sales',
					'orderby' => 'meta_value_num',
		    	'posts_per_page' => $to_show,
		   	);
			}elseif($orderby == "_wc_average_rating"){
				$args = array(
		    	'post_type' => 'product',
		      'post_status' => 'publish',
					'paged' => $paged,
					'order' => $order,
					'meta_key' => '_wc_average_rating',
					'orderby' => 'meta_value_num',
		    	'posts_per_page' => $to_show,
		   	);
			}else{
				$args = array(
 		    	'post_type' => 'product',
 		     	'post_status' => 'publish',
 					'paged' => $paged,
 					'order' => $order,
 					'orderby' => $orderby,
 		    	'posts_per_page' => $to_show,
 		   	);
			}
			if($product_type == "featured"){
				$args['tax_query']= array(
                 array(
                     'taxonomy' => 'product_visibility',
                     'field'    => 'name',
                     'terms'    => 'featured',
                     'operator' => 'IN'
                 )
							 );
			}
			if($product_type == "sale"){
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


			if($iso_nav == 'none' && $filter_type !== 'ajax_filter'){
				$ajax_data = '';
			}




			if($type !== 'carousel'){ // isotope  ?>
				<div id="cesis_woocommerce_<?php  echo esc_attr($id) ?>" class="cesis_isotope_container woocommerce <?php  echo esc_attr($el_class).' '.esc_attr($responsive_options) ?>" style=" <?php  echo esc_attr($margin_settings) ?>" <?php echo $ajax_data ?> >

				<?php if($filter == 'yes'){	?>
				<div class="cesis_filter_ctn <?php echo esc_attr($filter_style).' cesis_'.esc_attr($filter_type).' cesis_filter_'.esc_attr($filter_pos).' '.esc_attr($sorter).'_'.esc_attr($sorter_pos).' '.esc_attr($filter_font) ?>" style="font-size:<?php echo esc_attr($filter_f_size) ?>px; font-weight:<?php echo esc_attr($filter_f_weight) ?>; text-transform:<?php echo esc_attr($filter_t_transform) ?>; letter-spacing:<?php echo esc_attr($filter_l_spacing) ?>px; margin-bottom:<?php echo esc_attr($filter_b_margin) ?>px;">
				<?php cesis_filter($filter_type,'product',$filter_base,$sorter,$filter_space); ?>
				</div>
				<?php }	?>

				<div class="cesis_woocommerce_ctn products <?php echo esc_attr($style) ?> cesis_isotope col_<?php  echo esc_attr($col) ?>" style="margin-left:-<?php echo esc_attr($new_padding) ?>px; margin-right:-<?php echo esc_attr($new_padding) ?>px;" data-layout="<?php echo esc_attr($layout) ?>" >
			<?php }
			else {                    // carousel ?>
				<div class="woocommerce"><div id="cesis_woocommerce_<?php  echo esc_attr($id) ?>" class="cesis_woocommerce_ctn cesis_owl_carousel products <?php echo esc_attr($style).' '.esc_attr($pag_type).' '.esc_attr($pag_pos).' '.esc_attr($el_class).' '.esc_attr($responsive_options) ?>" style=" <?php  echo esc_attr($margin_settings) ?>" <?php echo esc_attr($carousel_data) ?> >
			<?php }

				if ($product_query->have_posts()) : while ($product_query->have_posts()) : $product_query->the_post();

				global $post, $product;

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
					<?php if($type !== 'carousel'){?>
						<div class="cesis_iso_item <?php echo esc_attr($item_cat).' '.esc_attr($item_tag).' '.esc_attr($packery_class) ?>" style="padding:<?php echo esc_attr($new_padding) ?>px;">
						<div class="cesis_isotope_filter_data"><span class="isotope_filter_name"><?php echo the_title(); ?></span><span class="isotope_filter_date"><?php echo the_time('YmdHis'); ?></span><span class="isotope_filter_price"><?php
						$price = get_post_meta( get_the_ID(), '_regular_price', true);
						$sale = get_post_meta( get_the_ID(), '_sale_price', true);
						if($sale){
							echo $sale;
						}elseif($price){
							echo $price;
						} ?></span></div>
                    <?php } ?>
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
					<?php if($type !== 'carousel'){?>
          	</div>
          <?php } ?>

	    		<?php
				endwhile; endif;
				if($type !== 'carousel'){
    			 echo '</div>';
					 if($iso_nav !== 'none' || $filter_type == 'ajax_filter'){
						 echo '<div class="load_more_btn '.$btn_class.'" '.$btn_style.' >'.__('Load more', 'cesis').'</div>';
					 }
					 if($iso_nav == 'classic_nav'){
						 echo '<div class="cesis_navigation_ctn '.$nav_pos.' '.$nav_style.'" style="margin-top:'.$nav_top_space.'px;">'.cesis_navigation($product_query->max_num_pages,'text').'</div>';
					 }
				}else{
					echo '</div>';
				}

				echo '</div>';
	       		wp_reset_postdata();


			$output_string = ob_get_contents();
			ob_end_clean();
			return $output_string;
		}
	}
}

?>
