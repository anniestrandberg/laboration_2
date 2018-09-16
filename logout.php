<?php
//Loggar ut användaren och förstör sessionen med dess värden. Och skickas till startsidan.
session_start();
unset($_SESSION['username']);
session_destroy();
header("location: pages/index.php");
die();
?>