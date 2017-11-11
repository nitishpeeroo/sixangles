<?php
/*
Plugin Name: Qode Quick Links
Description: Plugin that adds quick links functionality to our theme
Author: Qode Themes
Version: 1.0
*/

include_once 'load.php';

if(!function_exists('qode_quick_links_text_domain')) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function qode_quick_links_text_domain() {
		load_plugin_textdomain('qode-quick-links', false, QODE_QUICK_LINKS_REL_PATH.'/languages');
	}

	add_action('plugins_loaded', 'qode_quick_links_text_domain');
}
if(!function_exists('qode_quick_links_activation')) {
	/**
	 * Triggers when plugin is activated. It calls flush_rewrite_rules
	 * and defines qodef_themename_action_core_on_activate action
	 */
	function qode_quick_links_activation() {
		do_action('qode_quick_links_action_on_activate');

		qode_quick_links_register_post_type();
		flush_rewrite_rules();
	}

	add_action('after_setup_theme', 'qode_quick_links_activation');
}
if ( ! function_exists( 'qode_quick_links_scripts' ) ) {
	/**
	 * Loads plugin scripts
	 */
	function qode_quick_links_scripts() {

		wp_enqueue_style( 'qode_quick_links_style', plugins_url( QODE_QUICK_LINKS_REL_PATH . '/assets/css/qode-quick-links.min.css' ) );

		$array_deps = array();
		if ( qode_quick_links_theme_installed() ) {
			$array_deps[] = 'default';
			$array_deps[] = 'plugins';
			$array_deps[] = 'mousewheel';
		}
		wp_enqueue_script( 'mCustomScrollbar', plugins_url( QODE_QUICK_LINKS_REL_PATH . '/assets/js/plugins/jquery.mCustomScrollbar.min.js' ), $array_deps, false, true );
		wp_enqueue_script( 'qode_quick_links_script', plugins_url( QODE_QUICK_LINKS_REL_PATH . '/assets/js/qode-quick-links.min.js' ), $array_deps, false, true );
	}

	add_action( 'wp_enqueue_scripts', 'qode_quick_links_scripts', 100 );
}

if(!function_exists('qode_quick_links_theme_installed')) {
	/**
	 * Checks whether theme is installed or not
	 * @return bool
	 */
	function qode_quick_links_theme_installed() {

		return defined('QODE_ROOT');
	}
}