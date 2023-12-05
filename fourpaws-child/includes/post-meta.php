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

$args = array(
	'numberposts' => -1,
	'post_type'   => 'instructor'
);

$locations = get_posts($args);

$location_arr = array();
foreach ($locations as $location) {
	return array(
		Field::make('checkbox', $location->ID, __($location->post_title))
	);
}
Container::make('post_meta', __('Course Locations'))
	->where('post_type', '=', 'course')
	->set_context('side')
	->add_fields($location_arr);
/*-----------------------------------------------------------------------------------*/
/* Location Settings
/*-----------------------------------------------------------------------------------*/
Container::make('post_meta', __('Location Properties'))
	->where('post_type', '=', 'instructor')
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
	)
	->add_tab(
		'Articles',
		array(
			Field::make('association', 'articles', __(''))
				->set_types(array(
					array(
						'type'      => 'post',
						'post_type' => 'post',
					)
				))
		)
	);

Container::make('theme_options', 'Location Settings')
	->set_page_parent('edit.php?post_type=instructor')
	->add_fields(
		array(
			Field::make('rich_text', 'location_intro_text', 'Intro Text')
		)
	);
