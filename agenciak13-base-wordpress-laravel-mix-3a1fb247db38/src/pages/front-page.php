<?php
/**
 * Template Name: Front Page
 */

get_header();

$k13_get_image_url = static function ($image, $preferred_size = 'large') {
    if (is_array($image)) {
        if (!empty($image['sizes'][$preferred_size])) {
            return (string) $image['sizes'][$preferred_size];
        }

        if (!empty($image['url'])) {
            return (string) $image['url'];
        }
    }

    if (is_string($image) && $image !== '') {
        return $image;
    }

    return '';
};

$k13_get_image_alt = static function ($image, $fallback = '') {
    if (is_array($image)) {
        if (!empty($image['alt'])) {
            return (string) $image['alt'];
        }

        if (!empty($image['title'])) {
            return (string) $image['title'];
        }
    }

    return $fallback;
};

$k13_split_lines = static function ($value) {
    $lines = preg_split('/\r\n|\r|\n/', (string) $value);
    $lines = array_values(array_filter(array_map('trim', (array) $lines)));

    return $lines;
};

$k13_has_meaningful_value = static function ($value) {
    if (is_array($value)) {
        return !empty($value);
    }

    return !in_array($value, array(null, false, ''), true);
};

$home_content_page_id = 0;
if (function_exists('get_queried_object_id')) {
    $home_content_page_id = (int) get_queried_object_id();
}

if ($home_content_page_id <= 0 && function_exists('get_the_ID')) {
    $home_content_page_id = (int) get_the_ID();
}

$k13_get_home_field = static function ($field_name, $default = null) use ($home_content_page_id, $k13_has_meaningful_value) {
    if (!function_exists('get_field')) {
        return $default;
    }

    if ($home_content_page_id > 0) {
        $page_value = get_field($field_name, $home_content_page_id);

        if ($k13_has_meaningful_value($page_value)) {
            return $page_value;
        }
    }

    $option_value = get_field($field_name, 'option');
    if ($k13_has_meaningful_value($option_value)) {
        return $option_value;
    }

    return $default;
};

$k13_get_home_text = static function ($field_name, $default = '') use ($k13_get_home_field) {
    $value = trim((string) $k13_get_home_field($field_name, ''));

    return $value !== '' ? $value : $default;
};

$k13_get_home_image = static function ($field_name, $default_url, $default_alt = '', $preferred_size = 'large') use ($k13_get_home_field, $k13_get_image_url, $k13_get_image_alt) {
    $image = $k13_get_home_field($field_name);
    $image_url = $k13_get_image_url($image, $preferred_size);

    if ($image_url === '') {
        return array(
            'url' => $default_url,
            'alt' => $default_alt,
        );
    }

    return array(
        'url' => $image_url,
        'alt' => $k13_get_image_alt($image, $default_alt),
    );
};

$k13_get_home_toggle = static function ($field_name, $default = true) use ($home_content_page_id) {
    if (!function_exists('get_field')) {
        return $default;
    }

    $has_page_value = false;
    if ($home_content_page_id > 0 && function_exists('metadata_exists')) {
        $has_page_value = metadata_exists('post', $home_content_page_id, $field_name)
            || metadata_exists('post', $home_content_page_id, '_' . $field_name);
    }

    if ($has_page_value) {
        $value = get_field($field_name, $home_content_page_id);

        return !in_array($value, array(0, '0', false), true);
    }

    $option_key = 'options_' . $field_name;
    $option_ref_key = '_options_' . $field_name;
    $has_option_value = get_option($option_key, '__k13_missing__') !== '__k13_missing__'
        || get_option($option_ref_key, '__k13_missing__') !== '__k13_missing__';

    if ($has_option_value) {
        $value = get_field($field_name, 'option');

        return !in_array($value, array(0, '0', false), true);
    }

    return $default;
};

$hero_image = 'https://images.unsplash.com/photo-1600607686527-6fb886090705?q=80&w=2700&auto=format&fit=crop';
$hero_image_alt = 'Comtudo Black';
$hero_title_primary = 'COMTUDO';
$hero_title_secondary = 'BLACK';
$hero_subtitle = 'No padrao das suas escolhas.';
$hero_cta_text = 'Saiba Mais';
$hero_cta_url = '#sobre';
$show_video_section = true;
$video_poster = 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=1200&auto=format&fit=crop';
$video_poster_alt = 'Video Comtudo Black';
$video_embed_id = 'yBRQuQOdJl8';

$about_label = 'SOBRE N&Oacute;S';
$about_title_multiline = "EXCLUSIVIDADE DEIXA\nDE SER EXCE&Ccedil;&Atilde;O PARA\nSE TORNAR O SEU\nPADR&Atilde;O.";
$about_texts = array(
    'A COMTUDO BLACK &eacute; refer&ecirc;ncia em acabamentos de luxo e alt&iacute;ssima qualidade em Guarapuava, reunindo design contempor&acirc;neo, marcas exclusivas e uma experi&ecirc;ncia pensada nos m&iacute;nimos detalhes.',
    'Um espa&ccedil;o premium que oferece acabamentos de alt&iacute;ssima qualidade, assinados por marcas consolidadas e com novidades de mercado.',
);
$about_card_cta_label = 'SAIBA MAIS';
$carousel_title = 'DESCUBRA UM ESPACO ONDE ACONTECE A UNIAO PERFEITA ENTRE DESIGN E LUXO, ONDE CADA DETALHE E PENSADO PARA IMPRESSIONAR.';

$about_cards = array(
    array(
        'title'       => 'Exclusividade',
        'title_lines' => array('Exclusividade'),
        'description' => 'Produtos assinados, itens limitados e marcas de alto destaque.',
        'image'       => 'https://images.unsplash.com/photo-1600607686527-6fb886090705?q=80&w=1200&auto=format&fit=crop',
    ),
    array(
        'title'       => 'Sofisticação',
        'title_lines' => array('Sofisticação'),
        'description' => 'Ambientes projetados para inspirar e elevar o padrão dos seus projetos.',
        'image'       => 'https://images.unsplash.com/photo-1600585154526-990dced4db0d?q=80&w=1200&auto=format&fit=crop',
    ),
    array(
        'title'       => 'Atendimento Personalizado',
        'title_lines' => array('Atendimento', 'Personalizado'),
        'description' => 'Consultoria especializada para atender às suas necessidades com excelência.',
        'image'       => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=1200&auto=format&fit=crop',
    ),
    array(
        'title'       => 'Inovação',
        'title_lines' => array('Inovação'),
        'description' => 'As últimas tendências mundiais em acabamentos e design de interiores.',
        'image'       => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?q=80&w=1200&auto=format&fit=crop',
    ),
);

$gallery_images = array(
    array(
        'src' => 'https://picsum.photos/seed/discover1/1080/1080',
        'alt' => 'Projeto 1',
    ),
    array(
        'src' => 'https://picsum.photos/seed/discover2/1080/1080',
        'alt' => 'Projeto 2',
    ),
    array(
        'src' => 'https://picsum.photos/seed/discover3/1080/1080',
        'alt' => 'Projeto 3',
    ),
    array(
        'src' => 'https://picsum.photos/seed/discover4/1080/1080',
        'alt' => 'Projeto 4',
    ),
    array(
        'src' => 'https://picsum.photos/seed/discover5/1080/1080',
        'alt' => 'Projeto 5',
    ),
);

$segments = array(
    array(
        'icon'  => 'layers',
        'title' => 'REVESTIMENTOS DE ALTO PADRÃO',
        'items' => array(
            'Porcelanatos, grandes formatos, superfícies especiais e texturas exclusivas que transformam ambientes em experiências arquitetônicas.',
            'Materiais que aliam tecnologia, resistência e estética contemporânea.',
        ),
    ),
    array(
        'icon'  => 'droplet',
        'title' => 'METAIS E LOUÇAS PREMIUM',
        'items' => array(
            'Linhas sofisticadas, acabamentos refinados e design funcional que elevam banheiros e cozinhas a outro nível.',
            'Peças que unem precisão, durabilidade e elegância atemporal.',
        ),
    ),
    array(
        'icon'  => 'light',
        'title' => 'ILUMINAÇÃO',
        'items' => array(
            'Soluções que valorizam volumes, texturas e atmosferas.',
            'Luminárias e sistemas que combinam eficiência e design, criando cenários únicos.',
        ),
    ),
    array(
        'icon'  => 'spa',
        'title' => 'BANHEIRO E SPA',
        'items' => array(
            'Elementos que transformam o espaço com elegância.',
            'Design, conforto absoluto e materiais de alta performance.',
            'Modelos exclusivos que se destacam pela funcionalidade e estética.',
        ),
    ),
    array(
        'icon'  => 'stone',
        'title' => 'SUPERFÍCIES ESPECIAIS E MATERIAIS NOBRES',
        'items' => array(
            'Mármores, pedras naturais, texturas e composições que agregam personalidade e autenticidade a cada projeto.',
        ),
    ),
);

$brands = array(
    array(
        'name' => 'Eliane',
        'logo_url' => '',
        'logo_alt' => 'Eliane',
    ),
    array(
        'name' => 'Portinari',
        'logo_url' => '',
        'logo_alt' => 'Portinari',
    ),
    array(
        'name' => 'Kohler',
        'logo_url' => '',
        'logo_alt' => 'Kohler',
    ),
    array(
        'name' => 'Decortiles',
        'logo_url' => '',
        'logo_alt' => 'Decortiles',
    ),
    array(
        'name' => 'Ceusa',
        'logo_url' => '',
        'logo_alt' => 'Ceusa',
    ),
);

$segment_icons = k13_get_home_segment_icons();

/*
 * Conteúdo dinâmico via ACF (opções) com fallback estático.
 */
$segment_icon_fallbacks = array_keys($segment_icons);

$segments_heading = 'O QUE VOCÊ <br> ENCONTRA NA <br> COMTUDO BLACK?';
$brands_heading = 'Marcas e Destaques';
$location_title = 'ONDE ESTAMOS';
$location_subtitle = 'VISITE O ENDEREÇO DA EXCLUSIVIDADE.';
$location_name = 'Comtudo Black';
$location_address = "Rua Laurindo Richa, 304,\nGuarapuava - Paraná";
$location_directions_url = 'https://www.google.com/maps/dir/?api=1&destination=Rua+Laurindo+Richa,+304,+Guarapuava+-+PR';
$location_directions_label = 'Rotas';
$location_map_url = 'https://maps.google.com/maps?q=Rua+Laurindo+Richa,+304,+Guarapuava+-+PR';
$location_map_label = 'Ampliar';
$location_map_embed_url = 'https://maps.google.com/maps?q=Rua+Laurindo+Richa,+304,+Guarapuava+-+PR&t=&z=18&ie=UTF8&iwloc=near&output=embed';
$contact_title = 'FALE CONOSCO';
$contact_phone = 'WhatsApp e Telefone: (42) 3629-9700';
$contact_whatsapp_url = 'https://wa.me/554236299700';

$hero_image_data = $k13_get_home_image('home_hero_image', $hero_image, $hero_image_alt, 'full');
$hero_image = $hero_image_data['url'];
$hero_image_alt = $hero_image_data['alt'];

$hero_title_primary = $k13_get_home_text('home_hero_title_primary', $hero_title_primary);
$hero_title_secondary = $k13_get_home_text('home_hero_title_secondary', $hero_title_secondary);
$hero_subtitle = $k13_get_home_text('home_hero_subtitle', $hero_subtitle);
$hero_cta_text = $k13_get_home_text('home_hero_cta_text', $hero_cta_text);
$hero_cta_url = $k13_get_home_text('home_hero_cta_url', $hero_cta_url);

$show_video_section = $k13_get_home_toggle('home_show_video', $show_video_section);
$video_poster_data = $k13_get_home_image('home_video_poster', $video_poster, $video_poster_alt);
$video_poster = $video_poster_data['url'];
$video_poster_alt = $video_poster_data['alt'];
$video_embed_id = $k13_get_home_text('home_video_embed_id', $video_embed_id);

$about_label = $k13_get_home_text('home_about_label', $about_label);
$about_title_multiline = $k13_get_home_text('home_about_title_multiline', $about_title_multiline);
$about_texts[0] = $k13_get_home_text('home_about_text_1', $about_texts[0]);
$about_texts[1] = $k13_get_home_text('home_about_text_2', $about_texts[1]);
$about_card_cta_label = $k13_get_home_text('home_about_card_cta_label', $about_card_cta_label);
$carousel_title = $k13_get_home_text('home_carousel_title', $carousel_title);

$acf_about_cards = $k13_get_home_field('home_about_cards', array());
if (is_array($acf_about_cards) && !empty($acf_about_cards)) {
    $dynamic_about_cards = array();

    foreach ($acf_about_cards as $acf_about_card) {
        $card_title = isset($acf_about_card['title']) ? trim((string) $acf_about_card['title']) : '';
        if ($card_title === '') {
            continue;
        }

        $card_title_lines = isset($acf_about_card['title_lines']) ? $k13_split_lines($acf_about_card['title_lines']) : array();
        if (empty($card_title_lines)) {
            $card_title_lines = array($card_title);
        }

        $card_description = isset($acf_about_card['description']) ? trim((string) $acf_about_card['description']) : '';
        if ($card_description === '') {
            $card_description = 'Conteudo em atualizacao.';
        }

        $card_image = isset($acf_about_card['image']) ? $acf_about_card['image'] : null;
        $card_image_url = $k13_get_image_url($card_image, 'large');
        if ($card_image_url === '') {
            continue;
        }

        $dynamic_about_cards[] = array(
            'title'       => $card_title,
            'title_lines' => $card_title_lines,
            'description' => $card_description,
            'image'       => $card_image_url,
            'image_alt'   => $k13_get_image_alt($card_image, $card_title),
        );
    }

    if (!empty($dynamic_about_cards)) {
        $about_cards = $dynamic_about_cards;
    }
}

$segments_heading = $k13_get_home_text('home_segments_heading', $segments_heading);
$brands_heading = $k13_get_home_text('home_brands_heading', $brands_heading);

$acf_segments = $k13_get_home_field('home_segments_data', array());
if (is_array($acf_segments) && !empty($acf_segments)) {
    $dynamic_segments = array();

    foreach ($acf_segments as $segment_index => $acf_segment) {
        $icon_slug = isset($acf_segment['icon']) ? sanitize_key((string) $acf_segment['icon']) : '';
        if ($icon_slug === '' || !isset($segment_icons[$icon_slug])) {
            $icon_slug = $segment_icon_fallbacks[$segment_index % count($segment_icon_fallbacks)];
        }

        $title = isset($acf_segment['title']) ? trim((string) $acf_segment['title']) : '';
        if ($title === '') {
            $title = 'SEGMENTO';
        }

        $items_text = isset($acf_segment['items']) ? (string) $acf_segment['items'] : '';
        $items = preg_split('/\r\n|\r|\n/', $items_text);
        $items = array_values(array_filter(array_map('trim', (array) $items)));
        if (empty($items)) {
            $items = array('Conteudo em atualizacao.');
        }

        $dynamic_segments[] = array(
            'icon'  => $icon_slug,
            'title' => $title,
            'items' => $items,
        );
    }

    if (!empty($dynamic_segments)) {
        $segments = $dynamic_segments;
    }
}

$acf_brands = $k13_get_home_field('home_brands_data', array());
if (is_array($acf_brands) && !empty($acf_brands)) {
    $dynamic_brands = array();

    foreach ($acf_brands as $acf_brand) {
        $brand_name = isset($acf_brand['name']) ? trim((string) $acf_brand['name']) : '';
        $brand_logo = isset($acf_brand['logo']) ? $acf_brand['logo'] : null;
        $brand_logo_url = $k13_get_image_url($brand_logo, 'large');
        $brand_logo_alt = $k13_get_image_alt($brand_logo, $brand_name !== '' ? $brand_name : 'Marca');

        if ($brand_logo_url !== '' || $brand_name !== '') {
            $dynamic_brands[] = array(
                'name' => $brand_name,
                'logo_url' => $brand_logo_url,
                'logo_alt' => $brand_logo_alt,
            );
        }
    }

    if (!empty($dynamic_brands)) {
        $brands = $dynamic_brands;
    }
}

$acf_gallery = $k13_get_home_field('home_gallery_images', array());
if (is_array($acf_gallery) && !empty($acf_gallery)) {
    $dynamic_gallery_images = array();

    foreach ($acf_gallery as $gallery_image) {
        $src = $k13_get_image_url($gallery_image, 'large');
        if ($src === '') {
            continue;
        }

        $dynamic_gallery_images[] = array(
            'src' => $src,
            'alt' => $k13_get_image_alt($gallery_image, 'Projeto'),
        );
    }

    if (!empty($dynamic_gallery_images)) {
        $gallery_images = $dynamic_gallery_images;
    }
}

$location_title = $k13_get_home_text('home_location_title', $location_title);
$location_subtitle = $k13_get_home_text('home_location_subtitle', $location_subtitle);
$location_name = $k13_get_home_text('home_location_name', $location_name);
$location_address = $k13_get_home_text('home_location_address', $location_address);
$location_directions_url = $k13_get_home_text('home_location_directions_url', $location_directions_url);
$location_directions_label = $k13_get_home_text('home_location_directions_label', $location_directions_label);
$location_map_url = $k13_get_home_text('home_location_map_url', $location_map_url);
$location_map_label = $k13_get_home_text('home_location_map_label', $location_map_label);
$location_map_embed_url = $k13_get_home_text('home_location_map_embed_url', $location_map_embed_url);
$contact_title = $k13_get_home_text('home_contact_title', $contact_title);
$contact_phone = $k13_get_home_text('home_contact_phone', $contact_phone);
$contact_whatsapp_url = $k13_get_home_text('home_contact_whatsapp_url', $contact_whatsapp_url);
$about_title_lines = $k13_split_lines($about_title_multiline);
if (empty($about_title_lines)) {
    $about_title_lines = array('EXCLUSIVIDADE DEIXA DE SER EXCECAO PARA SE TORNAR O SEU PADRAO.');
}

$about_title_plain = trim(wp_strip_all_tags(str_replace(array("\r\n", "\r", "\n"), ' ', $about_title_multiline)));
if ($about_title_plain === '') {
    $about_title_plain = implode(' ', $about_title_lines);
}

if (empty($gallery_images)) {
    $gallery_images = array(
        array(
            'src' => 'https://picsum.photos/seed/discover1/1080/1080',
            'alt' => 'Projeto 1',
        ),
    );
}

$brand_track = array_merge($brands, $brands, $brands, $brands);
$segments_heading_html = wp_kses(
    str_replace(array("\r\n", "\r", "\n"), '<br>', $segments_heading),
    array('br' => array())
);
$location_address_html = nl2br(esc_html($location_address));
$contact_phone_mobile_html = esc_html($contact_phone);
if (strpos($contact_phone_mobile_html, ': ') !== false) {
    $contact_phone_mobile_html = preg_replace('/: /', ':<br class="d-lg-none"> ', $contact_phone_mobile_html, 1);
}

$svg_allowed = k13_get_home_svg_allowed();

?>
<?php require __DIR__ . '/partials/home/hero-video.php'; ?>
<?php require __DIR__ . '/partials/home/about-gallery.php'; ?>
<?php require __DIR__ . '/partials/home/segments-brands.php'; ?>
<?php require __DIR__ . '/partials/home/location-contact.php'; ?>
<?php get_footer(); ?>
