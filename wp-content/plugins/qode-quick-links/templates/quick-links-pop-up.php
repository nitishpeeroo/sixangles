<div class="qode-quick-links-pop-up">
	<div class="qode-quick-links-heading">
		<div class="qode-quick-links-heading-title">
			<?php if(isset($title_image) && $title_image) { ?>
				<img src="<?php echo esc_url($title_image); ?>" alt="<?php esc_html_e('Title Image', 'qode-quick-links') ?>" />
			<?php } ?>
			<?php if($title) { ?>
				<h6 class="qode-quick-links-heading-title-text"><?php echo esc_attr($title); ?></h6>
			<?php } ?>
		</div>
		<div class="qode-quick-links-pop-up-close-holder">
			<span class="qode-quick-links-pop-up-close">
				<i class="fa fa-times" aria-hidden="true"></i>
			</span>
		</div>
	</div>
	<?php if($ql_query->have_posts()): ?>
	<div class="qode-quick-links-items">
			<?php while($ql_query->have_posts()):  $ql_query->the_post(); ?>
				<div class="qode-quick-links-item">
					<?php
						$class = 'qode-quick-links-link';
						if(get_post_meta(get_the_ID(), 'qode_quick_link_link_anchor', true) == 'yes'){
							$class .= ' anchor';
						}
					?>
					<?php if(get_post_meta(get_the_ID(), 'qode_quick_link_link', true) != '') { ?>
						<a href="<?php echo get_post_meta(get_the_ID(), 'qode_quick_link_link', true); ?>" class="<?php echo esc_attr($class); ?>"></a>
					<?php } ?>
					<h6 class="qode-quick-links-item-title">
						<?php if($label = get_post_meta(get_the_ID(), 'qode_quick_link_highlighted_label', true)){ ?>
							<span class="qode-quick-links-highlighted-label"><?php echo esc_attr($label); ?></span>
						<?php } ?>
						<?php the_title(); ?>
					</h6>
					<?php if($text = get_post_meta(get_the_ID(), 'qode_quick_link_text', true)){ ?>
						<p><?php print $text; ?></p>
					<?php } ?>
				</div>
			<?php endwhile; ?>
	</div>
	<?php endif; ?>
</div>