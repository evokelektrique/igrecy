<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header();

?>

<style type="text/css">
.blog-posts-container-wrapper {
   display: flex;
}
@media (max-width: 1024px) {
   .blog-posts-container-wrapper {
      flex-direction: column;
   }
   .sidebar {
      display: block !important;
      position: fixed;
      top: 0;
      margin: 0 !important;
      transition: all .4s ease-in-out;
      height: 100%;
      border-radius: 0 !important;
      background: #fff;
      right: -100%;
   }
}

.sidebar {
   flex: 1;
   margin-left: 10px;
   margin-top: 40px;
   border: 1px solid #DFE3E8;
   border-radius: 16px;
   padding: 10px;
}

.blog-posts-container {
   flex: 2;
}

.sidebar-categories-wrapper {
   display: block;
   list-style: none;
}
.sidebar-categories-wrapper li,
.sidebar-categories-wrapper li a {
   display: block
}
.sidebar-categories-wrapper li a {
   padding: 5px 15px;
   display: flex;
   align-items: center;
}
.sidebar-categories-child-wrapper li a {
   padding-right: 35px;
}
.sidebar-categories-wrapper li img {
   width: 28px;
   margin-left: 6px;
}


.sidebar-categories h4 {
   font-size: 18px;
   font-weight: bold;
   margin-bottom: 12px;
   padding: 0 15px;
}
.sidebar-filters {
   display: flex;
   flex-direction: row;
   justify-content: center;
   align-items: center;
   padding: 4px;
   background: #F4F6F8;
   border-radius: 16px;
   margin-top: 10px;
   margin-bottom: 20px;
}
.sidebar-filters a {
   color: #919EAB;
   margin: 0 12px;
}
.sidebar-filters a.active {
   padding: 10px;
   background: linear-gradient(180deg, #FFFFFF 0%, #F5F5F5 100%);
   box-shadow: 0px 8px 16px rgba(145, 158, 171, 0.48);
   border-radius: 12px;
   color: #1890FF;
}

.sidebar-filters-toggle-wrapper {
   height: 40px;
   padding: 10px;
   display: none;
}
@media (max-width: 1024px) {
   .sidebar-filters-toggle-wrapper {
      display: block;
   }
}



</style>

<div class="blog-list-container container">
   <div class="blog-header">
      <h2><?php woocommerce_page_title(); ?></h2>
      <?php
      if(function_exists('yoast_breadcrumb')) {
         yoast_breadcrumb('<div class="breadcrumb text-3">','</div>');
      }
      ?>
   </div>


   <?php
   if ( woocommerce_product_loop() ) {

      /**
       * Hook: woocommerce_before_shop_loop.
       *
       * @hooked woocommerce_output_all_notices - 10
       * @hooked woocommerce_result_count - 20
       * @hooked woocommerce_catalog_ordering - 30
       */
      do_action( 'woocommerce_before_shop_loop' );

      echo('<div class="blog-posts-container-wrapper">');
      ?>

      <!-- Sidebar -->
      <div class="sidebar">

         <div class="sidebar-categories">
            <?php
            $current_tag_url = add_query_arg( $wp->query_vars );

            // Free
            $free_tag_url = get_term_link(get_term_by('slug', 'free','product_tag'));
            $is_free_tag_current_page = strpos($free_tag_url, $current_tag_url) !== false;

            // Not Free
            $not_free_tag_url = get_term_link(get_term_by('slug', 'not_free','product_tag'));
            $is_not_free_tag_current_page = strpos($not_free_tag_url, $current_tag_url) !== false;

            // All
            $all_tag_url = get_permalink( wc_get_page_id( 'shop' ) );
            $is_all_tag_current_page = is_shop();
            ?>
            <div class="sidebar-filters">
               <a href="<?= $not_free_tag_url ?>" class="<?= $is_not_free_tag_current_page ? 'active' : '' ?>">غیر رایگان</a>
               <a href="<?= $free_tag_url ?>" class="<?= $is_free_tag_current_page ? 'active' : '' ?>">رایگان</a>
               <a href="<?= $all_tag_url ?>" class="<?= $is_all_tag_current_page ? 'active' : '' ?>">همه</a>
            </div>
            <h4>دسته بندی آموزش</h4>
            <?php
               $current_category_url = add_query_arg( $wp->query_vars );
              $taxonomy     = 'product_cat';
              $orderby      = 'name';
              $show_count   = 0;      // 1 for yes, 0 for no
              $pad_counts   = 0;      // 1 for yes, 0 for no
              $hierarchical = 1;      // 1 for yes, 0 for no
              $title        = '';
              $empty        = 0;

              $args = array(
                     'taxonomy'     => $taxonomy,
                     'orderby'      => $orderby,
                     'show_count'   => $show_count,
                     'pad_counts'   => $pad_counts,
                     'hierarchical' => $hierarchical,
                     'title_li'     => $title,
                     'hide_empty'   => $empty
              );

              $all_categories = get_categories( $args );

              echo "<ul class='sidebar-categories-wrapper'>";
              foreach ($all_categories as $cat) {
               if($cat->category_parent == 0) {
                  $category_id = $cat->term_id;
                  $is_current_page = strpos(get_term_link($cat->slug, 'product_cat'), $current_category_url);
                  ?>
                  <li>
                     <a class="<?php if($is_current_page !== false) {echo("current-category"); } ?>" href="<?= get_term_link($cat->slug, 'product_cat') ?>">
                        <?php if($is_current_page !== false): ?>
                           <img src="<?= get_template_directory_uri() . '/dist' ?>/src/images/parent_square_open.png">
                        <?php else: ?>
                           <img src="<?= get_template_directory_uri() . '/dist' ?>/src/images/child_square_empty.png">
                        <?php endif; ?>
                        <?= $cat->name ?>
                     </a>
                  </li>
                  <?php

                  $args2 = array(
                     'taxonomy'     => $taxonomy,
                     'child_of'     => 0,
                     'parent'       => $category_id,
                     'orderby'      => $orderby,
                     'show_count'   => $show_count,
                     'pad_counts'   => $pad_counts,
                     'hierarchical' => $hierarchical,
                     'title_li'     => $title,
                     'hide_empty'   => $empty
                  );

                  $sub_cats = get_categories( $args2 );

                  if($sub_cats) {
                     echo "<ul class='sidebar-categories-child-wrapper'>";
                     foreach($sub_cats as $sub_category) {
                     $is_current_page = strpos(get_term_link($sub_category->slug, 'product_cat'), $current_category_url);
                     ?>
                     <li>
                        <a class="<?php if($is_current_page !== false) {echo("current-category"); } ?>" href="<?= get_term_link($sub_category->slug, 'product_cat') ?>">
                           <?php if($is_current_page !== false): ?>
                              <img src="<?= get_template_directory_uri() . '/dist' ?>/src/images/child_square_open.png">
                           <?php else: ?>
                              <img src="<?= get_template_directory_uri() . '/dist' ?>/src/images/child_square_empty.png">
                           <?php endif; ?>
                           <?= $sub_category->name ?>
                        </a>
                     </li>
                     <?php
                     }
                     echo "</ul>";
                  }
               }
            }
            ?>
         </div>
      </div>

      <?php

      woocommerce_product_loop_start();

      if ( wc_get_loop_prop( 'total' ) ) {
         while ( have_posts() ) {
            the_post();

            /**
             * Hook: woocommerce_shop_loop.
             */
            do_action( 'woocommerce_shop_loop' );

            wc_get_template_part( 'content', 'product' );
         }
      }

      woocommerce_product_loop_end();

      echo("</div>");

      /**
       * Hook: woocommerce_after_shop_loop.
       *
       * @hooked woocommerce_pagination - 10
       */
      do_action( 'woocommerce_after_shop_loop' );
   } else {
      /**
       * Hook: woocommerce_no_products_found.
       *
       * @hooked wc_no_products_found - 10
       */
      do_action( 'woocommerce_no_products_found' );
   }

   /**
    * Hook: woocommerce_after_main_content.
    *
    * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
    */
   do_action( 'woocommerce_after_main_content' );

   ?>
</div>

<?php
get_footer();
