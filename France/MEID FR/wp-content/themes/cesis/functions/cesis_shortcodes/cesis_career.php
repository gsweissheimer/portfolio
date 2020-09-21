<?php


if (!class_exists('WPBakeryShortCode_cesis_career')) {
	class WPBakeryShortCode_cesis_career extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			global $cesis_data;
			extract( shortcode_atts( array(
		    'type' => 'isotope_grid',
		    'style' => 'cesis_career_style_1',
				'hover' => '',
				'effect' => '',
   			'hover_color' => '',
   			'force_font' => '',
		    'thumbnail_size' => 'tn_squared',
		    'to_show' => '5',
		    'padding' => '30',
		    'category' => 'all',
				'order' => 'DESC',
				'orderby' => 'date',
				'target' => '_self',
				'i_text' => 'yes',
				'i_date' => 'yes',
				'i_location' => 'yes',
				'i_category' => 'no',
				'text_source' => 'description',
				'char_length' => '125',
				'read_more' => 'yes',
				'read_more_style' => 'text',
				'rm_t_font' => 'main_font',
				'rm_t_f_weight' => '400',
				'rm_t_t_transform' => 'none',
				'rm_t_l_spacing' => '0',
				'read_more_button_style' => 'cesis_btn',
				'rm_font' => 'main_font',
				'rm_t_color' => '',
				'rm_bg_color' => '',
				'rm_b_color' => '',
				'rm_ht_color' => '',
				'rm_hbg_color' => '',
				'rm_hb_color' => '',
				'rm_b_radius' => '0',
				'rm_b_shape' => '',
				'rm_b_size' => 'read_more_small',
				'rm_l_spacing' => '0',
				'rm_f_size' => '14',
				'rm_f_weight' => '400',
				'rm_t_transform' => 'uppercase',

				'h_f_size' => '14px',
				'h_f_weight' => '700',
				'h_l_height' => '24px',
				'h_t_transform' => 'uppercase',
				'h_l_spacing' => '0',
				'heading_font' => 'alt_font',
				'h_google_fonts' => '',
				't_f_size' => '14px',
				't_f_weight' => '400',
				't_l_height' => '24px',
				't_t_transform' => 'none',
				't_l_spacing' => '0',
				'text_font' => 'main_font',
				'google_fonts' => '',

 				'filter' => 'no',
				'filter_type' => 'isotope_filter',
				'filter_base' => 'category',
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
				'm_bg_color' => '',
				'm_b_color' => '',
				'm_h_color' => '',
				'm_lt_color' => '',
				'm_a_color' => '',
				'css_animation' => '',
				'hide_lg' => '',
				'hide_md' => '',
				'hide_sm' => '',
				'el_class' => ''
			), $atts ) );

			$output =  $rm_style_default = '';
			$id = RandomString(20);
			$page_custom_content = "no";
			$filter_b_margin = $filter_b_margin - $filter_space;

			// Font settings
			if($force_font == 'custom'){
			$settings = get_option( 'wpb_js_google_fonts_subsets' );
			if ( is_array( $settings ) && ! empty( $settings ) ) {
				$subsets = '&subset=' . implode( ',', $settings );
			} else {
				$subsets = '';
			}
			$h_google_fonts_field_settings = isset( $h_google_fonts_field['settings'], $h_google_fonts_field['settings']['fields'] ) ? $h_google_fonts_field['settings']['fields'] : array();
			$h_google_fonts_obj = new Vc_Google_Fonts();

			$h_google_fonts_data = strlen( $h_google_fonts ) > 0 ? $h_google_fonts_obj->_vc_google_fonts_parse_attributes( $h_google_fonts_field_settings, $h_google_fonts ) : '';

			$h_styles = 'font-size:'.$h_f_size.'; ';
			$h_styles .= 'letter-spacing:'.$h_l_spacing.'px; ';
			$h_styles .= 'line-height:'.$h_l_height.'; ';
			$h_styles .= 'text-transform:'.$h_t_transform.'; ';



	if ( isset( $h_google_fonts_data['values']['font_family'] ) ) {
		wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $h_google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $h_google_fonts_data['values']['font_family'] . $subsets );
	}

	if ( $heading_font == 'custom' && ! empty( $h_google_fonts_data ) && isset( $h_google_fonts_data['values'], $h_google_fonts_data['values']['font_family'], $h_google_fonts_data['values']['font_style'] ) ) {
				$h_google_fonts_family = explode( ':', $h_google_fonts_data['values']['font_family'] );
				$h_styles .= 'font-family:' . $h_google_fonts_family[0].'; ';
				$h_google_fonts_styles = explode( ':', $h_google_fonts_data['values']['font_style'] );
				$h_styles .= 'font-weight:' . $h_google_fonts_styles[1].'; ';
				$h_styles .= 'font-style:' . $h_google_fonts_styles[2].';';
			}else{
				$h_styles .= 'font-weight:' .$h_f_weight.'; ';
			}

			$google_fonts_field_settings = isset( $google_fonts_field['settings'], $google_fonts_field['settings']['fields'] ) ? $google_fonts_field['settings']['fields'] : array();
			$google_fonts_obj = new Vc_Google_Fonts();

			$t_google_fonts_data = strlen( $google_fonts ) > 0 ? $google_fonts_obj->_vc_google_fonts_parse_attributes( $google_fonts_field_settings, $google_fonts ) : '';

			$t_styles = 'font-size:'.$t_f_size.'; ';
			$t_styles .= 'letter-spacing:'.$t_l_spacing.'px; ';
			$t_styles .= 'line-height:'.$t_l_height.'; ';
			$t_styles .= 'text-transform:'.$t_t_transform.'; ';


	if ( isset( $t_google_fonts_data['values']['font_family'] ) ) {
		wp_enqueue_style( 'vc_google_fonts_' . vc_build_safe_css_class( $t_google_fonts_data['values']['font_family'] ), '//fonts.googleapis.com/css?family=' . $t_google_fonts_data['values']['font_family'] . $subsets );
	}

	if ( $text_font == 'custom' && ! empty( $t_google_fonts_data ) && isset( $t_google_fonts_data['values'], $t_google_fonts_data['values']['font_family'], $t_google_fonts_data['values']['font_style'] ) ) {
				$t_google_fonts_family = explode( ':', $t_google_fonts_data['values']['font_family'] );
				$t_styles .= 'font-family:' . $t_google_fonts_family[0].'; ';
				$t_google_fonts_styles = explode( ':', $t_google_fonts_data['values']['font_style'] );
				$t_styles .= 'font-weight:' . $t_google_fonts_styles[1].'; ';
				$t_styles .= 'font-style:' . $t_google_fonts_styles[2].';';
			}else{
				$t_styles .= 'font-weight:' .$t_f_weight.'; ';
			}
			$output .='#cesis_career_'.$id.' .cesis_career_m_title {'.$h_styles.'}#cesis_career_'.$id.' .cesis_career_m_entry {'.$t_styles.'}';
		}else{
			$heading_font = $text_font = '';
		}






			// Style settings
			if($type == 'isotope_grid'){
				$layout = 'fitRows';
				$iso_class = '';
			}

			// Custom color settings

			if($m_h_color !== ''){
				$output .= '#cesis_career_'.$id.' .cesis_career_m_title a{color:'.$m_h_color.'}';
			}
			if($m_t_color !== ''){
				$output .= '#cesis_career_'.$id.' .cesis_career_m_entry{color:'.$m_t_color.'}';
			}
			if($m_a_color !== ''){
				$output .= '#cesis_career_'.$id.' .cesis_career_m_title a:hover{color:'.$m_a_color.'}';
			}
			if($m_bg_color !== '' && $style == 'cesis_career_style_2' ){
				$output .= '#cesis_career_'.$id.' .cesis_career_m_content{background:'.$m_bg_color.'}';
			}
			if($m_b_color !== '' && $style == 'cesis_career_style_2'){
				$output .= '#cesis_career_'.$id.' .cesis_career_m_content{border-color:'.$m_b_color.'}';
			}
			if($m_bg_color == ''){
				$m_bg_color = '#ffffff';
			}
			if($m_mbg_color == ''){
				$background_setting = '';
				$m_mbg_color = '#ffffff';
			}else{
				$background_setting = 'background:'.$m_mbg_color.';';
			}

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
					$output .= '#cesis_career_'.$id.' .owl-dot span{background:'.$pag_color.'}#cesis_career_'.$id.' .owl-dot.active span{background:'.$pag_active_color.'} ';
				}elseif($pag_type == 'cesis_owl_pag_2' && $pag_color !== '' && $pag_active_color !== ''){
					$output .= '#cesis_career_'.$id.' .owl-dot span{background:'.$pag_color.'; border-color:'.$pag_color.'}#cesis_career_'.$id.' .owl-dot.active span{background:none; border-color:'.$pag_active_color.'} ';
				}
			}

			// isotope


			if($iso_nav == 'classic_nav'){
				if($classic_nav_color !== ''){
					$output .= '#cesis_career_'.$id.' .cesis_navigation_ctn span{color:'.$classic_nav_color.'}';
					if($nav_style == 'cesis_nav_style_4'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_4 .cesis_nav_active.cesis_nav_number:after,
						#cesis_career_'.$id.' .cesis_nav_style_4 .cesis_nav_active.cesis_nav_number:after,
						#cesis_career_'.$id.' .cesis_nav_style_4 .cesis_nav_number:hover::after{color:'.$classic_nav_color.'}';
					}
				}
				if($classic_nav_b_color !== ''){
					if($nav_style == 'cesis_nav_style_0'){
						$output .= '#cesis_career_'.$id.' .cesis_navigation_ctn.cesis_nav_style_0 span{border-color:'.$classic_nav_b_color.'}';
					}
					if($nav_style == 'cesis_nav_style_1'){
							$output .= '#cesis_career_'.$id.' .cesis_navigation_ctn.cesis_nav_style_1 span{border-color:'.$classic_nav_b_color.'}';
					}
					if($nav_style == 'cesis_nav_style_2'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_2 .cesis_nav_prev,#cesis_career_'.$id.' .cesis_nav_style_2 .cesis_nav_next{border-color:'.$classic_nav_b_color.'}';
					}
					if($nav_style == 'cesis_nav_style_3'){
						$output .= '#cesis_career_'.$id.' .cesis_navigation_ctn.cesis_nav_style_3 span{border-color:'.$classic_nav_b_color.'}';
					}

				}
				if($classic_nav_bg_color !== ''){
					if($nav_style == 'cesis_nav_style_0'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_0 span{background:'.$classic_nav_bg_color.'}';
					}
					if($nav_style == 'cesis_nav_style_1'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_1 span{background:'.$classic_nav_bg_color.'}';
					}
					if($nav_style == 'cesis_nav_style_2'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_2 .cesis_nav_prev,#cesis_career_'.$id.' .cesis_nav_style_2 .cesis_nav_next{background:'.$classic_nav_bg_color.'}';
					}
					if($nav_style == 'cesis_nav_style_3'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_3 span{background:'.$classic_nav_bg_color.'}';
					}
				}
				if($classic_nav_a_color !== ''){
					if($nav_style == 'cesis_nav_style_0'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_0 span{background:'.$classic_nav_bg_color.'}';
					}
					if($nav_style == 'cesis_nav_style_1'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_1 span{background:'.$classic_nav_bg_color.'}';
					}
					if($nav_style == 'cesis_nav_style_2'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_2 span:hover,#cesis_career_'.$id.' .cesis_nav_style_2 span.cesis_nav_active{color:'.$classic_nav_a_color.'}';
					}
					if($nav_style == 'cesis_nav_style_3'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_3 span:hover,#cesis_career_'.$id.' .cesis_nav_style_3 span.cesis_nav_active{color:'.$classic_nav_a_color.'}';
					}
					if($nav_style == 'cesis_nav_style_4'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_4 span:hover,#cesis_career_'.$id.' .cesis_nav_style_4 span.cesis_nav_active{color:'.$classic_nav_a_color.'}';
					}
				}
				if($classic_nav_a_b_color !== ''){
					if($nav_style == 'cesis_nav_style_0'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_0 span{background:'.$classic_nav_bg_color.'}';
					}
					if($nav_style == 'cesis_nav_style_1'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_1 span{background:'.$classic_nav_bg_color.'}';
					}
					if($nav_style == 'cesis_nav_style_2'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_2 span:hover,#cesis_career_'.$id.' .cesis_nav_style_2 span.cesis_nav_active{border-color:'.$classic_nav_a_b_color.' !important}';
					}
					if($nav_style == 'cesis_nav_style_3'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_3 span:hover,#cesis_career_'.$id.' .cesis_nav_style_3 span.cesis_nav_active{border-color:'.$classic_nav_a_b_color.' !important}';
					}
				}
				if($classic_nav_a_bg_color !== ''){
					if($nav_style == 'cesis_nav_style_0'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_0 span{background:'.$classic_nav_bg_color.'}';
					}
					if($nav_style == 'cesis_nav_style_1'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_1 span{background:'.$classic_nav_bg_color.'}';
					}
					if($nav_style == 'cesis_nav_style_2'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_2 span:hover,#cesis_career_'.$id.' .cesis_nav_style_2 span.cesis_nav_active{background:'.$classic_nav_a_bg_color.'}';
					}
					if($nav_style == 'cesis_nav_style_3'){
						$output .= '#cesis_career_'.$id.' .cesis_nav_style_3 span:hover,#cesis_career_'.$id.' .cesis_nav_style_3 span.cesis_nav_active{background:'.$classic_nav_a_bg_color.'}';
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
					$output .= '#cesis_career_'.$id.' .cesis_filter li a,#cesis_career_'.$id.' .cesis_sorter {color:'.$filter_color.'}';
				}
				if($filter_b_color !== ''){
						$output .= '#cesis_career_'.$id.' .cesis_sorter ul{border-color:'.$filter_b_color.'}';
						if($filter_style == 'cesis_filter_style_3'){
							$output .= '#cesis_career_'.$id.' .cesis_filter_style_3 .cesis_filter{border-color:'.$filter_b_color.'}';
						}
						if($filter_style == 'cesis_filter_style_4'){
							$output .= '#cesis_career_'.$id.' .cesis_filter_style_4 .cesis_filter > li a,#cesis_career_'.$id.' .cesis_filter_style_4 .cesis_sorter{border-color:'.$filter_b_color.'}';
						}
						if($filter_style == 'cesis_filter_style_5'){
							$output .= '#cesis_career_'.$id.' .cesis_filter_style_5 .cesis_filter > li a,#cesis_career_'.$id.' .cesis_filter_style_5 .cesis_sorter{border-color:'.$filter_b_color.'}';
						}
						if($filter_style == 'cesis_filter_style_6'){
							$output .= '#cesis_career_'.$id.' .cesis_filter_style_6 .cesis_filter > li a,#cesis_career_'.$id.' .cesis_filter_style_6 .cesis_sorter{border-color:'.$filter_b_color.'}';
						}
						if($filter_style == 'cesis_filter_style_7'){
							$output .= '#cesis_career_'.$id.' .cesis_filter_style_7 .cesis_filter > li a,#cesis_career_'.$id.' .cesis_filter_style_7 .cesis_sorter{border-color:'.$filter_b_color.'}';
						}
				}
				if($filter_bg_color !== ''){
						$output .= '#cesis_career_'.$id.' .cesis_sorter ul';
						if($filter_style == 'cesis_filter_style_4'){
							$output .= '#cesis_career_'.$id.' .cesis_filter_style_4 .cesis_sorter,#cesis_career_'.$id.' .cesis_filter_style_4 .cesis_filter > li a{background:'.$filter_bg_color.'}';
						}
						if($filter_style == 'cesis_filter_style_5'){
							$output .= '#cesis_career_'.$id.' .cesis_filter_style_5 .cesis_sorter,#cesis_career_'.$id.' .cesis_filter_style_5 .cesis_filter > li a{background:'.$filter_bg_color.'}';
						}
						if($filter_style == 'cesis_filter_style_6'){
							$output .= '#cesis_career_'.$id.' .cesis_filter_style_6 .cesis_sorter,#cesis_career_'.$id.' .cesis_filter_style_6 .cesis_filter > li a{background:'.$filter_bg_color.'}';
						}
						if($filter_style == 'cesis_filter_style_7'){
							$output .= '#cesis_career_'.$id.' .cesis_filter_style_7 .cesis_sorter,#cesis_career_'.$id.' .cesis_filter_style_7 .cesis_filter > li a{background:'.$filter_bg_color.'}';
						}
				}
				if($filter_a_color !== ''){
					if($filter_style == 'cesis_filter_style_1'){
						$output .= '#cesis_career_'.$id.' .cesis_filter_style_1 .cesis_filter li.selected a,#cesis_career_'.$id.' .cesis_filter_style_1 .sort_selected{color:'.$filter_a_color.' !important }';
					}if($filter_style == 'cesis_filter_style_2'){
						$output .= '#cesis_career_'.$id.' .cesis_filter_style_2 .cesis_filter li.selected a,#cesis_career_'.$id.' .cesis_filter_style_2 .sort_selected{color:'.$filter_a_color.' !important }';
					}
					if($filter_style == 'cesis_filter_style_3'){
						$output .= '#cesis_career_'.$id.' .cesis_filter_style_3 .cesis_filter li.selected a,#cesis_career_'.$id.' .cesis_filter_style_3 .sort_selected{color:'.$filter_a_color.' !important }';
					}
					if($filter_style == 'cesis_filter_style_4'){
						$output .= '#cesis_career_'.$id.' .cesis_filter_style_4 .cesis_filter li.selected a,#cesis_career_'.$id.' .cesis_filter_style_4 .cesis_filter li.selected a:hover,
						#cesis_career_'.$id.' .cesis_filter_style_4 .sort_selected,#cesis_career_'.$id.' .cesis_filter_style_4 .cesis_sorter ul li.sort_selected,
						#cesis_career_'.$id.' .cesis_filter_style_4 .sort_selected:hover{color:'.$filter_a_color.' !important }';
					}
					if($filter_style == 'cesis_filter_style_5'){
						$output .= '#cesis_career_'.$id.' .cesis_filter_style_5 .cesis_filter li.selected a,#cesis_career_'.$id.' .cesis_filter_style_5 .cesis_filter li.selected a:hover,
						#cesis_career_'.$id.' .cesis_filter_style_5 .sort_selected,#cesis_career_'.$id.' .cesis_filter_style_5 .cesis_sorter ul li.sort_selected,
						#cesis_career_'.$id.' .cesis_filter_style_5 .sort_selected:hover{color:'.$filter_a_color.' !important }';
					}
					if($filter_style == 'cesis_filter_style_6'){
						$output .= '#cesis_career_'.$id.' .cesis_filter_style_6 .cesis_filter li.selected a,#cesis_career_'.$id.' .cesis_filter_style_6 .cesis_filter li.selected a:hover,
						#cesis_career_'.$id.' .cesis_filter_style_6 .sort_selected,#cesis_career_'.$id.' .cesis_filter_style_6 .cesis_sorter ul li.sort_selected,
						#cesis_career_'.$id.' .cesis_filter_style_6 .sort_selected:hover{color:'.$filter_a_color.' !important }';
					}
					if($filter_style == 'cesis_filter_style_7'){
						$output .= '#cesis_career_'.$id.' .cesis_filter_style_7 .cesis_filter li.selected a,#cesis_career_'.$id.' .cesis_filter_style_7 .cesis_filter li.selected a:hover,
						#cesis_career_'.$id.' .cesis_filter_style_7 .sort_selected,#cesis_career_'.$id.' .cesis_filter_style_7 .cesis_sorter ul li.sort_selected,
						#cesis_career_'.$id.' .cesis_filter_style_7 .sort_selected:hover{color:'.$filter_a_color.' !important }';
					}
				}
				if($filter_a_b_color !== ''){
					if($filter_style == 'cesis_filter_style_4'){
						$output .= '#cesis_career_'.$id.' .cesis_filter_style_4 .cesis_filter > li.selected a{border-color:'.$filter_a_b_color.'}';
					}
					if($filter_style == 'cesis_filter_style_5'){
						$output .= '#cesis_career_'.$id.' .cesis_filter_style_5 .cesis_filter > li.selected a{border-color:'.$filter_a_b_color.'}';
					}
					if($filter_style == 'cesis_filter_style_6'){
						$output .= '#cesis_career_'.$id.' .cesis_filter_style_6 .cesis_filter > li.selected a{border-color:'.$filter_a_b_color.'}';
					}
					if($filter_style == 'cesis_filter_style_7'){
						$output .= '#cesis_career_'.$id.' .cesis_filter_style_7 .cesis_filter > li.selected a{border-color:'.$filter_a_b_color.'}';
					}
					$output .= '#cesis_career_'.$id.' .filter_moving_line{background-color:'.$filter_a_b_color.'}';
				}
				if($filter_a_bg_color !== ''){
					if($filter_style == 'cesis_filter_style_4'){
						$output .= '#cesis_career_'.$id.' .cesis_filter_style_4 .cesis_filter > li.selected a,	#cesis_career_'.$id.' .cesis_filter_style_4 .sort_selected{background:'.$filter_a_bg_color.'}';
					}
					if($filter_style == 'cesis_filter_style_5'){
						$output .= '#cesis_career_'.$id.' .cesis_filter_style_5 .cesis_filter > li.selected a,	#cesis_career_'.$id.' .cesis_filter_style_5 .sort_selected{background:'.$filter_a_bg_color.'}';
					}
					if($filter_style == 'cesis_filter_style_6'){
						$output .= '#cesis_career_'.$id.' .cesis_filter_style_6 .cesis_filter > li.selected a,	#cesis_career_'.$id.' .cesis_filter_style_6 .sort_selected{background:'.$filter_a_bg_color.'}';
					}
					if($filter_style == 'cesis_filter_style_7'){
						$output .= '#cesis_career_'.$id.' .cesis_filter_style_7 .cesis_filter > li.selected a,	#cesis_career_'.$id.' .cesis_filter_style_7 .sort_selected{background:'.$filter_a_bg_color.'}';
					}
				}
				if($filter_h_color !== ''){
						$output .= '#cesis_career_'.$id.' .cesis_filter li a:hover,#cesis_career_'.$id.' .cesis_sorter li:hover{color:'.$filter_h_color.'}';
				}

			}



			// other options settings

			$new_padding = ($padding / 2);
			$animation = $this->getCSSAnimation( $css_animation );
			$page_custom_content = 'no';
			$margin_settings = ' margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px; ';
			$responsive_options = $hide_lg.' '.$hide_md.' '.$hide_sm.' ';
			if($read_more_style == 'text'){

				$rm_style = 'style="font-weight:'.$rm_t_f_weight.'; letter-spacing:'.$rm_t_l_spacing.'px; text-transform:'.$rm_t_t_transform.';';
				$rm_class = $rm_t_font.' ';

			}
			if($read_more_style == 'button_rm' && $read_more_button_style == 'custom'){

				$rm_style = 'onmouseleave="this.style.borderColor=\''.$rm_b_color.'\'; this.style.backgroundColor=\''.$rm_bg_color.'\'; this.style.color=\''.$rm_t_color.'\';" onmouseenter="this.style.borderColor=\''.$rm_hb_color.'\'; this.style.backgroundColor=\''.$rm_hbg_color.'\'; this.style.color=\''.$rm_ht_color.'\';" style="font-size:'.$rm_f_size.'px; font-weight:'.$rm_f_weight.'; letter-spacing:'.$rm_l_spacing.'px; text-transform:'.$rm_t_transform.'; color:'.$rm_t_color.'; background:'.$rm_bg_color.'; border-color:'.$rm_b_color.'; border-radius:'.$rm_b_radius.'px"';
				$rm_style_default = 'font-size:'.$rm_f_size.'px; font-weight:'.$rm_f_weight.'; letter-spacing:'.$rm_l_spacing.'px; text-transform:'.$rm_t_transform.'; color:'.$rm_t_color.'; background:'.$rm_bg_color.'; border-color:'.$rm_b_color.'; border-radius:'.$rm_b_radius.'px';
				$rm_class = $rm_b_size.' '.$rm_font.' ';
			}elseif($read_more_style == 'button_rm'){
				$rm_style_default = $rm_style = '';
				$rm_class = $read_more_button_style.' '.$rm_b_size.' '.$rm_b_shape.' ';
			}

			$carousel_data = 'data-col='.$col.' data-col_big='.$col_big.' data-col_tablet='.$col_tablet.' data-col_mobile='.$col_mobile.' data-nav='.$nav.' data-nav_tablet='.$nav_tablet.' data-nav_mobile='.$nav_mobile.' data-pag='.$pag.' data-pag_tablet='.$pag_tablet.' data-pag_mobile='.$pag_mobile.' data-loop='.$loop.' data-center='.$center.' data-margin='.$padding.' data-scroll='.$scroll.' data-speed='.$speed.' ';
			$ajax_data = 'data-heading="'.$heading_font.'" data-read_more="'.$read_more.'"  data-read_more_lb="'.$rm_b_color.'" data-read_more_lbg="'.$rm_bg_color.'" data-read_more_lc="'.$rm_t_color.'"  data-read_more_eb="'.$rm_hb_color.'" data-read_more_ebg="'.$rm_hbg_color.'" data-read_more_ec="'.$rm_ht_color.'" data-read_more_default="'.$rm_style_default.'" data-read_more_class="'.$rm_class.'" data-post_type="careers" data-style="'.$style.'" data-type="'.$type.'" data-padding="'.$new_padding.'" data-load="'.$to_show.'" data-order="'.$order.'" data-orderby="'.$orderby.'" data-cat="'.$category.'" data-thumbnail="'.$thumbnail_size.'" data-char_length="'.$char_length.'" data-text_source="'.$text_source.'"  data-i_location="'.$i_location.'"  data-i_date="'.$i_date.'"  data-i_category="'.$i_category.'"  data-i_text="'.$i_text.'" data-target="'.$target.'" data-animation="'.$animation.'" data-hover="'.$hover.'"  ';
			if($hover_color !== ''){
				if($hover == 'cesis_hover_overlay' ){
					$output .= '#cesis_career_'.$id.' .cesis_overlay_ctn{background:'.$hover_color.'}';

				}
			}
			ob_start();
		  if($output !== ''){
				echo '<style>'.$output.'</style>';
			}
			if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
			elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
			else { $paged = 1; }

			$cat_array = explode( ',', $category );
			$args = array(
		        'post_type' => 'careers',
		      	'post_status' => 'publish',
				'paged' => $paged,
				'order' => $order,
				'orderby' => $orderby,
		    'posts_per_page' => $to_show,
    		'post__not_in' => array( get_the_ID() ),
		    );
		    if ($category !== '' && $category !== "all") {
				$args['tax_query']=array(
		        array(
		        	'taxonomy' => 'career_category',
		            'field' => 'term_id',
		            'terms' => $cat_array
		        ));
				}


			$career_query = new WP_Query($args);

			if($iso_nav == 'none' && $filter_type !== 'ajax_filter'){
				$ajax_data = '';
			}




			if($type !== 'carousel'){ // isotope  ?>
				<div id="cesis_career_<?php  echo esc_attr($id) ?>" class="cesis_isotope_container  <?php  echo esc_attr($el_class).' '.esc_attr($responsive_options).' '.esc_attr($text_font)  ?>" style=" <?php  echo esc_attr($margin_settings) ?>" <?php echo $ajax_data ?> >

				<?php if($filter == 'yes'){	?>
				<div class="cesis_filter_ctn <?php echo esc_attr($filter_style).' cesis_'.esc_attr($filter_type).' cesis_filter_'.esc_attr($filter_pos).' '.esc_attr($sorter).'_'.esc_attr($sorter_pos).' '.esc_attr($filter_font) ?>" style="font-size:<?php echo esc_attr($filter_f_size) ?>px; font-weight:<?php echo esc_attr($filter_f_weight) ?>; text-transform:<?php echo esc_attr($filter_t_transform) ?>; letter-spacing:<?php echo esc_attr($filter_l_spacing) ?>px; margin-bottom:<?php echo esc_attr($filter_b_margin) ?>px;">
				<?php cesis_filter($filter_type,'careers',$filter_base,$sorter,$filter_space); ?>
				</div>
				<?php }	?>

				<div class="cesis_career_ctn <?php echo esc_attr($style).' '.esc_attr($force_font).' '.esc_attr($hover).' '.esc_attr($effect) ?> cesis_isotope col_<?php  echo esc_attr($col) ?>" style="margin-left:-<?php echo esc_attr($new_padding) ?>px; margin-right:-<?php echo esc_attr($new_padding) ?>px;" data-layout="<?php echo esc_attr($layout) ?>" >
			<?php }
			else {                    // carousel ?>
				<div id="cesis_career_<?php  echo esc_attr($id) ?>" class="cesis_career_ctn cesis_owl_carousel <?php echo esc_attr($style).' '.esc_attr($effect).' '.esc_attr($hover).' '.esc_attr($pag_type).' '.esc_attr($pag_pos).' '.esc_attr($force_font).' '.esc_attr($el_class).' '.esc_attr($responsive_options).' '.esc_attr($text_font)  ?>" style=" <?php  echo esc_attr($margin_settings) ?>" <?php echo esc_attr($carousel_data) ?> >
			<?php }

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
				if($type !== 'carousel'){
    			 echo '</div>';
					 if($iso_nav !== 'none' || $filter_type == 'ajax_filter'){
						 echo '<div class="load_more_btn '.$btn_class.'" '.$btn_style.' >'.__('Load more', 'cesis').'</div>';
					 }
					 if($iso_nav == 'classic_nav'){
						 echo '<div class="cesis_navigation_ctn '.$nav_pos.' '.$nav_style.'" style="margin-top:'.$nav_top_space.'px;">'.cesis_navigation($career_query->max_num_pages,'text').'</div>';
					 }
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
