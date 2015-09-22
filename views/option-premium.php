<h3><?php esc_html_e('Custom Rules', $namespace); ?> (<?php esc_html_e('Optional', $namespace); ?>)</h3>
<div class="postbox" style="display: block;">
    <div class="inside">
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
    </div>
</div>
