<?php
require __DIR__.'/views/header.php';
require __DIR__.'/views/banner.php';
require __DIR__.'/app/users/profile.php';
?>

<div class="user-img-container">
  <img class="profile-img" src="/app/img/profile_img/<?php if(empty($profileInfo['profile_img'])){
    echo 'default.jpg';
  } else{
    echo $profileInfo['profile_img'];
  }?>">
  <h3 class="user-name"><?= $profileInfo['username'] ?></h3>
  <h4 class="user-name"><?= $profileInfo['user_text'] ?></h4>
</div>


<div class="user-container">
  <?php foreach ($imgs as $img) : ?>
    <a href="/editpost.php?post_id=<?= $img['p_id']; ?>">
      <div class="user-img">
        <img src="/app/img/post_img/<?= $img['img']?>">
      </div>
    </a>
  <?php endforeach; ?>
</div>

 <script src="/assets/js/profilethumb.js"></script>


<?php
require __DIR__.'/views/nav.php';
require __DIR__.'/views/footer.php';
?>
