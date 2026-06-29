<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package _smfr
 */

get_header();
?>

	<section id="primary">
		<main id="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header mb-8">
				<?php
				printf(
					/* translators: 1: search result label. 2: search term. */
					'<h1 class="section-title">%1$s <span class="text-gold">%2$s</span></h1>',
					esc_html__( 'Résultats pour :', '_smfr' ),
					esc_html( get_search_query() )
				);
				?>
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

			// If no content is found, get the `content-none` template part.
			get_template_part( 'template-parts/content/content', 'none' );

		endif;
		?>
		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
