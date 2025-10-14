<?php
/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WPBaseStarter
 */

?>

<footer id="colophon">
	<div class="bg-gray-800 border-t-2 border-red-600 py-4 text-gray-200 text-center">
		<?php
		$wpbasestarter_blog_info = get_bloginfo( 'name' );
		if ( ! empty( $wpbasestarter_blog_info ) ) :
			?>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php echo wp_get_theme()->get( 'Name' ); ?></a>,
			<?php
		endif;

		/* translators: 1: WordPress link */
		printf(
			'<a href="%1$s">made by Mateusz Markowski</a>.',
			esc_url( __( 'https://wordpress.org/', 'wpbasestarter' ) ),
			'WordPress'
		);
		?>
	</div>

</footer><!-- #colophon -->
