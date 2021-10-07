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

///////////////////////
// Custom pagination //
///////////////////////

function custom_pagination($numpages = '', $pagerange = '', $paged='') {

  if (empty($pagerange)) {
    $pagerange = 2;
  }
  global $paged;
  if (empty($paged)) {
    $paged = 1;
  }
  if ($numpages == '') {
    global $wp_query;
    $numpages = $wp_query->max_num_pages;
    if(!$numpages) {
        $numpages = 1;
    }
  }

  $prev_arrow = "<img src='" . get_template_directory_uri() . "/dist/src/images/slide-change-arrow.svg' class='prev-arrow' alt=''>";
  $next_arrow = "<img src='" . get_template_directory_uri() . "/dist/src/images/slide-change-arrow.svg' alt=''>";
  $pagination_args = array(
    'base'            => get_pagenum_link(1) . '%_%',
    'format'          => 'page/%#%',
    'total'           => $numpages,
    'current'         => $paged,
    'show_all'        => False,
    'end_size'        => 1,
    'mid_size'        => $pagerange,
    'prev_next'       => True,
    'prev_text'       => $prev_arrow,
    'next_text'       => $next_arrow,
    'type'            => 'array',
    'add_args'        => false,
    'add_fragment'    => ''
  );

 $paginate_links = paginate_links($pagination_args);

 if (is_array($paginate_links)) {
   echo "<div class='pagination'>";
   foreach ( $paginate_links as $page ) {
     echo "$page";
   }
   echo "</div>";
 }
}

