<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/jschaves/
 * @since             1.0.0
 * @package           Very_Simple_Wp_SlideShow
 *
 * @wordpress-plugin
 * Plugin Name:       Very Simple WP SlideShow
 * Plugin URI:        https://github.com/jschaves/very-simple-wp-slideshow
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Juan Chaves
 * Author URI:        https://github.com/jschaves/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       very-simple-wp-slideshow
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if( !defined( 'WPINC' ) ) {
    exit();
}
// Include the shared dependency.
include_once( plugin_dir_path( __FILE__ ) . 'shared/vswpss-class-deserializer.php' );
// Include the dependencies needed to instantiate the plugin.
foreach( glob( plugin_dir_path( __FILE__ ) . 'admin/*.php' ) as $file ) {
    include_once $file;
}
add_action('plugins_loaded', 'very_simple_wp_slideshow_menu');

// Update CSS within in Admin
function vswpss_admin_style() {
	wp_enqueue_style( 'vswpss-admin-styles', plugin_dir_url( __FILE__ ) . 'admin/css/style.css' );
}
add_action('admin_enqueue_scripts', 'vswpss_admin_style');
// Register Script
function vswpss_admin_footer_js() {
	wp_register_script( 'vswpss-js', plugin_dir_url( __FILE__ ) . 'admin/js/script.js', array( 'jquery' ), '1', true );
	wp_enqueue_script( 'vswpss-js' );
}
// Hook into the 'admin_enqueue_scripts' action
add_action( 'admin_enqueue_scripts', 'vswpss_admin_footer_js' );
// Include the shared and public dependencies.
include_once( plugin_dir_path( __FILE__ ) . 'shared/vswpss-class-deserializer.php' );
include_once( plugin_dir_path( __FILE__ ) . 'public/vswpss-class-content-messenger.php' );
//add languages 
function vswpss_add_languages() {
	load_plugin_textdomain( 'very-simple-wp-slideshow', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}
add_action( 'plugins_loaded', 'vswpss_add_languages' );
/**
 * Starts the plugin.
 *
 * @since 1.0.0
 */
function very_simple_wp_slideshow_menu() {
	// Setup and initialize the class for saving our options.
    $serializer_vswpss = new VSWPSS_Serializer();
    $serializer_vswpss->init();
	// Setup the class used to retrieve our option value.
	$deserializer_vswpss = new VSWPSS_Deserializer();
	// Setup the administrative functionality.
    $plugin_vswpss = new VSWPSS_Submenu( new VSWPSS_Submenu_Page( $deserializer_vswpss ) );
    $plugin_vswpss->init();
	// Setup the public facing functionality.
    $public_vswpss = new VSWPSS_Content_Messenger( $deserializer_vswpss );
    $public_vswpss->init();
}