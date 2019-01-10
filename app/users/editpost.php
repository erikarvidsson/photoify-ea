<?php
require __DIR__.'/../autoload.php';
    if (isset($_SESSION['user']['id'])){
      $post_id = $_GET['post_id'];

      $statement = $pdo->prepare('SELECT post_text FROM posts WHERE p_id = :user_id');
      // $statement = $pdo->prepare('SELECT * FROM users');
      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':user_id', $post_id, PDO::PARAM_STR);
      $statement->execute();

      $post = $statement->fetch(PDO::FETCH_ASSOC);

      // return($users);
    }

if (isset($_POST['post-text'])){

      $firstname = filter_var($_POST['first-name'], FILTER_SANITIZE_STRING);
      $lastname = filter_var($_POST['last-name'], FILTER_SANITIZE_STRING);
      $username = filter_var($_POST['user-name'], FILTER_SANITIZE_STRING);
      $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $usertext = filter_var($_POST['user_text'], FILTER_SANITIZE_STRING);
      $img =  $_FILES['profile_img'];
      $date = date("Y-m-d, H:i:s");
      $id = $_SESSION['user']['id'];
      $imgname = $id.'_'.$date.$img['name'];




      $statement = $pdo->prepare('UPDATE posts SET last_name = :last_name, first_name = :first_name, email = :email, username = :username,
        password = :password, profile_img = :profile_img, user_text = :user_text WHERE id = :user_id');

      // $statement = $pdo->prepare('UPDATE users(last_name, first_name, email, username, password, profile_img, signup_date, user_text)
      // VALUES(:last_name, :first_name, :email, :username, :password, :profile_img, :signup_date, :user_text ) WHERE id = $id');


      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':first_name', $firstname, PDO::PARAM_STR);
      $statement->bindParam(':last_name', $lastname, PDO::PARAM_STR);
      $statement->bindParam(':username', $username, PDO::PARAM_STR);
      $statement->bindParam(':email', $email, PDO::PARAM_STR);
      $statement->bindParam(':password', $password, PDO::PARAM_STR);
      $statement->bindParam(':user_text', $usertext, PDO::PARAM_STR);
      $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
      $statement->execute();


      $_SESSION['user']['firstname'] = $firstname;
};

  if(isset($_FILES['profile_img'])){

      $img =  $_FILES['profile_img'];
      $date = date("Y-m-d, H:i:s");
      $id = $_SESSION['user']['id'];
      $imgname = $id.'_'.$date.$img['name'];


      $statement = $pdo->prepare('UPDATE users SET profile_img = :profile_img WHERE id = :user_id');

      $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
      $statement->bindParam(':profile_img', $imgname, PDO::PARAM_STR);
      $statement->execute();

      if (!is_dir(__DIR__."/..//img/profile_img")) {
        mkdir(__DIR__."/../img/profile_img");
      };

      $path = __DIR__.'/../img/profile_img/';

      if (file_exists($path.$img['name'])) {
        die;
      }

      $oldpath = $img['tmp_name'];
      $newpath = $path.$imgname;
      move_uploaded_file($oldpath, $newpath);

      $_SESSION['user']['profile_img'] = $imgname;

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
    <form class="" action="editprofile.php" method="post" enctype="multipart/form-data">
      <label for="post-text">Text:</label>
      <input id="post-text" name="post-text" value="<?= $post['post_text']; ?>"></input>
    </form>

  </body>
</html>
