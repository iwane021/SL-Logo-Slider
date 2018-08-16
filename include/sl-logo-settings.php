<div id="wpbody">
    <div id="wpbody-content">
		<div class="wrap">
			<h1><?php _e( 'Settings', 'logo-slider' ) ?></h1>
			<?php
				global $wpdb;

				if ( isset( $_REQUEST['msg'] ) ) {
					$msg = $_REQUEST['msg'];
				} else {
					$msg = '';
				}

			switch ( $msg ) {
				case "settings_success":
					?>				
					<div class="notice notice-success is-dismissible" style="margin-top:10px;">
						<p class="message">
							<?php _e( "Update settings successfully.", "logo-slider" ) ?>
						</p>
					</div>
					<?php
					break;
				case "del_settings_success":
					?>				
					<div class="notice notice-success is-dismissible" style="margin-top:10px;">
						<p class="message">
							<?php _e( 'Delete settings successfully.', 'logo-slider' ) ?>
						</p>
					</div>
					<?php
					break;
				case "settings_error":
					?>
					<div class="notice notice-error is-dismissible" style="margin-top:10px;">
						<p class="message">';
							<?php _e( "Error settings.", "logo-slider" ) ?>
						</p>
					</div>
					<?php
					break;
			}
			?>
			
			<div class="sl-main-body sl-main-settings">
				<div class="sl-left-settings-body">
					<div class="sl-left-body-heading">
						<h3><?php _e( 'SL Logo', 'logo-slider' ) ?></h3>
					</div>
					<div class="sl-settings">
						<div class="sl-left-box">
							<form action="<?php echo SL_SLIDER_PROCESS; ?>sl-logo-process.php?sl_action=edit_settings" method="post">
							<?php
								global $wpdb;
	
								$table_images = $wpdb->prefix . "sl_logo";
								$image_count = $wpdb->get_var( "SELECT COUNT(*) FROM $table_images" );
							?>
							<table width="100%" border="0" cellspacing="5" cellpadding="5">
								<tbody>
									<tr>
										<td width="22%">
											<label><?php _e( "Slides to show", "sl-label" ); ?></label>
										</td>
										<td width="2%">
											<?php _e( " : ", "sl-dot" ); ?>
										</td>
										<td>
											<input type="number" min="2" max="<?php echo $image_count - 1; ?>" width="50" name="sl_slides_to_show" id="sl_slides_to_show" class="sl-options" value="<?php echo SL_SLIDES_TO_SHOW; ?>">
										</td>
									</tr>
									<tr>
										<td width="22%">
											<label><?php _e( "Slides to scroll", "sl-label" ); ?></label>
										</td>
										<td width="2%">
											<?php _e( " : ", "sl-dot" ); ?>
										</td>
										<td>
											<input type="number" width="50" name="sl_slides_to_scroll" id="sl_slides_to_scroll" class="sl-options" value="<?php echo SL_SLIDES_TO_SCROLL; ?>">
										</td>
									</tr>
									<tr>
										<td width="22%">
											<label><?php _e( "Autoplay", "sl-label" ); ?></label>
										</td>
										<td width="2%">
											<?php _e( " : ", "sl-dot" ); ?>
										</td>
										<td>
											<select name="sl_autoplay">
												<option value="1" <?php echo SL_AUTOPLAY == '1' ? 'selected="selected"' : ''; ?>><?php _e('true','sl-settings') ?></option>
												<option value="0" <?php echo SL_AUTOPLAY == '0' ? 'selected="selected"' : ''; ?>><?php _e('false','sl-settings') ?></option>
											</select>
										</td>
									</tr>
									<tr>
										<td width="22%">
											<label><?php _e( "Autoplay speed", "sl-label" ); ?></label>
										</td>
										<td width="2%">
											<?php _e( " : ", "sl-dot" ); ?>
										</td>
										<td>
											<input type="number" width="50" name="sl_autoplay_speed" id="sl_autoplay_speed" class="sl-options" value="<?php echo SL_AUTOPLAY_SPEED; ?>">
										</td>
									</tr>
									<tr>
										<td width="22%">
											<label><?php _e( "Slider arrows", "sl-label" ); ?></label>
										</td>
										<td width="2%">
											<?php _e( " : ", "sl-dot" ); ?>
										</td>
										<td>
											<select name="sl_arrows">
												<option value="0" <?php echo SL_ARROWS == '0' ? 'selected="selected"' : ''; ?>><?php _e('false','sl-settings') ?></option>
												<option value="1" <?php echo SL_ARROWS == '1' ? 'selected="selected"' : ''; ?>><?php _e('true','sl-settings') ?></option>
											</select>
										</td>
									</tr>
									<tr>
										<td width="22%">
											<label><?php _e( "Slider dots", "sl-label" ); ?></label>
										</td>
										<td width="2%">
											<?php _e( " : ", "sl-dot" ); ?>
										</td>
										<td>
											<select name="sl_dots">
												<option value="0" <?php echo SL_DOTS == '0' ? 'selected="selected"' : ''; ?>><?php _e('false','sl-settings') ?></option>
												<option value="1" <?php echo SL_DOTS == '1' ? 'selected="selected"' : ''; ?>><?php _e('true','sl-settings') ?></option>
											</select>
										</td>
									</tr>
									<tr>
										<td width="22%">
											<label><?php _e( "Pause on hover", "sl-label" ); ?></label>
										</td>
										<td width="2%">
											<?php _e( " : ", "sl-dot" ); ?>
										</td>
										<td>
											<select name="sl_pause_on_hover">
												<option value="0" <?php echo SL_PAUSE_ON_HOVER == '0' ? 'selected="selected"' : ''; ?>><?php _e('false','sl-settings') ?></option>
												<option value="1" <?php echo SL_PAUSE_ON_HOVER == '1' ? 'selected="selected"' : ''; ?>><?php _e('true','sl-settings') ?></option>
											</select>
										</td>
									</tr>
									<tr>
										<td>
											<br><input type="submit" name="submit" value="Save Changes" title="<?php _e( "Save Changes", "sl-label" ); ?>">
										</td>
									</tr>
								</tbody>
							</table>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
