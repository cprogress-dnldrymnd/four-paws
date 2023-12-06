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
Container::make('post_meta', __('Course Properties'))
	->where('post_type', '=', 'course')
	->add_tab(
		'General Settings',
		array(
			Field::make('text', 'level', __('Level')),
			Field::make('text', 'award', __('Award')),
			Field::make('rich_text', 'text_below_price', 'Text Below Price'),
			Field::make('rich_text', 'text_below_price_long', 'Long Text Below Price'),

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
		'FAQs',
		array(
			Field::make('complex', 'faqs', __(''))
				->add_fields(array(
					Field::make('text', 'heading', __('Heading')),
					Field::make('rich_text', 'description', __('Description')),

				))
				->set_layout('tabbed-vertical')
				->set_header_template('<%- heading %>')
		)
	);

$location_arr[] = Field::make('checkbox', 'all_location', __('All Location'));
foreach (location_arr() as $key => $location) {
	$location_arr[] = Field::make('checkbox', 'location_' . $key, __($location))
		->set_conditional_logic(array(
			array(
				'field' => 'all_location',
				'value' => true, // Optional, defaults to "". Should be an array if "IN" or "NOT IN" operators are used.
				'compare' => '!=', // Optional, defaults to "=". Available operators: =, <, >, <=, >=, IN, NOT IN
			)
		));
}
Container::make('post_meta', __('Course Locations'))
	->where('post_type', '=', 'course')
	->set_context('side')
	->add_fields($location_arr);

Container::make('post_meta', __('FAQs Locations'))
	->where('post_type', '=', 'faqs')
	->set_context('side')
	->add_fields($location_arr);

Container::make('post_meta', __('Posts/Articles Locations'))
	->where('post_type', '=', 'post')
	->set_context('side')
	->add_fields($location_arr);
/*-----------------------------------------------------------------------------------*/
/* Location Settings
/*-----------------------------------------------------------------------------------*/
Container::make('theme_options', 'Location Settings')
	->set_page_parent('edit.php?post_type=instructor')
	->add_fields(
		array(
			Field::make('rich_text', 'location_intro_text', 'Intro Text')
		)
	);
