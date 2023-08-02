<?php

/**
 * The template for displaying header.
 *
 * @package HelloElementor
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}
$site_name = get_bloginfo('name');
$tagline   = get_bloginfo('description', 'display');


$theme_location = 'menu-1';
$locations = get_nav_menu_locations();
$menu_id   = $locations[$theme_location];
$menu_object  = wp_get_nav_menu_object($menu_id);
$menu_items = wp_get_nav_menu_items($menu_object->term_id, ['update_post_term_cache' => false]);

?>

<header id="site-header" class="site-header" role="banner" child>

	<div class="site-branding">
		<?php
		if (has_custom_logo()) {
			the_custom_logo();
		} elseif ($site_name) {
		?>
			<h1 class="site-title">
				<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr__('Home', 'hello-elementor'); ?>" rel="home">
					<?php echo esc_html($site_name); ?>
				</a>
			</h1>
			<p class="site-description">
				<?php
				if ($tagline) {
					echo esc_html($tagline);
				}
				?>
			</p>
		<?php } ?>
	</div>

	<?php if ($header_nav_menu) : ?>
		<nav class="site-navigation">
			<?php
			// PHPCS - escaped by WordPress with "wp_nav_menu"
			echo $header_nav_menu; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			?>
		</nav>
	<?php endif; ?>
</header>