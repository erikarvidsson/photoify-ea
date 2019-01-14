<?php

declare(strict_types=1);

if (!function_exists('redirect')) {
    /**
     * Redirect the user to given path.
     *
     * @param string $path
     *
     * @return void
     */
    function redirect(string $path)
    {
        header("Location: ${path}");
        exit;
    }
}

// select all imgs posted by usere
function selectUserPost($userId, object $pdo){
  $statement = $pdo->prepare('SELECT * FROM posts WHERE user_id = :user_id');
  // $statement = $pdo->prepare('SELECT * FROM users');
  if(!$statement){
    die(var_dump($pdo->errorInfo()));
  }

  $statement->bindParam(':user_id', $userId, PDO::PARAM_STR);
  $statement->execute();

  $imgs = $statement->fetchAll(PDO::FETCH_ASSOC);

return $imgs;
}




function selectUserProfile($userId, object $pdo){
  $statement = $pdo->prepare('SELECT * FROM users WHERE id = :user_id');
  // $statement = $pdo->prepare('SELECT * FROM users');
  if(!$statement){
    die(var_dump($pdo->errorInfo()));
  }

  $statement->bindParam(':user_id', $userId, PDO::PARAM_STR);
  $statement->execute();

  $profileInfo = $statement->fetch(PDO::FETCH_ASSOC);

return $profileInfo;
}
