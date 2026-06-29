<?php
/**
 * Template part for displaying pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _smfr
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header mx-auto mb-8 max-w-content text-center">
		<?php
		if ( ! is_front_page() ) {
			the_title( '<h1 class="entry-title !mx-auto !max-w-none !mb-0 text-4xl sm:text-5xl">', '</h1>' );
		} else {
			the_title( '<h2 class="entry-title !mx-auto !max-w-none !mb-0 text-4xl sm:text-5xl">', '</h2>' );
		}
		?>
	</header><!-- .entry-header -->

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="mx-auto mb-12 max-w-wide">
			<?php
			the_post_thumbnail(
				'full',
				array(
					'class' => 'mx-auto h-auto w-full rounded-2xl border border-border object-contain',
				)
			);
			?>
		</figure>
	<?php endif; ?>

	<div <?php _smfr_content_class( 'entry-content' ); ?>>
		<?php
		the_content();

		wp_link_pages(
			array(
				'before' => '<div>' . __( 'Pages :', '_smfr' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers. */
						__( 'Modifier <span class="sr-only">%s</span>', '_smfr' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

</article><!-- #post-<?php the_ID(); ?> -->
