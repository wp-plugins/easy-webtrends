<h3><?php esc_html_e('Location', $namespace); ?></h3>
<div class="postbox" style="display: block;">
	<div class="inside">
		<p><input type="radio" name="data[script_location]" value="header" <?php if($this->get_option( 'script_location' ) == 'header') echo 'checked'; ?>> <label><?php esc_html_e('Header', $namespace); ?></label></p>
		<p><input type="radio" name="data[script_location]" value="footer" <?php if($this->get_option( 'script_location' ) == 'footer') echo 'checked'; ?>> <label><?php esc_html_e('Footer', $namespace); ?></label></p>
	</div>
</div>