<?php
get_header();
?>

<section class="py-5">
    <div class="container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('mx-auto'); ?> style="max-width: 860px;">
                    <header class="mb-4">
                        <h1 class="h2 mb-0"><?php the_title(); ?></h1>
                    </header>

                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                </article>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="alert alert-light border" role="alert">
                Nenhum conteudo encontrado.
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();
?>
