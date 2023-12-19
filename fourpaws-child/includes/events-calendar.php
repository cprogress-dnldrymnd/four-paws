<?php

add_action('tribe_template_after_include:events/v2/components/events-bar', function ($file, $name, $template) {
    echo '<a href="#">My Link</a>';
}, 10, 3);
