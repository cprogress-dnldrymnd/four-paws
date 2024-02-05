<?php

add_action('tribe_template_before_include:events/v2/components/events-bar/views', 'events_category', 10, 3);

function events_category($file, $name, $template)
{
    $terms = get_terms(array(
        'taxonomy'   => 'tribe_events_cat',
        'hide_empty' => false,
    ));


?>
    <select name="events-category" id="events-category">
        <option value="">Category</option>
        <?php foreach ($terms as $term) { ?>
            <?php

            if (is_tax('tribe_events_cat', $term->term_id)) {
                $selected = 'selected';
            } else {
                $selected = '';
            }
            ?>

            <option value="<?= get_term_link($term->term_id) ?>" <?= $selected ?>><?= $term->name ?></option>
        <?php } ?>
    </select>
<?php
}

add_filter(
    'tribe_get_events_title',
    function ($title, $depth, $context) {
        // Let's break something :wink:
        $notices = tribe_events_the_notices();

        return 'xxxx';
    },
    10,
    3
);
