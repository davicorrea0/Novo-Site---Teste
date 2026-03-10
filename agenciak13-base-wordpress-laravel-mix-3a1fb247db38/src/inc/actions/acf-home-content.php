<?php

/**
 * Opções de conteúdo da home via ACF.
 */
function k13_register_home_content_options_page()
{
    if (!function_exists('acf_add_options_page')) {
        return;
    }

    acf_add_options_page(array(
        'page_title' => 'Conteúdo Home',
        'menu_title' => 'Conteúdo Home',
        'menu_slug'  => 'k13-home-content',
        'capability' => 'edit_posts',
        'redirect'   => false,
        'position'   => 25,
        'icon_url'   => 'dashicons-welcome-widgets-menus',
    ));
}
add_action('acf/init', 'k13_register_home_content_options_page');

/**
 * Campos ACF para a home.
 */
function k13_register_home_content_fields()
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_k13_home_content',
        'title' => 'Conteúdo da Home',
        'fields' => array(
            array(
                'key' => 'field_k13_tab_segments',
                'label' => 'Segmentos',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_k13_home_segments_heading',
                'label' => 'Título de Segmentos',
                'name' => 'home_segments_heading',
                'type' => 'textarea',
                'rows' => 2,
                'new_lines' => 'br',
                'default_value' => 'O QUE VOCÊ <br> ENCONTRA NA <br> COMTUDO BLACK?',
            ),
            array(
                'key' => 'field_k13_home_segments_data',
                'label' => 'Lista de Segmentos',
                'name' => 'home_segments_data',
                'type' => 'repeater',
                'button_label' => 'Adicionar Segmento',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_k13_home_segment_icon',
                        'label' => 'Ícone',
                        'name' => 'icon',
                        'type' => 'select',
                        'choices' => array(
                            'layers' => 'Revestimentos (layers)',
                            'droplet' => 'Metais e Louças (droplet)',
                            'light' => 'Iluminação (light)',
                            'spa' => 'Banheiro e Spa (spa)',
                            'stone' => 'Materiais Nobres (stone)',
                        ),
                        'allow_null' => 1,
                        'ui' => 0,
                        'wrapper' => array(
                            'width' => '35',
                        ),
                    ),
                    array(
                        'key' => 'field_k13_home_segment_title',
                        'label' => 'Título',
                        'name' => 'title',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => array(
                            'width' => '65',
                        ),
                    ),
                    array(
                        'key' => 'field_k13_home_segment_items',
                        'label' => 'Itens (uma linha por bullet)',
                        'name' => 'items',
                        'type' => 'textarea',
                        'rows' => 4,
                        'new_lines' => '',
                    ),
                ),
            ),
            array(
                'key' => 'field_k13_tab_brands',
                'label' => 'Marcas',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_k13_home_brands_heading',
                'label' => 'Título de Marcas',
                'name' => 'home_brands_heading',
                'type' => 'text',
                'default_value' => 'Marcas e Destaques',
            ),
            array(
                'key' => 'field_k13_home_brands_data',
                'label' => 'Lista de Marcas',
                'name' => 'home_brands_data',
                'type' => 'repeater',
                'button_label' => 'Adicionar Marca',
                'layout' => 'table',
                'sub_fields' => array(
                    array(
                        'key' => 'field_k13_home_brand_name',
                        'label' => 'Nome',
                        'name' => 'name',
                        'type' => 'text',
                        'required' => 1,
                    ),
                ),
            ),
            array(
                'key' => 'field_k13_tab_gallery',
                'label' => 'Galeria',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_k13_home_gallery_images',
                'label' => 'Imagens da Galeria',
                'name' => 'home_gallery_images',
                'type' => 'gallery',
                'preview_size' => 'medium',
                'insert' => 'append',
                'library' => 'all',
                'min' => 0,
                'max' => 12,
                'mime_types' => 'jpg,jpeg,png,webp',
            ),
            array(
                'key' => 'field_k13_tab_location_contact',
                'label' => 'Localização e Contato',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_k13_home_location_title',
                'label' => 'Título da Localização',
                'name' => 'home_location_title',
                'type' => 'text',
                'default_value' => 'ONDE ESTAMOS',
            ),
            array(
                'key' => 'field_k13_home_location_subtitle',
                'label' => 'Subtítulo da Localização',
                'name' => 'home_location_subtitle',
                'type' => 'text',
                'default_value' => 'VISITE O ENDEREÇO DA EXCLUSIVIDADE.',
            ),
            array(
                'key' => 'field_k13_home_location_name',
                'label' => 'Nome da Loja',
                'name' => 'home_location_name',
                'type' => 'text',
                'default_value' => 'Comtudo Black',
            ),
            array(
                'key' => 'field_k13_home_location_address',
                'label' => 'Endereço (quebra de linha permitida)',
                'name' => 'home_location_address',
                'type' => 'textarea',
                'rows' => 2,
                'new_lines' => '',
                'default_value' => "Rua Laurindo Richa, 304,\nGuarapuava - Paraná",
            ),
            array(
                'key' => 'field_k13_home_location_directions_url',
                'label' => 'URL de Rotas',
                'name' => 'home_location_directions_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_k13_home_location_map_url',
                'label' => 'URL do Mapa (Ampliar)',
                'name' => 'home_location_map_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_k13_home_location_map_embed_url',
                'label' => 'URL de Embed do Mapa',
                'name' => 'home_location_map_embed_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_k13_home_contact_title',
                'label' => 'Título do Contato',
                'name' => 'home_contact_title',
                'type' => 'text',
                'default_value' => 'FALE CONOSCO',
            ),
            array(
                'key' => 'field_k13_home_contact_phone',
                'label' => 'Texto do Telefone',
                'name' => 'home_contact_phone',
                'type' => 'text',
                'default_value' => 'WhatsApp e Telefone: (42) 3629-9700',
            ),
            array(
                'key' => 'field_k13_home_contact_whatsapp_url',
                'label' => 'URL do WhatsApp',
                'name' => 'home_contact_whatsapp_url',
                'type' => 'url',
                'default_value' => 'https://wa.me/554236299700',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'k13-home-content',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));
}
add_action('acf/init', 'k13_register_home_content_fields');
