<?php
get_header();
?>

<section class="py-5" tabindex="-1">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-8 text-center">
                <p class="display-6 fw-bold mb-2">404</p>
                <h1 class="h2 mb-3">Página não encontrada</h1>
                <p class="text-secondary mb-4">A URL informada não existe ou foi movida.</p>
                <a class="btn btn-dark" href="<?php echo esc_url(home_url('/')); ?>">Voltar para a página inicial</a>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>
