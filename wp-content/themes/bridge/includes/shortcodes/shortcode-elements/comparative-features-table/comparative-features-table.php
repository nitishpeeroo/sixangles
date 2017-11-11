<?php
namespace Bridge\Shortcodes\ComparativeFeaturesTable;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

class ComparativeFeaturesTable implements ShortcodeInterface {

    private $base;

    function __construct() {
        $this->base = 'qode_comparative_features_table';
		add_action('qode_vc_map', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {
        vc_map(array(
                'name' => esc_html__('Comparative Features Table','qode'),
                'base' => $this->base,
                'icon' => 'icon-wpb-comparative-features-table extended-custom-icon-qode',
                'category' => esc_html__('by QODE','qode'),
                'params' => array(
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Columns', 'qode'),
						'param_name' => 'columns',
						'value' => array(
							'One'   => 'one-column',
							'Two'	=> 'two-columns',
							'Three' => 'three-columns'
						)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Table Title','qode'),
						'param_name'	=> 'table_title'
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Title Tag', 'qode'),
						'param_name' => 'title_tag',
						'value' => array(
							''   => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						)
					),
					array(
						'type' => 'dropdown',
						'heading' => esc_html__('Feature Title Tag', 'qode'),
						'param_name' => 'feature_title_tag',
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
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Column One Title','qode'),
						'param_name'	=> 'column_one_title',
						'dependency' => array('element' => 'columns', 'value' => array('one-column', 'two-columns', 'three-columns'))
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Column Two Title','qode'),
						'param_name'	=> 'column_two_title',
						'dependency' => array('element' => 'columns', 'value' => array('two-columns', 'three-columns'))
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Column Three Title','qode'),
						'param_name'	=> 'column_three_title',
						'dependency' => array('element' => 'columns', 'value' => array('three-columns'))
					),
					array(
						'type' => 'param_group',
						'heading' => esc_html__( 'Feature', 'qode' ),
						'param_name' => 'feature',
						'value' => '',
						'params' => array(
							array(
								'type' => 'textfield',
								'heading' => esc_html__( 'Feature Title', 'qode' ),
								'param_name' => 'feature_title',
								'admin_label' => true,
							),array(
								'type' => 'dropdown',
								'heading' => esc_html__( 'Column One Active', 'qode' ),
								'param_name' => 'column_one_active',
								'value' => array(
									'No'	=> 'no',
									'Yes'	=> 'yes'
								),
								'dependency' => array('element' => 'columns', 'value' => array('one-column'))
							),
							array(
								'type' => 'dropdown',
								'heading' => esc_html__( 'Column Two Active', 'qode' ),
								'param_name' => 'column_two_active',
								'value' => array(
									'No'	=> 'no',
									'Yes'	=> 'yes'
								),
								'dependency' => array('element' => 'columns', 'value' => array('two-columns', 'three-columns'))
							),
							array(
								'type' => 'dropdown',
								'heading' => esc_html__( 'Column Three Active', 'qode' ),
								'param_name' => 'column_three_active',
								'value' => array(
									'No'	=> 'no',
									'Yes'	=> 'yes'
								),
								'dependency' => array('element' => 'columns', 'value' => array('three-columns'))
							)
						)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Column One Link','qode'),
						'param_name'	=> 'column_one_link',
						'dependency' => array('element' => 'columns', 'value' => array('one-column', 'two-columns', 'three-columns'))
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Column One Link Target','qode'),
						'param_name'	=> 'column_one_link_target',
						'value'			=> array(
							esc_html__('Self', 'qode')	=> '_self',
							esc_html__('Blank', 'qode')	=> '_blank',
						),
						'dependency' => array('element' => 'column_one_link', 'not_empty' => true)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Column One Link Text','qode'),
						'param_name'	=> 'column_one_link_text',
						'dependency' => array('element' => 'column_one_link', 'not_empty' => true)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Column Two Link','qode'),
						'param_name'	=> 'column_two_link',
						'dependency' => array('element' => 'columns', 'value' => array('two-columns', 'three-columns'))
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Column Two Link Target','qode'),
						'param_name'	=> 'column_one_two_target',
						'value'			=> array(
							esc_html__('Self', 'qode')	=> '_self',
							esc_html__('Blank', 'qode')	=> '_blank',
						),
						'dependency' => array('element' => 'column_two_link', 'not_empty' => true)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Column Two Link Text','qode'),
						'param_name'	=> 'column_two_link_text',
						'dependency' => array('element' => 'column_two_link', 'not_empty' => true)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Column Three Link','qode'),
						'param_name'	=> 'column_three_link',
						'dependency' => array('element' => 'columns', 'value' => array('three-columns'))
					),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Column Three Link Target','qode'),
						'param_name'	=> 'column_three_link_target',
						'value'			=> array(
							esc_html__('Self', 'qode')	=> '_self',
							esc_html__('Blank', 'qode')	=> '_blank',
						),
						'dependency' => array('element' => 'column_three_link', 'not_empty' => true)
					),
					array(
						'type'			=> 'textfield',
						'heading'		=> esc_html__('Column Three Link Text','qode'),
						'param_name'	=> 'column_three_link_text',
						'dependency' => array('element' => 'column_three_link', 'not_empty' => true)
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
            'columns'					=> 'one-column',
            'table_title'				=> '',
            'title_tag'					=> 'h5',
            'feature_title_tag'			=> 'h6',
            'column_one_title'			=> '',
            'column_two_title'			=> '',
            'column_three_title'		=> '',
            'feature'					=> '',
            'column_one_link'			=> '',
            'column_one_link_target'	=> '_self',
            'column_one_link_text'		=> '',
			'column_two_link'			=> '',
			'column_two_link_target'	=> '_self',
			'column_two_link_text'		=> '',
			'column_three_link'			=> '',
			'column_three_link_target'	=> '_self',
			'column_three_link_text'	=> '',
            'table_footer_image'		=> '',
            'table_footer_text'			=> ''
        );

        $params = shortcode_atts($args, $atts);

		extract($params);

		$params['content'] = $content;
		$params['features'] = json_decode(urldecode($params['feature']), true);

        $html = qode_get_shortcode_template_part('templates/comparative-features-table-template', 'comparative-features-table', '', $params);

        return $html;
    }


}