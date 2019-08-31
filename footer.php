<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the .wrapper div and all content after.
 *
 *
 * @package GoDecore
 */
$ved_footer_widget_col = vedanta_get_option( 'ved_footer_widget_col', 'disable' );
if ( ($ved_footer_widget_col != "") || ($ved_footer_widget_col != "disable") ) {
    $vedanta_footer_css = '';
    if ( $ved_footer_widget_col == "one" ) {
        $vedanta_footer_css = 'col-md-12';
        $vedanta_pre_css = 'col-md-12 text-center menu-horizontal';
    }
    if ( $ved_footer_widget_col == "two" ) {
        $vedanta_footer_css = 'col-md-6';
        $vedanta_pre_css = 'col-md-6';
    }
    if ( $ved_footer_widget_col == "three" ) {
        $vedanta_footer_css = 'col-md-4';
        $vedanta_pre_css = 'col-md-4';
    }
    if ( $ved_footer_widget_col == "four" ) {
        $vedanta_footer_css = 'col-md-3';
        $vedanta_pre_css = 'col-md-3';
    }
    if ( $ved_footer_widget_col == "five" ) {
        $vedanta_footer_css = 'col-md-2';
        $vedanta_pre_css = 'col-md-3';
    }
}

$ved_footer_parallax = vedanta_get_option( 'ved_footer_parallax', '' );
$foo_class          = '';
if ( $ved_footer_parallax == 1 ) {
    $foo_class = 'bg-black-alfa-80';
}
?>
<!-- FOOTER -->
<footer id="footer" class="footer <?php echo esc_attr( $foo_class ); ?>">
    <div class="before-footer">
        <div class="container">
        <?php
        if ( is_active_sidebar( 'before-footer' ) ) :
            dynamic_sidebar( 'before-footer' );
        endif;
        ?>
        </div>
    </div>
    <div class="footer-bg-black">
        <?php if ( ($ved_footer_widget_col != "disable" ) ) { ?>
            <div class="container">                
                <div class="footer-center row">
                    <div class="<?php echo esc_attr( $vedanta_pre_css ); ?>">
                        <?php
                        if ( is_active_sidebar( 'footer-1' ) ) :
                            dynamic_sidebar( 'footer-1' );
                        endif;
                        ?>
                    </div>
                    <?php if ( $ved_footer_widget_col != "one" ) { ?>
                        <div class="<?php echo esc_attr( $vedanta_footer_css ); ?>">
                            <?php
                            if ( is_active_sidebar( 'footer-2' ) ) :
                                dynamic_sidebar( 'footer-2' );
                            endif;
                            ?>
                        </div>
                    <?php } if ( $ved_footer_widget_col != "one" && $ved_footer_widget_col != "two" ) { ?>
                        <div class="<?php echo esc_attr( $vedanta_footer_css ); ?>">
                            <?php
                            if ( is_active_sidebar( 'footer-3' ) ) :
                                dynamic_sidebar( 'footer-3' );
                            endif;
                            ?>
                        </div>
                    <?php } if ( $ved_footer_widget_col != "one" && $ved_footer_widget_col != "two" && $ved_footer_widget_col != "three" ) { ?>
                        <div class="<?php echo esc_attr( $vedanta_footer_css ); ?>">
                            <?php
                            if ( is_active_sidebar( 'footer-4' ) ) :
                                dynamic_sidebar( 'footer-4' );
                            endif;
                            ?>
                        </div>
                    <?php } if ( $ved_footer_widget_col != "one" && $ved_footer_widget_col != "two" && $ved_footer_widget_col != "three" && $ved_footer_widget_col != "four" ) { ?>                   
                        <div class="<?php echo esc_attr( $vedanta_pre_css ); ?>">
                            <?php
                            if ( is_active_sidebar( 'footer-5' ) ) :
                                dynamic_sidebar( 'footer-5' );
                            endif;
                            ?>
                        </div>
                    <?php } ?>
                </div><!-- .row -->
                <div class="after-footer">
                    <?php
                    if ( is_active_sidebar( 'after-footer' ) ) :
                        dynamic_sidebar( 'after-footer' );
                    endif;
                    ?>
                </div>
            </div><!-- .container -->
        <?php } ?>
        <div class="copyright">	
            <div class="container"><!-- .container fluid -->
                <div class="footer-payment">
                    <div class="col-xs-12 col-md-5 footer-pay-p">
                        <?php
                        $ved_footer_content = vedanta_get_option( 'ved_footer_content', '' );
                        echo wp_kses_post( $ved_footer_content );
                        ?>
                    </div>
                    <div class="col-xs-12 col-md-7 text-center">

                        <div id="paiement_logos" class="payment_logos_images">
                            <p class="payment-p"><?php echo esc_html_e( 'Payment acceptable on', 'godecore' ); ?></p>
                            <?php
                            for ( $i = 1; $i <= 6; $i ++  ) {
                                $ved_footer_payment_icon = vedanta_get_option( 'ved_footer_payment_icon' . $i );
                                $ved_footer_payment_link = vedanta_get_option( 'ved_footer_payment_link' . $i );
								if ( $ved_footer_payment_link && isset($ved_footer_payment_icon['url']) && $ved_footer_payment_icon['url'] ) :
                                    echo '<a href="' . esc_url( $ved_footer_payment_link ) . '"><img src="' . esc_url( $ved_footer_payment_icon['url'] ) . '" alt="payment_icon" width="40" height="25"></a>';
                                endif;
                            }
                            ?>
                        </div>

                    </div>
                </div><!-- .row -->
            </div>
        </div>
    </div>
</footer>
<!-- END FOOTER -->

</div>
<!-- END WRAPPER -->

<?php wp_footer(); ?>

</body>
</html>
