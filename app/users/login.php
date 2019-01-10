<?php

declare(strict_types=1);

require __DIR__.'/../autoload.php';

// In this file we login users.


if (isset($_POST['email'], $_POST['password'])){
  $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $password = ($_POST['password']);

  $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
  $statement->bindParam(':email', $email, PDO::PARAM_STR);
  $statement->execute();

  $users = $statement->fetch(PDO::FETCH_ASSOC);

  $emailDb = $users['email'];
  $passwordDb = $users['password'];



      if(password_verify($password, $passwordDb)){

        $_SESSION['user'] = $users;

        redirect('/');
      }
    redirect('/login.php');
}
// echo $_SESSION['user']['name'];
