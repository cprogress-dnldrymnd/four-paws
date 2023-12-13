<?php
class Bulk_Edit
{
    public $post_type;

    public function __construct()
    {
        add_action('manage_post_posts_columns', array($this, 'add_custom_columns'), 999);
        add_action('manage_posts_custom_column', array($this, 'display_custom_columns'), 999);
    }



    function add_custom_columns()
    {
        $column_array['price'] = 'Price';
        $column_array['featured'] = 'Featured product';
        // the above code will add columns at the end of the array
        // if you want columns to be added in another order, use array_slice()
        return $column_array;
    }


    function display_custom_columns($column_name, $post_id)
    {
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
}


$Testimonial = new Bulk_Edit;
$Testimonial->post_type = 'testimonials';