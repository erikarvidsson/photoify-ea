<?php

 ?>

<div class="banner" id="navbar">
  <h1 class="banner2">Photoify</h1>

<?php if (isset($_SESSION['user'])) :?>
<div class="dropdown">
  <button onclick="myFunction()" class="dropbtn"></button>
  <div id="myDropdown" class="dropdown-content">
    <a href="/editprofile.php">Edit profile</a>
    <a href="/logout.php">Sign out</a>
  </div >
</div>

<?php endif ;?>
</div>
