<?php
class Bulk_Edit
{
    public $post_type;

    public function __construct()
    {
        add_action('bulk_edit_custom_box', array($this, 'quick_edit_custom_box_function'));
        add_action('quick_edit_custom_box', array($this, 'quick_edit_custom_box_function'), 10, 2);
        add_action('save_post', array($this, 'save_post_meta'), 10, 2);
    }

    function quick_edit_custom_box_function()
    {
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
        echo ' </fieldset>';
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
