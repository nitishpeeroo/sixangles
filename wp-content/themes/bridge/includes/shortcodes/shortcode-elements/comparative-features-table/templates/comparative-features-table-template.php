<div class="qode-comparative-features-table qode-cft-<?php echo esc_attr($columns); ?>">
	<div class="qode-cft-header qode-cft-row">
		<div class="qode-cft-title-holder">
			<<?php echo esc_attr($title_tag); ?> class="qode-cft-title">
			<?php echo esc_attr($table_title); ?>
		</<?php echo esc_attr($title_tag); ?>>
	</div>
	<?php if($column_one_title != '') : ?>
	<div class="qode-cft-column-title-holder">
		<<?php echo esc_attr($title_tag); ?> class="qode-cft-title">
		<?php echo esc_attr($column_one_title); ?>
	</<?php echo esc_attr($title_tag); ?>>
</div>
<?php endif; ?>
<?php if($column_two_title != '') : ?>
	<div class="qode-cft-column-title-holder">
	<<?php echo esc_attr($title_tag); ?> class="qode-cft-title">
	<?php echo esc_attr($column_two_title); ?>
	</<?php echo esc_attr($title_tag); ?>>
	</div>
<?php endif; ?>
<?php if($column_three_title != '') : ?>
	<div class="qode-cft-column-title-holder">
	<<?php echo esc_attr($title_tag); ?> class="qode-cft-title">
	<?php echo esc_attr($column_three_title); ?>
	</<?php echo esc_attr($title_tag); ?>>
	</div>
<?php endif; ?>
</div>
<?php foreach($features as $feature_item): ?>
	<div class="qode-cft-feature qode-cft-row">
	<<?php echo esc_attr($feature_title_tag); ?> class="qode-cft-feature-title">
	<?php echo esc_attr($feature_item['feature_title']); ?>
	</<?php echo esc_attr($feature_title_tag); ?>>
	<?php switch($columns):
		case 'one-column': ?>
			<div class="qode-cft-feature-value">
			<<?php echo esc_attr($feature_title_tag); ?> class="qode-cft-feature-item-title-responsive">
			<?php echo esc_attr($feature_item['feature_title']); ?>
			</<?php echo esc_attr($feature_title_tag); ?>>
			<?php echo qode_comparative_feature_table_mark($feature_item['column_one_active']); ?>
			</div>
			<?php break;
		case 'two-columns':	?>
			<div class="qode-cft-feature-value">
			<<?php echo esc_attr($feature_title_tag); ?> class="qode-cft-feature-item-title-responsive">
			<?php echo esc_attr($feature_item['feature_title']); ?>
			</<?php echo esc_attr($feature_title_tag); ?>>
			<?php echo qode_comparative_feature_table_mark($feature_item['column_one_active']); ?>
			</div>
			<div class="qode-cft-feature-value">
			<<?php echo esc_attr($feature_title_tag); ?> class="qode-cft-feature-item-title-responsive">
			<?php echo esc_attr($feature_item['feature_title']); ?>
			</<?php echo esc_attr($feature_title_tag); ?>>
			<?php echo qode_comparative_feature_table_mark($feature_item['column_two_active']); ?>
			</div>
			<?php break;
		default:
			?>
			<div class="qode-cft-feature-value">
			<<?php echo esc_attr($feature_title_tag); ?> class="qode-cft-feature-item-title-responsive">
			<?php echo esc_attr($feature_item['feature_title']); ?>
			</<?php echo esc_attr($feature_title_tag); ?>>
			<?php echo qode_comparative_feature_table_mark($feature_item['column_one_active']); ?>
			</div>
			<div class="qode-cft-feature-value">
			<<?php echo esc_attr($feature_title_tag); ?> class="qode-cft-feature-item-title-responsive">
			<?php echo esc_attr($feature_item['feature_title']); ?>
			</<?php echo esc_attr($feature_title_tag); ?>>
			<?php echo qode_comparative_feature_table_mark($feature_item['column_two_active']); ?>
			</div>
			<div class="qode-cft-feature-value">
			<<?php echo esc_attr($feature_title_tag); ?> class="qode-cft-feature-item-title-responsive">
			<?php echo esc_attr($feature_item['feature_title']); ?>
			</<?php echo esc_attr($feature_title_tag); ?>>
			<?php echo qode_comparative_feature_table_mark($feature_item['column_three_active']); ?>
			</div>
			<?php
			break;
	endswitch; ?>
	</div>
<?php endforeach; ?>
<?php if($column_one_link != '' || $column_two_link != '' || $column_three_link != '') : ?>
	<div class="qode-cft-links qode-cft-row">
		<div class="qode-cft-link-holder">&nbsp;</div>
		<?php if($column_one_link != '') : ?>
			<div class="qode-cft-column-link-holder">
				<a href="<?php echo esc_url($column_one_link) ?>" target="<?php echo esc_attr($column_one_link_target) ?>" class="qode-cft-link">
					<?php echo esc_attr($column_one_link_text); ?>
				</a>
			</div>
		<?php endif; ?>
		<?php if($column_two_link != '') : ?>
			<div class="qode-cft-column-link-holder">
				<a href="<?php echo esc_url($column_two_link) ?>" target="<?php echo esc_attr($column_two_link_target) ?>" class="qode-cft-link">
					<?php echo esc_attr($column_two_link_text); ?>
				</a>
			</div>
		<?php endif; ?>
		<?php if($column_three_link != '') : ?>
			<div class="qode-cft-column-link-holder">
				<a href="<?php echo esc_url($column_three_link) ?>" target="<?php echo esc_attr($column_three_link_target) ?>" class="qode-cft-link">
					<?php echo esc_attr($column_three_link_text); ?>
				</a>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>
<?php if($table_footer_text != '' || $table_footer_image) : ?>
	<div class="qode-cft-footer qode-cft-row">
		<div class="qode-cft-column-footer-image">
			<img src="<?php echo wp_get_attachment_url($table_footer_image) ?>" alt="" />
		</div>
		<?php if($table_footer_text != '') : ?>
			<div class="qode-cft-column-footer-text">
				<p class="qode-cft-footer-text">
					<?php print $table_footer_text; ?>
				</p>
			</div>
		<?php endif; ?>
	</div>
<?php endif; ?>
</div>