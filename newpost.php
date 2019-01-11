<?php
require __DIR__.'/views/header.php';
require __DIR__.'/views/banner.php';
require __DIR__.'/app/posts/newpost.php';
?>
<img id="image" />
<form  class="newpost-form" action="newpost.php" method="post" enctype="multipart/form-data">
  <input class="choseimg-form" type="file" name="img" id="imgs">
  <textarea name="post_text" placeholder="Write something..."></textarea>
  <button type="submit" name="button"> Post</button>
</form>

</body>
</html>



<?php
require __DIR__.'/views/nav.php';
require __DIR__.'/views/footer.php';
?>
