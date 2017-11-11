<?php
namespace Bridge\Shortcodes\PricingCalculator;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class PricingCalculator implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'qode_pricing_calculator';
		add_action('qode_vc_map', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name'		=> esc_html__('Pricing Calculator','qode'),
                'base'		=> $this->base,
                'icon'		=> 'icon-wpb-pricing-calculator extended-custom-icon-qode',
                'category'	=> esc_html__('by QODE','qode'),
                'params'	=> array(
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Title','qode'),
						'param_name'	=> 'subtitle'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Subtitle Title Tag', 'qode'),
						'param_name' => 'subtitle_title_tag',
						'value' => array(
							''   => '',
							'p'  => 'p',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'dependency' => array('element' => 'subtitle', 'not_empty'=>true)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Currency','qode'),
						'param_name'	=> 'currency'
					),
					array(
                        'type'			=> 'textfield',
                        'heading'		=> esc_html__('Text','qode'),
                        'param_name'	=> 'text'
                    ),
					array(
						'type' => 'param_group',
						'heading' => esc_html__( 'Pricing Items', 'qode' ),
						'param_name' => 'pricing_items',
						'value' => '',
						'params' => array(
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Item Title', 'qode' ),
								'param_name' => 'item_title',
								'admin_label' => true,
							),
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Item Price', 'qode' ),
								'param_name' => 'item_price',
								'admin_label' => true
							),
							array(
								'type' => 'dropdown',
								'heading' => esc_html__( 'Item Active', 'qode' ),
								'param_name' => 'item_active',
								'admin_label' => true,
								'value' => array(
									esc_html__('No', 'qode')  => 'no',
									esc_html__('Yes', 'qode') => 'yes'
								)
							)
						)
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Items Title Tag', 'qode'),
						'param_name' => 'title_tag',
						'value' => array(
							''   => '',
							'p'  => 'p',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'dependency' => array('element' => 'pricing_items', 'not_empty'=>true)
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Enable Button','qode'),
						'param_name'	=> 'enable_button',
						'value'       => array(
							'No'  	=> 'no',
							'Yes' 	=> 'yes'
						)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Button Link','qode'),
						'param_name'	=> 'button_link',
						'dependency'	=> array('element'=>'enable_button', 'value'=>'yes')
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Button Target','qode'),
						'param_name'	=> 'button_target',
						'value' => array(
							esc_html__('Self', 'qode')	=> '_self',
							esc_html__('Blank', 'qode')	=> '_blank',
						),
						'dependency'	=> array('element'=>'enable_button', 'value'=>'yes')
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Button Text','qode'),
						'param_name'	=> 'button_text',
						'dependency'	=> array('element'=>'enable_button', 'value'=>'yes')
					),
					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Border Color','qode'),
						'param_name'	=> 'border_color',
						'group'			=> esc_html__('Style','qode')
					),
					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Left Section Background Color','qode'),
						'param_name'	=> 'left_section_background_color',
						'group'			=> esc_html__('Style','qode')
					),
					array(
						'type'			=> 'colorpicker',
						'heading'		=> esc_html__('Right Section Background Color','qode'),
						'param_name'	=> 'right_section_background_color',
						'group'			=> esc_html__('Style','qode')
					)
                )
            )
        );
    }

    public function render($atts, $content = null) {

        $args = array(
            'text'								=> '',
            'subtitle'							=> '',
            'subtitle_title_tag'				=> 'h4',
            'currency'							=> '$',
            'pricing_items'						=> '',
            'title_tag'							=> 'p',
            'enable_button'						=> '',
            'button_link'						=> '',
            'button_target'						=> '_self',
            'button_text'						=> '',
            'border_color'						=> '',
            'left_section_background_color'		=> '',
            'right_section_background_color'	=> '',
            'switch_color'						=> '',
            'active_switch_color'				=> ''
        );

        $params = shortcode_atts($args, $atts);
        extract($params);

		$params['content'] = $content;
		$params['pricing_items'] = json_decode(urldecode($params['pricing_items']), true);

		$params['total_price'] = $this->getPrice($params);
		$params['holder_style'] = $this->getHolderStyle($params);
		$params['left_section_style'] = $this->getLeftSectionStyle($params);
		$params['right_section_style'] = $this->getRightSectionStyle($params);


        $html = qode_get_shortcode_template_part('templates/pricing-calculator-template', 'pricing-calculator', '', $params);

        return $html;
    }

	private  function getPrice($params) {

		$total_price = 0;

		if(is_array($params['pricing_items']) && count($params['pricing_items']) > 0) {
			foreach($params['pricing_items'] as $pricing_item) {

				if($pricing_item['item_active'] == 'yes'){
					$total_price = ((int)$total_price) + ((int)$pricing_item['item_price']);
				}

			}
		}
		return $total_price;
	}

	private function getHolderStyle($params) {

		$style = array();

		if($params['border_color']) {
			$style[] = 'border-color:'. $params['border_color'];
		}

		return implode(';', $style);
	}

	private function getLeftSectionStyle($params) {

		$style = array();

		if($params['left_section_background_color']) {
			$style[] = 'background-color:'. $params['left_section_background_color'];
		}

		return implode(';', $style);
	}

	private function getRightSectionStyle($params) {

		$style = array();

		if($params['right_section_background_color']) {
			$style[] = 'background-color:'. $params['right_section_background_color'];
		}

		return implode(';', $style);
	}

}