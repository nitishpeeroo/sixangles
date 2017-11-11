<?php
if(!class_exists('svc_social_add_param'))
{
	class svc_social_add_param
	{
		function __construct()
		{
			if ( function_exists('vc_add_shortcode_param')){
				vc_add_shortcode_param('num' , array(&$this, 'number_social_settings_field' ) );
			}elseif ( function_exists('add_shortcode_param')){
				add_shortcode_param('num' , array(&$this, 'number_social_settings_field' ) );
			}			
		}
		function number_social_settings_field($settings, $value)
		{
			//$dependency = vc_generate_dependencies_attributes($settings);
			$param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
			$type = isset($settings['type']) ? $settings['type'] : '';
			$min = isset($settings['min']) ? $settings['min'] : '';
			$max = isset($settings['max']) ? $settings['max'] : '';
			$suffix = isset($settings['suffix']) ? $settings['suffix'] : '';
			$class = isset($settings['class']) ? $settings['class'] : '';
			$step = isset($settings['step']) ? $settings['step'] : '';
			$output = '<input type="number" min="'.$min.'" max="'.$max.'" class="wpb_vc_param_value ' . $param_name . ' ' . $type . ' ' . $class . '" name="' . $param_name . '" value="'.$value.'" style="max-width:100px; margin-right: 10px;" step="'.$step.'"/>'.$suffix;
			return $output;
		}
	}
	//instantiate the class
	$svc_social_add_param = new svc_social_add_param;
}