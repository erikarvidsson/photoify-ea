<article>
    <div class="navbar">
    <?php if(isset($_SESSION['user'])){ ?>
      <a class="nav-post" href="/posts.php">All post</a>
      <a class="nav-add" href="/newpost.php">new post</a>
      <a class="nav-profile" href="/profile.php">profile</a>
      <!-- <a href="/app/users/logout.php">ut</a> -->
      <!-- <a href="/editprofile.php">eddit profile</a> -->
    <?php }else { ?>

      <a href="/login.php">log in</a>
      <a href="/newprofile.php">new account</a>
    <?php }?>

</div>


</article>
