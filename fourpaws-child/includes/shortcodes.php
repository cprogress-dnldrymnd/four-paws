<?php

function slider($atts, $content = null)
{
    extract(
        shortcode_atts(
            array(
                'id' => '',
            ),
            $atts
        )
    );

    $slides = get__post_meta_by_id($id, 'slides');
    var_dump($slides);
}

add_shortcode('slider', 'slider');
