<?php
//Functions from plugin

function course_price($id = false, $display_deposit = false, $full_price_only = false)
{
    if (!$id) {
        $id = get_the_ID();
    }
    $price = academist_lms_calculate_course_price($id);
    $currency_postition = get_option('woocommerce_currency_pos');
    $deposit_payment = get__post_meta_by_id($id, 'deposit_payment');
    $full_price = get__post_meta_by_id($id, 'full_price');

    if ($full_price_only == true) {
        $price_val = $full_price ? $full_price : $price;
    } else {
        $price_val = $price;
    }
    ob_start();
?>
    <div class="eltdf-ci-price-holder">
        <?php if ($price == 0) { ?>
            <span class="eltdf-ci-price-free">
                <?php esc_html_e('Free', 'academist-lms'); ?>
            </span>
        <?php } else { ?>
            <span class="eltdf-ci-price-value">
                <?php
                if (academist_elated_is_woocommerce_installed()) {
                    if ($currency_postition === 'left') {
                        echo get_woocommerce_currency_symbol() . esc_html($price_val);
                    } else {
                        echo esc_html($price_val) . get_woocommerce_currency_symbol();
                    }
                    if ($deposit_payment && $display_deposit) {
                        echo ' deposit';
                    }
                    echo course_discount();
                }
                ?>
            </span>
        <?php } ?>
    </div>
<?php
    return ob_get_clean();
}

function course_discount()
{
    $discount = get_post_meta(get_the_id(), 'eltdf_course_price_discount_meta', 'true');
    if ($discount) {
        return '<span class="sale-badge"> SALE </span>';
    }
}

function action_course_level()
{
?>
    <?php
    $level = get__post_meta('level');
    ?>

    <?php if ($level) { ?>

        <div class="eltdf-cli-category-holder">
            <div class="level-holder">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="15.008" height="20.034" viewBox="0 0 15.008 20.034">
                        <path id="award" d="M14.2,15.344a5.5,5.5,0,0,0,1.977-.884l1.147,4.507a1.675,1.675,0,0,1-2.392,1.859L13,19.9a2.32,2.32,0,0,0-2,0l-1.933.928a1.675,1.675,0,0,1-2.392-1.859L7.82,14.46a5.5,5.5,0,0,0,1.977.884m4.4,0a9.95,9.95,0,0,1-4.4,0m4.4,0a5.342,5.342,0,0,0,4.043-3.915,9.052,9.052,0,0,0,0-4.266A5.342,5.342,0,0,0,14.2,3.247a9.95,9.95,0,0,0-4.4,0A5.342,5.342,0,0,0,5.755,7.162a9.055,9.055,0,0,0,0,4.266A5.342,5.342,0,0,0,9.8,15.344" transform="translate(-4.496 -1.996)" fill="none" stroke="#fff" stroke-width="2" />
                    </svg>
                </span>
                <span><?= $level ?></span>
            </div>
        </div>

    <?php } ?>

    <?php echo course_discount(); ?>
<?php
}

add_action('course_level', 'action_course_level');



function action_course_meta()
{
?>
    <?php
    $duration = get__post_meta('duration');
    $parameter = get__post_meta('duration_parameters');
    $award = get__post_meta('award');
    ?>

    <div class="course-meta">
        <ul>
            <?php if ($duration) { ?>
                <li class="d-flex align-items-center">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16.66" height="16.66" viewBox="0 0 16.66 16.66">
                            <g id="clock-square-svgrepo-com" transform="translate(-1 -1)">
                                <path id="Path_89" data-name="Path 89" d="M12,8v2.932l1.832,1.832" transform="translate(-2.67 -1.602)" fill="none" stroke="#7f3e98" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                <path id="Path_90" data-name="Path 90" d="M2,9.33C2,5.875,2,4.147,3.073,3.073S5.875,2,9.33,2s5.183,0,6.256,1.073,1.073,2.8,1.073,6.256,0,5.183-1.073,6.256-2.8,1.073-6.256,1.073-5.183,0-6.256-1.073S2,12.785,2,9.33Z" fill="none" stroke="#7f3e98" stroke-width="2" />
                            </g>
                        </svg>
                    </span>
                    <span class="text"><?= course_length($duration, $parameter) ?></span>
                </li>
            <?php } ?>
            <?php if ($award) { ?>
                <li class="d-flex align-items-center">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15.008" height="20.034" viewBox="0 0 15.008 20.034">
                            <path id="award-svgrepo-com_2_" data-name="award-svgrepo-com (2)" d="M14.2,15.344a5.5,5.5,0,0,0,1.977-.884l1.147,4.507a1.675,1.675,0,0,1-2.392,1.859L13,19.9a2.32,2.32,0,0,0-2,0l-1.933.928a1.675,1.675,0,0,1-2.392-1.859L7.82,14.46a5.5,5.5,0,0,0,1.977.884m4.4,0a9.95,9.95,0,0,1-4.4,0m4.4,0a5.342,5.342,0,0,0,4.043-3.915,9.052,9.052,0,0,0,0-4.266A5.342,5.342,0,0,0,14.2,3.247a9.95,9.95,0,0,0-4.4,0A5.342,5.342,0,0,0,5.755,7.162a9.055,9.055,0,0,0,0,4.266A5.342,5.342,0,0,0,9.8,15.344" transform="translate(-4.496 -1.996)" fill="none" stroke="#7f3e98" stroke-width="2" />
                        </svg>
                    </span>
                    <span class="text"><?= $award ?></span>
                </li>
            <?php } ?>
        </ul>
    </div>
    <p itemprop="description" class="eltdf-cli-excerpt eltdf-cli-excerpt-real">
        <?php the_excerpt() ?>
    </p>
    <?php
}

add_action('course_meta', 'action_course_meta');


function action_academist_elated_action_after_page_title()
{

    $display = false;
    if (is_archive() || is_tax()) {
        $term = get_queried_object();

        if ($term->name == 'course') {
            $display = true;
        }
        if (is_archive()) {
            if ($term->taxonomy == 'course-category') {
                $display = true;
            }
        }
    }

    $filter_categories = get_terms(
        array(
            'taxonomy' => 'course-category',
        )
    );

    if ($display) {
    ?>
        <div class="background-accent-color-alt eltdf-course-list-holder eltdf-course-list-holder-v2 eltdf-grid-list    eltdf-large-space eltdf-cl-has-filter-category ">
            <div class="eltdf-grid">
                <div class="eltdf-cl-filter-holder">
                    <div class="eltdf-plf-inner">
                        <?php
                        if (is_array($filter_categories) && count($filter_categories)) { ?>
                            <ul>
                                <li class="eltdf-cl-filter <?= $term->name == 'course' ? 'eltdf-cl-current' : '' ?>">
                                    <a href="<?= get_post_type_archive_link('course') ?>">
                                        <span class="icon">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16.002" height="15.601" viewBox="0 0 16.002 15.601">
                                                <g id="Group_117" data-name="Group 117" transform="translate(-310 -851.699)">
                                                    <path id="Path_84" data-name="Path 84" d="M3,3.474C1.533,3.644.135,3.115.011,2.042S.859.2,2.325.032s2.872.32,3,1.4S4.465,3.307,3,3.474" transform="translate(310 860.242) rotate(-90)" fill="currentColor" />
                                                    <path id="Path_85" data-name="Path 85" d="M4,3.662C2.534,3.829.13,3.111.011,2.031S.859.2,2.321.027,6.174.508,6.294,1.579,5.465,3.488,4,3.662" transform="translate(313.956 858.005) rotate(-90)" fill="currentColor" />
                                                    <path id="Path_86" data-name="Path 86" d="M4,3.66C2.537,3.831.135,3.113.011,2.033S.859.2,2.324.026,6.173.5,6.3,1.583,5.464,3.492,4,3.66" transform="translate(318.679 858.941) rotate(-90)" fill="currentColor" />
                                                    <path id="Path_87" data-name="Path 87" d="M3.037.044C1.574-.157.162.342.016,1.415S.827,3.27,2.284,3.472s2.877-.258,3.025-1.329S4.5.244,3.037.044" transform="translate(322.484 861.515) rotate(-90)" fill="currentColor" />
                                                    <path id="Path_88" data-name="Path 88" d="M7.889,9.058a3.113,3.113,0,0,0,.124-4.292C6.392,3.555,6.234,3.276,5.949,2.577A3.336,3.336,0,0,0,3.132,0,2.4,2.4,0,0,0,.839,1.729C-.227,4.551-.275,9.247.684,11.493a2.149,2.149,0,0,0,2.2,1.366c1.634-.268,2.089-1.642,2.838-2.331A13.01,13.01,0,0,1,7.889,9.058" transform="translate(310.617 867.301) rotate(-90)" fill="currentColor" />
                                                </g>
                                            </svg>
                                        </span>
                                        <span class="text"><?php esc_html_e('All Courses', 'academist-core') ?></span>
                                    </a>
                                </li>
                                <?php foreach ($filter_categories as $cat) { ?>
                                    <li class="eltdf-cl-filter <?= $term->term_id == $cat->term_id ? 'eltdf-cl-current' : '' ?>">
                                        <a href="<?= get_term_link($cat->term_id) ?>">
                                            <span class="icon">
                                                <?= get__term_meta($cat->term_id, 'svg_icon') ?>
                                            </span>
                                            <span class="text"><?php echo esc_html($cat->name); ?></span>
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="course-search">
            <form action="https://fourpaws.theprogressteam.com/" class="eltdf-search-cover eltdf-is-active" method="get" style="height: 95px; display: block;">
                <div class="eltdf-container">
                    <div class="eltdf-container-inner clearfix">
                        <div class="eltdf-form-holder-outer">
                            <div class="eltdf-form-holder">
                                <div class="eltdf-form-holder-inner">
                                    <span aria-hidden="true" class="eltdf-icon-font-elegant icon_search "></span>
                                    <input type="text" placeholder="Search" name="s" value="<?= isset($_GET['s']) ? $_GET['s'] : '' ?>" class="eltdf_search_field" autocomplete="off">
                                    <input type="hidden" name="post_type" value="course">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    <?php
    }
}

add_action('academist_elated_action_after_page_title', 'action_academist_elated_action_after_page_title');

function get__post_titles($post_id = '', $post_type = 'instructor', $meta_key = 'location_')
{
    $post_id = $post_id ? $post_id : get_the_ID();
    $all_location = get__post_meta('all_location');
    $locations = get__posts($post_type);
    $get__post_titles = '';
    if ($all_location) {
        $get__post_titles .= '<div class="location-checkbox" style="display: none" location-key="_all_location">All Location</div>';
    }
    foreach ($locations as $key => $location) {
        if (get__post_meta_by_id($post_id, $meta_key . $key) || $all_location) {
            $get__post_titles .= '<div class="location-checkbox" location-key="_location_' . $key . '">' . $location . '</div>';
        }
    }
    return $get__post_titles;
}
function course_length($duration, $parameter)
{
    if ($duration == '1') {
        if ($parameter == 'days') {
            $parameter = 'day';
        } else if ($parameter == 'hours') {
            $parameter = 'hour';
        } else if ($parameter == 'weeks') {
            $parameter == 'week';
        }
    }
    return $duration . ' ' . $parameter;
}
function course_details()
{
    echo wc_print_notices();
    ?>
    <div class="heading-box">
        <h3>Course Details</h3>
    </div>
    <?php
    $duration = get__post_meta('duration');;
    $parameter = get__post_meta('duration_parameters');
    $award = get__post_meta('award');
    $course_type = get__post_meta('course_type');

    $full_price = get__post_meta('full_price');
    $award = get__post_meta('award');
    $deposit_payment = get__post_meta('deposit_payment');
    ?>

    <div class="course-meta course-meta-single">
        <div class="row">
            <?php if ($course_type) { ?>
                <div class="col-12 col-md-auto">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16.66" height="16.66" viewBox="0 0 16.66 16.66">
                            <g id="clock-square-svgrepo-com" transform="translate(-1 -1)">
                                <path id="Path_89" data-name="Path 89" d="M12,8v2.932l1.832,1.832" transform="translate(-2.67 -1.602)" fill="none" stroke="#7f3e98" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                <path id="Path_90" data-name="Path 90" d="M2,9.33C2,5.875,2,4.147,3.073,3.073S5.875,2,9.33,2s5.183,0,6.256,1.073,1.073,2.8,1.073,6.256,0,5.183-1.073,6.256-2.8,1.073-6.256,1.073-5.183,0-6.256-1.073S2,12.785,2,9.33Z" fill="none" stroke="#7f3e98" stroke-width="2" />
                            </g>
                        </svg>
                        Course Type:
                    </span>
                    <span class="text"><?= $course_type ?></span>
                </div>
            <?php } ?>
            <?php if ($duration) { ?>
                <?php

                ?>
                <div class="col-12 col-md-auto">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16.66" height="16.66" viewBox="0 0 16.66 16.66">
                            <g id="clock-square-svgrepo-com" transform="translate(-1 -1)">
                                <path id="Path_89" data-name="Path 89" d="M12,8v2.932l1.832,1.832" transform="translate(-2.67 -1.602)" fill="none" stroke="#7f3e98" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                <path id="Path_90" data-name="Path 90" d="M2,9.33C2,5.875,2,4.147,3.073,3.073S5.875,2,9.33,2s5.183,0,6.256,1.073,1.073,2.8,1.073,6.256,0,5.183-1.073,6.256-2.8,1.073-6.256,1.073-5.183,0-6.256-1.073S2,12.785,2,9.33Z" fill="none" stroke="#7f3e98" stroke-width="2" />
                            </g>
                        </svg>
                        Course Length:
                    </span>
                    <span class="text"><?= course_length($duration, $parameter) ?></span>
                </div>
            <?php } ?>
            <?php if ($award) { ?>
                <div class="col-12 col-md-auto">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="15.008" height="20.034" viewBox="0 0 15.008 20.034">
                            <path id="award-svgrepo-com_2_" data-name="award-svgrepo-com (2)" d="M14.2,15.344a5.5,5.5,0,0,0,1.977-.884l1.147,4.507a1.675,1.675,0,0,1-2.392,1.859L13,19.9a2.32,2.32,0,0,0-2,0l-1.933.928a1.675,1.675,0,0,1-2.392-1.859L7.82,14.46a5.5,5.5,0,0,0,1.977.884m4.4,0a9.95,9.95,0,0,1-4.4,0m4.4,0a5.342,5.342,0,0,0,4.043-3.915,9.052,9.052,0,0,0,0-4.266A5.342,5.342,0,0,0,14.2,3.247a9.95,9.95,0,0,0-4.4,0A5.342,5.342,0,0,0,5.755,7.162a9.055,9.055,0,0,0,0,4.266A5.342,5.342,0,0,0,9.8,15.344" transform="translate(-4.496 -1.996)" fill="none" stroke="#7f3e98" stroke-width="2" />
                        </svg>
                        Certification:
                    </span>
                    <span class="text"><?= $award ?></span>
                </div>
            <?php } ?>
            <?php if (get__post_titles()) { ?>
                <div class="col-12 col-md-auto">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="19.822" viewBox="0 0 18 19.822">
                            <g id="location" transform="translate(-3 -2)">
                                <path id="Path_115" data-name="Path 115" d="M12.816,20.608C16.851,18.55,20,15.143,20,11A8,8,0,0,0,4,11c0,4.143,3.149,7.55,7.184,9.608A1.8,1.8,0,0,0,12.816,20.608Z" fill="none" stroke="#7f3e98" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                                <path id="Path_116" data-name="Path 116" d="M15,11a3,3,0,1,1-3-3A3,3,0,0,1,15,11Z" fill="none" stroke="#7f3e98" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" />
                            </g>
                        </svg>
                        Location(s):
                    </span>
                    <span class="text"><?= get__post_titles() ?></span>
                </div>
            <?php } ?>
            <div class="col-12 col-md-auto">
                <div class="price-box">
                    <span class="price">
                        <?php
                        if ($deposit_payment) {
                            echo get_woocommerce_currency_symbol() . $full_price;
                        } else {
                            echo course_price();
                        }
                        ?>
                    </span>
                    <?php if ($deposit_payment) { ?>
                        <span class="desc"><?= course_price(get_the_ID(), true) ?> </span>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

<?php
}
add_action('course_details', 'course_details');


//Courses Tabs

if (!function_exists('academist_lms_single_course_tabs_modified')) {
    /**
     * Add course tabs to single course pages.
     *
     * @param array $tabs
     *
     * @return array
     */
    function academist_lms_single_course_tabs_modified($tabs = array())
    {
        global $post;
        $course_sections = get_post_meta(get_the_ID(), 'eltdf_course_curriculum', true);
        $member_list = get_post_meta(get_the_ID(), 'eltdf_course_members_meta', true);
        $forum_id = get_post_meta(get_the_ID(), 'eltdf_course_forum_meta', true);

        $show_content = $post->post_content ? true : false;
        $show_curriculum = !empty($course_sections);
        $show_members = !empty($member_list);
        $show_forum = !empty($forum_id);


        // Description tab - shows course content
        if ($show_content) {
            $tabs['description'] = array(
                'title'    => __('Description', 'academist-lms'),
                'icon'     => '<i class="lnr lnr-pencil" aria-hidden="true"></i>',
                'priority' => 10,
                'template' => 'content'
            );
        }

        $tabs['course_breakdown'] = array(
            'title'    => __('Course Breakdown', 'academist-lms'),
            'icon'     => '<i class="lnr lnr-pencil" aria-hidden="true"></i>',
            'priority' => 20,
            'template' => 'course_breakdown'
        );
        $qualification_details = get__post_meta('qualification_details');
        if ($qualification_details) {
            $tabs['qualification_details'] = array(
                'title'    => __('Qualification Details', 'academist-lms'),
                'icon'     => '<i class="lnr lnr-pencil" aria-hidden="true"></i>',
                'priority' => 30,
                'template' => 'qualification_details'
            );
        }
        $tabs['faqs'] = array(
            'title'    => __('FAQs', 'academist-lms'),
            'icon'     => '<i class="lnr lnr-pencil" aria-hidden="true"></i>',
            'priority' => 30,
            'template' => 'faqs'
        );
        $tabs['progression'] = array(
            'title'    => __('Progression', 'academist-lms'),
            'icon'     => '<i class="lnr lnr-pencil" aria-hidden="true"></i>',
            'priority' => 30,
            'template' => 'progression'
        );

        // Reviews tab - shows reviews
        $tabs['reviews'] = array(
            'title'    => __('Reviews', 'academist-lms'),
            'icon'     => '<i class="lnr lnr-star" aria-hidden="true"></i>',
            'priority' => 30,
            'template' => 'reviews-list'
        );


        unset($tabs['forum']);
        unset($tabs['members']);
        unset($tabs['curriculum']);

        return $tabs;
    }

    add_filter('academist_elated_filter_single_course_tabs', 'academist_lms_single_course_tabs_modified', 999);
}


if (!function_exists('academist_lms_single_instructor_tabs_modified')) {
    /**
     * Add instructor tabs to single instructor pages.
     *
     * @param array $tabs
     *
     * @return array
     */
    function academist_lms_single_instructor_tabs_modified($tabs = array())
    {
        // Course tab - shows instructor courses
        // Curriculum tab - shows instructor curriculum
        $tabs['information'] = array(
            'title'    => __('Information', 'academist-lms'),
            'icon'     => '<i class="lnr lnr-bookmark" aria-hidden="true"></i>',
            'priority' => 10,
            'template' => 'content'
        );

        $tabs['courses_tab'] = array(
            'title'    => __('All Courses', 'academist-lms'),
            'icon'     => '<i class="lnr lnr-book" aria-hidden="true"></i>',
            'priority' => 20,
            'template' => 'custom-courses'
        );

        $tabs['reviews'] = array(
            'title'    => __('Reviews', 'academist-lms'),
            'icon'     => '<i class="lnr lnr-book" aria-hidden="true"></i>',
            'priority' => 20,
            'template' => 'reviews'
        );
        $tabs['the_team'] = array(
            'title'    => __('The Team', 'academist-lms'),
            'icon'     => '<i class="lnr lnr-book" aria-hidden="true"></i>',
            'priority' => 20,
            'template' => 'the_team'
        );
        $tabs['faqs'] = array(
            'title'    => __('FAQs', 'academist-lms'),
            'icon'     => '<i class="lnr lnr-book" aria-hidden="true"></i>',
            'priority' => 20,
            'template' => 'faqs'
        );
        $tabs['articles'] = array(
            'title'    => __('Articles', 'academist-lms'),
            'icon'     => '<i class="lnr lnr-book" aria-hidden="true"></i>',
            'priority' => 20,
            'template' => 'articles'
        );
        unset($tabs['curriculum']);
        unset($tabs['courses']);


        return $tabs;
    }

    add_filter('academist_elated_filter_single_instructor_tabs', 'academist_lms_single_instructor_tabs_modified', 999);
}



function course_breakdown()
{
    $course_breakdown = get__post_meta('course_breakdown');
?>
    <div class="eltdf-course-content">
        <h3 class="eltdf-course-content-title">Course Breakdown</h3>
        <section class="wpb-content-wrapper">
            <?php
            if ($course_breakdown) {
                echo wpautop($course_breakdown);
            }
            ?>
        </section>
    </div>
<?php
}

add_action('course_breakdown', 'course_breakdown');


function qualification_details()
{
    $qualification_details = get__post_meta('qualification_details');
?>
    <div class="eltdf-course-content">
        <h3 class="eltdf-course-content-title">Qualification Details</h3>
        <section class="wpb-content-wrapper">
            <?php
            if ($qualification_details) {
                echo wpautop($qualification_details);
            }
            ?>
        </section>
    </div>
<?php
}

add_action('qualification_details', 'qualification_details');



function progression()
{
    $progression = get__post_meta('progression');
?>
    <div class="eltdf-course-content">
        <h3 class="eltdf-course-content-title">Progression</h3>
        <section class="wpb-content-wrapper">
            <?php
            if ($progression) {
                echo wpautop($progression);
            }
            ?>
        </section>
    </div>
<?php
}

add_action('progression', 'progression');

function faqs_location()
{
    $id = get_the_ID();
    $meta_key = '_location_' . $id;

    $args = array(
        'post_type'  => 'faqs_location',
        'numberposts' => -1,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key'   => $meta_key,
                'value' => 'yes',
            ),
            array(
                'key'   => '_all_location',
                'value' => 'yes',
            )
        )
    );
    $query_faqs = get_posts($args);
?>
    <div class="eltdf-course-content">
        <h3 class="eltdf-course-content-title">FAQs</h3>
        <section class="wpb-content-wrapper">
            <div class="eltdf-elements-holder eltdf-one-column eltdf-responsive-mode-768 ">
                <div class="eltdf-eh-item" data-item-class="eltdf-eh-custom-6955">
                    <div class="eltdf-eh-item-inner">
                        <div class="eltdf-eh-item-content eltdf-eh-custom-6955">
                            <div class="vc_empty_space" style="height: 14px"><span class="vc_empty_space_inner"></span>
                            </div>
                            <div class="eltdf-accordion-holder eltdf-ac-default eltdf-toggle eltdf-ac-simple clearfix accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset">
                                <?php foreach ($query_faqs as $faq) { ?>
                                    <h5 class="eltdf-accordion-title ui-accordion-header ui-corner-top ui-state-default ui-corner-bottom">
                                        <span class="eltdf-tab-title"><?= $faq->post_title ?></span>
                                    </h5>
                                    <div class="eltdf-accordion-content ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" style="display: none;">
                                        <div class="eltdf-accordion-content-inner">

                                            <div class="wpb_text_column wpb_content_element ">
                                                <div class="wpb_wrapper">
                                                    <?= wpautop($faq->post_content) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php
}

function faqs_courses()
{
    $terms = get_the_terms(get_the_ID(), 'course-category');

    $terms_arr = array();
    foreach ($terms as $term) {
        $terms_arr[] = $term->term_id;
    }
    $args = array(
        'post_type'  => 'faqs',
        'numberposts' => -1,
        'tax_query' => array(
            array(
                'taxonomy' => 'course-category',
                'field'    => 'term_id',
                'terms'    => $terms_arr,
            ),
        )

    );
    $query_faqs = get_posts($args);
?>
    <div class="eltdf-course-content">
        <h3 class="eltdf-course-content-title">FAQs</h3>
        <section class="wpb-content-wrapper">
            <div class="eltdf-elements-holder eltdf-one-column eltdf-responsive-mode-768 ">
                <div class="eltdf-eh-item" data-item-class="eltdf-eh-custom-6955">
                    <div class="eltdf-eh-item-inner">
                        <div class="eltdf-eh-item-content eltdf-eh-custom-6955">
                            <div class="vc_empty_space" style="height: 14px"><span class="vc_empty_space_inner"></span>
                            </div>
                            <div class="eltdf-accordion-holder eltdf-ac-default eltdf-toggle eltdf-ac-simple clearfix accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset">
                                <?php foreach ($query_faqs as $faq) { ?>
                                    <h5 class="eltdf-accordion-title ui-accordion-header ui-corner-top ui-state-default ui-corner-bottom">
                                        <span class="eltdf-tab-title"><?= $faq->post_title ?></span>
                                    </h5>
                                    <div class="eltdf-accordion-content ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom" style="display: none;">
                                        <div class="eltdf-accordion-content-inner">

                                            <div class="wpb_text_column wpb_content_element ">
                                                <div class="wpb_wrapper">
                                                    <?= wpautop($faq->post_content) ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
<?php
}

function faqs()
{
    if (get_post_type() == 'course') {
        echo faqs_courses();
    } else {
        echo faqs_location();
    }
}

add_action('faqs', 'faqs');

//instructor tabs

function reviews()
{
    $id = get_the_ID();
    $args = array();
    $args['post_type'] = 'testimonials';
    $args['numberposts'] = -1;
    $args['meta_query']['relation'] = 'OR';
    if (get_post_type() == 'instructor') {
        $meta_key = '_location_' . $id;
        $args['meta_query'][] = array(
            'key'   => '_all_location',
            'value' => 'yes',
        );
    } else {
        $meta_key = '_course_' . $id;
    }
    $args['meta_query'][] =   array(
        'key'   => $meta_key,
        'value' => 'yes',
    );


    $query_reviews = get_posts($args);
?>
    <div class="eltdf-course-reviews-list eltdf-reviews-list-custom">
        <div class="eltdf-comment-holder clearfix">
            <div class="eltdf-comment-holder-inner">
                <div class="eltdf-comments">
                    <ul class="eltdf-comment-list">
                        <?php foreach ($query_reviews as $review) { ?>

                            <?php
                            $review_title =   get_post_meta($review->ID, 'eltdf_testimonial_title', true);
                            $review_content = get_post_meta($review->ID, 'eltdf_testimonial_text', true);
                            $author = get_post_meta($review->ID, 'eltdf_testimonial_author', true);
                            $position = get_post_meta($review->ID, 'eltdf_testimonial_author_position', true);
                            ?>
                            <li>
                                <div class="eltdf-comment clearfix eltdf-post-author-comment">
                                    <div class="eltdf-comment-image"> </div>
                                    <div class="eltdf-comment-text">
                                        <div class="eltdf-comment-info">
                                            <h6 class="eltdf-comment-name vcard">
                                                <?= $author ?><span class="position">, <?= $position ?></span>
                                            </h6>
                                            <div class="date">
                                                <?= get_the_date('', $review->ID) ?>
                                            </div>
                                            <div class="eltdf-review-rating">
                                                <span class="eltdf-rating-inner">
                                                    <span class="eltdf-rating-value">
                                                        <i class="icon_star" aria-hidden="true"></i>
                                                        <i class="icon_star" aria-hidden="true"></i>
                                                        <i class="icon_star" aria-hidden="true"></i>
                                                        <i class="icon_star" aria-hidden="true"></i>
                                                        <i class="icon_star" aria-hidden="true"></i>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="eltdf-text-holder" id="comment-70">
                                            <div class="eltdf-review-title">
                                                <span><?= $review_title ?></span>
                                            </div>
                                            <?= wpautop($review_content) ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- li is closed by wordpress after comment rendering -->
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php
}
add_action('reviews', 'reviews');


function the_team()
{
    $id = get_the_ID();
    $meta_key = '_location_' . $id;
    $args = array(
        'post_type'  => 'team-member',
        'numberposts' => -1,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key'   => $meta_key,
                'value' => 'yes',
            ),
            array(
                'key'   => '_all_location',
                'value' => 'yes',
            )
        )
    );
    $query_post = get_posts($args);

?>
    <div class="eltdf-course-content">
        <h3 class="eltdf-course-content-title">The Team</h3>
        <section class="wpb-content-wrapper">
            <div class="eltdf-team-list-holder eltdf-grid-list eltdf-disable-bottom-space eltdf-three-columns eltdf-normal-space">
                <div class="eltdf-tl-inner eltdf-outer-space " data-number-of-columns="three" data-enable-navigation="no" data-enable-pagination="no">
                    <?php foreach ($query_post as $post) { ?>
                        <div class="eltdf-team eltdf-item-space info-bellow">
                            <div class="eltdf-team-inner">
                                <div class="eltdf-team-image">
                                    <a itemprop="url" href="<?= get_permalink($post->ID) ?>">
                                        <img loading="lazy" decoding="async" src="<?= get_the_post_thumbnail_url($post->ID, 'large') ?>" class="attachment-full size-full wp-post-image" alt="<?= $post->post_title ?>">
                                    </a>
                                </div>
                                <div class="eltdf-team-info">
                                    <div class="eltdf-team-title-holder">
                                        <h4 itemprop="name" class="eltdf-team-name entry-title">
                                            <a itemprop="url" href="<?= get_permalink($post->ID) ?>"><?= $post->post_title ?></a>
                                        </h4>
                                    </div>
                                    <div class="eltdf-team-text">
                                        <div class="eltdf-team-text-inner">
                                            <div class="eltdf-team-description">
                                                <p itemprop="description" class="eltdf-team-excerpt">
                                                    <?= get_the_excerpt($post->ID) ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="eltdf-team-social-holder-between">
                                        <div class="eltdf-team-social">
                                            <div class="eltdf-team-social-inner">
                                                <div class="eltdf-team-social-wrapp">
                                                    <?php
                                                    $team_social_icons = academist_core_single_team_social_icons($post->ID);
                                                    ?>
                                                    <?php foreach ($team_social_icons as $team_social_icon) {
                                                        echo wp_kses_post($team_social_icon);
                                                    } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </section>
    </div>
<?php
}

add_action('the_team', 'the_team');

function articles()
{
    $id = get_the_ID();
    $meta_key = '_location_' . $id;

    $args = array(
        'post_type'  => 'post',
        'numberposts' => -1,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key'   => $meta_key,
                'value' => 'yes',
            ),
            array(
                'key'   => '_all_location',
                'value' => 'yes',
            )
        )
    );
    $query_post = get_posts($args);
?>
    <div class="eltdf-course-content">
        <h3 class="eltdf-course-content-title">Articles</h3>
        <section class="wpb-content-wrapper">
            <?php if ($query_post) { ?>
                <div class="eltdf-blog-holder eltdf-blog-pagination-standard eltdf-grid-list eltdf-grid-masonry-list eltdf-two-columns eltdf-normal-space eltdf-blog-masonry-in-grid" data-next-page="2" data-max-num-pages="2" data-post-number="6" data-excerpt-length="56">
                    <div class="eltdf-blog-holder-inner eltdf-outer-space " style="position: relative; height: 2115.27px; opacity: 1;">
                        <div class="eltdf-masonry-grid-sizer"></div>
                        <div class="eltdf-masonry-grid-gutter"></div>
                        <?php foreach ($query_post as $article) { ?>
                            <?php $post_id = $article->ID ?>
                            <article id="post-<?= $post_id ?>" class="eltdf-post-has-media eltdf-item-space post-<?= $post_id ?> post type-post status-publish format-standard has-post-thumbnail hentry category-dog-grooming">
                                <div class="eltdf-post-content">
                                    <div class="eltdf-post-heading">

                                        <div class="eltdf-post-image">
                                            <a itemprop="url" href="https://fourpaws.theprogressteam.com/adopting-one-of-the-kennel-clubs-top-five-most-popular-breeds-3/" title="Adopting one of the Kennel Club’s top five most popular breeds?">
                                                <img width="402" height="283" src="<?= get_the_post_thumbnail_url($post_id, 'large') ?>" class="attachment-full size-full wp-post-image" decoding="async">
                                                <?= post_category('', $post_id) ?>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="eltdf-post-text">
                                        <div class="eltdf-post-text-inner">
                                            <div class="eltdf-post-text-main">
                                                <div class="content">
                                                    <h2 itemprop="name" class="entry-title eltdf-post-title">
                                                        <a itemprop="url" href="<?= get_permalink($post_id) ?>" title="Adopting one of the Kennel Club’s top five most popular breeds?">
                                                            <?= get_the_title($post_id) ?>
                                                        </a>
                                                    </h2>
                                                    <div itemprop="dateCreated" class="eltdf-post-info-date entry-date published updated">
                                                        <a itemprop="url" href="#">
                                                            <?= get_the_date('', $post_id) ?>
                                                        </a>
                                                        <meta itemprop="interactionCount" content="UserComments: 0">
                                                    </div>
                                                    <div class="eltdf-post-excerpt-holder">
                                                        <p itemprop="description" class="eltdf-post-excerpt">
                                                            <?= get_the_excerpt($post_id) ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="button-box">
                                                    <a itemprop="url" href="<?= get_permalink($post_id) ?>" target="_self" class="eltdf-btn eltdf-btn-medium eltdf-btn-solid eltdf-btn-arrow button-accent">
                                                        <span class="eltdf-btn-text">Read more</span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        <?php } ?>
                    </div>
                </div>
            <?php } ?>

        </section>
    </div>
<?php
}

add_action('articles', 'articles');

//post-types\course\templates\single\layout-collections\default.php
function course_add_to_cart()
{
    $text_below_price_long = get__post_meta('text_below_price_long');
    $deposit_payment = get__post_meta('deposit_payment');
    $full_price = get__post_meta('full_price');
?>
    <div class="add-to-cart-wrapper">
        <div class="row">
            <div class="col">
                <div class="price-box">
                    <div class="d-flex">
                        <span class="price">
                            <?php
                            if ($deposit_payment) {
                                echo get_woocommerce_currency_symbol() . $full_price;
                            } else {
                                echo course_price();
                            }
                            ?>
                        </span>
                        <?php if ($deposit_payment) { ?>
                            <span class="desc" style="margin-left: 20px"><?= course_price(get_the_ID(), true) ?> </span>
                        <?php } ?>
                    </div>

                    <p class="desc"><?= $text_below_price_long ?></p>

                </div>
            </div>
            <div class="col-auto">
                <?= do_shortcode('[course_add_to_cart_button]') ?>
            </div>
        </div>
    </div>
<?php
}

add_action('course_add_to_cart', 'course_add_to_cart');





//Add star rating to location(instructor)

if (!function_exists('academist_core_rating_posts_types_modifed')) {
    function academist_core_rating_posts_types_modifed()
    {
        $post_types = array('instructor');

        return $post_types;
    }

    add_filter('academist_core_filter_rating_post_types', 'academist_core_rating_posts_types_modifed');
}


add_filter('wp_list_comments_args', function ($r) {
    if (function_exists('wpse_comment_callback'))
        $r['callback'] = 'wpse_comment_callback';
    return $r;
});



function action_widgets_init()
{
    register_sidebar(
        array(
            'name'          => 'Instructor Sidebar',
            'id'            => 'instructor_sidebar',
            'before_widget' => '<div>',
            'after_widget'  => '</div>',
            'before_title'  => '<h4 class="eltdf-widget-title">',
            'after_title'   => '</h4>',
        )
    );
}
add_action('widgets_init', 'action_widgets_init');


function location_map()
{
?>
    <div class="map">
        <?= do_shortcode('[wp_simple_locator_map]') ?>
    </div>
    <?php
}

add_action('location_map', 'location_map');


//four-paws-lms\post-types\instructor\templates\single\parts\courses.php
function single_instructor_courses()
{
    $id = get_the_ID();
    $meta_key = '_location_' . $id;

    $args = array(
        'post_type'  => 'course',
        'numberposts' => -1,
        'meta_query' => array(
            'relation' => 'OR',
            array(
                'key'   => $meta_key,
                'value' => 'yes',
            ),
            array(
                'key'   => '_all_location',
                'value' => 'yes',
            )
        )
    );
    $query_course = get_posts($args);
    $post_ids = array();

    foreach ($query_course as $course) {
        $post_ids[] = $course->ID;
    }
    $args = array(
        'post_type' => 'course',
        'posts_per_page' => -1,
        'post__in' => $post_ids,
    );
    $query_course = new WP_Query($args);

    if ($query_course->have_posts()) {

    ?>
        <div class="eltdf-course-list-holder eltdf-grid-list eltdf-disable-bottom-space clearfix eltdf-cl-gallery eltdf-three-columns eltdf-normal-space eltdf-cl-standard eltdf-cl-pag-load-more      " data-number-of-columns="three" data-space-between-items="normal" data-number-of-items="6" data-enable-image="yes" data-image-proportions="full" data-orderby="date" data-order="DESC" data-item-layout="standard" data-enable-title="yes" data-title-tag="h4" data-enable-instructor="yes" data-enable-price="yes" data-enable-excerpt="yes" data-excerpt-length="60" data-enable-students="yes" data-enable-category="yes" data-category-boxed="yes" data-enable-ratings="yes" data-pagination-type="load-more" data-filter="no" data-filter-order-by="name" data-enable-article-animation="no" data-course-slider-on="no" data-enable-loop="yes" data-enable-autoplay="yes" data-slider-speed="5000" data-slider-speed-animation="600" data-enable-navigation="yes" data-enable-pagination="yes" data-widget="no" data-filter-center="no" data-max-num-pages="5" data-next-page="2">
            <div class="eltdf-cl-inner eltdf-outer-space">
                <?php while ($query_course->have_posts()) {
                    $query_course->the_post(); ?>
                    <article class="eltdf-cl-item eltdf-item-space post-3786 course type-course status-publish has-post-thumbnail hentry course-category-canine-qualifications course-tag-courses-home" data-name="ipet-network-level-2-award-in-responsible-dog-ownership" data-date="1701129600">
                        <div class="eltdf-cl-item-inner">
                            <div class="eltdf-cli-image">
                                <img width="2048" height="1365" src="<?= get_the_post_thumbnail_url(get_the_ID(), 'medium') ?>" class="attachment-full size-full wp-post-image" alt="" decoding="async" srcset="<?= get_the_post_thumbnail_url(get_the_ID(), 'medium') ?> 2048w, https://fourpaws.theprogressteam.com/wp-content/uploads/2023/11/1D2A4366-300x200.jpg 300w, https://fourpaws.theprogressteam.com/wp-content/uploads/2023/11/1D2A4366-1024x683.jpg 1024w, https://fourpaws.theprogressteam.com/wp-content/uploads/2023/11/1D2A4366-768x512.jpg 768w, https://fourpaws.theprogressteam.com/wp-content/uploads/2023/11/1D2A4366-1536x1024.jpg 1536w, https://fourpaws.theprogressteam.com/wp-content/uploads/2023/11/1D2A4366-600x400.jpg 600w" sizes="(max-width: 2048px) 100vw, 2048px">
                                <?php do_action('course_level') ?>
                            </div>
                            <div class="eltdf-cli-text-holder">
                                <div class="eltdf-cli-text-wrapper">
                                    <div class="eltdf-cli-text">
                                        <div class="eltdf-cli-top-info">
                                            <h4 itemprop="name" class="eltdf-cli-title entry-title">
                                                <a itemprop="url" href="<?php the_permalink() ?>" target="_self">
                                                    <?php the_title() ?>
                                                </a>
                                            </h4>
                                            <?php do_action('course_meta') ?>
                                        </div>
                                        <div class="eltdf-cli-bottom-info d-flex align-items-center">
                                            <div class="price">
                                                <div class="eltdf-ci-price-holder">
                                                    <span class="eltdf-ci-price-value">
                                                        <?= course_price(false, false, true) ?>
                                                    </span>
                                                </div>
                                            </div>
                                            <a itemprop="url" href="<?php the_permalink() ?>" target="_self" style="color: #ffffff;" class="eltdf-btn eltdf-btn-medium eltdf-btn-solid eltdf-btn-arrow button-accent">
                                                <span class="eltdf-btn-text">Read More</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div> <a itemprop="url" class="eltdf-cli-link eltdf-block-drag-link" href="<?php the_permalink() ?>"></a>
                        </div>
                    </article>
                <?php } ?>
                <?php wp_reset_postdata() ?>
            </div>
        </div>
<?php
    } else {
        echo 'No course found in this location.';
    }
}

add_action('single_instructor_courses', 'single_instructor_courses');


function wp_modify_taxonomy()
{

    // get the arguments of the already-registered taxonomy
    $custom_category_args = get_taxonomy('course-category');

    // make changes to the args
    $custom_category_args->rewrite['slug'] = 'qualifications';

    // re-register the taxonomy
    register_taxonomy('course-category', 'course', (array) $custom_category_args);
}
add_action('init', 'wp_modify_taxonomy', 11);
