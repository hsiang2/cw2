<?php

    session_start();
    include('connection.php');

    $officerId = $_SESSION["id"];

    $response = [
        "success" => true,
        "message" => "",
    ];

    $sqlAdd = "INSERT INTO Incident(Incident_time, Incident_statement, People_ID, Vehicle_ID, Offence_ID, Officer_ID) VALUES ('" . $_POST['time'] . "','" . $_POST['statement'] ."','" . $_POST['people'] . "','" . $_POST['vehicle'] . "','" . $_POST['offence'] . "','" . $officerId . "');";
    $resultAdd = mysqli_query($conn, $sqlAdd); 

    if(!$resultAdd) {
        $response['success'] = false;  
        $response['message'] = "Error adding incident";  
        echo json_encode($response); 
        exit;
    }  
    $response['message'] = "Incident updated successfully";
    echo json_encode($response); 
?>