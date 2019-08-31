<?php
/**
 * vedanta functions and definitions
 *
 *
 * @package GoDecore
 */
define( 'GODECORE_PHP_INCLUDE', get_template_directory() . '/includes/' );
define( 'GODECORE_PHP_LIB', get_template_directory() . '/lib/' );
define( 'GODECORE_VERSION', '1.0.0' );

/**
 * Enqueue scripts and styles.
 */
function vedanta_scripts() {
    wp_enqueue_style( 'vedanta-style', get_stylesheet_uri() );

    //Bootstrap Core CSS
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css' );

    //Icon Fonts
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );

    //Plugins
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri() . '/assets/css/owl.carousel.css' );
    wp_enqueue_style( 'flexslider', get_template_directory_uri() . '/assets/css/flexslider.css' );
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.min.css' );
    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/slick/slick.css' );

    //Theme Core CSS
    $ved_demo_style = vedanta_get_option( 'ved_demo_style', 'dddemo1' );
    wp_enqueue_style( 'ved-main', get_template_directory_uri() . '/assets/css/ved-main.css' );
    wp_enqueue_style( 'wooshop', get_template_directory_uri() . '/assets/css/wooshop.css' );
	wp_enqueue_style( 'dddemo', get_template_directory_uri() . '/assets/css/'.$ved_demo_style.'.css' );
    wp_enqueue_style( 'dynamic-style', get_template_directory_uri() . '/assets/css/dynamic.css' );

    //Theme Dynamic CSS
    $vedanta_dynamic_css = '';
    require_once( get_template_directory() . '/assets/css/dynamic-css.php' );
    wp_add_inline_style( 'dynamic-style', $vedanta_dynamic_css );

    //JAVASCRIPT FILES
    wp_enqueue_script( 'jquery' );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }

    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.min.js', array( 'jquery' ), GODECORE_VERSION, true );
    wp_enqueue_script( 'ved-core', get_template_directory_uri() . '/assets/js/ved-core.js', array( 'jquery' ), GODECORE_VERSION, true );
    
	wp_enqueue_script( 'vedanta-countdown', get_template_directory_uri() . '/assets/js/TimeCircles.js', array(), '1.0.0', true );
    
    wp_enqueue_script( 'tweenmax', get_template_directory_uri() . '/assets/js/TweenMax.min.js', array(), '1.0.0', true  );
    
    wp_enqueue_script( 'ved-main', get_template_directory_uri() . '/assets/js/ved-main.js', array( 'jquery' ), GODECORE_VERSION, true );
    wp_enqueue_script( 'vedanta-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '1.0.0', true );
    wp_enqueue_script( 'owl-carousel-js', get_template_directory_uri() . '/assets/js/owl.carousel.min.js', array( 'jquery' ), '1.0', true );
    wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/assets/slick/slick.min.js', array( 'jquery' ), '1.0', true );

    $header_type = vedanta_get_option( 'ved_header_type' );
	$ved_header_type		 = vedanta_get_option( 'ved_header_type' );
	$ved_woo_items		 = vedanta_get_option( 'ved_woo_items' );
    wp_localize_script( 'ved-main', 'vedantaData', array(
        'ajax_url'            => admin_url( 'admin-ajax.php' ),
        'nonce'               => wp_create_nonce( '_vedanta_nonce' ),
        'search_content_type' => vedanta_get_option( 'ved_search_content_type' ),
        'ajax_search'         => intval( vedanta_get_option( 'ved_header_ajax_search' ) ),
        'headertype' => $header_type,
        'header_width' => $ved_header_type,
		'woo_items' => $ved_woo_items,
    ) );
}

add_action( 'wp_enqueue_scripts', 'vedanta_scripts' );

/**
 * Enqueue admin scripts and styles.
 */
function vedanta_adminscripts( $hook ) {
    if ( $hook == 'appearance_page_godecore_options' ) {
        wp_enqueue_style( 'themeoptions', get_template_directory_uri() . '/themeoptions/options/css/themeoptions.css', false, 258 );
        wp_enqueue_script( 'themeoptions-js', get_template_directory_uri() . '/themeoptions/options/js/themeoptions.js', '', '', true );
    }
}

add_action( 'admin_enqueue_scripts', 'vedanta_adminscripts' );

// load Widget functions
require_once( GODECORE_PHP_INCLUDE . 'widgets.php' );
require_once( GODECORE_PHP_INCLUDE . 'multiple_sidebars.php' );

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require_once( GODECORE_PHP_INCLUDE . 'functions/template-functions.php');

/**
 * Functions which enhance the basic theme functionality. 
 */
require_once( GODECORE_PHP_INCLUDE . 'functions/basic-functions.php');
require_once( GODECORE_PHP_INCLUDE . 'functions/header-functions.php');
require_once( GODECORE_PHP_INCLUDE . 'functions/maintenance.php');

// Vedanta Mega Menu
require_once( GODECORE_PHP_INCLUDE . 'mega-menu-framework.php' );

// Primary Menu
require_once( GODECORE_PHP_INCLUDE . 'vedanta-nav-menu.php' );

/**
 * WooCommerce configuration file
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

if ( class_exists( 'Woocommerce' ) ) {
    include_once( GODECORE_PHP_INCLUDE . 'woo-config.php' );
    include_once( GODECORE_PHP_INCLUDE . 'woo-shop-hooks.php' );
}

/**
 * Initialize Theme Options
 */
require_once(get_template_directory() . '/themeoptions/options.php');

// TGMPA Library
require_once( GODECORE_PHP_LIB . 'tgmpa/register-plugins.php' );

// load Semantic Classes functions
require_once( GODECORE_PHP_INCLUDE . 'extensions/semantic-classes.php' );

// Portfolio
require_once( GODECORE_PHP_INCLUDE . 'extensions/post-link-plus.php' );

// load the WP vedanta Hook System
require_once( GODECORE_PHP_INCLUDE . 'functions/hooks.php' );

// load comment functions
require_once( GODECORE_PHP_INCLUDE . 'functions/comment-functions.php' );

// load pluggable functions
require_once( GODECORE_PHP_INCLUDE . 'functions/pluggable.php' );

require_once( GODECORE_PHP_INCLUDE . 'functions/custom-header.php' );

require_once( GODECORE_PHP_INCLUDE . 'functions/template-tags.php' );

require_once( GODECORE_PHP_INCLUDE . 'functions/customizer.php' );

if ( defined( 'JETPACK__VERSION' ) ) {
    require_once( GODECORE_PHP_INCLUDE . 'functions/jetpack.php' );
}

/*
Import theme-options when theme active/init
*/
add_action( 'after_switch_theme', 'restora_pro_theme_activation' );
function restora_pro_theme_activation() {
    if ( !get_option( 'active_restora_theme' ) ) {
            $theme_options_txt	 = get_template_directory() . '/themeoptions/theme-options.json';
            ob_start();
            include $theme_options_txt;
            $theme_options_txt = ob_get_clean();
            $datafile		 = json_decode( ($theme_options_txt ), true );
            update_option( 'ved_options', $datafile );
            update_option( 'active_restora_theme', true );
    }
}

/*
Enqueue scripts and styles.
*/
if ( ! class_exists( 'Redux' ) ) {
    add_action( 'get_header', 'restora_google_fonts' ); 
}

function restora_google_fonts() {
    wp_enqueue_style( 'google-fonts', restora_load_fonts(), array(), '1.0.0' );
}

function restora_load_fonts() {
    $fonts_url = '';
    $font_families[] = 'Poppins:300,400,500,600,800';
    $query_args = array(
        'family' => urlencode( implode( '|', $font_families ) ),
        'subset' => urlencode( 'latin,latin-ext' ),
    );
    $fonts_url = esc_url( add_query_arg( $query_args, 'https://fonts.googleapis.com/css' ));
    return esc_url_raw( $fonts_url );
}