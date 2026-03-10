<?php
/**
 * Cadastro de Post-Type
 *
 * Adicione aqui os post types que vão compor o seu sistema
 *
 */
function k13_register_post_types()
{
    register_post_type('itens', array(
        'labels' => array(
            'name'               => _x('Itens', 'post type general name'),
            'singular_name'      => _x('Item', 'post type singular name'),
            'add_new'            => _x('Novo Item', 'Novo Item'),
            'add_new_item'       => __('Novo Item'),
            'edit_item'          => __('Editar Item'),
            'new_item'           => __('Novo Item'),
            'view_item'          => __('Ver Item'),
            'search_items'       => __('Procurar Item'),
            'not_found'          => __('Nenhum registro encontrado'),
            'not_found_in_trash' => __('Nenhum registro encontrado na lixeira'),
            'menu_name'          => __('Itens'),
        ),
        'public'             => true,
        'show_ui'            => true,
        'show_in_rest'       => true,
        'has_archive'        => true,
        'rewrite'            => array('slug' => 'itens'),
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'menu_position'      => 8,
        'menu_icon'          => 'dashicons-screenoptions',
        'exclude_from_search'=> false,
        'publicly_queryable' => true,
    ));

    register_taxonomy('itens-categories', 'itens', array(
        'hierarchical'      => true,
        'label'             => __('Categorias de Itens'),
        'show_ui'           => true,
        'show_tagcloud'     => false,
        'show_admin_column' => true,
        'show_in_rest'      => true,
        'rewrite'           => array('slug' => 'itens-categoria'),
    ));
}
add_action('init', 'k13_register_post_types');
