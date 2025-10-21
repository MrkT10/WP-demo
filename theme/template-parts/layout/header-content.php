<?php
/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WPBaseStarter
 */

?>

<header id="masthead">

	<div>
		<div class="flex flex-row gap-4" id="top-nav">
			<?php
			if ( is_front_page() ) :
				?>
				<h1><?php bloginfo( 'name' ); ?></h1>
				<span>|</span>
				<?php
			else :
				?>
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				<span>|</span>
				<?php
			endif;

			if (function_exists('custom_breadcrumbs')) custom_breadcrumbs();


			$wpbasestarter_description = get_bloginfo( 'description', 'display' );
			if ( $wpbasestarter_description || is_customize_preview() ) :
				?>
				<p><?php echo $wpbasestarter_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
			<?php endif; ?>
		</div>
	</div>

</header><!-- #masthead -->
	<div class="darkmode-wrapper">