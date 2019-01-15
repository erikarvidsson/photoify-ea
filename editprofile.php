<?php
require __DIR__.'/views/header.php';
require __DIR__.'/views/banner.php';
require __DIR__.'/app/users/editprofile.php';
?>


<div class="profile-site">
  <div class="profile-top">
    <!-- show default profile picture if non is chosen -->
    <img class="profile-img" src="/app/img/profile_img/<?php if(empty($_SESSION['user']['profile_img'])){
      echo 'default.jpg';
    } else{
      echo $_SESSION['user']['profile_img'];
    }?>">
    <p class="profile-name"><?= $_SESSION['user']['username']; ?> </p>
  </div>
  <div class="profile-form-box">
  <!-- uppdate user info -->
  <form class="profile-form" action="editprofile.php" method="post" enctype="multipart/form-data">
    <label for="first-name">First Name:</label>
    <input name="first-name" value="<?= $_SESSION['user']['first_name']; ?>"></input>
    <br>
    <label for="last-name">Last Name:</label>
    <input name="last-name" value="<?= $_SESSION['user']['last_name']; ?>"></input>
    <br>
    <label for="user-name">Username:</label>
    <input name="user-name" value="<?= $_SESSION['user']['username']; ?>"></input>
    <br>
    <label for="email">Email:</label>
    <input name="email" value="<?= $_SESSION['user']['email']; ?>"></input>
    <br>
    <label for="user_text">Biography:</label>
    <br>
    <textarea name="user_text" value=""><?= $_SESSION['user']['user_text']; ?></textarea>
    <br>
    <button type="submit" name="button"> Uppdate profile</button>
  </form>

  <!-- change profile picture -->
  <form class="profile-form" action="editprofile.php" method="post" enctype="multipart/form-data">
    <input type="file" name="profile_img"></input>
    <br>
    <button type="submit" name="button"> Change profile picture</button>
  </form>

  <!-- change password -->
  <form class="profile-form" action="editprofile.php" method="post">
    <label for="old-password">Change password:</label>
    <br>

    Old password:<input class="inputSettings" type="password" name="old-password" required>

    New password:<input class="inputSettings" type="password" name="new-password" required>

    Confirm password:<input class="inputSettings" type="password" name="confirm-password" required>

    <button class="button" type="submit">Change password</button>

  </form>

  <!-- delete account -->
  <form class="profile-form" action="editprofile.php" method="post" enctype="multipart/form-data">
    <label for="password">Password:</label>
    <input name="password"  type="password" value="FakePSW" required></input>
    <button type="submit" name="button"> Delet account</button>
  </form>

  </div>
</div>
<?php
require __DIR__.'/views/nav.php';
require __DIR__.'/views/footer.php';
?>
