
<?php
echo '<pre>';
$testimonials = get__posts('testimonials');

foreach ($testimonials as $key => $testimonial) {
    $author = get_post_meta($testimonial, 'eltdf_testimonial_author', true);
    $position = get_post_meta($testimonial, 'eltdf_testimonial_author_position', true);
    $new_title = $author . ' - ' . $position;
    $post_update = array(
        'ID'         => $key,
        'post_title' => $new_title
    );

    wp_update_post($post_update);
}

/*carbon_set_post_meta(3874, 'reviews', array(
    array(
        'value' => 'post:testimonials:3628',
        'type' => 'post',
        'subtype' => 'testimonials',
        'id' => '3628',
    ),
));*/
echo '</pre>';
do_action('rc_blocks_section');
do_action('academist_elated_get_footer_template');
