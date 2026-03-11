<?php
/* Maintain compatibility if image optimization plugin is not active/installed */
if (!function_exists('optimize_media')) {
    function optimize_media($arg, ...$args) {
        return $arg;
    }
}

/* Include files */
foreach (glob(get_template_directory() . '/inc/post_types/*.php') as $file)
    include_once $file;

/* Include files */
foreach (glob(get_template_directory() . '/inc/ajax/*.php') as $file)
    include_once $file;


/* Starts session, if it doesn't exist */
if (session_id() == '')
    session_start();


/** ---------------------------------------------------- *
Plugin Name: Advanced Custom Fields Pro
Plugin URI: http://www.advancedcustomfields.com/
Description: Customise WordPress with powerful, professional and intuitive fields
Version: 5.3.6.1
Author: elliot condon
Author URI: http://www.elliotcondon.com/
Copyright: Elliot Condon
Text Domain: acf
Domain Path: /lang
 */
add_filter('acf/settings/path', 'my_acf_settings_path');
function my_acf_settings_path($path)
{
    $path = get_stylesheet_directory() . '/plugins/__acfpro/';
    return $path;
}
add_filter('acf/settings/dir', 'my_acf_settings_dir');
function my_acf_settings_dir($dir)
{
    $dir = get_stylesheet_directory_uri() . '/plugins/__acfpro/';
    return $dir;
}
include_once (get_stylesheet_directory() . '/plugins/__acfpro/acf.php');
//add_filter('acf/settings/show_admin', '__return_false');

include_once (get_stylesheet_directory() . '/plugins/acf-custom/acf-custom.php');


/* ---------------------------------------------------- *
Plugin Name: Rocket Plug
Description: Modifica a aparência do Wordpress, removendo algumas funcionalidades e adicionando outras.
Version: 3.0
Author: Thiago Alexandre de Assis
License: Copyright todos os direitos reservados para Thiago Alexandre de Assis
Author URI: http://www.thiagoalexandre.me
*/
if (class_exists('acf')) {
    if (get_field('creative_theme_active', 'options') != 'Desativado') {
        foreach (glob(get_template_directory() . '/plugins/__rocketplug/*.php') as $incluir_arquivo) {
            if (!strpos($incluir_arquivo, '-amostra')) {
                include_once $incluir_arquivo;
            }
        }
    }
}

/* ---------------------------------------------------- *
Plugin Name: WP Mail Form
Description: Plugin WordPress para automatizar formulários que enviam email usando PHP Mailer.
Version: 2.0
Author: Euclécio Josias Rodrigues
License: MIT License
Author URI: https://defaultjosias.com
*/
include_once get_template_directory() . '/plugins/wp-mail-form/mail-form.php';

foreach (glob(get_template_directory() . '/inc/helpers/*.php') as $file)
    include_once $file;

foreach (glob(get_template_directory() . '/inc/filters/*.php') as $file)
    include_once $file;

foreach (glob(get_template_directory() . '/inc/actions/*.php') as $file)
    include_once $file;


/* ---------------------------------------------------- *
Description: Removendo scripts wp-embed.min.js e comment-reply.min.js do wp_footer().
*/
function my_dequeue_scripts()
{
    wp_dequeue_script('wp-embed');
    wp_dequeue_script('comment-reply');
}
add_action('wp_footer', 'my_dequeue_scripts');

function my_acf_google_map_api($api)
{
    $api['key'] = 'AIzaSyDwZhbgWDatTiVdXJgKM-2iCYErJJo8Su0';
    return $api;
}

add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');


/**
 *  Register menus to theme
 */
function register_my_menus()
{
    register_nav_menus(
        array(
            'header-menu' => __('Header Menu'),
            'extra-menu' => __('Extra Menu')
        )
    );
}
add_action('init', 'register_my_menus');

/**
 *  Clean 
 */

function clean_wp_head()
{
    wp_dequeue_style('wp-block-library');
    wp_dequeue_style('global-styles');
    wp_dequeue_style('classic-theme-styles');
}

add_action('wp_enqueue_scripts', 'clean_wp_head', 100);
remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);



