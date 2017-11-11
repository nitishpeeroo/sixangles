<?php
if(!function_exists('qode_map_general_meta_fields')) {

	function qode_map_general_meta_fields() {
		$qodeGeneral = qode_add_meta_box(
			array(
				'scope' => array('page', 'portfolio_page', 'post'),
				'title' => esc_html__('Qode General', 'qode'),
				'name' => 'page_general'
			)
		);

		$qode_page_background_color = new QodeMetaField("color","qode_page_background_color","","Page Background Color","Choose the page background (body) color");
		$qodeGeneral->addChild("qode_page_background_color",$qode_page_background_color);

		$qode_show_animation = new QodeMetaField("selectblank", "qode_show-animation", "", "Page Transition", 'Choose a type of transition between loading pages.', array(
			"no_animation" => "No Animation",
			"updown" => "Up / Down",
			"fade" => "Fade",
			"updown_fade" => "Up/Down (In) / Fade (Out)",
			"leftright" => "Left / Right"
		), array(), "enable_grid_elements", array("yes"));
		$qodeGeneral->addChild("qode_show-animation", $qode_show_animation);

		$page_transitions_notice = new QodeNotice("Page Transition",'Choose a a type of transition between loading pages. In order for animation to work properly, you must choose "Post name" in permalinks settings', "AJAX Page transitions are disabled due to VC Grid Elements", "enable_grid_elements","no");
		$qodeGeneral->addChild("page_transitions_notice",$page_transitions_notice);

		$qode_revolution_slider = new QodeMetaField("text","qode_revolution-slider","","Layer Slider or Qode Slider Shortcode","Copy and paste your shortcode located in Qode Slider -> Slider");
		$qodeGeneral->addChild("qode_revolution-slider",$qode_revolution_slider);

		$qode_enable_content_top_margin = new QodeMetaField("selectblank","qode_enable_content_top_margin","","Always put content below header","Enabling this option always will put content below header", array(
			"no" => "No",
			"yes" => "Yes",
		));
		$qodeGeneral->addChild("qode_enable_content_top_margin",$qode_enable_content_top_margin);


	}

	add_action('qode_meta_boxes_map', 'qode_map_general_meta_fields');
}