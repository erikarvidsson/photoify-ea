<?php
require __DIR__.'/../autoload.php';

if(!if_user_loggedin()){
  redirect('/');
}

if (isset($_POST['comment'])){
      $id = $_SESSION['user']['id'];
      $date = date("Y-m-d, g:i a");
      $comment = trim(filter_var($_POST['comment'], FILTER_SANITIZE_STRING));
      $postId = filter_var($_GET['post_id'], FILTER_SANITIZE_NUMBER_INT);

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

      redirect('/comments.php?post_id='.$postId);

      };

  ?>
