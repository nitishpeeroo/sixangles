<?php
if(!function_exists('qode_map_blog_meta_fields')) {

	function qode_map_blog_meta_fields() {

		$qode_blog_categories = array();
		$categories = get_categories();
		foreach($categories as $category) {
			$qode_blog_categories[$category->term_id] = $category->name;
		}

		$qodeBlog = qode_add_meta_box(
			array(
				'scope' => array('page'),
				'title' => esc_html__('Qode Blog', 'qode'),
				'name' => 'page_blog'
			)
		);

		$qode_choose_blog_category = new QodeMetaField("selectblank","qode_choose-blog-category","","Blog Category","Choose category of posts to display (leave empty to display all categories)",$qode_blog_categories);
		$qodeBlog->addChild("qode_choose-blog-category",$qode_choose_blog_category);

		$qode_show_posts_per_page = new QodeMetaField("text","qode_show-posts-per-page","","Number of Posts","Enter the number of posts to display", array(), array("col_width" => 3));
		$qodeBlog->addChild("qode_show-posts-per-page",$qode_show_posts_per_page);

		$qode_enable_page_comments = new QodeMetaField("yesempty","qode_enable-page-comments","","Show Comments","Enabling this option will show comments on your page ");
		$qodeBlog->addChild("qode_enable-page-comments",$qode_enable_page_comments);

	}

	add_action('qode_meta_boxes_map', 'qode_map_blog_meta_fields');
}