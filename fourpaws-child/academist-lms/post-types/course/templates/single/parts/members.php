<?php
$show_members = get_post_meta( get_the_ID(), 'eltdf_course_members_meta', true );

if ( $show_members === 'yes' && academist_lms_is_woocommerce_installed() ) {
	$user_ids = academist_lms_retrieve_user_ids_from_a_course_id( get_the_ID() );
	?>
	<div class="eltdf-course-members">
		<div class="eltdf-course-members-heading">
			<h3 class="eltdf-course-members-title"><?php esc_html_e('Members', 'academist-lms'); ?></h3>
			<p class="eltdf-course-members-description"><?php esc_html_e('Lorem Ipsn gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auci elit consequat ipsutis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non mauris vitae erat consequat auctor eu in elit.', 'academist-lms') ?></p>
		</div>
		<div class="eltdf-course-members-items">
			<h4 class="eltdf-course-members-items-heading">
                <?php esc_html_e('Total number of students in course:', 'academist-lms'); ?>
                <?php

                if ( ! empty( $user_ids ) ) {
                    $number_of_users = count($user_ids);
                    ?>
                    <span class="eltdf-course-members-items-number"><?php echo esc_html($number_of_users); ?></span>
                    <?php
                }

                ?>
            </h4>
			<ul>
				<?php
				if ( ! empty( $user_ids ) ) {
					foreach ( $user_ids as $id ) { ?>
						<li>
							<span class="eltdf-course-member-item">
								<span class="eltdf-course-member-image">
									<?php echo get_avatar( $id, 78 ); ?>
								</span>
								<span class="eltdf-course-member-content">
									<span class="eltdf-course-member-author-title"><?php echo esc_html( get_the_author_meta( 'display_name', $id ) ); ?></span>
									<span class="eltdf-course-member-author-position"><?php echo esc_html( get_the_author_meta( 'position', $id ) ); ?></span>
								</span>
								<span class="eltdf-course-member-description">
									<?php echo esc_html( get_the_author_meta( 'description', $id ) ); ?>
								</span>
							</span>
						</li>
					<?php }
				}
				?>
			</ul>
		</div>
	</div>
<?php }