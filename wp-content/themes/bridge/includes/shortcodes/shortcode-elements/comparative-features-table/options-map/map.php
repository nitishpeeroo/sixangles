<?php

if(!function_exists('qode_comparative_features_table_map')) {
    function qode_comparative_features_table_map() {

		$panel = qode_add_admin_panel(array(
            'title' => esc_html__('Comparative Features Table', 'qode'),
            'name'  => 'panel_comparative_features_table',
            'page'  => 'elementsPage'
        ));


        $color_group = qode_add_admin_group(array(
            'name'			=> 'color_group',
            'title'			=> esc_html__('Color Options', 'qode'),
            'description'	=> esc_html__('Setup colors for comparative features table', 'qode'),
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
			'name'          => 'comparative_features_table_border_color',
			'default_value' => '',
			'label'         => esc_html__('Border Color', 'qode'),
			'description'   => ''
		));

        qode_add_admin_field(array(
            'parent'        => $color_row,
            'type'          => 'colorsimple',
            'name'          => 'comparative_features_table_odd_bckg_color',
            'default_value' => '',
            'label'         => esc_html__('Odd Rows Background Color', 'qode')
        ));

		qode_add_admin_field(array(
			'parent'        => $color_row,
			'type'          => 'colorsimple',
			'name'          => 'comparative_features_table_even_bckg_color',
			'default_value' => '',
			'label'         => esc_html__('Even Rows Background Color', 'qode')
		));

		$cft_button_group = qode_add_admin_group(array(
			'name'			=> 'cft_button_group',
			'title'			=> esc_html__('Button Options', 'qode'),
			'description'	=> esc_html__('Setup button options for comparative features table', 'qode'),
			'parent'		=> $panel
		));

		$cft_button_row = qode_add_admin_row(array(
			'name' => 'cft_button_row',
			'next' => true,
			'parent' => $cft_button_group
		));

		qode_add_admin_field(array(
			'parent'        => $cft_button_row,
			'type'          => 'fontsimple',
			'name'          => 'comparative_features_table_btn_font_family',
			'default_value' => '',
			'label'         => esc_html__('Font Family', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $cft_button_row,
			'type'          => 'textsimple',
			'name'          => 'comparative_features_table_btn_font_size',
			'default_value' => '',
			'label'         => esc_html__('Font Size', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $cft_button_row,
			'type'          => 'selectblanksimple',
			'name'          => 'comparative_features_table_btn_font_weight',
			'default_value' => '',
			'options'		=> qode_get_font_weight_array(),
			'label'         => esc_html__('Font Weight', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $cft_button_row,
			'type'          => 'selectblanksimple',
			'name'          => 'comparative_features_table_btn_font_style',
			'options'		=> qode_get_font_style_array(),
			'default_value' => '',
			'label'         => esc_html__('Font Style', 'qode')
		));
		$cft_button_row2 = qode_add_admin_row(array(
			'name' => 'cft_button_row2',
			'next' => true,
			'parent' => $cft_button_group
		));


		qode_add_admin_field(array(
			'parent'        => $cft_button_row2,
			'type'          => 'selectblanksimple',
			'name'          => 'comparative_features_table_btn_text_transform',
			'options'		=> qode_get_text_transform_array(),
			'default_value' => '',
			'label'         => esc_html__('Text Transform', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $cft_button_row2,
			'type'          => 'textsimple',
			'name'          => 'comparative_features_table_btn_letter_spacing',
			'default_value' => '',
			'label'         => esc_html__('Letter Spacing', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $cft_button_row2,
			'type'          => 'colorsimple',
			'name'          => 'comparative_features_table_btn_color',
			'default_value' => '',
			'label'         => esc_html__('Color', 'qode')
		));
		qode_add_admin_field(array(
			'parent'        => $cft_button_row2,
			'type'          => 'colorsimple',
			'name'          => 'comparative_features_table_btn_hover_color',
			'default_value' => '',
			'label'         => esc_html__('Hover Color', 'qode')
		));
	}

    add_action('qode_options_elements_page_map', 'qode_comparative_features_table_map');
}