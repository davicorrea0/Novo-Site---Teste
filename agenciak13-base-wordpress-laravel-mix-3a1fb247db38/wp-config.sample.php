<?php
// ===================================================
// Load database info and local development parameters
// ===================================================
$base_env = parse_ini_file(__DIR__ . DIRECTORY_SEPARATOR . '.env');
define('DB_NAME', $base_env['DB_NAME']);
define('DB_USER', $base_env['DB_USER']);
define('DB_PASSWORD', $base_env['DB_PASSWORD']);
define('DB_HOST', $base_env['DB_HOST']); // Probably 'localhost'  
// ========================
// Custom Content Directory
// ========================
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' ? "https://" : "http://";
define('WP_CONTENT_DIR', dirname(__FILE__) . '/content');
define('WP_CONTENT_URL', $protocol . $_SERVER['HTTP_HOST'] . '/content');
// ================================================
// You almost certainly do not want to change these
// ================================================
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
// ==============================================================
// Salts, for security
// Grab these from: https://api.wordpress.org/secret-key/1.1/salt
// ==============================================================
define('AUTH_KEY', 'put your unique phrase here');
define('SECURE_AUTH_KEY', 'put your unique phrase here');
define('LOGGED_IN_KEY', 'put your unique phrase here');
define('NONCE_KEY', 'put your unique phrase here');
define('AUTH_SALT', 'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT', 'put your unique phrase here');
define('NONCE_SALT', 'put your unique phrase here');
// ==============================================================
// Table prefix
// Change this if you have multiple installs in the same database
// ==============================================================
$table_prefix = 'wp_';
// ================================
// Language
// Leave blank for American English
// ================================
define('WPLANG', 'pt_BR');
// ===========
// Hide errors
// ===========
$debug = isset($base_env["DEBUG"]) && $base_env["DEBUG"];
ini_set('display_errors', $debug ? 1 : 0);
define('WP_DEBUG_DISPLAY', $debug);
unset($base_env);
// =================================================================
// Debug mode
// Debugging? Enable these. Can also enable them in local-config.php
// =================================================================
// define( 'SAVEQUERIES', true );
// define( 'WP_DEBUG', true );
// ======================================
// Load a Memcached config if we have one
// ======================================
if (file_exists(dirname(__FILE__) . '/memcached.php'))
	$memcached_servers = include (dirname(__FILE__) . '/memcached.php');
// ===========================================================================================
// This can be used to programatically set the stage when deploying (e.g. production, staging)
// ===========================================================================================
define('WP_STAGE', '%%WP_STAGE%%');
define('STAGING_DOMAIN', '%%WP_STAGING_DOMAIN%%'); // Does magic in WP Stack to handle staging domain rewriting
// ===================
// Bootstrap WordPress
// ===================
if (!defined('ABSPATH'))
	define('ABSPATH', dirname(__FILE__) . '/wp/');
require_once (ABSPATH . 'wp-settings.php');
// ===========================================================================================
// UTILS
// ===========================================================================================
define('IMAGE_PATH', get_bloginfo('template_url') . '/assets/imgs/');