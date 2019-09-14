<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    exit();
}
?>
<div class="wrap">
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">

		<!-- Identify your business so that you can collect the payments. -->
		<input type="hidden" name="business" value="juan.cha63@gmail.com">

		<!-- Specify a Donate button. -->
		<input type="hidden" name="cmd" value="_donations">

		<!-- Specify details about the contribution -->
		<input type="hidden" name="item_name" value="Very Sinple WordPress SlideShow (WordPress plugin)">
		<input type="hidden" name="currency_code" value="EUR">

		<!-- Display the payment button. -->
		<input type="image" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" alt="Donate">
		<img alt="" width="1" height="1" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

	</form>
    <h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<h3 class="vswpss-help-slideshow" style="display:none"><?php esc_html_e( 'The data was inserted in the form. Make the changes and then save the form', 'very-simple-wp-slideshow' ); ?></h3>
    <form method="post" autocomplete="off" id="vswpss-add-slideshow" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
        <div id="universal-message-container">
            <h2><?php echo  esc_html_e( 'SlideShow Configurator', 'very-simple-wp-slideshow' ); ?></h2>
            <div class="options">
				<p>
					<label><?php esc_html_e( 'Title' ); ?></label>
					<br />
					<input name="vswpss-title" type="text" style="width:300px" class="vswpss-new" id="vswpss-title" value="" maxlength="100" required />
				</p>
                <p>
                    <label><?php esc_html_e( 'Number of images', 'very-simple-wp-slideshow' ); ?></label>
                    <br />
                    <input style="width:65px" id="vswpss-n-slides" type="number" class="vswpss-new" name="vswpss-slides" min="1" max="100" value="1" required />
                </p>
                <p>
                    <label><?php esc_html_e( 'Width slides', 'very-simple-wp-slideshow' ); ?></label>
                    <br />
                    <input style="width:65px" id="vswpss-width-slides" type="number" class="vswpss-new" name="vswpss-width-slides" min="10" max="1999" value="50" required />%
                </p>
                <p>
                    <label><?php esc_html_e( 'Height slides', 'very-simple-wp-slideshow' ); ?></label>
                    <br />
                    <input style="width:65px" id="vswpss-height-slides" type="number" class="vswpss-new" name="vswpss-height-slides" min="10" max="1999" value="400" required />px
                </p>
				<p>	
					<label><?php esc_html_e( 'Link of the images', 'very-simple-wp-slideshow'  ); ?></label>
					<span id="vswpss-add-img"></span>
				</p>
				<p>
					<label><?php esc_html_e( 'Color of the text', 'very-simple-wp-slideshow'  ); ?></label>
					<span id="vswpss-add-color-text"></span>
				</p>
				<p>
					<label><?php esc_html_e( 'Background color of the text', 'very-simple-wp-slideshow'  ); ?></label>
					<span id="vswpss-add-background-color-text"></span>
				</p>
				<p>
					<label><?php esc_html_e( 'Slide text support tag <a>', 'very-simple-wp-slideshow'  ); ?></label>
					<span id="vswpss-add-text"></span>
				</p>
				<input id="vswpss-data-save-img" type="hidden" name="vswpss-data-save-img" required />
				<input id="vswpss-data-save-color-text" type="hidden" name="vswpss-data-save-color-text" required />
				<input id="vswpss-data-save-background-color-text" type="hidden" name="vswpss-data-save-background-color-text" required />
				<input id="vswpss-data-save-text" type="hidden" name="vswpss-data-save-text" required />
				<input id="vswpss-id-slideshow-edit" type="hidden" name="vswpss-edit" value="null" />
				<input type="hidden" name="action" value="vswpss">
			</div>
		</div>
        <?php
            wp_nonce_field( 'settings-save', 'id-message' );
            submit_button( __( 'Save' ) );
        ?>
		<input type="button" id="vswpss-reset" class="button button-primary vswpss-view-input" value="Reset" />
    </form>
</div>
<br />
<p><a id="vswpss-link-data-slideshow" class="vswpss-preview-slideshow" ><?php esc_html_e( 'Preview' ); ?></a></p>
<p><span id="vswpss-paint" style="display:none" ></span><span id="vswpss-dot" style="text-align:center"></span></p>
<br />
<br />
<h3><?php esc_html_e( 'Slide text support tag <a>', 'very-simple-wp-slideshow' ); ?></h3>
<p><?php esc_html_e( 'Click Copy for the selected SlideShow and paste it in the page where you want it to appear.', 'very-simple-wp-slideshow' ); ?></p>
<br />
<div id="vswpss-list-slideshow">
<?php 
	$values = esc_attr( $this->deserializer_vswpss->get_value( 'very\_simple\_wp\_slideshow\_%' ) );
	if( ! empty( $values ) ) {
		$values = explode( '#slideshow#', $values );
		if( count( $values ) > 0 ) {
			foreach( $values as $value ) {
				$idSlideShow = explode( '[', $value );
				$idSlideShow = explode( ',', $idSlideShow[1] );
				$deleteEditId = explode( '=', $idSlideShow[0] );
				$title = $idSlideShow[1];
?>
				<table cellspacing='0' class="vswpss-ul-slideshow">
					<tr>
						<td class="vswpss-preview-slideshow">
							[<?php echo $idSlideShow[0] . ' ' . $title; ?>]
						</td>
						<td class="vswpss-array-data-slideshow"> 
							<span class="vswpss-view-slideshow" id="<?php echo $deleteEditId[1]; ?>" viewSlideShow="<?php echo str_replace( array( '[', ']' ), array( '', '' ), $value ); ?>"></span>
							<input type="button" vswpssId="<?php echo $deleteEditId[1]; ?>" class="button button-primary vswpss-view-input" value="<?php echo __( 'Edit' ); ?>" />
						</td>
						<td>
						</td>
						<td>
							<form class="vswpss-form-slideshow" method="post" autocomplete="off" action="<?php echo esc_html( admin_url( 'admin-post.php' ) ); ?>">
								<input type="hidden" name="delete" value="<?php echo $deleteEditId[1]; ?>" />
								<input type="hidden" name="action" value="vswpss">
							<?php 
								wp_nonce_field( 'settings-save', 'id-message' );
								submit_button( __( 'Delete' ) );
							?>
							</form>
						</td>
						<td>
						</td>
						<td>
							<input class="vswpss-copy-slideshow button button-primary" type="submit" copy="[<?php echo $idSlideShow[0] . ' ' . $title; ?>]" class="button button-primary vswpss-copy" value="<?php echo _e( 'Copy' ); ?> " />
						</td>
						<td>
						</td>
					</tr>
				</table>
<?php
			}	
		} else {
			echo _e( 'Nothing saved', 'very-simple-wp-slideshow' );
		}
	}
?>
</div>