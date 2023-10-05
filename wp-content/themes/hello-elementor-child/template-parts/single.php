<?php
/**
 * The template for displaying singular post-types: posts, pages and user-defined custom post types.
 *
 * @package HelloElementor
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

if (!is_single()):

	while (have_posts()):
		the_post();
		?>

		<main id="content" <?php post_class('site-main'); ?>>

			<div class="page-content">
				<?php the_content(); ?>
				<div class="post-tags">
					<?php the_tags('<span class="tag-links">' . esc_html__('Tagged ', 'hello-elementor'), null, '</span>'); ?>
				</div>
				<?php wp_link_pages(); ?>
			</div>

			<?php comments_template(); ?>

		</main>

		<?php
	endwhile;

else:

	global $timber;
	$context = $timber::context();
	$post = new Timber\Post();

	?>

	<main id="content" <?php post_class('site-main'); ?>>

		<div class="bootstrap-container">
			<div class="timber-oldfc">
				<div class="container-1140">
					<div class="container">

						<div class="py-3"></div>

						<article class="post-type-<?= $post->post_type ?>" id="post-<?= $post->ID ?>">

							<?php if ($post->categories): ?>
								<span class="blog-tag">
									<?php foreach ($post->categories as $category): ?>
										<?= $category->name ?>
									<?php endforeach ?>
								</span>
							<?php endif ?>

							<?php if ($post->title): ?>
								<h1 class="article-h1">
									<?= $post->title ?>
								</h1>
							<?php endif ?>

							<?php if ($post->thumbnail): ?>
								<div class="my-3 py-1"></div>
								<img src="<?= $post->thumbnail->src ?>" alt="" class="img-fluid post-featured-img">
								<div class="my-3 py-1"></div>
							<?php endif ?>

							<?php if ($post->content): ?>
								<section class="article-content">
									<div class="article-body">
										<?= $post->content ?>
									</div>
								</section>
							<?php endif ?>

						</article>

					</div>
				</div>
			</div>
		</div>

	</main>

<?php endif ?>