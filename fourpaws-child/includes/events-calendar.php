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


function action_tribe_events_single_event_after_the_content()
{
    $course = carbon_get_the_post_meta('course');
    if ($course) {
    ?>
        <a itemprop="url" href="<?= get_permalink($course[0]['id']) ?>" target="_self" style="margin: 0 15px 0 0" class="eltdf-btn eltdf-btn-medium eltdf-btn-solid eltdf-btn-arrow">
            <span class="eltdf-btn-text">Book Now</span>
        </a>
<?php
    }
}

add_action('tribe_events_single_event_after_the_content', 'action_tribe_events_single_event_after_the_content');
