<?php
/**
 * Plugin Name: Visual Composer - Social Streams With Carousel
 * Description: Visual Composer - Social Streams With Carousel
 * Version: 1.7
 * Author: Hitesh Khunt
 * Author URI: http://www.saragna.com/Hitesh-Khunt
 * Plugin URI: http://plugin.saragna.com/vc-addon
 * License: GPLv2 or later
 Text Domain: svc_social_feed
 *
 */

$svgrVersion = "1.7";

$currentFile = __FILE__;

$currentFolder = dirname($currentFile);

add_action('admin_init','svc_social_Init_Addon');
require_once( 'inc/add-param.php' );
require_once( 'inc/all_function.php' );
require_once( 'addons/social-stream/admin.php' );

if(is_admin()){
	wp_enqueue_style( 'vc-social-admin-css', plugins_url( ltrim( 'assets/css/admin.css', '/' ), __FILE__ ), array(), '' );
}


function svc_social_Init_Addon() {
	$required_vc 	= '3.9.9';
	if (defined('WPB_VC_VERSION')){
		if (version_compare($required_vc, WPB_VC_VERSION, '>')) {
			add_action('admin_notices', 'svc_social_Admin_Notice_Version');
		}
	}else{
		add_action('admin_notices', 'svc_social_Admin_Notice_Activation');
	}
}
function svc_social_Admin_Notice_Version() {
		echo '<div class="updated"><p>The <strong>Visual Composer - Social Stream</strong> add-on requires <strong>Visual Composer</strong> version 4.0.0 or greater.</p></div>';	
	}
function svc_social_Admin_Notice_Activation() {
	echo '<div class="updated"><p>The <strong>Visual Composer - Social Stream</strong> add-on requires the <strong>Visual Composer</strong> Plugin installed and activated.</p></div>';
}
?>
