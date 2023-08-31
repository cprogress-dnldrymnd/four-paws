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


function action_academist_elated_action_after_page_title() {
    ?>
dsdsds
    <?php
}

add_action( 'academist_elated_action_after_page_title','action_academist_elated_action_after_page_title' );