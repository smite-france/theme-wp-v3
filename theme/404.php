<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package _smfr
 */

get_header();
?>

	<section id="primary">
		<main id="main">

			<div class="mx-auto max-w-content py-12 text-center">
				<p class="font-display text-7xl font-bold tracking-widest text-gold sm:text-9xl">404</p>
				<header class="page-header">
					<h1 class="page-title !mx-auto mt-2"><?php esc_html_e( 'Page introuvable', '_smfr' ); ?></h1>
				</header><!-- .page-header -->

				<div <?php _smfr_content_class( 'page-content' ); ?>>
					<p><?php esc_html_e( 'Cette page n’existe pas ou a été déplacée. Tentez une recherche ou revenez à l’accueil.', '_smfr' ); ?></p>
					<?php get_search_form(); ?>
					<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn-primary mt-4"><?php esc_html_e( 'Retour à l’accueil', '_smfr' ); ?></a></p>
				</div><!-- .page-content -->
			</div>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_footer();
