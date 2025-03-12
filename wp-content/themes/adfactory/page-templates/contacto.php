<?php

/**
 * The template for displaying all pages
 *
 * Template Name: Contacto
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
		<h1 class="entry-title pt-7 t-blanco fw-700 " data-aos="fade-up">Contáctanos</h1>
	</div>
</div>
<div class="">

</div>
<div class="container text-center py-7">
	<p class="t-marino-2 fw-700 mb-2 fs-35">En breve te contactaremos</p>
	<img src="https://onecard.mx/wp-content/uploads/ALTA.png" alt="" class="pt-7">
</div>

<div class="container pb-7">
	<div class="row d-flex justify-content-center">
		<div class="col-lg-4 text-left py-3">
			<p class="t-marino-2 fw-700 text-left mb-2 fs-20">Atención a Tarjetahabientes</p>
			<a href="mailto:empresas@onecard.mx">Email: empresas@onecard.mx</a><br>
			<a href="tel:+528182488251">Teléfono: +52 (81) 8248 8251</a><br>
		</div>
		<div class="col-lg-4 text-left py-3">
			<p class="t-marino-2 fw-700 text-left mb-2 fs-20">Atención a Empresas</p>
			<a href="mailto:empresas@onecard.mx">Email: empresas@onecard.mx</a><br>
			<a href="tel:+528182488251">Teléfono: +52 (81) 8248 8251</a><br>
		</div>
		<div class="col-lg-4 text-left py-3">
			<p class="t-marino-2 fw-700 text-left mb-2 fs-20">Ventas</p>
			<a href="mailto:ventas@onecard.mx">Email: ventas@onecard.mx</a><br>
			<a href="tel:+528182488250">Teléfono: +52 (81) 8248 8250</a><br>
		</div>

		<div class="col-lg-4 text-center py-3">
			<div class="py-2">
				<span class="">DESCARGA APP ONE CARD</span><br>
				<a href="https://play.google.com/store/apps/details?id=com.oc.onecard" target="_blank">
					<img src="https://onecard.mx/wp-content/uploads/descarga-android.png" alt="" style="height: 25px;">
				</a>
				<a href="https://apps.apple.com/mx/app/onecard-ocsi/id961694908" target="_blank">
					<img src="https://onecard.mx/wp-content/uploads/descarga-iphone.png" alt="" style="height: 25px;">
				</a>
				<a href="https://appgallery.huawei.com/app/C107091765" target="_blank">
					<img src="https://onecard.mx/wp-content/uploads/huawei.png" alt="huawei.png" style="height: 32px;">
				</a>
			</div>
		</div>
		<div class="col-lg-4 text-center py-3">
			<div class="py-2">
				<span class="">DESCARGA APP GOTRAVEX</span><br>
				<a href="https://play.google.com/store/apps/details?id=travex.onecard.mx" target="_blank"><img src="https://onecard.mx/wp-content/uploads/descarga-android.png" alt="" style="height: 25px;"></a>
				<a href="https://apps.apple.com/mx/app/travex/id1283079491" target="_blank"><img src="https://onecard.mx/wp-content/uploads/descarga-iphone.png" alt="" style="height: 25px;"></a>
				<a href="https://appgallery.huawei.com/app/C107158273 " target="_blank">
					<img src="https://onecard.mx/wp-content/uploads/huawei.png" alt="huawei.png" style="height: 32px;">
				</a>
			</div>
		</div>
	</div>
</div>
<div class="container text-center pb-7" id="formulario-contacto">
	<h3 class="titulo-contacto fw-700 fs-35 pb-4 " data-aos="fade-up">Solicita más información</h3>
	<p class="t-contacto" data-aos="fade-up">Registra tus datos y un agente comercial <br class="hidden-xs">se comunicará a la brevedad para atender tu necesidad.</p>
	<div class="contact-form container formulario-footer" data-aos="fade-up">
		<?php echo do_shortcode('[contact-form-7 id="447" title="Nuevo formulario de contacto"]'); ?>
	</div>
</div>

<div class="container pb-7">
	<h2 class="text-left fw-700 fs-35 pb-4">Descarga la guia para registrar o actualizar tus datos</h2>
	<div class="text-left">
		<a href="https://onecard.mx/solucion-app.pdf" target="_blank" class="btn-1">Guia Rapida</a>
		<div class="py-1 hidden-lg hidden-md">
			<br>
		</div>
		<a href="https://www.youtube.com/watch?v=E-0ItlIfFZ8&t=2s" target="_blank" class="btn-1">Video Tutorial</a>
	</div>
</div>


</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
