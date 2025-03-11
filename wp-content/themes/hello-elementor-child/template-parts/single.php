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

	require_once(__DIR__ . '/vendor/autoload.php');
	$timber = new Timber\Timber();
	$timber::$dirname = ['template-parts/twigs'];
	$timber::$autoescape = false;

	$context = $timber::context();
	$post = new Timber\Post();
	$ttcposts = new Timber\PostQuery(['search_filter_id' => 27217]);

	//
	// check if post under 'Platform Updates'
	// yes? do not display the author
	//

	$show_author = true;

	if ($post->categories) {
		foreach ($post->categories as $category) {
			if ($category->slug == 'platform-updates') {
				$show_author = false;
				break;
			}
		}
	}

	/**
	 * author
	 */

	$author_id = $post->post_author;
	$author = new Timber\User($author_id);

	$profile_picture = get_field('profile_picture', 'user_' . $author_id);
	if (!empty($profile_picture)) {
		$profile_picture_url = $profile_picture['url'];
		$author->profile_picture_url = $profile_picture_url;
	} else {
		$default_avatar_url = get_avatar_url($author_id);
		$author->profile_picture_url = $default_avatar_url;
	}

	$description = get_the_author_meta('description', $author_id);
	if (!empty($description)) {
		$description_words = explode(' ', $description);
		$excerpt_words = array_splice($description_words, 0, 30);
		$excerpt = implode(' ', $excerpt_words);
		$author->description_excerpt = $excerpt . '...';
	} else {
		$author->description_excerpt = '';
	}

	$author->facebook = get_the_author_meta('facebook', $author_id);
	$author->instagram = get_the_author_meta('instagram', $author_id);
	$author->linkedin = get_the_author_meta('linkedin', $author_id);
	$author->url = get_author_posts_url($author_id);

	?>

	<main id="content" <?php post_class('site-main'); ?>>

		<div class="bootstrap-container">
			<div class="timber-oldfc">

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

					<?php if ($show_author): ?>

						<section class="py-3">
							<div class="horizontal-line"></div>
							<div class="row autho-info-box py-4">
								<div class="col-sm-12 col-lg-4">
									<div class="author-img-container mb-4">
										<img class="author-img" src="<?= $author->profile_picture_url ?>" alt="Author Image">
									</div>
								</div>
								<div class="col-sm-12 col-lg-8">

									<?php if ($author->name): ?>
										<h2 class="author-title">Author:
											<?= $author->name ?>
										</h2>
									<?php endif ?>

									<div class="author-socials py-2 mb-2">
										<?php if ($author->facebook): ?>
											<a href="<?= $author->facebook ?>">
												<i class="fa-brands fa-facebook"></i>
											</a>
										<?php endif ?>

										<?php if ($author->instagram): ?>
											<a href="<?= $author->instagram ?>">
												<i class="fa-brands fa-instagram"></i>
											</a>
										<?php endif ?>

										<?php if ($author->instagram): ?>
											<a href="<?= $author->linkedin ?>">
												<i class="fa-brands fa-linkedin"></i>
											</a>
										<?php endif ?>
									</div>

									<?php if ($author->description_excerpt): ?>
										<div class="author-desc">
											<p>
												<?= $author->description_excerpt ?>
											</p>
											<div>
												<a class="main-btn brand-btn" href="<?= $author->url ?>">
													<?= __('View Bio') ?>
												</a>
											</div>
										</div>
									<?php else: ?>
										<p>
											<?= __('No description available.') ?>
										</p>
									<?php endif ?>

								</div>
							</div>
						</section>

					<?php endif ?>

					<section>
						<div class="py-3"></div>
						<div class="horizontal-line"></div>

						<div class="single-post-pagination">
							<div class="newest mb-3 mb-sm-0">
								<?php if ($post->prev): ?>
									<div class="newest-title">
										<?= __('OLDER') ?>
									</div>
									<a href="<?= $post->prev->link ?>" class="previous-post-link">
										<?= $post->prev->title ?>
									</a>
								<?php endif ?>
							</div>
							<div class="divider-line"></div>
							<div class="older mb-3 mb-sm-0">
								<?php if ($post->next): ?>
									<div class="newest-title">
										<?= __('NEWER') ?>
									</div>
									<a href="<?= $post->next->link ?>" class="next-post-link">
										<?= $post->next->title ?>
									</a>
								<?php endif ?>
							</div>
						</div>

						<div class="py-3"></div>
						<div class="horizontal-line"></div>
					</section>

					<section>
						<div class="py-3"></div>
						<div class="recommended-posts-wrapper py-5">
							<section class="recommended-posts">

								<div class="recommended-posts-label">
									<?= $post->recommended_posts_label ?>
								</div>

								<h2 class="recommended-posts-title">
									<?= $post->recommended_posts_title ?>
								</h2>

								<div class="recommended-posts-row">
									<?php foreach ($ttcposts as $ttcpost): ?>

										<div class="single-post-wrapper">

											<div class="post-image-wrapper">
												<a href="<?= $ttcpost->link ?>">
													<img src="<?= $ttcpost->thumbnail->src ?>" alt="" class="post-image">
												</a>
											</div>

											<div class="post-text-wrapper">

												<span class="post-categories">
													<?php foreach ($ttcpost->categories as $category): ?>
														<?= $category ?>
													<?php endforeach ?>
												</span>

												<span class="single-post-title">
													<a href="<?= $ttcpost->link ?>">
														<?= count(explode(' ', $ttcpost->title)) > 9 ? implode(' ', array_slice(explode(' ', $ttcpost->title), 0, 9)) . "..." : $ttcpost->title ?>
													</a>
												</span>

												<p class="single-post-excerpt">
													<?php if ($ttcpost->post_excerpt_custom): ?>
														<?= $ttcpost->post_excerpt_custom ?>
													<?php else: ?>
														<?= implode(' ', array_slice(explode(' ', $ttcpost->preview), 0, 9)) . "..." ?>
													<?php endif ?>
													<a href="<?= $ttcpost->link ?>" class="read-more">
														<i class="fa-solid fa-arrow-right"></i>
													</a>
												</p>

											</div>

										</div>

									<?php endforeach ?>
								</div>
							</section>
						</div>
					</section>

				</div>

			</div>
		</div>

	</main>

<?php endif ?>

<?php if (isset($_GET['elementor-preview'])): ?>


	<?php

	/**
	 * fix for ajax call Elementor Preview with 'the_content' error
	 */

	while (have_posts()):
		the_post();
		the_content();
	endwhile;

	?>


<?php endif ?>