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


function location_arr()
{
	$args = array(
		'numberposts' => -1,
		'post_type'   => 'instructor'
	);
	$locations = get_posts($args);
	$location_arr = array();
	foreach ($locations as $location) {
		$location_arr[$location->ID] = $location->post_title;
	}
	return $location_arr;
}

function get_rc_shortcodes()
{
	$rcblocks = array();

	if (is_single()) {
		$posts = get_posts(array(
			'post_type' => 'rc_blocks',
			'fields'          => 'ids', // Only get post IDs
			'posts_per_page'  => -1
		));


		foreach ($posts as $post) {
			$shortcode = '[rcblock id="' . $post . '"]';
			if (strpos(get_the_content(), $shortcode) !== false) {
				$rcblocks[] = $shortcode;
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
			'id' => 'my_plugin-page',
			'parent' => 'blocks',
			'title' => get_the_title($rcblock),
			'href' => get_edit_post_link($rcblock)
		));
	}
}
