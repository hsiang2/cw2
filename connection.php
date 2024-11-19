<?php
    include('db.inc.php');
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if(!$conn) {
        die("Connection failed");
    }
?>