<?php
require __DIR__.'/../autoload.php';

    // $pdo = new PDO('sqlite:photoify.db');
    echo $_SESSION['user']['id'];

if (isset($_POST['comment'])){
      $id = $_SESSION['user']['id'];
      $date = date("Y-m-d, g:i a");
      $commenttext = $_POST['comment'];

      $statement = $pdo->prepare('INSERT INTO comments(user_id, comment, comment_date)
      VALUES(:user_id, :comment, :comment_date)');

      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
      // $statement->bindParam(':post_id', $lastname, PDO::PARAM_STR);
      $statement->bindParam(':comment', $commenttext, PDO::PARAM_STR);
      $statement->bindParam(':comment_date', $date, PDO::PARAM_STR);
      $statement->execute();

      // redirect('/');

      } else {
        echo 'nej :(';
};



      // $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
      // $statement->bindParam(':email', $email, PDO::PARAM_STR);
      // $statement->execute();
      //
      //
      // $users = $statement->fetch(PDO::FETCH_ASSOC);
      //
      // print_r($users);
      //
      // $emailDb = $users['email'];
      // $passwordDb = $users['password'];
      //
      //     if($emailDb === $email && password_verify($password, $passwordDb)){
      //       echo 'yes :)';
      //

      // }
      //
      //     $id = $users['id'];
      //     $folder = $id;
      //
      //     if (!is_dir(__DIR__."/../post_img/$folder/profile_img")) {
      //       mkdir(__DIR__."/../post_img/$folder/profile_img");
      //     };
      //
      //     $path = __DIR__.'/../post_img/'.$folder.'/profile_img';
      //
      //     print_r($_FILES);
      //
      //     // if (file_exists($path.$_FILES['name'])) {
      //     //   die;
      //     // }
      //
      //     $oldpath = $_FILES['tmp_name'];
      //     $newpath = $path.$_FILES['name'];
      //     move_uploaded_file($oldpath, $newpath);


  ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style/sanitize.css">
    <title></title>
  </head>
  <body>
    <form class="" action="comment.php" method="post" enctype="multipart/form-data">
      <input name="comment" placeholder="text here"></input>
      <button type="submit" name="button"> knapp</button>
    </form>

  </body>
</html>
