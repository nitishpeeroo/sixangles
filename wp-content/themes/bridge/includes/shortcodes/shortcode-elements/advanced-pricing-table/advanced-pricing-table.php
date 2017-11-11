<?php
namespace Bridge\Shortcodes\AdvancedPricingTable;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class AdvancedPricingTable implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'qode_advanced_pricing_table';
		add_action('qode_vc_map', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => esc_html__('Advanced Pricing Table','qode'),
                'base' => $this->base,
                'icon' => 'extended-custom-icon-qode icon-wpb-advanced-pricing-table',
                'category' => esc_html__('by QODE','qode'),
                'params' => array(
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Table Title','qode'),
						'param_name'	=> 'table_title'
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Column Title','qode'),
						'param_name'	=> 'column_title'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Title Tag', 'qode'),
						'param_name' => 'title_tag',
						'value' => array(
							''   => '',
							'p'	 => 'p',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						)
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
							)
						)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Currency','qode'),
						'param_name'	=> 'currency'
					),
					array(
						'type'			=> 'attach_image',
						'heading'		=> esc_html__('Table Footer Image','qode'),
						'param_name'	=> 'table_footer_image'
					),
					array(
						'type'			=> 'textarea',
						'heading'		=> esc_html__('Table Footer Text','qode'),
						'param_name'	=> 'table_footer_text'
					),
                )
            )
        );
    }

    public function render($atts, $content = null) {

        $args = array(
            'columns'					=> '',
            'table_title'				=> '',
			'column_title'				=> '',
            'title_tag'					=> 'h5',
            'pricing_items'				=> '',
            'currency'					=> '$',
            'table_footer_image'		=> '',
            'table_footer_text'			=> ''
        );

        $params = shortcode_atts($args, $atts);

		extract($params);

		$params['content'] = $content;
		$params['pricing_items'] = json_decode(urldecode($params['pricing_items']), true);

        $html = qode_get_shortcode_template_part('templates/advanced-pricing-table-template', 'advanced-pricing-table', '', $params);

        return $html;
    }


}