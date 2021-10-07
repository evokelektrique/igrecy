<?php get_header(); ?>

<div class="blog-list-container container">
   <div class="blog-header">
      <h2>بلاگ ایگرگ</h2>
      <?php
      if(function_exists('yoast_breadcrumb')) {
         yoast_breadcrumb('<div class="breadcrumb text-3">','</div>');
      }
      ?>
   </div>
   <div class="blog-filter-container">
      <div class="blog-category-filter">
         <select name="" id="">
            <option value="انتخاب دسته بندی">انتخاب دسته بندی مطالب</option>
            <option value="انتخاب دسته بندی">انتخاب دسته بندی</option>
            <option value="انتخاب دسته بندی">انتخاب دسته بندی</option>
            <option value="انتخاب دسته بندی">انتخاب دسته بندی</option>
         </select>
      </div>
      <div class="blog-search-input">
         <form method="get" action="<?php bloginfo('home'); ?>/"">
            <input type="hidden" name="search-type" value="posts">
            <input type="text" placeholder="دنبال چه میگردی..." name="s" value="<?php the_search_query(); ?>" />
            <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/blog-search.svg" alt="" />
         </form>
      </div>
   </div>
   <div class="blog-posts-container">
      <?php while(have_posts()): the_post(); ?>
         <div class="blog-cart-box bordered">
            <div class="blog-thumbnail">
               <img src="<?= get_the_post_thumbnail_url(); ?>" alt="" />
               <?php
               $terms = get_the_terms(get_the_ID(), 'category');
               $term = $terms[0]->name;
               ?>
               <p class="p-small blog-category"><?= $term ?></p>
            </div>
            <div class="blog-cart-content">
               <h5 class="blog-cart-title">
                  <?php the_title(); ?>
               </h5>
               <p class="text-3 blog-cart-except">
                  <?php the_excerpt(); ?>
               </p>
               <a class="primary-blue-text" href="<?= get_the_permalink(); ?>">ادامه مطلب</a>
            </div>
         </div>
      <?php endwhile; ?>
   </div>
   <?php
   global $wp_query;

   $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
   if (function_exists('custom_pagination')):
     custom_pagination($wp_query->max_num_pages, "", $paged);
   endif;
   wp_reset_query();
   ?>
</div>

<?php get_footer(); ?>
