<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

?>

<style type="text/css">
body {
   background: #fafafa !important;
}
.product-container {
   display: block !important;
}
.main {
   width: 100% !important;
}
.dashboard-container {
   display: flex;
   flex-direction: column;
}
.dashboard-widget {
   flex: 1;
   margin-bottom: 1em;
   background-color: #ffffff;
   border-radius: 3px;
   margin-bottom: 30px;
   width: 100%;
   padding: 20px 40px;
}
.dashboard-content a {
   color: blue;
}

.dashboard-content {
   padding: 5em 40px;
}
</style>

<div class="dashboard-container">
   <div class="dashboard-widget dashboard-top-side">
      <?php
      /**
       * My Account navigation.
       *
       * @since 2.6.0
       */
      do_action( 'woocommerce_account_navigation' );
      ?>
   </div>

   <div class="dashboard-widget dashboard-content">
      <?php
      /**
       * My Account content.
       *
       * @since 2.6.0
       */
      do_action( 'woocommerce_account_content' );
      ?>
   </div>
</div>
