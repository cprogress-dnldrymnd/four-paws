<?php

function get_shortcode_regex() {
    global $shortcode_tags;
    $tagnames = array_keys($shortcode_tags);
    $tagregexp = join( '|', array_map('preg_quote', $tagnames) );

    // WARNING! Do not change this regex without changing do_shortcode_tag() and strip_shortcodes()
    return '(.?)\[('.$tagregexp.')\b(.*?)(?:(\/))?\](?:(.+?)\[\/\2\])?(.?)';
}

get_shortcode_regex();

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