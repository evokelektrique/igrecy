<?php
///////////////////
// Carbon Fields //
///////////////////

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function crb_attach_theme_options() {
    Container::make( 'theme_options', __( 'Theme Options' ) )
        ->add_fields( array(
            Field::make( 'text', 'crb_text', 'Text Field' ),
        ) );
}

function crb_load() {
    require_once( __DIR__ . '../../vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}

