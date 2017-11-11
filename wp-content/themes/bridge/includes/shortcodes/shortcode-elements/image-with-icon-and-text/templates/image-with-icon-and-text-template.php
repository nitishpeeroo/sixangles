<div class="qode-image-with-icon-and-text">
    <div class="qode-iwiat-image-icon-holder" <?php echo qode_get_inline_style($image_style); ?>>
		<?php if($image != '') : ?>
			<div class="qode-iwiat-image">
				<img src="<?php echo wp_get_attachment_url($image) ?>" alt="" />
			</div>
		<?php endif; ?>
		<div class="qode-iwiat-icon-holder">
			<span <?php qode_class_attribute($holder_classes); ?>  <?php echo qode_get_inline_style($icon_style); ?>>
				<?php qode_icon_collections()->renderIconHTML($icon, $icon_pack, array('icon_attributes' => array('class' => 'qode-icon-element'))); ?>
			</span>
		</div>
	</div>
	<?php if($title != '') : ?>
		<<?php echo esc_attr($title_tag); ?> class="qode-iwiat-title">
			<?php echo esc_attr($title); ?>
		</<?php echo esc_attr($title_tag); ?>>
	<?php endif; ?>
	<?php if($text != '') : ?>
		<p class="qode-iwiat-text">
			<?php echo esc_attr($text); ?>
		</p>
	<?php endif; ?>
</div>