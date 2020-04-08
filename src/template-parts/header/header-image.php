<?php
/**
 * Displays header media
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="custom-header">

		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
			<img src="https://res.cloudinary.com/gruseltourleipzig/image/upload/q_auto/f_auto/v1534451312/123.png" alt="Gruseltour Leipzig - Bist du bereit ?" />
		</a>

		<div class="custom-header-media">
			<?php the_custom_header_markup(); ?>
		</div>

	<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

</div><!-- .custom-header -->
