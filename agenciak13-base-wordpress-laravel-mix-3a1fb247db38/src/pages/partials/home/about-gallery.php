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
            <h2 class="cb-carousel__title"><?php echo wp_kses_post($carousel_title); ?></h2>

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
    <button id="cb-lightbox-next" class="cb-lightbox__nav cb-lightbox__nav--next" type="button" aria-label="<?php esc_attr_e('PrÃ³xima imagem', 'comtudo-black'); ?>">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <polyline points="9 18 15 12 9 6"></polyline>
        </svg>
    </button>
    <img id="cb-lightbox-img" class="cb-lightbox__img" src="<?php echo esc_url($gallery_images[0]['src']); ?>" alt="Galeria ampliada">
</div>
