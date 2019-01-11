<?php
require __DIR__.'/views/header.php';
?>


<?php
  if(isset($_SESSION['user'])){
    redirect('/posts.php');
  }else{
    redirect('/login.php');
  }
?>
<?php

require __DIR__.'/views/nav.php';
require __DIR__.'/views/footer.php'; ?>
