<?php

global $post, $paged, $timber;

if (!isset($paged) || !$paged) {
	$paged = 1;
}

$author_id = $post->post_author;

$author_posts_args = [
	'fields' => 'ids',
	'post_status' => 'publish',
	'author' => $author_id,
	'orderby' => 'ID',
	'order' => 'DESC',
	'posts_per_page' => 10,
	'paged' => $paged
];

$context = $timber::context();
$context['ttcposts'] = new Timber\PostQuery($author_posts_args);
$context['pagination'] = $timber::get_pagination();

$author = [
	'profile_picture_url' => get_field('profile_picture', 'user_' . $author_id)['url'],
	'display_name' => get_the_author_meta('display_name', $author_id),
	'description' => get_the_author_meta('description', $author_id),
	'url' => get_author_posts_url($author_id)
];

$css_absolute_path = sprintf('%s/assets/css/%s.css', get_stylesheet_directory(), 'resource-hub');
$css_url = sprintf('%s/assets/css/%s.css', get_stylesheet_directory_uri(), 'resource-hub');

if (file_exists($css_absolute_path)) {
	wp_enqueue_style('author', $css_url, [], false, 'screen');
}


$context['author'] = $author;
$timber::render('author.twig', $context);
