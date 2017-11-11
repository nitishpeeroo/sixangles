<?php
global $wp_query;
global $qode_options_proya;
$id = $wp_query->get_queried_object_id();

$sidebar = get_post_meta($id, "qode_show-sidebar", true);
$default_array = array('default', '');

if(in_array($sidebar, $default_array)){
	$sidebar = $qode_options_proya['event_single_sidebar_layout'];
}

if(get_post_meta($id, "qode_page_background_color", true) != ""){
	$background_color = get_post_meta($id, "qode_page_background_color", true);
}else{
	$background_color = "";
}

$content_style_spacing = "";
if(get_post_meta($id, "qode_margin_after_title", true) != ""){
	if(get_post_meta($id, "qode_margin_after_title_mobile", true) == 'yes'){
		$content_style_spacing = "padding-top:".esc_attr(get_post_meta($id, "qode_margin_after_title", true))."px !important";
	}else{
		$content_style_spacing = "padding-top:".esc_attr(get_post_meta($id, "qode_margin_after_title", true))."px";
	}
}

if ( get_query_var('paged') ) { $paged = get_query_var('paged'); }
elseif ( get_query_var('page') ) { $paged = get_query_var('page'); }
else { $paged = 1; }

?>
<?php get_header(); ?>
<?php if(get_post_meta($id, "qode_page_scroll_amount_for_sticky", true)) { ?>
	<script>
		var page_scroll_amount_for_sticky = <?php echo get_post_meta($id, "qode_page_scroll_amount_for_sticky", true); ?>;
	</script>
<?php } ?>
<?php get_template_part( 'title' ); ?>
<?php get_template_part( 'slider' ); ?>
	<div class="container"<?php if($background_color != "") { echo " style='background-color:". $background_color ."'";} ?>>
		<?php if(isset($qode_options_proya['overlapping_content']) && $qode_options_proya['overlapping_content'] == 'yes') {?>
		<div class="overlapping_content"><div class="overlapping_content_inner">
				<?php } ?>
				<div class="container_inner default_template_holder clearfix page_container_inner" <?php qode_inline_style($content_style_spacing); ?>>
					<?php if(($sidebar == "default")||($sidebar == "")) : ?>
						<?php if (have_posts()) :
							while (have_posts()) : the_post(); ?>
								<?php  qode_tt_event_single_content();?>
							<?php endwhile; ?>
						<?php endif; ?>
					<?php elseif($sidebar == "1" || $sidebar == "2"): ?>

					<?php if($sidebar == "1") : ?>
					<div class="two_columns_66_33 background_color_sidebar grid2 clearfix">
						<div class="column1">
							<?php elseif($sidebar == "2") : ?>
							<div class="two_columns_75_25 background_color_sidebar grid2 clearfix">
								<div class="column1">
									<?php endif; ?>
									<?php if (have_posts()) :
										while (have_posts()) : the_post(); ?>
											<div class="column_inner">
												<?php  qode_tt_event_single_content();?>
											</div>
										<?php endwhile; ?>
									<?php endif; ?>


								</div>
								<div class="column2"><?php get_sidebar();?></div>
							</div>
							<?php elseif($sidebar == "3" || $sidebar == "4"): ?>
							<?php if($sidebar == "3") : ?>
							<div class="two_columns_33_66 background_color_sidebar grid2 clearfix">
								<div class="column1"><?php get_sidebar();?></div>
								<div class="column2">
									<?php elseif($sidebar == "4") : ?>
									<div class="two_columns_25_75 background_color_sidebar grid2 clearfix">
										<div class="column1"><?php get_sidebar();?></div>
										<div class="column2">
											<?php endif; ?>
											<?php if (have_posts()) :
												while (have_posts()) : the_post(); ?>
													<?php  qode_tt_event_single_content();?>
												<?php endwhile; ?>
											<?php endif; ?>
										</div>

									</div>
									<?php endif; ?>
								</div>
								<?php if(isset($qode_options_proya['overlapping_content']) && $qode_options_proya['overlapping_content'] == 'yes') {?>
							</div></div>
						<?php } ?>
					</div>
<?php get_footer(); ?>