
<?php
echo '<pre>';
$reviews_list = get__posts('testimonials');
$reviews = get__post_meta_by_id(3874, 'course_reviews');

foreach ($reviews_list as $key => $review_list) {
    foreach ($reviews as $review) {
        if ($key == $review) {
            echo 'true';
        } else {
            echo 'false';
            carbon_set_post_meta($review, 'course_' . $post_ID, false);
        }
    }
}
var_dump($reviews_list);
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
