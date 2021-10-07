<?php

///////////////////////
// Custom User Table //
///////////////////////

function modify_user_table( $column ) {
   $column['phone'] = 'شماره همراه';
   $column['fullname'] = 'نام';
   return $column;
}
add_filter( 'manage_users_columns', 'modify_user_table' );

function modify_user_table_row( $val, $column_name, $user_id ) {
   switch ($column_name) {
      case 'phone' :
      return get_the_author_meta( 'phone', $user_id );
      case 'fullname' :
      return get_the_author_meta( 'fullname', $user_id );
      default:
   }
   return $val;
}
add_filter( 'manage_users_custom_column', 'modify_user_table_row', 10, 3 );


/////////////////////
// Remove adminbar //
/////////////////////
function remove_admin_bar() {
   // if (!current_user_can('administrator') && !is_admin()) {
      show_admin_bar(false);
   // }
}
add_action('after_setup_theme', 'remove_admin_bar');
