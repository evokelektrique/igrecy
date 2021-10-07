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


function crb_attach_term_meta() {
   Container::make('post_meta', __('آپشن های محصول', "a4a" ))->add_fields([
      Field::make('text', 'course_time', __('زمان کل دوره', "a4a")),

      Field::make('complex', 'course_fields', __( 'محتویات دوره' ))->add_fields([
         Field::make('text', 'url', __('آدرس ', "ig")),
         Field::make( 'select', 'type', __( 'نوع' ) )
         ->set_options([
            "video"      => "ویدیو",
            "file"    => "فایل"
         ])
      ])
   ]);
}

add_action( 'carbon_fields_register_fields', 'crb_attach_term_meta' );
