<?php

function do_footer()
{
    $theme_url = get_template_directory_uri();
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="<?= esc_url($theme_url . mix('/assets/js/script.min.js')) ?>"></script>
    <?php
    if (function_exists('get_field')) {
        echo get_field('scripts_footer', 'options');
    }
}

add_action('wp_footer', 'do_footer');
