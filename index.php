<?php require __DIR__.'/views/header.php';
?>


<?php
  if(isset($_SESSION['user'])){
    echo 'Welcome, '.$_SESSION['user']['first_name'].'!';
    echo 'Welcome, '.$_SESSION['user']['email'].'!';
    echo 'Welcome, '.$_SESSION['user']['id'].'!';
  }else{
    echo 'You are out';
  }
?>
<?php

require __DIR__.'/views/footer.php'; ?>
