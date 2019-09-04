<?php
/**
 * Creates the submenu item for the plugin.
 *
 * @package very_simple_wp_slideshow_Admin_Settings
 */
 
/**
 * Creates the submenu item for the plugin.
 *
 * Registers a new menu item under 'Tools' and uses the dependency passed into
 * the constructor in order to display the page corresponding to this menu item.
 *
 * @package very_simple_wp_slideshow_Admin_Settings
 */
class VSWPSS_Submenu {
	/**
	* A reference the class responsible for rendering the submenu page.
	*
	* @var    submenu_page_vswpss
	* @access private
	*/
    private $submenu_page_vswpss;
    /**
     * Initializes all of the partial classes.
     *
     * @param submenu_page_vswpss $submenu_page_vswpss A reference to the class that renders the
     * page for the plugin.
     */
    public function __construct( $submenu_page_vswpss ) {
        $this->submenu_page_vswpss = $submenu_page_vswpss;
    }
    /**
     * Adds a submenu for this plugin to the 'Tools' menu.
     */
    public function init() {
        add_action( 'admin_menu', array( $this, 'add_options_page' ) );
    }
    /**
     * Creates the submenu item and calls on the Submenu Page object to render
     * the actual contents of the page.
     */
    public function add_options_page() {
        add_options_page(
            'Very Simple WP SlideShow',
            'VSWP SlideShow',
            'manage_options',
            'very-simple-wp-slideshow-settings',
            array( $this->submenu_page_vswpss, 'render' )
        );
    }
}