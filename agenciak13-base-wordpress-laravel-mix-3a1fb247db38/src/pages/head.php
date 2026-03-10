<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta charset="UTF-8">
<?php
$post_id = get_queried_object_id();
$seo_title = $post_id ? get_post_meta($post_id, '_yoast_wpseo_title', true) : '';
$document_title = wp_get_document_title();
if ($seo_title) :
?>
    <title>
        <?= wp_title('', false) ?>
    </title>
<?php else : ?>
    <title>
        <?php $title = post_type_archive_title('', false) ? post_type_archive_title('', false) : $document_title; ?>
        <?= $title ? $title . ' | ' :  '' ?><?php bloginfo('name') ?>
    </title>
<?php endif; ?>
<?php wp_head(); ?>

<meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
$image = $post_id ? get_the_post_thumbnail_url($post_id) : '';
if ($image) :
?>
    <meta property="og:image"  content="<?= $image ?>"  />
<?php endif; ?>
<meta property="og:title"  content="<?= esc_attr($document_title ?: get_bloginfo('name')) ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

<!-- Favicon -->
<link rel="apple-touch-icon" sizes="57x57" href="<?= IMAGE_PATH ?>favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?= IMAGE_PATH ?>favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?= IMAGE_PATH ?>favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?= IMAGE_PATH ?>favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?= IMAGE_PATH ?>favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?= IMAGE_PATH ?>favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?= IMAGE_PATH ?>favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?= IMAGE_PATH ?>favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?= IMAGE_PATH ?>favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?= IMAGE_PATH ?>favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?= IMAGE_PATH ?>favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?= IMAGE_PATH ?>favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?= IMAGE_PATH ?>favicon/favicon-16x16.png">
<link rel="manifest" href="<?= IMAGE_PATH ?>favicon/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="<?= IMAGE_PATH ?>favicon/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">
