<?php
/*-----------------------------------------------------------------------------------




	Load Buddypress additional / modified functions




-----------------------------------------------------------------------------------*/

/* Fix buddypress js not loading on WPengine hosted site */

function cesis_remove_heartbeat( $js_dependencies ) {

	$keepers = array();

	foreach( $js_dependencies as $js ) {
		if( $js !== 'heartbeat' ) {
			array_push( $keepers, $js );
		}
	}

	return $keepers;
}
add_filter( 'bp_core_get_js_dependencies', 'cesis_remove_heartbeat', 11, 1 );



if(!function_exists('cesis_cover_image_callback')){

function cesis_cover_image_callback($params = array() ){

		return '
			/* Cover image */
			#header-cover-image {
				background-image:url(' . $params["cover_image"] . ');
			}

			#create-group-form #header-cover-image {
				margin: 1em 0;
				position: relative;
			}

			.bp-user #item-header {
				padding-top: 0;
			}

			#item-header-cover-image #item-header-avatar {
				display:inline-block;
				overflow: visible;
				width: auto;
			}

			div#item-header-cover-image .user-nicename a,
			div#item-header-cover-image .user-nicename {
				font-size: 250%;
				color: #fff;
				text-rendering: optimizelegibility;
				text-shadow: 0 0 3px rgba( 0, 0, 0, 0.1 );
			}

			#item-header-cover-image #item-header-avatar img.avatar {
				border: solid 5px rgba(255, 255, 255, 0.15);
    		border-radius: 50%;
				width:110px;
    		display: block;
			}

			#item-header-cover-image #item-header-avatar a {
				border: 0;
				text-decoration: none;
			}


			#item-header-cover-image #item-buttons:after {
				clear: both;
				content: "";
				display: table;
			}

		';
}

}


if(!function_exists('cesis_cover_image_css')){

	function cesis_cover_image_css( $settings = array() ) {
    	/**
     	* If you are using a child theme, use bp-child-css
     	* as the theme handel
     	*/
    	$theme_handle = 'bp-parent-css';
			if ( is_rtl() ) {
				$theme_handle = 'bp-parent-css-rtl';
			}

    	$settings['theme_handle'] = $theme_handle;
    	/**
     	* Then you'll probably also need to use your own callback function
     	* @see the previous snippet
     	*/
     	$settings['callback'] = 'cesis_cover_image_callback';

			return $settings;
	}
	add_filter( 'bp_before_xprofile_cover_image_settings_parse_args', 'cesis_cover_image_css', 10, 1 );
	add_filter( 'bp_before_groups_cover_image_settings_parse_args', 'cesis_cover_image_css', 10, 1 );
}


if(!function_exists('cesis_bp_activity_delete_link')){
	function cesis_bp_activity_delete_link() {
 		echo cesis_bp_get_activity_delete_link();
	}
}

if(!function_exists('cesis_bp_get_activity_delete_link')){
	function cesis_bp_get_activity_delete_link() {
		$url   = bp_get_activity_delete_url();
		$class = 'delete-activity';

		// Determine if we're on a single activity page, and customize accordingly.
		if ( bp_is_activity_component() && is_numeric( bp_current_action() ) ) {
			$class = 'delete-activity-single';
		}

		$link = '<a href="' . esc_url( $url ) . '" class="button item-button bp-secondary-action ' . $class . ' confirm" rel="nofollow"></a>';

		/**
	 	* Filters the activity delete link.
	 	*
	 	* @since 1.1.0
	 	*
	 	* @param string $link Activity delete HTML link.
	 */
		return apply_filters( 'bp_get_activity_delete_link', $link );
	}
}


if(!function_exists('cesis_bp_notifications_menu')){
function cesis_bp_notifications_menu() {
global $bp;

if ( !is_user_logged_in() )
    return false;

echo '<li id="top-notification">';
_e( 'Alerts', 'buddypress' );

if ( $notifications = bp_notifications_get_notifications_for_user( $bp->loggedin_user->id ) ) { ?>
    <span><?php echo count( $notifications ) ?></span>
<?php
}

echo '</a>';
echo '<ul>';

if ( $notifications ) {
    $counter = 0;
    for ( $i = 0; $i < count($notifications); $i++ ) {
        $alt = ( 0 == $counter % 2 ) ? ' class="alt"' : ''; ?>

        <li<?php echo $alt ?>><?php echo $notifications[$i] ?></li>

        <?php $counter++;
    }
} else { ?>

    <li><a href="<?php echo $bp->loggedin_user->domain ?>"><?php _e( 'You have no new alerts.', 'buddypress' ); ?></a></li>

<?php
}

echo '</ul>';
echo '</li>';
}
}

if(!function_exists('cesis_bp_notifications')){
	function cesis_bp_notifications($type, $style) {
 		if($type == 't'){
			$bp_notifications = '
			<span class="cesis_bp_notifications no_icons '.$style.' ">';
			if(function_exists('bp_get_friends_slug')){
				$bp_notifications .=	'<span class="cesis_bp_friends_notifications"><a href="' . esc_url(  bp_loggedin_user_domain() . bp_get_friends_slug()) . '">'.__('Friend requests', 'cesis').'<span class="cesis_bp_notifications_count">'.bp_friend_get_total_requests_count().'</span></a></span>';
			}
			if(function_exists('bp_get_messages_slug')){
			$bp_notifications .=	'<span class="cesis_bp_messages_notifications"><a href="' . esc_url(  bp_loggedin_user_domain() . bp_get_messages_slug()) . '">'.__('Messages', 'cesis').'<span class="cesis_bp_notifications_count">'.bp_get_total_unread_messages_count().'</span></a></span>';
			}
			if(function_exists('bp_get_notifications_permalink')){
			$bp_notifications .=	'<span class="cesis_bp_all_notifications"><a href="' . esc_url( bp_get_notifications_permalink() ) . '">'.__('Notifications', 'cesis').'<span class="cesis_bp_notifications_count">'.bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ).'</span></a></span>';
			}
			$bp_notifications .=	'</span>';
		}
		if($type == 'ti'){
			$bp_notifications = '
			<span class="cesis_bp_notifications has_icons '.$style.' ">';
			if(function_exists('bp_get_friends_slug')){
				$bp_notifications .=	'<span class="cesis_bp_friends_notifications"><a href="' . esc_url(  bp_loggedin_user_domain() . bp_get_friends_slug()) . '">'.__('Friend requests', 'cesis').'<i class="fa-friend"></i><span class="cesis_bp_notifications_count">'.bp_friend_get_total_requests_count().'</span></a></span>';
			}
			if(function_exists('bp_get_messages_slug')){
				$bp_notifications .=	'<span class="cesis_bp_messages_notifications"><a href="' . esc_url(  bp_loggedin_user_domain() . bp_get_messages_slug()) . '">'.__('Messages', 'cesis').'<i class="fa-chat2"></i><span class="cesis_bp_notifications_count">'.bp_get_total_unread_messages_count().'</span></a></span>';
			}
			if(function_exists('bp_get_notifications_permalink')){
				$bp_notifications .=	'<span class="cesis_bp_all_notifications"><a href="' . esc_url( bp_get_notifications_permalink() ) . '">'.__('Notifications', 'cesis').'<i class="fa-bell3"></i><span class="cesis_bp_notifications_count">'.bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ).'</span></a></span>';
			}
			$bp_notifications .=	'</span>';
		}
		if($type == 'v'){
			$bp_notifications = '
			<span class="cesis_bp_notifications has_icons vertical '.$style.' ">';
			if(function_exists('bp_get_friends_slug')){
				$bp_notifications .=	'<span class="cesis_bp_friends_notifications"><a href="' . esc_url(  bp_loggedin_user_domain() . bp_get_friends_slug()) . '"><i class="fa-friend"><span class="cesis_bp_notifications_count">'.bp_friend_get_total_requests_count().'</span></i>'.__('Friend requests', 'cesis').'</a></span>';
			}
			if(function_exists('bp_get_messages_slug')){
				$bp_notifications .=	'<span class="cesis_bp_messages_notifications"><a href="' . esc_url(  bp_loggedin_user_domain() . bp_get_messages_slug()) . '"><i class="fa-chat2"><span class="cesis_bp_notifications_count">'.bp_get_total_unread_messages_count().'</span></i>'.__('Messages', 'cesis').'</a></span>';
			}
			if(function_exists('bp_get_notifications_permalink')){
				$bp_notifications .=	'<span class="cesis_bp_all_notifications"><a href="' . esc_url( bp_get_notifications_permalink() ) . '"><i class="fa-bell3"><span class="cesis_bp_notifications_count">'.bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ).'</span></i>'.__('Notifications', 'cesis').'</a></span>';
			}
			$bp_notifications .=	'</span>';
		}
		if($type == 'i'){
			$bp_notifications = '
			<span class="cesis_bp_notifications only_icons '.$style.' ">';
			if(function_exists('bp_get_friends_slug')){
				$bp_notifications .=	'<span class="cesis_bp_friends_notifications"><a href="' . esc_url(  bp_loggedin_user_domain() . bp_get_friends_slug()) . '"><i class="fa-friend"><span class="cesis_bp_notifications_count">'.bp_friend_get_total_requests_count().'</span></i></a></span>';
			}
			if(function_exists('bp_get_messages_slug')){
				$bp_notifications .=	'<span class="cesis_bp_messages_notifications"><a href="' . esc_url(  bp_loggedin_user_domain() . bp_get_messages_slug()) . '"><i class="fa-chat2"><span class="cesis_bp_notifications_count">'.bp_get_total_unread_messages_count().'</span></i></a></span>';
			}
			if(function_exists('bp_get_notifications_permalink')){
				$bp_notifications .=	'<span class="cesis_bp_all_notifications"><a href="' . esc_url( bp_get_notifications_permalink() ) . '"><i class="fa-bell3"><span class="cesis_bp_notifications_count">'.bp_notifications_get_unread_notification_count( bp_loggedin_user_id() ).'</span></i></a></span>';
			}
			$bp_notifications .=	'</span>';
		}
		return $bp_notifications;
	}
}


?>
