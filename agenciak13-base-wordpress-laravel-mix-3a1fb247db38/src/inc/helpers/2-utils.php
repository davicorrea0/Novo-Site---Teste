<?php

function get_url()
{
    return get_bloginfo("url");
}

function ratb_tiny_mce_buttons_justify($buttons_array)
{

    if (!in_array('alignjustify', $buttons_array) && in_array('alignright', $buttons_array)) {
        $key = array_search('alignright', $buttons_array);
        $inserted = array('alignjustify');
        array_splice($buttons_array, $key + 1, 0, $inserted);
    }

    return $buttons_array;
}

add_filter('mce_buttons', 'ratb_tiny_mce_buttons_justify', 5);

function cortar_texto($text, $limit = 150)
{
    $text = strip_tags(preg_replace("/\[.+?\]/", "", $text));
    if (strlen($text) > $limit) {
        $text = substr($text, 0, strrpos(substr($text, 0, $limit), ' ')) . '...';
    }
    return $text;
}
add_theme_support('post-thumbnails');
add_theme_support('site-icon');

function remove_comments()
{        //Posts
    remove_menu_page('edit-comments.php');          //Comments
}
add_action('admin_menu', 'remove_comments');
function remove_admin_pages()
{
    //remove_menu_page( 'index.php' );                  //Dashboard
    //remove_menu_page( 'jetpack' );                    //Jetpack*
    //remove_menu_page( 'upload.php' );                 //Media
    //remove_menu_page( 'edit.php?post_type=page' );    //Pages
    remove_menu_page('themes.php');                 //Appearance
    //remove_menu_page( 'plugins.php' );                //Plugins
    //remove_menu_page( 'users.php' );                  //Users
    remove_menu_page('tools.php');                  //Tools
    remove_menu_page('options-general.php');        //Settings
}
if (get_field('producao', 'options')) {
    add_filter('acf/settings/show_admin', '__return_false');
    add_action('admin_menu', 'remove_admin_pages');
}

function get_referer($path = '')
{
    return wp_get_referer() ? wp_get_referer() : get_bloginfo('url') . $path;
}

function clear_number($number)
{
    return preg_replace('/\D+/', '', $number);
}

function or_default($imge)
{
    return $imge ? $imge : IMAGE_PATH . 'default.png';
}


function get_youtube_id($url = "")
{
    preg_match("/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:watch\?v=|shorts\/|embed\/|v\/|.+\?v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/", $url, $matches);
    return (end($matches));
}

function get_instagram_post_id($url)
{
    $path = parse_url($url, PHP_URL_PATH);
    if (!$path) {
        return null;
    }
    
    $segments = explode('/', trim($path, '/'));

    if (count($segments) >= 2 && in_array($segments[0], ['reel', 'p'], true)) {
        return $segments[1];
    }
    
    return null;
}

function append_footer_script($path = "#")
{
    add_action('wp_footer', function () use ($path) {
        echo "<script src='" . $path . "'></script>";
    });
}

function agroup_nav_menu($key)
{

    $menu_items = wp_get_nav_menu_items($key) ?: [];
    $menu = [];
    foreach ($menu_items as $key => $item) {
        if ($item->menu_item_parent) {
            continue;
        }
        $menu[$item->ID] = (object) [
            'url' => $item->url,
            'title' => $item->title,
            'active' => $item->object_id == get_the_ID(),
            'childs' => []
        ];
        unset($menu_items[$key]);
    }

    foreach ($menu_items as $item) {
        if ($item->type === 'taxonomy') {
        } else {
            $menu[$item->menu_item_parent]->childs[] = (object) [
                'title' => $item->title,
                'url' => $item->url,
                'id' => $item->ID,
            ];
            if ($item->object_id == get_the_ID()) {
                $menu[$item->menu_item_parent]->active = true;
            }
        }
    }
    return $menu;
}

function get_whatsapp_message($number, $message = '')
{
    $encodedCleanNumber = urlencode(clear_number($number));
    $encodedMessage = urlencode($message);
    $url =  "https://api.whatsapp.com/send/?phone=55" . $encodedCleanNumber . "&text=" . $encodedMessage;
    return $url;
}
