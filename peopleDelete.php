<?php
session_start();
include('connection.php');

$officerId = $_SESSION["id"];

header('Content-Type: application/json');
$response = [
    "success" => false,
    "message" => "Unknown error",
];

try {
    $peopleId = $_POST['id'];

    $sqlOwner = "SELECT Vehicle_ID FROM Ownership WHERE People_ID=$peopleId";
    $resultOwner = mysqli_query($conn, $sqlOwner);
    if (mysqli_num_rows($resultOwner) > 0) {
        $sqlOwner = "DELETE FROM Ownership WHERE People_ID = $peopleId";
        if(!mysqli_query($conn, $sqlOwner)){
            throw new Exception("Error deleting ownership.");
        } 
    }

    $sql = "DELETE FROM People WHERE People_ID = $peopleId";

    if(!mysqli_query($conn, $sql)){
        throw new Exception("Error deleting people.");
    } 

    $sqlAudit = "INSERT INTO Audit(Officer_ID, Audit_table, Audit_action, Audit_record) VALUES ('$officerId', 'People', 'Delete','" . $_POST['licence'] . "');";
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