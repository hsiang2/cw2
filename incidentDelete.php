<?php
session_start();
include('connection.php');

$incidentId = $_POST['id'];
$fineId = $_POST['fine'];

if($fineId) {
    $sqlFine = "DELETE FROM Fine WHERE Fine_ID = $fineId";

    if(!mysqli_query($conn, $sqlFine)){
        echo 'error';   
    } 
}

$sql = "DELETE FROM Incident WHERE Incident_ID = $incidentId";

if(!mysqli_query($conn, $sql)){
    echo 'error';   
} 

?>