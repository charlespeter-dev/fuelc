<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/templates/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context = Timber::context();

$timber_post     = new Timber\Post();
$context['post'] = $timber_post;
$args = array(
    'post_type' => array('brand'),
    'posts_per_page' => 1,
    'numberposts' => 1,
    'orderby' => 'menu_order',
    'order' => 'ASC',
);
$context['brands'] = Timber::get_posts($args)[0];
$file = get_field( 'hero_video_bg' );
$context['file_url'] = $file['url'];
wp_enqueue_style( 'page-site', get_template_directory_uri() . '/assets/css/'.$timber_post->post_name .'.css', array(), '1.9992', 'all');	 
wp_enqueue_script( 'page-script', get_template_directory_uri() . '/assets/js/'.$timber_post->post_name.'.js', array ( 'jquery' ), 1.9992, true);
$context['slick_slider'] = 'true';

Timber::render( array( 'page-' . $timber_post->post_name . '.twig', 'page.twig' ), $context );
