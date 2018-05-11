<?php
/**
 * The template for displaying all single jobs posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package api_post_creator
 */

if ( ! defined( 'ABSPATH' ) ) { exit; } // Exit if accessed directly

/**
 * Get a custom header-post.php file, if it exists.
 * Otherwise, get default header.
 */
get_header( 'api-post' );

if ( have_posts() ) :
	

	while ( have_posts() ) : the_post();
	
		include api_post_creator_get_template( 'single-content' );
		
	endwhile;

endif;

get_footer( 'api-post' );