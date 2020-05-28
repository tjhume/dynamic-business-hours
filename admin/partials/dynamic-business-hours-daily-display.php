<?php
/**
 * The Daily Settings admin area
 *
 * This file is used to markup the daily settings admin area.
 *
 * @link       https://tjhume.dev
 * @since      1.0.0
 *
 * @package    Dynamic_Business_Hours
 * @subpackage Dynamic_Business_Hours/admin/partials
 */

?>

<div class="wrap dbh-admin daily">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<div class="tabs">
		<a href="?page=dynamic-business-hours">General Settings</a>
		<a class="active" href="?page=dynamic-business-hours-daily">Daily Settings</a>
	</div>
	<form method="post" action="options.php">

		<?php

		settings_fields( 'dbh-daily-settings-options-group' );

		do_settings_sections( 'dbh-daily-settings' );

		?>

		<?php submit_button(); ?>
	</form>
</div>
