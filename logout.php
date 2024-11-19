<?php
    session_start();
    if (isset($_POST["logout"])) {
        unset($_SESSION["user"]);
        unset($_SESSION["id"]);
    }
    header("Location: login.php");
    exit();
?>