<?php
require __DIR__.'/../autoload.php';

    // $pdo = new PDO('sqlite:photoify.db');

if (isset($_FILES['img'])){

      $usertext = filter_var($_POST['post_text'], FILTER_SANITIZE_STRING);
      $date = date("Y-m-d, H:i:s");
      $id = $_SESSION['user']['id'];
      $name = $_SESSION['user']['name'];
      $folder = $id.'_'.$name;
      $img = $_FILES['img'];
      $usertext = $_POST['post_text'];

      $statement = $pdo->prepare('INSERT INTO posts(img, post_date, post_text, user_id)
      VALUES(:img, :post_date, :post_text, :user_id )');

      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':post_text', $usertext, PDO::PARAM_STR);
      $statement->bindParam(':img', $img['name'], PDO::PARAM_STR);
      $statement->bindParam(':post_date', $date, PDO::PARAM_STR);
      $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
      print_r($statement);
      $statement->execute();

      if (!is_dir(__DIR__."/../post_img/$folder")) {
        mkdir(__DIR__."/../post_img/$folder");
      };

      $path = __DIR__.'/../post_img/'.$folder;

      if (file_exists($path.$img['name'])) {
        echo "Sorry, file already exists.";
        die;
      }


        $oldpath = $img['tmp_name'];
        $newpath = $path.$img['name'];
        print_r($oldpath);
        print_r($newpath);
        move_uploaded_file($oldpath, $newpath);

}else{
  echo 'nana';
};
  $date = date("Y-m-d, H:i:s");
  $id = $_SESSION['user']['id'];
  $name = $_SESSION['user']['name'];
  $folder = $id.'_'.$name;

  // echo $folder;
  // echo '<br>';
  // echo $imgname;
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
