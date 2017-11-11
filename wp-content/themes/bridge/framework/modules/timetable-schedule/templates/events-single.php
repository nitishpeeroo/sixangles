<div class="qode-ttevents-single">
	<?php if(has_post_thumbnail()) : ?>
		<div class="qode-ttevents-single-image-holder">
			<?php the_post_thumbnail('full'); ?>
		</div>
	<?php endif; ?>

	<div class="qode-ttevents-single-holder">
		<h2 class="qode-ttevents-single-title"><?php the_title(); ?></h2>
		<h5 class="qode-ttevents-single-subtitle"><?php echo esc_html($subtitle);?></h5>

		<div class="qode-ttevents-single-content">
			<?php the_content(); ?>
		</div>
	</div>
</div>