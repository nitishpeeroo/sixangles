<div class="qode-info-card-with-icon">
    <div class="qode-icwi-image-icon-holder qode-start-icon-hover">
		<?php if($link != ''): ?>
			<a href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>">
		<?php endif; ?>
		<?php if($image != '') : ?>
			<div class="qode-icwi-image">
				<img src="<?php echo wp_get_attachment_url($image) ?>" alt="" />
			</div>
		<?php endif; ?>
		<div class="qode-icwi-icon-holder">
			<span <?php qode_class_attribute($holder_classes); ?>  <?php echo qode_get_inline_style($icon_holder_style); ?> <?php echo qode_get_inline_attrs($icon_holder_data); ?>>
				<?php qode_icon_collections()->renderIconHTML($icon, $icon_pack, array('icon_attributes' => array('class' => 'qode-icon-element', 'style'=> $icon_style))); ?>
			</span>
		</div>
		<?php if($link != ''): ?>
			</a>
		<?php endif; ?>
	</div>
	<div class="qode-icwi-text-holder">
		<?php if($title != '') : ?>
			<<?php echo esc_attr($title_tag); ?> class="qode-icwi-title">
				<?php echo esc_attr($title); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php endif; ?>
		<?php if($text != '') : ?>
			<p class="qode-icwi-text">
				<?php echo esc_attr($text); ?>
			</p>
		<?php endif; ?>
	</div>
</div>