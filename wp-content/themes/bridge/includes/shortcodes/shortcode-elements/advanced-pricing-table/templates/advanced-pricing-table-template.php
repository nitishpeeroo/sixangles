<div class="qode-advanced-pricing-table">
	<div class="qode-apt-header qode-apt-row">
		<div class="qode-apt-title-holder">
			<<?php echo esc_attr($title_tag); ?> class="qode-apt-title">
				<?php echo esc_attr($table_title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		</div>
		<div class="qode-apt-column-title-holder">
			<<?php echo esc_attr($title_tag); ?> class="qode-apt-title">
				<?php echo esc_attr($column_title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		</div>
	</div>
	<?php foreach($pricing_items as $pricing_item):?>
		<div class="qode-apt-items qode-apt-row">
			<div class="qode-apt-item-title">
				<?php echo esc_attr($pricing_item['item_title']); ?>
			</div>
			<div class="qode-apt-item-price">
				<?php echo esc_attr($currency); ?><?php echo esc_attr($pricing_item['item_price']); ?>
			</div>
		</div>
	<?php endforeach; ?>
		<?php if($table_footer_text != '' || $table_footer_image) : ?>
			<div class="qode-apt-footer qode-apt-row">
				<div class="qode-apt-column-footer-image">
					<img src="<?php echo wp_get_attachment_url($table_footer_image) ?>" alt="" />
				</div>
				<?php if($table_footer_text != '') : ?>
					<div class="qode-apt-column-footer-text">
						<span class="qode-apt-footer-text">
							<?php echo esc_attr($table_footer_text); ?>
						</span>
					</div>
				<?php endif; ?>
			</div>
		<?php endif; ?>
</div>