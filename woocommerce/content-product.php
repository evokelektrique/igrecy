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

<div class="blog-cart-box bordered" style="max-width: 295px">
   <img class="thumbnail" style="width: 100%; border-radius: 24px" src="<?= get_the_post_thumbnail_url(); ?>" alt="<?php the_time(); ?>" />
   <a href="<?= get_the_permalink(); ?>">
      <h5><?php the_title(); ?></h5>
   </a>
   <div class="extra-course-details">
      <p class="label course-category"><?= $terms[0]->name ?></p>
      <div class="course-rating">
         <?php for ($i=0; $i < 5; $i++) {
            if($rating > $i) {
               ?>
               <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/star-filled.svg" alt="4" />
               <?php
            } else {
               ?>
               <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/star.svg" alt="4" />
               <?php
            }
         }
         ?>
      </div>
   </div>
   <p class="text-3 course-except">
      <?php the_excerpt(); ?>
   </p>
   <div class="course-time">
      <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/clock.svg" alt="" />
      <p class="deactivated-text"><?= carbon_get_the_post_meta('course_time') ?></p>
   </div>
   <div class="course-price-container">
      <?php if($product->is_on_sale()): ?>
      <p class="course-price discounted-price"><?= $product->get_sale_price() ?> تومان</p>
      <p class="course-price has-discount"><?= $product->get_regular_price() ?> تومان</p>
      <?php else: ?>
      <p class="course-price"><?= $product->get_regular_price() ?> تومان</p>
      <?php endif; ?>
   </div>
</div>
