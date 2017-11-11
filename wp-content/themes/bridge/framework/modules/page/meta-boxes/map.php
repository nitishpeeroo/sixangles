<?php

if(!function_exists('qode_map_page_meta_fields')) {

	function qode_map_page_meta_fields() {

		// Layout
		$page_layout_meta_box = qode_add_meta_box(
			array(
				'scope' => array('page'),
				'title' => esc_html__('Qode Page Options', 'qode'),
				'name' => 'page_options'
			)
		);

		qode_add_meta_box_field(array(
			'parent'        => $page_layout_meta_box,
			'type'          => 'select',
			'name'          => 'inter_page_navigation_meta',
			'default_value' => '',
			'label'         => esc_html__('Inter-Page Navigation','qode'),
			'description'   => esc_html__('Enabling this option will add a navigation section to the bottom of your page with “Previous” and “Next” buttons, which users can use to navigate through your pages. Please note that the navigation will only lead through pages in the same hierarchical level (e.g. if you have a parent page called “Home” and then 3 child pages on which you have enabled the navigation, it will only lead through the child pages).','qode'),
			'options'       => array(
				""		=> esc_html__("Default",'qode'),
				"yes"	=> esc_html__("Yes",'qode'),
				"no"	=> esc_html__("No",'qode')
			),
			'args'          => array(
				"dependence" => true,
				"hide"       => array(
					""    => "#qodef_qode_inter_page_container",
					"no"  => "#qodef_qode_inter_page_container",
					"yes" => ""
				),
				"show"       => array(
					""    => "",
					"no"  => "",
					"yes" => "#qodef_qode_inter_page_container"
				)
			)
		));

		$inter_page_container = qode_add_admin_container(
			array(
				'name' => 'qode_inter_page_container',
				'hidden_property' => 'inter_page_navigation_meta',
				'hidden_values' => array('', 'no'),
				'parent' => $page_layout_meta_box,
			)
		);

		$qode_pages = array(
			''			=> esc_html__('Default', 'qode'),
			'no-link'	=> esc_html__('No Link', 'qode')
		);
		$pages = get_pages();
		foreach($pages as $page) {
			$qode_pages[$page->ID] = $page->post_title;
		}

		qode_add_meta_box_field(array(
			'parent'        => $inter_page_container,
			'type'          => 'select',
			'name'          => 'inter_page_back_link_meta',
			'default_value' => '',
			'label'         => esc_html__('"Back To" Link','qode'),
			'description'	=> esc_html__('Choose a page for the “back to” link to lead to when clicked on.', 'qode'),
			'options'       => $qode_pages

		));

	}

	add_action('qode_meta_boxes_map', 'qode_map_page_meta_fields');
}