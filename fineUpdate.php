<?php
    include("connection.php");

    $response = [
        "success" => true,
        "message" => "",
    ];

    if ($_POST['fineId'] != null) {
        $sql = "UPDATE Fine SET Fine_amount='" . $_POST['amount'] . "', Fine_points='" . $_POST['points'] . "' WHERE Fine_ID=" . $_POST['fineId'];
    } else {
        $sql = "INSERT INTO Fine(Fine_amount, Fine_points, Incident_ID) VALUES ('" . $_POST['amount'] . "','" . $_POST['points'] ."','" . $_POST['incident'] . "');";
    }
   
    if (!mysqli_query($conn, $sql)) {
        $response['success'] = false;  
        $response['message'] = "Error updating fine";  
        echo json_encode($response); 
        exit;
    } 

    $response['message'] = "Fine updated successfully";
    echo json_encode($response); 
?>
