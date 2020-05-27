<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://tjhume.dev
 * @since      1.0.0
 *
 * @package    Dynamic_Business_Hours
 * @subpackage Dynamic_Business_Hours/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Dynamic_Business_Hours
 * @subpackage Dynamic_Business_Hours/admin
 * @author     TJ Hume <tristanjhume@gmail.com>
 */
class Dynamic_Business_Hours_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string $plugin_name       The name of this plugin.
	 * @param    string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dynamic_Business_Hours_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dynamic_Business_Hours_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, DYNAMIC_BUSINESS_HOURS_URL . 'css/dynamic-business-hours-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Dynamic_Business_Hours_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Dynamic_Business_Hours_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, DYNAMIC_BUSINESS_HOURS_URL . 'js/dynamic-business-hours-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register Admin Menu.
	 *
	 * @since 1.0.0
	 */
	public function add_admin_menu() {
		add_menu_page(
			'Dynamic Business Hours Settings',
			'Dynamic Business Hours',
			'manage_options',
			'dynamic-business-hours',
			array( $this, 'admin_page_display' ),
			'dashicons-clock',
			60
		);

		// Just to rename the first submenu title to General Settings.
		add_submenu_page(
			'dynamic-business-hours',
			'Dynamic Business Hours',
			'General Settings',
			'manage_options',
			'dynamic-business-hours'
		);

		add_submenu_page(
			'dynamic-business-hours',
			'Dynamic Business Hours',
			'Daily Settings',
			'manage_options',
			'dynamic-business-hours-daily',
			array( $this, 'daily_settings_display' )
		);
	}

	/**
	 * Main Admin Page Display.
	 *
	 * @since 1.0.0
	 */
	public function admin_page_display() {
		include_once 'partials/dynamic-business-hours-admin-display.php';
	}

	/**
	 * Daily settings display.
	 *
	 * @since 1.0.0
	 */
	public function daily_settings_display() {
		include_once 'partials/dynamic-business-hours-daily-display.php';
	}

	/**
	 * Runs on admin_init.
	 *
	 * @since 1.0.0
	 */
	public function admin_init() {
		$this->add_settings_sections();

		$this->add_settings_fields();
	}

	/**
	 * Add settings sections.
	 *
	 * @since 1.0.0
	 */
	private function add_settings_sections() {
		add_settings_section( 'dbh-general-section', 'General Settings', '', 'dbh-general-settings' );

		add_settings_section(
			'dbh-usage-section',
			'How to Use',
			function() {
				echo '
					<p>This plugin uses your <a href="http://localhost/wp-admin/options-general.php#timezone_string">WordPress Date/Time settings</a> to determine the starting day of the week, timezone, etc.</p>
					<p>To display your office hours, simply add the following shortcode and style it as you wish: <code>[dbh-hours]</code></p>
					<p>The current day of the week will be given a CSS class of <code>dbh-current-day</code></p>
				';
			},
			'dbh-general-settings'
		);
	}

	/**
	 * Add and register settings fields.
	 *
	 * @since 1.0.0
	 */
	private function add_settings_fields() {
		// General Settings.
		$this->add_time_field( 'dbh_typical_open', 'Typical Opening Time', 'dbh-general-settings', 'dbh-general-section' );
		$this->register_time_field( 'dbh_typical_open', 'dbh-general-settings-options-group' );

		$this->add_time_field( 'dbh_typical_close', 'Typical Closing Time', 'dbh-general-settings', 'dbh-general-section' );
		$this->register_time_field( 'dbh_typical_close', 'dbh-general-settings-options-group' );

		// Daily Settings.
		$week = db_get_week();
	}

	/**
	 * Function that makes it easier to add time fields.
	 *
	 * @since 1.0.0
	 *
	 * @param string $field_name       The base of the field name to be used (ex: dbh_typical_open).
	 * @param string $field_label      The label used by the field.
	 * @param string $settings_page    The page this field will appear on (ex: dbh-general-settings).
	 * @param string $settings_section The section this field will appear in (exL dbh-general-section).
	 */
	private function add_time_field( $field_name, $field_label, $settings_page, $settings_section ) {
		add_settings_field(
			$field_name,
			$field_label,
			function( $arg ) use ( $field_name ) {
				echo '<td>
				<select name="' . esc_attr( $field_name ) . '_hour" id="' . esc_attr( $field_name ) . '_hour">' .
					$this->get_select_hours( $field_name . '_hour') // @codingStandardsIgnoreLine
				. '</select>
				:
				<select name="' . esc_attr( $field_name ) . '_minute" id="' . esc_attr( $field_name ) . '_minute">' .
					$this->get_select_minutes( $field_name . '_minute' ) // @codingStandardsIgnoreLine
				. '</select>
				
				<select name="' . esc_attr( $field_name ) . '_ampm" id="' . esc_attr( $field_name ) . '_ampm">' .
					$this->get_select_ampm( $field_name . '_ampm' ) // @codingStandardsIgnoreLine
				. '</select>
			</td>';
			},
			$settings_page,
			$settings_section
		);
	}

	/**
	 * Function that makes it easer to register/save time fields.
	 *
	 * @since 1.0.0
	 * @param string $field_name   The name of the field being displayed.
	 * @param string $option_group The option group where this field is being displayed.
	 */
	private function register_time_field( $field_name, $option_group ) {
		register_setting(
			$option_group,
			$field_name . '_hour'
		);

		register_setting(
			$option_group,
			$field_name . '_minute'
		);

		register_setting(
			$option_group,
			$field_name . '_ampm'
		);
	}

	/**
	 * Generates hours options in a select.
	 *
	 * @since 1.0.0
	 * @param string $field The name of the field being generated.
	 */
	private function get_select_hours( $field ) {
		$options = '';

		$selected_val = get_option( $field );
		if ( false === $selected_val ) {
			$selected_val = 12;
		} else {
			$selected_val = (int) $selected_val;
		}

		for ( $i = 1; $i <= 12; $i++ ) {
			if ( $i === $selected_val ) {
				$options .= '<option selected value="' . $i . '">' . $i . '</option>';
			} else {
				$options .= '<option value="' . $i . '">' . $i . '</option>';
			}
		}

		return $options;
	}

	/**
	 * Generates minute options in a select.
	 *
	 * @since 1.0.0
	 * @param string $field The name of the field being generated.
	 */
	private function get_select_minutes( $field ) {
		$options = '';

		$selected_val = get_option( $field );
		if ( false === $selected_val ) {
			$selected_val = 0;
		} else {
			$selected_val = (int) $selected_val;
		}

		for ( $i = 0; $i <= 59; $i++ ) {
			$min = sprintf( '%02d', $i );
			if ( $i === $selected_val ) {
				$options .= '<option selected value="' . $min . '">' . $min . '</option>';
			} else {
				$options .= '<option value="' . $min . '">' . $min . '</option>';
			}
		}

		return $options;
	}

	/**
	 * Generates the AM/PM options in a select.
	 *
	 * @since 1.0.0
	 * @param string $field The name of the field being generated.
	 */
	private function get_select_ampm( $field ) {
		$selected_val = get_option( $field );
		if ( false === $selected_val ) {
			$selected_val = 'am';
		}

		if ( 'am' === $selected_val ) {
			return '<option selected value="am">AM</option>
					<option value="pm">PM</option>';
		}

		return '<option value="am">AM</option>
				<option selected value="pm">PM</option>';
	}

}
