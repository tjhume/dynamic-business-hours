<?php
/**
 * Contains static functions that are likely to be used throughout the plugin.
 *
 * @link       https://tjhume.dev
 * @since      1.0.0
 *
 * @package    Dynamic_Business_Hours
 * @subpackage Dynamic_Business_Hours/includes
 */

/**
 * Contains static functions that are likely to be used throughout the plugin.
 *
 * @since      1.0.0
 * @package    Dynamic_Business_Hours
 * @subpackage Dynamic_Business_Hours/includes
 * @author     TJ Hume <tristanjhume@gmail.com>
 */
class Dynamic_Business_Hours_Utility {

	/**
	 * Returns the string for hours in format H:MM AMPM - H:MM AMPM
	 *
	 * @since 1.0.0
	 * @param string $field_base The base of the field to get the hours for (ex: dbh_typical or dbh_monday).
	 *
	 * @since    1.0.0
	 */
	public static function get_hours_content( $field_base ) {
		$open_hour = get_option( $field_base . '_open_hour' );
		if ( false === $open_hour ) {
			$open_hour = '12';
		}

		$open_minute = get_option( $field_base . '_open_minute' );
		if ( false === $open_minute ) {
			$open_minute = '00';
		}

		$open_ampm = get_option( $field_base . '_open_ampm' );
		if ( false === $open_ampm ) {
			$open_ampm = 'AM';
		}
		$open_ampm = strtoupper( $open_ampm );

		$close_hour = get_option( $field_base . '_close_hour' );
		if ( false === $close_hour ) {
			$close_hour = '12';
		}

		$close_minute = get_option( $field_base . '_close_minute' );
		if ( false === $close_minute ) {
			$close_minute = '00';
		}

		$close_ampm = get_option( $field_base . '_close_ampm' );
		if ( false === $close_ampm ) {
			$close_ampm = 'AM';
		}
		$close_ampm = strtoupper( $close_ampm );

		return $open_hour . ':' . $open_minute . ' ' . $open_ampm . ' - ' . $close_hour . ':' . $close_minute . ' ' . $close_ampm;
	}

	/**
	 * Gets the week as an array with WordPress's starting day as the first day.
	 *
	 * @since 1.0.0
	 */
	public static function get_week() {
		$start_day = get_option( 'start_of_week' );
		$week      = array( 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday' );

		for ( $i = $start_day; $i > 0; $i-- ) {
			$shift_day = $week[0];
			array_shift( $week );
			array_push( $week, $shift_day );
		}
		return $week;
	}

}
