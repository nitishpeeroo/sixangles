<?php
if(!function_exists('qode_map_seo_meta_fields')) {

	function qode_map_seo_meta_fields() {
		$qodeSeo = qode_add_meta_box(
			array(
				'scope' => array('page', 'portfolio_page', 'post'),
				'title' => esc_html__('Qode SEO', 'qode'),
				'name' => 'page_seo'
			)
		);

		$seo_title = new QodeMetaField("text","qode_seo_title","","SEO Title","Enter custom Title for this page");
		$qodeSeo->addChild("qode_seo_title",$seo_title);

		$seo_keywords = new QodeMetaField("text","qode_seo_keywords","","Meta Keywords","Enter the list of keywords separated by comma");
		$qodeSeo->addChild("qode_seo_keywords",$seo_keywords);

		$seo_description = new QodeMetaField("textarea","qode_seo_description","","Meta Description","Enter meta description for this page");
		$qodeSeo->addChild("qode_seo_description",$seo_description);

	}

	add_action('qode_meta_boxes_map', 'qode_map_seo_meta_fields');
}