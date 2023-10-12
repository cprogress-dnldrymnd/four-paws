<?php

if (post_password_required()) {
	echo get_the_password_form();
} else {
	$excerpt_length = isset($params['excerpt_length']) ? $params['excerpt_length'] : '';
	$excerpt        = academist_elated_excerpt($excerpt_length);

	$link_page_exists = apply_filters('academist_elated_filter_single_links_exists', '');

	if (!empty($excerpt) && empty($link_page_exists)) { ?>
		<div class="eltdf-post-excerpt-holder">
			<p itemprop="description" class="eltdf-post-excerpt">
				<?php echo wp_kses_post($excerpt); ?>
			</p>
		</div>
	<?php }

	?>
	<div class="button-box">
		<a itemprop="url" href="<?= get_the_permalink() ?>" target="_self" class="eltdf-btn eltdf-btn-medium eltdf-btn-solid eltdf-btn-arrow">
			<span class="eltdf-btn-text">Our Courses</span>
		</a>
	</div>
<?php
} ?>