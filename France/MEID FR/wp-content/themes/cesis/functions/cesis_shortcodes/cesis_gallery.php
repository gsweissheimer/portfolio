<?php


if (!class_exists('WPBakeryShortCode_cesis_gallery')) {
	class WPBakeryShortCode_cesis_gallery extends WPBakeryShortCode {
		protected function content( $atts, $content = null ) {
			global $cesis_data;
			extract( shortcode_atts( array(
				'hover' => '',
		    'type' => 'isotope_grid',
				'images' => '',
				'img_size' => '',
				'custom_srcs' => '',
				'custom_links' => '',
				'custom_links_target' => '_self',
				'effect' => '',
				'onclick' => 'link_image',
		    'padding' => '40',
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
				'pag_pos' =>  '',
        'pag_tablet' => '',
		    'pag_mobile' => '',
		    'pag_color' => '',
		    'pag_active_color' => '',
		    'margin_top' => '0',
		    'margin_bottom' => '0',
				'scroll' => '',
				'speed' => '800',
				'css_animation' => '',
				'hide_lg' => '',
				'hide_md' => '',
				'hide_sm' => '',
				'el_class' => ''
			), $atts ) );

			global $cesis_data;
			$style = '';
			$page_custom_content = 'no';
			$animation = $this->getCSSAnimation( $css_animation );
			$margin_settings = 'style="margin-top:'.$margin_top.'px; margin-bottom:'.$margin_bottom.'px;"';
			$responsive_options = $hide_lg.' '.$hide_md.' '.$hide_sm.' ';
			$id = RandomString(20);
			if($type == 'isotope_grid'){
				$layout = 'fitRows';
			}elseif($type == 'isotope_masonry'){
				$layout = 'masonry';
			}elseif($type == 'isotope_packery'){
				$layout = 'packery';
			}
			$new_padding = ($padding / 2);

			if($effect == 'cesis_effect_frame' && $type == 'isotope_packery' && $padding !== '0'){
				$padding = $padding + 20;
			}

			if($type == 'isotope_packery' && $padding !== '0' && $effect !== 'no'){
				$style .= '#cesis_gallery_'.$id.' .inside_e > a:before {
    								content: "";
    								position: absolute;
    								width: 100%;
    								height: 100%;
										z-index:1;
    								box-shadow: inset 0 0 0 '.$new_padding.'px #fff, 0 0 0 1px #fff;
									  }';
										if($effect == 'cesis_effect_frame'){
											$style .= '#cesis_gallery_'.$id.' .inside_e > a:after {
																	top: '.(($padding - 20) / 2).'px;
																	left: '.(($padding - 20) / 2).'px;
															    width: calc(100% - '.($padding - 20).'px );
															    height: calc(100% - '.($padding - 20).'px );
																}';
										}elseif($effect == 'cesis_effect_shadow'){
											$style .= '#cesis_gallery_'.$id.' .inside_e > a:after {
																	top: '.$new_padding.'px;
																	left: '.$new_padding.'px;
															    width: calc(100% - '.$padding.'px );
															    height: calc(100% - '.$padding.'px );
																}';
										}
			}

if($effect == 'cesis_effect_frame' && $type == 'isotope_packery' && $padding !== '0'){
$new_padding = $new_padding - 10;
}

			$gal_images = '';
			$link_start = '';
			$link_end = '';
			if($type !== 'carousel'){
				$el_start = '<div class="cesis_iso_item" style="padding:'.esc_attr($new_padding).'px;"><div class="inside_e '.esc_attr($animation).'">';
				$el_end = '</div></div>';
			}else{
				$el_start = '<div class="inside_e '.esc_attr($animation).'">';
				$el_end = '</div>';
			}


			ob_start();
			$output = '';

			if ( 'custom_link' === $onclick ) {
				$custom_links = vc_value_from_safe( $custom_links );
				$custom_links = explode( ',', $custom_links );
			}
			$images = explode( ',', $images );

			foreach ( $images as $i => $image ) {
						if ( $image > 0 ) {
							$img = wpb_getImageBySize( array(
								'attach_id' => $image,
								'thumb_size' => $img_size,
							) );
							$thumbnail = $img['thumbnail'];
							$large_img_src = $img['p_img_large'][0];
						} else {
							$large_img_src = $default_src;
							$thumbnail = '<img src="' . $default_src . '" />';
						}



				$link_start = $link_end = '';

				switch ( $onclick ) {
					case 'img_link_large':
						$link_start = '<a href="' . $large_img_src . '" target="' . $custom_links_target . '">';
						$link_end = '</a>';
						break;

					case 'link_image':
						$link_start = '<a class="cesis_gallery_lightbox" href="' . $large_img_src . '">';
						$link_end = '</a>';
						break;

					case 'custom_link':
						if ( ! empty( $custom_links[ $i ] ) ) {
							$link_start = '<a href="' . $custom_links[ $i ] . '"' . ( ! empty( $custom_links_target ) ? ' target="' . $custom_links_target . '"' : '' ) . '>';
							$link_end = '</a>';
						}
						break;
				}

				$gal_images .= $el_start . $link_start . $thumbnail . $link_end . $el_end;
			}

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
					$style .= '#cesis_gallery_'.$id.' .owl-dot span{background:'.$pag_color.'}#cesis_gallery_'.$id.' .owl-dot.active span{background:'.$pag_active_color.'} ';
				}elseif($pag_type == 'cesis_owl_pag_2' && $pag_color !== '' && $pag_active_color !== ''){
					$style .= '#cesis_gallery_'.$id.' .owl-dot span{background:'.$pag_color.'; border-color:'.$pag_color.'}#cesis_gallery_'.$id.' .owl-dot.active span{background:none; border-color:'.$pag_active_color.'} ';
				}
			}

			if($style !== ''){
				$output .= '<style>'.$style.'</style>';
			}

			if($type == 'carousel'){
				$output .= '<div id="cesis_gallery_'.$id.'" class="cesis_gallery_ctn cesis_owl_carousel '.$hover.' '.$effect.' '.$pag_type.' '.$pag_pos.' col_'.$col.' '.$el_class.' '.$responsive_options.'" '.$margin_settings.'
				data-col="'.$col.'"  data-col_big="'.$col_big.'" data-col_tablet="'.$col_tablet.'" data-col_mobile="'.$col_mobile.'" data-scroll="'.$scroll.'" data-speed="'.$speed.'" data-pag="'.$pag.'" data-pag_tablet="'.$pag_tablet.'" data-pag_mobile="'.$pag_mobile.'" data-margin="'.$padding.'" data-nav="'.$nav.'" data-nav_tablet="'.$nav_tablet.'" data-nav_mobile="'.$nav_mobile.'" data-loop="'.$loop.'" data-center="'.$center.'" >';
				$output.= $gal_images;
			  $output.= '</div>';
			}

			if($type !== 'carousel'){
				$output .= '<div id="cesis_gallery_'.$id.'" class="cesis_isotope_container  '.$el_class.' '.$responsive_options.'" '.$margin_settings.'>';
				$output .= '<div class="cesis_gallery_ctn  cesis_'.$type.' cesis_isotope col_'.$col.' '.$effect.' '.$responsive_options.'" style="margin-left:-'.$new_padding.'px; margin-right:-'.$new_padding.'px;" data-layout="'.$layout.'">';
				$output.= $gal_images;
			  $output.= '</div>';
			  $output.= '</div>';
			}

			echo $output;
			$output_string = ob_get_contents();
			ob_end_clean();
			return $output_string;

		}
	}
}

?>
