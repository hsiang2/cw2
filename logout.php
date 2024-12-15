<?php
    session_start();
    if (isset($_POST["logout"])) {
        unset($_SESSION["user"]);
        unset($_SESSION["id"]);
        unset($_SESSION["admin"]);
    }
    header("Location: /cw2/login.php");
    exit();
?>