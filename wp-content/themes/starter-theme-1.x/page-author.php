<?php

/**
 * Template Name: Authors
 */

$excerpt_limit = 30;

$author_ids = [
    'fcadmin' => 8, // Victoria Shakespeare
    'kstockman' => 4, // Kalyn Stockman
];

foreach ($author_ids as $author_id) {

    $authors_posts = new WP_Query([
        'fields' => 'ids',
        'post_status' => 'publish',
        'author' => $author_id,
        'orderby' => 'ID',
        'order' => 'DESC'
    ]);

    // Get author's profile picture URL using ACF
    $profile_picture = get_field('profile_picture', 'user_' . $author_id);
    if (!empty($profile_picture)) {
        $profile_picture_url = $profile_picture['url'];
        $profile_picture = $profile_picture_url;
    } else {
        // Set a default profile picture URL or handle the case when no picture is available
        $default_avatar_url = get_avatar_url($author_id);
        $profile_picture_url = $default_avatar_url;
    }
    // $profile_picture_url = get_field('profile_picture', 'user_' . $author_id)['url'];
    $display_name = get_the_author_meta('display_name', $author_id);
    $description = get_the_author_meta('description', $author_id);
    $url = get_author_posts_url($author_id);
    $post_ids = $authors_posts->posts;
    // Get social media field data
    $facebook_id = get_the_author_meta('facebook', $author_id);
    $instagram_id = get_the_author_meta('instagram', $author_id);
    $linkedin_id = get_the_author_meta('linkedin', $author_id);

    /**
     * excerpts
     */

    $description = explode(' ', $description);
    $description = array_splice($description, 0, 30);
    $description = implode(' ', $description);
    $description = $description . '...';

    $authors[] = [
        'profile_picture_url' => $profile_picture_url,
        'display_name' => $display_name,
        'description' => $description,
        'url' => $url,
        'post_ids' => $post_ids,
        'facebook_id' => $facebook_id,
        'instagram_id' => $instagram_id,
        'linkedin_id' => $linkedin_id
    ];
}

// print_r($authors);
// exit;


$css_absolute_path = sprintf('%s/assets/css/%s.css', get_stylesheet_directory(), 'authors');
$css_url = sprintf('%s/assets/css/%s.css', get_stylesheet_directory_uri(), 'authors');

if (file_exists($css_absolute_path)) {
    wp_enqueue_style('authors', $css_url, [], false, 'screen');
}

global $timber;

$context = $timber::context();
$context['authors'] = $authors;
$timber::render('authors.twig', $context);
