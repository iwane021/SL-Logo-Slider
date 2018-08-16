<?php

## Create Table: sl_logo
global $sl_logo_table_version;
$sl_logo_table_version = "1.0";

add_action('plugins_loaded', 'sl_create_table_logo_images');

function sl_create_table_logo_images() {
	global $wpdb;
	global $sl_logo_table_version;

	$table_images  = $wpdb->prefix . "sl_logo";
	$images_ver    = get_option( "sl_logo_table_version" );
	$charset_collate = $wpdb->get_charset_collate();

	$check_table_images = $wpdb->get_var( "SHOW TABLES LIKE '$table_images'" );

	if ( $check_table_images != $table_images || $images_ver != $sl_logo_table_version ) {
		
		$sql_logo = "CREATE TABLE $table_images (
						`image_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
						`image_order` INT(4) NOT NULL,
						`image_title` VARCHAR(50) NOT NULL COLLATE 'utf8_general_ci',
						`image_name` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
						`image_path` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
						`image_link_to` VARCHAR(255) NULL COLLATE 'utf8_general_ci',
						PRIMARY KEY (image_id)
					) $charset_collate;";

		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		dbDelta( $sql_logo );

		update_option( "sl_logo_table_version", $sl_logo_table_version );
		
	} else {
		
		add_option( "sl_logo_table_version", $sl_logo_table_version );
	
	}
}