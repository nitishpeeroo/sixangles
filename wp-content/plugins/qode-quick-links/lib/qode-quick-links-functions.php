<?php

if ( ! function_exists( 'qode_quick_links_register_post_type' ) ) {
	/**
	 * Register Post Type quick links
	 * @return bool
	 */

	function qode_quick_links_register_post_type() {
		register_post_type( 'qode-quick-link',
			array(
				'labels' => array(
					'name'          => esc_html__( 'Qode Quick Links','qode-quick-links' ),
					'singular_name' => esc_html__( 'Qode Quick Link','qode-quick-links' ),
					'add_item'      => esc_html__( 'New Quick Link','qode-quick-links' ),
					'add_new_item'  => esc_html__( 'Add New Quick Link','qode-quick-links' ),
					'edit_item'     => esc_html__( 'Edit Quick Link','qode-quick-links' )
				),
				'public'        => false,
				'has_archive'   => false,
				'show_ui'       => true,
				'supports'      => array('author', 'title',  'page-attributes'),
				'menu_icon'     => 'dashicons-editor-unlink'
			)
		);
	}
}
if(!function_exists('qode_quick_links_meta_box_functions')) {
	function qode_quick_links_meta_box_functions($post_types) {
		$post_types[] = 'qode-quick-link';

		return $post_types;
	}

	add_filter('qode_meta_box_post_types_save', 'qode_quick_links_meta_box_functions');
	add_filter('qode_meta_box_post_types_remove', 'qode_quick_links_meta_box_functions');
}
if ( ! function_exists( 'qode_quick_links_html' ) ) {

	function qode_quick_links_html() {
		if(qode_quick_links_theme_installed()){
			$enable_quick_links = qode_options()->getOptionValue('enable_quick_links');
			if($enable_quick_links == 'yes' ) {
				echo qode_quick_links_get_template_part('templates/quick-links-holder');
			}
		} else {
			echo qode_quick_links_get_template_part('templates/quick-links-holder');
		}
	}

	add_action('wp_footer','qode_quick_links_html');
}

if ( ! function_exists( 'qode_quick_links_button_html' ) ) {

	function qode_quick_links_button_html() {

		$params = array();
		$query = qode_quick_links_query();
		$params['button_logo'] = plugins_url( QODE_QUICK_LINKS_REL_PATH . '/assets/img/button-logo.png');
		$params['count'] = $query->post_count;
		if(qode_quick_links_theme_installed()) {
			$quick_links_button_logo = qode_options()->getOptionValue('quick_links_button_logo');
			if( $quick_links_button_logo != '' ) {
				$params['button_logo'] = $quick_links_button_logo;
			}
		}
		echo qode_quick_links_get_template_part('templates/quick-links-button', '', $params);
	}
}

if ( ! function_exists( 'qode_quick_links_popup_html' ) ) {

	function qode_quick_links_popup_html() {

		$ql_query = qode_quick_links_query();

		$params = array(
			'ql_query' => $ql_query
		);
		$params['title'] = esc_html__('Quick Links', 'qode-quick-links');

		if(qode_quick_links_theme_installed()) {

			$title_image = qode_options()->getOptionValue('quick_links_title_image');
			if( $title_image != '' ) {
				$params['title_image'] = $title_image;
			}

			$title = qode_options()->getOptionValue('quick_links_title');
			if( $title != '' ) {
				$params['title'] = $title;
			}
		}

		echo qode_quick_links_get_template_part('templates/quick-links-pop-up', '', $params);
	}
}

if ( ! function_exists( 'qode_quick_links_query' ) ) {

	function qode_quick_links_query() {

		$query_args = array(
			'post_type'			=> 'qode-quick-link',
			'posts_per_page'	=> -1
		);
		if(qode_quick_links_theme_installed()) {
			$quick_links_items_number = qode_options()->getOptionValue('quick_links_items_number');
			if ($quick_links_items_number != '') {
				$query_args['posts_per_page'] = $quick_links_items_number;
			}
		}
		$ql_query = new WP_Query($query_args);

		return $ql_query;
	}
}