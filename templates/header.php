<header class="nav shadow-normal w-100">
   <!-- Mobile Menu -->
   <div class="mobile-nav-wrapper">
      <ul class="nav-list-mobile">
         <a class="nav-list-simple" href="#"><li>خانه</li></a>
         <div class="dropdown-nav-list">
            <div class="list-item-header">
               <li>آموزش ها</li>
               <img src="<?= get_template_directory_uri() . "/dist/src" ?>/images/arrow-down-blue.svg" alt="" />
            </div>
            <ul class="dropdown-list-items shadow-normal bordered">
               <a href="#"><li class="dropdown-list-item">تست اول</li></a>
               <a href="#"><li class="dropdown-list-item">تست اول</li></a>
               <a href="#"><li class="dropdown-list-item">تست اول</li></a>
            </ul>
         </div>
         <a class="nav-list-simple" href="#"><li>مقالات</li></a>
      </ul>
   </div>
   <div class="backdrop-container"></div>

   <div class="container wrapper">
      <div class="col">
         <img class="mobile-nav" src="<?= get_template_directory_uri() . "/dist/src" ?>/images/mobile-nav.svg" alt="" />
         <img class="nav-logo" src="<?= get_template_directory_uri() . "/dist/src" ?>/images/logo.svg" alt="Igrecy" />

         <!-- Desktop Menu -->

         <ul class="nav-list">
            <?php
            wp_nav_menu(array(
               'menu'    => 'main-menu',
               // 'walker'  => new CustomWalker(),
               'container' => '',
               'items_wrap' => '%3$s'
            ));
             ?>
         </ul>

      </div>
      <div class="col">
         <a href="#" class="btn btn-secondary btn-small">ورود / ثبت نام</a>
      </div>
   </div>
</header>
