<?php
//Header Topbar
vedanta_header_topbar();

$ved_show_search = vedanta_get_option( 'ved_show_search' );
$ved_show_header_cart = vedanta_get_option( 'ved_show_header_cart' );
$ved_show_header_compare = vedanta_get_option( 'ved_show_header_compare' );
$ved_show_header_wishlist = vedanta_get_option( 'ved_show_header_wishlist' );
$ved_cat_menu_status = vedanta_get_option( 'ved_cat_menu_status' );
$ved_sticky_header = vedanta_get_option( 'ved_sticky_header' );

$css_header_menu        = 'col-md-12 col-sm-12';
if ( $ved_cat_menu_status == 'enable' ) {
    $css_header_menu = 'col-md-9 col-sm-9';
}
?>

<!--desktop-header-->
<div class="header-main-wapper hidden-md-down">
    <div class="header-main">
        <div class="container">
            <div class="row">
                <div class="header-row">
                    <div class="header-logo col-md-3 col-sm-6">
                        <div id="_desktop_logo" class="d-logo">
                            <!-- YOUR LOGO HERE -->
                            <div class="inner-header site-identity">
                                <?php
                                $ved_header_logo               = vedanta_get_option( 'ved_header_logo', '' );
                                $ved_header_logo_retina        = vedanta_get_option( 'ved_header_logo_retina', '' );
                                $ved_header_logo_retina_width  = vedanta_get_option( 'ved_header_logo_retina_width', '' );
                                $ved_header_logo_retina_height = vedanta_get_option( 'ved_header_logo_retina_height', '' );
                                if ( $ved_header_logo != '' || $ved_header_logo_retina != '' ) {
                                    ?>
                                    <a class="inner-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                        <?php
                                       if ( $ved_header_logo != '' ):
                                            ?>
                                            <img class="normal-logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($ved_header_logo); ?>">
                                            <?php
                                        endif;
                                        if ( $ved_header_logo_retina != "" && $ved_header_logo_retina_width != "" && $ved_header_logo_retina_height != "" ):
                                            $pixels = "";
                                            if ( is_numeric( $ved_header_logo_retina_width ) && is_numeric( $ved_header_logo_retina_height ) ):
                                                $pixels = "px";
                                            endif;
                                            ?>
                                            <img class="retina-logo" alt="<?php bloginfo( 'name' ); ?>" src="<?php echo esc_url($ved_header_logo_retina); ?>" style="max-width:<?php echo esc_attr($ved_header_logo_retina_width . $pixels); ?>;max-height:<?php echo esc_attr($ved_header_logo_retina_height . $pixels); ?>;" />
                                            <?php
                                        endif;
                                        ?>
                                    </a>
                                    <?php
                                } else {
                                    $ved_blog_title   = vedanta_get_option( 'ved_blog_title', '0' );
                                    $ved_blog_tagline = vedanta_get_option( 'ved_blog_tagline', '0' );
                                    if ( $ved_blog_title == 1 ) {
                                        ?>
                                        <div id="blog-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ) ?></a></div> 
                                        <?php
                                    }
                                    if ( $ved_blog_tagline == 1 ) {
                                        ?>
                                        <div id="tagline"><?php echo esc_html( get_bloginfo( 'description' ) ); ?></div>
                                        <?php
                                    }
                                }
                                ?>         
                            </div>
                        </div>

                    </div>
                        <div class="header-extras col-lg-7 col-md-6 col-sm-6 col-xs-6">
                            <?php 
								if ( $ved_show_search ) {
									vedanta_header_search(); 
								}
							?>
                        </div>
                        <div class="col-lg-2 col-md-3">
                            <div class="extras-menu">
                                <?php
								if ( $ved_show_header_cart ) {
									vedanta_header_cart();
								}
								if ( $ved_show_header_compare ) {
									vedanta_topbar_compare();
								}
								if ( $ved_show_header_wishlist ) {
									vedanta_topbar_wishlist();
								}
                                ?>
                            </div>		    
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="main-menu hidden-md-down">
    <div class="container">
        <div class="row">
            <div class="header-row">
                <?php if ( $ved_cat_menu_status == 'enable' ) : ?>
                    <div class="col-md-3 col-sm-3 i-product-cats ved-extra-department">
                        <?php vedanta_categories_menu(); ?>
                    </div>
                <?php endif; ?>
					<div class="<?php echo esc_attr( $css_header_menu ); ?> ved-header-main-menu">
						<?php vedanta_header_menu(); ?>
					</div>
            </div>
        </div>
    </div>
</div>

<?php
//Header Mobile
vedanta_header_mobilebar();

if ($ved_sticky_header) {
	//Header Sticky
	vedanta_header_sticky();
}