<?php
require __DIR__.'/../autoload.php';

    // $pdo = new PDO('sqlite:photoify.db');

if (isset($_POST['post_text'], $_FILES['img'])){

      $usertext = filter_var($_POST['post_text'], FILTER_SANITIZE_STRING);
      $date = date("Y-m-d, H:i:s");
      $id = $_SESSION['user']['id'];
      $name = $_SESSION['user']['name'];
      $folder = $id.'_'.$name;
      $imgname = $id.'_'.$date;
      $img = $_FILES['img'];

      $statement = $pdo->prepare('INSERT INTO posts(img, post_date, post_text, user_id)
      VALUES(:img, :post_date, :post_text, :user_id )');

      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':post_text', $usertext, PDO::PARAM_STR);
      $statement->bindParam(':img', $imgname, PDO::PARAM_STR);
      $statement->bindParam(':post_date', $date, PDO::PARAM_STR);
      $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
      $statement->execute();

      if (!is_dir(__DIR__."/../post_img/$folder")) {
      mkdir(__DIR__."/../post_img/$folder");
    };

      $path = __DIR__.'/../post_img/'.$folder;


      $oldpath = $_FILES['img']['tmp_name'];
      $newpath = $path.$_FILES['img']['name'];
      print_r($oldpath);
      print_r($newpath);
      move_uploaded_file($oldpath, $newpath);


      // $path = realpath($path);
      // move_uploaded_file($img, $path);
      //
      // print_r($img);
      //
      // $imgname = $id.'_'.$date;
      //
      // define('UPLOAD_DIR', $path.'/'.$imgname);
      // $img = str_replace('data:image/png;base64,', '', $img);
      // $img = str_replace(' ', '+', $img);
      // $data = base64_decode($img);
      // $file = UPLOAD_DIR . uniqid() . '.png';
      // $success = file_put_contents($file, $path);
      // print $success ? $file : 'Unable to save the file.';





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
    <form class="" action="newpost.php" method="post">

      <input type="file" id="img" name="img" accept="image/png, image/jpeg">
      <textarea name="post_text" placeholder="Write something..."></textarea>
      <button type="submit" name="button"> knapp</button>

    </form>

  </body>
</html>
