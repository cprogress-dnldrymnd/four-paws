<?php
class Bulk_Edit
{
    public $post_type;

    public function __construct()
    {
        add_action('init', array($this, 'add_custom_columns'), 99);
    }

    function add_custom_columns()
    {
        add_filter('manage_' . $this->post_type . '_posts_columns', array($this, 'add_admin_columns'));
        add_action('manage_' . $this->post_type . '_posts_custom_column', array($this, 'populate_custom_columns'), 10, 2);
    }
}


$Testimonial = new Bulk_Edit;
$Testimonial->post_type = 'testimonials';