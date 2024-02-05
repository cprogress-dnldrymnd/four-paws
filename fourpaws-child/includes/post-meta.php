<?php

use Carbon_Fields\Container;
use Carbon_Fields\Complex_Container;
use Carbon_Fields\Field;
/*
Container::make('theme_options', __('Theme Option'))
	->add_fields(
		array(
			Field::make('complex', 'our_schools', 'Our Schools')
				->add_fields(
					array(
						Field::make('text', 'school', __('School')),

					)
				)
				->set_layout('tabbed-vertical')
				->set_header_template('<%- school  %>'),


		)
	);*/
/*-----------------------------------------------------------------------------------*/
/* Slider
/*-----------------------------------------------------------------------------------*/

Container::make('post_meta', __('Slider Properties'))
	->where('post_type', '=', 'slider')
	->add_fields(
		array(
			Field::make('complex', 'slides', 'Slides')
				->add_fields(
					array(
						Field::make('image', 'image', __('Background Image')),
						Field::make('text', 'heading', __('Heading')),
						Field::make('textarea', 'description', __('Description')),
						Field::make('text', 'button_text_1', __('Button Text[1'))->set_width(50),
						Field::make('text', 'button_link_1', __('Button Link[1'))->set_width(50),
						Field::make('text', 'button_text_2', __('Button Text[1'))->set_width(50),
						Field::make('text', 'button_link_2', __('Button Link[2'))->set_width(50),

					)
				)
				->set_layout('grid')
				->set_header_template('<%- heading  %>'),


		)
	);


/*-----------------------------------------------------------------------------------*/
/* Courses Categories
/*-----------------------------------------------------------------------------------*/

Container::make('term_meta', __('Category Properties'))
	->where('term_taxonomy', '=', 'course-category')
	->or_where('term_taxonomy', '=', 'product_cat')
	->add_fields(array(
		Field::make('textarea', 'svg_icon', __('SVG Icon')),
	));


/*-----------------------------------------------------------------------------------*/
/* Course Settings
/*-----------------------------------------------------------------------------------*/
$testimonials = array();
foreach (get__posts('testimonials') as $key => $testimonial) {
	$testimonials[] = Field::make('checkbox', 'testimonial_' . $key, __($testimonial))->set_width(33);
}
Container::make('post_meta', __('Course Properties'))
	->where('post_type', '=', 'course')
	->add_tab(
		'General Settings',
		array(
			Field::make('checkbox', 'deposit_payment', __('Deposit Payment'))->set_width(20),
			Field::make('text', 'full_price', __('Full Price'))->set_width(80)
				->set_help_text('Please input deposit payment at price field  <a href="#eltdf_course_price_container">below</a>')
				->set_conditional_logic(array(
					array(
						'field' => 'deposit_payment',
						'value' => true,
					)
				)),
			Field::make('text', 'course_type', __('Course Type')),
			Field::make('text', 'duration', __('Course Duration')),
			Field::make('select', 'duration_parameters', __('Course Duration Parameters'))
				->set_options(array(
					'' => 'None',
					'minutes' => 'Minutes',
					'hours' => 'Hour(s)',
					'days' => 'Day(s)',
					'weeks' => 'Week(s)',
				)),
			Field::make('text', 'level', __('Level')),
			Field::make('text', 'award', __('Award')),
			//Field::make('rich_text', 'text_below_price', 'Text Below Price'),
			Field::make('rich_text', 'text_below_price_long', 'Long Text Below Price'),

		)
	)
	->add_tab(
		'Related Courses',
		array(
			Field::make('select', 'related_courses_type', 'Related Courses Type')
				->set_options(array(
					'category' => 'By Category',
					'manual' => 'Manual Selection',
					'random' => 'Random',
				)),
			Field::make('multiselect', 'related_courses', 'Related Courses')
				->add_options(get__posts('course'))
				->set_conditional_logic(array(
					array(
						'field' => 'related_courses_type',
						'value' => 'manual',
						'compare' => '=',
					)
				))
		)
	)
	->add_tab(
		'Course Breakdown',
		array(
			Field::make('rich_text', 'course_breakdown', __('')),
		)
	)
	->add_tab(
		'Qualification Details',
		array(
			Field::make('rich_text', 'qualification_details', __('')),
		)
	)
	->add_tab(
		'Progression',
		array(
			Field::make('rich_text', 'progression', __('')),
		)
	)
	->add_tab(
		'Reviews',
		$testimonials
	);

$locations[] = Field::make('checkbox', 'all_location', __('All Location'));
foreach (get__posts() as $key => $location) {
	$locations[] = Field::make('checkbox', 'location_' . $key, __($location))
		->set_conditional_logic(array(
			array(
				'field' => 'all_location',
				'value' => true,
				'compare' => '!=',
			)
		));
}

$courses = array();
foreach (get__posts('course') as $key => $course) {
	$courses[] = Field::make('checkbox', 'course_' . $key, __($course));
}
Container::make('post_meta', __('Course Locations'))
	->where('post_type', '=', 'course')
	->set_context('side')
	->add_fields($locations);

Container::make('post_meta', __('FAQs Locations'))
	->where('post_type', '=', 'faqs_location')
	->set_context('side')
	->add_fields($locations);

Container::make('post_meta', __('Posts/Articles Locations'))
	->where('post_type', '=', 'post')
	->set_context('side')
	->add_fields($locations);

Container::make('post_meta', __('Team Locations'))
	->where('post_type', '=', 'team-member')
	->set_context('side')
	->add_fields($locations);

/*-----------------------------------------------------------------------------------*/
/* Location Settings
/*-----------------------------------------------------------------------------------*/
Container::make('theme_options', 'Location Settings')
	->set_page_parent('edit.php?post_type=instructor')
	->add_fields(
		array(
			Field::make('rich_text', 'location_intro_text', 'Intro Text'),
			Field::make('association', 'location_pages_bottom_content', 'Location Single Pages Bottom Content')
				->set_types(array(
					array(
						'type'      => 'post',
						'post_type' => 'rc_blocks',
					)
				)),

				Field::make('association', 'location_pages_after_single_content', 'Location Single Pages After Content')
				->set_types(array(
					array(
						'type'      => 'post',
						'post_type' => 'rc_blocks',
					)
				)),


				
			Field::make('association', 'location_archive_pages_bottom_content', 'Location Archive Page Bottom Content')
				->set_types(array(
					array(
						'type'      => 'post',
						'post_type' => 'rc_blocks',
					)
				))
		)
	);
Container::make('post_meta', __('Location Settings'))
	->where('post_type', '=', 'instructor')
	->set_context('side')
	->add_fields(array(
		Field::make('text', 'location_email_address', 'Email Address')
	));

/*-----------------------------------------------------------------------------------*/
/* Testimonial Settings
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', __('Review Locations'))
	->where('post_type', '=', 'testimonials')
	->set_context('side')
	->add_fields($locations);

Container::make('post_meta', __('Review Course'))
	->where('post_type', '=', 'testimonials')
	->set_context('side')
	->add_fields($courses);


/*-----------------------------------------------------------------------------------*/
/* Theme Settings
/*-----------------------------------------------------------------------------------*/

Container::make('theme_options', 'Theme Settings')
	->set_page_parent('themes.php')
	->add_fields(
		array(
			Field::make('association', 'footer_global_sections', 'Footer Global Sections')
				->set_types(array(
					array(
						'type'      => 'post',
						'post_type' => 'rc_blocks',
					)
				))
		)
	);


/*-----------------------------------------------------------------------------------*/
/* Event Settings
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', __('Event Settings'))
	->where('post_type', '=', 'tribe_events')
	->add_fields(array(
		Field::make('association', 'course', __('Course'))
			->set_max(1)
			->set_types(array(
				array(
					'type'      => 'post',
					'post_type' => 'course',
				)
			))
	));
