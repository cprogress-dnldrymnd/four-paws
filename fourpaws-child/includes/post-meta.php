<?php

use Carbon_Fields\Container;
use Carbon_Fields\Complex_Container;
use Carbon_Fields\Field;


/*-----------------------------------------------------------------------------------*/
/* Webinar
/*-----------------------------------------------------------------------------------*/

Container::make('post_meta', 'Webinar Settings')
	->set_priority('high')
	->or_where('post_type', '=', 'webinars')
	->add_fields(
		array(
			Field::make('text', 'alt_title', __('Alt Title')),
			Field::make('textarea', 'description', __('Description')),
			Field::make('oembed', 'video', __('Video')),
			Field::make('text', 'minutes', __('Minutes')),
			Field::make('date', 'date', __('Date')),
			Field::make('time', 'time', __('Time')),
			Field::make('text', 'form_title', __('Form Title'))->set_help_text('Default is SAVE YOUR SEAT'),
			Field::make('textarea', 'form', __('Form')),
		)
	);
