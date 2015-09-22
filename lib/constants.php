<?php
/**
 * Constants used by this plugin
 * 
 * @package EasyWebtrends
 * 
 * @author jcpeden
 * @version 1.1.0
 * @since 1.0.0
 */

// The current version of this plugin
if( !defined( 'EASYWEBTRENDS_VERSION' ) ) define( 'EASYWEBTRENDS_VERSION', '1.1.0' );

// The directory the plugin resides in
if( !defined( 'EASYWEBTRENDS_PATH' ) ) define( 'EASYWEBTRENDS_PATH', dirname( dirname( __FILE__ ) ) );

// The directory name of the plugin
if( !defined( 'EASYWEBTRENDS_DIRNAME' ) ) define( 'EASYWEBTRENDS_DIRNAME', basename( EASYWEBTRENDS_PATH ) );

// The URL path of this plugin
if( !defined( 'EASYWEBTRENDS_URLPATH' ) ) define( 'EASYWEBTRENDS_URLPATH', plugins_url( EASYWEBTRENDS_DIRNAME ) );

if( !defined( 'IS_AJAX_REQUEST' ) ) define( 'IS_AJAX_REQUEST', ( !empty( $_SERVER['HTTP_X_REQUESTED_WITH'] ) && strtolower( $_SERVER['HTTP_X_REQUESTED_WITH'] ) == 'xmlhttprequest' ) );

// simon account
//if( !defined( "STRIPE_PK" ) ) define( "STRIPE_PK", "pk_test_TUiCkSvbt9AtoLHWqvhLpp3d" );
//if( !defined( "STRIPE_SK" ) ) define( "STRIPE_SK", "sk_test_AxnI0gkuLv4EnOqqNzDNDlld" );

// John Test Account
if( !defined( "STRIPE_PK" ) ) define( "STRIPE_PK", "pk_test_ow3rJy6qqCX431xbVTYPmXYd" );
if( !defined( "STRIPE_SK" ) ) define( "STRIPE_SK", "sk_test_w66ZCtVA9fy0Bof2kSvrTOSC" );

// John Live Account
// if( !defined( "STRIPE_PK" ) ) define( "STRIPE_PK", "pk_live_6Y0FXpOLG7WuESLlqvBYBhGs" );
// if( !defined( "STRIPE_SK" ) ) define( "STRIPE_SK", "sk_live_lL0WEvycBDZZjgKokw13oAs4" );

if( !defined( "STRIPE_PLAN" ) ) define( "STRIPE_PLAN", "WP WebTrends Premium" );

if( !defined( "EASYWEBTRENDS_NAME" ) ) define( "EASYWEBTRENDS_NAME", "Easy Webtrends" );