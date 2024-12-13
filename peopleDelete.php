<?php
session_start();
include('connection.php');

$peopleId = $_POST['id'];

$sqlOwner = "SELECT Vehicle_ID FROM Ownership WHERE People_ID=$peopleId";
$resultOwner = mysqli_query($conn, $sqlOwner);
if (mysqli_num_rows($resultOwner) > 0) {
    $sqlOwner = "DELETE FROM Ownership WHERE People_ID = $peopleId";
    if(!mysqli_query($conn, $sqlOwner)){
        echo 'error';   
    } 
}

$sql = "DELETE FROM People WHERE People_ID = $peopleId";

if(!mysqli_query($conn, $sql)){
    echo 'error';   
} 

?>