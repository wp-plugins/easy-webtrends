<script type="text/javascript">var __namespace = '<?php echo $namespace; ?>';</script>
<div class="wrap">
    <div id="webtrends-icon" class="icon32"><img src="<?php echo EASYWEBTRENDS_URLPATH; ?>/images/icon32.png" alt="WP Backitup Icon" height="32" width="32" /></div>
    <h2><?php echo $page_title; ?></h2>
    <!--Display update message if options have been updated-->
    <?php if( isset( $_GET['message'] ) ): ?>
        <div id="message" class="updated below-h2"><p><?php esc_html_e('Options successfully updated!', $namespace); ?></p></div>
    <?php endif; ?>
    <form action="" method="post" id="<?php echo $namespace; ?>-form">
    <div id="content">
        <?php wp_nonce_field( $namespace . "-update-options" ); ?>
        <h3><?php esc_html_e('Location', $namespace); ?></h3>
        <p><input type="radio" name="data[script_location]" value="header" <?php if($this->get_option( 'script_location' ) == 'header') echo 'checked'; ?>> <label><?php esc_html_e('Header', $namespace); ?></label></p>
        <p><input type="radio" name="data[script_location]" value="footer" <?php if($this->get_option( 'script_location' ) == 'footer') echo 'checked'; ?>> <label><?php esc_html_e('Footer', $namespace); ?></label></p>
        
        <h3><?php esc_html_e('Tags', $namespace); ?></h3>
        <?php $siteurl = get_site_url(); ?>
        <p><label><?php esc_html_e('Tag all pages with:', $namespace); ?></label></p>
        <p><input type="text" name="data[tags]" value="<?php
        	echo stripslashes( sanitize_text_field( $this->get_option( 'tags' ) ) )
        ?>" /> <em><?php esc_html_e('Separate multiple tags using a comma', $namespace); ?></em></p>
        
        <h3><?php esc_html_e('Disable Tracking', $namespace); ?> (<?php esc_html_e('Optional', $namespace); ?>)</h3>
        <p><label><?php esc_html_e('Do not load tracking scripts if URL contains:', $namespace); ?></label></p>
        <p><input type="text" name="data[disable]" value="<?php
        	echo stripslashes( sanitize_text_field( $this->get_option( 'disable' ) ) )
        ?>" /> <em><?php esc_html_e('Separate multiple keywords using a comma', $namespace); ?></em></p>
        
        <h3><?php esc_html_e('Custom Rules', $namespace); ?> (<?php esc_html_e('Optional', $namespace); ?>)</h3>
        <p><?php esc_html_e('These rules create a custom meta tag on all your posts/pages that match each rule. They can be manually overridden on each individual page/post.', $namespace); ?></p>
        <p><?php esc_html_e('Number of custom rules', $namespace); ?> <select name="data[custom_rules]"><?php for ($i = 1; $i <= 40; $i++ ) {
            if ($i == intval ( $this->get_option( 'custom_rules' ) ) ) {
                echo '<option selected>' .$i .'</option>';
            } else {
                echo '<option>' .$i .'</option>'; 
            }
        } ?>
        </select></p>
        <?php for ($i = 1; $i <= $this->get_option( 'custom_rules' ); $i++ ) {
            $output = '<p>'.__('If URL contains', $namespace) .' <input name="data[custom_rule_' .$i .'_string]" type="text" value="'
            . stripslashes( sanitize_text_field( $this->get_option( 'custom_rule_' .$i .'_string' ) ) ) .'" /> '
            . __('tag with', $namespace) .' <input name="data[custom_rule_' .$i .'_tag]" type="text" value="'
            . stripslashes( sanitize_text_field( $this->get_option( 'custom_rule_' .$i .'_tag' ) ) ) . '"/></p>';
            echo $output;
        } ?>
        <p><em><?php esc_html_e('Separate multiple tags using a comma', $namespace); ?></em></p>
        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="<?php esc_html_e( "Save Changes", $namespace ) ?>" />
        </p>
    </div>

    <div id="sidebar">
        <div class="widget">
            <h2 class="promo"><?php esc_html_e('Need support?', $namespace); ?></h2>
            <p><?php esc_html_e('If you are having problems with this plugin please talk about them in the', $namespace); ?> <a href="http://wordpress.org/support/plugin/easy-webtrends"><?php esc_html_e('support forum', $namespace); ?></a>.</p>
        </div>
    </div>
    </form>
</div>