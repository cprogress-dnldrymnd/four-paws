<?php

use Carbon_Fields\Container;
use Carbon_Fields\Complex_Container;
use Carbon_Fields\Field;


/*-----------------------------------------------------------------------------------*/
/* Webinar
/*-----------------------------------------------------------------------------------*/

Container::make('post_meta', 'Webinar Settings')
	->set_priority('high')
	->or_where('post_type', '=', 'slider')
	->add_fields(
		array(
			Field::make('complex', 'Slider', __('Slider'))
				->add_fields(array(
					Field::make('text', 'image', __('Background Image')),
					Field::make('text', 'alt_title', __('Alt Title')),
					Field::make('textarea', 'description', __('Description')),
					Field::make('text', 'button_text_1', __('Button Text[1'))->set_width(50),
					Field::make('text', 'button_link_1', __('Button Link[1'))->set_width(50),
					Field::make('text', 'button_text_2', __('Button Text[1'))->set_width(50),
					Field::make('text', 'button_link_2', __('Button Link[2'))->set_width(50),

				))
		)
	);
