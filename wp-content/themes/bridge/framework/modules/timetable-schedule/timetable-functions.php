<?php

if(!function_exists('qode_add_tt_event_single_to_meta_boxes')) {

	function qode_add_tt_event_single_to_meta_boxes($metaboxes)
	{
		$metaboxes[] = 'events';
		return $metaboxes;
	}

	add_filter('qode_meta_box_post_types_save', 'qode_add_tt_event_single_to_meta_boxes');
}
if(!function_exists('qode_add_tt_event_to_metaboxes')) {

	function qode_add_tt_event_to_metaboxes($post_types)
	{
		$post_types[] = 'events';
		return $post_types;
	}

	add_filter('qode_sidebar_scope_post_types', 'qode_add_tt_event_to_metaboxes');
	add_filter('qode_header_scope_post_types', 'qode_add_tt_event_to_metaboxes');
	add_filter('qode_title_scope_post_types', 'qode_add_tt_event_to_metaboxes');
}


if(!function_exists('qode_tt_event_single_content')) {
	/**
	 * Loads timetable single event page
	 */
	function qode_tt_event_single_content() {
		$id = get_the_ID();

		$subtitle = get_post_meta($id, 'timetable_subtitle', true);

		$params = array(
			'subtitle' => $subtitle
		);

		qode_get_module_template_part('templates/events-single', 'timetable-schedule', '', $params);
	}
}

if(!function_exists('qode_register_timetable_event_sidebar')) {
	/**
	 * Function that registers sidebar
	 */
	function qode_register_timetable_event_sidebar()
	{
		register_sidebar(array(
			'name' => 'Sidebar Event',
			'id' => 'sidebar-event',
			'before_widget' => '<div id="%1$s" class="widget %2$s posts_holder">',
			'after_widget' => '</div>',
			'before_title' => '<h5>',
			'after_title' => '</h5>'
		));
	}

	add_action('widgets_init', 'qode_register_timetable_event_sidebar');
}