<?php

$args = array(
    "columns"     => "four_columns",
    "circle_line" => "no_line",
    "line_color"  => ""
);

$html = "";
$styles = array();

extract(shortcode_atts($args, $atts));

if(!empty($line_color)) {
	$styles[] = "border-color: ".$line_color.";";
}

$html = '<ul class="q_circles_holder '.$columns.' '.$circle_line.'" '. qode_get_inline_style(implode(';',$styles)) .'>';

$html .= do_shortcode($content);

$html .= '</ul>';

echo $html;