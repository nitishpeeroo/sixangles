<?php
if(!function_exists('qode_map_sidebar_meta_fields')) {

	function qode_map_sidebar_meta_fields() {

		$qode_custom_sidebars = array();
		foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
			if(isUserMadeSidebar(ucwords($sidebar['name']))){
				$qode_custom_sidebars[$sidebar['id']] = ucwords( $sidebar['name']);
			}
		}
		$qodeSideBarScopeArray = apply_filters('qode_sidebar_scope_post_types', array('page', 'post', 'portfolio_page'));

		$qodeSideBar = qode_add_meta_box(
			array(
				'scope' => $qodeSideBarScopeArray,
				'title' => esc_html__('Qode Sidebar', 'qode'),
				'name' => 'page_side_bar'
			)
		);

			$qode_show_sidebar = new QodeMetaField("select","qode_show-sidebar","default","Layout","Choose the sidebar layout",array( "default" => "Default",
			"1" => "Sidebar 1/3 right",
			"2" => "Sidebar 1/4 right",
			"3" => "Sidebar 1/3 left",
			"4" => "Sidebar 1/4 left",
		));
		$qodeSideBar->addChild("qode_show-sidebar",$qode_show_sidebar);

		$qode_choose_sidebar = new QodeMetaField("selectblank","qode_choose-sidebar","default","Choose Widget Area in Sidebar","Choose Custom Widget area to display in Sidebar", $qode_custom_sidebars);
		$qodeSideBar->addChild("qode_choose-sidebar",$qode_choose_sidebar);

	}

	add_action('qode_meta_boxes_map', 'qode_map_sidebar_meta_fields');
}