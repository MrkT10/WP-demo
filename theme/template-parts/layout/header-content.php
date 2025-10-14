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

	<div class="bg-gray-800 text-gray-100 px-4">
		<?php
		if ( is_front_page() ) :
			?>
			<!-- <h1><?php bloginfo( 'name' ); ?></h1> -->
			 <span>Nazwa motywu: </span><b><?php echo wp_get_theme()->get( 'Name' ); ?></b>
			<?php
		else :
			?>
			<p><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php
		endif;

		$wpbasestarter_description = get_bloginfo( 'description', 'display' );
		if ( $wpbasestarter_description || is_customize_preview() ) :
			?>
			<p><?php echo $wpbasestarter_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
		<?php endif; ?>
	</div>

</header><!-- #masthead -->
