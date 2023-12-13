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

/*
add_action('after_setup_theme', 'fourpaws_theme_setup');
function fourpaws_theme_setup()
{
	add_theme_support('wc-product-gallery-slider');
	add_theme_support('wc-product-gallery-zoom');
	add_theme_support('wc-product-gallery-lightbox');
}*/
/*-----------------------------------------------------------------------------------*/
/* Register Carbofields
/*-----------------------------------------------------------------------------------*/
add_action('carbon_fields_register_fields', 'tissue_paper_register_custom_fields');
function tissue_paper_register_custom_fields()
{
	require_once('includes/post-meta.php');
}
require_once('includes/quick-edit.php');
require_once('includes/post-types.php');
require_once('includes/shortcodes.php');
require_once('includes/courses.php');
require_once('includes/woocommerce.php');

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
	$location_intro_text = get__theme_option('location_intro_text');
	if (is_post_type_archive('instructor')) {
	?>
		<div class="top-section">
			<div class="eltdf-container">
				<div class="eltdf-container-inner clearfixr">
					<h2 class="with-line">
						Our Locations
					</h2>
					<div class="desc">
						<?= wpautop($location_intro_text) ?>
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

		#eltdf_eltdf_course_instructor_meta,
		#eltdf_eltdf_course_duration_meta,
		#eltdf_eltdf_course_duration_parameter_meta {
			display: none !important;
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


add_filter('get_the_archive_title', function ($title) {
	if (is_category()) {
		$title = single_cat_title('', false);
	} elseif (is_tag()) {
		$title = single_tag_title('', false);
	} elseif (is_author()) {
		$title = '<span class="vcard">' . get_the_author() . '</span>';
	} elseif (is_tax()) { //for custom post types
		$title = sprintf(__('%1$s'), single_term_title('', false));
	} elseif (is_post_type_archive()) {
		$title = post_type_archive_title('', false);
	}
	return $title;
});


function wpdocs_selectively_enqueue_admin_script($hook)
{
	if (isset($_GET['page']) && $_GET['page'] == 'crb_carbon_fields_container_location_settings.php') {
		wp_dequeue_script('simple-locator-admin');
	}
}
add_action('admin_enqueue_scripts', 'wpdocs_selectively_enqueue_admin_script');


function action_excerpt_length($length)
{
	return 0;
}
add_filter('academist_elated_excerpt', 'action_excerpt_length', 99999);


function get__posts($post_type = 'instructor')
{
	$args = array(
		'numberposts' => -1,
		'post_type'   => $post_type
	);
	$locations = get_posts($args);
	$get__posts = array();
	foreach ($locations as $location) {
		$get__posts[$location->ID] = $location->post_title;
	}
	return $get__posts;
}

function get_rc_shortcodes()
{
	$rcblocks = array();

	if (is_single() || is_page()) {
		$posts = get_posts(array(
			'post_type' => 'rc_blocks',
			'fields'          => 'ids', // Only get post IDs
			'posts_per_page'  => -1
		));

		foreach ($posts as $post) {
			$shortcode = '[rcblock id="' . $post . '"]';
			if (strpos(get_the_content(), $shortcode) !== false) {
				$rcblocks[] = $post;
			}
		}
	}
	return $rcblocks;
}


function get_rc_shortcodes_global($name)
{
	$sections = get__theme_option($name);
	$rcblocks = array();

	foreach ($sections as $section) {
		$rcblocks[] = $section['id'];
	}

	return $rcblocks;
}

function get_all_rc_shortcodes_global()
{
	$rcblocks = array();
	if (is_post_type_archive('instructor')) {
		$rcblocks = get_rc_shortcodes_global('location_archive_pages_bottom_content');
	}
	if (get_post_type() == 'instructor' && is_singular('instructor')) {
		$location_pages_bottom_content = get_rc_shortcodes_global('location_pages_bottom_content');
		$rcblocks = array_merge($rcblocks, $location_pages_bottom_content);
	}
	$footer_blockss = get_rc_shortcodes_global('footer_global_sections');
	$rcblocks = array_merge($rcblocks, $footer_blockss);
	return $rcblocks;
}

function display_all_rc_shortcodes_global()
{
	echo display_rc_blocks(get_all_rc_shortcodes_global());
}

add_action('rc_blocks_section', 'display_all_rc_shortcodes_global');

function display_rc_blocks($rcblocks)
{
	$shortcodes = '';

	foreach ($rcblocks as $rcblock) {
		$shortcodes .= '[rcblock id="' . $rcblock . '"]';
	}

	return do_shortcode($shortcodes);
}


add_action('admin_bar_menu', 'customize_admin_bar', 99999);
function customize_admin_bar()
{
	if (!(is_admin())) {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu(array(
			'id' => 'blocks', // an unique id (required)
			'parent' => false, // false for a top level menu
			'title' => 'Blocks', // title/menu text to display
			'href' => admin_url('edit.php?post_type=rc_blocks'),

		));

		$rcblocks_global = get_all_rc_shortcodes_global();
		$rcblocks_posts = get_rc_shortcodes();
		$rcblocks = array_merge($rcblocks_global, $rcblocks_posts);

		foreach ($rcblocks as $rcblock) {
			$wp_admin_bar->add_menu(array(
				'id' => 'blocks' . $rcblock,
				'parent' => 'blocks',
				'title' => get_the_title($rcblock),
				'href' => get_edit_post_link($rcblock)
			));
		}
	}
}


function rcblocks_admin()
{
	?>
	<style>
		#wp-admin-bar-blocks>.ab-item {
			background-color: var(--accent-color) !important;
			display: flex !important;
			align-items: center;
			color: var(--white-color) !important;
		}

		#wp-admin-bar-blocks .ab-submenu {
			background-color: var(--accent-color) !important;
		}

		#wp-admin-bar-blocks>.ab-item:before {
			content: '';
			background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="%23fff" class="bi bi-card-list" viewBox="0 0 16 16"><path d="M14.5 3a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-13a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5zm-13-1A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h13a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2z"/><path d="M5 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 5 8m0-2.5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m0 5a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5m-1-5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0M4 8a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0m0 2.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0"/></svg>') !important;
			width: 20px;
			height: 20px;
			background-position: center;
			background-size: contain;
			display: inline-block;

			background-repeat: no-repeat;
		}
	</style>
<?php
}

add_action('wp_head', 'rcblocks_admin');

function action_post_updated($post_ID)
{
	$post_type = get_post_type($post_ID);
	if ($post_type == 'course') {
		$testimonials = get__posts('testimonials');
		foreach ($testimonials as $key => $testimonial) {
			$field_id = get__post_meta_by_id($post_ID, 'testimonial_' . $key);
			if ($field_id) {
				carbon_set_post_meta($key, 'course_' . $post_ID, true);
			} else {
				carbon_set_post_meta($key, 'course_' . $post_ID, false);
			}
		}
	} else 	if ($post_type == 'testimonials') {
		$courses = get__posts('course');
		foreach ($courses as $key => $course) {
			$field_id = get__post_meta_by_id($post_ID, 'course_' . $key);
			if ($field_id) {
				carbon_set_post_meta($key, 'testimonial_' . $post_ID, true);
			} else {
				carbon_set_post_meta($key, 'testimonial_' . $post_ID, false);
			}
		}
	}
}

add_action('save_post', 'action_post_updated', 100);



/**
 * Enqueue scripts and styles.
 *
 * @param string $hook The current admin page.
 */
function action_admin_enqueue_scripts($hook)
{
	if ('edit.php' !== $hook) {
		return;
	}


	wp_enqueue_script('wz-tutorials-bulk-edit', get_stylesheet_directory_uri() . '/admin/bulk-edit.js');

	wp_localize_script(
		'wz-tutorials-bulk-edit',
		'wz_tutorials_bulk_edit',
		array(
			'nonce' => wp_create_nonce('wz_tutorials_bulk_edit_nonce'),
		)
	);
}

add_action('admin_enqueue_scripts', 'action_admin_enqueue_scripts');
