<?php

/**
 * Excerpt padrao para cards/listagens.
 */
function k13_excerpt_length($length)
{
    return 22;
}
add_filter('excerpt_length', 'k13_excerpt_length', 999);

function k13_excerpt_more($more)
{
    return '...';
}
add_filter('excerpt_more', 'k13_excerpt_more');
