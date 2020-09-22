<?php


if (!class_exists('WPBakeryShortCode_cesis_partners')) {
	class WPBakeryShortCode_cesis_partners extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			global $cesis_data;
			extract( shortcode_atts( array(
	      'style' => 'cesis_partners_1',
	      'sep_b_color' => '',
				'hover' => '',
		    'to_show' => '5',
		    'type' => 'carousel',
		    'category' => '',
				'order' => 'DESC',
				'orderby' => 'date',
				'target' => '_blank',
      	'col' => '1',
        'col_big' => 'inherit',
		    'col_tablet' => '2',
		    'col_mobile' => '1',
		    'row' => '1',
		    'loop' => 'yes',
		    'center' => 'no',
     	  'nav' => 'yes',
		    'nav_tablet' => '',
		    'nav_mobile' => '',
		    'nav_color' => '',
		    'nav_active_color' => '',
       	'nav_type' => 'cesis_owl_pag_1',
        'nav_pos' => '',
		    'margin_top' => '0',
		    'margin_bottom' => '0',
				'scroll' => '',
				'speed' => '800',
				'load_more_nav' => 'no',
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
				'css_animation' => '',
				'hide_lg' => '',
				'hide_md' => '',
				'hide_sm' => '',
				'el_class' => ''
			), $atts ) );

			global $cesis_data;
			$animation = $this->getCSSAnimation( $css_animation );
			$page_custom_content = 'no';
			$margin_settings = 'style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;"';
			$responsive_options = $hide_lg.' '.$hide_md.' '.$hide_sm.' ';
			$ajax_data = 'data-post_type="partners" data-load="'.$to_show.'" data-order="'.$order.'" data-orderby="'.$orderby.'" data-cat="'.$category.'" data-target="'.$target.'" data-animation="'.$animation.'" ';
			$id = RandomString(20);

			ob_start();
			$output = '';

			if($nav_tablet == ''){
				$nav_tablet = $nav;
			}
			if($nav_mobile == ''){
				$nav_mobile = $nav;
			}
			if($nav == 'yes' || $nav_mobile == 'yes'  || $nav_tablet == 'yes' ){

				if($nav_type == 'cesis_owl_pag_1' && $nav_color !== '' && $nav_active_color !== '' || $nav_type == 'cesis_owl_pag_3' && $nav_color !== '' && $nav_active_color !== ''){
					$output .= '<style type="text/css">#cesis_partners_'.$id.' .owl-dot span{background:'.$nav_color.'}#cesis_partners_'.$id.' .owl-dot.active span{background:'.$nav_active_color.'}</style>';
				}elseif($nav_type == 'cesis_owl_pag_2' && $nav_color !== '' && $nav_active_color !== ''){
					$output .= '<style type="text/css">#cesis_partners_'.$id.' .owl-dot span{background:'.$nav_color.'; border-color:'.$nav_color.'}#cesis_partners_'.$id.' .owl-dot.active span{background:none; border-color:'.$nav_active_color.'}</style>';
				}

			}

			if($load_more_nav == 'yes'){
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
					$btn_style='onmouseleave="this.style.borderColor=\''.$lb_b_color.'\'; this.style.backgroundColor=\''.$lb_bg_color.'\'; this.style.color=\''.$lb_t_color.'\';" onmouseenter="this.style.borderColor=\''.$lb_hb_color.'\'; this.style.backgroundColor=\''.$lb_hbg_color.'\'; this.style.color=\''.$lb_ht_color.'\';" style="font-size:'.$lb_f_size.'px; font-weight:'.$lb_f_weight.'; letter-spacing:'.$lb_l_spacing.'px; text-transform:'.$lb_t_transform.'; color:'.$lb_t_color.'; background:'.$lb_bg_color.'; border-color:'.$lb_b_color.'; border-radius:'.$lb_b_radius.'px"';
					$btn_class= $load_more_size.' '.$load_more_pos.' '.$load_more_ff.' '.$lb_shadow.' ';
				}else{
					$btn_style="";
					$btn_class= $custom_color.' '.$load_more_size.' '.$load_more_pos.' '.$load_more_shape.'  ';
				}
			}

			if($style == 'cesis_partners_2' && $sep_b_color !== ''){
				$output .= '<style type="text/css">#cesis_partners_'.$id.' .cesis_iso_item,#cesis_partners_'.$id.' .cesis_partners_col_ctn div,#cesis_partners_'.$id.' .owl-item{border-color:'.$sep_b_color.';} </style>';
			}


			if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
			elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
			else { $paged = 1; }

			$cat_array = explode( ',', $category );
			if ($category!=="all" && $category!=="") {
				$args = array(
					'post_type' => "partners",
					'order' => $order,
					'orderby' => $orderby,
				  'posts_per_page' => $to_show,
					'paged' => $paged,
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

			}else{
				$args = array(
			    'post_type' => "partners",
					'order' => $order,
					'orderby' => $orderby,
			    'post_status' => 'publish',
			    'posts_per_page' => $to_show,
					'paged' => $paged,
				);
			}

			$partners_query = new WP_Query($args);

			if($type == 'carousel'){
				if($row !== 1 ){
					$col_v = $col;
				}
				$output .= '<div id="cesis_partners_'.$id.'" class="cesis_partners_ctn '.$style.' '.$hover.' cesis_owl_'.$type.' '.$nav_type.' '.$nav_pos.' col_'.$col.' '.$el_class.' '.$responsive_options.'" '.$margin_settings.'  data-col="'.$col.'" data-col_big="'.$col_big.'" data-col_tablet="'.$col_tablet.'" data-col_mobile="'.$col_mobile.'" data-scroll="'.$scroll.'" data-speed="'.$speed.'" data-pag="'.$nav.'" data-pag_tablet="'.$nav_tablet.'" data-pag_mobile="'.$nav_mobile.'" data-nav="no" data-nav_tablet="no" data-nav_mobile="no" data-loop="'.$loop.'" data-center="'.$center.'" >';
				$i = 0;
			    if ($partners_query->have_posts()) : while ($partners_query->have_posts()) : $partners_query->the_post();

					if($i == 0 && $row !== 1 ){
						$output.= '<div class="cesis_partners_col_ctn">';
				    }

					$link = $cesis_data['cesis_partner_link'];
					$thumb = get_the_post_thumbnail( $partners_query->ID, 'full', array( 'class' => 'inside_e '.$animation ) );

					if($link !== ''){
						$output .='
						<div>
					    <a href="'.$link.'" target="'.$target.'">
					    '.$thumb.'
					    </a>
					    </div>';
					}else{
						$output .='
						<div>
					    '.$thumb.'
					    </div>';
					}

					$i ++;

					if($i == $row  ){
						$output.= '</div>';
						$i = 0;
				    }

			    endwhile; endif;
			    $output.= '</div>';
    	  		wp_reset_postdata();
			}

			if($type == 'isotope'){
				if($load_more_nav !== 'yes'){
					$ajax_data = '';
				}
				$output .= '<div id="cesis_partners_'.$id.'" class="cesis_isotope_container  '.$el_class.' '.$responsive_options.'" '.$margin_settings.' '.$ajax_data.' >';
				$output .= '<div class="cesis_partners_ctn '.$style.' cesis_'.$type.' col_'.$col.'  '.$hover.' '.$responsive_options.'">';
			    if ($partners_query->have_posts()) : while ($partners_query->have_posts()) : $partners_query->the_post();
					$link = $cesis_data['cesis_partner_link'];
					$thumb = get_the_post_thumbnail( $partners_query->ID, 'full');
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
		   		endwhile; endif;
			    $output.= '</div>';
				if($load_more_nav == 'yes'){
				    $output.= '<div class="load_more_btn '.$btn_class.'" '.$btn_style.' >'.__('Load more', 'cesis').'</div>';
				}
			    $output.= '</div>';
				wp_reset_postdata();
			}

			echo $output;
			$output_string = ob_get_contents();
			ob_end_clean();
			return $output_string;

		}
	}
}

?>
