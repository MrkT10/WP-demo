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
		<section id="post-block-rest-api">
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
			?>
			<div class="section-header">
				<div class="section-disclaimer">
					<div>
						<h2><span class="text-highlight">1.</span>Custom block wordpress <span class="text-highlight">&</span>custom rest api</h2>
						<p>Uruchom domyślny wpis zeby przejść do jego edycji</p>
					</div>
					<div>
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 animate-bounce">
							<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 13.5 12 21m0 0-7.5-7.5M12 21V3" />
						</svg>
					</div>
				</div>
			</div>
			<?php
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
		<section id="api">
			<div class="section-header">
				<div class="section-disclaimer">
					<div>
						<h2><span class="text-highlight">2.</span>Zewnętrzne API</h2>
						<p>Pole z danymi pobranymi z zewnętrznego API znajdziesz ponizej.</p>
						<p class="text-gray-500">* stałe współrzędne dla Krakowa z <a href="https://open-meteo.com">open-meteo.com</a></p>
					</div>
				</div>
			</div>
			<div class="weather-wrapper">
				<div class="code">
					<?php
						echo do_shortcode('[pogoda_open_meteo]');
					?>
				</div>
			</div>
		</section>
		<section id="form-validate">
			<div class="section-header">
				<div class="section-disclaimer">
					<div>
						<h2><span class="text-highlight">3.</span>Walidacja formularza ajax</h2>
						<p>Wypełnij ponizszy formularz kontaktowy zeby sprawdzić walidację po stronie frontu:</p>
					</div>
				</div>
			</div>
			<div class="form-validate">
				<form id="demo-form">
					<input type="text" id="imie" name="imie" placeholder="Wpisz imię">
					<input type="text" id="miasto" name="miasto" placeholder="Wpisz miasto">
					<input type="email" id="email" name="email" placeholder="Wpisz e-mail">
					<button type="submit">Wyślij</button>
				</form>
				<div id="form-result"></div>
			</div>
		</section>
		<section id="live-project">
			<div class="section-header">
				<div class="section-disclaimer">
					<div>
						<h2><span class="text-highlight">4.</span>Blog odrabiamy</h2>
						<p>I dla podglądu jedna z moich stron:</p>
						<ul class="list-disc code">
							<li>własny szablon, wszystkie elementy projektowane od podstaw</li>
							<li>custom post types, ciągłe utrzymanie i zmiany layoutu</li>
							<li>110 kategorii na 3 poziomach, rozszerzenia multimedialne</li>
							<li>darmkode, custom przejścia i animacje</li>
							<li>migracje komponentów ze starej bazy</li>
						</ul>
						<p>Pod linkiem: <a href="https://blog.odrabiamy.pl/">https://blog.odrabiamy.pl/</a></p>
					</div>
				</div>
			</div>
		</section>
		<section id="bb">
			<div class="section-header">
				<div class="section-disclaimer">
					<div class="mb-20">
						<h2><span class="text-highlight">end</span></h2>
						<p>Odzywajcie się w razie pytań albo dorzućcie komentarz w repo 🫡</p>
					</div>
				</div>
			</div>
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
