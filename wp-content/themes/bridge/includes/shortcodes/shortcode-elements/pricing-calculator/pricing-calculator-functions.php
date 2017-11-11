<?php

if(!function_exists('qode_check_is_pricing_calculator_item_checked')) {
	function qode_check_is_pricing_calculator_item_checked($value) {

		if($value === 'yes') {
			return 'checked';
		}

		return '';
	}
}
