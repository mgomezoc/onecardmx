<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @package adfactory
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!--BOOTSTRAP 4.3-->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

	<!--GOOGLE FONTS MONTSERRAT-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,500,700&display=swap" rel="stylesheet">

	<!--ESTILOS-->
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/generales.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/onecard.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/estilos-1.css">
	<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/media.css">

	<!-- Meta Pixel Code (OneCard - Todas las páginas) -->
	<script>
		! function(f, b, e, v, n, t, s) {
			if (f.fbq) return;
			n = f.fbq = function() {
				n.callMethod ?
					n.callMethod.apply(n, arguments) : n.queue.push(arguments)
			};
			if (!f._fbq) f._fbq = n;
			n.push = n;
			n.loaded = !0;
			n.version = '2.0';
			n.queue = [];
			t = b.createElement(e);
			t.async = !0;
			t.src = v;
			s = b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t, s)
		}(window, document, 'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '1134490787849389');
		fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
			src="https://www.facebook.com/tr?id=1134490787849389&ev=PageView&noscript=1" /></noscript>
	<!-- End Meta Pixel Code -->

	<?php wp_head(); ?>

	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', 'GTM-KBKK74W');
	</script>
	<!-- End Google Tag Manager -->

</head>

<body <?php body_class(); ?>>
	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-KBKK74W"
			height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to content', 'adfactory'); ?></a>

		<header id="masthead" class="bg-oscuro fixed-top">
			<nav class="navbar navbar-expand-lg  container">
				<span id="logo" class="logo-principal"> <?php the_custom_logo(); ?> </span>

				<div id="nav-icon3" class="navbar-toggler" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
					<span></span>
					<span></span>
					<span></span>
					<span></span>
				</div>

				<div class="collapse navbar-collapse" id="navbarNav">
					<div id="menu-principal" class="ml-auto">
						<?php
						wp_nav_menu(array(
							'theme_location' => 'menu-1',
							'menu_id'        => 'primary-menu',
						));
						?>
					</div>
				</div>
			</nav>
		</header><!-- #masthead -->

		<div id="content" class="site-content">