<?php
/**
Plugin Name: SL Logo Slider
Plugin URI: http://127.0.0.1/plugins/myplugin/
Description: SL Logo Slider using slick js
Version: 1.0
Author: Iwan Prasetiyo
Author URI: https://tukarpengetahuan.com/
License: GPL2

SL Logo Slider is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.
 
SL Logo Slider is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.
 
You should have received a copy of the GNU General Public License
along with SL Logo Slider. If not, see {License URI}.
*/

include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

define( 'SL_SLIDER', plugin_dir_url( __FILE__ ) );
define( 'SL_SLIDER_PROCESS', plugin_dir_url( __FILE__ ) . 'include/' );
define( 'SL_SITE_URL', site_url() );

###  Registered Admin Script / Style SL logo slider
function admin_script_sl_slider() {
	if ( is_admin() ) {
		// we are in admin mode
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'media-upload' );
		wp_enqueue_script( 'thickbox' );
		
		wp_enqueue_media();

		wp_register_style( 'admin-sl-logo-css',  SL_SLIDER . 'admin/css/sl-admin-style.css' );
		wp_enqueue_style( 'admin-sl-logo-css' );
		
		wp_enqueue_style( 'thickbox' );

		wp_register_script( 'sl_media_box', SL_SLIDER . 'admin/js/sl_media_box.js' );

		if ( isset( $_GET["page"] ) ) {

			$page = $_GET["page"];
			if ( $page == "manage_sl_logo_slider" ) {
				wp_enqueue_script( 'sl_media_box' );
			}

		}
	}
}
add_action( 'admin_enqueue_scripts', 'admin_script_sl_slider' );

###  Registered Script / Style SL logo slider
function load_jquery() {
    if ( ! wp_script_is( 'jquery', 'enqueued' )) {

        //Enqueue
		wp_register_script('jquery', SL_SLIDER . 'public/js/jquery-2.2.0.min.js');  
        wp_enqueue_script( 'jquery' );
    }
}
add_action( 'wp_enqueue_scripts', 'load_jquery' );

function front_script_sl_slider() {
	
	// Registering Style
	wp_register_style( 'sl-logo-style',  SL_SLIDER . 'public/css/sl-slider.css' );
	wp_enqueue_style( 'sl-logo-style' );
	wp_register_style( 'sl-slick-style',  SL_SLIDER . 'public/slick/slick.css' );
	wp_enqueue_style( 'sl-slick-style' );
	wp_register_style( 'sl-slick-theme',  SL_SLIDER . 'public/slick/slick-theme.css' );
	wp_enqueue_style( 'sl-slick-theme' );
	
	//Registering Script
	wp_register_script('sl-script', SL_SLIDER . 'public/slick/slick.js', array('jquery'));  
	wp_enqueue_script('sl-script');
}
add_action( 'wp_enqueue_scripts', 'front_script_sl_slider');


###  plugin activation
register_activation_hook( __FILE__, 'sl_slider_activate' );
function sl_slider_activate() {
	
	$option_data = array( 
				'sl_slides_to_show' => 6, 
				'sl_slides_to_scroll' => 1, 
				'sl_autoplay' => 1, 
				'sl_autoplay_speed' => 1500, 
				'sl_arrows' => 0, 
				'sl_dots' => 0, 
				'sl_pause_on_hover' => 0
			);

	// Add default options value to serilaize
	$slOptions = maybe_serialize( $option_data );
	
	if ( get_option( 'sl_settings' ) ) {
		add_option( 'sl_settings', $slOptions);
	}
	else {
		update_option( 'sl_settings', $slOptions);
	}
}

###  plugin deactivation
register_deactivation_hook( __FILE__, 'sl_slider_deactivate' );
function sl_slider_deactivate() {
	delete_option( 'sl_settings' );
}

###  plugin uninstallation
register_uninstall_hook( __FILE__, 'sl_slider_uninstall' );
function sl_slider_uninstall() {
    // Uninstall
	require "uninstall.php";
}

###  Unserialize option value
if ( get_option( 'sl_settings' ) !== false ) {
	$my_sl_options = maybe_unserialize( get_option( 'sl_settings' ) );

define( 'SL_SLIDES_TO_SHOW', $my_sl_options['sl_slides_to_show'] );
define( 'SL_SLIDES_TO_SCROLL', $my_sl_options['sl_slides_to_scroll'] );
define( 'SL_AUTOPLAY', $my_sl_options['sl_autoplay'] );
define( 'SL_AUTOPLAY_SPEED', $my_sl_options['sl_autoplay_speed'] );
define( 'SL_ARROWS', $my_sl_options['sl_arrows'] );
define( 'SL_DOTS', $my_sl_options['sl_dots'] );
define( 'SL_PAUSE_ON_HOVER', $my_sl_options['sl_pause_on_hover'] );
}

###  Add Plugin to Menu Admin
function sl_slider_options() {
	// add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null );
	// add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function = '' )
	
	add_menu_page('SL Logo Slider', 'SL Logo Slider', 'manage_options', 'sl_logo_slider', 'sl_logo_manage', 'dashicons-format-gallery');
	add_submenu_page( 'sl_logo_slider', 'Manage SL Logo', 'Manage SL Logo', 'manage_options', 'manage_sl_logo_slider', 'sl_logo_manage');
	add_submenu_page( 'sl_logo_slider', 'Settings', 'Settings', 'manage_options', 'setting_sl_logo_slider', 'sl_logo_settings');
	remove_submenu_page('sl_logo_slider', 'sl_logo_slider');
}
add_action('admin_menu', 'sl_slider_options');


### Create Table
require "include/sl_logo_database.php";

### Manage Logo
function sl_logo_manage() {	
	require "include/sl-logo-manage.php";
}

### Settings
function sl_logo_settings() {	
	require "include/sl-logo-settings.php";
}

require_once('include/sl-logo-front-view.php');