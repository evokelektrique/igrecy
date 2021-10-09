<?php get_header(); ?>


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
      <?php the_content(); ?>
   </div>
</div>
<?php get_footer(); ?>
