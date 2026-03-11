<?php
/**
 * Template Name: Front Page
 */

get_header();

$hero_image = 'https://images.unsplash.com/photo-1600607686527-6fb886090705?q=80&w=2700&auto=format&fit=crop';
$video_poster = 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=1200&auto=format&fit=crop';
$video_embed_id = 'yBRQuQOdJl8';

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
    'Eliane',
    'Portinari',
    'Kohler',
    'Decortiles',
    'Ceusa',
);

$segment_icons = array(
    'layers'  => '<svg width="40" height="40" viewBox="0 0 86 57" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M28.4 56.7999C27.9 56.7999 27.3 56.5999 26.9 56.1999L0.6 29.8999C-0.2 29.0999 -0.2 27.7999 0.6 26.9999L26.9 0.699854C27.7 -0.100146 29 -0.100146 29.8 0.699854L56.1 26.9999C56.9 27.7999 56.9 29.0999 56.1 29.8999L29.8 56.1999C29.4 56.5999 28.9 56.7999 28.3 56.7999H28.4Z" fill="#2D2D2D"/><path d="M42.4 56.8C41.9 56.8 41.3 56.6 40.9 56.2C40.1 55.4 40.1 54.1 40.9 53.3L65.8 28.4L40.9 3.5C40.1 2.7 40.1 1.4 40.9 0.6C41.7 -0.2 43 -0.2 43.8 0.6L70.1 26.9C70.9 27.7 70.9 29 70.1 29.8L43.8 56.1C43.4 56.5 42.9 56.7 42.3 56.7L42.4 56.8Z" fill="#2D2D2D"/><path d="M56.8 56.8C56.3 56.8 55.7 56.6 55.3 56.2C54.5 55.4 54.5 54.1 55.3 53.3L80.2 28.4L55.3 3.5C54.5 2.7 54.5 1.4 55.3 0.6C56.1 -0.2 57.4 -0.2 58.2 0.6L84.5 26.9C85.3 27.7 85.3 29 84.5 29.8L58.2 56.1C57.8 56.5 57.3 56.7 56.7 56.7L56.8 56.8Z" fill="#2D2D2D"/></svg>',
    'droplet' => '<svg width="40" height="40" viewBox="0 0 45 66" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M27.1 52.8V61.2C27.1 61.5 26.9 61.7 26.6 61.7H17.7V52.3H21.9V46.5C21.3 46 20.9 45.3 20.9 44.4V38.1C20.9 36.7 22.1 35.5 23.5 35.5C24.9 35.5 26.1 36.7 26.1 38.1V44.4C26.1 45.3 25.7 46 25.1 46.5V52.3H26.7C27 52.3 27.2 52.5 27.2 52.8H27.1ZM24.5 0C13.3 0 4.2 9.1 4.2 20.4V41.8H11.5V20.4C11.5 13.2 17.3 7.3 24.5 7.3C31.7 7.3 37.5 13.2 37.5 20.4V23.5C37.5 23.8 37.7 24 38 24H44.3C44.6 24 44.8 23.8 44.8 23.5V20.4C44.8 9.2 35.7 0 24.5 0ZM15.1 43.9H0.5C0.2 43.9 0 44.1 0 44.4V65.3C0 65.6 0.2 65.8 0.5 65.8H15.1C15.4 65.8 15.6 65.6 15.6 65.3V44.4C15.6 44.1 15.4 43.9 15.1 43.9Z" fill="#2D2D2D"/></svg>',
    'light'   => '<svg width="40" height="40" viewBox="0 0 121 121" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M44.9534 30.1694C47.5079 30.5147 52.7371 30.3992 55.465 30.4026L74.218 30.3793C74.3472 32.6644 75.3111 34.4697 76.025 36.6215C79.7204 47.7608 90.4762 54.4608 99.061 61.6214C105.528 67.016 111.933 70.9792 116.318 78.5171C118.658 82.5403 118.967 85.4189 120.32 89.6439C116.416 90.3232 108.079 90.0858 103.813 90.086L75.2677 90.087L25.643 90.0897L10.1261 90.0919C6.88267 90.0915 3.19361 90.1958 0.00718434 89.9048C-0.00728949 89.3995 0.000109308 88.8937 0.0293534 88.389C0.262943 83.5702 1.38175 81.5503 3.92882 77.6079C7.52173 72.0468 11.662 68.827 16.6791 64.7056C19.6818 62.221 22.7071 59.764 25.7548 57.3348C27.2184 56.1865 29.228 54.9096 30.5382 53.639C32.6551 51.2214 35.6489 49.1054 37.6819 46.6774C41.6785 41.9046 44.652 36.3394 44.9534 30.1694Z" fill="#2E2D2D"/><path d="M37.5117 97.1494C38.6891 97.4025 42.5076 97.3668 43.8827 97.3657L53.9106 97.3526L71.304 97.3541C74.4805 97.3541 78.3299 97.445 81.464 97.2669C81.4818 98.2089 81.4935 99.1509 81.4989 100.093C81.5055 101.491 81.5144 103.065 81.0745 104.405C79.8724 108.068 78.0338 111.361 75.3297 114.092C74.5505 114.724 73.7454 115.323 72.9165 115.888C67.96 119.26 63.4582 120.542 57.4769 120.115C51.3384 119.675 44.7776 115.922 41.2823 110.87C38.7556 107.217 36.6191 101.712 37.5117 97.1494Z" fill="#2E2D2D"/><rect x="54" width="12" height="27" fill="#2E2D2D"/></svg>',
    'spa'     => '<svg width="40" height="40" viewBox="0 0 81 67" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M0 42.1L11.4 61.3C13.3 64.5 16.5 66.4 20.2 66.4H63.8C67.5 66.4 70.7 64.6 72.6 61.4L80.7 47.9V42.3C71 40.8 58 44.8 42.9 43.8C26 42.7 15 33.8 0.1 33.7V42L0 42.1ZM19.5 3.3C23.4 2.2 27.7 3.8 29.8 7.5L30.3 8.4L14.7 17.4L14.2 16.5C12.3 13.2 12.7 9.1 15 6.3C14.7 6 14.4 5.8 14 5.7C13.5 5.4 12.9 5.3 12.3 5.3C11.1 5.3 10 5.8 9.3 6.6C8.5 7.4 8 8.5 8 9.6V30.9C6.3 30.6 4.5 30.3 2.7 30.2V9.6C2.7 7 3.8 4.6 5.5 2.8C7.2 1.1 9.6 0 12.3 0C15 0 14.9 0.300001 16.1 0.800001H16.3C17.6 1.4 18.7 2.3 19.6 3.3H19.5Z" fill="#2D2D2D"/></svg>',
    'stone'   => '<svg width="40" height="40" viewBox="0 0 80 74" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M51.8 73.6H24.6L26.7 51.7L59.6 50.4L51.8 73.7V73.6ZM26.5 0H55.5L49.3 13.2L20.3 25.3L26.5 0ZM26.3 47.6L20 29.9L49.6 17.6L59.8 46.2L26.4 47.6H26.3ZM16.9 32.1L23.3 50L21.2 71.5L0.4 49.3L16.9 32.1ZM63 44.3L52.6 15L59 1.4L79.6 24.7L63 44.3ZM22.1 2.4L16 27.3L0 43.9L2.5 16.1L22.1 2.4ZM56.7 70.7L63.9 49.1L79.8 30.3L77.5 56.2L56.7 70.7Z" fill="#2D2D2D"/></svg>',
);

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
$location_map_url = 'https://maps.google.com/maps?q=Rua+Laurindo+Richa,+304,+Guarapuava+-+PR';
$location_map_embed_url = 'https://maps.google.com/maps?q=Rua+Laurindo+Richa,+304,+Guarapuava+-+PR&t=&z=18&ie=UTF8&iwloc=near&output=embed';
$contact_title = 'FALE CONOSCO';
$contact_phone = 'WhatsApp e Telefone: (42) 3629-9700';
$contact_whatsapp_url = 'https://wa.me/554236299700';

if (function_exists('get_field')) {
    $acf_segments_heading = (string) get_field('home_segments_heading', 'option');
    if ($acf_segments_heading !== '') {
        $segments_heading = $acf_segments_heading;
    }

    $acf_brands_heading = (string) get_field('home_brands_heading', 'option');
    if ($acf_brands_heading !== '') {
        $brands_heading = $acf_brands_heading;
    }

    $acf_segments = get_field('home_segments_data', 'option');
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
                $items = array('Conteúdo em atualização.');
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

    $acf_brands = get_field('home_brands_data', 'option');
    if (is_array($acf_brands) && !empty($acf_brands)) {
        $dynamic_brands = array();
        foreach ($acf_brands as $acf_brand) {
            $brand_name = isset($acf_brand['name']) ? trim((string) $acf_brand['name']) : '';
            if ($brand_name !== '') {
                $dynamic_brands[] = $brand_name;
            }
        }

        if (!empty($dynamic_brands)) {
            $brands = $dynamic_brands;
        }
    }

    $acf_gallery = get_field('home_gallery_images', 'option');
    if (is_array($acf_gallery) && !empty($acf_gallery)) {
        $dynamic_gallery_images = array();
        foreach ($acf_gallery as $gallery_image) {
            $src = '';
            if (is_array($gallery_image)) {
                if (!empty($gallery_image['sizes']['large'])) {
                    $src = (string) $gallery_image['sizes']['large'];
                } elseif (!empty($gallery_image['url'])) {
                    $src = (string) $gallery_image['url'];
                }
            }

            if ($src === '') {
                continue;
            }

            $alt = '';
            if (is_array($gallery_image) && !empty($gallery_image['alt'])) {
                $alt = (string) $gallery_image['alt'];
            } elseif (is_array($gallery_image) && !empty($gallery_image['title'])) {
                $alt = (string) $gallery_image['title'];
            }

            if ($alt === '') {
                $alt = 'Projeto';
            }

            $dynamic_gallery_images[] = array(
                'src' => $src,
                'alt' => $alt,
            );
        }

        if (!empty($dynamic_gallery_images)) {
            $gallery_images = $dynamic_gallery_images;
        }
    }

    $acf_location_title = trim((string) get_field('home_location_title', 'option'));
    if ($acf_location_title !== '') {
        $location_title = $acf_location_title;
    }

    $acf_location_subtitle = trim((string) get_field('home_location_subtitle', 'option'));
    if ($acf_location_subtitle !== '') {
        $location_subtitle = $acf_location_subtitle;
    }

    $acf_location_name = trim((string) get_field('home_location_name', 'option'));
    if ($acf_location_name !== '') {
        $location_name = $acf_location_name;
    }

    $acf_location_address = trim((string) get_field('home_location_address', 'option'));
    if ($acf_location_address !== '') {
        $location_address = $acf_location_address;
    }

    $acf_location_directions_url = trim((string) get_field('home_location_directions_url', 'option'));
    if ($acf_location_directions_url !== '') {
        $location_directions_url = $acf_location_directions_url;
    }

    $acf_location_map_url = trim((string) get_field('home_location_map_url', 'option'));
    if ($acf_location_map_url !== '') {
        $location_map_url = $acf_location_map_url;
    }

    $acf_location_map_embed_url = trim((string) get_field('home_location_map_embed_url', 'option'));
    if ($acf_location_map_embed_url !== '') {
        $location_map_embed_url = $acf_location_map_embed_url;
    }

    $acf_contact_title = trim((string) get_field('home_contact_title', 'option'));
    if ($acf_contact_title !== '') {
        $contact_title = $acf_contact_title;
    }

    $acf_contact_phone = trim((string) get_field('home_contact_phone', 'option'));
    if ($acf_contact_phone !== '') {
        $contact_phone = $acf_contact_phone;
    }

    $acf_contact_whatsapp_url = trim((string) get_field('home_contact_whatsapp_url', 'option'));
    if ($acf_contact_whatsapp_url !== '') {
        $contact_whatsapp_url = $acf_contact_whatsapp_url;
    }
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

$svg_allowed = array(
    'svg'  => array(
        'width'            => true,
        'height'           => true,
        'viewbox'          => true,
        'fill'             => true,
        'stroke'           => true,
        'stroke-width'     => true,
        'stroke-linecap'   => true,
        'stroke-linejoin'  => true,
        'xmlns'            => true,
    ),
    'path' => array(
        'fill'      => true,
        'fill-rule' => true,
        'clip-rule' => true,
        'd'         => true,
    ),
    'rect' => array(
        'x'      => true,
        'y'      => true,
        'width'  => true,
        'height' => true,
        'fill'   => true,
    ),
);
?>

<section class="cb-hero" id="cb-hero">
    <div class="cb-hero__bg-split"></div>

    <div class="cb-hero__container">
        <div class="cb-hero__img-wrap">
            <div class="cb-hero__img-animate">
                <img
                    id="cb-hero-img"
                    src="<?php echo esc_url($hero_image); ?>"
                    alt="Comtudo Black"
                    class="cb-hero__img"
                    loading="eager"
                >
            </div>
            <div class="cb-hero__overlay"></div>
        </div>

        <div class="cb-hero__content">
            <div style="max-width: 80rem;">
                <h1 class="cb-hero__title">
                    <span class="cb-hero__title-word">
                        <span class="cb-hero__title-inner cb-hero__title-inner--medium" data-hero-word="1">COMTUDO</span>
                    </span>
                    <span class="cb-hero__title-word">
                        <span class="cb-hero__title-inner cb-hero__title-inner--light" data-hero-word="2">BLACK</span>
                    </span>
                </h1>

                <div class="cb-hero__subtitle-area" id="cb-hero-subtitle">
                    <p class="cb-hero__subtitle">No padrão das suas escolhas.</p>

                    <a href="#sobre" class="cb-hero__cta">
                        <div class="cb-hero__cta-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <polyline points="19 12 12 19 5 12"></polyline>
                            </svg>
                        </div>
                        <span class="cb-hero__cta-text">Saiba Mais</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cb-video">
    <div class="cb-video__container">
        <button id="cb-video-thumbnail" class="cb-video__thumbnail" type="button" aria-label="<?php esc_attr_e('Reproduzir vídeo', 'comtudo-black'); ?>">
            <img class="cb-video__thumb-img" src="<?php echo esc_url($video_poster); ?>" alt="Vídeo Comtudo Black">
            <div class="cb-video__thumb-overlay">
                <div class="cb-video__play-btn">
                    <svg viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                        <path d="M8 5.14v13.72A1 1 0 0 0 9.54 19l8.92-6.86a1 1 0 0 0 0-1.58L9.54 4a1 1 0 0 0-1.54 1.14Z"></path>
                    </svg>
                </div>
            </div>
        </button>

    </div>
</section>

<div id="cb-video-modal" class="cb-video-modal" role="dialog" aria-modal="true" aria-hidden="true" aria-label="<?php esc_attr_e('Video institucional', 'comtudo-black'); ?>">
    <button id="cb-video-modal-close" class="cb-video-modal__close" type="button" aria-label="<?php esc_attr_e('Fechar video', 'comtudo-black'); ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </button>

    <div id="cb-video-modal-dialog" class="cb-video-modal__dialog">
        <div id="cb-video-player" class="cb-video-modal__player" data-video-id="<?php echo esc_attr($video_embed_id); ?>"></div>
    </div>
</div>

<section id="sobre" class="cb-about">
    <div class="cb-about__container">
        <div class="cb-about__label">
            <span class="cb-about__label-dot"></span>
            <span class="cb-about__label-text cb-about__label-text--fixed">SOBRE N&Oacute;S</span>
            <span class="cb-about__label-text">SOBRE NÃ“S</span>
        </div>

        <div class="cb-about__intro">
            <div class="cb-about__intro-main">
                <h2 class="cb-about__title cb-about__title--fixed">
                    <span class="cb-about__title-line">
                        <span>EXCLUSIVIDADE</span>
                        <span>DEIXA</span>
                    </span>
                    <span class="cb-about__title-line">
                        <span>DE SER EXCE&Ccedil;&Atilde;O</span>
                        <span>PARA</span>
                    </span>
                    <span class="cb-about__title-line">
                        <span>SE TORNAR</span>
                        <span>O SEU</span>
                    </span>
                    <span class="cb-about__title-line cb-about__title-line--last">
                        <span>PADR&Atilde;O.</span>
                    </span>
                </h2>
                <div class="cb-about__label">
                    <span class="cb-about__label-dot"></span>
                    <span class="cb-about__label-text">SOBRE NÓS</span>
                </div>
                <h2 class="cb-about__title">EXCLUSIVIDADE DEIXA DE SER EXCEÇÃO PARA SE TORNAR O SEU PADRÃO.</h2>
            </div>

            <div class="cb-about__intro-copy">
                <div class="cb-about__desc">
                    <p class="cb-about__text-fixed">A COMTUDO BLACK &eacute; refer&ecirc;ncia em acabamentos de luxo e alt&iacute;ssima qualidade em Guarapuava, reunindo design contempor&acirc;neo, marcas exclusivas e uma experi&ecirc;ncia pensada nos m&iacute;nimos detalhes.</p>
                    <p class="cb-about__text-fixed">Um espa&ccedil;o premium que oferece acabamentos de alt&iacute;ssima qualidade, assinados por marcas consolidadas e com novidades de mercado.</p>
                    <p>A COMTUDO BLACK é referência em acabamentos de luxo e altíssima qualidade em Guarapuava, reunindo design contemporâneo, marcas exclusivas e uma experiência pensada nos mínimos detalhes.</p>
                    <p>Um espaço premium que oferece acabamentos de altíssima qualidade, assinados por marcas consolidadas e com novidades de mercado.</p>
                </div>
            </div>
        </div>

        <div class="row g-4 cb-about__cards">
            <?php foreach ($about_cards as $about_card) : ?>
                <div class="col-12 col-md-6 col-xl-3 cb-about__card-col">
                    <article class="cb-about-card">
                        <div class="cb-about-card__front">
                            <img class="cb-about-card__img" src="<?php echo esc_url($about_card['image']); ?>" alt="<?php echo esc_attr($about_card['title']); ?>">
                            <div class="cb-about-card__dark-overlay"></div>
                            <div class="cb-about-card__gradient"></div>

                        <div class="cb-about-card__front-content">
                            <div class="cb-about-card__plus">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </div>

                                <h3 class="cb-about-card__title">
                                    <?php foreach ($about_card['title_lines'] as $title_line) : ?>
                                        <span><?php echo esc_html($title_line); ?></span>
                                    <?php endforeach; ?>
                                </h3>
                            </div>
                        </div>

                        <div class="cb-about-card__back">
                            <h3 class="cb-about-card__back-title"><?php echo esc_html($about_card['title']); ?></h3>
                            <p class="cb-about-card__back-desc"><?php echo esc_html($about_card['description']); ?></p>
                            <div class="cb-about-card__back-cta">
                                <span>SAIBA MAIS</span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <line x1="7" y1="17" x2="17" y2="7"></line>
                                    <polyline points="7 7 17 7 17 17"></polyline>
                                </svg>
                            </div>
                        </div>
                    </article>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section class="cb-carousel-section">
    <div class="cb-carousel__wrapper">
        <div class="cb-carousel__header">
            <h2 class="cb-carousel__title">DESCUBRA UM ESPAÇO ONDE ACONTECE A UNIÃO PERFEITA ENTRE DESIGN E LUXO, ONDE CADA DETALHE É PENSADO PARA IMPRESSIONAR.</h2>

            <div class="cb-carousel__nav-btns">
                <button id="cb-carousel-prev" class="cb-carousel__nav-btn" type="button" aria-label="<?php esc_attr_e('Slide anterior', 'comtudo-black'); ?>">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <button id="cb-carousel-next" class="cb-carousel__nav-btn" type="button" aria-label="<?php esc_attr_e('Próximo slide', 'comtudo-black'); ?>">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="9 18 15 12 9 6"></polyline>
                    </svg>
                </button>
            </div>
        </div>

        <div class="cb-carousel__motion">
            <div class="swiper cb-gallery-swiper">
                <div class="swiper-wrapper">
                    <?php foreach ($gallery_images as $gallery_index => $gallery_image) : ?>
                        <div class="swiper-slide">
                            <div
                                class="cb-gallery-item"
                                data-lightbox-index="<?php echo esc_attr($gallery_index); ?>"
                                data-lightbox-src="<?php echo esc_url($gallery_image['src']); ?>"
                                data-lightbox-alt="<?php echo esc_attr($gallery_image['alt']); ?>"
                            >
                                <img class="cb-gallery-item__img" src="<?php echo esc_url($gallery_image['src']); ?>" alt="<?php echo esc_attr($gallery_image['alt']); ?>">
                                <div class="cb-gallery-item__hover">
                                    <div class="cb-gallery-item__plus">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="cb-lightbox" class="cb-lightbox" aria-hidden="true">
    <button id="cb-lightbox-close" class="cb-lightbox__close" type="button" aria-label="<?php esc_attr_e('Fechar imagem', 'comtudo-black'); ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
    </button>
    <button id="cb-lightbox-prev" class="cb-lightbox__nav cb-lightbox__nav--prev" type="button" aria-label="<?php esc_attr_e('Imagem anterior', 'comtudo-black'); ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polyline points="15 18 9 12 15 6"></polyline>
        </svg>
    </button>
    <button id="cb-lightbox-next" class="cb-lightbox__nav cb-lightbox__nav--next" type="button" aria-label="<?php esc_attr_e('Próxima imagem', 'comtudo-black'); ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
    </button>
    <img id="cb-lightbox-img" class="cb-lightbox__img" src="<?php echo esc_url($gallery_images[0]['src']); ?>" alt="Galeria ampliada">
</div>

<section id="segmentos" class="cb-segments">
    <div class="cb-segments__container">
        <h2 class="cb-segments__title"><?php echo $segments_heading_html; ?></h2>

        <div class="cb-segments__grid">
            <?php foreach ($segments as $segment) : ?>
                <article class="cb-segment-card">
                    <div class="cb-segment-card__icon">
                        <?php echo wp_kses($segment_icons[$segment['icon']], $svg_allowed); ?>
                    </div>

                    <div class="cb-segment-card__content">
                        <h3><?php echo esc_html($segment['title']); ?></h3>
                        <ul class="cb-segment-card__list">
                            <?php foreach ($segment['items'] as $segment_item) : ?>
                                <li>
                                    <span class="cb-segment-card__dot" aria-hidden="true"></span>
                                    <span><?php echo esc_html($segment_item); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<section id="marcas" class="cb-brands">
    <div class="cb-brands__container">
        <div class="cb-brands__header">
            <span class="cb-brands__line" aria-hidden="true"></span>
            <h2 class="cb-brands__title"><?php echo esc_html($brands_heading); ?></h2>
            <span class="cb-brands__line" aria-hidden="true"></span>
        </div>

        <div class="cb-brands__marquee">
            <div class="cb-brands__track">
                <?php foreach ($brand_track as $brand_name) : ?>
                    <span class="cb-brands__logo"><?php echo esc_html(strtoupper($brand_name)); ?></span>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="cb-brands__bottom-line" aria-hidden="true"></div>
    </div>
</section>

<section id="localizacao" class="cb-location">
    <div class="cb-location__container">
        <div class="cb-location__header">
            <h2 class="cb-location__title"><?php echo esc_html($location_title); ?></h2>
            <p class="cb-location__subtitle"><?php echo esc_html($location_subtitle); ?></p>
        </div>

        <div class="cb-location__map-wrap">
            <div class="cb-location__map-layer">
                <iframe
                    class="cb-location__map"
                    src="<?php echo esc_url($location_map_embed_url); ?>"
                    title="<?php echo esc_attr(sprintf('Mapa %s', $location_name)); ?>"
                    style="border:0;"
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                ></iframe>
                <div class="cb-location__map-overlay"></div>
            </div>

            <div class="cb-location__card">
                <div class="cb-location__card-inner">
                    <div>
                        <h3 class="cb-location__card-title"><?php echo esc_html($location_name); ?></h3>
                        <p class="cb-location__card-desc"><?php echo $location_address_html; ?></p>
                    </div>

                    <div class="cb-location__links">
                        <a class="cb-location__link cb-location__link--primary" href="<?php echo esc_url($location_directions_url); ?>" target="_blank" rel="noopener noreferrer">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <polygon points="3 11 22 2 13 21 11 13 3 11"></polygon>
                            </svg>
                            <span>Rotas</span>
                        </a>
                        <a class="cb-location__link cb-location__link--ghost" href="<?php echo esc_url($location_map_url); ?>" target="_blank" rel="noopener noreferrer">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M7 17L17 7"></path>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                            <span>Ampliar</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cb-contact" id="contato">
    <div class="cb-contact__container">
        <div class="cb-contact__inner">
            <h2 class="cb-contact__title"><?php echo esc_html($contact_title); ?></h2>

            <div class="cb-contact__row">
                <span class="cb-contact__phone"><?php echo wp_kses($contact_phone_mobile_html, array('br' => array('class' => true))); ?></span>
                <a href="<?php echo esc_url($contact_whatsapp_url); ?>" target="_blank" rel="noopener noreferrer" class="cb-contact__whatsapp" aria-label="<?php esc_attr_e('WhatsApp', 'comtudo-black'); ?>">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
