<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WPBaseStarter
 */

get_header();
?>
	<section id="disclaimer">
		<div class="disclaimer-wrapper">
			<div class="flex flex-col gap-2">
				<p>Żeby zobaczyć nowy blok przejdź do edycji posta - w blokach gutenberg znajdziesz nowy blok o nazwie <span class="text-highlight">'demo-block'.</span></p>
				<p>Jeśli na liście nie widzisz bloku o tej nazwie prawdopodobnie zapomniałeś o stworzeniu builda:</span></p>
				<div class="code w-full">
					<p>npm run build-block</p>
				</div>
			</div>
		</div>
	</section>
	<section id="primary">
		<main id="main">

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content/content', 'single' );

				// End the loop.
			endwhile;
			?>

		</main><!-- #main -->
	</section><!-- #primary -->
	<section id="back">
		<div class="disclaimer-wrapper">
			<div class="flex flex-col gap-2 mb-12">
				<p>Wróć na stronę główną zeby zobaczyć pozostałe funkcjonalności</p>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>">> Strona główna</a>
			</div>
		</div>
	</section>

<?php
get_footer();
