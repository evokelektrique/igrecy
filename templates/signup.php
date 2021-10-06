<?php
/**
 * Template Name: SignUp
 */

get_header();

global $current_user;
get_currentuserinfo();

$fullname = $_POST['fullname'];
$phone    = $_POST['phone'];
$email    = $_POST['email'];
$password = $_POST['password'];

// Default
$status = 0;

if ($fullname != '' && $email != '' && $password != '' && $phone != '') {
   $user_id = wp_create_user($fullname, $password, $email);

   if (!$user_id || is_wp_error($user_id)) {
      // Error in registration
      $status = 1;
   }

   if(!username_exists( $fullname )  && !email_exists( $email )) {
      $userinfo = array(
         'ID'   => $user_id,
         'role' => 'none'
      );

      wp_update_user($userinfo);

      update_user_meta($user_id, 'phone', $phone);
      update_user_meta($user_id, 'fullname', $fullname);
      update_user_meta($user_id, 'email', $email);

      // Successfull Registration
      $status = 3;
   } else {

      // Email and Username Exists
      $status = 2;
   }
}
?>

<div class="auth-container">
  <div class="auth-form">
    <div class="form-header">
      <h2>ثبت نام</h2>

      <?php if($status === 1): ?>
         <p class="text-3" style="color: red">مشکلی در ثبت نام رخ داد</p>
      <?php elseif($status === 2): ?>
         <p class="text-3" style="color: red">نام کاربری یا ایمیل مورد نظر قبلا ثبت شده است</p>
      <?php elseif($status === 3): ?>
         <p class="text-3" style="color: green">ثبت نام با موفقیت انجام شد</p>
      <?php endif; ?>

      <?php if(!is_user_logged_in() && $status === 0): ?>
         <p class="text-3">
           ثبت نام شما به منزله قبول
           <a class="primary-blue-text" href="#">قوانین</a>
           سایت ایگرگ خواهد بود
         </p>
      <?php endif; ?>
    </div>

<?php if (is_user_logged_in()) : ?>

   <p class="text-3">
      شما وارد اکانت خود شده اید و نیاز به ثبت نام ندارید.
   </p>

<?php else: ?>

   <!-- Form -->
   <form action="<?= $_SERVER['REQUEST_URI'] ?>" method="post">

      <!-- FullName -->
      <div class="form-field">
         <div class="form-input">
            <input class="name-input" type="text" name="fullname" id="fullname" placeholder=" " value="<?= esc_attr($fullname) ?>" />
            <label class="name-label" id="name-label" for="fullname">نام شما</label>
         </div>
      </div>

      <!-- Email -->
      <div class="form-field">
         <div class="form-input">
            <input class="email-input" type="email" name="email" id="email" placeholder=" " value="<?= $email ?>"/>
            <label class="email-label" name="email" id="email-label" for="email">ایمیل شما</label>
         </div>
      </div>

      <!-- Phone -->
      <div class="form-field">
         <div class="form-input">
            <input class="phone-input" type="number" name="phone" id="phone" placeholder=" " value="<?= $phone ?>" />
            <label class="number-label" for="number" id="phone-label">شماره همراه</label>
         </div>
      </div>
      <div class="form-field">
         <div class="form-input">
            <input class="password-input" type="password" name="password" id="password" placeholder=" " />
            <label class="password-label" id="password-label" for="password">کلمه عبور</label>
         </div>
      </div>
      <button type="submit" class="btn btn-primary btn-large w-100 btn-shadow-normal">ثبت نام</button>
      <button class="oauth-btn btn w-100 btn-large">
         <p class="text-3">ثبت نام با اکانت گوگل</p>
         <img src="<?= get_template_directory_uri() . "/dist" ?>/src/images/google-oauth.svg" alt="">
      </button>
   </form>
<?php endif; ?>

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
