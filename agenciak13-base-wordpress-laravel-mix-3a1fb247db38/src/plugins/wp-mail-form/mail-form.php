<?php
/*
Plugin Name: Mail Form
Description: Plugin WordPress para automatizar formulários que enviam email 
Version: 1.0
Author: Euclécio Josias Rodrigues
License: Copyright todos os direitos reservados para Euclécio Josias Rodrigues
Author URI: https://br.linkedin.com/in/defaultjosias
*/

require_once (ABSPATH . WPINC . '/pluggable.php');

/* PLUGIN GLOBALS */
define('WPMAILFORM_PATH', __DIR__ . DIRECTORY_SEPARATOR);
define('WPMAILFORM_URL', get_bloginfo('template_url') . '/plugins/wp-mail-form/');

/* SMTP GLOBALS */
define('MAILSERVER_URL', get_option('mailserver_url'));
define('MAILSERVER_LOGIN', get_option('mailserver_login'));
define('MAILSERVER_PASS', get_option('mailserver_pass'));

foreach (glob( plugin_dir_path( __FILE__ ) . 'inc/*.php') as $file)
	include_once $file;

foreach (glob( plugin_dir_path( __FILE__ ) . 'functions/*.php') as $file)
	include_once $file;
