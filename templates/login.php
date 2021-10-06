<?php
/**
 * Template Name: Login
 */

get_header();
?>

<?php
if ( ! is_user_logged_in() ) {
   $args = array(
      'redirect' => admin_url(),
      'form_id' => 'loginform-custom',
      'label_username' => __( 'Username custom text' ),
      'label_password' => __( 'Password custom text' ),
      'label_remember' => __( 'Remember Me custom text' ),
      'label_log_in' => __( 'Log In custom text' ),
      'remember' => true
   );
   wp_login_form( $args );
} else {
   wp_loginout( home_url() );
   echo " | ";
   wp_register('', '');
}

?>






<div class="auth-container">
  <div class="auth-form">
    <div class="form-header">
      <h2>ورود به حساب کاربری</h2>
      <p class="text-3">
        اگر حساب کاربری ندارید روی
        <a class="primary-blue-text" href="./signup.html">ثبت نام</a>
        کلیک کنید.
      </p>
    </div>
    <form>
      <div class="form-field">
        <div class="form-input">
          <input class="email-input" type="email" name="email" id="email" placeholder=" " />
          <label class="email-label" id="email-label" for="email">ایمیل شما</label>

        </div>
      </div>
      <div class="form-field">
        <div class="form-input">
          <input class="password-input" type="password" name="password" id="password" placeholder=" " />
          <label class="password-label" id="password-label" for="password">کلمه عبور</label>
        </div>
        <div class="forgot-password">
          <a href="#" class="p-small text-3">فراموشی کلمه عبور</a>
        </div>
      </div>
      <button type="submit" class="btn btn-primary btn-large w-100 btn-shadow-normal">ورود</button>
      <button class="oauth-btn btn w-100 btn-large">
        <p class="text-3">ورود با اکانت گوگل</p>
        <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/google-oauth.svg" alt="">
      </button>
    </form>
  </div>
  <div class="sidebar-auth">
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide slide-box">
          <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/young-student-pic.png" alt="تضمین بازگشت وجه" />
          <h3 class="text-3">تضمین بازگشت وجه</h3>
        </div>
        <div class="swiper-slide slide-box">
          <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/thinking-woman-pic.png" alt="بی نهایت آموزش مهندسی های مختلف" />
          <h3 class="text-3">بی نهایت آموزش مهندسی های مختلف</h3>
        </div>
      </div>
    </div>
    <div class="swiper-pagination auth-pagination"></div>
  </div>
</div>
















<script type="module">
  import Swiper from 'https://unpkg.com/swiper/swiper-bundle.esm.browser.min.js'

  const swiper = new Swiper('.swiper-container', {
    direction: 'horizontal',
    loop: true,
    slidesPerView: 1,
    spaceBetween: 30,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    effect: 'fade',
    fadeEffect: {
      crossFade: true
    },
    autoplay: {
      delay: 3000,
    },
  });
</script>

<?php get_footer(); ?>
