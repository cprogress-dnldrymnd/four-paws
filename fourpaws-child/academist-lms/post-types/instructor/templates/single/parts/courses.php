<?php if ( ! empty( $courses ) ) {
	echo academist_elated_execute_shortcode( 'eltdf_course_list', $courses );
} else {
	esc_html_e( 'Sorry, no posts matched your criteria.', 'academist-lms' );
}