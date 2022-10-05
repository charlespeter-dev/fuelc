<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Methods for TimberHelper can be found in the /functions sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();
wp_enqueue_style( 'page-site', get_template_directory_uri() . '/assets/css/404.css', array(), '1.9992', 'all');	 
Timber::render( '404.twig', $context );
