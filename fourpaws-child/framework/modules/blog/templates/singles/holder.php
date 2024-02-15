<div class="eltdf-grid-row <?php echo esc_attr($holder_classes); ?>">
	<div <?php echo academist_elated_get_content_sidebar_class(); ?>>
		<div class="eltdf-blog-holder eltdf-blog-single <?php echo esc_attr($blog_single_classes); ?>">
			<?php academist_elated_get_blog_single_type($blog_single_type); ?>
		</div>
	</div>
	<?php if ($sidebar_layout !== 'no-sidebar' || get_post_type() == 'articles') { ?>
		<div class="eltdf-sidebar-holder eltdf-grid-col-4" <?php //echo academist_elated_get_sidebar_holder_class(); ?>>
			<?php get_sidebar(); ?>
		</div>
	<?php } ?>
</div>