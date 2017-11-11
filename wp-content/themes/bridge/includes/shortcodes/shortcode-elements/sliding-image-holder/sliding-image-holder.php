<?php

namespace Bridge\Shortcodes\SlidingImageHolder;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class SlidingImageHolder
 */
class SlidingImageHolder implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 * CardsSlider constructor.
	 */
	public function __construct() {

        $this->base = 'qode_sliding_image_holder';

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
			'name'					=> esc_html__('Sliding Image Holder','qode'),
			'base' 					=> $this->base,
			'content_element'       => true,
			'category'              => esc_html__('by QODE','qode'),
			'icon'                  => 'icon-wpb-sliding-image-holder extended-custom-icon-qode',
			'js_view'				=> 'VcColumnView',
			'as_parent'				=> array('except' => ''),
			'params' => array(
				array(
					'type'			=> 'attach_image',
					'heading'		=> esc_html__('Image','qode'),
					'admin_label'	=> true,
					'param_name'	=> 'image',
					'description'	=> esc_html__('Recommended width of image is 1920px','qode')
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
		$default_attrs = array(
			'image' => ''
        );
		$params        = shortcode_atts($default_attrs, $atts);

		extract($params);

		$params['content'] = $content;

		return qode_get_shortcode_template_part('templates/sliding-image-holder-template', 'sliding-image-holder', '', $params);
	}
}