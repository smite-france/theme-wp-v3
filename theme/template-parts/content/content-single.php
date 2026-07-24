<?php
/**
 * Template part for displaying single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _smfr
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php if ( has_post_thumbnail() ) : ?>
		<figure class="mx-auto mb-12 w-fit">
			<?php
			the_post_thumbnail(
				'full',
				array(
					'class'   => 'mx-auto h-[360px] w-auto max-w-full rounded-2xl object-contain',
					'loading' => 'eager',
				)
			);
			?>
		</figure>
	<?php endif; ?>

	<header class="entry-header mx-auto mb-8 max-w-content text-center">

		<?php the_title( '<h1 class="entry-title !mx-auto !max-w-none !mb-0 text-4xl sm:text-5xl">', '</h1>' ); ?>

		<?php if ( ! is_page() ) : ?>
			<p class="mt-4 font-display text-sm tracking-wide text-muted">
				<?php
				printf(
					/* translators: 1: author, 2: category list, 3: date. */
					esc_html__( 'par %1$s dans %2$s - %3$s', '_smfr' ),
					sprintf(
						'<a class="text-gold hover:text-amber-200" href="%s">%s</a>',
						esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
						esc_html( get_the_author() )
					),
					get_the_category_list( ', ' ), // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- core-escaped links.
					'<time datetime="' . esc_attr( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time>'
				);
				?>
			</p>
		<?php endif; ?>

	</header><!-- .entry-header -->

	<div <?php _smfr_content_class( 'entry-content' ); ?>>
		<?php
		the_content(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers. */
					__( 'Lire la suite<span class="sr-only"> "%s"</span>', '_smfr' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);

		wp_link_pages(
			array(
				'before' => '<div>' . __( 'Pages :', '_smfr' ),
				'after'  => '</div>',
			)
		);
		?>
	</div><!-- .entry-content -->

	<?php
	$_smfr_tags = get_the_tags();
	if ( $_smfr_tags ) :
		?>
		<footer class="entry-footer mx-auto mt-10 flex max-w-content flex-wrap items-center gap-2 border-t border-border pt-6">
			<span class="font-display text-xs tracking-widest text-muted uppercase"><?php esc_html_e( 'Tags', '_smfr' ); ?></span>
			<?php
			foreach ( $_smfr_tags as $_smfr_tag ) {
				printf(
					'<a href="%s" class="badge border-gold/40 text-gold hover:border-gold hover:text-amber-200">%s</a>',
					esc_url( get_tag_link( $_smfr_tag->term_id ) ),
					esc_html( $_smfr_tag->name )
				);
			}
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>

</article><!-- #post-${ID} -->
