<?php
session_start();
include('../common/connection.php');

$officerId = $_SESSION["id"];

header('Content-Type: application/json');
$response = [
    "success" => false,
    "message" => "Unknown error",
];

try {
    $incidentId = $_POST['id'];
    $fineId = $_POST['fine'];

    if($fineId) {
        $sqlFine = "DELETE FROM Fine WHERE Fine_ID = $fineId";

        if(!mysqli_query($conn, $sqlFine)){
            throw new Exception("Error deleting fine.");
        } 
    }

    $sql = "DELETE FROM Incident WHERE Incident_ID = $incidentId";

    if(!mysqli_query($conn, $sql)){
        throw new Exception("Error deleting incident.");
    } 

    $sqlAudit = "INSERT INTO Audit(Officer_ID, Audit_table, Audit_action, Audit_record) VALUES ('$officerId', 'Incident', 'Delete','$incidentId');";
    $resultAudit = mysqli_query($conn, $sqlAudit); 

    if(!$resultAudit) {
        throw new Exception("Error adding audit.");
    }

    $response['success'] = true;
    $response['message'] = "People deleted successfully.";
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);

?>