<?php

if(!function_exists('qode_advanced_tabs_styles')) {

    function qode_advanced_tabs_styles() {

		$advanced_tabs_color = qode_options()->getOptionValue('advanced_tabs_color');
		if(!empty($advanced_tabs_color)) {
			echo qode_dynamic_css('.qode-advanced-tabs .qode-advanced-tabs-nav li a', array('color' => $advanced_tabs_color));
		}

		$advanced_tabs_bckg_color = qode_options()->getOptionValue('advanced_tabs_bckg_color');
		if(!empty($advanced_tabs_bckg_color)) {
			echo qode_dynamic_css('.qode-advanced-tabs .qode-advanced-tabs-nav li', array('background-color' => $advanced_tabs_bckg_color));
		}

		$advanced_tabs_hover_color = qode_options()->getOptionValue('advanced_tabs_hover_color');
		if(!empty($advanced_tabs_hover_color)) {
			echo qode_dynamic_css('.qode-advanced-tabs.qode-advanced-horizontal-tab .qode-advanced-tabs-nav li.ui-state-active a', array('color' => $advanced_tabs_hover_color));
		}

		$advanced_tabs_bckg_hover_color = qode_options()->getOptionValue('advanced_tabs_hover_bckg_color');
		if(!empty($advanced_tabs_bckg_hover_color)) {
			echo qode_dynamic_css('.qode-advanced-tabs.qode-advanced-horizontal-tab .qode-advanced-tabs-nav li.ui-state-active', array('background-color' => $advanced_tabs_bckg_hover_color));
		}

    }

    add_action('qode_style_dynamic', 'qode_advanced_tabs_styles');
}
