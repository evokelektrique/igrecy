<?php
// Navbar
register_nav_menus([
   'main-menu' => __( 'منوی اصلی' ),
]);

// Theme supports
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );

// Enqueue Styles And Scripts
add_action( 'wp_enqueue_scripts', 'theme_enqueue' );
