<?php

/**
 * @package DataConLA
 * @version 0.1
 */
/*
Plugin Name: Data Con LA
Plugin URI: 
Description: 
Author: Calvin Thanh
Version: 0.1
Author URI: https://calvinthanh.com
*/

// Make sure we don't expose any info if called directly
if (!function_exists('add_action')) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('js_composer/js_composer.php')) {
	include_once plugin_dir_path(__FILE__) . 'extend_vc/extendvc.php';
}

add_action('admin_menu', 'dataconla__menu');

function dataconla__menu()
{
	add_menu_page(__('DataConLA'), __('DataConLA'), 'edit_posts', 'dataconla', 'dataconla_general_page', null, 66);
	add_submenu_page(__('dataconla'), __('Speakers'), __('Speakers'), 'edit_posts', 'dataconla_speakers', 'dataconla_speakers_page');
}

function dataconla_general_page()
{
?>

	<div class="wrap">
		<h2>Data Con LA Settings</h2>
		<h3>ReadMe</h3>
		<p>This is a plugin that migrated the features from the DataDayLA theme.</p>

		<?php print_r( get_option( 'theme_options' ) ); ?>
	</div>

<?php
}
function dataconla_speakers_page()
{
	$default_tab = null;
	$tab = isset($_GET['tab']) ? $_GET['tab'] : $default_tab;

?>

	<div class="wrap">
		<h2>Data Con LA Speakers</h2>
		<nav class="nav-tab-wrapper">
			<?php
			$active_year = date("Y");
			for ($year = date("Y"); $year > 2015; $year--) {
				$active_tab = $tab == $year ? "nav-tab-active" : '';
				echo "<a href='?page=dataconla_speakers&tab={$year}' class='nav-tab {$active_tab}'>{$year}</a>";
			}
			?>
		</nav>

		<div class="tab-content">
			<?php require plugin_dir_path(__FILE__) . 'speakers.php'; ?>
		</div>
	</div>

<?php
}

require_once(plugin_dir_path(__FILE__) . "/DataConLA_List_Table.php");

function wpse_load_plugin_css()
{
	$plugin_url = plugin_dir_url(__FILE__);

	wp_enqueue_style('style', $plugin_url . 'css/style.css');
	wp_enqueue_style('font-awesome', $plugin_url . 'css/font-awesome.min.css');
	wp_enqueue_style('bootstrap', $plugin_url . 'css/bootstrap.min.css');
}
add_action('wp_enqueue_scripts', 'wpse_load_plugin_css');
