<?php

    // Load the TGM init if it exists
    if ( file_exists( get_parent_theme_file_path('/admin/tgm/tgm-init.php' )) ) {
        require_once get_parent_theme_file_path('/admin/tgm/tgm-init.php');
    }

    // Load the embedded Redux Framework
    if ( file_exists( get_parent_theme_file_path('/admin/redux-framework/framework.php' )) ) {
        require_once get_parent_theme_file_path('/admin/redux-framework/framework.php');
    }

    // Load the theme/plugin options
    if ( file_exists(get_parent_theme_file_path('/admin/options-init.php' )) ) {
        require_once get_parent_theme_file_path('/admin/options-init.php');
    }

    // Load Redux extensions
    if ( file_exists( get_parent_theme_file_path('/admin/redux-extensions/extensions-init.php' )) ) {
        require_once get_parent_theme_file_path('/admin/redux-extensions/extensions-init.php');
    }
/* notice */
if (!get_option( 'enable_full_version' )) {
function tt_display_admin_notice() {
	if ( ! PAnD::is_admin_notice_active( 'disable-done-notice-forever' ) ) {
		return;
	}
  ?>
  <div class="notice notice-success is-dismissible cesis_notice"><p>To be able to <strong>Install the Plugins and Import the Demo</strong> you need to <strong><a href='/wp-admin/admin.php?page=cesis_options&tab=93' target='_blank'>Activate the theme</a></strong></p></div>
  <?php
}
add_action( 'admin_init', array( 'PAnD', 'init' ) );
add_action( 'admin_notices', 'tt_display_admin_notice' );
}
