<?php
require __DIR__.'/../autoload.php';

if(!if_user_loggedin()){
  redirect('/');
}

if (isset($_POST['post_id'], $_POST['action'])) {
  $action = trim(filter_var($_POST['action'], FILTER_SANITIZE_STRING));
  $postId = filter_var($_POST['post_id'], FILTER_SANITIZE_NUMBER_INT);
  $userId = $_SESSION['user']['id'];

  if ($action === 'disliked') {

    $statement = $pdo->query("DELETE FROM likes WHERE post_id = '$postId' AND like_user_id = '$userId';");

    if (!$statement) {

      die(var_dump($pdo->errorInfo()));

    }
  }elseif ($action === 'liked') {

    $statement = $pdo->prepare('INSERT INTO likes (like_user_id,post_id) VALUES (:user_id,:post_id);');

    if (!$statement) {

      die(var_dump($pdo->errorInfo()));

    }

    $statement->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
    $statement->execute();
  }

  $statement = $pdo->query("SELECT COUNT(*) AS likes FROM likes WHERE post_id = '$postId';");

  if (!$statement) {

    die(var_dump($pdo->errorInfo()));

  }

  $likes = $statement->fetch(PDO::FETCH_ASSOC);
  $likes = json_encode($likes);
  header('Content-Type: application/json');
  echo $likes;
}else {
  exit();
}
