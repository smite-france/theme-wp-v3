<?php
/**
 * Template part for displaying a message when posts are not found
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _smfr
 */

?>

<section class="mx-auto max-w-content rounded-xl border border-border bg-surface/40 p-8 text-center sm:p-12">

	<header class="page-header">
		<?php if ( is_search() ) : ?>

			<h1 class="page-title !mx-auto">
				<?php
				printf(
					/* translators: 1: search result label. 2: search term. */
					'%1$s <span class="text-gold">%2$s</span>',
					esc_html__( 'Résultats pour :', '_smfr' ),
					esc_html( get_search_query() )
				);
				?>
			</h1>

		<?php else : ?>

			<h1 class="page-title !mx-auto"><?php esc_html_e( 'Aucun résultat', '_smfr' ); ?></h1>

		<?php endif; ?>
	</header><!-- .page-header -->

	<div <?php _smfr_content_class( 'page-content' ); ?>>
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
			?>

			<p>
				<?php esc_html_e( 'Votre site est configuré pour afficher les articles les plus récents sur votre page d’accueil, mais vous n’avez encore publié aucun article.', '_smfr' ); ?>
			</p>

			<p>
				<a href="<?php echo esc_url( admin_url( 'edit.php' ) ); ?>">
					<?php
					/* translators: 1: link to WP admin new post page. */
					esc_html_e( 'Ajouter ou publier des articles', '_smfr' );
					?>
				</a>
			</p>

			<?php
		elseif ( is_search() ) :
			?>

			<p>
				<?php esc_html_e( 'Votre recherche n’a donné aucun résultat. Essayez avec d’autres termes.', '_smfr' ); ?>
			</p>

			<?php
			get_search_form();
		else :
			?>

			<p>
				<?php esc_html_e( 'Aucun contenu ne correspond à votre demande.', '_smfr' ); ?>
			</p>

			<?php
			get_search_form();
		endif;
		?>
	</div><!-- .page-content -->

</section>
