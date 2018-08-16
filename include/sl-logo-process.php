<?php
	require_once( realpath(dirname(__FILE__)) . '/../../../../wp-config.php');
	
	global $wpdb;
	$sl_action = $_REQUEST['sl_action'];
    
    switch ($sl_action){		
		/*=============== [SL Logo Images Proccess] ===============*/
        case "add_image":
            $image_add = $wpdb->prefix."sl_logo";
			$check_table_slider = $wpdb->get_var( "SHOW TABLES LIKE '$table_sliders'" );
            
			$sl_slide_image = strip_tags($_POST['sl_slide_image']);
            
            $sl_image_ext = pathinfo($sl_slide_image, PATHINFO_EXTENSION);
            $sl_image_name = pathinfo($sl_slide_image, PATHINFO_BASENAME);
            $split_img_name = explode(".", $sl_image_name);
            $split_img_name = $split_img_name[0];
            $sl_image_path = pathinfo($sl_slide_image, PATHINFO_DIRNAME)."/";
            
            $image_add_data = array(
				'image_order' => '0',
				'image_title' => $split_img_name,
                'image_name' => $split_img_name.".".$sl_image_ext,
                'image_path' => $sl_image_path,
                'image_link_to' => ''
            );
            
            if((!empty($sl_slide_image))){
                $wpdb->insert($image_add, $image_add_data);
				$sl_image_id = $wpdb->insert_id;
				
                header( "Location: " . SL_SITE_URL . "/wp-admin/admin.php?page=manage_sl_logo_slider&msg=add_image_success");
            }
            else{
                header( "Location: " . SL_SITE_URL . "/wp-admin/admin.php?page=manage_sl_logo_slider&msg=add_image_error");
            }
        break;
        
        case "update_image":
            $link_add = $wpdb->prefix."sl_logo";
            
            $sl_image_id = $_REQUEST['sl_image_id'];
            
            $sl_image_title = strip_tags(trim($_POST['sl_image_title']));
            $sl_image_link = strip_tags(trim($_POST['sl_image_link']));
            $sl_image_order = $_POST['sl_image_order'];
            
            $image_link_data = array(
                'image_title' => $sl_image_title,
                'image_link_to' => $sl_image_link,
                'image_order' => $sl_image_order
            );
            
            $image_link_where = array(
                'image_id' => $sl_image_id
            );
            
            $link_update = $wpdb->update($link_add, $image_link_data, $image_link_where);
            header( "Location: " . SL_SITE_URL . "/wp-admin/admin.php?page=manage_sl_logo_slider&msg=update_image_success");
        break;
        
        case "del_image":
            $image_dell = $wpdb->prefix."sl_logo";
            
            $sl_image_id = $_REQUEST['sl_image_id'];
            
            $image_where = array(
                'image_id' => $sl_image_id
            );
            
            $image_delete = $wpdb->delete($image_dell, $image_where);
            
            header( "Location: " . SL_SITE_URL . "/wp-admin/admin.php?page=manage_sl_logo_slider&msg=del_image_success");
        break;
		
		/*=============== [Title SL Logo Slider] ===============*/
		case "update_title_slick":
            $submit_title 	= $_POST['submit_title_slick'];
            $sl_title 	= strtolower($_POST['sl_title']);
			if($submit_title){
				if ( get_option( 'sl_title_slick' ) ) {
		
					add_option( 'sl_title_slick', ucwords($sl_title));
					
				}
				else{
					
					update_option( 'sl_title_slick', ucwords($sl_title));
				}
			}
            
            header( "Location: " . SL_SITE_URL . "/wp-admin/admin.php?page=manage_sl_logo_slider&msg=update_title_success");
        break;
		
		case "del_title_slick":
				
				delete_option( 'sl_title_slick' );
            
            header( "Location: " . SL_SITE_URL . "/wp-admin/admin.php?page=manage_sl_logo_slider&msg=del_title_success");
        break;
		
		/*=============== [SL Logo Settings Proccess] ===============*/
		case "edit_settings":
            $submitbutton 	= $_POST['submit'];
			if($submitbutton){
				unset($_POST['submit']);
				$slOptions = maybe_serialize( $_POST );
				
				// $deprecated = null;
				// $autoload = 'yes';
				update_option( 'sl_settings', $slOptions);
			}
            
            header( "Location: " . SL_SITE_URL . "/wp-admin/admin.php?page=setting_sl_logo_slider&msg=settings_success");
        break;
    }