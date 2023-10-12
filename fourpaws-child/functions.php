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
			pagination: {
				el: ".swiper-pagination",
				clickable: true
			},
			on: {
				slideChange: function() {
					$count = jQuery('.progress').attr('count');
					$index = this.realIndex + 1;
					$per_progress = 100 / $count;
					jQuery('.progress').css('--progress', $per_progress * $index + '%');
				}
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
function post_category($class = '')
{
	ob_start();
	$category = get_the_terms(get_the_ID(), 'category');
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


//modify instructor to become locations
add_filter('register_post_type_args', 'action_register_post_type_args_instructor', 10, 2);
function action_register_post_type_args_instructor($args, $post_type)
{
	// Let's make sure that we're customizing the post type we really need
	if ($post_type !== 'instructor') {
		return $args;
	}
	$rewrite = array(
		'slug'                  => 'location',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);

	$labels = array(
		'name'                  => _x('Locations', 'Location General Name', 'text_domain'),
		'singular_name'         => _x('Location', 'Location Singular Name', 'text_domain'),
		'menu_name'             => __('Locations', 'text_domain'),
		'name_admin_bar'        => __('Location', 'text_domain'),
		'archives'              => __('Item Archives', 'text_domain'),
		'attributes'            => __('Item Attributes', 'text_domain'),
		'parent_item_colon'     => __('Parent Item:', 'text_domain'),
		'all_items'             => __('All Items', 'text_domain'),
		'add_new_item'          => __('Add New Item', 'text_domain'),
		'add_new'               => __('Add New', 'text_domain'),
		'new_item'              => __('New Item', 'text_domain'),
		'edit_item'             => __('Edit Item', 'text_domain'),
		'update_item'           => __('Update Item', 'text_domain'),
		'view_item'             => __('View Item', 'text_domain'),
		'view_items'            => __('View Items', 'text_domain'),
		'search_items'          => __('Search Item', 'text_domain'),
		'not_found'             => __('Not found', 'text_domain'),
		'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
		'featured_image'        => __('Featured Image', 'text_domain'),
		'set_featured_image'    => __('Set featured image', 'text_domain'),
		'remove_featured_image' => __('Remove featured image', 'text_domain'),
		'use_featured_image'    => __('Use as featured image', 'text_domain'),
		'insert_into_item'      => __('Insert into item', 'text_domain'),
		'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
		'items_list'            => __('Items list', 'text_domain'),
		'items_list_navigation' => __('Items list navigation', 'text_domain'),
		'filter_items_list'     => __('Filter items list', 'text_domain'),
	);
	$args['rewrite'] = $rewrite;
	$args['label'] = 'Locations';
	$args['labels'] = $labels;
	$args['menu_icon'] = 'dashicons-location';

	return $args;
}


function action_academist_elated_action_before_main_content()
{
	if (is_post_type_archive('instructor')) {
	?>
		<div class="top-info">
			<h2 class="with-line">
				Our Locations
			</h2>
			<div class="desc">
				<p>
					Working with animals is of course a dream job for so many people, and congratulations on taking your first. Working with animals is of course a dream job for so many people, and congratulations on taking your first.
				</p>
			</div>
		</div>
<?php
	}
}

add_action('academist_elated_action_before_main_content', 'action_academist_elated_action_before_main_content');
