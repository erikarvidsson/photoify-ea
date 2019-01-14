<?php
require __DIR__.'/views/header.php';
?>



<article class="loggin-page">
    <h1 class="loggin-logo">Photoify</h1>

    <form class="loggin-form" action="app/users/login.php" method="post">
        <div class="form-group">
            <label for="email"></label>
            <input class="form-control" type="email" name="email" placeholder="francis@darjeeling.com" required>
        </div><!-- /form-group -->

        <div class="form-group">
            <label for="password"></label>
            <input class="form-control" type="password" name="password" placeholder="Password" required>
        </div><!-- /form-group -->

        <button type="submit" class="btn btn-primary">Login</button>
    </form>
  <a class="login-a" href="newprofile.php">Create a new account</a>
</article>


<?php
require __DIR__.'/views/footer.php';
?>
