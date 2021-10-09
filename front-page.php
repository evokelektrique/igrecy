<?php get_header(); ?>

<div class="main-header-container">
   <div class="wrapper container">
      <div class="content-header-container">
         <div class="content-header">
            <h5 class="primary-blue-text">پلتفرم اموزش آنلاین ایگرگ</h5>
            <h1>چی دوست داری یاد بگیری</h1>
            <p class="text-3">لورم ایپسوم یا طرح‌نما (به انگلیس\ عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید،</p>
         </div>
         <form class="shadow-normal search-category-container" name="myform" method="GET" action="<?php echo esc_url(home_url('/')); ?>">

               <?php if (class_exists('WooCommerce')) : ?>
               <?php
               if(isset($_REQUEST['product_cat']) && !empty($_REQUEST['product_cat']))
               {
                  $optsetlect=$_REQUEST['product_cat'];
               }
               else{
                  $optsetlect=0;
               }
               $args = array(
                  'show_option_all' => esc_html__( 'دسته بندیت رو انتخاب کن', 'ig' ),
                  'hierarchical' => 1,
                  'class' => 'cat',
                  'echo' => 1,
                  'value_field' => 'slug',
                  'selected' => $optsetlect
               );
               $args['taxonomy'] = 'product_cat';
               $args['name'] = 'product_cat';
               $args['class'] = 'cate-dropdown hidden-xs';
               ?>
               <input type="hidden" value="product" name="post_type">
               <?php endif; ?>
               <input type="text" name="s" class="searchbox" maxlength="128" value="<?php echo get_search_query(); ?>" placeholder="رشته، نرم افزار، یا...">
               <?php wp_dropdown_categories($args); ?>
               <button type="submit" class="btn btn-primary btn-normal btn-shadow-normal">
                  <p>جستجو</p>
                  <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/search-header-white.svg" alt="">
               </button>
            </form>
      </div>
      <img class="header-pic" src="<?= get_template_directory_uri() . "/dist/src" ?>/images/header-pic.png" alt="" />
   </div>
</div>
<div class="categories-container container">
   <h2>مسیرهای یادگیری</h2>
   <div class="categories-list">
      <a href="#" class="category-box-container">
         <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/mechanic.svg" alt="مهندسی مکانیک" />
         <h5>مهندسی مکانیک</h5>
         <p class="text-3">دروس مهندسی مکانیک</p>
      </a>
      <a href="#" class="category-box-container">
         <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/architecture.svg" alt="مهندسی معماری" />
         <h5>مهندسی معماری</h5>
         <p class="text-3">دروس مهندسی معماری</p>
      </a>
      <a href="#" class="category-box-container">
         <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/construction.svg" alt="مهندسی عمران" />
         <h5>مهندسی عمران</h5>
         <p class="text-3">دروس مهندسی عمران</p>
      </a>
      <a href="#" class="category-box-container">
         <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/computer-science.svg" alt="مهندسی کامپیوتر" />
         <h5>مهندسی کامپیوتر</h5>
         <p class="text-3">دروس مهندسی کامپیوتر</p>
      </a>
      <a href="#" class="category-box-container">
         <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/medical.svg" alt="مهندسی پزشکی" />
         <h5>مهندسی پزشکی</h5>
         <p class="text-3">دروس مهندسی پزشکی</p>
      </a>
      <a href="#" class="category-box-container">
         <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/chemistry.svg" alt="مهندسی شیمی" />
         <h5>مهندسی شیمی</h5>
         <p class="text-3">دروس مهندسی شیمی</p>
      </a>
      <a href="#" class="category-box-container">
         <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/electricity.svg" alt="مهندسی برق" />
         <h5>مهندسی برق</h5>
         <p class="text-3">دروس مهندسی برق</p>
      </a>
      <a href="#" class="category-box-container">
         <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/industry.svg" alt="مهندسی صنایع" />
         <h5>مهندسی صنایع</h5>
         <p class="text-3">دروس مهندسی صنایع</p>
      </a>
   </div>
</div>
<div class="products-slider-container container">
   <div class="header-slider-container">
      <h2 class="highlight yello-highlight">جدید ترین آموزش ها</h2>
      <a class="primary-blue-text" href="<?= get_permalink( wc_get_page_id( 'shop' ) ); ?>">مشاهده همه</a>
   </div>
   <div class="products-slider">
      <div class="swiper-container">
         <div class="swiper-wrapper products-slider-wrapper">
            <?php
            $args = array(
               'post_type'      => 'product',
               'posts_per_page' => 5,
               'order'          => 'DESC'
            );

            $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post();
               global $product;
               $rating  = intval($product->get_average_rating());
               $terms = get_the_terms( $product->get_id(), 'product_cat' );
            ?>
            <div class="swiper-slide">
               <div class="course-box-container shadow-normal">
                  <img class="thumbnail" src="<?= get_the_post_thumbnail_url(); ?>" alt="<?php the_time(); ?>" />
                  <a href="<?= get_the_permalink(); ?>">
                     <h5><?php the_title(); ?></h5>
                  </a>
                  <div class="extra-course-details">
                     <p class="label course-category"><?= $terms[0]->name ?></p>
                     <div class="course-rating">
                        <?php for ($i=0; $i < 6; $i++) {
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
            </div>
            <?php
            endwhile;
            wp_reset_query();
            ?>
         </div>
         <div class="swiper-pagination products-slider-pagination"></div>
      </div>
      <div class="swiper-button-prev slide-change-btn prev-arrow"></div>
      <div class="swiper-button-next slide-change-btn next-arrow"></div>
   </div>
</div>
<div class="products-slider-container container">
   <div class="header-slider-container">
      <h2 class="highlight pink-highlight">پرفروش ترین آموزش ها</h2>
      <a class="primary-blue-text" href="#">مشاهده همه</a>
   </div>
   <div class="products-slider">
      <div class="swiper-container">
         <div class="swiper-wrapper products-slider-wrapper">
            <?php
            $args = array(
               'post_type'      => 'product',
               'meta_key'       => 'total_sales',
               'orderby'        => 'meta_value_num',
               'posts_per_page' => 5,
               'order'          => 'DESC'
            );

            $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post();
               global $product;
               $rating  = intval($product->get_average_rating());
               $terms = get_the_terms( $product->get_id(), 'product_cat' );
            ?>
            <div class="swiper-slide">
               <div class="course-box-container shadow-normal">
                  <img class="thumbnail" src="<?= get_the_post_thumbnail_url(); ?>" alt="<?php the_time(); ?>" />
                  <a href="<?= get_the_permalink(); ?>">
                     <h5><?php the_title(); ?></h5>
                  </a>
                  <div class="extra-course-details">
                     <p class="label course-category"><?= $terms[0]->name ?></p>
                     <div class="course-rating">
                        <?php for ($i=0; $i < 6; $i++) {
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
            </div>
            <?php
            endwhile;
            wp_reset_query();
            ?>
         </div>
         <div class="swiper-pagination products-slider-pagination"></div>
      </div>
      <div class="swiper-button-prev slide-change-btn prev-arrow"></div>
      <div class="swiper-button-next slide-change-btn next-arrow"></div>
   </div>
</div>
<div class="why-us container">
   <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/thinking-woman-pic.png" alt="چرا آموزش های ایگرگ" />
   <div class="why-us-content">
      <div class="why-us-header">
         <h2>چرا آموزش های ایگرگ</h2>
      </div>
      <div class="benefits-content">
         <div class="benefit-box">
            <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/best.svg" alt="" />
            <div class="benefit-content">
               <h5>بهترین اساتید و مدرسان</h5>
               <p class="text-3">چگونه تبلیغات هدفمند در اینستاگرام انجام دهیم شناخت فرصت‌های کسب درآمد آنلاین + اصول راه‌</p>
            </div>
         </div>
         <div class="benefit-box">
            <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/updated.svg" alt="" />
            <div class="benefit-content">
               <h5>آموزش های بروز</h5>
               <p class="text-3">چگونه تبلیغات هدفمند در اینستاگرام انجام دهیم شناخت فرصت‌های کسب درآمد آنلاین + اصول راه‌</p>
            </div>
         </div>
         <div class="benefit-box">
            <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/support.svg" alt="" />
            <div class="benefit-content">
               <h5>پشتیبانی 24 ساعته</h5>
               <p class="text-3">چگونه تبلیغات هدفمند در اینستاگرام انجام دهیم شناخت فرصت‌های کسب درآمد آنلاین + اصول راه‌</p>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="products-slider-container container">
   <div class="header-slider-container">
      <h2 class="left-highlight yello-highlight">آموزش زبان تخصصی</h2>
      <a class="primary-blue-text" href="#">مشاهده همه</a>
   </div>
   <div class="products-slider">
      <div class="swiper-container">
         <div class="swiper-wrapper products-slider-wrapper">
            <?php
            $args = array(
               'post_type'      => 'product',
               'posts_per_page' => 5,
               'order'          => 'DESC',
               'tax_query' => array(
                  array(
                     'taxonomy'      => 'product_cat',
                     'field'         => 'term_id',
                     'terms'         => 23,
                     'operator'      => 'IN'
                  ),
               )
            );

            $loop = new WP_Query( $args );

            while ( $loop->have_posts() ) : $loop->the_post();
               global $product;
               $rating  = intval($product->get_average_rating());
               $terms = get_the_terms( $product->get_id(), 'product_cat' );
            ?>
            <div class="swiper-slide">
               <div class="course-box-container shadow-normal">
                  <img class="thumbnail" src="<?= get_the_post_thumbnail_url(); ?>" alt="<?php the_time(); ?>" />
                  <a href="<?= get_the_permalink(); ?>">
                     <h5><?php the_title(); ?></h5>
                  </a>
                  <div class="extra-course-details">
                     <p class="label course-category"><?= $terms[0]->name ?></p>
                     <div class="course-rating">
                        <?php for ($i=0; $i < 6; $i++) {
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
            </div>
            <?php
            endwhile;
            wp_reset_query();
            ?>
         </div>
         <div class="swiper-pagination products-slider-pagination"></div>
      </div>
      <div class="swiper-button-prev slide-change-btn prev-arrow"></div>
      <div class="swiper-button-next slide-change-btn next-arrow"></div>
   </div>
</div>
<div class="why-us container">
   <div class="why-us-content">
      <div class="why-us-header">
         <h2>به فکر مهاجرت هستی</h2>
         <p class="text-3">در ایگرگ خدمات مهاجرت و اپلای، آموزش زبان و.. ارائه میشود</p>
      </div>
      <div class="benefits-content">
         <div class="benefit-box">
            <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/immigration-world.svg" alt="" />
            <div class="benefit-content">
               <h5>مشاوره دریافت اپلای</h5>
               <p class="text-3">چگونه تبلیغات هدفمند در اینستاگرام انجام دهیم شناخت فرصت‌های کسب درآمد آنلاین + اصول راه‌</p>
            </div>
         </div>
         <div class="benefit-box">
            <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/immigration-lang.svg" alt="" />
            <div class="benefit-content">
               <h5>آموزش های بروز</h5>
               <p class="text-3">چگونه تبلیغات هدفمند در اینستاگرام انجام دهیم شناخت فرصت‌های کسب درآمد آنلاین + اصول راه‌</p>
            </div>
         </div>
      </div>
   </div>
   <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/immigration-pic.png" alt="مهاجرت با ایگرگ" />
</div>
<div class="our-blog-container">
   <div class="container our-blog-wrapper">
      <div class="our-blog-header">
         <div class="our-blog-head-content">
            <h2>بلاگ ما</h2>
            <p class="text-3">چگونه تبلیغات هدفمند در اینستاگرام انجام دهیم</p>
         </div>
         <a class="btn btn-primary btn-shadow-normal btn-large" href="<?= get_permalink( get_option( 'page_for_posts' ) ); ?>">ورود به وبلاگ</a>
      </div>
      <div class="blogs-slider">
         <div class="swiper-container">
            <div class="swiper-wrapper products-slider-wrapper">
               <?php
               $args = array(
                  'posts_per_page' => 5,
                  'order'          => 'DESC',
               );

               $loop = new WP_Query( $args );

               while ( $loop->have_posts() ) : $loop->the_post();
                  global $post;
                  $terms = get_the_terms( get_the_ID(), 'category' );
               ?>
               <div class="swiper-slide">
                  <div class="blog-cart-box shadow-normal">
                     <div class="blog-thumbnail">
                        <img src="<?= get_the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>" />
                        <p class="p-small blog-category"><?= $terms[0]->name ?></p>
                     </div>
                     <div class="blog-cart-content">
                        <h5 class="blog-cart-title">
                           <?php the_title(); ?>
                        </h5>
                        <p class="text-3 blog-cart-except">
                           <?php the_excerpt() ?>
                        </p>
                        <a class="primary-blue-text" href="<?= get_the_permalink(); ?>">ادامه مطلب</a>
                     </div>
                  </div>
               </div>
               <?php
               endwhile;
               wp_reset_query();
               ?>
            </div>
         </div>
         <div class="swiper-button-prev slide-change-btn prev-arrow"></div>
         <div class="swiper-button-next slide-change-btn next-arrow"></div>
      </div>
   </div>
</div>
<div class="student-comments-container container">
   <div class="student-comments-header">
      <h2>نظرات دانشجویان</h2>
      <p class="text-3">نظر دیگر دانشجویان درباره آموزش های ایگرگ</p>
   </div>
   <div class="products-slider">
      <div class="swiper-container">
         <div class="swiper-wrapper products-slider-wrapper">
            <?php
            $comments = carbon_get_theme_option('students_comments');
            foreach($comments as $comment):
            ?>
            <div class="swiper-slide">
               <div class="comment-box shadow-normal">
                  <p class="comment text-3"><?= $comment['description'] ?></p>
                  <div class="comment-user-profile">
                     <img src="<?= $comment['img_url'] ?>" alt="<?= $comment['name'] ?>">
                     <div class="comment-user-details">
                        <h5><?= $comment['name'] ?></h5>
                        <p class="p-small primary-blue-text">
                           <?= $comment['role'] ?>
                        </p>
                     </div>
                  </div>
               </div>
            </div>
            <?php endforeach; ?>

         </div>
         <div class="swiper-pagination products-slider-pagination"></div>
      </div>
   </div>
</div>
<div class="container">
   <div class="join-us-container">
      <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/teacher-pic.png" alt="در ایگرگ مدرس شوید" />
      <div class="join-us-content">
         <h2>در ایگرگ مدرس شوید</h2>
         <p class="text-3">در ایگرگ خدمات کهاجرت و اپلای، آموزش زبان و ... ارائه میشوددر ایگرگ خدمات کهاجرت و اپلای، آموزش زبان و ... ارائه میشوددر ایگرگ خدمات کهاجرت و اپلای، آموزش زبان و ... ارائه میشود
         </p>
         <div class="btn-group">
            <a href="#" class="btn btn-primary btn-large btn-shadow-normal">
               میخواهم مدرس شوم
            </a>
            <a class="more-info primary-blue-text" href="#">اطلاعات بیشتر</a>
         </div>
      </div>
   </div>
</div>

<?php get_footer(); ?>
