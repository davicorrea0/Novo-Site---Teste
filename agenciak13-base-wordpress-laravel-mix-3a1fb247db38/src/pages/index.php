<?php get_header(); ?>

<section class="py-5">
    <div class="container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('mb-5'); ?>>
                    <h1 class="h2 mb-3"><?php the_title(); ?></h1>
                    <div class="entry-content"><?php the_content(); ?></div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="alert alert-light border" role="alert">
                Nenhum conteudo encontrado.
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
