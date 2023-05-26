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

// Add author's information to the context
$author_id = $timber_post->post_author;
$author = new Timber\User($author_id);

// Get author's profile picture URL using ACF
$profile_picture = get_field('profile_picture', 'user_' . $author_id);
// Check if author's profile picture URL exists
if (!empty($profile_picture)) {
	$profile_picture_url = $profile_picture['url'];
	$author->profile_picture_url = $profile_picture_url;
} else {
	// Set a default profile picture URL or handle the case when no picture is available
	$default_avatar_url = get_avatar_url($author_id);
	$author->profile_picture_url = $default_avatar_url;;
}


$description = get_the_author_meta('description', $author_id);
// Check if author's description exists
if (!empty($description)) {
	// Make excerpt of author's description
	$description_words = explode(' ', $description);
	$excerpt_words = array_splice($description_words, 0, 30);
	$excerpt = implode(' ', $excerpt_words);
	$author->description_excerpt = $excerpt . '...';
} else {
	// Handle the case when no description is available
	$author->description_excerpt = 'No description available.';
}

// Get author's Facebook
$author->facebook = get_the_author_meta('facebook', $author_id);
// Get author's Instagram
$author->instagram = get_the_author_meta('instagram', $author_id);
// Get author's LinkedIn
$author->linkedin = get_the_author_meta('linkedin', $author_id);


// Get author's bio page link
$author->url = get_author_posts_url($author_id);

$context['author'] = $author;

$args['search_filter_id'] = 27217;
$context['ttcposts'] = new Timber\PostQuery($args);
$context['pagination'] = Timber::get_pagination();

/**
 * page got password?
 */

$page_got_passwd = false;

if (post_password_required($timber_post->ID)) {
	$page_got_passwd = true;

	$css_url = sprintf('%s/assets/css/%s.css', get_stylesheet_directory_uri(), 'password-form');
	wp_enqueue_style('password-form', $css_url, [], false, 'screen');
}

/**
 * specific css/js
 */

$css_absolute_path = sprintf('%s/assets/css/%s.css', get_stylesheet_directory(), 'post');
$js_absolute_path  = sprintf('%s/assets/js/%s.js', get_stylesheet_directory(), 'post');

$css_url = sprintf('%s/assets/css/%s.css', get_stylesheet_directory_uri(), 'post');
$js_url = sprintf('%s/assets/js/%s.js', get_stylesheet_directory_uri(), 'post');

if (file_exists($css_absolute_path)) {
	wp_enqueue_style('page-site', $css_url, [], false, 'screen');
}

if (file_exists($js_absolute_path)) {
	wp_enqueue_script('page-script', $js_url, ['jquery'], false, true);
}

/**
 * render
 */

if ($page_got_passwd) {
	Timber::render('single-password.twig', $context);
} else {
	Timber::render(array('single-' . $timber_post->ID . '.twig', 'single-' . $timber_post->post_type . '.twig', 'single-' . $timber_post->slug . '.twig', 'single.twig'), $context);
}
