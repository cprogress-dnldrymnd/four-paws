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
    ob_start();
?>
    <div class="hero-slider">

    </div>
<?php
    return ob_get_clean();
}

add_shortcode('slider', 'slider');
