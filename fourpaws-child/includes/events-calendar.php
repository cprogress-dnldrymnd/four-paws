<?php

add_action('tribe_template_before_include:events/v2/components/events-bar/views', 'events_category', 10, 3);

function events_category($file, $name, $template)
{
    ?>
    <select name="" id="events-category">Category</select>
    <?php
}
