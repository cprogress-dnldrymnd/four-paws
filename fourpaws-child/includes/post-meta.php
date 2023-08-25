<?php

use Carbon_Fields\Container;
use Carbon_Fields\Complex_Container;
use Carbon_Fields\Field;

/*-----------------------------------------------------------------------------------*/
/* Product Attributes
/*-----------------------------------------------------------------------------------*/

Container::make('post_meta', __('Slider Properties'))
	->where('post_type', '=', 'slider')
	->add_fields(
		array(
			Field::make('complex', 'slides', 'Slides')
				->add_fields(
					array(
						Field::make('text', 'image', __('Background Image')),
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
