<?php require __DIR__.'/views/header.php';
?>


<?php
  if(isset($_SESSION['user'])){
    echo 'Welcome, '.$_SESSION['user']['name'].'!';
    echo 'Welcome, '.$_SESSION['user']['email'].'!';
  }else{
    echo 'You are out';
  }
?>
<?php

require __DIR__.'/views/footer.php'; ?>
