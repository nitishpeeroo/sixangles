<?php
require_once 'const.php';
require_once 'helpers.php';
include_once 'lib/qode-quick-links-functions.php';
if(!function_exists('qode_quick_links_load_meta_boxes')) {
	function qode_quick_links_load_meta_boxes() {
		include_once 'admin/meta-boxes/quick-links/map.php';
	}
	add_action('qode_before_meta_boxes_map', 'qode_quick_links_load_meta_boxes');
}if(!function_exists('qode_quick_links_load_admin')) {
	function qode_quick_links_load_admin() {
		require_once 'admin/options/quick-links/map.php';
	}
	add_action('qode_before_options_map', 'qode_quick_links_load_admin');
}
//load custom styles
if(!function_exists('qode_quick_links_load_custom_styles')) {
	function qode_quick_links_load_custom_styles() {
		require_once 'assets/custom-styles/quick-links.php';
	}
	add_action('after_setup_theme','qode_quick_links_load_custom_styles');
}