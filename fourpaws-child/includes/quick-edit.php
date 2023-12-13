<?php
class Bulk_Edit
{
    public $post_type;

    public function __construct()
    {
        add_action('init', array($this, 'add_custom_columns'), 99);
        add_action('bulk_edit_custom_box', array($this, 'quick_edit_custom_box_function'));
        add_action('quick_edit_custom_box', array($this, 'quick_edit_custom_box_function'), 10, 2);
        add_action('save_post', array($this, 'save_post_meta'), 10, 2);
    }

    function add_custom_columns()
    {
        add_filter('manage_' . $this->post_type . '_posts_columns', array($this, 'add_admin_columns'));
        add_action('manage_' . $this->post_type . '_posts_custom_column', array($this, 'populate_custom_columns'), 10, 2);
    }

    function add_admin_columns($column_array)
    {
        $column_array['locations_col'] = __('Locations', 'your_text_domain');
        $column_array['courses_col'] = __('Courses', 'your_text_domain');
        return $column_array;
    }

    function populate_custom_columns($column_name, $post_id)
    {
        switch ($column_name) {
            case 'locations_col':
                echo get__post_titles($post_id);
                break;
            case 'courses_col':
                echo get__post_titles($post_id, 'course', 'course_');
                break;
        }
    }

    function quick_edit_custom_box_function($column_name)
    {

        echo ' </fieldset>';
        switch ($column_name) {
            case 'locations_col':
                echo '<fieldset class="inline-edit-col-left">';
                echo '<div class="inline-edit-col">';
                echo '<label>';
                echo '<input type="checkbox" name="_all_location"> All Location';
                echo '</label>';
                echo '</div>';
                foreach (get__posts('instructor') as $key => $location) {
                    echo '<div class="inline-edit-col">';
                    echo '<label>';
                    echo '<input type="checkbox" name="_location_' . $key . '">' . $location;
                    echo '</label>';
                    echo '</div>';
                }
                break;
        }
    }

    function save_post_meta($post_id)
    {

        // check inlint edit nonce
        if (!wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce')) {
            return;
        }

        if (isset($_POST['_all_location']) && 'on' == $_POST['_all_location']) {
            update_post_meta($post_id, '_all_location', 'yes');
        } else {
            update_post_meta($post_id, '_all_location', '');
        }

        foreach (get__posts('instructor') as $key => $location) {
            $id = '_location_' . $key;
            if (isset($_POST[$id]) && 'on' == $_POST[$id]) {
                update_post_meta($post_id, $id, 'yes');
            } else {
                update_post_meta($post_id, $id, '');
            }
        }
    }
}


$Testimonial = new Bulk_Edit;
$Testimonial->post_type = 'testimonials';


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
?>
    <script>
        jQuery(function($) {

            const wp_inline_edit_function = inlineEditPost.edit;

            // we overwrite the it with our own
            inlineEditPost.edit = function(post_id) {

                // let's merge arguments of the original function
                wp_inline_edit_function.apply(this, arguments);

                // get the post ID from the argument
                if (typeof(post_id) == 'object') { // if it is object, get the ID number
                    post_id = parseInt(this.getId(post_id));
                }

                // add rows to variables
                const edit_row = $('#edit-' + post_id)
                const post_row = $('#post-' + post_id)


                jQuery('.location-checkbox').each(function(index, element) {
                    $id = jQuery(this).attr('location-key');
                    $(':input[name="' + $id + '"]', edit_row).prop('checked', true);
                });

                $(':input[name="featured"]', edit_row).prop('checked', featuredProduct);

            }
        });

        $('#bulk_edit').on('click', function(event) {
            const bulk_row = $('#bulk-edit');

            // Get the selected post ids that are being edited.
            const post_ids = [];

            // Get the data.
            const related_posts = $(':input[name="wz_tutorials_related_posts"]', bulk_row).val();
            const exclude_this_post = $('select[name="wz_tutorials_exclude_this_post"]', bulk_row).val();

            // Get post IDs from the bulk_edit ID. .ntdelbutton is the class that holds the post ID.
            bulk_row.find('#bulk-titles-list .ntdelbutton').each(function() {
                post_ids.push($(this).attr('id').replace(/^(_)/i, ''));
            });
            // Convert all post_ids to integer.
            post_ids.map(function(value, index, array) {
                array[index] = parseInt(value);
            });

            // Save the data.
            $.ajax({
                url: ajaxurl, // this is a variable that WordPress has already defined for us
                type: 'POST',
                async: false,
                cache: false,
                data: {
                    action: 'wz_tutorials_save_bulk_edit', // this is the name of our WP AJAX function that we'll set up next
                    post_ids: post_ids, // and these are the 2 parameters we're passing to our function
                    related_posts: related_posts,
                    exclude_this_post: exclude_this_post,
                    wz_tutorials_bulk_edit_nonce: wz_tutorials_bulk_edit.nonce
                }
            });
        });
    </script>
<?php
}

add_action('admin_enqueue_scripts', 'action_admin_enqueue_scripts');
