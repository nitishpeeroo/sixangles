<?php
namespace Bridge\Shortcodes\NumberedProcess;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class NumberedProcess implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'qode_numbered_process';
		add_action('qode_vc_map', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => esc_html__('Numbered Process','qode'),
                'base' => $this->base,
				'as_parent' => array('only' => 'qode_numbered_process_item'),
				'content_element' => true,
                'icon' => 'icon-wpb-numbered-process extended-custom-icon-qode',
                'category' => esc_html__('by QODE','qode'),
				'js_view' => 'VcColumnView',
                'params' => array(
					array(
						'type'        => 'dropdown',
						'param_name'  => 'number_of_items',
						'heading'     => esc_html__('Number of Process Items', 'qode'),
						'value'       => array(
							esc_html__('Three', 'qode') => 'three',
							esc_html__('Four', 'qode')  => 'four',
							esc_html__('Five', 'qode')  => 'five'
						),
					),
					array(
						'type'        => 'dropdown',
						'param_name'  => 'padding_between',
						'heading'     => esc_html__('Space Between Process Items', 'qode'),
						'value'       => array(
							esc_html__('Default', 'qode') => '',
							esc_html__('Small', 'qode') => 'small',
							esc_html__('Medium', 'qode') => 'medium',
							esc_html__('Large', 'qode')  => 'large',
						),
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Line Between Process Items', 'qode'),
						'param_name' => 'line_style',
						'value' => array(
							esc_html__('Solid','qode')   => 'solid',
							esc_html__('Dashed','qode')   => 'dashed',
							esc_html__('None','qode')   => 'none',
						)
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Line Skin', 'qode'),
						'param_name' => 'line_skin',
						'value' => array(
							esc_html__('Default','qode')   => '',
							esc_html__('Light','qode')   => 'light',
							esc_html__('Dark','qode')   => 'dark',
						),
						'dependency' => array('element' => 'line_style', 'value' => array('solid','dashed'))
					)
                )
            )
        );
    }

    public function render($atts, $content = null) {

        $args = array(
            'number_of_items'			=> 'three',
            'padding_between'			=> '',
            'line_style'				=> 'solid',
            'line_skin'					=> '',
        );

		$params            = shortcode_atts($args, $atts);
		$params['content'] = $content;

		$params['holder_classes'] = $this->getHolderClasses($params);

        $html = qode_get_shortcode_template_part('templates/numbered-process-template', 'numbered-process', '', $params);

        return $html;
    }

    private function getHolderClasses($params){
    	$holder_classes = array();
    	$holder_classes[] = 'qode-numbered-process-holder';

    	if ($params['number_of_items'] !== ''){
    		$holder_classes[] = 'qode-numbered-process-holder-items-'.$params['number_of_items'];
    	}

    	if ($params['padding_between'] !== ''){
    		$holder_classes[] = 'qodef-np-padding-'.$params['padding_between'];
    	}
    	else{
    		switch ($params['number_of_items']) {
    			case 'five':
					$holder_classes[] = 'qodef-np-padding-small';
    				break;    			
    			default:
					$holder_classes[] = 'qodef-np-padding-medium';
					break;
    		}
    	}

    	if ($params['line_style'] !== 'none'){
    		$holder_classes[] = 'qode-np-line-'.$params['line_style'];

    		if ($params['line_skin'] !== ''){
    			$holder_classes[] = 'qode-np-line-skin-'.$params['line_skin'];
    		}
    	}

    	return implode(' ', $holder_classes);
    }
}