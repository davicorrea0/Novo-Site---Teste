<?php
$cb_privacy_policy_url = function_exists('get_privacy_policy_url') ? get_privacy_policy_url() : '';
?>

<div
    id="cb-cookie-consent"
    class="cb-cookie-consent"
    hidden
    aria-hidden="true"
    role="dialog"
    aria-modal="false"
    aria-label="<?php esc_attr_e('Privacidade e cookies', 'comtudo-black'); ?>"
>
    <div class="cb-cookie-consent__panel">
        <div class="cb-cookie-consent__header">
            <div class="cb-cookie-consent__title-wrap">
                <span class="cb-cookie-consent__icon" aria-hidden="true">
                    <svg viewBox="0 0 24 24" fill="none">
                        <path d="M19 14.5C19 18.09 16.09 21 12.5 21C8.91 21 6 18.09 6 14.5C6 10.91 8.91 8 12.5 8C12.78 8 13.05 8.02 13.31 8.05C12.49 6.9 12 5.49 12 4C12 3.66 12.03 3.33 12.08 3C16.01 3.21 19 6.46 19 10.45V14.5Z" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M10.1 12.4C10.54 12.4 10.9 12.04 10.9 11.6C10.9 11.16 10.54 10.8 10.1 10.8C9.66 10.8 9.3 11.16 9.3 11.6C9.3 12.04 9.66 12.4 10.1 12.4Z" fill="currentColor"/>
                        <path d="M15.5 14.3C15.89 14.3 16.2 13.99 16.2 13.6C16.2 13.21 15.89 12.9 15.5 12.9C15.11 12.9 14.8 13.21 14.8 13.6C14.8 13.99 15.11 14.3 15.5 14.3Z" fill="currentColor"/>
                        <path d="M12.4 17.5C12.79 17.5 13.1 17.19 13.1 16.8C13.1 16.41 12.79 16.1 12.4 16.1C12.01 16.1 11.7 16.41 11.7 16.8C11.7 17.19 12.01 17.5 12.4 17.5Z" fill="currentColor"/>
                    </svg>
                </span>

                <h2 class="cb-cookie-consent__title">
                    <?php esc_html_e('Privacidade e Cookies', 'comtudo-black'); ?>
                </h2>
            </div>

            <button
                class="cb-cookie-consent__close"
                type="button"
                data-cookie-consent-action="decline"
                aria-label="<?php esc_attr_e('Fechar aviso de cookies', 'comtudo-black'); ?>"
            >
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
        </div>

        <p class="cb-cookie-consent__text">
            <?php if (!empty($cb_privacy_policy_url)) : ?>
                <?php
                printf(
                    wp_kses(
                        __(
                            'Utilizamos cookies para melhorar sua experiência, personalizar conteúdo e analisar nosso tráfego. Ao continuar navegando, você concorda com a nossa <a href="%s">política de privacidade</a> (LGPD).',
                            'comtudo-black'
                        ),
                        array(
                            'a' => array(
                                'href' => array(),
                            ),
                        )
                    ),
                    esc_url($cb_privacy_policy_url)
                );
                ?>
            <?php else : ?>
                <?php esc_html_e('Utilizamos cookies para melhorar sua experiência, personalizar conteúdo e analisar nosso tráfego. Ao continuar navegando, você concorda com a nossa política de privacidade (LGPD).', 'comtudo-black'); ?>
            <?php endif; ?>
        </p>

        <div class="cb-cookie-consent__actions">
            <button
                class="cb-cookie-consent__button cb-cookie-consent__button--primary"
                type="button"
                data-cookie-consent-action="accept"
            >
                <?php esc_html_e('Aceitar Todos', 'comtudo-black'); ?>
            </button>

            <button
                class="cb-cookie-consent__button cb-cookie-consent__button--secondary"
                type="button"
                data-cookie-consent-action="decline"
            >
                <?php esc_html_e('Recusar', 'comtudo-black'); ?>
            </button>
        </div>
    </div>
</div>
