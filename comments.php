<?php
require __DIR__.'/views/header.php';
require __DIR__.'/views/banner.php';


$statement = $pdo->prepare('SELECT * FROM `users` AS u
  INNER JOIN `comments` AS c ON c.user_id = u.id WHERE c.user_id = u.id');
  if(!$statement){
    die(var_dump($pdo->errorInfo()));
  }

  $statement->execute();

  $comments = $statement->fetchAll(PDO::FETCH_ASSOC);



$postId = $_GET['post_id'];

$statement = $pdo->prepare('SELECT img FROM posts WHERE p_id = :id');

  if(!$statement){
    die(var_dump($pdo->errorInfo()));
  }

  $statement->bindParam(':id', $postId, PDO::PARAM_STR);
  $statement->execute();
  $postImg = $statement->fetch(PDO::FETCH_ASSOC);

?>

<div class="comments-container">
  <img src="/app/img/post_img/<?= $postImg['img'] ?>">
  <?php foreach ($comments as $comment) :?>
  <?php  if($postId == $comment['post_id']):?>
    <h4> <?= $comment['username'] ?> <span class="comment-date"> <?= $comment['comment_date'] ?></span></h4>
    <h3> <?= $comment['comment'] ?></h3>
  <?php endif ;?>
  <?php endforeach ;?>
  <div class="comments-form">
    <form class="" action="/app/posts/comment.php?post_id=<?= $_GET['post_id'] ?>" method="post" enctype="multipart/form-data">
      <input name="comment" placeholder="text here"></input>
      <button type="submit" name="button"> Add comment  </button>
    </form>
  <div>
<div>

  <?php
  require __DIR__.'/views/nav.php';
  require __DIR__.'/views/footer.php';
  ?>
