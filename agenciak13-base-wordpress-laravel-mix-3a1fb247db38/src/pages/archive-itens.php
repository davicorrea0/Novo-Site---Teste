<?php
get_header();
?>

<section class="py-5">
    <div class="container">
        <div class="d-flex flex-wrap justify-content-between align-items-end gap-3 mb-4">
            <div>
                <p class="text-secondary text-uppercase small mb-2">Catalogo</p>
                <h1 class="h2 mb-0"><?php post_type_archive_title(); ?></h1>
            </div>
        </div>

        <?php if (have_posts()) : ?>
            <div class="row g-4">
                <?php while (have_posts()) : the_post(); ?>
                    <div class="col-12 col-md-6 col-xl-4">
                        <article <?php post_class('card h-100 border-0 shadow-sm'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <a href="<?php the_permalink(); ?>" class="ratio ratio-4x3">
                                    <?php the_post_thumbnail('large', array('class' => 'object-fit-cover w-100 h-100')); ?>
                                </a>
                            <?php endif; ?>
                            <div class="card-body d-flex flex-column">
                                <h2 class="h5 card-title"><?php the_title(); ?></h2>
                                <p class="card-text text-secondary mb-4"><?php the_excerpt(); ?></p>
                                <a href="<?php the_permalink(); ?>" class="btn btn-dark mt-auto align-self-start">Ver detalhes</a>
                            </div>
                        </article>
                    </div>
                <?php endwhile; ?>
            </div>

            <div class="pt-4">
                <?php
                echo paginate_links(array(
                    'prev_text' => '&laquo;',
                    'next_text' => '&raquo;',
                ));
                ?>
            </div>
        <?php else : ?>
            <div class="alert alert-light border" role="alert">
                Nenhum item encontrado.
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();
?>
