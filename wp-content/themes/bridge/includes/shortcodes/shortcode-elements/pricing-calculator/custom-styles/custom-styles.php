<?php

if(!function_exists('qode_pricing_calculator_styles')) {

    function qode_pricing_calculator_styles() {

        $border_color = qode_options()->getOptionValue('pricing_calculator_border_color');
        if(!empty($border_color)) {
			echo qode_dynamic_css('.qode-pricing-calculator', array('border-color' => qode_options()->getOptionValue('pricing_calculator_border_color')));
        }

		$pricing_calculator_left_section_bckg_color = qode_options()->getOptionValue('pricing_calculator_left_section_bckg_color');
		if(!empty($pricing_calculator_left_section_bckg_color)) {
			echo qode_dynamic_css('.qode-pricing-calculator .qode-pricing-calculator-items', array('background-color' => $pricing_calculator_left_section_bckg_color));
		}

		$pricing_calculator_right_section_bckg_color = qode_options()->getOptionValue('pricing_calculator_right_section_bckg_color');
		if(!empty($pricing_calculator_right_section_bckg_color)) {
			echo qode_dynamic_css('.qode-pricing-calculator .qode-pricing-calculator-text-holder', array('background-color' => $pricing_calculator_right_section_bckg_color));
		}

		$pricing_calculator_switch_color = qode_options()->getOptionValue('pricing_calculator_switch_color');
		if(!empty($pricing_calculator_switch_color)) {
			echo qode_dynamic_css('.qode-pricing-calculator .qode-pricing-calculator-switch .qode-pricing-calculator-slider', array('background-color' => $pricing_calculator_switch_color));
		}

		$pricing_calculator_switch_active_color = qode_options()->getOptionValue('pricing_calculator_switch_active_color');
		if(!empty($pricing_calculator_switch_color)) {
			echo qode_dynamic_css('.qode-pricing-calculator .qode-pricing-calculator-switch input:checked+.qode-pricing-calculator-slider', array('background-color' => $pricing_calculator_switch_active_color));
		}


		$pc_price_style = array();

		$pricing_calculator_price_font_family = qode_options()->getOptionValue('pricing_calculator_price_font_family');
		if(qode_is_font_option_valid($pricing_calculator_price_font_family)) {
			$pc_price_style['font-family'] = qode_get_font_option_val($pricing_calculator_price_font_family);
		}

		$pricing_calculator_price_font_size = qode_options()->getOptionValue('pricing_calculator_price_font_size');
		if(!empty($pricing_calculator_price_font_size)) {
			$pc_price_style['font-size'] = $pricing_calculator_price_font_size.'px';
		}

		$pricing_calculator_price_font_weight = qode_options()->getOptionValue('pricing_calculator_price_font_weight');
		if(!empty($pricing_calculator_price_font_weight)) {
			$pc_price_style['font-weight'] = $pricing_calculator_price_font_weight;
		}

		$pricing_calculator_price_font_style = qode_options()->getOptionValue('pricing_calculator_price_font_style');
		if(!empty($pricing_calculator_price_font_style)) {
			$pc_price_style['font-style'] = $pricing_calculator_price_font_style;
		}

		$pricing_calculator_price_letter_spacing = qode_options()->getOptionValue('pricing_calculator_price_letter_spacing');
		if($pricing_calculator_price_letter_spacing != '') {
			$pc_price_style['letter-spacing'] = $pricing_calculator_price_letter_spacing.'px';
		}

		$pricing_calculator_price_color = qode_options()->getOptionValue('pricing_calculator_price_color');
		if(!empty($pricing_calculator_price_color)) {
			$pc_price_style['color'] = $pricing_calculator_price_color;
		}

		echo qode_dynamic_css('.qode-pricing-calculator .qode-pricing-calculator-total-price-holder', $pc_price_style);

    }

    add_action('qode_style_dynamic', 'qode_pricing_calculator_styles');
}
