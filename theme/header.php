<?php
/**
 * The header for our theme
 *
 * This is the template that displays the `head` element and everything up
 * until the `#content` element.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _smfr
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<div id="page">
	<a href="#content" class="sr-only focus:not-sr-only focus:absolute focus:top-2 focus:left-2 focus:z-[100] focus:rounded-md focus:bg-gold focus:px-4 focus:py-2 focus:font-display focus:font-semibold focus:text-background"><?php esc_html_e( 'Aller au contenu', '_smfr' ); ?></a>

	<?php get_template_part( 'template-parts/layout/header', 'content' ); ?>

	<?php if ( get_theme_mod( 'smfr_adsense_slot_header', '1203329357' ) ) : ?>
		<div class="mx-auto max-w-wide px-4 pt-6 sm:px-6">
			<?php _smfr_adsense_unit( get_theme_mod( 'smfr_adsense_slot_header', '1203329357' ) ); ?>
		</div>
	<?php endif; ?>

	<div id="content">
