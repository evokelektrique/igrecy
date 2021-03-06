<?php
/**
 * The template for displaying comments
 * The area of the page that contains both current comments
 * and the comment form.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
   return;
}
?>

<?php if ( comments_open() ) : ?>
<style>
.comment {
   margin-bottom: 30px;
}

 /**
  * Like and dislikes
  */


.cld-like-trigger i,
.cld-dislike-trigger i {
   display: none;
}
.cld-like-trigger {
   padding: 0 11px;
   background: url(<?= get_template_directory_uri() . '/dist' ?>/src/images/thumbs-up.svg);
   width: 25px;
   height: 25px;
}
.cld-like-count-wrap {
   color: blue;
}
.cld-dislike-trigger {
   padding: 0 11px;
   background: url(<?= get_template_directory_uri() . '/dist' ?>/src/images/thumbs-down.svg);
   width: 25px;
   height: 25px;
}
.cld-dislike-count-wrap {
   color: red;
}

.sendForm textarea {
   background: #F9FAFB;
   border: 1px solid #DFE3E8;
   box-sizing: border-box;
   border-radius: 12px;
   margin-top: 32px;
   margin-bottom: 32px;
   padding: 15px;
   width: 100%;
}
.sendForm button {
   width: 116px;
   height: 48px;
   background: #1890FF;
   box-shadow: 0px 8px 16px rgba(24, 144, 255, 0.32);
   border-radius: 12px;
   color: white;
   border: none;
   cursor: pointer;
   outline: none;
}
</style>

<div class="comments">
   <?php wp_list_comments("callback=igrecy_comment");?>
</div>

<div id="respond">
   <div id="cancel-comment-reply">
      <small><?php cancel_comment_reply_link() ?></small>
   </div>

   <?php if ( get_option('comment_registration') && !is_user_logged_in() ) : ?>
   <!-- Loggin required message here -->
   <p><?php printf(__('You must be <a href="%s">logged in</a> to post a comment.'), wp_login_url( get_permalink() )); ?></p>
   <?php else : ?>

   <form class="sendForm" action="<?php echo site_url(); ?>/wp-comments-post.php" method="post" id="commentform">
         <!-- Text area here -->
         <div class="col">
           <textarea name="comment" id="message" placeholder="?????? ???????????????? ?????????? ??????????????" cols="80" rows="5"></textarea>
         </div>

      <div class="row">
         <?php if ( !is_user_logged_in() ) : ?>
            <!-- email and name here -->
              <input type="text" name="author" placeholder="?????? ?? ?????? ????????????????" />
              <input type="email" name="email" placeholder="?????????? ??????" />
         <?php endif; ?>
            <!-- Submit Button -->
           <button type="submit">?????????? ??????</button>
         </div>
      <?php comment_id_fields(); ?>
   </div>



   <?php
   /** This filter is documented in wp-includes/comment-template.php */
   do_action( 'comment_form', $post->ID );
   ?>

   </form>
   <?php endif; // If registration required and not logged in ?>



<?php endif; // if you delete this the sky will fall on your head ?>
