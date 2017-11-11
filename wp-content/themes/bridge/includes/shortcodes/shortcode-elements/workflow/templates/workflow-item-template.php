<div class="qode-workflow-item">
    <span class="line" style="<?php echo esc_attr($line_color); ?>"></span>
    <div class="qode-workflow-item-inner <?php echo esc_attr($image_on_right_class) ?>">
        <div class="qode-workflow-image <?php echo esc_attr($image_alignment); ?>">
            <?php if(!empty($image)){
                echo wp_get_attachment_image($image, 'full');
            } ?>
        </div>
        <div class="qode-workflow-text">
            <span class="circle" style="<?php echo esc_attr($circle_border_color.$circle_background_color); ?>"></span>
            <?php if(!empty($title)){ ?>
                <<?php echo esc_attr($title_tag)?>><?php echo esc_attr($title) ?></<?php echo esc_attr($title_tag)?>>
            <?php } ?>
            <?php if(!empty($subtitle)){ ?>
                <<?php echo esc_attr($subtitle_tag)?> class="qode-workflow-subtitle"><?php echo esc_attr($subtitle) ?></<?php echo esc_attr($subtitle_tag)?>>
            <?php } ?>
            <?php if(!empty($text)){ ?>
                <p class="text"><?php echo esc_attr($text) ?></p>
            <?php } ?>
        </div>
    </div>
</div>