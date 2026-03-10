<?php
/**
 * Template Name: Front Page
 */

get_header();

$hero_image = 'https://images.unsplash.com/photo-1600607686527-6fb886090705?q=80&w=2700&auto=format&fit=crop';
$video_poster = 'https://images.unsplash.com/photo-1618221195710-dd6b41faaea6?q=80&w=2500&auto=format&fit=crop';
$video_src = 'https://cdn.plyr.io/static/demo/View_From_A_Blue_Moon_Trailer-576p.mp4';

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
    'layers'  => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3 3 7.5 12 12l9-4.5L12 3Z"/><path d="M3 12.5 12 17l9-4.5"/><path d="M3 17.5 12 22l9-4.5"/></svg>',
    'droplet' => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2s5.5 5.8 5.5 10A5.5 5.5 0 1 1 6.5 12C6.5 7.8 12 2 12 2Z"/><path d="M9.5 13.5A2.5 2.5 0 0 0 12 16"/></svg>',
    'light'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M9 18h6"/><path d="M10 22h4"/><path d="M12 2a6 6 0 0 0-3.6 10.8c.8.6 1.6 1.8 1.6 3.2h4c0-1.4.8-2.6 1.6-3.2A6 6 0 0 0 12 2Z"/></svg>',
    'spa'     => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M7 13a5 5 0 0 1 10 0v5H7v-5Z"/><path d="M5 18h14"/><path d="M9 7c0 1.3-1 2.3-2.3 2.3S4.5 8.3 4.5 7 5.5 4.7 6.7 4.7 9 5.7 9 7Z"/><path d="M19.5 7c0 1.3-1 2.3-2.2 2.3S15 8.3 15 7s1-2.3 2.3-2.3S19.5 5.7 19.5 7Z"/></svg>',
    'stone'   => '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round"><path d="M4 8.5 12 3l8 5.5V18l-8 3-8-3V8.5Z"/><path d="M12 21V12"/><path d="M4 8.5 12 13l8-4.5"/></svg>',
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
        'viewbox'          => true,
        'fill'             => true,
        'stroke'           => true,
        'stroke-width'     => true,
        'stroke-linecap'   => true,
        'stroke-linejoin'  => true,
        'xmlns'            => true,
    ),
    'path' => array(
        'd' => true,
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

        <div id="cb-video-player" class="cb-video__player" hidden>
            <video id="cb-plyr-video" controls playsinline poster="<?php echo esc_url($video_poster); ?>" class="w-100">
                <source src="<?php echo esc_url($video_src); ?>" type="video/mp4">
            </video>
        </div>
    </div>
</section>

<section id="sobre" class="cb-about">
    <div class="cb-about__container">
        <div class="row g-5 align-items-start mb-5">
            <div class="col-12 col-lg-5">
                <div class="cb-about__label">
                    <span class="cb-about__label-dot"></span>
                    <span class="cb-about__label-text">SOBRE NÓS</span>
                </div>
                <h2 class="cb-about__title">EXCLUSIVIDADE DEIXA DE SER EXCEÇÃO PARA SE TORNAR O SEU PADRÃO.</h2>
            </div>

            <div class="col-12 col-lg-7">
                <div class="cb-about__desc">
                    <p>A COMTUDO BLACK é referência em acabamentos de luxo e altíssima qualidade em Guarapuava, reunindo design contemporâneo, marcas exclusivas e uma experiência pensada nos mínimos detalhes.</p>
                    <p>Um espaço premium que oferece acabamentos de altíssima qualidade, assinados por marcas consolidadas e com novidades de mercado.</p>
                </div>
            </div>
        </div>

        <div class="row g-4">
            <?php foreach ($about_cards as $about_card) : ?>
                <div class="col-12 col-md-6 col-xl-3">
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
