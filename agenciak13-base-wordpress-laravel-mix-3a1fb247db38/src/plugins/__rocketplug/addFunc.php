<?php

/////////////////////////////////////////////////////////////////////////////////////////////
            /// ADD NAME IN HEADER ///

add_action('admin_bar_menu', 'logo_prestadora', 999);
function logo_prestadora($wp_admin_bar){

    $logo_prestadora = array(
        'id'    => 'logo_prestadora',
        'meta'  => array( 'html' => '<div id="nomeEmpresaX"></div>'),
    );

    $linkSite = array(
        'id'    => 'linkSite',
        'meta'  => array( 'html' => '<a href="' .get_bloginfo("url"). '" target="_blank" class="effectD" id="linkSite">Visitar o site</a>'),
    );

    $tutorial = array(
        'id'    => 'tutorial',
        'meta'  => array( 'html' => '<a href="' .get_bloginfo("url"). '" target="_blank" class="effectD" id="tutorial"><span>Tutorial em Vídeo</span></a>'),
    );

    $wp_admin_bar->add_node( $logo_prestadora );
    $wp_admin_bar->add_node( $linkSite );
    //$wp_admin_bar->add_node( $tutorial );
}

/////////////////////////////////////////////////////////////////////////////////////////////
            /// MODIFICA ESTILO ///

function modificacao_aparencia_wordpress(){
    wp_register_style('robotoGoogle', 'https://fonts.googleapis.com/css?family=Roboto+Condensed:400,700');
    wp_enqueue_style('robotoGoogle');
    wp_register_style('custom_wp_admin_css', get_template_directory_uri() . '/plugins/__rocketplug/css/estilo.css');
    wp_enqueue_style('custom_wp_admin_css');
    wp_register_style('fontawesome_css', get_template_directory_uri() . '/plugins/__rocketplug/fontAwesome/css/font-awesome.min.css');
    wp_enqueue_style('fontawesome_css');
}
add_action('admin_enqueue_scripts', 'modificacao_aparencia_wordpress');

/*/////////////////////////////////////////////////////////////////////////////////////////////
            /// MODIFICA A LOGIN AREA /// */

function chr_style_personalizado(){ ?>
    <style>
        body.login {background: #222;}
        .login form {background:none;box-shadow:none;}
        .login h1 a {display:none;}
        .login label {color: #72777c;}
        .login #nav {color: #C1C1C1;}
        .wp-core-ui .button-primary {background-color: #3360b1;text-shadow: none;border:none;box-shadow: none;}
        .wp-core-ui .button-primary:hover {background-color: #1c3664;}
        body.login div#login h1 a {
            background-image: url('https://k13.com.br/logo-k13.svg');
            margin: 0;
            background-size: 320px;
            background-position: center;
            height: 170px;
            width: auto; }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'chr_style_personalizado' );
