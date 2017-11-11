<?php
namespace Bidge\Shortcodes\InteractiveIconShowcaseItem;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class InteractiveIconShowcaseItem implements ShortcodeInterface{
	private $base;

	function __construct() {
		$this->base = 'qode_interactive_icon_showcase_item';
		add_action('qode_vc_map', array($this, 'vcMap'));
	}
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if(function_exists('vc_map')){
			vc_map( 
				array(
					'name' => esc_html__('Interactive Icon Showcase Item', 'dorianwp'),
					'base' => $this->base,
					'as_child' => array('only' => 'qode_interactive_icon_showcase'),
					'category' => 'by QODE',
					'icon' => 'icon-wpb-interactive-icon-showcase-item extended-custom-icon-qode',
					'params' => array_merge(
						qode_icon_collections()->getVCParamsArray(array(), '', true),
						array(
							array(
								'type' => 'textfield',
								'heading' => 'Title',
								'param_name' => 'title'
							),
							array(
								'type'       => 'dropdown',
								'heading'    => 'Title Tag',
								'param_name' => 'title_tag',
								'value'      => array(
									''   => '',
									'h2' => 'h2',
									'h3' => 'h3',
									'h4' => 'h4',
									'h5' => 'h5',
									'h6' => 'h6',
								),
								'dependency' => array('element' => 'title', 'not_empty' => true)
							),
							array(
								'type' => 'textarea',
								'heading' => 'Text',
								'param_name' => 'text'
							)
						)
					)
				)
			);			
		}
	}

	public function render($atts, $content = null) {
		$args = array(
			'title'		=> '',
			'title_tag'	=> 'h3',
			'text'		=> ''
		);

        $args = array_merge($args, qode_icon_collections()->getShortcodeParams());
		$params = shortcode_atts($args, $atts);

		$params['content'] = $content;


		$iconPackName   = qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$params['icon'] = $params[$iconPackName];
		$params['icon_holder_style'] = $this->getIconHolderStyle($params);

		$html = qode_get_shortcode_template_part('templates/interactive-icon-showcase-item-template', 'interactive-icon-showcase', '', $params);

		return $html;
	}

    /**
     * Returns parameters for icon shortcode as a string
     *
     * @param $params
     *
     * @return array
     */
	private function getIconHolderStyle($params) {
        $params_array = array();


		if ($params['icon_background_color'] !== ''){
			$params_array[] = 'background-color:' . $params['icon_background_color'];
		}


        return implode(';',$params_array);
    }
}
