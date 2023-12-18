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
        add_action('admin_enqueue_scripts', array($this, 'enqueue_scripts'));
        add_action('wp_ajax_wz_tutorials_save_bulk_edit', array($this, 'save_bulk_edit'));
    }

    /**
     * Enqueue scripts and styles.
     *
     * @param string $hook The current admin page.
     */

    public function enqueue_scripts($hook)
    {
        if ('edit.php' !== $hook) {
            return;
        }
        wp_enqueue_script('wz-tutorials-bulk-edit', get_stylesheet_directory_uri() . '/admin/bulk-edit.js', array('jquery'), 1, true);
        wp_localize_script(
            'wz-tutorials-bulk-edit',
            'wz_tutorials_bulk_edit',
            array(
                'nonce' => wp_create_nonce('wz_tutorials_bulk_edit_nonce'),
            )
        );
    }
    function add_custom_columns()
    {
        add_filter('manage_' . $this->post_type . '_posts_columns', array($this, 'add_admin_columns'));
        add_action('manage_' . $this->post_type . '_posts_custom_column', array($this, 'populate_custom_columns'), 10, 2);
    }

    function add_admin_columns($column_array)
    {
        $column_array['locations_col'] = __('Locations', 'your_text_domain');
        return $column_array;
    }

    function populate_custom_columns($column_name, $post_id)
    {
        switch ($column_name) {
            case 'locations_col':
                echo get__post_titles($post_id);
                break;
        }
    }

    function quick_edit_custom_box_function($column_name)
    {

        switch ($column_name) {
            case 'locations_col':
                echo '<fieldset class="inline-edit-col-left">';
                echo '<div class="inline-edit-col">';
                echo '<div> <strong>LOCATIONS</strong> </div>';
                echo '<input style="float: left" type="checkbox" id="all-location" name="_all_location"> <label  style="float: left" for="all-location">All Location</label>';
                echo '<div class="other-locations" style="margin-top: 38px">';
                foreach (get__posts('instructor') as $key => $location) {
                    echo '<div class="inline-edit-col">';
                    echo '<label>';
                    echo '<input type="checkbox" name="_location_' . $key . '">' . $location;
                    echo '</label>';
                    echo '</div>';
                }
                echo '</div>';
                echo ' </fieldset>';
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


    /**
     * Save bulk edit data.
     */
    public function save_bulk_edit()
    {
        // Security check.
        check_ajax_referer('wz_tutorials_bulk_edit_nonce', 'wz_tutorials_bulk_edit_nonce');

        // Get the post IDs.
        $post_ids = isset($_POST['post_ids']) ? wp_parse_id_list(wp_unslash($_POST['post_ids'])) : array();

        //Get all Location Val
        if (isset($_POST['_all_location']) && $_POST['_all_location'] == 'true') {
            $_all_location = 'yes';
        }

        $other_locations = array();

        foreach (get__posts('instructor') as $key => $location) {
            $id = '_location_' . $key;

            if (isset($_POST[$id]) &&  $_POST[$id] == 'true') {
                $other_locations[] = $id;
            }
        }
        // Now we can start saving.
        foreach ($post_ids as $post_id) {
            if ($_all_location) {
                update_post_meta($post_id, '_all_location', $_all_location);
            }

            if ($other_locations) {
                foreach ($other_locations as  $location) {
                    update_post_meta($post_id, $location, 'yes');
                }
            }
        }

        wp_send_json_success();
    }
}


$Course = new Bulk_Edit;
$Course->post_type = 'course';
