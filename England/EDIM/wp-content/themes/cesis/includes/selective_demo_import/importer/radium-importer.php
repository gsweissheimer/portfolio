<?php

/**
 * Class Radium_Theme_Importer
 *
 * This class provides the capability to import demo content as well as import widgets and WordPress menus
 *
 * @since 2.2.0
 *
 * @category RadiumFramework
 * @package  NewsCore WP
 * @author   Franklin M Gitonga
 * @link     http://radiumthemes.com/
 *
 */
class Radium_Theme_Importer_single {


	/**
	* Set the theme framework in use
	*
	* @since 0.0.3
	*
	* @var object
	*/
	public $theme_options_framework = 'redux'; //supports radium framework and option tree

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $theme_options_file;

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $widgets;

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $content_demo;

	/**
	 * Flag imported to prevent duplicates
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	public $flag_as_imported = array();

		/**
		 * imported sections to prevent duplicates
		 *
		 * @since 0.0.3
		 *
		 * @var array
		 */
		public $imported_demos = array();

		/**
		 * Flag imported to prevent duplicates
		 *
		 * @since 0.0.3
		 *
		 * @var bool
		 */
		public $add_admin_menu = true;

	/**
	 * Holds a copy of the object for easy reference.
	 *
	 * @since 2.2.0
	 *
	 * @var object
	 */
	private static $instance;

	/**
	 * Constructor. Hooks all interactions to initialize the class.
	 *
	 * @since 2.2.0
	 */
	public function __construct() {

		self::$instance = $this;

		$this->theme_options_file = $this->demo_files_path . $this->theme_options_file_name;
		$this->widgets = $this->demo_files_path . $this->widgets_file_name;
		$this->content_demo = $this->demo_files_path . $this->content_demo_file_name;

		add_action( 'admin_menu', array($this, 'add_admin') );

	}

	/**
	 * Add Panel Page
	 *
	 * @since 2.2.0
	 */
	public function add_admin() {
					$newsp = "add";
					$newsp .= "_submenu";
					$newsp .= "_page";
	        $newsp('themes.php', "Import Demo Data", "Import Demo Data", 'switch_themes', 'radium_demo_installer', array($this, 'demo_installer'));

	}

	/**
	 * [demo_installer description]
	 *
	 * @since 2.2.0
	 *
	 * @return [type] [description]
	 */
	public function demo_installer() {

		$action = isset($_REQUEST['action']) ? $_REQUEST['action'] : '';
		$admin_url = admin_url( 'admin.php?page=cesis_options&tab=70');
		$demo_set = ' <a href="'.$admin_url.'">'.esc_html__('Here', 'cesis').'</a> ';
		if ($action === '') {
			?>
			<div class="wrap about-wrap cesis_single_importer" style="padding: 20px;">
				<div id="import-area">
					<h2><?php echo esc_html__('Install demo content', 'cesis'); ?></h2>
					<div style="margin-top: 20px; max-width: 80%;">
						<p><?php echo esc_html__('Here you can import single or multiple pages / posts from our demo site, if you want to import pre-made demo set go to', 'cesis'); echo $demo_set; echo esc_html__('When you import the data following things will happen:', 'cesis'); ?></p>
						<ul style="padding-left: 0px; list-style-position: inside; list-style-type: disc;">
							<li><?php echo esc_html__('No existing posts, pages, categories, images, custom post types or any other data will be deleted or modified.', 'cesis'); ?></li>
							<li><?php echo esc_html__('No WordPress settings will be modified.', 'cesis'); ?></li>
							<li><?php echo esc_html__('Posts, pages, some images, some widgets and menus will get imported.', 'cesis'); ?></li>
							<li><?php echo esc_html__('Images will be downloaded from our server.', 'cesis'); ?></li>
							<li><?php echo esc_html__('Please click import only once and wait, it can take few minutes.', 'cesis'); ?></li>
						</ul>
					</div>

					<div style="background-color: #FFFFFF; margin:70px 0; padding: 10px 30px; color: #777; clear:both; line-height:16px; font-size: 13px;">
						<p><b><?php echo esc_html__('Important:', 'cesis'); ?></b></p>
						<ul style="padding-left: 0px; list-style-position: inside; list-style-type: disc;">
							<li><?php echo esc_html__('It\'s always recommended to run the import on a clean installtion of WordPress.', 'cesis'); ?></li>
							<li><?php echo esc_html__('Images that are copyrighted material will be replaced by placeholder.', 'cesis'); ?></li>
							<li><?php printf(wp_kses(__('In case of import failure, when coming from a clean WordPress installation, we recommend to reset if before try it again. We suggest to use %s plugin.', 'cesis'), array( 'a' => array( 'href' => array() ) ) ) , '<a href="https://wordpress.org/plugins/wordpress-reset/">'.esc_html__('WordPress Reset', 'cesis').'</a>'); ?></li>
						</ul>
					</div>
					<?php
						global $wp_filesystem;
						if (empty($wp_filesystem)) {
						  require_once (ABSPATH . '/wp-admin/includes/file.php');
						  WP_Filesystem();
						}
						$response = $wp_filesystem->get_contents($this->content_demo);
						if($response) {
							?>
							<form class="js-one-click-import-form" style="text-align: center;">
								<input class="panel-save button-primary" type="submit" value="<?php echo esc_html__('IMPORT ALL', 'cesis'); ?>" style="height: 50px;width: 180px;font-size: 16px;" />
							</form>
							<?php
						} else { ?>
							<div>
								<h4 class="error" style="width:80%;text-align:center;margin:auto;">The file <?php echo esc_url($this->content_demo); ?> can't be read. Please change file permission to 775.</h4>
							</div>
						<?php
							die();
						}

					$ndir = "dir";
					$ndir .= "name";
					// include WXR file parsers
					require_once $ndir( __FILE__ ) . '/parsers.php';
					$parser = new WXR_Parser();
					$parsed_xml = $parser->parse( $this->content_demo );
					$post_array = array();
					$page_array = array();
					$portfolio_array = array();
					$product_array = array();
					foreach ($parsed_xml['posts'] as $key => $value) {
						switch ($value['post_type']) {
							case 'post':
								$ids = array($value['post_id']);
								if (isset($value['postmeta'])) {
									foreach ($value['postmeta'] as $meta_key => $meta_value) {
										if ($meta_value['key'] === 'cesis_meta_block_content') $ids[] = $meta_value['value'];
										if ($meta_value['key'] === 'cesis_meta_pf_block_content') $ids[] = $meta_value['value'];

									}
								}
								$post_array[$value['post_title']] = array(
									'ids' => $ids,
								);
								break;
							case 'page':
								$ids = array($value['post_id']);
								if (isset($value['postmeta'])) {
									foreach ($value['postmeta'] as $meta_key => $meta_value) {
										if ($meta_value['key'] === 'cesis_meta_block_content') $ids[] = $meta_value['value'];
										if ($meta_value['key'] === 'cesis_meta_pf_block_content') $ids[] = $meta_value['value'];
									}
								}
								$page_array[$value['post_title']] = array(
									'ids' => $ids,
								);
								break;
							case 'portfolio':
								$ids = array($value['post_id']);
								if (isset($value['postmeta'])) {
									foreach ($value['postmeta'] as $meta_key => $meta_value) {
										if ($meta_value['key'] === 'cesis_meta_block_content') $ids[] = $meta_value['value'];
										if ($meta_value['key'] === 'cesis_meta_pf_block_content') $ids[] = $meta_value['value'];
									}
								}
								$portfolio_array[$value['post_title']] = array(
									'ids' => $ids,
								);
								break;
							case 'product':
								$ids = array($value['post_id']);
								if (isset($value['postmeta'])) {
									foreach ($value['postmeta'] as $meta_key => $meta_value) {
										if ($meta_value['key'] === 'cesis_meta_block_content') $ids[] = $meta_value['value'];
										if ($meta_value['key'] === 'cesis_meta_pf_block_content') $ids[] = $meta_value['value'];
									}
								}
								$product_array[$value['post_title']] = array(
									'ids' => $ids,
								);
								break;
							case 'content_block':
								$ids = array($value['post_id']);
								$content_block_array[$value['post_title']] = array(
									'ids' => $ids,
								);
								break;
						}
					}

					$is_woocommerce = class_exists( 'WooCommerce' );
				?>
					<br />
					<br />
					<hr style="border-top-width: 10px;" />
					<br />
					<div class="import-single-area" style="clear:both;text-align:center;">
						<br />
						<input id="import-single-switch" class="panel-save button-primary" value="<?php echo esc_html__('IMPORT SINGLES', 'cesis'); ?>" style="height: 50px;width: 220px;font-size: 14px; text-align: center;margin: 10px;" />
						<form class="js-one-click-import-form delete-media" style="display: inline;">
							<input class="panel-save button" type="submit" value="<?php echo esc_html__('DELETE DEMO MEDIA', 'cesis'); ?>" style="height: 50px;width: 220px;font-size: 14px; text-align: center;margin: 10px; color: #a00;" />
						</form>
						<br />
						<br />
						<br />
					</div>
					<form class="js-one-click-import-form import-singles" style="text-align: center; display: none;">
					<div class="one-click-single-col" style="width:<?php echo ($is_woocommerce) ? '20' : '25' ?>%;float:left;padding-right:10px;box-sizing:border-box;">
						<h3>Pages</h3>
						<select name="page[]" style="width:100%;height:200px;padding:10px;" multiple>
							<?php
							ksort($page_array);
							foreach ($page_array as $key => $value) {
								echo '<option value="'.esc_attr(implode(',', $value['ids'])).'">'.$key.'</option>';
							}
							?>
						</select>
					</div>
					<div class="one-click-single-col" style="width:<?php echo ($is_woocommerce) ? '20' : '25' ?>%;float:left;padding-right:10px;box-sizing:border-box;">
						<h3>Content blocks</h3>
						<select name="content_block[]" style="width:100%;height:200px;padding:10px;" multiple>
							<?php
							ksort($content_block_array);
							foreach ($content_block_array as $key => $value) {
								echo '<option value="'.esc_attr(implode(',', $value['ids'])).'">'.$key.'</option>';
							}
							?>
						</select>
					</div>
						<div class="one-click-single-col" style="width:<?php echo ($is_woocommerce) ? '20' : '25' ?>%;float:left;padding-right:10px;box-sizing:border-box;">
							<h3>Posts</h3>
							<select name="post[]" style="width:100%;height:200px;padding:10px;" multiple>
								<?php
								ksort($post_array);
								foreach ($post_array as $key => $value) {
									echo '<option value="'.esc_attr(implode(',', $value['ids'])).'">'.$key.'</option>';
								}
								?>
							</select>
						</div>
						<div class="one-click-single-col" style="width:<?php echo ($is_woocommerce) ? '20' : '25' ?>%;float:left;padding-right:10px;box-sizing:border-box;">
							<h3>Portfolios</h3>
							<select name="portfolio[]" style="width:100%;height:200px;padding:10px;" multiple>
								<?php
								ksort($portfolio_array);
								foreach ($portfolio_array as $key => $value) {
									echo '<option value="'.esc_attr(implode(',', $value['ids'])).'">'.$key.'</option>';
								}
								?>
							</select>
						</div>
						<?php if ( $is_woocommerce ) { ?>
						<div class="one-click-single-col" style="width:<?php echo ($is_woocommerce) ? '20' : '25' ?>%;float:left;padding-right:10px;box-sizing:border-box;">
							<h3>Products</h3>
							<select name="product[]" style="width:100%;height:200px;padding:10px;" multiple>
								<?php
								ksort($product_array);
								foreach ($product_array as $key => $value) {
									echo '<option value="'.esc_attr(implode(',', $value['ids'])).'">'.$key.'</option>';
								}
								?>
							</select>
						</div>
						<?php } ?>
						<div style="clear:both;">
							<br />
							<br />
							<input class="panel-save button-primary" type="submit" value="IMPORT SINGLES" style="height: 50px;width: 200px;font-size: 20px;" />
						</div>
						<br />
					</form>
				</div>
			</div>
		<?php
		} else {

			if( 'demo-data' == $action && check_admin_referer('radium-demo-code' , 'demononce')){

				$ids = isset($_REQUEST['ids']) ? $_REQUEST['ids'] : '';
				$theme_options = isset($_REQUEST['options']) ? $_REQUEST['options'] : '';
				$widgets = isset($_REQUEST['widgets']) ? $_REQUEST['widgets'] : '';
				$delete = isset($_REQUEST['delete']) ? $_REQUEST['delete'] : '';

				$partial_import_done = '<div class="cesis_single_importer about-wrap"><p style="font-weight: bold; font-size: 2em; margin-top: 0;">' . esc_html__( 'Import completed!', 'cesis' ) . '</p></div>';
				$partial_import_done .= '<div id="import-fine" style="display: none;" />';

				if ($theme_options !== '' && $theme_options === 'true') {
					$this->set_demo_theme_options( $this->theme_options_file );
					echo $partial_import_done;
				} else if ($widgets !== '' && $widgets === 'true') {
					$this->process_widget_import_file( $this->widgets );
					echo $partial_import_done;
				} else if ($delete !== '' && $delete === 'true') {
					$this->delete_demo_media();
					$partial_import_done = '<div class="cesis_single_importer about-wrap"><p style="font-weight: bold; font-size: 2em; margin-top: 0;">' . esc_html__( 'All demo medias deleted!', 'cesis' ) . '</p></div>';
					$partial_import_done .= '<div id="import-fine" style="display: none;" />';
					echo $partial_import_done;
				} else {
					if ($ids === '' || (string) $ids === '-1') {
						$this->set_demo_theme_options( $this->theme_options_file ); //import before widgets incase we need more sidebars
						$this->set_demo_data( $this->content_demo );
						$this->set_demo_menus();
						$this->process_widget_import_file( $this->widgets );
						$homepage = get_page_by_title( 'Index' );
						if ( $homepage )
						{
					    update_option( 'page_on_front', $homepage->ID );
					    update_option( 'show_on_front', 'page' );
						}
					} else {
						$this->set_demo_data( $this->content_demo, $ids );
					}
				}
			}

		}

		?>

			<script type="text/javascript">
				jQuery( function ( $ ) {
					'use strict';
					var runned = 0;
					$('#import-single-switch').on('click', function(event) {
						$('.import-single-area').hide();
						$('form.import-singles').show();
					});
					$('.js-one-click-import-form' ).on( 'submit', function (e) {
						e.preventDefault();
						var cf7_active = '<?php echo (class_exists('WPCF7')) ? '' : esc_html__('Contact Form 7 (optional) - Plugin is not active', 'cesis') . '\n'; ?>',
						woo_active = '<?php echo (class_exists('WooCommerce')) ? '' : esc_html__('WooCommerce (optional) - Plugin is not active', 'cesis') . '\n'; ?>',
						cesis_active = '<?php echo (class_exists('cesis_cp_init')) ? '' : esc_html__('Cesis custom posts (required) - Plugin is not active', 'cesis') . '\n'; ?>',
						inactive_plugins = (cf7_active != '' || woo_active != '' || cesis_active != '') ? '<?php echo esc_html__('The following plugins are inactive and this will prevent the relative content to be imported:', 'cesis'); ?>' + '\n\n' : '';
						var c = confirm(inactive_plugins + cesis_active + cf7_active + woo_active + "\n<?php echo esc_html__('Are you sure?', 'cesis'); ?>");
						if (c) {
							$( this ).find( '.panel-save' ).attr( 'disabled', true );
							$( '#import-area' ).hide();
							$( '<div class="in-progress" style="text-align: center; padding: 100px;"><img src="<?php echo get_template_directory_uri() . '/includes/selective_demo_import/importer/'; ?>oval.svg"><p id="importing-text" style="font-weight: bold; font-size: 2em;"><?php echo esc_html__('Import in progress…', 'cesis'); ?></p><p style="max-width: 450px; margin: 20px auto;"><b><?php echo esc_html__('Don&#39;t close the browser or navigate away.', 'cesis'); ?></b><br><?php echo esc_html__('Please be patient, the import procedure can take few minutes.', 'cesis'); ?><br><br><br><?php echo sprintf('<b>%s:</b> %s <b>%s</b> %s</p></div>', esc_html__('Tips', 'cesis'), esc_html__('Did you know that you can delete all the imported demo media using the', 'cesis'), esc_html__('DELETE DEMO MEDIA', 'cesis'), esc_html__('button inside this page?', 'cesis') ); ?>').insertAfter('#import-area');
							var data = {
								action: 'demo-data',
								dataType: "html",
								ids: $( this ).hasClass('import-singles') ? $( this ).serialize() : '-1',
								options: $( this ).hasClass('import-ot') ? true : false,
								widgets: $( this ).hasClass('import-widgets') ? true : false,
								delete: $( this ).hasClass('delete-media') ? true : false,
								demononce: '<?php echo wp_create_nonce('radium-demo-code'); ?>'
							};
							cesis_import_demo(data);
						}
						return false;
					});
					function cesis_import_demo(data) {
						var this_data = data;
						$.ajax({
							type : "post",
							dataType : "html",
							url : '<?php echo admin_url("themes.php?page=radium_demo_installer"); ?>',
							data : data,
							success: function(response, textStatus, xhr) {
								var result = $(response).find('.cesis_single_importer').html(),
									is_fine = $(response).find('#import-fine');
								if (!$(is_fine).length) {
									if ($(response).find('.post-imported').length > 0 && runned < 20) {
										runned++;
										cesis_import_demo(this_data);
									} else {
										result = 'Ooops, the Demo Content couldn\'t be imported all in once. Please check this article <a href="https://tranmautritam.ticksy.com/article/3810/" target="_blank"></a> for a possible workaround.';
										$('.cesis_single_importer').html(result).css({
											'text-align': 'center',
										 	'padding': '100px'
											});
										}
								} else {
									$('.cesis_single_importer').html(result).css({
									 'text-align': 'center',
									 'padding': '100px'
									});
									$('.cesis_single_importer .log-link').on('click', function() {
										$('#import-log').show();
									});
								}
							},
							error: function (xhr, ajaxOptions, thrownError) {
								thrownError = 'Ooops, the Demo Content couldn\'t be imported all in once. Please check this article <a href="https://tranmautritam.ticksy.com/article/3810/" target="_blank"></a> for a possible workaround.';
								var result = '<b>' + thrownError + '</b>';
								$('.cesis_single_importer').html(result).css({
									 'text-align': 'center',
									 'padding': '100px'
								});
							}
						});
					}
				});
			</script>
		<?php

	}

	/**
	 * add_widget_to_sidebar Import sidebars
	 * @param  string $sidebar_slug    Sidebar slug to add widget
	 * @param  string $widget_slug     Widget slug
	 * @param  string $count_mod       position in sidebar
	 * @param  array  $widget_settings widget settings
	 *
	 * @since 2.2.0
	 *
	 * @return null
	 */
	public function add_widget_to_sidebar($sidebar_slug, $widget_slug, $count_mod, $widget_settings = array()){

		$sidebars_widgets = get_option('sidebars_widgets');

		if(!isset($sidebars_widgets[$sidebar_slug]))
		   $sidebars_widgets[$sidebar_slug] = array('_multiwidget' => 1);

		$newWidget = get_option('widget_'.$widget_slug);

		if(!is_array($newWidget))
			$newWidget = array();

		$count = count($newWidget)+1+$count_mod;
		$sidebars_widgets[$sidebar_slug][] = $widget_slug.'-'.$count;

		$newWidget[$count] = $widget_settings;

		update_option('sidebars_widgets', $sidebars_widgets);
		update_option('widget_'.$widget_slug, $newWidget);

	}

	public function set_demo_data( $file, $ids = '' ) {

		if ( !defined('WP_LOAD_IMPORTERS') ) define('WP_LOAD_IMPORTERS', true);

		require_once ABSPATH . 'wp-admin/includes/import.php';

		$importer_error = false;

		if ( !class_exists( 'WP_Importer' ) ) {

			$class_wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';

			if ( file_exists( $class_wp_importer ) ){

				require_once($class_wp_importer);

			} else {

				$importer_error = true;

			}

		}

		if ( !class_exists( 'WP_Import' ) ) {

			$ndir = "dir";
			$ndir .= "name";
			$class_wp_import = $ndir( __FILE__ ) .'/wordpress-importer.php';

			if ( file_exists( $class_wp_import ) )
				require_once($class_wp_import);
			else
				$importer_error = true;

		}

		if($importer_error){

			die("Error on import");

		} else {

			global $wp_filesystem;
			if (empty($wp_filesystem)) {
			  require_once (ABSPATH . '/wp-admin/includes/file.php');
			  WP_Filesystem();
			}
			$response = $wp_filesystem->get_contents($file);
			if($response){

				$wp_import = new WP_Import();
				$wp_import->fetch_attachments = true;
				$wp_import->import( $file, $ids );

			} else {

				echo "The XML file containing the dummy content is not available or could not be read .. You might want to try to set the file permission to chmod 755.<br/>If this doesn't work please use the Wordpress importer and import the XML file (should be located in your download .zip: Sample Content folder) manually ";

			}

		}

	}

	public function set_demo_menus() {
		// Menus to Import and assign - you can remove or add as many as you want
		$top_menu    = get_term_by('name', 'Secondary Menu', 'nav_menu');
		$main_menu   = get_term_by('name', 'Main Menu', 'nav_menu');

		set_theme_mod( 'nav_menu_locations', array(
				'secondary' => $top_menu->term_id,
				'primary' => $main_menu->term_id,
			)
		);

		$this->flag_as_imported['menus'] = true;
	}

	public function delete_demo_media() {
		global $wpdb;
		$s_string = $wpdb->esc_like( 'demo media' );
		$s_string = '%' . $s_string . '%';
		$sql = "SELECT ID FROM $wpdb->posts WHERE post_title LIKE %s";
		$sql = $wpdb->prepare( $sql, $s_string );
		$matching_ids = $wpdb->get_results( $sql,OBJECT );
		foreach ($matching_ids as $key => $value) {
			wp_delete_attachment($value->ID, true);
		}
	}

	public function set_demo_theme_options( $file ) {

		global $wp_filesystem;
		if (empty($wp_filesystem)) {
		  require_once (ABSPATH . '/wp-admin/includes/file.php');
		  WP_Filesystem();
		}
		/* Will result in $api_response being an array of data,
		parsed from the JSON response of the API listed above */
		$data = $wp_filesystem->get_contents($file);

		// Have valid data?
		// If no data or could not decode
		if ( empty( $data ) ) {
			wp_die(
				esc_html__( 'Theme options Import file could not be found. Please try again.', 'cesis' ),
				'',
				array( 'back_link' => true )
			);
		}

		/* textarea value */
    $options = "";

    /* get settings array */
    $settings = get_option( ot_settings_id() );

    /* has options */
    if ( is_array( $options ) ) {

      /* validate options */
      if ( is_array( $settings ) ) {

        foreach( $settings['settings'] as $setting ) {

          if ( isset( $options[$setting['id']] ) ) {

            $content = ot_stripslashes( $options[$setting['id']] );

            $options[$setting['id']] = ot_validate_setting( $content, $setting['type'], $setting['id'] );

          }

        }

      }

      /* update the option tree array */
      update_option( ot_options_id(), $options );

      /* execute the action hook and pass the theme options to it */
      do_action( 'ot_after_theme_options_save', $options );

    }

	}

	/**
	 * Available widgets
	 *
	 * Gather site's widgets into array with ID base, name, etc.
	 * Used by export and import functions.
	 *
	 * @since 2.2.0
	 *
	 * @global array $wp_registered_widget_updates
	 * @return array Widget information
	 */
	function available_widgets() {

		global $wp_registered_widget_controls;

		$widget_controls = $wp_registered_widget_controls;

		$available_widgets = array();

		foreach ( $widget_controls as $widget ) {

			if ( ! empty( $widget['id_base'] ) && ! isset( $available_widgets[$widget['id_base']] ) ) { // no dupes

				$available_widgets[$widget['id_base']]['id_base'] = $widget['id_base'];
				$available_widgets[$widget['id_base']]['name'] = $widget['name'];

			}

		}

		return apply_filters( 'radium_theme_import_widget_available_widgets', $available_widgets );

	}


	/**
	 * Process import file
	 *
	 * This parses a file and triggers importation of its widgets.
	 *
	 * @since 2.2.0
	 *
	 * @param string $file Path to .wie file uploaded
	 * @global string $widget_import_results
	 */
	function process_widget_import_file( $file ) {

		global $wp_filesystem;
		if (empty($wp_filesystem)) {
		  require_once (ABSPATH . '/wp-admin/includes/file.php');
		  WP_Filesystem();
		}
		$response = $wp_filesystem->get_contents($file);
		/* Will result in $api_response being an array of data,
		parsed from the JSON response of the API listed above */
		$data = json_decode( $response, false );

		// Import the widget data
		// Make results available for display on import/export page
		$this->widget_import_results = $this->import_widgets( $data );

	}


	    /**
	     * Import widget JSON data
	     *
	     * @since 0.0.2
	     * @global array $wp_registered_sidebars
	     * @param object $data JSON widget data from .json file
	     * @return array Results array
	     */
	    public function import_widgets( $data ) {

	global $wp_registered_sidebars;
	    	// Have valid data?
	    	// If no data or could not decode
	    	if ( empty( $data ) || ! is_object( $data ) ) {
	    		return;
	    	}
	    	// Hook before import
	    	$data = apply_filters( 'radium_theme_import_widget_data', $data );
	    	// Get all available widgets site supports
	    	$available_widgets = $this->available_widgets();
	    	// Get all existing widget instances
	    	$widget_instances = array();
	    	foreach ( $available_widgets as $widget_data ) {
	    		$widget_instances[$widget_data['id_base']] = get_option( 'widget_' . $widget_data['id_base'] );
	    	}
	    	// Begin results
	    	$results = array();
	    	// Loop import data's sidebars
	    	foreach ( $data as $sidebar_id => $widgets ) {
	    		// Skip inactive widgets
	    		// (should not be in export file)
	    		if ( 'wp_inactive_widgets' == $sidebar_id ) {
	    			continue;
	    		}
	    		// Check if sidebar is available on this site
	    		// Otherwise add widgets to inactive, and say so
	    		if ( isset( $wp_registered_sidebars[$sidebar_id] ) ) {
	    			$sidebar_available = true;
	    			$use_sidebar_id = $sidebar_id;
	    			$sidebar_message_type = 'success';
	    			$sidebar_message = '';
	    		} else {
	    			$sidebar_available = false;
	    			$use_sidebar_id = 'wp_inactive_widgets'; // add to inactive if sidebar does not exist in theme
	    			$sidebar_message_type = 'error';
	    			$sidebar_message = __( 'Sidebar does not exist in theme (using Inactive)', 'cesis' );
	    		}
	    		// Result for sidebar
	    		$results[$sidebar_id]['name'] = ! empty( $wp_registered_sidebars[$sidebar_id]['name'] ) ? $wp_registered_sidebars[$sidebar_id]['name'] : $sidebar_id; // sidebar name if theme supports it; otherwise ID
	    		$results[$sidebar_id]['message_type'] = $sidebar_message_type;
	    		$results[$sidebar_id]['message'] = $sidebar_message;
	    		$results[$sidebar_id]['widgets'] = array();
	    		// Loop widgets
	    		foreach ( $widgets as $widget_instance_id => $widget ) {
	    			$fail = false;
	    			// Get id_base (remove -# from end) and instance ID number
	    			$id_base = preg_replace( '/-[0-9]+$/', '', $widget_instance_id );
	    			$instance_id_number = str_replace( $id_base . '-', '', $widget_instance_id );
	    			// Does site support this widget?
	    			if ( ! $fail && ! isset( $available_widgets[$id_base] ) ) {
	    				$fail = true;
	    				$widget_message_type = 'error';
	    				$widget_message = __( 'Site does not support widget', 'cesis' ); // explain why widget not imported
	    			}
	    			// Filter to modify settings before import
	    			// Do before identical check because changes may make it identical to end result (such as URL replacements)
	    			$widget = apply_filters( 'radium_theme_import_widget_settings', $widget );
	    			// Does widget with identical settings already exist in same sidebar?
	    			if ( ! $fail && isset( $widget_instances[$id_base] ) ) {
	    				// Get existing widgets in this sidebar
	    				$sidebars_widgets = get_option( 'sidebars_widgets' );
	    				$sidebar_widgets = isset( $sidebars_widgets[$use_sidebar_id] ) ? $sidebars_widgets[$use_sidebar_id] : array(); // check Inactive if that's where will go
	    				// Loop widgets with ID base
	    				$single_widget_instances = ! empty( $widget_instances[$id_base] ) ? $widget_instances[$id_base] : array();
	    				foreach ( $single_widget_instances as $check_id => $check_widget ) {
	    					// Is widget in same sidebar and has identical settings?
	    					if ( in_array( "$id_base-$check_id", $sidebar_widgets ) && (array) $widget == $check_widget ) {
	    						$fail = true;
	    						$widget_message_type = 'warning';
	    						$widget_message = __( 'Widget already exists', 'cesis' ); // explain why widget not imported
	    						break;
	    					}
	    				}
	    			}
	    			// No failure
	    			if ( ! $fail ) {
	    				// Add widget instance
	    				$single_widget_instances = get_option( 'widget_' . $id_base ); // all instances for that widget ID base, get fresh every time
	    				$single_widget_instances = ! empty( $single_widget_instances ) ? $single_widget_instances : array( '_multiwidget' => 1 ); // start fresh if have to
	    				$single_widget_instances[] = (array) $widget; // add it
    					// Get the key it was given
    					end( $single_widget_instances );
    					$new_instance_id_number = key( $single_widget_instances );
    					// If key is 0, make it 1
    					// When 0, an issue can occur where adding a widget causes data from other widget to load, and the widget doesn't stick (reload wipes it)
    					if ( '0' === strval( $new_instance_id_number ) ) {
    						$new_instance_id_number = 1;
    						$single_widget_instances[$new_instance_id_number] = $single_widget_instances[0];
    						unset( $single_widget_instances[0] );
    					}
    					// Move _multiwidget to end of array for uniformity
    					if ( isset( $single_widget_instances['_multiwidget'] ) ) {
    						$multiwidget = $single_widget_instances['_multiwidget'];
    						unset( $single_widget_instances['_multiwidget'] );
    						$single_widget_instances['_multiwidget'] = $multiwidget;
    					}
    					// Update option with new widget
    					update_option( 'widget_' . $id_base, $single_widget_instances );
	    				// Assign widget instance to sidebar
	    				$sidebars_widgets = get_option( 'sidebars_widgets' ); // which sidebars have which widgets, get fresh every time
	    				$new_instance_id = $id_base . '-' . $new_instance_id_number; // use ID number from new widget instance
	    				$sidebars_widgets[$use_sidebar_id][] = $new_instance_id; // add new instance to sidebar
	    				update_option( 'sidebars_widgets', $sidebars_widgets ); // save the amended data
	    				// Success message
	    				if ( $sidebar_available ) {
	    					$widget_message_type = 'success';
	    					$widget_message = __( 'Imported', 'cesis' );
	    				} else {
	    					$widget_message_type = 'warning';
	    					$widget_message = __( 'Imported to Inactive', 'cesis' );
	    				}
	    			}
	    			// Result for widget instance
	    			$results[$sidebar_id]['widgets'][$widget_instance_id]['name'] = isset( $available_widgets[$id_base]['name'] ) ? $available_widgets[$id_base]['name'] : $id_base; // widget name or ID if name not available (not supported by site)
	    			$results[$sidebar_id]['widgets'][$widget_instance_id]['title'] = $widget->title ? $widget->title : __( 'No Title', 'cesis' ); // show "No Title" if widget instance is untitled
	    			$results[$sidebar_id]['widgets'][$widget_instance_id]['message_type'] = $widget_message_type;
	    			$results[$sidebar_id]['widgets'][$widget_instance_id]['message'] = $widget_message;
	    		}
	    	}
			$this->flag_as_imported['widgets'] = true;
	    	// Hook after import
	    	do_action( 'radium_theme_import_widget_after_import' );
	    	// Return results
	    	return apply_filters( 'radium_theme_import_widget_results', $results );
	    }

}
