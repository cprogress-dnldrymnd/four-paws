<?php
class Bulk_Edit
{
    public $post_type;

    public function __construct()
    {
        add_action('init', array($this, 'add_custom_columns'), 99);
        add_action('bulk_edit_custom_box', array($this, 'quick_edit_custom_box_function'));
        add_action('quick_edit_custom_box', array($this, 'quick_edit_custom_box_function'));
    }

    function add_custom_columns()
    {
        add_filter('manage_' . $this->post_type . '_posts_columns', array($this, 'add_admin_columns'));
        add_action('manage_' . $this->post_type . '_posts_custom_column', array($this, 'populate_custom_columns'), 10, 2);
    }

    function add_admin_columns($column_array)
    {
        $column_array['price'] = 'Price';
        $column_array['featured'] = 'Featured product';
        // the above code will add columns at the end of the array
        // if you want columns to be added in another order, use array_slice()

        return $column_array;
    }

    function populate_custom_columns($column_name, $post_id)
    {

        // if you have to populate more that one columns, use switch()
        switch ($column_name) {
            case 'price': {
                    $price = get_post_meta($post_id, 'product_price', true);
                    echo $price ? '$' . $price : '';
                    break;
                }
            case 'featured': {
                    echo get_post_meta($post_id, 'product_featured', true);
                    break;
                }
        }
    }
    function quick_edit_custom_box_function($column_name, $post_type)
    {

        switch ($column_name) {
            case 'price': {
?>
                    <fieldset class="inline-edit-col-left">
                        <div class="inline-edit-col">
                            <label>
                                <span class="title">Price</span>
                                <input type="text" name="price">
                            </label>
                        </div>
                    <?php
                    break;
                }
            case 'featured': {
                    ?>
                        <div class="inline-edit-col">
                            <label>
                                <input type="checkbox" name="featured"> Featured product
                            </label>
                        </div>
                    </fieldset>
<?php
                    break;
                }
        }
    }

}


$Testimonial = new Bulk_Edit;
$Testimonial->post_type = 'testimonials';
