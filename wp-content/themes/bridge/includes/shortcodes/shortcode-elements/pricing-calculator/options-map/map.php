<?php

if(!function_exists('qode_pricing_calculator_map')) {
    function qode_pricing_calculator_map() {

		$panel = qode_add_admin_panel(array(
            'title' => 'Pricing Calculator',
            'name'  => 'panel_pricing_calculator',
            'page'  => 'elementsPage'
        ));


        $color_group = qode_add_admin_group(array(
            'name' => 'color_group',
            'title' => 'Color Options',
            'description' => 'Setup colors for pricing calculator',
            'parent' => $panel
        ));

        $color_row = qode_add_admin_row(array(
            'name' => 'color_row',
            'next' => true,
            'parent' => $color_group
        ));

		qode_add_admin_field(array(
			'parent'        => $color_row,
			'type'          => 'colorsimple',
			'name'          => 'pricing_calculator_border_color',
			'default_value' => '',
			'label'         => 'Border Color',
			'description'   => ''
		));

        qode_add_admin_field(array(
            'parent'        => $color_row,
            'type'          => 'colorsimple',
            'name'          => 'pricing_calculator_left_section_bckg_color',
            'default_value' => '',
            'label'         => 'Left Section Background Color'
        ));

		qode_add_admin_field(array(
			'parent'        => $color_row,
			'type'          => 'colorsimple',
			'name'          => 'pricing_calculator_right_section_bckg_color',
			'default_value' => '',
			'label'         => 'Right Section Background Color'
		));

        $color_row2 = qode_add_admin_row(array(
            'name' => 'color_row2',
            'next' => true,
            'parent' => $color_group
        ));

		qode_add_admin_field(array(
			'parent'        => $color_row2,
			'type'          => 'colorsimple',
			'name'          => 'pricing_calculator_switch_color',
			'default_value' => '',
			'label'         => 'Switch Color',
			'description'   => ''
		));

		qode_add_admin_field(array(
			'parent'        => $color_row2,
			'type'          => 'colorsimple',
			'name'          => 'pricing_calculator_switch_active_color',
			'default_value' => '',
			'label'         => 'Switch Active Color',
			'description'   => ''
		));

		$pc_price_group = qode_add_admin_group(array(
			'name'			=> 'pc_price_group',
			'title'			=> esc_html__('Price Options', 'qode'),
			'description'	=> esc_html__('Setup price options for pricing calculator', 'qode'),
			'parent'		=> $panel
		));

		$pc_price_row = qode_add_admin_row(array(
			'name' => 'pc_price_row',
			'next' => true,
			'parent' => $pc_price_group
		));

		qode_add_admin_field(array(
			'parent'        => $pc_price_row,
			'type'          => 'fontsimple',
			'name'          => 'pricing_calculator_price_font_family',
			'default_value' => '',
			'label'         => esc_html__('Font Family', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $pc_price_row,
			'type'          => 'textsimple',
			'name'          => 'pricing_calculator_price_font_size',
			'default_value' => '',
			'label'         => esc_html__('Font Size', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $pc_price_row,
			'type'          => 'selectblanksimple',
			'name'          => 'pricing_calculator_price_font_weight',
			'default_value' => '',
			'options'		=> qode_get_font_weight_array(),
			'label'         => esc_html__('Font Weight', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $pc_price_row,
			'type'          => 'selectblanksimple',
			'name'          => 'pricing_calculator_price_font_style',
			'options'		=> qode_get_font_style_array(),
			'default_value' => '',
			'label'         => esc_html__('Font Style', 'qode')
		));
		$pc_price_row2 = qode_add_admin_row(array(
			'name' => 'pc_price_row2',
			'next' => true,
			'parent' => $pc_price_group
		));

		qode_add_admin_field(array(
			'parent'        => $pc_price_row2,
			'type'          => 'textsimple',
			'name'          => 'pricing_calculator_price_letter_spacing',
			'default_value' => '',
			'label'         => esc_html__('Letter Spacing', 'qode')
		));

		qode_add_admin_field(array(
			'parent'        => $pc_price_row2,
			'type'          => 'colorsimple',
			'name'          => 'pricing_calculator_price_color',
			'default_value' => '',
			'label'         => esc_html__('Color', 'qode')
		));


    }

    add_action('qode_options_elements_page_map', 'qode_pricing_calculator_map');
}