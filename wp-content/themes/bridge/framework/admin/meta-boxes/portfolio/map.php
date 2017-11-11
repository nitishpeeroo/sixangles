<?php

if(!function_exists('qode_map_portfolio_general_meta_fields')) {

	//General

	function qode_map_portfolio_general_meta_fields() {

		$qode_pages = array();
		$pages = get_pages();
		foreach($pages as $page) {
			$qode_pages[$page->ID] = $page->post_title;
		}

		$qodeGeneral = qode_add_meta_box(
			array(
				'scope' => array('portfolio_page'),
				'title' => esc_html__('Qode Portfolio General', 'qode'),
				'name' => 'portfolio_general'
			)
		);

		$qode_portfolio_date = new QodeMetaField("date","qode_portfolio_date","","Date","Set date for portfolio item");
		$qodeGeneral->addChild("qode_portfolio_date",$qode_portfolio_date);

		$qode_choose_portfolio_single_view = new QodeMetaField("selectblank","qode_choose-portfolio-single-view","","Portfolio Type",'Choose a portfolio type', array(
			"1" => "Portfolio small images",
			"2" => "Portfolio small slider",
			"5" => "Portfolio big images",
			"3" => "Portfolio big slider",
			"4" => "Portfolio custom - in grid",
			"7" => "Portfolio custom - full width",
			"6" => "Portfolio gallery",
			"8" => "Portfolio big slider - modern"
		),
			array("dependence" => true,
				"hide" => array(
					""=>"#qodef_qode_choose_number_of_portfolio_columns_container",
					"1"=>"#qodef_qode_choose_number_of_portfolio_columns_container",
					"2"=>"#qodef_qode_choose_number_of_portfolio_columns_container",
					"3"=>"#qodef_qode_choose_number_of_portfolio_columns_container",
					"4"=>"#qodef_qode_choose_number_of_portfolio_columns_container",
					"5"=>"#qodef_qode_choose_number_of_portfolio_columns_container",
					"7"=>"#qodef_qode_choose_number_of_portfolio_columns_container",
					"8"=>"#qodef_qode_choose_number_of_portfolio_columns_container"
				),
				"show" => array(
					"6"=>"#qodef_qode_choose_number_of_portfolio_columns_container")
			)
		);
		$qodeGeneral->addChild("qode_choose-portfolio-single-view",$qode_choose_portfolio_single_view);

		$qode_choose_number_of_portfolio_columns_container = new QodeContainer("qode_choose_number_of_portfolio_columns_container","qode_choose-portfolio-single-view","no",array("", "1", "2", "3", "4", "5", "7"));
		$qodeGeneral->addChild("qode_choose_number_of_portfolio_columns_container",$qode_choose_number_of_portfolio_columns_container);

		$qode_choose_number_of_portfolio_columns = new QodeMetaField("selectblank","qode_choose-number-of-portfolio-columns","","Number of Columns",'Enter the number of columns for Portfolio Gallery type', array(
			"2" => "2 Columns",
			"3" => "3 Columns",
			"4" => "4 Columns"
		));

		$qode_choose_number_of_portfolio_columns_container->addChild("qode_choose-number-of-portfolio-columns",$qode_choose_number_of_portfolio_columns);

		$qode_portfolio_image_galery_orientation = new QodeMetaField("select","qode_portfolio_gallery_image_orientation","full","Image Proportions","Choose image proportions for Portfolio Gallery type",array(
			"full" => "Original",
			"portfolio-square" => "Square",
			"portfolio-portrait" => "Portrait",
			"portfolio-landscape" => "Landscape"
		));

		$qode_choose_number_of_portfolio_columns_container->addChild("qode_portfolio-external-link",$qode_portfolio_image_galery_orientation);


		$qode_choose_portfolio_list_page = new QodeMetaField("selectblank","qode_choose-portfolio-list-page","",'"Back To" Link','Choose "Back To" page to link from portfolio Single Project page',$qode_pages);
		$qodeGeneral->addChild("qode_choose-portfolio-list-page",$qode_choose_portfolio_list_page);

		$qode_portfolio_external_link = new QodeMetaField("text","qode_portfolio-external-link","","Portfolio External Link","Enter URL to link from Portfolio List page (e.g. http://demo.qodeinteractive.com/bridge )");
		$qodeGeneral->addChild("qode_portfolio-external-link",$qode_portfolio_external_link);

		$qode_portfolio_external_link_target = new QodeMetaField("select","qode_portfolio-external-link-target","_blank","Portfolio External Link Target","Choose target for portfolio link from Portfolio List page", array(
			"_blank" => "Blank",
			"_self" => "Self"
		));
		$qodeGeneral->addChild("qode_portfolio-external-link-target",$qode_portfolio_external_link_target);

		$qode_portfolio_lightbox_link = new QodeMetaField("text","qode_portfolio-lightbox-link","","Portfolio Custom Lightbox Content","Enter URL to link custom image/video content inside lightbox");
		$qodeGeneral->addChild("qode_portfolio-lightbox-link",$qode_portfolio_lightbox_link);

		$qode_portfolio_type_masonry_style = new QodeMetaField("select","qode_portfolio_type_masonry_style","","Dimensions for Masonry",'Choose image layout when it appears in Masonry type portfolio lists', array(
			"default" => "Default",
			"large_width" => "Large width",
			"large_height" => "Large height",
			"large_width_height" => "Large width/height"
		));
		$qodeGeneral->addChild("qode_portfolio_type_masonry_style",$qode_portfolio_type_masonry_style);

		$qode_show_badge = new QodeMetaField("yesempty","qode_show_badge","","Show 'Badge","Enable this option will show badge in portfolio list", array(), array("dependence" => true, "dependence_hide_on_yes" => "", "dependence_show_on_yes" => "#qodef_qode_badge_container"));
		$qodeGeneral->addChild("qode_show_badge",$qode_show_badge);

		$qode_badge_container = new QodeContainer("qode_badge_container","qode_show_badge","");
		$qodeGeneral->addChild("qode_badge_container",$qode_badge_container);

		$qode_badge_text = new QodeMetaField("text","qode_badge_text","","Badge Text","", array(), array());
		$qode_badge_container->addChild("qode_badge_text",$qode_badge_text);

	}

	add_action('qode_meta_boxes_map', 'qode_map_portfolio_general_meta_fields');
}

if(!function_exists('qode_map_portfolio_images_videos_meta_fields')) {

	//Portfolio Images

	function qode_map_portfolio_images_videos_meta_fields() {

		$qodePortfolioImages = qode_add_meta_box(
			array(
				'scope' => array('portfolio_page'),
				'title' => esc_html__('Qode Portfolio Images (multiple upload)', 'qode'),
				'name' => 'portfolio_images'
			)
		);

		$qode_portfolio_image_gallery = new QodeMultipleImages("qode_portfolio-image-gallery","Portfolio Images","Choose your portfolio images");
		$qodePortfolioImages->addChild("qode_portfolio-image-gallery",$qode_portfolio_image_gallery);

		/*//Portfolio Images/Videos

		$qodePortfolioImagesVideos = new QodeMetaBox("portfolio_page", "Qode Portfolio Images/Videos (single upload)");
		$qodeFramework->qodeMetaBoxes->addMetaBox("portfolio_images_videos",$qodePortfolioImagesVideos);

			$qode_portfolio_images_videos = new QodeImagesVideos("Portfolio Images/Videos","ThisIsDescription");
			$qodePortfolioImagesVideos->addChild("qode_portfolio_images_videos",$qode_portfolio_images_videos);
		*/
		//Portfolio Images/Videos 2

		$qodePortfolioImagesVideos2 = qode_add_meta_box(
			array(
				'scope' => array('portfolio_page'),
				'title' => esc_html__('Qode Portfolio Images/Videos (single upload)', 'qode'),
				'name' => 'portfolio_images_videos2'
			)
		);

		$qode_portfolio_images_videos2 = new QodeImagesVideosFramework("Portfolio Images/Videos 2","ThisIsDescription");
		$qodePortfolioImagesVideos2->addChild("qode_portfolio_images_videos2",$qode_portfolio_images_videos2);

		//Portfolio Additional Sidebar Items

		$qodeAdditionalSidebarItems = qode_add_meta_box(
			array(
				'scope' => array('portfolio_page'),
				'title' => esc_html__('Qode Additional Portfolio Sidebar Items', 'qode'),
				'name' => 'portfolio_properties'
			)
		);

		$qode_portfolio_properties = new QodeOptionsFramework("Portfolio Properties","ThisIsDescription");
		$qodeAdditionalSidebarItems->addChild("qode_portfolio_properties",$qode_portfolio_properties);

	}

	add_action('qode_meta_boxes_map', 'qode_map_portfolio_images_videos_meta_fields');
}