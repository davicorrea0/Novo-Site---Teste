<?php

/**
 * Versao do bootstrap automatico do tema.
 */
function k13_get_theme_setup_version()
{
    return '2026-03-13-1';
}

/**
 * Procura a melhor candidata para virar a pagina inicial.
 */
function k13_find_front_page_candidate_id()
{
    $template_candidates = get_posts(array(
        'post_type'      => 'page',
        'post_status'    => array('publish', 'draft', 'pending', 'private'),
        'meta_key'       => '_wp_page_template',
        'meta_value'     => 'front-page.php',
        'posts_per_page' => 1,
        'fields'         => 'ids',
    ));

    if (!empty($template_candidates)) {
        return (int) $template_candidates[0];
    }

    foreach (array('home', 'inicio') as $slug) {
        $page = get_page_by_path($slug, OBJECT, 'page');
        if ($page instanceof WP_Post) {
            return (int) $page->ID;
        }
    }

    return 0;
}

/**
 * Garante que existe uma pagina inicial editavel e vinculada ao template correto.
 */
function k13_ensure_static_front_page()
{
    $front_page_id = (int) get_option('page_on_front');
    if ($front_page_id > 0 && get_post_status($front_page_id)) {
        update_option('show_on_front', 'page', false);

        if (get_page_template_slug($front_page_id) !== 'front-page.php') {
            update_post_meta($front_page_id, '_wp_page_template', 'front-page.php');
        }

        return $front_page_id;
    }

    $front_page_id = k13_find_front_page_candidate_id();

    if ($front_page_id <= 0) {
        $front_page_id = wp_insert_post(array(
            'post_title'   => 'Home',
            'post_name'    => 'home',
            'post_status'  => 'publish',
            'post_type'    => 'page',
            'post_content' => '',
        ), true);

        if (is_wp_error($front_page_id)) {
            return 0;
        }
    }

    $front_page_id = (int) $front_page_id;

    if ($front_page_id <= 0) {
        return 0;
    }

    update_post_meta($front_page_id, '_wp_page_template', 'front-page.php');
    update_option('show_on_front', 'page', false);
    update_option('page_on_front', $front_page_id, false);

    if ((int) get_option('page_for_posts') === $front_page_id) {
        update_option('page_for_posts', 0, false);
    }

    return $front_page_id;
}

/**
 * Bootstrap resiliente para ambientes novos ou banco zerado.
 */
function k13_maybe_run_theme_setup()
{
    if (!function_exists('wp_insert_post') || !function_exists('get_page_by_path')) {
        return;
    }

    $setup_version = k13_get_theme_setup_version();
    $current_version = (string) get_option('k13_theme_setup_version', '');
    $front_page_id = (int) get_option('page_on_front');
    $front_page_exists = $front_page_id > 0 && get_post_status($front_page_id);
    $needs_front_page = get_option('show_on_front') !== 'page' || !$front_page_exists;

    if ($current_version === $setup_version && !$needs_front_page) {
        return;
    }

    $configured_front_page_id = k13_ensure_static_front_page();
    if ($configured_front_page_id > 0) {
        update_option('k13_theme_setup_version', $setup_version, false);
    }
}

/**
 * Executa o bootstrap do tema quando ele e ativado.
 */
function k13_run_theme_setup_on_activation()
{
    k13_maybe_run_theme_setup();
}
add_action('after_switch_theme', 'k13_run_theme_setup_on_activation');

/**
 * Reaplica o bootstrap no admin caso o banco tenha sido recriado depois da ativacao.
 */
function k13_maybe_run_theme_setup_in_admin()
{
    if (!is_admin() || !current_user_can('manage_options')) {
        return;
    }

    k13_maybe_run_theme_setup();
}
add_action('admin_init', 'k13_maybe_run_theme_setup_in_admin', 5);

/**
 * Lembra de ativar o Yoast quando o plugin estiver disponivel.
 */
function k13_yoast_seo_admin_notice()
{
    if (!is_admin() || !current_user_can('activate_plugins')) {
        return;
    }

    if (defined('WPSEO_VERSION')) {
        return;
    }

    $plugin_file = WP_PLUGIN_DIR . '/wordpress-seo/wp-seo.php';
    if (!file_exists($plugin_file)) {
        return;
    }

    $screen = function_exists('get_current_screen') ? get_current_screen() : null;
    if (!$screen || !in_array($screen->id, array('dashboard', 'plugins', 'toplevel_page_theme-options', 'theme-options_page_theme-options-seo-geo'), true)) {
        return;
    }

    echo '<div class="notice notice-warning"><p>';
    echo esc_html__('Ative o plugin Yoast SEO para usar os campos SEO e GEO nas meta tags de titulo, descricao e compartilhamento. Sem ele, o site continua funcionando, mas essa camada de SEO nao sera aplicada.', 'comtudo-black');
    echo '</p></div>';
}
add_action('admin_notices', 'k13_yoast_seo_admin_notice');
