<?php
class Bulk_Edit
{
    public $post_type;

    public function __construct()
    {
        add_action('manage_' . $this->post_type . '_posts_columns', array($this, 'add_custom_columns'), 999);
    }

    function add_custom_columns()
    {
        $column_array['price'] = 'Price';
        $column_array['featured'] = 'Featured product';
        // the above code will add columns at the end of the array
        // if you want columns to be added in another order, use array_slice()

        return $column_array;
    }
}


$Testimonial = new Bulk_Edit;
$Testimonial->post_type = 'testimonials';