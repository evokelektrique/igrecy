<?php
///////////////////
// Carbon Fields //
///////////////////

use Carbon_Fields\Container;
use Carbon_Fields\Field;

function crb_attach_theme_options() {
   Container::make( 'theme_options', __( 'Theme Options' ) )->add_fields( array(
      Field::make('complex', 'students_comments', __( 'نظرات دانشجویان' ))->add_fields([
         Field::make('text', 'name', __('نام', "ig")),
         Field::make('text', 'role', __('لقب', "ig")),
         Field::make( 'image', 'img_url', __('عکس', 'ig'))->set_value_type( 'url' ),
         Field::make('textarea', 'description', __('توضیحات', "ig"))
      ])
   ));
}

function crb_load() {
    require_once( __DIR__ . '../../vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}


function crb_attach_term_meta() {
   Container::make('post_meta', __('آپشن های محصول', "ig" ))->add_fields([
      // Field::make('text', 'course_main_video_url', __('آدرس ویدیو توضیحات دوره', "ig")),
      Field::make('text', 'course_time', __('زمان کل دوره', "ig")),
      Field::make('text', 'course_files_count', __('تعداد فایل های دوره', "ig")),

      Field::make('complex', 'course_fields', __( 'محتویات دوره' ))->add_fields([
         Field::make('text', 'description', __('توضیحات', "ig")),
         Field::make('text', 'duration', __('زمان', "ig")),
         Field::make( 'checkbox', 'is_free', 'رایگان می باشد' )->set_option_value( 'yes' ),
         Field::make( 'select', 'type', __( 'نوع' ) )
         ->set_options([
            "video"      => "ویدیو",
            "file"    => "فایل"
         ]),
         Field::make('text', 'url', __('آدرس ', "ig"))
      ])
   ]);

   Container::make('post_meta', __('توضیحات مدرس دوره', "ig" ))->add_fields([
      Field::make( 'image', 'tutor_img_url', __('عکس', 'ig'))
          ->set_value_type( 'url' ),
      Field::make('text', 'tutor_name', __('نام', "ig")),
      Field::make('text', 'tutor_skills', __('مهارت ها', "ig")),
      Field::make('textarea', 'tutor_description', __('توضیحات', "ig")),
      Field::make('text', 'tutor_instagram_url', __('Instagram', "ig")),
      Field::make('text', 'tutor_website_url', __('Website', "ig")),
      Field::make('text', 'tutor_linkedin_url', __('LinkedIn', "ig"))
   ]);
}

add_action( 'carbon_fields_register_fields', 'crb_attach_term_meta' );
