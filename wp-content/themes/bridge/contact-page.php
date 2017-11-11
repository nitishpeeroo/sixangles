<?php 
/*
Template Name: Contact Page
*/ 
?>

<?php
global $wp_query;
$id = $wp_query->get_queried_object_id();
get_header();

$hide_contact_form_website = "";
if (isset($qode_options_proya['hide_contact_form_website'])) $hide_contact_form_website = $qode_options_proya['hide_contact_form_website'];

if(get_post_meta($id, "qode_page_background_color", true) != ""){
	$background_color = get_post_meta($id, "qode_page_background_color", true);
}else{
	$background_color = "";
}

if($qode_options_proya['enable_google_map'] == "yes"){
	$container_class= " full_map";
} else {
	$container_class= "";
}
$show_section = "yes";
if(isset($qode_options_proya['section_between_map_form'])) {
	$show_section = $qode_options_proya['section_between_map_form'];
}
$map_form_section_position = "center";
$map_form_section_position_class = " contact_section_position_center";
if(isset($qode_options_proya['section_between_map_form_position']) && $qode_options_proya['section_between_map_form_position'] != "") {
	$map_form_section_position = $qode_options_proya['section_between_map_form_position'];
	$map_form_section_position_class = " contact_section_position_" . $qode_options_proya['section_between_map_form_position'];
}

$content_style_spacing = "";
if(get_post_meta($id, "qode_margin_after_title", true) != ""){
	if(get_post_meta($id, "qode_margin_after_title_mobile", true) == 'yes'){
		$content_style_spacing = "padding-top:".esc_attr(get_post_meta($id, "qode_margin_after_title", true))."px !important";
	}else{
		$content_style_spacing = "padding-top:".esc_attr(get_post_meta($id, "qode_margin_after_title", true))."px";
	}
}

?>
	
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
			
		<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
			<script>
			var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
			</script>
		<?php } ?>
		
		<?php get_template_part( 'title' ); ?>
		<?php if($qode_options_proya['enable_google_map'] == "yes"){ ?>
			<div class="google_map_holder">
				<?php
					$google_maps_scroll_wheel = false;
					if(isset($qode_options_proya['google_maps_scroll_wheel'])){
						if ($qode_options_proya['google_maps_scroll_wheel'] == "yes")
							$google_maps_scroll_wheel = true;
					}
					if(!$google_maps_scroll_wheel){
				?>
					<div class="google_map_ovrlay"></div>
				<?php } ?>
				<div class="google_map" id="map_canvas"></div>
			</div>
		<?php } ?>
		<div class="container"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
		<div class="container_inner<?php echo $container_class; ?> default_template_holder clearfix"  <?php qode_inline_style($content_style_spacing); ?>>
				<div class="contact_detail">
					<?php if($show_section == "yes") { ?>
						<div class="contact_section<?php echo $map_form_section_position_class; ?>">
							<h2><?php if(isset( $qode_options_proya['contact_section_above_form_title']) && $qode_options_proya['contact_section_above_form_title'] != "") { 
							echo $qode_options_proya['contact_section_above_form_title'];  } else { ?><?php _e('Get in touch with us', 'qode'); ?><?php } ?></h2>
							<div class="separator small <?php echo $map_form_section_position; ?>"></div>
							<h4><?php if(isset( $qode_options_proya['contact_section_above_form_subtitle']) && $qode_options_proya['contact_section_above_form_subtitle'] != "") { 
							echo $qode_options_proya['contact_section_above_form_subtitle'];  } else { ?><?php _e('Say Hello! Don’t be shy.', 'qode'); ?><?php } ?></h4>
						</div>
					<?php } ?>
					<?php if($qode_options_proya['enable_contact_form'] == "yes"){ ?>
					<div class="two_columns_33_66 clearfix grid2">
						<div class="column1">
							<div class="column_inner">
								<div class="contact_info">
									<?php the_content(); ?>
								</div>	
							</div>
						</div>
						<div class="column2">
							<div class="column_inner">
								<div class="contact_form">
									<h5><?php if($qode_options_proya['contact_heading_above'] != "") { echo $qode_options_proya['contact_heading_above'];  } else { ?><?php _e('Contact Us', 'qode'); ?><?php } ?></h5>
									<form id="contact-form" method="post" class="qode-contact-form-contact-template" action="" data-required-message = "<?php _e('This is a required field', 'qode'); ?>" data-wrong-email-message = "<?php _e('Please enter a valid email address.', 'qode'); ?>">
										<div class="two_columns_50_50 clearfix">
											<div class="column1">
												<div class="column_inner">
													<input type="text" class="requiredField" name="fname" id="fname" value="" placeholder="<?php _e('First Name *', 'qode'); ?>" />
													
												</div>
											</div>
											<div class="column2">
												<div class="column_inner">
													<input type="text" class="requiredField" name="lname" id="lname" value="" placeholder="<?php _e('Last Name *', 'qode'); ?>" />
												</div>
											</div>
										</div>
										<?php if ($hide_contact_form_website == "yes") { ?>
											<div class="website_field_holder">
												<input type="text" class="requiredField email" name="email" id="email" value="" placeholder="<?php _e('Email *', 'qode'); ?>" />
												<input type="hidden" name="website" id="website" value="" />
											</div>

										<?php } else { ?>
										<div class="two_columns_50_50 clearfix">
											<div class="column1">
												<div class="column_inner">
													<input type="text" class="requiredField email" name="email" id="email" value="" placeholder="<?php _e('Email *', 'qode'); ?>" />
													
												</div>
											</div>
											<div class="column2">
												<div class="column_inner">
													<input type="text" name="website" id="website" value="" placeholder="<?php _e('Website', 'qode'); ?>" />
												</div>
											</div>
										</div>
										<?php }?>
										<textarea name="message" id="message" rows="10" placeholder="<?php _e('Message', 'qode'); ?>"></textarea>
										<?php if(qode_options()->getOptionValue('use_recaptcha') && qode_options()->getOptionValue('recaptcha_public_key') != '') { ?>
											<div id="qode-captcha-element-holder" data-sitekey="<?php echo qode_options()->getOptionValue('recaptcha_public_key'); ?>"></div>
										<?php } ?>
										<span class="submit_button_contact">
											<input class="qbutton contact_form_button" type="submit" value="<?php _e('Contact Us', 'qode'); ?>" />
										</span>
									</form>	
								</div>
	
							</div>
						</div>
					</div>
					<?php }  else { ?>
						<div class="contact_info">
							<?php the_content(); ?>
						</div>
					<?php } ?>
				</div>	
		</div>	
	</div>	
		
<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>			