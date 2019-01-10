<?php

require __DIR__.'/../autoload.php';
      //
      //
      // // get all post from the post database
      // $statement = $pdo->prepare('SELECT * FROM posts');
      // if(!$statement){
      //   die(var_dump($pdo->errorInfo()));
      // }
      //
      // $statement->execute();
      //
      // $posts = $statement->fetchAll(PDO::FETCH_ASSOC);

      // get post username by user id
      $statement = $pdo->prepare('SELECT username, user_id, post_text, img, p_id FROM `users` AS u
        INNER JOIN `posts` AS p ON p.user_id = u.id');
      if(!$statement){
        die(var_dump($pdo->errorInfo()));
      }

      $statement->execute();

      $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
      $posts = array_reverse($posts);

      foreach ($posts as $post) :
        $userId = $post['user_id'];
        $username = $post['username'];
        $folder = $userId;
        $img = $post['img'];
        $src = 'post_img/'.$img;
        $postText = $post['post_text'];
        $postId = $post['p_id'];
        $id = $_SESSION['user']['id'];


        $statement = $pdo->prepare('SELECT post_id, like_user_id FROM `likes` AS l
          INNER JOIN `posts` AS p ON p.p_id = l.post_id WHERE post_id = :post_id');
        if(!$statement){
          die(var_dump($pdo->errorInfo()));
        }
        $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
        $statement->execute();

        $likes = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ($likes) {
          $action = 'disliked';
        } else {
          $action = 'liked';
    }
      ?>


        <h4><?= $username ;?></h4>
        <?php if($postId === $_SESSION['user']['id']) : ?>
          <a href="app/users/editpost.php?post_id=<?= $postId; ?>">
            <img src="/app/img/<?= $src ?>" alt="lala">
          </a>
        <?php endif ; ?>
        <p><?= $postText ;?></p>
        <p><?= $postId ;?></p>
        <?php
          foreach ($likes as $like) {
          if($like['like_user_id'] === $id){
            echo "knapp";
            break;
          }
        };?>

        <form method="post" class="my-like-form liked" >
            <input type="hidden" name="post_id" value="<?= $postId ?>" />
            <input type="hidden" name="action" value="<?= $action ?>" />
            <button type="submit"><i class="fa fa-heart" aria-hidden="true"></i></button>
        </form>
        <p class="like_counter"><?php echo count($likes).' ';?></p> <p>Likes</p>


        <a href="comment.php"></a>


      <?php endforeach; ?>
