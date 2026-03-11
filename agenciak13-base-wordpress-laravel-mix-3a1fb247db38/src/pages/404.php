<?php
get_header();

$home_url = home_url('/');
$contact_url = home_url('/#contato');
?>

<section class="cb-not-found" tabindex="-1" aria-labelledby="cb-not-found-title">
    <div class="cb-not-found__bg" aria-hidden="true"></div>

    <div class="cb-not-found__container">
        <div class="cb-not-found__eyebrow">
            <span class="cb-not-found__eyebrow-dot" aria-hidden="true"></span>
            <span class="cb-not-found__eyebrow-text">Erro 404</span>
        </div>

        <div class="cb-not-found__grid">
            <div class="cb-not-found__panel cb-not-found__panel--content">
                <div class="cb-not-found__logo" aria-hidden="true">
                    <?php get_template_part('partials/logo-header'); ?>
                </div>

                <p class="cb-not-found__overline">Comtudo Black</p>
                <h1 id="cb-not-found-title" class="cb-not-found__title">Essa pagina saiu do mapa.</h1>
                <p class="cb-not-found__description">
                    O endereco informado nao existe, foi movido ou nao esta mais disponivel. Volte para a home
                    ou fale com nossa equipe para encontrar o que voce procura.
                </p>

                <div class="cb-not-found__actions">
                    <a class="cb-not-found__button cb-not-found__button--primary" href="<?php echo esc_url($home_url); ?>">
                        Voltar para a home
                    </a>
                    <a class="cb-not-found__button cb-not-found__button--ghost" href="<?php echo esc_url($contact_url); ?>">
                        Fale conosco
                    </a>
                </div>
            </div>

            <div class="cb-not-found__panel cb-not-found__panel--status">
                <span class="cb-not-found__status" aria-hidden="true">404</span>
                <p class="cb-not-found__status-label">Colecao nao encontrada</p>
                <p class="cb-not-found__status-copy">
                    Use a navegacao superior para voltar aos segmentos, marcas e contato.
                </p>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
?>
