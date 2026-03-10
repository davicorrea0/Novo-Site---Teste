<?php

/**
 * Ajusta a query principal para arquivos de CPT.
 */
function k13_customize_main_queries($query)
{
    if (is_admin() || !$query->is_main_query()) {
        return;
    }

    if ($query->is_post_type_archive('itens')) {
        $query->set('posts_per_page', 12);
        $query->set('orderby', 'date');
        $query->set('order', 'DESC');
    }
}
add_action('pre_get_posts', 'k13_customize_main_queries');
