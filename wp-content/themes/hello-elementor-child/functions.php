<?php


// class StarterSite extends Timber\Site
// {

//     public function __construct()
//     {
//         add_filter('timber/twig', array($this, 'add_to_twig'));
//         add_action('init', array($this, 'register_brands_post_type'));
//         parent::__construct();
//     }

//     public function register_brands_post_type()
//     {
//         $labels = array(
//             'name' => _x('Brands', 'Post Type General Name', 'brands'),
//             'singular_name' => _x('Brand', 'Post Type Singular Name', 'brand'),
//             'menu_name' => __('Brands', 'brands'),
//             'name_admin_bar' => __('Brands', 'brands'),
//             'archives' => __('Brand Archives', 'brands'),
//             'attributes' => __('Brand Attributes', 'brands'),
//             'parent_item_colon' => __('Parent Brand:', 'brands'),
//             'all_items' => __('All Brands', 'brands'),
//             'add_new_item' => __('Add New Brand', 'brands'),
//             'add_new' => __('Add New Brand', 'brands'),
//             'new_item' => __('New Brand', 'brands'),
//             'edit_item' => __('Edit Brand', 'brands'),
//             'update_item' => __('Update Brand', 'brands'),
//             'view_item' => __('View Brand', 'brands'),
//             'view_items' => __('View Brands', 'brands'),
//             'search_items' => __('Search Brands', 'brands'),
//             'not_found' => __('Not found', 'brands'),
//             'not_found_in_trash' => __('Not found in Trash', 'brands'),
//             'featured_image' => __('Featured Image', 'brands'),
//             'set_featured_image' => __('Set featured image', 'brands'),
//             'remove_featured_image' => __('Remove featured image', 'brands'),
//             'use_featured_image' => __('Use as featured image', 'brands'),
//             'insert_into_item' => __('Insert into brand', 'brands'),
//             'uploaded_to_this_item' => __('Uploaded to this brand', 'brands'),
//             'items_list' => __('Brands list', 'brands'),
//             'items_list_navigation' => __('Brands list navigation', 'brands'),
//             'filter_items_list' => __('Filter brands list', 'brands'),
//         );
//         $args = array(
//             'label' => __('Brand', 'brands'),
//             'description' => __('Brand', 'brands'),
//             'labels' => $labels,
//             'show_in_rest' => true,
//             'supports' => array(
//                 'title',
//                 'editor',
//                 'thumbnail',
//                 'revisions',
//             ),
//             'taxonomies' => array('event_type', 'post_tag'),
//             'hierarchical' => false,
//             'public' => true,
//             'show_ui' => true,
//             'show_in_menu' => true,
//             'menu_position' => 7,
//             'menu_icon' => 'dashicons-admin-site-alt',
//             'show_in_admin_bar' => true,
//             'show_in_nav_menus' => true,
//             'can_export' => true,
//             'has_archive' => false,
//             'exclude_from_search' => false,
//             'publicly_queryable' => true,
//             'capability_type' => 'post',
//             'rewrite' => true
//         );
//         register_post_type('brand', $args);
//     }

//     public function add_to_twig($twig)
//     {
//         $twig->addExtension(new Twig\Extension\StringLoaderExtension());
//         return $twig;
//     }
// }

// new StarterSite();

/**
 * styles & scripts
 */

add_action('wp_head', function () {
    wp_enqueue_style('greycliff-cf', 'https://use.typekit.net/ekk3zyz.css', [], HELLO_ELEMENTOR_VERSION);
    wp_enqueue_style('font-awesome-v6', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css', [], HELLO_ELEMENTOR_VERSION);
    wp_enqueue_style('bootstrap-container', get_stylesheet_directory_uri() . '/assets/css/bootstrap-container.css', [], HELLO_ELEMENTOR_VERSION);
    wp_enqueue_style('timber-oldfc', get_stylesheet_directory_uri() . '/assets/css/timber-oldfc.css', [], time());
}, PHP_INT_MAX);

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('custom-header-menu', get_stylesheet_directory_uri() . '/assets/js/custom-header-menu.js?t=' . time(), [], time(), true);
});

/**
 * adjust <nav> when user logged in
 */

if (is_user_logged_in()) {
    add_action('wp_head', function () {
        ?>

        <style type="text/css">
            #main-navbar {
                margin-top: 32px !important;
            }

            main {
                margin-top: 85px;
            }

            @media screen and (max-width: 782px) {
                #main-navbar {
                    margin-top: 46px !important;
                }
            }

            @media screen and (max-width: 600px) {
                #wpadminbar {
                    position: fixed !important;
                }
            }

            @media screen and (max-width: 992px) {
                main {
                    margin-top: 66px;
                }
            }
        </style>

        <?php
    });
} else {
    add_action('wp_head', function () {
        ?>

        <style type="text/css">
            main {
                margin-top: 85px;
            }

            @media screen and (max-width: 992px) {
                main {
                    margin-top: 66px;
                }
            }
        </style>

        <?php
    });
}

/**
 * 1. will exclude certains URL from the sitemap.xml
 * 2. will identify which URL is a redirection and return the final destinantion instead
 */

add_filter('wpseo_xml_sitemap_post_url', function ($url, $post) {

    $excluded = [
        'https://fuelcycle.com/blog/introducing-fuel-cycles-newest-sales-director/',
        'https://fuelcycle.com/blog/mining-patient-ecosystem-market-research-can-help-understand-patients-journey/',
        'https://fuelcycle.com/blog/reckoning-facebooks-missteps-personalize-ads-without-creeping-audience/',
        'https://fuelcycle.com/blog/mobile-banking-leading-future-finance-whats-hang/',
    ];

    $_pprredirect_url = get_post_meta($post->ID, '_pprredirect_url', true) ?? null;
    $_pprredirect_type = get_post_meta($post->ID, '_pprredirect_type', true) ?? null;
    $_pprredirect_active = get_post_meta($post->ID, '_pprredirect_active', true) ?? null;

    if ($_pprredirect_url && $_pprredirect_type == 301 && $_pprredirect_active) {

        // ---------------------------------------------
        // check again if the 'dest' have redirection
        // ---------------------------------------------

        $basename = basename(parse_url($_pprredirect_url)['path']);
        $new_pprredirect_url = get_page_by_path($basename, OBJECT, ['post', 'page']);

        $_pprredirect_url_l2 = get_post_meta($new_pprredirect_url->ID, '_pprredirect_url', true) ?? null;
        $_pprredirect_type_l2 = get_post_meta($new_pprredirect_url->ID, '_pprredirect_type', true) ?? null;
        $_pprredirect_active_l2 = get_post_meta($new_pprredirect_url->ID, '_pprredirect_active', true) ?? null;

        if (strpos($_pprredirect_url, 'fuelcycle.com') !== false && strpos(get_bloginfo('url'), 'fuelcycle.com') !== false) {

            if (!in_array($_pprredirect_url, $excluded)) {

                if ($_pprredirect_url_l2 && $_pprredirect_type_l2 == 301 && $_pprredirect_active_l2) {
                    return $_pprredirect_url_l2;
                }

                return $_pprredirect_url;
            }
        } else {

            // -------------------------------
            // debug mode in local
            // Yoast doesn't allow external URLs
            // -------------------------------

            $_pprredirect_url = str_replace('fuelcycle.com', 'fuelcycle.test', $_pprredirect_url);
            $_pprredirect_url_l2 = str_replace('fuelcycle.com', 'fuelcycle.test', $_pprredirect_url_l2);

            // $redirection = [
            //     'src' => get_the_permalink($post->ID),
            //     'dest1' => $_pprredirect_url,
            //     'dest2' => $_pprredirect_url_l2
            // ];

            // print_r($redirection);

            if (!in_array($_pprredirect_url, $excluded)) {

                if ($_pprredirect_url_l2 && $_pprredirect_type_l2 == 301 && $_pprredirect_active_l2) {
                    return $_pprredirect_url_l2;
                }

                return $_pprredirect_url;
            }
        }
    }

    return $url;
}, 10, 2);

/**
 * helper to echo the latest resources in the top nav
 */

function fc_get_latest_resource($mobile = false)
{
    $args = [
        'category_name' => 'ebook,webinar,white-paper,guide-book,infographic,video,case-study,industry-report,podcast',
        'order' => 'DESC',
        'orderby' => 'date',
        'posts_per_page' => 1
    ];

    $results = new WP_Query($args);
    wp_reset_postdata();

    $post = $results->post;

    /**
     * thumbnail
     */

    $attachmend_id = get_field('featured_image', $post->ID) ?? null;

    if (!$attachmend_id) {
        $attachmend_id = get_post_thumbnail_id($post->ID);
    }

    $img = wp_get_attachment_image_url($attachmend_id, '_2x-nav-featured-image');


    /**
     * categories
     */

    $cats = [];
    foreach (get_the_category($post->ID) as $c) {
        $cat = get_category($c);
        $cats[] = $cat->name;
    }

    $categories = implode(', ', $cats);

    /**
     * title
     */

    $title = get_the_title($post->ID);

    /**
     * permalink
     */

    $permalink = get_the_permalink($post->ID);

    /**
     * excerpts
     */

    $excerpts = get_the_excerpt($post->ID);

    ?>

    <?php if (!$mobile): ?>
        <div class="subnav-3-right-wrapper">
            <div class="line-divider"></div>
            <div>
                <img class="featured-post-image" src="<?= $img ?>" alt="" />
            </div>
            <div class="featured-post-text-area">
                <span class="d-block featured-post-category mt-25px">
                    <?= $categories ?>
                </span>
                <a href="<?= $permalink ?>" class="subnav-link-a">
                    <span class="featured-post-title">
                        <?= $title ?>
                    </span>
                    <p class="featured-post-paragraph">
                        <?= $excerpts ?>
                    </p>
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="subnav-3-right-wrapper-mobile">
            <div>
                <img class="featured-post-image img-fluid" src="<?= $img ?>" alt="" />
            </div>
            <div class="featured-post-text-area-mobile pr-1">
                <span class="d-block featured-post-category">
                    <?= $categories ?>
                </span>
                <a href="<?= $permalink ?>" class="subnav-link-a">
                    <span class="featured-post-title featured-post-title-mobile">
                        <?= $title ?>
                    </span>
                    <p class="featured-post-paragraph featured-post-paragraph-mobile">
                        <?= $excerpts ?>
                    </p>
                </a>
            </div>
        </div>
    <?php endif ?>

    <?php
}

/**
 * helper to echo the latest press in the top nav
 */

function fc_get_latest_press($mobile = false)
{
    $args = [
        'category_name' => 'press',
        'order' => 'DESC',
        'orderby' => 'date',
        'posts_per_page' => 1
    ];

    $results = new WP_Query($args);
    wp_reset_postdata();

    $post = $results->post;

    /**
     * thumbnail
     */

    $attachmend_id = get_field('featured_image', $post->ID) ?? null;

    if (!$attachmend_id) {
        $attachmend_id = get_post_thumbnail_id($post->ID);
    }

    $img = wp_get_attachment_image_url($attachmend_id, '_2x-nav-featured-image');


    /**
     * categories
     */

    $cats = [];
    foreach (get_the_category($post->ID) as $c) {
        $cat = get_category($c);
        $cats[] = $cat->name;
    }

    $categories = implode(', ', $cats);

    /**
     * title
     */

    $title = get_the_title($post->ID);

    /**
     * permalink
     */

    $permalink = get_the_permalink($post->ID);

    /**
     * excerpts
     */

    $excerpts = get_the_excerpt($post->ID);

    ?>

    <?php if (!$mobile): ?>
        <div class="subnav-3-right-wrapper">
            <div class="line-divider"></div>
            <div>
                <img class="featured-post-image" src="<?= $img ?>" alt="" />
            </div>
            <div class="featured-post-text-area">
                <span class="d-block featured-post-category mt-25px">
                    <?= $categories ?>
                </span>
                <a href="<?= $permalink ?>" class="subnav-link-a">
                    <span class="featured-post-title">
                        <?= $title ?>
                    </span>
                    <p class="featured-post-paragraph">
                        <?= $excerpts ?>
                    </p>
                </a>
            </div>
        </div>
    <?php else: ?>
        <div class="subnav-3-right-wrapper-mobile">
            <div>
                <img class="featured-post-image img-fluid" src="<?= $img ?>" alt="" />
            </div>
            <div class="featured-post-text-area-mobile pr-1">
                <span class="d-block featured-post-category">
                    <?= $categories ?>
                </span>
                <a href="<?= $permalink ?>" class="subnav-link-a">
                    <span class="featured-post-title featured-post-title-mobile">
                        <?= $title ?>
                    </span>
                    <p class="featured-post-paragraph featured-post-paragraph-mobile">
                        <?= $excerpts ?>
                    </p>
                </a>
            </div>
        </div>
    <?php endif ?>

    <?php
}

/**
 * helper to echo the ACF flexiable footer content only in pages
 */

function flexible_footer_content()
{
    if (is_page()) {
        $options = get_fields('option') ?? null;
        if ($options) {
            echo $options['flexible_footer_content'];
        }
    }
}

/**
 * register new image size for specific content
 */

add_action('after_setup_theme', function () {
    add_theme_support('post-thumbnails');
    add_image_size('_2x-nav-featured-image', 260, 260, true);
});

/**
 * acf options page
 */

if (function_exists('acf_add_options_page')) {


    acf_add_options_page(
        array(
            'page_title' => 'Theme Fields',
            'menu_title' => 'Theme Fields',
            'menu_slug' => 'theme-general-fields',
            'capability' => 'edit_posts',
            'redirect' => false
        )
    );

    acf_add_options_sub_page(
        array(
            'page_title' => 'Theme Header Fields',
            'menu_title' => 'Header Fields',
            'parent_slug' => 'theme-general-fields',
        )
    );

    acf_add_options_sub_page(
        array(
            'page_title' => 'Theme Footer Fields',
            'menu_title' => 'Footer Fields',
            'parent_slug' => 'theme-general-fields',
        )
    );
}

/**
 * shove YOAST settings panel in editor to bottom
 */

add_filter('wpseo_metabox_prio', function () {
    return 'low';
});

// /**
//  * Activate WordPress Maintenance Mode
//  */

// add_action('get_header', function () {
//     if (!current_user_can('edit_themes') || !is_user_logged_in()) {
//         wp_die('<h1>Under Maintenance</h1><br>Website under planned maintenance. Please check back later.');
//     }
// });