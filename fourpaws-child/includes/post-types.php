<?php
/*-----------------------------------------------------------------------------------*/
/* Custom Post Type
/*-----------------------------------------------------------------------------------*/
class newPostType
{
	function __construct(array $param)
	{

		add_action('init', array($this, 'create_post_type'));
		$this->name = $param['name'];
		$this->key = isset($param['key']) ? $param['key'] : $param['name'];
		$this->singular_name = $param['singular_name'];
		$this->icon = $param['icon'];
		$this->supports = $param['supports'];
		$this->show_in_rest = isset($param['show_in_rest']) ? $param['show_in_rest'] : false;
		$this->exclude_from_search = isset($param['exclude_from_search']) ? $param['exclude_from_search'] : false;;
		$this->publicly_queryable = isset($param['publicly_queryable']) ? $param['publicly_queryable'] : true;
		$this->show_in_admin_bar = isset($param['show_in_admin_bar']) ? $param['show_in_admin_bar'] : true;
		$this->has_archive = isset($param['has_archive']) ? $param['has_archive'] : true;
		$this->show_in_menu = isset($param['show_in_menu']) ? $param['show_in_menu'] : true;
		$this->hierarchical = isset($param['hierarchical']) ? $param['hierarchical'] : false;
		$this->all_items = isset($param['all_items']) ? $param['all_items'] : 'All ' . $param['name'];



		if (isset($param['rewrite'])) {
			$this->rewrite = $param['rewrite'];
		} else {
			$this->rewrite = array('slug' => strtolower($this->name));
		}
	}

	function create_post_type()
	{
		register_post_type(
			strtolower($this->key),
			array(
				'labels'              => array(
					'name'               => _x($this->name, 'post type general name'),
					'singular_name'      => _x($this->singular_name, 'post type singular name'),
					'menu_name'          => _x($this->name, 'admin menu'),
					'name_admin_bar'     => _x($this->singular_name, 'add new on admin bar'),
					'add_new'            => _x('Add New', strtolower($this->name)),
					'add_new_item'       => __('Add New ' . $this->singular_name),
					'new_item'           => __('New ' . $this->singular_name),
					'edit_item'          => __('Edit ' . $this->singular_name),
					'view_item'          => __('View ' . $this->singular_name),
					'all_items'          => __($this->all_items),
					'search_items'       => __('Search ' . $this->name),
					'parent_item_colon'  => __('Parent :' . $this->name),
					'not_found'          => __('No ' . strtolower($this->name) . ' found.'),
					'not_found_in_trash' => __('No ' . strtolower($this->name) . ' found in Trash.')
				),
				'show_in_rest'        => $this->show_in_rest,
				'supports'            => $this->supports,
				'public'              => true,
				'has_archive'         => $this->has_archive,
				'show_in_menu' => $this->show_in_menu,
				'hierarchical'        => $this->hierarchical,
				'rewrite'             => $this->rewrite,
				'menu_icon'           => $this->icon,
				'capability_type'     => 'page',
				'exclude_from_search' => $this->exclude_from_search,
				'publicly_queryable'  => $this->publicly_queryable,
				'show_in_admin_bar'   => $this->show_in_admin_bar,
			)
		);
	}
}
/*-----------------------------------------------------------------------------------*/
/* Taxonomy
/*-----------------------------------------------------------------------------------*/
class newTaxonomy
{
	function __construct(array $param)
	{
		add_action('init', array($this, 'create_taxonomy'));
		add_action('restrict_manage_posts', array($this, 'filter_by_taxonomy'), 10, 2);
		add_filter('manage_' . $param['post_type'] . '_posts_columns', array($this, 'change_table_column_titles'));
		add_filter('manage_' . $param['post_type'] . '_posts_custom_column', array($this, 'change_column_rows'), 10, 2);
		add_filter('manage_edit-' . $param['post_type'] . '_sortable_columns', array($this, 'change_sortable_columns'));

		$this->taxonomy = $param['taxonomy'];
		$this->post_type = $param['post_type'];
		$this->args = $param['args'];
	}

	function create_taxonomy()
	{
		register_taxonomy($this->taxonomy, $this->post_type, $this->args);
	}

	function filter_by_taxonomy($post_type, $which)
	{

		// Apply this only on a specific post type
		if ($this->post_type !== $post_type)
			return;

		// A list of taxonomy slugs to filter by
		$taxonomies = array($this->taxonomy);

		foreach ($taxonomies as $taxonomy_slug) {

			// Retrieve taxonomy data
			$taxonomy_obj = get_taxonomy($taxonomy_slug);
			$taxonomy_name = $taxonomy_obj->labels->name;

			// Retrieve taxonomy terms
			$terms = get_terms($taxonomy_slug);

			// Display filter HTML
			echo "<select name='{$taxonomy_slug}' id='{$taxonomy_slug}' class='postform'>";
			echo '<option value="">' . sprintf(esc_html__('Show All %s', 'text_domain'), $taxonomy_name) . '</option>';
			foreach ($terms as $term) {
				printf(
					'<option value="%1$s" %2$s>%3$s (%4$s)</option>',
					$term->slug,
					((isset($_GET[$taxonomy_slug]) && ($_GET[$taxonomy_slug] == $term->slug)) ? ' selected="selected"' : ''),
					$term->name,
					$term->count
				);
			}
			echo '</select>';
		}
	}
	function change_table_column_titles($columns)
	{
		unset($columns['date']); // temporarily remove, to have custom column before date column
		$columns[$this->taxonomy] = $this->args['label'];
		$columns['date'] = 'Date'; // readd the date column
		return $columns;
	}

	function change_column_rows($column_name, $post_id)
	{
		if ($column_name == $this->taxonomy) {
			echo get_the_term_list($post_id, $this->taxonomy, '', ', ', '') . PHP_EOL;
		}
	}

	function change_sortable_columns($columns)
	{
		$columns[$this->taxonomy] = $this->taxonomy;
		return $columns;
	}
}

new newPostType(
	array(
		'name'                => 'Slider',
		'singular_name'       => 'Sliders',
		'icon'                => 'dashicons-slides',
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'show_in_admin_bar'   => false,
		'has_archive'         => false,
		'supports'            => array('title', 'revisions'),
	)
);

function delete_post_type()
{
	unregister_post_type('location');
	unregister_post_type('portfolio-item');
	unregister_post_type('question');
	unregister_post_type('lesson');
	unregister_post_type('quiz');
}
add_action('init', 'delete_post_type', 100);



//modify instructor to become locations
add_filter('register_post_type_args', 'action_register_post_type_args_instructor', 10, 2);
function action_register_post_type_args_instructor($args, $post_type)
{
	// Let's make sure that we're customizing the post type we really need
	if ($post_type !== 'instructor') {
		return $args;
	}
	$rewrite = array(
		'slug'                  => 'dog-grooming-course-locations',
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

add_filter('register_taxonomy_args', 'action_register_taxonomy_args', 10, 2);
function action_register_taxonomy_args($args, $taxonomy)
{
	// Let's make sure that we're customizing the post type we really need
	if ($taxonomy !== 'instructor-category') {
		return $args;
	}
	$rewrite = array(
		'slug'                  => 'location-category',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);

	$labels = array(
		'name'                       => _x('Location Categories', 'Taxonomy General Name', 'text_domain'),
		'singular_name'              => _x('Location Category', 'Taxonomy Singular Name', 'text_domain'),
		'menu_name'                  => __('Location Category', 'text_domain'),
		'all_items'                  => __('All Items', 'text_domain'),
		'parent_item'                => __('Parent Item', 'text_domain'),
		'parent_item_colon'          => __('Parent Item:', 'text_domain'),
		'new_item_name'              => __('New Item Name', 'text_domain'),
		'add_new_item'               => __('Add New Item', 'text_domain'),
		'edit_item'                  => __('Edit Item', 'text_domain'),
		'update_item'                => __('Update Item', 'text_domain'),
		'view_item'                  => __('View Item', 'text_domain'),
		'separate_items_with_commas' => __('Separate items with commas', 'text_domain'),
		'add_or_remove_items'        => __('Add or remove items', 'text_domain'),
		'choose_from_most_used'      => __('Choose from the most used', 'text_domain'),
		'popular_items'              => __('Popular Items', 'text_domain'),
		'search_items'               => __('Search Items', 'text_domain'),
		'not_found'                  => __('Not Found', 'text_domain'),
		'no_terms'                   => __('No items', 'text_domain'),
		'items_list'                 => __('Items list', 'text_domain'),
		'items_list_navigation'      => __('Items list navigation', 'text_domain'),
	);
	$args['rewrite'] = $rewrite;
	$args['label'] = 'Locations';
	$args['labels'] = $labels;

	return $args;
}


new newPostType(
	array(
		'name'                => 'Guides',
		'singular_name'       => 'Guide',
		'icon'                => 'dashicons-info',
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'show_in_admin_bar'   => true,
		'has_archive'         => true,
		'rewrite' => array(
			'slug' => 'cat-dog-grooming-nutrition-guides'
		),
		'supports'            => array('title', 'revisions', 'editor', 'thumbnail'),
	)
);


new newPostType(
	array(
		'name'                => 'Course FAQs',
		'singular_name'       => 'Course FAQ',
		'key'       		  => 'faqs',
		'icon'                => 'dashicons-info-outline',
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'show_in_admin_bar'   => false,
		'has_archive'         => false,
		'show_in_menu' 		=> 'academist_lms_menu',
		'all_items' => 'Course FAQs',
		'supports'            => array('title', 'revisions', 'editor'),
	)
);



new newPostType(
	array(
		'name'                => 'Location FAQs',
		'singular_name'       => 'Location FAQ',
		'key'       		  => 'faqs_location',
		'icon'                => 'dashicons-info-outline',
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'show_in_admin_bar'   => false,
		'has_archive'         => false,
		'show_in_menu' 		=> 'edit.php?post_type=instructor',
		'all_items' => 'Location FAQs',
		'supports'            => array('title', 'revisions', 'editor'),
	)
);


// Add the custom columns to the slider post type:
add_filter('manage_slider_posts_columns', 'set_custom_edit_slider_columns');
function set_custom_edit_slider_columns($columns)
{
	$columns['shortcode'] = __('Shortcode', 'your_text_domain');
	return $columns;
}

// Add the data to the custom columns for the slider post type:
add_action('manage_slider_posts_custom_column', 'custom_slider_column', 10, 2);
function custom_slider_column($column, $post_id)
{
	switch ($column) {

		case 'shortcode':
			echo '<input type="text" value="[slider id=' . $post_id . ']" readonly>';
			break;
	}
}


// Add the custom columns to the faqs_location post type:
add_filter('manage_faqs_location_posts_columns', 'set_custom_edit_faqs_location_columns');
function set_custom_edit_faqs_location_columns($columns)
{
	$columns['locations_col'] = __('Locations', 'your_text_domain');
	unset($columns['date']);
	return $columns;
}

// Add the data to the custom columns for the faqs_location post type:
add_action('manage_faqs_location_posts_custom_column', 'custom_faqs_location_column', 10, 2);
function custom_faqs_location_column($column, $post_id)
{
	switch ($column) {
		case 'locations_col':
			echo get__post_titles($post_id);
			break;
	}
}

// Add the custom columns to the testimonials post type:
add_filter('manage_testimonials_posts_columns', 'set_custom_edit_testimonials_columns');
function set_custom_edit_testimonials_columns($columns)
{
	$columns['locations_col'] = __('Locations', 'your_text_domain');
	$columns['courses_col'] = __('Courses', 'your_text_domain');
	return $columns;
}

// Add the data to the custom columns for the testimonials post type:
add_action('manage_testimonials_posts_custom_column', 'custom_testimonials_column', 10, 2);
function custom_testimonials_column($column, $post_id)
{
	switch ($column) {
		case 'locations_col':
			echo get__post_titles($post_id);
			break;
		case 'courses_col':
			echo get__post_titles($post_id, 'course', 'course_');
			break;
	}
}


// Add the custom columns to the course post type:
add_filter('manage_team-member_posts_columns', 'set_custom_edit_course_columns');
function set_custom_edit_course_columns($columns)
{
	$columns['locations_col'] = __('Locations', 'your_text_domain');
	return $columns;
}

// Add the data to the custom columns for the course post type:
add_action('manage_team-member_posts_custom_column', 'custom_course_column', 10, 2);
function custom_course_column($column, $post_id)
{
	switch ($column) {

		case 'locations_col':
			echo get__post_titles($post_id);
			break;
	}
}



// 2. Add existing taxonomies to post type
add_action('init', 'add_taxonomy_to_post_types');
function add_taxonomy_to_post_types()
{
	register_taxonomy_for_object_type('course-category', 'faqs');
}




//modify courses slug
function wp1482371_custom_post_type_args( $args, $post_type ) {
    if ( $post_type == "course" ) {
        $args['rewrite'] = array(
            'slug' => 'pet-grooming-courses'
        );
    }

    return $args;
}
add_filter( 'register_post_type_args', 'wp1482371_custom_post_type_args', 20, 2 )