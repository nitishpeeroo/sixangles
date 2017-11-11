<?php
/**
 * Eliptic Slider shortcode template
 */
?>

<div class="qode-elliptical-slide" <?php echo qode_get_inline_style($background_image)?>>
    <div class="qode-elliptical-slide-image-holder-wrapper" <?php echo qode_get_inline_style($image_holder_background)?>>
        <span class="qode-elliptical-slide-image-holder">
            <img src="<?php echo esc_url($image); ?>" alt="qode-eliptic-slider"/>
        </span>
    </div>
    <div class="qode-elliptical-slide-content-holder" <?php echo qode_get_inline_style($background_style); ?>>
        <div class="qode-elliptical-slide-content-holder-inner grid_section">
            <div class="qode-elliptical-slide-content-wrapper section_inner">
                <div class="qode-elliptical-slide-wrapper-inner">
					<div class="qode-elliptical-slide-svg-holder">
						<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="92.296px" height="485px" viewBox="0 0 92.296 492" enable-background="new 0 0 92.296 492" preserveAspectRatio="none">
							<path <?php echo qode_get_inline_style($svg_style); ?> d="M91.621,0H0v492h92.296C47.988,426.806,21,340.351,21,245.5C21,151.133,47.716,65.078,91.621,0z"/>
						</svg>
					</div>
                    <div class="qode-elliptical-slide-elements-holder">

						<?php echo do_shortcode($content); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>