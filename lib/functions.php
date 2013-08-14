<?php
/**
 * Template functions Easy Webtrends
 * 
 * @package EasyWebtrends
 * 
 * @author jcpeden
 * @version 1.0.0
 * @since 1.0.0
 */

function load_webtrends_javascript() {
	global $EasyWebtrends;
	$tracking_code = $EasyWebtrends->get_option( 'tracking_code' );
	//if user has specified tracking code
		if(strstr($tracking_code, 'Version: 9')) {
			$version = '9';
		} else {
			$version = '10';
		}
	$location = $EasyWebtrends->get_option( 'script_location' );
	if($location == 'header') {
		wp_enqueue_script('webtrends_js' , EASYWEBTRENDS_URLPATH .'/js/webtrends.v' .$version .'.js' , array( 'jquery' ), $version, false );
	} if($location =='footer') {
		wp_enqueue_script('webtrends_js' , EASYWEBTRENDS_URLPATH .'/js/webtrends.v' .$version .'.js' , array( 'jquery' ), $version, true);
	}
}
add_action('wp_enqueue_scripts', 'load_webtrends_javascript');

function webtrends_tracking_code() {
	global $EasyWebtrends;
	$tracking_code = stripslashes( $EasyWebtrends->get_option( 'tracking_code' ) );
	
	//if user has specified tracking code
	if(strstr($tracking_code, '<!-- START OF SmartSource Data Collector TAG')) {

		//Get current URL
		$current_url = $_SERVER['REQUEST_URI'];
	
		//Return false if the URL contains a disbaled string
		$disable = $EasyWebtrends->get_option( 'disable' );
		if ($disable != '') {
			$disable = str_replace(' ', '', $disable);
			$disable_strings = explode(",", $disable);

			foreach ($disable_strings as $disable_string) {
				if( strstr($current_url, $disable_string) ) {
					return false;
				}
			}
		}
			
		//modify tracking code for site 
		if(strstr($tracking_code, 'Version: 9')) {
			str_replace("/scripts/webtrends.js", EASYWEBTRENDS_URLPATH .'/js/webtrends.v9.js', $tracking_code);
		} else {
			str_replace("/scripts/webtrends.min.js", EASYWEBTRENDS_URLPATH .'/js/webtrends.v10.js', $tracking_code);
		}

			//Insert opening and clsoing script tags
			$tracking_code = str_replace ( 'window.webtrendsAsyncInit' , '<script>window.webtrendsAsyncInit' , $tracking_code );
			$tracking_code = str_replace ( '<img alt="dcsimg"' , '</script><img alt="dcsimg"' , $tracking_code );
			
			//Fix ampersands (& to &amp;)
			$tracking_code = str_replace ( '&' , '&amp;' , $tracking_code );

		//Return tracking code
		echo $tracking_code;

		//Load global tags
		$tags = $EasyWebtrends->get_option( 'tags' );

		//Load custom tags
		for ($i = 1; $i <= $EasyWebtrends->get_option( 'custom_rules' ); $i++ ) {

			//Get target URL string
	        $url_string = $EasyWebtrends->get_option( 'custom_rule_' .$i .'_string' );

	        //Get custom tag
	        $custom_tag = $EasyWebtrends->get_option( 'custom_rule_' .$i .'_tag' );

	        //If current URL contains string, add tag
	        if( strstr($current_url, $url_string) ) {
	        	$tags .= ',' .$custom_tag; 
	        }
	    }

		//Strip spaces from tags
		$tags = str_replace(' ', '', $tags);

		//Replace commas with semi-colon
		$tags = str_replace(',', ';', $tags);

		//Return tag script
		$webtrends_id_tag = "\n<!--Load Webtrends ID tag-->\n\t<meta name=\"WT.sp\" content=\"" .$tags. "\"/>\n<!--End Webtrends ID tag-->\n\n";
		echo $webtrends_id_tag;
	}
}

//load tracking code
$url = site_url();
if (!strpos($url,"solas-lite.britishcouncil.net")) {
	if($this->get_option( 'script_location' ) == 'header') {
		add_action('wp_head', 'webtrends_tracking_code');
	} else {
		add_action('wp_footer', 'webtrends_tracking_code');
	} 	
}

//load presstrends
function load_presstrends() {
	global $EasyWebtrends;
	if($EasyWebtrends->get_option( 'presstrends' ) == 'enabled') {
		// PressTrends Account API Key
		$api_key = 'rwiyhqfp7eioeh62h6t3ulvcghn2q8cr7j5x';
		$auth    = 'synw5676nwkjsoyhb5rp3l9h11lm7tg00';

		// Start of Metrics
		global $wpdb;
		$data = get_transient( 'presstrends_cache_data' );
		if ( !$data || $data == '' ) {
			$api_base = 'http://api.presstrends.io/index.php/api/pluginsites/update/auth/';
			$url      = $api_base . $auth . '/api/' . $api_key . '/';

			$count_posts    = wp_count_posts();
			$count_pages    = wp_count_posts( 'page' );
			$comments_count = wp_count_comments();

			// wp_get_theme was introduced in 3.4, for compatibility with older versions, let's do a workaround for now.
			if ( function_exists( 'wp_get_theme' ) ) {
				$theme_data = wp_get_theme();
				$theme_name = urlencode( $theme_data->Name );
			} else {
				$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );
				$theme_name = $theme_data['Name'];
			}

			$plugin_name = '&';
			foreach ( get_plugins() as $plugin_info ) {
				$plugin_name .= $plugin_info['Name'] . '&';
			}
			// CHANGE __FILE__ PATH IF LOCATED OUTSIDE MAIN PLUGIN FILE
			$plugin_data         = get_plugin_data( __FILE__ );
			$posts_with_comments = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='post' AND comment_count > 0" );
			$data                = array(
				'url'             => stripslashes( str_replace( array( 'http://', '/', ':' ), '', site_url() ) ),
				'posts'           => $count_posts->publish,
				'pages'           => $count_pages->publish,
				'comments'        => $comments_count->total_comments,
				'approved'        => $comments_count->approved,
				'spam'            => $comments_count->spam,
				'pingbacks'       => $wpdb->get_var( "SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_type = 'pingback'" ),
				'post_conversion' => ( $count_posts->publish > 0 && $posts_with_comments > 0 ) ? number_format( ( $posts_with_comments / $count_posts->publish ) * 100, 0, '.', '' ) : 0,
				'theme_version'   => $plugin_data['Version'],
				'theme_name'      => $theme_name,
				'site_name'       => str_replace( ' ', '', get_bloginfo( 'name' ) ),
				'plugins'         => count( get_option( 'active_plugins' ) ),
				'plugin'          => urlencode( $plugin_name ),
				'wpversion'       => get_bloginfo( 'version' ),
			);

			foreach ( $data as $k => $v ) {
				$url .= $k . '/' . $v . '/';
			}
			wp_remote_get( $url );
			set_transient( 'presstrends_cache_data', $data, 60 * 60 * 24 );
		}
	}
}
add_action('admin_init', 'load_presstrends');

//Load tracking tags to all pages

//Load custom tags as custom meta based on rules
	//if URL contains <string>
	//load tag <tag>

/*
//load webtrends_tags
function webtrends_tags() {
	echo 'WEBTRENDS TAGS';
	//echo "<!--Load Webtrends ID tag-->\n";
	//echo "\t<meta name=\"WT.sp\" content=\"" .get_bloginfo('name') ."\"/>\n";
}
//add_action('wp_head','webtrends_tags');
*/