<?php

function cb_theme_favicon_asset_url($filename)
{
    $relative_path = 'assets/imgs/favicon/' . ltrim($filename, '/');
    $absolute_path = trailingslashit(get_template_directory()) . $relative_path;

    if (!file_exists($absolute_path)) {
        return '';
    }

    return trailingslashit(get_template_directory_uri()) . $relative_path;
}

function cb_render_favicon_tags()
{
    $site_icon_url = get_site_icon_url();

    if ($site_icon_url) {
        $apple_icon = function_exists('optimize_media') ? optimize_media($site_icon_url, 180) : $site_icon_url;
        $icon_32 = function_exists('optimize_media') ? optimize_media($site_icon_url, 32) : $site_icon_url;
        $icon_192 = function_exists('optimize_media') ? optimize_media($site_icon_url, 192) : $site_icon_url;
        $tile_icon = function_exists('optimize_media') ? optimize_media($site_icon_url, 144) : $site_icon_url;

        ?>
        <link rel="apple-touch-icon" sizes="180x180" href="<?= esc_url($apple_icon) ?>">
        <link rel="icon" type="image/png" sizes="32x32" href="<?= esc_url($icon_32) ?>">
        <link rel="icon" type="image/png" sizes="192x192" href="<?= esc_url($icon_192) ?>">
        <meta name="msapplication-TileImage" content="<?= esc_url($tile_icon) ?>">
        <meta name="msapplication-TileColor" content="#1a1a1a">
        <meta name="theme-color" content="#1a1a1a">
        <?php

        return;
    }

    $theme_icons = array(
        'svg'      => cb_theme_favicon_asset_url('favicon.svg'),
        'apple'    => cb_theme_favicon_asset_url('apple-touch-icon.png'),
        'icon_32'  => cb_theme_favicon_asset_url('favicon-32x32.png'),
        'icon_16'  => cb_theme_favicon_asset_url('favicon-16x16.png'),
        'android'  => cb_theme_favicon_asset_url('android-icon-192x192.png'),
        'manifest' => cb_theme_favicon_asset_url('manifest.json'),
        'mstile'   => cb_theme_favicon_asset_url('ms-icon-144x144.png'),
    );

    if (!array_filter($theme_icons)) {
        return;
    }

    if ($theme_icons['svg']) {
        ?><link rel="icon" type="image/svg+xml" href="<?= esc_url($theme_icons['svg']) ?>"><?php
    }

    if ($theme_icons['apple']) {
        ?><link rel="apple-touch-icon" sizes="180x180" href="<?= esc_url($theme_icons['apple']) ?>"><?php
    }

    if ($theme_icons['icon_32']) {
        ?><link rel="icon" type="image/png" sizes="32x32" href="<?= esc_url($theme_icons['icon_32']) ?>"><?php
    }

    if ($theme_icons['icon_16']) {
        ?><link rel="icon" type="image/png" sizes="16x16" href="<?= esc_url($theme_icons['icon_16']) ?>"><?php
    }

    if ($theme_icons['android']) {
        ?><link rel="icon" type="image/png" sizes="192x192" href="<?= esc_url($theme_icons['android']) ?>"><?php
    }

    if ($theme_icons['manifest']) {
        ?><link rel="manifest" href="<?= esc_url($theme_icons['manifest']) ?>"><?php
    }

    if ($theme_icons['mstile']) {
        ?><meta name="msapplication-TileImage" content="<?= esc_url($theme_icons['mstile']) ?>"><?php
    }

    ?><meta name="msapplication-TileColor" content="#1a1a1a"><?php
    ?><meta name="theme-color" content="#1a1a1a"><?php
}

function do_header()
{
    $theme_url = get_template_directory_uri();

    cb_render_favicon_tags();
    ?><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"><?php
    ?><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"><?php
    ?><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/plyr@3.8.4/dist/plyr.css"><?php
    ?><link rel="stylesheet" type="text/css" href="<?= esc_url($theme_url . mix('/assets/css/style.min.css')) ?>"><?php
    if (function_exists('get_field')) {
        echo get_field('scripts_header', 'options');
    }
}

add_action('wp_head', 'do_header');
