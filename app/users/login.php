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

  print_r($users);


  $emailDb = $users['email'];
  $passwordDb = $users['password'];

      if($emailDb === $email && password_verify($password, $passwordDb)){
        echo 'yes :)';

        $session = [
          'id' => $users['id'],
          'name' => $users['first_name'],
          'email' => $users['email']];

        $_SESSION['user'] = $session;

        redirect('/');
      }else{
      echo 'neej :(';
      }


}
// echo $_SESSION['user']['name'];
