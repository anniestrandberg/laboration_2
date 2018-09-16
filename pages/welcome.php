<?php include '../partials/header.php'; ?>
<!-- innan sidan renderas, kör en validering -->
<?php CheckSession::check_if_logged_out(); ?>
    <div id="box-welcome">
        <div class="content-welcome">
        <p href="" class="typewrite" data-period="2000" data-type='[ "Welcome <?= $_SESSION['username'] ?>"]'>
    <span class="wrap"></span>
</p>
<br>
</div>

<span style="display:none" id="hidden_name">WELCOME <?= $_SESSION['username']; ?></span>


    <div id="logout">
    <a id="logout-welcome" href="../logout.php">Logga ut</a>
    </div>
<?php include '../partials/footer.php'; ?>