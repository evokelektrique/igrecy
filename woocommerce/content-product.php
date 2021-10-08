<?php
defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
   return;
}

$terms = get_the_terms( $product->get_id(), 'product_cat' );
$course_time = carbon_get_the_post_meta('course_time');
?>

<div class="blog-cart-box bordered">
   <div class="blog-thumbnail">
      <img src="<?= get_template_directory_uri() . '/dist' ?>/src/images/thumbnail.jpg" alt="" />
      <p class="p-small blog-category"><?= $terms[0]->name ?></p>
   </div>
   <div class="blog-cart-content">
      <div class="blog-extra-details">
         <div class="read-time">
            <img src="<?= get_template_directory_uri() . '/dist' ?>/src/images/timer.svg" alt="">
            <p class="p-small"><?= $course_time ?></p>
         </div>
         <div class="post-likes">
            <img src="<?= get_template_directory_uri() . '/dist' ?>/src/images/like.svg" alt="">
            <p class="p-small">۱۶</p>
         </div>
      </div>
      <h5 class="blog-cart-title">
         <?php the_title(); ?>
      </h5>
      <p class="text-3 blog-cart-except">
         <?php the_excerpt(); ?>
      </p>
      <a class="primary-blue-text" href="<?= get_the_permalink(); ?>">ادامه مطلب</a>
   </div>
</div>
