<?php

// INCLUDE THIS BEFORE you load your ReduxFramework object config file.


// You may replace $redux_opt_name with a string if you wish. If you do so, change loader.php
// as well as all the instances below.
$redux_opt_name = "cesis_data";


/************************************************************************
* Extended Example:
* Way to set menu, import revolution slider, and set home page.
*************************************************************************/
if ( !function_exists( 'wbc_extended_example' ) ) {
	function wbc_extended_example( $demo_active_import , $demo_directory_path ) {
		reset( $demo_active_import );
		$current_key = key( $demo_active_import );


		/************************************************************************
		* Import slider(s) for the current demo being imported
		************************************************************************/
if ( class_exists( 'RevSlider' ) ) {
    $wbc_sliders_array = array(
        'Classic' => array('showcase.zip','galaxy.zip','apollo.zip','athena.zip','demeter.zip'),
    );

    if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_sliders_array ) ) {
        $wbc_slider_import = $wbc_sliders_array[$demo_active_import[$current_key]['directory']];

        if( is_array( $wbc_slider_import ) ){
            foreach ($wbc_slider_import as $slider_zip) {
                if ( !empty($slider_zip) && file_exists( $demo_directory_path.$slider_zip ) ) {
                    $slider = new RevSlider();
                    $slider->importSliderFromPost( true, true, $demo_directory_path.$slider_zip );
                }
            }
        }else{
            if ( file_exists( $demo_directory_path.$wbc_slider_import ) ) {
                $slider = new RevSlider();
                $slider->importSliderFromPost( true, true, $demo_directory_path.$wbc_slider_import );
            }
        }
    }
}


		/************************************************************************
		* Setting Menus
		*************************************************************************/
		// Coffee
		$wbc_menu_array = array( 'Coffee' );
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'Coffee Main Menu', 'nav_menu' );
			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main-menu' => $main_menu->term_id,
						'mobile-menu'  => $main_menu->term_id
					)
				);
			}
		}
		// Architecture
		$wbc_menu_array = array( 'Architecture' );
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'Architecture', 'nav_menu' );
			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main-menu' => $main_menu->term_id,
						'mobile-menu'  => $main_menu->term_id
					)
				);
			}
		}
		// Flat
		$wbc_menu_array = array( 'Flat' );
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'Flat Menu', 'nav_menu' );
			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main-menu' => $main_menu->term_id,
						'mobile-menu'  => $main_menu->term_id
					)
				);
			}
		}
		// Classic Business
		$wbc_menu_array = array( 'Classic Business' );
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'classic-business-main', 'nav_menu' );
			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main-menu' => $main_menu->term_id,
						'mobile-menu'  => $main_menu->term_id
					)
				);
			}
		}
		// Creative Agency
		$wbc_menu_array = array( 'Creative Agency' );
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'creative agency main menu', 'nav_menu' );
			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main-menu' => $main_menu->term_id,
						'mobile-menu'  => $main_menu->term_id
					)
				);
			}
		}
		// Agency
		$wbc_menu_array = array( 'Agency' );
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'Agency', 'nav_menu' );
			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main-menu' => $main_menu->term_id,
						'mobile-menu'  => $main_menu->term_id
					)
				);
			}
		}
		// Photography
		$wbc_menu_array = array( 'Photography' );
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'Photography', 'nav_menu' );
			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main-menu' => $main_menu->term_id,
						'footer-menu' => $main_menu->term_id,
						'mobile-menu'  => $main_menu->term_id
					)
				);
			}
		}
		// Business
		$wbc_menu_array = array( 'Business' );
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'Business', 'nav_menu' );
			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main-menu' => $main_menu->term_id,
						'footer-menu' => $main_menu->term_id,
						'mobile-menu'  => $main_menu->term_id
					)
				);
			}
		}
		// Modern Business
		$wbc_menu_array = array( 'Modern Business' );
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'Modern Business', 'nav_menu' );
			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main-menu' => $main_menu->term_id,
						'footer-menu' => $main_menu->term_id,
						'mobile-menu'  => $main_menu->term_id
					)
				);
			}
		}
		// Lifestyle
		$wbc_menu_array = array( 'Lifestyle' );
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'Lifestyle', 'nav_menu' );
			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main-menu' => $main_menu->term_id,
						'footer-menu' => $main_menu->term_id,
						'mobile-menu'  => $main_menu->term_id
					)
				);
			}
		}
		// Careers
		$wbc_menu_array = array( 'Careers' );
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'Careers', 'nav_menu' );
			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main-menu' => $main_menu->term_id,
						'footer-menu' => $main_menu->term_id,
						'mobile-menu'  => $main_menu->term_id
					)
				);
			}
		}
		// Fashion
		$wbc_menu_array = array( 'Fashion' );
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'Fashion', 'nav_menu' );
			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main-menu' => $main_menu->term_id,
						'footer-menu' => $main_menu->term_id,
						'mobile-menu'  => $main_menu->term_id
					)
				);
			}
		}
		// Classic
		$wbc_menu_array = array( 'Classic' );
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && in_array( $demo_active_import[$current_key]['directory'], $wbc_menu_array ) ) {
			$main_menu = get_term_by( 'name', 'Main menu', 'nav_menu' );
			if ( isset( $main_menu->term_id ) ) {
				set_theme_mod( 'nav_menu_locations', array(
						'main-menu' => $main_menu->term_id,
						'footer-menu' => $main_menu->term_id,
						'mobile-menu'  => $main_menu->term_id
					)
				);
			}
		}
		/************************************************************************
		* Set HomePage
		*************************************************************************/
		// array of demos/homepages to check/select from
		$wbc_home_pages = array(
			'Agency' => 'Agency Home',
			'Photography' => 'Photography Home',
			'Business' => 'Business Home',
			'Lifestyle' => 'Lifestyle Home',
			'Careers' => 'Careers Home',
			'Fashion' => 'Fashion Home',
			'Classic' => 'Agency 02',
			'Creative Agency' => 'Creative Agency - Home',
			'Flat' => 'Cesis Flat - Home',
			'Modern Business' => 'Modern Business - Home',
			'Coffee' => 'Coffee - Home',
			'Architecture' => 'Architecture - Home',
			'Classic Business' => 'Classic Business - Home',
		);
		if ( isset( $demo_active_import[$current_key]['directory'] ) && !empty( $demo_active_import[$current_key]['directory'] ) && array_key_exists( $demo_active_import[$current_key]['directory'], $wbc_home_pages ) ) {
			$page = get_page_by_title( $wbc_home_pages[$demo_active_import[$current_key]['directory']] );
			if ( isset( $page->ID ) ) {
				update_option( 'page_on_front', $page->ID );
				update_option( 'show_on_front', 'page' );
			}
		}
	}
	add_action( 'wbc_importer_after_content_import', 'wbc_extended_example', 10, 2 );
}


if (!function_exists("redux_add_metaboxes")):
    function redux_add_metaboxes($metaboxes)
    {


    if ( class_exists( 'RevSlider' ) ) {
      $rev_slider = new RevSlider();
      $rev_sliders = $rev_slider->getArrSlidersShort();
      $rev_sliders[0] = 'Select a slider';
    } else {
      $rev_sliders = array();
    }
    if(class_exists('LS_Config')) {
    		global $wpdb;
    		$layerslider_array[0] = 'Select a slider';
    		// Table name
    		$table_name = $wpdb->prefix . "layerslider";

    		// Get sliders
    		$sliders = $wpdb->get_results( "SELECT * FROM $table_name
    											WHERE flag_hidden = '0' AND flag_deleted = '0'
    											ORDER BY date_c ASC" );

    		if(!empty($sliders)):
    		foreach($sliders as $key => $item):
    			$slides[$item->id] = array( [$item->id], [$item->name]);

    		endforeach;
    		endif;

    		if(isset($slides) && $slides){
    		foreach($slides as $key => $val){
    			$layerslider_array[$key] = 'LayerSlider #'.$val[1][0];
    		}
    		}
    }else{
      $layerslider_array = array();
    }

        $partners_box[] = array(
            'id' => 'page-tt-partner-area',
            'icon' => '',
            'fields' => array(


                array(
                    'id' => 'cesis_partner_link',
                    'type' => 'text',
                    'title' => __('Put the partner URL', 'cesis'),
                    'subtitle' => __('Put your partners URL, optional ( use http:// )', 'cesis'),
                    'validate' => 'url',
                    'default' => ''
                )


            )
        );



      $product_box[] = array(
        'title' => __('Product General Settings', 'cesis'),
        'id' => 'product-side-meta',
        'icon' => '',
        'fields' => array(
          array(
            'id' => 'cesis_meta_product_hover',
            'type' => 'button_set',
            'title' => __('Show first gallery photo on hover?', 'cesis'),
            'options' => array(
            'yes' => __('Yes', 'cesis'),
            'no' => __('No', 'cesis'),
            ),
            'default' => 'yes'
          ),
          array(
              'id' => 'cesis_meta_product_hide_description',
              'type' => 'button_set',
              'title' => __('Hide the description heading?', 'cesis'),
              'desc' => __('Usefull when creating description content with Visual composer.', 'cesis'),
              'options' => array(
              'yes' => __('Yes', 'cesis'),
              'no' => __('No', 'cesis'),
              ),
              'default' => 'no'
          ),
        )
      );



        $post_box[] = array(
            'title' => __('Post General Settings', 'cesis'),
            'id' => 'post-tt-layout',
            'desc' => __('Post General settings. Choose the style, sidebar etc...', 'cesis'),
            'icon' => '',
            'fields' => array(

                array(
                    'id' => 'cesis_meta_post_first_post_infobox',
                    'type' => 'info',
                    'desc' => __('Blog module related options.', 'cesis')
                ),
                array(
                    'id' => 'cesis_post_link',
                    'type' => 'text',
                    'title' => __('Post custom URL / Link', 'cesis'),
                    'subtitle' => __('If you want the post to be link to an external page put the URL you want use in this field, optional ( use http:// )', 'cesis'),
                    'validate' => 'url',
                    'default' => ''
                ),
                array(
                    'id' => 'cesis_post_unique_color',
                    'type' => 'color',
                    'title' => __('Post Unique Color', 'cesis'),
                    'subtitle' => __('Color that will be used in some blog module.', 'cesis'),
                    'default' => '#4251f4',
                    'validate' => 'color'
                ),
                array(
                    'id' => 'cesis_post_packery_size',
                    'type' => 'select',
                    'title' => __('Select the Packery thumbnail size for the post', 'cesis'),
                    'subtitle' => __('This is the thumbnail size that will be used when using the Packery blog style.', 'cesis'),
                    'options' => array(
                        'cesis_packery_squared' => 'Squared',
                        'cesis_packery_big_squared' => 'Big Squared',
                        'cesis_packery_landscape' => 'Landscape',
                        'cesis_packery_portrait' => 'Portrait'
                    ),
                    'default' => 'cesis_packery_squared'
                ),





            )
        );



                $staff_box[] = array(
                    'title' => __('Post General Settings', 'cesis'),
                    'id' => 'post-staff-tt-layout',
                    'desc' => __('Post General settings. Choose the style, sidebar etc...', 'cesis'),
                    'icon' => '',
                    'fields' => array(

                        array(
                            'id' => 'cesis_meta_post_first_post_infobox',
                            'type' => 'info',
                            'desc' => __('Staff module related options.', 'cesis')
                        ),
                        array(
                            'id' => 'cesis_member_position',
                            'type' => 'text',
                            'title' => __('Member position ( CEO, Co-Funder etc )', 'cesis'),
                            'subtitle' => __('Enter the member position / rank', 'cesis'),
                            'validate' => 'html',
                            'default' => ''
                        ),

		                    array(
		                        'id' => 'cesis_member_description',
		                        'type' => 'editor',
		                        'title' => __('Member description', 'cesis'),
		                        'subtitle' => __('Will appear in the auto generated part of the single page (optional)', 'cesis'),
		                        'default' => ''
		                    ),
                        array(
                            'id' => 'cesis_post_link',
                            'type' => 'text',
                            'title' => __('Post custom URL', 'cesis'),
                            'subtitle' => __('If you want the post to be link to an external page put the URL you want use in this field, optional ( use http:// )', 'cesis'),
                            'validate' => 'url',
                            'default' => ''
                        ),
                        array(
                            'id' => 'cesis_post_packery_size',
                            'type' => 'select',
                            'title' => __('Select the Packery thumbnail size for the post', 'cesis'),
                            'subtitle' => __('This is the thumbnail size that will be used when using the Packery style.', 'cesis'),
                            'options' => array(
                                'cesis_packery_squared' => 'Squared',
                                'cesis_packery_big_squared' => 'Big Squared',
                            ),
                            'default' => 'cesis_packery_squared'
                        ),
                        array(
                    'id' => 'cesis_staff_social',
                    'type' => 'dev_iconselect', // field type
                    'title' => '', // here you can set the title
                    'output' => true, // Optional if you want to enqueue your [icon_link_url] to front end
                    'options' => array(
                       'suffix' => 'fa', // Example Font Awesome fa fa-facebook
                       'prefix' => 'fa-', // Example Font Awesome fa-facebook
                       'color' => '#636363', // Default Color of icons
                       'hover' => '#FFF', // Default icon hover color
                       'background' => 'transparent', // Default Background Color of Icon
                       'background-hover' => 'transparent', // Default Background Hover of icon
                       'url' => '#', // Default link url
                       'title' => __('Select the Social Icons', 'cesis'),
                       'subtitle' => __('Select the social icons for the staff ( you can drag and drop clicking the icon part ).', 'cesis'),
                       'icon_link' => '', // Example get_template_directory().'/assets/font-awesome/font-awesome-social.css' or don't use this options will give default social icons
                       'icon_link_url' => ''  // Example get_template_directory_uri().'/assets/font-awesome/font-awesome-social.css' or don't use this options will give default social icons
                     ),
                     'default' => array(
                           'fa-twitter' => array(
                                   'font-id'           => 4, // this is order id of icon important to be same order id
                                   'font-class'        => 'dev-social-icon',
                                   'font-suffix'       => 'fa',
                                   'font-icon'         => 'fa-twitter',
                                   'font-title'        => 'Twitter',
                                   'font-url'          => '#',
                                   'font-enable'       => 'true'
                           ),
                          'fa-linkedin' => array(
                                   'font-id'           => 12,
                                   'font-class'        => 'dev-social-icon',
                                   'font-suffix'       => 'fa',
                                   'font-icon'         => 'fa-linkedin',
                                   'font-title'        => 'Linkedin',
                                   'font-url'          => '#',
                                   'font-enable'       => 'true'
                            ),
                            'fa-facebook' => array(
                                   'font-id'           => 5,
                                   'font-class'        => 'dev-social-icon',
                                   'font-suffix'       => 'fa',
                                   'font-icon'         => 'fa-facebook',
                                   'font-title'        => 'Facebook',
                                   'font-url'          => '#',
                                   'font-enable'       => 'true'
                           ),
                           'fa-skype' => array(
                                   'font-id'           => 38,
                                   'font-class'        => 'dev-social-icon',
                                   'font-suffix'       => 'fa',
                                   'font-icon'         => 'fa-skype',
                                   'font-title'        => 'Skype',
                                   'font-url'          => '#',
                                   'font-enable'       => 'true'
                            ),
                            'fa-pinterest' => array(
                                   'font-id'           => 8,
                                   'font-class'        => 'dev-social-icon',
                                   'font-suffix'       => 'fa',
                                   'font-icon'         => 'fa-pinterest',
                                   'font-title'        => 'Pinterest',
                                   'font-url'          => '#',
                                   'font-enable'       => 'true'
                          ),
                     )

                    ),




                    )
                );


        $portfolio_box[] = array(
            'title' => __('Post General Settings', 'cesis'),
            'id' => 'portfolio-tt-layout',
            'desc' => __('Portfolio Post General settings. Choose the layout, sidebar etc...', 'cesis'),
            'icon' => '',
            'fields' => array(

                array(
                    'id' => 'cesis_meta_post_first_post_infobox',
                    'type' => 'info',
                    'desc' => __('Portfolio module related options.', 'cesis')
                ),
                array(
                    'id' => 'cesis_post_description',
                    'type' => 'editor',
                    'title' => __('Project description, can be used in portfolio module and auto generated part of single post ( optional )', 'cesis'),
                    'subtitle' => __('Project description will be used in auto generated content ( optional )', 'cesis'),
                    'default' => ''
                ),
                array(
                    'id' => 'cesis_post_link',
                    'type' => 'text',
                    'title' => __('Post custom URL', 'cesis'),
                    'subtitle' => __('If you want the post to be link to an external page put the URL you want use in this field, optional ( use http:// )', 'cesis'),
                    'validate' => 'url',
                    'default' => ''
                ),
                array(
                    'id' => 'cesis_post_unique_color',
                    'type' => 'color',
                    'title' => __('Post Unique Color', 'cesis'),
                    'subtitle' => __('Color that will be used in some portfolio module.', 'cesis'),
                    'default' => '#4251f4',
                    'validate' => 'color'
                ),
                array(
                    'id' => 'cesis_post_packery_size',
                    'type' => 'select',
                    'title' => __('Select the Packery thumbnail size for the post', 'cesis'),
                    'subtitle' => __('This is the thumbnail size that will be used when using the Packery portfolio style.', 'cesis'),
                    'options' => array(
                        'cesis_packery_squared' => 'Squared',
                        'cesis_packery_big_squared' => 'Big Squared',
                        'cesis_packery_landscape' => 'Landscape',
                        'cesis_packery_portrait' => 'Portrait'
                    ),
                    'default' => 'cesis_packery_squared'
                ),




            )
        );


        $career_box[] = array(
            'title' => __('Post General Settings', 'cesis'),
            'id' => 'career-tt-layout',
            'desc' => __('Career Post General settings.', 'cesis'),
            'icon' => '',
            'fields' => array(

                array(
                    'id' => 'cesis_meta_post_first_post_infobox',
                    'type' => 'info',
                    'desc' => __('Career positions module related options.', 'cesis')
                ),
                array(
                    'id' => 'cesis_career_description',
                    'type' => 'editor',
                    'title' => __('Career position description, will be used in the career positions module', 'cesis'),
                    'subtitle' => __('Description will be used in the module', 'cesis'),
                    'default' => ''
                ),
                array(
                    'id' => 'cesis_career_location',
                    'type' => 'text',
                    'title' => __('Location', 'cesis'),
                    'subtitle' => __('Set the career position location ( city, country name )', 'cesis'),
                    'default' => ''
                ),
                array(
                    'id' => 'cesis_career_date',
                    'type' => 'text',
                    'title' => __('Date / Time left', 'cesis'),
                    'subtitle' => __('Set the time limit for the career position location', 'cesis'),
                    'default' => ''
                ),
                array(
                    'id' => 'cesis_post_link',
                    'type' => 'text',
                    'title' => __('Post custom URL', 'cesis'),
                    'subtitle' => __('If you want the post to be link to an external page put the URL you want use in this field, optional ( use http:// )', 'cesis'),
                    'validate' => 'url',
                    'default' => ''
                ),




            )
        );

        $post_box[] = $portfolio_box[] = array(
            'title' => __('Gallery Settings', 'cesis'),
            'id' => 'post-tt-gallery',
            'desc' => __('Gallery settings.', 'cesis'),
            'icon' => '',
            'subsection' => true,
            'fields' => array(
                array(
                    'id' => 'cesis_post_gallery',
                    'type' => 'gallery',
                    'title' => __('Add/Edit Gallery', 'cesis'),
                    'subtitle' => __('Create a new Gallery to use for the Gallery post type', 'cesis'),
                    'desc' => __('This gallery will only be used if the post type is set Gallery.', 'cesis')
                ),
                array(
                'id'        => 'cesis_post_gallery_type',
                'type'      => 'select',
                'title'     => __('Select the post gallery type', 'cesis'),
                //Must provide key => value pairs for select options
                'options'   => array(
                  'carousel' => __('Carousel', 'cesis'),
                  'packery' => __('Packery', 'cesis'),
                  'stacked' => __('Stacked', 'cesis'),
                ),
                'default'   => 'carousel'
                ),

                array(
                'id' => 'cesis_post_gallery_size',
                'type' => 'select',
                'title' => __('Select the thumbnail size', 'cesis'),
                'subtitle' => __('Select the image size to used in the automatically generated content', 'cesis'),
                'required' => array(

                array('cesis_post_gallery_type','!=','packery')

                ),

                'options' => array(
                  'tn_squared' => '1:1 ( squared )',
                  'tn_rectangle_4_3' => '4:3  ( rectangle )',
                  'tn_rectangle_3_2' => '3:2  ( rectangle )',
                  'tn_landscape_16_9' => '16:9  ( landscape )',
                  'tn_landscape_4_2' => '4:2  ( landscape )',
                  'tn_landscape_21_9' => '21:9  ( landscape )',
                  'tn_portrait_3_4' => '3:4  ( portrait )',
                  'tn_portrait_2_3' => '2:3  ( portrait )',
                  'tn_portrait_9_16' => '9:16  ( portrait )',
                  'cesis_full' => 'full ( original size )'
                ),
                'default' => 'tn_squared'
              ),
            )
        );


        $post_box[] = $portfolio_box[] = array(
            'title' => __('Audio Settings', 'cesis'),
            'id' => 'post-tt-audio',
            'desc' => __('Audio settings.', 'cesis'),
            'icon' => '',
            'subsection' => true,
            'fields' => array(
                array(
                    'id' => 'cesis_post_audio_file',
                    'type' => 'text',
                    'title' => __('Audio file URL', 'cesis'),
                    'subtitle' => __('Paste the audio file url you want to use', 'cesis'),
                    'desc' => __("This need to be an URL ( starting with http or https ) Accepted audio file are : 'mp3', 'm4a', 'ogg', 'wav', 'wma'", 'cesis'),
                    'validate' => 'url'
                ),
                array(
                    'id' => 'cesis_post_audio_autoplay',
                    'type' => 'select',
                    'title' => __('Play the file automatically?', 'cesis'),
                    'subtitle' => __('Select if you want to file to be played automatically.', 'cesis'),
                    'options' => array(
                        '0' => 'No',
                        '1' => 'Yes'
                    ),
                    'default' => '0'
                ),
                array(
                    'id' => 'cesis_post_audio_loop',
                    'type' => 'select',
                    'title' => __('Loop the file?', 'cesis'),
                    'subtitle' => __('Select if you want to activate the auto loop for the file.', 'cesis'),
                    'options' => array(
                        'off' => 'No',
                        'on' => 'Yes'
                    ),
                    'default' => 'off'
                ),
                array(
                    'id' => 'cesis_post_audio_preload',
                    'type' => 'select',
                    'title' => __('Load the file when the page load?', 'cesis'),
                    'subtitle' => __('Select if you want to load the file when the page is loaded.', 'cesis'),
                    'options' => array(
                        'none' => 'No',
                        'auto' => 'Yes'
                    ),
                    'default' => 'none'
                ),
                array(
                    'id' => 'cesis_post_audio_iframe',
                    'type' => 'textarea',
                    'title' => __('Audio iframe', 'cesis'),
                    'subtitle' => __('If you want to embed music from other site ( soundcloud etc.. )', 'cesis'),
                    'desc' => __("Paste the iframe code from soundcloud or other music site.", 'cesis')
                )

            )
        );



        $post_box[] = $portfolio_box[] = array(
            'title' => __('Video Settings', 'cesis'),
            'id' => 'post-tt-video',
            'desc' => __('Video settings.', 'cesis'),
            'icon' => '',
            'subsection' => true,
            'fields' => array(
                array(
                    'id' => 'cesis_post_video_mp4',
                    'type' => 'text',
                    'title' => __('Mp4 Video file URL', 'cesis'),
                    'subtitle' => __('Paste the mp4 video file url you want to use', 'cesis'),
                    'desc' => __("This need to be a mp4 video file", 'cesis'),
                    'validate' => 'url'
                ),
                array(
                    'id' => 'cesis_post_video_m4v',
                    'type' => 'text',
                    'title' => __('M4v Video file URL', 'cesis'),
                    'subtitle' => __('Paste the m4v video file url you want to use', 'cesis'),
                    'desc' => __("This need to be a m4v video file", 'cesis'),
                    'validate' => 'url'
                ),
                array(
                    'id' => 'cesis_post_video_webm',
                    'type' => 'text',
                    'title' => __('Webm Video file URL', 'cesis'),
                    'subtitle' => __('Paste the webm video file url you want to use', 'cesis'),
                    'desc' => __("This need to be a webm video file", 'cesis'),
                    'validate' => 'url'
                ),
                array(
                    'id' => 'cesis_post_video_ogv',
                    'type' => 'text',
                    'title' => __('Ogv Video file URL', 'cesis'),
                    'subtitle' => __('Paste the Ogv video file url you want to use', 'cesis'),
                    'desc' => __("This need to be a ogv video file", 'cesis'),
                    'validate' => 'url'
                ),
                array(
                    'id' => 'cesis_post_video_wmv',
                    'type' => 'text',
                    'title' => __('Wmv Video file URL', 'cesis'),
                    'subtitle' => __('Paste the wmv video file url you want to use', 'cesis'),
                    'desc' => __("This need to be a wmv video file", 'cesis'),
                    'validate' => 'url'
                ),
                array(
                    'id' => 'cesis_post_video_flv',
                    'type' => 'text',
                    'title' => __('Flv Video file URL', 'cesis'),
                    'subtitle' => __('Paste the flv video file url you want to use', 'cesis'),
                    'desc' => __("This need to be a flv video file", 'cesis'),
                    'validate' => 'url'
                ),
                array(
                    'id' => 'cesis_post_video_autoplay',
                    'type' => 'select',
                    'title' => __('Play the file automatically?', 'cesis'),
                    'subtitle' => __('Select if you want to file to be played automatically.', 'cesis'),
                    'options' => array(
                        '0' => 'No',
                        '1' => 'Yes'
                    ),
                    'default' => '0'
                ),
                array(
                    'id' => 'cesis_post_video_loop',
                    'type' => 'select',
                    'title' => __('Loop the file?', 'cesis'),
                    'subtitle' => __('Select if you want to activate the auto loop for the file.', 'cesis'),
                    'options' => array(
                        'off' => 'No',
                        'on' => 'Yes'
                    ),
                    'default' => 'off'
                ),
                array(
                    'id' => 'cesis_post_video_preload',
                    'type' => 'select',
                    'title' => __('Load the file when the page load?', 'cesis'),
                    'subtitle' => __('Select if you want to load the file when the page is loaded.', 'cesis'),
                    'options' => array(
                        'none' => 'No',
                        'auto' => 'Yes'
                    ),
                    'default' => 'none'
                ),
                array(
                    'id' => 'cesis_post_video_iframe',
                    'type' => 'textarea',
                    'title' => __('Video iframe', 'cesis'),
                    'subtitle' => __('If you want to embed video from other site ( Youtube / Vimeo etc.. )', 'cesis'),
                    'desc' => __("Paste the iframe code from Youtube / Vimeo or other video site.", 'cesis')
                )

            )
        );

        $post_box[] = array(
            'title' => __('Quote Settings', 'cesis'),
            'id' => 'post-tt-quote',
            'desc' => __('Quote settings.', 'cesis'),
            'icon' => '',
            'subsection' => true,
            'fields' => array(
                array(
                    'id' => 'cesis_quote_text',
                    'type' => 'textarea',
                    'title' => __('Quote text', 'cesis'),
                    'subtitle' => __('Insert the Quote here', 'cesis'),
                    'desc' => __('Quote text used when the post type is set to Quote.', 'cesis')
                ),
                array(
                    'id' => 'cesis_quote_author',
                    'type' => 'text',
                    'title' => __('Quote Author', 'cesis'),
                    'subtitle' => __('Insert the Quote Author name here', 'cesis'),
                    'desc' => __('Quote author name, used when the post type is set to Quote.', 'cesis')
               ),
            )
        );

        $post_box[] = $page_box[] = $portfolio_box[] = $staff_box[] = $career_box[] = $product_box[] = array(
        'title'      => __( 'General Settings', 'cesis' ),
        'desc'       => __( 'Theme general setting ', 'cesis' ),
        'id'         => 'tt-general-settings',
        'icon'   => 'fa-general-setting',
        'fields'     => array(
            array(
                        'id'        => 'cesis_meta_custom_general_settings',
                        'type'      => 'button_set',
                        'title'     => __('Use Custom general settings?', 'cesis'),
                        'subtitle'  => __('Select if you want to use custom general settings.', 'cesis'),
                        'options' => array(
                          'yes' =>  __('Yes', 'cesis'),
                          'no' =>  __('No', 'cesis'),
                        ),
                        'default'   => 'no',
            ),
            array(
                        'id'        => 'cesis_meta_body_type',
                        'type'      => 'button_set',
                        'title'     => __('Use Boxed layout?', 'cesis'),
                        'subtitle'  => __('Select if you want to use the boxed layout.', 'cesis'),
                        'required'  => array(
                              array('cesis_meta_custom_general_settings','contains','yes'),
                        ),
                        'options' => array(
                          'cesis_body_boxed' =>  __('Yes', 'cesis'),
                          'no' =>  __('No', 'cesis'),
                        ),
                        'default'   => 'no',
            ),
            array(
                              'id'        => 'cesis_meta_body_background',
                              'type'      => 'background',
                              'title'     => __('Body Background Color / Image', 'cesis'),
                              'subtitle'  => __('Select the body background color or Image.', 'cesis'),
                              'required'  => array(
                                    array('cesis_meta_custom_general_settings','contains','yes'),
                              ),
                              'default'  => array(
                                'background-color' => '#191a1b',
                              )
            ),
            array(
                'id'       => 'cesis_meta_body_width',
                'type'     => 'text',
                'title'     => __('Select the Boxed body width', 'cesis'),
                'subtitle'  => __('Select the width of the boxed layout.', 'cesis'),
                'validate' => 'numeric',
                'required'  => array(
                      array('cesis_meta_body_type','contains','boxed'),
                ),
                'default'  => '1250'
            ),
            array(
                'id'        => 'cesis_meta_body_shadow',
                'type'      => 'button_set',
                'title'     => __('Use Shadow?', 'cesis'),
                'subtitle'  => __('Select if you want to use the shadow for the boxed body.', 'cesis'),
                'required'  => array(
                      array('cesis_meta_body_type','contains','boxed'),
                ),
                'options' => array(
                  'cesis_meta_body_shadow' =>  __('Yes', 'cesis'),
                  'no' =>  __('No', 'cesis'),
                ),
                'default'   => 'no',
            ),
            array(
              'id'        => 'cesis_meta_logo_custom_link',
              'type'     => 'button_set',
              'title'    => __('Use a custom link for the logo?', 'cesis'),
							'required'  => array(
										array('cesis_meta_custom_general_settings','contains','yes'),
							),
              'subtitle' => __('Select if you want your logo to point to a custom link instead of the home url of your site', 'cesis'),
              'options' => array(
                'no' =>  __('no', 'cesis'),
                'yes' =>  __('yes', 'cesis'),
              ),
              'default' => 'no'
            ),
            array(
              'id'       => 'cesis_meta_logo_link_url',
              'type'     => 'text',
              'required'  => array(
                array('cesis_meta_logo_custom_link','=','yes'),
              ),
              'title'    => __('Put the URL to use for the logo link', 'cesis'),
              'subtitle' => __('Put the URL to use for the logo link ( use http:// )', 'cesis'),
              'validate' => 'url',
              'default'  => ''
            ),
            array(
            	    'id'        => 'cesis_meta_logo',
                    'type'      => 'media',
					'url'      => true,
                    'title'     => __('Default Logo upload', 'cesis'),
                    'desc'      => __('Logo that will be used by default', 'cesis'),
                    'subtitle'  => __('Use big logo for retina ready display', 'cesis'),
                    'required'  => array(
                          array('cesis_meta_custom_general_settings','contains','yes'),
                    ),
					'default'  => array(
					'url'=>''
				    ),
                ),
            array(
                    'id'        => 'cesis_meta_white_logo',
                    'type'      => 'media',
					'url'      => true,
                    'title'     => __('Light Logo upload', 'cesis'),
                    'desc'      => __('Upload a logo that will be used when the header is transparent', 'cesis'),
                    'subtitle'  => __('Will be used when transparent header', 'cesis'),
                    'required'  => array(
                          array('cesis_meta_custom_general_settings','contains','yes'),
                    ),
					'default'  => array(
					'url'=>''
				    ),
                ),
            array(
                    'id'        => 'cesis_meta_logo_width',
                    'type'      => 'text',
                    'title'     => __('Logo width', 'cesis'),
                    'subtitle'  => __('Don\'t include "px" in the string. e.g. 150', 'cesis'),
                    'desc'      => __('Set your logo size, ', 'cesis'),
                    'required'  => array(
                          array('cesis_meta_custom_general_settings','contains','yes'),
                    ),
                    'validate'  => 'numeric',
                    'default'   => '120',
                ),
			array(
                    'id'        => 'cesis_meta_mobile_logo',
                    'type'      => 'media',
					'url'      => true,
                    'title'     => __('Mobile Logo upload', 'cesis'),
                    'desc'      => __('Logo used when menu switch to mobile menu', 'cesis'),
                    'subtitle'  => __('If you want to use a different logo when using the mobile menu( optional )', 'cesis'),
                    'required'  => array(
                          array('cesis_meta_custom_general_settings','contains','yes'),
                    ),
					'default'  => array(
					'url'=>''
				    ),
                ),
            array(
                    'id'        => 'cesis_meta_mobile_logo_width',
                    'type'      => 'text',
                    'title'     => __('Mobile Logo width', 'cesis'),
                    'subtitle'  => __('Don\'t include "px" in the string. e.g. 150', 'cesis'),
                    'desc'      => __('Set your logo size for the mobile header, ', 'cesis'),
                    'required'  => array(
                          array('cesis_meta_custom_general_settings','contains','yes'),
                    ),
                    'validate'  => 'numeric',
                    'default'   => '100',
                ),
        )
      );


        $post_box[] = $page_box[] = $portfolio_box[] = $staff_box[] = $career_box[] = $product_box[] = array(
          'title'  => __( 'Header Settings', 'cesis' ),
          'id'     => 'tt-meta-header',
          'desc'   => __( 'General Header settings. For more detailed options check the sub sections.', 'cesis' ),
          'icon'   => 'fa-header2 ',
          'fields'     => array(
            array(
              'id' => 'cesis_meta_general_header',
              'type' => 'button_set',
              'title' => __('Use custom settings?', 'cesis'),
              'options' => array(
              'yes' => __('Yes', 'cesis'),
              'no' => __('No', 'cesis'),
              ),
            'default' => 'no'
            ),

            array(
              'id'        => 'cesis_meta_header_width',
              'required' => array(
                array('cesis_meta_general_header','not','no')
              ),
              'type'     => 'dimensions',
              'height'     => false,
              'units'    => array('px','%'),
              'title'     => __('Select the Header container width ( px or % )', 'cesis'),
              'subtitle'  => __('Default 1170px, select 100% to have full width header.', 'cesis'),
              'default' => array(
                'width'   => '1170',
                'units' => 'px'
              ),


            ),

            array(
                         'id'        => 'cesis_meta_header_sticky',
                         'required' => array(
                           array('cesis_meta_general_header','not','no')
                         ),
                         'type'      => 'select',
                         'title'     => __('Use Sticky Header?', 'cesis'),
                         'subtitle'  => __('Select if you want to header to be fix at the top of the page when you scroll down.', 'cesis'),


                         //Must provide key => value pairs for select options
                         'options'   => array(
                             'inherit' => __('default', 'cesis'),
                             'header_sticky' => __('Yes ( Main Area only )', 'cesis'),
                             'full_header_sticky' => __('Yes ( Top Bar and Main Area )', 'cesis'),
                             'no_sticky' => __('No', 'cesis'),
                         ),
                         'default'   => 'inherit'
                     ),
                     array(
                                       'id'        => 'cesis_meta_header_sticky_hiding',
                                       'required' => array(
                                         array('cesis_meta_general_header','not','no'),
                                           array('cesis_meta_header_sticky','not','no_sticky'),
                                       ),
                                       'type'     => 'button_set',
                                       'title'     => __('Hide the header after scrolling a bit?', 'cesis'),
                                       'subtitle'  => __('Select if you want the header to hide when you scroll down and show up if scroll up.', 'cesis'),
                                       'options' => array(
                                 'inherit' => __('default', 'cesis'),
                                 'cesis_header_hiding' =>  __('Yes', 'cesis'),
                                 'no' =>  __('No', 'cesis'),
                              ),
                             'default' => 'inherit'


                         ),

                         array(
                                           'id'        => 'cesis_meta_header_shrink',
                                           'required' => array(
                                             array('cesis_meta_general_header','not','no')
                                           ),
                                           'type'     => 'button_set',
                                           'title'     => __('Shrink header when scroll down?', 'cesis'),
                                           'subtitle'  => __('Select if you want to shrink the header when you scroll down.', 'cesis'),
                                           'options' => array(
                                               'inherit' => __('default', 'cesis'),
                                     'cesis_header_shrink' =>  __('Yes', 'cesis'),
                                     'no' =>  __('No', 'cesis'),
                                  ),
                                 'default' => 'inherit'


                             ),
                             array(
                               'id'       => 'cesis_meta_header_shrink_height',
                               'required'  => array(
                                     array('cesis_meta_header_shrink','not','no'),
                               ),
                               'type'     => 'slider',
                               'title'    => __('Shrinked Header height.', 'cesis'),
                               'subtitle' => __('Select the Shrinked Header height', 'cesis'),
                               'default' => '60',
                               'min' => 20,
                               'step' => 1,
                               'max' => 300,
                               'display_value' => 'text',
                             ),

                                                     array(
                                                                       'id'        => 'cesis_meta_header_shadow',
                                                                       'required' => array(
                                                                         array('cesis_meta_general_header','not','no')
                                                                       ),
                                                                       'type'     => 'button_set',
                                                                       'title'     => __('Add shadow to the Header?', 'cesis'),
                                                                       'subtitle'  => __('Select if you want to add Shadow effect to the header container.', 'cesis'),
                                                                       'options' => array(
                                                                           'inherit' => __('default', 'cesis'),
                                                                 'cesis_meta_header_shadow' =>  __('Yes', 'cesis'),
                                                                 'no_shadow' =>  __('No', 'cesis'),
                                                              ),
                                                             'default' => 'inherit'


                                                       ),

      array(
            'id'        => 'cesis_meta_header_transparent',
            'required' => array(
              array('cesis_meta_general_header','not','no')
            ),
            'type'      => 'button_set',
            'title'     => __('Use Transparent Header?', 'cesis'),
            'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
            'options' => array(
              'inherit' => __('default', 'cesis'),
              'cesis_transparent_header' =>  __('Yes', 'cesis'),
              'cesis_opaque_header' => __('No', 'cesis'),
            ),
            'default' => 'inherit'
        ),
       array(
                     'id'        => 'cesis_meta_transparent_header_bg_color',
                     'required' => array(
                       array('cesis_meta_header_transparent','not','cesis_opaque_header')
                     ),
                     'type'      => 'color_rgba',
                     'title'     => __('Transparent Header Background Color', 'cesis'),
                     'subtitle'  => __('Pick a background color for the transparent Header ( use transparent color ).', 'cesis'),
                     'default'   => array(
                       'color'     => '#ffffff',
                       'alpha'     => '0'
                     ),
       						'options'       => array(
       					        'clickout_fires_change'     => true,
       						),
                   ),
       array(
                     'id'        => 'cesis_meta_transparent_header_border_color',
                     'required' => array(
                       array('cesis_meta_header_transparent','not','cesis_opaque_header')
                     ),
                     'type'      => 'color_rgba',
                     'title'     => __('Transparent Header border Color', 'cesis'),
                     'subtitle'  => __('Pick a color for the transparent Header border.', 'cesis'),
                     'default'   => array(
                       'color'     => '#ffffff',
                       'alpha'     => '0'
                     ),
       						'options'       => array(
       					        'clickout_fires_change'     => true,
       						),
                 ),

                 array(
                   'id'        => 'cesis_meta_transparent_header_color',
                   'required' => array(
                     array('cesis_meta_header_transparent','not','cesis_opaque_header')
                   ),
                   'type'      => 'color_rgba',
                   'title'     => __('Transparent Header text, seperator Color', 'cesis'),
                   'subtitle'  => __('Pick a color for the transparent Header text color.', 'cesis'),
                   'default'   => array(
                     'color'     => '#ffffff',
                     'alpha'     => '1'
                   ),
     						'options'       => array(
     					        'clickout_fires_change'     => true,
     						),
                 ),
                 array(
                   'id'        => 'cesis_meta_transparent_header_active_color',
                   'required' => array(
                     array('cesis_meta_header_transparent','not','cesis_opaque_header')
                   ),
                   'type'      => 'color_rgba',
                   'title'     => __('Transparent Header accent Color', 'cesis'),
                   'subtitle'  => __('Pick a color for the transparent Header active / hover element.', 'cesis'),
                   'default'   => array(
                     'color'     => '#ffffff',
                     'alpha'     => '0.85'
                   ),
     						'options'       => array(
     					        'clickout_fires_change'     => true,
     						),
                 ),


          )
        );


                $post_box[] = $page_box[] = $portfolio_box[] = $staff_box[] = $career_box[] = $product_box[] = array(
                  'title'  => __( 'Header Top Bar', 'cesis' ),
                  'id'     => 'tt-meta-header-topbar',
                  'desc'   => __( 'All the settings for the Header Top Bar, For full documentation on this field, visit: ', 'cesis' ),
                  'subsection' => true,
                  'fields'     => array(

                    array(
                      'id' => 'cesis_meta_topbar',
                      'type' => 'button_set',
                      'title' => __('Display the Header Top Bar?', 'cesis'),
                      'options' => array(
                        'inherit' => __('default', 'cesis'),
                        'yes' => __('Yes', 'cesis'),
                        'no' => __('No', 'cesis'),
                      ),
                    'default' => 'inherit'
                    ),

                    array(
                      'id' => 'cesis_meta_custom_topbar',
                      'required' => array(
                        array('cesis_meta_topbar','not','no')
                      ),
                      'type' => 'button_set',
                      'title' => __('Use custom settings?', 'cesis'),
                      'options' => array(
                      'yes' => __('Yes', 'cesis'),
                      'no' => __('No', 'cesis'),
                      ),
                    'default' => 'no'
                    ),
                      array(
                        'id'       => 'cesis_meta_top_bar_breakpoint',
                        'required' => array(
                          array('cesis_meta_topbar','not','no')
                        ),
                        'type'     => 'text',
                        'title'     => __('Top bar Breakpoint', 'cesis'),
                        'subtitle'  => __('Select the window size you want the Top bar to be hidden.', 'cesis'),
                        'validate' => 'numeric',
                        'default'  => '978'
                      ),

                    array(
                  				'id'       => 'cesis_meta_top_bar_height',
                          'required' => array(
                            array('cesis_meta_custom_topbar','not','no')
                          ),
                  				'type'     => 'slider',
                  				'title'    => __('Header Top bar height.', 'cesis'),
                  				'subtitle' => __('Select the Top bar height', 'cesis'),

              					'default' => '40',
              					'min' => 20,
              				    'step' => 1,
              				    'max' => 100,
              				    'display_value' => 'text',
              				),
                    array(
                                      'id'        => 'cesis_meta_top_bar_bg_color',
                                      'required' => array(
                                        array('cesis_meta_custom_topbar','not','no')
                                      ),
                                      'type'      => 'color',
                                      'title'     => __('Top bar Background Color', 'cesis'),
                                      'subtitle'  => __('Background color of the Top bar.', 'cesis'),
                                      'default'   => '#ffffff',
                                      'validate'  => 'color',
                                    ),
                    array(
                      'id'        => 'cesis_meta_top_bar_border_color',
                      'required' => array(
                        array('cesis_meta_custom_topbar','not','no')
                      ),
                      'type'      => 'color',
                      'title'     => __('Top bar Border Color', 'cesis'),
                      'subtitle'  => __('Border color of the Top bar.', 'cesis'),
                      'default'   => '#ebebeb',
                      'validate'  => 'color',
                      ),
                    array(
                                      'id'        => 'cesis_meta_top_bar_text_color',
                                      'required' => array(
                                        array('cesis_meta_custom_topbar','not','no')
                                      ),
                                      'type'      => 'color',
                                      'title'     => __('Top bar Text Color', 'cesis'),
                                      'subtitle'  => __('Text Color of the Top bar.', 'cesis'),
                                      'default'   => '#bababa',
                                      'validate'  => 'color',
                                  ),
                    array(
                                      'id'        => 'cesis_meta_top_bar_hl_color',
                                      'required' => array(
                                        array('cesis_meta_custom_topbar','not','no')
                                      ),
                                      'type'      => 'color',
                                      'title'     => __('Top bar highlight color', 'cesis'),
                                      'subtitle'  => __('Highlight color of the Top bar.', 'cesis'),
                                      'default'   => '#6d7783',
                                      'validate'  => 'color',
                                  ),
                    array(
                                      'id'        => 'cesis_meta_top_bar_hover_color',
                                      'required' => array(
                                        array('cesis_meta_custom_topbar','not','no')
                                      ),
                                      'type'      => 'color',
                                      'title'     => __('Top bar hover color', 'cesis'),
                                      'subtitle'  => __('Hover color of the Top bar.', 'cesis'),
                                      'default'   => '#293340',
                                      'validate'  => 'color',
                                  ),
                    array(
                            'id'      => 'cesis_top_bar_sorter_meta',
                            'required' => array(
                              array('cesis_meta_custom_topbar','not','no')
                            ),
                            'type'    => 'sorter',
                            'title'   => 'Top Bar layout manager',
                            'desc'    => 'Organize how you want the layout to appear on the Header Top Area',
                            'options' => array(
                                'left'  => array(
                                ),
                               'right' => array(
                                ),
                               'disabled' => array(
                                    'tb_phone' => __('Phone', 'cesis'),
                                    'tb_mail'     => __('Email', 'cesis'),
                                    'tb_text' => __('Text', 'cesis'),
                                    'tb_social_icons'   => __('Social Icons', 'cesis'),
                                    'tb_search'   => __('Search Icon', 'cesis'),
                                    'tb_menu'   => __('Top bar Menu', 'cesis'),
                                    'tb_cart'   => __('Cart', 'cesis'),
                                    'tb_notifications'   => __('Buddypress Notifications', 'cesis'),
                            ),
                            ),
                        ),
                        array(
                              'id'          => 'cesis_meta_top_bar_menu_font',
                              'required' => array(
                                array('cesis_meta_custom_topbar','not','no')
                              ),
                                'type'        => 'typography',
                                          'title'     => __('Top Bar menu font', 'cesis'),
                                          'subtitle'  => __('Choose the Top bar menu / buddyress notifications font.', 'cesis'),
                                'google'      => true,
                                'font-backup' => true,
                                'color' => false,
                                'units'       =>'px',
                              'line-height' => false,
                              'text-align' => false,
                              'letter-spacing' => true,
                              'text-transform' => true,
                                'default'     => array(
                                    'font-weight'  => '400',
                                    'google'      => true,
                                    'font-size'   => '14px',
                                'letter-spacing' => '0px',
                                'text-transform' => 'none',
                                ),
                          ),

                                  array(
                                      'id'       => 'cesis_meta_top_bar_menu_space',
                                      'required' => array(
                                        array('cesis_meta_custom_topbar','not','no')
                                      ),
                                      'type'     => 'slider',
                                      'title'    => __('Menu Items Space.', 'cesis'),
                                      'subtitle' => __('Set the space between menu items', 'cesis'),
                                    'default' => '10',
                                    'min' => 1,
                                      'step' => 1,
                                      'max' => 30,
                                      'display_value' => 'text',
                                  ),
											  array(
                          'id'       => 'cesis_meta_top_bar_text_size',
													'required' => array(
														array('cesis_meta_custom_topbar','not','no')
													),
                          'type'     => 'slider',
                          'title'    => __('Top bar text elements size.', 'cesis'),
                          'subtitle' => __('Set the top bar text elements text size', 'cesis'),
                          'default' => '13',
                          'min' => 1,
                          'step' => 1,
                          'max' => 50,
                          'display_value' => 'text',
                        ),
                      array(
                          'id'       => 'cesis_meta_top_bar_phone',
                          'required' => array(
                            array('cesis_meta_custom_topbar','not','no')
                          ),
                          'type'     => 'text',
                          'title'    => __('Phone number', 'cesis'),
                          'subtitle' => __('Enter your phone number. ', 'cesis'),
                          'default'  => '<a href="tel:5555555555">Call us: 475-885-545</a>'
                    ),

                      array(
                          'id'       => 'cesis_meta_top_bar_email',
                          'required' => array(
                            array('cesis_meta_custom_topbar','not','no')
                          ),
                          'type'     => 'text',
                          'title'    => __('Email', 'cesis'),
                          'subtitle' => __('Enter your mail address', 'cesis'),
                          'default'  => 'cesis.support@gmail.com'
                    ),

                      array(
                          'id'       => 'cesis_meta_top_bar_text',
                          'required' => array(
                            array('cesis_meta_custom_topbar','not','no')
                          ),
                          'type'     => 'editor',
                          'title'    => __('Custom Text', 'cesis'),
                          'subtitle' => __('You can put text / html in this field, will be used if selected in the sorter ', 'cesis'),
                          'default'  => '<strong>Latest news:</strong> Cesis is the Best Theme on <a href="#">Themeforest</a>'
                    ),

                      array(
                          'id'        => 'cesis_meta_top_bar_notifications_style',
                          'required' => array(
                            array('cesis_meta_custom_topbar','not','no')
                          ),
                          'type'      => 'select',
                          'title'     => __('Select the Buddypress notifications style', 'cesis'),
                                      'options'   => array(
                                          'i' =>  __('Icons only', 'cesis'),
                                          'ti' =>  __('Text and Icons', 'cesis'),
                                          't' =>  __('Text only', 'cesis'),
                                      ),
                          'default'   => 'ti'
                      ),
                  )
                );



                        $post_box[] = $page_box[] = $portfolio_box[] = $staff_box[] = $career_box[] = $product_box[] = array(
                          'title'  => __( 'Header Main Area', 'cesis' ),
                          'id'     => 'tt-meta-header-mainarea',
                          'desc'   => __( 'All the settings for the Header Main Area ( Logo, Main Menu )For full documentation on this field, visit: ', 'cesis' ),

                          'subsection' => true,
                          'fields'     => array(

                            array(
                              'id' => 'cesis_meta_header',
                              'type' => 'button_set',
                              'title'     => __('Display the Header?', 'cesis'),
                              'subtitle'  => __('Select yes If you want to show the header.', 'cesis'),
                              'options' => array(
                                'inherit' => __('default', 'cesis'),
                                'yes' => __('Yes', 'cesis'),
                                'no' => __('No', 'cesis'),
                              ),
                            'default' => 'inherit'
                            ),


                              array(
                                            'id'        => 'cesis_meta_header_menu',
                                            'required' => array(
                                              array('cesis_meta_header','not','no')
                                            ),
                                            'type'      => 'select',
                                            'title'     => __('Custom Main menu ( optional )', 'cesis'),
                                            'subtitle'  => __('Select if you want to use a custom menu for the "Main menu".', 'cesis'),


                                            //Must provide key => value pairs for select options
                                            'data'   => "menus",
                                            'default'   => ''
                              ),

                            array(
                              'id' => 'cesis_meta_custom_header',
                              'required' => array(
                                array('cesis_meta_header','not','no')
                              ),
                              'type' => 'button_set',
                              'title' => __('Use custom settings?', 'cesis'),
                              'options' => array(
                              'yes' => __('Yes', 'cesis'),
                              'no' => __('No', 'cesis'),
                              ),
                            'default' => 'no'
                            ),

                            array(
                                              'id'        => 'tt-meta-notice-info-header',
                                              'required' => array(
                                                array('cesis_meta_custom_header','not','no')
                                              ),
                                              'type'      => 'info',
                      						            'icon' => 'el-icon-info-sign',
                                              'title'     => __('HEADER SETTINGS.', 'cesis'),
                                              'desc'      => __('Below you will find the options for the header layout, logo position, background color etc..', 'cesis')
                                      ),

                                      array(
                                        'id'        => 'cesis_meta_header_layout',
                                        'required' => array(
                                          array('cesis_meta_custom_header','not','no')
                                        ),
                                        'type'      => 'select',
                                        'title'     => __('Select the Header layout', 'cesis'),
                                        'subtitle'  => __('Select if you want the header and menu layout', 'cesis'),

                                        'options'   => array(
                                          'one_line_header' => __('Horizontal one line', 'cesis'),
                                          'two_line_header' => __('Horizontal two lines', 'cesis'),
                                          'vertical_header' => __('Vertical header', 'cesis'),
                                          'vertical_offcanvas_header_b' => __('Offcanvas header', 'cesis'),
                                          'overlay_header_b' => __('Overlay header', 'cesis'),
                                        ),
                                        'default'   => 'one_line_header'
                                      ),

                                  					array(
                                                          'id'        => 'cesis_meta_header_bg_color',
                                                          'required' => array(
                                                            array('cesis_meta_custom_header','not','no')
                                                          ),
                                                          'type'      => 'color',
                                                          'title'     => __('Header Background Color', 'cesis'),
                                                          'subtitle'  => __('Pick a background color for the Header (default: #ffffff).', 'cesis'),
                                                          'default'   => '#ffffff',
                                                          'validate'  => 'color',
                                                      ),
                      array(
                        'id'        => 'cesis_meta_header_border_color',
                        'required' => array(
                          array('cesis_meta_custom_header','not','no')
                        ),
                        'type'      => 'color_rgba',
                        'title'     => __('Header border Color', 'cesis'),
                        'subtitle'  => __('Pick a color for the main Header bottom border.', 'cesis'),
                        'default'   => array(
                          'color'     => '#ebebeb',
                          'alpha'     => '0.5'
                        ),
          						'options'       => array(
          					        'clickout_fires_change'     => true,
          						),
                      ),


                      array(
                      'id'        => 'cesis_meta_header_openmenu_color',
                      'type'      => 'color',
                      'title'     => __('Open Menu button Color', 'cesis'),
                      'subtitle'  => __('Pick a color for the open menu button (default: #ffffff).', 'cesis'),
                      'required'  => array(
                              array('cesis_meta_header_layout','contains','header_b'),
                              array('cesis_meta_custom_header','not','no'),

                        ),
                      'default'   => '#6d7783',
                      'validate'  => 'color',
                      ),


                      array(
                        'id'        => 'cesis_meta_overlay_bg_color',
                        'type'      => 'color_rgba',
                        'title'     => __('Overlay background Color', 'cesis'),
                        'subtitle'  => __('Pick a color for the main Overlay background.', 'cesis'),
                        'required'  => array(
                                array('cesis_meta_header_layout','contains','overlay_header_b'),
                                array('cesis_meta_custom_header','not','no')
                          ),
                        'default'   => array(
                          'color'     => '#232323',
                          'alpha'     => '0.9'
                        ),
          						'options'       => array(
          					        'clickout_fires_change'     => true,
          						),
                      ),
                      			array(
                          				'id'       => 'cesis_meta_header_height',
                          				'type'     => 'slider',
                          				'title'    => __('Header height.', 'cesis'),
                          				'subtitle' => __('Select the header height', 'cesis'),
                                  'required'  => array(
                                        array('cesis_meta_header_layout','not_contain','vertical_header'),
                                        array('cesis_meta_custom_header','not','no')
                                  ),
                      					'default' => '90',
                      					'min' => 20,
                      				    'step' => 1,
                      				    'max' => 300,
                      				    'display_value' => 'text',
                      				),

                              array(
                                'id'        => 'cesis_meta_header_sub_bg_color',
                                'type'      => 'color',
                                'title'     => __('Second Line background Color', 'cesis'),
                                'subtitle'  => __('Pick a background color for the Header second line (default: #ffffff).', 'cesis'),
                                'required'  => array(
                                  array('cesis_meta_header_layout', '=', 'two_line_header'),
                                  array('cesis_meta_custom_header','not','no')
                                ),
                                'default'   => '#ffffff',
                                'validate'  => 'color',
                              ),
                                                array(
                                                  'id'        => 'cesis_meta_header_sub_border_color',
                                                  'type'      => 'color_rgba',
                                                  'title'     => __('Second line border Color', 'cesis'),
                                                  'subtitle'  => __('Pick a color for the Header second line bottom border.', 'cesis'),
                                                  'required'  => array(
                                                    array('cesis_meta_header_layout', '=', 'two_line_header'),
                                                    array('cesis_meta_custom_header','not','no')
                                                  ),
                                                  'default'   => array(
                                                    'color'     => '#ebebeb',
                                                    'alpha'     => '0.5'
                                                  ),
                                    						'options'       => array(
                                    					        'clickout_fires_change'     => true,
                                    						),
                                                ),
                              array(
                                'id'       => 'cesis_meta_header_sub_height',
                                'type'     => 'slider',
                                'title'    => __('Second line height.', 'cesis'),
                                'subtitle' => __('Select the second line height', 'cesis'),
                                'default' => '50',
                                'required'  => array(
                                  array('cesis_meta_header_layout', '=', 'two_line_header'),
                                  array('cesis_meta_custom_header','not','no')
                                ),
                                'min' => 20,
                                'step' => 1,
                                'max' => 300,
                                'display_value' => 'text',
                              ),

                              array(
                                'id'        => 'cesis_meta_header_offcanvas_bg_color',
                                'type'      => 'color',
                                'title'     => __('Offcanvas Background Color', 'cesis'),
                                'subtitle'  => __('Pick a background color for Offcanvas part of the Header (default: #ffffff).', 'cesis'),
                                'required'  => array(
                                  array('cesis_meta_header_layout','contains','offcanvas'),
                                  array('cesis_meta_custom_header','not','no')
                                ),
                                'default'   => '#ffffff',
                                'validate'  => 'color',
                              ),
                      array(
                          'id'       => 'cesis_meta_header_v_width',
                          'type'     => 'slider',
                          'title'    => __('Vertical / Offcanvas Header Width.', 'cesis'),
                          'subtitle' => __('Select the Vertical / Offcanvas header width', 'cesis'),
                          'required'  => array(
                                array('cesis_meta_header_layout','contains','vertical'),
                                array('cesis_meta_custom_header','not','no'),
                          ),
                        'default' => '260',
                        'min' => 20,
                          'step' => 1,
                          'max' => 350,
                          'display_value' => 'text',
                      ),
                      array(
                      'id'       => 'cesis_meta_header_v_pos',
                      'type'     => 'button_set',
                      'title'    => __('Vertical / Offcanvas Header Position.', 'cesis'),
                      'subtitle' => __('Select the position for the header', 'cesis'),
                      'required'  => array(
                            array('cesis_meta_header_layout','contains','vertical'),
                            array('cesis_meta_custom_header','not','no'),
                      ),
                      'options' => array(
                          'header_v_pos_left' => __('Left', 'cesis'),
                          'header_v_pos_right' => __('Right', 'cesis'),
                       ),
                      'default' => 'header_v_pos_left'
                      ),

                              array(
                              'id'       => 'cesis_meta_header_v_content',
                              'type'     => 'button_set',
                              'title'    => __('Vertical / Offcanvas header content Position.', 'cesis'),
                              'subtitle' => __('Select the vertical / offcanvas header content position', 'cesis'),
                              'required'  => array(
                                    array('cesis_meta_header_layout','contains','vertical'),
                                    array('cesis_meta_custom_header','not','no'),
                              ),
                              'options' => array(
                                  'header_v_c_left' => __('Left', 'cesis'),
                                  'header_v_c_right' => __('Right', 'cesis'),
                                  'header_v_c_center' => __('Center', 'cesis'),
                               ),
                              'default' => 'header_v_c_left'
                          ),
                           array(
                            'id'       => 'cesis_meta_header_v_content_ypos',
                            'type'     => 'button_set',
                            'title'    => __('Vertical header content Y Position.', 'cesis'),
                            'subtitle' => __('Select the vertical header content Y position ( on top, or justified )', 'cesis'),
                            'required'  => array(
                                  array('cesis_meta_header_layout','contains','vertical_header'),
                                  array('cesis_meta_custom_header','not','no'),
                            ),
                            'options' => array(
                                'header_v_cy_top' => __('At the Top', 'cesis'),
                                'header_v_cy_justify' => __('Justified', 'cesis'),
                             ),
                            'default' => 'header_v_cy_top'
                        ),

                          array(
                          'id'       => 'cesis_meta_logo_pos',
                          'type'     => 'button_set',
                          'title'    => __('Logo Position.', 'cesis'),
                          'subtitle' => __('Select the logo position for the header', 'cesis'),
                          'required'  => array(
                                array('cesis_meta_header_layout','not_contain','vertical'),
                                array('cesis_meta_custom_header','not','no'),
                          ),
                          'options' => array(
                              'logo_left' => __('Left', 'cesis'),
                              'logo_right' => __('Right', 'cesis'),
                              'logo_center' => __('Center', 'cesis'),
                           ),
                          'default' => 'logo_left'
                          ),

                      				array(
                                              'id'        => 'tt-notice-info-menu',
                                              'required' => array(
                                                array('cesis_meta_custom_header','not','no')
                                              ),
                                              'type'      => 'info',
                      						'icon' => 'el-icon-info-sign',
                                              'title'     => __('MENU / NAVIGATION SETTINGS.', 'cesis'),
                                              'desc'      => __('Set the options related to the menu / navigation.', 'cesis')
                                      ),

											        array(
											          'id'       => 'cesis_meta_menu_dda',
											          'type'     => 'button_set',
											          'title'    => __('Add a dropdown arrow for if menu has sub menu ?', 'cesis'),
											          'subtitle' => __('Select if you want to add a dropdown arrow if the menu item has a sub menu.', 'cesis'),
																'required'  => array(
																			array('cesis_meta_custom_header','not','no'),
																),
											          'options' => array(
											        	   'yes' =>  __('Yes', 'cesis'),
											        		 'no' =>  __('no', 'cesis'),
											           ),
											        	  'default' => 'no'
											        ),
                      				array(
                                              'id'        => 'cesis_meta_menu_type',
                                              'type'      => 'select',
                                              'title'     => __('Select the Menu Style', 'cesis'),
                                              'subtitle'  => __('Select the main Menu Design type', 'cesis'),
                                              'required'  => array(
                                                    array('cesis_meta_header_layout','contains','line'),
                                                    array('cesis_meta_custom_header','not','no'),
                                              ),
                                              'options'   => array(
                                                  'nav_normal' => __('Normal', 'cesis'),
                      							'nav_separator' => __('With "/" separator', 'cesis'),
                      							'nav_line_separator' => __('With Line separator', 'cesis'),
                      							'nav_top_borderx' => __('With Top Border', 'cesis'),
                      							'nav_bottom_borderx' => __('With Bottom Border', 'cesis'),
                      							'nav_boxed_border' => __('Boxed', 'cesis'),
                                              ),
                                              'default'   => 'nav_normal'
                                      ),
                      				array(

                          				'id'       => 'cesis_meta_menu_pos',
                          				'type'     => 'button_set',
                          				'title'    => __('Menu Position.', 'cesis'),
                          				'subtitle' => __('Select the Menu position for the header', 'cesis'),
                      					'required'  => array(
                          						array('cesis_meta_header_layout','contains','line'),
                                      array('cesis_meta_custom_header','not','no'),
                      					),
                      				    'options' => array(
                      				        'menu_left' =>  __('Left', 'cesis'),
                      				        'menu_right' =>  __('Right', 'cesis'),
                      				        'menu_center' =>  __('Centered', 'cesis'),
                      				        'menu_fill' =>  __('Fill all space', 'cesis'),
                      				     ),
                      				    'default' => 'menu_right'
                      				),
                      				array(
                                              'id'        => 'cesis_meta_menu_border_pos',
                                              'type'      => 'select',
                                              'title'     => __('Select the Border Position', 'cesis'),
                                              'subtitle'  => __('Select the Menu border postion', 'cesis'),
                                              'required'  => array(
                          						array('cesis_meta_menu_type','contains','borderx'),
                                      array('cesis_meta_custom_header','not','no'),
                      						),

                                              'options'   => array(
                                                  'edge_border' =>  __('Edge', 'cesis'),
                                                  'text_border' =>  __('Near Text', 'cesis'),
                                              ),
                                              'default'   => 'edge_border'
                                      ),
                      				array(
                          				'id'       => 'cesis_meta_menu_border_size',
                          				'type'     => 'slider',
                          				'title'    => __('Menu Border Size.', 'cesis'),
                          				'subtitle' => __('Select the Menu Border Size', 'cesis'),
                      					'default' => '3',
                      					'required'  => array(
                          						array('cesis_meta_menu_type','contains','border'),
                                      array('cesis_meta_custom_header','not','no'),
                      					),
                      					'min' => 1,
                      				    'step' => 1,
                      				    'max' => 10,
                      				    'display_value' => 'text',
                      				),
                      				array(
                          				'id'       => 'cesis_meta_menu_border_radius',
                          				'type'     => 'slider',
                          				'title'    => __('Menu Border Radius.', 'cesis'),
                          				'subtitle' => __('Select the Menu Border Radius', 'cesis'),
                      					'default' => '0',
                      					'required'  => array(
                          						array('cesis_meta_menu_type','contains','boxed'),
                                      array('cesis_meta_custom_header','not','no'),
                      					),
                      					'min' => 0,
                      				    'step' => 1,
                      				    'max' => 100,
                      				    'display_value' => 'text',
                      				),
                      				array(
                      				    'id'             => 'cesis_meta_menu_span_padding',
                      				    'type'           => 'spacing',
                      				    'mode'           => 'padding',
                      				    'units'          => array('px'),
                      				    'units_extended' => 'false',
                      				    'title'          => __('Menu Text Box size', 'cesis'),
                      				    'subtitle'       => __('Set the box size, top space, right space, bottom space, left space.', 'cesis'),
                      					'required'  => array(
                          						array('cesis_meta_menu_type','contains','boxed'),
                                      array('cesis_meta_custom_header','not','no'),
                                    ),
                          				'default'            => array(
                      				        'padding-top'     => '5px',
                      				        'padding-right'   => '10px',
                      				        'padding-bottom'     => '5px',
                      				        'padding-left'   => '10px',
                      				        'units'          => 'px',
                          )
                      ),

                      				array(
                          				'id'       => 'cesis_meta_menu_space',
                                  'required' => array(
                                    array('cesis_meta_custom_header','not','no')
                                  ),
                          				'type'     => 'slider',
                          				'title'    => __('Menu Items Space.', 'cesis'),
                          				'subtitle' => __('Set the space between menu items', 'cesis'),
                        					'required'  => array(
                                        array('cesis_meta_custom_header','not','no'),
                        					),
                      					'default' => '20',
                      					'min' => 1,
                      				    'step' => 1,
                      				    'max' => 60,
                      				    'display_value' => 'text',
                      				),

                      					array(
                      						'id'          => 'cesis_meta_menu_font',
                                  'required' => array(
                                    array('cesis_meta_custom_header','not','no')
                                  ),
                      					    'type'        => 'typography',
                                              'title'     => __('Menu Text Font and Color Settings', 'cesis'),
                                              'subtitle'  => __('Choose the menu text font, size, color.', 'cesis'),
                      					    'google'      => true,
                      					    'font-backup' => true,
                      					    'units'       =>'px',
                      						'line-height' => true,
                      						'text-align' => false,
                      						'letter-spacing' => true,
                      						'text-transform' => true,
                      					    'default'     => array(
                      					        'color'       => '#6d7783',
                                        'line-height'  => false,
                                        'font-weight'  => '600',
                      					        'google'      => true,
                      					        'font-size'   => '13px',
                                        'letter-spacing' => '0',
                                        'text-transform' => 'uppercase',
                      					    ),
                      					),

                      					array(
                                              'id'        => 'cesis_meta_menu_sep_color',
                                              'type'      => 'color',
                                              'title'     => __('Menu Separator Color', 'cesis'),
                                              'subtitle'  => __('Menu Separator color (default: #f7f7f7).', 'cesis'),
                      						            'required'  => array(
                                                array('cesis_meta_menu_type', 'contains', 'separator'),
                                                array('cesis_meta_custom_header','not','no'),
                                              ),
                                              'default'   => '#ecf0f1',
                                              'validate'  => 'color',
                                          ),
                      					array(
                                              'id'        => 'cesis_meta_current_menu_color',
                                              'required' => array(
                                                array('cesis_meta_custom_header','not','no'),
                                                array('cesis_meta_custom_header','not','no'),
                                              ),
                                              'type'      => 'color',
                                              'title'     => __('Current Menu item Text Color', 'cesis'),
                                              'subtitle'  => __('Current / Hover Menu item text color (default: #1abc9c).', 'cesis'),
                                              'default'   => '#3a78ff',
                                              'validate'  => 'color',
                                          ),
                      					array(
                                              'id'        => 'cesis_meta_current_menu_bg_color',
                                              'type'      => 'color',
                                              'title'     => __('Current Menu item background Color', 'cesis'),
                                              'subtitle'  => __('Current Menu item background color (default: #ffffff).', 'cesis'),
                      						'required'  => array(
                                    array('cesis_meta_menu_type', '=', 'nav_line_separator'),
                                    array('cesis_meta_custom_header','not','no'),
                                  ),
                                              'default'   => '#ffffff',
                      						            'validate'  => 'color',
                                          ),
                      					array(
                                              'id'        => 'cesis_meta_menu_border_color',
                                              'type'      => 'color',
                                              'title'     => __('Current Menu border Color', 'cesis'),
                                              'subtitle'  => __('Current Menu and hover border color.', 'cesis'),
                      						'required'  => array(
                          						array('cesis_meta_menu_type','contains','border'),
                                      array('cesis_meta_custom_header','not','no'),
                      						),
                                              'default'   => '#6d7783',
                                              'validate'  => 'color',
                                          ),




                      				       array(
                                      'id'        => 'tt-notice-info-menu-ads',
                                      'required' => array(
                                        array('cesis_meta_custom_header','not','no')
                                      ),
                                      'type'      => 'info',
                                      'icon' => 'el-icon-info-sign',
                                      'title'     => __('ADDITIONAL CONTENT SETTINGS.', 'cesis'),
                                      'desc'      => __('to use an additional Bar on the top of the header please see settings below.', 'cesis')
                                      ),
                                      array(
                                                      'id'        => 'cesis_meta_header_additional_style',
                                                      'required' => array(
                                                        array('cesis_meta_custom_header','not','no')
                                                      ),
                                                      'type'      => 'select',
                                                      'title'     => __('Select the Additional elements container style', 'cesis'),
                                                      'subtitle'  => __('Simple or with a border', 'cesis'),

                                                      'options'   => array(
                                                          'additional_simple' =>  __('Simple', 'cesis'),
                                                          'additional_border' =>  __('With Border', 'cesis'),
                                                      ),
                                                      'default'   => 'additional_simple'
                                              ),
                                              array(
                                                    'id'        => 'cesis_meta_header_a_ctn_border',
                                                    'type'      => 'color',
                                                    'title'     => __('Additional elements container border color', 'cesis'),
                                                    'required'  => array(
                                                      array('cesis_meta_header_additional_style', '=', 'additional_border'),
                                                      array('cesis_meta_custom_header','not','no'),
                                                    ),
                                                    'default'   => '#ebebeb',
                                                    'validate'  => 'color',
                                              ),

                                      array(
                                        'id'        => 'cesis_meta_header_additional_type',
                                        'required' => array(
                                          array('cesis_meta_custom_header','not','no')
                                        ),
                                        'type'      => 'select',
                                        'title'     => __('Select the Additional elements design', 'cesis'),
                                        'subtitle'  => __('Simple, Squared, Rounded', 'cesis'),
                                        'options'   => array(
                                          'cesis_simple' =>  __('Simple', 'cesis'),
                                          'cesis_boxed' =>  __('Squared', 'cesis'),
                                          'cesis_rounded' =>  __('Rounded', 'cesis'),
                                        ),
                                        'default'   => 'simple'
                                      ),
                                      array(
                                  				'id'       => 'cesis_meta_header_additional_space',
                                          'required' => array(
                                            array('cesis_meta_custom_header','not','no')
                                          ),
                                  				'type'     => 'slider',
                                  				'title'    => __('Additional elements Items Space.', 'cesis'),
                                  				'subtitle' => __('Set the space between additional elements', 'cesis'),
                              					'default' => '20',
                              					'min' => 1,
                              				    'step' => 1,
                              				    'max' => 60,
                              				    'display_value' => 'text',
                              				),
                                      array(
                                          'id'        => 'cesis_meta_header_a_color',
                                          'required' => array(
                                            array('cesis_meta_custom_header','not','no')
                                          ),
                                          'type'      => 'color',
                                          'title'     => __('Additional elements Color', 'cesis'),
                                          'default'   => '#6d7783',
                                          'validate'  => 'color',
                                      ),
                                      array(
                                          'id'        => 'cesis_meta_header_a_bg_color',
                                          'type'      => 'color',
                                          'title'     => __('Additional elements background Color', 'cesis'),
                                          'required'  => array(
                                            array('cesis_meta_header_additional_type', 'not', 'cesis_simple'),
                                            array('cesis_meta_custom_header','not','no'),
                                          ),
                                          'default'   => '#ffffff',
                                          'validate'  => 'color',
                                      ),
                                      array(
                                          'id'        => 'cesis_meta_header_a_border_color',
                                          'type'      => 'color',
                                          'title'     => __('Additional elements border Color', 'cesis'),
                                          'required'  => array(
                                            array('cesis_meta_header_additional_type', 'not', 'cesis_simple'),
                                            array('cesis_meta_custom_header','not','no'),
                                          ),
                                          'default'   => '#ebebeb',
                                          'validate'  => 'color',
                                      ),
                                      array(
                                        'id'        => 'cesis_meta_header_a_hover_color',
                                        'required' => array(
                                          array('cesis_meta_custom_header','not','no')
                                        ),
                                        'type'      => 'color',
                                        'title'     => __('Additional elements hover Color', 'cesis'),
                                        'default'   => '#3a78ff',
                                        'validate'  => 'color',
                                      ),
                                      array(
                                        'id'        => 'cesis_meta_header_a_hover_bg_color',
                                        'type'      => 'color',
                                        'title'     => __('Additional elements hover background-color Color', 'cesis'),
                                        'required'  => array(
                                          array('cesis_meta_header_additional_type', 'not', 'cesis_simple'),
                                          array('cesis_meta_custom_header','not','no'),
                                        ),
                                        'default'   => '#2c2c2c',
                                        'validate'  => 'color',
                                      ),
                                      array(
                                        'id'        => 'cesis_meta_header_a_hover_border_color',
                                        'type'      => 'color',
                                        'title'     => __('Additional elements hover border Color', 'cesis'),
                                        'required'  => array(
                                          array('cesis_meta_header_additional_type', 'not', 'cesis_simple'),
                                          array('cesis_meta_custom_header','not','no')
                                        ),
                                        'default'   => '#2c2c2c',
                                              'validate'  => 'color',
                                      ),
                                      array(

                                          'id'       => 'cesis_meta_header_additional_social',
                                          'required' => array(
                                            array('cesis_meta_custom_header','not','no')
                                          ),
                                          'type'     => 'button_set',
                                          'title'    => __('Display social icons in the header?', 'cesis'),
                                          'subtitle' => __('Select if you want the social icons to show in the header main part ( change depending header layout )', 'cesis'),

                                          'options' => array(
                                              'yes' =>  __('Yes', 'cesis'),
                                              'no' =>  __('No', 'cesis'),
                                           ),
                                          'default' => 'no'
                                      ),

                                      array(

                                          'id'       => 'cesis_meta_header_additional_search',
                                          'required' => array(
                                            array('cesis_meta_custom_header','not','no')
                                          ),
                                          'type'     => 'button_set',
                                          'title'    => __('Display search icon in the header?', 'cesis'),
                                          'subtitle' => __('Select if you want the search icon in the header main part', 'cesis'),

                                          'options' => array(
                                              'yes' =>  __('Yes', 'cesis'),
                                              'no' =>  __('No', 'cesis'),
                                           ),
                                          'default' => 'no'
                                      ),
                                      array(

                                          'id'       => 'cesis_meta_header_additional_cart',
                                          'required' => array(
                                            array('cesis_meta_custom_header','not','no')
                                          ),
                                          'type'     => 'button_set',
                                          'title'    => __('Display cart icon in the header?', 'cesis'),
                                          'subtitle' => __('Select if you want the cart icon in the header main part ( need Woocommerce to be installed )', 'cesis'),

                                          'options' => array(
                                              'yes' =>  __('Yes', 'cesis'),
                                              'no' =>  __('No', 'cesis'),
                                           ),
                                          'default' => 'no'
                                      ),
                                      array(

                                          'id'       => 'cesis_meta_header_additional_buddypress',
                                          'required' => array(
                                            array('cesis_meta_custom_header','not','no')
                                          ),
                                          'type'     => 'button_set',
                                          'title'    => __('Display Buddypress notifications in the header?', 'cesis'),
                                          'subtitle' => __('Select if you want the Buddypress notifications to be display in the header main part ( need Buddypress to be installed )', 'cesis'),

                                          'options' => array(
                                              'yes' =>  __('Yes', 'cesis'),
                                              'no' =>  __('No', 'cesis'),
                                           ),
                                          'default' => 'no'
                                      ),
											                array(

											                    'id'       => 'cesis_meta_header_content_block',
											                    'type'     => 'button_set',
											                    'title'    => __('Use a content block in the header?', 'cesis'),
											                    'subtitle' => __('Select if you want to use a content block in the header', 'cesis'),

											                    'required'  => array(
											                          array('cesis_meta_header_layout','contains','vertical'),
																								array('cesis_meta_custom_header','not','no')
											                    ),

											                    'options' => array(
											                        'yes' =>  __('Yes', 'cesis'),
											                        'no' =>  __('No', 'cesis'),
											                     ),
											                    'default' => 'no'
											                ),

											                array(
											                              'id'        => 'cesis_meta_header_content_block_id',
											                              'type'      => 'select',
											                						  'required'  => array('cesis_meta_header_content_block','=','yes'),
											                              'title'     => __('Select the Block content to use', 'cesis'),
											                              'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),
											                                    //Must provide key => value pairs for select options
											                              'data'   => "content_block",
											      						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
											                              'default'   => ''
											                ),

											                array(
											                              'id'        => 'cesis_meta_header_content_block_position',
											                              'type'     => 'button_set',
											                						  'required'  => array('cesis_meta_header_content_block','=','yes'),
											                              'title'    => __('Show content block before or after additional elements?', 'cesis'),
											                              'subtitle' => __('Select the content block position', 'cesis'),

											                              'options' => array(
											                                  'before' =>  __('Before', 'cesis'),
											                                  'after' =>  __('After', 'cesis'),
											                               ),
											                              'default' => 'before'
											                ),
											                array(

											                    'id'       => 'cesis_meta_header_additional_btn',
											                    'type'     => 'button_set',
											                    'title'    => __('Display a button in the header?', 'cesis'),
											                    'subtitle' => __('Select if you want to use a button in the header', 'cesis'),
																					'required'  => array(
																						array('cesis_meta_header_layout', 'contains', 'line'),
																						array('cesis_meta_custom_header','not','no')
																					),

											                    'options' => array(
											                        'yes' =>  __('Yes', 'cesis'),
											                        'no' =>  __('No', 'cesis'),
											                     ),
											                    'default' => 'no'
											                ),
											            array(
											                    'id'        => 'cesis_meta_header_a_btn_text',
											                    'type'      => 'text',
											                    'title'     => __('Button text', 'cesis'),
											                    'desc'      => __('Set the button text, ', 'cesis'),
											                    'required'  => array('cesis_meta_header_additional_btn', '=', 'yes'),
											                    'validate'  => 'html',
											                    'default'   => 'Purchase now',
											                ),
											            array(
											                    'id'        => 'cesis_meta_header_a_btn_link',
											                    'type'      => 'text',
											                    'title'     => __('Button link', 'cesis'),
											                    'desc'      => __('Set the button text, ', 'cesis'),
											                    'required'  => array('cesis_meta_header_additional_btn', '=', 'yes'),
											                    'validate'  => 'no_html',
											                    'default'   => 'https://themeforest.net/user/tranmautritam/portfolio',
											                ),
											                array(

											                    'id'       => 'cesis_meta_header_a_btn_target',
											                    'type'     => 'button_set',
											                    'title'    => __('Open link in a new page?', 'cesis'),
											                    'subtitle' => __('Select if you want to open the link in a new page', 'cesis'),
											                    'required'  => array('cesis_meta_header_additional_btn', '=', 'yes'),

											                    'options' => array(
											                        '_blank' =>  __('Yes', 'cesis'),
											                        '_self' =>  __('No', 'cesis'),
											                     ),
											                    'default' => '_self'
											                ),
											                array(
											                    'id'        => 'cesis_meta_header_a_btn_width',
											                    'type'      => 'text',
											                    'title'     => __('Button width', 'cesis'),
											                    'desc'      => __('Set the button width, ', 'cesis'),
											                    'required'  => array('cesis_meta_header_additional_btn', '=', 'yes'),
											                    'validate'  => 'numeric',
											                    'default'   => '160',
											                ),
											                array(
											                    'id'        => 'cesis_meta_header_a_btn_height',
											                    'type'      => 'text',
											                    'title'     => __('Button height', 'cesis'),
											                    'desc'      => __('Set the button height, ', 'cesis'),
											                    'required'  => array('cesis_meta_header_additional_btn', '=', 'yes'),
											                    'validate'  => 'numeric',
											                    'default'   => '40',
											                ),
															       array(
											    				         'id'       => 'cesis_meta_header_a_btn_border',
											    				         'type'     => 'slider',
											                     'title'    => __('Button Border Size.', 'cesis'),
											                     'subtitle' => __('Select the Button Border Size', 'cesis'),
											                     'default' => '2',
											                     'required'  => array('cesis_meta_header_additional_btn', '=', 'yes'),
											                     'min' => 0,
											                     'step' => 1,
											                     'max' => 10,
											                     'display_value' => 'text',
											                   ),
											   				       array(
											       				         'id'       => 'cesis_meta_header_a_btn_radius',
											       				         'type'     => 'slider',
											                        'title'    => __('Button Border Radius.', 'cesis'),
											                        'subtitle' => __('Select the Button Border Radius', 'cesis'),
											                        'default' => '0',
											                        'required'  => array('cesis_meta_header_additional_btn', '=', 'yes'),
											                        'min' => 0,
											                        'step' => 1,
											                        'max' => 100,
											                        'display_value' => 'text',
											                      ),

											        					array(
											        						'id'          => 'cesis_meta_header_a_btn_font',
											        					    'type'        => 'typography',
											                                'title'     => __('Menu Text Font and Color Settings', 'cesis'),
											                                'subtitle'  => __('Choose the menu text font, size, color.', 'cesis'),
											                                'required'  => array('cesis_meta_header_additional_btn', '=', 'yes'),
											        					    'google'      => true,
											        					    'font-backup' => true,
											        					    'units'       =>'px',
											        						'line-height' => false,
											        						'text-align' => false,
											        						'letter-spacing' => true,
											        						'text-transform' => true,
											        					    'default'     => array(
											        					        'color'       => '#6d7783',
											                          'line-height'  => false,
											                          'font-weight'  => '600',
											        					        'google'      => true,
											        					        'font-size'   => '13px',
											                          'letter-spacing' => '1',
											                          'text-transform' => 'uppercase',
											        					    ),
											        					),
											                array(
											                    'id'        => 'cesis_meta_header_a_btn_bg_color',
											                    'type'      => 'color',
											                    'title'     => __('Button background Color', 'cesis'),
											                    'required'  => array('cesis_meta_header_additional_btn', '=', 'yes'),
											                    'default'   => '#ffffff',
											                    'validate'  => 'color',
											                ),
											                array(
											                    'id'        => 'cesis_meta_header_a_btn_border_color',
											                    'type'      => 'color',
											                    'title'     => __('Button border Color', 'cesis'),
											                    'required'  => array('cesis_meta_header_additional_btn', '=', 'yes'),
											                    'default'   => '#ebebeb',
											                    'validate'  => 'color',
											                ),
											                array(
											                  'id'        => 'cesis_meta_header_a_btn_hover_color',
											                  'type'      => 'color',
											                  'title'     => __('Button text hover Color', 'cesis'),
											                  'required'  => array('cesis_meta_header_additional_btn', '=', 'yes'),
											                  'default'   => '#3a78ff',
											                  'validate'  => 'color',
											                ),
											                array(
											                  'id'        => 'cesis_meta_header_a_btn_hover_bg_color',
											                  'type'      => 'color',
											                  'title'     => __('Button hover background Color', 'cesis'),
											                  'required'  => array('cesis_meta_header_additional_btn', '=', 'yes'),
											                  'default'   => '#2c2c2c',
											                  'validate'  => 'color',
											                ),
											                array(
											                  'id'        => 'cesis_meta_header_a_btn_hover_border_color',
											                  'type'      => 'color',
											                  'title'     => __('Button hover border Color', 'cesis'),
											                  'required'  => array('cesis_meta_header_additional_btn', '=', 'yes'),
											                  'default'   => '#2c2c2c',
											                        'validate'  => 'color',
											                ),

                                        array(
                                          'id'        => 'tt-meta-notice-info-submenu-ads',
                                          'type'      => 'info',
                                          'icon' => 'el-icon-info-sign',
                                          'required' => array(
                                            array('cesis_meta_custom_header','not','no'),
                                            array('cesis_meta_header_layout', '=', 'two_line_header'),
                                          ),
                                          'title'     => __('Header second line additional content settings.', 'cesis'),
                                          ),
                                      array(
                                            'id'        => 'cesis_meta_header_sa_ctn_border',
                                            'type'      => 'color',
                                            'title'     => __('Additional elements container border color', 'cesis'),
                                            'required'  => array(
                                              array('cesis_meta_custom_header','not','no'),
                                              array('cesis_meta_header_layout', '=', 'two_line_header'),
                                              array('cesis_meta_header_additional_style', '=', 'additional_border')
                                            ),
                                            'default'   => '#ebebeb',
                                            'validate'  => 'color',
                                      ),
                                      array(
                                            'id'        => 'cesis_meta_header_sa_color',
                                            'type'      => 'color',
                                            'title'     => __('Additional elements Color', 'cesis'),
                                            'required' => array(
                                              array('cesis_meta_custom_header','not','no'),
                                              array('cesis_meta_header_layout', '=', 'two_line_header'),
                                            ),
                                            'default'   => '#6d7783',
                                            'validate'  => 'color',
                                      ),
                                      array(
                                            'id'        => 'cesis_meta_header_sa_bg_color',
                                            'type'      => 'color',
                                            'title'     => __('Additional elements Background Color', 'cesis'),
                                            'required'  => array(
                                              array('cesis_meta_custom_header','not','no'),
                                              array('cesis_meta_header_layout', '=', 'two_line_header'),
                                              array('cesis_meta_header_additional_type', 'not', 'cesis_simple') ),
                                            'default'   => '#ffffff',
                                            'validate'  => 'color',
                                      ),
                                      array(
                                            'id'        => 'cesis_meta_header_sa_border_color',
                                            'type'      => 'color',
                                            'title'     => __('Additional elements Border Color', 'cesis'),
                                            'required'  => array(
                                              array('cesis_meta_custom_header','not','no'),
                                              array('cesis_meta_header_layout', '=', 'two_line_header'),
                                              array('cesis_meta_header_additional_type', 'not', 'cesis_simple') ),
                                            'default'   => '#ebebeb',
                                            'validate'  => 'color',
                                      ),
                                  array(
                                        'id'        => 'cesis_meta_header_sa_hover_color',
                                        'type'      => 'color',
                                        'title'     => __('Additional elements hover Color', 'cesis'),
                                        'required' => array(
                                          array('cesis_meta_custom_header','not','no'),
                                          array('cesis_meta_header_layout', '=', 'two_line_header'),
                                        ),
                                        'default'   => '#3a78ff',
                                        'validate'  => 'color',
                                  ),
                                  array(
                                        'id'        => 'cesis_meta_header_sa_hover_bg_color',
                                        'type'      => 'color',
                                        'title'     => __('Additional elements hover Background Color', 'cesis'),
                                        'required'  => array(
                                          array('cesis_meta_header_layout', '=', 'two_line_header'),
                                          array('cesis_meta_header_additional_type', 'not', 'cesis_simple') ),
                                          array('cesis_meta_custom_header','not','no'),
                                        'default'   => '#2c2c2c',
                                        'validate'  => 'color',
                                  ),
                                  array(
                                        'id'        => 'cesis_meta_header_sa_hover_border_color',
                                        'type'      => 'color',
                                        'title'     => __('Additional elements hover Border Color', 'cesis'),
                                        'required'  => array(
                                          array('cesis_meta_header_layout', '=', 'two_line_header'),
                                          array('cesis_meta_header_additional_type', 'not', 'cesis_simple') ),
                                          array('cesis_meta_custom_header','not','no'),
                                        'default'   => '#2c2c2c',
                                        'validate'  => 'color',
                                  ),
                                      array(

                                          'id'       => 'cesis_meta_header_sub_additional_social',
                                          'type'     => 'button_set',
                                          'title'    => __('Display social icons in the header second line?', 'cesis'),
                                          'subtitle' => __('Select if you want the social icons to show in the header sub part', 'cesis'),
                                          'required' => array(
                                            array('cesis_meta_custom_header','not','no'),
                                            array('cesis_meta_header_layout', '=', 'two_line_header'),
                                          ),
                                          'options' => array(
                                              'yes' =>  __('Yes', 'cesis'),
                                              'no' =>  __('No', 'cesis'),
                                           ),
                                          'default' => 'no'
                                      ),
                                      array(

                                          'id'       => 'cesis_meta_header_sub_additional_search',
                                          'type'     => 'button_set',
                                          'title'    => __('Display search icon in the header second line?', 'cesis'),
                                          'subtitle' => __('Select if you want the search icon in the header sub part', 'cesis'),
                                          'required' => array(
                                            array('cesis_meta_custom_header','not','no'),
                                            array('cesis_meta_header_layout', '=', 'two_line_header'),
                                          ),
                                          'options' => array(
                                              'yes' =>  __('Yes', 'cesis'),
                                              'no' =>  __('No', 'cesis'),
                                           ),
                                          'default' => 'no'
                                      ),
                                      array(

                                          'id'       => 'cesis_meta_header_sub_additional_cart',
                                          'type'     => 'button_set',
                                          'title'    => __('Display cart icon in the header second line?', 'cesis'),
                                          'subtitle' => __('Select if you want the cart icon in the header sub part ( need Woocommerce to be installed )', 'cesis'),
                                          'required' => array(
                                            array('cesis_meta_custom_header','not','no'),
                                            array('cesis_meta_header_layout', '=', 'two_line_header'),
                                          ),
                                          'options' => array(
                                              'yes' =>  __('Yes', 'cesis'),
                                              'no' =>  __('No', 'cesis'),
                                           ),
                                          'default' => 'no'
                                      ),
                                      array(

                                          'id'       => 'cesis_meta_header_sub_additional_buddypress',
                                          'required' => array(
                                            array('cesis_meta_custom_header','not','no'),
                                            array('cesis_meta_header_layout', '=', 'two_line_header'),
                                          ),
                                          'type'     => 'button_set',
                                          'title'    => __('Display Buddypress notifications in the header sub part ?', 'cesis'),
                                          'subtitle' => __('Select if you want the Buddypress notifications to be display in the header sub part ( need Buddypress to be installed )', 'cesis'),

                                          'options' => array(
                                              'yes' =>  __('Yes', 'cesis'),
                                              'no' =>  __('No', 'cesis'),
                                           ),
                                          'default' => 'no'
                                      ),

                          )
                        );

                        $post_box[] = $page_box[] = $portfolio_box[] = $staff_box[] = $career_box[] = $product_box[] = array(
                          'title'  => __( 'Dropdown', 'cesis' ),
                          'id'     => 'tt-meta-header-mainarea',
                          'desc'   => __( 'All the settings for the Menu Dropdown, for full documentation on this field, visit: ', 'cesis' ),

                          'subsection' => true,
                          'fields'     => array(

                            array(
                              'id' => 'cesis_meta_custom_dropdown',
                              'type' => 'button_set',
                              'title' => __('Use custom settings?', 'cesis'),
                              'options' => array(
                              'yes' => __('Yes', 'cesis'),
                              'no' => __('No', 'cesis'),
                              ),
                            'default' => 'no'
                            ),
                              array(
                                'id'        => 'cesis_meta_dropdown_bg',
                                'required' => array(
                                  array('cesis_meta_custom_dropdown','not','no')
                                ),
                                'type'      => 'color_rgba',
                                'title'     => __('Dropdown Background Color', 'cesis'),
                                'subtitle'  => __('Dropdown background color.', 'cesis'),
                                'default'   => array(
                                  'color'     => '#ffffff',
                                  'alpha'     => '1'
                                ),
                  						'options'       => array(
                  					        'clickout_fires_change'     => true,
                  						),
                              ),
                              array(
                                'id'        => 'cesis_meta_dropdown_border',
                                'required' => array(
                                  array('cesis_meta_custom_dropdown','not','no')
                                ),
                                'type'      => 'color_rgba',
                                'title'     => __('Dropdown Border Color', 'cesis'),
                                'subtitle'  => __('Dropdown border color.', 'cesis'),
                                'default'   => array(
                                  'color'     => '#ebebeb',
                                  'alpha'     => '1'
                                ),
                  						'options'       => array(
                  					        'clickout_fires_change'     => true,
                  						),
                              ),
                              array(
                                'id'       => 'cesis_meta_dropdown_font',
                                'required' => array(
                                  array('cesis_meta_custom_dropdown','not','no')
                                ),
                                'type'        => 'typography',
                                'title'     => __('Menu Text Font and Color Settings', 'cesis'),
                                'subtitle'  => __('Choose the menu text font, size, color.', 'cesis'),
                                'google'      => true,
                                'font-backup' => true,
                                'units'       =>'px',
                                'line-height' => true,
                                'text-align' => false,
                                'letter-spacing' => true,
                                'text-transform' => true,
                                'default'     => array(
                                  'color' => '#6d7783',
                                  'line-height'  => '24px',
                                  'font-weight'  => '400',
                                  'google'      => true,
                                  'font-size'   => '14px',
                                  'letter-spacing' => '0',
                                  'text-transform' => 'none',
                                ),
                              ),
                              array(
                                'id'        => 'cesis_meta_dropdown_hover_color',
                                'required' => array(
                                  array('cesis_meta_custom_dropdown','not','no')
                                ),
                                'type'      => 'color',
                                'title'     => __('Dropdown Hover Text Color', 'cesis'),
                                'subtitle'  => __('Dropdown Hover text color', 'cesis'),
                                'default'   => '#293340',
                                'validate'  => 'color',
                              ),
                              array(
                                'id'        => 'cesis_meta_dropdown_hover_bg_color',
                                'required' => array(
                                  array('cesis_meta_custom_dropdown','not','no')
                                ),
                                'type'      => 'color',
                                'title'     => __('Dropdown Hover Text Background Color', 'cesis'),
                                'subtitle'  => __('Dropdown Hover text background color', 'cesis'),
                                'default'   => '#f5f8f9',
                                'validate'  => 'color',
                              ),
                              array(
                                'id'        => 'cesis_meta_dropdown_active',
                                'required' => array(
                                  array('cesis_meta_custom_dropdown','not','no')
                                ),
                                'type'      => 'color',
                                'title'     => __('Dropdown active / accent Color', 'cesis'),
                                'subtitle'  => __('Dropdown active / accent color', 'cesis'),
                                'default'   => '#3a78ff',
                                'validate'  => 'color',
                              ),
                              array(
                                'id'       => 'cesis_meta_dropdown_heading',
                                'required' => array(
                                  array('cesis_meta_custom_dropdown','not','no')
                                ),
                                'type'        => 'typography',
                                'title'     => __('Mega menu Heading Font and Color Settings', 'cesis'),
                                'subtitle'  => __('Choose the menu text font, size, color.', 'cesis'),
                                'google'      => true,
                                'font-backup' => true,
                                'units'       =>'px',
                                'line-height' => true,
                                'text-align' => false,
                                'letter-spacing' => true,
                                'text-transform' => true,
                                'default'     => array(
                                  'color' => '#6d7783',
                                  'line-height'  => '24px',
                                  'font-weight'  => '600',
                                  'google'      => true,
                                  'font-size'   => '13px',
                                  'letter-spacing' => '1',
                                  'text-transform' => 'uppercase',
                                ),
                              ),

                          )
                        );



                                $post_box[] = $page_box[] = $portfolio_box[] = $staff_box[] = $career_box[] = $product_box[] = array(
                                  'title'  => __( 'Mobile Menu', 'cesis' ),
                                  'id'     => 'tt-meta-header-mobile-menu',
                                  'desc'   => __( 'All the settings for the Mobile menu', 'cesis' ),

                                  'subsection' => true,
                                  'fields'     => array(

                                    array(
                                                  'id'        => 'cesis_meta_mobile_menu',
                                                  'type'      => 'select',
                                                  'title'     => __('Custom mobile menu ( optional )', 'cesis'),
                                                  'subtitle'  => __('Select if you want to use a custom menu for the "mobile menu".', 'cesis'),


                                                  //Must provide key => value pairs for select options
                                                  'data'   => "menus",
                                                  'default'   => ''
                                    ),
                                    array(
                                      'id' => 'cesis_meta_custom_breakpoint',
                                      'type' => 'button_set',
                                      'title' => __('Use custom responsive breakpoint?', 'cesis'),
                                      'options' => array(
                                      'yes' => __('Yes', 'cesis'),
                                      'no' => __('No', 'cesis'),
                                      ),
                                    'default' => 'no'
                                    ),

                                    array(
                                        'id'       => 'cesis_meta_header_breakpoint',
                                        'required' => array(
                                          array('cesis_meta_custom_breakpoint','not','no')
                                        ),
                                        'type'     => 'text',
                                        'title'     => __('Mobile Header Breakpoint', 'cesis'),
                                        'subtitle'  => __('Select the window size you want the header to switch to the mobile style.', 'cesis'),
                                        'validate' => 'numeric',
                                        'default'  => '978'
                                      ),

                                    array(
                                      'id' => 'cesis_meta_custom_mobile',
                                      'type' => 'button_set',
                                      'title' => __('Use custom settings?', 'cesis'),
                                      'options' => array(
                                      'yes' => __('Yes', 'cesis'),
                                      'no' => __('No', 'cesis'),
                                      ),
                                    'default' => 'no'
                                    ),

										                array(

										                    'id'       => 'cesis_meta_mobile_design',
                                        'required' => array(
                                          array('cesis_meta_custom_mobile','not','no')
                                        ),
										                    'type'     => 'button_set',
										                    'title'    => __('Center all the menu items?', 'cesis'),
										                    'subtitle' => __('Select if you want the menu items to be centered rather than floated', 'cesis'),

										                    'options' => array(
										                        'yes' =>  __('Yes', 'cesis'),
										                        'no' =>  __('No', 'cesis'),
										                     ),
										                    'default' => 'no'
										                ),
                                      array(
                                        'id'       => 'cesis_meta_mobile_menu_height',
                                        'required' => array(
                                          array('cesis_meta_custom_mobile','not','no')
                                        ),
                                        'type'     => 'slider',
                                        'title'    => __('Mobile Header height.', 'cesis'),
                                        'subtitle' => __('Select the Mobile Header height', 'cesis'),
                                        'default' => '60',
                                        'min' => 20,
                                        'step' => 1,
                                        'max' => 300,
                                        'display_value' => 'text',
                                      ),
                                      array(
                                        'id'        => 'cesis_meta_mobile_menu_bg',
                                        'required' => array(
                                          array('cesis_meta_custom_mobile','not','no')
                                        ),
                                        'type'      => 'color',
                                        'title'     => __('Mobile Menu background Color', 'cesis'),
                                        'subtitle'  => __('Select the background color for the Mobile.', 'cesis'),
                                        'default'   => '#ffffff',
                                        'validate'  => 'color',
                                      ),
                                      array(
                                        'id'        => 'cesis_meta_mobile_menu_border',
                                        'required' => array(
                                          array('cesis_meta_custom_mobile','not','no')
                                        ),
                                        'type'      => 'color',
                                        'title'     => __('Mobile Menu border Color', 'cesis'),
                                        'subtitle'  => __('Select the border color for the Mobile.', 'cesis'),
                                        'default'   => '#f7f9fb',
                                        'validate'  => 'color',
                                      ),

                                      array(
                                        'id'          => 'cesis_meta_mobile_menu_font',
                                        'required' => array(
                                          array('cesis_meta_custom_mobile','not','no')
                                        ),
                                          'type'        => 'typography',
											                              'title'     => __('Mobile menu Top items text font and color settings', 'cesis'),
											                              'subtitle'  => __('Choose the menu top items text font, size, color.', 'cesis'),
                                          'google'      => true,
                                          'font-backup' => true,
                                          'units'       =>'px',
                                        'line-height' => true,
                                        'text-align' => false,
                                        'letter-spacing' => true,
                                        'text-transform' => true,
                                          'default'     => array(
											      					        'color'       => '#293340',
											      					        'font-weight'  => '700',
											      					        'google'      => true,
											      					        'font-size'   => '15px',
											                        'line-height'   => '24px',
											                        'letter-spacing' => '0',
											                        'text-transform' => 'none',
                                          ),
                                      ),

                                      array(
                                        'id'          => 'cesis_meta_mobile_sub_menu_font',
                                        'required' => array(
                                          array('cesis_meta_custom_mobile','not','no')
                                        ),
                                          'type'        => 'typography',
											                              'title'     => __('Mobile menu Sub items text font and color settings', 'cesis'),
											                              'subtitle'  => __('Choose the menu sub items text font, size, color.', 'cesis'),
                                          'google'      => true,
                                          'font-backup' => true,
                                          'units'       =>'px',
                                        'line-height' => true,
                                        'text-align' => false,
                                        'letter-spacing' => true,
                                        'text-transform' => true,
                                          'default'     => array(
											      					        'color'       => '#617186',
											      					        'font-weight'  => '500',
											      					        'google'      => true,
											      					        'font-size'   => '14px',
											                        'line-height'   => '24px',
											                        'letter-spacing' => '0',
											                        'text-transform' => 'none',
                                          ),
                                      ),

                                      array(
                                        'id'        => 'cesis_meta_mobile_open_menu',
                                        'required' => array(
                                          array('cesis_meta_custom_mobile','not','no')
                                        ),
                                        'type'      => 'color',
                                        'title'     => __('Active / Expanded Menu Item Color', 'cesis'),
                                        'subtitle'  => __('Select the color for the Current Menu Item.', 'cesis'),
                                        'default'   => '#4251f4',
                                        'validate'  => 'color',
                                      ),

                                      array(
                                        'id'        => 'cesis_meta_mobile_current_menu',
                                        'required' => array(
                                          array('cesis_meta_custom_mobile','not','no')
                                        ),
                                        'type'      => 'color',
                                        'title'     => __('Current Menu Item Color', 'cesis'),
                                        'subtitle'  => __('Select the color for the Current Menu Item.', 'cesis'),
                                        'default'   => '#3a78ff',
                                        'validate'  => 'color',
                                      ),
                                      array(

                                          'id'       => 'cesis_meta_mobile_social',
                                          'required' => array(
                                            array('cesis_meta_custom_mobile','not','no')
                                          ),
                                          'type'     => 'button_set',
                                          'title'    => __('Display social icons in the Mobile menu?', 'cesis'),
                                          'subtitle' => __('Select if you want the social icons to show in the mobile menu', 'cesis'),

                                          'options' => array(
                                              'yes' =>  __('Yes', 'cesis'),
                                              'no' =>  __('No', 'cesis'),
                                           ),
                                          'default' => 'no'
                                      ),
                                      array(

                                          'id'       => 'cesis_meta_mobile_search',
                                          'required' => array(
                                            array('cesis_meta_custom_mobile','not','no')
                                          ),
                                          'type'     => 'button_set',
                                          'title'    => __('Display search field in the mobile menu?', 'cesis'),
                                          'subtitle' => __('Select if you want the search field in the mobile menu', 'cesis'),

                                          'options' => array(
                                              'yes' =>  __('Yes', 'cesis'),
                                              'no' =>  __('No', 'cesis'),
                                           ),
                                          'default' => 'no'
                                      ),
                                      array(

                                          'id'       => 'cesis_meta_mobile_cart',
                                          'required' => array(
                                            array('cesis_meta_custom_mobile','not','no')
                                          ),
                                          'type'     => 'button_set',
                                          'title'    => __('Display cart icon in the mobile menu?', 'cesis'),
                                          'subtitle' => __('Select if you want the cart icon in the mobile menu ( need Woocommerce to be installed )', 'cesis'),

                                          'options' => array(
                                              'yes' =>  __('Yes', 'cesis'),
                                              'no' =>  __('No', 'cesis'),
                                           ),
                                          'default' => 'no'
                                      ),
                                      array(

                                          'id'       => 'cesis_meta_mobile_notifications',
                                          'required' => array(
                                            array('cesis_meta_custom_mobile','not','no')
                                          ),
                                          'type'     => 'button_set',
                                          'title'    => __('Display Buddypress notifications in the mobile menu?', 'cesis'),
                                          'subtitle' => __('Select if you want the Buddypress notifications to be display in the mobile menu ( need Buddypress to be installed )', 'cesis'),

                                          'options' => array(
                                              'yes' =>  __('Yes', 'cesis'),
                                              'no' =>  __('No', 'cesis'),
                                           ),
                                          'default' => 'no'
                                      ),

                                  )
                                );


        $post_box[] = $page_box[] = $portfolio_box[] = $staff_box[] = $career_box[] = $product_box[] = array(
            'title'      => __( 'Banner settings', 'cesis' ),
            'desc'       => __( 'Product Posts banner settings', 'cesis' ),
            'id'         => 'tt-meta-banner',
            'icon'         => 'fa-film ',
            'fields'     => array(
              array(
                'id'        => 'cesis_meta_banner',
                'type'      => 'button_set',
                'title'     => __('Banner type', 'cesis'),
                'subtitle'  => __('Select the banner area type.', 'cesis'),
                'options' => array(
                'inherit' => __('Default', 'cesis'),
                'none' => __('No Banner', 'cesis'),
                'content' => __('Content Block', 'cesis'),
                'slider' => __('Slider Revolution', 'cesis'),
								'layerslider' => __('LayerSlider', 'cesis'),
              ),
              'default' => 'inherit'
            ),
            array(
              'id'        => 'cesis_meta_banner_pos',
              'type'      => 'button_set',
              'required'  => array(
                array('cesis_meta_banner','!=','inherit'),
                array('cesis_meta_banner','!=','none'),
              ),
              'title'     => __('Banner position', 'cesis'),
              'subtitle'  => __('Select the banner position.', 'cesis'),
              'options' => array(
                'inherit' => __('Default', 'cesis'),
                'under' => __('Under Header', 'cesis'),
                'above' => __('Above Header', 'cesis'),
              ),
                'default' => 'inherit'
            ),
            array(
              'id'        => 'cesis_meta_block_content',
              'type'      => 'select',
              'required'  => array('cesis_meta_banner','=','content'),
              'title'     => __('Select the Block content to use', 'cesis'),
              'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),
              //Must provide key => value pairs for select options
              'data'   => "content_block",
              'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
              'default'   => ''
            ),
            array(
                          'id'        => 'cesis_meta_rev_slider',
                          'type'      => 'select',
            						  'required'  => array('cesis_meta_banner','=','slider'),
                          'title'     => __('Select the Slider revolution to use', 'cesis'),
                          'subtitle'  => __('You need to have at least one slider created', 'cesis'),
  			                  'options' => $rev_sliders,
                          'default'   => ''
            ),
	          array(
	                        'id'        => 'cesis_meta_layer_slider',
	                        'type'      => 'select',
	          						  'required'  => array('cesis_meta_banner','=','layerslider'),
	                        'title'     => __('Select the Layerslider to use', 'cesis'),
	                        'subtitle'  => __('You need to have at least one slider created', 'cesis'),
				                  'options' => $layerslider_array,
	                        'default'   => ''
	          ),
          )
        );


                 $post_box[] = $page_box[] = $portfolio_box[] = $staff_box[] = $career_box[] = $product_box[] = array(
                    'title'      => __( 'Title settings', 'cesis' ),
                    'desc'       => __( 'Page title settings', 'cesis' ),
                    'id'         => 'tt-meta-title',
                    'icon'         => 'fa-list-alt',
                    'fields'     => array(


                        array(
                          'id'        => 'cesis_meta_custom_title',
                          'type'      => 'button_set',
                          'title'     => __('Use custom settings?', 'cesis'),
                          'subtitle'  => __('Select if you want to use custom title settings.', 'cesis'),
                          'options' => array(
                            'yes' => __('Yes', 'cesis'),
                            'no' => __('No', 'cesis'),
                          ),
                          'default' => 'no'
                        ),

                          array(
                                    'id'        => 'cesis_meta_title',
                                    'required'  => array(
                                         array('cesis_meta_custom_title','=','yes'),
                                    ),
                                    'type'      => 'button_set',
                                    'title'     => __('Show Title area?', 'cesis'),
                                    'subtitle'  => __('Select if you want to show the title area.', 'cesis'),
                                    'options' => array(
                                      'yes' => __('Yes', 'cesis'),
                                      'no' => __('No', 'cesis'),
                                    ),
                                   'default' => 'yes'
                              ),
                  					array(
                  					    'id'       => 'cesis_meta_title_layout',
                                'required'  => array(
                                     array('cesis_meta_title','=','yes'),
                                ),
                  					    'type'     => 'image_select',
                  					    'title'    => __('Default Title Layout', 'cesis'),
                  					    'subtitle' => __('Select the Title layout. You can change for each page from the page options.', 'cesis'),
                  					    'options'  => array(
                  					        'title_layout_one'      => array(
                  					            'alt'   => 'Title layout 1',
                  					            'img'   => ReduxFramework::$_url.'assets/img/title_1.png'
                  								        ),
                  					        'title_layout_two'      => array(
                  					            'alt'   => 'Title layout 2',
                  					            'img'   => ReduxFramework::$_url.'assets/img/title_2.png'
                         									 ),
                  					        'title_layout_three'      => array(
                  					            'alt'   => 'Title layout 3',
                  					            'img'  => ReduxFramework::$_url.'assets/img/title_3.png'
                  									     ),

                      ),
                      					'default' => 'title_layout_one'
                  			),
                  			array(
                                          'id'        => 'cesis_meta_title_alignment',
                                          'type'     => 'button_set',
                  						'required'  => array(
                  						array('cesis_meta_title_layout','not_contain','one'),
                                   array('cesis_meta_title','=','yes'),
                  									),
                                          'title'     => __('Title Content Alignment', 'cesis'),
                                          'subtitle'  => __('Select the title content alignment( Center, Left, Right ).', 'cesis'),
                                          'options' => array(
                  					        'title_alignment_left' =>  __('Left', 'cesis'),
                  					        'title_alignment_center' =>  __('Center', 'cesis'),
                  					        'title_alignment_right' =>  __('Right', 'cesis'),
                  					     ),
                  					    'default' => 'title_alignment_center'


                  			),
                  			array(
                                          'id'        => 'cesis_meta_title_width',
                                          'required'  => array(
                                               array('cesis_meta_title','=','yes'),
                                          ),
                                          'type'     => 'dimensions',
                                          'height'     => false,
                  						'units'    => array('px','%'),
                                          'title'     => __('Select the Title container width ( px or % )', 'cesis'),
                                          'subtitle'  => __('Default 1170px, select 100% to have full width Title container.', 'cesis'),
                                          'default' => array(
                  					        'width'   => '1170',
                                    'units' => 'px'
                  					     ),


                  			),
                  			array(
                                          'id'        => 'cesis_meta_title_height',
                                          'required'  => array(
                                               array('cesis_meta_title','=','yes'),
                                          ),
                                          'type'     => 'dimensions',
                                          'width'     => false,
                  						'units'    => array('px','%'),
                                          'title'     => __('Select the Title container height ( px or % )', 'cesis'),
                                          'subtitle'  => __('Default 100px, use percentage to adapt the size depending on the user screen.', 'cesis'),
                                          'default' => array(
                  					        'height'   => '100',
                                    'units' => 'px'
                  					     ),


                  			),
                  			array(
                                          'id'        => 'cesis_meta_title_minheight',
                                          'required'  => array(
                                               array('cesis_meta_title','=','yes'),
                                          ),
                                          'type'     => 'dimensions',
                                          'width'     => false,
                  						'units'    => array('px'),
                                          'title'     => __('Select the Title minimum height ( px )', 'cesis'),
                                          'subtitle'  => __('Good to set a minimum height when using % for title height.', 'cesis'),
                                          'default' => array(
                  					        'height'   => '70',
                                    'units' => 'px'
                  					     ),


                  			),
                  			array(
                                          'id'        => 'cesis_meta_title_background',
                                          'required'  => array(
                                               array('cesis_meta_title','=','yes'),
                                          ),
                                          'type'      => 'background',
                                          'title'     => __('Title Background Color / Image', 'cesis'),
                                          'subtitle'  => __('Select the Title background color or Image.', 'cesis'),
                                          'default'  => array(
                                            'background-color' => '#191a1b',
                                          )
                              ),
                  			 array(
                                          'id'        => 'cesis_meta_title_overlay',
                                          'required'  => array(
                                               array('cesis_meta_title','=','yes'),
                                          ),
                                          'type'     => 'button_set',
                                          'title'     => __('Use an Overlay for the Title Area?', 'cesis'),
                                          'subtitle'  => __('Select if you want to use an overlay for the Title area.', 'cesis'),
                                          'options' => array(
                  					        'yes' =>  __('Yes', 'cesis'),
                  					        'no' =>  __('No', 'cesis'),
                  					     ),
                  					    'default' => 'no'


                  			),
                  			array(
                                          'id'        => 'cesis_meta_title_overlay_color',
                  						'required'  => array(
                  						array( 'cesis_meta_title_overlay', '=', 'yes') ,
                                   array('cesis_meta_title','=','yes'),
                  								),
                                          'type'      => 'color_rgba',
                                          'title'     => __('Title Overlay color', 'cesis'),
                                          'subtitle'  => __('Title Overlay color', 'cesis'),
                                          'default'   => array(
                      					    'color'     => '#000000',
                       						'alpha'     => '0.15'
                     						),
                  						'options'       => array(
                  					        'clickout_fires_change'     => true,
                  						),
                                     ),
                  			array(
                  	                    'id'        => 'cesis_meta_title_border',
                                        'required'  => array(
                                             array('cesis_meta_title','=','yes'),
                                        ),
                                          'type'      => 'color',
                                          'title'     => __('Title border color', 'cesis'),
                                          'subtitle'  => __('Title Border color (default: #ecf0f1).', 'cesis'),
                                          'default'   => '#ecf0f1',
                                          'validate'  => 'color',
                                      ),

                        array(
                          'id'   => 'cesis_meta_title_info',
                          'required'  => array(
                               array('cesis_meta_title','=','yes'),
                          ),
                          'type' => 'info',
                          'style' => 'success',
                          'title' => __('TITLE SETTINGS.', 'cesis'),
                          'desc' => __('Title text settings ).', 'cesis')
                        ),

                        array(
                                          'id'        => 'cesis_meta_title_display',
                                          'required'  => array(
                                               array('cesis_meta_title','=','yes'),
                                          ),
                                          'type'     => 'button_set',
                                          'title'     => __('Display the Title?', 'cesis'),
                                          'subtitle'  => __('Select if you want to show or hide the Page title.', 'cesis'),
                                          'options' => array(
                  					        'yes' =>  __('Yes', 'cesis'),
                  					        'no' =>  __('No', 'cesis'),
                  					     ),
                  					    'default' => 'yes'


                  			),

                  			array(
                  						'id'          => 'cesis_meta_title_font',
                  					    'type'        => 'typography',
                  						'required'  => array( 'cesis_meta_title_display', '=', 'yes'),
                                          'title'     => __('Title Text font and Color Settings', 'cesis'),
                                          'subtitle'  => __('Choose the Title text font, size, color.', 'cesis'),
                  					    'google'      => true,
                  					    'font-backup' => true,
                  					    'units'       =>'px',
                  						'line-height' => false,
                  						'text-align' => false,
                  						'letter-spacing' => true,
                  						'text-transform' => true,
                  					    'default'     => array(
                  					        'color'       => '#293340',
                  					        'font-weight'  => '600',
                  					        'line-height'  => '40px',
                  					        'google'      => true,
                  					        'font-size'   => '20px',
                  							'letter-spacing' => '0',
                  							'text-transform' => 'none',
                  					    ),
                  					),

                  array(
                  'id'   => 'cesis_meta_breadcrumbs_info',
                  'required'  => array(
                       array('cesis_meta_title','=','yes'),
                  ),
                  'type' => 'info',
                  'style' => 'success',
                  'title' => __('BREADCRUMBS SETTINGS.', 'cesis'),
                  'desc' => __('Title text settings ).', 'cesis')
                  ),


                           	 array(
                                          'id'        => 'cesis_meta_breadcrumbs_display',
                                          'required'  => array(
                                               array('cesis_meta_title','=','yes'),
                                          ),
                                          'type'     => 'button_set',
                                          'title'     => __('Display the breadcrumbs?', 'cesis'),
                                          'subtitle'  => __('Select if you want to show or hide the breadcrumbs.', 'cesis'),
                                          'options' => array(
                  					        'yes' =>  __('Yes', 'cesis'),
                  					        'no' =>  __('No', 'cesis'),
                  					     ),
                  					    'default' => 'yes'


                  			),
                           	 array(
                                          'id'        => 'cesis_meta_breadcrumbs_display_home',
                                          'type'     => 'button_set',
                  						'required'  => array( 'cesis_meta_breadcrumbs_display', '=', 'yes') ,
                                          'title'     => __('Display the "Home" link on breadcrumb?', 'cesis'),
                                          'subtitle'  => __('Select if you want show or hide the Home link.', 'cesis'),
                                          'options' => array(
                  					        'yes' =>  __('Yes', 'cesis'),
                  					        'no' =>  __('No', 'cesis'),
                  					     ),
                  					    'default' => 'yes'


                  			),
                  		  	array(
                  				    'id'       => 'cesis_meta_breadcrumbs_front',
                  					'required'  => array( 'cesis_meta_breadcrumbs_display', '=', 'yes') ,
                  				    'type'     => 'text',
                  				    'title'    => __('Breadcrumb front Text', 'cesis'),
                  				    'subtitle' => __('Text to show before the breadcrumbs, ex: You are here', 'cesis'),
                  				    'desc'     => __('Keep empty to hide the front text.', 'cesis'),
                  				    'validate' => 'html',
                  				    'default'  => ' '
                  			),
                  		  	array(
                  				    'id'       => 'cesis_meta_breadcrumbs_sep',
                  					'required'  => array( 'cesis_meta_breadcrumbs_display', '=', 'yes') ,
                  				    'type'     => 'text',
                  				    'title'    => __('Breadcrumbs Separator.', 'cesis'),
                  				    'subtitle' => __('Link Separator, ex: / ', 'cesis'),
                  				    'desc'     => __('Will separate the links.', 'cesis'),
                  				    'validate' => 'html',
                  				    'default'  => '/'
                  			),

                  			array(
                  						'id'          => 'cesis_meta_breadcrumbs_font',
                  						'required'  => array( 'cesis_meta_breadcrumbs_display', '=', 'yes') ,
                  					    'type'        => 'typography',
                                          'title'     => __(' Breadcrumb Text Font and Color Settings', 'cesis'),
                                          'subtitle'  => __('Choose the Breadcrumb text font, size, color.', 'cesis'),
                  					    'google'      => true,
                  					    'font-backup' => true,
                  					    'units'       =>'px',
                  						'line-height' => false,
                  						'text-align' => false,
                  						'letter-spacing' => true,
                  						'text-transform' => true,
                  					    'default'     => array(
                  					        'color'       => '#6d7783',
                  					        'font-weight'  => '400',
                  					        'google'      => true,
                  					        'font-size'   => '13px',
                  					        'line-height'  => '30px',
                  							'letter-spacing' => '0',
                  							'text-transform' => 'none',
                  					    ),
                  					),
                  			array(
                                          'id'        => 'cesis_meta_current_breadcrumbs_color',
                                          'required'  => array(
                                               array( 'cesis_meta_breadcrumbs_display', '=', 'yes') ,
                                          ),
                                          'type'      => 'color',
                                          'title'     => __('Breadcrumb hover color', 'cesis'),
                                          'subtitle'  => __('Breadcrumbs hover color.', 'cesis'),
                                          'default'   => '#ecf0f1',
                                          'validate'  => 'color',
                                     ),
                  			array(
                                          'id'        => 'cesis_meta_breadcrumbs_bg_color',
                  						'required'  => array( 'cesis_meta_breadcrumbs_display', '=', 'yes') ,
                                          'type'      => 'color_rgba',
                                          'title'     => __('Breadcrumb background color', 'cesis'),
                                          'subtitle'  => __('Breadcrumb background color ( only used in title layout 3 ).', 'cesis'),
                                          'default'   => array(
                      					                 'color'     => '#000000',
                       						               'alpha'     => '1'
                     						          ),
                                          'options'  => array(
                                                'clickout_fires_change' => true,
                                          ),
                                   ),

                  			array(
                                          'id'        => 'cesis_meta_breadcrumbs_word_char',
                  						'required'  => array( 'cesis_meta_breadcrumbs_display', '=', 'yes') ,
                                          'type'      => 'select',
                                          'title'     => __('Select if title is cut by Word or Character', 'cesis'),
                                          'subtitle'  => __('Select if the title need to be cut by Word or Character', 'cesis'),


                                          'options'   => array(
                                              'word' => 'Word',
                  							'character' => 'Character',
                                          ),
                                          'default'   => 'word'
                                  ),

                  		  	array(
                  				    'id'       => 'cesis_meta_breadcrumbs_word_char_count',
                  					'required'  => array( 'cesis_meta_breadcrumbs_display', '=', 'yes') ,
                  				    'type'     => 'text',
                  				    'title'    => __('Breadcrumb Title max word/Character count', 'cesis'),
                  				    'subtitle' => __('Example : 4', 'cesis'),
                  				    'validate' => 'numeric',
                  				    'default'  => '4'
                  			),

                  		  	array(
                  				    'id'       => 'cesis_meta_breadcrumbs_word_char_end',
                  					'required'  => array( 'cesis_meta_breadcrumbs_display', '=', 'yes') ,
                  				    'type'     => 'text',
                  				    'title'    => __('Ending Character to show after cut title', 'cesis'),
                  				    'subtitle' => __('Example : ...', 'cesis'),
                  				    'validate' => 'html',
                  				    'default'  => ''
                  			),
                  )
                );

                $post_box[] = $page_box[] = $portfolio_box[] = $staff_box[] = $career_box[] = $product_box[] = array(
                  'title'  => __( 'Main Content Settings', 'cesis' ),
                  'id'     => 'tt-meta-main-content',
                  'icon'   => 'fa-main-content ',
                );


                $page_box[] = array(
                  'title'  => __( 'Layout Settings', 'cesis' ),
                  'id'     => 'tt-meta-page-layout',

                  'subsection' => true,
                  'fields'     => array(
                    array(
                         'id'        => 'cesis_meta_page_onepage',
                         'type'     => 'button_set',
                         'title'     => __('Active One page?', 'cesis'),
                         'subtitle'  => __('Select if you want to change the page into a "One page" page.', 'cesis'),
                         'options' => array(
                           'cesis_onepage_page' =>  __('Yes', 'cesis'),
                           'no' =>  __('No', 'cesis'),
                         ),
                         'default' => 'no'
                    ),
                    array(
                         'id'        => 'cesis_meta_page_onepage_nav',
                         'type'      => 'select',
                         'required' => array(
                         array('cesis_meta_page_onepage','!=','no')
                         ),
                         'title'     => __('Add dot navigation on the page?', 'cesis'),
                         'subtitle'  => __('Select if you want add a dot navigation on the page.', 'cesis'),
                         'options' => array(
                           'no' =>  __('No', 'cesis'),
                           'cesis_onepage_right_nav' =>  __('Right dots navigation', 'cesis'),
                           'cesis_onepage_left_nav' =>  __('Left dots navigation', 'cesis'),
                         ),
                         'default' => 'no'
                    ),
                    array(
                         'id'        => 'cesis_meta_page_swipe',
                         'type'     => 'button_set',
                         'title'     => __('Active section swap?', 'cesis'),
                         'subtitle'  => __('Select if you want to activate the section swipe feature.', 'cesis'),
                         'options' => array(
                           'cesis_section_swipe' =>  __('Yes', 'cesis'),
                           'no' =>  __('No', 'cesis'),
                         ),
                         'default' => 'no'
                       ),

                    array(
                           'id'        => 'cesis_meta_page_custom_layout',
                           'type'     => 'button_set',
                           'title'     => __('Use custom layout?', 'cesis'),
                           'subtitle'  => __('Select if you want to use custom layout for the post.', 'cesis'),
                           'options' => array(
                             'yes' =>  __('Yes', 'cesis'),
                             'no' =>  __('No', 'cesis'),
                           ),
                           'default' => 'no'
                         ),
                    array(
                               'id'        => 'cesis_meta_page_content_width',
                               'required' => array(
                               array('cesis_meta_page_custom_layout','!=','no')
                               ),
                                 'type'     => 'dimensions',
                                 'height'     => false,
                         'units'    => array('px','%'),
                                 'title'     => __('Select the Main content container width ( px or % )', 'cesis'),
                                 'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                                 'default' => array(
                                'width'   => '1170',
                                'units' => 'px'
                             ),
                    ),
                    array(
                                      'id'        => 'cesis_meta_page_content_top_padding',
                                      'required' => array(
                                      array('cesis_meta_page_custom_layout','!=','no')
                                      ),
                                      'type'     => 'dimensions',
                                      'width'     => false,
                          'units'    => array('px'),
                                      'title'     => __('Select the Main content top space for page using sidebar ( top padding px )', 'cesis'),
                                      'subtitle'  => __('If no sidebar is used and content build with Page builder 0 is recommended.', 'cesis'),
                                      'default' => array(
                                'height'   => '0',
                                'units' => 'px'
                             ),


                    ),
                    array(
                                      'id'        => 'cesis_meta_page_content_bottom_padding',
                                      'required' => array(
                                      array('cesis_meta_page_custom_layout','!=','no')
                                      ),
                                      'type'     => 'dimensions',
                                      'width'     => false,
                          'units'    => array('px'),
                                      'title'     => __('Select the Main content bottom space for page using sidebar ( bottom padding px )', 'cesis'),
                                      'subtitle'  => __('If no sidebar used and content build with Page builder 0 is recommended.', 'cesis'),
                                      'default' => array(
                                'height'   => '0',
                                'units' => 'px'
                             ),


                    ),
                    array(
                            'id'       => 'cesis_meta_page_layout',
                            'required' => array(
                            array('cesis_meta_page_custom_layout','!=','no')
                            ),
                            'type'     => 'image_select',
                            'title'    => __('Select the Page default layout', 'cesis'),
                            'subtitle' => __('Select main content and sidebar alignment.', 'cesis'),
                            'options'  => array(
                                'no_sidebar'      => array(
                                  'alt'   => '1 Column',
                                  'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                                    ),
                                'r_sidebar'      => array(
                                  'alt'   => 'Sidebar Right',
                                  'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                                    ),
                                'l_sidebar'      => array(
                                  'alt'   => 'Sidebar Left',
                                  'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                                    ),
                              ),
                            'default' => 'no_sidebar'
                        ),
                  )
              );


              $post_box[] = array(
                'title'  => __( 'Layout Settings', 'cesis' ),
                'id'     => 'tt-meta-post-layout',

                'subsection' => true,
                'fields'     => array(

                  array(
                         'id'        => 'cesis_meta_blog_custom_layout',
                         'type'     => 'button_set',
                         'title'     => __('Use custom layout?', 'cesis'),
                         'subtitle'  => __('Select if you want to use custom layout for the post.', 'cesis'),
                         'options' => array(
                           'yes' =>  __('Yes', 'cesis'),
                           'no' =>  __('No', 'cesis'),
                         ),
                         'default' => 'no'
                       ),

                    array(
                                'id'        => 'cesis_meta_blog_sp_style',
                                'required' => array(
                                array('cesis_meta_blog_custom_layout','!=','no')
                                ),
                                'type'      => 'select',
                                'title'     => __('Select the Single Posts default style', 'cesis'),
                                'subtitle'  => __('Select the design to use for the Single Post page.', 'cesis'),


                                //Must provide key => value pairs for select options
                                'options'   => array(
                                    'inherit' =>  __('Default', 'cesis'),
						                            'single_post_layout_eight' => 'Classic',
						                            'single_post_layout_nine' => 'Classic Boxed',
						                            'single_post_layout_four' => 'Agency',
						                            'single_post_layout_six' => 'Career',
						                            'single_post_layout_seven' => 'LifeStyle',
						                            'single_post_layout_one' => 'Casual',
						                            'single_post_layout_three' => 'Casual In Boxes',
						                            'single_post_layout_two' => 'Writer',
                                ),
                                'default'   => 'inherit'
                            ),
        			array(
                     	   'id'        => 'cesis_meta_blog_content_width',
                         'required' => array(
                         array('cesis_meta_blog_custom_layout','!=','no')
                         ),
                           'type'     => 'dimensions',
                           'height'     => false,
        				   'units'    => array('px','%'),
                           'title'     => __('Select the Single blog posts main content container width ( px or % )', 'cesis'),
                           'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                           'default' => array(
        					        'width'   => '1170',
                          'units' => 'px'
        					     ),
        			),
        			array(
                                'id'        => 'cesis_meta_blog_content_top_padding',
                                'required' => array(
                                array('cesis_meta_blog_custom_layout','!=','no')
                                ),
                                'type'     => 'dimensions',
                                'width'     => false,
        						'units'    => array('px'),
                                'title'     => __('Select the Single blog posts main content top space ( top padding px )', 'cesis'),
                                'subtitle'  => __('If no sidebar used and content build with Page builder 0 is recommended.', 'cesis'),
                                'default' => array(
        					        'height'   => '60',
                          'units' => 'px'
        					     ),


        			),
        			array(
                                'id'        => 'cesis_meta_blog_content_bottom_padding',
                                'required' => array(
                                array('cesis_meta_blog_custom_layout','!=','no')
                                ),
                                'type'     => 'dimensions',
                                'width'     => false,
        						'units'    => array('px'),
                                'title'     => __('Select the Single blog posts main content bottom space ( bottom padding px )', 'cesis'),
                                'subtitle'  => __('If no sidebar used and content build with Page builder 0 is recommended.', 'cesis'),
                                'default' => array(
        					        'height'   => '60',
                          'units' => 'px'
        					     ),


        			),
        			array(
        					    'id'       => 'cesis_meta_blog_sp_layout',
                      'required' => array(
                      array('cesis_meta_blog_custom_layout','!=','no')
                      ),
        					    'type'     => 'image_select',
        					    'title'    => __('Select the Single Post layout', 'cesis'),
        					    'subtitle' => __('Select main content and sidebar alignment.', 'cesis'),
        					    'options'  => array(
        					        'no_sidebar'      => array(
        				            'alt'   => '1 Column',
        				            'img'   => ReduxFramework::$_url.'assets/img/1col.png'
        							        ),
        					        'r_sidebar'      => array(
        				            'alt'   => 'Sidebar Right',
        				            'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
        							        ),
        					        'l_sidebar'      => array(
        				            'alt'   => 'Sidebar Left',
        				            'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
        							        ),
        						    ),
        					    'default' => 'r_sidebar'
        					),
                  array(
                                    'id'        => 'cesis_meta_blog_media',
                                    'required' => array(
                                    array('cesis_meta_blog_custom_layout','!=','no')
                                    ),
                                    'type'     => 'button_set',
                                    'title'     => __('Display the Blog media ( thumbnail, video or audio ) ?', 'cesis'),
                                    'subtitle'  => __('Select if you want to show the media of the post.', 'cesis'),

                                    'options' => array(
                              'inherit' =>  __('Default', 'cesis'),
                              'yes' =>  __('Yes', 'cesis'),
                              'no' =>  __('No', 'cesis'),
            					     ),
            					    'default' => 'inherit'


            				),
                  array(
                    'id'        => 'cesis_meta_blog_gallery_type',
                    'type'      => 'select',
                    'title'     => __('Select the Single posts gallery type', 'cesis'),
                    'subtitle'  => __('Select the gallery type for the auto generated content.', 'cesis'),
                    'required' => array(
                    array('cesis_meta_blog_media','!=','no')
                    ),
                    //Must provide key => value pairs for select options
                    'options'   => array(
                      'inherit' =>  __('Default', 'cesis'),
                      'carousel' => __('Carousel', 'cesis'),
                      'packery' => __('Packery', 'cesis'),
                      'stacked' => __('Stacked', 'cesis'),
                    ),
                    'default'   => 'inherit'
                    ),

                    array(
                    'id' => 'cesis_meta_blog_gallery_space',
                    'type' => 'text',
                    'title' => __('Select the space between the images', 'cesis'),
                    'required' => array(

                    array('cesis_meta_blog_media','!=','no'),
                    array('cesis_meta_blog_gallery_type','=','stacked'),

                    ),
                    'default'   => '0'
                    ),

                    array(
                    'id' => 'cesis_meta_blog_gallery_size',
                    'type' => 'select',
                    'title' => __('Select the thumbnail size', 'cesis'),
                    'subtitle' => __('Select the image size to used in the automatically generated content', 'cesis'),
                    'required' => array(

                    array('cesis_meta_blog_media','!=','no'),
                    array('cesis_meta_blog_gallery_type','!=','packery')

                    ),

                    'options' => array(
                      'inherit' =>  __('Default', 'cesis'),
                      'tn_squared' => '1:1 ( squared )',
                      'tn_rectangle_4_3' => '4:3  ( rectangle )',
                      'tn_rectangle_3_2' => '3:2  ( rectangle )',
                      'tn_landscape_16_9' => '16:9  ( landscape )',
                      'tn_landscape_4_2' => '4:2  ( landscape )',
                      'tn_landscape_21_9' => '21:9  ( landscape )',
                      'tn_portrait_3_4' => '3:4  ( portrait )',
                      'tn_portrait_2_3' => '2:3  ( portrait )',
                      'tn_portrait_9_16' => '9:16  ( portrait )',
                      'cesis_full' => 'full ( original size )'
                    ),
                    'default' => 'inherit'
                  ),
        			array(
                                'id'        => 'cesis_meta_blog_sp_author',
                                'required' => array(
                                array('cesis_meta_blog_custom_layout','!=','no')
                                ),
                                'type'     => 'button_set',
                                'title'     => __('Display the Author Information / Description ?', 'cesis'),
                                'subtitle'  => __('Select if you want to show the author information / description box.', 'cesis'),

                                'options' => array(
                          'inherit' =>  __('Default', 'cesis'),
                          'yes' =>  __('Yes', 'cesis'),
                          'no' =>  __('No', 'cesis'),
        					     ),
        					    'default' => 'inherit'


        		),
				    array(
				                      'id'        => 'cesis_meta_blog_sp_authori',
				                      'type'     => 'button_set',
				                      'title'     => __('Display the Author name ?', 'cesis'),
				                      'subtitle'  => __('Select if you want to show the author name.', 'cesis'),

				                      'options' => array(
												'inherit' =>  __('Default', 'cesis'),
												'yes' =>  __('Yes', 'cesis'),
				                'no' =>  __('No', 'cesis'),
				             ),
										'default' => 'inherit'


				    ),
				    array(
				                      'id'        => 'cesis_meta_blog_sp_date',
				                      'type'     => 'button_set',
				                      'title'     => __('Display the Date ?', 'cesis'),
				                      'subtitle'  => __('Select if you want to show the date.', 'cesis'),

				                      'options' => array(
												'inherit' =>  __('Default', 'cesis'),
												'yes' =>  __('Yes', 'cesis'),
				                'no' =>  __('No', 'cesis'),
				             ),
										'default' => 'inherit'


				    ),
				    array(
				                      'id'        => 'cesis_meta_blog_sp_comment',
				                      'type'     => 'button_set',
				                      'title'     => __('Display the Comments number ?', 'cesis'),
				                      'subtitle'  => __('Select if you want to show the number of comments.', 'cesis'),

				                      'options' => array(
												'inherit' =>  __('Default', 'cesis'),
												'yes' =>  __('Yes', 'cesis'),
				                'no' =>  __('No', 'cesis'),
				             ),
										'default' => 'inherit'


				    ),
				    array(
				                      'id'        => 'cesis_meta_blog_sp_like',
				                      'type'     => 'button_set',
				                      'title'     => __('Display the Like button ?', 'cesis'),
				                      'subtitle'  => __('Select if you want to show the Like button.', 'cesis'),

				                      'options' => array(
												'inherit' =>  __('Default', 'cesis'),
												'yes' =>  __('Yes', 'cesis'),
				                'no' =>  __('No', 'cesis'),
				             ),
										'default' => 'inherit'


				    ),
						array(
															'id'        => 'cesis_meta_blog_sp_categories',
															'required' => array(
															array('cesis_meta_blog_custom_layout','!=','no')
															),
															'type'     => 'button_set',
															'title'     => __('Display the Categories ?', 'cesis'),
															'subtitle'  => __('Select if you want to show the categories.', 'cesis'),

															'options' => array(
												'inherit' =>  __('Default', 'cesis'),
												'yes' =>  __('Yes', 'cesis'),
												'no' =>  __('No', 'cesis'),
										 ),
										'default' => 'inherit'


						),
						array(
															'id'        => 'cesis_meta_blog_sp_tags',
															'required' => array(
															array('cesis_meta_blog_custom_layout','!=','no')
															),
															'type'     => 'button_set',
															'title'     => __('Display the Tags ?', 'cesis'),
															'subtitle'  => __('Select if you want to show the tags.', 'cesis'),

															'options' => array(
												'inherit' =>  __('Default', 'cesis'),
												'yes' =>  __('Yes', 'cesis'),
												'no' =>  __('No', 'cesis'),
										 ),
										'default' => 'inherit'


							),
            array(
                              'id'        => 'cesis_meta_blog_sp_share',
                              'required' => array(
                              array('cesis_meta_blog_custom_layout','!=','no')
                              ),
                              'type'     => 'button_set',
                              'title'     => __('Display the Share icons?', 'cesis'),
                              'subtitle'  => __('Select if you want to show the share icons.', 'cesis'),

                              'options' => array(
                        'inherit' =>  __('Default', 'cesis'),
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'yes'


              ),
        			array(
                                'id'        => 'cesis_meta_blog_sp_navigation',
                                'required' => array(
                                array('cesis_meta_blog_custom_layout','!=','no')
                                ),
                                'type'     => 'button_set',
                                'title'     => __('Display the Previous / Next Navigation?', 'cesis'),
                                'subtitle'  => __('Select if you want to show Previous and Next navigation button.', 'cesis'),

                                'options' => array(
                          'inherit' =>  __('Default', 'cesis'),
                          'yes' =>  __('Yes', 'cesis'),
                          'no' =>  __('No', 'cesis'),
        					     ),
        					    'default' => 'inherit'


        				),


        			)
            );


            $portfolio_box[] = array(
              'title'  => __( 'Layout Settings', 'cesis' ),
              'id'     => 'tt-meta-portfolio-layout',

              'subsection' => true,
              'fields'     => array(
                array(
                     'id'        => 'cesis_meta_portfolio_onepage',
                     'type'     => 'button_set',
                     'title'     => __('Active One page?', 'cesis'),
                     'subtitle'  => __('Select if you want to change the page into a "One page" page.', 'cesis'),
                     'options' => array(
                       'cesis_onepage_page' =>  __('Yes', 'cesis'),
                       'no' =>  __('No', 'cesis'),
                     ),
                     'default' => 'no'
                ),
                array(
                     'id'        => 'cesis_meta_portfolio_onepage_nav',
                     'type'      => 'select',
                     'required' => array(
                     array('cesis_meta_portfolio_onepage','!=','no')
                     ),
                     'title'     => __('Add dot navigation on the page?', 'cesis'),
                     'subtitle'  => __('Select if you want add a dot navigation on the page.', 'cesis'),
                     'options' => array(
                       'no' =>  __('No', 'cesis'),
                       'cesis_onepage_right_nav' =>  __('Right dots navigation', 'cesis'),
                       'cesis_onepage_left_nav' =>  __('Left dots navigation', 'cesis'),
                     ),
                     'default' => 'no'
                ),
                array(
                     'id'        => 'cesis_meta_portfolio_swipe',
                     'type'     => 'button_set',
                     'title'     => __('Active section swap?', 'cesis'),
                     'subtitle'  => __('Select if you want to activate the section swipe feature.', 'cesis'),
                     'options' => array(
                       'cesis_section_swipe' =>  __('Yes', 'cesis'),
                       'no' =>  __('No', 'cesis'),
                     ),
                     'default' => 'no'
                ),

            array(
                       'id'        => 'cesis_meta_portfolio_custom_layout',
                       'type'     => 'button_set',
                       'title'     => __('Use custom layout?', 'cesis'),
                       'subtitle'  => __('Select if you want to use custom layout for the post.', 'cesis'),
                       'options' => array(
                         'yes' =>  __('Yes', 'cesis'),
                         'no' =>  __('No', 'cesis'),
                       ),
                       'default' => 'no'
                     ),


            array(
                       'id'        => 'cesis_meta_portfolio_content_width',
                       'required' => array(
                       array('cesis_meta_portfolio_custom_layout','!=','no')
                       ),
                         'type'     => 'dimensions',
                         'height'     => false,
                 'units'    => array('px','%'),
                         'title'     => __('Select the Single Portfolio posts main content container width ( px or % )', 'cesis'),
                         'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                         'default' => array(
                        'width'   => '1170',
                        'units' => 'px'
                     ),
            ),
            array(
                              'id'        => 'cesis_meta_portfolio_content_top_padding',
                              'required' => array(
                              array('cesis_meta_portfolio_custom_layout','!=','no')
                              ),
                              'type'     => 'dimensions',
                              'width'     => false,
                  'units'    => array('px'),
                              'title'     => __('Select the Single Portfolio posts main content top space ( top padding px )', 'cesis'),
                              'subtitle'  => __('If no sidebar used and content build with Page builder 0 is recommended.', 'cesis'),
                              'default' => array(
                        'height'   => '0',
                        'units' => 'px'
                     ),


            ),
            array(
                              'id'        => 'cesis_meta_portfolio_content_bottom_padding',
                              'required' => array(
                              array('cesis_meta_portfolio_custom_layout','!=','no')
                              ),
                              'type'     => 'dimensions',
                              'width'     => false,
                  'units'    => array('px'),
                              'title'     => __('Select the Single Portfolio posts main content bottom space ( bottom padding px )', 'cesis'),
                              'subtitle'  => __('If no sidebar used and content build with Page builder 0 is recommended.', 'cesis'),
                              'default' => array(
                        'height'   => '0',
                        'units' => 'px'
                     ),


            ),
            array(
                    'id'       => 'cesis_meta_portfolio_sp_layout',
                    'required' => array(
                    array('cesis_meta_portfolio_custom_layout','!=','no')
                    ),
                    'type'     => 'image_select',
                    'title'    => __('Select the Single Portfolio Posts layout', 'cesis'),
                    'subtitle' => __('Select main content and sidebar alignment.', 'cesis'),
                    'options'  => array(
                        'no_sidebar'      => array(
                          'alt'   => '1 Column',
                          'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                            ),
                        'r_sidebar'      => array(
                          'alt'   => 'Sidebar Right',
                          'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                            ),
                        'l_sidebar'      => array(
                          'alt'   => 'Sidebar Left',
                          'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                            ),
                      ),
                    'default' => 'r_sidebar'
                ),
            array(
                              'id'        => 'cesis_meta_portfolio_agc',
                              'required' => array(
                              array('cesis_meta_portfolio_custom_layout','!=','no')
                              ),
                              'type'     => 'button_set',
                              'title'     => __('Display the Auto Generated content on the page ?', 'cesis'),
                              'subtitle'  => __('Select if you want to show the portfolio content auto genarated by the theme template.', 'cesis'),

                              'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'no'


            ),

            array(
                    'id'       => 'cesis_meta_portfolio_agc_layout',
                    'type'     => 'image_select',
                    'title'    => __('Select the Auto generated content layout', 'cesis'),
                    'required' => array(
                    array('cesis_meta_portfolio_agc','=','yes')
                    ),
                    'options'  => array(
                        'cesis_agc_full'      => array(
                          'alt'   => '1 Column',
                          'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                            ),
                        'cesis_agc_right'      => array(
                          'alt'   => 'Sidebar Right',
                          'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                            ),
                        'cesis_agc_left'      => array(
                          'alt'   => 'Sidebar Left',
                          'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                            ),
                      ),
                    'default' => 'cesis_agc_right'
                ),
            array(
                             'id'        => 'cesis_meta_portfolio_style',
                             'type'      => 'select',
                             'title'     => __('Select the thumbnail style', 'cesis'),
                             'subtitle'  => __('Select the thumbnail style for the auto generated content.', 'cesis'),
                             'required' => array(
                             array('cesis_meta_portfolio_agc','=','yes')
                             ),
                             //Must provide key => value pairs for select options
                             'options'   => array(
                                 'inherit' =>  __('Default', 'cesis'),
                                 'cesis_portfolio_sp_classic' => __('Classic', 'cesis'),
                                 'cesis_portfolio_sp_framed' => __('White framed', 'cesis'),
                             ),
                             'default'   => 'inherit'
                         ),

            array(
              'id'        => 'cesis_meta_portfolio_gallery_type',
              'type'      => 'select',
              'title'     => __('Select the Single portfolio gallery type', 'cesis'),
              'subtitle'  => __('Select the gallery type for the auto generated content.', 'cesis'),
              'required' => array(
              array('cesis_meta_portfolio_agc','=','yes')
              ),
              //Must provide key => value pairs for select options
              'options'   => array(
                'inherit' =>  __('Default', 'cesis'),
                'carousel' => __('Carousel', 'cesis'),
                'packery' => __('Packery', 'cesis'),
                'stacked' => __('Stacked', 'cesis'),
              ),
              'default'   => 'inherit'
              ),

              array(
              'id' => 'cesis_meta_portfolio_gallery_space',
              'type' => 'text',
              'title' => __('Select the space between the images', 'cesis'),
              'required' => array(

              array('cesis_meta_portfolio_agc','=','yes'),
              array('cesis_meta_portfolio_gallery_type','=','stacked'),

              ),
              'default'   => '0'
              ),

              array(
              'id' => 'cesis_meta_portfolio_gallery_size',
              'type' => 'select',
              'title' => __('Select the thumbnail size', 'cesis'),
              'subtitle' => __('Select the image size to used in the automatically generated content', 'cesis'),
              'required' => array(

              array('cesis_meta_portfolio_agc','=','yes')

              ),

              'options' => array(
                'inherit' =>  __('Default', 'cesis'),
                'tn_squared' => '1:1 ( squared )',
                'tn_rectangle_4_3' => '4:3  ( rectangle )',
                'tn_rectangle_3_2' => '3:2  ( rectangle )',
                'tn_landscape_16_9' => '16:9  ( landscape )',
                'tn_landscape_4_2' => '4:2  ( landscape )',
                'tn_landscape_21_9' => '21:9  ( landscape )',
                'tn_portrait_3_4' => '3:4  ( portrait )',
                'tn_portrait_2_3' => '2:3  ( portrait )',
                'tn_portrait_9_16' => '9:16  ( portrait )',
                'cesis_full' => 'full ( original size )'
              ),
              'default' => 'inherit'
            ),
        array(
                          'id'        => 'cesis_meta_portfolio_sp_share',
                          'type'     => 'button_set',
                          'title'     => __('Display the Share icons?', 'cesis'),
                          'subtitle'  => __('Select if you want to show the share icons.', 'cesis'),
                          'required' => array(

                          array('cesis_meta_portfolio_agc','=','yes')

                          ),
                          'options' => array(
                    'inherit' =>  __('Default', 'cesis'),
                    'yes' =>  __('Yes', 'cesis'),
                    'no' =>  __('No', 'cesis'),
                 ),
                'default' => 'yes'


          ),


              array(
                'id'        => 'cesis_meta_portfolio_sp_navigation',
                'required' => array(
                array('cesis_meta_portfolio_custom_layout','!=','no')
                ),
                'type'     => 'button_set',
                'title'     => __('Display the Previous / Next Navigation?', 'cesis'),
                'subtitle'  => __('Select if you want to show Previous and Next navigation button.', 'cesis'),
                'options' => array(
                  'inherit' =>  __('Default', 'cesis'),
                  'yes' =>  __('Yes', 'cesis'),
                  'no' =>  __('No', 'cesis'),
                ),
                'default' => 'inherit'
              ),

              array(
                'id'        => 'cesis_meta_portfolio_sp_navigation_style',
                'type'      => 'select',
                'title'     => __('Select the navigation style', 'cesis'),
                'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                'required'  => array('cesis_meta_portfolio_sp_navigation','=','yes'),
                //Must provide key => value pairs for select options
                'options'   => array(
                  'inherit' =>  __('Default', 'cesis'),
                  'business' => __('Classic', 'cesis'),
                  'writer' => __('Casual', 'cesis'),
                  'agency' => __('Agency', 'cesis'),
                  'careers' => __('Career', 'cesis'),
                ),
                'default'   => 'inherit'
                ),

            )
          );


          $staff_box[] = array(
            'title'  => __( 'Layout Settings', 'cesis' ),
            'id'     => 'tt-meta-staff-layout',

            'subsection' => true,
            'fields'     => array(

          array(
                     'id'        => 'cesis_meta_staff_custom_layout',
                     'type'     => 'button_set',
                     'title'     => __('Use custom layout?', 'cesis'),
                     'subtitle'  => __('Select if you want to use custom layout for the post.', 'cesis'),
                     'options' => array(
                       'yes' =>  __('Yes', 'cesis'),
                       'no' =>  __('No', 'cesis'),
                     ),
                     'default' => 'no'
                   ),

          array(
                     'id'        => 'cesis_meta_staff_content_width',
                       'type'     => 'dimensions',
                       'required' => array(
                       array('cesis_meta_staff_custom_layout','!=','no')
                       ),
                       'height'     => false,
                       'units'    => array('px','%'),
                       'title'     => __('Select the Single staff posts main content container width ( px or % )', 'cesis'),
                       'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                       'default' => array(
                      'width'   => '1170',
                      'units' => 'px'
                   ),
          ),
          array(
                            'id'        => 'cesis_meta_staff_content_top_padding',
                            'required' => array(
                            array('cesis_meta_staff_custom_layout','!=','no')
                            ),
                            'type'     => 'dimensions',
                            'width'     => false,
                'units'    => array('px'),
                            'title'     => __('Select the Single staff posts main content top space ( top padding px )', 'cesis'),
                            'subtitle'  => __('If no sidebar used and content build with Page builder 0 is recommended.', 'cesis'),
                            'default' => array(
                      'height'   => '0',
                      'units' => 'px'
                   ),


          ),
          array(
                            'id'        => 'cesis_meta_staff_content_bottom_padding',
                            'required' => array(
                            array('cesis_meta_staff_custom_layout','!=','no')
                            ),
                            'type'     => 'dimensions',
                            'width'     => false,
                'units'    => array('px'),
                            'title'     => __('Select the Single staff posts main content bottom space ( bottom padding px )', 'cesis'),
                            'subtitle'  => __('If no sidebar used and content build with Page builder 0 is recommended.', 'cesis'),
                            'default' => array(
                      'height'   => '0',
                      'units' => 'px'
                   ),


          ),
          array(
                  'id'       => 'cesis_meta_staff_sp_layout',
                  'required' => array(
                  array('cesis_meta_staff_custom_layout','!=','no')
                  ),
                  'type'     => 'image_select',
                  'title'    => __('Select the Single staff layout', 'cesis'),
                  'subtitle' => __('Select main content and sidebar alignment.', 'cesis'),
                  'options'  => array(
                      'no_sidebar'      => array(
                        'alt'   => '1 Column',
                        'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                          ),
                      'r_sidebar'      => array(
                        'alt'   => 'Sidebar Right',
                        'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                          ),
                      'l_sidebar'      => array(
                        'alt'   => 'Sidebar Left',
                        'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                          ),
                    ),
                  'default' => 'no_sidebar'
              ),
          array(
                            'id'        => 'cesis_meta_staff_agc',
                            'required' => array(
                            array('cesis_meta_staff_custom_layout','!=','no')
                            ),
                            'type'     => 'button_set',
                            'title'     => __('Display the Auto Generated content on the page ?', 'cesis'),
                            'subtitle'  => __('Select if you want to show the staff content auto genarated by the theme template.', 'cesis'),

                            'options' => array(
                      'yes' =>  __('Yes', 'cesis'),
                      'no' =>  __('No', 'cesis'),
                   ),
                  'default' => 'no'


            ),
            array(
                           'id'        => 'cesis_meta_staff_style',
                           'type'      => 'select',
                           'title'     => __('Select the Single staff posts thumbnail style', 'cesis'),
                           'subtitle'  => __('Select the thumbnail style for the auto generated content.', 'cesis'),
                           'required' => array(

                           array('cesis_meta_staff_agc','!=','no')

                           ),

                           //Must provide key => value pairs for select options
                           'options'   => array(
                               'inherit' =>  __('Default', 'cesis'),
                               'cesis_staff_sp_classic' => __('Classic', 'cesis'),
                               'cesis_staff_sp_framed' => __('White framed', 'cesis'),
                           ),
                           'default'   => 'inherit'
                         ),

                       array(
                                         'id'        => 'cesis_meta_staff_sp_navigation',
                                         'required' => array(
                                         array('cesis_meta_staff_custom_layout','!=','no')
                                         ),
                                         'type'     => 'button_set',
                                         'title'     => __('Display the Previous / Next Navigation?', 'cesis'),
                                         'subtitle'  => __('Select if you want to show Previous and Next navigation button.', 'cesis'),

                                         'options' => array(
                                   'inherit' =>  __('Default', 'cesis'),
                                   'yes' =>  __('Yes', 'cesis'),
                                   'no' =>  __('No', 'cesis'),
                                ),
                               'default' => 'inherit'


                         ),

                         array(
                                        'id'        => 'cesis_meta_staff_sp_navigation_style',
                                        'type'      => 'select',
                                        'title'     => __('Select the navigation style', 'cesis'),
                                        'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                                        'required'  => array('cesis_meta_staff_sp_navigation','!=','no'),
                                        //Must provide key => value pairs for select options
                                        'options'   => array(
                                            'inherit' =>  __('Default', 'cesis'),
                                            'business' => __('Classic', 'cesis'),
                                            'writer' => __('Casual', 'cesis'),
                                            'agency' => __('Agency', 'cesis'),
                                            'careers' => __('Career', 'cesis'),
                                        ),
                                        'default'   => 'inherit'
                          ),




          )
        );


          $career_box[] = array(
            'title'  => __( 'Layout Settings', 'cesis' ),
            'id'     => 'tt-meta-career-layout',

            'subsection' => true,
            'fields'     => array(

          array(
                     'id'        => 'cesis_meta_career_custom_layout',
                     'type'     => 'button_set',
                     'title'     => __('Use custom layout?', 'cesis'),
                     'subtitle'  => __('Select if you want to use custom layout for the post.', 'cesis'),
                     'options' => array(
                       'yes' =>  __('Yes', 'cesis'),
                       'no' =>  __('No', 'cesis'),
                     ),
                     'default' => 'no'
                   ),

          array(
                     'id'        => 'cesis_meta_career_content_width',
                       'type'     => 'dimensions',
                       'required' => array(
                       array('cesis_meta_career_custom_layout','!=','no')
                       ),
                       'height'     => false,
                       'units'    => array('px','%'),
                         'title'     => __('Select the Single career position main content container width ( px or % )', 'cesis'),
                         'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                       'default' => array(
                      'width'   => '1170',
                      'units' => 'px'
                   ),
          ),
          array(
                            'id'        => 'cesis_meta_career_content_top_padding',
                            'required' => array(
                            array('cesis_meta_career_custom_layout','!=','no')
                            ),
                            'type'     => 'dimensions',
                            'width'     => false,
                'units'    => array('px'),
                              'title'     => __('Select the Single career position main content top space ( top padding px )', 'cesis'),
                              'subtitle'  => __('If no sidebar used and content build with Page builder 0 is recommended.', 'cesis'),
                            'default' => array(
                      'height'   => '0',
                      'units' => 'px'
                   ),


          ),
          array(
                            'id'        => 'cesis_meta_career_content_bottom_padding',
                            'required' => array(
                            array('cesis_meta_career_custom_layout','!=','no')
                            ),
                            'type'     => 'dimensions',
                            'width'     => false,
                'units'    => array('px'),
                              'title'     => __('Select the Single career position main content bottom space ( bottom padding px )', 'cesis'),
                              'subtitle'  => __('If no sidebar used and content build with Page builder 0 is recommended.', 'cesis'),
                            'default' => array(
                      'height'   => '0',
                      'units' => 'px'
                   ),


          ),
          array(
                  'id'       => 'cesis_meta_career_sp_layout',
                  'required' => array(
                  array('cesis_meta_career_custom_layout','!=','no')
                  ),
                  'type'     => 'image_select',
      					    'title'    => __('Select the Single career position layout', 'cesis'),
      					    'subtitle' => __('Select main content and sidebar alignment.', 'cesis'),
                  'options'  => array(
                      'no_sidebar'      => array(
                        'alt'   => '1 Column',
                        'img'   => ReduxFramework::$_url.'assets/img/1col.png'
                          ),
                      'r_sidebar'      => array(
                        'alt'   => 'Sidebar Right',
                        'img'  => ReduxFramework::$_url.'assets/img/2cr.png'
                          ),
                      'l_sidebar'      => array(
                        'alt'   => 'Sidebar Left',
                        'img'   => ReduxFramework::$_url.'assets/img/2cl.png'
                          ),
                    ),
                  'default' => 'no_sidebar'
              ),

                       array(
                                         'id'        => 'cesis_meta_career_sp_navigation',
                                         'required' => array(
                                         array('cesis_meta_career_custom_layout','!=','no')
                                         ),
                                         'type'     => 'button_set',
                                         'title'     => __('Display the Previous / Next Navigation?', 'cesis'),
                                         'subtitle'  => __('Select if you want to show Previous and Next navigation button.', 'cesis'),

                                         'options' => array(
                                   'inherit' =>  __('Default', 'cesis'),
                                   'yes' =>  __('Yes', 'cesis'),
                                   'no' =>  __('No', 'cesis'),
                                ),
                               'default' => 'inherit'


                         ),

                         array(
                                        'id'        => 'cesis_meta_career_sp_navigation_style',
                                        'type'      => 'select',
                                        'title'     => __('Select the navigation style', 'cesis'),
                                        'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                                        'required'  => array('cesis_meta_career_sp_navigation','!=','no'),
                                        //Must provide key => value pairs for select options
                                        'options'   => array(
                                            'inherit' =>  __('Default', 'cesis'),
                                            'business' => __('Classic', 'cesis'),
                                            'writer' => __('Casual', 'cesis'),
                                            'agency' => __('Agency', 'cesis'),
                                            'careers' => __('Career', 'cesis'),
                                        ),
                                        'default'   => 'inherit'
                          ),




          )
        );


                $post_box[] = $page_box[] = $portfolio_box[] = $staff_box[] = $career_box[] = $product_box[] = array(
                  'title'  => __( 'Sidebar Settings', 'cesis' ),
                  'id'     => 'tt-meta-sidebar',

                  'subsection' => true,
                  'fields'     => array(

                  array(
                      'id' => 'cesis_meta_sidebar_select',
                      'title' => __('Sidebar', 'cesis'),
                      'desc' => 'Please select the sidebar you would like to display on this page. If no sidebar selected the page will use the default sidebar ( will only be used if page layout use sidebar ).',
                      'type' => 'select',
                      'data' => 'sidebars',
                      'default' => 'None'
                  ),

                    array(
                           'id'        => 'cesis_meta_custom_sidebar',
                           'type'     => 'button_set',
                           'title'     => __('Use custom settings?', 'cesis'),
                           'subtitle'  => __('Select if you want to use custom sidebar settings.', 'cesis'),
                           'options' => array(
                             'yes' =>  __('Yes', 'cesis'),
                             'no' =>  __('No', 'cesis'),
                           ),
                           'default' => 'no'
                         ),
                     array(
                                  'id'        => 'cesis_meta_sidebar_style',
                                  'required' => array(
                                  array('cesis_meta_custom_sidebar','!=','no')
                                  ),
                                  'type'      => 'select',
                                  'title'     => __('Select the Sidebar style', 'cesis'),
                                  'subtitle'  => __('Select the design to use for the Sidebar.', 'cesis'),


                                  //Must provide key => value pairs for select options
                                  'options'   => array(
                                      'sidebar_layout_one' => 'Business Classic',
                                      'sidebar_layout_two' => 'Writer Style ( widgets in boxes )',
                                      'sidebar_layout_three' => 'Corporate Classic',
                                  ),
                                  'default'   => 'sidebar_layout_one'
                              ),
                    array(
                                    'id'        => 'cesis_meta_sidebar_expand',
                                    'type'      => 'button_set',
                                    'required' => array(
                                    array('cesis_meta_custom_sidebar','!=','no')
                                    ),
                                    'title'     => __('Make the sidebar to have it\'s own background?', 'cesis'),
                                    'subtitle'  => __('Select yes If you want the sidebar to use a different background color.', 'cesis'),
                                    'options' => array(
            					        'yes' =>  __('Yes', 'cesis'),
            					        'no' =>  __('No', 'cesis'),
                           ),
                          'default' => 'no'
                      ),
              			array(
                                      'id'        => 'cesis_meta_sidebar_expand_bg_color',
                                      'type'      => 'color',
                                      'required'  => array('cesis_meta_sidebar_expand', '=', 'yes'),
                                      'title'     => __('Sidebar Background Color', 'cesis'),
                                      'subtitle'  => __('Background color of the Sidebar.', 'cesis'),
                                      'default'   => '#f4f4f4',
                                      'validate'  => 'color',
                    ),
                     array(
              				'id'       => 'cesis_meta_sidebar_size',
                      'required' => array(
                      array('cesis_meta_custom_sidebar','!=','no')
                      ),
              				'type'     => 'slider',
              				'title'    => __('Sidebar Size ( % ).', 'cesis'),
              				'subtitle' => __('Select the size of the sidebar, default 30% of the container width', 'cesis'),
          					'default' => '30',
          					'min' => 0,
          				    'step' => 1,
          				    'max' => 100,
          				    'display_value' => 'text',
          				),
          			array(
              				'id'       => 'cesis_meta_sidebar_space',
                      'required' => array(
                      array('cesis_meta_custom_sidebar','!=','no')
                      ),
              				'type'     => 'slider',
              				'title'    => __('Space between Sidebar and Content ( px ).', 'cesis'),
              				'subtitle' => __('Select the size between the sidebar and the Page content 30px', 'cesis'),
          					'default' => '30',
          					'min' => 0,
          				    'step' => 1,
          				    'max' => 150,
          				    'display_value' => 'text',
          				),

          			array(
                                  'id'        => 'cesis_meta_sidebar_bottom_padding',
                                  'required' => array(
                                  array('cesis_meta_custom_sidebar','!=','no')
                                  ),
                                  'type'     => 'dimensions',
                                  'width'     => false,
          						'units'    => array('px'),
                                  'title'     => __('Select the Sidebar Widget bottom padding ( bottom space ) size', 'cesis'),
                                  'subtitle'  => __('Set the space height after the widgets, default 60px.', 'cesis'),
                                  'default' => array(
          					        'height'   => '60',
                            'units' => 'px'
          					     ),


          			),
          			array(
                                  'id'        => 'cesis_meta_sidebar_heading_space',
                                  'required' => array(
                                  array('cesis_meta_custom_sidebar','!=','no')
                                  ),
                                  'type'     => 'dimensions',
                                  'width'     => false,
          						'units'    => array('px'),
                                  'title'     => __('Select space height between the Widget Heading and Widget content', 'cesis'),
                                  'subtitle'  => __('Set the height you want to use to separate the Widget heading and content.', 'cesis'),
                                  'default' => array(
          					        'height'   => '40',
                            'units' => 'px'
          					     ),


          			),
          			array(
          						'id'          => 'cesis_meta_sidebar_widget_font',
                      'required' => array(
                      array('cesis_meta_custom_sidebar','!=','no')
                      ),
          					    'type'        => 'typography',
                                  'title'     => __('Sidebar Widget Heading font', 'cesis'),
                                  'subtitle'  => __('Choose the footer widget heading font.', 'cesis'),
          					    'google'      => true,
          					    'font-backup' => true,
          					    'color' => false,
          					    'units'       =>'px',
          						'line-height' => false,
          						'text-align' => false,
          						'letter-spacing' => true,
          						'text-transform' => true,
          					    'default'     => array(
          					        'font-weight'  => '600',
          					        'google'      => true,
          					        'font-size'   => '16px',
          							'letter-spacing' => '1px',
          							'text-transform' => 'uppercase',
          					    ),
          				),
          			array(
                                  'id'        => 'cesis_meta_sidebar_bg_color',
                                  'required' => array(
                                  array('cesis_meta_custom_sidebar','!=','no')
                                  ),
                                  'type'      => 'color',
                                  'required'  => array('cesis_meta_sidebar_style', '=', 'sidebar_layout_two'),
                                  'title'     => __('Sidebar Background Color', 'cesis'),
                                  'subtitle'  => __('Background color of the Sidebar.', 'cesis'),
                                  'default'   => '#ffffff',
                                  'validate'  => 'color',
                              ),
          			array(
                                  'id'        => 'cesis_meta_sidebar_heading_color',
                                  'required' => array(
                                  array('cesis_meta_custom_sidebar','!=','no')
                                  ),
                                  'type'      => 'color',
                                  'title'     => __('Sidebar Heading Color', 'cesis'),
                                  'subtitle'  => __('Heading color of the Sidebar.', 'cesis'),
                                  'default'   => '#293340',
                                  'validate'  => 'color',
                              ),
          			array(
                                  'id'        => 'cesis_meta_sidebar_text_color',
                                  'required' => array(
                                  array('cesis_meta_custom_sidebar','!=','no')
                                  ),
                                  'type'      => 'color',
                                  'title'     => __('Sidebar Text Color', 'cesis'),
                                  'subtitle'  => __('Text Color of the Sidebar.', 'cesis'),
                                  'default'   => '#6d7783',
                                  'validate'  => 'color',
                              ),


                  )
              );

        $post_box[] = $page_box[] = $portfolio_box[] = $staff_box[] = $career_box[] = $product_box[] = array(
          'title'  => __( 'Colors Settings', 'cesis' ),
          'id'     => 'tt-meta-main-color',

          'subsection' => true,
          'fields'     => array(

        array(
             'id'   => 'cesis_meta_main_content_color_info_box',
             'type' => 'info',
             'style' => 'success',
             'title' => __('MAIN COLOR SETTINGS.', 'cesis'),
             'desc' => __('Color settings, will be used for the main content area.', 'cesis')
        ),

        array(
                 'id'        => 'cesis_meta_main_custom_color',
                 'type'     => 'button_set',
                 'title'     => __('Use custom settings?', 'cesis'),
                 'subtitle'  => __('Select if you want to use custom color.', 'cesis'),
                 'options' => array(
                   'yes' =>  __('Yes', 'cesis'),
                   'no' =>  __('No', 'cesis'),
                 ),
                 'default' => 'no'
        ),

        array(
                     'id'        => 'cesis_meta_main_content_bg',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content background color', 'cesis'),
                     'subtitle'  => __('Background color of the main content area.', 'cesis'),
                     'default'   => '#ffffff',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_border',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content border color', 'cesis'),
                     'subtitle'  => __('Border color of the main content area.', 'cesis'),
                     'default'   => '#ececec',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_heading',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content heading / bold color', 'cesis'),
                     'subtitle'  => __('Heading and Bold element color of the main content area.', 'cesis'),
                     'default'   => '#293340',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_color',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content text color', 'cesis'),
                     'subtitle'  => __('Text color of the main content area.', 'cesis'),
                     'default'   => '#6d7783',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_light_color',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content light text color', 'cesis'),
                     'subtitle'  => __('Light Text color for main content area.', 'cesis'),
                     'default'   => '#aeb7c1',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_accent_one',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content first Accent color', 'cesis'),
                     'subtitle'  => __('First Accent color of the main content area.', 'cesis'),
                     'default'   => '#3a78ff',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_accent_two',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content Second Accent color', 'cesis'),
                     'subtitle'  => __('Second Accent color of the main content area.', 'cesis'),
                     'default'   => '#4251f4',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_accent_three',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content Third Accent color', 'cesis'),
                     'subtitle'  => __('Third Accent color of the main content area.', 'cesis'),
                     'default'   => '#acd373',
                     'validate'  => 'color',
            ),
        array(
             'id'   => 'cesis_meta_main_content_alt_color_info_box',
             'required' => array(
             array('cesis_meta_main_custom_color','!=','no')
             ),
             'type' => 'info',
             'style' => 'success',
             'title' => __('ALTERNATE COLOR SETTINGS.', 'cesis'),
             'desc' => __('Alternate Color settings, will be used for the main content sub-area ( grey area in our default design ).', 'cesis')
        ),
        array(
                     'id'        => 'cesis_meta_main_content_alt_bg',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content altermate background color', 'cesis'),
                     'subtitle'  => __('Background color of the main content alternate area ( grey area in our default design ).', 'cesis'),
                     'default'   => '#f7f9fb',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_alt_border',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content alternate border color', 'cesis'),
                     'subtitle'  => __('Border color of the main content alternate area.', 'cesis'),
                     'default'   => '#dfdfdf',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_alt_heading',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content alternate heading / bold color', 'cesis'),
                     'subtitle'  => __('Heading and Bold element color of the main content alternate area.', 'cesis'),
                     'default'   => '#293340',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_alt_color',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content alternate text color', 'cesis'),
                     'subtitle'  => __('Text color of the main content alternate area.', 'cesis'),
                     'default'   => '#aeb7c1',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_alt_light_color',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content alternate light text color', 'cesis'),
                     'subtitle'  => __('Light Text color for main content alternate area.', 'cesis'),
                     'default'   => '#aeb7c1',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_alt_accent_one',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content alternate first Accent color', 'cesis'),
                     'subtitle'  => __('First Accent color of the main content alternate area.', 'cesis'),
                     'default'   => '#3a78ff',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_alt_accent_two',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content alternate Second Accent color', 'cesis'),
                     'subtitle'  => __('Second Accent color of the main content alternate area.', 'cesis'),
                     'default'   => '#4251f4',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_alt_accent_three',
                     'required' => array(
                     array('cesis_meta_main_custom_color','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Main content alternate Third Accent color', 'cesis'),
                     'subtitle'  => __('Third Accent color of the main content alternate area.', 'cesis'),
                     'default'   => '#acd373',
                     'validate'  => 'color',
            ),

        array(
             'id'   => 'cesis_meta_main_content_buttons_info_box',
             'type' => 'info',
             'style' => 'success',
             'title' => __('BUTTONS COLOR SETTINGS.', 'cesis'),
             'desc' => __('Buttons and Button like elements ( tag cloud etc... ) Color settings for the main area ( Two different button options available ).', 'cesis')
        ),

        array(
                 'id'        => 'cesis_meta_main_custom_button',
                 'type'     => 'button_set',
                 'title'     => __('Use custom settings?', 'cesis'),
                 'subtitle'  => __('Select if you want to use custom color for the buttons.', 'cesis'),
                 'options' => array(
                   'yes' =>  __('Yes', 'cesis'),
                   'no' =>  __('No', 'cesis'),
                 ),
                 'default' => 'no'
        ),
        array(
                     'id'        => 'cesis_meta_main_content_button_text',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('First Button text color', 'cesis'),
                     'subtitle'  => __('Button text color.', 'cesis'),
                     'default'   => '#ffffff',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_button_background',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color_rgba',
                     'title'     => __('First Button background color', 'cesis'),
                     'subtitle'  => __('Button background color.', 'cesis'),
             'default'   => array(
                    'color'     => '#3a78ff',
                  'alpha'     => 1
                ),
              'options'       => array(
                    'clickout_fires_change' => true,
              ),
            ),
        array(
                     'id'        => 'cesis_meta_main_content_button_border',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color_rgba',
                     'title'     => __('First Button border color', 'cesis'),
                     'subtitle'  => __('Button border color.', 'cesis'),
             'default'   => array(
                    'color'     => '#3a78ff',
                  'alpha'     => 1
              ),
            'options'  => array(
                    'clickout_fires_change' => true,
            ),
            ),
        array(
                     'id'        => 'cesis_meta_main_content_button_hover_text',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('First Button hover text color', 'cesis'),
                     'subtitle'  => __('Button hover text color.', 'cesis'),
                     'default'   => '#ffffff',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_button_hover_background',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color_rgba',
                     'title'     => __('First Button hover background color', 'cesis'),
                     'subtitle'  => __('Button hover background color.', 'cesis'),
             'default'   => array(
                    'color'     => '#2a2d2e',
                  'alpha'     => 1
                ),
              'options'       => array(
                    'clickout_fires_change' => true,
              ),
            ),
        array(
                     'id'        => 'cesis_meta_main_content_button_hover_border',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color_rgba',
                     'title'     => __('First Button Hover border color', 'cesis'),
                     'subtitle'  => __('Button Hover border color.', 'cesis'),
             'default'   => array(
                    'color'     => '#2a2d2e',
                  'alpha'     => 1
              ),
            'options'  => array(
                    'clickout_fires_change' => true,
            ),
            ),

        array(
                     'id'        => 'cesis_meta_main_content_alt_button_text',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Second Button text color', 'cesis'),
                     'subtitle'  => __('Button text color.', 'cesis'),
                     'default'   => '#293340',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_alt_button_background',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color_rgba',
                     'title'     => __('Second Button background color', 'cesis'),
                     'subtitle'  => __('Button background color.', 'cesis'),
             'default'   => array(
                    'color'     => '#f4f4f4',
                  'alpha'     => 1
                ),
              'options'       => array(
                    'clickout_fires_change' => true,
              ),
            ),
        array(
                     'id'        => 'cesis_meta_main_content_alt_button_border',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color_rgba',
                     'title'     => __('Second Button border color', 'cesis'),
                     'subtitle'  => __('Button border color.', 'cesis'),
             'default'   => array(
                    'color'     => '#ececec',
                  'alpha'     => 1
              ),
            'options'  => array(
                    'clickout_fires_change' => true,
            ),
            ),
        array(
                     'id'        => 'cesis_meta_main_content_alt_button_hover_text',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Second Button hover text color', 'cesis'),
                     'subtitle'  => __('Button hover text color.', 'cesis'),
                     'default'   => '#ffffff',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_alt_button_hover_background',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color_rgba',
                     'title'     => __('Second Button hover background color', 'cesis'),
                     'subtitle'  => __('Button hover background color.', 'cesis'),
             'default'   => array(
                    'color'     => '#3a78ff',
                  'alpha'     => 1
                ),
              'options'       => array(
                    'clickout_fires_change' => true,
              ),
            ),
        array(
                     'id'        => 'cesis_meta_main_content_alt_button_hover_border',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color_rgba',
                     'title'     => __('Second Button Hover border color', 'cesis'),
                     'subtitle'  => __('Button Hover border color.', 'cesis'),
             'default'   => array(
                    'color'     => '#3a78ff',
                  'alpha'     => 1
              ),
            'options'  => array(
                    'clickout_fires_change' => true,
            ),
            ),

        array(
                     'id'        => 'cesis_meta_main_content_sub_button_text',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Third Button text color', 'cesis'),
                     'subtitle'  => __('Button text color.', 'cesis'),
                     'default'   => '#14171d',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_sub_button_background',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color_rgba',
                     'title'     => __('Third Button background color', 'cesis'),
                     'subtitle'  => __('Button background color.', 'cesis'),
             'default'   => array(
                    'color'     => '#ffffff',
                  'alpha'     => 1
                ),
              'options'       => array(
                    'clickout_fires_change' => true,
              ),
            ),
        array(
                     'id'        => 'cesis_meta_main_content_sub_button_border',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color_rgba',
                     'title'     => __('Third Button border color', 'cesis'),
                     'subtitle'  => __('Button border color.', 'cesis'),
             'default'   => array(
                    'color'     => '#ffffff',
                  'alpha'     => 1
              ),
            'options'  => array(
                    'clickout_fires_change' => true,
            ),
            ),
        array(
                     'id'        => 'cesis_meta_main_content_sub_button_hover_text',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color',
                     'title'     => __('Third Button hover text color', 'cesis'),
                     'subtitle'  => __('Button hover text color.', 'cesis'),
                     'default'   => '#ffffff',
                     'validate'  => 'color',
            ),
        array(
                     'id'        => 'cesis_meta_main_content_sub_button_hover_background',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color_rgba',
                     'title'     => __('Third Button hover background color', 'cesis'),
                     'subtitle'  => __('Button hover background color.', 'cesis'),
             'default'   => array(
                    'color'     => '#14171d',
                  'alpha'     => 1
                ),
              'options'       => array(
                    'clickout_fires_change' => true,
              ),
            ),
        array(
                     'id'        => 'cesis_meta_main_content_sub_button_hover_border',
                     'required' => array(
                     array('cesis_meta_main_custom_button','!=','no')
                     ),
                     'type'      => 'color_rgba',
                     'title'     => __('Third Button Hover border color', 'cesis'),
                     'subtitle'  => __('Button Hover border color.', 'cesis'),
             'default'   => array(
                    'color'     => '#14171d',
                  'alpha'     => 1
              ),
            'options'  => array(
                    'clickout_fires_change' => true,
            ),
            ),

          )
      );



        $post_box[] = $page_box[] = $portfolio_box[] = $staff_box[] = $career_box[] = $product_box[] = array(
            'title'      => __( 'Pre-Footer settings', 'cesis' ),
            'desc'       => __( 'Pre-footer settings', 'cesis' ),
            'id'         => 'tt-meta-prefooter',
            'icon'         => 'fa-film ',
            'fields'     => array(
                array(
                            'id'        => 'cesis_meta_prefooter',
                            'type'      => 'button_set',
                            'title'     => __('Banner type', 'cesis'),
                            'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                            'options' => array(
                      'inherit' => __('Default', 'cesis'),
                      'none' => __('No Banner', 'cesis'),
                      'content' => __('Content Block', 'cesis'),
                      'slider' => __('Slider Revolution', 'cesis'),
		                  'layerslider' => __('LayerSlider', 'cesis'),
                   ),
                  'default' => 'inherit'
              ),
              array(
                            'id'        => 'cesis_meta_pf_block_content',
                            'type'      => 'select',
                            'required'  => array('cesis_meta_prefooter','=','content'),
                            'title'     => __('Select the Block content to use', 'cesis'),
                            'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                            //Must provide key => value pairs for select options
                            'data'   => "content_block",
                                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                            'default'   => ''
              ),
              array(
                            'id'        => 'cesis_meta_pf_rev_slider',
                            'type'      => 'select',
              						  'required'  => array('cesis_meta_prefooter','=','slider'),
                            'title'     => __('Select the Slider revolution to use', 'cesis'),
                            'subtitle'  => __('You need to have at least one slider created', 'cesis'),
    			                  'options' => $rev_sliders,
                            'default'   => ''
              ),
		          array(
		                        'id'        => 'cesis_meta_pf_layer_slider',
		                        'type'      => 'select',
		          						  'required'  => array('cesis_meta_prefooter','=','layerslider'),
		                        'title'     => __('Select the Layerslider to use', 'cesis'),
		                        'subtitle'  => __('You need to have at least one slider created', 'cesis'),
					                  'options' => $layerslider_array,
		                        'default'   => ''
		          ),
            )
        );

        $post_box[] = $page_box[] = $portfolio_box[] = $staff_box[] = $career_box[] = $product_box[] = array(
          'title'  => __( 'Footer Settings', 'cesis' ),
          'id'     => 'tt-meta-footer',
          'icon'   => 'fa-footer ',
          'fields'     => array(
            array(
                          'id'        => 'cesis_meta_footer_fixed',
                          'type'      => 'button_set',
                          'title'     => __('Use fixed footer?', 'cesis'),
                          'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                          'options' => array(
                    'inherit' =>  __('Default', 'cesis'),
                    'cesis_fixed_footer' =>  __('Yes', 'cesis'),
                    'no' =>  __('No', 'cesis'),
                 ),
                'default' => 'inherit'
            ),
          )
        );

        $post_box[] = $page_box[] = $portfolio_box[] = $staff_box[] = $career_box[] = $product_box[] = array(
            'title'      => __( 'Footer Main Area', 'cesis' ),
            'desc'       => __( 'All the settings for the Footer Main Area ( Widgets Part ) For full documentation on this field, visit: ', 'cesis' ) . '<a href="http://docs.reduxframework.com/core/fields/text/" target="_blank">Cesis Header Top Bar Documentation</a>',
            'id'         => 'tt-meta-footer-main',
            'subsection' => true,
            'fields'     => array(

              array(
                          'id'        => 'cesis_meta_footer',
                          'type'      => 'button_set',
                          'title'     => __('Display the Footer main area?', 'cesis'),
                          'subtitle'  => __('If you want to show the Footer top part ( widget space ) select yes.', 'cesis'),
                          'options' => array(
                    'inherit' =>  __('Default', 'cesis'),
                    'yes' =>  __('Yes', 'cesis'),
                    'no' =>  __('No', 'cesis'),
                 ),
                'default' => 'inherit'
              ),
                        array(
                          'id' => 'cesis_meta_custom_footer',
                          'required' => array(
                            array('cesis_meta_footer','not','no')
                          ),
                          'type' => 'button_set',
                          'title' => __('Use custom settings?', 'cesis'),
                          'options' => array(
                          'yes' => __('Yes', 'cesis'),
                          'no' => __('No', 'cesis'),
                          ),
                        'default' => 'no'
                        ),

          array(
               'id'   => 'cesis_meta_footer_layout_info_box',
               'required' => array(
                 array('cesis_meta_custom_footer','not','no')
               ),
               'type' => 'info',
               'style' => 'success',
               'title' => __('LAYOUT SETTINGS.', 'cesis'),
               'desc' => __('Footer Layout and Space settings ).', 'cesis')
          ),

          array(
                     'id'        => 'cesis_meta_footer_width',
                     'required' => array(
                       array('cesis_meta_custom_footer','not','no')
                     ),
                       'type'     => 'dimensions',
                       'height'     => false,
               'units'    => array('px','%'),
                       'title'     => __('Select the Footer container width ( px or % )', 'cesis'),
                       'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                       'default' => array(
                      'width'   => '1170',
                      'units' => 'px'
                   ),
          ),
          array(
                            'id'        => 'cesis_meta_footer_top_padding',
                            'required' => array(
                              array('cesis_meta_custom_footer','not','no')
                            ),
                            'type'     => 'dimensions',
                            'width'     => false,
                'units'    => array('px'),
                            'title'     => __('Select the Footer top padding ( top space ) size', 'cesis'),
                            'subtitle'  => __('Set the space height before the widgets, default 60px.', 'cesis'),
                            'default' => array(
                      'height'   => '60',
                      'units' => 'px'
                   ),


          ),
          array(
                            'id'        => 'cesis_meta_footer_bottom_padding',
                            'required' => array(
                              array('cesis_meta_custom_footer','not','no')
                            ),
                            'type'     => 'dimensions',
                            'width'     => false,
                'units'    => array('px'),
                            'title'     => __('Select the Footer bottom padding ( bottom space ) size', 'cesis'),
                            'subtitle'  => __('Set the space height after the widgets, default 60px.', 'cesis'),
                            'default' => array(
                      'height'   => '60',
                      'units' => 'px'
                   ),


          ),
          array(
                            'id'        => 'cesis_meta_footer_widget_padding',
                            'required' => array(
                              array('cesis_meta_custom_footer','not','no')
                            ),
                            'type'     => 'dimensions',
                            'width'     => false,
                'units'    => array('px'),
                            'title'     => __('Select the Footer Widget bottom padding ( bottom space ) size', 'cesis'),
                            'subtitle'  => __('Set the space height after ( between ) the widgets, default 70px.', 'cesis'),
                            'default' => array(
                      'height'   => '70',
                      'units' => 'px'
                   ),


          ),
          array(
                            'id'        => 'cesis_meta_footer_heading_space',
                            'required' => array(
                              array('cesis_meta_custom_footer','not','no')
                            ),
                            'type'     => 'dimensions',
                            'width'     => false,
                'units'    => array('px'),
                            'title'     => __('Select space height between the Widget Heading and Widget content', 'cesis'),
                            'subtitle'  => __('Set the height you want to use to separate the Widget heading and content.', 'cesis'),
                            'default' => array(
                      'height'   => '40',
                      'units' => 'px'
                   ),


          ),
          array(
                            'id'        => 'cesis_meta_footer_columns',
                            'required' => array(
                              array('cesis_meta_custom_footer','not','no')
                            ),
                            'type'      => 'select',
                            'title'     => __('Footer Columns', 'cesis'),
                            'subtitle'  => __('If you want to show the Footer top part ( widget space ) select yes.', 'cesis'),
                            'options' => array(
                      '0' => 'No columns',
                      '1' => '1',
                      '2' => '2',
                      '3' => '3',
                      '4' => '4',
                      '5' => '5',
                   ),
                  'default' => '4'
              ),
          array(
               'id'   => 'cesis_meta_footer_color_info_box',
               'required' => array(
                 array('cesis_meta_custom_footer','not','no')
               ),
               'type' => 'info',
               'style' => 'success',
               'title' => __('COLOR / FONT SETTINGS.', 'cesis'),
               'desc' => __('Footer color and font settings ).', 'cesis')
          ),
           array(
                'id'          => 'cesis_meta_footer_widget_font',
                'required' => array(
                  array('cesis_meta_custom_footer','not','no')
                ),
                  'type'        => 'typography',
                            'title'     => __('Footer Widget Heading font', 'cesis'),
                            'subtitle'  => __('Choose the footer widget heading font.', 'cesis'),
                  'google'      => true,
                  'font-backup' => true,
                  'color' => false,
                  'units'       =>'px',
                'line-height' => false,
                'text-align' => false,
                'letter-spacing' => true,
                'text-transform' => true,
                  'default'     => array(
                      'font-weight'  => '600',
                      'google'      => true,
                      'font-size'   => '16px',
                  'letter-spacing' => '1px',
                  'text-transform' => 'uppercase',
                  ),
            ),
          array(
                            'id'        => 'cesis_meta_footer_bg_color',
                            'required' => array(
                              array('cesis_meta_custom_footer','not','no')
                            ),
                            'type'      => 'color',
                            'title'     => __('Footer main part Background Color', 'cesis'),
                            'subtitle'  => __('Background color of the Footer main part.', 'cesis'),
                            'default'   => '#2a2d2e',
                            'validate'  => 'color',
                        ),
          array(
                            'id'        => 'cesis_meta_footer_heading_color',
                            'required' => array(
                              array('cesis_meta_custom_footer','not','no')
                            ),
                            'type'      => 'color',
                            'title'     => __('Footer main part Heading Color', 'cesis'),
                            'subtitle'  => __('Heading color of the Footer main part.', 'cesis'),
                            'default'   => '#ffffff',
                            'validate'  => 'color',
                        ),
          array(
                            'id'        => 'cesis_meta_footer_text_color',
                            'required' => array(
                              array('cesis_meta_custom_footer','not','no')
                            ),
                            'type'      => 'color',
                            'title'     => __('Footer main part Text Color', 'cesis'),
                            'subtitle'  => __('Text Color of the Footer main part.', 'cesis'),
                            'default'   => '#aeb7c1',
                            'validate'  => 'color',
                        ),
          array(
                            'id'        => 'cesis_meta_footer_hl_color',
                            'required' => array(
                              array('cesis_meta_custom_footer','not','no')
                            ),
                            'type'      => 'color',
                            'title'     => __('Footer main part highlight color', 'cesis'),
                            'subtitle'  => __('Highlight color of the Footer main part.', 'cesis'),
                            'default'   => '#ffffff',
                            'validate'  => 'color',
                        ),
          array(
                            'id'        => 'cesis_meta_footer_hover_color',
                            'required' => array(
                              array('cesis_meta_custom_footer','not','no')
                            ),
                            'type'      => 'color',
                            'title'     => __('Footer main part hover color', 'cesis'),
                            'subtitle'  => __('Hover color of the Footer main part.', 'cesis'),
                            'default'   => '#3a78ff',
                            'validate'  => 'color',
                        ),
          array(
                            'id'        => 'cesis_meta_footer_border_color',
                            'required' => array(
                              array('cesis_meta_custom_footer','not','no')
                            ),
                            'type'      => 'color',
                            'title'     => __('Footer main part border color', 'cesis'),
                            'subtitle'  => __('Border color of the Footer main part.', 'cesis'),
                            'default'   => '#474b4c',
                            'validate'  => 'color',
                        ),

        )
        );


        $post_box[] = $page_box[] = $portfolio_box[] = $staff_box[] = $career_box[] = $product_box[] = array(
            'title'      => __( 'Footer Sub Area', 'cesis' ),
            'desc'       => __( 'All the settings for the Footer Sub Area ( Social Icons, Menu, Creditentials etc ) For full documentation on this field, visit: ', 'cesis' ) . '<a href="http://docs.reduxframework.com/core/fields/textarea/" target="_blank">http://docs.reduxframework.com/core/fields/textarea/</a>',
            'id'         => 'tt-meta-footer-sub',
            'subsection' => true,
            'fields'     => array(

              array(
                        'id'        => 'cesis_meta_footer_bar',
                        'type'      => 'button_set',
                        'title'     => __('Display the Footer under bar?', 'cesis'),
                        'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                        'options' => array(
                  'inherit' =>  __('Default', 'cesis'),
                  'yes' =>  __('Yes', 'cesis'),
                  'no' =>  __('No', 'cesis'),
               ),
              'default' => 'inherit'
              ),
          array(
            'id' => 'cesis_meta_custom_footer_bar',
            'required' => array(
              array('cesis_meta_footer_bar','not','no')
            ),
            'type' => 'button_set',
            'title' => __('Use custom settings?', 'cesis'),
            'options' => array(
            'yes' => __('Yes', 'cesis'),
            'no' => __('No', 'cesis'),
            ),
          'default' => 'no'
          ),


          array(
                     'id'        => 'cesis_meta_footer_bar_width',
                     'required' => array(
                       array('cesis_meta_custom_footer_bar','not','no')
                     ),
                       'type'     => 'dimensions',
                       'height'     => false,
               'units'    => array('px','%'),
                       'title'     => __('Select the Footer sub part container width ( px or % )', 'cesis'),
                       'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                       'default' => array(
                      'width'   => '1170',
                      'units' => 'px'
                   ),
          ),

          array(
                            'id'        => 'cesis_meta_footer_bar_height',
                            'required' => array(
                              array('cesis_meta_custom_footer_bar','not','no')
                            ),
                            'type'     => 'dimensions',
                            'width'     => false,
                            'units'    => array('px'),
                            'title'     => __('Select the Footer sub part size ( height )', 'cesis'),
                            'subtitle'  => __('The default is 100px but you may want to make it bigger if you insert a lot of element on the same place.', 'cesis'),
                            'default' => array(
                      'height'   => '100',
                      'units' => 'px'
                   ),


          ),
          array(
                            'id'        => 'cesis_meta_footer_bar_bg_color',
                            'required' => array(
                              array('cesis_meta_custom_footer_bar','not','no')
                            ),
                            'type'      => 'color',
                            'title'     => __('Footer sub part Background Color', 'cesis'),
                            'subtitle'  => __('Background color of the Footer sub part.', 'cesis'),
                            'default'   => '#191a1b',
                            'validate'  => 'color',
                        ),
          array(
                            'id'        => 'cesis_meta_footer_bar_text_color',
                            'required' => array(
                              array('cesis_meta_custom_footer_bar','not','no')
                            ),
                            'type'      => 'color',
                            'title'     => __('Footer sub part Text Color', 'cesis'),
                            'subtitle'  => __('Text Color of the Footer sub part.', 'cesis'),
                            'default'   => '#aeb7c1',
                            'validate'  => 'color',
                        ),
          array(
                            'id'        => 'cesis_meta_footer_bar_hl_color',
                            'required' => array(
                              array('cesis_meta_custom_footer_bar','not','no')
                            ),
                            'type'      => 'color',
                            'title'     => __('Footer sub part highlight color', 'cesis'),
                            'subtitle'  => __('Highlight color of the Footer sub part.', 'cesis'),
                            'default'   => '#6d7783',
                            'validate'  => 'color',
                        ),
          array(
                            'id'        => 'cesis_meta_footer_bar_hover_color',
                            'required' => array(
                              array('cesis_meta_custom_footer_bar','not','no')
                            ),
                            'type'      => 'color',
                            'title'     => __('Footer sub part hover color', 'cesis'),
                            'subtitle'  => __('Hover color of the Footer sub part.', 'cesis'),
                            'default'   => '#ffffff',
                            'validate'  => 'color',
                        ),
          array(
                  'id'      => 'cesis_footer_bar_sorter_meta',
                  'required' => array(
                    array('cesis_meta_custom_footer_bar','not','no')
                  ),
                  'type'    => 'sorter',
                  'title'   => 'Footer Sub Area layout manager',
                  'desc'    => 'Organize how you want the layout to appear on the Footer Sub Area',
                  'options' => array(
                      'left'  => array(
                  ),
                     'center' => array(
                      ),
                     'right' => array(
                      ),
                     'disabled' => array(
                          'f_text_one' => 'Text 1',
                          'f_text_two'     => 'Text 2',
                          'f_text_three' => 'Text 3',
                          'f_social_icons'   => 'Social Icons',
                          'f_back_to_top'   => 'Back to top',
                          'f_menu'   => 'Footer Menu',
                  ),
                  ),
              ),
              array(
                    'id'          => 'cesis_meta_footer_menu_font',
                    'required' => array(
                      array('cesis_meta_custom_footer_bar','not','no')
                    ),
                      'type'        => 'typography',
                                'title'     => __('Footer Menu font', 'cesis'),
                                'subtitle'  => __('Choose the footer menu font.', 'cesis'),
                      'google'      => true,
                      'font-backup' => true,
                      'color' => false,
                      'units'       =>'px',
                    'line-height' => false,
                    'text-align' => false,
                    'letter-spacing' => true,
                    'text-transform' => true,
                      'default'     => array(
                          'font-weight'  => '600',
                          'google'      => true,
                          'font-size'   => '16px',
                      'letter-spacing' => '1px',
                      'text-transform' => 'uppercase',
                      ),
                ),

                        array(
                            'id'       => 'cesis_meta_footer_menu_space',
                            'required' => array(
                              array('cesis_meta_custom_footer_bar','not','no')
                            ),
                            'type'     => 'slider',
                            'title'    => __('Menu Items Space.', 'cesis'),
                            'subtitle' => __('Set the space between menu items', 'cesis'),
                          'default' => '10',
                          'min' => 1,
                            'step' => 1,
                            'max' => 30,
                            'display_value' => 'text',
                        ),

        array(
          'id'       => 'cesis_meta_footer_text_size',
					'required' => array(
						array('cesis_meta_custom_footer_bar','not','no')
					),
          'type'     => 'slider',
          'title'    => __('Footer text elements size.', 'cesis'),
          'subtitle' => __('Set the sub footer text elements text size', 'cesis'),
          'default' => '13',
          'min' => 1,
          'step' => 1,
          'max' => 50,
          'display_value' => 'text',
        ),
            array(
                'id'       => 'cesis_meta_footer_text_one',
                'required' => array(
                  array('cesis_meta_custom_footer_bar','not','no')
                ),
                'type'     => 'editor',
                'title'    => __('Text 1', 'cesis'),
                'subtitle' => __('You can put text / html in this field, will be used if selected in the sorter ', 'cesis'),
                'default'  => ''
          ),

            array(
                'id'       => 'cesis_meta_footer_text_two',
                'required' => array(
                  array('cesis_meta_custom_footer_bar','not','no')
                ),
                'type'     => 'editor',
                'title'    => __('Text 2', 'cesis'),
                'subtitle' => __('You can put text / html in this field, will be used if selected in the sorter ', 'cesis'),
                'default'  => ''
          ),

            array(
                'id'       => 'cesis_meta_footer_text_three',
                'required' => array(
                  array('cesis_meta_custom_footer_bar','not','no')
                ),
                'type'     => 'editor',
                'title'    => __('Text 3', 'cesis'),
                'subtitle' => __('You can put text / html in this field, will be used if selected in the sorter ', 'cesis'),
                'default'  => ''
          ),



         )
        );




        $metaboxes = array();

        $metaboxes[] = array(
            'id' => 'page_options',
            'title' => __('Page options', 'cesis'),
            'post_types' => array(
                'page'
            ),
            //'page_template' => array('page-test.php'),
            //'post_format' => array('image'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            //'sidebar' => false, // enable/disable the sidebar in the normal/advanced positions
            'sections' => $page_box
        );


        $metaboxes[] = array(
            'id' => 'post_options',
            'title' => __('Post options', 'cesis'),
            'post_types' => array(
                'post'
            ),
            //'page_template' => array('page-test.php'),
            //'post_format' => array('image'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            //'sidebar' => false, // enable/disable the sidebar in the normal/advanced positions
            'sections' => $post_box
        );


        $metaboxes[] = array(
            'id' => 'portfolio_options',
            'title' => __('Portfolio options', 'cesis'),
            'post_types' => array(
                'portfolio'
            ),
            //'page_template' => array('page-test.php'),
            //'post_format' => array('image'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            //'sidebar' => false, // enable/disable the sidebar in the normal/advanced positions
            'sections' => $portfolio_box
        );


        $metaboxes[] = array(
            'id' => 'partners_options',
            'title' => __('Partner options', 'cesis'),
            'post_types' => array(
                'partners'
            ),
            //'page_template' => array('page-test.php'),
            //'post_format' => array('image'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            //'sidebar' => false, // enable/disable the sidebar in the normal/advanced positions
            'sections' => $partners_box
        );

        $metaboxes[] = array(
            'id' => 'staff_options',
            'title' => __('Staff options', 'cesis'),
            'post_types' => array(
                'staff'
            ),
            //'page_template' => array('page-test.php'),
            //'post_format' => array('image'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            //'sidebar' => false, // enable/disable the sidebar in the normal/advanced positions
            'sections' => $staff_box
        );

        $metaboxes[] = array(
            'id' => 'career_options',
            'title' => __('Career options', 'cesis'),
            'post_types' => array(
                'careers'
            ),
            //'page_template' => array('page-test.php'),
            //'post_format' => array('image'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'high', // high, core, default, low
            //'sidebar' => false, // enable/disable the sidebar in the normal/advanced positions
            'sections' => $career_box
        );



        $metaboxes[] = array(
            'id' => 'product_options',
            'title' => __('Product options', 'cesis'),
            'post_types' => array(
                'product'
            ),
            //'page_template' => array('page-test.php'),
            //'post_format' => array('image'),
            'position' => 'normal', // normal, advanced, side
            'priority' => 'default', // high, core, default, low
            //'sidebar' => false, // enable/disable the sidebar in the normal/advanced positions
            'sections' => $product_box
        );


        // Kind of overkill, but ahh well.  ;)
        //$metaboxes = apply_filters( 'your_custom_redux_metabox_filter_here', $metaboxes );

        return $metaboxes;
    }
    add_action('redux/metaboxes/' . $redux_opt_name . '/boxes', 'redux_add_metaboxes');
endif;





// The loader will load all of the extensions automatically based on your $redux_opt_name
require_once(get_parent_theme_file_path('/admin/redux-extensions/loader.php'));
