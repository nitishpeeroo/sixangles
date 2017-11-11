<?php
namespace Bridge\Shortcodes\InteractiveIconShowcase;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class InteractiveIconShowcase implements ShortcodeInterface{
	private $base;
	function __construct() {
		$this->base = 'qode_interactive_icon_showcase';
		add_action('qode_vc_map', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			'name'						=> esc_html__('Interactive Icon Showcase', 'qode'),
			'base'						=> $this->base,
			'icon'						=> 'icon-wpb-interactive-icon-showcase extended-custom-icon-qode',
			'category'					=> 'by QODE',
			'as_parent'					=> array('only' => 'qode_interactive_icon_showcase_item'),
			'show_settings_on_create'	=> true,
			'js_view'					=> 'VcColumnView',
			'params'					=> array(
				array(
					'type'			=> 'dropdown',
					'admin_label'	=> true,
					'heading'		=> 'Autoplay',
					'param_name'	=> 'autoplay',
					'value'			=> array(
						'Yes' => 'yes',
						'No' => 'no'
					)
				),
				array(
					'type'			=> 'textfield',
					'admin_label'	=> true,
					'heading'		=> 'Autoplay Interval (ms)',
					'param_name'	=> 'autoplay_interval',
					'description'	=> 'Default value is 3000.'
				),
			)
		));
	}

	public function render($atts, $content = null) {
		$args = array(
			'autoplay' => 'yes',
			'autoplay_interval' => '3000',
		);

		$params = shortcode_atts($args, $atts);

		$icon_showcase_classes = array();
		$icon_showcase_classes[] = 'qode-int-icon-showcase';
		if ($params['autoplay'] == 'yes') {
			$icon_showcase_classes[] = 'qode-autoplay';
		}
		$icon_showcase_class = implode(' ', $icon_showcase_classes);

        $data_attr = $this->getDataAttr($params);


		$html = '';

		$html .= '<div '. qode_get_class_attribute($icon_showcase_class) . qode_get_inline_attrs($data_attr) . '>';
		$html .= '<div class="qode-int-icon-showcase-inner">';
		$html .= do_shortcode($content);
		$html .= '</div>';
		$html .= '<div class="qode-int-icon-circle"></div>';
		$html .= '</div>';

		return $html;

	}

	/**
	 *
	 * Returns array of data attr
	 *
	 * @param $params
	 *
	 * @return array
	 */
	private function getDataAttr($params) {
	    $data_attr = array();

	    if(!empty($params['autoplay_interval'])) {
	        $data_attr['data-interval'] = $params['autoplay_interval'];
	    }

	    return $data_attr;
	}

}
