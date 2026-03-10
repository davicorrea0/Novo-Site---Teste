<?php

function getFeedback()
{
    if (!class_exists('FormMailHelper')) {
        return new WP_REST_Response(array(
            'success' => false,
            'message' => 'Mail helper indisponivel.',
        ), 500);
    }

    $key = array_key_first($_REQUEST);
    if (!$key) {
        return new WP_REST_Response(array(
            'success' => false,
            'message' => 'Parametro invalido.',
        ), 400);
    }

    return new WP_REST_Response(FormMailHelper::feedback($key), 200);
}

add_action('rest_api_init', function () {
    register_rest_route('ajax/v1', '/send-mail', [
        'methods' => 'POST',
        'callback' => 'getFeedback',
        'permission_callback' => '__return_true',
    ]);
});

function loadMoreItems(WP_REST_Request $request)
{
    $data = $request->get_json_params();
    if (!is_array($data)) {
        $data = $request->get_params();
    }

    $post_type = !empty($data['type']) ? sanitize_key($data['type']) : 'itens';
    $page = !empty($data['pagina']) ? max(1, absint($data['pagina'])) : 1;
    $status = isset($data['status']) ? sanitize_text_field($data['status']) : '';

    $meta_query = [];
    if ($status !== '') {
        $meta_query[] = [
            'key' => 'about_finished',
            'value' => $status,
            'compare' => '=',
        ];
    }

    $args = [
        'post_type' => $post_type,
        'post_status' => 'publish',
        'posts_per_page' => 8,
        'orderby' => 'post_date',
        'order' => 'DESC',
        'paged' => $page,
    ];

    if (!empty($meta_query)) {
        $args['meta_query'] = $meta_query;
    }

    $wp_query = new WP_Query($args);
    $maxPages = $wp_query->max_num_pages;
    $type = $post_type;
    $items = $wp_query->get_posts();
    $pagination = Helper::getAjaxPagination($page, $maxPages);

    if (empty($items)) {
        return new WP_REST_Response(array(
            'success' => false,
            'message' => 'Nenhum produto encontrado.',
        ), 404);
    }

    $posts = [];
    foreach ($items as $item) {
        $posts[] = [
            'title' => get_the_title($item->ID),
            'image' => get_the_post_thumbnail_url($item->ID),
            'url' => get_the_permalink($item->ID),
            'type' => $type,
            'status' => $status,
        ];
    }

    return new WP_REST_Response([
        'success' => true,
        'items' => $posts,
        'pagination' => $pagination,
    ], 200);
}

add_action('rest_api_init', function () {
    register_rest_route('ajax/v1', '/send-type', [
        'methods' => ['POST', 'GET'],
        'callback' => 'loadMoreItems',
        'permission_callback' => '__return_true',
    ]);
});
