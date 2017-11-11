<?php
namespace Bridge\Shortcodes\WorkflowItem;

use Bridge\Shortcodes\Lib\ShortcodeInterface;

/**
 * class Workflow
 */
class WorkflowItem implements ShortcodeInterface {
    /**
     * @var string
     */
    private $base;

    function __construct() {
        $this->base = 'qode_workflow_item';
        add_action('qode_vc_map', array($this, 'vcMap'));
    }

    public function getBase() {
        return $this->base;
    }

    public function vcMap() {

        vc_map(array(
            "name"                    => esc_html__('Workflow Item', 'qode'),
            "base"                    => $this->base,
            "as_child"                => array('only' => 'qode_workflow'),
            'category'                => esc_html__('by QODE','qode'),
            "icon"                    => "icon-wpb-workflow-item extended-custom-icon-qode",
            "show_settings_on_create" => true,
            'params'                  => array_merge(
                array(
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Title', 'qode'),
                        'param_name'  => 'title',
                        'admin_label' => true,
                        'description' => esc_html__('Enter workflow item title.', 'qode')
                    ),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Title Tag', 'qode'),
						'param_name'	=> 'title_tag',
						'value' => array(
							'' => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'group'			=> esc_html__('Design Group','qode')
					),
                    array(
                        'type'        => 'textfield',
                        'heading'     => esc_html__('Subtitle', 'qode'),
                        'param_name'  => 'subtitle',
                        'admin_label' => true,
                        'description' => esc_html__('Enter workflow item subtitle.', 'qode')
                    ),
					array(
						'type'			=> 'dropdown',
						'heading'		=> esc_html__('Subtitle Tag', 'qode'),
						'param_name'	=> 'subtitle_tag',
						'value' => array(
							'' => '',
							'h2' => 'h2',
							'h3' => 'h3',
							'h4' => 'h4',
							'h5' => 'h5',
							'h6' => 'h6',
						),
						'group'			=> esc_html__('Design Group','qode')
					),
                    array(
                        'type'        => 'textarea',
                        'heading'     => esc_html__('Text', 'qode'),
                        'param_name'  => 'text',
                        'description' => esc_html__('Enter workflow item text.', 'qode')
                    ),
                    array(
                        'type'        => 'attach_image',
                        'heading'     => esc_html__('Image', 'qode'),
                        'param_name'  => 'image',
                        'description' => esc_html__('Insert workflow item image.', 'qode')
                    ),
                    array(
                        'type'        => 'checkbox',
                        'heading'     => esc_html__('Set image on right side', 'qode'),
                        'param_name'  => 'image_float',
                        'value'       => array('Make Image Float Right?' => 'yes'),
                        'description' => ''
                    ),
                    array(
                        'type'        => 'dropdown',
                        'heading'     => esc_html__('Image alignment', 'qode'),
                        'param_name'  => 'image_alignment',
                        'admin_label' => true,
                        'value'       => array(
                            esc_html__('Center', 'qode') => 'center',
                            esc_html__('Left', 'qode')   => 'left',
                            esc_html__('Right', 'qode')  => 'right'
                        )
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Circle border color', 'qode'),
                        'param_name'  => 'circle_border_color',
                        'description' => esc_html__('Pick a color for the circle border color.', 'qode'),
						'group'		  => esc_html__('Design Group','qode')
                    ),
                    array(
                        'type'        => 'colorpicker',
                        'heading'     => esc_html__('Circle background color', 'qode'),
                        'param_name'  => 'circle_background_color',
                        'description' => esc_html__('Pick a color for the circle background color.', 'qode'),
						'group'		  => esc_html__('Design Group','qode')
                    ),
                )
            )
        ));
    }

    public function render($atts, $content = null) {
        $default_atts = (array(
            'title'                   => '',
            'title_tag'				  => 'h3',
            'subtitle'                => '',
            'subtitle_tag'			  => 'h6',
            'text'                    => '',
            'image'                   => '',
            'image_float'             => '',
            'image_alignment'         => 'center',
            'circle_border_color'     => '',
            'circle_background_color' => '',
        ));
        $params       = shortcode_atts($default_atts, $atts);
        $style_params = $this->getStyleProperties($params);
        $params       = array_merge($params, $style_params);
        extract($params);

        $params['image_on_right_class'] = $this->imageOnRightSideClass($params);

        $output = '';
        $output .= qode_get_shortcode_template_part('templates/workflow-item-template', 'workflow', '', $params);

        return $output;
    }

    /**
     * Checks if image is set to be on right and set class
     *
     * @param $params
     *
     * @return string
     */
    private function imageOnRightSideClass($params) {

        $class = '';

        if($params['image_float'] == 'yes') {
            $class .= 'reverse';
        }

        return $class;
    }

    /**
     * Generates circle line color
     *
     * @param $params
     *
     * @return array
     */

    private function getStyleProperties($params) {

        $style                            = array();
        $style['circle_border_color']     = '';
        $style['circle_background_color'] = '';
        $style['line_color']              = '';

        if($params['circle_border_color'] !== '') {
            $style['circle_border_color'] = 'border-color:'.$params['circle_border_color'].';';
        }
        if($params['circle_background_color'] !== '') {
            $style['circle_background_color'] = 'background-color:'.$params['circle_background_color'].';';
            $style['line_color']              = 'background-color:'.$params['circle_background_color'].';';
        }

        return $style;
    }
}
