<?php
/**
 * Default page template to display all pages
 *
 */
get_template_part('template-parts/maintenance/header');
?>

<?php
global $ved_options;
$maintenance_mode = $ved_options['ved_maintenance_mode'];
if( empty( $maintenance_mode ) ){
	$maintenance_mode = 'maintenance';
}

if( $maintenance_mode == 'comingsoon' ){
	$comingsoon_title = $ved_options['ved_comingsoon_title'];
	$comingsoon_subtitle = $ved_options['ved_comingsoon_subtitle'];
	
	$mntc_cs_title = ( ! empty( $comingsoon_title ) ) ? $comingsoon_title : esc_html__( 'Coming Soon', 'godecore' );
	$mntc_cs_sutitle = ( ! empty( $comingsoon_subtitle ) ) ? $comingsoon_subtitle : esc_html__( 'We are currently working on a website and won\'t take long. Don\'t forget to check out our Social updates.', 'godecore' );
}else{
	$maintenance_title = $ved_options['ved_maintenance_title'];
	$maintenance_subtitle = $ved_options['ved_maintenance_subtitle'];
	
	$mntc_cs_title = ( ! empty( $maintenance_title ) ) ? $maintenance_title : esc_html__( 'Site is Under Maintenance', 'godecore' );
	$mntc_cs_sutitle = ( ! empty( $maintenance_subtitle ) ) ? $maintenance_subtitle : esc_html__( 'This Site is Currently Under Maintenance. We will back shortly', 'godecore' );
}
?>
<div class="mntc-cs-main white-bg">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="mntc-cs-item mntc-cs-head text-center m-t-20">
					<h1 class="mntc-title"><?php echo esc_html($mntc_cs_title);?></h1>
					<p class="mntc-subtitle"><?php echo esc_html($mntc_cs_sutitle);?></p>
				</div>
				<?php
				if( $maintenance_mode == 'comingsoon' ){
					$comingsoon_date = $ved_options['ved_comingsoon_date'];
					$comingsoon_date = date_create_from_format('m/d/Y', $comingsoon_date);
					$comingsoon_date = $comingsoon_date->format( 'Y-m-d' );
					
					$counter_data = array(
						'days'           => esc_html__("Days", 'godecore' ),
						'hours'          => esc_html__("Hours", 'godecore' ),
						'minutes'        => esc_html__("Minutes", 'godecore' ),
						'seconds'        => esc_html__("Seconds", 'godecore' ),
					);
					
					$counter_data = json_encode($counter_data);
					?>
					<div class="mntc-cs-item mntc-cs-content coming-soon-countdown">
						<h2> <?php echo esc_html__( 'We will be back soon in', 'godecore' ); ?></h2>
						<div id="DateCountdown" data-date="<?php echo esc_attr($comingsoon_date);?>"></div>
						
					</div>
					<?php
				}

				if ($ved_options['ved_comming_soon_social_icons']) {
				vedanta_topbar_social();
				}

				?>
			</div>
		</div>
	</div>
</div>
<?php
// Newsletter
get_template_part( 'template-parts/maintenance/newsletter' );

get_template_part( 'template-parts/maintenance/footer' );