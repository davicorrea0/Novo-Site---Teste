<?php

function k13_register_theme_options_pages()
{
    if (!function_exists('acf_add_options_page') || !function_exists('acf_add_options_sub_page')) {
        return;
    }

    acf_add_options_page(array(
        'page_title' => 'Opcoes do Tema',
        'menu_title' => 'Opcoes do Tema',
        'menu_slug' => 'theme-options',
    ));

    acf_add_options_sub_page(array(
        'menu_title' => 'Informacoes',
        'page_title' => 'Informacoes',
        'menu_slug' => 'theme-options-info',
        'parent_slug' => 'theme-options',
    ));

    acf_add_options_sub_page(array(
        'menu_title' => 'Scripts',
        'page_title' => 'Scripts',
        'menu_slug' => 'acf-options-scripts',
        'parent_slug' => 'theme-options',
    ));
}

function k13_boot_theme_options_pages()
{
    static $did_boot = false;

    if ($did_boot || !function_exists('acf_add_options_page') || !function_exists('acf_add_options_sub_page')) {
        return;
    }

    $did_boot = true;
    k13_register_theme_options_pages();
}
add_action('acf/init', 'k13_boot_theme_options_pages', 20);
add_action('init', 'k13_boot_theme_options_pages', 20);

function k13_register_theme_options_fields()
{
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_5ccdc166b39ac',
        'title' => 'Modo',
        'fields' => array(
            array(
                'key' => 'field_5ccdc16e478bd',
                'label' => 'Producao?',
                'name' => 'producao',
                'type' => 'true_false',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => '',
                'default_value' => 0,
                'ui' => 0,
                'ui_on_text' => '',
                'ui_off_text' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-scripts',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_footer_branding',
        'title' => 'Footer',
        'fields' => array(
            array(
                'key' => 'field_footer_smart_link',
                'label' => 'Link da logo Smart',
                'name' => 'footer_smart_link',
                'type' => 'url',
                'instructions' => 'URL usada ao clicar na logo Smart do footer.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50%',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => 'https://',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'theme-options-info',
                ),
            ),
        ),
        'menu_order' => 1,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ));

    acf_add_local_field_group(array(
        'key' => 'group_external_scripts',
        'title' => 'Scripts Externos',
        'fields' => array(
            array(
                'key' => 'field_header',
                'label' => 'Scripts Header',
                'name' => 'scripts_header',
                'type' => 'textarea',
                'prefix' => '',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50%',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
            array(
                'key' => 'field_footer',
                'label' => 'Scripts Footer',
                'name' => 'scripts_footer',
                'type' => 'textarea',
                'prefix' => '',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50%',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
                'readonly' => 0,
                'disabled' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'options_page',
                    'operator' => '==',
                    'value' => 'acf-options-scripts',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
    ));
}

function k13_boot_theme_options_fields()
{
    static $did_boot = false;

    if ($did_boot || !function_exists('acf_add_local_field_group')) {
        return;
    }

    $did_boot = true;
    k13_register_theme_options_fields();
}
add_action('acf/init', 'k13_boot_theme_options_fields', 25);
add_action('init', 'k13_boot_theme_options_fields', 25);
