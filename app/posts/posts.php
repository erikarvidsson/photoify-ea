<?php
// get post username by user id
if (!if_user_loggedin()) {
    redirect('/');
}
$statement = $pdo->prepare('SELECT username, user_id, post_text, img, p_id, post_date FROM `users` AS u
  INNER JOIN `posts` AS p ON p.user_id = u.id');
  if (!$statement) {
      die(var_dump($pdo->errorInfo()));
  }

  $statement->execute();

  $posts = $statement->fetchAll(PDO::FETCH_ASSOC);
  $posts = array_reverse($posts);

  foreach ($posts as $post) :
    $userId = $post['user_id'];
    $username = $post['username'];
    $postDate = $post['post_date'];
    $folder = $userId;
    $img = $post['img'];
    $src = 'post_img/'.$img;
    $postText = $post['post_text'];
    $postId = $post['p_id'];
    $id = $_SESSION['user']['id'];


    $statement = $pdo->prepare('SELECT post_id, like_user_id FROM `likes` AS l
      INNER JOIN `posts` AS p ON p.p_id = l.post_id WHERE post_id = :post_id');
      if (!$statement) {
          die(var_dump($pdo->errorInfo()));
      }
      $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
      $statement->execute();

      $likes = $statement->fetchAll(PDO::FETCH_ASSOC);



      $statement = $pdo->prepare('SELECT like_user_id FROM likes WHERE post_id = :post_id AND like_user_id = :user_id');
      if (!$statement) {
          die(var_dump($pdo->errorInfo()));
      }
      $statement->bindParam(':post_id', $postId, PDO::PARAM_INT);
      $statement->bindParam(':user_id', $_SESSION['user']['id'], PDO::PARAM_INT);
      $statement->execute();

      $liked = $statement->fetch(PDO::FETCH_ASSOC);


      if ($liked) {
          $action = 'disliked';
      } else {
          $action = 'liked';
      }
      ?>

      <div class="post-user">
        <h4 class="postname"><?= $username ;?></h4>
        <h4 class="postdate"><?= $postDate ;?></h4>
      </div>
      <!-- makes img edditble if logged in -->
      <?php if ((int)$userId === (int)$_SESSION['user']['id']) : ?>
        <a href="/editpost.php?post_id=<?= $postId; ?>">
        <?php endif ; ?>
        <img src="/app/img/<?= $src ?>" alt="lala">
        <?php if ((int)$userId === (int)$_SESSION['user']['id']) : ?>
        </a>
      <?php endif ; ?>
      <!-- like counter -->
      <div class="like-bar">
        <form data-id="<?= $postId ?>" method="post" class="my-like-form disliked" >
          <input type="hidden" name="post_id" value="<?= $postId ?>" />
          <input type="hidden" name="action" value="<?= $action ?>" />
          <button data-id="<?= $postId ?>" class="like-btn like-btn-<?= $postId ?> <?= $action ?>" type="submit" name="action"></button>
        </form>
        <p class="like-counter"> <span>Likes: <?php echo count($likes).' ';?></span></p>

        <a class="comment-btn" href="comments.php?post_id=<?= $postId ?>"><img ></a>
      </div>

      <p><?= $postText ;?></p>

    <?php endforeach; ?>
