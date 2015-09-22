<script type="text/javascript">var __namespace = '<?php echo $namespace; ?>';</script>
<div class="wrap">
    <div id="webtrends-icon" class="icon32"><img src="<?php echo EASYWEBTRENDS_URLPATH; ?>/images/icon32.png" alt="WP Backitup Icon" height="32" width="32" /></div>
    <h2 class="header"><?php echo $page_title; ?></h2>
    <!--Display update message if options have been updated-->
    <?php if( isset( $_GET['message'] ) ): ?>
        <div id="message" class="updated below-h2"><p><?php esc_html_e('Options successfully updated!', $namespace); ?></p></div>
    <?php endif; ?>
    <p>&nbsp;</p>
    <?php include( EASYWEBTRENDS_PATH . "/views/stripe-form.php" ); ?>
    <form action="" method="post" id="<?php echo $namespace; ?>-form">
    <div id="content">
        <?php wp_nonce_field( $namespace . "-update-options" ); ?>
        <?php include( EASYWEBTRENDS_PATH . "/views/option-location.php" ); ?>
        <?php include( EASYWEBTRENDS_PATH . "/views/option-normal.php" ); ?>
        <?php include( EASYWEBTRENDS_PATH . "/views/option-status.php" ); ?>
        <?php include( EASYWEBTRENDS_PATH . "/views/option-premium.php" ); ?>
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