<?php
if(isset($_GET['search-type'])) {
   $type = $_GET['search-type'];
   if($type == 'posts') {
      load_template(TEMPLATEPATH . '/home.php');
   }
} else {
   // load_template(TEMPLATEPATH . '/index.php');
}
