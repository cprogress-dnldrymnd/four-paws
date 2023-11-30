<?php

/*** Child Theme Function  ***/
if (!function_exists('academist_elated_child_theme_enqueue_scripts')) {
	function academist_elated_child_theme_enqueue_scripts()
	{
		$parent_style = 'academist-elated-default-style';

		wp_enqueue_style('academist-elated-child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));

		wp_enqueue_style('academist-elated-swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css');
		wp_enqueue_script('academist-elated-swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js');
	}

	add_action('wp_enqueue_scripts', 'academist_elated_child_theme_enqueue_scripts');
}
/*-----------------------------------------------------------------------------------*/
/* Register Carbofields
/*-----------------------------------------------------------------------------------*/
add_action('carbon_fields_register_fields', 'tissue_paper_register_custom_fields');
function tissue_paper_register_custom_fields()
{
	require_once('includes/post-meta.php');
}
require_once('includes/post-types.php');
require_once('includes/shortcodes.php');
require_once('includes/courses.php');

function get__post_meta($value)
{
	if (function_exists('carbon_get_the_post_meta')) {
		return carbon_get_the_post_meta($value);
	} else {
		return 'Error: Carbonfield not activated';
	}
}

function get__term_meta($term_id, $value)
{
	if (function_exists('carbon_get_term_meta')) {
		return carbon_get_term_meta($term_id, $value);
	} else {
		return 'Error: Carbonfield not activated';
	}
}

function get__post_meta_by_id($id, $value)
{
	if (function_exists('carbon_get_post_meta')) {
		return carbon_get_post_meta($id, $value);
	} else {
		return 'Error: Carbonfield not activated';
	}
}
function get__theme_option($value)
{
	if (function_exists('carbon_get_theme_option')) {
		return carbon_get_theme_option($value);
	} else {
		return 'Error: Carbonfield not activated';
	}
}


function action_wp_footer()
{
?>
	<script>
		var swiper = new Swiper(".mySwiperHero", {
			speed: 500,
			autoplay: {
				delay: 5000,
				disableOnInteraction: false,
			},
			pagination: {
				el: ".swiper-pagination",
				clickable: true
			},
			loop: true,
			on: {
				slideChange: function() {
					//$count = jQuery('.progress').attr('count');
					//$index = this.realIndex + 1;
					//$per_progress = 100 / $count;
					jQuery('.progress').removeClass('animate');
					setTimeout(function() {
						jQuery('.progress').addClass('animate');
					}, 500);

				},
				init: function() {
					jQuery('.progress').addClass('animate');
				},

			}
		});
	</script>
<?php
}

add_action('wp_footer', 'action_wp_footer');

add_filter('get_comment_author', 'wpse_use_user_real_name', 10, 3);

//use registered commenter first and/or last names if available
function wpse_use_user_real_name($author, $comment_id, $comment)
{

	$firstname = '';
	$lastname = '';

	//returns 0 for unregistered commenters
	$user_id = $comment->user_id;

	if ($user_id) {

		$user_object = get_userdata($user_id);

		$firstname = $user_object->user_firstname;

		$lastname = $user_object->user_lastname;
	}

	if ($firstname || $lastname) {

		$author = $firstname . ' ' . $lastname;

		//remove blank space if one of two names is missing
		$author = trim($author);
	}

	return $author;
}

//blog functions
function post_category($class = '', $id = '')
{
	ob_start();
	$post_id = $id ? $id : get_the_ID();
	$category = get_the_terms($post_id, 'category');
?>
	<div class="post-category <?= $class ?>">
		<?php foreach ($category as $categ) { ?>
			<span>
				<?= $categ->name ?>
			</span>
		<?php } ?>
	</div>
	<?php
	return ob_get_clean();
}






function action_academist_elated_action_before_main_content()
{
	if (is_post_type_archive('instructor')) {
	?>
		<div class="top-section">
			<div class="eltdf-container">
				<div class="eltdf-container-inner clearfixr">
					<h2 class="with-line">
						Our Locations
					</h2>
					<div class="desc">
						<p>
							Working with animals is of course a dream job for so many people, and congratulations on taking your first. Working with animals is of course a dream job for so many people, and congratulations on taking your first.
						</p>
					</div>
				</div>
			</div>
		</div>
	<?php
	}
}

add_action('academist_elated_action_before_main_content', 'action_academist_elated_action_before_main_content');


add_filter('gettext', 'translate_text', 999);
add_filter('ngettext', 'translate_text', 999);
function translate_text($translated)
{
	$words = array(
		// 'word to translate' => 'translation'
		'Academist' => 'Four Paws',
		'Academist LMS' => 'Four Paws LMS',
		'Elated' => 'Four Paws'
	);
	$translated = str_ireplace(array_keys($words), $words, $translated);
	return $translated;
}

function action_admin_head()
{
	?>
	<style>
		#toplevel_page_academist_lms_menu a>.wp-menu-name {
			font-size: 0;
		}

		#toplevel_page_academist_lms_menu a>.wp-menu-name:before {
			content: 'Four Paws LMS';
			font-size: 14px;
		}
	</style>
	<?php
	if (get_current_user_id() != 1) {
	?>
		<style>
			#toplevel_page_academist_core_dashboard,
			#eltdf-meta-box-general_meta,
			#eltdf-meta-box-sidebar_meta,
			#eltdf-meta-box-logo_meta,
			#eltdf-meta-box-logo_meta,
			#eltdf-meta-box-header_meta,
			#eltdf-meta-box-footer_meta,
			#eltdf-meta-box-content_bottom_meta {
				display: none !important;
			}
		</style>
<?php
	}
}

add_action('admin_head', 'action_admin_head');



function check_values($post_ID, $post_after, $post_before)
{
	// check the slug and run an update if necessary 
	if ($post_after->post_name != $post_before->post_name) {
		$new_slug = sanitize_title($post_after->post_title);

		wp_update_post(
			array(
				'ID'        => $post_ID,
				'post_name' => $new_slug
			)
		);
	}
}

add_action('save_post', 'check_values', 10, 3);
