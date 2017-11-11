<?php
namespace Bridge\Shortcodes\AdvancedTabs;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class AdvancedTabs implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'qode_advanced_tabs';
		add_action('qode_vc_map', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name'		=> esc_html__('Advanced Tabs','qode'),
                'base'		=> $this->base,
				'as_parent'	=> array('only' => 'qode_advanced_tab'),
                'icon' => 'extended-custom-icon-qode icon-wpb-advanced-tabs',
                'category' => esc_html__('by QODE','qode'),
				'js_view' => 'VcColumnView',
                'params' => array(
					array(
						'type'			=> 'dropdown',
						'admin_label'	=> true,
						'heading'		=> esc_html__('Title Layout', 'qode'),
						'param_name'	=> 'title_layout',
						'value' => array(
							esc_html__('Without Icon', 'qode') => 'without_icon',
							esc_html__('With Icon', 'qode') => 'with_icon',
							esc_html__('Only Icon', 'qode') => 'only_icon'
						)
					),
					array(
						'type'			=> 'dropdown',
						'admin_label'	=> true,
						'heading'		=> esc_html__('Title Tag', 'qode'),
						'param_name'	=> 'title_tag',
						'value' => array(
							'' => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						)
					)
                )
            )
        );
    }

    public function render($atts, $content = null) {

		$args = array(
			'title_layout'	=> 'without_icon',
			'title_tag'		=> 'h6',
		);

		$args = array_merge($args, qode_icon_collections()->getShortcodeParams());
		$params  = shortcode_atts($args, $atts);

		extract($params);

		// Extract tab titles
		preg_match_all('/tab_title="([^\"]+)"/i', $content, $matches, PREG_OFFSET_CAPTURE);
		$tab_titles = array();

		/**
		 * get tab titles array
		 *
		 */
		if (isset($matches[0])) {
			$tab_titles = $matches[0];
		}

		$tab_title_array = array();

		foreach($tab_titles as $tab) {
			preg_match('/tab_title="([^\"]+)"/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE);
			$tab_title_array[] = $tab_matches[1][0];
		}

		$params['tabs_titles'] = $tab_title_array;
		$params['tab_class'] = $this->getTabClass($params);
		$params['tab_class'] .= ' qode-advanced-tabs-column-' . count($tab_title_array);
		$params['content'] = $content;
		$params['icons_in_title'] = $this->iconsInTitle($params);


        $html = qode_get_shortcode_template_part('templates/advanced-tabs-template', 'advanced-tabs', '', $params);

        return $html;
    }

	/**
	 * Generates tabs class
	 *
	 * @param $params
	 *
	 * @return string
	 */
	private function getTabClass($params){

		$tabTitleLayout = $params['title_layout'];

		$tabClass = array('qode-advanced-tabs', 'qode-advanced-horizontal-tab', 'clearfix');

		switch ($tabTitleLayout) {
			case 'with_icon':
				$tabClass[] = 'qode-advanced-tab-with-icon';
				break;
			case 'only_icon':
				$tabClass[] = 'qode-advanced-tab-only-icon';
				break;
			default :
				$tabClass[] = 'qode-advanced-tab-without-icon';
				break;
		}

		return implode(' ', $tabClass);
	}


	private function iconsInTitle($params){

		$tabTitleLayout = $params['title_layout'];

		switch ($tabTitleLayout) {
			case 'with_icon':
				return true;
				break;
			case 'only_icon':
				return true;
				break;
			default :
				return false;
		}
	}

}