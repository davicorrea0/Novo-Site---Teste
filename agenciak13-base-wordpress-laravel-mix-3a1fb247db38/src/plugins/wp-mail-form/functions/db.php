<?php
global $wpdb;
$table_name = $wpdb->prefix.'custom_formmail';
if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name)
{
     /** Table not in database. Create new table */
     $charset_collate = $wpdb->get_charset_collate();
 
     $sql = "CREATE TABLE ".$table_name." (
     	  id int(11) NOT NULL AUTO_INCREMENT,
		  `prefix` varchar(150) NOT NULL,
		  `title` varchar(150) NOT NULL,
		  `recipients` text NOT NULL,
		  `template` varchar(150) NOT NULL,
		  `feedback` varchar(200) NOT NULL,
		  UNIQUE KEY id (`id`)
		) $charset_collate;";
     require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
     dbDelta( $sql );
}

if(!get_option('g_recaptcha_site_key'))
	add_option('g_recaptcha_site_key', '', '', 'no');
if(!get_option('g_recaptcha_secret_key'))
	add_option('g_recaptcha_secret_key', '', '', 'no');
