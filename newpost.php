<?php
require __DIR__.'/views/header.php';
require __DIR__.'/views/banner.php';
require __DIR__.'/app/posts/newpost.php';
?>
<div class="newpost-container">
<img id="image" />
<form  class="newpost-form" action="newpost.php" method="post" placeholder="Chose image" enctype="multipart/form-data">
  <input class="nwepost-hidden" type="file" name="img" id="imgs">
  <label class="choseimg-form" for="imgs">Select file</label>
  <textarea name="post_text" placeholder="Write something..."></textarea>
  <button type="submit" name="button"> Post</button>
</form>
<div>



<?php
require __DIR__.'/views/nav.php';
require __DIR__.'/views/footer.php';
?>
