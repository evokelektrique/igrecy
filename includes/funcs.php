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



function igrecy_comment($comment, $args, $depth) {
   $GLOBALS['comment'] = $comment;
   ?>
   <div class="comment <?php if($depth > 1) echo('reply-comment'); ?>" id="comment-<?php comment_ID(); ?>" style="width: 100%">
      <div class="single-comment-wrapper">
         <img class="user-profile-img" src="<?= get_avatar_url( $comment ) ?>" alt="" />

         <div class="main-comment-section">
            <div class="comment-header">
               <div class="col">
                  <div class="user-details">
                     <h6><?= get_comment_author() ?></h6>
                     <p class="deactivated-text"><?php printf(__('%1$s'), get_comment_date(),  false) ?></p>
                  </div>
               </div>
               <div class="col">
                  <div class="reply-btn">
                     <img src="<?= get_template_directory_uri() . '/dist' ?>/src/images/reply.svg" alt="" />
                     <p class="p-small text-3">
                        <?php
                        $args["reply_text"] = "پاسخ دادن";
                        comment_reply_link(array_merge(
                              $args,
                              array('depth' => $depth, 'max_depth' => $args['max_depth'])
                        ))
                        ?>
                     </p>
                  </div>
                  <div class="like-btn">
                     <img src="<?= get_template_directory_uri() . '/dist' ?>/src/images/thumbs-up.svg" alt="لایک کردن" />
                     <p class="primary-blue-text">2</p>
                  </div>
                  <div class="dislike-btn">
                     <img src="<?= get_template_directory_uri() . '/dist' ?>/src/images/thumbs-down.svg" alt="دیسلایک کردن" />
                     <p class="red-text">0</p>
                  </div>
               </div>
            </div>
            <p class="comment-content">
               <?php comment_text() ?>
            </p>
         </div>
      </div>
   </div>
   <?php
}

