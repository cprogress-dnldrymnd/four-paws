<?php

/*** Child Theme Function  ***/

if (!function_exists('academist_elated_child_theme_enqueue_scripts')) {
	function academist_elated_child_theme_enqueue_scripts()
	{
		$parent_style = 'academist-elated-default-style';

		wp_enqueue_style('academist-elated-child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));
	}

	add_action('wp_enqueue_scripts', 'academist_elated_child_theme_enqueue_scripts');
}
/*-----------------------------------------------------------------------------------*/
/* Register Carbofields
/*-----------------------------------------------------------------------------------*/
add_action('carbon_fields_register_fields', 'tissue_paper_register_custom_fields');
function tissue_paper_register_custom_fields()
{
	require_once('includes/post-meta.php');
}
require_once('includes/post-types.php');
require_once('includes/shortcodes.php');

function get__post_meta($value)
{
	if (function_exists('carbon_get_the_post_meta')) {
		return carbon_get_the_post_meta($value);
	} else {
		return 'Error: Carbonfield not activated';
	}
}

function get__term_meta($term_id, $value)
{
	if (function_exists('carbon_get_term_meta')) {
		return carbon_get_term_meta($term_id, $value);
	} else {
		return 'Error: Carbonfield not activated';
	}
}

function get__post_meta_by_id($id, $value)
{
	if (function_exists('carbon_get_post_meta')) {
		return carbon_get_post_meta($id, $value);
	} else {
		return 'Error: Carbonfield not activated';
	}
}
function get__theme_option($value)
{
	if (function_exists('carbon_get_theme_option')) {
		return carbon_get_theme_option($value);
	} else {
		return 'Error: Carbonfield not activated';
	}
}
