<?php
if(qode_quick_links_theme_installed()) {
	if(!function_exists('qode_quick_links_meta_box_map')) {
		function qode_quick_links_meta_box_map() {

			$quick_links_meta_box = qode_add_meta_box(
				array(
					'scope' => array('qode-quick-link'),
					'title' => esc_html__('Quick Links General', 'qode-quick-links'),
					'name' => 'quick_links_meta'
				)
			);

			qode_add_meta_box_field(
				array(
					'name' => 'qode_quick_link_text',
					'type' => 'text',
					'default_value' => '',
					'label' => esc_html__('Text', 'qode-quick-links'),
					'parent' => $quick_links_meta_box
				)
			);

			qode_add_meta_box_field(
				array(
					'name' => 'qode_quick_link_highlighted_label',
					'type' => 'text',
					'default_value' => '',
					'label' => esc_html__('Highlighted Label', 'qode-quick-links'),
					'parent' => $quick_links_meta_box
				)
			);

			qode_add_meta_box_field(
				array(
					'name' => 'qode_quick_link_link',
					'type' => 'text',
					'default_value' => '',
					'label' => esc_html__('Link', 'qode-quick-links'),
					'parent' => $quick_links_meta_box
				)
			);

			qode_add_meta_box_field(
				array(
					'name' => 'qode_quick_link_link_anchor',
					'type' => 'yesno',
					'default_value' => 'no',
					'label' => esc_html__('Link Anchor', 'qode-quick-links'),
					'parent' => $quick_links_meta_box
				)
			);

		}

		add_action('qode_meta_boxes_map', 'qode_quick_links_meta_box_map');
	}
}