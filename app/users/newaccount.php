<?php

if (isset($_POST['first-name'], $_POST['last-name'], $_POST['user-name'], $_POST['email'], $_POST['password'],
    $_POST['user_text'])) {
    $firstname = filter_var($_POST['first-name'], FILTER_SANITIZE_STRING);
    $lastname = filter_var($_POST['last-name'], FILTER_SANITIZE_STRING);
    $username = filter_var($_POST['user-name'], FILTER_SANITIZE_STRING);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $usertext = filter_var($_POST['user_text'], FILTER_SANITIZE_STRING);
    $date = date("Y-m-d, g:i a");

    $statement = $pdo->prepare('INSERT INTO users(last_name, first_name, email, username, password, signup_date, user_text)
      VALUES(:last_name, :first_name, :email, :username, :password, :signup_date, :user_text )');

    if (!$statement) {
        die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':first_name', $firstname, PDO::PARAM_STR);
    $statement->bindParam(':last_name', $lastname, PDO::PARAM_STR);
    $statement->bindParam(':username', $username, PDO::PARAM_STR);
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->bindParam(':password', $password, PDO::PARAM_STR);
    $statement->bindParam(':user_text', $usertext, PDO::PARAM_STR);
    $statement->bindParam(':signup_date', $date, PDO::PARAM_STR);
    $statement->execute();

    $statement = $pdo->prepare('SELECT * FROM users WHERE email = :email');
    $statement->bindParam(':email', $email, PDO::PARAM_STR);
    $statement->execute();

    $users = $statement->fetch(PDO::FETCH_ASSOC);
    $_SESSION['user'] = $users;


    redirect('/');
};
