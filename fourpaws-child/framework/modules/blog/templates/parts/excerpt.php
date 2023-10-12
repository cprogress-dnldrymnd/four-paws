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
	<div class="eltdf-post-read-more-button">
		<?php
		$button_params = array(
			'type'         => 'simple',
			'link'         => get_the_permalink(),
			'text'         => esc_html__('Read More', 'academist'),
			'custom_class' => 'eltdf-blog-list-button'
		);

		echo academist_elated_return_button_html($button_params);
		?>
	</div>
<?php
} ?>