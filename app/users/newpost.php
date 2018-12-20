<?php
require __DIR__.'/../autoload.php';

    // $pdo = new PDO('sqlite:photoify.db');

if (isset($_FILES['img'])){
      $usertext = filter_var($_POST['post_text'], FILTER_SANITIZE_STRING);
      $date = date("Y-m-d, H:i");
      $id = $_SESSION['user']['id'];
      $name = $_SESSION['user']['name'];
      $folder = $id;
      $img = $_FILES['img'];
      $imgname = $img['name'];
      $imgsave = $id.'_'.$date.$imgname;
      $usertext = $_POST['post_text'];


      if (!is_dir(__DIR__."/../post_img/img/")) {
        mkdir(__DIR__."/../post_img/img");
      };

      $path = __DIR__.'/../post_img/img/';

      if (file_exists($path.$img['name'])) {
        redirect('/app/users/newpost.php');
        die;
      }

      $statement = $pdo->prepare('INSERT INTO posts(img, post_date, post_text, user_id, user_name)
      VALUES(:img, :post_date, :post_text, :user_id, :user_name)');

      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':post_text', $usertext, PDO::PARAM_STR);
      $statement->bindParam(':user_name', $name, PDO::PARAM_STR);
      $statement->bindParam(':img', $imgsave  , PDO::PARAM_STR);
      $statement->bindParam(':post_date', $date, PDO::PARAM_STR);
      $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
      print_r($statement);
      $statement->execute();

      $oldpath = $img['tmp_name'];
      $newpath = $path.$imgsave;
      move_uploaded_file($oldpath, $newpath);

      redirect('/../../posts.php');
      }else{
        echo "Sorry, file already exists.";
      };
  ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style/sanitize.css">
    <title></title>
  </head>
  <body>
    <form class="" action="newpost.php" method="post" enctype="multipart/form-data">
      <input type="file" name="img">
      <textarea name="post_text" placeholder="Write something..."></textarea>
      <button type="submit" name="button"> knapp</button>
    </form>

  </body>
</html>
