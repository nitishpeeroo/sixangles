<div class="qode-inter-page-navigation-holder">
	<?php if($in_grid == 'yes') { ?>
		<div class="container">
			<div class="container_inner">
	<?php } ?>
	<div class="qode-inter-page-navigation-inner">

		<div class="qode-inter-page-navigation-prev">
			<?php if(isset($prev_id) && $prev_id !='') { ?>
				<div class="qode-inter-page-navigation-prev-inner">
					<div class="qode-ipn-arrow">
						<a href="<?php echo get_the_permalink($prev_id) ?>" <?php qode_class_attribute($arrows_gradient_class); ?>>
							<span class="arrow_carrot-left qode-ipn-icon"></span>
						</a>
					</div>
					<div class="qode-inter-page-title">
						<a href="<?php echo get_the_permalink($prev_id) ?>">
						<h4><?php echo get_the_title($prev_id); ?></h4>
						<span><?php esc_html_e('Previous page') ?></span>
						</a>
					</div>
				</div>
			<?php } ?>
		</div>
		<?php if(isset($back_page_id)) { ?>
			<div class="qode-inter-page-navigation-back-link">
				<div class="qode-inter-page-navigation-back-link-inner <?php echo esc_attr($back_gradient_class); ?>">
					<a href="<?php echo get_the_permalink($back_page_id) ?>">
						<span><?php esc_html_e('Back') ?></span>
					</a>
				</div>
			</div>
		<?php } ?>
		<div class="qode-inter-page-navigation-next">
			<?php if(isset($next_id) && $next_id !='') { ?>
			<div class="qode-inter-page-navigation-next-inner">
				<div class="qode-inter-page-title">
					<a href="<?php echo get_the_permalink($next_id) ?>">
						<h4><?php echo get_the_title($next_id); ?></h4>
						<span><?php esc_html_e('Next page') ?></span>
					</a>
				</div>
				<div class="qode-ipn-arrow">
					<a href="<?php echo get_the_permalink($next_id) ?>" <?php qode_class_attribute($arrows_gradient_class); ?>>
						<span class="arrow_carrot-right qode-ipn-icon"></span>
					</a>
				</div>
			</div>
			<?php } ?>
		</div>

	</div>
	<?php if($in_grid == 'yes') { ?>
			</div>
		</div>
	<?php } ?>
</div>