<?php

    if(!if_user_loggedin()){
      redirect('/');
    }

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

      // return($users);
    }

if (isset($_POST['first-name'], $_POST['last-name'], $_POST['user-name'], $_POST['email'], $_POST['user_text'])){

      $firstname = filter_var($_POST['first-name'], FILTER_SANITIZE_STRING);
      $lastname = filter_var($_POST['last-name'], FILTER_SANITIZE_STRING);
      $username = filter_var($_POST['user-name'], FILTER_SANITIZE_STRING);
      $email = filter_var($_POST['email'], FILTER_SANITIZE_STRING);
      $usertext = nl2br(filter_var($_POST['user_text'], FILTER_SANITIZE_STRING));
      $id = $_SESSION['user']['id'];




      $statement = $pdo->prepare('UPDATE users SET last_name = :last_name, first_name = :first_name, email = :email, username = :username,
        user_text = :user_text WHERE id = :user_id');

      // $statement = $pdo->prepare('UPDATE users(last_name, first_name, email, username, password, profile_img, signup_date, user_text)
      // VALUES(:last_name, :first_name, :email, :username, :password, :profile_img, :signup_date, :user_text ) WHERE id = $id');


      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':first_name', $firstname, PDO::PARAM_STR);
      $statement->bindParam(':last_name', $lastname, PDO::PARAM_STR);
      $statement->bindParam(':username', $username, PDO::PARAM_STR);
      $statement->bindParam(':email', $email, PDO::PARAM_STR);
      $statement->bindParam(':user_text', $usertext, PDO::PARAM_STR);
      $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
      $statement->execute();


      $_SESSION['user']['first_name'] = $firstname;
      $_SESSION['user']['last_name'] = $lastname;
      $_SESSION['user']['username'] = $username;
      $_SESSION['user']['email'] = $email;
      $_SESSION['user']['user_text'] = $usertext;
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

  if(isset($_POST['password'])){
    $id = $_SESSION['user']['id'];

    $statement = $pdo->prepare('SELECT * FROM users WHERE id = :id');

    if(!$statement){
      die(var_dump($pdo->errorInfo()));
    }

    $statement->bindParam(':id', $id, PDO::PARAM_STR);
    $statement->execute();

    $currentuser = $statement->fetch(PDO::FETCH_ASSOC);

    $password = $_POST['password'];
    $passwordDb = $currentuser['password'];

    if(password_verify($password, $passwordDb)){
      // delete profile img
      if($_SESSION['user']['profile_img']){
        $path = __DIR__.'/../img/profile_img/';
        unlink($path.$_SESSION['user']['profile_img']);
    }
      // delete post img
      $statement = $pdo->prepare('SELECT img FROM posts WHERE user_id = :id');

      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

      $statement->bindParam(':id', $id, PDO::PARAM_STR);
      $statement->execute();

      $userpost = $statement->fetchAll(PDO::FETCH_ASSOC);

      $path = __DIR__.'/../img/post_img/';

      foreach($userpost as $post){
        unlink($path.$post['img']);
      }

      // delete profile from database
      $statement = $pdo->prepare('DELETE FROM users WHERE id = :user_id');

      $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
      $statement->execute();

      $statement = $pdo->prepare('DELETE FROM posts WHERE user_id = :user_id');

      $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
      $statement->execute();

      $statement = $pdo->prepare('DELETE FROM likes WHERE like_user_id = :user_id');

      $statement->bindParam(':user_id', $id, PDO::PARAM_INT);
      $statement->execute();

      session_unset();
      session_destroy();
      redirect('/');
    }
    }

    // uppdate password
if (isset($_POST['old-password'], $_POST['new-password'], $_POST['confirm-password'])) {

    if ($_POST['new-password'] === $_POST['confirm-password']) {

        $user_id = (int)$_SESSION['user']['id'];
        $new_password = password_hash($_POST['new-password'], PASSWORD_DEFAULT);

        $statement = $pdo->prepare('SELECT * FROM users WHERE id = :user_id');
        // $statement = $pdo->prepare('SELECT * FROM users');
        if(!$statement){
          die(var_dump($pdo->errorInfo()));
        }

        $statement->bindParam(':user_id', $user_id, PDO::PARAM_STR);
        $statement->execute();

        $user = $statement->fetch(PDO::FETCH_ASSOC);

        if (password_verify($_POST['old-password'], $user['password'])) {

            $statement = $pdo->prepare('UPDATE users SET password = :password WHERE id = :id');


            if (!$statement)
            {
                die(var_dump($pdo->errorInfo()));
            }

            $statement->bindParam(':password', $new_password, PDO::PARAM_STR);
            $statement->bindParam(':id', $user_id, PDO::PARAM_INT);

            $statement->execute();

            redirect('/index.php');
        }
      }
    }
?>
