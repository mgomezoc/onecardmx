<?php

/**
 * Template for displaying the blog page
 *
 * @package adfactory
 */

get_header();
?>

<div class="container mt-5">
    <h1 class="text-center fw-bold">Últimas Publicaciones</h1>
    <div class="row">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <div class="col-md-6 col-lg-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if (has_post_thumbnail()) : ?>
                            <a href="<?php the_permalink(); ?>">
                                <img class="card-img-top" src="<?php the_post_thumbnail_url('medium'); ?>" alt="<?php the_title(); ?>">
                            </a>
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?php the_permalink(); ?>" class="text-dark">
                                    <?php the_title(); ?>
                                </a>
                            </h5>
                            <p class="card-text text-muted">
                                📅 <?php echo get_the_date(); ?> | ✍️ <?php the_author(); ?>
                            </p>
                            <p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 20, '...'); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">Leer más</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else : ?>
            <p class="text-center">No hay publicaciones disponibles.</p>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
