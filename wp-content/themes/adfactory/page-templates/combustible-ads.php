<?php

/**
 * The template for displaying all pages
 *
 * Template Name: Combustible ads
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
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=AW-964255762">
</script>
<script>
	window.dataLayer = window.dataLayer || [];

	function gtag() {
		dataLayer.push(arguments);
	}
	gtag('js', new Date());

	gtag('config', 'AW-964255762');
</script>
<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<div class="bg-header combustible min-vh-30 d-flex align-items-center">
			<div class="container">
				<div class="row h-600 d-flex align-items-start pt-6 justify-content-center">
					<div class="col-lg-12 text-center pt-8 pb-5">
						<img src="https://onecard.mx/wp-content/uploads/logo.png" alt="logo onecard" class="pt-5 mw-250 hidden-xs hidden-sm" data-aos="fade-up">
					</div>
					<div class="col-lg-6 text-center">
						<img src="https://onecard.mx/wp-content/uploads/cards-combustible.png" alt="tarjetas combustible " data-aos="fade-up" class="pb-4 max-w-600">
					</div>
					<div class="col-lg-5 text-center d-none">
						<?php echo do_shortcode('[contact-form-7 id="303" title="Formulario head"]'); ?>
					</div>
					<div class="col-lg-12 pt-1 pb-7 text-center">
						<h1 class="t-verde fw-700 mb-0 mayusculas" data-aos="fade-up">Tarjeta de combustible</h1>
						<h2 class="t-blanco fw-500 py-4 mb-0" data-aos="fade-up">La mejor manera de controlar y administrar <br class="hidden-xs hidden-sm">el gasto de combustible de tu empresa.</h2>
						<p class="t-blanco fs-20 mb-0" data-aos="fade-up">Simplifica la administración y facturación</p>
					</div>
				</div>
			</div>
		</div>

		<div class="bg-oscuro">
			<div class="container py-7 text-center">
				<h2 class="t-verde fw-700 fs-35 pb-4" data-aos="fade-up">Monedero electrónico de Combustible <br> Autorizado por el SAT</h2>
				<p class="t-blanco pb-4" data-aos="fade-up">El medio ideal de pago autorizada por el SAT, con el cual obtendrás un mayor control y administración del gasto de combustible dentro de tu empresa, simplificado en un solo CFDI deducible mensual.</p>
				<div class="row">
					<div class="col-lg col-sm-6 py-4 text-center">
						<img src="https://onecard.mx/wp-content/uploads/icono-combustible-1.png" alt="ícono consumos de combustible" class="rounded-circle bg-verde mw-75" data-aos="fade-up">
						<p class="t-blanco mb-0 pt-2" data-aos="fade-up">Deducción de gasolina del 100% en el consumo de combustible de tu empresa</p>
					</div>
					<div class="col-lg col-sm-6 py-4 text-center">
						<img src="https://onecard.mx/wp-content/uploads/icono-combustible-2.png" alt="ícono genera reportes" class="rounded-circle bg-verde mw-75" data-aos="fade-up">
						<p class="t-blanco mb-0 pt-2" data-aos="fade-up">Genera reportes <br class="hidden-xs hidden-sm">de consumo</p>
					</div>
					<div class="col-lg col-sm-6 py-4 text-center">
						<img src="https://onecard.mx/wp-content/uploads/icono-combustible-3.png" alt="ícono dispersión" class="rounded-circle bg-verde mw-75" data-aos="fade-up">
						<p class="t-blanco mb-0 pt-2" data-aos="fade-up">Dispersión <br class="hidden-xs hidden-sm">24/7/365</p>
					</div>
					<div class="col-lg col-sm-6 py-4 text-center">
						<img src="https://onecard.mx/wp-content/uploads/icono-combustible-4.png" alt="ícono Administración Web" class="rounded-circle bg-verde mw-75" data-aos="fade-up">
						<p class="t-blanco mb-0 pt-2" data-aos="fade-up">Administración Web <br class="hidden-xs hidden-sm">en computadoras o <br class="hidden-xs hidden-sm">móviles</p>
					</div>
					<div class="col-lg col-sm-6 py-4 text-center">
						<img src="https://onecard.mx/wp-content/uploads/icono-combustible-5.png" alt="ícono certificado" class="rounded-circle bg-verde mw-75" data-aos="fade-up">
						<p class="t-blanco mb-0 pt-2" data-aos="fade-up">Certificado por <br class="hidden-xs hidden-sm">SAT</p>
					</div>

				</div>
			</div>
		</div>

		<div class="bg-gris-2 d-none">
			<div class="container">
				<div class="row d-flex align-items-center">
					<div class="col-lg-3 text-center">
						<div class="py-3">
							<img src="https://onecard.mx/wp-content/uploads/tarjeta-combustible-landing.png" alt="tarjeta gasolina" data-aos="fade-right">
						</div>
					</div>
					<div class="col-lg-6 text-left">
						<div class="py-4">
							<h3 class=" fw-700 mb-0 fs-25" data-aos="fade">Solicita una cotización</h3>
							<span class=" fw-300 mb-0 fs-20" data-aos="fade">Por tiempo limitado recibe una promoción en cotizaciones vía internet</span>
						</div>
					</div>
					<div class="col-lg-3 text-center">
						<div class="py-5" data-aos="fade">
							<a href="#" class="btn-2 relative" data-toggle="modal" data-target=".formulario-modal">SOLICITAR</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="bg-blanco">
			<div class="container pt-7 text-center">
				<div class="p-4 text-center">
					<h3 class="fw-700 fs-30">¿Quieres conocer más?</h3>
					<p>Nuestro equipo te asesora para encontrar la mejor solución para tu negocio.</p>
					<a href="#" class="relative btn-2" data-toggle="modal" data-target=".formulario-modal">Contacta un asesor</a>
				</div>

				<h2 class="fw-700 fs-35 t-verde py-5" data-aos="fade-up">Ofrece a tus empleados los mejores beneficios</h2>

				<div class="row d-flex align-items-end ">
					<div class="col-lg-4">
						<img src="https://onecard.mx/wp-content/uploads/movil-inicio.png" alt="movil onecard" class="neg-bot-80" data-aos="fade-up">
					</div>
					<div class="col-lg-6 text-left">
						<p class=" fs-18" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm" alt="ícono check"> Ya no requiere pedir facturas.</p>
						<p class=" fs-18 d-flex align-items-center" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm" alt="ícono check"> App móvil (Android y iOS) para consulta de saldo y administración del monedero.</p>
						<p class=" fs-18" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm" alt="ícono check"> Cobertura nacional.</p>
						<p class=" fs-18 d-flex align-items-center" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm" alt="ícono check"> Consulta saldo vía web, teléfono, SMS (costo por mensaje) o app (Android y iOS).</p>
						<p class=" fs-18" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm" alt="ícono check"> Elimina el manejo de efectivo. </p>
						<p class=" fs-18" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm" alt="ícono check"> Bloquea y desbloquea tu tarjeta desde el app móvil </p>
					</div>
					<div class="col-lg-2 hidden-xs">
						<img src="https://onecard.mx/wp-content/uploads/despachador-gasolina.png" alt="despachador gasolina" class="neg-bot-80" data-aos="fade-up">
					</div>
				</div>
			</div>
		</div>
		<div class="bg-verde">
			<div class="container py-3">
				<div class="row d-flex align-items-center">
					<div class="col-lg-4">
					</div>
					<div class="col-lg-6 text-left">
						<h3 class="fw-700 fs-25 t-blanco mb-0" data-aos="fade-up">Administra tus tarjetas de gasolina</h3>
						<p class="t-blanco fw-300 fs-20 mb-0" data-aos="fade-up">Desde nuestra app móvil</p>
					</div>
					<div class="col-lg-2 text-center py-3 hidden-xs hidden-sm" data-aos="fade-up">
						<!--<a href="#" class="btn-3">DESCARGA</a>-->
					</div>
					<div class="col">

					</div>
				</div>
			</div>
		</div>

		<div class="bg-ventajas-combustible">
			<div class="container py-7 text-center">
				<h2 class="fs-35 fw-700 t-blanco pb-4" data-aos="fade-up">One Card te ofrece ventajas incomparables</h2>

				<div class="row pt-3">
					<div class="col-lg-6">
						<p class="t-blanco text-left d-flex align-items-center" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm" alt="ícono check"> Consumos deducibles de impuestos con tan solo el estado de cuenta.</p>
						<p class="t-blanco text-left d-flex align-items-center" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm" alt="ícono check"> Vales electrónicos utilizando una tarjeta plástica que brinda mayor seguridad para el cliente.</p>
						<p class="t-blanco text-left d-flex align-items-center" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm" alt="ícono check"> Aceptación en cualquier estación a nivel nacional.</p>
					</div>
					<div class="col-lg-6">
						<p class="t-blanco text-left d-flex align-items-center" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm" alt="ícono check"> Consulta de saldo a través de nuestra página web o por teléfono marcando al (81) 824 882 51.</p>
						<p class="t-blanco text-left d-flex align-items-center" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm" alt="ícono check"> En caso de robo o extravío servicio 24 horas del día 365 días del año.</p>
					</div>
				</div>
			</div>
		</div>

		<div class="bg-oscuro">
			<div class="container py-3 text-center">
				<div class="row">
					<div class="col-lg col-sm-6 py-4 text-center">
						<img src="https://onecard.mx/wp-content/uploads/iconos-ventajas-1.png" alt="ícono seguridad robo y clonación" class="rounded-circle mw-75" data-aos="fade-up">
						<p class="t-blanco mb-0 pt-2" data-aos="fade-up">Seguridad contra <br class="hidden-xs hidden-sm">robo y clonación</p>
					</div>
					<div class="col-lg col-sm-6 py-4 text-center">
						<img src="https://onecard.mx/wp-content/uploads/iconos-ventajas-2.png" alt="ícono usuario autorizado" class="rounded-circle mw-75" data-aos="fade-up">
						<p class="t-blanco mb-0 pt-2" data-aos="fade-up">Sólo la podrá usar <br class="hidden-xs hidden-sm">el usuario autorizado</p>
					</div>
					<div class="col-lg col-sm-6 py-4 text-center">
						<img src="https://onecard.mx/wp-content/uploads/iconos-ventajas-3.png" alt="ícono monto límite" class="rounded-circle mw-75" data-aos="fade-up">
						<p class="t-blanco mb-0 pt-2" data-aos="fade-up">Monto límite personalizado <br class="hidden-xs hidden-sm">a nivel tarjeta por día y/o <br class="hidden-xs hidden-sm">transacción</p>
					</div>
					<div class="col-lg col-sm-6 py-4 text-center">
						<img src="https://onecard.mx/wp-content/uploads/iconos-ventajas-4.png" alt="ícono Recupera los saldos" class="rounded-circle mw-75" data-aos="fade-up">
						<p class="t-blanco mb-0 pt-2" data-aos="fade-up">Recupera los saldos <br class="hidden-xs hidden-sm">no utilizados</p>
					</div>

				</div>
			</div>
		</div>

		<div class="container py-7">
			<div class="pb-5 text-center">
				<h2 class="t-verde fw-700 fs-35" data-aos="fade-up">Vales de Gasolina Deducibles – Tarjeta de Gasolina</h2>
				<h3 class="fw-700 fs-30 pb-4" data-aos="fade-up">Control de Gastos por Gasolina</h3>
				<p class="text-justify" data-aos="fade-up">Si estás buscando la mejor manera de controlar y administrar el gasto de gasolina de tu empresa, una excelente opción son las tarjetas de vales de gasolina. Las empresas mexicanas enfrentan graves problemática al momento de buscar deducir los altos gastos en combustible que destinan mensualmente en sus flotillas de transporte, además de la engorrosa tarea de comprobar el gasto de gasolina contra su respectiva CFDI, esto considerando que cuenten con la respectiva factura, donde en la mayoría de los casos realizan el pago en efectivo en gasolineras y estaciones de servicio de todo el país. De acuerdo con la Resolución Miscelánea Fiscal 2014, los gastos en combustible en vehículos podrán ser deducibles, siempre y cuando el pago se efectúe a través de monederos electrónicos de vales de gasolina autorizados por el SAT. Es decir los vales de gasolina será deducibles cuando usted como empleador presente una factura única por gasto en gasolina que emita su emisor de monedero electrónico autorizado por el SAT, de esta manera podrá olvidarse de lo engorroso momento de solicitar comprobante o factura cada vez que cargue gasolina a sus unidades.</p>
			</div>
			<div class="row d-flex align-items-center">
				<div class="col-lg-5" data-aos="fade-up">
					<img src="https://onecard.mx/wp-content/uploads/tarjeta-gasolina-nueva.png" alt="tarjeta combustible">
				</div>
				<div class="col-lg-7" data-aos="fade-up">
					<h4 class="fw-700 fs-25 ">Existen beneficios en el uso de monederos electrónicos de vales de gasolina entre ellos</h4>
					<p class="text-left py-3 mb-0" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm" alt="ícono check"> Permiten el 100% de deducción en el gasto por gasolina.</p>

					<p class="text-left py-3 mb-0" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm" alt="ícono check"> Control y seguimiento de consumos.</p>
				</div>
			</div>
			<div class="pt-6" data-aos="fade-up">
				<p class="fs-20 text-left">OneCard ofrece su tarjeta de vales de gasolina que le concede agilizar la comprobación de gasto en gasolina de su empresa, en la emisión de una sola factura.</p>
				<p class="fs-20 text-left fw-500">¿Cómo funcionan las tarjetas de vales de gasolina?</p>
				<p class="fs-20 text-left">Simplifican en gran medida la administración del gasto en combustible, beneficiando en un
					importante porcentaje de ahorro el gasto en vales de gasolina.</p>
				<p class="fs-20 text-left">La tarjeta de vales de gasolina One Card, ofrece la seguridad que usted requiere para el control
					absoluto del consumo de gasolina en su empresa.</p>
			</div>
		</div>

		<div class="bg-oscuro-2">
			<div class="container py-5">
				<div class="row">
					<div class="col-lg-6">
						<h2 class="t-verde fw-700 fs-35 text-center py-6">Ventajas empresas:</h2>
						<p class="t-blanco text-left mb-0 d-flex align-items-center py-3" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm mr-2" alt="ícono check"> Puede ser deducible de impuestos.</p>
						<p class="t-blanco text-left mb-0 d-flex align-items-center py-3" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm mr-2" alt="ícono check"> Puede funcionar para prestación a empleados o para fines operativos de la empresa.</p>
						<p class="t-blanco text-left mb-0 d-flex align-items-center py-3" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm mr-2" alt="ícono check"> Sistema vía web de administración que permite a las empresas un manejo eficiente para la generación de nuevas tarjetas, administración de saldos, depósitos y reportes de movimientos.</p>
						<p class="t-blanco text-left mb-0 d-flex align-items-center py-3" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm mr-2" alt="ícono check"> Permite controles administrativos adicionales a la empresa.</p>
						<p class="t-blanco text-left mb-0 d-flex align-items-center py-3" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm mr-2" alt="ícono check"> Personalización de tarjeta de acuerdo a las necesidades de los clientes.</p>
						<p class="t-blanco text-left mb-0 d-flex align-items-center py-3" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm mr-2" alt="ícono check"> Autocontrol por parte de la empresa para la dispersión de fondos.</p>
					</div>
					<div class="col-lg-6">
						<h2 class="t-verde fw-700 fs-35 text-center py-6">Ventajas usuarios:</h2>
						<p class="t-blanco text-left mb-0 d-flex align-items-center py-3" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm mr-2" alt="ícono check"> Consumos deducibles de impuestos con tan solo el estado de cuenta.</p>
						<p class="t-blanco text-left mb-0 d-flex align-items-center py-3" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm mr-2" alt="ícono check"> Vales electrónicos utilizando una tarjeta plástica que brinda mayor seguridad para el cliente.</p>
						<p class="t-blanco text-left mb-0 d-flex align-items-center py-3" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm mr-2" alt="ícono check"> Aceptación en cualquier estación a nivel nacional.</p>
						<p class="t-blanco text-left mb-0 d-flex align-items-center py-3" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm mr-2" alt="ícono check"> Consulta de saldo a través de nuestra página web o por teléfono marcando al (81) 824 882 51.</p>
						<p class="t-blanco text-left mb-0 d-flex align-items-center py-3" data-aos="fade-up"><img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-verde mr-1 hidden-xs hidden-sm mr-2" alt="ícono check"> En caso de robo o extravío servicio 24 horas del día 365 días del año.</p>
					</div>
				</div>
			</div>
		</div>
	</main><!-- #main -->
</div>

<script>
	document.addEventListener("DOMContentLoaded", function() {
		$(".banner").addClass("combustible");
	});
</script><!-- #primary -->

<?php
get_footer();
