<?php
// Navbar
register_nav_menus([
   'main-menu' => __( 'منوی اصلی' ),
]);

// Theme supports
add_theme_support( 'post-thumbnails' );
add_theme_support( 'title-tag' );
add_theme_support( 'woocommerce' );

// Carbon Fields
add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
add_action( 'after_setup_theme', 'crb_load' );


// Remove woocommrce parts
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );

