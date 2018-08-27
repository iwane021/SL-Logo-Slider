<div id="wpbody">
    <div id="wpbody-content">
		<div class="wrap">
			<h1><?php _e( 'Manage SL Logo Slider', 'logo-slider' ) ?></h1>
			<?php
				global $wpdb;

				if ( isset( $_GET['msg'] ) ) {
					$msg = $_GET['msg'];
				}

			switch ( $msg ) {
				case "add_image_success":
					?>				
					<div class='notice notice-success is-dismissible' style='margin-top:10px;'>
						<p class="message">
							<?php _e( 'Image Upload Successfully.', 'logo-slider' ) ?>
						</p>
					</div>
					<?php
					break;
				case "add_image_error":
					?>
					<div class='notice notice-error is-dismissible' style='margin-top:10px;'>
						<p class="message">
							<?php _e( 'Image Required.', 'logo-slider' ) ?>
						</p>
					</div>
					<?php
					break;
				case "update_image_success":
					?>
					<div class='notice notice-success is-dismissible' style='margin-top:10px;'>
						<p class="message">
							<?php _e( 'Update Image Successfully.', 'logo-slider' ) ?>
						</p>
					</div>
					<?php
					break;
				case "update_image_error":
					?>
					<div class='notice notice-error is-dismissible' style='margin-top:10px;'>
						<p class="message">
							<?php _e( 'Update Failed!!', 'logo-slider' ) ?>
						</p>
					</div>
					<?php
					break;
				case "update_image_link_error":
					?>
					<div class='notice notice-error is-dismissible' style='margin-top:10px;'>
						<p class="message">
							<?php _e( 'Invalid URL Link, Update Failed!!', 'logo-slider' ) ?>
						</p>
					</div>
					<?php
					break;
				case "update_image_title_error":
					?>
					<div class='notice notice-error is-dismissible' style='margin-top:10px;'>
						<p class="message">
							<?php _e( 'Length of characters not allowed, Update Failed!!', 'logo-slider' ) ?>
						</p>
					</div>
					<?php
					break;
				case "del_image_success":
					?>
					<div class='notice notice-success is-dismissible' style='margin-top:10px;'>
						<p class="message">
							<?php _e( 'Delete Image Successfully.', 'logo-slider' ) ?>
						</p>
					</div>
					<?php
					break;
				case "del_image_error":
					?>
					<div class='notice notice-error is-dismissible' style='margin-top:10px;'>
						<p class="message">
							<?php _e( 'Delete Image Failed!!', 'logo-slider' ) ?>
						</p>
					</div>
					<?php
					break;
				case "update_title_success":
					?>				
					<div class="notice notice-success is-dismissible" style="margin-top:10px;">
						<p class="message">
							<?php _e( "Update title successfully.", "logo-slider" ) ?>
						</p>
					</div>
					<?php
					break;
				case "update_title_error":
					?>
					<div class='notice notice-error is-dismissible' style='margin-top:10px;'>
						<p class="message">
							<?php _e( 'Empty Title, Update Title Failed!!', 'logo-slider' ) ?>
						</p>
					</div>
					<?php
					break;
				case "update_title_length_error":
					?>
					<div class='notice notice-error is-dismissible' style='margin-top:10px;'>
						<p class="message">
							<?php _e( 'Length of characters not allowed, Update Title Failed!!', 'logo-slider' ) ?>
						</p>
					</div>
					<?php
					break;
				case "del_title_success":
					?>				
					<div class="notice notice-success is-dismissible" style="margin-top:10px;">
						<p class="message">
							<?php _e( 'Delete title successfully.', 'logo-slider' ) ?>
						</p>
					</div>
					<?php
					break;
			}
			?>
			
			<div class="sl-left-body-title">
				<div class="sl-left-body-heading">
					<h3><?php _e( 'Add Title SL Logo Slider', 'logo-slider' ) ?></h3>
				</div>
				<div class="sl-left-plugin-body">
					<div class="sl-left-box">
						<form name="sl_form" action="<?php echo SLS_SLIDER_PROCESS; ?>sls-logo-process.php?sls_actions=update_title" method="post">
						<table width="100%" border="0" cellspacing="4" cellpadding="0">
							<tbody>
								<tr>
									<td width="22%">
										<label><?php _e( "Title SL Logo", "sls-label" ); ?></label>
									</td>
									<td width="70%">
										<input type="text" size="50" maxlength="25" name="sls_title" id="sls_title" value="<?php echo get_option( 'sls_title_slider' )?>" placeholder="Our Title" onfocus="this.placeholder=''" onblur="this.placeholder='Our Title'">
									</td>
									<td align="center">
										<input type="submit" name="submit_title" value="Update" title="Update title">
									</td>
									<td align="center">
										<a href="<?php echo SLS_SLIDER_PROCESS; ?>sls-logo-process.php?sls_actions=delete_title" class="sl-admin-del-btn">
											<?php _e( "Delete", "sls-label" ) ?>
										</a>
									</td>
								</tr>
							</tbody>
						</table>
						</form>
					</div>
				</div>
			</div>
			
			<?php	
				if ( get_option( 'sls_title_slider' ) ) { 
			?>
				<div class="sl-main-body">
					<div class="sl-left-body">
						<div class="sl-left-body-heading">
							<h3><?php _e( 'Add SL Logo Slider Image', 'logo-slider' ) ?></h3>
						</div>
						<div class="sl-left-plugin-body">
							<div class="sl-left-box">
								<form name="sl_form" action="<?php echo SLS_SLIDER_PROCESS; ?>sls-logo-process.php?sls_actions=add_image"
								method="post" enctype="multipart/form-data">
								<table width="100%" border="0" cellspacing="4" cellpadding="0">
									<tbody>
										<tr>
											<td width="22%">
												<label><?php _e( "Upload New Image", "sls-label" ); ?></label>
											</td>
											<td width="70%">
												<input type="text" size="50" name="sls_slide_image" id="sl-slide-image" class="sl-upload-url">
											</td>
											<td align="center">
												<input type="button" name="upload_button" class="sl-upload-button" value="<?php _e( 'Choose Image', 'logo-slider' ); ?>">
											</td>
											<td align="center">
												<input type="submit" name="sl_save_images" value="<?php _e( 'Upload Image', 'logo-slider' ); ?>">
											</td>
										</tr>
									</tbody>
								</table>
								</form>
							</div>
						</div>
					</div>
					<div class="sl-data-body">
					<?php
					$table_images = $wpdb->prefix . "sls_images";
					$images_results = $wpdb->get_results( "SELECT * FROM $table_images Order By image_order ASC" );

					if ( ! empty( $images_results ) ) { 
					?>
						<table width="100%" border="0" cellspacing="1" cellpadding="5">
							<tbody>
								<tr>
									<td width="4%" class="sl-data-heading" align="center">#</td>
									<td width="15%" class="sl-data-heading"><?php _e( "Slider Image", "sls-label" ); ?></td>
									<td width="30%" class="sl-data-heading"><?php _e( "Image Title", "sls-label" ); ?></td>
									<td width="30%" class="sl-data-heading"><?php _e( "Image Links To", "sls-label" ); ?></td>
									<td width="4%" class="sl-data-heading" style="width: 5em;"><?php _e( "Order", "sls-label" ); ?></td>
									<td width="15%" class="sl-data-heading" align="center"><?php _e( "Action", "sls-label" ); ?></td>
								</tr>
							</tbody>
						</table>
						<div id="sl-sort-image">
							<?php
								$image_count = 0;

								foreach ( (array) $images_results as $sls_image_data ) {
									$image_count = $image_count + 1;
									( $image_count % 2 == 0 ? $row_class = "sl-data-row-2" : $row_class = "sl-data-row-1" );
									?>
									<form action="<?php echo SLS_SLIDER_PROCESS; ?>sls-logo-process.php?sls_actions=update_image"
											  method="post">
										<table width="100%" border="0" cellspacing="1" cellpadding="5" 
											id="sl-list-<?php echo $sls_image_data->image_id; ?>" class="sl-image-item">
											<tbody>
												<tr class="<?php echo $row_class; ?>">
													<td width="4%" align="center" class="sl-data-text">
														<?php echo $image_count; ?>
													</td>
													<td width="15%">
														<input type="hidden" name="sls_image_id" value="<?php echo $sls_image_data->image_id; ?>">
														<img src="<?php echo $sls_image_data->image_path . $sls_image_data->image_name; ?>" width="80" height="80">
													</td>
													<td width="30%">
														<input type="text" name="sls_image_title" maxlength="50" value="<?php echo $sls_image_data->image_title; ?>">
													</td>
													<td width="30%">
														<input type="text" name="sls_image_link" value="<?php echo $sls_image_data->image_link_to; ?>">
													</td>
													<td width="9%">
														<input type="number" name="sls_image_order" maxlength="3" style="width: 5em;" value="<?php echo $sls_image_data->image_order; ?>">
													</td>
													<td width="5%" align="right">
														<input type="submit" value="Update" title="Update <?php echo $sls_image_data->image_name; ?> Link">
													</td>
													<td width="5%" align="center">
														<a href="<?php echo SLS_SLIDER_PROCESS; ?>sls-logo-process.php?sls_actions=del_image&sls_image_id=<?php echo $sls_image_data->image_id; ?>" class="sl-admin-del-btn">
															<?php _e( "Delete", "sls-label" ) ?>
														</a>
													</td>
												</tr>
											</tbody>
											</table>
									</form>
								<?php
							}
							?>
						</div>
						<table width="100%" border="0" cellspacing="1" cellpadding="5">
							<tbody>
								<tr>
									<td width="4%" class="sl-data-footer" align="center">#</td>								
									<td width="15%" class="sl-data-footer"><?php _e( "Slider Image", "sls-label" ); ?></td>
									<td width="64%" class="sl-data-footer"><?php _e( "Image Links To", "sls-label" ); ?></td>
									<td width="20%" class="sl-data-footer"><?php _e( "Action", "sls-label" ); ?></td>
								</tr>
							</tbody>
						</table>
					<?php
					} else {
					?>
						<span>
							<?php _e( "There are no Image Logo for slider", "sls-label" ); ?>
						</span>
						<?php
					}
					?>
					</div>
				</div>
			<?php } ?>
		</div>
	</div>
</div>