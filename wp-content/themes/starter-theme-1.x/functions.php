<?php

/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */

// Gravity Forms
add_filter('gform_confirmation_anchor', '__return_true');

$composer_autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($composer_autoload)) {
	require_once $composer_autoload;
	$timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if (!class_exists('Timber')) {

	add_action(
		'admin_notices',
		function () {
			echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
		}
	);

	add_filter(
		'template_include',
		function ($template) {
			return get_stylesheet_directory() . '/static/no-timber.html';
		}
	);
	return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array('templates', 'views');

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;


/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site
{
	/** Add timber support. */
	public function __construct()
	{
		add_action('after_setup_theme', array($this, 'theme_supports'));
		add_filter('timber/context', array($this, 'add_to_context'));
		add_filter('timber/twig', array($this, 'add_to_twig'));
		add_action('init', array($this, 'register_taxonomies'));
		// CUSTOM POST TYPES
		// add_action( 'init', array( $this, 'register_event_post_type' ) );
		// add_action( 'init', array( $this, 'register_webinar_post_type' ) );
		add_action('init', array($this, 'register_brands_post_type'));
		parent::__construct();
	}
	/** This is where you can register custom post types. */
	/* The next register_post_types() function will register the custom post type
	In the __construct function above, uncomment the referenced add_action 
	Also uncomment the code inside the register_post_types() function */
	public function register_event_post_type()
	{
		$labels = array(
			'name'                  => _x('Events', 'Post Type General Name', 'events'),
			'singular_name'         => _x('Event', 'Post Type Singular Name', 'event'),
			'menu_name'             => __('Events', 'events'),
			'name_admin_bar'        => __('Events', 'events'),
			'archives'              => __('Event Archives', 'events'),
			'attributes'            => __('Event Attributes', 'events'),
			'parent_item_colon'     => __('Parent Event:', 'events'),
			'all_items'             => __('All Events', 'events'),
			'add_new_item'          => __('Add New Event', 'events'),
			'add_new'               => __('Add New Event', 'events'),
			'new_item'              => __('New Event', 'events'),
			'edit_item'             => __('Edit Event', 'events'),
			'update_item'           => __('Update Event', 'events'),
			'view_item'             => __('View Event', 'events'),
			'view_items'            => __('View Events', 'events'),
			'search_items'          => __('Search Events', 'events'),
			'not_found'             => __('Not found', 'events'),
			'not_found_in_trash'    => __('Not found in Trash', 'events'),
			'featured_image'        => __('Featured Image', 'events'),
			'set_featured_image'    => __('Set featured image', 'events'),
			'remove_featured_image' => __('Remove featured image', 'events'),
			'use_featured_image'    => __('Use as featured image', 'events'),
			'insert_into_item'      => __('Insert into event', 'events'),
			'uploaded_to_this_item' => __('Uploaded to this event', 'events'),
			'items_list'            => __('Events list', 'events'),
			'items_list_navigation' => __('Events list navigation', 'events'),
			'filter_items_list'     => __('Filter events list', 'events'),
		);
		$args = array(
			'label'                 => __('Event', 'events'),
			'description'           => __('Event', 'events'),
			'labels'                => $labels,
			'show_in_rest' => true,
			'supports'              => array('title', 'editor', 'thumbnail', 'revisions',),
			'taxonomies'            => array('event_type', 'post_tag'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 7,
			'menu_icon'             => 'dashicons-admin-site-alt',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'rewrite'             => true
		);
		register_post_type('event', $args);
	}

	public function register_webinar_post_type()
	{
		$labels = array(
			'name'                  => _x('Webinars', 'Post Type General Name', 'webinars'),
			'singular_name'         => _x('Webinar', 'Post Type Singular Name', 'webinar'),
			'menu_name'             => __('Webinars', 'webinars'),
			'name_admin_bar'        => __('Webinars', 'webinars'),
			'archives'              => __('Webinar Archives', 'webinars'),
			'attributes'            => __('Webinar Attributes', 'webinars'),
			'parent_item_colon'     => __('Parent Webinar:', 'webinars'),
			'all_items'             => __('All Webinars', 'webinars'),
			'add_new_item'          => __('Add New Webinar', 'webinars'),
			'add_new'               => __('Add New Webinar', 'webinars'),
			'new_item'              => __('New Webinar', 'webinars'),
			'edit_item'             => __('Edit Webinar', 'webinars'),
			'update_item'           => __('Update Webinar', 'webinars'),
			'view_item'             => __('View Webinar', 'webinars'),
			'view_items'            => __('View Webinars', 'webinars'),
			'search_items'          => __('Search Webinars', 'webinars'),
			'not_found'             => __('Not found', 'webinars'),
			'not_found_in_trash'    => __('Not found in Trash', 'webinars'),
			'featured_image'        => __('Featured Image', 'webinars'),
			'set_featured_image'    => __('Set featured image', 'webinars'),
			'remove_featured_image' => __('Remove featured image', 'webinars'),
			'use_featured_image'    => __('Use as featured image', 'webinars'),
			'insert_into_item'      => __('Insert into webinar', 'webinars'),
			'uploaded_to_this_item' => __('Uploaded to this webinar', 'webinars'),
			'items_list'            => __('Webinars list', 'webinars'),
			'items_list_navigation' => __('Webinars list navigation', 'webinars'),
			'filter_items_list'     => __('Filter webinars list', 'webinars'),
		);
		$args = array(
			'label'                 => __('Webinar', 'webinars'),
			'description'           => __('Webinar', 'webinars'),
			'labels'                => $labels,
			'show_in_rest' => true,
			'supports'              => array('title', 'editor', 'thumbnail', 'revisions',),
			'taxonomies'            => array('webinar_type', 'post_tag'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 7,
			'menu_icon'             => 'dashicons-admin-site-alt',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'rewrite'             => true
		);
		register_post_type('webinar', $args);
	}

	public function register_brands_post_type()
	{
		$labels = array(
			'name'                  => _x('Brands', 'Post Type General Name', 'brands'),
			'singular_name'         => _x('Brand', 'Post Type Singular Name', 'brand'),
			'menu_name'             => __('Brands', 'brands'),
			'name_admin_bar'        => __('Brands', 'brands'),
			'archives'              => __('Brand Archives', 'brands'),
			'attributes'            => __('Brand Attributes', 'brands'),
			'parent_item_colon'     => __('Parent Brand:', 'brands'),
			'all_items'             => __('All Brands', 'brands'),
			'add_new_item'          => __('Add New Brand', 'brands'),
			'add_new'               => __('Add New Brand', 'brands'),
			'new_item'              => __('New Brand', 'brands'),
			'edit_item'             => __('Edit Brand', 'brands'),
			'update_item'           => __('Update Brand', 'brands'),
			'view_item'             => __('View Brand', 'brands'),
			'view_items'            => __('View Brands', 'brands'),
			'search_items'          => __('Search Brands', 'brands'),
			'not_found'             => __('Not found', 'brands'),
			'not_found_in_trash'    => __('Not found in Trash', 'brands'),
			'featured_image'        => __('Featured Image', 'brands'),
			'set_featured_image'    => __('Set featured image', 'brands'),
			'remove_featured_image' => __('Remove featured image', 'brands'),
			'use_featured_image'    => __('Use as featured image', 'brands'),
			'insert_into_item'      => __('Insert into brand', 'brands'),
			'uploaded_to_this_item' => __('Uploaded to this brand', 'brands'),
			'items_list'            => __('Brands list', 'brands'),
			'items_list_navigation' => __('Brands list navigation', 'brands'),
			'filter_items_list'     => __('Filter brands list', 'brands'),
		);
		$args = array(
			'label'                 => __('Brand', 'brands'),
			'description'           => __('Brand', 'brands'),
			'labels'                => $labels,
			'show_in_rest' => true,
			'supports'              => array('title', 'editor', 'thumbnail', 'revisions',),
			'taxonomies'            => array('event_type', 'post_tag'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 7,
			'menu_icon'             => 'dashicons-admin-site-alt',
			'show_in_admin_bar'     => true,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'post',
			'rewrite'             => true
		);
		register_post_type('brand', $args);
	}
	/** This is where you can register custom taxonomies. */
	public function register_taxonomies()
	{
	}

	/** This is where you add some context
	 *
	 * @param string $context context['this'] Being the Twig's {{ this }}.
	 */
	public function add_to_context($context)
	{
		$context['foo']   = 'bar';
		$context['stuff'] = 'I am a value set in your functions.php file';
		$context['notes'] = 'These values are available everytime you call Timber::context();';
		$context['menu']  = new Timber\Menu();
		$context['site']  = $this;
		// VC ADDED CONTEXT
		$context['options'] = get_fields('option');
		return $context;
	}

	public function theme_supports()
	{
		// Add default posts and comments RSS feed links to head.
		add_theme_support('automatic-feed-links');

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support('title-tag');

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support('post-thumbnails');

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 *
		 * See: https://codex.wordpress.org/Post_Formats
		 */
		add_theme_support(
			'post-formats',
			array(
				'aside',
				'image',
				'video',
				'quote',
				'link',
				'gallery',
				'audio',
			)
		);

		add_theme_support('menus');
	}

	/** This Would return 'foo bar!'.
	 *
	 * @param string $text being 'foo', then returned 'foo bar!'.
	 */
	public function myfoo($text)
	{
		$text .= ' bar!';
		return $text;
	}

	/** This is where you can add your own functions to twig.
	 *
	 * @param string $twig get extension.
	 */
	public function add_to_twig($twig)
	{
		$twig->addExtension(new Twig\Extension\StringLoaderExtension());
		$twig->addFilter(new Twig\TwigFilter('myfoo', array($this, 'myfoo')));
		return $twig;
	}
}

new StarterSite();

// END OF STARTER TIMBER TEMPLATE //

function add_theme_scripts()
{
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_style('animate', get_template_directory_uri() . '/assets/css/animate.min.css', [], false, 'screen');
	wp_enqueue_style('site', get_template_directory_uri() . '/assets/css/site.css', [], false, 'screen');
	wp_enqueue_script('script', get_template_directory_uri() . '/assets/js/site.js', ['jquery'], false, true);
	wp_enqueue_script('utm-helper', get_template_directory_uri() . '/assets/js/utm-helper.js', [], false, true);
}

add_action('wp_enqueue_scripts', 'add_theme_scripts');

// TTC - Disable Gutenberg
// add_filter('use_block_editor_for_post', '__return_false', 10);
// END

// TTC - Adds theme settings to wp-admin backend
if (function_exists('acf_add_options_page')) {


	acf_add_options_page(array(
		'page_title'         => 'Theme Fields',
		'menu_title'        => 'Theme Fields',
		'menu_slug'         => 'theme-general-fields',
		'capability'        => 'edit_posts',
		'redirect'                => false
	));

	acf_add_options_sub_page(array(
		'page_title'         => 'Theme Header Fields',
		'menu_title'        => 'Header Fields',
		'parent_slug'        => 'theme-general-fields',
	));

	acf_add_options_sub_page(array(
		'page_title'         => 'Theme Footer Fields',
		'menu_title'        => 'Footer Fields',
		'parent_slug'        => 'theme-general-fields',
	));
}

/* HIDE BLOCK EDITOR */
function remove_editor()
{
	remove_post_type_support('page', 'editor');
	remove_post_type_support('brand', 'editor');
}
add_action('admin_init', 'remove_editor');

// shove YOAST settings panel in editor to bottom 
add_filter('wpseo_metabox_prio', function () {
	return 'low';
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
		</style>

<?php
	});
}
