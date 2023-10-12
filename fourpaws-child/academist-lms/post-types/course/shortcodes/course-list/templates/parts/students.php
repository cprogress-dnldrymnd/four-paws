<?php
$students = academist_lms_retrieve_user_ids_from_a_course_id( get_the_ID() );

if (empty($students)) {
	$students = array();
}

$students_number = count( $students );
?>
<div class="eltdf-students-number-holder">
	<span aria-hidden="true" class="icon dripicons-user eltdf-student-icon"></span>
	<span>
    <?php echo esc_html( $students_number ); ?>
    <?php esc_html_e( 'Students', 'academist-lms' ) ?>
    </span>
</div>
