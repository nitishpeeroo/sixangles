<?php
namespace Bridge\Shortcodes\EllipticalSlide;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class EllipticalSlide implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'qode_elliptical_slide';
		add_action('qode_vc_map', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => esc_html__('Elliptical Slide','qode'),
                'base' => $this->base,
                'as_child' => array('only' => 'qode_elliptical_slider'),
				'as_parent' => array('except' => 'vc_tabs, vc_accordion, cover_boxes, portfolio_list, portfolio_slider, qode_carousel'), // Use only|except attributes to limit child shortcodes (separate multiple values with comma)
				'category' => esc_html__('by QODE','qode'),
                'icon' => 'extended-custom-icon-qode icon-wpb-elliptical-slide',
				'js_view' => 'VcColumnView',
				'content_element'	=> true,
                'params' => array(
					array(
						'type'       => 'attach_image',
						'heading'    => 'Image',
						'param_name' => 'image'
					),
					array(
						'type'       => 'colorpicker',
						'heading'    => 'Elliptical Section Background Color',
						'param_name' => 'elliptical_section_background_color'
					)
				)
        ));
    }

    public function render($atts, $content = null) {

        $args = array(
            'image' => '',
            'elliptical_section_background_color' => ''
        );

        $params = shortcode_atts($args, $atts);

        $params['image'] = $this->getImageSrc($params);
        $params['content'] = $content;
        $params['svg_style'] = $this->getSvgStyle($params);
        $params['background_style'] = $this->getBackgroundStyle($params);
        $params['background_image'] = $this->getBackgroundImage($params);
        $params['image_holder_background'] = $this->getImageHolderBackground($params);

        $html = qode_get_shortcode_template_part('templates/elliptical-slide-template', 'elliptical-slider', '', $params);

        return $html;
    }



    private function getImageSrc($params) {


        if (is_numeric($params['image'])) {
            $image_src = wp_get_attachment_url($params['image']);
        } else {
            $image_src = $params['image'];
        }

        return $image_src;

    }
	private function getSvgStyle($params) {

		$style = array();

		if (!empty($params['elliptical_section_background_color'])) {
			$style[] = 'fill:'.$params['elliptical_section_background_color'];
		}

		return implode(';', $style);

	}
	private function getBackgroundStyle($params) {

		$style = array();

		if (!empty($params['elliptical_section_background_color'])) {
			$style[] = 'background: -webkit-linear-gradient(left, '. $params['elliptical_section_background_color'].' 50%, transparent 50%)';
			$style[] = 'background: linear-gradient(90deg, '. $params['elliptical_section_background_color'].' 50%, transparent 50%);';
		}

		return implode(';', $style);

	}
	private function getImageHolderBackground($params) {

		$style = array();

		if (!empty($params['elliptical_section_background_color'])) {
			$style[] = 'background-color:'.$params['elliptical_section_background_color'];
		}

		return implode(';', $style);

	}
	private function getBackgroundImage($params) {

		$style = array();

		if (!empty($params['image'])) {
			$style[] = 'background-image:url(' .$this->getImageSrc($params).')';
		}

		return implode(';', $style);

	}
}