<?php do_action('academist_elated_action_before_page_title'); ?>
<?php
if (is_archive()) {
	$title = get_the_archive_title();
	if ($title == 'Archives: <span>Academist Courses</span>') {
		$title = 'Courses';
	}
	if ($title == 'Archives: <span>Locations</span>') {
		$title = 'Locations';
	}
} else {
	$title = $title;

	if (get_post_type() == 'course' || get_post_type() == 'post') {
		$title = get_the_title();
	}

}
?>

<div class="eltdf-title-holder <?php echo esc_attr($holder_classes); ?>" <?php academist_elated_inline_style($holder_styles); ?> <?php echo academist_elated_get_inline_attrs($holder_data); ?>>
	<?php if (!empty($title_image)) { ?>
		<div class="eltdf-title-image">
			<img itemprop="image" src="<?php echo esc_url($title_image['src']); ?>" alt="<?php echo esc_attr($title_image['alt']); ?>" />
		</div>
	<?php } ?>
	<div class="eltdf-title-wrapper" <?php academist_elated_inline_style($wrapper_styles); ?>>
		<div class="eltdf-title-inner">
			<div class="eltdf-grid">
				<div class="eltdf-title-info">
					<?php if (!empty($title)) { ?>
						<<?php echo esc_attr($title_tag); ?> class="eltdf-page-title entry-title" <?php academist_elated_inline_style($title_styles); ?>><?php echo $title ?></<?php echo esc_attr($title_tag); ?>>
					<?php } ?>
					<?php if (!empty($subtitle)) { ?>
						<<?php echo esc_attr($subtitle_tag); ?> class="eltdf-page-subtitle" <?php academist_elated_inline_style($subtitle_styles); ?>><?php echo esc_html($subtitle); ?></<?php echo esc_attr($subtitle_tag); ?>>
					<?php } ?>
					<div class="eltdf-breadcrumbs-info">
						<?php academist_elated_custom_breadcrumbs(); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php do_action('academist_elated_action_after_page_title'); ?>