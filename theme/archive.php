<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _smfr
 */

get_header();
?>

	<section id="primary">
		<main id="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header mb-8">
				<?php the_archive_title( '<h1 class="section-title">', '</h1>' ); ?>
				<?php the_archive_description( '<div class="mt-3 max-w-content text-muted">', '</div>' ); ?>
			</header><!-- .page-header -->

			<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
				<?php
				// Start the Loop.
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/content', 'excerpt' );

					// End the loop.
				endwhile;
				?>
			</div>

			<?php
			// Previous/next page navigation.
			_smfr_the_posts_navigation();

		else :

			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content/content', 'none' );

		endif;
		?>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
