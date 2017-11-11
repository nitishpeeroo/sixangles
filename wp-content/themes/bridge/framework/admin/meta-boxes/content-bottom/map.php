<?php
if(!function_exists('qode_map_content_bottom_meta_fields')) {

	function qode_map_content_bottom_meta_fields() {

		$qode_custom_sidebars = array();
		foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
			if(isUserMadeSidebar(ucwords($sidebar['name']))){
				$qode_custom_sidebars[$sidebar['id']] = ucwords( $sidebar['name']);
			}
		}


		$qodeContentBottom = qode_add_meta_box(
			array(
				'scope' => array('page', 'portfolio_page', 'post'),
				'title' => esc_html__('Qode Content Bottom', 'qode'),
				'name' => 'page_content_bottom'
			)
		);

		$qode_enable_content_bottom_area = new QodeMetaField("selectblank","qode_enable_content_bottom_area","","Show Content Bottom Area","Do you want to show content bottom area?", array(
			"no" => "No",
			"yes" => "Yes"
		),
			array("dependence" => true,
				"hide" => array(
					"no"=>"#qodef_qode_enable_content_bottom_area_container",
					""=>"#qodef_qode_enable_content_bottom_area_container"),
				"show" => array(
					"yes"=>"#qodef_qode_enable_content_bottom_area_container") ));
		$qodeContentBottom->addChild("qode_enable_content_bottom_area",$qode_enable_content_bottom_area);

		$qode_enable_content_bottom_area_container = new QodeContainer("qode_enable_content_bottom_area_container","qode_enable_content_bottom_area","no",array("", "no"));
		$qodeContentBottom->addChild("qode_enable_content_bottom_area_container",$qode_enable_content_bottom_area_container);

		$qode_content_bottom_background_color = new QodeMetaField("color","qode_content_bottom_background_color","","Background Color","Choose a color for content bottom area");
		$qode_enable_content_bottom_area_container->addChild("qode_content_bottom_background_color",$qode_content_bottom_background_color);

		$qode_choose_content_bottom_sidebar = new QodeMetaField("selectblank","qode_choose_content_bottom_sidebar","","Custom Widget","Choose Custom Widget area to display",$qode_custom_sidebars);
		$qode_enable_content_bottom_area_container->addChild("qode_choose_content_bottom_sidebar",$qode_choose_content_bottom_sidebar);

		$qode_content_bottom_sidebar_in_grid = new QodeMetaField("selectblank","qode_content_bottom_sidebar_in_grid","","Display in Grid","Enabling this option will place Content Bottom in grid",array(
			"no" => "No",
			"yes" => "Yes"
		));
		$qode_enable_content_bottom_area_container->addChild("qode_content_bottom_sidebar_in_grid",$qode_content_bottom_sidebar_in_grid);

	}

	add_action('qode_meta_boxes_map', 'qode_map_content_bottom_meta_fields');
}