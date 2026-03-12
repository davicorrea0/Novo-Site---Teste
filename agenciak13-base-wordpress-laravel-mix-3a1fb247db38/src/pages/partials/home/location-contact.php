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
                            <span><?php echo esc_html($location_directions_label); ?></span>
                        </a>
                        <a class="cb-location__link cb-location__link--ghost" href="<?php echo esc_url($location_map_url); ?>" target="_blank" rel="noopener noreferrer">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                <path d="M7 17L17 7"></path>
                                <polyline points="7 7 17 7 17 17"></polyline>
                            </svg>
                            <span><?php echo esc_html($location_map_label); ?></span>
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
