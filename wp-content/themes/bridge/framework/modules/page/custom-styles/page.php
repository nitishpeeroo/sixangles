<?php

if(!function_exists('qode_inter_page_navigation_styles')) {

    function qode_inter_page_navigation_styles() {
    	$inter_page_navigation_style = array();

		$background_color = qode_options()->getOptionValue('inter_page_navigation_background_color');
		if($background_color !== '') {
			$inter_page_navigation_style['background-color'] = $background_color;
		}

		if (count($inter_page_navigation_style)){
			echo qode_dynamic_css('.qode-inter-page-navigation-holder, .qode-inter-page-navigation-holder .qode-inter-page-navigation-back-link-inner:after', $inter_page_navigation_style);
		}

    }

    add_action('qode_style_dynamic', 'qode_inter_page_navigation_styles');
}
