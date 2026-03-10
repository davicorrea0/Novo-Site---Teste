<?php

function do_header()
{
    $theme_url = get_template_directory_uri();

    // Generate favicon includes
    if ($iconUrl = get_site_icon_url()) {
        $apple = [57, 60, 72, 76, 114, 120, 144, 152, 180];
        $icons = [192, 32, 96, 16];
        foreach ($apple as $iconSize)
            ?><link rel="apple-touch-icon" sizes="<?= "{$iconSize}x{$iconSize}" ?>" href="<?= optimize_media($iconUrl, $iconSize) ?>"><?php
        foreach ($icons as $iconSize)
        ?><link rel="apple-touch-icon" sizes="<?=  "{$iconSize}x{$iconSize}"  ?>" href="<?= optimize_media($iconUrl, $iconSize) ?>"><?php
            ?><meta name="msapplication-TileImage" content="<?= optimize_media($iconUrl, 144) ?>"><?php
    }
    ?><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"><?php
    ?><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"><?php
    ?><link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/plyr@3.8.4/dist/plyr.css"><?php
    ?><link rel="stylesheet" type="text/css" href="<?= esc_url($theme_url . mix('/assets/css/style.min.css')) ?>"><?php
    if (function_exists('get_field')) {
        echo get_field('scripts_header', 'options');
    }
}

add_action('wp_head', 'do_header');
