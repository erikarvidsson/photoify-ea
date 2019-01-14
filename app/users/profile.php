<?php

declare(strict_types=1);

$userId = $_SESSION['user']['id'];

$profileInfo = selectUserProfile($userId, $pdo);

$imgs = selectUserPost($userId, $pdo);




  ?>
