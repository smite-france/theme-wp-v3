<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no `home.php` file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _smfr
 */

get_header();
?>

<?php if ( is_front_page() ) : ?>
	<?php get_template_part( 'template-parts/layout/hero' ); ?>
	<?php get_template_part( 'template-parts/layout/notice' ); ?>
<?php endif; ?>

	<?php $_smfr_home_sidebar = is_front_page() && is_active_sidebar( 'sidebar-home' ); ?>

	<section id="primary" class="<?php echo $_smfr_home_sidebar ? 'lg:grid lg:grid-cols-[minmax(0,1fr)_300px] lg:gap-10' : ''; ?>">
		<main id="main">

		<?php
		if ( have_posts() ) {

			if ( is_home() && ! is_front_page() ) :
				?>
				<header class="entry-header mb-8">
					<h1 class="section-title"><?php single_post_title(); ?></h1>
				</header><!-- .entry-header -->
				<?php
			else :
				?>
				<header class="mb-8">
					<h2 class="section-title"><?php esc_html_e( 'Dernières actualités', '_smfr' ); ?></h2>
				</header>
				<?php
			endif;
			?>

			<div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
				<?php
				// Load posts loop.
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content/content', 'excerpt' );
				}
				?>
			</div>

			<?php
			// Previous/next page navigation.
			_smfr_the_posts_navigation();

		} else {

			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content/content', 'none' );

		}
		?>

		</main><!-- #main -->

		<?php if ( $_smfr_home_sidebar ) : ?>
			<aside role="complementary" class="mt-12 lg:mt-0" aria-label="<?php esc_attr_e( 'Colonne accueil', '_smfr' ); ?>">
				<?php dynamic_sidebar( 'sidebar-home' ); ?>
			</aside>
		<?php endif; ?>
	</section><!-- #primary -->

<?php
get_footer();
