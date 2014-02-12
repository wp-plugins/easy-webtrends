<?php
/**
 * Template functions Easy Webtrends
 * 
 * @package EasyWebtrends
 * 
 * @author jcpeden
 * @version 1.0.8
 * @since 1.0.0
 */

function load_webtrends_javascript() {
	wp_enqueue_script('webtrends_js' , EASYWEBTRENDS_URLPATH .'/js/webtrends.min.js' , array( 'jquery' ), '1.0', false);
}
add_action('wp_enqueue_scripts', 'load_webtrends_javascript');

function webtrends_tracking_code() {
	global $EasyWebtrends;

	//Get current URL
	$current_url = $_SERVER['REQUEST_URI'];

	//Return false if the URL contains a disabled string
	$disable = stripslashes( $EasyWebtrends->get_option( 'disable' ) );
	if ( ! empty( $disable ) ) {
		$disable = str_replace(' ', '', $disable);
		$disable_strings = explode(",", $disable);

		foreach ($disable_strings as $disable_string) {
			if( strstr($current_url, $disable_string) ) {
				return false;
			}
		}
	}

	/* Load tracking code */ ?>
	<!-- START OF SmartSource Data Collector TAG v10.2.29 -->
	<!-- Copyright (c) 2012 Webtrends Inc.  All rights reserved. -->
	<script>
	window.webtrendsAsyncInit=function(){
	    var dcs=new Webtrends.dcs().init({
	        dcsid:"dcsozkqgb00000sh0y1unaabw_9e3r",
	        domain:"statse.webtrendslive.com",
	        timezone:<?php echo get_option('gmt_offset'); ?>,
	        i18n:true,
	        adimpressions:true,
	        adsparam:"WT.ac",
	        download:true,
	        downloadtypes:"xls,doc,pdf,txt,csv,zip,docx,xlsx,rar,gzip,swf,mid,mp3",
	        splitvalue:"<?php bloginfo('name'); ?>",
	        plugins:{
	            hm:{src:"//s.webtrends.com/js/webtrends.hm.js"}
	        }
	        }).track();
	};
	(function(){

	    var s=document.createElement("script"); s.async=true; s.src="<?php echo plugins_url( '/js/webtrends.min.js' , dirname(__FILE__) ); ?>";   
	    var s2=document.getElementsByTagName("script")[0]; s2.parentNode.insertBefore(s,s2);
	}());
	</script>
	<noscript><img alt="dcsimg" id="dcsimg" width="1" height="1" src="//statse.webtrendslive.com/dcsozkqgb00000sh0y1unaabw_9e3r/njs.gif?dcsuri=/nojavascript&amp;WT.js=No&amp;WT.tv=10.2.55&amp;dcssip=<?php echo site_url(); ?>&amp;WP.sp=<?php esc_attr( bloginfo('name') ); ?>"/></noscript>
	<!-- END OF SmartSource Data Collector TAG v10.2.29 -->

	<?php //Load global tags
	$tags = stripslashes( sanitize_text_field( $EasyWebtrends->get_option( 'tags' ) ) );

	//Load custom tags
	for ($i = 1; $i <= intval( $EasyWebtrends->get_option( 'custom_rules' ) ); $i++ ) {

		//Get target URL string
		$url_string = stripslashes( sanitize_text_field( $EasyWebtrends->get_option( 'custom_rule_' .$i .'_string' ) ) );

		//Get custom tag
		$custom_tag = stripslashes( sanitize_text_field( $EasyWebtrends->get_option( 'custom_rule_' .$i .'_tag' ) ) );

		//If current URL contains string, add tag
		if ($url_string != '') {
			if( strstr($current_url, $url_string) ) {
				$tags .= ',' .$custom_tag;
			}
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

//load tracking code
// josh@10up.com: removed check for solas-lite.britishcouncil.net; add a filter to accomplish this
$url = site_url();
if($this->get_option( 'script_location' ) == 'header') {
	add_action('wp_head', 'webtrends_tracking_code');
} else {
	add_action('wp_footer', 'webtrends_tracking_code');
}