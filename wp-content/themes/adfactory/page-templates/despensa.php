<?php

/**
 * Template Name: Despensa
 *
 * Página personalizada para mostrar información sobre la tarjeta de vales de despensa.
 *
 * @package adfactory
 */

get_header();
?>

<div id="primary" class="content-area">
  <main id="main" class="site-main">

    <div class="bg-header despensa min-vh-30 d-flex align-items-center">
      <div class="container-fluid">
        <div class="row h-600 d-flex align-items-start py-6">
          <div class="col-lg-12 text-center pt-8 pb-5">
            <img src="https://onecard.mx/wp-content/uploads/logo.png" alt="Logo OneCard" class="pt-5 mw-250 d-none d-md-inline-block" loading="lazy" data-aos="fade-up">
          </div>
          <div class="col-lg-12">
            <div class="row">
              <div class="col-lg-6">
                <div class="w-75 mx-auto">
                  <h1 class="titulo-landing">Tarjeta de Vales de Despensa One Card</h1>
                  <p class="texto-landing">La solución ideal para empresas que buscan ofrecer prestaciones inteligentes y deducibles. Aceptada en todo México y autorizada por el SAT.</p>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="bg-oscuro p-4">
                  <?php echo do_shortcode('[contact-form-7 id="447" title="Nuevo formulario de contacto"]'); ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-oscuro">
      <div class="container py-7 text-center">
        <h2 class="t-blanco fw-500 fs-35 pb-4" data-aos="fade-up">La Mejor Tarjeta de Vales de Despensa para Empresas</h2>
        <p class="t-blanco pb-4" data-aos="fade-up"> Nuestra tarjeta de vales de despensa cumple con todas las disposiciones fiscales, permitiéndote:</p>
        <div class="row">
          <?php
          $beneficios = [
            ['icono-despensa-1.png', 'Beneficios Fiscales', 'Deducible de impuestos hasta el tope permitido por la ley.'],
            ['icono-despensa-2.png', 'Control en la dispersión', 'Define cuánto y cuándo depositar, sin depender de horarios bancarios.'],
            ['icono-despensa-3.png', 'Reduce tiempos administrativos', 'Software automatizado que hace la dispersión más rápida y eficiente.'],
            ['icono-despensa-4.png', 'Reportes en tiempo real', 'Sistema en línea 24/7 con reportes de actividad en tiempo real.'],
            ['icono-despensa-5.png', 'Cumple con la Reforma Fiscal', 'Cumple con todas las disposiciones fiscales solicitadas por el SAT.'],
            ['icono-despensa-6.png', 'Soporte a clientes', 'Nuestro equipo está disponible para ayudarte con cualquier duda.'],
          ];
          foreach ($beneficios as $b) {
            echo '
            <div class="col-lg-4 col-md-4 col-sm-6 py-4 text-center">
              <img src="https://onecard.mx/wp-content/uploads/' . esc_attr($b[0]) . '" alt="' . esc_attr($b[1]) . '" class="rounded-circle bg-celeste-1 mw-75" loading="lazy" data-aos="fade-up">
              <h5 class="fw-500 fs-17 t-celeste-1 mb-0 pt-2" data-aos="fade-up">' . esc_html($b[1]) . '</h5>
              <p class="t-blanco mb-0" data-aos="fade-up">' . esc_html($b[2]) . '</p>
            </div>';
          }
          ?>
        </div>
      </div>
    </div>

    <div class="bg-marino d-none">
      <div class="container">
        <div class="row d-flex align-items-center">
          <div class="col-lg-3 text-center">
            <div class="py-3">
              <img src="https://onecard.mx/wp-content/uploads/tarjeta-despensa-landing.png" alt="Tarjeta de despensa" loading="lazy" data-aos="fade-right">
            </div>
          </div>
          <div class="col-lg-6 text-start">
            <div class="py-4">
              <h3 class="t-blanco fw-700 mb-0 fs-25" data-aos="fade">Solicita una cotización</h3>
              <span class="t-blanco fw-300 mb-0 fs-20" data-aos="fade">Por tiempo limitado recibe una promoción en cotizaciones por internet.</span>
            </div>
          </div>
          <div class="col-lg-3 text-center">
            <div class="py-5" data-aos="fade">
              <a href="#" class="btn-3 relative" data-bs-toggle="modal" data-bs-target=".formulario-modal">SOLICITAR</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="bg-blanco">
      <div class="container pt-7 text-center">
        <div class="p-4">
          <p class="fs-22 fw-600">Los vales de despensa para empleados son la mejor forma de optimizar la administración de beneficios en tu empresa. Con una tarjeta de vales de despensa, garantizas un pago seguro, ágil y aceptado en miles de establecimientos en México, además de obtener beneficios fiscales.</p>
        </div>

        <h2 class="fw-700 fs-35 t-marino-2 py-5" data-aos="fade-up">La tarjeta de vales de despensa más segura y<br class="d-none d-md-inline-block"> certificada por el SAT</h2>

        <div class="row d-flex align-items-end">
          <div class="col-lg-4">
            <img src="https://onecard.mx/wp-content/uploads/movil-inicio.png" alt="App móvil OneCard" class="neg-bot-80" loading="lazy" data-aos="fade-up">
          </div>
          <div class="col-lg-6 text-start">
            <?php
            $ventajas = [
              'Máxima seguridad en tus transacciones.',
              'Certificados por el SAT.',
              'De fácil manejo para tus usuarios.',
              'Aplicación móvil gratuita para consulta de saldos.',
              'Bloquea y desbloquea tu tarjeta desde el app móvil.',
              'Medio de pago de amplia aceptación en México.',
              'Deducible como prestación empresarial.',
            ];

            foreach ($ventajas as $v) {
              echo '
              <p class="fs-18" data-aos="fade-up">
                <img src="https://onecard.mx/wp-content/uploads/check.png" class="rounded-circle bg-marino-2 me-1 d-none d-md-inline-block" alt="Ícono check" loading="lazy"> ' . esc_html($v) . '
              </p>';
            }
            ?>
          </div>
          <div class="col-lg-2 d-none d-lg-block">
            <img src="https://onecard.mx/wp-content/uploads/carrito-tienda.png" alt="Ícono tienda" class="neg-bot-80" loading="lazy" data-aos="fade-up">
          </div>
        </div>
      </div>
    </div>

    <div class="bg-celeste-1">
      <div class="container py-3">
        <div class="row d-flex align-items-center">
          <div class="col-lg-4"></div>
          <div class="col-lg-4 text-start">
            <h3 class="fw-500 fs-20 t-blanco mb-0" data-aos="fade-up">Administra tus vales de despensa y monederos electrónicos</h3>
            <p class="t-blanco fw-300 fs-20 mb-0" data-aos="fade-up">Desde nuestra app móvil.</p>
          </div>
          <div class="col-lg-2 text-center py-3 d-none d-md-block" data-aos="fade-up">
            <!-- <a href="#" class="btn-3">DESCARGA</a> -->
          </div>
          <div class="col"></div>
        </div>
      </div>
    </div>
  </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>