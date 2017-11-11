<?php
namespace Bridge\Shortcodes\AdvancedCallToAction;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

/**
 * Class AdvancedCallToAction
 */
class AdvancedCallToAction implements ShortcodeInterface {
	/**
	 * @var string
	 */
	private $base;

	/**
	 * AdvancedCallToAction constructor.
	 */
	public function __construct() {
		$this->base = 'qode_advanced_call_to_action';

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
            'name'                      => esc_html__('Advanced Call To Action', 'qode'),
            'base'                      => $this->base,
            'category'                  => esc_html__('by QODE','qode'),
            'icon'                      => 'icon-wpb-advanced-call-to-action extended-custom-icon-qode',
            'params'                    => array_merge(
            	array(
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Call To Action Text','qode'),
					    'admin_label' 	=> true,
						'param_name'	=> 'cta_text',
					),
					array(
					    'type'        	=> 'colorpicker',
					    'heading'     	=> esc_html__('Color','qode'),
					    'param_name'  	=> 'color',
					    'group'       	=> esc_html__('Design Options','qode')
					),
					array(
					    'type'        	=> 'textfield',
					    'heading'     	=> esc_html__('Font Size (px)','qode'),
					    'param_name'  	=> 'font_size',
					    'group'       	=> esc_html__('Design Options','qode')
					),
					array(
					    'type'        	=> 'dropdown',
					    'heading'     	=> esc_html__('Font Weight','qode'),
					    'param_name'  	=> 'font_weight',
					    'value'       	=> array_flip(qode_get_font_weight_array(true)),
					    'group'       	=> esc_html__('Design Options','qode')
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Enable Gradient','qode'),
						'param_name'	=> 'enable_gradient',
						'value' => array(
							esc_html__('Yes', 'qode')	=> 'yes',
							esc_html__('No', 'qode')	=> 'no',
						),
						'group'	=> esc_html__('Advanced Options', 'qode')
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Enable Gradient Animation','qode'),
						'param_name'	=> 'enable_gradient_animation',
						'value' => array(
							esc_html__('Yes', 'qode')	=> 'yes',
							esc_html__('No', 'qode')	=> 'no',
						),
						'group'	=> esc_html__('Advanced Options', 'qode'),
						'dependency'	=> array('element' => 'enable_gradient', 'value' => 'yes')
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Call To Action Link','qode'),
						'param_name'	=> 'cta_link',
					    'admin_label' 	=> true,
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Enable Anchor Link Functionality','qode'),
						'param_name'	=> 'cta_link_anchor',
						'value' => array(
							esc_html__('No', 'qode')	=> 'no',
							esc_html__('Yes', 'qode')	=> 'yes',
						),
						'dependency'	=> array('element' => 'cta_link', 'not_empty' => true)
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Link Target','qode'),
						'param_name'	=> 'cta_link_target',
						'value' => array(
							esc_html__('Self', 'qode')	=> '_self',
							esc_html__('Blank', 'qode')	=> '_blank',
						),
						'dependency'	=> array('element' => 'cta_link', 'not_empty' => true)
					),
				),
              	qode_icon_collections()->getVCParamsArray(array(), '', true),
               	array(
               		array(
               		    'type'        	=> 'colorpicker',
               		    'heading'     	=> esc_html__('Icon Color','qode'),
               		    'param_name'  	=> 'icon_color',
               		    'group'       	=> esc_html__('Design Options','qode'),
						'dependency' 	=> array('element' => 'icon_pack', 'not_empty' => true)
               		),
               		array(
               		    'type'        	=> 'textfield',
               		    'heading'     	=> esc_html__('Icon Font Size (px)','qode'),
               		    'param_name'  	=> 'icon_font_size',
               		    'group'       	=> esc_html__('Design Options','qode'),
						'dependency' 	=> array('element' => 'icon_pack', 'not_empty' => true)
               		),
               		array(
               		    'type'        	=> 'dropdown',
               		    'heading'     	=> esc_html__('Font Weight','qode'),
               		    'param_name'  	=> 'icon_font_weight',
               		    'value'       	=> array_flip(qode_get_font_weight_array(true)),
               		    'group'       	=> esc_html__('Design Options','qode'),
						'dependency' 	=> array('element' => 'icon_pack', 'not_empty' => true)
               		),
	           		array(
	           		    'type'        	=> 'textfield',
	           		    'heading'     	=> esc_html__('Icon Left Margin (px)','qode'),
	           		    'param_name'  	=> 'icon_left_margin',
	           		    'group'       	=> esc_html__('Design Options','qode'),
						'dependency' 	=> array('element' => 'icon_pack', 'not_empty' => true)
	           		),
               		array(
               			'type'			=> 'dropdown',
               			'heading'		=> esc_html__('Icon Border Shape','qode'),
               			'param_name'	=> 'icon_border_shape',
               			'value' => array(
               				esc_html__('None', 'qode')		=> '',
               				esc_html__('Circle', 'qode')	=> 'circle',
               			),
               		    'group'       => esc_html__('Design Options','qode'),
               			'dependency'	=> array('element' => 'icon_pack', 'not_empty' => true)
               		),
               		array(
               		    'type'        	=> 'textfield',
               		    'heading'     	=> esc_html__('Icon Border Shape Size (px)','qode'),
               		    'param_name'  	=> 'icon_border_shape_size',
               			'value'		  	=> '45px',
               		    'group'       	=> esc_html__('Design Options','qode'),
						'dependency' 	=> array('element' => 'icon_border_shape', 'value' => array('circle'))
               		),
               		array(
               		    'type'        	=> 'textfield',
               		    'heading'     	=> esc_html__('Icon Horizontal Offset Adjust (px)','qode'),
               		    'param_name'  	=> 'icon_horizontal_offset_adj',
               		    'group'       	=> esc_html__('Design Options','qode'),
						'description' 	=> esc_html__('Adjust icon alignment within border shape','qode'),
						'dependency' 	=> array('element' => 'icon_border_shape', 'value' => array('circle'))
               		),
               		array(
               		    'type'        	=> 'textfield',
               		    'heading'     	=> esc_html__('Icon Vertical Offset Adjust (px)','qode'),
               		    'param_name'  	=> 'icon_vertical_offset_adj',
               		    'group'       	=> esc_html__('Design Options','qode'),
						'description' 	=> esc_html__('Adjust icon alignment within border shape','qode'),
						'dependency' 	=> array('element' => 'icon_border_shape', 'value' => array('circle'))
               		),
               		array(
               			'type'			=> 'textfield',
               			'heading'		=> esc_html__('Shortcode Height (px)','qode'),
               			'value'			=> '110px',
               		    'group'       	=> esc_html__('Design Options','qode'),
               			'param_name'	=> 'height',
               		),
               	)	            	            
			) //close array merge
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
            'cta_text'						=> '',
            'cta_link'						=> '',
            'cta_link_anchor'				=> 'no',
            'cta_link_target'				=> '_self',
            'color'							=> '',
            'font_size'						=> '',
            'font_weight'					=> '',
            'icon_color'					=> '',
            'icon_font_size'				=> '',
            'icon_font_weight'				=> '',
            'icon_left_margin'				=> '',
            'icon_border_shape'				=> '',
            'icon_border_shape_size'		=> '45px',
            'icon_horizontal_offset_adj'  	=> '',
            'icon_vertical_offset_adj'  	=> '',
            'height'						=> '110px',
            'enable_gradient'				=> 'yes',
            'enable_gradient_animation'		=> 'yes'
        );

		$args	= array_merge($args, qode_icon_collections()->getShortcodeParams());
        $params	= shortcode_atts($args, $atts);

        $iconPackName   = qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
        $params['icon'] = $iconPackName ? $params[$iconPackName] : '';

		$params['shortcode_classes']= $this->getShortcodeClasses($params);
		$params['shortcode_styles']= $this->getShortcodeStyles($params);
		$params['link_classes']= $this->getLinkClasses($params);
		$params['text_styles']= $this->getTextStyles($params);
		$params['icon_styles']= $this->getIconStyles($params);
		$params['icon_offsets']= $this->getIconOffsets($params);

		return qode_get_shortcode_template_part('templates/advanced-call-to-action-template', 'advanced-call-to-action', '', $params);
	}

	private function getShortcodeClasses($params) {
		$classes = array('qode-advanced-call-to-action');

		if($params['enable_gradient'] == 'yes') {
			$classes[] = 'qode-advanced-cta-gradient';
		}

		if($params['enable_gradient_animation'] == 'yes') {
			$classes[] = 'qode-advanced-cta-gradient-animation';
		}

		if(!empty($params['icon_border_shape']) == 'circle') {
			$classes[] = 'qode-advanced-cta-icon-'.$params['icon_border_shape'];
		} 

		return implode(' ', $classes);
	}

	private function getLinkClasses($params) {
		$classes = array('advanced-cta-link');

		if($params['cta_link_anchor'] == 'yes') {
			$classes[] = 'anchor';
		}

		return implode(' ', $classes);
	}

	private function getShortcodeStyles($params) {
		$styles = array();

		if($params['height']) {
			$styles[] = 'height:'. $params['height'].'px';
		}

		return implode(';', $styles);
	}

	private function getTextStyles($params) {
		$styles = array();

		if ($params['color']) {
			$styles[] = 'color:'. $params['color'];
		}

		if ($params['font_size']) {
			$styles[] = 'font-size:'. qode_filter_px($params['font_size']).'px';
		}

		if ($params['font_weight']) {
			$styles[] = 'font-weight:'. $params['font_weight'];
		}

		return implode(';', $styles);
	}

	private function getIconStyles($params) {
		$styles = array();

		if ($params['icon_color']) {
			$styles[] = 'color:'. $params['icon_color'];
		}

		if ($params['icon_font_size']) {
			$styles[] = 'font-size:'. qode_filter_px($params['icon_font_size']).'px';
		}

		if ($params['icon_font_weight']) {
			$styles[] = 'font-weight:'. $params['icon_font_weight'];
		}

		if ($params['icon_left_margin']) {
			$styles[] = 'margin-left:'. qode_filter_px($params['icon_left_margin']).'px';
		}
		
		if ($params['icon_border_shape_size']) {
			$styles[] = 'height:'. qode_filter_px($params['icon_border_shape_size']).'px';
			$styles[] = 'width:'. qode_filter_px($params['icon_border_shape_size']).'px';
		}


		return implode(';', $styles);
	}

	private function getIconOffsets($params) {
		$styles = array();

		if ($params['icon_horizontal_offset_adj']) {
			$styles[] = 'left:'. qode_filter_px($params['icon_horizontal_offset_adj']).'px';
		}

		if ($params['icon_vertical_offset_adj']) {
			$styles[] = 'top:'. qode_filter_px($params['icon_vertical_offset_adj']).'px';
		}
		return implode(';', $styles);
	}

}