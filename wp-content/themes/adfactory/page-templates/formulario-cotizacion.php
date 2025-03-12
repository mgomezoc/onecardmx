<?php

/**
 * The template for displaying the Cotización page
 *
 * Template Name: Formulario Cotizacion
 *
 * This is the template used for the Cotización page.
 * You can customize it as needed to include the specific content
 * and layout for this page.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package adfactory
 */

get_header();
?>

<div class="banner mt-4">
    <div class="banner-body">
        <div class="banner-titulo">
            Este formulario es una solicitud de cotización o compra.
        </div>
        <div class="banner-text">
            ¡No es un trámite para tarjetas de crédito, no es ayuda de Gobierno,
            no otorgamos préstamos personales!
        </div>
    </div>
</div>

<div class="bg-contacto-inicio">
    <div class="container text-center py-7">
        <h3 class="titulo-contacto fw-700 fs-35 pb-4 text-white" data-aos="fade-up">Solicita más información</h3>
        <p class="t-contacto text-white" data-aos="fade-up">Registra tus datos y un agente comercial <br class="hidden-xs">se comunicará a la brevedad para atender tu necesidad.</p>
        <div class="contact-form container formulario-footer" data-aos="fade-up">
            <?php echo do_shortcode('[contact-form-7 id="447" title="Nuevo formulario de contacto"]'); ?>
        </div>
    </div>
</div>