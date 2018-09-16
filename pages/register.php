<?php include '../partials/header.php' ?>

<?php CheckSession::check_if_logged_in(); ?>
<div class="box">
    <h1 class="heading">Registrera dig</h1>
    <form autocomplete="off" method="post">
        <div class="login">
            <input class="textfield" type="text" placeholder="Användarnamn" name="username"><br>
            <input class="textfield" type="text" placeholder="Förnamn" name="name"><br>
            <input class="textfield" type="email" placeholder="E-mailaddress" name="email"><br>
            <input class="textfield" type="password" placeholder="Lösenord" name="password"><br>
            <input class="button" type="submit" name="register">
        </div>
    </form>

    <div class="aLink">
        Redan registrerad? <a href="login.php">Tryck här.</a>
    </div>

</div>
<?php include '../partials/footer.php' ?>