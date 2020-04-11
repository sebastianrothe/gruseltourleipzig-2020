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
			<img src="https://res.cloudinary.com/gruseltourleipzig/image/upload/q_auto/f_auto/v1508406596/cropped-cropped-grusel-poster-a3-e1480026424555-1_cgpp1f.jpg" alt="Gruseltour Leipzig - Bist du bereit für die außergewöhnliche Stadtführung?"/>>
		</a>

		<div class="custom-header-media">
			<?php the_custom_header_markup(); ?>
		</div>

	<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>

</div><!-- .custom-header -->
