<?php
add_action( 'widgets_init', 'vedanta_widgets_init' );
function vedanta_widgets_init() {

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar 1', 'godecore' ),
        'id'            => 'sidebar-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar 2', 'godecore' ),
        'id'            => 'sidebar-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Header Bar', 'godecore' ),
        'id'            => 'headerbar',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 1', 'godecore' ),
        'id'            => 'footer-1',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 2', 'godecore' ),
        'id'            => 'footer-2',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 3', 'godecore' ),
        'id'            => 'footer-3',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 4', 'godecore' ),
        'id'            => 'footer-4',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Footer 5', 'godecore' ),
        'id'            => 'footer-5',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'Before Footer', 'godecore' ),
        'id'            => 'before-footer',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );

    register_sidebar( array(
        'name'          => esc_html__( 'After Footer', 'godecore' ),
        'id'            => 'after-footer',
        'before_widget' => '<div id="%1$s" class="widget %2$s"><div class="widget-content">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="text-title text-uppercase">',
        'after_title'   => '</h6>',
    ) );
}