<?php
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://tjhume.dev
 * @since      1.0.0
 *
 * @package    Dynamic_Business_Hours
 * @subpackage Dynamic_Business_Hours/admin/partials
 */

?>

<div class="wrap dbh-admin general">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<div class="tabs">
		<a class="active" href="?page=dynamic-business-hours">General Settings</a>
		<a href="?page=dynamic-business-hours-daily">Daily Settings</a>
	</div>
	<form method="post" action="options.php">

		<?php

		settings_fields( 'dbh-general-settings-options-group' );

		do_settings_sections( 'dbh-general-settings' );

		?>

		<?php submit_button(); ?>
	</form>
</div>
