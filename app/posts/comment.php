<?php
if(!if_user_loggedin()){
  redirect('/');
}


$postId = $_GET['post_id'];

$statement = $pdo->prepare('SELECT img FROM posts WHERE p_id = :id');

  if(!$statement){
    die(var_dump($pdo->errorInfo()));
  }

  $statement->bindParam(':id', $postId, PDO::PARAM_STR);
  $statement->execute();

  $postImg = $statement->fetch(PDO::FETCH_ASSOC);

if (isset($_POST['comment'])){
      $id = $_SESSION['user']['id'];
      $date = date("Y-m-d, g:i a");
      $comment = $_POST['comment'];
      $postId = $_GET['post_id'];

      // echo $postId.'<br>';
      // echo $date.'<br>';
      // echo $comment.'<br>';
      // die(var_dump($id));

      $statement = $pdo->prepare('INSERT INTO comments(user_id, post_id, comment, comment_date)
      VALUES(:user_id, :post_id, :comment, :comment_date)');

      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
      $statement->bindParam(':post_id', $postId, PDO::PARAM_STR);
      $statement->bindParam(':comment', $comment, PDO::PARAM_STR);
      $statement->bindParam(':comment_date', $date, PDO::PARAM_STR);
      $statement->execute();

      // redirect('/');

      };

      $statement = $pdo->prepare('SELECT * FROM comments WHERE post_id = :post_id');
      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

        $statement->bindParam(':post_id', $_GET['post_id'], PDO::PARAM_INT);
        $statement->execute();
        $comments = $statement->fetchAll(PDO::FETCH_ASSOC);
  ?>
