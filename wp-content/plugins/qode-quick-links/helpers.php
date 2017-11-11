<?php

if(!function_exists('qode_quick_links_version_class')) {
    /**
     * Adds plugins version class to body
     * @param $classes
     * @return array
     */
    function qode_quick_links_version_class($classes) {
        $classes[] = 'qode-quick-links-'.QODE_QUICK_LINKS_VERSION;

        return $classes;
    }

    add_filter('body_class', 'qode_quick_links_version_class');
}

if(!function_exists('qode_quick_links_get_template_part')) {
	/**
	 * Loads template part with parameters. If file with slug parameter added exists it will load that file, else it will load file without slug added.
	 * Child theme friendly function
	 *
	 * @param string $template name of the template to load without extension
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 * @param bool $return whether to return it as a string
	 *
	 * @return mixed
	 */
	function qode_quick_links_get_template_part($template, $slug = '', $params = array(), $return = false) {
		//HTML Content from template
		$html = '';
		$template_path = QODE_QUICK_LINKS_ABS_PATH;

		$temp = $template_path.'/'.$template;
		if(is_array($params) && count($params)) {
			extract($params);
		}

		$template = '';

		if($temp !== '') {
			$template = $temp.'.php';

			if($slug !== '') {
				$template = "{$temp}-{$slug}.php";
			}
		}

		if($template) {
			if($return) {
				ob_start();
			}

			include($template);

			if($return) {
				$html = ob_get_clean();
			}

		}

		if($return) {
			return $html;
		}
	}
}

if(!function_exists('qode_quick_links_inline_style')) {
	/**
	 * Function that echoes generated style attribute
	 * @param $value string | array attribute value
	 *
	 */
	function qode_quick_links_inline_style($value) {
		echo qode_quick_links_get_inline_style($value);
	}
}

if(!function_exists('qode_quick_links_get_inline_style')) {
	/**
	 * Function that generates style attribute and returns generated string
	 * @param $value string | array value of style attribute
	 * @return string generated style attribute
	 *
	 */
	function qode_quick_links_get_inline_style($value) {
        return qode_quick_links_get_inline_attr($value, 'style', ';');
	}
}

if(!function_exists('qode_quick_links_class_attribute')) {
	/**
	 * Function that echoes class attribute
	 * @param $value string value of class attribute
	 */
	function qode_quick_links_class_attribute($value) {
		echo qode_quick_links_get_class_attribute($value);
	}
}

if(!function_exists('qode_quick_links_get_class_attribute')) {
	/**
	 * Function that returns generated class attribute
	 * @param $value string value of class attribute
	 * @return string generated class attribute
	 */
	function qode_quick_links_get_class_attribute($value) {
		return qode_quick_links_get_inline_attr($value, 'class', ' ');
	}
}

if(!function_exists('qode_quick_links_get_inline_attr')) {
	/**
	 * Function that generates html attribute
	 * @param $value string | array value of html attribute
	 * @param $attr string name of html attribute to generate
	 * @param $glue string glue with which to implode $attr. Used only when $attr is array
	 * @return string generated html attribute
	 */
	function qode_quick_links_get_inline_attr($value, $attr, $glue = '') {
		if(!empty($value)) {

			if(is_array($value) && count($value)) {
				$properties = implode($glue, $value);
			} elseif($value !== '') {
				$properties = $value;
			}

			return $attr.'="'.esc_attr($properties).'"';
		}

		return '';
	}
}