<?php
  require __DIR__.'/views/header.php';
  require __DIR__.'/views/banner.php';
require __DIR__.'/app/posts/editpost.php';
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style/sanitize.css">
    <title></title>
  </head>
  <body>
    <div class="editprofile-container">
      <img src="/app/img/post_img/<?= $post['img']; ?>" alt="lala">

      <form class="editpost-form" action="editpost.php?post_id=<?= $_GET['post_id']; ?>" method="post" enctype="multipart/form-data">
        <label for="post-text">Description:</label>
        <textarea id="post-text" name="post-text" value="<?= $post['post_text']; ?>"><?= $post['post_text']; ?></textarea>
        <button type="submit" name="button"> Uppdate description</button>
      </form>

      <form class="editpost-form" action="editpost.php?post_id=<?= $_GET['post_id']; ?>" method="post" enctype="multipart/form-data">
        <button type="submit" name="delete"> Delete post</button>
      </form>
    <div>
  </body>
</html>


<?php
require __DIR__.'/views/nav.php';
require __DIR__.'/views/footer.php';
?>
