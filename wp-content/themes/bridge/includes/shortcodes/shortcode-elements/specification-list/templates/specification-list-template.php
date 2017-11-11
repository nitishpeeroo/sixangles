<div class="qode-specification-list">
	<?php if($image != '') : ?>
		<div class="qode-specification-list-image">
			<img src="<?php echo wp_get_attachment_url($image) ?>" alt="" />
		</div>
	<?php endif; ?>
	<div class="qode-specification-list-text-holder">
		<<?php echo esc_attr($title_tag); ?> class="qode-specification-list-title">
			<?php echo esc_attr($title); ?>
		</<?php echo esc_attr($title_tag); ?>>
		<div class="qode-specification-list-items">
			<?php foreach($list_items as $list_items):?>
				<div class="qode-specification-list-item">
					<span class="qode-specification-list-item-label">
						<?php echo esc_attr($list_items['label']); ?>
					</span>
					<span class="qode-specification-list-item-value">
						<?php echo esc_attr($list_items['value']); ?>
					</span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
	<?php if($enable_button): ?>
		<div class="qode-specification-list-holder">
			<a itemprop="url" class="qode-qbutton-main-color qode-qbutton-full-width qode-qbutton-square" href="<?php echo esc_url($button_link); ?>" target="<?php echo esc_attr($button_target); ?>" <?php echo qode_get_inline_style($button_style); ?>><span><?php echo esc_attr($button_text); ?></span></a>
		</div>
	<?php endif; ?>
</div>