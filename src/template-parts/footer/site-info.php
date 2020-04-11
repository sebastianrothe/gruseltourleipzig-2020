<?php
/**
 * Displays footer site info
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="site-info">
	<a href="/bewertungen/">Bewertungen</a>
	<span role="separator" aria-hidden="true"></span>

	<a href="/treffpunkt/">Treffpunkt Gruseltour</a>
	<span role="separator" aria-hidden="true"></span>

	<?php
	if (function_exists('the_privacy_policy_link')) {
		the_privacy_policy_link('', '<span role="separator" aria-hidden="true"></span>');
	}
	?>
	
	<span>Gruseltour Leipzig 👻 is made with ❤️ and ☕ in Leipzig. © <?php echo date("Y"); ?></span>
	<span role="separator" aria-hidden="true"></span>

	<span>Unsere besonderen Stadtführungen gibt es auch in anderen Städten: <a href="https://gruseltour-berlin.de/">Gruseltour Berlin</a></span>
</div><!-- .site-info -->

<!-- Buchen Button -->
<?php if (!isPageWithForm()) { ?>
<aside class="booknow">
	<a class="booknow-link" href="/anmeldung/">
		<span class="booknow-text">Gruseltour hier buchen!</span>
	</a>
<aside>
<?php } ?>

<?php if (is_page('bewertungen')) {?>
	<script async src="https://www.jscache.com/wejs?wtype=cdsratingsonlynarrow&amp;uniq=517&amp;locationId=7319866&amp;lang=de&amp;border=false&amp;shadow=false&amp;backgroundColor=gray&amp;display_version=2" data-loadtrk onload="this.loadtrk=true" data-cfasync="false"></script>
	<script async src="https://www.jscache.com/wejs?wtype=certificateOfExcellence&amp;uniq=578&amp;locationId=7319866&amp;lang=de&amp;year=2019&amp;display_version=2" data-loadtrk onload="this.loadtrk=true" data-cfasync="false"></script>
	<script async src="https://www.jscache.com/wejs?wtype=certificateOfExcellence&amp;uniq=233&amp;locationId=7319866&amp;lang=de&amp;year=2018&amp;display_version=2" data-loadtrk onload="this.loadtrk=true" data-cfasync="false"></script>
	<script async src="https://www.jscache.com/wejs?wtype=certificateOfExcellence&amp;uniq=551&amp;locationId=7319866&amp;lang=de&amp;year=2017&amp;display_version=2" data-loadtrk onload="this.loadtrk=true" data-cfasync="false"></script>
	<script async src="https://www.jscache.com/wejs?wtype=certificateOfExcellence&amp;uniq=440&amp;locationId=7319866&amp;lang=de&amp;year=2016&amp;display_version=2" data-loadtrk onload="this.loadtrk=true" data-cfasync="false"></script>
<?php }?>
