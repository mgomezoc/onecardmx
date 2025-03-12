<?php

/**
 * The template for displaying all pages
 *
 * Template Name: Premios ADS
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

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<div class="bg-header premios min-vh-30 d-flex align-items-center">
			<div class="container">
				<div class="row h-600 d-flex align-items-center py-6">
					<div class="col-lg-12 text-center pt-8 pb-5">
						<img src="https://onecard.mx/wp-content/uploads/logo.png" alt="logo onecard" class="pt-5 mw-250 hidden-xs hidden-sm" data-aos="fade-up">
					</div>
					<div class="col-lg-7 text-center">
						<img src="https://onecard.mx/wp-content/uploads/header-tarjeta-premios.png" alt="tarjeta premios" data-aos="fade-up">
					</div>
					<div class="col-lg-5 text-center d-none">
						<?php echo do_shortcode('[contact-form-7 id="303" title="Formulario head"]'); ?>
					</div>
					<div class="col-lg-12 pt-1 pb-7 text-center">
						<h1 class="t-naranja fw-700 mb-0 mayusculas" data-aos="fade-up">Tarjeta de Premios <br class="hidden-xs hidden-sm">one card</h1>
						<h2 class="t-blanco fw-500 py-4 mb-0" data-aos="fade-up">Ideal para premiar o incentivar a <br class="hidden-xs hidden-sm">comisionistas y vendedores</h2>
					</div>
				</div>
			</div>
		</div>

		<div class="bg-oscuro">
			<div class="container py-7 text-center">
				<h2 class="t-blanco fw-500 fs-35 pb-4" data-aos="fade-up">Tarjeta de premios One Card</h2>
				<p class="t-blanco pb-4" data-aos="fade-up">Es una tarjeta aceptada en cualquier punto de venta con terminal bancaria en México. Se utiliza principalmente para premiar o incentivar a comisionistas y/o vendedores siendo un medio muy eficiente para las empresas.</p>
				<div class="row">
					<div class="col-lg col-sm-6 py-4 text-center">
						<img src="https://onecard.mx/wp-content/uploads/icono-premios-1.png" alt="ícono Aceptada en cualquier punto de venta de todo el país" class="rounded-circle bg-naranja-1 mw-75" data-aos="fade-up">
						<p class="t-blanco mb-0 pt-2" data-aos="fade-up">Aceptada en cualquier punto de venta de todo el país</p>
					</div>
					<div class="col-lg col-sm-6 py-4 text-center">
						<img src="https://onecard.mx/wp-content/uploads/icono-premios-2.png" alt="ícono elegir el comercio" class="rounded-circle bg-naranja-1 mw-75" data-aos="fade-up">
						<p class="t-blanco mb-0 pt-2" data-aos="fade-up">Tienes la capacidad de poder elegir el comercio</p>
					</div>
					<div class="col-lg col-sm-6 py-4 text-center">
						<img src="https://onecard.mx/wp-content/uploads/icono-premios-4.png" alt="ícono Administración Web en computadoras o móviles" class="rounded-circle bg-naranja-1 mw-75" data-aos="fade-up">
						<p class="t-blanco mb-0 pt-2" data-aos="fade-up">Administración Web en computadoras o móviles</p>
					</div>
				</div>
			</div>
		</div>

		<div class="bg-naranja-2 d-none">
			<div class="container">
				<div class="row d-flex align-items-center">
					<div class="col-lg-3 text-center">
						<div class="py-3">
							<img src="https://onecard.mx/wp-content/uploads/tarjeta-premios-landing.png" alt="tarjeta premios" data-aos="fade-right">
						</div>
					</div>
					<div class="col-lg-6 text-left">
						<div class="py-4">
							<h3 class="t-blanco fw-700 mb-0 fs-25" data-aos="fade">Solicita una cotización</h3>
							<span class="t-blanco fw-300 mb-0 fs-20" data-aos="fade">Por tiempo limitado recibe una promoción en cotizaciones vía internet</span>
						</div>
					</div>
					<div class="col-lg-3 text-center">
						<div class="py-5" data-aos="fade">
							<a href="#" class="btn-3 relative" data-toggle="modal" data-target=".formulario-modal">SOLICITAR</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="bg-blanco">
			<div class="container py-7 text-center">
				<div class="p-4 text-center">
					<h3 class="fw-700 fs-30">¿Quieres conocer más?</h3>
					<p>Nuestro equipo te asesora para encontrar la mejor solución para tu negocio.</p>
					<a href="#" class="relative btn-2" data-toggle="modal" data-target=".formulario-modal">Contacta un asesor</a>
				</div>

				<h2 class="fw-700 fs-35 t-naranja py-5" data-aos="fade-up">Ofrece a tus empleados los mejores beneficios</h2>

				<div class="row d-flex align-items-center">
					<div class="col-lg-7 text-left pt-7">

						<p class=" fs-18 d-flex align-items-center" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-naranja-1 mr-1 hidden-xs hidden-sm" alt="ícono Vales electrónicos"> Vales electrónicos utilizando una tarjeta plástica que brinda mayor seguridad para el cliente.</p>
						<p class=" fs-18 d-flex align-items-center" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-naranja-1 mr-1 hidden-xs hidden-sm" alt="ícono Aceptación en cualquier comercio"> Aceptación en cualquier comercio que acepten tarjetas Carnet en México.</p>
						<p class=" fs-18 d-flex align-items-center" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-naranja-1 mr-1 hidden-xs hidden-sm" alt="ícono Consulta tu saldo"> Consulta tu saldo a través de nuestra página web o por teléfono marcando al (81) 824 882 51.</p>
					</div>
					<div class="col-lg-5 py-4">
						<img src="https://onecard.mx/wp-content/uploads/tarjeta-premios-seccion.png" alt="tarjeta premios perfil" class="py-2" data-aos="fade-up">
					</div>
				</div>
			</div>
		</div>

		<div class="bg-ventajas-premios">
			<div class="container py-7 text-center">
				<h2 class="fs-35 fw-700 t-blanco" data-aos="fade-up">Ventajas One Card</h2>
				<p class="t-blanco fs-18" data-aos="fade-up">Empresa</p>

				<div class="row pt-3">
					<div class="col-lg-6">
						<p class="t-blanco text-left d-flex align-items-center" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check-blanco.png" class="rounded-circle mr-1 hidden-xs hidden-sm" alt="ícono check"> Sistema vía web de administración que permite a las empresas un manejo eficiente para la generación de nuevas tarjetas, administración de saldos, depósitos y reportes de movimientos.</p>
						<p class="t-blanco text-left d-flex align-items-center" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check-blanco.png" class="rounded-circle mr-1 hidden-xs hidden-sm" alt="ícono check"> Permite controles administrativos adicionales a la empresa.</p>
					</div>
					<div class="col-lg-6">

						<p class="t-blanco text-left d-flex align-items-center" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check-blanco.png" class="rounded-circle mr-1 hidden-xs hidden-sm" alt="ícono check"> Personalización de tarjeta de acuerdo a las necesidades de los clientes.</p>
						<p class="t-blanco text-left d-flex align-items-center" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check-blanco.png" class="rounded-circle mr-1 hidden-xs hidden-sm" alt="ícono check"> Autocontrol por parte de la empresa para la dispersión de fondos.</p>
					</div>
				</div>
			</div>
		</div>
	</main><!-- #main -->
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		$(".banner").addClass("premios");
	});
</script><<!-- #primary -->

	<?php
	get_footer();
