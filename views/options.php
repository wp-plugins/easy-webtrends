<script type="text/javascript">var __namespace = '<?php echo $namespace; ?>';</script>
<div class="wrap">
    <div id="webtrends-icon" class="icon32"><img src="<?php echo EASYWEBTRENDS_URLPATH; ?>/images/icon32.png" alt="WP Backitup Icon" height="32" width="32" /></div>
    <h2><?php echo $page_title; ?></h2>
    <!--Display update message if options have been updated-->
    <?php if( isset( $_GET['message'] ) ): ?>
        <div id="message" class="updated below-h2"><p><?php _e('Options successfully updated!', $namespace); ?></p></div>
    <?php endif; ?>
    <form action="" method="post" id="<?php echo $namespace; ?>-form">
    <div id="content">
        <?php wp_nonce_field( $namespace . "-update-options" ); ?>
        <h3><?php _e('Tracking Code', $namespace); ?></h3>
        <?php //modify tracking code before output
            $tracking_code = stripslashes($this->get_option( 'tracking_code' ));
            
            //insert opening and clsoing script tags
            $tracking_code = str_replace ( 'window.webtrendsAsyncInit' , '<script>window.webtrendsAsyncInit' , $tracking_code );
            $tracking_code = str_replace ( '<img alt="dcsimg"' , '</script><img alt="dcsimg"' , $tracking_code );
            
            //Fix ampersands (& to &amp;)
            $tracking_code = str_replace ( '&' , '&amp;' , $tracking_code );
        ?>
        <textarea name="data[tracking_code]" cols="40" rows="10"><?php echo $tracking_code; ?></textarea>

        <h3><?php _e('Version', $namespace); ?></h3>
        <p><input type="radio" name="data[tracking_code_version]" value="/js/webtrends.v9.js" <?php if($this->get_option( 'tracking_code_version' ) == "/js/webtrends.v9.js") echo 'checked'; ?> /> <label><?php _e('v9', $namespace); ?></label></p>
        <p><input type="radio" name="data[tracking_code_version]" value="/js/webtrends.v10.js" <?php if($this->get_option( 'tracking_code_version' ) == "/js/webtrends.v10.js") echo 'checked'; ?> /> <label><?php _e('v10', $namespace); ?></label><p>
        
        <h3><?php _e('Location', $namespace); ?></h3>
        <p><input type="radio" name="data[script_location]" value="header" <?php if($this->get_option( 'script_location' ) == 'header') echo 'checked'; ?>> <label><?php _e('Header', $namespace); ?></label></p>
        <p><input type="radio" name="data[script_location]" value="footer" <?php if($this->get_option( 'script_location' ) == 'footer') echo 'checked'; ?>> <label><?php _e('Footer', $namespace); ?></label></p>
        
        <h3><?php _e('Tags', $namespace); ?></h3>
        <p><label><?php _e('Tag all pages with:', $namespace); ?></label></p>
        <p><input type="text" name="data[tags]" value="<?php echo $this->get_option( 'tags' ); ?>" /> <em><?php _e('Separate multiple tags using a comma', $namespace); ?></em></p>
        
        <h2><?php _e('Optional', $namespace); ?></h2>
        <h3><?php _e('Disable Tracking', $namespace); ?></h3>
        <p><label><?php _e('Do not load tracking scripts if URL contains:', $namespace); ?></label></p>
        <p><input type="text" name="data[disable]" value="<?php echo $this->get_option( 'disable' ); ?>" /> <em><?php _e('Separate multiple keywords using a comma', $namespace); ?></em></p>
        
        <h3><?php _e('Custom Rules', $namespace); ?></h3>
        <p><?php _e('These rules create a custom meta tag on all your posts/pages that match each rule. They can be manually overridden on each individual page/post.', $namespace); ?></p>
        <p><?php _e('Number of custom rules', $namespace); ?> <select name="data[custom_rules]"><?php for ($i = 1; $i <= 10; $i++ ) {
            if ($i == $this->get_option( 'custom_rules' )) {
                echo '<option selected>' .$i .'</option>';
            } else {
                echo '<option>' .$i .'</option>'; 
            }
        } ?>
        </select></p>
        <?php for ($i = 1; $i <= $this->get_option( 'custom_rules' ); $i++ ) {
            $output = '<p>'.__('If URL contains', $namespace) .' <input name="data[custom_rule_' .$i .'_string]" type="text" value="' .$this->get_option( 'custom_rule_' .$i .'_string' ) .'" /> ' .__('tag with', $namespace) .' <input name="data[custom_rule_' .$i .'_tag]" type="text" value="' .$this->get_option( 'custom_rule_' .$i .'_tag' ) .'"/></p>';    
            echo $output;
        } ?>
        <p><em><?php _e('Separate multiple tags using a comma', $namespace); ?></em></p>
        <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="<?php _e( "Save Changes", $namespace ) ?>" />
        </p>
    </div>

    <div id="sidebar">
        <div class="widget">
            <h2 class="promo"><?php _e('Need support?', $namespace); ?></h2>
            <p><?php _e('If you are having problems with this plugin please talk about them in the', $namespace); ?> <a href="http://wordpress.org/support/plugin/easy-webtrends"><?php _e('support forum', $namespace); ?></a>.</p>
        </div>
        <div class="widget">
            <h2 class="promo"><?php _e('Presstrends', $namespace); ?></h3>
                <p><?php _e('Help to improve Easy Webtrends by enabling', $namespace); ?> <a href="http://www.presstrends.io" target="_blank">Presstrends</a>.</p>
            <p><input type="radio" name="data[presstrends]" value="enabled" <?php if($this->get_option( 'presstrends' ) == 'enabled') echo 'checked'; ?>> <label><?php _e('Enable', $namespace); ?></label></p>
            <p><input type="radio" name="data[presstrends]" value="disabled" <?php if($this->get_option( 'presstrends' ) == 'disabled') echo 'checked'; ?>> <label><?php _e('Disable', $namespace); ?></label></p>
            <p class="submit">
            <input type="submit" name="Submit" class="button-primary" value="<?php _e( "Save Changes", $namespace ) ?>" />
        </p>
        </div>
    </div>
    </form>
</div>