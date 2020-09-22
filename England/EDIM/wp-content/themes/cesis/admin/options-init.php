<?php

    /**
     * For full documentation, please visit: http://docs.reduxframework.com/
     * For a more extensive sample-config file, you may look at:
     * https://github.com/reduxframework/redux-framework/blob/master/sample/sample-config.php
     */

    if ( ! class_exists( 'Redux' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "cesis_data";

    /**
     * ---> SET ARGUMENTS
     * All the possible arguments for Redux.
     * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
     * */

    $theme = wp_get_theme(); // For use with some settings. Not necessary.

    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
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
    $args = array(
        'opt_name' => 'cesis_data',
        'use_cdn' => TRUE,
        'display_name' => 'Cesis',
        'display_version' => FALSE,
        'page_slug' => 'cesis_options',
        'page_title' => 'Cesis Options Panel',
        'save_defaults' => true,
        'update_notice' => TRUE,
        'google_api_key' => '',
        'google_update_weekly'      => false,

        'footer_text' => "<p>Don't forget to save</p>",
        'admin_bar' => TRUE,
        'menu_type' => 'menu',
        'menu_title' => 'Cesis',
        'menu_icon' => ReduxFramework::$_url.'assets/img/cesis_menu.png',
        'allow_sub_menu' => TRUE,
        'page_priority' => '62',
        'page_parent_post_type' => 'your_post_type',
        'customizer' => TRUE,
        'default_mark' => '*',
        'class' => 'cesis_theme_options_panel',
        'hints' => array(
            'icon' => 'el el-bulb',
            'icon_position' => 'right',
            'icon_color' => '#2c3e50',
            'icon_size' => 'normal',
            'tip_style' => array(
                'color' => 'light',
                'style' => 'youtube',
            ),
            'tip_position' => array(
                'my' => 'top left',
                'at' => 'bottom right',
            ),
            'tip_effect' => array(
                'show' => array(
                    'effect' => 'slide',
                    'duration' => '500',
                    'event' => 'mouseover',
                ),
                'hide' => array(
                    'effect' => 'fade',
                    'duration' => '500',
                    'event' => 'mouseleave unfocus',
                ),
            ),
        ),
        'output' => TRUE,
        'output_tag' => TRUE,
        'settings_api' => TRUE,
        'cdn_check_time' => '1440',
        'compiler' => TRUE,
        'global_variable' => 'cesis_data',
        'page_permissions' => 'manage_options',
        'show_import_export' => TRUE,
        'database' => 'options',
        'transient_time' => '3600',
        'network_sites' => TRUE,
    );
/*
    // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
    $args['share_icons'][] = array(
        'url'   => 'https://github.com/ReduxFramework/ReduxFramework',
        'title' => 'Visit us on GitHub',
        'icon'  => 'el el-github'
        //'img'   => '', // You can use icon OR img. IMG needs to be a full URL.
    );
    $args['share_icons'][] = array(
        'url'   => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
        'title' => 'Like us on Facebook',
        'icon'  => 'el el-facebook'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://twitter.com/reduxframework',
        'title' => 'Follow us on Twitter',
        'icon'  => 'el el-twitter'
    );
    $args['share_icons'][] = array(
        'url'   => 'http://www.linkedin.com/company/redux-framework',
        'title' => 'Find us on LinkedIn',
        'icon'  => 'el el-linkedin'
    );
*/
    Redux::setArgs( $opt_name, $args );

    /*
     * ---> END ARGUMENTS
     */

    /*
     * ---> START HELP TABS
     */

    $tabs = array(
        array(
            'id'      => 'redux-help-tab-1',
            'title'   => __( 'Theme Information 1', 'cesis' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'cesis' )
        ),
        array(
            'id'      => 'redux-help-tab-2',
            'title'   => __( 'Theme Information 2', 'cesis' ),
            'content' => __( '<p>This is the tab content, HTML is allowed.</p>', 'cesis' )
        )
    );
    Redux::setHelpTab( $opt_name, $tabs );

    // Set the help sidebar
    $content = __( '<p>This is the sidebar content, HTML is allowed.</p>', 'cesis' );
    Redux::setHelpSidebar( $opt_name, $content );
    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
    $whitelist = array( '127.0.0.1', '::1' );
    if(strpos($url,'staging') !== false || strpos($url,'temp') !== false || strpos($url,'dev') !== false || strpos($url,'www2') !== false || strpos($url,'development') !== false || strpos($url,'datasenter') !== false) {
      $staging_env = "is_staging";
      update_option( 'enable_full_version', 1);
    }else{
      if(function_exists('is_multisite') && function_exists('is_main_site')){
        if(is_multisite() == true && is_main_site() !== true){
          $staging_env = "is_staging";
          update_option( 'enable_full_version', 1);
        }else{
          $staging_env = "is_live";
        }
      }else{
        $staging_env = "is_live";
      }
    }
    if(in_array( $_SERVER['REMOTE_ADDR'], $whitelist)){
      update_option( 'enable_full_version', 1);
    }

    /*
     * <--- END HELP TABS
     */


    /*
     *
     * ---> START SECTIONS
     *
     */





 Redux::setSection( $opt_name, array(
        'title'      => __( 'General Settings', 'cesis' ),
        'desc'       => __( 'Welcome to Cesis theme options panel! Have fun customizing the theme! You can check the theme documentation here: ', 'cesis' ) . '<a href="https://cesis.co/wp-content/uploads/documentation/cesis_documentation.html" target="_blank">Cesis Documentation</a>',
        'id'         => 'tt-general-settings',
        'icon'   => 'fa-general-setting ',
        'fields'     => array(
            array(
                        'id'        => 'cesis_body_type',
                        'type'      => 'button_set',
                        'title'     => __('Use Boxed layout?', 'cesis'),
                        'subtitle'  => __('Select if you want to use the boxed layout.', 'cesis'),
                        'options' => array(
                          'cesis_body_boxed' =>  __('Yes', 'cesis'),
                          'no' =>  __('No', 'cesis'),
                        ),
                        'default'   => 'no',
            ),
            array(
                              'id'        => 'cesis_body_background',
                              'type'      => 'background',
                              'title'     => __('Body Background Color / Image', 'cesis'),
                              'subtitle'  => __('Select the body background color or Image.', 'cesis'),
                              'default'  => array(
                                'background-color' => '#191a1b',
                              )
            ),
            array(
                'id'       => 'cesis_body_width',
                'type'     => 'text',
                'title'     => __('Select the Boxed body width', 'cesis'),
                'subtitle'  => __('Select the width of the boxed layout.', 'cesis'),
                'validate' => 'numeric',
                'required'  => array(
                      array('cesis_body_type','contains','boxed'),
                ),
                'default'  => '1250'
            ),
            array(
                'id'        => 'cesis_body_shadow',
                'type'      => 'button_set',
                'title'     => __('Use Shadow?', 'cesis'),
                'subtitle'  => __('Select if you want to use the shadow for the boxed body.', 'cesis'),
                'required'  => array(
                      array('cesis_body_type','contains','boxed'),
                ),
                'options' => array(
                  'cesis_body_shadow' =>  __('Yes', 'cesis'),
                  'no' =>  __('No', 'cesis'),
                ),
                'default'   => 'no',
            ),
            array(
              'id'        => 'cesis_logo_custom_link',
              'type'     => 'button_set',
              'title'    => __('Use a custom link for the logo?', 'cesis'),
              'subtitle' => __('Select if you want your logo to point to a custom link instead of the home url of your site', 'cesis'),
              'options' => array(
                'no' =>  __('no', 'cesis'),
                'yes' =>  __('yes', 'cesis'),
              ),
              'default' => 'no'
            ),
            array(
              'id'       => 'cesis_logo_link_url',
              'type'     => 'text',
              'required'  => array(
                array('cesis_logo_custom_link','=','yes'),
              ),
              'title'    => __('Put the URL to use for the logo link', 'cesis'),
              'subtitle' => __('Put the URL to use for the logo link ( use http:// )', 'cesis'),
              'validate' => 'url',
              'default'  => ''
            ),
            array(
            	    'id'        => 'cesis_logo',
                    'type'      => 'media',
					'url'      => true,
                    'title'     => __('Default Logo upload', 'cesis'),
                    'desc'      => __('Logo that will be used by default', 'cesis'),
                    'subtitle'  => __('Use big logo for retina ready display', 'cesis'),
					'default'  => array(
					'url'=>''
				    ),
                ),
            array(
                    'id'        => 'cesis_white_logo',
                    'type'      => 'media',
					'url'      => true,
                    'title'     => __('Light Logo upload', 'cesis'),
                    'desc'      => __('Upload a logo that will be used when the header is transparent', 'cesis'),
                    'subtitle'  => __('Will be used when transparent header', 'cesis'),
					'default'  => array(
					'url'=>''
				    ),
                ),
            array(
                    'id'        => 'cesis_logo_width',
                    'type'      => 'text',
                    'title'     => __('Logo width', 'cesis'),
                    'subtitle'  => __('Don\'t include "px" in the string. e.g. 150', 'cesis'),
                    'desc'      => __('Set your logo size, ', 'cesis'),
                    'validate'  => 'numeric',
                    'default'   => '120',
                ),
			array(
                    'id'        => 'cesis_mobile_logo',
                    'type'      => 'media',
					'url'      => true,
                    'title'     => __('Mobile Logo upload', 'cesis'),
                    'desc'      => __('Logo used when menu switch to mobile menu', 'cesis'),
                    'subtitle'  => __('If you want to use a different logo when using the mobile menu( optional )', 'cesis'),
					'default'  => array(
					'url'=>''
				    ),
                ),
            array(
                    'id'        => 'cesis_mobile_logo_width',
                    'type'      => 'text',
                    'title'     => __('Mobile Logo width', 'cesis'),
                    'subtitle'  => __('Don\'t include "px" in the string. e.g. 150', 'cesis'),
                    'desc'      => __('Set your logo size for the mobile header, ', 'cesis'),
                    'validate'  => 'numeric',
                    'default'   => '100',
                ),
			array(
                        'id'        => 'cesis_custom_favicon',
                        'type'      => 'media',
						'url'      => true,
                        'title'     => __('Favicon upload', 'cesis'),
                        'desc'      => __('upload favicon', 'cesis'),
                        'subtitle'  => __('Upload a 32px x 32px Png/Gif/Ico image that will represent your website\'s favicon.', 'cesis'),
						'default'  => array(
							'url'=>'http://cesis.co/wp-content/uploads/2018/04/cesis-favicon.png'
					    ),
                    ),
            array(
                        'id'        => 'cesis_responsive',
                        'type'      => 'switch',
                        'title'     => __('Enable Responsive Design', 'cesis'),
                        'subtitle'  => __('This adjusts the layout of the website depending on the screen size/device.', 'cesis'),
                        'default'   => true,
                    ),
            array(
                        'id'        => 'cesis_smooth_scroll',
                        'type'      => 'switch',
                        'title'     => __('Smooth Scrolling', 'cesis'),
                        'subtitle'  => __('Toggle whether or not to enable the smooth scrolling effect.', 'cesis'),
                        'default'   => true,
                    ),
            array(
                        'id'        => 'cesis_to_top',
                        'type'      => 'switch',
                        'title'     => __('Back to Top', 'cesis'),
                        'subtitle'  => __('Toggle whether or not to enable the back to top button.', 'cesis'),
                        'default'   => true,
                    ),
            array(
                        'id'        => 'cesis_feedburner',
                        'type'      => 'text',
                        'title'     => __('FeedBurner URL', 'cesis'),
                        'subtitle'  => __('Enter your full FeedBurner URL (or any other preferred feed URL) if you wish to use FeedBurner over the standard WordPress Feed e.g. http://feeds.feedburner.com/yoururlhere', 'cesis'),
                        'desc'      => __('This is must be an url.', 'cesis'),
                        'validate'  => 'url',
                        'default'   => '',
                        'text_hint' => array(
                           'title'     => '',
                           'content'   => 'Please enter a valid <strong>URL</strong> in this field.'
                       )
                    ),
                    array(
                        'id'        => 'cesis_custom_css',
                        'type'      => 'ace_editor',
                        'title'     => __('Custom CSS', 'cesis'),
                        'subtitle'  => __('Paste your CSS code here.', 'cesis'),
                        'mode'      => 'css',
                        'theme'     => 'monokai',
                        'desc'      => '',
                        'default'   => ""
                    ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'      => __( 'Hidden option for header / footer meta', 'cesis' ),
        'desc'       => __( 'If you are seeing this section contact our support', 'cesis' ),
        'id'         => 'tt-hidden-options',
        'fields'     => array(
          array(
                  'id'      => 'cesis_top_bar_sorter_meta',
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
                  'id'      => 'cesis_footer_bar_sorter_meta',
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

        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Typography', 'cesis' ),
        'id'     => 'tt-typography',
        'desc'   => __( 'Select the font you want to use for the main area of the site.', 'cesis' ),
        'icon'   => 'fa-typography ',
        'fields' => array(

              array(
                  'id'       => 'cesis_custom_fonts',
                  'type'     => 'custom_fonts',
                  'title'    => __('Custom fonts.', 'cesis'),
                  'subtitle'  => __('Upload the zip file that contains the font files of your font.', 'cesis'),
              ),

           array(
						'id'          => 'cesis_site_main_font',
					    'type'        => 'typography',
                        'title'     => __('Site main font', 'cesis'),
                        'subtitle'  => __('Choose the site main font.', 'cesis'),
					  'google'      => true,
					  'font-backup' => true,
					  'color' => false,
					  'units'       =>'px',
						'line-height' => true,
						'text-align' => false,
						'letter-spacing' => true,
						'text-transform' => false,
						'fonts' => array(
				            "Aileron"					                           => "Aileron",
				            "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
				            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
				            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
				            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
				            "Courier, monospace"                                   => "Courier, monospace",
				            "Garamond, serif"                                      => "Garamond, serif",
				            "Georgia, serif"                                       => "Georgia, serif",
				            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
					          "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
				            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
				            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
				            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
				            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
				            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
				            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
				            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
				            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
        				),
					    'default'     => array(
					        'font-weight'  => '400',
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '15px',
					        'line-height'   => '24px',
							    'letter-spacing' => '0',
					    ),
				   ),
           array(
						'id'          => 'cesis_site_alt_font',
					    'type'        => 'typography',
                        'title'     => __('Site alternative font', 'cesis'),
                        'subtitle'  => __('Choose the site alternative font ( will be use for all elements that need to be different but are not headings. )', 'cesis'),
					    'google'      => true,
					    'font-backup' => true,
					    'color' => false,
					    'units'       =>'px',
						'line-height' => false,
						'text-align' => false,
						'font-size' => false,
						'letter-spacing' => false,
						'text-transform' => false,
						'fonts' => array(
				            "Aileron"					                           => "Aileron",
				            "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
				            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
				            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
				            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
				            "Courier, monospace"                                   => "Courier, monospace",
				            "Garamond, serif"                                      => "Garamond, serif",
				            "Georgia, serif"                                       => "Georgia, serif",
				            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
					        "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
				            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
				            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
				            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
				            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
				            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
				            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
				            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
				            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
        				),
					    'default'     => array(
					        'font-family' => 'Roboto',
					        'google'      => true,
							'font-weight' => '500',
					    ),
				   ),
           array(
               'id'       => 'cesis_site_p_margin',
               'type'     => 'text',
               'title'     => __('Site Paragraph bottom margin', 'cesis'),
               'subtitle'  => __('Choose the paragrah default bottom space.', 'cesis'),
               'validate' => 'numeric',
               'default'  => '17'
           ),
           array(
						'id'          => 'cesis_site_h1_font',
					    'type'        => 'typography',
                        'title'     => __('Site H1 font', 'cesis'),
                        'subtitle'  => __('Choose the site H1 font.', 'cesis'),
					    'google'      => true,
					    'font-backup' => true,
					    'color' => false,
					    'units'       =>'px',
						'line-height' => true,
						'text-align' => false,
						'letter-spacing' => true,
						'text-transform' => false,
						'fonts' => array(
				            "Aileron"					                           => "Aileron",
				            "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
				            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
				            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
				            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
				            "Courier, monospace"                                   => "Courier, monospace",
				            "Garamond, serif"                                      => "Garamond, serif",
				            "Georgia, serif"                                       => "Georgia, serif",
				            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
					        "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
				            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
				            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
				            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
				            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
				            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
				            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
				            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
				            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
        				),
					    'default'     => array(
					        'font-weight'  => '500',
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '40px',
					        'line-height'   => '48px',
							'letter-spacing' => '0',
					    ),
				),
        array(
            'id'       => 'cesis_site_h1_margin',
            'type'     => 'text',
            'title'     => __('H1 bottom margin', 'cesis'),
            'subtitle'  => __('Choose the H1 default bottom space.', 'cesis'),
            'validate' => 'numeric',
            'default'  => '28'
        ),
           array(
						'id'          => 'cesis_site_h2_font',
					    'type'        => 'typography',
                        'title'     => __('Site H2 font', 'cesis'),
                        'subtitle'  => __('Choose the site H2 font.', 'cesis'),
					    'google'      => true,
					    'font-backup' => true,
					    'color' => false,
					    'units'       =>'px',
						'line-height' => true,
						'text-align' => false,
						'letter-spacing' => true,
						'text-transform' => false,
						'fonts' => array(
				            "Aileron"					                           => "Aileron",
				            "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
				            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
				            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
				            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
				            "Courier, monospace"                                   => "Courier, monospace",
				            "Garamond, serif"                                      => "Garamond, serif",
				            "Georgia, serif"                                       => "Georgia, serif",
				            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
					        "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
				            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
				            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
				            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
				            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
				            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
				            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
				            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
				            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
        				),
					    'default'     => array(
					        'font-weight'  => '500',
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '34px',
					        'line-height'   => '40px',
							'letter-spacing' => '0',
					    ),
				),
        array(
            'id'       => 'cesis_site_h2_margin',
            'type'     => 'text',
            'title'     => __('H2 bottom margin', 'cesis'),
            'subtitle'  => __('Choose the H2 default bottom space.', 'cesis'),
            'validate' => 'numeric',
            'default'  => '31'
        ),
           array(
						'id'          => 'cesis_site_h3_font',
					    'type'        => 'typography',
                        'title'     => __('Site H3 font', 'cesis'),
                        'subtitle'  => __('Choose the site H3 font.', 'cesis'),
					    'google'      => true,
					    'font-backup' => true,
					    'color' => false,
					    'units'       =>'px',
						'line-height' => true,
						'text-align' => false,
						'letter-spacing' => true,
						'text-transform' => false,
						'fonts' => array(
				            "Aileron"					                           => "Aileron",
				            "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
				            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
				            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
				            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
				            "Courier, monospace"                                   => "Courier, monospace",
				            "Garamond, serif"                                      => "Garamond, serif",
				            "Georgia, serif"                                       => "Georgia, serif",
				            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
					        "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
				            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
				            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
				            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
				            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
				            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
				            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
				            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
				            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
        				),
					    'default'     => array(
					        'font-weight'  => '500',
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '28px',
					        'line-height'   => '36px',
							'letter-spacing' => '0',
					    ),
				),
        array(
            'id'       => 'cesis_site_h3_margin',
            'type'     => 'text',
            'title'     => __('H3 bottom margin', 'cesis'),
            'subtitle'  => __('Choose the H3 default bottom space.', 'cesis'),
            'validate' => 'numeric',
            'default'  => '18'
        ),
           array(
						'id'          => 'cesis_site_h4_font',
					    'type'        => 'typography',
                        'title'     => __('Site H4 font', 'cesis'),
                        'subtitle'  => __('Choose the site H4 font.', 'cesis'),
					    'google'      => true,
					    'font-backup' => true,
					    'color' => false,
					    'units'       =>'px',
						'line-height' => true,
						'text-align' => false,
						'letter-spacing' => true,
						'text-transform' => false,
						'fonts' => array(
				            "Aileron"					                           => "Aileron",
				            "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
				            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
				            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
				            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
				            "Courier, monospace"                                   => "Courier, monospace",
				            "Garamond, serif"                                      => "Garamond, serif",
				            "Georgia, serif"                                       => "Georgia, serif",
				            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
					        "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
				            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
				            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
				            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
				            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
				            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
				            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
				            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
				            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
        				),
					    'default'     => array(
					        'font-weight'  => '500',
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '24px',
					        'line-height'   => '32px',
							'letter-spacing' => '0',
					    ),
				),
        array(
            'id'       => 'cesis_site_h4_margin',
            'type'     => 'text',
            'title'     => __('H4 bottom margin', 'cesis'),
            'subtitle'  => __('Choose the H4 default bottom space.', 'cesis'),
            'validate' => 'numeric',
            'default'  => '18'
        ),
           array(
						'id'          => 'cesis_site_h5_font',
					    'type'        => 'typography',
                        'title'     => __('Site H5 font', 'cesis'),
                        'subtitle'  => __('Choose the site H5 font.', 'cesis'),
					    'google'      => true,
					    'font-backup' => true,
					    'color' => false,
					    'units'       =>'px',
						'line-height' => true,
						'text-align' => false,
						'letter-spacing' => true,
						'text-transform' => false,
						'fonts' => array(
				            "Aileron"					                           => "Aileron",
				            "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
				            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
				            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
				            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
				            "Courier, monospace"                                   => "Courier, monospace",
				            "Garamond, serif"                                      => "Garamond, serif",
				            "Georgia, serif"                                       => "Georgia, serif",
				            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
					        "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
				            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
				            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
				            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
				            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
				            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
				            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
				            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
				            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
        				),
					    'default'     => array(
					        'font-weight'  => '700',
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '18px',
					        'line-height'   => '27px',
							'letter-spacing' => '0',
					    ),
				),
        array(
            'id'       => 'cesis_site_h5_margin',
            'type'     => 'text',
            'title'     => __('H5 bottom margin', 'cesis'),
            'subtitle'  => __('Choose the H5 default bottom space.', 'cesis'),
            'validate' => 'numeric',
            'default'  => '19'
        ),
           array(
						'id'          => 'cesis_site_h6_font',
					    'type'        => 'typography',
                        'title'     => __('Site H6 font', 'cesis'),
                        'subtitle'  => __('Choose the site H6 font.', 'cesis'),
					    'google'      => true,
					    'font-backup' => true,
					    'color' => false,
					    'units'       =>'px',
						'line-height' => true,
						'text-align' => false,
						'letter-spacing' => true,
						'text-transform' => false,
						'fonts' => array(
				            "Aileron"					                           => "Aileron",
				            "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
				            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
				            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
				            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
				            "Courier, monospace"                                   => "Courier, monospace",
				            "Garamond, serif"                                      => "Garamond, serif",
				            "Georgia, serif"                                       => "Georgia, serif",
				            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
					        "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
				            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
				            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
				            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
				            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
				            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
				            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
				            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
				            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
        				),
					    'default'     => array(
					        'font-weight'  => '700',
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '16px',
					        'line-height'   => '24px',
							'letter-spacing' => '0',
					    ),
			),
      array(
          'id'       => 'cesis_site_h6_margin',
          'type'     => 'text',
          'title'     => __('H6 bottom margin', 'cesis'),
          'subtitle'  => __('Choose the H6 default bottom space.', 'cesis'),
          'validate' => 'numeric',
          'default'  => '20'
      ),
         array(
          'id'          => 'cesis_site_quote_font',
            'type'        => 'typography',
                      'title'     => __('Quotes font', 'cesis'),
                      'subtitle'  => __('Choose the site quotes font.', 'cesis'),
            'google'      => true,
            'font-backup' => true,
            'color' => false,
            'units'       =>'px',
          'line-height' => true,
          'text-align' => false,
          'letter-spacing' => true,
          'text-transform' => false,
          'fonts' => array(
                  "Aileron"					                           => "Aileron",
                  "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                  "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                  "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                  "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                  "Courier, monospace"                                   => "Courier, monospace",
                  "Garamond, serif"                                      => "Garamond, serif",
                  "Georgia, serif"                                       => "Georgia, serif",
                  "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                  "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                  "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                  "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                  "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                  "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                  "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                  "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                  "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
              ),
            'default'     => array(
                'font-weight'  => '300',
                'font-family' => 'Roboto Slab',
                'google'      => true,
                'font-size'   => '22px',
                'line-height'   => '32px',
            'letter-spacing' => '0',
            ),
    ),

        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'  => __( 'Header Settings', 'cesis' ),
        'id'     => 'tt-header',
        'desc'   => __( 'General Header settings. For more detailed options check the sub sections.', 'cesis' ),
        'icon'   => 'fa-header2 ',
        'fields' => array(

          array(
            'id'        => 'cesis_header_width',
            'type'     => 'dimensions',
            'height'     => false,
            'units'    => array('px','%'),
            'title'     => __('Select the Header container width ( px or % )', 'cesis'),
            'subtitle'  => __('Default 1170px, select 100% to have full width header.', 'cesis'),
            'default' => array(
              'width'   => '1170px',
              'units' => 'px'
            ),


          ),

           array(
                        'id'        => 'cesis_header_sticky',
                        'type'      => 'select',
                        'title'     => __('Use Sticky Header?', 'cesis'),
                        'subtitle'  => __('Select if you want to header to be fix at the top of the page when you scroll down.', 'cesis'),


                        //Must provide key => value pairs for select options
                        'options'   => array(
                            'header_sticky' => __('Yes ( Main Area only )', 'cesis'),
                            'full_header_sticky' => __('Yes ( Top Bar and Main Area )', 'cesis'),
                            'no_sticky' => __('No', 'cesis'),
                        ),
                        'default'   => 'header_sticky'
                    ),
                    array(
                                      'id'        => 'cesis_header_sticky_hiding',
                                      'type'     => 'button_set',
                                      'title'     => __('Hide the header after scrolling a bit?', 'cesis'),
                                      'subtitle'  => __('Select if you want the header to hide when you scroll down and show up if scroll up.', 'cesis'),
                                      'required'  => array(
                                            array('cesis_header_layout','not_contain','vertical_header'),
                                            array('cesis_header_sticky','contains','header'),
                                      ),
                                      'options' => array(
                                'cesis_header_hiding' =>  __('Yes', 'cesis'),
                                'no' =>  __('No', 'cesis'),
                             ),
                            'default' => 'cesis_header_hiding'


                        ),

                        array(
                                          'id'        => 'cesis_header_shrink',
                                          'type'     => 'button_set',
                                          'title'     => __('Shrink header when scroll down?', 'cesis'),
                                          'subtitle'  => __('Select if you want to shrink the header when you scroll down.', 'cesis'),
                                          'required'  => array(
                                                array('cesis_header_layout','not_contain','vertical_header'),
                                                array('cesis_header_sticky','contains','header'),
                                          ),
                                          'options' => array(
                                    'cesis_header_shrink' =>  __('Yes', 'cesis'),
                                    'no' =>  __('No', 'cesis'),
                                 ),
                                'default' => 'no'


                            ),
                            array(
                              'id'       => 'cesis_header_shrink_height',
                              'required'  => array(
                                    array('cesis_header_shrink','=','cesis_header_shrink'),
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
                                                                      'id'        => 'cesis_header_shadow',
                                                                      'type'     => 'button_set',
                                                                      'title'     => __('Add shadow to the Header?', 'cesis'),
                                                                      'subtitle'  => __('Select if you want to add Shadow effect to the header container.', 'cesis'),
                                                                      'options' => array(
                                                                'cesis_header_shadow' =>  __('Yes', 'cesis'),
                                                                'no_shadow' =>  __('No', 'cesis'),
                                                             ),
                                                            'default' => 'cesis_header_shadow'


                                                      ),
      array(
                    'id'        => 'cesis_transparent_header_bg_color',
                    'type'      => 'color_rgba',
                    'title'     => __('Transparent Header Background Color', 'cesis'),
                    'subtitle'  => __('Pick a background color for the transparent Header ( use transparent color ).', 'cesis'),
                    'default'   => array(
                      'color'     => '#ffffff',
                      'alpha'     => '0',
                      'rgba' => Redux_Helpers::hex2rgba ( '#ffffff', '0' ),
                    ),
      						'options'       => array(
      					        'clickout_fires_change'     => true,
      						),
                  ),
      array(
                    'id'        => 'cesis_transparent_header_border_color',
                    'type'      => 'color_rgba',
                    'title'     => __('Transparent Header border Color', 'cesis'),
                    'subtitle'  => __('Pick a color for the transparent Header border.', 'cesis'),
                    'default'   => array(
                      'color'     => '#ffffff',
                      'alpha'     => '0',
                      'rgba' => Redux_Helpers::hex2rgba ( '#ffffff', '0' ),
                    ),
      						'options'       => array(
      					        'clickout_fires_change'     => true,
      						),
                ),

                array(
                  'id'        => 'cesis_transparent_header_color',
                  'type'      => 'color_rgba',
                  'title'     => __('Transparent Header text, seperator Color', 'cesis'),
                  'subtitle'  => __('Pick a color for the transparent Header text color.', 'cesis'),
                  'default'   => array(
                    'color'     => '#ffffff',
                    'alpha'     => '1',
                    'rgba' => Redux_Helpers::hex2rgba ( '#ffffff', '1' ),
                  ),
    						'options'       => array(
    					        'clickout_fires_change'     => true,
    						),
                ),
                array(
                  'id'        => 'cesis_transparent_header_active_color',
                  'type'      => 'color_rgba',
                  'title'     => __('Transparent Header accent Color', 'cesis'),
                  'subtitle'  => __('Pick a color for the transparent Header active / hover element.', 'cesis'),
                  'default'   => array(
                    'color'     => '#ffffff',
                    'alpha'     => '0.85',
                    'rgba' => Redux_Helpers::hex2rgba ( '#ffffff', '0.85' ),
                  ),
    						'options'       => array(
    					        'clickout_fires_change'     => true,
    						),
                ),

        )
    ) );





    Redux::setSection( $opt_name, array(
        'title'      => __( 'Header Top Bar', 'cesis' ),
        'desc'       => __( 'All the settings for the Header Top Bar, For full documentation on this field, visit: ', 'cesis' ) . '<a href="https://cesis.co/wp-content/uploads/documentation/cesis_documentation.html" target="_blank">Cesis Header Top Bar Documentation</a>',
        'id'         => 'tt-header-topbar',
        'subsection' => true,
        'fields'     => array(
          array(
            'id'       => 'cesis_top_bar_breakpoint',
            'type'     => 'text',
            'title'     => __('Top bar Breakpoint', 'cesis'),
            'subtitle'  => __('Select the window size you want the Top bar to be hidden.', 'cesis'),
            'validate' => 'numeric',
            'default'  => '978'
          ),
          array(
        				'id'       => 'cesis_top_bar_height',
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
                            'id'        => 'cesis_top_bar_bg_color',
                            'type'      => 'color',
                            'title'     => __('Top bar Background Color', 'cesis'),
                            'subtitle'  => __('Background color of the Top bar.', 'cesis'),
                            'default'   => '#ffffff',
                            'validate'  => 'color',
                          ),
          array(
            'id'        => 'cesis_top_bar_border_color',
            'type'      => 'color',
            'title'     => __('Top bar Border Color', 'cesis'),
            'subtitle'  => __('Border color of the Top bar.', 'cesis'),
            'default'   => '#ebebeb',
            'validate'  => 'color',
            ),
          array(
                            'id'        => 'cesis_top_bar_text_color',
                            'type'      => 'color',
                            'title'     => __('Top bar Text Color', 'cesis'),
                            'subtitle'  => __('Text Color of the Top bar.', 'cesis'),
                            'default'   => '#bababa',
                            'validate'  => 'color',
                        ),
          array(
                            'id'        => 'cesis_top_bar_hl_color',
                            'type'      => 'color',
                            'title'     => __('Top bar highlight color', 'cesis'),
                            'subtitle'  => __('Highlight color of the Top bar.', 'cesis'),
                            'default'   => '#6d7783',
                            'validate'  => 'color',
                        ),
          array(
                            'id'        => 'cesis_top_bar_hover_color',
                            'type'      => 'color',
                            'title'     => __('Top bar hover color', 'cesis'),
                            'subtitle'  => __('Hover color of the Top bar.', 'cesis'),
                            'default'   => '#293340',
                            'validate'  => 'color',
                        ),
          array(
                  'id'      => 'cesis_top_bar_sorter',
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
                    'id'          => 'cesis_top_bar_menu_font',
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
                          'font-family' => 'Roboto',
                          'google'      => true,
                          'font-size'   => '14px',
                      'letter-spacing' => '0px',
                      'text-transform' => 'none',
                      ),
                ),

                        array(
                            'id'       => 'cesis_top_bar_menu_space',
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
                          'id'       => 'cesis_top_bar_text_size',
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
                'id'       => 'cesis_top_bar_phone',
                'type'     => 'text',
                'title'    => __('Phone number', 'cesis'),
                'subtitle' => __('Enter your phone number. ', 'cesis'),
                'validate' => 'html',
                'default'  => '<a href="tel:5555555555">Call us: 475-885-545</a>'
          ),

            array(
                'id'       => 'cesis_top_bar_email',
                'type'     => 'text',
                'title'    => __('Email', 'cesis'),
                'subtitle' => __('Enter your mail address', 'cesis'),
                'validate' => 'html',
                'default'  => 'cesis.support@gmail.com'
          ),

            array(
                'id'       => 'cesis_top_bar_text',
                'type'     => 'editor',
                'title'    => __('Custom Text', 'cesis'),
                'subtitle' => __('You can put text / html in this field, will be used if selected in the sorter ', 'cesis'),
                'default'  => '<strong>Latest news:</strong> Cesis is the Best Theme on <a href="#">Themeforest</a>'
          ),

            array(
                'id'        => 'cesis_top_bar_notifications_style',
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
    ) );



    Redux::setSection( $opt_name, array(
        'title'      => __( 'Header Main Area', 'cesis' ),
        'desc'       => __( 'All the settings for the Header Main Area ( Logo, Main Menu )For full documentation on this field, visit: ', 'cesis' ) . '<a href="http://docs.reduxframework.com/core/fields/textarea/" target="_blank">http://docs.reduxframework.com/core/fields/textarea/</a>',
        'id'         => 'tt-header-mainarea',
        'subsection' => true,
        'fields'     => array(

			array(
                        'id'        => 'tt-notice-info-header',
                        'type'      => 'info',
						'icon' => 'el-icon-info-sign',
                        'title'     => __('HEADER SETTINGS.', 'cesis'),
                        'desc'      => __('Below you will find the options for the header layout, logo position, background color etc..', 'cesis')
                ),

                array(
                  'id'        => 'cesis_header_layout',
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
                                    'id'        => 'cesis_header_bg_color',
                                    'type'      => 'color',
                                    'title'     => __('Header Background Color', 'cesis'),
                                    'subtitle'  => __('Pick a background color for the Header (default: #ffffff).', 'cesis'),
                                    'default'   => '#ffffff',
                                    'validate'  => 'color',
                                ),
array(
  'id'        => 'cesis_header_border_color',
  'type'      => 'color_rgba',
  'title'     => __('Header border Color', 'cesis'),
  'subtitle'  => __('Pick a color for the main Header bottom border.', 'cesis'),
  'default'   => array(
    'color'     => '#ebebeb',
    'alpha'     => '0.5',
    'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
  ),
'options'       => array(
      'clickout_fires_change'     => true,
),
),


array(
'id'        => 'cesis_header_openmenu_color',
'type'      => 'color',
'title'     => __('Open Menu / Hamburger button Color', 'cesis'),
'subtitle'  => __('Pick a color for the open menu button (default: #ffffff).', 'cesis'),
'default'   => '#6d7783',
'validate'  => 'color',
),


array(
  'id'        => 'cesis_overlay_bg_color',
  'type'      => 'color_rgba',
  'title'     => __('Overlay background Color', 'cesis'),
  'subtitle'  => __('Pick a color for the main Overlay background.', 'cesis'),
  'required'  => array(
          array('cesis_header_layout','contains','overlay_header_b'),
    ),
  'default'   => array(
    'color'     => '#232323',
    'alpha'     => '0.9',
    'rgba' => Redux_Helpers::hex2rgba ( '#232323', '0.9' ),
  ),
'options'       => array(
      'clickout_fires_change'     => true,
),
),
			array(
    				'id'       => 'cesis_header_height',
    				'type'     => 'slider',
    				'title'    => __('Header height.', 'cesis'),
    				'subtitle' => __('Select the header height', 'cesis'),
            'required'  => array(
                  array('cesis_header_layout','not_contain','vertical_header'),
            ),
					'default' => '90',
					'min' => 20,
				    'step' => 1,
				    'max' => 300,
				    'display_value' => 'text',
				),

        array(
          'id'        => 'cesis_header_sub_bg_color',
          'type'      => 'color',
          'title'     => __('Second Line background Color', 'cesis'),
          'subtitle'  => __('Pick a background color for the Header second line (default: #ffffff).', 'cesis'),
          'required'  => array('cesis_header_layout', '=', 'two_line_header'),
          'default'   => '#ffffff',
          'validate'  => 'color',
        ),
                          array(
                            'id'        => 'cesis_header_sub_border_color',
                            'type'      => 'color_rgba',
                            'title'     => __('Second line border Color', 'cesis'),
                            'subtitle'  => __('Pick a color for the Header second line bottom border.', 'cesis'),
                            'required'  => array('cesis_header_layout', '=', 'two_line_header'),
                            'default'   => array(
                              'color'     => '#ebebeb',
                              'alpha'     => '0.5',
                              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
                            ),
              						'options'       => array(
              					        'clickout_fires_change'     => true,
              						),
                          ),
        array(
          'id'       => 'cesis_header_sub_height',
          'type'     => 'slider',
          'title'    => __('Second line height.', 'cesis'),
          'subtitle' => __('Select the second line height', 'cesis'),
          'default' => '50',
          'required'  => array('cesis_header_layout', '=', 'two_line_header'),
          'min' => 20,
          'step' => 1,
          'max' => 300,
          'display_value' => 'text',
        ),

        array(
          'id'        => 'cesis_header_offcanvas_bg_color',
          'type'      => 'color',
          'title'     => __('Offcanvas Background Color', 'cesis'),
          'subtitle'  => __('Pick a background color for Offcanvas part of the Header (default: #ffffff).', 'cesis'),
          'required'  => array(
            array('cesis_header_layout','contains','offcanvas'),
          ),
          'default'   => '#ffffff',
          'validate'  => 'color',
        ),
array(
    'id'       => 'cesis_header_v_width',
    'type'     => 'slider',
    'title'    => __('Vertical / Offcanvas Header Width.', 'cesis'),
    'subtitle' => __('Select the Vertical / Offcanvas header width', 'cesis'),
    'required'  => array(
          array('cesis_header_layout','contains','vertical'),
    ),
  'default' => '260',
  'min' => 20,
    'step' => 1,
    'max' => 350,
    'display_value' => 'text',
),
array(
'id'       => 'cesis_header_v_pos',
'type'     => 'button_set',
'title'    => __('Vertical / Offcanvas Header Position.', 'cesis'),
'subtitle' => __('Select the position for the header', 'cesis'),
'required'  => array(
      array('cesis_header_layout','contains','vertical'),
),
'options' => array(
    'header_v_pos_left' => __('Left', 'cesis'),
    'header_v_pos_right' => __('Right', 'cesis'),
 ),
'default' => 'header_v_pos_left'
),

        array(
        'id'       => 'cesis_header_v_content',
        'type'     => 'button_set',
        'title'    => __('Vertical / Offcanvas header content Position.', 'cesis'),
        'subtitle' => __('Select the vertical / offcanvas header content position', 'cesis'),
        'required'  => array(
              array('cesis_header_layout','contains','vertical'),
        ),
        'options' => array(
            'header_v_c_left' => __('Left', 'cesis'),
            'header_v_c_right' => __('Right', 'cesis'),
            'header_v_c_center' => __('Center', 'cesis'),
         ),
        'default' => 'header_v_c_left'
    ),
     array(
      'id'       => 'cesis_header_v_content_ypos',
      'type'     => 'button_set',
      'title'    => __('Vertical header content Y Position.', 'cesis'),
      'subtitle' => __('Select the vertical header content Y position ( on top, or justified )', 'cesis'),
      'required'  => array(
            array('cesis_header_layout','contains','vertical_header'),
      ),
      'options' => array(
          'header_v_cy_top' => __('At the Top', 'cesis'),
          'header_v_cy_justify' => __('Justified', 'cesis'),
       ),
      'default' => 'header_v_cy_top'
  ),

    array(
    'id'       => 'cesis_logo_pos',
    'type'     => 'button_set',
    'title'    => __('Logo Position.', 'cesis'),
    'subtitle' => __('Select the logo position for the header', 'cesis'),
    'required'  => array(
          array('cesis_header_layout','not_contain','vertical'),
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
                        'type'      => 'info',
						'icon' => 'el-icon-info-sign',
                        'title'     => __('MENU / NAVIGATION SETTINGS.', 'cesis'),
                        'desc'      => __('Set the options related to the menu / navigation.', 'cesis')
                ),
        array(
          'id'       => 'cesis_menu_dda',
          'type'     => 'button_set',
          'title'    => __('Add a dropdown arrow for if menu has sub menu ?', 'cesis'),
          'subtitle' => __('Select if you want to add a dropdown arrow if the menu item has a sub menu.', 'cesis'),
          'options' => array(
        	   'yes' =>  __('Yes', 'cesis'),
        		 'no' =>  __('no', 'cesis'),
           ),
        	  'default' => 'no'
          ),
				array(
                        'id'        => 'cesis_menu_type',
                        'type'      => 'select',
                        'title'     => __('Select the Menu Style', 'cesis'),
                        'subtitle'  => __('Select the main Menu Design type', 'cesis'),
                        'required'  => array(
                              array('cesis_header_layout','contains','line'),
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

    				'id'       => 'cesis_menu_pos',
    				'type'     => 'button_set',
    				'title'    => __('Menu Position.', 'cesis'),
    				'subtitle' => __('Select the Menu position for the header', 'cesis'),
					'required'  => array(
    						array('cesis_header_layout','contains','line'),
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
                        'id'        => 'cesis_menu_border_pos',
                        'type'      => 'select',
                        'title'     => __('Select the Border Position', 'cesis'),
                        'subtitle'  => __('Select the Menu border postion', 'cesis'),
                        'required'  => array(
    						array('cesis_menu_type','contains','borderx'),
						),

                        'options'   => array(
                            'edge_border' =>  __('Edge', 'cesis'),
                            'text_border' =>  __('Near Text', 'cesis'),
                        ),
                        'default'   => 'edge_border'
                ),
				array(
    				'id'       => 'cesis_menu_border_size',
    				'type'     => 'slider',
    				'title'    => __('Menu Border Size.', 'cesis'),
    				'subtitle' => __('Select the Menu Border Size', 'cesis'),
					'default' => '3',
					'required'  => array(
    						array('cesis_menu_type','contains','border'),
					),
					'min' => 1,
				    'step' => 1,
				    'max' => 10,
				    'display_value' => 'text',
				),
				array(
    				'id'       => 'cesis_menu_border_radius',
    				'type'     => 'slider',
    				'title'    => __('Menu Border Radius.', 'cesis'),
    				'subtitle' => __('Select the Menu Border Radius', 'cesis'),
					'default' => '0',
					'required'  => array(
    						array('cesis_menu_type','contains','boxed'),
					),
					'min' => 0,
				    'step' => 1,
				    'max' => 100,
				    'display_value' => 'text',
				),
				array(
				    'id'             => 'cesis_menu_span_padding',
				    'type'           => 'spacing',
				    'mode'           => 'padding',
				    'units'          => array('px'),
				    'units_extended' => 'false',
				    'title'          => __('Menu Text Box size', 'cesis'),
				    'subtitle'       => __('Set the box size, top space, right space, bottom space, left space.', 'cesis'),
					'required'  => array(
    						array('cesis_menu_type','contains','boxed'),
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
    				'id'       => 'cesis_menu_space',
    				'type'     => 'slider',
    				'title'    => __('Menu Items Space.', 'cesis'),
    				'subtitle' => __('Set the space between menu items', 'cesis'),
					'default' => '20',
					'min' => 1,
				    'step' => 1,
				    'max' => 60,
				    'display_value' => 'text',
				),

					array(
						'id'          => 'cesis_menu_font',
					    'type'        => 'typography',
                        'title'     => __('Menu Text Font and Color Settings', 'cesis'),
                        'subtitle'  => __('Choose the menu text font, size, color.', 'cesis'),
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
                  'font-weight'  => '500',
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '13px',
                  'letter-spacing' => '1',
                  'text-transform' => 'uppercase',
					    ),
					),

					array(
                        'id'        => 'cesis_menu_sep_color',
                        'type'      => 'color',
                        'title'     => __('Menu Separator Color', 'cesis'),
                        'subtitle'  => __('Menu Separator color (default: #f7f7f7).', 'cesis'),
						'required'  => array('cesis_menu_type', 'contains', 'separator'),
                        'default'   => '#ecf0f1',
                        'validate'  => 'color',
                    ),
					array(
                        'id'        => 'cesis_current_menu_color',
                        'type'      => 'color',
                        'title'     => __('Current Menu item Text Color', 'cesis'),
                        'subtitle'  => __('Current / Hover Menu item text color (default: #1abc9c).', 'cesis'),
                        'default'   => '#3a78ff',
                        'validate'  => 'color',
                    ),
                    array(

                        'id'       => 'cesis_current_menu_parent',
                        'type'     => 'button_set',
                        'title'    => __('Also highlight current menu parent?', 'cesis'),
                        'subtitle' => __('Select if you want the parent menu item to also be highlighted', 'cesis'),

                        'options' => array(
                            'yes' =>  __('Yes', 'cesis'),
                            'no' =>  __('No', 'cesis'),
                         ),
                        'default' => 'no'
                    ),
					array(
                        'id'        => 'cesis_current_menu_bg_color',
                        'type'      => 'color',
                        'title'     => __('Current Menu item background Color', 'cesis'),
                        'subtitle'  => __('Current Menu item background color (default: #ffffff).', 'cesis'),
						'required'  => array('cesis_menu_type', '=', 'nav_line_separator'),
                        'default'   => '#ffffff',
						'validate'  => 'color',
                    ),
					array(
                        'id'        => 'cesis_menu_border_color',
                        'type'      => 'color',
                        'title'     => __('Current Menu border Color', 'cesis'),
                        'subtitle'  => __('Current Menu and hover border color.', 'cesis'),
						'required'  => array(
    						array('cesis_menu_type','contains','border'),
						),
                        'default'   => '#6d7783',
                        'validate'  => 'color',
                    ),




				       array(
                'id'        => 'tt-notice-info-menu-ads',
                'type'      => 'info',
                'icon' => 'el-icon-info-sign',
                'title'     => __('ADDITIONAL CONTENT SETTINGS.', 'cesis'),
                'desc'      => __('to use an additional Bar on the top of the header please see settings below.', 'cesis')
                ),
                array(
                                'id'        => 'cesis_header_additional_style',
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
                              'id'        => 'cesis_header_a_ctn_border',
                              'type'      => 'color',
                              'title'     => __('Additional elements container border color', 'cesis'),
                              'required'  => array('cesis_header_additional_style', '=', 'additional_border'),
                              'default'   => '#ebebeb',
                              'validate'  => 'color',
                        ),

                array(
                  'id'        => 'cesis_header_additional_type',
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
            				'id'       => 'cesis_header_additional_space',
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
                    'id'        => 'cesis_header_a_color',
                    'type'      => 'color',
                    'title'     => __('Additional elements Color', 'cesis'),
                    'default'   => '#6d7783',
                    'validate'  => 'color',
                ),
                array(
                    'id'        => 'cesis_header_a_bg_color',
                    'type'      => 'color',
                    'title'     => __('Additional elements background Color', 'cesis'),
                    'required'  => array('cesis_header_additional_type', 'not', 'cesis_simple'),
                    'default'   => '#ffffff',
                    'validate'  => 'color',
                ),
                array(
                    'id'        => 'cesis_header_a_border_color',
                    'type'      => 'color',
                    'title'     => __('Additional elements border Color', 'cesis'),
                    'required'  => array('cesis_header_additional_type', 'not', 'cesis_simple'),
                    'default'   => '#ebebeb',
                    'validate'  => 'color',
                ),
                array(
                  'id'        => 'cesis_header_a_hover_color',
                  'type'      => 'color',
                  'title'     => __('Additional elements hover Color', 'cesis'),
                  'default'   => '#3a78ff',
                  'validate'  => 'color',
                ),
                array(
                  'id'        => 'cesis_header_a_hover_bg_color',
                  'type'      => 'color',
                  'title'     => __('Additional elements hover background-color Color', 'cesis'),
                  'required'  => array('cesis_header_additional_type', 'not', 'cesis_simple'),
                  'default'   => '#2c2c2c',
                  'validate'  => 'color',
                ),
                array(
                  'id'        => 'cesis_header_a_hover_border_color',
                  'type'      => 'color',
                  'title'     => __('Additional elements hover border Color', 'cesis'),
                  'required'  => array('cesis_header_additional_type', 'not', 'cesis_simple'),
                  'default'   => '#2c2c2c',
                        'validate'  => 'color',
                ),
                array(

                    'id'       => 'cesis_header_additional_social',
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

                    'id'       => 'cesis_header_additional_search',
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

                    'id'       => 'cesis_header_additional_cart',
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

                    'id'       => 'cesis_header_additional_buddypress',
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

                    'id'       => 'cesis_header_content_block',
                    'type'     => 'button_set',
                    'title'    => __('Use a content block in the header?', 'cesis'),
                    'subtitle' => __('Select if you want to use a content block in the header', 'cesis'),

                    'required'  => array(
                          array('cesis_header_layout','contains','vertical'),
                    ),

                    'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'no'
                ),

                array(
                              'id'        => 'cesis_header_content_block_id',
                              'type'      => 'select',
                						  'required'  => array('cesis_header_content_block','=','yes'),
                              'title'     => __('Select the Block content to use', 'cesis'),
                              'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),
                                    //Must provide key => value pairs for select options
                              'data'   => "content_block",
      						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                              'default'   => ''
                ),

                array(
                              'id'        => 'cesis_header_content_block_position',
                              'type'     => 'button_set',
                						  'required'  => array('cesis_header_content_block','=','yes'),
                              'title'    => __('Show content block before or after additional elements?', 'cesis'),
                              'subtitle' => __('Select the content block position', 'cesis'),

                              'options' => array(
                                  'before' =>  __('Before', 'cesis'),
                                  'after' =>  __('After', 'cesis'),
                               ),
                              'default' => 'before'
                ),
                array(

                    'id'       => 'cesis_header_additional_btn',
                    'type'     => 'button_set',
                    'title'    => __('Display a button in the header?', 'cesis'),
                    'subtitle' => __('Select if you want to use a button in the header', 'cesis'),
                    'required'  => array('cesis_header_layout', 'contains', 'line'),

                    'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'no'
                ),
            array(
                    'id'        => 'cesis_header_a_btn_text',
                    'type'      => 'text',
                    'title'     => __('Button text', 'cesis'),
                    'desc'      => __('Set the button text, ', 'cesis'),
                    'required'  => array('cesis_header_additional_btn', '=', 'yes'),
                    'validate'  => 'html',
                    'default'   => 'Purchase now',
                ),
            array(
                    'id'        => 'cesis_header_a_btn_link',
                    'type'      => 'text',
                    'title'     => __('Button link', 'cesis'),
                    'desc'      => __('Set the button text, ', 'cesis'),
                    'required'  => array('cesis_header_additional_btn', '=', 'yes'),
                    'validate'  => 'no_html',
                    'default'   => 'https://themeforest.net/user/tranmautritam/portfolio',
                ),
                array(

                    'id'       => 'cesis_header_a_btn_target',
                    'type'     => 'button_set',
                    'title'    => __('Open link in a new page?', 'cesis'),
                    'subtitle' => __('Select if you want to open the link in a new page', 'cesis'),
                    'required'  => array('cesis_header_additional_btn', '=', 'yes'),

                    'options' => array(
                        '_blank' =>  __('Yes', 'cesis'),
                        '_self' =>  __('No', 'cesis'),
                     ),
                    'default' => '_self'
                ),
                array(
                    'id'        => 'cesis_header_a_btn_width',
                    'type'      => 'text',
                    'title'     => __('Button width', 'cesis'),
                    'desc'      => __('Set the button width, ', 'cesis'),
                    'required'  => array('cesis_header_additional_btn', '=', 'yes'),
                    'validate'  => 'numeric',
                    'default'   => '160',
                ),
                array(
                    'id'        => 'cesis_header_a_btn_height',
                    'type'      => 'text',
                    'title'     => __('Button height', 'cesis'),
                    'desc'      => __('Set the button height, ', 'cesis'),
                    'required'  => array('cesis_header_additional_btn', '=', 'yes'),
                    'validate'  => 'numeric',
                    'default'   => '40',
                ),
				       array(
    				         'id'       => 'cesis_header_a_btn_border',
    				         'type'     => 'slider',
                     'title'    => __('Button Border Size.', 'cesis'),
                     'subtitle' => __('Select the Button Border Size', 'cesis'),
                     'default' => '2',
                     'required'  => array('cesis_header_additional_btn', '=', 'yes'),
                     'min' => 0,
                     'step' => 1,
                     'max' => 10,
                     'display_value' => 'text',
                   ),
   				       array(
       				         'id'       => 'cesis_header_a_btn_radius',
       				         'type'     => 'slider',
                        'title'    => __('Button Border Radius.', 'cesis'),
                        'subtitle' => __('Select the Button Border Radius', 'cesis'),
                        'default' => '0',
                        'required'  => array('cesis_header_additional_btn', '=', 'yes'),
                        'min' => 0,
                        'step' => 1,
                        'max' => 100,
                        'display_value' => 'text',
                      ),

        					array(
        						'id'          => 'cesis_header_a_btn_font',
        					    'type'        => 'typography',
                                'title'     => __('Menu Text Font and Color Settings', 'cesis'),
                                'subtitle'  => __('Choose the menu text font, size, color.', 'cesis'),
                                'required'  => array('cesis_header_additional_btn', '=', 'yes'),
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
                          'font-weight'  => '500',
        					        'font-family' => 'Roboto',
        					        'google'      => true,
        					        'font-size'   => '13px',
                          'letter-spacing' => '1',
                          'text-transform' => 'uppercase',
        					    ),
        					),
                array(
                    'id'        => 'cesis_header_a_btn_bg_color',
                    'type'      => 'color',
                    'title'     => __('Button background Color', 'cesis'),
                    'required'  => array('cesis_header_additional_btn', '=', 'yes'),
                    'default'   => '#ffffff',
                    'validate'  => 'color',
                ),
                array(
                    'id'        => 'cesis_header_a_btn_border_color',
                    'type'      => 'color',
                    'title'     => __('Button border Color', 'cesis'),
                    'required'  => array('cesis_header_additional_btn', '=', 'yes'),
                    'default'   => '#3a78ff',
                    'validate'  => 'color',
                ),
                array(
                  'id'        => 'cesis_header_a_btn_hover_color',
                  'type'      => 'color',
                  'title'     => __('Button text hover Color', 'cesis'),
                  'required'  => array('cesis_header_additional_btn', '=', 'yes'),
                  'default'   => '#ffffff',
                  'validate'  => 'color',
                ),
                array(
                  'id'        => 'cesis_header_a_btn_hover_bg_color',
                  'type'      => 'color',
                  'title'     => __('Button hover background Color', 'cesis'),
                  'required'  => array('cesis_header_additional_btn', '=', 'yes'),
                  'default'   => '#3a78ff',
                  'validate'  => 'color',
                ),
                array(
                  'id'        => 'cesis_header_a_btn_hover_border_color',
                  'type'      => 'color',
                  'title'     => __('Button hover border Color', 'cesis'),
                  'required'  => array('cesis_header_additional_btn', '=', 'yes'),
                  'default'   => '#3a78ff',
                        'validate'  => 'color',
                ),

                  array(
                    'id'        => 'tt-notice-info-submenu-ads',
                    'type'      => 'info',
                    'icon' => 'el-icon-info-sign',
                    'required'  => array('cesis_header_layout', '=', 'two_line_header'),
                    'title'     => __('Header second line additional content settings.', 'cesis'),
                    ),
                array(
                      'id'        => 'cesis_header_sa_ctn_border',
                      'type'      => 'color',
                      'title'     => __('Additional elements container border color', 'cesis'),
                      'required'  => array(array('cesis_header_layout', '=', 'two_line_header'),array('cesis_header_additional_style', '=', 'additional_border')),
                      'default'   => '#ebebeb',
                      'validate'  => 'color',
                ),
                array(
                      'id'        => 'cesis_header_sa_color',
                      'type'      => 'color',
                      'title'     => __('Additional elements Color', 'cesis'),
                      'required'  => array('cesis_header_layout', '=', 'two_line_header'),
                      'default'   => '#6d7783',
                      'validate'  => 'color',
                ),
                array(
                      'id'        => 'cesis_header_sa_bg_color',
                      'type'      => 'color',
                      'title'     => __('Additional elements Background Color', 'cesis'),
                      'required'  => array( array('cesis_header_layout', '=', 'two_line_header'),array('cesis_header_additional_type', 'not', 'cesis_simple') ),
                      'default'   => '#ffffff',
                      'validate'  => 'color',
                ),
                array(
                      'id'        => 'cesis_header_sa_border_color',
                      'type'      => 'color',
                      'title'     => __('Additional elements Border Color', 'cesis'),
                      'required'  => array( array('cesis_header_layout', '=', 'two_line_header'),array('cesis_header_additional_type', 'not', 'cesis_simple') ),
                      'default'   => '#ebebeb',
                      'validate'  => 'color',
                ),
            array(
                  'id'        => 'cesis_header_sa_hover_color',
                  'type'      => 'color',
                  'title'     => __('Additional elements hover Color', 'cesis'),
                  'required'  => array('cesis_header_layout', '=', 'two_line_header'),
                  'default'   => '#3a78ff',
                  'validate'  => 'color',
            ),
            array(
                  'id'        => 'cesis_header_sa_hover_bg_color',
                  'type'      => 'color',
                  'title'     => __('Additional elements hover Background Color', 'cesis'),
                  'required'  => array( array('cesis_header_layout', '=', 'two_line_header'),array('cesis_header_additional_type', 'not', 'cesis_simple') ),
                  'default'   => '#2c2c2c',
                  'validate'  => 'color',
            ),
            array(
                  'id'        => 'cesis_header_sa_hover_border_color',
                  'type'      => 'color',
                  'title'     => __('Additional elements hover Border Color', 'cesis'),
                  'required'  => array( array('cesis_header_layout', '=', 'two_line_header'),array('cesis_header_additional_type', 'not', 'cesis_simple') ),
                  'default'   => '#2c2c2c',
                  'validate'  => 'color',
            ),
                array(

                    'id'       => 'cesis_header_sub_additional_social',
                    'type'     => 'button_set',
                    'title'    => __('Display social icons in the header second line?', 'cesis'),
                    'subtitle' => __('Select if you want the social icons to show in the header sub part', 'cesis'),
                    'required'  => array('cesis_header_layout', '=', 'two_line_header'),
                    'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'no'
                ),
                array(

                    'id'       => 'cesis_header_sub_additional_search',
                    'type'     => 'button_set',
                    'title'    => __('Display search icon in the header second line?', 'cesis'),
                    'subtitle' => __('Select if you want the search icon in the header sub part', 'cesis'),
                    'required'  => array('cesis_header_layout', '=', 'two_line_header'),
                    'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'no'
                ),
                array(

                    'id'       => 'cesis_header_sub_additional_cart',
                    'type'     => 'button_set',
                    'title'    => __('Display cart icon in the header second line?', 'cesis'),
                    'subtitle' => __('Select if you want the cart icon in the header sub part ( need Woocommerce to be installed )', 'cesis'),
                    'required'  => array('cesis_header_layout', '=', 'two_line_header'),
                    'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'no'
                ),
                array(

                    'id'       => 'cesis_header_sub_additional_buddypress',
                    'type'     => 'button_set',
                    'title'    => __('Display Buddypress notifications in the header sub part ?', 'cesis'),
                    'subtitle' => __('Select if you want the Buddypress notifications to be display in the header sub part ( need Buddypress to be installed )', 'cesis'),
                    'required'  => array('cesis_header_layout', '=', 'two_line_header'),
                    'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'no'
                ),



        )
    ) );


  Redux::setSection( $opt_name, array(
      'title'      => __( 'Header Presets', 'cesis' ),
      'desc'       => __( 'Some header presets', 'cesis' ),
      'id'         => 'tt-header-presets',
      'subsection' => true,
      'fields'     => array(
      array(
        'id'       => 'header-presets',
        'type'     => 'image_select',
        'presets'  => true,
        'title'    => __('Color Preset', 'cesis'),
        'subtitle' => __('Select the color you want to use for the theme.', 'cesis'),
        'options'  => array(
          // Array of preset options
          '1'      => array(
            'alt'   => 'default',
            'img'   => ReduxFramework::$_url.'assets/img/header_1.jpg',
            'presets'   => array(
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'one_line_header',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '90',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '50',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_left',
            'cesis_menu_type' => 'nav_normal',
            'cesis_menu_pos' => 'menu_right',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '13px',
                'letter-spacing' => '1',
                'text-transform' => 'uppercase',
            ),
            'cesis_menu_border_pos' => 'edge_border',
            'cesis_menu_border_size' => '3',
            'cesis_menu_border_radius' => '0',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '30',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#6d7783',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'no',
            'cesis_header_additional_search' => 'yes',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '2'      => array(
            'alt'   => '/ separator',
            'img'   => ReduxFramework::$_url.'assets/img/header_2.jpg',
            'presets'   => array(
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'one_line_header',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '90',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '50',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_left',
            'cesis_menu_type' => 'nav_separator',
            'cesis_menu_pos' => 'menu_right',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '13px',
                'letter-spacing' => '1',
                'text-transform' => 'uppercase',
            ),
            'cesis_menu_border_pos' => 'edge_border',
            'cesis_menu_border_size' => '3',
            'cesis_menu_border_radius' => '0',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '30',
            'cesis_menu_sep_color' => '#bcbcbc',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#6d7783',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'no',
            'cesis_header_additional_search' => 'yes',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '3'      => array(
            'alt'   => 'line separator',
            'img'   => ReduxFramework::$_url.'assets/img/header_3.jpg',
            'presets'   => array(
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'one_line_header',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '90',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '50',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_left',
            'cesis_menu_type' => 'nav_line_separator',
            'cesis_menu_pos' => 'menu_right',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '13px',
                'letter-spacing' => '1',
                'text-transform' => 'uppercase',
            ),
            'cesis_menu_border_pos' => 'edge_border',
            'cesis_menu_border_size' => '3',
            'cesis_menu_border_radius' => '0',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '45',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#6d7783',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'no',
            'cesis_header_additional_search' => 'yes',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '4'      => array(
            'alt'   => 'bottom border edge',
            'img'   => ReduxFramework::$_url.'assets/img/header_4.jpg',
            'presets'   => array(
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'one_line_header',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '90',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '50',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_left',
            'cesis_menu_type' => 'nav_bottom_borderx',
            'cesis_menu_pos' => 'menu_right',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '13px',
                'letter-spacing' => '1',
                'text-transform' => 'uppercase',
            ),
            'cesis_menu_border_pos' => 'edge_border',
            'cesis_menu_border_size' => '4',
            'cesis_menu_border_radius' => '0',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '40',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#3a78ff',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'no',
            'cesis_header_additional_search' => 'yes',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '5'      => array(
            'alt'   => 'top border edge',
            'img'   => ReduxFramework::$_url.'assets/img/header_5.jpg',
            'presets'   => array(
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'one_line_header',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '90',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '50',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_left',
            'cesis_menu_type' => 'nav_top_borderx',
            'cesis_menu_pos' => 'menu_right',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '13px',
                'letter-spacing' => '1',
                'text-transform' => 'uppercase',
            ),
            'cesis_menu_border_pos' => 'edge_border',
            'cesis_menu_border_size' => '4',
            'cesis_menu_border_radius' => '0',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '40',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#3a78ff',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'no',
            'cesis_header_additional_search' => 'yes',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '6'      => array(
            'alt'   => 'bottom border text',
            'img'   => ReduxFramework::$_url.'assets/img/header_6.jpg',
            'presets'   => array(
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'one_line_header',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '90',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '50',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_left',
            'cesis_menu_type' => 'nav_bottom_borderx',
            'cesis_menu_pos' => 'menu_right',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '13px',
                'letter-spacing' => '1',
                'text-transform' => 'uppercase',
            ),
            'cesis_menu_border_pos' => 'text_border',
            'cesis_menu_border_size' => '2',
            'cesis_menu_border_radius' => '0',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '35',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#3a78ff',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'no',
            'cesis_header_additional_search' => 'yes',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '7'      => array(
            'alt'   => 'top border text',
            'img'   => ReduxFramework::$_url.'assets/img/header_7.jpg',
            'presets'   => array(
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'one_line_header',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '90',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '50',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_left',
            'cesis_menu_type' => 'nav_top_borderx',
            'cesis_menu_pos' => 'menu_right',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '13px',
                'letter-spacing' => '1',
                'text-transform' => 'uppercase',
            ),
            'cesis_menu_border_pos' => 'text_border',
            'cesis_menu_border_size' => '2',
            'cesis_menu_border_radius' => '0',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '35',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#3a78ff',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'no',
            'cesis_header_additional_search' => 'yes',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '8'      => array(
            'alt'   => 'squared boxed',
            'img'   => ReduxFramework::$_url.'assets/img/header_8.jpg',
            'presets'   => array(
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'one_line_header',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '90',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '50',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_left',
            'cesis_menu_type' => 'nav_boxed_border',
            'cesis_menu_pos' => 'menu_right',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '13px',
                'letter-spacing' => '1',
                'text-transform' => 'uppercase',
            ),
            'cesis_menu_border_pos' => 'text_border',
            'cesis_menu_border_size' => '2',
            'cesis_menu_border_radius' => '0',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '20',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#3a78ff',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'no',
            'cesis_header_additional_search' => 'yes',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '9'      => array(
            'alt'   => 'rounded boxed',
            'img'   => ReduxFramework::$_url.'assets/img/header_9.jpg',
            'presets'   => array(
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'one_line_header',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '90',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '50',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_left',
            'cesis_menu_type' => 'nav_boxed_border',
            'cesis_menu_pos' => 'menu_right',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '13px',
                'letter-spacing' => '1',
                'text-transform' => 'uppercase',
            ),
            'cesis_menu_border_pos' => 'text_border',
            'cesis_menu_border_size' => '2',
            'cesis_menu_border_radius' => '10',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '20',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#3a78ff',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'no',
            'cesis_header_additional_search' => 'yes',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '10'      => array(
            'alt'   => 'circle boxed',
            'img'   => ReduxFramework::$_url.'assets/img/header_10.jpg',
            'presets'   => array(
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'one_line_header',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '90',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '60',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_left',
            'cesis_menu_type' => 'nav_boxed_border',
            'cesis_menu_pos' => 'menu_right',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '13px',
                'letter-spacing' => '1',
                'text-transform' => 'uppercase',
            ),
            'cesis_menu_border_pos' => 'text_border',
            'cesis_menu_border_size' => '2',
            'cesis_menu_border_radius' => '100',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '15px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '15px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '15',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#3a78ff',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'no',
            'cesis_header_additional_search' => 'yes',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '11'      => array(
            'alt'   => 'two line',
            'img'   => ReduxFramework::$_url.'assets/img/header_11.jpg',
            'presets'   => array(
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'two_line_header',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '70',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '60',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_left',
            'cesis_menu_type' => 'nav_normal',
            'cesis_menu_pos' => 'menu_left',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '14px',
                'letter-spacing' => '0',
                'text-transform' => 'none',
            ),
            'cesis_menu_border_pos' => 'text_border',
            'cesis_menu_border_size' => '2',
            'cesis_menu_border_radius' => '100',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '48',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#3a78ff',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'yes',
            'cesis_header_additional_search' => 'no',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'yes',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '12'      => array(
            'alt'   => 'two line center',
            'img'   => ReduxFramework::$_url.'assets/img/header_12.jpg',
            'presets'   => array(
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'two_line_header',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '80',
            'cesis_header_sub_bg_color' => '#fcfcfc',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '60',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_center',
            'cesis_menu_type' => 'nav_normal',
            'cesis_menu_pos' => 'menu_center',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '14px',
                'letter-spacing' => '0',
                'text-transform' => 'none',
            ),
            'cesis_menu_border_pos' => 'text_border',
            'cesis_menu_border_size' => '2',
            'cesis_menu_border_radius' => '100',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '48',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#3a78ff',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'no',
            'cesis_header_additional_search' => 'no',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '13'      => array(
            'alt'   => 'two line center border',
            'img'   => ReduxFramework::$_url.'assets/img/header_13.jpg',
            'presets'   => array(
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'two_line_header',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '80',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '60',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_center',
            'cesis_menu_type' => 'nav_bottom_borderx',
            'cesis_menu_pos' => 'menu_center',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '13px',
                'letter-spacing' => '1',
                'text-transform' => 'uppercase',
            ),
            'cesis_menu_border_pos' => 'edge_border',
            'cesis_menu_border_size' => '3',
            'cesis_menu_border_radius' => '100',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '48',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#3a78ff',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'no',
            'cesis_header_additional_search' => 'no',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '14'      => array(
            'alt'   => 'one line center',
            'img'   => ReduxFramework::$_url.'assets/img/header_14.jpg',
            'presets'   => array(
            'cesis_header_width' => '1240px',
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'one_line_header',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '90',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '60',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_center',
            'cesis_menu_type' => 'nav_normal',
            'cesis_menu_pos' => 'menu_center',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '13px',
                'letter-spacing' => '1',
                'text-transform' => 'uppercase',
            ),
            'cesis_menu_border_pos' => 'edge_border',
            'cesis_menu_border_size' => '3',
            'cesis_menu_border_radius' => '100',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '60',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#3a78ff',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'no',
            'cesis_header_additional_search' => 'no',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '15'      => array(
            'alt'   => 'offcanvas',
            'img'   => ReduxFramework::$_url.'assets/img/header_15.jpg',
            'presets'   => array(
            'cesis_header_width' =>  array(
              'width'   => '100',
              'units' => '%'
            ),
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'vertical_offcanvas_header_b',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '90',
            'cesis_header_v_pos' => 'header_v_pos_right',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '60',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_center',
            'cesis_menu_type' => 'nav_normal',
            'cesis_menu_pos' => 'menu_center',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '13px',
                'letter-spacing' => '1',
                'text-transform' => 'uppercase',
            ),
            'cesis_menu_border_pos' => 'edge_border',
            'cesis_menu_border_size' => '3',
            'cesis_menu_border_radius' => '100',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '15',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#3a78ff',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'no',
            'cesis_header_additional_search' => 'no',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '17'      => array(
            'alt'   => 'offcanvas',
            'img'   => ReduxFramework::$_url.'assets/img/header_17.jpg',
            'presets'   => array(
            'cesis_header_width' =>  array(
              'width'   => '100',
              'units' => '%'
            ),
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'vertical_header',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '90',
            'cesis_header_v_pos' => 'header_v_pos_left',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '60',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_left',
            'cesis_menu_type' => 'nav_normal',
            'cesis_menu_pos' => 'menu_right',
            'cesis_menu_font' => array(
                'color'       => '#6d7783',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '13px',
                'letter-spacing' => '1',
                'text-transform' => 'uppercase',
            ),
            'cesis_menu_border_pos' => 'edge_border',
            'cesis_menu_border_size' => '3',
            'cesis_menu_border_radius' => '100',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '15',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#3a78ff',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'yes',
            'cesis_header_additional_search' => 'no',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
          '16'      => array(
            'alt'   => 'offcanvas',
            'img'   => ReduxFramework::$_url.'assets/img/header_16.jpg',
            'presets'   => array(
            'cesis_header_width' =>  array(
              'width'   => '100',
              'units' => '%'
            ),
            'cesis_top_bar_bg_color'     => '#151a1d',
            'cesis_top_bar_border_color'    => '#9ca3b1',
            'cesis_top_bar_text_color'    => '#9ca3b1',
            'cesis_top_bar_hl_color' => '#ffffff',
            'cesis_top_bar_hover_color' => '#ffffff',

            'cesis_header_layout' => 'overlay_header_b',
            'cesis_header_bg_color' => '#ffffff',
            'cesis_header_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),

            'cesis_header_openmenu_color' => '#6d7783',


            'cesis_header_height' => '90',
            'cesis_header_v_pos' => 'header_v_pos_right',
            'cesis_header_sub_bg_color' => '#ffffff',


            'cesis_header_sub_border_color' => array(
              'color'     => '#ebebeb',
              'alpha'     => '0.5',
              'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '0.5' ),
              ),
            'cesis_header_sub_height' => '60',
            'cesis_header_offcanvas_bg_color' => '#ffffff',
            'cesis_header_v_content_ypos' => 'header_v_cy_top',
            'cesis_logo_pos' => 'logo_left',
            'cesis_menu_type' => 'nav_normal',
            'cesis_menu_pos' => 'menu_right',
            'cesis_menu_font' => array(
                'color'       => '#ffffff',
                'line-height'  => false,
                'font-weight'  => '500',
                'font-family' => 'Roboto',
                'google'      => true,
                'font-size'   => '13px',
                'letter-spacing' => '1',
                'text-transform' => 'uppercase',
            ),
            'cesis_menu_border_pos' => 'edge_border',
            'cesis_menu_border_size' => '3',
            'cesis_menu_border_radius' => '100',
            'cesis_menu_span_padding' => array(
				        'padding-top'     => '5px',
				        'padding-right'   => '10px',
				        'padding-bottom'     => '5px',
				        'padding-left'   => '10px',
				        'units'          => 'px',
              ),
            'cesis_menu_space' => '15',
            'cesis_menu_sep_color' => '#ecf0f1',
            'cesis_current_menu_color' => '#3a78ff',
            'cesis_current_menu_bg_color' => '#ffffff',
            'cesis_menu_border_color' => '#3a78ff',
            'cesis_header_additional_style' => 'additional_simple',
            'cesis_header_a_ctn_border' => '#ebebeb',
            'cesis_header_additional_type' => 'simple',
            'cesis_header_additional_space' => '20',
            'cesis_header_a_color' => '#6d7783',
            'cesis_header_a_bg_color' => '#ffffff',
            'cesis_header_a_border_color' => '#ebebeb',
            'cesis_header_a_hover_color' => '#3a78ff',
            'cesis_header_a_hover_bg_color' => '#2c2c2c',
            'cesis_header_a_hover_border_color' => '#2c2c2c',
            'cesis_header_additional_social' => 'no',
            'cesis_header_additional_search' => 'no',
            'cesis_header_additional_cart' => 'no',
            'cesis_header_additional_buddypress' => 'no',
            'cesis_header_sa_ctn_border' => '#ebebeb',
            'cesis_header_sa_color' => '#6d7783',
            'cesis_header_sa_bg_color' => '#ffffff',
            'cesis_header_sa_border_color' => '#ebebeb',
            'cesis_header_sa_hover_color' => '#3a78ff',
            'cesis_header_sa_hover_bg_color' => '#2c2c2c',
            'cesis_header_sa_hover_border_color' => '#2c2c2c',
            'cesis_header_sub_additional_social' => 'no',
            'cesis_header_sub_additional_search' => 'no',
            'cesis_header_sub_additional_cart' => 'no',
            'cesis_header_sub_additional_buddypress' => 'no',


          )),
        ),
      ),



    )

  ));


            Redux::setSection( $opt_name, array(
                'title'      => __( 'Dropdown', 'cesis' ),
                'desc'       => __( 'All the settings for the Menu Dropdown, for full documentation on this field, visit: ', 'cesis' ) . '<a href="https://cesis.co/wp-content/uploads/documentation/cesis_documentation.html" target="_blank">Cesis Header Top Bar Documentation</a>',
                'id'         => 'tt-header-dropdown',
                'subsection' => true,
                'fields'     => array(
                  array(
                    'id'        => 'cesis_dropdown_bg',
                    'type'      => 'color_rgba',
                    'title'     => __('Dropdown Background Color', 'cesis'),
                    'subtitle'  => __('Dropdown background color.', 'cesis'),
                    'default'   => array(
                      'color'     => '#ffffff',
                      'alpha'     => '1',
                      'rgba' => Redux_Helpers::hex2rgba ( '#ffffff', '1' ),
                    ),
      						'options'       => array(
      					        'clickout_fires_change'     => true,
      						),
                  ),
                  array(
                    'id'        => 'cesis_dropdown_border',
                    'type'      => 'color_rgba',
                    'title'     => __('Dropdown Border Color', 'cesis'),
                    'subtitle'  => __('Dropdown border color.', 'cesis'),
                    'default'   => array(
                      'color'     => '#ebebeb',
                      'alpha'     => '1',
                      'rgba' => Redux_Helpers::hex2rgba ( '#ebebeb', '1' ),
                    ),
      						'options'       => array(
      					        'clickout_fires_change'     => true,
      						),
                  ),
                  array(
        						'id'       => 'cesis_dropdown_font',
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
        					    'font-family' => 'Roboto',
        					    'google'      => true,
        					    'font-size'   => '14px',
                      'letter-spacing' => '0',
                      'text-transform' => 'none',
        					  ),
        					),
                  array(
                    'id'        => 'cesis_dropdown_hover_color',
                    'type'      => 'color',
                    'title'     => __('Dropdown Hover Text Color', 'cesis'),
                    'subtitle'  => __('Dropdown Hover text color', 'cesis'),
                    'default'   => '#293340',
                    'validate'  => 'color',
                  ),
                  array(
                    'id'        => 'cesis_dropdown_hover_bg_color',
                    'type'      => 'color',
                    'title'     => __('Dropdown Hover Text Background Color', 'cesis'),
                    'subtitle'  => __('Dropdown Hover text background color', 'cesis'),
                    'default'   => '#f5f8f9',
                    'validate'  => 'color',
                  ),
                  array(
                    'id'        => 'cesis_dropdown_active',
                    'type'      => 'color',
                    'title'     => __('Dropdown active / accent Color', 'cesis'),
                    'subtitle'  => __('Dropdown active / accent color', 'cesis'),
                    'default'   => '#3a78ff',
                    'validate'  => 'color',
                  ),
                  array(
        						'id'       => 'cesis_dropdown_heading',
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
                      'font-weight'  => '500',
        					    'font-family' => 'Roboto',
        					    'google'      => true,
        					    'font-size'   => '13px',
                      'letter-spacing' => '1',
                      'text-transform' => 'uppercase',
        					  ),
        					),
                )
            ) );

            Redux::setSection( $opt_name, array(
              'title'      => __( 'Mobile Menu', 'cesis' ),
              'desc'       => __( 'All the settings for the Mobile menu', 'cesis' ),
              'id'         => 'tt-header-mobile-menu',
              'subsection' => true,
              'fields'     => array(

                array(

                    'id'       => 'cesis_mobile_design',
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
                  'id'       => 'cesis_header_breakpoint',
                  'type'     => 'text',
                  'title'     => __('Mobile Header Breakpoint', 'cesis'),
                  'subtitle'  => __('Select the window size you want the header to switch to the mobile style.', 'cesis'),
                  'validate' => 'numeric',
                  'default'  => '978'
                ),
                array(
                  'id'       => 'cesis_mobile_menu_height',
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
                  'id'        => 'cesis_mobile_menu_bg',
                  'type'      => 'color',
                  'title'     => __('Mobile Menu background Color', 'cesis'),
                  'subtitle'  => __('Select the background color for the Mobile.', 'cesis'),
                  'default'   => '#ffffff',
                  'validate'  => 'color',
                ),
                array(
                  'id'        => 'cesis_mobile_menu_border',
                  'type'      => 'color',
                  'title'     => __('Mobile Menu border Color', 'cesis'),
                  'subtitle'  => __('Select the border color for the Mobile.', 'cesis'),
                  'default'   => '#f7f9fb',
                  'validate'  => 'color',
                ),

                array(
      						'id'          => 'cesis_mobile_menu_font',
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
                        'font-family' => 'Roboto',
      					        'google'      => true,
      					        'font-size'   => '15px',
                        'line-height'   => '24px',
                        'letter-spacing' => '0',
                        'text-transform' => 'none',
      					    ),
      					),

                array(
      						'id'          => 'cesis_mobile_sub_menu_font',
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
                        'font-family' => 'Roboto',
      					        'google'      => true,
      					        'font-size'   => '14px',
                        'line-height'   => '24px',
                        'letter-spacing' => '0',
                        'text-transform' => 'none',
      					    ),
      					),

                array(
                  'id'        => 'cesis_mobile_open_menu',
                  'type'      => 'color',
                  'title'     => __('Active / Expanded Menu Item Color', 'cesis'),
                  'subtitle'  => __('Select the color for the Current Menu Item.', 'cesis'),
                  'default'   => '#4251f4',
                  'validate'  => 'color',
                ),

      					array(
                  'id'        => 'cesis_mobile_current_menu',
                  'type'      => 'color',
                  'title'     => __('Current Menu Item Color', 'cesis'),
                  'subtitle'  => __('Select the color for the Current Menu Item.', 'cesis'),
      						'default'   => '#3a78ff',
                  'validate'  => 'color',
                ),
                array(

                    'id'       => 'cesis_mobile_social',
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

                    'id'       => 'cesis_mobile_search',
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

                    'id'       => 'cesis_mobile_cart',
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

                    'id'       => 'cesis_mobile_notifications',
                    'type'     => 'button_set',
                    'title'    => __('Display Buddypress notifications in the mobile menu?', 'cesis'),
                    'subtitle' => __('Select if you want the Buddypress notifications to be display in the mobile menu ( need Buddypress to be installed )', 'cesis'),

                    'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'no'
                ),
                array(

                    'id'       => 'cesis_mobile_additional_btn',
                    'type'     => 'button_set',
                    'title'    => __('Display a button in the mobile header?', 'cesis'),
                    'subtitle' => __('Select if you want to use a button in the mobile header', 'cesis'),

                    'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'no'
                ),
            array(
                    'id'        => 'cesis_mobile_a_btn_text',
                    'type'      => 'text',
                    'title'     => __('Button text', 'cesis'),
                    'desc'      => __('Set the button text, ', 'cesis'),
                    'required'  => array('cesis_mobile_additional_btn', '=', 'yes'),
                    'validate'  => 'html',
                    'default'   => 'Purchase now',
                ),
            array(
                    'id'        => 'cesis_mobile_a_btn_link',
                    'type'      => 'text',
                    'title'     => __('Button link', 'cesis'),
                    'desc'      => __('Set the button text, ', 'cesis'),
                    'required'  => array('cesis_mobile_additional_btn', '=', 'yes'),
                    'validate'  => 'no_html',
                    'default'   => 'https://themeforest.net/user/tranmautritam/portfolio',
                ),
                array(

                    'id'       => 'cesis_mobile_a_btn_target',
                    'type'     => 'button_set',
                    'title'    => __('Open link in a new page?', 'cesis'),
                    'subtitle' => __('Select if you want to open the link in a new page', 'cesis'),
                    'required'  => array('cesis_mobile_additional_btn', '=', 'yes'),

                    'options' => array(
                        '_blank' =>  __('Yes', 'cesis'),
                        '_self' =>  __('No', 'cesis'),
                     ),
                    'default' => '_self'
                ),
                array(
                    'id'        => 'cesis_mobile_a_btn_width',
                    'type'      => 'text',
                    'title'     => __('Button width', 'cesis'),
                    'desc'      => __('Set the button width, ', 'cesis'),
                    'required'  => array('cesis_mobile_additional_btn', '=', 'yes'),
                    'validate'  => 'numeric',
                    'default'   => '160',
                ),
                array(
                    'id'        => 'cesis_mobile_a_btn_height',
                    'type'      => 'text',
                    'title'     => __('Button height', 'cesis'),
                    'desc'      => __('Set the button height, ', 'cesis'),
                    'required'  => array('cesis_mobile_additional_btn', '=', 'yes'),
                    'validate'  => 'numeric',
                    'default'   => '40',
                ),
				       array(
    				         'id'       => 'cesis_mobile_a_btn_border',
    				         'type'     => 'slider',
                     'title'    => __('Button Border Size.', 'cesis'),
                     'subtitle' => __('Select the Button Border Size', 'cesis'),
                     'default' => '2',
                     'required'  => array('cesis_mobile_additional_btn', '=', 'yes'),
                     'min' => 0,
                     'step' => 1,
                     'max' => 10,
                     'display_value' => 'text',
                   ),
   				       array(
       				         'id'       => 'cesis_mobile_a_btn_radius',
       				         'type'     => 'slider',
                        'title'    => __('Button Border Radius.', 'cesis'),
                        'subtitle' => __('Select the Button Border Radius', 'cesis'),
                        'default' => '0',
                        'required'  => array('cesis_mobile_additional_btn', '=', 'yes'),
                        'min' => 0,
                        'step' => 1,
                        'max' => 100,
                        'display_value' => 'text',
                      ),

        					array(
        						'id'          => 'cesis_mobile_a_btn_font',
        					    'type'        => 'typography',
                                'title'     => __('Menu Text Font and Color Settings', 'cesis'),
                                'subtitle'  => __('Choose the menu text font, size, color.', 'cesis'),
                                'required'  => array('cesis_header_additional_btn', '=', 'yes'),
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
                          'font-weight'  => '500',
        					        'font-family' => 'Roboto',
        					        'google'      => true,
        					        'font-size'   => '13px',
                          'letter-spacing' => '1',
                          'text-transform' => 'uppercase',
        					    ),
        					),
                array(
                    'id'        => 'cesis_mobile_a_btn_bg_color',
                    'type'      => 'color',
                    'title'     => __('Button background Color', 'cesis'),
                    'required'  => array('cesis_mobile_additional_btn', '=', 'yes'),
                    'default'   => '#ffffff',
                    'validate'  => 'color',
                ),
                array(
                    'id'        => 'cesis_mobile_a_btn_border_color',
                    'type'      => 'color',
                    'title'     => __('Button border Color', 'cesis'),
                    'required'  => array('cesis_mobile_additional_btn', '=', 'yes'),
                    'default'   => '#3a78ff',
                    'validate'  => 'color',
                ),
                array(
                  'id'        => 'cesis_mobile_a_btn_hover_color',
                  'type'      => 'color',
                  'title'     => __('Button text hover Color', 'cesis'),
                  'required'  => array('cesis_mobile_additional_btn', '=', 'yes'),
                  'default'   => '#ffffff',
                  'validate'  => 'color',
                ),
                array(
                  'id'        => 'cesis_mobile_a_btn_hover_bg_color',
                  'type'      => 'color',
                  'title'     => __('Button hover background Color', 'cesis'),
                  'required'  => array('cesis_mobile_additional_btn', '=', 'yes'),
                  'default'   => '#3a78ff',
                  'validate'  => 'color',
                ),
                array(
                  'id'        => 'cesis_mobile_a_btn_hover_border_color',
                  'type'      => 'color',
                  'title'     => __('Button hover border Color', 'cesis'),
                  'required'  => array('cesis_mobile_additional_btn', '=', 'yes'),
                  'default'   => '#3a78ff',
                        'validate'  => 'color',
                ),



                )
                ) );


    Redux::setSection( $opt_name, array(
        'title'  => __( 'Main Content Settings', 'cesis' ),
        'id'     => 'tt-main-content',
        'desc'   => __( 'Main Content settings. For more detailed options check the documentation : .', 'cesis' ),
        'icon'   => 'fa-main-content ',
        'fields' => array(

			array(
				   'id'   => 'cesis_main_content_color_info_box',
				   'type' => 'info',
				   'style' => 'success',
				   'title' => __('MAIN COLOR SETTINGS.', 'cesis'),
				   'desc' => __('Color settings, will be used for the main content area.', 'cesis')
			),
			array(
                   'id'        => 'cesis_main_content_bg',
                   'type'      => 'color',
                   'title'     => __('Main content background color', 'cesis'),
                   'subtitle'  => __('Background color of the main content area.', 'cesis'),
                   'default'   => '#ffffff',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_border',
                   'type'      => 'color',
                   'title'     => __('Main content border color', 'cesis'),
                   'subtitle'  => __('Border color of the main content area.', 'cesis'),
                   'default'   => '#edf0f7',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_heading',
                   'type'      => 'color',
                   'title'     => __('Main content heading / bold color', 'cesis'),
                   'subtitle'  => __('Heading and Bold element color of the main content area.', 'cesis'),
                   'default'   => '#293340',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_color',
                   'type'      => 'color',
                   'title'     => __('Main content text color', 'cesis'),
                   'subtitle'  => __('Text color of the main content area.', 'cesis'),
                   'default'   => '#6d7783',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_light_color',
                   'type'      => 'color',
                   'title'     => __('Main content light text color', 'cesis'),
                   'subtitle'  => __('Light Text color for main content area.', 'cesis'),
                   'default'   => '#aeb7c1',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_accent_one',
                   'type'      => 'color',
                   'title'     => __('Main content first Accent color', 'cesis'),
                   'subtitle'  => __('First Accent color of the main content area.', 'cesis'),
                   'default'   => '#3a78ff',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_accent_two',
                   'type'      => 'color',
                   'title'     => __('Main content Second Accent color', 'cesis'),
                   'subtitle'  => __('Second Accent color of the main content area.', 'cesis'),
                   'default'   => '#4251f4',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_accent_three',
                   'type'      => 'color',
                   'title'     => __('Main content Third Accent color', 'cesis'),
                   'subtitle'  => __('Third Accent color of the main content area.', 'cesis'),
                   'default'   => '#acd373',
                   'validate'  => 'color',
	        ),
			array(
				   'id'   => 'cesis_main_content_alt_color_info_box',
				   'type' => 'info',
				   'style' => 'success',
				   'title' => __('ALTERNATE COLOR SETTINGS.', 'cesis'),
				   'desc' => __('Alternate Color settings, will be used for the main content sub-area ( grey area in our default design ).', 'cesis')
			),
			array(
                   'id'        => 'cesis_main_content_alt_bg',
                   'type'      => 'color',
                   'title'     => __('Main content altermate background color', 'cesis'),
                   'subtitle'  => __('Background color of the main content alternate area ( grey area in our default design ).', 'cesis'),
                   'default'   => '#f7f9fb',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_alt_border',
                   'type'      => 'color',
                   'title'     => __('Main content alternate border color', 'cesis'),
                   'subtitle'  => __('Border color of the main content alternate area.', 'cesis'),
                   'default'   => '#e7ebf0',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_alt_heading',
                   'type'      => 'color',
                   'title'     => __('Main content alternate heading / bold color', 'cesis'),
                   'subtitle'  => __('Heading and Bold element color of the main content alternate area.', 'cesis'),
                   'default'   => '#293340',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_alt_color',
                   'type'      => 'color',
                   'title'     => __('Main content alternate text color', 'cesis'),
                   'subtitle'  => __('Text color of the main content alternate area.', 'cesis'),
                   'default'   => '#aeb7c1',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_alt_light_color',
                   'type'      => 'color',
                   'title'     => __('Main content alternate light text color', 'cesis'),
                   'subtitle'  => __('Light Text color for main content alternate area.', 'cesis'),
                   'default'   => '#aeb7c1',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_alt_accent_one',
                   'type'      => 'color',
                   'title'     => __('Main content alternate first Accent color', 'cesis'),
                   'subtitle'  => __('First Accent color of the main content alternate area.', 'cesis'),
                   'default'   => '#3a78ff',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_alt_accent_two',
                   'type'      => 'color',
                   'title'     => __('Main content alternate Second Accent color', 'cesis'),
                   'subtitle'  => __('Second Accent color of the main content alternate area.', 'cesis'),
                   'default'   => '#4251f4',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_alt_accent_three',
                   'type'      => 'color',
                   'title'     => __('Main content alternate Third Accent color', 'cesis'),
                   'subtitle'  => __('Third Accent color of the main content alternate area.', 'cesis'),
                   'default'   => '#acd373',
                   'validate'  => 'color',
	        ),

			array(
				   'id'   => 'cesis_main_content_buttons_info_box',
				   'type' => 'info',
				   'style' => 'success',
				   'title' => __('BUTTONS COLOR SETTINGS.', 'cesis'),
				   'desc' => __('Buttons and Button like elements ( tag cloud etc... ) Color settings for the main area ( Two different button options available ).', 'cesis')
			),
			array(
						'id'          => 'cesis_main_content_button_font',
					    'type'        => 'typography',
                        'title'     => __('First Button font', 'cesis'),
                        'subtitle'  => __('Choose the Button text font.', 'cesis'),
					    'google'      => true,
					    'font-backup' => true,
					    'units'       =>'px',
						'line-height' => true,
						'text-align' => false,
						'color' => false,
						'letter-spacing' => true,
						'text-transform' => true,
					    'default'     => array(
					        'font-weight'  => '500',
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '15px',
					        'line-height'   => '48px',
							'letter-spacing' => '0px',
							'text-transform' => 'none',
					    ),
			),
			 array(
                        'id'        => 'cesis_main_content_button_shadow',
                        'type'     => 'button_set',
                        'title'     => __('Use drop down shadow for the First button?', 'cesis'),
                        'subtitle'  => __('Select if you want to have a shadow effect for the button.', 'cesis'),
                        'options' => array(
					        'yes' =>  __('Yes', 'cesis'),
					        'no' =>  __('No', 'cesis'),
					     ),
					    'default' => 'no'


			),
			array(
                   'id'        => 'cesis_main_content_button_text',
                   'type'      => 'color',
                   'title'     => __('First Button text color', 'cesis'),
                   'subtitle'  => __('Button text color.', 'cesis'),
                   'default'   => '#ffffff',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_button_background',
                   'type'      => 'color_rgba',
                   'title'     => __('First Button background color', 'cesis'),
                   'subtitle'  => __('Button background color.', 'cesis'),
				   'default'   => array(
    					    'color'     => '#3a78ff',
     						'alpha'     => 1,
                'rgba' => Redux_Helpers::hex2rgba ( '#3a78ff', '1' ),
   						),
						'options'       => array(
					        'clickout_fires_change' => true,
						),
	        ),
			array(
                   'id'        => 'cesis_main_content_button_border',
                   'type'      => 'color_rgba',
                   'title'     => __('First Button border color', 'cesis'),
                   'subtitle'  => __('Button border color.', 'cesis'),
				   'default'   => array(
    					    'color'     => '#3a78ff',
     						'alpha'     => 1,
                'rgba' => Redux_Helpers::hex2rgba ( '#3a78ff', '1' ),
   					),
					'options'  => array(
					        'clickout_fires_change' => true,
					),
	        ),
			array(
                   'id'        => 'cesis_main_content_button_hover_text',
                   'type'      => 'color',
                   'title'     => __('First Button hover text color', 'cesis'),
                   'subtitle'  => __('Button hover text color.', 'cesis'),
                   'default'   => '#ffffff',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_button_hover_background',
                   'type'      => 'color_rgba',
                   'title'     => __('First Button hover background color', 'cesis'),
                   'subtitle'  => __('Button hover background color.', 'cesis'),
				   'default'   => array(
    					    'color'     => '#2a2d2e',
     						'alpha'     => 1,
                'rgba' => Redux_Helpers::hex2rgba ( '#2a2d2e', '1' ),
   						),
						'options'       => array(
					        'clickout_fires_change' => true,
						),
	        ),
			array(
                   'id'        => 'cesis_main_content_button_hover_border',
                   'type'      => 'color_rgba',
                   'title'     => __('First Button Hover border color', 'cesis'),
                   'subtitle'  => __('Button Hover border color.', 'cesis'),
				   'default'   => array(
    					    'color'     => '#2a2d2e',
     						'alpha'     => 1,
                'rgba' => Redux_Helpers::hex2rgba ( '#2a2d2e', '1' ),
   					),
					'options'  => array(
					        'clickout_fires_change' => true,
					),
	        ),
			array(
						'id'          => 'cesis_main_content_alt_button_font',
					    'type'        => 'typography',
                        'title'     => __('Second Button font', 'cesis'),
                        'subtitle'  => __('Choose the Button text font.', 'cesis'),
					    'google'      => true,
					    'font-backup' => true,
					    'units'       =>'px',
						'line-height' => true,
						'text-align' => false,
						'color' => false,
						'letter-spacing' => true,
						'text-transform' => true,
					    'default'     => array(
					        'font-weight'  => '500',
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '15px',
					        'line-height'   => '48px',
							'letter-spacing' => '0px',
							'text-transform' => 'none',
					    ),
			),
			 array(
                        'id'        => 'cesis_main_content_alt_button_shadow',
                        'type'     => 'button_set',
                        'title'     => __('Use drop down shadow for the Second button?', 'cesis'),
                        'subtitle'  => __('Select if you want to have a shadow effect for the button.', 'cesis'),
                        'options' => array(
					        'yes' =>  __('Yes', 'cesis'),
					        'no' =>  __('No', 'cesis'),
					     ),
					    'default' => 'no'


			),

			array(
                   'id'        => 'cesis_main_content_alt_button_text',
                   'type'      => 'color',
                   'title'     => __('Second Button text color', 'cesis'),
                   'subtitle'  => __('Button text color.', 'cesis'),
                   'default'   => '#293340',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_alt_button_background',
                   'type'      => 'color_rgba',
                   'title'     => __('Second Button background color', 'cesis'),
                   'subtitle'  => __('Button background color.', 'cesis'),
				   'default'   => array(
    					    'color'     => '#f4f4f4',
     						'alpha'     => 1,
                'rgba' => Redux_Helpers::hex2rgba ( '#f4f4f4', '1' ),
   						),
						'options'       => array(
					        'clickout_fires_change' => true,
						),
	        ),
			array(
                   'id'        => 'cesis_main_content_alt_button_border',
                   'type'      => 'color_rgba',
                   'title'     => __('Second Button border color', 'cesis'),
                   'subtitle'  => __('Button border color.', 'cesis'),
				   'default'   => array(
    					    'color'     => '#ececec',
     						'alpha'     => 1,
                'rgba' => Redux_Helpers::hex2rgba ( '#ececec', '1' ),
   					),
					'options'  => array(
					        'clickout_fires_change' => true,
					),
	        ),
			array(
                   'id'        => 'cesis_main_content_alt_button_hover_text',
                   'type'      => 'color',
                   'title'     => __('Second Button hover text color', 'cesis'),
                   'subtitle'  => __('Button hover text color.', 'cesis'),
                   'default'   => '#ffffff',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_alt_button_hover_background',
                   'type'      => 'color_rgba',
                   'title'     => __('Second Button hover background color', 'cesis'),
                   'subtitle'  => __('Button hover background color.', 'cesis'),
				   'default'   => array(
    					    'color'     => '#3a78ff',
     						'alpha'     => 1,
                'rgba' => Redux_Helpers::hex2rgba ( '#3a78ff', '1' ),
   						),
						'options'       => array(
					        'clickout_fires_change' => true,
						),
	        ),
			array(
                   'id'        => 'cesis_main_content_alt_button_hover_border',
                   'type'      => 'color_rgba',
                   'title'     => __('Second Button Hover border color', 'cesis'),
                   'subtitle'  => __('Button Hover border color.', 'cesis'),
				   'default'   => array(
    					    'color'     => '#3a78ff',
     						'alpha'     => 1,
                'rgba' => Redux_Helpers::hex2rgba ( '#3a78ff', '1' ),
   					),
					'options'  => array(
					        'clickout_fires_change' => true,
					),
	        ),
          array(
						'id'          => 'cesis_main_content_sub_button_font',
					    'type'        => 'typography',
                        'title'     => __('Third Button font', 'cesis'),
                        'subtitle'  => __('Choose the Button text font.', 'cesis'),
					    'google'      => true,
					    'font-backup' => true,
					    'units'       =>'px',
						'line-height' => true,
						'text-align' => false,
						'color' => false,
						'letter-spacing' => true,
						'text-transform' => true,
					    'default'     => array(
					        'font-weight'  => '500',
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '13px',
					        'line-height'   => '50px',
							'letter-spacing' => '1px',
							'text-transform' => 'uppercase',
					    ),
			),
			 array(
                        'id'        => 'cesis_main_content_sub_button_shadow',
                        'type'     => 'button_set',
                        'title'     => __('Use drop down shadow for the Second button?', 'cesis'),
                        'subtitle'  => __('Select if you want to have a shadow effect for the button.', 'cesis'),
                        'options' => array(
					        'yes' =>  __('Yes', 'cesis'),
					        'no' =>  __('No', 'cesis'),
					     ),
					    'default' => 'yes'


			),

			array(
                   'id'        => 'cesis_main_content_sub_button_text',
                   'type'      => 'color',
                   'title'     => __('Third Button text color', 'cesis'),
                   'subtitle'  => __('Button text color.', 'cesis'),
                   'default'   => '#14171d',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_sub_button_background',
                   'type'      => 'color_rgba',
                   'title'     => __('Third Button background color', 'cesis'),
                   'subtitle'  => __('Button background color.', 'cesis'),
				   'default'   => array(
    					    'color'     => '#ffffff',
     						'alpha'     => 1,
                'rgba' => Redux_Helpers::hex2rgba ( '#ffffff', '1' ),
   						),
						'options'       => array(
					        'clickout_fires_change' => true,
						),
	        ),
			array(
                   'id'        => 'cesis_main_content_sub_button_border',
                   'type'      => 'color_rgba',
                   'title'     => __('Third Button border color', 'cesis'),
                   'subtitle'  => __('Button border color.', 'cesis'),
				   'default'   => array(
    					    'color'     => '#ffffff',
     						'alpha'     => 1,
                'rgba' => Redux_Helpers::hex2rgba ( '#ffffff', '1' ),
   					),
					'options'  => array(
					        'clickout_fires_change' => true,
					),
	        ),
			array(
                   'id'        => 'cesis_main_content_sub_button_hover_text',
                   'type'      => 'color',
                   'title'     => __('Third Button hover text color', 'cesis'),
                   'subtitle'  => __('Button hover text color.', 'cesis'),
                   'default'   => '#ffffff',
                   'validate'  => 'color',
	        ),
			array(
                   'id'        => 'cesis_main_content_sub_button_hover_background',
                   'type'      => 'color_rgba',
                   'title'     => __('Third Button hover background color', 'cesis'),
                   'subtitle'  => __('Button hover background color.', 'cesis'),
				   'default'   => array(
    					    'color'     => '#14171d',
     						'alpha'     => 1,
                'rgba' => Redux_Helpers::hex2rgba ( '#14171d', '1' ),
   						),
						'options'       => array(
					        'clickout_fires_change' => true,
						),
	        ),
			array(
                   'id'        => 'cesis_main_content_sub_button_hover_border',
                   'type'      => 'color_rgba',
                   'title'     => __('Third Button Hover border color', 'cesis'),
                   'subtitle'  => __('Button Hover border color.', 'cesis'),
				   'default'   => array(
    					    'color'     => '#14171d',
     						'alpha'     => 1,
                'rgba' => Redux_Helpers::hex2rgba ( '#14171d', '1' ),
   					),
					'options'  => array(
					        'clickout_fires_change' => true,
					),
	        ),


        )
    ) );


		  Redux::setSection( $opt_name, array(
        'title'  => __( 'Sidebar Settings', 'cesis' ),
        'id'     => 'tt-sidebar',
        'desc'   => __( 'Sidebar settings. Choose the style and size of the sidebar.', 'cesis' ),
        'icon'   => 'fa-sidebar ',
        'fields' => array(
           array(
                        'id'        => 'cesis_sidebar_style',
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
            'id'        => 'cesis_sidebar_mobile',
            'type'      => 'button_set',
            'title'     => __('Display Sidebar on Mobile?', 'cesis'),
            'subtitle'  => __('Select yes If you want the sidebar to also be generated for mobile user.', 'cesis'),
            'options' => array(
              'yes' =>  __('Yes', 'cesis'),
              'no' =>  __('No', 'cesis'),
            ),
            'default' => 'yes'
          ),
          array(
                          'id'        => 'cesis_sidebar_expand',
                          'type'      => 'button_set',
                          'title'     => __('Make the sidebar to have it\'s own background?', 'cesis'),
                          'subtitle'  => __('Select yes If you want the sidebar to use a different background color.', 'cesis'),
                          'options' => array(
  					        'yes' =>  __('Yes', 'cesis'),
  					        'no' =>  __('No', 'cesis'),
                 ),
                'default' => 'no'
            ),
    			array(
                            'id'        => 'cesis_sidebar_expand_bg_color',
                            'type'      => 'color',
                            'required'  => array('cesis_sidebar_expand', '=', 'yes'),
                            'title'     => __('Sidebar Background Color', 'cesis'),
                            'subtitle'  => __('Background color of the Sidebar.', 'cesis'),
                            'default'   => '#f7f9fd',
                            'validate'  => 'color',
          ),
           array(
    				'id'       => 'cesis_sidebar_size',
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
    				'id'       => 'cesis_sidebar_space',
    				'type'     => 'slider',
    				'title'    => __('Space between Sidebar and Content ( px ).', 'cesis'),
    				'subtitle' => __('Select the size between the sidebar and the Page content 30px', 'cesis'),
					'default' => '65',
					'min' => 0,
				    'step' => 1,
				    'max' => 150,
				    'display_value' => 'text',
				),

			array(
                        'id'        => 'cesis_sidebar_bottom_padding',
                        'type'     => 'dimensions',
                        'width'     => false,
						'units'    => array('px'),
                        'title'     => __('Select the Sidebar Widgets bottom padding ( bottom space ) size', 'cesis'),
                        'subtitle'  => __('Set the space height after the widgets, default 48px.', 'cesis'),
                        'default' => array(
					        'height'   => '48px',
                  'units' => 'px'
					     ),


			),
			array(
                        'id'        => 'cesis_sidebar_heading_space',
                        'type'     => 'dimensions',
                        'width'     => false,
						'units'    => array('px'),
                        'title'     => __('Select space height between the Widget Heading and Widget content', 'cesis'),
                        'subtitle'  => __('Set the height you want to use to separate the Widget heading and content.', 'cesis'),
                        'default' => array(
					        'height'   => '32px',
                  'units' => 'px'
					     ),


			),
			array(
						'id'          => 'cesis_sidebar_widget_font',
					    'type'        => 'typography',
                        'title'     => __('Sidebar Widget Heading font', 'cesis'),
                        'subtitle'  => __('Choose the sidebar widget heading font.', 'cesis'),
					    'google'      => true,
					    'font-backup' => true,
					    'color' => false,
					    'units'       =>'px',
						'line-height' => true,
						'text-align' => false,
						'letter-spacing' => true,
						'text-transform' => true,
					    'default'     => array(
					        'font-weight'  => '700',
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '16px',
					        'line-height'   => '24px',
							'letter-spacing' => '0px',
							'text-transform' => 'none',
					    ),
				),
			array(
                        'id'        => 'cesis_sidebar_bg_color',
                        'type'      => 'color',
                        'required'  => array('cesis_sidebar_style', '=', 'sidebar_layout_two'),
                        'title'     => __('Sidebar widgets Background Color', 'cesis'),
                        'subtitle'  => __('Background color of the Sidebar Widgets.', 'cesis'),
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
			array(
                        'id'        => 'cesis_sidebar_heading_color',
                        'type'      => 'color',
                        'title'     => __('Sidebar Heading Color', 'cesis'),
                        'subtitle'  => __('Heading color of the Sidebar.', 'cesis'),
                        'default'   => '#aeb7c1',
                        'validate'  => 'color',
                    ),
			array(
                        'id'        => 'cesis_sidebar_text_color',
                        'type'      => 'color',
                        'title'     => __('Sidebar Text Color', 'cesis'),
                        'subtitle'  => __('Text Color of the Sidebar.', 'cesis'),
                        'default'   => '#6d7783',
                        'validate'  => 'color',
                    ),



        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'  => __( 'Footer Settings', 'cesis' ),
        'id'     => 'tt-footer',
        'desc'   => __( 'General Footer settings. For more detailed options check the sub sections.', 'cesis' ),
        'icon'   => 'fa-footer ',
        'fields' => array(

        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Footer Main Area', 'cesis' ),
        'desc'       => __( 'All the settings for the Footer Main Area ( Widgets Part ) For full documentation on this field, visit: ', 'cesis' ) . '<a href="https://cesis.co/wp-content/uploads/documentation/cesis_documentation.html" target="_blank">Cesis Header Top Bar Documentation</a>',
        'id'         => 'tt-footer-main',
        'subsection' => true,
        'fields'     => array(


			array(
				   'id'   => 'cesis_footer_layout_info_box',
				   'type' => 'info',
				   'style' => 'success',
				   'title' => __('LAYOUT SETTINGS.', 'cesis'),
				   'desc' => __('Footer Layout and Space settings ).', 'cesis')
			),

			array(
             	   'id'        => 'cesis_footer_width',
                   'type'     => 'dimensions',
                   'height'     => false,
				   'units'    => array('px','%'),
                   'title'     => __('Select the Footer container width ( px or % )', 'cesis'),
                   'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                   'default' => array(
					        'width'   => '1170px',
                  'units' => 'px'
					     ),
			),
			array(
                        'id'        => 'cesis_footer_top_padding',
                        'type'     => 'dimensions',
                        'width'     => false,
						'units'    => array('px'),
                        'title'     => __('Select the Footer top padding ( top space ) size', 'cesis'),
                        'subtitle'  => __('Set the space height before the widgets, default 60px.', 'cesis'),
                        'default' => array(
					        'height'   => '60px',
                  'units' => 'px'
					     ),


			),
			array(
                        'id'        => 'cesis_footer_bottom_padding',
                        'type'     => 'dimensions',
                        'width'     => false,
						'units'    => array('px'),
                        'title'     => __('Select the Footer bottom padding ( bottom space ) size', 'cesis'),
                        'subtitle'  => __('Set the space height after the widgets, default 60px.', 'cesis'),
                        'default' => array(
					        'height'   => '60px',
                  'units' => 'px'
					     ),


			),
			array(
                        'id'        => 'cesis_footer_widget_padding',
                        'type'     => 'dimensions',
                        'width'     => false,
						'units'    => array('px'),
                        'title'     => __('Select the Footer Widget bottom padding ( bottom space ) size', 'cesis'),
                        'subtitle'  => __('Set the space height after ( between ) the widgets, default 70px.', 'cesis'),
                        'default' => array(
					        'height'   => '70px',
                  'units' => 'px'
					     ),


			),
			array(
                        'id'        => 'cesis_footer_heading_space',
                        'type'     => 'dimensions',
                        'width'     => false,
						'units'    => array('px'),
                        'title'     => __('Select space height between the Widget Heading and Widget content', 'cesis'),
                        'subtitle'  => __('Set the height you want to use to separate the Widget heading and content.', 'cesis'),
                        'default' => array(
					        'height'   => '40px',
                  'units' => 'px'
					     ),


			),
			array(
                        'id'        => 'cesis_footer_columns',
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
				   'id'   => 'cesis_footer_color_info_box',
				   'type' => 'info',
				   'style' => 'success',
				   'title' => __('COLOR / FONT SETTINGS.', 'cesis'),
				   'desc' => __('Footer color and font settings ).', 'cesis')
			),
			 array(
						'id'          => 'cesis_footer_widget_font',
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
					        'font-weight'  => '500',
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '16px',
							'letter-spacing' => '1px',
							'text-transform' => 'uppercase',
					    ),
				),
			array(
                        'id'        => 'cesis_footer_bg_color',
                        'type'      => 'color',
                        'title'     => __('Footer main part Background Color', 'cesis'),
                        'subtitle'  => __('Background color of the Footer main part.', 'cesis'),
                        'default'   => '#2a2d2e',
                        'validate'  => 'color',
                    ),
			array(
                        'id'        => 'cesis_footer_heading_color',
                        'type'      => 'color',
                        'title'     => __('Footer main part Heading Color', 'cesis'),
                        'subtitle'  => __('Heading color of the Footer main part.', 'cesis'),
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
			array(
                        'id'        => 'cesis_footer_text_color',
                        'type'      => 'color',
                        'title'     => __('Footer main part Text Color', 'cesis'),
                        'subtitle'  => __('Text Color of the Footer main part.', 'cesis'),
                        'default'   => '#aeb7c1',
                        'validate'  => 'color',
                    ),
			array(
                        'id'        => 'cesis_footer_hl_color',
                        'type'      => 'color',
                        'title'     => __('Footer main part highlight color', 'cesis'),
                        'subtitle'  => __('Highlight color of the Footer main part.', 'cesis'),
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
			array(
                        'id'        => 'cesis_footer_hover_color',
                        'type'      => 'color',
                        'title'     => __('Footer main part hover color', 'cesis'),
                        'subtitle'  => __('Hover color of the Footer main part.', 'cesis'),
                        'default'   => '#3a78ff',
                        'validate'  => 'color',
                    ),
			array(
                        'id'        => 'cesis_footer_border_color',
                        'type'      => 'color',
                        'title'     => __('Footer main part border color', 'cesis'),
                        'subtitle'  => __('Border color of the Footer main part.', 'cesis'),
                        'default'   => '#474b4c',
                        'validate'  => 'color',
                    ),
        )
    ) );



    Redux::setSection( $opt_name, array(
        'title'      => __( 'Footer Sub Area', 'cesis' ),
        'desc'       => __( 'All the settings for the Footer Sub Area ( Social Icons, Menu, Creditentials etc ) For full documentation on this field, visit: ', 'cesis' ) . '<a href="http://docs.reduxframework.com/core/fields/textarea/" target="_blank">http://docs.reduxframework.com/core/fields/textarea/</a>',
        'id'         => 'tt-footer-sub',
        'subsection' => true,
        'fields'     => array(
			array(
             	   'id'        => 'cesis_footer_bar_width',
                   'type'     => 'dimensions',
                   'height'     => false,
				   'units'    => array('px','%'),
                   'title'     => __('Select the Footer sub part container width ( px or % )', 'cesis'),
                   'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                   'default' => array(
					        'width'   => '1170px',
                  'units' => 'px'
					     ),
			),
			array(
                        'id'        => 'cesis_footer_bar_height',
                        'type'     => 'dimensions',
                        'width'     => false,
						'units'    => array('px'),
                        'title'     => __('Select the Footer sub part size ( height )', 'cesis'),
                        'subtitle'  => __('The default is 100px but you may want to make it bigger if you insert a lot of element on the same place.', 'cesis'),
                        'default' => array(
					        'height'   => '100px',
                  'units' => 'px'
					     ),


			),
			array(
                        'id'        => 'cesis_footer_bar_bg_color',
                        'type'      => 'color',
                        'title'     => __('Footer sub part Background Color', 'cesis'),
                        'subtitle'  => __('Background color of the Footer sub part.', 'cesis'),
                        'default'   => '#191a1b',
                        'validate'  => 'color',
                    ),
			array(
                        'id'        => 'cesis_footer_bar_text_color',
                        'type'      => 'color',
                        'title'     => __('Footer sub part Text Color', 'cesis'),
                        'subtitle'  => __('Text Color of the Footer sub part.', 'cesis'),
                        'default'   => '#aeb7c1',
                        'validate'  => 'color',
                    ),
			array(
                        'id'        => 'cesis_footer_bar_hl_color',
                        'type'      => 'color',
                        'title'     => __('Footer sub part highlight color', 'cesis'),
                        'subtitle'  => __('Highlight color of the Footer sub part.', 'cesis'),
                        'default'   => '#6d7783',
                        'validate'  => 'color',
                    ),
			array(
                        'id'        => 'cesis_footer_bar_hover_color',
                        'type'      => 'color',
                        'title'     => __('Footer sub part hover color', 'cesis'),
                        'subtitle'  => __('Hover color of the Footer sub part.', 'cesis'),
                        'default'   => '#ffffff',
                        'validate'  => 'color',
                    ),
			array(
					    'id'      => 'cesis_footer_bar_sorter',
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
                'id'          => 'cesis_footer_menu_font',
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
                      'font-weight'  => '500',
                      'font-family' => 'Roboto',
                      'google'      => true,
                      'font-size'   => '16px',
                  'letter-spacing' => '1px',
                  'text-transform' => 'uppercase',
                  ),
            ),

            				array(
                				'id'       => 'cesis_footer_menu_space',
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
          'id'       => 'cesis_footer_text_size',
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
				    'id'       => 'cesis_footer_text_one',
				    'type'     => 'editor',
				    'title'    => __('Text 1', 'cesis'),
				    'subtitle' => __('You can put text / html in this field, will be used if selected in the sorter ', 'cesis'),
				    'default'  => '©2015 - 2018 All Rights Reserved Tranmautritam - Envato Pty Ltd.'
			),

		  	array(
				    'id'       => 'cesis_footer_text_two',
				    'type'     => 'editor',
				    'title'    => __('Text 2', 'cesis'),
				    'subtitle' => __('You can put text / html in this field, will be used if selected in the sorter ', 'cesis'),
				    'default'  => ''
			),

		  	array(
				    'id'       => 'cesis_footer_text_three',
				    'type'     => 'editor',
				    'title'    => __('Text 3', 'cesis'),
				    'subtitle' => __('You can put text / html in this field, will be used if selected in the sorter ', 'cesis'),
				    'default'  => ''
			),


				)

    ) );


  Redux::setSection( $opt_name, array(
      'title'      => __( 'Footer Color Presets', 'cesis' ),
      'desc'       => __( 'Some color presets', 'cesis' ),
      'id'         => 'tt-footer-presets',
      'subsection' => true,
      'fields'     => array(
      array(
        'id'       => 'opt-presets-color',
        'type'     => 'image_select',
        'presets'  => true,
        'title'    => __('Color Preset', 'cesis'),
        'subtitle' => __('Select the color you want to use for the theme.', 'cesis'),
        "default" => "3",
        'options'  => array(
          // Array of preset options
          '1'      => array(
            'alt'   => 'agency',
            'img'   => ReduxFramework::$_url.'assets/img/footer_agency.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#151a1d',
            'cesis_footer_heading_color'    => '#9ca3b1',
            'cesis_footer_text_color'    => '#9ca3b1',
            'cesis_footer_hl_color' => '#ffffff',
            'cesis_footer_hover_color' => '#ffffff',
            'cesis_footer_border_color' => '#151a1d',

            'cesis_footer_bar_bg_color' => '#151a1d',
            'cesis_footer_bar_text_color' => '#6d7783',
            'cesis_footer_bar_hl_color' => '#ffffff',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
          '2'      => array(
            'alt'   => '1',
            'img'   => ReduxFramework::$_url.'assets/img/footer_1.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#2a2d2e',
            'cesis_footer_heading_color'    => '#ffffff',
            'cesis_footer_text_color'    => '#aeb7c1',
            'cesis_footer_hl_color' => '#ffffff',
            'cesis_footer_hover_color' => '#3a78ff',
            'cesis_footer_border_color' => '#2a2d2e',

            'cesis_footer_bar_bg_color' => '#191a1b',
            'cesis_footer_bar_text_color' => '#6d7783',
            'cesis_footer_bar_hl_color' => '#aeb7c1',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
          '3'      => array(
            'alt'   => '2',
            'img'   => ReduxFramework::$_url.'assets/img/footer_2.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#232933',
            'cesis_footer_heading_color'    => '#ffffff',
            'cesis_footer_text_color'    => '#788294',
            'cesis_footer_hl_color' => '#ffffff',
            'cesis_footer_hover_color' => '#3a78ff',
            'cesis_footer_border_color' => '#232933',

            'cesis_footer_bar_bg_color' => '#181d25',
            'cesis_footer_bar_text_color' => '#788294',
            'cesis_footer_bar_hl_color' => '#ffffff',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
          '4'      => array(
            'alt'   => '3',
            'img'   => ReduxFramework::$_url.'assets/img/footer_3.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#303338',
            'cesis_footer_heading_color'    => '#ffffff',
            'cesis_footer_text_color'    => '#ffffff',
            'cesis_footer_hl_color' => '#3a78ff',
            'cesis_footer_hover_color' => '#ffffff',
            'cesis_footer_border_color' => '#303338',

            'cesis_footer_bar_bg_color' => '#282b31',
            'cesis_footer_bar_text_color' => '#788294',
            'cesis_footer_bar_hl_color' => '#ffffff',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
          '5'      => array(
            'alt'   => '4',
            'img'   => ReduxFramework::$_url.'assets/img/footer_4.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#384559',
            'cesis_footer_heading_color'    => '#ffffff',
            'cesis_footer_text_color'    => '#a6c1e9',
            'cesis_footer_hl_color' => '#ffffff',
            'cesis_footer_hover_color' => '#3a78ff',
            'cesis_footer_border_color' => '#384559',

            'cesis_footer_bar_bg_color' => '#27364c',
            'cesis_footer_bar_text_color' => '#6a6e73',
            'cesis_footer_bar_hl_color' => '#ffffff',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
          '6'      => array(
            'alt'   => '5',
            'img'   => ReduxFramework::$_url.'assets/img/footer_5.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#1a1f27',
            'cesis_footer_heading_color'    => '#ffffff',
            'cesis_footer_text_color'    => '#8c95a3',
            'cesis_footer_hl_color' => '#ffffff',
            'cesis_footer_hover_color' => '#3a78ff',
            'cesis_footer_border_color' => '#1a1f27',

            'cesis_footer_bar_bg_color' => '#101317',
            'cesis_footer_bar_text_color' => '#6a6e73',
            'cesis_footer_bar_hl_color' => '#6a6e73',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
          '7'      => array(
            'alt'   => '6',
            'img'   => ReduxFramework::$_url.'assets/img/footer_6.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#13131c',
            'cesis_footer_heading_color'    => '#ffffff',
            'cesis_footer_text_color'    => '#8c95a3',
            'cesis_footer_hl_color' => '#ffffff',
            'cesis_footer_hover_color' => '#3a78ff',
            'cesis_footer_border_color' => '#13131c',

            'cesis_footer_bar_bg_color' => '#0b0d0f',
            'cesis_footer_bar_text_color' => '#6a6e73',
            'cesis_footer_bar_hl_color' => '#6a6e73',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
          '8'      => array(
            'alt'   => '7',
            'img'   => ReduxFramework::$_url.'assets/img/footer_7.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#252e41',
            'cesis_footer_heading_color'    => '#ffffff',
            'cesis_footer_text_color'    => '#ffffff',
            'cesis_footer_hl_color' => '#3a78ff',
            'cesis_footer_hover_color' => '#ffffff',
            'cesis_footer_border_color' => '#252e41',

            'cesis_footer_bar_bg_color' => '#202839',
            'cesis_footer_bar_text_color' => '#a2a7ae',
            'cesis_footer_bar_hl_color' => '#a2a7ae',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
          '9'      => array(
            'alt'   => '8',
            'img'   => ReduxFramework::$_url.'assets/img/footer_8.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#323232',
            'cesis_footer_heading_color'    => '#ffffff',
            'cesis_footer_text_color'    => '#ffffff',
            'cesis_footer_hl_color' => '#3a78ff',
            'cesis_footer_hover_color' => '#ffffff',
            'cesis_footer_border_color' => '#323232',

            'cesis_footer_bar_bg_color' => '#262626',
            'cesis_footer_bar_text_color' => '#a2a7ae',
            'cesis_footer_bar_hl_color' => '#a2a7ae',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
          '10'      => array(
            'alt'   => 'fashion',
            'img'   => ReduxFramework::$_url.'assets/img/footer_lifestyle.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#ffffff',
            'cesis_footer_heading_color'    => '#222222',
            'cesis_footer_text_color'    => '#706f6f',
            'cesis_footer_hl_color' => '#222222',
            'cesis_footer_hover_color' => '#3a78ff',
            'cesis_footer_border_color' => '#ffffff',

            'cesis_footer_bar_bg_color' => '#f4f4f4',
            'cesis_footer_bar_text_color' => '#aeb7c1',
            'cesis_footer_bar_hl_color' => '#6d7783',
            'cesis_footer_bar_hover_color' => '#222222',
          )),
          '11'      => array(
            'alt'   => '9',
            'img'   => ReduxFramework::$_url.'assets/img/footer_9.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#f2f2f2',
            'cesis_footer_heading_color'    => '#222222',
            'cesis_footer_text_color'    => '#706f6f',
            'cesis_footer_hl_color' => '#222222',
            'cesis_footer_hover_color' => '#3a78ff',
            'cesis_footer_border_color' => '#f2f2f2',

            'cesis_footer_bar_bg_color' => '#ffffff',
            'cesis_footer_bar_text_color' => '#706f6f',
            'cesis_footer_bar_hl_color' => '#3a78ff',
            'cesis_footer_bar_hover_color' => '#3a78ff',
          )),
          '12'      => array(
            'alt'   => '10',
            'img'   => ReduxFramework::$_url.'assets/img/footer_10.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#ffffff',
            'cesis_footer_heading_color'    => '#222222',
            'cesis_footer_text_color'    => '#706f6f',
            'cesis_footer_hl_color' => '#222222',
            'cesis_footer_hover_color' => '#3a78ff',
            'cesis_footer_border_color' => '#e9eef2',

            'cesis_footer_bar_bg_color' => '#ffffff',
            'cesis_footer_bar_text_color' => '#706f6f',
            'cesis_footer_bar_hl_color' => '#3a78ff',
            'cesis_footer_bar_hover_color' => '#3a78ff',
          )),
          '13'      => array(
            'alt'   => '11',
            'img'   => ReduxFramework::$_url.'assets/img/footer_11.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#f7fafe',
            'cesis_footer_heading_color'    => '#222222',
            'cesis_footer_text_color'    => '#706f6f',
            'cesis_footer_hl_color' => '#222222',
            'cesis_footer_hover_color' => '#3a78ff',
            'cesis_footer_border_color' => '#e9eef2',

            'cesis_footer_bar_bg_color' => '#ffffff',
            'cesis_footer_bar_text_color' => '#706f6f',
            'cesis_footer_bar_hl_color' => '#3a78ff',
            'cesis_footer_bar_hover_color' => '#3a78ff',
          )),
          '14'      => array(
            'alt'   => '12',
            'img'   => ReduxFramework::$_url.'assets/img/footer_12.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#1d79d6',
            'cesis_footer_heading_color'    => '#ffffff',
            'cesis_footer_text_color'    => '#ffffff',
            'cesis_footer_hl_color' => '#ffffff',
            'cesis_footer_hover_color' => '#222222',
            'cesis_footer_border_color' => '#1d79d6',

            'cesis_footer_bar_bg_color' => '#262626',
            'cesis_footer_bar_text_color' => '#868a95',
            'cesis_footer_bar_hl_color' => '#ffffff',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
          '15'      => array(
            'alt'   => '13',
            'img'   => ReduxFramework::$_url.'assets/img/footer_13.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#dc5c95',
            'cesis_footer_heading_color'    => '#ffffff',
            'cesis_footer_text_color'    => '#ffffff',
            'cesis_footer_hl_color' => '#ffffff',
            'cesis_footer_hover_color' => '#222222',
            'cesis_footer_border_color' => '#dc5c95',

            'cesis_footer_bar_bg_color' => '#262626',
            'cesis_footer_bar_text_color' => '#868a95',
            'cesis_footer_bar_hl_color' => '#ffffff',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
          '16'      => array(
            'alt'   => '14',
            'img'   => ReduxFramework::$_url.'assets/img/footer_14.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#52bfcc',
            'cesis_footer_heading_color'    => '#ffffff',
            'cesis_footer_text_color'    => '#ffffff',
            'cesis_footer_hl_color' => '#ffffff',
            'cesis_footer_hover_color' => '#222222',
            'cesis_footer_border_color' => '#52bfcc',

            'cesis_footer_bar_bg_color' => '#262626',
            'cesis_footer_bar_text_color' => '#868a95',
            'cesis_footer_bar_hl_color' => '#ffffff',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
          '17'      => array(
            'alt'   => '15',
            'img'   => ReduxFramework::$_url.'assets/img/footer_15.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#6bcba4',
            'cesis_footer_heading_color'    => '#ffffff',
            'cesis_footer_text_color'    => '#ffffff',
            'cesis_footer_hl_color' => '#ffffff',
            'cesis_footer_hover_color' => '#222222',
            'cesis_footer_border_color' => '#6bcba4',

            'cesis_footer_bar_bg_color' => '#262626',
            'cesis_footer_bar_text_color' => '#868a95',
            'cesis_footer_bar_hl_color' => '#ffffff',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
          '18'      => array(
            'alt'   => '16',
            'img'   => ReduxFramework::$_url.'assets/img/footer_16.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#6229f2',
            'cesis_footer_heading_color'    => '#ffffff',
            'cesis_footer_text_color'    => '#ffffff',
            'cesis_footer_hl_color' => '#ffffff',
            'cesis_footer_hover_color' => '#222222',
            'cesis_footer_border_color' => '#6229f2',

            'cesis_footer_bar_bg_color' => '#262626',
            'cesis_footer_bar_text_color' => '#868a95',
            'cesis_footer_bar_hl_color' => '#ffffff',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
          '19'      => array(
            'alt'   => '17',
            'img'   => ReduxFramework::$_url.'assets/img/footer_17.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#453867',
            'cesis_footer_heading_color'    => '#ffffff',
            'cesis_footer_text_color'    => '#ffffff',
            'cesis_footer_hl_color' => '#ffffff',
            'cesis_footer_hover_color' => '#222222',
            'cesis_footer_border_color' => '#453867',

            'cesis_footer_bar_bg_color' => '#262626',
            'cesis_footer_bar_text_color' => '#868a95',
            'cesis_footer_bar_hl_color' => '#ffffff',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
          '20'      => array(
            'alt'   => '18',
            'img'   => ReduxFramework::$_url.'assets/img/footer_18.jpg',
            'presets'   => array(
            'cesis_footer_bg_color'     => '#4100e6',
            'cesis_footer_heading_color'    => '#ffffff',
            'cesis_footer_text_color'    => '#ffffff',
            'cesis_footer_hl_color' => '#ffffff',
            'cesis_footer_hover_color' => '#222222',
            'cesis_footer_border_color' => '#4100e6',

            'cesis_footer_bar_bg_color' => '#262626',
            'cesis_footer_bar_text_color' => '#868a95',
            'cesis_footer_bar_hl_color' => '#ffffff',
            'cesis_footer_bar_hover_color' => '#ffffff',
          )),
        ),
      ),



    )

  ));



   Redux::setSection( $opt_name, array(
        'title'  => __( 'Page Settings', 'cesis' ),
        'id'     => 'tt-pages',
        'desc'   => __( 'Page Layout settings.', 'cesis' ),
        'icon'   => 'fa-page ',
        'fields' => array(


        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Header settings', 'cesis' ),
        'desc'       => __( 'Page header settings', 'cesis' ),
        'id'         => 'tt-page-header',
        'subsection' => true,
        'fields'     => array(
            array(
                        'id'        => 'cesis_page_topbar',
                        'type'      => 'button_set',
                        'title'     => __('Display the Header Top Bar?', 'cesis'),
                        'subtitle'  => __('Select yes if you want to show the header top bar.', 'cesis'),
                        'options' => array(
					        'yes' =>  __('Yes', 'cesis'),
					        'no' =>  __('No', 'cesis'),
               ),
              'default' => 'no'
          ),
          array(
                      'id'        => 'cesis_page_header',
                      'type'      => 'button_set',
                      'title'     => __('Display the Header?', 'cesis'),
                      'subtitle'  => __('Select yes If you want to show the header.', 'cesis'),
                      'options' => array(
                'yes' =>  __('Yes', 'cesis'),
                'no' =>  __('No', 'cesis'),
             ),
            'default' => 'yes'
        ),
        array(
                    'id'        => 'cesis_page_header_transparent',
                    'type'      => 'button_set',
                    'title'     => __('Use Transparent Header?', 'cesis'),
                    'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
                    'options' => array(
              'cesis_transparent_header' =>  __('Yes', 'cesis'),
              'cesis_opaque_header' => __('No', 'cesis'),
           ),
          'default' => 'cesis_opaque_header'
      ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Banner settings', 'cesis' ),
        'desc'       => __( 'Page banner settings', 'cesis' ),
        'id'         => 'tt-page-banner',
        'subsection' => true,
        'fields'     => array(
            array(
                        'id'        => 'cesis_page_banner',
                        'type'      => 'button_set',
                        'title'     => __('Banner type', 'cesis'),
                        'subtitle'  => __('Select the banner area type.', 'cesis'),
                        'options' => array(
                  'none' => __('No Banner', 'cesis'),
                  'content' => __('Content Block', 'cesis'),
                  'slider' => __('Slider Revolution', 'cesis'),
                  'layerslider' => __('LayerSlider', 'cesis'),
               ),
              'default' => 'none'
          ),
          array(
                      'id'        => 'cesis_page_banner_pos',
                      'type'      => 'button_set',
                      'required'  => array('cesis_page_banner','!=','none'),
                      'title'     => __('Banner position', 'cesis'),
                      'subtitle'  => __('Select the banner position.', 'cesis'),
                      'options' => array(
                'under' => __('Under Header', 'cesis'),
                'above' => __('Above Header', 'cesis'),
             ),
            'default' => 'under'
          ),
          array(
                        'id'        => 'cesis_page_block_content',
                        'type'      => 'select',
          						  'required'  => array('cesis_page_banner','=','content'),
                        'title'     => __('Select the Block content to use', 'cesis'),
                        'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                        //Must provide key => value pairs for select options
                        'data'   => "content_block",
						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                        'default'   => ''
          ),
          array(
                        'id'        => 'cesis_page_rev_slider',
                        'type'      => 'select',
          						  'required'  => array('cesis_page_banner','=','slider'),
                        'title'     => __('Select the Slider revolution to use', 'cesis'),
                        'subtitle'  => __('You need to have at least one slider created', 'cesis'),
			                  'options' => $rev_sliders,
                        'default'   => ''
          ),
          array(
                        'id'        => 'cesis_page_layer_slider',
                        'type'      => 'select',
          						  'required'  => array('cesis_page_banner','=','layerslider'),
                        'title'     => __('Select the Layerslider to use', 'cesis'),
                        'subtitle'  => __('You need to have at least one slider created', 'cesis'),
			                  'options' => $layerslider_array,
                        'default'   => ''
          ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'      => __( 'Title settings', 'cesis' ),
        'desc'       => __( 'Page title settings', 'cesis' ),
        'id'         => 'tt-page-title',
        'subsection' => true,
        'fields'     => array(

              array(
                  'id'        => 'cesis_page_title',
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
					    'id'       => 'cesis_page_title_layout',
              'required'  => array(
                   array('cesis_page_title','=','yes'),
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
                        'id'        => 'cesis_page_title_alignment',
                        'type'     => 'button_set',
						'required'  => array(
						array('cesis_page_title_layout','not_contain','one'),
                 array('cesis_page_title','=','yes'),
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
                        'id'        => 'cesis_page_title_width',
                        'required'  => array(
                             array('cesis_page_title','=','yes'),
                        ),
                        'type'     => 'dimensions',
                        'height'     => false,
						'units'    => array('px','%'),
                        'title'     => __('Select the Title container width ( px or % )', 'cesis'),
                        'subtitle'  => __('Default 1170px, select 100% to have full width Title container.', 'cesis'),
                        'default' => array(
					        'width'   => '1170px',
                  'units' => 'px'
					     ),


			),
			array(
                        'id'        => 'cesis_page_title_height',
                        'required'  => array(
                             array('cesis_page_title','=','yes'),
                        ),
                        'type'     => 'dimensions',
                        'width'     => false,
						'units'    => array('px','%'),
                        'title'     => __('Select the Title container height ( px or % )', 'cesis'),
                        'subtitle'  => __('Default 100px, use percentage to adapt the size depending on the user screen.', 'cesis'),
                        'default' => array(
					        'height'   => '100px',
                  'units' => 'px'
					     ),


			),
			array(
                        'id'        => 'cesis_page_title_minheight',
                        'required'  => array(
                             array('cesis_page_title','=','yes'),
                        ),
                        'type'     => 'dimensions',
                        'width'     => false,
						'units'    => array('px'),
                        'title'     => __('Select the Title minimum height ( px )', 'cesis'),
                        'subtitle'  => __('Good to set a minimum height when using % for title height.', 'cesis'),
                        'default' => array(
					        'height'   => '70px',
                  'units' => 'px'
					     ),


			),
			array(
                        'id'        => 'cesis_page_title_background',
                        'required'  => array(
                             array('cesis_page_title','=','yes'),
                        ),
                        'type'      => 'background',
                        'title'     => __('Title Background Color / Image', 'cesis'),
                        'subtitle'  => __('Select the Title background color or Image.', 'cesis'),
                        'default'  => array(
                          'background-color' => '#ffffff',
                        )
            ),
			 array(
                        'id'        => 'cesis_page_title_overlay',
                        'required'  => array(
                             array('cesis_page_title','=','yes'),
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
                        'id'        => 'cesis_page_title_overlay_color',
						'required'  => array(
						array( 'cesis_page_title_overlay', '=', 'yes') ,
                 array('cesis_page_title','=','yes'),
								),
                        'type'      => 'color_rgba',
                        'title'     => __('Title Overlay color', 'cesis'),
                        'subtitle'  => __('Title Overlay color', 'cesis'),
                        'default'   => array(
    					    'color'     => '#000000',
     						'alpha'     => '0.15',
                'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.15' ),
   						),
						'options'       => array(
					        'clickout_fires_change'     => true,
						),
                   ),
			array(
	                    'id'        => 'cesis_page_title_border',
                      'required'  => array(
                           array('cesis_page_title','=','yes'),
                      ),
                        'type'      => 'color',
                        'title'     => __('Title border color', 'cesis'),
                        'subtitle'  => __('Title Border color (default: #ecf0f1).', 'cesis'),
                        'default'   => '#ecf0f1',
                        'validate'  => 'color',
                    ),

      array(
        'id'   => 'cesis_page_title_info',
        'required'  => array(
             array('cesis_page_title','=','yes'),
        ),
        'type' => 'info',
        'style' => 'success',
        'title' => __('TITLE SETTINGS.', 'cesis'),
        'desc' => __('Title text settings ).', 'cesis')
      ),

      array(
                        'id'        => 'cesis_page_title_display',
                        'required'  => array(
                             array('cesis_page_title','=','yes'),
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
						'id'          => 'cesis_page_title_font',
					    'type'        => 'typography',
						'required'  => array( 'cesis_page_title_display', '=', 'yes'),
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
					        'font-weight'  => '500',
					        'line-height'  => '32px',
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '28px',
							'letter-spacing' => '0',
							'text-transform' => 'none',
					    ),
					),

array(
'id'   => 'cesis_page_breadcrumbs_info',
'required'  => array(
     array('cesis_page_title','=','yes'),
),
'type' => 'info',
'style' => 'success',
'title' => __('BREADCRUMBS SETTINGS.', 'cesis'),
'desc' => __('Title text settings ).', 'cesis')
),


         	 array(
                        'id'        => 'cesis_page_breadcrumbs_display',
                        'required'  => array(
                             array('cesis_page_title','=','yes'),
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
                        'id'        => 'cesis_page_breadcrumbs_display_home',
                        'type'     => 'button_set',
						'required'  => array( 'cesis_page_breadcrumbs_display', '=', 'yes') ,
                        'title'     => __('Display the "Home" link on breadcrumb?', 'cesis'),
                        'subtitle'  => __('Select if you want show or hide the Home link.', 'cesis'),
                        'options' => array(
					        'yes' =>  __('Yes', 'cesis'),
					        'no' =>  __('No', 'cesis'),
					     ),
					    'default' => 'yes'


			),
		  	array(
				    'id'       => 'cesis_page_breadcrumbs_front',
					'required'  => array( 'cesis_page_breadcrumbs_display', '=', 'yes') ,
				    'type'     => 'text',
				    'title'    => __('Breadcrumb front Text', 'cesis'),
				    'subtitle' => __('Text to show before the breadcrumbs, ex: You are here', 'cesis'),
				    'desc'     => __('Keep empty to hide the front text.', 'cesis'),
				    'validate' => 'html',
				    'default'  => ' '
			),
		  	array(
				    'id'       => 'cesis_page_breadcrumbs_sep',
					'required'  => array( 'cesis_page_breadcrumbs_display', '=', 'yes') ,
				    'type'     => 'text',
				    'title'    => __('Breadcrumbs Separator.', 'cesis'),
				    'subtitle' => __('Link Separator, ex: / ', 'cesis'),
				    'desc'     => __('Will separate the links.', 'cesis'),
				    'validate' => 'html',
				    'default'  => '/'
			),

			array(
						'id'          => 'cesis_page_breadcrumbs_font',
						'required'  => array( 'cesis_page_breadcrumbs_display', '=', 'yes') ,
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
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '13px',
					        'line-height'  => '30px',
							'letter-spacing' => '0',
							'text-transform' => 'none',
					    ),
					),
			array(
                        'id'        => 'cesis_page_current_breadcrumbs_color',
						'required'  => array( 'cesis_page_breadcrumbs_display', '=', 'yes') ,
                        'type'      => 'color',
                        'title'     => __('Breadcrumb hover color', 'cesis'),
                        'subtitle'  => __('Breadcrumbs hover color.', 'cesis'),
                        'default'   => '#ecf0f1',
                        'validate'  => 'color',
                   ),
			array(
                        'id'        => 'cesis_page_breadcrumbs_bg_color',
						'required'  => array( 'cesis_page_breadcrumbs_display', '=', 'yes') ,
                        'type'      => 'color_rgba',
                        'title'     => __('Breadcrumb background color', 'cesis'),
                        'subtitle'  => __('Breadcrumb background color ( only used in title layout 3 ).', 'cesis'),
                        'default'   => array(
    					    'color'     => '#000000',
     						'alpha'     => 0.05,
                'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.05' ),
   						),
  					'options'  => array(
  					        'clickout_fires_change' => true,
  					),
                   ),


			array(
                        'id'        => 'cesis_page_breadcrumbs_word_char',
						'required'  => array( 'cesis_page_breadcrumbs_display', '=', 'yes') ,
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
				    'id'       => 'cesis_page_breadcrumbs_word_char_count',
					'required'  => array( 'cesis_page_breadcrumbs_display', '=', 'yes') ,
				    'type'     => 'text',
				    'title'    => __('Breadcrumb Title max word/Character count', 'cesis'),
				    'subtitle' => __('Example : 4', 'cesis'),
				    'validate' => 'numeric',
				    'default'  => '4'
			),

		  	array(
				    'id'       => 'cesis_page_breadcrumbs_word_char_end',
					'required'  => array( 'cesis_page_breadcrumbs_display', '=', 'yes') ,
				    'type'     => 'text',
				    'title'    => __('Ending Character to show after cut title', 'cesis'),
				    'subtitle' => __('Example : ...', 'cesis'),
				    'validate' => 'html',
				    'default'  => ''
			),

        )
    ) );

        Redux::setSection( $opt_name, array(
            'title'      => __( 'Layout settings', 'cesis' ),
            'desc'       => __( 'Page layout settings', 'cesis' ),
            'id'         => 'tt-page-layout',
            'subsection' => true,
            'fields'     => array(
              array(
                         'id'        => 'cesis_page_content_width',
                           'type'     => 'dimensions',
                           'height'     => false,
                   'units'    => array('px','%'),
                           'title'     => __('Select the Main content container width ( px or % )', 'cesis'),
                           'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                           'default' => array(
                          'width'   => '1170px',
                          'units' => 'px'
                       ),
              ),
              array(
                                'id'        => 'cesis_page_content_top_padding',
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
                                'id'        => 'cesis_page_content_bottom_padding',
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
                      'id'       => 'cesis_page_layout',
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
                     	 array(
                                    'id'        => 'cesis_page_display_comments',
                                    'type'     => 'button_set',
                                    'title'     => __('Display / Enable comments on pages?', 'cesis'),
                                    'subtitle'  => __('Select if you want to allow / show comments on pages.', 'cesis'),
                                    'options' => array(
            					        'yes' =>  __('Yes', 'cesis'),
            					        'no' =>  __('No', 'cesis'),
            					     ),
            					    'default' => 'no'


            			),
            )
        ) );

        Redux::setSection( $opt_name, array(
            'title'      => __( 'Pre-Footer settings', 'cesis' ),
            'desc'       => __( 'Page pre-footer settings', 'cesis' ),
            'id'         => 'tt-page-prefooter',
            'subsection' => true,
            'fields'     => array(
                array(
                            'id'        => 'cesis_page_prefooter',
                            'type'      => 'button_set',
                            'title'     => __('Banner type', 'cesis'),
                            'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                            'options' => array(
                      'none' => __('No Banner', 'cesis'),
                      'content' => __('Content Block', 'cesis'),
                      'slider' => __('Slider Revolution', 'cesis'),
                      'layerslider' => __('LayerSlider', 'cesis'),
                   ),
                  'default' => 'none'
              ),
              array(
                            'id'        => 'cesis_page_pf_block_content',
                            'type'      => 'select',
              						  'required'  => array('cesis_page_prefooter','=','content'),
                            'title'     => __('Select the Block content to use', 'cesis'),
                            'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                            //Must provide key => value pairs for select options
                            'data'   => "content_block",
    						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                            'default'   => ''
              ),
              array(
                            'id'        => 'cesis_page_pf_rev_slider',
                            'type'      => 'select',
              						  'required'  => array('cesis_page_prefooter','=','slider'),
                            'title'     => __('Select the Slider revolution to use', 'cesis'),
                            'subtitle'  => __('You need to have at least one slider created', 'cesis'),
    			                  'options' => $rev_sliders,
                            'default'   => ''
              ),
              array(
                            'id'        => 'cesis_page_pf_layer_slider',
                            'type'      => 'select',
              						  'required'  => array('cesis_page_prefooter','=','layerslider'),
                            'title'     => __('Select the Layerslider to use', 'cesis'),
                            'subtitle'  => __('You need to have at least one slider created', 'cesis'),
    			                  'options' => $layerslider_array,
                            'default'   => ''
              ),
            )
        ) );


        Redux::setSection( $opt_name, array(
            'title'      => __( 'Footer settings', 'cesis' ),
            'desc'       => __( 'Page footer settings', 'cesis' ),
            'id'         => 'tt-page-footer',
            'subsection' => true,
            'fields'     => array(
              array(
                            'id'        => 'cesis_page_footer_fixed',
                            'type'      => 'button_set',
                            'title'     => __('Use fixed footer?', 'cesis'),
                            'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                            'options' => array(
    					        'cesis_fixed_footer' =>  __('Yes', 'cesis'),
    					        'no' =>  __('No', 'cesis'),
                   ),
                  'default' => 'no'
              ),
                array(
                            'id'        => 'cesis_page_footer',
                            'type'      => 'button_set',
                            'title'     => __('Display the Footer main area?', 'cesis'),
                            'subtitle'  => __('Select yes if you want to show the Footer top part ( widget space ).', 'cesis'),
                            'options' => array(
                      'yes' =>  __('Yes', 'cesis'),
                      'no' =>  __('No', 'cesis'),
                   ),
                  'default' => 'yes'
              ),
              array(
                          'id'        => 'cesis_page_footer_bar',
                          'type'      => 'button_set',
                          'title'     => __('Display the Footer under bar?', 'cesis'),
                          'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                          'options' => array(
                    'yes' =>  __('Yes', 'cesis'),
                    'no' =>  __('No', 'cesis'),
                 ),
                'default' => 'yes'
            ),
            )
        ) );


	    Redux::setSection( $opt_name, array(
        'title'  => __( 'Blog Posts Settings', 'cesis' ),
        'id'     => 'tt-blog',
        'desc'   => __( 'General Blog posts settings. For more detailed options check the sub sections.', 'cesis' ),
        'icon'   => 'fa-blog2 ',
        'fields' => array(
			array(
				  		'id'       => 'cesis_blog_main_url',
				    	'type'     => 'text',
				    	'title'    => __('Put your Blog page URL', 'cesis'),
				    	'subtitle' => __('Put your Blog page URL, will be used for buttons that take you back to the blog ( use http:// )', 'cesis'),
				    	'validate' => 'url',
				    	'default'  => ''
					),

        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Header settings', 'cesis' ),
        'desc'       => __( 'Posts header settings', 'cesis' ),
        'id'         => 'tt-post-header',
        'subsection' => true,
        'fields'     => array(
            array(
                        'id'        => 'cesis_post_topbar',
                        'type'      => 'button_set',
                        'title'     => __('Display the Header Top Bar?', 'cesis'),
                        'subtitle'  => __('Select if you want to show the header top bar.', 'cesis'),
                        'options' => array(
                  'yes' =>  __('Yes', 'cesis'),
                  'no' =>  __('No', 'cesis'),
               ),
              'default' => 'no'
          ),
          array(
                      'id'        => 'cesis_post_header',
                      'type'      => 'button_set',
                      'title'     => __('Display the Header?', 'cesis'),
                      'subtitle'  => __('Select if you want to show the header.', 'cesis'),
                      'options' => array(
                'yes' =>  __('Yes', 'cesis'),
                'no' =>  __('No', 'cesis'),
             ),
            'default' => 'yes'
        ),
        array(
                    'id'        => 'cesis_post_header_transparent',
                    'type'      => 'button_set',
                    'title'     => __('Use Transparent Header?', 'cesis'),
                    'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
                    'options' => array(
              'cesis_transparent_header' => __('Yes', 'cesis'),
              'cesis_opaque_header' => __('No', 'cesis'),
           ),
          'default' => 'cesis_opaque_header'
      ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Banner settings', 'cesis' ),
        'desc'       => __( 'Posts banner settings', 'cesis' ),
        'id'         => 'tt-post-banner',
        'subsection' => true,
        'fields'     => array(
            array(
                        'id'        => 'cesis_post_banner',
                        'type'      => 'button_set',
                        'title'     => __('Banner type', 'cesis'),
                        'subtitle'  => __('Select the banner area type.', 'cesis'),
                        'options' => array(
                  'none' => __('No Banner', 'cesis'),
                  'content' => __('Content Block', 'cesis'),
                  'slider' => __('Slider Revolution', 'cesis'),
                  'layerslider' => __('LayerSlider', 'cesis'),
               ),
              'default' => 'none'
          ),
          array(
                      'id'        => 'cesis_post_banner_pos',
                      'type'      => 'button_set',
                      'required'  => array('cesis_post_banner','!=','none'),
                      'title'     => __('Banner position', 'cesis'),
                      'subtitle'  => __('Select the banner position.', 'cesis'),
                      'options' => array(
                'under' => __('Under Header', 'cesis'),
                'above' => __('Above Header', 'cesis'),
             ),
            'default' => 'under'
          ),
          array(
                        'id'        => 'cesis_post_block_content',
                        'type'      => 'select',
                        'required'  => array('cesis_post_banner','=','content'),
                        'title'     => __('Select the Block content to use', 'cesis'),
                        'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                        //Must provide key => value pairs for select options
                        'data'   => "content_block",
                              'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                        'default'   => ''
          ),

          array(
                        'id'        => 'cesis_post_rev_slider',
                        'type'      => 'select',
          						  'required'  => array('cesis_post_banner','=','slider'),
                        'title'     => __('Select the Slider revolution to use', 'cesis'),
                        'subtitle'  => __('You need to have at least one slider created', 'cesis'),
			                  'options' => $rev_sliders,
                        'default'   => ''
          ),
          array(
                        'id'        => 'cesis_post_layer_slider',
                        'type'      => 'select',
          						  'required'  => array('cesis_post_banner','=','layerslider'),
                        'title'     => __('Select the Layerslider to use', 'cesis'),
                        'subtitle'  => __('You need to have at least one slider created', 'cesis'),
			                  'options' => $layerslider_array,
                        'default'   => ''
          ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'      => __( 'Title settings', 'cesis' ),
        'desc'       => __( 'Posts title settings', 'cesis' ),
        'id'         => 'tt-post-title',
        'subsection' => true,
        'fields'     => array(

              array(
                  'id'        => 'cesis_post_title',
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
					    'id'       => 'cesis_post_title_layout',
              'required'  => array(
                   array('cesis_post_title','=','yes'),
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
                        'id'        => 'cesis_post_title_alignment',
                        'type'     => 'button_set',
						'required'  => array(
						array('cesis_post_title_layout','not_contain','one'),
                 array('cesis_post_title','=','yes'),
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
                        'id'        => 'cesis_post_title_width',
                        'required'  => array(
                             array('cesis_post_title','=','yes'),
                        ),
                        'type'     => 'dimensions',
                        'height'     => false,
						'units'    => array('px','%'),
                        'title'     => __('Select the Title container width ( px or % )', 'cesis'),
                        'subtitle'  => __('Default 1170px, select 100% to have full width Title container.', 'cesis'),
                        'default' => array(
					        'width'   => '1170px',
                  'units' => 'px'
					     ),


			),
			array(
                        'id'        => 'cesis_post_title_height',
                        'required'  => array(
                             array('cesis_post_title','=','yes'),
                        ),
                        'type'     => 'dimensions',
                        'width'     => false,
						'units'    => array('px','%'),
                        'title'     => __('Select the Title container height ( px or % )', 'cesis'),
                        'subtitle'  => __('Default 100px, use percentage to adapt the size depending on the user screen.', 'cesis'),
                        'default' => array(
					        'height'   => '100px',
                  'units' => 'px'
					     ),


			),
			array(
                        'id'        => 'cesis_post_title_minheight',
                        'required'  => array(
                             array('cesis_post_title','=','yes'),
                        ),
                        'type'     => 'dimensions',
                        'width'     => false,
						'units'    => array('px'),
                        'title'     => __('Select the Title minimum height ( px )', 'cesis'),
                        'subtitle'  => __('Good to set a minimum height when using % for title height.', 'cesis'),
                        'default' => array(
					        'height'   => '70px',
                  'units' => 'px'
					     ),


			),
			array(
                        'id'        => 'cesis_post_title_background',
                        'required'  => array(
                             array('cesis_post_title','=','yes'),
                        ),
                        'type'      => 'background',
                        'title'     => __('Title Background Color / Image', 'cesis'),
                        'subtitle'  => __('Select the Title background color or Image.', 'cesis'),
                        'default'  => array(
                          'background-color' => '#ffffff',
                        )
            ),
			 array(
                        'id'        => 'cesis_post_title_overlay',
                        'required'  => array(
                             array('cesis_post_title','=','yes'),
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
                        'id'        => 'cesis_post_title_overlay_color',
						'required'  => array(
						array( 'cesis_post_title_overlay', '=', 'yes') ,
                 array('cesis_post_title','=','yes'),
								),
                        'type'      => 'color_rgba',
                        'title'     => __('Title Overlay color', 'cesis'),
                        'subtitle'  => __('Title Overlay color', 'cesis'),
                        'default'   => array(
    					    'color'     => '#000000',
     						'alpha'     => '0.15',
                'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.15' ),
   						),
						'options'       => array(
					        'clickout_fires_change'     => true,
						),
                   ),
			array(
	                    'id'        => 'cesis_post_title_border',
                      'required'  => array(
                           array('cesis_post_title','=','yes'),
                      ),
                        'type'      => 'color',
                        'title'     => __('Title border color', 'cesis'),
                        'subtitle'  => __('Title Border color (default: #ecf0f1).', 'cesis'),
                        'default'   => '#ecf0f1',
                        'validate'  => 'color',
                    ),

      array(
        'id'   => 'cesis_post_title_info',
        'required'  => array(
             array('cesis_post_title','=','yes'),
        ),
        'type' => 'info',
        'style' => 'success',
        'title' => __('TITLE SETTINGS.', 'cesis'),
        'desc' => __('Title text settings ).', 'cesis')
      ),

      array(
                        'id'        => 'cesis_post_title_display',
                        'required'  => array(
                             array('cesis_post_title','=','yes'),
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
						'id'          => 'cesis_post_title_font',
					    'type'        => 'typography',
						'required'  => array( 'cesis_post_title_display', '=', 'yes'),
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
					        'font-weight'  => '500',
					        'line-height'  => '32px',
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '28px',
							'letter-spacing' => '0',
							'text-transform' => 'none',
					    ),
					),

array(
'id'   => 'cesis_post_breadcrumbs_info',
'required'  => array(
     array('cesis_post_title','=','yes'),
),
'type' => 'info',
'style' => 'success',
'title' => __('BREADCRUMBS SETTINGS.', 'cesis'),
'desc' => __('Title text settings ).', 'cesis')
),


         	 array(
                        'id'        => 'cesis_post_breadcrumbs_display',
                        'required'  => array(
                             array('cesis_post_title','=','yes'),
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
                        'id'        => 'cesis_post_breadcrumbs_display_home',
                        'type'     => 'button_set',
						'required'  => array( 'cesis_post_breadcrumbs_display', '=', 'yes') ,
                        'title'     => __('Display the "Home" link on breadcrumb?', 'cesis'),
                        'subtitle'  => __('Select if you want show or hide the Home link.', 'cesis'),
                        'options' => array(
					        'yes' =>  __('Yes', 'cesis'),
					        'no' =>  __('No', 'cesis'),
					     ),
					    'default' => 'yes'


			),
		  	array(
				    'id'       => 'cesis_post_breadcrumbs_front',
					'required'  => array( 'cesis_post_breadcrumbs_display', '=', 'yes') ,
				    'type'     => 'text',
				    'title'    => __('Breadcrumb front Text', 'cesis'),
				    'subtitle' => __('Text to show before the breadcrumbs, ex: You are here', 'cesis'),
				    'desc'     => __('Keep empty to hide the front text.', 'cesis'),
				    'validate' => 'html',
				    'default'  => ' '
			),
		  	array(
				    'id'       => 'cesis_post_breadcrumbs_sep',
					'required'  => array( 'cesis_post_breadcrumbs_display', '=', 'yes') ,
				    'type'     => 'text',
				    'title'    => __('Breadcrumbs Separator.', 'cesis'),
				    'subtitle' => __('Link Separator, ex: / ', 'cesis'),
				    'desc'     => __('Will separate the links.', 'cesis'),
				    'validate' => 'html',
				    'default'  => '/'
			),

			array(
						'id'          => 'cesis_post_breadcrumbs_font',
						'required'  => array( 'cesis_post_breadcrumbs_display', '=', 'yes') ,
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
					        'font-family' => 'Roboto',
					        'google'      => true,
					        'font-size'   => '13px',
					        'line-height'  => '30px',
							'letter-spacing' => '0',
							'text-transform' => 'none',
					    ),
					),
			array(
                        'id'        => 'cesis_post_current_breadcrumbs_color',
						'required'  => array( 'cesis_post_breadcrumbs_display', '=', 'yes') ,
                        'type'      => 'color',
                        'title'     => __('Breadcrumb hover color', 'cesis'),
                        'subtitle'  => __('Breadcrumbs hover color.', 'cesis'),
                        'default'   => '#ecf0f1',
                        'validate'  => 'color',
                   ),
			array(
                        'id'        => 'cesis_post_breadcrumbs_bg_color',
						'required'  => array( 'cesis_post_breadcrumbs_display', '=', 'yes') ,
                        'type'      => 'color_rgba',
                        'title'     => __('Breadcrumb background color', 'cesis'),
                        'subtitle'  => __('Breadcrumb background color ( only used in title layout 3 ).', 'cesis'),
                        'default'   => array(
    					    'color'     => '#000000',
     						'alpha'     => 0.05,
                'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.05' ),
   						),
  					'options'  => array(
  					        'clickout_fires_change' => true,
  					),
                   ),


			array(
                        'id'        => 'cesis_post_breadcrumbs_word_char',
						'required'  => array( 'cesis_post_breadcrumbs_display', '=', 'yes') ,
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
				    'id'       => 'cesis_post_breadcrumbs_word_char_count',
					'required'  => array( 'cesis_post_breadcrumbs_display', '=', 'yes') ,
				    'type'     => 'text',
				    'title'    => __('Breadcrumb Title max word/Character count', 'cesis'),
				    'subtitle' => __('Example : 4', 'cesis'),
				    'validate' => 'numeric',
				    'default'  => '4'
			),

		  	array(
				    'id'       => 'cesis_post_breadcrumbs_word_char_end',
					'required'  => array( 'cesis_post_breadcrumbs_display', '=', 'yes') ,
				    'type'     => 'text',
				    'title'    => __('Ending Character to show after cut title', 'cesis'),
				    'subtitle' => __('Example : ...', 'cesis'),
				    'validate' => 'html',
				    'default'  => ''
			),

        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Layout settings', 'cesis' ),
        'desc'       => __( 'All the settings for Single Blog posts page, For full documentation on this field, visit: ', 'cesis' ) . '<a href="https://cesis.co/wp-content/uploads/documentation/cesis_documentation.html" target="_blank">Cesis Header Top Bar Documentation</a>',
        'id'         => 'tt-single-blog',
        'subsection' => true,
        'fields'     => array(

            array(
                        'id'        => 'cesis_blog_sp_style',
                        'type'      => 'select',
                        'title'     => __('Select the Single Posts default style', 'cesis'),
                        'subtitle'  => __('Select the design to use for the Single Post page.', 'cesis'),


                        //Must provide key => value pairs for select options
                        'options'   => array(
                            'single_post_layout_eight' => 'Classic',
                            'single_post_layout_nine' => 'Classic Boxed',
                            'single_post_layout_four' => 'Agency',
                            'single_post_layout_six' => 'Career',
                            'single_post_layout_seven' => 'LifeStyle',
                            'single_post_layout_one' => 'Casual',
                            'single_post_layout_three' => 'Casual In Boxes',
                            'single_post_layout_two' => 'Writer',
                        ),
                        'default'   => 'single_post_layout_eight'
                    ),
			array(
             	   'id'        => 'cesis_blog_content_width',
                   'type'     => 'dimensions',
                   'height'     => false,
				   'units'    => array('px','%'),
                   'title'     => __('Select the Single blog posts main content container width ( px or % )', 'cesis'),
                   'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                   'default' => array(
					        'width'   => '1170px',
                  'units' => 'px'
					     ),
			),
			array(
                        'id'        => 'cesis_blog_content_top_padding',
                        'type'     => 'dimensions',
                        'width'     => false,
						'units'    => array('px'),
                        'title'     => __('Select the Single blog posts main content top space ( top padding px )', 'cesis'),
                        'subtitle'  => __('If no sidebar used and content build with Page builder 0 is recommended.', 'cesis'),
                        'default' => array(
					        'height'   => '60px',
                  'units' => 'px'
					     ),


			),
			array(
                        'id'        => 'cesis_blog_content_bottom_padding',
                        'type'     => 'dimensions',
                        'width'     => false,
						'units'    => array('px'),
                        'title'     => __('Select the Single blog posts main content bottom space ( bottom padding px )', 'cesis'),
                        'subtitle'  => __('If no sidebar used and content build with Page builder 0 is recommended.', 'cesis'),
                        'default' => array(
					        'height'   => '60px',
                  'units' => 'px'
					     ),


			),
			array(
					    'id'       => 'cesis_blog_sp_layout',
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
            'id' => 'cesis_blog_sp_sidebar_select',
            'title' => __('Sidebar', 'cesis'),
            'desc' => 'Please select the sidebar to use.',
            'type' => 'select',
            'data' => 'sidebars',
            'required'  => array(
                  array('cesis_blog_sp_layout','not','no_sidebar'),
            ),
            'default' => 'None'
          ),
          array(
                            'id'        => 'cesis_blog_media',
                            'type'     => 'button_set',
                            'title'     => __('Display the Blog media ( thumbnail, video or audio ) ?', 'cesis'),
                            'subtitle'  => __('Select if you want to show the media of the post.', 'cesis'),

                            'options' => array(
                      'yes' =>  __('Yes', 'cesis'),
                      'no' =>  __('No', 'cesis'),
    					     ),
    					    'default' => 'yes'


    				),
          array(
            'id'        => 'cesis_blog_gallery_type',
            'type'      => 'select',
            'title'     => __('Select the Single posts gallery type', 'cesis'),
            'subtitle'  => __('Select the gallery type for the auto generated content.', 'cesis'),
            'required' => array(
            array('cesis_blog_media','=','yes')
            ),
            //Must provide key => value pairs for select options
            'options'   => array(
              'carousel' => __('Carousel', 'cesis'),
              'packery' => __('Packery', 'cesis'),
              'stacked' => __('Stacked', 'cesis'),
            ),
            'default'   => 'carousel'
            ),

            array(
            'id' => 'cesis_blog_gallery_space',
            'type' => 'text',
            'title' => __('Select the space between the images', 'cesis'),
            'required' => array(

            array('cesis_blog_media','=','yes'),
            array('cesis_blog_gallery_type','=','stacked'),

            ),
            'default'   => '0'
            ),

            array(
            'id' => 'cesis_blog_gallery_size',
            'type' => 'select',
            'title' => __('Select the thumbnail size', 'cesis'),
            'subtitle' => __('Select the image size to used in the automatically generated content', 'cesis'),
            'required' => array(

            array('cesis_blog_media','=','yes'),
            array('cesis_blog_gallery_type','!=','packery')

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
            'default' => 'tn_rectangle_3_2'
          ),
			array(
                        'id'        => 'cesis_blog_sp_author',
                        'type'     => 'button_set',
                        'title'     => __('Display the Author Information / Description ?', 'cesis'),
                        'subtitle'  => __('Select if you want to show the author information / description box.', 'cesis'),

                        'options' => array(
                  'yes' =>  __('Yes', 'cesis'),
                  'no' =>  __('No', 'cesis'),
					     ),
					    'default' => 'yes'


		),
    array(
                      'id'        => 'cesis_blog_sp_authori',
                      'type'     => 'button_set',
                      'title'     => __('Display the Author name ?', 'cesis'),
                      'subtitle'  => __('Select if you want to show the author name.', 'cesis'),

                      'options' => array(
                'yes' =>  __('Yes', 'cesis'),
                'no' =>  __('No', 'cesis'),
             ),
            'default' => 'yes'


    ),
    array(
                      'id'        => 'cesis_blog_sp_date',
                      'type'     => 'button_set',
                      'title'     => __('Display the Date ?', 'cesis'),
                      'subtitle'  => __('Select if you want to show the date.', 'cesis'),

                      'options' => array(
                'yes' =>  __('Yes', 'cesis'),
                'no' =>  __('No', 'cesis'),
             ),
            'default' => 'yes'


    ),
    array(
                      'id'        => 'cesis_blog_sp_comment',
                      'type'     => 'button_set',
                      'title'     => __('Display the Comments number ?', 'cesis'),
                      'subtitle'  => __('Select if you want to show the number of comments.', 'cesis'),

                      'options' => array(
                'yes' =>  __('Yes', 'cesis'),
                'no' =>  __('No', 'cesis'),
             ),
            'default' => 'yes'


    ),
    array(
                      'id'        => 'cesis_blog_sp_like',
                      'type'     => 'button_set',
                      'title'     => __('Display the Like button ?', 'cesis'),
                      'subtitle'  => __('Select if you want to show the Like button.', 'cesis'),

                      'options' => array(
                'yes' =>  __('Yes', 'cesis'),
                'no' =>  __('No', 'cesis'),
             ),
            'default' => 'no'


    ),
    array(
                      'id'        => 'cesis_blog_sp_categories',
                      'type'     => 'button_set',
                      'title'     => __('Display the Categories ?', 'cesis'),
                      'subtitle'  => __('Select if you want to show the categories.', 'cesis'),

                      'options' => array(
                'yes' =>  __('Yes', 'cesis'),
                'no' =>  __('No', 'cesis'),
             ),
            'default' => 'no'


    ),
    array(
                      'id'        => 'cesis_blog_sp_tags',
                      'type'     => 'button_set',
                      'title'     => __('Display the Tags ?', 'cesis'),
                      'subtitle'  => __('Select if you want to show the tags.', 'cesis'),

                      'options' => array(
                'yes' =>  __('Yes', 'cesis'),
                'no' =>  __('No', 'cesis'),
             ),
            'default' => 'yes'


      ),
    array(
                      'id'        => 'cesis_blog_sp_share',
                      'type'     => 'button_set',
                      'title'     => __('Display the Share icons?', 'cesis'),
                      'subtitle'  => __('Select if you want to show the share icons.', 'cesis'),

                      'options' => array(
                'yes' =>  __('Yes', 'cesis'),
                'no' =>  __('No', 'cesis'),
             ),
            'default' => 'yes'


      ),
			array(
                        'id'        => 'cesis_blog_sp_navigation',
                        'type'     => 'button_set',
                        'title'     => __('Display the Previous / Next Navigation?', 'cesis'),
                        'subtitle'  => __('Select if you want to show Previous and Next navigation button.', 'cesis'),

                        'options' => array(
                  'yes' =>  __('Yes', 'cesis'),
                  'no' =>  __('No', 'cesis'),
					     ),
					    'default' => 'yes'


				),


			)
    ) );


            Redux::setSection( $opt_name, array(
                'title'      => __( 'Pre-Footer settings', 'cesis' ),
                'desc'       => __( 'Posts pre-footer settings', 'cesis' ),
                'id'         => 'tt-post-prefooter',
                'subsection' => true,
                'fields'     => array(
                    array(
                                'id'        => 'cesis_post_prefooter',
                                'type'      => 'button_set',
                                'title'     => __('Banner type', 'cesis'),
                                'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                                'options' => array(
                          'none' => __('No Banner', 'cesis'),
                          'content' => __('Content Block', 'cesis'),
                          'slider' => __('Slider Revolution', 'cesis'),
                          'layerslider' => __('LayerSlider', 'cesis'),
                       ),
                      'default' => 'none'
                  ),
                  array(
                                'id'        => 'cesis_post_pf_block_content',
                                'type'      => 'select',
                  						  'required'  => array('cesis_post_prefooter','=','content'),
                                'title'     => __('Select the Block content to use', 'cesis'),
                                'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                //Must provide key => value pairs for select options
                                'data'   => "content_block",
        						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                'default'   => ''
                  ),
                  array(
                                'id'        => 'cesis_post_pf_rev_slider',
                                'type'      => 'select',
                  						  'required'  => array('cesis_post_prefooter','=','slider'),
                                'title'     => __('Select the Slider revolution to use', 'cesis'),
                                'subtitle'  => __('You need to have at least one slider created', 'cesis'),
        			                  'options' => $rev_sliders,
                                'default'   => ''
                  ),
                  array(
                                'id'        => 'cesis_post_pf_layer_slider',
                                'type'      => 'select',
                  						  'required'  => array('cesis_post_prefooter','=','layerslider'),
                                'title'     => __('Select the Layerslider to use', 'cesis'),
                                'subtitle'  => __('You need to have at least one slider created', 'cesis'),
        			                  'options' => $layerslider_array,
                                'default'   => ''
                  ),
                )
            ) );


            Redux::setSection( $opt_name, array(
                'title'      => __( 'Footer settings', 'cesis' ),
                'desc'       => __( 'Posts footer settings', 'cesis' ),
                'id'         => 'tt-post-footer',
                'subsection' => true,
                'fields'     => array(
                  array(
                                'id'        => 'cesis_post_footer_fixed',
                                'type'      => 'button_set',
                                'title'     => __('Use fixed footer?', 'cesis'),
                                'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                                'options' => array(
        					        'cesis_fixed_footer' =>  __('Yes', 'cesis'),
        					        'no' =>  __('No', 'cesis'),
                       ),
                      'default' => 'no'
                  ),
                    array(
                                'id'        => 'cesis_post_footer',
                                'type'      => 'button_set',
                                'title'     => __('Display the Footer main area?', 'cesis'),
                                'subtitle'  => __('If you want to show the Footer top part ( widget space ) select yes.', 'cesis'),
                                'options' => array(
                          'yes' =>  __('Yes', 'cesis'),
                          'no' =>  __('No', 'cesis'),
                       ),
                      'default' => 'yes'
                  ),
                  array(
                              'id'        => 'cesis_post_footer_bar',
                              'type'      => 'button_set',
                              'title'     => __('Display the Footer under bar?', 'cesis'),
                              'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                              'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'yes'
                ),
                )
            ) );


                        Redux::setSection( $opt_name, array(
                          'title'  => __( 'Portfolio Posts Settings', 'cesis' ),
                          'id'     => 'tt-portfolio',
                          'desc'   => __( 'General Portfolio settings. For more detailed options check the sub sections.', 'cesis' ),
                          'icon'   => 'fa-portfolio ',
                          'fields' => array(

                                            array(
                                                  'id'       => 'cesis_portfolio_main_url',
                                                  'type'     => 'text',
                                                  'title'    => __('Put your Portfolio page URL', 'cesis'),
                                                  'subtitle' => __('Put your Portfolio page URL, will be used for buttons that take you back to the Portfolio ( use http:// )', 'cesis'),
                                                  'validate' => 'url',
                                                  'default'  => ''
                                              ),

                                            array(
                                                  'id'       => 'cesis_port_slug',
                                                  'type'     => 'text',
                                                  'title'    => __('Custom slug', 'cesis'),
                                                  'subtitle' => __('Make sure to save the permalinks after updating ( Settings > Permalinks, click "Saves Changes" )', 'cesis'),
                                                  'validate' => 'html',
                                                  'default'  => 'project'
                                              ),

                          )
                      ) );

                      Redux::setSection( $opt_name, array(
                          'title'      => __( 'Header settings', 'cesis' ),
                          'desc'       => __( 'Portfolio Posts header settings', 'cesis' ),
                          'id'         => 'tt-portfolio-header',
                          'subsection' => true,
                          'fields'     => array(
                              array(
                                          'id'        => 'cesis_portfolio_topbar',
                                          'type'      => 'button_set',
                                          'title'     => __('Display the Header Top Bar?', 'cesis'),
                                          'subtitle'  => __('Select if you want to show the header top bar.', 'cesis'),
                                          'options' => array(
                                    'yes' =>  __('Yes', 'cesis'),
                                    'no' =>  __('No', 'cesis'),
                                 ),
                                'default' => 'no'
                            ),
                            array(
                                        'id'        => 'cesis_portfolio_header',
                                        'type'      => 'button_set',
                                        'title'     => __('Display the Header?', 'cesis'),
                                        'subtitle'  => __('Select if you want to show the header.', 'cesis'),
                                        'options' => array(
                                  'yes' =>  __('Yes', 'cesis'),
                                  'no' =>  __('No', 'cesis'),
                               ),
                              'default' => 'yes'
                          ),
                          array(
                                      'id'        => 'cesis_portfolio_header_transparent',
                                      'type'      => 'button_set',
                                      'title'     => __('Use Transparent Header?', 'cesis'),
                                      'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
                                      'options' => array(
                                'cesis_transparent_header' => __('Yes', 'cesis'),
                                'cesis_opaque_header' => __('No', 'cesis'),
                             ),
                            'default' => 'cesis_opaque_header'
                        ),
                          )
                      ) );

                      Redux::setSection( $opt_name, array(
                          'title'      => __( 'Banner settings', 'cesis' ),
                          'desc'       => __( 'Portfolio Posts banner settings', 'cesis' ),
                          'id'         => 'tt-portfolio-banner',
                          'subsection' => true,
                          'fields'     => array(
                              array(
                                          'id'        => 'cesis_portfolio_banner',
                                          'type'      => 'button_set',
                                          'title'     => __('Banner type', 'cesis'),
                                          'subtitle'  => __('Select the banner area type.', 'cesis'),
                                          'options' => array(
                                    'none' => __('No Banner', 'cesis'),
                                    'content' => __('Content Block', 'cesis'),
                                    'slider' => __('Slider Revolution', 'cesis'),
                                    'layerslider' => __('LayerSlider', 'cesis'),
                                 ),
                                'default' => 'none'
                            ),
                            array(
                                        'id'        => 'cesis_portfolio_banner_pos',
                                        'type'      => 'button_set',
                                        'required'  => array('cesis_portfolio_banner','!=','none'),
                                        'title'     => __('Banner position', 'cesis'),
                                        'subtitle'  => __('Select the banner position.', 'cesis'),
                                        'options' => array(
                                  'under' => __('Under Header', 'cesis'),
                                  'above' => __('Above Header', 'cesis'),
                               ),
                              'default' => 'under'
                            ),
                            array(
                                          'id'        => 'cesis_portfolio_block_content',
                                          'type'      => 'select',
                                          'required'  => array('cesis_portfolio_banner','=','content'),
                                          'title'     => __('Select the Block content to use', 'cesis'),
                                          'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                          //Must provide key => value pairs for select options
                                          'data'   => "content_block",
                                                'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                          'default'   => ''
                            ),

                            array(
                                          'id'        => 'cesis_portfolio_rev_slider',
                                          'type'      => 'select',
                            						  'required'  => array('cesis_portfolio_banner','=','slider'),
                                          'title'     => __('Select the Slider revolution to use', 'cesis'),
                                          'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                  			                  'options' => $rev_sliders,
                                          'default'   => ''
                            ),
                            array(
                                          'id'        => 'cesis_portfolio_layer_slider',
                                          'type'      => 'select',
                            						  'required'  => array('cesis_portfolio_banner','=','layerslider'),
                                          'title'     => __('Select the Layerslider to use', 'cesis'),
                                          'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                  			                  'options' => $layerslider_array,
                                          'default'   => ''
                            ),
                          )
                      ) );


                      Redux::setSection( $opt_name, array(
                          'title'      => __( 'Title settings', 'cesis' ),
                          'desc'       => __( 'Portfolio Posts title settings', 'cesis' ),
                          'id'         => 'tt-portfolio-title',
                          'subsection' => true,
                          'fields'     => array(

                                array(
                                    'id'        => 'cesis_portfolio_title',
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
                  					    'id'       => 'cesis_portfolio_title_layout',
                                'required'  => array(
                                     array('cesis_portfolio_title','=','yes'),
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
                                          'id'        => 'cesis_portfolio_title_alignment',
                                          'type'     => 'button_set',
                  						'required'  => array(
                  						array('cesis_portfolio_title_layout','not_contain','one'),
                                   array('cesis_portfolio_title','=','yes'),
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
                                          'id'        => 'cesis_portfolio_title_width',
                                          'required'  => array(
                                               array('cesis_portfolio_title','=','yes'),
                                          ),
                                          'type'     => 'dimensions',
                                          'height'     => false,
                  						'units'    => array('px','%'),
                                          'title'     => __('Select the Title container width ( px or % )', 'cesis'),
                                          'subtitle'  => __('Default 1170px, select 100% to have full width Title container.', 'cesis'),
                                          'default' => array(
                  					        'width'   => '1170px',
                                    'units' => 'px'
                  					     ),


                  			),
                  			array(
                                          'id'        => 'cesis_portfolio_title_height',
                                          'required'  => array(
                                               array('cesis_portfolio_title','=','yes'),
                                          ),
                                          'type'     => 'dimensions',
                                          'width'     => false,
                  						'units'    => array('px','%'),
                                          'title'     => __('Select the Title container height ( px or % )', 'cesis'),
                                          'subtitle'  => __('Default 100px, use percentage to adapt the size depending on the user screen.', 'cesis'),
                                          'default' => array(
                  					        'height'   => '100px',
                                    'units' => 'px'
                  					     ),


                  			),
                  			array(
                                          'id'        => 'cesis_portfolio_title_minheight',
                                          'required'  => array(
                                               array('cesis_portfolio_title','=','yes'),
                                          ),
                                          'type'     => 'dimensions',
                                          'width'     => false,
                  						'units'    => array('px'),
                                          'title'     => __('Select the Title minimum height ( px )', 'cesis'),
                                          'subtitle'  => __('Good to set a minimum height when using % for title height.', 'cesis'),
                                          'default' => array(
                  					        'height'   => '70px',
                                    'units' => 'px'
                  					     ),


                  			),
                  			array(
                                          'id'        => 'cesis_portfolio_title_background',
                                          'required'  => array(
                                               array('cesis_portfolio_title','=','yes'),
                                          ),
                                          'type'      => 'background',
                                          'title'     => __('Title Background Color / Image', 'cesis'),
                                          'subtitle'  => __('Select the Title background color or Image.', 'cesis'),
                                          'default'  => array(
                                            'background-color' => '#ffffff',
                                          )
                              ),
                  			 array(
                                          'id'        => 'cesis_portfolio_title_overlay',
                                          'required'  => array(
                                               array('cesis_portfolio_title','=','yes'),
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
                                          'id'        => 'cesis_portfolio_title_overlay_color',
                  						'required'  => array(
                  						array( 'cesis_portfolio_title_overlay', '=', 'yes') ,
                                   array('cesis_portfolio_title','=','yes'),
                  								),
                                          'type'      => 'color_rgba',
                                          'title'     => __('Title Overlay color', 'cesis'),
                                          'subtitle'  => __('Title Overlay color', 'cesis'),
                                          'default'   => array(
                      					    'color'     => '#000000',
                       						'alpha'     => '0.15',
                                  'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.15' ),
                     						),
                  						'options'       => array(
                  					        'clickout_fires_change'     => true,
                  						),
                                     ),
                  			array(
                  	                    'id'        => 'cesis_portfolio_title_border',
                                        'required'  => array(
                                             array('cesis_portfolio_title','=','yes'),
                                        ),
                                          'type'      => 'color',
                                          'title'     => __('Title border color', 'cesis'),
                                          'subtitle'  => __('Title Border color (default: #ecf0f1).', 'cesis'),
                                          'default'   => '#ecf0f1',
                                          'validate'  => 'color',
                                      ),

                        array(
                          'id'   => 'cesis_portfolio_title_info',
                          'required'  => array(
                               array('cesis_portfolio_title','=','yes'),
                          ),
                          'type' => 'info',
                          'style' => 'success',
                          'title' => __('TITLE SETTINGS.', 'cesis'),
                          'desc' => __('Title text settings ).', 'cesis')
                        ),

                        array(
                                          'id'        => 'cesis_portfolio_title_display',
                                          'required'  => array(
                                               array('cesis_portfolio_title','=','yes'),
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
                  						'id'          => 'cesis_portfolio_title_font',
                  					    'type'        => 'typography',
                  						'required'  => array( 'cesis_portfolio_title_display', '=', 'yes'),
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
                  					        'font-weight'  => '500',
                  					        'line-height'  => '32px',
                  					        'font-family' => 'Roboto',
                  					        'google'      => true,
                  					        'font-size'   => '28px',
                  							'letter-spacing' => '0',
                  							'text-transform' => 'none',
                  					    ),
                  					),

                  array(
                  'id'   => 'cesis_portfolio_breadcrumbs_info',
                  'required'  => array(
                       array('cesis_portfolio_title','=','yes'),
                  ),
                  'type' => 'info',
                  'style' => 'success',
                  'title' => __('BREADCRUMBS SETTINGS.', 'cesis'),
                  'desc' => __('Title text settings ).', 'cesis')
                  ),


                           	 array(
                                          'id'        => 'cesis_portfolio_breadcrumbs_display',
                                          'required'  => array(
                                               array('cesis_portfolio_title','=','yes'),
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
                                          'id'        => 'cesis_portfolio_breadcrumbs_display_home',
                                          'type'     => 'button_set',
                  						'required'  => array( 'cesis_portfolio_breadcrumbs_display', '=', 'yes') ,
                                          'title'     => __('Display the "Home" link on breadcrumb?', 'cesis'),
                                          'subtitle'  => __('Select if you want show or hide the Home link.', 'cesis'),
                                          'options' => array(
                  					        'yes' =>  __('Yes', 'cesis'),
                  					        'no' =>  __('No', 'cesis'),
                  					     ),
                  					    'default' => 'yes'


                  			),
                  		  	array(
                  				    'id'       => 'cesis_portfolio_breadcrumbs_front',
                  					'required'  => array( 'cesis_portfolio_breadcrumbs_display', '=', 'yes') ,
                  				    'type'     => 'text',
                  				    'title'    => __('Breadcrumb front Text', 'cesis'),
                  				    'subtitle' => __('Text to show before the breadcrumbs, ex: You are here', 'cesis'),
                  				    'desc'     => __('Keep empty to hide the front text.', 'cesis'),
                  				    'validate' => 'html',
                  				    'default'  => ' '
                  			),
                  		  	array(
                  				    'id'       => 'cesis_portfolio_breadcrumbs_sep',
                  					'required'  => array( 'cesis_portfolio_breadcrumbs_display', '=', 'yes') ,
                  				    'type'     => 'text',
                  				    'title'    => __('Breadcrumbs Separator.', 'cesis'),
                  				    'subtitle' => __('Link Separator, ex: / ', 'cesis'),
                  				    'desc'     => __('Will separate the links.', 'cesis'),
                  				    'validate' => 'html',
                  				    'default'  => '/'
                  			),

                  			array(
                  						'id'          => 'cesis_portfolio_breadcrumbs_font',
                  						'required'  => array( 'cesis_portfolio_breadcrumbs_display', '=', 'yes') ,
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
                  					        'font-family' => 'Roboto',
                  					        'google'      => true,
                  					        'font-size'   => '13px',
                  					        'line-height'  => '30px',
                  							'letter-spacing' => '0',
                  							'text-transform' => 'none',
                  					    ),
                  					),
                  			array(
                                          'id'        => 'cesis_portfolio_current_breadcrumbs_color',
                  						'required'  => array( 'cesis_portfolio_breadcrumbs_display', '=', 'yes') ,
                                          'type'      => 'color',
                                          'title'     => __('Breadcrumb hover color', 'cesis'),
                                          'subtitle'  => __('Breadcrumbs hover color.', 'cesis'),
                                          'default'   => '#ecf0f1',
                                          'validate'  => 'color',
                                     ),
                  			array(
                                          'id'        => 'cesis_portfolio_breadcrumbs_bg_color',
                  						'required'  => array( 'cesis_portfolio_breadcrumbs_display', '=', 'yes') ,
                                          'type'      => 'color_rgba',
                                          'title'     => __('Breadcrumb background color', 'cesis'),
                                          'subtitle'  => __('Breadcrumb background color ( only used in title layout 3 ).', 'cesis'),
                                          'default'   => array(
                      					    'color'     => '#000000',
                       						'alpha'     => 0.05,
                                  'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.05' ),
                     						),
                  						'options'       => array(
                  					        'clickout_fires_change'     => true,
                  						),
                                     ),


                  			array(
                                          'id'        => 'cesis_portfolio_breadcrumbs_word_char',
                  						'required'  => array( 'cesis_portfolio_breadcrumbs_display', '=', 'yes') ,
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
                  				    'id'       => 'cesis_portfolio_breadcrumbs_word_char_count',
                  					'required'  => array( 'cesis_portfolio_breadcrumbs_display', '=', 'yes') ,
                  				    'type'     => 'text',
                  				    'title'    => __('Breadcrumb Title max word/Character count', 'cesis'),
                  				    'subtitle' => __('Example : 4', 'cesis'),
                  				    'validate' => 'numeric',
                  				    'default'  => '4'
                  			),

                  		  	array(
                  				    'id'       => 'cesis_portfolio_breadcrumbs_word_char_end',
                  					'required'  => array( 'cesis_portfolio_breadcrumbs_display', '=', 'yes') ,
                  				    'type'     => 'text',
                  				    'title'    => __('Ending Character to show after cut title', 'cesis'),
                  				    'subtitle' => __('Example : ...', 'cesis'),
                  				    'validate' => 'html',
                  				    'default'  => ''
                  			),

                          )
                      ) );

                      Redux::setSection( $opt_name, array(
                          'title'      => __( 'Layout settings', 'cesis' ),
                          'desc'       => __( 'All the settings for Single Portfolio posts page, For full documentation on this field, visit: ', 'cesis' ) . '<a href="https://cesis.co/wp-content/uploads/documentation/cesis_documentation.html" target="_blank">Cesis Header Top Bar Documentation</a>',
                          'id'         => 'tt-portfolio-layout',
                          'subsection' => true,
                          'fields'     => array(


                  			array(
                               	   'id'        => 'cesis_portfolio_content_width',
                                     'type'     => 'dimensions',
                                     'height'     => false,
                  				   'units'    => array('px','%'),
                                     'title'     => __('Select the Single Portfolio posts main content container width ( px or % )', 'cesis'),
                                     'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                                     'default' => array(
                  					        'width'   => '1170px',
                                    'units' => 'px'
                  					     ),
                  			),
                  			array(
                                          'id'        => 'cesis_portfolio_content_top_padding',
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
                                          'id'        => 'cesis_portfolio_content_bottom_padding',
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
                  					    'id'       => 'cesis_portfolio_sp_layout',
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
                              'id' => 'cesis_portfolio_sp_sidebar_select',
                              'title' => __('Sidebar', 'cesis'),
                              'desc' => 'Please select the sidebar to use.',
                              'type' => 'select',
                              'data' => 'sidebars',
                              'required'  => array(
                                    array('cesis_portfolio_sp_layout','not','no_sidebar'),
                              ),
                              'default' => 'None'
                            ),
                  			array(
                                          'id'        => 'cesis_portfolio_agc',
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
                  					    'id'       => 'cesis_portfolio_agc_layout',
                  					    'type'     => 'image_select',
                  					    'title'    => __('Select the Auto generated content layout', 'cesis'),
                                'required' => array(
                                array('cesis_portfolio_agc','=','yes')
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
                                         'id'        => 'cesis_portfolio_style',
                                         'type'      => 'select',
                                         'title'     => __('Select the thumbnail style', 'cesis'),
                                         'subtitle'  => __('Select the thumbnail style for the auto generated content.', 'cesis'),
                                         'required' => array(
                                         array('cesis_portfolio_agc','=','yes')
                                         ),
                                         //Must provide key => value pairs for select options
                                         'options'   => array(
                                             'cesis_portfolio_sp_classic' => __('Classic', 'cesis'),
                                             'cesis_portfolio_sp_framed' => __('White framed', 'cesis'),
                                         ),
                                         'default'   => 'cesis_portfolio_sp_classic'
                                     ),

                        array(
                          'id'        => 'cesis_portfolio_gallery_type',
                          'type'      => 'select',
                          'title'     => __('Select the Single portfolio gallery type', 'cesis'),
                          'subtitle'  => __('Select the gallery type for the auto generated content.', 'cesis'),
                          'required' => array(
                          array('cesis_portfolio_agc','=','yes')
                          ),
                          //Must provide key => value pairs for select options
                          'options'   => array(
                            'carousel' => __('Carousel', 'cesis'),
                            'packery' => __('Packery', 'cesis'),
                            'stacked' => __('Stacked', 'cesis'),
                          ),
                          'default'   => 'carousel'
                          ),

                          array(
                          'id' => 'cesis_portfolio_gallery_space',
                          'type' => 'text',
                          'title' => __('Select the space between the images', 'cesis'),
                          'required' => array(

                          array('cesis_portfolio_agc','=','yes'),
                          array('cesis_portfolio_gallery_type','=','stacked'),

                          ),
                          'default'   => '0'
                          ),

                          array(
                          'id' => 'cesis_portfolio_gallery_size',
                          'type' => 'select',
                          'title' => __('Select the thumbnail size', 'cesis'),
                          'subtitle' => __('Select the image size to used in the automatically generated content', 'cesis'),
                          'required' => array(

                          array('cesis_portfolio_agc','=','yes'),
                          array('cesis_portfolio_gallery_type','!=','stacked'),

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
                          'default' => 'tn_rectangle_3_2'
                        ),
                    array(
                                      'id'        => 'cesis_portfolio_sp_share',
                                      'type'     => 'button_set',
                                      'title'     => __('Display the Share icons?', 'cesis'),
                                      'subtitle'  => __('Select if you want to show the share icons.', 'cesis'),
                                      'required' => array(

                                      array('cesis_portfolio_agc','=','yes'),

                                      ),

                                      'options' => array(
                                'yes' =>  __('Yes', 'cesis'),
                                'no' =>  __('No', 'cesis'),
                             ),
                            'default' => 'yes'


                      ),

                          array(
                            'id'        => 'cesis_portfolio_sp_navigation',
                            'type'     => 'button_set',
                            'title'     => __('Display the Previous / Next Navigation?', 'cesis'),
                            'subtitle'  => __('Select if you want to show Previous and Next navigation button.', 'cesis'),
                            'options' => array(
                              'yes' =>  __('Yes', 'cesis'),
                              'no' =>  __('No', 'cesis'),
                            ),
                            'default' => 'yes'
                          ),

                          array(
                            'id'        => 'cesis_portfolio_sp_navigation_style',
                            'type'      => 'select',
                            'title'     => __('Select the navigation style', 'cesis'),
                            'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                            'required'  => array('cesis_portfolio_sp_navigation','=','yes'),
                            //Must provide key => value pairs for select options
                            'options'   => array(
                              'business' => __('Classic', 'cesis'),
                              'writer' => __('Casual', 'cesis'),
                              'agency' => __('Agency', 'cesis'),
                              'careers' => __('Career', 'cesis'),
                            ),
                            'default'   => 'business'
                            ),

                  			)
                      ) );


                              Redux::setSection( $opt_name, array(
                                  'title'      => __( 'Pre-Footer settings', 'cesis' ),
                                  'desc'       => __( 'Portfolio Posts pre-footer settings', 'cesis' ),
                                  'id'         => 'tt-portfolio-prefooter',
                                  'subsection' => true,
                                  'fields'     => array(
                                      array(
                                                  'id'        => 'cesis_portfolio_prefooter',
                                                  'type'      => 'button_set',
                                                  'title'     => __('Banner type', 'cesis'),
                                                  'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                                                  'options' => array(
                                            'none' => __('No Banner', 'cesis'),
                                            'content' => __('Content Block', 'cesis'),
                                            'slider' => __('Slider Revolution', 'cesis'),
                                            'layerslider' => __('LayerSlider', 'cesis'),
                                         ),
                                        'default' => 'none'
                                    ),
                                    array(
                                                  'id'        => 'cesis_portfolio_pf_block_content',
                                                  'type'      => 'select',
                                    						  'required'  => array('cesis_portfolio_prefooter','=','content'),
                                                  'title'     => __('Select the Block content to use', 'cesis'),
                                                  'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                                  //Must provide key => value pairs for select options
                                                  'data'   => "content_block",
                          						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                                  'default'   => ''
                                    ),
                                    array(
                                                  'id'        => 'cesis_portfolio_pf_rev_slider',
                                                  'type'      => 'select',
                                    						  'required'  => array('cesis_portfolio_prefooter','=','slider'),
                                                  'title'     => __('Select the Slider revolution to use', 'cesis'),
                                                  'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                          			                  'options' => $rev_sliders,
                                                  'default'   => ''
                                    ),
                                    array(
                                                  'id'        => 'cesis_portfolio_pf_layer_slider',
                                                  'type'      => 'select',
                                    						  'required'  => array('cesis_portfolio_prefooter','=','layerslider'),
                                                  'title'     => __('Select the Layerslider to use', 'cesis'),
                                                  'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                          			                  'options' => $layerslider_array,
                                                  'default'   => ''
                                    ),
                                  )
                              ) );


                              Redux::setSection( $opt_name, array(
                                  'title'      => __( 'Footer settings', 'cesis' ),
                                  'desc'       => __( 'Portfolio Posts footer settings', 'cesis' ),
                                  'id'         => 'tt-portfolio-footer',
                                  'subsection' => true,
                                  'fields'     => array(
                                    array(
                                                  'id'        => 'cesis_portfolio_footer_fixed',
                                                  'type'      => 'button_set',
                                                  'title'     => __('Use fixed footer?', 'cesis'),
                                                  'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                                                  'options' => array(
                          					        'cesis_fixed_footer' =>  __('Yes', 'cesis'),
                          					        'no' =>  __('No', 'cesis'),
                                         ),
                                        'default' => 'no'
                                    ),
                                      array(
                                                  'id'        => 'cesis_portfolio_footer',
                                                  'type'      => 'button_set',
                                                  'title'     => __('Display the Footer main area?', 'cesis'),
                                                  'subtitle'  => __('If you want to show the Footer top part ( widget space ) select yes.', 'cesis'),
                                                  'options' => array(
                                            'yes' =>  __('Yes', 'cesis'),
                                            'no' =>  __('No', 'cesis'),
                                         ),
                                        'default' => 'yes'
                                    ),
                                    array(
                                                'id'        => 'cesis_portfolio_footer_bar',
                                                'type'      => 'button_set',
                                                'title'     => __('Display the Footer under bar?', 'cesis'),
                                                'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                                                'options' => array(
                                          'yes' =>  __('Yes', 'cesis'),
                                          'no' =>  __('No', 'cesis'),
                                       ),
                                      'default' => 'yes'
                                  ),
                                  )
                              ) );



            Redux::setSection( $opt_name, array(
              'title'  => __( 'Staff Posts Settings', 'cesis' ),
              'id'     => 'tt-staff',
              'desc'   => __( 'General Staff settings. For more detailed options check the sub sections.', 'cesis' ),
              'icon'   => 'fa-staff ',
              'fields' => array(

                array(
                      'id'       => 'cesis_staff_main_url',
                      'type'     => 'text',
                      'title'    => __('Put your Staff page URL', 'cesis'),
                      'subtitle' => __('Put your Staff page URL, will be used for buttons that take you back to the Staff ( use http:// )', 'cesis'),
                      'validate' => 'url',
                      'default'  => ''
                  ),

                                            array(
                                                  'id'       => 'cesis_staff_slug',
                                                  'type'     => 'text',
                                                  'title'    => __('Custom slug', 'cesis'),
                                                  'subtitle' => __('Make sure to save the permalinks after updating ( Settings > Permalinks, click "Saves Changes" )', 'cesis'),
                                                  'validate' => 'html',
                                                  'default'  => 'staff'
                                              ),

              )
          ) );

          Redux::setSection( $opt_name, array(
              'title'      => __( 'Header settings', 'cesis' ),
              'desc'       => __( 'Staff Posts header settings', 'cesis' ),
              'id'         => 'tt-staff-header',
              'subsection' => true,
              'fields'     => array(
                  array(
                              'id'        => 'cesis_staff_topbar',
                              'type'      => 'button_set',
                              'title'     => __('Display the Header Top Bar?', 'cesis'),
                              'subtitle'  => __('Select if you want to show the header top bar.', 'cesis'),
                              'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'no'
                ),
                array(
                            'id'        => 'cesis_staff_header',
                            'type'      => 'button_set',
                            'title'     => __('Display the Header?', 'cesis'),
                            'subtitle'  => __('Select if you want to show the header.', 'cesis'),
                            'options' => array(
                      'yes' =>  __('Yes', 'cesis'),
                      'no' =>  __('No', 'cesis'),
                   ),
                  'default' => 'yes'
              ),
              array(
                          'id'        => 'cesis_staff_header_transparent',
                          'type'      => 'button_set',
                          'title'     => __('Use Transparent Header?', 'cesis'),
                          'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
                          'options' => array(
                    'cesis_transparent_header' => __('Yes', 'cesis'),
                    'cesis_opaque_header' => __('No', 'cesis'),
                 ),
                'default' => 'cesis_opaque_header'
            ),
              )
          ) );

          Redux::setSection( $opt_name, array(
              'title'      => __( 'Banner settings', 'cesis' ),
              'desc'       => __( 'Staff Posts banner settings', 'cesis' ),
              'id'         => 'tt-staff-banner',
              'subsection' => true,
              'fields'     => array(
                  array(
                              'id'        => 'cesis_staff_banner',
                              'type'      => 'button_set',
                              'title'     => __('Banner type', 'cesis'),
                              'subtitle'  => __('Select the banner area type.', 'cesis'),
                              'options' => array(
                        'none' => __('No Banner', 'cesis'),
                        'content' => __('Content Block', 'cesis'),
                        'slider' => __('Slider Revolution', 'cesis'),
                        'layerslider' => __('LayerSlider', 'cesis'),
                     ),
                    'default' => 'none'
                ),
                array(
                            'id'        => 'cesis_staff_banner_pos',
                            'type'      => 'button_set',
                            'required'  => array('cesis_staff_banner','!=','none'),
                            'title'     => __('Banner position', 'cesis'),
                            'subtitle'  => __('Select the banner position.', 'cesis'),
                            'options' => array(
                      'under' => __('Under Header', 'cesis'),
                      'above' => __('Above Header', 'cesis'),
                   ),
                  'default' => 'under'
                ),
                array(
                              'id'        => 'cesis_staff_block_content',
                              'type'      => 'select',
                              'required'  => array('cesis_staff_banner','=','content'),
                              'title'     => __('Select the Block content to use', 'cesis'),
                              'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                              //Must provide key => value pairs for select options
                              'data'   => "content_block",
                                    'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                              'default'   => ''
                ),
                array(
                              'id'        => 'cesis_staff_rev_slider',
                              'type'      => 'select',
                						  'required'  => array('cesis_staff_banner','=','slider'),
                              'title'     => __('Select the Slider revolution to use', 'cesis'),
                              'subtitle'  => __('You need to have at least one slider created', 'cesis'),
      			                  'options' => $rev_sliders,
                              'default'   => ''
                ),
                array(
                              'id'        => 'cesis_staff_layer_slider',
                              'type'      => 'select',
                              'required'  => array('cesis_staff_banner','=','layerslider'),
                              'title'     => __('Select the Layerslider to use', 'cesis'),
                              'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                              'options' => $layerslider_array,
                              'default'   => ''
                ),
              )
          ) );


          Redux::setSection( $opt_name, array(
              'title'      => __( 'Title settings', 'cesis' ),
              'desc'       => __( 'Staff Posts title settings', 'cesis' ),
              'id'         => 'tt-staff-title',
              'subsection' => true,
              'fields'     => array(

                    array(
                        'id'        => 'cesis_staff_title',
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
      					    'id'       => 'cesis_staff_title_layout',
                    'required'  => array(
                         array('cesis_staff_title','=','yes'),
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
                              'id'        => 'cesis_staff_title_alignment',
                              'type'     => 'button_set',
      						'required'  => array(
      						array('cesis_staff_title_layout','not_contain','one'),
                       array('cesis_staff_title','=','yes'),
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
                              'id'        => 'cesis_staff_title_width',
                              'required'  => array(
                                   array('cesis_staff_title','=','yes'),
                              ),
                              'type'     => 'dimensions',
                              'height'     => false,
      						'units'    => array('px','%'),
                              'title'     => __('Select the Title container width ( px or % )', 'cesis'),
                              'subtitle'  => __('Default 1170px, select 100% to have full width Title container.', 'cesis'),
                              'default' => array(
      					        'width'   => '1170px',
                        'units' => 'px'
      					     ),


      			),
      			array(
                              'id'        => 'cesis_staff_title_height',
                              'required'  => array(
                                   array('cesis_staff_title','=','yes'),
                              ),
                              'type'     => 'dimensions',
                              'width'     => false,
      						'units'    => array('px','%'),
                              'title'     => __('Select the Title container height ( px or % )', 'cesis'),
                              'subtitle'  => __('Default 100px, use percentage to adapt the size depending on the user screen.', 'cesis'),
                              'default' => array(
      					        'height'   => '100px',
                        'units' => 'px'
      					     ),


      			),
      			array(
                              'id'        => 'cesis_staff_title_minheight',
                              'required'  => array(
                                   array('cesis_staff_title','=','yes'),
                              ),
                              'type'     => 'dimensions',
                              'width'     => false,
      						'units'    => array('px'),
                              'title'     => __('Select the Title minimum height ( px )', 'cesis'),
                              'subtitle'  => __('Good to set a minimum height when using % for title height.', 'cesis'),
                              'default' => array(
      					        'height'   => '70px',
                        'units' => 'px'
      					     ),


      			),
      			array(
                              'id'        => 'cesis_staff_title_background',
                              'required'  => array(
                                   array('cesis_staff_title','=','yes'),
                              ),
                              'type'      => 'background',
                              'title'     => __('Title Background Color / Image', 'cesis'),
                              'subtitle'  => __('Select the Title background color or Image.', 'cesis'),
                              'default'  => array(
                                'background-color' => '#ffffff',
                              )
                  ),
      			 array(
                              'id'        => 'cesis_staff_title_overlay',
                              'required'  => array(
                                   array('cesis_staff_title','=','yes'),
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
                              'id'        => 'cesis_staff_title_overlay_color',
      						'required'  => array(
      						array( 'cesis_staff_title_overlay', '=', 'yes') ,
                       array('cesis_staff_title','=','yes'),
      								),
                              'type'      => 'color_rgba',
                              'title'     => __('Title Overlay color', 'cesis'),
                              'subtitle'  => __('Title Overlay color', 'cesis'),
                              'default'   => array(
          					    'color'     => '#000000',
           						'alpha'     => '0.15',
                      'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.15' ),
         						),
      						'options'       => array(
      					        'clickout_fires_change'     => true,
      						),
                         ),
      			array(
      	                    'id'        => 'cesis_staff_title_border',
                            'required'  => array(
                                 array('cesis_staff_title','=','yes'),
                            ),
                              'type'      => 'color',
                              'title'     => __('Title border color', 'cesis'),
                              'subtitle'  => __('Title Border color (default: #ecf0f1).', 'cesis'),
                              'default'   => '#ecf0f1',
                              'validate'  => 'color',
                          ),

            array(
              'id'   => 'cesis_staff_title_info',
              'required'  => array(
                   array('cesis_staff_title','=','yes'),
              ),
              'type' => 'info',
              'style' => 'success',
              'title' => __('TITLE SETTINGS.', 'cesis'),
              'desc' => __('Title text settings ).', 'cesis')
            ),

            array(
                              'id'        => 'cesis_staff_title_display',
                              'required'  => array(
                                   array('cesis_staff_title','=','yes'),
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
      						'id'          => 'cesis_staff_title_font',
      					    'type'        => 'typography',
      						'required'  => array( 'cesis_staff_title_display', '=', 'yes'),
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
      					        'font-weight'  => '500',
      					        'line-height'  => '32px',
      					        'font-family' => 'Roboto',
      					        'google'      => true,
      					        'font-size'   => '28px',
      							'letter-spacing' => '0',
      							'text-transform' => 'none',
      					    ),
      					),

      array(
      'id'   => 'cesis_staff_breadcrumbs_info',
      'required'  => array(
           array('cesis_staff_title','=','yes'),
      ),
      'type' => 'info',
      'style' => 'success',
      'title' => __('BREADCRUMBS SETTINGS.', 'cesis'),
      'desc' => __('Title text settings ).', 'cesis')
      ),


               	 array(
                              'id'        => 'cesis_staff_breadcrumbs_display',
                              'required'  => array(
                                   array('cesis_staff_title','=','yes'),
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
                              'id'        => 'cesis_staff_breadcrumbs_display_home',
                              'type'     => 'button_set',
      						'required'  => array( 'cesis_staff_breadcrumbs_display', '=', 'yes') ,
                              'title'     => __('Display the "Home" link on breadcrumb?', 'cesis'),
                              'subtitle'  => __('Select if you want show or hide the Home link.', 'cesis'),
                              'options' => array(
      					        'yes' =>  __('Yes', 'cesis'),
      					        'no' =>  __('No', 'cesis'),
      					     ),
      					    'default' => 'yes'


      			),
      		  	array(
      				    'id'       => 'cesis_staff_breadcrumbs_front',
      					'required'  => array( 'cesis_staff_breadcrumbs_display', '=', 'yes') ,
      				    'type'     => 'text',
      				    'title'    => __('Breadcrumb front Text', 'cesis'),
      				    'subtitle' => __('Text to show before the breadcrumbs, ex: You are here', 'cesis'),
      				    'desc'     => __('Keep empty to hide the front text.', 'cesis'),
      				    'validate' => 'html',
      				    'default'  => ' '
      			),
      		  	array(
      				    'id'       => 'cesis_staff_breadcrumbs_sep',
      					'required'  => array( 'cesis_staff_breadcrumbs_display', '=', 'yes') ,
      				    'type'     => 'text',
      				    'title'    => __('Breadcrumbs Separator.', 'cesis'),
      				    'subtitle' => __('Link Separator, ex: / ', 'cesis'),
      				    'desc'     => __('Will separate the links.', 'cesis'),
      				    'validate' => 'html',
      				    'default'  => '/'
      			),

      			array(
      						'id'          => 'cesis_staff_breadcrumbs_font',
      						'required'  => array( 'cesis_staff_breadcrumbs_display', '=', 'yes') ,
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
      					        'font-family' => 'Roboto',
      					        'google'      => true,
      					        'font-size'   => '13px',
      					        'line-height'  => '30px',
      							'letter-spacing' => '0',
      							'text-transform' => 'none',
      					    ),
      					),
      			array(
                              'id'        => 'cesis_staff_current_breadcrumbs_color',
      						'required'  => array( 'cesis_staff_breadcrumbs_display', '=', 'yes') ,
                              'type'      => 'color',
                              'title'     => __('Breadcrumb hover color', 'cesis'),
                              'subtitle'  => __('Breadcrumbs hover color.', 'cesis'),
                              'default'   => '#ecf0f1',
                              'validate'  => 'color',
                         ),
      			array(
                              'id'        => 'cesis_staff_breadcrumbs_bg_color',
      						'required'  => array( 'cesis_staff_breadcrumbs_display', '=', 'yes') ,
                              'type'      => 'color_rgba',
                              'title'     => __('Breadcrumb background color', 'cesis'),
                              'subtitle'  => __('Breadcrumb background color ( only used in title layout 3 ).', 'cesis'),
                              'default'   => array(
          					    'color'     => '#000000',
           						'alpha'     => 0.05,
                      'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.05' ),
         						),
      						'options'       => array(
      					        'clickout_fires_change'     => true,
      						),
                         ),


      			array(
                              'id'        => 'cesis_staff_breadcrumbs_word_char',
      						'required'  => array( 'cesis_staff_breadcrumbs_display', '=', 'yes') ,
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
      				    'id'       => 'cesis_staff_breadcrumbs_word_char_count',
      					'required'  => array( 'cesis_staff_breadcrumbs_display', '=', 'yes') ,
      				    'type'     => 'text',
      				    'title'    => __('Breadcrumb Title max word/Character count', 'cesis'),
      				    'subtitle' => __('Example : 4', 'cesis'),
      				    'validate' => 'numeric',
      				    'default'  => '4'
      			),

      		  	array(
      				    'id'       => 'cesis_staff_breadcrumbs_word_char_end',
      					'required'  => array( 'cesis_staff_breadcrumbs_display', '=', 'yes') ,
      				    'type'     => 'text',
      				    'title'    => __('Ending Character to show after cut title', 'cesis'),
      				    'subtitle' => __('Example : ...', 'cesis'),
      				    'validate' => 'html',
      				    'default'  => ''
      			),

              )
          ) );

          Redux::setSection( $opt_name, array(
              'title'      => __( 'Layout settings', 'cesis' ),
              'desc'       => __( 'All the settings for Single staff posts page, For full documentation on this field, visit: ', 'cesis' ) . '<a href="https://cesis.co/wp-content/uploads/documentation/cesis_documentation.html" target="_blank">Cesis Header Top Bar Documentation</a>',
              'id'         => 'tt-staff-layout',
              'subsection' => true,
              'fields'     => array(

      			array(
                   	   'id'        => 'cesis_staff_content_width',
                         'type'     => 'dimensions',
                         'height'     => false,
      				   'units'    => array('px','%'),
                         'title'     => __('Select the Single staff posts main content container width ( px or % )', 'cesis'),
                         'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                         'default' => array(
      					        'width'   => '1170px',
                        'units' => 'px'
      					     ),
      			),
      			array(
                              'id'        => 'cesis_staff_content_top_padding',
                              'type'     => 'dimensions',
                              'width'     => false,
      						'units'    => array('px'),
                              'title'     => __('Select the Single staff posts main content top space ( top padding px )', 'cesis'),
                              'subtitle'  => __('If no sidebar used and content build with Page builder 0 is recommended.', 'cesis'),
                              'default' => array(
      					        'height'   => '60px',
                        'units' => 'px'
      					     ),


      			),
      			array(
                              'id'        => 'cesis_staff_content_bottom_padding',
                              'type'     => 'dimensions',
                              'width'     => false,
      						'units'    => array('px'),
                              'title'     => __('Select the Single staff posts main content bottom space ( bottom padding px )', 'cesis'),
                              'subtitle'  => __('If no sidebar used and content build with Page builder 0 is recommended.', 'cesis'),
                              'default' => array(
      					        'height'   => '60px',
                        'units' => 'px'
      					     ),


      			),
      			array(
      					    'id'       => 'cesis_staff_sp_layout',
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
                  'id' => 'cesis_staff_sp_sidebar_select',
                  'title' => __('Sidebar', 'cesis'),
                  'desc' => 'Please select the sidebar to use.',
                  'type' => 'select',
                  'data' => 'sidebars',
                  'required'  => array(
                        array('cesis_staff_sp_layout','not','no_sidebar'),
                  ),
                  'default' => 'None'
                ),
      			array(
                              'id'        => 'cesis_staff_agc',
                              'type'     => 'button_set',
                              'title'     => __('Display the Auto Generated content on the page ?', 'cesis'),
                              'subtitle'  => __('Select if you want to show the staff content auto genarated by the theme template.', 'cesis'),

                              'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
      					     ),
      					    'default' => 'yes'


      				),
              array(
                             'id'        => 'cesis_staff_style',
                             'type'      => 'select',
                             'title'     => __('Select the Single staff posts thumbnail style', 'cesis'),
                             'subtitle'  => __('Select the thumbnail style for the auto generated content.', 'cesis'),
                             'required' => array(

                             array('cesis_staff_agc','=','yes')

                             ),

                             //Must provide key => value pairs for select options
                             'options'   => array(
                                 'cesis_staff_sp_classic' => __('Classic', 'cesis'),
                                 'cesis_staff_sp_framed' => __('White framed', 'cesis'),
                             ),
                             'default'   => 'cesis_staff_sp_classic'
                           ),

                         array(
                                           'id'        => 'cesis_staff_sp_navigation',
                                           'type'     => 'button_set',
                                           'title'     => __('Display the Previous / Next Navigation?', 'cesis'),
                                           'subtitle'  => __('Select if you want to show Previous and Next navigation button.', 'cesis'),

                                           'options' => array(
                                     'yes' =>  __('Yes', 'cesis'),
                                     'no' =>  __('No', 'cesis'),
                                  ),
                                 'default' => 'yes'


                           ),

                           array(
                                          'id'        => 'cesis_staff_sp_navigation_style',
                                          'type'      => 'select',
                                          'title'     => __('Select the navigation style', 'cesis'),
                                          'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                                          'required'  => array('cesis_staff_sp_navigation','=','yes'),
                                          //Must provide key => value pairs for select options
                                          'options'   => array(
                                              'business' => __('Classic', 'cesis'),
                                              'writer' => __('Casual', 'cesis'),
                                              'agency' => __('Agency', 'cesis'),
                                              'careers' => __('Career', 'cesis'),
                                          ),
                                          'default'   => 'business'
                            ),




      			)
          ) );


                  Redux::setSection( $opt_name, array(
                      'title'      => __( 'Pre-Footer settings', 'cesis' ),
                      'desc'       => __( 'Staff posts pre-footer settings', 'cesis' ),
                      'id'         => 'tt-staff-prefooter',
                      'subsection' => true,
                      'fields'     => array(
                          array(
                                      'id'        => 'cesis_staff_prefooter',
                                      'type'      => 'button_set',
                                      'title'     => __('Banner type', 'cesis'),
                                      'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                                      'options' => array(
                                'none' => __('No Banner', 'cesis'),
                                'content' => __('Content Block', 'cesis'),
                                'slider' => __('Slider Revolution', 'cesis'),
                                'layerslider' => __('LayerSlider', 'cesis'),
                             ),
                            'default' => 'none'
                        ),
                        array(
                                      'id'        => 'cesis_staff_pf_block_content',
                                      'type'      => 'select',
                        						  'required'  => array('cesis_staff_prefooter','=','content'),
                                      'title'     => __('Select the Block content to use', 'cesis'),
                                      'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                      //Must provide key => value pairs for select options
                                      'data'   => "content_block",
              						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                      'default'   => ''
                        ),
                        array(
                                      'id'        => 'cesis_staff_pf_rev_slider',
                                      'type'      => 'select',
                        						  'required'  => array('cesis_staff_prefooter','=','slider'),
                                      'title'     => __('Select the Slider revolution to use', 'cesis'),
                                      'subtitle'  => __('You need to have at least one slider created', 'cesis'),
              			                  'options' => $rev_sliders,
                                      'default'   => ''
                        ),
                        array(
                                      'id'        => 'cesis_staff_pf_layer_slider',
                                      'type'      => 'select',
                                      'required'  => array('cesis_staff_prefooter','=','layerslider'),
                                      'title'     => __('Select the Layerslider to use', 'cesis'),
                                      'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                      'options' => $layerslider_array,
                                      'default'   => ''
                        ),
                      )
                  ) );


                  Redux::setSection( $opt_name, array(
                      'title'      => __( 'Footer settings', 'cesis' ),
                      'desc'       => __( 'Staff Posts footer settings', 'cesis' ),
                      'id'         => 'tt-staff-footer',
                      'subsection' => true,
                      'fields'     => array(
                        array(
                                      'id'        => 'cesis_staff_footer_fixed',
                                      'type'      => 'button_set',
                                      'title'     => __('Use fixed footer?', 'cesis'),
                                      'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                                      'options' => array(
              					        'cesis_fixed_footer' =>  __('Yes', 'cesis'),
              					        'no' =>  __('No', 'cesis'),
                             ),
                            'default' => 'no'
                        ),
                          array(
                                      'id'        => 'cesis_staff_footer',
                                      'type'      => 'button_set',
                                      'title'     => __('Display the Footer main area?', 'cesis'),
                                      'subtitle'  => __('If you want to show the Footer top part ( widget space ) select yes.', 'cesis'),
                                      'options' => array(
                                'yes' =>  __('Yes', 'cesis'),
                                'no' =>  __('No', 'cesis'),
                             ),
                            'default' => 'yes'
                        ),
                        array(
                                    'id'        => 'cesis_staff_footer_bar',
                                    'type'      => 'button_set',
                                    'title'     => __('Display the Footer under bar?', 'cesis'),
                                    'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                                    'options' => array(
                              'yes' =>  __('Yes', 'cesis'),
                              'no' =>  __('No', 'cesis'),
                           ),
                          'default' => 'yes'
                      ),
                      )
                  ) );

            Redux::setSection( $opt_name, array(
              'title'  => __( 'Career Positions Settings', 'cesis' ),
              'id'     => 'tt-career',
              'desc'   => __( 'General career positions settings. For more detailed options check the sub sections.', 'cesis' ),
              'icon'   => 'fa-career ',
              'fields' => array(

                array(
                      'id'       => 'cesis_career_main_url',
                      'type'     => 'text',
                      'title'    => __('Put your Career positions page URL', 'cesis'),
                      'subtitle' => __('Put your career positions page URL, will be used for buttons that take you back to the career positions  ( use http:// )', 'cesis'),
                      'validate' => 'url',
                      'default'  => ''
                  ),

                                            array(
                                                  'id'       => 'cesis_career_slug',
                                                  'type'     => 'text',
                                                  'title'    => __('Custom slug', 'cesis'),
                                                  'subtitle' => __('Make sure to save the permalinks after updating ( Settings > Permalinks, click "Saves Changes" )', 'cesis'),
                                                  'validate' => 'html',
                                                  'default'  => 'careers'
                                              ),

              )
          ) );

          Redux::setSection( $opt_name, array(
              'title'      => __( 'Header settings', 'cesis' ),
              'desc'       => __( 'Career positions header settings', 'cesis' ),
              'id'         => 'tt-career-header',
              'subsection' => true,
              'fields'     => array(
                  array(
                              'id'        => 'cesis_career_topbar',
                              'type'      => 'button_set',
                              'title'     => __('Display the Header Top Bar?', 'cesis'),
                              'subtitle'  => __('Select if you want to show the header top bar.', 'cesis'),
                              'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'no'
                ),
                array(
                            'id'        => 'cesis_career_header',
                            'type'      => 'button_set',
                            'title'     => __('Display the Header?', 'cesis'),
                            'subtitle'  => __('Select if you want to show the header.', 'cesis'),
                            'options' => array(
                      'yes' =>  __('Yes', 'cesis'),
                      'no' =>  __('No', 'cesis'),
                   ),
                  'default' => 'yes'
              ),
              array(
                          'id'        => 'cesis_career_header_transparent',
                          'type'      => 'button_set',
                          'title'     => __('Use Transparent Header?', 'cesis'),
                          'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
                          'options' => array(
                    'cesis_transparent_header' => __('Yes', 'cesis'),
                    'cesis_opaque_header' => __('No', 'cesis'),
                 ),
                'default' => 'cesis_opaque_header'
            ),
              )
          ) );

          Redux::setSection( $opt_name, array(
              'title'      => __( 'Banner settings', 'cesis' ),
              'desc'       => __( 'Career positions banner settings', 'cesis' ),
              'id'         => 'tt-career-banner',
              'subsection' => true,
              'fields'     => array(
                  array(
                              'id'        => 'cesis_career_banner',
                              'type'      => 'button_set',
                              'title'     => __('Banner type', 'cesis'),
                              'subtitle'  => __('Select the banner area type.', 'cesis'),
                              'options' => array(
                        'none' => __('No Banner', 'cesis'),
                        'content' => __('Content Block', 'cesis'),
                        'slider' => __('Slider Revolution', 'cesis'),
                        'layerslider' => __('LayerSlider', 'cesis'),
                     ),
                    'default' => 'none'
                ),
                array(
                            'id'        => 'cesis_career_banner_pos',
                            'type'      => 'button_set',
                            'required'  => array('cesis_career_banner','!=','none'),
                            'title'     => __('Banner position', 'cesis'),
                            'subtitle'  => __('Select the banner position.', 'cesis'),
                            'options' => array(
                      'under' => __('Under Header', 'cesis'),
                      'above' => __('Above Header', 'cesis'),
                   ),
                  'default' => 'under'
                ),
                array(
                              'id'        => 'cesis_career_block_content',
                              'type'      => 'select',
                              'required'  => array('cesis_career_banner','=','content'),
                              'title'     => __('Select the Block content to use', 'cesis'),
                              'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                              //Must provide key => value pairs for select options
                              'data'   => "content_block",
                                    'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                              'default'   => ''
                ),
                array(
                              'id'        => 'cesis_career_rev_slider',
                              'type'      => 'select',
                						  'required'  => array('cesis_career_banner','=','slider'),
                              'title'     => __('Select the Slider revolution to use', 'cesis'),
                              'subtitle'  => __('You need to have at least one slider created', 'cesis'),
      			                  'options' => $rev_sliders,
                              'default'   => ''
                ),
                array(
                              'id'        => 'cesis_career_layer_slider',
                              'type'      => 'select',
                              'required'  => array('cesis_career_banner','=','layerslider'),
                              'title'     => __('Select the Layerslider to use', 'cesis'),
                              'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                              'options' => $layerslider_array,
                              'default'   => ''
                ),
              )
          ) );


          Redux::setSection( $opt_name, array(
              'title'      => __( 'Title settings', 'cesis' ),
              'desc'       => __( 'Career positions title settings', 'cesis' ),
              'id'         => 'tt-career-title',
              'subsection' => true,
              'fields'     => array(

                    array(
                        'id'        => 'cesis_career_title',
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
      					    'id'       => 'cesis_career_title_layout',
                    'required'  => array(
                         array('cesis_career_title','=','yes'),
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
                              'id'        => 'cesis_career_title_alignment',
                              'type'     => 'button_set',
      						'required'  => array(
      						array('cesis_career_title_layout','not_contain','one'),
                       array('cesis_career_title','=','yes'),
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
                              'id'        => 'cesis_career_title_width',
                              'required'  => array(
                                   array('cesis_career_title','=','yes'),
                              ),
                              'type'     => 'dimensions',
                              'height'     => false,
      						'units'    => array('px','%'),
                              'title'     => __('Select the Title container width ( px or % )', 'cesis'),
                              'subtitle'  => __('Default 1170px, select 100% to have full width Title container.', 'cesis'),
                              'default' => array(
      					        'width'   => '1170px',
                        'units' => 'px'
      					     ),


      			),
      			array(
                              'id'        => 'cesis_career_title_height',
                              'required'  => array(
                                   array('cesis_career_title','=','yes'),
                              ),
                              'type'     => 'dimensions',
                              'width'     => false,
      						'units'    => array('px','%'),
                              'title'     => __('Select the Title container height ( px or % )', 'cesis'),
                              'subtitle'  => __('Default 100px, use percentage to adapt the size depending on the user screen.', 'cesis'),
                              'default' => array(
      					        'height'   => '100px',
                        'units' => 'px'
      					     ),


      			),
      			array(
                              'id'        => 'cesis_career_title_minheight',
                              'required'  => array(
                                   array('cesis_career_title','=','yes'),
                              ),
                              'type'     => 'dimensions',
                              'width'     => false,
      						'units'    => array('px'),
                              'title'     => __('Select the Title minimum height ( px )', 'cesis'),
                              'subtitle'  => __('Good to set a minimum height when using % for title height.', 'cesis'),
                              'default' => array(
      					        'height'   => '70px',
                        'units' => 'px'
      					     ),


      			),
      			array(
                              'id'        => 'cesis_career_title_background',
                              'required'  => array(
                                   array('cesis_career_title','=','yes'),
                              ),
                              'type'      => 'background',
                              'title'     => __('Title Background Color / Image', 'cesis'),
                              'subtitle'  => __('Select the Title background color or Image.', 'cesis'),
                              'default'  => array(
                                'background-color' => '#ffffff',
                              )
                  ),
      			 array(
                              'id'        => 'cesis_career_title_overlay',
                              'required'  => array(
                                   array('cesis_career_title','=','yes'),
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
                              'id'        => 'cesis_career_title_overlay_color',
      						'required'  => array(
      						array( 'cesis_career_title_overlay', '=', 'yes') ,
                       array('cesis_career_title','=','yes'),
      								),
                              'type'      => 'color_rgba',
                              'title'     => __('Title Overlay color', 'cesis'),
                              'subtitle'  => __('Title Overlay color', 'cesis'),
                              'default'   => array(
          					    'color'     => '#000000',
           						'alpha'     => '0.15',
                      'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.15' ),
         						),
      						'options'       => array(
      					        'clickout_fires_change'     => true,
      						),
                         ),
      			array(
      	                    'id'        => 'cesis_career_title_border',
                            'required'  => array(
                                 array('cesis_career_title','=','yes'),
                            ),
                              'type'      => 'color',
                              'title'     => __('Title border color', 'cesis'),
                              'subtitle'  => __('Title Border color (default: #ecf0f1).', 'cesis'),
                              'default'   => '#ecf0f1',
                              'validate'  => 'color',
                          ),

            array(
              'id'   => 'cesis_career_title_info',
              'required'  => array(
                   array('cesis_career_title','=','yes'),
              ),
              'type' => 'info',
              'style' => 'success',
              'title' => __('TITLE SETTINGS.', 'cesis'),
              'desc' => __('Title text settings ).', 'cesis')
            ),

            array(
                              'id'        => 'cesis_career_title_display',
                              'required'  => array(
                                   array('cesis_career_title','=','yes'),
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
      						'id'          => 'cesis_career_title_font',
      					    'type'        => 'typography',
      						'required'  => array( 'cesis_career_title_display', '=', 'yes'),
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
      					        'font-weight'  => '500',
      					        'line-height'  => '32px',
      					        'font-family' => 'Roboto',
      					        'google'      => true,
      					        'font-size'   => '28px',
      							'letter-spacing' => '0',
      							'text-transform' => 'none',
      					    ),
      					),

      array(
      'id'   => 'cesis_career_breadcrumbs_info',
      'required'  => array(
           array('cesis_career_title','=','yes'),
      ),
      'type' => 'info',
      'style' => 'success',
      'title' => __('BREADCRUMBS SETTINGS.', 'cesis'),
      'desc' => __('Title text settings ).', 'cesis')
      ),


               	 array(
                              'id'        => 'cesis_career_breadcrumbs_display',
                              'required'  => array(
                                   array('cesis_career_title','=','yes'),
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
                              'id'        => 'cesis_career_breadcrumbs_display_home',
                              'type'     => 'button_set',
      						'required'  => array( 'cesis_career_breadcrumbs_display', '=', 'yes') ,
                              'title'     => __('Display the "Home" link on breadcrumb?', 'cesis'),
                              'subtitle'  => __('Select if you want show or hide the Home link.', 'cesis'),
                              'options' => array(
      					        'yes' =>  __('Yes', 'cesis'),
      					        'no' =>  __('No', 'cesis'),
      					     ),
      					    'default' => 'yes'


      			),
      		  	array(
      				    'id'       => 'cesis_career_breadcrumbs_front',
      					'required'  => array( 'cesis_career_breadcrumbs_display', '=', 'yes') ,
      				    'type'     => 'text',
      				    'title'    => __('Breadcrumb front Text', 'cesis'),
      				    'subtitle' => __('Text to show before the breadcrumbs, ex: You are here', 'cesis'),
      				    'desc'     => __('Keep empty to hide the front text.', 'cesis'),
      				    'validate' => 'html',
      				    'default'  => ' '
      			),
      		  	array(
      				    'id'       => 'cesis_career_breadcrumbs_sep',
      					'required'  => array( 'cesis_career_breadcrumbs_display', '=', 'yes') ,
      				    'type'     => 'text',
      				    'title'    => __('Breadcrumbs Separator.', 'cesis'),
      				    'subtitle' => __('Link Separator, ex: / ', 'cesis'),
      				    'desc'     => __('Will separate the links.', 'cesis'),
      				    'validate' => 'html',
      				    'default'  => '/'
      			),

      			array(
      						'id'          => 'cesis_career_breadcrumbs_font',
      						'required'  => array( 'cesis_career_breadcrumbs_display', '=', 'yes') ,
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
      					        'font-family' => 'Roboto',
      					        'google'      => true,
      					        'font-size'   => '13px',
      					        'line-height'  => '30px',
      							'letter-spacing' => '0',
      							'text-transform' => 'none',
      					    ),
      					),
      			array(
                              'id'        => 'cesis_career_current_breadcrumbs_color',
      						'required'  => array( 'cesis_career_breadcrumbs_display', '=', 'yes') ,
                              'type'      => 'color',
                              'title'     => __('Breadcrumb hover color', 'cesis'),
                              'subtitle'  => __('Breadcrumbs hover color.', 'cesis'),
                              'default'   => '#ecf0f1',
                              'validate'  => 'color',
                         ),
      			array(
                              'id'        => 'cesis_career_breadcrumbs_bg_color',
      						'required'  => array( 'cesis_career_breadcrumbs_display', '=', 'yes') ,
                              'type'      => 'color_rgba',
                              'title'     => __('Breadcrumb background color', 'cesis'),
                              'subtitle'  => __('Breadcrumb background color ( only used in title layout 3 ).', 'cesis'),
                              'default'   => array(
          					    'color'     => '#000000',
           						'alpha'     => 0.05,
                      'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.05' ),
         						),
      						'options'       => array(
      					        'clickout_fires_change'     => true,
      						),
                         ),


      			array(
                              'id'        => 'cesis_career_breadcrumbs_word_char',
      						'required'  => array( 'cesis_career_breadcrumbs_display', '=', 'yes') ,
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
      				    'id'       => 'cesis_career_breadcrumbs_word_char_count',
      					'required'  => array( 'cesis_career_breadcrumbs_display', '=', 'yes') ,
      				    'type'     => 'text',
      				    'title'    => __('Breadcrumb Title max word/Character count', 'cesis'),
      				    'subtitle' => __('Example : 4', 'cesis'),
      				    'validate' => 'numeric',
      				    'default'  => '4'
      			),

      		  	array(
      				    'id'       => 'cesis_career_breadcrumbs_word_char_end',
      					'required'  => array( 'cesis_career_breadcrumbs_display', '=', 'yes') ,
      				    'type'     => 'text',
      				    'title'    => __('Ending Character to show after cut title', 'cesis'),
      				    'subtitle' => __('Example : ...', 'cesis'),
      				    'validate' => 'html',
      				    'default'  => ''
      			),

              )
          ) );

          Redux::setSection( $opt_name, array(
              'title'      => __( 'Layout settings', 'cesis' ),
              'desc'       => __( 'All the settings for Single career position page, For full documentation on this field, visit: ', 'cesis' ) . '<a href="https://cesis.co/wp-content/uploads/documentation/cesis_documentation.html" target="_blank">Cesis Header Top Bar Documentation</a>',
              'id'         => 'tt-career-layout',
              'subsection' => true,
              'fields'     => array(

      			array(
                   	   'id'        => 'cesis_career_content_width',
                         'type'     => 'dimensions',
                         'height'     => false,
      				   'units'    => array('px','%'),
                         'title'     => __('Select the Single career position main content container width ( px or % )', 'cesis'),
                         'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                         'default' => array(
      					        'width'   => '1170px',
                        'units' => 'px'
      					     ),
      			),
      			array(
                              'id'        => 'cesis_career_content_top_padding',
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
                              'id'        => 'cesis_career_content_bottom_padding',
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
      					    'id'       => 'cesis_career_sp_layout',
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
                  'id' => 'cesis_career_sp_sidebar_select',
                  'title' => __('Sidebar', 'cesis'),
                  'desc' => 'Please select the sidebar to use.',
                  'type' => 'select',
                  'data' => 'sidebars',
                  'required'  => array(
                        array('cesis_career_sp_layout','not','no_sidebar'),
                  ),
                  'default' => 'None'
                ),

                         array(
                                           'id'        => 'cesis_career_sp_navigation',
                                           'type'     => 'button_set',
                                           'title'     => __('Display the Previous / Next Navigation?', 'cesis'),
                                           'subtitle'  => __('Select if you want to show Previous and Next navigation button.', 'cesis'),

                                           'options' => array(
                                     'yes' =>  __('Yes', 'cesis'),
                                     'no' =>  __('No', 'cesis'),
                                  ),
                                 'default' => 'no'


                           ),

                           array(
                                          'id'        => 'cesis_career_sp_navigation_style',
                                          'type'      => 'select',
                                          'title'     => __('Select the navigation style', 'cesis'),
                                          'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                                          'required'  => array('cesis_career_sp_navigation','=','yes'),
                                          //Must provide key => value pairs for select options
                                          'options'   => array(
                                              'business' => __('Classic', 'cesis'),
                                              'writer' => __('Casual', 'cesis'),
                                              'agency' => __('Agency', 'cesis'),
                                              'careers' => __('Career', 'cesis'),
                                          ),
                                          'default'   => 'business'
                            ),




      			)
          ) );


                  Redux::setSection( $opt_name, array(
                      'title'      => __( 'Pre-Footer settings', 'cesis' ),
                      'desc'       => __( 'career posts pre-footer settings', 'cesis' ),
                      'id'         => 'tt-career-prefooter',
                      'subsection' => true,
                      'fields'     => array(
                          array(
                                      'id'        => 'cesis_career_prefooter',
                                      'type'      => 'button_set',
                                      'title'     => __('Banner type', 'cesis'),
                                      'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                                      'options' => array(
                                'none' => __('No Banner', 'cesis'),
                                'content' => __('Content Block', 'cesis'),
                                'slider' => __('Slider Revolution', 'cesis'),
                                'layerslider' => __('LayerSlider', 'cesis'),
                             ),
                            'default' => 'none'
                        ),
                        array(
                                      'id'        => 'cesis_career_pf_block_content',
                                      'type'      => 'select',
                        						  'required'  => array('cesis_career_prefooter','=','content'),
                                      'title'     => __('Select the Block content to use', 'cesis'),
                                      'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                      //Must provide key => value pairs for select options
                                      'data'   => "content_block",
              						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                      'default'   => ''
                        ),
                        array(
                                      'id'        => 'cesis_career_pf_rev_slider',
                                      'type'      => 'select',
                        						  'required'  => array('cesis_career_prefooter','=','slider'),
                                      'title'     => __('Select the Slider revolution to use', 'cesis'),
                                      'subtitle'  => __('You need to have at least one slider created', 'cesis'),
              			                  'options' => $rev_sliders,
                                      'default'   => ''
                        ),
                        array(
                                      'id'        => 'cesis_career_pf_layer_slider',
                                      'type'      => 'select',
                                      'required'  => array('cesis_career_prefooter','=','layerslider'),
                                      'title'     => __('Select the Layerslider to use', 'cesis'),
                                      'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                      'options' => $layerslider_array,
                                      'default'   => ''
                        ),
                      )
                  ) );


                  Redux::setSection( $opt_name, array(
                      'title'      => __( 'Footer settings', 'cesis' ),
                      'desc'       => __( 'career Posts footer settings', 'cesis' ),
                      'id'         => 'tt-career-footer',
                      'subsection' => true,
                      'fields'     => array(
                        array(
                                      'id'        => 'cesis_career_footer_fixed',
                                      'type'      => 'button_set',
                                      'title'     => __('Use fixed footer?', 'cesis'),
                                      'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                                      'options' => array(
              					        'cesis_fixed_footer' =>  __('Yes', 'cesis'),
              					        'no' =>  __('No', 'cesis'),
                             ),
                            'default' => 'no'
                        ),
                          array(
                                      'id'        => 'cesis_career_footer',
                                      'type'      => 'button_set',
                                      'title'     => __('Display the Footer main area?', 'cesis'),
                                      'subtitle'  => __('If you want to show the Footer top part ( widget space ) select yes.', 'cesis'),
                                      'options' => array(
                                'yes' =>  __('Yes', 'cesis'),
                                'no' =>  __('No', 'cesis'),
                             ),
                            'default' => 'yes'
                        ),
                        array(
                                    'id'        => 'cesis_career_footer_bar',
                                    'type'      => 'button_set',
                                    'title'     => __('Display the Footer under bar?', 'cesis'),
                                    'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                                    'options' => array(
                              'yes' =>  __('Yes', 'cesis'),
                              'no' =>  __('No', 'cesis'),
                           ),
                          'default' => 'yes'
                      ),
                      )
                  ) );

                  Redux::setSection( $opt_name, array(
                    'title'  => __( 'WooCommerce Product Settings', 'cesis' ),
                    'id'     => 'tt-woocommerce',
                    'desc'   => __( 'General WooCommerce settings. For more detailed options check the sub sections.', 'cesis' ),
                    'icon'   => 'fa-woocommerce ',
                    'fields' => array(

                      array(
                            'id'       => 'cesis_shop_main_url',
                            'type'     => 'text',
                            'title'    => __('Put your Shop page URL', 'cesis'),
                            'subtitle' => __('Put your Shop page URL, will be used for buttons that take you back to the Shop ( use http:// )', 'cesis'),
                            'validate' => 'url',
                            'default'  => ''
                        ),

                    )
                ) );

                Redux::setSection( $opt_name, array(
                    'title'      => __( 'Header settings', 'cesis' ),
                    'desc'       => __( 'Product posts header settings', 'cesis' ),
                    'id'         => 'tt-shop-header',
                    'subsection' => true,
                    'fields'     => array(
                        array(
                                    'id'        => 'cesis_shop_topbar',
                                    'type'      => 'button_set',
                                    'title'     => __('Display the Header Top Bar?', 'cesis'),
                                    'subtitle'  => __('Select if you want to show the header top bar.', 'cesis'),
                                    'options' => array(
                              'yes' =>  __('Yes', 'cesis'),
                              'no' =>  __('No', 'cesis'),
                           ),
                          'default' => 'no'
                      ),
                      array(
                                  'id'        => 'cesis_shop_header',
                                  'type'      => 'button_set',
                                  'title'     => __('Display the Header?', 'cesis'),
                                  'subtitle'  => __('Select if you want to show the header.', 'cesis'),
                                  'options' => array(
                            'yes' =>  __('Yes', 'cesis'),
                            'no' =>  __('No', 'cesis'),
                         ),
                        'default' => 'yes'
                    ),
                    array(
                                'id'        => 'cesis_shop_header_transparent',
                                'type'      => 'button_set',
                                'title'     => __('Use Transparent Header?', 'cesis'),
                                'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
                                'options' => array(
                          'cesis_transparent_header' => __('Yes', 'cesis'),
                          'cesis_opaque_header' => __('No', 'cesis'),
                       ),
                      'default' => 'cesis_opaque_header'
                  ),
                    )
                ) );

                Redux::setSection( $opt_name, array(
                    'title'      => __( 'Banner settings', 'cesis' ),
                    'desc'       => __( 'Product Posts banner settings', 'cesis' ),
                    'id'         => 'tt-shop-banner',
                    'subsection' => true,
                    'fields'     => array(
                        array(
                                    'id'        => 'cesis_shop_banner',
                                    'type'      => 'button_set',
                                    'title'     => __('Banner type', 'cesis'),
                                    'subtitle'  => __('Select the banner area type.', 'cesis'),
                                    'options' => array(
                              'none' => __('No Banner', 'cesis'),
                              'content' => __('Content Block', 'cesis'),
                              'slider' => __('Slider Revolution', 'cesis'),
                              'layerslider' => __('LayerSlider', 'cesis'),
                           ),
                          'default' => 'none'
                      ),
                      array(
                                  'id'        => 'cesis_shop_banner_pos',
                                  'type'      => 'button_set',
                                  'required'  => array('cesis_shop_banner','!=','none'),
                                  'title'     => __('Banner position', 'cesis'),
                                  'subtitle'  => __('Select the banner position.', 'cesis'),
                                  'options' => array(
                            'under' => __('Under Header', 'cesis'),
                            'above' => __('Above Header', 'cesis'),
                         ),
                        'default' => 'under'
                      ),
                      array(
                                    'id'        => 'cesis_shop_block_content',
                                    'type'      => 'select',
                                    'required'  => array('cesis_shop_banner','=','content'),
                                    'title'     => __('Select the Block content to use', 'cesis'),
                                    'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                    //Must provide key => value pairs for select options
                                    'data'   => "content_block",
                                          'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                    'default'   => ''
                      ),
                      array(
                                    'id'        => 'cesis_shop_rev_slider',
                                    'type'      => 'select',
                      						  'required'  => array('cesis_shop_banner','=','slider'),
                                    'title'     => __('Select the Slider revolution to use', 'cesis'),
                                    'subtitle'  => __('You need to have at least one slider created', 'cesis'),
            			                  'options' => $rev_sliders,
                                    'default'   => ''
                      ),
                      array(
                                    'id'        => 'cesis_shop_layer_slider',
                                    'type'      => 'select',
                                    'required'  => array('cesis_shop_banner','=','layerslider'),
                                    'title'     => __('Select the Layerslider to use', 'cesis'),
                                    'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                    'options' => $layerslider_array,
                                    'default'   => ''
                      ),
                    )
                ) );


                Redux::setSection( $opt_name, array(
                    'title'      => __( 'Title settings', 'cesis' ),
                    'desc'       => __( 'Product Posts title settings', 'cesis' ),
                    'id'         => 'tt-shop-title',
                    'subsection' => true,
                    'fields'     => array(

                          array(
                              'id'        => 'cesis_shop_title',
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
            					    'id'       => 'cesis_shop_title_layout',
                          'required'  => array(
                               array('cesis_shop_title','=','yes'),
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
                                    'id'        => 'cesis_shop_title_alignment',
                                    'type'     => 'button_set',
            						'required'  => array(
            						array('cesis_shop_title_layout','not_contain','one'),
                             array('cesis_shop_title','=','yes'),
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
                                    'id'        => 'cesis_shop_title_width',
                                    'required'  => array(
                                         array('cesis_shop_title','=','yes'),
                                    ),
                                    'type'     => 'dimensions',
                                    'height'     => false,
            						'units'    => array('px','%'),
                                    'title'     => __('Select the Title container width ( px or % )', 'cesis'),
                                    'subtitle'  => __('Default 1170px, select 100% to have full width Title container.', 'cesis'),
                                    'default' => array(
            					        'width'   => '1170px',
                              'units' => 'px'
            					     ),


            			),
            			array(
                                    'id'        => 'cesis_shop_title_height',
                                    'required'  => array(
                                         array('cesis_shop_title','=','yes'),
                                    ),
                                    'type'     => 'dimensions',
                                    'width'     => false,
            						'units'    => array('px','%'),
                                    'title'     => __('Select the Title container height ( px or % )', 'cesis'),
                                    'subtitle'  => __('Default 100px, use percentage to adapt the size depending on the user screen.', 'cesis'),
                                    'default' => array(
            					        'height'   => '100px',
                              'units' => 'px'
            					     ),


            			),
            			array(
                                    'id'        => 'cesis_shop_title_minheight',
                                    'required'  => array(
                                         array('cesis_shop_title','=','yes'),
                                    ),
                                    'type'     => 'dimensions',
                                    'width'     => false,
            						'units'    => array('px'),
                                    'title'     => __('Select the Title minimum height ( px )', 'cesis'),
                                    'subtitle'  => __('Good to set a minimum height when using % for title height.', 'cesis'),
                                    'default' => array(
            					        'height'   => '70px',
                              'units' => 'px'
            					     ),


            			),
            			array(
                                    'id'        => 'cesis_shop_title_background',
                                    'required'  => array(
                                         array('cesis_shop_title','=','yes'),
                                    ),
                                    'type'      => 'background',
                                    'title'     => __('Title Background Color / Image', 'cesis'),
                                    'subtitle'  => __('Select the Title background color or Image.', 'cesis'),
                                    'default'  => array(
                                      'background-color' => '#ffffff',
                                    )
                        ),
            			 array(
                                    'id'        => 'cesis_shop_title_overlay',
                                    'required'  => array(
                                         array('cesis_shop_title','=','yes'),
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
                                    'id'        => 'cesis_shop_title_overlay_color',
            						'required'  => array(
            						array( 'cesis_shop_title_overlay', '=', 'yes') ,
                             array('cesis_shop_title','=','yes'),
            								),
                                    'type'      => 'color_rgba',
                                    'title'     => __('Title Overlay color', 'cesis'),
                                    'subtitle'  => __('Title Overlay color', 'cesis'),
                                    'default'   => array(
                					    'color'     => '#000000',
                 						'alpha'     => '0.15',
                            'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.15' ),
               						),
            						'options'       => array(
            					        'clickout_fires_change'     => true,
            						),
                               ),
            			array(
            	                    'id'        => 'cesis_shop_title_border',
                                  'required'  => array(
                                       array('cesis_shop_title','=','yes'),
                                  ),
                                    'type'      => 'color',
                                    'title'     => __('Title border color', 'cesis'),
                                    'subtitle'  => __('Title Border color (default: #ecf0f1).', 'cesis'),
                                    'default'   => '#ecf0f1',
                                    'validate'  => 'color',
                                ),

                  array(
                    'id'   => 'cesis_shop_title_info',
                    'required'  => array(
                         array('cesis_shop_title','=','yes'),
                    ),
                    'type' => 'info',
                    'style' => 'success',
                    'title' => __('TITLE SETTINGS.', 'cesis'),
                    'desc' => __('Title text settings ).', 'cesis')
                  ),

                  array(
                                    'id'        => 'cesis_shop_title_display',
                                    'required'  => array(
                                         array('cesis_shop_title','=','yes'),
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
            						'id'          => 'cesis_shop_title_font',
            					    'type'        => 'typography',
            						'required'  => array( 'cesis_shop_title_display', '=', 'yes'),
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
            					        'font-weight'  => '500',
            					        'line-height'  => '32px',
            					        'font-family' => 'Roboto',
            					        'google'      => true,
            					        'font-size'   => '28px',
            							'letter-spacing' => '0',
            							'text-transform' => 'none',
            					    ),
            					),

            array(
            'id'   => 'cesis_shop_breadcrumbs_info',
            'required'  => array(
                 array('cesis_shop_title','=','yes'),
            ),
            'type' => 'info',
            'style' => 'success',
            'title' => __('BREADCRUMBS SETTINGS.', 'cesis'),
            'desc' => __('Title text settings ).', 'cesis')
            ),


                     	 array(
                                    'id'        => 'cesis_shop_breadcrumbs_display',
                                    'required'  => array(
                                         array('cesis_shop_title','=','yes'),
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
                                    'id'        => 'cesis_shop_breadcrumbs_display_home',
                                    'type'     => 'button_set',
            						'required'  => array( 'cesis_shop_breadcrumbs_display', '=', 'yes') ,
                                    'title'     => __('Display the "Home" link on breadcrumb?', 'cesis'),
                                    'subtitle'  => __('Select if you want show or hide the Home link.', 'cesis'),
                                    'options' => array(
            					        'yes' =>  __('Yes', 'cesis'),
            					        'no' =>  __('No', 'cesis'),
            					     ),
            					    'default' => 'yes'


            			),
            		  	array(
            				    'id'       => 'cesis_shop_breadcrumbs_front',
            					'required'  => array( 'cesis_shop_breadcrumbs_display', '=', 'yes') ,
            				    'type'     => 'text',
            				    'title'    => __('Breadcrumb front Text', 'cesis'),
            				    'subtitle' => __('Text to show before the breadcrumbs, ex: You are here', 'cesis'),
            				    'desc'     => __('Keep empty to hide the front text.', 'cesis'),
            				    'validate' => 'html',
            				    'default'  => ' '
            			),
            		  	array(
            				    'id'       => 'cesis_shop_breadcrumbs_sep',
            					'required'  => array( 'cesis_shop_breadcrumbs_display', '=', 'yes') ,
            				    'type'     => 'text',
            				    'title'    => __('Breadcrumbs Separator.', 'cesis'),
            				    'subtitle' => __('Link Separator, ex: / ', 'cesis'),
            				    'desc'     => __('Will separate the links.', 'cesis'),
            				    'validate' => 'html',
            				    'default'  => '/'
            			),

            			array(
            						'id'          => 'cesis_shop_breadcrumbs_font',
            						'required'  => array( 'cesis_shop_breadcrumbs_display', '=', 'yes') ,
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
            					        'font-family' => 'Roboto',
            					        'google'      => true,
            					        'font-size'   => '13px',
            					        'line-height'  => '30px',
            							'letter-spacing' => '0',
            							'text-transform' => 'none',
            					    ),
            					),
            			array(
                                    'id'        => 'cesis_shop_current_breadcrumbs_color',
            						'required'  => array( 'cesis_shop_breadcrumbs_display', '=', 'yes') ,
                                    'type'      => 'color',
                                    'title'     => __('Breadcrumb hover color', 'cesis'),
                                    'subtitle'  => __('Breadcrumbs hover color.', 'cesis'),
                                    'default'   => '#ecf0f1',
                                    'validate'  => 'color',
                               ),
            			array(
                                    'id'        => 'cesis_shop_breadcrumbs_bg_color',
            						'required'  => array( 'cesis_shop_breadcrumbs_display', '=', 'yes') ,
                                    'type'      => 'color_rgba',
                                    'title'     => __('Breadcrumb background color', 'cesis'),
                                    'subtitle'  => __('Breadcrumb background color ( only used in title layout 3 ).', 'cesis'),
                                    'default'   => array(
                					    'color'     => '#000000',
                 						'alpha'     => 0.05,
                            'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.05' ),
               						),
            						'options'       => array(
            					        'clickout_fires_change'     => true,
            						),
                               ),


            			array(
                                    'id'        => 'cesis_shop_breadcrumbs_word_char',
            						'required'  => array( 'cesis_shop_breadcrumbs_display', '=', 'yes') ,
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
            				    'id'       => 'cesis_shop_breadcrumbs_word_char_count',
            					'required'  => array( 'cesis_shop_breadcrumbs_display', '=', 'yes') ,
            				    'type'     => 'text',
            				    'title'    => __('Breadcrumb Title max word/Character count', 'cesis'),
            				    'subtitle' => __('Example : 4', 'cesis'),
            				    'validate' => 'numeric',
            				    'default'  => '4'
            			),

            		  	array(
            				    'id'       => 'cesis_shop_breadcrumbs_word_char_end',
            					'required'  => array( 'cesis_shop_breadcrumbs_display', '=', 'yes') ,
            				    'type'     => 'text',
            				    'title'    => __('Ending Character to show after cut title', 'cesis'),
            				    'subtitle' => __('Example : ...', 'cesis'),
            				    'validate' => 'html',
            				    'default'  => ''
            			),

                    )
                ) );

                Redux::setSection( $opt_name, array(
                    'title'      => __( 'Layout settings', 'cesis' ),
                    'desc'       => __( 'All the settings for Single shop post page, For full documentation on this field, visit: ', 'cesis' ) . '<a href="https://cesis.co/wp-content/uploads/documentation/cesis_documentation.html" target="_blank">Cesis Header Top Bar Documentation</a>',
                    'id'         => 'tt-shop-layout',
                    'subsection' => true,
                    'fields'     => array(

                  array(
                             'id'        => 'cesis_shop_content_width',
                               'type'     => 'dimensions',
                               'height'     => false,
                       'units'    => array('px','%'),
                               'title'     => __('Select the Single Product posts main content container width ( px or % )', 'cesis'),
                               'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                               'default' => array(
                              'width'   => '1170px',
                              'units' => 'px'
                           ),
                  ),
                  array(
                                    'id'        => 'cesis_shop_content_top_padding',
                                    'type'     => 'dimensions',
                                    'width'     => false,
                        'units'    => array('px'),
                                    'title'     => __('Select the WooCommerce related pages / posts main content top space ( top padding px )', 'cesis'),
                                    'default' => array(
                              'height'   => '60px',
                              'units' => 'px'
                           ),


                  ),
                  array(
                                    'id'        => 'cesis_shop_content_bottom_padding',
                                    'type'     => 'dimensions',
                                    'width'     => false,
                        'units'    => array('px'),
                                    'title'     => __('Select the WooCommerce related pages / posts main content bottom space ( bottom padding px )', 'cesis'),
                                    'default' => array(
                              'height'   => '60px',
                              'units' => 'px'
                           ),


                  ),
                  array(
                          'id'       => 'cesis_shop_sp_layout',
                          'type'     => 'image_select',
                          'title'    => __('Select the Single Product Posts layout', 'cesis'),
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
                        'id' => 'cesis_shop_sp_sidebar_select',
                        'title' => __('Sidebar', 'cesis'),
                        'desc' => 'Please select the sidebar to use.',
                        'type' => 'select',
                        'data' => 'sidebars',
                        'required'  => array(
                              array('cesis_shop_sp_layout','not','no_sidebar'),
                        ),
                        'default' => 'None'
                      ),
                  array(
                                    'id'        => 'cesis_shop_sp_share',
                                    'type'     => 'button_set',
                                    'title'     => __('Display the Share icons?', 'cesis'),
                                    'subtitle'  => __('Select if you want to show the share icons.', 'cesis'),

                                    'options' => array(
                              'yes' =>  __('Yes', 'cesis'),
                              'no' =>  __('No', 'cesis'),
                           ),
                          'default' => 'yes'


                    ),


                               array(
                                                 'id'        => 'cesis_shop_sp_navigation',
                                                 'type'     => 'button_set',
                                                 'title'     => __('Display the Previous / Next Navigation?', 'cesis'),
                                                 'subtitle'  => __('Select if you want to show Previous and Next navigation button.', 'cesis'),

                                                 'options' => array(
                                           'yes' =>  __('Yes', 'cesis'),
                                           'no' =>  __('No', 'cesis'),
                                        ),
                                       'default' => 'yes'


                                 ),

                                 array(
                                                'id'        => 'cesis_shop_sp_navigation_style',
                                                'type'      => 'select',
                                                'title'     => __('Select the navigation style', 'cesis'),
                                                'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                                                'required'  => array('cesis_shop_sp_navigation','=','yes'),
                                                //Must provide key => value pairs for select options
                                                'options'   => array(
                                                    'business' => __('Classic', 'cesis'),
                                                    'writer' => __('Casual', 'cesis'),
                                                    'agency' => __('Agency', 'cesis'),
                                                    'careers' => __('Career', 'cesis'),
                                                ),
                                                'default'   => 'business'
                                  ),




                  )
                ) );


                        Redux::setSection( $opt_name, array(
                            'title'      => __( 'Pre-Footer settings', 'cesis' ),
                            'desc'       => __( 'Post pre-footer settings', 'cesis' ),
                            'id'         => 'tt-shop-prefooter',
                            'subsection' => true,
                            'fields'     => array(
                                array(
                                            'id'        => 'cesis_shop_prefooter',
                                            'type'      => 'button_set',
                                            'title'     => __('Banner type', 'cesis'),
                                            'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                                            'options' => array(
                                      'none' => __('No Banner', 'cesis'),
                                      'content' => __('Content Block', 'cesis'),
                                      'slider' => __('Slider Revolution', 'cesis'),
                                      'layerslider' => __('LayerSlider', 'cesis'),
                                   ),
                                  'default' => 'none'
                              ),
                              array(
                                            'id'        => 'cesis_shop_pf_block_content',
                                            'type'      => 'select',
                                            'required'  => array('cesis_shop_prefooter','=','content'),
                                            'title'     => __('Select the Block content to use', 'cesis'),
                                            'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                            //Must provide key => value pairs for select options
                                            'data'   => "content_block",
                                                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                            'default'   => ''
                              ),
                              array(
                                            'id'        => 'cesis_shop_pf_rev_slider',
                                            'type'      => 'select',
                              						  'required'  => array('cesis_shop_prefooter','=','slider'),
                                            'title'     => __('Select the Slider revolution to use', 'cesis'),
                                            'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                    			                  'options' => $rev_sliders,
                                            'default'   => ''
                              ),
                              array(
                                            'id'        => 'cesis_shop_pf_layer_slider',
                                            'type'      => 'select',
                                            'required'  => array('cesis_shop_prefooter','=','layerslider'),
                                            'title'     => __('Select the Layerslider to use', 'cesis'),
                                            'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                            'options' => $layerslider_array,
                                            'default'   => ''
                              ),
                            )
                        ) );


                        Redux::setSection( $opt_name, array(
                            'title'      => __( 'Footer settings', 'cesis' ),
                            'desc'       => __( 'Product Posts footer settings', 'cesis' ),
                            'id'         => 'tt-shop-footer',
                            'subsection' => true,
                            'fields'     => array(
                              array(
                                            'id'        => 'cesis_shop_footer_fixed',
                                            'type'      => 'button_set',
                                            'title'     => __('Use fixed footer?', 'cesis'),
                                            'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                                            'options' => array(
                    					        'cesis_fixed_footer' =>  __('Yes', 'cesis'),
                    					        'no' =>  __('No', 'cesis'),
                                   ),
                                  'default' => 'no'
                              ),
                                array(
                                            'id'        => 'cesis_shop_footer',
                                            'type'      => 'button_set',
                                            'title'     => __('Display the Footer main area?', 'cesis'),
                                            'subtitle'  => __('If you want to show the Footer top part ( widget space ) select yes.', 'cesis'),
                                            'options' => array(
                                      'yes' =>  __('Yes', 'cesis'),
                                      'no' =>  __('No', 'cesis'),
                                   ),
                                  'default' => 'yes'
                              ),
                              array(
                                          'id'        => 'cesis_shop_footer_bar',
                                          'type'      => 'button_set',
                                          'title'     => __('Display the Footer under bar?', 'cesis'),
                                          'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                                          'options' => array(
                                    'yes' =>  __('Yes', 'cesis'),
                                    'no' =>  __('No', 'cesis'),
                                 ),
                                'default' => 'yes'
                            ),
                            )
                        ) );





                    Redux::setSection( $opt_name, array(
                          'title'  => __( 'Buddypress Settings', 'cesis' ),
                          'id'     => 'tt-buddypress',
                          'desc'   => __( 'General Buddypress settings. For more detailed options check the sub sections.', 'cesis' ),
                          'icon'   => 'fa-buddies ',
                          'fields' => array(
                              array(
                                        'id'        => 'cesis_buddypress_bg_style',
                                        'type'      => 'button_set',
                                        'title'     => __('Use alternate background color for buddypress pages?', 'cesis'),
                                        'subtitle'  => __('Select which background color to use for buddypress pages ( color set from Main content settings tab ).', 'cesis'),
                                        'options' => array(
                                  'yes' =>  __('Yes', 'cesis'),
                                  'no' =>  __('No', 'cesis'),
                               ),
                              'default' => 'yes'
                          ),


                          )
                      ) );

                      Redux::setSection( $opt_name, array(
                          'title'      => __( 'Header settings', 'cesis' ),
                          'desc'       => __( 'buddypress header settings', 'cesis' ),
                          'id'         => 'tt-buddypress-header',
                          'subsection' => true,
                          'fields'     => array(
                              array(
                                          'id'        => 'cesis_buddypress_topbar',
                                          'type'      => 'button_set',
                                          'title'     => __('Display the Header Top Bar?', 'cesis'),
                                          'subtitle'  => __('Select if you want to show the header top bar.', 'cesis'),
                                          'options' => array(
                                    'yes' =>  __('Yes', 'cesis'),
                                    'no' =>  __('No', 'cesis'),
                                 ),
                                'default' => 'no'
                            ),
                            array(
                                        'id'        => 'cesis_buddypress_header',
                                        'type'      => 'button_set',
                                        'title'     => __('Display the Header?', 'cesis'),
                                        'subtitle'  => __('Select if you want to show the header.', 'cesis'),
                                        'options' => array(
                                  'yes' =>  __('Yes', 'cesis'),
                                  'no' =>  __('No', 'cesis'),
                               ),
                              'default' => 'yes'
                          ),
                          array(
                                      'id'        => 'cesis_buddypress_header_transparent',
                                      'type'      => 'button_set',
                                      'title'     => __('Use Transparent Header?', 'cesis'),
                                      'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
                                      'options' => array(
                                'cesis_transparent_header' => __('Yes', 'cesis'),
                                'cesis_opaque_header' => __('No', 'cesis'),
                             ),
                            'default' => 'cesis_opaque_header'
                        ),
                          )
                      ) );

                      Redux::setSection( $opt_name, array(
                          'title'      => __( 'Banner settings', 'cesis' ),
                          'desc'       => __( 'buddypress banner settings', 'cesis' ),
                          'id'         => 'tt-buddypress-banner',
                          'subsection' => true,
                          'fields'     => array(
                              array(
                                          'id'        => 'cesis_buddypress_banner',
                                          'type'      => 'button_set',
                                          'title'     => __('Banner type', 'cesis'),
                                          'subtitle'  => __('Select the banner area type.', 'cesis'),
                                          'options' => array(
                                    'none' => __('No Banner', 'cesis'),
                                    'content' => __('Content Block', 'cesis'),
                                    'slider' => __('Slider Revolution', 'cesis'),
                                    'layerslider' => __('LayerSlider', 'cesis'),
                                 ),
                                'default' => 'none'
                            ),
                            array(
                                        'id'        => 'cesis_buddypress_banner_pos',
                                        'type'      => 'button_set',
                                        'required'  => array('cesis_buddypress_banner','!=','none'),
                                        'title'     => __('Banner position', 'cesis'),
                                        'subtitle'  => __('Select the banner position.', 'cesis'),
                                        'options' => array(
                                  'under' => __('Under Header', 'cesis'),
                                  'above' => __('Above Header', 'cesis'),
                               ),
                              'default' => 'under'
                            ),
                            array(
                                          'id'        => 'cesis_buddypress_block_content',
                                          'type'      => 'select',
                                          'required'  => array('cesis_buddypress_banner','=','content'),
                                          'title'     => __('Select the Block content to use', 'cesis'),
                                          'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                          //Must provide key => value pairs for select options
                                          'data'   => "content_block",
                                                'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                          'default'   => ''
                            ),
                            array(
                                          'id'        => 'cesis_buddypress_rev_slider',
                                          'type'      => 'select',
                            						  'required'  => array('cesis_buddypress_banner','=','slider'),
                                          'title'     => __('Select the Slider revolution to use', 'cesis'),
                                          'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                  			                  'options' => $rev_sliders,
                                          'default'   => ''
                            ),
                            array(
                                          'id'        => 'cesis_buddypress_layer_slider',
                                          'type'      => 'select',
                                          'required'  => array('cesis_buddypress_banner','=','layerslider'),
                                          'title'     => __('Select the Layerslider to use', 'cesis'),
                                          'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                          'options' => $layerslider_array,
                                          'default'   => ''
                            ),
                          )
                      ) );


                      Redux::setSection( $opt_name, array(
                          'title'      => __( 'Title settings', 'cesis' ),
                          'desc'       => __( 'buddypress title settings', 'cesis' ),
                          'id'         => 'tt-buddypress-title',
                          'subsection' => true,
                          'fields'     => array(

                                array(
                                    'id'        => 'cesis_buddypress_title',
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
                  					    'id'       => 'cesis_buddypress_title_layout',
                                'required'  => array(
                                     array('cesis_buddypress_title','=','yes'),
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
                                          'id'        => 'cesis_buddypress_title_alignment',
                                          'type'     => 'button_set',
                  						'required'  => array(
                  						array('cesis_buddypress_title_layout','not_contain','one'),
                                   array('cesis_buddypress_title','=','yes'),
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
                                          'id'        => 'cesis_buddypress_title_width',
                                          'required'  => array(
                                               array('cesis_buddypress_title','=','yes'),
                                          ),
                                          'type'     => 'dimensions',
                                          'height'     => false,
                  						'units'    => array('px','%'),
                                          'title'     => __('Select the Title container width ( px or % )', 'cesis'),
                                          'subtitle'  => __('Default 1170px, select 100% to have full width Title container.', 'cesis'),
                                          'default' => array(
                  					        'width'   => '1170px',
                                    'units' => 'px'
                  					     ),


                  			),
                  			array(
                                          'id'        => 'cesis_buddypress_title_height',
                                          'required'  => array(
                                               array('cesis_buddypress_title','=','yes'),
                                          ),
                                          'type'     => 'dimensions',
                                          'width'     => false,
                  						'units'    => array('px','%'),
                                          'title'     => __('Select the Title container height ( px or % )', 'cesis'),
                                          'subtitle'  => __('Default 100px, use percentage to adapt the size depending on the user screen.', 'cesis'),
                                          'default' => array(
                  					        'height'   => '100px',
                                    'units' => 'px'
                  					     ),


                  			),
                  			array(
                                          'id'        => 'cesis_buddypress_title_minheight',
                                          'required'  => array(
                                               array('cesis_buddypress_title','=','yes'),
                                          ),
                                          'type'     => 'dimensions',
                                          'width'     => false,
                  						'units'    => array('px'),
                                          'title'     => __('Select the Title minimum height ( px )', 'cesis'),
                                          'subtitle'  => __('Good to set a minimum height when using % for title height.', 'cesis'),
                                          'default' => array(
                  					        'height'   => '70px',
                                    'units' => 'px'
                  					     ),


                  			),
                  			array(
                                          'id'        => 'cesis_buddypress_title_background',
                                          'required'  => array(
                                               array('cesis_buddypress_title','=','yes'),
                                          ),
                                          'type'      => 'background',
                                          'title'     => __('Title Background Color / Image', 'cesis'),
                                          'subtitle'  => __('Select the Title background color or Image.', 'cesis'),
                                          'default'  => array(
                                            'background-color' => '#ffffff',
                                          )
                              ),
                  			 array(
                                          'id'        => 'cesis_buddypress_title_overlay',
                                          'required'  => array(
                                               array('cesis_buddypress_title','=','yes'),
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
                                          'id'        => 'cesis_buddypress_title_overlay_color',
                  						'required'  => array(
                  						array( 'cesis_buddypress_title_overlay', '=', 'yes') ,
                                   array('cesis_buddypress_title','=','yes'),
                  								),
                                          'type'      => 'color_rgba',
                                          'title'     => __('Title Overlay color', 'cesis'),
                                          'subtitle'  => __('Title Overlay color', 'cesis'),
                                          'default'   => array(
                      					    'color'     => '#000000',
                       						'alpha'     => '0.15',
                                  'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.15' ),
                     						),
                  						'options'       => array(
                  					        'clickout_fires_change'     => true,
                  						),
                                     ),
                  			array(
                  	                    'id'        => 'cesis_buddypress_title_border',
                                        'required'  => array(
                                             array('cesis_buddypress_title','=','yes'),
                                        ),
                                          'type'      => 'color',
                                          'title'     => __('Title border color', 'cesis'),
                                          'subtitle'  => __('Title Border color (default: #ecf0f1).', 'cesis'),
                                          'default'   => '#ecf0f1',
                                          'validate'  => 'color',
                                      ),

                        array(
                          'id'   => 'cesis_buddypress_title_info',
                          'required'  => array(
                               array('cesis_buddypress_title','=','yes'),
                          ),
                          'type' => 'info',
                          'style' => 'success',
                          'title' => __('TITLE SETTINGS.', 'cesis'),
                          'desc' => __('Title text settings ).', 'cesis')
                        ),

                        array(
                                          'id'        => 'cesis_buddypress_title_display',
                                          'required'  => array(
                                               array('cesis_buddypress_title','=','yes'),
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
                  						'id'          => 'cesis_buddypress_title_font',
                  					    'type'        => 'typography',
                  						'required'  => array( 'cesis_buddypress_title_display', '=', 'yes'),
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
                  					        'font-weight'  => '500',
                  					        'line-height'  => '32px',
                  					        'font-family' => 'Roboto',
                  					        'google'      => true,
                  					        'font-size'   => '28px',
                  							'letter-spacing' => '0',
                  							'text-transform' => 'none',
                  					    ),
                  					),

                  array(
                  'id'   => 'cesis_buddypress_breadcrumbs_info',
                  'required'  => array(
                       array('cesis_buddypress_title','=','yes'),
                  ),
                  'type' => 'info',
                  'style' => 'success',
                  'title' => __('BREADCRUMBS SETTINGS.', 'cesis'),
                  'desc' => __('Title text settings ).', 'cesis')
                  ),


                           	 array(
                                          'id'        => 'cesis_buddypress_breadcrumbs_display',
                                          'required'  => array(
                                               array('cesis_buddypress_title','=','yes'),
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
                                          'id'        => 'cesis_buddypress_breadcrumbs_display_home',
                                          'type'     => 'button_set',
                  						'required'  => array( 'cesis_buddypress_breadcrumbs_display', '=', 'yes') ,
                                          'title'     => __('Display the "Home" link on breadcrumb?', 'cesis'),
                                          'subtitle'  => __('Select if you want show or hide the Home link.', 'cesis'),
                                          'options' => array(
                  					        'yes' =>  __('Yes', 'cesis'),
                  					        'no' =>  __('No', 'cesis'),
                  					     ),
                  					    'default' => 'yes'


                  			),
                  		  	array(
                  				    'id'       => 'cesis_buddypress_breadcrumbs_front',
                  					'required'  => array( 'cesis_buddypress_breadcrumbs_display', '=', 'yes') ,
                  				    'type'     => 'text',
                  				    'title'    => __('Breadcrumb front Text', 'cesis'),
                  				    'subtitle' => __('Text to show before the breadcrumbs, ex: You are here', 'cesis'),
                  				    'desc'     => __('Keep empty to hide the front text.', 'cesis'),
                  				    'validate' => 'html',
                  				    'default'  => ' '
                  			),
                  		  	array(
                  				    'id'       => 'cesis_buddypress_breadcrumbs_sep',
                  					'required'  => array( 'cesis_buddypress_breadcrumbs_display', '=', 'yes') ,
                  				    'type'     => 'text',
                  				    'title'    => __('Breadcrumbs Separator.', 'cesis'),
                  				    'subtitle' => __('Link Separator, ex: / ', 'cesis'),
                  				    'desc'     => __('Will separate the links.', 'cesis'),
                  				    'validate' => 'html',
                  				    'default'  => '/'
                  			),

                  			array(
                  						'id'          => 'cesis_buddypress_breadcrumbs_font',
                  						'required'  => array( 'cesis_buddypress_breadcrumbs_display', '=', 'yes') ,
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
                  					        'font-family' => 'Roboto',
                  					        'google'      => true,
                  					        'font-size'   => '13px',
                  					        'line-height'  => '30px',
                  							'letter-spacing' => '0',
                  							'text-transform' => 'none',
                  					    ),
                  					),
                  			array(
                                          'id'        => 'cesis_buddypress_current_breadcrumbs_color',
                  						'required'  => array( 'cesis_buddypress_breadcrumbs_display', '=', 'yes') ,
                                          'type'      => 'color',
                                          'title'     => __('Breadcrumb hover color', 'cesis'),
                                          'subtitle'  => __('Breadcrumbs hover color.', 'cesis'),
                                          'default'   => '#ecf0f1',
                                          'validate'  => 'color',
                                     ),
                  			array(
                                          'id'        => 'cesis_buddypress_breadcrumbs_bg_color',
                  						'required'  => array( 'cesis_buddypress_breadcrumbs_display', '=', 'yes') ,
                                          'type'      => 'color_rgba',
                                          'title'     => __('Breadcrumb background color', 'cesis'),
                                          'subtitle'  => __('Breadcrumb background color ( only used in title layout 3 ).', 'cesis'),
                                          'default'   => array(
                      					    'color'     => '#000000',
                       						'alpha'     => 0.05,
                                  'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.05' ),
                     						),
                  						'options'       => array(
                  					        'clickout_fires_change'     => true,
                  						),
                                     ),


                  			array(
                                          'id'        => 'cesis_buddypress_breadcrumbs_word_char',
                  						'required'  => array( 'cesis_buddypress_breadcrumbs_display', '=', 'yes') ,
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
                  				    'id'       => 'cesis_buddypress_breadcrumbs_word_char_count',
                  					'required'  => array( 'cesis_buddypress_breadcrumbs_display', '=', 'yes') ,
                  				    'type'     => 'text',
                  				    'title'    => __('Breadcrumb Title max word/Character count', 'cesis'),
                  				    'subtitle' => __('Example : 4', 'cesis'),
                  				    'validate' => 'numeric',
                  				    'default'  => '4'
                  			),

                  		  	array(
                  				    'id'       => 'cesis_buddypress_breadcrumbs_word_char_end',
                  					'required'  => array( 'cesis_buddypress_breadcrumbs_display', '=', 'yes') ,
                  				    'type'     => 'text',
                  				    'title'    => __('Ending Character to show after cut title', 'cesis'),
                  				    'subtitle' => __('Example : ...', 'cesis'),
                  				    'validate' => 'html',
                  				    'default'  => ''
                  			),

                          )
                      ) );

                      Redux::setSection( $opt_name, array(
                          'title'      => __( 'Layout settings', 'cesis' ),
                          'desc'       => __( 'All the settings for Buddypress pages', 'cesis' ),
                          'id'         => 'tt-buddypress-layout',
                          'subsection' => true,
                          'fields'     => array(


                        array(
                                   'id'        => 'cesis_buddypress_content_width',
                                     'type'     => 'dimensions',
                                     'height'     => false,
                             'units'    => array('px','%'),
                                     'title'     => __('Select the buddypress pages main content container width ( px or % )', 'cesis'),
                                     'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                                     'default' => array(
                                    'width'   => '1170px',
                                    'units' => 'px'
                                 ),
                        ),
                        array(
                                          'id'        => 'cesis_buddypress_content_top_padding',
                                          'type'     => 'dimensions',
                                          'width'     => false,
                              'units'    => array('px'),
                                          'title'     => __('Select the buddypress related pages main content top space ( top padding px )', 'cesis'),
                                          'default' => array(
                                    'height'   => '60px',
                                    'units' => 'px'
                                 ),


                        ),
                        array(
                                          'id'        => 'cesis_buddypress_content_bottom_padding',
                                          'type'     => 'dimensions',
                                          'width'     => false,
                              'units'    => array('px'),
                                          'title'     => __('Select the buddypress related pages main content bottom space ( bottom padding px )', 'cesis'),
                                          'default' => array(
                                    'height'   => '60px',
                                    'units' => 'px'
                                 ),


                        ),
                        array(
                                'id'       => 'cesis_buddypress_layout',
                                'type'     => 'image_select',
                                'title'    => __('Select the buddypress page layout', 'cesis'),
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
                      ) );


                              Redux::setSection( $opt_name, array(
                                  'title'      => __( 'Pre-Footer settings', 'cesis' ),
                                  'desc'       => __( 'Post pre-footer settings', 'cesis' ),
                                  'id'         => 'tt-buddypress-prefooter',
                                  'subsection' => true,
                                  'fields'     => array(
                                      array(
                                                  'id'        => 'cesis_buddypress_prefooter',
                                                  'type'      => 'button_set',
                                                  'title'     => __('Banner type', 'cesis'),
                                                  'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                                                  'options' => array(
                                            'none' => __('No Banner', 'cesis'),
                                            'content' => __('Content Block', 'cesis'),
                                            'slider' => __('Slider Revolution', 'cesis'),
                                            'layerslider' => __('LayerSlider', 'cesis'),
                                         ),
                                        'default' => 'none'
                                    ),
                                    array(
                                                  'id'        => 'cesis_buddypress_pf_block_content',
                                                  'type'      => 'select',
                                                  'required'  => array('cesis_buddypress_prefooter','=','content'),
                                                  'title'     => __('Select the Block content to use', 'cesis'),
                                                  'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                                  //Must provide key => value pairs for select options
                                                  'data'   => "content_block",
                                                        'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                                  'default'   => ''
                                    ),
                                    array(
                                                  'id'        => 'cesis_buddypress_pf_rev_slider',
                                                  'type'      => 'select',
                                    						  'required'  => array('cesis_buddypress_prefooter','=','slider'),
                                                  'title'     => __('Select the Slider revolution to use', 'cesis'),
                                                  'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                          			                  'options' => $rev_sliders,
                                                  'default'   => ''
                                    ),
                                    array(
                                                  'id'        => 'cesis_buddypress_pf_layer_slider',
                                                  'type'      => 'select',
                                    						  'required'  => array('cesis_buddypress_prefooter','=','layerslider'),
                                                  'title'     => __('Select the Layerslider to use', 'cesis'),
                                                  'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                          			                  'options' => $layerslider_array,
                                                  'default'   => ''
                                    ),
                                  )
                              ) );


                              Redux::setSection( $opt_name, array(
                                  'title'      => __( 'Footer settings', 'cesis' ),
                                  'desc'       => __( 'Product Posts footer settings', 'cesis' ),
                                  'id'         => 'tt-buddypress-footer',
                                  'subsection' => true,
                                  'fields'     => array(
                                    array(
                                                  'id'        => 'cesis_buddypress_footer_fixed',
                                                  'type'      => 'button_set',
                                                  'title'     => __('Use fixed footer?', 'cesis'),
                                                  'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                                                  'options' => array(
                          					        'cesis_fixed_footer' =>  __('Yes', 'cesis'),
                          					        'no' =>  __('No', 'cesis'),
                                         ),
                                        'default' => 'no'
                                    ),
                                      array(
                                                  'id'        => 'cesis_buddypress_footer',
                                                  'type'      => 'button_set',
                                                  'title'     => __('Display the Footer main area?', 'cesis'),
                                                  'subtitle'  => __('If you want to show the Footer top part ( widget space ) select yes.', 'cesis'),
                                                  'options' => array(
                                            'yes' =>  __('Yes', 'cesis'),
                                            'no' =>  __('No', 'cesis'),
                                         ),
                                        'default' => 'yes'
                                    ),
                                    array(
                                                'id'        => 'cesis_buddypress_footer_bar',
                                                'type'      => 'button_set',
                                                'title'     => __('Display the Footer under bar?', 'cesis'),
                                                'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                                                'options' => array(
                                          'yes' =>  __('Yes', 'cesis'),
                                          'no' =>  __('No', 'cesis'),
                                       ),
                                      'default' => 'yes'
                                  ),
                                  )
                              ) );


                          Redux::setSection( $opt_name, array(
                                'title'  => __( 'bbpress Settings', 'cesis' ),
                                'id'     => 'tt-bbpress',
                                'desc'   => __( 'General bbpress settings. For more detailed options check the sub sections.', 'cesis' ),
                                'icon'   => 'fa-bbpress ',
                                'fields' => array(
                                    array(
                                              'id'        => 'cesis_bbpress_bg_style',
                                              'type'      => 'button_set',
                                              'title'     => __('Use alternate background color for bbpress pages?', 'cesis'),
                                              'subtitle'  => __('Select which background color to use for buddypress pages ( color set from Main content settings tab ).', 'cesis'),
                                              'options' => array(
                                        'yes' =>  __('Yes', 'cesis'),
                                        'no' =>  __('No', 'cesis'),
                                     ),
                                    'default' => 'no'
                                ),


                                )
                            ) );

                            Redux::setSection( $opt_name, array(
                                'title'      => __( 'Header settings', 'cesis' ),
                                'desc'       => __( 'bbpress header settings', 'cesis' ),
                                'id'         => 'tt-bbpress-header',
                                'subsection' => true,
                                'fields'     => array(
                                    array(
                                                'id'        => 'cesis_bbpress_topbar',
                                                'type'      => 'button_set',
                                                'title'     => __('Display the Header Top Bar?', 'cesis'),
                                                'subtitle'  => __('Select if you want to show the header top bar.', 'cesis'),
                                                'options' => array(
                                          'yes' =>  __('Yes', 'cesis'),
                                          'no' =>  __('No', 'cesis'),
                                       ),
                                      'default' => 'no'
                                  ),
                                  array(
                                              'id'        => 'cesis_bbpress_header',
                                              'type'      => 'button_set',
                                              'title'     => __('Display the Header?', 'cesis'),
                                              'subtitle'  => __('Select if you want to show the header.', 'cesis'),
                                              'options' => array(
                                        'yes' =>  __('Yes', 'cesis'),
                                        'no' =>  __('No', 'cesis'),
                                     ),
                                    'default' => 'yes'
                                ),
                                array(
                                            'id'        => 'cesis_bbpress_header_transparent',
                                            'type'      => 'button_set',
                                            'title'     => __('Use Transparent Header?', 'cesis'),
                                            'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
                                            'options' => array(
                                      'cesis_transparent_header' => __('Yes', 'cesis'),
                                      'cesis_opaque_header' => __('No', 'cesis'),
                                   ),
                                  'default' => 'cesis_opaque_header'
                              ),
                                )
                            ) );

                            Redux::setSection( $opt_name, array(
                                'title'      => __( 'Banner settings', 'cesis' ),
                                'desc'       => __( 'bbpress banner settings', 'cesis' ),
                                'id'         => 'tt-bbpress-banner',
                                'subsection' => true,
                                'fields'     => array(
                                    array(
                                                'id'        => 'cesis_bbpress_banner',
                                                'type'      => 'button_set',
                                                'title'     => __('Banner type', 'cesis'),
                                                'subtitle'  => __('Select the banner area type.', 'cesis'),
                                                'options' => array(
                                          'none' => __('No Banner', 'cesis'),
                                          'content' => __('Content Block', 'cesis'),
                                          'slider' => __('Slider Revolution', 'cesis'),
                                          'layerslider' => __('LayerSlider', 'cesis'),
                                       ),
                                      'default' => 'none'
                                  ),
                                  array(
                                              'id'        => 'cesis_bbpress_banner_pos',
                                              'type'      => 'button_set',
                                              'required'  => array('cesis_bbpress_banner','!=','none'),
                                              'title'     => __('Banner position', 'cesis'),
                                              'subtitle'  => __('Select the banner position.', 'cesis'),
                                              'options' => array(
                                        'under' => __('Under Header', 'cesis'),
                                        'above' => __('Above Header', 'cesis'),
                                     ),
                                    'default' => 'under'
                                  ),
                                  array(
                                                'id'        => 'cesis_bbpress_block_content',
                                                'type'      => 'select',
                                                'required'  => array('cesis_bbpress_banner','=','content'),
                                                'title'     => __('Select the Block content to use', 'cesis'),
                                                'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                                //Must provide key => value pairs for select options
                                                'data'   => "content_block",
                                                      'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                                'default'   => ''
                                  ),
                                  array(
                                                'id'        => 'cesis_bbpress_rev_slider',
                                                'type'      => 'select',
                                  						  'required'  => array('cesis_bbpress_banner','=','slider'),
                                                'title'     => __('Select the Slider revolution to use', 'cesis'),
                                                'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                        			                  'options' => $rev_sliders,
                                                'default'   => ''
                                  ),
                                  array(
                                                'id'        => 'cesis_bbpress_layer_slider',
                                                'type'      => 'select',
                                                'required'  => array('cesis_bbpress_banner','=','layerslider'),
                                                'title'     => __('Select the Layerslider to use', 'cesis'),
                                                'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                                'options' => $layerslider_array,
                                                'default'   => ''
                                  ),
                                )
                            ) );


                            Redux::setSection( $opt_name, array(
                                'title'      => __( 'Title settings', 'cesis' ),
                                'desc'       => __( 'bbpress title settings', 'cesis' ),
                                'id'         => 'tt-bbpress-title',
                                'subsection' => true,
                                'fields'     => array(

                                      array(
                                          'id'        => 'cesis_bbpress_title',
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
                        					    'id'       => 'cesis_bbpress_title_layout',
                                      'required'  => array(
                                           array('cesis_bbpress_title','=','yes'),
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
                                                'id'        => 'cesis_bbpress_title_alignment',
                                                'type'     => 'button_set',
                        						'required'  => array(
                        						array('cesis_bbpress_title_layout','not_contain','one'),
                                         array('cesis_bbpress_title','=','yes'),
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
                                                'id'        => 'cesis_bbpress_title_width',
                                                'required'  => array(
                                                     array('cesis_bbpress_title','=','yes'),
                                                ),
                                                'type'     => 'dimensions',
                                                'height'     => false,
                        						'units'    => array('px','%'),
                                                'title'     => __('Select the Title container width ( px or % )', 'cesis'),
                                                'subtitle'  => __('Default 1170px, select 100% to have full width Title container.', 'cesis'),
                                                'default' => array(
                        					        'width'   => '1170px',
                                          'units' => 'px'
                        					     ),


                        			),
                        			array(
                                                'id'        => 'cesis_bbpress_title_height',
                                                'required'  => array(
                                                     array('cesis_bbpress_title','=','yes'),
                                                ),
                                                'type'     => 'dimensions',
                                                'width'     => false,
                        						'units'    => array('px','%'),
                                                'title'     => __('Select the Title container height ( px or % )', 'cesis'),
                                                'subtitle'  => __('Default 100px, use percentage to adapt the size depending on the user screen.', 'cesis'),
                                                'default' => array(
                        					        'height'   => '100px',
                                          'units' => 'px'
                        					     ),


                        			),
                        			array(
                                                'id'        => 'cesis_bbpress_title_minheight',
                                                'required'  => array(
                                                     array('cesis_bbpress_title','=','yes'),
                                                ),
                                                'type'     => 'dimensions',
                                                'width'     => false,
                        						'units'    => array('px'),
                                                'title'     => __('Select the Title minimum height ( px )', 'cesis'),
                                                'subtitle'  => __('Good to set a minimum height when using % for title height.', 'cesis'),
                                                'default' => array(
                        					        'height'   => '70px',
                                          'units' => 'px'
                        					     ),


                        			),
                        			array(
                                                'id'        => 'cesis_bbpress_title_background',
                                                'required'  => array(
                                                     array('cesis_bbpress_title','=','yes'),
                                                ),
                                                'type'      => 'background',
                                                'title'     => __('Title Background Color / Image', 'cesis'),
                                                'subtitle'  => __('Select the Title background color or Image.', 'cesis'),
                                                'default'  => array(
                                                  'background-color' => '#ffffff',
                                                )
                                    ),
                        			 array(
                                                'id'        => 'cesis_bbpress_title_overlay',
                                                'required'  => array(
                                                     array('cesis_bbpress_title','=','yes'),
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
                                                'id'        => 'cesis_bbpress_title_overlay_color',
                        						'required'  => array(
                        						array( 'cesis_bbpress_title_overlay', '=', 'yes') ,
                                         array('cesis_bbpress_title','=','yes'),
                        								),
                                                'type'      => 'color_rgba',
                                                'title'     => __('Title Overlay color', 'cesis'),
                                                'subtitle'  => __('Title Overlay color', 'cesis'),
                                                'default'   => array(
                            					    'color'     => '#000000',
                             						'alpha'     => '0.15',
                                        'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.15' ),
                           						),
                        						'options'       => array(
                        					        'clickout_fires_change'     => true,
                        						),
                                           ),
                        			array(
                        	                    'id'        => 'cesis_bbpress_title_border',
                                              'required'  => array(
                                                   array('cesis_bbpress_title','=','yes'),
                                              ),
                                                'type'      => 'color',
                                                'title'     => __('Title border color', 'cesis'),
                                                'subtitle'  => __('Title Border color (default: #ecf0f1).', 'cesis'),
                                                'default'   => '#ecf0f1',
                                                'validate'  => 'color',
                                            ),

                              array(
                                'id'   => 'cesis_bbpress_title_info',
                                'required'  => array(
                                     array('cesis_bbpress_title','=','yes'),
                                ),
                                'type' => 'info',
                                'style' => 'success',
                                'title' => __('TITLE SETTINGS.', 'cesis'),
                                'desc' => __('Title text settings ).', 'cesis')
                              ),

                              array(
                                                'id'        => 'cesis_bbpress_title_display',
                                                'required'  => array(
                                                     array('cesis_bbpress_title','=','yes'),
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
                        						'id'          => 'cesis_bbpress_title_font',
                        					    'type'        => 'typography',
                        						'required'  => array( 'cesis_bbpress_title_display', '=', 'yes'),
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
                        					        'font-weight'  => '500',
                        					        'line-height'  => '32px',
                        					        'font-family' => 'Roboto',
                        					        'google'      => true,
                        					        'font-size'   => '28px',
                        							'letter-spacing' => '0',
                        							'text-transform' => 'none',
                        					    ),
                        					),

                        array(
                        'id'   => 'cesis_bbpress_breadcrumbs_info',
                        'required'  => array(
                             array('cesis_bbpress_title','=','yes'),
                        ),
                        'type' => 'info',
                        'style' => 'success',
                        'title' => __('BREADCRUMBS SETTINGS.', 'cesis'),
                        'desc' => __('Title text settings ).', 'cesis')
                        ),


                                 	 array(
                                                'id'        => 'cesis_bbpress_breadcrumbs_display',
                                                'required'  => array(
                                                     array('cesis_bbpress_title','=','yes'),
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
                                                'id'        => 'cesis_bbpress_breadcrumbs_display_home',
                                                'type'     => 'button_set',
                        						'required'  => array( 'cesis_bbpress_breadcrumbs_display', '=', 'yes') ,
                                                'title'     => __('Display the "Home" link on breadcrumb?', 'cesis'),
                                                'subtitle'  => __('Select if you want show or hide the Home link.', 'cesis'),
                                                'options' => array(
                        					        'yes' =>  __('Yes', 'cesis'),
                        					        'no' =>  __('No', 'cesis'),
                        					     ),
                        					    'default' => 'yes'


                        			),
                        		  	array(
                        				    'id'       => 'cesis_bbpress_breadcrumbs_front',
                        					'required'  => array( 'cesis_bbpress_breadcrumbs_display', '=', 'yes') ,
                        				    'type'     => 'text',
                        				    'title'    => __('Breadcrumb front Text', 'cesis'),
                        				    'subtitle' => __('Text to show before the breadcrumbs, ex: You are here', 'cesis'),
                        				    'desc'     => __('Keep empty to hide the front text.', 'cesis'),
                        				    'validate' => 'html',
                        				    'default'  => ' '
                        			),
                        		  	array(
                        				    'id'       => 'cesis_bbpress_breadcrumbs_sep',
                        					'required'  => array( 'cesis_bbpress_breadcrumbs_display', '=', 'yes') ,
                        				    'type'     => 'text',
                        				    'title'    => __('Breadcrumbs Separator.', 'cesis'),
                        				    'subtitle' => __('Link Separator, ex: / ', 'cesis'),
                        				    'desc'     => __('Will separate the links.', 'cesis'),
                        				    'validate' => 'html',
                        				    'default'  => '/'
                        			),

                        			array(
                        						'id'          => 'cesis_bbpress_breadcrumbs_font',
                        						'required'  => array( 'cesis_bbpress_breadcrumbs_display', '=', 'yes') ,
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
                        					        'font-family' => 'Roboto',
                        					        'google'      => true,
                        					        'font-size'   => '13px',
                        					        'line-height'  => '30px',
                        							'letter-spacing' => '0',
                        							'text-transform' => 'none',
                        					    ),
                        					),
                        			array(
                                                'id'        => 'cesis_bbpress_current_breadcrumbs_color',
                        						'required'  => array( 'cesis_bbpress_breadcrumbs_display', '=', 'yes') ,
                                                'type'      => 'color',
                                                'title'     => __('Breadcrumb hover color', 'cesis'),
                                                'subtitle'  => __('Breadcrumbs hover color.', 'cesis'),
                                                'default'   => '#ecf0f1',
                                                'validate'  => 'color',
                                           ),
                        			array(
                                                'id'        => 'cesis_bbpress_breadcrumbs_bg_color',
                        						'required'  => array( 'cesis_bbpress_breadcrumbs_display', '=', 'yes') ,
                                                'type'      => 'color_rgba',
                                                'title'     => __('Breadcrumb background color', 'cesis'),
                                                'subtitle'  => __('Breadcrumb background color ( only used in title layout 3 ).', 'cesis'),
                                                'default'   => array(
                            					    'color'     => '#000000',
                             						'alpha'     => 0.05,
                                        'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.05' ),
                           						),
                        						'options'       => array(
                        					        'clickout_fires_change'     => true,
                        						),
                                           ),


                        			array(
                                                'id'        => 'cesis_bbpress_breadcrumbs_word_char',
                        						'required'  => array( 'cesis_bbpress_breadcrumbs_display', '=', 'yes') ,
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
                        				    'id'       => 'cesis_bbpress_breadcrumbs_word_char_count',
                        					'required'  => array( 'cesis_bbpress_breadcrumbs_display', '=', 'yes') ,
                        				    'type'     => 'text',
                        				    'title'    => __('Breadcrumb Title max word/Character count', 'cesis'),
                        				    'subtitle' => __('Example : 4', 'cesis'),
                        				    'validate' => 'numeric',
                        				    'default'  => '4'
                        			),

                        		  	array(
                        				    'id'       => 'cesis_bbpress_breadcrumbs_word_char_end',
                        					'required'  => array( 'cesis_bbpress_breadcrumbs_display', '=', 'yes') ,
                        				    'type'     => 'text',
                        				    'title'    => __('Ending Character to show after cut title', 'cesis'),
                        				    'subtitle' => __('Example : ...', 'cesis'),
                        				    'validate' => 'html',
                        				    'default'  => ''
                        			),

                                )
                            ) );

                            Redux::setSection( $opt_name, array(
                                'title'      => __( 'Layout settings', 'cesis' ),
                                'desc'       => __( 'All the settings for Single shop post page, For full documentation on this field, visit: ', 'cesis' ),
                                'id'         => 'tt-bbpress-layout',
                                'subsection' => true,
                                'fields'     => array(


                              array(
                                         'id'        => 'cesis_bbpress_content_width',
                                           'type'     => 'dimensions',
                                           'height'     => false,
                                   'units'    => array('px','%'),
                                           'title'     => __('Select the bbpress pages main content container width ( px or % )', 'cesis'),
                                           'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                                           'default' => array(
                                          'width'   => '1170px',
                                          'units' => 'px'
                                       ),
                              ),
                              array(
                                                'id'        => 'cesis_bbpress_content_top_padding',
                                                'type'     => 'dimensions',
                                                'width'     => false,
                                    'units'    => array('px'),
                                                'title'     => __('Select the bbpress related pages main content top space ( top padding px )', 'cesis'),
                                                'default' => array(
                                          'height'   => '60px',
                                          'units' => 'px'
                                       ),


                              ),
                              array(
                                                'id'        => 'cesis_bbpress_content_bottom_padding',
                                                'type'     => 'dimensions',
                                                'width'     => false,
                                    'units'    => array('px'),
                                                'title'     => __('Select the bbpress related pages main content bottom space ( bottom padding px )', 'cesis'),
                                                'default' => array(
                                          'height'   => '60px',
                                          'units' => 'px'
                                       ),


                              ),
                              array(
                                      'id'       => 'cesis_bbpress_layout',
                                      'type'     => 'image_select',
                                      'title'    => __('Select the bbpress page layout', 'cesis'),
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
                            ) );


                                    Redux::setSection( $opt_name, array(
                                        'title'      => __( 'Pre-Footer settings', 'cesis' ),
                                        'desc'       => __( 'Post pre-footer settings', 'cesis' ),
                                        'id'         => 'tt-bbpress-prefooter',
                                        'subsection' => true,
                                        'fields'     => array(
                                            array(
                                                        'id'        => 'cesis_bbpress_prefooter',
                                                        'type'      => 'button_set',
                                                        'title'     => __('Banner type', 'cesis'),
                                                        'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                                                        'options' => array(
                                                  'none' => __('No Banner', 'cesis'),
                                                  'content' => __('Content Block', 'cesis'),
                                                  'slider' => __('Slider Revolution', 'cesis'),
                                                  'layerslider' => __('LayerSlider', 'cesis'),
                                               ),
                                              'default' => 'none'
                                          ),
                                          array(
                                                        'id'        => 'cesis_bbpress_pf_block_content',
                                                        'type'      => 'select',
                                                        'required'  => array('cesis_bbpress_prefooter','=','content'),
                                                        'title'     => __('Select the Block content to use', 'cesis'),
                                                        'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                                        //Must provide key => value pairs for select options
                                                        'data'   => "content_block",
                                                              'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                                        'default'   => ''
                                          ),
                                          array(
                                                        'id'        => 'cesis_bbpress_pf_rev_slider',
                                                        'type'      => 'select',
                                          						  'required'  => array('cesis_bbpress_prefooter','=','slider'),
                                                        'title'     => __('Select the Slider revolution to use', 'cesis'),
                                                        'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                			                  'options' => $rev_sliders,
                                                        'default'   => ''
                                          ),
                                          array(
                                                        'id'        => 'cesis_bbpress_pf_layer_slider',
                                                        'type'      => 'select',
                                          						  'required'  => array('cesis_bbpress_prefooter','=','layerslider'),
                                                        'title'     => __('Select the Layerslider to use', 'cesis'),
                                                        'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                			                  'options' => $layerslider_array,
                                                        'default'   => ''
                                          ),
                                        )
                                    ) );


                                    Redux::setSection( $opt_name, array(
                                        'title'      => __( 'Footer settings', 'cesis' ),
                                        'desc'       => __( 'Product Posts footer settings', 'cesis' ),
                                        'id'         => 'tt-bbpress-footer',
                                        'subsection' => true,
                                        'fields'     => array(
                                          array(
                                                        'id'        => 'cesis_bbpress_footer_fixed',
                                                        'type'      => 'button_set',
                                                        'title'     => __('Use fixed footer?', 'cesis'),
                                                        'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                                                        'options' => array(
                                					        'cesis_fixed_footer' =>  __('Yes', 'cesis'),
                                					        'no' =>  __('No', 'cesis'),
                                               ),
                                              'default' => 'no'
                                          ),
                                            array(
                                                        'id'        => 'cesis_bbpress_footer',
                                                        'type'      => 'button_set',
                                                        'title'     => __('Display the Footer main area?', 'cesis'),
                                                        'subtitle'  => __('If you want to show the Footer top part ( widget space ) select yes.', 'cesis'),
                                                        'options' => array(
                                                  'yes' =>  __('Yes', 'cesis'),
                                                  'no' =>  __('No', 'cesis'),
                                               ),
                                              'default' => 'yes'
                                          ),
                                          array(
                                                      'id'        => 'cesis_bbpress_footer_bar',
                                                      'type'      => 'button_set',
                                                      'title'     => __('Display the Footer under bar?', 'cesis'),
                                                      'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                                                      'options' => array(
                                                'yes' =>  __('Yes', 'cesis'),
                                                'no' =>  __('No', 'cesis'),
                                             ),
                                            'default' => 'yes'
                                        ),
                                        )
                                    ) );


                        Redux::setSection( $opt_name, array(
                          'title'  => __( 'Archives Settings', 'cesis' ),
                          'id'     => 'tt-archives',
                          'desc'   => __( 'Settings for the different posts archives pages.', 'cesis' ),
                          'icon'   => 'fa-archive3 ',
                          'fields' => array(


                          )
                        ) );


                        Redux::setSection( $opt_name, array(
                          'title'      => __( 'Blog', 'cesis' ),
                          'desc'       => __( 'Blog archive settings', 'cesis' ),
                            'id'         => 'tt-blog-archive',
                            'subsection' => true,
                            'fields'     => array(
                              array(
                                'id'   => 'cesis_blog_archive_infobox_header',
                                'type' => 'info',
                                'style' => 'success',
                                'desc' => __('Header settings.', 'cesis')
                              ),
                              array(
                                          'id'        => 'cesis_post_a_topbar',
                                          'type'      => 'button_set',
                                          'title'     => __('Display the Header Top Bar?', 'cesis'),
                                          'subtitle'  => __('Select if you want to show the header top bar.', 'cesis'),
                                          'options' => array(
                                    'yes' =>  __('Yes', 'cesis'),
                                    'no' =>  __('No', 'cesis'),
                                 ),
                                'default' => 'no'
                            ),
                            array(
                                        'id'        => 'cesis_post_a_header',
                                        'type'      => 'button_set',
                                        'title'     => __('Display the Header?', 'cesis'),
                                        'subtitle'  => __('Select if you want to show the header.', 'cesis'),
                                        'options' => array(
                                  'yes' =>  __('Yes', 'cesis'),
                                  'no' =>  __('No', 'cesis'),
                               ),
                              'default' => 'yes'
                          ),
                          array(
                                      'id'        => 'cesis_post_a_header_transparent',
                                      'type'      => 'button_set',
                                      'title'     => __('Use Transparent Header?', 'cesis'),
                                      'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
                                      'options' => array(
                                'cesis_transparent_header' => __('Yes', 'cesis'),
                                'cesis_opaque_header' => __('No', 'cesis'),
                             ),
                            'default' => 'cesis_opaque_header'
                        ),
                          array(
                            'id'   => 'cesis_blog_archive_infobox_banner',
                            'type' => 'info',
                            'style' => 'success',
                            'desc' => __('Banner settings.', 'cesis')
                          ),
                          array(
                                      'id'        => 'cesis_post_a_banner',
                                      'type'      => 'button_set',
                                      'title'     => __('Banner type', 'cesis'),
                                      'subtitle'  => __('Select the banner area type.', 'cesis'),
                                      'options' => array(
                                'none' => __('No Banner', 'cesis'),
                                'content' => __('Content Block', 'cesis'),
                                'slider' => __('Slider Revolution', 'cesis'),
                                'layerslider' => __('LayerSlider', 'cesis'),
                             ),
                            'default' => 'none'
                        ),
                        array(
                                    'id'        => 'cesis_post_a_banner_pos',
                                    'type'      => 'button_set',
                                    'required'  => array('cesis_post_a_banner','!=','none'),
                                    'title'     => __('Banner position', 'cesis'),
                                    'subtitle'  => __('Select the banner position.', 'cesis'),
                                    'options' => array(
                              'under' => __('Under Header', 'cesis'),
                              'above' => __('Above Header', 'cesis'),
                           ),
                          'default' => 'under'
                        ),
                        array(
                                      'id'        => 'cesis_post_a_block_content',
                                      'type'      => 'select',
                                      'required'  => array('cesis_post_a_banner','=','content'),
                                      'title'     => __('Select the Block content to use', 'cesis'),
                                      'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                      //Must provide key => value pairs for select options
                                      'data'   => "content_block",
                                            'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                      'default'   => ''
                        ),

                        array(
                                      'id'        => 'cesis_post_a_rev_slider',
                                      'type'      => 'select',
                        						  'required'  => array('cesis_post_a_banner','=','slider'),
                                      'title'     => __('Select the Slider revolution to use', 'cesis'),
                                      'subtitle'  => __('You need to have at least one slider created', 'cesis'),
              			                  'options' => $rev_sliders,
                                      'default'   => ''
                        ),
                        array(
                                      'id'        => 'cesis_post_a_layer_slider',
                                      'type'      => 'select',
                                      'required'  => array('cesis_post_a_banner','=','layerslider'),
                                      'title'     => __('Select the Layerslider to use', 'cesis'),
                                      'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                      'options' => $layerslider_array,
                                      'default'   => ''
                        ),
                              array(
                                'id'   => 'cesis_blog_archive_infobox_title',
                                'type' => 'info',
                                'style' => 'success',
                                'desc' => __('Title settings.', 'cesis')
                              ),
                              array(
                                  'id'        => 'cesis_post_a_title',
                                  'type'      => 'button_set',
                                  'title'     => __('Show Title area?', 'cesis'),
                                  'subtitle'  => __('Select if you want to show the title area.', 'cesis'),
                                  'options' => array(
                                    'yes' => __('Yes', 'cesis'),
                                    'no' => __('No', 'cesis'),
                                  ),
                                 'default' => 'no'
                            ),
                              array(
                                'id'   => 'cesis_blog_archive_infobox',
                                'type' => 'info',
                                'style' => 'success',
                                'desc' => __('Layout settings.', 'cesis')
                              ),

                              array(
                                'id'        => 'cesis_blog_archive_content_width',
                                'type'     => 'dimensions',
                                'height'     => false,
                                'units'    => array('px','%'),
                                'title'     => __('Select the page main content container width ( px or % )', 'cesis'),
                                'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                                'default' => array(
                                  'width'   => '1170px',
                                  'units' => 'px'
                                ),
                              ),
                              array(
                                'id'        => 'cesis_blog_archive_top_padding',
                                'type'     => 'dimensions',
                                'width'     => false,
                                'units'    => array('px'),
                                'title'     => __('Select the page main content top space ( top padding px )', 'cesis'),
                                'default' => array(
                                  'height'   => '60px',
                                  'units' => 'px'
                                ),


                              ),
                              array(
                                'id'        => 'cesis_blog_archive_bottom_padding',
                                'type'     => 'dimensions',
                                'width'     => false,
                                'units'    => array('px'),
                                'title'     => __('Select the page main content bottom space ( bottom padding px )', 'cesis'),
                                'default' => array(
                                  'height'   => '60px',
                                  'units' => 'px'
                                ),


                              ),
                              array(
                                'id'       => 'cesis_blog_archive_layout',
                                'type'     => 'image_select',
                                'title'    => __('Select the page layout', 'cesis'),
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
                                  'id' => 'cesis_blog_archive_sidebar_select',
                                  'title' => __('Sidebar', 'cesis'),
                                  'desc' => 'Please select the sidebar for the archive.',
                                  'type' => 'select',
                                  'data' => 'sidebars',
                                  'required'  => array(
                                        array('cesis_blog_archive_layout','not','no_sidebar'),
                                  ),
                                  'default' => 'None'
                                ),
                                array(
                                  'id'   => 'cesis_blog_archive_infobox_one',
                                  'type' => 'info',
                                  'style' => 'success',
                                  'desc' => __('Style settings.', 'cesis')
                                ),

                                array(
                                'id'        => 'cesis_blog_archive_type',
                                'type'      => 'select',
                                'title'     => __('Blog type', 'cesis'),
                                'subtitle'  => __('Select the blog type.', 'cesis'),
                                //Must provide key => value pairs for select options
                                'options'   => array(

                        						"isotope_grid" => __("Isotope Grid", 'cesis') ,
                        						 "isotope_masonry" => __("Isotope Masonry", 'cesis'),
                        						"isotope_packery" => __("Isotope Packery", 'cesis') ,
                                ),
                                'default'   => 'isotope_masonry'
                                ),

                                array(
                                'id'        => 'cesis_blog_archive_style_ig',
                                'type'      => 'select',
                                'title'     => __('Blog Style', 'cesis'),
                                'subtitle'  => __('Select Blog Style ( design )', 'cesis'),
                                'required'  => array(
                                      array('cesis_blog_archive_type','=','isotope_grid'),
                                ),
                                //Must provide key => value pairs for select options
                                'options'   => array(

                        						"cesis_blog_style_1" => __("Standard 1", 'cesis') ,
                                    "cesis_blog_style_2" => __("Standard 2", 'cesis') ,
                                    "cesis_blog_style_3" => __("Standard 3", 'cesis') ,
                                    "cesis_blog_style_4" => __("Standard 4", 'cesis') ,
                                    "cesis_blog_style_5" => __("Standard 5", 'cesis') ,
                                    "cesis_blog_style_14" => __("Standard 6", 'cesis') ,
                                    "cesis_blog_style_6" => __("Boxed 1", 'cesis') ,
                                    "cesis_blog_style_7" => __("Boxed 2", 'cesis') ,
                                    "cesis_blog_style_8" => __("Boxed 3", 'cesis') ,
                                    "cesis_blog_style_15" => __("Boxed 4 ( Centered )", 'cesis') ,
                                    "cesis_blog_style_9" => __("On image 1", 'cesis') ,
                                    "cesis_blog_style_10" => __("On image 2", 'cesis') ,
                                    "cesis_blog_style_11" => __("On image 3", 'cesis') ,
                                    "cesis_blog_style_12" => __("On image 4", 'cesis') ,
                                    "cesis_blog_style_13" => __("On image 5", 'cesis') ,
                                ),
                                'default'   => 'cesis_blog_style_1'
                                ),

                                array(
                                'id'        => 'cesis_blog_archive_style_im',
                                'type'      => 'select',
                                'title'     => __('Blog Style', 'cesis'),
                                'subtitle'  => __('Select Blog Style ( design )', 'cesis'),
                                'required'  => array(
                                      array('cesis_blog_archive_type','=','isotope_masonry'),
                                ),
                                //Must provide key => value pairs for select options
                                'options'   => array(

                        						"cesis_blog_style_1" => __("Standard 1", 'cesis') ,
                                    "cesis_blog_style_2" => __("Standard 2", 'cesis') ,
                                    "cesis_blog_style_3" => __("Standard 3", 'cesis') ,
                                    "cesis_blog_style_4" => __("Standard 4", 'cesis') ,
                                    "cesis_blog_style_5" => __("Standard 5", 'cesis') ,
                                    "cesis_blog_style_14" => __("Standard 6", 'cesis') ,
                                    "cesis_blog_style_6" => __("Boxed 1", 'cesis') ,
                                    "cesis_blog_style_7" => __("Boxed 2", 'cesis') ,
                                    "cesis_blog_style_8" => __("Boxed 3", 'cesis') ,
                                    "cesis_blog_style_15" => __("Boxed 4 ( Centered )", 'cesis') ,
                                ),
                                'default'   => 'cesis_blog_style_1'
                                ),

                                array(
                                'id'        => 'cesis_blog_archive_style_ip',
                                'type'      => 'select',
                                'title'     => __('Blog Style', 'cesis'),
                                'subtitle'  => __('Select Blog Style ( design )', 'cesis'),
                                'required'  => array(
                                      array('cesis_blog_archive_type','=','isotope_packery'),
                                ),
                                //Must provide key => value pairs for select options
                                'options'   => array(
                                    "cesis_blog_style_9" => __("On image 1", 'cesis') ,
                                    "cesis_blog_style_10" => __("On image 2", 'cesis') ,
                                    "cesis_blog_style_11" => __("On image 3", 'cesis') ,
                                    "cesis_blog_style_12" => __("On image 4", 'cesis') ,
                                    "cesis_blog_style_13" => __("On image 5", 'cesis') ,
                                ),
                                'default'   => 'cesis_blog_style_9'
                                ),

                                array(
                                'id'        => 'cesis_blog_archive_hover',
                                'type'      => 'select',
                                'title'     => __('Hover effect', 'cesis'),
                                'subtitle'  => __('Select the hover effect you want to use.', 'cesis'),
                                //Must provide key => value pairs for select options
                                'options'   => array(
                                    "none" => __("None", 'cesis') ,
                                    "cesis_hover_overlay" => __("Colored Overlay", 'cesis') ,
                                    "cesis_hover_icon" => __("Zoom and Link icon", 'cesis') ,
                                    "cesis_hover_fade" => __("Content Fade in ( On image style only )", 'cesis') ,
                                    "cesis_hover_fade_out" => __("Content Fade Out ( On image style only )", 'cesis') ,
                                    "cesis_hover_slide" => __("Content Slide in ( On image style only )", 'cesis') ,
                                    "cesis_hover_slide_out" => __("Content Slide Out ( On image style only )", 'cesis') ,
                                ),
                                'default'   => 'cesis_hover_icon'
                                ),

                                array(
                                                  'id'        => 'cesis_blog_archive_hover_color',
                                                  'type'      => 'color_rgba',
                                                  'title'     => __('Hover Color', 'cesis'),
                                                  'subtitle'  => __('Choose the hover color ( optional )', 'cesis'),
                                                  'required'  => array(
                                                        array('cesis_blog_archive_hover','not','cesis_hover_fade'),
                                                        array('cesis_blog_archive_hover','not','cesis_hover_fade_out'),
                                                        array('cesis_blog_archive_hover','not','cesis_hover_slide'),
                                                        array('cesis_blog_archive_hover','not','cesis_hover_slide_out'),
                                                        array('cesis_blog_archive_hover','not','none'),
                                                  ),
                                                  'default'   => array(
                                                    'color'     => '#69ace7',
                                                    'alpha'     => '0.50',
                                                    'rgba' => Redux_Helpers::hex2rgba ( '#69ace7', '0.50' ),
                                                  ),
                                    						'options'       => array(
                                    					        'clickout_fires_change'     => true,
                                    						),
                                ),

                                array(
                                'id'        => 'cesis_blog_archive_effect',
                                'type'      => 'select',
                                'title'     => __('Additional effect', 'cesis'),
                                'subtitle'  => __('Select the additional effect you want to use.', 'cesis'),
                                //Must provide key => value pairs for select options
                                'options'   => array(
                                    "none" => __("None", 'cesis') ,
                                    "cesis_effect_shadow" => __("Shadow", 'cesis') ,
                                    "cesis_effect_zoomIn" => __("Image Zoom In", 'cesis') ,
                                    "cesis_effect_zoomOut" => __("Image Zoom Out", 'cesis') ,
                                    "cesis_effect_color" => __("Add Color", 'cesis') ,
                                    "cesis_effect_decolor" => __("Remove Color", 'cesis') ,
                                    "cesis_effect_frame" => __("White frame ( On image style only )", 'cesis') ,
                                ),
                                'default'   => 'none'
                                ),

                                array(
                                            'id'        => 'cesis_blog_archive_force_font',
                                            'type'      => 'button_set',
                                            'title'     => __('Font style', 'cesis'),
                                            'subtitle'  => __('Select the font style to use.', 'cesis'),
                                            'options' => array(
                                              'no' =>  __('Theme default', 'cesis'),
                                              'force_font' =>  __('Demo Pre-set', 'cesis'),
                                              'custom' =>  __('Custom', 'cesis'),
                                   ),
                                  'default' => 'no'
                              ),
                             array(
                  						'id'          => 'cesis_blog_archive_heading_font',
                  					    'type'        => 'typography',
                                          'title'     => __('Heading font', 'cesis'),
                                          'subtitle'  => __('Select the font to use.', 'cesis'),
                                          'required'  => array(
                                                array('cesis_blog_archive_force_font','contains','custom'),
                                          ),
                  					    'google'      => true,
                  					    'font-backup' => true,
                  					    'color' => false,
                  					    'units'       =>'px',
                  						'line-height' => true,
                  						'text-align' => false,
                  						'letter-spacing' => true,
                  						'text-transform' => true,
                  						'fonts' => array(
                  				            "Aileron"					                           => "Aileron",
                  				            "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                  				            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                  				            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                  				            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                  				            "Courier, monospace"                                   => "Courier, monospace",
                  				            "Garamond, serif"                                      => "Garamond, serif",
                  				            "Georgia, serif"                                       => "Georgia, serif",
                  				            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                  					        "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                  				            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                  				            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                  				            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                  				            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                  				            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                  				            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                  				            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                  				            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
                          				),
                  					    'default'     => array(
                  					        'font-weight'  => '500',
                  					        'font-family' => 'Roboto',
                  					        'google'      => true,
                  					        'font-size'   => '14px',
                  					        'line-height'   => '24px',
                  					        'text-transform'   => 'uppercase',
                  							'letter-spacing' => '1',
                  					    ),
                  				   ),
                            array(
                             'id'          => 'cesis_blog_archive_text_font',
                               'type'        => 'typography',
                                         'title'     => __('Text font', 'cesis'),
                                         'subtitle'  => __('Select the font to use.', 'cesis'),
                                         'required'  => array(
                                               array('cesis_blog_archive_force_font','contains','custom'),
                                         ),
                               'google'      => true,
                               'font-backup' => true,
                               'color' => false,
                               'units'       =>'px',
                             'line-height' => true,
                             'text-align' => false,
                             'letter-spacing' => true,
                             'text-transform' => true,
                             'fonts' => array(
                                     "Aileron"					                           => "Aileron",
                                     "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                                     "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                                     "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                                     "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                                     "Courier, monospace"                                   => "Courier, monospace",
                                     "Garamond, serif"                                      => "Garamond, serif",
                                     "Georgia, serif"                                       => "Georgia, serif",
                                     "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                                   "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                                     "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                                     "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                                     "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                                     "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                                     "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                                     "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                                     "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                                     "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
                                 ),
                               'default'     => array(
                                   'font-weight'  => '400',
                                   'font-family' => 'Roboto',
                                   'google'      => true,
                                   'font-size'   => '14px',
                                   'line-height'   => '24px',
                                   'text-transform'   => 'none',
                               'letter-spacing' => '0',
                               ),
                            ),


                              array(
                              'id'        => 'cesis_blog_archive_thumbnail_size',
                              'type'      => 'select',
                              'title'     => __('Thumbnail size', 'cesis'),
                              'subtitle'  => __('Select the posts thumbnail size', 'cesis'),
                              'required'  => array(
                                    array('cesis_blog_archive_type','contains','grid'),
                              ),
                              //Must provide key => value pairs for select options
                              'options'   => array(
                                  "tn_squared" => __("1:1 ( squared )", 'cesis') ,
                                  "tn_rectangle_4_3" => __("4:3  ( rectangle )", 'cesis') ,
                                  "tn_rectangle_3_2" => __("3:2  ( rectangle )", 'cesis') ,
                                  "tn_landscape_16_9" => __("16:9 ( landscape )", 'cesis') ,
                                  "tn_landscape_21_9" => __("21:9 ( landscape )", 'cesis') ,
                                  "tn_portrait_3_4" => __("3:4 ( portrait )", 'cesis') ,
                                  "tn_portrait_2_3" => __("2:3 ( portrait )", 'cesis') ,
                                  "tn_portrait_9_16" => __("9:16 ( portrait )", 'cesis') ,
                              ),
                              'default'   => 'tn_rectangle_3_2'
                              ),

                              array(
                              'id'        => 'cesis_blog_archive_packery_type',
                              'type'      => 'select',
                              'title'     => __('Packery Type', 'cesis'),
                              'subtitle'  => __('Select the packery image ratio', 'cesis'),
                              'required'  => array(
                                    array('cesis_blog_archive_type','contains','packery'),
                              ),
                              //Must provide key => value pairs for select options
                              'options'   => array(
                                  "squared" => __("Squared", 'cesis') ,
                                  "rectangle" => __("Rectangle", 'cesis') ,
                              ),
                              'default'   => 'squared'
                              ),

                              array(
                              'id'        => 'cesis_blog_archive_col',
                              'type'      => 'select',
                              'title'     => __('Number of items per line?', 'cesis'),
                              'subtitle'  => __('Select the number of posts to show per line.', 'cesis'),
                              //Must provide key => value pairs for select options
                              'options'   => array(
                    						"1" => "1",
                    						"2" => "2",
                    						"3" => "3",
                    						"4" => "4",
                    						"5" => "5",
                    						"6" => "6",
                              ),
                              'default'   => '1'
                              ),
                              array(
                                      'id'        => 'cesis_blog_archive_padding',
                                      'type'      => 'text',
                                      'title'     => __('Choose the space between the items', 'cesis'),
                                      'subtitle'  => __('Select the space between the items, default 30.', 'cesis'),
                                      'validate'  => 'numeric',
                                      'default'   => '64',
                              ),
                              array(
                                'id'        => 'cesis_blog_archive_inner_padding_ig',
                                'type'      => 'text',
                                'title'     => __('Choose the inner space, use % or px', 'cesis'),
                                'subtitle'  => __('Select the inner space, default 10%.', 'cesis'),
                                'required'  => array(
                                      array('cesis_blog_archive_style_ig','not','cesis_blog_style_1'),
                                      array('cesis_blog_archive_style_ig','not','cesis_blog_style_2'),
                                      array('cesis_blog_archive_style_ig','not','cesis_blog_style_3'),
                                      array('cesis_blog_archive_style_ig','not','cesis_blog_style_4'),
                                      array('cesis_blog_archive_style_ig','not','cesis_blog_style_5'),
                                      array('cesis_blog_archive_style_ig','not','cesis_blog_style_6'),
                                      array('cesis_blog_archive_style_ig','not','cesis_blog_style_7'),
                                      array('cesis_blog_archive_style_ig','not','cesis_blog_style_8'),
                                      array('cesis_blog_archive_style_ig','not','cesis_blog_style_14'),
                                      array('cesis_blog_archive_style_ig','not','cesis_blog_style_15'),
                                ),
                                'validate'  => 'html',
                                'default'   => '10%',
                              ),
                              array(
                                'id'        => 'cesis_blog_archive_inner_padding_ip',
                                'type'      => 'text',
                                'title'     => __('Choose the inner space, use % or px', 'cesis'),
                                'subtitle'  => __('Select the inner space, default 10%.', 'cesis'),
                                'required'  => array(
                                      array('cesis_blog_archive_type','contains','packery'),
                                ),
                                'validate'  => 'html',
                                'default'   => '10%',
                              ),

                              array(
                                          'id'        => 'cesis_blog_archive_i_author',
                                          'type'      => 'button_set',
                                          'title'     => __('Show author name?', 'cesis'),
                                          'subtitle'  => __('Select if you want to show the author name.', 'cesis'),
                                          'options' => array(
                                    'yes' =>  __('Yes', 'cesis'),
                                    'no' =>  __('No', 'cesis'),
                                 ),
                                'default' => 'yes'
                            ),

                            array(
                                        'id'        => 'cesis_blog_archive_i_date',
                                        'type'      => 'button_set',
                                        'title'     => __('Show date?', 'cesis'),
                                        'subtitle'  => __('Select if you want to show the date.', 'cesis'),
                                        'options' => array(
                                  'yes' =>  __('Yes', 'cesis'),
                                  'no' =>  __('No', 'cesis'),
                               ),
                              'default' => 'yes'
                          ),

                          array(
                                      'id'        => 'cesis_blog_archive_i_category',
                                      'type'      => 'button_set',
                                      'title'     => __('Show categories?', 'cesis'),
                                      'subtitle'  => __('Select if you want to show the categories.', 'cesis'),
                                      'options' => array(
                                'yes' =>  __('Yes', 'cesis'),
                                'no' =>  __('No', 'cesis'),
                             ),
                            'default' => 'no'
                        ),

                        array(
                                    'id'        => 'cesis_blog_archive_i_tag',
                                    'type'      => 'button_set',
                                    'title'     => __('Show tags?', 'cesis'),
                                    'subtitle'  => __('Select if you want to show the tags.', 'cesis'),
                                    'options' => array(
                              'yes' =>  __('Yes', 'cesis'),
                              'no' =>  __('No', 'cesis'),
                           ),
                          'default' => 'yes'
                      ),

                      array(
                                  'id'        => 'cesis_blog_archive_i_comment',
                                  'type'      => 'button_set',
                                  'title'     => __('Show comment number?', 'cesis'),
                                  'subtitle'  => __('Select if you want to show the comment number.', 'cesis'),
                                  'options' => array(
                            'yes' =>  __('Yes', 'cesis'),
                            'no' =>  __('No', 'cesis'),
                         ),
                        'default' => 'yes'
                    ),

                    array(
                                'id'        => 'cesis_blog_archive_i_like',
                                'type'      => 'button_set',
                                'title'     => __('Show like icon?', 'cesis'),
                                'subtitle'  => __('Select if you want to show the like icon.', 'cesis'),
                                'options' => array(
                          'yes' =>  __('Yes', 'cesis'),
                          'no' =>  __('No', 'cesis'),
                       ),
                      'default' => 'no'
                  ),

                  array(
                              'id'        => 'cesis_blog_archive_i_text',
                              'type'      => 'button_set',
                              'title'     => __('Show text?', 'cesis'),
                              'subtitle'  => __('Select if you want to show the blog post text.', 'cesis'),
                              'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'yes'
                ),

                array(
                'id'        => 'cesis_blog_archive_text_source',
                'type'      => 'select',
                'title'     => __('Select text source', 'cesis'),
                'subtitle'  => __('Select the text source ( if the excerpt isn\'t set the content will be used instead ).', 'cesis'),
                'required'  => array(
                      array('cesis_blog_archive_i_text','=','yes'),
                ),
                //Must provide key => value pairs for select options
                'options'   => array(
                    "excerpt" => __("Excerpt", 'cesis') ,
                    "content" => __("Content", 'cesis') ,
                ),
                'default'   => 'excerpt'
                ),
                array(
                        'id'        => 'cesis_blog_archive_char_length',
                        'type'      => 'text',
                        'title'     => __('Number of Characters to show', 'cesis'),
                        'subtitle'  => __('Select the number of charachters to show ( leave blank to show full post content )', 'cesis'),
                        'required'  => array(
                              array('cesis_blog_archive_i_text','=','yes'),
                        ),
                        'validate'  => 'numeric',
                        'default'   => '150',
                ),

                array(
                            'id'        => 'cesis_blog_archive_read_more',
                            'type'      => 'button_set',
                            'title'     => __('Show read more link?', 'cesis'),
                            'subtitle'  => __('Select if you want to show the read more link.', 'cesis'),
                            'options' => array(
                      'yes' =>  __('Yes', 'cesis'),
                      'no' =>  __('No', 'cesis'),
                   ),
                  'default' => 'yes'
              ),

              array(
              'id'        => 'cesis_blog_archive_read_more_style',
              'type'      => 'select',
              'title'     => __('Read more link style', 'cesis'),
              'subtitle'  => __('Select the read more link style.', 'cesis'),
              'required'  => array(
                    array('cesis_blog_archive_read_more','=','yes'),
              ),
              'options'   => array(
                  "text" => __("Text only", 'cesis') ,
                  "button_rm" => __("Button", 'cesis') ,
              ),
              'default'   => 'button_rm'
              ),

              array(
              'id'        => 'cesis_blog_archive_rm_t_font',
              'type'      => 'select',
              'title'     => __('Read more text font family', 'cesis'),
              'subtitle'  => __('Select the read more font family ( from the one set in the theme option ).', 'cesis'),
              'required'  => array(
                    array('cesis_blog_archive_read_more_style','=','text'),
              ),
              'options'   => array(
                  "main_font" => __("Main font", 'cesis') ,
                  "alt_font" => __("Alternative font", 'cesis') ,
              ),
              'default'   => 'main_font'
              ),

              array(
              'id'        => 'cesis_blog_archive_rm_t_f_weight',
              'type'      => 'select',
              'title'     => __('Read more text font weight', 'cesis'),
              'subtitle'  => __('Select the read more text font weight.', 'cesis'),
              'required'  => array(
                    array('cesis_blog_archive_read_more_style','=','text'),
              ),
              'options'   => array(
                  "100" => __("100 ( thin )", 'cesis') ,
                  "300" => __("300 ( light )", 'cesis') ,
                  "400" => __("400 ( normal )", 'cesis') ,
                  "500" => __("500 ( normal bold )", 'cesis') ,
                  "600" => __("600 ( semi bold )", 'cesis') ,
                  "700" => __("700 ( bold )", 'cesis') ,
                  "900" => __("900 ( extra bold )", 'cesis') ,
              ),
              'default'   => '400'
              ),

              array(
              'id'        => 'cesis_blog_archive_rm_t_t_transform',
              'type'      => 'select',
              'title'     => __('Read more text transform', 'cesis'),
              'subtitle'  => __('Select the read more text capitalization.', 'cesis'),
              'required'  => array(
                    array('cesis_blog_archive_read_more_style','=','text'),
              ),
              'options'   => array(
                  "none" => __("None", 'cesis') ,
                  "uppercase" => __("Uppercase", 'cesis') ,
                  "lowercase" => __("Lowercase", 'cesis') ,
              ),
              'default'   => 'none'
              ),

              array(
              'id'        => 'cesis_blog_archive_rm_t_l_spacing',
              'type'      => 'text',
              'title'     => __('Read more text letter spacing', 'cesis'),
              'subtitle'  => __('Select the read more text letter spacing ( optional ) eg : 1', 'cesis'),
              'required'  => array(
                    array('cesis_blog_archive_read_more_style','=','text'),
              ),
              'validate'  => 'numeric',
              'default'   => '0',
              ),

              array(
              'id'        => 'cesis_blog_archive_read_more_button_style',
              'type'      => 'select',
              'title'     => __('Read more button style', 'cesis'),
              'subtitle'  => __('Select the color scheme you want to use for the read more button', 'cesis'),
              'required'  => array(
                    array('cesis_blog_archive_read_more_style','=','button_rm'),
              ),
              'options'   => array(
                  "cesis_btn" => __("Cesis First button color settings", 'cesis') ,
                  "cesis_alt_btn" => __("Cesis Second button color settings", 'cesis') ,
                  "cesis_sub_btn" => __("Cesis Third button color settings", 'cesis') ,
                  "custom" => __("Custom color", 'cesis') ,
              ),
              'default'   => 'custom'
              ),

              array(
                                'id'        => 'cesis_blog_archive_rm_t_color',
                                'type'      => 'color',
                                'title'     => __('Button Text Color', 'cesis'),
                                'subtitle'  => __('Choose the button text color', 'cesis'),
                                'required'  => array(
                                      array('cesis_blog_archive_read_more_button_style','=','custom'),
                                ),
                                'default'   => '#ffffff',
                                'validate'  => 'color',
              ),

              array(
                                'id'        => 'cesis_blog_archive_rm_bg_color',
                                'type'      => 'color',
                                'title'     => __('Button Background Color', 'cesis'),
                                'subtitle'  => __('Choose the button background color', 'cesis'),
                                'required'  => array(
                                      array('cesis_blog_archive_read_more_button_style','=','custom'),
                                ),
                                'default'   => '#3a78ff',
                                'validate'  => 'color',
              ),

              array(
                                'id'        => 'cesis_blog_archive_rm_b_color',
                                'type'      => 'color',
                                'title'     => __('Button Border Color', 'cesis'),
                                'subtitle'  => __('Choose the button border color', 'cesis'),
                                'required'  => array(
                                      array('cesis_blog_archive_read_more_button_style','=','custom'),
                                ),
                                'default'   => '#3a78ff',
                                'validate'  => 'color',
              ),

              array(
                                'id'        => 'cesis_blog_archive_rm_ht_color',
                                'type'      => 'color',
                                'title'     => __('Button hover Text Color', 'cesis'),
                                'subtitle'  => __('Choose the button hover text color', 'cesis'),
                                'required'  => array(
                                      array('cesis_blog_archive_read_more_button_style','=','custom'),
                                ),
                                'default'   => '#ffffff',
                                'validate'  => 'color',
              ),

              array(
                                'id'        => 'cesis_blog_archive_rm_hbg_color',
                                'type'      => 'color',
                                'title'     => __('Button hover Background Color', 'cesis'),
                                'subtitle'  => __('Choose the button hover background color', 'cesis'),
                                'required'  => array(
                                      array('cesis_blog_archive_read_more_button_style','=','custom'),
                                ),
                                'default'   => '#4251f4',
                                'validate'  => 'color',
              ),

              array(
                                'id'        => 'cesis_blog_archive_rm_hb_color',
                                'type'      => 'color',
                                'title'     => __('Button hover Border Color', 'cesis'),
                                'subtitle'  => __('Choose the button hover border color', 'cesis'),
                                'required'  => array(
                                      array('cesis_blog_archive_read_more_button_style','=','custom'),
                                ),
                                'default'   => '#4251f4',
                                'validate'  => 'color',
              ),

              array(
              'id'        => 'cesis_blog_archive_rm_font',
              'type'      => 'select',
              'title'     => __('Button font family', 'cesis'),
              'subtitle'  => __('Select the button font family ( from the one set in the theme option ).', 'cesis'),
              'required'  => array(
                    array('cesis_blog_archive_read_more_button_style','=','custom'),
              ),
              'options'   => array(
                  "main_font" => __("Main font", 'cesis') ,
                  "alt_font" => __("Alternative font", 'cesis') ,
              ),
              'default'   => 'main_font'
              ),

              array(
              'id'        => 'cesis_blog_archive_rm_f_size',
              'type'      => 'text',
              'title'     => __('Button font size', 'cesis'),
              'subtitle'  => __('Select the button font size', 'cesis'),
              'required'  => array(
                    array('cesis_blog_archive_read_more_button_style','=','custom'),
              ),
              'validate'  => 'numeric',
              'default'   => '15',
              ),

              array(
              'id'        => 'cesis_blog_archive_rm_f_weight',
              'type'      => 'select',
              'title'     => __('Button font weight', 'cesis'),
              'subtitle'  => __('Select the button font weight.', 'cesis'),
              'required'  => array(
                    array('cesis_blog_archive_read_more_button_style','=','custom'),
              ),
              'options'   => array(
                  "100" => __("100 ( thin )", 'cesis') ,
                  "300" => __("300 ( light )", 'cesis') ,
                  "400" => __("400 ( normal )", 'cesis') ,
                  "500" => __("500 ( normal bold )", 'cesis') ,
                  "600" => __("600 ( semi bold )", 'cesis') ,
                  "700" => __("700 ( bold )", 'cesis') ,
                  "900" => __("900 ( extra bold )", 'cesis') ,
              ),
              'default'   => '500'
              ),

              array(
              'id'        => 'cesis_blog_archive_rm_t_transform',
              'type'      => 'select',
              'title'     => __('Button text transform', 'cesis'),
              'subtitle'  => __('Select the button text capitalization.', 'cesis'),
              'required'  => array(
                    array('cesis_blog_archive_read_more_button_style','=','custom'),
              ),
              'options'   => array(
                  "none" => __("None", 'cesis') ,
                  "uppercase" => __("Uppercase", 'cesis') ,
                  "lowercase" => __("Lowercase", 'cesis') ,
              ),
              'default'   => 'none'
              ),

              array(
              'id'        => 'cesis_blog_archive_rm_l_spacing',
              'type'      => 'text',
              'title'     => __('Button letter spacing', 'cesis'),
              'subtitle'  => __('Select the button text letter spacing ( optional ) eg : 1', 'cesis'),
              'required'  => array(
                    array('cesis_blog_archive_read_more_button_style','=','custom'),
              ),
              'validate'  => 'numeric',
              'default'   => '0',
              ),

              array(
              'id'        => 'cesis_blog_archive_rm_b_size',
              'type'      => 'select',
              'title'     => __('Read more button size', 'cesis'),
              'subtitle'  => __('Select the read more button size', 'cesis'),
              'required'  => array(
                    array('cesis_blog_archive_read_more_style','=','button_rm'),
              ),
              'options'   => array(
                  "read_more_small" => __("Small", 'cesis') ,
                  "read_more_medium" => __("Medium", 'cesis') ,
                  "read_more_large" => __("Large", 'cesis') ,
              ),
              'default'   => 'read_more_small'
              ),

              array(
              'id'        => 'cesis_blog_archive_rm_b_radius',
              'type'      => 'text',
              'title'     => __('Border Radius (optional)', 'cesis'),
              'subtitle'  => __('Select the button border radius ( optional ) eg : 10', 'cesis'),
              'required'  => array(
                    array('cesis_blog_archive_read_more_button_style','=','custom'),
              ),
              'validate'  => 'numeric',
              'default'   => '4',
              ),

              array(
              'id'        => 'cesis_blog_archive_rm_shape',
              'type'      => 'select',
              'title'     => __('Read more button shape', 'cesis'),
              'subtitle'  => __('Select the button shape', 'cesis'),
              'required'  => array(
                    array('cesis_blog_archive_read_more_button_style','not','custom'),
              ),
              'options'   => array(
                  "cesis_btn_squared" => __("Squared", 'cesis') ,
                  "cesis_btn_rounded" => __("Rounded", 'cesis') ,
              ),
              'default'   => 'cesis_btn_squared'
              ),

              array(
                          'id'        => 'cesis_blog_archive_target',
                          'type'      => 'button_set',
                          'title'     => __('Open link in a new page?', 'cesis'),
                          'subtitle'  => __('Select if you want the posts link to open in a new page.', 'cesis'),
                          'options' => array(
                    '_blank' =>  __('Yes', 'cesis'),
                    '_self' =>  __('no', 'cesis'),
                 ),
                'default' => '_self'
            ),

            array(
            'id'        => 'cesis_blog_archive_animation',
            'type'      => 'select',
            'title'     => __('CSS Animation', 'cesis'),
            'subtitle'  => __('Select the animation', 'cesis'),
            'options'   => array(
                "none" => __("None", 'cesis') ,
                "bounceIn" => __("bounceIn", 'cesis') ,
                "bounceInDown" => __("bounceInDown", 'cesis') ,
                "bounceInLeft" => __("bounceInLeft", 'cesis') ,
                "bounceInRight" => __("bounceInRight", 'cesis') ,
                "bounceInUp" => __("bounceInUp", 'cesis') ,
                "fadeIn" => __("fadeIn", 'cesis') ,
                "fadeInDown" => __("fadeInDown", 'cesis') ,
                "fadeInDownBig" => __("fadeInDownBig", 'cesis') ,
                "fadeInLeft" => __("fadeInLeft", 'cesis') ,
                "fadeInLeftBig" => __("fadeInLeftBig", 'cesis') ,
                "fadeInRight" => __("fadeInRight", 'cesis') ,
                "fadeInRightBig" => __("fadeInRightBig", 'cesis') ,
                "fadeInUp" => __("fadeInUp", 'cesis') ,
                "fadeInUpBig" => __("fadeInUpBig", 'cesis') ,
                "flipInX" => __("flipInX", 'cesis') ,
                "flipInY" => __("flipInY", 'cesis') ,
                "lightSpeedIn" => __("lightSpeedIn", 'cesis') ,
                "rotateIn" => __("rotateIn", 'cesis') ,
                "rotateInDownLeft" => __("rotateInDownLeft", 'cesis') ,
                "rotateInDownRight" => __("rotateInDownRight", 'cesis') ,
                "rotateInUpLeft" => __("rotateInUpLeft", 'cesis') ,
                "rotateInUpRight" => __("rotateInUpRight", 'cesis') ,
                "rollIn" => __("rollIn", 'cesis') ,
                "zoomIn" => __("zoomIn", 'cesis') ,
                "zoomInDown" => __("zoomInDown", 'cesis') ,
                "zoomInLeft" => __("zoomInLeft", 'cesis') ,
                "zoomInRight" => __("zoomInRight", 'cesis') ,
                "zoomInUp" => __("zoomInUp", 'cesis') ,
                "slideInDown" => __("slideInDown", 'cesis') ,
                "slideInLeft" => __("slideInLeft", 'cesis') ,
                "slideInRight" => __("slideInRight", 'cesis') ,
                "slideInUp" => __("slideInUp", 'cesis') ,
                "top-to-bottom" => __("Top to Bottom", 'cesis') ,
                "bottom-to-top" => __("Bottom to Top", 'cesis') ,
                "left-to-right" => __("Left to Right", 'cesis') ,
                "right-to-left" => __("Right to Left", 'cesis') ,
                "appear" => __("Appear from center", 'cesis') ,


            ),
            'default'   => 'fadeIn'
            ),
                              array(
                                  'id'   => 'cesis_blog_archive_infobox_two',
                                  'type' => 'info',
                                  'style' => 'success',
                                  'desc' => __('Navigation settings.', 'cesis')
                                ),


                                array(
                                  'id'        => 'cesis_blog_archive_navigation_space',
                                  'type'     => 'dimensions',
                                  'width'     => false,
                                  'units'    => array('px'),
                                  'title'     => __('Select the navigation top space', 'cesis'),
                                  'default' => array(
                                    'height'   => '60px',
                                    'units' => 'px'
                                  ),


                                ),
                                array(
                                'id'        => 'cesis_blog_archive_navigation_style',
                                'type'      => 'select',
                                'title'     => __('Select the navigation style', 'cesis'),
                                'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                                //Must provide key => value pairs for select options
                                'options'   => array(
                                  "cesis_nav_style_0" => __("Small rounded square", 'cesis') ,
                        						"cesis_nav_style_1" => __("Small squared", 'cesis') ,
                        						 "cesis_nav_style_2" => __("Big squared", 'cesis'),
                        						"cesis_nav_style_3" => __("Rounded", 'cesis') ,
                        						"cesis_nav_style_4" => __("Text only", 'cesis') ,
                                ),
                                'default'   => 'cesis_nav_style_0'
                                ),

                                array(
                                'id'        => 'cesis_blog_archive_navigation_pos',
                                'type'      => 'select',
                                'title'     => __('Select the navigation style', 'cesis'),
                                'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                                //Must provide key => value pairs for select options
                                'options'   => array(
                                    "cesis_nav_justify" => __("Justify", 'cesis'),
                        						"cesis_nav_left" => __("Left", 'cesis'),
                        						"cesis_nav_center" => __("Center", 'cesis'),
                                    "cesis_nav_right" => __("Right", 'cesis') ,
                                ),
                                'default'   => 'cesis_nav_justify'
                                ),
  array(
      'id'   => 'cesis_blog_archive_infobox_prefooter',
      'type' => 'info',
      'style' => 'success',
      'desc' => __('Pre-footer settings.', 'cesis')
    ),
                    array(
                                'id'        => 'cesis_post_a_prefooter',
                                'type'      => 'button_set',
                                'title'     => __('Banner type', 'cesis'),
                                'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                                'options' => array(
                          'none' => __('No Banner', 'cesis'),
                          'content' => __('Content Block', 'cesis'),
                          'slider' => __('Slider Revolution', 'cesis'),
                          'layerslider' => __('LayerSlider', 'cesis'),
                       ),
                      'default' => 'none'
                  ),
                  array(
                                'id'        => 'cesis_post_a_pf_block_content',
                                'type'      => 'select',
                  						  'required'  => array('cesis_post_a_prefooter','=','content'),
                                'title'     => __('Select the Block content to use', 'cesis'),
                                'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                //Must provide key => value pairs for select options
                                'data'   => "content_block",
        						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                'default'   => ''
                  ),
                  array(
                                'id'        => 'cesis_post_a_pf_rev_slider',
                                'type'      => 'select',
                  						  'required'  => array('cesis_post_a_prefooter','=','slider'),
                                'title'     => __('Select the Slider revolution to use', 'cesis'),
                                'subtitle'  => __('You need to have at least one slider created', 'cesis'),
        			                  'options' => $rev_sliders,
                                'default'   => ''
                  ),
                  array(
                                'id'        => 'cesis_post_a_pf_layer_slider',
                                'type'      => 'select',
                                'required'  => array('cesis_post_a_prefooter','=','layerslider'),
                                'title'     => __('Select the Layerslider to use', 'cesis'),
                                'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                'options' => $layerslider_array,
                                'default'   => ''
                  ),
  array(
      'id'   => 'cesis_blog_archive_infobox_footer',
      'type' => 'info',
      'style' => 'success',
      'desc' => __('Footer settings.', 'cesis')
    ),
                  array(
                                'id'        => 'cesis_post_a_footer_fixed',
                                'type'      => 'button_set',
                                'title'     => __('Use fixed footer?', 'cesis'),
                                'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                                'options' => array(
        					        'cesis_fixed_footer' =>  __('Yes', 'cesis'),
        					        'no' =>  __('No', 'cesis'),
                       ),
                      'default' => 'no'
                  ),
                    array(
                                'id'        => 'cesis_post_a_footer',
                                'type'      => 'button_set',
                                'title'     => __('Display the Footer main area?', 'cesis'),
                                'subtitle'  => __('If you want to show the Footer top part ( widget space ) select yes.', 'cesis'),
                                'options' => array(
                          'yes' =>  __('Yes', 'cesis'),
                          'no' =>  __('No', 'cesis'),
                       ),
                      'default' => 'yes'
                  ),
                  array(
                              'id'        => 'cesis_post_a_footer_bar',
                              'type'      => 'button_set',
                              'title'     => __('Display the Footer under bar?', 'cesis'),
                              'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                              'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'yes'
                ),

                                )
                              )
                            );

                            Redux::setSection( $opt_name, array(
                                  'title'      => __( 'Portfolio', 'cesis' ),
                                  'desc'       => __( 'Portfolio archive settings', 'cesis' ),
                                    'id'         => 'tt-portfolio-archive',
                                    'subsection' => true,
                                    'fields'     => array(


                              array(
                                'id'   => 'cesis_portfolio_archive_infobox_header',
                                'type' => 'info',
                                'style' => 'success',
                                'desc' => __('Header settings.', 'cesis')
                              ),
                              array(
                                          'id'        => 'cesis_portfolio_a_topbar',
                                          'type'      => 'button_set',
                                          'title'     => __('Display the Header Top Bar?', 'cesis'),
                                          'subtitle'  => __('Select if you want to show the header top bar.', 'cesis'),
                                          'options' => array(
                                    'yes' =>  __('Yes', 'cesis'),
                                    'no' =>  __('No', 'cesis'),
                                 ),
                                'default' => 'no'
                            ),
                            array(
                                        'id'        => 'cesis_portfolio_a_header',
                                        'type'      => 'button_set',
                                        'title'     => __('Display the Header?', 'cesis'),
                                        'subtitle'  => __('Select if you want to show the header.', 'cesis'),
                                        'options' => array(
                                  'yes' =>  __('Yes', 'cesis'),
                                  'no' =>  __('No', 'cesis'),
                               ),
                              'default' => 'yes'
                          ),
                          array(
                                      'id'        => 'cesis_portfolio_a_header_transparent',
                                      'type'      => 'button_set',
                                      'title'     => __('Use Transparent Header?', 'cesis'),
                                      'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
                                      'options' => array(
                                'cesis_transparent_header' => __('Yes', 'cesis'),
                                'cesis_opaque_header' => __('No', 'cesis'),
                             ),
                            'default' => 'cesis_opaque_header'
                        ),
                          array(
                            'id'   => 'cesis_portfolio_archive_infobox_banner',
                            'type' => 'info',
                            'style' => 'success',
                            'desc' => __('Banner settings.', 'cesis')
                          ),
                          array(
                                      'id'        => 'cesis_portfolio_a_banner',
                                      'type'      => 'button_set',
                                      'title'     => __('Banner type', 'cesis'),
                                      'subtitle'  => __('Select the banner area type.', 'cesis'),
                                      'options' => array(
                                'none' => __('No Banner', 'cesis'),
                                'content' => __('Content Block', 'cesis'),
                                'slider' => __('Slider Revolution', 'cesis'),
                                'layerslider' => __('LayerSlider', 'cesis'),
                             ),
                            'default' => 'none'
                        ),
                        array(
                                    'id'        => 'cesis_portfolio_a_banner_pos',
                                    'type'      => 'button_set',
                                    'required'  => array('cesis_portfolio_a_banner','!=','none'),
                                    'title'     => __('Banner position', 'cesis'),
                                    'subtitle'  => __('Select the banner position.', 'cesis'),
                                    'options' => array(
                              'under' => __('Under Header', 'cesis'),
                              'above' => __('Above Header', 'cesis'),
                           ),
                          'default' => 'under'
                        ),
                        array(
                                      'id'        => 'cesis_portfolio_a_block_content',
                                      'type'      => 'select',
                                      'required'  => array('cesis_portfolio_a_banner','=','content'),
                                      'title'     => __('Select the Block content to use', 'cesis'),
                                      'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                      //Must provide key => value pairs for select options
                                      'data'   => "content_block",
                                            'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                      'default'   => ''
                        ),

                        array(
                                      'id'        => 'cesis_portfolio_a_rev_slider',
                                      'type'      => 'select',
                        						  'required'  => array('cesis_portfolio_a_banner','=','slider'),
                                      'title'     => __('Select the Slider revolution to use', 'cesis'),
                                      'subtitle'  => __('You need to have at least one slider created', 'cesis'),
              			                  'options' => $rev_sliders,
                                      'default'   => ''
                        ),
                        array(
                                      'id'        => 'cesis_portfolio_a_layer_slider',
                                      'type'      => 'select',
                                      'required'  => array('cesis_portfolio_a_banner','=','layerslider'),
                                      'title'     => __('Select the Layerslider to use', 'cesis'),
                                      'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                      'options' => $layerslider_array,
                                      'default'   => ''
                        ),
                              array(
                                'id'   => 'cesis_portfolio_archive_infobox_title',
                                'type' => 'info',
                                'style' => 'success',
                                'desc' => __('Title settings.', 'cesis')
                              ),
                              array(
                                  'id'        => 'cesis_portfolio_a_title',
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
                                        'id'   => 'cesis_portfolio_archive_infobox',
                                        'type' => 'info',
                                        'style' => 'success',
                                        'desc' => __('Layout settings.', 'cesis')
                                      ),

                                      array(
                                        'id'        => 'cesis_portfolio_archive_content_width',
                                        'type'     => 'dimensions',
                                        'height'     => false,
                                        'units'    => array('px','%'),
                                        'title'     => __('Select the page main content container width ( px or % )', 'cesis'),
                                        'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                                        'default' => array(
                                          'width'   => '1170px',
                                          'units' => 'px'
                                        ),
                                      ),
                                      array(
                                        'id'        => 'cesis_portfolio_archive_top_padding',
                                        'type'     => 'dimensions',
                                        'width'     => false,
                                        'units'    => array('px'),
                                        'title'     => __('Select the page main content top space ( top padding px )', 'cesis'),
                                        'default' => array(
                                          'height'   => '60px',
                                          'units' => 'px'
                                        ),
                                      ),
                                      array(
                                        'id'        => 'cesis_portfolio_archive_bottom_padding',
                                        'type'     => 'dimensions',
                                        'width'     => false,
                                        'units'    => array('px'),
                                        'title'     => __('Select the page main content bottom space ( bottom padding px )', 'cesis'),
                                        'default' => array(
                                          'height'   => '60px',
                                          'units' => 'px'
                                        ),


                                      ),
                                      array(
                                        'id'       => 'cesis_portfolio_archive_layout',
                                        'type'     => 'image_select',
                                        'title'    => __('Select the page layout', 'cesis'),
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
                                          'id' => 'cesis_portfolio_archive_sidebar_select',
                                          'title' => __('Sidebar', 'cesis'),
                                          'desc' => 'Please select the sidebar for the archive.',
                                          'type' => 'select',
                                          'data' => 'sidebars',
                                          'required'  => array(
                                                array('cesis_portfolio_archive_layout','not','no_sidebar'),
                                          ),
                                          'default' => 'None'
                                        ),
                                        array(
                                          'id'   => 'cesis_portfolio_archive_infobox_one',
                                          'type' => 'info',
                                          'style' => 'success',
                                          'desc' => __('Style settings.', 'cesis')
                                        ),

                                        array(
                                        'id'        => 'cesis_portfolio_archive_type',
                                        'type'      => 'select',
                                        'title'     => __('portfolio type', 'cesis'),
                                        'subtitle'  => __('Select the portfolio type.', 'cesis'),
                                        //Must provide key => value pairs for select options
                                        'options'   => array(

                                						"isotope_grid" => __("Isotope Grid", 'cesis') ,
                                						 "isotope_masonry" => __("Isotope Masonry", 'cesis'),
                                						"isotope_packery" => __("Isotope Packery", 'cesis') ,
                                        ),
                                        'default'   => 'isotope_grid'
                                        ),

                                        array(
                                        'id'        => 'cesis_portfolio_archive_style_ig',
                                        'type'      => 'select',
                                        'title'     => __('portfolio Style', 'cesis'),
                                        'subtitle'  => __('Select portfolio Style ( design )', 'cesis'),
                                        'required'  => array(
                                              array('cesis_portfolio_archive_type','=','isotope_grid'),
                                        ),
                                        //Must provide key => value pairs for select options
                                        'options'   => array(

                                						"cesis_portfolio_style_1" => __("Standard 1", 'cesis') ,
                                            "cesis_portfolio_style_2" => __("Standard 2", 'cesis') ,
                                            "cesis_portfolio_style_3" => __("Standard 3 ( centered text )", 'cesis') ,
                                            "cesis_portfolio_style_4" => __("Boxed 1", 'cesis') ,
                                            "cesis_portfolio_style_5" => __("Boxed 2", 'cesis') ,
                                            "cesis_portfolio_style_6" => __("Boxed 3 ( centered text )", 'cesis') ,
                                            "cesis_portfolio_style_12" => __("Boxed 4 ( Lateral )", 'cesis'),
                                            "cesis_portfolio_style_13" => __("Boxed 5 ( Lateral Odd and Even )", 'cesis'),
                                            "cesis_portfolio_style_7" => __("On image 1", 'cesis') ,
                                            "cesis_portfolio_style_8" => __("On image 2", 'cesis') ,
                                            "cesis_portfolio_style_9" => __("On image 3", 'cesis') ,
                                            "cesis_portfolio_style_10" => __("On image 4", 'cesis') ,
                                            "cesis_portfolio_style_11" => __("On image 5", 'cesis') ,
                                        ),
                                        'default'   => 'cesis_portfolio_style_1'
                                        ),

                                        array(
                                        'id'        => 'cesis_portfolio_archive_style_im',
                                        'type'      => 'select',
                                        'title'     => __('portfolio Style', 'cesis'),
                                        'subtitle'  => __('Select portfolio Style ( design )', 'cesis'),
                                        'required'  => array(
                                              array('cesis_portfolio_archive_type','=','isotope_masonry'),
                                        ),
                                        //Must provide key => value pairs for select options
                                        'options'   => array(

                                						"cesis_portfolio_style_1" => __("Standard 1", 'cesis') ,
                                            "cesis_portfolio_style_2" => __("Standard 2", 'cesis') ,
                                            "cesis_portfolio_style_3" => __("Standard 3 ( centered text )", 'cesis') ,
                                            "cesis_portfolio_style_4" => __("Boxed 1", 'cesis') ,
                                            "cesis_portfolio_style_5" => __("Boxed 2", 'cesis') ,
                                            "cesis_portfolio_style_6" => __("Boxed 3 ( centered text )", 'cesis') ,
                                            "cesis_portfolio_style_12" => __("Boxed 4 ( Lateral )", 'cesis'),
                                            "cesis_portfolio_style_13" => __("Boxed 5 ( Lateral Odd and Even )", 'cesis'),
                                        ),
                                        'default'   => 'cesis_portfolio_style_1'
                                        ),

                                        array(
                                        'id'        => 'cesis_portfolio_archive_stye_ip',
                                        'type'      => 'select',
                                        'title'     => __('portfolio Style', 'cesis'),
                                        'subtitle'  => __('Select portfolio Style ( design )', 'cesis'),
                                        'required'  => array(
                                              array('cesis_portfolio_archive_type','=','isotope_packery'),
                                        ),
                                        //Must provide key => value pairs for select options
                                        'options'   => array(
                                          "cesis_portfolio_style_7" => __("On image 1", 'cesis') ,
                                          "cesis_portfolio_style_8" => __("On image 2", 'cesis') ,
                                          "cesis_portfolio_style_9" => __("On image 3", 'cesis') ,
                                          "cesis_portfolio_style_10" => __("On image 4", 'cesis') ,
                                          "cesis_portfolio_style_11" => __("On image 5", 'cesis') ,
                                        ),
                                        'default'   => 'cesis_portfolio_style_7'
                                        ),

                                        array(
                                        'id'        => 'cesis_portfolio_archive_hover',
                                        'type'      => 'select',
                                        'title'     => __('Hover effect', 'cesis'),
                                        'subtitle'  => __('Select the hover effect you want to use.', 'cesis'),
                                        //Must provide key => value pairs for select options
                                        'options'   => array(
                                            "none" => __("None", 'cesis') ,
                                            "cesis_hover_overlay" => __("Colored Overlay", 'cesis') ,
                                            "cesis_hover_icon" => __("Zoom and Link icon", 'cesis') ,
                                            "cesis_hover_fade" => __("Content Fade in ( On image style only )", 'cesis') ,
                                            "cesis_hover_fade_out" => __("Content Fade Out ( On image style only )", 'cesis') ,
                                            "cesis_hover_slide" => __("Content Slide in ( On image style only )", 'cesis') ,
                                            "cesis_hover_slide_out" => __("Content Slide Out ( On image style only )", 'cesis') ,
                                        ),
                                        'default'   => 'none'
                                        ),

                                        array(
                                                          'id'        => 'cesis_portfolio_archive_hover_color',
                                                          'type'      => 'color_rgba',
                                                          'title'     => __('Hover Color', 'cesis'),
                                                          'subtitle'  => __('Choose the hover color ( optional )', 'cesis'),
                                                          'required'  => array(
                                                                array('cesis_portfolio_archive_hover','not','cesis_hover_fade'),
                                                                array('cesis_portfolio_archive_hover','not','cesis_hover_fade_out'),
                                                                array('cesis_portfolio_archive_hover','not','cesis_hover_slide'),
                                                                array('cesis_portfolio_archive_hover','not','cesis_hover_slide_out'),
                                                                array('cesis_portfolio_archive_hover','not','none'),
                                                          ),
                                                          'default'   => array(
                                                            'color'     => '#000000',
                                                            'alpha'     => '0.25',
                                                            'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.25' ),
                                                          ),
                                            						'options'       => array(
                                            					        'clickout_fires_change'     => true,
                                            						),
                                        ),

                                        array(
                                        'id'        => 'cesis_portfolio_archive_effect',
                                        'type'      => 'select',
                                        'title'     => __('Additional effect', 'cesis'),
                                        'subtitle'  => __('Select the additional effect you want to use.', 'cesis'),
                                        //Must provide key => value pairs for select options
                                        'options'   => array(
                                            "none" => __("None", 'cesis') ,
                                            "cesis_effect_shadow" => __("Shadow", 'cesis') ,
                                            "cesis_effect_zoomIn" => __("Image Zoom In", 'cesis') ,
                                            "cesis_effect_zoomOut" => __("Image Zoom Out", 'cesis') ,
                                            "cesis_effect_color" => __("Add Color", 'cesis') ,
                                            "cesis_effect_decolor" => __("Remove Color", 'cesis') ,
                                            "cesis_effect_frame" => __("White frame ( On image style only )", 'cesis') ,
                                        ),
                                        'default'   => 'none'
                                        ),

                                        array(
                                                    'id'        => 'cesis_portfolio_archive_force_font',
                                                    'type'      => 'button_set',
                                                    'title'     => __('Font style', 'cesis'),
                                                    'subtitle'  => __('Select the font style to use.', 'cesis'),
                                                    'options' => array(
                                                      'no' =>  __('Theme default', 'cesis'),
                                                      'force_font' =>  __('Demo Pre-set', 'cesis'),
                                                      'custom' =>  __('Custom', 'cesis'),
                                           ),
                                          'default' => 'no'
                                      ),
                                     array(
                          						'id'          => 'cesis_portfolio_archive_heading_font',
                          					    'type'        => 'typography',
                                                  'title'     => __('Heading font', 'cesis'),
                                                  'subtitle'  => __('Select the font to use.', 'cesis'),
                                                  'required'  => array(
                                                        array('cesis_portfolio_archive_force_font','contains','custom'),
                                                  ),
                          					    'google'      => true,
                          					    'font-backup' => true,
                          					    'color' => false,
                          					    'units'       =>'px',
                          						'line-height' => true,
                          						'text-align' => false,
                          						'letter-spacing' => true,
                          						'text-transform' => true,
                          						'fonts' => array(
                          				            "Aileron"					                           => "Aileron",
                          				            "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                          				            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                          				            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                          				            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                          				            "Courier, monospace"                                   => "Courier, monospace",
                          				            "Garamond, serif"                                      => "Garamond, serif",
                          				            "Georgia, serif"                                       => "Georgia, serif",
                          				            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                          					        "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                          				            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                          				            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                          				            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                          				            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                          				            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                          				            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                          				            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                          				            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
                                  				),
                          					    'default'     => array(
                          					        'font-weight'  => '500',
                          					        'font-family' => 'Roboto',
                          					        'google'      => true,
                          					        'font-size'   => '14px',
                          					        'line-height'   => '24px',
                          					        'text-transform'   => 'uppercase',
                          							'letter-spacing' => '1',
                          					    ),
                          				   ),
                                    array(
                                     'id'          => 'cesis_portfolio_archive_text_font',
                                       'type'        => 'typography',
                                                 'title'     => __('Text font', 'cesis'),
                                                 'subtitle'  => __('Select the font to use.', 'cesis'),
                                                 'required'  => array(
                                                       array('cesis_portfolio_archive_force_font','contains','custom'),
                                                 ),
                                       'google'      => true,
                                       'font-backup' => true,
                                       'color' => false,
                                       'units'       =>'px',
                                     'line-height' => true,
                                     'text-align' => false,
                                     'letter-spacing' => true,
                                     'text-transform' => true,
                                     'fonts' => array(
                                             "Aileron"					                           => "Aileron",
                                             "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                                             "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                                             "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                                             "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                                             "Courier, monospace"                                   => "Courier, monospace",
                                             "Garamond, serif"                                      => "Garamond, serif",
                                             "Georgia, serif"                                       => "Georgia, serif",
                                             "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                                           "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                                             "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                                             "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                                             "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                                             "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                                             "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                                             "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                                             "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                                             "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
                                         ),
                                       'default'     => array(
                                           'font-weight'  => '400',
                                           'font-family' => 'Roboto',
                                           'google'      => true,
                                           'font-size'   => '14px',
                                           'line-height'   => '24px',
                                           'text-transform'   => 'none',
                                       'letter-spacing' => '0',
                                       ),
                                    ),

                                      array(
                                      'id'        => 'cesis_portfolio_archive_thumbnail_size',
                                      'type'      => 'select',
                                      'title'     => __('Thumbnail size', 'cesis'),
                                      'subtitle'  => __('Select the posts thumbnail size', 'cesis'),
                                      'required'  => array(
                                            array('cesis_portfolio_archive_type','contains','grid'),
                                      ),
                                      //Must provide key => value pairs for select options
                                      'options'   => array(
                                          "tn_squared" => __("1:1 ( squared )", 'cesis') ,
                                          "tn_rectangle_4_3" => __("4:3  ( rectangle )", 'cesis') ,
                                          "tn_rectangle_3_2" => __("3:2  ( rectangle )", 'cesis') ,
                                          "tn_landscape_16_9" => __("16:9 ( landscape )", 'cesis') ,
                                          "tn_landscape_21_9" => __("21:9 ( landscape )", 'cesis') ,
                                          "tn_portrait_3_4" => __("3:4 ( portrait )", 'cesis') ,
                                          "tn_portrait_2_3" => __("2:3 ( portrait )", 'cesis') ,
                                          "tn_portrait_9_16" => __("9:16 ( portrait )", 'cesis') ,
                                      ),
                                      'default'   => 'tn_rectangle_3_2'
                                      ),

                                      array(
                                      'id'        => 'cesis_portfolio_archive_packery_type',
                                      'type'      => 'select',
                                      'title'     => __('Packery Type', 'cesis'),
                                      'subtitle'  => __('Select the packery image ratio', 'cesis'),
                                      'required'  => array(
                                            array('cesis_portfolio_archive_type','contains','packery'),
                                      ),
                                      //Must provide key => value pairs for select options
                                      'options'   => array(
                                          "squared" => __("Squared", 'cesis') ,
                                          "rectangle" => __("Rectangle", 'cesis') ,
                                      ),
                                      'default'   => 'squared'
                                      ),

                                      array(
                                      'id'        => 'cesis_portfolio_archive_col',
                                      'type'      => 'select',
                                      'title'     => __('Number of items per line?', 'cesis'),
                                      'subtitle'  => __('Select the number of posts to show per line.', 'cesis'),
                                      //Must provide key => value pairs for select options
                                      'options'   => array(
                            						"1" => "1",
                            						"2" => "2",
                            						"3" => "3",
                            						"4" => "4",
                            						"5" => "5",
                            						"6" => "6",
                                      ),
                                      'default'   => '1'
                                      ),
                                      array(
                                              'id'        => 'cesis_portfolio_archive_padding',
                                              'type'      => 'text',
                                              'title'     => __('Choose the space between the items', 'cesis'),
                                              'subtitle'  => __('Select the space between the items, default 30.', 'cesis'),
                                              'validate'  => 'numeric',
                                              'default'   => '30',
                                      ),
                                      array(
                                        'id'        => 'cesis_portfolio_archive_inner_padding_ig',
                                        'type'      => 'text',
                                        'title'     => __('Choose the inner space, use % or px', 'cesis'),
                                        'subtitle'  => __('Select the inner space, default 10%.', 'cesis'),
                                        'required'  => array(
                                              array('cesis_portfolio_archive_style_ig','not','cesis_portfolio_style_1'),
                                              array('cesis_portfolio_archive_style_ig','not','cesis_portfolio_style_2'),
                                              array('cesis_portfolio_archive_style_ig','not','cesis_portfolio_style_3'),
                                              array('cesis_portfolio_archive_style_ig','not','cesis_portfolio_style_4'),
                                              array('cesis_portfolio_archive_style_ig','not','cesis_portfolio_style_5'),
                                              array('cesis_portfolio_archive_style_ig','not','cesis_portfolio_style_6'),
                                              array('cesis_portfolio_archive_style_ig','not','cesis_portfolio_style_7'),
                                              array('cesis_portfolio_archive_style_ig','not','cesis_portfolio_style_8'),
                                        ),
                                        'validate'  => 'html',
                                        'default'   => '10%',
                                      ),
                                      array(
                                        'id'        => 'cesis_portfolio_archive_inner_padding_ip',
                                        'type'      => 'text',
                                        'title'     => __('Choose the inner space, use % or px', 'cesis'),
                                        'subtitle'  => __('Select the inner space, default 10%.', 'cesis'),
                                        'required'  => array(
                                              array('cesis_portfolio_archive_type','contains','packery'),
                                        ),
                                        'validate'  => 'html',
                                        'default'   => '10%',
                                      ),

                                    array(
                                                'id'        => 'cesis_portfolio_archive_i_date',
                                                'type'      => 'button_set',
                                                'title'     => __('Show date?', 'cesis'),
                                                'subtitle'  => __('Select if you want to show the date.', 'cesis'),
                                                'options' => array(
                                          'yes' =>  __('Yes', 'cesis'),
                                          'no' =>  __('No', 'cesis'),
                                       ),
                                      'default' => 'no'
                                  ),

                                  array(
                                              'id'        => 'cesis_portfolio_archive_i_category',
                                              'type'      => 'button_set',
                                              'title'     => __('Show categories?', 'cesis'),
                                              'subtitle'  => __('Select if you want to show the categories.', 'cesis'),
                                              'options' => array(
                                        'yes' =>  __('Yes', 'cesis'),
                                        'no' =>  __('No', 'cesis'),
                                     ),
                                    'default' => 'no'
                                ),

                                array(
                                            'id'        => 'cesis_portfolio_archive_i_tag',
                                            'type'      => 'button_set',
                                            'title'     => __('Show tags?', 'cesis'),
                                            'subtitle'  => __('Select if you want to show the tags.', 'cesis'),
                                            'options' => array(
                                      'yes' =>  __('Yes', 'cesis'),
                                      'no' =>  __('No', 'cesis'),
                                   ),
                                  'default' => 'no'
                              ),

                              array(
                                          'id'        => 'cesis_portfolio_archive_i_comment',
                                          'type'      => 'button_set',
                                          'title'     => __('Show comment number?', 'cesis'),
                                          'subtitle'  => __('Select if you want to show the comment number.', 'cesis'),
                                          'options' => array(
                                    'yes' =>  __('Yes', 'cesis'),
                                    'no' =>  __('No', 'cesis'),
                                 ),
                                'default' => 'no'
                            ),

                            array(
                                        'id'        => 'cesis_portfolio_archive_i_like',
                                        'type'      => 'button_set',
                                        'title'     => __('Show like icon?', 'cesis'),
                                        'subtitle'  => __('Select if you want to show the like icon.', 'cesis'),
                                        'options' => array(
                                  'yes' =>  __('Yes', 'cesis'),
                                  'no' =>  __('No', 'cesis'),
                               ),
                              'default' => 'no'
                          ),

                          array(
                                      'id'        => 'cesis_portfolio_archive_i_text',
                                      'type'      => 'button_set',
                                      'title'     => __('Show text?', 'cesis'),
                                      'subtitle'  => __('Select if you want to show the portfolio post text.', 'cesis'),
                                      'options' => array(
                                'yes' =>  __('Yes', 'cesis'),
                                'no' =>  __('No', 'cesis'),
                             ),
                            'default' => 'no'
                        ),

                        array(
                        'id'        => 'cesis_portfolio_archive_text_source',
                        'type'      => 'select',
                        'title'     => __('Select text source', 'cesis'),
                        'subtitle'  => __('Select the text source ( if the description isn\'t set the content will be used instead ).', 'cesis'),
                        'required'  => array(
                              array('cesis_portfolio_archive_i_text','=','yes'),
                        ),
                        //Must provide key => value pairs for select options
                        'options'   => array(
                            "description" => __("description", 'cesis') ,
                            "content" => __("Content", 'cesis') ,
                        ),
                        'default'   => 'description'
                        ),
                        array(
                                'id'        => 'cesis_portfolio_archive_char_length',
                                'type'      => 'text',
                                'title'     => __('Number of Characters to show', 'cesis'),
                                'subtitle'  => __('Select the number of charachters to show ( leave blank to show full post content )', 'cesis'),
                                'required'  => array(
                                      array('cesis_portfolio_archive_i_text','=','yes'),
                                ),
                                'validate'  => 'numeric',
                                'default'   => '150',
                        ),

                        array(
                                    'id'        => 'cesis_portfolio_archive_read_more',
                                    'type'      => 'button_set',
                                    'title'     => __('Show read more link?', 'cesis'),
                                    'subtitle'  => __('Select if you want to show the read more link.', 'cesis'),
                                    'options' => array(
                              'yes' =>  __('Yes', 'cesis'),
                              'no' =>  __('No', 'cesis'),
                           ),
                          'default' => 'no'
                      ),

                      array(
                      'id'        => 'cesis_portfolio_archive_read_more_style',
                      'type'      => 'select',
                      'title'     => __('Read more link style', 'cesis'),
                      'subtitle'  => __('Select the read more link style.', 'cesis'),
                      'required'  => array(
                            array('cesis_portfolio_archive_read_more','=','yes'),
                      ),
                      'options'   => array(
                          "text" => __("Text only", 'cesis') ,
                          "button_rm" => __("Button", 'cesis') ,
                      ),
                      'default'   => 'text'
                      ),

                      array(
                      'id'        => 'cesis_portfolio_archive_rm_t_font',
                      'type'      => 'select',
                      'title'     => __('Read more text font family', 'cesis'),
                      'subtitle'  => __('Select the read more font family ( from the one set in the theme option ).', 'cesis'),
                      'required'  => array(
                            array('cesis_portfolio_archive_read_more_style','=','text'),
                      ),
                      'options'   => array(
                          "main_font" => __("Main font", 'cesis') ,
                          "alt_font" => __("Alternative font", 'cesis') ,
                      ),
                      'default'   => 'main_font'
                      ),

                      array(
                      'id'        => 'cesis_portfolio_archive_rm_t_f_weight',
                      'type'      => 'select',
                      'title'     => __('Read more text font weight', 'cesis'),
                      'subtitle'  => __('Select the read more text font weight.', 'cesis'),
                      'required'  => array(
                            array('cesis_portfolio_archive_read_more_style','=','text'),
                      ),
                      'options'   => array(
                          "100" => __("100 ( thin )", 'cesis') ,
                          "300" => __("300 ( light )", 'cesis') ,
                          "400" => __("400 ( normal )", 'cesis') ,
                          "500" => __("500 ( normal bold )", 'cesis') ,
                          "600" => __("600 ( semi bold )", 'cesis') ,
                          "700" => __("700 ( bold )", 'cesis') ,
                          "900" => __("900 ( extra bold )", 'cesis') ,
                      ),
                      'default'   => '400'
                      ),

                      array(
                      'id'        => 'cesis_portfolio_archive_rm_t_t_transform',
                      'type'      => 'select',
                      'title'     => __('Read more text transform', 'cesis'),
                      'subtitle'  => __('Select the read more text capitalization.', 'cesis'),
                      'required'  => array(
                            array('cesis_portfolio_archive_read_more_style','=','text'),
                      ),
                      'options'   => array(
                          "none" => __("None", 'cesis') ,
                          "uppercase" => __("Uppercase", 'cesis') ,
                          "lowercase" => __("Lowercase", 'cesis') ,
                      ),
                      'default'   => 'none'
                      ),

                      array(
                      'id'        => 'cesis_portfolio_archive_rm_t_l_spacing',
                      'type'      => 'text',
                      'title'     => __('Read more text letter spacing', 'cesis'),
                      'subtitle'  => __('Select the read more text letter spacing ( optional ) eg : 1', 'cesis'),
                      'required'  => array(
                            array('cesis_portfolio_archive_read_more_style','=','text'),
                      ),
                      'validate'  => 'numeric',
                      'default'   => '0',
                      ),

                      array(
                      'id'        => 'cesis_portfolio_archive_read_more_button_style',
                      'type'      => 'select',
                      'title'     => __('Read more button style', 'cesis'),
                      'subtitle'  => __('Select the color scheme you want to use for the read more button', 'cesis'),
                      'required'  => array(
                            array('cesis_portfolio_archive_read_more_style','=','button_rm'),
                      ),
                      'options'   => array(
                          "cesis_btn" => __("Cesis First button color settings", 'cesis') ,
                          "cesis_alt_btn" => __("Cesis Second button color settings", 'cesis') ,
                          "cesis_sub_btn" => __("Cesis Third button color settings", 'cesis') ,
                          "custom" => __("Custom color", 'cesis') ,
                      ),
                      'default'   => 'cesis_btn'
                      ),

                      array(
                                        'id'        => 'cesis_portfolio_archive_rm_t_color',
                                        'type'      => 'color',
                                        'title'     => __('Button Text Color', 'cesis'),
                                        'subtitle'  => __('Choose the button text color', 'cesis'),
                                        'required'  => array(
                                              array('cesis_portfolio_archive_read_more_button_style','=','custom'),
                                        ),
                                        'default'   => '#6d7783',
                                        'validate'  => 'color',
                      ),

                      array(
                                        'id'        => 'cesis_portfolio_archive_rm_bg_color',
                                        'type'      => 'color',
                                        'title'     => __('Button Background Color', 'cesis'),
                                        'subtitle'  => __('Choose the button background color', 'cesis'),
                                        'required'  => array(
                                              array('cesis_portfolio_archive_read_more_button_style','=','custom'),
                                        ),
                                        'default'   => '#f4f4f4',
                                        'validate'  => 'color',
                      ),

                      array(
                                        'id'        => 'cesis_portfolio_archive_rm_b_color',
                                        'type'      => 'color',
                                        'title'     => __('Button Border Color', 'cesis'),
                                        'subtitle'  => __('Choose the button border color', 'cesis'),
                                        'required'  => array(
                                              array('cesis_portfolio_archive_read_more_button_style','=','custom'),
                                        ),
                                        'default'   => '#ececec',
                                        'validate'  => 'color',
                      ),

                      array(
                                        'id'        => 'cesis_portfolio_archive_rm_ht_color',
                                        'type'      => 'color',
                                        'title'     => __('Button hover Text Color', 'cesis'),
                                        'subtitle'  => __('Choose the button hover text color', 'cesis'),
                                        'required'  => array(
                                              array('cesis_portfolio_archive_read_more_button_style','=','custom'),
                                        ),
                                        'default'   => '#ffffff',
                                        'validate'  => 'color',
                      ),

                      array(
                                        'id'        => 'cesis_portfolio_archive_rm_hbg_color',
                                        'type'      => 'color',
                                        'title'     => __('Button hover Background Color', 'cesis'),
                                        'subtitle'  => __('Choose the button hover background color', 'cesis'),
                                        'required'  => array(
                                              array('cesis_portfolio_archive_read_more_button_style','=','custom'),
                                        ),
                                        'default'   => '#3a78ff',
                                        'validate'  => 'color',
                      ),

                      array(
                                        'id'        => 'cesis_portfolio_archive_rm_hb_color',
                                        'type'      => 'color',
                                        'title'     => __('Button hover Border Color', 'cesis'),
                                        'subtitle'  => __('Choose the button hover border color', 'cesis'),
                                        'required'  => array(
                                              array('cesis_portfolio_archive_read_more_button_style','=','custom'),
                                        ),
                                        'default'   => '#3a78ff',
                                        'validate'  => 'color',
                      ),

                      array(
                      'id'        => 'cesis_portfolio_archive_rm_font',
                      'type'      => 'select',
                      'title'     => __('Button font family', 'cesis'),
                      'subtitle'  => __('Select the button font family ( from the one set in the theme option ).', 'cesis'),
                      'required'  => array(
                            array('cesis_portfolio_archive_read_more_button_style','=','custom'),
                      ),
                      'options'   => array(
                          "main_font" => __("Main font", 'cesis') ,
                          "alt_font" => __("Alternative font", 'cesis') ,
                      ),
                      'default'   => 'main_font'
                      ),

                      array(
                      'id'        => 'cesis_portfolio_archive_rm_f_size',
                      'type'      => 'text',
                      'title'     => __('Button font size', 'cesis'),
                      'subtitle'  => __('Select the button font size', 'cesis'),
                      'required'  => array(
                            array('cesis_portfolio_archive_read_more_button_style','=','custom'),
                      ),
                      'validate'  => 'numeric',
                      'default'   => '14',
                      ),

                      array(
                      'id'        => 'cesis_portfolio_archive_rm_f_weight',
                      'type'      => 'select',
                      'title'     => __('Button font weight', 'cesis'),
                      'subtitle'  => __('Select the button font weight.', 'cesis'),
                      'required'  => array(
                            array('cesis_portfolio_archive_read_more_button_style','=','custom'),
                      ),
                      'options'   => array(
                          "100" => __("100 ( thin )", 'cesis') ,
                          "300" => __("300 ( light )", 'cesis') ,
                          "400" => __("400 ( normal )", 'cesis') ,
                          "500" => __("500 ( normal bold )", 'cesis') ,
                          "600" => __("600 ( semi bold )", 'cesis') ,
                          "700" => __("700 ( bold )", 'cesis') ,
                          "900" => __("900 ( extra bold )", 'cesis') ,
                      ),
                      'default'   => '400'
                      ),

                      array(
                      'id'        => 'cesis_portfolio_archive_rm_t_transform',
                      'type'      => 'select',
                      'title'     => __('Button text transform', 'cesis'),
                      'subtitle'  => __('Select the button text capitalization.', 'cesis'),
                      'required'  => array(
                            array('cesis_portfolio_archive_read_more_button_style','=','custom'),
                      ),
                      'options'   => array(
                          "none" => __("None", 'cesis') ,
                          "uppercase" => __("Uppercase", 'cesis') ,
                          "lowercase" => __("Lowercase", 'cesis') ,
                      ),
                      'default'   => 'none'
                      ),

                      array(
                      'id'        => 'cesis_portfolio_archive_rm_l_spacing',
                      'type'      => 'text',
                      'title'     => __('Button letter spacing', 'cesis'),
                      'subtitle'  => __('Select the button text letter spacing ( optional ) eg : 1', 'cesis'),
                      'required'  => array(
                            array('cesis_portfolio_archive_read_more_button_style','=','custom'),
                      ),
                      'validate'  => 'numeric',
                      'default'   => '0',
                      ),

                      array(
                      'id'        => 'cesis_portfolio_archive_rm_b_size',
                      'type'      => 'select',
                      'title'     => __('Read more button size', 'cesis'),
                      'subtitle'  => __('Select the read more button size', 'cesis'),
                      'required'  => array(
                            array('cesis_portfolio_archive_read_more_style','=','button_rm'),
                      ),
                      'options'   => array(
                          "read_more_small" => __("Small", 'cesis') ,
                          "read_more_medium" => __("Medium", 'cesis') ,
                          "read_more_large" => __("Large", 'cesis') ,
                      ),
                      'default'   => 'read_more_small'
                      ),

                      array(
                      'id'        => 'cesis_portfolio_archive_rm_b_radius',
                      'type'      => 'text',
                      'title'     => __('Border Radius (optional)', 'cesis'),
                      'subtitle'  => __('Select the button border radius ( optional ) eg : 10', 'cesis'),
                      'required'  => array(
                            array('cesis_portfolio_archive_read_more_button_style','=','custom'),
                      ),
                      'validate'  => 'numeric',
                      'default'   => '0',
                      ),

                      array(
                      'id'        => 'cesis_portfolio_archive_rm_shape',
                      'type'      => 'select',
                      'title'     => __('Read more button shape', 'cesis'),
                      'subtitle'  => __('Select the button shape', 'cesis'),
                      'required'  => array(
                            array('cesis_portfolio_archive_read_more_button_style','not','custom'),
                      ),
                      'options'   => array(
                          "cesis_btn_squared" => __("Squared", 'cesis') ,
                          "cesis_btn_rounded" => __("Rounded", 'cesis') ,
                      ),
                      'default'   => 'cesis_btn_squared'
                      ),

                      array(
                                  'id'        => 'cesis_portfolio_archive_target',
                                  'type'      => 'button_set',
                                  'title'     => __('Open link in a new page?', 'cesis'),
                                  'subtitle'  => __('Select if you want the posts link to open in a new page.', 'cesis'),
                                  'options' => array(
                            '_blank' =>  __('Yes', 'cesis'),
                            '_self' =>  __('no', 'cesis'),
                         ),
                        'default' => '_self'
                    ),

                    array(
                    'id'        => 'cesis_portfolio_archive_animation',
                    'type'      => 'select',
                    'title'     => __('CSS Animation', 'cesis'),
                    'subtitle'  => __('Select the animation', 'cesis'),
                    'options'   => array(
                        "none" => __("None", 'cesis') ,
                        "bounceIn" => __("bounceIn", 'cesis') ,
                        "bounceInDown" => __("bounceInDown", 'cesis') ,
                        "bounceInLeft" => __("bounceInLeft", 'cesis') ,
                        "bounceInRight" => __("bounceInRight", 'cesis') ,
                        "bounceInUp" => __("bounceInUp", 'cesis') ,
                        "fadeIn" => __("fadeIn", 'cesis') ,
                        "fadeInDown" => __("fadeInDown", 'cesis') ,
                        "fadeInDownBig" => __("fadeInDownBig", 'cesis') ,
                        "fadeInLeft" => __("fadeInLeft", 'cesis') ,
                        "fadeInLeftBig" => __("fadeInLeftBig", 'cesis') ,
                        "fadeInRight" => __("fadeInRight", 'cesis') ,
                        "fadeInRightBig" => __("fadeInRightBig", 'cesis') ,
                        "fadeInUp" => __("fadeInUp", 'cesis') ,
                        "fadeInUpBig" => __("fadeInUpBig", 'cesis') ,
                        "flipInX" => __("flipInX", 'cesis') ,
                        "flipInY" => __("flipInY", 'cesis') ,
                        "lightSpeedIn" => __("lightSpeedIn", 'cesis') ,
                        "rotateIn" => __("rotateIn", 'cesis') ,
                        "rotateInDownLeft" => __("rotateInDownLeft", 'cesis') ,
                        "rotateInDownRight" => __("rotateInDownRight", 'cesis') ,
                        "rotateInUpLeft" => __("rotateInUpLeft", 'cesis') ,
                        "rotateInUpRight" => __("rotateInUpRight", 'cesis') ,
                        "rollIn" => __("rollIn", 'cesis') ,
                        "zoomIn" => __("zoomIn", 'cesis') ,
                        "zoomInDown" => __("zoomInDown", 'cesis') ,
                        "zoomInLeft" => __("zoomInLeft", 'cesis') ,
                        "zoomInRight" => __("zoomInRight", 'cesis') ,
                        "zoomInUp" => __("zoomInUp", 'cesis') ,
                        "slideInDown" => __("slideInDown", 'cesis') ,
                        "slideInLeft" => __("slideInLeft", 'cesis') ,
                        "slideInRight" => __("slideInRight", 'cesis') ,
                        "slideInUp" => __("slideInUp", 'cesis') ,
                        "top-to-bottom" => __("Top to Bottom", 'cesis') ,
                        "bottom-to-top" => __("Bottom to Top", 'cesis') ,
                        "left-to-right" => __("Left to Right", 'cesis') ,
                        "right-to-left" => __("Right to Left", 'cesis') ,
                        "appear" => __("Appear from center", 'cesis') ,


                    ),
                    'default'   => 'none'
                    ),




                                        array(
                                          'id'   => 'cesis_portfolio_archive_infobox_two',
                                          'type' => 'info',
                                          'style' => 'success',
                                          'desc' => __('Navigation settings.', 'cesis')
                                        ),
                                        array(
                                        'id'        => 'cesis_portfolio_archive_navigation_space',
                                        'type'     => 'dimensions',
                                        'width'     => false,
                                        'units'    => array('px'),
                                        'title'     => __('Select the navigation top space', 'cesis'),
                                        'default' => array(
                                          'height'   => '60px',
                                          'units' => 'px'
                                          ),
                                        ),


                                        array(
                                        'id'        => 'cesis_portfolio_archive_navigation_style',
                                        'type'      => 'select',
                                        'title'     => __('Select the navigation style', 'cesis'),
                                        'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                                        //Must provide key => value pairs for select options
                                        'options'   => array(
                        						        "cesis_nav_style_0" => __("Small rounded square", 'cesis') ,
                                						"cesis_nav_style_1" => __("Small squared", 'cesis') ,
                                						 "cesis_nav_style_2" => __("Big squared", 'cesis'),
                                						"cesis_nav_style_3" => __("Rounded", 'cesis') ,
                                						"cesis_nav_style_4" => __("Text only", 'cesis') ,
                                        ),
                                        'default'   => 'cesis_nav_style_0'
                                        ),

                                        array(
                                        'id'        => 'cesis_portfolio_archive_navigation_pos',
                                        'type'      => 'select',
                                        'title'     => __('Select the navigation style', 'cesis'),
                                        'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                                        //Must provide key => value pairs for select options
                                        'options'   => array(
                                            "cesis_nav_justify" => __("Justify", 'cesis'),
                                						"cesis_nav_left" => __("Left", 'cesis'),
                                						"cesis_nav_center" => __("Center", 'cesis'),
                                            "cesis_nav_right" => __("Right", 'cesis') ,
                                        ),
                                        'default'   => 'cesis_nav_justify'
                                        ),
  array(
      'id'   => 'cesis_portfolio_archive_infobox_prefooter',
      'type' => 'info',
      'style' => 'success',
      'desc' => __('Pre-footer settings.', 'cesis')
    ),
                    array(
                                'id'        => 'cesis_portfolio_a_prefooter',
                                'type'      => 'button_set',
                                'title'     => __('Banner type', 'cesis'),
                                'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                                'options' => array(
                          'none' => __('No Banner', 'cesis'),
                          'content' => __('Content Block', 'cesis'),
                          'slider' => __('Slider Revolution', 'cesis'),
                          'layerslider' => __('LayerSlider', 'cesis'),
                       ),
                      'default' => 'none'
                  ),
                  array(
                                'id'        => 'cesis_portfolio_a_pf_block_content',
                                'type'      => 'select',
                  						  'required'  => array('cesis_portfolio_a_prefooter','=','content'),
                                'title'     => __('Select the Block content to use', 'cesis'),
                                'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                //Must provide key => value pairs for select options
                                'data'   => "content_block",
        						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                'default'   => ''
                  ),
                  array(
                                'id'        => 'cesis_portfolio_a_pf_rev_slider',
                                'type'      => 'select',
                  						  'required'  => array('cesis_portfolio_a_prefooter','=','slider'),
                                'title'     => __('Select the Slider revolution to use', 'cesis'),
                                'subtitle'  => __('You need to have at least one slider created', 'cesis'),
        			                  'options' => $rev_sliders,
                                'default'   => ''
                  ),
                  array(
                                'id'        => 'cesis_portfolio_a_pf_layer_slider',
                                'type'      => 'select',
                                'required'  => array('cesis_portfolio_a_prefooter','=','layerslider'),
                                'title'     => __('Select the Layerslider to use', 'cesis'),
                                'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                'options' => $layerslider_array,
                                'default'   => ''
                  ),
  array(
      'id'   => 'cesis_portfolio_archive_infobox_footer',
      'type' => 'info',
      'style' => 'success',
      'desc' => __('Footer settings.', 'cesis')
    ),
                  array(
                                'id'        => 'cesis_portfolio_a_footer_fixed',
                                'type'      => 'button_set',
                                'title'     => __('Use fixed footer?', 'cesis'),
                                'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                                'options' => array(
        					        'cesis_fixed_footer' =>  __('Yes', 'cesis'),
        					        'no' =>  __('No', 'cesis'),
                       ),
                      'default' => 'no'
                  ),
                    array(
                                'id'        => 'cesis_portfolio_a_footer',
                                'type'      => 'button_set',
                                'title'     => __('Display the Footer main area?', 'cesis'),
                                'subtitle'  => __('If you want to show the Footer top part ( widget space ) select yes.', 'cesis'),
                                'options' => array(
                          'yes' =>  __('Yes', 'cesis'),
                          'no' =>  __('No', 'cesis'),
                       ),
                      'default' => 'yes'
                  ),
                  array(
                              'id'        => 'cesis_portfolio_a_footer_bar',
                              'type'      => 'button_set',
                              'title'     => __('Display the Footer under bar?', 'cesis'),
                              'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                              'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'yes'
                ),



                                        )
                                      )
                                    );

                                    Redux::setSection( $opt_name, array(
                                          'title'      => __( 'Staff', 'cesis' ),
                                          'desc'       => __( 'Staff archive settings', 'cesis' ),
                                            'id'         => 'tt-staff-archive',
                                            'subsection' => true,
                                            'fields'     => array(


                              array(
                                'id'   => 'cesis_staff_archive_infobox_header',
                                'type' => 'info',
                                'style' => 'success',
                                'desc' => __('Header settings.', 'cesis')
                              ),
                              array(
                                          'id'        => 'cesis_staff_a_topbar',
                                          'type'      => 'button_set',
                                          'title'     => __('Display the Header Top Bar?', 'cesis'),
                                          'subtitle'  => __('Select if you want to show the header top bar.', 'cesis'),
                                          'options' => array(
                                    'yes' =>  __('Yes', 'cesis'),
                                    'no' =>  __('No', 'cesis'),
                                 ),
                                'default' => 'no'
                            ),
                            array(
                                        'id'        => 'cesis_staff_a_header',
                                        'type'      => 'button_set',
                                        'title'     => __('Display the Header?', 'cesis'),
                                        'subtitle'  => __('Select if you want to show the header.', 'cesis'),
                                        'options' => array(
                                  'yes' =>  __('Yes', 'cesis'),
                                  'no' =>  __('No', 'cesis'),
                               ),
                              'default' => 'yes'
                          ),
                          array(
                                      'id'        => 'cesis_staff_a_header_transparent',
                                      'type'      => 'button_set',
                                      'title'     => __('Use Transparent Header?', 'cesis'),
                                      'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
                                      'options' => array(
                                'cesis_transparent_header' => __('Yes', 'cesis'),
                                'cesis_opaque_header' => __('No', 'cesis'),
                             ),
                            'default' => 'cesis_opaque_header'
                        ),
                          array(
                            'id'   => 'cesis_staff_archive_infobox_banner',
                            'type' => 'info',
                            'style' => 'success',
                            'desc' => __('Banner settings.', 'cesis')
                          ),
                          array(
                                      'id'        => 'cesis_staff_a_banner',
                                      'type'      => 'button_set',
                                      'title'     => __('Banner type', 'cesis'),
                                      'subtitle'  => __('Select the banner area type.', 'cesis'),
                                      'options' => array(
                                'none' => __('No Banner', 'cesis'),
                                'content' => __('Content Block', 'cesis'),
                                'slider' => __('Slider Revolution', 'cesis'),
                                'layerslider' => __('LayerSlider', 'cesis'),
                             ),
                            'default' => 'none'
                        ),
                        array(
                                    'id'        => 'cesis_staff_a_banner_pos',
                                    'type'      => 'button_set',
                                    'required'  => array('cesis_staff_a_banner','!=','none'),
                                    'title'     => __('Banner position', 'cesis'),
                                    'subtitle'  => __('Select the banner position.', 'cesis'),
                                    'options' => array(
                              'under' => __('Under Header', 'cesis'),
                              'above' => __('Above Header', 'cesis'),
                           ),
                          'default' => 'under'
                        ),
                        array(
                                      'id'        => 'cesis_staff_a_block_content',
                                      'type'      => 'select',
                                      'required'  => array('cesis_staff_a_banner','=','content'),
                                      'title'     => __('Select the Block content to use', 'cesis'),
                                      'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                      //Must provide key => value pairs for select options
                                      'data'   => "content_block",
                                            'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                      'default'   => ''
                        ),

                        array(
                                      'id'        => 'cesis_staff_a_rev_slider',
                                      'type'      => 'select',
                        						  'required'  => array('cesis_staff_a_banner','=','slider'),
                                      'title'     => __('Select the Slider revolution to use', 'cesis'),
                                      'subtitle'  => __('You need to have at least one slider created', 'cesis'),
              			                  'options' => $rev_sliders,
                                      'default'   => ''
                        ),
                        array(
                                      'id'        => 'cesis_staff_a_layer_slider',
                                      'type'      => 'select',
                                      'required'  => array('cesis_staff_a_banner','=','layerslider'),
                                      'title'     => __('Select the Layerslider to use', 'cesis'),
                                      'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                      'options' => $layerslider_array,
                                      'default'   => ''
                        ),
                              array(
                                'id'   => 'cesis_staff_archive_infobox_title',
                                'type' => 'info',
                                'style' => 'success',
                                'desc' => __('Title settings.', 'cesis')
                              ),
                              array(
                                  'id'        => 'cesis_staff_a_title',
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
                                                'id'   => 'cesis_staff_archive_infobox',
                                                'type' => 'info',
                                                'style' => 'success',
                                                'desc' => __('Layout settings.', 'cesis')
                                              ),

                                              array(
                                                'id'        => 'cesis_staff_archive_content_width',
                                                'type'     => 'dimensions',
                                                'height'     => false,
                                                'units'    => array('px','%'),
                                                'title'     => __('Select the page main content container width ( px or % )', 'cesis'),
                                                'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                                                'default' => array(
                                                  'width'   => '1170px',
                                                  'units' => 'px'
                                                ),
                                              ),
                                              array(
                                                'id'        => 'cesis_staff_archive_top_padding',
                                                'type'     => 'dimensions',
                                                'width'     => false,
                                                'units'    => array('px'),
                                                'title'     => __('Select the page main content top space ( top padding px )', 'cesis'),
                                                'default' => array(
                                                  'height'   => '60px',
                                                  'units' => 'px'
                                                ),


                                              ),
                                              array(
                                                'id'        => 'cesis_staff_archive_bottom_padding',
                                                'type'     => 'dimensions',
                                                'width'     => false,
                                                'units'    => array('px'),
                                                'title'     => __('Select the page main content bottom space ( bottom padding px )', 'cesis'),
                                                'default' => array(
                                                  'height'   => '60px',
                                                  'units' => 'px'
                                                ),


                                              ),
                                              array(
                                                'id'       => 'cesis_staff_archive_layout',
                                                'type'     => 'image_select',
                                                'title'    => __('Select the page layout', 'cesis'),
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
                                                  'id' => 'cesis_staff_archive_sidebar_select',
                                                  'title' => __('Sidebar', 'cesis'),
                                                  'desc' => 'Please select the sidebar for the archive.',
                                                  'type' => 'select',
                                                  'data' => 'sidebars',
                                                  'required'  => array(
                                                        array('cesis_staff_archive_layout','not','no_sidebar'),
                                                  ),
                                                  'default' => 'None'
                                                ),
                                                array(
                                                  'id'   => 'cesis_staff_archive_infobox_one',
                                                  'type' => 'info',
                                                  'style' => 'success',
                                                  'desc' => __('Style settings.', 'cesis')
                                                ),

                                                array(
                                                'id'        => 'cesis_staff_archive_type',
                                                'type'      => 'select',
                                                'title'     => __('staff type', 'cesis'),
                                                'subtitle'  => __('Select the staff type.', 'cesis'),
                                                //Must provide key => value pairs for select options
                                                'options'   => array(

                                        						"isotope_grid" => __("Isotope Grid", 'cesis') ,
                                        						"isotope_packery" => __("Isotope Packery", 'cesis') ,
                                                ),
                                                'default'   => 'isotope_grid'
                                                ),

                                                array(
                                                'id'        => 'cesis_staff_archive_style_ig',
                                                'type'      => 'select',
                                                'title'     => __('staff Style', 'cesis'),
                                                'subtitle'  => __('Select staff Style ( design )', 'cesis'),
                                                'required'  => array(
                                                      array('cesis_staff_archive_type','=','isotope_grid'),
                                                ),
                                                //Must provide key => value pairs for select options
                                                'options'   => array(

                                        						"cesis_staff_style_1" => __("Standard 1", 'cesis') ,
                                                    "cesis_staff_style_2" => __("Standard 2 ( centered text )", 'cesis') ,
                                                    "cesis_staff_style_3" => __("Boxed 1", 'cesis') ,
                                                    "cesis_staff_style_4" => __("Boxed 2 ( centered text )", 'cesis') ,
                                                    "cesis_staff_style_5" => __("On image 1", 'cesis') ,
                                                    "cesis_staff_style_6" => __("On image 2", 'cesis') ,
                                                    "cesis_staff_style_7" => __("On image 3", 'cesis') ,
                                                ),
                                                'default'   => 'cesis_staff_style_1'
                                                ),



                                                array(
                                                'id'        => 'cesis_staff_archive_style_ip',
                                                'type'      => 'select',
                                                'title'     => __('staff Style', 'cesis'),
                                                'subtitle'  => __('Select staff Style ( design )', 'cesis'),
                                                'required'  => array(
                                                      array('cesis_staff_archive_type','=','isotope_packery'),
                                                ),
                                                //Must provide key => value pairs for select options
                                                'options'   => array(
                                                  "cesis_staff_style_5" => __("On image 1", 'cesis') ,
                                                  "cesis_staff_style_6" => __("On image 2", 'cesis') ,
                                                  "cesis_staff_style_7" => __("On image 3", 'cesis') ,
                                                ),
                                                'default'   => 'cesis_staff_style_5'
                                                ),

                                                array(
                                                'id'        => 'cesis_staff_archive_hover',
                                                'type'      => 'select',
                                                'title'     => __('Hover effect', 'cesis'),
                                                'subtitle'  => __('Select the hover effect you want to use.', 'cesis'),
                                                //Must provide key => value pairs for select options
                                                'options'   => array(
                                                    "none" => __("None", 'cesis') ,
                                                    "cesis_hover_overlay" => __("Colored Overlay", 'cesis') ,
                                                    "cesis_hover_overlay_social" => __("Colored Overlay and Social Icons", 'cesis') ,
                                                    "cesis_hover_fade" => __("Content Fade in ( On image style only )", 'cesis') ,
                                                    "cesis_hover_fade_out" => __("Content Fade Out ( On image style only )", 'cesis') ,
                                                    "cesis_hover_slide" => __("Content Slide in ( On image style only )", 'cesis') ,
                                                    "cesis_hover_slide_out" => __("Content Slide Out ( On image style only )", 'cesis') ,
                                                ),
                                                'default'   => 'none'
                                                ),

                                                array(
                                                                  'id'        => 'cesis_staff_archive_hover_color',
                                                                  'type'      => 'color_rgba',
                                                                  'title'     => __('Hover Color', 'cesis'),
                                                                  'subtitle'  => __('Choose the hover color ( optional )', 'cesis'),
                                                                  'required'  => array(
                                                                        array('cesis_staff_archive_hover','not','cesis_hover_fade'),
                                                                        array('cesis_staff_archive_hover','not','cesis_hover_fade_out'),
                                                                        array('cesis_staff_archive_hover','not','cesis_hover_slide'),
                                                                        array('cesis_staff_archive_hover','not','cesis_hover_slide_out'),
                                                                        array('cesis_staff_archive_hover','not','none'),
                                                                  ),
                                                                  'default'   => array(
                                                                    'color'     => '#000000',
                                                                    'alpha'     => '0.25',
                                                                    'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.25' ),
                                                                  ),
                                                    						'options'       => array(
                                                    					        'clickout_fires_change'     => true,
                                                    						),
                                                ),

                                                array(
                                                                  'id'        => 'cesis_staff_archive_hover_social_bg_color',
                                                                  'type'      => 'color_rgba',
                                                                  'title'     => __('Social Icon background color', 'cesis'),
                                                                  'subtitle'  => __('Choose the icon background color ( optional )', 'cesis'),
                                                                  'required'  => array(
                                                                        array('cesis_staff_archive_hover','=','cesis_hover_overlay_social'),
                                                                  ),
                                                                  'default'   => array(
                                                                    'color'     => '#000000',
                                                                    'alpha'     => '0.2',
                                                                    'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.2' ),
                                                                  ),
                                                    						'options'       => array(
                                                    					        'clickout_fires_change'     => true,
                                                    						),
                                                ),

                                                array(
                                                'id'        => 'cesis_staff_archive_effect',
                                                'type'      => 'select',
                                                'title'     => __('Additional effect', 'cesis'),
                                                'subtitle'  => __('Select the additional effect you want to use.', 'cesis'),
                                                //Must provide key => value pairs for select options
                                                'options'   => array(
                                                    "none" => __("None", 'cesis') ,
                                                    "cesis_effect_shadow" => __("Shadow", 'cesis') ,
                                                    "cesis_effect_zoomIn" => __("Image Zoom In", 'cesis') ,
                                                    "cesis_effect_zoomOut" => __("Image Zoom Out", 'cesis') ,
                                                    "cesis_effect_color" => __("Add Color", 'cesis') ,
                                                    "cesis_effect_decolor" => __("Remove Color", 'cesis') ,
                                                    "cesis_effect_frame" => __("White frame ( On image style only )", 'cesis') ,
                                                ),
                                                'default'   => 'none'
                                                ),

                                                array(
                                                            'id'        => 'cesis_staff_archive_force_font',
                                                            'type'      => 'button_set',
                                                            'title'     => __('Font style', 'cesis'),
                                                            'subtitle'  => __('Select the font style to use.', 'cesis'),
                                                            'options' => array(
                                                              'no' =>  __('Theme default', 'cesis'),
                                                              'force_font' =>  __('Demo Pre-set', 'cesis'),
                                                              'custom' =>  __('Custom', 'cesis'),
                                                   ),
                                                  'default' => 'no'
                                              ),
                                             array(
                                  						'id'          => 'cesis_staff_archive_heading_font',
                                  					    'type'        => 'typography',
                                                          'title'     => __('Heading font', 'cesis'),
                                                          'subtitle'  => __('Select the font to use.', 'cesis'),
                                                          'required'  => array(
                                                                array('cesis_staff_archive_force_font','contains','custom'),
                                                          ),
                                  					    'google'      => true,
                                  					    'font-backup' => true,
                                  					    'color' => false,
                                  					    'units'       =>'px',
                                  						'line-height' => true,
                                  						'text-align' => false,
                                  						'letter-spacing' => true,
                                  						'text-transform' => true,
                                  						'fonts' => array(
                                  				            "Aileron"					                           => "Aileron",
                                  				            "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                                  				            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                                  				            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                                  				            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                                  				            "Courier, monospace"                                   => "Courier, monospace",
                                  				            "Garamond, serif"                                      => "Garamond, serif",
                                  				            "Georgia, serif"                                       => "Georgia, serif",
                                  				            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                                  					        "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                                  				            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                                  				            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                                  				            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                                  				            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                                  				            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                                  				            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                                  				            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                                  				            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
                                          				),
                                  					    'default'     => array(
                                  					        'font-weight'  => '500',
                                  					        'font-family' => 'Roboto',
                                  					        'google'      => true,
                                  					        'font-size'   => '14px',
                                  					        'line-height'   => '24px',
                                  					        'text-transform'   => 'uppercase',
                                  							'letter-spacing' => '1',
                                  					    ),
                                  				   ),
                                            array(
                                             'id'          => 'cesis_staff_archive_text_font',
                                               'type'        => 'typography',
                                                         'title'     => __('Text font', 'cesis'),
                                                         'subtitle'  => __('Select the font to use.', 'cesis'),
                                                         'required'  => array(
                                                               array('cesis_staff_archive_force_font','contains','custom'),
                                                         ),
                                               'google'      => true,
                                               'font-backup' => true,
                                               'color' => false,
                                               'units'       =>'px',
                                             'line-height' => true,
                                             'text-align' => false,
                                             'letter-spacing' => true,
                                             'text-transform' => true,
                                             'fonts' => array(
                                                     "Aileron"					                           => "Aileron",
                                                     "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                                                     "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                                                     "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                                                     "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                                                     "Courier, monospace"                                   => "Courier, monospace",
                                                     "Garamond, serif"                                      => "Garamond, serif",
                                                     "Georgia, serif"                                       => "Georgia, serif",
                                                     "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                                                   "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                                                     "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                                                     "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                                                     "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                                                     "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                                                     "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                                                     "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                                                     "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                                                     "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
                                                 ),
                                               'default'     => array(
                                                   'font-weight'  => '400',
                                                   'font-family' => 'Roboto',
                                                   'google'      => true,
                                                   'font-size'   => '14px',
                                                   'line-height'   => '24px',
                                                   'text-transform'   => 'none',
                                               'letter-spacing' => '0',
                                               ),
                                            ),

                                              array(
                                              'id'        => 'cesis_staff_archive_thumbnail_size',
                                              'type'      => 'select',
                                              'title'     => __('Thumbnail size', 'cesis'),
                                              'subtitle'  => __('Select the posts thumbnail size', 'cesis'),
                                              'required'  => array(
                                                    array('cesis_staff_archive_type','contains','grid'),
                                              ),
                                              //Must provide key => value pairs for select options
                                              'options'   => array(
                                                  "tn_squared" => __("1:1 ( squared )", 'cesis') ,
                                                  "tn_rectangle_4_3" => __("4:3  ( rectangle )", 'cesis') ,
                                                  "tn_rectangle_3_2" => __("3:2  ( rectangle )", 'cesis') ,
                                                  "tn_landscape_16_9" => __("16:9 ( landscape )", 'cesis') ,
                                                  "tn_landscape_21_9" => __("21:9 ( landscape )", 'cesis') ,
                                                  "tn_portrait_3_4" => __("3:4 ( portrait )", 'cesis') ,
                                                  "tn_portrait_2_3" => __("2:3 ( portrait )", 'cesis') ,
                                                  "tn_portrait_9_16" => __("9:16 ( portrait )", 'cesis') ,
                                              ),
                                              'default'   => 'tn_rectangle_3_2'
                                              ),

                                              array(
                                              'id'        => 'cesis_staff_archive_col',
                                              'type'      => 'select',
                                              'title'     => __('Number of items per line?', 'cesis'),
                                              'subtitle'  => __('Select the number of posts to show per line.', 'cesis'),
                                              //Must provide key => value pairs for select options
                                              'options'   => array(
                                    						"1" => "1",
                                    						"2" => "2",
                                    						"3" => "3",
                                    						"4" => "4",
                                    						"5" => "5",
                                    						"6" => "6",
                                              ),
                                              'default'   => '1'
                                              ),
                                              array(
                                                      'id'        => 'cesis_staff_archive_padding',
                                                      'type'      => 'text',
                                                      'title'     => __('Choose the space between the items', 'cesis'),
                                                      'subtitle'  => __('Select the space between the items, default 30.', 'cesis'),
                                                      'validate'  => 'numeric',
                                                      'default'   => '30',
                                              ),
                                              array(
                                                'id'        => 'cesis_staff_archive_inner_padding_ig',
                                                'type'      => 'text',
                                                'title'     => __('Choose the inner space, use % or px', 'cesis'),
                                                'subtitle'  => __('Select the inner space, default 10%.', 'cesis'),
                                                'required'  => array(
                                                      array('cesis_staff_archive_style_ig','not','cesis_staff_style_1'),
                                                      array('cesis_staff_archive_style_ig','not','cesis_staff_style_2'),
                                                      array('cesis_staff_archive_style_ig','not','cesis_staff_style_3'),
                                                      array('cesis_staff_archive_style_ig','not','cesis_staff_style_4'),
                                                ),
                                                'validate'  => 'html',
                                                'default'   => '10%',
                                              ),
                                              array(
                                                'id'        => 'cesis_staff_archive_inner_padding_ip',
                                                'type'      => 'text',
                                                'title'     => __('Choose the inner space, use % or px', 'cesis'),
                                                'subtitle'  => __('Select the inner space, default 10%.', 'cesis'),
                                                'required'  => array(
                                                      array('cesis_staff_archive_type','contains','packery'),
                                                ),
                                                'validate'  => 'html',
                                                'default'   => '10%',
                                              ),

                                            array(
                                                        'id'        => 'cesis_staff_archive_i_author',
                                                        'type'      => 'button_set',
                                                        'title'     => __('Show Member position?', 'cesis'),
                                                        'subtitle'  => __('Select if you want to show the Member position.', 'cesis'),
                                                        'options' => array(
                                                  'yes' =>  __('Yes', 'cesis'),
                                                  'no' =>  __('No', 'cesis'),
                                               ),
                                              'default' => 'yes'
                                          ),

                                  array(
                                              'id'        => 'cesis_staff_archive_i_text',
                                              'type'      => 'button_set',
                                              'title'     => __('Show text?', 'cesis'),
                                              'subtitle'  => __('Select if you want to show the Staff post text.', 'cesis'),
                                              'options' => array(
                                        'yes' =>  __('Yes', 'cesis'),
                                        'no' =>  __('No', 'cesis'),
                                     ),
                                    'default' => 'no'
                                ),

                                array(
                                'id'        => 'cesis_staff_archive_text_source',
                                'type'      => 'select',
                                'title'     => __('Select text source', 'cesis'),
                                'subtitle'  => __('Select the text source ( if the excerpt isn\'t set the content will be used instead ).', 'cesis'),
                                'required'  => array(
                                      array('cesis_staff_archive_i_text','=','yes'),
                                ),
                                //Must provide key => value pairs for select options
                                'options'   => array(
                                    "content" => __("Content", 'cesis') ,
                                    "description" => __("Member description", 'cesis'),
                                ),
                                'default'   => 'description'
                                ),
                                array(
                                        'id'        => 'cesis_staff_archive_char_length',
                                        'type'      => 'text',
                                        'title'     => __('Number of Characters to show', 'cesis'),
                                        'subtitle'  => __('Select the number of charachters to show ( leave blank to show full post content )', 'cesis'),
                                        'required'  => array(
                                              array('cesis_staff_archive_i_text','=','yes'),
                                        ),
                                        'validate'  => 'numeric',
                                        'default'   => '100',
                                ),

                                array(
                                    'id'        => 'cesis_staff_archive_i_social',
                                    'type'      => 'button_set',
                                    'title'     => __('Show Social Icons?', 'cesis'),
                                    'subtitle'  => __('Select if you want to show the Member social icons.', 'cesis'),
                                    'options' => array(
                                      'no' =>  __('No', 'cesis'),
                                      'social_c' =>  __('Yes', 'cesis'),
                                    ),
                                    'default' => 'no'
                                  ),

                              array(
                                          'id'        => 'cesis_staff_archive_target',
                                          'type'      => 'button_set',
                                          'title'     => __('Open link in a new page?', 'cesis'),
                                          'subtitle'  => __('Select if you want the posts link to open in a new page.', 'cesis'),
                                          'options' => array(
                                            '_blank' =>  __('Yes', 'cesis'),
                                            '_self' =>  __('no', 'cesis'),
                                 ),
                                'default' => '_self'
                            ),

                            array(
                            'id'        => 'cesis_staff_archive_animation',
                            'type'      => 'select',
                            'title'     => __('CSS Animation', 'cesis'),
                            'subtitle'  => __('Select the animation', 'cesis'),
                            'options'   => array(
                                "none" => __("None", 'cesis') ,
                                "bounceIn" => __("bounceIn", 'cesis') ,
                                "bounceInDown" => __("bounceInDown", 'cesis') ,
                                "bounceInLeft" => __("bounceInLeft", 'cesis') ,
                                "bounceInRight" => __("bounceInRight", 'cesis') ,
                                "bounceInUp" => __("bounceInUp", 'cesis') ,
                                "fadeIn" => __("fadeIn", 'cesis') ,
                                "fadeInDown" => __("fadeInDown", 'cesis') ,
                                "fadeInDownBig" => __("fadeInDownBig", 'cesis') ,
                                "fadeInLeft" => __("fadeInLeft", 'cesis') ,
                                "fadeInLeftBig" => __("fadeInLeftBig", 'cesis') ,
                                "fadeInRight" => __("fadeInRight", 'cesis') ,
                                "fadeInRightBig" => __("fadeInRightBig", 'cesis') ,
                                "fadeInUp" => __("fadeInUp", 'cesis') ,
                                "fadeInUpBig" => __("fadeInUpBig", 'cesis') ,
                                "flipInX" => __("flipInX", 'cesis') ,
                                "flipInY" => __("flipInY", 'cesis') ,
                                "lightSpeedIn" => __("lightSpeedIn", 'cesis') ,
                                "rotateIn" => __("rotateIn", 'cesis') ,
                                "rotateInDownLeft" => __("rotateInDownLeft", 'cesis') ,
                                "rotateInDownRight" => __("rotateInDownRight", 'cesis') ,
                                "rotateInUpLeft" => __("rotateInUpLeft", 'cesis') ,
                                "rotateInUpRight" => __("rotateInUpRight", 'cesis') ,
                                "rollIn" => __("rollIn", 'cesis') ,
                                "zoomIn" => __("zoomIn", 'cesis') ,
                                "zoomInDown" => __("zoomInDown", 'cesis') ,
                                "zoomInLeft" => __("zoomInLeft", 'cesis') ,
                                "zoomInRight" => __("zoomInRight", 'cesis') ,
                                "zoomInUp" => __("zoomInUp", 'cesis') ,
                                "slideInDown" => __("slideInDown", 'cesis') ,
                                "slideInLeft" => __("slideInLeft", 'cesis') ,
                                "slideInRight" => __("slideInRight", 'cesis') ,
                                "slideInUp" => __("slideInUp", 'cesis') ,
                                "top-to-bottom" => __("Top to Bottom", 'cesis') ,
                                "bottom-to-top" => __("Bottom to Top", 'cesis') ,
                                "left-to-right" => __("Left to Right", 'cesis') ,
                                "right-to-left" => __("Right to Left", 'cesis') ,
                                "appear" => __("Appear from center", 'cesis') ,


                            ),
                            'default'   => 'none'
                            ),








                                                array(
                                                  'id'   => 'cesis_staff_archive_infobox_two',
                                                  'type' => 'info',
                                                  'style' => 'success',
                                                  'desc' => __('Navigation settings.', 'cesis')
                                                ),

                                                array(
                                                'id'        => 'cesis_staff_archive_navigation_space',
                                                'type'     => 'dimensions',
                                                'width'     => false,
                                                'units'    => array('px'),
                                                'title'     => __('Select the navigation top space', 'cesis'),
                                                'default' => array(
                                                  'height'   => '60px',
                                                  'units' => 'px'
                                                ),
                                                ),


                                                array(
                                                'id'        => 'cesis_staff_archive_navigation_style',
                                                'type'      => 'select',
                                                'title'     => __('Select the navigation style', 'cesis'),
                                                'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                                                //Must provide key => value pairs for select options
                                                'options'   => array(
                        						                "cesis_nav_style_0" => __("Small rounded square", 'cesis') ,
                                        						"cesis_nav_style_1" => __("Small squared", 'cesis') ,
                                        						 "cesis_nav_style_2" => __("Big squared", 'cesis'),
                                        						"cesis_nav_style_3" => __("Rounded", 'cesis') ,
                                        						"cesis_nav_style_4" => __("Text only", 'cesis') ,
                                                ),
                                                'default'   => 'cesis_nav_style_0'
                                                ),

                                                array(
                                                'id'        => 'cesis_staff_archive_navigation_pos',
                                                'type'      => 'select',
                                                'title'     => __('Select the navigation style', 'cesis'),
                                                'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                                                //Must provide key => value pairs for select options
                                                'options'   => array(
                                                    "cesis_nav_justify" => __("Justify", 'cesis'),
                                        						"cesis_nav_left" => __("Left", 'cesis'),
                                        						"cesis_nav_center" => __("Center", 'cesis'),
                                                    "cesis_nav_right" => __("Right", 'cesis') ,
                                                ),
                                                'default'   => 'cesis_nav_justify'
                                                ),
  array(
      'id'   => 'cesis_staff_archive_infobox_prefooter',
      'type' => 'info',
      'style' => 'success',
      'desc' => __('Pre-footer settings.', 'cesis')
    ),
                    array(
                                'id'        => 'cesis_staff_a_prefooter',
                                'type'      => 'button_set',
                                'title'     => __('Banner type', 'cesis'),
                                'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                                'options' => array(
                          'none' => __('No Banner', 'cesis'),
                          'content' => __('Content Block', 'cesis'),
                          'slider' => __('Slider Revolution', 'cesis'),
                          'layerslider' => __('LayerSlider', 'cesis'),
                       ),
                      'default' => 'none'
                  ),
                  array(
                                'id'        => 'cesis_staff_a_pf_block_content',
                                'type'      => 'select',
                  						  'required'  => array('cesis_staff_a_prefooter','=','content'),
                                'title'     => __('Select the Block content to use', 'cesis'),
                                'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                //Must provide key => value pairs for select options
                                'data'   => "content_block",
        						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                'default'   => ''
                  ),
                  array(
                                'id'        => 'cesis_staff_a_pf_rev_slider',
                                'type'      => 'select',
                  						  'required'  => array('cesis_staff_a_prefooter','=','slider'),
                                'title'     => __('Select the Slider revolution to use', 'cesis'),
                                'subtitle'  => __('You need to have at least one slider created', 'cesis'),
        			                  'options' => $rev_sliders,
                                'default'   => ''
                  ),
                  array(
                                'id'        => 'cesis_staff_a_pf_layer_slider',
                                'type'      => 'select',
                                'required'  => array('cesis_staff_a_prefooter','=','layerslider'),
                                'title'     => __('Select the Layerslider to use', 'cesis'),
                                'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                'options' => $layerslider_array,
                                'default'   => ''
                  ),
  array(
      'id'   => 'cesis_staff_archive_infobox_footer',
      'type' => 'info',
      'style' => 'success',
      'desc' => __('Footer settings.', 'cesis')
    ),
                  array(
                                'id'        => 'cesis_staff_a_footer_fixed',
                                'type'      => 'button_set',
                                'title'     => __('Use fixed footer?', 'cesis'),
                                'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                                'options' => array(
        					        'cesis_fixed_footer' =>  __('Yes', 'cesis'),
        					        'no' =>  __('No', 'cesis'),
                       ),
                      'default' => 'no'
                  ),
                    array(
                                'id'        => 'cesis_staff_a_footer',
                                'type'      => 'button_set',
                                'title'     => __('Display the Footer main area?', 'cesis'),
                                'subtitle'  => __('If you want to show the Footer top part ( widget space ) select yes.', 'cesis'),
                                'options' => array(
                          'yes' =>  __('Yes', 'cesis'),
                          'no' =>  __('No', 'cesis'),
                       ),
                      'default' => 'yes'
                  ),
                  array(
                              'id'        => 'cesis_staff_a_footer_bar',
                              'type'      => 'button_set',
                              'title'     => __('Display the Footer under bar?', 'cesis'),
                              'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                              'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'yes'
                ),




                                                )
                                              )
                                            );




                                    Redux::setSection( $opt_name, array(
                                          'title'      => __( 'Career positions', 'cesis' ),
                                          'desc'       => __( 'Career positions archive settings', 'cesis' ),
                                            'id'         => 'tt-career-archive',
                                            'subsection' => true,
                                            'fields'     => array(


                              array(
                                'id'   => 'cesis_career_archive_infobox_header',
                                'type' => 'info',
                                'style' => 'success',
                                'desc' => __('Header settings.', 'cesis')
                              ),
                              array(
                                          'id'        => 'cesis_career_a_topbar',
                                          'type'      => 'button_set',
                                          'title'     => __('Display the Header Top Bar?', 'cesis'),
                                          'subtitle'  => __('Select if you want to show the header top bar.', 'cesis'),
                                          'options' => array(
                                    'yes' =>  __('Yes', 'cesis'),
                                    'no' =>  __('No', 'cesis'),
                                 ),
                                'default' => 'no'
                            ),
                            array(
                                        'id'        => 'cesis_career_a_header',
                                        'type'      => 'button_set',
                                        'title'     => __('Display the Header?', 'cesis'),
                                        'subtitle'  => __('Select if you want to show the header.', 'cesis'),
                                        'options' => array(
                                  'yes' =>  __('Yes', 'cesis'),
                                  'no' =>  __('No', 'cesis'),
                               ),
                              'default' => 'yes'
                          ),
                          array(
                                      'id'        => 'cesis_career_a_header_transparent',
                                      'type'      => 'button_set',
                                      'title'     => __('Use Transparent Header?', 'cesis'),
                                      'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
                                      'options' => array(
                                'cesis_transparent_header' => __('Yes', 'cesis'),
                                'cesis_opaque_header' => __('No', 'cesis'),
                             ),
                            'default' => 'cesis_opaque_header'
                        ),
                          array(
                            'id'   => 'cesis_career_archive_infobox_banner',
                            'type' => 'info',
                            'style' => 'success',
                            'desc' => __('Banner settings.', 'cesis')
                          ),
                          array(
                                      'id'        => 'cesis_career_a_banner',
                                      'type'      => 'button_set',
                                      'title'     => __('Banner type', 'cesis'),
                                      'subtitle'  => __('Select the banner area type.', 'cesis'),
                                      'options' => array(
                                'none' => __('No Banner', 'cesis'),
                                'content' => __('Content Block', 'cesis'),
                                'slider' => __('Slider Revolution', 'cesis'),
                                'layerslider' => __('LayerSlider', 'cesis'),
                             ),
                            'default' => 'none'
                        ),
                        array(
                                    'id'        => 'cesis_career_a_banner_pos',
                                    'type'      => 'button_set',
                                    'required'  => array('cesis_career_a_banner','!=','none'),
                                    'title'     => __('Banner position', 'cesis'),
                                    'subtitle'  => __('Select the banner position.', 'cesis'),
                                    'options' => array(
                              'under' => __('Under Header', 'cesis'),
                              'above' => __('Above Header', 'cesis'),
                           ),
                          'default' => 'under'
                        ),
                        array(
                                      'id'        => 'cesis_career_a_block_content',
                                      'type'      => 'select',
                                      'required'  => array('cesis_career_a_banner','=','content'),
                                      'title'     => __('Select the Block content to use', 'cesis'),
                                      'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                      //Must provide key => value pairs for select options
                                      'data'   => "content_block",
                                            'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                      'default'   => ''
                        ),

                        array(
                                      'id'        => 'cesis_career_a_rev_slider',
                                      'type'      => 'select',
                        						  'required'  => array('cesis_career_a_banner','=','slider'),
                                      'title'     => __('Select the Slider revolution to use', 'cesis'),
                                      'subtitle'  => __('You need to have at least one slider created', 'cesis'),
              			                  'options' => $rev_sliders,
                                      'default'   => ''
                        ),
                        array(
                                      'id'        => 'cesis_career_a_layer_slider',
                                      'type'      => 'select',
                                      'required'  => array('cesis_career_a_banner','=','layerslider'),
                                      'title'     => __('Select the Layerslider to use', 'cesis'),
                                      'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                      'options' => $layerslider_array,
                                      'default'   => ''
                        ),
                              array(
                                'id'   => 'cesis_career_archive_infobox_title',
                                'type' => 'info',
                                'style' => 'success',
                                'desc' => __('Title settings.', 'cesis')
                              ),
                              array(
                                  'id'        => 'cesis_career_a_title',
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
                                                'id'   => 'cesis_career_archive_infobox',
                                                'type' => 'info',
                                                'style' => 'success',
                                                'desc' => __('Layout settings.', 'cesis')
                                              ),

                                              array(
                                                'id'        => 'cesis_career_archive_content_width',
                                                'type'     => 'dimensions',
                                                'height'     => false,
                                                'units'    => array('px','%'),
                                                'title'     => __('Select the page main content container width ( px or % )', 'cesis'),
                                                'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                                                'default' => array(
                                                  'width'   => '1170px',
                                                  'units' => 'px'
                                                ),
                                              ),
                                              array(
                                                'id'        => 'cesis_career_archive_top_padding',
                                                'type'     => 'dimensions',
                                                'width'     => false,
                                                'units'    => array('px'),
                                                'title'     => __('Select the page main content top space ( top padding px )', 'cesis'),
                                                'default' => array(
                                                  'height'   => '60px',
                                                  'units' => 'px'
                                                ),


                                              ),
                                              array(
                                                'id'        => 'cesis_career_archive_bottom_padding',
                                                'type'     => 'dimensions',
                                                'width'     => false,
                                                'units'    => array('px'),
                                                'title'     => __('Select the page main content bottom space ( bottom padding px )', 'cesis'),
                                                'default' => array(
                                                  'height'   => '60px',
                                                  'units' => 'px'
                                                ),


                                              ),
                                              array(
                                                'id'       => 'cesis_career_archive_layout',
                                                'type'     => 'image_select',
                                                'title'    => __('Select the page layout', 'cesis'),
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
                                                  'id' => 'cesis_career_archive_sidebar_select',
                                                  'title' => __('Sidebar', 'cesis'),
                                                  'desc' => 'Please select the sidebar for the archive.',
                                                  'type' => 'select',
                                                  'data' => 'sidebars',
                                                  'required'  => array(
                                                        array('cesis_career_archive_layout','not','no_sidebar'),
                                                  ),
                                                  'default' => 'None'
                                                ),
                                                array(
                                                  'id'   => 'cesis_career_archive_infobox_one',
                                                  'type' => 'info',
                                                  'style' => 'success',
                                                  'desc' => __('Style settings.', 'cesis')
                                                ),

                                                array(
                                                'id'        => 'cesis_career_archive_style',
                                                'type'      => 'select',
                                                'title'     => __('career Style', 'cesis'),
                                                'subtitle'  => __('Select the career positions style ( design )', 'cesis'),
                                                //Must provide key => value pairs for select options
                                                'options'   => array(

                                        						"cesis_career_style_1" => __("Standard", 'cesis') ,
                                                    "cesis_career_style_2" => __("Boxed", 'cesis') ,
                                                ),
                                                'default'   => 'cesis_career_style_1'
                                                ),


                                                array(
                                                'id'        => 'cesis_career_archive_hover',
                                                'type'      => 'select',
                                                'title'     => __('Hover effect', 'cesis'),
                                                'subtitle'  => __('Select the hover effect you want to use.', 'cesis'),
                                                //Must provide key => value pairs for select options
                                                'options'   => array(
                                                    "none" => __("None", 'cesis') ,
                                                    "cesis_hover_overlay" => __("Colored Overlay", 'cesis') ,
                                                    "cesis_hover_overlay_social" => __("Colored Overlay and Social Icons", 'cesis') ,
                                                    "cesis_hover_fade" => __("Content Fade in ( On image style only )", 'cesis') ,
                                                    "cesis_hover_fade_out" => __("Content Fade Out ( On image style only )", 'cesis') ,
                                                    "cesis_hover_slide" => __("Content Slide in ( On image style only )", 'cesis') ,
                                                    "cesis_hover_slide_out" => __("Content Slide Out ( On image style only )", 'cesis') ,
                                                ),
                                                'default'   => 'none'
                                                ),

                                                array(
                                                                  'id'        => 'cesis_career_archive_hover_color',
                                                                  'type'      => 'color_rgba',
                                                                  'title'     => __('Hover Color', 'cesis'),
                                                                  'subtitle'  => __('Choose the hover color ( optional )', 'cesis'),
                                                                  'required'  => array(
                                                                        array('cesis_career_archive_hover','not','cesis_hover_fade'),
                                                                        array('cesis_career_archive_hover','not','cesis_hover_fade_out'),
                                                                        array('cesis_career_archive_hover','not','cesis_hover_slide'),
                                                                        array('cesis_career_archive_hover','not','cesis_hover_slide_out'),
                                                                        array('cesis_career_archive_hover','not','none'),
                                                                  ),
                                                                  'default'   => array(
                                                                    'color'     => '#000000',
                                                                    'alpha'     => '0.25',
                                                                    'rgba' => Redux_Helpers::hex2rgba ( '#000000', '0.25' ),
                                                                  ),
                                                    						'options'       => array(
                                                    					        'clickout_fires_change'     => true,
                                                    						),
                                                ),

                                                array(
                                                'id'        => 'cesis_career_archive_effect',
                                                'type'      => 'select',
                                                'title'     => __('Additional effect', 'cesis'),
                                                'subtitle'  => __('Select the additional effect you want to use.', 'cesis'),
                                                //Must provide key => value pairs for select options
                                                'options'   => array(
                                                    "none" => __("None", 'cesis') ,
                                                    "cesis_effect_shadow" => __("Shadow", 'cesis') ,
                                                    "cesis_effect_zoomIn" => __("Image Zoom In", 'cesis') ,
                                                    "cesis_effect_zoomOut" => __("Image Zoom Out", 'cesis') ,
                                                    "cesis_effect_color" => __("Add Color", 'cesis') ,
                                                    "cesis_effect_decolor" => __("Remove Color", 'cesis') ,
                                                ),
                                                'default'   => 'none'
                                                ),

                                                array(
                                                            'id'        => 'cesis_career_archive_force_font',
                                                            'type'      => 'button_set',
                                                            'title'     => __('Font style', 'cesis'),
                                                            'subtitle'  => __('Select the font style to use.', 'cesis'),
                                                            'options' => array(
                                                              'no' =>  __('Theme default', 'cesis'),
                                                              'force_font' =>  __('Demo Pre-set', 'cesis'),
                                                              'custom' =>  __('Custom', 'cesis'),
                                                   ),
                                                  'default' => 'no'
                                              ),
                                             array(
                                  						'id'          => 'cesis_career_archive_heading_font',
                                  					    'type'        => 'typography',
                                                          'title'     => __('Heading font', 'cesis'),
                                                          'subtitle'  => __('Select the font to use.', 'cesis'),
                                                          'required'  => array(
                                                                array('cesis_career_archive_force_font','contains','custom'),
                                                          ),
                                  					    'google'      => true,
                                  					    'font-backup' => true,
                                  					    'color' => false,
                                  					    'units'       =>'px',
                                  						'line-height' => true,
                                  						'text-align' => false,
                                  						'letter-spacing' => true,
                                  						'text-transform' => true,
                                  						'fonts' => array(
                                  				            "Aileron"					                           => "Aileron",
                                  				            "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                                  				            "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                                  				            "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                                  				            "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                                  				            "Courier, monospace"                                   => "Courier, monospace",
                                  				            "Garamond, serif"                                      => "Garamond, serif",
                                  				            "Georgia, serif"                                       => "Georgia, serif",
                                  				            "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                                  					        "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                                  				            "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                                  				            "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                                  				            "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                                  				            "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                                  				            "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                                  				            "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                                  				            "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                                  				            "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
                                          				),
                                  					    'default'     => array(
                                  					        'font-weight'  => '500',
                                  					        'font-family' => 'Roboto',
                                  					        'google'      => true,
                                  					        'font-size'   => '14px',
                                  					        'line-height'   => '24px',
                                  					        'text-transform'   => 'uppercase',
                                  							'letter-spacing' => '1',
                                  					    ),
                                  				   ),
                                            array(
                                             'id'          => 'cesis_career_archive_text_font',
                                               'type'        => 'typography',
                                                         'title'     => __('Text font', 'cesis'),
                                                         'subtitle'  => __('Select the font to use.', 'cesis'),
                                                         'required'  => array(
                                                               array('cesis_career_archive_force_font','contains','custom'),
                                                         ),
                                               'google'      => true,
                                               'font-backup' => true,
                                               'color' => false,
                                               'units'       =>'px',
                                             'line-height' => true,
                                             'text-align' => false,
                                             'letter-spacing' => true,
                                             'text-transform' => true,
                                             'fonts' => array(
                                                     "Aileron"					                           => "Aileron",
                                                     "Arial, Helvetica, sans-serif"                         => "Arial, Helvetica, sans-serif",
                                                     "'Arial Black', Gadget, sans-serif"                    => "'Arial Black', Gadget, sans-serif",
                                                     "'Bookman Old Style', serif"                           => "'Bookman Old Style', serif",
                                                     "'Comic Sans MS', cursive"                             => "'Comic Sans MS', cursive",
                                                     "Courier, monospace"                                   => "Courier, monospace",
                                                     "Garamond, serif"                                      => "Garamond, serif",
                                                     "Georgia, serif"                                       => "Georgia, serif",
                                                     "Impact, Charcoal, sans-serif"                         => "Impact, Charcoal, sans-serif",
                                                   "'Lucida Console', Monaco, monospace"                  => "'Lucida Console', Monaco, monospace",
                                                     "'Lucida Sans Unicode', 'Lucida Grande', sans-serif"   => "'Lucida Sans Unicode', 'Lucida Grande', sans-serif",
                                                     "'MS Sans Serif', Geneva, sans-serif"                  => "'MS Sans Serif', Geneva, sans-serif",
                                                     "'MS Serif', 'New York', sans-serif"                   => "'MS Serif', 'New York', sans-serif",
                                                     "'Palatino Linotype', 'Book Antiqua', Palatino, serif" => "'Palatino Linotype', 'Book Antiqua', Palatino, serif",
                                                     "Tahoma,Geneva, sans-serif"                            => "Tahoma, Geneva, sans-serif",
                                                     "'Times New Roman', Times,serif"                       => "'Times New Roman', Times, serif",
                                                     "'Trebuchet MS', Helvetica, sans-serif"                => "'Trebuchet MS', Helvetica, sans-serif",
                                                     "Verdana, Geneva, sans-serif"                          => "Verdana, Geneva, sans-serif",
                                                 ),
                                               'default'     => array(
                                                   'font-weight'  => '400',
                                                   'font-family' => 'Roboto',
                                                   'google'      => true,
                                                   'font-size'   => '14px',
                                                   'line-height'   => '24px',
                                                   'text-transform'   => 'none',
                                               'letter-spacing' => '0',
                                               ),
                                            ),

                                              array(
                                              'id'        => 'cesis_career_archive_thumbnail_size',
                                              'type'      => 'select',
                                              'title'     => __('Thumbnail size', 'cesis'),
                                              'subtitle'  => __('Select the posts thumbnail size', 'cesis'),
                                              //Must provide key => value pairs for select options
                                              'options'   => array(
                                                  "tn_squared" => __("1:1 ( squared )", 'cesis') ,
                                                  "tn_rectangle_4_3" => __("4:3  ( rectangle )", 'cesis') ,
                                                  "tn_rectangle_3_2" => __("3:2  ( rectangle )", 'cesis') ,
                                                  "tn_landscape_16_9" => __("16:9 ( landscape )", 'cesis') ,
                                                  "tn_landscape_21_9" => __("21:9 ( landscape )", 'cesis') ,
                                                  "tn_portrait_3_4" => __("3:4 ( portrait )", 'cesis') ,
                                                  "tn_portrait_2_3" => __("2:3 ( portrait )", 'cesis') ,
                                                  "tn_portrait_9_16" => __("9:16 ( portrait )", 'cesis') ,
                                              ),
                                              'default'   => 'tn_rectangle_3_2'
                                              ),

                                              array(
                                              'id'        => 'cesis_career_archive_col',
                                              'type'      => 'select',
                                              'title'     => __('Number of items per line?', 'cesis'),
                                              'subtitle'  => __('Select the number of posts to show per line.', 'cesis'),
                                              //Must provide key => value pairs for select options
                                              'options'   => array(
                                    						"1" => "1",
                                    						"2" => "2",
                                    						"3" => "3",
                                    						"4" => "4",
                                    						"5" => "5",
                                    						"6" => "6",
                                              ),
                                              'default'   => '3'
                                              ),
                                              array(
                                                      'id'        => 'cesis_career_archive_padding',
                                                      'type'      => 'text',
                                                      'title'     => __('Choose the space between the items', 'cesis'),
                                                      'subtitle'  => __('Select the space between the items, default 30.', 'cesis'),
                                                      'validate'  => 'numeric',
                                                      'default'   => '30',
                                              ),

                                            array(
                                                        'id'        => 'cesis_career_archive_i_location',
                                                        'type'      => 'button_set',
                                                        'title'     => __('Show location?', 'cesis'),
                                                        'subtitle'  => __('Select if you want to show the location.', 'cesis'),
                                                        'options' => array(
                                                  'yes' =>  __('Yes', 'cesis'),
                                                  'no' =>  __('No', 'cesis'),
                                               ),
                                              'default' => 'yes'
                                          ),

                                        array(
                                                    'id'        => 'cesis_career_archive_i_category',
                                                    'type'      => 'button_set',
                                                    'title'     => __('Show categories?', 'cesis'),
                                                    'subtitle'  => __('Select if you want to show the categories.', 'cesis'),
                                                    'options' => array(
                                              'yes' =>  __('Yes', 'cesis'),
                                              'no' =>  __('No', 'cesis'),
                                           ),
                                          'default' => 'no'
                                      ),

                                    array(
                                                'id'        => 'cesis_career_archive_i_date',
                                                'type'      => 'button_set',
                                                'title'     => __('Show date?', 'cesis'),
                                                'subtitle'  => __('Select if you want to show the date.', 'cesis'),
                                                'options' => array(
                                          'yes' =>  __('Yes', 'cesis'),
                                          'no' =>  __('No', 'cesis'),
                                       ),
                                      'default' => 'no'
                                  ),

                                  array(
                                              'id'        => 'cesis_career_archive_i_text',
                                              'type'      => 'button_set',
                                              'title'     => __('Show text?', 'cesis'),
                                              'subtitle'  => __('Select if you want to show the career position description.', 'cesis'),
                                              'options' => array(
                                        'yes' =>  __('Yes', 'cesis'),
                                        'no' =>  __('No', 'cesis'),
                                     ),
                                    'default' => 'no'
                                ),

                                array(
                                'id'        => 'cesis_career_archive_text_source',
                                'type'      => 'select',
                                'title'     => __('Select text source', 'cesis'),
                                'subtitle'  => __('Select the text source ( if the excerpt isn\'t set the content will be used instead ).', 'cesis'),
                                'required'  => array(
                                      array('cesis_career_archive_i_text','=','yes'),
                                ),
                                //Must provide key => value pairs for select options
                                'options'   => array(
                                    "content" => __("Content", 'cesis') ,
                                    "description" => __("Description", 'cesis'),
                                ),
                                'default'   => 'description'
                                ),
                                array(
                                        'id'        => 'cesis_career_archive_char_length',
                                        'type'      => 'text',
                                        'title'     => __('Number of Characters to show', 'cesis'),
                                        'subtitle'  => __('Select the number of charachters to show ( leave blank to show full post content )', 'cesis'),
                                        'required'  => array(
                                              array('cesis_career_archive_i_text','=','yes'),
                                        ),
                                        'validate'  => 'numeric',
                                        'default'   => '125',
                                ),


                        array(
                                    'id'        => 'cesis_career_archive_read_more',
                                    'type'      => 'button_set',
                                    'title'     => __('Show read more link?', 'cesis'),
                                    'subtitle'  => __('Select if you want to show the read more link.', 'cesis'),
                                    'options' => array(
                              'yes' =>  __('Yes', 'cesis'),
                              'no' =>  __('No', 'cesis'),
                           ),
                          'default' => 'no'
                      ),

                      array(
                      'id'        => 'cesis_career_archive_read_more_style',
                      'type'      => 'select',
                      'title'     => __('Read more link style', 'cesis'),
                      'subtitle'  => __('Select the read more link style.', 'cesis'),
                      'required'  => array(
                            array('cesis_career_archive_read_more','=','yes'),
                      ),
                      'options'   => array(
                          "text" => __("Text only", 'cesis') ,
                          "button_rm" => __("Button", 'cesis') ,
                      ),
                      'default'   => 'text'
                      ),

                      array(
                      'id'        => 'cesis_career_archive_rm_t_font',
                      'type'      => 'select',
                      'title'     => __('Read more text font family', 'cesis'),
                      'subtitle'  => __('Select the read more font family ( from the one set in the theme option ).', 'cesis'),
                      'required'  => array(
                            array('cesis_career_archive_read_more_style','=','text'),
                      ),
                      'options'   => array(
                          "main_font" => __("Main font", 'cesis') ,
                          "alt_font" => __("Alternative font", 'cesis') ,
                      ),
                      'default'   => 'main_font'
                      ),

                      array(
                      'id'        => 'cesis_career_archive_rm_t_f_weight',
                      'type'      => 'select',
                      'title'     => __('Read more text font weight', 'cesis'),
                      'subtitle'  => __('Select the read more text font weight.', 'cesis'),
                      'required'  => array(
                            array('cesis_career_archive_read_more_style','=','text'),
                      ),
                      'options'   => array(
                          "100" => __("100 ( thin )", 'cesis') ,
                          "300" => __("300 ( light )", 'cesis') ,
                          "400" => __("400 ( normal )", 'cesis') ,
                          "500" => __("500 ( normal bold )", 'cesis') ,
                          "600" => __("600 ( semi bold )", 'cesis') ,
                          "700" => __("700 ( bold )", 'cesis') ,
                          "900" => __("900 ( extra bold )", 'cesis') ,
                      ),
                      'default'   => '400'
                      ),

                      array(
                      'id'        => 'cesis_career_archive_rm_t_t_transform',
                      'type'      => 'select',
                      'title'     => __('Read more text transform', 'cesis'),
                      'subtitle'  => __('Select the read more text capitalization.', 'cesis'),
                      'required'  => array(
                            array('cesis_career_archive_read_more_style','=','text'),
                      ),
                      'options'   => array(
                          "none" => __("None", 'cesis') ,
                          "uppercase" => __("Uppercase", 'cesis') ,
                          "lowercase" => __("Lowercase", 'cesis') ,
                      ),
                      'default'   => 'none'
                      ),

                      array(
                      'id'        => 'cesis_career_archive_rm_t_l_spacing',
                      'type'      => 'text',
                      'title'     => __('Read more text letter spacing', 'cesis'),
                      'subtitle'  => __('Select the read more text letter spacing ( optional ) eg : 1', 'cesis'),
                      'required'  => array(
                            array('cesis_career_archive_read_more_style','=','text'),
                      ),
                      'validate'  => 'numeric',
                      'default'   => '0',
                      ),

                      array(
                      'id'        => 'cesis_career_archive_read_more_button_style',
                      'type'      => 'select',
                      'title'     => __('Read more button style', 'cesis'),
                      'subtitle'  => __('Select the color scheme you want to use for the read more button', 'cesis'),
                      'required'  => array(
                            array('cesis_career_archive_read_more_style','=','button_rm'),
                      ),
                      'options'   => array(
                          "cesis_btn" => __("Cesis First button color settings", 'cesis') ,
                          "cesis_alt_btn" => __("Cesis Second button color settings", 'cesis') ,
                          "cesis_sub_btn" => __("Cesis Third button color settings", 'cesis') ,
                          "custom" => __("Custom color", 'cesis') ,
                      ),
                      'default'   => 'cesis_btn'
                      ),

                      array(
                                        'id'        => 'cesis_career_archive_rm_t_color',
                                        'type'      => 'color',
                                        'title'     => __('Button Text Color', 'cesis'),
                                        'subtitle'  => __('Choose the button text color', 'cesis'),
                                        'required'  => array(
                                              array('cesis_career_archive_read_more_button_style','=','custom'),
                                        ),
                                        'default'   => '#6d7783',
                                        'validate'  => 'color',
                      ),

                      array(
                                        'id'        => 'cesis_career_archive_rm_bg_color',
                                        'type'      => 'color',
                                        'title'     => __('Button Background Color', 'cesis'),
                                        'subtitle'  => __('Choose the button background color', 'cesis'),
                                        'required'  => array(
                                              array('cesis_career_archive_read_more_button_style','=','custom'),
                                        ),
                                        'default'   => '#f4f4f4',
                                        'validate'  => 'color',
                      ),

                      array(
                                        'id'        => 'cesis_career_archive_rm_b_color',
                                        'type'      => 'color',
                                        'title'     => __('Button Border Color', 'cesis'),
                                        'subtitle'  => __('Choose the button border color', 'cesis'),
                                        'required'  => array(
                                              array('cesis_career_archive_read_more_button_style','=','custom'),
                                        ),
                                        'default'   => '#ececec',
                                        'validate'  => 'color',
                      ),

                      array(
                                        'id'        => 'cesis_career_archive_rm_ht_color',
                                        'type'      => 'color',
                                        'title'     => __('Button hover Text Color', 'cesis'),
                                        'subtitle'  => __('Choose the button hover text color', 'cesis'),
                                        'required'  => array(
                                              array('cesis_career_archive_read_more_button_style','=','custom'),
                                        ),
                                        'default'   => '#ffffff',
                                        'validate'  => 'color',
                      ),

                      array(
                                        'id'        => 'cesis_career_archive_rm_hbg_color',
                                        'type'      => 'color',
                                        'title'     => __('Button hover Background Color', 'cesis'),
                                        'subtitle'  => __('Choose the button hover background color', 'cesis'),
                                        'required'  => array(
                                              array('cesis_career_archive_read_more_button_style','=','custom'),
                                        ),
                                        'default'   => '#3a78ff',
                                        'validate'  => 'color',
                      ),

                      array(
                                        'id'        => 'cesis_career_archive_rm_hb_color',
                                        'type'      => 'color',
                                        'title'     => __('Button hover Border Color', 'cesis'),
                                        'subtitle'  => __('Choose the button hover border color', 'cesis'),
                                        'required'  => array(
                                              array('cesis_career_archive_read_more_button_style','=','custom'),
                                        ),
                                        'default'   => '#3a78ff',
                                        'validate'  => 'color',
                      ),

                      array(
                      'id'        => 'cesis_career_archive_rm_font',
                      'type'      => 'select',
                      'title'     => __('Button font family', 'cesis'),
                      'subtitle'  => __('Select the button font family ( from the one set in the theme option ).', 'cesis'),
                      'required'  => array(
                            array('cesis_career_archive_read_more_button_style','=','custom'),
                      ),
                      'options'   => array(
                          "main_font" => __("Main font", 'cesis') ,
                          "alt_font" => __("Alternative font", 'cesis') ,
                      ),
                      'default'   => 'main_font'
                      ),

                      array(
                      'id'        => 'cesis_career_archive_rm_f_size',
                      'type'      => 'text',
                      'title'     => __('Button font size', 'cesis'),
                      'subtitle'  => __('Select the button font size', 'cesis'),
                      'required'  => array(
                            array('cesis_career_archive_read_more_button_style','=','custom'),
                      ),
                      'validate'  => 'numeric',
                      'default'   => '14',
                      ),

                      array(
                      'id'        => 'cesis_career_archive_rm_f_weight',
                      'type'      => 'select',
                      'title'     => __('Button font weight', 'cesis'),
                      'subtitle'  => __('Select the button font weight.', 'cesis'),
                      'required'  => array(
                            array('cesis_career_archive_read_more_button_style','=','custom'),
                      ),
                      'options'   => array(
                          "100" => __("100 ( thin )", 'cesis') ,
                          "300" => __("300 ( light )", 'cesis') ,
                          "400" => __("400 ( normal )", 'cesis') ,
                          "500" => __("500 ( normal bold )", 'cesis') ,
                          "600" => __("600 ( semi bold )", 'cesis') ,
                          "700" => __("700 ( bold )", 'cesis') ,
                          "900" => __("900 ( extra bold )", 'cesis') ,
                      ),
                      'default'   => '400'
                      ),

                      array(
                      'id'        => 'cesis_career_archive_rm_t_transform',
                      'type'      => 'select',
                      'title'     => __('Button text transform', 'cesis'),
                      'subtitle'  => __('Select the button text capitalization.', 'cesis'),
                      'required'  => array(
                            array('cesis_career_archive_read_more_button_style','=','custom'),
                      ),
                      'options'   => array(
                          "none" => __("None", 'cesis') ,
                          "uppercase" => __("Uppercase", 'cesis') ,
                          "lowercase" => __("Lowercase", 'cesis') ,
                      ),
                      'default'   => 'none'
                      ),

                      array(
                      'id'        => 'cesis_career_archive_rm_l_spacing',
                      'type'      => 'text',
                      'title'     => __('Button letter spacing', 'cesis'),
                      'subtitle'  => __('Select the button text letter spacing ( optional ) eg : 1', 'cesis'),
                      'required'  => array(
                            array('cesis_career_archive_read_more_button_style','=','custom'),
                      ),
                      'validate'  => 'numeric',
                      'default'   => '0',
                      ),

                      array(
                      'id'        => 'cesis_career_archive_rm_b_size',
                      'type'      => 'select',
                      'title'     => __('Read more button size', 'cesis'),
                      'subtitle'  => __('Select the read more button size', 'cesis'),
                      'required'  => array(
                            array('cesis_career_archive_read_more_style','=','button_rm'),
                      ),
                      'options'   => array(
                          "read_more_small" => __("Small", 'cesis') ,
                          "read_more_medium" => __("Medium", 'cesis') ,
                          "read_more_large" => __("Large", 'cesis') ,
                      ),
                      'default'   => 'read_more_small'
                      ),

                      array(
                      'id'        => 'cesis_career_archive_rm_b_radius',
                      'type'      => 'text',
                      'title'     => __('Border Radius (optional)', 'cesis'),
                      'subtitle'  => __('Select the button border radius ( optional ) eg : 10', 'cesis'),
                      'required'  => array(
                            array('cesis_career_archive_read_more_button_style','=','custom'),
                      ),
                      'validate'  => 'numeric',
                      'default'   => '0',
                      ),

                      array(
                      'id'        => 'cesis_career_archive_rm_shape',
                      'type'      => 'select',
                      'title'     => __('Read more button shape', 'cesis'),
                      'subtitle'  => __('Select the button shape', 'cesis'),
                      'required'  => array(
                            array('cesis_career_archive_read_more_button_style','not','custom'),
                      ),
                      'options'   => array(
                          "cesis_btn_squared" => __("Squared", 'cesis') ,
                          "cesis_btn_rounded" => __("Rounded", 'cesis') ,
                      ),
                      'default'   => 'cesis_btn_squared'
                      ),


                              array(
                                          'id'        => 'cesis_career_archive_target',
                                          'type'      => 'button_set',
                                          'title'     => __('Open link in a new page?', 'cesis'),
                                          'subtitle'  => __('Select if you want the posts link to open in a new page.', 'cesis'),
                                          'options' => array(
                                            '_blank' =>  __('Yes', 'cesis'),
                                            '_self' =>  __('no', 'cesis'),
                                 ),
                                'default' => '_self'
                            ),

                            array(
                            'id'        => 'cesis_career_archive_animation',
                            'type'      => 'select',
                            'title'     => __('CSS Animation', 'cesis'),
                            'subtitle'  => __('Select the animation', 'cesis'),
                            'options'   => array(
                                "none" => __("None", 'cesis') ,
                                "bounceIn" => __("bounceIn", 'cesis') ,
                                "bounceInDown" => __("bounceInDown", 'cesis') ,
                                "bounceInLeft" => __("bounceInLeft", 'cesis') ,
                                "bounceInRight" => __("bounceInRight", 'cesis') ,
                                "bounceInUp" => __("bounceInUp", 'cesis') ,
                                "fadeIn" => __("fadeIn", 'cesis') ,
                                "fadeInDown" => __("fadeInDown", 'cesis') ,
                                "fadeInDownBig" => __("fadeInDownBig", 'cesis') ,
                                "fadeInLeft" => __("fadeInLeft", 'cesis') ,
                                "fadeInLeftBig" => __("fadeInLeftBig", 'cesis') ,
                                "fadeInRight" => __("fadeInRight", 'cesis') ,
                                "fadeInRightBig" => __("fadeInRightBig", 'cesis') ,
                                "fadeInUp" => __("fadeInUp", 'cesis') ,
                                "fadeInUpBig" => __("fadeInUpBig", 'cesis') ,
                                "flipInX" => __("flipInX", 'cesis') ,
                                "flipInY" => __("flipInY", 'cesis') ,
                                "lightSpeedIn" => __("lightSpeedIn", 'cesis') ,
                                "rotateIn" => __("rotateIn", 'cesis') ,
                                "rotateInDownLeft" => __("rotateInDownLeft", 'cesis') ,
                                "rotateInDownRight" => __("rotateInDownRight", 'cesis') ,
                                "rotateInUpLeft" => __("rotateInUpLeft", 'cesis') ,
                                "rotateInUpRight" => __("rotateInUpRight", 'cesis') ,
                                "rollIn" => __("rollIn", 'cesis') ,
                                "zoomIn" => __("zoomIn", 'cesis') ,
                                "zoomInDown" => __("zoomInDown", 'cesis') ,
                                "zoomInLeft" => __("zoomInLeft", 'cesis') ,
                                "zoomInRight" => __("zoomInRight", 'cesis') ,
                                "zoomInUp" => __("zoomInUp", 'cesis') ,
                                "slideInDown" => __("slideInDown", 'cesis') ,
                                "slideInLeft" => __("slideInLeft", 'cesis') ,
                                "slideInRight" => __("slideInRight", 'cesis') ,
                                "slideInUp" => __("slideInUp", 'cesis') ,
                                "top-to-bottom" => __("Top to Bottom", 'cesis') ,
                                "bottom-to-top" => __("Bottom to Top", 'cesis') ,
                                "left-to-right" => __("Left to Right", 'cesis') ,
                                "right-to-left" => __("Right to Left", 'cesis') ,
                                "appear" => __("Appear from center", 'cesis') ,


                            ),
                            'default'   => 'none'
                            ),








                                                array(
                                                  'id'   => 'cesis_career_archive_infobox_two',
                                                  'type' => 'info',
                                                  'style' => 'success',
                                                  'desc' => __('Navigation settings.', 'cesis')
                                                ),

                                                array(
                                                'id'        => 'cesis_career_archive_navigation_space',
                                                'type'     => 'dimensions',
                                                'width'     => false,
                                                'units'    => array('px'),
                                                'title'     => __('Select the navigation top space', 'cesis'),
                                                'default' => array(
                                                  'height'   => '60px',
                                                  'units' => 'px'
                                                ),
                                                ),


                                                array(
                                                'id'        => 'cesis_career_archive_navigation_style',
                                                'type'      => 'select',
                                                'title'     => __('Select the navigation style', 'cesis'),
                                                'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                                                //Must provide key => value pairs for select options
                                                'options'   => array(
                        						                "cesis_nav_style_0" => __("Small rounded square", 'cesis') ,
                                        						"cesis_nav_style_1" => __("Small squared", 'cesis') ,
                                        						 "cesis_nav_style_2" => __("Big squared", 'cesis'),
                                        						"cesis_nav_style_3" => __("Rounded", 'cesis') ,
                                        						"cesis_nav_style_4" => __("Text only", 'cesis') ,
                                                ),
                                                'default'   => 'cesis_nav_style_0'
                                                ),

                                                array(
                                                'id'        => 'cesis_career_archive_navigation_pos',
                                                'type'      => 'select',
                                                'title'     => __('Select the navigation style', 'cesis'),
                                                'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                                                //Must provide key => value pairs for select options
                                                'options'   => array(
                                                    "cesis_nav_justify" => __("Justify", 'cesis'),
                                        						"cesis_nav_left" => __("Left", 'cesis'),
                                        						"cesis_nav_center" => __("Center", 'cesis'),
                                                    "cesis_nav_right" => __("Right", 'cesis') ,
                                                ),
                                                'default'   => 'cesis_nav_justify'
                                                ),
  array(
      'id'   => 'cesis_career_archive_infobox_prefooter',
      'type' => 'info',
      'style' => 'success',
      'desc' => __('Pre-footer settings.', 'cesis')
    ),
                    array(
                                'id'        => 'cesis_career_a_prefooter',
                                'type'      => 'button_set',
                                'title'     => __('Banner type', 'cesis'),
                                'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                                'options' => array(
                          'none' => __('No Banner', 'cesis'),
                          'content' => __('Content Block', 'cesis'),
                          'slider' => __('Slider Revolution', 'cesis'),
                          'layerslider' => __('LayerSlider', 'cesis'),
                       ),
                      'default' => 'none'
                  ),
                  array(
                                'id'        => 'cesis_career_a_pf_block_content',
                                'type'      => 'select',
                  						  'required'  => array('cesis_career_a_prefooter','=','content'),
                                'title'     => __('Select the Block content to use', 'cesis'),
                                'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                //Must provide key => value pairs for select options
                                'data'   => "content_block",
        						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                'default'   => ''
                  ),
                  array(
                                'id'        => 'cesis_career_a_pf_rev_slider',
                                'type'      => 'select',
                  						  'required'  => array('cesis_career_a_prefooter','=','slider'),
                                'title'     => __('Select the Slider revolution to use', 'cesis'),
                                'subtitle'  => __('You need to have at least one slider created', 'cesis'),
        			                  'options' => $rev_sliders,
                                'default'   => ''
                  ),
                  array(
                                'id'        => 'cesis_career_a_pf_layer_slider',
                                'type'      => 'select',
                                'required'  => array('cesis_career_a_prefooter','=','layerslider'),
                                'title'     => __('Select the Layerslider to use', 'cesis'),
                                'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                'options' => $layerslider_array,
                                'default'   => ''
                  ),
  array(
      'id'   => 'cesis_career_archive_infobox_footer',
      'type' => 'info',
      'style' => 'success',
      'desc' => __('Footer settings.', 'cesis')
    ),
                  array(
                                'id'        => 'cesis_career_a_footer_fixed',
                                'type'      => 'button_set',
                                'title'     => __('Use fixed footer?', 'cesis'),
                                'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                                'options' => array(
        					        'cesis_fixed_footer' =>  __('Yes', 'cesis'),
        					        'no' =>  __('No', 'cesis'),
                       ),
                      'default' => 'no'
                  ),
                    array(
                                'id'        => 'cesis_career_a_footer',
                                'type'      => 'button_set',
                                'title'     => __('Display the Footer main area?', 'cesis'),
                                'subtitle'  => __('If you want to show the Footer top part ( widget space ) select yes.', 'cesis'),
                                'options' => array(
                          'yes' =>  __('Yes', 'cesis'),
                          'no' =>  __('No', 'cesis'),
                       ),
                      'default' => 'yes'
                  ),
                  array(
                              'id'        => 'cesis_career_a_footer_bar',
                              'type'      => 'button_set',
                              'title'     => __('Display the Footer under bar?', 'cesis'),
                              'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                              'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'yes'
                ),




                                                )
                                              )
                                            );


                                            Redux::setSection( $opt_name, array(
                                                  'title'      => __( 'Product', 'cesis' ),
                                                  'desc'       => __( 'Products archive settings', 'cesis' ),
                                                    'id'         => 'tt-product-archive',
                                                    'subsection' => true,
                                                    'fields'     => array(

    array(
      'id'   => 'cesis_career_archive_infobox_header',
      'type' => 'info',
      'style' => 'success',
      'desc' => __('Header settings.', 'cesis')
    ),
    array(
                'id'        => 'cesis_product_archive_topbar',
                'type'      => 'button_set',
                'title'     => __('Display the Header Top Bar?', 'cesis'),
                'subtitle'  => __('Select if you want to show the header top bar.', 'cesis'),
                'options' => array(
          'yes' =>  __('Yes', 'cesis'),
          'no' =>  __('No', 'cesis'),
       ),
      'default' => 'no'
  ),
  array(
              'id'        => 'cesis_product_archive_header',
              'type'      => 'button_set',
              'title'     => __('Display the Header?', 'cesis'),
              'subtitle'  => __('Select if you want to show the header.', 'cesis'),
              'options' => array(
        'yes' =>  __('Yes', 'cesis'),
        'no' =>  __('No', 'cesis'),
     ),
    'default' => 'yes'
),
array(
            'id'        => 'cesis_product_archive_header_transparent',
            'type'      => 'button_set',
            'title'     => __('Use Transparent Header?', 'cesis'),
            'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
            'options' => array(
      'cesis_transparent_header' => __('Yes', 'cesis'),
      'cesis_opaque_header' => __('No', 'cesis'),
   ),
  'default' => 'cesis_opaque_header'
),
array(
  'id'   => 'cesis_product_archiverchive_infobox_banner',
  'type' => 'info',
  'style' => 'success',
  'desc' => __('Banner settings.', 'cesis')
),
array(
            'id'        => 'cesis_product_archive_banner',
            'type'      => 'button_set',
            'title'     => __('Banner type', 'cesis'),
            'subtitle'  => __('Select the banner area type.', 'cesis'),
            'options' => array(
      'none' => __('No Banner', 'cesis'),
      'content' => __('Content Block', 'cesis'),
      'slider' => __('Slider Revolution', 'cesis'),
      'layerslider' => __('LayerSlider', 'cesis'),
   ),
  'default' => 'none'
),
array(
          'id'        => 'cesis_product_archive_banner_pos',
          'type'      => 'button_set',
          'required'  => array('cesis_product_archive_banner','!=','none'),
          'title'     => __('Banner position', 'cesis'),
          'subtitle'  => __('Select the banner position.', 'cesis'),
          'options' => array(
    'under' => __('Under Header', 'cesis'),
    'above' => __('Above Header', 'cesis'),
 ),
'default' => 'under'
),
array(
            'id'        => 'cesis_product_archive_block_content',
            'type'      => 'select',
            'required'  => array('cesis_product_archive_banner','=','content'),
            'title'     => __('Select the Block content to use', 'cesis'),
            'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


            //Must provide key => value pairs for select options
            'data'   => "content_block",
                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
            'default'   => ''
),

array(
            'id'        => 'cesis_product_archive_rev_slider',
            'type'      => 'select',
            'required'  => array('cesis_product_archive_banner','=','slider'),
            'title'     => __('Select the Slider revolution to use', 'cesis'),
            'subtitle'  => __('You need to have at least one slider created', 'cesis'),
            'options' => $rev_sliders,
            'default'   => ''
),
array(
              'id'        => 'cesis_product_archive_layer_slider',
              'type'      => 'select',
              'required'  => array('cesis_product_archive_banner','=','layerslider'),
              'title'     => __('Select the Layerslider to use', 'cesis'),
              'subtitle'  => __('You need to have at least one slider created', 'cesis'),
              'options' => $layerslider_array,
              'default'   => ''
),
    array(
      'id'   => 'cesis_product_archive_infobox_title',
      'type' => 'info',
      'style' => 'success',
      'desc' => __('Title settings.', 'cesis')
    ),
    array(
        'id'        => 'cesis_product_archive_title',
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
                                                        'id'   => 'cesis_product_archive_infobox',
                                                        'type' => 'info',
                                                        'style' => 'success',
                                                        'desc' => __('Layout settings.', 'cesis')
                                                      ),

                                                      array(
                                                        'id'        => 'cesis_product_archive_content_width',
                                                        'type'     => 'dimensions',
                                                        'height'     => false,
                                                        'units'    => array('px','%'),
                                                        'title'     => __('Select the page main content container width ( px or % )', 'cesis'),
                                                        'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                                                        'default' => array(
                                                          'width'   => '1170px',
                                                          'units' => 'px'
                                                        ),
                                                      ),
                                                      array(
                                                        'id'        => 'cesis_product_archive_top_padding',
                                                        'type'     => 'dimensions',
                                                        'width'     => false,
                                                        'units'    => array('px'),
                                                        'title'     => __('Select the page main content top space ( top padding px )', 'cesis'),
                                                        'default' => array(
                                                          'height'   => '60px',
                                                          'units' => 'px'
                                                        ),


                                                      ),
                                                      array(
                                                        'id'        => 'cesis_product_archive_bottom_padding',
                                                        'type'     => 'dimensions',
                                                        'width'     => false,
                                                        'units'    => array('px'),
                                                        'title'     => __('Select the page main content bottom space ( bottom padding px )', 'cesis'),
                                                        'default' => array(
                                                          'height'   => '60px',
                                                          'units' => 'px'
                                                        ),


                                                      ),
                                                      array(
                                                        'id'       => 'cesis_product_archive_layout',
                                                        'type'     => 'image_select',
                                                        'title'    => __('Select the page layout', 'cesis'),
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
                                                          'id' => 'cesis_product_archive_sidebar_select',
                                                          'title' => __('Sidebar', 'cesis'),
                                                          'desc' => 'Please select the sidebar for the archive.',
                                                          'type' => 'select',
                                                          'data' => 'sidebars',
                                                          'required'  => array(
                                                                array('cesis_product_archive_layout','not','no_sidebar'),
                                                          ),
                                                          'default' => 'None'
                                                        ),

                                                        array(
                                                          'id'   => 'cesis_product_archive_infobox_one',
                                                          'type' => 'info',
                                                          'style' => 'success',
                                                          'desc' => __('Style settings.', 'cesis')
                                                        ),
                                                        array(
                                                        'id'        => 'cesis_product_archive_col',
                                                        'type'      => 'select',
                                                        'title'     => __('Number of items per line?', 'cesis'),
                                                        'subtitle'  => __('Select the number of posts to show per line.', 'cesis'),
                                                        //Must provide key => value pairs for select options
                                                        'options'   => array(
                                              						"1" => "1",
                                              						"2" => "2",
                                              						"3" => "3",
                                              						"4" => "4",
                                              						"5" => "5",
                                              						"6" => "6",
                                                        ),
                                                        'default'   => '4'
                                                        ),
                                                        array(
                                                                'id'        => 'cesis_product_archive_padding',
                                                                'type'      => 'text',
                                                                'title'     => __('Choose the space between the items', 'cesis'),
                                                                'subtitle'  => __('Select the space between the items, default 30.', 'cesis'),
                                                                'validate'  => 'numeric',
                                                                'default'   => '30',
                                                        ),
                                                        array(
                                                        'id'        => 'cesis_product_archive_animation',
                                                        'type'      => 'select',
                                                        'title'     => __('CSS Animation', 'cesis'),
                                                        'subtitle'  => __('Select the animation', 'cesis'),
                                                        'options'   => array(
                                                            "none" => __("None", 'cesis') ,
                                                            "bounceIn" => __("bounceIn", 'cesis') ,
                                                            "bounceInDown" => __("bounceInDown", 'cesis') ,
                                                            "bounceInLeft" => __("bounceInLeft", 'cesis') ,
                                                            "bounceInRight" => __("bounceInRight", 'cesis') ,
                                                            "bounceInUp" => __("bounceInUp", 'cesis') ,
                                                            "fadeIn" => __("fadeIn", 'cesis') ,
                                                            "fadeInDown" => __("fadeInDown", 'cesis') ,
                                                            "fadeInDownBig" => __("fadeInDownBig", 'cesis') ,
                                                            "fadeInLeft" => __("fadeInLeft", 'cesis') ,
                                                            "fadeInLeftBig" => __("fadeInLeftBig", 'cesis') ,
                                                            "fadeInRight" => __("fadeInRight", 'cesis') ,
                                                            "fadeInRightBig" => __("fadeInRightBig", 'cesis') ,
                                                            "fadeInUp" => __("fadeInUp", 'cesis') ,
                                                            "fadeInUpBig" => __("fadeInUpBig", 'cesis') ,
                                                            "flipInX" => __("flipInX", 'cesis') ,
                                                            "flipInY" => __("flipInY", 'cesis') ,
                                                            "lightSpeedIn" => __("lightSpeedIn", 'cesis') ,
                                                            "rotateIn" => __("rotateIn", 'cesis') ,
                                                            "rotateInDownLeft" => __("rotateInDownLeft", 'cesis') ,
                                                            "rotateInDownRight" => __("rotateInDownRight", 'cesis') ,
                                                            "rotateInUpLeft" => __("rotateInUpLeft", 'cesis') ,
                                                            "rotateInUpRight" => __("rotateInUpRight", 'cesis') ,
                                                            "rollIn" => __("rollIn", 'cesis') ,
                                                            "zoomIn" => __("zoomIn", 'cesis') ,
                                                            "zoomInDown" => __("zoomInDown", 'cesis') ,
                                                            "zoomInLeft" => __("zoomInLeft", 'cesis') ,
                                                            "zoomInRight" => __("zoomInRight", 'cesis') ,
                                                            "zoomInUp" => __("zoomInUp", 'cesis') ,
                                                            "slideInDown" => __("slideInDown", 'cesis') ,
                                                            "slideInLeft" => __("slideInLeft", 'cesis') ,
                                                            "slideInRight" => __("slideInRight", 'cesis') ,
                                                            "slideInUp" => __("slideInUp", 'cesis') ,
                                                            "top-to-bottom" => __("Top to Bottom", 'cesis') ,
                                                            "bottom-to-top" => __("Bottom to Top", 'cesis') ,
                                                            "left-to-right" => __("Left to Right", 'cesis') ,
                                                            "right-to-left" => __("Right to Left", 'cesis') ,
                                                            "appear" => __("Appear from center", 'cesis') ,


                                                        ),
                                                        'default'   => 'none'
                                                        ),



                                                        array(
                                                          'id'   => 'cesis_product_archive_infobox_two',
                                                          'type' => 'info',
                                                          'style' => 'success',
                                                          'desc' => __('Navigation settings.', 'cesis')
                                                        ),


                                                        array(
                                                        'id'        => 'cesis_product_archive_navigation_space',
                                                        'type'     => 'dimensions',
                                                        'width'     => false,
                                                        'units'    => array('px'),
                                                        'title'     => __('Select the navigation top space', 'cesis'),
                                                        'default' => array(
                                                          'height'   => '60px',
                                                          'units' => 'px'
                                                        ),
                                                        ),


                                                        array(
                                                        'id'        => 'cesis_product_archive_navigation_style',
                                                        'type'      => 'select',
                                                        'title'     => __('Select the navigation style', 'cesis'),
                                                        'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                                                        //Must provide key => value pairs for select options
                                                        'options'   => array(
                        						                        "cesis_nav_style_0" => __("Small rounded square", 'cesis') ,
                                                						"cesis_nav_style_1" => __("Small squared", 'cesis') ,
                                                						 "cesis_nav_style_2" => __("Big squared", 'cesis'),
                                                						"cesis_nav_style_3" => __("Rounded", 'cesis') ,
                                                						"cesis_nav_style_4" => __("Text only", 'cesis') ,
                                                        ),
                                                        'default'   => 'cesis_nav_style_0'
                                                        ),

                                                        array(
                                                        'id'        => 'cesis_product_archive_navigation_pos',
                                                        'type'      => 'select',
                                                        'title'     => __('Select the navigation style', 'cesis'),
                                                        'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                                                        //Must provide key => value pairs for select options
                                                        'options'   => array(
                                                            "cesis_nav_justify" => __("Justify", 'cesis'),
                                                						"cesis_nav_left" => __("Left", 'cesis'),
                                                						"cesis_nav_center" => __("Center", 'cesis'),
                                                            "cesis_nav_right" => __("Right", 'cesis') ,
                                                        ),
                                                        'default'   => 'cesis_nav_justify'
                                                        ),

  array(
      'id'   => 'cesis_product_archiver_infobox_prefooter',
      'type' => 'info',
      'style' => 'success',
      'desc' => __('Pre-footer settings.', 'cesis')
    ),
                    array(
                                'id'        => 'cesis_product_archive_prefooter',
                                'type'      => 'button_set',
                                'title'     => __('Banner type', 'cesis'),
                                'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                                'options' => array(
                          'none' => __('No Banner', 'cesis'),
                          'content' => __('Content Block', 'cesis'),
                          'slider' => __('Slider Revolution', 'cesis'),
                          'layerslider' => __('LayerSlider', 'cesis'),
                       ),
                      'default' => 'none'
                  ),
                  array(
                                'id'        => 'cesis_product_archive_pf_block_content',
                                'type'      => 'select',
                  						  'required'  => array('cesis_product_archive_prefooter','=','content'),
                                'title'     => __('Select the Block content to use', 'cesis'),
                                'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                                //Must provide key => value pairs for select options
                                'data'   => "content_block",
        						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_page' => -1)),
                                'default'   => ''
                  ),
                  array(
                                'id'        => 'cesis_product_archive_pf_rev_slider',
                                'type'      => 'select',
                  						  'required'  => array('cesis_product_archive_prefooter','=','slider'),
                                'title'     => __('Select the Slider revolution to use', 'cesis'),
                                'subtitle'  => __('You need to have at least one slider created', 'cesis'),
        			                  'options' => $rev_sliders,
                                'default'   => ''
                  ),
                  array(
                                'id'        => 'cesis_product_archive_pf_layer_slider',
                                'type'      => 'select',
                                'required'  => array('cesis_product_archive_prefooter','=','layerslider'),
                                'title'     => __('Select the Layerslider to use', 'cesis'),
                                'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                                'options' => $layerslider_array,
                                'default'   => ''
                  ),
  array(
      'id'   => 'cesis_product_archiver_infobox_footer',
      'type' => 'info',
      'style' => 'success',
      'desc' => __('Footer settings.', 'cesis')
    ),
                  array(
                                'id'        => 'cesis_product_archive_footer_fixed',
                                'type'      => 'button_set',
                                'title'     => __('Use fixed footer?', 'cesis'),
                                'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                                'options' => array(
        					        'cesis_fixed_footer' =>  __('Yes', 'cesis'),
        					        'no' =>  __('No', 'cesis'),
                       ),
                      'default' => 'no'
                  ),
                    array(
                                'id'        => 'cesis_product_archive_footer',
                                'type'      => 'button_set',
                                'title'     => __('Display the Footer main area?', 'cesis'),
                                'subtitle'  => __('If you want to show the Footer top part ( widget space ) select yes.', 'cesis'),
                                'options' => array(
                          'yes' =>  __('Yes', 'cesis'),
                          'no' =>  __('No', 'cesis'),
                       ),
                      'default' => 'yes'
                  ),
                  array(
                              'id'        => 'cesis_product_archive_footer_bar',
                              'type'      => 'button_set',
                              'title'     => __('Display the Footer under bar?', 'cesis'),
                              'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                              'options' => array(
                        'yes' =>  __('Yes', 'cesis'),
                        'no' =>  __('No', 'cesis'),
                     ),
                    'default' => 'yes'
                ),

                                                        )
                                                      )
                                                    );



Redux::setSection( $opt_name, array(
    'title' => __( 'Page 404 settings', 'cesis' ),
    'id'    => 'tt-404-settings',
    'desc'  => __( 'Settings related to the 404 page.', 'cesis' ),
    'icon'  => 'fa-404 ',
    'fields'     => array(


      array(
                        'id'        => 'cesis_404_text',
                        'type'      => 'text',
                        'title'     => __('Page 404 Error Text', 'cesis'),
                        'subtitle'  => __('Insert the text to show on 404 page.', 'cesis'),
                        'default'   => 'Oops, This Page Could Not Be Found!',
      ),
      array(
                        'id'        => 'cesis_404_subtext',
                        'type'      => 'text',
                        'title'     => __('Page 404 Error Sub-Text', 'cesis'),
                        'subtitle'  => __('Insert the subtext to show on 404 page.', 'cesis'),
                        'default'   => 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.',
      ),
      array(
                  'id'        => 'cesis_404_image',
                  'type'      => 'media',
                  'url'      => true,
                  'title'     => __('Page 404 image', 'cesis'),
                  'subtitle'  => __('Upload the image to show on the 404 page.', 'cesis'),

                  'default'  => array(
                    'url'=>''
                  ),
    ),

    )
) );


    Redux::setSection( $opt_name, array(
        'title'      => __( 'Header settings', 'cesis' ),
        'desc'       => __( 'Page header settings', 'cesis' ),
        'id'         => 'tt-404-header',
        'subsection' => true,
        'fields'     => array(
            array(
                        'id'        => 'cesis_404_topbar',
                        'type'      => 'button_set',
                        'title'     => __('Display the Header Top Bar?', 'cesis'),
                        'subtitle'  => __('Select yes if you want to show the header top bar.', 'cesis'),
                        'options' => array(
					        'yes' =>  __('Yes', 'cesis'),
					        'no' =>  __('No', 'cesis'),
               ),
              'default' => 'no'
          ),
          array(
                      'id'        => 'cesis_404_header',
                      'type'      => 'button_set',
                      'title'     => __('Display the Header?', 'cesis'),
                      'subtitle'  => __('Select yes If you want to show the header.', 'cesis'),
                      'options' => array(
                'yes' =>  __('Yes', 'cesis'),
                'no' =>  __('No', 'cesis'),
             ),
            'default' => 'yes'
        ),
        array(
                    'id'        => 'cesis_404_header_transparent',
                    'type'      => 'button_set',
                    'title'     => __('Use Transparent Header?', 'cesis'),
                    'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
                    'options' => array(
              'cesis_transparent_header' =>  __('Yes', 'cesis'),
              'cesis_opaque_header' => __('No', 'cesis'),
           ),
          'default' => 'cesis_opaque_header'
      ),
        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'      => __( 'Banner settings', 'cesis' ),
        'desc'       => __( '404 page banner settings', 'cesis' ),
        'id'         => 'tt-404-banner',
        'subsection' => true,
        'fields'     => array(
            array(
                        'id'        => 'cesis_404_banner',
                        'type'      => 'button_set',
                        'title'     => __('Banner type', 'cesis'),
                        'subtitle'  => __('Select the banner area type.', 'cesis'),
                        'options' => array(
                  'none' => __('No Banner', 'cesis'),
                  'content' => __('Content Block', 'cesis'),
                  'slider' => __('Slider Revolution', 'cesis'),
                  'layerslider' => __('LayerSlider', 'cesis'),
               ),
              'default' => 'none'
          ),
          array(
                      'id'        => 'cesis_404_banner_pos',
                      'type'      => 'button_set',
                      'required'  => array('cesis_404_banner','!=','none'),
                      'title'     => __('Banner position', 'cesis'),
                      'subtitle'  => __('Select the banner position.', 'cesis'),
                      'options' => array(
                'under' => __('Under Header', 'cesis'),
                'above' => __('Above Header', 'cesis'),
             ),
            'default' => 'under'
          ),
          array(
                        'id'        => 'cesis_404_block_content',
                        'type'      => 'select',
          						  'required'  => array('cesis_404_banner','=','content'),
                        'title'     => __('Select the Block content to use', 'cesis'),
                        'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                        //Must provide key => value pairs for select options
                        'data'   => "content_block",
						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_search' => -1)),
                        'default'   => ''
          ),
          array(
                        'id'        => 'cesis_404_rev_slider',
                        'type'      => 'select',
          						  'required'  => array('cesis_404_banner','=','slider'),
                        'title'     => __('Select the Slider revolution to use', 'cesis'),
                        'subtitle'  => __('You need to have at least one slider created', 'cesis'),
			                  'options' => $rev_sliders,
                        'default'   => ''
          ),
          array(
                        'id'        => 'cesis_404_layer_slider',
                        'type'      => 'select',
                        'required'  => array('cesis_404_banner','=','layerslider'),
                        'title'     => __('Select the Layerslider to use', 'cesis'),
                        'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                        'options' => $layerslider_array,
                        'default'   => ''
          ),
        )
    ) );



        Redux::setSection( $opt_name, array(
            'title'      => __( 'Layout settings', 'cesis' ),
            'desc'       => __( '404 Page layout settings', 'cesis' ),
            'id'         => 'tt-404-layout',
            'subsection' => true,
            'fields'     => array(
              array(
                         'id'        => 'cesis_404_content_width',
                           'type'     => 'dimensions',
                           'height'     => false,
                   'units'    => array('px','%'),
                           'title'     => __('Select the Main content container width ( px or % )', 'cesis'),
                           'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                           'default' => array(
                          'width'   => '1170px',
                          'units' => 'px'
                       ),
              ),
              array(
                                'id'        => 'cesis_404_content_top_padding',
                                'type'     => 'dimensions',
                                'width'     => false,
                    'units'    => array('px'),
                                'title'     => __('Select the Main content top space for page using sidebar ( top padding px )', 'cesis'),
                                'subtitle'  => __('If no sidebar is used and content build with Page builder 0 is recommended.', 'cesis'),
                                'default' => array(
                          'height'   => '60px',
                          'units' => 'px'
                       ),


              ),
              array(
                                'id'        => 'cesis_404_content_bottom_padding',
                                'type'     => 'dimensions',
                                'width'     => false,
                    'units'    => array('px'),
                                'title'     => __('Select the Main content bottom space for page using sidebar ( bottom padding px )', 'cesis'),
                                'subtitle'  => __('If no sidebar used and content build with Page builder 0 is recommended.', 'cesis'),
                                'default' => array(
                          'height'   => '60px',
                          'units' => 'px'
                       ),


              ),
              array(
                      'id'       => 'cesis_404_layout',
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
        ) );


        Redux::setSection( $opt_name, array(
            'title'      => __( 'Pre-Footer settings', 'cesis' ),
            'desc'       => __( '404 page pre-footer settings', 'cesis' ),
            'id'         => 'tt-404-prefooter',
            'subsection' => true,
            'fields'     => array(
                array(
                            'id'        => 'cesis_404_prefooter',
                            'type'      => 'button_set',
                            'title'     => __('Banner type', 'cesis'),
                            'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                            'options' => array(
                      'none' => __('No Banner', 'cesis'),
                      'content' => __('Content Block', 'cesis'),
                      'slider' => __('Slider Revolution', 'cesis'),
                      'layerslider' => __('LayerSlider', 'cesis'),
                   ),
                  'default' => 'none'
              ),
              array(
                            'id'        => 'cesis_404_pf_block_content',
                            'type'      => 'select',
              						  'required'  => array('cesis_404_prefooter','=','content'),
                            'title'     => __('Select the Block content to use', 'cesis'),
                            'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                            //Must provide key => value pairs for select options
                            'data'   => "content_block",
    						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_search' => -1)),
                            'default'   => ''
              ),
              array(
                            'id'        => 'cesis_404_pf_rev_slider',
                            'type'      => 'select',
              						  'required'  => array('cesis_404_prefooter','=','slider'),
                            'title'     => __('Select the Slider revolution to use', 'cesis'),
                            'subtitle'  => __('You need to have at least one slider created', 'cesis'),
    			                  'options' => $rev_sliders,
                            'default'   => ''
              ),
              array(
                            'id'        => 'cesis_404_pf_layer_slider',
                            'type'      => 'select',
                            'required'  => array('cesis_404_prefooter','=','layerslider'),
                            'title'     => __('Select the Layerslider to use', 'cesis'),
                            'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                            'options' => $layerslider_array,
                            'default'   => ''
              ),
            )
        ) );

        Redux::setSection( $opt_name, array(
            'title'      => __( 'Footer settings', 'cesis' ),
            'desc'       => __( 'Page footer settings', 'cesis' ),
            'id'         => 'tt-404-footer',
            'subsection' => true,
            'fields'     => array(
              array(
                            'id'        => 'cesis_404_footer_fixed',
                            'type'      => 'button_set',
                            'title'     => __('Use fixed footer?', 'cesis'),
                            'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                            'options' => array(
    					        'cesis_fixed_footer' =>  __('Yes', 'cesis'),
    					        'no' =>  __('No', 'cesis'),
                   ),
                  'default' => 'no'
              ),
              array(
                            'id'        => 'cesis_404_footer',
                            'type'      => 'button_set',
                            'title'     => __('Display the Footer main area?', 'cesis'),
                            'subtitle'  => __('Select yes if you want to show the Footer top part ( widget space ).', 'cesis'),
                            'options' => array(
                      'yes' =>  __('Yes', 'cesis'),
                      'no' =>  __('No', 'cesis'),
                   ),
                  'default' => 'yes'
              ),
              array(
                          'id'        => 'cesis_404_footer_bar',
                          'type'      => 'button_set',
                          'title'     => __('Display the Footer under bar?', 'cesis'),
                          'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                          'options' => array(
                    'yes' =>  __('Yes', 'cesis'),
                    'no' =>  __('No', 'cesis'),
                 ),
                'default' => 'yes'
            ),
            )
        ) );

//-
    Redux::setSection( $opt_name, array(
        'title'      => __( 'Social Icons', 'cesis' ),
        'desc'       => __( 'Set the Social icons you want to use ', 'cesis' ) . '<a href="https://cesis.co/wp-content/uploads/documentation/cesis_documentation.html" target="_blank">Cesis Header Top Bar Documentation</a>',
        'id'         => 'tt-social-icons',
        'icon'       => 'fa-social ',
        'fields'     => array(

array(
            'id'        => 'cesis_social_icons_target',
            'type'      => 'button_set',
            'title'     => __('Open social links in a new tab?', 'cesis'),
            'subtitle'  => __('Select if you want the links to open in a new tab.', 'cesis'),
            'options' => array(
      '_blank' =>  __('Yes', 'cesis'),
      '_self' =>  __('No', 'cesis'),
   ),
  'default' => '_self'
),
          array(
      'id' => 'cesis_social_icons',
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
    ) );



    Redux::setSection( $opt_name, array(
        'title'      => __( 'Share Icons', 'cesis' ),
        'desc'       => __( 'Set the Share icons you want to use ', 'cesis' ) . '<a href="https://cesis.co/wp-content/uploads/documentation/cesis_documentation.html" target="_blank">Cesis Header Top Bar Documentation</a>',
        'id'         => 'tt-share-icons',
        'icon'       => 'fa-share6 ',
        'fields'     => array(

          array(
            'id'        => 'cesis_share_facebook',
            'type'     => 'button_set',
            'title'     => __('Facebook', 'cesis'),
            'subtitle'  => __('Select if you show the facebook share icon.', 'cesis'),
            'options' => array(
              'yes' =>  __('Yes', 'cesis'),
              'no' =>  __('No', 'cesis'),
            ),
            'default' => 'yes'
          ),
          array(
            'id'        => 'cesis_share_twitter',
            'type'     => 'button_set',
            'title'     => __('Twitter', 'cesis'),
            'subtitle'  => __('Select if you show the Twitter share icon.', 'cesis'),
            'options' => array(
              'yes' =>  __('Yes', 'cesis'),
              'no' =>  __('No', 'cesis'),
            ),
            'default' => 'yes'
          ),
          array(
            'id'        => 'cesis_share_google',
            'type'     => 'button_set',
            'title'     => __('Google plus', 'cesis'),
            'subtitle'  => __('Select if you show the google plus share icon.', 'cesis'),
            'options' => array(
              'yes' =>  __('Yes', 'cesis'),
              'no' =>  __('No', 'cesis'),
            ),
            'default' => 'yes'
          ),
          array(
            'id'        => 'cesis_share_pinterest',
            'type'     => 'button_set',
            'title'     => __('Pinterest', 'cesis'),
            'subtitle'  => __('Select if you show the pinterest share icon.', 'cesis'),
            'options' => array(
              'yes' =>  __('Yes', 'cesis'),
              'no' =>  __('No', 'cesis'),
            ),
            'default' => 'yes'
          ),
          array(
            'id'        => 'cesis_share_linkedin',
            'type'     => 'button_set',
            'title'     => __('Linkedin', 'cesis'),
            'subtitle'  => __('Select if you show the linkedin share icon.', 'cesis'),
            'options' => array(
              'yes' =>  __('Yes', 'cesis'),
              'no' =>  __('No', 'cesis'),
            ),
            'default' => 'yes'
          ),
          array(
            'id'        => 'cesis_share_reddit',
            'type'     => 'button_set',
            'title'     => __('Reddit', 'cesis'),
            'subtitle'  => __('Select if you show the Reddit share icon.', 'cesis'),
            'options' => array(
              'yes' =>  __('Yes', 'cesis'),
              'no' =>  __('No', 'cesis'),
            ),
            'default' => 'yes'
          ),
          array(
            'id'        => 'cesis_share_tumblr',
            'type'     => 'button_set',
            'title'     => __('Tumblr', 'cesis'),
            'subtitle'  => __('Select if you show the tumblr share icon.', 'cesis'),
            'options' => array(
              'yes' =>  __('Yes', 'cesis'),
              'no' =>  __('No', 'cesis'),
            ),
            'default' => 'yes'
          ),
          array(
            'id'        => 'cesis_share_xing',
            'type'     => 'button_set',
            'title'     => __('Xing', 'cesis'),
            'subtitle'  => __('Select if you show the Xing share icon.', 'cesis'),
            'options' => array(
              'yes' =>  __('Yes', 'cesis'),
              'no' =>  __('No', 'cesis'),
            ),
            'default' => 'yes'
          ),
          array(
            'id'        => 'cesis_share_vk',
            'type'     => 'button_set',
            'title'     => __('VK', 'cesis'),
            'subtitle'  => __('Select if you show the vk share icon.', 'cesis'),
            'options' => array(
              'yes' =>  __('Yes', 'cesis'),
              'no' =>  __('No', 'cesis'),
            ),
            'default' => 'yes'
          ),
          array(
            'id'        => 'cesis_share_mail',
            'type'     => 'button_set',
            'title'     => __('Mail', 'cesis'),
            'subtitle'  => __('Select if you show the mail share icon.', 'cesis'),
            'options' => array(
              'yes' =>  __('Yes', 'cesis'),
              'no' =>  __('No', 'cesis'),
            ),
            'default' => 'yes'
          ),


        )
    ) );

    Redux::setSection( $opt_name, array(
        'title' => __( 'Search settings', 'cesis' ),
        'id'    => 'tt-search-settings',
        'desc'  => __( 'Settings related to search functions.', 'cesis' ),
        'icon'  => 'fa-search4 ',
        'fields'     => array(


          array(
                            'id'        => 'cesis_search_overlay_color',
                            'type'      => 'color',
                            'title'     => __('Search overlay text Color', 'cesis'),
                            'subtitle'  => __('Text color for the search overlay.', 'cesis'),
                            'default'   => '#ffffff',
                            'validate'  => 'color',
          ),
          array(
                            'id'        => 'cesis_search_overlay_bg',
                            'type'      => 'color_rgba',
                            'title'     => __('Search overlay background Color', 'cesis'),
                            'subtitle'  => __('Background color for the search overlay.', 'cesis'),
                            'default'   => array(
                              'color'     => '#232323',
                              'alpha'     => '0.75',
                              'rgba' => Redux_Helpers::hex2rgba ( '#232323', '0.75' ),
                            ),
              						'options'       => array(
              					        'clickout_fires_change'     => true,
              						),
          ),
          array(
                            'id'        => 'cesis_search_overlay_border',
                            'type'      => 'color_rgba',
                            'title'     => __('Search overlay border Color', 'cesis'),
                            'subtitle'  => __('Border color for the search overlay.', 'cesis'),
                            'default'   => array(
                              'color'     => '#ffffff',
                              'alpha'     => '0.35',
                              'rgba' => Redux_Helpers::hex2rgba ( '#ffffff', '0.35' ),
                            ),
              						'options'       => array(
              					        'clickout_fires_change'     => true,
              						),
          ),

        )
    ) );


    Redux::setSection( $opt_name, array(
        'title'      => __( 'Header settings', 'cesis' ),
        'desc'       => __( 'Page header settings', 'cesis' ),
        'id'         => 'tt-search-header',
        'subsection' => true,
        'fields'     => array(
            array(
                        'id'        => 'cesis_search_topbar',
                        'type'      => 'button_set',
                        'title'     => __('Display the Header Top Bar?', 'cesis'),
                        'subtitle'  => __('Select yes if you want to show the header top bar.', 'cesis'),
                        'options' => array(
					        'yes' =>  __('Yes', 'cesis'),
					        'no' =>  __('No', 'cesis'),
               ),
              'default' => 'no'
          ),
          array(
                      'id'        => 'cesis_search_header',
                      'type'      => 'button_set',
                      'title'     => __('Display the Header?', 'cesis'),
                      'subtitle'  => __('Select yes If you want to show the header.', 'cesis'),
                      'options' => array(
                'yes' =>  __('Yes', 'cesis'),
                'no' =>  __('No', 'cesis'),
             ),
            'default' => 'yes'
        ),
        array(
                    'id'        => 'cesis_search_header_transparent',
                    'type'      => 'button_set',
                    'title'     => __('Use Transparent Header?', 'cesis'),
                    'subtitle'  => __('Select yes If you want to use a transparent header or the default opaque header.', 'cesis'),
                    'options' => array(
              'cesis_transparent_header' =>  __('Yes', 'cesis'),
              'cesis_opaque_header' => __('No', 'cesis'),
           ),
          'default' => 'cesis_opaque_header'
      ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Banner settings', 'cesis' ),
        'desc'       => __( 'Search page banner settings', 'cesis' ),
        'id'         => 'tt-search-banner',
        'subsection' => true,
        'fields'     => array(
            array(
                        'id'        => 'cesis_search_banner',
                        'type'      => 'button_set',
                        'title'     => __('Banner type', 'cesis'),
                        'subtitle'  => __('Select the banner area type.', 'cesis'),
                        'options' => array(
                  'none' => __('No Banner', 'cesis'),
                  'content' => __('Content Block', 'cesis'),
                  'slider' => __('Slider Revolution', 'cesis'),
                  'layerslider' => __('LayerSlider', 'cesis'),
               ),
              'default' => 'none'
          ),
          array(
                      'id'        => 'cesis_search_banner_pos',
                      'type'      => 'button_set',
                      'required'  => array('cesis_search_banner','!=','none'),
                      'title'     => __('Banner position', 'cesis'),
                      'subtitle'  => __('Select the banner position.', 'cesis'),
                      'options' => array(
                'under' => __('Under Header', 'cesis'),
                'above' => __('Above Header', 'cesis'),
             ),
            'default' => 'under'
          ),
          array(
                        'id'        => 'cesis_search_block_content',
                        'type'      => 'select',
          						  'required'  => array('cesis_search_banner','=','content'),
                        'title'     => __('Select the Block content to use', 'cesis'),
                        'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                        //Must provide key => value pairs for select options
                        'data'   => "content_block",
						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_search' => -1)),
                        'default'   => ''
          ),
          array(
                        'id'        => 'cesis_search_rev_slider',
                        'type'      => 'select',
          						  'required'  => array('cesis_search_banner','=','slider'),
                        'title'     => __('Select the Slider revolution to use', 'cesis'),
                        'subtitle'  => __('You need to have at least one slider created', 'cesis'),
			                  'options' => $rev_sliders,
                        'default'   => ''
          ),
          array(
                        'id'        => 'cesis_search_layer_slider',
                        'type'      => 'select',
                        'required'  => array('cesis_search_banner','=','layerslider'),
                        'title'     => __('Select the Layerslider to use', 'cesis'),
                        'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                        'options' => $layerslider_array,
                        'default'   => ''
          ),
        )
    ) );

    Redux::setSection( $opt_name, array(
        'title'      => __( 'Title settings', 'cesis' ),
        'desc'       => __( 'Search page title settings', 'cesis' ),
        'id'         => 'tt-search-title',
        'subsection' => true,
        'fields'     => array(

              array(
                  'id'        => 'cesis_search_title',
                  'type'      => 'button_set',
                  'title'     => __('Show Title area?', 'cesis'),
                  'subtitle'  => __('Select if you want to show the title area.', 'cesis'),
                  'options' => array(
                    'yes' => __('Yes', 'cesis'),
                    'no' => __('No', 'cesis'),
                  ),
                 'default' => 'yes'
            ),
          )
    ) );

        Redux::setSection( $opt_name, array(
            'title'      => __( 'Layout settings', 'cesis' ),
            'desc'       => __( 'Search Page layout settings', 'cesis' ),
            'id'         => 'tt-search-layout',
            'subsection' => true,
            'fields'     => array(
              array(
                         'id'        => 'cesis_search_content_width',
                           'type'     => 'dimensions',
                           'height'     => false,
                   'units'    => array('px','%'),
                           'title'     => __('Select the Main content container width ( px or % )', 'cesis'),
                           'subtitle'  => __('Default 1170px, select the size of the main content.', 'cesis'),
                           'default' => array(
                          'width'   => '1170px',
                          'units' => 'px'
                       ),
              ),
              array(
                                'id'        => 'cesis_search_content_top_padding',
                                'type'     => 'dimensions',
                                'width'     => false,
                    'units'    => array('px'),
                                'title'     => __('Select the Main content top space for page using sidebar ( top padding px )', 'cesis'),
                                'subtitle'  => __('If no sidebar is used and content build with Page builder 0 is recommended.', 'cesis'),
                                'default' => array(
                          'height'   => '60px',
                          'units' => 'px'
                       ),


              ),
              array(
                                'id'        => 'cesis_search_content_bottom_padding',
                                'type'     => 'dimensions',
                                'width'     => false,
                    'units'    => array('px'),
                                'title'     => __('Select the Main content bottom space for page using sidebar ( bottom padding px )', 'cesis'),
                                'subtitle'  => __('If no sidebar used and content build with Page builder 0 is recommended.', 'cesis'),
                                'default' => array(
                          'height'   => '60px',
                          'units' => 'px'
                       ),


              ),
              array(
                      'id'       => 'cesis_search_layout',
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
                      'default' => 'r_sidebar'
                  ),

                  array(
                      'id'        => 'cesis_search_results_text',
                      'type'      => 'button_set',
                      'title'     => __('Show Number of Search results?', 'cesis'),
                      'subtitle'  => __('Select if you want to show the number of posts found.', 'cesis'),
                      'options' => array(
                        'yes' => __('Yes', 'cesis'),
                        'no' => __('No', 'cesis'),
                      ),
                     'default' => 'yes'
                  ),

                  array(
                      'id'        => 'cesis_search_form',
                      'type'      => 'button_set',
                      'title'     => __('Show a Search form?', 'cesis'),
                      'subtitle'  => __('Select if you want to add a search form before the result.', 'cesis'),
                      'options' => array(
                        'yes' => __('Yes', 'cesis'),
                        'no' => __('No', 'cesis'),
                      ),
                     'default' => 'yes'
                  ),

                  array(
                  'id'        => 'cesis_search_archive_type',
                  'type'      => 'select',
                  'title'     => __('Results Style', 'cesis'),
                  'subtitle'  => __('Select search results style ( design )', 'cesis'),
                  //Must provide key => value pairs for select options
                  'options'   => array(

                      "cesis_search_style_1" => __("Standard", 'cesis') ,
                      "cesis_search_style_2" => __("Boxed", 'cesis') ,
                  ),
                  'default'   => 'cesis_search_style_1'
                  ),

                  array(
                  'id'        => 'cesis_search_archive_col',
                  'type'      => 'select',
                  'title'     => __('Number of items per line?', 'cesis'),
                  'subtitle'  => __('Select the number of posts to show per line.', 'cesis'),
                  //Must provide key => value pairs for select options
                  'options'   => array(
                    "1" => "1",
                    "2" => "2",
                    "3" => "3",
                    "4" => "4",
                    "5" => "5",
                    "6" => "6",
                  ),
                  'default'   => '3'
                  ),
                  array(
                          'id'        => 'cesis_search_archive_padding',
                          'type'      => 'text',
                          'title'     => __('Choose the space between the items', 'cesis'),
                          'subtitle'  => __('Select the space between the items, default 30.', 'cesis'),
                          'validate'  => 'numeric',
                          'default'   => '30',
                  ),

                  array(
                  'id'        => 'cesis_search_archive_animation',
                  'type'      => 'select',
                  'title'     => __('CSS Animation', 'cesis'),
                  'subtitle'  => __('Select the animation', 'cesis'),
                  'options'   => array(
                      "none" => __("None", 'cesis') ,
                      "bounceIn" => __("bounceIn", 'cesis') ,
                      "bounceInDown" => __("bounceInDown", 'cesis') ,
                      "bounceInLeft" => __("bounceInLeft", 'cesis') ,
                      "bounceInRight" => __("bounceInRight", 'cesis') ,
                      "bounceInUp" => __("bounceInUp", 'cesis') ,
                      "fadeIn" => __("fadeIn", 'cesis') ,
                      "fadeInDown" => __("fadeInDown", 'cesis') ,
                      "fadeInDownBig" => __("fadeInDownBig", 'cesis') ,
                      "fadeInLeft" => __("fadeInLeft", 'cesis') ,
                      "fadeInLeftBig" => __("fadeInLeftBig", 'cesis') ,
                      "fadeInRight" => __("fadeInRight", 'cesis') ,
                      "fadeInRightBig" => __("fadeInRightBig", 'cesis') ,
                      "fadeInUp" => __("fadeInUp", 'cesis') ,
                      "fadeInUpBig" => __("fadeInUpBig", 'cesis') ,
                      "flipInX" => __("flipInX", 'cesis') ,
                      "flipInY" => __("flipInY", 'cesis') ,
                      "lightSpeedIn" => __("lightSpeedIn", 'cesis') ,
                      "rotateIn" => __("rotateIn", 'cesis') ,
                      "rotateInDownLeft" => __("rotateInDownLeft", 'cesis') ,
                      "rotateInDownRight" => __("rotateInDownRight", 'cesis') ,
                      "rotateInUpLeft" => __("rotateInUpLeft", 'cesis') ,
                      "rotateInUpRight" => __("rotateInUpRight", 'cesis') ,
                      "rollIn" => __("rollIn", 'cesis') ,
                      "zoomIn" => __("zoomIn", 'cesis') ,
                      "zoomInDown" => __("zoomInDown", 'cesis') ,
                      "zoomInLeft" => __("zoomInLeft", 'cesis') ,
                      "zoomInRight" => __("zoomInRight", 'cesis') ,
                      "zoomInUp" => __("zoomInUp", 'cesis') ,
                      "slideInDown" => __("slideInDown", 'cesis') ,
                      "slideInLeft" => __("slideInLeft", 'cesis') ,
                      "slideInRight" => __("slideInRight", 'cesis') ,
                      "slideInUp" => __("slideInUp", 'cesis') ,
                      "top-to-bottom" => __("Top to Bottom", 'cesis') ,
                      "bottom-to-top" => __("Bottom to Top", 'cesis') ,
                      "left-to-right" => __("Left to Right", 'cesis') ,
                      "right-to-left" => __("Right to Left", 'cesis') ,
                      "appear" => __("Appear from center", 'cesis') ,


                  ),
                  'default'   => 'none'
                  ),



                        array(
                            'id'   => 'cesis_search_archive_infobox_two',
                            'type' => 'info',
                            'style' => 'success',
                            'desc' => __('Navigation settings.', 'cesis')
                          ),


                          array(
                            'id'        => 'cesis_search_archive_navigation_space',
                            'type'     => 'dimensions',
                            'width'     => false,
                            'units'    => array('px'),
                            'title'     => __('Select the navigation top space', 'cesis'),
                            'default' => array(
                              'height'   => '60px',
                              'units' => 'px'
                            ),


                          ),
                          array(
                          'id'        => 'cesis_search_archive_navigation_style',
                          'type'      => 'select',
                          'title'     => __('Select the navigation style', 'cesis'),
                          'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                          //Must provide key => value pairs for select options
                          'options'   => array(
                        			"cesis_nav_style_0" => __("Small rounded square", 'cesis') ,
                              "cesis_nav_style_1" => __("Small squared", 'cesis') ,
                               "cesis_nav_style_2" => __("Big squared", 'cesis'),
                              "cesis_nav_style_3" => __("Rounded", 'cesis') ,
                              "cesis_nav_style_4" => __("Text only", 'cesis') ,
                          ),
                          'default'   => 'cesis_nav_style_0'
                          ),

                          array(
                          'id'        => 'cesis_search_archive_navigation_pos',
                          'type'      => 'select',
                          'title'     => __('Select the navigation style', 'cesis'),
                          'subtitle'  => __('Select the design for the navigation.', 'cesis'),
                          //Must provide key => value pairs for select options
                          'options'   => array(
                              "cesis_nav_justify" => __("Justify", 'cesis'),
                              "cesis_nav_left" => __("Left", 'cesis'),
                              "cesis_nav_center" => __("Center", 'cesis'),
                              "cesis_nav_right" => __("Right", 'cesis') ,
                          ),
                          'default'   => 'cesis_nav_justify'
                          ),
            )
        ) );

        Redux::setSection( $opt_name, array(
            'title'      => __( 'Pre-Footer settings', 'cesis' ),
            'desc'       => __( 'Search page pre-footer settings', 'cesis' ),
            'id'         => 'tt-search-prefooter',
            'subsection' => true,
            'fields'     => array(
                array(
                            'id'        => 'cesis_search_prefooter',
                            'type'      => 'button_set',
                            'title'     => __('Banner type', 'cesis'),
                            'subtitle'  => __('Select the Pre-Footer banner area type.', 'cesis'),
                            'options' => array(
                      'none' => __('No Banner', 'cesis'),
                      'content' => __('Content Block', 'cesis'),
                      'slider' => __('Slider Revolution', 'cesis'),
                      'layerslider' => __('LayerSlider', 'cesis'),
                   ),
                  'default' => 'none'
              ),
              array(
                            'id'        => 'cesis_search_pf_block_content',
                            'type'      => 'select',
              						  'required'  => array('cesis_search_prefooter','=','content'),
                            'title'     => __('Select the Block content to use', 'cesis'),
                            'subtitle'  => __('You need to create block content from here. Check documentation for more information.', 'cesis'),


                            //Must provide key => value pairs for select options
                            'data'   => "content_block",
    						                  'args' => array(array('post_type' => 'acme_product', 'posts_per_search' => -1)),
                            'default'   => ''
              ),
              array(
                            'id'        => 'cesis_search_pf_rev_slider',
                            'type'      => 'select',
              						  'required'  => array('cesis_search_prefooter','=','slider'),
                            'title'     => __('Select the Slider revolution to use', 'cesis'),
                            'subtitle'  => __('You need to have at least one slider created', 'cesis'),
    			                  'options' => $rev_sliders,
                            'default'   => ''
              ),
              array(
                            'id'        => 'cesis_search_pf_layer_slider',
                            'type'      => 'select',
                            'required'  => array('cesis_search_prefooter','=','layerslider'),
                            'title'     => __('Select the Layerslider to use', 'cesis'),
                            'subtitle'  => __('You need to have at least one slider created', 'cesis'),
                            'options' => $layerslider_array,
                            'default'   => ''
              ),
            )
        ) );

        Redux::setSection( $opt_name, array(
            'title'      => __( 'Footer settings', 'cesis' ),
            'desc'       => __( 'Page footer settings', 'cesis' ),
            'id'         => 'tt-search-footer',
            'subsection' => true,
            'fields'     => array(
              array(
                            'id'        => 'cesis_search_footer_fixed',
                            'type'      => 'button_set',
                            'title'     => __('Use fixed footer?', 'cesis'),
                            'subtitle'  => __('Select yes if you want to footer to be fixed at the bottom of the page.', 'cesis'),
                            'options' => array(
    					        'cesis_fixed_footer' =>  __('Yes', 'cesis'),
    					        'no' =>  __('No', 'cesis'),
                   ),
                  'default' => 'no'
              ),
              array(
                            'id'        => 'cesis_search_footer',
                            'type'      => 'button_set',
                            'title'     => __('Display the Footer main area?', 'cesis'),
                            'subtitle'  => __('Select yes if you want to show the Footer top part ( widget space ).', 'cesis'),
                            'options' => array(
                      'yes' =>  __('Yes', 'cesis'),
                      'no' =>  __('No', 'cesis'),
                   ),
                  'default' => 'yes'
              ),
              array(
                          'id'        => 'cesis_search_footer_bar',
                          'type'      => 'button_set',
                          'title'     => __('Display the Footer under bar?', 'cesis'),
                          'subtitle'  => __('Select if you want to show the footer under bar.', 'cesis'),
                          'options' => array(
                    'yes' =>  __('Yes', 'cesis'),
                    'no' =>  __('No', 'cesis'),
                 ),
                'default' => 'yes'
            ),
            )
        ) );
        Redux::setSection( $opt_name, array(
            'title'      => __( 'Translation settings', 'cesis' ),
            'desc'       => __( 'How to translate the theme', 'cesis' ),
            'id'         => 'tt-translation',
            'subsection' => false,
            'fields'     => array(
                array(
                  'id'   => 'info_wpml',
                  'type' => 'info',
                  'desc' => __('If you want to make a multilanguage website we recommend <a href="https://wpml.org/?aid=86713&affiliate_key=m1MVRCmC20A7">WPML</a> .', 'cesis')
                ),
                array(
                    'id'   => 'info_poedit',
                    'type' => 'info',
                    'desc' => __('If just need to translate the theme use <a href="https://tranmautritam.ticksy.com/article/14989">Poedit</a> .', 'cesis')
                ),
            )
        ) );
    if($staging_env !== "is_staging"){
    if(!in_array( $_SERVER['REMOTE_ADDR'], $whitelist)){
    Redux::setSection( $opt_name, array(
        'title'      => __( 'License', 'cesis' ),
        'desc'       => __( 'Register Cesis', 'cesis' ),
        'id'         => 'tlm',
        'heading'    => '',
        'icon'       => 'el-lock-alt',
        'icon_class' => 'el-icon-large',
        'class'      => 'redux-tlm-class',
        'customizer' => false,
        'fields'     => array(
            array(
                'id'         => 'redux_tlm',
                'type'       => 'tlm',
                'full_width' => true,
            ),
            array(
                'id'    => 'verification_status',
                'type'  => 'info',
                'style' => 'warning',
                'desc'  => __('The license is not verified.', 'redux-framework')
            ),
        ),


    ) );
    }
    }


    /*
     * <--- END SECTIONS
     */
