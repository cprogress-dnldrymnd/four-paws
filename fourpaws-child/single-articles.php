<?php
get_header();
academist_elated_get_title();
get_template_part('slider');
do_action('academist_elated_action_before_main_content');

if (have_posts()) : while (have_posts()) : the_post();
		//Get blog single type and load proper helper
		academist_elated_include_blog_helper_functions('singles', 'standard');

		//Action added for applying module specific filters that couldn't be applied on init
		do_action('academist_elated_action_blog_single_loaded');

		//Get classes for holder and holder inner
		$eltdf_holder_params = academist_elated_get_holder_params_blog();
?>

		<div class="<?php echo esc_attr($eltdf_holder_params['holder']); ?>">

			<div class="<?php echo esc_attr($eltdf_holder_params['inner']); ?>">

				<div class="eltdf-grid-row eltdf-content-has-sidebar eltdf-grid-medium-gutter">
					<div class="eltdf-page-content-holder eltdf-grid-col-8">
						<div class="eltdf-blog-holder eltdf-blog-single eltdf-blog-single-standard">
							<?php do_action('single_featured_image'); ?>

							<?php academist_elated_get_blog_single_type($blog_single_type); ?>
						</div>
					</div>
					<div class="eltdf-sidebar-holder eltdf-grid-col-4">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>

			<?php do_action('academist_elated_action_before_container_close'); ?>
		</div>
<?php endwhile;
endif;

get_footer(); ?>