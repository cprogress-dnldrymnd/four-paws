<?php

add_action('tribe_template_after_include:events/v2/components/top-bar/views', function ($file, $name, $template) {
    echo '<a href="#">My Link</a>';
}, 10, 3);
