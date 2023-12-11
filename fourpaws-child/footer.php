<?php
if (is_post_type_archive('instructor')) {
    get_rc_shortcodes_global('location_archive_pages_bottom_content', true);
}
if (get_post_type() == 'instructor' && is_singular('instructor')) {
   get_rc_shortcodes_global('location_pages_bottom_content', true);
}
?>
<?php rcblock_by_id("3366"); ?>
<?php do_action('academist_elated_get_footer_template');
