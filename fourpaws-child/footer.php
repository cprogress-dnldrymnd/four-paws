
<?php
echo '<pre>';
var_dump(get__post_meta('reviews'));

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
