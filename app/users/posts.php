<?php

require __DIR__.'/../autoload.php';



      $statement = $pdo->prepare('SELECT * FROM posts');
      // $statement = $pdo->prepare('SELECT * FROM users');
      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

      $statement->execute();

      $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

      $statement = $pdo->prepare('SELECT username FROM `users` AS u INNER JOIN `posts` AS p ON p.user_id = u.id;');
      // $statement = $pdo->prepare('SELECT * FROM users');
      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

      $statement->execute();

      $names = $statement->fetchAll(PDO::FETCH_ASSOC);

      print_r($names);

      foreach ($names as $name){
      }
      foreach ($posts as $post) :
        $postid = $post['id'];
        $userid = $post['user_id'];
        $username = $post['user_name'];
        $folder = $userid;
        $img = $post['img'];
        $src = 'img/'.$img;
        $post = $post['post_text'];

      ?>



        <h4><?= $names['username']  ;?></h4>
        <img src="/app/post_img/<?= $src ?>" alt="lalala">
        <p><?= $post ;?></p>


      <?php endforeach; ?>
