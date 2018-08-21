<?php
function sl_logo_frontend(){
	
	global $wpdb;
	
	$table_images = $wpdb->prefix . "sl_logo";
	$images_results = $wpdb->get_results( "SELECT * FROM $table_images Order By image_order ASC" );
	
	if ( ! empty( $images_results ) ) {
?>
		<div class="container">
			<div class="boxes-slickslider">
				<h2><?php echo get_option( 'sl_title_slick' )?></h2>
				<section class="customer-logos slider">
				<?php
					foreach ($images_results as $key => $sl_image) {
				?>
					<a rel="nofollow" <?php echo empty($sl_image->image_link_to) ? '' : 'target="_blank" href="'.$sl_image->image_link_to.'"'; ?>>
						<div class="slide"><img alt="<?php echo $sl_image->image_title ?>" src="<?php echo $sl_image->image_path . $sl_image->image_name ?>"></div>
					</a>
				<?php 
					}
				?>
				</section>
			</div>
		</div>

	<script type="text/javascript">
	jQuery( function ( $ ) {
		
		var SL_SLIDES_TO_SHOW = <?php echo SL_SLIDES_TO_SHOW; ?>;
		var SL_SLIDES_TO_SCROLL = <?php echo SL_SLIDES_TO_SCROLL; ?>;
		var SL_AUTOPLAY = <?php echo SL_AUTOPLAY; ?>;
		var SL_AUTOPLAY_SPEED = <?php echo SL_AUTOPLAY_SPEED; ?>;
		var SL_ARROWS = <?php echo SL_ARROWS; ?>;
		var SL_DOTS = <?php echo SL_DOTS; ?>;
		var SL_PAUSE_ON_HOVER = <?php echo SL_PAUSE_ON_HOVER; ?>;
		
		$('.customer-logos').slick({
			slidesToShow: SL_SLIDES_TO_SHOW,
			slidesToScroll: SL_SLIDES_TO_SCROLL,
			autoplay: (SL_AUTOPLAY == "1") ? true : false,
			autoplaySpeed: SL_AUTOPLAY_SPEED,
			arrows: (SL_ARROWS == "1") ? true : false,
			dots: (SL_DOTS == "1") ? true : false,
			pauseOnHover: (SL_PAUSE_ON_HOVER == "1") ? true : false,
			responsive: [{
				breakpoint: 768,
				settings: {
					slidesToShow: 4
				}
			}, {
				breakpoint: 520,
				settings: {
					slidesToShow: 3
				}
			}]
		});
	});
	</script>
<?php
	}
}
add_filter('filter_sl_logo', 'sl_logo_frontend');