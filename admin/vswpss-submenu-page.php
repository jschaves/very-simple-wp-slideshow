<?php

/**
 * Creates the submenu page for the plugin.
 *
 * @package very_simple_wp_slideshow_Admin_Settings
 */
 
/**
 * Creates the submenu page for the plugin.
 *
 * Provides the functionality necessary for rendering the page corresponding
 * to the submenu with which this page is associated.
 *
 * @package very_simple_wp_slideshow_Admin_Settings
 */
class VSWPSS_Submenu_Page {
	/**
	* This function renders the contents of the page associated with the Submenu
	* that invokes the render method. In the context of this plugin, this is the
	* Submenu class.
	*/
	private $deserializer_vswpss;
	public function __construct( $deserializer_vswpss ) {
		$this->deserializer_vswpss = $deserializer_vswpss;
	}
	
    public function render() {
        include_once( 'views/vswpss-settings.php' );
    }
}