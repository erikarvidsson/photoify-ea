<?php
require __DIR__.'/../autoload.php';

    // $pdo = new PDO('sqlite:photoify.db');

if (isset($_POST['first-name'], $_POST['last-name'], $_POST['user-name'], $_POST['email'], $_POST['password'],
    $_POST['user_text'], $_POST['profile_img'])){

      $firstname = filter_var($_POST['first-name'], FILTER_SANITIZE_STRING);
      $lastname = filter_var($_POST['last-name'], FILTER_SANITIZE_STRING);
      $username = filter_var($_POST['user-name'], FILTER_SANITIZE_STRING);
      $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
      $usertext = filter_var($_POST['user_text'], FILTER_SANITIZE_STRING);
      $prifileimg = $_POST['profile_img'];
      $date = date("Y-m-d, g:i a");

      $statement = $pdo->prepare('INSERT INTO users(last_name, first_name, email, username, password, profile_img, signup_date, user_text)
      VALUES(:last_name, :first_name, :email, :username, :password, :profile_img, :signup_date, :user_text )');

      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':first_name', $firstname, PDO::PARAM_STR);
      $statement->bindParam(':last_name', $lastname, PDO::PARAM_STR);
      $statement->bindParam(':username', $username, PDO::PARAM_STR);
      $statement->bindParam(':email', $email, PDO::PARAM_STR);
      $statement->bindParam(':password', $password, PDO::PARAM_STR);
      $statement->bindParam(':user_text', $usertext, PDO::PARAM_STR);
      $statement->bindParam(':profile_img', $prifileimg, PDO::PARAM_STR);
      $statement->bindParam(':signup_date', $date, PDO::PARAM_STR);
      $statement->execute();

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
    <form class="" action="newaccount.php" method="post">

      <input name="first-name" placeholder="First Name"></input>
      <input name="last-name" placeholder="Last Name"></input>
      <input name="user-name" placeholder="User Name"></input>
      <input name="email" placeholder="email"></input>
      <input name="password" placeholder="Password"></input>
      <input name="user_text" placeholder="About"></input>
      <input type="file" id="profile_img" name="profile_img" accept="image/png, image/jpeg">
      <button type="submit" name="button"> knapp</button>

    </form>

  </body>
</html>
