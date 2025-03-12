<?php
/**
 * The template for displaying all pages
 *
 * Template Name: Blog
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

      <div class="bg-oscuro min-vh-30 d-flex align-items-center">
        <div class="container">
          <div class="h-500 d-flex align-items-center">
            <div class="text-center pt-6 w-100">
              <h1 class="t-blanco fw-700">TÍTULO H1</h1>
            </div>
          </div>
        </div>
      </div>

      <div class="container py-7">
        <div class="row">
          <?php
             query_posts(array('orderby' => 'asc', ));
             if (have_posts()) :
             while (have_posts()) : the_post(); ?>
             <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 my-3" data-aos="fade-up">

                <div class="card-blog shadow">

                   <?php the_post_thumbnail('medium_large'); ?>
                   <div class="contenido">
                     <h3 class="titulo-card"><a href="<?php the_permalink() ?>" class="stretched-link"><?php the_title(); ?></a></h3>
                     <div class="extracto-blog">
                        <?php the_excerpt(); ?>
                     </div>
                   </div>
                </div>
             </div>
             <?php endwhile;
          endif; ?>
        </div>
      </div>



		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
