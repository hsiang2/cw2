<?php
    include('connection.php');
    session_start();
    $officerId = $_SESSION["id"];

    header('Content-Type: application/json');

    $response = [
        "success" => false,
        "message" => "Unknown error",
    ];

    try {
        $sqlAdd = "INSERT INTO Incident(Incident_time, Incident_statement, People_ID, Vehicle_ID, Offence_ID, Officer_ID) VALUES ('" . $_POST['time'] . "','" . $_POST['statement'] ."','" . $_POST['people'] . "','" . $_POST['vehicle'] . "','" . $_POST['offence'] . "','" . $officerId . "');";
        $resultAdd = mysqli_query($conn, $sqlAdd); 
    
        if(!$resultAdd) {
            throw new Exception("Error adding incident");
        }  

        $incidentID = mysqli_insert_id($conn);

        $sqlAudit = "INSERT INTO Audit(Officer_ID, Audit_table, Audit_action, Audit_record) VALUES ('$officerId', 'Incident', 'Add','$incidentID');";
        $resultAudit = mysqli_query($conn, $sqlAudit); 

        if(!$resultAudit) {
            throw new Exception("Error adding audit.");
        }

        $response['success'] = true;
        $response['message'] = "Incident updated successfully";
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }

    echo json_encode($response); 
?>