<div class="qode-sliding-image-holder">
	<div class="qode-sih-image-holder" style="background-image:url(<?php echo wp_get_attachment_url($image); ?>)">
		<img class="qode-sliding-image-background-image" src="<?php echo wp_get_attachment_url($image); ?>" alt="<?php esc_html_e('Sliding Image', 'qode') ?>" />
		<img class="qode-sliding-image-background-image qode-aux-background-image" src="<?php echo wp_get_attachment_url($image); ?>" alt="<?php esc_html_e('Sliding Image', 'qode') ?>" />
	</div>
	<?php echo do_shortcode($content); ?>
</div>