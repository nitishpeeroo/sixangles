<?php
namespace Bridge\Shortcodes\ButtonV2;

use Bridge\Shortcodes\Lib\ShortcodeInterface;


/**
 * Class Button that represents button shortcode
 * @package Bridge\Shortcodes\Lib\ShortcodeInterface
 */
class ButtonV2 implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    /**
     * Sets base attribute and registers shortcode with Visual Composer
     */
    public function __construct() {
        $this->base = 'qode_button_v2';

        add_action('qode_vc_map', array($this, 'vcMap'));
    }

    /**
     * Returns base attribute
     * @return string
     */
    public function getBase() {
        return $this->base;
    }

    /**
     * Maps shortcode to Visual Composer
     */
    public function vcMap() {
        vc_map(array(
            'name'                      => esc_html__('Qode Button V2', 'qode'),
            'base'                      => $this->base,
            'category'                  => esc_html__('by QODE','qode'),
            'icon'                      => 'icon-wpb-button-v2 extended-custom-icon-qode',
            'allowed_container_element' => 'vc_row',
            'params'                    => array_merge(
                array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Text','qode'),
                        'param_name'  => 'text',
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Link','qode'),
                        'param_name'  => 'link',
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Link Target','qode'),
                        'param_name'  => 'target',
                        'value'       => array(
                            esc_html__('Self','qode')  => '_self',
                            esc_html__('Blank','qode') => '_blank'
                        ),
                        'save_always' => true,
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Custom CSS class','qode'),
                        'param_name'  => 'custom_class',
                        'admin_label' => true
                    )
                ),
               qode_icon_collections()->getVCParamsArray(array(), '', true),
                array(
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Color','qode'),
                        'param_name'  => 'color',
                        'group'       => esc_html__('Design Options','qode'),
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Hover Color','qode'),
                        'param_name'  => 'hover_color',
                        'group'       => esc_html__('Design Options','qode'),
                        'admin_label' => true
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Background Color','qode'),
                        'param_name'  => 'background_color',
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options','qode')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Hover Background Color','qode'),
                        'param_name'  => 'hover_background_color',
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options','qode')
                    ),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Icon Left Border Color','qode'),
						'param_name'  => 'icon_border_color',
						'admin_label' => true,
						'dependency' => array('element' => 'icon_pack', 'not_empty' => true),
                        'group'       => esc_html__('Design Options','qode')
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Hover Icon Left Border Color','qode'),
						'param_name'  => 'icon_border_hover_color',
						'admin_label' => true,
						'dependency' => array('element' => 'icon_pack', 'not_empty' => true),
                        'group'       => esc_html__('Design Options','qode')
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Icon Background Color','qode'),
						'param_name'  => 'icon_background_color',
						'group'       => esc_html__('Design Options','qode'),
						'dependency' => array('element' => 'icon_pack', 'not_empty' => true),
					),
					array(
						'type'        => 'colorpicker',
						'heading'     => esc_html__('Icon Background Hover Color','qode'),
						'param_name'  => 'icon_background_hover_color',
						'group'       => esc_html__('Design Options','qode'),
						'dependency' => array('element' => 'icon_pack', 'not_empty' => true),
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Enable Shadow','qode'),
						'param_name'  => 'enable_shadow',
						'value'       => array(
							esc_html__('No','qode')  	=> 'no',
							esc_html__('Yes','qode') 	=> 'yes'
						),
                        'group'       => esc_html__('Design Options','qode')
					),
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Enable Icon Gradient','qode'),
						'param_name'  => 'enable_icon_gradient',
						'value'       => array(
							esc_html__('No','qode')  	=> 'no',
							esc_html__('Yes','qode') 	=> 'yes'
						),
                        'group'       => esc_html__('Design Options','qode'),
						'dependency' => array('element' => 'icon_pack', 'not_empty' => true)
					),					
					array(
						'type'        => 'dropdown',
						'heading'     => esc_html__('Enable Icon Square','qode'),
						'param_name'  => 'enable_icon_square',
						'value'       => array(
							esc_html__('No','qode')  	=> 'no',
							esc_html__('Yes','qode') 	=> 'yes'
						),
                        'group'       => esc_html__('Design Options','qode'),
						'dependency' => array('element' => 'icon_pack', 'not_empty' => true)
					),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Font Size (px)','qode'),
                        'param_name'  => 'font_size',
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options','qode')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Font Weight','qode'),
                        'param_name'  => 'font_weight',
                        'value'       => array_flip(qode_get_font_weight_array(true)),
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options','qode')
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Icon Font Size (px)','qode'),
                        'param_name'  => 'icon_font_size',
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options','qode')
                    ),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Margin','qode'),
                        'param_name'  => 'margin',
                        'description' => esc_html__('Insert margin in format: 0px 0px 1px 0px', 'qode'),
                        'admin_label' => true,
                        'group'       => esc_html__('Design Options','qode')
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Hover Effect','qode'),
                        'param_name'  => 'hover_effect',
                        'value'       => array(
                            esc_html__('Default','qode')    => '',
                            esc_html__('3D Rotate','qode')   => '3d_rotate',
                            esc_html__('Shadow Enhance','qode')   => 'shadow_enhance',
                            esc_html__('Icon Rotate','qode') => 'icon_rotate'
                        ),
                        'save_always' => true,
                        'group'       => esc_html__('Advanced Options','qode'),
                        'description' => esc_html__('Icon Rotate Hover should only be used when icon set','qode')
                    ),
                )
            ) //close array_merge
        ));
    }

    /**
     * Renders HTML for button shortcode
     *
     * @param array $atts
     * @param null $content
     *
     * @return string
     */
    public function render($atts, $content = null) {
        $default_atts = array(
            'size'                   => '',
            'type'                   => '',
            'text'                   => '',
            'link'                   => '',
            'target'                 => '',
            'color'                  => '',
            'hover_color'            => '',
            'background_color'       => '',
            'hover_background_color' => '',
            'border_color'           => '',
            'hover_border_color'     => '',
            'icon_border_color' 	 => '',
            'icon_border_hover_color'=> '',
            'icon_background_color'  => '',
            'icon_background_hover_color' => '',
            'enable_shadow'          => '',
            'font_size'              => '',
            'font_weight'            => '',
            'icon_font_size'         => '',
            'margin'                 => '',
            'custom_class'           => '',
            'html_type'              => 'anchor',
            'input_name'             => '',
            'hover_animation'        => '',
            'enable_icon_gradient'   => '',
            'hover_effect'           => '',
            'enable_icon_square'	 => 'no',
            'custom_attrs'           => array()
        );

        $default_atts = array_merge($default_atts, qode_icon_collections()->getShortcodeParams());
        $params       = shortcode_atts($default_atts, $atts);

        if($params['html_type'] !== 'input') {
            $iconPackName   = qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
            $params['icon'] = $iconPackName ? $params[$iconPackName] : '';
        }

        $params['size'] = !empty($params['size']) ? $params['size'] : 'medium';
        $params['type'] = !empty($params['type']) ? $params['type'] : 'solid';


        $params['link']   = !empty($params['link']) ? $params['link'] : '#';
        $params['target'] = !empty($params['target']) ? $params['target'] : '_self';

        //prepare params for template
        $params['button_classes']				= $this->getButtonClasses($params);
        $params['button_icon_holder_classes']	= $this->getButtonIconHolderClasses($params);
        $params['button_custom_attrs']			= !empty($params['custom_attrs']) ? $params['custom_attrs'] : array();
        $params['button_styles']				= $this->getButtonStyles($params);
        $params['button_icon_holder_styles']	= $this->getButtonIconHolderStyles($params);
        $params['button_data']					= $this->getButtonDataAttr($params);
        $params['button_icon_holder_data']		= $this->getButtonIconHolderDataAttr($params);

        return qode_get_shortcode_template_part('templates/'.$params['html_type'], 'button-v2', $params['hover_animation'], $params);
    }

    /**
     * Returns array of button styles
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonStyles($params) {
        $styles = array();

        if(!empty($params['color'])) {
            $styles[] = 'color: '.$params['color'];
        }

        if(!empty($params['background_color']) && $params['type'] !== 'outline') {
            $styles[] = 'background-color: '.$params['background_color'];
        }

        if(!empty($params['border_color'])) {
            $styles[] = 'border-color: '.$params['border_color'];
        }

        if(!empty($params['font_size'])) {
            $styles[] = 'font-size: '.qode_filter_px($params['font_size']).'px';
        }

        if(!empty($params['font_weight'])) {
            $styles[] = 'font-weight: '.$params['font_weight'];
        }

        if(!empty($params['margin'])) {
            $styles[] = 'margin: '.$params['margin'];
        }

        return $styles;
    }

	/**
	 * Returns array of button icon holder styles
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getButtonIconHolderStyles($params) {
		$styles = array();

		if (!empty($params['icon_font_size'])) {
			$styles[] = 'font-size: '.qode_filter_px($params['icon_font_size']).'px';
		}

		if(!empty($params['icon_border_color'])) {
			$styles[] = 'border-color: '.$params['icon_border_color'];
		}

		if(!empty($params['icon_background_color'])) {
			$styles[] = 'background-color: '.$params['icon_background_color'];
		}

		return $styles;
	}

    /**
     *
     * Returns array of button data attr
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonDataAttr($params) {
        $data = array();

        if(!empty($params['hover_background_color'])) {
            $data['data-hover-bg-color'] = $params['hover_background_color'];
        }

        if(!empty($params['hover_color'])) {
            $data['data-hover-color'] = $params['hover_color'];
        }

        if(!empty($params['hover_border_color'])) {
            $data['data-hover-border-color'] = $params['hover_border_color'];
        }

        return $data;
    }

	/**
	 *
	 * Returns array of button icon holder data attr
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getButtonIconHolderDataAttr($params) {
		$data = array();

		if(!empty($params['icon_border_hover_color'])) {
			$data['data-hover-icon-border-color'] = $params['icon_border_hover_color'];
		}

        if(!empty($params['icon_background_hover_color'])) {
            $data['data-hover-icon-bg-color'] = $params['icon_background_hover_color'];
        }

		return $data;
	}

    /**
     * Returns array of HTML classes for button
     *
     * @param $params
     *
     * @return array
     */
    private function getButtonClasses($params) {
        $buttonClasses = array(
            'qode-btn',
            'qode-btn-'.$params['size'],
            'qode-btn-'.$params['type']
        );

        if(!empty($params['hover_background_color'])) {
            $buttonClasses[] = 'qode-btn-custom-hover-bg';
        }

        if(!empty($params['hover_border_color'])) {
            $buttonClasses[] = 'qode-btn-custom-border-hover';
        }

        if(!empty($params['hover_color'])) {
            $buttonClasses[] = 'qode-btn-custom-hover-color';
        }        

        if(!empty($params['icon_background_hover_color'])) {
            $buttonClasses[] = 'qode-btn-custom-icon-bg-hover-color';
        }

        if(!empty($params['icon'])) {
            $buttonClasses[] = 'qode-btn-icon';
        }

        if(!empty($params['custom_class'])) {
            $buttonClasses[] = $params['custom_class'];
        }

        if(!empty($params['hover_animation'])) {
            $buttonClasses[] = 'qode-btn-'.$params['hover_animation'];
        }

		if($params['enable_shadow'] === 'yes') {
            $buttonClasses[] = 'qode-btn-with-shadow';
        }

        if ($params['enable_icon_square'] == 'yes'){
        	$buttonClasses[] = 'qodef-btn-icon-square';
        }

        if($params['hover_effect'] === '') {
            $buttonClasses[] = 'qode-btn-default-hover';
        } else {
            if ($params['hover_effect'] === '3d_rotate') {
                $buttonClasses[] = 'qode-btn-3d-hover';
            }
            if ($params['hover_effect'] === 'shadow_enhance') {
                $buttonClasses[] = 'qode-btn-shadow-hover';
            }
            if ($params['hover_effect'] === 'icon_rotate') {
                $buttonClasses[] = 'qode-btn-icon-rotate';
            }
        }

        return implode(' ', $buttonClasses);
    }

	/**
	 * Returns array of HTML classes for button icon holder
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getButtonIconHolderClasses($params) {
		$buttonClasses = array(
			'qode-button-v2-icon-holder'
		);

		if( $params['enable_icon_gradient'] === 'yes') {
			$buttonClasses[] = 'qode-type1-gradient-bottom-to-top-text';
		}

		return implode(' ', $buttonClasses);
	}
}