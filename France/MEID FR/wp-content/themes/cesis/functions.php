<?php

////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////             Load default Options                ////
///                                                 ////
//                                                 ////
//////////////////////////////////////////////////////

//Add Redux Framework
require get_template_directory() . '/admin/admin-init.php';
require get_template_directory() . '/admin/redux-extensions/config.php';
require get_template_directory() . '/admin/redux-extensions/loader.php';

//Add Redux Data filter
add_filter("redux/options/cesis_data/wordpress_data/content_block/", 'cesis_content_block_select_data');

function cesis_content_block_select_data() {
	global $wp_query;

	$args = array(
    'post_type' => 'content_block',
    'post_status' => 'publish',
    'posts_per_page' => '-1',
);
	$query = new WP_Query($args);
    $data = array();
	if ($query->have_posts()):
	$data[ "" ] = "None";
    	foreach( $query->posts as $post ):
        	$data[ $post->ID ] = $post->post_title;
        endforeach;
	endif;

	return $data;
}
// The Grid HOOKS
function cesis_check_thegrid_status() {
if(class_exists( 'The_Grid_Plugin' )) {
 return true;
}
else{
	return false;
}
}


// Visual Composer HOOKS
function cesis_check_vc_status() {
if(class_exists( 'Vc_Manager' )) {
 return true;
}
else{
	return false;
}
}

// WooCommerce HOOKS
function cesis_check_woo_status() {
if(class_exists( 'WooCommerce' )) {
	return true;
}
else{
	return false;
}
}
function cesis_is_woocommerce(){
	if(!function_exists("is_woocommerce") && cesis_check_woo_status() == false){
		return false;
	}else{
		return is_woocommerce();
	}
}
add_action( 'after_setup_theme', 'cesis_woocommerce_support' );
function cesis_woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// bbpress HOOKS
function cesis_check_bbp_status() {
if(class_exists( 'bbPress' )) {
	return true;
}
else{
	return false;
}
}
function cesis_is_bbpress(){
	if(!function_exists("is_bbpress") && cesis_check_bbp_status() == false){
		return false;
	}else{
		// Defalt to false
	 $retval = false;
	 /** Archives **************************************************************/
	 if ( bbp_is_forum_archive() ) {
			 $retval = true;
	 } elseif ( bbp_is_topic_archive() ) {
			 $retval = true;
	 /** Topic Tags ************************************************************/
	 } elseif ( bbp_is_topic_tag() ) {
			 $retval = true;
	 } elseif ( bbp_is_topic_tag_edit() ) {
			 $retval = true;
	 /** Components ************************************************************/
	 } elseif ( bbp_is_single_forum() ) {
			 $retval = true;
	 } elseif ( bbp_is_single_topic() ) {
			 $retval = true;
	 } elseif ( bbp_is_single_reply() ) {
			 $retval = true;
	 } elseif ( bbp_is_topic_edit() ) {
			 $retval = true;
	 } elseif ( bbp_is_topic_merge() ) {
			 $retval = true;
	 } elseif ( bbp_is_topic_split() ) {
			 $retval = true;
	 } elseif ( bbp_is_reply_edit() ) {
			 $retval = true;
	 } elseif ( bbp_is_reply_move() ) {
			 $retval = true;
	 } elseif ( bbp_is_single_view() ) {
			 $retval = true;
	 /** User ******************************************************************/
	 } elseif ( bbp_is_single_user_edit() ) {
			 $retval = true;
	 } elseif ( bbp_is_single_user() ) {
			 $retval = true;
	 } elseif ( bbp_is_user_home() ) {
			 $retval = true;
	 } elseif ( bbp_is_user_home_edit() ) {
			 $retval = true;
	 } elseif ( bbp_is_topics_created() ) {
			 $retval = true;
	 } elseif ( bbp_is_favorites() ) {
			 $retval = true;
	 } elseif ( bbp_is_subscriptions() ) {
			 $retval = true;
	 /** Search ****************************************************************/
	 } elseif ( bbp_is_search() ) {
			 $retval = true;
	 } elseif ( bbp_is_search_results() ) {
			 $retval = true;
	 }
	 return $retval;
	}
}


// buddypress HOOKS
function cesis_check_bp_status() {
if(class_exists( 'BuddyPress' )) {
	return true;
}
else{
	return false;
}
}
function cesis_is_buddypress(){
	if(!function_exists("is_buddypress") && cesis_check_bp_status() == false){
		return false;
	}else{
		return is_buddypress();
	}
}

// cesis custom posts HOOKS
function cesis_check_ccp_status() {
if(class_exists( 'cesis_cp_init' )) {
	return true;
}
else{
	return false;
}
}




//Add Theme localization
if(!function_exists('cesis_lang_setup'))
{
	add_action('after_setup_theme', 'cesis_lang_setup');
	function cesis_lang_setup(){
		$lang = apply_filters('cesis', get_template_directory()  . '/languages');
		load_theme_textdomain('cesis', $lang);
	}
}

add_theme_support( 'automatic-feed-links' );
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	/*
	 * Enable support for Post Formats.
	 * See https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array(
		'image',
		'gallery',
		'video',
		'audio',
		'link',
		'quote',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'cesis_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 * Priority 0 to make it available to lower priority callbacks.
 * @global int $content_width
 */
function cesis_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'cesis_content_width', 1250 );
}
add_action( 'after_setup_theme', 'cesis_content_width', 0 );

////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////              Register : Plugins                 ////
///                                                 ////
//                                                 ////
//////////////////////////////////////////////////////

if (get_option( 'enable_full_version' )) {
require_once get_template_directory() . '/includes/tgm/class-tgm-plugin-activation.php';
add_action( 'tgmpa_register', 'cesis_register_required_plugins' );
function cesis_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		// WPbakery page builder
		array(
			'name'               => 'WPBakery Page Builder',
			'slug'     				=> 'js_composer',
			'source'   				=> get_template_directory() . '/includes/tgm/plugins/js_composer.zip',
			'required' 				=> true,
			'version' 				=> '6.0.5',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		// Slider revolution
		array(
			'name'     				=> 'Slider Revolution',
			'slug'     				=> 'revslider',
			'source'   				=> get_template_directory() . '/includes/tgm/plugins/revslider.zip',
			'required' 				=> false,
			'version' 				=> '6.1.5',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		// The Grid
		array(
			'name'     				=> 'The Grid',
			'slug'     				=> 'the-grid',
			'source'   				=> get_template_directory() . '/includes/tgm/plugins/the-grid.zip',
			'required' 				=> false,
			'version' 				=> '2.7.2',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),
		// Layerslider
		array(
			'name'     				=> 'LayerSlider WP',
			'slug'     				=> 'LayerSlider',
			'source'   				=> get_template_directory_uri('template_directory') . '/includes/tgm/plugins/layerslider.zip',
			'required' 				=> false,
			'version' 				=> '6.9.2',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),

		// Envato Market
		array(
			'name'     				=> 'Envato Market',
			'slug'     				=> 'envato-market',
			'source'   				=> get_template_directory_uri('template_directory') . '/includes/tgm/plugins/envato-market.zip',
			'required' 				=> false,
			'version' 				=> '2.0.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
			'external_url' 			=> '',
		),

		// Custom posts plugin
		array(
			'name'               => 'Cesis CP',
			'slug'               => 'cesis_cp',
			'source'             => get_template_directory(). '/includes/tgm/plugins/cesis_cp.zip',
			'required'           => true,
			'version'            => '1.3',
			'force_activation'   => false,
			'force_deactivation' => false,
			'external_url'       => '',
			'is_callable'        => '',
		),


		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'Contact Form 7',
			'slug'      => 'contact-form-7',
			'required'  => false,
		),



	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'cesis',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => true,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.

	);

	tgmpa( $plugins, $config );
}
}
////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////         Register : Sidebar / Menu               ////
///                                                 ////
//                                                 ////
//////////////////////////////////////////////////////

function cesis_widgets_init() {
	if(function_exists('register_sidebar')){
	global $cesis_data;
	// register main sidebar
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'cesis' ),
		'id'            => 'cesis_mc_sidebar',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="cesis_widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="cesis_widget_title">',
		'after_title'   => '</h2>',
	) );

	// register footer sidebar depending on theme options
	if(isset($cesis_data['cesis_footer_columns'])) {
	$footer_columns = $cesis_data['cesis_footer_columns'];
	}
	else {
	$footer_columns = 4;
	}

	for ($i = 1; $i <= $footer_columns; $i++)
	{

	register_sidebar( array(
		'name'          => esc_html__( 'Footer - column '.$i, 'cesis' ),
		'id'            => 'cesis_f_sidebar_'.$i,
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="cesis_f_widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="cesis_f_widget_title">',
		'after_title'   => '</h2>',
	) );
	}

	}

}
add_action( 'widgets_init', 'cesis_widgets_init' );


//  Register menus.
register_nav_menus( array(
		'main-menu' => esc_html__( 'Main Menu', 'cesis' ),
		'mobile-menu' => esc_html__( 'Mobile Menu', 'cesis' ),
		'footer-menu' => esc_html__( 'Footer Menu', 'cesis' ),
		'top-bar-menu' => esc_html__( 'Top Bar Menu', 'cesis' ),
) );


// Enable do_shortcode in text widget

add_filter( 'widget_text', 'do_shortcode');


////////////////////////////////////////////////////////////
//////                                                 ////
/////                                                 ////
////   Register : Scripts and Styles                 ////
///                                                 ////
//                                                 ////
//////////////////////////////////////////////////////


// Load all required script and style
function cesis_scripts() {
	$template_url = get_template_directory_uri();
	$child_theme_url = get_stylesheet_directory_uri();
	$protocol = is_ssl() ? 'https' : 'http';

	wp_enqueue_style( 'cesis-style', get_stylesheet_directory_uri() . '/style.css' );
	wp_enqueue_style( 'custom-style', get_template_directory_uri() . '/css/cesis_media_queries.css');
	wp_enqueue_style( 'cesis-plugins', get_template_directory_uri() . '/css/cesis_plugins.css');
	wp_enqueue_style('cesis-icons', get_template_directory_uri(). '/includes/fonts/cesis_icons/cesis_icons.css');

  if ( cesis_check_ccp_status() == false ) {
	wp_enqueue_style('cesis-init', get_template_directory_uri(). '/css/cesis_init.css');
  }
	wp_enqueue_style( 'cesis-fonts', cesis_fonts_url(), array(), null );

	if( cesis_check_woo_status() == true) {
		if (wp_style_is('cesis-style')){
		wp_enqueue_style( 'cesis_woocommerce', get_template_directory_uri() . '/css/cesis_woocommerce.css');
		}
	}

	if ( !is_admin() ) {
		wp_enqueue_script( 'collapse', get_template_directory_uri(). '/js/cesis_collapse.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'countup', get_template_directory_uri(). '/js/cesis_countup.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'easing', get_template_directory_uri(). '/js/cesis_easing.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'fittext', get_template_directory_uri(). '/js/cesis_fittext.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'fitvids', get_template_directory_uri(). '/js/fitvids.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'fonticonpicker', get_template_directory_uri(). '/js/fonticonpicker.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'lightgallery', get_template_directory_uri(). '/js/lightgallery.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'owlcarousel', get_template_directory_uri(). '/js/owlcarousel.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'scrollmagic', get_template_directory_uri(). '/js/scrollmagic.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'transition', get_template_directory_uri(). '/js/cesis_transition.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'smartmenus', get_template_directory_uri(). '/js/smartmenus.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'imagesLoaded' );
		/* We use custom functions this is not the default isotope so we keep cesis prefix */
		wp_enqueue_script( 'cesis-isotope', get_template_directory_uri(). '/js/isotope.js', array( 'jquery' ), false, true );
		/* We use custom functions this is not the default waipoints so we keep cesis prefix */
		wp_enqueue_script( 'cesis-waypoints', get_template_directory_uri(). '/js/waypoints.js', array( 'jquery' ), false, true );
		/* Theme related custom script so we keep cesis prefix */
		wp_enqueue_script( 'cesis-custom', get_template_directory_uri(). '/js/cesis_custom.js', array( 'jquery' ), false, true );
		if( cesis_check_woo_status() == true) {
			wp_enqueue_script( 'cesis-woocommerce', get_template_directory_uri(). '/js/cesis_woocommerce.js', array( 'jquery' ), false, true );
		}
		if( cesis_check_bp_status() == true) {
			wp_enqueue_script( 'cesis-buddypress', get_template_directory_uri(). '/js/cesis_buddypress.js', array( 'jquery' ), false, true );
		}
	}
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	$ajaxurl = '';
	if( in_array('sitepress-multilingual-cms/sitepress.php', get_option('active_plugins')) ){
		$ajaxurl .= admin_url( 'admin-ajax.php?lang=' . ICL_LANGUAGE_CODE );
	} else{
		$ajaxurl .= admin_url( 'admin-ajax.php');
	}

	wp_localize_script( 'cesis-custom', 'cesis_ajax_val', array(
		'ajaxurl'  => $ajaxurl,
		'noposts'  => esc_html__('No more posts', 'cesis'),
		'loading'  => esc_html__('Loading', 'cesis'),
		'loadmore' => esc_html__('Load more', 'cesis')
	));

}
add_action( 'wp_enqueue_scripts', 'cesis_scripts' );


function cesis_admin_styles() {
		wp_enqueue_style('cesis-icons', get_template_directory_uri(). '/includes/fonts/cesis_icons/cesis_icons.css');
		wp_enqueue_style( 'cesis-plugins', get_template_directory_uri() . '/css/cesis_backend.css');
		wp_enqueue_script('cesis_backend', get_template_directory_uri() . '/js/cesis_backend.js'  );
		wp_enqueue_script( 'collapse', get_template_directory_uri(). '/js/cesis_collapse.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'countup', get_template_directory_uri(). '/js/cesis_countup.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'owlcarousel', get_template_directory_uri(). '/js/owlcarousel.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'fitvids', get_template_directory_uri(). '/js/fitvids.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'scrollmagic', get_template_directory_uri(). '/js/scrollmagic.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'imagesLoaded' );
		/* We use custom functions this is not the default isotope so we keep cesis prefix */
		wp_enqueue_script( 'cesis-isotope', get_template_directory_uri(). '/js/isotope.js', array( 'jquery' ), false, true );
		/* We use custom functions this is not the default waipoints so we keep cesis prefix */
		wp_enqueue_script( 'cesis-waypoints', get_template_directory_uri(). '/js/waypoints.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'lightgallery', get_template_directory_uri(). '/js/lightgallery.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'fonticonpicker', get_template_directory_uri(). '/js/fonticonpicker.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'transition', get_template_directory_uri(). '/js/cesis_transition.js', array( 'jquery' ), false, true );
		wp_enqueue_script( 'smartmenus', get_template_directory_uri(). '/js/smartmenus.js', array( 'jquery' ), false, true );
}
add_action( 'admin_enqueue_scripts', 'cesis_admin_styles' );

function cesis_dynamic_style() {
	if (wp_style_is('cesis-style')){
	Redux::init( 'cesis_data' );
	wp_enqueue_style('dynamic-css', admin_url('admin-ajax.php').'?action=dynamic_css');
	}
}

function cesis_dynamic_css() {Redux::init( 'cesis_data' );
	require(get_template_directory().'/css/dynamic.css.php');
    exit;
}

add_action( 'wp_enqueue_scripts', 'cesis_dynamic_style' );
add_action('wp_ajax_dynamic_css', 'cesis_dynamic_css');
add_action('wp_ajax_nopriv_dynamic_css', 'cesis_dynamic_css');


function cesis_customizer_dynamic_css() {

	echo "<style>";
	include(get_template_directory().'/css/dynamic.css.php');
	echo "</style>";
}

if( is_customize_preview() ){
if ( $wp_customize->is_preview() ) {
    add_action( 'wp_head', 'cesis_customizer_dynamic_css', 21);
}}

////////////////////////////////////////////////////////////////////
//////                                                         ////
/////                                                         ////
////   Register : Theme custom functions and shortcodes      ////
///                                                         ////
//                                                         ////
//////////////////////////////////////////////////////////////

// Add Functions

include_once(get_parent_theme_file_path('functions/cesis_functions.php'));

if( cesis_check_woo_status() == true) {
// Add Woocommerce related Functions
include_once(get_parent_theme_file_path('functions/cesis_woocommerce.php'));
}

if( cesis_check_bp_status() == true) {
// Add Buddypress related Functions
include_once(get_parent_theme_file_path('functions/cesis_buddypress.php'));
}

if( cesis_check_vc_status() == true) {
// Add Shortcodes
include_once(get_parent_theme_file_path('functions/cesis_shortcodes.php'));
//Add Visual Composer functions
include_once(get_parent_theme_file_path('functions/cesis_vc_functions.php'));
}

if( cesis_check_thegrid_status() == true) {
// Add Custom Grids
include_once(get_parent_theme_file_path('functions/cesis_grids.php'));
}

// Add single importer
if (get_option( 'enable_full_version' )) {
require get_parent_theme_file_path('/includes/selective_demo_import/init.php');
}
