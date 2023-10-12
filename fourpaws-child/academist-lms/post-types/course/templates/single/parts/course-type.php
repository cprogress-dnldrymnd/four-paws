<?php
$course_free  = get_post_meta( get_the_ID(), 'eltdf_course_free_meta', true );
$course_class = $course_free === 'yes' ? 'eltdf-free-course' : '';
$currency_postition = get_option( 'woocommerce_currency_pos' );
?>
<span class="eltdf-course-single-type <?php echo esc_attr( $course_class ); ?>">
  <?php if ( $course_free === 'yes' ) {
	  esc_html_e( 'Free', 'academist-lms' );
  } else {
    if($currency_postition==='left'){
      echo get_woocommerce_currency_symbol() . academist_lms_calculate_course_price( get_the_ID() );
    } else{
      echo academist_lms_calculate_course_price( get_the_ID() ) . get_woocommerce_currency_symbol() ;
    }
	  
  }
  ?>
</span>