<?php
// Define global options.
define( 'GODECORE_IMAGEFOLDER', get_template_directory_uri() . '/themeoptions/options/images/' );
define( 'GODECORE_IMAGEPATH', get_template_directory_uri() . '/themeoptions/options/images/functions/' );
define( 'GODECORE_DEFAULT', get_template_directory_uri() . '/assets/images/default/' );

// -> BEGIN Themeoption Setup
if ( ! class_exists( 'Redux' ) ) {
        $ved_options = get_option( 'ved_options' );
	return;
}

global $ved_options;

$ved_options		 = "ved_options"; // This is your option name where all the Redux data is stored.
$vedanta_theme		 = wp_get_theme(); // For use with some settings. Not necessary.
$vedanta_rss_url	 = get_bloginfo( 'rss_url' );
$vedanta_site_url	 = esc_url( "http://webheaythemes.co.uk" );
$vedanta_fb_url	 = '#';

$args = array(
	'opt_name'		 => $ved_options,
	'display_name'		 => $vedanta_theme->get( 'Name' ),
	'display_name'		 => '<img width="128" height="34" src="' . esc_url(get_template_directory_uri() . '/admin/assets/images/light-logo.png').'" alt="'. esc_attr(get_bloginfo( 'name' )) .'">',
	'page_type'		 => 'submenu',
	'allow_sub_menu'	 => false,
	'menu_title'		 => esc_html__( 'Theme Options', 'godecore' ),
	'page_title'		 => esc_html__( 'Theme Options', 'godecore' ),
	'google_api_key'	 => '',
	'google_update_weekly'	 => false,
	'async_typography'	 => false,
	'admin_bar'		 => true,
	'admin_bar_icon'	 => 'dashicons-portfolio',
	'admin_bar_priority'	 => 50,
	'use_cdn'		 => true,
	'dev_mode'		 => false,
	'forced_dev_mode_off'	 => true,
	'update_notice'		 => false,
	'customizer'		 => false,
	'page_priority'		 => 50,
	'page_parent'		 => 'themes.php',
	'page_permissions'	 => 'manage_options',
	'menu_icon'		 => '',
	'page_icon'		 => 'fa fa-cog',
	'page_slug'		 => 'godecore_options',
	'ajax_save'		 => true,
	'default_show'		 => false,
	'default_mark'		 => '',
	'disable_tracking'	 => true,
	'customizer_only'	 => false,
	'save_defaults'		 => true,
	'footer_credit'		 => esc_html__( 'Thank you for using the GoDecore Theme', 'godecore' ),
	'hints'			 => array(
		'icon'		 => 'fa fa-question-circle',
		'icon_position'	 => 'right',
		'icon_color'	 => '#444',
		'icon_size'	 => 'normal',
		'tip_style'	 => array(
			'color'		 => 'dark',
			'shadow'	 => true,
			'rounded'	 => false,
			'style'		 => '',
		),
		'tip_position'	 => array(
			'my'	 => 'top left',
			'at'	 => 'bottom right',
		),
		'tip_effect'	 => array(
			'show'	 => array(
				'effect'	 => 'slide',
				'duration'	 => '500',
				'event'		 => 'mouseover',
			),
			'hide'	 => array(
				'effect'	 => 'slide',
				'duration'	 => '500',
				'event'		 => 'click mouseleave',
			),
		),
	),
	'intro_text'		 => '<a href="' . esc_url($vedanta_site_url . '/yam5').'" title="Theme Homepage" target="_blank"><i class="fa fa-home"></i> Theme Homepage</a><a href="' . esc_url($vedanta_site_url . '/WP/documentation').'" title="Documentation" target="_blank"><i class="fa fa-book"></i> Documentation</a><a href="' . esc_url($vedanta_site_url . '/support-forums/').'" title="Support" target="_blank"><i class="fa fa-life-bouy"></i> Support</a><a href="' . esc_url($vedanta_fb_url) . '" title="Facebook" target="_blank"><i class="fa fa-facebook"></i> Facebook</a>',
);

// SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.
$args[ 'share_icons' ][] = array(
	'url'	 => '#',
	'title'	 => 'Follow GoDecore Themes on Facebook',
	'icon'	 => 'fa fa-facebook',
);
$args[ 'share_icons' ][] = array(
	'url'	 => '#',
	'title'	 => 'Follow GoDecore Themes on Twitter',
	'icon'	 => 'fa fa-twitter',
);
$args[ 'share_icons' ][] = array(
	'url'	 => '#',
	'title'	 => 'Follow GoDecore Themes on Instagram',
	'icon'	 => 'fa fa-instagram',
);

Redux::setArgs( $ved_options, $args );
// -> END Themeoption Setup

// -> START Basic Fields
Redux::setSection( $ved_options, array(
	'id'	 => 'ved-general-main-tab',
	'title'	 => esc_html__( 'General', 'godecore' ),
	'icon'	 => 'fa fa-dashboard',
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-general-subsec-fav-tab',
	'title'		 => esc_html__( 'Favicon', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Upload custom favicon.', 'godecore' ),
			'id'		 => 'ved_favicon',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Favicon', 'godecore' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Favicon for Apple iPhone (57px x 57px).', 'godecore' ),
			'id'		 => 'ved_iphone_icon',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Apple iPhone Icon Upload', 'godecore' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Favicon for Apple iPhone Retina Version (114px x 114px).', 'godecore' ),
			'id'		 => 'ved_iphone_icon_retina',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Apple iPhone Retina Icon Upload', 'godecore' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Favicon for Apple iPad (72px x 72px).', 'godecore' ),
			'id'		 => 'ved_ipad_icon',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Apple iPad Icon Upload', 'godecore' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Favicon for Apple iPad Retina Version (144px x 144px).', 'godecore' ),
			'id'		 => 'ved_ipad_icon_retina',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Apple iPad Retina Icon Upload', 'godecore' ),
			'url'		 => true,
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-general-subsec-loader-tab',
	'title'		 => esc_html__( 'Site Loader', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display loader in site', 'godecore' ),
			'id'		 => 'ved_siteloader',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Enable Site Loader', 'godecore' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Upload custom loader.', 'godecore' ),
			'id'		 => 'ved_loaderfile',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Loader', 'godecore' ),
			'url'		 => true,
			'required'	 => array( array( "ved_siteloader", '=', 1 ) ),
			'default'	 => array(
				'url' => GODECORE_DEFAULT . 'loader.gif'
			),
		),
	),
)
);


Redux::setSection( $ved_options, array(
	'id'		 => 'ved-general-subsec-lay-tab',
	'title'		 => esc_html__( 'Layout', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
                array(
			'id'		 => 'ved_demo_style',
			'type'		 => 'select',
			'compiler'	 => false,
			'options'	 => array(
				''	 => esc_html__( 'Select Demo', 'godecore' ),
				'veddemo1'	 => esc_html__( 'Demo1', 'godecore' ),
				'veddemo2'	 => esc_html__( 'Demo2', 'godecore' ),
			),
			'title'		 => esc_html__( 'Demo Style', 'godecore' ),
			'default'	 => '',
			'class'	 => 'demo_style_opt',
		),
		array(
			'subtitle'	 => esc_html__( 'Select main content and sidebar alignment.', 'godecore' ),
			'id'		 => 'ved_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'1c'	 => GODECORE_IMAGEPATH . '1c.png',
				'2cl'	 => GODECORE_IMAGEPATH . '2cl.png',
				'2cr'	 => GODECORE_IMAGEPATH . '2cr.png',
				'3cm'	 => GODECORE_IMAGEPATH . '3cm.png',
				'3cr'	 => GODECORE_IMAGEPATH . '3cr.png',
				'3cl'	 => GODECORE_IMAGEPATH . '3cl.png',
			),
			'title'		 => esc_html__( 'Select layout', 'godecore' ),
			'default'	 => '2cr',
		),
		array(
			'subtitle'	 => esc_html__( 'Boxed version automatically enables custom background', 'godecore' ),
			'id'		 => 'ved_width_layout',
			'type'		 => 'select',
			'compiler'	 => true,
			'options'	 => array(
				'fluid'	 => esc_html__( 'Wide', 'godecore' ),
				'fixed'	 => esc_html__( 'Boxed', 'godecore' ),
			),
			'title'		 => esc_html__( 'Layout Style', 'godecore' ),
			'default'	 => 'fluid',
		),

		array(
			'subtitle'	 => esc_html__( 'Body Top & Bottom Spacing. Only apply for Boxed layout', 'godecore' ),
			'id'		 => 'ved_body_top_bottom_spacing',
			'type'		 => 'spacing',
			'units'		 => array( 'px', 'em' ),
			'title'		 => esc_html__( 'Body Top & Bottom Spacing', 'godecore' ),
			'left'		 => false,
			'right'		 => false,
			'default'	 => array(
				'Margin-top'	 => '40px',
				'Marging-bottom' => '40px',
				'units'		 => 'px',
			),
			'required'	 => array( array( "ved_width_layout", '=', 'fixed' ) ),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the width for your website', 'godecore' ),
			'id'		 => 'ved_width_px',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				800	 => '800px',
				985	 => '985px',
				1200	 => '1200px',
				1600	 => '1600px',
				'custom' => esc_html__( 'Custom', 'godecore' ),
			),
			'title'		 => esc_html__( 'Layout Width', 'godecore' ),
			'default'	 => 'custom',
		),
		array(
			'title'		 => esc_html__( 'Custom Layout Width', 'godecore' ),
			'subtitle'	 => esc_html__( 'Add the custom width in px (ex: 1024)', 'godecore' ),
			'id'		 => "ved_custom_width_px",
			'type'		 => "text",
			'required'	 => array( array( "ved_width_px", '=', 'custom' ) ),
			'default'	 => '1340',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the left and right padding for the Fullwidth-Fluid main content area. Enter value in px. ex: 20px', 'godecore' ),
			'id'		 => 'ved_hundredp_padding',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Fullwidth - Fluid Template Left/Right Padding', 'godecore' ),
			'default'	 => '40px',
		),
		array(
			'subtitle'	 => esc_html__( 'Enter the page content top & bottom padding.', 'godecore' ),
			'id'		 => 'ved_content_top_bottom_padding',
			'type'		 => 'spacing',
			'units'		 => array( 'px', 'em' ),
			'title'		 => esc_html__( 'Content Top & Bottom Padding', 'godecore' ),
			'left'		 => false,
			'right'		 => false,
			'default'	 => array(
				'padding-top'	 => '30px',
				'padding-bottom' => '40px',
				'units'		 => 'px',
			),
		),
		array(
			'id'		 => 'ved_info_consid1',
			'type'		 => 'info',
			'subtitle'	 => sprintf( '<h3>%s</h3>', esc_html__( 'Content and One Sidebar Width', 'godecore' ) ),
		),
		array(
			'subtitle'	 => sprintf('<span class="subtitleription">%1$s</span> <img style="float:left, display:inline" src="%2$s2cl.png" /> <img style="float:left, display:inline" src="%3$s2cr.png" />', esc_html__( 'These options apply for the following layouts', 'godecore' ), esc_url(GODECORE_IMAGEPATH), esc_url(GODECORE_IMAGEPATH) ),
			'id'		 => 'ved_info_consid1_widths',
			'style'		 => 'notice',
			'type'		 => 'info',
			'notice'	 => false,
		),
		array(
			'subtitle'	 => esc_html__( 'Select the width for your content', 'godecore' ),
			'id'		 => 'ved_opt1_width_content',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				1	 => '1/12',
				2	 => '2/12',
				3	 => '3/12',
				4	 => '4/12',
				5	 => '5/12',
				6	 => '6/12',
				7	 => '7/12',
				8	 => '8/12',
				9	 => '9/12',
				10	 => '10/12',
				11	 => '11/12',
				12	 => '12/12',
			),
			'title'		 => esc_html__( 'Content Width', 'godecore' ),
			'default'	 => '9',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the width for your Sidebar 1', 'godecore' ),
			'id'		 => 'ved_opt1_width_sidebar1',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				1	 => '1/12',
				2	 => '2/12',
				3	 => '3/12',
				4	 => '4/12',
				5	 => '5/12',
				6	 => '6/12',
				7	 => '7/12',
				8	 => '8/12',
				9	 => '9/12',
				10	 => '10/12',
				11	 => '11/12',
				12	 => '12/12',
			),
			'title'		 => esc_html__( 'Sidebar 1 Width', 'godecore' ),
			'default'	 => '3',
		),
		array(
			'id'		 => 'ved_info_consid2',
			'type'		 => 'info',
			'subtitle'	 => sprintf( '<h3>%s</h3>', esc_html__( 'Content and Two Sidebars Width', 'godecore' ) ),
		),
		array(
			'subtitle'	 => sprintf( '<span class="subtitleription">%1$s</span> <img style="float:left, display:inline" src="%2$s3cm.png" /> <img style="float:left, display:inline" src="%3$s3cr.png" /> <img style="float:left, display:inline" src="%4$s3cl.png" />', esc_html__( 'These options apply for the following layouts', 'godecore' ), esc_url(GODECORE_IMAGEPATH), esc_url(GODECORE_IMAGEPATH), esc_url(GODECORE_IMAGEPATH) ),
			'id'		 => 'ved_info_consid2_widths',
			'style'		 => 'notice',
			'type'		 => 'info',
			'notice'	 => false,
		),
		array(
			'subtitle'	 => esc_html__( 'Select the width for your content', 'godecore' ),
			'id'		 => 'ved_opt2_width_content',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				1	 => '1/12',
				2	 => '2/12',
				3	 => '3/12',
				4	 => '4/12',
				5	 => '5/12',
				6	 => '6/12',
				7	 => '7/12',
				8	 => '8/12',
				9	 => '9/12',
				10	 => '10/12',
				11	 => '11/12',
				12	 => '12/12',
			),
			'title'		 => esc_html__( 'Content Width', 'godecore' ),
			'default'	 => '6',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the width for your Sidebar 1', 'godecore' ),
			'id'		 => 'ved_opt2_width_sidebar1',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				1	 => '1/12',
				2	 => '2/12',
				3	 => '3/12',
				4	 => '4/12',
				5	 => '5/12',
				6	 => '6/12',
				7	 => '7/12',
				8	 => '8/12',
				9	 => '9/12',
				10	 => '10/12',
				11	 => '11/12',
				12	 => '12/12',
			),
			'title'		 => esc_html__( 'Sidebar 1 Width', 'godecore' ),
			'default'	 => '3',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the width for your Sidebar 2', 'godecore' ),
			'id'		 => 'ved_opt2_width_sidebar2',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				1	 => '1/12',
				2	 => '2/12',
				3	 => '3/12',
				4	 => '4/12',
				5	 => '5/12',
				6	 => '6/12',
				7	 => '7/12',
				8	 => '8/12',
				9	 => '9/12',
				10	 => '10/12',
				11	 => '11/12',
				12	 => '12/12',
			),
			'title'		 => esc_html__( 'Sidebar 2 Width', 'godecore' ),
			'default'	 => '3',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-general-subsec-popup-tab',
	'title'		 => esc_html__( 'Newslatter Popup', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display newslatter popup in site', 'godecore' ),
			'id'		 => 'ved_popup',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Enable Newslatter Popup', 'godecore' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Upload background image will display in the newslatter popup.', 'godecore' ),
			'id'		 => 'ved_popup_bg',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Newslatter Popup Background', 'godecore' ),
			'url'		 => true,
			'default'	 => array(
				'url' => GODECORE_DEFAULT . 'newslater-bg.jpg'
			),
		),
            array(
			'subtitle'	 => esc_html__( 'Add heading will display in the newslatter popup.', 'godecore' ),
			'id'		 => 'ved_popup_heading',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Newslatter Popup Heading', 'godecore' ),
			'default'	 => 'Newsletter',
		),
            array(
			'subtitle'	 => esc_html__( 'Add content will display in the newslatter popup.', 'godecore' ),
			'id'		 => 'ved_popup_content',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Newslatter Popup Content', 'godecore' ),
			'default'	 => 'Sign up here to get 20% off on your next purchase, special offers and other discount information.',
		),
            array(
			'subtitle'	 => esc_html__( 'Add form shortcode will display in the newslatter popup.', 'godecore' ),
			'id'		 => 'ved_popup_form',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Newslatter Popup Form Shortcode', 'godecore' ),
		),
            
	),
)
);

// Header Main Sections
Redux::setSection( $ved_options, array(
	'id'	 => 'ved-header-main-tab',
	'title'	 => esc_html__( 'Header', 'godecore' ),
	'icon'	 => 'fa fa-window-maximize icon-large',
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-header-subsec-header-tab',
	'title'		 => esc_html__( 'Header', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Choose your Header Type', 'godecore' ),
			'id'		 => 'ved_header_type',
			'compiler'	 => true,
			'type'		 => 'image_select',
			'options'	 => array(
				'h1'	 => GODECORE_IMAGEFOLDER . '/header/header1.jpg',
				'h2'	 => GODECORE_IMAGEFOLDER . '/header/header2.jpg',
				'h3'	 => GODECORE_IMAGEFOLDER . '/header/header3.jpg',
				'h4'	 => GODECORE_IMAGEFOLDER . '/header/header4.jpg',
				'h5'	 => GODECORE_IMAGEFOLDER . '/header/header5.jpg',
			),
			'title'		 => esc_html__( 'Choose Header Type', 'godecore' ),
			'default'	 => 'h1',
		),		
		array(
			'id'         => 'ved_cat_menu_status',
			'type'       => 'button_set',
			'title'      => esc_html__('Categories Menu', 'godecore' ),
			'options'    => array(
				'enable' => esc_html__('Enable', 'godecore' ),
				'disable' => esc_html__('Disable', 'godecore' ),
			),
			'default'    => 'enable',
			'required'   => array(
				array('ved_header_type', '=', array('h1', 'h2', 'h4') ),
			)
		),
        array(
			'id'		 => 'ved_cat_menu_title',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Categories Menu Title', 'godecore' ),
			'default'	 => 'Shop By Category',
			'required'   => array(
				array('ved_cat_menu_status', '=', array('enable') ),
			)
		),
		array(
			'id'         => 'ved_header_width',
			'type'       => 'button_set',
			'title'      => esc_html__( 'Header Width', 'godecore' ),
			'options'    => array(
				'full_width' => esc_html__( 'Full Width', 'godecore' ),
				'fixed_width'=> esc_html__( 'Fixed Width', 'godecore' ),
			),
			'default'    => 'full_width',
			'required'   => array(
				array( 'ved_width_layout', '=', 'fluid' ),
				array( 'ved_header_type', '=', array( 'h3' ) ),
			),
		),
		array(
			'id'       => 'ved_header_transparent',
			'type'     => 'switch',
			'title'    => esc_html__('Header Transparent', 'godecore' ), 
			'subtitle'     => esc_html__('This will display the header above the page content. This is useful when displaying here or slider section below the header.', 'godecore' ),
			'default'  => '0',
			'on'       => 'Enabled',
			'off'      => 'Disabled',
			'required'   => array(
				array( 'ved_header_type', '=', array( 'h3' )),
			),
		),
		array(
			'id'      => 'ved_woocommerce_icons-start',
			'type'    => 'section',
			'title'   => esc_html__('WooCommerce Icons', 'godecore' ),
			'indent'  => true
		),
		array(
			'id'		 => 'ved_header_icon_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Icon color', 'godecore' ),
			'default'	 => '#ffffff',
		),
		array(
			'id'		 => 'ved_header_icon_color_hover',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Icon hover color', 'godecore' ),
			'default'	 => '#3ab54a',
		),
		array(
			'id'     => 'ved_show_header_cart',
			'type'   => 'switch',
			'title'  => esc_html__('Show Cart Icon', 'godecore' ),
			'on'     => esc_html__('Yes', 'godecore' ),
			'off'    => esc_html__('No', 'godecore' ),
			'default'=> true, 
		),
		array(
			'id'       => 'ved_header_cart_icon',
			'type'     => 'radio',
			'title'    => esc_html__('Cart Icon', 'godecore' ),
			'options'  => array(
				'fa fa-shopping-cart'                             => '<i class="fa fa-shopping-cart fa-2x" aria-hidden="true"></i>',
				'fa fa-shopping-basket'                           => '<i class="fa fa-shopping-basket fa-2x" aria-hidden="true"></i>',
				'fa fa-shopping-bag'                              => '<i class="fa fa-shopping-bag fa-2x" aria-hidden="true"></i>',
				'yamicon-shopping-cart'=> '<i class="yamicon-shopping-cart fa-2x"></i>',
				'yamicon-shopping-cart-1'    => '<i class="yamicon-shopping-cart-1 fa-2x"></i>',
				'yamicon-shopping-cart-2'     => '<i class="yamicon-shopping-cart-2 fa-2x"></i>',
				'yamicon-shopping-cart-3'         => '<i class="yamicon-shopping-cart-3 fa-2x"></i>',
				'yamicon-shopping-cart-4'=> '<i class="yamicon-shopping-cart-4 fa-2x"></i>',
				'yamicon-shopping-cart-5'    => '<i class="yamicon-shopping-cart-5 fa-2x"></i>',
				'yamicon-shopping-cart-6'     => '<i class="yamicon-shopping-cart-6 fa-2x"></i>',
				'yamicon-shopping-basket-button'         => '<i class="yamicon-shopping-basket-button fa-2x"></i>',
				'yamicon-shopping-cart-empty-side-view'=> '<i class="yamicon-shopping-cart-empty-side-view fa-2x"></i>',
				'yamicon-cart'    => '<i class="yamicon-cart fa-2x"></i>',
				'yamicon-cart-1'     => '<i class="yamicon-cart-1 fa-2x"></i>',
				'yamicon-cart-2'         => '<i class="yamicon-cart-2 fa-2x"></i>',
				'yamicon-shopping-bag'=> '<i class="yamicon-shopping-bag fa-2x"></i>',
				'yamicon-shopping-bag-1'    => '<i class="yamicon-shopping-bag-1 fa-2x"></i>',
				'yamicon-shop'     => '<i class="yamicon-shop fa-2x"></i>',
				'yamicon-shopping-purse-icon'         => '<i class="yamicon-shopping-purse-icon fa-2x"></i>',
				'yamicon-shopping-bag-2'     => '<i class="yamicon-shopping-bag-2 fa-2x"></i>',
				'yamicon-shopping-bag-3'         => '<i class="yamicon-shopping-bag-3 fa-2x"></i>',
			),
			'default' => 'fa fa-shopping-cart',
			'class'   => 'cart-icon-large radio-icon-selector-horizontal',
			'required' => array(
				array('ved_show_header_cart', '=', 1),
			),
		),
		array(
			'id'     => 'ved_show_header_compare',
			'type'   => 'switch',
			'title'  => esc_html__('Show Compare Icon', 'godecore' ),
			'on'     => esc_html__('Yes', 'godecore' ),
			'off'    => esc_html__('No', 'godecore' ),
			'default'=> true, 
		),
		array(
			'id'       => 'ved_header_compare_icon',
			'type'     => 'radio',
			'title'    => esc_html__('Compare Icon', 'godecore' ),
			'options'  => array(
				'fa fa-compress'                       => '<i class="fa fa-compress fa-2x" aria-hidden="true"></i>',
				'fa fa-expand'                         => '<i class="fa fa-expand fa-2x" aria-hidden="true"></i>',
				'yamicon-compare'=> '<i class="yamicon-compare fa-2x"></i>',
				'yamicon-shuffle'=> '<i class="yamicon-shuffle fa-2x"></i>',
				'yamicon-shuffle-crossing-arrows' => '<i class="yamicon-shuffle-crossing-arrows fa-2x"></i>',
				'yamicon-shuffle-1'=> '<i class="yamicon-shuffle-1 fa-2x"></i>',
				'yamicon-shuffle-arrows' => '<i class="yamicon-shuffle-arrows fa-2x"></i>',
				'yamicon-shuffle-button'=> '<i class="yamicon-shuffle-button fa-2x"></i>',
			),
			'default' => 'fa fa-compress',
			'class'   => 'compare-icon-large radio-icon-selector-horizontal',
			'required' => array(
				array('ved_show_header_compare', '=', 1),
			),
		),
		array(
			'id'     => 'ved_show_header_wishlist',
			'type'   => 'switch',
			'title'  => esc_html__('Show Wishlist Icon', 'godecore' ),
			'on'     => esc_html__('Yes', 'godecore' ),
			'off'    => esc_html__('No', 'godecore' ),
			'default'=> true, 
		),
		array(
			'id'       => 'ved_header_wishlist_icon',
			'type'     => 'radio',
			'title'    => esc_html__('Wishlist Icon', 'godecore' ),
			'options'  => array(
				'fa fa-heart'                          => '<i class="fa fa-heart fa-2x" aria-hidden="true"></i>',
				'fa fa-heart-o'                        => '<i class="fa fa-heart-o fa-2x" aria-hidden="true"></i>',
				'yamicon-heart'   => '<i class="yamicon-heart fa-2x"></i>',
				'yamicon-like'=> '<i class="yamicon-like fa-2x"></i>',
				'yamicon-heart-1'    => '<i class="yamicon-heart-1 fa-2x"></i>',
				'yamicon-favorite-heart-button'   => '<i class="yamicon-favorite-heart-button fa-2x"></i>',
				'yamicon-valentines-heart'=> '<i class="yamicon-valentines-heart fa-2x"></i>',
				'yamicon-heart-shape-outline'    => '<i class="yamicon-heart-shape-outline fa-2x"></i>',
			),
			'default' => 'fa fa-heart',
			'class'   => 'wishlist-icon-large radio-icon-selector-horizontal',
			'required' => array(
				array('ved_show_header_wishlist', '=', 1),
			),
		),
		array(
			'id'      => 'ved_woocommerce_icons-end',
			'type'   => 'section',
			'indent' => false,
		),

		array(
			'id'      => 'ved_topbar_colors-start',
			'type'    => 'section',
			'title'   => esc_html__('Topbar Colors', 'godecore' ),
			'indent'  => true
		),
		array(
			'id'         => 'ved_topbar_bg_type',
			'type'       => 'button_set',
			'title'      => esc_html__( 'Background Color Type', 'godecore' ),
			'options'    => array(
				'default'    => esc_html__( 'Default', 'godecore' ),
				'custom'     => esc_html__( 'Custom', 'godecore' ),
			),
			'default'    => 'default',
		),
		array(
			'id'		 => 'ved_topbar_bg_color',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'      => esc_html__('Background Color', 'godecore' ),
			'default'	 => '#ffffff',
			'required'   => array(
				array('ved_topbar_bg_type', '=', array('custom') ),
			)
		),
		array(
			'id'		 => 'ved_topbar_text_color',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'      => esc_html__('Text Color', 'godecore' ),
			'default'	 => '#323232',
			'required'   => array(
				array('ved_topbar_bg_type', '=', array('custom') ),
			)
		),
		array(
			'id'      => 'ved_topbar_colors-end',
			'type'   => 'section',
			'indent' => false,
		),

		array(
			'id'      => 'ved_header_colors-start',
			'type'    => 'section',
			'title'   => esc_html__('Header (Main) Colors', 'godecore' ),
			'indent'  => true
		),
		array(
			'id'         => 'ved_header_bg_type',
			'type'       => 'button_set',
			'title'      => esc_html__( 'Background Color Type', 'godecore' ),
			'options'    => array(
				'default'    => esc_html__( 'Default', 'godecore' ),
				'custom'     => esc_html__( 'Custom', 'godecore' ),
			),
			'default'    => 'default',
		),
		array(
			'id'		 => 'ved_header_bg_color',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'		 => esc_html__( 'Header Background Color', 'godecore' ),
			'default'	 => '#ffffff',
			'required'   => array(
				array('ved_header_bg_type', '=', array('custom') ),
			)
		),
		array(
			'id'		 => 'ved_header_text_color',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'		 => esc_html__( 'Header Text Color', 'godecore' ),
			'default'	 => '#323232',
			'required'   => array(
				array('ved_header_bg_type', '=', array('custom') ),
			)
		),
		array(
			'id'      => 'ved_Mobile_header_colors-start',
			'type'    => 'section',
			'title'   => esc_html__('Mobile Header (Main) Colors', 'godecore' ),
			'indent'  => true
		),
		array(
			'id'		 => 'ved_mobile_header_bg_color',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'		 => esc_html__( 'Mobile Header Background Color', 'godecore' ),
			'default'	 => '#ffffff',
		),
		array(
			'id'		 => 'ved_mobile_header_text_color',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'		 => esc_html__( 'Mobile Header Text Color', 'godecore' ),
			'default'	 => '#222222',
		),
		array(
			'id'		 => 'ved_mobile_search_bg_color',
			'compiler'	 => true,
			'type'		 => 'color',
			'title'		 => esc_html__( 'Mobile Search Background Color', 'godecore' ),
			'default'	 => '#ffffff',
		),
		array(
			'id'      => 'ved_header_colors-end',
			'type'   => 'section',
			'indent' => false,
		),
		),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-sticky-header-tab',
	'title'		 => esc_html__( 'Sticky Header', 'godecore' ),
	'subsection'	 => true,
	'fields'          => array(
		array(
			'id'         => esc_html__('ved_sticky_header', 'godecore' ),
			'type'       => 'switch',
			'title'      => esc_html__('Sticky Header', 'godecore' ),
			'subtitle'   => esc_html__('Enable/disable sticky header.', 'godecore' ),
			'default'    => true,
		),
		array(
			'id'         => esc_html__('ved_mobile_sticky_header', 'godecore' ),
			'type'       => 'switch',
			'title'      => esc_html__('Mobile Sticky', 'godecore' ),
			'subtitle'   => esc_html__('Enable/disable mobile sticky header.', 'godecore' ),
			'default'    => true,
			'required'   => array('ved_sticky_header', '=', true),
		),
		array(
			'id'      => 'ved_woocommerce_sticky_icons-start',
			'type'    => 'section',
			'title'   => esc_html__('WooCommerce Icons', 'godecore' ),
			'indent'  => true
		),
		array(
			'id'     => 'ved_show_sticky_header_cart',
			'type'   => 'switch',
			'title'  => esc_html__('Show Cart Icon', 'godecore' ),
			'on'     => esc_html__('Yes', 'godecore' ),
			'off'    => esc_html__('No', 'godecore' ),
			'default'=> true, 
		),
		array(
			'id'     => 'ved_show_sticky_header_compare',
			'type'   => 'switch',
			'title'  => esc_html__('Show Compare Icon', 'godecore' ),
			'on'     => esc_html__('Yes', 'godecore' ),
			'off'    => esc_html__('No', 'godecore' ),
			'default'=> true, 
		),
		array(
			'id'     => 'ved_show_sticky_header_wishlist',
			'type'   => 'switch',
			'title'  => esc_html__('Show Wishlist Icon', 'godecore' ),
			'on'     => esc_html__('Yes', 'godecore' ),
			'off'    => esc_html__('No', 'godecore' ),
			'default'=> true, 
		),
		array(
			'id'      => 'ved_woocommerce_sticky_icons-end',
			'type'   => 'section',
			'indent' => false,
		),
		array(
			'id'   =>'divider_1',
			'type' => 'divide'
		),
		array(
			'id'         => 'ved_sticky_color_section_start',
			'type'       => 'section',
			'title'      => esc_html__( 'Sticky Color Settings', 'godecore' ),
			'indent'     => true,
			'required'   => array('ved_sticky_header', '=', true),
		),
		array(
			'id'         => esc_html__('ved_sticky_header_color', 'godecore' ),
			'type'       => 'color',
			'title'      => esc_html__('Sticky Header Background Color', 'godecore' ),
			'subtitle'   => esc_html__('Set sticky header background color.', 'godecore' ),
			'default'    => '#ffffff',
			'transparent'=> false,
			'required'   => array('ved_sticky_header', '=', true),
		),
		array(
			'id'         => esc_html__('ved_sticky_header_text_color', 'godecore' ),
			'type'       => 'color',
			'title'      => esc_html__('Sticky Header Text Color', 'godecore' ),
			'subtitle'   => esc_html__('Set sticky header text color.', 'godecore' ),
			'default'    => '#969696',
			'transparent'=> false,
			'required'   => array('ved_sticky_header', '=', true),
		),
		array(
			'id'         => 'ved_sticky_header_link_color',
			'type'       => 'color',
			'title'      => esc_html__('Link Color', 'godecore' ),
			'subtitle'   => esc_html__('Set sticky header link color.', 'godecore' ),
			'mode'       => 'background-color',
			'validate'   => 'color',
			'transparent'=> false,
			'default'    => '#04d39f',
			'required'   => array('ved_sticky_header', '=', true),
		),
		array(
			'id'         => 'ved_sticky_color_section_end',
			'type'       => 'section',
			'indent'     => false,
			'required'   => array('ved_sticky_header', '=', true),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-header-subsec-topbar-tab',
	'title'		 => esc_html__( 'Top Bar', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'id'      => 'ved_topbar_enable',
			'type'    => 'switch',
			'title'   => esc_html__('Topbar', 'godecore' ),
			'default' => true,
		),
		array(
			'id'      => 'ved_topbar_mobile_enable',
			'type'    => 'switch',
			'title'   => esc_html__('Topbar Mobile', 'godecore' ),
			'default' => true,
			'required' => array(
				array('ved_topbar_enable', '=', 1),
			),
		),
		array(
			'id'         => 'ved_topbar_layout',
			'type'       => 'sorter',
			'title'      => 'Layout',
			'subtitle'   => 'Select layout contents.',
			'description'=> '<p>'
				. '<strong>' . esc_html__( 'Notes', 'godecore' ) .':</strong>'
				. '<ol>'
				. '<li>'. sprintf( wp_kses( __('<strong>Language</strong>: This content is <a href="%1$s" target="_blank">WPML</a> dependant and it will be available only if <a href="%1$s" target="_blank">WPML</a> is installed.', 'godecore' ),
						array(
							'a' => array(
								'href'   => true,
								'target' => true,
							),
							'strong' => true,
						)
					),
					'https://wpml.org/'
				) . '</li>'
				. '<li>'. sprintf( wp_kses( __('<strong>Currency</strong>: This content is <a href="%1$s" target="_blank">WooCommerce Currency Switcher</a> dependant and it will be available only if <a href="%1$s" target="_blank">WooCommerce Currency Switcher</a> is installed.', 'godecore' ),
						array(
							'a' => array(
								'href'   => true,
								'target' => true,
							),
							'strong' => true
						)
					),
					'https://wordpress.org/plugins/woocommerce-currency-switcher/'
				) . '</li>'
				. '<li>'. wp_kses( __('<strong>Topbar Menu</strong>: You can manage topbar menu from <strong>Appearance > Menus</strong>.', 'godecore' ),
					array(
						'strong' => array()
					)
				) . '</li>'
				. '<li>'. wp_kses( __('<strong>Social Profiles</strong>: You can manage social profiles from <strong>Theme Options > Social Media Links</strong>.', 'godecore' ),
					array(
						'strong' => array()
					)
				) . '</li>'
				. '<li>'. wp_kses( __('<strong>Phone Number/Email</strong>: You can manage phone number and email with <strong>below options</strong>.', 'godecore' ),
					array(
						'strong' => array()
					)
				) . '</li>'
				,
			'options'    => array(
				'Left'                => array(
					'email'           => esc_html__('Email', 'godecore' ),
					'phone_number'    => esc_html__('Phone Number', 'godecore' ),
				),
				'Right'               => array(
					'topbar_menu'     => esc_html__('Topbar Menu', 'godecore' ),
					'social_profiles' => esc_html__('Social Profiles', 'godecore' ),
				),
				'Available Items'     => array(
					'currency'        => esc_html__('Currency', 'godecore' ),
					'language'        => esc_html__('Language', 'godecore' ),
					
				),
			),
			'limits'   => array(
			),
			'required' => array(
				array('ved_topbar_enable', '=', 1),
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Phone number will display in the Contact Info section of your top header.', 'godecore' ),
			'id'		 => 'ved_header_number',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Phone Number', 'godecore' ),
			'default'	 => '+01 7890 123 456',
			'required' => array(
				array('ved_topbar_enable', '=', 1),
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Email address will display in the Contact Info section of your top header.', 'godecore' ),
			'id'		 => 'ved_header_email',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Email Address', 'godecore' ),
			'default'	 => 'contact@example.com',
			'required' => array(
				array('ved_topbar_enable', '=', 1),
			),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-header-subsec-logo-tab',
	'title'		 => esc_html__( 'Logo', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Upload a logo for your theme, or specify an image URL directly.', 'godecore' ),
			'id'		 => 'ved_header_logo',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Logo', 'godecore' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Select an image file for the retina version of the custom logo. It should be exactly 2x the size of main logo.', 'godecore' ),
			'id'		 => 'ved_header_logo_retina',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Logo (Retina Version @2x)', 'godecore' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'If retina logo is uploaded, enter the standard logo (1x) version width, do not enter the retina logo width. In px.', 'godecore' ),
			'id'		 => 'ved_header_logo_retina_width',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Standard Logo Width for Retina Logo', 'godecore' ),
		),
		array(
			'subtitle'	 => esc_html__( 'If retina logo is uploaded, enter the standard logo (1x) version height, do not enter the retina logo height. In px.', 'godecore' ),
			'id'		 => 'ved_header_logo_retina_height',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Standard Logo Height for Retina Logo', 'godecore' ),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-header-subsec-search-content-tab',
	'title'		 => esc_html__( 'Search', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'id'     => 'ved_show_search',
			'type'   => 'switch',
			'title'  => esc_html__('Enable Search', 'godecore' ),
			'on'     => esc_html__('Yes', 'godecore' ),
			'off'    => esc_html__('No', 'godecore' ),
			'default'=> true,
		),
		array(
			'id'         => 'ved_search_background_type',
			'type'       => 'button_set',
			'title'      => esc_html__('Search Box Background', 'godecore' ),
			'options'    => array(
				'search-bg-default' => esc_html__('Default', 'godecore' ),
				'search-bg-transparent' => esc_html__('Transparent', 'godecore' ),
				'search-bg-white' => esc_html__('White', 'godecore' ),
				'search-bg-dark'  => esc_html__('Dark', 'godecore' ),
				'search-bg-theme'  => esc_html__('Theme', 'godecore' ),
			),
			'default' => 'search-bg-default',
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),
		array(
			'id'         => 'ved_search_box_shape',
			'type'       => 'button_set',
			'title'      => esc_html__('Search Box Shape', 'godecore' ),
			'options'    => array(
				'square'    => esc_html__('Square', 'godecore' ),
				'rounded'   => esc_html__('Rounded', 'godecore' ),
			),
			'default' => 'square',
			'required'=> array(
				array( 'ved_show_search', '=', 1 ),
			)
		),
		array(
			'id'       => 'ved_search_icon',
			'type'     => 'radio',
			'title'    => esc_html__('Search Icon', 'godecore' ),
			'options'  => array(
				'fa fa-search'                             => '<i class="fa fa-search fa-2x" aria-hidden="true"></i>',
				'yamicon-magnifying-glass'=> '<i class="yamicon-magnifying-glass fa-2x"></i>',
				'yamicon-search'    => '<i class="yamicon-search fa-2x"></i>',
				'yamicon-search-2'=> '<i class="yamicon-search-2 fa-2x"></i>',
				'yamicon-magnifying-glass-1'    => '<i class="yamicon-magnifying-glass-1 fa-2x"></i>',
				'yamicon-magnifying-glass-2'=> '<i class="yamicon-magnifying-glass-2 fa-2x"></i>',
				'yamicon-search-1'    => '<i class="yamicon-search-1 fa-2x"></i>',
			),
			'default' => 'fa fa-search',
			'class'   => 'cart-icon-large radio-icon-selector-horizontal',
			'required' => array(
				array('ved_show_header_cart', '=', 1),
				array( 'ved_header_type', '!=', array('h1') ),
			),
		),
		array(
			'id'		 => 'ved_search_content_type',
			'type'		 => 'select',
			'options'	 => array(
				'all'	 => esc_html__( 'Search for everything', 'godecore' ),
				'product'	 => esc_html__( 'Search for products', 'godecore' ),
			),
			'title'		 => esc_html__( 'Search Content Type', 'godecore' ),
			'default'	 => 'product',
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),
		array(
			'id'      => 'ved_show_categories',
			'type'    => 'switch',
			'title'   => esc_html__('Show Categories', 'godecore' ),
			'on'      => esc_html__('Yes', 'godecore' ),
			'off'     => esc_html__('No', 'godecore' ),
			'default' => true,
			'required'=> array(
				array('ved_search_content_type', '=', array('product') ),
			)
		),
		array(
			'id'		 => 'ved_custom_categories_text',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Categories Text', 'godecore' ),
			'default'	 => 'All Categories',
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),
		array(
			'id'		 => 'ved_custom_categories_depth',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Categories Depth', 'godecore' ),
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),
		array(
			'subtitle'	 => esc_html__( 'Enter Category IDs to include. Divide every category by comma(,)', 'godecore' ),
			'id'		 => 'ved_custom_categories_include',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Categories Include', 'godecore' ),
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),
		array(
			'subtitle'	 => esc_html__( 'Enter Category IDs to exclude. Divide every category by comma(,)', 'godecore' ),
			'id'		 => 'ved_custom_categories_exclude',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Categories Exclude', 'godecore' ),
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),
		array(
			'id'		 => 'ved_custom_search_text',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Search Text', 'godecore' ),
			'default'	 => 'Search entire store...',
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),
		array(
			'id'		 => 'ved_header_ajax_search',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'AJAX Search', 'godecore' ),
			'default'	 => '1',
			'required'=> array(
				array('ved_show_search', '=', 1),
			)
		),		
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-header-subsec-title-tagline-tab',
	'title'		 => esc_html__( 'Title & Tagline', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you don\'t want to display title of your blog', 'godecore' ),
			'id'		 => 'ved_blog_title',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Enable Blog Title', 'godecore' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you don\'t want to display tagline of your blog', 'godecore' ),
			'id'		 => 'ved_blog_tagline',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Enable Blog Tagline', 'godecore' ),
			'default'	 => '1',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-footer-main-tab',
	'title'	 => esc_html__( 'Footer', 'godecore' ),
	'icon'	 => 'fa fa-columns icon-large',
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-footer-subsec-footer-widgets-tab',
	'title'		 => esc_html__( 'Footer Widgets', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Select how many footer widget areas you want to display.', 'godecore' ),
			'id'		 => 'ved_footer_widget_col',
			'type'		 => 'image_select',
			'options'	 => array(
				'disable'	 => GODECORE_IMAGEPATH . '1c.png',
				'one'		 => GODECORE_IMAGEPATH . 'footer-widgets-1.png',
				'two'		 => GODECORE_IMAGEPATH . 'footer-widgets-2.png',
				'three'		 => GODECORE_IMAGEPATH . 'footer-widgets-3.png',
				'four'		 => GODECORE_IMAGEPATH . 'footer-widgets-4.png',
				'five'		 => GODECORE_IMAGEPATH . 'footer-widgets-5.png',
			),
			'title'		 => esc_html__( 'Number of Widget Cols in Footer', 'godecore' ),
			'default'	 => 'disable',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-footer-subsec-custom-footer-tab',
	'title'		 => esc_html__( 'Custom Footer', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Available HTML tags and attributes:<b> <i> <a href="" > <blockquote> <del >
										<ins > <img /> <ul> <ol> <li>
										<code> <em> <strong> <div> <span> <h1> <h2> <h3> <h4> <h5> <h6>
										<table> <tbody> <tr> <td> <br /> <hr />', 'godecore' ),
			'id'		 => 'ved_footer_content',
			'type'		 => 'textarea',
			'title'		 => esc_html__( 'Custom Footer', 'godecore' ),
			'default'	 => '<a class="_blank" href="#" target="_blank">&#9400 2019 - Ecommerce software by Wordpress</a>',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-styling-subsec-header-footer-tab',
	'title'		 => esc_html__( 'Footer Styles', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Custom background color of footer', 'godecore' ),
			'id'		 => 'ved_footer_bg_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Footer Background color', 'godecore' ),
			'default'	 => '#222222',
		),
		array(
			'subtitle'	 => esc_html__( 'Upload a footer background image for your theme, or specify an image URL directly.', 'godecore' ),
			'id'		 => 'ved_footer_background_image',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Footer Background Image', 'godecore' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Select if the footer background image should be displayed in cover or contain size.', 'godecore' ),
			'id'		 => 'ved_footer_image',
			'type'		 => 'select',
			'options'	 => array(
				'cover'		 => esc_html__( 'Cover', 'godecore' ),
				'contain'	 => esc_html__( 'Contain', 'godecore' ),
				'none'		 => esc_html__( 'None', 'godecore' ),
			),
			'title'		 => esc_html__( 'Background Responsiveness Style', 'godecore' ),
			'default'	 => 'cover',
		),
		array(
			'id'		 => 'ved_footer_image_background_repeat',
			'type'		 => 'select',
			'options'	 => array(
				'no-repeat'	 => esc_html__( 'no-repeat', 'godecore' ),
				'repeat'	 => esc_html__( 'repeat', 'godecore' ),
				'repeat-x'	 => esc_html__( 'repeat-x', 'godecore' ),
				'repeat-y'	 => esc_html__( 'repeat-y', 'godecore' ),
			),
			'title'		 => esc_html__( 'Background Repeat', 'godecore' ),
			'default'	 => 'no-repeat',
		),
		array(
			'id'		 => 'ved_footer_image_background_position',
			'type'		 => 'select',
			'options'	 => array(
				'center top'	 => esc_html__( 'center top', 'godecore' ),
				'center center'	 => esc_html__( 'center center', 'godecore' ),
				'center bottom'	 => esc_html__( 'center bottom', 'godecore' ),
				'left top'	 => esc_html__( 'left top', 'godecore' ),
				'left center'	 => esc_html__( 'left center', 'godecore' ),
				'left bottom'	 => esc_html__( 'left bottom', 'godecore' ),
				'right top'	 => esc_html__( 'right top', 'godecore' ),
				'right center'	 => esc_html__( 'right center', 'godecore' ),
				'right bottom'	 => esc_html__( 'right bottom', 'godecore' ),
			),
			'title'		 => esc_html__( 'Background Position', 'godecore' ),
			'default'	 => 'center top',
		),
		array(
			'subtitle'	 => esc_html__( 'Check to enable parallax background image when scrolling.', 'godecore' ),
			'id'		 => 'ved_footer_parallax',
			'compiler'	 => true,
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Parallax Background Image', 'godecore' ),
			'default'	 => '0',
		),
		array(
			'subtitle'	 => sprintf( '<h3 style=\'margin: 0;\'>%s</h3>', esc_html__( 'Footer Default Pattern', 'godecore' ) ),
			'id'		 => 'ved_header_footer',
			'type'		 => 'info',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose the pattern for footer background', 'godecore' ),
			'id'		 => 'ved_pattern',
			'compiler'	 => true,
			'type'		 => 'image_select',
			'options'	 => array(
				'none'			 => GODECORE_IMAGEPATH . 'none.jpg',
				'pattern_1_thumb.png'	 => GODECORE_IMAGEFOLDER . '/pattern/pattern_1_thumb.png',
				'pattern_2_thumb.png'	 => GODECORE_IMAGEFOLDER . '/pattern/pattern_2_thumb.png',
				'pattern_3_thumb.png'	 => GODECORE_IMAGEFOLDER . '/pattern/pattern_3_thumb.png',
				'pattern_4_thumb.png'	 => GODECORE_IMAGEFOLDER . '/pattern/pattern_4_thumb.png',
				'pattern_5_thumb.png'	 => GODECORE_IMAGEFOLDER . '/pattern/pattern_5_thumb.png',
				'pattern_6_thumb.png'	 => GODECORE_IMAGEFOLDER . '/pattern/pattern_6_thumb.png',
				'pattern_7_thumb.png'	 => GODECORE_IMAGEFOLDER . '/pattern/pattern_7_thumb.png',
				'pattern_8_thumb.png'	 => GODECORE_IMAGEFOLDER . '/pattern/pattern_8_thumb.png',
			),
			'title'		 => esc_html__( 'Footer pattern', 'godecore' ),
			'default'	 => 'none',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-payment-footer-tab',
	'title'		 => esc_html__( 'Footer Payment Icon', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'godecore' ),
			'id'		 => 'ved_footer_payment_icon1',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Footer Payment Icon One', 'godecore' ),
			'url'		 => true,
                        'default'	 => array(
				'url' => GODECORE_DEFAULT . 'visa.png'
			),
		),
                array(
			'subtitle'	 => esc_html__( 'Add a footer payment link for your theme', 'godecore' ),
			'id'		 => 'ved_footer_payment_link1',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Payment Icon One Link', 'godecore' ),
                    'default'	 => '#',
		),
            array(
			'subtitle'	 => esc_html__( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'godecore' ),
			'id'		 => 'ved_footer_payment_icon2',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Footer Payment Icon Two', 'godecore' ),
			'url'		 => true,
                'default'	 => array(
				'url' => GODECORE_DEFAULT . 'mastercard.png'
			),
		),
                array(
			'subtitle'	 => esc_html__( 'Add a footer payment link for your theme', 'godecore' ),
			'id'		 => 'ved_footer_payment_link2',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Payment Icon Two Link', 'godecore' ),
                    'default'	 => '#',
		),
            array(
			'subtitle'	 => esc_html__( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'godecore' ),
			'id'		 => 'ved_footer_payment_icon3',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Footer Payment Icon Three', 'godecore' ),
			'url'		 => true,
                'default'	 => array(
				'url' => GODECORE_DEFAULT . 'paypal.png'
			),
		),
                array(
			'subtitle'	 => esc_html__( 'Add a footer payment link for your theme', 'godecore' ),
			'id'		 => 'ved_footer_payment_link3',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Payment Icon Three Link', 'godecore' ),
                    'default'	 => '#',
		),
            array(
			'subtitle'	 => esc_html__( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'godecore' ),
			'id'		 => 'ved_footer_payment_icon4',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Footer Payment Icon Four', 'godecore' ),
			'url'		 => true,
                'default'	 => array(
				'url' => GODECORE_DEFAULT . 'american_express.png'
			),
		),
                array(
			'subtitle'	 => esc_html__( 'Add a footer payment link for your theme', 'godecore' ),
			'id'		 => 'ved_footer_payment_link4',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Payment Icon Four Link', 'godecore' ),
                    'default'	 => '#',
		),
            array(
			'subtitle'	 => esc_html__( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'godecore' ),
			'id'		 => 'ved_footer_payment_icon5',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Footer Payment Icon Five', 'godecore' ),
			'url'		 => true,
                'default'	 => array(
				'url' => GODECORE_DEFAULT . 'discover.png'
			),
		),
                array(
			'subtitle'	 => esc_html__( 'Add a footer payment link for your theme', 'godecore' ),
			'id'		 => 'ved_footer_payment_link5',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Payment Icon Five Link', 'godecore' ),
                    'default'	 => '#',
		),
            array(
			'subtitle'	 => esc_html__( 'Upload a footer payment icon for your theme, or specify an image URL directly.', 'godecore' ),
			'id'		 => 'ved_footer_payment_icon6',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Footer Payment Icon Six', 'godecore' ),
			'url'		 => true,
                'default'	 => array(
				'url' => GODECORE_DEFAULT . 'diners.png'
			),
		),
                array(
			'subtitle'	 => esc_html__( 'Add a footer payment link for your theme', 'godecore' ),
			'id'		 => 'ved_footer_payment_link6',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Payment Icon Six Link', 'godecore' ),
                    'default'	 => '#',
		),
		
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-pagetitlebar-tab',
	'title'	 => esc_html__( 'Page Title Bar', 'godecore' ),
	'icon'	 => 'fa fa-pencil-square-o icon-large',
	'fields' => array(
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display page titlebar above the content and sidebar area', 'godecore' ),
			'id'		 => 'ved_pagetitlebar_layout',
			'compiler'	 => true,
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Page Title Bar', 'godecore' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose the display option to show the page title', 'godecore' ),
			'id'		 => 'ved_display_pagetitlebar',
			'type'		 => 'select',
			'compiler'	 => true,
			'options'	 => array(
				'titlebar_breadcrumb'	 => esc_html__( 'Title + Breadcrumb', 'godecore' ),
				'titlebar'		 => esc_html__( 'Only Title', 'godecore' ),
				'breadcrumb'		 => esc_html__( 'Only Breadcrumb', 'godecore' ),
			),
			'title'		 => esc_html__( 'Page Title & Breadcrumbs', 'godecore' ),
			'default'	 => 'titlebar_breadcrumb',
			'required'	 => array(
				array( 'ved_pagetitlebar_layout', '=', '1' )
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Choose your page titlebar layout', 'godecore' ),
			'id'		 => 'ved_pagetitlebar_layout_opt',
			'compiler'	 => true,
			'type'		 => 'image_select',
			'title'		 => esc_html__( 'Page Title Bar Layout Type', 'godecore' ),
			'options'	 => array(
				'titlebar_left'		 => GODECORE_IMAGEFOLDER . '/titlebarlayout/titlebar_left.png',
				'titlebar_center'	 => GODECORE_IMAGEFOLDER . '/titlebarlayout/titlebar_center.png',
				'titlebar_right'	 => GODECORE_IMAGEFOLDER . '/titlebarlayout/titlebar_right.png',
			),
                        'default'	 => 'titlebar_left',
			'required'	 => array(
				array( 'ved_pagetitlebar_layout', '=', '1' )
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the height for your pagetitle bar', 'godecore' ),
			'id'		 => 'ved_pagetitlebar_height',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'small'	 => 'Small',
				'medium' => 'Medium',
				'large'	 => 'Large',
				'custom' => esc_html__( 'Custom', 'godecore' ),
			),
			'title'		 => esc_html__( 'Page Title Bar Height', 'godecore' ),
			'default'	 => 'small',
			'required'	 => array(
				array( 'ved_pagetitlebar_layout', '=', '1' )
			),
		),
		array(
			'title'		 => esc_html__( 'Custom Page Title Bar Height', 'godecore' ),
			'subtitle'	 => esc_html__( 'Add the custom height for page title bar. All height in px. Ex: 70', 'godecore' ),
			'id'		 => "ved_pagetitlebar_custom",
			'type'		 => "text",
			'required'	 => array( array( "ved_pagetitlebar_height", '=', 'custom' ) ),
			'default'	 => '',
		),
		array(
			'subtitle'	 => esc_html__( 'Custom background color of page title bar', 'godecore' ),
			'id'		 => 'ved_pagetitlebar_background_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Page Title Bar Background Color', 'godecore' ),
			'required'	 => array(
				array( 'ved_pagetitlebar_layout', '=', '1' )
			),
			'default'	 => '#f8f8f8',
		),
		array(
			'subtitle'	 => esc_html__( 'Select an image or insert an image url to use for the page title bar background.', 'godecore' ),
			'id'		 => 'ved_pagetitlebar_background',
			'type'		 => 'media',
			'title'		 => esc_html__( 'Page Title Bar Background', 'godecore' ),
			'required'	 => array(
				array( 'ved_pagetitlebar_layout', '=', '1' )
			),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Check to enable parallax background image when scrolling.', 'godecore' ),
			'id'		 => 'ved_pagetitlebar_background_parallax',
			'compiler'	 => true,
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Parallax Background Image', 'godecore' ),
			'required'	 => array(
				array( 'ved_pagetitlebar_layout', '=', '1' )
			),
			'default'	 => '0',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-blog-main-tab',
	'title'	 => esc_html__( 'Blog', 'godecore' ),
	'icon'	 => 'fa fa-newspaper-o icon-large',
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-blog-subsec-general-tab',
	'title'		 => esc_html__( 'General', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Select the blog style that will display on the blog pages.', 'godecore' ),
			'id'		 => 'ved_blog_style',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'classic'		 => esc_html__( 'Classic', 'godecore' ),
				'thumbnail_on_side'	 => esc_html__( 'Thumbnail On Side', 'godecore' ),
				'grid'			 => esc_html__( 'Grid', 'godecore' ),
			),
			'title'		 => esc_html__( 'Blog Style', 'godecore' ),
			'default'	 => 'classic',
		),
		array(
			'subtitle'	 => esc_html__( 'Grid layout with 3 and 4 posts per row is recommended to use with disabled Sidebar(s)', 'godecore' ),
			'id'		 => 'ved_post_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'2'	 => GODECORE_IMAGEPATH . 'two-posts.png',
				'3'	 => GODECORE_IMAGEPATH . 'three-posts.png',
				'4'	 => GODECORE_IMAGEPATH . 'four-posts.png',
			),
			'title'		 => esc_html__( 'Blog Grid layout', 'godecore' ),
			'default'	 => '3',
			'required'	 => array(
				array( 'ved_blog_style', '=', 'grid' )
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the sidebar that will display on the archive/category pages.', 'godecore' ),
			'id'		 => 'ved_blog_archive_sidebar',
			'type'		 => 'select',
			'data' => 'sidebars',
			'title'		 => esc_html__( 'Blog Archive/Category Sidebar', 'godecore' ),
			'default'	 => 'Sidebar 1',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose placement of the \'Share This\' buttons', 'godecore' ),
			'id'		 => 'ved_share_this',
			'type'		 => 'select',
			'options'	 => array(
				'single'	 => esc_html__( 'Single Posts', 'godecore' ),
				'page'		 => esc_html__( 'Single Pages', 'godecore' ),
				'all'		 => esc_html__( 'All', 'godecore' ),
				'disable'	 => esc_html__( 'Disable', 'godecore' ),
			),
			'title'		 => esc_html__( '\'Share This\' buttons placement', 'godecore' ),
			'default'	 => 'single',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the pagination type for the assigned blog page in Settings > Reading.', 'godecore' ),
			'id'		 => 'ved_pagination_type',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'pagination'		 => esc_html__( 'Default Pagination', 'godecore' ),
				'number_pagination'	 => esc_html__( 'Number Pagination', 'godecore' ),
			),
			'title'		 => esc_html__( 'Pagination Type', 'godecore' ),
			'default'	 => 'number_pagination',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display edit post link', 'godecore' ),
			'id'		 => 'ved_edit_post',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Enable Edit Post Link', 'godecore' ),
			'default'	 => '0',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-blog-subsec-post-tab',
	'title'		 => esc_html__( 'Posts', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display post meta header', 'godecore' ),
			'id'		 => 'ved_header_meta',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Post Meta Header', 'godecore' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display post meta date', 'godecore' ),
			'id'		 => 'ved_meta_date',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Post Meta Date', 'godecore' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display post meta author', 'godecore' ),
			'id'		 => 'ved_meta_author',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Post Meta Author', 'godecore' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display post author avatar', 'godecore' ),
			'id'		 => 'ved_author_avatar',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Enable Post Author Avatar', 'godecore' ),
                        'default'	 => 0,
		),
                array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display post meta categories', 'godecore' ),
			'id'		 => 'ved_meta_cats',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Post Meta Categories', 'godecore' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display post meta tags', 'godecore' ),
			'id'		 => 'ved_meta_tags',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Post Meta Tags', 'godecore' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display post meta comments', 'godecore' ),
			'id'		 => 'ved_meta_comments',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Post Meta Comments', 'godecore' ),
                        'default'	 => 0,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose the position of the Previous/Next Post links', 'godecore' ),
			'id'		 => 'ved_post_links',
			'type'		 => 'select',
			'options'	 => array(
				'after'	 => esc_html__( 'After posts', 'godecore' ),
				'before' => esc_html__( 'Before posts', 'godecore' ),
				'both'	 => esc_html__( 'Both', 'godecore' ),
			),
			'title'		 => esc_html__( 'Position of Previous/Next Posts Links', 'godecore' ),
			'default'	 => 'after',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose if you want to display Similar posts in articles', 'godecore' ),
			'id'		 => 'ved_similar_posts',
			'type'		 => 'select',
			'options'	 => array(
				'disable'	 => esc_html__( 'Disable', 'godecore' ),
				'category'	 => esc_html__( 'Match by categories', 'godecore' ),
				'tag'		 => esc_html__( 'Match by tags', 'godecore' ),
			),
			'title'		 => esc_html__( 'Display Similar Posts', 'godecore' ),
			'default'	 => 'category',
		),
                array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display Similar posts in slider', 'godecore' ),
			'id'		 => 'ved_similar_posts_carousel',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Display Similar Posts Carousel', 'godecore' ),
                        'default'	 => 1,
		),
                array(
			'subtitle'	 => esc_html__( 'Choose number of similar posts', 'godecore' ),
			'id'		 => 'ved_similar_posts_number',
			'type'		 => 'select',
			'options'	 => array(
				'3'	 => esc_html__( 'Three', 'godecore' ),
				'4'	 => esc_html__( 'Four', 'godecore' ),
				'5'	 => esc_html__( 'Five', 'godecore' ),
				'6'	 => esc_html__( 'Six', 'godecore' ),
				'7'	 => esc_html__( 'Seven', 'godecore' ),
				'8'	 => esc_html__( 'Eight', 'godecore' ),
			),
			'title'		 => esc_html__( 'No of Similar Posts', 'godecore' ),
			'default'	 => '4',
		),
            
	),
)
);
Redux::setSection( $ved_options, array(
	'id'		 => 'ved-blog-subsec-featured-tab',
	'title'		 => esc_html__( 'Featured Image', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display featured images on blog page', 'godecore' ),
			'id'		 => 'ved_featured_images',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Enable Featured Images', 'godecore' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display featured image on Single Blog Posts', 'godecore' ),
			'id'		 => 'ved_blog_featured_image',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Enable Featured Image on Single Blog Posts', 'godecore' ),
                        'default'	 => 1,
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-portfolio-main-tab',
	'title'	 => esc_html__( 'Portfolio', 'godecore' ),
	'icon'	 => 'fa fa-th icon-large',
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-portfolio-subsec-general-tab',
	'title'		 => esc_html__( 'General', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Insert the number of posts to display per page.', 'godecore' ),
			'id'		 => 'ved_portfolio_no_item_per_page',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Number of Portfolio Items Per Page', 'godecore' ),
			'default'	 => '10',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the portfolio style that will display on the portfolio pages.', 'godecore' ),
			'id'		 => 'ved_portfolio_style',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'grid'		 => esc_html__( 'Grid', 'godecore' ),
				'grid_no_space'	 => esc_html__( 'Grid No Space', 'godecore' ),
			),
			'title'		 => esc_html__( 'Portfolio Style', 'godecore' ),
			'default'	 => 'grid',
		),
		array(
			'subtitle'	 => esc_html__( 'Grid layout with 3 and 4 portfolio per row is recommended to use with disabled Sidebar(s)', 'godecore' ),
			'id'		 => 'ved_portfolio_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'2'	 => GODECORE_IMAGEPATH . 'two-posts.png',
				'3'	 => GODECORE_IMAGEPATH . 'three-posts.png',
				'4'	 => GODECORE_IMAGEPATH . 'four-posts.png',
			),
			'title'		 => esc_html__( 'Portfolio Grid Layout', 'godecore' ),
			'default'	 => '3',
		),
		array(
			'subtitle'	 => esc_html__( 'Custom hover color of portfolio works', 'godecore' ),
			'id'		 => 'ved_portfolio_hover_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Portfolio Hover Color', 'godecore' ),
			'default'	 => '#3ab54a',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the sidebar that will be added to the archive/category portfolio pages.', 'godecore' ),
			'id'		 => 'ved_portfolio_sidebar',
			'type'		 => 'select',
			'data' => 'sidebars',
			'title'		 => esc_html__( 'Portfolio Archive/Category Sidebar', 'godecore' ),
			'default'	 => 'Sidebar 1',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-portfolio-subsec-single-post-page-tab',
	'title'		 => esc_html__( 'Single Portfolio Page', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display featured images on single post pages.', 'godecore' ),
			'id'		 => 'ved_portfolio_featured_image',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Featured Image on Single Portfolio', 'godecore' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to enable Author on portfolio items.', 'godecore' ),
			'id'		 => 'ved_portfolio_author',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Show Author', 'godecore' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display the social sharing box.', 'godecore' ),
			'id'		 => 'ved_portfolio_sharing',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Social Sharing Box', 'godecore' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to display related portfolio.', 'godecore' ),
			'id'		 => 'ved_portfolio_related_posts',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Related Portfolio', 'godecore' ),
			'default'	 => '1',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to disable previous/next pagination.', 'godecore' ),
			'id'		 => 'ved_portfolio_pagination',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Previous/Next Pagination', 'godecore' ),
			'default'	 => '1',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-woocommerce-main-tab',
	'title'	 => esc_html__( 'WooCommerce', 'godecore' ),
	'icon'	 => 'fa  fa-shopping-cart icon-large',
	)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-woocommerce-General-tab',
	'title'	 => esc_html__( 'General', 'godecore' ),
	'subsection'	 => true,
	'fields' => array(
		array(
			'subtitle'	 => esc_html__( 'Insert the number of products to display per page.', 'godecore' ),
			'id'		 => 'ved_woo_items',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Number of Products Per Page', 'godecore' ),
			'default'	 => '12',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to disable the ordering boxes displayed on the shop page.', 'godecore' ),
			'id'		 => 'ved_woocommerce_ordering',
			'type'		 => 'switch',
			'title'		 => esc_html__( 'Disable Woocommerce Shop Page Ordering Boxes', 'godecore' ),
		),
		array(
			'subtitle'	 => esc_html__( 'Grid layout with 3 and 4 products per row is recommended to use with disabled Sidebar(s)', 'godecore' ),
			'id'		 => 'ved_woocommerce_layout',
			'type'		 => 'image_select',
			'compiler'	 => true,
			'options'	 => array(
				'2'	 => GODECORE_IMAGEPATH . 'two-posts.png',
				'3'	 => GODECORE_IMAGEPATH . 'three-posts.png',
				'4'	 => GODECORE_IMAGEPATH . 'four-posts.png',
			),
			'title'		 => esc_html__( 'Product Grid layout', 'godecore' ),
			'default'	 => '4',
		),
		array(
			'subtitle'	 => esc_html__( 'Select the sidebar that will display on the shop archive/category pages.', 'godecore' ),
			'id'		 => 'ved_shop_archive_sidebar',
			'type'		 => 'select',
			'data' => 'sidebars',
			'title'		 => esc_html__( 'Shop Archive/Category Sidebar', 'godecore' ),
			'default'	 => 'Siderbar 1',
		),         
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-woocommerce-prolisting-tab',
	'title'	 => esc_html__( 'Products Listing', 'godecore' ),
	'subsection'	 => true,
	'fields' => array(
		array(
			'id' => 'ved_product_hover_style',
			'type' => 'ved_select_image',
			'title' => esc_html__('Product Hover Style', 'godecore' ),
			'placeholder' => esc_html__('Select product hover style.', 'godecore' ),
			'select2' => array(
				'allowClear' => 0,
			),
			'options' => Array(
				'default' => array(
					'alt' => esc_html__('Default', 'godecore' ),
					'title' => esc_html__('Default', 'godecore' ),
					'img' => esc_url(GODECORE_IMAGEFOLDER.'/product_hover_style/default.jpg'),
				),
				'icon-top-right' => array(
					'alt' => esc_html__('Icon Top Right', 'godecore' ),
					'title' => esc_html__('Icon Top Right', 'godecore' ),
					'img' => esc_url(GODECORE_IMAGEFOLDER.'/product_hover_style/icon-top-left.jpg'),
				),				
				'image-center' => array(
					'alt' => esc_html__('Image Center', 'godecore' ),
					'title' => esc_html__('Image Center', 'godecore' ),
					'img' => esc_url(GODECORE_IMAGEFOLDER.'/product_hover_style/image-center.jpg'),
			),
				'image-left' => array(
					'alt' => esc_html__('Image Left', 'godecore' ),
					'title' => esc_html__('Image Left', 'godecore' ),
					'img' => esc_url(GODECORE_IMAGEFOLDER.'/product_hover_style/image-left.jpg'),
				),
				'image-bottom' => array(
					'alt' => esc_html__('Image Bottom', 'godecore' ),
					'title' => esc_html__('Image Bottom', 'godecore' ),
					'img' => esc_url(GODECORE_IMAGEFOLDER.'/product_hover_style/image-bottom.jpg'),
				),
				'image-bottom-2' => array(
					'alt' => esc_html__('Image Bottom 2', 'godecore' ),
					'title' => esc_html__('Image Bottom 2', 'godecore' ),
					'img' => esc_url(GODECORE_IMAGEFOLDER.'/product_hover_style/image-bottom-2.jpg'),
				),
				'image-bottom-bar' => array(
					'alt' => esc_html__('Image Bottom Bar', 'godecore' ),
					'title' => esc_html__('Image Bottom Bar', 'godecore' ),
					'img' => esc_url(GODECORE_IMAGEFOLDER.'/product_hover_style/image-bottom-bar.jpg'),
				),
				'info-bottom' => array(
					'alt' => esc_html__('Info Bottom', 'godecore' ),
					'title' => esc_html__('Info Bottom', 'godecore' ),
					'img' => esc_url(GODECORE_IMAGEFOLDER.'/product_hover_style/info-bottom.jpg'),
				),
				'info-bottom-bar' => array(
					'alt' => esc_html__('Info Bottom Bar', 'godecore' ),
					'title' => esc_html__('Info Bottom Bar', 'godecore' ),
					'img' => esc_url(GODECORE_IMAGEFOLDER.'/product_hover_style/info-bottom-bar.jpg'),
				),
			),
			'default' => 'image-center',
		), 
		array(
			'id' => 'ved_product_image_swap',
			'type' => 'switch',
			'title' => esc_html__('Swape Image On Hover', 'godecore' ),
			'subtitle' => esc_html__('Product image change on hover.', 'godecore' ),
			'on' => esc_html__('Yes', 'godecore' ),
			'off' => esc_html__('No', 'godecore' ),
			'default' => true,
		),
		array(
			'id' => 'ved_product_title_length',
			'type' => 'button_set',
			'title' => esc_html__('Product Title Length', 'godecore' ),
			'options' => array(
				'full' => esc_html__('Full', 'godecore' ),
				'single_line' => esc_html__('Single Line', 'godecore' ),
			),
			'default' => 'single_line',
		),
		array(
			'id'         => 'ved_product_border_type',
			'type'       => 'button_set',
			'title'      => esc_html__( 'Product Border', 'godecore' ),
			'options'    => array(
				'default'   		=> esc_html__('Default', 'godecore' ),
				'border_image'			=> esc_html__('Border Image', 'godecore' ),
				'full_border_image'   => esc_html__('Full Border Image', 'godecore' ),
			),
			'default'    => 'default',
		),
		// array(
		// 	'id' => 'ved_product_hover_button_shape',
		// 	'type' => 'button_set',
		// 	'title' => esc_html__('Button Shape', 'godecore' ),
		// 	'options' => array(
		// 		'square' => esc_html__('Square', 'godecore' ),
		// 		'round' => esc_html__('Round', 'godecore' ),
		// 	),
		// 	'default' => 'square',
		// 	'required' => array('ved_product_hover_style', '=', array('image-center', 'image-left', 'image-bottom', 'image-bottom-2', 'info-bottom')),
		// ),
		// array(
		// 	'id' => 'ved_product_hover_button_style',
		// 	'type' => 'button_set',
		// 	'title' => esc_html__('Button Style', 'godecore' ),
		// 	'options' => array(
		// 		'flat' => esc_html__('Flat', 'godecore' ),
		// 		'border' => esc_html__('Border', 'godecore' ),
		// 	),
		// 	'default' => 'flat',
		// 	'required' => array('ved_product_hover_style', '=', array('image-center', 'image-left', 'image-bottom')),
		// ),
		// array(
		// 	'id' => 'ved_product_hover_bar_style',
		// 	'type' => 'button_set',
		// 	'title' => esc_html__('Bar Style', 'godecore' ),
		// 	'options' => array(
		// 		'flat' => esc_html__('Flat', 'godecore' ),
		// 		'border' => esc_html__('Border', 'godecore' ),
		// 	),
		// 	'default' => 'flat',
		// 	'required' => array('ved_product_hover_style', '=', array('image-bottom-bar', 'info-bottom-bar')),
		// ),
		// array(
		// 	'id' => 'ved_product_hover_add_to_cart_position',
		// 	'type' => 'button_set',
		// 	'title' => esc_html__('"Add to Cart" Position', 'godecore' ),
		// 	'options' => array(
		// 		'center' => esc_html__('Center', 'godecore' ),
		// 		'left' => esc_html__('Left', 'godecore' ),
		// 	),
		// 	'default' => 'center',
		// 	'required' => array('ved_product_hover_style', '=', array('image-bottom-bar', 'info-bottom', 'info-bottom-bar')),
		// ),
		// array(
		// 	'id' => 'ved_product_hover_default_button_style',
		// 	'type' => 'button_set',
		// 	'title' => esc_html__('Button Style', 'godecore' ),
		// 	'options' => array(
		// 		'dark' => esc_html__('Dark', 'godecore' ),
		// 		'light' => esc_html__('Light', 'godecore' ),
		// 	),
		// 	'default' => 'dark',
		// 	'required' => array('ved_product_hover_style', '=', array('default', 'icon-top-left')),
		// ),
		// array(
		// 	'id' => 'ved_product_hover_icon_type',
		// 	'type' => 'button_set',
		// 	'title' => esc_html__('Product Icons Type', 'godecore' ),
		// 	'subtitle' => esc_html__('Overall Product Hover Icon Type.', 'godecore' ),
		// 	'options' => array(
		// 		'fill-icon' => esc_html__('Flat Icons', 'godecore' ),
		// 		'line-icon' => esc_html__('Line Icons', 'godecore' ),
		// 	),
		// 	'default' => 'fill-icon',
		// ),
		array(
			'id'         => 'ved_product_pagination',
			'type'       => 'button_set',
			'title'      => esc_html__('Product Pagination', 'godecore' ),
			'options'    => array(
				'pagination'   		=> esc_html__('Pagination', 'godecore' ),
				'load_more'			=> esc_html__('Load More', 'godecore' ),
				'infinite_scroll'   => esc_html__('Infinite Scroll', 'godecore' ),
			),
			'default' => 'pagination',
		),	
		// array(
  //               'id' => 'ved_product_hover_icon_type',
  //               'type' => 'button_set',
  //               'title' => esc_html__('Product Icons Type', 'godecore' ),
  //               'subtitle' => esc_html__('Overall Product Hover Icon Type.', 'godecore' ),
  //               'options' => array(
  //                   'fill-icon' => esc_html__('Flat Icons', 'godecore' ),
  //                   'line-icon' => esc_html__('Line Icons', 'godecore' ),
  //               ),
  //               'default' => 'fill-icon',
  //           ),
		array(
                'id' => 'ved_product-out-of-stock-icon',
                'type' => 'switch',
                'title' => esc_html__('Display "Out of stock" Label', 'godecore' ),
                'default' => true,
                'on' => esc_html__('Yes', 'godecore' ),
                'off' => esc_html__('No', 'godecore' ),
            ),
		array(
                'id' => 'ved_woocommerce_catalog_mode',
                'type' => 'switch',
                'title' => esc_html__('Just Catalog', 'godecore' ),
                'subtitle' => esc_html__('Disable "Add To Cart" button and shopping cart', 'godecore' ),
                'default' => false,
            ),
		array(
			'id' => 'ved_woocommerce_price_hide',
			'type' => 'switch',
			'title' => esc_html__('Hide Price', 'godecore' ),
			'subtitle' => esc_html__('Hide product price on Product pages', 'godecore' ),
			'default' => false,
			'required' => array('ved_woocommerce_catalog_mode', '=', true)
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'              => 'ved_woocommerce_cookie_law_info',
	'title'           => esc_html__('Cookie Law Info', 'godecore' ),
	'subsection'	 => true,
	'fields' => array(
			array (
				'id'      => 'ved_cookies_info',
				'type'    => 'switch',
				'title'   => esc_html__('Show Cookies Info', 'godecore' ),
				'subtitle'=> esc_html__('Under EU privacy regulations, websites must make it clear to visitors what information about them is being stored. This specifically includes cookies. Turn on this option and user will see info box at the bottom of the page that your web-site is using cookies.', 'godecore' ),
				'default' => true
			),
			array (
				'id'      => 'ved_cookies_text',
				'type'    => 'editor',
				'title'   => esc_html__('Popup Text', 'godecore' ),
				'subtitle'=> esc_html__('Place here some information about cookies usage that will be shown in the popup.', 'godecore' ),
				'default' => esc_html__('We use cookies to improve your experience on our website. By browsing this website, you agree to our use of cookies.', 'godecore' ),
				'required' => array( 'ved_cookies_info', '=', 1 ),
			),
			array (
				'id'      => 'ved_cookies_policy_page',
				'type'    => 'select',
				'title'   => esc_html__('Page with Details', 'godecore' ),
				'subtitle'=> esc_html__('Choose page that will contain detailed information about your Privacy Policy', 'godecore' ),
				'data'    => 'pages',
				'required' => array( 'ved_cookies_info', '=', 1 ),
			),
		),
	)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-typography-main-tab',
	'title'	 => esc_html__( 'Typography', 'godecore' ),
	'icon'	 => 'fa fa-font icon-large',
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-typography-custom',
	'title'		 => esc_html__( 'Custom Fonts', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'raw'	 => sprintf( '<h3 style=\'margin: 0;\'>%s</h3><p style="margin-bottom:0;">%s</h3>', esc_html__( 'Custom fonts for all elements.', 'godecore' ), esc_html__( 'This will override the Google / standard font options. All 4 files are required.', 'godecore' ) ),
			'id'	 => 'ved_custom_fonts',
			'type'	 => 'info',
		),
		array(
			'subtitle'	 => esc_html__( 'Upload the .woff font file.', 'godecore' ),
			'id'		 => 'ved_custom_font_woff',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Font .woff', 'godecore' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Upload the .ttf font file.', 'godecore' ),
			'id'		 => 'ved_custom_font_ttf',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Font .ttf', 'godecore' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Upload the .svg font file.', 'godecore' ),
			'id'		 => 'ved_custom_font_svg',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Font .svg', 'godecore' ),
			'url'		 => true,
		),
		array(
			'subtitle'	 => esc_html__( 'Upload the .eot font file.', 'godecore' ),
			'id'		 => 'ved_custom_font_eot',
			'mode'		 => 0,
			'type'		 => 'media',
			'title'		 => esc_html__( 'Custom Font .eot', 'godecore' ),
			'url'		 => true,
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-typography-subsec-title-tagline-tab',
	'title'		 => esc_html__( 'Title & Tagline', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your Overall Site. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_body_font',
			'type'		 => 'typography',
			'title'		 => esc_html__( 'Body Font', 'godecore' ),
			'text-align'	 => false,
			'line-height'	 => false,
			'default'	 => array(
				'font-size'	 => '16px',
				'color'		 => '#222222',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '400',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your blog title. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_title_font',
			'type'		 => 'typography',
			'title'		 => esc_html__( 'Blog Title Font', 'godecore' ),
			'text-align'	 => false,
			'line-height'	 => false,
			'default'	 => array(
				'font-size'	 => '20px',
				'color'		 => '#222222',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your blog tagline. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_tagline_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Blog Tagline Font', 'godecore' ),
			'default'	 => array(
				'font-size'	 => '14px',
				'font-family'	 => 'Poppins',
				'color'		 => '#777777',
				'font-weight'	 => '400',
			),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-typography-subsec-menu-tab',
	'title'		 => esc_html__( 'Menu', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your main menu. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_menu_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Main Menu Font', 'godecore' ),
			'default'	 => array(
				'font-size'	 => '16px',
				'color'		 => '#999999',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '300',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your top menu. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_top_menu_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Top Menu Font', 'godecore' ),
			'default'	 => array(
				'font-size'	 => '16px',
				'color'		 => '#777777',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '400',
			),
		),
	),
)
);


Redux::setSection( $ved_options, array(
	'id'		 => 'ved-typography-subsec-post-tab',
	'title'		 => esc_html__( 'Post Title & Content', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your post titles. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_post_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Post Title Font', 'godecore' ),
			'default'	 => array(
				'font-size'	 => '20px',
				'color'		 => '#222222',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your blog content. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_content_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Content Font', 'godecore' ),
			'default'	 => array(
				'font-size'	 => '14px',
				'color'		 => '#777777',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '400',
			),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-typography-subsec-widget-tab',
	'title'		 => esc_html__( 'Widget', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your widget title. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_widget_title_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Widget Title Font', 'godecore' ),
			'default'	 => array(
				'font-size'	 => '16px',
				'color'		 => '#222222',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your widget content. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_widget_content_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Widget Content Font', 'godecore' ),
			'default'	 => array(
				'font-size'	 => '14px',
				'font-family'	 => 'Poppins',
				'color'		 => '#777777',
				'font-weight'	 => '400',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your widget title. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_footer_widget_title_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Footer Widget Title Font', 'godecore' ),
			'default'	 => array(
				'font-size'	 => '18px',
				'color'		 => '#222222',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your widget content. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_footer_widget_content_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'Footer Widget Content Font', 'godecore' ),
			'default'	 => array(
				'font-size'	 => '14px',
				'font-family'	 => 'Poppins',
				'color'		 => '#ffffff',
				'font-weight'	 => '400',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your widget content. * non web-safe font hover.', 'godecore' ),
			'id'		 => 'ved_footer_widget_content_font_hover',
			'type'		 => 'color',
			'title'		 => esc_html__( 'Footer Widget Content Font Hover', 'godecore' ),
			'default'	 => '#ffffff'
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-typography-subsec-headings-tab',
	'title'		 => esc_html__( 'Headings', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your H1 tag in blog content. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_content_h1_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'H1 Font', 'godecore' ),
			'default'	 => array(
				'font-size'	 => '32px',
				'color'		 => '#222222',
				'font-family'	 => 'Poppins',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your H2 tag in blog content. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_content_h2_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'H2 Font', 'godecore' ),
			'default'	 => array(
				'font-size'	 => '26px',
				'font-family'	 => 'Poppins',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your H3 tag in blog content. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_content_h3_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'H3 Font', 'godecore' ),
			'default'	 => array(
				'font-size'	 => '20px',
				'font-family'	 => 'Poppins',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your H4 tag in blog content. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_content_h4_font',
			'type'		 => 'typography',
			'title'		 => esc_html__( 'H4 Font', 'godecore' ),
			'text-align'	 => false,
			'line-height'	 => false,
			'default'	 => array(
				'font-size'	 => '16px',
				'font-family'	 => 'Poppins',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your H5 tag in blog content. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_content_h5_font',
			'type'		 => 'typography',
			'title'		 => esc_html__( 'H5 Font', 'godecore' ),
			'text-align'	 => false,
			'line-height'	 => false,
			'default'	 => array(
				'font-size'	 => '14px',
				'font-family'	 => 'Poppins',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
		array(
			'subtitle'	 => esc_html__( 'Select the typography you want for your H6 tag in blog content. * non web-safe font.', 'godecore' ),
			'id'		 => 'ved_content_h6_font',
			'type'		 => 'typography',
			'text-align'	 => false,
			'line-height'	 => false,
			'title'		 => esc_html__( 'H6 Font', 'godecore' ),
			'default'	 => array(
				'font-size'	 => '12px',
				'font-family'	 => 'Poppins',
				'color'		 => '#222222',
				'font-weight'	 => '600',
			),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-styling-main-tab',
	'title'	 => esc_html__( 'Styling', 'godecore' ),
	'icon'	 => 'fa fa-paint-brush icon-large',
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-styling-subsec-main-scheme-tab',
	'title'		 => esc_html__( 'Main Color Scheme', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Primary color of site', 'godecore' ),
			'id'		 => 'ved_primary_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Primary Color', 'godecore' ),
			'default'	 => '#3ab54a',
		),
		array(
			'subtitle'	 => esc_html__( 'Secondry color of site', 'godecore' ),
			'id'		 => 'ved_secondry_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Secondry Color', 'godecore' ),
			'default'	 => '#0c3e3e',
		),	
		array(
			'subtitle'	 => esc_html__( 'Tertiary color of site', 'godecore' ),
			'id'		 => 'ved_tertiary_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Tertiary Color', 'godecore' ),
			'default'	 => '#969696',
		),	
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-styling-subsec-menu-tab',
	'title'		 => esc_html__( 'Menu', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Set the font size for mega menu column titles. In pixels, ex: 15px', 'godecore' ),
			'id'		 => 'ved_megamenu_title_size',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Mega Menu Column Title Size', 'godecore' ),
			'default'	 => '15px',
		),
		array(
			'subtitle'	 => esc_html__( 'Main menu text transform', 'godecore' ),
			'id'		 => 'ved_menu_text_transform',
			'compiler'	 => true,
			'type'		 => 'select',
			'options'	 => array(
				'none'		 => esc_html__( 'none', 'godecore' ),
				'lowercase'	 => esc_html__( 'lowercase', 'godecore' ),
				'capitalize'	 => esc_html__( 'Capitalize', 'godecore' ),
				'uppercase'	 => esc_html__( 'UPPERCASE', 'godecore' ),
			),
			'title'		 => esc_html__( 'Set the main menu text transform', 'godecore' ),
			'default'	 => 'none',
		),
		array(
			'subtitle'	 => esc_html__( 'Main menu hover font color', 'godecore' ),
			'id'		 => 'ved_main_menu_hover_font_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Menu Hover Font Color', 'godecore' ),
			'default'	 => '#ffffff',
		),
		array(
			'subtitle'	 => esc_html__( 'Sub menu hover font color', 'godecore' ),
			'id'		 => 'ved_sub_menu_hover_font_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Submenu Hover Font Color', 'godecore' ),
			'default'	 => '#3ab54a',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'		 => 'ved-element-colors',
	'title'		 => esc_html__( 'Element Colors', 'godecore' ),
	'subsection'	 => true,
	'fields'	 => array(
		array(
			'subtitle'	 => esc_html__( 'Controls the background color of form fields.', 'godecore' ),
			'id'		 => 'ved_form_bg_color',
			'type'		 => 'color',
			'title'		 => esc_html__( 'Form Background Color', 'godecore' ),
			'default'	 => '#ffffff',
		),
		array(
			'subtitle'	 => esc_html__( 'Controls the text color for forms.', 'godecore' ),
			'id'		 => 'ved_form_text_color',
			'type'		 => 'color',
			'title'		 => esc_html__( 'Form Text Color', 'godecore' ),
			'default'	 => '#222222',
		),
		array(
			'subtitle'	 => esc_html__( 'Controls the border color of form fields.', 'godecore' ),
			'id'		 => 'ved_form_border_color',
			'type'		 => 'color',
			'title'		 => esc_html__( 'Form Border Color', 'godecore' ),
			'default'	 => '#e2e2e2',
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-social-sharing-main-tab',
	'title'	 => esc_html__( 'Social Sharing Box', 'godecore' ),
	'icon'	 => 'fa fa-group icon-large',
	'fields' => array(
		array(
			'subtitle'	 => esc_html__( 'Select a custom social icon color.', 'godecore' ),
			'id'		 => 'ved_sharing_box_icon_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Social Sharing Box Custom Icons Color', 'godecore' ),
			'default'	 => '#222222',
		),
		array(
			'subtitle'	 => esc_html__( 'Select a custom social icon box color.', 'godecore' ),
			'id'		 => 'ved_sharing_box_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Social Sharing Box Icons Custom Box Color', 'godecore' ),
			'default'	 => '#f5f5f5',
		),
		array(
			'subtitle'	 => esc_html__( 'Box radius for the social icons. In pixels, ex: 4px.', 'godecore' ),
			'id'		 => 'ved_sharing_box_radius',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Social Sharing Box Icons Boxed Radius', 'godecore' ),
			'default'	 => '50%',
		),
		array(
			'subtitle'	 => esc_html__( 'Controls the tooltip position of the social icons in the sharing box.', 'godecore' ),
			'id'		 => 'ved_sharing_box_tooltip_position',
			'type'		 => 'select',
			'options'	 => array(
				'top'	 => esc_html__( 'Top', 'godecore' ),
				'right'	 => esc_html__( 'Right', 'godecore' ),
				'bottom' => esc_html__( 'Bottom', 'godecore' ),
				'left'	 => esc_html__( 'Left', 'godecore' ),
				'none'	 => esc_html__( 'None', 'godecore' ),
			),
			'title'		 => esc_html__( 'Social Sharing Box Icons Tooltip Position', 'godecore' ),
			'default'	 => 'none',
		),
		array(
			'subtitle'	 => esc_html__( 'Show the facebook sharing icon in blog posts.', 'godecore' ),
			'id'		 => 'ved_sharing_facebook',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Facebook', 'godecore' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Show the twitter sharing icon in blog posts.', 'godecore' ),
			'id'		 => 'ved_sharing_twitter',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Twitter', 'godecore' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Show the linkedin sharing icon in blog posts.', 'godecore' ),
			'id'		 => 'ved_sharing_linkedin',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'LinkedIn', 'godecore' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Show the g+ sharing icon in blog posts.', 'godecore' ),
			'id'		 => 'ved_sharing_google',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Google Plus', 'godecore' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Show the pinterest sharing icon in blog posts.', 'godecore' ),
			'id'		 => 'ved_sharing_pinterest',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Pinterest', 'godecore' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Show the email sharing icon in blog posts.', 'godecore' ),
			'id'		 => 'ved_sharing_email',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Email', 'godecore' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Show the more options button in blog posts.', 'godecore' ),
			'id'		 => 'ved_sharing_more_options',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'More Options Button', 'godecore' ),
                        'default'	 => 1,
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-social-links-main-tab',
	'title'	 => esc_html__( 'Social Media Links', 'godecore' ),
	'icon'	 => 'fa fa-share-square-o icon-larg',
	'fields' => array(
		array(
			'subtitle'	 => esc_html__( 'Choose the color scheme of social icons', 'godecore' ),
			'id'		 => 'ved_social_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Social Icons Color', 'godecore' ),
			'default'	 => '#ffffff',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose yes option if you want to display icon in boxed', 'godecore' ),
			'id'		 => 'ved_social_boxed',
			'type'		 => 'select',
			'options'	 => array(
				'no'	 => esc_html__( 'No', 'godecore' ),
				'yes'	 => esc_html__( 'Yes', 'godecore' ),
			),
			'title'		 => esc_html__( 'Social Icons Boxed', 'godecore' ),
			'default'	 => 'no',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose the color scheme of social icon boxed', 'godecore' ),
			'id'		 => 'ved_social_boxed_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Social Icon Boxed Background Color', 'godecore' ),
			'default'	 => '#f5f5f5',
		),
		array(
			'subtitle'	 => esc_html__( 'Box radius for the social icons. In pixels, ex: 4px.', 'godecore' ),
			'id'		 => 'ved_social_boxed_radius',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Social Icon Boxed Radius', 'godecore' ),
			'default'	 => '2px',
		),
		array(
			'subtitle'	 => esc_html__( 'Choose _blank option if you want to open link in new window tab.', 'godecore' ),
			'id'		 => 'ved_social_target',
			'type'		 => 'select',
			'options'	 => array(
				'_blank' => esc_html__( '_blank', 'godecore' ),
				'_self'	 => esc_html__( '_self', 'godecore' ),
			),
			'title'		 => esc_html__( 'Social Icons Boxed', 'godecore' ),
			'default'	 => '_blank',
		),
		array(
			'subtitle'	 => esc_html__( 'Controls the tooltip position of the social icons', 'godecore' ),
			'id'		 => 'ved_social_tooltip_position',
			'type'		 => 'select',
			'options'	 => array(
				'top'	 => esc_html__( 'Top', 'godecore' ),
				'right'	 => esc_html__( 'Right', 'godecore' ),
				'bottom' => esc_html__( 'Bottom', 'godecore' ),
				'left'	 => esc_html__( 'Left', 'godecore' ),
				'none'	 => esc_html__( 'None', 'godecore' ),
			),
			'title'		 => esc_html__( 'Social Box Icons Tooltip Position', 'godecore' ),
			'default'	 => 'none',
		),
		array(
			'id'		 => 'ved_social_link_facebook',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Facebook', 'godecore' ),
			'default'	 => '#',
			'subtitle'	 => esc_html__( 'Insert your Facebook URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_twitter',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Twitter', 'godecore' ),
			'default'	 => '#',
			'subtitle'	 => esc_html__( 'Insert your Twitter URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_google-plus',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Google Plus', 'godecore' ),
			'default'	 => '#',
			'subtitle'	 => esc_html__( 'Insert your google-plus URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_dribbble',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Dribbble', 'godecore' ),
			'default'	 => '#',
			'subtitle'	 => esc_html__( 'Insert your dribbble URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_linkedin',
			'type'		 => 'text',
			'title'		 => esc_html__( 'LinkedIn', 'godecore' ),
			'default'	 => '#',
			'subtitle'	 => esc_html__( 'Insert your linkedin URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_tumblr',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Tumblr', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your tumblr URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_reddit',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Reddit', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your reddit URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_yahoo',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Yahoo', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your yahoo URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_deviantart',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Deviantart', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your deviantart URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_vimeo',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Vimeo', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your vimeo URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_youtube',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Youtube', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your youtube URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_pinterest',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Pinterest', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your pinterest URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_digg',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Digg', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your digg URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_flickr',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Flickr', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your flickr URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_skype',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Skype', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your skype URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_instagram',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Instagram', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your instagram URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_vk',
			'type'		 => 'text',
			'title'		 => esc_html__( 'VK', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your vk URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_paypal',
			'type'		 => 'text',
			'title'		 => esc_html__( 'PayPal', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your paypal URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_dropbox',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Dropbox', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your dropbox URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_soundcloud',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Soundcloud', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your soundcloud URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_foursquare',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Foursquare', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your foursquare URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_foursquare',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Vine', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your vine URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_wordpress',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Wordpress', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your wordpress URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_behance',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Behance', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your behance URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_stumbleupo',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Stumbleupo', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your stumbleupo URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_github',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Github', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your github URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_lastfm',
			'type'		 => 'text',
			'title'		 => esc_html__( 'Lastfm', 'godecore' ),
			'subtitle'	 => esc_html__( 'Insert your lastfm URL', 'godecore' ),
		),
		array(
			'id'		 => 'ved_social_link_rss',
			'type'		 => 'text',
			'title'		 => esc_html__( 'RSS Feed', 'godecore' ),
			'default'	 => $vedanta_rss_url,
			'subtitle'	 => esc_html__( 'Insert custom RSS Feed URL, e.g. http://feeds.feedburner.com/Example', 'godecore' ),
		),
	)
) );

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-extra-main-tab',
	'title'	 => esc_html__( 'Extra', 'godecore' ),
	'icon'	 => 'fa  fa-gears icon-large',
)
);

Redux::setSection( $ved_options, array(
	'id'              => 'ved-miscellaneous-sub-tab',
	'title'           => esc_html__('Miscellaneous', 'godecore' ),
	'subsection'	 => true,
	'fields' => array(
		array(
			'subtitle'	 => esc_html__( 'Choose enable button if you want to display Back to Top button.', 'godecore' ),
			'id'		 => 'ved_back_to_top',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Enabled', 'godecore' ),
			'off'		 => esc_html__( 'Disabled', 'godecore' ),
			'title'		 => esc_html__( 'Back to Top button', 'godecore' ),
                        'default'	 => 1,
		),
		array(
			'subtitle'	 => esc_html__( 'Choose Enable button if you want to add rel="nofollow" attribute to social sharing box and social links.', 'godecore' ),
			'id'		 => 'ved_nofollow_social_links',
			'type'		 => 'switch',
			'on'		 => esc_html__( 'Yes', 'godecore' ),
			'off'		 => esc_html__( 'No', 'godecore' ),
			'title'		 => esc_html__( 'Add rel="nofollow" to social links', 'godecore' ),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'              => 'ved-maintenance-sub-tab',
	'title'           => esc_html__('Maintenance', 'godecore' ),
	'subsection'	 => true,
	'fields'          => array(
		array(
			'id'         => 'ved_enable_maintenance',
			'type'       => 'switch',
			'title'      => esc_html__('Enable Maintenance?', 'godecore' ),
			'on'         => esc_html__('Yes', 'godecore' ),
			'off'        => esc_html__('No', 'godecore' ),
			'default'    => '0',
		),
		array(
			'id'       => 'ved_maintenance_mode',
			'type'     => 'button_set',
			'title'    => esc_html__('Maintenance Mode', 'godecore' ),
			'options'  => array(
				'maintenance' => esc_html__('Maintenance', 'godecore' ),
				'comingsoon'  => esc_html__('Coming Soon', 'godecore' ),
			),
			'default'      => 'maintenance',
			'required'     => array( 'ved_enable_maintenance', '=', '1' ),
		),
		array(
			'subtitle'	 => esc_html__( 'Upload background image will display in the Comingsoon Background.', 'godecore' ),
			'id'		 => 'ved_maintenance_bg',
			'type'		 => 'media',
			'title'        => esc_html__('Maintenance BG Image', 'godecore' ),
			'url'		 => true,
			'default'	 => array(
				'url' => GODECORE_DEFAULT . 'comingsoon-bg.jpg'
			),
			'required'     => array( 'ved_enable_maintenance', '=', '1' ),
		),
		array(
			'id'         => 'ved_maintenance_text_color',
			'type'       => 'color',
			'title'      => esc_html__('Maintenance Text Color', 'godecore' ),
			'default'    => '#222222',
			'transparent'=> false,
			'required'     => array( 'ved_enable_maintenance', '=', '1' ),
		),
		array(
			'id'           => 'ved_maintenance_title',
			'type'         => 'text',
			'title'        => esc_html__('Maintenance Title', 'godecore' ),
			'default'      => esc_html__('Site is Under Maintenance', 'godecore' ),
			'required'     => array( 'ved_maintenance_mode', '=', 'maintenance' ),
		),
		array(
			'id'           => 'ved_maintenance_subtitle',
			'type'         => 'text',
			'title'        => esc_html__('Maintenance Subtitle', 'godecore' ),
			'default'      => esc_html__('This Site is Currently Under Maintenance. We will back shortly', 'godecore' ),
			'required'     => array( 'ved_maintenance_mode', '=', 'maintenance' ),
		),
		array(
			'id'           => 'ved_comingsoon_title',
			'type'         => 'text',
			'title'        => esc_html__('Coming Soon Title', 'godecore' ),
			'default'      => esc_html__('Coming soon', 'godecore' ),
			'required'     => array( 'ved_maintenance_mode', '=', 'comingsoon' ),
		),
		array(
			'id'           => 'ved_comingsoon_subtitle',
			'type'         => 'text',
			'title'        => esc_html__('Coming Soon Subtitle', 'godecore' ),
			'default'      => esc_html__('We are currently working on a website and won\'t take long. Don\'t forget to check out our Social updates.', 'godecore' ),
			'required'     => array( 'ved_maintenance_mode', '=', 'comingsoon' ),
		),
		array(
			'id'           => 'ved_comingsoon_date',
			'type'         => 'date',
			'title'        => esc_html__('Coming Soon Date', 'godecore' ),
			'subtitle'     => esc_html__('Select coming soon date.', 'godecore' ),
			'placeholder'  => esc_html__('Click to enter a date', 'godecore' ),
			'required'     => array( 'ved_maintenance_mode', '=', 'comingsoon' ),
			'default'      => date( 'm/d/Y', strtotime('+1 months') ),
		),
		array(
			'id'		 => 'ved_canvas_border',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Canvas Border Color', 'godecore' ),
			'required'     => array( 'ved_maintenance_mode', '=', 'comingsoon' ),
			'default'	 => '#222222',
		),
		array(
			'id'           => 'ved_comming_soon_social_icons',
			'type'         => 'switch',
			'title'        => esc_html__('Social Icons', 'godecore' ),
			'subtitle'     => esc_html__('Show/hide social icons.', 'godecore' ),
			'default'      => true,
			'required'     => array( 'ved_enable_maintenance', '=', '1' ),
		),
		array(
			'id'		 => 'ved_social_iconcolor',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Social Icon Color', 'godecore' ),
			'default'	 => '#222222',
			'required'   => array(
				array('ved_comming_soon_social_icons', '=', array('1') ),
			)
		),
		array(
			'id'		 => 'ved_social_icon_hover_color',
			'type'		 => 'color',
			'compiler'	 => true,
			'title'		 => esc_html__( 'Social Icon Hover Color', 'godecore' ),
			'default'	 => '#ffffff',
			'required'   => array(
				array('ved_comming_soon_social_icons', '=', array('1') ),
			)
		),
		array(
			'id'           => 'ved_comming_soon_newsletter',
			'type'         => 'switch',
			'title'        => esc_html__('Display Newsletter', 'godecore' ),
			'subtitle'     => esc_html__('Show/hide newsletter.', 'godecore' ),
			'default'      => false,
			'required'     => array( 'ved_enable_maintenance', '=', '1' ),
		),
		array(
			'id'         => 'ved_newsletter_button_background_color',
			'type'       => 'color',
			'title'      => esc_html__('Newsletter Button Background Color', 'godecore' ),
			'default'    => '#222222',
			'transparent'=> false,
			'required'   => array('ved_comming_soon_newsletter', '=', array('1')),
		),
		array(
			'id'         => 'ved_newsletter_button_text_color',
			'type'       => 'color',
			'title'      => esc_html__('Newsletter Button Text Color', 'godecore' ),
			'default'    => '#fff',
			'transparent'=> false,
			'required'   => array('ved_comming_soon_newsletter', '=', array('1')),
		),
		array(
			'id'         => 'ved_newsletter_button_text_hover_color',
			'type'       => 'color',
			'title'      => esc_html__('Newsletter Button Text Hover Color', 'godecore' ),
			'default'    => '#fff',
			'transparent'=> false,
			'required'   => array('ved_comming_soon_newsletter', '=', array('1')),
		),
		array(
			'id'           => 'ved_comming_page_newsletter_shortcode',
			'type'         => 'select',
			'title'        => esc_html__('Newsletter Form', 'godecore' ),    
			'subtitle'     => esc_html__('Select newsletter form for display newsletter box on Comming Soon/Maintenance Page.', 'godecore' ),   
			'data'         => 'posts',
			'args'         => array(
				'post_type'=> 'mc4wp-form',
			),
			'required'     => array(
				array( 'ved_enable_maintenance', '=', '1' ),
				array( 'ved_comming_soon_newsletter', '=', '1' ),
			),
		),
	),
)
);

Redux::setSection( $ved_options, array(
	'id'	 => 'ved-import-export-main-tab',
	'title'	 => esc_html__( 'Import / Export', 'godecore' ),
	'icon'	 => 'fa fa-exchange icon-large',
	'fields' => array(
		array(
			'id'		 => 'redux_import_export',
			'type'		 => 'import_export',	
			'full_width'	 => true,
		)
	),
)
);
// -> END Basic Fields

/*
 * Override Redux Content with GoDecore Content
 * 
 * 
 */
function vedanta_override_content() {
	wp_dequeue_style( 'redux-admin-css' );
	wp_dequeue_style( 'select2-css' );
	wp_dequeue_style( 'redux-elusive-icon' );
	wp_dequeue_style( 'redux-elusive-icon-ie7' );
}
add_action( 'redux-enqueue-ved_options', 'vedanta_override_content' );

/*
 * Hide Demo Mode Link
 * 
 * 
 */
function vedanta_remove_demo() {

	// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
	if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
		// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
		remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
	}
}
add_action( 'redux/loaded', 'vedanta_remove_demo' );

/*
 * Hide Demo Mode Link
 * 
 * 
 */
function vedanta_headerdefault() {
    wp_enqueue_script('vedanta-headerdefault', get_template_directory_uri() . '/themeoptions/options/js/headerdefault.js', array(), '', true);
}
add_action("redux/page/{$ved_options}/enqueue", "vedanta_headerdefault");
