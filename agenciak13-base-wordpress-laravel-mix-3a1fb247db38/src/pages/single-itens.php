<?php
get_header();
?>

<section class="py-5">
    <div class="container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('mx-auto'); ?> style="max-width: 980px;">
                    <header class="mb-4">
                        <p class="small text-secondary mb-2">
                            <a href="<?php echo esc_url(get_post_type_archive_link('itens')); ?>" class="text-decoration-none">
                                &larr; Voltar para itens
                            </a>
                        </p>
                        <h1 class="h2 mb-0"><?php the_title(); ?></h1>
                    </header>

                    <?php if (has_post_thumbnail()) : ?>
                        <div class="ratio ratio-16x9 rounded overflow-hidden mb-4 shadow-sm">
                            <?php the_post_thumbnail('full', array('class' => 'object-fit-cover w-100 h-100')); ?>
                        </div>
                    <?php endif; ?>

                    <div class="entry-content mb-5">
                        <?php the_content(); ?>
                    </div>
                </article>

                <?php
                $related_query = new WP_Query(array(
                    'post_type' => 'itens',
                    'post_status' => 'publish',
                    'posts_per_page' => 3,
                    'post__not_in' => array(get_the_ID()),
                ));

                if ($related_query->have_posts()) :
                    ?>
                    <div class="mt-5">
                        <h2 class="h4 mb-4">Outros itens</h2>
                        <div class="row g-4">
                            <?php while ($related_query->have_posts()) : $related_query->the_post(); ?>
                                <div class="col-12 col-md-6 col-xl-4">
                                    <article <?php post_class('card h-100 border-0 shadow-sm'); ?>>
                                        <?php if (has_post_thumbnail()) : ?>
                                            <a href="<?php the_permalink(); ?>" class="ratio ratio-4x3">
                                                <?php the_post_thumbnail('large', array('class' => 'object-fit-cover w-100 h-100')); ?>
                                            </a>
                                        <?php endif; ?>
                                        <div class="card-body d-flex flex-column">
                                            <h3 class="h6 card-title"><?php the_title(); ?></h3>
                                            <p class="card-text text-secondary mb-3"><?php the_excerpt(); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="btn btn-outline-dark mt-auto align-self-start btn-sm">Acessar</a>
                                        </div>
                                    </article>
                                </div>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <?php
                endif;
                wp_reset_postdata();
                ?>
            <?php endwhile; ?>
        <?php else : ?>
            <div class="alert alert-light border" role="alert">
                Item não encontrado.
            </div>
        <?php endif; ?>
    </div>
</section>

<?php
get_footer();
?>
