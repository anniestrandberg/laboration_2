
<?php include '../partials/header.php' ?>

<?php CheckSession::check_if_logged_in(); ?>
<div class="box">
<h1 class="heading">Logga in</h1>
<form autocomplete="off" method="post">
    <div class="login">

        <input class="textfield" type="text" placeholder="användarnamn" name="username"><br>
        <input class="textfield" type="password" placeholder="lösenord" name="password"><br>
        <input class="button" type="submit" name="login" value="Login">
    </div>
</form>
<div class="aLink">
Vill du registrera dig? <a href="register.php">Tryck här.</a>
</div>

<?php include '../partials/footer.php' ?>