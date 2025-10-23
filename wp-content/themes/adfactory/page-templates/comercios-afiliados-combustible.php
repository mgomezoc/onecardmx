<?php

/**
 * The template for displaying all pages
 *
 * Template Name: Comercios afiliados combustible
 *
 * @package adfactory
 */

get_header();
?>

<!-- Mapbox GL CSS -->
<link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">

<div class="bg-marino-gradient">
  <div class="container py-7 text-center">
    <h1 class="entry-title pt-7 t-blanco fw-700" data-aos="fade-up">Comercios afiliados</h1>
  </div>
</div>

<div class="container py-7 text-center">
  <h2>La tarjeta de combustible es aceptada en más de 33,000 estaciones de servicio a nivel nacional.</h2>
  <img src="https://onecard.mx/wp-content/uploads/comercios-combusible.png" class="w-100 py-6" alt="">
  <h2 class="fw-700 fs-40">Selecciona el Estado en el mapa y descarga la lista de comercios afiliados.</h2>
</div>

<!-- Mapa Interactivo con Mapbox -->
<div class="container pb-7">
  <div class="row">
    <div class="col-lg-12">
      <div class="mapa-mexico-container-mapbox" data-aos="fade-up">

        <!-- Buscador de estados -->
        <div class="estado-search-container mb-4">
          <input type="text" id="estadoSearchMapbox" class="form-control form-control-lg" placeholder="🔍 Buscar estado...">
        </div>

        <!-- Contenedor del mapa Mapbox -->
        <div id="mapbox-container" style="position: relative;">
          <div id="map" style="width: 100%; height: 600px; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.15);"></div>

          <!-- Controles personalizados -->
          <div class="map-controls">
            <button id="resetView" class="btn btn-success btn-sm mb-2">
              <i class="fas fa-home"></i> Vista General
            </button>
          </div>
        </div>

        <!-- Panel de información -->
        <div id="info-panel-mapbox" class="info-panel-mapbox mt-4" style="display: none;">
          <div class="card shadow-lg border-0">
            <div class="card-body p-4">
              <h3 class="card-title t-verde fw-700 mb-3">
                <i class="fas fa-map-marker-alt"></i>
                <span id="panel-estado-nombre"></span>
              </h3>
              <div class="info-details">
                <p class="mb-2">
                  <strong>Estaciones disponibles:</strong>
                  <span id="panel-estaciones" class="badge bg-success ms-2"></span>
                </p>
                <p class="mb-3">
                  <i class="fas fa-gas-pump me-2 t-verde"></i>
                  <span id="panel-descripcion"></span>
                </p>
              </div>
              <a href="#" id="panel-download-link" class="btn btn-success btn-lg w-100" target="_blank">
                <i class="fas fa-download me-2"></i>
                Descargar Lista de Comercios
              </a>
            </div>
          </div>
        </div>

        <!-- Lista de estados para referencia rápida -->
        <div class="estados-grid mt-5">
          <h3 class="text-center fw-700 mb-4">O selecciona directamente:</h3>
          <div class="row g-3" id="estados-buttons">
            <!-- Los botones se generarán dinámicamente con JavaScript -->
          </div>
        </div>

      </div>
    </div>
  </div>
</div>

<!-- Información adicional -->
<div class="bg-gris-claro py-6">
  <div class="container">
    <div class="row text-center">
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="100">
        <div class="info-box p-4">
          <i class="fas fa-file-excel fa-3x t-verde mb-3"></i>
          <h4 class="fw-700">Archivos Excel</h4>
          <p>Descarga listas detalladas con direcciones y contactos de cada estación</p>
        </div>
      </div>
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="200">
        <div class="info-box p-4">
          <i class="fas fa-map-marked-alt fa-3x t-verde mb-3"></i>
          <h4 class="fw-700">Cobertura Nacional</h4>
          <p>Más de 33,000 estaciones en todos los estados de la República Mexicana</p>
        </div>
      </div>
      <div class="col-md-4 mb-4" data-aos="fade-up" data-aos-delay="300">
        <div class="info-box p-4">
          <i class="fas fa-sync-alt fa-3x t-verde mb-3"></i>
          <h4 class="fw-700">Actualización Constante</h4>
          <p>Información actualizada mensualmente para tu comodidad</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Mapbox GL JS -->
<script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>

<!-- Script del mapa con Mapbox -->
<script src="<?php echo get_template_directory_uri(); ?>/js/mapa-mapbox-combustible.js"></script>

<style>
  /* Estilos adicionales para Mapbox */
  .mapa-mexico-container-mapbox {
    max-width: 1200px;
    margin: 0 auto;
  }

  .map-controls {
    position: absolute;
    top: 10px;
    right: 10px;
    z-index: 1;
  }

  .info-panel-mapbox {
    animation: slideUp 0.5s ease;
  }

  @keyframes slideUp {
    from {
      opacity: 0;
      transform: translateY(20px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  .estados-grid .btn {
    font-size: 14px;
    padding: 10px;
    border-radius: 8px;
    transition: all 0.3s ease;
  }

  .estados-grid .btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 5px 15px rgba(93, 155, 61, 0.3);
  }

  .mapboxgl-popup-content {
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
  }

  .mapboxgl-popup-close-button {
    font-size: 20px;
    padding: 5px 10px;
  }

  /* Responsive */
  @media (max-width: 768px) {
    #map {
      height: 400px !important;
    }

    .estados-grid .col {
      flex: 0 0 100%;
      max-width: 100%;
    }
  }

  .bg-gris-claro {
    background: linear-gradient(135deg, #f5f5f5 0%, #e8f5e9 100%);
  }

  .info-box {
    background: white;
    border-radius: 15px;
    transition: all 0.3s ease;
    height: 100%;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
  }

  .info-box:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 35px rgba(93, 155, 61, 0.2);
  }

  .t-verde {
    color: #5d9b3d !important;
  }
</style>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    $(".banner").addClass("combustible");
  });
</script>

<?php get_footer(); ?>