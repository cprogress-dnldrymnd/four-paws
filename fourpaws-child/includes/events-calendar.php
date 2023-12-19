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
            <option value="<?= get_term_link($term->term_id) ?>"><?= get_term_link($term->name) ?></option>
        <?php } ?>
    </select>
<?php
}
