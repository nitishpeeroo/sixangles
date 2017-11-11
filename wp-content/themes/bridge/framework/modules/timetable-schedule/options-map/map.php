<?php 
if(!function_exists('qode_timetable_map')) {
    /**
     * Add Timetable options
     */
   function qode_timetable_map() {

		qode_add_admin_page(
			array(
				'slug' => '_timetable_page',
				'title' => esc_html__('Timetable','crimson'),
				'icon' => 'fa fa-calendar'
			)
		);

       $panel_single = qode_add_admin_panel(array(
           'title' => esc_html__('Events Single','qode'),
           'name'  => 'panel_timetable_single',
           'page'  => '_timetable_page'
       ));

       //Single Event options
       
       qode_add_admin_field(array(
           'parent'        => $panel_single,
           'type'          => 'select',
           'name'          => 'event_single_sidebar_layout',
           'default_value' => 'default',
           'label'         => esc_html__('Sidebar Layout','qode'),
           'description'   => esc_html__('Choose a sidebar layout for single event pages','qode'),
           'options'       => array(
           		"default" => esc_html__("No Sidebar",'qode'),
	            "1" => esc_html__("Sidebar 1/3 right",'qode'),
	            "2" => esc_html__("Sidebar 1/4 right",'qode'),
	            "3" => esc_html__("Sidebar 1/3 left",'qode'),
	            "4" => esc_html__("Sidebar 1/4 left",'qode')
           	)
   		));

        $custom_sidebars = array();
        foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
            if (isUserMadeSidebar(ucwords($sidebar['name']))) {
                $custom_sidebars[$sidebar['id']] = ucwords($sidebar['name']);
            }
        }

		qode_add_admin_field(array(
			'parent'        => $panel_single,
			'type'          => 'select',
			'name'          => 'event_single_sidebar_custom_display',
			'default_value' => '',
			'label'         => esc_html__('Sidebar to Display','qode'),
			'description'   => esc_html__('Choose a sidebar to display on single event pages','qode'),
			'options'       => $custom_sidebars
		));

       $panel = qode_add_admin_panel(array(
           'title' => esc_html__('Timetable Shortcode','qode'),
           'name'  => 'panel_timetable',
           'page'  => '_timetable_page'
       ));

       //Typography options
       qode_add_admin_section_title(array(
			'name' => 'typography_section_title',
			'title' => esc_html__('Typography','qode'),
			'parent' => $panel
       ));

		$heading_typography_group = qode_add_admin_group(array(
			'name' => 'heading_typography_group',
			'title' => esc_html__('Columns Heading Typography','qode'),
			'description' => esc_html__('Setup typography for columns heading','qode'),
			'parent' => $panel
		));

       $heading_typography_row = qode_add_admin_row(array(
           'name' => 'heading_typography_row',
           'next' => true,
           'parent' => $heading_typography_group
       ));

       qode_add_admin_field(array(
           'parent'        => $heading_typography_row,
           'type'          => 'textsimple',
           'name'          => 'timetable_title_font_size',
           'default_value' => '',
           'label'         => esc_html__('Font Size (px)','qode')
       ));

       qode_add_admin_field(array(
           'parent'        => $heading_typography_row,
           'type'          => 'fontsimple',
           'name'          => 'timetable_title_font_family',
           'default_value' => '',
           'label'         => esc_html__('Font Family','qode'),
       ));

       qode_add_admin_field(array(
           'parent'        => $heading_typography_row,
           'type'          => 'selectsimple',
           'name'          => 'timetable_title_text_transform',
           'default_value' => '',
           'label'         => esc_html__('Text Transform','qode'),
           'options'       => qode_get_text_transform_array()
       ));

       qode_add_admin_field(array(
           'parent'        => $heading_typography_row,
           'type'          => 'selectsimple',
           'name'          => 'timetable_title_font_style',
           'default_value' => '',
           'label'         => esc_html__('Font Style','qode'),
           'options'       => qode_get_font_style_array()
       ));

       $heading_typography_row2 = qode_add_admin_row(array(
           'name' => 'heading_typography_row2',
           'next' => true,
           'parent' => $heading_typography_group
       ));		
		
       qode_add_admin_field(array(
           'parent'        => $heading_typography_row2,
           'type'          => 'textsimple',
           'name'          => 'timetable_title_letter_spacing',
           'default_value' => '',
           'label'         => esc_html__('Letter Spacing (px)','qode'),
       ));

       qode_add_admin_field(array(
           'parent'        => $heading_typography_row2,
           'type'          => 'selectsimple',
           'name'          => 'timetable_title_font_weight',
           'default_value' => '',
           'label'         => esc_html__('Font Weight','qode'),
           'options'       => qode_get_font_weight_array(true)
       ));
		
		//Initial Timetable Color Styles
		
		qode_add_admin_section_title(array(
           'name' => 'accordion_color_section_title',
           'title' => esc_html__('Color Styles','qode'),
           'parent' => $panel
       ));
		
		$timetable_heading_color_group = qode_add_admin_group(array(
			'name' => 'timetable_heading_color_group',
			'title' => esc_html__('Heading Color Styles','qode'),
			'description' => esc_html__('Set color styles for timetable heading','qode'),
			'parent' => $panel
		));

        $timetable_heading_color_row = qode_add_admin_row(array(
            'name' => 'timetable_heading_color_row',
            'next' => true,
            'parent' => $timetable_heading_color_group
        ));

		qode_add_admin_field(array(
			'parent'        => $timetable_heading_color_row,
			'type'          => 'colorsimple',
			'name'          => 'timetable_title_color',
			'default_value' => '',
			'label'         => esc_html__('Color', 'qode'),
			'description'   => ''
		));

		qode_add_admin_field(array(
			'parent'        => $timetable_heading_color_row,
			'type'          => 'colorsimple',
			'name'          => 'timetable_title_bckg_color',
			'default_value' => '',
			'label'         => esc_html__('Background Color', 'qode'),
			'description'   => ''
		));

		$timetable_color_group = qode_add_admin_group(array(
			'name' => 'timetable_color_group',
			'title' => esc_html__('Timetable Color Styles','qode'),
			'description' => esc_html__('Set color styles for timetable','qode'),
			'parent' => $panel
		));

        $timetable_color_row = qode_add_admin_row(array(
            'name' => 'timetable_color_row',
            'next' => true,
            'parent' => $timetable_color_group
        ));

		qode_add_admin_field(array(
			'parent'        => $timetable_color_row,
			'type'          => 'colorsimple',
			'name'          => 'timetable_border_color',
			'default_value' => '',
			'label'         => esc_html__('Border Color', 'qode'),
			'description'   => ''
		));

        qode_add_admin_field(array(
            'parent'        => $timetable_color_row,
            'type'          => 'colorsimple',
            'name'          => 'timetable_odd_bckg_color',
            'default_value' => '',
            'label'         => esc_html__('Odd Rows Background Color', 'qode')
        ));

		qode_add_admin_field(array(
			'parent'        => $timetable_color_row,
			'type'          => 'colorsimple',
			'name'          => 'timetable_even_bckg_color',
			'default_value' => '',
			'label'         => esc_html__('Even Rows Background Color', 'qode')
		));
       
   }
   add_action('qode_options_map', 'qode_timetable_map',115);
}