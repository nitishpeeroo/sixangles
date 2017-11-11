<?php 

if(!function_exists('qode_accordions_typography_styles')){
	function qode_accordions_typography_styles(){
		$selector = '.qode-accordion-holder .qode-title-holder';
		$styles = array();
		
		$font_family = qode_options()->getOptionValue('accordions_font_family');
		if(qode_is_font_option_valid($font_family)){
			$styles['font-family'] = qode_get_font_option_val($font_family);
		}
		
		$text_transform = qode_options()->getOptionValue('accordions_text_transform');
       if(!empty($text_transform)) {
           $styles['text-transform'] = $text_transform;
       }

       $font_style = qode_options()->getOptionValue('accordions_font_style');
       if(!empty($font_style)) {
           $styles['font-style'] = $font_style;
       }

       $letter_spacing = qode_options()->getOptionValue('accordions_letter_spacing');
       if($letter_spacing !== '') {
           $styles['letter-spacing'] = qode_filter_px($letter_spacing).'px';
       }

       $font_weight = qode_options()->getOptionValue('accordions_font_weight');
       if(!empty($font_weight)) {
           $styles['font-weight'] = $font_weight;
       }

       echo qode_dynamic_css($selector, $styles);
	}
	add_action('qode_style_dynamic', 'qode_accordions_typography_styles');
}

if(!function_exists('qode_accordions_initial_color_styles')){

	function qode_accordions_initial_color_styles(){

		$selector = '.qode-accordion-holder .qode-title-holder';
		$styles = array();
		
		if(qode_options()->getOptionValue('accordions_title_color')) {
			$styles['color'] = qode_options()->getOptionValue('accordions_title_color');
		}
		
		if(qode_options()->getOptionValue('accordions_back_color')) {
			$styles['background-color'] = qode_options()->getOptionValue('accordions_back_color');
		}

		echo qode_dynamic_css($selector, $styles);
	}

	add_action('qode_style_dynamic', 'qode_accordions_initial_color_styles');
}

if(!function_exists('qode_accordions_active_color_styles')){
	
	function qode_accordions_active_color_styles(){
		$selector = array(
			'.qode-accordion-holder .qode-title-holder.ui-state-active',
			'.qode-accordion-holder .qode-title-holder.ui-state-hover'
		);
		$styles = array();
		
		if(qode_options()->getOptionValue('accordions_title_color_active')) {
			$styles['color'] = qode_options()->getOptionValue('accordions_title_color_active');
		}
		
		if(qode_options()->getOptionValue('accordions_back_color_active')) {
			$styles['background-color'] = qode_options()->getOptionValue('accordions_back_color_active');
		}

		echo qode_dynamic_css($selector, $styles);
	}

	add_action('qode_style_dynamic', 'qode_accordions_active_color_styles');
}