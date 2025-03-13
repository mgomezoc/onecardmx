<?php

/**
 * Template part for displaying posts
 *
 * @package adfactory
 */
?>

<div class="container mt-5" style="background:url(https://onecard.mx/wp-content/uploads/bg-tarjetas-inicio-1.png) no-repeat center center fixed; background-size: cover">;
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<article id="post-<?php the_ID(); ?>" <?php post_class('card border-0 shadow-sm mb-5'); ?>>
				<?php if (has_post_thumbnail()) : ?>
					<img class="card-img-top rounded-3" src="<?php the_post_thumbnail_url('large'); ?>" alt="<?php the_title(); ?>">
				<?php endif; ?>

				<div class="card-body">
					<header class="entry-header mb-3 bg-white" style="box-shadow: none;">
						<h1 class="entry-title fw-bold text-dark">
							<?php the_title(); ?>
						</h1>
						<div class="entry-meta text-muted small">
							📅 <?php echo get_the_date(); ?> | ✍️ <?php the_author(); ?>
						</div>
					</header><!-- .entry-header -->

					<div class="entry-content">
						<?php the_content(); ?> <!-- 🔹 Muestra todo el contenido completo del post -->
					</div><!-- .entry-content -->
				</div>
			</article>
		</div>
	</div>
</div>