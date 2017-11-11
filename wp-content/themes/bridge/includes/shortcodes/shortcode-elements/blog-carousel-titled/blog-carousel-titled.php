<?php

namespace Bridge\Shortcodes\BlogCarouselTitled;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class CardsGallery
 */
class BlogCarouselTitled implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 * CardsGallery constructor.
	 */
	public function __construct() {
		$this->base = 'qode_blog_carousel_titled';

		add_action('qode_vc_map', array($this, 'vcMap'));
	}

	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 *
	 */
	public function vcMap() {
		vc_map(array(
			'name'                      => esc_html__('Blog Carousel - Titled', 'qode'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by QODE', 'qode'),
			'icon'                      => 'icon-wpb-blog-carousel-titled extended-custom-icon-qode',
			'params'					=> array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__('Title', 'qode'),
					'param_name'  => 'title',
					'admin_label' => true
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Title Tag', 'qode'),
					'param_name' => 'title_tag',
					'value' => array(
						''   => '',
						'h2' => 'h2',
						'h3' => 'h3',
						'h4' => 'h4',
						'h5' => 'h5',
						'h6' => 'h6',
					),
					'dependency' => array('element' => 'title', 'not_empty'=>true)
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Posts Title Tag', 'qode'),
					'param_name' => 'posts_title_tag',
					'value' => array(
						''   => '',
						'h2' => 'h2',
						'h3' => 'h3',
						'h4' => 'h4',
						'h5' => 'h5',
						'h6' => 'h6',
					)
				),
				array(
					'type' => 'dropdown',
					'heading' => 'Image size',
					'param_name' => 'image_size',
					'value' => array(
						'Default'		=> '',
						'Original Size'	=> 'full',
						'Landscape'		=> 'landscape',
						'Portrait'		=> 'portrait'
					)
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> 'Excerpt Length',
					'param_name'	=> 'excerpt_length',
				),
				array(
					'type' => 'dropdown',
					'heading' => esc_html__('Number of Blog Posts Shown', 'qode'),
					'param_name' => 'posts_shown',
					'value' => array(
						'Default' => '',
						'3' => '3',
						'4' => '4',
						'5' => '5'
					),
					'save_always' => true,
					'description' => esc_html__('Number of blog posts that are showing at the same time (on smaller screens is responsive so there will be less items shown)', 'qode')
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Number', 'qode'),
					'param_name'	=> 'number',
					'description'	=> esc_html__('Number of blog posts on page (Leave empty for all)', 'qode'),
					'group'			=> esc_html__('Build Query ', 'qode')
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__('Order By', 'qode'),
					'param_name'	=> 'order_by',
					'value'			=> array(
						esc_html__('Date', 'qode')	=> 'date',
						esc_html__('Title', 'qode')	=> 'title'

					),
					'group'			=> esc_html__('Build Query ', 'qode')
				),
				array(
					'type'			=> 'dropdown',
					'heading'		=> esc_html__('Order', 'qode'),
					'param_name'	=> 'order',
					'value'			=> array(
						esc_html__('DESC', 'qode')	=> 'DESC',
						esc_html__('ASC', 'qode')	=> 'ASC'
					),
					'group'			=> esc_html__('Build Query ', 'qode')
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Category', 'qode'),
					'param_name'	=> 'category',
					'description'	=> esc_html__('Category Slug (leave empty for all)', 'qode'),
					'group'			=> esc_html__('Build Query ', 'qode')
				),
				array(
					'type'			=> 'textfield',
					'heading'		=> esc_html__('Selected Posts', 'qode'),
					'param_name'	=> 'selected_projects',
					'description'	=> esc_html__('Selected Posts (leave empty for all, delimit by comma)', 'qode'),
					'group'			=> esc_html__('Build Query ', 'qode')
				),
				array(
					'type'			=> 'colorpicker',
					'heading'		=> esc_html__('Title Background Color', 'qode'),
					'param_name'	=> 'title_background_color',
					'group'			=> esc_html__('Style', 'qode')
				),
				array(
					'type'			=> 'colorpicker',
					'heading'		=> esc_html__('Title Color', 'qode'),
					'param_name'	=> 'title_color',
					'group'			=> esc_html__('Style', 'qode')
				)
			)

		));
	}

	/**
	 * @param array $atts
	 * @param null $content
	 *
	 * @return string
	 */
	public function render($atts, $content = null) {
        $args = array(
            'title'						=> '',
            'title_tag'					=> 'h3',
            'posts_title_tag'			=> 'h3',
            'image_size'				=> 'full',
            'excerpt_length'			=> '',
            'posts_shown'				=> '',
            'number'					=> '-1',
            'order'						=> 'DESC',
            'order_by'					=> 'date',
            'category'					=> '',
            'selected_projects'			=> '',
            'title_background_color'	=> '',
            'title_color'				=> ''
        );

        $params	= shortcode_atts($args, $atts);

		$query_args = $this->createQueryArgs($params);
		$blog_query = new \WP_Query($query_args);
		$params['blog_query'] = $blog_query;
		$params['holder_data'] = $this->getHolderData($params);
		$params['thumb_size'] = $this->getImageSize($params);
		$params['title_style'] = $this->getTitleStyle($params);

		return qode_get_shortcode_template_part('templates/blog-carousel-titled-template', 'blog-carousel-titled', '', $params);
	}

	private function createQueryArgs($params) {

		$args = array(
			'post_type'			=> 'post',
			'orderby'			=> $params['order_by'],
			'order'				=> $params['order'],
			'posts_per_page'	=> $params['number']
		);

		if($params['category'] !== '') {
			$args['category_name'] = $params['category'];
		}

		if($params['selected_projects'] !== '') {
			$args['post__in'] = explode(",", $params['selected_projects']);
		}

		return $args;
	}

	private function getHolderData($params) {

		$data = array();

		if($params['posts_shown'] != '') {
			$data['data-posts-shown'] = $params['posts_shown'];
		}


		return $data;
	}

	private function getImageSize($params) {

		switch ($params['image_size']) {
			case 'landscape':
				$thumb_size = 'portfolio-landscape';
				break;
			case 'portrait':
				$thumb_size = 'portfolio-portrait';
				break;
			default:
				$thumb_size = 'full';
				break;
		}

		return $thumb_size;
	}

	private function getTitleStyle($params) {

		$style = array();

		if($params['title_background_color'] != '') {
			$style[] = 'background-color:'.$params['title_background_color'];
		}

		if($params['title_color'] != '') {
			$style[] = 'color:'.$params['title_color'];
		}


		return implode(';',$style);
	}

}