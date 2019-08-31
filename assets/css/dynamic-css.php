<?php
global $post, $wp_query, $ved_options;
$vedanta_dynamic_css	 = '';
$vedanta_template_url	 = get_template_directory_uri();

$post_id = '';
if ( $wp_query->is_posts_page ) {
    $post_id = get_option( 'page_for_posts' );
} elseif ( function_exists( 'is_buddypress' ) ) {
        if ( is_buddypress() ) {
            $post_id = vedanta_bp_get_id();
        } else {
            $post_id = isset( $post->ID ) ? $post->ID : '';
        }
} elseif ( function_exists( 'is_shop' ) ) {
        if ( is_shop() ) {
            $post_id = wc_get_page_id('shop');
        } else {
            $post_id = isset( $post->ID ) ? $post->ID : '';
        }
} else {
    $post_id = isset( $post->ID ) ? $post->ID : '';
}

/* -----------------------------------------------------------------
  [General Layout Options]
 */
$ved_width_layout		 = $ved_options[ 'ved_width_layout' ];
$ved_width_px			 = $ved_options[ 'ved_width_px' ];
$ved_custom_width_px		 = $ved_options[ 'ved_custom_width_px' ];
$ved_container_width_px		 = (int)$ved_width_px - 30;
$ved_container_custom_width_px	 = (int)$ved_custom_width_px - 30;

//General - Layout Width
if ( $ved_width_px != "custom" && ( $ved_width_layout == "fixed" ) && ! is_page_template( 'fullwidth-fluid.php' ) ) {
	$vedanta_dynamic_css .= '
		body {
	width: ' . esc_attr($ved_width_px) . 'px;
	margin: 0 auto;
}
@media (min-width: ' . esc_attr($ved_width_px) . 'px) {
    .container {
        width: ' . esc_attr($ved_container_width_px) . 'px;
    }
}
';
} elseif ( $ved_width_px != "custom" ) {
	$vedanta_dynamic_css .= '
@media (min-width: ' . esc_attr($ved_width_px) . 'px) {
    .container {
        width: ' . esc_attr($ved_container_width_px) . 'px;
    }
    .menu-back .container:first-child {
        width: 100%;
        padding-left: 0px;
        padding-right: 0px;
    }
}
';
} elseif ( $ved_width_px == "custom" && ( $ved_width_layout == "fixed" ) && ! is_page_template( 'fullwidth-fluid.php' ) ) {
	$vedanta_dynamic_css .= '
body {
	width: ' . esc_attr($ved_custom_width_px) . 'px;
	margin: 0 auto;
}
@media (min-width: ' . esc_attr($ved_custom_width_px) . 'px) {
    .container {
        width: ' . esc_attr($ved_container_custom_width_px) . 'px;
    }
}
';
} elseif ( $ved_width_px == "custom" ) {
	$vedanta_dynamic_css .= '
@media (min-width: ' . esc_attr($ved_custom_width_px) . 'px) {
    .container {
        width: ' . esc_attr($ved_container_custom_width_px) . 'px;
    }
    .menu-back .container:first-child {
        width: 100%;
        padding-left: 0px;
        padding-right: 0px;
    }
}
';
}

// General - Fullwidth - Fluid Template Left/Right Padding
$ved_hundredp_padding		 = $ved_options[ 'ved_hundredp_padding' ];
$vedanta_hundredp_padding	 = get_post_meta( $post_id, 'vedanta_hundredp_padding', true );
if ( is_page_template( 'fullwidth-fluid.php' ) ) {
	if ( $vedanta_hundredp_padding ) {
		$vedanta_dynamic_css .= ' 	
			.page-100-width {
			    padding-left: ' . esc_attr($vedanta_hundredp_padding) . ';
			    padding-right: ' . esc_attr($vedanta_hundredp_padding) . ';
			}
		';
	} else {
		$vedanta_dynamic_css .= ' 	
			.page-100-width {
			    padding-left: ' . esc_attr($ved_hundredp_padding) . ';
			    padding-right: ' . esc_attr($ved_hundredp_padding) . ';
			}
		';
	}
}

//product border
$ved_product_border_type = $ved_options[ 'ved_product_border_type' ];
if( $ved_product_border_type == 'border_image' ) {
	$vedanta_dynamic_css .= '
	.border_image .grid .product-inner .product-thumbnail{
		border: 1px solid #e2e2e2;
	}
	';
}
if( $ved_product_border_type == 'full_border_image' ) {
	$vedanta_dynamic_css .= '
	.full_border_image .grid .product-inner{
		border: 1px solid #e2e2e2;
	}
	.full_border_image .grid .product-inner .product-info {
	    padding: 10px;
	}
';
}

// General - Content Top & Bottom Padding
$ved_content_top_bottom_padding = $ved_options[ 'ved_content_top_bottom_padding' ];
$vedanta_content_top_bottom_padding	 = get_post_meta( $post_id, 'vedanta_content_top_bottom_padding', true );
if ( $vedanta_content_top_bottom_padding ) {
	$vedanta_dynamic_css .= '
	.p-tb-content {
		padding-top:' . esc_attr($vedanta_content_top_bottom_padding) . ';
		padding-bottom:' . esc_attr($vedanta_content_top_bottom_padding) . ';
		padding-left: 0;
		padding-right: 0;
}
';
} elseif( $ved_content_top_bottom_padding ) {
	$vedanta_dynamic_css .= '
	.p-tb-content {
		padding-top:' . esc_attr($ved_content_top_bottom_padding[ 'padding-top' ]) . ';
		padding-bottom:' . esc_attr($ved_content_top_bottom_padding[ 'padding-bottom' ]) . ';
		padding-left: 0;
		padding-right: 0;
}
';
}

// General - Body Top & Bottom Padding
$ved_body_top_bottom_spacing = $ved_options[ 'ved_body_top_bottom_spacing' ];
$ved_width_layout = $ved_options[ 'ved_width_layout' ];
if( $ved_body_top_bottom_spacing && $ved_width_layout == 'fixed' ) {
	$vedanta_dynamic_css .= '
	body {
		margin-top:' . esc_attr($ved_body_top_bottom_spacing[ 'padding-top' ]) . ';
		margin-bottom:' . esc_attr($ved_body_top_bottom_spacing[ 'padding-bottom' ]) . ';
}
';
}

/* -----------------------------------------------------------------
  [Header Section Style]
 */

//Header Topbar bgColor
if ( $ved_options['ved_topbar_bg_type'] == 'custom' ) {
	$vedanta_dynamic_css .= '
	.top-bar.top-bar-color {
		background: ' . esc_attr($ved_options[ 'ved_topbar_bg_color' ]) . ';
	}
';

	$vedanta_dynamic_css .= '
	#header .top-bar p,#header .top-bar-list a, #header .top-bar-right .dropdown > .expand-more,#header .top-bar .header-social.social-icons > li > a,#header .top-bar .language > a,#header .top-bar .woocommerce-currency-switcher-form select {
		color: ' . esc_attr($ved_options[ 'ved_topbar_text_color' ]) . ';
	}
';
}

//Fixheader bgColor
if($ved_options['ved_sticky_header']) {
 
	$vedanta_dynamic_css .= '
	#header-sticky-wrapper {
		background: ' . esc_attr($ved_options[ 'ved_sticky_header_color' ]) . ';
	}
	#header-sticky-wrapper .primary-nav .inner-nav > li > a,#header-sticky-wrapper .extras-menu #open-cart,#header-sticky-wrapper .extras-menu .yith-contents{
		color: '. esc_attr($ved_options[ 'ved_sticky_header_text_color' ]) .';
	}
	#header-sticky-wrapper .inner-nav > li:hover > a,#header-sticky-wrapper .extras-menu #open-cart:hover,#header-sticky-wrapper .extras-menu .yith-contents:hover, #header-sticky-wrapper .sub-menu li.submenu-open > a{
		color: '. esc_attr($ved_options[ 'ved_sticky_header_link_color' ]) .';	
	}
	';

}

// Hero Header Custom Height
$vedanta_hero_height_custom	 = get_post_meta( $post_id, 'vedanta_hero_height_custom', true );
if ( $vedanta_hero_height_custom ) {
$vedanta_dynamic_css		 .= '
.hero-height-custom {
	height: ' . esc_attr($vedanta_hero_height_custom) . 'vh;
}
';
}

//Header Background Color
if ( $ved_options[ 'ved_header_bg_type' ] == 'custom'  ) {
$vedanta_dynamic_css .= '
	.header-main-wapper {
		background: ' . esc_attr($ved_options[ 'ved_header_bg_color' ]) . ';
	}
	.extras-menu .yith-contents, .extras-menu #open-cart,.header-2 #_desktop_search,.header-2 #_desktop_search .icon-wrap{
		color: ' . esc_attr($ved_options[ 'ved_header_text_color' ]) . ';
	}
';
}

//Mobile Header Background Color
$vedanta_dynamic_css .= '
	.mobile-menu {
		background: ' . esc_attr($ved_options[ 'ved_mobile_header_bg_color' ]) . ';
	}
';

$vedanta_dynamic_css .= '
	.mobile-logo-bar .menu-icon,#_mobile_cart .header-ajax-cart .icon-box, #_mobile_fix_cart .header-ajax-cart .icon-box{
		color: ' . esc_attr($ved_options[ 'ved_mobile_header_text_color' ]) . ';
	}
';

$vedanta_dynamic_css .= '
	.mobile-search-bar {
		background: ' . esc_attr($ved_options[ 'ved_mobile_search_bg_color' ]) . ';
	}
';

/* -----------------------------------------------------------------
  [Page Title Bar Style]
 */
$ved_pagetitlebar_height			 = vedanta_get_option( 'ved_pagetitlebar_height', 'medium' );
$vedanta_page_title_bar_height		 = get_post_meta( $post_id, 'vedanta_page_title_bar_height', true );
if ( !$vedanta_page_title_bar_height ) {
        $vedanta_page_title_bar_height = 'default';
}
$ved_pagetitlebar_custom			 = vedanta_get_option( 'ved_pagetitlebar_custom', '' );
$vedanta_page_title_bar_height_custom	 = get_post_meta( $post_id, 'vedanta_page_title_bar_height_custom', true );

// 1.1 Page Title Bar Custom Height
if ( $vedanta_page_title_bar_height == 'custom' && $vedanta_page_title_bar_height_custom ) {
	$vedanta_dynamic_css .= '
.titlebar-custom {
	padding: ' . esc_attr($vedanta_page_title_bar_height_custom) . 'px 0;
}
';
} elseif ( $vedanta_page_title_bar_height == 'default' && $ved_pagetitlebar_height == 'custom' && $ved_pagetitlebar_custom ) {
	$vedanta_dynamic_css .= '
.titlebar-custom {
	padding: ' . esc_attr($ved_pagetitlebar_custom) . 'px 0;
}
';
}

$vedanta_enable_page_title	 = get_post_meta( $post_id, 'vedanta_enable_page_title', true );
if (empty($vedanta_enable_page_title)) {
    $vedanta_enable_page_title = 'default';
}
$ved_pagetitlebar_background_color	 = vedanta_get_option( 'ved_pagetitlebar_background_color', '' );
$vedanta_page_title_bar_bg_color	 = get_post_meta( $post_id, 'vedanta_page_title_bar_bg_color', true );
// 1.2 Page Title Bar Background Color
if ( $vedanta_page_title_bar_bg_color ) {
	$vedanta_dynamic_css .= '
.titlebar-bg {
	background-color: ' . esc_attr($vedanta_page_title_bar_bg_color) . ';
}
';
} elseif ( $vedanta_enable_page_title == 'default' && $ved_pagetitlebar_background_color ) {
	$vedanta_dynamic_css .= '
.titlebar-bg {
	background-color: ' . esc_attr($ved_pagetitlebar_background_color) . ';
}
';
}

$ved_pagetitlebar_background	 = vedanta_get_option( 'ved_pagetitlebar_background', '' );
$vedanta_page_title_bar_bg	 = get_post_meta( $post_id, 'vedanta_page_title_bar_bg', true );
// 1.3 Page Title Bar Background Image
if ( $vedanta_page_title_bar_bg ) {
	$vedanta_dynamic_css .= '
.titlebar-bg {
	background-image: url("' . esc_url(wp_get_attachment_url( $vedanta_page_title_bar_bg )) . '");
}
.titlebar-bg *{
	color:#fff
}
';
} elseif ( $vedanta_enable_page_title == 'default' && isset( $ved_pagetitlebar_background[ 'url' ] ) && $ved_pagetitlebar_background[ 'url' ] ) {
	$vedanta_dynamic_css .= '
.titlebar-bg {
	background-image: url("' . esc_url($ved_pagetitlebar_background[ 'url' ]) . '");
}
.titlebar-bg *{
	color:#fff
}
';
}
$ved_header_icon_color = vedanta_get_option( 'ved_header_icon_color', '' );
$vedanta_dynamic_css .= '
.extras-menu .yith-contents, .extras-menu #open-cart, .extras-menu #_desktop_search .icon-wrap,#_desktop_wishtlistTop .yith-contents{
	color:' . esc_attr($ved_header_icon_color) . ';
}
';
$ved_header_icon_color_hover = vedanta_get_option( 'ved_header_icon_color_hover', '' );
$vedanta_dynamic_css .= '
.extras-menu #_desktop_search .icon-wrap:hover,.extras-menu .yith-contents:hover, .extras-menu #open-cart:hover,#_desktop_wishtlistTop .yith-contents:hover{
	color:' . esc_attr($ved_header_icon_color_hover) . ';
}
';
/* -----------------------------------------------------------------
  [Footer Style]
 */
$ved_main_pattern	 = vedanta_get_option( 'ved_pattern', '' );
$ved_image_patten_array	 = array( 'none', 'pattern_1_thumb.png', 'pattern_2_thumb.png', 'pattern_3_thumb.png', 'pattern_4_thumb.png', 'pattern_5_thumb.png', 'pattern_6_thumb.png', 'pattern_7_thumb.png', 'pattern_8_thumb.png' );
if ( ! empty( $ved_main_pattern ) && $ved_main_pattern != 'none' && in_array( $ved_main_pattern, $ved_image_patten_array ) ) {
	$ved_main_pattern	 = $vedanta_template_url . '/assets/images/pattern/' . $ved_main_pattern;
	$vedanta_dynamic_css	 .= '
    .footer {
	background-image: url(' .  esc_url($ved_main_pattern) . ');
    }
    ';
} else {
	$ved_footer_image_src		 = vedanta_get_option( 'ved_footer_background_image' );
	$ved_footer_image		 = vedanta_get_option( 'ved_footer_image', 'cover' );
	$ved_footer_background_repeat	 = vedanta_get_option( 'ved_footer_image_background_repeat', 'no-repeat' );
	$ved_footer_background_position	 = vedanta_get_option( 'ved_footer_image_background_position', 'center top' );
	if ( isset($ved_footer_image_src[ 'url' ]) && $ved_footer_image_src[ 'url' ] ) {
		$vedanta_dynamic_css .= '
.footer {
	background-image: url("' . esc_url( $ved_footer_image_src[ 'url' ] ) . '");
	background-position: ' . esc_attr($ved_footer_background_position) . ';
	background-repeat: ' . esc_attr($ved_footer_background_repeat) . ';
	border-bottom: 0;
	background-size: ' . esc_attr($ved_footer_image) . ';
	width: 100%;
}
';
	}

	$ved_footer_bg_color = vedanta_get_option( 'ved_footer_bg_color', '' );
	if ( ! empty( $ved_footer_bg_color ) ) {
		$vedanta_dynamic_css .= '
.footer{
	background-color: ' . esc_attr($ved_footer_bg_color) . ';
}
';
	}

	$ved_footer_parallax = vedanta_get_option( 'ved_footer_parallax', '' );
	if ( $ved_footer_parallax == 1 ) {
		$vedanta_dynamic_css .= '
.footer {
	background-attachment: fixed;
}
';
	}
}

/* -----------------------------------------------------------------
  [Portfolio Style]
 */
$ved_portfolio_hover_color	 = vedanta_get_option( 'ved_portfolio_hover_color', '' );
$rgb				 = vedanta_hex2rgb( $ved_portfolio_hover_color );
if ( is_array( $rgb ) ) {
	$vedanta_dynamic_css .= '
.works-grid .work-overlay {
	background: rgba(' . esc_attr($rgb[ 0 ] . ', ' . $rgb[ 1 ] . ', ' . $rgb[ 2 ]) . ', 0.8);
}
';
}

/* -----------------------------------------------------------------
  [Retina Support Style]
 */
$ved_header_logo_retina = vedanta_get_option( 'ved_header_logo_retina', '' );
if ( $ved_header_logo_retina != "" ) {
	$vedanta_dynamic_css .= '
@media only screen and (-webkit-min-device-pixel-ratio: 1.3),
only screen and (-o-min-device-pixel-ratio: 13/10),
only screen and (min-resolution: 120dpi) {
    .site-identity .normal-logo {
        display: none;
    }
    .site-identity .retina-logo {
        display: inline-block;
    }
}
';
}

/* -----------------------------------------------------------------
  [Typography Style]
 */

// Custom Fonts
$ved_custom_font_woff	 = vedanta_get_option( 'ved_custom_font_woff' );
$ved_custom_font_ttf	 = vedanta_get_option( 'ved_custom_font_ttf' );
$ved_custom_font_svg	 = vedanta_get_option( 'ved_custom_font_svg' );
$ved_custom_font_eot	 = vedanta_get_option( 'ved_custom_font_eot' );
if ( isset( $ved_custom_font_woff[ 'url' ] ) && $ved_custom_font_woff[ 'url' ] 
    && isset($ved_custom_font_svg[ 'url' ]) && $ved_custom_font_svg[ 'url' ] 
    && isset($ved_custom_font_eot[ 'url' ]) && $ved_custom_font_eot[ 'url' ] 
    && isset($ved_custom_font_ttf[ 'url' ]) && $ved_custom_font_ttf[ 'url' ] ) {
		$vedanta_dynamic_css .= '
			@font-face {
				font-family: "CustomFont";
				src: url("' .  esc_url($ved_custom_font_eot[ 'url' ]) . '");
				src: url("' .  esc_url($ved_custom_font_eot[ 'url' ]) . '?#iefix") format("eot"), url("' .  esc_url($ved_custom_font_woff[ 'url' ]) . '") format("woff"), url("' .  esc_url($ved_custom_font_ttf[ 'url' ]) . '") format("truetype"), url("' .  esc_url($ved_custom_font_svg[ 'url' ]) . '#CustomFont") format("svg");
				font-weight: 400;
				font-style: normal;
			}
		';
}

//Body Font
$vedanta_dynamic_css		 .= vedanta_print_fonts( 'ved_body_font', 'body', $additional_color_css_class = '', $imp = '' );

//Blog Title Font
$vedanta_dynamic_css		 .= vedanta_print_fonts( 'ved_title_font', '#blog-title', $additional_css = 'line-height:1.2', $additional_color_css_class = '', $imp = '' );

//Blog Tagline Font
$vedanta_dynamic_css		 .= vedanta_print_fonts( 'ved_tagline_font', '#tagline', $additional_css = 'line-height:1.8', $additional_color_css_class = '', $imp = '' );

//Main Menu Font
$vedanta_dynamic_css		 .= vedanta_print_fonts( 'ved_menu_font', '.ved-header-main-menu .primary-nav .inner-nav > li > a', $additional_color_css_class = '', $imp = '' );

//Top Menu Font
$vedanta_dynamic_css		 .= vedanta_print_fonts( 'ved_top_menu_font', '.top-bar-list', $additional_css = 'line-height:1.8', $additional_color_css_class = '', $imp = '' );

//Post Title Font
$vedanta_dynamic_css		 .= vedanta_print_fonts( 'ved_post_font', '.entry-header .post-title', $additional_css = 'line-height:1.2', $additional_color_css_class = '', $imp = '' );

//Post Content Font
$vedanta_dynamic_css		 .= vedanta_print_fonts( 'ved_content_font', '.entry-content', $additional_css = 'line-height:1.8', $additional_color_css_class = '', $imp = '' );

//Widget Title Font
$vedanta_dynamic_css		 .= vedanta_print_fonts( 'ved_widget_title_font', '.widget-content .text-title', $additional_css = 'line-height:1.2', $additional_color_css_class = '', $imp = '' );

//Widget Content Font
$vedanta_dynamic_css		 .= vedanta_print_fonts( 'ved_widget_content_font', '.widget-content', $additional_css = 'line-height:1.8', $additional_color_css_class = '', $imp = '' );

//Footer Widget Title Font
$vedanta_dynamic_css		 .= vedanta_print_fonts( 'ved_footer_widget_title_font', '.footer .widget-content .text-title', $additional_css = 'line-height:1.2', $additional_color_css_class = '', $imp = '' );

//Footer Widget Content Font
$vedanta_dynamic_css		 .= vedanta_print_fonts( 'ved_footer_widget_content_font', '.footer .widget-content,.footer .widget-content a,.footer > .footer-bg-black > .container p', $additional_color_css_class = '', $imp = '' );

//H1 to H6 Font
for ( $i = 1; $i < 7; $i ++ ) {
	//we get all h1 to h6 Fonts, ved_content_h1_font ... to ved_content_h6_font values.
	$vedanta_dynamic_css	 .= vedanta_print_fonts( 'ved_content_h' . $i . '_font', "h{$i}", $additional_css = '' );
}


// footer style option
$ved_footer_widget_content_font_hover	 = $ved_options[ 'ved_footer_widget_content_font_hover' ];
$vedanta_dynamic_css .= '
.footer .widget .widget-content ul li a:hover,
.footer-center .widget .widget-content a:hover
{
	color: ' . esc_attr($ved_footer_widget_content_font_hover) . ';
}
';


/* -----------------------------------------------------------------
  [General Style Options]
 */

$ved_main_menu_hover_font_color	 = $ved_options[ 'ved_main_menu_hover_font_color' ];
$ved_sub_menu_hover_font_color	 = $ved_options[ 'ved_sub_menu_hover_font_color' ];
$ved_form_bg_color		 = $ved_options[ 'ved_form_bg_color' ];
$ved_form_text_color		 = $ved_options[ 'ved_form_text_color' ];
$ved_form_border_color		 = $ved_options[ 'ved_form_border_color' ];

$vedanta_dynamic_css .= '
.sub-menu li > a:hover, 
.sub-menu li > a:focus, 
.sub-menu li.submenu-open > a {
	color: ' . esc_attr($ved_sub_menu_hover_font_color) . ';
}
.form-control,.form-control, input[type=text],.woocommerce-input-wrapper .select2-selection,.select2-selection,
.select2-container--default .select2-selection--single,
.woocommerce .woocommerce-Input, .woocommerce-form-coupon .input-text, .widget_product_search .widget-content .search-field, .wpcf7-text, .wpcf7-number, .wpcf7-date, .wpcf7-textarea, .wpcf7-select, .mc4wp-form-fields .input-wrapper input,select {
	background-color: ' . esc_attr($ved_form_bg_color) . ';
	color: ' . esc_attr($ved_form_text_color) . ';
	border-color: ' . esc_attr($ved_form_border_color) . ';
}
';

/* -----------------------------------------------------------------
  [Social Sharing Box Options]
 */

$ved_sharing_box_icon_color	 = $ved_options[ 'ved_sharing_box_icon_color' ];
$ved_sharing_box_color		 = $ved_options[ 'ved_sharing_box_color' ];
$ved_sharing_box_radius		 = $ved_options[ 'ved_sharing_box_radius' ];

$vedanta_dynamic_css .= '
.share-this a {
	background: ' . esc_attr($ved_sharing_box_color) . ';
	border-radius: ' . esc_attr($ved_sharing_box_radius) . ';
	color: ' . esc_attr($ved_sharing_box_icon_color) . ';
}
';

/* -----------------------------------------------------------------
  [Social Media Links Options]
 */
$ved_social_color	 = $ved_options[ 'ved_social_color' ];
$ved_social_boxed_color	 = $ved_options[ 'ved_social_boxed_color' ];
$ved_social_boxed_radius	 = $ved_options[ 'ved_social_boxed_radius' ];

$vedanta_dynamic_css .= '
.header-social.social-icons > li > a {
	color: ' . esc_attr($ved_social_color) . ';
}
.header-social.boxed-icons > li > a {
	background: ' . esc_attr($ved_social_boxed_color) . ';
	border-radius: ' . esc_attr($ved_social_boxed_radius) . ';
	border-color: ' . esc_attr($ved_social_boxed_color) . ';
}
';

$ved_maintenance_textcolor = vedanta_get_option( 'ved_maintenance_text_color', '#222222' );
$vedanta_dynamic_css .= '
.ved_maintenance h1, .ved_maintenance .mntc-subtitle, .coming-soon-countdown h2, .mntc-tit, .time_circles > div > h4, .time_circles > div > span{
	color:' . esc_attr($ved_maintenance_textcolor) . ';
}
';

$ved_social_icon_color = vedanta_get_option( 'ved_social_iconcolor', '#222222' );
$vedanta_dynamic_css .= '
.ved_maintenance .header-social.social-icons > li > a{
	color:' . esc_attr($ved_social_icon_color) . ';
}
';

$ved_social_icon_hovercolor = vedanta_get_option( 'ved_social_icon_hover_color', '#ffffff' );
$vedanta_dynamic_css .= '
.ved_maintenance .header-social.social-icons > li > a:hover{
	color:' . esc_attr($ved_social_icon_hovercolor) . ';
}
';

$ved_newsletter_button_backgroundcolor = vedanta_get_option( 'ved_newsletter_button_background_color', '#222222' );
$vedanta_dynamic_css .= '
.ved_maintenance .maintenance-newsletter .newsletter_submit.btn.btn-base{
	background-color:' . esc_attr($ved_newsletter_button_backgroundcolor) . ';
}
';

$ved_newsletter_button_textcolor = vedanta_get_option( 'ved_newsletter_button_text_color', '#fff' );
$vedanta_dynamic_css .= '
.ved_maintenance .maintenance-newsletter .newsletter_submit.btn.btn-base{
	color:' . esc_attr($ved_newsletter_button_textcolor) . ';
}
';

$ved_newsletter_button_text_hovercolor = vedanta_get_option( 'ved_newsletter_button_text_hover_color', '#fff' );
$vedanta_dynamic_css .= '
.ved_maintenance .maintenance-newsletter .newsletter_submit.btn.btn-base:hover{
	color:' . esc_attr($ved_newsletter_button_text_hovercolor) . ';
}
';

/* -----------------------------------------------------------------
  [Menu Style]
 */
$ved_menu_text_transform	 = vedanta_get_option( 'ved_menu_text_transform', 'none' );
$vedanta_dynamic_css	 .= '
.primary-nav .inner-nav > li > a {
	text-transform: ' . esc_attr($ved_menu_text_transform) . ';
}
';

/* -----------------------------------------------------------------
  [Mega Menu Style]
 */


$ved_megamenu_title_size	 = vedanta_get_option( 'ved_megamenu_title_size', '15px' );
$ved_menu_font		 = vedanta_get_option( 'ved_menu_font' );
$ved_widget_content_font	 = vedanta_get_option( 'ved_widget_content_font' );

if ( $ved_width_px != "custom" ) {
	$vedanta_width_col_span_1	 = (int)$ved_container_width_px / 4;
	$vedanta_width_col_span_2	 = (int)$vedanta_width_col_span_1 * 2;
	$vedanta_width_col_span_3	 = (int)$vedanta_width_col_span_1 * 3;

	$vedanta_dynamic_css .= '
@media (min-width: ' . esc_attr($ved_width_px) . 'px) {
    #wrapper .t4p-megamenu-wrapper.col-span-1 {
        width: ' . esc_attr($vedanta_width_col_span_1) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper.col-span-2 {
        width: ' . esc_attr($vedanta_width_col_span_2) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper.col-span-3 {
        width: ' . esc_attr($vedanta_width_col_span_3) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper {
        width: ' . esc_attr($ved_container_width_px) . 'px;
    }
}
';
} else {

	$vedanta_width_col_span_1	 = (int)$ved_container_custom_width_px / 4;
	$vedanta_width_col_span_2	 = (int)$vedanta_width_col_span_1 * 2;
	$vedanta_width_col_span_3	 = (int)$vedanta_width_col_span_1 * 3;

	$vedanta_dynamic_css .= '
@media (min-width: ' . esc_attr($ved_custom_width_px) . 'px) {
    #wrapper .t4p-megamenu-wrapper.col-span-1 {
        width: ' . esc_attr($vedanta_width_col_span_1) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper.col-span-2 {
        width: ' . esc_attr($vedanta_width_col_span_2) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper.col-span-3 {
        width: ' . esc_attr($vedanta_width_col_span_3) . 'px;
    }
    #wrapper .t4p-megamenu-wrapper {
        width: ' . esc_attr($ved_container_custom_width_px) . 'px;
    }
}
';
}

	$vedanta_dynamic_css .= '
 .ved-megamenu-wrapper .ved-megamenu-title {
    font-family: ' . esc_attr($ved_menu_font[ 'font-family' ]) . ';
    font-size: ' . esc_attr($ved_megamenu_title_size) . ';
    text-transform: ' . esc_attr($ved_menu_text_transform) . ';
}
.vertical-megamenu .ved-megamenu-menu.has-submenu .ved-megamenu-wrapper .ved-megamenu-title a{
	font-size: ' . esc_attr($ved_megamenu_title_size) . ';
	text-transform: ' . esc_attr($ved_menu_text_transform) . ';
}
.ved-megamenu-wrapper .ved-megamenu-bullet,
.ved-megamenu-bullet {
    border-left: 3px solid ' . esc_attr($ved_menu_font[ 'color' ]) . ';
}

ul.nav-menu .ved-megamenu-menu .widget-content a {
    color: ' . esc_attr($ved_widget_content_font[ 'color' ]) . ' ;
}

ul.nav-menu li li:hover .ved-megamenu-title,
ul.nav-menu li li:hover .ved-megamenu-title a,
ul.nav-menu li li.current-menu-item .ved-megamenu-title, 
ul.nav-menu li li.current-menu-item .ved-megamenu-title a, 
ul.nav-menu li li.current-menu-ancestor .ved-megamenu-title,
ul.nav-menu li li.current-menu-ancestor .ved-megamenu-title a,
.primary-nav .inner-nav > li:hover > a, .primary-nav .inner-nav > li > a:focus, .ved-main-megamenu .inner-nav > li.submenu-open > a {
    color: ' . esc_attr($ved_main_menu_hover_font_color) . ';
}
';

/* -----------------------------------------------------------------
  [Main Color Scheme Style]
 */

$ved_primary_color	 = vedanta_get_option( 'ved_primary_color', '#3ab54a' );
$ved_secondry_color	 = vedanta_get_option( 'ved_secondry_color', '#3ab54a' );
$ved_tertiary_color	 = vedanta_get_option( 'ved_tertiary_color', '#FFFFFF' );
$vedanta_dynamic_css	 .= '
::-moz-selection {
    background: ' . esc_attr($ved_primary_color) . ';
    color: #fff!important
}

::-webkit-selection {
    background: ' . esc_attr($ved_primary_color) . ';
    color: #fff!important
}

::selection {
    background: ' . esc_attr($ved_primary_color) . ';
    color: #fff!important
}

a:hover, 
a:focus,
.post-meta>li>a:hover,
.post-meta>li>a:focus,
.top-bar-right .dropdown > .expand-more:hover,
.ved-post-item .ved-post-link .read-more:not(.btn)
{
    color: ' . esc_attr($ved_primary_color) . ';
}

.divider-line:after,
.alert-brand,
.label-base,
.btn.btn-base:hover,
.btn.btn-hovered,
.ved-read-more-button:hover,
.nav-text-tabs>li>a:after,
.owl-controls-brand .owl-dot span,
.owl-dot span,
.cart-badge,
.post.format-quote,
.post.format-quote blockquote,
.social-icons>li>a:hover,
.share-this a:focus,
.share-this a:hover,
.divider-line::after,
.button.wc-backward:hover,
.button.wc-forward,
.wishlist_table .product-add-to-cart .button:hover,
.main-slider .ved-image-slider .owl-nav > button,
.flex-direction-nav > li,
.main-slider .ved-image-slider .owl-dots .owl-dot:hover,
.flex-control-nav > li > a.flex-active,
.ved-woo-cats-slider .item .categoryName:after,
.ddPopupnewsletter-i .close,
.ved-pricing .ved-pricing-button:hover,
.header-ajax-cart .icon-box .mini-item-counter,.extras-menu .yith-contents .mini-item-counter,
.search-bg-theme .product-extra-search,.search-bg-theme .search-wrapper input,
.ved-woo-cats-slider.style1 .cat-item .cat_btn:hover,
body .btn-hovered.elementor-widget-button .elementor-button,
.products .open-quick-view,
.dddemo1 .sec-head-style .text-title:before,.dddemo1 .wishlist-title h2:before,.dddemo1 .sec-head-style .text-title:after,.dddemo1 .wishlist-title h2:after,
.dddemo1 .before-footer,
.dddemo1 .footer-center .widget_nav_menu .menu > li > a:before,.dddemo1 .footer-center .widget_nav_menu .sub-menu > li > a:before{
    background: ' . esc_attr($ved_primary_color) . ';
}
.search-bg-theme .products-search .product-cat-dd{
	background-color: ' . esc_attr($ved_primary_color) . '
}
.btn.btn-base.btn-outline,
.btn.btn-base.btn-fade:focus,
.btn.btn-base.btn-fade:hover,
.btn.btn-base.btn-link:hover,
.btn.btn-base.btn-link:focus,
.breadcrumb a:focus,
.breadcrumb a:hover,
.box-icon .icon-box-icon,
.box-icon-left .icon-box-icon,
.box-icon-right .icon-box-icon,
.nav-text-tabs>li.active>a,
.career-tags,
.comment-tools a:focus,
.comment-tools a:hover,
.icons-list a:focus,
.icons-list a:hover,
.widget .widget-content ul li a:hover,
.vertical-megamenu .inner-nav > li:hover > a,
.cart-hover .sub-cart-menu .list-product .list-product-detail a:hover,
.shop-item-title .woocommerce-loop-product__title a:hover,
.footer-center .widget_nav_menu .menu > li > a:before,
.footer-center .widget_nav_menu .sub-menu > li > a:before,
.footer-center .widget_nav_menu ul.sub-menu:not(.menu) > li > a:hover,
.post .entry-meta .read-more:hover,.navigation-links a:hover,
.woocommerce div.product div.summary .yith-wcwl-add-to-wishlist a:hover, .woocommerce div.product div.summary .compare:hover,
.ddNextPrev .nextPrevProduct a.button,
.cart-table .product-name a:hover,
.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a, .woocommerce-account .woocommerce-MyAccount-navigation ul li:hover a,
.ved-woo-cats-slider .item .sub-cat li a:hover,
.ved-woo-cats-slider .item .categoryName a:hover,
.ved-woo-product-tab .ved-nav-tab li.active a,
.ved-woo-product-tab .ved-nav-tab li a:hover,
.ved-woo-product-tab .ved-nav-tab li.active a:hover,
.ved-woo-product-tab .ved-nav-tab li.active a:focus,
.widget.woocommerce .widget-content ul li a:hover + .count,
.ved-testimonial-user,
.slick-dots li.slick-active button:before,
.portfolio-info .social-icons li a:hover,
.wc_payment_method a:hover,
.footer a:hover,
.products .product-hover-style-default .open-quick-view:hover,
.products.grid.products-loop-column-4 .product-thumbnail .product-action-quick-view a:hover:before,
.products .product-hover-style-image-bottom-2 .product-actions .product-action a:hover,
.products .product-hover-style-info-bottom .product-actions a,
.ved-quick-view-modal .modal-content .close:hover,
.page-search article .entry-meta .read-more:hover,
input[type="checkbox"] + label:after, input[type="checkbox"] + span:after, .newsletter_show_again:after,
#search_popup .modal-header button:hover,
.dddemo1 .footer .copyright a:hover,.dddemo1 .footer .copyright a:focus,
.dddemo1 .before-footer .news-blocks .title-text .icon,
.header-2 #_desktop_search .icon-wrap:hover,
.ved-woo-cat-tab.style1 .product-action a:hover,
.products .product-name a:hover,
.ved-post-block.style2 .post_info .ved-post-link .read-more:hover,
.ved-woo-cat-tab.style1 .nav-tabs li.active a,
.products .product-hover-style-icon-top-left .product-actions a:hover,
.style3 .ved-post-item .ved-post-content .ved-post-title a:hover{
    color: ' . esc_attr($ved_primary_color) . ';
}

.color-brand {
    color: ' . esc_attr($ved_primary_color) . ';
}

.bg-brand,
.progress-bar,
.main-menu,
.products-cats-menu .cats-menu-title,
.header-1 .main-menu,
.footer .copyright,.owl-carousel .owl-nav>*:hover,
.ved-post-item .ved-post-preview .meta_date,.ved-post-item .ved-post-preview .blogicons a.icon:hover,
#_mobile_cart .icon-box .mini-item-counter,
.widget_shopping_cart .woocommerce-mini-cart__buttons .button:hover,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.product .onsale,
.products.list .product .product-info .product-actions a:hover,
.products.list .product .product-info .product-actions .product-action-add-to-cart a:hover,
.products .product-hover-style-image-bottom-bar .product-actions .product-action-add-to-cart a,
.products .product-hover-style-image-bottom-bar .product-actions a:hover,
.products .product-hover-style-info-bottom .product-actions .product-action-add-to-cart a,
.products .product-hover-style-info-bottom-bar .product-actions .product-action-add-to-cart a,
.products .product-hover-style-info-bottom-bar .product-actions a:hover,
.single-product .product .single_add_to_cart_button:hover, #review_form .submit:hover,
.woocommerce-address-fields .button:hover, .woocommerce-form-coupon .button:hover, .woocommerce .woocommerce-Button:hover,
.widget_product_search .widget-content button:hover, .wpcf7-submit:hover,.order-again a:hover,
.woocommerce div.product .product-slider .slick-arrow:hover,
.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active:before, .woocommerce-account .woocommerce-MyAccount-navigation ul li:hover:before,
body .elementor-button:hover,
.filters > li > a:after,
.ved-modalbox-open-button:hover,
.sec-head-style:before,.wishlist-title:before,
.sec-head-style h3:before, .sec-head-style h3:after, .wishlist-title h2:before, .wishlist-title h2:after,
.scroll-top:hover,
.ved-price-list .featured-highlight .highlight-box,
.wishlist_table .product-name .yith-wcqv-button:hover,
.sidebar .yith-woocompare-widget a.compare,
input[type="radio"] + label:after, input[type="radio"] + span:after,
button[type=submit]:hover,
.vedanta-slider .slides .owl-nav > button,
.dddemo1 .footer .social-icons > li > a:hover,
.style3 .ved-post-link a.btn.btn-base:hover,
.products.list li.product .product-info .product-actions .product-action-add-to-cart a{
    background-color: ' . esc_attr($ved_primary_color) . ';
}

.scroll-top:hover,
.form-control:focus,input[type=text]:focus,
.header-row .extras-menu .icon-wrap-circle .icon-wrap,.owl-carousel .owl-nav>*:hover,
.woocommerce .widget_price_filter .price_slider_amount .button:hover,
.widget.woocommerce .tagcloud a:hover,
.woocommerce .woocommerce-Input:focus,
.quantity .input-text:focus,
.wpcf7-text:focus,
.wpcf7-number:focus,
.wpcf7-date:focus,
.wpcf7-textarea:focus,
.wpcf7-select:focus,
.product-slider .slider-nav .slider-item-nav.slick-current img,
.woocommerce div.product .product-slider .slick-arrow:hover,
.main-slider .ved-image-slider .owl-nav > button,
.flex-direction-nav > li,
.ved-price-list .featured-highlight,
input[type="radio"] + label:before, input[type="radio"] + span:before, input[type="checkbox"] + label:before, input[type="checkbox"] + span:before,
.newsletter_show_again:before,
.vedanta-slider .slides .owl-nav > button,
.ved-woo-cats-slider.style1 .cat-item .cat_btn:hover,
.ved-woo-cats-slider.style2 .cat-item .cat_btn
{
    border-color: ' . esc_attr($ved_primary_color) . ';
}
.pagination>.active>a,
.pagination>.active>span,
.pagination>.active:hover>span,
.woocommerce nav.woocommerce-pagination ul li span:hover,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.woocommerce nav.woocommerce-pagination ul li span.current{
    background: ' . esc_attr($ved_secondry_color) . ';
    border-color: ' . esc_attr($ved_secondry_color) . ';
    color: #fff
}

.pagination>.active>a:focus,
.pagination>.active>a:hover,
.pagination>.active>span:focus,
.pagination>.active>span:hover,
.pagination>li>a:focus,
.pagination>li>a:hover,
.pagination>li>span:focus,
.pagination>li>span:hover,
.pager li>a:focus,
.pager li>a:hover,
.pager li>span:focus,
.pager li>span:hover,
.search_form-keywords-list li a:hover{
    background: ' . esc_attr($ved_primary_color) . ';
    border-color: ' . esc_attr($ved_primary_color) . ';
    color: #fff
}

.color-brand-hvr,
.ved-woo-product-tab .ved-nav-tab li a,
.ved-woo-product-deal-slider.style1 .shop-item-title .woo-product-btn a:hover,
.ved-woo-product-deal-slider.style1 .deal-countdown-timer,
.footer-center .menu-horizontal .widget_nav_menu .menu > li > a:hover{
    color: ' . esc_attr($ved_secondry_color) . ';
}

.bg-brand-hvr,
.main-menu,
.header-1 .products-cats-menu .cats-menu-title,
.header-1 .ved-main-megamenu .ved-header-main-menu .inner-nav > li:hover > a,
.header-4 .ved-main-megamenu .ved-header-main-menu .inner-nav > li:hover > a,
.extras-menu .icon-wrap .icon-box .mini-item-counter,
.extras-menu .icon-wrap-circle:hover .icon-wrap .icon-box,
.flex-direction-nav > li:hover,
.products .open-quick-view:hover,
.products .product-hover-style-image-bottom-bar .open-quick-view:hover,
.products .product-hover-style-info-bottom .open-quick-view:hover,
.products .product-hover-style-info-bottom-bar .open-quick-view:hover,
.products .product-hover-style-default .product-actions-inner,
.products .product-hover-style-image-center .product-actions .product-action a:hover,
.products .product-hover-style-image-left .product-actions .product-action a:hover,
.products .product-hover-style-image-bottom .product-actions .product-action a:hover,
.products.list .product .product-info .product-actions .product-action-add-to-cart a,
.vedanta-slider .slides .owl-nav > button:hover,
.style1 .ved-post-item .ved-post-preview .meta_date,
.dddemo1 .before-footer .mc4wp-form .btn:hover,
.menu-horizontal .mc4wp-form-fields .btn.btn-base,
.mc4wp-form-fields .btn.btn-base,
.style3 .ved-post-link a.btn.btn-base,
.owl-dots .owl-dot.active,
.style2 .ved-testimonial-slider .owl-dots .owl-dot.active
{
    background-color: ' . esc_attr($ved_secondry_color) . ';
}

.flex-direction-nav > li:hover,
.godecore-slider .slides .owl-nav > button:hover,.bor-mdl,.style2 .ved-testimonial-slider .owl-dots .owl-dot.active{
	border-color: ' . esc_attr($ved_secondry_color) . ';
}
';
