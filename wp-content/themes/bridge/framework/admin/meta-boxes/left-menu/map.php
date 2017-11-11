<?php
if(!function_exists('qode_map_left_menu_meta_fields')) {

	function qode_map_left_menu_meta_fields() {
		$qodeLeftMenuArea = qode_add_meta_box(
			array(
				'scope' => array('page', 'portfolio_page', 'post'),
				'title' => esc_html__('Qode Left Menu Area', 'qode'),
				'name' => 'page_left_menu',
				'hidden_property' => 'vertical_area',
				'hidden_values' => array('no')
			)
		);


		$qode_page_vertical_area_transparency = new QodeMetaField("selectblank","qode_page_vertical_area_transparency","","Enable transparent left menu area","Enabling this option will make Left Menu background transparent ", array(
			"no" => "No",
			"yes" => "Yes"
		));
		$qodeLeftMenuArea->addChild("qode_page_vertical_area_transparency",$qode_page_vertical_area_transparency);

		$qode_page_vertical_area_background = new QodeMetaField("color","qode_page_vertical_area_background","","Left Menu Area Background Color","Choose a color for Left Menu background");
		$qodeLeftMenuArea->addChild("qode_page_vertical_area_background",$qode_page_vertical_area_background);

		$qode_page_vertical_area_background_image = new QodeMetaField("image","qode_page_vertical_area_background_image","","Left Menu Area Background Image","Choose an image for Left Menu background");
		$qodeLeftMenuArea->addChild("qode_page_vertical_area_background_image",$qode_page_vertical_area_background_image);


	}

	add_action('qode_meta_boxes_map', 'qode_map_left_menu_meta_fields');
}