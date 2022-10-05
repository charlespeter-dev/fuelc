<?php
/**
 * The Template for displaying all single posts
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context         = Timber::context();
$timber_post     = Timber::get_post();
$context['post'] = $timber_post;
wp_enqueue_style( 'single-site', get_template_directory_uri() . '/assets/css/post.css', array(), '1.9992', 'all');	 
wp_enqueue_script( 'single-script', get_template_directory_uri() . '/assets/js/post.js', array ( 'jquery' ), 1.9992, true);
if ( post_password_required( $timber_post->ID ) ) {
	Timber::render( 'single-password.twig', $context );
} else {
	Timber::render(array('single-event.twig'), $context);
}
