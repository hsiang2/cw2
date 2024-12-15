<?php
    include("../common/connection.php");
    session_start();
    $officerId = $_SESSION["id"];

    header('Content-Type: application/json');

    $response = [
        "success" => false,
        "message" => "Unknown error",
    ]; 

    try {
        $sqlEdit = "UPDATE Incident SET Incident_time='" . $_POST['timeEdit'] . "', Incident_statement='" . $_POST['statementEdit'] . "', Offence_ID='" . $_POST['offenceEdit'] . "', Vehicle_ID='" . $_POST['vehicleEdit'] . "', People_ID='" . $_POST['peopleEdit'] . "' WHERE Incident_ID=" . $_POST['idEdit'];

        if (!mysqli_query($conn, $sqlEdit)) {
            throw new Exception("Error updating incident");
        } 

        $sqlAudit = "INSERT INTO Audit(Officer_ID, Audit_table, Audit_action, Audit_record) VALUES ('$officerId', 'Incident', 'Edit','" . $_POST['idEdit'] . "');";
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
