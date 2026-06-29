<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _smfr
 */

?>

<header id="masthead">

	<div class="mx-auto flex max-w-wide items-center justify-between gap-4 px-4 py-4 sm:px-6">

		<div class="flex items-center gap-3">
			<?php if ( has_custom_logo() ) : ?>
				<?php the_custom_logo(); ?>
			<?php endif; ?>

			<?php
			$_smfr_name_tag = is_front_page() ? 'h1' : 'p';
			?>
			<<?php echo esc_attr( $_smfr_name_tag ); ?> class="m-0 leading-none">
				<a
					href="<?php echo esc_url( home_url( '/' ) ); ?>"
					rel="home"
					class="font-display text-xl font-bold tracking-widest uppercase text-foreground hover:text-gold"
				>
					<?php
					$_smfr_blogname = get_bloginfo( 'name' );
					$_smfr_words    = explode( ' ', $_smfr_blogname, 2 );
					if ( count( $_smfr_words ) > 1 ) {
						printf(
							'%s <span class="text-gold">%s</span>',
							esc_html( $_smfr_words[0] ),
							esc_html( $_smfr_words[1] )
						);
					} else {
						echo esc_html( $_smfr_blogname );
					}
					?>
				</a>
			</<?php echo esc_attr( $_smfr_name_tag ); ?>>
		</div>

		<nav
			id="site-navigation"
			class="flex items-center gap-3"
			aria-label="<?php esc_attr_e( 'Main Navigation', '_smfr' ); ?>"
		>
			<button
				class="btn-ghost px-3 py-2 lg:hidden"
				data-menu-toggle
				aria-controls="primary-menu"
				aria-expanded="false"
			>
				<span class="sr-only"><?php esc_html_e( 'Ouvrir le menu', '_smfr' ); ?></span>
				<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
					<path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
				</svg>
			</button>

			<!-- Backdrop (mobile sheet) -->
			<div class="menu-backdrop" data-menu-close></div>

			<!-- Close button (mobile sheet) -->
			<button class="menu-close" data-menu-close>
				<span class="sr-only"><?php esc_html_e( 'Fermer le menu', '_smfr' ); ?></span>
				<svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
					<path stroke-linecap="round" d="M6 6l12 12M18 6L6 18" />
				</svg>
			</button>

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'container'      => false,
					'fallback_cb'    => '_smfr_primary_menu_fallback',
					'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
				)
			);
			?>

		</nav>

	</div>

</header><!-- #masthead -->
