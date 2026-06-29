<?php
/**
 * Template part for displaying post archives and search results
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _smfr
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'card flex flex-col' ); ?>>

	<a href="<?php the_permalink(); ?>" class="block aspect-[16/9] overflow-hidden bg-surface-2">
		<?php if ( has_post_thumbnail() ) : ?>
			<?php
			the_post_thumbnail(
				'large',
				array(
					'class'   => 'h-full w-full object-cover transition-transform duration-300 hover:scale-105',
					'loading' => 'lazy',
				)
			);
			?>
		<?php else : ?>
			<?php $_smfr_default_thumb = get_theme_mod( 'smfr_default_thumbnail', '' ); ?>
			<?php if ( $_smfr_default_thumb ) : ?>
				<img
					src="<?php echo esc_url( $_smfr_default_thumb ); ?>"
					alt=""
					aria-hidden="true"
					loading="lazy"
					class="h-full w-full object-cover transition-transform duration-300 hover:scale-105"
				/>
			<?php else : ?>
				<span class="flex h-full w-full items-center justify-center font-display text-2xl font-bold uppercase tracking-widest text-border">
					SMITE FRANCE
				</span>
			<?php endif; ?>
		<?php endif; ?>
	</a>

	<div class="flex flex-1 flex-col p-5">

		<?php
		$_smfr_cats = get_the_category();
		if ( ! empty( $_smfr_cats ) ) :
			?>
			<div class="mb-3 flex flex-wrap gap-2">
				<?php foreach ( array_slice( $_smfr_cats, 0, 2 ) as $_smfr_cat ) : ?>
					<a href="<?php echo esc_url( get_category_link( $_smfr_cat ) ); ?>" class="badge border-cyan/40 text-cyan hover:border-cyan hover:text-cyan">
						<?php echo esc_html( $_smfr_cat->name ); ?>
					</a>
				<?php endforeach; ?>
			</div>
		<?php endif; ?>

		<h2 class="entry-title m-0 mb-2 max-w-none text-xl leading-snug">
			<a href="<?php the_permalink(); ?>" rel="bookmark" class="text-foreground hover:text-gold">
				<?php the_title(); ?>
			</a>
		</h2>

		<p class="m-0 mb-4 text-sm text-muted line-clamp-3">
			<?php echo esc_html( wp_trim_words( get_the_excerpt(), 22 ) ); ?>
		</p>

		<div class="mt-auto flex items-center gap-2 border-t border-border pt-3 font-display text-xs uppercase tracking-wide text-muted">
			<time datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>"><?php echo esc_html( get_the_date() ); ?></time>
			<span aria-hidden="true">•</span>
			<span class="text-gold"><?php the_author(); ?></span>
		</div>

	</div>

</article><!-- #post-${ID} -->
