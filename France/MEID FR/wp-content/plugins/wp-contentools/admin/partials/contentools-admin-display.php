<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://contentools.com/
 * @since      1.0.0
 *
 * @package    Contentools
 * @subpackage Contentools/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

<form method="post" name="contentools_options" action="options.php">

<?php

    $options = get_option( $this->plugin_name );

	settings_fields( $this->plugin_name );
    do_settings_sections( $this->plugin_name );

?>

<table class="form-table">
	<tr class="<?php echo $this->plugin_name; ?>-token-wrap">
		<th scope="row"><label for="<?php echo $this->plugin_name; ?>-token"><?php _e( 'Integration Token', $this->plugin_name ); ?></label></th>
		<td>
            <input 
                readonly="true" 
                type="text" 
                name="<?php echo $this->plugin_name; ?>[token]" 
                id="<?php echo $this->plugin_name; ?>-token" 
                value="<?php if(!empty($options['token'])) esc_attr_e($options['token']); ?>" 
                class="regular-text; form-input"
                style="width:400px; height:28px;" />
            <input 
                type="button" 
                name="<?php echo $this->plugin_name; ?>[generate-token]"
                id="<?php echo $this->plugin_name; ?>-generate-token"
                class="button" 
                value="Generate Token" />
            <input 
                type="button" 
                name="<?php echo $this->plugin_name; ?>[clear-token]"
                id="<?php echo $this->plugin_name; ?>-clear-token"
                class="button" 
                value="Clear Token" />
        </td>
    </tr>
</table>

<?php submit_button( __( 'Save' ), 'primary', 'submit', true ); ?>

</form>