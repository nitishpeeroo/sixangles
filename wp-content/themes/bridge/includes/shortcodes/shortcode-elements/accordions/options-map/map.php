<?php 
if(!function_exists('qode_accordions_map')) {
    /**
     * Add Accordion options to elements panel
     */
   function qode_accordions_map() {
		
       $panel = qode_add_admin_panel(array(
           'title' => esc_html__('Accordions','qode'),
           'name'  => 'panel_accordions',
           'page'  => 'elementsPage'
       ));

       //Typography options
       qode_add_admin_section_title(array(
			'name' => 'typography_section_title',
			'title' => esc_html__('Typography','qode'),
			'parent' => $panel
       ));

		$typography_group = qode_add_admin_group(array(
			'name' => 'typography_group',
			'title' => esc_html__('Typography','qode'),
			'description' => esc_html__('Setup typography for accordions navigation','qode'),
			'parent' => $panel
		));

       $typography_row = qode_add_admin_row(array(
           'name' => 'typography_row',
           'next' => true,
           'parent' => $typography_group
       ));

       qode_add_admin_field(array(
           'parent'        => $typography_row,
           'type'          => 'fontsimple',
           'name'          => 'accordions_font_family',
           'default_value' => '',
           'label'         => esc_html__('Font Family','qode'),
       ));

       qode_add_admin_field(array(
           'parent'        => $typography_row,
           'type'          => 'selectsimple',
           'name'          => 'accordions_text_transform',
           'default_value' => '',
           'label'         => esc_html__('Text Transform','qode'),
           'options'       => qode_get_text_transform_array()
       ));

       qode_add_admin_field(array(
           'parent'        => $typography_row,
           'type'          => 'selectsimple',
           'name'          => 'accordions_font_style',
           'default_value' => '',
           'label'         => esc_html__('Font Style','qode'),
           'options'       => qode_get_font_style_array()
       ));

       qode_add_admin_field(array(
           'parent'        => $typography_row,
           'type'          => 'textsimple',
           'name'          => 'accordions_letter_spacing',
           'default_value' => '',
           'label'         => esc_html__('Letter Spacing','qode'),
           'args'          => array(
               'suffix' => 'px'
           )
       ));

       $typography_row2 = qode_add_admin_row(array(
           'name' => 'typography_row2',
           'next' => true,
           'parent' => $typography_group
       ));		
		
       qode_add_admin_field(array(
           'parent'        => $typography_row2,
           'type'          => 'selectsimple',
           'name'          => 'accordions_font_weight',
           'default_value' => '',
           'label'         => esc_html__('Font Weight','qode'),
           'options'       => qode_get_font_weight_array(true)
       ));
		
		//Initial Accordion Color Styles
		
		qode_add_admin_section_title(array(
           'name' => 'accordion_color_section_title',
           'title' => esc_html__('Accordions Color Styles','qode'),
           'parent' => $panel
       ));
		
		$accordions_color_group = qode_add_admin_group(array(
			'name' => 'accordions_color_group',
			'title' => esc_html__('Accordion Color Styles','qode'),
			'description' => esc_html__('Set color styles for accordion title','qode'),
			'parent' => $panel
       ));

		$accordions_color_row = qode_add_admin_row(array(
           'name' => 'accordions_color_row',
           'next' => true,
           'parent' => $accordions_color_group
       ));
		qode_add_admin_field(array(
           'parent'        => $accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'accordions_title_color',
           'default_value' => '',
           'label'         => esc_html__('Title/Icon Color','qode')
       ));

		qode_add_admin_field(array(
           'parent'        => $accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'accordions_back_color',
           'default_value' => '',
           'label'         => esc_html__('Background Color','qode')
       ));
		
		$active_accordions_color_group = qode_add_admin_group(array(
			'name' => 'active_accordions_color_group',
			'title' => esc_html__('Active and Hover Accordion Color Styles','qode'),
			'description' => esc_html__('Set color styles for active and hover accordions','qode'),
			'parent' => $panel
       ));
		$active_accordions_color_row = qode_add_admin_row(array(
           'name' => 'active_accordions_color_row',
           'next' => true,
           'parent' => $active_accordions_color_group
       ));
		qode_add_admin_field(array(
           'parent'        => $active_accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'accordions_title_color_active',
           'default_value' => '',
           'label'         => esc_html__('Title/Icon Color','qode')
       ));

		qode_add_admin_field(array(
           'parent'        => $active_accordions_color_row,
           'type'          => 'colorsimple',
           'name'          => 'accordions_back_color_active',
           'default_value' => '',
           'label'         => esc_html__('Background Color','qode')
       ));
       
   }
   add_action('qode_options_elements_page_map', 'qode_accordions_map');
}