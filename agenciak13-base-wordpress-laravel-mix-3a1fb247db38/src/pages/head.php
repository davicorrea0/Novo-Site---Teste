<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<script>
    (function () {
        var resetScroll = function () {
            window.scrollTo(0, 0);
            document.documentElement.scrollTop = 0;
            document.body.scrollTop = 0;
        };

        if ('scrollRestoration' in window.history) {
            window.history.scrollRestoration = 'manual';
        }

        resetScroll();
        window.addEventListener('pageshow', resetScroll);
        window.addEventListener('beforeunload', resetScroll);
    }());
</script>
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
