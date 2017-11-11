<?php


add_action('init', 'qode_meta_boxes_map_init');
function qode_meta_boxes_map_init() {
	global $qode_options_proya;
	global $qodeFramework;
	global $options_fontstyle;
	global $options_fontweight;
	global $options_texttransform;
	global $options_fontdecoration;
    global $qodeIconCollections;

	do_action('qode_before_meta_boxes_map');

	require_once("slides/map.php");
	require_once("testimonials/map.php");
	require_once("carousels/map.php");
	require_once("masonry_gallery/map.php");
	require_once("woocommerce/map.php");
	require_once("general/map.php");
	require_once("portfolio/map.php");
	require_once("post/map.php");
	require_once("header/map.php");
	require_once("left-menu/map.php");
	require_once("title/map.php");
	require_once("content-bottom/map.php");
	require_once("blog/map.php");
	require_once("sidebar/map.php");
	require_once("seo/map.php");


	do_action('qode_meta_boxes_map');
}
