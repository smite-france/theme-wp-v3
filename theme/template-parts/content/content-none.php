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
				<?php esc_html_e( 'Your site is set to show the most recent posts on your homepage, but you haven&rsquo;t published any posts.', '_smfr' ); ?>
			</p>

			<p>
				<a href="<?php echo esc_url( admin_url( 'edit.php' ) ); ?>">
					<?php
					/* translators: 1: link to WP admin new post page. */
					esc_html_e( 'Add or publish posts', '_smfr' );
					?>
				</a>
			</p>

			<?php
		elseif ( is_search() ) :
			?>

			<p>
				<?php esc_html_e( 'Your search generated no results. Please try a different search.', '_smfr' ); ?>
			</p>

			<?php
			get_search_form();
		else :
			?>

			<p>
				<?php esc_html_e( 'No content matched your request.', '_smfr' ); ?>
			</p>

			<?php
			get_search_form();
		endif;
		?>
	</div><!-- .page-content -->

</section>
