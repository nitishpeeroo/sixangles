<?php
if(!function_exists('qode_map_header_meta_fields')) {

	function qode_map_header_meta_fields() {

		$qodeHeaderScopeArray = apply_filters('qode_header_scope_post_types', array('page', 'post', 'portfolio_page'));
		$qodeHeader = qode_add_meta_box(
			array(
				'scope' => $qodeHeaderScopeArray,
				'title' => esc_html__('Qode Header', 'qode'),
				'name' => 'page_header',
				'hidden_property' => 'vertical_area',
				'hidden_values' => array('yes')
			)
		);

		$qode_header_style = new QodeMetaField("selectblank","qode_header-style","","Header Skin","Choose a header style to make header elements (logo, main menu, side menu button) in that predefined style", array(
			"light" => "Light",
			"dark" => "Dark"
		));
		$qodeHeader->addChild("qode_header-style",$qode_header_style);

		$qode_header_style_on_scroll = new QodeMetaField("selectblank","qode_header-style-on-scroll","","Enable Header Style on Scroll","Enabling this option, header will change style on scroll (depending on row settings) to make header elements (logo, main menu, side menu button) in that style", array(
			"no" => "No",
			"yes" => "Yes"
		));
		$qodeHeader->addChild("qode_header-style-on-scroll",$qode_header_style_on_scroll);

		$qode_header_color_per_page = new QodeMetaField("color","qode_header_color_per_page","","Initial Header Background Color","Choose a background color for header area");
		$qodeHeader->addChild("qode_header_color_per_page",$qode_header_color_per_page);

		$qode_header_color_transparency_per_page = new QodeMetaField("text","qode_header_color_transparency_per_page","","Initial Header Transparency","Choose a transparency for the header background color (0 = fully transparent, 1 = opaque)", array(), array("col_width" => 3));
		$qodeHeader->addChild("qode_header_color_transparency_per_page",$qode_header_color_transparency_per_page);

		$qode_page_scroll_amount_for_sticky = new QodeMetaField("text","qode_page_scroll_amount_for_sticky","","Scroll amount for sticky header appearance (px)","Define scroll amount for sticky header appearance", array(), array("col_width" => 3),"header_bottom_appearance",array( "regular","fixed","fixed_hiding") );
		$qodeHeader->addChild("qode_page_scroll_amount_for_sticky",$qode_page_scroll_amount_for_sticky);

		$qode_page_hide_initial_sticky = new QodeMetaField("selectblank","qode_page_hide_initial_sticky","","Hide Sticky Header Initially","Enabling this option will initially hide the header, and it will only be displayed when the user scrolls down the page", array(
			"no" => "No",
			"yes" => "Yes"
		));
		$qodeHeader->addChild("qode_page_hide_initial_sticky",$qode_page_hide_initial_sticky);


	}

	add_action('qode_meta_boxes_map', 'qode_map_header_meta_fields');
}