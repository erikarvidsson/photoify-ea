<?php

declare(strict_types=1);

if(!if_user_loggedin()){
  redirect('/');
}
$userId = $_SESSION['user']['id'];

$profileInfo = selectUserProfile($userId, $pdo);

$imgs = selectUserPost($userId, $pdo);




  ?>
