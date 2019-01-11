<?php
require __DIR__.'/views/header.php';
require __DIR__.'/views/banner.php';
require __DIR__.'/app/posts/newpost.php';
?>
<form style="padding-top: 200px;" class="newpost-form" action="newpost.php" method="post" enctype="multipart/form-data">
  <input class="choseimg-form" type="file" name="img">
  <textarea name="post_text" placeholder="Write something..."></textarea>
  <button type="submit" name="button"> Post</button>
</form>

</body>
</html>



<?php
require __DIR__.'/views/nav.php';
require __DIR__.'/views/footer.php';
?>
