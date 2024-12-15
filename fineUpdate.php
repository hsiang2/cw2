<?php
    include("connection.php");
    session_start();
    $officerId = $_SESSION["id"];

    header('Content-Type: application/json');

    $response = [
        "success" => false,
        "message" => "Unknown error",
    ];

    try {
        if ($_POST['fineId'] != null) {
            $sql = "UPDATE Fine SET Fine_amount='" . $_POST['amount'] . "', Fine_points='" . $_POST['points'] . "' WHERE Fine_ID=" . $_POST['fineId'];
        } else {
            $sql = "INSERT INTO Fine(Fine_amount, Fine_points, Incident_ID) VALUES ('" . $_POST['amount'] . "','" . $_POST['points'] ."','" . $_POST['incident'] . "');";
        }
       
        if (!mysqli_query($conn, $sql)) {
            throw new Exception("Error updating fine");
        } 

        $sqlAudit = "INSERT INTO Audit(Officer_ID, Audit_table, Audit_action, Audit_record) VALUES ('$officerId', 'Incident', 'Fine','" . $_POST['incident'] . "');";
        $resultAudit = mysqli_query($conn, $sqlAudit); 

        if(!$resultAudit) {
            throw new Exception("Error adding audit.");
        }
    
        $response['success'] = true;
        $response['message'] = "Fine updated successfully";
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }

    echo json_encode($response); 
?>
