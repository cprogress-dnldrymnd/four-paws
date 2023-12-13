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
        add_action('init', array($this, 'add_custom_columns'), 99);
        add_action('bulk_edit_custom_box', array($this, 'quick_edit_custom_box'));
        add_action('quick_edit_custom_box', array($this, 'quick_edit_custom_box'));
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

$Course = new Custom_Bulk_Edit;
$Course->post_type = 'course';
