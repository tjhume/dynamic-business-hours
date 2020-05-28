<?php
/**
 * Shortcode: [dbh-hours]
 *
 * Generates a basic view of business hours based on settings.
 *
 * @link       https://tjhume.dev
 * @since      1.0.0
 *
 * @package    Dynamic_Business_Hours
 * @subpackage Dynamic_Business_Hours/includes/shortcodes
 */

?>

<div class="dbh-hours-wrap">
	<div class="dbh-hours">
		<ul>
			<?php
			$typical_content = Dynamic_Business_Hours_Utility::get_hours_content( 'dbh_typical' );
			$todays_day      = date( 'l', current_time( 'timestamp' ) ); // @codingStandardsIgnoreLine - Ignoring since we want to use the offset in this case.

			$week = Dynamic_Business_Hours_Utility::get_week();
			$len  = count( $week );
			for ( $i = 0; $i < $len; $i++ ) {
				$day       = $week[ $i ];
				$lower_day = lcfirst( $day );
				$content   = '';

				// Determine if the store is closed, using typical times, or using custom times.
				$selected = get_option( 'dbh_' . $lower_day . '_options' );
				if ( 'typical_times' !== $selected && 'closed' !== $selected && 'different_times' !== $selected ) {
					$selected = 'typical_times';
				}

				// Sets the content based on selection option.
				if ( 'closed' === $selected ) {
					$content = 'Closed';
				} elseif ( 'different_times' === $selected ) {
					$content = Dynamic_Business_Hours_Utility::get_hours_content( 'dbh_' . $lower_day );
				} else {
					$content = $typical_content;
				}

				// Determines whether today is the current day.
				$today_class = '';
				if ( $day === $todays_day ) {
					$today_class = ' class="dbh-current-day"';
				}

				echo '<li' . esc_attr( $today_class ) . '>' . esc_html( $content ) . '</li>';
			}
			?>
		</ul>
	</div>
</div>
