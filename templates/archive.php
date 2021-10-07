<?php
/**
 * Template Name: Archive
 */

get_header();
?>

<div class="blog-list-container container">
  <div class="blog-header">
    <h2>بلاگ ایگرگ</h2>
    <div class="breadcrumb text-3">
      <a class="text-3" href="#">خانه</a>
      <img src="./src/images/breadcrumb-arrow.svg" alt="" />
      <a class="text-3" href="#">بلاگ</a>
    </div>
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
      <form>
        <input type="text" placeholder="دنبال چه میگردی..." name="search" />
        <img src="./src/images/blog-search.svg" alt="" />
      </form>
    </div>
  </div>
  <div class="blog-posts-container">
    <div class="blog-cart-box bordered">
      <div class="blog-thumbnail">
        <img src="./src/images/thumbnail.jpg" alt="" />
        <p class="p-small blog-category">بازاریابی</p>
      </div>
      <div class="blog-cart-content">
        <div class="blog-extra-details">
          <div class="read-time">
            <img src="./src/images/timer.svg" alt="">
            <p class="p-small">2 دقیقه</p>
          </div>
          <div class="post-likes">
            <img src="./src/images/like.svg" alt="">
            <p class="p-small">۱۶</p>
          </div>
        </div>
        <h5 class="blog-cart-title">
          بهترین منبع آموزش زبان کجاست؟
        </h5>
        <p class="text-3 blog-cart-except">
          چگونه تبلیغات هدفمند در اینستاگرام انجام دهیم شناخت فرصت‌های کسب درآمد چگونه تبلیغات هدفمند در اینستاگرام انجام دهیم شناخت
        </p>
        <a class="primary-blue-text" href="#">ادامه مطلب</a>
      </div>
    </div>
  </div>
  <div class="pagination">
    <a href="#" class="prev-arrow">
      <img src="./src/images/slide-change-arrow.svg" alt="">
    </a>
    <a href="#">
      ۱
    </a>
    <a class="pagination-active" href="#">۲</a>
    <a href="#">
      ۳
    </a>
    <p>...</p>
    <a href="#">۱۲</a>
    <a href="#" class="next-arrow">
      <img src="./src/images/slide-change-arrow.svg" alt="">
    </a>
  </div>
</div>

<?php get_footer(); ?>
