<?php
if (is_post_type_archive('instructor')) {
    rcblock_by_id("3462");
    rcblock_by_id("3507");
}

if (get_post_type() == 'instructor') {
    $rcblocks = get_rc_shortcodes_global('location_pages_bottom_content');
    echo display_rc_blocks($rcblocks);
}
?>
<?php rcblock_by_id("3366"); ?>
<?php do_action('academist_elated_get_footer_template');
