<?php
	require_once( realpath(dirname(__FILE__)) . '/../../../../wp-config.php');
	
	global $wpdb;
	
	$table_images = $wpdb->prefix."sls_images";
		
	if( ! isset($_GET['sls_actions']) ) {
		return;
	}
		
	$sls_actions = sanitize_text_field($_GET['sls_actions']);
    
    switch ( $sls_actions ){		
		/*=============== [SL Logo Images Proccess] ===============*/
        case "add_image":
            if( ! isset($_POST['sls_slide_image']) ) {
				return;
			}
			$sls_slide_image = sanitize_text_field($_POST['sls_slide_image']);
            
            $sls_image_ext = pathinfo($sls_slide_image, PATHINFO_EXTENSION);
            $sls_image_name = pathinfo($sls_slide_image, PATHINFO_BASENAME);
            $split_img_name = explode(".", $sls_image_name);
            $split_img_name = $split_img_name[0];
            $sls_image_path = pathinfo($sls_slide_image, PATHINFO_DIRNAME)."/";
            
            $image_add_data = array(
				'image_order' => intval(0),
				'image_title' => $split_img_name,
                'image_name' => $split_img_name.".".$sls_image_ext,
                'image_path' => $sls_image_path
            );
            
            if( ! empty($sls_slide_image) ) {
                $wpdb->insert($table_images, $image_add_data);				
                header( "Location: " . SLS_SITE_URL . "/wp-admin/admin.php?page=manage_sls_logo&msg=add_image_success");
            }
            else{
                header( "Location: " . SLS_SITE_URL . "/wp-admin/admin.php?page=manage_sls_logo&msg=add_image_error");
				return;
			}
        break;
        
        case "update_image":
            
			if( ! isset($_POST['sls_image_id'], $_POST['sls_image_title'], $_POST['sls_image_link'], $_POST['sls_image_order']) ) {
				return;
			}
			
			$sls_unique_id = (int) $_POST['sls_image_id'];
			$sls_order_number = (int) $_POST['sls_image_order'];
			
			if ( ! filter_var($_POST['sls_image_link'], FILTER_VALIDATE_URL) && !empty($_POST['sls_image_link']) ) {
				header( "Location: " . SLS_SITE_URL . "/wp-admin/admin.php?page=manage_sls_logo&msg=update_image_link_error");
				return;
			}
			else if ( strlen($_POST['sls_image_title']) > 50 ) {
				header( "Location: " . SLS_SITE_URL . "/wp-admin/admin.php?page=manage_sls_logo&msg=update_image_title_error");
				return;
			}
			
            $sls_image_id = sanitize_text_field($sls_unique_id);
            $sls_image_title = sanitize_text_field($_POST['sls_image_title']);
            $sls_image_link = esc_url($_POST['sls_image_link']);
            $sls_image_order = sanitize_text_field($sls_order_number);
            
            $image_link_data = array(
                'image_title' => $sls_image_title,
                'image_link_to' => $sls_image_link,
                'image_order' => $sls_image_order
            );
            
            $image_link_where = array(
                'image_id' => $sls_image_id
            );
            
			if( ! empty($sls_image_id) ){
				$link_update = $wpdb->update($table_images, $image_link_data, $image_link_where);
				header( "Location: " . SLS_SITE_URL . "/wp-admin/admin.php?page=manage_sls_logo&msg=update_image_success");
			}
			else{
                header( "Location: " . SLS_SITE_URL . "/wp-admin/admin.php?page=manage_sls_logo&msg=update_image_error");
				return;
			}
        break;
        
        case "del_image":
			if( ! isset($_GET['sls_image_id']) ) {
				return;
			}
			
			$sls_unique_id = (int) $_GET['sls_image_id'];
			$sls_image_id = sanitize_text_field($sls_unique_id);
            
            $image_where = array(
                'image_id' => $sls_image_id
            );
            
			if( ! empty($sls_image_id) ){
				$image_delete = $wpdb->delete($table_images, $image_where);
				header( "Location: " . SLS_SITE_URL . "/wp-admin/admin.php?page=manage_sls_logo&msg=del_image_success");
			}
			else{
				header( "Location: " . SLS_SITE_URL . "/wp-admin/admin.php?page=manage_sls_logo&msg=del_image_error");
				return;
			}
		break;
		
		/*=============== [Title SL Logo Slider] ===============*/
		case "update_title":
			if ( ! isset($_POST['submit_title'], $_POST['sls_title']) ) {
				return;
			}
			
			if ( strlen($_POST['sls_title']) > 25 ) {
				header( "Location: " . SLS_SITE_URL . "/wp-admin/admin.php?page=manage_sls_logo&msg=update_title_length_error");
				return;
			}
			
            $submit_title = sanitize_text_field($_POST['submit_title']);
            $sls_title 	= strtolower(sanitize_text_field($_POST['sls_title']));
			
			if( ! empty($sls_title) ){
				//check already options on database or not
				if ( get_option( 'sls_title_slider' ) !== false ){
					update_option( 'sls_title_slider', ucwords($sls_title));
				}
				else{
					add_option( 'sls_title_slider', ucwords($sls_title));
				}
				
				header( "Location: " . SLS_SITE_URL . "/wp-admin/admin.php?page=manage_sls_logo&msg=update_title_success");
			}
			else{
				header( "Location: " . SLS_SITE_URL . "/wp-admin/admin.php?page=manage_sls_logo&msg=update_title_error");
				return;
			}
            
        break;
		
		case "delete_title":
			delete_option( 'sls_title_slider' );
            header( "Location: " . SLS_SITE_URL . "/wp-admin/admin.php?page=manage_sls_logo&msg=del_title_success");
        break;
		
		/*=============== [SL Logo Settings Proccess] ===============*/
		case "edit_settings":
			if ( ! isset($_POST['submit']) ) {
				return;
			}
			
			if( ! empty($_POST['submit']) ){
				
				unset($_POST['submit']);
				$options_data = maybe_serialize( $_POST );
				
				update_option( 'sls_settings', $options_data);
				header( "Location: " . SLS_SITE_URL . "/wp-admin/admin.php?page=setting_sls_logo&msg=settings_success");
			}
			else{
				header( "Location: " . SLS_SITE_URL . "/wp-admin/admin.php?page=setting_sls_logo&msg=settings_error");
				return;
			}
            
        break;
    }