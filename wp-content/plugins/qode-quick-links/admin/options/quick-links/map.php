<?php
if(qode_quick_links_theme_installed()) {
	if(!function_exists('qode_quick_links_map_map')) {
		/**
		 * Adds admin page for OpenTable integration
		 */
		function qode_quick_links_map_map() {
			qode_add_admin_page(array(
				'title' =>  esc_html__( 'Quick Links','qode-quick-links' ),
				'slug'  => '_quick_links',
				'icon'  => 'fa fa-link'
			));

			// Quick Links Panel
			$panel_quick_links = qode_add_admin_panel(array(
				'page'  => '_quick_links',
				'name'  => 'panel_quick_links',
				'title' =>  esc_html__( 'Quick Links','qode-quick-links' )
			));

			qode_add_admin_field(array(
				'name'        	=> 'enable_quick_links',
				'type'        	=> 'yesno',
				'label'       	=> esc_html__( 'Enable Quick Links','qode-quick-links' ),
				'default_value' => 'no',
				'parent'      	=> $panel_quick_links,
				'args' => array(
					'col_width' => 3,
					'dependence' => true,
					'dependence_hide_on_yes' => '',
					'dependence_show_on_yes' => '#qodef_qode_quick_links_container'
				)
			));

			$quick_links_container = qode_add_admin_container(
				array(
					'name' => 'qode_quick_links_container',
					'hidden_property' => 'enable_quick_links',
					'hidden_value' =>  'no',
					'parent' => $panel_quick_links,
				)
			);
			qode_add_admin_field(array(
				'name'        	=> 'quick_links_items_number',
				'type'        	=> 'text',
				'label'       	=> esc_html__( 'Quick Links Number Of Items','qode-quick-links' ),
				'default_value' => '',
				'parent'      	=> $quick_links_container,

			));
			qode_add_admin_field(array(
				'name'        	=> 'quick_links_button_logo',
				'type'        	=> 'image',
				'label'       	=> esc_html__( 'Quick Links Button Logo','qode-quick-links' ),
				'default_value' => '',
				'parent'      	=> $quick_links_container,

			));
			qode_add_admin_field(array(
				'name'        	=> 'quick_links_title',
				'type'        	=> 'text',
				'label'       	=> esc_html__( 'Quick Links Title','qode-quick-links' ),
				'default_value' => '',
				'parent'      	=> $quick_links_container,

			));
			qode_add_admin_field(array(
				'name'        	=> 'quick_links_title_image',
				'type'        	=> 'image',
				'label'       	=> esc_html__( 'Quick Links Title Image','qode-quick-links' ),
				'default_value' => '',
				'parent'      	=> $quick_links_container,

			));


			$typography_title_group = qode_add_admin_group(array(
				'name'			=> 'quick_links_title_typography_group',
				'title'			=> esc_html__( 'Title Typography','qode-quick-links' ),
				'description' 	=> esc_html__( 'Setup typography styles for titles','qode-quick-links' ),
				'parent'		=> $quick_links_container
			));

			$typography_title_row = qode_add_admin_row(array(
				'name' => 'typography_title_row',
				'next' => true,
				'parent' => $typography_title_group
			));

			qode_add_admin_field(array(
				'parent'        => $typography_title_row,
				'type'          => 'colorsimple',
				'name'          => 'quick_links_title_color',
				'default_value' => '',
				'label'         => esc_html__( 'Color', 'qode-quick-links' ),
				'args'          => array(
					'suffix' => 'px'
				)
			));

			qode_add_admin_field(array(
				'parent'        => $typography_title_row,
				'type'          => 'textsimple',
				'name'          => 'quick_links_title_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'qode-quick-links' ),
				'args'          => array(
					'suffix' => 'px'
				)
			));

			qode_add_admin_field(array(
				'parent'        => $typography_title_row,
				'type'          => 'textsimple',
				'name'          => 'quick_links_title_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'qode-quick-links' ),
				'args'          => array(
					'suffix' => 'px'
				)
			));
			qode_add_admin_field(array(
				'parent'        => $typography_title_row,
				'type'          => 'selectsimple',
				'name'          => 'quick_links_title_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'qode-quick-links' ),
				'options'       => qode_get_text_transform_array()
			));

			$typography_title_row2 = qode_add_admin_row(array(
				'name' => 'typography_title_row2',
				'next' => true,
				'parent' => $typography_title_group
			));

			qode_add_admin_field(array(
				'parent'        => $typography_title_row2,
				'type'          => 'fontsimple',
				'name'          => 'quick_links_title_font_family',
				'default_value' => '',
				'label'			=> esc_html__( 'Font Family','qode-quick-links' )
			));

			qode_add_admin_field(array(
				'parent'        => $typography_title_row2,
				'type'          => 'selectsimple',
				'name'          => 'quick_links_title_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'qode-quick-links' ),
				'options'       => qode_get_font_style_array()
			));

			qode_add_admin_field(array(
				'parent'        => $typography_title_row2,
				'type'          => 'selectsimple',
				'name'          => 'quick_links_title_font_weight',
				'default_value' => '',
				'label'         =>  esc_html__( 'Font Weight', 'qode-quick-links' ),
				'options'       => qode_get_font_weight_array(true)
			));

			qode_add_admin_field(array(
				'parent'        => $typography_title_row2,
				'type'          => 'textsimple',
				'name'          => 'quick_links_title_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'qode-quick-links' ),
				'args'          => array(
					'suffix' => 'px'
				)
			));

			$typography_text_group = qode_add_admin_group(array(
				'name'			=> 'quick_links_text_typography_group',
				'title'			=> esc_html__( 'Text Typography','qode-quick-links' ),
				'description' 	=> esc_html__( 'Setup typography styles for text','qode-quick-links' ),
				'parent'		=> $quick_links_container
			));

			$typography_text_row = qode_add_admin_row(array(
				'name' => 'typography_text_row',
				'next' => true,
				'parent' => $typography_text_group
			));

			qode_add_admin_field(array(
				'parent'        => $typography_text_row,
				'type'          => 'colorsimple',
				'name'          => 'quick_links_text_color',
				'default_value' => '',
				'label'         => esc_html__( 'Color', 'qode-quick-links' ),
				'args'          => array(
					'suffix' => 'px'
				)
			));

			qode_add_admin_field(array(
				'parent'        => $typography_text_row,
				'type'          => 'textsimple',
				'name'          => 'quick_links_text_font_size',
				'default_value' => '',
				'label'         => esc_html__( 'Font Size', 'qode-quick-links' ),
				'args'          => array(
					'suffix' => 'px'
				)
			));

			qode_add_admin_field(array(
				'parent'        => $typography_text_row,
				'type'          => 'textsimple',
				'name'          => 'quick_links_text_line_height',
				'default_value' => '',
				'label'         => esc_html__( 'Line Height', 'qode-quick-links' ),
				'args'          => array(
					'suffix' => 'px'
				)
			));
			qode_add_admin_field(array(
				'parent'        => $typography_text_row,
				'type'          => 'selectsimple',
				'name'          => 'quick_links_text_text_transform',
				'default_value' => '',
				'label'         => esc_html__( 'Text Transform', 'qode-quick-links' ),
				'options'       => qode_get_text_transform_array()
			));

			$typography_text_row2 = qode_add_admin_row(array(
				'name' => 'typography_text_row2',
				'next' => true,
				'parent' => $typography_text_group
			));

			qode_add_admin_field(array(
				'parent'        => $typography_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'quick_links_text_font_family',
				'default_value' => '',
				'label'			=> esc_html__( 'Font Family','qode-quick-links' )
			));

			qode_add_admin_field(array(
				'parent'        => $typography_text_row2,
				'type'          => 'selectsimple',
				'name'          => 'quick_links_text_font_style',
				'default_value' => '',
				'label'         => esc_html__( 'Font Style', 'qode-quick-links' ),
				'options'       => qode_get_font_style_array()
			));

			qode_add_admin_field(array(
				'parent'        => $typography_text_row2,
				'type'          => 'selectsimple',
				'name'          => 'quick_links_text_font_weight',
				'default_value' => '',
				'label'         =>  esc_html__( 'Font Weight', 'qode-quick-links' ),
				'options'       => qode_get_font_weight_array(true)
			));

			qode_add_admin_field(array(
				'parent'        => $typography_text_row2,
				'type'          => 'textsimple',
				'name'          => 'quick_links_text_letter_spacing',
				'default_value' => '',
				'label'         => esc_html__( 'Letter Spacing', 'qode-quick-links' ),
				'args'          => array(
					'suffix' => 'px'
				)
			));

		}

		add_action('qode_options_map', 'qode_quick_links_map_map', 72); //one after elements
	}
}