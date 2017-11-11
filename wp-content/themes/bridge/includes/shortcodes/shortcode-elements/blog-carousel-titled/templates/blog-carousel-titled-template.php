<div class="qode-blog-carousel-titled" <?php echo qode_get_inline_attrs($holder_data); ?>>
	<div class="qode-bct-title-holder" <?php echo qode_get_inline_style($title_style); ?>>
		<a class="qode-bct-caroufredsel-prev" href="#">
			<span class="qode-bct-caroufredsel-nav-inner">
				<span class="qode-bct-caroufredsel-nav-icon-holder">
					<span class="arrow_carrot-left"></span>
				</span>
			</span>
		</a>
			<?php if($title): ?>
					<<?php echo esc_attr($title_tag); ?>>
						<?php echo esc_attr($title); ?>
					</<?php echo esc_attr($title_tag); ?>>
			<?php endif; ?>
	<a class="qode-bct-caroufredsel-next" href="#">
		<span class="qode-bct-caroufredsel-nav-inner">
			<span class="qode-bct-caroufredsel-nav-icon-holder">
				<span class="arrow_carrot-right"></span>
			</span>
		</span>
	</a>
	</div>
	<?php if($blog_query->have_posts()): ?>
		<div class="qode-bct-posts-holder">
		<div class="qode-bct-posts">
			<?php while($blog_query->have_posts()): ?>
				<?php $blog_query->the_post(); ?>
					<div class="qode-bct-post">
						<?php if(has_post_thumbnail()) : ?>
							<div class="qode-bct-post-image">
								<a href="<?php the_permalink() ?>" itemprop="url">
									<?php the_post_thumbnail($thumb_size); ?>
								</a>
							</div>
						<?php endif; ?>
						<div class="qode-bct-post-text">
							<<?php echo esc_attr($posts_title_tag); ?> class="qode-bct-post-title entry_title" itemprop="name">
								<a href="<?php the_permalink() ?>" itemprop="url"><?php the_title(); ?></a>
							</<?php echo esc_attr($posts_title_tag); ?>>
							<?php $excerpt = ($params['excerpt_length'] !== '' && $params['excerpt_length'] > 0) ? substr(get_the_excerpt(), 0, intval($params['excerpt_length'])).'...' : get_the_excerpt(); ?>
							<p itemprop="description" class = "qode-bct-post-excerpt"> <?php print $excerpt ?></p>
							<div class="qode-bct-post-date entry_date updated" itemprop="dateCreated">
								<?php the_time(get_option('date_format')); ?>
								<meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(qode_get_page_id()); ?>"/>
							</div>
						</div>
					</div>
			<?php endwhile; ?>
		</div>
		</div>
	<?php endif; ?>
</div>