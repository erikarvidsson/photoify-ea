<?php
require __DIR__.'/views/header.php';
require __DIR__.'/views/banner.php';
require __DIR__.'/app/posts/comment.php';
?>

<div class="comments-container">
  <img src="/app/img/post_img/<?= $postImg['img'] ?>">
  <?php foreach ($comments as $comment) :?>
    <h3> <?= $comment['comment'] ?></h3>
  <?php endforeach ;?>
  <form class="" action="comments.php?post_id=<?= $_GET['post_id'] ?>" method="post" enctype="multipart/form-data">
    <input name="comment" placeholder="text here"></input>
    <button type="submit" name="button"> Add comment  </button>
  </form>
<div>

  <?php
  require __DIR__.'/views/nav.php';
  require __DIR__.'/views/footer.php';
  ?>
