<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _smfr
 */

?>

<footer id="colophon" class="mt-20 border-t border-border bg-surface/40">

	<div class="mx-auto max-w-wide px-4 py-12 sm:px-6">

		<div class="flex flex-col gap-8 lg:flex-row lg:items-start lg:justify-between">

			<div class="max-w-sm">
				<a
					href="<?php echo esc_url( home_url( '/' ) ); ?>"
					rel="home"
					class="font-display text-lg font-bold tracking-widest text-foreground uppercase hover:text-gold"
				>
					<?php bloginfo( 'name' ); ?>
				</a>
				<p class="mt-3 text-sm text-muted">
					<?php esc_html_e( 'La première communauté francophone sur SMITE & SMITE 2 : news, notes de patch, encyclopédie et tournois.', '_smfr' ); ?>
				</p>
			</div>

			<?php if ( has_nav_menu( 'menu-2' ) ) : ?>
				<nav aria-label="<?php esc_attr_e( 'Menu de pied de page', '_smfr' ); ?>">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'menu-2',
							'menu_class'     => 'footer-menu',
							'container'      => false,
							'depth'          => 1,
						)
					);
					?>
				</nav>
			<?php endif; ?>

			<?php
			$_smfr_discord = _smfr_social_url( 'discord' );
			$_smfr_x       = _smfr_social_url( 'x' );
			$_smfr_youtube = _smfr_social_url( 'youtube' );
			?>
			<?php if ( $_smfr_discord || $_smfr_x || $_smfr_youtube ) : ?>
				<div class="flex flex-wrap gap-3">
					<?php if ( $_smfr_discord ) : ?>
						<a href="<?php echo esc_url( $_smfr_discord ); ?>" target="_blank" rel="noopener" class="btn-ghost h-11 w-11 p-0 hover:!border-[#5865f2] hover:!text-[#5865f2]" aria-label="Discord">
							<svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M20.3 4.9A19.8 19.8 0 0 0 15.4 3l-.2.5c1.7.4 2.6 1 3.5 1.6a13.3 13.3 0 0 0-11.4 0c1-.6 2-1.2 3.5-1.6L10.6 3a19.8 19.8 0 0 0-4.9 1.9C2.6 9.6 1.8 14.1 2.2 18.6a19.9 19.9 0 0 0 6 3l.4-.6c-1-.3-1.8-.7-2.6-1.2l.5-.4a14.2 14.2 0 0 0 12.1 0l.5.4c-.8.5-1.7.9-2.6 1.2l.4.6a19.9 19.9 0 0 0 6-3c.5-5.2-.8-9.7-2.1-13.7ZM9 15.5c-1 0-1.7-.9-1.7-2s.8-2 1.7-2 1.7.9 1.7 2-.8 2-1.7 2Zm6 0c-1 0-1.7-.9-1.7-2s.8-2 1.7-2 1.7.9 1.7 2-.8 2-1.7 2Z" /></svg>
						</a>
					<?php endif; ?>
					<?php if ( $_smfr_x ) : ?>
						<a href="<?php echo esc_url( $_smfr_x ); ?>" target="_blank" rel="noopener" class="btn-ghost h-11 w-11 p-0" aria-label="X (Twitter)">
							<svg class="h-4 w-4" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24h-6.66l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231 5.45-6.231Zm-1.161 17.52h1.833L7.084 4.126H5.117L17.083 19.77Z" /></svg>
						</a>
					<?php endif; ?>
					<?php if ( $_smfr_youtube ) : ?>
						<a href="<?php echo esc_url( $_smfr_youtube ); ?>" target="_blank" rel="noopener" class="btn-ghost h-11 w-11 p-0 hover:!border-red-500 hover:!text-red-500" aria-label="YouTube">
							<svg class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"><path d="M23.5 6.2a3 3 0 0 0-2.1-2.1C19.5 3.6 12 3.6 12 3.6s-7.5 0-9.4.5A3 3 0 0 0 .5 6.2 31.3 31.3 0 0 0 0 12a31.3 31.3 0 0 0 .5 5.8 3 3 0 0 0 2.1 2.1c1.9.5 9.4.5 9.4.5s7.5 0 9.4-.5a3 3 0 0 0 2.1-2.1A31.3 31.3 0 0 0 24 12a31.3 31.3 0 0 0-.5-5.8ZM9.6 15.6V8.4l6.2 3.6-6.2 3.6Z" /></svg>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>

		</div>

		<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
			<aside role="complementary" class="mt-10 border-t border-border pt-8" aria-label="<?php esc_attr_e( 'Pied de page', '_smfr' ); ?>">
				<?php dynamic_sidebar( 'sidebar-1' ); ?>
			</aside>
		<?php endif; ?>

		<div class="mt-10 flex flex-col gap-2 border-t border-border pt-6 text-sm text-muted sm:flex-row sm:items-center sm:justify-between">
			<p class="m-0">
				&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>.
				<?php esc_html_e( 'Site communautaire non officiel — SMITE est une marque de Hi-Rez Studios.', '_smfr' ); ?>
			</p>
		</div>

	</div>

</footer><!-- #colophon -->
