<?php
/**
 * Constants used by this plugin
 * 
 * @package EasyWebtrends
 * 
 * @author jcpeden
 * @version 1.0.2
 * @since 1.0.0
 */

// The current version of this plugin
if( !defined( 'EASYWEBTRENDS_VERSION' ) ) define( 'EASYWEBTRENDS_VERSION', '1.0.2' );

// The directory the plugin resides in
if( !defined( 'EASYWEBTRENDS_DIRNAME' ) ) define( 'EASYWEBTRENDS_DIRNAME', dirname( dirname( __FILE__ ) ) );

// The URL path of this plugin
if( !defined( 'EASYWEBTRENDS_URLPATH' ) ) define( 'EASYWEBTRENDS_URLPATH', WP_PLUGIN_URL . "/" . plugin_basename( EASYWEBTRENDS_DIRNAME ) );

if( !defined( 'IS_AJAX_REQUEST' ) ) define( 'IS_AJAX_REQUEST', ( !empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) );