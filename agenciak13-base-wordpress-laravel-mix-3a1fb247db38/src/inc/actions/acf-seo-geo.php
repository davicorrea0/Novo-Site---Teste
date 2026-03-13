<?php

function k13_seo_geo_get_home_page_id()
{
    if (function_exists('k13_get_home_content_target_page_id')) {
        return (int) k13_get_home_content_target_page_id();
    }

    $page_on_front = (int) get_option('page_on_front');
    if ($page_on_front > 0) {
        return $page_on_front;
    }

    return 0;
}

function k13_seo_geo_has_meaningful_value($value)
{
    if (is_array($value)) {
        return !empty($value);
    }

    return !in_array($value, array(null, false, ''), true);
}

function k13_seo_geo_get_home_field($field_name, $default = null)
{
    if (!function_exists('get_field')) {
        return $default;
    }

    $page_id = k13_seo_geo_get_home_page_id();
    if ($page_id > 0) {
        $page_value = get_field($field_name, $page_id);
        if (k13_seo_geo_has_meaningful_value($page_value)) {
            return $page_value;
        }
    }

    $option_value = get_field($field_name, 'option');
    if (k13_seo_geo_has_meaningful_value($option_value)) {
        return $option_value;
    }

    return $default;
}

function k13_seo_geo_get_option($field_name, $default = '')
{
    if (!function_exists('get_field')) {
        return $default;
    }

    $value = get_field($field_name, 'option');
    if (k13_seo_geo_has_meaningful_value($value)) {
        return $value;
    }

    return $default;
}

function k13_seo_geo_get_text_option($field_name, $default = '')
{
    return trim((string) k13_seo_geo_get_option($field_name, $default));
}

function k13_seo_geo_parse_multiline($value)
{
    $lines = preg_split('/\r\n|\r|\n/', (string) $value);
    $lines = array_map('trim', (array) $lines);

    return array_values(array_filter($lines, static function ($line) {
        return $line !== '';
    }));
}

function k13_seo_geo_get_image_url($image, $size = 'full')
{
    if (is_array($image)) {
        if (!empty($image['sizes'][$size])) {
            return (string) $image['sizes'][$size];
        }

        if (!empty($image['url'])) {
            return (string) $image['url'];
        }
    }

    if (is_numeric($image)) {
        $attachment_url = wp_get_attachment_image_url((int) $image, $size);
        if ($attachment_url) {
            return (string) $attachment_url;
        }
    }

    if (is_string($image) && filter_var($image, FILTER_VALIDATE_URL)) {
        return $image;
    }

    return '';
}

function k13_seo_geo_get_share_image_url()
{
    $share_image = k13_seo_geo_get_option('seo_default_share_image');
    $share_image_url = k13_seo_geo_get_image_url($share_image, 'full');
    if ($share_image_url !== '') {
        return $share_image_url;
    }

    $page_id = k13_seo_geo_get_home_page_id();
    if ($page_id > 0) {
        $featured_image_url = get_the_post_thumbnail_url($page_id, 'full');
        if ($featured_image_url) {
            return (string) $featured_image_url;
        }
    }

    $hero_image = k13_seo_geo_get_home_field('home_hero_image');
    $hero_image_url = k13_seo_geo_get_image_url($hero_image, 'full');
    if ($hero_image_url !== '') {
        return $hero_image_url;
    }

    $site_icon_url = get_site_icon_url(512);
    if ($site_icon_url) {
        return (string) $site_icon_url;
    }

    return '';
}

function k13_seo_geo_normalize_phone_for_schema($value)
{
    $digits = preg_replace('/\D+/', '', (string) $value);
    if ($digits === '') {
        return '';
    }

    if (strpos($digits, '55') !== 0 && strlen($digits) <= 11) {
        $digits = '55' . $digits;
    }

    return '+' . $digits;
}

function k13_seo_geo_map_day_token($token)
{
    $map = array(
        'mo' => 'Monday',
        'tu' => 'Tuesday',
        'we' => 'Wednesday',
        'th' => 'Thursday',
        'fr' => 'Friday',
        'sa' => 'Saturday',
        'su' => 'Sunday',
    );

    $token = strtolower(trim((string) $token));

    return isset($map[$token]) ? $map[$token] : '';
}

function k13_seo_geo_expand_day_tokens($tokens)
{
    $tokens = array_values(array_filter(array_map(static function ($token) {
        return strtolower(trim((string) $token));
    }, (array) $tokens)));

    if (empty($tokens)) {
        return array();
    }

    if (count($tokens) === 1) {
        $day = k13_seo_geo_map_day_token($tokens[0]);

        return $day !== '' ? array($day) : array();
    }

    $order = array('mo', 'tu', 'we', 'th', 'fr', 'sa', 'su');
    $start = array_search($tokens[0], $order, true);
    $end = array_search($tokens[1], $order, true);

    if ($start === false || $end === false || $start > $end) {
        return array();
    }

    $expanded = array();
    for ($index = $start; $index <= $end; $index++) {
        $day = k13_seo_geo_map_day_token($order[$index]);
        if ($day !== '') {
            $expanded[] = $day;
        }
    }

    return $expanded;
}

function k13_register_seo_geo_options_page()
{
    if (!function_exists('acf_add_options_sub_page')) {
        return;
    }

    acf_add_options_sub_page(array(
        'page_title'  => 'SEO e GEO',
        'menu_title'  => 'SEO e GEO',
        'menu_slug'   => 'theme-options-seo-geo',
        'parent_slug' => 'theme-options',
    ));
}

function k13_boot_seo_geo_options_page()
{
    static $did_boot = false;

    if ($did_boot || !function_exists('acf_add_options_sub_page')) {
        return;
    }

    $did_boot = true;
    k13_register_seo_geo_options_page();
}
add_action('acf/init', 'k13_boot_seo_geo_options_page', 40);
add_action('init', 'k13_boot_seo_geo_options_page', 40);

function k13_register_seo_geo_fields()
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_k13_seo_geo_options',
        'title' => 'SEO e GEO',
        'fields' => array(
            array(
                'key' => 'field_k13_seo_geo_intro',
                'label' => 'Orientacao',
                'name' => 'seo_geo_intro',
                'type' => 'message',
                'message' => 'Preencha aqui os textos base de SEO, a entidade da marca e os dados locais. O tema usa estes campos para alimentar o Yoast SEO, os metadados sociais e o schema de LocalBusiness.',
                'new_lines' => 'wpautop',
                'esc_html' => 0,
            ),
            array(
                'key' => 'field_k13_seo_tab_core',
                'label' => 'SEO',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_k13_seo_business_name',
                'label' => 'Nome da Marca',
                'name' => 'seo_business_name',
                'type' => 'text',
                'default_value' => 'Comtudo Black',
            ),
            array(
                'key' => 'field_k13_seo_site_tagline',
                'label' => 'Tagline / Descricao curta do site',
                'name' => 'seo_site_tagline',
                'type' => 'text',
                'default_value' => 'Acabamentos de luxo, revestimentos premium e design de alto padrao em Guarapuava - PR.',
            ),
            array(
                'key' => 'field_k13_seo_default_meta_description',
                'label' => 'Descricao padrao para paginas sem meta própria',
                'name' => 'seo_default_meta_description',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Acabamentos de luxo em Guarapuava - PR. Revestimentos, metais, loucas, iluminacao e superficies especiais para projetos de alto padrao.',
            ),
            array(
                'key' => 'field_k13_seo_home_title',
                'label' => 'Titulo SEO da Home',
                'name' => 'seo_home_title',
                'type' => 'text',
                'default_value' => 'Comtudo Black | Acabamentos de luxo e alto padrao em Guarapuava - PR',
            ),
            array(
                'key' => 'field_k13_seo_home_meta_description',
                'label' => 'Meta description da Home',
                'name' => 'seo_home_meta_description',
                'type' => 'textarea',
                'rows' => 3,
                'default_value' => 'Comtudo Black em Guarapuava - PR: revestimentos, metais, loucas, iluminacao e superficies especiais para projetos de luxo e alto padrao.',
            ),
            array(
                'key' => 'field_k13_seo_focus_keyphrase',
                'label' => 'Keyphrase principal da Home',
                'name' => 'seo_focus_keyphrase',
                'type' => 'text',
                'default_value' => 'acabamentos de luxo em Guarapuava',
            ),
            array(
                'key' => 'field_k13_seo_default_share_image',
                'label' => 'Imagem padrao para compartilhamento',
                'name' => 'seo_default_share_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'large',
                'library' => 'all',
                'mime_types' => 'jpg,jpeg,png,webp,svg',
            ),
            array(
                'key' => 'field_k13_seo_tab_entity',
                'label' => 'GEO e Entidade',
                'type' => 'tab',
            ),
            array(
                'key' => 'field_k13_seo_business_type',
                'label' => 'Tipo de Negocio (schema)',
                'name' => 'seo_business_type',
                'type' => 'select',
                'choices' => array(
                    'HomeGoodsStore' => 'HomeGoodsStore',
                    'Store' => 'Store',
                    'LocalBusiness' => 'LocalBusiness',
                ),
                'default_value' => 'HomeGoodsStore',
                'ui' => 0,
                'allow_null' => 0,
            ),
            array(
                'key' => 'field_k13_seo_business_summary',
                'label' => 'Resumo institucional da marca',
                'name' => 'seo_business_summary',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => 'A Comtudo Black e uma loja premium de acabamentos em Guarapuava, com curadoria de revestimentos, metais, loucas, iluminacao e materiais nobres para projetos de alto padrao.',
            ),
            array(
                'key' => 'field_k13_seo_focus_topics',
                'label' => 'Topicos e assuntos principais (uma linha por tema)',
                'name' => 'seo_focus_topics',
                'type' => 'textarea',
                'rows' => 6,
                'default_value' => "acabamentos de luxo\nrevestimentos de alto padrao\nmetais e loucas premium\niluminacao de design\nsuperficies especiais\nbanheiro e spa",
            ),
            array(
                'key' => 'field_k13_seo_business_phone',
                'label' => 'Telefone principal',
                'name' => 'seo_business_phone',
                'type' => 'text',
                'default_value' => '(42) 3629-9700',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_k13_seo_business_whatsapp',
                'label' => 'URL do WhatsApp',
                'name' => 'seo_business_whatsapp',
                'type' => 'url',
                'default_value' => 'https://wa.me/554236299700',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_k13_seo_business_email',
                'label' => 'Email comercial',
                'name' => 'seo_business_email',
                'type' => 'email',
            ),
            array(
                'key' => 'field_k13_seo_address_street',
                'label' => 'Rua e numero',
                'name' => 'seo_address_street',
                'type' => 'text',
                'default_value' => 'Rua Laurindo Richa, 304',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_k13_seo_address_locality',
                'label' => 'Cidade',
                'name' => 'seo_address_locality',
                'type' => 'text',
                'default_value' => 'Guarapuava',
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_k13_seo_address_region',
                'label' => 'Estado',
                'name' => 'seo_address_region',
                'type' => 'text',
                'default_value' => 'PR',
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_k13_seo_address_postal_code',
                'label' => 'CEP',
                'name' => 'seo_address_postal_code',
                'type' => 'text',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_k13_seo_address_country',
                'label' => 'Pais',
                'name' => 'seo_address_country',
                'type' => 'text',
                'default_value' => 'BR',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_k13_seo_service_areas',
                'label' => 'Areas de atendimento (uma linha por cidade ou regiao)',
                'name' => 'seo_service_areas',
                'type' => 'textarea',
                'rows' => 4,
                'default_value' => "Guarapuava - PR\nCentro-Sul do Parana",
            ),
            array(
                'key' => 'field_k13_seo_same_as_links',
                'label' => 'Perfis oficiais e citacoes (uma URL por linha)',
                'name' => 'seo_same_as_links',
                'type' => 'textarea',
                'rows' => 4,
            ),
            array(
                'key' => 'field_k13_seo_geo_latitude',
                'label' => 'Latitude',
                'name' => 'seo_geo_latitude',
                'type' => 'text',
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_k13_seo_geo_longitude',
                'label' => 'Longitude',
                'name' => 'seo_geo_longitude',
                'type' => 'text',
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_k13_seo_price_range',
                'label' => 'Faixa de preco',
                'name' => 'seo_price_range',
                'type' => 'text',
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
            array(
                'key' => 'field_k13_seo_opening_hours',
                'label' => 'Horario de atendimento (uma linha por faixa, ex: Mo-Fr 09:00-18:00)',
                'name' => 'seo_opening_hours',
                'type' => 'textarea',
                'rows' => 4,
                'wrapper' => array(
                    'width' => '25',
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'theme-options-seo-geo',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
    ));
}

function k13_boot_seo_geo_fields()
{
    static $did_boot = false;

    if ($did_boot || !function_exists('acf_add_local_field_group')) {
        return;
    }

    $did_boot = true;
    k13_register_seo_geo_fields();
}
add_action('acf/init', 'k13_boot_seo_geo_fields', 41);
add_action('init', 'k13_boot_seo_geo_fields', 41);

function k13_seed_seo_geo_defaults()
{
    if (!function_exists('get_field') || !function_exists('update_field')) {
        return;
    }

    $default_values = array(
        'field_k13_seo_business_name' => array(
            'name' => 'seo_business_name',
            'value' => 'Comtudo Black',
        ),
        'field_k13_seo_site_tagline' => array(
            'name' => 'seo_site_tagline',
            'value' => 'Acabamentos de luxo, revestimentos premium e design de alto padrao em Guarapuava - PR.',
        ),
        'field_k13_seo_default_meta_description' => array(
            'name' => 'seo_default_meta_description',
            'value' => 'Acabamentos de luxo em Guarapuava - PR. Revestimentos, metais, loucas, iluminacao e superficies especiais para projetos de alto padrao.',
        ),
        'field_k13_seo_home_title' => array(
            'name' => 'seo_home_title',
            'value' => 'Comtudo Black | Acabamentos de luxo e alto padrao em Guarapuava - PR',
        ),
        'field_k13_seo_home_meta_description' => array(
            'name' => 'seo_home_meta_description',
            'value' => 'Comtudo Black em Guarapuava - PR: revestimentos, metais, loucas, iluminacao e superficies especiais para projetos de luxo e alto padrao.',
        ),
        'field_k13_seo_focus_keyphrase' => array(
            'name' => 'seo_focus_keyphrase',
            'value' => 'acabamentos de luxo em Guarapuava',
        ),
        'field_k13_seo_business_type' => array(
            'name' => 'seo_business_type',
            'value' => 'HomeGoodsStore',
        ),
        'field_k13_seo_business_summary' => array(
            'name' => 'seo_business_summary',
            'value' => 'A Comtudo Black e uma loja premium de acabamentos em Guarapuava, com curadoria de revestimentos, metais, loucas, iluminacao e materiais nobres para projetos de alto padrao.',
        ),
        'field_k13_seo_focus_topics' => array(
            'name' => 'seo_focus_topics',
            'value' => "acabamentos de luxo\nrevestimentos de alto padrao\nmetais e loucas premium\niluminacao de design\nsuperficies especiais\nbanheiro e spa",
        ),
        'field_k13_seo_business_phone' => array(
            'name' => 'seo_business_phone',
            'value' => '(42) 3629-9700',
        ),
        'field_k13_seo_business_whatsapp' => array(
            'name' => 'seo_business_whatsapp',
            'value' => 'https://wa.me/554236299700',
        ),
        'field_k13_seo_address_street' => array(
            'name' => 'seo_address_street',
            'value' => 'Rua Laurindo Richa, 304',
        ),
        'field_k13_seo_address_locality' => array(
            'name' => 'seo_address_locality',
            'value' => 'Guarapuava',
        ),
        'field_k13_seo_address_region' => array(
            'name' => 'seo_address_region',
            'value' => 'PR',
        ),
        'field_k13_seo_address_country' => array(
            'name' => 'seo_address_country',
            'value' => 'BR',
        ),
        'field_k13_seo_service_areas' => array(
            'name' => 'seo_service_areas',
            'value' => "Guarapuava - PR\nCentro-Sul do Parana",
        ),
    );

    foreach ($default_values as $field_key => $field_data) {
        $current_value = get_field($field_data['name'], 'option');
        if (!k13_seo_geo_has_meaningful_value($current_value)) {
            update_field($field_key, $field_data['value'], 'option');
        }
    }

    $business_name = k13_seo_geo_get_text_option('seo_business_name', 'Comtudo Black');
    $site_tagline = k13_seo_geo_get_text_option('seo_site_tagline', 'Acabamentos de luxo, revestimentos premium e design de alto padrao em Guarapuava - PR.');
    $home_title = k13_seo_geo_get_text_option('seo_home_title', 'Comtudo Black | Acabamentos de luxo e alto padrao em Guarapuava - PR');
    $home_description = k13_seo_geo_get_text_option('seo_home_meta_description', 'Comtudo Black em Guarapuava - PR: revestimentos, metais, loucas, iluminacao e superficies especiais para projetos de luxo e alto padrao.');
    $focus_keyphrase = k13_seo_geo_get_text_option('seo_focus_keyphrase', 'acabamentos de luxo em Guarapuava');

    $current_blogname = trim((string) get_option('blogname'));
    if ($current_blogname === '' || strtolower(remove_accents($current_blogname)) === 'comtudoblack') {
        update_option('blogname', $business_name, false);
    }

    $current_blogdescription = trim((string) get_option('blogdescription'));
    if ($current_blogdescription === '') {
        update_option('blogdescription', $site_tagline, false);
    }

    $home_page_id = k13_seo_geo_get_home_page_id();
    if ($home_page_id > 0) {
        $meta_defaults = array(
            '_yoast_wpseo_title' => $home_title,
            '_yoast_wpseo_metadesc' => $home_description,
            '_yoast_wpseo_focuskw' => $focus_keyphrase,
            '_yoast_wpseo_opengraph-title' => $home_title,
            '_yoast_wpseo_opengraph-description' => $home_description,
            '_yoast_wpseo_twitter-title' => $home_title,
            '_yoast_wpseo_twitter-description' => $home_description,
        );

        foreach ($meta_defaults as $meta_key => $meta_value) {
            $current_meta = trim((string) get_post_meta($home_page_id, $meta_key, true));
            if ($current_meta === '') {
                update_post_meta($home_page_id, $meta_key, $meta_value);
            }
        }
    }
}

function k13_boot_seo_geo_seed()
{
    static $did_seed = false;

    if ($did_seed || !function_exists('get_field') || !function_exists('update_field')) {
        return;
    }

    k13_boot_seo_geo_fields();
    $did_seed = true;
    k13_seed_seo_geo_defaults();
}
add_action('acf/init', 'k13_boot_seo_geo_seed', 60);
add_action('init', 'k13_boot_seo_geo_seed', 60);

function k13_filter_wpseo_home_title($title)
{
    if (!is_front_page()) {
        return $title;
    }

    $post_id = k13_seo_geo_get_home_page_id();
    if ($post_id > 0 && trim((string) get_post_meta($post_id, '_yoast_wpseo_title', true)) !== '') {
        return $title;
    }

    return k13_seo_geo_get_text_option('seo_home_title', 'Comtudo Black | Acabamentos de luxo e alto padrao em Guarapuava - PR');
}
add_filter('wpseo_title', 'k13_filter_wpseo_home_title');

function k13_filter_wpseo_metadesc_defaults($description)
{
    if (trim((string) $description) !== '') {
        return $description;
    }

    if (is_front_page()) {
        return k13_seo_geo_get_text_option('seo_home_meta_description', 'Comtudo Black em Guarapuava - PR: revestimentos, metais, loucas, iluminacao e superficies especiais para projetos de luxo e alto padrao.');
    }

    return k13_seo_geo_get_text_option('seo_default_meta_description', 'Acabamentos de luxo em Guarapuava - PR. Revestimentos, metais, loucas, iluminacao e superficies especiais para projetos de alto padrao.');
}
add_filter('wpseo_metadesc', 'k13_filter_wpseo_metadesc_defaults');
add_filter('wpseo_opengraph_desc', 'k13_filter_wpseo_metadesc_defaults');
add_filter('wpseo_twitter_description', 'k13_filter_wpseo_metadesc_defaults');

function k13_filter_wpseo_share_image($image)
{
    if (trim((string) $image) !== '') {
        return $image;
    }

    return k13_seo_geo_get_share_image_url();
}
add_filter('wpseo_opengraph_image', 'k13_filter_wpseo_share_image');
add_filter('wpseo_twitter_image', 'k13_filter_wpseo_share_image');

function k13_build_local_business_schema()
{
    $business_name = k13_seo_geo_get_text_option('seo_business_name', 'Comtudo Black');
    $business_type = k13_seo_geo_get_text_option('seo_business_type', 'HomeGoodsStore');
    $business_summary = k13_seo_geo_get_text_option('seo_business_summary', 'A Comtudo Black e uma loja premium de acabamentos em Guarapuava, com curadoria de revestimentos, metais, loucas, iluminacao e materiais nobres para projetos de alto padrao.');
    $tagline = k13_seo_geo_get_text_option('seo_site_tagline', 'Acabamentos de luxo, revestimentos premium e design de alto padrao em Guarapuava - PR.');
    $phone = k13_seo_geo_get_text_option('seo_business_phone', '(42) 3629-9700');
    $whatsapp = k13_seo_geo_get_text_option('seo_business_whatsapp', '');
    $email = k13_seo_geo_get_text_option('seo_business_email', '');
    $street = k13_seo_geo_get_text_option('seo_address_street', 'Rua Laurindo Richa, 304');
    $locality = k13_seo_geo_get_text_option('seo_address_locality', 'Guarapuava');
    $region = k13_seo_geo_get_text_option('seo_address_region', 'PR');
    $postal_code = k13_seo_geo_get_text_option('seo_address_postal_code', '');
    $country = k13_seo_geo_get_text_option('seo_address_country', 'BR');
    $latitude = k13_seo_geo_get_text_option('seo_geo_latitude', '');
    $longitude = k13_seo_geo_get_text_option('seo_geo_longitude', '');
    $price_range = k13_seo_geo_get_text_option('seo_price_range', '');
    $topics = k13_seo_geo_parse_multiline(k13_seo_geo_get_option('seo_focus_topics', "acabamentos de luxo\nrevestimentos de alto padrao\nmetais e loucas premium\niluminacao de design\nsuperficies especiais\nbanheiro e spa"));
    $service_areas = k13_seo_geo_parse_multiline(k13_seo_geo_get_option('seo_service_areas', "Guarapuava - PR\nCentro-Sul do Parana"));
    $same_as = k13_seo_geo_parse_multiline(k13_seo_geo_get_option('seo_same_as_links', ''));
    $opening_hours_lines = k13_seo_geo_parse_multiline(k13_seo_geo_get_option('seo_opening_hours', ''));
    $share_image_url = k13_seo_geo_get_share_image_url();
    $segments = k13_seo_geo_get_home_field('home_segments_data', array());

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => $business_type !== '' ? $business_type : 'HomeGoodsStore',
        '@id' => home_url('/#localbusiness'),
        'name' => $business_name,
        'url' => home_url('/'),
        'mainEntityOfPage' => home_url('/'),
    );

    if ($business_summary !== '') {
        $schema['description'] = $business_summary;
    }

    if ($tagline !== '') {
        $schema['slogan'] = $tagline;
    }

    if ($share_image_url !== '') {
        $schema['image'] = $share_image_url;
        $schema['logo'] = $share_image_url;
    }

    $phone_schema = k13_seo_geo_normalize_phone_for_schema($phone);
    if ($phone_schema !== '') {
        $schema['telephone'] = $phone_schema;
    }

    if ($email !== '') {
        $schema['email'] = $email;
    }

    if ($price_range !== '') {
        $schema['priceRange'] = $price_range;
    }

    if (!empty($topics)) {
        $schema['knowsAbout'] = $topics;
        $schema['keywords'] = implode(', ', $topics);
    }

    if (!empty($same_as)) {
        $schema['sameAs'] = $same_as;
    }

    if ($street !== '' || $locality !== '' || $region !== '' || $postal_code !== '' || $country !== '') {
        $schema['address'] = array_filter(array(
            '@type' => 'PostalAddress',
            'streetAddress' => $street,
            'addressLocality' => $locality,
            'addressRegion' => $region,
            'postalCode' => $postal_code,
            'addressCountry' => $country,
        ));
    }

    if ($latitude !== '' && $longitude !== '') {
        $schema['geo'] = array(
            '@type' => 'GeoCoordinates',
            'latitude' => $latitude,
            'longitude' => $longitude,
        );
    }

    if (!empty($service_areas)) {
        $schema['areaServed'] = array_values($service_areas);
    }

    if ($phone_schema !== '' || $email !== '' || !empty($service_areas) || $whatsapp !== '') {
        $contact_point = array(
            '@type' => 'ContactPoint',
            'contactType' => 'customer service',
        );

        if ($phone_schema !== '') {
            $contact_point['telephone'] = $phone_schema;
        }

        if ($email !== '') {
            $contact_point['email'] = $email;
        }

        if (!empty($service_areas)) {
            $contact_point['areaServed'] = array_values($service_areas);
        }

        if ($whatsapp !== '') {
            $contact_point['url'] = $whatsapp;
        }

        $schema['contactPoint'] = array($contact_point);
    }

    if (!empty($opening_hours_lines)) {
        $opening_hours = array();

        foreach ($opening_hours_lines as $line) {
            if (!preg_match('/^([A-Za-z]{2}(?:-[A-Za-z]{2})?)\s+(\d{2}:\d{2})-(\d{2}:\d{2})$/', $line, $matches)) {
                continue;
            }

            $days = explode('-', $matches[1]);
            $day_of_week = k13_seo_geo_expand_day_tokens($days);
            if (empty($day_of_week)) {
                continue;
            }

            $opening_hours[] = array(
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => $day_of_week,
                'opens' => $matches[2],
                'closes' => $matches[3],
            );
        }

        if (!empty($opening_hours)) {
            $schema['openingHoursSpecification'] = $opening_hours;
        }
    }

    if (is_array($segments) && !empty($segments)) {
        $catalog_items = array();

        foreach ($segments as $segment) {
            $segment_title = isset($segment['title']) ? trim((string) $segment['title']) : '';
            $segment_items = isset($segment['items']) ? k13_seo_geo_parse_multiline($segment['items']) : array();

            if ($segment_title === '') {
                continue;
            }

            $offers = array();
            foreach ($segment_items as $segment_item) {
                $offers[] = array(
                    '@type' => 'Offer',
                    'itemOffered' => array(
                        '@type' => 'Service',
                        'name' => $segment_item,
                    ),
                );
            }

            $catalog_item = array(
                '@type' => 'OfferCatalog',
                'name' => $segment_title,
            );

            if (!empty($offers)) {
                $catalog_item['itemListElement'] = $offers;
            }

            $catalog_items[] = $catalog_item;
        }

        if (!empty($catalog_items)) {
            $schema['hasOfferCatalog'] = array(
                '@type' => 'OfferCatalog',
                'name' => 'Segmentos ' . $business_name,
                'itemListElement' => $catalog_items,
            );
        }
    }

    return $schema;
}

function k13_render_local_business_schema()
{
    if (is_admin() || !is_front_page()) {
        return;
    }

    $schema = k13_build_local_business_schema();
    if (empty($schema)) {
        return;
    }

    echo '<script type="application/ld+json" class="k13-localbusiness-schema">';
    echo wp_json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
    echo '</script>';
}
add_action('wp_head', 'k13_render_local_business_schema', 35);
