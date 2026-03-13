<?php

/**
 * Sincroniza grupos ACF locais adicionais para o cadastro interno do ACF.
 */
function k13_import_local_field_group_by_key($group_key, $sync_option_key)
{
    if (
        !function_exists('acf_import_field_group')
        || !function_exists('acf_get_field_group_post')
        || !function_exists('acf_get_local_field_group')
        || !function_exists('acf_get_local_fields')
    ) {
        return;
    }

    $local_group = acf_get_local_field_group($group_key);
    if (!$local_group) {
        return;
    }

    $local_fields = acf_get_local_fields($group_key);
    if (!is_array($local_fields) || empty($local_fields)) {
        return;
    }

    $local_group['fields'] = array_values($local_fields);

    $existing_group_post = acf_get_field_group_post($group_key);
    if ($existing_group_post) {
        $local_group['ID'] = (int) $existing_group_post->ID;
    }

    $sync_hash = md5(wp_json_encode($local_group));
    if ($existing_group_post && get_option($sync_option_key) === $sync_hash) {
        return;
    }

    acf_import_field_group($local_group);
    update_option($sync_option_key, $sync_hash, false);
}

/**
 * Mantem visiveis no admin os grupos locais registrados fora da home.
 */
function k13_import_additional_local_field_groups_to_acf()
{
    static $did_sync = false;

    if ($did_sync) {
        return;
    }

    $did_sync = true;

    $groups_to_sync = array(
        'group_k13_seo_geo_options' => 'k13_seo_geo_group_sync_hash',
        'group_5ccdc166b39ac' => 'k13_theme_mode_group_sync_hash',
        'group_footer_branding' => 'k13_footer_branding_group_sync_hash',
        'group_external_scripts' => 'k13_external_scripts_group_sync_hash',
    );

    foreach ($groups_to_sync as $group_key => $sync_option_key) {
        k13_import_local_field_group_by_key($group_key, $sync_option_key);
    }
}
add_action('admin_init', 'k13_import_additional_local_field_groups_to_acf', 35);
