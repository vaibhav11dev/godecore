<?php
/**
 * The template for displaying the footer
 *
 */
?>
	</div><!-- #content .wrapper -->
	
        <div class="copyright">	
            <div class="container"><!-- .container fluid -->
                <div class="row footer-payment">
                    <div class="col-md-12 footer-pay-p">
                        <?php
                        $ved_footer_content = vedanta_get_option( 'ved_footer_content', '' );
                        echo wp_kses_post( $ved_footer_content );
                        ?>
                    </div>
                </div><!-- .row -->
            </div>
        </div>
	
</div><!-- #page -->

<?php wp_footer(); ?>

<?php if ( vedanta_get_option( 'ved_maintenance_mode' ) == 'comingsoon' ) { ?>
    
<?php $ved_canvas_border_main = vedanta_get_option( 'ved_canvas_border' ); ?>
<script>
    jQuery("#DateCountdown").TimeCircles({
        "animation": "smooth",
        "bg_width": 0.2,
        "fg_width": 0.03,
        "circle_bg_color": "<?php echo esc_js($ved_canvas_border_main); ?>",
        "time": {
            "Days": {
                "text": "Days",
                "color": "<?php echo esc_js($ved_canvas_border_main); ?>",
                "show": true
            },
            "Hours": {
                "text": "Hours",
                "color": "<?php echo esc_js($ved_canvas_border_main); ?>",
                "show": true
            },
            "Minutes": {
                "text": "Minutes",
                "color": "<?php echo esc_js($ved_canvas_border_main); ?>",
                "show": true
            },
            "Seconds": {
                "text": "Seconds",
                "color": "<?php echo esc_js($ved_canvas_border_main); ?>",
                "show": true
            }
        }
    });
</script>
<?php } ?>

</body>
</html>