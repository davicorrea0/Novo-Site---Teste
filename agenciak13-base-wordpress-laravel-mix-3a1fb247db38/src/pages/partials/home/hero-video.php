<section class="cb-hero" id="cb-hero">
    <div class="cb-hero__bg-split"></div>

    <div class="cb-hero__container">
        <div class="cb-hero__img-wrap">
            <div class="cb-hero__img-animate">
                <img
                    id="cb-hero-img"
                    src="<?php echo esc_url($hero_image); ?>"
                    alt="<?php echo esc_attr($hero_image_alt); ?>"
                    class="cb-hero__img"
                    loading="eager"
                >
            </div>
            <div class="cb-hero__overlay"></div>
        </div>

        <div class="cb-hero__content">
            <div class="cb-hero__content-inner">
                <h1 class="cb-hero__title">
                    <span class="cb-hero__title-word">
                        <span class="cb-hero__title-inner cb-hero__title-inner--medium" data-hero-word="1"><?php echo esc_html($hero_title_primary); ?></span>
                    </span>
                    <span class="cb-hero__title-word">
                        <span class="cb-hero__title-inner cb-hero__title-inner--light" data-hero-word="2"><?php echo esc_html($hero_title_secondary); ?></span>
                    </span>
                </h1>

                <div class="cb-hero__subtitle-area" id="cb-hero-subtitle">
                    <p class="cb-hero__subtitle"><?php echo esc_html($hero_subtitle); ?></p>

                    <a href="<?php echo esc_url($hero_cta_url); ?>" class="cb-hero__cta">
                        <div class="cb-hero__cta-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <polyline points="19 12 12 19 5 12"></polyline>
                            </svg>
                        </div>
                        <span class="cb-hero__cta-text"><?php echo esc_html($hero_cta_text); ?></span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if ($show_video_section) : ?>
<section class="cb-video">
    <div class="cb-video__container">
        <button id="cb-video-thumbnail" class="cb-video__thumbnail" type="button" aria-label="<?php esc_attr_e('Reproduzir vÃ­deo', 'comtudo-black'); ?>">
            <img class="cb-video__thumb-img" src="<?php echo esc_url($video_poster); ?>" alt="<?php echo esc_attr($video_poster_alt); ?>">
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
<?php endif; ?>
