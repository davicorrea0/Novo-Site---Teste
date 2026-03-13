<section id="sobre" class="cb-about">
    <div class="cb-about__container">
        <div class="cb-about__label">
            <span class="cb-about__label-dot"></span>
            <span class="cb-about__label-text cb-about__label-text--fixed"><?php echo wp_kses_post($about_label); ?></span>
            <span class="cb-about__label-text"><?php echo wp_kses_post($about_label); ?></span>
        </div>

        <div class="cb-about__intro">
            <div class="cb-about__intro-main">
                <h2 class="cb-about__title cb-about__title--fixed">
                    <?php foreach ($about_title_lines as $about_title_line_index => $about_title_line) : ?>
                        <span class="cb-about__title-line<?php echo $about_title_line_index === count($about_title_lines) - 1 ? ' cb-about__title-line--last' : ''; ?>">
                            <span><?php echo wp_kses_post($about_title_line); ?></span>
                        </span>
                    <?php endforeach; ?>
                </h2>
                <div class="cb-about__label">
                    <span class="cb-about__label-dot"></span>
                    <span class="cb-about__label-text"><?php echo wp_kses_post($about_label); ?></span>
                </div>
                <h2 class="cb-about__title"><?php echo wp_kses_post($about_title_plain); ?></h2>
            </div>

            <div class="cb-about__intro-copy">
                <div class="cb-about__desc">
                    <p class="cb-about__text-fixed"><?php echo wp_kses_post($about_texts[0]); ?></p>
                    <p class="cb-about__text-fixed"><?php echo wp_kses_post($about_texts[1]); ?></p>
                    <p><?php echo wp_kses_post($about_texts[0]); ?></p>
                    <p><?php echo wp_kses_post($about_texts[1]); ?></p>
                </div>
            </div>
        </div>

        <div class="row g-4 cb-about__cards">
            <?php foreach ($about_cards as $about_card) : ?>
                <div class="col-12 col-md-6 col-xl-3 cb-about__card-col">
                    <article class="cb-about-card">
                        <div class="cb-about-card__front">
                            <img class="cb-about-card__img" src="<?php echo esc_url($about_card['image']); ?>" alt="<?php echo esc_attr(isset($about_card['image_alt']) ? $about_card['image_alt'] : $about_card['title']); ?>">
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
                                <span><?php echo esc_html($about_card_cta_label); ?></span>
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
            <h2 class="cb-carousel__title cb-carousel__title--fixed">
                <?php foreach ($carousel_title_lines as $carousel_title_line) : ?>
                    <span class="cb-carousel__title-line">
                        <span><?php echo wp_kses_post($carousel_title_line); ?></span>
                    </span>
                <?php endforeach; ?>
            </h2>
            <h2 class="cb-carousel__title"><?php echo wp_kses_post($carousel_title_plain); ?></h2>

            <div class="cb-carousel__nav-btns">
                <button id="cb-carousel-prev" class="cb-carousel__nav-btn" type="button" aria-label="<?php esc_attr_e('Slide anterior', 'comtudo-black'); ?>">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                        <polyline points="15 18 9 12 15 6"></polyline>
                    </svg>
                </button>
                <button id="cb-carousel-next" class="cb-carousel__nav-btn" type="button" aria-label="<?php esc_attr_e('PrÃ³ximo slide', 'comtudo-black'); ?>">
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
                                    <div class="cb-gallery-item__plus" style="background: transparent; box-shadow: none;">
                                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" style="width: clamp(1.1644rem, 1.09rem + 0.46vw, 1.4375rem); height: clamp(1.1644rem, 1.09rem + 0.46vw, 1.4375rem);">
                                            <path d="M7.57643 4.89303H6.45634V3.77329C6.45634 3.41389 6.16391 3.12136 5.80451 3.12136C5.44497 3.12136 5.15253 3.41389 5.15253 3.77329V4.89303H4.03252C3.67305 4.89303 3.38062 5.18557 3.38062 5.54473C3.38062 5.90436 3.67305 6.19666 4.03252 6.19666H5.15253V7.31616C5.15253 7.67604 5.44497 7.96809 5.80451 7.96809C6.16391 7.96809 6.45634 7.67604 6.45634 7.31616V6.19666H7.57643C7.9359 6.19666 8.22826 5.90436 8.22826 5.54473C8.22826 5.18557 7.9359 4.89303 7.57643 4.89303Z" fill="white"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M1.88123 1.6224C4.04438 -0.540678 7.56435 -0.540919 9.72772 1.6224C11.891 3.78499 11.891 7.3047 9.72772 9.4673C8.67974 10.5154 7.28645 11.0921 5.80451 11.0921C4.52687 11.0921 3.31537 10.663 2.33412 9.87326L0.858964 11.3483L0 10.4894L1.47508 9.01452C0.685382 8.03352 0.256124 6.82184 0.256124 5.54473C0.256124 4.06295 0.833241 2.67002 1.88123 1.6224ZM8.86868 8.60856C8.05013 9.42694 6.96196 9.8778 5.80451 9.8778C4.64692 9.8778 3.55875 9.42694 2.74019 8.60856C1.92179 7.79018 1.47106 6.70244 1.47106 5.54473C1.47106 4.38773 1.92179 3.29974 2.74019 2.48137C3.58514 1.63648 4.69464 1.21428 5.80451 1.21428C6.91394 1.21428 8.02396 1.63648 8.86868 2.48137C10.5582 4.17065 10.5582 6.91927 8.86868 8.60856ZM6.45634 4.89303H7.57643C7.9359 4.89303 8.22826 5.18557 8.22826 5.54473C8.22826 5.90436 7.9359 6.19666 7.57643 6.19666H6.45634V7.31616C6.45634 7.67604 6.16391 7.96809 5.80451 7.96809C5.44497 7.96809 5.15253 7.67604 5.15253 7.31616V6.19666H4.03252C3.67305 6.19666 3.38062 5.90436 3.38062 5.54473C3.38062 5.18557 3.67305 4.89303 4.03252 4.89303H5.15253V3.77329C5.15253 3.41389 5.44497 3.12136 5.80451 3.12136C6.16391 3.12136 6.45634 3.41389 6.45634 3.77329V4.89303Z" fill="white"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M6.45634 4.89303H7.57643C7.9359 4.89303 8.22826 5.18557 8.22826 5.54473C8.22826 5.90436 7.9359 6.19666 7.57643 6.19666H6.45634V7.31616C6.45634 7.67604 6.16391 7.96809 5.80451 7.96809C5.44497 7.96809 5.15253 7.67604 5.15253 7.31616V6.19666H4.03252C3.67305 6.19666 3.38062 5.90436 3.38062 5.54473C3.38062 5.18557 3.67305 4.89303 4.03252 4.89303H5.15253V3.77329C5.15253 3.41389 5.44497 3.12136 5.80451 3.12136C6.16391 3.12136 6.45634 3.41389 6.45634 3.77329V4.89303Z" fill="white"/>
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
    <button id="cb-lightbox-next" class="cb-lightbox__nav cb-lightbox__nav--next" type="button" aria-label="<?php esc_attr_e('PrÃ³xima imagem', 'comtudo-black'); ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
    </button>
    <div class="cb-lightbox__viewport">
        <div class="swiper cb-lightbox__swiper">
            <div class="swiper-wrapper">
                <?php foreach ($gallery_images as $gallery_lightbox_image) : ?>
                    <div class="swiper-slide">
                        <img
                            class="cb-lightbox__img"
                            src="<?php echo esc_url($gallery_lightbox_image['src']); ?>"
                            alt="<?php echo esc_attr($gallery_lightbox_image['alt']); ?>"
                        >
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>
