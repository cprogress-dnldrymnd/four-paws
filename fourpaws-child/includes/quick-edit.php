<?php

/**
 * Class to add Bulk Edit functionality.
 */
class Custom_Bulk_Edit
{
    /**
     * CRP_Bulk_Edit constructor.
     */
    public $post_type;

    public function __construct()
    {
        add_action('init', array($this, 'add_custom_columns'), 999);
        add_action('bulk_edit_custom_box', array($this, 'quick_edit_custom_box'));
        add_action('quick_edit_custom_box', array($this, 'quick_edit_custom_box'));
        add_action('save_post', array($this, 'save_post_meta'));
    }

    /**
     * Add custom columns to the posts list table.
     */
    public function add_custom_columns()
    {
        add_filter('manage_' . $this->post_type . '_posts_columns', array($this, 'add_admin_columns'));
        add_action('manage_' . $this->post_type . '_posts_custom_column', array($this, 'populate_custom_columns'), 10, 2);
    }

    /**
     * Add custom field to quick edit screen.
     *
     * @param string $column_name The name of the column.
     */
    public function quick_edit_custom_box($column_name)
    {

        switch ($column_name) {
            case 'wz_tutorials_columns':
                if (current_filter() === 'quick_edit_custom_box') {
                    wp_nonce_field('wz_tutorials_quick_edit_nonce', 'wz_tutorials_quick_edit_nonce');
                } else {
                    wp_nonce_field('wz_tutorials_bulk_edit_nonce', 'wz_tutorials_bulk_edit_nonce');
                } ?>
                <fieldset class="inline-edit-col-left inline-edit-wz_tutorials">
                    <div class="inline-edit-col column-<?php echo esc_attr($column_name); ?>">
                        <label class="inline-edit-group">
                            <?php esc_html_e('Related Posts', 'wz-tutorials'); ?>
                            <?php
                            if (current_filter() === 'bulk_edit_custom_box') {
                                ' ' . esc_html_e('(0 to clear the related posts)', 'wz-tutorials');
                            }
                            ?>
                            <input type="text" name="wz_tutorials_related_posts" class="widefat" value="">
                        </label>
                        <label class="inline-edit-group">
                            <?php if (current_filter() === 'quick_edit_custom_box') { ?>
                                <input type="checkbox" name="wz_tutorials_exclude_this_post"><?php esc_html_e('Exclude this post from related posts', 'wz-tutorials'); ?>
                            <?php } else { ?>
                                <?php esc_html_e('Exclude from related posts', 'wz-tutorials'); ?>
                                <select name="wz_tutorials_exclude_this_post">
                                    <option value="-1"><?php esc_html_e('&mdash; No Change &mdash;'); ?></option>
                                    <option value="1"><?php esc_html_e('Exclude'); ?></option>
                                    <option value="0"><?php esc_html_e('Include'); ?></option>
                                </select>
                            <?php } ?>
                        </label>
                    </div>
                </fieldset>
<?php
                break;
        }
    }

    /**
     * Save custom field data.
     *
     * @param int $post_id The post ID.
     */
    public function save_post_meta($post_id)
    {
        if (!current_user_can('edit_post', $post_id)) {
            return;
        }
        if (!isset($_REQUEST['wz_tutorials_quick_edit_nonce']) || !wp_verify_nonce(sanitize_text_field(wp_unslash($_REQUEST['wz_tutorials_quick_edit_nonce'])), 'wz_tutorials_quick_edit_nonce')) {
            return;
        }

        if (isset($_REQUEST['wz_tutorials_related_posts'])) {
            $related_posts = wp_parse_id_list(sanitize_text_field(wp_unslash($_REQUEST['wz_tutorials_related_posts'])));

            // Remove any posts that are not published.
            foreach ($related_posts as $key => $value) {
                if ('publish' !== get_post_status($value)) {
                    unset($related_posts[$key]);
                }
            }
            $related_posts = implode(',', $related_posts);

            // Update the ACF field.
            if (!empty($related_posts)) {
                //update_field('related_posts', $related_posts, $post_id);
            } else {
                //delete_field('related_posts', $post_id);
            }
        }

        if (isset($_REQUEST['wz_tutorials_exclude_this_post'])) {
            // Update the ACF field.
            // update_field('exclude_this_post', 1, $post_id);
        } else {
            // Delete the ACF field.
            //delete_field('exclude_this_post', $post_id);
        }
    }
}

$Course = new Custom_Bulk_Edit;
$Course->post_type = 'testimonials';
