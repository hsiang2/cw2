<?php
session_start();
include('connection.php');

$officerId = $_POST['id'];

$sql = "DELETE FROM Officer WHERE Officer_ID = '$officerId'";

if(!mysqli_query($conn, $sql)){
    echo 'error';   
} 

?>