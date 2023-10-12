<?php echo academist_lms_get_cpt_shortcode_module_template_part('course', 'course-list', 'parts/image', '', $params); ?>

<div class="eltdf-cli-text-holder">
	<div class="eltdf-cli-text-wrapper">
		<div class="eltdf-cli-text">
			<div class="eltdf-cli-top-info">
				<?php echo academist_lms_get_cpt_shortcode_module_template_part('course', 'course-list', 'parts/title', '', $params); ?>

				<?php if ($enable_instructor == 'yes') {
					//echo academist_lms_get_cpt_shortcode_module_template_part( 'course', 'course-list', 'parts/instructor', '', $params );
				} ?>

				<?php
				do_action('course_meta');
				?>

			</div>
			<?php echo academist_lms_get_cpt_shortcode_module_template_part('course', 'course-list', 'parts/excerpt', '', $params); ?>
			<div class="eltdf-cli-bottom-info d-flex align-items-center">
				<div class="price">
					<?= academist_lms_get_cpt_shortcode_module_template_part('course', 'course-list', 'parts/price', '', $params); ?>
				</div>
				<a itemprop="url" href="<?php the_permalink() ?>" target="_self" style="color: #ffffff;" class="eltdf-btn eltdf-btn-medium eltdf-btn-solid eltdf-btn-arrow button-accent">
					<span class="eltdf-btn-text">Read More</span>
				</a>
			</div>
		</div>
	</div>
</div>