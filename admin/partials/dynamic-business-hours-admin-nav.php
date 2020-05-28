<?php
/**
 * Echos the admin navigation
 *
 * @link       https://tjhume.dev
 * @since      1.0.0
 *
 * @package    Dynamic_Business_Hours
 * @subpackage Dynamic_Business_Hours/admin/partials
 */

?>

<?php if ( isset( $_GET['settings-updated'] ) ) { // @codingStandardsIgnoreLine ?>
		<div id='message' class='updated'>
		<p><strong><?php esc_html_e( 'Your settings have been updated.' ); ?></strong></p>
		</div>
<?php } ?>

<div class="tabs">
	<?php
	global $submenu;
	global $current_screen;

	$current_page = $current_screen->base;
	$current_page = str_replace( 'toplevel_page_', '', $current_page );
	$current_page = str_replace( $this->plugin_name . '_page_', '', $current_page );

	$plugin_menu = $submenu[ $this->plugin_name ];

	foreach ( $plugin_menu as $menu_item ) {
		$active = '';
		if ( $current_page === $menu_item[2] ) {
			$active = 'active';
		}
		?>
		<a href="?page=<?php echo esc_attr( $menu_item[2] ); ?>" class="<?php echo esc_attr( $active ); ?>"><?php echo esc_html( $menu_item[0] ); ?></a>
		<?php
	}
	?>
</div>
