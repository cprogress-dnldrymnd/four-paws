<?php
if (is_post_type_archive('instructor')) {
    rcblock_by_id("3462");
    rcblock_by_id("3507");
}

if (get_post_type() == 'instructor') {
    rcblock_by_id("3524");
}
?>
<?php rcblock_by_id("3366"); ?>
<?php do_action('academist_elated_get_footer_template');