<?php
/**
 * Customizer settings and helpers for this theme
 *
 * Homepage hero image, default post thumbnail, information banner and
 * social links, all configurable via Appearance > Customize.
 *
 * @package _smfr
 */

/**
 * Social networks handled by the theme.
 *
 * @return array<string, array{label: string, default: string}>
 */
function _smfr_social_networks() {
	return array(
		'discord' => array(
			'label'   => __( 'Discord', '_smfr' ),
			'default' => 'https://discord.gg/m8VGypg',
		),
		'youtube' => array(
			'label'   => __( 'YouTube', '_smfr' ),
			'default' => 'https://www.youtube.com/@SmiteFrance',
		),
		'x'       => array(
			'label'   => __( 'X (Twitter)', '_smfr' ),
			'default' => 'https://x.com/SmiteFrance',
		),
	);
}

/**
 * Get a configured social link URL.
 *
 * @param string $network Network key (discord, youtube, x).
 * @return string
 */
function _smfr_social_url( $network ) {
	$networks = _smfr_social_networks();
	$default  = isset( $networks[ $network ] ) ? $networks[ $network ]['default'] : '';

	return get_theme_mod( 'smfr_social_' . $network, $default );
}

/**
 * Default text for the information banner.
 *
 * @return string
 */
function _smfr_notice_default_text() {
	return __(
		"Nous informons nos lecteurs que n'ayant pas assez de bénévoles, notre site n'est pas à jour sur l'arrivée de SMITE 2 !\n\nCertaines informations concernant SMITE ne sont également pas à jour.\n\nNous continuons malgré tout à vous proposer un Discord actif et la rédaction des Notes des Patchs de SMITE 2 lors de leurs sorties via l'onglet \"Notes de Patch\".\n\nVous pouvez rejoindre l'équipe de bénévoles via l'onglet \"Staff Smite France\" ou \"Contact\".\n\nMerci à vous et bonne visite !\nL'équipe SMITE FRANCE",
		'_smfr'
	);
}

/**
 * Print an image configured in the Customizer.
 *
 * Customizer image controls store a URL. When the URL points to a local
 * attachment, we render it with `wp_get_attachment_image()` so visitors get
 * `srcset`/`sizes` and core's lazy-loading; otherwise we fall back to a
 * plain `<img>` tag.
 *
 * @param string $url  Image URL from a theme mod.
 * @param array  $attr Attributes forwarded to the image tag (class, alt…).
 */
function _smfr_customizer_image( $url, $attr = array() ) {
	if ( ! $url ) {
		return;
	}

	$attachment_id = attachment_url_to_postid( $url );

	if ( $attachment_id ) {
		echo wp_get_attachment_image( $attachment_id, 'full', false, $attr ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		return;
	}

	$attr = array_merge(
		array(
			'src' => $url,
			'alt' => '',
		),
		$attr
	);

	$attributes = array();
	foreach ( $attr as $name => $value ) {
		$attributes[] = sprintf(
			'%s="%s"',
			esc_attr( $name ),
			'src' === $name ? esc_url( $value ) : esc_attr( $value )
		);
	}

	echo '<img ' . implode( ' ', $attributes ) . ' />'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Register theme options in the WordPress Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager instance.
 */
function _smfr_customize_register( $wp_customize ) {
	$wp_customize->add_section(
		'_smfr_homepage',
		array(
			'title'    => __( 'Page d’accueil', '_smfr' ),
			'priority' => 30,
		)
	);

	$wp_customize->add_setting(
		'smfr_hero_image',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'smfr_hero_image',
			array(
				'label'       => __( 'Image de fond du hero', '_smfr' ),
				'description' => __( 'Affichée floutée derrière le titre. Si vide, les couleurs par défaut sont conservées.', '_smfr' ),
				'section'     => '_smfr_homepage',
			)
		)
	);

	// Fallback image for posts without a featured image.
	$wp_customize->add_setting(
		'smfr_default_thumbnail',
		array(
			'default'           => '',
			'sanitize_callback' => 'esc_url_raw',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'smfr_default_thumbnail',
			array(
				'label'       => __( 'Image par défaut des articles', '_smfr' ),
				'description' => __( 'Utilisée sur la page d’accueil quand un article n’a pas d’image mise en avant. Si vide, le titre « SMITE FRANCE » est affiché.', '_smfr' ),
				'section'     => '_smfr_homepage',
			)
		)
	);

	// Information banner.
	$wp_customize->add_section(
		'_smfr_notice',
		array(
			'title'    => __( 'Bandeau d’information', '_smfr' ),
			'priority' => 31,
		)
	);

	$wp_customize->add_setting(
		'smfr_notice_enable',
		array(
			'default'           => false,
			'sanitize_callback' => 'wp_validate_boolean',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'smfr_notice_enable',
		array(
			'label'   => __( 'Afficher le bandeau', '_smfr' ),
			'section' => '_smfr_notice',
			'type'    => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'smfr_notice_title',
		array(
			'default'           => __( 'INFORMATION IMPORTANTE', '_smfr' ),
			'sanitize_callback' => 'sanitize_text_field',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'smfr_notice_title',
		array(
			'label'   => __( 'Titre du bandeau', '_smfr' ),
			'section' => '_smfr_notice',
			'type'    => 'text',
		)
	);

	$wp_customize->add_setting(
		'smfr_notice_text',
		array(
			'default'           => _smfr_notice_default_text(),
			'sanitize_callback' => 'wp_kses_post',
			'transport'         => 'refresh',
		)
	);

	$wp_customize->add_control(
		'smfr_notice_text',
		array(
			'label'       => __( 'Texte du bandeau', '_smfr' ),
			'description' => __( 'Les sauts de ligne sont conservés.', '_smfr' ),
			'section'     => '_smfr_notice',
			'type'        => 'textarea',
		)
	);

	// Social links.
	$wp_customize->add_section(
		'_smfr_social',
		array(
			'title'    => __( 'Réseaux sociaux', '_smfr' ),
			'priority' => 32,
		)
	);

	foreach ( _smfr_social_networks() as $_smfr_key => $_smfr_network ) {
		$wp_customize->add_setting(
			'smfr_social_' . $_smfr_key,
			array(
				'default'           => $_smfr_network['default'],
				'sanitize_callback' => 'esc_url_raw',
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			'smfr_social_' . $_smfr_key,
			array(
				/* translators: %s: social network name. */
				'label'       => sprintf( __( 'Lien %s', '_smfr' ), $_smfr_network['label'] ),
				'description' => __( 'Laisser vide pour masquer.', '_smfr' ),
				'section'     => '_smfr_social',
				'type'        => 'url',
			)
		);
	}
}
add_action( 'customize_register', '_smfr_customize_register' );
