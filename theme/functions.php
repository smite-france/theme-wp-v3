<?php
/**
 * _smfr functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _smfr
 */

if ( ! defined( '_SMFR_VERSION' ) ) {
	/*
	 * Set the theme’s version number.
	 *
	 * This is used primarily for cache busting. If you use `npm run bundle`
	 * to create your production build, the value below will be replaced in the
	 * generated zip file with a timestamp, converted to base 36.
	 */
	define( '_SMFR_VERSION', '0.1.1' );
}

if ( ! defined( '_SMFR_TYPOGRAPHY_CLASSES' ) ) {
	/*
	 * Set Tailwind Typography classes for the front end, block editor and
	 * classic editor using the constant below.
	 *
	 * For the front end, these classes are added by the `_smfr_content_class`
	 * function. You will see that function used everywhere an `entry-content`
	 * or `page-content` class has been added to a wrapper element.
	 *
	 * For the block editor, these classes are converted to a JavaScript array
	 * and then used by the `./javascript/block-editor.js` file, which adds
	 * them to the appropriate elements in the block editor (and adds them
	 * again when they’re removed.)
	 *
	 * For the classic editor (and anything using TinyMCE, like Advanced Custom
	 * Fields), these classes are added to TinyMCE’s body class when it
	 * initializes.
	 */
	define(
		'_SMFR_TYPOGRAPHY_CLASSES',
		'prose max-w-none prose-headings:font-display prose-a:text-secondary hover:prose-a:text-primary'
	);
}

if ( ! function_exists( '_smfr_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function _smfr_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on _smfr, use a find and replace
		 * to change '_smfr' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( '_smfr', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', '_smfr' ),
				'menu-2' => __( 'Footer Menu', '_smfr' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );

		// Add support for custom logo (configurable via Appearance > Customize > Identité du site).
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 60,
				'width'       => 200,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		// Remove support for block templates.
		remove_theme_support( 'block-templates' );
	}
endif;
add_action( 'after_setup_theme', '_smfr_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _smfr_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Footer', '_smfr' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', '_smfr' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', '_smfr_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function _smfr_scripts() {
	wp_enqueue_style(
		'_smfr-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Rajdhani:wght@500;600;700&display=swap',
		array(),
		null
	);
	wp_enqueue_style( '_smfr-style', get_stylesheet_uri(), array( '_smfr-fonts' ), _SMFR_VERSION );
	wp_enqueue_script( '_smfr-script', get_template_directory_uri() . '/js/script.min.js', array(), _SMFR_VERSION, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', '_smfr_scripts' );

/**
 * Enqueue the block editor script.
 */
function _smfr_enqueue_block_editor_script() {
	$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : null;

	if (
		$current_screen &&
		$current_screen->is_block_editor() &&
		'widgets' !== $current_screen->id
	) {
		wp_enqueue_script(
			'_smfr-editor',
			get_template_directory_uri() . '/js/block-editor.min.js',
			array(
				'wp-blocks',
				'wp-edit-post',
			),
			_SMFR_VERSION,
			true
		);
		wp_add_inline_script( '_smfr-editor', "tailwindTypographyClasses = '" . esc_attr( _SMFR_TYPOGRAPHY_CLASSES ) . "'.split(' ');", 'before' );
	}
}
add_action( 'enqueue_block_assets', '_smfr_enqueue_block_editor_script' );

/**
 * Add the Tailwind Typography classes to TinyMCE.
 *
 * @param array $settings TinyMCE settings.
 * @return array
 */
function _smfr_tinymce_add_class( $settings ) {
	$settings['body_class'] = _SMFR_TYPOGRAPHY_CLASSES;
	return $settings;
}
add_filter( 'tiny_mce_before_init', '_smfr_tinymce_add_class' );

/**
 * Limit the block editor to heading levels supported by Tailwind Typography.
 *
 * @param array  $args Array of arguments for registering a block type.
 * @param string $block_type Block type name including namespace.
 * @return array
 */
function _smfr_modify_heading_levels( $args, $block_type ) {
	if ( 'core/heading' !== $block_type ) {
		return $args;
	}

	// Remove <h1>, <h5> and <h6>.
	$args['attributes']['levelOptions']['default'] = array( 2, 3, 4 );

	return $args;
}
add_filter( 'register_block_type_args', '_smfr_modify_heading_levels', 10, 2 );

/**
 * Fallback for the primary navigation when no menu has been assigned to the
 * `menu-1` location yet. Outputs the site's pages inside the same
 * `<ul id="primary-menu">` markup the theme expects, so styling and the
 * mobile toggle keep working out of the box.
 */
function _smfr_primary_menu_fallback() {
	$_smfr_links = wp_list_pages(
		array(
			'title_li' => '',
			'echo'     => false,
			'depth'    => 1,
		)
	);

	if ( empty( $_smfr_links ) ) {
		// No pages either: at least link to the home page so the menu exists.
		$_smfr_links = '<li><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Accueil', '_smfr' ) . '</a></li>';
	}

	echo '<ul id="primary-menu" class="menu">' . $_smfr_links . '</ul>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
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
 * Register theme options in the WordPress Customizer.
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
}
add_action( 'customize_register', '_smfr_customize_register' );

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';
