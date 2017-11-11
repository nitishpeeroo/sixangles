<?php

if(qode_visual_composer_installed()) {

	if(!function_exists('qode_ttsingle_hours_vc_map')) {
		function qode_ttsingle_hours_vc_map() {
			vc_map(array(
				'name'                      => esc_html__('Timetable Event Hours', 'qode'),
				'base'                      => 'tt_event_hours',
				'category'                  => esc_html__('by QODE', 'qode'),
				'icon'                      => 'extended-custom-icon-qode icon-wpb-tt-event-hours',
				'show_settings_on_create'	=> false,
				'allowed_container_element' => 'vc_row'
			));
		}

		add_action('qode_vc_map', 'qode_ttsingle_hours_vc_map');
	}

	if(!function_exists('qode_ttsingle_info_holder')) {
		function qode_ttsingle_info_holder() {
			vc_map(array(
				"name"                    => esc_html__('Timetable Event Info Holder', 'qode'),
				'base'                    => 'tt_items_list',
				'as_parent'               => array('only' => 'tt_item'),
				'content_element'         => true,
				'category'                => esc_html__('by QODE', 'qode'),
				'icon'                    => 'extended-custom-icon-qode icon-wpb-tt-items-list',
				'show_settings_on_create' => false,
				'js_view'                 => 'VcColumnView'
			));
		}

		add_action('qode_vc_map', 'qode_ttsingle_info_holder');
	}

	if(!function_exists('qode_ttsingle_info_table_item')) {
		function qode_ttsingle_info_table_item() {
			vc_map(array(
				'name'                    => esc_html__('Timetable Event Info Table Item', 'qode'),
				'base'                    => 'tt_item',
				'as_child'                => array('only' => 'tt_items_list'),
				'category'                => esc_html__('by QODE', 'qode'),
				'icon'                    => 'extended-custom-icon-qode icon-wpb-tt-item',
				'show_settings_on_create' => true,
				'params'                  => array(
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Label', 'qode'),
						'param_name'  => 'content',
						'admin_label' => true
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Value', 'qode'),
						'param_name'  => 'value',
						'admin_label' => true
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Type', 'qode'),
						'param_name'  => 'type',
						'admin_label' => true,
						'value'       => array(
							'Table' => 'info'
						),
						'save_always' => true
					),
				)
			));
		}

		add_action('qode_vc_map', 'qode_ttsingle_info_table_item');
	}

	class WPBakeryShortCode_Tt_Items_List extends WPBakeryShortCodesContainer {
	}
}

