<?php get_template_part( 'templates/footer' ); ?>
<?php wp_footer(); ?>
<script>
   const backDrop = document.querySelector('.backdrop-container');
   backDrop.addEventListener('click', () => {
      backDrop.classList.toggle('backdrop-active')
      navbarWrapper.classList.toggle('mobile-nav-wrapper-active')
   })
   const mobileNavbar = document.querySelector('.mobile-nav');
   const navbarWrapper = document.querySelector('.mobile-nav-wrapper');
   mobileNavbar.addEventListener('click', () => {
      navbarWrapper.classList.toggle('mobile-nav-wrapper-active')
      backDrop.classList.toggle('backdrop-active')
   })
</script>
<script type="module">
   import Swiper from 'https://unpkg.com/swiper/swiper-bundle.esm.browser.min.js'
   const swiper = new Swiper('.swiper-container', {
      direction: 'horizontal',
      loop: true,
      loopFillGroupWithBlank: true,
      slidesPerView: 3,
      spaceBetween: 24,
      slidesPerGroup: 3,
      pagination: {
         el: '.swiper-pagination',
         clickable: true,
      },
      navigation: {
         nextEl: '.swiper-button-next',
         prevEl: '.swiper-button-prev',
      },
      autoplay: {
         delay: 5000,
      },
      breakpoints: {
         1024: {
            slidesPerView: 3,
            spaceBetween: 24,
            slidesPerGroup: 3,
         },
         768: {
            slidesPerView: 2,
            spaceBetween: 18,
            slidesPerGroup: 2,
         },
         370: {
            slidesPerView: 1,
            spaceBetween: 20,
            slidesPerGroup: 1,
         },
      },
   })
</script>
</body>
</html>

