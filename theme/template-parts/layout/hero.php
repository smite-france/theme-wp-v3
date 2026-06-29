<?php
/**
 * Template part for displaying the front-page hero
 *
 * @package _smfr
 */

$_smfr_hero_image = get_theme_mod( 'smfr_hero_image', '' );
?>

<section class="relative overflow-hidden border-b border-border">

	<?php if ( $_smfr_hero_image ) : ?>
		<!-- Custom background image (blurred + dark overlay) -->
		<div class="pointer-events-none absolute inset-0 -z-10">
			<img
				src="<?php echo esc_url( $_smfr_hero_image ); ?>"
				alt=""
				aria-hidden="true"
				class="h-full w-full scale-105 object-cover blur-md"
			/>
			<div class="absolute inset-0 bg-background/70"></div>
		</div>
	<?php else : ?>
		<!-- Decorative glows (default) -->
		<div class="pointer-events-none absolute inset-0 -z-10">
			<div class="absolute -top-32 right-0 h-96 w-96 rounded-full bg-cyan/20 blur-3xl"></div>
			<div class="absolute -bottom-32 left-0 h-96 w-96 rounded-full bg-gold/10 blur-3xl"></div>
		</div>
	<?php endif; ?>

	<div class="mx-auto max-w-wide px-4 py-20 text-center sm:px-6 lg:py-28">

		<p class="eyebrow justify-center">
			<span class="h-px w-8 bg-cyan"></span>
			<?php esc_html_e( 'Communauté francophone SMITE & SMITE 2', '_smfr' ); ?>
			<span class="h-px w-8 bg-cyan"></span>
		</p>

		<h1 class="mx-auto mt-6 max-w-3xl font-display text-5xl font-bold uppercase leading-[0.95] tracking-tight sm:text-6xl lg:text-7xl">
			<?php esc_html_e( 'Deviens un dieu,', '_smfr' ); ?>
			<span class="block bg-gradient-to-r from-gold via-amber-200 to-gold bg-clip-text text-transparent">
				<?php esc_html_e( 'rejoins la bataille', '_smfr' ); ?>
			</span>
		</h1>

		<p class="mx-auto mt-6 max-w-xl text-lg text-muted">
			<?php esc_html_e( 'Toute l’actualité, les notes de patch, l’encyclopédie des dieux et les tournois de SMITE 2, par la communauté française.', '_smfr' ); ?>
		</p>

		<div class="mt-10 flex flex-wrap items-center justify-center gap-4">
			<a href="https://discord.gg/smitefrance" target="_blank" rel="noopener" class="btn-primary">
				<?php esc_html_e( 'Rejoindre le Discord', '_smfr' ); ?>
			</a>
			<a href="#main" class="btn-ghost">
				<?php esc_html_e( 'Voir les actualités', '_smfr' ); ?>
			</a>
		</div>

	</div>

</section>
