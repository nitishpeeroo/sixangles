<?php

if(!function_exists('qode_advanced_pricing_table_map')) {
    function qode_advanced_pricing_table_map() {

		$panel = qode_add_admin_panel(array(
            'title' => esc_html__('Advanced Pricing Table', 'qode'),
            'name'  => 'panel_advanced_pricing_table',
            'page'  => 'elementsPage'
        ));


        $color_group = qode_add_admin_group(array(
            'name'			=> 'color_group',
            'title'			=> esc_html__('Color Options', 'qode'),
            'description'	=> esc_html__('Setup colors for advanced pricing table', 'qode'),
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
			'name'          => 'advanced_pricing_table_border_color',
			'default_value' => '',
			'label'         => esc_html__('Border Color', 'qode'),
			'description'   => ''
		));

        qode_add_admin_field(array(
            'parent'        => $color_row,
            'type'          => 'colorsimple',
            'name'          => 'advanced_pricing_table_odd_bckg_color',
            'default_value' => '',
            'label'         => esc_html__('Odd Rows Background Color', 'qode')
        ));

		qode_add_admin_field(array(
			'parent'        => $color_row,
			'type'          => 'colorsimple',
			'name'          => 'advanced_pricing_table_even_bckg_color',
			'default_value' => '',
			'label'         => esc_html__('Even Rows Background Color', 'qode')
		));

	}

    add_action('qode_options_elements_page_map', 'qode_advanced_pricing_table_map');
}