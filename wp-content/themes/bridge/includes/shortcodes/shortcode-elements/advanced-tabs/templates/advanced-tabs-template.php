<div class="qode-advanced-tabs <?php echo esc_attr($tab_class); ?> clearfix">
	<ul class="qode-advanced-tabs-nav">
		<?php foreach ($tabs_titles as $tab_title) { ?>
			<li>
				<<?php echo esc_attr($title_tag) ?>>
					<a href="#tab-<?php echo sanitize_title($tab_title)?>">
						<?php if($icons_in_title) { ?>
							<span class="qode-advanced-icon-frame"></span>
						<?php } ?>

						<?php if($tab_title !== '' && strpos($tab_class,'qode-advanced-tab-only-icon') == false) { ?>
							<span class="qode-advanced-tab-text-after-icon">
								<?php echo esc_attr($tab_title)?>
							</span>
						<?php } ?>
					</a>
				</<?php echo esc_attr($title_tag) ?>>
			</li>
		<?php } ?>
	</ul>
	<?php echo do_shortcode($content); ?>
</div>