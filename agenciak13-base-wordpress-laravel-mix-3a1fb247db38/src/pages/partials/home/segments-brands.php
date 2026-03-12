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
                <?php foreach ($brand_track as $brand_item) : ?>
                    <?php
                    $brand_name = is_array($brand_item) ? (string) ($brand_item['name'] ?? '') : (string) $brand_item;
                    $brand_logo_url = is_array($brand_item) ? (string) ($brand_item['logo_url'] ?? '') : '';
                    $brand_logo_alt = is_array($brand_item) ? (string) ($brand_item['logo_alt'] ?? $brand_name) : $brand_name;
                    ?>
                    <span class="cb-brands__logo<?php echo $brand_logo_url !== '' ? ' cb-brands__logo--image' : ''; ?>">
                        <?php if ($brand_logo_url !== '') : ?>
                            <img class="cb-brands__logo-image" src="<?php echo esc_url($brand_logo_url); ?>" alt="<?php echo esc_attr($brand_logo_alt); ?>">
                        <?php else : ?>
                            <?php echo esc_html(strtoupper($brand_name)); ?>
                        <?php endif; ?>
                    </span>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="cb-brands__bottom-line" aria-hidden="true"></div>
    </div>
</section>
