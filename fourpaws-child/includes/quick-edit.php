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
        $column_array['_all_location'] = 'All Location';
        foreach (get__posts('instructor') as $key => $location) {
            $column_array['_location_' . $key] = $location;
        }
        // the above code will add columns at the end of the array
        // if you want columns to be added in another order, use array_slice()

        return $column_array;
    }

    function populate_custom_columns($column_name, $post_id)
    {

        // if you have to populate more that one columns, use switch()
        switch ($column_name) {
            case $column_name: {
                    $column_val = get_post_meta($post_id, $column_name, true);
                    echo $column_val;
                    break;
                }
        }
    }
    function quick_edit_custom_box_function($column_name)
    {

        switch ($column_name) {
            case $column_name: {
?>
                    <div class="inline-edit-col">
                        <label>
                            <input type="checkbox" name="<?= $column_name ?>">
                            <?= $column_name ?>
                        </label>
                    </div>
                    </fieldset>
<?php
                    break;
                }
        }
    }

    function save_post_meta($post_id)
    {

        // check inlint edit nonce
        if (!wp_verify_nonce($_POST['_inline_edit'], 'inlineeditnonce')) {
            return;
        }

        // update the price
        $price = !empty($_POST['price']) ? absint($_POST['price']) : 0;
        update_post_meta($post_id, 'product_price', $price);

        // update checkbox
        $featured = (isset($_POST['featured']) && 'on' == $_POST['featured']) ? 'yes' : 'no';
        update_post_meta($post_id, 'product_featured', $featured);
    }
}


$Testimonial = new Bulk_Edit;
$Testimonial->post_type = 'testimonials';
