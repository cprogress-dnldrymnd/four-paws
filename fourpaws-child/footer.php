<?php
if (is_post_type_archive('instructor')) {
    $rcblocks = get_rc_shortcodes_global('location_archive_pages_bottom_content');
    echo display_rc_blocks($rcblocks);
}

if (get_post_type() == 'instructor') {
    $rcblocks = get_rc_shortcodes_global('location_pages_bottom_content');
    echo display_rc_blocks($rcblocks);
    echo 'xxx';
}
?>
<?php rcblock_by_id("3366"); ?>
<?php do_action('academist_elated_get_footer_template');
