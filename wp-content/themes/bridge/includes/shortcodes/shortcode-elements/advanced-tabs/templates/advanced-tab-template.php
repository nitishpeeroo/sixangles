<?php
$tab_data_str = '';
$icon_html = '';
$tab_data_str .= 'data-icon-pack="'.$icon_pack.'" ';
$icon_html .=  qode_icon_collections()->getIconHTML($icon, $icon_pack,array());
$tab_data_str .= 'data-icon-html="'. esc_attr($icon_html) .'"';
?>
<div class="qode-advanced-tab-container" id="tab-<?php echo sanitize_title($tab_title); ?>" <?php print $tab_data_str?>><?php echo do_shortcode($content); ?></div>