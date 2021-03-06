<?php
if(!function_exists('qode_map_title_meta_fields')) {

	function qode_map_title_meta_fields() {

		$qodeTitleScopeArray = apply_filters('qode_title_scope_post_types', array('page', 'post', 'portfolio_page'));
		$qodeTitle = qode_add_meta_box(
			array(
				'scope' => $qodeTitleScopeArray,
				'title' => esc_html__('Qode Title', 'qode'),
				'name' => 'page_title'
			)
		);

		// Title

		$qode_show_page_title = new QodeMetaField("select","qode_show-page-title","","Don't Show Title Area","Enable this option to turn off page title area", array(
			"" => "Default",
			"no" => "No",
			"yes" => "Yes"),
			array("dependence" => true,
				"hide" => array(
					"yes"=>"#qodef_qode_page_title_area_container, #qodef-meta-box-page_title_animations"),
				"show" => array(
					""=>"#qodef_qode_page_title_area_container, #qodef-meta-box-page_title_animations",
					"no"=>"#qodef_qode_page_title_area_container, #qodef-meta-box-page_title_animations") ));
		$qodeTitle->addChild("qode_show-page-title",$qode_show_page_title);

		$qode_page_title_area_container = new QodeContainer("qode_page_title_area_container","qode_show-page-title","yes");
		$qodeTitle->addChild("qode_page_title_area_container",$qode_page_title_area_container);

		$qode_animate_page_title = new QodeMetaField("selectblank","qode_animate-page-title","","Animations","Choose an animation for Title Area",array(
			"no" => "No animation",
			"text_right_left" => "Text right to left",
			"area_top_bottom" => "Title area top to bottom"
		));
		$qode_page_title_area_container->addChild("qode_animate_page_title",$qode_animate_page_title);

		$qode_show_page_title_text = new QodeMetaField("select","qode_show-page-title-text","","Don't Show Title Text","Enable this option to hide the title text", array(
			"" => "Default",
			"no" => "No",
			"yes" => "Yes"),
			array("dependence" => true,
				"hide" => array(
					"yes"=>"#qodef_qode_title_text_container"),
				"show" => array(
					""=>"#qodef_qode_title_text_container",
					"no"=>"#qodef_qode_title_text_container") ));
		$qode_page_title_area_container->addChild("qode_show-page-title-text",$qode_show_page_title_text);

		$qode_title_text_container = new QodeContainer("qode_title_text_container","qode_show-page-title-text","yes");
		$qode_page_title_area_container->addChild("qode_title_text_container",$qode_title_text_container);

		$qode_page_title_position = new QodeMetaField("selectblank","qode_page_title_position","","Title Text Alignment","Specify Title text alignment",array(
			"left" => "Left",
			"center" => "Center",
			"right" => "Right"
		));
		$qode_title_text_container->addChild("qode_page_title_position",$qode_page_title_position);

		$group1 = new QodeGroup("Title Text Style","Define styles for text in Title Area");
		$qode_title_text_container->addChild("group1",$group1);

		$row1 = new QodeRow();
		$group1->addChild("row1",$row1);

		$qode_page_title_color = new QodeMetaField("colorsimple","qode_page-title-color","","Text Color","ThisIsDescription");
		$row1->addChild("qode_page-title-color",$qode_page_title_color);

		$qode_page_title_font_size = new QodeMetaField("selectblanksimple","qode_page_title_font_size","","Text Size","ThisIsDescription",array(
			"small" => "Small",
			"medium" => "Medium",
			"large" => "Large"
		));
		$row1->addChild("qode_page_title_font_size",$qode_page_title_font_size);

		$qode_title_text_shadow = new QodeMetaField("selectblanksimple","qode_title_text_shadow","","Text Shadow","ThisIsDescription",array(
			"no" => "No",
			"yes" => "yes"
		));
		$row1->addChild("qode_title_text_shadow",$qode_title_text_shadow);

		$qode_page_title_background_color = new QodeMetaField("color","qode_page-title-background-color","","Background Color","Choose background color for Title Area");
		$qode_page_title_area_container->addChild("qode_page-title-background-color",$qode_page_title_background_color);

		$qode_show_page_title_image = new QodeMetaField("yesempty","qode_show-page-title-image","","Don't Show Background Image","Enable this option to hide background image in Title Area", array(), array("dependence" => true, "dependence_hide_on_yes" => "#qodef_qode_background_image_container", "dependence_show_on_yes" => "#qodef_qode_title-height"));
		$qode_page_title_area_container->addChild("qode_show-page-title-image",$qode_show_page_title_image);

		$qode_background_image_container = new QodeContainer("qode_background_image_container","qode_show-page-title-image","yes");
		$qode_page_title_area_container->addChild("qode_background_image_container",$qode_background_image_container);

		$qode_title_image = new QodeMetaField("image","qode_title-image","","Background Image","Choose a background image for Title Area");
		$qode_background_image_container->addChild("qode_title-image",$qode_title_image);

		$qode_title_overlay_image = new QodeMetaField("image","qode_title-overlay-image","","Pattern Overlay Image","Choose an image to be used as pattern over Title Area");
		$qode_background_image_container->addChild("qode_title-overlay-image",$qode_title_overlay_image);

		$qode_responsive_title_image = new QodeMetaField("selectblank","qode_responsive-title-image","","Responsive Background Image","Do you want to make Title background image responsive?", array(
			"no" => "No",
			"yes" => "Yes"),
			array("dependence" => true,
				"hide" => array(
					"yes"=>"#qodef_qode_responsive_title_image_container, #qodef_qode_title-height"),
				"show" => array(
					""=>"#qodef_qode_responsive_title_image_container, #qodef_qode_title-height",
					"no"=>"#qodef_qode_responsive_title_image_container, #qodef_qode_title-height") ));
		$qode_background_image_container->addChild("qode_responsive-title-image",$qode_responsive_title_image);


		$qode_responsive_title_image_container = new QodeContainer("qode_responsive_title_image_container","qode_responsive-title-image","yes");
		$qode_background_image_container->addChild("qode_responsive_title_image_container",$qode_responsive_title_image_container);

		$qode_fixed_title_image = new QodeMetaField("selectblank","qode_fixed-title-image","","Parallax Background Image","Do you want background image to have parallax effect?", array(
			"no" => "No",
			"yes" => "Yes",
			"yes_zoom" => "Yes, with zoom out"
		));
		$qode_responsive_title_image_container->addChild("qode_fixed-title-image",$qode_fixed_title_image);

		$qode_title_height = new QodeMetaField("text","qode_title-height","","Title Height (px)","Set a height for Title Area in pixels", array(), array("col_width" => 3));
		$qode_page_title_area_container->addChild("qode_title-height",$qode_title_height);

		$qode_separator_bellow_title = new QodeMetaField("select","qode_separator_bellow_title","","Separator Under Title Text","Do you want to have a separator under title text?",
			array(
				"" => "",
				"no" => "No",
				"yes" => "Yes"
			),
			array(
				'dependence' => true,
				'hide' => array(
					'no' => '#qodef_animation_page_page_separator_container'
				),
				'show' => array(
					'' => '#qodef_animation_page_page_separator_container',
					'yes' => '#qodef_animation_page_page_separator_container'
				)
			)
		);
		$qode_page_title_area_container->addChild("qode_separator_bellow_title",$qode_separator_bellow_title);

		$qode_title_separator_color = new QodeMetaField("color","qode_title_separator_color","","Separator Color","Choose a color for separator");
		$qode_page_title_area_container->addChild("qode_title_separator_color",$qode_title_separator_color);

		$qode_title_gradient_separator = new QodeMetaField("select", "qode_title_gradient_separator_meta", "", "Enable Separator Gradient Color", "", array(
			""		=> "Default",
			"no"	=> "No",
			"yes"	=> "Yes"
		));
		$qode_page_title_area_container->addChild("qode_title_gradient_separator_meta", $qode_title_gradient_separator);

		$qode_enable_page_title_angled = new QodeMetaField("selectblank","qode_enable_page_title_angled","","Enable Angled Title","Enabling this option will show title angled", array(
			"no" => "No",
			"yes" => "Yes"),
			array("dependence" => true,
				"hide" => array(
					"no"=>"#qodef_qode_title_angled_container",
					""=>"#qodef_qode_title_angled_container"),
				"show" => array(
					"yes"=>"#qodef_qode_title_angled_container") ));
		$qode_page_title_area_container->addChild("qode_enable_page_title_angled",$qode_enable_page_title_angled);

		$qode_title_angled_container = new QodeContainer("qode_title_angled_container","qode_enable_page_title_angled","");
		$qode_page_title_area_container->addChild("qode_title_angled_container",$qode_title_angled_container);

		$qode_title_angled_section_direction = new QodeMetaField("selectblank","qode_title_angled_section_direction","","Angled Direction","Choose a direction for title angled", array(
			"from_left_to_right" => "From Left To Right",
			"from_right_to_left" => "From Right To Left"
		));
		$qode_title_angled_container->addChild("qode_title_angled_section_direction",$qode_title_angled_section_direction);

		$qode_title_angled_section_color = new QodeMetaField("color","qode_title_angled_section_color","","Background Color","Choose a background color for Title Angled");
		$qode_title_angled_container->addChild("qode_title_angled_section_color",$qode_title_angled_section_color);


		$qode_enable_breadcrumbs = new QodeMetaField("selectblank","qode_enable_breadcrumbs","","Enable Breadcrumbs","Do you want to display breadcrumbs in title area?",
			array(
				"no" => "No",
				"yes" => "Yes"
			),
			array(
				'dependence' => true,
				'hide' => array(
					'no' => '#qodef_animation_page_page_breadcrumbs_container'
				),
				'show' => array(
					'yes' => '#qodef_animation_page_page_breadcrumbs_container',
					'' => '#qodef_animation_page_page_breadcrumbs_container'
				)
			)
		);
		$qode_page_title_area_container->addChild("qode_enable_breadcrumbs",$qode_enable_breadcrumbs);

		$qode_page_breadcrumbs_color = new QodeMetaField("color","qode_page_breadcrumbs_color","","Breadcrumbs Color","Choose a color for breadcrumbs text ");
		$qode_page_title_area_container->addChild("qode_page_breadcrumbs_color",$qode_page_breadcrumbs_color);

		$qode_page_subtitle = new QodeMetaField("text","qode_page_subtitle","","Subtitle Text","Enter your subtitle text");
		$qode_page_title_area_container->addChild("qode_page_subtitle",$qode_page_subtitle);

		$qode_page_subtitle_color = new QodeMetaField("color","qode_page_subtitle_color","","Subtitle Text Color","Choose a color for subtitle text");
		$qode_page_title_area_container->addChild("qode_page_subtitle_color",$qode_page_subtitle_color);

		$qode_page_text_above_title = new QodeMetaField("text","qode_page_text_above_title","","Text Above Title","Enter your text above Title");
		$qode_page_title_area_container->addChild("qode_page_text_above_title",$qode_page_text_above_title);

		$qode_page_text_above_title_color = new QodeMetaField("color","qode_page_text_above_title_color","","Text Above Title Color","Choose a color for text above title");
		$qode_page_title_area_container->addChild("qode_page_text_above_title_color",$qode_page_text_above_title_color);

		$group_margin_after_title = new QodeGroup("Spacing After title","Define spacing after title. This option will also take effect if title is disabled, and will move the content down for the set value.");
		$qodeTitle->addChild("group_margin_after_title",$group_margin_after_title);

		$row1 = new QodeRow();
		$group_margin_after_title->addChild("row1",$row1);

		$qode_margin_after_title = new QodeMetaField("textsimple","qode_margin_after_title","","Margin After Title (px)","Set a bottom margin for Title Area");
		$row1->addChild("qode_margin_after_title",$qode_margin_after_title);

		$qode_margin_after_title_mobile = new QodeMetaField("selectblanksimple","qode_margin_after_title_mobile","","Set This Bottom Margin for Mobile Header","", array(
			"no" => "No",
			"yes" => "Yes"
		));
		$row1->addChild("qode_margin_after_title_mobile",$qode_margin_after_title_mobile);


	}

	add_action('qode_meta_boxes_map', 'qode_map_title_meta_fields');
}

if(!function_exists('qode_map_title_animations_meta_fields')) {

	// Title Animations

	function qode_map_title_animations_meta_fields() {
		$qodeTitleAnimations = qode_add_meta_box(
			array(
				'scope' => array('page', 'portfolio_page', 'post'),
				'title' => esc_html__('Qode Scroll Title Animations', 'qode'),
				'name' => 'page_title_animations',
				'hidden_property' => 'qode_show-page-title',
				'hidden_values' => array('yes')
			)
		);

		//Whole title content animation
		$page_page_title_whole_content_animations = new QodeMetaField('selectblank', 'page_page_title_whole_content_animations', '', 'Enable Whole Title Content Animation', 'This option will enable whole title content animation', array(
			'no' => 'No',
			'yes' => 'Yes'
		),
			array(
				'dependence' => true,
				'hide' => array(
					'' => '#qodef_page_page_title_whole_content_animations_container',
					'no' => '#qodef_page_page_title_whole_content_animations_container'
				),
				'show' => array(
					'yes' => '#qodef_page_page_title_whole_content_animations_container'
				)
			));
		$qodeTitleAnimations->addChild('page_page_title_whole_content_animations', $page_page_title_whole_content_animations);

		$page_page_title_whole_content_animations_container = new QodeContainer('page_page_title_whole_content_animations_container', 'page_page_title_whole_content_animations', '', array('', 'no'));
		$qodeTitleAnimations->addChild('page_page_title_whole_content_animations_container', $page_page_title_whole_content_animations_container);

		$page_page_title_whole_content_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_page_title_whole_content_animations_container->addChild('page_page_title_whole_content_animations_data_start', $page_page_title_whole_content_animations_data_start);

		$row1 = new QodeRow();
		$page_page_title_whole_content_animations_data_start->addChild('row1', $row1);

		$page_page_title_whole_content_data_start = new QodeMetaField('textsimple', 'page_page_title_whole_content_data_start', '', 'Scrollbar Top Distance (px)');
		$row1->addChild('page_page_title_whole_content_data_start', $page_page_title_whole_content_data_start);

		$page_page_title_whole_content_start_custom_style = new QodeMetaField('textareasimple', 'page_page_title_whole_content_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
		$row1->addChild('page_page_title_whole_content_start_custom_style', $page_page_title_whole_content_start_custom_style);

		$page_page_title_whole_content_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_page_title_whole_content_animations_container->addChild('page_page_title_whole_content_animations_data_end', $page_page_title_whole_content_animations_data_end);

		$row2 = new QodeRow();
		$page_page_title_whole_content_animations_data_end->addChild('row2', $row2);

		$page_page_title_whole_content_data_end = new QodeMetaField('textsimple', 'page_page_title_whole_content_data_end', '', 'Scrollbar Top Distance (px)');
		$row2->addChild('page_page_title_whole_content_data_end', $page_page_title_whole_content_data_end);

		$page_page_title_whole_content_end_custom_style = new QodeMetaField('textareasimple', 'page_page_title_whole_content_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
		$row2->addChild('page_page_title_whole_content_end_custom_style', $page_page_title_whole_content_end_custom_style);


		//Title Animations
		$animation_page_page_title_container = new QodeContainerNoStyle('animation_page_page_title_container', 'qode_show-page-title-text', 'yes');
		$qodeTitleAnimations->addChild('animation_page_page_title_container', $animation_page_page_title_container);

		$page_page_title_animations = new QodeMetaField('selectblank', 'page_page_title_animations', '', 'Enable Page Title Animations', 'This option will enable Page Title Scroll Animations',
			array(
				'no' => 'No',
				'yes' => 'Yes'
			),
			array(
				'dependence' => true,
				'hide' => array(
					'' => '#qodef_page_page_title_animations_container',
					'no' => '#qodef_page_page_title_animations_container'
				),
				'show' => array(
					'yes' => '#qodef_page_page_title_animations_container'
				) ));

		$animation_page_page_title_container->addChild('page_page_title_animations', $page_page_title_animations);

		$page_page_title_animations_container = new QodeContainer('page_page_title_animations_container', 'page_page_title_animations', '', array('', 'no'));
		$animation_page_page_title_container->addChild('page_page_title_animations_container', $page_page_title_animations_container);

		$page_page_title_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_page_title_animations_container->addChild('page_page_title_animations_data_start', $page_page_title_animations_data_start);

		$row1 = new QodeRow();
		$page_page_title_animations_data_start->addChild('row1', $row1);

		$page_page_title_data_start = new QodeMetaField('textsimple', 'page_page_title_data_start', '', 'Scrollbar Top Distance (px)');
		$row1->addChild('page_page_title_data_start', $page_page_title_data_start);

		$page_page_title_start_custom_style = new QodeMetaField('textareasimple', 'page_page_title_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
		$row1->addChild('page_page_title_start_custom_style', $page_page_title_start_custom_style);

		$page_page_title_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_page_title_animations_container->addChild('page_page_title_animations_data_end', $page_page_title_animations_data_end);

		$row2 = new QodeRow();
		$page_page_title_animations_data_end->addChild('row2', $row2);

		$page_page_title_data_end = new QodeMetaField('textsimple', 'page_page_title_data_end', '', 'Scrollbar Top Distance (px)');
		$row2->addChild('page_page_title_data_end', $page_page_title_data_end);

		$page_page_title_end_custom_style = new QodeMetaField('textareasimple', 'page_page_title_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
		$row2->addChild('page_page_title_end_custom_style', $page_page_title_end_custom_style);

		//Title Separator Animations
		$animation_page_page_separator_container = new QodeContainerNoStyle('animation_page_page_separator_container', 'qode_separator_bellow_title', 'no');
		$qodeTitleAnimations->addChild('animation_page_page_separator_container', $animation_page_page_separator_container);

		$page_page_title_separator_animations = new QodeMetaField('selectblank', 'page_page_title_separator_animations', '', 'Enable Page Separator Title Animations', 'This option will enable Page Title Separator Scroll Animations',
			array(
				'no' => 'No',
				'yes' => 'Yes'
			),
			array(
				'dependence' => true,
				'hide' => array(
					'' => '#qodef_page_page_title_separator_animations_container',
					'no' => '#qodef_page_page_title_separator_animations_container'
				),
				'show' => array(
					'yes' => '#qodef_page_page_title_separator_animations_container'
				)
			));
		$animation_page_page_separator_container->addChild('page_page_title_separator_animations', $page_page_title_separator_animations);

		$page_page_title_separator_animations_container = new QodeContainer('page_page_title_separator_animations_container', 'page_page_title_separator_animations', '', array('no', ''));
		$animation_page_page_separator_container->addChild('page_page_title_separator_animations_container', $page_page_title_separator_animations_container);

		$page_page_title_separator_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_page_title_separator_animations_container->addChild('page_page_title_separator_animations_data_start', $page_page_title_separator_animations_data_start);

		$row1 = new QodeRow();
		$page_page_title_separator_animations_data_start->addChild('row1', $row1);

		$page_page_title_separator_data_start = new QodeMetaField('textsimple', 'page_page_title_separator_data_start', '', 'Scrollbar Top Distance (px)');
		$row1->addChild('page_page_title_separator_data_start', $page_page_title_separator_data_start);

		$page_page_title_separator_start_custom_style = new QodeMetaField('textareasimple', 'page_page_title_separator_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
		$row1->addChild('page_page_title_separator_start_custom_style', $page_page_title_separator_start_custom_style);

		$page_page_title_separator_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_page_title_separator_animations_container->addChild('page_page_title_separator_animations_data_end', $page_page_title_separator_animations_data_end);

		$row2 = new QodeRow();
		$page_page_title_separator_animations_data_end->addChild('row2', $row2);

		$page_page_title_separator_data_end = new QodeMetaField('textsimple', 'page_page_title_separator_data_end', '', 'Scrollbar Top Distance (px)');
		$row2->addChild('page_page_title_separator_data_end', $page_page_title_separator_data_end);

		$page_page_title_separator_end_custom_style = new QodeMetaField('textareasimple', 'page_page_title_separator_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
		$row2->addChild('page_page_title_separator_end_custom_style', $page_page_title_separator_end_custom_style);

		//Subtitle Animations
		$page_page_subtitle_animations = new QodeMetaField('selectblank', 'page_page_subtitle_animations', '', 'Enable Page Subtitle Animations', 'This option will enable Page Subtitle Scroll Animations',
			array(
				'no' => 'No',
				'yes' => 'Yes'
			),
			array(
				'dependence' => true,
				'hide' => array(
					'' => '#qodef_page_page_subtitle_animations_container',
					'no' => '#qodef_page_page_subtitle_animations_container'
				),
				'show' => array(
					'yes' => '#qodef_page_page_subtitle_animations_container'
				)
			));
		$qodeTitleAnimations->addChild('page_page_subtitle_animations', $page_page_subtitle_animations);

		$page_page_subtitle_animations_container = new QodeContainer('page_page_subtitle_animations_container', 'page_page_subtitle_animations', '', array('', 'no'));
		$qodeTitleAnimations->addChild('page_page_subtitle_animations_container', $page_page_subtitle_animations_container);

		$page_page_subtitle_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_page_subtitle_animations_container->addChild('page_page_subtitle_animations_data_start', $page_page_subtitle_animations_data_start);

		$row1 = new QodeRow();
		$page_page_subtitle_animations_data_start->addChild('row1', $row1);

		$page_page_subtitle_data_start = new QodeMetaField('textsimple', 'page_page_subtitle_data_start', '', 'Scrollbar Top Distance (px)');
		$row1->addChild('page_page_subtitle_data_start', $page_page_subtitle_data_start);

		$page_page_subtitle_start_custom_style = new QodeMetaField('textareasimple', 'page_page_subtitle_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
		$row1->addChild('page_page_subtitle_start_custom_style', $page_page_subtitle_start_custom_style);

		$page_page_subtitle_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_page_subtitle_animations_container->addChild('page_page_subtitle_animations_data_end', $page_page_subtitle_animations_data_end);

		$row2 = new QodeRow();
		$page_page_subtitle_animations_data_end->addChild('row2', $row2);

		$page_page_subtitle_data_end = new QodeMetaField('textsimple', 'page_page_subtitle_data_end', '', 'Scrollbar Top Distance (px)');
		$row2->addChild('page_page_subtitle_data_end', $page_page_subtitle_data_end);

		$page_page_subtitle_end_custom_style = new QodeMetaField('textareasimple', 'page_page_subtitle_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
		$row2->addChild('page_page_subtitle_end_custom_style', $page_page_subtitle_end_custom_style);

		//Breadcrumb animations
		$animation_page_page_breadcrumbs_container = new QodeContainerNoStyle('animation_page_page_breadcrumbs_container', 'qode_enable_breadcrumbs', 'no');
		$qodeTitleAnimations->addChild('animation_page_page_breadcrumbs_container', $animation_page_page_breadcrumbs_container);

		$page_page_title_breadcrumbs_animations = new QodeMetaField('selectblank', 'page_page_title_breadcrumbs_animations', '', 'Enable Page Title Breadcrumbs Animations', 'This option will enable Page Title Breadcrumbs Scroll Animations',
			array(
				'no' => 'No',
				'yes' => 'Yes'
			),
			array(
				'dependence' => true,
				'hide' => array(
					'' => '#qodef_page_page_title_breadcrumbs_animations_container',
					'no' => '#qodef_page_page_title_breadcrumbs_animations_container'
				),
				'show' => array(
					'yes' => '#qodef_page_page_title_breadcrumbs_animations_container'
				)
			));
		$animation_page_page_breadcrumbs_container->addChild('page_page_title_breadcrumbs_animations', $page_page_title_breadcrumbs_animations);

		$page_page_title_breadcrumbs_animations_container = new QodeContainer('page_page_title_breadcrumbs_animations_container', 'page_page_title_breadcrumbs_animations', '', array('', 'no'));
		$animation_page_page_breadcrumbs_container->addChild('page_page_title_breadcrumbs_animations_container', $page_page_title_breadcrumbs_animations_container);

		$page_page_title_breadcrumbs_animations_data_start = new QodeGroup('Scrolling Animation Start Point', 'These are properties for the first keyframe in scrolling animation');
		$page_page_title_breadcrumbs_animations_container->addChild('page_page_title_breadcrumbs_animations_data_start', $page_page_title_breadcrumbs_animations_data_start);

		$row1 = new QodeRow();
		$page_page_title_breadcrumbs_animations_data_start->addChild('row1', $row1);

		$page_page_title_breadcrumbs_data_start = new QodeMetaField('textsimple', 'page_page_title_breadcrumbs_data_start', '', 'Scrollbar Top Distance (px)');
		$row1->addChild('page_page_title_breadcrumbs_data_start', $page_page_title_breadcrumbs_data_start);

		$page_page_title_breadcrumbs_start_custom_style = new QodeMetaField('textareasimple', 'page_page_title_breadcrumbs_start_custom_style', '', 'Enter CSS declarations separated by semicolons');
		$row1->addChild('page_page_title_breadcrumbs_start_custom_style', $page_page_title_breadcrumbs_start_custom_style);

		$page_page_title_breadcrumbs_animations_data_end = new QodeGroup('Scrolling Animation End Point', 'These are properties for the last keyframe in scrolling animation');
		$page_page_title_breadcrumbs_animations_container->addChild('page_page_title_breadcrumbs_animations_data_end', $page_page_title_breadcrumbs_animations_data_end);

		$row2 = new QodeRow();
		$page_page_title_breadcrumbs_animations_data_end->addChild('row2', $row2);

		$page_page_title_breadcrumbs_data_end = new QodeMetaField('textsimple', 'page_page_title_breadcrumbs_data_end', '', 'Scrollbar Top Distance (px)');
		$row2->addChild('page_page_title_breadcrumbs_data_end', $page_page_title_breadcrumbs_data_end);

		$page_page_title_breadcrumbs_end_custom_style = new QodeMetaField('textareasimple', 'page_page_title_breadcrumbs_end_custom_style', '', 'Enter CSS declarations separated by semicolons');
		$row2->addChild('page_page_title_breadcrumbs_end_custom_style', $page_page_title_breadcrumbs_end_custom_style);


	}

	add_action('qode_meta_boxes_map', 'qode_map_title_animations_meta_fields');
}