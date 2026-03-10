<?php

add_action('admin_bar_menu', 'wp_logo', 999); 			/// REMOVE LOGO WP
function wp_logo($wp_admin_bar){						///
	$wp_admin_bar->remove_node('wp-logo');				///
}														///

add_action('admin_bar_menu', 'site_name', 999); 		/// REMOVE NOME COM LINK
function site_name($wp_admin_bar){						///
    $wp_admin_bar->remove_node('site-name');			///
}														///

add_action('admin_bar_menu', 'view', 999); 				/// REMOVE VISUALIZAR SITE
function view( $wp_admin_bar ) {						///
    $wp_admin_bar->remove_node('view');					///
}														///

add_action('admin_bar_menu', 'updates', 999); 			/// REMOVE ICONE DE LOCALIZAÇÃO
function updates($wp_admin_bar){						///
    $wp_admin_bar->remove_node('updates');				///
}														///

add_action('admin_menu','wphidenag');					///
function wphidenag(){									///
	remove_action('admin_notices', 'update_nag', 3);	///
}														///

add_action( 'admin_bar_menu', 'new_content', 999 ); 	/// REMOVE ADICIONAR NOVA PÁGINA
function new_content($wp_admin_bar){					///
    $wp_admin_bar->remove_node('new-content');			///
}														///

add_action('admin_bar_menu', 'comments', 999); 			/// REMOVE COMENTÁRIOS ICONE
function comments($wp_admin_bar){						///
    $wp_admin_bar->remove_node('comments');				///
}														///

add_filter( 'show_admin_bar', '__return_false' );  		/// REMOVE BARRA DO SITE

function meu_footer_css(){								/// REMOVE FRASE RODAPÉ
    echo '
    <style type="text/css">
        #footer-upgrade {visibility:hidden !important;}
        #footer-left {float:right !important;}
    </style>';
}
add_action('admin_head', 'meu_footer_css');
function meu_footer_admin(){
    echo '';
}
add_filter('admin_footer_text', 'meu_footer_admin');


/////////////////////////////////////////////////////////////////////////////////////////////
			/// REMOVE DASHBOARD ITENS ///

add_action('wp_dashboard_setup', 'remove_dashboard_widgets');
function remove_dashboard_widgets(){
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal');
    remove_meta_box('dashboard_plugins', 'dashboard', 'normal');
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side');
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side');
    remove_meta_box('dashboard_primary', 'dashboard', 'side');
    remove_meta_box('dashboard_secondary', 'dashboard', 'side');
    if(class_exists('acf')){
        if(have_rows('blocos_visiveis', 'options')):
                while (have_rows('blocos_visiveis', 'options')) : the_row();
                    if(get_sub_field('item_painel') == 'Últimos Posts com Comentário'){} else {remove_meta_box('dashboard_activity', 'dashboard', 'normal');}
                endwhile;
            else :
                remove_meta_box('dashboard_activity', 'dashboard', 'normal');
        endif;
    }
    remove_action('welcome_panel', 'wp_welcome_panel');
}

add_action('add_meta_boxes', 'remove_post_widgets');
function remove_post_widgets(){
    remove_meta_box('commentsdiv', 'post', 'normal');
    remove_meta_box('revisionsdiv', 'post', 'normal');
    remove_meta_box('authordiv', 'post', 'normal');
    remove_meta_box('slugdiv', 'post', 'normal');
    remove_meta_box('trackbacksdiv', 'post', 'normal');
    remove_meta_box('submitdiv', 'post', 'normal');
    if (!current_user_can('level_10')){
        remove_meta_box('pageparentdiv', 'page', 'side');
    }
}

add_action('init', 'remove_pages_editor');
function remove_pages_editor(){
    remove_post_type_support('page', 'editor');
}

/////////////////////////////////////////////////////////////////////////////////////////////
			/// REMOVE HELP ///

function mytheme_remove_help_tabs($old_help, $screen_id, $screen){
    $screen->remove_help_tabs();
    return $old_help;
}
add_filter('contextual_help', 'mytheme_remove_help_tabs', 999, 3);