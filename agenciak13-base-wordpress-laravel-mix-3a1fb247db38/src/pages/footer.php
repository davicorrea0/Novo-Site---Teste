    </main>

    <?php
    $home_anchor_base = is_front_page() ? '' : home_url('/');
    $cb_footer_links = array(
        array(
            'label' => 'SOBRE NÓS',
            'href'  => '#sobre',
        ),
        array(
            'label' => 'SEGMENTOS',
            'href'  => '#segmentos',
        ),
        array(
            'label' => 'MARCAS',
            'href'  => '#marcas',
        ),
        array(
            'label' => 'ONDE ESTAMOS',
            'href'  => '#localizacao',
        ),
        array(
            'label' => 'FALE CONOSCO',
            'href'  => '#contato',
        ),
    );
    ?>

    <footer class="cb-footer">
        <div class="cb-footer__container">
            <div class="cb-footer__content">
                <div class="cb-footer__top">
                    <a class="cb-footer__logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php esc_attr_e('Página inicial', 'comtudo-black'); ?>">
                        <?php get_template_part('partials/logo-footer'); ?>
                    </a>

                    <nav class="cb-footer__nav" aria-label="<?php esc_attr_e('Navegação do rodapé', 'comtudo-black'); ?>">
                        <?php foreach ($cb_footer_links as $cb_footer_link) : ?>
                            <a href="<?php echo esc_url($home_anchor_base . $cb_footer_link['href']); ?>">
                                <?php echo esc_html($cb_footer_link['label']); ?>
                            </a>
                        <?php endforeach; ?>
                        <button class="cb-footer__grid-btn" type="button" aria-label="<?php esc_attr_e('Abrir menu rápido', 'comtudo-black'); ?>">
                            <svg width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 3.56293H3.56321V0H0V3.56293Z" fill="currentColor"/>
                                <path d="M7.35239 3.56293H10.9156V0H7.35239V3.56293Z" fill="currentColor"/>
                                <path d="M14.7048 0V3.56293H18.268V0H14.7048Z" fill="currentColor"/>
                                <path d="M0 11.0154H3.56321V7.45181H0V11.0154Z" fill="currentColor"/>
                                <path d="M7.35239 11.0154H10.9156V7.45181H7.35239V11.0154Z" fill="currentColor"/>
                                <path d="M14.7048 11.0154H18.268V7.45181H14.7048V11.0154Z" fill="currentColor"/>
                                <path d="M0 18.4672H3.56321V14.9042H0V18.4672Z" fill="currentColor"/>
                                <path d="M7.35239 18.4672H10.9156V14.9042H7.35239V18.4672Z" fill="currentColor"/>
                                <path d="M14.7048 18.4672H18.268V14.9042H14.7048V18.4672Z" fill="currentColor"/>
                            </svg>
                        </button>
                    </nav>
                </div>

                <div class="cb-footer__bottom">
                    <p class="cb-footer__copyright">
                        COMTUDO BLACK &copy; <?php echo esc_html(date('Y')); ?> &bull; Todos os direitos reservados
                    </p>
                    <div class="cb-footer__design">
                        <span>Design:</span>
                        <strong>SMART</strong>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <?php get_template_part('partials/cookie-consent'); ?>

    <?php wp_footer(); ?>
</body>
</html>
