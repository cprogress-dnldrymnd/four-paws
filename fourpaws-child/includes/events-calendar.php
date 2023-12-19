<?php

add_action('tribe_template_after_include:events/v2/components/events-bar', 'events_category', 10, 3);

function events_category($file, $name, $template)
{
    echo '<a href="#">My Link</a>';
}
