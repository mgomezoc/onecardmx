<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package adfactory
 */

get_header();
?>

<div id="primary" class="content-area">
	<main id="main" class="site-main">

		<?php
		while (have_posts()) :
			the_post();

			get_template_part('template-parts/content', get_post_type());
		?>
			<div class="container mt-5 pb-5" style="background:url(https://onecard.mx/wp-content/uploads/bg-tarjetas-inicio-1.png) no-repeat center center fixed; background-size: cover">;
				<div class="row justify-content-center">
					<div class="col-lg-8">
						<!-- 🔹 Navegación entre entradas -->
						<nav class="navigation post-navigation text-center mt-5" aria-label="Navegación de entradas">
							<h2 class="screen-reader-text">Más artículos</h2>
							<div class="nav-links d-flex justify-content-between">
								<div class="nav-previous">
									<?php previous_post_link('%link', '⬅ %title'); ?>
								</div>
								<div class="nav-next">
									<?php next_post_link('%link', '%title ➡'); ?>
								</div>
							</div>
						</nav>
					</div>
				</div>
			</div>
		<?php
			// If comments are open or we have at least one comment, load up the comment template.
			if (comments_open() || get_comments_number()) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
