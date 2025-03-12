<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package adfactory
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

			<section class="error-404 not-found" >
				<div class="page-content">

					<div class="bg-marino-gradient min-vh-100 d-flex align-items-center justify-content-center">
						<div class="text-center w-100 py-7">
							<img src="http://adfactory.com.mx/proyectos/onecard/wp-content/uploads/logo.png" alt="logo onecard" class="mw-250">
							<h1 class=" fw-700 mayusculas mb-0 t-blanco">Pagina no encontrada</h1>
							<p class="pb-3 fw-500">Parece que no se encontró nada en esta ubicación, contáctanos para resolver tus dudas.</p>
							<a href="/" class="relative btn-2">INICIO</a>
						</div>
					</div>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->

	<?php get_footer();
