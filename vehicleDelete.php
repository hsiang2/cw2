<?php
session_start();
include('connection.php');

$vehicleId = $_POST['id'];
// run a query to delete the note
$sql = "DELETE FROM Vehicle WHERE Vehicle_ID = $vehicleId";
$result = mysqli_query($conn, $sql);
if(!$result){
    echo 'error';   
}

?>