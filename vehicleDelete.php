<?php
session_start();
include('connection.php');

$vehicleId = $_POST['id'];

$sqlOwner = "SELECT People_ID FROM Ownership WHERE Vehicle_ID=$vehicleId";
$resultOwner = mysqli_query($conn, $sqlOwner);
if (mysqli_num_rows($resultOwner) > 0) {
    $sqlOwner = "DELETE FROM Ownership WHERE Vehicle_ID = $vehicleId";
    if(!mysqli_query($conn, $sqlOwner)){
        echo 'error';   
    } 
}

$sql = "DELETE FROM Vehicle WHERE Vehicle_ID = $vehicleId";

if(!mysqli_query($conn, $sql)){
    echo 'error';   
} 



?>