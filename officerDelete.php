<?php
session_start();
include('connection.php');

$userId = $_SESSION["id"];

header('Content-Type: application/json');
$response = [
    "success" => false,
    "message" => "Unknown error",
];

try {
    $officerId = $_POST['id'];

    $sql = "DELETE FROM Officer WHERE Officer_ID = '$officerId'";

    if(!mysqli_query($conn, $sql)){
        throw new Exception("Error deleting officer.");
    } 

    $sqlAudit = "INSERT INTO Audit(Officer_ID, Audit_table, Audit_action, Audit_record) VALUES ('$userId', 'Officer', 'Delete','$officerId');";
    $resultAudit = mysqli_query($conn, $sqlAudit); 

    if(!$resultAudit) {
        throw new Exception("Error adding audit.");
    }

    $response['success'] = true;
    $response['message'] = "Officer deleted successfully.";
} catch (Exception $e) {
    $response['message'] = $e->getMessage();
}

echo json_encode($response);

?>