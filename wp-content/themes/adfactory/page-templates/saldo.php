<?php

/**
 * The template for displaying all pages
 *
 * Template Name: Saldo
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
    <h1 class="entry-title pt-7 t-blanco fw-700" data-aos="fade-up">Administra tus tarjetas fácilmente</h1>
  </div>
</div>

<div class="container py-7">
  <div class="row d-flex align-items-center">
    <div class="col-lg-3 py-3 text-center m-0auto">
      <img src="https://onecard.mx/wp-content/uploads/descarga-app-movil.png" class="w-100 text-center" style="max-width: 404px " alt="">
    </div>
    <div class="col-lg-9 py-3">
      <h2 class="text-left t-marino-2 fw-700 fs-35 pb-4">Descarga la App móvil y consulta tu saldo, movimientos y más funcionalidades.</h2>
      <p>- Consultar tu saldo.
        <br>- Revisar últimas transacciones.
        <br>- Confirmar los depósitos recibidos.
        <br>- Bloquear y desbloquear tu tarjeta
        para mayor seguridad.
        <br>- Activa tu huella digital.
        <br>- Activa tu tarjeta para compras en línea.
      </p>
      <div class="row">
        <div class="col-lg-6">
          <p class="t-marino-2 fw-700 fs-18 text-left">Descarga la App One Card</p>
          <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
            <a href="https://play.google.com/store/apps/details?id=com.oc.onecard" target="_blank" class="p-2">
              <img src="https://onecard.mx/wp-content/uploads/google-store.png" alt="" class="w-100" style="max-width:100px;">
            </a>
            <a href="https://apps.apple.com/mx/app/onecard-ocsi/id961694908" target="_blank" class="p-2">
              <img src="https://onecard.mx/wp-content/uploads/apple-store-1.png" alt="" class="w-100" style="max-width:100px;">
            </a>
            <a href="https://appgallery.huawei.com/app/C107091765" target="_blank" class="p-2">
              <img src="https://onecard.mx/wp-content/uploads/huawei.png" alt="huawei.png" class="w-100" style="max-width:100px;">
            </a>
          </div>
        </div>
        <div class="col-lg-6">
          <p class="t-marino-2 fw-700 fs-18 text-left">Descarga la App GoTRAVEX</p>
          <div class="d-flex align-items-center justify-content-center justify-content-lg-start">
            <a href="https://play.google.com/store/apps/details?id=travex.onecard.mx" target="_blank" class="p-2">
              <img src="https://onecard.mx/wp-content/uploads/google-store.png" alt="" class="w-100" style="max-width:100px;">
            </a>
            <a href="https://apps.apple.com/mx/app/travex/id1283079491" target="_blank" class="p-2">
              <img src="https://onecard.mx/wp-content/uploads/apple-store-1.png" alt="" class="w-100" style="max-width:100px;">
            </a>
            <a href="https://appgallery.huawei.com/app/C107158273" target="_blank" class="p-2">
              <img src="https://onecard.mx/wp-content/uploads/huawei.png" alt="huawei.png" class="w-100" style="max-width:100px;">
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="">
  <div class="bg-marino-gradient">
    <div class="bg-tarjetas">
      <div class=" py-7">
        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <div class="container">
                <div class="row d-flex align-items-center">
                  <div class="col-lg-4 py-4">
                    <p class="fw-700 t-blanco mayusculas fs-40 text-left mb-0">Consulta tu saldo</p>
                  </div>
                  <div class="col-lg-3 text-center">
                    <img src="https://onecard.mx/wp-content/uploads/slide-1-cel.png" alt="" class="w-100 hidden-xs" style="max-width: 417px;">
                    <img src="https://onecard.mx/wp-content/uploads/slide-1-cel.png" alt="" class="w-100 hidden-lg hidden-md hidden-sm" style="max-width: 140px;">
                  </div>
                  <div class="col-lg-5 py-3">
                    <p class="text-left t-blanco fs-500">Consulta disponibilidad de saldo para compras.</p>
                    <p class="text-left t-blanco fs-500">Bloquea / Desbloquea tu tarjeta.</p>
                    <p class="text-left t-blanco fs-500 mb-0">Activa tu tarjeta para compras en línea.</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="container">
                <div class="row d-flex align-items-center">
                  <div class="col-lg-4 py-4">
                    <p class="fw-700 t-blanco mayusculas fs-40 text-left mb-0">Consulta DE MOVIMIENTOS</p>
                  </div>
                  <div class="col-lg-3 text-center">
                    <img src="https://onecard.mx/wp-content/uploads/slide-2-cel.png" alt="" class="w-100 hidden-xs" style="max-width: 417px;">
                    <img src="https://onecard.mx/wp-content/uploads/slide-2-cel.png" alt="" class="w-100 hidden-lg hidden-md hidden-sm" style="max-width: 140px;">
                  </div>
                  <div class="col-lg-5 py-3">
                    <p class="text-left t-blanco fs-500">Consulta movimientos realizados; dentro de cada uno se mostrará el nombre del establecimiento, fecha y hora, así como la cantidad correspondiente.</p>
                    <p class="text-left t-blanco fs-500 mb-0">Recibe una notificación vía email con la información detallada de la compra. </p>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="container">
                <div class="row d-flex align-items-center">
                  <div class="col-lg-4 py-4">
                    <p class="fw-700 t-blanco mayusculas fs-40 text-left mb-0">Consulta tus GASTOS</p>
                  </div>
                  <div class="col-lg-3 text-center">
                    <img src="https://onecard.mx/wp-content/uploads/slide-3-cel.png" alt="" class="w-100 hidden-xs" style="max-width: 417px;">
                    <img src="https://onecard.mx/wp-content/uploads/slide-3-cel.png" alt="" class="w-100 hidden-lg hidden-md hidden-sm" style="max-width: 140px;">
                  </div>
                  <div class="col-lg-5 py-3">
                    <p class="text-left t-blanco fs-500">Identifica los gastos e ingresos ordenados en categorias, simplificando tu día a día y ayudarte a planificar y a tomar decisiones a la hora de controlar todos tus gastos.</p>
                    <p class="text-left t-blanco fs-500 mb-0">Consulta fácilmente tus gastos; elige el periodo a consultar, y revisa de forma rápida y sencilla tus consumos.</p>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="carousel-control-prev" data-target="#carouselExampleControls" data-slide="prev">
            <img src="https://onecard.mx/wp-content/uploads/flecha-saldo-izq.png" alt="" class="pointer" style="max-width: 50px; cursor: pointer;">
          </div>
          <div class="carousel-control-next" data-target="#carouselExampleControls" data-slide="next">
            <img src="https://onecard.mx/wp-content/uploads/flecha-saldo-der.png" alt="" class="pointer" style="max-width: 50px; cursor: pointer;">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container py-7">
  <h2 class="text-left t-marino-2 fw-700 fs-35 pb-4">La App de One Card está llena de beneficios para ti.</h2>
  <p>Si aún no estás registrado:</p>
  <ul>
    <li>Descarga la App.</li>
    <li>Registrate en la aplicación con un correo electrónico y crea una contraseña de seguridad.</li>
    <li>Llena los campos solicitados.</li>
    <li>Recibirás un código de verificación al número que proporcionaste.</li>
    <li>Accede a tu cuenta.</li>
  </ul>
  <div class="pt-2">
    <h2 class="text-left fw-700 fs-35 pb-4">Descarga la guia para registrar o actualizar tus datos</h2>
    <div class="text-left">
      <a href="https://onecard.mx/solucion-app.pdf" target="_blank" class="btn-1">Guia Rapida</a>
      <div class="py-1 hidden-lg hidden-md">
        <br>
      </div>
      <a href="https://www.youtube.com/watch?v=E-0ItlIfFZ8&t=2s" target="_blank" class="btn-1">Video Tutorial</a>
    </div>
  </div>
</div>




</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
