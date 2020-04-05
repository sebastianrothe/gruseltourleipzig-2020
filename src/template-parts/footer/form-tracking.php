<?php
/**
 * Track form conversions
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<aside class="form-tracking">
	<!-- Global site tag (gtag.js) - Google Ads: 882340906 -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-882340906"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'AW-882340906');
	</script>

	<?php if (is_page('anmeldung-erfolgreich')) { ?>
		<!-- Event snippet for Sign-up Berlin conversion page -->
		<script>
		gtag('event', 'conversion', {'send_to': 'AW-882340906/iZgzCLuuiMABEKro3aQD'});
		</script>
	<?php } ?>
</aside>
