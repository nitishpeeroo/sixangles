<div <?php qode_class_attribute($shortcode_classes); ?> <?php qode_inline_style($shortcode_styles); ?>>
	<a <?php qode_class_attribute($link_classes); ?> href="<?php echo esc_url($cta_link) ?>" target="<?php echo esc_attr($cta_link_target) ?>"></a>
	<div class="qode-advanced-cta-content">		
	    <span class="qode-advanced-cta-text-holder" <?php qode_inline_style($text_styles); ?>>
		    <?php echo esc_html($cta_text); ?>
	    </span>
	    <span class="qode-advanced-cta-icon-holder" <?php qode_inline_style($icon_styles); ?>>
		    <span class="qode-advanced-cta-icon-holder-table">
		    	<span class="qode-advanced-cta-icon-holder-cell" <?php qode_inline_style($icon_offsets); ?>>
			    	<?php echo qode_icon_collections()->renderIconHTML($icon, $icon_pack, array('icon_attributes' => array('class' => 'qode-advanced-cta-icon'))); ?>
			    </span>
		    </span>
		    <?php if (!empty($icon_border_shape)) { ?>
			    <span class="qode-advanced-cta-icon-border"></span>
		    <?php } ?>
	    </span>
	</div>
	<?php if ($enable_gradient) { ?>
		<div class="qode-advanced-cta-background-holder">
			<span class="qode-advanced-cta-background-1 qode-type1-gradient-left-to-right"></span>
			<span class="qode-advanced-cta-background-2 qode-type1-gradient-left-to-right"></span>
			<span class="qode-advanced-cta-background-3"></span>
		</div>
	<?php } ?>
</div>