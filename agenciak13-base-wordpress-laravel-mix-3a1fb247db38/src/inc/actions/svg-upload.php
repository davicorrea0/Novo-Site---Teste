<?php

function k13_allow_svg_uploads($mimes)
{
    if (!is_array($mimes)) {
        $mimes = array();
    }

    $mimes['svg'] = 'image/svg+xml';

    return $mimes;
}

add_filter('upload_mimes', 'k13_allow_svg_uploads');

function k13_fix_svg_filetype($data, $file, $filename, $mimes, $real_mime = '')
{
    $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

    if ($ext !== 'svg') {
        return $data;
    }

    $data['ext'] = 'svg';
    $data['type'] = 'image/svg+xml';
    $data['proper_filename'] = $filename;

    return $data;
}

add_filter('wp_check_filetype_and_ext', 'k13_fix_svg_filetype', 10, 5);
