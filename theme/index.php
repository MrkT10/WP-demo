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
 * @package WPBaseStarter
 */

get_header();
?>

	<main id="main">
		<section id="post-block">

		<?php
		if ( have_posts() ) {

			if ( is_home() && ! is_front_page() ) :
				?>
				<header class="entry-header">
					<h1 class="entry-title"><?php single_post_title(); ?></h1>
				</header><!-- .entry-header -->
				<?php
			endif;

			// Load posts loop.
			while ( have_posts() ) {
				the_post();
				get_template_part( 'template-parts/content/content' );
			}

			// Previous/next page navigation.
			wpbasestarter_the_posts_navigation();

		} else {

			// If no content, include the "No posts found" template.
			get_template_part( 'template-parts/content/content', 'none' );

		}
		?>

		</section><!-- #primary -->
		<section id="rest-endpoint">
			<div></div>
		</section>
		<section id="api">
			<div></div>
		</section>
		<section id="form-validate">
			<div></div>
		</section>
		<section id="front-end-test">
			<div></div>
		</section>
		<section id="back-end-test">
			<div></div>
		</section>
	</main><!-- #main -->

<?php
get_footer();
