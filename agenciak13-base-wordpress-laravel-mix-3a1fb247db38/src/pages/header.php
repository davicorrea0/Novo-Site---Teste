<!doctype html>
<html lang="pt-BR">
<head>
    <?php get_template_part('head'); ?>
</head>
<body <?php body_class(is_front_page() ? 'cb-loading' : ''); ?>>
<?php wp_body_open(); ?>
<?php if (is_front_page()) : ?>
<div id="cb-loader" class="cb-loader" aria-hidden="true">
    <div class="cb-loader__inner">
        <div class="cb-loader__radial-wrap" aria-hidden="true">
            <svg id="cb-loader-radial" class="cb-loader__radial loader-svg" viewBox="0 0 1920 1080" xmlns="http://www.w3.org/2000/svg">
                <?php get_template_part('partials/loader-radial-paths'); ?>
            </svg>
        </div>
        <div class="cb-loader__center">
            <div class="cb-loader__logo">
                <?php get_template_part('partials/logo-header'); ?>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php
$home_anchor_base = is_front_page() ? '' : home_url('/');
$cb_nav_links = array(
    array(
        'label' => 'Sobre Nós',
        'href'  => '#sobre',
    ),
    array(
        'label' => 'Segmentos',
        'href'  => '#segmentos',
    ),
    array(
        'label' => 'Marcas',
        'href'  => '#marcas',
    ),
    array(
        'label' => 'Onde Estamos',
        'href'  => '#localizacao',
    ),
    array(
        'label' => 'Fale Conosco',
        'href'  => '#contato',
    ),
);
?>

<header id="cb-header" class="cb-header<?php echo is_front_page() ? ' cb-header--pending' : ''; ?>">
    <div class="cb-header__inner">
        <a class="cb-logo" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php esc_attr_e('Página inicial', 'comtudo-black'); ?>">
            <?php get_template_part('partials/logo-header'); ?>
        </a>

        <nav class="cb-nav-pill" aria-label="<?php esc_attr_e('Navegação principal', 'comtudo-black'); ?>">
            <div class="cb-nav-pill__links">
                <?php foreach ($cb_nav_links as $cb_nav_link) : ?>
                    <a
                        class="cb-nav-pill__link<?php echo $cb_nav_link['href'] === '#sobre' ? ' cb-nav-pill__link--about' : ''; ?>"
                        href="<?php echo esc_url($home_anchor_base . $cb_nav_link['href']); ?>"
                    >
                        <?php echo esc_html($cb_nav_link['label']); ?>
                    </a>
                <?php endforeach; ?>
            </div>

            <button
                id="cb-menu-toggle"
                class="cb-nav-pill__toggle"
                type="button"
                aria-expanded="false"
                aria-controls="cb-mobile-menu"
                aria-label="<?php esc_attr_e('Abrir menu', 'comtudo-black'); ?>"
            >
                <span class="cb-icon-grid" aria-hidden="true">
                    <svg viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
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
                </span>
                <span class="cb-icon-close" aria-hidden="true">&times;</span>
            </button>
        </nav>
    </div>
</header>

<div id="cb-mobile-menu" class="cb-mobile-menu" aria-hidden="true">
    <?php foreach ($cb_nav_links as $cb_nav_link) : ?>
        <a
            class="cb-mobile-menu__link<?php echo $cb_nav_link['href'] === '#sobre' ? ' cb-mobile-menu__link--about' : ''; ?>"
            href="<?php echo esc_url($home_anchor_base . $cb_nav_link['href']); ?>"
            onclick="closeMobileMenu()"
        >
            <?php echo esc_html($cb_nav_link['label']); ?>
        </a>
    <?php endforeach; ?>
</div>

<main id="site-content">
