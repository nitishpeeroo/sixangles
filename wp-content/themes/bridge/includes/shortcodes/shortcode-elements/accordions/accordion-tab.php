<?php 
namespace Bridge\Shortcodes\AccordionTab;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class AccordionTab implements ShortcodeInterface{

	private $base;

	function __construct() {
		$this->base = 'qode_accordion_tab';
		add_action('qode_vc_map', array($this, 'vcMap'));
	}

	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		vc_map( array(
			"name" => esc_html__('Qode Accordion Tab', 'qode'),
			"base" => $this->base,
			"as_parent" => array('except' => 'vc_row'),
			"as_child" => array('only' => 'qode_accordion'),
			'is_container' => true,
            'category' => esc_html__('by QODE','qode'),
			"icon" => "icon-wpb-accordion-tab extended-custom-icon-qode",
			"show_settings_on_create" => true,
			"js_view" => 'VcColumnView',
			"params" => array_merge(
				array(
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Section ID', 'qode' ),
						'param_name' => 'el_id',
						'description' => sprintf( esc_html__( 'Enter optional row ID. Make sure it is unique, and it is valid as w3c specification: %s (Must not have spaces)', 'qode' ), '<a target="_blank" href="http://www.w3schools.com/tags/att_global_id.asp">' . esc_html__( 'link', 'qode' ) . '</a>' ),
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__( 'Title', 'qode' ),
						'param_name' => 'title',
						'admin_label' => true,
						'value' => esc_html__( 'Section', 'qode' ),
						'description' => esc_html__( 'Enter accordion section title.', 'qode' )
					),
					array(
						"type" => "dropdown",
						"class" => "",
						"heading" => esc_html__("Title Tag",'qode'),
						"param_name" => "title_tag",
						"value" => array(
							""   => "",
							"h2" => "h2",
							"h3" => "h3",
							"h4" => "h4",
							"h5" => "h5",
							"h6" => "h6",
						),
						"description" => ""
					)
				),
				qode_icon_collections()->getVCParamsArray(array(), '', true),
				array(
					array(
						'type' => 'attach_image',
						'heading' => esc_html__('Content Background Image','qode'),
						'param_name' => 'content_background_image',
						'group' => esc_html__('Content Design','qode')
					),
					array(
						'type' => 'textfield',
						'heading' => esc_html__('Content Padding','qode'),
						'param_name' => 'content_padding',
						'group' => esc_html__('Content Design','qode'),
						'description' => esc_html__('Enter padding in format 1px 0 0 1px','qode'),
					)
				)
			)
		));
	}	
	public function render($atts, $content = null) {

		$args = (array(
			'title'	=> "Section",
			'title_tag' => 'h4',
			'el_id' => '',
			'content_background_image' => '',
			'content_padding' => ''
		));
		
		$args	= array_merge($args, qode_icon_collections()->getShortcodeParams());
        $params	= shortcode_atts($args, $atts);

		$iconPackName   = qode_icon_collections()->getIconCollectionParamNameByKey($params['icon_pack']);
		$params['content_class'] = '';

		if ($iconPackName) {
			$params['icon'] = $params[$iconPackName];
			$params['content_class'] = 'qode-acc-title-with-icon';
		}

		$params['content'] = $content;
		$params['content_style'] = $this->getContentStyle($params);
		
		$output = '';
		
		$output .= qode_get_shortcode_template_part('templates/accordion-template','accordions', '',$params);

		return $output;
		
	}


	private function getContentStyle($params) {
		$content_style = array();

		if ($params['content_background_image'] !== ''){

	        if (is_numeric($params['content_background_image'])) {
	            $image_src = wp_get_attachment_url($params['content_background_image']);
	        } else {
	            $image_src = $params['content_background_image'];
	        }

	        $content_style[] = 'background-image: url('.esc_url($image_src).')';
		}

		if ($params['content_padding'] !== ''){
			$content_style[] = 'padding: '.$params['content_padding'];
		}

		return implode('; ', $content_style);
	}

}