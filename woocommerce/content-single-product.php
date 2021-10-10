<?php

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
   echo get_the_password_form(); // WPCS: XSS ok.
   return;
}

// Attributes
$course_time = carbon_get_the_post_meta('course_time');
$course_files_count = carbon_get_the_post_meta('course_files_count');
$add_to_cart_url = get_bloginfo('url') . "/checkout/?add-to-cart=" . $product->get_id();
$total_sold = get_post_meta( $product->get_id(), 'total_sales', true );
$tutor = [
   'name' => carbon_get_the_post_meta('tutor_name'),
   'skills' => carbon_get_the_post_meta('tutor_skills'),
   'description' => carbon_get_the_post_meta('tutor_description'),
   'instagram_url' => carbon_get_the_post_meta('tutor_instagram_url'),
   'website_url' => carbon_get_the_post_meta('tutor_website_url'),
   'linkedin_url' => carbon_get_the_post_meta('tutor_linkedin_url'),
   'image_url' => carbon_get_the_post_meta('tutor_img_url')
];

$course_lessions = carbon_get_the_post_meta('course_fields');
if (is_user_logged_in()) {
   if (wc_customer_bought_product('', get_current_user_id(), $product->get_id())) {
      $is_purchased = true;
   } else {
      $is_purchased = false;
   }
} else {
   $is_purchased = false;
}

$rating  = intval($product->get_average_rating());
?>

<div class="product-title-header" style="padding: 4em; padding-bottom: 1em;">
   <h2 class="product-title primary-dark-text"><?php the_title(); ?></h2>
   <?php
   if(function_exists('yoast_breadcrumb')) {
      yoast_breadcrumb('<div class="breadcrumb text-3">','</div>');
   }
   ?>
</div>
<div class="container product-container">
   <div class="main">
      <!-- Video Player And Thumbnail -->
      <div class="product-video shadow-normal">
         <div class="video-container">
            <img class="video preview_thumbnail" src="<?= get_the_post_thumbnail_url(); ?>" alt="" />
            <div class="video-play-container preview_thumbnail">
               <div class="play-btn">
                  <img class="play-icon" src="<?= get_template_directory_uri() . "/dist" ?>/src/images/play-btn.svg" alt="" />
               </div>
            </div>
         </div>
      </div>

      <div class="mobile-course-details course-details shadow-normal">
         <div class="rating">
            <div class="stars">
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
            <p class="p-small deactivated-text"><?= $product->get_rating_count(); ?> رای</p>
         </div>
         <div class="detail-container">
            <div class="col">
               <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/course-clock-time.svg" alt="زمان دوره" />
               <p class="text-3"><?= $course_time ?></p>
            </div>
            <div class="col">
               <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/course-students.svg" alt="دانشجویان دوره" />
               <p class="text-3"> <?= $total_sold ?> دانشجو</p>
            </div>
            <div class="col">
               <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/course-videos.svg" alt="ویدیو های دوره" />
               <p class="text-3"><?= $course_files_count ?></p>
            </div>
         </div>
         <a href="<?= $add_to_cart_url ?>" class="btn btn-buy-course">
            <?php if($product->is_on_sale()): ?>
            <p class="price"><?= $product->get_sale_price() ?> تومان</p>
            <?php else: ?>
            <p class="price"><?= $product->get_regular_price() ?> تومان</p>
            <?php endif; ?>
            <hr />
            <p>خرید</p>
         </a>
      </div>
      <div class="product-details shadow-normal">
         <div class="product-description">
            <h5>توضیحات دوره</h5>
            <p class="text-3">
               <?php the_content(); ?>
            </p>
         </div>
         <div class="product-lessons">
            <h5>سرفصل های دوره</h5>
            <ul class="product-lesson-items">
               <?php foreach($course_lessions as $lession): ?>
                  <li
                  class="product-lesson-item
                  <?php if($lession['type'] === 'video') echo 'video_lession_item'; ?> <?php if($lession['type'] === 'file') echo 'file_lession_item'; ?>" data-url="<?= ($is_purchased || $lession["is_free"]) ? $lession["url"] : ''; ?>" data-purchased="<?= intval($lession["is_free"] || $is_purchased) ?>"
                  >
                     <div class="col">
                        <?php if($lession["type"] === "video" && !$lession["is_free"]): ?>
                        <!-- Video -->
                        <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/file-play-icon.svg" alt="" />
                        <?php elseif($lession["type"] === "file"): ?>
                        <!-- File -->
                        <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/document-file.svg" alt="" />
                        <?php else: ?>
                        <!-- Free -->
                        <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/done.svg" alt="" />
                        <?php endif; ?>

                        <!-- Description -->
                        <?php if(!empty($lession["description"])): ?>
                        <p><?= $lession["description"] ?></p>
                        <?php endif; ?>
                     </div>
                     <div class="col <?php if($lession['type'] === 'file') echo 'download-btn'; ?>">
                        <!-- Duration -->
                        <?php if($lession['type'] === 'video'): ?>
                        <p class="lesson-time">05:37</p>
                        <?php endif; ?>

                        <!-- Download -->
                        <?php if($lession["type"] === 'file'): ?>
                        <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/download-lesson-icon.svg" alt="" />
                        <p>دانلود</p>
                        <?php endif; ?>
                     </div>
                  </li>
               <?php endforeach; ?>
            </ul>
         </div>
      </div>
      <div class="mobile-author-container author-container shadow-normal">
         <img class="author-profile" src="<?= $tutor['image_url'] ?>" alt="" />
         <div class="author-detail">
            <h5><?= $tutor["name"] ?></h5>
            <p class="label primary-blue-text"><?= $tutor["skills"] ?></p>
         </div>
         <p class="bio text-3">
            <?= $tutor["description"] ?>
         </p>
         <div class="socialmedia-author-container">
            <a href="<?= $tutor["instagram_url"] ?>">
               <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/instagram-author.svg" alt="">
            </a>
            <a href="<?= $tutor["website_url"] ?>">
               <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/website-author.svg" alt="">
            </a>
            <a href="<?= $tutor["linkedin_url"] ?>">
               <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/linkedin-author.svg" alt="">
            </a>
         </div>
      </div>
      <div class="product-comments shadow-normal">
         <h5>نظرات کاربران</h5>
         <div class="comments-container">

            <?php
            comments_template( 'woocommerce/single-product-reviews' );
            ?>
         </div>
      </div>
   </div>
   <div class="sidebar">
      <div class="course-details shadow-normal">
         <div class="rating">
            <div class="stars">
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
            <p class="p-small deactivated-text"><?= $product->get_rating_count(); ?> رای</p>
         </div>
         <div class="detail-container">
            <div class="col">
               <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/course-clock-time.svg" alt="زمان دوره" />
               <p class="text-3"><?= $course_time ?></p>
            </div>
            <div class="col">
               <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/course-students.svg" alt="دانشجویان دوره" />
               <p class="text-3"> <?= $total_sold ?> دانشجو</p>
            </div>
            <div class="col">
               <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/course-videos.svg" alt="ویدیو های دوره" />
               <p class="text-3"><?= $course_files_count ?></p>
            </div>
         </div>
         <a href="<?= $add_to_cart_url ?>" class="btn btn-buy-course">
            <?php if($product->is_on_sale()): ?>
            <p class="price"><?= $product->get_sale_price() ?> تومان</p>
            <?php else: ?>
            <p class="price"><?= $product->get_regular_price() ?> تومان</p>
            <?php endif; ?>
            <hr />
            <p>خرید</p>
         </a>
      </div>
      <div class="author-container shadow-normal">
         <img class="author-profile" src="<?= $tutor['image_url'] ?>" alt="" />
         <div class="author-detail">
            <h5><?= $tutor["name"] ?></h5>
            <p class="label primary-blue-text"><?= $tutor["skills"] ?></p>
         </div>
         <p class="bio text-3">
            <?= $tutor["description"] ?>
         </p>
         <div class="socialmedia-author-container">
            <a href="<?= $tutor["instagram_url"] ?>">
               <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/instagram-author.svg" alt="">
            </a>
            <a href="<?= $tutor["website_url"] ?>">
               <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/website-author.svg" alt="">
            </a>
            <a href="<?= $tutor["linkedin_url"] ?>">
               <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/linkedin-author.svg" alt="">
            </a>
         </div>
      </div>
   </div>
</div>


<script type="text/javascript">
// Video lessions
Array.from(document.querySelectorAll('.video_lession_item')).forEach(item => {
   item.addEventListener('click', e => {
      e.preventDefault()

      const is_purchased = item.dataset.purchased
      if(is_purchased == 0) {
         return;
      }
      const url        = item.dataset.url;
      const container  = document.querySelector('.video-container')
      const video      = document.createElement('video');
      const source     = document.createElement('source');
      const find_video = document.getElementById('custom_video_player')

      if(find_video) {
         find_video.remove()
      }

      Array.from(document.querySelectorAll('.preview_thumbnail')).forEach(item => item.style.display = "none")

      source.setAttribute('src', url);
      video.id = "custom_video_player"
      video.setAttribute('controls', 'controls');
      video.appendChild(source);
      container.appendChild(video)
      video.scrollIntoView({behavior: "smooth", block: "end"});
      video.play();
   })
})

// Document and downloable lessions
Array.from(document.querySelectorAll('.file_lession_item')).forEach(item => {
   item.addEventListener('click', e => {
      e.preventDefault()

      const is_purchased = item.dataset.purchased
      if(is_purchased == 0) {
         return;
      }

      const url = item.dataset.url
      window.open(url, '_blank').focus()
   })
})

function change_video(video, source, url) {
   video.pause();
   source.setAttribute('src', url);
   video.load();
   video.play();
}
</script>
