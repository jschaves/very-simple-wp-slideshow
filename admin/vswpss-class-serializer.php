<?php
/**
 * Performs all sanitization functions required to save the option values to
 * the database.
 *
 * @package Very_Simple_Wp_SlideShow
 */
 
/**
 * Performs all sanitization functions required to save the option values to
 * the database.
 *
 * This will also check the specified nonce and verify that the current user has
 * permission to save the data.
 *
 * @package Very_Simple_Wp_SlideShow
 */
class VSWPSS_Serializer {
    /**
	* Initializes the function by registering the save function with the
	* admin_post hook so that we can save our options to the database.
	*/
    public function init() {
        add_action( 'admin_post_vswpss', array( $this, 'save' ) );
    }
    /**
     * Validates the incoming nonce value, verifies the current user has
     * permission to save the value from the options page and saves the
     * option to the database.
     */
    public function save() {
        // First, validate the nonce and verify the user as permission to save.
        if( ! ( $this->has_valid_nonce() && current_user_can( 'manage_options' ) ) ) {
            // TODO: Display an error message.
        }
        // If the above are valid, sanitize and save the option.
        if( null !== sanitize_text_field( wp_unslash( $_POST['vswpss-title'] ) ) ) {
			//store in one variable
			if(	sanitize_text_field( wp_unslash( $_POST['vswpss-edit'] ) ) == 'null' ) {
				$id = uniqid();
			} else {
				$id = sanitize_text_field( wp_unslash( $_POST['vswpss-edit'] ) );
			}
			if( !empty( $id ) ) {
				$value = "ID=" . $id . "," .
					"title=" . sanitize_text_field( $_POST['vswpss-title'] ) . "," .
					"width=" . str_replace( ',', 'vswpss', sanitize_text_field( $_POST['vswpss-width-slides'] ) ) . "," .
					"height=" . str_replace( ',', 'vswpss', sanitize_text_field( $_POST['vswpss-height-slides'] ) ) . "," .
					"images=" . str_replace( ',', 'vswpss', sanitize_text_field( $_POST['vswpss-data-save-img'] ) ) . "," .
					"color=" . str_replace( ',', 'vswpss', sanitize_text_field( $_POST['vswpss-data-save-color-text'] ) ) . "," .
					"background=" . str_replace( ',', 'vswpss', sanitize_text_field( $_POST['vswpss-data-save-background-color-text'] ) ) . "," .
					"text=" . str_replace( ',', 'vswpss', wp_kses_post( $_POST['vswpss-data-save-text'] ) );
				update_option( 'very_simple_wp_slideshow_' . $id, $value );
			}
        }
		
        // If the above are valid, sanitize and delete the option.
        if( null !== sanitize_text_field( wp_unslash( $_POST['delete'] ) ) ) {
			//store in one variable
			$value = sanitize_text_field( wp_unslash( $_POST['delete'] ) );
            delete_option( 'very_simple_wp_slideshow_' . $value );
        }
        $this->redirect();
    }
    /**
     * Determines if the nonce variable associated with the options page is set
     * and is valid.
     *
     * @access private
     *
     * @return boolean False if the field isn't set or the nonce value is invalid;
     *                 otherwise, true.
     */
    private function has_valid_nonce() {
        // If the field isn't even in the $_POST, then it's invalid.
        if( ! isset( $_POST['id-message'] ) ) { // Input var okay.
            return false;
        }
        $field  = sanitize_text_field( wp_unslash( $_POST['id-message'] ) );
        $action = 'settings-save';
        return wp_verify_nonce( $field, $action );
    }
    /**
     * Redirect to the page from which we came (which should always be the
     * admin page. If the referred isn't set, then we redirect the user to
     * the login page.
     *
     * @access private
     */
    private function redirect() {
        // To make the Coding Standards happy, we have to initialize this.
        if( !isset( $_POST['_wp_http_referer'] ) ) { // Input var okay.
            $_POST['_wp_http_referer'] = wp_login_url();
        }
        // Sanitize the value of the $_POST collection for the Coding Standards.
        $url = sanitize_text_field( wp_unslash( $_POST['_wp_http_referer'] ) );
        // Finally, redirect back to the admin page.
        wp_safe_redirect( urldecode( $url ) );
        exit();
    }
}