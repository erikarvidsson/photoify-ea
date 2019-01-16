<?php
require __DIR__.'/views/header.php';

  if(isset($_SESSION['user'])){
    redirect('/posts.php');
  }else{
    redirect('/login.php');
  }

require __DIR__.'/views/nav.php';
require __DIR__.'/views/footer.php'; ?>
