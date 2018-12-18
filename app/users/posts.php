<?php

require __DIR__.'/../autoload.php';



      $statement = $pdo->prepare('SELECT * FROM posts');
      // $statement = $pdo->prepare('SELECT * FROM users');
      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

      $statement->execute();

      $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

      foreach ($posts as $post) :
        $postid = $post['id'];
        $userid = $post['user_id'];
        $username = $post['user_name'];
        $folder = $userid.'_'.$username;
        $img = $post['img'];
        $src = $folder.'/'.$img;
        $post = $post['post_text'];
      ?>



        <h4><?= $username ;?></h4>
        <img src="/app/post_img/<?= $src ?>" alt="lalala">
        <p><?= $post ;?></p>

        
      <?php endforeach; ?>
