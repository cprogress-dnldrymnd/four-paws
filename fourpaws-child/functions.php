<?php

/*** Child Theme Function  ***/

if ( ! function_exists( 'academist_elated_child_theme_enqueue_scripts' ) ) {
	function academist_elated_child_theme_enqueue_scripts() {
		$parent_style = 'academist-elated-default-style';
		
		wp_enqueue_style( 'academist-elated-child-style', get_stylesheet_directory_uri() . '/style.css', array( $parent_style ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'academist_elated_child_theme_enqueue_scripts' );
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