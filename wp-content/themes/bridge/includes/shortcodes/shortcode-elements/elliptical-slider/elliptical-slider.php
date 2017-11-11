<?php
namespace Bridge\Shortcodes\EllipticalSlider;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class EllipticalSlider implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'qode_elliptical_slider';
		add_action('qode_vc_map', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => esc_html__('Elliptical Slider','qode'),
                'base' => $this->base,
                'icon' => 'extended-custom-icon-qode icon-wpb-elliptical-slider',
                'category' => esc_html__('by QODE','qode'),
                'as_parent' => array('only' => 'qode_elliptical_slide'),
				'content_element'	=> true,
                'js_view' => 'VcColumnView',
                'params' => array(
                    array(
                        'type' => 'textfield',
                        'heading' => esc_html__('Animation speed','qode'),
                        'admin_label' => true,
                        'param_name' => 'animation_speed',
                        'value' => '',
                        'description' => esc_html__('Speed of slide animation in miliseconds','qode')
                    )
                )
            )
        );
    }

    public function render($atts, $content = null) {

        $args = array(
            'animation_speed' => ''
        );

        $params = shortcode_atts($args, $atts);
        extract($params);

        $data_attr = $this->getDataParams($params);

        $html = '';
        $html .= '<div class="qode-elliptical-slider">';
        $html .= '<div class="qode-elliptical-slider-slides"' . qode_get_inline_attrs($data_attr) . '>';
        	$html .= do_shortcode($content);
        $html.= '</div>';
        $html.= '</div>';

        return $html;
    }

    private function getDataParams($params){
        $data_attr =  array();
        if(!empty($params['animation_speed'])){
            $data_attr[] ='data-animation-speed ="' . $params['animation_speed'] . '"';
        }

        return $data_attr;
    }
}