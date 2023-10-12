<?php

/*** Child Theme Function  ***/

if (!function_exists('academist_elated_child_theme_enqueue_scripts')) {
	function academist_elated_child_theme_enqueue_scripts()
	{
		$parent_style = 'academist-elated-default-style';

		wp_enqueue_style('academist-elated-child-style', get_stylesheet_directory_uri() . '/style.css', array($parent_style));

		wp_enqueue_style('academist-elated-swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css');
		wp_enqueue_script('academist-elated-swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js');
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
require_once('includes/courses.php');

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


function action_wp_footer()
{
?>
	<script>
		var swiper = new Swiper(".mySwiperHero", {
			pagination: {
				el: ".swiper-pagination",
				clickable: true
			},
			on: {
				slideChange: function() {
					$count = jQuery('.progress').attr('count');
					$index = this.realIndex + 1;
					$per_progress = 100 / $count;
					jQuery('.progress').css('--progress', $per_progress * $index + '%');
				}
			}
		});
	</script>
<?php
}

add_action('wp_footer', 'action_wp_footer');

add_filter( 'get_comment_author', 'wpse_use_user_real_name', 10, 3 ) ;

//use registered commenter first and/or last names if available
function wpse_use_user_real_name( $author, $comment_id, $comment ) {

    $firstname = '' ;
    $lastname = '' ;

    //returns 0 for unregistered commenters
    $user_id = $comment->user_id ;

    if ( $user_id ) {

        $user_object = get_userdata( $user_id ) ;

        $firstname = $user_object->user_firstname ;

        $lastname = $user_object->user_lastname ; 

    }

    if ( $firstname || $lastname ) {

        $author = $firstname . ' ' . $lastname ; 

        //remove blank space if one of two names is missing
        $author = trim( $author ) ;

    }

    return $author ;

}