<?php

namespace Bridge\Shortcodes\InfoCardWithIcon;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class CardsGallery
 */
class InfoCardWithIcon implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 * CardsGallery constructor.
	 */
	public function __construct() {
		$this->base = 'qode_info_card_with_icon';

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
			'name'                      => esc_html__('Info Card With Icon', 'qode'),
			'base'                      => $this->base,
			'category'                  => esc_html__('by QODE', 'qode'),
			'icon'                      => 'icon-wpb-info-card-with-icon extended-custom-icon-qode',
			'params'                    => array_merge(
				array(
					array(
						'type'        => 'attach_image',
						'heading'     => esc_html__('Image', 'qode'),
						'param_name'  => 'image'
					)),
				qode_icon_collections()->getVCParamsArray(array(), '', true),
				array(
					array(
						'type'        => 'dropdown',
						'heading'     => 'Icon Size',
						'admin_label' => true,
						'save_always' => true,
						'param_name'  => 'icon_size',
						'group' 	 => esc_html__('Icon Style', 'qode'),
						'value'       => array(
							'Tiny'       => 'qode-icon-tiny',
							'Small'      => 'qode-icon-small',
							'Medium'     => 'qode-icon-medium',
							'Large'      => 'qode-icon-large',
							'Very Large' => 'qode-icon-huge'
						),
						'dependency' => array('element' => 'icon_pack', 'not_empty'=>true)
					),
					array(
						'type'        => 'textfield',
						'admin_label' => true,
						'heading'     => 'Icon Custom Size (px)',
						'param_name'  => 'custom_icon_size',
						'value'       => '',
						'group'		  => esc_html__('Icon Style', 'qode'),
						'dependency' => array('element' => 'icon_pack', 'not_empty'=>true)
					),

					array(
						'type'        => 'textfield',
						'heading'     => 'Icon Shape Size (px)',
						'param_name'  => 'icon_shape_size',
						'value'       => '',
						'group'		  => esc_html__('Icon Style', 'qode'),
						'dependency' => array('element' => 'icon_pack', 'not_empty'=>true)
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => 'Icon Color',
						'param_name'  => 'icon_color',
						'admin_label' => true,
						'group'		  => esc_html__('Icon Style', 'qode')
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => 'Icon Background Color',
						'param_name'  => 'icon_background_color',
						'group'		  => esc_html__('Icon Style', 'qode')
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => 'Hover Icon Color',
						'param_name'  => 'hover_icon_color',
						'group'		  => esc_html__('Icon Style', 'qode')
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => 'Hover Icon Background Color',
						'param_name'  => 'hover_icon_background_color',
						'group'		  => esc_html__('Icon Style', 'qode')
					),
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
						'type'        => 'textarea',
						'heading'     => esc_html__('Text', 'qode'),
						'param_name'  => 'text'
					),
					array(
						'type'        => 'textfield',
						'heading'     => esc_html__('Link', 'qode'),
						'param_name'  => 'link',
						'admin_label' => true
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Target', 'qode'),
						'param_name'  => 'target',
						'value' => array(
							esc_html__('Self', 'qode')	=> '_self',
							esc_html__('Blank', 'qode')	=> '_blank',
						),
					)
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
            'icon_size'				=> 'qode-icon-medium',
            'custom_icon_size'		=> '',
            'icon_shape_size'		=> '',
            'icon_color'		=> '',
            'icon_background_color'		=> '',
            'hover_icon_color'		=> '',
            'hover_icon_background_color'		=> '',
            'image'					=> '',
            'title'					=> '',
            'title_tag'				=> 'h3',
            'text'					=> '',
            'link'					=> '',
            'target'				=> ''
        );

		$args	= array_merge($args, qode_icon_collections()->getShortcodeParams());
        $params	= shortcode_atts($args, $atts);

		$iconPackName   = qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$params['icon'] = $params[$iconPackName];

		$params['holder_classes'] = $this->getIconHolderClasses($params);
		$params['icon_holder_style'] = $this->getIconHolderStyle($params);
		$params['icon_holder_data'] = $this->getIconHolderData($params);
		$params['icon_style'] = $this->getIconStyle($params);

		return qode_get_shortcode_template_part('templates/info-card-with-icon-template', 'info-card-with-icon', '', $params);
	}

	private function getIconHolderClasses($params) {
		$classes = array('qode-icon-holder', 'qode-icon-circle');

		if($params['custom_icon_size'] == '') {
			$classes[] = $params['icon_size'];
		}

		return implode(' ', $classes);
	}

	private function getIconHolderStyle($params) {
		$style = array();

		if($params['custom_icon_size']) {
			$style[] = 'font-size:' . $params['custom_icon_size'] . 'px';
		}
		if($params['icon_background_color']) {
			$style[] = 'background-color:' . $params['icon_background_color'];
		}
		if(!empty($params['icon_shape_size'])) {
			$style[] = 'width: '.qode_filter_px($params['icon_shape_size']).'px';
			$style[] = 'height: '.qode_filter_px($params['icon_shape_size']).'px';
			$style[] = 'line-height: '.qode_filter_px($params['icon_shape_size']).'px';
		}
		return $style;
	}
	private function getIconStyle($params) {
		$style = array();


		if($params['icon_color']) {
			$style[] = 'color:' . $params['icon_color'];
		}

		return implode(';', $style);
	}
	private function getIconHolderData($params) {
		$iconHolderData = array();


		if(!empty($params['hover_icon_background_color'])) {
			$iconHolderData['data-hover-background-color'] = $params['hover_icon_background_color'];
		}

		if(!empty($params['hover_icon_color'])) {
			$iconHolderData['data-hover-color'] = $params['hover_icon_color'];
		}

		if(!empty($params['icon_color'])) {
			$iconHolderData['data-color'] = $params['icon_color'];
		}

		return $iconHolderData;
	}
}