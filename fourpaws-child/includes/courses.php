<?php

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
<?php
}

add_action('course_level', 'action_course_level');



function action_course_meta()
{
?>
    <?php
    $duration = get__post_meta('duration');
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
                    <span class="text"><?= $duration ?></span>
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

    <?php
}

add_action('course_meta', 'action_course_meta');


function action_academist_elated_action_after_page_title()
{

    $display = false;
    if (is_archive() || is_taxonomy()) {
        $term = get_queried_object();

        if ($term->name == 'course') {
            $display = true;
        } else {
        }
        if (is_archive()) {
            if ($term->taxonomy == 'course-category') {
                $display = true;
            }
        }
    }

    $filter_categories = get_terms(array(
        'taxonomy'   => 'course-category',
    ));

    if ($display) {
    ?>
        <div class="background-accent eltdf-course-list-holder eltdf-course-list-holder-v2 eltdf-grid-list eltdf-disable-bottom-space clearfix eltdf-cl-gallery eltdf-three-columns eltdf-large-space eltdf-cl-standard eltdf-cl-pag-no-pagination  eltdf-cl-has-filter-category ">
            <div class="eltdf-grid">
                <div class="eltdf-cl-filter-holder">
                    <div class="eltdf-plf-inner">
                        <?php
                        if (is_array($filter_categories) && count($filter_categories)) { ?>
                            <ul>
                                <li class="eltdf-cl-filter" data-filter="">
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
                                </li>
                                <?php foreach ($filter_categories as $cat) { ?>
                                    <li class="eltdf-cl-filter">
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

<?php
    }
}

add_action('academist_elated_action_after_page_title', 'action_academist_elated_action_after_page_title');
