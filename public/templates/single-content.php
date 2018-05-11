<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Api_Post_Creator
 */

$meta = get_post_custom( $post->ID );

?>

<div class="wrap-job">
	
	<?php

		/**
		 * single-content hook
		 */
		do_action( 'api-post-single-content', $meta );


	?>

</div>