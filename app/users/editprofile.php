<?php
require __DIR__.'/../autoload.php';

    echo $_SESSION['user']['email'];

    if (isset($_SESSION['user']['email'])){
      $email = $_SESSION['user']['email'];

      $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
      // $statement = $pdo->prepare('SELECT * FROM users');
      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }


      $statement->bindParam(':email', $email, PDO::PARAM_STR);
      $statement->execute();

      $currentusers = $statement->fetch(PDO::FETCH_ASSOC);

      echo '<br>'.$currentusers['last_name'];

      // return($users);
    }

if (isset($_POST['first-name'], $_POST['last-name'], $_POST['user-name'], $_POST['email'], $_POST['password'],
    $_POST['user_text'])){

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




      $statement = $pdo->prepare('UPDATE users SET last_name = :last_name, first_name = :first_name, email = :email, username = :username,
        password = :password, profile_img = :profile_img, user_text = :user_text WHERE id = :user_id');

      // $statement = $pdo->prepare('UPDATE users(last_name, first_name, email, username, password, profile_img, signup_date, user_text)
      // VALUES(:last_name, :first_name, :email, :username, :password, :profile_img, :signup_date, :user_text ) WHERE id = $id');

      print_r($statement);

      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':first_name', $firstname, PDO::PARAM_STR);
      $statement->bindParam(':last_name', $lastname, PDO::PARAM_STR);
      $statement->bindParam(':username', $username, PDO::PARAM_STR);
      $statement->bindParam(':email', $email, PDO::PARAM_STR);
      $statement->bindParam(':password', $password, PDO::PARAM_STR);
      $statement->bindParam(':user_text', $usertext, PDO::PARAM_STR);
      $statement->bindParam(':profile_img', $imgname);
      $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
      print_r($statement);
      $statement->execute();



      if (!is_dir(__DIR__."/../post_img/profile_img")) {
        mkdir(__DIR__."/../post_img/profile_img");
      };

      $path = __DIR__.'/../post_img/profile_img/';

      print_r($_FILES);

      if (file_exists($path.$img['name'])) {
        die;
      }

      $oldpath = $img['tmp_name'];
      $newpath = $path.$imgname;
      move_uploaded_file($oldpath, $newpath);

};
echo "test";


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
      <input name="first-name" value="<?= $currentusers['first_name']; ?>">First Name:</input>
      <input name="last-name" value="<?= $currentusers['last_name']; ?>">Last Name:</input>
      <input name="user-name" value="<?= $currentusers['username']; ?>">Username:</input>
      <input name="email" value="<?= $currentusers['email']; ?>">Email:</input>
      <input name="password"  type="password" value="FakePSW" value="<?= $currentusers['password']; ?>">Password:</input>
      <textarea name="user_text" value=""><?= $currentusers['user_text']; ?></textarea>
      <!-- <input type="file" id="profile_img" name="profile_img" accept="image/png, image/jpeg"><img src=""></input> -->
      <input type="file" name="profile_img"></input>
      <button type="submit" name="button"> knapp</button>
    </form>

  </body>
</html>
