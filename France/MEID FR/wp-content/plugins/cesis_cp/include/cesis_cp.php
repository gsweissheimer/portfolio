<?php


if ( ! class_exists( 'cesis_cp_init' ) ){

class cesis_cp_init {
  function __construct(){
    add_post_type_support( 'post', 'page-attributes' );
    add_post_type_support( 'portfolio', 'page-attributes' );
    add_post_type_support( 'staff', 'page-attributes' );
    add_post_type_support( 'careers', 'page-attributes' );
    add_post_type_support( 'partners', 'page-attributes' );
  }

}

new cesis_cp_init();


if (!class_exists('ZillaLikes')) {
class ZillaLikes {

    function __construct()
    {
    	add_action('admin_init', array(&$this, 'admin_init'));
        add_filter('the_content', array(&$this, 'the_content'));
        add_filter('the_excerpt', array(&$this, 'the_content'));
        add_filter('body_class', array(&$this, 'body_class'));
        add_action('publish_post', array(&$this, 'setup_likes'));
        add_action('wp_ajax_zilla-likes', array(&$this, 'ajax_callback'));
		    add_action('wp_ajax_nopriv_zilla-likes', array(&$this, 'ajax_callback'));
        add_shortcode('zilla_likes', array(&$this, 'shortcode'));
	}

	function admin_init()
	{
		register_setting( 'zilla-likes', 'zilla_likes_settings', array(&$this, 'settings_validate') );
		add_settings_section( 'zilla-likes', '', array(&$this, 'section_intro'), 'zilla-likes' );

		add_settings_field( 'show_on', __( 'Automatically show likes on', 'cesis_cp' ), array(&$this, 'setting_show_on'), 'zilla-likes', 'zilla-likes' );
		add_settings_field( 'exclude_from', __( 'Exclude from Post/Page ID', 'cesis_cp' ), array(&$this, 'setting_exclude_from'), 'zilla-likes', 'zilla-likes' );
		add_settings_field( 'disable_css', __( 'Disable CSS', 'cesis_cp' ), array(&$this, 'setting_disable_css'), 'zilla-likes', 'zilla-likes' );
		add_settings_field( 'ajax_likes', __('AJAX Like Counts', 'cesis_cp'), array(&$this, 'setting_ajax_likes'), 'zilla-likes', 'zilla-likes');
		add_settings_field( 'zero_postfix', __( '0 Count Postfix', 'cesis_cp' ), array(&$this, 'setting_zero_postfix'), 'zilla-likes', 'zilla-likes' );
		add_settings_field( 'one_postfix', __( '1 Count Postfix', 'cesis_cp' ), array(&$this, 'setting_one_postfix'), 'zilla-likes', 'zilla-likes' );
		add_settings_field( 'more_postfix', __( 'More than 1 Count Postfix', 'cesis_cp' ), array(&$this, 'setting_more_postfix'), 'zilla-likes', 'zilla-likes' );
		add_settings_field( 'instructions', __( 'Shortcode and Template Tag', 'cesis_cp' ), array(&$this, 'setting_instructions'), 'zilla-likes', 'zilla-likes' );
	}


	function settings_page()
	{
		?>
		<div class="wrap">
			<div id="icon-themes" class="icon32"></div>
			<h2><?php _e('ZillaLikes Settings', 'cesis_cp'); ?></h2>
			<?php if( isset($_GET['settings-updated']) && $_GET['settings-updated'] ){ ?>
			<div id="setting-error-settings_updated" class="updated settings-error">
				<p><strong><?php _e( 'Settings saved.', 'cesis_cp' ); ?></strong></p>
			</div>
			<?php } ?>
			<form action="options.php" method="post">
				<?php settings_fields( 'zilla-likes' ); ?>
				<?php do_settings_sections( 'zilla-likes' ); ?>
				<p class="submit"><input type="submit" class="button-primary" value="<?php _e( 'Save Changes', 'cesis_cp' ); ?>" /></p>
			</form>
		</div>
		<?php
	}

	function section_intro()
	{
	    ?>
		<p><?php _e('ZillaLikes allows you to display like icons throughout your site. Customize the output of ZillaLike with this settings page.', 'cesis_cp'); ?></p>
		<p><?php _e('Check out our other free <a href="http://www.themezilla.com/plugins/?ref=zillalikes">plugins</a> and <a href="http://www.themezilla.com/themes/?ref=zillalikes">themes</a>.', 'cesis_cp'); ?></p>
		<?php

	}

	function setting_show_on()
	{
		$options = get_option( 'zilla_likes_settings' );
		if( !isset($options['add_to_posts']) ) $options['add_to_posts'] = '0';
		if( !isset($options['add_to_pages']) ) $options['add_to_pages'] = '0';
		if( !isset($options['add_to_other']) ) $options['add_to_other'] = '0';

		echo '<input type="hidden" name="zilla_likes_settings[add_to_posts]" value="0" />
		<label><input type="checkbox" name="zilla_likes_settings[add_to_posts]" value="1"'. (($options['add_to_posts']) ? ' checked="checked"' : '') .' />
		'. __('Posts', 'cesis_cp') .'</label><br />
		<input type="hidden" name="zilla_likes_settings[add_to_pages]" value="0" />
		<label><input type="checkbox" name="zilla_likes_settings[add_to_pages]" value="1"'. (($options['add_to_pages']) ? ' checked="checked"' : '') .' />
		'. __('Pages', 'cesis_cp') .'</label><br />
		<input type="hidden" name="zilla_likes_settings[add_to_other]" value="0" />
		<label><input type="checkbox" name="zilla_likes_settings[add_to_other]" value="1"'. (($options['add_to_other']) ? ' checked="checked"' : '') .' />
		'. __('Blog Index Page, Archive Pages, and Search Results', 'cesis_cp') .'</label><br />';
	}

	function setting_exclude_from()
	{
		$options = get_option( 'zilla_likes_settings' );
		if( !isset($options['exclude_from']) ) $options['exclude_from'] = '';

		echo '<input type="text" name="zilla_likes_settings[exclude_from]" class="regular-text" value="'. $options['exclude_from'] .'" />
		<p class="description">'. __('Comma separated list of post/page ID\'s (e.g. 4,7,87)', 'cesis_cp') . '</p>';
	}

	function setting_disable_css()
	{
		$options = get_option( 'zilla_likes_settings' );
		if( !isset($options['disable_css']) ) $options['disable_css'] = '1';

		echo '<input type="hidden" name="zilla_likes_settings[disable_css]" value="0" />
		<label><input type="checkbox" name="zilla_likes_settings[disable_css]" value="1"'. (($options['disable_css']) ? ' checked="checked"' : '') .' />' . __('I want to use my own CSS styles', 'cesis_cp') . '</label>';

		// Shutterbug conflict warning
		$theme_name = '';
		if(function_exists('wp_get_theme')) $theme_name = wp_get_theme();
		else $theme_name = wp_get_theme();
		if(strtolower($theme_name) == 'shutterbug'){
    		echo '<br /><span class="description" style="color:red">'. __('We recommend you check this option when using the Shutterbug theme to avoid conflicts', 'cesis_cp') .'</span>';
		}
	}

	function setting_ajax_likes()
	{
	    $options = get_option( 'zilla_likes_settings' );
	    if( !isset($options['ajax_likes']) ) $options['ajax_likes'] = '1';

	    echo '<input type="hidden" name="zilla_likes_settings[ajax_likes]" value="0" />
		<label><input type="checkbox" name="zilla_likes_settings[ajax_likes]" value="1"'. (($options['ajax_likes']) ? ' checked="checked"' : '') .' />
		' . __('AJAX Like Counts on page load', 'cesis_cp') . '</label><br />
		<span class="description">'. __('If you are using a cacheing plugin, you may want to dynamically load the like counts via AJAX.', 'cesis_cp') .'</span>';
	}

	function setting_zero_postfix()
	{
		$options = get_option( 'zilla_likes_settings' );
		if( !isset($options['zero_postfix']) ) $options['zero_postfix'] = '';

		echo '<input type="text" name="zilla_likes_settings[zero_postfix]" class="regular-text" value="'. $options['zero_postfix'] .'" /><br />
		<span class="description">'. __('The text after the count when no one has liked a post/page. Leave blank for no text after the count.', 'cesis_cp') .'</span>';
	}

	function setting_one_postfix()
	{
		$options = get_option( 'zilla_likes_settings' );
		if( !isset($options['one_postfix']) ) $options['one_postfix'] = '';

		echo '<input type="text" name="zilla_likes_settings[one_postfix]" class="regular-text" value="'. $options['one_postfix'] .'" /><br />
		<span class="description">'. __('The text after the count when one person has liked a post/page. Leave blank for no text after the count.', 'cesis_cp') .'</span>';
	}

	function setting_more_postfix()
	{
		$options = get_option( 'zilla_likes_settings' );
		if( !isset($options['more_postfix']) ) $options['more_postfix'] = '';

		echo '<input type="text" name="zilla_likes_settings[more_postfix]" class="regular-text" value="'. $options['more_postfix'] .'" /><br />
		<span class="description">'. __('The text after the count when more than one person has liked a post/page. Leave blank for no text after the count.', 'cesis_cp') .'</span>';
	}

	function setting_instructions()
	{
		echo '<p>'. __('To use ZillaLikes in your posts and pages you can use the shortcode:', 'cesis_cp') .'</p>
		<p><code>[zilla_likes]</code></p>
		<p>'. __('To use ZillaLikes manually in your theme template use the following PHP code:', 'cesis_cp') .'</p>
		<p><code>&lt;?php if( function_exists(\'zilla_likes\') ) zilla_likes(); ?&gt;</code></p>';
	}

	function settings_validate($input)
	{
	    $input['exclude_from'] = str_replace(' ', '', trim(strip_tags($input['exclude_from'])));

		return $input;
	}



	function the_content( $content )
	{
	    // Don't show on custom page templates
	    if(is_page_template()) return $content;
	    // Don't show on Stacked slides
	    if(get_post_type() == 'slide') return $content;

		global $wp_current_filter;
		if ( in_array( 'get_the_excerpt', (array) $wp_current_filter ) ) {
			return $content;
		}

		$options = get_option( 'zilla_likes_settings' );
		if( !isset($options['add_to_posts']) ) $options['add_to_posts'] = '0';
		if( !isset($options['add_to_pages']) ) $options['add_to_pages'] = '0';
		if( !isset($options['add_to_other']) ) $options['add_to_other'] = '0';
		if( !isset($options['exclude_from']) ) $options['exclude_from'] = '';

		$ids = explode(',', $options['exclude_from']);
		if(in_array(get_the_ID(), $ids)) return $content;

		if(is_singular('post') && $options['add_to_posts']) $content .= $this->do_likes();
		if(is_page() && !is_front_page() && $options['add_to_pages']) $content .= $this->do_likes();
		if((is_front_page() || is_home() || is_category() || is_tag() || is_author() || is_date() || is_search()) && $options['add_to_other'] ) $content .= $this->do_likes();

		return $content;
	}

	function setup_likes( $post_id )
	{
		if(!is_numeric($post_id)) return;

		add_post_meta($post_id, '_zilla_likes', '0', true);
	}

	function ajax_callback($post_id)
	{

		$options = get_option( 'zilla_likes_settings' );
		if( !isset($options['add_to_posts']) ) $options['add_to_posts'] = '0';
		if( !isset($options['add_to_pages']) ) $options['add_to_pages'] = '0';
		if( !isset($options['add_to_other']) ) $options['add_to_other'] = '0';
		if( !isset($options['zero_postfix']) ) $options['zero_postfix'] = '';
		if( !isset($options['one_postfix']) ) $options['one_postfix'] = '';
		if( !isset($options['more_postfix']) ) $options['more_postfix'] = '';

		if( isset($_POST['likes_id']) ) {
		    // Click event. Get and Update Count
			$post_id = str_replace('zilla-likes-', '', $_POST['likes_id']);
			$rd_update_id = $this->like_this($post_id, $options['zero_postfix'], $options['one_postfix'], $options['more_postfix'], 'update');
			echo !empty( $rd_update_id ) ? $rd_update_id : '';

		} else {
		    // AJAXing data in. Get Count
			$post_id = str_replace('zilla-likes-', '', $_POST['post_id']);
			$rd_get_id = $this->like_this($post_id, $options['zero_postfix'], $options['one_postfix'], $options['more_postfix'], 'get');
			echo !empty( $rd_get_id ) ? $rd_get_id : '';
		}

		exit;
	}

	function like_this($post_id, $zero_postfix = false, $one_postfix = false, $more_postfix = false, $action = 'get')
	{
		if(!is_numeric($post_id)) return;
		$zero_postfix = strip_tags($zero_postfix);
		$one_postfix = strip_tags($one_postfix);
		$more_postfix = strip_tags($more_postfix);

		switch($action) {

			case 'get':
				$likes = get_post_meta($post_id, '_zilla_likes', true);
				if( !$likes ){
					$likes = 0;
					add_post_meta($post_id, '_zilla_likes', $likes, true);
				}

				if( $likes == 0 ) { $postfix = $zero_postfix; }
				elseif( $likes == 1 ) { $postfix = $one_postfix; }
				else { $postfix = $more_postfix; }

				return '<span class="zilla-likes-count">'. $likes .'</span> <span class="zilla-likes-postfix">'. $postfix .'</span>';
				break;

			case 'update':
				$likes = get_post_meta($post_id, '_zilla_likes', true);
				if( isset($_COOKIE['zilla_likes_'. $post_id]) ) return $likes;

				$likes++;
				update_post_meta($post_id, '_zilla_likes', $likes);
				setcookie('zilla_likes_'. $post_id, $post_id, time()*20, '/');

				if( $likes == 0 ) { $postfix = $zero_postfix; }
				elseif( $likes == 1 ) { $postfix = $one_postfix; }
				else { $postfix = $more_postfix; }

				return '<span class="zilla-likes-count">'. $likes .'</span> <span class="zilla-likes-postfix">'. $postfix .'</span>';
				break;

		}
	}

	function shortcode( $atts )
	{
		extract( shortcode_atts( array(
		), $atts ) );

		return $this->do_likes();
	}

	function do_likes()
	{
		global $post;

    $options = get_option( 'zilla_likes_settings' );
		if( !isset($options['zero_postfix']) ) $options['zero_postfix'] = '';
		if( !isset($options['one_postfix']) ) $options['one_postfix'] = '';
		if( !isset($options['more_postfix']) ) $options['more_postfix'] = '';

		$output = $this->like_this($post->ID, $options['zero_postfix'], $options['one_postfix'], $options['more_postfix']);

  		$class = 'zilla-likes';
  		$title = __('Like this', 'cesis_cp');
		if( isset($_COOKIE['zilla_likes_'. $post->ID]) ){
			$class = 'zilla-likes active';
			$title = __('You already like this', 'cesis_cp');
		}

		return '<span class="cesis_like"><a href="#" class="'. $class .'" id="zilla-likes-'. $post->ID .'" title="'. $title .'">'. $output .'</a></span>';
	}

    function body_class($classes) {
        $options = get_option( 'zilla_likes_settings' );

        if( !isset($options['ajax_likes']) ) $options['ajax_likes'] = false;

        if( $options['ajax_likes'] ) {
        	$classes[] = 'ajax-zilla-likes';
    	}
    	return $classes;
    }

}
global $zilla_likes;
$zilla_likes = new ZillaLikes();

/**
 * Template Tag
 */
function zilla_likes()
{
	global $zilla_likes;
	echo ''.$zilla_likes->do_likes();
}


}

if(!class_exists('class_breadcrumb_shortcodes')){

class class_breadcrumb_shortcodes  {


    public function __construct(){

		add_shortcode( 'breadcrumb', array( $this, 'breadcrumb_display' ) );

    }




	public function breadcrumb_display($atts, $content = null ) {
			$atts = shortcode_atts(
				array(
					'themes' => '',

					), $atts);

				$html = '';

				$themes = $atts['themes'];


				$breadcrumb_hide_on_pages = get_option( 'breadcrumb_hide_on_pages' );
				$breadcrumb_hide_on_page_by_id = get_option( 'breadcrumb_hide_on_page_by_id' );

				$hide_page_ids = explode(',', $breadcrumb_hide_on_page_by_id);

				$current_page_id = get_the_ID();

				$html = '';

				$breadcrumb = new cesis_breadcrumb();
				$html.= $breadcrumb->cesis_breadcrumb_html($themes);

				if(is_home() && !empty($breadcrumb_hide_on_pages['home'])){
					return '';
					}
				if(is_front_page() && !empty($breadcrumb_hide_on_pages['front_page'])){
					return '';
					}

				if(is_front_page() && is_home() && !empty($breadcrumb_hide_on_pages['blog_front_page'])){
					return '';
					}
				else{


					if(in_array($current_page_id,$hide_page_ids)){

						return '';

						}
					else{
						return $html;

						}

				}

	}



}


new class_breadcrumb_shortcodes();

}


if(!function_exists('cesis_portfolio_custom_init')){

// Register custom portfolio post
add_action('init', 'cesis_portfolio_custom_init');

function cesis_portfolio_custom_init(){

	global $cesis_data;
	if(isset($cesis_data['cesis_port_slug'])){
		$port_slug = $cesis_data['cesis_port_slug'];
	}
	else {$port_slug = "project"; }


	$labels = array(
		'name' => _x('Projects', 'post type general name', 'cesis_cp'),
		'singular_name' => _x('Project', 'post type singular name', 'cesis_cp'),
		'all_items' => __( 'All Projects', 'cesis_cp' ),
		'add_new' => _x('Add New', 'Project', 'cesis_cp'),
		'add_new_item' => __('Add New Project', 'cesis_cp'),
		'edit_item' => __('Edit Project', 'cesis_cp'),
		'new_item' => __('New Project', 'cesis_cp'),
		'view_item' => __('View Project', 'cesis_cp'),
		'search_items' => __('Search Projects', 'cesis_cp'),
		'not_found' =>  __('No projects found', 'cesis_cp'),
		'not_found_in_trash' => __('No projects found in Trash', 'cesis_cp'),
		'parent_item_colon' => '',
		'menu_name' => 'Portfolio'
	  );

	 $args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array ("slug" => $port_slug ,'with_front' => false),
		'menu_position' => 5,
		'supports' => array('title','editor','thumbnail','comments', 'post-formats', 'author')
	  );
	  register_post_type('portfolio',$args);

	  // Initialize New Taxonomy Labels
	  $labels = array(
		'name' => _x( 'Categories', 'Category general name', 'cesis_cp' ),
		'singular_name' => _x( 'Category', 'taxonomy singular name', 'cesis_cp' ),
		'search_items' =>  __( 'Search Category', 'cesis_cp' ),
		'all_items' => __( 'All Categories', 'cesis_cp' ),
		'parent_item' => __( 'Parent Category', 'cesis_cp' ),
		'parent_item_colon' => __( 'Parent Category:', 'cesis_cp' ),
		'edit_item' => __( 'Edit Category', 'cesis_cp' ),
		'update_item' => __( 'Update Category', 'cesis_cp' ),
		'add_new_item' => __( 'Add New Category', 'cesis_cp' ),
		'new_item_name' => __( 'New Category Name', 'cesis_cp' ),
	  );

     // Custom taxonomy for Project Tags
     register_taxonomy('portfolio_category',array('portfolio'), array(
		'hierarchical' => true,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio_category' ),
	  ));


	  // Initialize New Taxonomy Labels
	  $labels = array(
		'name' => _x( 'Tags', 'taxonomy general name', 'cesis_cp' ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name', 'cesis_cp' ),
		'search_items' =>  __( 'Search Types', 'cesis_cp' ),
		'all_items' => __( 'All Tags', 'cesis_cp' ),
		'parent_item' => __( 'Parent Tag', 'cesis_cp' ),
		'parent_item_colon' => __( 'Parent Tag:', 'cesis_cp' ),
		'edit_item' => __( 'Edit Tags', 'cesis_cp' ),
		'update_item' => __( 'Update Tag', 'cesis_cp' ),
		'add_new_item' => __( 'Add New Tag', 'cesis_cp' ),
		'new_item_name' => __( 'New Tag Name', 'cesis_cp' ),
	  );

     // Custom taxonomy for Project Tags
     register_taxonomy('portfolio_tag',array('portfolio'), array(
		'hierarchical' => true,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'portfolio_tag' ),
	  ));
	}


	// Custom Messages - cesis_project_updated_messages
	add_filter('post_updated_messages', 'cesis_project_updated_messages');

	function cesis_project_updated_messages( $messages ) {
	  global $post, $post_ID;
	  $messages['project'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Project updated. <a href="%s">View project</a>','cesis_cp'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.','cesis_cp'),
		3 => __('Custom field deleted.','cesis_cp'),
		4 => __('Project updated.','cesis_cp'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Project restored to revision from %s','cesis_cp'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Project published. <a href="%s">View project</a>','cesis_cp'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Project saved.','cesis_cp'),
		8 => sprintf( __('Project submitted. <a target="_blank" href="%s">Preview project</a>','cesis_cp'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Project scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview project</a>','cesis_cp'),
		// translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ,'cesis_cp'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Project draft updated. <a target="_blank" href="%s">Preview project</a>','cesis_cp'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  );
	  return $messages;
	}

	/*--- #end SECTION - cesis_project_updated_messages ---*/



  add_action('after_setup_theme', 'cesis_portfolio_custom_init');

}


if(!function_exists('cesis_staff_custom_init')){

// Register custom Staff post
add_action('init', 'cesis_staff_custom_init');

function cesis_staff_custom_init(){

	global $cesis_data;
	if(isset($cesis_data['cesis_staff_slug'])){
		$staff_slug = $cesis_data['cesis_staff_slug'];
	}
	else {$staff_slug = "staff"; }


	$labels = array(
		'name' => _x('Members', 'post type general name', 'cesis_cp'),
		'singular_name' => _x('Member', 'post type singular name', 'cesis_cp'),
		'all_items' => __( 'All Members', 'cesis_cp' ),
		'add_new' => _x('Add New', 'Member', 'cesis_cp'),
		'add_new_item' => __('Add New Member', 'cesis_cp'),
		'edit_item' => __('Edit Member', 'cesis_cp'),
		'new_item' => __('New Member', 'cesis_cp'),
		'view_item' => __('View Member', 'cesis_cp'),
		'search_items' => __('Search Members', 'cesis_cp'),
		'not_found' =>  __('No members found', 'cesis_cp'),
		'not_found_in_trash' => __('No members found in Trash', 'cesis_cp'),
		'parent_item_colon' => '',
		'menu_name' => 'Staff'
	  );

	 $args = array(
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array ("slug" => $staff_slug ,'with_front' => false),
		'menu_position' => 5,
		'supports' => array('title','editor','thumbnail', 'author')
	  );
	  register_post_type('staff',$args);

		// Initialize New Taxonomy Labels
	  $labels = array(
		'name' => _x( 'Groups', 'Category general name', 'cesis_cp' ),
		'singular_name' => _x( 'Group', 'taxonomy singular name', 'cesis_cp' ),
		'search_items' =>  __( 'Search Group', 'cesis_cp' ),
		'all_items' => __( 'All Groups', 'cesis_cp' ),
		'parent_item' => __( 'Parent Group', 'cesis_cp' ),
		'parent_item_colon' => __( 'Parent Group:', 'cesis_cp' ),
		'edit_item' => __( 'Edit Group', 'cesis_cp' ),
		'update_item' => __( 'Update Group', 'cesis_cp' ),
		'add_new_item' => __( 'Add New Group', 'cesis_cp' ),
		'new_item_name' => __( 'New Group Name', 'cesis_cp' ),
	  );

     // Custom taxonomy for Project Tags
     register_taxonomy('staff_group',array('staff'), array(
		'hierarchical' => true,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'staff_group' ),
	  ));

		// Initialize New Taxonomy Labels
	  $labels = array(
		'name' => _x( 'Tags', 'taxonomy general name', 'cesis_cp' ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name', 'cesis_cp' ),
		'search_items' =>  __( 'Search Types', 'cesis_cp' ),
		'all_items' => __( 'All Tags', 'cesis_cp' ),
		'parent_item' => __( 'Parent Tag', 'cesis_cp' ),
		'parent_item_colon' => __( 'Parent Tag:', 'cesis_cp' ),
		'edit_item' => __( 'Edit Tags', 'cesis_cp' ),
		'update_item' => __( 'Update Tag', 'cesis_cp' ),
		'add_new_item' => __( 'Add New Tag', 'cesis_cp' ),
		'new_item_name' => __( 'New Tag Name', 'cesis_cp' ),
	  );

     // Custom taxonomy for Project Tags
     register_taxonomy('staff_tag',array('staff'), array(
		'hierarchical' => true,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'staff_tag' ),
	  ));



	}


	// Custom Messages - cesis_staff_updated_messages
	add_filter('post_updated_messages', 'cesis_staff_updated_messages');

	function cesis_staff_updated_messages( $messages ) {
	  global $post, $post_ID;
	  $messages['staff'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Member updated. <a href="%s">View member</a>','cesis_cp'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.','cesis_cp'),
		3 => __('Custom field deleted.','cesis_cp'),
		4 => __('Member updated.','cesis_cp'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Member restored to revision from %s','cesis_cp'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Member published. <a href="%s">View member</a>','cesis_cp'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Member saved.','cesis_cp'),
		8 => sprintf( __('Member submitted. <a target="_blank" href="%s">Preview member</a>','cesis_cp'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Member scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview member</a>','cesis_cp'),
		// translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ,'cesis_cp'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Member draft updated. <a target="_blank" href="%s">Preview member</a>','cesis_cp'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  );
	  return $messages;
	}

	/*--- #end SECTION - cesis_staff_updated_messages ---*/



  add_action('after_setup_theme', 'cesis_staff_custom_init');

}


if(!function_exists('cesis_partners_custom_init')){

// Register custom partners / sponsor post
add_action('init', 'cesis_partners_custom_init');

function cesis_partners_custom_init(){

    $labels = array(
        'name' => _x('Partners', 'post type general name', 'cesis_cp'),
				'all_items' => __( 'All Partners', 'cesis_cp' ),
        'singular_name' => _x('Partner', 'post type singular name', 'cesis_cp'),
        'add_new' => _x('Add New', 'partner', 'cesis_cp'),
        'add_new_item' => __('Add New Partner', 'cesis_cp'),
        'edit_item' => __('Edit Partner', 'cesis_cp'),
        'new_item' => __('New Partner', 'cesis_cp'),
        'view_item' => __('View Partner', 'cesis_cp'),
        'search_items' => __('Search Partners', 'cesis_cp'),
        'not_found' => __('No partners found', 'cesis_cp'),
        'not_found_in_trash' => __('No partners found in Trash', 'cesis_cp'),
        'parent_item_colon' => '',
        'menu_name' => 'Partners'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array("slug" => "partners" ,'with_front' => false),
        'menu_position' => 5,
        'supports' => array('title','thumbnail', 'author')
	);
    register_post_type('partners', $args);

	  // Initialize New Taxonomy Labels
	  $labels = array(
		'name' => _x( 'Groups', 'taxonomy general name', 'cesis_cp' ),
		'singular_name' => _x( 'Group', 'taxonomy singular name', 'cesis_cp' ),
		'search_items' =>  __( 'Search Groups', 'cesis_cp' ),
		'all_items' => __( 'All Groups', 'cesis_cp' ),
		'parent_item' => __( 'Parent Group', 'cesis_cp' ),
		'parent_item_colon' => __( 'Parent Group:', 'cesis_cp' ),
		'edit_item' => __( 'Edit Groups', 'cesis_cp' ),
		'update_item' => __( 'Update Group', 'cesis_cp' ),
		'add_new_item' => __( 'Add New Group', 'cesis_cp' ),
		'new_item_name' => __( 'New Group Name', 'cesis_cp' ),
	  );

     // Custom taxonomy for Project Tags
     register_taxonomy('groups',array('partners'), array(
		'hierarchical' => true,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'partners-group' ),
	  ));
	}


	// Custom Messages
	add_filter('post_updated_messages', 'cesis_partner_updated_messages');

	function cesis_partner_updated_messages( $messages ) {
	  global $post, $post_ID;
	  $messages['partners'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Partner updated. <a href="%s">View partner</a>','cesis_cp'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.','cesis_cp'),
		3 => __('Custom field deleted.','cesis_cp'),
		4 => __('Partner updated.','cesis_cp'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Partner restored to revision from %s','cesis_cp'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Partner published. <a href="%s">View partner</a>','cesis_cp'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Partner saved.','cesis_cp'),
		8 => sprintf( __('Partner submitted. <a target="_blank" href="%s">Preview partner</a>','cesis_cp'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Partner scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview partner</a>','cesis_cp'),
		// translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ,'cesis_cp'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Partner draft updated. <a target="_blank" href="%s">Preview partner</a>','cesis_cp'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  );
	  return $messages;
	}





add_action('after_setup_theme', 'cesis_partners_custom_init');

}



if(!function_exists('cesis_career_custom_init')){

// Register custom partners / sponsor post
add_action('init', 'cesis_career_custom_init');

// Register Custom Post Type
function cesis_career_custom_init(){

  	global $cesis_data;
  	if(isset($cesis_data['cesis_career_slug'])){
  		$career_slug = $cesis_data['cesis_career_slug'];
  	}
  	else {$career_slug = "careers"; }

    $labels = array(
        'name' => _x('Career Positions', 'post type general name', 'cesis_cp'),
				'all_items' => __( 'All Career Positions', 'cesis_cp' ),
        'singular_name' => _x('Career Position', 'post type singular name', 'cesis_cp'),
        'add_new' => _x('Add New', 'career', 'cesis_cp'),
        'add_new_item' => __('Add New Career Position', 'cesis_cp'),
        'edit_item' => __('Edit Career Position', 'cesis_cp'),
        'new_item' => __('New Career Position', 'cesis_cp'),
        'view_item' => __('View Career Position', 'cesis_cp'),
        'search_items' => __('Search Career Positions', 'cesis_cp'),
        'not_found' => __('No Career Positions found', 'cesis_cp'),
        'not_found_in_trash' => __('No Career Positions found in Trash', 'cesis_cp'),
        'parent_item_colon' => '',
        'menu_name' => 'Career Position'
    );

    $args = array(
        'labels' => $labels,
        'public' => true,
        'show_ui' => true,
        'query_var' => true,
        'rewrite' => array("slug" => $career_slug ,'with_front' => false),
        'menu_position' => 5,
				'supports' => array('title','editor','thumbnail', 'author')
	);
    register_post_type('careers', $args);

  // Initialize New Taxonomy Labels
	$labels = array(
	'name' => _x( 'Categories', 'Category general name', 'cesis_cp' ),
	'singular_name' => _x( 'Category', 'taxonomy singular name', 'cesis_cp' ),
	'search_items' =>  __( 'Search Category', 'cesis_cp' ),
	'all_items' => __( 'All Categories', 'cesis_cp' ),
	'parent_item' => __( 'Parent Category', 'cesis_cp' ),
	'parent_item_colon' => __( 'Parent Category:', 'cesis_cp' ),
	'edit_item' => __( 'Edit Category', 'cesis_cp' ),
	'update_item' => __( 'Update Category', 'cesis_cp' ),
	'add_new_item' => __( 'Add New Category', 'cesis_cp' ),
	'new_item_name' => __( 'New Category Name', 'cesis_cp' ),
	);

	 // Custom taxonomy for Project Tags
	 register_taxonomy('career_category',array('careers'), array(
	'hierarchical' => true,
	'public' => true,
	'labels' => $labels,
	'show_ui' => true,
	'query_var' => true,
	'rewrite' => array( 'slug' => 'career-category' ),
	));
}

	// Custom Messages
	add_filter('post_updated_messages', 'cesis_career_updated_messages');

	function cesis_career_updated_messages( $messages ) {
	  global $post, $post_ID;
	  $messages['careers'] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __('Career position updated. <a href="%s">View career position</a>','cesis_cp'), esc_url( get_permalink($post_ID) ) ),
		2 => __('Custom field updated.','cesis_cp'),
		3 => __('Custom field deleted.','cesis_cp'),
		4 => __('Career position updated.','cesis_cp'),
		/* translators: %s: date and time of the revision */
		5 => isset($_GET['revision']) ? sprintf( __('Career position restored to revision from %s','cesis_cp'), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __('Career position published. <a href="%s">View Career position</a>','cesis_cp'), esc_url( get_permalink($post_ID) ) ),
		7 => __('Career position saved.','cesis_cp'),
		8 => sprintf( __('Career position submitted. <a target="_blank" href="%s">Preview Career position</a>','cesis_cp'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
		9 => sprintf( __('Career position scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Career position</a>','cesis_cp'),
		// translators: Publish box date format, see http://php.net/date
		  date_i18n( __( 'M j, Y @ G:i' ,'cesis_cp'), strtotime( $post->post_date ) ), esc_url( get_permalink($post_ID) ) ),
		10 => sprintf( __('Career position draft updated. <a target="_blank" href="%s">Preview Career position</a>','cesis_cp'), esc_url( add_query_arg( 'preview', 'true', get_permalink($post_ID) ) ) ),
	  );
	  return $messages;
	}





  add_action('after_setup_theme', 'cesis_career_custom_init');

}



if(!function_exists('cesis_content_block_custom_init')){


function cesis_content_block_custom_init()
{
    register_post_type('content_block', array(
        'labels' => array(
            'name' => __('Content blocks', 'cesis_cp'),
            'singular_name' => __('Content block', 'cesis_cp')
        ),
        'public' => true,
        'has_archive' => true,
				'supports' => array('title','editor', 'author'),
    ));
}

add_action('after_setup_theme', 'cesis_content_block_custom_init');

}

// First create the widget for the admin panel
class custom_post_widget extends WP_Widget {
	function __construct() {
		$widget_ops = array( 'classname' => 'widget_custom_post_widget', 'description' => __( 'Displays content block in a widget', 'cesis_cp' ) );
		parent::__construct( 'custom_post_widget', __( 'Content Block', 'cesis_cp' ), $widget_ops );
	}

	function form( $instance ) {
		$custom_post_id = ''; // Initialize the variable
		if (isset($instance['custom_post_id'])) {
			$custom_post_id = esc_attr($instance['custom_post_id']);
		};
		$title = isset($instance['title']) ? $instance['title'] : "";

		?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title ( optional )' ); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'custom_post_id' ); ?>"> <?php echo __( 'Content Block to Display:', 'cesis_cp' ) ?>
				<select class="widefat" id="<?php echo $this->get_field_id( 'custom_post_id' ); ?>" name="<?php echo $this->get_field_name( 'custom_post_id' ); ?>">
				<?php
					$args = array( 'post_type' => 'content_block', 'suppress_filters' => 0, 'numberposts' => -1, 'order' => 'ASC' );
					$content_block = get_posts( $args );
					if ($content_block) {
						foreach( $content_block as $content_block ) : setup_postdata( $content_block );
							echo '<option value="' . $content_block -> ID . '"';
							if( $custom_post_id == $content_block -> ID ) {
								echo ' selected';
								$widgetExtraTitle = $content_block -> post_title;
							};
							echo '>' . $content_block -> post_title . '</option>';
						endforeach;
					} else {
						echo '<option value="">' . __( 'No content blocks available', 'cesis_cp' ) . '</option>';
					};
				?>
				</select>
			</label>
		</p>


		<p>
			<?php
				echo '<a href="post.php?post=' . $custom_post_id . '&action=edit">' . __( 'Edit Content Block', 'cesis_cp' ) . '</a>' ;
			?>
		</p>
 <?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['custom_post_id'] = strip_tags( $new_instance['custom_post_id'] );
		$instance['apply_content_filters'] = $new_instance['apply_content_filters'];
		return $instance;
	}

	// Display the content block content in the widget area
	function widget($args, $instance) {
		extract($args);
		$custom_post_id  = ( $instance['custom_post_id'] != '' ) ? esc_attr($instance['custom_post_id']) : __( 'Find', 'cesis_cp' );
		// Add support for WPML Plugin.
		if ( function_exists( 'icl_object_id' ) ){
			$custom_post_id = icl_object_id( $custom_post_id, 'content_block', true );
		}
		// Variables from the widget settings.
    $title = isset($instance['title']) ? $instance['title'] : "";
		$apply_content_filters  = isset($instance['apply_content_filters']) ? $instance['apply_content_filters'] : false;
		$content_post = get_post( $custom_post_id );
		$post_status = get_post_status( $custom_post_id );
		$content = $content_post->post_content;
		if ( $post_status == 'publish' ) {
			// Display custom widget frontend
			if ( $located = locate_template( 'custom-post-widget.php' ) ) {
				require $located;
				return;
			}
			if ( !$apply_content_filters ) { // Don't apply the content filter if checkbox selected
				$content = apply_filters( 'the_content', $content);
			}
      echo $before_widget;
		  if ( ! empty( $title ) ) echo $before_title. $title . $after_title;
			echo do_shortcode( $content ); // This is where the actual content of the custom post is being displayed
			echo $after_widget;
		}
	}


}

function content_block_widget(){
    register_widget( 'custom_post_widget' );
  }
  add_action( 'widgets_init', 'content_block_widget' );


}
