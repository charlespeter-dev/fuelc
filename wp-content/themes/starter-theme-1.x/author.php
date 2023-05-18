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
	'url' => get_author_posts_url($author_id),
	// Get the published works acf repeater field data
	'years_of_experience' => get_field('years_of_experience', 'user_' . $author_id),
	// Get the published works acf repeater field data
	'published_works_list' => get_field('published_works​', 'user_' . $author_id),
	// Get citations acf repeater field data
	'citations' => get_field('citations', 'user_' . $author_id),
	// Get degrees and/or titles​ acf repeater field data
	'degrees_andor_titles' => get_field('degrees_andor_titles​', 'user_' . $author_id),
	// Get conference appearances titles​ acf repeater field data
	'conference_appearances' => get_field('conference_appearances', 'user_' . $author_id),
	// Get media coverage appearances titles​ acf repeater field data
	'media_coverage' => get_field('media_coverage', 'user_' . $author_id),
	// Get past jobs coverage appearances titles​ acf repeater field data
	'past_jobs' => get_field('past_jobs', 'user_' . $author_id),
	// Get social media field data
	'facebook' => get_the_author_meta('facebook', $post->post_author),
	'instagram' => get_the_author_meta('instagram', $post->post_author),
	'linkedin' => get_the_author_meta('linkedin', $post->post_author)
];

$css_absolute_path = sprintf('%s/assets/css/%s.css', get_stylesheet_directory(), 'resource-hub');
$css_url = sprintf('%s/assets/css/%s.css', get_stylesheet_directory_uri(), 'resource-hub');

if (file_exists($css_absolute_path)) {
	wp_enqueue_style('author', $css_url, [], false, 'screen');
}


$context['author'] = $author;
$timber::render('author.twig', $context);
