<?php

if(!function_exists('qode_advanced_numbered_process_map')) {
    function qode_advanced_numbered_process_map() {

		$panel = qode_add_admin_panel(array(
            'title' => esc_html__('Numbered Process', 'qode'),
            'name'  => 'panel_numbered_process',
            'page'  => 'elementsPage'
        ));


        $line_group = qode_add_admin_group(array(
            'name'			=> 'line_group',
            'title'			=> esc_html__('Line Options', 'qode'),
            'description'	=> esc_html__('Setup options for line in numbered process', 'qode'),
            'parent'		=> $panel
        ));

        $line_row = qode_add_admin_row(array(
            'name' => 'line_row',
            'next' => true,
            'parent' => $line_group
        ));

		qode_add_admin_field(array(
			'parent'        => $line_row,
			'type'          => 'colorsimple',
			'name'          => 'numbered_process_border_color',
			'default_value' => '',
			'label'         => esc_html__('Color', 'qode'),
			'description'   => ''
		));

        qode_add_admin_field(array(
            'parent'        => $line_row,
            'type'          => 'textsimple',
            'name'          => 'numbered_process_border_width',
            'default_value' => '',
            'label'         => esc_html__('Thickness (px)', 'qode')
        ));

        $number_group = qode_add_admin_group(array(
            'name'			=> 'number_group',
            'title'			=> esc_html__('Number Options', 'qode'),
            'description'	=> esc_html__('Setup options for number in numbered process', 'qode'),
            'parent'		=> $panel
        ));

        $number_row = qode_add_admin_row(array(
            'name' => 'number_row',
            'next' => true,
            'parent' => $number_group
        ));

		qode_add_admin_field(array(
			'parent'        => $number_row,
			'type'          => 'colorsimple',
			'name'          => 'numbered_process_number_color',
			'default_value' => '',
			'label'         => esc_html__('Color', 'qode'),
			'description'   => ''
		));

        qode_add_admin_field(array(
            'parent'        => $number_row,
            'type'          => 'textsimple',
            'name'          => 'numbered_process_number_font_size',
            'default_value' => '',
            'label'         => esc_html__('Font Size (px)', 'qode')
        ));

        qode_add_admin_field(array(
            'parent'        => $number_row,
            'type'          => 'colorsimple',
            'name'          => 'numbered_process_number_background_color',
            'default_value' => '',
            'label'         => esc_html__('Background Color', 'qode')
        ));

        $item_border_group = qode_add_admin_group(array(
            'name'			=> 'item_border_group',
            'title'			=> esc_html__('Process Item Border Options', 'qode'),
            'description'	=> esc_html__('Setup options for process item border', 'qode'),
            'parent'		=> $panel
        ));

        $item_border_row = qode_add_admin_row(array(
            'name' => 'item_border_row',
            'next' => true,
            'parent' => $item_border_group
        ));

		qode_add_admin_field(array(
			'parent'        => $item_border_row,
			'type'          => 'colorsimple',
			'name'          => 'numbered_process_item_border_color',
			'default_value' => '',
			'label'         => esc_html__('Color', 'qode'),
			'description'   => ''
		));

        qode_add_admin_field(array(
            'parent'        => $item_border_row,
            'type'          => 'textsimple',
            'name'          => 'numbered_process_item_border_width',
            'default_value' => '',
            'label'         => esc_html__('Width (px)', 'qode')
        ));

	}

    add_action('qode_options_elements_page_map', 'qode_advanced_numbered_process_map');
}