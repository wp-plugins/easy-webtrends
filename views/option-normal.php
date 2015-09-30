<h3><?php esc_html_e('Tags', $namespace); ?></h3>
<div class="postbox" style="display: block;">
	<div class="inside">
		<?php $siteurl = get_site_url(); ?>
		<p><label><?php esc_html_e('Tag all pages with:', $namespace); ?></label></p>
		<p><input type="text" name="data[tags]" value="<?php
			echo stripslashes( sanitize_text_field( $this->get_option( 'tags' ) ) )
		?>" /> <em><?php esc_html_e('Separate multiple tags using a comma', $namespace); ?></em></p>
	</div>
</div>