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

							<?php academist_elated_get_blog_single_type('standard'); ?>

						</div>
					</div>
					<div class="eltdf-sidebar-holder eltdf-grid-col-4">
						<?php get_sidebar(); ?>
					</div>
				</div>
			</div>

			<div class="eltdf-social-share-holder eltdf-list d-none" id="blog-share">
				<ul>
					<li class="eltdf-linkedin-share"> <a itemprop="url" class="eltdf-share-link" href="#" onclick="popUp=window.open('https://linkedin.com/shareArticle?mini=true&amp;url=https%3A%2F%2Fwww.fourpawsgroomschool.co.uk%2Fsarah-mackay-director-of-four-paws-groom-school-shines-on-channel-5s-dog-behaving-very-badly%2F&amp;title=Sarah+Mackay%2C+Director+of+Four+Paws+Groom+School%2C+Shines+on+Channel+5%26%238217%3Bs+%26%238220%3BDog+Behaving+Very+Badly%26%238221%3B', 'popupwindow', 'scrollbars=yes,width=800,height=400');popUp.focus();return false;"> <span class="eltdf-social-network-icon social_linkedin"></span> </a> </li>
					<li class="eltdf-twitter-share"> <a itemprop="url" class="eltdf-share-link" href="#" onclick="window.open('https://twitter.com/intent/tweet?text=Introduction%3A+In+a+recent+episode+of+Channel+5%26%238217%3Bs+%26%238220%3BDog+Behaving+Very+Badly%2C%26%238221%3B+%28aired+on+Monday+8th+ https://www.fourpawsgroomschool.co.uk/sarah-mackay-director-of-four-paws-groom-school-shines-on-channel-5s-dog-behaving-very-badly/', 'popupwindow', 'scrollbars=yes,width=800,height=400');"> <span class="eltdf-social-network-icon social_twitter"></span> </a> </li>
				</ul>

				<?php echo academist_elated_get_social_share_html(array('type' => $share_type)); ?>
			</div>

			<?php do_action('academist_elated_action_before_container_close'); ?>
		</div>
<?php endwhile;
endif;

get_footer(); ?>

<script>
	jQuery(document).ready(function() {
		jQuery('#blog-share').appendTo('.eltdf-blog-share').removeClass('d-none');
	});
</script>