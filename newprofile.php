<?php
require __DIR__.'/views/header.php';
require __DIR__.'/views/banner.php';
require __DIR__.'/app/users/newaccount.php';
?>

<div class="newprofile-container">
  <form class="" action="newprofile.php" method="post" enctype="multipart/form-data">
    <input name="first-name" placeholder="First Name"></input>
    <input name="last-name" placeholder="Last Name"></input>
    <input name="user-name" placeholder="User Name"></input>
    <input name="email" placeholder="email"></input>
    <input name="password" placeholder="Password" type="password" autocomplete="off"></input>
    <input name="user_text" placeholder="About"></input>
    <button type="submit" name="button"> Create</button>
  </form>
  <div class="newprofile-a">
    <a href="/index.php"> Back </a>
  <div>
<div>
<?php
require __DIR__.'/views/footer.php';
?>
