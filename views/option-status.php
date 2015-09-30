<h3><?php esc_html_e('Disable Tracking', $namespace); ?> (<?php esc_html_e('Optional', $namespace); ?>)</h3>
<div class="postbox" style="display: block;">
	<div class="inside">
		<p><label><?php esc_html_e('Do not load tracking scripts if URL contains:', $namespace); ?></label></p>
		<p><input class="fatwide" type="text" name="data[disable]" value="<?php
			echo stripslashes( sanitize_text_field( $this->get_option( 'disable' ) ) )
		?>" /> <em><?php esc_html_e('Separate multiple keywords using a comma', $namespace); ?></em></p>
	</div>
</div>