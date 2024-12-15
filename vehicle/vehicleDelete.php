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
    $vehicleId = $_POST['id'];
    $sqlOwner = "SELECT People_ID FROM Ownership WHERE Vehicle_ID=$vehicleId";
    $resultOwner = mysqli_query($conn, $sqlOwner);
    if (mysqli_num_rows($resultOwner) > 0) {
        $sqlOwner = "DELETE FROM Ownership WHERE Vehicle_ID = $vehicleId";
        if(!mysqli_query($conn, $sqlOwner)){
            throw new Exception("Error deleting ownership.");   
        } 
    }

    $sql = "DELETE FROM Vehicle WHERE Vehicle_ID = $vehicleId";

    if(!mysqli_query($conn, $sql)){
        throw new Exception("Error deleting vehicle.");  
    } 

    $sqlAudit = "INSERT INTO Audit(Officer_ID, Audit_table, Audit_action, Audit_record) VALUES ('$officerId', 'Vehicle', 'Delete','" . $_POST['plate'] . "');";
    $resultAudit = mysqli_query($conn, $sqlAudit); 

    if(!$resultAudit) {
        throw new Exception("Error adding audit.");
    }

    $response['success'] = true;
    $response['message'] = "Vehicle deleted successfully.";

} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);
?>