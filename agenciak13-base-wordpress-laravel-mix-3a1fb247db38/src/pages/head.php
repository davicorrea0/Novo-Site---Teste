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
