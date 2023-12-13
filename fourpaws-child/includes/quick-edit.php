<?php

/**
 * Class to add Bulk Edit functionality.
 */
class Bulk_Edit
{
    /**
     * CRP_Bulk_Edit constructor.
     */
    public $post_type;

    public function __construct()
    {
    }

    /**
     * Add custom columns to the posts list table.
     */
    public function add_custom_columns()
    {
        add_filter('manage_' . $this->post_type . '_posts_columns', array($this, 'add_admin_columns'));
        add_action('manage_' . $this->post_type . '_posts_custom_column', array($this, 'populate_custom_columns'), 10, 2);
    }
}

$Course = new Bulk_Edit();
$Course->post_type = 'course';
