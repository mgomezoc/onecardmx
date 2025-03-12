<?php
/**
 * The template for displaying all pages
 *
 * Template Name: Productos y servicios
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package adfactory
 */

get_header();
?>

<div class="bg-marino-gradient">
	<div class="container py-7 text-center">
		<h1 class="entry-title pt-7 t-blanco fw-700" data-aos="fade-up">Nuestros productos principales se dividen en 3 áreas:</h1>
	</div>
</div>

	<div class="">
		<div class="container py-7">
			<div class="row">
				<div class="col-lg-4 py-4" data-aos="fade-up">
					<img src="https://onecard.mx/wp-content/uploads/servicios-empresa.jpg" alt="servicios empresa" class="pb-4 text-center">
					<h4 class="t-marino-2 fw-700 text-left mb-2 fs-20">Empresas</h4>
					<p class="text-left">Integramos soluciones que simplifican la manera de controlar y administrar el gasto, a la vez ofreciendo beneficios y prestaciones prácticas y convenientes a toda la fuerza laboral de las empresas.</p>
				</div>
				<div class="col-lg-4 py-4" data-aos="fade-up">
					<img src="https://onecard.mx/wp-content/uploads/servicios-comercio.jpg" alt="servicios comercio" class="pb-4 text-center">
					<h4 class="t-marino-2 fw-700 text-left mb-2 fs-20">Comercio</h4>
					<p class="text-left">Nuestras soluciones en comercio están enfocadas a incentivar la venta por medio de programas de lealtad y acercamiento con el cliente, ofreciendo como valor agregado un control de todos los movimientos en tiempo real de los usuarios que utilizan el sistema OneCard.</p>
				</div>
				<div class="col-lg-4 py-4" data-aos="fade-up">
					<img src="https://onecard.mx/wp-content/uploads/servicios-gobierno.jpg" alt="servicios gobierno" class="pb-4 text-center">
					<h4 class="t-marino-2 fw-700 text-left mb-2 fs-20">Gobierno</h4>
					<p class="text-left">Trabajamos en colaboración con entidades gubernamentales ya sea a nivel federal, estatal o municipal para que, por medio de nuestro sistema, puedan gestionar programas de Apoyo Sociales de una manera más efectiva y práctica, llevando un control de todo el proceso de gestión.</p>
				</div>
			</div>
		</div>
	</div>


		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
