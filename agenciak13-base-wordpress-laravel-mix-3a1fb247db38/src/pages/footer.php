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
    $cb_smart_link = '';
    if (function_exists('get_field') && function_exists('k13_get_home_content_target_page_id')) {
        $cb_home_page_id = (int) k13_get_home_content_target_page_id();
        if ($cb_home_page_id > 0) {
            $cb_smart_link = trim((string) get_field('footer_smart_link', $cb_home_page_id));
        }
    }

    if ($cb_smart_link === '' && function_exists('get_field')) {
        $cb_smart_link = trim((string) get_field('footer_smart_link', 'option'));
    }
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
                            <a<?php if ($cb_footer_link['href'] === '#sobre') : ?> class="cb-footer__link--about"<?php endif; ?> href="<?php echo esc_url($home_anchor_base . $cb_footer_link['href']); ?>">
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
                        <span>Desenvolvimento:</span>
                        <a class="cb-footer__design-logo cb-footer__design-logo--k13" href="https://k13.com.br/" target="_blank" rel="noopener noreferrer" aria-label="Acessar o site da K13">
                            <svg width="59" height="16" viewBox="0 0 59 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M27.5836 15.895H32.9844V0.000976562H23.2988L26.5911 4.12565H27.5836V15.895Z" fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M51.2001 5.82955C50.7974 5.94501 50.3803 6.00326 49.9613 6.00259H39.4742L42.9825 10.1151H49.9604C50.4952 10.1154 51.0287 10.1692 51.5529 10.2757C52.3007 10.4237 52.6812 10.6584 52.6812 10.9552C52.6812 11.2642 52.3008 11.4985 51.5529 11.6469C51.0282 11.7489 50.4948 11.7983 49.9604 11.7945H34.264L37.7742 15.895H49.4191C50.9361 15.9105 52.4462 15.6896 53.8952 15.2404C55.4184 14.7339 56.5469 14.0057 57.2958 13.0544C57.798 12.4542 58.0807 11.7008 58.0973 10.9184C58.0973 9.85545 57.5809 8.90504 56.5336 8.0526C57.5809 7.16319 58.0973 6.18781 58.0973 5.10164C58.0834 4.30353 57.8011 3.53338 57.2958 2.91541C56.5471 1.9514 55.4184 1.19884 53.8952 0.692504C52.4515 0.216786 50.9391 -0.0168857 49.4191 0.000948934H34.2637L37.7741 4.12562H49.9613C50.3805 4.12282 50.7978 4.18112 51.2001 4.29867C51.7305 4.4714 52.0025 4.71857 52.0025 5.05139C52.0025 5.39716 51.7305 5.64417 51.2001 5.82955Z" fill="white"/>
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M22.009 0.000488281H13.8343L5.42687 5.44648V0.000488281H0V15.8949H5.42687V10.5838L13.8343 15.8949H22.0912L9.50841 8.07695L22.009 0.000488281Z" fill="white"/>
                            </svg>
                        </a>
                        <span>&amp; Design:</span>
                        <?php if ($cb_smart_link !== '') : ?>
                            <a class="cb-footer__design-logo cb-footer__design-logo--smart" href="<?php echo esc_url($cb_smart_link); ?>" target="_blank" rel="noopener noreferrer" aria-label="Acessar o site da Smart">
                                <?php get_template_part('partials/logo-smart'); ?>
                            </a>
                        <?php else : ?>
                            <span class="cb-footer__design-logo cb-footer__design-logo--smart" role="img" aria-label="SMART">
                                <?php get_template_part('partials/logo-smart'); ?>
                            </span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <?php get_template_part('partials/cookie-consent'); ?>

    <?php wp_footer(); ?>
</body>
</html>
