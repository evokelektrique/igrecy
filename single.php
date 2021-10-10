<?php get_header(); ?>

<style type="text/css">
.container {
   display: flex;
   flex-direction: row;
   justify-content: center;
}
@media (max-width: 1024px) {
   .container {
      flex-direction: column;
   }
}

.main {
   flex: 2;
}
.sidebar {
   flex: 1;
   display: block !important;
}
.thumbnail {
   background: #FFFFFF;
   box-shadow: 32px 48px 56px rgba(141, 163, 185, 0.24);
   border-radius: 24px;
   padding: 16px;
   margin-bottom: 32px;
}
.thumbnail img {
   border-radius: 16px;
   width: 100%;
}
.sidebar-related-posts li {
   display: flex;
   flex-direction: row;
   margin-bottom: 10px;
}
.sidebar-widget {
   background: #FFFFFF;
   box-shadow: 0px 8px 24px rgba(141, 163, 185, 0.2);
   border-radius: 24px;
   padding: 13px 23px;
}
.sidebar-related-posts img {
   border-radius: 12px;
   width: 48px;
   height: 48px;
}
.sidebar-related-posts-content {
   flex: 2;
   display: flex;
   flex-direction: column;
   margin-right: 10px;
}
.sidebar-related-posts-content h6,
.content-widget h6 {
   font-style: normal;
   font-weight: bold;
   font-size: 16px;
   color: #212B36;
}
.sidebar-related-posts-content span {
   font-style: normal;
   font-weight: 500;
   font-size: 12px;
   color: #919EAB;
}
.sidebar-widget-title h3 {
   font-weight: bold;
   font-size: 18px;
   color: #212B36;
   padding: 24px 0px;
   border-bottom: 2px;
   border-bottom: 1px solid #DFE3E8;
}
.sidebar-related-posts,
.content-widget-wrapper {
   margin-top: 24px;
}
.content-widget {
   background: #FFFFFF;
   box-shadow: 32px 48px 56px rgba(141, 163, 185, 0.24);
   border-radius: 24px;
   padding: 23px;
   margin-bottom: 32px;
}
.content-widget h3 {
   font-weight: bold;
   font-size: 18px;
   color: #212B36;
   padding: 24px 0px;
   border-bottom: 2px;
   border-bottom: 1px solid #DFE3E8;
}

.author-wrapper {
   display: flex;
}
.author-wrapper img {
   border-radius: 50%;
   width: 48px;
   height: 48px;
}
.author-description {
   margin-right: 16px;
   display: flex;
   flex-direction: column;
}
.author-description b {
   font-weight: bold;
   font-size: 16px;
   color: #212B36;
}
.author-description p {
   font-size: 16px;
   color: #637381;
}

</style>

<div class="product-title-header" style="padding: 4em; padding-bottom: 1em;">
   <h2 class="product-title primary-dark-text"><?php the_title(); ?></h2>
   <?php
   if(function_exists('yoast_breadcrumb')) {
      yoast_breadcrumb('<div class="breadcrumb text-3">','</div>');
   }
   ?>
</div>
<div class="container">
   <div class="main">
      <div class="thumbnail">
         <img src="<?= get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
      </div>

      <div class="content-widget">
         <?php the_content(); ?>
      </div>

      <!-- Author -->
      <div class="content-widget">
         <h3>درباره نویسنده</h3>
         <div class="content-widget-wrapper">
            <div class="author-wrapper">
               <img src="<?= get_avatar_url( get_the_author_meta( 'ID' ) ); ?>">

               <div class="author-description">
                  <b><?php the_author() ?></b>
                  <p class="description">
                     <?php $author_id = get_the_author_meta( 'ID' ); ?>
                     <?php $author_description = get_the_author_meta('description', $author_id); ?>
                     <?php if(!empty($author_description)): ?>
                        <?= $author_description ?>
                     <?php else: ?>
                        توضیحات نویسنده
                     <?php endif; ?>
                  </p>
               </div>
            </div>
         </div>
      </div>


      <!-- Comments -->

      <div class="content-widget">
         <h3>نظرات کاربران</h3>
         <div class="content-widget-wrapper">
            <?php comments_template(); ?>
         </div>
      </div>

   </div>


   <!-- Sidebar -->
   <div class="sidebar">
      <?php
      $terms = get_the_terms( $post->ID, 'category' );

      // Change it if you want ?
      $related_count = 5;

      if ( empty( $terms ) ) $terms = array();

      $term_list = wp_list_pluck( $terms, 'slug' );

      $related_args = array(
         'post_type' => 'post',
         'posts_per_page' => $related_count,
         'post_status' => 'publish',
         'post__not_in' => array( $post->ID ),
         'orderby' => 'rand',
         'tax_query' => array(
            array(
               'taxonomy' => 'category',
               'field' => 'slug',
               'terms' => $term_list
            )
         )
      );
      $query = new WP_Query( $related_args );
      if($query->have_posts()):
      $posted = get_the_time('U');

      ?>
      <div class="sidebar-widget">
         <div class="sidebar-widget-title">
            <h3>مطالب مرتبط</h3>
         </div>
         <div class="sidebar-widget-content">
            <ul class="sidebar-related-posts">
               <?php while($query->have_posts()): $query->the_post(); ?>
               <li>
                  <img src="<?= get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" />
                  <div class="sidebar-related-posts-content">
                     <h6><?php the_title(); ?></h6>
                     <span><?= human_time_diff($posted,current_time( 'U' )) ?> پیش</span>
                  </div>
               </li>
               <?php endwhile; ?>
            </ul>
         </div>
      </div>
   <?php wp_reset_postdata(); ?>
   <?php endif ?>

   </div>
</div>
<?php get_footer(); ?>
