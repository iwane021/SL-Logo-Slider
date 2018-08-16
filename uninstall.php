<?php
//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit ();

    global $wpdb;
    $lsp_tbl_prefix = $wpdb->prefix;
	
## Delete Slick Logo Slider Plugin Settings from Options Table
    delete_option( 'sl_title_slick' );
    delete_option( 'sl_logo_table_version' );
	delete_option( 'sl_settings' );
	delete_option( 'sl_slides_to_show' );
	delete_option( 'sl_slides_to_scroll' );
	delete_option( 'sl_autoplay' );
	delete_option( 'sl_autoplay_speed' );
	delete_option( 'sl_arrows' );
	delete_option( 'sl_dots' );
	delete_option( 'sl_pause_on_hover' );

## Drop `sl_logo` Tables
    $wpdb->query("Drop Table ".$lsp_tbl_prefix."sl_logo");

?>