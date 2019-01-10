<?php
require __DIR__.'/../autoload.php';

if (isset($_POST['post_id'], $_POST['action'])) {
    $action = $_POST['action'];
    $postId = $_POST['post_id'];
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




  // if (isset($_SESSION['user']['id'])){
  //   $id = $_SESSION['user']['id'];
  //
  //   $statement = $pdo->prepare('SELECT * FROM likes');
  //   if(!$statement){
  //     die(var_dump($pdo->errorInfo()));
  //   }
  //
  //   $statement->execute();
  //
  //   $likes = $statement->fetchAll(PDO::FETCH_ASSOC);
  //
  //
  //   foreach ($likes as $like) {
  //     if($like['user_id'] === $id){
  //       echo 'like'.'<br>';
  //     }else{
  //       echo 'dislike'.'<br>';
  //     }
  //   }
  //
  // }
