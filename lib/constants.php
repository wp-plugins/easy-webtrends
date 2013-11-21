<?php
/**
 * Constants used by this plugin
 * 
 * @package EasyWebtrends
 * 
 * @author jcpeden
 * @version 1.0.9
 * @since 1.0.0
 */

// The current version of this plugin
if( !defined( 'EASYWEBTRENDS_VERSION' ) ) define( 'EASYWEBTRENDS_VERSION', '1.0.9' );

// The directory the plugin resides in
if( !defined( 'EASYWEBTRENDS_PATH' ) ) define( 'EASYWEBTRENDS_PATH', dirname( dirname( __FILE__ ) ) );

// The directory name of the plugin
if( !defined( 'EASYWEBTRENDS_DIRNAME' ) ) define( 'EASYWEBTRENDS_DIRNAME', basename( EASYWEBTRENDS_PATH ) );

// The URL path of this plugin
if( !defined( 'EASYWEBTRENDS_URLPATH' ) ) define( 'EASYWEBTRENDS_URLPATH', plugins_url( EASYWEBTRENDS_DIRNAME ) );

if( !defined( 'IS_AJAX_REQUEST' ) ) define( 'IS_AJAX_REQUEST', ( !empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) );