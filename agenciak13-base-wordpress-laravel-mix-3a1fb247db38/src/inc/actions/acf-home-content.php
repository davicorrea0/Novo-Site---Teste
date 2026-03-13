<?php

/**
 * Resolve a pagina alvo do conteudo da home.
 */
function k13_get_home_content_target_page_id()
{
    $page_on_front = (int) get_option('page_on_front');
    if ($page_on_front > 0) {
        return $page_on_front;
    }

    $front_page_candidates = get_posts(array(
        'post_type'      => 'page',
        'post_status'    => array('publish', 'draft', 'pending', 'private'),
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'front-page.php',
        'posts_per_page' => 1,
        'fields'         => 'ids',
    ));

    if (!empty($front_page_candidates)) {
        return (int) $front_page_candidates[0];
    }

    return 0;
}

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
        'title' => 'Conteudo da Home',
        'fields' => array(
            array(
                'key' => 'field_k13_home_panel_message',
                'label' => 'Edicao da Home',
                'name' => 'k13_home_panel_message',
                'type' => 'message',
                'message' => 'Edite os blocos da home por aqui, dentro de Paginas. Esta tela substitui o uso do editor padrao para a pagina inicial.',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
            array(
                'key' => 'field_k13_tab_hero_video',
                'label' => 'Hero e Video',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_k13_home_hero_image',
                'label' => 'Imagem do Hero',
                'name' => 'home_hero_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'large',
                'library' => 'all',
                'mime_types' => 'jpg,jpeg,png,webp',
            ),
            array(
                'key' => 'field_k13_home_hero_title_primary',
                'label' => 'Primeira palavra do Hero',
                'name' => 'home_hero_title_primary',
                'type' => 'text',
                'default_value' => 'COMTUDO',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_k13_home_hero_title_secondary',
                'label' => 'Segunda palavra do Hero',
                'name' => 'home_hero_title_secondary',
                'type' => 'text',
                'default_value' => 'BLACK',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_k13_home_hero_subtitle',
                'label' => 'Subtitulo do Hero',
                'name' => 'home_hero_subtitle',
                'type' => 'text',
                'default_value' => 'No padrao das suas escolhas.',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_k13_home_hero_cta_text',
                'label' => 'Texto do botao do Hero',
                'name' => 'home_hero_cta_text',
                'type' => 'text',
                'default_value' => 'Saiba Mais',
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_k13_home_hero_cta_url',
                'label' => 'URL do botao do Hero',
                'name' => 'home_hero_cta_url',
                'type' => 'text',
                'default_value' => '#sobre',
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_k13_home_show_video',
                'label' => 'Exibir secao de video',
                'name' => 'home_show_video',
                'type' => 'true_false',
                'default_value' => 1,
                'ui' => 1,
                'ui_on_text' => 'Exibir',
                'ui_off_text' => 'Ocultar',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_k13_home_video_poster',
                'label' => 'Poster do video',
                'name' => 'home_video_poster',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
                'mime_types' => 'jpg,jpeg,png,webp,gif',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_k13_home_video_embed_id',
                'label' => 'ID do video',
                'name' => 'home_video_embed_id',
                'type' => 'text',
                'default_value' => 'yBRQuQOdJl8',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_k13_tab_about',
                'label' => 'Sobre',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_k13_home_about_label',
                'label' => 'Label da secao Sobre',
                'name' => 'home_about_label',
                'type' => 'text',
                'default_value' => 'SOBRE NOS',
            ),
            array(
                'key' => 'field_k13_home_about_title_multiline',
                'label' => 'Titulo do Sobre (uma linha por linha visual)',
                'name' => 'home_about_title_multiline',
                'type' => 'textarea',
                'rows' => 4,
                'new_lines' => '',
                'default_value' => "EXCLUSIVIDADE DEIXA\nDE SER EXCECAO PARA\nSE TORNAR O SEU\nPADRAO.",
            ),
            array(
                'key' => 'field_k13_home_about_text_1',
                'label' => 'Primeiro paragrafo do Sobre',
                'name' => 'home_about_text_1',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'A COMTUDO BLACK e referencia em acabamentos de luxo e altissima qualidade em Guarapuava, reunindo design contemporaneo, marcas exclusivas e uma experiencia pensada nos minimos detalhes.',
            ),
            array(
                'key' => 'field_k13_home_about_text_2',
                'label' => 'Segundo paragrafo do Sobre',
                'name' => 'home_about_text_2',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Um espaco premium que oferece acabamentos de altissima qualidade, assinados por marcas consolidadas e com novidades de mercado.',
            ),
            array(
                'key' => 'field_k13_home_about_cards',
                'label' => 'Cards do Sobre',
                'name' => 'home_about_cards',
                'type' => 'repeater',
                'button_label' => 'Adicionar Card',
                'layout' => 'block',
                'sub_fields' => array(
                    array(
                        'key' => 'field_k13_home_about_card_title',
                        'label' => 'Titulo',
                        'name' => 'title',
                        'type' => 'text',
                        'required' => 1,
                        'wrapper' => array(
                            'width' => '40',
                        ),
                    ),
                    array(
                        'key' => 'field_k13_home_about_card_title_lines',
                        'label' => 'Titulo em linhas (uma linha por linha)',
                        'name' => 'title_lines',
                        'type' => 'textarea',
                        'rows' => 2,
                        'new_lines' => '',
                        'wrapper' => array(
                            'width' => '60',
                        ),
                    ),
                    array(
                        'key' => 'field_k13_home_about_card_description',
                        'label' => 'Descricao',
                        'name' => 'description',
                        'type' => 'textarea',
                        'rows' => 3,
                    ),
                    array(
                        'key' => 'field_k13_home_about_card_image',
                        'label' => 'Imagem',
                        'name' => 'image',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'mime_types' => 'jpg,jpeg,png,webp',
                    ),
                ),
            ),
            array(
                'key' => 'field_k13_home_about_card_cta_label',
                'label' => 'Texto do CTA dos cards',
                'name' => 'home_about_card_cta_label',
                'type' => 'text',
                'default_value' => 'SAIBA MAIS',
            ),
            array(
                'key' => 'field_k13_tab_segments',
                'label' => 'Segmentos',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_k13_home_segments_heading',
                'label' => 'Titulo de Segmentos',
                'name' => 'home_segments_heading',
                'type' => 'textarea',
                'rows' => 2,
                'new_lines' => 'br',
                'default_value' => 'O QUE VOCE <br> ENCONTRA NA <br> COMTUDO BLACK?',
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
                        'label' => 'Icone',
                        'name' => 'icon',
                        'type' => 'select',
                        'choices' => array(
                            'layers' => 'Revestimentos (layers)',
                            'droplet' => 'Metais e Loucas (droplet)',
                            'light' => 'Iluminacao (light)',
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
                        'label' => 'Titulo',
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
                'label' => 'Titulo de Marcas',
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
                        'key' => 'field_k13_home_brand_logo',
                        'label' => 'Logo',
                        'name' => 'logo',
                        'type' => 'image',
                        'return_format' => 'array',
                        'preview_size' => 'medium',
                        'library' => 'all',
                        'mime_types' => 'png,svg,webp,jpg,jpeg',
                    ),
                    array(
                        'key' => 'field_k13_home_brand_name',
                        'label' => 'Nome / Alt',
                        'name' => 'name',
                        'type' => 'text',
                        'required' => 0,
                    ),
                ),
            ),
            array(
                'key' => 'field_k13_tab_gallery',
                'label' => 'Galeria',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_k13_home_carousel_title',
                'label' => 'Titulo da Galeria',
                'name' => 'home_carousel_title',
                'type' => 'textarea',
                'rows' => 2,
                'new_lines' => '',
                'default_value' => 'DESCUBRA UM ESPACO ONDE ACONTECE A UNIAO PERFEITA ENTRE DESIGN E LUXO, ONDE CADA DETALHE E PENSADO PARA IMPRESSIONAR.',
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
                'label' => 'Localizacao e Contato',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_k13_home_location_title',
                'label' => 'Titulo da Localizacao',
                'name' => 'home_location_title',
                'type' => 'text',
                'default_value' => 'ONDE ESTAMOS',
            ),
            array(
                'key' => 'field_k13_home_location_subtitle',
                'label' => 'Subtitulo da Localizacao',
                'name' => 'home_location_subtitle',
                'type' => 'text',
                'default_value' => 'VISITE O ENDERECO DA EXCLUSIVIDADE.',
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
                'label' => 'Endereco (quebra de linha permitida)',
                'name' => 'home_location_address',
                'type' => 'textarea',
                'rows' => 2,
                'new_lines' => '',
                'default_value' => "Rua Laurindo Richa, 304,\nGuarapuava - Parana",
            ),
            array(
                'key' => 'field_k13_home_location_directions_url',
                'label' => 'URL de Rotas',
                'name' => 'home_location_directions_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_k13_home_location_directions_label',
                'label' => 'Texto do botao Rotas',
                'name' => 'home_location_directions_label',
                'type' => 'text',
                'default_value' => 'Rotas',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_k13_home_location_map_url',
                'label' => 'URL do Mapa (Ampliar)',
                'name' => 'home_location_map_url',
                'type' => 'url',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_k13_home_location_map_label',
                'label' => 'Texto do botao Ampliar',
                'name' => 'home_location_map_label',
                'type' => 'text',
                'default_value' => 'Ampliar',
            ),
            array(
                'key' => 'field_k13_home_location_map_embed_url',
                'label' => 'URL de Embed do Mapa',
                'name' => 'home_location_map_embed_url',
                'type' => 'url',
            ),
            array(
                'key' => 'field_k13_home_contact_title',
                'label' => 'Titulo do Contato',
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
            array(
                'key' => 'field_k13_tab_footer',
                'label' => 'Footer',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_k13_home_footer_smart_link',
                'label' => 'Link da logo Smart no footer',
                'name' => 'footer_smart_link',
                'type' => 'url',
                'instructions' => 'Esse link sera usado na logo Smart do footer.',
                'placeholder' => 'https://',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'page_type',
                    'operator' => '==',
                    'value' => 'front_page',
                ),
            ),
            array(
                array(
                    'param' => 'page_template',
                    'operator' => '==',
                    'value' => 'front-page.php',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => array(
            'the_content',
            'excerpt',
            'discussion',
            'comments',
            'custom_fields',
        ),
        'active' => true,
    ));
}

/**
 * Garante o registro do grupo mesmo quando o ACF ja foi carregado antes deste arquivo.
 */
function k13_boot_home_content_fields()
{
    static $did_boot = false;

    if ($did_boot) {
        return;
    }

    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    $did_boot = true;
    k13_register_home_content_fields();
}

add_action('acf/init', 'k13_boot_home_content_fields');
add_action('init', 'k13_boot_home_content_fields', 20);

/**
 * Importa o grupo local para o cadastro do ACF para que apareca em Custom Fields > Field Groups.
 */
function k13_import_home_content_field_group_to_acf()
{
    static $did_sync = false;

    if ($did_sync) {
        return;
    }

    if (
        !function_exists('acf_import_field_group')
        || !function_exists('acf_get_field_group_post')
        || !function_exists('acf_get_local_field_group')
        || !function_exists('acf_get_local_fields')
    ) {
        return;
    }

    k13_boot_home_content_fields();

    $local_group = acf_get_local_field_group('group_k13_home_content');
    if (!$local_group) {
        return;
    }

    $local_fields = acf_get_local_fields('group_k13_home_content');
    if (!is_array($local_fields) || empty($local_fields)) {
        return;
    }

    $local_group['fields'] = array_values($local_fields);

    $existing_group_post = acf_get_field_group_post('group_k13_home_content');
    if ($existing_group_post) {
        $local_group['ID'] = (int) $existing_group_post->ID;
    }

    $sync_hash = md5(wp_json_encode($local_group));
    if ($existing_group_post && get_option('k13_home_content_group_sync_hash') === $sync_hash) {
        $did_sync = true;
        return;
    }

    acf_import_field_group($local_group);
    update_option('k13_home_content_group_sync_hash', $sync_hash, false);
    $did_sync = true;
}
add_action('admin_init', 'k13_import_home_content_field_group_to_acf', 25);

/**
 * Mostra um aviso quando a home editavel ainda nao esta vinculada a uma pagina.
 */
function k13_home_content_admin_notice()
{
    if (!is_admin() || !current_user_can('edit_pages')) {
        return;
    }

    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    if (!$screen || !in_array($screen->id, array('page', 'edit-page', 'options-reading'), true)) {
        return;
    }

    $has_front_page = get_option('show_on_front') === 'page' && (int) get_option('page_on_front') > 0;
    $has_front_template_page = !empty(get_posts(array(
        'post_type'      => 'page',
        'post_status'    => array('publish', 'draft', 'pending', 'private'),
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'front-page.php',
        'posts_per_page' => 1,
        'fields'         => 'ids',
    )));

    if ($has_front_page || $has_front_template_page) {
        return;
    }

    echo '<div class="notice notice-warning"><p>';
    echo esc_html__('Os campos ACF da home aparecem dentro de Paginas. Defina uma Pagina inicial em Configuracoes > Leitura ou atribua o template "Front Page" a uma pagina.', 'comtudo-black');
    echo '</p></div>';
}
add_action('admin_notices', 'k13_home_content_admin_notice');

/**
 * Mantem Pages no editor classico para garantir que os grupos ACF aparecam de forma consistente.
 */
function k13_disable_block_editor_for_pages($use_block_editor, $post_type)
{
    if ($post_type === 'page') {
        return false;
    }

    return $use_block_editor;
}
add_filter('use_block_editor_for_post_type', 'k13_disable_block_editor_for_pages', 20, 2);

/**
 * Garante que o metabox da home nao fique oculto ou recolhido na tela de Pages.
 */
function k13_force_home_content_metabox_visible()
{
    if (!is_admin() || !function_exists('get_users')) {
        return;
    }

    $users = get_users(array(
        'fields' => array('ID'),
    ));

    if (empty($users)) {
        return;
    }

    $metabox_id = 'acf-group_k13_home_content';

    foreach ($users as $user) {
        $user_id = isset($user->ID) ? (int) $user->ID : 0;
        if ($user_id <= 0) {
            continue;
        }

        $hidden = get_user_meta($user_id, 'metaboxhidden_page', true);
        if (!is_array($hidden)) {
            $hidden = array();
        }

        $hidden = array_values(array_filter($hidden, static function ($value) use ($metabox_id) {
            return $value !== $metabox_id;
        }));
        update_user_meta($user_id, 'metaboxhidden_page', $hidden);

        $closed = get_user_meta($user_id, 'closedpostboxes_page', true);
        if (!is_array($closed)) {
            $closed = array();
        }

        $closed = array_values(array_filter($closed, static function ($value) use ($metabox_id) {
            return $value !== $metabox_id;
        }));
        update_user_meta($user_id, 'closedpostboxes_page', $closed);
    }
}
add_action('admin_init', 'k13_force_home_content_metabox_visible', 30);

/**
 * Preenche os campos da home uma vez para que o painel abra com conteudo editavel.
 */
function k13_seed_home_content_defaults()
{
    if (!function_exists('get_field') || !function_exists('update_field')) {
        return;
    }

    $target_page_id = k13_get_home_content_target_page_id();
    if ($target_page_id <= 0) {
        return;
    }

    $seed_flag = 'k13_home_content_seeded_page_' . $target_page_id;
    if (get_option($seed_flag) === '1') {
        return;
    }

    $defaults = array(
        'field_k13_home_hero_title_primary' => array(
            'name' => 'home_hero_title_primary',
            'value' => 'COMTUDO',
        ),
        'field_k13_home_hero_title_secondary' => array(
            'name' => 'home_hero_title_secondary',
            'value' => 'BLACK',
        ),
        'field_k13_home_hero_subtitle' => array(
            'name' => 'home_hero_subtitle',
            'value' => 'No padrao das suas escolhas.',
        ),
        'field_k13_home_hero_cta_text' => array(
            'name' => 'home_hero_cta_text',
            'value' => 'Saiba Mais',
        ),
        'field_k13_home_hero_cta_url' => array(
            'name' => 'home_hero_cta_url',
            'value' => '#sobre',
        ),
        'field_k13_home_show_video' => array(
            'name' => 'home_show_video',
            'value' => 1,
        ),
        'field_k13_home_video_embed_id' => array(
            'name' => 'home_video_embed_id',
            'value' => 'yBRQuQOdJl8',
        ),
        'field_k13_home_about_label' => array(
            'name' => 'home_about_label',
            'value' => 'SOBRE NOS',
        ),
        'field_k13_home_about_title_multiline' => array(
            'name' => 'home_about_title_multiline',
            'value' => "EXCLUSIVIDADE DEIXA\nDE SER EXCECAO PARA\nSE TORNAR O SEU\nPADRAO.",
        ),
        'field_k13_home_about_text_1' => array(
            'name' => 'home_about_text_1',
            'value' => 'A COMTUDO BLACK e referencia em acabamentos de luxo e altissima qualidade em Guarapuava, reunindo design contemporaneo, marcas exclusivas e uma experiencia pensada nos minimos detalhes.',
        ),
        'field_k13_home_about_text_2' => array(
            'name' => 'home_about_text_2',
            'value' => 'Um espaco premium que oferece acabamentos de altissima qualidade, assinados por marcas consolidadas e com novidades de mercado.',
        ),
        'field_k13_home_about_card_cta_label' => array(
            'name' => 'home_about_card_cta_label',
            'value' => 'SAIBA MAIS',
        ),
        'field_k13_home_segments_heading' => array(
            'name' => 'home_segments_heading',
            'value' => 'O QUE VOCE <br> ENCONTRA NA <br> COMTUDO BLACK?',
        ),
        'field_k13_home_brands_heading' => array(
            'name' => 'home_brands_heading',
            'value' => 'Marcas e Destaques',
        ),
        'field_k13_home_carousel_title' => array(
            'name' => 'home_carousel_title',
            'value' => 'DESCUBRA UM ESPACO ONDE ACONTECE A UNIAO PERFEITA ENTRE DESIGN E LUXO, ONDE CADA DETALHE E PENSADO PARA IMPRESSIONAR.',
        ),
        'field_k13_home_location_title' => array(
            'name' => 'home_location_title',
            'value' => 'ONDE ESTAMOS',
        ),
        'field_k13_home_location_subtitle' => array(
            'name' => 'home_location_subtitle',
            'value' => 'VISITE O ENDERECO DA EXCLUSIVIDADE.',
        ),
        'field_k13_home_location_name' => array(
            'name' => 'home_location_name',
            'value' => 'Comtudo Black',
        ),
        'field_k13_home_location_address' => array(
            'name' => 'home_location_address',
            'value' => "Rua Laurindo Richa, 304,\nGuarapuava - Parana",
        ),
        'field_k13_home_location_directions_url' => array(
            'name' => 'home_location_directions_url',
            'value' => 'https://www.google.com/maps/dir/?api=1&destination=Rua+Laurindo+Richa,+304,+Guarapuava+-+PR',
        ),
        'field_k13_home_location_directions_label' => array(
            'name' => 'home_location_directions_label',
            'value' => 'Rotas',
        ),
        'field_k13_home_location_map_url' => array(
            'name' => 'home_location_map_url',
            'value' => 'https://maps.google.com/maps?q=Rua+Laurindo+Richa,+304,+Guarapuava+-+PR',
        ),
        'field_k13_home_location_map_label' => array(
            'name' => 'home_location_map_label',
            'value' => 'Ampliar',
        ),
        'field_k13_home_location_map_embed_url' => array(
            'name' => 'home_location_map_embed_url',
            'value' => 'https://maps.google.com/maps?q=Rua+Laurindo+Richa,+304,+Guarapuava+-+PR&t=&z=18&ie=UTF8&iwloc=near&output=embed',
        ),
        'field_k13_home_contact_title' => array(
            'name' => 'home_contact_title',
            'value' => 'FALE CONOSCO',
        ),
        'field_k13_home_contact_phone' => array(
            'name' => 'home_contact_phone',
            'value' => 'WhatsApp e Telefone: (42) 3629-9700',
        ),
        'field_k13_home_contact_whatsapp_url' => array(
            'name' => 'home_contact_whatsapp_url',
            'value' => 'https://wa.me/554236299700',
        ),
        'field_k13_home_about_cards' => array(
            'name' => 'home_about_cards',
            'value' => array(
                array(
                    'title' => 'Exclusividade',
                    'title_lines' => "Exclusividade",
                    'description' => 'Produtos assinados, itens limitados e marcas de alto destaque.',
                    'image' => '',
                ),
                array(
                    'title' => 'Sofisticacao',
                    'title_lines' => "Sofisticacao",
                    'description' => 'Ambientes projetados para inspirar e elevar o padrao dos seus projetos.',
                    'image' => '',
                ),
                array(
                    'title' => 'Atendimento Personalizado',
                    'title_lines' => "Atendimento\nPersonalizado",
                    'description' => 'Consultoria especializada para atender as suas necessidades com excelencia.',
                    'image' => '',
                ),
                array(
                    'title' => 'Inovacao',
                    'title_lines' => "Inovacao",
                    'description' => 'As ultimas tendencias mundiais em acabamentos e design de interiores.',
                    'image' => '',
                ),
            ),
        ),
        'field_k13_home_segments_data' => array(
            'name' => 'home_segments_data',
            'value' => array(
                array(
                    'icon' => 'layers',
                    'title' => 'REVESTIMENTOS DE ALTO PADRAO',
                    'items' => "Porcelanatos, grandes formatos, superficies especiais e texturas exclusivas que transformam ambientes em experiencias arquitetonicas.\nMateriais que aliam tecnologia, resistencia e estetica contemporanea.",
                ),
                array(
                    'icon' => 'droplet',
                    'title' => 'METAIS E LOUCAS PREMIUM',
                    'items' => "Linhas sofisticadas, acabamentos refinados e design funcional que elevam banheiros e cozinhas a outro nivel.\nPecas que unem precisao, durabilidade e elegancia atemporal.",
                ),
                array(
                    'icon' => 'light',
                    'title' => 'ILUMINACAO',
                    'items' => "Solucoes que valorizam volumes, texturas e atmosferas.\nLuminarias e sistemas que combinam eficiencia e design, criando cenarios unicos.",
                ),
                array(
                    'icon' => 'spa',
                    'title' => 'BANHEIRO E SPA',
                    'items' => "Elementos que transformam o espaco com elegancia.\nDesign, conforto absoluto e materiais de alta performance.\nModelos exclusivos que se destacam pela funcionalidade e estetica.",
                ),
                array(
                    'icon' => 'stone',
                    'title' => 'SUPERFICIES ESPECIAIS E MATERIAIS NOBRES',
                    'items' => "Marmores, pedras naturais, texturas e composicoes que agregam personalidade e autenticidade a cada projeto.",
                ),
            ),
        ),
        'field_k13_home_brands_data' => array(
            'name' => 'home_brands_data',
            'value' => array(
                array(
                    'name' => 'Eliane',
                    'logo' => '',
                ),
                array(
                    'name' => 'Portinari',
                    'logo' => '',
                ),
                array(
                    'name' => 'Kohler',
                    'logo' => '',
                ),
                array(
                    'name' => 'Decortiles',
                    'logo' => '',
                ),
                array(
                    'name' => 'Ceusa',
                    'logo' => '',
                ),
            ),
        ),
    );

    foreach ($defaults as $field_key => $field_data) {
        $current_value = get_field($field_data['name'], $target_page_id);
        $legacy_value = get_field($field_data['name'], 'option');

        $current_is_empty = is_array($current_value) ? empty($current_value) : trim((string) $current_value) === '';
        $legacy_has_value = is_array($legacy_value) ? !empty($legacy_value) : trim((string) $legacy_value) !== '';

        if ($current_is_empty) {
            $value_to_store = $legacy_has_value ? $legacy_value : $field_data['value'];
            update_field($field_key, $value_to_store, $target_page_id);
        }
    }

    update_option($seed_flag, '1', false);
}

/**
 * Executa o seed depois que o ACF estiver disponivel, mesmo fora do fluxo padrao do hook.
 */
function k13_boot_home_content_seed()
{
    static $did_seed = false;

    if ($did_seed) {
        return;
    }

    if (!function_exists('get_field') || !function_exists('update_field')) {
        return;
    }

    $did_seed = true;
    k13_seed_home_content_defaults();
}

add_action('acf/init', 'k13_boot_home_content_seed', 30);
add_action('init', 'k13_boot_home_content_seed', 30);
