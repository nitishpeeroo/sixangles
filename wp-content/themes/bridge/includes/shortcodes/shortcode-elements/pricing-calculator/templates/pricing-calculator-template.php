<div class="qode-pricing-calculator" <?php echo qode_get_inline_style($holder_style); ?>>
	<div class="qode-pricing-calculator-items" <?php echo qode_get_inline_style($left_section_style); ?>>
		<?php foreach($pricing_items as $pricing_item) : ?>
			<div class="qode-pricing-calculator-item" data-price="<?php echo esc_attr($pricing_item['item_price']); ?>">
				<div class="qode-pricing-calculator-switcher-holder">
					<label class="qode-pricing-calculator-switch">
						<input type="checkbox" <?php echo qode_check_is_pricing_calculator_item_checked($pricing_item['item_active']); ?>>
						<span class="qode-pricing-calculator-slider"></span>
					</label>
				</div>
				<div class="qode-pricing-calculator-title-holder">
					<<?php echo esc_attr($title_tag); ?>>
						<?php echo esc_attr($pricing_item['item_title']); ?>
					</<?php echo esc_attr($title_tag); ?>>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
	<div class="qode-pricing-calculator-text-holder" <?php echo qode_get_inline_style($right_section_style); ?>>
		<span class="qode-pricing-calculator-total-price-holder">
			<span class="qode-pricing-calculator-total-price-currency"><?php echo esc_attr($currency); ?></span><!-- This comments is to remove empty space between elements
			--><span class="qode-pricing-calculator-total-price"><?php echo esc_attr($total_price); ?></span>
		</span>
		<?php if($subtitle): ?>
			<<?php echo esc_attr($subtitle_title_tag); ?> class="qode-pricing-calculator-subtitle">
				<?php echo esc_attr($subtitle); ?>
			</<?php echo esc_attr($subtitle_title_tag); ?>>
		<?php endif; ?>
		<?php if($text): ?>
			<p class="qode-pricing-calculator-text"><?php echo esc_attr($text); ?></p>
		<?php endif; ?>
		<?php if($enable_button): ?>
			<span class="qode-pricing-calculator-button-holder">
				<a itemprop="url" class="qbutton green qode-qbutton-full-width" href="<?php echo esc_url($button_link); ?>" target="<?php echo esc_attr($button_target); ?>"><?php echo esc_attr($button_text); ?></a>
			</span>
		<?php endif; ?>
	</div>
</div>