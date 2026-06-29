<?php
/**
 * Template part for displaying the configurable information banner
 *
 * @package _smfr
 */

// Only display the banner on the homepage.
if ( ! is_front_page() ) {
	return;
}

if ( ! get_theme_mod( 'smfr_notice_enable', false ) ) {
	return;
}

$_smfr_notice_title = get_theme_mod( 'smfr_notice_title', __( 'INFORMATION IMPORTANTE', '_smfr' ) );
$_smfr_notice_text  = get_theme_mod( 'smfr_notice_text', _smfr_notice_default_text() );

if ( '' === trim( (string) $_smfr_notice_title ) && '' === trim( (string) $_smfr_notice_text ) ) {
	return;
}
?>

<aside class="border-b border-gold/30 bg-gold/10" role="note">
	<div class="mx-auto max-w-wide px-4 py-5 text-center sm:px-6">
		<?php if ( $_smfr_notice_title ) : ?>
			<p class="m-0 font-display text-sm font-bold uppercase tracking-widest text-gold">
				<?php echo esc_html( $_smfr_notice_title ); ?>
			</p>
		<?php endif; ?>

		<?php if ( $_smfr_notice_text ) : ?>
			<div class="mx-auto mt-3 max-w-content text-sm leading-relaxed text-foreground">
				<?php echo wp_kses_post( wpautop( $_smfr_notice_text ) ); ?>
			</div>
		<?php endif; ?>
	</div>
</aside>
