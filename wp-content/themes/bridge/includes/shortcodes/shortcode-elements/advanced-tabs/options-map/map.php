<?php

if(!function_exists('qode_advanced_tabs_map')) {
    function qode_advanced_tabs_map() {

		$panel = qode_add_admin_panel(array(
            'title' => esc_html__('Advanced Tabs', 'qode'),
            'name'  => 'panel_advanced_tabs',
            'page'  => 'elementsPage'
        ));


        $color_group = qode_add_admin_group(array(
            'name'			=> 'color_group',
            'title'			=> esc_html__('Title Color Options', 'qode'),
            'description'	=> esc_html__('Setup colors for advanced tabs title', 'qode'),
            'parent'		=> $panel
        ));

        $color_row = qode_add_admin_row(array(
            'name' => 'color_row',
            'next' => true,
            'parent' => $color_group
        ));

		qode_add_admin_field(array(
			'parent'        => $color_row,
			'type'          => 'colorsimple',
			'name'          => 'advanced_tabs_color',
			'default_value' => '',
			'label'         => esc_html__('Color', 'qode'),
			'description'   => ''
		));

        qode_add_admin_field(array(
            'parent'        => $color_row,
            'type'          => 'colorsimple',
            'name'          => 'advanced_tabs_bckg_color',
            'default_value' => '',
            'label'         => esc_html__('Background Color', 'qode')
        ));

        qode_add_admin_field(array(
            'parent'        => $color_row,
            'type'          => 'colorsimple',
            'name'          => 'advanced_tabs_hover_color',
            'default_value' => '',
            'label'         => esc_html__('Active Color', 'qode')
        ));

        qode_add_admin_field(array(
            'parent'        => $color_row,
            'type'          => 'colorsimple',
            'name'          => 'advanced_tabs_hover_bckg_color',
            'default_value' => '',
            'label'         => esc_html__('Background Active Color', 'qode')
        ));

	}

    add_action('qode_options_elements_page_map', 'qode_advanced_tabs_map');
}