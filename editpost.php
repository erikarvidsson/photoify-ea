<?php
require __DIR__.'/views/header.php';
require __DIR__.'/app/posts/editpost.php';
?>


<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="style/sanitize.css">
    <title></title>
  </head>
  <body>
    <img src="/app/img/post_img/<?= $post['img']; ?>" alt="lala">

    <form class="" action="editpost.php?post_id=<?= $_GET['post_id']; ?>" method="post" enctype="multipart/form-data">
      <label for="post-text">Text:</label>
      <input id="post-text" name="post-text" value="<?= $post['post_text']; ?>"></input>
      <button type="submit" name="button"> uppdate text</button>
    </form>

    <form class="" action="editpost.php?post_id=<?= $_GET['post_id']; ?>" method="post" enctype="multipart/form-data">
      <button type="submit" name="delete"> delete post</button>
    </form>

  </body>
</html>


<?php
require __DIR__.'/views/nav.php';
require __DIR__.'/views/footer.php';
?>
