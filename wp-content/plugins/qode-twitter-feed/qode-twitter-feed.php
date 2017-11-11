<?php
/*
Plugin Name: Qode Twitter Feed
Description: Plugin that adds Twitter feed functionality to our theme
Author: Qode Themes
Version: 1.1
*/
define('QODE_TWITTER_FEED_VERSION', '1.0');
define('QODE_TWITTER_FEED_REL_PATH', dirname(plugin_basename(__FILE__ )));

include_once 'load.php';


if(!function_exists('qode_twitter_feed_text_domain')) {
	/**
	 * Loads plugin text domain so it can be used in translation
	 */
	function qode_twitter_feed_text_domain() {
		load_plugin_textdomain('qode-twitter-feed', false, QODE_TWITTER_FEED_REL_PATH.'/languages');
	}

	add_action('plugins_loaded', 'qode_twitter_feed_text_domain');
}


if(!function_exists('qode_twitter_get_inline_style')) {
	/**
	 * Function that generates style attribute and returns generated string
	 * @param $value string | array value of style attribute
	 * @return string generated style attribute
	 *
	 * @see qode_get_inline_style()
	 */
	function qode_twitter_get_inline_style($value) {
		return qode_twitter_get_inline_attr($value, 'style', ';');
	}
}

if(!function_exists('qode_twitter_get_inline_attr')) {
	/**
	 * Function that generates html attribute
	 * @param $value string | array value of html attribute
	 * @param $attr string name of html attribute to generate
	 * @param $glue string glue with which to implode $attr. Used only when $attr is array
	 * @return string generated html attribute
	 */
	function qode_twitter_get_inline_attr($value, $attr, $glue = '') {
		if(!empty($value)) {

			if(is_array($value) && count($value)) {
				$properties = implode($glue, $value);
			} elseif($value !== '') {
				$properties = $value;
			}

			return $attr.'="'.esc_attr($properties).'"';
		}

		return '';
	}
}