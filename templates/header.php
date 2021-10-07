<header class="nav shadow-normal w-100">
   <!-- Mobile Menu -->
   <div class="mobile-nav-wrapper">

      <ul class="nav-list-mobile">
         <?php
         wp_nav_menu(array(
            'menu'    => 'main-menu',
            'container' => '',
            'items_wrap' => '%3$s'
         ));
         ?>
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
               'container' => '',
               'items_wrap' => '%3$s'
            ));
            ?>
         </ul>

      </div>
      <div class="col">
         <a href="<?= home_url('/signin'); ?>" class="btn btn-secondary btn-small">ورود / ثبت نام</a>
      </div>
   </div>
</header>
