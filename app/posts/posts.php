<?php
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


      <h4 class="postname"><?= $username ;?></h4>

      <!-- makes img edditble if logged in -->
      <?php if($userId === $_SESSION['user']['id']) : ?>
        <a href="/editpost.php?post_id=<?= $postId; ?>">
        <?php endif ; ?>
        <img src="/app/img/<?= $src ?>" alt="lala">
        <?php if($userId === $_SESSION['user']['id']) : ?>
        </a>
      <?php endif ; ?>

      <!-- like counter -->
      <div class="like-bar">
        <form method="post" class="my-like-form disliked" >
          <input type="hidden" name="post_id" value="<?= $postId ?>" />
          <input type="hidden" name="action" value="<?= $action ?>" />
          <button class="like-btn" type="submit" name="action"></button>
        </form>
        <p class="like-counter">Likes: <?php echo count($likes).' ';?></p>

        <a class="comment-btn" href=""><img ></a>
      </div>

      <p><?= $postText ;?></p>

    <?php endforeach; ?>
